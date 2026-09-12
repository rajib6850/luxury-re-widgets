<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Community_Widget
 *
 * Ultra-Luxury, Minimal, and Editorial Reusable Community Template Widget.
 * Designed for Adolfo Aguirre (SERHANT.) to showcase Pasadena, San Marino,
 * Los Angeles, and future Southern California enclaves with real architectural data.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Community_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_community';
	}

	public function get_title() {
		return __( 'LRE — Luxury Community Monograph', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-map-pin';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'community', 'pasadena', 'san marino', 'los angeles', 'enclave', 'luxury', 'architectural', 'editorial', 'quiet luxury' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- 1. MASTHEAD & HERO ---
		$this->start_controls_section(
			'section_hero',
			array(
				'label' => __( '1. Masthead & Hero', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'breadcrumb_parent',
			array(
				'label'   => __( 'Breadcrumb Parent', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'COMMUNITIES',
			)
		);

		$this->add_control(
			'breadcrumb_parent_url',
			array(
				'label'   => __( 'Breadcrumb Parent URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => home_url( '/communities/' ) ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'SOUTHERN CALIFORNIA ARCHITECTURAL ENCLAVE • DRE# 02094212',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Community Title (H1)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Pasadena',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'tagline',
			array(
				'label'       => __( 'Architectural Subtitle', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => 'The Crown City of Historic Character, Estate Acreage & Architectural Grandeur',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'coordinates',
			array(
				'label'   => __( 'Geographic Coordinates', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '34.1478° N, 118.1445° W • ELEVATION 864 FT',
			)
		);

		$this->add_control(
			'hero_image',
			array(
				'label'   => __( 'Hero Architectural Photography', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-3.jpg' ),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'   => __( 'Typographic Watermark', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PASADENA',
			)
		);

		$this->end_controls_section();

		// --- 2. ARCHITECTURAL NARRATIVE ---
		$this->start_controls_section(
			'section_story',
			array(
				'label' => __( '2. Architectural Narrative', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'story_eyebrow',
			array(
				'label'   => __( 'Story Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'LOCAL HERITAGE & DISCRETION',
			)
		);

		$this->add_control(
			'story_title',
			array(
				'label'   => __( 'Story Title (H2)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Preserving Provenance in Southern California’s Cultural Capital',
			)
		);

		$this->add_control(
			'story_p1',
			array(
				'label'   => __( 'Narrative Paragraph 1', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => 'Framed by the San Gabriel Mountains and the dramatic Arroyo Seco bluffs, Pasadena stands as Southern California’s premier sanctuary of preserved architectural integrity. Unlike homogenized suburban developments, Pasadena’s streetscapes are an evolving dialogue between early 20th-century visionary architects and contemporary custodians.',
			)
		);

		$this->add_control(
			'story_p2',
			array(
				'label'   => __( 'Narrative Paragraph 2', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => 'With over 50 closed transactions and $49 Million+ in career sales volume, Adolfo Aguirre provides private clients, family trusts, and fiduciary principals with discreet, high-caliber representation. From securing competitive off-market acquisitions along South Orange Grove to orchestrating record-setting campaigns—such as 555 S. Grand Ave, which closed in just 6 days for $100,000 over asking price—every transaction is executed with bespoke strategy and global SERHANT. media power.',
			)
		);

		$this->end_controls_section();

		// --- 3. CURATOR'S PERSPECTIVE QUOTE ---
		$this->start_controls_section(
			'section_quote',
			array(
				'label' => __( '3. Curator’s Statement Quote', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'quote_eyebrow',
			array(
				'label'   => __( 'Quote Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'A CURATOR’S PERSPECTIVE',
			)
		);

		$this->add_control(
			'quote_text',
			array(
				'label'   => __( 'Adolfo’s Statement Quote', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => '“Pasadena is not simply a location; it is an architectural preserve. From the storied bluffs of the Arroyo Seco to the historic estates of South Grand, representing properties here requires a curator’s eye and an uncompromising respect for provenance.”',
			)
		);

		$this->add_control(
			'quote_author',
			array(
				'label'   => __( 'Quote Author', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ADOLFO AGUIRRE',
			)
		);

		$this->add_control(
			'quote_author_sub',
			array(
				'label'   => __( 'Author Title / Accreditation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Luxury Real Estate Advisor • SERHANT. • DRE# 02094212',
			)
		);

		$this->end_controls_section();

		// --- 4. KEY HERITAGE METRICS ---
		$this->start_controls_section(
			'section_stats',
			array(
				'label' => __( '4. Heritage Metrics & Stats', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'stat1_num',
			array(
				'label'   => __( 'Stat 1 Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '1886',
			)
		);

		$this->add_control(
			'stat1_label',
			array(
				'label'   => __( 'Stat 1 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'FOUNDED HERITAGE',
			)
		);

		$this->add_control(
			'stat2_num',
			array(
				'label'   => __( 'Stat 2 Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '100+',
			)
		);

		$this->add_control(
			'stat2_label',
			array(
				'label'   => __( 'Stat 2 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'HISTORIC LANDMARKS',
			)
		);

		$this->add_control(
			'stat3_num',
			array(
				'label'   => __( 'Stat 3 Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '5M+',
			)
		);

		$this->add_control(
			'stat3_label',
			array(
				'label'   => __( 'Stat 3 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SERHANT. MEDIA AUDIENCE',
			)
		);

		$this->end_controls_section();

		// --- 5. SISTER ENCLAVES SWITCHER ---
		$this->start_controls_section(
			'section_switcher',
			array(
				'label' => __( '5. Sister Territories Switcher', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'switcher_eyebrow',
			array(
				'label'   => __( 'Switcher Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'REGIONAL PORTFOLIO',
			)
		);

		$this->add_control(
			'switcher_title',
			array(
				'label'   => __( 'Switcher Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Explore Neighboring Territories',
			)
		);

		$repeater_switch = new Repeater();

		$repeater_switch->add_control(
			'name',
			array(
				'label'   => __( 'Community Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'San Marino',
			)
		);

		$repeater_switch->add_control(
			'tagline',
			array(
				'label'   => __( 'Tagline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Enduring Prestige, Generational Acreage & Quiet Grandeur',
			)
		);

		$repeater_switch->add_control(
			'link',
			array(
				'label'   => __( 'Link URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => home_url( '/communities/san-marino/' ) ),
			)
		);

		$repeater_switch->add_control(
			'image',
			array(
				'label'   => __( 'Community Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-4.jpg' ),
				),
			)
		);

		$this->add_control(
			'switcher_list',
			array(
				'label'       => __( 'Sister Communities', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_switch->get_controls(),
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

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE 1: HERO LAYOUT & OVERLAY ---
		$this->start_controls_section(
			'style_hero_layout',
			array(
				'label' => __( '1. Hero Layout & Overlay', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'hero_min_height',
			array(
				'label'      => __( 'Minimum Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'vh', 'px', '%' ),
				'range'      => array(
					'vh' => array( 'min' => 40, 'max' => 120, 'step' => 1 ),
					'px' => array( 'min' => 400, 'max' => 1400, 'step' => 10 ),
				),
				'default'    => array(
					'size' => 90,
					'unit' => 'vh',
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__hero' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'hero_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__hero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'hero_scrim_opacity',
			array(
				'label'     => __( 'Overlay Darkness (Scrim Opacity)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0, 'max' => 1, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 1 ),
				'selectors' => array(
					'{{WRAPPER}} .lre-community__hero-scrim' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_control(
			'hero_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__hero' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 2: BREADCRUMBS NAVIGATION ---
		$this->start_controls_section(
			'style_hero_breadcrumbs',
			array(
				'label' => __( '2. Hero Breadcrumbs', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'breadcrumbs_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__breadcrumbs, {{WRAPPER}} .lre-community__crumb',
			)
		);

		$this->add_control(
			'breadcrumbs_color',
			array(
				'label'     => __( 'Link Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__crumb' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'breadcrumbs_active_color',
			array(
				'label'     => __( 'Active Crumb Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__crumb--active' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'breadcrumbs_sep_color',
			array(
				'label'     => __( 'Separator Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__crumb-sep' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 3: MASTHEAD TYPOGRAPHY ---
		$this->start_controls_section(
			'style_hero_typography',
			array(
				'label' => __( '3. Masthead Typography', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Hero Eyebrow
		$this->add_control(
			'heading_style_hero_eyebrow',
			array(
				'label' => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hero_eyebrow_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__eyebrow',
			)
		);

		$this->add_control(
			'hero_eyebrow_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'hero_eyebrow_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__eyebrow' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Hero Title (H1)
		$this->add_control(
			'heading_style_hero_title',
			array(
				'label'     => __( 'Title (H1)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hero_title_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__title',
			)
		);

		$this->add_control(
			'hero_title_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'hero_title_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Hero Tagline (Paragraph)
		$this->add_control(
			'heading_style_hero_tagline',
			array(
				'label'     => __( 'Subtitle / Tagline (Paragraph)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hero_tagline_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__tagline',
			)
		);

		$this->add_control(
			'hero_tagline_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__tagline' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'hero_tagline_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__tagline' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'hero_tagline_max_width',
			array(
				'label'      => __( 'Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 300, 'max' => 1200, 'step' => 10 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__tagline' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 4: WATERMARK / SHADOW TEXT ---
		$this->start_controls_section(
			'style_hero_watermark',
			array(
				'label' => __( '4. Watermark (Shadow Text)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'watermark_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__watermark',
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__watermark' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'watermark_stroke_color',
			array(
				'label'     => __( 'Outline / Stroke Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__watermark' => '-webkit-text-stroke-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'watermark_top',
			array(
				'label'      => __( 'Top Position (%)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array( 'min' => 0, 'max' => 50, 'step' => 0.5 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__watermark' => 'top: {{SIZE}}%;',
				),
			)
		);

		$this->add_control(
			'watermark_opacity',
			array(
				'label'     => __( 'Opacity', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0, 'max' => 1, 'step' => 0.02 ),
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-community__watermark' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 5: COORDINATES BADGE ---
		$this->start_controls_section(
			'style_hero_coordinates',
			array(
				'label' => __( '5. Coordinates Badge', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'coordinates_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__coordinates',
			)
		);

		$this->add_control(
			'coordinates_color',
			array(
				'label'     => __( 'Text & Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__coordinates' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'coordinates_dot_color',
			array(
				'label'     => __( 'Dot Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__coord-dot' => 'background-color: {{VALUE}}; box-shadow: 0 0 8px {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'coordinates_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__coordinates' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'coordinates_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__coordinates' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'coordinates_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__coordinates' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 6: ARCHITECTURAL NARRATIVE LAYOUT ---
		$this->start_controls_section(
			'style_narrative_layout',
			array(
				'label' => __( '6. Narrative Section Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'narrative_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__narrative' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'narrative_padding',
			array(
				'label'      => __( 'Section Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__narrative' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'narrative_grid_gap',
			array(
				'label'      => __( 'Grid Columns Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'range'      => array(
					'rem' => array( 'min' => 1, 'max' => 10, 'step' => 0.5 ),
					'px'  => array( 'min' => 16, 'max' => 140, 'step' => 4 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__narrative-grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 7: STORY HEADINGS ---
		$this->start_controls_section(
			'style_narrative_headings',
			array(
				'label' => __( '7. Story Headings', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'heading_style_story_eyebrow',
			array(
				'label' => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'story_eyebrow_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__story-content .lre-community__section-eyebrow',
			)
		);

		$this->add_control(
			'story_eyebrow_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__story-content .lre-community__section-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'heading_style_narrative_title',
			array(
				'label'     => __( 'Story Title (H2)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'narrative_title_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__story-content .lre-community__section-title',
			)
		);

		$this->add_control(
			'narrative_title_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__story-content .lre-community__section-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'narrative_title_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__story-content .lre-community__section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 8: STORY BODY TEXT (PARAGRAPHS) ---
		$this->start_controls_section(
			'style_narrative_prose',
			array(
				'label' => __( '8. Story Body Text (Paragraphs)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'heading_style_narrative_body',
			array(
				'label' => __( 'Paragraphs Typography & Colors', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'narrative_body_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__prose, {{WRAPPER}} .lre-community__prose p',
			)
		);

		$this->add_control(
			'narrative_body_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__prose'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .lre-community__prose p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'narrative_body_spacing',
			array(
				'label'      => __( 'Paragraph Spacing (Margin Bottom)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'range'      => array(
					'rem' => array( 'min' => 0.5, 'max' => 4, 'step' => 0.1 ),
					'px'  => array( 'min' => 8, 'max' => 60, 'step' => 2 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__prose p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'narrative_body_max_width',
			array(
				'label'      => __( 'Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', '%', 'ch' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__prose' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 9: STATEMENT QUOTE CARD BOX ---
		$this->start_controls_section(
			'style_quote_card',
			array(
				'label' => __( '9. Quote Card Box', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'quote_card_bg',
			array(
				'label'     => __( 'Card Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__quote-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'quote_card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__quote-card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'quote_card_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__quote-card' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'quote_card_padding',
			array(
				'label'      => __( 'Card Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__quote-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'quote_card_shadow',
				'selector' => '{{WRAPPER}} .lre-community__quote-card',
			)
		);

		$this->add_control(
			'quote_line_color',
			array(
				'label'     => __( 'Accent Line Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .lre-community__gold-line' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'quote_line_width',
			array(
				'label'      => __( 'Accent Line Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px' => array( 'min' => 10, 'max' => 120, 'step' => 2 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__gold-line' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 10: STATEMENT QUOTE TYPOGRAPHY ---
		$this->start_controls_section(
			'style_quote_typography',
			array(
				'label' => __( '10. Quote Typography', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'heading_style_quote_eyebrow',
			array(
				'label' => __( 'Quote Eyebrow', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'quote_eyebrow_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__quote-eyebrow',
			)
		);

		$this->add_control(
			'quote_eyebrow_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__quote-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		// Quote Body
		$this->add_control(
			'heading_style_quote',
			array(
				'label'     => __( 'Quote Body Text (Paragraph)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'quote_body_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__quote-body, {{WRAPPER}} .lre-community__quote-body p',
			)
		);

		$this->add_control(
			'quote_body_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__quote-body'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .lre-community__quote-body p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'quote_body_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__quote-body'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .lre-community__quote-body p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Author Citation
		$this->add_control(
			'heading_style_quote_author',
			array(
				'label'     => __( 'Author & Subtitle', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'quote_author_typography',
				'label'    => __( 'Author Name Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__quote-cite strong',
			)
		);

		$this->add_control(
			'quote_author_color',
			array(
				'label'     => __( 'Author Name Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__quote-cite strong' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'quote_author_sub_typography',
				'label'    => __( 'Subtitle / Role Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__quote-cite span',
			)
		);

		$this->add_control(
			'quote_author_sub_color',
			array(
				'label'     => __( 'Subtitle / Role Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__quote-cite span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 11: HERITAGE METRICS & STATS ---
		$this->start_controls_section(
			'style_stats',
			array(
				'label' => __( '11. Heritage Metrics & Stats', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'stats_border_color',
			array(
				'label'     => __( 'Top Divider Line Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__stats-row' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'stats_spacing_top',
			array(
				'label'      => __( 'Top Spacing & Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__stats-row' => 'margin-top: {{SIZE}}{{UNIT}}; padding-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_style_stats',
			array(
				'label'     => __( 'Stat Numbers', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'stat_num_typography',
				'label'    => __( 'Number Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__stat-num',
			)
		);

		$this->add_control(
			'stat_num_color',
			array(
				'label'     => __( 'Number Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__stat-num' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'stat_num_spacing',
			array(
				'label'      => __( 'Number Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__stat-num' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_style_stat_labels',
			array(
				'label'     => __( 'Stat Labels', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'stat_label_typography',
				'label'    => __( 'Label Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__stat-label',
			)
		);

		$this->add_control(
			'stat_label_color',
			array(
				'label'     => __( 'Label Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__stat-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE 12: SISTER TERRITORIES SWITCHER LAYOUT ---
		$this->start_controls_section(
			'style_switcher_layout',
			array(
				'label' => __( '12. Sister Territories Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'switcher_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__switcher' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'switcher_padding',
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
			'switcher_border_top_color',
			array(
				'label'     => __( 'Top Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__switcher' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'switcher_eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__switcher .lre-community__section-eyebrow',
			)
		);

		$this->add_control(
			'switcher_eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__switcher .lre-community__section-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'heading_style_sister_title',
			array(
				'label'     => __( 'Section Title (H2)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'switcher_title_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__switcher .lre-community__section-title',
			)
		);

		$this->add_control(
			'switcher_title_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__switcher .lre-community__section-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'switcher_header_spacing',
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

		// --- STYLE 13: SISTER TERRITORY CARDS ---
		$this->start_controls_section(
			'style_sister_cards',
			array(
				'label' => __( '13. Sister Territory Cards', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'sister_card_height',
			array(
				'label'      => __( 'Card Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 250, 'max' => 600, 'step' => 10 ),
				),
				'default'    => array(
					'size' => 390,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__sister-card' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'sister_card_bg',
			array(
				'label'     => __( 'Card Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'sister_card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'sister_card_hover_accent',
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
			'sister_card_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__sister-card' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'sister_scrim_opacity',
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

		// Card Eyebrow
		$this->add_control(
			'heading_style_sister_eyebrow',
			array(
				'label'     => __( 'Card Eyebrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sister_eyebrow_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__sister-eyebrow',
			)
		);

		$this->add_control(
			'sister_eyebrow_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		// Card Name (H3)
		$this->add_control(
			'heading_style_sister_name',
			array(
				'label'     => __( 'Card Title (H3)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sister_name_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__sister-name',
			)
		);

		$this->add_control(
			'sister_name_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'sister_name_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__sister-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Card Tagline (Paragraph)
		$this->add_control(
			'heading_style_sister_tagline',
			array(
				'label'     => __( 'Card Tagline (Paragraph)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sister_tagline_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__sister-tagline',
			)
		);

		$this->add_control(
			'sister_tagline_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-tagline' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'sister_tagline_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-community__sister-tagline' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Card Arrow / Explore Link
		$this->add_control(
			'heading_style_sister_arrow',
			array(
				'label'     => __( 'Explore Link & Arrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sister_arrow_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-community__sister-arrow',
			)
		);

		$this->add_control(
			'sister_arrow_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-community__sister-arrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'sister_arrow_hover_color',
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

	protected function render() {
		$settings = $this->get_settings_for_display();

		$hero_img_url = ! empty( $settings['hero_image']['url'] ) ? lre_resolve_image_url( $settings['hero_image']['url'] ) : lre_asset_url( 'images/property-3.jpg' );
		$parent_url   = ! empty( $settings['breadcrumb_parent_url']['url'] ) ? esc_url( $settings['breadcrumb_parent_url']['url'] ) : home_url( '/communities/' );
		?>
		<article class="lre-community" id="community-monograph">

			<!-- =================================================================
			     1. MASTHEAD & HERO SECTION
			================================================================== -->
			<header class="lre-community__hero">
				<div class="lre-community__hero-bg">
					<img src="<?php echo esc_url( $hero_img_url ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?> Architectural Estate" class="lre-community__hero-img" loading="eager" />
					<div class="lre-community__hero-scrim"></div>
				</div>

				<?php if ( ! empty( $settings['watermark_text'] ) ) : ?>
					<div class="lre-community__watermark" aria-hidden="true">
						<?php echo esc_html( $settings['watermark_text'] ); ?>
					</div>
				<?php endif; ?>

				<div class="lre-community__hero-inner">
					<div class="lre-community__breadcrumbs">
						<a href="<?php echo $parent_url; ?>" class="lre-community__crumb"><?php echo esc_html( $settings['breadcrumb_parent'] ); ?></a>
						<span class="lre-community__crumb-sep">/</span>
						<span class="lre-community__crumb lre-community__crumb--active"><?php echo esc_html( $settings['title'] ); ?></span>
					</div>

					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<p class="lre-community__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></p>
					<?php endif; ?>

					<h1 class="lre-community__title"><?php echo esc_html( $settings['title'] ); ?></h1>

					<?php if ( ! empty( $settings['tagline'] ) ) : ?>
						<p class="lre-community__tagline"><?php echo esc_html( $settings['tagline'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $settings['coordinates'] ) ) : ?>
						<div class="lre-community__coordinates">
							<span class="lre-community__coord-dot"></span>
							<?php echo esc_html( $settings['coordinates'] ); ?>
						</div>
					<?php endif; ?>
				</div>
			</header>

			<!-- =================================================================
			     2. ARCHITECTURAL NARRATIVE & INSIDER HERITAGE
			================================================================== -->
			<section class="lre-community__narrative">
				<div class="lre-community__container">
					<div class="lre-community__narrative-grid">
						
						<!-- Left: Statement Quote -->
						<div class="lre-community__quote-card">
							<div class="lre-community__gold-line"></div>
							<?php if ( ! empty( $settings['quote_eyebrow'] ) ) : ?>
								<span class="lre-community__quote-eyebrow"><?php echo esc_html( $settings['quote_eyebrow'] ); ?></span>
							<?php endif; ?>
							<blockquote class="lre-community__quote-body">
								<?php echo wp_kses_post( $settings['quote_text'] ); ?>
							</blockquote>
							<cite class="lre-community__quote-cite">
								<strong><?php echo esc_html( $settings['quote_author'] ); ?></strong>
								<span><?php echo esc_html( $settings['quote_author_sub'] ); ?></span>
							</cite>
						</div>

						<!-- Right: Curated Story & Stats -->
						<div class="lre-community__story-content">
							<?php if ( ! empty( $settings['story_eyebrow'] ) ) : ?>
								<span class="lre-community__section-eyebrow"><?php echo esc_html( $settings['story_eyebrow'] ); ?></span>
							<?php endif; ?>

							<h2 class="lre-community__section-title"><?php echo esc_html( $settings['story_title'] ); ?></h2>

							<div class="lre-community__prose">
								<p><?php echo esc_html( $settings['story_p1'] ); ?></p>
								<p><?php echo esc_html( $settings['story_p2'] ); ?></p>
							</div>

							<div class="lre-community__stats-row">
								<div class="lre-community__stat-box">
									<span class="lre-community__stat-num"><?php echo esc_html( $settings['stat1_num'] ); ?></span>
									<span class="lre-community__stat-label"><?php echo esc_html( $settings['stat1_label'] ); ?></span>
								</div>
								<div class="lre-community__stat-box">
									<span class="lre-community__stat-num"><?php echo esc_html( $settings['stat2_num'] ); ?></span>
									<span class="lre-community__stat-label"><?php echo esc_html( $settings['stat2_label'] ); ?></span>
								</div>
								<div class="lre-community__stat-box">
									<span class="lre-community__stat-num"><?php echo esc_html( $settings['stat3_num'] ); ?></span>
									<span class="lre-community__stat-label"><?php echo esc_html( $settings['stat3_label'] ); ?></span>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>

			<!-- =================================================================
			     3. SISTER TERRITORIES SWITCHER
			================================================================== -->
			<?php if ( ! empty( $settings['switcher_list'] ) ) : ?>
				<section class="lre-community__switcher">
					<div class="lre-community__container">
						<div class="lre-community__switcher-head">
							<?php if ( ! empty( $settings['switcher_eyebrow'] ) ) : ?>
								<span class="lre-community__section-eyebrow"><?php echo esc_html( $settings['switcher_eyebrow'] ); ?></span>
							<?php endif; ?>
							<h2 class="lre-community__section-title"><?php echo esc_html( $settings['switcher_title'] ); ?></h2>
						</div>

						<div class="lre-community__switcher-grid">
							<?php foreach ( $settings['switcher_list'] as $sister ) : 
								$sis_img = ! empty( $sister['image']['url'] ) ? lre_resolve_image_url( $sister['image']['url'] ) : lre_asset_url( 'images/property-4.jpg' );
								$sis_url = ! empty( $sister['link']['url'] ) ? esc_url( $sister['link']['url'] ) : '#';
							?>
								<a href="<?php echo $sis_url; ?>" class="lre-community__sister-card">
									<div class="lre-community__sister-media">
										<img src="<?php echo esc_url( $sis_img ); ?>" alt="<?php echo esc_attr( $sister['name'] ); ?>" class="lre-community__sister-img" loading="lazy" />
										<div class="lre-community__sister-scrim"></div>
									</div>
									<div class="lre-community__sister-content">
										<span class="lre-community__sister-eyebrow">ENCLAVE</span>
										<h3 class="lre-community__sister-name"><?php echo esc_html( $sister['name'] ); ?></h3>
										<p class="lre-community__sister-tagline"><?php echo esc_html( $sister['tagline'] ); ?></p>
										<span class="lre-community__sister-arrow">EXPLORE TERRITORY &rarr;</span>
									</div>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				</section>
			<?php endif; ?>

		</article>
		<?php
	}
}
