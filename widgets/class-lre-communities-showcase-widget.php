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

		// ── SECTION 1: HEADER & TYPOGRAPHY ──
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

		// ── SECTION 2: MINIMAL FILTER BAR ──
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

		// ── SECTION 3: COMMUNITIES REPEATER ──
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
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1600&q=85',
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
			'link_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Explore Enclave',
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
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1600&q=85' ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '02',
						'name'           => 'Beverly Hills',
						'category'       => 'foothills',
						'category_label' => 'Foothills',
						'tagline'        => 'Historic Manors & Palm-Lined Grandeur',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85' ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '03',
						'name'           => 'Malibu Colony',
						'category'       => 'coastal',
						'category_label' => 'Coastal',
						'tagline'        => 'Barefoot Splendor & Pacific Waterfront',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1200&q=85' ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '04',
						'name'           => 'Pacific Palisades',
						'category'       => 'coastal',
						'category_label' => 'Coastal',
						'tagline'        => 'Dramatic Ocean Bluffs & Coastal Solitude',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=1200&q=85' ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '05',
						'name'           => 'Trousdale Estates',
						'category'       => 'architectural',
						'category_label' => 'Architectural',
						'tagline'        => 'Mid-Century Modernist Masterpieces',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85' ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
					array(
						'index_num'      => '06',
						'name'           => 'Brentwood Park',
						'category'       => 'country',
						'category_label' => 'Country',
						'tagline'        => 'Sycamore Compounds & Timeless Calm',
						'image'          => array( 'url' => 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=1200&q=85' ),
						'link'           => array( 'url' => '#contact' ),
						'link_text'      => 'Explore Enclave',
					),
				),
				'title_field' => '{{{ index_num }}} — {{{ name }}} ({{{ category_label }}})',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: SECTION & CANVAS ──
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

		// ── STYLE: TYPOGRAPHY & HEADER ──
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Typography & Colors', 'luxury-re-widgets' ),
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
					'{{WRAPPER}} .lre-comm-showcase__eyebrow' => 'color: {{VALUE}} !important;',
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

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.65)',
				'selectors' => array(
					'{{WRAPPER}} .lre-comm-showcase__description' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag      = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $tag : 'h2';

		// Collect unique categories for minimal filter tabs
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

		$show_filters = ( $settings['show_filters'] ?? '' ) === 'yes' && ! empty( $categories );
		?>
		<section class="lre-comm-showcase" id="communities-showcase" aria-label="<?php esc_attr_e( 'Featured Communities', 'luxury-re-widgets' ); ?>">
			<div class="lre-comm-showcase__container">

				<!-- ── SECTION HEADER (Matches H2 section titles across plugin) ── -->
				<header class="lre-comm-showcase__header reveal">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<span class="section-label lre-comm-showcase__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
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
							<span class="title-mask"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="lre-comm-showcase__description">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
					<?php endif; ?>
				</header>

				<!-- ── MINIMAL EDITORIAL FILTER TABS ── -->
				<?php if ( $show_filters ) : ?>
				<nav class="lre-comm-showcase__filter-nav reveal" aria-label="<?php esc_attr_e( 'Filter communities', 'luxury-re-widgets' ); ?>">
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

				<!-- ── MINIMALIST ARCHITECTURAL GALLERY GRID ── -->
				<div class="lre-comm-gallery" id="lre-comm-gallery">
					<?php
					if ( ! empty( $settings['communities'] ) ) :
						foreach ( $settings['communities'] as $c_idx => $c ) :
							$cat_slug  = sanitize_title( $c['category'] ?? '' );
							$img_url   = ! empty( $c['image']['url'] ) ? $c['image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85';
							$link_url  = ! empty( $c['link']['url'] ) ? esc_url( $c['link']['url'] ) : '#contact';
							$target    = ! empty( $c['link']['is_external'] ) ? '_blank' : '_self';
							$index_num = ! empty( $c['index_num'] ) ? $c['index_num'] : sprintf( '%02d', $c_idx + 1 );
					?>
					<article class="lre-comm-frame reveal" data-category="<?php echo esc_attr( $cat_slug ); ?>">
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

								<div class="lre-comm-frame__action">
									<span class="lre-comm-frame__action-text"><?php echo esc_html( $c['link_text'] ?? 'Explore Enclave' ); ?></span>
									<span class="lre-comm-frame__action-line" aria-hidden="true"></span>
									<svg class="lre-comm-frame__action-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</div>
							</div>
						</a>
					</article>
					<?php endforeach; endif; ?>
				</div>

			</div>
		</section>
		<?php
	}
}
