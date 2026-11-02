<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Press_Widget
 *
 * Ultra-luxury "As Featured In & Accreditations" section.
 * Featuring the Asymmetric Editorial Layout (Left Headline / Right Floating Brand Portals)
 * and Centered Vitrine layout option with zero text clutter.
 * Showcases Voyage LA interview, EffectiveAgents award badge embed, and SERHANT brokerage.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Press_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_press';
	}

	public function get_title() {
		return __( 'LRE — Press & Recognition (Accolades)', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-award';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'press', 'voyagela', 'effectiveagents', 'awards', 'recognition', 'media', 'serhant', 'interview', 'accolades' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- SECTION 1: LAYOUT & HEADER ---
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Layout & Header Settings', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_header',
			array(
				'label'        => __( 'Show Header', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Tag', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'DISTINCTIONS & MEDIA',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Section Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Featured in & Industry Recognition', 'luxury-re-widgets' ),
				'placeholder' => __( 'Featured in & Industry Recognition', 'luxury-re-widgets' ),
				'description' => __( 'Supports multiple lines with Enter or <br> tags (with staggered luxury mask reveal animation).', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'     => __( 'Title HTML Tag', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'options'   => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Background Watermark', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'     => __( 'Watermark Word', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'ACCOLADES',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 2: EXHIBITS ---
		$this->start_controls_section(
			'section_exhibits',
			array(
				'label' => __( 'Press & Recognition Entities', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$default_voyage      = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/voyagela-logo-white.png' : plugins_url( 'assets/images/voyagela-logo-white.png', dirname( dirname( __FILE__ ) ) );
		$default_serhant     = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/serhant-logo-white.png' : plugins_url( 'assets/images/serhant-logo-white.png', dirname( dirname( __FILE__ ) ) );
		$default_award_badge = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/effectiveagents-badge.svg' : plugins_url( 'assets/images/effectiveagents-badge.svg', dirname( dirname( __FILE__ ) ) );

		// Entity 1: Voyage LA
		$this->add_control(
			'heading_voyage',
			array(
				'label' => __( '1. Voyage LA Interview', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'voyage_logo',
			array(
				'label'   => __( 'Voyage LA Logo (White)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => $default_voyage,
				),
			)
		);

		$this->add_control(
			'voyage_tag',
			array(
				'label'   => __( 'Category Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'FEATURED INTERVIEW',
			)
		);

		$this->add_control(
			'voyage_btn_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read Feature',
			)
		);

		$this->add_control(
			'voyage_link',
			array(
				'label'   => __( 'Interview Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url'         => 'https://voyagela.com/interview/exploring-life-business-with-adolfo-aguirre-of-adolfo-aguirre',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);

		// Entity 2: EffectiveAgents
		$this->add_control(
			'heading_award',
			array(
				'label'     => __( '2. EffectiveAgents™ Award', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'award_badge_svg',
			array(
				'label'   => __( 'Official SVG Badge URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => $default_award_badge,
			)
		);

		$this->add_control(
			'award_tag',
			array(
				'label'   => __( 'Category Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'TOP AGENT AWARD',
			)
		);

		$this->add_control(
			'award_btn_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Verify Award',
			)
		);

		$this->add_control(
			'award_link',
			array(
				'label'   => __( 'Award Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url'         => 'https://www.effectiveagents.com/ca/downey',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);

		// Entity 3: SERHANT
		$this->add_control(
			'heading_serhant',
			array(
				'label'     => __( '3. SERHANT. Brokerage', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'serhant_logo',
			array(
				'label'   => __( 'SERHANT. Logo (White)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => $default_serhant,
				),
			)
		);

		$this->add_control(
			'serhant_tag',
			array(
				'label'   => __( 'Category Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'GLOBAL BROKERAGE',
			)
		);

		$this->add_control(
			'serhant_btn_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'View Profile',
			)
		);

		$this->add_control(
			'serhant_link',
			array(
				'label'   => __( 'Profile Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url'         => 'https://serhant.com/agents/adolfo-aguirre',
					'is_external' => true,
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		$this->start_controls_section(
			'style_appearance',
			array(
				'label' => __( 'Atmosphere & Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bg_color',
			array(
				'label'       => __( 'Background Color', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::COLOR,
				'default'     => '',
				'description' => __( 'Defaults to rich dark navy (#080c14). Select your theme Primary Color to match your palette.', 'luxury-re-widgets' ),
				'selectors'   => array(
					'{{WRAPPER}} .lre-press-strip' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accent_gold',
			array(
				'label'     => __( 'Gold Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-press-strip' => '--lre-press-gold: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'strip_padding',
			array(
				'label'      => __( 'Section Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '6.5',
					'bottom'   => '6.75',
					'left'     => '1.5',
					'right'    => '1.5',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-strip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- HEADER (TITLE & EYEBROW) STYLE ---
		$this->start_controls_section(
			'style_header',
			array(
				'label'     => __( 'Header & Title Typography', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-editorial__title, {{WRAPPER}} .lre-press-editorial__title span, {{WRAPPER}} .lre-press-editorial__title .title-mask > span' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-editorial__title, {{WRAPPER}} .lre-press-editorial__title span, {{WRAPPER}} .lre-press-editorial__title .title-mask > span',
			)
		);

		$this->add_responsive_control(
			'title_spacing',
			array(
				'label'      => __( 'Title Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 80, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 5, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-editorial__title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .section-label, {{WRAPPER}} .lre-press-editorial__eyebrow',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .section-label, {{WRAPPER}} .lre-press-editorial__eyebrow' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
					'{{WRAPPER}} .lre-press-editorial__gold-bar' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- EXHIBIT BOXES (CARDS) STYLE ---
		$this->start_controls_section(
			'style_boxes',
			array(
				'label' => __( 'Exhibit Boxes (Cards)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_box_style' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_box_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'box_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'box_border',
				'label'    => __( 'Border', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-portal',
			)
		);

		$this->add_responsive_control(
			'box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-portal' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-portal',
			)
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'tab_box_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'box_hover_bg_color',
			array(
				'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'box_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_hover_shadow',
				'label'    => __( 'Hover Box Shadow', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-portal:hover',
			)
		);

		$this->add_responsive_control(
			'box_hover_lift',
			array(
				'label'      => __( 'Hover Lift (Translate Y)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 25, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-portal:hover' => 'transform: translate3d(0, -{{SIZE}}{{UNIT}}, 0) !important;',
				),
			)
		);

		$this->add_control(
			'box_glow_color',
			array(
				'label'       => __( 'Aura Glow Color', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::COLOR,
				'description' => __( 'Soft ambient halo behind the card on hover.', 'luxury-re-widgets' ),
				'selectors'   => array(
					'{{WRAPPER}} .lre-press-portal__glow' => 'background: radial-gradient(ellipse at center, {{VALUE}} 0%, transparent 70%);',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_padding',
			array(
				'label'      => __( 'Box Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-portal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- BOX CATEGORY TITLES (TAGS) STYLE ---
		$this->start_controls_section(
			'style_box_tags',
			array(
				'label' => __( 'Box Category Titles (Tags)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tag_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-portal__tag',
			)
		);

		$this->start_controls_tabs( 'tabs_tag_style' );

		// Normal Tag Tab
		$this->start_controls_tab(
			'tab_tag_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'tag_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal__tag' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// Hover Tag Tab
		$this->start_controls_tab(
			'tab_tag_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'tag_hover_color',
			array(
				'label'     => __( 'Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal:hover .lre-press-portal__tag, {{WRAPPER}} .lre-press-portal__tag:hover' => 'color: {{VALUE}}; opacity: 1;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'tag_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'separator'  => 'before',
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 50, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 3, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-portal__tag' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// --- BRAND PORTALS (ACTION LINKS / BUTTONS) STYLE ---
		$this->start_controls_section(
			'style_portals',
			array(
				'label' => __( 'Action Links (Buttons)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'portal_action_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-portal__action, {{WRAPPER}} .lre-press-portal__action-text',
			)
		);

		$this->start_controls_tabs( 'tabs_action_btn' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_action_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'portal_action_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal__action, {{WRAPPER}} .lre-press-portal__action-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'portal_action_arrow_color',
			array(
				'label'     => __( 'Arrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal__arrow' => 'stroke: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'portal_action_line_color',
			array(
				'label'     => __( 'Underline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal__action-text::after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'tab_action_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'portal_action_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal:hover .lre-press-portal__action, {{WRAPPER}} .lre-press-portal:hover .lre-press-portal__action-text, {{WRAPPER}} .lre-press-portal__action:hover, {{WRAPPER}} .lre-press-portal__action:hover .lre-press-portal__action-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'portal_action_hover_arrow_color',
			array(
				'label'     => __( 'Hover Arrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal:hover .lre-press-portal__arrow, {{WRAPPER}} .lre-press-portal__action:hover .lre-press-portal__arrow' => 'stroke: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'portal_action_hover_line_color',
			array(
				'label'     => __( 'Hover Underline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal:hover .lre-press-portal__action-text::after, {{WRAPPER}} .lre-press-portal__action:hover .lre-press-portal__action-text::after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'portal_arrow_size',
			array(
				'label'      => __( 'Arrow Size', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'separator'  => 'before',
				'range'      => array(
					'px' => array( 'min' => 8, 'max' => 32, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-portal__arrow' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'portal_action_gap',
			array(
				'label'      => __( 'Text & Arrow Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 2, 'step' => 0.05 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-portal__action' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'portal_show_underline',
			array(
				'label'        => __( 'Show Hover Underline', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'selectors'    => array(
					'{{WRAPPER}} .lre-press-portal__action-text::after' => 'display: block;',
				),
			)
		);

		$this->end_controls_section();

		// --- DIVIDERS & ACCENTS STYLE ---
		$this->start_controls_section(
			'style_dividers',
			array(
				'label' => __( 'Dividers & Accents', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Central Spire
		$this->add_control(
			'heading_spire_div',
			array(
				'label' => __( 'Central Vertical Spire', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'show_spire',
			array(
				'label'        => __( 'Show Central Spire', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'spire_line_color',
			array(
				'label'     => __( 'Spire Line Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_spire' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .lre-press-editorial__spire-line' => 'background: linear-gradient(180deg, transparent, {{VALUE}} 50%, transparent);',
				),
			)
		);

		$this->add_control(
			'spire_diamond_color',
			array(
				'label'     => __( 'Diamond Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_spire' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .lre-press-editorial__spire-diamond' => 'background-color: {{VALUE}}; box-shadow: 0 0 10px {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'spire_diamond_size',
			array(
				'label'      => __( 'Diamond Size', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'condition'  => array( 'show_spire' => 'yes' ),
				'range'      => array(
					'px' => array( 'min' => 2, 'max' => 20, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-editorial__spire-diamond' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'spire_min_height',
			array(
				'label'      => __( 'Spire Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'condition'  => array( 'show_spire' => 'yes' ),
				'range'      => array(
					'px' => array( 'min' => 50, 'max' => 400, 'step' => 5 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-editorial__spire' => 'min-height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		// Box Dividers
		$this->add_control(
			'heading_portal_div',
			array(
				'label'     => __( 'Dividers Between Exhibit Cards', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_portal_dividers',
			array(
				'label'        => __( 'Show Card Dividers', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'portal_divider_color',
			array(
				'label'     => __( 'Divider Line Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_portal_dividers' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal:not(:last-child)::after' => 'background: linear-gradient(180deg, transparent, {{VALUE}} 50%, transparent);',
				),
			)
		);

		$this->add_responsive_control(
			'portal_divider_height',
			array(
				'label'      => __( 'Divider Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'condition'  => array( 'show_portal_dividers' => 'yes' ),
				'range'      => array(
					'%' => array( 'min' => 10, 'max' => 100, 'step' => 5 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-portal:not(:last-child)::after' => 'height: {{SIZE}}% !important; top: calc((100% - {{SIZE}}%) / 2) !important;',
				),
			)
		);

		$this->add_responsive_control(
			'portal_divider_width',
			array(
				'label'      => __( 'Divider Thickness', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'condition'  => array( 'show_portal_dividers' => 'yes' ),
				'range'      => array(
					'px' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-portal:not(:last-child)::after' => 'width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		// Section Top & Bottom Hairlines
		$this->add_control(
			'heading_section_hairlines',
			array(
				'label'     => __( 'Section Hairline Borders', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_top_border',
			array(
				'label'        => __( 'Show Top Border', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'description'  => __( 'Restores the elegant 1px hairline border at the top of the section.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'top_border_color',
			array(
				'label'     => __( 'Top Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_top_border' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .lre-press-strip' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'top_border_width',
			array(
				'label'      => __( 'Top Border Thickness', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'condition'  => array( 'show_top_border' => 'yes' ),
				'range'      => array(
					'px' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-strip' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'show_bottom_border',
			array(
				'label'        => __( 'Show Bottom Border', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
				'description'  => __( 'Optional bottom border hairline (off by default for seamless flow).', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'bottom_border_color',
			array(
				'label'     => __( 'Bottom Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_bottom_border' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .lre-press-strip' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'bottom_border_width',
			array(
				'label'      => __( 'Bottom Border Thickness', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'condition'  => array( 'show_bottom_border' => 'yes' ),
				'range'      => array(
					'px' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-strip' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- WATERMARK STYLE ---
		$this->start_controls_section(
			'style_watermark',
			array(
				'label'     => __( 'Watermark Typography', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Watermark Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-strip__watermark' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'watermark_typography',
				'label'    => __( 'Watermark Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-strip__watermark',
			)
		);

		$this->add_responsive_control(
			'watermark_top',
			array(
				'label'      => __( 'Vertical Offset (Top)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'vh' ),
				'range'      => array(
					'px'  => array( 'min' => -50, 'max' => 200 ),
					'rem' => array( 'min' => -2,  'max' => 15 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 2.5 ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-strip__watermark' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Helper to get resolved color value (supporting both manual hex and Elementor Global Colors)
	 *
	 * @param array  $settings
	 * @param string $control_name
	 * @param string $default
	 * @return string
	 */
	protected function get_resolved_color( $settings, $control_name, $default = '' ) {
		$globals = ! empty( $settings['__globals__'] ) 
			? $settings['__globals__'] 
			: ( method_exists( $this, 'get_settings' ) ? $this->get_settings( '__globals__' ) : array() );

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
		$settings           = $this->get_settings_for_display();
		$show_top_border    = ! isset( $settings['show_top_border'] ) || 'yes' === $settings['show_top_border'] || ( ! empty( $settings['show_borders'] ) && 'yes' === $settings['show_borders'] );
		$show_bottom_border = ( ! empty( $settings['show_bottom_border'] ) && 'yes' === $settings['show_bottom_border'] ) || ( ! empty( $settings['show_borders'] ) && 'yes' === $settings['show_borders'] );

		$border_classes = array();
		if ( ! $show_top_border ) {
			$border_classes[] = 'no-top-border';
		}
		if ( $show_bottom_border ) {
			$border_classes[] = 'has-bottom-border';
		}
		$border_class_str = implode( ' ', $border_classes );

		$has_header         = ( 'yes' === ( $settings['show_header'] ?? 'yes' ) && ( ! empty( $settings['title'] ) || ! empty( $settings['eyebrow'] ) ) );
		$show_spire         = ! isset( $settings['show_spire'] ) || 'yes' === $settings['show_spire'];
		$spire_class        = $show_spire ? 'has-spire' : 'no-spire';
		$show_dividers      = ! isset( $settings['show_portal_dividers'] ) || 'yes' === $settings['show_portal_dividers'];
		$flow_divider_class = $show_dividers ? 'has-dividers' : 'no-dividers';

		// Resolve all colors (supporting both manual hex and Elementor Global Colors)
		$css_vars = array();

		$res_bg = $this->get_resolved_color( $settings, 'bg_color' );
		if ( $res_bg ) {
			$css_vars[] = '--lre-press-bg: ' . $res_bg;
			$css_vars[] = 'background-color: ' . $res_bg;
		}

		$res_gold = $this->get_resolved_color( $settings, 'accent_gold' );
		if ( $res_gold ) {
			$css_vars[] = '--lre-press-gold: ' . $res_gold;
		}

		$res_title = $this->get_resolved_color( $settings, 'title_color' );
		if ( $res_title ) {
			$css_vars[] = '--lre-press-title-color: ' . $res_title;
		}

		$res_eyebrow = $this->get_resolved_color( $settings, 'eyebrow_color' );
		if ( $res_eyebrow ) {
			$css_vars[] = '--lre-press-eyebrow-color: ' . $res_eyebrow;
		}

		$res_box_bg = $this->get_resolved_color( $settings, 'box_bg_color' );
		if ( $res_box_bg ) {
			$css_vars[] = '--lre-press-box-bg: ' . $res_box_bg;
		}

		$res_box_hover_bg = $this->get_resolved_color( $settings, 'box_hover_bg_color' );
		if ( $res_box_hover_bg ) {
			$css_vars[] = '--lre-press-box-hover-bg: ' . $res_box_hover_bg;
		}

		$res_box_hover_border = $this->get_resolved_color( $settings, 'box_hover_border_color' );
		if ( $res_box_hover_border ) {
			$css_vars[] = '--lre-press-box-hover-border: ' . $res_box_hover_border;
		}

		$res_box_glow = $this->get_resolved_color( $settings, 'box_glow_color' );
		if ( $res_box_glow ) {
			$css_vars[] = '--lre-press-box-glow: ' . $res_box_glow;
		}

		$res_tag = $this->get_resolved_color( $settings, 'tag_color' );
		if ( $res_tag ) {
			$css_vars[] = '--lre-press-tag-color: ' . $res_tag;
		}

		$res_tag_hover = $this->get_resolved_color( $settings, 'tag_hover_color' );
		if ( $res_tag_hover ) {
			$css_vars[] = '--lre-press-tag-hover-color: ' . $res_tag_hover;
		}

		$res_action = $this->get_resolved_color( $settings, 'portal_action_color' );
		if ( $res_action ) {
			$css_vars[] = '--lre-press-action-color: ' . $res_action;
		}

		$res_action_hover = $this->get_resolved_color( $settings, 'portal_action_hover_color' );
		if ( $res_action_hover ) {
			$css_vars[] = '--lre-press-action-hover-color: ' . $res_action_hover;
		}

		$res_arrow = $this->get_resolved_color( $settings, 'portal_action_arrow_color' );
		if ( $res_arrow ) {
			$css_vars[] = '--lre-press-arrow-color: ' . $res_arrow;
		}

		$res_arrow_hover = $this->get_resolved_color( $settings, 'portal_action_hover_arrow_color' );
		if ( $res_arrow_hover ) {
			$css_vars[] = '--lre-press-arrow-hover-color: ' . $res_arrow_hover;
		}

		$res_line = $this->get_resolved_color( $settings, 'portal_action_line_color' );
		if ( $res_line ) {
			$css_vars[] = '--lre-press-action-line: ' . $res_line;
		}

		$res_line_hover = $this->get_resolved_color( $settings, 'portal_action_hover_line_color' );
		if ( $res_line_hover ) {
			$css_vars[] = '--lre-press-action-hover-line: ' . $res_line_hover;
		}

		$res_spire_line = $this->get_resolved_color( $settings, 'spire_line_color' );
		if ( $res_spire_line ) {
			$css_vars[] = '--lre-press-spire-line: ' . $res_spire_line;
		}

		$res_spire_diamond = $this->get_resolved_color( $settings, 'spire_diamond_color' );
		if ( $res_spire_diamond ) {
			$css_vars[] = '--lre-press-spire-diamond: ' . $res_spire_diamond;
		}

		$res_portal_divider = $this->get_resolved_color( $settings, 'portal_divider_color' );
		if ( $res_portal_divider ) {
			$css_vars[] = '--lre-press-divider-color: ' . $res_portal_divider;
		}

		$res_top_border = $this->get_resolved_color( $settings, 'top_border_color' );
		if ( ! $res_top_border ) {
			$res_top_border = $this->get_resolved_color( $settings, 'section_border_color' );
		}
		if ( $res_top_border ) {
			$css_vars[] = '--lre-press-top-border: ' . $res_top_border;
		}

		if ( ! empty( $settings['top_border_width']['size'] ) ) {
			$css_vars[] = '--lre-press-top-border-width: ' . intval( $settings['top_border_width']['size'] ) . ( $settings['top_border_width']['unit'] ?? 'px' );
		}

		$res_bottom_border = $this->get_resolved_color( $settings, 'bottom_border_color' );
		if ( ! $res_bottom_border ) {
			$res_bottom_border = $this->get_resolved_color( $settings, 'section_border_color' );
		}
		if ( $res_bottom_border ) {
			$css_vars[] = '--lre-press-bottom-border: ' . $res_bottom_border;
		}

		if ( ! empty( $settings['bottom_border_width']['size'] ) ) {
			$css_vars[] = '--lre-press-bottom-border-width: ' . intval( $settings['bottom_border_width']['size'] ) . ( $settings['bottom_border_width']['unit'] ?? 'px' );
		}

		$res_watermark = $this->get_resolved_color( $settings, 'watermark_color' );
		if ( $res_watermark ) {
			$css_vars[] = '--lre-press-watermark-color: ' . $res_watermark;
		}

		$strip_style = ! empty( $css_vars ) ? implode( '; ', $css_vars ) . ';' : '';

		$default_voyage      = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/voyagela-logo-white.png' : plugins_url( 'assets/images/voyagela-logo-white.png', dirname( dirname( __FILE__ ) ) );
		$default_serhant     = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/serhant-logo-white.png' : plugins_url( 'assets/images/serhant-logo-white.png', dirname( dirname( __FILE__ ) ) );
		$default_award_badge = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/effectiveagents-badge.svg' : plugins_url( 'assets/images/effectiveagents-badge.svg', dirname( dirname( __FILE__ ) ) );

		$voyage_logo_url = ! empty( $settings['voyage_logo']['url'] ) 
			? esc_url( $settings['voyage_logo']['url'] ) 
			: $default_voyage;

		$serhant_logo_url = ! empty( $settings['serhant_logo']['url'] ) 
			? esc_url( $settings['serhant_logo']['url'] ) 
			: $default_serhant;

		$award_badge_url = ! empty( $settings['award_badge_svg'] ) ? esc_url( $settings['award_badge_svg'] ) : $default_award_badge;
		if ( false !== strpos( $award_badge_url, 'effectiveagents.com/api/awards/badge' ) ) {
			$award_badge_url = $default_award_badge;
		}

		$voyage_url  = ! empty( $settings['voyage_link']['url'] ) ? esc_url( $settings['voyage_link']['url'] ) : '#';
		$award_url   = ! empty( $settings['award_link']['url'] ) ? esc_url( $settings['award_link']['url'] ) : '#';
		$serhant_url = ! empty( $settings['serhant_link']['url'] ) ? esc_url( $settings['serhant_link']['url'] ) : '#';
		?>
		<div class="lre-press-strip <?php echo esc_attr( $border_class_str ); ?>" id="press-recognition" aria-label="<?php esc_attr_e( 'Press and Recognition', 'luxury-re-widgets' ); ?>"<?php echo $strip_style ? ' style="' . esc_attr( $strip_style ) . '"' : ''; ?>>
			
			<?php if ( 'yes' === ( $settings['show_watermark'] ?? 'yes' ) && ! empty( $settings['watermark_text'] ) ) : ?>
				<div class="lre-press-strip__watermark" aria-hidden="true"><?php echo esc_html( $settings['watermark_text'] ); ?></div>
			<?php endif; ?>

			<div class="lre-press-strip__container">

				<!-- Asymmetric Editorial Composition (Left Masthead / Right 3 Brand Portals) -->
				<div class="lre-press-editorial <?php echo $has_header ? 'has-masthead' : 'no-masthead'; ?> <?php echo esc_attr( $spire_class ); ?> reveal">

					<!-- Left Masthead Anchor -->
					<?php if ( $has_header ) : ?>
						<div class="lre-press-editorial__masthead">
							<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
								<div class="lre-press-editorial__eyebrow-wrap">
									<span class="lre-press-editorial__gold-bar" aria-hidden="true"></span>
									<span class="section-label lre-press-editorial__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $settings['title'] ) ) : 
								$is_edit_mode  = \Elementor\Plugin::$instance->editor->is_edit_mode();
								$p_tag         = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
								$p_tag         = in_array( $p_tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p' ), true ) ? $p_tag : 'h2';
								$heading_raw   = $settings['title'];
								$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
								$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
								$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
								if ( empty( $heading_lines ) ) {
									$heading_lines = array( $heading_raw );
								}
							?>
								<<?php echo $p_tag; ?> class="lre-press-editorial__title">
									<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
										<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
									<?php endforeach; ?>
								</<?php echo $p_tag; ?>>
							<?php endif; ?>
						</div>

						<?php if ( $show_spire ) : ?>
						<!-- Center Vertical Dividing Spire -->
						<div class="lre-press-editorial__spire" aria-hidden="true">
							<span class="lre-press-editorial__spire-line"></span>
							<span class="lre-press-editorial__spire-diamond"></span>
							<span class="lre-press-editorial__spire-line"></span>
						</div>
						<?php endif; ?>
					<?php endif; ?>

					<!-- Right Floating Brand Exhibits Flow -->
					<div class="lre-press-editorial__flow <?php echo esc_attr( $flow_divider_class ); ?>">

						<!-- Exhibit 1: Voyage LA Interview -->
						<a href="<?php echo $voyage_url; ?>" target="_blank" rel="noopener noreferrer nofollow" class="lre-press-portal" title="<?php esc_attr_e( 'Read Voyage LA Feature', 'luxury-re-widgets' ); ?>">
							<div class="lre-press-portal__glow" aria-hidden="true"></div>
							<?php if ( ! empty( $settings['voyage_tag'] ) ) : ?>
								<span class="lre-press-portal__tag"><?php echo esc_html( $settings['voyage_tag'] ); ?></span>
							<?php endif; ?>
							<div class="lre-press-portal__logo-box">
								<img src="<?php echo $voyage_logo_url; ?>" alt="<?php esc_attr_e( 'Voyage LA Interview', 'luxury-re-widgets' ); ?>" width="180" height="38" loading="lazy" class="lre-press-portal__img lre-press-portal__img--voyage">
							</div>
							<?php if ( ! empty( $settings['voyage_btn_text'] ) ) : ?>
								<span class="lre-press-portal__action">
									<span class="lre-press-portal__action-text"><?php echo esc_html( $settings['voyage_btn_text'] ); ?></span>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="lre-press-portal__arrow" aria-hidden="true">
										<line x1="7" y1="17" x2="17" y2="7"></line>
										<polyline points="7 7 17 7 17 17"></polyline>
									</svg>
								</span>
							<?php endif; ?>
						</a>

						<!-- Exhibit 2: EffectiveAgents Award -->
						<a href="<?php echo $award_url; ?>" target="_blank" rel="noopener noreferrer nofollow" class="lre-press-portal" title="<?php esc_attr_e( 'Verify EffectiveAgents Award', 'luxury-re-widgets' ); ?>">
							<div class="lre-press-portal__glow" aria-hidden="true"></div>
							<?php if ( ! empty( $settings['award_tag'] ) ) : ?>
								<span class="lre-press-portal__tag"><?php echo esc_html( $settings['award_tag'] ); ?></span>
							<?php endif; ?>
							<div class="lre-press-portal__logo-box">
								<?php if ( ! empty( $award_badge_url ) ) : ?>
									<img src="<?php echo esc_url( $award_badge_url ); ?>" alt="<?php esc_attr_e( 'Top Real Estate Agent Award', 'luxury-re-widgets' ); ?>" width="165" height="52" loading="lazy" class="lre-press-portal__img lre-press-portal__img--award">
								<?php endif; ?>
							</div>
							<?php if ( ! empty( $settings['award_btn_text'] ) ) : ?>
								<span class="lre-press-portal__action">
									<span class="lre-press-portal__action-text"><?php echo esc_html( $settings['award_btn_text'] ); ?></span>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="lre-press-portal__arrow" aria-hidden="true">
										<line x1="7" y1="17" x2="17" y2="7"></line>
										<polyline points="7 7 17 7 17 17"></polyline>
									</svg>
								</span>
							<?php endif; ?>
						</a>

						<!-- Exhibit 3: SERHANT. Brokerage -->
						<a href="<?php echo $serhant_url; ?>" target="_blank" rel="noopener noreferrer" class="lre-press-portal" title="<?php esc_attr_e( 'View SERHANT. Profile', 'luxury-re-widgets' ); ?>">
							<div class="lre-press-portal__glow" aria-hidden="true"></div>
							<?php if ( ! empty( $settings['serhant_tag'] ) ) : ?>
								<span class="lre-press-portal__tag"><?php echo esc_html( $settings['serhant_tag'] ); ?></span>
							<?php endif; ?>
							<div class="lre-press-portal__logo-box">
								<img src="<?php echo $serhant_logo_url; ?>" alt="<?php esc_attr_e( 'SERHANT. Brokerage', 'luxury-re-widgets' ); ?>" width="160" height="32" loading="lazy" class="lre-press-portal__img lre-press-portal__img--serhant">
							</div>
							<?php if ( ! empty( $settings['serhant_btn_text'] ) ) : ?>
								<span class="lre-press-portal__action">
									<span class="lre-press-portal__action-text"><?php echo esc_html( $settings['serhant_btn_text'] ); ?></span>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="lre-press-portal__arrow" aria-hidden="true">
										<line x1="7" y1="17" x2="17" y2="7"></line>
										<polyline points="7 7 17 7 17 17"></polyline>
									</svg>
								</span>
							<?php endif; ?>
						</a>

					</div>

				</div>

			</div>
		</div>
		<?php
	}
}
