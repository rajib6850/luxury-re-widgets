<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_Templates
 *
 * Manages front-end template overrides and administrative configuration
 * for luxury single post / insights layouts.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Templates {

	/** @var LRE_Templates|null Singleton instance */
	private static $instance = null;

	/**
	 * Returns singleton instance.
	 *
	 * @return LRE_Templates
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Constructor. */
	private function __construct() {
		// Front-end template override filter
		add_filter( 'single_template', array( $this, 'filter_single_template' ), 99 );

		// Register plugin options in wp-admin
		add_action( 'admin_init', array( $this, 'register_template_settings' ) );
	}

	/** Prevent cloning */
	public function __clone() {}

	/** Prevent unserializing */
	public function __wakeup() {}

	/**
	 * Filters the single template path for standard WordPress posts.
	 *
	 * @param string $template Current template file path.
	 * @return string Modified template file path if custom template is enabled.
	 */
	public function filter_single_template( $template ) {
		if ( is_singular( 'post' ) ) {
			$enabled = get_option( 'lre_enable_single_post_template', 'yes' );
			if ( 'yes' === $enabled ) {
				$custom_template = LRE_PATH . 'templates/single-post.php';
				if ( file_exists( $custom_template ) ) {
					return $custom_template;
				}
			}
		}
		return $template;
	}

	/**
	 * Registers the single template toggle in WordPress Settings > General.
	 */
	public function register_template_settings() {
		register_setting( 'general', 'lre_enable_single_post_template', array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'yes',
		) );

		add_settings_section(
			'lre_template_section',
			__( 'Luxury Real Estate — Single Post Template', 'luxury-re-widgets' ),
			function () {
				echo '<p>' . esc_html__( 'Control whether standard WordPress blog / market insights single posts use the custom Luxury Real Estate editorial layout or revert to the active theme single.php.', 'luxury-re-widgets' ) . '</p>';
			},
			'general'
		);

		add_settings_field(
			'lre_enable_single_post_template',
			__( 'Luxury Single Post Layout', 'luxury-re-widgets' ),
			function () {
				$val = get_option( 'lre_enable_single_post_template', 'yes' );
				?>
				<label for="lre_enable_single_post_template">
					<input type="checkbox" id="lre_enable_single_post_template" name="lre_enable_single_post_template" value="yes" <?php checked( $val, 'yes' ); ?>>
					<strong><?php esc_html_e( 'Enable Luxury Real Estate Editorial Single Post Template', 'luxury-re-widgets' ); ?></strong>
				</label>
				<p class="description">
					<?php esc_html_e( 'When checked, single posts display with the bespoke Crestwood & Associates luxury layout (Cinematic hero, Reading metrics, Advisory sidebar, Social sharing, and Related intelligence grid). Uncheck to use standard theme single.php.', 'luxury-re-widgets' ); ?>
				</p>
				<?php
			},
			'general',
			'lre_template_section'
		);
	}
}
