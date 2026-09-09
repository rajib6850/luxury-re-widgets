<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * LRE_Newsletter_Widget
 *
 * Ultra-luxury WHITE BACKGROUND newsletter bar.
 * Designed with a pure white (#ffffff) or customizable background,
 * editorial deep navy typography, gold hairlines, and architectural input field.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Newsletter_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_newsletter';
	}

	public function get_title() {
		return __( 'LRE — Private Newsletter (White Luxury)', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-email-field';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'newsletter', 'subscribe', 'lead', 'email', 'footer', 'one-line', 'white', 'minimal' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content & Prompt', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'layout_style',
			array(
				'label'   => __( 'Layout Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'oneline_bar',
				'options' => array(
					'oneline_bar'      => __( 'Editorial 1-Line Bar (Horizontal on White)', 'luxury-re-widgets' ),
					'centered_minimal' => __( 'Centered Architectural Box (On White)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'form_style',
			array(
				'label'   => __( 'Form Design Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'capsule',
				'options' => array(
					'capsule'   => __( 'Integrated Luxury Capsule (Framed & Refined)', 'luxury-re-widgets' ),
					'underline' => __( 'Architectural Underline (Minimalist Line)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PRIVATE MARKET INTELLIGENCE',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Headline', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Stay Ahead of the Southern California Market.', 'luxury-re-widgets' ),
				'placeholder' => __( 'Stay Ahead of the Southern California Market.', 'luxury-re-widgets' ),
				'description' => __( 'Supports multiple lines with Enter or <br> tags (with staggered luxury mask reveal animation).', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Headline HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'   => __( 'Subtitle / Subline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Curated off-market architectural acquisitions, noteworthy transactions, and bespoke quarterly insights delivered discreetly to your inbox.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'placeholder',
			array(
				'label'   => __( 'Email Placeholder', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Enter your email address...',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// --- SECTION: SUBMIT BUTTON & CONSENT ---
		$this->start_controls_section(
			'section_submit_consent',
			array(
				'label' => __( 'Submit Button & Consent', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => __( 'Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'JOIN THE REPORT',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'show_consent',
			array(
				'label'        => __( 'Show Legal Consent Checkbox', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'consent_text',
			array(
				'label'     => __( 'Legal Consent Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 3,
				'default'   => 'I agree to receive private real estate market intelligence, noteworthy transaction reports, and property insights from Adolfo Aguirre. Unsubscribe at any time.',
				'condition' => array(
					'show_consent' => 'yes',
				),
			)
		);

		$this->add_control(
			'privacy_link_text',
			array(
				'label'     => __( 'Privacy Policy Link Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'PRIVACY POLICY *',
				'condition' => array(
					'show_consent' => 'yes',
				),
			)
		);

		$this->add_control(
			'privacy_link_url',
			array(
				'label'       => __( 'Privacy Policy URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://...',
				'default'     => array( 'url' => '#' ),
				'condition'   => array(
					'show_consent' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		// --- SECTION: ACTIONS AFTER SUBMIT ---
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

		// --- SECTION: EMAIL NOTIFICATION SETTINGS (ADMIN) ---
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

		// --- SECTION: CLIENT AUTO-RESPONDER ---
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

		// --- SECTION: REDIRECT SETTINGS ---
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
				'placeholder' => 'https://yoursite.com/thank-you',
			)
		);

		$this->end_controls_section();

		// --- SECTION: FOLLOW UP BOSS CRM INTEGRATION ---
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
				'default' => 'Website - Newsletter Sign-up',
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
				'default'     => 'Newsletter Subscriber, The Aguirre Report, Website Lead',
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

		// --- SECTION: CUSTOM MESSAGES ---
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
				'label'   => __( 'General Error Message', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'An error occurred. Please try again.', 'luxury-re-widgets' ),
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

		// --- STYLE: Container & Background ---
		$this->start_controls_section(
			'style_container',
			array(
				'label' => __( 'Background & Spacing', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-newsletter-white' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'bar_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '3.5',
					'bottom'   => '3.75',
					'left'     => '2',
					'right'    => '2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-newsletter-white' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: Typography ---
		$this->start_controls_section(
			'style_typography',
			array(
				'label' => __( 'Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Headline Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-newsletter-white__title, {{WRAPPER}} .lre-newsletter-white__title span, {{WRAPPER}} .lre-newsletter-white__title .title-mask > span',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Headline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#02293f',
				'selectors' => array(
					'{{WRAPPER}} .lre-newsletter-white__title, {{WRAPPER}} .lre-newsletter-white__title span, {{WRAPPER}} .lre-newsletter-white__title .title-mask > span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'title_spacing',
			array(
				'label'      => __( 'Headline Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 80, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 5, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-newsletter-white__title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .section-label, {{WRAPPER}} .lre-newsletter-white__eyebrow',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .section-label, {{WRAPPER}} .lre-newsletter-white__eyebrow' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
					'{{WRAPPER}} .lre-newsletter-white__gold-bar' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => __( 'Subtitle Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-newsletter-white__subtitle',
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(2, 41, 63, 0.72)',
				'selectors' => array(
					'{{WRAPPER}} .lre-newsletter-white__subtitle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: Form & Button ---
		$this->start_controls_section(
			'style_form',
			array(
				'label' => __( 'Input & Submit Button', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'input_line_color',
			array(
				'label'     => __( 'Input Border / Underline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(197, 160, 71, 0.45)',
				'selectors' => array(
					'{{WRAPPER}} .lre-newsletter-white__input-box' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'label'    => __( 'Button Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-newsletter-white__btn, {{WRAPPER}} .lre-newsletter__btn-text',
			)
		);

		$this->add_control(
			'btn_bg_color',
			array(
				'label'     => __( 'Button Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#02293f',
				'selectors' => array(
					'{{WRAPPER}} .lre-newsletter-white__btn' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .lre-newsletter-white__btn' => '--btn-hover-bg: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => __( 'Button Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-newsletter-white__btn, {{WRAPPER}} .lre-newsletter-white__btn span' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'heading_btn_spacing',
			array(
				'label'     => __( 'Button Padding & Spacing', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Button Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '0.85',
					'right'    => '1.8',
					'bottom'   => '0.85',
					'left'     => '1.8',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-newsletter-white__btn, {{WRAPPER}} .btn.lre-newsletter-white__btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'btn_margin',
			array(
				'label'      => __( 'Button Margin / Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-newsletter-white__btn, {{WRAPPER}} .btn.lre-newsletter-white__btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'btn_gap',
			array(
				'label'      => __( 'Icon Spacing (Gap)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 40 ),
					'rem' => array( 'min' => 0, 'max' => 3 ),
				),
				'default'    => array(
					'unit' => 'rem',
					'size' => 0.55,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-newsletter-white__btn' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'btn_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-newsletter-white__btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$layout       = $settings['layout_style'] ?? 'oneline_bar';
		$layout_class = ( 'centered_minimal' === $layout ) ? 'lre-newsletter-white--centered' : 'lre-newsletter-white--oneline';
		$form_style   = $settings['form_style'] ?? 'capsule';
		?>
		<div class="lre-newsletter-white <?php echo esc_attr( $layout_class ); ?> lre-newsletter-white--form-<?php echo esc_attr( $form_style ); ?>" id="newsletter-section" aria-label="<?php esc_attr_e( 'Private Market Newsletter', 'luxury-re-widgets' ); ?>">
			<div class="lre-newsletter-white__container">

				<!-- Header / Prompt -->
				<div class="lre-newsletter-white__info">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<div class="lre-newsletter-white__eyebrow-wrap">
							<span class="lre-newsletter-white__gold-bar" aria-hidden="true"></span>
							<span class="section-label lre-newsletter-white__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $settings['title'] ) ) : 
						$is_edit_mode  = \Elementor\Plugin::$instance->editor->is_edit_mode();
						$n_tag         = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
						$n_tag         = in_array( $n_tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p' ), true ) ? $n_tag : 'h2';
						$heading_raw   = $settings['title'];
						$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
						$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
						$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
						if ( empty( $heading_lines ) ) {
							$heading_lines = array( $heading_raw );
						}
					?>
						<<?php echo $n_tag; ?> class="lre-newsletter-white__title">
							<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
								<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
							<?php endforeach; ?>
						</<?php echo $n_tag; ?>>
					<?php endif; ?>

					<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
						<p class="lre-newsletter-white__subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></p>
					<?php endif; ?>
				</div>

				<!-- Luxury Form -->
				<div class="lre-newsletter-white__form-wrap">
					<form class="lre-newsletter__form lre-newsletter-white__form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
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
						<input type="hidden" name="fub_source" value="<?php echo esc_attr( $settings['fub_source'] ?? 'Website - Newsletter Sign-up' ); ?>">
						<input type="hidden" name="fub_type" value="<?php echo esc_attr( $settings['fub_type'] ?? 'Registration' ); ?>">
						<input type="hidden" name="fub_tags" value="<?php echo esc_attr( $settings['fub_tags'] ?? 'Newsletter Subscriber, The Aguirre Report, Website Lead' ); ?>">
						<input type="hidden" name="fub_stage" value="<?php echo esc_attr( $settings['fub_stage'] ?? 'Lead' ); ?>">

						<div class="lre-newsletter-white__input-box">
							<input 
								type="email" 
								name="email" 
								class="lre-newsletter-white__input" 
								placeholder="<?php echo esc_attr( $settings['placeholder'] ); ?>" 
								required 
								aria-label="<?php esc_attr_e( 'Email address', 'luxury-re-widgets' ); ?>"
								style="border:0;outline:none;background:transparent;box-shadow:none;"
							>
							<button type="submit" class="btn lre-newsletter-white__btn lre-newsletter__btn">
								<?php if ( ! empty( $settings['button_text'] ) ) : ?>
									<span class="lre-newsletter__btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
								<?php endif; ?>
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="lre-newsletter__btn-icon">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
								<span class="lre-newsletter__spinner" aria-hidden="true"></span>
							</button>
						</div>

						<?php if ( 'yes' === ( $settings['show_consent'] ?? 'no' ) ) : ?>
							<div class="lre-newsletter-white__consent">
								<label class="lre-newsletter-white__consent-label">
									<input type="checkbox" name="consent" class="lre-newsletter-white__consent-check" required>
									<span class="lre-newsletter-white__consent-text">
										<?php echo esc_html( $settings['consent_text'] ?? '' ); ?>
										<?php if ( ! empty( $settings['privacy_link_text'] ) && ! empty( $settings['privacy_link_url']['url'] ) ) : ?>
											<a href="<?php echo esc_url( $settings['privacy_link_url']['url'] ); ?>" class="lre-newsletter-white__privacy-link" target="_blank" rel="noopener noreferrer">
												<?php echo esc_html( $settings['privacy_link_text'] ); ?>
											</a>
										<?php endif; ?>
									</span>
								</label>
							</div>
						<?php endif; ?>

						<div class="lre-newsletter__message" aria-live="polite"></div>
					</form>
				</div>

			</div>
		</div>
		<?php
	}
}
