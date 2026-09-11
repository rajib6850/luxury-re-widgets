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
 * Features an asymmetric editorial table, GPU-accelerated hover image reveals,
 * confidential timeline indexing, and an interactive property dossier modal.
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
				'default'     => __( 'Six confidential entries currently active in our private collection, ordered by acquisition timeline. Hover any row for a discreet first look.', 'luxury-re-widgets' ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- 2. OPTIONAL STATS RIBBON ---
		$this->start_controls_section(
			'section_stats_ribbon',
			array(
				'label' => __( 'Proven Track Record Stats', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_stats',
			array(
				'label'        => __( 'Show Stats Ribbon', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'stat_1_val',
			array(
				'label'     => __( 'Stat 1 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '$49M+',
				'condition' => array( 'show_stats' => 'yes' ),
			)
		);
		$this->add_control(
			'stat_1_lbl',
			array(
				'label'     => __( 'Stat 1 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Career Closed Volume',
				'condition' => array( 'show_stats' => 'yes' ),
			)
		);

		$this->add_control(
			'stat_2_val',
			array(
				'label'     => __( 'Stat 2 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '50+',
				'condition' => array( 'show_stats' => 'yes' ),
			)
		);
		$this->add_control(
			'stat_2_lbl',
			array(
				'label'     => __( 'Stat 2 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Private Sales Closed',
				'condition' => array( 'show_stats' => 'yes' ),
			)
		);

		$this->add_control(
			'stat_3_val',
			array(
				'label'     => __( 'Stat 3 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '14 Days',
				'condition' => array( 'show_stats' => 'yes' ),
			)
		);
		$this->add_control(
			'stat_3_lbl',
			array(
				'label'     => __( 'Stat 3 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Average Market Timeline',
				'condition' => array( 'show_stats' => 'yes' ),
			)
		);

		$this->add_control(
			'stat_4_val',
			array(
				'label'     => __( 'Stat 4 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '100%',
				'condition' => array( 'show_stats' => 'yes' ),
			)
		);
		$this->add_control(
			'stat_4_lbl',
			array(
				'label'     => __( 'Stat 4 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Client Discretion & Trust',
				'condition' => array( 'show_stats' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- 3. FILTER TABS ---
		$this->start_controls_section(
			'section_filters',
			array(
				'label' => __( 'Filter Tabs', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_filters',
			array(
				'label'        => __( 'Show Filter Tabs', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
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

		$this->end_controls_section();

		// --- 4. LEDGER ENTRIES (REPEATER) ---
		$this->start_controls_section(
			'section_ledger_entries',
			array(
				'label' => __( 'The Ledger Entries', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Estate / Property Name', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Villa Serrano', 'luxury-re-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'location',
			array(
				'label'   => __( 'Location / Enclave', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Laguna Beach, California', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'beds_baths',
			array(
				'label'   => __( 'Bedrooms & Baths', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '5 BD • 6 BA', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'sqft',
			array(
				'label'   => __( 'Square Footage', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '6,420 SQFT', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'price',
			array(
				'label'   => __( 'Closed Price / Valuation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '$18,400,000', 'luxury-re-widgets' ),
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
				'default'     => 'coastal',
				'placeholder' => 'e.g. pasadena, modern, coastal',
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Confidential Dossier Summary', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A landmark private estate offering sweeping ocean vistas, bespoke imported stone craftsmanship, and private subterranean wine cellar.', 'luxury-re-widgets' ),
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
						'title'       => 'Villa Serrano',
						'location'    => 'Laguna Beach, California',
						'beds_baths'  => '5 BD • 6 BA',
						'sqft'        => '6,420 SQFT',
						'price'       => '$18,400,000',
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=900&auto=format&fit=crop' ),
						'category'    => 'coastal',
						'description' => 'A landmark private coastal estate offering sweeping ocean vistas, bespoke craftsmanship, and private security detail.',
					),
					array(
						'title'       => 'Casa Bellamare',
						'location'    => 'Positano, Amalfi Coast',
						'beds_baths'  => '4 BD • 5 BA',
						'sqft'        => '4,980 SQFT',
						'price'       => '€14,200,000',
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=900&auto=format&fit=crop' ),
						'category'    => 'historic',
						'description' => 'Cliffside panoramic sanctuary with tiered botanical gardens, heated infinity plunge pool, and private funicular access.',
					),
					array(
						'title'       => 'The Marin Glasshouse',
						'location'    => 'Sausalito, California',
						'beds_baths'  => '3 BD • 4 BA',
						'sqft'        => '3,860 SQFT',
						'price'       => '$9,750,000',
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=900&auto=format&fit=crop' ),
						'category'    => 'modern',
						'description' => 'Mid-century modernist steel and glass masterpiece cantilevered among mature redwoods with views of San Francisco Bay.',
					),
					array(
						'title'       => 'Villa dei Pini',
						'location'    => 'Ravello, Amalfi Coast',
						'beds_baths'  => '6 BD • 7 BA',
						'sqft'        => '7,110 SQFT',
						'price'       => '€21,900,000',
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=900&auto=format&fit=crop' ),
						'category'    => 'historic',
						'description' => 'Centuries-old stone estate restored to modern museum-quality standards with private olive groves and helipad.',
					),
					array(
						'title'       => 'Rancho Quiet Water',
						'location'    => 'Montecito, California',
						'beds_baths'  => '5 BD • 6 BA',
						'sqft'        => '8,240 SQFT',
						'price'       => '$24,600,000',
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?q=80&w=900&auto=format&fit=crop' ),
						'category'    => 'pasadena',
						'description' => 'Sprawling private gated compound featuring equestrian facilities, championship tennis court, and organic orchards.',
					),
					array(
						'title'       => 'Casa Limone',
						'location'    => 'Sorrento, Amalfi Coast',
						'beds_baths'  => '4 BD • 4 BA',
						'sqft'        => '4,120 SQFT',
						'price'       => '€11,300,000',
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?q=80&w=900&auto=format&fit=crop' ),
						'category'    => 'historic',
						'description' => 'Sun-drenched Mediterranean villa overlooking the Bay of Naples, with restored vaulted ceilings and private sea cove.',
					),
				),
			)
		);

		$this->end_controls_section();

		// --- 5. FOOTER CTA ---
		$this->start_controls_section(
			'section_footer_cta',
			array(
				'label' => __( 'Footer Action Button', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_footer',
			array(
				'label'        => __( 'Show Footer Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'cta_text',
			array(
				'label'     => __( 'Button Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Request Complete Archive & Dossier', 'luxury-re-widgets' ),
				'condition' => array( 'show_footer' => 'yes' ),
			)
		);

		$this->add_control(
			'cta_link',
			array(
				'label'       => __( 'Button Link', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://...',
				'default'     => array(
					'url' => '/contact/',
				),
				'condition'   => array( 'show_footer' => 'yes' ),
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
					'{{WRAPPER}} .ledger-section' => 'border-top-color: {{VALUE}}; border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .ledger'        => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .ledger-row'    => 'border-bottom-color: {{VALUE}};',
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

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C9A86A',
				'selectors' => array(
					'{{WRAPPER}} .ledger-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .section-title, {{WRAPPER}} .lre-ledger-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .section-title, {{WRAPPER}} .lre-ledger-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
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
				'label' => __( 'Ledger Rows & Hover States', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
			'row_hover_bg',
			array(
				'label'     => __( 'Row Hover Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.04)',
				'selectors' => array(
					'{{WRAPPER}} .ledger-row:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- 4. SIGNATURE BUTTON STYLE ---
		$this->start_controls_section(
			'style_button',
			array(
				'label' => __( 'Signature Pill Button', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'btn_bg',
			array(
				'label'     => __( 'Button Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .ledger-foot .btn-pill' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_color',
			array(
				'label'     => __( 'Button Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#111111',
				'selectors' => array(
					'{{WRAPPER}} .ledger-foot .btn-pill' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_hover_bg',
			array(
				'label'     => __( 'Button Hover Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F0EDE6',
				'selectors' => array(
					'{{WRAPPER}} .ledger-foot .btn-pill:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$show_header  = ! empty( $settings['show_header'] ) && 'yes' === $settings['show_header'];
		$eyebrow      = ! empty( $settings['eyebrow'] ) ? $settings['eyebrow'] : '';
		$title        = ! empty( $settings['title'] ) ? $settings['title'] : 'The Private Ledger';
		$title_tag    = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
		$subtitle     = ! empty( $settings['subtitle'] ) ? $settings['subtitle'] : '';

		$show_stats   = ! empty( $settings['show_stats'] ) && 'yes' === $settings['show_stats'];
		$show_filters = ! empty( $settings['show_filters'] ) && 'yes' === $settings['show_filters'];
		$show_footer  = ! empty( $settings['show_footer'] ) && 'yes' === $settings['show_footer'];

		$ledger_items = ! empty( $settings['ledger_items'] ) ? $settings['ledger_items'] : array();

		// Collect unique categories if filters enabled
		$categories = array();
		if ( $show_filters && ! empty( $ledger_items ) ) {
			foreach ( $ledger_items as $item ) {
				if ( ! empty( $item['category'] ) ) {
					$cat_slug = sanitize_title( $item['category'] );
					$cat_name = ucwords( str_replace( array( '-', '_' ), ' ', $cat_slug ) );
					$categories[ $cat_slug ] = $cat_name;
				}
			}
		}

		$cta_text = ! empty( $settings['cta_text'] ) ? $settings['cta_text'] : __( 'Request Complete Archive & Dossier', 'luxury-re-widgets' );
		$cta_url  = ! empty( $settings['cta_link']['url'] ) ? $settings['cta_link']['url'] : '/contact/';
		$cta_target = ! empty( $settings['cta_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : '';

		$section_id = 'ledger-' . $this->get_id();
		?>
		<section class="ledger-section lre-ledger-section" id="<?php echo esc_attr( $section_id ); ?>">
			<div class="container lre-ledger-container">

				<?php if ( $show_header ) : ?>
					<div class="ledger-head">
						<div>
							<?php if ( ! empty( $eyebrow ) ) : ?>
								<div class="ledger-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
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

				<?php if ( $show_stats ) : ?>
					<div class="lre-ledger-stats">
						<div class="lre-ledger-stat-item">
							<div class="lre-ledger-stat-val"><?php echo esc_html( $settings['stat_1_val'] ); ?></div>
							<div class="lre-ledger-stat-lbl"><?php echo esc_html( $settings['stat_1_lbl'] ); ?></div>
						</div>
						<div class="lre-ledger-stat-item">
							<div class="lre-ledger-stat-val"><?php echo esc_html( $settings['stat_2_val'] ); ?></div>
							<div class="lre-ledger-stat-lbl"><?php echo esc_html( $settings['stat_2_lbl'] ); ?></div>
						</div>
						<div class="lre-ledger-stat-item">
							<div class="lre-ledger-stat-val"><?php echo esc_html( $settings['stat_3_val'] ); ?></div>
							<div class="lre-ledger-stat-lbl"><?php echo esc_html( $settings['stat_3_lbl'] ); ?></div>
						</div>
						<div class="lre-ledger-stat-item">
							<div class="lre-ledger-stat-val"><?php echo esc_html( $settings['stat_4_val'] ); ?></div>
							<div class="lre-ledger-stat-lbl"><?php echo esc_html( $settings['stat_4_lbl'] ); ?></div>
						</div>
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
					if ( ! empty( $ledger_items ) ) :
						foreach ( $ledger_items as $index => $item ) :
							$num_str  = sprintf( '%03d', $index + 1 );
							$i_title  = ! empty( $item['title'] ) ? $item['title'] : 'Confidential Estate';
							$i_loc    = ! empty( $item['location'] ) ? $item['location'] : 'Pasadena, California';
							$i_beds   = ! empty( $item['beds_baths'] ) ? $item['beds_baths'] : '4 BD • 5 BA';
							$i_sqft   = ! empty( $item['sqft'] ) ? $item['sqft'] : '5,200 SQFT';
							$i_price  = ! empty( $item['price'] ) ? $item['price'] : 'Confidential';
							$i_cat    = ! empty( $item['category'] ) ? sanitize_title( $item['category'] ) : '';
							$i_desc   = ! empty( $item['description'] ) ? $item['description'] : '';
							$i_img    = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';
							?>
							<div class="ledger-row lre-ledger-row trigger-prop-modal"
								data-category="<?php echo esc_attr( $i_cat ); ?>"
								data-title="<?php echo esc_attr( $i_title ); ?>"
								data-price="<?php echo esc_attr( $i_price ); ?>"
								data-location="<?php echo esc_attr( $i_loc ); ?>"
								data-specs="<?php echo esc_attr( $i_beds . ' • ' . $i_sqft ); ?>"
								data-desc="<?php echo esc_attr( $i_desc ); ?>"
								data-img="<?php echo esc_url( $i_img ); ?>"
								tabindex="0"
								role="button"
								aria-label="<?php echo esc_attr( sprintf( __( 'View dossier for %s, closed at %s', 'luxury-re-widgets' ), $i_title, $i_price ) ); ?>">

								<span class="num"><?php echo esc_html( $num_str ); ?></span>

								<span class="name">
									<?php echo esc_html( $i_title ); ?>
									<small><?php echo esc_html( $i_loc ); ?></small>
								</span>

								<span class="meta"><?php echo esc_html( $i_beds ); ?></span>
								<span class="meta"><?php echo esc_html( $i_sqft ); ?></span>
								<span class="price"><?php echo esc_html( $i_price ); ?></span>

								<span class="ledger-arrow">
									<span class="btn-circle-icon" aria-hidden="true">
										<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
											<line x1="7" y1="17" x2="17" y2="7"></line>
											<polyline points="7 7 17 7 17 17"></polyline>
										</svg>
									</span>
								</span>

								<?php if ( ! empty( $i_img ) ) : ?>
									<div class="ledger-thumb" aria-hidden="true">
										<img src="<?php echo esc_url( $i_img ); ?>" alt="<?php echo esc_attr( $i_title ); ?>" loading="lazy" />
									</div>
									<div class="ledger-mobile-thumb" aria-hidden="true">
										<img src="<?php echo esc_url( $i_img ); ?>" alt="<?php echo esc_attr( $i_title ); ?>" loading="lazy" />
									</div>
								<?php endif; ?>

							</div>
							<?php
						endforeach;
					endif;
					?>
				</div>

				<?php if ( $show_footer ) : ?>
					<div class="ledger-foot">
						<a href="<?php echo esc_url( $cta_url ); ?>" class="btn-pill btn-pill-light"<?php echo $cta_target; ?>>
							<span><?php echo esc_html( $cta_text ); ?></span>
							<span class="btn-circle-icon" aria-hidden="true">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
									<line x1="7" y1="17" x2="17" y2="7"></line>
									<polyline points="7 7 17 7 17 17"></polyline>
								</svg>
							</span>
						</a>
					</div>
				<?php endif; ?>

			</div>

			<!-- Built-in Property Quick Detail Modal (Dialog) -->
			<dialog id="property-modal" class="custom-modal lre-ledger-modal" aria-labelledby="prop-modal-title">
				<div class="modal-card lre-ledger-modal-card">
					<button id="close-prop-modal" class="modal-close-btn lre-ledger-modal-close" aria-label="<?php esc_attr_e( 'Close dossier dialog', 'luxury-re-widgets' ); ?>">✕</button>
					<div class="lre-ledger-modal-img-wrap">
						<img id="prop-modal-img" src="" alt="<?php esc_attr_e( 'Property Preview', 'luxury-re-widgets' ); ?>" />
					</div>
					<div class="modal-header lre-ledger-modal-header">
						<h3 id="prop-modal-title"><?php esc_html_e( 'Property Title', 'luxury-re-widgets' ); ?></h3>
						<div id="prop-modal-location" class="lre-ledger-modal-location"><?php esc_html_e( 'Location', 'luxury-re-widgets' ); ?></div>
						<div id="prop-modal-price" class="lre-ledger-modal-price"><?php esc_html_e( 'Price', 'luxury-re-widgets' ); ?></div>
						<div id="prop-modal-specs" class="lre-ledger-modal-specs"><?php esc_html_e( 'Specs', 'luxury-re-widgets' ); ?></div>
						<p id="prop-modal-desc" class="lre-ledger-modal-desc">
							<?php esc_html_e( 'Confidential estate transaction and representation details.', 'luxury-re-widgets' ); ?>
						</p>
					</div>
					<div class="lre-ledger-modal-actions">
						<a href="<?php echo esc_url( $cta_url ); ?>" class="btn-pill btn-pill-light" style="width:100%; justify-content:center;">
							<span><?php esc_html_e( 'Inquire Regarding Similar Acquisitions', 'luxury-re-widgets' ); ?></span>
							<span class="btn-circle-icon" aria-hidden="true">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
									<line x1="7" y1="17" x2="17" y2="7"></line>
									<polyline points="7 7 17 7 17 17"></polyline>
								</svg>
							</span>
						</a>
					</div>
				</div>
			</dialog>
		</section>
		<?php
	}
}
