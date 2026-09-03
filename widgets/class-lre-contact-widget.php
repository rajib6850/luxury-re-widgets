<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * LRE_Contact_Widget
 * Ultra-Luxury Contact & Private Advisory Desk Widget.
 * Uniquely designed with signature components aligned to other plugin widgets:
 * ambient watermark, gold-bar eyebrow, monograph chambers, rotating fiduciary seal,
 * trust metrics grid, consultation focus tabs, and signature glass outline button.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Contact_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_contact';
	}

	public function get_title() {
		return __( 'LRE — Luxury Contact & Private Advisory', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-mail';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'contact', 'advisory', 'inquiry', 'fiduciary', 'salon', 'luxury', 'consultation' );
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
				'default'   => 'ADVISORY',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Client Channels',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading (Multi-line / Title Mask)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "Direct Fiduciary Channels &<br>Private Consultation",
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
					'h1'  => 'H1',
					'h2'  => 'H2',
					'h3'  => 'H3',
					'h4'  => 'H4',
					'div' => 'div',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Minimal Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'Discreet representation for off-market acquisitions, estate valuations, and confidential client advisory.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: ADVISORY CHAMBERS (TRIO CARDS) ──
		$this->start_controls_section(
			'section_chambers',
			array(
				'label' => __( 'Advisory Chambers (Top Cards)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'chamber_num',
			array(
				'label'   => __( 'Number Index', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'chamber_tag',
			array(
				'label'   => __( 'Chamber Tag / Category', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'OFF-MARKET DESK',
			)
		);

		$repeater->add_control(
			'chamber_title',
			array(
				'label'   => __( 'Chamber Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Acquisitions & Portfolio Advisory',
			)
		);

		$repeater->add_control(
			'chamber_desc',
			array(
				'label'   => __( 'Chamber Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'Unlisted compounds, coastal acreage, and discreet buyer representation across California and global enclaves.',
			)
		);

		$repeater->add_control(
			'chamber_link_text',
			array(
				'label'   => __( 'Link Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '+1 (310) 895-2400',
			)
		);

		$repeater->add_control(
			'chamber_link_url',
			array(
				'label'   => __( 'Link URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => 'tel:+13108952400' ),
			)
		);

		$this->add_control(
			'chambers',
			array(
				'label'       => __( 'Chamber Cards', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'chamber_num'       => '01',
						'chamber_tag'       => 'OFF-MARKET DESK',
						'chamber_title'     => 'Acquisitions & Portfolio Advisory',
						'chamber_desc'      => 'Unlisted compounds, coastal acreage, and discreet buyer representation across California and global enclaves.',
						'chamber_link_text' => '+1 (310) 895-2400',
						'chamber_link_url'  => array( 'url' => 'tel:+13108952400' ),
					),
					array(
						'chamber_num'       => '02',
						'chamber_tag'       => 'PHYSICAL RESIDENCY',
						'chamber_title'     => 'Beverly Hills Private Salon',
						'chamber_desc'      => '9601 Wilshire Boulevard, Penthouse Suite. Private conference chambers available 24/7 for registered clientele.',
						'chamber_link_text' => 'Coordinates & Hours',
						'chamber_link_url'  => array( 'url' => '#contact-console' ),
					),
					array(
						'chamber_num'       => '03',
						'chamber_tag'       => 'FIDUCIARY VALUATION',
						'chamber_title'     => 'Confidential Estate Valuation',
						'chamber_desc'      => 'Rigorous market assessment and pricing strategy under strict attorney-client level non-disclosure protocols.',
						'chamber_link_text' => 'concierge@platinumrealty.luxury',
						'chamber_link_url'  => array( 'url' => 'mailto:concierge@platinumrealty.luxury' ),
					),
				),
				'title_field' => '{{{ chamber_num }}} — {{{ chamber_title }}}',
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: CONSOLE FIDUCIARY LEDGER (LEFT PANEL) ──
		$this->start_controls_section(
			'section_fiduciary_ledger',
			array(
				'label' => __( 'Fiduciary Pillar (Console Left)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'seal_top',
			array(
				'label'   => __( 'Seal Top Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PRIVATE CLIENT OFFICE',
			)
		);

		$this->add_control(
			'seal_bottom',
			array(
				'label'   => __( 'Seal Bottom Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ESTABLISHED 2012',
			)
		);

		$this->add_control(
			'phone_number',
			array(
				'label'   => __( 'Hotline Phone', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '+1 (310) 895-2400',
			)
		);

		$this->add_control(
			'email_address',
			array(
				'label'   => __( 'Confidential Email', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'concierge@platinumrealty.luxury',
			)
		);

		$this->add_control(
			'metric_1_val',
			array(
				'label'   => __( 'Metric 1 Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '100%',
			)
		);

		$this->add_control(
			'metric_1_lbl',
			array(
				'label'   => __( 'Metric 1 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Discretion Guaranteed',
			)
		);

		$this->add_control(
			'metric_2_val',
			array(
				'label'   => __( 'Metric 2 Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '< 2 Hrs',
			)
		);

		$this->add_control(
			'metric_2_lbl',
			array(
				'label'   => __( 'Metric 2 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Senior Partner Response',
			)
		);

		$this->add_control(
			'metric_3_val',
			array(
				'label'   => __( 'Metric 3 Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '24/7',
			)
		);

		$this->add_control(
			'metric_3_lbl',
			array(
				'label'   => __( 'Metric 3 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Fiduciary Access',
			)
		);

		$this->end_controls_section();

		// ── SECTION 4: INQUIRY BRIEF (RIGHT PANEL) ──
		$this->start_controls_section(
			'section_inquiry_brief',
			array(
				'label' => __( 'Inquiry Brief (Console Right)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'form_title',
			array(
				'label'   => __( 'Form Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Request Private Consultation',
			)
		);

		$this->add_control(
			'form_subtitle',
			array(
				'label'   => __( 'Form Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Select advisory focus and provide direct coordinates for confidential review.',
			)
		);

		$this->add_control(
			'submit_btn_text',
			array(
				'label'   => __( 'Submit Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Transmit Confidential Inquiry',
			)
		);

		$this->add_control(
			'security_note',
			array(
				'label'   => __( 'Security Reassurance Note', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Strict Attorney-Client Level Non-Disclosure Guaranteed',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: SECTION CANVAS ──
		$this->start_controls_section(
			'style_canvas',
			array(
				'label' => __( 'Section & Canvas', 'luxury-re-widgets' ),
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
					'{{WRAPPER}} .lre-contact' => 'background-color: {{VALUE}} !important;',
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
					'top'      => '110',
					'right'    => '20',
					'bottom'   => '110',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: TYPOGRAPHY & COLORS ──
		$this->start_controls_section(
			'style_colors',
			array(
				'label' => __( 'Colors & Accents', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => __( 'Gold Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact' => '--lre-cnt-gold: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Heading Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__title, {{WRAPPER}} .lre-contact__title .title-mask > span, {{WRAPPER}} .lre-contact__title span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag      = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $tag : 'h2';

		// Detect if inside Elementor editor / preview mode
		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}
		$reveal_class = $is_edit_mode ? 'revealed' : 'reveal';

		$chambers = ! empty( $settings['chambers'] ) ? $settings['chambers'] : array();
		$phone_clean = preg_replace( '/[^0-9+]/', '', $settings['phone_number'] ?? '' );
		?>
		<section class="lre-contact" id="contact-advisory" aria-label="<?php esc_attr_e( 'Private Advisory Contact', 'luxury-re-widgets' ); ?>">
			
			<!-- ── 0. AMBIENT BACKGROUND WATERMARK (Parity with About Services / Team) ── -->
			<?php if ( 'yes' === ( $settings['show_watermark'] ?? 'yes' ) && ! empty( $settings['watermark_text'] ) ) : ?>
			<div class="lre-contact__watermark" aria-hidden="true"><?php echo esc_html( $settings['watermark_text'] ); ?></div>
			<?php endif; ?>

			<div class="lre-contact__container">

				<!-- ── 1. SECTION HEADER (Exact Parity with Gold Bar & Eyebrow) ── -->
				<header class="lre-contact__header <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<div class="lre-contact__eyebrow-wrap">
						<span class="lre-contact__gold-bar" aria-hidden="true"></span>
						<span class="lre-contact__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-contact__title">
						<?php
						$heading_raw   = $settings['heading'] ?? "Direct Fiduciary Channels &<br>Private Consultation";
						$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
						$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
						$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
						if ( empty( $heading_lines ) ) {
							$heading_lines = array( $heading_raw );
						}
						foreach ( $heading_lines as $h_idx => $h_line ) : ?>
							<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="lre-contact__description">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
					<?php endif; ?>
				</header>

				<!-- ── 2. UPPER TIER: 3 ADVISORY CHAMBER CARDS (Top Gold Line Parity) ── -->
				<?php if ( ! empty( $chambers ) ) : ?>
				<div class="lre-contact__chambers-grid <?php echo esc_attr( $reveal_class ); ?>">
					<?php foreach ( $chambers as $c_idx => $c ) :
						$c_num  = esc_html( $c['chamber_num'] ?? sprintf( '%02d', $c_idx + 1 ) );
						$c_tag  = esc_html( $c['chamber_tag'] ?? '' );
						$c_titl = esc_html( $c['chamber_title'] ?? '' );
						$c_desc = esc_html( $c['chamber_desc'] ?? '' );
						$c_txt  = esc_html( $c['chamber_link_text'] ?? 'Learn More' );
						$c_url  = ! empty( $c['chamber_link_url']['url'] ) ? esc_url( $c['chamber_link_url']['url'] ) : '#contact-console';
						$c_ext  = ! empty( $c['chamber_link_url']['is_external'] ) ? ' target="_blank"' : '';
					?>
					<div class="lre-contact__chamber-card">
						<div class="lre-contact__chamber-top">
							<span class="lre-contact__chamber-num"><?php echo $c_num; ?></span>
							<?php if ( ! empty( $c_tag ) ) : ?>
							<span class="lre-contact__chamber-tag"><?php echo $c_tag; ?></span>
							<?php endif; ?>
						</div>

						<h3 class="lre-contact__chamber-title"><?php echo $c_titl; ?></h3>
						<p class="lre-contact__chamber-desc"><?php echo $c_desc; ?></p>

						<a href="<?php echo $c_url; ?>" class="lre-contact__chamber-link"<?php echo $c_ext; ?>>
							<span><?php echo $c_txt; ?></span>
							<svg class="lre-contact__chamber-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						</a>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<!-- ── 3. LOWER TIER: THE MASTER CONSULTATION CONSOLE ── -->
				<div class="lre-contact__console <?php echo esc_attr( $reveal_class ); ?>" id="contact-console">
					
					<!-- Left Side: Fiduciary Trust Pillar & Direct Hotline -->
					<div class="lre-contact__fiduciary-pillar">
						
						<!-- Rotating Trust Seal (Reviews Parity) -->
						<div class="lre-contact__seal-wrap">
							<div class="lre-contact__seal-ring">
								<svg class="lre-contact__seal-svg" viewBox="0 0 100 100" width="76" height="76" aria-hidden="true">
									<circle cx="50" cy="50" r="46" fill="none" stroke="rgba(197, 160, 71, 0.35)" stroke-width="1.2" stroke-dasharray="2 3"/>
									<circle cx="50" cy="50" r="41" fill="none" stroke="rgba(197, 160, 71, 0.6)" stroke-width="1"/>
									<polygon points="50,18 59,36 78,39 63,52 68,71 50,60 32,71 37,52 22,39 41,36" fill="none" stroke="#c5a047" stroke-width="1.2" stroke-linejoin="round"/>
									<circle cx="50" cy="50" r="4" fill="#c5a047"/>
								</svg>
							</div>
							<div class="lre-contact__seal-meta">
								<span class="lre-contact__seal-top"><?php echo esc_html( $settings['seal_top'] ); ?></span>
								<span class="lre-contact__seal-bottom"><?php echo esc_html( $settings['seal_bottom'] ); ?></span>
							</div>
						</div>

						<!-- Direct Hotline Wire -->
						<div class="lre-contact__wire-block">
							<span class="lre-contact__wire-label"><?php esc_html_e( 'Direct Fiduciary Line', 'luxury-re-widgets' ); ?></span>
							<a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="lre-contact__wire-phone">
								<?php echo esc_html( $settings['phone_number'] ); ?>
							</a>
							<a href="mailto:<?php echo esc_attr( $settings['email_address'] ); ?>" class="lre-contact__wire-email">
								<?php echo esc_html( $settings['email_address'] ); ?>
							</a>
						</div>

						<!-- Live Trust Metrics Grid (Parity with Reviews) -->
						<div class="lre-contact__metrics-grid">
							<div class="lre-contact__metric-item">
								<span class="lre-contact__metric-val"><?php echo esc_html( $settings['metric_1_val'] ); ?></span>
								<span class="lre-contact__metric-lbl"><?php echo esc_html( $settings['metric_1_lbl'] ); ?></span>
							</div>
							<div class="lre-contact__metric-item">
								<span class="lre-contact__metric-val"><?php echo esc_html( $settings['metric_2_val'] ); ?></span>
								<span class="lre-contact__metric-lbl"><?php echo esc_html( $settings['metric_2_lbl'] ); ?></span>
							</div>
							<div class="lre-contact__metric-item">
								<span class="lre-contact__metric-val"><?php echo esc_html( $settings['metric_3_val'] ); ?></span>
								<span class="lre-contact__metric-lbl"><?php echo esc_html( $settings['metric_3_lbl'] ); ?></span>
							</div>
						</div>

					</div>

					<!-- Right Side: Bespoke Inquiry Dossier Brief -->
					<div class="lre-contact__inquiry-dossier">
						<div class="lre-contact__dossier-inner">
							
							<div class="lre-contact__dossier-header">
								<h3 class="lre-contact__dossier-title"><?php echo esc_html( $settings['form_title'] ); ?></h3>
								<p class="lre-contact__dossier-sub"><?php echo esc_html( $settings['form_subtitle'] ); ?></p>
							</div>

							<form class="lre-contact__form" id="lre-contact-form" action="#" method="post" novalidate>
								
								<!-- Interactive Consultation Focus Tabs -->
								<div class="lre-contact__focus-group">
									<label class="lre-contact__label"><?php esc_html_e( 'Area of Fiduciary Focus', 'luxury-re-widgets' ); ?></label>
									<div class="lre-contact__focus-pills" role="radiogroup">
										<label class="lre-contact__focus-pill">
											<input type="radio" name="advisory_focus" value="acquisition" checked>
											<span><?php esc_html_e( 'Acquisitions', 'luxury-re-widgets' ); ?></span>
										</label>
										<label class="lre-contact__focus-pill">
											<input type="radio" name="advisory_focus" value="listing">
											<span><?php esc_html_e( 'Valuation & Listing', 'luxury-re-widgets' ); ?></span>
										</label>
										<label class="lre-contact__focus-pill">
											<input type="radio" name="advisory_focus" value="off_market">
											<span><?php esc_html_e( 'Off-Market Portfolios', 'luxury-re-widgets' ); ?></span>
										</label>
										<label class="lre-contact__focus-pill">
											<input type="radio" name="advisory_focus" value="salon">
											<span><?php esc_html_e( 'Beverly Hills Salon', 'luxury-re-widgets' ); ?></span>
										</label>
									</div>
								</div>

								<!-- 2 Hairline Form Fields: Name & Contact -->
								<div class="lre-contact__row lre-contact__row--2cols">
									<div class="lre-contact__field">
										<label for="lre-client-name" class="lre-contact__label">
											<?php esc_html_e( 'Full Name', 'luxury-re-widgets' ); ?> <span class="req">*</span>
										</label>
										<input type="text" id="lre-client-name" name="client_name" class="lre-contact__input" placeholder="<?php esc_attr_e( 'e.g. Jonathan Vance', 'luxury-re-widgets' ); ?>" required>
									</div>
									<div class="lre-contact__field">
										<label for="lre-client-contact" class="lre-contact__label">
											<?php esc_html_e( 'Direct Email or Telephone', 'luxury-re-widgets' ); ?> <span class="req">*</span>
										</label>
										<input type="text" id="lre-client-contact" name="client_email" class="lre-contact__input" placeholder="<?php esc_attr_e( 'Direct channel...', 'luxury-re-widgets' ); ?>" required>
									</div>
								</div>

								<!-- Hairline Message Field -->
								<div class="lre-contact__field">
									<label for="lre-client-brief" class="lre-contact__label">
										<?php esc_html_e( 'Confidential Specifications / Portfolio Scope', 'luxury-re-widgets' ); ?>
									</label>
									<textarea id="lre-client-brief" name="client_message" rows="3" class="lre-contact__textarea" placeholder="<?php esc_attr_e( 'Describe your acquisition criteria, desired enclave, or confidential representation needs...', 'luxury-re-widgets' ); ?>"></textarea>
								</div>

								<!-- Signature CTA Outline Button (Exact CTA Parity) -->
								<div class="lre-contact__action-box">
									<button type="submit" class="lre-contact__submit-btn" id="lre-contact-submit">
										<span class="lre-contact__btn-text"><?php echo esc_html( $settings['submit_btn_text'] ); ?></span>
										<span class="lre-contact__btn-line" aria-hidden="true"></span>
										<svg class="lre-contact__btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
											<line x1="5" y1="12" x2="19" y2="12"></line>
											<polyline points="12 5 19 12 12 19"></polyline>
										</svg>
									</button>

									<?php if ( ! empty( $settings['security_note'] ) ) : ?>
									<div class="lre-contact__security-seal">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
											<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
											<path d="M7 11V7a5 5 0 0110 0v4"></path>
										</svg>
										<span><?php echo esc_html( $settings['security_note'] ); ?></span>
									</div>
									<?php endif; ?>
								</div>

								<!-- Success Feedback Overlay -->
								<div class="lre-contact__feedback" id="lre-contact-feedback" style="display: none;">
									<div class="lre-contact__feedback-inner">
										<div class="lre-contact__feedback-icon" aria-hidden="true">
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
												<circle cx="12" cy="12" r="10"></circle>
												<polyline points="9 12 11 14 15 10"></polyline>
											</svg>
										</div>
										<h4 class="lre-contact__feedback-title"><?php esc_html_e( 'Inquiry Delivered with Discretion', 'luxury-re-widgets' ); ?></h4>
										<p class="lre-contact__feedback-text">
											<?php esc_html_e( 'Your dossier has been securely routed to the Managing Partner. Expect discrete correspondence via your preferred channel within two business hours.', 'luxury-re-widgets' ); ?>
										</p>
									</div>
								</div>

							</form>

						</div>
					</div>

				</div>

			</div>
		</section>
		<?php
	}
}
