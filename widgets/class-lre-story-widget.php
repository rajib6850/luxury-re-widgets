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
 * LRE_Story_Widget
 * Ultra-luxury editorial heritage & narrative storytelling section for the About page.
 * Features asymmetric layered imagery, editorial pull quotes, founder signature,
 * and milestone stats metrics.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Story_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_story';
	}

	public function get_title() {
		return __( 'LRE — Our Story & Heritage', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-history';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'story', 'heritage', 'about', 'history', 'stats', 'luxury', 'founder' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── HEADER & HEADLINE ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Header & Title', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'watermark',
			array(
				'label'   => __( 'Watermark Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'HERITAGE',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Our Heritage & Philosophy',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Main Headline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => "Two Decades of Defining Exceptional Living.",
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'span' => 'span',
					'div'  => 'div',
				),
			)
		);

		$this->add_control(
			'show_divider',
			array(
				'label'     => __( 'Show Gold Accent Divider', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'luxury-re-widgets' ),
				'label_off' => __( 'Hide', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// ── STORY NARRATIVE ──
		$this->start_controls_section(
			'section_story_content',
			array(
				'label' => __( 'Story Narrative', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'lead_paragraph',
			array(
				'label'   => __( 'Lead Paragraph', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Founded on the principle that exceptional architecture demands an equally refined representation, our practice was born out of a desire to elevate prime residential real estate beyond the transactional realm.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'body_paragraph',
			array(
				'label'   => __( 'Secondary Narrative', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => '<p>Over the past decade, we have curated an uncompromising portfolio of historic estates, modern masterworks, and discreet waterfront sanctums across Southern California and beyond.</p><p>We operate with the confidentiality of a private family office and the strategic acuity of a bespoke investment advisory. To us, every property possesses a soul, and every acquisition marks the opening of a profound life chapter.</p>',
			)
		);

		$this->add_control(
			'quote_text',
			array(
				'label'   => __( 'Editorial Pull Quote', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => '"Luxury is not merely a price point; it is an experience of absolute discretion, timeless design, and unwavering stewardship."',
			)
		);

		$this->add_control(
			'quote_author',
			array(
				'label'   => __( 'Quote Author / Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Alexander Vance — Founder & Principal Broker',
			)
		);

		$this->add_control(
			'founder_signature_text',
			array(
				'label'   => __( 'Signature Text (Stylized)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Alexander Vance',
			)
		);

		$this->add_control(
			'founder_signature_image',
			array(
				'label'   => __( 'Or Signature Image Upload', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$this->end_controls_section();

		// ── IMAGERY ──
		$this->start_controls_section(
			'section_images',
			array(
				'label' => __( 'Editorial Imagery', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'primary_image',
			array(
				'label'   => __( 'Primary Portrait / Estate Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=900&q=85',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'secondary_image',
			array(
				'label'   => __( 'Secondary Overlapping Detail Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=600&q=85',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'badge_text_top',
			array(
				'label'   => __( 'Floating Badge Top Line', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ESTABLISHED',
			)
		);

		$this->add_control(
			'badge_text_bottom',
			array(
				'label'   => __( 'Floating Badge Bottom Line', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '2012',
			)
		);

		$this->end_controls_section();

		// ── MILESTONE STATS ──
		$this->start_controls_section(
			'section_milestone_stats',
			array(
				'label' => __( 'Milestone Statistics', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'stat_number',
			array(
				'label'   => __( 'Metric Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$4.8B+',
			)
		);

		$repeater->add_control(
			'stat_label',
			array(
				'label'   => __( 'Metric Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Career Sales Volume',
			)
		);

		$repeater->add_control(
			'stat_subtext',
			array(
				'label'   => __( 'Subtext / Detail (Optional)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Prime coastal & metropolitan estates',
			)
		);

		$this->add_control(
			'milestones',
			array(
				'label'       => __( 'Milestone Items', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ stat_number }}} — {{{ stat_label }}}',
				'default'     => array(
					array(
						'stat_number'  => '$4.8B+',
						'stat_label'   => 'Career Sales Volume',
						'stat_subtext' => 'Across California & global private client networks',
					),
					array(
						'stat_number'  => '98.4%',
						'stat_label'   => 'Client Advisory Retention',
						'stat_subtext' => 'Generational wealth & bespoke repeat advisory',
					),
					array(
						'stat_number'  => '15+',
						'stat_label'   => 'Years of Market Mastery',
						'stat_subtext' => 'Deep architectural provenance & discretion',
					),
					array(
						'stat_number'  => '500+',
						'stat_label'   => 'Exceptional Residences',
						'stat_subtext' => 'Curated and closed with complete privacy',
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
				'default'   => '#faf7f2',
				'selectors' => array(
					'{{WRAPPER}} .lre-story' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .lre-story' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── TYPOGRAPHY STYLES ──
		$this->start_controls_section(
			'style_typography_section',
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
					'{{WRAPPER}} .lre-story__eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .lre-story__title',
			)
		);

		$this->add_control(
			'lead_color',
			array(
				'label'     => __( 'Lead Paragraph Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1a1a1a',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__lead' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'body_color',
			array(
				'label'     => __( 'Body Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4a4a4a',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__body, {{WRAPPER}} .lre-story__body p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'quote_color',
			array(
				'label'     => __( 'Quote Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__quote-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'quote_border_color',
			array(
				'label'     => __( 'Quote Border / Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__quote' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .lre-story__quote-mark' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STATS BOX STYLE ──
		$this->start_controls_section(
			'style_stats_section',
			array(
				'label' => __( 'Milestone Stats Box', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'stats_bg',
			array(
				'label'     => __( 'Stats Container Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__stats-wrap' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'stat_number_color',
			array(
				'label'     => __( 'Metric Number Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__stat-num' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'stat_label_color',
			array(
				'label'     => __( 'Metric Label Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__stat-lbl' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$watermark       = esc_html( $settings['watermark'] ?? 'HERITAGE' );
		$eyebrow         = esc_html( $settings['eyebrow'] ?? 'Our Heritage' );
		$title           = esc_html( $settings['title'] ?? '' );
		$title_tag       = esc_attr( $settings['title_tag'] ?? 'h2' );
		$lead            = esc_html( $settings['lead_paragraph'] ?? '' );
		$body            = wp_kses_post( $settings['body_paragraph'] ?? '' );
		$quote           = esc_html( $settings['quote_text'] ?? '' );
		$quote_author    = esc_html( $settings['quote_author'] ?? '' );
		$sig_text        = esc_html( $settings['founder_signature_text'] ?? '' );
		$sig_img_url     = ! empty( $settings['founder_signature_image']['url'] ) ? esc_url( $settings['founder_signature_image']['url'] ) : '';
		$primary_img     = ! empty( $settings['primary_image']['url'] ) ? esc_url( $settings['primary_image']['url'] ) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=900&q=85';
		$secondary_img   = ! empty( $settings['secondary_image']['url'] ) ? esc_url( $settings['secondary_image']['url'] ) : 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=600&q=85';
		$badge_top       = esc_html( $settings['badge_text_top'] ?? 'ESTABLISHED' );
		$badge_bot       = esc_html( $settings['badge_text_bottom'] ?? '2012' );
		$milestones      = ! empty( $settings['milestones'] ) ? $settings['milestones'] : array();
		?>

		<section class="lre-story" id="our-story" aria-label="<?php esc_attr_e( 'Our Story and Heritage', 'luxury-re-widgets' ); ?>">
			<?php if ( ! empty( $watermark ) ) : ?>
				<div class="lre-story__watermark" aria-hidden="true"><?php echo $watermark; ?></div>
			<?php endif; ?>

			<div class="lre-story__container">
				<!-- Header block -->
				<div class="lre-story__header reveal">
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-story__eyebrow-wrap">
							<span class="lre-story__gold-bar"></span>
							<span class="lre-story__eyebrow"><?php echo $eyebrow; ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $title ) ) : ?>
						<<?php echo $title_tag; ?> class="lre-story__title">
							<?php echo nl2br( $title ); ?>
						</<?php echo $title_tag; ?>>
					<?php endif; ?>

					<?php if ( 'yes' === ( $settings['show_divider'] ?? 'yes' ) ) : ?>
						<div class="lre-story__divider"></div>
					<?php endif; ?>
				</div>

				<!-- Asymmetric Grid: Story Text + Layered Images -->
				<div class="lre-story__grid">
					<!-- Text Column -->
					<div class="lre-story__text-col reveal">
						<?php if ( ! empty( $lead ) ) : ?>
							<p class="lre-story__lead"><?php echo $lead; ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $body ) ) : ?>
							<div class="lre-story__body">
								<?php echo $body; ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $quote ) ) : ?>
							<blockquote class="lre-story__quote">
								<span class="lre-story__quote-mark" aria-hidden="true">&ldquo;</span>
								<p class="lre-story__quote-text"><?php echo $quote; ?></p>
								<?php if ( ! empty( $quote_author ) ) : ?>
									<cite class="lre-story__quote-author"><?php echo $quote_author; ?></cite>
								<?php endif; ?>
							</blockquote>
						<?php endif; ?>

						<!-- Signature -->
						<div class="lre-story__signature">
							<?php if ( ! empty( $sig_img_url ) ) : ?>
								<img src="<?php echo $sig_img_url; ?>" alt="<?php echo esc_attr( $sig_text ); ?>" class="lre-story__sig-img">
							<?php elseif ( ! empty( $sig_text ) ) : ?>
								<span class="lre-story__sig-text"><?php echo $sig_text; ?></span>
							<?php endif; ?>
						</div>
					</div>

					<!-- Media Column: Overlapping Luxury Imagery -->
					<div class="lre-story__media-col">
						<div class="lre-story__img-composition">
							<!-- Main Photo -->
							<div class="lre-story__img-main image-reveal">
								<img src="<?php echo $primary_img; ?>" alt="<?php esc_attr_e( 'Our Architectural Legacy', 'luxury-re-widgets' ); ?>" loading="lazy">
							</div>

							<!-- Overlapping Secondary Detail Photo -->
							<?php if ( ! empty( $secondary_img ) ) : ?>
								<div class="lre-story__img-secondary image-reveal delay-2">
									<img src="<?php echo $secondary_img; ?>" alt="<?php esc_attr_e( 'Architectural Craftsmanship', 'luxury-re-widgets' ); ?>" loading="lazy">
								</div>
							<?php endif; ?>

							<!-- Floating Luxury Stamp Badge -->
							<?php if ( ! empty( $badge_top ) || ! empty( $badge_bot ) ) : ?>
								<div class="lre-story__stamp">
									<span class="lre-story__stamp-top"><?php echo $badge_top; ?></span>
									<span class="lre-story__stamp-bot"><?php echo $badge_bot; ?></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<!-- Milestone Metrics Bar -->
				<?php if ( ! empty( $milestones ) ) : ?>
					<div class="lre-story__stats-wrap reveal">
						<div class="lre-story__stats-grid">
							<?php foreach ( $milestones as $item ) : ?>
								<div class="lre-story__stat-item">
									<div class="lre-story__stat-num"><?php echo esc_html( $item['stat_number'] ?? '' ); ?></div>
									<div class="lre-story__stat-lbl"><?php echo esc_html( $item['stat_label'] ?? '' ); ?></div>
									<?php if ( ! empty( $item['stat_subtext'] ) ) : ?>
										<div class="lre-story__stat-sub"><?php echo esc_html( $item['stat_subtext'] ); ?></div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
