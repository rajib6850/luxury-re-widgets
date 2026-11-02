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
 * LRE_Sellers_Guide_Widget
 * Super-Luxury & Minimal Architectural Estate Disposition Monograph Widget.
 * Inspired by Official Partners, Knight Frank Private Office, and Christie's International Real Estate.
 *
 * Characteristics:
 * - Ultra-minimalist fine-art monograph layout (zero cards, zero boxes, zero dashboards).
 * - Generous architectural breathing room and deep obsidian atmosphere.
 * - Sequential alternating editorial chapters (I, II, III, IV).
 * - Large-format museum architectural photography with filmic aspect ratios.
 * - 100% Elementor live editor visibility guarantee (zero black screen).
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Sellers_Guide_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_sellers_guide';
	}

	public function get_title() {
		return __( 'LRE — Seller\'s Guide', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'seller', 'guide', 'disposition', 'estate', 'luxury', 'fiduciary', 'monograph', 'minimal', 'quiet luxury' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- SECTION 1: HEADER & WATERMARK ---
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header & Watermark', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Typographic Watermark', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'     => __( 'Watermark Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'DISPOSITION',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Section Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Estate Divestment Protocol',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Section Heading (H2)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Art of Silent Disposition',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'Heading HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
				),
				'default' => 'h2',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Section Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Representing premier architectural estates and generational holdings across global capital markets with absolute discretion.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 2: EDITORIAL MONOGRAPH CHAPTERS ---
		$this->start_controls_section(
			'section_chapters',
			array(
				'label' => __( 'Editorial Chapters (The Monograph)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'chapter_num',
			array(
				'label'   => __( 'Roman Numeral / Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'I',
			)
		);

		$repeater->add_control(
			'chapter_tag',
			array(
				'label'   => __( 'Discipline Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'VALUATION & PROVENANCE',
			)
		);

		$repeater->add_control(
			'chapter_title',
			array(
				'label'   => __( 'Chapter Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Pedigree, Provenance & Pricing',
			)
		);

		$repeater->add_control(
			'chapter_narrative',
			array(
				'label'   => __( 'Editorial Narrative', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Every landmark estate possesses an architectural narrative that transcends conventional appraisal. We conduct exhaustive provenance forensics and global capital liquidity modeling to establish peak sovereign valuation.',
			)
		);

		$repeater->add_control(
			'chapter_detail_label',
			array(
				'label'   => __( 'Detail Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Advisory Focus',
			)
		);

		$repeater->add_control(
			'chapter_detail_val',
			array(
				'label'   => __( 'Detail Statement', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Off-market capital flow analysis & architectural lineage audit',
			)
		);

		$repeater->add_control(
			'chapter_image',
			array(
				'label'   => __( 'Museum Photograph', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-2.jpg' ),
				),
			)
		);

		$repeater->add_control(
			'image_align',
			array(
				'label'   => __( 'Media Alignment', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'left'  => __( 'Media Left / Narrative Right', 'luxury-re-widgets' ),
					'right' => __( 'Narrative Left / Media Right', 'luxury-re-widgets' ),
				),
				'default' => 'left',
			)
		);

		$this->add_control(
			'chapters',
			array(
				'label'       => __( 'Chapters', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'chapter_num'          => 'I',
						'chapter_tag'          => 'VALUATION & PROVENANCE',
						'chapter_title'        => 'Pedigree, Provenance & Pricing',
						'chapter_narrative'    => 'Every landmark estate possesses an architectural narrative that transcends conventional appraisal. We conduct exhaustive provenance forensics and cross-border capital liquidity modeling to establish peak sovereign valuation.',
						'chapter_detail_label' => 'Fiduciary Focus',
						'chapter_detail_val'   => 'Off-market capital flow analysis & architectural lineage audit',
						'chapter_image'        => array( 'url' => lre_asset_url( 'images/property-2.jpg' ) ),
						'image_align'          => 'left',
					),
					array(
						'chapter_num'          => 'II',
						'chapter_tag'          => 'SOVEREIGN DISCRETION',
						'chapter_title'        => 'The Private Sovereign Salon',
						'chapter_narrative'    => 'The most valuable assets are rarely seen on public portals. We place landmark estates directly into the hands of pre-vetted family offices, sovereign wealth principals, and institutional trustees under strict bilateral non-disclosure agreements.',
						'chapter_detail_label' => 'Syndication Protocol',
						'chapter_detail_val'   => 'Direct unlisted placement across verified global family office registries',
						'chapter_image'        => array( 'url' => lre_asset_url( 'images/property-3.jpg' ) ),
						'image_align'          => 'right',
					),
					array(
						'chapter_num'          => 'III',
						'chapter_tag'          => 'NARRATIVE ARCHITECTURE',
						'chapter_title'        => 'Cinematographic Architecture & Press',
						'chapter_narrative'    => 'For estates destined for international prominence, we produce director-led 8K architectural cinema and commission bespoke 50-copy clothbound hardcover monographs, distributed exclusively to qualified global collectors and top design publications.',
						'chapter_detail_label' => 'Media Standard',
						'chapter_detail_val'   => 'Director-led 8K cinema, hardcover monographs & curated AD / FT press embargo',
						'chapter_image'        => array( 'url' => lre_asset_url( 'images/property-1.jpg' ) ),
						'image_align'          => 'left',
					),
					array(
						'chapter_num'          => 'IV',
						'chapter_tag'          => 'FIDUCIARY SETTLEMENT',
						'chapter_title'        => 'Anonymous Settlement & Escrow Shielding',
						'chapter_narrative'    => 'Complete fiduciary discretion from the first confidential memorandum to private wire settlement. We orchestrate blind trust entity deeds and fortified escrow channels to guarantee zero public digital footprint.',
						'chapter_detail_label' => 'Closing Architecture',
						'chapter_detail_val'   => 'Blind trust deed filings, multi-currency escrow & complete archival handover',
						'chapter_image'        => array( 'url' => lre_asset_url( 'images/property-4.jpg' ) ),
						'image_align'          => 'right',
					),
				),
				'title_field' => '{{{ chapter_num }}} — {{{ chapter_title }}}',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 1. SECTION BACKGROUND & SPACING
		// =================================================================
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
				'selector' => '{{WRAPPER}} .lre-sguide',
				'fields_options' => array(
					'background' => array( 'default' => 'classic' ),
					'color'      => array( 'default' => '#08080c' ),
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '140',
					'right'    => '0',
					'bottom'   => '140',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'container_max_width',
			array(
				'label'      => __( 'Container Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 900, 'max' => 1800 ),
					'vw' => array( 'min' => 60,  'max' => 100 ),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1320,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__container' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 2. WATERMARK TYPOGRAPHY & STYLE
		// =================================================================
		$this->start_controls_section(
			'style_watermark',
			array(
				'label'     => __( 'Watermark Typography & Style', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.032)',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__watermark' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'watermark_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__watermark',
			)
		);

		$this->add_responsive_control(
			'watermark_top',
			array(
				'label'      => __( 'Vertical Offset (Top)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'vh' ),
				'range'      => array(
					'px'  => array( 'min' => -100, 'max' => 300 ),
					'rem' => array( 'min' => -5,   'max' => 20 ),
					'vh'  => array( 'min' => -10,  'max' => 40 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 3.2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__watermark' => 'top: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'watermark_opacity',
			array(
				'label'     => __( 'Opacity', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0, 'max' => 1, 'step' => 0.01 ),
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__watermark' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 3. SECTION HEADER
		// =================================================================
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'header_spacing',
			array(
				'label'      => __( 'Header Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 20, 'max' => 160 ),
					'rem' => array( 'min' => 1,  'max' => 10 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 6.5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Eyebrow
		$this->add_control(
			'heading_style_eyebrow',
			array(
				'label'     => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__eyebrow, {{WRAPPER}} .lre-sguide .lre-sguide__eyebrow' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important; --sguide-eyebrow-color: {{VALUE}};',
					'{{WRAPPER}} .lre-sguide__eyebrow-bar, {{WRAPPER}} .lre-sguide .lre-sguide__eyebrow-bar' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__eyebrow',
			)
		);

		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Eyebrow Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 4,   'max' => 40 ),
					'rem' => array( 'min' => 0.2, 'max' => 2.5 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__eyebrow-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Main Title
		$this->add_control(
			'heading_style_title',
			array(
				'label'     => __( 'Section Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__title, {{WRAPPER}} .lre-sguide__title span, {{WRAPPER}} .lre-sguide__title .title-mask > span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__title, {{WRAPPER}} .lre-sguide__title .title-mask > span',
			)
		);

		$this->add_responsive_control(
			'title_spacing',
			array(
				'label'      => __( 'Title Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 4,   'max' => 60 ),
					'rem' => array( 'min' => 0.2, 'max' => 4 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 1.4,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Description
		$this->add_control(
			'heading_style_desc',
			array(
				'label'     => __( 'Section Description', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.65)',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__description' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => __( 'Description Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__description',
			)
		);

		$this->add_responsive_control(
			'desc_max_width',
			array(
				'label'      => __( 'Description Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', '%' ),
				'range'      => array(
					'px'  => array( 'min' => 300, 'max' => 1000 ),
					'rem' => array( 'min' => 20,  'max' => 65 ),
					'%'   => array( 'min' => 40,  'max' => 100 ),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 680,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__description' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 4. EDITORIAL CHAPTERS LAYOUT
		// =================================================================
		$this->start_controls_section(
			'style_chapters_layout',
			array(
				'label' => __( 'Chapters Monograph Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'chapters_gap',
			array(
				'label'      => __( 'Vertical Gap Between Chapters', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 30, 'max' => 200 ),
					'rem' => array( 'min' => 2,  'max' => 14 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 8.5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__chapters' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'chapter_col_gap',
			array(
				'label'      => __( 'Media & Content Column Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 20, 'max' => 120 ),
					'rem' => array( 'min' => 1,  'max' => 8 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 5.5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__chapter' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 5. CHAPTER TYPOGRAPHY & COLORS
		// =================================================================
		$this->start_controls_section(
			'style_chapter_content',
			array(
				'label' => __( 'Chapter Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Roman Numeral
		$this->add_control(
			'heading_style_chapter_num',
			array(
				'label' => __( 'Roman Numeral (I, II...)', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'chapter_num_color',
			array(
				'label'     => __( 'Numeral Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__chapter-num' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'chapter_num_typography',
				'label'    => __( 'Numeral Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-num',
			)
		);

		$this->add_control(
			'meta_sep_color',
			array(
				'label'     => __( 'Separator (/) Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.2)',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__meta-sep' => 'color: {{VALUE}};',
				),
			)
		);

		// Category / Tag
		$this->add_control(
			'heading_style_chapter_tag',
			array(
				'label'     => __( 'Category Tag', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'chapter_tag_color',
			array(
				'label'     => __( 'Tag Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.5)',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__chapter-tag' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'chapter_tag_typography',
				'label'    => __( 'Tag Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-tag',
			)
		);

		// Chapter Title
		$this->add_control(
			'heading_style_ch_title',
			array(
				'label'     => __( 'Chapter Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'ch_title_color',
			array(
				'label'     => __( 'Chapter Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__chapter-title, {{WRAPPER}} .lre-sguide__chapter-title span, {{WRAPPER}} .lre-sguide__chapter-title .title-mask > span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ch_title_typography',
				'label'    => __( 'Chapter Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-title, {{WRAPPER}} .lre-sguide__chapter-title .title-mask > span',
			)
		);

		$this->add_responsive_control(
			'ch_title_spacing',
			array(
				'label'      => __( 'Title Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 4,   'max' => 50 ),
					'rem' => array( 'min' => 0.2, 'max' => 3.5 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 1.4,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__chapter-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Chapter Narrative
		$this->add_control(
			'heading_style_ch_narrative',
			array(
				'label'     => __( 'Narrative Body Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'ch_narrative_color',
			array(
				'label'     => __( 'Narrative Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.65)',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__chapter-narrative' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ch_narrative_typography',
				'label'    => __( 'Narrative Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-narrative',
			)
		);

		$this->add_responsive_control(
			'ch_narrative_spacing',
			array(
				'label'      => __( 'Narrative Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 10,  'max' => 60 ),
					'rem' => array( 'min' => 0.5, 'max' => 4 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__chapter-narrative' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 6. FIDUCIARY DETAIL STATEMENT
		// =================================================================
		$this->start_controls_section(
			'style_chapter_detail',
			array(
				'label' => __( 'Fiduciary Detail Statement', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'detail_border_color',
			array(
				'label'     => __( 'Divider Line Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.08)',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__chapter-detail' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'detail_label_color',
			array(
				'label'     => __( 'Label Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__chapter-detail-label' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'detail_label_typography',
				'label'    => __( 'Label Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-detail-label',
			)
		);

		$this->add_control(
			'detail_val_color',
			array(
				'label'     => __( 'Statement Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.78)',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__chapter-detail-val' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'detail_val_typography',
				'label'    => __( 'Statement Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-detail-val',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 7. MUSEUM PHOTOGRAPHY & MEDIA FRAME
		// =================================================================
		$this->start_controls_section(
			'style_media',
			array(
				'label' => __( 'Museum Photography Frame', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'media_aspect_ratio',
			array(
				'label'   => __( 'Aspect Ratio', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '16 / 10',
				'options' => array(
					'16 / 10' => '16:10 Wide Film (Standard)',
					'16 / 9'  => '16:9 Cinema Wide',
					'4 / 3'   => '4:3 Fine Art',
					'3 / 2'   => '3:2 Classic 35mm',
					'1 / 1'   => '1:1 Square',
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__media-frame' => 'aspect-ratio: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'media_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide__media-frame' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'media_box_shadow',
				'label'    => __( 'Shadow', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__media-frame',
			)
		);

		$this->add_control(
			'heading_style_badge_num',
			array(
				'label'     => __( 'Corner Badge Numeral', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'badge_num_color',
			array(
				'label'     => __( 'Badge Numeral Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.85)',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__chapter-badge-num' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_num_typography',
				'label'    => __( 'Badge Numeral Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-badge-num',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag      = in_array( $tag, array( 'h1', 'h2', 'h3', 'div' ), true ) ? $tag : 'h2';

		// Live Editor preview visibility guarantee
		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}
		$reveal_class = $is_edit_mode ? 'revealed' : 'reveal';

		$show_watermark = ( 'yes' === $settings['show_watermark'] );
		$watermark_text = ! empty( $settings['watermark_text'] ) ? $settings['watermark_text'] : 'DISPOSITION';
		$eyebrow        = ! empty( $settings['eyebrow'] ) ? $settings['eyebrow'] : 'Estate Divestment Protocol';
		$heading_raw    = ! empty( $settings['heading'] ) ? $settings['heading'] : 'The Art of Silent Disposition';
		$description    = ! empty( $settings['description'] ) ? $settings['description'] : '';

		// Split heading lines for curtain reveal
		$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
		$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
		$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
		if ( empty( $heading_lines ) ) {
			$heading_lines = array( $heading_raw );
		}

		$chapters = ! empty( $settings['chapters'] ) ? $settings['chapters'] : array();
		?>
		<section class="lre-sguide lre-sguide--monograph" id="estate-disposition" aria-label="<?php esc_attr_e( 'Estate Divestment Protocol', 'luxury-re-widgets' ); ?>">

			<?php if ( $show_watermark && ! empty( $watermark_text ) ) : ?>
			<div class="lre-sguide__watermark" aria-hidden="true"><?php echo esc_html( $watermark_text ); ?></div>
			<?php endif; ?>

			<div class="container lre-sguide__container">

				<!-- --- 1. SECTION HEADER (Center-Aligned, Symmetrical Dual Gold Bars) --- -->
				<header class="lre-sguide__header <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $eyebrow ) ) : ?>
					<div class="lre-sguide__eyebrow-wrap">
						<span class="lre-sguide__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-sguide__title">
						<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
							<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>

					<?php if ( ! empty( $description ) ) : ?>
					<p class="lre-sguide__description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</header>

				<!-- --- 2. SEQUENTIAL EDITORIAL MONOGRAPH CHAPTERS --- -->
				<?php if ( ! empty( $chapters ) ) : ?>
				<div class="lre-sguide__chapters">
					<?php foreach ( $chapters as $c_idx => $ch ) :
						$align     = ! empty( $ch['image_align'] ) ? $ch['image_align'] : ( 0 === $c_idx % 2 ? 'left' : 'right' );
						$c_num     = ! empty( $ch['chapter_num'] ) ? $ch['chapter_num'] : sprintf( '%02d', $c_idx + 1 );
						$c_img     = ! empty( $ch['chapter_image']['url'] ) ? $ch['chapter_image']['url'] : lre_asset_url( 'images/property-2.jpg' );
						$det_label = ! empty( $ch['chapter_detail_label'] ) ? $ch['chapter_detail_label'] : '';
						$det_val   = ! empty( $ch['chapter_detail_val'] ) ? $ch['chapter_detail_val'] : '';
					?>
					<article class="lre-sguide__chapter lre-sguide__chapter--<?php echo esc_attr( $align ); ?> <?php echo esc_attr( $reveal_class ); ?>">
						
						<!-- Media Column (with signature .image-reveal shutter curtain) -->
						<div class="lre-sguide__chapter-media">
							<div class="lre-sguide__media-frame image-reveal <?php echo esc_attr( $reveal_class ); ?>">
								<img src="<?php echo esc_url( $c_img ); ?>" alt="<?php echo esc_attr( $ch['chapter_title'] ); ?>" loading="lazy" class="lre-sguide__chapter-img">
								<div class="lre-sguide__chapter-scrim" aria-hidden="true"></div>
								<span class="lre-sguide__chapter-badge-num" aria-hidden="true"><?php echo esc_html( $c_num ); ?></span>
							</div>
						</div>

						<!-- Narrative Column -->
						<div class="lre-sguide__chapter-content">
							<div class="lre-sguide__chapter-meta">
								<span class="lre-sguide__chapter-num"><?php echo esc_html( $c_num ); ?></span>
								<span class="lre-sguide__meta-sep" aria-hidden="true">/</span>
								<span class="lre-sguide__chapter-tag"><?php echo esc_html( $ch['chapter_tag'] ); ?></span>
							</div>

							<h3 class="lre-sguide__chapter-title"><span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $ch['chapter_title'] ); ?></span></span></h3>

							<p class="lre-sguide__chapter-narrative"><?php echo esc_html( $ch['chapter_narrative'] ); ?></p>

							<?php if ( ! empty( $det_val ) ) : ?>
							<div class="lre-sguide__chapter-detail">
								<?php if ( ! empty( $det_label ) ) : ?>
								<span class="lre-sguide__chapter-detail-label"><?php echo esc_html( $det_label ); ?></span>
								<?php endif; ?>
								<span class="lre-sguide__chapter-detail-val"><?php echo esc_html( $det_val ); ?></span>
							</div>
							<?php endif; ?>
						</div>

					</article>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

			</div>
		</section>
		<?php
	}
}
