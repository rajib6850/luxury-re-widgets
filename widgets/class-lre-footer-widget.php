<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Icons_Manager;

/**
 * LRE_Footer_Widget
 * Ultra-Luxury editorial Footer matching 100% of the original design layout.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Footer_Widget extends Widget_Base {

	public function get_name()       { return 'lre_footer'; }
	public function get_title()      { return __( 'LRE — Luxury Footer', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-footer'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'footer', 'copyright', 'contact', 'social', 'legal', 'luxury' ); }

	/**
	 * Get list of available WordPress navigation menus.
	 *
	 * @return array
	 */
	protected function get_wp_menus_options() {
		$menus   = wp_get_nav_menus();
		$options = array(
			'' => esc_html__( '-- Select a WordPress Menu --', 'luxury-re-widgets' ),
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

		// --- BRAND & LOGO ---
		$this->start_controls_section( 'section_brand', array( 'label' => __( 'Brand Header & Logo', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control(
			'brand_display_type',
			array(
				'label'   => __( 'Brand Display Type', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'  => __( 'Text Only (Brand Name & Subtitle)', 'luxury-re-widgets' ),
					'image' => __( 'Logo / Image Only', 'luxury-re-widgets' ),
					'both'  => __( 'Both Logo Image & Text', 'luxury-re-widgets' ),
				),
			)
		);

		// Logo image controls
		$this->add_control(
			'brand_logo',
			array(
				'label'       => __( 'Brand Logo Image', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => array(
					'url' => '',
				),
				'description' => __( 'Upload your brand logo (PNG, SVG, JPG, WebP).', 'luxury-re-widgets' ),
				'condition'   => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_control(
			'brand_logo_link',
			array(
				'label'       => __( 'Logo Link URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-domain.com (Leave empty for no link)', 'luxury-re-widgets' ),
				'default'     => array(
					'url'         => '',
					'is_external' => false,
				),
				'condition'   => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_control(
			'brand_logo_alt',
			array(
				'label'       => __( 'Logo Alt Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'e.g. Victoria Crestwood Real Estate', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		// Text controls
		$this->add_control(
			'brand_name',
			array(
				'label'     => __( 'Brand Name', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Victoria Crestwood',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'brand_display_type' => array( 'text', 'both' ),
				),
			)
		);

		$this->add_control(
			'brand_subtitle',
			array(
				'label'     => __( 'Brand Subtitle', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '& Associates',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'brand_display_type' => array( 'text', 'both' ),
				),
			)
		);

		$this->end_controls_section();

		// --- 3-COLUMN CONTACT INFO ---
		$this->start_controls_section( 'section_contact', array( 'label' => __( '3-Column Info Grid', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		
		// Col 1
		$this->add_control( 'col1_label',   array( 'label' => __( 'Column 1 Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Phone & Email', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'phone_number', array( 'label' => __( 'Phone Number',   'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => '310.555.8200',   'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'email_addr',   array( 'label' => __( 'Email Address',  'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'hello@crestwoodassociates.com', 'dynamic' => array( 'active' => true ) ) );

		// Col 2
		$this->add_control( 'col2_label', array( 'label' => __( 'Column 2 Label (DRE / Socials)', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'DRE #. 01987456', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );

		$rep_social = new Repeater();

		$rep_social->add_control(
			'social_title',
			array(
				'label'       => __( 'Platform / Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Instagram',
				'placeholder' => __( 'e.g. Facebook, Instagram, YouTube, X, TikTok, WhatsApp', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$rep_social->add_control(
			'social_icon',
			array(
				'label'   => __( 'Icon', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fab fa-instagram',
					'library' => 'fa-brands',
				),
			)
		);

		$rep_social->add_control(
			'social_url',
			array(
				'label'       => __( 'Link URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-profile-url.com', 'luxury-re-widgets' ),
				'default'     => array(
					'url'         => '#',
					'is_external' => true,
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$rep_social->add_control(
			'open_new_tab',
			array(
				'label'        => __( 'Always Open in New Tab', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => __( 'External links automatically open in a new tab for seamless user experience.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'social_links',
			array(
				'label'       => __( 'Social Media Links (Repeater)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $rep_social->get_controls(),
				'default'     => array(
					array(
						'social_title' => 'Facebook',
						'social_icon'  => array( 'value' => 'fab fa-facebook-f', 'library' => 'fa-brands' ),
						'social_url'   => array( 'url' => '#', 'is_external' => true ),
						'open_new_tab' => 'yes',
					),
					array(
						'social_title' => 'Instagram',
						'social_icon'  => array( 'value' => 'fab fa-instagram', 'library' => 'fa-brands' ),
						'social_url'   => array( 'url' => '#', 'is_external' => true ),
						'open_new_tab' => 'yes',
					),
					array(
						'social_title' => 'TikTok',
						'social_icon'  => array( 'value' => 'fab fa-tiktok', 'library' => 'fa-brands' ),
						'social_url'   => array( 'url' => '#', 'is_external' => true ),
						'open_new_tab' => 'yes',
					),
					array(
						'social_title' => 'LinkedIn',
						'social_icon'  => array( 'value' => 'fab fa-linkedin-in', 'library' => 'fa-brands' ),
						'social_url'   => array( 'url' => '#', 'is_external' => true ),
						'open_new_tab' => 'yes',
					),
					array(
						'social_title' => 'YouTube',
						'social_icon'  => array( 'value' => 'fab fa-youtube', 'library' => 'fa-brands' ),
						'social_url'   => array( 'url' => '#', 'is_external' => true ),
						'open_new_tab' => 'yes',
					),
					array(
						'social_title' => 'X (Twitter)',
						'social_icon'  => array( 'value' => 'fab fa-x-twitter', 'library' => 'fa-brands' ),
						'social_url'   => array( 'url' => '#', 'is_external' => true ),
						'open_new_tab' => 'yes',
					),
				),
				'title_field' => '{{{ social_title }}}',
			)
		);

		// Col 3
		$this->add_control( 'col3_label',  array( 'label' => __( 'Column 3 Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Office', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'office_addr', array( 'label' => __( 'Office Address', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "1420 Sunset Plaza Drive, Suite 300<br>Los Angeles, CA 90069", 'dynamic' => array( 'active' => true ) ) );
		$this->end_controls_section();

		// --- NAVIGATION LINKS ---
		$this->start_controls_section( 'section_nav', array( 'label' => __( 'Navigation Links', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control(
			'nav_source',
			array(
				'label'   => __( 'Navigation Source', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'custom'  => __( 'Custom Links (Repeater)', 'luxury-re-widgets' ),
					'wp_menu' => __( 'WordPress Menu', 'luxury-re-widgets' ),
				),
				'default' => 'custom',
			)
		);

		$this->add_control(
			'wp_menu_id',
			array(
				'label'       => __( 'Select WordPress Menu', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => $this->get_wp_menus_options(),
				'default'     => '',
				'condition'   => array(
					'nav_source' => 'wp_menu',
				),
				'description' => __( 'Select any WordPress menu configured under Appearance > Menus.', 'luxury-re-widgets' ),
			)
		);

		$repeater = new Repeater();
		$repeater->add_control( 'link_title', array( 'label' => __( 'Link Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Home', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'link_url',   array( 'label' => __( 'Link URL',   'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#' ) ) );

		$this->add_control( 'nav_links', array(
			'label'       => __( 'Custom Links', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array( 'link_title' => 'Home',           'link_url' => array( 'url' => '#hero' ) ),
				array( 'link_title' => 'About',          'link_url' => array( 'url' => '#about' ) ),
				array( 'link_title' => 'Properties',     'link_url' => array( 'url' => '#listings' ) ),
				array( 'link_title' => 'Guides',         'link_url' => array( 'url' => '#' ) ),
				array( 'link_title' => 'FAQs',           'link_url' => array( 'url' => '#' ) ),
				array( 'link_title' => 'Market Reports', 'link_url' => array( 'url' => '#' ) ),
				array( 'link_title' => 'Blog',           'link_url' => array( 'url' => '#' ) ),
				array( 'link_title' => 'Contact',        'link_url' => array( 'url' => '#contact' ) ),
			),
			'title_field' => '{{{ link_title }}}',
			'condition'   => array(
				'nav_source' => 'custom',
			),
		) );
		$this->end_controls_section();

		// --- LEGAL & COPYRIGHT ---
		$this->start_controls_section( 'section_legal', array( 'label' => __( 'Legal & Copyright', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'legal_text', array(
			'label'   => __( 'Legal Disclaimer', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'The information provided herein is deemed reliable but is not guaranteed and should be independently verified. Properties are subject to prior sale, price change, or withdrawal without notice. All imagery and content are protected by applicable copyright laws. Crestwood & Associates and its affiliated agents are licensed professionals operating under applicable California real estate regulations. Equal Housing Opportunity.',
		) );
		$this->add_control( 'copyright_brand', array( 'label' => __( 'Copyright Company Name', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Crestwood & Associates' ) );
		$this->add_control( 'privacy_url', array( 'label' => __( 'Privacy Policy URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'terms_url', array( 'label' => __( 'Terms of Service URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'accessibility_url', array( 'label' => __( 'Accessibility URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: Section ---
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Footer Container', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'footer_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer' => 'background-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'border_color', array( 'label' => __( 'Divider & Border Lines Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array(
			'{{WRAPPER}} .footer' => 'border-top-color: {{VALUE}} !important;',
			'{{WRAPPER}} .footer__nav' => 'border-top-color: {{VALUE}} !important;',
			'{{WRAPPER}} .footer__legal' => 'border-top-color: {{VALUE}} !important;',
			'{{WRAPPER}} .footer__bottom' => 'border-top-color: {{VALUE}} !important;'
		) ) );
		$this->end_controls_section();

		// --- STYLE: Brand & Logo ---
		$this->start_controls_section( 'style_brand', array( 'label' => __( 'Brand Header & Logo Style', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );

		// Logo Style Controls
		$this->add_control(
			'heading_logo_style',
			array(
				'label'     => __( 'Logo Image Style', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_responsive_control(
			'logo_width',
			array(
				'label'      => __( 'Logo Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'rem', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 20, 'max' => 600, 'step' => 1 ),
					'%'  => array( 'min' => 5, 'max' => 100 ),
					'vw' => array( 'min' => 5, 'max' => 100 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 180 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__logo-img' => 'width: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_responsive_control(
			'logo_max_width',
			array(
				'label'      => __( 'Logo Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 30, 'max' => 1200, 'step' => 1 ),
					'%'  => array( 'min' => 10, 'max' => 100 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .footer__logo-img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_responsive_control(
			'logo_height',
			array(
				'label'      => __( 'Logo Height (Optional)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px' => array( 'min' => 20, 'max' => 400, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .footer__logo-img' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_control(
			'logo_object_fit',
			array(
				'label'     => __( 'Object Fit', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'contain',
				'options'   => array(
					'contain' => __( 'Contain', 'luxury-re-widgets' ),
					'cover'   => __( 'Cover', 'luxury-re-widgets' ),
					'fill'    => __( 'Fill', 'luxury-re-widgets' ),
					'none'    => __( 'None', 'luxury-re-widgets' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .footer__logo-img' => 'object-fit: {{VALUE}} !important;',
				),
				'condition' => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_responsive_control(
			'logo_alignment',
			array(
				'label'     => __( 'Alignment', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .footer__logo-wrap' => 'justify-content: {{VALUE}} !important; display: flex;',
				),
				'condition' => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_responsive_control(
			'logo_margin_bottom',
			array(
				'label'      => __( 'Margin Bottom', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 80, 'step' => 1 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 16 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__logo-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_responsive_control(
			'logo_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'rem' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 80 ),
					'%'  => array( 'min' => 0, 'max' => 50 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .footer__logo-img' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_control(
			'logo_opacity',
			array(
				'label'     => __( 'Opacity', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 1 ),
				'selectors' => array(
					'{{WRAPPER}} .footer__logo-img' => 'opacity: {{SIZE}} !important;',
				),
				'condition' => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_control(
			'logo_hover_opacity',
			array(
				'label'     => __( 'Hover Opacity', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
				),
				'selectors' => array(
					'{{WRAPPER}} .footer__logo-img:hover'                    => 'opacity: {{SIZE}} !important;',
					'{{WRAPPER}} .footer__logo-link:hover .footer__logo-img' => 'opacity: {{SIZE}} !important;',
				),
				'condition' => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_control(
			'logo_hover_lift',
			array(
				'label'        => __( 'Hover Lift Effect', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'selectors'    => array(
					'{{WRAPPER}} .footer__logo-img:hover, {{WRAPPER}} .footer__logo-link:hover .footer__logo-img' => 'transform: translateY(-3px) !important;',
				),
				'condition'    => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		$this->add_control(
			'logo_transition_duration',
			array(
				'label'      => __( 'Transition Duration (s)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 's' ),
				'range'      => array(
					's' => array( 'min' => 0.1, 'max' => 1.5, 'step' => 0.05 ),
				),
				'default'    => array( 'unit' => 's', 'size' => 0.3 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__logo-img' => 'transition: all {{SIZE}}s ease !important;',
				),
				'condition'  => array(
					'brand_display_type' => array( 'image', 'both' ),
				),
			)
		);

		// Brand Name and Subtitle Text Style Controls
		$this->add_control(
			'heading_brand_text_style',
			array(
				'label'     => __( 'Brand Text Style', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'brand_display_type' => array( 'text', 'both' ),
				),
			)
		);

		$this->add_group_control( Group_Control_Typography::get_type(), array(
			'name'      => 'brand_typography',
			'label'     => __( 'Brand Typography', 'luxury-re-widgets' ),
			'selector'  => '{{WRAPPER}} .footer__brand',
			'condition' => array(
				'brand_display_type' => array( 'text', 'both' ),
			),
		) );
		$this->add_control( 'brand_color', array(
			'label'     => __( 'Brand Color', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} .footer__brand' => 'color: {{VALUE}} !important;' ),
			'condition' => array(
				'brand_display_type' => array( 'text', 'both' ),
			),
		) );
		$this->add_group_control( Group_Control_Typography::get_type(), array(
			'name'      => 'sub_typography',
			'label'     => __( 'Subtitle Typography', 'luxury-re-widgets' ),
			'selector'  => '{{WRAPPER}} .footer__brand-sub',
			'condition' => array(
				'brand_display_type' => array( 'text', 'both' ),
			),
		) );
		$this->add_control( 'sub_color', array(
			'label'     => __( 'Subtitle Color', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} .footer__brand-sub' => 'color: {{VALUE}} !important;' ),
			'condition' => array(
				'brand_display_type' => array( 'text', 'both' ),
			),
		) );

		// Gold Center Line
		$this->add_control(
			'heading_divider_style',
			array(
				'label'     => __( 'Divider Line', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control( 'gold_divider_color', array( 'label' => __( 'Gold Center Line Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__divider' => 'background: {{VALUE}} !important;' ) ) );
		$this->end_controls_section();

		// --- STYLE: Info Grid ---
		$this->start_controls_section( 'style_info_grid', array( 'label' => __( 'Info Grid Typography & Colors', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'label_typography', 'label' => __( 'Label Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__info-label' ) );
		$this->add_control( 'label_color', array( 'label' => __( 'Label Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__info-label' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'text_typography', 'label' => __( 'Text / Links Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__info-text, {{WRAPPER}} .footer__info-text a' ) );
		$this->add_control( 'text_color', array( 'label' => __( 'Text Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array(
			'{{WRAPPER}} .footer__info-text'   => 'color: {{VALUE}} !important;',
			'{{WRAPPER}} .footer__info-text a' => 'color: {{VALUE}} !important;',
		) ) );
		$this->add_control( 'text_hover_color', array( 'label' => __( 'Links Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array(
			'{{WRAPPER}} .footer__info-text a:hover' => 'color: {{VALUE}} !important;',
		) ) );
		$this->end_controls_section();

		// --- STYLE: Social Media Icons ---
		$this->start_controls_section(
			'style_social_section',
			array(
				'label' => __( 'Social Media Icons Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'social_icon_size',
			array(
				'label'      => __( 'Icon Size', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'range'      => array(
					'px' => array( 'min' => 10, 'max' => 48, 'step' => 1 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 15 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__social-link'          => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .footer__social-link i'        => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .footer__social-link svg'      => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'social_box_size',
			array(
				'label'      => __( 'Button / Circle Size', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px' => array( 'min' => 20, 'max' => 70, 'step' => 1 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 34 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__social-link' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important; min-width: {{SIZE}}{{UNIT}} !important; min-height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'social_gap',
			array(
				'label'      => __( 'Gap Between Icons', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'range'      => array(
					'px' => array( 'min' => 4, 'max' => 40, 'step' => 1 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 14 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__social' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'social_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'rem' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 50 ),
					'%'  => array( 'min' => 0, 'max' => 50 ),
				),
				'default'    => array( 'unit' => '%', 'size' => 50 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__social-link' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'social_transition_duration',
			array(
				'label'      => __( 'Transition Duration (s)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 's' ),
				'range'      => array(
					's' => array( 'min' => 0.1, 'max' => 2.0, 'step' => 0.05 ),
				),
				'default'    => array( 'unit' => 's', 'size' => 0.3 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__social-link'          => 'transition: all {{SIZE}}s cubic-bezier(0.16, 1, 0.3, 1) !important;',
					'{{WRAPPER}} .footer__social-link svg'      => 'transition: all {{SIZE}}s cubic-bezier(0.16, 1, 0.3, 1) !important;',
					'{{WRAPPER}} .footer__social-link svg path' => 'transition: all {{SIZE}}s cubic-bezier(0.16, 1, 0.3, 1) !important;',
					'{{WRAPPER}} .footer__social-link i'        => 'transition: all {{SIZE}}s cubic-bezier(0.16, 1, 0.3, 1) !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'social_border',
				'label'    => __( 'Border', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .footer__social-link',
			)
		);

		$this->start_controls_tabs( 'tabs_social_style' );

			$this->start_controls_tab(
				'tab_social_normal',
				array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
			);

			$this->add_control(
				'social_color',
				array(
					'label'     => __( 'Icon Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link'          => 'color: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__social-link svg'      => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__social-link svg path' => 'fill: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__social-link i'        => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'social_bg_color',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link' => 'background-color: {{VALUE}} !important; background: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'social_opacity',
				array(
					'label'     => __( 'Opacity', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
					),
					'default'   => array( 'size' => 0.75 ),
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link' => 'opacity: {{SIZE}} !important;',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_social_hover',
				array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
			);

			$this->add_control(
				'social_hover_color',
				array(
					'label'     => __( 'Icon Hover Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link:hover'          => 'color: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__social-link:hover svg'      => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__social-link:hover svg path' => 'fill: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__social-link:hover i'        => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'social_hover_bg_color',
				array(
					'label'     => __( 'Background Hover Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link:hover' => 'background-color: {{VALUE}} !important; background: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'social_hover_border_color',
				array(
					'label'     => __( 'Border Hover Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link:hover' => 'border-color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'social_hover_opacity',
				array(
					'label'     => __( 'Hover Opacity', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
					),
					'default'   => array( 'size' => 1 ),
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link:hover' => 'opacity: {{SIZE}} !important;',
					),
				)
			);

			$this->add_control(
				'social_hover_lift',
				array(
					'label'        => __( 'Hover Lift Effect', 'luxury-re-widgets' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
					'label_off'    => __( 'No', 'luxury-re-widgets' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'selectors'    => array(
						'{{WRAPPER}} .footer__social-link:hover' => 'transform: translateY(-3px) !important;',
					),
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// --- STYLE: Nav Links ---
		$this->start_controls_section( 'style_nav_links', array( 'label' => __( 'Navigation Links Row', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );

		$this->add_responsive_control(
			'nav_links_gap',
			array(
				'label'      => __( 'Gap Between Links', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'range'      => array(
					'px' => array( 'min' => 8, 'max' => 60, 'step' => 1 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 28 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__nav' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'nav_transition_duration',
			array(
				'label'      => __( 'Transition Duration (s)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 's' ),
				'range'      => array(
					's' => array( 'min' => 0.1, 'max' => 1.5, 'step' => 0.05 ),
				),
				'default'    => array( 'unit' => 's', 'size' => 0.3 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__nav-link' => 'transition: all {{SIZE}}s ease !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_nav_styling' );

			$this->start_controls_tab( 'tab_nav_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'nav_typography', 'selector' => '{{WRAPPER}} .footer__nav-link' ) );
			$this->add_control(
				'nav_link_color',
				array(
					'label'     => __( 'Link Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__nav-link' => 'color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'nav_link_opacity',
				array(
					'label'     => __( 'Opacity', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
					),
					'selectors' => array(
						'{{WRAPPER}} .footer__nav-link' => 'opacity: {{SIZE}} !important;',
					),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_nav_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'nav_link_hover_color',
				array(
					'label'     => __( 'Hover Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__nav-link:hover' => 'color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'nav_link_hover_opacity',
				array(
					'label'     => __( 'Hover Opacity', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
					),
					'selectors' => array(
						'{{WRAPPER}} .footer__nav-link:hover' => 'opacity: {{SIZE}} !important;',
					),
				)
			);
			$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		// --- STYLE: Legal & Copyright ---
		$this->start_controls_section(
			'style_legal_bottom',
			array(
				'label' => __( 'Legal & Bottom Copyright Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'legal_typography',
				'label'    => __( 'Legal Disclaimer Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .footer__legal-text',
			)
		);

		$this->add_control(
			'legal_text_color',
			array(
				'label'     => __( 'Legal Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .footer__legal-text' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'legal_opacity',
			array(
				'label'     => __( 'Legal Text Opacity', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
				),
				'selectors' => array(
					'{{WRAPPER}} .footer__legal-text' => 'opacity: {{SIZE}} !important;',
				),
			)
		);

		$this->add_control(
			'heading_copyright_style',
			array(
				'label'     => __( 'Bottom Copyright Row', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'copyright_typography',
				'label'    => __( 'Copyright Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .footer__bottom, {{WRAPPER}} .footer__copyright',
			)
		);

		$this->add_control(
			'bottom_text_color',
			array(
				'label'     => __( 'Copyright Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .footer__bottom'    => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .footer__copyright' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'bottom_opacity',
			array(
				'label'     => __( 'Copyright Opacity', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 0.8 ),
				'selectors' => array(
					'{{WRAPPER}} .footer__bottom'    => 'opacity: {{SIZE}} !important;',
					'{{WRAPPER}} .footer__copyright' => 'opacity: {{SIZE}} !important;',
				),
			)
		);

		$this->add_control(
			'heading_bottom_links_style',
			array(
				'label'     => __( 'Bottom Links (Privacy / Terms)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bottom_links_typography',
				'label'    => __( 'Links Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .footer__bottom a, {{WRAPPER}} .footer__copyright a, {{WRAPPER}} .footer__bottom-link',
			)
		);

		$this->add_control(
			'bottom_links_transition',
			array(
				'label'      => __( 'Transition Duration (s)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 's' ),
				'range'      => array(
					's' => array( 'min' => 0.1, 'max' => 1.5, 'step' => 0.05 ),
				),
				'default'    => array( 'unit' => 's', 'size' => 0.3 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__bottom a'      => 'transition: all {{SIZE}}s ease !important;',
					'{{WRAPPER}} .footer__copyright a'   => 'transition: all {{SIZE}}s ease !important;',
					'{{WRAPPER}} .footer__bottom-link'   => 'transition: all {{SIZE}}s ease !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_bottom_links_style' );

			$this->start_controls_tab(
				'tab_bottom_links_normal',
				array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
			);

			$this->add_control(
				'bottom_links_color',
				array(
					'label'     => __( 'Links Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__bottom a'      => 'color: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__copyright a'   => 'color: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__bottom-link'   => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'bottom_links_opacity',
				array(
					'label'     => __( 'Links Opacity', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
					),
					'selectors' => array(
						'{{WRAPPER}} .footer__bottom a'      => 'opacity: {{SIZE}} !important;',
						'{{WRAPPER}} .footer__copyright a'   => 'opacity: {{SIZE}} !important;',
						'{{WRAPPER}} .footer__bottom-link'   => 'opacity: {{SIZE}} !important;',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_bottom_links_hover',
				array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
			);

			$this->add_control(
				'bottom_links_hover_color',
				array(
					'label'     => __( 'Links Hover Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__bottom a:hover'      => 'color: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__copyright a:hover'   => 'color: {{VALUE}} !important;',
						'{{WRAPPER}} .footer__bottom-link:hover'   => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'bottom_links_hover_opacity',
				array(
					'label'     => __( 'Links Hover Opacity', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
					),
					'selectors' => array(
						'{{WRAPPER}} .footer__bottom a:hover'      => 'opacity: {{SIZE}} !important;',
						'{{WRAPPER}} .footer__copyright a:hover'   => 'opacity: {{SIZE}} !important;',
						'{{WRAPPER}} .footer__bottom-link:hover'   => 'opacity: {{SIZE}} !important;',
					),
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Retrieve social links with seamless backward compatibility
		$social_links = array();
		if ( ! empty( $settings['social_links'] ) && is_array( $settings['social_links'] ) ) {
			$social_links = $settings['social_links'];
		} else {
			// Backward compatibility fallback for posts saved with legacy individual controls
			if ( ! empty( $settings['social_facebook']['url'] ) && '#' !== $settings['social_facebook']['url'] ) {
				$social_links[] = array(
					'social_title' => 'Facebook',
					'social_icon'  => array( 'value' => 'fab fa-facebook-f', 'library' => 'fa-brands' ),
					'social_url'   => $settings['social_facebook'],
					'open_new_tab' => 'yes',
				);
			}
			if ( ! empty( $settings['social_instagram']['url'] ) && '#' !== $settings['social_instagram']['url'] ) {
				$social_links[] = array(
					'social_title' => 'Instagram',
					'social_icon'  => array( 'value' => 'fab fa-instagram', 'library' => 'fa-brands' ),
					'social_url'   => $settings['social_instagram'],
					'open_new_tab' => 'yes',
				);
			}
			if ( ! empty( $settings['social_tiktok']['url'] ) && '#' !== $settings['social_tiktok']['url'] ) {
				$social_links[] = array(
					'social_title' => 'TikTok',
					'social_icon'  => array( 'value' => 'fab fa-tiktok', 'library' => 'fa-brands' ),
					'social_url'   => $settings['social_tiktok'],
					'open_new_tab' => 'yes',
				);
			}
			if ( ! empty( $settings['social_linkedin']['url'] ) && '#' !== $settings['social_linkedin']['url'] ) {
				$social_links[] = array(
					'social_title' => 'LinkedIn',
					'social_icon'  => array( 'value' => 'fab fa-linkedin-in', 'library' => 'fa-brands' ),
					'social_url'   => $settings['social_linkedin'],
					'open_new_tab' => 'yes',
				);
			}

			// Default set if nothing was saved
			if ( empty( $social_links ) ) {
				$social_links = array(
					array( 'social_title' => 'Facebook',   'social_icon' => array( 'value' => 'fab fa-facebook-f', 'library' => 'fa-brands' ), 'social_url' => array( 'url' => '#', 'is_external' => true ), 'open_new_tab' => 'yes' ),
					array( 'social_title' => 'Instagram',  'social_icon' => array( 'value' => 'fab fa-instagram',  'library' => 'fa-brands' ), 'social_url' => array( 'url' => '#', 'is_external' => true ), 'open_new_tab' => 'yes' ),
					array( 'social_title' => 'LinkedIn',   'social_icon' => array( 'value' => 'fab fa-linkedin-in', 'library' => 'fa-brands' ), 'social_url' => array( 'url' => '#', 'is_external' => true ), 'open_new_tab' => 'yes' ),
					array( 'social_title' => 'YouTube',    'social_icon' => array( 'value' => 'fab fa-youtube',    'library' => 'fa-brands' ), 'social_url' => array( 'url' => '#', 'is_external' => true ), 'open_new_tab' => 'yes' ),
					array( 'social_title' => 'X (Twitter)','social_icon' => array( 'value' => 'fab fa-x-twitter',  'library' => 'fa-brands' ), 'social_url' => array( 'url' => '#', 'is_external' => true ), 'open_new_tab' => 'yes' ),
					array( 'social_title' => 'TikTok',     'social_icon' => array( 'value' => 'fab fa-tiktok',     'library' => 'fa-brands' ), 'social_url' => array( 'url' => '#', 'is_external' => true ), 'open_new_tab' => 'yes' ),
				);
			}
		}

		// Process navigation links (WordPress Menu OR Custom Repeater)
		$nav_source       = $settings['nav_source'] ?? 'custom';
		$nav_items_output = array();

		if ( 'wp_menu' === $nav_source ) {
			$menu_id = ! empty( $settings['wp_menu_id'] ) ? $settings['wp_menu_id'] : '';
			if ( empty( $menu_id ) ) {
				$all_menus = wp_get_nav_menus();
				if ( ! empty( $all_menus ) && ! is_wp_error( $all_menus ) ) {
					$menu_id = $all_menus[0]->term_id;
				}
			}

			if ( ! empty( $menu_id ) ) {
				$wp_items = wp_get_nav_menu_items( (int) $menu_id );
				if ( ! empty( $wp_items ) && ! is_wp_error( $wp_items ) ) {
					foreach ( $wp_items as $menu_item ) {
						$item_url    = $menu_item->url ?? '#';
						$item_title  = $menu_item->title ?? '';
						$item_target = ! empty( $menu_item->target ) ? $menu_item->target : '_self';
						$is_ext      = (bool) preg_match( '#^(https?:)?//#i', $item_url );

						if ( $is_ext && '_blank' === $item_target ) {
							$rel = ' rel="noopener noreferrer"';
						} else {
							$rel = '';
						}

						$nav_items_output[] = array(
							'title'  => $item_title,
							'url'    => $item_url,
							'target' => $item_target,
							'rel'    => $rel,
						);
					}
				}
			}
		} else {
			// Custom repeater links
			if ( ! empty( $settings['nav_links'] ) && is_array( $settings['nav_links'] ) ) {
				foreach ( $settings['nav_links'] as $item ) {
					$raw_url      = trim( $item['link_url']['url'] ?? '#' );
					$is_external  = ! empty( $item['link_url']['is_external'] );
					$is_nofollow  = ! empty( $item['link_url']['nofollow'] );
					$is_ext_url   = (bool) preg_match( '#^(https?:)?//#i', $raw_url );

					$should_blank = ( '#' !== $raw_url && ( $is_external || $is_ext_url ) );
					$target       = $should_blank ? '_blank' : '_self';

					$rel_parts = array();
					if ( $should_blank ) {
						$rel_parts[] = 'noopener';
						$rel_parts[] = 'noreferrer';
					}
					if ( $is_nofollow ) {
						$rel_parts[] = 'nofollow';
					}
					$rel = ! empty( $rel_parts ) ? ' rel="' . esc_attr( implode( ' ', $rel_parts ) ) . '"' : '';

					$nav_items_output[] = array(
						'title'  => $item['link_title'] ?? '',
						'url'    => $raw_url,
						'target' => $target,
						'rel'    => $rel,
					);
				}
			}
		}
		?>
		<footer class="footer" id="footer" aria-label="<?php esc_attr_e( 'Site footer', 'luxury-re-widgets' ); ?>">
			<div class="footer__main reveal">
				<?php
				$brand_display_type = $settings['brand_display_type'] ?? 'text';
				$has_logo           = in_array( $brand_display_type, array( 'image', 'both' ), true ) && ! empty( $settings['brand_logo']['url'] );
				$has_text           = in_array( $brand_display_type, array( 'text', 'both' ), true );
				?>
				<?php if ( $has_logo ) :
					$logo_url    = ! empty( $settings['brand_logo_link']['url'] ) ? $settings['brand_logo_link']['url'] : '';
					$logo_is_ext = ! empty( $settings['brand_logo_link']['is_external'] ) || (bool) preg_match( '#^(https?:)?//#i', $logo_url );
					$logo_target = $logo_is_ext ? '_blank' : '_self';
					$logo_rel    = $logo_is_ext ? ' rel="noopener noreferrer"' : '';
					$logo_alt    = ! empty( $settings['brand_logo_alt'] ) ? $settings['brand_logo_alt'] : ( ! empty( $settings['brand_name'] ) ? $settings['brand_name'] : get_bloginfo( 'name' ) );
				?>
				<div class="footer__logo-wrap">
					<?php if ( ! empty( $logo_url ) ) : ?>
					<a href="<?php echo esc_url( $logo_url ); ?>" target="<?php echo esc_attr( $logo_target ); ?>"<?php echo $logo_rel; ?> class="footer__logo-link" aria-label="<?php echo esc_attr( $logo_alt ); ?>">
						<img src="<?php echo esc_url( $settings['brand_logo']['url'] ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" class="footer__logo-img">
					</a>
					<?php else : ?>
					<img src="<?php echo esc_url( $settings['brand_logo']['url'] ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" class="footer__logo-img">
					<?php endif; ?>
				</div>
				<?php elseif ( \Elementor\Plugin::$instance->editor->is_edit_mode() && 'image' === $brand_display_type ) : ?>
				<div class="footer__logo-wrap" style="padding: 16px 24px; border: 1px dashed rgba(255,255,255,0.3); border-radius: 6px; margin: 0 auto 20px; color: rgba(255,255,255,0.6); font-size: 13px; text-align: center; max-width: 400px;">
					<?php esc_html_e( '[Choose an image for Brand Logo in Content > Brand Header & Logo]', 'luxury-re-widgets' ); ?>
				</div>
				<?php endif; ?>

				<?php if ( $has_text && ! empty( $settings['brand_name'] ) ) : ?>
				<h2 class="footer__brand">
					<span class="title-mask"><span><?php echo esc_html( $settings['brand_name'] ); ?></span></span>
				</h2>
				<?php endif; ?>

				<?php if ( $has_text && ! empty( $settings['brand_subtitle'] ) ) : ?>
				<p class="footer__brand-sub delay-1"><?php echo esc_html( $settings['brand_subtitle'] ); ?></p>
				<?php endif; ?>

				<div class="footer__divider delay-1"></div>

				<div class="footer__info-grid delay-2">
					<!-- Col 1: Phone & Email -->
					<div class="footer__info-col">
						<?php if ( ! empty( $settings['col1_label'] ) ) : ?>
						<p class="footer__info-label"><?php echo esc_html( $settings['col1_label'] ); ?></p>
						<?php endif; ?>
						<p class="footer__info-text">
							<?php if ( ! empty( $settings['phone_number'] ) ) : ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $settings['phone_number'] ) ); ?>">
								<?php echo esc_html( $settings['phone_number'] ); ?>
							</a><br>
							<?php endif; ?>
							<?php if ( ! empty( $settings['email_addr'] ) ) : ?>
							<a href="mailto:<?php echo esc_attr( $settings['email_addr'] ); ?>">
								<?php echo esc_html( $settings['email_addr'] ); ?>
							</a>
							<?php endif; ?>
						</p>
					</div>

					<!-- Col 2: DRE & Social -->
					<div class="footer__info-col">
						<?php if ( ! empty( $settings['col2_label'] ) ) : ?>
						<p class="footer__info-label"><?php echo esc_html( $settings['col2_label'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $social_links ) ) : ?>
						<div class="footer__social">
							<?php
							foreach ( $social_links as $item ) :
								$title   = ! empty( $item['social_title'] ) ? $item['social_title'] : 'Social Link';
								$raw_url = '';
								$is_external_setting = false;
								$is_nofollow         = false;

								if ( is_array( $item['social_url'] ?? null ) ) {
									$raw_url             = trim( $item['social_url']['url'] ?? '' );
									$is_external_setting = ! empty( $item['social_url']['is_external'] );
									$is_nofollow         = ! empty( $item['social_url']['nofollow'] );
								} elseif ( is_string( $item['social_url'] ?? null ) ) {
									$raw_url = trim( $item['social_url'] );
								}

								if ( empty( $raw_url ) ) {
									$raw_url = '#';
								}

								$url = esc_url( $raw_url );

								// External link determination:
								// 1. Any external link (https?://) ALWAYS opens in a new tab
								// 2. OR open_new_tab is explicitly 'yes'
								// 3. OR is_external setting is toggled on in URL control
								$is_external_url       = (bool) preg_match( '#^(https?:)?//#i', $raw_url );
								$force_new_tab         = ( isset( $item['open_new_tab'] ) && 'yes' === $item['open_new_tab'] );
								$user_checked_external = ! empty( $item['social_url']['is_external'] );

								if ( $is_external_url ) {
									$should_open_new_tab = true;
								} elseif ( '#' === $raw_url ) {
									$should_open_new_tab = false;
								} else {
									$should_open_new_tab = ( $force_new_tab || $user_checked_external );
								}

								$target    = $should_open_new_tab ? '_blank' : '_self';
								$rel_parts = array();
								if ( $should_open_new_tab ) {
									$rel_parts[] = 'noopener';
									$rel_parts[] = 'noreferrer';
								}
								if ( $is_nofollow ) {
									$rel_parts[] = 'nofollow';
								}
								$rel_attr = ! empty( $rel_parts ) ? ' rel="' . esc_attr( implode( ' ', $rel_parts ) ) . '"' : '';
							?>
							<a href="<?php echo $url; ?>"
							   target="<?php echo esc_attr( $target ); ?>"<?php echo $rel_attr; ?>
							   class="footer__social-link elementor-repeater-item-<?php echo esc_attr( $item['_id'] ?? '' ); ?>"
							   aria-label="<?php echo esc_attr( $title ); ?>">
								<?php
								if ( ! empty( $item['social_icon']['value'] ) ) {
									Icons_Manager::render_icon( $item['social_icon'], array( 'aria-hidden' => 'true' ) );
								} else {
									echo '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>';
								}
								?>
							</a>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>

					<!-- Col 3: Office -->
					<div class="footer__info-col">
						<?php if ( ! empty( $settings['col3_label'] ) ) : ?>
						<p class="footer__info-label"><?php echo esc_html( $settings['col3_label'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $settings['office_addr'] ) ) : ?>
						<p class="footer__info-text">
							<?php echo wp_kses_post( $settings['office_addr'] ); ?>
						</p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- Navigation Links Row -->
			<?php if ( ! empty( $nav_items_output ) ) : ?>
			<nav class="footer__nav reveal delay-3" aria-label="<?php esc_attr_e( 'Footer navigation', 'luxury-re-widgets' ); ?>">
				<?php foreach ( $nav_items_output as $nav_item ) : ?>
				<a href="<?php echo esc_url( $nav_item['url'] ); ?>" target="<?php echo esc_attr( $nav_item['target'] ); ?>"<?php echo $nav_item['rel']; ?> class="footer__nav-link">
					<?php echo esc_html( $nav_item['title'] ); ?>
				</a>
				<?php endforeach; ?>
			</nav>
			<?php elseif ( \Elementor\Plugin::$instance->editor->is_edit_mode() && 'wp_menu' === $nav_source ) : ?>
			<div class="footer__nav" style="color: rgba(255,255,255,0.5); font-size: 13px; letter-spacing: 1px; justify-content: center; padding: 14px 0; border-top: 1px dashed rgba(255,255,255,0.2);">
				<?php esc_html_e( '[WordPress Menu has no items assigned yet. Please assign items under Appearance > Menus]', 'luxury-re-widgets' ); ?>
			</div>
			<?php endif; ?>

			<!-- Legal Disclaimer Row -->
			<?php if ( ! empty( $settings['legal_text'] ) ) : ?>
			<div class="footer__legal">
				<p class="footer__legal-text">
					<?php echo esc_html( $settings['legal_text'] ); ?>
				</p>
			</div>
			<?php endif; ?>

			<!-- Bottom Copyright Row -->
			<?php
			$privacy_url    = $settings['privacy_url']['url'] ?? '#';
			$privacy_is_ext = ! empty( $settings['privacy_url']['is_external'] ) || (bool) preg_match( '#^(https?:)?//#i', $privacy_url );
			$privacy_target = $privacy_is_ext ? '_blank' : '_self';
			$privacy_rel    = $privacy_is_ext ? ' rel="noopener noreferrer"' : '';

			$terms_url      = $settings['terms_url']['url'] ?? '#';
			$terms_is_ext   = ! empty( $settings['terms_url']['is_external'] ) || (bool) preg_match( '#^(https?:)?//#i', $terms_url );
			$terms_target   = $terms_is_ext ? '_blank' : '_self';
			$terms_rel      = $terms_is_ext ? ' rel="noopener noreferrer"' : '';

			$access_url     = $settings['accessibility_url']['url'] ?? '#';
			$access_is_ext  = ! empty( $settings['accessibility_url']['is_external'] ) || (bool) preg_match( '#^(https?:)?//#i', $access_url );
			$access_target  = $access_is_ext ? '_blank' : '_self';
			$access_rel     = $access_is_ext ? ' rel="noopener noreferrer"' : '';
			?>
			<div class="footer__bottom">
				<span class="footer__copyright">
					&copy; <?php echo date( 'Y' ); ?> <?php echo esc_html( $settings['copyright_brand'] ); ?>. <?php esc_html_e( 'All rights reserved. |', 'luxury-re-widgets' ); ?>
					<a href="<?php echo esc_url( $privacy_url ); ?>" target="<?php echo esc_attr( $privacy_target ); ?>"<?php echo $privacy_rel; ?> class="footer__bottom-link"><?php esc_html_e( 'Privacy Policy', 'luxury-re-widgets' ); ?></a> &bull;
					<a href="<?php echo esc_url( $terms_url ); ?>" target="<?php echo esc_attr( $terms_target ); ?>"<?php echo $terms_rel; ?> class="footer__bottom-link"><?php esc_html_e( 'Terms of Service', 'luxury-re-widgets' ); ?></a> &bull;
					<a href="<?php echo esc_url( $access_url ); ?>" target="<?php echo esc_attr( $access_target ); ?>"<?php echo $access_rel; ?> class="footer__bottom-link"><?php esc_html_e( 'Accessibility', 'luxury-re-widgets' ); ?></a>
				</span>
			</div>
		</footer>
		<?php
	}
}