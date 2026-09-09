<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_FollowUpBoss
 *
 * Direct REST API Integration with Follow Up Boss (FUB) CRM.
 * Implements the official Follow Up Boss Events API (v1/events) to ensure:
 * - Instant lead routing & agent notifications.
 * - Automatic lead creation or deduplication.
 * - Auto-application of tags, stages, sources, and inquiry messages.
 * - Triggering of automated Follow Up Boss Action Plans.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_FollowUpBoss {

	/** @var LRE_FollowUpBoss|null Singleton instance */
	private static $instance = null;

	/** Follow Up Boss API Base URL */
	const API_BASE_URL = 'https://api.followupboss.com/v1/';

	/**
	 * Returns singleton instance.
	 *
	 * @return LRE_FollowUpBoss
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Constructor — registers global settings hooks. */
	private function __construct() {
		add_action( 'admin_init', array( $this, 'register_global_settings' ) );
	}

	/** Prevent cloning */
	public function __clone() {}

	/** Prevent unserializing */
	public function __wakeup() {}

	/**
	 * Registers Follow Up Boss global settings in WordPress General Settings.
	 */
	public function register_global_settings() {
		register_setting( 'general', 'lre_fub_api_key', array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		) );

		register_setting( 'general', 'lre_fub_system', array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'Adolfo Aguirre Real Estate',
		) );

		add_settings_section(
			'lre_fub_section',
			__( 'Follow Up Boss (FUB) CRM Integration', 'luxury-re-widgets' ),
			function () {
				echo '<p>' . esc_html__( 'Configure global API credentials for Follow Up Boss. Individual Elementor form widgets can inherit these credentials or override them.', 'luxury-re-widgets' ) . '</p>';
			},
			'general'
		);

		add_settings_field(
			'lre_fub_api_key',
			__( 'Follow Up Boss API Key', 'luxury-re-widgets' ),
			function () {
				$val = get_option( 'lre_fub_api_key', '' );
				echo '<input type="password" name="lre_fub_api_key" value="' . esc_attr( $val ) . '" class="regular-text" autocomplete="off" placeholder="fub_..."><br>';
				echo '<span class="description">' . esc_html__( 'Found in Follow Up Boss under Admin > API.', 'luxury-re-widgets' ) . '</span>';
			},
			'general',
			'lre_fub_section'
		);

		add_settings_field(
			'lre_fub_system',
			__( 'Follow Up Boss System Name', 'luxury-re-widgets' ),
			function () {
				$val = get_option( 'lre_fub_system', 'Adolfo Aguirre Real Estate' );
				echo '<input type="text" name="lre_fub_system" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="Adolfo Aguirre Real Estate">';
			},
			'general',
			'lre_fub_section'
		);
	}

	/**
	 * Resolves the active Follow Up Boss API Key.
	 *
	 * @param string $override_key Per-widget key override.
	 * @return string
	 */
	public function get_api_key( $override_key = '' ) {
		if ( ! empty( $override_key ) ) {
			return trim( $override_key );
		}
		return trim( get_option( 'lre_fub_api_key', '' ) );
	}

	/**
	 * Transmits an Event to Follow Up Boss.
	 * Follow Up Boss Events API creates or updates the person, records the message,
	 * applies tags, and triggers action plans.
	 *
	 * @param array  $event_data Lead & event data.
	 * @param string $api_key_override Optional widget-level key override.
	 * @return array Result with status and message.
	 */
	public function send_event( $event_data, $api_key_override = '' ) {
		$api_key = $this->get_api_key( $api_key_override );

		if ( empty( $api_key ) ) {
			return array(
				'success' => false,
				'message' => __( 'Follow Up Boss API Key is not configured.', 'luxury-re-widgets' ),
			);
		}

		$system_name = get_option( 'lre_fub_system', 'Adolfo Aguirre Real Estate' );
		if ( empty( $system_name ) ) {
			$system_name = get_bloginfo( 'name' );
		}

		// Build Person payload
		$person = array();

		if ( ! empty( $event_data['first_name'] ) ) {
			$person['firstName'] = sanitize_text_field( $event_data['first_name'] );
		}
		if ( ! empty( $event_data['last_name'] ) ) {
			$person['lastName'] = sanitize_text_field( $event_data['last_name'] );
		}
		if ( empty( $person['firstName'] ) && ! empty( $event_data['name'] ) ) {
			$name_parts = explode( ' ', trim( $event_data['name'] ), 2 );
			$person['firstName'] = $name_parts[0];
			if ( isset( $name_parts[1] ) ) {
				$person['lastName'] = $name_parts[1];
			}
		}

		if ( ! empty( $event_data['email'] ) && is_email( $event_data['email'] ) ) {
			$person['emails'] = array(
				array( 'value' => sanitize_email( $event_data['email'] ) ),
			);
		} else {
			return array(
				'success' => false,
				'message' => __( 'Valid email address is required for Follow Up Boss sync.', 'luxury-re-widgets' ),
			);
		}

		if ( ! empty( $event_data['phone'] ) ) {
			$person['phones'] = array(
				array( 'value' => sanitize_text_field( $event_data['phone'] ) ),
			);
		}

		if ( ! empty( $event_data['stage'] ) ) {
			$person['stage'] = sanitize_text_field( $event_data['stage'] );
		}

		// Tags
		$tags = array();
		if ( ! empty( $event_data['tags'] ) ) {
			if ( is_array( $event_data['tags'] ) ) {
				$tags = $event_data['tags'];
			} else {
				$tags = array_map( 'trim', explode( ',', $event_data['tags'] ) );
			}
		}
		$tags = array_filter( array_unique( $tags ) );
		if ( ! empty( $tags ) ) {
			$person['tags'] = array_values( $tags );
		}

		// Build Root Event payload
		$payload = array(
			'source'      => ! empty( $event_data['source'] ) ? sanitize_text_field( $event_data['source'] ) : 'Website Lead',
			'system'      => sanitize_text_field( $system_name ),
			'type'        => ! empty( $event_data['type'] ) ? sanitize_text_field( $event_data['type'] ) : 'General Inquiry',
			'message'     => ! empty( $event_data['message'] ) ? sanitize_textarea_field( $event_data['message'] ) : '',
			'description' => ! empty( $event_data['description'] ) ? sanitize_textarea_field( $event_data['description'] ) : '',
			'person'      => $person,
		);

		$endpoint = self::API_BASE_URL . 'events';

		$args = array(
			'method'      => 'POST',
			'timeout'     => 15,
			'redirection' => 5,
			'httpversion' => '1.1',
			'blocking'    => true,
			'headers'     => array(
				'Authorization' => 'Basic ' . base64_encode( $api_key . ':' ),
				'Content-Type'  => 'application/json; charset=utf-8',
				'Accept'        => 'application/json',
				'X-System'      => $system_name,
			),
			'body'        => wp_json_encode( $payload ),
			'data_format' => 'body',
		);

		$response = wp_remote_post( $endpoint, $args );

		if ( is_wp_error( $response ) ) {
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				error_log( 'LRE Follow Up Boss Error: ' . $response->get_error_message() );
			}
			return array(
				'success' => false,
				'message' => $response->get_error_message(),
			);
		}

		$response_code = wp_remote_retrieve_response_code( $response );
		$response_body = wp_remote_retrieve_body( $response );
		$decoded       = json_decode( $response_body, true );

		if ( 200 === $response_code || 201 === $response_code ) {
			return array(
				'success'  => true,
				'code'     => $response_code,
				'response' => $decoded,
			);
		}

		$err_msg = isset( $decoded['errorMessage'] ) ? $decoded['errorMessage'] : ( 'HTTP ' . $response_code );
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			error_log( 'LRE Follow Up Boss API Response Error (' . $response_code . '): ' . $response_body );
		}

		return array(
			'success' => false,
			'code'    => $response_code,
			'message' => $err_msg,
		);
	}
}
