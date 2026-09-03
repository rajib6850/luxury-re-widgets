<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_Ajax_Handler
 *
 * Handles all AJAX requests for Luxury Real Estate Widgets.
 * Each action is registered for both logged-in (wp_ajax_) and
 * anonymous (wp_ajax_nopriv_) users.
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

	/** Processes the Contact / CTA widget form submission. */
	public function handle_contact() {
		check_ajax_referer( 'lre_nonce', 'nonce' );

		$name    = sanitize_text_field( wp_unslash( $_POST['name']    ?? '' ) );
		$email   = sanitize_email( wp_unslash( $_POST['email']        ?? '' ) );
		$phone   = sanitize_text_field( wp_unslash( $_POST['phone']   ?? '' ) );
		$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

		if ( empty( $name ) || ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => __( 'Please enter a valid name and email.', 'luxury-re-widgets' ) ) );
		}

		$to      = get_option( 'admin_email' );
		$subject = sprintf( __( 'New Contact Enquiry from %s', 'luxury-re-widgets' ), $name );
		$body    = sprintf(
			"Name: %s\nEmail: %s\nPhone: %s\n\nMessage:\n%s",
			$name,
			$email,
			$phone,
			$message
		);
		$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

		$sent = wp_mail( $to, $subject, $body, $headers );

		if ( $sent ) {
			wp_send_json_success( array( 'message' => __( 'Thank you. We will be in touch shortly.', 'luxury-re-widgets' ) ) );
		} else {
			wp_send_json_error( array( 'message' => __( 'Message could not be sent. Please try again.', 'luxury-re-widgets' ) ) );
		}
	}

	/** Processes the Newsletter widget email capture. */
	public function handle_newsletter() {
		check_ajax_referer( 'lre_nonce', 'nonce' );

		$email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );

		if ( ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'luxury-re-widgets' ) ) );
		}

		// Store in options as a simple comma-separated list (extend with Mailchimp/Klaviyo API as needed).
		$subscribers = get_option( 'lre_newsletter_subscribers', array() );
		if ( ! in_array( $email, $subscribers, true ) ) {
			$subscribers[] = $email;
			update_option( 'lre_newsletter_subscribers', $subscribers, false );
		}

		wp_send_json_success( array( 'message' => __( 'Thank you for subscribing.', 'luxury-re-widgets' ) ) );
	}
}
