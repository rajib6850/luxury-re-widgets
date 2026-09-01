<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Header_Widget
 * Full Luxury Navigation Bar with 3 Modes (Transparent, White/Light, Dark),
 * Glassmorphic Sticky Header, Mega Dropdowns, and 5-Column Cinematic Side Drawer.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Header_Widget extends Widget_Base {

	public function get_name()       { return 'lre_header'; }
	public function get_title()      { return __( 'LRE — Luxury Navigation Bar', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-nav-menu'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'header', 'navbar', 'menu', 'drawer', 'transparent', 'white', 'dark', 'navigation', 'luxury', 'real estate' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── HEADER VARIATION & LAYOUT ──
		$this->start_controls_section( 'section_nav_mode', array( 'label' => __( 'Navigation Mode & Layout', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control( 'navbar_mode', array(
			'label'   => __( 'Navigation Variation', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'transparent',
			'options' => array(
				'transparent' => __( '1. Transparent (Overlay on Hero Banner)', 'luxury-re-widgets' ),
				'light'       => __( '2. White / Light Background', 'luxury-re-widgets' ),
				'dark'        => __( '3. Dark Luxury Background', 'luxury-re-widgets' ),
			),
			'description' => __( 'Select your desired navigation bar style variation.', 'luxury-re-widgets' ),
		) );

		$this->add_control( 'is_sticky', array(
			'label'        => __( 'Sticky On Scroll', 'luxury-re-widgets' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
			'description'  => __( 'Keeps the navigation bar visible at top while scrolling.', 'luxury-re-widgets' ),
		) );

		$this->end_controls_section();

		// ── BRAND LOGO ──
		$this->start_controls_section( 'section_logo', array( 'label' => __( 'Brand Logo', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control( 'logo_type', array(
			'label'   => __( 'Logo Type', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'text',
			'options' => array(
				'text'  => __( 'Text & Luxury Crest SVG', 'luxury-re-widgets' ),
				'image' => __( 'Custom Image Logo', 'luxury-re-widgets' ),
			),
		) );

		$this->add_control( 'custom_logo_image', array(
			'label'     => __( 'Logo Image', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::MEDIA,
			'condition' => array( 'logo_type' => 'image' ),
			'dynamic'   => array( 'active' => true ),
		) );

		$this->add_control( 'brand_line_1', array(
			'label'     => __( 'Brand Line 1', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => 'CRESTWOOD',
			'condition' => array( 'logo_type' => 'text' ),
			'dynamic'   => array( 'active' => true ),
		) );

		$this->add_control( 'brand_line_2', array(
			'label'     => __( 'Brand Line 2', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => '& ASSOCIATES',
			'condition' => array( 'logo_type' => 'text' ),
			'dynamic'   => array( 'active' => true ),
		) );

		$this->add_control( 'logo_link', array(
			'label'   => __( 'Logo Link URL', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::URL,
			'default' => array( 'url' => '#' ),
		) );

		$this->end_controls_section();

		// ── RIGHT INFO & CONTACT ──
		$this->start_controls_section( 'section_right_info', array( 'label' => __( 'Right Info & Contact', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control( 'show_portfolio', array( 'label' => __( 'Show Portfolio Link', 'luxury-re-widgets' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->add_control( 'portfolio_text', array( 'label' => __( 'Portfolio Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'OUR PORTFOLIO', 'condition' => array( 'show_portfolio' => 'yes' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'portfolio_link', array( 'label' => __( 'Portfolio Link', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#listings' ), 'condition' => array( 'show_portfolio' => 'yes' ) ) );

		$this->add_control( 'show_phone', array( 'label' => __( 'Show Phone Number', 'luxury-re-widgets' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'separator' => 'before' ) );
		$this->add_control( 'phone_number', array( 'label' => __( 'Phone Number', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => '310.555.8200', 'condition' => array( 'show_phone' => 'yes' ), 'dynamic' => array( 'active' => true ) ) );

		$this->add_control( 'show_avatar', array( 'label' => __( 'Show User / Agent Icon', 'luxury-re-widgets' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'separator' => 'before' ) );

		$this->add_control( 'menu_btn_text', array( 'label' => __( 'Menu Button Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'MENU', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );

		$this->end_controls_section();

		// ── SIDE DRAWER: CATEGORIES (BOXES 1 - 3) ──
		$this->start_controls_section( 'section_drawer_categories', array( 'label' => __( 'Side Drawer: Boxes 1–3', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		// Box 1: Buyers
		$this->add_control( 'drawer_box1_title', array( 'label' => __( 'Box 1 Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Buyers', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'drawer_box1_url',   array( 'label' => __( 'Box 1 URL', 'luxury-re-widgets' ),   'type' => Controls_Manager::URL,  'default' => array( 'url' => '#listings' ) ) );
		$this->add_control( 'drawer_box1_img',   array( 'label' => __( 'Box 1 Background Image', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=90&auto=format' ) ) );

		// Box 2: Sellers
		$this->add_control( 'drawer_box2_title', array( 'label' => __( 'Box 2 Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Sellers', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'drawer_box2_url',   array( 'label' => __( 'Box 2 URL', 'luxury-re-widgets' ),   'type' => Controls_Manager::URL,  'default' => array( 'url' => '#contact' ) ) );
		$this->add_control( 'drawer_box2_img',   array( 'label' => __( 'Box 2 Background Image', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1400&q=90&auto=format' ) ) );

		// Box 3: Investors
		$this->add_control( 'drawer_box3_title', array( 'label' => __( 'Box 3 Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Investors', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'drawer_box3_url',   array( 'label' => __( 'Box 3 URL', 'luxury-re-widgets' ),   'type' => Controls_Manager::URL,  'default' => array( 'url' => '#services' ) ) );
		$this->add_control( 'drawer_box3_img',   array( 'label' => __( 'Box 3 Background Image', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1400&q=90&auto=format' ) ) );

		$this->end_controls_section();

		// ── SIDE DRAWER: NEIGHBORHOODS (BOX 4) ──
		$this->start_controls_section( 'section_drawer_box4', array( 'label' => __( 'Side Drawer: Box 4 (Neighborhoods)', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control( 'drawer_box4_title', array( 'label' => __( 'Column Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Neighborhoods', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'drawer_box4_img',   array( 'label' => __( 'Background Image', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1600&q=90&auto=format' ) ) );

		$rep4 = new Repeater();
		$rep4->add_control( 'link_text', array( 'label' => __( 'Link Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Pacific Palisades', 'dynamic' => array( 'active' => true ) ) );
		$rep4->add_control( 'link_url',  array( 'label' => __( 'Link URL', 'luxury-re-widgets' ),   'type' => Controls_Manager::URL,  'default' => array( 'url' => '#communities' ) ) );

		$this->add_control( 'drawer_box4_links', array(
			'label'       => __( 'Neighborhood Links', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep4->get_controls(),
			'default'     => array(
				array( 'link_text' => 'Pacific Palisades', 'link_url' => array( 'url' => '#communities' ) ),
				array( 'link_text' => 'Bel Air',           'link_url' => array( 'url' => '#communities' ) ),
				array( 'link_text' => 'Brentwood',         'link_url' => array( 'url' => '#communities' ) ),
				array( 'link_text' => 'Malibu',            'link_url' => array( 'url' => '#communities' ) ),
				array( 'link_text' => 'Holmby Hills',      'link_url' => array( 'url' => '#communities' ) ),
				array( 'link_text' => 'Beverly Hills',     'link_url' => array( 'url' => '#communities' ) ),
			),
			'title_field' => '{{{ link_text }}}',
		) );

		$this->add_control( 'drawer_box4_btn_text', array( 'label' => __( 'Button Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Find Your Neighborhood', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'drawer_box4_btn_url',  array( 'label' => __( 'Button Link URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#communities' ) ) );

		$this->end_controls_section();

		// ── SIDE DRAWER: ABOUT US (BOX 5) ──
		$this->start_controls_section( 'section_drawer_box5', array( 'label' => __( 'Side Drawer: Box 5 (About Us)', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control( 'drawer_box5_title', array( 'label' => __( 'Column Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'About Us', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'drawer_box5_img',   array( 'label' => __( 'Background Image', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1600&q=90&auto=format' ) ) );

		$rep5 = new Repeater();
		$rep5->add_control( 'link_text', array( 'label' => __( 'Link Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Our Story', 'dynamic' => array( 'active' => true ) ) );
		$rep5->add_control( 'link_url',  array( 'label' => __( 'Link URL', 'luxury-re-widgets' ),   'type' => Controls_Manager::URL,  'default' => array( 'url' => '#about' ) ) );

		$this->add_control( 'drawer_box5_links', array(
			'label'       => __( 'Navigation Links', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep5->get_controls(),
			'default'     => array(
				array( 'link_text' => 'Our Story',          'link_url' => array( 'url' => '#about' ) ),
				array( 'link_text' => 'Meet The Team',       'link_url' => array( 'url' => '#about' ) ),
				array( 'link_text' => 'Featured Listings',   'link_url' => array( 'url' => '#listings' ) ),
				array( 'link_text' => 'Client Reviews',      'link_url' => array( 'url' => '#testimonial' ) ),
				array( 'link_text' => 'Connect With Us',     'link_url' => array( 'url' => '#contact' ) ),
				array( 'link_text' => 'Market Insights',     'link_url' => array( 'url' => '#services' ) ),
			),
			'title_field' => '{{{ link_text }}}',
		) );

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: NAVBAR BAR ──
		$this->start_controls_section( 'style_navbar', array( 'label' => __( 'Navbar Bar', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'navbar_bg_custom', array( 'label' => __( 'Custom Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .navbar' => 'background: {{VALUE}} !important;' ) ) );
		$this->add_control( 'navbar_scrolled_bg', array( 'label' => __( 'Scrolled / Sticky Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .navbar.scrolled' => 'background: {{VALUE}} !important;' ) ) );
		$this->add_control( 'phone_color', array( 'label' => __( 'Phone Number Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'default' => '#c5a047', 'selectors' => array( '{{WRAPPER}} .navbar__phone' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'avatar_bg', array( 'label' => __( 'Avatar Icon Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'default' => '#c5a047', 'selectors' => array( '{{WRAPPER}} .navbar__avatar' => 'background: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: MENU BUTTON ──
		$this->start_controls_section( 'style_menu_btn', array( 'label' => __( 'Menu Button (Top Right)', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'menu_btn_typography', 'label' => __( 'Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .navbar__menu-btn' ) );
		
		$this->start_controls_tabs( 'tabs_menu_btn_style' );
			$this->start_controls_tab( 'tab_menu_btn_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control( 'menu_btn_color', array( 'label' => __( 'Text & Hamburger Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .navbar__menu-btn' => 'color: {{VALUE}} !important;' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_menu_btn_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'menu_btn_color_hover', array( 'label' => __( 'Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'default' => '#c5a047', 'selectors' => array( '{{WRAPPER}} .navbar__menu-btn:hover' => 'color: {{VALUE}} !important;' ) ) );
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// ── STYLE: LEFT LINKS ──
		$this->start_controls_section( 'style_links', array( 'label' => __( 'Left Navigation Links', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_nav_links' );
			$this->start_controls_tab( 'tab_nav_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'nav_typography', 'selector' => '{{WRAPPER}} .navbar__link, {{WRAPPER}} .navbar__info' ) );
			$this->add_control( 'nav_link_color', array( 'label' => __( 'Link Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .navbar__link, {{WRAPPER}} .navbar__info' => 'color: {{VALUE}} !important;' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_nav_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'nav_link_color_hover', array( 'label' => __( 'Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .navbar__link:hover, {{WRAPPER}} .navbar__info:hover' => 'color: {{VALUE}} !important;' ) ) );
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$mode         = $settings['navbar_mode'] ?? 'transparent';
		$is_sticky    = 'yes' === ( $settings['is_sticky'] ?? 'yes' );
		$sticky_class = $is_sticky ? ' navbar--sticky' : ' navbar--static';
		$header_class = 'site-header site-header--' . esc_attr( $mode ) . ( $is_sticky ? ' site-header--sticky' : '' );

		$logo_url    = ! empty( $settings['logo_link']['url'] ) ? $settings['logo_link']['url'] : '#';
		$logo_target = ! empty( $settings['logo_link']['is_external'] ) ? '_blank' : '_self';

		// Drawer Box Images
		$b1_img = ! empty( $settings['drawer_box1_img']['url'] ) ? $settings['drawer_box1_img']['url'] : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=90&auto=format';
		if ( empty( $b1_img ) && ! empty( $settings['drawer_box1_img']['id'] ) ) {
			$b1_img = wp_get_attachment_image_url( $settings['drawer_box1_img']['id'], 'full' );
		}

		$b2_img = ! empty( $settings['drawer_box2_img']['url'] ) ? $settings['drawer_box2_img']['url'] : 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1400&q=90&auto=format';
		if ( empty( $b2_img ) && ! empty( $settings['drawer_box2_img']['id'] ) ) {
			$b2_img = wp_get_attachment_image_url( $settings['drawer_box2_img']['id'], 'full' );
		}

		$b3_img = ! empty( $settings['drawer_box3_img']['url'] ) ? $settings['drawer_box3_img']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1400&q=90&auto=format';
		if ( empty( $b3_img ) && ! empty( $settings['drawer_box3_img']['id'] ) ) {
			$b3_img = wp_get_attachment_image_url( $settings['drawer_box3_img']['id'], 'full' );
		}

		$b4_img = ! empty( $settings['drawer_box4_img']['url'] ) ? $settings['drawer_box4_img']['url'] : 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1600&q=90&auto=format';
		if ( empty( $b4_img ) && ! empty( $settings['drawer_box4_img']['id'] ) ) {
			$b4_img = wp_get_attachment_image_url( $settings['drawer_box4_img']['id'], 'full' );
		}

		$b5_img = ! empty( $settings['drawer_box5_img']['url'] ) ? $settings['drawer_box5_img']['url'] : 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1600&q=90&auto=format';
		if ( empty( $b5_img ) && ! empty( $settings['drawer_box5_img']['id'] ) ) {
			$b5_img = wp_get_attachment_image_url( $settings['drawer_box5_img']['id'], 'full' );
		}
		?>
		<header class="<?php echo esc_attr( $header_class ); ?>" role="banner">
			<nav class="navbar navbar--<?php echo esc_attr( $mode . $sticky_class ); ?>" id="navbar" aria-label="<?php esc_attr_e( 'Main navigation', 'luxury-re-widgets' ); ?>">
				<!-- Left Nav Links with Luxury Mega Dropdowns -->
				<div class="navbar__left">
					<div class="navbar__dropdown">
						<a href="#contact" class="navbar__link" aria-haspopup="true" aria-expanded="false">
							<?php esc_html_e( 'Selling', 'luxury-re-widgets' ); ?>
							<svg class="chevron" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg>
						</a>
						<div class="navbar__submenu">
							<a href="#contact" class="navbar__submenu-link"><?php esc_html_e( 'Seller\'s Guide', 'luxury-re-widgets' ); ?></a>
							<a href="#about" class="navbar__submenu-link"><?php esc_html_e( 'Home Valuation', 'luxury-re-widgets' ); ?></a>
							<div class="navbar__submenu-divider"></div>
							<a href="#listings" class="navbar__submenu-link"><?php esc_html_e( 'Recent Sales', 'luxury-re-widgets' ); ?></a>
							<a href="#testimonial" class="navbar__submenu-link"><?php esc_html_e( 'Seller Testimonials', 'luxury-re-widgets' ); ?></a>
						</div>
					</div>

					<div class="navbar__dropdown">
						<a href="#listings" class="navbar__link" aria-haspopup="true" aria-expanded="false">
							<?php esc_html_e( 'Buying', 'luxury-re-widgets' ); ?>
							<svg class="chevron" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg>
						</a>
						<div class="navbar__submenu">
							<a href="#listings" class="navbar__submenu-link"><?php esc_html_e( 'Featured Listings', 'luxury-re-widgets' ); ?></a>
							<a href="#listings" class="navbar__submenu-link"><?php esc_html_e( 'Buyer\'s Guide', 'luxury-re-widgets' ); ?></a>
							<div class="navbar__submenu-divider"></div>
							<a href="#contact" class="navbar__submenu-link"><?php esc_html_e( 'Off-Market Access', 'luxury-re-widgets' ); ?></a>
							<a href="#communities" class="navbar__submenu-link"><?php esc_html_e( 'Mortgage Calculator', 'luxury-re-widgets' ); ?></a>
						</div>
					</div>

					<a href="#communities" class="navbar__link"><?php esc_html_e( 'Communities', 'luxury-re-widgets' ); ?></a>

					<div class="navbar__dropdown">
						<a href="#about" class="navbar__link" aria-haspopup="true" aria-expanded="false">
							<?php esc_html_e( 'About', 'luxury-re-widgets' ); ?>
							<svg class="chevron" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg>
						</a>
						<div class="navbar__submenu">
							<a href="#about" class="navbar__submenu-link"><?php esc_html_e( 'Our Story', 'luxury-re-widgets' ); ?></a>
							<a href="#about" class="navbar__submenu-link"><?php esc_html_e( 'Meet the Team', 'luxury-re-widgets' ); ?></a>
							<div class="navbar__submenu-divider"></div>
							<a href="#services" class="navbar__submenu-link"><?php esc_html_e( 'Our Services', 'luxury-re-widgets' ); ?></a>
							<a href="#testimonial" class="navbar__submenu-link"><?php esc_html_e( 'Client Reviews', 'luxury-re-widgets' ); ?></a>
							<a href="#contact" class="navbar__submenu-link"><?php esc_html_e( 'Press & Media', 'luxury-re-widgets' ); ?></a>
						</div>
					</div>
				</div>

				<!-- Center Brand Logo -->
				<div class="navbar__center">
					<a href="<?php echo esc_url( $logo_url ); ?>" target="<?php echo esc_attr( $logo_target ); ?>" class="navbar__logo" aria-label="<?php esc_attr_e( 'Homepage', 'luxury-re-widgets' ); ?>">
						<?php if ( 'image' === $settings['logo_type'] && ! empty( $settings['custom_logo_image']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $settings['custom_logo_image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="navbar__logo-img">
						<?php else : ?>
							<svg class="navbar__logo-icon" viewBox="0 0 40 48" fill="currentColor">
								<rect x="2" y="2" width="36" height="4" rx="1"/>
								<rect x="6" y="8" width="5" height="30" rx="1"/>
								<rect x="17.5" y="8" width="5" height="30" rx="1"/>
								<rect x="29" y="8" width="5" height="30" rx="1"/>
								<rect x="2" y="40" width="36" height="4" rx="1"/>
								<line x1="0" y1="46" x2="40" y2="46" stroke="currentColor" stroke-width="2"/>
							</svg>
							<div class="navbar__logo-text">
								<span><?php echo esc_html( $settings['brand_line_1'] ); ?></span>
								<span><?php echo esc_html( $settings['brand_line_2'] ); ?></span>
							</div>
						<?php endif; ?>
					</a>
				</div>

				<!-- Right Info & Menu Button -->
				<div class="navbar__right">
					<?php if ( 'yes' === $settings['show_portfolio'] && ! empty( $settings['portfolio_text'] ) ) : ?>
					<a href="<?php echo esc_url( $settings['portfolio_link']['url'] ?? '#listings' ); ?>" class="navbar__info">
						<?php echo esc_html( $settings['portfolio_text'] ); ?>
					</a>
					<?php endif; ?>

					<?php if ( 'yes' === $settings['show_phone'] && ! empty( $settings['phone_number'] ) ) : ?>
					<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $settings['phone_number'] ) ); ?>" class="navbar__phone">
						<?php echo esc_html( $settings['phone_number'] ); ?>
					</a>
					<?php endif; ?>

					<?php if ( 'yes' === $settings['show_avatar'] ) : ?>
					<div class="navbar__avatar" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.33 0-10 1.67-10 5v2h20v-2c0-3.33-6.67-5-10-5z"/></svg>
					</div>
					<?php endif; ?>

					<button class="navbar__menu-btn" id="menu-open-btn" aria-label="<?php esc_attr_e( 'Open navigation menu', 'luxury-re-widgets' ); ?>" aria-expanded="false" aria-controls="side-menu">
						<div class="hamburger" aria-hidden="true">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<?php echo esc_html( $settings['menu_btn_text'] ); ?>
					</button>
				</div>
			</nav>

			<!-- Fullscreen Side Menu -->
			<div class="side-menu" id="side-menu" role="dialog" aria-label="<?php esc_attr_e( 'Navigation menu', 'luxury-re-widgets' ); ?>" aria-hidden="true">
				<button class="side-menu__close" id="menu-close-btn" aria-label="<?php esc_attr_e( 'Close navigation menu', 'luxury-re-widgets' ); ?>">
					<span class="side-menu__close-icon">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M8 8l8 8M16 8l-8 8"/></svg>
					</span>
					<?php esc_html_e( 'Close', 'luxury-re-widgets' ); ?>
				</button>

				<div class="side-menu__columns">
					<!-- Box 1 -->
					<div class="side-menu__box" data-delay="1">
						<div class="side-menu__box-bg">
							<img src="<?php echo esc_url( $b1_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box1_title'] ); ?>" loading="lazy">
						</div>
						<div class="side-menu__box-overlay"></div>
						<div class="side-menu__box-content side-menu__box-content--bottom">
							<a href="<?php echo esc_url( $settings['drawer_box1_url']['url'] ?? '#listings' ); ?>" class="side-menu__category-link">
								<?php echo esc_html( $settings['drawer_box1_title'] ); ?>
							</a>
						</div>
					</div>

					<!-- Box 2 -->
					<div class="side-menu__box" data-delay="2">
						<div class="side-menu__box-bg">
							<img src="<?php echo esc_url( $b2_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box2_title'] ); ?>" loading="lazy">
						</div>
						<div class="side-menu__box-overlay"></div>
						<div class="side-menu__box-content side-menu__box-content--bottom">
							<a href="<?php echo esc_url( $settings['drawer_box2_url']['url'] ?? '#contact' ); ?>" class="side-menu__category-link">
								<?php echo esc_html( $settings['drawer_box2_title'] ); ?>
							</a>
						</div>
					</div>

					<!-- Box 3 -->
					<div class="side-menu__box" data-delay="3">
						<div class="side-menu__box-bg">
							<img src="<?php echo esc_url( $b3_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box3_title'] ); ?>" loading="lazy">
						</div>
						<div class="side-menu__box-overlay"></div>
						<div class="side-menu__box-content side-menu__box-content--bottom">
							<a href="<?php echo esc_url( $settings['drawer_box3_url']['url'] ?? '#services' ); ?>" class="side-menu__category-link">
								<?php echo esc_html( $settings['drawer_box3_title'] ); ?>
							</a>
						</div>
					</div>

					<!-- Box 4 (Neighborhoods) -->
					<div class="side-menu__box side-menu__box--wide" data-delay="4">
						<div class="side-menu__box-bg">
							<img src="<?php echo esc_url( $b4_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box4_title'] ); ?>" loading="lazy">
						</div>
						<div class="side-menu__box-overlay"></div>
						<div class="side-menu__box-content side-menu__box-content--center">
							<?php if ( ! empty( $settings['drawer_box4_title'] ) ) : ?>
							<h3 class="side-menu__col-title"><?php echo esc_html( $settings['drawer_box4_title'] ); ?></h3>
							<?php endif; ?>

							<?php if ( ! empty( $settings['drawer_box4_links'] ) ) : ?>
							<div class="side-menu__links">
								<?php foreach ( $settings['drawer_box4_links'] as $item ) :
									$t = ! empty( $item['link_text'] ) ? $item['link_text'] : '';
									$u = ! empty( $item['link_url']['url'] ) ? $item['link_url']['url'] : '#';
									if ( $t ) :
								?>
								<a href="<?php echo esc_url( $u ); ?>" class="side-menu__link"><?php echo esc_html( $t ); ?></a>
								<?php endif; endforeach; ?>
							</div>
							<?php endif; ?>

							<?php if ( ! empty( $settings['drawer_box4_btn_text'] ) ) : ?>
							<a href="<?php echo esc_url( $settings['drawer_box4_btn_url']['url'] ?? '#communities' ); ?>" class="side-menu__find-btn btn" style="text-decoration: none; display: inline-block;">
								<?php echo esc_html( $settings['drawer_box4_btn_text'] ); ?>
							</a>
							<?php endif; ?>
						</div>
					</div>

					<!-- Box 5 (About Us) -->
					<div class="side-menu__box side-menu__box--wide" data-delay="5">
						<div class="side-menu__box-bg">
							<img src="<?php echo esc_url( $b5_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box5_title'] ); ?>" loading="lazy">
						</div>
						<div class="side-menu__box-overlay"></div>
						<div class="side-menu__box-content side-menu__box-content--center">
							<?php if ( ! empty( $settings['drawer_box5_title'] ) ) : ?>
							<h3 class="side-menu__col-title"><?php echo esc_html( $settings['drawer_box5_title'] ); ?></h3>
							<?php endif; ?>

							<?php if ( ! empty( $settings['drawer_box5_links'] ) ) : ?>
							<div class="side-menu__links">
								<?php foreach ( $settings['drawer_box5_links'] as $item ) :
									$t = ! empty( $item['link_text'] ) ? $item['link_text'] : '';
									$u = ! empty( $item['link_url']['url'] ) ? $item['link_url']['url'] : '#';
									if ( $t ) :
								?>
								<a href="<?php echo esc_url( $u ); ?>" class="side-menu__link"><?php echo esc_html( $t ); ?></a>
								<?php endif; endforeach; ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</header>
		<?php
	}
}