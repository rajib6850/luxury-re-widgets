<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

/**
 * LRE_Sold_Portfolio_Widget
 *
 * "The Private Ledger" — An ultra-exclusive, quiet-luxury off-market registry
 * and past sales archive inspired by Section 5 of the signature design.
 * Features:
 * - Dynamic data source selection (Sold Portfolio CPT vs Manual Repeater)
 * - AJAX pagination (Numbered & Load More)
 * - Luxury Bed, Bath & SqFt architectural line icons
 * - Cohesive typography & color system matching the plugin tokens
 * - Sharp architectural borders (Zero border-radius)
 * - Interactive property dossier modal dialog
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Sold_Portfolio_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_sold_portfolio';
	}

	public function get_title() {
		return __( 'LRE — The Private Ledger (Past Sales)', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-table';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'ledger', 'sold', 'portfolio', 'private', 'off-market', 'sales', 'past sales', 'archive', 'properties' );
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
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'RECORD DISCRETION • OFF-MARKET REGISTRY', 'luxury-re-widgets' ),
				'placeholder' => __( 'Eyebrow text', 'luxury-re-widgets' ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'The Private Ledger', 'luxury-re-widgets' ),
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
					'span' => 'span',
				),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => __( 'Subtitle / Narrative', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A confidential registry of landmark estate representation, architectural stewardship, and record sales closed across Pasadena, San Marino, and Greater Los Angeles. Hover any row for a discreet first look.', 'luxury-re-widgets' ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- 2. DATA SOURCE & QUERY SETTINGS ---
		$this->start_controls_section(
			'section_data_source',
			array(
				'label' => __( 'Data Source & Query', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'content_source',
			array(
				'label'   => __( 'Content Source', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cpt',
				'options' => array(
					'cpt'      => __( 'Sold Portfolio CPT (Dynamic)', 'luxury-re-widgets' ),
					'repeater' => __( 'Manual Custom Entries (Repeater)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'     => __( 'Properties Per Page', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 6,
				'min'       => 1,
				'max'       => 30,
				'step'      => 1,
				'condition' => array( 'content_source' => 'cpt' ),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'     => __( 'Order By', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => array(
					'date'  => __( 'Date Published / Closed', 'luxury-re-widgets' ),
					'title' => __( 'Property Title', 'luxury-re-widgets' ),
					'price' => __( 'Sold Price / Valuation', 'luxury-re-widgets' ),
				),
				'condition' => array( 'content_source' => 'cpt' ),
			)
		);

		$this->add_control(
			'order',
			array(
				'label'     => __( 'Order Direction', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => array(
					'DESC' => __( 'Descending (Latest / Highest First)', 'luxury-re-widgets' ),
					'ASC'  => __( 'Ascending', 'luxury-re-widgets' ),
				),
				'condition' => array( 'content_source' => 'cpt' ),
			)
		);

		$this->end_controls_section();

		// --- 3. FILTER TABS & AJAX PAGINATION ---
		$this->start_controls_section(
			'section_filters_pagination',
			array(
				'label' => __( 'Filters & AJAX Pagination', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_filters',
			array(
				'label'        => __( 'Show Location Filter Tabs', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'filter_all_label',
			array(
				'label'     => __( '"All" Tab Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'All Transactions', 'luxury-re-widgets' ),
				'condition' => array( 'show_filters' => 'yes' ),
			)
		);

		$this->add_control(
			'show_pagination',
			array(
				'label'        => __( 'Enable AJAX Pagination', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		// --- 4. MANUAL REPEATER (WHEN REPEATER IS SELECTED) ---
		$this->start_controls_section(
			'section_ledger_repeater',
			array(
				'label'     => __( 'Manual Ledger Entries', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array( 'content_source' => 'repeater' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Estate / Property Name', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '788 S Grand Avenue — The Villetta', 'luxury-re-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'location',
			array(
				'label'   => __( 'Location / Enclave', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Pasadena, California', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'beds',
			array(
				'label'   => __( 'Bedrooms', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '4',
			)
		);

		$repeater->add_control(
			'baths',
			array(
				'label'   => __( 'Bathrooms', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '3',
			)
		);

		$repeater->add_control(
			'sqft',
			array(
				'label'   => __( 'Square Footage', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '4,497',
			)
		);

		$repeater->add_control(
			'price',
			array(
				'label'   => __( 'Closed Price / Valuation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$3,800,000',
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Hover Photo Preview', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=900&auto=format&fit=crop',
				),
			)
		);

		$repeater->add_control(
			'category',
			array(
				'label'       => __( 'Category Slug (for filter tabs)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'pasadena',
				'placeholder' => 'e.g. pasadena, greater-la, gateway-cities',
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Confidential Dossier Summary', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A landmark private estate offering sweeping vistas, bespoke craftsmanship, and discreet private representation under SERHANT.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'ledger_items',
			array(
				'label'       => __( 'Ledger Rows', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}} — {{{ price }}}',
				'default'     => array(
					array(
						'title'       => '788 S Grand Avenue — The Villetta',
						'location'    => 'Pasadena, California',
						'beds'        => '4',
						'baths'       => '3',
						'sqft'        => '4,497',
						'price'       => '$3,800,000',
						'image'       => array( 'url' => 'http://test.test/wp-content/uploads/2026/09/788-S-Grand-Avenue.jpg' ),
						'category'    => 'pasadena',
						'description' => 'A landmark Italianate villa estate in Pasadena closed all-cash in 16 days with discreet representation.',
					),
					array(
						'title'       => '555 S Grand Avenue — Arts & Crafts Landmark',
						'location'    => 'Pasadena, California',
						'beds'        => '6',
						'baths'       => '4',
						'sqft'        => '3,927',
						'price'       => '$2,900,000',
						'image'       => array( 'url' => 'http://test.test/wp-content/uploads/2026/09/555-S-Grand-Avenue.jpg' ),
						'category'    => 'pasadena',
						'description' => 'Historic Arts & Crafts architectural jewel closed $100K over asking in 6 days.',
					),
					array(
						'title'       => '1065 Locust Street — Restored 1908 Craftsman',
						'location'    => 'Pasadena, California',
						'beds'        => '3',
						'baths'       => '2',
						'sqft'        => '1,997',
						'price'       => '$1,450,000',
						'image'       => array( 'url' => 'http://test.test/wp-content/uploads/2026/09/1065-Locust-Street.jpg' ),
						'category'    => 'pasadena',
						'description' => 'Museum-quality restored 1908 Craftsman with original millwork, Batchelder tile fireplace, and lush grounds.',
					),
					array(
						'title'       => '1841 N Garfield Avenue — Character Compound',
						'location'    => 'Pasadena, California',
						'beds'        => '3',
						'baths'       => '2',
						'sqft'        => '1,615',
						'price'       => '$1,210,000',
						'image'       => array( 'url' => 'http://test.test/wp-content/uploads/2026/09/1841-N-Garfield-Avenue.jpg' ),
						'category'    => 'pasadena',
						'description' => 'Private gated character compound with detached creative studio, closed over asking.',
					),
					array(
						'title'       => '14477 Badger Lane — Grand Executive Residence',
						'location'    => 'Greater Los Angeles',
						'beds'        => '5',
						'baths'       => '3.5',
						'sqft'        => '3,294',
						'price'       => '$1,099,888',
						'image'       => array( 'url' => 'http://test.test/wp-content/uploads/2026/09/14477-Badger-Lane.jpg' ),
						'category'    => 'greater-los-angeles',
						'description' => 'Record-breaking sale of an executive estate featuring resort-style pool and canyon vistas.',
					),
					array(
						'title'       => '317 N 19th Street — Private Compound & Garages',
						'location'    => 'Greater Los Angeles',
						'beds'        => '3',
						'baths'       => '1.5',
						'sqft'        => '1,127',
						'price'       => '$750,000',
						'image'       => array( 'url' => 'http://test.test/wp-content/uploads/2026/09/317-N-19th-Street.jpg' ),
						'category'    => 'greater-los-angeles',
						'description' => 'Private residential compound with multi-car garage capacity and custom upgrades.',
					),
				),
			)
		);

		$this->end_controls_section();

		// --- 5. QUICK DETAIL POPUP / DOSSIER SETTINGS ---
		$this->start_controls_section(
			'section_modal_content',
			array(
				'label' => __( 'Quick Detail Popup / Dossier', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'enable_property_modal',
			array(
				'label'        => __( 'Enable Quick Detail Popup', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'description'  => __( 'When enabled, clicking a ledger row opens a confidential quick dossier popup.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'modal_preview_in_editor',
			array(
				'label'        => __( 'Preview Popup in Editor', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
				'description'  => __( 'Turn ON to keep the popup open inside Elementor editor while styling it. Turn OFF before saving/publishing.', 'luxury-re-widgets' ),
				'condition'    => array( 'enable_property_modal' => 'yes' ),
			)
		);

		$this->add_control(
			'modal_show_img',
			array(
				'label'        => __( 'Show Property Image', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'enable_property_modal' => 'yes' ),
			)
		);

		$this->add_control(
			'modal_show_title',
			array(
				'label'        => __( 'Show Property Title', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'enable_property_modal' => 'yes' ),
			)
		);

		$this->add_control(
			'modal_show_location',
			array(
				'label'        => __( 'Show Location', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'enable_property_modal' => 'yes' ),
			)
		);

		$this->add_control(
			'modal_show_price',
			array(
				'label'        => __( 'Show Closed Price', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'enable_property_modal' => 'yes' ),
			)
		);

		$this->add_control(
			'modal_show_specs',
			array(
				'label'        => __( 'Show Specifications Badge', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'enable_property_modal' => 'yes' ),
			)
		);

		$this->add_control(
			'modal_show_desc',
			array(
				'label'        => __( 'Show Description', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'enable_property_modal' => 'yes' ),
			)
		);

		$this->add_control(
			'modal_fallback_desc',
			array(
				'label'       => __( 'Fallback / Default Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Confidential estate transaction and representation details under SERHANT.', 'luxury-re-widgets' ),
				'description' => __( 'Shown if an individual property does not have a dedicated dossier summary.', 'luxury-re-widgets' ),
				'condition'   => array(
					'enable_property_modal' => 'yes',
					'modal_show_desc'       => 'yes',
				),
			)
		);

		$this->add_control(
			'modal_show_btn',
			array(
				'label'        => __( 'Show Action Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'enable_property_modal' => 'yes' ),
			)
		);

		$this->add_control(
			'modal_btn_text',
			array(
				'label'       => __( 'Button Label', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Inquire Regarding Similar Acquisitions', 'luxury-re-widgets' ),
				'condition'   => array(
					'enable_property_modal' => 'yes',
					'modal_show_btn'        => 'yes',
				),
			)
		);

		$this->add_control(
			'modal_btn_link',
			array(
				'label'       => __( 'Button Link', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com or /contact/', 'luxury-re-widgets' ),
				'default'     => array(
					'url'         => '/contact/',
					'is_external' => false,
					'nofollow'    => false,
				),
				'condition'   => array(
					'enable_property_modal' => 'yes',
					'modal_show_btn'        => 'yes',
				),
			)
		);

		$this->add_control(
			'modal_show_btn_icon',
			array(
				'label'        => __( 'Show Button Arrow Icon (↗)', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array(
					'enable_property_modal' => 'yes',
					'modal_show_btn'        => 'yes',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- 1. SECTION CANVAS ---
		$this->start_controls_section(
			'style_canvas',
			array(
				'label' => __( 'Canvas & Borders', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0D0E10',
				'selectors' => array(
					'{{WRAPPER}} .ledger-section' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'border_color',
			array(
				'label'     => __( 'Divider & Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1F2127',
				'selectors' => array(
					'{{WRAPPER}} .ledger-section'        => 'border-top-color: {{VALUE}}; border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .ledger'               => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .ledger-row'           => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .lre-ledger-pagination'=> 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- 2. TYPOGRAPHY ---
		$this->start_controls_section(
			'style_typography',
			array(
				'label' => __( 'Header Typography', 'luxury-re-widgets' ),
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
				'selector' => '{{WRAPPER}} .section-label, {{WRAPPER}} .lre-ledger__eyebrow, {{WRAPPER}} .ledger-eyebrow',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				),
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .section-label, {{WRAPPER}} .lre-ledger__eyebrow, {{WRAPPER}} .ledger-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		// Headline / Title
		$this->add_control(
			'heading_style_title',
			array(
				'label'     => __( 'Headline', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'label'    => __( 'Headline Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .section-title, {{WRAPPER}} .lre-ledger-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Headline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .section-title, {{WRAPPER}} .lre-ledger-title' => 'color: {{VALUE}};',
				),
			)
		);

		// Subtitle
		$this->add_control(
			'heading_style_subtitle',
			array(
				'label'     => __( 'Subtitle', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typo',
				'label'    => __( 'Subtitle Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .ledger-subtitle',
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_TEXT,
				),
				'default'   => '#9EA2AA',
				'selectors' => array(
					'{{WRAPPER}} .ledger-subtitle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- 3. ROW & HOVER STYLING ---
		$this->start_controls_section(
			'style_row',
			array(
				'label' => __( 'Ledger Rows', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Typography Controls (Shared)
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'row_name_typo',
				'label'    => __( 'Property Name Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .ledger-row .name',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'row_price_typo',
				'label'    => __( 'Price Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .ledger-row .price',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'row_meta_typo',
				'label'    => __( 'Specs / Meta Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .ledger-row .meta, {{WRAPPER}} .lre-spec-item, {{WRAPPER}} .lre-spec-item span, {{WRAPPER}} .ledger-row .num',
			)
		);

		$this->add_responsive_control(
			'row_padding',
			array(
				'label'      => __( 'Row Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .ledger-row, {{WRAPPER}} .lre-ledger-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		// Two State Tabs: Normal & Hover
		$this->start_controls_tabs( 'tabs_ledger_row_style' );

		// ------------------ TAB: NORMAL ------------------
		$this->start_controls_tab(
			'tab_ledger_row_normal',
			array(
				'label' => __( 'Normal', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'row_bg_color',
			array(
				'label'     => __( 'Row Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ledger-row, {{WRAPPER}} .lre-ledger-row' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_border_color',
			array(
				'label'     => __( 'Row Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#23262D',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row, {{WRAPPER}} .lre-ledger-row' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_name_color',
			array(
				'label'     => __( 'Property Name Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row .name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_location_color',
			array(
				'label'     => __( 'Location Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8A8D96',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row .name small' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_price_color',
			array(
				'label'     => __( 'Price Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row .price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_num_color',
			array(
				'label'     => __( 'Number Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#656972',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row .num' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_meta_color',
			array(
				'label'     => __( 'Specs Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#A3A7AF',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row .meta, {{WRAPPER}} .lre-spec-item' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Bed & Bath Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .lre-meta-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_btn_bg',
			array(
				'label'     => __( 'Arrow Button Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.06)',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row .btn-circle-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_btn_color',
			array(
				'label'     => __( 'Arrow Button Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8A8D96',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row .btn-circle-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// ------------------ TAB: HOVER ------------------
		$this->start_controls_tab(
			'tab_ledger_row_hover',
			array(
				'label' => __( 'Hover', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'row_hover_bg',
			array(
				'label'     => __( 'Row Hover Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.045)',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover, {{WRAPPER}} .lre-ledger-row:hover' => 'background-color: {{VALUE}};',
				),
			)
		);


		$this->add_control(
			'row_name_hover_color',
			array(
				'label'     => __( 'Property Name Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E2C99B',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover .name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_location_hover_color',
			array(
				'label'     => __( 'Location Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#A8ACB5',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover .name small' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_price_hover_color',
			array(
				'label'     => __( 'Price Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover .price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_num_hover_color',
			array(
				'label'     => __( 'Number Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C2A882',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover .num' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'row_meta_hover_color',
			array(
				'label'     => __( 'Specs Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover .meta, {{WRAPPER}} .ledger-row:hover .lre-spec-item' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => __( 'Bed & Bath Icon Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E2C99B',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover .lre-meta-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_btn_hover_bg',
			array(
				'label'     => __( 'Arrow Button Hover Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover .btn-circle-icon' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_btn_hover_color',
			array(
				'label'     => __( 'Arrow Button Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0D0E10',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover .btn-circle-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// --- 4. AJAX PAGINATION STYLE ---
		$this->start_controls_section(
			'style_pagination',
			array(
				'label' => __( 'AJAX Pagination Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'page_btn_color',
			array(
				'label'     => __( 'Page Button Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#9EA2AA',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-page-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'page_btn_active_bg',
			array(
				'label'     => __( 'Active Page Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-page-btn.is-active' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'page_btn_active_color',
			array(
				'label'     => __( 'Active Page Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0D0E10',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-page-btn.is-active' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// STYLE TAB: QUICK DETAIL POPUP / DOSSIER STYLE
		// =================================================================
		$this->start_controls_section(
			'section_modal_style',
			array(
				'label'     => __( 'Quick Detail Popup Style', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'enable_property_modal' => 'yes' ),
			)
		);

		// 1. Backdrop Overlay
		$this->add_control(
			'heading_modal_backdrop_style',
			array(
				'label' => __( 'Backdrop & Overlay', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'modal_backdrop_color',
			array(
				'label'     => __( 'Backdrop Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(13, 14, 16, 0.88)',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal::backdrop' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'modal_backdrop_blur',
			array(
				'label'      => __( 'Backdrop Blur', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 40,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal::backdrop' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
				),
			)
		);

		// 2. Modal Card / Box
		$this->add_control(
			'heading_modal_card_style',
			array(
				'label'     => __( 'Modal Card (Box)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'modal_card_max_width',
			array(
				'label'      => __( 'Card Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 320,
						'max'  => 1100,
						'step' => 10,
					),
					'%'  => array(
						'min' => 40,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 620,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'modal_card_bg',
			array(
				'label'     => __( 'Card Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#14161A',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'modal_card_padding',
			array(
				'label'      => __( 'Card Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '36',
					'right'    => '36',
					'bottom'   => '36',
					'left'     => '36',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'modal_card_border',
				'selector' => '{{WRAPPER}} .lre-ledger-modal-card',
			)
		);

		$this->add_responsive_control(
			'modal_card_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal, {{WRAPPER}} .lre-ledger-modal-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'modal_card_shadow',
				'selector' => '{{WRAPPER}} .lre-ledger-modal',
			)
		);

		// 3. Close Button
		$this->add_control(
			'heading_modal_close_btn',
			array(
				'label'     => __( 'Close Button', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'modal_close_btn_size',
			array(
				'label'      => __( 'Button Box Size', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 24,
						'max'  => 64,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 38,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-close' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'modal_close_btn_font_size',
			array(
				'label'      => __( 'Icon Size', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 36,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 18,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-close' => 'font-size: {{SIZE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'modal_close_btn_radius',
			array(
				'label'      => __( 'Close Button Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_modal_close_btn' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_modal_close_normal',
			array(
				'label' => __( 'Normal', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'modal_close_color',
			array(
				'label'     => __( 'Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-close' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'modal_close_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.08)',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-close' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'modal_close_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.1)',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-close' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'tab_modal_close_hover',
			array(
				'label' => __( 'Hover', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'modal_close_hover_color',
			array(
				'label'     => __( 'Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0D0E10',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-close:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'modal_close_hover_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-close:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'modal_close_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-close:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		// 4. Property Image
		$this->add_control(
			'heading_modal_image_style',
			array(
				'label'     => __( 'Property Image', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'modal_image_height',
			array(
				'label'      => __( 'Image Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 120,
						'max'  => 600,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 270,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-img-wrap' => 'height: {{SIZE}}px;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'modal_image_border',
				'selector' => '{{WRAPPER}} .lre-ledger-modal-img-wrap',
			)
		);

		$this->add_responsive_control(
			'modal_image_radius',
			array(
				'label'      => __( 'Image Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-img-wrap, {{WRAPPER}} .lre-ledger-modal-img-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'modal_image_mb',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 24,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-img-wrap' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		// 5. Property Title
		$this->add_control(
			'heading_modal_title_style',
			array(
				'label'     => __( 'Property Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'modal_title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-header h3, {{WRAPPER}} #prop-modal-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'modal_title_typography',
				'selector' => '{{WRAPPER}} .lre-ledger-modal-header h3, {{WRAPPER}} #prop-modal-title',
			)
		);

		$this->add_responsive_control(
			'modal_title_mb',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 40,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 6,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-header h3, {{WRAPPER}} #prop-modal-title' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		// 6. Location
		$this->add_control(
			'heading_modal_loc_style',
			array(
				'label'     => __( 'Location', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'modal_loc_color',
			array(
				'label'     => __( 'Location Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8A8D96',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-location' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'modal_loc_typography',
				'selector' => '{{WRAPPER}} .lre-ledger-modal-location',
			)
		);

		$this->add_responsive_control(
			'modal_loc_mb',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 40,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 8,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-location' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		// 7. Closed Price / Valuation
		$this->add_control(
			'heading_modal_price_style',
			array(
				'label'     => __( 'Closed Price / Valuation', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'modal_price_color',
			array(
				'label'     => __( 'Price Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'modal_price_typography',
				'selector' => '{{WRAPPER}} .lre-ledger-modal-price',
			)
		);

		$this->add_responsive_control(
			'modal_price_mb',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 40,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-price' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		// 8. Specifications Badge
		$this->add_control(
			'heading_modal_specs_style',
			array(
				'label'     => __( 'Specifications Badge', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'modal_specs_color',
			array(
				'label'     => __( 'Specs Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-specs' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'modal_specs_bg',
			array(
				'label'     => __( 'Specs Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.06)',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-specs' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'modal_specs_typography',
				'selector' => '{{WRAPPER}} .lre-ledger-modal-specs',
			)
		);

		$this->add_responsive_control(
			'modal_specs_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '6',
					'right'    => '14',
					'bottom'   => '6',
					'left'     => '14',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-specs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'modal_specs_border',
				'selector' => '{{WRAPPER}} .lre-ledger-modal-specs',
			)
		);

		$this->add_responsive_control(
			'modal_specs_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-specs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'modal_specs_mb',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 40,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-specs' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		// 9. Description Text
		$this->add_control(
			'heading_modal_desc_style',
			array(
				'label'     => __( 'Description / Dossier Summary', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'modal_desc_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#A3A7AF',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-modal-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'modal_desc_typography',
				'selector' => '{{WRAPPER}} .lre-ledger-modal-desc',
			)
		);

		$this->add_responsive_control(
			'modal_desc_mb',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 24,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-modal-desc' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		// 10. Inquire / Action Button
		$this->add_control(
			'heading_modal_btn_style',
			array(
				'label'     => __( 'Inquire / Action Button', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'modal_btn_typography',
				'selector' => '{{WRAPPER}} .lre-ledger-inquire-btn',
			)
		);

		$this->add_responsive_control(
			'modal_btn_padding',
			array(
				'label'      => __( 'Button Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '14',
					'right'    => '28',
					'bottom'   => '14',
					'left'     => '28',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-inquire-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'modal_btn_radius',
			array(
				'label'      => __( 'Button Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-ledger-inquire-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_modal_btn_style' );

		// Button Normal Tab
		$this->start_controls_tab(
			'tab_modal_btn_normal',
			array(
				'label' => __( 'Normal', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'modal_btn_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0D0E10',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-inquire-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'modal_btn_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-inquire-btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'modal_btn_border',
				'selector' => '{{WRAPPER}} .lre-ledger-inquire-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'modal_btn_shadow',
				'selector' => '{{WRAPPER}} .lre-ledger-inquire-btn',
			)
		);

		$this->end_controls_tab();

		// Button Hover Tab
		$this->start_controls_tab(
			'tab_modal_btn_hover',
			array(
				'label' => __( 'Hover', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'modal_btn_hover_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-inquire-btn:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'modal_btn_hover_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E2C99B',
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-inquire-btn:hover' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'modal_btn_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-ledger-inquire-btn:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'modal_btn_hover_shadow',
				'selector' => '{{WRAPPER}} .lre-ledger-inquire-btn:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Helper method to render a single ledger row HTML.
	 * Used by both render() and handle_load_sold_portfolio() AJAX handler.
	 *
	 * @param array $item Property array.
	 * @param int   $index Row index.
	 * @param int   $offset Pagination offset.
	 * @return string HTML output.
	 */
	public static function render_ledger_row_html( $item, $index, $offset = 0, $enable_modal = true ) {
		$num_str  = sprintf( '%03d', $offset + $index + 1 );
		$title    = ! empty( $item['title'] ) ? $item['title'] : 'Confidential Estate';
		$loc      = ! empty( $item['location'] ) ? $item['location'] : 'Pasadena, California';
		$price    = ! empty( $item['price'] ) ? $item['price'] : 'Confidential';
		$beds     = ! empty( $item['beds'] ) ? $item['beds'] : '';
		$baths    = ! empty( $item['baths'] ) ? $item['baths'] : '';
		$sqft     = ! empty( $item['sqft'] ) ? $item['sqft'] : '';
		$cat      = ! empty( $item['category'] ) ? sanitize_title( $item['category'] ) : '';
		$desc     = ! empty( $item['description'] ) ? $item['description'] : '';
		$img      = ! empty( $item['image_url'] ) ? $item['image_url'] : '';

		$specs_arr = array();
		if ( $beds )  $specs_arr[] = $beds . ( is_numeric( $beds ) ? ' BD' : '' );
		if ( $baths ) $specs_arr[] = $baths . ( is_numeric( $baths ) ? ' BA' : '' );
		if ( $sqft )  $specs_arr[] = $sqft . ( is_numeric( str_replace( array( ',', ' ' ), '', $sqft ) ) ? ' SQFT' : '' );
		$specs_str = implode( ' • ', $specs_arr );

		ob_start();
		?>
		<div class="ledger-row lre-ledger-row<?php echo $enable_modal ? ' trigger-prop-modal' : ''; ?>"
			data-category="<?php echo esc_attr( $cat ); ?>"
			data-title="<?php echo esc_attr( $title ); ?>"
			data-price="<?php echo esc_attr( $price ); ?>"
			data-location="<?php echo esc_attr( $loc ); ?>"
			data-specs="<?php echo esc_attr( $specs_str ); ?>"
			data-desc="<?php echo esc_attr( $desc ); ?>"
			data-img="<?php echo esc_url( $img ); ?>"
			<?php if ( $enable_modal ) : ?>
			tabindex="0"
			role="button"
			aria-label="<?php echo esc_attr( sprintf( __( 'View dossier for %s, closed at %s', 'luxury-re-widgets' ), $title, $price ) ); ?>"
			<?php endif; ?>>

			<span class="num"><?php echo esc_html( $num_str ); ?></span>

			<span class="name">
				<?php echo esc_html( $title ); ?>
				<small><?php echo esc_html( $loc ); ?></small>
			</span>

			<span class="meta lre-meta-specs">
				<?php if ( ! empty( $beds ) ) : ?>
					<span class="lre-spec-item" title="<?php esc_attr_e( 'Bedrooms', 'luxury-re-widgets' ); ?>">
						<span class="lre-meta-icon" aria-hidden="true">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
								<path d="M3 7v11M21 7v11M3 13h18M5 13V9a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4M7 10h3M14 10h3"/>
							</svg>
						</span>
						<span><?php echo esc_html( $beds ); ?> <?php echo is_numeric( $beds ) ? 'BD' : ''; ?></span>
					</span>
				<?php endif; ?>
				<?php if ( ! empty( $beds ) && ! empty( $baths ) ) : ?>
					<span class="lre-meta-sep">•</span>
				<?php endif; ?>
				<?php if ( ! empty( $baths ) ) : ?>
					<span class="lre-spec-item" title="<?php esc_attr_e( 'Bathrooms', 'luxury-re-widgets' ); ?>">
						<span class="lre-meta-icon" aria-hidden="true">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
								<path d="M4 12h16a1 1 0 0 1 1 1v3a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-3a1 1 0 0 1 1-1z"/>
								<path d="M6 12V5a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v2"/>
								<path d="M4 21l1-2M20 21l-1-2"/>
							</svg>
						</span>
						<span><?php echo esc_html( $baths ); ?> <?php echo is_numeric( $baths ) ? 'BA' : ''; ?></span>
					</span>
				<?php endif; ?>
			</span>

			<span class="meta lre-meta-sqft">
				<?php if ( ! empty( $sqft ) ) : ?>
					<span class="lre-spec-item" title="<?php esc_attr_e( 'Square Footage', 'luxury-re-widgets' ); ?>">
						<span class="lre-meta-icon" aria-hidden="true">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
								<rect x="3" y="3" width="18" height="18"></rect>
								<path d="M3 9h18M9 21V9"/>
							</svg>
						</span>
						<span><?php echo esc_html( $sqft ); ?> <?php echo is_numeric( str_replace( array( ',', ' ' ), '', $sqft ) ) ? 'SQFT' : ''; ?></span>
					</span>
				<?php endif; ?>
			</span>

			<span class="price"><?php echo esc_html( $price ); ?></span>

			<span class="ledger-arrow">
				<span class="btn-circle-icon" aria-hidden="true">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
						<line x1="7" y1="17" x2="17" y2="7"></line>
						<polyline points="7 7 17 7 17 17"></polyline>
					</svg>
				</span>
			</span>

			<?php if ( ! empty( $img ) ) : ?>
				<div class="ledger-thumb" aria-hidden="true">
					<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" />
				</div>
				<div class="ledger-mobile-thumb" aria-hidden="true">
					<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" />
				</div>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Helper method to render AJAX pagination HTML.
	 *
	 * @param int $paged Current page.
	 * @param int $max_pages Max pages.
	 * @return string HTML output.
	 */
	public static function render_pagination_html( $paged, $max_pages ) {
		if ( $max_pages <= 1 ) {
			return '';
		}

		ob_start();
		?>
		<nav class="lre-ledger-pagination" aria-label="<?php esc_attr_e( 'Private Ledger Pagination', 'luxury-re-widgets' ); ?>">
			<button class="lre-ledger-page-btn lre-prev-btn<?php echo ( $paged <= 1 ) ? ' is-disabled' : ''; ?>"
				data-page="<?php echo esc_attr( $paged - 1 ); ?>"
				<?php echo ( $paged <= 1 ) ? 'disabled' : ''; ?>
				aria-label="<?php esc_attr_e( 'Previous Page', 'luxury-re-widgets' ); ?>">
				« <?php esc_html_e( 'Prev', 'luxury-re-widgets' ); ?>
			</button>

			<?php for ( $i = 1; $i <= $max_pages; $i++ ) : ?>
				<button class="lre-ledger-page-btn<?php echo ( $i === $paged ) ? ' is-active' : ''; ?>"
					data-page="<?php echo esc_attr( $i ); ?>"
					aria-current="<?php echo ( $i === $paged ) ? 'page' : 'false'; ?>">
					<?php echo esc_html( $i ); ?>
				</button>
			<?php endfor; ?>

			<button class="lre-ledger-page-btn lre-next-btn<?php echo ( $paged >= $max_pages ) ? ' is-disabled' : ''; ?>"
				data-page="<?php echo esc_attr( $paged + 1 ); ?>"
				<?php echo ( $paged >= $max_pages ) ? 'disabled' : ''; ?>
				aria-label="<?php esc_attr_e( 'Next Page', 'luxury-re-widgets' ); ?>">
				<?php esc_html_e( 'Next', 'luxury-re-widgets' ); ?> »
			</button>
		</nav>
		<?php
		return ob_get_clean();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$show_header     = ! empty( $settings['show_header'] ) && 'yes' === $settings['show_header'];
		$eyebrow         = ! empty( $settings['eyebrow'] ) ? $settings['eyebrow'] : '';
		$title           = ! empty( $settings['title'] ) ? $settings['title'] : 'The Private Ledger';
		$title_tag       = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
		$subtitle        = ! empty( $settings['subtitle'] ) ? $settings['subtitle'] : '';

		$source          = ! empty( $settings['content_source'] ) ? $settings['content_source'] : 'cpt';
		$posts_per_page  = ! empty( $settings['posts_per_page'] ) ? max( 1, intval( $settings['posts_per_page'] ) ) : 6;
		$orderby         = ! empty( $settings['orderby'] ) ? $settings['orderby'] : 'date';
		$order           = ! empty( $settings['order'] ) ? $settings['order'] : 'DESC';

		$show_filters    = ! empty( $settings['show_filters'] ) && 'yes' === $settings['show_filters'];
		$show_pagination = ! empty( $settings['show_pagination'] ) && 'yes' === $settings['show_pagination'];

		$enable_modal   = ! empty( $settings['enable_property_modal'] ) ? $settings['enable_property_modal'] : 'yes';
		$modal_preview  = ! empty( $settings['modal_preview_in_editor'] ) && 'yes' === $settings['modal_preview_in_editor'] && \Elementor\Plugin::$instance->editor->is_edit_mode();
		$show_img       = ! empty( $settings['modal_show_img'] ) ? $settings['modal_show_img'] : 'yes';
		$show_title     = ! empty( $settings['modal_show_title'] ) ? $settings['modal_show_title'] : 'yes';
		$show_loc       = ! empty( $settings['modal_show_location'] ) ? $settings['modal_show_location'] : 'yes';
		$show_price     = ! empty( $settings['modal_show_price'] ) ? $settings['modal_show_price'] : 'yes';
		$show_specs     = ! empty( $settings['modal_show_specs'] ) ? $settings['modal_show_specs'] : 'yes';
		$show_desc      = ! empty( $settings['modal_show_desc'] ) ? $settings['modal_show_desc'] : 'yes';
		$fallback_desc  = ! empty( $settings['modal_fallback_desc'] ) ? $settings['modal_fallback_desc'] : __( 'Confidential estate transaction and representation details under SERHANT.', 'luxury-re-widgets' );
		$show_btn       = ! empty( $settings['modal_show_btn'] ) ? $settings['modal_show_btn'] : 'yes';
		$btn_text       = ! empty( $settings['modal_btn_text'] ) ? $settings['modal_btn_text'] : __( 'Inquire Regarding Similar Acquisitions', 'luxury-re-widgets' );
		$btn_url        = ! empty( $settings['modal_btn_link']['url'] ) ? $settings['modal_btn_link']['url'] : '/contact/';
		$btn_target     = ! empty( $settings['modal_btn_link']['is_external'] ) ? ' target="_blank"' : '';
		$btn_nofollow   = ! empty( $settings['modal_btn_link']['nofollow'] ) ? ' rel="nofollow"' : '';
		$show_btn_icon  = ! empty( $settings['modal_show_btn_icon'] ) ? $settings['modal_show_btn_icon'] : 'yes';

		$paged      = 1;
		$max_pages  = 1;
		$entries    = array();
		$categories = array();

		// 1. Fetch from CPT
		if ( 'cpt' === $source ) {
			$args = array(
				'post_type'      => 'lre_sold_property',
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'paged'          => $paged,
			);

			if ( 'price' === $orderby ) {
				$args['meta_key'] = '_lre_sold_price';
				$args['orderby']  = 'meta_value_num';
				$args['order']    = $order;
			} elseif ( 'title' === $orderby ) {
				$args['orderby'] = 'title';
				$args['order']   = $order;
			} else {
				$args['orderby'] = 'date';
				$args['order']   = $order;
			}

			$query = new \WP_Query( $args );
			$max_pages = $query->max_num_pages;

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$pid       = get_the_ID();
					$img_url   = get_the_post_thumbnail_url( $pid, 'large' );
					$terms     = wp_get_post_terms( $pid, 'sold_location', array( 'fields' => 'slugs' ) );
					$cat_slug  = ! empty( $terms ) ? implode( ' ', $terms ) : '';
					$loc_names = wp_get_post_terms( $pid, 'sold_location', array( 'fields' => 'names' ) );
					$city      = get_post_meta( $pid, '_lre_city', true );
					$location  = ! empty( $loc_names ) ? implode( ', ', $loc_names ) : ( $city ? $city . ', California' : 'Pasadena, California' );
					$desc      = get_the_excerpt() ? get_the_excerpt() : wp_trim_words( get_post_field( 'post_content', $pid ), 25 );

					$entries[] = array(
						'title'       => get_the_title(),
						'price'       => get_post_meta( $pid, '_lre_sold_price', true ) ?: 'Confidential',
						'beds'        => get_post_meta( $pid, '_lre_beds', true ) ?: '',
						'baths'       => get_post_meta( $pid, '_lre_baths', true ) ?: '',
						'sqft'        => get_post_meta( $pid, '_lre_sqft', true ) ?: '',
						'location'    => $location,
						'category'    => $cat_slug,
						'image_url'   => $img_url ?: '',
						'description' => $desc,
					);
				}
				wp_reset_postdata();
			}

			// Taxonomies for filter tabs
			if ( $show_filters ) {
				$tax_terms = get_terms( array( 'taxonomy' => 'sold_location', 'hide_empty' => true ) );
				if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ) {
					foreach ( $tax_terms as $t ) {
						$categories[ $t->slug ] = $t->name;
					}
				}
			}
		} else {
			// 2. Fetch from Repeater
			$repeater_items = ! empty( $settings['ledger_items'] ) ? $settings['ledger_items'] : array();
			$total_repeater = count( $repeater_items );
			$max_pages      = ceil( $total_repeater / $posts_per_page );
			$paged_items    = array_slice( $repeater_items, 0, $posts_per_page );

			foreach ( $paged_items as $item ) {
				$entries[] = array(
					'title'       => ! empty( $item['title'] ) ? $item['title'] : '',
					'price'       => ! empty( $item['price'] ) ? $item['price'] : 'Confidential',
					'beds'        => ! empty( $item['beds'] ) ? $item['beds'] : '',
					'baths'       => ! empty( $item['baths'] ) ? $item['baths'] : '',
					'sqft'        => ! empty( $item['sqft'] ) ? $item['sqft'] : '',
					'location'    => ! empty( $item['location'] ) ? $item['location'] : '',
					'category'    => ! empty( $item['category'] ) ? sanitize_title( $item['category'] ) : '',
					'image_url'   => ! empty( $item['image']['url'] ) ? $item['image']['url'] : '',
					'description' => ! empty( $item['description'] ) ? $item['description'] : '',
				);
			}

			if ( $show_filters && ! empty( $repeater_items ) ) {
				foreach ( $repeater_items as $item ) {
					if ( ! empty( $item['category'] ) ) {
						$cslug = sanitize_title( $item['category'] );
						$categories[ $cslug ] = ucwords( str_replace( array( '-', '_' ), ' ', $cslug ) );
					}
				}
			}
		}

		$section_id = 'ledger-' . $this->get_id();
		?>
		<section class="ledger-section lre-ledger-section"
			id="<?php echo esc_attr( $section_id ); ?>"
			data-source="<?php echo esc_attr( $source ); ?>"
			data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>"
			data-orderby="<?php echo esc_attr( $orderby ); ?>"
			data-order="<?php echo esc_attr( $order ); ?>"
			data-max-pages="<?php echo esc_attr( $max_pages ); ?>">

			<div class="container lre-ledger-container">

				<?php if ( $show_header ) : ?>
					<div class="ledger-head">
						<div>
							<?php if ( ! empty( $eyebrow ) ) : ?>
								<div class="lre-ledger__eyebrow-wrap">
									<span class="section-label lre-ledger__eyebrow ledger-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
								</div>
							<?php endif; ?>
							<<?php echo esc_html( $title_tag ); ?> class="section-title lre-ledger-title">
								<?php echo esc_html( $title ); ?>
							</<?php echo esc_html( $title_tag ); ?>>
						</div>
						<?php if ( ! empty( $subtitle ) ) : ?>
							<p class="ledger-subtitle">
								<?php echo esc_html( $subtitle ); ?>
							</p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $show_filters && ! empty( $categories ) ) : ?>
					<div class="lre-ledger-filters" role="tablist">
						<button class="lre-ledger-filter is-active" data-filter="all" role="tab" aria-selected="true">
							<?php echo esc_html( $settings['filter_all_label'] ); ?>
						</button>
						<?php foreach ( $categories as $slug => $cname ) : ?>
							<button class="lre-ledger-filter" data-filter="<?php echo esc_attr( $slug ); ?>" role="tab" aria-selected="false">
								<?php echo esc_html( $cname ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="ledger lre-ledger">
					<?php
					if ( ! empty( $entries ) ) :
						foreach ( $entries as $index => $item ) :
							echo self::render_ledger_row_html( $item, $index, 0, ( 'yes' === $enable_modal ) );
						endforeach;
					else :
						?>
						<div class="lre-ledger-empty" style="padding:3rem 0;text-align:center;color:#8E929B;font-family:inherit;font-size:0.95rem;">
							<?php esc_html_e( 'No confidential transactions found in this registry.', 'luxury-re-widgets' ); ?>
						</div>
						<?php
					endif;
					?>
				</div>

				<?php if ( $show_pagination && $max_pages > 1 ) : ?>
					<div class="lre-ledger-pagination-wrap">
						<?php echo self::render_pagination_html( $paged, $max_pages ); ?>
					</div>
				<?php endif; ?>

			</div>

			<?php if ( 'yes' === $enable_modal ) : ?>
			<!-- Built-in Property Quick Detail Modal (Dialog) -->
			<dialog id="property-modal" class="custom-modal lre-ledger-modal<?php echo $modal_preview ? ' is-editor-preview' : ''; ?>" aria-labelledby="prop-modal-title"<?php echo $modal_preview ? ' open' : ''; ?>>
				<div class="modal-card lre-ledger-modal-card">
					<button id="close-prop-modal" class="modal-close-btn lre-ledger-modal-close" aria-label="<?php esc_attr_e( 'Close dossier dialog', 'luxury-re-widgets' ); ?>">✕</button>
					
					<?php if ( 'yes' === $show_img ) : ?>
					<div class="lre-ledger-modal-img-wrap">
						<img id="prop-modal-img" src="<?php echo esc_url( $modal_preview && ! empty( $entries[0]['image_url'] ) ? $entries[0]['image_url'] : '' ); ?>" alt="<?php esc_attr_e( 'Property Preview', 'luxury-re-widgets' ); ?>" />
					</div>
					<?php endif; ?>

					<div class="modal-header lre-ledger-modal-header">
						<?php if ( 'yes' === $show_title ) : ?>
						<h3 id="prop-modal-title"><?php echo esc_html( $modal_preview && ! empty( $entries[0]['title'] ) ? $entries[0]['title'] : __( 'Property Title', 'luxury-re-widgets' ) ); ?></h3>
						<?php endif; ?>

						<?php if ( 'yes' === $show_loc ) : ?>
						<div id="prop-modal-location" class="lre-ledger-modal-location"><?php echo esc_html( $modal_preview && ! empty( $entries[0]['location'] ) ? $entries[0]['location'] : __( 'Location', 'luxury-re-widgets' ) ); ?></div>
						<?php endif; ?>

						<?php if ( 'yes' === $show_price ) : ?>
						<div id="prop-modal-price" class="lre-ledger-modal-price"><?php echo esc_html( $modal_preview && ! empty( $entries[0]['price'] ) ? $entries[0]['price'] : __( 'Price', 'luxury-re-widgets' ) ); ?></div>
						<?php endif; ?>

						<?php if ( 'yes' === $show_specs ) : ?>
						<div id="prop-modal-specs" class="lre-ledger-modal-specs"><?php echo esc_html( $modal_preview ? '4 BD • 3 BA • 4,200 SQFT' : __( 'Specs', 'luxury-re-widgets' ) ); ?></div>
						<?php endif; ?>

						<?php if ( 'yes' === $show_desc ) : ?>
						<p id="prop-modal-desc" class="lre-ledger-modal-desc" data-default-desc="<?php echo esc_attr( $fallback_desc ); ?>">
							<?php echo esc_html( $modal_preview && ! empty( $entries[0]['description'] ) ? $entries[0]['description'] : $fallback_desc ); ?>
						</p>
						<?php endif; ?>
					</div>

					<?php if ( 'yes' === $show_btn ) : ?>
					<div class="lre-ledger-modal-actions">
						<a href="<?php echo esc_url( $btn_url ); ?>" class="lre-ledger-inquire-btn"<?php echo $btn_target . $btn_nofollow; ?>>
							<span><?php echo esc_html( $btn_text ); ?></span>
							<?php if ( 'yes' === $show_btn_icon ) : ?>
								<span aria-hidden="true">↗</span>
							<?php endif; ?>
						</a>
					</div>
					<?php endif; ?>
				</div>
			</dialog>
			<?php endif; ?>
		</section>
		<?php
	}
}
