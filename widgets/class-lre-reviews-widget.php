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
 * LRE_Reviews_Widget
 * Ultra-luxury Client Reviews & Testimonials showcase for the About page.
 * Features verified transaction badges, star ratings, editorial typography,
 * and elegant review cards.
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
		return array( 'reviews', 'testimonials', 'ratings', 'clients', 'feedback', 'luxury', 'trust' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── HEADER ──
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
				'default' => 'Client Accolades & Trust',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Main Headline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Words from Those Who Entrusted Us',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'rating_summary',
			array(
				'label'   => __( 'Overall Rating Badge Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '5.0 ★★★★★  OVER 150+ VERIFIED PRIVATE TRANSACTIONS',
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
				),
				'prefix_class'   => 'lre-reviews-grid--col-',
			)
		);

		$this->end_controls_section();

		// ── REVIEWS REPEATER ──
		$this->start_controls_section(
			'section_reviews_list',
			array(
				'label' => __( 'Client Reviews', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'client_name',
			array(
				'label'   => __( 'Client Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Arthur & Vivienne Vance',
			)
		);

		$repeater->add_control(
			'client_title',
			array(
				'label'   => __( 'Title / Profession', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Equity Principal & Art Collector',
			)
		);

		$repeater->add_control(
			'transaction_badge',
			array(
				'label'   => __( 'Transaction Context Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Acquisition — $16.5M Bel Air Architectural',
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
				'label'   => __( 'Review Quotation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'The discretion and institutional depth they brought to our Bel Air acquisition were unprecedented. They negotiated off-market terms that saved us millions while maintaining absolute confidentiality throughout.',
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
				'label'   => __( 'Monogram Initials (If no photo)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'AV',
			)
		);

		$this->add_control(
			'reviews',
			array(
				'label'       => __( 'Reviews Items', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ client_name }}} — {{{ transaction_badge }}}',
				'default'     => array(
					array(
						'client_name'       => 'Arthur & Vivienne Vance',
						'client_title'      => 'Private Equity Principal & Art Collector',
						'transaction_badge' => 'Acquisition — $16.5M Bel Air Architectural',
						'star_rating'       => 5,
						'review_quote'      => 'The discretion and institutional depth they brought to our Bel Air acquisition were unprecedented. They negotiated off-market terms that protected our privacy and secured a masterwork.',
						'monogram'          => 'AV',
					),
					array(
						'client_name'       => 'Marcus & Dr. Sophia Sterling',
						'client_title'      => 'Tech Founder & Biotech Executive',
						'transaction_badge' => 'Disposition — $12.2M Malibu Coastal Estate',
						'star_rating'       => 5,
						'review_quote'      => 'Selling our family estate of 15 years required an agent who respected the home’s soul. Within 18 days, they brought three vetted global buyers without a single intrusive public showing.',
						'monogram'          => 'MS',
					),
					array(
						'client_name'       => 'David Hollister, Esq.',
						'client_title'      => 'Family Office General Counsel',
						'transaction_badge' => 'Portfolio Advisory — 3 Multi-State Holdings',
						'star_rating'       => 5,
						'review_quote'      => 'In thirty years of practicing estate law, I have rarely encountered brokers with such sophisticated understanding of tax structuring, fiduciary responsibility, and market valuation.',
						'monogram'          => 'DH',
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
				'default'   => '#0a0a0e',
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews' => 'background-color: {{VALUE}};',
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
					'top'      => '7',
					'right'    => '2',
					'bottom'   => '7',
					'left'     => '2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-reviews' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── CARD STYLE ──
		$this->start_controls_section(
			'style_card',
			array(
				'label' => __( 'Review Cards Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.025)',
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.08)',
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews__card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'star_color',
			array(
				'label'     => __( 'Stars Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-reviews__stars' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$eyebrow       = esc_html( $settings['eyebrow'] ?? 'Client Accolades & Trust' );
		$title         = esc_html( $settings['title'] ?? 'Words from Those Who Entrusted Us' );
		$rating_sum    = esc_html( $settings['rating_summary'] ?? '' );
		$reviews       = ! empty( $settings['reviews'] ) ? $settings['reviews'] : array();
		?>

		<section class="lre-reviews" id="client-reviews" aria-label="<?php esc_attr_e( 'Client Reviews and Testimonials', 'luxury-re-widgets' ); ?>">
			<div class="lre-reviews__container">
				<!-- Section Header -->
				<div class="lre-reviews__header">
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-reviews__eyebrow-wrap">
							<span class="lre-reviews__gold-bar"></span>
							<span class="lre-reviews__eyebrow"><?php echo $eyebrow; ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $title ) ) : ?>
						<h2 class="lre-reviews__title"><?php echo $title; ?></h2>
					<?php endif; ?>

					<?php if ( ! empty( $rating_sum ) ) : ?>
						<div class="lre-reviews__rating-summary">
							<span class="lre-reviews__rating-badge"><?php echo $rating_sum; ?></span>
						</div>
					<?php endif; ?>
				</div>

				<!-- Grid -->
				<?php if ( ! empty( $reviews ) ) : ?>
					<div class="lre-reviews__grid">
						<?php foreach ( $reviews as $r ) :
							$name        = esc_html( $r['client_name'] ?? '' );
							$ctitle      = esc_html( $r['client_title'] ?? '' );
							$tx_badge    = esc_html( $r['transaction_badge'] ?? '' );
							$quote       = esc_html( $r['review_quote'] ?? '' );
							$stars_count = intval( $r['star_rating'] ?? 5 );
							$avatar_url  = ! empty( $r['client_avatar']['url'] ) ? esc_url( $r['client_avatar']['url'] ) : '';
							$monogram    = esc_html( $r['monogram'] ?? substr( $name, 0, 2 ) );
							?>
							<article class="lre-reviews__card">
								<!-- Top metadata: Transaction Badge & Star Rating -->
								<div class="lre-reviews__card-meta">
									<?php if ( ! empty( $tx_badge ) ) : ?>
										<span class="lre-reviews__badge"><?php echo $tx_badge; ?></span>
									<?php endif; ?>

									<div class="lre-reviews__stars" aria-label="<?php echo esc_attr( $stars_count . ' out of 5 stars' ); ?>">
										<?php for ( $i = 0; $i < $stars_count; $i++ ) : ?>
											<span class="lre-reviews__star">&#9733;</span>
										<?php endfor; ?>
									</div>
								</div>

								<!-- Quote -->
								<div class="lre-reviews__quote-wrap">
									<span class="lre-reviews__quote-mark" aria-hidden="true">&ldquo;</span>
									<p class="lre-reviews__quote-text"><?php echo $quote; ?></p>
								</div>

								<!-- Client Author Block -->
								<div class="lre-reviews__client-row">
									<div class="lre-reviews__avatar">
										<?php if ( ! empty( $avatar_url ) ) : ?>
											<img src="<?php echo $avatar_url; ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy">
										<?php else : ?>
											<span class="lre-reviews__monogram"><?php echo $monogram; ?></span>
										<?php endif; ?>
									</div>

									<div class="lre-reviews__client-info">
										<h4 class="lre-reviews__client-name"><?php echo $name; ?></h4>
										<?php if ( ! empty( $ctitle ) ) : ?>
											<span class="lre-reviews__client-title"><?php echo $ctitle; ?></span>
										<?php endif; ?>
									</div>

									<div class="lre-reviews__verified-icon" title="<?php esc_attr_e( 'Verified Client Transaction', 'luxury-re-widgets' ); ?>">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c5a047" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
									</div>
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
