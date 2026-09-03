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
 * LRE_Press_Widget
 * Ultra-luxury Press, Media Mentions & Accolades section for the About page.
 * Features publication logos, editorial article cards, external feature links,
 * and industry award badges.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Press_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_press';
	}

	public function get_title() {
		return __( 'LRE — Press & Media Mentions', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'press', 'media', 'news', 'publications', 'awards', 'accolades', 'luxury' );
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
				'default' => 'Editorial Recognition & Press',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Main Headline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Global Spotlight & Industry Accolades',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Regularly featured in the worlds leading architectural and financial publications for setting historic market records and pioneering luxury representation.',
			)
		);

		$this->end_controls_section();

		// ── MEDIA LOGOS REPEATER ──
		$this->start_controls_section(
			'section_logos',
			array(
				'label' => __( 'Publication Logo Bar', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater_logos = new Repeater();

		$repeater_logos->add_control(
			'pub_name',
			array(
				'label'   => __( 'Publication Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ARCHITECTURAL DIGEST',
			)
		);

		$repeater_logos->add_control(
			'pub_logo',
			array(
				'label'   => __( 'Publication Logo Image (Optional)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater_logos->add_control(
			'pub_url',
			array(
				'label'   => __( 'Publication URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'logos',
			array(
				'label'       => __( 'Publication Items', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_logos->get_controls(),
				'title_field' => '{{{ pub_name }}}',
				'default'     => array(
					array( 'pub_name' => 'ARCHITECTURAL DIGEST' ),
					array( 'pub_name' => 'THE WALL STREET JOURNAL' ),
					array( 'pub_name' => 'ROBB REPORT' ),
					array( 'pub_name' => 'MANSION GLOBAL' ),
					array( 'pub_name' => 'FORBES LUXURY' ),
				),
			)
		);

		$this->end_controls_section();

		// ── FEATURED ARTICLES REPEATER ──
		$this->start_controls_section(
			'section_articles',
			array(
				'label' => __( 'Featured Press Articles', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater_articles = new Repeater();

		$repeater_articles->add_control(
			'article_pub',
			array(
				'label'   => __( 'Publication Tag (e.g. Robb Report — Oct 2025)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Robb Report — Architectural Spotlight',
			)
		);

		$repeater_articles->add_control(
			'article_title',
			array(
				'label'   => __( 'Article Headline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'How Crestwood & Associates Closed the Year’s Most Talked-About $32M Coastal Sanctuary Off-Market',
			)
		);

		$repeater_articles->add_control(
			'article_excerpt',
			array(
				'label'   => __( 'Excerpt / Summary', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Operating beneath the public radar, the firm orchestrated an ultra-private transaction between two discreet tech collectors, cementing their standing as the West Coast premier boutique.',
			)
		);

		$repeater_articles->add_control(
			'article_link_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read Full Feature',
			)
		);

		$repeater_articles->add_control(
			'article_url',
			array(
				'label'   => __( 'Article URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'articles',
			array(
				'label'       => __( 'Articles List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_articles->get_controls(),
				'title_field' => '{{{ article_pub }}} — {{{ article_title }}}',
				'default'     => array(
					array(
						'article_pub'     => 'Robb Report — Exclusive Coverage',
						'article_title'   => 'How Crestwood & Associates Closed California’s Defining $32M Coastal Sanctuary',
						'article_excerpt' => 'Operating with total discretion, the firm orchestrated a milestone private transaction that set new architectural benchmarks for oceanfront living.',
					),
					array(
						'article_pub'     => 'Architectural Digest — Provenance & Design',
						'article_title'   => 'Restoring the Legends: Preserving Historic Mid-Century Masterpieces for Modern Heirs',
						'article_excerpt' => 'A behind-the-scenes examination of how historic residential architecture is stewarded through specialized buyer matchmaking and conservation advisory.',
					),
					array(
						'article_pub'     => 'The Wall Street Journal — Private Properties',
						'article_title'   => 'The Rise of the Invisible Sale: Why Trophy Estate Sellers Shun the Public MLS',
						'article_excerpt' => 'Founding Partner Alexander Vance discusses why over 60% of ultra-high-net-worth real estate transfers now occur through private vault networks.',
					),
				),
			)
		);

		$this->end_controls_section();

		// ── INDUSTRY AWARDS REPEATER ──
		$this->start_controls_section(
			'section_awards',
			array(
				'label' => __( 'Industry Awards & Accolades', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater_awards = new Repeater();

		$repeater_awards->add_control(
			'award_year',
			array(
				'label'   => __( 'Year', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '2025',
			)
		);

		$repeater_awards->add_control(
			'award_title',
			array(
				'label'   => __( 'Award Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#1 Boutique Brokerage Nationwide',
			)
		);

		$repeater_awards->add_control(
			'award_issuer',
			array(
				'label'   => __( 'Awarding Body / Organization', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'RealTrends + The Wall Street Journal',
			)
		);

		$this->add_control(
			'awards',
			array(
				'label'       => __( 'Awards List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_awards->get_controls(),
				'title_field' => '{{{ award_year }}} — {{{ award_title }}}',
				'default'     => array(
					array(
						'award_year'   => '2025',
						'award_title'  => '#1 Luxury Boutique Firm',
						'award_issuer' => 'RealTrends Verified National Rankings',
					),
					array(
						'award_year'   => '2024',
						'award_title'  => 'Exceptional Architectural Stewardship',
						'award_issuer' => 'Southern California Preservation Society',
					),
					array(
						'award_year'   => '2024',
						'award_title'  => 'Top 10 Private Client Advisors',
						'award_issuer' => 'Global Family Office Real Estate Summit',
					),
					array(
						'award_year'   => '2023',
						'award_title'  => 'Discreet Transaction of the Year',
						'award_issuer' => 'International Luxury Real Estate Forum',
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
				'selectors' => array(
					'{{WRAPPER}} .lre-press' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .lre-press' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── ARTICLES STYLE ──
		$this->start_controls_section(
			'style_articles',
			array(
				'label' => __( 'Articles Cards Styling', 'luxury-re-widgets' ),
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
					'{{WRAPPER}} .lre-press__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => __( 'Publication Badge Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-press__tag' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$eyebrow  = esc_html( $settings['eyebrow'] ?? 'Editorial Recognition & Press' );
		$title    = esc_html( $settings['title'] ?? 'Global Spotlight & Industry Accolades' );
		$desc     = esc_html( $settings['description'] ?? '' );
		$logos    = ! empty( $settings['logos'] ) ? $settings['logos'] : array();
		$articles = ! empty( $settings['articles'] ) ? $settings['articles'] : array();
		$awards   = ! empty( $settings['awards'] ) ? $settings['awards'] : array();
		?>

		<section class="lre-press" id="press-media" aria-label="<?php esc_attr_e( 'Press and Media Mentions', 'luxury-re-widgets' ); ?>">
			<div class="lre-press__container">
				<!-- Header -->
				<div class="lre-press__header reveal">
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-press__eyebrow-wrap">
							<span class="lre-press__gold-bar"></span>
							<span class="lre-press__eyebrow"><?php echo $eyebrow; ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $title ) ) :
						$clean_title = html_entity_decode( $title, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
						$clean_title = str_replace( array( "\r\n", "\r" ), "\n", $clean_title );
						$raw_lines   = preg_split( '/<br\s*\/?>|\n/i', $clean_title );
						$title_lines = array_filter( array_map( 'trim', $raw_lines ) );
						if ( empty( $title_lines ) ) {
							$title_lines = array( $title );
						}
					?>
						<h2 class="lre-press__title">
							<?php foreach ( $title_lines as $t_idx => $t_line ) : ?>
								<span class="title-mask"><span><?php echo esc_html( $t_line ); ?></span></span><?php if ( $t_idx < count( $title_lines ) - 1 ) : ?><br><?php endif; ?>
							<?php endforeach; ?>
						</h2>
					<?php endif; ?>

					<?php if ( ! empty( $desc ) ) : ?>
						<p class="lre-press__desc delay-2"><?php echo $desc; ?></p>
					<?php endif; ?>
				</div>

				<!-- Publication Logos Marquee / Grid -->
				<?php if ( ! empty( $logos ) ) : ?>
					<div class="lre-press__logos-wrap reveal">
						<div class="lre-press__logos-grid">
							<?php foreach ( $logos as $l ) :
								$pname = esc_html( $l['pub_name'] ?? '' );
								$purl  = ! empty( $l['pub_url']['url'] ) ? esc_url( $l['pub_url']['url'] ) : '#';
								$pimg  = ! empty( $l['pub_logo']['url'] ) ? esc_url( $l['pub_logo']['url'] ) : '';
								?>
								<a href="<?php echo $purl; ?>" target="_blank" rel="noopener" class="lre-press__logo-item">
									<?php if ( ! empty( $pimg ) ) : ?>
										<img src="<?php echo $pimg; ?>" alt="<?php echo esc_attr( $pname ); ?>" loading="lazy">
									<?php else : ?>
										<span class="lre-press__logo-text"><?php echo $pname; ?></span>
									<?php endif; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- Featured Editorial Articles Grid -->
				<?php if ( ! empty( $articles ) ) : ?>
					<div class="lre-press__articles-grid">
						<?php foreach ( $articles as $art ) :
							$pub      = esc_html( $art['article_pub'] ?? '' );
							$atitle   = esc_html( $art['article_title'] ?? '' );
							$excerpt  = esc_html( $art['article_excerpt'] ?? '' );
							$link_txt = esc_html( $art['article_link_text'] ?? 'Read Full Feature' );
							$link_url = ! empty( $art['article_url']['url'] ) ? esc_url( $art['article_url']['url'] ) : '#';
							?>
							<article class="lre-press__card reveal">
								<div class="lre-press__card-inner">
									<?php if ( ! empty( $pub ) ) : ?>
										<div class="lre-press__tag"><?php echo $pub; ?></div>
									<?php endif; ?>

									<h3 class="lre-press__card-title"><?php echo $atitle; ?></h3>

									<?php if ( ! empty( $excerpt ) ) : ?>
										<p class="lre-press__card-excerpt"><?php echo $excerpt; ?></p>
									<?php endif; ?>

									<div class="lre-press__card-footer">
										<a href="<?php echo $link_url; ?>" target="_blank" rel="noopener" class="lre-press__read-link">
											<span><?php echo $link_txt; ?></span>
											<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
										</a>
									</div>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<!-- Accolades Shelf -->
				<?php if ( ! empty( $awards ) ) : ?>
					<div class="lre-press__awards-wrap reveal">
						<div class="lre-press__awards-title-wrap">
							<span class="lre-press__awards-title"><?php esc_html_e( 'Selected Industry Honors', 'luxury-re-widgets' ); ?></span>
						</div>
						<div class="lre-press__awards-grid">
							<?php foreach ( $awards as $aw ) :
								$yr    = esc_html( $aw['award_year'] ?? '' );
								$atit  = esc_html( $aw['award_title'] ?? '' );
								$aiss  = esc_html( $aw['award_issuer'] ?? '' );
								?>
								<div class="lre-press__award-item">
									<div class="lre-press__award-badge">
										<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c5a047" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
									</div>
									<div class="lre-press__award-text">
										<div class="lre-press__award-year"><?php echo $yr; ?></div>
										<div class="lre-press__award-name"><?php echo $atit; ?></div>
										<div class="lre-press__award-issuer"><?php echo $aiss; ?></div>
									</div>
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
