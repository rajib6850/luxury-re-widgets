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

		// Home valuation form submission.
		add_action( 'wp_ajax_lre_home_valuation_submit',        array( $this, 'handle_home_valuation' ) );
		add_action( 'wp_ajax_nopriv_lre_home_valuation_submit', array( $this, 'handle_home_valuation' ) );
		add_action( 'wp_ajax_lre_home_evaluation_submit',       array( $this, 'handle_home_valuation' ) );
		add_action( 'wp_ajax_nopriv_lre_home_evaluation_submit',array( $this, 'handle_home_valuation' ) );

		// Sold Portfolio / The Private Ledger AJAX pagination & filtering.
		add_action( 'wp_ajax_lre_load_sold_portfolio',        array( $this, 'handle_load_sold_portfolio' ) );
		add_action( 'wp_ajax_nopriv_lre_load_sold_portfolio', array( $this, 'handle_load_sold_portfolio' ) );
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

		// 6. Follow Up Boss (FUB CRM Integration)
		$enable_fub = isset( $_POST['enable_fub'] ) && 'yes' === $_POST['enable_fub'];
		if ( $enable_fub && class_exists( 'LRE_FollowUpBoss' ) && ! empty( $client_email ) ) {
			$fub_key    = isset( $_POST['fub_api_key'] ) ? sanitize_text_field( wp_unslash( $_POST['fub_api_key'] ) ) : '';
			$fub_source = isset( $_POST['fub_source'] ) && ! empty( $_POST['fub_source'] )
				? sanitize_text_field( wp_unslash( $_POST['fub_source'] ) )
				: 'Website - Contact Page';
			$fub_type   = isset( $_POST['fub_type'] ) && ! empty( $_POST['fub_type'] )
				? sanitize_text_field( wp_unslash( $_POST['fub_type'] ) )
				: 'General Inquiry';
			$fub_tags   = isset( $_POST['fub_tags'] ) ? sanitize_text_field( wp_unslash( $_POST['fub_tags'] ) ) : '';
			$fub_stage  = isset( $_POST['fub_stage'] ) ? sanitize_text_field( wp_unslash( $_POST['fub_stage'] ) ) : 'Lead';

			$fub_desc = "Website Contact Form Submission:\n";
			foreach ( $submitted_fields as $lbl => $val ) {
				$fub_desc .= "• " . $lbl . ": " . $val . "\n";
			}

			LRE_FollowUpBoss::instance()->send_event( array(
				'first_name'  => $client_first,
				'last_name'   => $client_last,
				'name'        => $client_name,
				'email'       => $client_email,
				'phone'       => $client_phone,
				'source'      => $fub_source,
				'type'        => $fub_type,
				'stage'       => $fub_stage,
				'tags'        => $fub_tags,
				'message'     => ! empty( $client_message ) ? $client_message : ( 'Inquiry regarding: ' . $client_interest ),
				'description' => $fub_desc,
			), $fub_key );
		}

		// 7. Response Message & Redirect
		$success_msg = isset( $_POST['success_message'] ) && ! empty( $_POST['success_message'] )
			? sanitize_text_field( wp_unslash( $_POST['success_message'] ) )
			: __( 'Thank you. Your message has been received. A senior associate will respond shortly.', 'luxury-re-widgets' );

		$redirect_url = isset( $_POST['redirect_url'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_url'] ) ) : '';

		wp_send_json_success( array(
			'message'      => $success_msg,
			'redirect_url' => $redirect_url,
		) );
	}

	/** Processes the Newsletter widget email capture with FUB CRM sync, Admin Alert & Auto-responder. */
	public function handle_newsletter() {
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		if ( ! empty( $nonce ) && ! wp_verify_nonce( $nonce, 'lre_nonce' ) ) {
			if ( ! check_ajax_referer( 'lre_nonce', 'nonce', false ) && ! is_user_logged_in() ) {
				if ( empty( $_POST['email'] ) ) {
					wp_send_json_error( array( 'message' => __( 'Security verification expired. Please refresh the page and try again.', 'luxury-re-widgets' ) ) );
				}
			}
		}

		$email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );

		$invalid_msg = isset( $_POST['invalid_email_message'] ) && ! empty( $_POST['invalid_email_message'] )
			? sanitize_text_field( wp_unslash( $_POST['invalid_email_message'] ) )
			: __( 'Please enter a valid email address.', 'luxury-re-widgets' );

		if ( empty( $email ) || ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => $invalid_msg ) );
		}

		// 1. Save to WordPress Option archive
		$subscribers = get_option( 'lre_newsletter_subscribers', array() );
		if ( ! in_array( $email, $subscribers, true ) ) {
			$subscribers[] = $email;
			update_option( 'lre_newsletter_subscribers', $subscribers, false );
		}

		// 2. Admin Notification Email
		$enable_admin_mail = isset( $_POST['enable_email_notification'] ) && 'yes' === $_POST['enable_email_notification'];
		if ( $enable_admin_mail ) {
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
				: 'New VIP Newsletter Subscriber: {{email}}';
			$admin_subject = str_replace( '{{email}}', $email, $raw_subject );

			$site_name    = get_bloginfo( 'name' );
			$sender_name  = isset( $_POST['sender_name'] ) && ! empty( $_POST['sender_name'] )
				? sanitize_text_field( wp_unslash( $_POST['sender_name'] ) )
				: ( ! empty( $site_name ) ? $site_name : 'Adolfo Aguirre Real Estate' );
			$sender_email = isset( $_POST['sender_email'] ) && ! empty( $_POST['sender_email'] )
				? sanitize_email( wp_unslash( $_POST['sender_email'] ) )
				: ( ! empty( $admin_recipients[0] ) ? $admin_recipients[0] : get_option( 'admin_email' ) );

			$admin_headers = array(
				'Content-Type: text/html; charset=UTF-8',
				'From: ' . $sender_name . ' <' . $sender_email . '>',
				'Reply-To: ' . $email . ' <' . $email . '>',
			);

			if ( ! empty( $_POST['email_cc'] ) ) {
				$admin_headers[] = 'Cc: ' . sanitize_text_field( wp_unslash( $_POST['email_cc'] ) );
			}
			if ( ! empty( $_POST['email_bcc'] ) ) {
				$admin_headers[] = 'Bcc: ' . sanitize_text_field( wp_unslash( $_POST['email_bcc'] ) );
			}

			$admin_body  = "<div style=\"font-family: 'Montserrat', Arial, sans-serif; max-width: 600px; margin: 0 auto; color: #111116; line-height: 1.6; padding: 32px; border: 1px solid #c5a047; background-color: #fcfcfb; border-radius: 6px;\">";
			$admin_body .= "<div style=\"border-bottom: 2px solid #02293f; padding-bottom: 14px; margin-bottom: 20px;\">";
			$admin_body .= "<span style=\"color: #c5a047; font-size: 11px; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase;\">THE AGUIRRE REPORT</span>";
			$admin_body .= "<h2 style=\"color: #02293f; margin: 6px 0 0 0; font-size: 20px; font-family: 'Georgia', serif; font-weight: 400;\">New VIP Subscriber</h2>";
			$admin_body .= "</div>";
			$admin_body .= "<p style=\"font-size: 14px; margin: 0 0 12px;\">A new subscriber has joined the Private Market Intelligence report:</p>";
			$admin_body .= "<p style=\"font-size: 16px; font-weight: 600; color: #02293f; background: #efebe2; padding: 12px 16px; border-radius: 4px; margin: 0 0 20px;\">" . esc_html( $email ) . "</p>";
			$admin_body .= "<div style=\"font-size: 11px; color: #8f8b82; border-top: 1px solid #eae7e1; padding-top: 14px;\">Transmitted via Luxury Real Estate Suite Engine • " . esc_html( current_time( 'F j, Y g:i A' ) ) . "</div>";
			$admin_body .= "</div>";

			foreach ( $admin_recipients as $recipient ) {
				wp_mail( $recipient, $admin_subject, $admin_body, $admin_headers );
			}
		}

		// 3. Client Welcome / Auto-Responder Email
		$enable_auto = isset( $_POST['enable_autoresponder'] ) && 'yes' === $_POST['enable_autoresponder'];
		if ( $enable_auto && ! empty( $email ) ) {
			$site_name = get_bloginfo( 'name' );
			$raw_auto_subject = isset( $_POST['autoresponder_subject'] ) && ! empty( $_POST['autoresponder_subject'] )
				? sanitize_text_field( wp_unslash( $_POST['autoresponder_subject'] ) )
				: 'Welcome to The Aguirre Report | Private Market Intelligence';

			$raw_auto_msg = isset( $_POST['autoresponder_message'] ) && ! empty( $_POST['autoresponder_message'] )
				? wp_kses_post( wp_unslash( $_POST['autoresponder_message'] ) )
				: "Dear Subscriber,\n\nThank you for subscribing to The Aguirre Report.\n\nYou now have priority access to curated off-market architectural acquisitions, private quarterly market insights, and Southern California luxury intelligence delivered discreetly.\n\nWarm regards,\nAdolfo Aguirre | SERHANT.";

			$user_headers = array(
				'Content-Type: text/html; charset=UTF-8',
				'From: ' . ( ! empty( $sender_name ) ? $sender_name : 'Adolfo Aguirre' ) . ' <' . ( ! empty( $sender_email ) ? $sender_email : get_option( 'admin_email' ) ) . '>',
				'Reply-To: ' . ( ! empty( $sender_email ) ? $sender_email : get_option( 'admin_email' ) ),
			);

			$client_body  = "<div style=\"font-family: 'Montserrat', Arial, sans-serif; max-width: 600px; margin: 0 auto; color: #111116; line-height: 1.7; padding: 32px; border: 1px solid #eae7e1; background-color: #ffffff;\">";
			$client_body .= "<div style=\"border-bottom: 2px solid #c5a047; padding-bottom: 12px; margin-bottom: 20px;\">";
			$client_body .= "<h2 style=\"color: #02293f; margin: 0; font-size: 18px; font-family: 'Georgia', serif; letter-spacing: 0.05em;\">" . esc_html( $site_name ) . "</h2>";
			$client_body .= "<span style=\"color: #c5a047; font-size: 11px; font-weight: 600; letter-spacing: 0.16em; text-transform: uppercase;\">PRIVATE MARKET INTELLIGENCE</span>";
			$client_body .= "</div>";
			$client_body .= "<div style=\"font-size: 14px; color: #222228;\">" . nl2br( $raw_auto_msg ) . "</div>";
			$client_body .= "<hr style=\"border: none; border-top: 1px solid #eae7e1; margin: 28px 0;\">";
			$client_body .= "<p style=\"font-size: 11px; color: #888888; margin: 0;\">" . esc_html( $site_name ) . " • SERHANT. Real Estate Advisory</p>";
			$client_body .= "</div>";

			wp_mail( $email, $raw_auto_subject, $client_body, $user_headers );
		}

		// 4. Follow Up Boss (FUB CRM Integration)
		$enable_fub = isset( $_POST['enable_fub'] ) && 'yes' === $_POST['enable_fub'];
		if ( $enable_fub && class_exists( 'LRE_FollowUpBoss' ) && ! empty( $email ) ) {
			$fub_key    = isset( $_POST['fub_api_key'] ) ? sanitize_text_field( wp_unslash( $_POST['fub_api_key'] ) ) : '';
			$fub_source = isset( $_POST['fub_source'] ) && ! empty( $_POST['fub_source'] )
				? sanitize_text_field( wp_unslash( $_POST['fub_source'] ) )
				: 'Website - Newsletter Sign-up';
			$fub_type   = isset( $_POST['fub_type'] ) && ! empty( $_POST['fub_type'] )
				? sanitize_text_field( wp_unslash( $_POST['fub_type'] ) )
				: 'Registration';
			$fub_tags   = isset( $_POST['fub_tags'] ) && ! empty( $_POST['fub_tags'] )
				? sanitize_text_field( wp_unslash( $_POST['fub_tags'] ) )
				: 'Newsletter Subscriber, The Aguirre Report, Website Lead';
			$fub_stage  = isset( $_POST['fub_stage'] ) ? sanitize_text_field( wp_unslash( $_POST['fub_stage'] ) ) : 'Lead';

			LRE_FollowUpBoss::instance()->send_event( array(
				'email'       => $email,
				'source'      => $fub_source,
				'type'        => $fub_type,
				'stage'       => $fub_stage,
				'tags'        => $fub_tags,
				'message'     => 'Subscribed to Private Market Intelligence / The Aguirre Report',
				'description' => 'User joined private newsletter list via website pre-footer bar.',
			), $fub_key );
		}

		// 5. Elementor Pro Submissions Archival (if active)
		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$submission_data = array(
				'post_id' => isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0,
				'form_id' => isset( $_POST['widget_id'] ) ? sanitize_text_field( wp_unslash( $_POST['widget_id'] ) ) : 'lre_newsletter',
				'fields'  => array( 'email' => $email ),
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
			: __( 'Thank you for subscribing. Welcome to The Aguirre Report.', 'luxury-re-widgets' );

		$redirect_url = isset( $_POST['redirect_url'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_url'] ) ) : '';

		wp_send_json_success( array(
			'message'      => $success_msg,
			'redirect_url' => $redirect_url,
		) );
	}

	/** Processes the Multi-Step Home Valuation form submission. */
	public function handle_home_valuation() {
		// Nonce verification with caching resilience
		$nonce = isset( $_POST["lre_val_nonce"] ) ? sanitize_text_field( wp_unslash( $_POST["lre_val_nonce"] ) ) : "";
		if ( ! empty( $nonce ) && ! wp_verify_nonce( $nonce, "lre_home_valuation_nonce" ) && ! wp_verify_nonce( $nonce, "lre_home_evaluation_nonce" ) ) {
			if ( ! check_ajax_referer( "lre_home_valuation_nonce", "lre_val_nonce", false ) && ! is_user_logged_in() ) {
				if ( empty( $_POST["lre_fields"] ) ) {
					wp_send_json_error( array( "message" => __( "Security verification expired. Please refresh the page and try again.", "luxury-re-widgets" ) ) );
				}
			}
		}

		// Collect Fields
		$raw_fields = isset( $_POST["lre_fields"] ) ? $_POST["lre_fields"] : array();
		$submitted_fields = array();
		$client_name  = "";
		$client_first = "";
		$client_last  = "";
		$client_email = "";
		$client_phone = "";
		$address_val  = "";
		$property_type = "";
		$property_specs = "";
		$timeline_val = "";
		$notes_val    = "";

		if ( is_array( $raw_fields ) ) {
			foreach ( $raw_fields as $raw_label => $raw_value ) {
				$label = sanitize_text_field( wp_unslash( $raw_label ) );
				if ( is_array( $raw_value ) ) {
					$val_clean = implode( ", ", array_map( "sanitize_text_field", wp_unslash( $raw_value ) ) );
				} else {
					$val_clean = sanitize_textarea_field( wp_unslash( $raw_value ) );
				}
				$submitted_fields[ $label ] = $val_clean;

				$lower = strtolower( $label );
				if ( strpos( $lower, "first" ) !== false && empty( $client_first ) ) {
					$client_first = $val_clean;
				} elseif ( strpos( $lower, "last" ) !== false && empty( $client_last ) ) {
					$client_last = $val_clean;
				} elseif ( ( strpos( $lower, "name" ) !== false || strpos( $lower, "client" ) !== false ) && empty( $client_name ) ) {
					$client_name = $val_clean;
				}

				if ( strpos( $lower, "email" ) !== false && empty( $client_email ) && is_email( $val_clean ) ) {
					$client_email = $val_clean;
				}
				if ( ( strpos( $lower, "phone" ) !== false || strpos( $lower, "tel" ) !== false || strpos( $lower, "mobile" ) !== false ) && empty( $client_phone ) ) {
					$client_phone = $val_clean;
				}
				if ( ( strpos( $lower, "address" ) !== false || strpos( $lower, "street" ) !== false ) && empty( $address_val ) ) {
					$address_val = $val_clean;
				}
				if ( ( strpos( $lower, "category" ) !== false || strpos( $lower, "type" ) !== false ) && empty( $property_type ) ) {
					$property_type = $val_clean;
				}
				if ( strpos( $lower, "timeline" ) !== false && empty( $timeline_val ) ) {
					$timeline_val = $val_clean;
				}
				if ( ( strpos( $lower, "notes" ) !== false || strpos( $lower, "upgrade" ) !== false || strpos( $lower, "amenities" ) !== false ) && empty( $notes_val ) ) {
					$notes_val = $val_clean;
				}
			}
		}

		if ( empty( $client_name ) && ( ! empty( $client_first ) || ! empty( $client_last ) ) ) {
			$client_name = trim( $client_first . " " . $client_last );
		}

		// Follow Up Boss Lead Sync
		if ( class_exists( "LRE_FollowUpBoss" ) && method_exists( "LRE_FollowUpBoss", "instance" ) ) {
			$fub = LRE_FollowUpBoss::instance();
			if ( $fub->is_configured() ) {
				$fub_note = "=== HOME VALUATION REQUEST ===\n";
				foreach ( $submitted_fields as $k => $v ) {
					$fub_note .= $k . ": " . $v . "\n";
				}
				$fub->create_lead( array(
					"firstName"  => ! empty( $client_first ) ? $client_first : $client_name,
					"lastName"   => $client_last,
					"name"       => $client_name,
					"emails"     => array( array( "value" => $client_email ) ),
					"phones"     => ! empty( $client_phone ) ? array( array( "value" => $client_phone ) ) : array(),
					"source"     => "Website - Home Valuation Page",
					"stage"      => "Lead",
					"tags"       => array( "Website Lead", "Home Valuation Request", "Adolfo Aguirre", "Seller Lead" ),
					"note"       => $fub_note,
					"propertyAddress" => $address_val,
				) );
			}
		}

		// Email notification to Admin
		$admin_email_to = ! empty( $_POST["admin_email_to"] ) ? sanitize_email( wp_unslash( $_POST["admin_email_to"] ) ) : get_option( "admin_email" );
		$subject = ! empty( $_POST["admin_email_subject"] ) ? sanitize_text_field( wp_unslash( $_POST["admin_email_subject"] ) ) : ( "New Home Valuation Request: " . ( $address_val ? $address_val : $client_name ) );

		$message_body = "<h2>New Home Valuation Request</h2>\n<p><strong>Client:</strong> " . esc_html( $client_name ) . "</p>\n<p><strong>Email:</strong> " . esc_html( $client_email ) . "</p>\n<p><strong>Phone:</strong> " . esc_html( $client_phone ) . "</p>\n<hr>\n<h3>Submitted Property Details:</h3>\n<ul>";
		foreach ( $submitted_fields as $lbl => $val ) {
			$message_body .= "<li><strong>" . esc_html( $lbl ) . ":</strong> " . esc_html( $val ) . "</li>\n";
		}
		$message_body .= "</ul>";

		$headers = array(
			"Content-Type: text/html; charset=UTF-8",
			"From: " . get_bloginfo( "name" ) . " <" . get_option( "admin_email" ) . ">",
		);
		if ( ! empty( $client_email ) ) {
			$headers[] = "Reply-To: " . ( $client_name ? $client_name : $client_email ) . " <" . $client_email . ">";
		}

		wp_mail( $admin_email_to, $subject, $message_body, $headers );

		// Client Autoresponder
		$enable_auto = isset( $_POST["enable_client_autoresponder"] ) ? sanitize_text_field( wp_unslash( $_POST["enable_client_autoresponder"] ) ) : "yes";
		if ( "yes" === $enable_auto && ! empty( $client_email ) ) {
			$client_subj = ! empty( $_POST["client_email_subject"] ) ? sanitize_text_field( wp_unslash( $_POST["client_email_subject"] ) ) : "Valuation Request Received | Adolfo Aguirre Private Advisory";
			$sender_name = ! empty( $_POST["client_sender_name"] ) ? sanitize_text_field( wp_unslash( $_POST["client_sender_name"] ) ) : "Adolfo Aguirre";
			$sender_email = ! empty( $_POST["client_sender_email"] ) ? sanitize_email( wp_unslash( $_POST["client_sender_email"] ) ) : "adolfo@serhant.com";

			$auto_msg = "<p>Dear " . esc_html( $client_first ? $client_first : $client_name ) . ",</p>\n"
				. "<p>Thank you for requesting a confidential market valuation for your property" . ( $address_val ? " at <strong>" . esc_html( $address_val ) . "</strong>" : "" ) . ".</p>\n"
				. "<p>Your property details have been securely received. Adolfo Aguirre is personally conducting a precision micro-market analysis, accounting for recent comparable sales, architectural provenance, and current buyer velocity in your community.</p>\n"
				. "<p>A comprehensive valuation dossier will be prepared and delivered to you within 24–48 hours.</p>\n"
				. "<br><p>Warm regards,<br><strong>Adolfo Aguirre</strong><br>SERHANT. Los Angeles<br>DRE #02096534<br>(310) 346-6380</p>";

			$auto_headers = array(
				"Content-Type: text/html; charset=UTF-8",
				"From: " . $sender_name . " <" . $sender_email . ">",
			);
			wp_mail( $client_email, $client_subj, $auto_msg, $auto_headers );
		}

		wp_send_json_success( array(
			"message" => __( "Thank you. Your valuation request has been received. Adolfo Aguirre will prepare your confidential property dossier.", "luxury-re-widgets" ),
		) );
	}

	/**
	 * Handles AJAX loading and pagination for The Private Ledger (Sold Portfolio).
	 */
	public function handle_load_sold_portfolio() {
		$paged          = isset( $_POST['paged'] ) ? max( 1, intval( $_POST['paged'] ) ) : 1;
		$posts_per_page = isset( $_POST['posts_per_page'] ) ? max( 1, intval( $_POST['posts_per_page'] ) ) : 6;
		$category       = isset( $_POST['category'] ) ? sanitize_text_field( wp_unslash( $_POST['category'] ) ) : 'all';
		$orderby        = isset( $_POST['orderby'] ) ? sanitize_text_field( wp_unslash( $_POST['orderby'] ) ) : 'date';
		$order          = isset( $_POST['order'] ) ? sanitize_text_field( wp_unslash( $_POST['order'] ) ) : 'DESC';

		$args = array(
			'post_type'      => 'lre_sold_property',
			'post_status'    => 'publish',
			'posts_per_page' => $posts_per_page,
			'paged'          => $paged,
		);

		if ( 'price' === $orderby ) {
			$args['meta_key'] = '_lre_sold_price';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = $order;
		} elseif ( 'title' === $orderby ) {
			$args['orderby'] = 'title';
			$args['order']   = $order;
		} else {
			$args['orderby'] = 'date';
			$args['order']   = $order;
		}

		if ( ! empty( $category ) && 'all' !== $category ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'sold_location',
					'field'    => 'slug',
					'terms'    => $category,
				),
			);
		}

		$query = new \WP_Query( $args );
		$html  = '';
		$offset = ( $paged - 1 ) * $posts_per_page;

		if ( ! class_exists( 'LRE_Sold_Portfolio_Widget' ) && defined( 'LRE_PATH' ) ) {
			require_once LRE_PATH . 'widgets/class-lre-sold-portfolio-widget.php';
		}

		if ( $query->have_posts() ) {
			$index = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				$post_id   = get_the_ID();
				$title     = get_the_title();
				$price     = get_post_meta( $post_id, '_lre_sold_price', true );
				$beds      = get_post_meta( $post_id, '_lre_beds', true );
				$baths     = get_post_meta( $post_id, '_lre_baths', true );
				$sqft      = get_post_meta( $post_id, '_lre_sqft', true );
				$city      = get_post_meta( $post_id, '_lre_city', true );
				$badge     = get_post_meta( $post_id, '_lre_badge', true );
				$img_url   = get_the_post_thumbnail_url( $post_id, 'large' );
				$terms     = wp_get_post_terms( $post_id, 'sold_location', array( 'fields' => 'slugs' ) );
				$cat_slug  = ! empty( $terms ) ? implode( ' ', $terms ) : '';
				$loc_names = wp_get_post_terms( $post_id, 'sold_location', array( 'fields' => 'names' ) );
				$location  = ! empty( $loc_names ) ? implode( ', ', $loc_names ) : ( $city ? $city . ', California' : 'Pasadena, California' );
				$desc      = get_the_excerpt() ? get_the_excerpt() : wp_trim_words( get_post_field( 'post_content', $post_id ), 25 );

				$item = array(
					'title'       => $title,
					'price'       => $price ?: 'Confidential',
					'beds'        => $beds ?: '',
					'baths'       => $baths ?: '',
					'sqft'        => $sqft ?: '',
					'location'    => $location,
					'category'    => $cat_slug,
					'image_url'   => $img_url ?: '',
					'description' => $desc,
				);

				if ( class_exists( 'LRE_Sold_Portfolio_Widget' ) && method_exists( 'LRE_Sold_Portfolio_Widget', 'render_ledger_row_html' ) ) {
					$html .= LRE_Sold_Portfolio_Widget::render_ledger_row_html( $item, $index, $offset );
				}
				$index++;
			}
			wp_reset_postdata();
		} else {
			$html = '<div class="lre-ledger-empty" style="padding:3rem 0;text-align:center;color:#8E929B;font-family:var(--font-sans);font-size:0.95rem;">' . esc_html__( 'No confidential transactions found in this registry category.', 'luxury-re-widgets' ) . '</div>';
		}

		$max_pages = $query->max_num_pages;
		$pagination_html = '';
		if ( class_exists( 'LRE_Sold_Portfolio_Widget' ) && method_exists( 'LRE_Sold_Portfolio_Widget', 'render_pagination_html' ) ) {
			$pagination_html = LRE_Sold_Portfolio_Widget::render_pagination_html( $paged, $max_pages );
		}

		wp_send_json_success(
			array(
				'html'            => $html,
				'pagination_html' => $pagination_html,
				'current_page'    => $paged,
				'max_pages'       => $max_pages,
				'total_found'     => $query->found_posts,
			)
		);
	}

}
