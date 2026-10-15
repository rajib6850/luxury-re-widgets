<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

/**
 * LRE_Related_Neighborhoods_Widget
 *
 * Standalone Related Neighborhoods / Sister Territories Switcher Widget.
 * Automatically detects current community page context, queries sibling enclaves,
 * omits the current enclave, and presents ultra-luxury architectural preview cards
 * with optional All Communities Hub destination.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Related_Neighborhoods_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_related_neighborhoods';
	}

	public function get_title() {
		return __( 'LRE — Related Neighborhoods', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'related', 'neighborhoods', 'communities', 'sister', 'territories', 'enclaves', 'switcher', 'monograph' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- 1. SECTION HEADER ---
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_header',
			array(
				'label'        => __( 'Show Header', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'REGIONAL PORTFOLIO',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'show_header' => 'yes',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Explore Neighboring Territories',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'show_header' => 'yes',
				),
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
					'div'  => 'div',
				),
				'condition' => array(
					'show_header' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		// --- 2. AUTOMATIC QUERY & CONTEXT ---
		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Neighborhoods Source & Query', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'query_mode',
			array(
				'label'       => __( 'Source Mode', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'auto',
				'options'     => array(
					'auto'   => __( 'Automatic (ACF CPT: Neighborhoods)', 'luxury-re-widgets' ),
					'manual' => __( 'Manual Custom List (Repeater)', 'luxury-re-widgets' ),
				),
				'description' => __( 'Automatic mode queries published posts from the custom post type "neighborhoods" (created via ACF), safely reads the "subtitle" field (with ACF & postmeta fallbacks), and displays featured photography.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'       => __( 'Number of Neighborhoods to Show', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 3,
				'min'         => 1,
				'max'         => 12,
				'step'        => 1,
				'condition'   => array(
					'query_mode' => 'auto',
				),
			)
		);

		$this->add_control(
			'orderby',
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
					'query_mode' => 'auto',
				),
			)
		);

		$this->add_control(
			'order',
			array(
				'label'     => __( 'Order Direction', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ASC',
				'options'   => array(
					'ASC'  => __( 'Ascending (ASC)', 'luxury-re-widgets' ),
					'DESC' => __( 'Descending (DESC)', 'luxury-re-widgets' ),
				),
				'condition' => array(
					'query_mode' => 'auto',
				),
			)
		);

		$this->add_control(
			'exclude_current',
			array(
				'label'        => __( 'Exclude Current Neighborhood Post', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'description'  => __( 'When viewed on a single neighborhood page, automatically omits itself from the related cards.', 'luxury-re-widgets' ),
				'condition'    => array(
					'query_mode' => 'auto',
				),
			)
		);

		$this->add_control(
			'include_hub_card',
			array(
				'label'        => __( 'Include "All Communities Hub" Card', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'description'  => __( 'Appends an editorial card linking to the main /communities/ directory as the final card.', 'luxury-re-widgets' ),
				'condition'    => array(
					'query_mode' => 'auto',
				),
			)
		);

		$this->add_control(
			'hub_title',
			array(
				'label'       => __( 'Hub Card Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'All Communities Hub',
				'condition'   => array(
					'query_mode'       => 'auto',
					'include_hub_card' => 'yes',
				),
			)
		);

		$this->add_control(
			'hub_tagline',
			array(
				'label'       => __( 'Hub Card Tagline', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'View Full Southern California Architectural Enclaves',
				'condition'   => array(
					'query_mode'       => 'auto',
					'include_hub_card' => 'yes',
				),
			)
		);

		$this->add_control(
			'hub_link',
			array(
				'label'       => __( 'Hub Link URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'url' => home_url( '/communities/' ),
				),
				'condition'   => array(
					'query_mode'       => 'auto',
					'include_hub_card' => 'yes',
				),
			)
		);

		$this->add_control(
			'hub_image',
			array(
				'label'       => __( 'Hub Image', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => array(
					'url' => lre_asset_url( 'images/property-3.jpg' ),
				),
				'condition'   => array(
					'query_mode'       => 'auto',
					'include_hub_card' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		// --- 3. MANUAL REPEATER (When query_mode == manual) ---
		$this->start_controls_section(
			'section_manual_list',
			array(
				'label'     => __( 'Manual Neighborhoods List', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'query_mode' => 'manual',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			array(
				'label'       => __( 'Community Name', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'San Marino',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'tagline',
			array(
				'label'       => __( 'Tagline / Descriptor', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Enduring Prestige, Generational Acreage & Quiet Grandeur',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'   => __( 'Link URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => home_url( '/communities/san-marino/' ) ),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Card Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-4.jpg' ),
				),
			)
		);

		$this->add_control(
			'manual_list',
			array(
				'label'       => __( 'Neighborhood Cards', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'name'    => 'San Marino',
						'tagline' => 'Enduring Prestige, Generational Acreage & Quiet Grandeur',
						'link'    => array( 'url' => home_url( '/communities/san-marino/' ) ),
						'image'   => array( 'url' => lre_asset_url( 'images/property-4.jpg' ) ),
					),
					array(
						'name'    => 'Los Angeles',
						'tagline' => 'Iconic Modernism, Hillside Sanctuaries & Cultural Capital',
						'link'    => array( 'url' => home_url( '/communities/los-angeles/' ) ),
						'image'   => array( 'url' => lre_asset_url( 'images/property-5.jpg' ) ),
					),
					array(
						'name'    => 'All Communities Hub',
						'tagline' => 'View Full Southern California Architectural Enclaves',
						'link'    => array( 'url' => home_url( '/communities/' ) ),
						'image'   => array( 'url' => lre_asset_url( 'images/property-3.jpg' ) ),
					),
				),
				'title_field' => '{{{ name }}}',
			)
		);

		$this->end_controls_section();

		// --- 4. CARD BADGES & LABELS ---
		$this->start_controls_section(
			'section_card_labels',
			array(
				'label' => __( 'Card Labels & Indicators', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_card_eyebrow',
			array(
				'label'        => __( 'Show Card Eyebrow', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'card_eyebrow',
			array(
				'label'     => __( 'Card Eyebrow Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'ENCLAVE',
				'condition' => array(
					'show_card_eyebrow' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_card_tagline',
			array(
				'label'        => __( 'Show Tagline', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_card_arrow',
			array(
				'label'        => __( 'Show Action Link & Arrow', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'card_arrow_text',
			array(
				'label'     => __( 'Action Link Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'EXPLORE TERRITORY →',
				'condition' => array(
					'show_card_arrow' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE 1: SECTION CONTAINER & BACKGROUND ---
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section Layout & Background', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__switcher' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__switcher' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_border_top_color',
			array(
				'label'     => __( 'Top Border Line Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__switcher' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 2: HEADER TYPOGRAPHY & COLORS ---
		$this->start_controls_section(
			'style_header',
			array(
				'label'     => __( 'Header Typography & Colors', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_header' => 'yes',
				),
			)
		);

		$this->add_control(
			'heading_style_eyebrow',
			array(
				'label' => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__section-eyebrow',
			)
		);

		$this->add_control(
			'header_eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__section-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'heading_style_title',
			array(
				'label'     => __( 'Section Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__section-title',
			)
		);

		$this->add_control(
			'header_title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__section-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_bottom_spacing',
			array(
				'label'      => __( 'Header Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__switcher-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 3: CARDS ARCHITECTURE & HOVER ---
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Neighborhood Cards & Visuals', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'card_height',
			array(
				'label'      => __( 'Card Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 250, 'max' => 650, 'step' => 10 ),
				),
				'default'    => array(
					'size' => 390,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__sister-card' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'grid_columns',
			array(
				'label'          => __( 'Grid Columns', 'luxury-re-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1 Column',
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				),
				'selectors'      => array(
					'{{WRAPPER}} .lre-community__switcher-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				),
			)
		);

		$this->add_responsive_control(
			'grid_gap',
			array(
				'label'      => __( 'Grid Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'default'    => array(
					'size' => 2,
					'unit' => 'rem',
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__switcher-grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_accent',
			array(
				'label'     => __( 'Hover Accent & Top Line', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-card:hover'   => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .lre-community__sister-card::before' => 'background: linear-gradient(90deg, transparent, {{VALUE}}, transparent);',
				),
			)
		);

		$this->add_responsive_control(
			'card_radius',
			array(
				'label'      => __( 'Card Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__sister-card' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'scrim_opacity',
			array(
				'label'     => __( 'Gradient Scrim Darkness', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.2, 'max' => 1, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 0.95 ),
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-scrim' => 'opacity: {{SIZE}};',
				),
			)
		);

		// Typography: Card Eyebrow
		$this->add_control(
			'heading_style_card_eyebrow',
			array(
				'label'     => __( 'Card Eyebrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_eyebrow_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__sister-eyebrow',
			)
		);

		$this->add_control(
			'card_eyebrow_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		// Typography: Card Title (H3)
		$this->add_control(
			'heading_style_card_name',
			array(
				'label'     => __( 'Card Title (H3)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_name_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__sister-name',
			)
		);

		$this->add_control(
			'card_name_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'card_name_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__sister-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Typography: Card Tagline
		$this->add_control(
			'heading_style_card_tagline',
			array(
				'label'     => __( 'Card Tagline (Paragraph)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_tagline_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__sister-tagline',
			)
		);

		$this->add_control(
			'card_tagline_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-tagline' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'card_tagline_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__sister-tagline' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Typography: Card Action Link & Arrow
		$this->add_control(
			'heading_style_card_arrow',
			array(
				'label'     => __( 'Explore Link & Arrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_arrow_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__sister-arrow',
			)
		);

		$this->add_control(
			'card_arrow_color',
			array(
				'label'     => __( 'Normal Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-arrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_arrow_hover_color',
			array(
				'label'     => __( 'Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-card:hover .lre-community__sister-arrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Resolves neighborhood items automatically from the 'neighborhoods' Custom Post Type.
	 * Reads title, permalink, featured photography, and the ACF 'subtitle' field safely.
	 *
	 * @param array $settings
	 * @return array
	 */
	protected function get_automatic_neighborhoods( $settings ) {
		$current_id      = get_the_ID();
		$exclude_current = ( $settings['exclude_current'] ?? 'yes' ) === 'yes';
		$target_count    = ! empty( $settings['posts_per_page'] ) ? intval( $settings['posts_per_page'] ) : 3;
		$include_hub     = ( $settings['include_hub_card'] ?? 'yes' ) === 'yes';
		$orderby         = ! empty( $settings['orderby'] ) ? sanitize_key( $settings['orderby'] ) : 'menu_order';
		$order           = ! empty( $settings['order'] ) ? sanitize_key( $settings['order'] ) : 'ASC';

		// Calculate how many CPT items to query before appending hub card
		$max_cpt_items = $include_hub ? max( 1, $target_count - 1 ) : $target_count;

		$exclude_ids = array();
		if ( $exclude_current && $current_id ) {
			$exclude_ids[] = (int) $current_id;
		}

		// 1. Query Custom Post Type 'neighborhoods' (supports plural and singular)
		$query_args = array(
			'post_type'      => array( 'neighborhoods', 'neighborhood' ),
			'post_status'    => 'publish',
			'posts_per_page' => $max_cpt_items,
			'orderby'        => $orderby,
			'order'          => $order,
			'post__not_in'   => $exclude_ids,
		);

		$posts = get_posts( $query_args );
		$items = array();

		if ( ! empty( $posts ) ) {
			foreach ( $posts as $p ) {
				$post_id = $p->ID;
				$name    = get_the_title( $post_id );
				$url     = get_permalink( $post_id );

				// 1. Safely resolve Subtitle (ACF Safeguard)
				$tagline = '';
				if ( function_exists( 'get_field' ) ) {
					try {
						$tagline = get_field( 'subtitle', $post_id );
					} catch ( \Throwable $e ) {
						$tagline = '';
					}
				}
				// Fallback to standard postmeta if ACF is inactive or get_field returns empty
				if ( empty( $tagline ) ) {
					$tagline = get_post_meta( $post_id, 'subtitle', true );
				}
				// Fallback to post excerpt if subtitle meta is empty
				if ( empty( $tagline ) ) {
					$tagline = $p->post_excerpt;
				}

				// 2. Resolve Featured Image
				$img_url = get_the_post_thumbnail_url( $post_id, 'full' );
				if ( empty( $img_url ) ) {
					$thumb_id = get_post_meta( $post_id, '_thumbnail_id', true );
					if ( $thumb_id ) {
						$img_url = wp_get_attachment_image_url( $thumb_id, 'full' );
					}
				}
				// Default fallback luxury image
				if ( empty( $img_url ) ) {
					$img_url = lre_asset_url( 'images/property-4.jpg' );
				}

				$items[] = array(
					'name'    => $name,
					'tagline' => $tagline,
					'link'    => array( 'url' => $url ),
					'image'   => array( 'url' => lre_resolve_image_url( $img_url ) ),
				);
			}
		}

		// 2. Preview & Initial Setup Fallback (if CPT has no published posts yet)
		if ( empty( $items ) ) {
			$fallback_portfolio = array(
				array(
					'name'    => 'San Marino',
					'tagline' => 'Enduring Prestige, Generational Acreage & Quiet Grandeur',
					'link'    => array( 'url' => home_url( '/neighborhoods/san-marino/' ) ),
					'image'   => array( 'url' => lre_asset_url( 'images/property-4.jpg' ) ),
				),
				array(
					'name'    => 'Los Angeles',
					'tagline' => 'Iconic Modernism, Hillside Sanctuaries & Cultural Capital',
					'link'    => array( 'url' => home_url( '/neighborhoods/los-angeles/' ) ),
					'image'   => array( 'url' => lre_asset_url( 'images/property-5.jpg' ) ),
				),
				array(
					'name'    => 'Pasadena',
					'tagline' => 'Historic Craftsman Enclaves, Arroyo Seco Seclusion & Landmark Heritage',
					'link'    => array( 'url' => home_url( '/neighborhoods/pasadena/' ) ),
					'image'   => array( 'url' => lre_asset_url( 'images/property-1.jpg' ) ),
				),
			);

			$current_slug = $current_id ? get_post_field( 'post_name', $current_id ) : '';
			foreach ( $fallback_portfolio as $fb ) {
				if ( $exclude_current && ! empty( $current_slug ) && false !== stripos( $fb['link']['url'], $current_slug ) ) {
					continue;
				}
				$items[] = $fb;
				if ( count( $items ) >= $max_cpt_items ) {
					break;
				}
			}
		}

		// 3. Append "All Communities / Neighborhoods Hub" card as final card if enabled
		if ( $include_hub ) {
			$hub_title   = ! empty( $settings['hub_title'] ) ? $settings['hub_title'] : __( 'All Communities Hub', 'luxury-re-widgets' );
			$hub_tagline = ! empty( $settings['hub_tagline'] ) ? $settings['hub_tagline'] : __( 'View Full Southern California Architectural Enclaves', 'luxury-re-widgets' );
			$hub_url     = ! empty( $settings['hub_link']['url'] ) ? $settings['hub_link']['url'] : home_url( '/communities/' );
			$hub_img     = ! empty( $settings['hub_image']['url'] ) ? $settings['hub_image']['url'] : lre_asset_url( 'images/property-3.jpg' );

			$items[] = array(
				'name'    => $hub_title,
				'tagline' => $hub_tagline,
				'link'    => array( 'url' => $hub_url ),
				'image'   => array( 'url' => lre_resolve_image_url( $hub_img ) ),
			);
		}

		return $items;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$query_mode = $settings['query_mode'] ?? 'auto';

		if ( 'manual' === $query_mode ) {
			$items = ! empty( $settings['manual_list'] ) ? $settings['manual_list'] : array();
		} else {
			$items = $this->get_automatic_neighborhoods( $settings );
		}

		if ( empty( $items ) ) {
			return;
		}

		$show_header       = ( $settings['show_header'] ?? 'yes' ) === 'yes';
		$eyebrow           = $settings['eyebrow'] ?? 'REGIONAL PORTFOLIO';
		$title             = $settings['title'] ?? 'Explore Neighboring Territories';
		$title_tag         = esc_attr( $settings['title_tag'] ?? 'h2' );
		$title_tag         = in_array( $title_tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $title_tag : 'h2';

		$show_card_eyebrow = ( $settings['show_card_eyebrow'] ?? 'yes' ) === 'yes';
		$card_eyebrow_text = esc_html( $settings['card_eyebrow'] ?? 'ENCLAVE' );
		$show_card_tagline = ( $settings['show_card_tagline'] ?? 'yes' ) === 'yes';
		$show_card_arrow   = ( $settings['show_card_arrow'] ?? 'yes' ) === 'yes';
		$card_arrow_text   = esc_html( $settings['card_arrow_text'] ?? 'EXPLORE TERRITORY →' );
		?>

		<section class="lre-community__switcher lre-related-neighborhoods" id="related-neighborhoods" aria-label="<?php esc_attr_e( 'Related Neighborhoods', 'luxury-re-widgets' ); ?>">
			<div class="lre-community__container">

				<?php if ( $show_header ) : ?>
					<div class="lre-community__switcher-head">
						<?php if ( ! empty( $eyebrow ) ) : ?>
							<span class="lre-community__section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $title ) ) : ?>
							<<?php echo $title_tag; ?> class="lre-community__section-title"><?php echo esc_html( $title ); ?></<?php echo $title_tag; ?>>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="lre-community__switcher-grid">
					<?php foreach ( $items as $sister ) :
						$sis_name = esc_html( $sister['name'] ?? '' );
						$sis_tag  = esc_html( $sister['tagline'] ?? '' );
						$raw_img  = ! empty( $sister['image']['url'] ) ? $sister['image']['url'] : lre_asset_url( 'images/property-4.jpg' );
						$sis_img  = esc_url( lre_resolve_image_url( $raw_img ) );
						$sis_url  = ! empty( $sister['link']['url'] ) ? esc_url( $sister['link']['url'] ) : '#';
						$target   = ! empty( $sister['link']['is_external'] ) ? '_blank' : '_self';
					?>
						<a href="<?php echo $sis_url; ?>" target="<?php echo esc_attr( $target ); ?>" class="lre-community__sister-card">
							<div class="lre-community__sister-media">
								<img src="<?php echo $sis_img; ?>" alt="<?php echo esc_attr( $sis_name ); ?>" class="lre-community__sister-img" loading="lazy" />
								<div class="lre-community__sister-scrim"></div>
							</div>
							<div class="lre-community__sister-content">
								<?php if ( $show_card_eyebrow && ! empty( $card_eyebrow_text ) ) : ?>
									<span class="lre-community__sister-eyebrow"><?php echo $card_eyebrow_text; ?></span>
								<?php endif; ?>

								<h3 class="lre-community__sister-name"><?php echo $sis_name; ?></h3>

								<?php if ( $show_card_tagline && ! empty( $sis_tag ) ) : ?>
									<p class="lre-community__sister-tagline"><?php echo $sis_tag; ?></p>
								<?php endif; ?>

								<?php if ( $show_card_arrow && ! empty( $card_arrow_text ) ) : ?>
									<span class="lre-community__sister-arrow"><?php echo $card_arrow_text; ?></span>
								<?php endif; ?>
							</div>
						</a>
					<?php endforeach; ?>
				</div>

			</div>
		</section>
		<?php
	}
}
