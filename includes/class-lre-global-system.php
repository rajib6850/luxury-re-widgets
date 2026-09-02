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

/* Headings font family inherits from primary global typography */
.hero__title,
.about__title,
.services__title,
.listings__title,
.communities__title,
.cta__title,
.footer__brand,
.testimonial__heading-main {
  font-family: var(--font-serif);
}

/* Explicit unitless line-heights and spacing to prevent squishing or overlap */
.hero__title,
[class*="elementor-kit-"] .hero__title {
  color: #ffffff !important;
  margin-top: 0 !important;
  margin-bottom: 1.2rem !important;
  text-shadow: none !important;
  box-shadow: none !important;
  filter: none !important;
}

.hero__title .hero-mask,
.hero__title .hero-mask > span,
[class*="elementor-kit-"] .hero__title .hero-mask,
[class*="elementor-kit-"] .hero__title .hero-mask > span {
  margin: 0 !important;
  padding: 0 0 0.22em 0 !important;
  line-height: inherit;
  text-shadow: none !important;
  box-shadow: none !important;
}

.hero__subtitle,
[class*="elementor-kit-"] .hero__subtitle {
  text-shadow: none !important;
  box-shadow: none !important;
}

/* ─── UNIFIED LUXURY BUTTON DESIGN SYSTEM (ALL WIDGETS) ─── */
.btn,
a.btn,
button.btn,
.hero__cta-group .btn,
.about .btn,
.about__text .btn,
.listings__cta-group .btn,
.cta__buttons .btn,
.side-menu__find-btn {
  font-family: var(--font-sans, "Montserrat", sans-serif) !important;
  font-size: 0.65rem !important;
  font-weight: 600 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  line-height: 1 !important;
  padding: 0.85rem 1.8rem !important;
  border-width: 1px !important;
  border-style: solid !important;
  border-radius: 0 !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  text-decoration: none !important;
  box-sizing: border-box !important;
  cursor: pointer !important;
  position: relative !important;
  overflow: hidden !important;
  vertical-align: middle !important;
  white-space: nowrap !important;
  transition: color 0.4s ease, border-color 0.4s ease, background 0.4s ease !important;
}

.btn span,
.btn__text,
.side-menu__find-btn span {
  position: relative !important;
  z-index: 1 !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 0.5rem !important;
  line-height: 1 !important;
  color: inherit;
}

/* 1. Hero Buttons (.btn--outline-white) - Default White Hover */
.hero__cta-group .btn,
.hero__cta-group a.btn {
  color: #ffffff;
  background: transparent;
  background-color: transparent;
  border-color: rgba(255, 255, 255, 0.5);
  --btn-hover-bg: #ffffff;
}

.hero__cta-group .btn::before {
  background: var(--btn-hover-bg, #ffffff);
}

.hero__cta-group .btn:hover,
.hero__cta-group a.btn:hover {
  color: #0a0a0a;
  border-color: #ffffff;
}

/* ─── SERVICES: ULTRA-SMOOTH HOVER TRANSITION ─── */
.service-item {
  transition: 
    background-color 0.5s cubic-bezier(0.25, 1, 0.5, 1),
    border-color 0.5s cubic-bezier(0.25, 1, 0.5, 1),
    box-shadow 0.5s cubic-bezier(0.25, 1, 0.5, 1),
    transform 0.5s cubic-bezier(0.25, 1, 0.5, 1) !important;
  will-change: transform, background-color, border-color, box-shadow;
}

.service-item::before {
  transition: transform 0.45s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.35s ease !important;
}

.service-item::after {
  transition: opacity 0.5s cubic-bezier(0.25, 1, 0.5, 1) !important;
}

.service-item__name,
.service-item__desc,
.service-item__icon {
  transition: color 0.4s ease, transform 0.45s cubic-bezier(0.25, 1, 0.5, 1) !important;
}

/* 2. About Button (.btn--outline) */
.about .btn,
.about a.btn,
.about__text .btn {
  color: var(--color-dark, #0a0a0a);
  background: transparent;
  background-color: transparent;
  border-color: var(--color-dark, #0a0a0a);
}

.about .btn:hover,
.about a.btn:hover,
.about__text .btn:hover {
  color: #ffffff;
  border-color: var(--color-dark, #0a0a0a);
  background: var(--color-dark, #0a0a0a);
  background-color: var(--color-dark, #0a0a0a);
}

/* 3. Listings / Properties Buttons (HTML Design Truth: White hover for Primary, Dark hover for Outline) */
/* Button 1: Primary (Schedule A Viewing) */
.listings__cta-group .btn--primary,
.listings__cta-group a.btn--primary,
.listings__cta-group .listings__btn-1 {
  background: var(--color-dark, #0a0a0a);
  background-color: var(--color-dark, #0a0a0a);
  color: #ffffff;
  border-color: var(--color-dark, #0a0a0a);
  --btn-hover-bg: #ffffff;
}

.listings__cta-group .btn--primary::before,
.listings__cta-group a.btn--primary::before,
.listings__cta-group .listings__btn-1::before {
  background: var(--btn-hover-bg, #ffffff);
}

.listings__cta-group .btn--primary:hover,
.listings__cta-group a.btn--primary:hover,
.listings__cta-group .listings__btn-1:hover {
  color: var(--color-dark, #0a0a0a);
  border-color: var(--color-dark, #0a0a0a);
  background: #ffffff;
  background-color: #ffffff;
}

/* Button 2: Outline (View All Properties) */
.listings__cta-group .btn--outline,
.listings__cta-group a.btn--outline,
.listings__cta-group .listings__btn-2 {
  background: transparent;
  background-color: transparent;
  color: var(--color-dark, #0a0a0a);
  border-color: var(--color-dark, #0a0a0a);
}

.listings__cta-group .btn--outline:hover,
.listings__cta-group a.btn--outline:hover,
.listings__cta-group .listings__btn-2:hover {
  color: #ffffff;
  border-color: var(--color-dark, #0a0a0a);
  background: var(--color-dark, #0a0a0a);
  background-color: var(--color-dark, #0a0a0a);
}

/* 4. CTA Banner Buttons */
.cta__buttons .btn,
.cta__buttons a.btn {
  color: #ffffff;
  background: transparent;
  background-color: transparent;
  border-color: rgba(255, 255, 255, 0.6);
}

.cta__buttons .btn:hover,
.cta__buttons a.btn:hover {
  color: #0a0a0a;
  border-color: #ffffff;
  background: #ffffff;
  background-color: #ffffff;
}

.cta__buttons .cta__btn-2:hover {
  border-color: var(--color-secondary, var(--e-global-color-secondary, #c5a047));
  background: var(--color-secondary, var(--e-global-color-secondary, #c5a047));
  background-color: var(--color-secondary, var(--e-global-color-secondary, #c5a047));
  color: #0a0a0a;
}

/* Mobile responsive sizing across all buttons */
@media (max-width: 767px) {
  .hero__cta-group .btn,
  .about .btn,
  .about__text .btn,
  .listings__cta-group .btn,
  .cta__buttons .btn {
    padding: 0.8rem 1.4rem !important;
    font-size: 0.62rem !important;
    letter-spacing: 2px !important;
    width: 100% !important;
    max-width: 320px !important;
    text-align: center !important;
    justify-content: center !important;
  }
}

.about__title {
  line-height: 1.25 !important;
  color: var(--color-dark);
}

.services__title {
  line-height: 1.2 !important;
  color: #ffffff !important;
}

.listings__title {
  line-height: 1.2 !important;
  color: var(--color-dark);
}

.communities__title {
  line-height: 1.2 !important;
  color: var(--color-dark);
}

.cta__title {
  line-height: 1.2 !important;
  color: #ffffff !important;
}

.cta__description {
  color: #ffffff !important;
  line-height: 1.85 !important;
}

.footer__brand {
  line-height: 1.2 !important;
  color: var(--color-dark);
}

.testimonial__heading-main {
  line-height: 1.2 !important;
  color: #ffffff !important;
}

.testimonial__heading-brand {
  line-height: 1.2 !important;
  color: #ffffff !important;
}

/* Dark section headings & descriptions must remain white on dark backgrounds */
[class*="elementor-kit-"] .hero__title,
[class*="elementor-kit-"] .services__title,
[class*="elementor-kit-"] .cta__title,
[class*="elementor-kit-"] .testimonial__heading-main,
[class*="elementor-kit-"] .testimonial__heading-brand {
  color: #ffffff !important;
}

[class*="elementor-kit-"] .cta__description {
  color: #ffffff !important;
}

/* Ensure title-mask spans are never clipped or translated offscreen */
.title-mask {
  overflow: visible !important;
}

.title-mask > span {
  transform: none !important;
  opacity: 1 !important;
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

/* ─── SITE HEADER / NAVBAR BULLETPROOF PROTECTION ─── */
.navbar a.navbar__link,
.navbar .navbar__link,
[class*="elementor-kit-"] .navbar a.navbar__link,
[class*="elementor-kit-"] .navbar .navbar__link {
  color: #ffffff !important;
  opacity: 0.85;
}

.navbar a.navbar__link:hover,
.navbar .navbar__link:hover,
.navbar .navbar__dropdown:hover > a.navbar__link,
.navbar .navbar__dropdown:hover > .navbar__link,
[class*="elementor-kit-"] .navbar a.navbar__link:hover,
[class*="elementor-kit-"] .navbar .navbar__dropdown:hover > a.navbar__link {
  color: var(--color-secondary, #c5a047) !important;
  opacity: 1 !important;
}

.navbar a.navbar__link .chevron,
.navbar .navbar__link .chevron,
[class*="elementor-kit-"] .navbar a.navbar__link .chevron {
  color: inherit !important;
  stroke: currentColor !important;
  opacity: 0.75;
}

.navbar a.navbar__logo,
.navbar .navbar__logo,
[class*="elementor-kit-"] .navbar a.navbar__logo,
[class*="elementor-kit-"] .navbar .navbar__logo {
  color: #ffffff !important;
}

.navbar a.navbar__logo .navbar__logo-icon,
.navbar .navbar__logo .navbar__logo-icon,
[class*="elementor-kit-"] .navbar a.navbar__logo .navbar__logo-icon {
  color: #ffffff !important;
  fill: currentColor !important;
  opacity: 0.95;
}

.navbar a.navbar__logo .navbar__logo-text,
.navbar .navbar__logo .navbar__logo-text,
.navbar .navbar__logo-text span,
[class*="elementor-kit-"] .navbar a.navbar__logo .navbar__logo-text,
[class*="elementor-kit-"] .navbar .navbar__logo-text span {
  color: #ffffff !important;
}

.navbar .navbar__logo-text span:last-child,
[class*="elementor-kit-"] .navbar .navbar__logo-text span:last-child {
  color: rgba(255, 255, 255, 0.6) !important;
}

.navbar a.navbar__info,
.navbar .navbar__info,
[class*="elementor-kit-"] .navbar a.navbar__info,
[class*="elementor-kit-"] .navbar .navbar__info {
  color: #ffffff !important;
  opacity: 0.85;
}

.navbar a.navbar__info:hover,
.navbar .navbar__info:hover,
[class*="elementor-kit-"] .navbar a.navbar__info:hover {
  color: var(--color-secondary, #c5a047) !important;
  opacity: 1 !important;
}

.navbar a.navbar__phone,
.navbar .navbar__phone,
[class*="elementor-kit-"] .navbar a.navbar__phone,
[class*="elementor-kit-"] .navbar .navbar__phone {
  color: var(--color-secondary, #c5a047) !important;
}

.navbar .navbar__menu-btn,
[class*="elementor-kit-"] .navbar .navbar__menu-btn {
  color: #ffffff !important;
}

.navbar .navbar__menu-btn:hover,
[class*="elementor-kit-"] .navbar .navbar__menu-btn:hover {
  color: var(--color-secondary, #c5a047) !important;
}

.navbar a.navbar__submenu-link,
.navbar .navbar__submenu-link,
[class*="elementor-kit-"] .navbar a.navbar__submenu-link,
[class*="elementor-kit-"] .navbar .navbar__submenu-link {
  color: rgba(255, 255, 255, 0.82) !important;
  font-family: var(--font-sans) !important;
  font-size: 0.65rem !important;
  letter-spacing: 1.5px !important;
  text-transform: uppercase !important;
}

.navbar a.navbar__submenu-link:hover,
.navbar .navbar__submenu-link:hover,
[class*="elementor-kit-"] .navbar a.navbar__submenu-link:hover,
[class*="elementor-kit-"] .navbar .navbar__submenu-link:hover {
  color: var(--color-secondary-light, #d4b565) !important;
  background: rgba(255, 255, 255, 0.06) !important;
  padding-left: 1.65rem !important;
}

/* ─── POPUP MENU (SIDE MENU DRAWER) BULLETPROOF PROTECTION ─── */
.side-menu a.side-menu__category-link,
.side-menu .side-menu__category-link,
[class*="elementor-kit-"] .side-menu a.side-menu__category-link,
[class*="elementor-kit-"] .side-menu .side-menu__category-link {
  font-family: var(--font-serif) !important;
  font-size: clamp(1.4rem, 2.2vw, 2.2rem) !important;
  font-weight: 400 !important;
  font-style: italic !important;
  color: #ffffff !important;
  text-decoration: none !important;
  letter-spacing: 0.5px !important;
  text-shadow: 0 2px 25px rgba(0, 0, 0, 0.7) !important;
  display: inline-block !important;
  transition: color 0.3s ease, transform 0.3s ease !important;
}

.side-menu a.side-menu__category-link:hover,
.side-menu .side-menu__category-link:hover,
[class*="elementor-kit-"] .side-menu a.side-menu__category-link:hover,
[class*="elementor-kit-"] .side-menu .side-menu__category-link:hover {
  color: var(--color-secondary, #c5a047) !important;
  transform: translateY(-3px) !important;
}

.side-menu .side-menu__col-title,
.side-menu h3.side-menu__col-title,
[class*="elementor-kit-"] .side-menu .side-menu__col-title,
[class*="elementor-kit-"] .side-menu h3.side-menu__col-title {
  font-family: var(--font-serif) !important;
  font-size: clamp(1.4rem, 2.2vw, 2.2rem) !important;
  color: #ffffff !important;
  margin-bottom: 1.8rem !important;
  font-weight: 400 !important;
  font-style: italic !important;
  letter-spacing: 0.5px !important;
  line-height: 1.2 !important;
  text-shadow: 0 2px 25px rgba(0, 0, 0, 0.7) !important;
}

.side-menu a.side-menu__link,
.side-menu .side-menu__link,
[class*="elementor-kit-"] .side-menu a.side-menu__link,
[class*="elementor-kit-"] .side-menu .side-menu__link {
  font-family: var(--font-sans) !important;
  font-size: 0.68rem !important;
  font-weight: 500 !important;
  letter-spacing: 2px !important;
  text-transform: uppercase !important;
  color: rgba(255, 255, 255, 0.75) !important;
  text-decoration: none !important;
  display: inline-block !important;
  text-shadow: 0 1px 10px rgba(0, 0, 0, 0.5) !important;
  transition: color 0.3s ease, letter-spacing 0.4s var(--ease-out-expo) !important;
}

.side-menu a.side-menu__link:hover,
.side-menu .side-menu__link:hover,
[class*="elementor-kit-"] .side-menu a.side-menu__link:hover,
[class*="elementor-kit-"] .side-menu .side-menu__link:hover {
  color: #ffffff !important;
  letter-spacing: 3px !important;
}

.side-menu a.side-menu__find-btn,
.side-menu .side-menu__find-btn,
[class*="elementor-kit-"] .side-menu a.side-menu__find-btn,
[class*="elementor-kit-"] .side-menu .side-menu__find-btn {
  display: inline-flex !important;
  align-items: center !important;
  gap: 0.5rem !important;
  margin-top: 1.6rem !important;
  padding: 0.7rem 1.4rem !important;
  border: 1px solid rgba(255, 255, 255, 0.35) !important;
  background: rgba(0, 0, 0, 0.25) !important;
  color: #ffffff !important;
  font-family: var(--font-sans) !important;
  font-size: 0.58rem !important;
  font-weight: 600 !important;
  letter-spacing: 2px !important;
  text-transform: uppercase !important;
  text-decoration: none !important;
  backdrop-filter: blur(4px) !important;
  -webkit-backdrop-filter: blur(4px) !important;
  transition: all 0.4s var(--ease-out-expo) !important;
}

.side-menu a.side-menu__find-btn::before,
.side-menu .side-menu__find-btn::before,
[class*="elementor-kit-"] .side-menu a.side-menu__find-btn::before {
  display: none !important;
}

.side-menu a.side-menu__find-btn span,
.side-menu .side-menu__find-btn span,
[class*="elementor-kit-"] .side-menu a.side-menu__find-btn span {
  position: relative;
  z-index: 2;
  color: inherit !important;
  transition: color 0.3s ease;
}

.side-menu a.side-menu__find-btn:hover,
.side-menu .side-menu__find-btn:hover,
[class*="elementor-kit-"] .side-menu a.side-menu__find-btn:hover,
[class*="elementor-kit-"] .side-menu .side-menu__find-btn:hover {
  border-color: #ffffff !important;
  background: #ffffff !important;
  background-color: #ffffff !important;
  color: #0a0a0a !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35) !important;
}

.side-menu a.side-menu__find-btn:hover span,
.side-menu .side-menu__find-btn:hover span,
[class*="elementor-kit-"] .side-menu a.side-menu__find-btn:hover span {
  color: #0a0a0a !important;
}

.side-menu .side-menu__close,
.side-menu button.side-menu__close,
[class*="elementor-kit-"] .side-menu .side-menu__close {
  color: #ffffff !important;
}

.side-menu .side-menu__close:hover,
.side-menu button.side-menu__close:hover,
[class*="elementor-kit-"] .side-menu .side-menu__close:hover {
  color: var(--color-secondary, #c5a047) !important;
}

/* ─── MOBILE DROPDOWN PROTECTION ─── */
.navbar__mobile-link,
[class*="elementor-kit-"] .navbar__mobile-link {
  color: #ffffff !important;
  text-decoration: none !important;
}

.navbar__mobile-sublink,
[class*="elementor-kit-"] .navbar__mobile-sublink {
  color: rgba(255, 255, 255, 0.75) !important;
  text-decoration: none !important;
}

.navbar__mobile-sublink:hover,
[class*="elementor-kit-"] .navbar__mobile-sublink:hover {
  color: var(--color-secondary, #c5a047) !important;
}

button.navbar__mobile-toggle,
.navbar__mobile-toggle,
.navbar__mobile-item .navbar__mobile-toggle,
[class*="elementor-kit-"] button.navbar__mobile-toggle,
[class*="elementor-kit-"] .navbar__mobile-toggle {
  background: transparent !important;
  background-color: transparent !important;
  border: none !important;
  border-radius: 0 !important;
  box-shadow: none !important;
  outline: none !important;
  color: rgba(255, 255, 255, 0.7) !important;
  padding: 0 !important;
  -webkit-appearance: none !important;
  appearance: none !important;
}

button.navbar__mobile-toggle:hover,
button.navbar__mobile-toggle:focus,
button.navbar__mobile-toggle:active,
.navbar__mobile-toggle:hover,
.navbar__mobile-toggle:focus,
.navbar__mobile-toggle:active,
[class*="elementor-kit-"] button.navbar__mobile-toggle:hover,
[class*="elementor-kit-"] button.navbar__mobile-toggle:focus {
  background: transparent !important;
  background-color: transparent !important;
  border: none !important;
  box-shadow: none !important;
  outline: none !important;
  color: var(--color-secondary, #c5a047) !important;
}

.navbar__mobile-item.open > button.navbar__mobile-toggle,
.navbar__mobile-item.open > .navbar__mobile-toggle,
[class*="elementor-kit-"] .navbar__mobile-item.open > button.navbar__mobile-toggle {
  background: transparent !important;
  background-color: transparent !important;
  border: none !important;
  box-shadow: none !important;
  outline: none !important;
  transform: rotate(180deg) !important;
  color: var(--color-secondary, #c5a047) !important;
}

.navbar__mobile-dropdown {
  display: none !important;
  position: fixed !important;
  top: var(--nav-height, 64px) !important;
  left: 0 !important;
  right: 0 !important;
  width: 100% !important;
  max-height: calc(100vh - var(--nav-height, 64px)) !important;
  max-height: calc(100dvh - var(--nav-height, 64px)) !important;
  z-index: 999999 !important;
  pointer-events: auto !important;
}

/* Always hide on desktop screens */
@media (min-width: 1025px) {
  .navbar__mobile-dropdown,
  .navbar__mobile-dropdown.active,
  .site-header .navbar__mobile-dropdown,
  .site-header.mobile-menu-active .navbar__mobile-dropdown {
    display: none !important;
  }
}

/* Show when active on mobile and tablet */
@media (max-width: 1024px) {
  .navbar__mobile-dropdown.active,
  .site-header.mobile-menu-active .navbar__mobile-dropdown {
    display: block !important;
  }
}

.site-header.mobile-menu-active .navbar__menu-btn .hamburger span:nth-child(1),
.navbar__menu-btn.active .hamburger span:nth-child(1) {
  transform: translateY(5.5px) rotate(45deg) !important;
}

.site-header.mobile-menu-active .navbar__menu-btn .hamburger span:nth-child(2),
.navbar__menu-btn.active .hamburger span:nth-child(2) {
  opacity: 0 !important;
  transform: scaleX(0) !important;
}

.site-header.mobile-menu-active .navbar__menu-btn .hamburger span:nth-child(3),
.navbar__menu-btn.active .hamburger span:nth-child(3) {
  transform: translateY(-5.5px) rotate(-45deg) !important;
}

/* Link typography & color reflection from Site Settings */
[class*="elementor-kit-"] a:not(.btn):not(.community-card):not(.listing-card):not(.navbar__link):not(.navbar__submenu-link):not(.navbar__logo):not(.navbar__info):not(.navbar__phone):not(.side-menu__link):not(.side-menu__category-link):not(.side-menu__find-btn) {
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

		// 4. Theme Style Typography: Link
		$meta['link_normal_color']                  = '#2c2c2c';
		$meta['link_normal_typography_typography']  = 'custom';
		$meta['link_normal_typography_font_family'] = 'Montserrat';
		$meta['link_normal_typography_font_weight'] = '500';
		$meta['link_hover_color']                   = '#c5a047';

		// 5. Theme Style Typography: Headings (Font family set, no collapsing line-heights or dark colors)
		foreach ( array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ) as $h ) {
			unset( $meta[ $h . '_color' ] );
			unset( $meta[ $h . '_typography_line_height' ] );
			$meta[ $h . '_typography_typography' ]   = 'custom';
			$meta[ $h . '_typography_font_family' ]  = 'Libre Baskerville';
			$meta[ $h . '_typography_font_weight' ]  = '400';
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