<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * LRE_Sellers_Guide_Widget
 * Ultra-Luxury Visual-First Seller's Guide & Disposition Protocol Widget.
 * Engineered for Ultra-High-Net-Worth (UHNW) principals, family offices, and estate trustees.
 *
 * Unique Design Features:
 * - Ambient typographic watermark ("DISPOSITION")
 * - Gold-bar eyebrow and title-mask curtain reveal H2
 * - Tier 1: Dual Strategic Photographic Portals (Off-Market Syndication vs. Cinematic Global Campaign)
 *   with high-res architectural backgrounds, dark glass gradient overlays, and floating gold metric badges.
 * - Tier 2: 3-Milestone Visual Editorial Cards with hover-zoom imagery, gold monograph numbers (01, 02, 03),
 *   and concise 1-line luxury captions.
 * - Minimal text content, zero text bloat, visual-first estate presentation.
 * - 100% Elementor live editor visibility guarantee (zero black screen).
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Sellers_Guide_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_sellers_guide';
	}

	public function get_title() {
		return __( 'LRE — Seller\'s Guide', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-image-box';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'seller', 'guide', 'disposition', 'estate', 'luxury', 'fiduciary', 'valuation', 'listing', 'visual' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION 1: HEADER & WATERMARK ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header & Watermark', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Typographic Watermark', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'     => __( 'Watermark Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'DISPOSITION',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Gold Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Estate Disposition Protocol',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Section Heading (H2)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Curated Estate Disposition',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'Heading HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
				),
				'default' => 'h2',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'A discreet, visual-first advisory protocol engineered for principals divesting landmark architectural estates across global capital markets.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: DUAL STRATEGIC PHOTOGRAPHIC PORTALS (TIER 1) ──
		$this->start_controls_section(
			'section_portals',
			array(
				'label' => __( 'Tier 1: Dual Photographic Portals', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'portal_a_heading_notice',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<strong>' . __( 'Portal A: Off-Market Placement', 'luxury-re-widgets' ) . '</strong>',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			)
		);

		$this->add_control(
			'portal_a_badge',
			array(
				'label'   => __( 'Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '100% CONFIDENTIAL PLACEMENT',
			)
		);

		$this->add_control(
			'portal_a_title',
			array(
				'label'   => __( 'Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Off-Market Syndication',
			)
		);

		$this->add_control(
			'portal_a_subtitle',
			array(
				'label'   => __( 'Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Direct Sovereign Wealth & Family Office Registry Matching',
			)
		);

		$this->add_control(
			'portal_a_image',
			array(
				'label'   => __( 'Background Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=85',
				),
			)
		);

		$this->add_control(
			'portal_a_metric_num',
			array(
				'label'   => __( 'Metric Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '32 Days',
			)
		);

		$this->add_control(
			'portal_a_metric_label',
			array(
				'label'   => __( 'Metric Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Avg. Liquidity Cycle',
			)
		);

		$this->add_control(
			'portal_a_tag1',
			array(
				'label'   => __( 'Micro-Tag 1', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Zero Digital Footprint',
			)
		);

		$this->add_control(
			'portal_a_tag2',
			array(
				'label'   => __( 'Micro-Tag 2', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Blind Escrow Closing',
			)
		);

		$this->add_control(
			'portal_b_heading_notice',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<hr><strong>' . __( 'Portal B: Global Narrative Campaign', 'luxury-re-widgets' ) . '</strong>',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			)
		);

		$this->add_control(
			'portal_b_badge',
			array(
				'label'   => __( 'Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'GLOBAL ARCHITECTURAL PRESTIGE',
			)
		);

		$this->add_control(
			'portal_b_title',
			array(
				'label'   => __( 'Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Cinematic Global Narrative',
			)
		);

		$this->add_control(
			'portal_b_subtitle',
			array(
				'label'   => __( 'Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'International Architectural Cinema & Editorial Direction',
			)
		);

		$this->add_control(
			'portal_b_image',
			array(
				'label'   => __( 'Background Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85',
				),
			)
		);

		$this->add_control(
			'portal_b_metric_num',
			array(
				'label'   => __( 'Metric Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '4.8M+',
			)
		);

		$this->add_control(
			'portal_b_metric_label',
			array(
				'label'   => __( 'Metric Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Verified UHNW Reach',
			)
		);

		$this->add_control(
			'portal_b_tag1',
			array(
				'label'   => __( 'Micro-Tag 1', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'AD & FT Editorial',
			)
		);

		$this->add_control(
			'portal_b_tag2',
			array(
				'label'   => __( 'Micro-Tag 2', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '8K Cinema Direction',
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: 3-MILESTONE VISUAL EDITORIAL CARDS (TIER 2) ──
		$this->start_controls_section(
			'section_milestones',
			array(
				'label' => __( 'Tier 2: Visual Milestone Cards', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'milestones_eyebrow',
			array(
				'label'   => __( 'Milestones Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'DISPOSITION ROADMAP',
			)
		);

		$this->add_control(
			'milestones_title',
			array(
				'label'   => __( 'Milestones Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Strategic Milestones',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'number',
			array(
				'label'   => __( 'Monograph Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => __( 'Milestone Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Asset Valuation & Provenance',
			)
		);

		$repeater->add_control(
			'caption',
			array(
				'label'   => __( '1-Line Caption', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'Historical pedigree appraisal and global off-market capital liquidity analysis.',
			)
		);

		$repeater->add_control(
			'tag',
			array(
				'label'   => __( 'Tag Pill', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'FIDUCIARY AUDIT',
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Milestone Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=900&q=85',
				),
			)
		);

		$this->add_control(
			'milestones',
			array(
				'label'       => __( 'Milestones List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ number }}} — {{{ title }}}',
				'default'     => array(
					array(
						'number'  => '01',
						'title'   => 'Valuation & Provenance',
						'caption' => 'Archival provenance analysis and comparative capital flow audits to establish an optimal liquidity valuation.',
						'tag'     => 'FIDUCIARY APPRAISAL',
						'image'   => array(
							'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=900&q=85',
						),
					),
					array(
						'number'  => '02',
						'title'   => 'Cinema & Monograph PR',
						'caption' => 'Director-led 8K architectural cinematography paired with limited edition hardcover monographs.',
						'tag'     => 'MUSEUM-GRADE MEDIA',
						'image'   => array(
							'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=900&q=85',
						),
					),
					array(
						'number'  => '03',
						'title'   => 'Discreet Blind Settlement',
						'caption' => 'Mandatory proof-of-funds verification, blind entity deed shielding, and fortified international wire escrows.',
						'tag'     => 'ZERO PUBLIC FOOTPRINT',
						'image'   => array(
							'url' => 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=900&q=85',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		$this->start_controls_section(
			'section_style_header',
			array(
				'label' => __( 'Header & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Gold Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide__heading' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// ── Elementor Live Preview Guarantee ──
		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}
		$reveal_class = $is_edit_mode ? 'revealed' : 'reveal';

		$eyebrow        = esc_html( $settings['eyebrow'] ?? 'Estate Disposition Protocol' );
		$heading        = $settings['heading'] ?? 'Curated Estate Disposition';
		$heading_tag    = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$description    = esc_html( $settings['description'] ?? '' );
		$watermark_text = esc_html( $settings['watermark_text'] ?? 'DISPOSITION' );

		$portal_a_img = ! empty( $settings['portal_a_image']['url'] ) ? $settings['portal_a_image']['url'] : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=85';
		$portal_b_img = ! empty( $settings['portal_b_image']['url'] ) ? $settings['portal_b_image']['url'] : 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85';

		$milestones = $settings['milestones'] ?? array();
		?>

		<section class="lre-sguide" aria-label="<?php echo esc_attr( strip_tags( $heading ) ); ?>">

			<!-- Ambient Typographic Watermark -->
			<?php if ( 'yes' === ( $settings['show_watermark'] ?? 'yes' ) ) : ?>
			<div class="lre-sguide__watermark" aria-hidden="true"><?php echo $watermark_text; ?></div>
			<?php endif; ?>

			<div class="lre-sguide__container">

				<!-- ── 1. SECTION HEADER (Curtain Reveal Parity) ── -->
				<header class="lre-sguide__header <?php echo esc_attr( $reveal_class ); ?>">
					<div class="lre-sguide__eyebrow-wrap">
						<span class="lre-sguide__gold-bar" aria-hidden="true"></span>
						<span class="lre-sguide__eyebrow"><?php echo $eyebrow; ?></span>
						<span class="lre-sguide__gold-bar" aria-hidden="true"></span>
					</div>

					<<?php echo $heading_tag; ?> class="lre-sguide__heading">
						<span class="title-mask <?php echo esc_attr( $reveal_class ); ?>">
							<span><?php echo wp_kses( $heading, array( 'br' => array(), 'span' => array( 'class' => array() ) ) ); ?></span>
						</span>
					</<?php echo $heading_tag; ?>>

					<?php if ( ! empty( $description ) ) : ?>
					<p class="lre-sguide__description"><?php echo $description; ?></p>
					<?php endif; ?>
				</header>

				<!-- ── 2. TIER 1: DUAL STRATEGIC PHOTOGRAPHIC PORTALS ── -->
				<div class="lre-sguide__portals-grid <?php echo esc_attr( $reveal_class ); ?>">

					<!-- Portal A: Off-Market Placement -->
					<div class="lre-sguide__portal-card">
						<div class="lre-sguide__portal-bg" style="background-image: url('<?php echo esc_url( $portal_a_img ); ?>');"></div>
						<div class="lre-sguide__portal-overlay" aria-hidden="true"></div>
						<div class="lre-sguide__portal-content">
							<div class="lre-sguide__portal-top">
								<span class="lre-sguide__portal-badge"><?php echo esc_html( $settings['portal_a_badge'] ); ?></span>
								<div class="lre-sguide__portal-metric">
									<strong class="lre-sguide__metric-num"><?php echo esc_html( $settings['portal_a_metric_num'] ); ?></strong>
									<span class="lre-sguide__metric-lbl"><?php echo esc_html( $settings['portal_a_metric_label'] ); ?></span>
								</div>
							</div>
							<h3 class="lre-sguide__portal-title"><?php echo esc_html( $settings['portal_a_title'] ); ?></h3>
							<p class="lre-sguide__portal-sub"><?php echo esc_html( $settings['portal_a_subtitle'] ); ?></p>
							<div class="lre-sguide__portal-tags">
								<span class="lre-sguide__tag-pill"><?php echo esc_html( $settings['portal_a_tag1'] ); ?></span>
								<span class="lre-sguide__tag-pill"><?php echo esc_html( $settings['portal_a_tag2'] ); ?></span>
							</div>
						</div>
					</div>

					<!-- Portal B: Global Narrative Campaign -->
					<div class="lre-sguide__portal-card">
						<div class="lre-sguide__portal-bg" style="background-image: url('<?php echo esc_url( $portal_b_img ); ?>');"></div>
						<div class="lre-sguide__portal-overlay" aria-hidden="true"></div>
						<div class="lre-sguide__portal-content">
							<div class="lre-sguide__portal-top">
								<span class="lre-sguide__portal-badge"><?php echo esc_html( $settings['portal_b_badge'] ); ?></span>
								<div class="lre-sguide__portal-metric">
									<strong class="lre-sguide__metric-num"><?php echo esc_html( $settings['portal_b_metric_num'] ); ?></strong>
									<span class="lre-sguide__metric-lbl"><?php echo esc_html( $settings['portal_b_metric_label'] ); ?></span>
								</div>
							</div>
							<h3 class="lre-sguide__portal-title"><?php echo esc_html( $settings['portal_b_title'] ); ?></h3>
							<p class="lre-sguide__portal-sub"><?php echo esc_html( $settings['portal_b_subtitle'] ); ?></p>
							<div class="lre-sguide__portal-tags">
								<span class="lre-sguide__tag-pill"><?php echo esc_html( $settings['portal_b_tag1'] ); ?></span>
								<span class="lre-sguide__tag-pill"><?php echo esc_html( $settings['portal_b_tag2'] ); ?></span>
							</div>
						</div>
					</div>

				</div><!-- /.lre-sguide__portals-grid -->

				<!-- ── 3. TIER 2: 3-MILESTONE VISUAL EDITORIAL CARDS ── -->
				<?php if ( ! empty( $milestones ) ) : ?>
				<div class="lre-sguide__milestones-section <?php echo esc_attr( $reveal_class ); ?>">
					<div class="lre-sguide__milestones-intro">
						<span class="lre-sguide__milestones-eyebrow"><?php echo esc_html( $settings['milestones_eyebrow'] ); ?></span>
						<h3 class="lre-sguide__milestones-title"><?php echo esc_html( $settings['milestones_title'] ); ?></h3>
					</div>

					<div class="lre-sguide__milestones-grid">
						<?php foreach ( $milestones as $m ) :
							$m_num   = esc_html( $m['number'] ?? '01' );
							$m_titl  = esc_html( $m['title'] ?? '' );
							$m_cap   = esc_html( $m['caption'] ?? '' );
							$m_tag   = esc_html( $m['tag'] ?? '' );
							$m_img   = ! empty( $m['image']['url'] ) ? $m['image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=900&q=85';
						?>
						<div class="lre-sguide__milestone-card">
							<div class="lre-sguide__milestone-thumb">
								<div class="lre-sguide__milestone-img" style="background-image: url('<?php echo esc_url( $m_img ); ?>');"></div>
								<div class="lre-sguide__milestone-overlay" aria-hidden="true"></div>
								<span class="lre-sguide__milestone-num"><?php echo $m_num; ?></span>
								<?php if ( ! empty( $m_tag ) ) : ?>
								<span class="lre-sguide__milestone-tag"><?php echo $m_tag; ?></span>
								<?php endif; ?>
							</div>
							<div class="lre-sguide__milestone-body">
								<h4 class="lre-sguide__milestone-heading"><?php echo $m_titl; ?></h4>
								<p class="lre-sguide__milestone-caption"><?php echo $m_cap; ?></p>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div><!-- /.lre-sguide__milestones-section -->
				<?php endif; ?>

			</div><!-- /.lre-sguide__container -->
		</section>
		<?php
	}
}
