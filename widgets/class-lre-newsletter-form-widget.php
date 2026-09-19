<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * LRE_Newsletter_Form_Widget
 *
 * Standalone Luxury Newsletter & Lead Capture Form Widget.
 * Specifically designed to be placed anywhere: inside Elementor Popups,
 * modal dialogs, column splits, sidebars, or custom page sections.
 *
 * Fully equipped with:
 * - Actions After Submit (Email, Autoresponder, Redirect, FUB CRM)
 * - Email Notification (Admin)
 * - Subscriber Welcome / Auto-Responder Email
 * - Follow Up Boss (FUB) Integration
 * - Custom Success, Error, and Validation Messages
 * - Full parity with the master `.btn` styling and AJAX submission engine.
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
		return array( 'newsletter', 'form', 'popup', 'lead', 'fub', 'subscribe', 'tcpa', 'email', 'autoresponder' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- 1. FORM LAYOUT & INPUTS ---
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
			'button_variant',
			array(
				'label'   => __( 'Button Style (Master Theme Parity)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn--outline',
				'options' => array(
					'btn--outline'              => __( 'Outline Dark (Site Master Default - White/Light BG)', 'luxury-re-widgets' ),
					'btn--outline-white'        => __( 'Outline White (Transparent on Dark BG)', 'luxury-re-widgets' ),
					'btn--primary'              => __( 'Solid Deep Navy (Master SERHANT Navy)', 'luxury-re-widgets' ),
					'btn--gold'                 => __( 'SERHANT Gold (Luxury Gold Fill)', 'luxury-re-widgets' ),
					'btn--secondary'            => __( 'Secondary Outline (Fine 1px Outline)', 'luxury-re-widgets' ),
					'lre-newsletter-white__btn' => __( 'Newsletter Style (Navy with Gold Slide Hover)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'button_size',
			array(
				'label'   => __( 'Button Size', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => __( 'Default Luxury (Min-Height 54px)', 'luxury-re-widgets' ),
					'btn--sm' => __( 'Compact / Small (Min-Height 44px)', 'luxury-re-widgets' ),
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

		$this->add_control(
			'button_icon_type',
			array(
				'label'     => __( 'Arrow Icon Type', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'diagonal',
				'options'   => array(
					'diagonal'    => '↗ ' . __( 'Diagonal Arrow (Portfolio / Ledger Style)', 'luxury-re-widgets' ),
					'arrow_right' => '→ ' . __( 'Right Arrow SVG (Newsletter Style)', 'luxury-re-widgets' ),
				),
				'condition' => array( 'show_button_icon' => 'yes' ),
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

		// --- 3. LEGAL CONSENT & TCPA CHECKBOX ---
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
				'label'        => __( 'Show Legal Consent Checkbox', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'consent_text',
			array(
				'label'       => __( 'Legal Consent Text', 'luxury-re-widgets' ),
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

		// --- 4. ACTIONS AFTER SUBMIT ---
		$this->start_controls_section(
			'section_actions_after_submit',
			array(
				'label' => __( 'Actions After Submit', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'enable_email_notification',
			array(
				'label'        => __( 'Send Admin Email Notification', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'enable_client_autoresponder',
			array(
				'label'        => __( 'Send Subscriber Welcome Email', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'enable_redirect',
			array(
				'label'        => __( 'Redirect After Submit', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'enable_fub',
			array(
				'label'        => __( 'Send Subscriber to Follow Up Boss (FUB)', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		// --- 5. EMAIL NOTIFICATION (ADMIN) ---
		$this->start_controls_section(
			'section_email_settings',
			array(
				'label'     => __( 'Email Notification (Admin)', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'enable_email_notification' => 'yes',
				),
			)
		);

		$this->add_control(
			'email_to',
			array(
				'label'       => __( 'To Email(s)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => get_option( 'admin_email' ),
				'description' => __( 'Comma-separated list of emails. Defaults to WordPress admin email.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'email_subject',
			array(
				'label'   => __( 'Subject', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'New VIP Newsletter Subscriber: {{email}}', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'sender_name',
			array(
				'label'       => __( 'From Name', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => get_bloginfo( 'name' ),
			)
		);

		$this->add_control(
			'sender_email',
			array(
				'label'       => __( 'From Email', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => get_option( 'admin_email' ),
			)
		);

		$this->add_control(
			'email_cc',
			array(
				'label'       => __( 'Cc Email', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'cc@example.com',
			)
		);

		$this->add_control(
			'email_bcc',
			array(
				'label'       => __( 'Bcc Email', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'bcc@example.com',
			)
		);

		$this->end_controls_section();

		// --- 6. SUBSCRIBER AUTO-RESPONDER EMAIL ---
		$this->start_controls_section(
			'section_autoresponder_settings',
			array(
				'label'     => __( 'Subscriber Auto-Responder Email', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'enable_client_autoresponder' => 'yes',
				),
			)
		);

		$this->add_control(
			'autoresponder_subject',
			array(
				'label'   => __( 'Subject', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Welcome to The Aguirre Report | Private Market Intelligence', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'autoresponder_message',
			array(
				'label'   => __( 'Message Body (HTML Allowed)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 6,
				'default' => __( "Dear Subscriber,\n\nThank you for subscribing to The Aguirre Report.\n\nYou now have priority access to curated off-market architectural acquisitions, private quarterly market insights, and Southern California luxury intelligence delivered discreetly.\n\nWarm regards,\nAdolfo Aguirre | SERHANT.", 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// --- 7. REDIRECT SETTINGS ---
		$this->start_controls_section(
			'section_redirect_settings',
			array(
				'label'     => __( 'Redirect Settings', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'enable_redirect' => 'yes',
				),
			)
		);

		$this->add_control(
			'redirect_url',
			array(
				'label'       => __( 'Redirect URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://adolfoaguirrere.com/thank-you',
			)
		);

		$this->end_controls_section();

		// --- 8. FOLLOW UP BOSS (FUB CRM) ---
		$this->start_controls_section(
			'section_fub_settings',
			array(
				'label'     => __( 'Follow Up Boss (FUB CRM)', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'enable_fub' => 'yes',
				),
			)
		);

		$this->add_control(
			'fub_api_key',
			array(
				'label'       => __( 'FUB API Key (Optional Override)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Leave blank to use Global API Key', 'luxury-re-widgets' ),
				'description' => __( 'Leave empty to inherit the global API key configured in WordPress Settings > General.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'fub_source',
			array(
				'label'   => __( 'Lead Source', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Website - Popup Lead',
			)
		);

		$this->add_control(
			'fub_type',
			array(
				'label'   => __( 'Event Type', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'Registration',
				'options' => array(
					'Registration'            => __( 'Registration', 'luxury-re-widgets' ),
					'General Inquiry'         => __( 'General Inquiry', 'luxury-re-widgets' ),
					'Newsletter Subscription' => __( 'Newsletter Subscription', 'luxury-re-widgets' ),
					'Market Report'           => __( 'Market Report', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'fub_tags',
			array(
				'label'       => __( 'Tags (Comma-Separated)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Popup Subscriber, Website Lead, Tailored Listings',
				'description' => __( 'Tags automatically applied to the subscriber in Follow Up Boss.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'fub_stage',
			array(
				'label'   => __( 'Lead Stage', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Lead',
			)
		);

		$this->end_controls_section();

		// --- 9. CUSTOM MESSAGES ---
		$this->start_controls_section(
			'section_custom_messages',
			array(
				'label' => __( 'Custom Messages', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'success_message',
			array(
				'label'   => __( 'Success Message', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Thank you for subscribing. Welcome to The Aguirre Report.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'error_message',
			array(
				'label'   => __( 'Error Message', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'An error occurred while submitting your request. Please try again.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'invalid_email_message',
			array(
				'label'   => __( 'Invalid Email Message', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Please enter a valid email address.', 'luxury-re-widgets' ),
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
				'label' => __( 'Submit Button Overrides', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .btn',
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
					'{{WRAPPER}} .btn' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .btn' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .btn' => 'border-color: {{VALUE}} !important;',
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
					'{{WRAPPER}} .btn:hover' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_hover_bg_color',
			array(
				'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .btn:hover' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .btn::before' => 'background: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .btn:hover' => 'border-color: {{VALUE}} !important;',
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
					'{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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

		$form_classes  = 'lre-newsletter__form lre-standalone-form';
		$form_classes .= ' lre-form--' . sanitize_html_class( $layout );
		$form_classes .= ' lre-form--' . sanitize_html_class( $style );

		// Button classes using the master `.btn` classes
		$btn_classes   = array( 'btn', 'lre-newsletter__btn' );
		$btn_classes[] = ! empty( $settings['button_variant'] ) ? $settings['button_variant'] : 'btn--outline';

		if ( ! empty( $settings['button_size'] ) && 'btn--sm' === $settings['button_size'] ) {
			$btn_classes[] = 'btn--sm';
		}

		if ( 'yes' === ( $settings['btn_full_width'] ?? 'no' ) ) {
			$btn_classes[] = 'btn--fullwidth';
		}
		?>
		<div class="lre-standalone-form-wrap">
			<form class="<?php echo esc_attr( $form_classes ); ?>" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
				<input type="hidden" name="action" value="lre_newsletter_submit">
				<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'lre_nonce' ) ); ?>">
				<input type="hidden" name="widget_id" value="<?php echo esc_attr( $this->get_id() ); ?>">
				<input type="hidden" name="post_id" value="<?php echo esc_attr( get_the_ID() ); ?>">

				<!-- Passing Configurations for Email & Notifications -->
				<input type="hidden" name="enable_email_notification" value="<?php echo esc_attr( $settings['enable_email_notification'] ?? 'yes' ); ?>">
				<input type="hidden" name="email_to" value="<?php echo esc_attr( $settings['email_to'] ?? '' ); ?>">
				<input type="hidden" name="email_subject" value="<?php echo esc_attr( $settings['email_subject'] ?? '' ); ?>">
				<input type="hidden" name="sender_name" value="<?php echo esc_attr( $settings['sender_name'] ?? '' ); ?>">
				<input type="hidden" name="sender_email" value="<?php echo esc_attr( $settings['sender_email'] ?? '' ); ?>">
				<input type="hidden" name="email_cc" value="<?php echo esc_attr( $settings['email_cc'] ?? '' ); ?>">
				<input type="hidden" name="email_bcc" value="<?php echo esc_attr( $settings['email_bcc'] ?? '' ); ?>">
				<input type="hidden" name="enable_autoresponder" value="<?php echo esc_attr( $settings['enable_client_autoresponder'] ?? 'yes' ); ?>">
				<input type="hidden" name="autoresponder_subject" value="<?php echo esc_attr( $settings['autoresponder_subject'] ?? '' ); ?>">
				<input type="hidden" name="autoresponder_message" value="<?php echo esc_attr( $settings['autoresponder_message'] ?? '' ); ?>">
				<input type="hidden" name="redirect_url" value="<?php echo esc_attr( $settings['redirect_url']['url'] ?? '' ); ?>">
				<input type="hidden" name="success_message" value="<?php echo esc_attr( $settings['success_message'] ?? '' ); ?>">
				<input type="hidden" name="error_message" value="<?php echo esc_attr( $settings['error_message'] ?? '' ); ?>">
				<input type="hidden" name="invalid_email_message" value="<?php echo esc_attr( $settings['invalid_email_message'] ?? '' ); ?>">

				<!-- Follow Up Boss (FUB CRM) -->
				<input type="hidden" name="enable_fub" value="<?php echo esc_attr( $settings['enable_fub'] ?? 'yes' ); ?>">
				<input type="hidden" name="fub_api_key" value="<?php echo esc_attr( $settings['fub_api_key'] ?? '' ); ?>">
				<input type="hidden" name="fub_source" value="<?php echo esc_attr( $settings['fub_source'] ?? 'Website - Popup Lead' ); ?>">
				<input type="hidden" name="fub_type" value="<?php echo esc_attr( $settings['fub_type'] ?? 'Registration' ); ?>">
				<input type="hidden" name="fub_tags" value="<?php echo esc_attr( $settings['fub_tags'] ?? 'Popup Subscriber, Website Lead, Tailored Listings' ); ?>">
				<input type="hidden" name="fub_stage" value="<?php echo esc_attr( $settings['fub_stage'] ?? 'Lead' ); ?>">

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
						<button type="submit" class="<?php echo esc_attr( implode( ' ', $btn_classes ) ); ?>">
							<span class="btn__text lre-newsletter__btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
							<?php if ( 'yes' === ( $settings['show_button_icon'] ?? 'no' ) ) : ?>
								<?php if ( 'arrow_right' === ( $settings['button_icon_type'] ?? 'diagonal' ) ) : ?>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="lre-newsletter__btn-icon btn__icon" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								<?php else : ?>
									<span class="btn__icon" aria-hidden="true">↗</span>
								<?php endif; ?>
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
						<button type="submit" class="<?php echo esc_attr( implode( ' ', $btn_classes ) ); ?>">
							<span class="btn__text lre-newsletter__btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
							<?php if ( 'yes' === ( $settings['show_button_icon'] ?? 'no' ) ) : ?>
								<?php if ( 'arrow_right' === ( $settings['button_icon_type'] ?? 'diagonal' ) ) : ?>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="lre-newsletter__btn-icon btn__icon" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								<?php else : ?>
									<span class="btn__icon" aria-hidden="true">↗</span>
								<?php endif; ?>
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
