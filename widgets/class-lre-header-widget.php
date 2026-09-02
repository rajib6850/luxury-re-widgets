<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Header_Widget
 * Full Luxury Navigation Bar with 3 Modes (Transparent, White/Light, Dark),
 * WordPress Menu Integration, Dynamic Repeater for Right Info/Contact,
 * Dynamic Repeater for 5-Column Side Drawer, Dual Mobile Menu (Drawer vs Dropdown),
 * and Full Elementor Global System Controls.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Header_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_header';
	}

	public function get_title() {
		return __( 'LRE — Luxury Navigation Bar', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'header', 'navbar', 'menu', 'drawer', 'transparent', 'white', 'dark', 'navigation', 'luxury', 'real estate', 'mobile' );
	}

	/**
	 * Retrieve list of WordPress registered menus.
	 *
	 * @return array
	 */
	protected function get_wp_menus_options() {
		$menus   = wp_get_nav_menus();
		$options = array(
			'' => esc_html__( '— Select a WordPress Menu —', 'luxury-re-widgets' ),
		);
		if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
			foreach ( $menus as $menu ) {
				$options[ (string) $menu->term_id ] = $menu->name;
			}
		}
		return $options;
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── HEADER VARIATION & LAYOUT ──
		$this->start_controls_section(
			'section_nav_mode',
			array(
				'label' => __( 'Navigation Mode & Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'navbar_mode',
			array(
				'label'       => __( 'Navigation Variation', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'transparent',
				'options'     => array(
					'transparent' => __( '1. Transparent (Overlay on Hero Banner)', 'luxury-re-widgets' ),
					'light'       => __( '2. White / Light Background', 'luxury-re-widgets' ),
					'dark'        => __( '3. Dark Luxury Background', 'luxury-re-widgets' ),
				),
				'description' => __( 'Select your desired navigation bar style variation.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'is_sticky',
			array(
				'label'        => __( 'Sticky On Scroll', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'description'  => __( 'Keeps the navigation bar visible at top while scrolling.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'mobile_menu_type',
			array(
				'label'       => __( 'Mobile Menu Type', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'drawer',
				'options'     => array(
					'drawer'   => __( '1. Fullscreen Cinematic Side Drawer (Default)', 'luxury-re-widgets' ),
					'dropdown' => __( '2. Classic Mobile Slide-Down Dropdown', 'luxury-re-widgets' ),
				),
				'description' => __( 'Choose how navigation appears on mobile devices when menu button is clicked.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// ── MAIN NAVIGATION MENU ──
		$this->start_controls_section(
			'section_menu',
			array(
				'label' => __( 'Main Navigation Menu', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$wp_menus = $this->get_wp_menus_options();
		$default_menu = '';
		$menu_keys = array_keys( $wp_menus );
		if ( count( $menu_keys ) > 1 ) {
			$default_menu = (string) $menu_keys[1];
		}

		$this->add_control(
			'wp_menu_id',
			array(
				'label'       => __( 'Select WordPress Menu', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => $wp_menus,
				'default'     => $default_menu,
				'description' => __( 'Select a menu created in Appearance > Menus. Sub-items will automatically render as luxury dropdowns.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// ── BRAND LOGO ──
		$this->start_controls_section(
			'section_logo',
			array(
				'label' => __( 'Brand Logo', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'logo_type',
			array(
				'label'   => __( 'Logo Type', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'  => __( 'Text & Luxury Crest SVG', 'luxury-re-widgets' ),
					'image' => __( 'Custom Image Logo', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'custom_logo_image',
			array(
				'label'     => __( 'Logo Image', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array( 'logo_type' => 'image' ),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'brand_line_1',
			array(
				'label'     => __( 'Brand Line 1', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'CRESTWOOD',
				'condition' => array( 'logo_type' => 'text' ),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'brand_line_2',
			array(
				'label'     => __( 'Brand Line 2', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '& ASSOCIATES',
				'condition' => array( 'logo_type' => 'text' ),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'logo_link',
			array(
				'label'   => __( 'Logo Link URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->end_controls_section();

		// ── RIGHT CONTACT & INFO ITEMS (REPEATER) ──
		$this->start_controls_section(
			'section_right_items',
			array(
				'label' => __( 'Right Info & Contact Items', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$rep_right = new Repeater();

		$rep_right->add_control(
			'item_type',
			array(
				'label'   => __( 'Item Type', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'   => __( 'Text Link (e.g. Portfolio)', 'luxury-re-widgets' ),
					'phone'  => __( 'Phone Number (Click to Call)', 'luxury-re-widgets' ),
					'email'  => __( 'Email Address', 'luxury-re-widgets' ),
					'avatar' => __( 'Avatar / Account Profile Icon', 'luxury-re-widgets' ),
					'button' => __( 'CTA Button', 'luxury-re-widgets' ),
				),
			)
		);

		$rep_right->add_control(
			'item_text',
			array(
				'label'     => __( 'Label / Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Our Portfolio',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'item_type!' => array( 'avatar' ),
				),
			)
		);

		$rep_right->add_control(
			'item_link',
			array(
				'label'   => __( 'Link URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$rep_right->add_control(
			'item_icon',
			array(
				'label' => __( 'Custom Icon (Optional)', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

		$this->add_control(
			'right_items',
			array(
				'label'       => __( 'Contact & Action Items', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $rep_right->get_controls(),
				'default'     => array(
					array(
						'item_type' => 'text',
						'item_text' => 'Our Portfolio',
						'item_link' => array( 'url' => '#listings' ),
					),
					array(
						'item_type' => 'phone',
						'item_text' => '310.555.8200',
						'item_link' => array( 'url' => 'tel:3105558200' ),
					),
					array(
						'item_type' => 'avatar',
						'item_text' => '',
						'item_link' => array( 'url' => '#contact' ),
					),
				),
				'title_field' => '{{{ item_type.toUpperCase() }}}: {{{ item_text }}}',
			)
		);

		$this->add_control(
			'menu_btn_text',
			array(
				'label'     => __( 'Menu Button Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'MENU',
				'separator' => 'before',
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SIDE DRAWER MENU (DYNAMIC REPEATER BOXES) ──
		$this->start_controls_section(
			'section_drawer_boxes',
			array(
				'label' => __( 'Side Drawer Menu Boxes', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$rep_drawer = new Repeater();

		$rep_drawer->add_control(
			'box_type',
			array(
				'label'   => __( 'Box Layout Type', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => array(
					'category'   => __( 'Category Link (Large Italic Serif)', 'luxury-re-widgets' ),
					'links_list' => __( 'Links List (Column Title + Links + Button)', 'luxury-re-widgets' ),
				),
			)
		);

		$rep_drawer->add_control(
			'box_title',
			array(
				'label'   => __( 'Box Title / Column Heading', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Category Name',
				'dynamic' => array( 'active' => true ),
			)
		);

		$rep_drawer->add_control(
			'box_img',
			array(
				'label'   => __( 'Background Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=90&auto=format',
				),
			)
		);

		$rep_drawer->add_control(
			'box_width',
			array(
				'label'   => __( 'Column Width Ratio', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => array(
					'standard' => __( 'Standard (1x flex)', 'luxury-re-widgets' ),
					'wide'     => __( 'Wide (1.4x flex - Recommended for links)', 'luxury-re-widgets' ),
				),
			)
		);

		$rep_drawer->add_control(
			'category_url',
			array(
				'label'     => __( 'Link URL', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::URL,
				'default'   => array( 'url' => '#listings' ),
				'condition' => array( 'box_type' => 'category' ),
			)
		);

		$rep_drawer->add_control(
			'category_sub',
			array(
				'label'     => __( 'Optional Subtitle / Tagline', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array( 'box_type' => 'category' ),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$rep_drawer->add_control(
			'column_links',
			array(
				'label'       => __( 'Navigation Links (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => "Pacific Palisades | #communities\nBel Air | #communities\nBrentwood | #communities\nMalibu | #communities\nHolmby Hills | #communities\nBeverly Hills | #communities",
				'description' => __( 'Enter one link per line in format: Label | URL', 'luxury-re-widgets' ),
				'condition'   => array( 'box_type' => 'links_list' ),
			)
		);

		$rep_drawer->add_control(
			'btn_text',
			array(
				'label'     => __( 'Bottom Button Text (Optional)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Find Your Neighborhood',
				'separator' => 'before',
				'condition' => array( 'box_type' => 'links_list' ),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$rep_drawer->add_control(
			'btn_url',
			array(
				'label'     => __( 'Button Link URL', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::URL,
				'default'   => array( 'url' => '#communities' ),
				'condition' => array( 'box_type' => 'links_list' ),
			)
		);

		$this->add_control(
			'drawer_boxes',
			array(
				'label'       => __( 'Drawer Column Boxes', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $rep_drawer->get_controls(),
				'default'     => array(
					array(
						'box_type'     => 'category',
						'box_title'    => 'Buyers',
						'box_img'      => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=90&auto=format' ),
						'box_width'    => 'standard',
						'category_url' => array( 'url' => '#listings' ),
					),
					array(
						'box_type'     => 'category',
						'box_title'    => 'Sellers',
						'box_img'      => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1400&q=90&auto=format' ),
						'box_width'    => 'standard',
						'category_url' => array( 'url' => '#contact' ),
					),
					array(
						'box_type'     => 'category',
						'box_title'    => 'Investors',
						'box_img'      => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1400&q=90&auto=format' ),
						'box_width'    => 'standard',
						'category_url' => array( 'url' => '#services' ),
					),
					array(
						'box_type'     => 'links_list',
						'box_title'    => 'Neighborhoods',
						'box_img'      => array( 'url' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1600&q=90&auto=format' ),
						'box_width'    => 'wide',
						'column_links' => "Pacific Palisades | #communities\nBel Air | #communities\nBrentwood | #communities\nMalibu | #communities\nHolmby Hills | #communities\nBeverly Hills | #communities",
						'btn_text'     => 'Find Your Neighborhood',
						'btn_url'      => array( 'url' => '#communities' ),
					),
					array(
						'box_type'     => 'links_list',
						'box_title'    => 'About Us',
						'box_img'      => array( 'url' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1600&q=90&auto=format' ),
						'box_width'    => 'wide',
						'column_links' => "Our Story | #about\nMeet The Team | #about\nFeatured Listings | #listings\nClient Reviews | #testimonial\nConnect With Us | #contact\nMarket Insights | #services",
						'btn_text'     => '',
						'btn_url'      => array( 'url' => '#' ),
					),
				),
				'title_field' => '{{{ box_title }}} ({{{ box_type }}})',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: NAVBAR CONTAINER ──
		$this->start_controls_section(
			'style_navbar',
			array(
				'label' => __( 'Navbar Bar', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'navbar_bg_custom',
			array(
				'label'     => __( 'Custom Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .navbar' => 'background: {{VALUE}} !important;' ),
			)
		);

		$this->add_control(
			'navbar_scrolled_bg',
			array(
				'label'     => __( 'Scrolled / Sticky Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .navbar.scrolled' => 'background: {{VALUE}} !important;' ),
			)
		);

		$this->add_responsive_control(
			'navbar_height',
			array(
				'label'      => __( 'Navbar Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 60, 'max' => 140 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .navbar' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: MAIN NAVIGATION LINKS ──
		$this->start_controls_section(
			'style_nav_links',
			array(
				'label' => __( 'Main Navigation Links', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'nav_typography',
				'selector' => '{{WRAPPER}} .navbar a.navbar__link, {{WRAPPER}} .navbar .navbar__link',
			)
		);

		$this->add_responsive_control(
			'nav_links_gap',
			array(
				'label'      => __( 'Links Spacing / Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'rem', 'px' ),
				'range'      => array(
					'rem' => array( 'min' => 0.5, 'max' => 4, 'step' => 0.1 ),
					'px'  => array( 'min' => 8, 'max' => 60 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .navbar__left' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_nav_links_style' );

		$this->start_controls_tab(
			'tab_nav_links_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'nav_link_color',
			array(
				'label'     => __( 'Link Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .navbar a.navbar__link, {{WRAPPER}} .navbar .navbar__link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_nav_links_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'nav_link_color_hover',
			array(
				'label'     => __( 'Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .navbar a.navbar__link:hover, {{WRAPPER}} .navbar .navbar__dropdown:hover > a.navbar__link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'nav_underline_color',
			array(
				'label'     => __( 'Underline Indicator Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .navbar__link::after' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// ── STYLE: DROPDOWN MENUS ──
		$this->start_controls_section(
			'style_dropdown_menu',
			array(
				'label' => __( 'Dropdown Menus', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'dropdown_bg',
			array(
				'label'     => __( 'Dropdown Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(12, 12, 16, 0.96)',
				'selectors' => array(
					'{{WRAPPER}} .navbar__submenu' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'dropdown_typography',
				'selector' => '{{WRAPPER}} .navbar__submenu a.navbar__submenu-link',
			)
		);

		$this->add_control(
			'dropdown_link_color',
			array(
				'label'     => __( 'Link Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.82)',
				'selectors' => array(
					'{{WRAPPER}} .navbar__submenu a.navbar__submenu-link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'dropdown_link_hover_color',
			array(
				'label'     => __( 'Link Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d4b565',
				'selectors' => array(
					'{{WRAPPER}} .navbar__submenu a.navbar__submenu-link:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'dropdown_link_hover_bg',
			array(
				'label'     => __( 'Link Hover Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.06)',
				'selectors' => array(
					'{{WRAPPER}} .navbar__submenu a.navbar__submenu-link:hover' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'dropdown_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.12)',
				'selectors' => array(
					'{{WRAPPER}} .navbar__submenu' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'dropdown_divider_color',
			array(
				'label'     => __( 'Divider Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.08)',
				'selectors' => array(
					'{{WRAPPER}} .navbar__submenu-divider' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: RIGHT INFO & CONTACT ITEMS ──
		$this->start_controls_section(
			'style_right_items_section',
			array(
				'label' => __( 'Right Info & Contact Items', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'right_items_gap',
			array(
				'label'      => __( 'Items Spacing / Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'rem', 'px' ),
				'range'      => array(
					'rem' => array( 'min' => 0.5, 'max' => 4, 'step' => 0.1 ),
					'px'  => array( 'min' => 8, 'max' => 60 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .navbar__right' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'right_text_typography',
				'label'    => __( 'Text Link Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .navbar a.navbar__info, {{WRAPPER}} .navbar .navbar__info',
			)
		);

		$this->add_control(
			'right_text_color',
			array(
				'label'     => __( 'Text Link Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .navbar a.navbar__info, {{WRAPPER}} .navbar .navbar__info' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'right_text_hover_color',
			array(
				'label'     => __( 'Text Link Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .navbar a.navbar__info:hover, {{WRAPPER}} .navbar .navbar__info:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'phone_color',
			array(
				'label'     => __( 'Phone Number Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .navbar a.navbar__phone, {{WRAPPER}} .navbar .navbar__phone' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'avatar_bg',
			array(
				'label'     => __( 'Avatar Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .navbar__avatar' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'avatar_icon_color',
			array(
				'label'     => __( 'Avatar Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .navbar__avatar svg' => 'color: {{VALUE}} !important; fill: currentColor;',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: MENU BUTTON (TOP RIGHT) ──
		$this->start_controls_section(
			'style_menu_btn',
			array(
				'label' => __( 'Menu Button (Top Right)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'menu_btn_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .navbar__menu-btn',
			)
		);

		$this->start_controls_tabs( 'tabs_menu_btn_style' );

		$this->start_controls_tab(
			'tab_menu_btn_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'menu_btn_color',
			array(
				'label'     => __( 'Button Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .navbar__menu-btn' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_btn_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'menu_btn_color_hover',
			array(
				'label'     => __( 'Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .navbar__menu-btn:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// ── STYLE: SIDE DRAWER MENU ──
		$this->start_controls_section(
			'style_side_drawer',
			array(
				'label' => __( 'Side Drawer Menu', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'drawer_bg',
			array(
				'label'     => __( 'Drawer Backdrop Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0c10',
				'selectors' => array(
					'{{WRAPPER}} .side-menu' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'drawer_title_typography',
				'label'    => __( 'Box Titles Typography (All Boxes)', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .side-menu a.side-menu__category-link, {{WRAPPER}} .side-menu h3.side-menu__col-title, {{WRAPPER}} .side-menu .side-menu__category-link, {{WRAPPER}} .side-menu .side-menu__col-title',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'drawer_cat_typography',
				'label'    => __( 'Category Title Typography (Override)', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .side-menu a.side-menu__category-link',
			)
		);

		$this->add_control(
			'drawer_cat_color',
			array(
				'label'     => __( 'Category Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__category-link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'drawer_cat_hover_color',
			array(
				'label'     => __( 'Category Title Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__category-link:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'drawer_col_typography',
				'label'    => __( 'Column Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .side-menu h3.side-menu__col-title',
			)
		);

		$this->add_control(
			'drawer_col_color',
			array(
				'label'     => __( 'Column Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .side-menu h3.side-menu__col-title' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'drawer_links_typography',
				'label'    => __( 'Sub-Links Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .side-menu a.side-menu__link',
			)
		);

		$this->add_control(
			'drawer_links_color',
			array(
				'label'     => __( 'Sub-Links Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.75)',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'drawer_links_hover_color',
			array(
				'label'     => __( 'Sub-Links Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__link:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'heading_drawer_find_btn',
			array(
				'label'     => __( 'Find Button Style', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_drawer_btn_style' );

		// Normal
		$this->start_controls_tab(
			'tab_drawer_btn_normal',
			array(
				'label' => __( 'Normal', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'drawer_btn_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__find-btn, {{WRAPPER}} .side-menu a.side-menu__find-btn span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'drawer_btn_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'transparent',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__find-btn' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'drawer_btn_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.35)',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__find-btn' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		// Hover
		$this->start_controls_tab(
			'tab_drawer_btn_hover',
			array(
				'label' => __( 'Hover', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'drawer_btn_hover_text_color',
			array(
				'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0c0c10',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__find-btn:hover, {{WRAPPER}} .side-menu a.side-menu__find-btn:hover span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'drawer_btn_hover_bg_color',
			array(
				'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__find-btn:hover' => 'background-color: {{VALUE}} !important; background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'drawer_btn_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .side-menu a.side-menu__find-btn:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'drawer_close_color',
			array(
				'label'     => __( 'Close Button Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .side-menu__close' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'drawer_close_hover_color',
			array(
				'label'     => __( 'Close Button Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .side-menu__close:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: MOBILE DROPDOWN (CLASSIC ACCORDION) ──
		$this->start_controls_section(
			'style_mobile_dropdown',
			array(
				'label'     => __( 'Mobile Dropdown Menu', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'mobile_menu_type' => 'dropdown' ),
			)
		);

		$this->add_control(
			'mobile_dropdown_bg',
			array(
				'label'     => __( 'Menu Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0f1117',
				'selectors' => array(
					'{{WRAPPER}} .navbar__mobile-dropdown' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'mobile_link_color',
			array(
				'label'     => __( 'Mobile Link Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .navbar__mobile-link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'mobile_link_active_color',
			array(
				'label'     => __( 'Active / Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .navbar__mobile-link:hover, {{WRAPPER}} .navbar__mobile-link.active' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'mobile_toggle_icon_color',
			array(
				'label'     => __( 'Toggle Arrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.7)',
				'selectors' => array(
					'{{WRAPPER}} .navbar__mobile-toggle' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'mobile_toggle_icon_active_color',
			array(
				'label'     => __( 'Toggle Arrow Active Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .navbar__mobile-item.open .navbar__mobile-toggle, {{WRAPPER}} .navbar__mobile-toggle:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'mobile_sub_bg',
			array(
				'label'     => __( 'Submenu Container Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.35)',
				'selectors' => array(
					'{{WRAPPER}} .navbar__mobile-sub' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render dynamic WordPress menu.
	 *
	 * @param int|string $menu_id Menu ID.
	 */
	protected function render_wp_menu( $menu_id ) {
		if ( empty( $menu_id ) ) {
			$menus = wp_get_nav_menus();
			if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
				$menu_id = $menus[0]->term_id;
			}
		}

		if ( empty( $menu_id ) ) {
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo '<div class="navbar__left"><span style="color: rgba(255,255,255,0.6); font-size: 0.7rem; letter-spacing: 1px; text-transform: uppercase;">' . esc_html__( 'Please select a menu in Widget Settings', 'luxury-re-widgets' ) . '</span></div>';
			}
			return;
		}

		$items = wp_get_nav_menu_items( (int) $menu_id );
		if ( empty( $items ) || is_wp_error( $items ) ) {
			$items = wp_get_nav_menu_items( $menu_id );
		}
		if ( empty( $items ) || is_wp_error( $items ) ) {
			return;
		}

		// Build parent => children tree
		$tree = array();
		foreach ( $items as $item ) {
			$parent = (int) $item->menu_item_parent;
			if ( ! isset( $tree[ $parent ] ) ) {
				$tree[ $parent ] = array();
			}
			$tree[ $parent ][] = $item;
		}

		$top_items = $tree[0] ?? array();
		if ( empty( $top_items ) ) {
			return;
		}

		echo '<div class="navbar__left">';
		foreach ( $top_items as $item ) {
			$has_children = ! empty( $tree[ $item->ID ] );
			$url          = ! empty( $item->url ) ? $item->url : '#';
			$target       = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$clean_title  = esc_html( html_entity_decode( $item->title, ENT_QUOTES, 'UTF-8' ) );

			if ( $has_children ) {
				echo '<div class="navbar__dropdown">';
				echo '<a href="' . esc_url( $url ) . '"' . $target . ' class="navbar__link" aria-haspopup="true" aria-expanded="false">';
				echo $clean_title;
				echo '<svg class="chevron" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg>';
				echo '</a>';

				echo '<div class="navbar__submenu">';
				foreach ( $tree[ $item->ID ] as $sub_item ) {
					$sub_url         = ! empty( $sub_item->url ) ? $sub_item->url : '#';
					$sub_target      = ! empty( $sub_item->target ) ? ' target="' . esc_attr( $sub_item->target ) . '"' : '';
					$clean_sub_title = esc_html( html_entity_decode( $sub_item->title, ENT_QUOTES, 'UTF-8' ) );
					echo '<a href="' . esc_url( $sub_url ) . '"' . $sub_target . ' class="navbar__submenu-link">' . $clean_sub_title . '</a>';
				}
				echo '</div>';
				echo '</div>';
			} else {
				echo '<a href="' . esc_url( $url ) . '"' . $target . ' class="navbar__link">' . $clean_title . '</a>';
			}
		}
		echo '</div>';
	}

	/**
	 * Render classic mobile dropdown menu.
	 *
	 * @param array $settings Widget settings.
	 */
	protected function render_mobile_dropdown( $settings ) {
		$wp_menu_id = $settings['wp_menu_id'] ?? '';
		if ( empty( $wp_menu_id ) ) {
			$menus = wp_get_nav_menus();
			if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
				$wp_menu_id = $menus[0]->term_id;
			}
		}
		if ( empty( $wp_menu_id ) ) {
			return;
		}

		$items = wp_get_nav_menu_items( (int) $wp_menu_id );
		if ( empty( $items ) || is_wp_error( $items ) ) {
			$items = wp_get_nav_menu_items( $wp_menu_id );
		}
		if ( empty( $items ) || is_wp_error( $items ) ) {
			return;
		}

		$tree = array();
		foreach ( $items as $it ) {
			$p = (int) $it->menu_item_parent;
			if ( ! isset( $tree[ $p ] ) ) {
				$tree[ $p ] = array();
			}
			$tree[ $p ][] = $it;
		}

		$top_items = $tree[0] ?? array();
		if ( empty( $top_items ) ) {
			return;
		}
		?>
		<div class="navbar__mobile-dropdown" id="navbar-mobile-dropdown" aria-hidden="true">
			<div class="navbar__mobile-nav">
				<?php
				foreach ( $top_items as $top ) {
					$has_sub         = ! empty( $tree[ $top->ID ] );
					$u               = ! empty( $top->url ) ? $top->url : '#';
					$clean_top_title = esc_html( html_entity_decode( $top->title, ENT_QUOTES, 'UTF-8' ) );

					echo '<div class="navbar__mobile-item' . ( $has_sub ? ' has-children' : '' ) . '">';
					echo '<a href="' . esc_url( $u ) . '" class="navbar__mobile-link">' . $clean_top_title . '</a>';
					if ( $has_sub ) {
						echo '<button class="navbar__mobile-toggle" aria-label="' . esc_attr__( 'Toggle submenu', 'luxury-re-widgets' ) . '" style="background:transparent!important;background-color:transparent!important;border:none!important;box-shadow:none!important;outline:none!important;"><svg viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg></button>';
						echo '<div class="navbar__mobile-sub">';
						foreach ( $tree[ $top->ID ] as $sub ) {
							$su               = ! empty( $sub->url ) ? $sub->url : '#';
							$clean_m_sub_title = esc_html( html_entity_decode( $sub->title, ENT_QUOTES, 'UTF-8' ) );
							echo '<a href="' . esc_url( $su ) . '" class="navbar__mobile-sublink">' . $clean_m_sub_title . '</a>';
						}
						echo '</div>';
					}
					echo '</div>';
				}
				?>
			</div>
		</div>
		<?php
	}

	protected function render() {
		$settings         = $this->get_settings_for_display();
		$mode             = $settings['navbar_mode'] ?? 'transparent';
		$is_sticky        = 'yes' === ( $settings['is_sticky'] ?? 'yes' );
		$sticky_class     = $is_sticky ? ' navbar--sticky' : ' navbar--static';
		$mobile_menu_type = $settings['mobile_menu_type'] ?? 'drawer';
		$header_class     = 'site-header site-header--' . esc_attr( $mode ) . ( $is_sticky ? ' site-header--sticky' : '' ) . ' mobile-type--' . esc_attr( $mobile_menu_type );

		$logo_url    = ! empty( $settings['logo_link']['url'] ) ? $settings['logo_link']['url'] : '#';
		$logo_target = ! empty( $settings['logo_link']['is_external'] ) ? '_blank' : '_self';
		
		$wp_menu_id  = $settings['wp_menu_id'] ?? '';
		?>
		<header class="<?php echo esc_attr( $header_class ); ?>" role="banner" data-mobile-type="<?php echo esc_attr( $mobile_menu_type ); ?>">
			<nav class="navbar navbar--<?php echo esc_attr( $mode . $sticky_class ); ?>" id="navbar" aria-label="<?php esc_attr_e( 'Main navigation', 'luxury-re-widgets' ); ?>">
				
				<!-- Left Nav Links with Luxury Mega Dropdowns -->
				<?php
				$this->render_wp_menu( $wp_menu_id );
				?>

				<!-- Center Brand Logo -->
				<div class="navbar__center">
					<a href="<?php echo esc_url( $logo_url ); ?>" target="<?php echo esc_attr( $logo_target ); ?>" class="navbar__logo" aria-label="<?php esc_attr_e( 'Homepage', 'luxury-re-widgets' ); ?>">
						<?php if ( 'image' === ( $settings['logo_type'] ?? 'text' ) && ! empty( $settings['custom_logo_image']['url'] ) ) : ?>
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
								<span><?php echo esc_html( $settings['brand_line_1'] ?? 'CRESTWOOD' ); ?></span>
								<span><?php echo esc_html( $settings['brand_line_2'] ?? '& ASSOCIATES' ); ?></span>
							</div>
						<?php endif; ?>
					</a>
				</div>

				<!-- Right Info & Menu Button -->
				<div class="navbar__right">
					<?php
					$right_items = $settings['right_items'] ?? array();
					if ( ! empty( $right_items ) && is_array( $right_items ) ) {
						foreach ( $right_items as $item ) {
							$type   = $item['item_type'] ?? 'text';
							$text   = $item['item_text'] ?? '';
							$url    = ! empty( $item['item_link']['url'] ) ? $item['item_link']['url'] : '#';
							$target = ! empty( $item['item_link']['is_external'] ) ? '_blank' : '_self';

							if ( 'phone' === $type ) {
								$clean_phone = preg_replace( '/[^0-9+]/', '', $text );
								echo '<a href="tel:' . esc_attr( $clean_phone ) . '" class="navbar__phone">';
								if ( ! empty( $item['item_icon']['value'] ) ) {
									\Elementor\Icons_Manager::render_icon( $item['item_icon'], array( 'aria-hidden' => 'true' ) );
									echo ' ';
								}
								echo esc_html( $text );
								echo '</a>';
							} elseif ( 'email' === $type ) {
								echo '<a href="mailto:' . esc_attr( $text ) . '" class="navbar__info navbar__email">';
								if ( ! empty( $item['item_icon']['value'] ) ) {
									\Elementor\Icons_Manager::render_icon( $item['item_icon'], array( 'aria-hidden' => 'true' ) );
									echo ' ';
								}
								echo esc_html( $text );
								echo '</a>';
							} elseif ( 'avatar' === $type ) {
								echo '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '" class="navbar__avatar" aria-label="' . esc_attr__( 'Account', 'luxury-re-widgets' ) . '">';
								if ( ! empty( $item['item_icon']['value'] ) ) {
									\Elementor\Icons_Manager::render_icon( $item['item_icon'], array( 'aria-hidden' => 'true' ) );
								} else {
									echo '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.33 0-10 1.67-10 5v2h20v-2c0-3.33-6.67-5-10-5z"/></svg>';
								}
								echo '</a>';
							} elseif ( 'button' === $type ) {
								echo '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '" class="btn btn--outline-white navbar__btn" style="padding: 0.5rem 1.2rem; font-size: 0.65rem; text-decoration: none;">';
								if ( ! empty( $item['item_icon']['value'] ) ) {
									\Elementor\Icons_Manager::render_icon( $item['item_icon'], array( 'aria-hidden' => 'true' ) );
									echo ' ';
								}
								echo esc_html( $text );
								echo '</a>';
							} else {
								// Standard text link
								echo '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '" class="navbar__info">';
								if ( ! empty( $item['item_icon']['value'] ) ) {
									\Elementor\Icons_Manager::render_icon( $item['item_icon'], array( 'aria-hidden' => 'true' ) );
									echo ' ';
								}
								echo esc_html( $text );
								echo '</a>';
							}
						}
					} else {
						// Backward compatibility fallback
						if ( 'yes' === ( $settings['show_portfolio'] ?? 'yes' ) && ! empty( $settings['portfolio_text'] ) ) {
							echo '<a href="' . esc_url( $settings['portfolio_link']['url'] ?? '#listings' ) . '" class="navbar__info">' . esc_html( $settings['portfolio_text'] ) . '</a>';
						}
						if ( 'yes' === ( $settings['show_phone'] ?? 'yes' ) && ! empty( $settings['phone_number'] ) ) {
							echo '<a href="tel:' . esc_attr( preg_replace( '/[^0-9+]/', '', $settings['phone_number'] ) ) . '" class="navbar__phone">' . esc_html( $settings['phone_number'] ) . '</a>';
						}
						if ( 'yes' === ( $settings['show_avatar'] ?? 'yes' ) ) {
							echo '<div class="navbar__avatar" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.33 0-10 1.67-10 5v2h20v-2c0-3.33-6.67-5-10-5z"/></svg></div>';
						}
					}
					?>

					<button class="navbar__menu-btn" id="menu-open-btn" aria-label="<?php esc_attr_e( 'Open navigation menu', 'luxury-re-widgets' ); ?>" aria-expanded="false" aria-controls="side-menu">
						<div class="hamburger" aria-hidden="true">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<?php echo esc_html( $settings['menu_btn_text'] ?? 'MENU' ); ?>
					</button>
				</div>
			</nav>

			<?php
			// Render mobile classic dropdown if enabled
			if ( 'dropdown' === $mobile_menu_type ) {
				$this->render_mobile_dropdown( $settings );
			}
			?>

			<!-- Fullscreen Side Drawer Menu -->
			<div class="side-menu" id="side-menu" role="dialog" aria-label="<?php esc_attr_e( 'Navigation menu', 'luxury-re-widgets' ); ?>" aria-hidden="true">
				<button class="side-menu__close" id="menu-close-btn" aria-label="<?php esc_attr_e( 'Close navigation menu', 'luxury-re-widgets' ); ?>">
					<span class="side-menu__close-icon">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M8 8l8 8M16 8l-8 8"/></svg>
					</span>
					<?php esc_html_e( 'Close', 'luxury-re-widgets' ); ?>
				</button>

				<div class="side-menu__columns">
					<?php
					$drawer_boxes = $settings['drawer_boxes'] ?? array();

					// If repeater has items, render dynamically
					if ( ! empty( $drawer_boxes ) && is_array( $drawer_boxes ) ) {
						$box_index = 0;
						foreach ( $drawer_boxes as $box ) {
							$box_index++;
							$box_type  = $box['box_type'] ?? 'category';
							$box_title = $box['box_title'] ?? '';
							$box_width = $box['box_width'] ?? 'standard';
							$wide_cls  = ( 'wide' === $box_width ) ? ' side-menu__box--wide' : '';

							$img_url = ! empty( $box['box_img']['url'] ) ? $box['box_img']['url'] : '';
							if ( empty( $img_url ) && ! empty( $box['box_img']['id'] ) ) {
								$img_url = wp_get_attachment_image_url( $box['box_img']['id'], 'full' );
							}
							if ( empty( $img_url ) ) {
								$img_url = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1400&q=90&auto=format';
							}

							echo '<div class="side-menu__box' . esc_attr( $wide_cls ) . '" data-delay="' . esc_attr( $box_index ) . '">';
							echo '<div class="side-menu__box-bg"><img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $box_title ) . '" loading="lazy"></div>';
							echo '<div class="side-menu__box-overlay"></div>';

							if ( 'category' === $box_type ) {
								$cat_url = ! empty( $box['category_url']['url'] ) ? $box['category_url']['url'] : '#';
								$cat_tar = ! empty( $box['category_url']['is_external'] ) ? '_blank' : '_self';
								echo '<div class="side-menu__box-content side-menu__box-content--bottom">';
								echo '<a href="' . esc_url( $cat_url ) . '" target="' . esc_attr( $cat_tar ) . '" class="side-menu__category-link">';
								echo esc_html( $box_title );
								if ( ! empty( $box['category_sub'] ) ) {
									echo '<span class="side-menu__category-sub">' . esc_html( $box['category_sub'] ) . '</span>';
								}
								echo '</a>';
								echo '</div>';
							} else {
								// Links list box
								echo '<div class="side-menu__box-content side-menu__box-content--center">';
								if ( ! empty( $box_title ) ) {
									echo '<h3 class="side-menu__col-title">' . esc_html( $box_title ) . '</h3>';
								}

								$raw_links = $box['column_links'] ?? '';
								if ( ! empty( $raw_links ) ) {
									$lines = explode( "\n", str_replace( "\r", '', $raw_links ) );
									echo '<div class="side-menu__links">';
									foreach ( $lines as $line ) {
										$line = trim( $line );
										if ( empty( $line ) ) {
											continue;
										}
										$parts = explode( '|', $line );
										$l_text = trim( $parts[0] ?? '' );
										$l_url  = trim( $parts[1] ?? '#' );
										if ( ! empty( $l_text ) ) {
											echo '<a href="' . esc_url( $l_url ) . '" class="side-menu__link">' . esc_html( $l_text ) . '</a>';
										}
									}
									echo '</div>';
								}

								if ( ! empty( $box['btn_text'] ) ) {
									$b_url = ! empty( $box['btn_url']['url'] ) ? $box['btn_url']['url'] : '#';
									$b_tar = ! empty( $box['btn_url']['is_external'] ) ? '_blank' : '_self';
									echo '<a href="' . esc_url( $b_url ) . '" target="' . esc_attr( $b_tar ) . '" class="side-menu__find-btn"><span>' . esc_html( $box['btn_text'] ) . '</span></a>';
								}

								echo '</div>';
							}

							echo '</div>';
						}
					} else {
						// Backward compatibility fallback for legacy Box 1 to 5
						$b1_img = ! empty( $settings['drawer_box1_img']['url'] ) ? $settings['drawer_box1_img']['url'] : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=90&auto=format';
						$b2_img = ! empty( $settings['drawer_box2_img']['url'] ) ? $settings['drawer_box2_img']['url'] : 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1400&q=90&auto=format';
						$b3_img = ! empty( $settings['drawer_box3_img']['url'] ) ? $settings['drawer_box3_img']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1400&q=90&auto=format';
						$b4_img = ! empty( $settings['drawer_box4_img']['url'] ) ? $settings['drawer_box4_img']['url'] : 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1600&q=90&auto=format';
						$b5_img = ! empty( $settings['drawer_box5_img']['url'] ) ? $settings['drawer_box5_img']['url'] : 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1600&q=90&auto=format';
						?>
						<div class="side-menu__box" data-delay="1">
							<div class="side-menu__box-bg"><img src="<?php echo esc_url( $b1_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box1_title'] ?? 'Buyers' ); ?>" loading="lazy"></div>
							<div class="side-menu__box-overlay"></div>
							<div class="side-menu__box-content side-menu__box-content--bottom">
								<a href="<?php echo esc_url( $settings['drawer_box1_url']['url'] ?? '#listings' ); ?>" class="side-menu__category-link"><?php echo esc_html( $settings['drawer_box1_title'] ?? 'Buyers' ); ?></a>
							</div>
						</div>
						<div class="side-menu__box" data-delay="2">
							<div class="side-menu__box-bg"><img src="<?php echo esc_url( $b2_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box2_title'] ?? 'Sellers' ); ?>" loading="lazy"></div>
							<div class="side-menu__box-overlay"></div>
							<div class="side-menu__box-content side-menu__box-content--bottom">
								<a href="<?php echo esc_url( $settings['drawer_box2_url']['url'] ?? '#contact' ); ?>" class="side-menu__category-link"><?php echo esc_html( $settings['drawer_box2_title'] ?? 'Sellers' ); ?></a>
							</div>
						</div>
						<div class="side-menu__box" data-delay="3">
							<div class="side-menu__box-bg"><img src="<?php echo esc_url( $b3_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box3_title'] ?? 'Investors' ); ?>" loading="lazy"></div>
							<div class="side-menu__box-overlay"></div>
							<div class="side-menu__box-content side-menu__box-content--bottom">
								<a href="<?php echo esc_url( $settings['drawer_box3_url']['url'] ?? '#services' ); ?>" class="side-menu__category-link"><?php echo esc_html( $settings['drawer_box3_title'] ?? 'Investors' ); ?></a>
							</div>
						</div>
						<div class="side-menu__box side-menu__box--wide" data-delay="4">
							<div class="side-menu__box-bg"><img src="<?php echo esc_url( $b4_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box4_title'] ?? 'Neighborhoods' ); ?>" loading="lazy"></div>
							<div class="side-menu__box-overlay"></div>
							<div class="side-menu__box-content side-menu__box-content--center">
								<h3 class="side-menu__col-title"><?php echo esc_html( $settings['drawer_box4_title'] ?? 'Neighborhoods' ); ?></h3>
								<div class="side-menu__links">
									<a href="#communities" class="side-menu__link">Pacific Palisades</a>
									<a href="#communities" class="side-menu__link">Bel Air</a>
									<a href="#communities" class="side-menu__link">Brentwood</a>
									<a href="#communities" class="side-menu__link">Malibu</a>
									<a href="#communities" class="side-menu__link">Holmby Hills</a>
									<a href="#communities" class="side-menu__link">Beverly Hills</a>
								</div>
								<a href="#communities" class="side-menu__find-btn"><span>Find Your Neighborhood</span></a>
							</div>
						</div>
						<div class="side-menu__box side-menu__box--wide" data-delay="5">
							<div class="side-menu__box-bg"><img src="<?php echo esc_url( $b5_img ); ?>" alt="<?php echo esc_attr( $settings['drawer_box5_title'] ?? 'About Us' ); ?>" loading="lazy"></div>
							<div class="side-menu__box-overlay"></div>
							<div class="side-menu__box-content side-menu__box-content--center">
								<h3 class="side-menu__col-title"><?php echo esc_html( $settings['drawer_box5_title'] ?? 'About Us' ); ?></h3>
								<div class="side-menu__links">
									<a href="#about" class="side-menu__link">Our Story</a>
									<a href="#about" class="side-menu__link">Meet The Team</a>
									<a href="#listings" class="side-menu__link">Featured Listings</a>
									<a href="#testimonial" class="side-menu__link">Client Reviews</a>
									<a href="#contact" class="side-menu__link">Connect With Us</a>
									<a href="#services" class="side-menu__link">Market Insights</a>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</header>
		<?php
	}
}
