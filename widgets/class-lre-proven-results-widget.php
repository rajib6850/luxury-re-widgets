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
 * LRE_Proven_Results_Widget
 * Super-Luxury & Minimal Architectural Case Studies Monograph Widget.
 * Built with exact structural parity to "LRE — Seller's Guide".
 *
 * Characteristics:
 * - Ultra-minimalist fine-art monograph layout (The Challenge | Our Approach | The Result).
 * - Generous architectural breathing room and deep obsidian atmosphere.
 * - Sequential alternating editorial chapters (01, 02, 03, 04, 05).
 * - Large-format museum architectural photography with filmic aspect ratios.
 * - Pre-loaded with Adolfo Aguirre's 5 landmark case studies from the Credentials PDF.
 * - 100% Elementor live editor visibility guarantee (zero black screen).
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Proven_Results_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_proven_results';
	}

	public function get_title() {
		return __( 'LRE — Proven Results', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-history';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'proven', 'results', 'case study', 'track record', 'seller', 'guide', 'disposition', 'portfolio', 'luxury', 'fiduciary', 'monograph' );
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
				'default'   => 'RESULTS',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Section Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Case Studies & Track Record',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Section Heading (H2)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Proven Results',
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
				'default' => 'Documented landmark estate transactions, bespoke repositioning strategies, and record-setting outcomes across Greater Los Angeles.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 2: EDITORIAL CASE STUDIES (THE MONOGRAPH) ---
		$this->start_controls_section(
			'section_chapters',
			array(
				'label' => __( 'Case Studies (The Monograph)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'chapter_num',
			array(
				'label'   => __( 'Index Numeral / Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'chapter_tag',
			array(
				'label'   => __( 'Location Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PASADENA, CA 91105',
			)
		);

		$repeater->add_control(
			'chapter_title',
			array(
				'label'   => __( 'Property Address / Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '788 S Grand Ave',
			)
		);

		$repeater->add_control(
			'format_mode',
			array(
				'label'   => __( 'Format Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'breakdown' => __( 'Structured (The Challenge | Our Approach | The Result)', 'luxury-re-widgets' ),
					'narrative' => __( 'Classic Narrative Monograph', 'luxury-re-widgets' ),
				),
				'default' => 'breakdown',
			)
		);

		// Challenge Block
		$repeater->add_control(
			'challenge_label',
			array(
				'label'     => __( 'Challenge Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'The Challenge',
				'condition' => array( 'format_mode' => 'breakdown' ),
			)
		);

		$repeater->add_control(
			'challenge_text',
			array(
				'label'       => __( 'The Challenge Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'This 1924 Italian-style residence, designed by architect Paul Loveland as his personal home and studio, was a true outlier. Its inverted floor plan, Arroyo Seco setting, and century-old construction narrowed the buyer pool considerably.',
				'condition'   => array( 'format_mode' => 'breakdown' ),
			)
		);

		// Approach Block
		$repeater->add_control(
			'approach_label',
			array(
				'label'     => __( 'Approach Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Our Approach',
				'condition' => array( 'format_mode' => 'breakdown' ),
			)
		);

		$repeater->add_control(
			'approach_text',
			array(
				'label'       => __( 'Our Approach Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'We refined the message and positioned the home as a one-of-one Mediterranean retreat—targeting design-driven buyers who value architectural authenticity over convention. Marketing emphasized craftsmanship and indoor–outdoor flow, allowing the inverted plan to read as intentional rather than a compromise.',
				'condition'   => array( 'format_mode' => 'breakdown' ),
			)
		);

		// Single Narrative Fallback
		$repeater->add_control(
			'chapter_narrative',
			array(
				'label'       => __( 'Editorial Narrative', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Every landmark estate possesses an architectural narrative that transcends conventional appraisal.',
				'condition'   => array( 'format_mode' => 'narrative' ),
			)
		);

		// Result Detail Statement
		$repeater->add_control(
			'chapter_detail_label',
			array(
				'label'   => __( 'Result Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Result',
			)
		);

		$repeater->add_control(
			'chapter_detail_val',
			array(
				'label'   => __( 'Result Statement (To Preserve)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'All-cash sale with a 16-day close; 20+ private showings.',
			)
		);

		$repeater->add_control(
			'chapter_image',
			array(
				'label'   => __( 'Museum Photograph', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => content_url( 'uploads/2026/09/788-S-Grand-Avenue.jpg' ),
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

		// Pre-populate with all 5 case studies from Credentials PDF Pages 11-15
		$this->add_control(
			'chapters',
			array(
				'label'       => __( 'Case Studies', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'chapter_num'          => '01',
						'chapter_tag'          => 'PASADENA, CA 91105',
						'chapter_title'        => '788 S Grand Ave',
						'format_mode'          => 'breakdown',
						'challenge_label'      => 'The Challenge',
						'challenge_text'       => 'This 1924 Italian-style residence, designed by architect Paul Loveland as his personal home and studio, was a true outlier. Its inverted floor plan, Arroyo Seco setting, and century-old construction narrowed the buyer pool considerably.',
						'approach_label'       => 'Our Approach',
						'approach_text'        => 'We refined the message and positioned the home as a one-of-one Mediterranean retreat—targeting design-driven buyers who value architectural authenticity over convention. Marketing emphasized craftsmanship and indoor–outdoor flow, allowing the inverted plan to read as intentional rather than a compromise.',
						'chapter_detail_label' => 'The Result',
						'chapter_detail_val'   => 'All-cash sale with a 16-day close; 20+ private showings.',
						'chapter_image'        => array( 'url' => content_url( 'uploads/2026/09/788-S-Grand-Avenue.jpg' ) ),
						'image_align'          => 'left',
					),
					array(
						'chapter_num'          => '02',
						'chapter_tag'          => 'PASADENA, CA 91105',
						'chapter_title'        => '555 S Grand Ave',
						'format_mode'          => 'breakdown',
						'challenge_label'      => 'The Challenge',
						'challenge_text'       => 'This 1908 Craftsman needed to be sold while the seller was abroad, requiring delicate coordination with tenants to ensure a smooth transition. The situation could have easily turned complicated.',
						'approach_label'       => 'Our Approach',
						'approach_text'        => 'We designed a Concierge-Style Experience—managing communication across time zones and working closely with tenants, while launching a high-impact marketing campaign. Architectural photography and videography showcased the property\'s historic character.',
						'chapter_detail_label' => 'The Result',
						'chapter_detail_val'   => 'Sold in six days, $100,000 over asking, with 50+ showings.',
						'chapter_image'        => array( 'url' => content_url( 'uploads/2026/09/555-S-Grand-Avenue.jpg' ) ),
						'image_align'          => 'right',
					),
					array(
						'chapter_num'          => '03',
						'chapter_tag'          => 'PASADENA, CA 91106',
						'chapter_title'        => '1065 Locust St',
						'format_mode'          => 'breakdown',
						'challenge_label'      => 'The Challenge',
						'challenge_text'       => 'This 117-year-old Craftsman required the right buyer and a thoughtful approach. The sellers were deliberate, interviewed multiple agents, and took over six months before listing. They needed guidance without pressure—and a plan that respected the home\'s age and inevitable inspection complexities.',
						'approach_label'       => 'Our Approach',
						'approach_text'        => 'We led with consistency and clarity—no overselling and no urgency tactics. Professional persistence, strategic pricing, and clean presentation attracted buyers who value historic Pasadena homes while calmly resolving inspection complexities.',
						'chapter_detail_label' => 'The Result',
						'chapter_detail_val'   => 'Under contract in 48 hours; sold $150,000 over asking.',
						'chapter_image'        => array( 'url' => content_url( 'uploads/2026/09/1065-Locust-Street.jpg' ) ),
						'image_align'          => 'left',
					),
					array(
						'chapter_num'          => '04',
						'chapter_tag'          => 'PASADENA, CA 91104',
						'chapter_title'        => '1841 N Garfield Ave',
						'format_mode'          => 'breakdown',
						'challenge_label'      => 'The Challenge',
						'challenge_text'       => 'For six months, this home sat on the market with another agent. No offers. No feedback. Just silence. The sellers grew frustrated and convinced their home was unsellable in this market.',
						'approach_label'       => 'Our Approach',
						'approach_text'        => 'We introduced our Concierge Launch Method—a complete repositioning of the property through strategic pricing psychology, architectural-quality visuals, virtual staging, and targeted digital campaigns to capture motivated local and out-of-area prospects.',
						'chapter_detail_label' => 'The Result',
						'chapter_detail_val'   => 'Previously listed for six months without offers; relaunched, received multiple offers, and sold $46,000 over asking.',
						'chapter_image'        => array( 'url' => content_url( 'uploads/2026/09/1841-N-Garfield-Avenue.jpg' ) ),
						'image_align'          => 'right',
					),
					array(
						'chapter_num'          => '05',
						'chapter_tag'          => 'LOS ANGELES, CA 90042',
						'chapter_title'        => '0 Wildwood Dr',
						'format_mode'          => 'breakdown',
						'challenge_label'      => 'The Challenge',
						'challenge_text'       => 'This hillside parcel was a true outlier—steep slope, dense trees, and limited road access. Most buyers couldn\'t visualize a build, and even experienced investors saw it as a risky, uphill project demanding a very specific kind of developer.',
						'approach_label'       => 'Our Approach',
						'approach_text'        => 'We built a highly targeted outreach strategy: every agent who\'d sold land nearby, every developer who\'d purchased similar steep hillside parcels, and out-of-area builders known for challenging topography received a tailored pitch highlighting the lot\'s potential.',
						'chapter_detail_label' => 'The Result',
						'chapter_detail_val'   => 'Challenging hillside parcel; full-price, all-cash offer secured in about 60 days.',
						'chapter_image'        => array( 'url' => content_url( 'uploads/2026/09/SOKA_view.jpg' ) ),
						'image_align'          => 'left',
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
					'{{WRAPPER}} .lre-sguide__eyebrow, {{WRAPPER}} .lre-sguide .lre-sguide__eyebrow' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
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
		// TAB_STYLE: 4. MONOGRAPH LAYOUT
		// =================================================================
		$this->start_controls_section(
			'style_chapters_layout',
			array(
				'label' => __( 'Case Studies Monograph Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'chapters_gap',
			array(
				'label'      => __( 'Vertical Gap Between Case Studies', 'luxury-re-widgets' ),
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
		// TAB_STYLE: 5. CASE STUDY TYPOGRAPHY & COLORS
		// =================================================================
		$this->start_controls_section(
			'style_chapter_content',
			array(
				'label' => __( 'Case Study Header & Titles', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Numeral
		$this->add_control(
			'heading_style_chapter_num',
			array(
				'label' => __( 'Index Numeral (01, 02...)', 'luxury-re-widgets' ),
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

		// Tag / Location
		$this->add_control(
			'heading_style_chapter_tag',
			array(
				'label'     => __( 'Location Tag', 'luxury-re-widgets' ),
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

		// Chapter Title / Address
		$this->add_control(
			'heading_style_ch_title',
			array(
				'label'     => __( 'Property Address / Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'ch_title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
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
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
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

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 6. THE CHALLENGE & OUR APPROACH BREAKDOWN
		// =================================================================
		$this->start_controls_section(
			'style_breakdown',
			array(
				'label' => __( 'The Challenge & Our Approach Breakdown', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'block_label_color',
			array(
				'label'     => __( 'Sub-heading Labels Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-presults__block-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'block_label_typography',
				'label'    => __( 'Sub-heading Labels Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-presults__block-label',
			)
		);

		$this->add_control(
			'block_text_color',
			array(
				'label'     => __( 'Prose Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.68)',
				'selectors' => array(
					'{{WRAPPER}} .lre-presults__block-text, {{WRAPPER}} .lre-sguide__chapter-narrative' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'block_text_typography',
				'label'    => __( 'Prose Text Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-presults__block-text, {{WRAPPER}} .lre-sguide__chapter-narrative',
			)
		);

		$this->add_responsive_control(
			'breakdown_item_gap',
			array(
				'label'      => __( 'Gap Between Blocks', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 8,   'max' => 48 ),
					'rem' => array( 'min' => 0.5, 'max' => 3 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 1.25,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-presults__breakdown' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 7. THE RESULT STATEMENT & BOX
		// =================================================================
		$this->start_controls_section(
			'style_chapter_detail',
			array(
				'label' => __( 'The Result (Preserved Outcome)', 'luxury-re-widgets' ),
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
				'label'     => __( 'Result Label Color', 'luxury-re-widgets' ),
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
				'label'    => __( 'Result Label Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-detail-label',
			)
		);

		$this->add_control(
			'detail_val_color',
			array(
				'label'     => __( 'Result Outcome Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.88)',
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
				'label'    => __( 'Result Outcome Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-sguide__chapter-detail-val',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB_STYLE: 8. MUSEUM PHOTOGRAPHY & MEDIA FRAME
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
		$watermark_text = ! empty( $settings['watermark_text'] ) ? $settings['watermark_text'] : 'RESULTS';
		$eyebrow        = ! empty( $settings['eyebrow'] ) ? $settings['eyebrow'] : 'Case Studies & Track Record';
		$heading_raw    = ! empty( $settings['heading'] ) ? $settings['heading'] : 'Proven Results';
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
		<section class="lre-sguide lre-sguide--monograph lre-proven-results" id="proven-results" aria-label="<?php esc_attr_e( 'Proven Results & Case Studies', 'luxury-re-widgets' ); ?>">

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

				<!-- --- 2. SEQUENTIAL EDITORIAL MONOGRAPH CHAPTERS (THE CASE STUDIES) --- -->
				<?php if ( ! empty( $chapters ) ) : ?>
				<div class="lre-sguide__chapters">
					<?php foreach ( $chapters as $c_idx => $ch ) :
						$align        = ! empty( $ch['image_align'] ) ? $ch['image_align'] : ( 0 === $c_idx % 2 ? 'left' : 'right' );
						$c_num        = ! empty( $ch['chapter_num'] ) ? $ch['chapter_num'] : sprintf( '%02d', $c_idx + 1 );
						$c_img        = ! empty( $ch['chapter_image']['url'] ) ? $ch['chapter_image']['url'] : lre_asset_url( 'images/property-2.jpg' );
						$format_mode  = ! empty( $ch['format_mode'] ) ? $ch['format_mode'] : 'breakdown';
						$det_label    = ! empty( $ch['chapter_detail_label'] ) ? $ch['chapter_detail_label'] : __( 'The Result', 'luxury-re-widgets' );
						$det_val      = ! empty( $ch['chapter_detail_val'] ) ? $ch['chapter_detail_val'] : '';
						$ch_label     = ! empty( $ch['challenge_label'] ) ? $ch['challenge_label'] : __( 'The Challenge', 'luxury-re-widgets' );
						$ch_text      = ! empty( $ch['challenge_text'] ) ? $ch['challenge_text'] : '';
						$app_label    = ! empty( $ch['approach_label'] ) ? $ch['approach_label'] : __( 'Our Approach', 'luxury-re-widgets' );
						$app_text     = ! empty( $ch['approach_text'] ) ? $ch['approach_text'] : '';
						$narrative    = ! empty( $ch['chapter_narrative'] ) ? $ch['chapter_narrative'] : '';
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
						<div class="lre-sguide__chapter-content lre-presults__chapter-content">
							<div class="lre-sguide__chapter-meta">
								<span class="lre-sguide__chapter-num"><?php echo esc_html( $c_num ); ?></span>
								<span class="lre-sguide__meta-sep" aria-hidden="true">/</span>
								<span class="lre-sguide__chapter-tag"><?php echo esc_html( $ch['chapter_tag'] ); ?></span>
							</div>

							<h3 class="lre-sguide__chapter-title"><span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $ch['chapter_title'] ); ?></span></span></h3>

							<?php if ( 'breakdown' === $format_mode && ( ! empty( $ch_text ) || ! empty( $app_text ) ) ) : ?>
								<div class="lre-presults__breakdown">
									<?php if ( ! empty( $ch_text ) ) : ?>
									<div class="lre-presults__block lre-presults__block--challenge">
										<span class="lre-presults__block-label"><?php echo esc_html( $ch_label ); ?></span>
										<p class="lre-presults__block-text"><?php echo esc_html( $ch_text ); ?></p>
									</div>
									<?php endif; ?>

									<?php if ( ! empty( $app_text ) ) : ?>
									<div class="lre-presults__block lre-presults__block--approach">
										<span class="lre-presults__block-label"><?php echo esc_html( $app_label ); ?></span>
										<p class="lre-presults__block-text"><?php echo esc_html( $app_text ); ?></p>
									</div>
									<?php endif; ?>
								</div>
							<?php elseif ( ! empty( $narrative ) ) : ?>
								<p class="lre-sguide__chapter-narrative"><?php echo esc_html( $narrative ); ?></p>
							<?php endif; ?>

							<?php if ( ! empty( $det_val ) ) : ?>
							<div class="lre-sguide__chapter-detail lre-presults__result-box">
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
