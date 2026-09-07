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

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- BRAND ---
		$this->start_controls_section( 'section_brand', array( 'label' => __( 'Brand Header', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'brand_name',     array( 'label' => __( 'Brand Name',     'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Victoria Crestwood', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'brand_subtitle', array( 'label' => __( 'Brand Subtitle', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => '& Associates',      'dynamic' => array( 'active' => true ) ) );
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
		
		$repeater = new Repeater();
		$repeater->add_control( 'link_title', array( 'label' => __( 'Link Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Home', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'link_url',   array( 'label' => __( 'Link URL',   'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#' ) ) );

		$this->add_control( 'nav_links', array(
			'label'       => __( 'Links', 'luxury-re-widgets' ),
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
		$this->add_control( 'footer_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer' => 'background-color: {{VALUE}};' ) ) );
		$this->add_control( 'border_color', array( 'label' => __( 'Divider & Border Lines Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array(
			'{{WRAPPER}} .footer' => 'border-top-color: {{VALUE}};',
			'{{WRAPPER}} .footer__nav' => 'border-top-color: {{VALUE}};',
			'{{WRAPPER}} .footer__legal' => 'border-top-color: {{VALUE}};',
			'{{WRAPPER}} .footer__bottom' => 'border-top-color: {{VALUE}};'
		) ) );
		$this->end_controls_section();

		// --- STYLE: Brand ---
		$this->start_controls_section( 'style_brand', array( 'label' => __( 'Brand Header', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'brand_typography', 'label' => __( 'Brand Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__brand' ) );
		$this->add_control( 'brand_color', array( 'label' => __( 'Brand Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__brand' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'sub_typography', 'label' => __( 'Subtitle Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__brand-sub' ) );
		$this->add_control( 'sub_color', array( 'label' => __( 'Subtitle Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__brand-sub' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'gold_divider_color', array( 'label' => __( 'Gold Center Line Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__divider' => 'background: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// --- STYLE: Info Grid ---
		$this->start_controls_section( 'style_info_grid', array( 'label' => __( 'Info Grid Typography & Colors', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'label_typography', 'label' => __( 'Label Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__info-label' ) );
		$this->add_control( 'label_color', array( 'label' => __( 'Label Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__info-label' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'text_typography', 'label' => __( 'Text / Links Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__info-text, {{WRAPPER}} .footer__info-text a' ) );
		$this->add_control( 'text_color', array( 'label' => __( 'Text Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__info-text, {{WRAPPER}} .footer__info-text a' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'text_hover_color', array( 'label' => __( 'Links Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__info-text a:hover' => 'color: {{VALUE}};' ) ) );
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
					'{{WRAPPER}} .footer__social-link'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .footer__social-link i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .footer__social-link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
				'default'    => array( 'unit' => 'px', 'size' => 32 ),
				'selectors'  => array(
					'{{WRAPPER}} .footer__social-link' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .footer__social' => 'gap: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .footer__social-link' => 'border-radius: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .footer__social-link' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'social_bg_color',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link' => 'background-color: {{VALUE}};',
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
					'default'   => array( 'size' => 0.6 ),
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link' => 'opacity: {{SIZE}};',
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
						'{{WRAPPER}} .footer__social-link:hover' => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'social_hover_bg_color',
				array(
					'label'     => __( 'Background Hover Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .footer__social-link:hover' => 'background-color: {{VALUE}} !important;',
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

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// --- STYLE: Nav Links ---
		$this->start_controls_section( 'style_nav_links', array( 'label' => __( 'Navigation Links Row', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_nav_styling' );
			$this->start_controls_tab( 'tab_nav_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'nav_typography', 'selector' => '{{WRAPPER}} .footer__nav-link' ) );
			$this->add_control( 'nav_link_color', array( 'label' => __( 'Link Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__nav-link' => 'color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_nav_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'nav_link_hover_color', array( 'label' => __( 'Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__nav-link:hover' => 'color: {{VALUE}};' ) ) );
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
		?>
		<footer class="footer" id="footer" aria-label="<?php esc_attr_e( 'Site footer', 'luxury-re-widgets' ); ?>">
			<div class="footer__main reveal">
				<?php if ( ! empty( $settings['brand_name'] ) ) : ?>
				<h2 class="footer__brand">
					<span class="title-mask"><span><?php echo esc_html( $settings['brand_name'] ); ?></span></span>
				</h2>
				<?php endif; ?>

				<?php if ( ! empty( $settings['brand_subtitle'] ) ) : ?>
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
			<?php if ( ! empty( $settings['nav_links'] ) ) : ?>
			<nav class="footer__nav reveal delay-3" aria-label="<?php esc_attr_e( 'Footer navigation', 'luxury-re-widgets' ); ?>">
				<?php foreach ( $settings['nav_links'] as $item ) :
					$link_url    = esc_url( $item['link_url']['url'] ?? '#' );
					$link_target = ! empty( $item['link_url']['is_external'] ) ? '_blank' : '_self';
				?>
				<a href="<?php echo $link_url; ?>" target="<?php echo esc_attr( $link_target ); ?>" class="footer__nav-link">
					<?php echo esc_html( $item['link_title'] ); ?>
				</a>
				<?php endforeach; ?>
			</nav>
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
			<div class="footer__bottom">
				<span class="footer__copyright">
					&copy; <?php echo date( 'Y' ); ?> <?php echo esc_html( $settings['copyright_brand'] ); ?>. <?php esc_html_e( 'All rights reserved. |', 'luxury-re-widgets' ); ?>
					<a href="<?php echo esc_url( $settings['privacy_url']['url'] ?? '#' ); ?>" target="<?php echo ! empty( $settings['privacy_url']['is_external'] ) ? '_blank' : '_self'; ?>"><?php esc_html_e( 'Privacy Policy', 'luxury-re-widgets' ); ?></a> &bull;
					<a href="<?php echo esc_url( $settings['terms_url']['url'] ?? '#' ); ?>" target="<?php echo ! empty( $settings['terms_url']['is_external'] ) ? '_blank' : '_self'; ?>"><?php esc_html_e( 'Terms of Service', 'luxury-re-widgets' ); ?></a> &bull;
					<a href="<?php echo esc_url( $settings['accessibility_url']['url'] ?? '#' ); ?>" target="<?php echo ! empty( $settings['accessibility_url']['is_external'] ) ? '_blank' : '_self'; ?>"><?php esc_html_e( 'Accessibility', 'luxury-re-widgets' ); ?></a>
				</span>
			</div>
		</footer>
		<?php
	}
}