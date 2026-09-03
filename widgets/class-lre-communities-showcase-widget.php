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
 * LRE_Communities_Showcase_Widget
 * Ultra-Luxury Communities & Neighborhoods Showcase for dedicated Communities page.
 * Features an asymmetrical Bento Spotlight hero card, live lifestyle filtering,
 * instant live search, market metrics strip, and 100% typography heading parity.
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
		return array( 'communities', 'showcase', 'neighborhoods', 'enclaves', 'luxury', 'bento', 'filter', 'explorer' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION 1: HEADER & TYPOGRAPHY ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Curated Enclaves',
				'placeholder' => __( 'e.g. Curated Enclaves', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading (Multi-line / Title Mask)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "Signature Communities &<br>Exclusive Neighborhoods",
				'description' => __( 'Supports <br> tags for smooth title-mask reveal animation lines.', 'luxury-re-widgets' ),
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
				'label'       => __( 'Editorial Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => 'Explore the pinnacle of Southern California living. From secluded hillside estates to oceanfront masterworks, our curated enclave portfolio offers unparalleled access to the world’s most coveted addresses.',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: METRICS STRIP ──
		$this->start_controls_section(
			'section_metrics',
			array(
				'label' => __( 'Market Metrics Strip', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_metrics',
			array(
				'label'        => __( 'Display Metrics Strip', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'metric1_val',
			array(
				'label'     => __( 'Metric 1 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '8+',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);
		$this->add_control(
			'metric1_lbl',
			array(
				'label'     => __( 'Metric 1 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Curated Enclaves',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);
		$this->add_control(
			'metric1_sub',
			array(
				'label'     => __( 'Metric 1 Subtext', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Prime Southern California',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);

		$this->add_control(
			'metric2_val',
			array(
				'label'     => __( 'Metric 2 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '$2.4B+',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);
		$this->add_control(
			'metric2_lbl',
			array(
				'label'     => __( 'Metric 2 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Portfolio Under Advisory',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);
		$this->add_control(
			'metric2_sub',
			array(
				'label'     => __( 'Metric 2 Subtext', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Public & Off-Market Holdings',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);

		$this->add_control(
			'metric3_val',
			array(
				'label'     => __( 'Metric 3 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '100%',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);
		$this->add_control(
			'metric3_lbl',
			array(
				'label'     => __( 'Metric 3 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Discretion & Security',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);
		$this->add_control(
			'metric3_sub',
			array(
				'label'     => __( 'Metric 3 Subtext', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Private Guarded Sanctuaries',
				'condition' => array( 'show_metrics' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: FILTER & SEARCH ──
		$this->start_controls_section(
			'section_filter_search',
			array(
				'label' => __( 'Filter & Search Bar', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_filters',
			array(
				'label'        => __( 'Display Category Filters', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_search',
			array(
				'label'        => __( 'Display Live Enclave Search', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'search_placeholder',
			array(
				'label'     => __( 'Search Placeholder', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Search enclaves by name or lifestyle...',
				'condition' => array( 'show_search' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 4: COMMUNITIES REPEATER ──
		$this->start_controls_section(
			'section_communities',
			array(
				'label' => __( 'Communities Directory', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			array(
				'label'       => __( 'Enclave Name', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Bel Air',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'is_featured',
			array(
				'label'        => __( 'Featured Spotlight (Hero Bento Card)', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'description'  => __( 'If enabled, renders as a prominent, cinematic 16:9 hero card with extended stats and editorial synopsis.', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'category',
			array(
				'label'       => __( 'Category Slug (for filter)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'foothills',
				'description' => __( 'Used for matching filter buttons (e.g. foothills, coastal, architectural, country).', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'category_label',
			array(
				'label'       => __( 'Category Badge Display', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Private Foothills',
			)
		);

		$repeater->add_control(
			'badge',
			array(
				'label'       => __( 'Luxury Pill Badge (Optional)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Flagship Enclave',
				'placeholder' => 'e.g. Flagship Enclave, Premier Waterfront',
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Enclave Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1600&q=85',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'tagline',
			array(
				'label'       => __( 'Tagline / Synopsis', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => 'The crown jewel of the Platinum Triangle. Historic gated estates, legendary acreage, and unparalleled privacy.',
			)
		);

		$repeater->add_control(
			'price_range',
			array(
				'label'   => __( 'Price Guide', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$18M – $85M+',
			)
		);

		$repeater->add_control(
			'active_count',
			array(
				'label'   => __( 'Active Portfolio Count', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '16 Estates Available',
			)
		);

		$repeater->add_control(
			'lifestyle_tags',
			array(
				'label'       => __( 'Lifestyle Tags', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Guard-Gated • Landmark Acreage',
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
			'link_text',
			array(
				'label'   => __( 'Action Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Explore Enclave',
			)
		);

		$this->add_control(
			'communities',
			array(
				'label'       => __( 'Enclaves List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'name'           => 'Bel Air',
						'is_featured'    => 'yes',
						'category'       => 'foothills',
						'category_label' => 'Private Foothills',
						'badge'          => 'Flagship Enclave',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1600&q=85' ),
						'tagline'        => 'The pinnacle of the Platinum Triangle. Legendary acreage, world-class guard-gated privacy, and historic architectural pedigree dating back over a century.',
						'price_range'    => '$18M – $85M+',
						'active_count'   => '16 Estates Available',
						'lifestyle_tags' => 'Guard-Gated • Secluded Acreage • City Panoramas',
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Bel Air Estates',
					),
					array(
						'name'           => 'Beverly Hills',
						'is_featured'    => 'no',
						'category'       => 'foothills',
						'category_label' => 'Private Foothills',
						'badge'          => 'Billionaires Row',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85' ),
						'tagline'        => 'World-renowned prestige, manicured palm-lined drives, and palatial architectural landmarks in the iconic 90210.',
						'price_range'    => '$15M – $95M+',
						'active_count'   => '22 Estates Available',
						'lifestyle_tags' => 'Iconic Glamour • Prime Flats • Estate Corridors',
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Beverly Hills',
					),
					array(
						'name'           => 'Malibu Colony',
						'is_featured'    => 'no',
						'category'       => 'coastal',
						'category_label' => 'Coastal Sanctuary',
						'badge'          => 'Premier Waterfront',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1200&q=85' ),
						'tagline'        => 'Private gated beachfront enclaves offering barefoot luxury, crashing surf, and panoramic Pacific sunsets.',
						'price_range'    => '$12M – $65M+',
						'active_count'   => '14 Estates Available',
						'lifestyle_tags' => 'Direct Beach Access • Oceanfront • Gated Security',
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Malibu',
					),
					array(
						'name'           => 'Pacific Palisades',
						'is_featured'    => 'no',
						'category'       => 'coastal',
						'category_label' => 'Coastal Sanctuary',
						'badge'          => 'Ocean Bluff Living',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=1200&q=85' ),
						'tagline'        => 'Dramatic ocean bluffs, pristine coastal air, and refined architectural estates nestled between mountains and sea.',
						'price_range'    => '$8M – $45M+',
						'active_count'   => '19 Estates Available',
						'lifestyle_tags' => 'Ocean Views • Coastal Bluffs • Serene Living',
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Palisades',
					),
					array(
						'name'           => 'Trousdale Estates',
						'is_featured'    => 'no',
						'category'       => 'architectural',
						'category_label' => 'Architectural Corridors',
						'badge'          => 'Mid-Century Legend',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85' ),
						'tagline'        => 'An extraordinary preserve of mid-century modern masterpieces perched above Beverly Hills with jetliner city-to-ocean views.',
						'price_range'    => '$10M – $55M+',
						'active_count'   => '11 Estates Available',
						'lifestyle_tags' => 'Jetliner Views • Modernist Pedigree • Iconic Design',
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Trousdale',
					),
					array(
						'name'           => 'Brentwood Park',
						'is_featured'    => 'no',
						'category'       => 'country',
						'category_label' => 'Country & Solitude',
						'badge'          => 'Sycamore Solitude',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=1200&q=85' ),
						'tagline'        => 'Stately sycamore canopies, sprawling private compounds, and timeless equestrian estates offering rural calm moments from Westside culture.',
						'price_range'    => '$7M – $35M+',
						'active_count'   => '15 Estates Available',
						'lifestyle_tags' => 'Tree-Lined Privacy • Estate Compounds • Suburban Calm',
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Brentwood',
					),
				),
				'title_field' => '{{{ name }}} ({{{ category_label }}}) {{{ is_featured == "yes" ? "★ SPOTLIGHT" : "" }}}',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: SECTION ──
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
				'default'   => '#08080c',
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase' => 'background-color: {{VALUE}} !important;',
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
					'top'      => '120',
					'right'    => '20',
					'bottom'   => '120',
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

		// ── STYLE: TYPOGRAPHY & HEADER ──
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Typography & Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase__eyebrow-text' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-comm-showcase__eyebrow-bar'  => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Heading Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase__title, {{WRAPPER}} .lre-comm-showcase__title .title-mask > span, {{WRAPPER}} .lre-comm-showcase__title span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .lre-comm-showcase__title',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.7)',
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase__description' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: ENCLAVE CARDS ──
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Cards & Micro-Interactions', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.12)',
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-card' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'card_hover_border_color',
			array(
				'label'     => __( 'Card Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(197, 160, 71, 0.65)',
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-card:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag      = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $tag : 'h2';

		// Collect unique categories for filter tabs
		$categories = array();
		if ( ! empty( $settings['communities'] ) ) {
			foreach ( $settings['communities'] as $c ) {
				$cat_slug = sanitize_title( $c['category'] ?? '' );
				$cat_lbl  = ! empty( $c['category_label'] ) ? $c['category_label'] : ucfirst( $cat_slug );
				if ( ! empty( $cat_slug ) && ! isset( $categories[ $cat_slug ] ) ) {
					$categories[ $cat_slug ] = $cat_lbl;
				}
			}
		}

		// Separate featured spotlight from regular cards
		$featured_item = null;
		$regular_items = array();

		if ( ! empty( $settings['communities'] ) ) {
			foreach ( $settings['communities'] as $item ) {
				if ( ! $featured_item && ( $item['is_featured'] ?? '' ) === 'yes' ) {
					$featured_item = $item;
				} else {
					$regular_items[] = $item;
				}
			}
		}
		?>
		<section class="lre-comm-showcase" id="communities-showcase" aria-label="<?php esc_attr_e( 'Luxury Communities Directory', 'luxury-re-widgets' ); ?>">
			<div class="lre-comm-showcase__container">

				<!-- ── 1. HEADER SECTION (with title-mask typography) ── -->
				<header class="lre-comm-showcase__header reveal">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<div class="lre-comm-showcase__eyebrow">
						<span class="lre-comm-showcase__eyebrow-bar" aria-hidden="true"></span>
						<span class="lre-comm-showcase__eyebrow-text"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						<span class="lre-comm-showcase__eyebrow-bar" aria-hidden="true"></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-comm-showcase__title">
						<?php
						$heading_raw   = $settings['heading'] ?? "Signature Communities &<br>Exclusive Neighborhoods";
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

					<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="lre-comm-showcase__description">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
					<?php endif; ?>
				</header>

				<!-- ── 2. METRICS STRIP (Frosted Architectural Bar) ── -->
				<?php if ( ( $settings['show_metrics'] ?? '' ) === 'yes' ) : ?>
				<div class="lre-comm-showcase__metrics reveal">
					<div class="lre-comm-showcase__metric-card">
						<span class="lre-comm-showcase__metric-val"><?php echo esc_html( $settings['metric1_val'] ?? '8+' ); ?></span>
						<span class="lre-comm-showcase__metric-lbl"><?php echo esc_html( $settings['metric1_lbl'] ?? 'Curated Enclaves' ); ?></span>
						<span class="lre-comm-showcase__metric-sub"><?php echo esc_html( $settings['metric1_sub'] ?? 'Prime Southern California' ); ?></span>
					</div>
					<div class="lre-comm-showcase__metric-sep" aria-hidden="true"></div>
					<div class="lre-comm-showcase__metric-card">
						<span class="lre-comm-showcase__metric-val"><?php echo esc_html( $settings['metric2_val'] ?? '$2.4B+' ); ?></span>
						<span class="lre-comm-showcase__metric-lbl"><?php echo esc_html( $settings['metric2_lbl'] ?? 'Portfolio Value' ); ?></span>
						<span class="lre-comm-showcase__metric-sub"><?php echo esc_html( $settings['metric2_sub'] ?? 'Public & Private Portfolios' ); ?></span>
					</div>
					<div class="lre-comm-showcase__metric-sep" aria-hidden="true"></div>
					<div class="lre-comm-showcase__metric-card">
						<span class="lre-comm-showcase__metric-val"><?php echo esc_html( $settings['metric3_val'] ?? '100%' ); ?></span>
						<span class="lre-comm-showcase__metric-lbl"><?php echo esc_html( $settings['metric3_lbl'] ?? 'Discretion' ); ?></span>
						<span class="lre-comm-showcase__metric-sub"><?php echo esc_html( $settings['metric3_sub'] ?? 'Guard-Gated Security' ); ?></span>
					</div>
				</div>
				<?php endif; ?>

				<!-- ── 3. FILTER & SEARCH CONTROLS ── -->
				<?php
				$show_filters = ( $settings['show_filters'] ?? '' ) === 'yes';
				$show_search  = ( $settings['show_search'] ?? '' ) === 'yes';
				if ( $show_filters || $show_search ) :
				?>
				<div class="lre-comm-showcase__toolbar reveal">
					<?php if ( $show_filters && ! empty( $categories ) ) : ?>
					<nav class="lre-comm-showcase__filters" aria-label="<?php esc_attr_e( 'Filter communities by lifestyle', 'luxury-re-widgets' ); ?>">
						<button type="button" class="lre-comm-filter-btn is-active" data-filter="all">
							<span><?php esc_html_e( 'All Enclaves', 'luxury-re-widgets' ); ?></span>
						</button>
						<?php foreach ( $categories as $c_slug => $c_label ) : ?>
						<button type="button" class="lre-comm-filter-btn" data-filter="<?php echo esc_attr( $c_slug ); ?>">
							<span><?php echo esc_html( $c_label ); ?></span>
						</button>
						<?php endforeach; ?>
					</nav>
					<?php endif; ?>

					<?php if ( $show_search ) : ?>
					<div class="lre-comm-showcase__search-wrap">
						<svg class="lre-comm-showcase__search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>
						<input type="search"
						       class="lre-comm-showcase__search-input"
						       placeholder="<?php echo esc_attr( $settings['search_placeholder'] ?? 'Search enclaves...' ); ?>"
						       aria-label="<?php esc_attr_e( 'Search enclaves by name or lifestyle', 'luxury-re-widgets' ); ?>">
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<!-- ── 4. ASYMMETRICAL BENTO SPOTLIGHT HERO CARD ── -->
				<?php if ( $featured_item ) :
					$feat_cat_slug   = sanitize_title( $featured_item['category'] ?? '' );
					$feat_img_url    = ! empty( $featured_item['image']['url'] ) ? $featured_item['image']['url'] : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1600&q=85';
					$feat_url        = ! empty( $featured_item['link']['url'] ) ? esc_url( $featured_item['link']['url'] ) : '#contact';
					$feat_target     = ! empty( $featured_item['link']['is_external'] ) ? '_blank' : '_self';
					$feat_search_txt = strtolower( ( $featured_item['name'] ?? '' ) . ' ' . ( $featured_item['tagline'] ?? '' ) . ' ' . ( $featured_item['lifestyle_tags'] ?? '' ) );
				?>
				<div class="lre-comm-spotlight-wrap reveal" data-category="<?php echo esc_attr( $feat_cat_slug ); ?>" data-search="<?php echo esc_attr( $feat_search_txt ); ?>">
					<article class="lre-comm-spotlight">
						<div class="lre-comm-spotlight__media">
							<img src="<?php echo esc_url( $feat_img_url ); ?>"
							     alt="<?php echo esc_attr( $featured_item['name'] ); ?>"
							     class="lre-comm-spotlight__img"
							     loading="lazy" width="1600" height="900">
							<div class="lre-comm-spotlight__overlay"></div>
						</div>

						<div class="lre-comm-spotlight__content">
							<div class="lre-comm-spotlight__top-meta">
								<?php if ( ! empty( $featured_item['badge'] ) ) : ?>
								<span class="lre-comm-pill lre-comm-pill--gold">
									<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
									<?php echo esc_html( $featured_item['badge'] ); ?>
								</span>
								<?php endif; ?>

								<?php if ( ! empty( $featured_item['category_label'] ) ) : ?>
								<span class="lre-comm-pill lre-comm-pill--glass">
									<?php echo esc_html( $featured_item['category_label'] ); ?>
								</span>
								<?php endif; ?>
							</div>

							<h3 class="lre-comm-spotlight__name"><?php echo esc_html( $featured_item['name'] ); ?></h3>

							<?php if ( ! empty( $featured_item['tagline'] ) ) : ?>
							<p class="lre-comm-spotlight__tagline"><?php echo esc_html( $featured_item['tagline'] ); ?></p>
							<?php endif; ?>

							<!-- Live Stats Glass Bar inside Spotlight -->
							<div class="lre-comm-spotlight__stats">
								<?php if ( ! empty( $featured_item['price_range'] ) ) : ?>
								<div class="lre-comm-spotlight__stat">
									<span class="lre-comm-spotlight__stat-lbl"><?php esc_html_e( 'Price Range', 'luxury-re-widgets' ); ?></span>
									<span class="lre-comm-spotlight__stat-val"><?php echo esc_html( $featured_item['price_range'] ); ?></span>
								</div>
								<?php endif; ?>

								<?php if ( ! empty( $featured_item['active_count'] ) ) : ?>
								<div class="lre-comm-spotlight__stat">
									<span class="lre-comm-spotlight__stat-lbl"><?php esc_html_e( 'Active Portfolio', 'luxury-re-widgets' ); ?></span>
									<span class="lre-comm-spotlight__stat-val"><?php echo esc_html( $featured_item['active_count'] ); ?></span>
								</div>
								<?php endif; ?>

								<?php if ( ! empty( $featured_item['lifestyle_tags'] ) ) : ?>
								<div class="lre-comm-spotlight__stat lre-comm-spotlight__stat--lifestyle">
									<span class="lre-comm-spotlight__stat-lbl"><?php esc_html_e( 'Lifestyle Highlights', 'luxury-re-widgets' ); ?></span>
									<span class="lre-comm-spotlight__stat-val"><?php echo esc_html( $featured_item['lifestyle_tags'] ); ?></span>
								</div>
								<?php endif; ?>
							</div>

							<div class="lre-comm-spotlight__action">
								<a href="<?php echo esc_url( $feat_url ); ?>" target="<?php echo esc_attr( $feat_target ); ?>" class="btn btn--outline-white lre-comm-spotlight__btn">
									<span><?php echo esc_html( $featured_item['link_text'] ?? 'Explore Enclave' ); ?></span>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
								</a>
							</div>
						</div>
					</article>
				</div>
				<?php endif; ?>

				<!-- ── 5. CURATED ENCLAVE COLLECTION GRID ── -->
				<div class="lre-comm-grid" id="lre-comm-grid">
					<?php
					if ( ! empty( $regular_items ) ) :
						foreach ( $regular_items as $c_idx => $c ) :
							$cat_slug   = sanitize_title( $c['category'] ?? '' );
							$img_url    = ! empty( $c['image']['url'] ) ? $c['image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85';
							$link_url   = ! empty( $c['link']['url'] ) ? esc_url( $c['link']['url'] ) : '#contact';
							$target     = ! empty( $c['link']['is_external'] ) ? '_blank' : '_self';
							$search_txt = strtolower( ( $c['name'] ?? '' ) . ' ' . ( $c['tagline'] ?? '' ) . ' ' . ( $c['lifestyle_tags'] ?? '' ) );
					?>
					<article class="lre-comm-card reveal"
					         data-category="<?php echo esc_attr( $cat_slug ); ?>"
					         data-search="<?php echo esc_attr( $search_txt ); ?>">
						<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $target ); ?>" class="lre-comm-card__link">
							<div class="lre-comm-card__media">
								<img src="<?php echo esc_url( $img_url ); ?>"
								     alt="<?php echo esc_attr( $c['name'] ); ?>"
								     class="lre-comm-card__img"
								     loading="lazy" width="800" height="1000">
								<div class="lre-comm-card__gradient"></div>
							</div>

							<!-- Floating Top Badges -->
							<div class="lre-comm-card__top">
								<?php if ( ! empty( $c['category_label'] ) ) : ?>
								<span class="lre-comm-pill lre-comm-pill--glass">
									<?php echo esc_html( $c['category_label'] ); ?>
								</span>
								<?php endif; ?>

								<?php if ( ! empty( $c['badge'] ) ) : ?>
								<span class="lre-comm-pill lre-comm-pill--gold">
									<?php echo esc_html( $c['badge'] ); ?>
								</span>
								<?php endif; ?>
							</div>

							<!-- Bottom Content Info -->
							<div class="lre-comm-card__bottom">
								<div class="lre-comm-card__meta">
									<?php if ( ! empty( $c['price_range'] ) ) : ?>
									<span class="lre-comm-card__price"><?php echo esc_html( $c['price_range'] ); ?></span>
									<?php endif; ?>
									<?php if ( ! empty( $c['active_count'] ) ) : ?>
									<span class="lre-comm-card__count"><?php echo esc_html( $c['active_count'] ); ?></span>
									<?php endif; ?>
								</div>

								<h3 class="lre-comm-card__title"><?php echo esc_html( $c['name'] ); ?></h3>

								<?php if ( ! empty( $c['tagline'] ) ) : ?>
								<p class="lre-comm-card__desc"><?php echo esc_html( $c['tagline'] ); ?></p>
								<?php endif; ?>

								<div class="lre-comm-card__footer">
									<span class="lre-comm-card__cta-text"><?php echo esc_html( $c['link_text'] ?? 'Explore Enclave' ); ?></span>
									<div class="lre-comm-card__arrow-circle" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
									</div>
								</div>
							</div>
						</a>
					</article>
					<?php endforeach; endif; ?>
				</div>

				<!-- No Results State for Search / Filter -->
				<div class="lre-comm-no-results" id="lre-comm-no-results" style="display: none;">
					<p class="lre-comm-no-results__text"><?php esc_html_e( 'No luxury enclaves found matching your criteria.', 'luxury-re-widgets' ); ?></p>
					<button type="button" class="btn btn--outline-white lre-comm-reset-btn" id="lre-comm-reset-btn">
						<span><?php esc_html_e( 'Reset Filters', 'luxury-re-widgets' ); ?></span>
					</button>
				</div>

			</div>
		</section>
		<?php
	}
}
