<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * LRE_Sellers_Guide_Widget
 * Ultra-Luxury Seller's Guide & Estate Disposition Protocol Widget.
 * Engineered for Ultra-High-Net-Worth (UHNW) principals, family offices, and estate trustees.
 *
 * Unique Design Features:
 * - Ambient typographic watermark ("DISPOSITION")
 * - Gold-bar eyebrow and title-mask curtain reveal H2
 * - Dual Divestment Channels: Private Off-Market Placement vs. Global Cinematic Campaign
 * - 4-Stage Asymmetric Strategic Disposition Chronology (2x2 grid with monograph numbers 01-04)
 * - Interactive Valuation Bracket & Discretion Selector Console
 * - Rotating fiduciary seal SVG, metrics bar, and architectural glass outline buttons
 * - 100% Elementor live editor visibility guarantee (zero black screen)
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Sellers_Guide_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_sellers_guide';
	}

	public function get_title() {
		return __( 'LRE — Luxury Seller\'s Guide & Disposition Protocol', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-price-list';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'seller', 'guide', 'protocol', 'disposition', 'divestment', 'luxury', 'fiduciary', 'valuation', 'listing' );
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
				'label'        => __( 'Show Background Watermark', 'luxury-re-widgets' ),
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
				'label'   => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Estate Disposition & Capital Divestment',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading (Multi-line / Title Mask)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "The Sovereign Framework for<br>Trophy Estate Divestment",
				'description' => __( 'Supports <br> tags for smooth title-mask curtain reveal lines matching other sections.', 'luxury-re-widgets' ),
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
					'span' => 'span',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'An institutional-grade marketing and disposition advisory protocol engineered for principals releasing rare architectural and historic residential assets across global capital markets.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: DUAL DIVESTMENT CHANNELS (TIER 1) ──
		$this->start_controls_section(
			'section_channels',
			array(
				'label' => __( '1. Dual Divestment Channels', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Channel A: Off-Market
		$this->add_control(
			'channel_a_heading',
			array(
				'label'     => __( 'Channel A: Private Off-Market', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'ch_a_badge',
			array(
				'label'   => __( 'Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'CONFIDENTIAL PLACEMENT',
			)
		);

		$this->add_control(
			'ch_a_title',
			array(
				'label'   => __( 'Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Off-Market Placement',
			)
		);

		$this->add_control(
			'ch_a_highlight',
			array(
				'label'   => __( 'Strategy Highlight', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '0% Public Footprint | 100% Blind Syndication',
			)
		);

		$this->add_control(
			'ch_a_desc',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Direct syndication restricted exclusively to pre-vetted family offices, institutional trusts, and private billionaire registries. Zero MLS, zero public photography, and mandatory NDA before location disclosure.',
			)
		);

		$this->add_control(
			'ch_a_metric_val',
			array(
				'label'   => __( 'Metric Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '32 Days',
			)
		);

		$this->add_control(
			'ch_a_metric_lbl',
			array(
				'label'   => __( 'Metric Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Average Matched Offer Cycle',
			)
		);

		$this->add_control(
			'ch_a_bullets',
			array(
				'label'   => __( 'Key Pillars (One per line)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => "Direct Sovereign Wealth & Family Office Syndication\nStrict Blind NDA Prior to Coordinate Release\nZero Digital Footprint or Public Portal Exposure",
			)
		);

		// Channel B: Global Campaign
		$this->add_control(
			'channel_b_heading',
			array(
				'label'     => __( 'Channel B: Cinematic Global Campaign', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'ch_b_badge',
			array(
				'label'   => __( 'Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'MAXIMUM GLOBAL PRESTIGE',
			)
		);

		$this->add_control(
			'ch_b_title',
			array(
				'label'   => __( 'Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Cinematic Global Narrative Campaign',
			)
		);

		$this->add_control(
			'ch_b_highlight',
			array(
				'label'   => __( 'Strategy Highlight', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Architectural Press & Private Cinema',
			)
		);

		$this->add_control(
			'ch_b_desc',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Comprehensive narrative architecture deploying 8K cinema trailer films, bespoke editorial monographs, targeted features in Architectural Digest and Financial Times, coupled with private VIP vernissages.',
			)
		);

		$this->add_control(
			'ch_b_metric_val',
			array(
				'label'   => __( 'Metric Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '4.8M+',
			)
		);

		$this->add_control(
			'ch_b_metric_lbl',
			array(
				'label'   => __( 'Metric Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Verified Global UHNW Reach',
			)
		);

		$this->add_control(
			'ch_b_bullets',
			array(
				'label'   => __( 'Key Pillars (One per line)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => "8K Cinema Film & Architectural Drone Direction\nCurated Editorial Features (AD, WSJ, FT)\nPrivate VIP Collector & Family Office Vernissages",
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: 4-STAGE STRATEGIC DISPOSITION CHRONOLOGY (TIER 2) ──
		$this->start_controls_section(
			'section_stages',
			array(
				'label' => __( '2. Disposition Chronology (4 Stages)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$stages_repeater = new Repeater();

		$stages_repeater->add_control(
			'stage_num',
			array(
				'label'   => __( 'Stage Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$stages_repeater->add_control(
			'stage_tag',
			array(
				'label'   => __( 'Stage Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'VALUATION & PROVENANCE',
			)
		);

		$stages_repeater->add_control(
			'stage_title',
			array(
				'label'   => __( 'Stage Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Asset Valuation & Provenance Forensics',
			)
		);

		$stages_repeater->add_control(
			'stage_summary',
			array(
				'label'   => __( 'Strategy Summary', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Archival historical appraisal, structural condition auditing, and comparative off-market capital liquidity analysis to establish optimal pricing strategy.',
			)
		);

		$stages_repeater->add_control(
			'stage_actions',
			array(
				'label'       => __( 'Advisory Protocol Actions (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => "Historical Provenance & Architectural Pedigree Archiving\nComprehensive Capital Flow & Comparable Transaction Audit\nStructural, Mechanical & Land Boundary Pre-Diligence",
				'description' => __( 'Enter each action step on a new line.', 'luxury-re-widgets' ),
			)
		);

		$stages_repeater->add_control(
			'guarantee_text',
			array(
				'label'   => __( 'Seller Fiduciary Guarantee Pill', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'INDEPENDENT FIDUCIARY VALUATION',
			)
		);

		$this->add_control(
			'stages',
			array(
				'label'       => __( 'Chronology Stages', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $stages_repeater->get_controls(),
				'default'     => array(
					array(
						'stage_num'      => '01',
						'stage_tag'      => 'VALUATION & PROVENANCE',
						'stage_title'    => 'Asset Valuation & Provenance Forensics',
						'stage_summary'  => 'Archival historical appraisal, structural condition auditing, and comparative off-market capital liquidity analysis to establish optimal pricing strategy.',
						'stage_actions'  => "Historical Provenance & Architectural Pedigree Archiving\nComprehensive Capital Flow & Comparable Transaction Audit\nStructural, Mechanical & Land Boundary Pre-Diligence",
						'guarantee_text' => 'INDEPENDENT FIDUCIARY VALUATION',
					),
					array(
						'stage_num'      => '02',
						'stage_tag'      => 'NARRATIVE ARCHITECTURE',
						'stage_title'    => 'Cinematic Narrative Engineering',
						'stage_summary'  => 'Bespoke editorial publication, 8K architectural film production, and private monograph creation presenting the estate as an irreplaceable trophy asset.',
						'stage_actions'  => "Bespoke Hardcover Monograph Production (50 Limited Editions)\nDirector-Led 8K Architectural Cinematography\nPrivate Virtual Reality Walkthrough for International Family Offices",
						'guarantee_text' => 'MUSEUM-GRADE ASSET PRESENTATION',
					),
					array(
						'stage_num'      => '03',
						'stage_tag'      => 'INVESTOR QUALIFICATION',
						'stage_title'    => 'Investor Vetting & Private Vernissage',
						'stage_summary'  => 'Rigorous proof of funds verification (minimum $25M liquidity verification) prior to showing, followed by private champagne vernissages for verified principals.',
						'stage_actions'  => "Mandatory Proof of Liquid Capital Pre-Qualification\nExecuted Confidentiality & NDA Verification\nPrivate One-on-One Security Escorted Showings",
						'guarantee_text' => 'ZERO UNVETTED TRAFFIC GUARANTEE',
					),
					array(
						'stage_num'      => '04',
						'stage_tag'      => 'BLIND SETTLEMENT',
						'stage_title'    => 'Contractual Arbitration & Blind Escrow',
						'stage_summary'  => 'Fortified multi-currency wire escrows, deed entity shielding, and attorney-level non-disclosure closing protocols to protect principal privacy post-sale.',
						'stage_actions'  => "Fortified International Wire Escrows & Title Indemnity\nBlind Entity & Anonymous Deed Filing Protocols\nArchitectural Archive & Estate Management Handover",
						'guarantee_text' => 'ZERO PUBLIC FOOTPRINT CLOSING',
					),
				),
				'title_field' => 'Stage {{{ stage_num }}} — {{{ stage_title }}}',
			)
		);

		$this->end_controls_section();

		// ── SECTION 4: CONFIDENTIAL VALUATION INTAKE CONSOLE (TIER 3) ──
		$this->start_controls_section(
			'section_console',
			array(
				'label' => __( '3. Valuation Intake & Advisory Console', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_console',
			array(
				'label'        => __( 'Show Valuation Console', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'seal_top',
			array(
				'label'     => __( 'Seal Top Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'ESTATE DISPOSITION DESK',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'seal_bottom',
			array(
				'label'     => __( 'Seal Bottom Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'ESTABLISHED 2012',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'console_title',
			array(
				'label'     => __( 'Console Heading', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Request a Confidential Estate Valuation Review',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'console_subtitle',
			array(
				'label'     => __( 'Console Subtext', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 3,
				'default'   => 'Select your asset parameters below to receive an executive disposition proposal and private off-market liquidity analysis within 24 hours.',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_text',
			array(
				'label'     => __( 'Primary Button Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Request Valuation Dossier',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_url',
			array(
				'label'       => __( 'Primary Button Link', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://...', 'luxury-re-widgets' ),
				'default'     => array(
					'url' => '#contact',
				),
				'condition'   => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_text',
			array(
				'label'     => __( 'Secondary Link Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Schedule Private Advisory',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_url',
			array(
				'label'       => __( 'Secondary Link URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://...', 'luxury-re-widgets' ),
				'default'     => array(
					'url' => '/contact/',
				),
				'condition'   => array( 'show_console' => 'yes' ),
			)
		);

		// Trust Metrics
		$this->add_control(
			'metric_1_val',
			array(
				'label'     => __( 'Metric 1 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '98.4%',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_1_lbl',
			array(
				'label'     => __( 'Metric 1 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'List-to-Sale Ratio',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_2_val',
			array(
				'label'     => __( 'Metric 2 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '$4.2B+',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_2_lbl',
			array(
				'label'     => __( 'Metric 2 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Trophy Divested Volume',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_3_val',
			array(
				'label'     => __( 'Metric 3 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '100%',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_3_lbl',
			array(
				'label'     => __( 'Metric 3 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'NDA Protection',
				'condition' => array( 'show_console' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => __( 'General Section Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bg_color',
			array(
				'label'     => __( 'Section Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#08080c',
				'selectors' => array(
					'{{WRAPPER}} .lre-sguide' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '120',
					'right'    => '0',
					'bottom'   => '120',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-sguide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Elementor Live Editor visibility guarantee
		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}
		$reveal_class = $is_edit_mode ? 'revealed' : 'reveal';

		$tag = ! empty( $settings['heading_tag'] ) ? esc_attr( $settings['heading_tag'] ) : 'h2';

		// Parse heading lines for title-mask curtain reveal parity
		$heading_raw = ! empty( $settings['heading'] ) ? $settings['heading'] : "The Sovereign Framework for<br>Trophy Estate Divestment";
		$raw_lines   = explode( '<br>', str_replace( array( '<br/>', '<br />' ), '<br>', $heading_raw ) );
		$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
		if ( empty( $heading_lines ) ) {
			$heading_lines = array( $heading_raw );
		}

		$stages = ! empty( $settings['stages'] ) ? $settings['stages'] : array();

		// Channel A Bullets
		$ch_a_bullets = array_filter( array_map( 'trim', explode( "\n", str_replace( "\r", '', $settings['ch_a_bullets'] ?? '' ) ) ) );
		// Channel B Bullets
		$ch_b_bullets = array_filter( array_map( 'trim', explode( "\n", str_replace( "\r", '', $settings['ch_b_bullets'] ?? '' ) ) ) );
		?>
		<section class="lre-sguide" id="estate-disposition" aria-label="<?php esc_attr_e( 'Luxury Estate Disposition Protocol', 'luxury-re-widgets' ); ?>">
			
			<!-- Background Typographic Watermark -->
			<?php if ( 'yes' === $settings['show_watermark'] && ! empty( $settings['watermark_text'] ) ) : ?>
			<div class="lre-sguide__watermark" aria-hidden="true"><?php echo esc_html( $settings['watermark_text'] ); ?></div>
			<?php endif; ?>

			<div class="lre-sguide__container">

				<!-- ── 1. SECTION HEADER (Gold Bar & Title Mask Parity) ── -->
				<header class="lre-sguide__header <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<div class="lre-sguide__eyebrow-wrap">
						<span class="lre-sguide__gold-bar" aria-hidden="true"></span>
						<span class="lre-sguide__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-sguide__heading">
						<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
							<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="lre-sguide__description">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
					<?php endif; ?>
				</header>

				<!-- ── 2. UPPER TIER: DUAL DIVESTMENT CHANNELS (Architectural Glass Monolith) ── -->
				<div class="lre-sguide__channels-monolith <?php echo esc_attr( $reveal_class ); ?>">
					
					<!-- Channel A: Off-Market Placement -->
					<div class="lre-sguide__channel-card lre-sguide__channel-card--offmarket">
						<div class="lre-sguide__channel-top">
							<span class="lre-sguide__channel-badge"><?php echo esc_html( $settings['ch_a_badge'] ); ?></span>
							<span class="lre-sguide__channel-track"><?php esc_html_e( 'Track A', 'luxury-re-widgets' ); ?></span>
						</div>
						<h3 class="lre-sguide__channel-title"><?php echo esc_html( $settings['ch_a_title'] ); ?></h3>
						<div class="lre-sguide__channel-highlight">
							<span class="lre-sguide__highlight-dot"></span>
							<span><?php echo esc_html( $settings['ch_a_highlight'] ); ?></span>
						</div>
						<p class="lre-sguide__channel-desc"><?php echo esc_html( $settings['ch_a_desc'] ); ?></p>
						
						<?php if ( ! empty( $ch_a_bullets ) ) : ?>
						<ul class="lre-sguide__channel-list">
							<?php foreach ( $ch_a_bullets as $b_item ) : ?>
							<li>
								<svg class="lre-sguide__list-icon" viewBox="0 0 20 20" fill="none" width="15" height="15" aria-hidden="true">
									<circle cx="10" cy="10" r="9" stroke="rgba(197, 160, 71, 0.4)" stroke-width="1.2"/>
									<path d="M6 10.2L8.6 13L14 7" stroke="#c5a047" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								<span><?php echo esc_html( $b_item ); ?></span>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>

						<div class="lre-sguide__channel-footer">
							<span class="lre-sguide__ch-metric-val"><?php echo esc_html( $settings['ch_a_metric_val'] ); ?></span>
							<span class="lre-sguide__ch-metric-lbl"><?php echo esc_html( $settings['ch_a_metric_lbl'] ); ?></span>
						</div>
					</div>

					<!-- Central Monogram Divider -->
					<div class="lre-sguide__channels-divider" aria-hidden="true">
						<span class="lre-sguide__divider-line"></span>
						<span class="lre-sguide__divider-crest">VS</span>
						<span class="lre-sguide__divider-line"></span>
					</div>

					<!-- Channel B: Cinematic Global Campaign -->
					<div class="lre-sguide__channel-card lre-sguide__channel-card--global">
						<div class="lre-sguide__channel-top">
							<span class="lre-sguide__channel-badge"><?php echo esc_html( $settings['ch_b_badge'] ); ?></span>
							<span class="lre-sguide__channel-track"><?php esc_html_e( 'Track B', 'luxury-re-widgets' ); ?></span>
						</div>
						<h3 class="lre-sguide__channel-title"><?php echo esc_html( $settings['ch_b_title'] ); ?></h3>
						<div class="lre-sguide__channel-highlight">
							<span class="lre-sguide__highlight-dot"></span>
							<span><?php echo esc_html( $settings['ch_b_highlight'] ); ?></span>
						</div>
						<p class="lre-sguide__channel-desc"><?php echo esc_html( $settings['ch_b_desc'] ); ?></p>
						
						<?php if ( ! empty( $ch_b_bullets ) ) : ?>
						<ul class="lre-sguide__channel-list">
							<?php foreach ( $ch_b_bullets as $b_item ) : ?>
							<li>
								<svg class="lre-sguide__list-icon" viewBox="0 0 20 20" fill="none" width="15" height="15" aria-hidden="true">
									<circle cx="10" cy="10" r="9" stroke="rgba(197, 160, 71, 0.4)" stroke-width="1.2"/>
									<path d="M6 10.2L8.6 13L14 7" stroke="#c5a047" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								<span><?php echo esc_html( $b_item ); ?></span>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>

						<div class="lre-sguide__channel-footer">
							<span class="lre-sguide__ch-metric-val"><?php echo esc_html( $settings['ch_b_metric_val'] ); ?></span>
							<span class="lre-sguide__ch-metric-lbl"><?php echo esc_html( $settings['ch_b_metric_lbl'] ); ?></span>
						</div>
					</div>

				</div>

				<!-- ── 3. MIDDLE TIER: 4-STAGE STRATEGIC DISPOSITION CHRONOLOGY (2x2 Asymmetric Grid) ── -->
				<?php if ( ! empty( $stages ) ) : ?>
				<div class="lre-sguide__chronology-section <?php echo esc_attr( $reveal_class ); ?>">
					<div class="lre-sguide__chronology-header">
						<span class="lre-sguide__chronology-eyebrow"><?php esc_html_e( 'ESTATE DISPOSITION BLUEPRINT', 'luxury-re-widgets' ); ?></span>
						<h3 class="lre-sguide__chronology-title"><?php esc_html_e( 'The Four Milestones of Capital Divestment', 'luxury-re-widgets' ); ?></h3>
					</div>

					<div class="lre-sguide__stages-grid">
						<?php foreach ( $stages as $s_idx => $st ) :
							$num     = esc_html( $st['stage_num'] ?? sprintf( '%02d', $s_idx + 1 ) );
							$tag_t   = esc_html( $st['stage_tag'] ?? '' );
							$titl    = esc_html( $st['stage_title'] ?? '' );
							$summary = esc_html( $st['stage_summary'] ?? '' );
							$guar    = esc_html( $st['guarantee_text'] ?? '' );

							$raw_act = $st['stage_actions'] ?? '';
							$actions = array_filter( array_map( 'trim', explode( "\n", str_replace( "\r", '', $raw_act ) ) ) );
						?>
						<div class="lre-sguide__stage-card">
							<div class="lre-sguide__stage-top">
								<span class="lre-sguide__stage-num"><?php echo $num; ?></span>
								<?php if ( ! empty( $tag_t ) ) : ?>
								<span class="lre-sguide__stage-tag"><?php echo $tag_t; ?></span>
								<?php endif; ?>
							</div>

							<h4 class="lre-sguide__stage-title"><?php echo $titl; ?></h4>
							<p class="lre-sguide__stage-summary"><?php echo $summary; ?></p>

							<?php if ( ! empty( $actions ) ) : ?>
							<ul class="lre-sguide__stage-actions">
								<?php foreach ( $actions as $act_item ) : ?>
								<li>
									<span class="lre-sguide__action-dash" aria-hidden="true">—</span>
									<span><?php echo esc_html( $act_item ); ?></span>
								</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>

							<?php if ( ! empty( $guar ) ) : ?>
							<div class="lre-sguide__stage-guarantee">
								<svg class="lre-sguide__guarantee-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#c5a047" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
								</svg>
								<span><?php echo $guar; ?></span>
							</div>
							<?php endif; ?>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>

				<!-- ── 4. LOWER TIER: CONFIDENTIAL VALUATION & ADVISORY CONSOLE (Master Seller Desk) ── -->
				<?php if ( 'yes' === $settings['show_console'] ) :
					$btn1_url = ! empty( $settings['btn1_url']['url'] ) ? esc_url( $settings['btn1_url']['url'] ) : '#contact';
					$btn1_ext = ! empty( $settings['btn1_url']['is_external'] ) ? ' target="_blank"' : '';
					$btn2_url = ! empty( $settings['btn2_url']['url'] ) ? esc_url( $settings['btn2_url']['url'] ) : '/contact/';
					$btn2_ext = ! empty( $settings['btn2_url']['is_external'] ) ? ' target="_blank"' : '';
				?>
				<div class="lre-sguide__valuation-console <?php echo esc_attr( $reveal_class ); ?>">
					
					<div class="lre-sguide__console-main">
						<!-- Rotating Trust Seal (Reviews, Contact, Buying Guide Parity) -->
						<div class="lre-sguide__seal-wrap">
							<div class="lre-sguide__seal-ring">
								<svg class="lre-sguide__seal-svg" viewBox="0 0 100 100" width="76" height="76" aria-hidden="true">
									<circle cx="50" cy="50" r="46" fill="none" stroke="rgba(197, 160, 71, 0.35)" stroke-width="1.2" stroke-dasharray="2 3"/>
									<circle cx="50" cy="50" r="41" fill="none" stroke="rgba(197, 160, 71, 0.6)" stroke-width="1"/>
									<polygon points="50,18 59,36 78,39 63,52 68,71 50,60 32,71 37,52 22,39 41,36" fill="none" stroke="#c5a047" stroke-width="1.2" stroke-linejoin="round"/>
									<circle cx="50" cy="50" r="4" fill="#c5a047"/>
								</svg>
							</div>
							<div class="lre-sguide__seal-meta">
								<span class="lre-sguide__seal-top"><?php echo esc_html( $settings['seal_top'] ); ?></span>
								<span class="lre-sguide__seal-bottom"><?php echo esc_html( $settings['seal_bottom'] ); ?></span>
							</div>
						</div>

						<div class="lre-sguide__console-content">
							<h3 class="lre-sguide__console-title"><?php echo esc_html( $settings['console_title'] ); ?></h3>
							<p class="lre-sguide__console-desc"><?php echo esc_html( $settings['console_subtitle'] ); ?></p>
							
							<!-- Interactive Valuation Filter Chips -->
							<div class="lre-sguide__selector-group">
								<span class="lre-sguide__selector-label"><?php esc_html_e( 'Target Valuation Range:', 'luxury-re-widgets' ); ?></span>
								<div class="lre-sguide__pills" role="group" aria-label="<?php esc_attr_e( 'Valuation Bracket', 'luxury-re-widgets' ); ?>">
									<button type="button" class="lre-sguide__pill active" data-val="$10M – $25M">$10M – $25M</button>
									<button type="button" class="lre-sguide__pill" data-val="$25M – $50M">$25M – $50M</button>
									<button type="button" class="lre-sguide__pill" data-val="$50M – $100M+">$50M – $100M+</button>
									<button type="button" class="lre-sguide__pill" data-val="Trophy $100M+">Trophy ($100M+)</button>
								</div>
							</div>

							<div class="lre-sguide__selector-group">
								<span class="lre-sguide__selector-label"><?php esc_html_e( 'Preferred Discretion Level:', 'luxury-re-widgets' ); ?></span>
								<div class="lre-sguide__pills" role="group" aria-label="<?php esc_attr_e( 'Discretion Level', 'luxury-re-widgets' ); ?>">
									<button type="button" class="lre-sguide__pill active" data-val="100% Strict Off-Market">100% Strict Off-Market</button>
									<button type="button" class="lre-sguide__pill" data-val="Discreet Pre-Market">Discreet Pre-Market</button>
									<button type="button" class="lre-sguide__pill" data-val="Global PR Campaign">Global PR Campaign</button>
								</div>
							</div>

							<!-- Action Buttons (Architectural Glass Outline Parity) -->
							<div class="lre-sguide__actions">
								<?php if ( ! empty( $settings['btn1_text'] ) ) : ?>
								<a href="<?php echo $btn1_url; ?>" class="lre-sguide__btn-primary"<?php echo $btn1_ext; ?>>
									<span><?php echo esc_html( $settings['btn1_text'] ); ?></span>
									<svg class="lre-sguide__btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</a>
								<?php endif; ?>

								<?php if ( ! empty( $settings['btn2_text'] ) ) : ?>
								<a href="<?php echo $btn2_url; ?>" class="lre-sguide__btn-secondary"<?php echo $btn2_ext; ?>>
									<span><?php echo esc_html( $settings['btn2_text'] ); ?></span>
									<svg class="lre-sguide__btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</a>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<!-- Metrics Grid -->
					<div class="lre-sguide__metrics-grid">
						<div class="lre-sguide__metric-item">
							<span class="lre-sguide__metric-val"><?php echo esc_html( $settings['metric_1_val'] ); ?></span>
							<span class="lre-sguide__metric-lbl"><?php echo esc_html( $settings['metric_1_lbl'] ); ?></span>
						</div>
						<div class="lre-sguide__metric-item">
							<span class="lre-sguide__metric-val"><?php echo esc_html( $settings['metric_2_val'] ); ?></span>
							<span class="lre-sguide__metric-lbl"><?php echo esc_html( $settings['metric_2_lbl'] ); ?></span>
						</div>
						<div class="lre-sguide__metric-item">
							<span class="lre-sguide__metric-val"><?php echo esc_html( $settings['metric_3_val'] ); ?></span>
							<span class="lre-sguide__metric-lbl"><?php echo esc_html( $settings['metric_3_lbl'] ); ?></span>
						</div>
					</div>

				</div>
				<?php endif; ?>

			</div>
		</section>
		<?php
	}
}
