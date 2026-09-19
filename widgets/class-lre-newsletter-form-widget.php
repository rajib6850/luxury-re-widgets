<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

/**
 * LRE_Newsletter_Form_Widget
 *
 * Standalone Luxury Newsletter & Lead Capture Form Widget.
 * Designed specifically to be inserted anywhere: inside Elementor Popups,
 * modal dialogs, column splits, sidebars, or custom page sections.
 * Automatically integrated with Follow Up Boss (FUB) CRM and AJAX submission.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Newsletter_Form_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_newsletter_form';
	}

	public function get_title() {
		return __( 'LRE — Standalone Newsletter / Lead Form', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'newsletter', 'form', 'popup', 'lead', 'fub', 'subscribe', 'tcpa', 'email' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- 1. FORM LAYOUT & FIELDS ---
		$this->start_controls_section(
			'section_form_fields',
			array(
				'label' => __( 'Form Layout & Inputs', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'layout_type',
			array(
				'label'   => __( 'Form Layout', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'stacked',
				'options' => array(
					'stacked'    => __( 'Vertical Stacked (Ideal for Popups & Modals)', 'luxury-re-widgets' ),
					'horizontal' => __( 'Horizontal Inline (Single Line Bar)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'input_design_style',
			array(
				'label'   => __( 'Input Design Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'underline',
				'options' => array(
					'underline' => __( 'Architectural Underline (Minimal Single Line)', 'luxury-re-widgets' ),
					'capsule'   => __( 'Framed Box / Capsule (1px Border)', 'luxury-re-widgets' ),
					'filled'    => __( 'Subtle Filled Background', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'email_placeholder',
			array(
				'label'       => __( 'Email Placeholder', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Email', 'luxury-re-widgets' ),
				'placeholder' => __( 'e.g. Email or Enter your email address...', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'show_name_field',
			array(
				'label'        => __( 'Show Name Field', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'name_placeholder',
			array(
				'label'       => __( 'Name Placeholder', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Full Name', 'luxury-re-widgets' ),
				'condition'   => array( 'show_name_field' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// --- 2. SUBMIT BUTTON ---
		$this->start_controls_section(
			'section_submit_btn',
			array(
				'label' => __( 'Submit Button', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'SUBMIT', 'luxury-re-widgets' ),
				'placeholder' => __( 'SUBMIT', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_preset',
			array(
				'label'   => __( 'Button Style Preset', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'outline_dark',
				'options' => array(
					'outline_dark'  => __( 'Minimal Dark Outline (Exact Popup Style)', 'luxury-re-widgets' ),
					'solid_gold'    => __( 'Solid Gold (Signature Sliding Shimmer)', 'luxury-re-widgets' ),
					'solid_navy'    => __( 'Solid Navy (Deep Luxury)', 'luxury-re-widgets' ),
					'outline_gold'  => __( 'Outline Gold', 'luxury-re-widgets' ),
					'outline_white' => __( 'Outline White (For Dark Popups)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'show_button_icon',
			array(
				'label'        => __( 'Show Arrow Icon', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_responsive_control(
			'btn_full_width',
			array(
				'label'        => __( 'Full Width Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		// --- 3. TCPA CONSENT & LEGAL DISCLAIMER ---
		$this->start_controls_section(
			'section_consent',
			array(
				'label' => __( 'TCPA Consent & Legal', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_consent',
			array(
				'label'        => __( 'Show TCPA Consent Checkbox', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'consent_text',
			array(
				'label'       => __( 'Consent Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => __( 'I agree to be contacted by Adolfo Aguirre via call, email, and text for real estate services. To opt out, you can reply \'stop\' at any time or reply \'help\' for assistance. You can also click the unsubscribe link in the emails. Message and data rates may apply. Message frequency may vary.', 'luxury-re-widgets' ),
				'condition'   => array( 'show_consent' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'privacy_link_text',
			array(
				'label'     => __( 'Privacy Policy Link Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Privacy Policy.', 'luxury-re-widgets' ),
				'condition' => array( 'show_consent' => 'yes' ),
			)
		);

		$this->add_control(
			'privacy_link_url',
			array(
				'label'     => __( 'Privacy Policy URL', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::URL,
				'default'   => array( 'url' => home_url( '/privacy-policy/' ) ),
				'condition' => array( 'show_consent' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- 4. CRM & FOLLOW UP BOSS (FUB) SETTINGS ---
		$this->start_controls_section(
			'section_crm_fub',
			array(
				'label' => __( 'CRM & Follow Up Boss (FUB)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'enable_fub',
			array(
				'label'        => __( 'Sync Leads to Follow Up Boss', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'fub_source',
			array(
				'label'     => __( 'Lead Source', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Website - Popup Lead',
				'condition' => array( 'enable_fub' => 'yes' ),
			)
		);

		$this->add_control(
			'fub_tags',
			array(
				'label'     => __( 'Lead Tags (Comma Separated)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Popup Subscriber, Website Lead, Tailored Listings',
				'condition' => array( 'enable_fub' => 'yes' ),
			)
		);

		$this->add_control(
			'success_message',
			array(
				'label'       => __( 'Success Notification Message', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Thank you. You have been added to our private registry.', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'redirect_url',
			array(
				'label'       => __( 'Redirect URL on Success (Optional)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://adolfoaguirrere.com/thank-you/',
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: INPUT FIELDS ---
		$this->start_controls_section(
			'section_style_inputs',
			array(
				'label' => __( 'Input Fields Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'input_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#02293F',
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-input' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_placeholder_color',
			array(
				'label'     => __( 'Placeholder Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7a8288',
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-input::placeholder' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_border_color',
			array(
				'label'     => __( 'Border / Underline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c3539',
				'selectors' => array(
					'{{WRAPPER}} .lre-form--underline .lre-standalone-input' => 'border-bottom-color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-form--capsule .lre-standalone-input' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_focus_border_color',
			array(
				'label'     => __( 'Focus Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#827A4A',
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-input:focus' => 'border-color: {{VALUE}} !important; border-bottom-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'input_typography',
				'selector' => '{{WRAPPER}} .lre-standalone-input',
			)
		);

		$this->end_controls_section();

		// --- STYLE: SUBMIT BUTTON ---
		$this->start_controls_section(
			'section_style_button',
			array(
				'label' => __( 'Submit Button Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .lre-standalone-btn',
			)
		);

		$this->start_controls_tabs( 'tabs_btn_style' );

		$this->start_controls_tab(
			'tab_btn_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-btn' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-btn' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-btn' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'btn_hover_text_color',
			array(
				'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-btn:hover' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_hover_bg_color',
			array(
				'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-btn:hover' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-btn:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .lre-standalone-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: CONSENT TEXT ---
		$this->start_controls_section(
			'section_style_consent',
			array(
				'label'     => __( 'Consent Text Styling', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_consent' => 'yes' ),
			)
		);

		$this->add_control(
			'consent_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4a555a',
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-consent-text' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'consent_link_color',
			array(
				'label'     => __( 'Link Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#02293F',
				'selectors' => array(
					'{{WRAPPER}} .lre-standalone-privacy-link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'consent_typography',
				'selector' => '{{WRAPPER}} .lre-standalone-consent-text',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$layout       = $settings['layout_type'] ?? 'stacked';
		$style        = $settings['input_design_style'] ?? 'underline';
		$btn_preset   = $settings['button_preset'] ?? 'outline_dark';

		$form_classes  = 'lre-newsletter__form lre-standalone-form';
		$form_classes .= ' lre-form--' . sanitize_html_class( $layout );
		$form_classes .= ' lre-form--' . sanitize_html_class( $style );

		$btn_classes   = 'lre-standalone-btn btn lre-btn--' . sanitize_html_class( $btn_preset );
		if ( 'yes' === ( $settings['btn_full_width'] ?? 'no' ) ) {
			$btn_classes .= ' lre-standalone-btn--fullwidth';
		}
		?>
		<div class="lre-standalone-form-wrap">
			<form class="<?php echo esc_attr( $form_classes ); ?>" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
				<input type="hidden" name="action" value="lre_newsletter_submit">
				<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'lre_nonce' ) ); ?>">
				<input type="hidden" name="widget_id" value="<?php echo esc_attr( $this->get_id() ); ?>">
				<input type="hidden" name="post_id" value="<?php echo esc_attr( get_the_ID() ); ?>">

				<!-- FUB Hidden Data -->
				<input type="hidden" name="enable_fub" value="<?php echo esc_attr( $settings['enable_fub'] ?? 'yes' ); ?>">
				<input type="hidden" name="fub_source" value="<?php echo esc_attr( $settings['fub_source'] ?? 'Website - Popup Lead' ); ?>">
				<input type="hidden" name="fub_tags" value="<?php echo esc_attr( $settings['fub_tags'] ?? 'Popup Subscriber, Website Lead' ); ?>">
				<input type="hidden" name="success_message" value="<?php echo esc_attr( $settings['success_message'] ?? '' ); ?>">
				<input type="hidden" name="redirect_url" value="<?php echo esc_attr( $settings['redirect_url']['url'] ?? '' ); ?>">

				<div class="lre-standalone-inputs-row">
					<?php if ( 'yes' === ( $settings['show_name_field'] ?? 'no' ) ) : ?>
						<div class="lre-standalone-input-field">
							<input 
								type="text" 
								name="name" 
								class="lre-standalone-input" 
								placeholder="<?php echo esc_attr( $settings['name_placeholder'] ); ?>" 
								aria-label="<?php esc_attr_e( 'Full Name', 'luxury-re-widgets' ); ?>"
							>
						</div>
					<?php endif; ?>

					<div class="lre-standalone-input-field">
						<input 
							type="email" 
							name="email" 
							class="lre-standalone-input" 
							placeholder="<?php echo esc_attr( $settings['email_placeholder'] ); ?>" 
							required 
							aria-label="<?php esc_attr_e( 'Email address', 'luxury-re-widgets' ); ?>"
						>
					</div>

					<?php if ( 'horizontal' === $layout ) : ?>
						<button type="submit" class="<?php echo esc_attr( $btn_classes ); ?>">
							<span class="lre-newsletter__btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
							<?php if ( 'yes' === ( $settings['show_button_icon'] ?? 'no' ) ) : ?>
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="lre-standalone-btn__icon" aria-hidden="true">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
							<?php endif; ?>
							<span class="lre-newsletter__spinner" aria-hidden="true"></span>
						</button>
					<?php endif; ?>
				</div>

				<?php if ( 'yes' === ( $settings['show_consent'] ?? 'no' ) ) : ?>
					<div class="lre-standalone-consent">
						<label class="lre-standalone-consent-label">
							<input type="checkbox" name="consent" class="lre-standalone-consent-check" required>
							<span class="lre-standalone-consent-text">
								<?php echo esc_html( $settings['consent_text'] ); ?>
								<?php if ( ! empty( $settings['privacy_link_text'] ) && ! empty( $settings['privacy_link_url']['url'] ) ) : ?>
									<a href="<?php echo esc_url( $settings['privacy_link_url']['url'] ); ?>" class="lre-standalone-privacy-link" target="_blank" rel="noopener noreferrer">
										<?php echo esc_html( $settings['privacy_link_text'] ); ?>
									</a>
								<?php endif; ?>
							</span>
						</label>
					</div>
				<?php endif; ?>

				<?php if ( 'stacked' === $layout ) : ?>
					<div class="lre-standalone-action-wrap">
						<button type="submit" class="<?php echo esc_attr( $btn_classes ); ?>">
							<span class="lre-newsletter__btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
							<?php if ( 'yes' === ( $settings['show_button_icon'] ?? 'no' ) ) : ?>
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="lre-standalone-btn__icon" aria-hidden="true">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
							<?php endif; ?>
							<span class="lre-newsletter__spinner" aria-hidden="true"></span>
						</button>
					</div>
				<?php endif; ?>

				<div class="lre-newsletter__message" aria-live="polite"></div>
			</form>
		</div>
		<?php
	}
}
