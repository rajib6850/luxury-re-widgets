<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Communities_Widget
 * Featured Communities infinite horizontal sliding reel with luxury cards.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Communities_Widget extends Widget_Base {

	public function get_name()       { return 'lre_communities'; }
	public function get_title()      { return __( 'LRE — Featured Communities', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-image-box'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'communities', 'neighborhoods', 'cities', 'slider', 'reel' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- HEADER ---
		$this->start_controls_section( 'section_header', array( 'label' => __( 'Header', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'eyebrow',     array( 'label' => __( 'Eyebrow',     'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,   'default' => 'Discover Local', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control(
			'show_gold_bar',
			array(
				'label'        => __( 'Show Eyebrow Line', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
			)
		);
		$this->add_control( 'heading',     array( 'label' => __( 'Heading',     'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,   'default' => 'Featured Communities',   'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_tag', array( 'label' => __( 'Heading Tag', 'luxury-re-widgets' ), 'type' => Controls_Manager::SELECT, 'default' => 'h2', 'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'div' => 'div' ) ) );
		$this->end_controls_section();

		// --- COMMUNITIES REPEATER ---
		$this->start_controls_section( 'section_communities', array( 'label' => __( 'Communities', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control(
			'source_type',
			array(
				'label'       => __( 'Communities Source', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'custom',
				'options'     => array(
					'neighborhoods' => __( 'Neighborhoods (Post Type)', 'luxury-re-widgets' ),
					'custom'        => __( 'Custom / Manual List (Repeater)', 'luxury-re-widgets' ),
				),
				'description' => __( 'Select whether to dynamically query enclaves from the "neighborhoods" Custom Post Type or use the manual custom list.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'cpt_posts_per_page',
			array(
				'label'       => __( 'Number of Neighborhoods to Show', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => -1,
				'min'         => -1,
				'max'         => 50,
				'step'        => 1,
				'description' => __( 'Set to -1 to display all published neighborhoods.', 'luxury-re-widgets' ),
				'condition'   => array(
					'source_type' => 'neighborhoods',
				),
			)
		);

		$this->add_control(
			'cpt_orderby',
			array(
				'label'     => __( 'Order By', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'menu_order',
				'options'   => array(
					'menu_order' => __( 'Menu Order', 'luxury-re-widgets' ),
					'title'      => __( 'Title (A-Z)', 'luxury-re-widgets' ),
					'date'       => __( 'Date Published', 'luxury-re-widgets' ),
					'rand'       => __( 'Random', 'luxury-re-widgets' ),
				),
				'condition' => array(
					'source_type' => 'neighborhoods',
				),
			)
		);

		$this->add_control(
			'cpt_order',
			array(
				'label'     => __( 'Order Direction', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ASC',
				'options'   => array(
					'ASC'  => __( 'Ascending (ASC)', 'luxury-re-widgets' ),
					'DESC' => __( 'Descending (DESC)', 'luxury-re-widgets' ),
				),
				'condition' => array(
					'source_type' => 'neighborhoods',
				),
			)
		);

		$repeater = new Repeater();
		$repeater->add_control( 'comm_image', array( 'label' => __( 'Community Image', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => lre_asset_url( 'images/property-1.jpg' ) ), 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'comm_name',  array( 'label' => __( 'Community Name',  'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,  'default' => 'Pacific Palisades', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'comm_link',  array( 'label' => __( 'Community URL',   'luxury-re-widgets' ), 'type' => Controls_Manager::URL,   'default' => array( 'url' => '#' ) ) );

		$this->add_control( 'communities', array(
			'label'       => __( 'Communities List', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array( 'comm_name' => 'Pacific Palisades', 'comm_image' => array( 'url' => lre_asset_url( 'images/property-1.jpg' ) ) ),
				array( 'comm_name' => 'Bel Air',           'comm_image' => array( 'url' => lre_asset_url( 'images/property-2.jpg' ) ) ),
				array( 'comm_name' => 'Brentwood',         'comm_image' => array( 'url' => lre_asset_url( 'images/property-3.jpg' ) ) ),
				array( 'comm_name' => 'Malibu',            'comm_image' => array( 'url' => lre_asset_url( 'images/property-5.jpg' ) ) ),
				array( 'comm_name' => 'Holmby Hills',      'comm_image' => array( 'url' => lre_asset_url( 'images/property-6.jpg' ) ) ),
				array( 'comm_name' => 'Beverly Hills',     'comm_image' => array( 'url' => lre_asset_url( 'images/property-7.jpg' ) ) ),
			),
			'title_field' => '{{{ comm_name }}}',
			'condition'   => array(
				'source_type' => 'custom',
			),
		) );

		$this->add_responsive_control(
			'slider_mode',
			array(
				'label'          => __( 'Slider Mode', 'luxury-re-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'auto',
				'tablet_default' => 'auto',
				'mobile_default' => 'disable',
				'options'        => array(
					'auto'    => __( 'Auto (Slide if 4+ items, Grid if 3 or less)', 'luxury-re-widgets' ),
					'enable'  => __( 'Always Slide', 'luxury-re-widgets' ),
					'disable' => __( 'Always Grid (No Slide)', 'luxury-re-widgets' ),
				),
				'description'    => __( 'Choose whether to display as an interactive slider or a static grid per device. Defaults to Grid on Mobile.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: Section ---
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'section_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .communities' => 'background-color: {{VALUE}};' ) ) );
		$this->add_responsive_control( 'section_padding', array( 'label' => __( 'Padding', 'luxury-re-widgets' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em', 'rem' ), 'selectors' => array( '{{WRAPPER}} .communities' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();

		// --- STYLE: Header Content ---
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Header Content', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Sub-heading: Eyebrow
		$this->add_control(
			'heading_style_eyebrow',
			array(
				'label'     => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .communities__eyebrow, {{WRAPPER}} .communities__eyebrow-wrap .section-label, {{WRAPPER}} .communities .communities__eyebrow',
			)
		);
		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .communities__eyebrow, {{WRAPPER}} .section-label, {{WRAPPER}} .communities .communities__eyebrow, {{WRAPPER}} .communities .section-label, {{WRAPPER}} .communities__eyebrow-wrap .communities__eyebrow, {{WRAPPER}} .communities__eyebrow-wrap .section-label' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}}; --communities-eyebrow-color: {{VALUE}};',
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
					'{{WRAPPER}} .communities__eyebrow-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		// Sub-heading: Eyebrow Line (Gold Bar)
		$this->add_control(
			'heading_style_gold_bar',
			array(
				'label'     => __( 'Eyebrow Line', 'luxury-re-widgets' ),
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
				'selectors' => array(
					'{{WRAPPER}} .communities__gold-bar, {{WRAPPER}} .communities__eyebrow-bar' => 'background: {{VALUE}}; background-color: {{VALUE}}; --communities-gold-bar-color: {{VALUE}};',
				),
				'condition' => array(
					'show_gold_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'gold_bar_width',
			array(
				'label'      => __( 'Line Width (px)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array( 'min' => 8, 'max' => 100, 'step' => 2 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .communities__gold-bar, {{WRAPPER}} .communities__eyebrow-bar' => 'width: {{SIZE}}px !important; min-width: {{SIZE}}px !important;',
				),
				'condition'  => array(
					'show_gold_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'gold_bar_height',
			array(
				'label'      => __( 'Line Height (px)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array( 'min' => 1, 'max' => 8, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .communities__gold-bar, {{WRAPPER}} .communities__eyebrow-bar' => 'height: {{SIZE}}px !important;',
				),
				'condition'  => array(
					'show_gold_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'gold_bar_offset_y',
			array(
				'label'      => __( 'Line Vertical Offset (px)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array( 'min' => -20, 'max' => 20, 'step' => 1 ),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .communities__gold-bar, {{WRAPPER}} .communities__eyebrow-bar' => 'transform: translateY({{SIZE}}px);',
				),
				'condition'  => array(
					'show_gold_bar' => 'yes',
				),
			)
		);

		// Sub-heading: Title / Heading
		$this->add_control(
			'heading_style_title',
			array(
				'label'     => __( 'Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .communities__title, {{WRAPPER}} .communities__title span, {{WRAPPER}} .communities__title .title-mask > span',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .communities__title, {{WRAPPER}} .communities__title span, {{WRAPPER}} .communities__title .title-mask > span' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
				),
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
					'{{WRAPPER}} .communities__title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		// Sub-heading: Header Layout & Spacing
		$this->add_control(
			'heading_style_header_layout',
			array(
				'label'     => __( 'Header Layout & Spacing', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'header_margin_bottom',
			array(
				'label'      => __( 'Header Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 120, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 8, 'step' => 0.25 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .communities__header' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'header_padding',
			array(
				'label'      => __( 'Header Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .communities__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->end_controls_section();

		// --- STYLE: Card Typography & Colors ---
		$this->start_controls_section( 'style_cards', array( 'label' => __( 'Community Cards', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control(
			'card_height',
			array(
				'label'      => __( 'Card Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vh', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 200, 'max' => 800, 'step' => 10 ),
					'%'   => array( 'min' => 10,  'max' => 100, 'step' => 1 ),
					'vh'  => array( 'min' => 15,  'max' => 100, 'step' => 1 ),
					'rem' => array( 'min' => 15,  'max' => 60,  'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .community-card' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'card_typography', 'selector' => '{{WRAPPER}} .community-card__name' ) );
		$this->add_control( 'card_title_color', array( 'label' => __( 'Title Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .community-card__name' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// --- STYLE: Navigation Arrows ---
		$this->start_controls_section( 'style_nav_arrows', array( 'label' => __( 'Navigation Arrows', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );

		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'     => __( 'Button Diameter (px)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 30, 'max' => 70, 'step' => 2 ),
				),
				'default'   => array( 'unit' => 'px', 'size' => 44 ),
				'selectors' => array(
					'{{WRAPPER}} .communities__arrow, {{WRAPPER}} button.communities__arrow, {{WRAPPER}} .communities__arrows button' => 'width: {{SIZE}}px !important; height: {{SIZE}}px !important; min-width: {{SIZE}}px !important; min-height: {{SIZE}}px !important; --communities-arrow-size: {{SIZE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'arrow_icon_size',
			array(
				'label'     => __( 'Icon Size (px)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 10, 'max' => 32, 'step' => 1 ),
				),
				'default'   => array( 'unit' => 'px', 'size' => 18 ),
				'selectors' => array(
					'{{WRAPPER}} .communities__arrow svg, {{WRAPPER}} button.communities__arrow svg' => 'width: {{SIZE}}px !important; height: {{SIZE}}px !important; --communities-arrow-icon-size: {{SIZE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'arrows_gap',
			array(
				'label'      => __( 'Gap Between Arrows', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 40 ),
					'rem' => array( 'min' => 0, 'max' => 3 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 0.75 ),
				'selectors'  => array(
					'{{WRAPPER}} .communities__arrows' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_arrows' );
			$this->start_controls_tab( 'tab_arrows_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'arrow_bg',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .communities__arrow, {{WRAPPER}} button.communities__arrow, {{WRAPPER}} .communities__arrows button' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important; --communities-arrow-bg: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'arrow_color',
				array(
					'label'     => __( 'Arrow Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .communities__arrow, {{WRAPPER}} button.communities__arrow, {{WRAPPER}} .communities__arrows button' => 'color: {{VALUE}} !important; stroke: {{VALUE}} !important; --communities-arrow-color: {{VALUE}};',
						'{{WRAPPER}} .communities__arrow svg, {{WRAPPER}} button.communities__arrow svg' => 'color: {{VALUE}} !important; stroke: {{VALUE}} !important;',
						'{{WRAPPER}} .communities__arrow svg path, {{WRAPPER}} button.communities__arrow svg path' => 'stroke: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'arrow_border',
				array(
					'label'     => __( 'Arrow Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .communities__arrow, {{WRAPPER}} button.communities__arrow, {{WRAPPER}} .communities__arrows button' => 'border-color: {{VALUE}} !important; --communities-arrow-border: {{VALUE}};',
					),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_arrows_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'arrow_bg_hover',
				array(
					'label'     => __( 'Hover Background', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .communities__arrow:hover, {{WRAPPER}} button.communities__arrow:hover, {{WRAPPER}} .communities__arrows button:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important; --communities-arrow-hover-bg: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'arrow_color_hover',
				array(
					'label'     => __( 'Hover Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .communities__arrow:hover, {{WRAPPER}} button.communities__arrow:hover, {{WRAPPER}} .communities__arrows button:hover' => 'color: {{VALUE}} !important; stroke: {{VALUE}} !important; --communities-arrow-hover-color: {{VALUE}};',
						'{{WRAPPER}} .communities__arrow:hover svg, {{WRAPPER}} button.communities__arrow:hover svg' => 'color: {{VALUE}} !important; stroke: {{VALUE}} !important;',
						'{{WRAPPER}} .communities__arrow:hover svg path, {{WRAPPER}} button.communities__arrow:hover svg path' => 'stroke: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'arrow_border_hover',
				array(
					'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .communities__arrow:hover, {{WRAPPER}} button.communities__arrow:hover, {{WRAPPER}} .communities__arrows button:hover' => 'border-color: {{VALUE}} !important; --communities-arrow-hover-border: {{VALUE}};',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Queries enclaves dynamically from the 'neighborhoods' Custom Post Type.
	 *
	 * @param array $settings
	 * @return array
	 */
	protected function get_neighborhoods_from_cpt( $settings ) {
		$posts_per_page = ! empty( $settings['cpt_posts_per_page'] ) ? intval( $settings['cpt_posts_per_page'] ) : -1;
		$orderby        = ! empty( $settings['cpt_orderby'] ) ? sanitize_key( $settings['cpt_orderby'] ) : 'menu_order';
		$order          = ! empty( $settings['cpt_order'] ) ? sanitize_key( $settings['cpt_order'] ) : 'ASC';

		$query_args = array(
			'post_type'      => array( 'neighborhoods', 'neighborhood' ),
			'post_status'    => 'publish',
			'posts_per_page' => $posts_per_page,
			'orderby'        => $orderby,
			'order'          => $order,
		);

		$posts = get_posts( $query_args );
		$communities = array();

		if ( ! empty( $posts ) ) {
			foreach ( $posts as $p ) {
				$post_id = $p->ID;
				$name    = get_the_title( $post_id );
				$url     = get_permalink( $post_id );

				// Featured Image
				$img_url = get_the_post_thumbnail_url( $post_id, 'full' );
				if ( empty( $img_url ) ) {
					$thumb_id = get_post_meta( $post_id, '_thumbnail_id', true );
					if ( $thumb_id ) {
						$img_url = wp_get_attachment_image_url( $thumb_id, 'full' );
					}
				}
				if ( empty( $img_url ) ) {
					$img_url = lre_asset_url( 'images/property-1.jpg' );
				}

				$communities[] = array(
					'comm_name'  => $name,
					'comm_image' => array( 'url' => lre_resolve_image_url( $img_url ) ),
					'comm_link'  => array( 'url' => $url ),
				);
			}
		}

		return $communities;
	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$tag         = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag         = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $tag : 'h2';

		// Resolve communities based on source_type
		$source_type = $settings['source_type'] ?? 'custom';

		if ( 'neighborhoods' === $source_type ) {
			$communities = $this->get_neighborhoods_from_cpt( $settings );
			if ( empty( $communities ) ) {
				$communities = ! empty( $settings['communities'] ) ? $settings['communities'] : array();
			}
		} else {
			$communities = ! empty( $settings['communities'] ) ? $settings['communities'] : array();
		}

		$comm_count  = count( $communities );

		// Responsive Slider Modes
		$mode_desktop = $settings['slider_mode'] ?? 'auto';
		$mode_tablet  = ! empty( $settings['slider_mode_tablet'] ) ? $settings['slider_mode_tablet'] : $mode_desktop;
		$mode_mobile  = ! empty( $settings['slider_mode_mobile'] ) ? $settings['slider_mode_mobile'] : 'disable';

		$is_slider_desktop = ( 'enable' === $mode_desktop ) || ( 'auto' === $mode_desktop && $comm_count > 3 );
		$is_slider_tablet  = ( 'enable' === $mode_tablet )  || ( 'auto' === $mode_tablet && $comm_count > 3 );
		$is_slider_mobile  = ( 'enable' === $mode_mobile )  || ( 'auto' === $mode_mobile && $comm_count > 3 );

		$has_any_slider = $is_slider_desktop || $is_slider_tablet || $is_slider_mobile;
		$is_slider      = $is_slider_desktop; // default desktop fallback

		$section_classes   = array( 'communities' );
		$section_classes[] = $is_slider_desktop ? 'communities--has-slider' : 'communities--no-slider';
		$section_classes[] = $is_slider_desktop ? 'communities--slider-desktop' : 'communities--grid-desktop';
		$section_classes[] = $is_slider_tablet  ? 'communities--slider-tablet'  : 'communities--grid-tablet';
		$section_classes[] = $is_slider_mobile  ? 'communities--slider-mobile'  : 'communities--grid-mobile';
		$comm_style_var    = '--comm-count: ' . max( 1, min( 3, $comm_count ) ) . ';';
		?>
		<section class="<?php echo esc_attr( implode( ' ', $section_classes ) ); ?>" id="communities" style="<?php echo esc_attr( $comm_style_var ); ?>" aria-label="<?php esc_attr_e( 'Featured communities', 'luxury-re-widgets' ); ?>">
			<div class="communities__header">
				<div class="communities__header-text reveal">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<div class="communities__eyebrow-wrap">
						<?php if ( ! isset( $settings['show_gold_bar'] ) || 'yes' === $settings['show_gold_bar'] ) : ?>
						<span class="communities__gold-bar" aria-hidden="true"></span>
						<?php endif; ?>
						<span class="section-label communities__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="communities__title">
						<?php
						$heading_raw   = $settings['heading'] ?? 'Featured Communities';
						$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
						$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
						$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
						if ( empty( $heading_lines ) ) {
							$heading_lines = array( $heading_raw );
						}
						foreach ( $heading_lines as $h_idx => $h_line ) : ?>
							<span class="title-mask"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>
				</div>

				<?php if ( $has_any_slider ) : ?>
				<div class="communities__arrows">
					<button class="communities__arrow" id="communities-prev" aria-label="<?php esc_attr_e( 'Previous communities', 'luxury-re-widgets' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
					</button>
					<button class="communities__arrow" id="communities-next" aria-label="<?php esc_attr_e( 'Next communities', 'luxury-re-widgets' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
					</button>
				</div>
				<?php endif; ?>
			</div>

			<div class="communities__slider" id="communities-slider"
			     data-slide-enabled="<?php echo $is_slider_desktop ? 'true' : 'false'; ?>"
			     data-slide-desktop="<?php echo $is_slider_desktop ? 'true' : 'false'; ?>"
			     data-slide-tablet="<?php echo $is_slider_tablet ? 'true' : 'false'; ?>"
			     data-slide-mobile="<?php echo $is_slider_mobile ? 'true' : 'false'; ?>">
				<div class="communities__track" id="communities-track">
					<?php if ( ! empty( $communities ) ) :
						foreach ( $communities as $c ) :
							$img_url     = ! empty( $c['comm_image']['url'] ) ? $c['comm_image']['url'] : lre_asset_url( 'images/property-1.jpg' );
							$link_url    = ! empty( $c['comm_link']['url'] ) ? esc_url( $c['comm_link']['url'] ) : '#';
							$link_target = ! empty( $c['comm_link']['is_external'] ) ? '_blank' : '_self';
					?>
					<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="community-card image-reveal">
						<img src="<?php echo esc_url( $img_url ); ?>"
						     alt="<?php echo esc_attr( $c['comm_name'] ); ?>"
						     class="community-card__image"
						     loading="lazy" width="600" height="900">
						<div class="community-card__overlay"></div>
						<h3 class="community-card__name"><?php echo esc_html( $c['comm_name'] ); ?></h3>
					</a>
					<?php endforeach; endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}