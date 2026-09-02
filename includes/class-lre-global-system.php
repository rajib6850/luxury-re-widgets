<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_Global_System
 *
 * Full integration with Elementor Global System:
 * 1. Global Color System: maps --e-global-color-* to luxury tokens.
 * 2. Global Typography & Fonts: maps --e-global-typography-* to luxury tokens.
 * 3. Site Settings Theme Style Typography: ensures H1-H6, Body, and Link
 *    settings in Elementor Site Settings cascade cleanly to all 10 widgets.
 * 4. Automatic & One-Click Sync: populates active Elementor Kit with the exact
 *    HTML design system palette & typography.
 *
 * @package Luxury_RE_Widgets
 */
final class LRE_Global_System {

	/** @var LRE_Global_System|null Singleton instance */
	private static $instance = null;

	/**
	 * Returns the singleton instance.
	 *
	 * @return LRE_Global_System
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Constructor - registers actions. */
	private function __construct() {
		add_action( 'wp_head',                          array( $this, 'inject_global_bridge_css' ), 99 );
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_preview_bridge_css' ), 99 );
		add_action( 'admin_init',                       array( $this, 'handle_admin_actions' ) );
		add_action( 'admin_notices',                    array( $this, 'render_admin_notice' ) );
	}

	/** Prevent cloning & unserializing */
	public function __clone() {}
	public function __wakeup() {}

	/**
	 * Builds dynamic CSS bridge between Elementor Kit globals and LRE design tokens.
	 *
	 * @return string CSS string.
	 */
	public function get_bridge_css() {
		return '
/* ─── LRE ELEMENTOR GLOBAL SYSTEM DYNAMIC BRIDGE ─── */
:root,
body,
[class*="elementor-kit-"] {
  --color-primary: var(--e-global-color-primary, #16192b);
  --color-secondary: var(--e-global-color-secondary, #c5a047);
  --color-secondary-light: var(--e-global-color-accent, #d4b565);
  --color-secondary-dark: #a8872e;
  --color-dark: var(--e-global-color-primary, #0a0a0a);
  --color-dark-section: #111318;
  --color-dark-card: #141414;
  --color-text: var(--e-global-color-text, #2c2c2c);
  --color-text-muted: var(--e-global-color-text, #6b6b6b);
  --color-accent: var(--e-global-color-accent, #c5a047);

  --font-serif: var(--e-global-typography-primary-font-family, \'Libre Baskerville\', \'Baskerville Old Face\', \'Baskerville\', Garamond, serif);
  --font-sans: var(--e-global-typography-text-font-family, \'Montserrat\', \'Helvetica Neue\', sans-serif);
  --font-accent: var(--e-global-typography-accent-font-family, \'Cormorant Garamond\', \'Georgia\', serif);
  --font-secondary: var(--e-global-typography-secondary-font-family, var(--font-sans));

  --font-weight-primary: var(--e-global-typography-primary-font-weight, 400);
  --font-weight-secondary: var(--e-global-typography-secondary-font-weight, 400);
  --font-weight-text: var(--e-global-typography-text-font-weight, 400);
  --font-weight-accent: var(--e-global-typography-accent-font-weight, 600);
}

/* ── Elementor Site Settings > Style > Typography (H1-H6) Direct Cascade ── */
[class*="elementor-kit-"] h1,
[class*="elementor-kit-"] h2,
[class*="elementor-kit-"] h3,
[class*="elementor-kit-"] h4,
[class*="elementor-kit-"] h5,
[class*="elementor-kit-"] h6 {
  font-family: inherit;
}

/* Widget title elements inherit typography from the dynamic heading tag (H1-H6) */
[class*="elementor-kit-"] .hero__title,
[class*="elementor-kit-"] .about__title,
[class*="elementor-kit-"] .services__title,
[class*="elementor-kit-"] .listings__title,
[class*="elementor-kit-"] .communities__title,
[class*="elementor-kit-"] .cta__title,
[class*="elementor-kit-"] .footer__brand,
[class*="elementor-kit-"] .testimonial__heading-main {
  font-family: inherit;
  font-weight: inherit;
  line-height: inherit;
  letter-spacing: inherit;
}

/* Light section headings inherit heading color from Site Settings */
[class*="elementor-kit-"] .about__title,
[class*="elementor-kit-"] .listings__title,
[class*="elementor-kit-"] .communities__title,
[class*="elementor-kit-"] .footer__brand {
  color: inherit;
}

/* Dark section headings default to white unless overridden by widget controls */
.hero__title,
.services__title,
.cta__title,
.testimonial__heading-main {
  color: var(--color-white);
}

/* Body typography inheritance for descriptions and general text */
[class*="elementor-kit-"] p,
[class*="elementor-kit-"] .about__description,
[class*="elementor-kit-"] .services__card-desc,
[class*="elementor-kit-"] .listing-card__address,
[class*="elementor-kit-"] .footer__col-text,
[class*="elementor-kit-"] .hero__subtitle {
  font-family: inherit;
}

/* Link typography & color reflection from Site Settings */
[class*="elementor-kit-"] a:not(.btn):not(.community-card):not(.listing-card) {
  transition: color var(--transition-fast, 0.25s ease);
}
';
	}

	/** Injects bridge CSS in front-end <head>. */
	public function inject_global_bridge_css() {
		echo "\n" . '<style id="lre-global-bridge-css">' . $this->get_bridge_css() . '</style>' . "\n";
	}

	/** Injects bridge CSS in Elementor Preview iframe. */
	public function enqueue_preview_bridge_css() {
		wp_add_inline_style( 'lre-widgets', $this->get_bridge_css() );
	}

	/**
	 * Synchronizes the exact Luxury HTML design palette and typography into the active Elementor Kit.
	 *
	 * @param bool $force If true, overwrites regardless of current values.
	 * @return bool True if kit was updated.
	 */
	public function sync_luxury_defaults_to_kit( $force = false ) {
		if ( ! did_action( 'elementor/loaded' ) ) {
			return false;
		}

		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
		if ( ! $kit ) {
			return false;
		}

		$kit_id = $kit->get_id();
		$meta   = get_post_meta( $kit_id, '_elementor_page_settings', true );
		if ( ! is_array( $meta ) ) {
			$meta = array();
		}

		// Check if already customized (unless force = true)
		if ( ! $force && ! empty( $meta['system_colors'] ) ) {
			$first_color = $meta['system_colors'][0]['color'] ?? '';
			if ( '#6EC1E4' !== $first_color && '#16192b' === $first_color ) {
				// Already synchronized with luxury palette
				return false;
			}
		}

		// 1. System Colors (Primary, Secondary, Text, Accent)
		$meta['system_colors'] = array(
			array(
				'_id'   => 'primary',
				'title' => esc_html__( 'Primary', 'elementor' ),
				'color' => '#16192b',
			),
			array(
				'_id'   => 'secondary',
				'title' => esc_html__( 'Secondary', 'elementor' ),
				'color' => '#c5a047',
			),
			array(
				'_id'   => 'text',
				'title' => esc_html__( 'Text', 'elementor' ),
				'color' => '#2c2c2c',
			),
			array(
				'_id'   => 'accent',
				'title' => esc_html__( 'Accent', 'elementor' ),
				'color' => '#d4b565',
			),
		);

		// Custom Colors
		$meta['custom_colors'] = array(
			array(
				'_id'   => 'lre_dark',
				'title' => esc_html__( 'Luxury Dark', 'luxury-re-widgets' ),
				'color' => '#0a0a0a',
			),
			array(
				'_id'   => 'lre_cream',
				'title' => esc_html__( 'Luxury Cream', 'luxury-re-widgets' ),
				'color' => '#faf7f2',
			),
			array(
				'_id'   => 'lre_muted',
				'title' => esc_html__( 'Luxury Muted', 'luxury-re-widgets' ),
				'color' => '#6b6b6b',
			),
		);

		// 2. System Typography (Global Fonts)
		$meta['system_typography'] = array(
			array(
				'_id'                    => 'primary',
				'title'                  => esc_html__( 'Primary', 'elementor' ),
				'typography_typography'  => 'custom',
				'typography_font_family' => 'Libre Baskerville',
				'typography_font_weight' => '400',
			),
			array(
				'_id'                    => 'secondary',
				'title'                  => esc_html__( 'Secondary', 'elementor' ),
				'typography_typography'  => 'custom',
				'typography_font_family' => 'Montserrat',
				'typography_font_weight' => '600',
			),
			array(
				'_id'                    => 'text',
				'title'                  => esc_html__( 'Text', 'elementor' ),
				'typography_typography'  => 'custom',
				'typography_font_family' => 'Montserrat',
				'typography_font_weight' => '400',
			),
			array(
				'_id'                    => 'accent',
				'title'                  => esc_html__( 'Accent', 'elementor' ),
				'typography_typography'  => 'custom',
				'typography_font_family' => 'Cormorant Garamond',
				'typography_font_weight' => '400',
				'typography_font_style'  => 'italic',
			),
		);

		// 3. Theme Style Typography: Body
		$meta['body_color']                   = '#2c2c2c';
		$meta['body_typography_typography']   = 'custom';
		$meta['body_typography_font_family']  = 'Montserrat';
		$meta['body_typography_font_weight']  = '400';
		$meta['body_typography_line_height']  = array( 'unit' => 'em', 'size' => 1.7 );

		// 4. Theme Style Typography: Link
		$meta['link_normal_color']                  = '#2c2c2c';
		$meta['link_normal_typography_typography']  = 'custom';
		$meta['link_normal_typography_font_family'] = 'Montserrat';
		$meta['link_normal_typography_font_weight'] = '500';
		$meta['link_hover_color']                   = '#c5a047';

		// 5. Theme Style Typography: Headings H1 to H6
		foreach ( array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ) as $h ) {
			$meta[ $h . '_color' ]                   = '#0a0a0a';
			$meta[ $h . '_typography_typography' ]   = 'custom';
			$meta[ $h . '_typography_font_family' ]  = 'Libre Baskerville';
			$meta[ $h . '_typography_font_weight' ]  = '400';
			$meta[ $h . '_typography_line_height' ]  = array( 'unit' => 'em', 'size' => 1.15 );
		}

		update_post_meta( $kit_id, '_elementor_page_settings', $meta );
		update_option( 'lre_luxury_kit_initialized', '1' );

		// Clear cache and regenerate CSS
		if ( class_exists( '\Elementor\Plugin' ) ) {
			\Elementor\Plugin::$instance->files_manager->clear_cache();
			$css_file = \Elementor\Core\Files\CSS\Post::create( $kit_id );
			$css_file->update();
		}

		return true;
	}

	/**
	 * Handles manual sync request from admin url.
	 */
	public function handle_admin_actions() {
		// Auto-initialize once on first activation
		if ( ! get_option( 'lre_luxury_kit_initialized' ) ) {
			$this->sync_luxury_defaults_to_kit( false );
		}

		// Manual Sync URL trigger: ?action=lre_sync_kit&nonce=...
		if ( isset( $_GET['action'] ) && 'lre_sync_kit' === $_GET['action'] ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			check_admin_referer( 'lre_sync_kit_nonce' );
			$this->sync_luxury_defaults_to_kit( true );
			wp_safe_redirect( add_query_arg( array( 'lre_kit_synced' => '1' ), wp_get_referer() ? wp_get_referer() : admin_url() ) );
			exit;
		}
	}

	/**
	 * Displays success notice when kit is manually synced.
	 */
	public function render_admin_notice() {
		if ( isset( $_GET['lre_kit_synced'] ) && '1' === $_GET['lre_kit_synced'] ) {
			echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Luxury Real Estate HTML default palette and typography successfully synchronized into Elementor Site Settings!', 'luxury-re-widgets' ) . '</p></div>';
		}
	}
}