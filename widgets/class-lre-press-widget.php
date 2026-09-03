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
 * Ultra-luxury Editorial Press Archive, Media Spotlight & Industry Accolades Vault.
 * Designed for elite real estate advisories and high-net-worth boutique firms.
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
		return array( 'press', 'media', 'news', 'publications', 'awards', 'accolades', 'luxury', 'editorial' );
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
				'default' => 'Editorial Recognition & Press',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Main Headline', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Global Spotlight &\nIndustry Accolades",
				'description' => __( 'Use line breaks or <br> to split into luxury staggered lines.', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Regularly featured in the world’s leading architectural and financial publications for setting historic market records and pioneering luxury representation.',
			)
		);

		$this->add_control(
			'layout_mode',
			array(
				'label'   => __( 'Editorial Layout Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'spotlight',
				'options' => array(
					'spotlight' => __( 'Lead Editorial Spotlight + Archive Grid (Recommended)', 'luxury-re-widgets' ),
					'grid'      => __( 'Balanced Editorial Columns', 'luxury-re-widgets' ),
				),
			)
		);

		$this->end_controls_section();

		// ── 2. PUBLICATION LOGO MASTHEAD ──
		$this->start_controls_section(
			'section_logos',
			array(
				'label' => __( 'Publication Authorities Masthead', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'masthead_label',
			array(
				'label'   => __( 'Masthead Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'FEATURED & QUOTED IN GLOBAL AUTHORITIES',
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
			'pub_edition',
			array(
				'label'   => __( 'Edition / Specialization (Optional)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Global Edition',
			)
		);

		$repeater_logos->add_control(
			'pub_logo',
			array(
				'label'   => __( 'Logo Image (Optional)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater_logos->add_control(
			'pub_url',
			array(
				'label'   => __( 'Website URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'logos',
			array(
				'label'       => __( 'Publication Authorities', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_logos->get_controls(),
				'title_field' => '{{{ pub_name }}}',
				'default'     => array(
					array( 'pub_name' => 'ARCHITECTURAL DIGEST', 'pub_edition' => 'Design Authority' ),
					array( 'pub_name' => 'THE WALL STREET JOURNAL', 'pub_edition' => 'Private Properties' ),
					array( 'pub_name' => 'ROBB REPORT', 'pub_edition' => 'Luxury & Lifestyle' ),
					array( 'pub_name' => 'FINANCIAL TIMES', 'pub_edition' => 'How To Spend It' ),
					array( 'pub_name' => 'MANSION GLOBAL', 'pub_edition' => 'Premier Transfers' ),
					array( 'pub_name' => 'FORBES LUXURY', 'pub_edition' => 'Global Wealth' ),
				),
			)
		);

		$this->end_controls_section();

		// ── 3. FEATURED EDITORIAL ARTICLES ──
		$this->start_controls_section(
			'section_articles',
			array(
				'label' => __( 'Featured Press Articles', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater_articles = new Repeater();

		$repeater_articles->add_control(
			'article_image',
			array(
				'label'   => __( 'Editorial Cover Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=85',
				),
			)
		);

		$repeater_articles->add_control(
			'article_badge',
			array(
				'label'   => __( 'Editorial Badge / Tag (e.g. COVER FEATURE)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'COVER STORY',
			)
		);

		$repeater_articles->add_control(
			'article_pub',
			array(
				'label'   => __( 'Publication Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Robb Report — Exclusive Coverage',
			)
		);

		$repeater_articles->add_control(
			'article_date',
			array(
				'label'   => __( 'Date / Issue', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'October 2025 Issue',
			)
		);

		$repeater_articles->add_control(
			'article_read_time',
			array(
				'label'   => __( 'Reading Time (e.g. 5 Min Read)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '4 Min Read',
			)
		);

		$repeater_articles->add_control(
			'article_title',
			array(
				'label'   => __( 'Article Headline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'How Crestwood & Associates Closed California’s Defining $32M Coastal Sanctuary Off-Market',
			)
		);

		$repeater_articles->add_control(
			'article_excerpt',
			array(
				'label'   => __( 'Excerpt / Editorial Summary', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Operating with total discretion beneath public radar, the advisory orchestrated a milestone private transaction that established historic architectural benchmarks for private oceanfront enclaves.',
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
				'label'       => __( 'Editorial Articles', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_articles->get_controls(),
				'title_field' => '{{{ article_pub }}} — {{{ article_title }}}',
				'default'     => array(
					array(
						'article_image'     => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=85' ),
						'article_badge'     => 'COVER FEATURE',
						'article_pub'       => 'Robb Report — Architectural Spotlight',
						'article_date'      => 'October 2025 Issue',
						'article_read_time' => '5 Min Read',
						'article_title'     => 'How Crestwood & Associates Closed California’s Defining $32M Coastal Sanctuary Off-Market',
						'article_excerpt'   => 'Operating with total discretion beneath public radar, the firm orchestrated a milestone private transaction that set new architectural benchmarks for private oceanfront enclaves.',
						'article_link_text' => 'Read Full Feature',
					),
					array(
						'article_image'     => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=85' ),
						'article_badge'     => 'PROVENANCE & DESIGN',
						'article_pub'       => 'Architectural Digest — Conservation',
						'article_date'      => 'September 2025',
						'article_read_time' => '4 Min Read',
						'article_title'     => 'Restoring the Legends: Preserving Historic Mid-Century Masterpieces for Modern Heirs',
						'article_excerpt'   => 'A behind-the-scenes examination of how historic residential architecture is stewarded through specialized private client matching.',
						'article_link_text' => 'Read Full Feature',
					),
					array(
						'article_image'     => array( 'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=85' ),
						'article_badge'     => 'PRIVATE WEALTH',
						'article_pub'       => 'The Wall Street Journal — Private Properties',
						'article_date'      => 'August 2025',
						'article_read_time' => '3 Min Read',
						'article_title'     => 'The Rise of the Invisible Sale: Why Trophy Estate Sellers Shun the Public MLS',
						'article_excerpt'   => 'Founding Partner Alexander Vance discusses why over 60% of ultra-high-net-worth real estate transfers now occur through private fiduciary networks.',
						'article_link_text' => 'Read Full Feature',
					),
				),
			)
		);

		$this->end_controls_section();

		// ── 4. INDUSTRY HONORS & ACCOLADES VAULT ──
		$this->start_controls_section(
			'section_awards',
			array(
				'label' => __( 'Industry Honors & Accolades Vault', 'luxury-re-widgets' ),
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
			'award_category',
			array(
				'label'   => __( 'Distinction Category', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'National Ranking',
			)
		);

		$repeater_awards->add_control(
			'award_title',
			array(
				'label'   => __( 'Honor / Award Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#1 Luxury Boutique Firm Nationwide',
			)
		);

		$repeater_awards->add_control(
			'award_issuer',
			array(
				'label'   => __( 'Conferring Authority / Institution', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'RealTrends Verified + The Wall Street Journal',
			)
		);

		$this->add_control(
			'awards',
			array(
				'label'       => __( 'Honors & Accolades List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_awards->get_controls(),
				'title_field' => '{{{ award_year }}} — {{{ award_title }}}',
				'default'     => array(
					array(
						'award_year'     => '2025',
						'award_category' => 'National Benchmark',
						'award_title'    => '#1 Luxury Boutique Firm Nationwide',
						'award_issuer'   => 'RealTrends Verified + The Wall Street Journal',
					),
					array(
						'award_year'     => '2024',
						'award_category' => 'Heritage Award',
						'award_title'    => 'Exceptional Architectural Stewardship',
						'award_issuer'   => 'Southern California Preservation Society',
					),
					array(
						'award_year'     => '2024',
						'award_category' => 'Private Client Distinction',
						'award_title'    => 'Top 10 Private Client Advisors Globally',
						'award_issuer'   => 'Global Family Office Real Estate Summit',
					),
					array(
						'award_year'     => '2023',
						'award_category' => 'Transaction Milestone',
						'award_title'    => 'Discreet Transaction of the Year ($32M)',
						'award_issuer'   => 'International Luxury Real Estate Forum',
					),
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: SECTION & AMBIENCE ──
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section & Atmosphere', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Atmospheric Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#08080c',
				'selectors' => array(
					'{{WRAPPER}} .lre-press' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'gold_accent',
			array(
				'label'     => __( 'Champagne Gold Accent', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-press' => '--press-gold: {{VALUE}};',
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
					'right'    => '0',
					'bottom'   => '8.5',
					'left'     => '0',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: HEADINGS & TYPOGRAPHY ──
		$this->start_controls_section(
			'style_headings',
			array(
				'label' => __( 'Headings & Typography', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-press__title, {{WRAPPER}} .lre-press__title span, {{WRAPPER}} .lre-press__title .title-mask > span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press__title',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.7)',
				'selectors' => array(
					'{{WRAPPER}} .lre-press__desc' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: CARDS & VAULT ──
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Editorial Cards & Vault', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.025)',
				'selectors' => array(
					'{{WRAPPER}} .lre-press__card, {{WRAPPER}} .lre-press__spotlight-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'vault_bg',
			array(
				'label'     => __( 'Accolades Vault Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(16, 17, 23, 0.85)',
				'selectors' => array(
					'{{WRAPPER}} .lre-press__vault' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$eyebrow        = esc_html( $settings['eyebrow'] ?? 'Editorial Recognition & Press' );
		$title          = esc_html( $settings['title'] ?? "Global Spotlight &\nIndustry Accolades" );
		$desc           = esc_html( $settings['description'] ?? '' );
		$layout_mode    = ! empty( $settings['layout_mode'] ) ? $settings['layout_mode'] : 'spotlight';
		$masthead_lbl   = esc_html( $settings['masthead_label'] ?? 'FEATURED & QUOTED IN GLOBAL AUTHORITIES' );
		$logos          = ! empty( $settings['logos'] ) ? $settings['logos'] : array();
		$articles       = ! empty( $settings['articles'] ) ? $settings['articles'] : array();
		$awards         = ! empty( $settings['awards'] ) ? $settings['awards'] : array();

		// Determine Lead Article for Spotlight
		$lead_article       = null;
		$secondary_articles = array();

		if ( ! empty( $articles ) ) {
			if ( $layout_mode === 'spotlight' ) {
				$lead_article       = $articles[0];
				$secondary_articles = array_slice( $articles, 1 );
			} else {
				$secondary_articles = $articles;
			}
		}

		$default_lead_img = 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=85';
		$default_card_img = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=85';
		?>

		<section class="lre-press lre-press--layout-<?php echo esc_attr( $layout_mode ); ?>" id="press-media" aria-label="<?php esc_attr_e( 'Press and Media Mentions', 'luxury-re-widgets' ); ?>">
			<!-- Atmospheric Lighting -->
			<div class="lre-press__glow lre-press__glow--top" aria-hidden="true"></div>
			<div class="lre-press__glow lre-press__glow--bottom" aria-hidden="true"></div>

			<div class="container lre-press__container">
				<!-- Header (Centered Luxury Parity with Reviews & About Services) -->
				<header class="lre-press__header reveal">
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-press__eyebrow-wrap">
							<span class="lre-press__gold-bar" aria-hidden="true"></span>
							<span class="lre-press__eyebrow"><?php echo $eyebrow; ?></span>
							<span class="lre-press__gold-bar" aria-hidden="true"></span>
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
				</header>

				<!-- 1. Publication Authorities Masthead Bar -->
				<?php if ( ! empty( $logos ) ) : ?>
					<div class="lre-press__masthead reveal">
						<?php if ( ! empty( $masthead_lbl ) ) : ?>
							<div class="lre-press__masthead-tag">
								<span class="lre-press__masthead-dot"></span>
								<span><?php echo $masthead_lbl; ?></span>
								<span class="lre-press__masthead-dot"></span>
							</div>
						<?php endif; ?>
						<div class="lre-press__masthead-grid">
							<?php foreach ( $logos as $l ) :
								$pname    = esc_html( $l['pub_name'] ?? '' );
								$pedition = esc_html( $l['pub_edition'] ?? '' );
								$purl     = ! empty( $l['pub_url']['url'] ) ? esc_url( $l['pub_url']['url'] ) : '#';
								$pimg     = ! empty( $l['pub_logo']['url'] ) ? esc_url( $l['pub_logo']['url'] ) : '';
								?>
								<a href="<?php echo $purl; ?>" target="_blank" rel="noopener" class="lre-press__masthead-item" title="<?php echo esc_attr( $pname ); ?>">
									<?php if ( ! empty( $pimg ) ) : ?>
										<img src="<?php echo $pimg; ?>" alt="<?php echo esc_attr( $pname ); ?>" loading="lazy" class="lre-press__masthead-img">
									<?php else : ?>
										<span class="lre-press__masthead-name"><?php echo $pname; ?></span>
									<?php endif; ?>
									<?php if ( ! empty( $pedition ) ) : ?>
										<span class="lre-press__masthead-sub"><?php echo $pedition; ?></span>
									<?php endif; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- 2. Editorial Features Stage -->
				<div class="lre-press__stage">
					<?php if ( $layout_mode === 'spotlight' && ! empty( $lead_article ) ) :
						$lead_img      = ! empty( $lead_article['article_image']['url'] ) ? esc_url( $lead_article['article_image']['url'] ) : $default_lead_img;
						$lead_badge    = esc_html( $lead_article['article_badge'] ?? 'COVER STORY' );
						$lead_pub      = esc_html( $lead_article['article_pub'] ?? 'Robb Report — Exclusive Coverage' );
						$lead_date     = esc_html( $lead_article['article_date'] ?? 'October 2025 Issue' );
						$lead_read     = esc_html( $lead_article['article_read_time'] ?? '4 Min Read' );
						$lead_title    = esc_html( $lead_article['article_title'] ?? '' );
						$lead_excerpt  = esc_html( $lead_article['article_excerpt'] ?? '' );
						$lead_link_txt = esc_html( $lead_article['article_link_text'] ?? 'Read Full Feature' );
						$lead_url      = ! empty( $lead_article['article_url']['url'] ) ? esc_url( $lead_article['article_url']['url'] ) : '#';
					?>
						<!-- Hero Lead Editorial Spotlight -->
						<div class="lre-press__spotlight reveal">
							<article class="lre-press__spotlight-card">
								<div class="lre-press__spotlight-media image-reveal">
									<img src="<?php echo $lead_img; ?>" alt="<?php echo esc_attr( $lead_title ); ?>" loading="lazy">
									<div class="lre-press__spotlight-vignette"></div>
									<div class="lre-press__spotlight-pill-wrap">
										<?php if ( ! empty( $lead_badge ) ) : ?>
											<span class="lre-press__spotlight-badge">
												<span class="lre-press__badge-dot"></span>
												<?php echo $lead_badge; ?>
											</span>
										<?php endif; ?>
										<?php if ( ! empty( $lead_read ) ) : ?>
											<span class="lre-press__spotlight-read"><?php echo $lead_read; ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="lre-press__spotlight-content">
									<div class="lre-press__spotlight-meta-bar">
										<span class="lre-press__spotlight-pub"><?php echo $lead_pub; ?></span>
										<?php if ( ! empty( $lead_date ) ) : ?>
											<span class="lre-press__meta-sep">•</span>
											<span class="lre-press__spotlight-date"><?php echo $lead_date; ?></span>
										<?php endif; ?>
									</div>
									<h3 class="lre-press__spotlight-title"><?php echo $lead_title; ?></h3>
									<?php if ( ! empty( $lead_excerpt ) ) : ?>
										<p class="lre-press__spotlight-excerpt"><?php echo $lead_excerpt; ?></p>
									<?php endif; ?>
									<div class="lre-press__spotlight-footer">
										<a href="<?php echo $lead_url; ?>" target="_blank" rel="noopener" class="lre-press__spotlight-link btn btn--outline">
											<span><?php echo $lead_link_txt; ?></span>
											<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
										</a>
										<span class="lre-press__spotlight-verified">
											<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
											<?php esc_html_e( 'VERIFIED ARCHIVE', 'luxury-re-widgets' ); ?>
										</span>
									</div>
								</div>
							</article>
						</div>
					<?php endif; ?>

					<!-- Secondary Curated Articles Grid -->
					<?php if ( ! empty( $secondary_articles ) ) : ?>
						<div class="lre-press__articles-grid">
							<?php foreach ( $secondary_articles as $s_idx => $art ) :
								$card_img = ! empty( $art['article_image']['url'] ) ? esc_url( $art['article_image']['url'] ) : ( $s_idx === 0 ? $default_card_img : '' );
								$badge    = esc_html( $art['article_badge'] ?? 'PRESS FEATURE' );
								$pub      = esc_html( $art['article_pub'] ?? '' );
								$date     = esc_html( $art['article_date'] ?? '' );
								$atitle   = esc_html( $art['article_title'] ?? '' );
								$excerpt  = esc_html( $art['article_excerpt'] ?? '' );
								$link_txt = esc_html( $art['article_link_text'] ?? 'Read Full Feature' );
								$link_url = ! empty( $art['article_url']['url'] ) ? esc_url( $art['article_url']['url'] ) : '#';
								?>
								<article class="lre-press__card reveal">
									<div class="lre-press__card-inner">
										<?php if ( ! empty( $card_img ) ) : ?>
											<div class="lre-press__card-media image-reveal">
												<img src="<?php echo $card_img; ?>" alt="<?php echo esc_attr( $atitle ); ?>" loading="lazy">
												<div class="lre-press__card-media-vignette"></div>
											</div>
										<?php endif; ?>

										<div class="lre-press__card-body">
											<div class="lre-press__card-meta">
												<?php if ( ! empty( $pub ) ) : ?>
													<span class="lre-press__tag"><?php echo $pub; ?></span>
												<?php endif; ?>
												<?php if ( ! empty( $date ) ) : ?>
													<span class="lre-press__card-date"><?php echo $date; ?></span>
												<?php endif; ?>
											</div>

											<h4 class="lre-press__card-title"><?php echo $atitle; ?></h4>

											<?php if ( ! empty( $excerpt ) ) : ?>
												<p class="lre-press__card-excerpt"><?php echo $excerpt; ?></p>
											<?php endif; ?>

											<div class="lre-press__card-footer">
												<a href="<?php echo $link_url; ?>" target="_blank" rel="noopener" class="lre-press__read-link">
													<span><?php echo $link_txt; ?></span>
													<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
												</a>
											</div>
										</div>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- 3. The Distinction & Accolades Vault (Industry Honors) -->
				<?php if ( ! empty( $awards ) ) : ?>
					<div class="lre-press__vault reveal">
						<div class="lre-press__vault-header">
							<div class="lre-press__vault-title-group">
								<div class="lre-press__vault-crest" aria-hidden="true">
									<!-- Regal Laurel Shield Icon -->
									<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--press-gold, #c5a047)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
										<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
										<circle cx="12" cy="11" r="3"></circle>
									</svg>
								</div>
								<div class="lre-press__vault-headings">
									<span class="lre-press__vault-eyebrow"><?php esc_html_e( 'PRIVATE RECOGNITION ARCHIVE', 'luxury-re-widgets' ); ?></span>
									<h3 class="lre-press__vault-title"><?php esc_html_e( 'Selected Industry Honors & Institutional Distinctions', 'luxury-re-widgets' ); ?></h3>
								</div>
							</div>
							<div class="lre-press__vault-distinction-badge">
								<span class="lre-press__distinction-dot"></span>
								<span><?php esc_html_e( 'INDEPENDENTLY VERIFIED', 'luxury-re-widgets' ); ?></span>
							</div>
						</div>

						<div class="lre-press__awards-grid">
							<?php foreach ( $awards as $aw ) :
								$yr       = esc_html( $aw['award_year'] ?? '' );
								$category = esc_html( $aw['award_category'] ?? 'Honor' );
								$atit     = esc_html( $aw['award_title'] ?? '' );
								$aiss     = esc_html( $aw['award_issuer'] ?? '' );
								?>
								<div class="lre-press__award-item">
									<div class="lre-press__award-badge" aria-hidden="true">
										<!-- Gold Laurel Crest -->
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--press-gold, #c5a047)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
											<circle cx="12" cy="8" r="6"></circle>
											<polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
										</svg>
									</div>
									<div class="lre-press__award-text">
										<div class="lre-press__award-top">
											<?php if ( ! empty( $yr ) ) : ?>
												<span class="lre-press__award-year"><?php echo $yr; ?></span>
											<?php endif; ?>
											<?php if ( ! empty( $category ) ) : ?>
												<span class="lre-press__award-cat"><?php echo $category; ?></span>
											<?php endif; ?>
										</div>
										<h4 class="lre-press__award-name"><?php echo $atit; ?></h4>
										<p class="lre-press__award-issuer"><?php echo $aiss; ?></p>
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
