<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Team_Widget
 * Ultra-luxury "Meet The Team" executive & agent showcase.
 * Features:
 * - Huge background watermark "TEAM" typography
 * - Clean serif header with title-mask reveal animation
 * - Interactive carousel slider (3 desktop, 2 tablet, 1 mobile)
 * - Circular navigation arrows matching luxury design system
 * - Dark luxury cards with subtle pattern, monochrome portraits,
 *   and bottom text overlay with serif names and italic roles.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Team_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_team';
	}

	public function get_title() {
		return __( 'LRE — Meet The Team', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'team', 'agents', 'advisors', 'realtors', 'leadership', 'about', 'luxury', 'carousel', 'slider' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION HEADER ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Watermark Text', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'       => __( 'Watermark Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'TEAM',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'show_eyebrow',
			array(
				'label'        => __( 'Show Eyebrow Label', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Leadership & Advisory',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_eyebrow' => 'yes' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Main Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Meet The Team',
				'placeholder' => 'Meet The Team',
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'div'  => 'div',
				),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => __( 'Subtitle / Tagline', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => 'The service you deserve in realtors you can trust.',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'header_alignment',
			array(
				'label'   => __( 'Header Alignment', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'   => array( 'title' => __( 'Left', 'luxury-re-widgets' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'luxury-re-widgets' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'luxury-re-widgets' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__header' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .lre-team__desc'   => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── TEAM MEMBERS REPEATER ──
		$this->start_controls_section(
			'section_team_members',
			array(
				'label' => __( 'Team Members', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'member_photo',
			array(
				'label'   => __( 'Portrait Photo', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=900&q=85',
				),
			)
		);

		$repeater->add_control(
			'member_name',
			array(
				'label'       => __( 'Full Name', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Spencer Barlow',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'member_role',
			array(
				'label'       => __( 'Role / Designation', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Realtor®',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'member_lic',
			array(
				'label'       => __( 'License / Credentials', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => 'DRE #01928472',
			)
		);

		$repeater->add_control(
			'member_email',
			array(
				'label'       => __( 'Email Address (optional)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => 'spencer@luxuryre.com',
			)
		);

		$repeater->add_control(
			'member_phone',
			array(
				'label'       => __( 'Direct Phone (optional)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => '+1 (310) 849-2041',
			)
		);

		$repeater->add_control(
			'member_link',
			array(
				'label'       => __( 'Card Link / Bio URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://...',
				'default'     => array( 'url' => '' ),
			)
		);

		$this->add_control(
			'members',
			array(
				'label'       => __( 'Members List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ member_name }}} — {{{ member_role }}}',
				'default'     => array(
					array(
						'member_name'  => 'Spencer Barlow',
						'member_role'  => 'Realtor®',
						'member_lic'   => 'DRE #01928472',
						'member_photo' => array( 'url' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=900&q=85' ),
					),
					array(
						'member_name'  => 'Jill Howell',
						'member_role'  => 'Realtor®',
						'member_lic'   => 'DRE #02049182',
						'member_photo' => array( 'url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=900&q=85' ),
					),
					array(
						'member_name'  => 'Randi Petersen - Rimando',
						'member_role'  => 'Realtor®',
						'member_lic'   => 'DRE #01839201',
						'member_photo' => array( 'url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=900&q=85' ),
					),
					array(
						'member_name'  => 'Victoria Sterling',
						'member_role'  => 'Managing Partner',
						'member_lic'   => 'DRE #01458923',
						'member_photo' => array( 'url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=900&q=85' ),
					),
					array(
						'member_name'  => 'Julian Montgomery',
						'member_role'  => 'Senior Broker Associate',
						'member_lic'   => 'DRE #01784910',
						'member_photo' => array( 'url' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=900&q=85' ),
					),
				),
			)
		);

		$this->end_controls_section();

		// ── CAROUSEL SETTINGS ──
		$this->start_controls_section(
			'section_carousel_settings',
			array(
				'label' => __( 'Carousel Settings', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_responsive_control(
			'cards_per_view',
			array(
				'label'          => __( 'Cards Visible At Once', 'luxury-re-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1 Card',
					'2' => '2 Cards',
					'3' => '3 Cards',
					'4' => '4 Cards',
				),
				'prefix_class'   => 'lre-team-view%s-',
			)
		);

		$this->add_responsive_control(
			'card_gap',
			array(
				'label'      => __( 'Gap Between Cards', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 10, 'max' => 60, 'step' => 2 ),
					'rem' => array( 'min' => 0.5, 'max' => 4, 'step' => 0.1 ),
				),
				'default'    => array( 'size' => 28, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team__track' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'show_arrows',
			array(
				'label'        => __( 'Show Navigation Arrows', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'        => __( 'Autoplay', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'autoplay_interval',
			array(
				'label'     => __( 'Autoplay Interval (ms)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'min'       => 2000,
				'max'       => 15000,
				'step'      => 500,
				'condition' => array( 'autoplay' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── SECTION STYLE ──
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section Background & Spacing', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_background',
				'label'    => __( 'Background', 'luxury-re-widgets' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .lre-team',
				'fields_options' => array(
					'background' => array( 'default' => 'classic' ),
					'color'      => array( 'default' => '#ffffff' ),
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '6.5',
					'right'    => '2',
					'bottom'   => '6.5',
					'left'     => '2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── WATERMARK STYLE ──
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
				'default'   => 'rgba(0, 0, 0, 0.038)',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__watermark' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'watermark_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-team__watermark',
			)
		);

		$this->add_responsive_control(
			'watermark_top',
			array(
				'label'      => __( 'Vertical Offset (Top)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'vh' ),
				'range'      => array(
					'px'  => array( 'min' => -100, 'max' => 200 ),
					'rem' => array( 'min' => -5,   'max' => 15 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 1.5 ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team__watermark' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── HEADER (TITLE & SUBTITLE) STYLE ──
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Title & Subtitle Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#111116',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__title, {{WRAPPER}} .lre-team__title span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-team__title, {{WRAPPER}} .lre-team__title .title-mask > span',
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(17, 17, 22, 0.65)',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__desc' => 'color: {{VALUE}} !important;',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => __( 'Subtitle Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-team__desc',
			)
		);

		$this->add_responsive_control(
			'header_spacing',
			array(
				'label'      => __( 'Bottom Spacing (Margin)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 20, 'max' => 120 ),
					'rem' => array( 'min' => 1,  'max' => 8 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 3.5 ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team__header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── TEAM CARDS STYLE ──
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Team Cards Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_aspect_ratio',
			array(
				'label'   => __( 'Card Aspect Ratio', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3/4',
				'options' => array(
					'3/4'  => '3:4 Portrait (Standard)',
					'4/5'  => '4:5 Tall',
					'1/1'  => '1:1 Square',
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-team__card' => 'aspect-ratio: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#111116',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'card_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'rem' ),
				'default'    => array(
					'top'      => '2',
					'right'    => '2',
					'bottom'   => '2',
					'left'     => '2',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team__card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'card_border',
				'label'    => __( 'Border', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-team__card',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_box_shadow',
				'label'    => __( 'Box Shadow', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-team__card',
			)
		);

		$this->add_control(
			'photo_grayscale',
			array(
				'label'        => __( 'Monochrome (B&W) Photos', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'description'  => __( 'Applies the editorial black & white filter matching the reference design.', 'luxury-re-widgets' ),
				'separator'    => 'before',
			)
		);

		$this->end_controls_section();

		// ── CARD TYPOGRAPHY (NAME & ROLE) ──
		$this->start_controls_section(
			'style_card_typography',
			array(
				'label' => __( 'Card Name & Role Typography', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Name Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__name' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'name_hover_color',
			array(
				'label'     => __( 'Name Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f8eed3',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__card:hover .lre-team__name' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => __( 'Name Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-team__name',
			)
		);

		$this->add_control(
			'role_color',
			array(
				'label'     => __( 'Role Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.82)',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__role' => 'color: {{VALUE}} !important;',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'role_typography',
				'label'    => __( 'Role Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-team__role',
			)
		);

		$this->end_controls_section();

		// ── NAVIGATION ARROWS STYLE ──
		$this->start_controls_section(
			'style_navigation',
			array(
				'label'     => __( 'Navigation Arrows Style', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_arrows' => 'yes' ),
			)
		);

		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'      => __( 'Button Diameter (px)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array( 'min' => 36, 'max' => 70, 'step' => 2 ),
				),
				'default'    => array( 'size' => 48, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team__arrow' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'arrow_icon_size',
			array(
				'label'      => __( 'Icon Size (px)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array( 'min' => 12, 'max' => 32, 'step' => 1 ),
				),
				'default'    => array( 'size' => 18, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team__arrow svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'arrow_offset',
			array(
				'label'      => __( 'Horizontal Offset (px)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array( 'min' => -50, 'max' => 50, 'step' => 1 ),
				),
				'default'    => array( 'size' => -24, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team__arrow--prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .lre-team__arrow--next' => 'right: {{SIZE}}px;',
				),
			)
		);

		// Normal / Hover Tabs for Arrow
		$this->start_controls_tabs( 'tabs_arrow_style' );

			$this->start_controls_tab( 'tab_arrow_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );

			$this->add_control(
				'arrow_color',
				array(
					'label'     => __( 'Icon Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#111116',
					'selectors' => array(
						'{{WRAPPER}} .lre-team__arrow' => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'arrow_bg',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .lre-team__arrow' => 'background-color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'arrow_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'rgba(197, 160, 71, 0.45)',
					'selectors' => array(
						'{{WRAPPER}} .lre-team__arrow' => 'border-color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'arrow_box_shadow',
					'label'    => __( 'Box Shadow', 'luxury-re-widgets' ),
					'selector' => '{{WRAPPER}} .lre-team__arrow',
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_arrow_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );

			$this->add_control(
				'arrow_hover_color',
				array(
					'label'     => __( 'Icon Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#000000',
					'selectors' => array(
						'{{WRAPPER}} .lre-team__arrow:hover' => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'arrow_hover_bg',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .lre-team__arrow:hover' => 'background-color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'arrow_hover_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#c5a047',
					'selectors' => array(
						'{{WRAPPER}} .lre-team__arrow:hover' => 'border-color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'arrow_hover_box_shadow',
					'label'    => __( 'Box Shadow', 'luxury-re-widgets' ),
					'selector' => '{{WRAPPER}} .lre-team__arrow:hover',
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$show_wm     = ( 'yes' === ( $settings['show_watermark'] ?? 'yes' ) );
		$watermark   = esc_html( $settings['watermark_text'] ?? 'TEAM' );
		$show_eyebrow = ( 'yes' === ( $settings['show_eyebrow'] ?? 'no' ) );
		$eyebrow     = esc_html( $settings['eyebrow'] ?? '' );
		$title       = esc_html( $settings['title'] ?? 'Meet The Team' );
		$tag         = esc_attr( $settings['title_tag'] ?? 'h2' );
		$tag         = in_array( $tag, array( 'h1', 'h2', 'h3', 'div' ), true ) ? $tag : 'h2';
		$desc        = esc_html( $settings['subtitle'] ?? '' );
		$members     = ! empty( $settings['members'] ) ? $settings['members'] : array();
		$show_arrows = ( 'yes' === ( $settings['show_arrows'] ?? 'yes' ) );
		$autoplay    = ( 'yes' === ( $settings['autoplay'] ?? 'no' ) ) ? 'yes' : 'no';
		$interval    = intval( $settings['autoplay_interval'] ?? 5000 );
		$is_mono     = ( 'yes' === ( $settings['photo_grayscale'] ?? 'yes' ) ) ? ' lre-team--mono' : '';
		$widget_id   = $this->get_id();
		?>

		<section class="lre-team<?php echo esc_attr( $is_mono ); ?>" id="team-<?php echo esc_attr( $widget_id ); ?>" aria-label="<?php echo esc_attr( $title ); ?>">

			<?php if ( $show_wm && ! empty( $watermark ) ) : ?>
				<div class="lre-team__watermark" aria-hidden="true"><?php echo $watermark; ?></div>
			<?php endif; ?>

			<div class="lre-team__container">

				<!-- Header Section -->
				<div class="lre-team__header reveal">
					<?php if ( $show_eyebrow && ! empty( $eyebrow ) ) : ?>
						<div class="lre-team__eyebrow-wrap">
							<span class="lre-team__gold-bar" aria-hidden="true"></span>
							<span class="lre-team__eyebrow"><?php echo $eyebrow; ?></span>
							<span class="lre-team__gold-bar" aria-hidden="true"></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $title ) ) : ?>
						<<?php echo $tag; ?> class="lre-team__title">
							<span class="title-mask"><span><?php echo $title; ?></span></span>
						</<?php echo $tag; ?>>
					<?php endif; ?>

					<?php if ( ! empty( $desc ) ) : ?>
						<p class="lre-team__desc delay-1"><?php echo $desc; ?></p>
					<?php endif; ?>
				</div>

				<!-- Carousel Slider Wrap -->
				<?php if ( ! empty( $members ) ) : ?>
					<div class="lre-team__slider-wrap">

						<?php if ( $show_arrows ) : ?>
							<button type="button" class="lre-team__arrow lre-team__arrow--prev" id="lre-team-prev-<?php echo esc_attr( $widget_id ); ?>" aria-label="<?php esc_attr_e( 'Previous team member', 'luxury-re-widgets' ); ?>">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<line x1="19" y1="12" x2="5" y2="12"></line>
									<polyline points="12 19 5 12 12 5"></polyline>
								</svg>
							</button>
						<?php endif; ?>

						<!-- Viewport -->
						<div class="lre-team__viewport" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>">
							<div class="lre-team__track">
								<?php foreach ( $members as $idx => $m ) :
									$photo_url = ! empty( $m['member_photo']['url'] ) ? esc_url( $m['member_photo']['url'] ) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=900&q=85';
									$name      = esc_html( $m['member_name'] ?? '' );
									$role      = esc_html( $m['member_role'] ?? 'Realtor®' );
									$lic       = esc_html( $m['member_lic'] ?? '' );
									$link_url  = ! empty( $m['member_link']['url'] ) ? esc_url( $m['member_link']['url'] ) : '';
									$link_ext  = ! empty( $m['member_link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
								?>
									<article class="lre-team__card" data-index="<?php echo esc_attr( $idx ); ?>">
										<?php if ( ! empty( $link_url ) ) : ?>
											<a href="<?php echo $link_url; ?>" class="lre-team__card-link"<?php echo $link_ext; ?> aria-label="<?php echo esc_attr( $name ); ?>"></a>
										<?php endif; ?>

										<div class="lre-team__media">
											<div class="lre-team__media-pattern" aria-hidden="true"></div>
											<img src="<?php echo $photo_url; ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy">
											<div class="lre-team__media-overlay" aria-hidden="true"></div>
										</div>

										<div class="lre-team__info">
											<h3 class="lre-team__name"><?php echo $name; ?></h3>
											<?php if ( ! empty( $role ) ) : ?>
												<div class="lre-team__role"><?php echo $role; ?></div>
											<?php endif; ?>
											<?php if ( ! empty( $lic ) ) : ?>
												<div class="lre-team__lic"><?php echo $lic; ?></div>
											<?php endif; ?>
										</div>
									</article>
								<?php endforeach; ?>
							</div>
						</div>

						<?php if ( $show_arrows ) : ?>
							<button type="button" class="lre-team__arrow lre-team__arrow--next" id="lre-team-next-<?php echo esc_attr( $widget_id ); ?>" aria-label="<?php esc_attr_e( 'Next team member', 'luxury-re-widgets' ); ?>">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
							</button>
						<?php endif; ?>

					</div>
				<?php endif; ?>

			</div>
		</section>
		<?php
	}
}
