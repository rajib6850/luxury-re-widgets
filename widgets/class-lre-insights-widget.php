<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Insights_Widget
 *
 * Ultra-luxury "Market Insights & Editorial Intelligence" showcase and archive widget.
 * Adaptable across Homepage, About page, Archive, and dedicated Insights pages.
 * Supports both custom curated collections (manual repeater) and dynamic WordPress queries.
 * Designed with quiet-luxury restraint: understated typography, refined monochrome depth,
 * subtle champagne whispers (zero over-the-top gold), and full responsive layout controls.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Insights_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_insights';
	}

	public function get_title() {
		return __( 'LRE — Market Insights & Editorial Grid', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'insights', 'market', 'editorial', 'blog', 'reports', 'articles', 'journal', 'serhant', 'pasadena', 'archive' );
	}

	/**
	 * Get WordPress Post Categories helper for query dropdown.
	 */
	protected function get_post_categories() {
		$options = array( 'all' => __( 'All Categories', 'luxury-re-widgets' ) );
		$terms   = get_terms( array(
			'taxonomy'   => 'category',
			'hide_empty' => false,
		) );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->term_id ] = $term->name;
			}
		}

		return $options;
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- SECTION 1: SOURCE & QUERY ---
		$this->start_controls_section(
			'section_source',
			array(
				'label' => __( 'Query & Data Source', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'source_type',
			array(
				'label'       => __( 'Content Source', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'manual',
				'options'     => array(
					'manual' => __( 'Custom Curated Collection (Manual)', 'luxury-re-widgets' ),
					'posts'  => __( 'WordPress Dynamic Posts (Blog / Archive)', 'luxury-re-widgets' ),
				),
				'description' => __( 'Choose "Custom Curated" for hand-crafted showcases on Homepage/Insights, or "WordPress Dynamic" to pull live blog/archive posts automatically.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'post_category',
			array(
				'label'     => __( 'Filter by Category', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'all',
				'options'   => $this->get_post_categories(),
				'condition' => array( 'source_type' => 'posts' ),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'     => __( 'Number of Posts', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 6,
				'min'       => 1,
				'max'       => 30,
				'step'      => 1,
				'condition' => array( 'source_type' => 'posts' ),
			)
		);

		$this->add_control(
			'order_by',
			array(
				'label'     => __( 'Order By', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => array(
					'date'          => __( 'Date', 'luxury-re-widgets' ),
					'title'         => __( 'Title', 'luxury-re-widgets' ),
					'rand'          => __( 'Random', 'luxury-re-widgets' ),
					'comment_count' => __( 'Popularity', 'luxury-re-widgets' ),
				),
				'condition' => array( 'source_type' => 'posts' ),
			)
		);

		$this->add_control(
			'order',
			array(
				'label'     => __( 'Order', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => array(
					'DESC' => __( 'Descending (Latest First)', 'luxury-re-widgets' ),
					'ASC'  => __( 'Ascending (Oldest First)', 'luxury-re-widgets' ),
				),
				'condition' => array( 'source_type' => 'posts' ),
			)
		);

		$this->add_control(
			'show_pagination',
			array(
				'label'        => __( 'Show Pagination (Archive Mode)', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'condition'    => array( 'source_type' => 'posts' ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 2: HEADER & INTRO ---
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
				'label'        => __( 'Display Header', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'header_align',
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
				),
				'default'   => 'left',
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '— MARKET INTELLIGENCE & PERSPECTIVES',
				'condition'   => array( 'show_header' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading (HTML Allowed)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => "Market Insights &<br>Architectural Perspectives",
				'condition'   => array( 'show_header' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'     => __( 'Heading Tag', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'options'   => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'div'  => 'div',
				),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => 'Discreet research, capital liquidity analytics, and architectural commentary for Southern California real estate principals.',
				'condition'   => array( 'show_header' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 3: FILTER BAR ---
		$this->start_controls_section(
			'section_filter',
			array(
				'label' => __( 'Category Filter Bar', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_filter',
			array(
				'label'        => __( 'Show Filter Navigation', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'all_label',
			array(
				'label'       => __( '"All" Tab Label', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'All Intelligence',
				'condition'   => array( 'show_filter' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 4: MANUAL ARTICLES REPEATER ---
		$this->start_controls_section(
			'section_articles',
			array(
				'label'     => __( 'Curated Articles List', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array( 'source_type' => 'manual' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Article Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => 'Pasadena’s Architectural Pedigree: Why Landmark Craftsman Estates Command Record Valuations',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'category_slug',
			array(
				'label'       => __( 'Category Slug (Filter Key)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'architectural-heritage',
				'description' => __( 'Use lowercase letters and dashes (e.g. architectural-heritage, private-advisory, market-reports, neighborhood-intel)', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'category_label',
			array(
				'label'   => __( 'Category Display Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ARCHITECTURAL HERITAGE',
			)
		);

		$repeater->add_control(
			'date',
			array(
				'label'   => __( 'Date / Edition', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SEPTEMBER 2026',
			)
		);

		$repeater->add_control(
			'read_time',
			array(
				'label'   => __( 'Read Time', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '5 MIN READ',
			)
		);

		$repeater->add_control(
			'excerpt',
			array(
				'label'   => __( 'Excerpt / Abstract', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Examining the enduring appeal of Greene & Greene, Wallace Neff, and Mid-Century Modern masters commanding unprecedented valuation premiums in Greater Pasadena.',
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Card Image', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => array(
					'url' => function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-3.jpg' ) : '',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'   => __( 'Article Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url' => home_url( '/contact/' ),
				),
			)
		);

		$repeater->add_control(
			'link_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'READ MORE',
			)
		);

		$this->add_control(
			'articles_list',
			array(
				'label'       => __( 'Articles Collection', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'          => 'The 2026 Southern California Architectural & Estate Liquidity Report',
						'category_slug'  => 'market-reports',
						'category_label' => 'MARKET REPORTS',
						'date'           => 'OCTOBER 2026',
						'read_time'      => '6 MIN READ',
						'excerpt'        => 'An exhaustive analysis of off-market private capital liquidity, historic Craftsman preservation premiums across Pasadena & San Marino, and shifting high-net-worth buyer demand.',
						'image'          => array( 'url' => function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-1.jpg' ) : '' ),
						'link'           => array( 'url' => home_url( '/contact/' ) ),
						'link_text'      => 'READ DOSSIER',
					),
					array(
						'title'          => 'Pasadena’s Architectural Pedigree: Why Landmark Craftsman Estates Command Record Valuations',
						'category_slug'  => 'architectural-heritage',
						'category_label' => 'ARCHITECTURAL HERITAGE',
						'date'           => 'SEPTEMBER 2026',
						'read_time'      => '5 MIN READ',
						'excerpt'        => 'Examining the enduring appeal of Greene & Greene, Wallace Neff, and Mid-Century Modern masters commanding unprecedented valuation premiums in Greater Pasadena.',
						'image'          => array( 'url' => function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-3.jpg' ) : '' ),
						'link'           => array( 'url' => home_url( '/communities/pasadena/' ) ),
						'link_text'      => 'READ REPORT',
					),
					array(
						'title'          => 'Navigating Off-Market Acquisitions: The Private Sovereign Escrow Protocol',
						'category_slug'  => 'private-advisory',
						'category_label' => 'PRIVATE ADVISORY',
						'date'           => 'AUGUST 2026',
						'read_time'      => '4 MIN READ',
						'excerpt'        => 'Why over 40% of Southern California’s premier residential trophy properties trade discreetly without public syndication, and how principals protect privacy.',
						'image'          => array( 'url' => function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-4.jpg' ) : '' ),
						'link'           => array( 'url' => home_url( '/sell-with-adolfo/' ) ),
						'link_text'      => 'VIEW PROTOCOL',
					),
					array(
						'title'          => 'San Marino & The Huntington District: An Enduring Legacy of Generational Wealth',
						'category_slug'  => 'neighborhood-intel',
						'category_label' => 'NEIGHBORHOOD INTEL',
						'date'           => 'JULY 2026',
						'read_time'      => '5 MIN READ',
						'excerpt'        => 'A meticulous study of San Marino’s expansive acreage estates, strict preservation zoning, and generational wealth preservation corridors.',
						'image'          => array( 'url' => function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-7.jpg' ) : '' ),
						'link'           => array( 'url' => home_url( '/communities/san-marino/' ) ),
						'link_text'      => 'EXPLORE ENCLAVE',
					),
					array(
						'title'          => 'Cinematographic Media & Global Syndication: Redefining Modern Estate Representation',
						'category_slug'  => 'market-reports',
						'category_label' => 'MARKET REPORTS',
						'date'           => 'JUNE 2026',
						'read_time'      => '4 MIN READ',
						'excerpt'        => 'How SERHANT.’s industry-leading production engine and multi-platform media reach convert cinematic architectural storytelling into qualified global liquidity.',
						'image'          => array( 'url' => function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-8.jpg' ) : '' ),
						'link'           => array( 'url' => home_url( '/about-adolfo/' ) ),
						'link_text'      => 'DISCOVER STRATEGY',
					),
					array(
						'title'          => 'The Evolution of Mid-Century Post-and-Beam Estates in Southern California',
						'category_slug'  => 'architectural-heritage',
						'category_label' => 'ARCHITECTURAL HERITAGE',
						'date'           => 'MAY 2026',
						'read_time'      => '5 MIN READ',
						'excerpt'        => 'An exploration of iconic glass pavilions, organic integration, and restoration philosophies preserving California modernism for the next generation.',
						'image'          => array( 'url' => function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-2.jpg' ) : '' ),
						'link'           => array( 'url' => home_url( '/contact/' ) ),
						'link_text'      => 'READ PERSPECTIVE',
					),
				),
			)
		);

		$this->end_controls_section();

		// --- SECTION 5: CARD DISPLAY TOGGLES (CONTROL EVERYTHING) ---
		$this->start_controls_section(
			'section_elements_visibility',
			array(
				'label' => __( 'Card Elements & Visibility', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_image',
			array(
				'label'        => __( 'Display Media / Image', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'      => __( 'Image Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 160,
						'max'  => 450,
						'step' => 10,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 260,
				),
				'condition'  => array( 'show_image' => 'yes' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-insights__card-media' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'show_badge',
			array(
				'label'        => __( 'Display Category Badge', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'show_image' => 'yes' ),
			)
		);

		$this->add_control(
			'show_meta',
			array(
				'label'        => __( 'Display Meta Bar (Date & Read Time)', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_excerpt',
			array(
				'label'        => __( 'Display Excerpt', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'excerpt_words',
			array(
				'label'     => __( 'Excerpt Word Count', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 22,
				'min'       => 5,
				'max'       => 100,
				'condition' => array( 'show_excerpt' => 'yes' ),
			)
		);

		$this->add_control(
			'show_link',
			array(
				'label'        => __( 'Display Action Link', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'force_consistent_link_text',
			array(
				'label'        => __( 'Force Consistent Button Text', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'description'  => __( 'Ensure all cards consistently display the exact same button text (e.g. READ MORE).', 'luxury-re-widgets' ),
				'condition'    => array( 'show_link' => 'yes' ),
			)
		);

		$this->add_control(
			'default_link_text',
			array(
				'label'       => __( 'Consistent Button Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'READ MORE',
				'condition'   => array( 'show_link' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 6: BOTTOM SHOWCASE ACTION (HOMEPAGE & LANDING PAGES) ---
		$this->start_controls_section(
			'section_bottom_cta',
			array(
				'label' => __( 'Bottom Action (Showcase Mode)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_bottom_cta',
			array(
				'label'        => __( 'Display "View All" Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'description'  => __( 'Turn this ON when using this widget on the Homepage or other landing pages to link to the full Insights archive page.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'bottom_cta_text',
			array(
				'label'       => __( 'Button Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'VIEW ALL INSIGHTS & REPORTS',
				'condition'   => array( 'show_bottom_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'bottom_cta_link',
			array(
				'label'       => __( 'Button Link', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-site.com/insights/', 'luxury-re-widgets' ),
				'default'     => array(
					'url' => home_url( '/insights/' ),
				),
				'condition'   => array( 'show_bottom_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'bottom_cta_align',
			array(
				'label'     => __( 'Button Alignment', 'luxury-re-widgets' ),
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
				'condition' => array( 'show_bottom_cta' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: SECTION & LAYOUT ---
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section & Grid Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0B0B0B',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'           => __( 'Grid Columns', 'luxury-re-widgets' ),
				'type'            => Controls_Manager::SELECT,
				'default'         => '3',
				'tablet_default'  => '2',
				'mobile_default'  => '1',
				'options'         => array(
					'1' => '1 Column',
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				),
				'selectors'       => array(
					'{{WRAPPER}} .lre-insights__grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				),
			)
		);

		$this->add_responsive_control(
			'grid_gap',
			array(
				'label'      => __( 'Grid Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 10, 'max' => 60 ),
					'rem' => array( 'min' => 0.5, 'max' => 4 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-insights__grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'rem', '%' ),
				'default'    => array(
					'top'      => '5.5',
					'right'    => '1.5',
					'bottom'   => '5.5',
					'left'     => '1.5',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-insights' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: HEADER ---
		$this->start_controls_section(
			'style_header',
			array(
				'label'     => __( 'Header Typography & Colors', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color (Subtle Whisper)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'var(--lre-gold, #C5A059)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__eyebrow',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F9F9FB',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => __( 'Heading Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__heading',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#98989E',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => __( 'Description Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__desc',
			)
		);

		$this->end_controls_section();

		// --- STYLE: FILTER BUTTONS ---
		$this->start_controls_section(
			'style_filter',
			array(
				'label'     => __( 'Filter Tabs Style', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_filter' => 'yes' ),
			)
		);

		$this->add_control(
			'filter_btn_color',
			array(
				'label'     => __( 'Tab Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#A0A0A5',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__filter-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_btn_active_color',
			array(
				'label'     => __( 'Active Tab Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__filter-btn.active' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_btn_active_bg',
			array(
				'label'     => __( 'Active Tab Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.09)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__filter-btn.active' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_btn_active_border',
			array(
				'label'     => __( 'Active Tab Border', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.35)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__filter-btn.active' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'filter_typography',
				'label'    => __( 'Tabs Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__filter-btn',
			)
		);

		$this->end_controls_section();

		// --- STYLE: CARDS ---
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Editorial Card Styles', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#121213',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Hairline Border', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.07)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_border',
			array(
				'label'     => __( 'Hover Border (Quiet Luxury Accent)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.22)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__card:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'card_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '2',
					'right'    => '2',
					'bottom'   => '2',
					'left'     => '2',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-insights__card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__card-title, {{WRAPPER}} .lre-insights__card-title a',
			)
		);

		$this->add_control(
			'card_title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F4F4F6',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__card-title, {{WRAPPER}} .lre-insights__card-title a' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'card_title_hover_color',
			array(
				'label'     => __( 'Title Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'var(--lre-gold, #C5A059)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__card-title a:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_desc_typography',
				'label'    => __( 'Excerpt Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__card-excerpt',
			)
		);

		$this->add_control(
			'card_desc_color',
			array(
				'label'     => __( 'Excerpt Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#929298',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__card-excerpt' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_meta_typography',
				'label'    => __( 'Meta Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__card-meta',
			)
		);

		$this->add_control(
			'card_meta_color',
			array(
				'label'     => __( 'Meta Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7C7C82',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__card-meta' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_link_typography',
				'label'    => __( 'Action Link Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__read-link',
			)
		);

		$this->add_control(
			'card_link_color',
			array(
				'label'     => __( 'Action Link Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'var(--lre-gold, #C5A059)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__read-link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// --- SECTION 11: PAGINATION (POSTS MODE) ---
		$this->start_controls_section(
			'section_style_pagination',
			array(
				'label'     => __( 'Archive Pagination', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'source_type'     => 'posts',
					'show_pagination' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_spacing',
			array(
				'label'      => __( 'Top Margin', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 120 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 4 ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-insights__pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_gap',
			array(
				'label'      => __( 'Gap Between Items', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array( 'min' => 2, 'max' => 30 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 10 ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-insights__pagination' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pagination_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-insights__pagination .page-numbers',
			)
		);

		$this->start_controls_tabs( 'tabs_pagination_style' );

		// Tab: Normal
		$this->start_controls_tab(
			'tab_pagination_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'pagination_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E2E2E6',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination a.page-numbers, {{WRAPPER}} .lre-insights__pagination span.page-numbers:not(.current)' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.06)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination a.page-numbers, {{WRAPPER}} .lre-insights__pagination span.page-numbers:not(.current)' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.18)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination a.page-numbers, {{WRAPPER}} .lre-insights__pagination span.page-numbers:not(.current)' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// Tab: Hover
		$this->start_controls_tab(
			'tab_pagination_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'pagination_hover_text_color',
			array(
				'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'var(--lre-gold, #C5A059)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination a.page-numbers:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_hover_bg_color',
			array(
				'label'     => __( 'Hover Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.14)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination a.page-numbers:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'var(--lre-gold, #C5A059)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination a.page-numbers:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// Tab: Active / Current
		$this->start_controls_tab(
			'tab_pagination_active',
			array( 'label' => __( 'Active', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'pagination_active_text_color',
			array(
				'label'     => __( 'Active Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0C0C0E',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination .page-numbers.current, {{WRAPPER}} .lre-insights__pagination span.page-numbers.current' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_active_bg_color',
			array(
				'label'     => __( 'Active Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'var(--lre-gold, #C5A059)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination .page-numbers.current, {{WRAPPER}} .lre-insights__pagination span.page-numbers.current' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_active_border_color',
			array(
				'label'     => __( 'Active Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'var(--lre-gold, #C5A059)',
				'selectors' => array(
					'{{WRAPPER}} .lre-insights__pagination .page-numbers.current, {{WRAPPER}} .lre-insights__pagination span.page-numbers.current' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'pagination_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'before',
				'default'    => array(
					'top'      => '4',
					'right'    => '4',
					'bottom'   => '4',
					'left'     => '4',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-insights__pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$source_type        = ! empty( $settings['source_type'] ) ? $settings['source_type'] : 'manual';
		$show_header        = 'yes' === $settings['show_header'];
		$header_align       = ! empty( $settings['header_align'] ) ? $settings['header_align'] : 'left';
		$show_filter        = 'yes' === $settings['show_filter'];
		$show_image         = 'yes' === $settings['show_image'];
		$show_badge         = 'yes' === $settings['show_badge'] && $show_image;
		$show_meta          = 'yes' === $settings['show_meta'];
		$show_excerpt       = 'yes' === $settings['show_excerpt'];
		$excerpt_words      = ! empty( $settings['excerpt_words'] ) ? intval( $settings['excerpt_words'] ) : 22;
		$show_link          = 'yes' === $settings['show_link'];
		$force_consistent   = 'no' !== ( isset( $settings['force_consistent_link_text'] ) ? $settings['force_consistent_link_text'] : 'yes' );
		$default_link_text  = ! empty( $settings['default_link_text'] ) ? $settings['default_link_text'] : __( 'READ MORE', 'luxury-re-widgets' );
		$show_bottom_cta    = 'yes' === $settings['show_bottom_cta'];

		// Prepare items list according to source_type
		$items      = array();
		$categories = array();

		if ( 'posts' === $source_type ) {
			// Dynamic WordPress query
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
			$args  = array(
				'post_type'      => 'post',
				'posts_per_page' => ! empty( $settings['posts_per_page'] ) ? intval( $settings['posts_per_page'] ) : 6,
				'paged'          => $paged,
				'orderby'        => ! empty( $settings['order_by'] ) ? $settings['order_by'] : 'date',
				'order'          => ! empty( $settings['order'] ) ? $settings['order'] : 'DESC',
				'post_status'    => 'publish',
			);

			if ( ! empty( $settings['post_category'] ) && 'all' !== $settings['post_category'] ) {
				$args['cat'] = intval( $settings['post_category'] );
			}

			$query = new \WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$p_id        = get_the_ID();
					$p_cats      = get_the_category( $p_id );
					$c_slug      = ! empty( $p_cats[0] ) ? $p_cats[0]->slug : 'general';
					$c_name      = ! empty( $p_cats[0] ) ? strtoupper( $p_cats[0]->name ) : 'INTELLIGENCE';
					$img_url     = has_post_thumbnail( $p_id ) ? get_the_post_thumbnail_url( $p_id, 'large' ) : ( function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-2.jpg' ) : '' );
					$raw_content = get_the_excerpt( $p_id ) ? get_the_excerpt( $p_id ) : wp_strip_all_tags( get_the_content( $p_id ) );
					$word_count  = str_word_count( strip_tags( get_the_content( $p_id ) ) );
					$read_min    = max( 1, ceil( $word_count / 200 ) );

					$items[] = array(
						'title'          => get_the_title( $p_id ),
						'category_slug'  => $c_slug,
						'category_label' => $c_name,
						'date'           => strtoupper( get_the_date( 'F Y', $p_id ) ),
						'read_time'      => $read_min . ' MIN READ',
						'excerpt'        => wp_trim_words( $raw_content, $excerpt_words, '...' ),
						'image'          => array( 'url' => $img_url ),
						'link'           => array( 'url' => get_permalink( $p_id ) ),
						'link_text'      => $default_link_text,
					);
				}
				wp_reset_postdata();
			}
		} else {
			// Manual custom repeater
			$items = ! empty( $settings['articles_list'] ) ? $settings['articles_list'] : array();
		}

		// Collect unique categories for filter tabs
		if ( ! empty( $items ) ) {
			foreach ( $items as $art ) {
				$slug  = ! empty( $art['category_slug'] ) ? sanitize_title( $art['category_slug'] ) : '';
				$label = ! empty( $art['category_label'] ) ? $art['category_label'] : '';
				if ( $slug && $label && ! isset( $categories[ $slug ] ) ) {
					$categories[ $slug ] = $label;
				}
			}
		}

		$heading_tag = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2';
		$header_cls  = 'center' === $header_align ? ' lre-insights__header--center' : '';
		$filter_cls  = 'center' === $header_align ? ' lre-insights__filter-wrap--center' : '';
		?>
		<section class="lre-insights" id="insights-grid">
			<div class="lre-insights__container">

				<?php if ( $show_header ) : ?>
					<div class="lre-insights__header<?php echo esc_attr( $header_cls ); ?>">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
							<span class="lre-insights__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $settings['heading'] ) ) : ?>
							<<?php echo esc_attr( $heading_tag ); ?> class="lre-insights__heading">
								<?php echo wp_kses_post( $settings['heading'] ); ?>
							</<?php echo esc_attr( $heading_tag ); ?>>
						<?php endif; ?>

						<?php if ( ! empty( $settings['description'] ) ) : ?>
							<p class="lre-insights__desc"><?php echo esc_html( $settings['description'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $show_filter && ! empty( $categories ) ) : ?>
					<div class="lre-insights__filter-wrap<?php echo esc_attr( $filter_cls ); ?>">
						<button type="button" class="lre-insights__filter-btn active" data-filter="*">
							<?php echo esc_html( ! empty( $settings['all_label'] ) ? $settings['all_label'] : __( 'All Intelligence', 'luxury-re-widgets' ) ); ?>
						</button>
						<?php foreach ( $categories as $c_slug => $c_label ) : ?>
							<button type="button" class="lre-insights__filter-btn" data-filter="<?php echo esc_attr( $c_slug ); ?>">
								<?php echo esc_html( $c_label ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $items ) ) : ?>
					<div class="lre-insights__grid">
						<?php foreach ( $items as $index => $item ) :
							$item_slug     = ! empty( $item['category_slug'] ) ? sanitize_title( $item['category_slug'] ) : 'general';
							$item_label    = ! empty( $item['category_label'] ) ? $item['category_label'] : '';
							$item_img      = ! empty( $item['image']['url'] ) ? $item['image']['url'] : ( function_exists( 'lre_asset_url' ) ? lre_asset_url( 'images/property-2.jpg' ) : '' );
							$item_link     = ! empty( $item['link']['url'] ) ? $item['link']['url'] : '#';
							$item_target   = ! empty( $item['link']['is_external'] ) ? ' target="_blank"' : '';
							$item_rel      = ! empty( $item['link']['nofollow'] ) ? ' rel="nofollow"' : '';
							$item_title    = ! empty( $item['title'] ) ? $item['title'] : '';
							$item_date     = ! empty( $item['date'] ) ? $item['date'] : '';
							$item_read     = ! empty( $item['read_time'] ) ? $item['read_time'] : '';
							$item_excerpt  = ! empty( $item['excerpt'] ) ? $item['excerpt'] : '';
							$item_btn_text = $force_consistent ? $default_link_text : ( ! empty( $item['link_text'] ) ? $item['link_text'] : $default_link_text );
						?>
							<article class="lre-insights__card" data-category="<?php echo esc_attr( $item_slug ); ?>">
								<?php if ( $show_image && $item_img ) : ?>
									<div class="lre-insights__card-media">
										<a href="<?php echo esc_url( $item_link ); ?>" class="lre-insights__card-img-link"<?php echo $item_target . $item_rel; ?>>
											<img src="<?php echo esc_url( $item_img ); ?>" alt="<?php echo esc_attr( $item_title ); ?>" loading="lazy">
											<div class="lre-insights__card-overlay"></div>
										</a>
										<?php if ( $show_badge && $item_label ) : ?>
											<span class="lre-insights__card-badge"><?php echo esc_html( $item_label ); ?></span>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<div class="lre-insights__card-body">
									<?php if ( $show_meta && ( $item_date || $item_read ) ) : ?>
										<div class="lre-insights__card-meta">
											<?php if ( $item_date ) : ?>
												<span class="lre-insights__card-date"><?php echo esc_html( $item_date ); ?></span>
											<?php endif; ?>
											<?php if ( $item_date && $item_read ) : ?>
												<span class="lre-insights__card-dot">•</span>
											<?php endif; ?>
											<?php if ( $item_read ) : ?>
												<span class="lre-insights__card-read"><?php echo esc_html( $item_read ); ?></span>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<h4 class="lre-insights__card-title">
										<a href="<?php echo esc_url( $item_link ); ?>"<?php echo $item_target . $item_rel; ?>>
											<?php echo esc_html( $item_title ); ?>
										</a>
									</h4>

									<?php if ( $show_excerpt && $item_excerpt ) : ?>
										<p class="lre-insights__card-excerpt">
											<?php echo esc_html( $item_excerpt ); ?>
										</p>
									<?php endif; ?>

									<?php if ( $show_link ) : ?>
										<div class="lre-insights__card-footer">
											<a href="<?php echo esc_url( $item_link ); ?>" class="lre-insights__read-link"<?php echo $item_target . $item_rel; ?>>
												<span><?php echo esc_html( $item_btn_text ); ?></span>
												<svg class="lre-insights__arrow-sm" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
													<path d="M5 12h14M12 5l7 7-7 7"/>
												</svg>
											</a>
										</div>
									<?php endif; ?>
								</div>
							</article>
						<?php endforeach; ?>
					</div>

					<?php if ( 'posts' === $source_type && 'yes' === $settings['show_pagination'] && isset( $query ) ) : ?>
						<div class="lre-insights__pagination">
							<?php
							echo paginate_links( array(
								'total'     => $query->max_num_pages,
								'current'   => $paged,
								'prev_text' => '&larr; PREVIOUS',
								'next_text' => 'NEXT &rarr;',
							) );
							?>
						</div>
					<?php endif; ?>

				<?php else : ?>
					<div class="lre-insights__empty">
						<p><?php esc_html_e( 'No market intelligence or articles published yet.', 'luxury-re-widgets' ); ?></p>
					</div>
				<?php endif; ?>

				<?php if ( $show_bottom_cta && ! empty( $settings['bottom_cta_text'] ) ) :
					$b_link   = ! empty( $settings['bottom_cta_link']['url'] ) ? $settings['bottom_cta_link']['url'] : home_url( '/insights/' );
					$b_target = ! empty( $settings['bottom_cta_link']['is_external'] ) ? ' target="_blank"' : '';
					$b_rel    = ! empty( $settings['bottom_cta_link']['nofollow'] ) ? ' rel="nofollow"' : '';
					$b_align  = ! empty( $settings['bottom_cta_align'] ) ? $settings['bottom_cta_align'] : 'center';
				?>
					<div class="lre-insights__bottom-action lre-insights__bottom-action--<?php echo esc_attr( $b_align ); ?>">
						<a href="<?php echo esc_url( $b_link ); ?>" class="btn lre-insights__bottom-btn"<?php echo $b_target . $b_rel; ?>>
							<span><?php echo esc_html( $settings['bottom_cta_text'] ); ?></span>
							<svg class="lre-insights__arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
								<path d="M5 12h14M12 5l7 7-7 7"/>
							</svg>
						</a>
					</div>
				<?php endif; ?>

			</div>
		</section>

		<script>
		(function() {
			var section = document.getElementById('insights-grid');
			if (!section) return;
			var buttons = section.querySelectorAll('.lre-insights__filter-btn');
			var cards = section.querySelectorAll('.lre-insights__card');

			buttons.forEach(function(btn) {
				btn.addEventListener('click', function() {
					buttons.forEach(function(b) { b.classList.remove('active'); });
					btn.classList.add('active');
					var filter = btn.getAttribute('data-filter');

					cards.forEach(function(card) {
						if (filter === '*' || card.getAttribute('data-category') === filter) {
							card.style.display = '';
							setTimeout(function() {
								card.style.opacity = '1';
								card.style.transform = 'translateY(0)';
							}, 20);
						} else {
							card.style.opacity = '0';
							card.style.transform = 'translateY(12px)';
							setTimeout(function() {
								card.style.display = 'none';
							}, 220);
						}
					});
				});
			});
		})();
		</script>
		<?php
	}
}
