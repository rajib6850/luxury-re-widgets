<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_Plugin — main singleton class.
 *
 * Bootstraps the plugin: checks requirements, loads text domain,
 * enqueues assets, and delegates widget loading to LRE_Widgets_Loader.
 *
 * @package Luxury_RE_Widgets
 */
final class LRE_Plugin {

	/** @var LRE_Plugin|null Singleton instance */
	private static $instance = null;

	/**
	 * Returns the singleton instance, creating it on first call.
	 *
	 * @return LRE_Plugin
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Constructor — registers the plugins_loaded hook. */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/** Prevent cloning of the singleton. */
	public function __clone() {}

	/** Prevent unserializing of the singleton. */
	public function __wakeup() {}

	// =========================================================================
	// Init
	// =========================================================================

	/**
	 * Runs after all plugins are loaded.
	 * Checks requirements before loading any plugin functionality.
	 */
	public function init() {

		// 1. PHP version check.
		if ( version_compare( PHP_VERSION, LRE_MIN_PHP, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_php_version' ) );
			return;
		}

		// 2. Elementor active check.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_missing_elementor' ) );
			return;
		}

		// 3. Elementor version check.
		if ( ! version_compare( ELEMENTOR_VERSION, LRE_MIN_ELEMENTOR, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_elementor_version' ) );
			return;
		}

		// 4. Load text domain for translations.
		load_plugin_textdomain(
			'luxury-re-widgets',
			false,
			dirname( plugin_basename( LRE_PATH . 'luxury-re-widgets.php' ) ) . '/languages'
		);

		// 5. Load widgets loader.
		require_once LRE_PATH . 'includes/class-lre-widgets-loader.php';
		new LRE_Widgets_Loader();

		// 6. Load AJAX handler.
		require_once LRE_PATH . 'includes/class-lre-ajax-handler.php';
		new LRE_Ajax_Handler();

		// 7. Load Elementor Global System Bridge.
		require_once LRE_PATH . 'includes/class-lre-global-system.php';
		LRE_Global_System::instance();

		// 8. Enqueue assets.
		add_action( 'wp_enqueue_scripts',               array( $this, 'enqueue_styles' ) );
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_styles' ) );

		add_action( 'wp_enqueue_scripts',                array( $this, 'enqueue_scripts' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	// =========================================================================
	// Asset Enqueueing
	// =========================================================================

	/**
	 * Registers & enqueues the plugin stylesheet and Google Fonts.
	 * Loaded on front-end and in the Elementor preview iframe only.
	 */
	public function enqueue_styles() {
		// Google Fonts
		wp_enqueue_style(
			'lre-google-fonts',
			'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap',
			array(),
			null
		);

		$css_ver = file_exists( LRE_PATH . 'assets/css/lre-widgets.css' ) ? filemtime( LRE_PATH . 'assets/css/lre-widgets.css' ) : LRE_VERSION;

		$deps = array( 'lre-google-fonts' );
		if ( wp_style_is( 'elementor-frontend', 'registered' ) ) {
			$deps[] = 'elementor-frontend';
		}

		// Plugin CSS with Cache Busting
		wp_enqueue_style(
			'lre-widgets',
			LRE_ASSETS_URL . 'css/lre-widgets.css',
			$deps,
			$css_ver
		);
	}

	/**
	 * Registers & enqueues the plugin script.
	 * Loaded on front-end and in the Elementor preview iframe only.
	 */
	public function enqueue_scripts() {
		$js_ver = file_exists( LRE_PATH . 'assets/js/lre-widgets.js' ) ? filemtime( LRE_PATH . 'assets/js/lre-widgets.js' ) : LRE_VERSION;

		wp_enqueue_script(
			'lre-widgets',
			LRE_ASSETS_URL . 'js/lre-widgets.js',
			array( 'jquery' ),
			$js_ver,
			true // Load in footer.
		);

		// Pass data to JS (ajaxurl, nonces, etc.).
		wp_localize_script(
			'lre-widgets',
			'LREData',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'lre_nonce' ),
			)
		);
	}

	// =========================================================================
	// Admin Notices
	// =========================================================================

	/** Admin notice: PHP version too old. */
	public function notice_php_version() {
		$message = sprintf(
			/* translators: 1: Plugin name, 2: Required PHP version, 3: Installed PHP version */
			esc_html__( '"%1$s" requires PHP %2$s or later. You are running PHP %3$s. Please upgrade PHP.', 'luxury-re-widgets' ),
			'<strong>Luxury Real Estate Widgets</strong>',
			LRE_MIN_PHP,
			PHP_VERSION
		);
		printf( '<div class="notice notice-error"><p>%s</p></div>', $message ); // phpcs:ignore WordPress.Security.EscapeOutput
	}

	/** Admin notice: Elementor not active. */
	public function notice_missing_elementor() {
		$message = sprintf(
			/* translators: 1: Plugin name */
			esc_html__( '"%1$s" requires Elementor to be installed and activated.', 'luxury-re-widgets' ),
			'<strong>Luxury Real Estate Widgets</strong>'
		);
		printf( '<div class="notice notice-error"><p>%s</p></div>', $message ); // phpcs:ignore WordPress.Security.EscapeOutput
	}

	/** Admin notice: Elementor version too old. */
	public function notice_elementor_version() {
		$message = sprintf(
			/* translators: 1: Plugin name, 2: Required Elementor version, 3: Installed Elementor version */
			esc_html__( '"%1$s" requires Elementor %2$s or later. You are running Elementor %3$s. Please update Elementor.', 'luxury-re-widgets' ),
			'<strong>Luxury Real Estate Widgets</strong>',
			LRE_MIN_ELEMENTOR,
			ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-error"><p>%s</p></div>', $message ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}