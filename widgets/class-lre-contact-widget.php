<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Contact_Widget
 *
 * Bespoke Ultra-Luxury Contact & Private Advisory Page Suite.
 * Rebuilt based directly on real-world luxury real estate references:
 * - Immersive full-bleed architectural estate photography backdrop with dark vignette overlay.
 * - Left Column: Monumental high-fashion headline, editorial narrative, direct phone/email coordinates,
 *   and an optional lead broker circular portrait card with address and social icons.
 * - Right Column: Sleek floating glassmorphism message card with a 2-column responsive input grid,
 *   interest dropdown, notes textarea, consent accord, and a high-contrast rounded pill submit button.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Contact_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_contact';
	}

	public function get_title() {
		return __( 'LRE — Luxury Contact Suite', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-mail';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'contact', 'form', 'luxury', 'real estate', 'inquiry', 'agent', 'broker', 'message' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION: ATMOSPHERE & BACKGROUND ──
		$this->start_controls_section(
			'section_atmosphere',
			array(
				'label' => __( 'Atmosphere & Background', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'bg_image',
			array(
				'label'   => __( 'Backdrop Photography', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=85',
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__bg' => 'background-image: url("{{URL}}");',
				),
			)
		);

		$this->add_control(
			'bg_overlay_color',
			array(
				'label'     => __( 'Vignette Overlay', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(8, 8, 12, 0.78)',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__overlay' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── SECTION: HEADLINE & DIRECT CONTACT ──
		$this->start_controls_section(
			'section_headline',
			array(
				'label' => __( 'Headline & Coordinates', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'headline',
			array(
				'label'       => __( 'Headline', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( "LET'S START THE\nCONVERSATION", 'luxury-re-widgets' ),
				'placeholder' => __( 'e.g. LET\'S START THE CONVERSATION', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Editorial Narrative', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => __( "Whether you're buying, selling, relocating, or just exploring your options, our team is here to provide expert advice and personalized support. Reach out today - we'd love to hear from you and help you take the next step with confidence.", 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'phone_label',
			array(
				'label'   => __( 'Phone Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PHONE:',
			)
		);

		$this->add_control(
			'phone_number',
			array(
				'label'   => __( 'Phone Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '877-976-5348',
			)
		);

		$this->add_control(
			'email_label',
			array(
				'label'   => __( 'Email Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'EMAIL:',
			)
		);

		$this->add_control(
			'email_address',
			array(
				'label'   => __( 'Email Address', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'INFO@YREALTYINC.COM',
			)
		);

		$this->end_controls_section();

		// ── SECTION: BROKER & CONCIERGE PROFILE (OPTIONAL) ──
		$this->start_controls_section(
			'section_agent_profile',
			array(
				'label' => __( 'Lead Broker / Office Profile', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_agent_profile',
			array(
				'label'        => __( 'Display Broker Profile', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'agent_avatar',
			array(
				'label'     => __( 'Broker Portrait', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300&q=85',
				),
				'condition' => array(
					'show_agent_profile' => 'yes',
				),
			)
		);

		$this->add_control(
			'agent_eyebrow',
			array(
				'label'     => __( 'Profile Eyebrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'GET IN TOUCH',
				'condition' => array(
					'show_agent_profile' => 'yes',
				),
			)
		);

		$this->add_control(
			'agent_name',
			array(
				'label'     => __( 'Broker Name', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Alexander Vance',
				'condition' => array(
					'show_agent_profile' => 'yes',
				),
			)
		);

		$this->add_control(
			'agent_title',
			array(
				'label'     => __( 'Broker Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Principal Partner & Managing Director',
				'condition' => array(
					'show_agent_profile' => 'yes',
				),
			)
		);

		$this->add_control(
			'office_address',
			array(
				'label'     => __( 'Office Address', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 2,
				'default'   => "1959 PALOMAR OAKS #300,\nCARLSBAD, CA 92011",
				'condition' => array(
					'show_agent_profile' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_social_links',
			array(
				'label'        => __( 'Display Social Icons', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'show_agent_profile' => 'yes',
				),
			)
		);

		$this->add_control(
			'social_facebook',
			array(
				'label'       => __( 'Facebook URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://facebook.com/...',
				'default'     => array( 'url' => '#' ),
				'condition'   => array(
					'show_agent_profile' => 'yes',
					'show_social_links'  => 'yes',
				),
			)
		);

		$this->add_control(
			'social_instagram',
			array(
				'label'       => __( 'Instagram URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://instagram.com/...',
				'default'     => array( 'url' => '#' ),
				'condition'   => array(
					'show_agent_profile' => 'yes',
					'show_social_links'  => 'yes',
				),
			)
		);

		$this->add_control(
			'social_youtube',
			array(
				'label'       => __( 'YouTube URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://youtube.com/...',
				'default'     => array( 'url' => '#' ),
				'condition'   => array(
					'show_agent_profile' => 'yes',
					'show_social_links'  => 'yes',
				),
			)
		);

		$this->end_controls_section();

		// ── SECTION: FLOATING MESSAGE CARD & FORM ──
		$this->start_controls_section(
			'section_message_card',
			array(
				'label' => __( 'Floating Message Card', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'card_title',
			array(
				'label'   => __( 'Card Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SEND US A MESSAGE',
			)
		);

		$this->add_control(
			'card_subtitle',
			array(
				'label'   => __( 'Card Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => "Send us a message and we'll get back to you quickly.",
			)
		);

		$this->add_control(
			'first_name_placeholder',
			array(
				'label'   => __( 'First Name Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'First Name *',
			)
		);

		$this->add_control(
			'last_name_placeholder',
			array(
				'label'   => __( 'Last Name Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Last Name *',
			)
		);

		$this->add_control(
			'email_placeholder',
			array(
				'label'   => __( 'Email Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Email *',
			)
		);

		$this->add_control(
			'phone_placeholder',
			array(
				'label'   => __( 'Phone Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Phone *',
			)
		);

		$this->add_control(
			'show_inquiry_dropdown',
			array(
				'label'        => __( 'Show Inquiry Selector', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'dropdown_placeholder',
			array(
				'label'     => __( 'Dropdown Placeholder', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'What are you looking for?',
				'condition' => array(
					'show_inquiry_dropdown' => 'yes',
				),
			)
		);

		$this->add_control(
			'dropdown_options',
			array(
				'label'       => __( 'Inquiry Options (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => "Buying an Estate\nSelling a Property\nRelocation Services\nPrivate Portfolio Advisory\nGeneral Inquiries",
				'condition'   => array(
					'show_inquiry_dropdown' => 'yes',
				),
			)
		);

		$this->add_control(
			'message_placeholder',
			array(
				'label'   => __( 'Message Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Notes, Questions',
			)
		);

		$this->add_control(
			'consent_text',
			array(
				'label'   => __( 'Legal Consent Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'I agree to receive communications via voice call, AI voice call, or message from our team. Consent is not a condition of purchase. Msg/data rates may apply.',
			)
		);

		$this->add_control(
			'privacy_link_text',
			array(
				'label'   => __( 'Privacy Policy Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PRIVACY POLICY *',
			)
		);

		$this->add_control(
			'privacy_link_url',
			array(
				'label'       => __( 'Privacy Policy URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://...',
				'default'     => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'submit_button_text',
			array(
				'label'   => __( 'Submit Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SUBMIT',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: HEADLINE & TEXT ──
		$this->start_controls_section(
			'section_style_typography',
			array(
				'label' => __( 'Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'headline_color',
			array(
				'label'     => __( 'Headline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__headline' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'headline_typography',
				'selector' => '{{WRAPPER}} .lre-contact__headline',
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => __( 'Gold Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__direct-val:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .lre-contact__privacy-link'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .lre-contact__agent-avatar-wrap' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .lre-contact__agent-eyebrow'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .lre-contact__social-link:hover' => 'border-color: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: FLOATING CARD ──
		$this->start_controls_section(
			'section_style_card',
			array(
				'label' => __( 'Floating Card & Inputs', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg_color',
			array(
				'label'     => __( 'Card Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(14, 15, 20, 0.88)',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'card_border',
				'selector' => '{{WRAPPER}} .lre-contact__card',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .lre-contact__card',
			)
		);

		$this->add_control(
			'btn_bg_color',
			array(
				'label'     => __( 'Button Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#29323c',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__submit-btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_hover_bg_color',
			array(
				'label'     => __( 'Button Hover Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__submit-btn:hover' => 'background-color: {{VALUE}}; color: #08080c;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Phone formatting
		$phone_raw   = ! empty( $settings['phone_number'] ) ? $settings['phone_number'] : '';
		$phone_clean = preg_replace( '/[^0-9+]/', '', $phone_raw );
		$email_raw   = ! empty( $settings['email_address'] ) ? $settings['email_address'] : '';

		// Inquiry dropdown options
		$dropdown_opts = array();
		if ( ! empty( $settings['dropdown_options'] ) ) {
			$lines = explode( "\n", str_replace( "\r", '', $settings['dropdown_options'] ) );
			foreach ( $lines as $line ) {
				$line = trim( $line );
				if ( ! empty( $line ) ) {
					$dropdown_opts[] = $line;
				}
			}
		}

		// Privacy link
		$privacy_url = ! empty( $settings['privacy_link_url']['url'] ) ? esc_url( $settings['privacy_link_url']['url'] ) : '#';
		$privacy_ext = ! empty( $settings['privacy_link_url']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
		?>
		<section class="lre-contact lre-contact--bespoke" id="lre-contact-<?php echo esc_attr( $this->get_id() ); ?>">
			<!-- Immersive Photography Canvas -->
			<div class="lre-contact__bg" aria-hidden="true"></div>
			<div class="lre-contact__overlay" aria-hidden="true"></div>

			<div class="lre-contact__container">
				
				<!-- ================= LEFT COLUMN: HEADLINE & CONCIERGE ================= -->
				<div class="lre-contact__left">
					
					<?php if ( ! empty( $settings['headline'] ) ) : ?>
						<h1 class="lre-contact__headline"><?php echo nl2br( esc_html( $settings['headline'] ) ); ?></h1>
					<?php endif; ?>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p class="lre-contact__desc"><?php echo wp_kses_post( $settings['description'] ); ?></p>
					<?php endif; ?>

					<!-- Direct Contact Links -->
					<div class="lre-contact__direct">
						<?php if ( ! empty( $phone_raw ) ) : ?>
							<div class="lre-contact__direct-item">
								<span class="lre-contact__direct-label"><?php echo esc_html( $settings['phone_label'] ); ?></span>
								<a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="lre-contact__direct-val"><?php echo esc_html( $phone_raw ); ?></a>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $email_raw ) ) : ?>
							<div class="lre-contact__direct-item">
								<span class="lre-contact__direct-label"><?php echo esc_html( $settings['email_label'] ); ?></span>
								<a href="mailto:<?php echo esc_attr( $email_raw ); ?>" class="lre-contact__direct-val"><?php echo esc_html( $email_raw ); ?></a>
							</div>
						<?php endif; ?>
					</div>

					<!-- Optional Lead Broker / Concierge Profile Card -->
					<?php if ( 'yes' === $settings['show_agent_profile'] ) : ?>
						<div class="lre-contact__agent">
							<?php if ( ! empty( $settings['agent_avatar']['url'] ) ) : ?>
								<div class="lre-contact__agent-avatar-wrap">
									<img src="<?php echo esc_url( $settings['agent_avatar']['url'] ); ?>" alt="<?php echo esc_attr( $settings['agent_name'] ); ?>" class="lre-contact__agent-avatar" loading="lazy" />
								</div>
							<?php endif; ?>

							<div class="lre-contact__agent-meta">
								<?php if ( ! empty( $settings['agent_eyebrow'] ) ) : ?>
									<div class="lre-contact__agent-eyebrow"><?php echo esc_html( $settings['agent_eyebrow'] ); ?></div>
								<?php endif; ?>

								<?php if ( ! empty( $settings['agent_name'] ) ) : ?>
									<h3 class="lre-contact__agent-name"><?php echo esc_html( $settings['agent_name'] ); ?></h3>
								<?php endif; ?>

								<?php if ( ! empty( $settings['agent_title'] ) ) : ?>
									<div class="lre-contact__agent-title"><?php echo esc_html( $settings['agent_title'] ); ?></div>
								<?php endif; ?>

								<?php if ( ! empty( $settings['office_address'] ) ) : ?>
									<div class="lre-contact__agent-address"><?php echo nl2br( esc_html( $settings['office_address'] ) ); ?></div>
								<?php endif; ?>

								<!-- Social Links -->
								<?php if ( 'yes' === $settings['show_social_links'] ) : ?>
									<div class="lre-contact__social">
										<?php if ( ! empty( $settings['social_facebook']['url'] ) ) : ?>
											<a href="<?php echo esc_url( $settings['social_facebook']['url'] ); ?>" class="lre-contact__social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
												<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.667 5H18V0h-3.808C10.595 0 9 1.582 9 4.615V8z"/></svg>
											</a>
										<?php endif; ?>

										<?php if ( ! empty( $settings['social_instagram']['url'] ) ) : ?>
											<a href="<?php echo esc_url( $settings['social_instagram']['url'] ); ?>" class="lre-contact__social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
												<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
											</a>
										<?php endif; ?>

										<?php if ( ! empty( $settings['social_youtube']['url'] ) ) : ?>
											<a href="<?php echo esc_url( $settings['social_youtube']['url'] ); ?>" class="lre-contact__social-link" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
												<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
											</a>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>

				</div>

				<!-- ================= RIGHT COLUMN: FLOATING MESSAGE CARD ================= -->
				<div class="lre-contact__right">
					<div class="lre-contact__card">
						
						<?php if ( ! empty( $settings['card_title'] ) ) : ?>
							<h2 class="lre-contact__card-title"><?php echo esc_html( $settings['card_title'] ); ?></h2>
						<?php endif; ?>

						<?php if ( ! empty( $settings['card_subtitle'] ) ) : ?>
							<p class="lre-contact__card-subtitle"><?php echo esc_html( $settings['card_subtitle'] ); ?></p>
						<?php endif; ?>

						<form class="lre-contact__form" method="post" action="#" novalidate>
							
							<div class="lre-contact__grid">
								<!-- First Name -->
								<div class="lre-contact__field">
									<label class="screen-reader-text" for="lre_cf_first_name_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $settings['first_name_placeholder'] ); ?></label>
									<input type="text" id="lre_cf_first_name_<?php echo esc_attr( $this->get_id() ); ?>" name="first_name" class="lre-contact__input" placeholder="<?php echo esc_attr( $settings['first_name_placeholder'] ); ?>" required />
								</div>

								<!-- Last Name -->
								<div class="lre-contact__field">
									<label class="screen-reader-text" for="lre_cf_last_name_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $settings['last_name_placeholder'] ); ?></label>
									<input type="text" id="lre_cf_last_name_<?php echo esc_attr( $this->get_id() ); ?>" name="last_name" class="lre-contact__input" placeholder="<?php echo esc_attr( $settings['last_name_placeholder'] ); ?>" required />
								</div>

								<!-- Email -->
								<div class="lre-contact__field">
									<label class="screen-reader-text" for="lre_cf_email_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $settings['email_placeholder'] ); ?></label>
									<input type="email" id="lre_cf_email_<?php echo esc_attr( $this->get_id() ); ?>" name="email" class="lre-contact__input" placeholder="<?php echo esc_attr( $settings['email_placeholder'] ); ?>" required />
								</div>

								<!-- Phone -->
								<div class="lre-contact__field">
									<label class="screen-reader-text" for="lre_cf_phone_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $settings['phone_placeholder'] ); ?></label>
									<input type="tel" id="lre_cf_phone_<?php echo esc_attr( $this->get_id() ); ?>" name="phone" class="lre-contact__input" placeholder="<?php echo esc_attr( $settings['phone_placeholder'] ); ?>" />
								</div>

								<!-- Inquiry Dropdown Selector -->
								<?php if ( 'yes' === $settings['show_inquiry_dropdown'] && ! empty( $dropdown_opts ) ) : ?>
									<div class="lre-contact__field lre-contact__field--full">
										<label class="screen-reader-text" for="lre_cf_interest_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $settings['dropdown_placeholder'] ); ?></label>
										<div class="lre-contact__select-wrap">
											<select id="lre_cf_interest_<?php echo esc_attr( $this->get_id() ); ?>" name="inquiry_type" class="lre-contact__select">
												<option value="" disabled selected><?php echo esc_html( $settings['dropdown_placeholder'] ); ?></option>
												<?php foreach ( $dropdown_opts as $opt ) : ?>
													<option value="<?php echo esc_attr( $opt ); ?>"><?php echo esc_html( $opt ); ?></option>
												<?php endforeach; ?>
											</select>
											<span class="lre-contact__select-arrow" aria-hidden="true">
												<svg width="12" height="8" viewBox="0 0 12 8" fill="none"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</span>
										</div>
									</div>
								<?php endif; ?>

								<!-- Notes, Questions -->
								<div class="lre-contact__field lre-contact__field--full">
									<label class="screen-reader-text" for="lre_cf_notes_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $settings['message_placeholder'] ); ?></label>
									<textarea id="lre_cf_notes_<?php echo esc_attr( $this->get_id() ); ?>" name="notes" class="lre-contact__textarea" rows="4" placeholder="<?php echo esc_attr( $settings['message_placeholder'] ); ?>"></textarea>
								</div>
							</div>

							<!-- Legal Consent Checkbox -->
							<?php if ( ! empty( $settings['consent_text'] ) ) : ?>
								<div class="lre-contact__consent">
									<label class="lre-contact__consent-label">
										<input type="checkbox" name="consent" class="lre-contact__consent-checkbox" required />
										<span class="lre-contact__consent-custom" aria-hidden="true"></span>
										<span class="lre-contact__consent-text">
											<?php echo esc_html( $settings['consent_text'] ); ?>
											<?php if ( ! empty( $settings['privacy_link_text'] ) ) : ?>
												<a href="<?php echo esc_url( $privacy_url ); ?>" class="lre-contact__privacy-link"<?php echo $privacy_ext; ?>><?php echo esc_html( $settings['privacy_link_text'] ); ?></a>
											<?php endif; ?>
										</span>
									</label>
								</div>
							<?php endif; ?>

							<!-- Submit Action -->
							<div class="lre-contact__action">
								<button type="submit" class="lre-contact__submit-btn">
									<span class="lre-contact__btn-text"><?php echo esc_html( $settings['submit_button_text'] ); ?></span>
									<span class="lre-contact__btn-spinner" aria-hidden="true"></span>
								</button>
							</div>

							<!-- Response Feedback Message Container -->
							<div class="lre-contact__feedback" aria-live="polite" style="display:none;"></div>
						</form>

					</div>
				</div>

			</div>
		</section>
		<?php
	}
}
