<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_Ajax_Handler
 *
 * Handles all AJAX requests for Luxury Real Estate Widgets.
 * Includes dynamic Elementor Pro-style form field collection,
 * token replacements, HTML notification dispatch, auto-responder emails,
 * and Elementor Pro Submissions archiving.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Ajax_Handler {

	/** Constructor — registers all AJAX action hooks. */
	public function __construct() {
		// Contact form submission.
		add_action( 'wp_ajax_lre_contact_submit',        array( $this, 'handle_contact' ) );
		add_action( 'wp_ajax_nopriv_lre_contact_submit', array( $this, 'handle_contact' ) );

		// Newsletter / email capture.
		add_action( 'wp_ajax_lre_newsletter_submit',        array( $this, 'handle_newsletter' ) );
		add_action( 'wp_ajax_nopriv_lre_newsletter_submit', array( $this, 'handle_newsletter' ) );
	}

	// =========================================================================
	// Handlers
	// =========================================================================

	/** Processes the dynamic Contact form submission. */
	public function handle_contact() {
		// Nonce verification with caching resilience
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		if ( ! empty( $nonce ) && ! wp_verify_nonce( $nonce, 'lre_nonce' ) ) {
			if ( ! check_ajax_referer( 'lre_nonce', 'nonce', false ) && ! is_user_logged_in() ) {
				if ( empty( $_POST['lre_fields'] ) && empty( $_POST['email'] ) ) {
					wp_send_json_error( array( 'message' => __( 'Security verification expired. Please refresh the page and try again.', 'luxury-re-widgets' ) ) );
				}
			}
		}

		// 1. Collect Form Builder Dynamic Fields
		$submitted_fields = array();
		$client_name      = '';
		$client_first     = '';
		$client_last      = '';
		$client_email     = '';
		$client_phone     = '';
		$client_interest  = '';
		$client_message   = '';

		if ( isset( $_POST['lre_fields'] ) && is_array( $_POST['lre_fields'] ) ) {
			foreach ( $_POST['lre_fields'] as $raw_label => $raw_value ) {
				$label = sanitize_text_field( wp_unslash( $raw_label ) );
				if ( is_array( $raw_value ) ) {
					$val_clean = implode( ', ', array_map( 'sanitize_text_field', wp_unslash( $raw_value ) ) );
				} else {
					$val_clean = sanitize_textarea_field( wp_unslash( $raw_value ) );
				}
				$submitted_fields[ $label ] = $val_clean;

				// Intelligent Auto-Detection of standard fields
				$lower_lbl = strtolower( $label );
				if ( strpos( $lower_lbl, 'first' ) !== false && empty( $client_first ) ) {
					$client_first = $val_clean;
				} elseif ( strpos( $lower_lbl, 'last' ) !== false && empty( $client_last ) ) {
					$client_last = $val_clean;
				} elseif ( ( strpos( $lower_lbl, 'name' ) !== false || strpos( $lower_lbl, 'client' ) !== false ) && empty( $client_name ) ) {
					$client_name = $val_clean;
				}

				if ( strpos( $lower_lbl, 'email' ) !== false && empty( $client_email ) && is_email( $val_clean ) ) {
					$client_email = $val_clean;
				}

				if ( ( strpos( $lower_lbl, 'phone' ) !== false || strpos( $lower_lbl, 'tel' ) !== false ) && empty( $client_phone ) ) {
					$client_phone = $val_clean;
				}

				if ( ( strpos( $lower_lbl, 'interest' ) !== false || strpos( $lower_lbl, 'service' ) !== false || strpos( $lower_lbl, 'looking' ) !== false ) && empty( $client_interest ) ) {
					$client_interest = $val_clean;
				}

				if ( ( strpos( $lower_lbl, 'message' ) !== false || strpos( $lower_lbl, 'note' ) !== false || strpos( $lower_lbl, 'question' ) !== false ) && empty( $client_message ) ) {
					$client_message = $val_clean;
				}
			}
		}

		// Fallback detection from direct POST keys
		if ( empty( $client_first ) && isset( $_POST['first_name'] ) ) $client_first = sanitize_text_field( wp_unslash( $_POST['first_name'] ) );
		if ( empty( $client_last ) && isset( $_POST['last_name'] ) ) $client_last = sanitize_text_field( wp_unslash( $_POST['last_name'] ) );
		if ( empty( $client_name ) && isset( $_POST['name'] ) ) $client_name = sanitize_text_field( wp_unslash( $_POST['name'] ) );
		if ( empty( $client_email ) && isset( $_POST['email'] ) ) $client_email = sanitize_email( wp_unslash( $_POST['email'] ) );
		if ( empty( $client_phone ) && isset( $_POST['phone'] ) ) $client_phone = sanitize_text_field( wp_unslash( $_POST['phone'] ) );
		if ( empty( $client_message ) && isset( $_POST['message'] ) ) $client_message = sanitize_textarea_field( wp_unslash( $_POST['message'] ) );

		if ( empty( $client_name ) ) {
			$client_name = trim( $client_first . ' ' . $client_last );
			if ( empty( $client_name ) ) {
				$client_name = 'Prospective Private Client';
			}
		}

		// Validation check
		if ( empty( $client_email ) || ! is_email( $client_email ) ) {
			wp_send_json_error( array( 'message' => __( 'Please provide a valid email address.', 'luxury-re-widgets' ) ) );
		}

		// 2. Build Dynamic Token Map
		$tokens = array(
			'{{name}}'        => $client_name,
			'{{First Name}}'  => ! empty( $client_first ) ? $client_first : $client_name,
			'{{Last Name}}'   => $client_last,
			'{{email}}'       => $client_email,
			'{{Email}}'       => $client_email,
			'{{phone}}'       => $client_phone,
			'{{Phone}}'       => $client_phone,
			'{{interest}}'    => $client_interest,
			'{{Interest}}'    => $client_interest,
			'{{message}}'     => $client_message,
			'{{Message}}'     => $client_message,
		);
		foreach ( $submitted_fields as $lbl => $val ) {
			$tokens[ '{{' . $lbl . '}}' ] = $val;
		}

		// 3. Admin Notification Email
		$raw_to = isset( $_POST['email_to'] ) ? wp_unslash( $_POST['email_to'] ) : '';
		$admin_recipients = array();
		if ( ! empty( $raw_to ) ) {
			$split_emails = explode( ',', $raw_to );
			foreach ( $split_emails as $em ) {
				$clean = sanitize_email( trim( $em ) );
				if ( ! empty( $clean ) && is_email( $clean ) ) {
					$admin_recipients[] = $clean;
				}
			}
		}
		if ( empty( $admin_recipients ) ) {
			$admin_recipients[] = get_option( 'admin_email' );
		}

		$raw_subject = isset( $_POST['email_subject'] ) && ! empty( $_POST['email_subject'] )
			? sanitize_text_field( wp_unslash( $_POST['email_subject'] ) )
			: 'New Luxury Inquiry from {{First Name}} {{Last Name}}';

		$admin_subject = strtr( $raw_subject, $tokens );

		// Sender headers
		$site_name    = get_bloginfo( 'name' );
		$sender_name  = isset( $_POST['sender_name'] ) && ! empty( $_POST['sender_name'] )
			? sanitize_text_field( wp_unslash( $_POST['sender_name'] ) )
			: ( ! empty( $site_name ) ? $site_name : 'Luxury Advisory Office' );
		$sender_email = isset( $_POST['sender_email'] ) && ! empty( $_POST['sender_email'] )
			? sanitize_email( wp_unslash( $_POST['sender_email'] ) )
			: ( ! empty( $admin_recipients[0] ) ? $admin_recipients[0] : get_option( 'admin_email' ) );

		$admin_headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . $sender_name . ' <' . $sender_email . '>',
			'Reply-To: ' . $client_name . ' <' . $client_email . '>',
		);

		if ( ! empty( $_POST['email_cc'] ) ) {
			$admin_headers[] = 'Cc: ' . sanitize_text_field( wp_unslash( $_POST['email_cc'] ) );
		}
		if ( ! empty( $_POST['email_bcc'] ) ) {
			$admin_headers[] = 'Bcc: ' . sanitize_text_field( wp_unslash( $_POST['email_bcc'] ) );
		}

		// Luxury HTML Template for Admin
		$admin_body  = "<div style=\"font-family: 'Montserrat', Arial, sans-serif; max-width: 640px; margin: 0 auto; color: #111116; line-height: 1.6; padding: 32px; border: 1px solid #c5a047; background-color: #fcfcfb; border-radius: 8px;\">";
		$admin_body .= "<div style=\"border-bottom: 2px solid #08080c; padding-bottom: 16px; margin-bottom: 24px;\">";
		$admin_body .= "<span style=\"color: #c5a047; font-size: 11px; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase;\">PRIVATE CLIENT ADVISORY</span>";
		$admin_body .= "<h2 style=\"color: #08080c; margin: 6px 0 0 0; font-size: 22px; font-family: 'Georgia', serif; font-weight: 400; text-transform: uppercase; letter-spacing: 0.06em;\">New Contact Inquiry</h2>";
		$admin_body .= "</div>";

		$admin_body .= "<table style=\"width: 100%; border-collapse: collapse; font-size: 14px;\">";
		foreach ( $submitted_fields as $f_label => $f_val ) {
			$admin_body .= "<tr style=\"border-bottom: 1px solid #eae7e1;\">";
			$admin_body .= "<td style=\"padding: 12px 0; width: 35%; color: #6e6b65; font-weight: 600; vertical-align: top;\">" . esc_html( $f_label ) . ":</td>";
			$admin_body .= "<td style=\"padding: 12px 0; color: #08080c; font-weight: 500;\">" . nl2br( esc_html( $f_val ) ) . "</td>";
			$admin_body .= "</tr>";
		}
		$admin_body .= "</table>";

		$admin_body .= "<div style=\"margin-top: 36px; padding-top: 18px; border-top: 1px solid #eae7e1; font-size: 11px; color: #8f8b82; text-align: center;\">";
		$admin_body .= "Transmitted securely via Luxury Real Estate Suite Engine • " . esc_html( current_time( 'F j, Y g:i A' ) );
		$admin_body .= "</div></div>";

		$mail_sent = false;
		foreach ( $admin_recipients as $recipient ) {
			if ( wp_mail( $recipient, $admin_subject, $admin_body, $admin_headers ) ) {
				$mail_sent = true;
			}
		}

		// 4. Client Auto-Responder Confirmation Email (Optional)
		$enable_auto = isset( $_POST['enable_autoresponder'] ) && 'yes' === $_POST['enable_autoresponder'];
		if ( $enable_auto && ! empty( $client_email ) ) {
			$raw_auto_subject = isset( $_POST['autoresponder_subject'] ) && ! empty( $_POST['autoresponder_subject'] )
				? sanitize_text_field( wp_unslash( $_POST['autoresponder_subject'] ) )
				: 'Inquiry Received | Private Advisory Office';
			$auto_subject = strtr( $raw_auto_subject, $tokens );

			$raw_auto_msg = isset( $_POST['autoresponder_message'] ) && ! empty( $_POST['autoresponder_message'] )
				? wp_kses_post( wp_unslash( $_POST['autoresponder_message'] ) )
				: "Dear {{First Name}},\n\nThank you for reaching out to our advisory office. Your inquiry has been received with the highest confidentiality.\n\nA senior partner will review your request and get in touch shortly.\n\nWarm regards,\nPrivate Client Concierge";
			$auto_content = strtr( $raw_auto_msg, $tokens );

			$user_headers = array(
				'Content-Type: text/html; charset=UTF-8',
				'From: ' . $sender_name . ' <' . $sender_email . '>',
				'Reply-To: ' . $sender_email,
			);

			$client_body  = "<div style=\"font-family: 'Montserrat', Arial, sans-serif; max-width: 600px; margin: 0 auto; color: #111116; line-height: 1.7; padding: 32px; border: 1px solid #eae7e1; background-color: #ffffff;\">";
			$client_body .= "<div style=\"border-bottom: 2px solid #c5a047; padding-bottom: 12px; margin-bottom: 20px;\">";
			$client_body .= "<h2 style=\"color: #08080c; margin: 0; font-size: 18px; font-family: 'Georgia', serif; letter-spacing: 0.05em;\">" . esc_html( $site_name ) . "</h2>";
			$client_body .= "</div>";
			$client_body .= "<div style=\"font-size: 14px; color: #222228;\">" . nl2br( $auto_content ) . "</div>";
			$client_body .= "<hr style=\"border: none; border-top: 1px solid #eae7e1; margin: 28px 0;\">";
			$client_body .= "<p style=\"font-size: 11px; color: #888888; margin: 0;\">" . esc_html( $site_name ) . " • Confidential Real Estate Advisory</p>";
			$client_body .= "</div>";

			wp_mail( $client_email, $auto_subject, $client_body, $user_headers );
		}

		// 5. Elementor Pro Submissions Archival (if active)
		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$submission_data = array(
				'post_id' => isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0,
				'form_id' => isset( $_POST['widget_id'] ) ? sanitize_text_field( wp_unslash( $_POST['widget_id'] ) ) : 'lre_contact',
				'fields'  => $submitted_fields,
				'meta'    => array(
					'remote_ip'  => $_SERVER['REMOTE_ADDR'] ?? '',
					'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
					'date'       => current_time( 'mysql' ),
				),
			);
			do_action( 'elementor_pro/forms/new_record', $submission_data );
		}

		// 6. Response Message & Redirect
		$success_msg = isset( $_POST['success_message'] ) && ! empty( $_POST['success_message'] )
			? sanitize_text_field( wp_unslash( $_POST['success_message'] ) )
			: __( 'Thank you. Your message has been received. A senior associate will respond shortly.', 'luxury-re-widgets' );

		$redirect_url = isset( $_POST['redirect_url'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_url'] ) ) : '';

		wp_send_json_success( array(
			'message'      => $success_msg,
			'redirect_url' => $redirect_url,
		) );
	}

	/** Processes the Newsletter widget email capture. */
	public function handle_newsletter() {
		check_ajax_referer( 'lre_nonce', 'nonce' );

		$email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );

		if ( ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'luxury-re-widgets' ) ) );
		}

		$subscribers = get_option( 'lre_newsletter_subscribers', array() );
		if ( ! in_array( $email, $subscribers, true ) ) {
			$subscribers[] = $email;
			update_option( 'lre_newsletter_subscribers', $subscribers, false );
		}

		wp_send_json_success( array( 'message' => __( 'Thank you for subscribing.', 'luxury-re-widgets' ) ) );
	}
}
