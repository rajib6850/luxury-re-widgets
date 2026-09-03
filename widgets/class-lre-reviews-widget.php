<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

/**
 * LRE_Reviews_Widget
 *
 * Super-luxury Client Reviews & Fiduciary Trust Showcase.
 * Features an Architectural Split Stage: a Fiduciary Ledger & Trust Pillar on the left
 * and an interactive Testimonial Dossier & Property Showcase on the right.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Reviews_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_reviews';
	}

	public function get_title() {
		return __( 'LRE — Client Reviews & Trust', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'reviews', 'testimonials', 'ratings', 'clients', 'feedback', 'luxury', 'trust', 'fiduciary', 'dossier' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── 1. SECTION HEADER ──
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
				'label'   => __( 'Eyebrow Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Client Accolades & Fiduciary Trust',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Main Headline (Supports <br> or newline)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "Words from Those Who\nEntrusted Us with Masterworks",
				'dynamic'     => array( 'active' => true ),
				'description' => __( 'Each line will receive a staggered luxury mask reveal.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// ── 2. TRUST METRICS & FIDUCIARY PILLAR ──
		$this->start_controls_section(
			'section_fiduciary_pillar',
			array(
				'label' => __( 'Fiduciary Trust Pillar (Left Column)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'seal_text_top',
			array(
				'label'   => __( 'Seal Label (Top)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PRIVATE WEALTH ADVISORY',
			)
		);

		$this->add_control(
			'seal_text_bottom',
			array(
				'label'   => __( 'Seal Label (Bottom)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'STRICT FIDUCIARY STANDARD',
			)
		);

		$this->add_control(
			'metric_1_val',
			array(
				'label'   => __( 'Metric 1 Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$480M+',
			)
		);

		$this->add_control(
			'metric_1_lbl',
			array(
				'label'   => __( 'Metric 1 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Closed Volume',
			)
		);

		$this->add_control(
			'metric_2_val',
			array(
				'label'   => __( 'Metric 2 Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '100%',
			)
		);

		$this->add_control(
			'metric_2_lbl',
			array(
				'label'   => __( 'Metric 2 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Off-Market Discretion',
			)
		);

		$this->add_control(
			'metric_3_val',
			array(
				'label'   => __( 'Metric 3 Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '150+',
			)
		);

		$this->add_control(
			'metric_3_lbl',
			array(
				'label'   => __( 'Metric 3 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'UHNW Families Entrusted',
			)
		);

		$this->end_controls_section();

		// ── 3. CLIENT DOSSIERS (REVIEWS REPEATER) ──
		$this->start_controls_section(
			'section_reviews_list',
			array(
				'label' => __( 'Client Dossiers & Reviews', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'client_name',
			array(
				'label'   => __( 'Client Name / Entity', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Arthur & Vivienne Vance',
			)
		);

		$repeater->add_control(
			'client_title',
			array(
				'label'   => __( 'Client Title / Profession', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Equity Principal & Art Collector',
			)
		);

		$repeater->add_control(
			'transaction_badge',
			array(
				'label'   => __( 'Transaction Type & Asset', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Acquisition — $16.5M Bel Air Architectural',
			)
		);

		$repeater->add_control(
			'transaction_timing',
			array(
				'label'   => __( 'Execution Context / Timing', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '18 Days Off-Market • 100% Confidential',
			)
		);

		$repeater->add_control(
			'property_image',
			array(
				'label'   => __( 'Property Backdrop Photo (Optional)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=80',
				),
			)
		);

		$repeater->add_control(
			'star_rating',
			array(
				'label'   => __( 'Star Rating (1-5)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 5,
				'step'    => 1,
				'default' => 5,
			)
		);

		$repeater->add_control(
			'review_quote',
			array(
				'label'   => __( 'Client Quotation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 5,
				'default' => 'The discretion and institutional depth they brought to our Bel Air acquisition were unprecedented. They negotiated off-market terms that protected our family privacy and secured an irreplaceable architectural masterwork.',
			)
		);

		$repeater->add_control(
			'client_avatar',
			array(
				'label'   => __( 'Client Avatar Photo (Optional)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater->add_control(
			'monogram',
			array(
				'label'   => __( 'Monogram Crest (Fallback Initials)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'AV',
			)
		);

		$this->add_control(
			'reviews',
			array(
				'label'       => __( 'Dossier Items', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ client_name }}} — {{{ transaction_badge }}}',
				'default'     => array(
					array(
						'client_name'        => 'Arthur & Vivienne Vance',
						'client_title'       => 'Private Equity Principal & Art Collector',
						'transaction_badge'  => 'Acquisition — $16.5M Bel Air Architectural',
						'transaction_timing' => '18 Days Off-Market • Complete Discretion',
						'property_image'     => array(
							'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=80',
						),
						'client_avatar'      => array(
							'url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
						),
						'star_rating'        => 5,
						'review_quote'       => 'The discretion and institutional depth they brought to our Bel Air acquisition were unprecedented. They negotiated off-market terms that protected our family privacy and secured an irreplaceable architectural masterwork without a single headline.',
						'monogram'           => 'AV',
					),
					array(
						'client_name'        => 'Marcus & Dr. Sophia Sterling',
						'client_title'       => 'Biotech Executive & Foundation Trustee',
						'transaction_badge'  => 'Disposition — $12.2M Malibu Coastal Estate',
						'transaction_timing' => 'Private Tender • 3 Vetted Sovereign Buyers',
						'property_image'     => array(
							'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80',
						),
						'client_avatar'      => array(
							'url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80',
						),
						'star_rating'        => 5,
						'review_quote'       => 'Selling our family estate of fifteen years required advisors who revered the home’s soul. Within three weeks, they introduced vetted international principals without a single intrusive public showing. An exceptional, sovereign execution.',
						'monogram'           => 'MS',
					),
					array(
						'client_name'        => 'David Hollister, Esq.',
						'client_title'       => 'Family Office General Counsel',
						'transaction_badge'  => 'Portfolio Advisory — 3 Multi-State Holdings',
						'transaction_timing' => 'Cross-Jurisdictional Tax & Trust Structuring',
						'property_image'     => array(
							'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
						),
						'client_avatar'      => array(
							'url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
						),
						'star_rating'        => 5,
						'review_quote'       => 'In thirty years of advising multi-generational wealth, I have rarely encountered brokers with such sophisticated mastery of trust structures, fiduciary duty, and off-market valuations. They are true counselors to elite capital.',
						'monogram'           => 'DH',
					),
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── SECTION STYLE ──
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section Background & Spacing', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#08080c',
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews' => 'background-color: {{VALUE}} !important; --lre-rev-bg: {{VALUE}};',
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
					'top'      => '8',
					'right'    => '2.5',
					'bottom'   => '8.5',
					'left'     => '2.5',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-reviews' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── ACCENTS & CARDS (CONNECTED TO ELEMENTOR KIT) ──
		$this->start_controls_section(
			'style_accents',
			array(
				'label' => __( 'Theme & Elementor Kit Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'gold_accent_color',
			array(
				'label'     => __( 'Primary Accent (Gold / Brand)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews' => '--lre-rev-gold: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'gold_accent_light',
			array(
				'label'     => __( 'Secondary Accent (Light Gold)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d4b565',
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews' => '--lre-rev-gold-light: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Headline Color (White)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews__title, {{WRAPPER}} .lre-reviews__title .title-mask > span, {{WRAPPER}} .lre-reviews__title span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Body Text Color (White)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews' => '--lre-rev-text: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_bg_color',
			array(
				'label'     => __( 'Card Glass Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.025)',
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews' => '--lre-rev-card-bg: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'verified_badge_color',
			array(
				'label'     => __( 'Verified Badge Color (Green Trust)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#34d399',
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews' => '--lre-rev-verified-green: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── TYPOGRAPHY ──
		$this->start_controls_section(
			'style_typography',
			array(
				'label' => __( 'Typography', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Headline Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-reviews__title',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'quote_typography',
				'label'    => __( 'Quotation Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-reviews__quote-text',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$eyebrow        = esc_html( $settings['eyebrow'] ?? 'Client Accolades & Fiduciary Trust' );
		$title          = $settings['title'] ?? "Words from Those Who\nEntrusted Us with Masterworks";

		// Pillar
		$seal_top       = esc_html( $settings['seal_text_top'] ?? 'PRIVATE WEALTH ADVISORY' );
		$seal_bottom    = esc_html( $settings['seal_text_bottom'] ?? 'STRICT FIDUCIARY STANDARD' );
		$m1_val         = esc_html( $settings['metric_1_val'] ?? '$480M+' );
		$m1_lbl         = esc_html( $settings['metric_1_lbl'] ?? 'Closed Volume' );
		$m2_val         = esc_html( $settings['metric_2_val'] ?? '100%' );
		$m2_lbl         = esc_html( $settings['metric_2_lbl'] ?? 'Off-Market Discretion' );
		$m3_val         = esc_html( $settings['metric_3_val'] ?? '150+' );
		$m3_lbl         = esc_html( $settings['metric_3_lbl'] ?? 'UHNW Families Entrusted' );

		$reviews        = ! empty( $settings['reviews'] ) ? $settings['reviews'] : array();
		$total_reviews  = count( $reviews );

		// Parse title lines
		$clean_title = html_entity_decode( $title, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
		$clean_title = str_replace( array( "\r\n", "\r" ), "\n", $clean_title );
		$raw_lines   = preg_split( '/<br\s*\/?>|\n/i', $clean_title );
		$title_lines = array_filter( array_map( 'trim', $raw_lines ) );
		if ( empty( $title_lines ) ) {
			$title_lines = array( $title );
		}
		?>

		<section class="lre-reviews" id="client-reviews" aria-label="<?php esc_attr_e( 'Client Accolades & Fiduciary Trust', 'luxury-re-widgets' ); ?>">
			<div class="container lre-reviews__container">
				<!-- Section Header -->
				<div class="lre-reviews__header reveal">
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-reviews__eyebrow-wrap">
							<span class="lre-reviews__gold-bar" aria-hidden="true"></span>
							<span class="lre-reviews__eyebrow"><?php echo $eyebrow; ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $title_lines ) ) : ?>
						<h2 class="lre-reviews__title">
							<?php foreach ( $title_lines as $t_idx => $t_line ) : ?>
								<span class="title-mask"><span><?php echo wp_kses( $t_line, array( 'span' => array( 'class' => array() ), 'em' => array() ) ); ?></span></span><?php if ( $t_idx < count( $title_lines ) - 1 ) : ?><br><?php endif; ?>
							<?php endforeach; ?>
						</h2>
					<?php endif; ?>
				</div>

				<!-- Split Fiduciary Stage -->
				<?php if ( ! empty( $reviews ) ) : ?>
					<div class="lre-reviews__stage reveal">
						<!-- LEFT: Fiduciary Ledger Pillar & Navigation Index -->
						<aside class="lre-reviews__ledger">
							<!-- Fiduciary Seal & Metrics Card -->
							<div class="lre-reviews__trust-pillar">
								<div class="lre-reviews__seal-wrap">
									<div class="lre-reviews__seal-ring">
										<svg class="lre-reviews__seal-svg" viewBox="0 0 100 100" width="80" height="80">
											<circle cx="50" cy="50" r="46" fill="none" stroke="rgba(197, 160, 71, 0.35)" stroke-width="1.2" stroke-dasharray="2 3"/>
											<circle cx="50" cy="50" r="41" fill="none" stroke="rgba(197, 160, 71, 0.6)" stroke-width="1"/>
											<!-- Hexagram / Star of Trust -->
											<polygon points="50,18 59,36 78,39 63,52 68,71 50,60 32,71 37,52 22,39 41,36" fill="none" stroke="#c5a047" stroke-width="1.2" stroke-linejoin="round"/>
											<circle cx="50" cy="50" r="4" fill="#c5a047"/>
										</svg>
									</div>
									<div class="lre-reviews__seal-meta">
										<span class="lre-reviews__seal-top"><?php echo $seal_top; ?></span>
										<span class="lre-reviews__seal-bottom"><?php echo $seal_bottom; ?></span>
									</div>
								</div>

								<!-- Live Trust Metrics -->
								<div class="lre-reviews__metrics-grid">
									<div class="lre-reviews__metric-item">
										<span class="lre-reviews__metric-val"><?php echo $m1_val; ?></span>
										<span class="lre-reviews__metric-lbl"><?php echo $m1_lbl; ?></span>
									</div>
									<div class="lre-reviews__metric-item">
										<span class="lre-reviews__metric-val"><?php echo $m2_val; ?></span>
										<span class="lre-reviews__metric-lbl"><?php echo $m2_lbl; ?></span>
									</div>
									<div class="lre-reviews__metric-item">
										<span class="lre-reviews__metric-val"><?php echo $m3_val; ?></span>
										<span class="lre-reviews__metric-lbl"><?php echo $m3_lbl; ?></span>
									</div>
								</div>
							</div>

							<!-- Ledger Dossier Selector Tabs -->
							<div class="lre-reviews__ledger-index" role="tablist" aria-label="<?php esc_attr_e( 'Client Dossier Index', 'luxury-re-widgets' ); ?>">
								<div class="lre-reviews__index-header">
									<span class="lre-reviews__index-title"><?php esc_html_e( 'VERIFIED CLIENT DOSSIERS', 'luxury-re-widgets' ); ?></span>
									<span class="lre-reviews__index-count"><?php echo sprintf( '%02d', $total_reviews ); ?> <?php esc_html_e( 'RECORDS', 'luxury-re-widgets' ); ?></span>
								</div>

								<div class="lre-reviews__index-items">
									<?php
									$default_client_avatars = array(
										'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
										'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80',
										'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
									);
									foreach ( $reviews as $idx => $r ) :
										$name       = esc_html( $r['client_name'] ?? '' );
										$tx_badge   = esc_html( $r['transaction_badge'] ?? '' );
										$avatar_url = ! empty( $r['client_avatar']['url'] ) ? esc_url( $r['client_avatar']['url'] ) : ( $default_client_avatars[ $idx % count( $default_client_avatars ) ] ?? '' );
										$monogram   = esc_html( $r['monogram'] ?? substr( $name, 0, 2 ) );
										$is_first   = ( 0 === $idx );
										?>
										<button type="button"
											class="lre-reviews__tab-btn <?php echo $is_first ? 'is-active' : ''; ?>"
											role="tab"
											aria-selected="<?php echo $is_first ? 'true' : 'false'; ?>"
											aria-controls="lre-dossier-<?php echo $idx; ?>"
											data-index="<?php echo $idx; ?>">
											<span class="lre-reviews__tab-num"><?php echo sprintf( '%02d', $idx + 1 ); ?></span>
											<span class="lre-reviews__tab-avatar">
												<?php if ( ! empty( $avatar_url ) ) : ?>
													<img src="<?php echo $avatar_url; ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy">
												<?php else : ?>
													<span class="lre-reviews__tab-monogram"><?php echo $monogram; ?></span>
												<?php endif; ?>
											</span>
											<span class="lre-reviews__tab-content">
												<strong class="lre-reviews__tab-name"><?php echo $name; ?></strong>
												<span class="lre-reviews__tab-tx"><?php echo $tx_badge; ?></span>
											</span>
											<span class="lre-reviews__tab-arrow" aria-hidden="true">&rarr;</span>
										</button>
									<?php endforeach; ?>
								</div>
							</div>
						</aside>

						<!-- RIGHT: The Primary Testimonial Stage & Showcase -->
						<div class="lre-reviews__stage-main">
							<div class="lre-reviews__dossiers-wrapper">
								<?php foreach ( $reviews as $idx => $r ) :
									$name        = esc_html( $r['client_name'] ?? '' );
									$ctitle      = esc_html( $r['client_title'] ?? '' );
									$tx_badge    = esc_html( $r['transaction_badge'] ?? '' );
									$timing      = esc_html( $r['transaction_timing'] ?? '' );
									$prop_img    = ! empty( $r['property_image']['url'] ) ? esc_url( $r['property_image']['url'] ) : '';
									$quote       = esc_html( $r['review_quote'] ?? '' );
									$stars_count = intval( $r['star_rating'] ?? 5 );
									$avatar_url  = ! empty( $r['client_avatar']['url'] ) ? esc_url( $r['client_avatar']['url'] ) : ( $default_client_avatars[ $idx % count( $default_client_avatars ) ] ?? '' );
									$monogram    = esc_html( $r['monogram'] ?? substr( $name, 0, 2 ) );
									$is_first    = ( 0 === $idx );
									?>
									<article id="lre-dossier-<?php echo $idx; ?>"
										class="lre-reviews__dossier-card <?php echo $is_first ? 'is-active' : ''; ?>"
										role="tabpanel"
										aria-hidden="<?php echo $is_first ? 'false' : 'true'; ?>"
										data-index="<?php echo $idx; ?>">

										<!-- Property Visual Anchor (Atmospheric Luxury Inset) -->
										<div class="lre-reviews__prop-visual">
											<?php if ( ! empty( $prop_img ) ) : ?>
												<div class="lre-reviews__prop-img-wrap">
													<img src="<?php echo $prop_img; ?>" alt="<?php echo esc_attr( $tx_badge ); ?>" loading="lazy">
													<div class="lre-reviews__prop-overlay"></div>
												</div>
											<?php endif; ?>

											<div class="lre-reviews__prop-meta">
												<?php if ( ! empty( $tx_badge ) ) : ?>
													<span class="lre-reviews__prop-badge">
														<span class="lre-reviews__badge-dot"></span>
														<?php echo $tx_badge; ?>
													</span>
												<?php endif; ?>

												<?php if ( ! empty( $timing ) ) : ?>
													<span class="lre-reviews__timing-badge"><?php echo $timing; ?></span>
												<?php endif; ?>
											</div>
										</div>

										<!-- Testimonial Editorial Body -->
										<div class="lre-reviews__dossier-body">
											<!-- Stars & Monogram Header -->
											<div class="lre-reviews__dossier-head">
												<div class="lre-reviews__stars" aria-label="<?php echo esc_attr( sprintf( __( '%d out of 5 stars', 'luxury-re-widgets' ), $stars_count ) ); ?>">
													<?php for ( $i = 0; $i < $stars_count; $i++ ) : ?>
														<span class="lre-reviews__star" aria-hidden="true">&#9733;</span>
													<?php endfor; ?>
												</div>
												<span class="lre-reviews__record-id"><?php esc_html_e( 'RECORD REF #', 'luxury-re-widgets' ); ?><?php echo sprintf( '%04d', ( $idx + 1 ) * 142 ); ?></span>
											</div>

											<!-- Quote -->
											<div class="lre-reviews__quote-wrap">
												<span class="lre-reviews__quote-mark" aria-hidden="true">&ldquo;</span>
												<blockquote class="lre-reviews__quote-text">
													<?php echo $quote; ?>
												</blockquote>
											</div>

											<!-- Client Credentials & Notary Verification -->
											<div class="lre-reviews__author-bar">
												<div class="lre-reviews__author-left">
													<div class="lre-reviews__avatar">
														<?php if ( ! empty( $avatar_url ) ) : ?>
															<img src="<?php echo $avatar_url; ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy">
														<?php else : ?>
															<span class="lre-reviews__monogram"><?php echo $monogram; ?></span>
														<?php endif; ?>
													</div>

													<div class="lre-reviews__author-info">
														<h4 class="lre-reviews__author-name"><?php echo $name; ?></h4>
														<?php if ( ! empty( $ctitle ) ) : ?>
															<span class="lre-reviews__author-title"><?php echo $ctitle; ?></span>
														<?php endif; ?>
													</div>
												</div>

												<!-- Verified Seal Badge (Security Green) -->
												<div class="lre-reviews__verification-pill" title="<?php esc_attr_e( 'Verified Closing Escrow File', 'luxury-re-widgets' ); ?>">
													<span class="lre-reviews__verification-dot" aria-hidden="true"></span>
													<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
														<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
														<path d="m9 12 2 2 4-4"/>
													</svg>
													<span><?php esc_html_e( 'VERIFIED TRANSACTION', 'luxury-re-widgets' ); ?></span>
												</div>
											</div>
										</div>
									</article>
								<?php endforeach; ?>
							</div>

							<!-- Bottom Dossier Controls (Prev / Next & Counter) -->
							<div class="lre-reviews__controls">
								<div class="lre-reviews__counter">
									<span class="lre-reviews__active-num">01</span>
									<span class="lre-reviews__counter-slash">/</span>
									<span class="lre-reviews__total-num"><?php echo sprintf( '%02d', $total_reviews ); ?></span>
								</div>

								<div class="lre-reviews__nav-actions">
									<button type="button" class="lre-reviews__nav-btn lre-reviews__nav-btn--prev btn btn--secondary" aria-label="<?php esc_attr_e( 'Previous Record', 'luxury-re-widgets' ); ?>">
										<span aria-hidden="true">&larr;</span>
										<span><?php esc_html_e( 'PREV', 'luxury-re-widgets' ); ?></span>
									</button>
									<button type="button" class="lre-reviews__nav-btn lre-reviews__nav-btn--next btn btn--secondary" aria-label="<?php esc_attr_e( 'Next Record', 'luxury-re-widgets' ); ?>">
										<span><?php esc_html_e( 'NEXT', 'luxury-re-widgets' ); ?></span>
										<span aria-hidden="true">&rarr;</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
