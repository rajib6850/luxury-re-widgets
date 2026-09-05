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

/* ─── UNIVERSAL ANTI-THEME PINK & ACCENT OVERRIDE ─── */
[class*="lre-"] button,
[class*="lre-"] [type="button"],
[class*="lre-"] [type="submit"],
[class*="lre-"] a,
[class*="elementor-widget-lre_"] button,
[class*="elementor-widget-lre_"] [type="button"],
[class*="elementor-widget-lre_"] a {
  color: inherit !important;
  text-decoration: none !important;
}

[class*="lre-"] button:focus,
[class*="lre-"] button:hover,
[class*="lre-"] [type="button"]:focus,
[class*="lre-"] [type="button"]:hover,
[class*="elementor-widget-lre_"] button:focus,
[class*="elementor-widget-lre_"] button:hover,
[class*="elementor-widget-lre_"] [type="button"]:focus,
[class*="elementor-widget-lre_"] [type="button"]:hover {
  outline: none !important;
  box-shadow: none !important;
}

/* ─── GLOBAL RESPONSIVE CONTAINER SYSTEM (ALL WIDGETS & SECTIONS) ─── */
.container,
.container--wide,
.lre-story__container,
.lre-team__container,
.lre-aserv__container,
.lre-reviews__container {
  width: 100% !important;
  max-width: 1320px !important;
  margin-left: auto !important;
  margin-right: auto !important;
  padding-left: 2rem !important;
  padding-right: 2rem !important;
  box-sizing: border-box !important;
}

.container--wide {
  max-width: 1440px !important;
}

@media (max-width: 1199px) {
  .container,
  .container--wide,
  .lre-story__container,
  .lre-team__container,
  .lre-aserv__container,
  .lre-reviews__container {
    padding-left: 1.75rem !important;
    padding-right: 1.75rem !important;
  }
}

@media (max-width: 991px) {
  .container,
  .container--wide,
  .lre-story__container,
  .lre-team__container,
  .lre-aserv__container,
  .lre-reviews__container {
    padding-left: 1.5rem !important;
    padding-right: 1.5rem !important;
  }
}

@media (max-width: 767px) {
  .container,
  .container--wide,
  .lre-story__container,
  .lre-team__container,
  .lre-aserv__container,
  .lre-reviews__container {
    padding-left: 1.25rem !important;
    padding-right: 1.25rem !important;
  }
}

@media (max-width: 480px) {
  .container,
  .container--wide,
  .lre-story__container,
  .lre-team__container,
  .lre-aserv__container,
  .lre-reviews__container {
    padding-left: 1rem !important;
    padding-right: 1rem !important;
  }
}

/* Headings font family inherits from primary global typography */
.hero__title,
.lre-phero__title,
.about__title,
.lre-story__title,
.lre-aserv__title,
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
.lre-phero__title,
[class*="elementor-kit-"] .hero__title,
[class*="elementor-kit-"] .lre-phero__title {
  color: #ffffff !important;
  margin-top: 0 !important;
  margin-bottom: 1.2rem !important;
  text-shadow: none !important;
  box-shadow: none !important;
  filter: none !important;
}

.hero__title .hero-mask,
.hero__title .hero-mask > span,
.lre-phero__title .phero-mask,
.lre-phero__title .phero-mask > span,
[class*="elementor-kit-"] .hero__title .hero-mask,
[class*="elementor-kit-"] .hero__title .hero-mask > span,
[class*="elementor-kit-"] .lre-phero__title .phero-mask,
[class*="elementor-kit-"] .lre-phero__title .phero-mask > span {
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
.lre-story .btn,
.lre-aserv .btn,
.lre-aserv__card-action .btn,
.listings__cta-group .btn,
.cta__buttons .btn,
.side-menu__find-btn {
  font-family: var(--font-sans, "Montserrat", sans-serif);
  font-size: 0.65rem;
  font-weight: 600;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  line-height: 1;
  padding: 0.85rem 1.8rem;
  border-width: 1px;
  border-style: solid;
  border-radius: 0;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  box-sizing: border-box;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  vertical-align: middle;
  white-space: nowrap;
  transition: color 0.4s ease, border-color 0.4s ease, background 0.4s ease;
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

/* 1. Hero & Dark Section Buttons (.btn--outline-white / lre-aserv) - Default White Hover */
.hero__cta-group .btn,
.hero__cta-group a.btn,
.lre-aserv .btn,
.lre-aserv a.btn,
.lre-aserv__mono-action .btn,
.lre-aserv__btn {
  color: #ffffff !important;
  background: transparent !important;
  background-color: transparent !important;
  border-color: rgba(255, 255, 255, 0.4) !important;
  --btn-hover-bg: #ffffff !important;
}

.hero__cta-group .btn span,
.hero__cta-group a.btn span,
.lre-aserv .btn span,
.lre-aserv a.btn span,
.lre-aserv__mono-action .btn span,
.lre-aserv__btn span {
  color: #ffffff !important;
  transition: color 0.4s ease !important;
}

.hero__cta-group .btn svg,
.hero__cta-group a.btn svg,
.lre-aserv .btn svg,
.lre-aserv a.btn svg,
.lre-aserv__mono-action .btn svg,
.lre-aserv__btn svg {
  stroke: #ffffff !important;
  transition: stroke 0.4s ease, transform 0.35s ease !important;
}

.hero__cta-group .btn::before,
.lre-aserv .btn::before,
.lre-aserv a.btn::before,
.lre-aserv__mono-action .btn::before,
.lre-aserv__btn::before {
  background: #ffffff !important;
  background-color: #ffffff !important;
}

.hero__cta-group .btn:hover,
.hero__cta-group a.btn:hover,
.lre-aserv .btn:hover,
.lre-aserv a.btn:hover,
.lre-aserv__mono-action .btn:hover,
.lre-aserv__btn:hover {
  color: #0a0a0a !important;
  border-color: #ffffff !important;
  background: #ffffff !important;
  background-color: #ffffff !important;
}

.hero__cta-group .btn:hover span,
.hero__cta-group a.btn:hover span,
.lre-aserv .btn:hover span,
.lre-aserv a.btn:hover span,
.lre-aserv__mono-action .btn:hover span,
.lre-aserv__btn:hover span,
.cta__buttons .btn:hover span,
.cta__buttons a.btn:hover span,
.lre-comm-spotlight__action .btn:hover span,
.lre-comm-spotlight__action a.btn:hover span,
.lre-comm-no-results .btn:hover span,
.lre-comm-no-results a.btn:hover span {
  color: #0a0a0a !important;
}

.hero__cta-group .btn:hover svg,
.hero__cta-group a.btn:hover svg,
.lre-aserv .btn:hover svg,
.lre-aserv a.btn:hover svg,
.lre-aserv__mono-action .btn:hover svg,
.lre-aserv__btn:hover svg,
.lre-comm-spotlight__action .btn:hover svg,
.lre-comm-spotlight__action a.btn:hover svg {
  stroke: #0a0a0a !important;
  transform: translateX(5px) !important;
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
.about__text .btn,
.lre-story .btn,
.lre-story a.btn,
.lre-story__action .btn {
  color: var(--color-dark, #0a0a0a);
  background: transparent;
  background-color: transparent;
  border-color: var(--color-dark, #0a0a0a);
}

.about .btn:hover,
.about a.btn:hover,
.about__text .btn:hover,
.lre-story .btn:hover,
.lre-story a.btn:hover,
.lre-story__action .btn:hover {
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

/* 4. CTA Banner Buttons — Ultra-Luxury Editorial Parity */
.cta__buttons {
  display: flex !important;
  gap: 1.25rem !important;
  justify-content: center !important;
  align-items: center !important;
  flex-wrap: wrap !important;
}

/* CTA Buttons 1 & 2: Refined Architectural Glass Outline (Identical Parity) */
.cta__buttons .cta__btn-1,
.cta__buttons a.cta__btn-1,
.cta__buttons .cta__btn-2,
.cta__buttons a.cta__btn-2 {
  background: rgba(255, 255, 255, 0.05) !important;
  background-color: rgba(255, 255, 255, 0.05) !important;
  backdrop-filter: blur(8px) !important;
  -webkit-backdrop-filter: blur(8px) !important;
  color: #ffffff !important;
  border: 1px solid rgba(255, 255, 255, 0.45) !important;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2) !important;
  font-weight: 500 !important;
  letter-spacing: 2px !important;
  --btn-hover-bg: #ffffff;
}

.cta__buttons .cta__btn-1 span,
.cta__buttons a.cta__btn-1 span,
.cta__buttons .cta__btn-2 span,
.cta__buttons a.cta__btn-2 span {
  color: #ffffff !important;
  font-weight: 500 !important;
  letter-spacing: 2px !important;
}

.cta__buttons .cta__btn-1::before,
.cta__buttons a.cta__btn-1::before,
.cta__buttons .cta__btn-2::before,
.cta__buttons a.cta__btn-2::before {
  background: #ffffff !important;
  background-color: #ffffff !important;
}

.cta__buttons .cta__btn-1:hover,
.cta__buttons a.cta__btn-1:hover,
.cta__buttons .cta__btn-2:hover,
.cta__buttons a.cta__btn-2:hover {
  background: #ffffff !important;
  background-color: #ffffff !important;
  border-color: #ffffff !important;
  color: #08080c !important;
  box-shadow: 0 10px 28px rgba(255, 255, 255, 0.25) !important;
  transform: translateY(-2px) !important;
}

.cta__buttons .cta__btn-1:hover span,
.cta__buttons a.cta__btn-1:hover span,
.cta__buttons .cta__btn-2:hover span,
.cta__buttons a.cta__btn-2:hover span {
  color: #08080c !important;
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

.about__title,
.lre-story__title {
  line-height: 1.25 !important;
  color: var(--color-dark);
}

.lre-aserv__title {
  line-height: 1.25 !important;
  color: #ffffff !important;
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

/* Dark section headings & descriptions must remain white on dark backgrounds */
[class*="elementor-kit-"] .hero__title,
[class*="elementor-kit-"] .lre-phero__title,
[class*="elementor-kit-"] .services__title,
[class*="elementor-kit-"] .cta__title,
[class*="elementor-kit-"] .testimonial__heading-main {
  color: #ffffff !important;
}

[class*="elementor-kit-"] .cta__description {
  color: #ffffff !important;
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
[class*="elementor-kit-"] .navbar .navbar__menu-btn,
button.navbar__menu-btn,
#menu-open-btn {
  color: #ffffff !important;
  border: none !important;
  border-width: 0 !important;
  border-style: none !important;
  background: transparent !important;
  box-shadow: none !important;
  outline: none !important;
}

.navbar .navbar__menu-btn:hover,
[class*="elementor-kit-"] .navbar .navbar__menu-btn:hover,
button.navbar__menu-btn:hover,
#menu-open-btn:hover {
  color: var(--color-secondary, #c5a047) !important;
  border: none !important;
  border-width: 0 !important;
  border-style: none !important;
  background: transparent !important;
  box-shadow: none !important;
  outline: none !important;
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

/* ─── DARK LUXURY SECTIONS: PURE WHITE TITLES & HIGH-CONTRAST TEXT GUARANTEE ─── */
.lre-reviews,
.lre-aserv,
.lre-comm-showcase,
.lre-contact,
.elementor-widget-lre_reviews,
.elementor-widget-lre_about_services,
.elementor-widget-lre_communities_showcase,
.elementor-widget-lre_contact {
  --color-text: #ffffff !important;
  --color-text-muted: rgba(255, 255, 255, 0.75) !important;
  --aserv-text: #ffffff !important;
  --rev-text: #ffffff !important;
}

.lre-reviews .lre-reviews__title,
.lre-reviews .lre-reviews__title .title-mask,
.lre-reviews .lre-reviews__title .title-mask > span,
.lre-reviews .lre-reviews__title span,
.lre-aserv .lre-aserv__title,
.lre-aserv .lre-aserv__title .title-mask,
.lre-aserv .lre-aserv__title .title-mask > span,
.lre-aserv .lre-aserv__title span,
.lre-comm-showcase .lre-comm-showcase__title,
.lre-comm-showcase .lre-comm-showcase__title .title-mask,
.lre-comm-showcase .lre-comm-showcase__title .title-mask > span,
.lre-comm-showcase .lre-comm-showcase__title span,
.lre-contact .lre-contact__title,
.lre-contact .lre-contact__title .title-mask,
.lre-contact .lre-contact__title .title-mask > span,
.lre-contact .lre-contact__title span {
  color: #ffffff !important;
  -webkit-text-fill-color: #ffffff !important;
  background: none !important;
}

.lre-reviews blockquote,
.lre-reviews .lre-reviews__quote-text,
.lre-reviews .lre-reviews__author-name,
.lre-reviews .lre-reviews__metric-val,
.lre-reviews .lre-reviews__tab-name,
.lre-aserv .lre-aserv__card-title,
.lre-aserv .lre-aserv__mono-title,
.lre-aserv .lre-aserv__mono-num {
  color: #ffffff !important;
  -webkit-text-fill-color: #ffffff !important;
}

.lre-reviews .lre-reviews__author-title,
.lre-reviews .lre-reviews__tab-tx,
.lre-reviews .lre-reviews__timing-badge,
.lre-reviews .lre-reviews__metric-lbl,
.lre-aserv .lre-aserv__desc,
.lre-aserv .lre-aserv__mono-desc,
.lre-aserv .lre-aserv__card-desc,
.lre-aserv .lre-aserv__capabilities li {
  color: rgba(255, 255, 255, 0.8) !important;
}

.lre-aserv .lre-aserv__card-cat,
.lre-aserv .lre-aserv__mono-tag {
  color: rgba(255, 255, 255, 0.7) !important;
}

/* Universal Eyebrow Gold Color Parity */
.lre-reviews .lre-reviews__eyebrow,
.lre-aserv .lre-aserv__eyebrow,
.lre-contact .lre-contact__eyebrow,
.lre-guide .lre-guide__eyebrow,
.lre-sguide .lre-sguide__eyebrow,
.lre-story .lre-story__eyebrow,
.lre-team .lre-team__eyebrow,
.lre-phero .lre-phero__eyebrow,
.lre-comm-showcase .lre-comm-showcase__eyebrow,
.cta .cta__eyebrow,
.listings .listings__eyebrow,
.about .about__eyebrow,
.communities .communities__eyebrow,
.testimonial .testimonial__eyebrow,
.services .services__eyebrow-text {
  color: var(--color-secondary, #c5a047) !important;
  -webkit-text-fill-color: var(--color-secondary, #c5a047) !important;
}

/* Gold Accents Requested by User */
.lre-reviews .lre-reviews__trust-pillar::before {
  background: linear-gradient(90deg, var(--rev-gold, #c5a047), rgba(197, 160, 71, 0.2)) !important;
}

.lre-reviews .lre-reviews__tab-btn::before,
.lre-reviews .lre-reviews__tab-btn.is-active::before {
  background: var(--rev-gold, #c5a047) !important;
}

.lre-reviews .lre-reviews__tab-btn:hover .lre-reviews__tab-arrow,
.lre-reviews .lre-reviews__tab-btn.is-active .lre-reviews__tab-arrow,
.lre-reviews .lre-reviews__tab-btn:hover .lre-reviews__tab-num,
.lre-reviews .lre-reviews__tab-btn.is-active .lre-reviews__tab-num,
.lre-reviews .lre-reviews__tab-btn:hover .lre-reviews__tab-monogram,
.lre-reviews .lre-reviews__tab-btn.is-active .lre-reviews__tab-monogram {
  color: var(--rev-gold, #c5a047) !important;
}

.lre-reviews .lre-reviews__tab-btn:hover .lre-reviews__tab-avatar,
.lre-reviews .lre-reviews__tab-btn.is-active .lre-reviews__tab-avatar {
  border-color: var(--rev-gold, #c5a047) !important;
}

.lre-reviews .lre-reviews__counter,
.lre-reviews .lre-reviews__active-num {
  color: var(--rev-gold, #c5a047) !important;
}

.lre-reviews .lre-reviews__counter-slash,
.lre-reviews .lre-reviews__total-num {
  color: rgba(197, 160, 71, 0.55) !important;
}

@media (max-width: 767px) {
  .lre-reviews {
    overflow-x: hidden !important;
  }
  .lre-reviews .lre-reviews__container,
  .lre-reviews .lre-reviews__stage,
  .lre-reviews .lre-reviews__ledger,
  .lre-reviews .lre-reviews__trust-pillar,
  .lre-reviews .lre-reviews__ledger-index,
  .lre-reviews .lre-reviews__index-items,
  .lre-reviews .lre-reviews__tab-btn,
  .lre-reviews .lre-reviews__stage-main,
  .lre-reviews .lre-reviews__dossier-card {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
    min-width: 0 !important;
  }
  .lre-reviews .lre-reviews__metrics-grid {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    width: 100% !important;
    box-sizing: border-box !important;
    gap: 0.35rem !important;
  }
  .lre-reviews .lre-reviews__metric-item {
    min-width: 0 !important;
    overflow: hidden !important;
    text-align: center !important;
  }
  .lre-reviews .lre-reviews__metric-lbl {
    word-break: normal !important;
    overflow-wrap: break-word !important;
    text-align: center !important;
  }
  .lre-reviews .lre-reviews__tab-content {
    flex: 1 1 0% !important;
    min-width: 0 !important;
    max-width: 100% !important;
    overflow: hidden !important;
  }
  .lre-reviews .lre-reviews__tab-name,
  .lre-reviews .lre-reviews__tab-tx {
    display: block !important;
    width: 100% !important;
    max-width: 100% !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
  }
  .lre-reviews .lre-reviews__seal-top,
  .lre-reviews .lre-reviews__seal-bottom {
    display: block !important;
    max-width: 100% !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
  }
}

/* ─── ELEMENTOR EDITOR PREVIEW VISIBILITY GUARANTEE ─── */
body.elementor-editor-active .reveal,
body.elementor-editor-active .reveal--left,
body.elementor-editor-active .reveal--right,
body.elementor-editor-active .reveal--zoom,
body.elementor-editor-active .title-mask,
body.elementor-editor-active .title-mask > span,
body.elementor-editor-active .lre-comm-showcase,
body.elementor-editor-active .lre-comm-showcase .reveal,
body.elementor-editor-active .lre-comm-frame,
body.elementor-editor-active .lre-comm-frame__media,
body.elementor-editor-active .lre-comm-frame__img,
body.elementor-editor-active .lre-comm-frame__link,
body.elementor-editor-active .lre-comm-frame__header,
body.elementor-editor-active .lre-comm-frame__footer,
body.elementor-editor-active .lre-comm-showcase__header,
body.elementor-editor-active .lre-comm-showcase__filter-nav,
body.elementor-editor-active .lre-comm-gallery,
body.elementor-editor-active .lre-contact,
body.elementor-editor-active .lre-contact .reveal,
body.elementor-editor-active .lre-contact__header,
body.elementor-editor-active .lre-contact__desk,
body.elementor-editor-active .lre-contact__form-wrapper,
body.elementor-editor-active .lre-contact__stage,
body.elementor-editor-active .lre-guide,
body.elementor-editor-active .lre-guide .reveal,
body.elementor-editor-active .lre-guide__header,
body.elementor-editor-active .lre-guide__roadmap,
body.elementor-editor-active .lre-guide__dossier-console,
body.elementor-editor-active .lre-sguide,
body.elementor-editor-active .lre-sguide .reveal,
body.elementor-editor-active .lre-sguide__header,
body.elementor-editor-active .lre-sguide__portals-grid,
body.elementor-editor-active .lre-sguide__milestones-section,
.elementor-editor-active .reveal,
.elementor-editor-preview .reveal,
.elementor-edit-mode .reveal,
.elementor-editor-active .title-mask > span,
.elementor-editor-preview .title-mask > span,
.elementor-edit-mode .title-mask > span,
.elementor-editor-active .lre-comm-frame,
.elementor-editor-preview .lre-comm-frame,
.elementor-edit-mode .lre-comm-frame,
.elementor-editor-active .lre-comm-frame__img,
.elementor-editor-preview .lre-comm-frame__img,
.elementor-edit-mode .lre-comm-frame__img,
.elementor-editor-active .lre-contact .reveal,
.elementor-editor-preview .lre-contact .reveal,
.elementor-edit-mode .lre-contact .reveal,
.elementor-editor-active .lre-guide .reveal,
.elementor-editor-preview .lre-guide .reveal,
.elementor-edit-mode .lre-guide .reveal,
.elementor-editor-active .lre-sguide .reveal,
.elementor-editor-preview .lre-sguide .reveal,
.elementor-edit-mode .lre-sguide .reveal {
  opacity: 1 !important;
  visibility: visible !important;
  transform: none !important;
  animation: none !important;
  transition: none !important;
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
		// Manual Sync URL trigger: ?action=lre_sync_kit&_wpnonce=...
		if ( isset( $_GET['action'] ) && 'lre_sync_kit' === $_GET['action'] ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			check_admin_referer( 'lre_sync_kit_nonce' );
			$this->sync_luxury_defaults_to_kit( true );
			wp_safe_redirect( add_query_arg( array( 'lre_kit_synced' => '1' ), wp_get_referer() ? wp_get_referer() : admin_url() ) );
			exit;
		}

		// Dismiss notice trigger: ?action=lre_dismiss_kit_notice&_wpnonce=...
		if ( isset( $_GET['action'] ) && 'lre_dismiss_kit_notice' === $_GET['action'] ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			check_admin_referer( 'lre_dismiss_kit_nonce' );
			update_option( 'lre_luxury_kit_initialized', 'dismissed' );
			wp_safe_redirect( remove_query_arg( array( 'action', '_wpnonce' ), wp_get_referer() ? wp_get_referer() : admin_url() ) );
			exit;
		}
	}

	/**
	 * Displays notice offering one-click sync or confirming successful sync.
	 */
	public function render_admin_notice() {
		if ( isset( $_GET['lre_kit_synced'] ) && '1' === $_GET['lre_kit_synced'] ) {
			echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Luxury Real Estate HTML default palette and typography successfully synchronized into Elementor Site Settings!', 'luxury-re-widgets' ) . '</p></div>';
			return;
		}

		// Prompt admin to optionally synchronize kit settings on first install
		if ( current_user_can( 'manage_options' ) && ! get_option( 'lre_luxury_kit_initialized' ) ) {
			$sync_url    = wp_nonce_url( admin_url( '?action=lre_sync_kit' ), 'lre_sync_kit_nonce' );
			$dismiss_url = wp_nonce_url( admin_url( '?action=lre_dismiss_kit_notice' ), 'lre_dismiss_kit_nonce' );
			echo '<div class="notice notice-info"><p>';
			echo '<strong>' . esc_html__( 'Luxury Real Estate Widgets:', 'luxury-re-widgets' ) . '</strong> ';
			echo esc_html__( 'Would you like to import the editorial Luxury Color Palette & Typography into your active Elementor Kit?', 'luxury-re-widgets' );
			echo ' <a href="' . esc_url( $sync_url ) . '" class="button button-primary" style="margin-left:8px;">' . esc_html__( 'Sync Luxury Design Kit', 'luxury-re-widgets' ) . '</a>';
			echo ' <a href="' . esc_url( $dismiss_url ) . '" class="button button-secondary" style="margin-left:4px;">' . esc_html__( 'No Thanks, Keep Current Kit', 'luxury-re-widgets' ) . '</a>';
			echo '</p></div>';
		}
	}
}