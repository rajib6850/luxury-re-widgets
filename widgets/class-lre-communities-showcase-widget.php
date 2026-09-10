<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

/**
 * LRE_Communities_Showcase_Widget
 * Minimalist Ultra-Luxury Communities & Enclaves Showcase.
 * Emphasizes generous negative space, breathtaking full-bleed photography,
 * minimal editorial typography, and exact H2 section title parity.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Communities_Showcase_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_communities_showcase';
	}

	public function get_title() {
		return __( 'LRE — Luxury Communities Showcase', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'communities', 'showcase', 'neighborhoods', 'enclaves', 'minimal', 'luxury', 'editorial' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- SECTION 1: HEADER & TYPOGRAPHY ---
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Exclusive Enclaves',
				'placeholder' => __( 'e.g. Exclusive Enclaves', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading (Multi-line / Title Mask)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "Featured Communities &<br>Private Neighborhoods",
				'description' => __( 'Supports <br> tags for smooth title-mask reveal lines matching other sections.', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'Heading HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'div'  => 'div',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Minimal Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => 'An intimate portfolio of Southern California’s most distinguished residential territories.',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 2: MINIMAL FILTER BAR ---
		$this->start_controls_section(
			'section_filter',
			array(
				'label' => __( 'Filter Navigation', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_filters',
			array(
				'label'        => __( 'Display Category Tabs', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		// --- SECTION 3: COMMUNITIES REPEATER ---
		$this->start_controls_section(
			'section_communities',
			array(
				'label' => __( 'Enclaves List', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'index_num',
			array(
				'label'   => __( 'Index Number (e.g. 01, 02)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'name',
			array(
				'label'   => __( 'Enclave Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Bel Air',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'category',
			array(
				'label'       => __( 'Category Slug (for filter)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'foothills',
				'description' => __( 'Matching filter slug (e.g. foothills, coastal, architectural, country).', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'category_label',
			array(
				'label'   => __( 'Category Label (Filter Display)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Foothills',
			)
		);

		$repeater->add_control(
			'tagline',
			array(
				'label'   => __( 'Subtle Descriptor', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Legendary Acreage & Guard-Gated Privacy',
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Architectural Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-2.jpg' ),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'   => __( 'Enclave URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$repeater->add_control(
			'show_button',
			array(
				'label'        => __( 'Show Action Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$repeater->add_control(
			'link_text',
			array(
				'label'     => __( 'Link Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Explore Enclave',
				'condition' => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'communities',
			array(
				'label'       => __( 'Enclaves', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'index_num'      => '01',
						'name'           => 'Bel Air',
						'category'       => 'foothills',
						'category_label' => 'Foothills',
						'tagline'        => 'Legendary Acreage & Guard-Gated Privacy',
						'image'          => array( 'url' => lre_asset_url( 'images/property-2.jpg' ) ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '02',
						'name'           => 'Beverly Hills',
						'category'       => 'foothills',
						'category_label' => 'Foothills',
						'tagline'        => 'Historic Manors & Palm-Lined Grandeur',
						'image'          => array( 'url' => lre_asset_url( 'images/property-1.jpg' ) ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '03',
						'name'           => 'Malibu Colony',
						'category'       => 'coastal',
						'category_label' => 'Coastal',
						'tagline'        => 'Barefoot Splendor & Pacific Waterfront',
						'image'          => array( 'url' => lre_asset_url( 'images/property-4.jpg' ) ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '04',
						'name'           => 'Pacific Palisades',
						'category'       => 'coastal',
						'category_label' => 'Coastal',
						'tagline'        => 'Dramatic Ocean Bluffs & Coastal Solitude',
						'image'          => array( 'url' => lre_asset_url( 'images/property-5.jpg' ) ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '05',
						'name'           => 'Trousdale Estates',
						'category'       => 'architectural',
						'category_label' => 'Architectural',
						'tagline'        => 'Mid-Century Modernist Masterpieces',
						'image'          => array( 'url' => lre_asset_url( 'images/property-3.jpg' ) ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '06',
						'name'           => 'Brentwood Park',
						'category'       => 'country',
						'category_label' => 'Country',
						'tagline'        => 'Sycamore Compounds & Timeless Calm',
						'image'          => array( 'url' => lre_asset_url( 'images/property-6.jpg' ) ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
				),
				'title_field' => '{{{ index_num }}} — {{{ name }}} ({{{ category_label }}})',
			)
		);

		$this->add_control(
			'show_button',
			array(
				'label'        => __( 'Show Action Button / Link', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'separator'    => 'before',
				'description'  => __( 'Show or hide the "Explore Enclave" action button / link across all enclaves.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: SECTION & CANVAS ---
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section & Canvas', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase' => 'background-color: {{VALUE}};',
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
					'top'      => '110',
					'right'    => '20',
					'bottom'   => '110',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-comm-showcase' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: HEADER TYPOGRAPHY & COLORS ---
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Header Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Eyebrow
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
				'name'     => 'eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-comm-showcase__eyebrow, {{WRAPPER}} .lre-comm-showcase__eyebrow-wrap .section-label',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow & Accent Bar Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase__eyebrow, {{WRAPPER}} .lre-comm-showcase .lre-comm-showcase__eyebrow, {{WRAPPER}} .lre-comm-showcase__eyebrow-wrap .section-label' => 'color: {{VALUE}}; -webkit-text-fill-color: currentColor; --communities-eyebrow-color: {{VALUE}}; --lre-comm-eyebrow-color: {{VALUE}};',
					'{{WRAPPER}} .lre-comm-showcase__gold-bar, {{WRAPPER}} .lre-comm-showcase .lre-comm-showcase__gold-bar, {{WRAPPER}} .lre-comm-showcase__eyebrow-wrap .lre-comm-showcase__gold-bar' => 'background-color: {{VALUE}}; --communities-gold-bar-color: {{VALUE}};',
				),
			)
		);

		// Heading
		$this->add_control(
			'heading_style_title',
			array(
				'label'     => __( 'Heading / Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => __( 'Heading Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-comm-showcase__title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Heading Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase__title, {{WRAPPER}} .lre-comm-showcase__title .title-mask > span, {{WRAPPER}} .lre-comm-showcase__title span, {{WRAPPER}} .lre-comm-showcase .lre-comm-showcase__title' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}}; --lre-comm-title-color: {{VALUE}};',
				),
			)
		);

		// Description
		$this->add_control(
			'heading_style_desc',
			array(
				'label'     => __( 'Description', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => __( 'Description Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-comm-showcase__description',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase__description' => 'color: {{VALUE}}; --lre-comm-desc-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: FILTER NAVIGATION ---
		$this->start_controls_section(
			'style_filters',
			array(
				'label' => __( 'Filter Navigation', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'filter_typography',
				'label'    => __( 'Filter Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-comm-nav-item',
			)
		);

		$this->add_control(
			'filter_color',
			array(
				'label'     => __( 'Normal Tab Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-nav-item' => 'color: {{VALUE}}; --lre-comm-filter-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_active_color',
			array(
				'label'     => __( 'Active & Hover Tab Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-nav-item:hover, {{WRAPPER}} .lre-comm-nav-item.is-active' => 'color: {{VALUE}}; --lre-comm-filter-active-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_accent_color',
			array(
				'label'     => __( 'Active Underline Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-nav-item.is-active::after' => 'background-color: {{VALUE}}; box-shadow: 0 0 8px {{VALUE}}; --lre-comm-filter-accent: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_sep_color',
			array(
				'label'     => __( 'Divider Slash Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-nav-sep' => 'color: {{VALUE}}; --lre-comm-filter-sep: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: ENCLAVE CARDS ---
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Enclave Cards & Gallery', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'heading_style_card_box',
			array(
				'label' => __( 'Card Box / Container', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->start_controls_tabs( 'tabs_card_box' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_card_box_normal',
			array(
				'label' => __( 'Normal', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'card_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame' => 'background-color: {{VALUE}}; --lre-comm-card-bg: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame' => 'border-color: {{VALUE}}; --lre-comm-card-border: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'tab_card_box_hover',
			array(
				'label' => __( 'Hover', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'card_hover_accent_color',
			array(
				'label'       => __( 'Hover Accent Color (All Gold Elements)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::COLOR,
				'description' => __( 'Changes the hover gold border, glow shadow, and action arrow together.', 'luxury-re-widgets' ),
				'selectors'   => array(
					'{{WRAPPER}} .lre-comm-frame:hover' => 'border-color: {{VALUE}}; --lre-comm-card-hover-border: {{VALUE}}; --lre-comm-card-hover-glow: {{VALUE}}; --lre-comm-card-hover-accent: {{VALUE}}; box-shadow: 0 20px 48px rgba(0, 0, 0, 0.45), 0 0 24px {{VALUE}};',
					'{{WRAPPER}} .lre-comm-frame:hover .lre-comm-frame__action-line' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .lre-comm-frame:hover .lre-comm-frame__action-arrow' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame:hover' => 'border-color: {{VALUE}}; --lre-comm-card-hover-border: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_glow_color',
			array(
				'label'       => __( 'Hover Glow / Shadow Color', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::COLOR,
				'description' => __( 'Controls the soft gold shadow glow aura surrounding the box on hover.', 'luxury-re-widgets' ),
				'selectors'   => array(
					'{{WRAPPER}} .lre-comm-frame:hover' => '--lre-comm-card-hover-glow: {{VALUE}}; box-shadow: 0 20px 48px rgba(0, 0, 0, 0.45), 0 0 24px {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_bg_color',
			array(
				'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		// Index Number
		$this->add_control(
			'heading_style_card_index',
			array(
				'label'     => __( 'Index Number', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'index_typography',
				'label'    => __( 'Index Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-comm-frame__index',
			)
		);

		$this->add_control(
			'index_color',
			array(
				'label'     => __( 'Index Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame__index' => 'color: {{VALUE}}; --lre-comm-index-color: {{VALUE}};',
				),
			)
		);

		// Category Badge
		$this->add_control(
			'heading_style_card_category',
			array(
				'label'     => __( 'Category Badge', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_typography',
				'label'    => __( 'Category Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-comm-frame__category',
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'     => __( 'Category Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame__category' => 'color: {{VALUE}}; --lre-comm-category-color: {{VALUE}};',
				),
			)
		);

		// Enclave Name / Title
		$this->add_control(
			'heading_style_card_name',
			array(
				'label'     => __( 'Enclave Name / Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_name_typography',
				'label'    => __( 'Name Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-comm-frame__name',
			)
		);

		$this->add_control(
			'card_name_color',
			array(
				'label'     => __( 'Name Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame__name, {{WRAPPER}} .lre-comm-frame:hover .lre-comm-frame__name' => 'color: {{VALUE}}; -webkit-text-fill-color: currentColor; --lre-comm-card-title-color: {{VALUE}};',
				),
			)
		);

		// Tagline / Descriptor
		$this->add_control(
			'heading_style_card_tagline',
			array(
				'label'     => __( 'Descriptor / Tagline', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_tagline_typography',
				'label'    => __( 'Tagline Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-comm-frame__tagline',
			)
		);

		$this->add_control(
			'card_tagline_color',
			array(
				'label'     => __( 'Tagline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame__tagline' => 'color: {{VALUE}}; --lre-comm-tagline-color: {{VALUE}};',
				),
			)
		);

		// Action Link & Line
		$this->add_control(
			'heading_style_card_action',
			array(
				'label'     => __( 'Action Link & Arrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'card_action_typography',
				'label'     => __( 'Action Link Typography', 'luxury-re-widgets' ),
				'selector'  => '{{WRAPPER}} .lre-comm-frame__action-text',
				'condition' => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'card_action_color',
			array(
				'label'     => __( 'Action Link Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame__action-text, {{WRAPPER}} .lre-comm-frame__action-arrow' => 'color: {{VALUE}}; stroke: {{VALUE}}; --lre-comm-action-color: {{VALUE}};',
				),
				'condition' => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'card_action_hover_color',
			array(
				'label'     => __( 'Action Hover Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-frame:hover .lre-comm-frame__action-text, {{WRAPPER}} .lre-comm-frame:hover .lre-comm-frame__action-arrow, {{WRAPPER}} .lre-comm-frame:hover .lre-comm-frame__action-line' => 'color: {{VALUE}}; stroke: {{VALUE}}; background-color: {{VALUE}}; --lre-comm-action-hover-color: {{VALUE}};',
				),
				'condition' => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$tag          = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag          = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $tag : 'h2';
		$show_button  = ! isset( $settings['show_button'] ) || 'yes' === $settings['show_button'];

		// Detect if inside Elementor editor / preview mode
		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}
		$reveal_class = $is_edit_mode ? 'revealed' : 'reveal';

		// Fallback communities if empty
		$communities = ! empty( $settings['communities'] ) ? $settings['communities'] : array(
			array(
				'index_num'      => '01',
				'name'           => 'Bel Air',
				'category'       => 'foothills',
				'category_label' => 'Foothills',
				'tagline'        => 'Legendary Acreage & Guard-Gated Privacy',
				'image'          => array( 'url' => lre_asset_url( 'images/property-2.jpg' ) ),
				'link'           => array( 'url' => '#contact' ),
				'link_text'      => 'Explore Enclave',
			),
			array(
				'index_num'      => '02',
				'name'           => 'Beverly Hills',
				'category'       => 'foothills',
				'category_label' => 'Foothills',
				'tagline'        => 'Historic Manors & Palm-Lined Grandeur',
				'image'          => array( 'url' => lre_asset_url( 'images/property-1.jpg' ) ),
				'link'           => array( 'url' => '#contact' ),
				'link_text'      => 'Explore Enclave',
			),
			array(
				'index_num'      => '03',
				'name'           => 'Malibu Colony',
				'category'       => 'coastal',
				'category_label' => 'Coastal',
				'tagline'        => 'Barefoot Splendor & Pacific Waterfront',
				'image'          => array( 'url' => lre_asset_url( 'images/property-4.jpg' ) ),
				'link'           => array( 'url' => '#contact' ),
				'link_text'      => 'Explore Enclave',
			),
			array(
				'index_num'      => '04',
				'name'           => 'Pacific Palisades',
				'category'       => 'coastal',
				'category_label' => 'Coastal',
				'tagline'        => 'Dramatic Ocean Bluffs & Coastal Solitude',
				'image'          => array( 'url' => lre_asset_url( 'images/property-5.jpg' ) ),
				'link'           => array( 'url' => '#contact' ),
				'link_text'      => 'Explore Enclave',
			),
			array(
				'index_num'      => '05',
				'name'           => 'Trousdale Estates',
				'category'       => 'architectural',
				'category_label' => 'Architectural',
				'tagline'        => 'Mid-Century Modernist Masterpieces',
				'image'          => array( 'url' => lre_asset_url( 'images/property-3.jpg' ) ),
				'link'           => array( 'url' => '#contact' ),
				'link_text'      => 'Explore Enclave',
			),
			array(
				'index_num'      => '06',
				'name'           => 'Brentwood Park',
				'category'       => 'country',
				'category_label' => 'Country',
				'tagline'        => 'Sycamore Compounds & Timeless Calm',
				'image'          => array( 'url' => lre_asset_url( 'images/property-6.jpg' ) ),
				'link'           => array( 'url' => '#contact' ),
				'link_text'      => 'Explore Enclave',
			),
		);

		// Collect unique categories for minimal filter tabs
		$categories = array();
		foreach ( $communities as $c ) {
			$cat_slug = sanitize_title( $c['category'] ?? '' );
			$cat_lbl  = ! empty( $c['category_label'] ) ? $c['category_label'] : ucfirst( $cat_slug );
			if ( ! empty( $cat_slug ) && ! isset( $categories[ $cat_slug ] ) ) {
				$categories[ $cat_slug ] = $cat_lbl;
			}
		}

		$show_filters = ( $settings['show_filters'] ?? '' ) === 'yes' && ! empty( $categories );
		?>
		<section class="lre-comm-showcase" id="communities-showcase" aria-label="<?php esc_attr_e( 'Featured Communities', 'luxury-re-widgets' ); ?>">
			<div class="lre-comm-showcase__container">

				<!-- --- SECTION HEADER (Matches H2 section titles across plugin) --- -->
				<header class="lre-comm-showcase__header <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<div class="lre-comm-showcase__eyebrow-wrap">
						<span class="lre-comm-showcase__gold-bar" aria-hidden="true"></span>
						<span class="section-label lre-comm-showcase__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-comm-showcase__title">
						<?php
						$heading_raw   = $settings['heading'] ?? "Featured Communities &<br>Private Neighborhoods";
						$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
						$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
						$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
						if ( empty( $heading_lines ) ) {
							$heading_lines = array( $heading_raw );
						}
						foreach ( $heading_lines as $h_idx => $h_line ) : ?>
							<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="lre-comm-showcase__description">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
					<?php endif; ?>
				</header>

				<!-- --- MINIMAL EDITORIAL FILTER TABS --- -->
				<?php if ( $show_filters ) : ?>
				<nav class="lre-comm-showcase__filter-nav <?php echo esc_attr( $reveal_class ); ?>" aria-label="<?php esc_attr_e( 'Filter communities', 'luxury-re-widgets' ); ?>">
					<button type="button" class="lre-comm-nav-item is-active" data-filter="all">
						<span><?php esc_html_e( 'All Enclaves', 'luxury-re-widgets' ); ?></span>
					</button>
					<?php foreach ( $categories as $c_slug => $c_label ) : ?>
					<span class="lre-comm-nav-sep" aria-hidden="true">/</span>
					<button type="button" class="lre-comm-nav-item" data-filter="<?php echo esc_attr( $c_slug ); ?>">
						<span><?php echo esc_html( $c_label ); ?></span>
					</button>
					<?php endforeach; ?>
				</nav>
				<?php endif; ?>

				<!-- --- MINIMALIST ARCHITECTURAL GALLERY GRID --- -->
				<div class="lre-comm-gallery" id="lre-comm-gallery">
					<?php
					foreach ( $communities as $c_idx => $c ) :
						$cat_slug  = sanitize_title( $c['category'] ?? '' );
						$img_url   = ! empty( $c['image']['url'] ) ? $c['image']['url'] : lre_asset_url( 'images/property-1.jpg' );
						$link_url  = ! empty( $c['link']['url'] ) ? esc_url( $c['link']['url'] ) : '#contact';
						$target    = ! empty( $c['link']['is_external'] ) ? '_blank' : '_self';
						$index_num = ! empty( $c['index_num'] ) ? $c['index_num'] : sprintf( '%02d', $c_idx + 1 );
					?>
					<article class="lre-comm-frame <?php echo esc_attr( $reveal_class ); ?>" data-category="<?php echo esc_attr( $cat_slug ); ?>">
						<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $target ); ?>" class="lre-comm-frame__link">
							<!-- Architectural Image with Subtle Slow Zoom -->
							<div class="lre-comm-frame__media">
								<img src="<?php echo esc_url( $img_url ); ?>"
								     alt="<?php echo esc_attr( $c['name'] ); ?>"
								     class="lre-comm-frame__img"
								     loading="lazy" width="800" height="1060">
								<div class="lre-comm-frame__vignette"></div>
							</div>

							<!-- Top Corner Index -->
							<div class="lre-comm-frame__header">
								<span class="lre-comm-frame__index"><?php echo esc_html( $index_num ); ?></span>
								<?php if ( ! empty( $c['category_label'] ) ) : ?>
								<span class="lre-comm-frame__category"><?php echo esc_html( $c['category_label'] ); ?></span>
								<?php endif; ?>
							</div>

							<!-- Bottom Minimal Narrative -->
							<div class="lre-comm-frame__footer">
								<h3 class="lre-comm-frame__name"><?php echo esc_html( $c['name'] ); ?></h3>

								<?php if ( ! empty( $c['tagline'] ) ) : ?>
								<p class="lre-comm-frame__tagline"><?php echo esc_html( $c['tagline'] ); ?></p>
								<?php endif; ?>

								<?php
								$item_show_btn = ! isset( $c['show_button'] ) || 'yes' === $c['show_button'];
								if ( $show_button && $item_show_btn ) :
								?>
								<div class="lre-comm-frame__action">
									<span class="lre-comm-frame__action-text"><?php echo esc_html( $c['link_text'] ?? 'Explore Enclave' ); ?></span>
									<span class="lre-comm-frame__action-line" aria-hidden="true"></span>
									<svg class="lre-comm-frame__action-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</div>
								<?php endif; ?>
							</div>
						</a>
					</article>
					<?php endforeach; ?>
				</div>

			</div>
		</section>
		<?php
	}
}
