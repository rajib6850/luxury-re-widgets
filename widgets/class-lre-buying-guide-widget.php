<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * LRE_Buying_Guide_Widget
 * Ultra-Luxury Buying Guide & Strategic Acquisition Protocol Widget.
 * Engineered for Ultra-High-Net-Worth (UHNW) buyers, family offices, and discreet investors.
 *
 * Designed with signature luxury component parity:
 * - Ambient typography watermark ("ACQUISITION")
 * - Gold-bar eyebrow and title-mask curtain reveal H2
 * - Top gold accent border cards with serif monograph numbering (01, 02, 03, 04)
 * - Interactive 4-phase strategic acquisition roadmap console
 * - Fiduciary seal SVG, live metrics bar, and architectural glass outline buttons
 * - 100% Elementor live editor visibility guarantee (zero black screen)
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Buying_Guide_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_buying_guide';
	}

	public function get_title() {
		return __( 'LRE — Luxury Buying Guide & Protocol', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'buying', 'guide', 'protocol', 'acquisition', 'luxury', 'fiduciary', 'advisory', 'roadmap' );
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
				'default'   => 'ACQUISITION',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Acquisition Protocol & Private Advisory',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading (Multi-line / Title Mask)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "The Sovereign Guide to<br>Ultra-Prime Property Acquisition",
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
				'default' => 'A confidential advisory framework engineered exclusively for principals, family offices, and discreet investors acquiring trophy residential assets across prime global markets.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: 3 FIDUCIARY PRINCIPLES (UPPER CARDS) ──
		$this->start_controls_section(
			'section_principles',
			array(
				'label' => __( '1. Fiduciary Principles (3 Pillars)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$principles_repeater = new Repeater();

		$principles_repeater->add_control(
			'principle_num',
			array(
				'label'   => __( 'Monograph Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$principles_repeater->add_control(
			'principle_tag',
			array(
				'label'   => __( 'Pillar Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'FIDUCIARY ALLEGIANCE',
			)
		);

		$principles_repeater->add_control(
			'principle_title',
			array(
				'label'   => __( 'Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Exclusive Client Representation',
			)
		);

		$principles_repeater->add_control(
			'principle_desc',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Single-agency representation with 100% fiduciary allegiance committed exclusively to the buyer, eliminating dual-agency conflicts of interest.',
			)
		);

		$this->add_control(
			'principles',
			array(
				'label'       => __( 'Principles List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $principles_repeater->get_controls(),
				'default'     => array(
					array(
						'principle_num'   => '01',
						'principle_tag'   => 'FIDUCIARY ALLEGIANCE',
						'principle_title' => 'Exclusive Client Representation',
						'principle_desc'  => 'Single-agency representation with 100% fiduciary allegiance committed exclusively to the buyer, eliminating dual-agency conflicts of interest.',
					),
					array(
						'principle_num'   => '02',
						'principle_tag'   => 'OFF-MARKET MONOPOLY',
						'principle_title' => 'Private Pocket Inventory',
						'principle_desc'  => 'Direct access to unlisted trophy estates and confidential family office syndicates. Over 68% of our transactions never touch public real estate portals.',
					),
					array(
						'principle_num'   => '03',
						'principle_tag'   => 'IDENTITY SHIELDING',
						'principle_title' => 'Uncompromising Discretion & NDA',
						'principle_desc'  => 'Rigorous confidentiality protocols, non-disclosure compliance, and private acquisition structuring for international investors and public figures.',
					),
				),
				'title_field' => '{{{ principle_num }}} — {{{ principle_title }}}',
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: 4 STRATEGIC ACQUISITION PHASES (ROADMAP) ──
		$this->start_controls_section(
			'section_phases',
			array(
				'label' => __( '2. Strategic Acquisition Phases (4 Milestones)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$phases_repeater = new Repeater();

		$phases_repeater->add_control(
			'phase_num',
			array(
				'label'   => __( 'Phase Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$phases_repeater->add_control(
			'phase_nav_title',
			array(
				'label'   => __( 'Navigation Tab Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Discovery & Mandate',
			)
		);

		$phases_repeater->add_control(
			'phase_tag',
			array(
				'label'   => __( 'Stage Tag / Category', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'CONFIDENTIAL DISCOVERY',
			)
		);

		$phases_repeater->add_control(
			'phase_title',
			array(
				'label'   => __( 'Full Phase Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Mandate & Off-Market Sourcing',
			)
		);

		$phases_repeater->add_control(
			'phase_summary',
			array(
				'label'   => __( 'Executive Summary', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Direct engagement establishing bespoke architectural criteria, capital allocation models, and immediate activation across private seller networks.',
			)
		);

		$phases_repeater->add_control(
			'phase_deliverables',
			array(
				'label'       => __( 'Advisory Deliverables (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => "Bespoke Architectural & Lifestyle Specification Audit\nDirect Access to Private Pocket & Unlisted Inventory\nMutual NDA & Fiduciary Blind Sourcing Protocol\nGlobal Capital Flow & Currency Positioning Advisory",
				'description' => __( 'Enter each deliverable milestone on a separate line.', 'luxury-re-widgets' ),
			)
		);

		$phases_repeater->add_control(
			'protocol_badge',
			array(
				'label'   => __( 'Protocol Badge Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'STRICT BUYER ANONYMITY',
			)
		);

		$phases_repeater->add_control(
			'protocol_note',
			array(
				'label'   => __( 'Confidentiality Protocol Note', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'All initial property inquiries and discreet walk-throughs are executed under strict blind confidentiality agreements.',
			)
		);

		$this->add_control(
			'phases',
			array(
				'label'       => __( 'Acquisition Phases', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $phases_repeater->get_controls(),
				'default'     => array(
					array(
						'phase_num'          => '01',
						'phase_nav_title'    => 'Discovery & Mandate',
						'phase_tag'          => 'CONFIDENTIAL DISCOVERY',
						'phase_title'        => 'Private Mandate & Off-Market Sourcing',
						'phase_summary'      => 'Direct engagement establishing bespoke architectural criteria, capital allocation models, and immediate activation across private seller networks.',
						'phase_deliverables' => "Bespoke Architectural & Lifestyle Specification Audit\nDirect Access to Private Pocket & Unlisted Inventory\nMutual NDA & Fiduciary Blind Sourcing Protocol\nGlobal Capital Flow & Currency Positioning Advisory",
						'protocol_badge'     => 'STRICT BUYER ANONYMITY',
						'protocol_note'      => 'All initial property inquiries and discreet walk-throughs are executed under strict blind confidentiality agreements.',
					),
					array(
						'phase_num'          => '02',
						'phase_nav_title'    => 'Valuation & Structuring',
						'phase_tag'          => 'FINANCIAL & LEGAL STRUCTURING',
						'phase_title'        => 'Strategic Valuation & Privacy Architecture',
						'phase_summary'      => 'Quantitative asset valuation auditing combined with bespoke legal structures designed specifically for domestic and international family offices.',
						'phase_deliverables' => "Comparative Private Capital & Recent Off-Market Comps\nAnonymized Blind Trust & LLC Escrow Architecture\nCross-Border Tax Counsel & Capital Flow Coordination\nAsset Liquidity & Sovereign Wealth Allocation Review",
						'protocol_badge'     => 'ENTITY SHIELDING ASSURED',
						'protocol_note'      => 'Purchase entities, earnest deposit accounts, and transactional documentation are structured to keep principal identities unsearchable on public deeds.',
					),
					array(
						'phase_num'          => '03',
						'phase_nav_title'    => 'Forensic Diligence',
						'phase_tag'          => 'FORENSIC AUDIT',
						'phase_title'        => 'Architectural Forensics & Estate Diligence',
						'phase_summary'      => 'Multi-disciplinary engineering, zoning, environmental, and private airspace/maritime boundary audits conducted prior to binding contractual offers.',
						'phase_deliverables' => "Structural, Geological & Foundation Engineering Audit\nHistorical Provenance, Landmark & Coastal Boundary Review\nHelipad, Deepwater Dockage & Security Boundary Feasibility\nMechanical, Smart Home & Geothermal System Assessment",
						'protocol_badge'     => 'UNBIASED TECHNICAL AUDIT',
						'protocol_note'      => 'Diligence teams report solely to buyer counsel, maintaining an uncompromised standard of physical and regulatory verification.',
					),
					array(
						'phase_num'          => '04',
						'phase_nav_title'    => 'Private Settlement',
						'phase_tag'          => 'SETTLEMENT & TRANSITION',
						'phase_title'        => 'Private Settlement & Bespoke Concierge',
						'phase_summary'      => 'Flawless closing execution featuring fortified wire escrows, deed record shielding, and immediate white-glove estate transition management.',
						'phase_deliverables' => "Secured International Escrow & Multi-Currency Settlement\nTitle Insurance Indemnification & Blind Record Filing\nWhite-Glove Handover & Architectural Archive Transfer\nPrivate Security, Domestic Staff & Estate Management Onboarding",
						'protocol_badge'     => 'FIDUCIARY CLOSING GUARANTEE',
						'protocol_note'      => 'Closing documentation is archived in encrypted physical and digital vaults, ensuring zero public exposure post-transaction.',
					),
				),
				'title_field' => 'Phase {{{ phase_num }}} — {{{ phase_nav_title }}}',
			)
		);

		$this->end_controls_section();

		// ── SECTION 4: PRIVATE ACQUISITION DOSSIER CONSOLE ──
		$this->start_controls_section(
			'section_dossier',
			array(
				'label' => __( '3. Private Dossier Console & Actions', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_dossier_card',
			array(
				'label'        => __( 'Show Dossier Card', 'luxury-re-widgets' ),
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
				'default'   => 'PRIVATE CLIENT OFFICE',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'seal_bottom',
			array(
				'label'     => __( 'Seal Bottom Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'ESTABLISHED 2012',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'dossier_title',
			array(
				'label'     => __( 'Dossier Heading', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Request the Private Acquisition Monograph (2026 Edition)',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'dossier_subtitle',
			array(
				'label'     => __( 'Dossier Subtext', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 3,
				'default'   => 'A confidential 48-page monograph detailing off-market transaction metrics, tax entity considerations, and discreet contract structures for eight-figure acquisitions.',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_text',
			array(
				'label'     => __( 'Primary Button Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Request Acquisition Dossier',
				'condition' => array( 'show_dossier_card' => 'yes' ),
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
				'condition'   => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_text',
			array(
				'label'     => __( 'Secondary Link Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Consult Advisory Desk',
				'condition' => array( 'show_dossier_card' => 'yes' ),
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
				'condition'   => array( 'show_dossier_card' => 'yes' ),
			)
		);

		// Trust Metrics Bar
		$this->add_control(
			'metric_1_val',
			array(
				'label'     => __( 'Metric 1 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '100%',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_1_lbl',
			array(
				'label'     => __( 'Metric 1 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Discretion Guaranteed',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_2_val',
			array(
				'label'     => __( 'Metric 2 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '$4.2B+',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_2_lbl',
			array(
				'label'     => __( 'Metric 2 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Curated Volume',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_3_val',
			array(
				'label'     => __( 'Metric 3 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '14 Days',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->add_control(
			'metric_3_lbl',
			array(
				'label'     => __( 'Metric 3 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Private Sourcing Cycle',
				'condition' => array( 'show_dossier_card' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── SECTION: SECTION STYLE ──
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
					'{{WRAPPER}} .lre-guide' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .lre-guide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Check Elementor editor mode to guarantee visibility without waiting for scroll reveals
		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}
		$reveal_class = $is_edit_mode ? 'revealed' : 'reveal';

		$tag = ! empty( $settings['heading_tag'] ) ? esc_attr( $settings['heading_tag'] ) : 'h2';

		// Parse heading lines for title-mask curtain reveal parity
		$heading_raw = ! empty( $settings['heading'] ) ? $settings['heading'] : "The Sovereign Guide to<br>Ultra-Prime Property Acquisition";
		$raw_lines   = explode( '<br>', str_replace( array( '<br/>', '<br />' ), '<br>', $heading_raw ) );
		$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
		if ( empty( $heading_lines ) ) {
			$heading_lines = array( $heading_raw );
		}

		$principles = ! empty( $settings['principles'] ) ? $settings['principles'] : array();
		$phases     = ! empty( $settings['phases'] ) ? $settings['phases'] : array();
		?>
		<section class="lre-guide" id="acquisition-protocol" aria-label="<?php esc_attr_e( 'Luxury Acquisition Protocol', 'luxury-re-widgets' ); ?>">
			
			<!-- Background Typographic Watermark -->
			<?php if ( 'yes' === $settings['show_watermark'] && ! empty( $settings['watermark_text'] ) ) : ?>
			<div class="lre-guide__watermark" aria-hidden="true"><?php echo esc_html( $settings['watermark_text'] ); ?></div>
			<?php endif; ?>

			<div class="lre-guide__container">

				<!-- ── 1. SECTION HEADER (Gold Bar & Title-Mask Parity) ── -->
				<header class="lre-guide__header <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<div class="lre-guide__eyebrow-wrap">
						<span class="lre-guide__gold-bar" aria-hidden="true"></span>
						<span class="lre-guide__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-guide__heading">
						<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
							<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="lre-guide__description">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
					<?php endif; ?>
				</header>

				<!-- ── 2. UPPER TIER: 3 FIDUCIARY PRINCIPLES (Top Gold Border Cards) ── -->
				<?php if ( ! empty( $principles ) ) : ?>
				<div class="lre-guide__principles-grid <?php echo esc_attr( $reveal_class ); ?>">
					<?php foreach ( $principles as $p_idx => $p ) :
						$p_num  = esc_html( $p['principle_num'] ?? sprintf( '%02d', $p_idx + 1 ) );
						$p_tag  = esc_html( $p['principle_tag'] ?? '' );
						$p_titl = esc_html( $p['principle_title'] ?? '' );
						$p_desc = esc_html( $p['principle_desc'] ?? '' );
					?>
					<div class="lre-guide__principle-card">
						<div class="lre-guide__principle-top">
							<span class="lre-guide__principle-num"><?php echo $p_num; ?></span>
							<?php if ( ! empty( $p_tag ) ) : ?>
							<span class="lre-guide__principle-tag"><?php echo $p_tag; ?></span>
							<?php endif; ?>
						</div>
						<h3 class="lre-guide__principle-title"><?php echo $p_titl; ?></h3>
						<p class="lre-guide__principle-desc"><?php echo $p_desc; ?></p>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<!-- ── 3. MIDDLE TIER: THE 4 STRATEGIC ACQUISITION PHASES ROADMAP ── -->
				<?php if ( ! empty( $phases ) ) : ?>
				<div class="lre-guide__roadmap <?php echo esc_attr( $reveal_class ); ?>" id="acquisition-roadmap">
					
					<!-- Roadmap Stage Navigator Tabs -->
					<div class="lre-guide__nav" role="tablist" aria-label="<?php esc_attr_e( 'Acquisition Phases', 'luxury-re-widgets' ); ?>">
						<?php foreach ( $phases as $idx => $ph ) :
							$num      = esc_html( $ph['phase_num'] ?? sprintf( '%02d', $idx + 1 ) );
							$nav_titl = esc_html( $ph['phase_nav_title'] ?? ( 'Phase ' . $num ) );
							$is_active = ( 0 === $idx );
						?>
						<button type="button" 
						        class="lre-guide__nav-btn <?php echo $is_active ? 'active' : ''; ?>" 
						        role="tab" 
						        aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>" 
						        aria-controls="phase-chamber-<?php echo esc_attr( $idx ); ?>" 
						        id="phase-tab-<?php echo esc_attr( $idx ); ?>"
						        data-phase-index="<?php echo esc_attr( $idx ); ?>">
							<span class="lre-guide__nav-num"><?php echo $num; ?></span>
							<span class="lre-guide__nav-text"><?php echo $nav_titl; ?></span>
							<span class="lre-guide__nav-indicator" aria-hidden="true"></span>
						</button>
						<?php endforeach; ?>
					</div>

					<!-- Roadmap Detail Chambers Container -->
					<div class="lre-guide__chambers">
						<?php foreach ( $phases as $idx => $ph ) :
							$num          = esc_html( $ph['phase_num'] ?? sprintf( '%02d', $idx + 1 ) );
							$tag_text     = esc_html( $ph['phase_tag'] ?? '' );
							$full_title   = esc_html( $ph['phase_title'] ?? '' );
							$summary      = esc_html( $ph['phase_summary'] ?? '' );
							$badge        = esc_html( $ph['protocol_badge'] ?? 'FIDUCIARY STANDARD' );
							$note         = esc_html( $ph['protocol_note'] ?? '' );
							$is_active    = ( 0 === $idx );

							// Parse deliverables checklist
							$raw_deliv    = $ph['phase_deliverables'] ?? '';
							$deliverables = array_filter( array_map( 'trim', explode( "\n", str_replace( "\r", '', $raw_deliv ) ) ) );
						?>
						<div class="lre-guide__chamber <?php echo $is_active ? 'active' : ''; ?>" 
						     id="phase-chamber-<?php echo esc_attr( $idx ); ?>" 
						     role="tabpanel" 
						     aria-labelledby="phase-tab-<?php echo esc_attr( $idx ); ?>"
						     data-phase-panel="<?php echo esc_attr( $idx ); ?>">
							
							<!-- Chamber Header -->
							<div class="lre-guide__chamber-header">
								<div class="lre-guide__chamber-meta">
									<span class="lre-guide__chamber-num"><?php echo $num; ?></span>
									<?php if ( ! empty( $tag_text ) ) : ?>
									<span class="lre-guide__chamber-tag"><?php echo $tag_text; ?></span>
									<?php endif; ?>
								</div>
								<h3 class="lre-guide__chamber-title"><?php echo $full_title; ?></h3>
								<p class="lre-guide__chamber-summary"><?php echo $summary; ?></p>
							</div>

							<!-- Chamber Content Grid: Deliverables Checklist + Protocol Callout -->
							<div class="lre-guide__chamber-body">
								
								<?php if ( ! empty( $deliverables ) ) : ?>
								<div class="lre-guide__deliverables-block">
									<h4 class="lre-guide__block-heading">
										<span class="lre-guide__block-dot"></span>
										<?php esc_html_e( 'Key Advisory Deliverables', 'luxury-re-widgets' ); ?>
									</h4>
									<ul class="lre-guide__checklist">
										<?php foreach ( $deliverables as $deliv_item ) : ?>
										<li class="lre-guide__checklist-item">
											<span class="lre-guide__check-icon" aria-hidden="true">
												<svg viewBox="0 0 20 20" fill="none" width="16" height="16">
													<circle cx="10" cy="10" r="9" stroke="rgba(197, 160, 71, 0.4)" stroke-width="1.2"/>
													<path d="M6 10.2L8.6 13L14 7" stroke="#c5a047" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</span>
											<span class="lre-guide__checklist-text"><?php echo esc_html( $deliv_item ); ?></span>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
								<?php endif; ?>

								<!-- Protocol & Discretion Note Callout -->
								<div class="lre-guide__protocol-card">
									<div class="lre-guide__protocol-top">
										<svg class="lre-guide__protocol-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#c5a047" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
											<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
											<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
										</svg>
										<span class="lre-guide__protocol-badge"><?php echo $badge; ?></span>
									</div>
									<p class="lre-guide__protocol-note"><?php echo $note; ?></p>
								</div>

							</div>

						</div>
						<?php endforeach; ?>
					</div>

				</div>
				<?php endif; ?>

				<!-- ── 4. LOWER TIER: THE PRIVATE ACQUISITION DOSSIER CONSOLE ── -->
				<?php if ( 'yes' === $settings['show_dossier_card'] ) :
					$btn1_url = ! empty( $settings['btn1_url']['url'] ) ? esc_url( $settings['btn1_url']['url'] ) : '#contact';
					$btn1_ext = ! empty( $settings['btn1_url']['is_external'] ) ? ' target="_blank"' : '';
					$btn2_url = ! empty( $settings['btn2_url']['url'] ) ? esc_url( $settings['btn2_url']['url'] ) : '/contact/';
					$btn2_ext = ! empty( $settings['btn2_url']['is_external'] ) ? ' target="_blank"' : '';
				?>
				<div class="lre-guide__dossier-console <?php echo esc_attr( $reveal_class ); ?>">
					
					<!-- Left / Upper: Rotating Fiduciary Seal & Dossier Overview -->
					<div class="lre-guide__dossier-main">
						
						<!-- Rotating Trust Seal (Reviews & Contact Parity) -->
						<div class="lre-guide__seal-wrap">
							<div class="lre-guide__seal-ring">
								<svg class="lre-guide__seal-svg" viewBox="0 0 100 100" width="76" height="76" aria-hidden="true">
									<circle cx="50" cy="50" r="46" fill="none" stroke="rgba(197, 160, 71, 0.35)" stroke-width="1.2" stroke-dasharray="2 3"/>
									<circle cx="50" cy="50" r="41" fill="none" stroke="rgba(197, 160, 71, 0.6)" stroke-width="1"/>
									<polygon points="50,18 59,36 78,39 63,52 68,71 50,60 32,71 37,52 22,39 41,36" fill="none" stroke="#c5a047" stroke-width="1.2" stroke-linejoin="round"/>
									<circle cx="50" cy="50" r="4" fill="#c5a047"/>
								</svg>
							</div>
							<div class="lre-guide__seal-meta">
								<span class="lre-guide__seal-top"><?php echo esc_html( $settings['seal_top'] ); ?></span>
								<span class="lre-guide__seal-bottom"><?php echo esc_html( $settings['seal_bottom'] ); ?></span>
							</div>
						</div>

						<!-- Dossier Monograph Briefing -->
						<div class="lre-guide__dossier-content">
							<h3 class="lre-guide__dossier-title"><?php echo esc_html( $settings['dossier_title'] ); ?></h3>
							<p class="lre-guide__dossier-desc"><?php echo esc_html( $settings['dossier_subtitle'] ); ?></p>
							
							<!-- Action Buttons (Architectural Glass Outline Parity) -->
							<div class="lre-guide__actions">
								<?php if ( ! empty( $settings['btn1_text'] ) ) : ?>
								<a href="<?php echo $btn1_url; ?>" class="lre-guide__btn-primary"<?php echo $btn1_ext; ?>>
									<span><?php echo esc_html( $settings['btn1_text'] ); ?></span>
									<svg class="lre-guide__btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</a>
								<?php endif; ?>

								<?php if ( ! empty( $settings['btn2_text'] ) ) : ?>
								<a href="<?php echo $btn2_url; ?>" class="lre-guide__btn-secondary"<?php echo $btn2_ext; ?>>
									<span><?php echo esc_html( $settings['btn2_text'] ); ?></span>
									<svg class="lre-guide__btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</a>
								<?php endif; ?>
							</div>
						</div>

					</div>

					<!-- Right / Lower: Live Trust Metrics Grid (Reviews Parity) -->
					<div class="lre-guide__metrics-grid">
						<div class="lre-guide__metric-item">
							<span class="lre-guide__metric-val"><?php echo esc_html( $settings['metric_1_val'] ); ?></span>
							<span class="lre-guide__metric-lbl"><?php echo esc_html( $settings['metric_1_lbl'] ); ?></span>
						</div>
						<div class="lre-guide__metric-item">
							<span class="lre-guide__metric-val"><?php echo esc_html( $settings['metric_2_val'] ); ?></span>
							<span class="lre-guide__metric-lbl"><?php echo esc_html( $settings['metric_2_lbl'] ); ?></span>
						</div>
						<div class="lre-guide__metric-item">
							<span class="lre-guide__metric-val"><?php echo esc_html( $settings['metric_3_val'] ); ?></span>
							<span class="lre-guide__metric-lbl"><?php echo esc_html( $settings['metric_3_lbl'] ); ?></span>
						</div>
					</div>

				</div>
				<?php endif; ?>

			</div>
		</section>
		<?php
	}
}
