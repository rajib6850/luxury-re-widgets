<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * LRE_Sellers_Guide_Widget
 * True Quiet-Luxury Architectural Estate Disposition Codex Widget.
 * Engineered for Ultra-High-Net-Worth (UHNW) principals, family offices, and estate trustees.
 *
 * Design Characteristics:
 * - Quiet Luxury / Stealth Wealth: Zero loud gold borders or gaudy casino accents.
 * - Deep architectural obsidian & smoked glass background.
 * - Restrained platinum & champagne typography hierarchy.
 * - Tier 1: Dual Sovereign Divestment Pathways (Off-Market Placement vs. Global Press Narrative).
 * - Tier 2: The 4-Stage Architectural Monograph Codex (Asymmetric Split Ledger with Cinematic Viewplates).
 * - 100% Elementor live editor visibility guarantee (zero black box).
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
		return array( 'seller', 'guide', 'disposition', 'estate', 'luxury', 'fiduciary', 'valuation', 'listing', 'codex', 'quiet luxury' );
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
				'label'   => __( 'Section Eyebrow', 'luxury-re-widgets' ),
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
				'default' => 'The Estate Disposition Protocol',
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
				'label'   => __( 'Section Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'A discreet, institutional-grade advisory framework engineered for principals divesting landmark architectural estates across global capital markets.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: DUAL SOVEREIGN PATHWAYS (TIER 1) ──
		$this->start_controls_section(
			'section_pathways',
			array(
				'label' => __( 'Dual Divestment Pathways', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Pathway A
		$this->add_control(
			'path_a_heading',
			array(
				'label'     => __( 'Pathway A (Confidential Placement)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'path_a_pill',
			array(
				'label'   => __( 'Capsule Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'STRICT DISCRETION',
			)
		);

		$this->add_control(
			'path_a_title',
			array(
				'label'   => __( 'Pathway Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Off-Market Syndication',
			)
		);

		$this->add_control(
			'path_a_subtitle',
			array(
				'label'   => __( 'Pathway Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Direct Sovereign Wealth & Family Office Registry Matching',
			)
		);

		$this->add_control(
			'path_a_image',
			array(
				'label'   => __( 'Architectural Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=85',
				),
			)
		);

		$this->add_control(
			'path_a_metric_num',
			array(
				'label'   => __( 'Metric Figure', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '32 Days',
			)
		);

		$this->add_control(
			'path_a_metric_lbl',
			array(
				'label'   => __( 'Metric Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Average Liquidity Cycle',
			)
		);

		$this->add_control(
			'path_a_bullets',
			array(
				'label'       => __( 'Deliverables (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Mandatory Bilateral NDA Prior to Coordinate Release\nDirect Confidential Family Office Placement\n0% Digital Footprint or Public MLS Exposure",
				'description' => __( 'Enter each deliverable bullet on a new line.', 'luxury-re-widgets' ),
			)
		);

		// Pathway B
		$this->add_control(
			'path_b_heading',
			array(
				'label'     => __( 'Pathway B (Global Architectural Narrative)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'path_b_pill',
			array(
				'label'   => __( 'Capsule Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'WORLD STAGE',
			)
		);

		$this->add_control(
			'path_b_title',
			array(
				'label'   => __( 'Pathway Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Global Architectural Narrative',
			)
		);

		$this->add_control(
			'path_b_subtitle',
			array(
				'label'   => __( 'Pathway Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'International Architectural Cinema & Editorial Direction',
			)
		);

		$this->add_control(
			'path_b_image',
			array(
				'label'   => __( 'Architectural Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85',
				),
			)
		);

		$this->add_control(
			'path_b_metric_num',
			array(
				'label'   => __( 'Metric Figure', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '4.8M+',
			)
		);

		$this->add_control(
			'path_b_metric_lbl',
			array(
				'label'   => __( 'Metric Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Verified Global UHNW Reach',
			)
		);

		$this->add_control(
			'path_b_bullets',
			array(
				'label'       => __( 'Deliverables (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Director-Led 8K Cinema & Drone Direction\nClothbound Hardcover Monograph Editions (50 Copies)\nCurated AD & Financial Times Exclusive Embargo",
				'description' => __( 'Enter each deliverable bullet on a new line.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: THE DISPOSITION CODEX (TIER 2) ──
		$this->start_controls_section(
			'section_codex',
			array(
				'label' => __( 'The Disposition Codex (4 Stages)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'codex_eyebrow',
			array(
				'label'   => __( 'Codex Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'DISPOSITION ROADMAP',
			)
		);

		$this->add_control(
			'codex_title',
			array(
				'label'   => __( 'Codex Heading', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Strategic Milestones',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'stage_num',
			array(
				'label'   => __( 'Stage Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'stage_tag',
			array(
				'label'   => __( 'Pillar Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'VALUATION FORENSICS',
			)
		);

		$repeater->add_control(
			'stage_title',
			array(
				'label'   => __( 'Stage Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Asset Valuation & Provenance',
			)
		);

		$repeater->add_control(
			'stage_summary',
			array(
				'label'   => __( 'Brief Summary', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Archival historical appraisal and comparative off-market capital liquidity analysis to establish optimal pricing strategy.',
			)
		);

		$repeater->add_control(
			'stage_image',
			array(
				'label'   => __( 'Architectural Photograph', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000&q=85',
				),
			)
		);

		$repeater->add_control(
			'stage_deliverables',
			array(
				'label'       => __( 'Fiduciary Deliverables (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Archival Provenance & Pedigree Forensics\nIndependent Structural & Acoustic Diligence\nBespoke Global Capital Liquidity Modeling",
				'description' => __( 'Enter each deliverable bullet on a new line.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'stages',
			array(
				'label'       => __( 'Milestone Stages', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'stage_num'          => '01',
						'stage_tag'          => 'VALUATION FORENSICS',
						'stage_title'        => 'Provenance & Capital Modeling',
						'stage_summary'      => 'Archival provenance analysis and comparative off-market capital liquidity audits to establish peak valuation.',
						'stage_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000&q=85' ),
						'stage_deliverables' => "Archival Provenance & Pedigree Forensics\nIndependent Structural & Acoustic Diligence\nBespoke Global Capital Liquidity Modeling",
					),
					array(
						'stage_num'          => '02',
						'stage_tag'          => 'NARRATIVE ARCHITECTURE',
						'stage_title'        => 'Architectural Cinema & Monograph',
						'stage_summary'      => 'Director-led 8K architectural cinema paired with bespoke 50-edition clothbound hardcover monographs.',
						'stage_image'        => array( 'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1000&q=85' ),
						'stage_deliverables' => "Director-Led 8K Architectural Cinematography\nLimited Edition Hardcover Monograph Production\nEditorial Placement in Architectural Digest & FT",
					),
					array(
						'stage_num'          => '03',
						'stage_tag'          => 'INVESTOR QUALIFICATION',
						'stage_title'        => 'Private Twilight Vernissages',
						'stage_summary'      => 'Mandatory proof of liquid capital verification prior to escorted, private security twilight viewings.',
						'stage_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=1000&q=85' ),
						'stage_deliverables' => "Pre-Screened Liquid Capital Verification ($25M+)\nExecuted Bilateral Non-Disclosure Agreements\nSecurity Escorted Diplomatic Twilight Previews",
					),
					array(
						'stage_num'          => '04',
						'stage_tag'          => 'FIDUCIARY SETTLEMENT',
						'stage_title'        => 'Blind Entity Escrow Closing',
						'stage_summary'      => 'Fortified international wire escrows and blind entity deed filings ensuring zero public digital footprint.',
						'stage_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=1000&q=85' ),
						'stage_deliverables' => "Blind Trust & Anonymous Deed Shielding\nFortified International Wire Escrow Settlement\nComplete Architectural Archives & Staff Handover",
					),
				),
				'title_field' => '{{{ stage_num }}} — {{{ stage_title }}}',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag      = in_array( $tag, array( 'h1', 'h2', 'h3', 'div' ), true ) ? $tag : 'h2';

		// Live Editor preview visibility guarantee
		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}
		$reveal_class = $is_edit_mode ? 'revealed' : 'reveal';

		$show_watermark = ( 'yes' === $settings['show_watermark'] );
		$watermark_text = ! empty( $settings['watermark_text'] ) ? $settings['watermark_text'] : 'DISPOSITION';
		$eyebrow        = ! empty( $settings['eyebrow'] ) ? $settings['eyebrow'] : 'Estate Disposition Protocol';
		$heading_raw    = ! empty( $settings['heading'] ) ? $settings['heading'] : 'The Estate Disposition Protocol';
		$description    = ! empty( $settings['description'] ) ? $settings['description'] : '';

		// Split heading lines
		$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
		$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
		$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
		if ( empty( $heading_lines ) ) {
			$heading_lines = array( $heading_raw );
		}

		$stages = ! empty( $settings['stages'] ) ? $settings['stages'] : array();
		?>
		<section class="lre-sguide" id="estate-disposition" aria-label="<?php esc_attr_e( 'Estate Disposition Protocol', 'luxury-re-widgets' ); ?>">

			<?php if ( $show_watermark && ! empty( $watermark_text ) ) : ?>
			<div class="lre-sguide__watermark" aria-hidden="true"><?php echo esc_html( $watermark_text ); ?></div>
			<?php endif; ?>

			<div class="container lre-sguide__container">

				<!-- ── 1. SECTION HEADER (Center-Aligned, Symmetrical Dual Gold Bars) ── -->
				<header class="lre-sguide__header <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $eyebrow ) ) : ?>
					<div class="lre-sguide__eyebrow-wrap">
						<span class="lre-sguide__gold-bar" aria-hidden="true"></span>
						<span class="lre-sguide__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
						<span class="lre-sguide__gold-bar" aria-hidden="true"></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-sguide__title">
						<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
							<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>

					<?php if ( ! empty( $description ) ) : ?>
					<p class="lre-sguide__description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</header>

				<!-- ── 2. TIER 1: DUAL SOVEREIGN PATHWAYS (Quiet-Luxury Architectural Tablets) ── -->
				<div class="lre-sguide__pathways-grid <?php echo esc_attr( $reveal_class ); ?>">

					<!-- Pathway 1: Confidential Off-Market -->
					<article class="lre-sguide__pathway-card">
						<div class="lre-sguide__pathway-media">
							<?php
							$img_a = ! empty( $settings['path_a_image']['url'] ) ? $settings['path_a_image']['url'] : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=85';
							?>
							<img src="<?php echo esc_url( $img_a ); ?>" alt="<?php echo esc_attr( $settings['path_a_title'] ); ?>" loading="lazy" class="lre-sguide__pathway-img">
							<div class="lre-sguide__pathway-scrim"></div>
							<span class="lre-sguide__pathway-pill"><?php echo esc_html( $settings['path_a_pill'] ); ?></span>
						</div>
						<div class="lre-sguide__pathway-body">
							<h3 class="lre-sguide__pathway-title"><?php echo esc_html( $settings['path_a_title'] ); ?></h3>
							<p class="lre-sguide__pathway-subtitle"><?php echo esc_html( $settings['path_a_subtitle'] ); ?></p>
							
							<div class="lre-sguide__pathway-metric-row">
								<span class="lre-sguide__pathway-num"><?php echo esc_html( $settings['path_a_metric_num'] ); ?></span>
								<span class="lre-sguide__pathway-lbl"><?php echo esc_html( $settings['path_a_metric_lbl'] ); ?></span>
							</div>

							<?php
							$bullets_a = ! empty( $settings['path_a_bullets'] ) ? explode( "\n", str_replace( "\r", "", $settings['path_a_bullets'] ) ) : array();
							$bullets_a = array_filter( array_map( 'trim', $bullets_a ) );
							if ( ! empty( $bullets_a ) ) : ?>
							<ul class="lre-sguide__pathway-list" role="list">
								<?php foreach ( $bullets_a as $bullet ) : ?>
								<li>
									<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" class="lre-sguide__check-icon" aria-hidden="true"><path d="M3.5 8.5L6.5 11.5L12.5 4.5"/></svg>
									<span><?php echo esc_html( $bullet ); ?></span>
								</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
					</article>

					<!-- Pathway 2: Global Architectural Narrative -->
					<article class="lre-sguide__pathway-card">
						<div class="lre-sguide__pathway-media">
							<?php
							$img_b = ! empty( $settings['path_b_image']['url'] ) ? $settings['path_b_image']['url'] : 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85';
							?>
							<img src="<?php echo esc_url( $img_b ); ?>" alt="<?php echo esc_attr( $settings['path_b_title'] ); ?>" loading="lazy" class="lre-sguide__pathway-img">
							<div class="lre-sguide__pathway-scrim"></div>
							<span class="lre-sguide__pathway-pill"><?php echo esc_html( $settings['path_b_pill'] ); ?></span>
						</div>
						<div class="lre-sguide__pathway-body">
							<h3 class="lre-sguide__pathway-title"><?php echo esc_html( $settings['path_b_title'] ); ?></h3>
							<p class="lre-sguide__pathway-subtitle"><?php echo esc_html( $settings['path_b_subtitle'] ); ?></p>
							
							<div class="lre-sguide__pathway-metric-row">
								<span class="lre-sguide__pathway-num"><?php echo esc_html( $settings['path_b_metric_num'] ); ?></span>
								<span class="lre-sguide__pathway-lbl"><?php echo esc_html( $settings['path_b_metric_lbl'] ); ?></span>
							</div>

							<?php
							$bullets_b = ! empty( $settings['path_b_bullets'] ) ? explode( "\n", str_replace( "\r", "", $settings['path_b_bullets'] ) ) : array();
							$bullets_b = array_filter( array_map( 'trim', $bullets_b ) );
							if ( ! empty( $bullets_b ) ) : ?>
							<ul class="lre-sguide__pathway-list" role="list">
								<?php foreach ( $bullets_b as $bullet ) : ?>
								<li>
									<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" class="lre-sguide__check-icon" aria-hidden="true"><path d="M3.5 8.5L6.5 11.5L12.5 4.5"/></svg>
									<span><?php echo esc_html( $bullet ); ?></span>
								</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
					</article>

				</div>

				<!-- ── 3. TIER 2: THE DISPOSITION CODEX (Asymmetric Split Ledger) ── -->
				<?php if ( ! empty( $stages ) ) : ?>
				<div class="lre-sguide__codex-section <?php echo esc_attr( $reveal_class ); ?>">
					<div class="lre-sguide__codex-header">
						<?php if ( ! empty( $settings['codex_eyebrow'] ) ) : ?>
						<span class="lre-sguide__codex-eyebrow"><?php echo esc_html( $settings['codex_eyebrow'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $settings['codex_title'] ) ) : ?>
						<h3 class="lre-sguide__codex-title"><?php echo esc_html( $settings['codex_title'] ); ?></h3>
						<?php endif; ?>
					</div>

					<div class="lre-sguide__codex-split" data-codex-wrapper>
						
						<!-- LEFT: Interactive Ledger Nav -->
						<div class="lre-sguide__codex-ledger" role="tablist" aria-label="<?php esc_attr_e( 'Disposition Stages', 'luxury-re-widgets' ); ?>">
							<?php foreach ( $stages as $idx => $stg ) :
								$is_first = ( 0 === $idx );
								$stg_num  = ! empty( $stg['stage_num'] ) ? $stg['stage_num'] : sprintf( '%02d', $idx + 1 );
							?>
							<button type="button" 
							        class="lre-sguide__ledger-item <?php echo $is_first ? 'is-active' : ''; ?>" 
							        role="tab" 
							        aria-selected="<?php echo $is_first ? 'true' : 'false'; ?>" 
							        aria-controls="codex-panel-<?php echo esc_attr( $idx ); ?>" 
							        id="codex-tab-<?php echo esc_attr( $idx ); ?>"
							        data-stage-index="<?php echo esc_attr( $idx ); ?>">
								<div class="lre-sguide__ledger-item-top">
									<span class="lre-sguide__ledger-num"><?php echo esc_html( $stg_num ); ?></span>
									<span class="lre-sguide__ledger-tag"><?php echo esc_html( $stg['stage_tag'] ); ?></span>
								</div>
								<h4 class="lre-sguide__ledger-heading"><?php echo esc_html( $stg['stage_title'] ); ?></h4>
								<span class="lre-sguide__ledger-indicator" aria-hidden="true"></span>
							</button>
							<?php endforeach; ?>
						</div>

						<!-- RIGHT: Dynamic Stage Viewplate Panels -->
						<div class="lre-sguide__codex-viewplate">
							<?php foreach ( $stages as $idx => $stg ) :
								$is_first  = ( 0 === $idx );
								$stg_img   = ! empty( $stg['stage_image']['url'] ) ? $stg['stage_image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000&q=85';
								$stg_deliv = ! empty( $stg['stage_deliverables'] ) ? explode( "\n", str_replace( "\r", "", $stg['stage_deliverables'] ) ) : array();
								$stg_deliv = array_filter( array_map( 'trim', $stg_deliv ) );
							?>
							<div class="lre-sguide__stage-panel <?php echo $is_first ? 'is-active' : ''; ?> <?php echo $is_edit_mode ? 'revealed' : ''; ?>" 
							     id="codex-panel-<?php echo esc_attr( $idx ); ?>" 
							     role="tabpanel" 
							     aria-labelledby="codex-tab-<?php echo esc_attr( $idx ); ?>"
							     data-panel-index="<?php echo esc_attr( $idx ); ?>">
								
								<div class="lre-sguide__stage-figure">
									<img src="<?php echo esc_url( $stg_img ); ?>" alt="<?php echo esc_attr( $stg['stage_title'] ); ?>" loading="lazy" class="lre-sguide__stage-img">
									<div class="lre-sguide__stage-scrim"></div>
									<div class="lre-sguide__stage-caption-box">
										<span class="lre-sguide__stage-caption-num"><?php echo esc_html( $stg['stage_num'] ); ?></span>
										<span class="lre-sguide__stage-caption-tag"><?php echo esc_html( $stg['stage_tag'] ); ?></span>
									</div>
								</div>

								<div class="lre-sguide__stage-meta">
									<h4 class="lre-sguide__stage-title"><?php echo esc_html( $stg['stage_title'] ); ?></h4>
									<p class="lre-sguide__stage-summary"><?php echo esc_html( $stg['stage_summary'] ); ?></p>
									
									<?php if ( ! empty( $stg_deliv ) ) : ?>
									<div class="lre-sguide__stage-deliv-wrap">
										<span class="lre-sguide__stage-deliv-heading"><?php esc_html_e( 'Fiduciary Deliverables', 'luxury-re-widgets' ); ?></span>
										<ul class="lre-sguide__stage-deliv-list" role="list">
											<?php foreach ( $stg_deliv as $deliv_item ) : ?>
											<li>
												<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" class="lre-sguide__check-icon" aria-hidden="true"><path d="M3.5 8.5L6.5 11.5L12.5 4.5"/></svg>
												<span><?php echo esc_html( $deliv_item ); ?></span>
											</li>
											<?php endforeach; ?>
										</ul>
									</div>
									<?php endif; ?>
								</div>

							</div>
							<?php endforeach; ?>
						</div>

					</div>
				</div>
				<?php endif; ?>

			</div>
		</section>
		<?php
	}
}
