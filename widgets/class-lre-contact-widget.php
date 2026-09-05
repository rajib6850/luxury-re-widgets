<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Contact_Widget
 *
 * Bespoke Ultra-Luxury Contact & Private Advisory Page Suite.
 * Features an Elementor Pro Form style dynamic builder:
 * - Dynamic Form Fields Repeater (Text, Email, Tel, Number, Textarea, Select, Checkbox, Radio, HTML)
 * - Flexible Column Widths (100%, 75%, 66%, 50%, 33%, 25%)
 * - Full Actions After Submit: Email Notifications with {{tokens}}, Client Auto-Responder,
 *   Redirect URL, and direct Elementor Pro Submissions archiving.
 * - Architectural full-bleed backdrop photography with responsive glassmorphism card.
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
		return 'eicon-form-vertical';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'contact', 'form', 'luxury', 'real estate', 'inquiry', 'agent', 'broker', 'elementor pro form', 'lead' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION: LAYOUT & MOBILE ORDERING ──
		$this->start_controls_section(
			'section_layout_ordering',
			array(
				'label' => __( 'Layout & Mobile Ordering', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'desktop_layout',
			array(
				'label'   => __( 'Desktop Layout', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'info_left',
				'options' => array(
					'info_left' => __( 'Info on Left, Form on Right', 'luxury-re-widgets' ),
					'form_left' => __( 'Form on Left, Info on Right', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'tablet_stack_order',
			array(
				'label'   => __( 'Tablet Layout (1024px - 768px)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'form_top',
				'options' => array(
					'form_top'     => __( 'Stacked (Form on Top)', 'luxury-re-widgets' ),
					'info_top'     => __( 'Stacked (Info on Top)', 'luxury-re-widgets' ),
					'side_by_side' => __( 'Side-by-Side (2 Columns)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'mobile_stack_order',
			array(
				'label'       => __( 'Mobile Stack Order (Mobile Screens)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'form_top',
				'options'     => array(
					'form_top' => __( 'Form on Top, Info on Bottom (Recommended)', 'luxury-re-widgets' ),
					'info_top' => __( 'Info on Top, Form on Bottom', 'luxury-re-widgets' ),
				),
				'description' => __( 'Choose whether the form card or the contact details appears first on phones.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

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

		// ── SECTION: FLOATING MESSAGE CARD HEADER ──
		$this->start_controls_section(
			'section_form_card_header',
			array(
				'label' => __( 'Form Card Header', 'luxury-re-widgets' ),
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

		$this->end_controls_section();

		// ── SECTION: FORM FIELDS (ELEMENTOR PRO STYLE REPEATER) ──
		$this->start_controls_section(
			'section_form_fields',
			array(
				'label' => __( 'Form Fields', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_field_labels',
			array(
				'label'        => __( 'Display Field Labels Above Inputs', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'description'  => __( 'If set to No, labels are shown inside placeholders for an editorial look.', 'luxury-re-widgets' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'field_type',
			array(
				'label'   => __( 'Type', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'     => __( 'Text', 'luxury-re-widgets' ),
					'email'    => __( 'Email', 'luxury-re-widgets' ),
					'tel'      => __( 'Tel / Phone', 'luxury-re-widgets' ),
					'number'   => __( 'Number', 'luxury-re-widgets' ),
					'textarea' => __( 'Textarea (Multi-line)', 'luxury-re-widgets' ),
					'select'   => __( 'Select Dropdown', 'luxury-re-widgets' ),
					'checkbox' => __( 'Checkbox Group', 'luxury-re-widgets' ),
					'radio'    => __( 'Radio Buttons', 'luxury-re-widgets' ),
					'html'     => __( 'Custom HTML / Divider', 'luxury-re-widgets' ),
				),
			)
		);

		$repeater->add_control(
			'field_label',
			array(
				'label'       => __( 'Label', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Field Label', 'luxury-re-widgets' ),
				'placeholder' => __( 'e.g. First Name', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'placeholder',
			array(
				'label'       => __( 'Placeholder', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter placeholder text', 'luxury-re-widgets' ),
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'checkbox', 'radio', 'html' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'required',
			array(
				'label'        => __( 'Required Field', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'conditions'   => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'html' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'column_width',
			array(
				'label'   => __( 'Column Width', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '100',
				'options' => array(
					'100' => '100%',
					'75'  => '75%',
					'66'  => '66%',
					'50'  => '50% (2 per row)',
					'33'  => '33% (3 per row)',
					'25'  => '25% (4 per row)',
				),
			)
		);

		$repeater->add_control(
			'field_options',
			array(
				'label'       => __( 'Options (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Option 1\nOption 2\nOption 3",
				'description' => __( 'Enter each option on a new line.', 'luxury-re-widgets' ),
				'rows'        => 5,
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => 'in',
							'value'    => array( 'select', 'checkbox', 'radio' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'default_value',
			array(
				'label'      => __( 'Default Value', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => '',
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'html' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'rows',
			array(
				'label'     => __( 'Rows', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 4,
				'min'       => 2,
				'max'       => 15,
				'condition' => array(
					'field_type' => 'textarea',
				),
			)
		);

		$repeater->add_control(
			'raw_html',
			array(
				'label'       => __( 'HTML Content', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '<div class="lre-contact__divider"></div>',
				'rows'        => 4,
				'condition'   => array(
					'field_type' => 'html',
				),
			)
		);

		$this->add_control(
			'form_fields',
			array(
				'label'       => __( 'Form Fields', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ field_type.toUpperCase() }}}: {{{ field_label }}} ({{{ column_width }}}%)',
				'default'     => array(
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'First Name', 'luxury-re-widgets' ),
						'placeholder'  => __( 'First Name', 'luxury-re-widgets' ),
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Last Name', 'luxury-re-widgets' ),
						'placeholder'  => __( 'Last Name', 'luxury-re-widgets' ),
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'email',
						'field_label'  => __( 'Email', 'luxury-re-widgets' ),
						'placeholder'  => __( 'Email', 'luxury-re-widgets' ),
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'tel',
						'field_label'  => __( 'Phone', 'luxury-re-widgets' ),
						'placeholder'  => __( 'Phone', 'luxury-re-widgets' ),
						'required'     => 'no',
						'column_width' => '50',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Interest', 'luxury-re-widgets' ),
						'placeholder'   => __( 'What are you looking for?', 'luxury-re-widgets' ),
						'required'      => 'no',
						'column_width'  => '100',
						'field_options' => "Buying an Estate\nSelling a Property\nRelocation Services\nPrivate Portfolio Advisory\nGeneral Inquiries",
					),
					array(
						'field_type'   => 'textarea',
						'field_label'  => __( 'Message', 'luxury-re-widgets' ),
						'placeholder'  => __( 'Notes, Questions', 'luxury-re-widgets' ),
						'required'     => 'no',
						'column_width' => '100',
						'rows'         => 4,
					),
				),
			)
		);

		$this->end_controls_section();

		// ── SECTION: SUBMIT BUTTON & CONSENT ──
		$this->start_controls_section(
			'section_submit_consent',
			array(
				'label' => __( 'Submit Button & Consent', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'submit_button_text',
			array(
				'label'   => __( 'Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SUBMIT',
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
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'consent_text',
			array(
				'label'     => __( 'Legal Consent Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 3,
				'default'   => 'I agree to receive communications via voice call, AI voice call, or message from our team. Consent is not a condition of purchase. Msg/data rates may apply.',
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

		// ── SECTION: ACTIONS AFTER SUBMIT ──
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
				'label'        => __( 'Send Client Confirmation Email', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
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

		$this->end_controls_section();

		// ── SECTION: EMAIL NOTIFICATION SETTINGS ──
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
				'label'       => __( 'Subject', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'New Luxury Inquiry from {{First Name}} {{Last Name}}', 'luxury-re-widgets' ),
				'description' => __( 'Tokens: Use any field label in double braces e.g. {{First Name}}, {{Email}}, {{Interest}}.', 'luxury-re-widgets' ),
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

		// ── SECTION: CLIENT AUTO-RESPONDER ──
		$this->start_controls_section(
			'section_autoresponder_settings',
			array(
				'label'     => __( 'Client Auto-Responder Email', 'luxury-re-widgets' ),
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
				'default' => __( 'Inquiry Received | Private Advisory Office', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'autoresponder_message',
			array(
				'label'   => __( 'Message Body (HTML Allowed)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 6,
				'default' => __( "Dear {{First Name}},\n\nThank you for reaching out to our advisory office. Your inquiry has been received with the highest confidentiality.\n\nA senior partner will review your request and get in touch shortly.\n\nWarm regards,\nPrivate Client Concierge", 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// ── SECTION: REDIRECT SETTINGS ──
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

		// ── SECTION: CUSTOM MESSAGES ──
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
				'default' => __( 'Thank you. Your message has been received. A senior associate will respond shortly.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'error_message',
			array(
				'label'   => __( 'Error Message', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'An error occurred while sending your message. Please try again.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: LAYOUT & PADDING ──
		$this->start_controls_section(
			'style_layout',
			array(
				'label' => __( 'Layout & Spacing', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'desktop_default' => array(
					'top'      => '130',
					'right'    => '40',
					'bottom'   => '130',
					'left'     => '40',
					'isLinked' => false,
				),
				'tablet_default' => array(
					'top'      => '80',
					'right'    => '24',
					'bottom'   => '80',
					'left'     => '24',
					'isLinked' => false,
				),
				'mobile_default' => array(
					'top'      => '50',
					'right'    => '16',
					'bottom'   => '50',
					'left'     => '16',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: HEADLINE & TEXT ──
		$this->start_controls_section(
			'style_typography',
			array(
				'label' => __( 'Headline & Narrative', 'luxury-re-widgets' ),
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
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.72)',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .lre-contact__desc',
			)
		);

		$this->end_controls_section();

		// ── STYLE: FLOATING FORM CARD ──
		$this->start_controls_section(
			'style_form_card',
			array(
				'label' => __( 'Form Card Appearance', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg_color',
			array(
				'label'     => __( 'Card Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(15, 17, 24, 0.88)',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__card' => 'background: {{VALUE}};',
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

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'desktop_default' => array(
					'top'      => '44',
					'right'    => '40',
					'bottom'   => '44',
					'left'     => '40',
					'isLinked' => false,
				),
				'tablet_default' => array(
					'top'      => '36',
					'right'    => '28',
					'bottom'   => '36',
					'left'     => '28',
					'isLinked' => false,
				),
				'mobile_default' => array(
					'top'      => '28',
					'right'    => '16',
					'bottom'   => '28',
					'left'     => '16',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-contact__card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: FORM INPUTS ──
		$this->start_controls_section(
			'style_form_fields',
			array(
				'label' => __( 'Form Inputs & Selectors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'grid_gap',
			array(
				'label'      => __( 'Field Gap (Row & Col)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array( 'min' => 6, 'max' => 30 ),
				),
				'default'    => array( 'size' => 14, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-contact__form-grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'input_bg_color',
			array(
				'label'     => __( 'Input Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.05)',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__input, {{WRAPPER}} .lre-contact__select, {{WRAPPER}} .lre-contact__textarea' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_text_color',
			array(
				'label'     => __( 'Input Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__input, {{WRAPPER}} .lre-contact__select, {{WRAPPER}} .lre-contact__textarea' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_border_color',
			array(
				'label'     => __( 'Input Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.14)',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__input, {{WRAPPER}} .lre-contact__select, {{WRAPPER}} .lre-contact__textarea' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_focus_border_color',
			array(
				'label'     => __( 'Input Focus Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__input:focus, {{WRAPPER}} .lre-contact__select:focus, {{WRAPPER}} .lre-contact__textarea:focus' => 'border-color: {{VALUE}}; box-shadow: 0 0 0 1px {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: SUBMIT BUTTON ──
		$this->start_controls_section(
			'style_submit_button',
			array(
				'label' => __( 'Submit Button', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'btn_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2b3340',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__submit-btn' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_hover_bg_color',
			array(
				'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__submit-btn:hover' => 'background: {{VALUE}}; border-color: {{VALUE}}; color: #08080c;',
				),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-contact__submit-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Privacy Policy URL handling
		$privacy_url = ! empty( $settings['privacy_link_url']['url'] ) ? $settings['privacy_link_url']['url'] : '#';
		$privacy_ext = ! empty( $settings['privacy_link_url']['is_external'] ) ? ' target="_blank"' : '';

		// Dynamic Form Fields array
		$form_fields = ! empty( $settings['form_fields'] ) ? $settings['form_fields'] : array();

		// Layout Ordering
		$desktop_layout = ! empty( $settings['desktop_layout'] ) ? $settings['desktop_layout'] : 'info_left';
		$tablet_layout  = ! empty( $settings['tablet_stack_order'] ) ? $settings['tablet_stack_order'] : 'form_top';
		$mobile_order   = ! empty( $settings['mobile_stack_order'] ) ? $settings['mobile_stack_order'] : 'form_top';
		?>
		<section class="lre-contact" id="lre-contact-<?php echo esc_attr( $this->get_id() ); ?>" aria-label="<?php echo esc_attr__( 'Contact Us', 'luxury-re-widgets' ); ?>">
			
			<!-- Atmosphere Backdrop -->
			<div class="lre-contact__bg" role="img" aria-hidden="true"></div>
			<div class="lre-contact__overlay" aria-hidden="true"></div>

			<!-- Main Container -->
			<div class="lre-contact__container lre-layout-<?php echo esc_attr( $desktop_layout ); ?> lre-tab-<?php echo esc_attr( $tablet_layout ); ?> lre-mob-<?php echo esc_attr( $mobile_order ); ?>">

				<!-- ================= LEFT COLUMN: HEADLINE & DIRECT CHANNELS ================= -->
				<div class="lre-contact__left">
					
					<!-- Eyebrow & Monumental Title -->
					<h1 class="lre-contact__headline">
						<?php echo nl2br( esc_html( $settings['headline'] ) ); ?>
					</h1>

					<!-- Editorial Narrative -->
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p class="lre-contact__desc">
							<?php echo nl2br( esc_html( $settings['description'] ) ); ?>
						</p>
					<?php endif; ?>

					<!-- Direct Coordinates -->
					<div class="lre-contact__direct">
						<?php if ( ! empty( $settings['phone_number'] ) ) : ?>
							<div class="lre-contact__direct-item">
								<span class="lre-contact__direct-lbl"><?php echo esc_html( $settings['phone_label'] ); ?></span>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $settings['phone_number'] ) ); ?>" class="lre-contact__direct-val">
									<?php echo esc_html( $settings['phone_number'] ); ?>
								</a>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $settings['email_address'] ) ) : ?>
							<div class="lre-contact__direct-item">
								<span class="lre-contact__direct-lbl"><?php echo esc_html( $settings['email_label'] ); ?></span>
								<a href="mailto:<?php echo esc_attr( $settings['email_address'] ); ?>" class="lre-contact__direct-val">
									<?php echo esc_html( $settings['email_address'] ); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>

					<!-- Lead Broker / Office Profile -->
					<?php if ( 'yes' === $settings['show_agent_profile'] ) : ?>
						<div class="lre-contact__agent">
							<?php if ( ! empty( $settings['agent_avatar']['url'] ) ) : ?>
								<div class="lre-contact__agent-avatar-wrap">
									<img src="<?php echo esc_url( $settings['agent_avatar']['url'] ); ?>" alt="<?php echo esc_attr( $settings['agent_name'] ); ?>" class="lre-contact__agent-avatar" loading="lazy" />
								</div>
							<?php endif; ?>

							<div class="lre-contact__agent-meta">
								<?php if ( ! empty( $settings['agent_eyebrow'] ) ) : ?>
									<span class="lre-contact__agent-eyebrow"><?php echo esc_html( $settings['agent_eyebrow'] ); ?></span>
								<?php endif; ?>

								<?php if ( ! empty( $settings['agent_name'] ) ) : ?>
									<h3 class="lre-contact__agent-name"><?php echo esc_html( $settings['agent_name'] ); ?></h3>
								<?php endif; ?>

								<?php if ( ! empty( $settings['agent_title'] ) ) : ?>
									<span class="lre-contact__agent-title"><?php echo esc_html( $settings['agent_title'] ); ?></span>
								<?php endif; ?>

								<?php if ( ! empty( $settings['office_address'] ) ) : ?>
									<p class="lre-contact__agent-address"><?php echo nl2br( esc_html( $settings['office_address'] ) ); ?></p>
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

						<!-- Master Dynamic Form -->
						<form class="lre-contact__form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" novalidate>
							<input type="hidden" name="action" value="lre_contact_submit">
							<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'lre_nonce' ) ); ?>">
							<input type="hidden" name="widget_id" value="<?php echo esc_attr( $this->get_id() ); ?>">
							<input type="hidden" name="post_id" value="<?php echo esc_attr( get_the_ID() ); ?>">

							<!-- Passing Configurations for Email & Notifications -->
							<input type="hidden" name="email_to" value="<?php echo esc_attr( $settings['email_to'] ?? '' ); ?>">
							<input type="hidden" name="email_subject" value="<?php echo esc_attr( $settings['email_subject'] ?? '' ); ?>">
							<input type="hidden" name="sender_name" value="<?php echo esc_attr( $settings['sender_name'] ?? '' ); ?>">
							<input type="hidden" name="sender_email" value="<?php echo esc_attr( $settings['sender_email'] ?? '' ); ?>">
							<input type="hidden" name="email_cc" value="<?php echo esc_attr( $settings['email_cc'] ?? '' ); ?>">
							<input type="hidden" name="email_bcc" value="<?php echo esc_attr( $settings['email_bcc'] ?? '' ); ?>">
							<input type="hidden" name="enable_autoresponder" value="<?php echo esc_attr( $settings['enable_client_autoresponder'] ?? 'no' ); ?>">
							<input type="hidden" name="autoresponder_subject" value="<?php echo esc_attr( $settings['autoresponder_subject'] ?? '' ); ?>">
							<input type="hidden" name="autoresponder_message" value="<?php echo esc_attr( $settings['autoresponder_message'] ?? '' ); ?>">
							<input type="hidden" name="redirect_url" value="<?php echo esc_attr( $settings['redirect_url']['url'] ?? '' ); ?>">
							<input type="hidden" name="success_message" value="<?php echo esc_attr( $settings['success_message'] ?? '' ); ?>">
							<input type="hidden" name="error_message" value="<?php echo esc_attr( $settings['error_message'] ?? '' ); ?>">

							<div class="lre-contact__form-grid">
								<?php
								$show_labels = ( 'yes' === ( $settings['show_field_labels'] ?? 'no' ) );

								foreach ( $form_fields as $idx => $field ) :
									$f_type        = ! empty( $field['field_type'] ) ? $field['field_type'] : 'text';
									$f_label       = ! empty( $field['field_label'] ) ? $field['field_label'] : '';
									$f_placeholder = ! empty( $field['placeholder'] ) ? $field['placeholder'] : '';
									$f_required    = ! empty( $field['required'] ) && 'yes' === $field['required'];
									$f_col         = ! empty( $field['column_width'] ) ? $field['column_width'] : '100';
									$f_id          = ! empty( $field['_id'] ) ? $field['_id'] : 'f_' . $idx;
									$f_input_id    = 'lre_in_' . esc_attr( $this->get_id() . '_' . $f_id );
									$f_name_key    = ! empty( $f_label ) ? $f_label : 'field_' . $idx;
									$f_name_attr   = 'lre_fields[' . esc_attr( $f_name_key ) . ']';
									$raw_opts      = ! empty( $field['field_options'] ) ? array_filter( array_map( 'trim', explode( "\n", $field['field_options'] ) ) ) : array();

									// Placeholder fallback if empty
									if ( empty( $f_placeholder ) && ! empty( $f_label ) && ! in_array( $f_type, array( 'checkbox', 'radio', 'html' ), true ) ) {
										$f_placeholder = $f_label;
									}
									if ( $f_required && ! empty( $f_placeholder ) && ! $show_labels ) {
										$f_placeholder .= ' *';
									}
									?>

									<div class="lre-form-col lre-col-<?php echo esc_attr( $f_col ); ?> elementor-repeater-item-<?php echo esc_attr( $f_id ); ?>">
										
										<?php if ( $show_labels && ! empty( $f_label ) && ! in_array( $f_type, array( 'html', 'checkbox', 'radio' ), true ) ) : ?>
											<label class="lre-contact__field-label" for="<?php echo esc_attr( $f_input_id ); ?>">
												<?php echo esc_html( $f_label ); ?><?php if ( $f_required ) : ?> <span class="lre-req">*</span><?php endif; ?>
											</label>
										<?php endif; ?>

										<?php if ( 'text' === $f_type ) : ?>
											<input type="text" id="<?php echo esc_attr( $f_input_id ); ?>" name="<?php echo esc_attr( $f_name_attr ); ?>" class="lre-contact__input" placeholder="<?php echo esc_attr( $f_placeholder ); ?>" value="<?php echo esc_attr( $field['default_value'] ?? '' ); ?>" <?php echo $f_required ? 'required' : ''; ?> />

										<?php elseif ( 'email' === $f_type ) : ?>
											<input type="email" id="<?php echo esc_attr( $f_input_id ); ?>" name="<?php echo esc_attr( $f_name_attr ); ?>" class="lre-contact__input" placeholder="<?php echo esc_attr( $f_placeholder ); ?>" value="<?php echo esc_attr( $field['default_value'] ?? '' ); ?>" <?php echo $f_required ? 'required' : ''; ?> />

										<?php elseif ( 'tel' === $f_type ) : ?>
											<input type="tel" id="<?php echo esc_attr( $f_input_id ); ?>" name="<?php echo esc_attr( $f_name_attr ); ?>" class="lre-contact__input" placeholder="<?php echo esc_attr( $f_placeholder ); ?>" value="<?php echo esc_attr( $field['default_value'] ?? '' ); ?>" <?php echo $f_required ? 'required' : ''; ?> />

										<?php elseif ( 'number' === $f_type ) : ?>
											<input type="number" id="<?php echo esc_attr( $f_input_id ); ?>" name="<?php echo esc_attr( $f_name_attr ); ?>" class="lre-contact__input" placeholder="<?php echo esc_attr( $f_placeholder ); ?>" value="<?php echo esc_attr( $field['default_value'] ?? '' ); ?>" <?php echo $f_required ? 'required' : ''; ?> />

										<?php elseif ( 'textarea' === $f_type ) : ?>
											<textarea id="<?php echo esc_attr( $f_input_id ); ?>" name="<?php echo esc_attr( $f_name_attr ); ?>" class="lre-contact__textarea" rows="<?php echo esc_attr( $field['rows'] ?? 4 ); ?>" placeholder="<?php echo esc_attr( $f_placeholder ); ?>" <?php echo $f_required ? 'required' : ''; ?>><?php echo esc_textarea( $field['default_value'] ?? '' ); ?></textarea>

										<?php elseif ( 'select' === $f_type ) : ?>
											<div class="lre-contact__select-wrap">
												<select id="<?php echo esc_attr( $f_input_id ); ?>" name="<?php echo esc_attr( $f_name_attr ); ?>" class="lre-contact__select" <?php echo $f_required ? 'required' : ''; ?>>
													<?php if ( ! empty( $f_placeholder ) ) : ?>
														<option value="" disabled <?php echo empty( $field['default_value'] ) ? 'selected' : ''; ?>><?php echo esc_html( $f_placeholder ); ?></option>
													<?php endif; ?>
													<?php foreach ( $raw_opts as $opt ) : ?>
														<option value="<?php echo esc_attr( $opt ); ?>"<?php echo ( $opt === ( $field['default_value'] ?? '' ) ) ? ' selected' : ''; ?>><?php echo esc_html( $opt ); ?></option>
													<?php endforeach; ?>
												</select>
												<span class="lre-contact__select-arrow" aria-hidden="true">
													<svg width="12" height="8" viewBox="0 0 12 8" fill="none"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
												</span>
											</div>

										<?php elseif ( 'checkbox' === $f_type ) : ?>
											<?php if ( ! empty( $f_label ) ) : ?>
												<div class="lre-contact__group-label"><?php echo esc_html( $f_label ); ?><?php if ( $f_required ) echo ' <span class="lre-req">*</span>'; ?></div>
											<?php endif; ?>
											<div class="lre-contact__checkbox-group">
												<?php foreach ( $raw_opts as $opt ) : ?>
													<label class="lre-contact__check-item">
														<input type="checkbox" name="<?php echo esc_attr( $f_name_attr ); ?>[]" value="<?php echo esc_attr( $opt ); ?>" />
														<span class="lre-contact__check-box" aria-hidden="true"></span>
														<span class="lre-contact__check-text"><?php echo esc_html( $opt ); ?></span>
													</label>
												<?php endforeach; ?>
											</div>

										<?php elseif ( 'radio' === $f_type ) : ?>
											<?php if ( ! empty( $f_label ) ) : ?>
												<div class="lre-contact__group-label"><?php echo esc_html( $f_label ); ?><?php if ( $f_required ) echo ' <span class="lre-req">*</span>'; ?></div>
											<?php endif; ?>
											<div class="lre-contact__radio-group">
												<?php foreach ( $raw_opts as $opt ) : ?>
													<label class="lre-contact__radio-item">
														<input type="radio" name="<?php echo esc_attr( $f_name_attr ); ?>" value="<?php echo esc_attr( $opt ); ?>" <?php echo ( $opt === ( $field['default_value'] ?? '' ) ) ? 'checked' : ''; ?> />
														<span class="lre-contact__radio-dot" aria-hidden="true"></span>
														<span class="lre-contact__radio-text"><?php echo esc_html( $opt ); ?></span>
													</label>
												<?php endforeach; ?>
											</div>

										<?php elseif ( 'html' === $f_type ) : ?>
											<div class="lre-contact__html-block">
												<?php echo wp_kses_post( $field['raw_html'] ?? '' ); ?>
											</div>

										<?php endif; ?>

									</div>

								<?php endforeach; ?>
							</div>

							<!-- Legal Consent Checkbox -->
							<?php if ( 'yes' === ( $settings['show_consent'] ?? 'yes' ) && ! empty( $settings['consent_text'] ) ) : ?>
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
