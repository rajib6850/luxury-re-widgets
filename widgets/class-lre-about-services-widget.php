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
 * LRE_About_Services_Widget
 * Ultra-luxury comprehensive multi-pillar advisory & services showcase for the About page.
 * Features the signature "Architectural Monolith" expanding panels, dual-axis watermark parallax,
 * editorial grayscale transitions, and global luxury button system.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_About_Services_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_about_services';
	}

	public function get_title() {
		return __( 'LRE — Comprehensive Advisory & Services', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-apps';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'services', 'advisory', 'pillars', 'about', 'luxury', 'capabilities', 'monolith', 'accordion' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── 1. SECTION HEADER & WATERMARK ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header & Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Watermark Text', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'       => __( 'Watermark Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'SERVICES',
				'condition'   => array( 'show_watermark' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Bespoke Advisory Capabilities',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Main Headline', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "Comprehensive Practice.\n<span class=\"lre-title-accent\">Singular Focus.</span>",
				'description' => __( 'Separate lines with newlines. Wrap text with &lt;span class="lre-title-accent"&gt; for animated gold sweep.', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'From confidential estate acquisitions to international portfolio restructuring, our advisory practice combines private banking discretion with unmatched architectural expertise.',
			)
		);

		$this->add_control(
			'layout_style',
			array(
				'label'   => __( 'Layout Presentation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'monolith',
				'options' => array(
					'monolith' => __( 'The Architectural Monolith (Horizontal Expanding Panels ⭐)', 'luxury-re-widgets' ),
					'grid'     => __( '3-Column Luxury Visual Cards', 'luxury-re-widgets' ),
					'split'    => __( 'Interactive Split Showcase', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Grid Columns', 'luxury-re-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				),
				'condition'      => array( 'layout_style' => 'grid' ),
			)
		);

		$this->end_controls_section();

		// ── 2. SERVICES REPEATER ──
		$this->start_controls_section(
			'section_services_list',
			array(
				'label' => __( 'Service Pillars', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'service_image',
			array(
				'label'   => __( 'Architectural Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'service_number',
			array(
				'label'   => __( 'Number Badge (e.g. 01)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'service_category',
			array(
				'label'   => __( 'Category / Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Acquisition',
			)
		);

		$repeater->add_control(
			'service_title',
			array(
				'label'   => __( 'Service Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Discreet Buyer Advisory',
			)
		);

		$repeater->add_control(
			'service_desc',
			array(
				'label'   => __( 'Overview Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Exclusive representation for high-net-worth principals, providing priority access to premier off-market properties and institutional-grade negotiation.',
			)
		);

		$repeater->add_control(
			'service_capabilities',
			array(
				'label'       => __( 'Capabilities List (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Confidential Off-Market Sourcing\nArchitectural Due Diligence\nDiscreet Offer Structuring",
				'description' => __( 'Enter key capabilities separated by newlines.', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'show_btn',
			array(
				'label'        => __( 'Show Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$repeater->add_control(
			'btn_text',
			array(
				'label'     => __( 'Button Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Explore Advisory',
				'condition' => array( 'show_btn' => 'yes' ),
			)
		);

		$repeater->add_control(
			'btn_url',
			array(
				'label'       => __( 'Button Link', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://...',
				'default'     => array( 'url' => '#contact' ),
				'condition'   => array( 'show_btn' => 'yes' ),
			)
		);

		$this->add_control(
			'services',
			array(
				'label'       => __( 'Services List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ service_number }}} - {{{ service_title }}}',
				'default'     => array(
					array(
						'service_number'       => '01',
						'service_category'     => 'Private Acquisition',
						'service_title'        => 'Discreet Buyer Advisory',
						'service_desc'         => 'Exclusive representation for high-net-worth principals, providing priority access to premier off-market properties and institutional-grade negotiation.',
						'service_capabilities' => "Confidential Off-Market Sourcing\nArchitectural Due Diligence\nDiscreet Offer Structuring",
						'service_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85' ),
						'show_btn'             => 'yes',
						'btn_text'             => 'Explore Advisory',
						'btn_url'              => array( 'url' => '#contact' ),
					),
					array(
						'service_number'       => '02',
						'service_category'     => 'Asset Strategy',
						'service_title'        => 'Architectural Realization & Curation',
						'service_desc'         => 'Comprehensive development guidance, spatial redesign consulting, and high-yield estate curation engineered to maximize long-term asset prestige.',
						'service_capabilities' => "Development Feasibility Advisory\nSpatial Optimization & Curation\nHigh-Yield Valuation Strategy",
						'service_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=85' ),
						'show_btn'             => 'yes',
						'btn_text'             => 'Explore Advisory',
						'btn_url'              => array( 'url' => '#contact' ),
					),
					array(
						'service_number'       => '03',
						'service_category'     => 'Global Representation',
						'service_title'        => 'Elite Cross-Border Divestment',
						'service_desc'         => 'Targeted global marketing syndication connecting trophy estates with pre-vetted international buyers across key wealth corridors.',
						'service_capabilities' => "Global Private Syndication\nCinematic Media Production\nPrivate Transaction Closing",
						'service_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85' ),
						'show_btn'             => 'yes',
						'btn_text'             => 'Explore Advisory',
						'btn_url'              => array( 'url' => '#contact' ),
					),
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: HEADER ──
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv__eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv__title' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .lre-aserv__title',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv__desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: CONTAINER & SPACING ──
		$this->start_controls_section(
			'style_container',
			array(
				'label' => __( 'Container & Spacing', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'container_max_width',
			array(
				'label'      => __( 'Container Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 600,
						'max'  => 1920,
						'step' => 10,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1320,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-aserv__container' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-aserv' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'container_padding',
			array(
				'label'      => __( 'Container Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-aserv__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: WATERMARK ──
		$this->start_controls_section(
			'style_watermark',
			array(
				'label'     => __( 'Watermark Typography', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Watermark Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv__watermark' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'watermark_typography',
				'selector' => '{{WRAPPER}} .lre-aserv__watermark',
			)
		);

		$this->add_responsive_control(
			'watermark_top_offset',
			array(
				'label'      => __( 'Top Offset', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', '%' ),
				'range'      => array(
					'px'  => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 2,
					),
					'rem' => array(
						'min'  => 0,
						'max'  => 15,
						'step' => 0.5,
					),
					'%'   => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 6.2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-aserv__watermark' => 'top: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$show_watermark = ( 'yes' === ( $settings['show_watermark'] ?? 'yes' ) );
		$watermark_text = esc_html( $settings['watermark_text'] ?? 'SERVICES' );
		$eyebrow        = esc_html( $settings['eyebrow'] ?? 'Bespoke Advisory Capabilities' );
		$title          = $settings['title'] ?? "Comprehensive Practice.\n<span class=\"lre-title-accent\">Singular Focus.</span>";
		$desc           = esc_html( $settings['description'] ?? '' );
		$layout_style   = esc_attr( $settings['layout_style'] ?? 'monolith' );
		$columns        = esc_attr( $settings['columns'] ?? '3' );
		$services       = ! empty( $settings['services'] ) ? $settings['services'] : array();

		// Clean title lines for mask animation
		$raw_lines   = preg_split( '/<br\s*\/?>|\n/i', $title );
		$title_lines = array_filter( array_map( 'trim', $raw_lines ) );
		if ( empty( $title_lines ) ) {
			$title_lines = array( $title );
		}
		?>

		<section class="lre-aserv lre-aserv--<?php echo esc_attr( $layout_style ); ?>" id="our-services-about" aria-label="<?php esc_attr_e( 'Comprehensive Real Estate Services', 'luxury-re-widgets' ); ?>">
			<?php if ( $show_watermark && ! empty( $watermark_text ) ) : ?>
				<div class="lre-aserv__watermark" aria-hidden="true"><?php echo $watermark_text; ?></div>
			<?php endif; ?>

			<div class="container lre-aserv__container">
				<!-- Section Header -->
				<div class="lre-aserv__header reveal">
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-aserv__eyebrow-wrap">
							<span class="lre-aserv__gold-bar" aria-hidden="true"></span>
							<span class="lre-aserv__eyebrow"><?php echo $eyebrow; ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $title_lines ) ) : ?>
						<h2 class="lre-aserv__title">
							<?php foreach ( $title_lines as $t_idx => $t_line ) : ?>
								<span class="title-mask"><span><?php echo wp_kses( $t_line, array( 'span' => array( 'class' => array() ), 'em' => array() ) ); ?></span></span><?php if ( $t_idx < count( $title_lines ) - 1 ) : ?><br><?php endif; ?>
							<?php endforeach; ?>
						</h2>
					<?php endif; ?>

					<?php if ( ! empty( $desc ) ) : ?>
						<p class="lre-aserv__desc delay-2"><?php echo $desc; ?></p>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $services ) ) : ?>
					<?php if ( 'monolith' === $layout_style ) : ?>
						<!-- Layout 1: The Architectural Monolith (Horizontal Expanding Panels ⭐) -->
						<div class="lre-aserv__monolith-wrapper">
							<?php foreach ( $services as $idx => $s ) :
								$num       = esc_html( $s['service_number'] ?? sprintf( '%02d', $idx + 1 ) );
								$cat       = esc_html( $s['service_category'] ?? '' );
								$stitle    = esc_html( $s['service_title'] ?? '' );
								$sdesc     = esc_html( $s['service_desc'] ?? '' );
								$img_url   = ! empty( $s['service_image']['url'] ) ? esc_url( $s['service_image']['url'] ) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85';
								$show_btn  = ( 'yes' === ( $s['show_btn'] ?? 'yes' ) );
								$btn_text  = esc_html( $s['btn_text'] ?? 'Explore Advisory' );
								$cta_url   = ! empty( $s['btn_url']['url'] ) ? esc_url( $s['btn_url']['url'] ) : '#contact';
								$is_ext    = ! empty( $s['btn_url']['is_external'] ) ? ' target="_blank"' : '';
								$nofollow  = ! empty( $s['btn_url']['nofollow'] ) ? ' rel="nofollow"' : '';
								$caps_raw  = $s['service_capabilities'] ?? '';
								$caps      = array_filter( array_map( 'trim', explode( "\n", $caps_raw ) ) );
								$is_active = ( 0 === $idx ) ? ' is-active' : '';
								?>
								<div class="lre-aserv__monolith<?php echo $is_active; ?> reveal" data-index="<?php echo esc_attr( $idx ); ?>">
									<!-- Background Image with Shutter Reveal -->
									<div class="lre-aserv__mono-bg image-reveal">
										<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $stitle ); ?>" loading="lazy">
										<div class="lre-aserv__mono-vignette" aria-hidden="true"></div>
									</div>

									<!-- Top Badge & Label -->
									<div class="lre-aserv__mono-top">
										<span class="lre-aserv__mono-num"><?php echo $num; ?></span>
										<?php if ( ! empty( $cat ) ) : ?>
											<span class="lre-aserv__mono-tag"><?php echo $cat; ?></span>
										<?php endif; ?>
									</div>

									<!-- Collapsed Vertical Spine Text -->
									<div class="lre-aserv__mono-spine" aria-hidden="true">
										<span class="lre-aserv__mono-spine-text"><?php echo $stitle; ?></span>
									</div>

									<!-- Expanded Content Details -->
									<div class="lre-aserv__mono-content">
										<?php if ( ! empty( $cat ) ) : ?>
											<span class="lre-aserv__card-cat"><?php echo $cat; ?></span>
										<?php endif; ?>

										<h3 class="lre-aserv__mono-title"><?php echo $stitle; ?></h3>

										<?php if ( ! empty( $sdesc ) ) : ?>
											<p class="lre-aserv__mono-desc"><?php echo $sdesc; ?></p>
										<?php endif; ?>

										<?php if ( ! empty( $caps ) ) : ?>
											<ul class="lre-aserv__capabilities lre-aserv__mono-caps">
												<?php foreach ( $caps as $cap ) : ?>
													<li>
														<svg class="lre-aserv__check-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
														<span><?php echo esc_html( $cap ); ?></span>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>

										<?php if ( $show_btn && ! empty( $btn_text ) ) : ?>
											<div class="lre-aserv__mono-action">
												<a href="<?php echo $cta_url; ?>" class="btn btn--outline lre-aserv__btn"<?php echo $is_ext . $nofollow; ?>>
													<span><?php echo $btn_text; ?></span>
													<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>

					<?php elseif ( 'split' === $layout_style ) : ?>
						<!-- Layout 2: Interactive Split Showcase -->
						<div class="lre-aserv__split">
							<div class="lre-aserv__split-media">
								<div class="lre-aserv__split-frame image-reveal">
									<?php $first_img = ! empty( $services[0]['service_image']['url'] ) ? $services[0]['service_image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85'; ?>
									<img src="<?php echo esc_url( $first_img ); ?>" id="lre-aserv-showcase-img" alt="<?php esc_attr_e( 'Service showcase', 'luxury-re-widgets' ); ?>" loading="lazy">
									<div class="lre-aserv__card-overlay" aria-hidden="true"></div>
								</div>
							</div>
							<div class="lre-aserv__split-list">
								<?php foreach ( $services as $idx => $s ) :
									$num      = esc_html( $s['service_number'] ?? sprintf( '%02d', $idx + 1 ) );
									$cat      = esc_html( $s['service_category'] ?? '' );
									$stitle   = esc_html( $s['service_title'] ?? '' );
									$sdesc    = esc_html( $s['service_desc'] ?? '' );
									$img_url  = ! empty( $s['service_image']['url'] ) ? esc_url( $s['service_image']['url'] ) : '';
									$show_btn = ( 'yes' === ( $s['show_btn'] ?? 'yes' ) );
									$btn_text = esc_html( $s['btn_text'] ?? 'Explore Advisory' );
									$cta_url  = ! empty( $s['btn_url']['url'] ) ? esc_url( $s['btn_url']['url'] ) : '#contact';
									$is_ext   = ! empty( $s['btn_url']['is_external'] ) ? ' target="_blank"' : '';
									$nofollow = ! empty( $s['btn_url']['nofollow'] ) ? ' rel="nofollow"' : '';
									$caps_raw = $s['service_capabilities'] ?? '';
									$caps     = array_filter( array_map( 'trim', explode( "\n", $caps_raw ) ) );
									?>
									<div class="lre-aserv__split-item reveal" data-img="<?php echo esc_url( $img_url ); ?>">
										<div class="lre-aserv__split-header">
											<span class="lre-aserv__card-num"><?php echo $num; ?></span>
											<div class="lre-aserv__split-title-wrap">
												<?php if ( ! empty( $cat ) ) : ?>
													<span class="lre-aserv__card-cat"><?php echo $cat; ?></span>
												<?php endif; ?>
												<h3 class="lre-aserv__card-title"><?php echo $stitle; ?></h3>
											</div>
										</div>
										<?php if ( ! empty( $sdesc ) ) : ?>
											<p class="lre-aserv__card-desc"><?php echo $sdesc; ?></p>
										<?php endif; ?>
										<?php if ( ! empty( $caps ) ) : ?>
											<ul class="lre-aserv__capabilities">
												<?php foreach ( $caps as $cap ) : ?>
													<li>
														<svg class="lre-aserv__check-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
														<span><?php echo esc_html( $cap ); ?></span>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
										<?php if ( $show_btn && ! empty( $btn_text ) ) : ?>
											<div class="lre-aserv__card-action">
												<a href="<?php echo $cta_url; ?>" class="btn btn--outline lre-aserv__btn"<?php echo $is_ext . $nofollow; ?>>
													<span><?php echo $btn_text; ?></span>
													<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
												</a>
											</div>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>

					<?php else : ?>
						<!-- Layout 3: 3-Column Luxury Visual Cards -->
						<div class="lre-aserv__grid lre-aserv__grid--col-<?php echo esc_attr( $columns ); ?>">
							<?php foreach ( $services as $idx => $s ) :
								$num      = esc_html( $s['service_number'] ?? sprintf( '%02d', $idx + 1 ) );
								$cat      = esc_html( $s['service_category'] ?? '' );
								$stitle   = esc_html( $s['service_title'] ?? '' );
								$sdesc    = esc_html( $s['service_desc'] ?? '' );
								$img_url  = ! empty( $s['service_image']['url'] ) ? esc_url( $s['service_image']['url'] ) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=85';
								$show_btn = ( 'yes' === ( $s['show_btn'] ?? 'yes' ) );
								$btn_text = esc_html( $s['btn_text'] ?? 'Explore Advisory' );
								$cta_url  = ! empty( $s['btn_url']['url'] ) ? esc_url( $s['btn_url']['url'] ) : '#contact';
								$is_ext   = ! empty( $s['btn_url']['is_external'] ) ? ' target="_blank"' : '';
								$nofollow = ! empty( $s['btn_url']['nofollow'] ) ? ' rel="nofollow"' : '';
								$caps_raw = $s['service_capabilities'] ?? '';
								$caps     = array_filter( array_map( 'trim', explode( "\n", $caps_raw ) ) );
								?>
								<div class="lre-aserv__card reveal">
									<div class="lre-aserv__card-media">
										<div class="lre-aserv__card-frame image-reveal">
											<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $stitle ); ?>" loading="lazy">
											<div class="lre-aserv__card-overlay" aria-hidden="true"></div>
										</div>
										<span class="lre-aserv__card-num"><?php echo $num; ?></span>
									</div>

									<div class="lre-aserv__card-body">
										<?php if ( ! empty( $cat ) ) : ?>
											<span class="lre-aserv__card-cat"><?php echo $cat; ?></span>
										<?php endif; ?>

										<h3 class="lre-aserv__card-title"><?php echo $stitle; ?></h3>

										<?php if ( ! empty( $sdesc ) ) : ?>
											<p class="lre-aserv__card-desc"><?php echo $sdesc; ?></p>
										<?php endif; ?>

										<?php if ( ! empty( $caps ) ) : ?>
											<ul class="lre-aserv__capabilities">
												<?php foreach ( $caps as $cap ) : ?>
													<li>
														<svg class="lre-aserv__check-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
														<span><?php echo esc_html( $cap ); ?></span>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>

										<?php if ( $show_btn && ! empty( $btn_text ) ) : ?>
											<div class="lre-aserv__card-action">
												<a href="<?php echo $cta_url; ?>" class="btn btn--outline lre-aserv__btn"<?php echo $is_ext . $nofollow; ?>>
													<span><?php echo $btn_text; ?></span>
													<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
