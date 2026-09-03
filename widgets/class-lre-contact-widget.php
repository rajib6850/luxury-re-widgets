<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

/**
 * LRE_Contact_Widget
 * Ultra-Luxury Minimalist Contact & Private Advisory Desk Widget.
 * Features architectural inquiry dossier, fiduciary channel directory,
 * exact H2 typography parity, and full Elementor live preview compatibility.
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
		return array( 'contact', 'advisory', 'inquiry', 'fiduciary', 'form', 'luxury', 'concierge' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION 1: HEADER & TYPOGRAPHY ──
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
				'label'       => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Private Advisory & Consultation',
				'placeholder' => __( 'e.g. Private Advisory & Consultation', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading (Multi-line / Title Mask)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "Initiate a Confidential<br>Advisory Dialogue",
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
					'div'  => 'div',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Minimal Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => 'Whether seeking representation for an off-market acquisition or a discreet property valuation, our senior partners are at your disposal.',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: ADVISORY DESK (LEFT COLUMN) ──
		$this->start_controls_section(
			'section_advisory_desk',
			array(
				'label' => __( 'Advisory Desk (Left Pillar)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'salon_badge',
			array(
				'label'   => __( 'Seal / Credential Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Client Office • Est. 2012',
			)
		);

		$this->add_control(
			'salon_name',
			array(
				'label'   => __( 'Salon Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Beverly Hills Executive Salon',
			)
		);

		$this->add_control(
			'salon_address',
			array(
				'label'   => __( 'Physical Address', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => "9601 Wilshire Boulevard, Penthouse Suite\nBeverly Hills, California 90212",
			)
		);

		$this->add_control(
			'salon_phone',
			array(
				'label'   => __( 'Direct Phone', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '+1 (310) 895-2400',
			)
		);

		$this->add_control(
			'salon_email',
			array(
				'label'   => __( 'Confidential Email', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'concierge@platinumrealty.luxury',
			)
		);

		$this->add_control(
			'salon_hours',
			array(
				'label'   => __( 'Hours of Service', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Mon — Sat: 08:00 – 20:00 PST / Private Appointments 24/7',
			)
		);

		$this->add_control(
			'discretion_note',
			array(
				'label'   => __( 'Fiduciary Discretion Commitment', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'All client communications are safeguarded under strict attorney-client level non-disclosure protocols.',
			)
		);

		$this->add_control(
			'territories',
			array(
				'label'   => __( 'Global Territories (Separated by Bullet)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Beverly Hills • Bel Air • Malibu • Pacific Palisades • Aspen • London',
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: INQUIRY DOSSIER FORM (RIGHT COLUMN) ──
		$this->start_controls_section(
			'section_form_settings',
			array(
				'label' => __( 'Inquiry Form (Right Stage)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'form_heading',
			array(
				'label'   => __( 'Form Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Confidential Inquiry Dossier',
			)
		);

		$this->add_control(
			'form_sub',
			array(
				'label'   => __( 'Form Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Provide your details below to coordinate a private discussion.',
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
			'security_badge',
			array(
				'label'   => __( 'Security Reassurance Note', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Guaranteed Off-Market Discretion • Zero Unsolicited Communications',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: SECTION & CANVAS ──
		$this->start_controls_section(
			'style_section',
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
			'style_header',
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
					'{{WRAPPER}} .lre-contact__eyebrow' => 'color: {{VALUE}} !important;',
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

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.65)',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__description' => 'color: {{VALUE}} !important;',
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
		?>
		<section class="lre-contact" id="contact-advisory" aria-label="<?php esc_attr_e( 'Private Advisory Contact', 'luxury-re-widgets' ); ?>">
			<div class="lre-contact__container">

				<!-- ── SECTION HEADER (Matches H2 section titles across plugin) ── -->
				<header class="lre-contact__header <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<span class="section-label lre-contact__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-contact__title">
						<?php
						$heading_raw   = $settings['heading'] ?? "Initiate a Confidential<br>Advisory Dialogue";
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

				<!-- ── TWO-COLUMN ARCHITECTURAL ADVISORY STAGE ── -->
				<div class="lre-contact__stage">

					<!-- ── LEFT COLUMN: THE FIDUCIARY DESK ── -->
					<aside class="lre-contact__desk <?php echo esc_attr( $reveal_class ); ?>">
						<div class="lre-contact__desk-card">
							
							<!-- Badge / Seal -->
							<?php if ( ! empty( $settings['salon_badge'] ) ) : ?>
							<div class="lre-contact__desk-seal">
								<span class="lre-contact__seal-dot" aria-hidden="true"></span>
								<span class="lre-contact__seal-text"><?php echo esc_html( $settings['salon_badge'] ); ?></span>
							</div>
							<?php endif; ?>

							<!-- Salon Title -->
							<?php if ( ! empty( $settings['salon_name'] ) ) : ?>
							<h3 class="lre-contact__salon-title"><?php echo esc_html( $settings['salon_name'] ); ?></h3>
							<?php endif; ?>

							<!-- Channels List -->
							<div class="lre-contact__channels">
								
								<!-- Physical Location -->
								<?php if ( ! empty( $settings['salon_address'] ) ) : ?>
								<div class="lre-contact__channel-item">
									<div class="lre-contact__channel-icon" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
											<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path>
											<circle cx="12" cy="10" r="3"></circle>
										</svg>
									</div>
									<div class="lre-contact__channel-content">
										<span class="lre-contact__channel-label"><?php esc_html_e( 'Headquarters & Salon', 'luxury-re-widgets' ); ?></span>
										<p class="lre-contact__channel-val"><?php echo nl2br( esc_html( $settings['salon_address'] ) ); ?></p>
									</div>
								</div>
								<?php endif; ?>

								<!-- Direct Telephone -->
								<?php if ( ! empty( $settings['salon_phone'] ) ) : ?>
								<div class="lre-contact__channel-item">
									<div class="lre-contact__channel-icon" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
											<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"></path>
										</svg>
									</div>
									<div class="lre-contact__channel-content">
										<span class="lre-contact__channel-label"><?php esc_html_e( 'Direct Advisory Line', 'luxury-re-widgets' ); ?></span>
										<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $settings['salon_phone'] ) ); ?>" class="lre-contact__channel-link">
											<?php echo esc_html( $settings['salon_phone'] ); ?>
										</a>
									</div>
								</div>
								<?php endif; ?>

								<!-- Private Correspondence Email -->
								<?php if ( ! empty( $settings['salon_email'] ) ) : ?>
								<div class="lre-contact__channel-item">
									<div class="lre-contact__channel-icon" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
											<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
											<polyline points="22,6 12,13 2,6"></polyline>
										</svg>
									</div>
									<div class="lre-contact__channel-content">
										<span class="lre-contact__channel-label"><?php esc_html_e( 'Encrypted Correspondence', 'luxury-re-widgets' ); ?></span>
										<a href="mailto:<?php echo esc_attr( $settings['salon_email'] ); ?>" class="lre-contact__channel-link">
											<?php echo esc_html( $settings['salon_email'] ); ?>
										</a>
									</div>
								</div>
								<?php endif; ?>

								<!-- Operating Concierge Hours -->
								<?php if ( ! empty( $settings['salon_hours'] ) ) : ?>
								<div class="lre-contact__channel-item">
									<div class="lre-contact__channel-icon" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
											<circle cx="12" cy="12" r="10"></circle>
											<polyline points="12 6 12 12 16 14"></polyline>
										</svg>
									</div>
									<div class="lre-contact__channel-content">
										<span class="lre-contact__channel-label"><?php esc_html_e( 'Client Service Availability', 'luxury-re-widgets' ); ?></span>
										<p class="lre-contact__channel-val"><?php echo esc_html( $settings['salon_hours'] ); ?></p>
									</div>
								</div>
								<?php endif; ?>

							</div>

							<!-- Fiduciary Discretion Reassurance Box -->
							<?php if ( ! empty( $settings['discretion_note'] ) ) : ?>
							<div class="lre-contact__fiduciary-box">
								<svg class="lre-contact__fiduciary-shield" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
									<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
								</svg>
								<p class="lre-contact__fiduciary-text"><?php echo esc_html( $settings['discretion_note'] ); ?></p>
							</div>
							<?php endif; ?>

							<!-- Territories Strip -->
							<?php if ( ! empty( $settings['territories'] ) ) : ?>
							<div class="lre-contact__territories">
								<span class="lre-contact__territories-label"><?php esc_html_e( 'Covered Territories:', 'luxury-re-widgets' ); ?></span>
								<span class="lre-contact__territories-list"><?php echo esc_html( $settings['territories'] ); ?></span>
							</div>
							<?php endif; ?>

						</div>
					</aside>

					<!-- ── RIGHT COLUMN: BESPOKE INQUIRY DOSSIER FORM ── -->
					<div class="lre-contact__form-wrapper <?php echo esc_attr( $reveal_class ); ?>">
						<div class="lre-contact__form-card">
							
							<div class="lre-contact__form-header">
								<?php if ( ! empty( $settings['form_heading'] ) ) : ?>
								<h3 class="lre-contact__form-title"><?php echo esc_html( $settings['form_heading'] ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $settings['form_sub'] ) ) : ?>
								<p class="lre-contact__form-sub"><?php echo esc_html( $settings['form_sub'] ); ?></p>
								<?php endif; ?>
							</div>

							<form class="lre-contact__form" id="lre-contact-form" action="#" method="post" novalidate>
								
								<!-- Row 1: Full Name & Email -->
								<div class="lre-contact__form-row lre-contact__form-row--2cols">
									<div class="lre-contact__form-group">
										<label for="lre-client-name" class="lre-contact__label">
											<?php esc_html_e( 'Full Name', 'luxury-re-widgets' ); ?> <span class="req">*</span>
										</label>
										<input type="text" id="lre-client-name" name="client_name" class="lre-contact__input" placeholder="<?php esc_attr_e( 'e.g. Jonathan Vance', 'luxury-re-widgets' ); ?>" required>
									</div>
									<div class="lre-contact__form-group">
										<label for="lre-client-email" class="lre-contact__label">
											<?php esc_html_e( 'Direct Email', 'luxury-re-widgets' ); ?> <span class="req">*</span>
										</label>
										<input type="email" id="lre-client-email" name="client_email" class="lre-contact__input" placeholder="<?php esc_attr_e( 'e.g. j.vance@familyoffice.com', 'luxury-re-widgets' ); ?>" required>
									</div>
								</div>

								<!-- Row 2: Phone & Preferred Contact Method -->
								<div class="lre-contact__form-row lre-contact__form-row--2cols">
									<div class="lre-contact__form-group">
										<label for="lre-client-phone" class="lre-contact__label">
											<?php esc_html_e( 'Telephone Number', 'luxury-re-widgets' ); ?> <span class="req">*</span>
										</label>
										<input type="tel" id="lre-client-phone" name="client_phone" class="lre-contact__input" placeholder="<?php esc_attr_e( '+1 (555) 000-0000', 'luxury-re-widgets' ); ?>" required>
									</div>
									<div class="lre-contact__form-group">
										<label for="lre-contact-pref" class="lre-contact__label">
											<?php esc_html_e( 'Preferred Communication', 'luxury-re-widgets' ); ?>
										</label>
										<select id="lre-contact-pref" name="contact_pref" class="lre-contact__select">
											<option value="discreet_call"><?php esc_html_e( 'Direct Telephone Call', 'luxury-re-widgets' ); ?></option>
											<option value="encrypted_email"><?php esc_html_e( 'Confidential Email', 'luxury-re-widgets' ); ?></option>
											<option value="in_person"><?php esc_html_e( 'Private Salon Appointment', 'luxury-re-widgets' ); ?></option>
										</select>
									</div>
								</div>

								<!-- Area of Inquiry (Pill Selectors) -->
								<div class="lre-contact__form-group">
									<label class="lre-contact__label">
										<?php esc_html_e( 'Area of Fiduciary Focus', 'luxury-re-widgets' ); ?>
									</label>
									<div class="lre-contact__pills-group" role="radiogroup">
										<label class="lre-contact__pill">
											<input type="radio" name="inquiry_focus" value="acquisition" checked>
											<span><?php esc_html_e( 'Private Acquisition', 'luxury-re-widgets' ); ?></span>
										</label>
										<label class="lre-contact__pill">
											<input type="radio" name="inquiry_focus" value="listing_valuation">
											<span><?php esc_html_e( 'Estate Listing & Valuation', 'luxury-re-widgets' ); ?></span>
										</label>
										<label class="lre-contact__pill">
											<input type="radio" name="inquiry_focus" value="off_market">
											<span><?php esc_html_e( 'Off-Market Access', 'luxury-re-widgets' ); ?></span>
										</label>
										<label class="lre-contact__pill">
											<input type="radio" name="inquiry_focus" value="advisory">
											<span><?php esc_html_e( 'Architectural Advisory', 'luxury-re-widgets' ); ?></span>
										</label>
									</div>
								</div>

								<!-- Portfolio Scale Selector -->
								<div class="lre-contact__form-group">
									<label class="lre-contact__label">
										<?php esc_html_e( 'Portfolio / Transaction Scale', 'luxury-re-widgets' ); ?>
									</label>
									<div class="lre-contact__pills-group" role="radiogroup">
										<label class="lre-contact__pill">
											<input type="radio" name="portfolio_scale" value="5M_15M">
											<span>$5M – $15M</span>
										</label>
										<label class="lre-contact__pill">
											<input type="radio" name="portfolio_scale" value="15M_30M" checked>
											<span>$15M – $30M</span>
										</label>
										<label class="lre-contact__pill">
											<input type="radio" name="portfolio_scale" value="30M_75M">
											<span>$30M – $75M+</span>
										</label>
										<label class="lre-contact__pill">
											<input type="radio" name="portfolio_scale" value="institutional">
											<span>Institutional / Compound</span>
										</label>
									</div>
								</div>

								<!-- Confidential Message -->
								<div class="lre-contact__form-group">
									<label for="lre-client-message" class="lre-contact__label">
										<?php esc_html_e( 'Confidential Specifications / Brief', 'luxury-re-widgets' ); ?>
									</label>
									<textarea id="lre-client-message" name="client_message" rows="4" class="lre-contact__textarea" placeholder="<?php esc_attr_e( 'Detail your desired architectural style, enclave preferences, or confidential representation needs...', 'luxury-re-widgets' ); ?>"></textarea>
								</div>

								<!-- Submit & Reassurance -->
								<div class="lre-contact__form-footer">
									<button type="submit" class="lre-contact__submit-btn" id="lre-contact-submit">
										<span class="lre-contact__btn-text"><?php echo esc_html( $settings['submit_btn_text'] ?? 'Transmit Confidential Inquiry' ); ?></span>
										<span class="lre-contact__btn-line" aria-hidden="true"></span>
										<svg class="lre-contact__btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
											<line x1="5" y1="12" x2="19" y2="12"></line>
											<polyline points="12 5 19 12 12 19"></polyline>
										</svg>
									</button>

									<?php if ( ! empty( $settings['security_badge'] ) ) : ?>
									<div class="lre-contact__security-reassurance">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
											<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
											<path d="M7 11V7a5 5 0 0110 0v4"></path>
										</svg>
										<span><?php echo esc_html( $settings['security_badge'] ); ?></span>
									</div>
									<?php endif; ?>
								</div>

								<!-- Success Feedback Overlay/Message (Hidden by default) -->
								<div class="lre-contact__feedback" id="lre-contact-feedback" style="display: none;">
									<div class="lre-contact__feedback-inner">
										<div class="lre-contact__feedback-icon" aria-hidden="true">
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
												<circle cx="12" cy="12" r="10"></circle>
												<polyline points="9 12 11 14 15 10"></polyline>
											</svg>
										</div>
										<h4 class="lre-contact__feedback-title"><?php esc_html_e( 'Inquiry Transmitted with Discretion', 'luxury-re-widgets' ); ?></h4>
										<p class="lre-contact__feedback-text">
											<?php esc_html_e( 'Your dossier has been securely delivered to the Managing Partner. A confidential response will follow via your preferred communication channel within two business hours.', 'luxury-re-widgets' ); ?>
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
