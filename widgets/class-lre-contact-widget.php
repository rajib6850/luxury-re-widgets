<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

/**
 * LRE_Contact_Widget
 *
 * Ultra-Luxury Single-Section Contact & Private Client Salon.
 * Engineered to museum-grade luxury standards:
 * - Standalone full-viewport canvas (no separate hero or CTA needed)
 * - Ambient typographic watermark with scroll parallax
 * - Minimalist centered/left gold eyebrow & multiline curtain-reveal heading
 * - Editorial narrative & discreet concierge channels (wire, dispatch, presence, discretion seal)
 * - Minimalist architectural inquiry console with 4 refined inputs & 1-click intent chips
 * - 100% consistent typography matching the global design system
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Contact_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_contact';
	}

	public function get_title() {
		return __( 'LRE — Luxury Contact & Private Salon', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-mail';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'contact', 'salon', 'advisory', 'concierge', 'fiduciary', 'inquiry', 'luxury', 'private office' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION 1: HEADER & EDITORIAL NARRATIVE ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Atmosphere & Editorial', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Watermark', 'luxury-re-widgets' ),
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
				'default'   => 'CONCIERGE',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Client Salon',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading (Multi-line / Title Mask)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "Direct Confidential<br>Advisory & Representation",
				'description' => __( 'Use <br> tags for smooth title curtain reveal lines.', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'Heading HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => array(
					'h1'  => 'H1',
					'h2'  => 'H2',
					'h3'  => 'H3',
					'div' => 'div',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Editorial Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'We provide discreet fiduciary representation for high-value acquisitions, historic compounds, and off-market portfolio transfers across prime global enclaves.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: DISCREET CONCIERGE CHANNELS ──
		$this->start_controls_section(
			'section_channels',
			array(
				'label' => __( 'Direct Concierge Channels', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'wire_label',
			array(
				'label'   => __( 'Phone Wire Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Direct Private Wire',
			)
		);

		$this->add_control(
			'wire_phone',
			array(
				'label'   => __( 'Phone Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '+1 (310) 895-2400',
			)
		);

		$this->add_control(
			'dispatch_label',
			array(
				'label'   => __( 'Email Dispatch Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Confidential Dispatch',
			)
		);

		$this->add_control(
			'dispatch_email',
			array(
				'label'   => __( 'Email Address', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'concierge@luxuryre.estate',
			)
		);

		$this->add_control(
			'presence_label',
			array(
				'label'   => __( 'Presence Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Private Salons',
			)
		);

		$this->add_control(
			'global_presence',
			array(
				'label'   => __( 'Global Presence Cities', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Beverly Hills • Manhattan • Mayfair • Miami',
			)
		);

		$this->add_control(
			'discretion_title',
			array(
				'label'   => __( 'Discretion Badge Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Attorney-Grade Discretion',
			)
		);

		$this->add_control(
			'discretion_note',
			array(
				'label'   => __( 'Discretion Statement', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'All communications are governed under strict attorney-client level non-disclosure protocols. Client identities remain entirely unlisted.',
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: MINIMAL INQUIRY FORM ──
		$this->start_controls_section(
			'section_form',
			array(
				'label' => __( 'Minimal Inquiry Form', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'form_title',
			array(
				'label'   => __( 'Form Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Initiate Confidential Inquiry',
			)
		);

		$this->add_control(
			'form_subtitle',
			array(
				'label'   => __( 'Form Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Transmissions receive priority review by a managing partner within two business hours.',
			)
		);

		// Engagement Intents (Minimal 1-Click Chips)
		$repeater_intents = new Repeater();

		$repeater_intents->add_control(
			'intent_text',
			array(
				'label'   => __( 'Intent Option', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Acquisition Advisory',
			)
		);

		$this->add_control(
			'intents',
			array(
				'label'       => __( 'Engagement Intent Chips', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_intents->get_controls(),
				'title_field' => '{{{ intent_text }}}',
				'default'     => array(
					array( 'intent_text' => 'Acquisition' ),
					array( 'intent_text' => 'Private Divestment' ),
					array( 'intent_text' => 'Estate Valuation' ),
					array( 'intent_text' => 'Family Office' ),
				),
			)
		);

		$this->add_control(
			'field_name_label',
			array(
				'label'   => __( 'Name Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Principal / Representative Name',
			)
		);

		$this->add_control(
			'field_name_placeholder',
			array(
				'label'   => __( 'Name Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'e.g., Lord Alistair Sterling / Family Office',
			)
		);

		$this->add_control(
			'field_contact_label',
			array(
				'label'   => __( 'Contact Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Confidential Email or Direct Line',
			)
		);

		$this->add_control(
			'field_contact_placeholder',
			array(
				'label'   => __( 'Contact Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'e.g., sterling@privateoffice.estate or +1 (310) ...',
			)
		);

		$this->add_control(
			'field_note_label',
			array(
				'label'   => __( 'Note Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Confidential Parameters / Inquiry Notes',
			)
		);

		$this->add_control(
			'field_note_placeholder',
			array(
				'label'   => __( 'Note Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Brief nature of your inquiry, target enclaves, or preferred contact window...',
			)
		);

		$this->add_control(
			'submit_btn_text',
			array(
				'label'   => __( 'Submit Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'TRANSMIT CONFIDENTIAL INQUIRY',
			)
		);

		$this->add_control(
			'privacy_accord',
			array(
				'label'   => __( 'Privacy Accord Notice', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'Transmissions are encrypted and received under strict attorney-client confidentiality.',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── SECTION: STYLE TYPOGRAPHY & COLORS ──
		$this->start_controls_section(
			'section_style_theme',
			array(
				'label' => __( 'Theme & Styling', 'luxury-re-widgets' ),
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
					'{{WRAPPER}} .lre-contact__eyebrow'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .lre-contact__channel-icon'   => 'color: {{VALUE}}; stroke: {{VALUE}};',
					'{{WRAPPER}} .lre-contact__seal-icon'      => 'color: {{VALUE}}; stroke: {{VALUE}};',
					'{{WRAPPER}} .lre-contact__chip input:checked + span' => 'border-color: {{VALUE}}; color: {{VALUE}};',
					'{{WRAPPER}} .lre-contact__submit-btn'     => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-contact__title',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Check if inside Elementor live editor
		$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		$reveal_class = $is_edit_mode ? 'revealed' : '';

		$show_watermark = 'yes' === ( $settings['show_watermark'] ?? 'yes' );
		$watermark_text = ! empty( $settings['watermark_text'] ) ? $settings['watermark_text'] : 'CONCIERGE';
		$eyebrow        = ! empty( $settings['eyebrow'] ) ? $settings['eyebrow'] : 'Private Client Salon';
		$heading_raw    = ! empty( $settings['heading'] ) ? $settings['heading'] : "Direct Confidential<br>Advisory & Representation";
		$tag            = ! empty( $settings['heading_tag'] ) ? esc_html( $settings['heading_tag'] ) : 'h1';
		$description    = ! empty( $settings['description'] ) ? $settings['description'] : '';

		// Split heading by <br> for curtain reveal lines
		$heading_lines = preg_split( '/<br\s*\/?>/i', $heading_raw );
		if ( empty( $heading_lines ) ) {
			$heading_lines = array( $heading_raw );
		}

		$intents = ! empty( $settings['intents'] ) ? $settings['intents'] : array();
		$wire_phone_clean = ! empty( $settings['wire_phone'] ) ? preg_replace( '/[^0-9+]/', '', $settings['wire_phone'] ) : '';
		?>
		<section class="lre-contact lre-contact--sovereign" id="private-client-salon" aria-label="<?php esc_attr_e( 'Private Client Salon & Confidential Inquiry', 'luxury-re-widgets' ); ?>">

			<!-- Ambient Background Watermark -->
			<?php if ( $show_watermark && ! empty( $watermark_text ) ) : ?>
			<div class="lre-contact__watermark" aria-hidden="true"><?php echo esc_html( $watermark_text ); ?></div>
			<?php endif; ?>

			<!-- Subtle Ambient Mesh Lighting -->
			<div class="lre-contact__ambient-glow" aria-hidden="true"></div>

			<div class="container lre-contact__container">
				
				<div class="lre-contact__grid <?php echo esc_attr( $reveal_class ); ?>">
					
					<!-- ── LEFT COLUMN: EDITORIAL SALON & DIRECT CHANNELS ── -->
					<div class="lre-contact__editorial">
						
						<!-- Eyebrow -->
						<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-contact__eyebrow-wrap">
							<span class="lre-contact__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
						</div>
						<?php endif; ?>

						<!-- Title with Curtain Reveal Lines -->
						<<?php echo $tag; ?> class="lre-contact__title">
							<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
								<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
							<?php endforeach; ?>
						</<?php echo $tag; ?>>

						<!-- Editorial Narrative -->
						<?php if ( ! empty( $description ) ) : ?>
						<p class="lre-contact__narrative"><?php echo esc_html( $description ); ?></p>
						<?php endif; ?>

						<!-- Direct Concierge Touchpoints -->
						<div class="lre-contact__channels">
							
							<!-- Wire Phone -->
							<?php if ( ! empty( $settings['wire_phone'] ) ) : ?>
							<div class="lre-contact__channel-item">
								<span class="lre-contact__channel-label"><?php echo esc_html( $settings['wire_label'] ); ?></span>
								<a href="tel:<?php echo esc_attr( $wire_phone_clean ); ?>" class="lre-contact__channel-value">
									<svg class="lre-contact__channel-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
									<span><?php echo esc_html( $settings['wire_phone'] ); ?></span>
								</a>
							</div>
							<?php endif; ?>

							<!-- Dispatch Email -->
							<?php if ( ! empty( $settings['dispatch_email'] ) ) : ?>
							<div class="lre-contact__channel-item">
								<span class="lre-contact__channel-label"><?php echo esc_html( $settings['dispatch_label'] ); ?></span>
								<a href="mailto:<?php echo esc_attr( $settings['dispatch_email'] ); ?>" class="lre-contact__channel-value">
									<svg class="lre-contact__channel-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
									<span><?php echo esc_html( $settings['dispatch_email'] ); ?></span>
								</a>
							</div>
							<?php endif; ?>

							<!-- Global Presence Cities -->
							<?php if ( ! empty( $settings['global_presence'] ) ) : ?>
							<div class="lre-contact__channel-item">
								<span class="lre-contact__channel-label"><?php echo esc_html( $settings['presence_label'] ); ?></span>
								<span class="lre-contact__channel-presence"><?php echo esc_html( $settings['global_presence'] ); ?></span>
							</div>
							<?php endif; ?>

						</div>

						<!-- Discretion Protocol Seal -->
						<div class="lre-contact__seal">
							<div class="lre-contact__seal-header">
								<svg class="lre-contact__seal-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
								<span class="lre-contact__seal-title"><?php echo esc_html( $settings['discretion_title'] ); ?></span>
							</div>
							<?php if ( ! empty( $settings['discretion_note'] ) ) : ?>
							<p class="lre-contact__seal-desc"><?php echo esc_html( $settings['discretion_note'] ); ?></p>
							<?php endif; ?>
						</div>

					</div>

					<!-- ── RIGHT COLUMN: MINIMALIST ARCHITECTURAL INQUIRY CONSOLE ── -->
					<div class="lre-contact__console">
						
						<div class="lre-contact__console-glass">
							
							<header class="lre-contact__console-header">
								<h2 class="lre-contact__console-title"><?php echo esc_html( $settings['form_title'] ); ?></h2>
								<?php if ( ! empty( $settings['form_subtitle'] ) ) : ?>
								<p class="lre-contact__console-sub"><?php echo esc_html( $settings['form_subtitle'] ); ?></p>
								<?php endif; ?>
							</header>

							<form class="lre-contact__form" novalidate>
								
								<!-- 1. Engagement Nature: 1-Click Minimal Chips -->
								<?php if ( ! empty( $intents ) ) : ?>
								<div class="lre-contact__form-group">
									<label class="lre-contact__label"><?php esc_html_e( 'Nature of Engagement', 'luxury-re-widgets' ); ?></label>
									<div class="lre-contact__chips">
										<?php foreach ( $intents as $i_idx => $it ) :
											$i_val = esc_attr( $it['intent_text'] );
										?>
										<label class="lre-contact__chip">
											<input type="radio" name="lre_intent" value="<?php echo $i_val; ?>" <?php checked( 0 === $i_idx ); ?>>
											<span><?php echo esc_html( $it['intent_text'] ); ?></span>
										</label>
										<?php endforeach; ?>
									</div>
								</div>
								<?php endif; ?>

								<!-- 2. Principal Name (Input 1) -->
								<div class="lre-contact__form-group">
									<label class="lre-contact__label" for="lre-principal-name"><?php echo esc_html( $settings['field_name_label'] ); ?> <span class="lre-contact__req">*</span></label>
									<input type="text" id="lre-principal-name" name="principal_name" class="lre-contact__input" placeholder="<?php echo esc_attr( $settings['field_name_placeholder'] ); ?>" required autocomplete="name">
								</div>

								<!-- 3. Direct Contact: Email or Phone (Input 2) -->
								<div class="lre-contact__form-group">
									<label class="lre-contact__label" for="lre-direct-contact"><?php echo esc_html( $settings['field_contact_label'] ); ?> <span class="lre-contact__req">*</span></label>
									<input type="text" id="lre-direct-contact" name="direct_contact" class="lre-contact__input" placeholder="<?php echo esc_attr( $settings['field_contact_placeholder'] ); ?>" required autocomplete="email">
								</div>

								<!-- 4. Confidential Parameters Note (Input 3) -->
								<div class="lre-contact__form-group">
									<label class="lre-contact__label" for="lre-inquiry-note"><?php echo esc_html( $settings['field_note_label'] ); ?></label>
									<textarea id="lre-inquiry-note" name="inquiry_note" class="lre-contact__input lre-contact__textarea" rows="3" placeholder="<?php echo esc_attr( $settings['field_note_placeholder'] ); ?>"></textarea>
								</div>

								<!-- 5. Submit Button with Luxury Hover State -->
								<div class="lre-contact__action">
									<button type="submit" class="lre-contact__submit-btn">
										<span class="lre-contact__btn-text"><?php echo esc_html( $settings['submit_btn_text'] ); ?></span>
										<svg class="lre-contact__btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
									</button>
								</div>

								<!-- Privacy Notice Accord -->
								<?php if ( ! empty( $settings['privacy_accord'] ) ) : ?>
								<p class="lre-contact__privacy-accord">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
									<span><?php echo esc_html( $settings['privacy_accord'] ); ?></span>
								</p>
								<?php endif; ?>

								<!-- Interactive Feedback State -->
								<div class="lre-contact__feedback" aria-live="polite">
									<div class="lre-contact__feedback-icon" aria-hidden="true">
										<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c5a047" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
									</div>
									<h4 class="lre-contact__feedback-title"><?php esc_html_e( 'Transmission Encrypted & Received', 'luxury-re-widgets' ); ?></h4>
									<p class="lre-contact__feedback-msg"><?php esc_html_e( 'Your dossier has been routed under strict non-disclosure protocol. A managing partner will contact you directly.', 'luxury-re-widgets' ); ?></p>
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
