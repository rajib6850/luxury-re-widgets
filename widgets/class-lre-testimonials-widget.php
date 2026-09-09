<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Testimonials_Widget
 * Testimonials slider with client portrait image, harmonious height controls, and navigation.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Testimonials_Widget extends Widget_Base {

	public function get_name()       { return 'lre_testimonials'; }
	public function get_title()      { return __( 'LRE — Client Testimonials', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-testimonial-carousel'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'testimonials', 'reviews', 'clients', 'slider', 'quotes', 'height' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- MEDIA & HEADER ---
		$this->start_controls_section( 'section_header', array( 'label' => __( 'Header & Media', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$default_portrait   = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/testimonial-clients.jpg' : plugins_url( 'assets/images/testimonial-clients.jpg', dirname( dirname( __FILE__ ) ) );
		$elementor_fallback = class_exists( '\Elementor\Utils' ) ? \Elementor\Utils::get_placeholder_image_src() : '';
		$avatar_1           = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/avatar-1.jpg' : plugins_url( 'assets/images/avatar-1.jpg', dirname( dirname( __FILE__ ) ) );
		$avatar_2           = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/avatar-2.jpg' : plugins_url( 'assets/images/avatar-2.jpg', dirname( dirname( __FILE__ ) ) );
		$avatar_3           = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/avatar-3.jpg' : plugins_url( 'assets/images/avatar-3.jpg', dirname( dirname( __FILE__ ) ) );
		$this->add_control( 'portrait_image', array(
			'label'   => __( 'Left Portrait Image', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => array( 'url' => $default_portrait ),
			'dynamic' => array( 'active' => true ),
		) );
		$this->add_control(
			'show_image_overlay',
			array(
				'label'        => __( 'Show Image Dark Gradient Overlay', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Client Testimonials', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_main', array( 'label' => __( 'Heading Main', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Why people choose', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_brand', array( 'label' => __( 'Heading Brand', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Victoria Crestwood Group', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'Heading Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'  => 'H1',
					'h2'  => 'H2',
					'h3'  => 'H3',
					'h4'  => 'H4',
					'div' => 'div',
				),
			)
		);
		$this->add_control(
			'show_gold_bar',
			array(
				'label'        => __( 'Show Eyebrow Line', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'eyebrow!' => '',
				),
			)
		);
		$this->end_controls_section();

		// --- TESTIMONIALS REPEATER ---
		$this->start_controls_section( 'section_testimonials', array( 'label' => __( 'Testimonials', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$repeater = new Repeater();
		$repeater->add_control( 'quote',         array( 'label' => __( 'Quote', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => '"They helped us get 8 offers on our home within 3 days and all of them were above the asking price. If you don\'t want any hassles, definitely choose Victoria Crestwood Group"', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'client_name',   array( 'label' => __( 'Client Name', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'The Blalock Family', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'client_result', array( 'label' => __( 'Result / Subtitle', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Sold in 7 days for 111.2% of their asking price', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'client_avatar', array( 'label' => __( 'Client Avatar', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => $elementor_fallback ) ) );

		$this->add_control( 'testimonials', array(
			'label'       => __( 'Testimonials', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array(
					'quote'         => '"They helped us get 8 offers on our home within 3 days and all of them were above the asking price. If you don\'t want any hassles, if you want to get top value for your money and if you just want a simple streamline process...definitely choose Victoria Crestwood Group"',
					'client_name'   => 'The Blalock Family',
					'client_result' => 'Sold in 7 days for 111.2% of their asking price',
					'client_avatar' => array( 'url' => $avatar_1 ),
				),
				array(
					'quote'         => '"From our initial private consultation to closing on our Malibu oceanfront villa, Victoria and her team handled every detail flawlessly. We secured our dream residence $320,000 under original asking price in a multiple-offer scenario."',
					'client_name'   => 'Marcus & Elena Rivera',
					'client_result' => 'Purchased in Malibu — Closed in 14 days',
					'client_avatar' => array( 'url' => $avatar_2 ),
				),
				array(
					'quote'         => '"An unprecedented standard of discretion and market intelligence. They identified an off-market Bel Air architectural estate before it ever hit public exchanges, saving our family months of searching."',
					'client_name'   => 'Dr. Aris Thorne & Family',
					'client_result' => 'Acquired off-market for 96.5% of appraisal value',
					'client_avatar' => array( 'url' => $avatar_3 ),
				),
			),
			'title_field' => '{{{ client_name }}}',
		) );

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: Section Layout & Height ---
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section Layout & Height', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'section_min_height', array(
			'label'      => __( 'Section Min Height (px)', 'luxury-re-widgets' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => array( 'px', 'vh' ),
			'range'      => array(
				'px' => array( 'min' => 350, 'max' => 900, 'step' => 10 ),
				'vh' => array( 'min' => 30,  'max' => 100 ),
			),
			'default'    => array( 'unit' => 'px', 'size' => 540 ),
			'selectors'  => array(
				'{{WRAPPER}} .testimonial' => 'min-height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .testimonial__image-col' => 'min-height: {{SIZE}}{{UNIT}};',
			),
		) );
		$this->add_responsive_control( 'content_padding', array(
			'label'      => __( 'Content Column Padding', 'luxury-re-widgets' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', 'em', 'rem', '%' ),
			'default'    => array(
				'top'      => '4.5',
				'right'    => '4.5',
				'bottom'   => '4.5',
				'left'     => '4.5',
				'unit'     => 'rem',
				'isLinked' => true,
			),
			'selectors'  => array( '{{WRAPPER}} .testimonial__content-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
		) );
		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .testimonial'             => 'background-color: {{VALUE}} !important; --testimonial-bg: {{VALUE}};',
					'{{WRAPPER}} .testimonial__content-col' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .testimonial__image-col'   => 'background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();

		// --- STYLE: Eyebrow ---
		$this->start_controls_section( 'style_eyebrow', array( 'label' => __( 'Eyebrow', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .testimonial__eyebrow, {{WRAPPER}} .testimonial__eyebrow-wrap .section-label, {{WRAPPER}} .testimonial .testimonial__eyebrow',
			)
		);
		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .testimonial__eyebrow, {{WRAPPER}} .testimonial__eyebrow-wrap .section-label, {{WRAPPER}} .testimonial .testimonial__eyebrow, {{WRAPPER}} .testimonial .section-label' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important; --testimonial-eyebrow-color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 60, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 5, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial__eyebrow-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_control(
			'heading_gold_bar',
			array(
				'label'     => __( 'Eyebrow Accent Line', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_gold_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'gold_bar_color',
			array(
				'label'     => __( 'Line Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'show_gold_bar' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .testimonial__gold-bar, {{WRAPPER}} .testimonial__eyebrow-bar' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'gold_bar_width',
			array(
				'label'      => __( 'Line Width (px)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'condition'  => array(
					'show_gold_bar' => 'yes',
				),
				'range'      => array(
					'px' => array( 'min' => 8, 'max' => 120, 'step' => 2 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial__gold-bar, {{WRAPPER}} .testimonial__eyebrow-bar' => 'width: {{SIZE}}px !important; min-width: {{SIZE}}px !important;',
				),
			)
		);
		$this->add_responsive_control(
			'gold_bar_height',
			array(
				'label'      => __( 'Line Height (px)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'condition'  => array(
					'show_gold_bar' => 'yes',
				),
				'range'      => array(
					'px' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial__gold-bar, {{WRAPPER}} .testimonial__eyebrow-bar' => 'height: {{SIZE}}px !important;',
				),
			)
		);
		$this->end_controls_section();

		// --- STYLE: Heading ---
		$this->start_controls_section( 'style_heading', array( 'label' => __( 'Heading', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_main_typography',
				'label'    => __( 'Main Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .testimonial__heading-main',
			)
		);
		$this->add_control(
			'heading_main_color',
			array(
				'label'     => __( 'Main Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .testimonial__heading-main' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'heading_brand_heading',
			array(
				'label'     => __( 'Brand Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_brand_typography',
				'label'    => __( 'Brand Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .testimonial__heading-brand, {{WRAPPER}} .testimonial__heading-brand *',
			)
		);
		$this->add_control(
			'heading_brand_color',
			array(
				'label'     => __( 'Brand Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .testimonial__heading-brand' => '--brand-custom-color: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'enable_brand_shimmer',
			array(
				'label'        => __( 'Brand Shimmer Animation', 'luxury-re-widgets' ),
				'description'  => __( 'Animates a luxury gleaming light sweep across the text (works with custom/global colors as well as default gold).', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'luxury-re-widgets' ),
				'label_off'    => __( 'Off', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 80, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 6, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial__heading' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->end_controls_section();

		// --- STYLE: Quote & Author Typography ---
		$this->start_controls_section( 'style_typo', array( 'label' => __( 'Quote & Author Typography', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'quote_typography',
				'label'    => __( 'Quote Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .testimonial__quote',
			)
		);
		$this->add_control(
			'quote_color',
			array(
				'label'     => __( 'Quote Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .testimonial__quote' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'quote_spacing',
			array(
				'label'      => __( 'Quote Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 50, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 4, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial__quote' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'heading_author_typo',
			array(
				'label'     => __( 'Author Details', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => __( 'Client Name Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .testimonial__author-name',
			)
		);
		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Client Name Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .testimonial__author-name' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'result_typography',
				'label'    => __( 'Result Subtitle Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .testimonial__author-result',
			)
		);
		$this->add_control(
			'result_color',
			array(
				'label'     => __( 'Result Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .testimonial__author-result' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();

		// --- STYLE: Navigation ---
		$this->start_controls_section( 'style_nav', array( 'label' => __( 'Slider Arrows & Dots', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_slider_nav' );
			$this->start_controls_tab( 'tab_nav_btn_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control( 'arrow_color', array( 'label' => __( 'Arrow Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__arrow' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'arrow_border', array( 'label' => __( 'Arrow Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__arrow' => 'border-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_nav_btn_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'arrow_color_hover', array( 'label' => __( 'Hover Arrow Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__arrow:hover' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'arrow_bg_hover', array( 'label' => __( 'Hover Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__arrow:hover' => 'background-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Helper to get resolved color value (supporting both manual hex and Elementor Global Colors)
	 */
	protected function get_resolved_color( $settings, $control_name, $default = '' ) {
		$globals = ! empty( $settings['__globals__'] ) ? $settings['__globals__'] : ( method_exists( $this, 'get_settings' ) ? $this->get_settings( '__globals__' ) : array() );

		if ( ! empty( $globals[ $control_name ] ) ) {
			$global_val = $globals[ $control_name ];
			// Pattern: globals/colors?id=primary or globals/colors?id=08c543c
			if ( preg_match( '/id=([a-zA-Z0-9_-]+)/', $global_val, $matches ) ) {
				return 'var(--e-global-color-' . $matches[1] . ')';
			}
		}

		if ( ! empty( $settings[ $control_name ] ) ) {
			return $settings[ $control_name ];
		}

		return $default;
	}

	protected function render() {
		$settings         = $this->get_settings_for_display();
		$default_portrait   = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/testimonial-clients.jpg' : plugins_url( 'assets/images/testimonial-clients.jpg', dirname( dirname( __FILE__ ) ) );
		$elementor_fallback = class_exists( '\Elementor\Utils' ) ? \Elementor\Utils::get_placeholder_image_src() : '';
		$portrait_url     = ! empty( $settings['portrait_image']['url'] ) ? $settings['portrait_image']['url'] : $default_portrait;
		$tag              = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag              = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $tag : 'h2';
		$show_gold_bar    = ! isset( $settings['show_gold_bar'] ) || 'yes' === $settings['show_gold_bar'];
		$show_overlay     = ! empty( $settings['show_image_overlay'] ) && 'yes' === $settings['show_image_overlay'];
		$overlay_class    = $show_overlay ? ' has-overlay' : '';

		// Robust color resolution supporting both manual hex/rgb and Elementor Global Colors
		$bg_color      = $this->get_resolved_color( $settings, 'section_bg', '' );
		$bg_style      = $bg_color ? ' style="background-color: ' . esc_attr( $bg_color ) . ' !important; --testimonial-bg: ' . esc_attr( $bg_color ) . ';"' : '';
		$col_style     = $bg_color ? ' style="background-color: ' . esc_attr( $bg_color ) . ' !important;"' : '';
		$fade_style    = $bg_color ? ' style="background: linear-gradient(to right, transparent 65%, ' . esc_attr( $bg_color ) . ' 100%), linear-gradient(to top, rgba(0, 0, 0, 0.4) 0%, transparent 40%);"' : '';

		$is_shimmer  = ( ! isset( $settings['enable_brand_shimmer'] ) || 'yes' === $settings['enable_brand_shimmer'] );
		$brand_color = $this->get_resolved_color( $settings, 'heading_brand_color', '' );

		if ( $is_shimmer ) {
			if ( ! empty( $brand_color ) ) {
				// Shimmer active WITH user's chosen custom or global color!
				$brand_class = 'testimonial__heading-brand has-shimmer has-custom-color';
				$brand_style = ' style="--brand-custom-color: ' . esc_attr( $brand_color ) . ';"';
			} else {
				// Shimmer active with default rich gold sweep gradient
				$brand_class = 'testimonial__heading-brand has-shimmer';
				$brand_style = '';
			}
		} else {
			// Shimmer turned OFF: clean solid color
			$brand_class = 'testimonial__heading-brand no-shimmer';
			$brand_style = ! empty( $brand_color ) ? ' style="color: ' . esc_attr( $brand_color ) . ' !important; -webkit-text-fill-color: ' . esc_attr( $brand_color ) . ' !important;"' : '';
		}

		$main_color    = $this->get_resolved_color( $settings, 'heading_main_color', '' );
		$main_style    = $main_color ? ' style="color: ' . esc_attr( $main_color ) . ' !important;"' : '';

		$eyebrow_color = $this->get_resolved_color( $settings, 'eyebrow_color', '' );
		$eyebrow_style = $eyebrow_color ? ' style="color: ' . esc_attr( $eyebrow_color ) . ' !important;"' : '';

		$bar_color     = $this->get_resolved_color( $settings, 'gold_bar_color', '' );
		$bar_style     = $bar_color ? ' style="background: ' . esc_attr( $bar_color ) . ' !important; background-color: ' . esc_attr( $bar_color ) . ' !important;"' : '';
		?>
		<section class="testimonial<?php echo esc_attr( $overlay_class ); ?>" id="testimonial" aria-label="<?php esc_attr_e( 'Client testimonial', 'luxury-re-widgets' ); ?>"<?php echo $bg_style; ?>>
			<div class="testimonial__image-col image-reveal"<?php echo $col_style; ?>>
				<?php if ( ! empty( $portrait_url ) ) : ?>
				<img src="<?php echo esc_url( $portrait_url ); ?>"
				     alt="<?php esc_attr_e( 'Luxury homeowners', 'luxury-re-widgets' ); ?>"
				     loading="lazy">
				<?php endif; ?>
				<?php if ( $show_overlay ) : ?>
				<div class="testimonial__image-overlay"<?php echo $fade_style; ?>></div>
				<?php endif; ?>
			</div>

			<div class="testimonial__content-col"<?php echo $col_style; ?>>
				<div class="testimonial__inner reveal">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<div class="testimonial__eyebrow-wrap">
						<?php if ( $show_gold_bar ) : ?>
						<span class="testimonial__gold-bar testimonial__eyebrow-bar" aria-hidden="true"<?php echo $bar_style; ?>></span>
						<?php endif; ?>
						<span class="section-label section-label--light testimonial__eyebrow"<?php echo $eyebrow_style; ?>><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="testimonial__heading">
						<?php if ( ! empty( $settings['heading_main'] ) ) : ?>
						<span class="testimonial__heading-main"<?php echo $main_style; ?>><?php echo esc_html( $settings['heading_main'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $settings['heading_brand'] ) ) : ?>
						<span class="<?php echo esc_attr( $brand_class ); ?>"<?php echo $brand_style; ?>><?php echo esc_html( $settings['heading_brand'] ); ?></span>
						<?php endif; ?>
					</<?php echo $tag; ?>>

					<div class="testimonial__card-frame">
						<div class="testimonial__slider" id="testimonial-slider">
							<div class="testimonial__track" id="testimonial-track">
								<?php if ( ! empty( $settings['testimonials'] ) ) :
									foreach ( $settings['testimonials'] as $index => $item ) :
										$avatar_url = '';
										if ( ! empty( $item['client_avatar'] ) ) {
											if ( is_array( $item['client_avatar'] ) && ! empty( $item['client_avatar']['url'] ) ) {
												$avatar_url = trim( $item['client_avatar']['url'] );
											} elseif ( is_string( $item['client_avatar'] ) ) {
												$avatar_url = trim( $item['client_avatar'] );
											}
										}
										if ( empty( $avatar_url ) || false !== strpos( $avatar_url, 'avatar-blank.svg' ) ) {
											$avatar_url = $elementor_fallback;
										} else {
											$avatar_url = lre_resolve_image_url( $avatar_url, $elementor_fallback );
										}
										$active = 0 === $index ? ' active' : '';
								?>
								<div class="testimonial__slide<?php echo esc_attr( $active ); ?>" data-slide="<?php echo esc_attr( $index ); ?>">
									<blockquote class="testimonial__quote">
										<?php echo esc_html( $item['quote'] ); ?>
									</blockquote>

									<div class="testimonial__author">
										<div class="testimonial__author-avatar">
											<img src="<?php echo esc_url( $avatar_url ); ?>"
											     alt="<?php echo esc_attr( $item['client_name'] ); ?>"
											     loading="lazy" width="88" height="88"
											     onerror="this.onerror=null;this.src='<?php echo esc_url( $elementor_fallback ); ?>';">
										</div>
										<div class="testimonial__author-info">
											<span class="testimonial__author-name"><?php echo esc_html( $item['client_name'] ); ?></span>
											<?php if ( ! empty( $item['client_result'] ) ) : ?>
											<span class="testimonial__author-result"><?php echo esc_html( $item['client_result'] ); ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<?php endforeach; endif; ?>
							</div>
						</div>
					</div>

					<div class="testimonial__controls">
						<div class="testimonial__nav">
							<div class="testimonial__dots">
								<?php if ( ! empty( $settings['testimonials'] ) ) :
									foreach ( $settings['testimonials'] as $idx => $t ) :
										$dot_active = 0 === $idx ? ' active' : '';
								?>
								<button class="testimonial__nav-dot<?php echo esc_attr( $dot_active ); ?>" aria-label="<?php printf( esc_attr__( 'Story %d', 'luxury-re-widgets' ), $idx + 1 ); ?>" data-slide-index="<?php echo esc_attr( $idx ); ?>"></button>
								<?php endforeach; endif; ?>
							</div>
							<div class="testimonial__arrows">
								<button class="testimonial__arrow" id="testimonial-prev" aria-label="<?php esc_attr_e( 'Previous testimonial', 'luxury-re-widgets' ); ?>">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
								</button>
								<button class="testimonial__arrow" id="testimonial-next" aria-label="<?php esc_attr_e( 'Next testimonial', 'luxury-re-widgets' ); ?>">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18l6-6-6-6"/></svg>
								</button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>
		<?php
	}
}