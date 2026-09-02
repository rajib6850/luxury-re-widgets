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
}