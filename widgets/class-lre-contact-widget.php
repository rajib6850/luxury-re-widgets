<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * LRE_Contact_Widget
 * Ultra-Luxury Minimalist Contact & Private Advisory Desk Widget.
 * Pure editorial elegance, zero form clutter, architectural visual salon frame,
 * and exact H2 section title parity.
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
		return array( 'contact', 'advisory', 'inquiry', 'minimal', 'luxury', 'fiduciary', 'consultation' );
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
				'label'   => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Client Services',
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
				'default' => 'Discreet representation for off-market acquisitions, private valuations, and confidential client advisory.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: ARCHITECTURAL SALON (LEFT PILLAR) ──
		$this->start_controls_section(
			'section_salon',
			array(
				'label' => __( 'Architectural Salon (Left Column)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'salon_index',
			array(
				'label'   => __( 'Index Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01 / EXECUTIVE SALON',
			)
		);

		$this->add_control(
			'salon_image',
			array(
				'label'   => __( 'Salon Visual', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85',
				),
			)
		);

		$this->add_control(
			'salon_name',
			array(
				'label'   => __( 'Salon Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Beverly Hills Private Salon',
			)
		);

		$this->add_control(
			'salon_address',
			array(
				'label'   => __( 'Address / Location', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '9601 Wilshire Boulevard, Penthouse Suite',
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
				'label'   => __( 'Availability Note', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'By Private Appointment • 24/7 Concierge',
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: INQUIRY BRIEF (RIGHT COLUMN) ──
		$this->start_controls_section(
			'section_inquiry',
			array(
				'label' => __( 'Inquiry Brief (Right Column)', 'luxury-re-widgets' ),
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
			'form_description',
			array(
				'label'   => __( 'Form Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Direct correspondence with our senior advisory team.',
			)
		);

		$this->add_control(
			'submit_text',
			array(
				'label'   => __( 'Submit Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Transmit Inquiry',
			)
		);

		$this->add_control(
			'privacy_note',
			array(
				'label'   => __( 'Discretion Assurance', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Strict attorney-client level non-disclosure protocols apply.',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: CANVAS ──
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

		// ── STYLE: TYPOGRAPHY ──
		$this->start_controls_section(
			'style_typography',
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

		$image_url = ! empty( $settings['salon_image']['url'] ) ? $settings['salon_image']['url'] : 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=85';
		$phone_clean = preg_replace( '/[^0-9+]/', '', $settings['salon_phone'] ?? '' );
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

				<!-- ── TWO-COLUMN ARCHITECTURAL GALLERY & INQUIRY STAGE ── -->
				<div class="lre-contact__stage">

					<!-- ── LEFT PILLAR: ARCHITECTURAL SALON FRAME ── -->
					<div class="lre-contact__salon-col <?php echo esc_attr( $reveal_class ); ?>">
						
						<!-- Atmospheric Frame -->
						<div class="lre-contact__frame">
							<div class="lre-contact__frame-media">
								<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $settings['salon_name'] ?? 'Executive Salon' ); ?>" class="lre-contact__frame-img" loading="lazy">
								<div class="lre-contact__frame-vignette" aria-hidden="true"></div>
							</div>

							<!-- Top Corner Index -->
							<div class="lre-contact__frame-top">
								<span class="lre-contact__frame-index"><?php echo esc_html( $settings['salon_index'] ?? '01 / EXECUTIVE SALON' ); ?></span>
								<span class="lre-contact__frame-dot" aria-hidden="true"></span>
							</div>

							<!-- Bottom Narrative Overlay -->
							<div class="lre-contact__frame-bottom">
								<?php if ( ! empty( $settings['salon_name'] ) ) : ?>
								<h3 class="lre-contact__frame-title"><?php echo esc_html( $settings['salon_name'] ); ?></h3>
								<?php endif; ?>

								<?php if ( ! empty( $settings['salon_address'] ) ) : ?>
								<p class="lre-contact__frame-address"><?php echo esc_html( $settings['salon_address'] ); ?></p>
								<?php endif; ?>

								<?php if ( ! empty( $settings['salon_phone'] ) ) : ?>
								<div class="lre-contact__frame-phone-wrap">
									<a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="lre-contact__frame-phone">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
											<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"></path>
										</svg>
										<span><?php echo esc_html( $settings['salon_phone'] ); ?></span>
									</a>
								</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- Direct Channels Minimal Strip Underneath -->
						<div class="lre-contact__meta-strip">
							<?php if ( ! empty( $settings['salon_email'] ) ) : ?>
							<div class="lre-contact__meta-item">
								<span class="lre-contact__meta-label"><?php esc_html_e( 'Direct Email', 'luxury-re-widgets' ); ?></span>
								<a href="mailto:<?php echo esc_attr( $settings['salon_email'] ); ?>" class="lre-contact__meta-link">
									<?php echo esc_html( $settings['salon_email'] ); ?>
								</a>
							</div>
							<?php endif; ?>

							<?php if ( ! empty( $settings['salon_hours'] ) ) : ?>
							<div class="lre-contact__meta-item">
								<span class="lre-contact__meta-label"><?php esc_html_e( 'Discretion Hours', 'luxury-re-widgets' ); ?></span>
								<span class="lre-contact__meta-val"><?php echo esc_html( $settings['salon_hours'] ); ?></span>
							</div>
							<?php endif; ?>
						</div>

					</div>

					<!-- ── RIGHT PILLAR: MINIMALIST BESPOKE INQUIRY BRIEF ── -->
					<div class="lre-contact__brief-col <?php echo esc_attr( $reveal_class ); ?>">
						<div class="lre-contact__brief-inner">
							
							<div class="lre-contact__brief-header">
								<?php if ( ! empty( $settings['form_title'] ) ) : ?>
								<h3 class="lre-contact__brief-title"><?php echo esc_html( $settings['form_title'] ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $settings['form_description'] ) ) : ?>
								<p class="lre-contact__brief-desc"><?php echo esc_html( $settings['form_description'] ); ?></p>
								<?php endif; ?>
							</div>

							<form class="lre-contact__form" id="lre-contact-form" action="#" method="post" novalidate>
								
								<!-- Field 1: Full Name -->
								<div class="lre-contact__field">
									<label for="lre-name" class="lre-contact__field-label">
										<?php esc_html_e( 'Full Name', 'luxury-re-widgets' ); ?> <span class="req">*</span>
									</label>
									<input type="text" id="lre-name" name="client_name" class="lre-contact__field-input" placeholder="<?php esc_attr_e( 'Your name...', 'luxury-re-widgets' ); ?>" required>
								</div>

								<!-- Field 2: Email or Telephone -->
								<div class="lre-contact__field">
									<label for="lre-contact-point" class="lre-contact__field-label">
										<?php esc_html_e( 'Email Address or Telephone', 'luxury-re-widgets' ); ?> <span class="req">*</span>
									</label>
									<input type="text" id="lre-contact-point" name="client_email" class="lre-contact__field-input" placeholder="<?php esc_attr_e( 'Direct contact channel...', 'luxury-re-widgets' ); ?>" required>
								</div>

								<!-- Field 3: Preferred Enclave / Area -->
								<div class="lre-contact__field">
									<label for="lre-enclave" class="lre-contact__field-label">
										<?php esc_html_e( 'Enclave of Interest', 'luxury-re-widgets' ); ?>
									</label>
									<input type="text" id="lre-enclave" name="client_enclave" class="lre-contact__field-input" placeholder="<?php esc_attr_e( 'e.g. Bel Air, Beverly Hills, Malibu, Aspen...', 'luxury-re-widgets' ); ?>">
								</div>

								<!-- Field 4: Confidential Note / Brief -->
								<div class="lre-contact__field">
									<label for="lre-message" class="lre-contact__field-label">
										<?php esc_html_e( 'Confidential Inscription', 'luxury-re-widgets' ); ?>
									</label>
									<textarea id="lre-message" name="client_message" rows="3" class="lre-contact__field-textarea" placeholder="<?php esc_attr_e( 'Describe your acquisition requirements or representation needs...', 'luxury-re-widgets' ); ?>"></textarea>
								</div>

								<!-- Submit Button -->
								<div class="lre-contact__action-wrap">
									<button type="submit" class="lre-contact__submit-btn" id="lre-contact-submit">
										<span class="lre-contact__btn-text"><?php echo esc_html( $settings['submit_text'] ?? 'Transmit Inquiry' ); ?></span>
										<span class="lre-contact__btn-line" aria-hidden="true"></span>
										<svg class="lre-contact__btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
											<line x1="5" y1="12" x2="19" y2="12"></line>
											<polyline points="12 5 19 12 12 19"></polyline>
										</svg>
									</button>

									<?php if ( ! empty( $settings['privacy_note'] ) ) : ?>
									<p class="lre-contact__privacy-note">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
											<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
											<path d="M7 11V7a5 5 0 0110 0v4"></path>
										</svg>
										<span><?php echo esc_html( $settings['privacy_note'] ); ?></span>
									</p>
									<?php endif; ?>
								</div>

								<!-- Success Feedback Message (Hidden until submitted) -->
								<div class="lre-contact__feedback" id="lre-contact-feedback" style="display: none;">
									<div class="lre-contact__feedback-inner">
										<div class="lre-contact__feedback-icon" aria-hidden="true">
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
												<circle cx="12" cy="12" r="10"></circle>
												<polyline points="9 12 11 14 15 10"></polyline>
											</svg>
										</div>
										<h4 class="lre-contact__feedback-title"><?php esc_html_e( 'Inquiry Delivered with Discretion', 'luxury-re-widgets' ); ?></h4>
										<p class="lre-contact__feedback-text">
											<?php esc_html_e( 'Your brief has been forwarded directly to the Senior Advisory Desk. A confidential response will follow within two business hours.', 'luxury-re-widgets' ); ?>
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
