<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class LRE_Properties_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_properties';
	}

	public function get_title() {
		return __( 'LRE - Luxury Featured Properties', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'properties', 'listings', 'real estate', 'homes', 'carousel', 'luxury' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- Section Header ---
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_eyebrow',
			array(
				'label'        => __( 'Show Eyebrow', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_gold_bar',
			array(
				'label'        => __( 'Show Accent Gold Line', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'condition'    => array( 'show_eyebrow' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow / Section Label', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Curated Residences', 'luxury-re-widgets' ),
				'placeholder' => __( 'Curated Residences', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_eyebrow' => 'yes' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Section Heading', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'New To The Market', 'luxury-re-widgets' ),
				'placeholder' => __( 'New To The Market', 'luxury-re-widgets' ),
				'description' => __( 'Supports multiple lines with Enter or <br> tags (with staggered luxury mask reveal animation).', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
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
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
			)
		);

		$this->add_control(
			'show_description',
			array(
				'label'        => __( 'Show Description', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => __( "Each of these properties has been carefully selected for its architectural distinction, exceptional location, and unparalleled lifestyle. Explore our newest additions before they're gone.", 'luxury-re-widgets' ),
				'placeholder' => __( "Each of these properties has been carefully selected for its architectural distinction, exceptional location, and unparalleled lifestyle. Explore our newest additions before they're gone.", 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_description' => 'yes' ),
			)
		);

		$this->add_responsive_control(
			'header_align',
			array(
				'label'     => __( 'Alignment', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .listings__header'      => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .listings__description' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- Property Listings (Repeater) ---
		$this->start_controls_section(
			'section_listings',
			array(
				'label' => __( 'Property Listings', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'prop_image',
			array(
				'label'   => __( 'Property Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=700&q=85',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_badge',
			array(
				'label'   => __( 'Badge Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'New',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_is_gold',
			array(
				'label'   => __( 'Gold Badge Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$repeater->add_control(
			'prop_price',
			array(
				'label'   => __( 'Price', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$4,750,000',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_address',
			array(
				'label'   => __( 'Address', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '1247 Stoneridge Terrace, Pacific Palisades, CA',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_beds',
			array(
				'label'   => __( 'Bedrooms', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
			)
		);

		$repeater->add_control(
			'prop_baths',
			array(
				'label'   => __( 'Bathrooms', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			)
		);

		$repeater->add_control(
			'prop_sqft',
			array(
				'label'   => __( 'Square Feet', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '5,400',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_url',
			array(
				'label'   => __( 'Property URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'listings',
			array(
				'label'       => __( 'Listings', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=700&q=85' ),
						'prop_price'   => '$4,750,000',
						'prop_address' => '1247 Stoneridge Terrace, Pacific Palisades, CA',
						'prop_beds'    => 5,
						'prop_baths'   => 6,
						'prop_sqft'    => '5,400',
						'prop_badge'   => 'New',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=700&q=85' ),
						'prop_price'   => '$7,280,000',
						'prop_address' => '802 Emerald Bay Road, Malibu, CA 90265',
						'prop_beds'    => 6,
						'prop_baths'   => 7,
						'prop_sqft'    => '7,800',
						'prop_badge'   => 'Exclusive',
						'prop_is_gold' => 'yes',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=700&q=85' ),
						'prop_price'   => '$11,950,000',
						'prop_address' => '456 Bellagio Road, Bel Air, CA 90077',
						'prop_beds'    => 8,
						'prop_baths'   => 10,
						'prop_sqft'    => '12,300',
						'prop_badge'   => 'New',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=700&q=85' ),
						'prop_price'   => '$15,400,000',
						'prop_address' => '2190 Coldwater Canyon Dr, Beverly Hills, CA',
						'prop_beds'    => 7,
						'prop_baths'   => 9,
						'prop_sqft'    => '14,600',
						'prop_badge'   => 'Featured',
						'prop_is_gold' => 'yes',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=700&q=85' ),
						'prop_price'   => '$8,900,000',
						'prop_address' => '1054 Ocean Avenue, Santa Monica, CA 90403',
						'prop_beds'    => 5,
						'prop_baths'   => 6,
						'prop_sqft'    => '6,900',
						'prop_badge'   => 'Price Improved',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=700&q=85' ),
						'prop_price'   => '$18,250,000',
						'prop_address' => '312 Meadow Lane, Montecito, CA 93108',
						'prop_beds'    => 6,
						'prop_baths'   => 8,
						'prop_sqft'    => '11,200',
						'prop_badge'   => 'Exclusive',
						'prop_is_gold' => 'yes',
					),
				),
				'title_field' => '{{{ prop_address }}}',
			)
		);

		$this->add_control(
			'show_wishlist',
			array(
				'label'        => __( 'Show Wishlist / Favorite Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->end_controls_section();

		// --- Bottom CTAs ---
		$this->start_controls_section(
			'section_ctas',
			array(
				'label' => __( 'Bottom CTA Buttons', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'cta1_text',
			array(
				'label'   => __( 'Button 1 Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Schedule A Viewing', 'luxury-re-widgets' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cta1_url',
			array(
				'label'   => __( 'Button 1 URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->add_control(
			'cta2_text',
			array(
				'label'     => __( 'Button 2 Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'View All Properties', 'luxury-re-widgets' ),
				'separator' => 'before',
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cta2_url',
			array(
				'label'   => __( 'Button 2 URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- Style: Section ---
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listings' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .listings' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// =========================================================================
		// STYLE: Section Header Typography & Style
		// =========================================================================
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Section Header Typography & Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'header_alignment_style',
			array(
				'label'     => __( 'Header Alignment', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .listings__header'      => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .listings__description' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_max_width',
			array(
				'label'      => __( 'Header Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 400, 'max' => 1400, 'step' => 10 ),
					'%'  => array( 'min' => 30,  'max' => 100 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .listings__header' => 'max-width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;',
				),
			)
		);

		$this->add_responsive_control(
			'header_spacing',
			array(
				'label'      => __( 'Header Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 140 ),
					'rem' => array( 'min' => 0, 'max' => 8 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 3.5 ),
				'selectors'  => array(
					'{{WRAPPER}} .listings__header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// --- Eyebrow Styling ---
		$this->add_control(
			'heading_style_eyebrow',
			array(
				'label'     => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listings__eyebrow, {{WRAPPER}} .listings__eyebrow-wrap .section-label',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listings__eyebrow, {{WRAPPER}} .listings__eyebrow-wrap .section-label' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Eyebrow Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 60 ),
					'rem' => array( 'min' => 0, 'max' => 4 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .listings__eyebrow-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Accent Gold Bar
		$this->add_control(
			'gold_bar_color',
			array(
				'label'     => __( 'Gold Line Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listings__gold-bar' => 'background-color: {{VALUE}} !important; background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'gold_bar_width',
			array(
				'label'      => __( 'Gold Line Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array( 'min' => 10, 'max' => 100 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 32 ),
				'selectors'  => array(
					'{{WRAPPER}} .listings__gold-bar' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'gold_bar_height',
			array(
				'label'      => __( 'Gold Line Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array( 'min' => 1, 'max' => 8 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 1 ),
				'selectors'  => array(
					'{{WRAPPER}} .listings__gold-bar' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// --- Heading Styling ---
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
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listings__title, {{WRAPPER}} .listings__title span, {{WRAPPER}} .listings__title .title-mask > span',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listings__title, {{WRAPPER}} .listings__title span, {{WRAPPER}} .listings__title .title-mask > span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => __( 'Heading Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 80 ),
					'rem' => array( 'min' => 0, 'max' => 5 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .listings__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// --- Description Styling ---
		$this->add_control(
			'heading_style_description',
			array(
				'label'     => __( 'Description', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listings__description',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listings__description' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'description_max_width',
			array(
				'label'      => __( 'Description Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 200, 'max' => 1200, 'step' => 10 ),
					'rem' => array( 'min' => 15,  'max' => 70 ),
					'%'   => array( 'min' => 20,  'max' => 100 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 580 ),
				'selectors'  => array(
					'{{WRAPPER}} .listings__description' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'description_spacing',
			array(
				'label'      => __( 'Description Top Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 60 ),
					'rem' => array( 'min' => 0, 'max' => 4 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .listings__description' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- Style: Card Typography & Colors ---
		$this->start_controls_section(
			'style_card',
			array(
				'label' => __( 'Card Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'label'    => __( 'Price Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listing-card__price',
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Price Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listing-card__price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'address_typography',
				'label'    => __( 'Address Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listing-card__address',
			)
		);

		$this->add_control(
			'address_color',
			array(
				'label'     => __( 'Address Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listing-card__address' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typography',
				'label'    => __( 'Meta Info Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listing-card__meta-item',
			)
		);

		$this->add_control(
			'meta_color',
			array(
				'label'     => __( 'Meta Info Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listing-card__meta-item' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// =========================================================================
		// STYLE: Bottom CTA Buttons
		// =========================================================================
		$this->start_controls_section(
			'style_ctas',
			array(
				'label' => __( 'Bottom CTA Buttons', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ctas_typography',
				'selector' => '{{WRAPPER}} .listings__cta-group .btn',
			)
		);

		$this->add_responsive_control(
			'ctas_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '0.95',
					'right'    => '2.2',
					'bottom'   => '0.95',
					'left'     => '2.2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .listings__cta-group .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'ctas_gap',
			array(
				'label'      => __( 'Buttons Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 50 ),
					'rem' => array( 'min' => 0, 'max' => 3 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 0.75 ),
				'selectors'  => array(
					'{{WRAPPER}} .listings__cta-group' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Button 1 (Primary)
		$this->add_control(
			'heading_cta1',
			array(
				'label'     => __( 'Button 1 (Schedule A Viewing)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_cta1_style' );
			$this->start_controls_tab( 'tab_cta1_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'cta1_text_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .listings__cta-group .listings__btn-1' => 'color: {{VALUE}};' ),
				)
			);
			$this->add_control(
				'cta1_bg_color',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .listings__cta-group .listings__btn-1' => 'background-color: {{VALUE}};' ),
				)
			);
			$this->add_control(
				'cta1_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .listings__cta-group .listings__btn-1' => 'border-color: {{VALUE}};' ),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_cta1_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'cta1_hover_text_color',
				array(
					'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .listings__cta-group .listings__btn-1:hover, {{WRAPPER}} .listings__cta-group .listings__btn-1:hover span' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'cta1_hover_bg_color',
				array(
					'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .listings__cta-group .listings__btn-1'               => '--btn-hover-bg: {{VALUE}};',
						'{{WRAPPER}} .listings__cta-group .listings__btn-1:hover::before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .listings__cta-group .listings__btn-1:hover'         => 'background-color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'cta1_hover_border_color',
				array(
					'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .listings__cta-group .listings__btn-1:hover' => 'border-color: {{VALUE}};',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		// Button 2 (Outline)
		$this->add_control(
			'heading_cta2',
			array(
				'label'     => __( 'Button 2 (View All Properties)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_cta2_style' );
			$this->start_controls_tab( 'tab_cta2_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'cta2_text_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .listings__cta-group .listings__btn-2' => 'color: {{VALUE}};' ),
				)
			);
			$this->add_control(
				'cta2_bg_color',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .listings__cta-group .listings__btn-2' => 'background-color: {{VALUE}};' ),
				)
			);
			$this->add_control(
				'cta2_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .listings__cta-group .listings__btn-2' => 'border-color: {{VALUE}};' ),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_cta2_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'cta2_hover_text_color',
				array(
					'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .listings__cta-group .listings__btn-2:hover, {{WRAPPER}} .listings__cta-group .listings__btn-2:hover span' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'cta2_hover_bg_color',
				array(
					'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .listings__cta-group .listings__btn-2'               => '--btn-hover-bg: {{VALUE}};',
						'{{WRAPPER}} .listings__cta-group .listings__btn-2:hover::before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .listings__cta-group .listings__btn-2:hover'         => 'background-color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'cta2_hover_border_color',
				array(
					'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .listings__cta-group .listings__btn-2:hover' => 'border-color: {{VALUE}};',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings         = $this->get_settings_for_display();
		$tag              = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2';
		$tag              = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p' ), true ) ? $tag : 'h2';
		$show_eyebrow     = ! isset( $settings['show_eyebrow'] ) || 'yes' === $settings['show_eyebrow'];
		$show_gold_bar    = ! isset( $settings['show_gold_bar'] ) || 'yes' === $settings['show_gold_bar'];
		$show_description = ! isset( $settings['show_description'] ) || 'yes' === $settings['show_description'];
		?>
		<section class="listings" id="listings" aria-label="<?php esc_attr_e( 'Featured property listings', 'luxury-re-widgets' ); ?>">
			<div class="listings__header reveal">
				<?php if ( $show_eyebrow && ! empty( $settings['eyebrow'] ) ) : ?>
				<div class="listings__eyebrow-wrap">
					<?php if ( $show_gold_bar ) : ?>
					<span class="listings__gold-bar" aria-hidden="true"></span>
					<?php endif; ?>
					<span class="section-label listings__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
				</div>
				<?php endif; ?>

				<<?php echo $tag; ?> class="listings__title">
					<?php
					$heading_raw   = $settings['heading'] ?? 'New To The Market';
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

				<?php if ( $show_description && ! empty( $settings['description'] ) ) : ?>
				<p class="listings__description"><?php echo esc_html( $settings['description'] ); ?></p>
				<?php endif; ?>
			</div>

			<div class="listings__carousel-wrapper">
				<div class="listings__carousel" id="listings-carousel" data-stagger>
					<?php if ( ! empty( $settings['listings'] ) ) :
						foreach ( $settings['listings'] as $prop ) :
							$img_url     = ! empty( $prop['prop_image']['url'] ) ? $prop['prop_image']['url'] : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=700&q=85';
							$is_gold     = ! empty( $prop['prop_is_gold'] ) && 'yes' === $prop['prop_is_gold'];
							$badge_class = $is_gold ? 'listing-card__badge listing-card__badge--gold' : 'listing-card__badge';
					?>
					<article class="listing-card">
						<div class="listing-card__image image-reveal">
							<img src="<?php echo esc_url( $img_url ); ?>"
							     alt="<?php echo esc_attr( $prop['prop_address'] ); ?>"
							     loading="lazy" width="600" height="450">
							<?php if ( ! empty( $prop['prop_badge'] ) ) : ?>
							<span class="<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $prop['prop_badge'] ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $settings['show_wishlist'] ) && 'yes' === $settings['show_wishlist'] ) : ?>
							<button class="listing-card__like-btn" aria-label="<?php esc_attr_e( 'Save to favorites', 'luxury-re-widgets' ); ?>" title="<?php esc_attr_e( 'Save to favorites', 'luxury-re-widgets' ); ?>">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
									<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
								</svg>
							</button>
							<?php endif; ?>
						</div>
						<div class="listing-card__price"><?php echo esc_html( $prop['prop_price'] ); ?></div>
						<div class="listing-card__address"><?php echo esc_html( $prop['prop_address'] ); ?></div>
						<div class="listing-card__meta">
							<span class="listing-card__meta-item" title="<?php printf( esc_attr__( '%d Bedrooms', 'luxury-re-widgets' ), absint( $prop['prop_beds'] ) ); ?>">
								<svg class="listing-card__meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
									<path d="M3 7v11M3 13h18v5M21 7v11M7 10h10M7 7a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v3H7V7z"/>
								</svg>
								<span><?php printf( esc_html__( '%d Beds', 'luxury-re-widgets' ), absint( $prop['prop_beds'] ) ); ?></span>
							</span>
							<span class="listing-card__meta-item" title="<?php printf( esc_attr__( '%d Bathrooms', 'luxury-re-widgets' ), absint( $prop['prop_baths'] ) ); ?>">
								<svg class="listing-card__meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
									<path d="M4 12h16a1 1 0 0 1 1 1v2a6 6 0 0 1-6 6H9a6 6 0 0 1-6-6v-2a1 1 0 0 1 1-1zM6 12V5a2 2 0 0 1 2-2h1"/>
									<path d="M4 19l-1 2M20 19l1 2"/>
								</svg>
								<span><?php printf( esc_html__( '%d Baths', 'luxury-re-widgets' ), absint( $prop['prop_baths'] ) ); ?></span>
							</span>
							<span class="listing-card__meta-item" title="<?php printf( esc_attr__( '%s Square Feet', 'luxury-re-widgets' ), esc_attr( $prop['prop_sqft'] ) ); ?>">
								<svg class="listing-card__meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
									<rect x="3" y="3" width="18" height="18" rx="2"/>
									<path d="M3 9h18M9 21V9"/>
								</svg>
								<span><?php echo esc_html( $prop['prop_sqft'] ); ?> <?php esc_html_e( 'Sq Ft', 'luxury-re-widgets' ); ?></span>
							</span>
						</div>
					</article>
					<?php endforeach; endif; ?>
				</div>
			</div>

			<div class="listings__controls">
				<div class="listings__nav">
					<div class="listings__dots">
						<button class="listings__nav-dot active" aria-label="<?php esc_attr_e( 'Page 1', 'luxury-re-widgets' ); ?>" data-page="0"></button>
						<button class="listings__nav-dot" aria-label="<?php esc_attr_e( 'Page 2', 'luxury-re-widgets' ); ?>" data-page="1"></button>
						<button class="listings__nav-dot" aria-label="<?php esc_attr_e( 'Page 3', 'luxury-re-widgets' ); ?>" data-page="2"></button>
					</div>
					<div class="listings__arrows">
						<button class="listings__arrow" id="listings-prev" aria-label="<?php esc_attr_e( 'Previous listings', 'luxury-re-widgets' ); ?>" title="<?php esc_attr_e( 'Previous', 'luxury-re-widgets' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
						</button>
						<button class="listings__arrow" id="listings-next" aria-label="<?php esc_attr_e( 'Next listings', 'luxury-re-widgets' ); ?>" title="<?php esc_attr_e( 'Next', 'luxury-re-widgets' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18l6-6-6-6"/></svg>
						</button>
					</div>
				</div>
				<div class="listings__cta-group">
					<?php if ( ! empty( $settings['cta1_text'] ) ) : ?>
					<a href="<?php echo esc_url( $settings['cta1_url']['url'] ?? '#contact' ); ?>" class="btn btn--primary listings__btn-1">
						<span><?php echo esc_html( $settings['cta1_text'] ); ?></span>
					</a>
					<?php endif; ?>
					<?php if ( ! empty( $settings['cta2_text'] ) ) : ?>
					<a href="<?php echo esc_url( $settings['cta2_url']['url'] ?? '#contact' ); ?>" class="btn btn--outline listings__btn-2">
						<span><?php echo esc_html( $settings['cta2_text'] ); ?></span>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}