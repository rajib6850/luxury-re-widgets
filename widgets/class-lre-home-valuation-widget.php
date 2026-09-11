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
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

class LRE_Home_Valuation_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_home_valuation';
	}

	public function get_title() {
		return __( 'LRE — Home Valuation', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'home evaluation', 'property valuation', 'form', 'cma', 'valuation', 'multi-step', 'vpsignature' );
	}

	protected function register_controls() {

		/* ================= CONTENT: HEADER ================= */
		$this->start_controls_section(
			'section_content_header',
			array(
				'label' => __( 'Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '01 // COMPLIMENTARY HOME VALUATION', 'luxury-re-widgets' ),
				'placeholder' => __( '01 // COMPLIMENTARY HOME VALUATION', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Main Heading', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'WHAT IS YOUR PROPERTY
REALLY WORTH?', 'luxury-re-widgets' ),
				'placeholder' => __( 'Enter section heading', 'luxury-re-widgets' ),
				'rows'        => 2,
			)
		);

		$this->add_control(
			'heading_html_tag',
			array(
				'label'   => __( 'Heading HTML Tag', 'luxury-re-widgets' ),
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
			'description',
			array(
				'label'       => __( 'Narrative Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( "Online estimates can provide a starting point. They can't account for everything that makes your property — and its position in today's market — unique.\n\nRequest a complimentary, confidential valuation personally prepared by Adolfo Aguirre, combining current market data, comparable sales, property-specific factors and local market insight.", 'luxury-re-widgets' ),
				'rows'        => 4,
			)
		);

		$this->add_control(
			'enable_reveal',
			array(
				'label'        => __( 'Enable Scroll Reveal Animations', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: TRUST BADGES / PILLS ================= */
		$this->start_controls_section(
			'section_trust_badges',
			array(
				'label' => __( 'Trust Badges / Pills', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_trust_pills',
			array(
				'label'        => __( 'Show Trust Badges', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$trust_repeater = new Repeater();

		$trust_repeater->add_control(
			'text',
			array(
				'label'       => __( 'Badge Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '100% Confidential & Off-Market', 'luxury-re-widgets' ),
				'placeholder' => __( 'Enter badge text...', 'luxury-re-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$trust_repeater->add_control(
			'icon_type',
			array(
				'label'   => __( 'Icon', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'shield',
				'options' => array(
					'shield' => __( 'Shield / Confidential', 'luxury-re-widgets' ),
					'check'  => __( 'Checkmark / Verified', 'luxury-re-widgets' ),
					'clock'  => __( 'Clock / Delivery', 'luxury-re-widgets' ),
					'lock'   => __( 'Lock / Secure', 'luxury-re-widgets' ),
					'star'   => __( 'Star / Premium', 'luxury-re-widgets' ),
					'award'  => __( 'Award / Certified', 'luxury-re-widgets' ),
					'custom' => __( 'Custom Icon...', 'luxury-re-widgets' ),
					'none'   => __( 'None (Text Only)', 'luxury-re-widgets' ),
				),
			)
		);

		$trust_repeater->add_control(
			'custom_icon',
			array(
				'label'     => __( 'Choose Custom Icon', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-shield-alt',
					'library' => 'fa-solid',
				),
				'condition' => array(
					'icon_type' => 'custom',
				),
			)
		);

		$this->add_control(
			'trust_pills',
			array(
				'label'       => __( 'Badges List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $trust_repeater->get_controls(),
				'default'     => array(
					array(
						'text'      => __( '100% Confidential & Off-Market', 'luxury-re-widgets' ),
						'icon_type' => 'shield',
					),
					array(
						'text'      => __( 'Human Econometric Analysis', 'luxury-re-widgets' ),
						'icon_type' => 'check',
					),
					array(
						'text'      => __( 'Complimentary 24-48h Delivery', 'luxury-re-widgets' ),
						'icon_type' => 'clock',
					),
				),
				'title_field' => '{{{ text }}}',
				'condition'   => array(
					'show_trust_pills' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: FORM FIELDS ================= */
		$this->start_controls_section(
			'section_form_fields',
			array(
				'label' => __( 'Form Fields', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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
					'step'     => __( '--- Step / Page Break ---', 'luxury-re-widgets' ),
					'text'     => __( 'Text', 'luxury-re-widgets' ),
					'email'    => __( 'Email', 'luxury-re-widgets' ),
					'tel'      => __( 'Tel / Phone', 'luxury-re-widgets' ),
					'textarea' => __( 'Textarea (Multi-line)', 'luxury-re-widgets' ),
					'select'   => __( 'Select Dropdown', 'luxury-re-widgets' ),
					'checkbox' => __( 'Checkbox (Amenities Pills)', 'luxury-re-widgets' ),
					'radio'    => __( 'Radio Buttons', 'luxury-re-widgets' ),
					'number'   => __( 'Number', 'luxury-re-widgets' ),
					'html'     => __( 'Custom HTML / Divider', 'luxury-re-widgets' ),
				),
			)
		);

		$repeater->add_control(
			'step_phase',
			array(
				'label'       => __( 'Step Phase Tag', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'PHASE 01',
				'placeholder' => 'e.g. PHASE 01',
				'condition'   => array( 'field_type' => 'step' ),
			)
		);

		$repeater->add_control(
			'field_label',
			array(
				'label'       => __( 'Label / Step Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Property Street Address', 'luxury-re-widgets' ),
				'placeholder' => __( 'Field Label or Step Name', 'luxury-re-widgets' ),
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
							'value'    => array( 'step', 'checkbox', 'radio', 'html' ),
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
							'value'    => array( 'step', 'html' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'column_width',
			array(
				'label'      => __( 'Column Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '100',
				'options'    => array(
					'100' => '100%',
					'75'  => '75%',
					'66'  => '66%',
					'50'  => '50% (2 per row)',
					'33'  => '33% (3 per row)',
					'25'  => '25% (4 per row)',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'step' ),
						),
					),
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
				'rows'        => 6,
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
				'label'       => __( 'Default Value', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'step', 'html' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'raw_html',
			array(
				'label'       => __( 'HTML Content', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'rows'        => 4,
				'condition'   => array( 'field_type' => 'html' ),
			)
		);

		$this->add_control(
			'form_fields',
			array(
				'label'       => __( 'Form Fields & Steps', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ field_type.toUpperCase() }}}: {{{ field_label }}} ({{{ column_width }}}%)',
				'default'     => array(
					// STEP 1
					array(
						'field_type'   => 'step',
						'step_phase'   => 'PHASE 01',
						'field_label'  => __( 'Property Location', 'luxury-re-widgets' ),
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Property Street Address', 'luxury-re-widgets' ),
						'placeholder'  => 'e.g. 4820 Isleworth Country Club Dr',
						'required'     => 'yes',
						'column_width' => '100',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Unit / Suite', 'luxury-re-widgets' ),
						'placeholder'  => 'e.g. Penthouse 4B',
						'required'     => 'no',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'City / Community', 'luxury-re-widgets' ),
						'placeholder'  => 'e.g. Pasadena, San Marino, Los Angeles',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'    => 'text',
						'field_label'   => __( 'State', 'luxury-re-widgets' ),
						'default_value' => 'California (CA)',
						'required'      => 'no',
						'column_width'  => '50',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'ZIP / Postal Code', 'luxury-re-widgets' ),
						'placeholder'  => 'e.g. 91105',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Property Category', 'luxury-re-widgets' ),
						'placeholder'   => __( 'Select Property Type...', 'luxury-re-widgets' ),
						'field_options' => "Single-Family Luxury Residence\nLakefront / Waterfront Estate\nPenthouse / High-Rise Condominium\nEquestrian & Acreage Estate\nGolf & Country Club Property\nCustom / New Construction Build",
						'required'      => 'yes',
						'column_width'  => '100',
					),

					// STEP 2
					array(
						'field_type'   => 'step',
						'step_phase'   => 'PHASE 02',
						'field_label'  => __( 'Specs & Amenities', 'luxury-re-widgets' ),
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Bedrooms', 'luxury-re-widgets' ),
						'field_options' => "3 Bedrooms\n4 Bedrooms\n5 Bedrooms\n6+ Bedrooms",
						'default_value' => '4 Bedrooms',
						'required'      => 'no',
						'column_width'  => '33',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Bathrooms', 'luxury-re-widgets' ),
						'field_options' => "3 Baths\n4 Baths\n5 Baths\n6+ Baths",
						'default_value' => '4 Baths',
						'required'      => 'no',
						'column_width'  => '33',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Approx. Sq. Footage', 'luxury-re-widgets' ),
						'placeholder'  => 'e.g. 5,400 sq ft',
						'required'     => 'no',
						'column_width' => '33',
					),
					array(
						'field_type'    => 'checkbox',
						'field_label'   => __( 'Key Luxury Amenities & Features (Select All That Apply)', 'luxury-re-widgets' ),
						'field_options' => "Private Boat Dock\nResort Pool & Lanai\n24/7 Gated Security\nGuest House / Casita\nCustom Wine Cellar\nRecent Remodel / Upgrade\nSmart Home Automation\nEquestrian Stables",
						'required'      => 'no',
						'column_width'  => '100',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Selling Horizon / Timeline', 'luxury-re-widgets' ),
						'field_options' => "Planning to Sell (Next 30–60 Days)\nExploring Options (1–3 Months)\nLong-Term Strategy (6–12 Months)\nJust Curious / Annual Equity Checkup\nEstate Planning / Refinance",
						'default_value' => 'Planning to Sell (Next 30–60 Days)',
						'required'      => 'yes',
						'column_width'  => '100',
					),

					// STEP 3
					array(
						'field_type'   => 'step',
						'step_phase'   => 'PHASE 03',
						'field_label'  => __( 'Contact & Delivery', 'luxury-re-widgets' ),
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Full Name', 'luxury-re-widgets' ),
						'placeholder'  => 'Victoria Sterling',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'email',
						'field_label'  => __( 'Email Address', 'luxury-re-widgets' ),
						'placeholder'  => 'sterling@private.com',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'tel',
						'field_label'  => __( 'Direct Phone Number', 'luxury-re-widgets' ),
						'placeholder'  => '+1 (407) 000-0000',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Preferred Delivery Method', 'luxury-re-widgets' ),
						'field_options' => "Digital PDF Market Dossier via Email\nConfidential Phone Review with Adolfo Aguirre\nPrivate In-Person Walkthrough",
						'required'      => 'yes',
						'column_width'  => '50',
					),
					array(
						'field_type'   => 'textarea',
						'field_label'  => __( 'Special Architectural Notes / Recent Capital Improvements', 'luxury-re-widgets' ),
						'placeholder'  => 'e.g. New tile roof in 2024, Sub-Zero appliances, Lutron smart lighting system...',
						'required'     => 'no',
						'column_width' => '100',
					),
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: BUTTONS ================= */
		$this->start_controls_section(
			'section_form_buttons',
			array(
				'label' => __( 'Buttons', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'next_btn_text',
			array(
				'label'   => __( 'Next Step Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Continue', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'prev_btn_text',
			array(
				'label'   => __( 'Previous Step Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Back', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'submit_btn_text',
			array(
				'label'   => __( 'Submit Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Request Confidential Valuation', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'privacy_note',
			array(
				'label'   => __( 'Privacy & Security Note', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '100% Confidential. Your data is protected and never sold or made public.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: RECAPTCHA ================= */
		$this->start_controls_section(
			'section_content_recaptcha',
			array(
				'label' => __( 'reCAPTCHA', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'enable_recaptcha',
			array(
				'label'        => __( 'Enable Google reCAPTCHA', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'recaptcha_version',
			array(
				'label'     => __( 'reCAPTCHA Version', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'v3',
				'options'   => array(
					'v3' => __( 'v3 (Invisible Badge)', 'luxury-re-widgets' ),
					'v2' => __( 'v2 ("I\'m not a robot" Checkbox)', 'luxury-re-widgets' ),
				),
				'condition' => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->add_control(
			'recaptcha_site_key',
			array(
				'label'       => __( 'reCAPTCHA Site Key', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Google reCAPTCHA Site Key', 'luxury-re-widgets' ),
				'condition'   => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->add_control(
			'recaptcha_secret_key',
			array(
				'label'       => __( 'reCAPTCHA Secret Key', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Google reCAPTCHA Secret Key', 'luxury-re-widgets' ),
				'condition'   => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: EMAIL ================= */
		$this->start_controls_section(
			'section_content_email',
			array(
				'label' => __( 'Email Settings', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Admin Notification
		$this->add_control(
			'heading_email_admin',
			array(
				'label' => __( '1. Admin Notification Email', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'admin_email_to',
			array(
				'label'       => __( 'Recipient Email(s)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => get_option( 'admin_email' ),
				'description' => __( 'Leave blank to send to WordPress Admin Email. Multiple emails can be separated by commas.', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'admin_email_subject',
			array(
				'label'       => __( 'Email Subject', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'New Property Valuation Request from {{Full Name}}', 'luxury-re-widgets' ),
				'description' => __( 'Tokens: Any field label in double braces e.g. {{Full Name}}, {{Property Street Address}}, {{Email Address}}', 'luxury-re-widgets' ),
			)
		);

		// Client Auto-responder
		$this->add_control(
			'heading_email_client',
			array(
				'label'     => __( '2. Client Auto-Responder Email', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'enable_client_autoresponder',
			array(
				'label'        => __( 'Send Confirmation Email to Client', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'client_sender_name',
			array(
				'label'       => __( 'Sender Name', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Adolfo Aguirre | VP Signature Group',
				'condition'   => array( 'enable_client_autoresponder' => 'yes' ),
			)
		);

		$this->add_control(
			'client_sender_email',
			array(
				'label'       => __( 'Sender / Reply-To Email', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'admin@vpsignature.com',
				'placeholder' => 'admin@vpsignature.com',
				'condition'   => array( 'enable_client_autoresponder' => 'yes' ),
			)
		);

		$this->add_control(
			'client_email_subject',
			array(
				'label'       => __( 'Client Email Subject', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Property Valuation Request Confirmed | VP Signature Group', 'luxury-re-widgets' ),
				'condition'   => array( 'enable_client_autoresponder' => 'yes' ),
			)
		);

		// Success message
		$this->add_control(
			'heading_success_state',
			array(
				'label'     => __( '3. Success Message State', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'success_title',
			array(
				'label'   => __( 'Success Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Valuation Request Received', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'success_message',
			array(
				'label'   => __( 'Success Message Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Thank you. Adolfo Aguirre and our analytics team have initiated your sub-market comparative study. Your confidential property dossier is being assembled and will be delivered shortly.', 'luxury-re-widgets' ),
				'rows'    => 3,
			)
		);

		$this->add_control(
			'reset_btn_text',
			array(
				'label'   => __( 'Reset / Submit Another Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Submit Another Property', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: CONTAINER ================= */
		$this->start_controls_section(
			'section_style_theme',
			array(
				'label' => __( 'Container', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'theme_preset',
			array(
				'label'   => __( 'Theme Preset', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'light',
				'options' => array(
					'light' => __( 'Minimalist Light (Ivory & White)', 'luxury-re-widgets' ),
					'dark'  => __( 'Dark Luxury (Architectural Ink)', 'luxury-re-widgets' ),
					'taupe' => __( 'Warm Taupe & Bronze', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'container_padding',
			array(
				'label'      => __( 'Container Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '120',
					'right'    => '20',
					'bottom'   => '120',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-home-eval-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'form_max_width',
			array(
				'label'      => __( 'Form Box Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array( 'min' => 600, 'max' => 1400, 'step' => 10 ),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1040,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-home-eval-box' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: TYPOGRAPHY ================= */
		$this->start_controls_section(
			'section_style_typography',
			array(
				'label' => __( 'Typography', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__eyebrow, {{WRAPPER}} .wss-home-eval-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .lre-home-val__eyebrow, {{WRAPPER}} .wss-home-eval-eyebrow',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__title, {{WRAPPER}} .lre-home-val__title .title-mask > span, {{WRAPPER}} .wss-home-eval-title, {{WRAPPER}} .wss-home-eval-title .wss-mask > span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .lre-home-val__title, {{WRAPPER}} .lre-home-val__title .title-mask > span, {{WRAPPER}} .wss-home-eval-title, {{WRAPPER}} .wss-home-eval-title .wss-mask > span',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__desc, {{WRAPPER}} .wss-home-eval-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .lre-home-val__desc, {{WRAPPER}} .wss-home-eval-desc',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: TRUST BADGES / PILLS ================= */
		$this->start_controls_section(
			'section_style_trust_badges',
			array(
				'label'     => __( 'Trust Badges / Pills', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_trust_pills' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'trust_pills_align',
			array(
				'label'     => __( 'Alignment', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__pills, {{WRAPPER}} .wss-home-eval-trust-pills' => 'justify-content: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'trust_pill_typography',
				'selector' => '{{WRAPPER}} .lre-home-val__pill, {{WRAPPER}} .lre-home-val__pill span, {{WRAPPER}} .wss-trust-pill, {{WRAPPER}} .wss-trust-pill span',
			)
		);

		$this->start_controls_tabs( 'tabs_trust_pill_style' );

		$this->start_controls_tab(
			'tab_trust_pill_normal',
			array(
				'label' => __( 'Normal', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'trust_pill_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__pill, {{WRAPPER}} .lre-home-val__pill span, {{WRAPPER}} .wss-trust-pill, {{WRAPPER}} .wss-trust-pill span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'trust_pill_icon_color',
			array(
				'label'     => __( 'Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__pill svg, {{WRAPPER}} .wss-trust-pill svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-trust-pill i'   => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'trust_pill_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__pill, {{WRAPPER}} .wss-trust-pill' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'trust_pill_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__pill, {{WRAPPER}} .wss-trust-pill' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_trust_pill_hover',
			array(
				'label' => __( 'Hover', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'trust_pill_hover_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-trust-pill:hover, {{WRAPPER}} .wss-trust-pill:hover span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'trust_pill_hover_icon_color',
			array(
				'label'     => __( 'Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-trust-pill:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-trust-pill:hover i'   => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'trust_pill_hover_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-trust-pill:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'trust_pill_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-trust-pill:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'trust_pill_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .lre-home-val__pill, {{WRAPPER}} .wss-trust-pill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'trust_pill_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-home-val__pill, {{WRAPPER}} .wss-trust-pill' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'trust_pills_gap',
			array(
				'label'      => __( 'Gap Between Badges', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-home-val__pills, {{WRAPPER}} .wss-home-eval-trust-pills' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'trust_pills_margin_top',
			array(
				'label'      => __( 'Top Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-home-val__pills, {{WRAPPER}} .wss-home-eval-trust-pills' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: INPUTS & FORM FIELDS ================= */
		$this->start_controls_section(
			'section_style_inputs',
			array(
				'label' => __( 'Inputs & Form Fields', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Label Controls
		$this->add_control(
			'heading_field_labels',
			array(
				'label' => __( 'Field Labels', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => __( 'Label Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__label, {{WRAPPER}} .wss-field-label' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .lre-home-val__label, {{WRAPPER}} .wss-field-label',
			)
		);

		// Input Controls
		$this->add_control(
			'heading_input_controls',
			array(
				'label'     => __( 'Input Fields & Amenity Cards', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'input_typography',
				'label'    => __( 'Input Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-home-val__input, {{WRAPPER}} .lre-home-val__select, {{WRAPPER}} .lre-home-val__textarea, {{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} input.wss-home-eval-input, {{WRAPPER}} select.wss-home-eval-input, {{WRAPPER}} textarea.wss-home-eval-input',
			)
		);

		$this->start_controls_tabs( 'tabs_input_style' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_input_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'input_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__input, {{WRAPPER}} .lre-home-val__select, {{WRAPPER}} .lre-home-val__textarea, {{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} input.wss-home-eval-input, {{WRAPPER}} select.wss-home-eval-input, {{WRAPPER}} textarea.wss-home-eval-input' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__input, {{WRAPPER}} .lre-home-val__select, {{WRAPPER}} .lre-home-val__textarea, {{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} input.wss-home-eval-input, {{WRAPPER}} select.wss-home-eval-input, {{WRAPPER}} textarea.wss-home-eval-input' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_placeholder_color',
			array(
				'label'     => __( 'Placeholder Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-input::placeholder, {{WRAPPER}} input.wss-home-eval-input::placeholder, {{WRAPPER}} textarea.wss-home-eval-input::placeholder' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__input, {{WRAPPER}} .lre-home-val__select, {{WRAPPER}} .lre-home-val__textarea, {{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} input.wss-home-eval-input, {{WRAPPER}} select.wss-home-eval-input, {{WRAPPER}} textarea.wss-home-eval-input' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'input_box_shadow',
				'selector' => '{{WRAPPER}} .lre-home-val__input, {{WRAPPER}} .lre-home-val__select, {{WRAPPER}} .lre-home-val__textarea, {{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} input.wss-home-eval-input, {{WRAPPER}} select.wss-home-eval-input, {{WRAPPER}} textarea.wss-home-eval-input',
			)
		);

		$this->end_controls_tab();

		// Hover / Focus Tab
		$this->start_controls_tab(
			'tab_input_focus',
			array( 'label' => __( 'Hover / Focus', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'input_focus_bg',
			array(
				'label'     => __( 'Focus / Hover Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__input:focus, {{WRAPPER}} .lre-home-val__select:focus, {{WRAPPER}} .lre-home-val__textarea:focus, {{WRAPPER}} .wss-home-eval-input:focus' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_focus_text_color',
			array(
				'label'     => __( 'Focus / Hover Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-input:focus, {{WRAPPER}} input.wss-home-eval-input:focus, {{WRAPPER}} select.wss-home-eval-input:focus, {{WRAPPER}} textarea.wss-home-eval-input:focus, {{WRAPPER}} .wss-home-eval-amenity-box:hover .wss-home-eval-amenity-label' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_focus_border_color',
			array(
				'label'     => __( 'Focus / Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a8916f',
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__input:focus, {{WRAPPER}} .lre-home-val__select:focus, {{WRAPPER}} .lre-home-val__textarea:focus, {{WRAPPER}} .wss-home-eval-input:focus' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'input_focus_box_shadow',
				'selector' => '{{WRAPPER}} .lre-home-val__input:focus, {{WRAPPER}} .lre-home-val__select:focus, {{WRAPPER}} .lre-home-val__textarea:focus, {{WRAPPER}} .wss-home-eval-input:focus',
			)
		);

		$this->end_controls_tab();

		// Selected State Tab for Amenity Cards / Radios
		$this->start_controls_tab(
			'tab_input_selected',
			array( 'label' => __( 'Selected', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'input_selected_bg',
			array(
				'label'     => __( 'Selected Card Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-amenity-box:has(input:checked), {{WRAPPER}} .wss-home-eval-amenity-box.is-checked' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_selected_text_color',
			array(
				'label'     => __( 'Selected Text / Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-amenity-box:has(input:checked) .wss-home-eval-amenity-label, {{WRAPPER}} .wss-home-eval-amenity-box.is-checked .wss-home-eval-amenity-label' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-home-eval-amenity-box:has(input:checked) .wss-custom-check, {{WRAPPER}} .wss-home-eval-amenity-box.is-checked .wss-custom-check' => 'background: {{VALUE}} !important; border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'input_selected_border_color',
			array(
				'label'     => __( 'Selected Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-amenity-box:has(input:checked), {{WRAPPER}} .wss-home-eval-amenity-box.is-checked' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'input_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 5, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-home-val__input, {{WRAPPER}} .lre-home-val__select, {{WRAPPER}} .lre-home-val__textarea, {{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} input.wss-home-eval-input, {{WRAPPER}} select.wss-home-eval-input, {{WRAPPER}} textarea.wss-home-eval-input' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'input_padding',
			array(
				'label'      => __( 'Input Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} input.wss-home-eval-input, {{WRAPPER}} select.wss-home-eval-input, {{WRAPPER}} textarea.wss-home-eval-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: BUTTONS ================= */
		$this->start_controls_section(
			'section_style_button',
			array(
				'label' => __( 'Action Buttons', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Primary / Submit Button Styling
		$this->add_control(
			'heading_submit_btn',
			array(
				'label' => __( 'Submit & Continue Buttons', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .lre-home-val__btn, {{WRAPPER}} .lre-home-val__btn--next, {{WRAPPER}} .lre-home-val__btn--submit, {{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn, {{WRAPPER}} .wss-home-eval-reset-btn',
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-home-val__btn, {{WRAPPER}} .lre-home-val__btn--next, {{WRAPPER}} .lre-home-val__btn--submit, {{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn, {{WRAPPER}} .wss-home-eval-reset-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'btn_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 40, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn, {{WRAPPER}} .wss-home-eval-reset-btn, {{WRAPPER}} .wss-home-eval-submit-btn::before, {{WRAPPER}} .wss-home-eval-next-btn::before, {{WRAPPER}} .wss-home-eval-reset-btn::before' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_btn_style' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_btn_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => __( 'Text / Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__btn, {{WRAPPER}} .lre-home-val__btn--next, {{WRAPPER}} .lre-home-val__btn--submit, {{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn, {{WRAPPER}} .wss-home-eval-reset-btn' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-home-eval-submit-btn svg, {{WRAPPER}} .wss-home-eval-next-btn svg, {{WRAPPER}} .wss-home-eval-reset-btn svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__btn, {{WRAPPER}} .lre-home-val__btn--next, {{WRAPPER}} .lre-home-val__btn--submit, {{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn, {{WRAPPER}} .wss-home-eval-reset-btn' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__btn, {{WRAPPER}} .lre-home-val__btn--next, {{WRAPPER}} .lre-home-val__btn--submit, {{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn, {{WRAPPER}} .wss-home-eval-reset-btn' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btn_shadow',
				'selector' => '{{WRAPPER}} .lre-home-val__btn, {{WRAPPER}} .lre-home-val__btn--next, {{WRAPPER}} .lre-home-val__btn--submit, {{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn, {{WRAPPER}} .wss-home-eval-reset-btn',
			)
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'tab_btn_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'btn_hover_text_color',
			array(
				'label'     => __( 'Hover Text / Icon Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__btn:hover, {{WRAPPER}} .lre-home-val__btn--next:hover, {{WRAPPER}} .lre-home-val__btn--submit:hover, {{WRAPPER}} .wss-home-eval-submit-btn:hover, {{WRAPPER}} .wss-home-eval-next-btn:hover, {{WRAPPER}} .wss-home-eval-reset-btn:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-home-eval-submit-btn:hover svg, {{WRAPPER}} .wss-home-eval-next-btn:hover svg, {{WRAPPER}} .wss-home-eval-reset-btn:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_hover_bg',
			array(
				'label'     => __( 'Hover Background (Curtain Sweep)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn::before, {{WRAPPER}} .wss-home-eval-next-btn::before, {{WRAPPER}} .wss-home-eval-reset-btn::before, {{WRAPPER}} .wss-home-eval-submit-btn:hover::before, {{WRAPPER}} .wss-home-eval-next-btn:hover::before, {{WRAPPER}} .wss-home-eval-reset-btn:hover::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-home-val__btn, {{WRAPPER}} .lre-home-val__btn--next, {{WRAPPER}} .lre-home-val__btn--submit, {{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn, {{WRAPPER}} .wss-home-eval-reset-btn' => '--wss-btn-hover-bg: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__btn:hover, {{WRAPPER}} .lre-home-val__btn--next:hover, {{WRAPPER}} .lre-home-val__btn--submit:hover, {{WRAPPER}} .wss-home-eval-submit-btn:hover, {{WRAPPER}} .wss-home-eval-next-btn:hover, {{WRAPPER}} .wss-home-eval-reset-btn:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btn_hover_shadow',
				'selector' => '{{WRAPPER}} .lre-home-val__btn:hover, {{WRAPPER}} .lre-home-val__btn--next:hover, {{WRAPPER}} .lre-home-val__btn--submit:hover, {{WRAPPER}} .wss-home-eval-submit-btn:hover, {{WRAPPER}} .wss-home-eval-next-btn:hover, {{WRAPPER}} .wss-home-eval-reset-btn:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		// Back Button Controls
		$this->add_control(
			'heading_back_btn',
			array(
				'label'     => __( 'Back Button', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'back_btn_typography',
				'selector' => '{{WRAPPER}} .lre-home-val__btn-back, {{WRAPPER}} .lre-home-val__btn--prev, {{WRAPPER}} .wss-btn-back',
			)
		);

		$this->add_control(
			'back_btn_color',
			array(
				'label'     => __( 'Back Button Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__btn-back, {{WRAPPER}} .lre-home-val__btn--prev, {{WRAPPER}} .wss-btn-back' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'back_btn_hover_color',
			array(
				'label'     => __( 'Back Button Hover Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-home-val__btn-back:hover, {{WRAPPER}} .lre-home-val__btn--prev:hover, {{WRAPPER}} .wss-btn-back:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag           = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';
		$enable_reveal = ! empty( $s['enable_reveal'] ) && 'yes' === $s['enable_reveal'];
		$preset        = ! empty( $s['theme_preset'] ) ? $s['theme_preset'] : 'light';
		$preset_class  = 'wss-home-eval--' . $preset;
		if ( 'dark' === $preset ) {
			$preset_class .= ' wss-on-dark';
		} elseif ( 'taupe' === $preset ) {
			$preset_class .= ' wss-home-eval--taupe';
		}

		// ReCAPTCHA Keys
		$enable_recaptcha = ! empty( $s['enable_recaptcha'] ) && 'yes' === $s['enable_recaptcha'];
		$recaptcha_v      = ! empty( $s['recaptcha_version'] ) ? $s['recaptcha_version'] : 'v3';
		$site_key         = ! empty( $s['recaptcha_site_key'] ) ? $s['recaptcha_site_key'] : '';
		$secret_key       = ! empty( $s['recaptcha_secret_key'] ) ? $s['recaptcha_secret_key'] : '';

		$fields = ! empty( $s['form_fields'] ) ? $s['form_fields'] : array();

		// Separate into steps if step fields exist
		$has_steps = false;
		$steps     = array();
		$current_step = 1;

		foreach ( $fields as $item ) {
			if ( 'step' === $item['field_type'] ) {
				$has_steps = true;
				$steps[] = array(
					'step_num'   => count( $steps ) + 1,
					'step_phase' => ! empty( $item['step_phase'] ) ? $item['step_phase'] : sprintf( 'PHASE %02d', count( $steps ) + 1 ),
					'step_name'  => ! empty( $item['field_label'] ) ? $item['field_label'] : sprintf( 'Step %d', count( $steps ) + 1 ),
				);
			}
		}

		$total_steps = count( $steps );
		if ( $total_steps === 0 ) {
			$total_steps = 1;
		}
		?>
		<div class="lre-scope wss-scope">
			<section class="lre-home-val lre-home-val-section wss-home-eval-section <?php echo esc_attr( $preset_class ); ?>" data-lre-widget="lre-home-valuation" data-wss-widget="wss-home-evaluation">
				<div class="lre-container wss-container">
					
					<!-- Section Header -->
					<div class="lre-home-val__header wss-home-eval-header wss-reveal">
						<?php
						$raw_eyebrow  = ! empty( $s['eyebrow'] ) ? $s['eyebrow'] : '';
						$clean_eyebrow = preg_replace( '/^[\s—\-–]+/u', '', trim( $raw_eyebrow ) );
						if ( ! empty( $clean_eyebrow ) ) :
						?>
							<div class="lre-home-val__eyebrow-wrap wss-home-eval-eyebrow-wrap">
								<span class="lre-home-val__eyebrow-bar wss-home-eval-eyebrow-bar"></span>
								<span class="section-label lre-home-val__eyebrow wss-home-eval-eyebrow"><?php echo esc_html( $clean_eyebrow ); ?></span>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $s['heading'] ) ) : ?>
							<<?php echo esc_attr( $tag ); ?> class="lre-home-val__title section-title wss-home-eval-title">
								<span class="title-mask wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span>
							</<?php echo esc_attr( $tag ); ?>>
						<?php endif; ?>

						<?php if ( ! empty( $s['description'] ) ) : ?>
							<div class="lre-home-val__desc-wrap">
								<p class="lre-home-val__desc wss-home-eval-desc">
									<?php echo nl2br( esc_html( $s['description'] ) ); ?>
								</p>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $s['show_trust_pills'] ) && 'yes' === $s['show_trust_pills'] ) : ?>
							<?php
							$trust_pills = ! empty( $s['trust_pills'] ) && is_array( $s['trust_pills'] ) ? $s['trust_pills'] : array(
								array( 'text' => __( '100% Confidential & Off-Market', 'luxury-re-widgets' ), 'icon_type' => 'shield' ),
								array( 'text' => __( 'Human Econometric Analysis', 'luxury-re-widgets' ), 'icon_type' => 'check' ),
								array( 'text' => __( 'Complimentary 24-48h Delivery', 'luxury-re-widgets' ), 'icon_type' => 'clock' ),
							);
							?>
							<?php if ( ! empty( $trust_pills ) ) : ?>
								<div class="lre-home-val__pills wss-home-eval-trust-pills">
									<?php foreach ( $trust_pills as $pill ) : ?>
										<?php if ( ! empty( $pill['text'] ) ) : ?>
											<span class="lre-home-val__pill wss-trust-pill">
												<?php echo $this->render_trust_pill_icon( $pill['icon_type'] ?? 'shield', $pill['custom_icon'] ?? array() ); ?>
												<span><?php echo esc_html( $pill['text'] ); ?></span>
											</span>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

					<!-- Form Box Container -->
					<div class="lre-home-val__card wss-home-eval-box wss-reveal wss-r1">
						
						<!-- Step Tabs Progress Navigation (Rendered if multi-step) -->
						<?php if ( $has_steps && $total_steps > 1 ) : ?>
							<div class="lre-home-val__steps-wrapper wss-home-eval-steps-wrapper">
								<div class="lre-home-val__steps-nav wss-home-eval-steps-nav">
									<?php foreach ( $steps as $idx => $st ) : ?>
										<button class="lre-home-val__step-tab wss-home-eval-step-tab <?php echo ( 0 === $idx ) ? 'active' : ''; ?>" data-step="<?php echo esc_attr( $st['step_num'] ); ?>" type="button">
											<span class="lre-home-val__step-badge wss-step-num"><?php echo sprintf( '%02d', $st['step_num'] ); ?></span>
											<span class="lre-home-val__step-meta wss-step-details">
												<span class="lre-home-val__step-phase wss-step-phase"><?php echo esc_html( $st['step_phase'] ); ?></span>
												<span class="lre-home-val__step-name wss-step-name"><?php echo esc_html( $st['step_name'] ); ?></span>
											</span>
										</button>
									<?php endforeach; ?>
								</div>
								<div class="lre-home-val__progress-track wss-home-eval-progress-track">
									<div class="lre-home-val__progress-bar wss-home-eval-progress-fill" style="width: <?php echo esc_attr( round( 100 / $total_steps, 2 ) ); ?>%;"></div>
								</div>
							</div>
						<?php endif; ?>

						<!-- Master Form -->
						<form class="lre-home-val__form wss-home-eval-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							
							<input type="hidden" name="action" value="lre_home_valuation_submit">
							<input type="hidden" name="lre_val_nonce" value="<?php echo esc_attr( wp_create_nonce( 'lre_home_valuation_nonce' ) ); ?>">
							
							<!-- Config Passing -->
							<input type="hidden" name="admin_email_to" value="<?php echo esc_attr( $s['admin_email_to'] ?? '' ); ?>">
							<input type="hidden" name="admin_email_subject" value="<?php echo esc_attr( $s['admin_email_subject'] ?? '' ); ?>">
							<input type="hidden" name="enable_client_autoresponder" value="<?php echo esc_attr( $s['enable_client_autoresponder'] ?? 'yes' ); ?>">
							<input type="hidden" name="client_sender_name" value="<?php echo esc_attr( $s['client_sender_name'] ?? '' ); ?>">
							<input type="hidden" name="client_sender_email" value="<?php echo esc_attr( $s['client_sender_email'] ?? '' ); ?>">
							<input type="hidden" name="client_email_subject" value="<?php echo esc_attr( $s['client_email_subject'] ?? '' ); ?>">
							<input type="hidden" name="recaptcha_secret" value="<?php echo esc_attr( $secret_key ); ?>">

							<?php
							$step_index = 0;
							$in_step = false;

							foreach ( $fields as $f_idx => $field ) :
								$type     = ! empty( $field['field_type'] ) ? $field['field_type'] : 'text';
								$label    = ! empty( $field['field_label'] ) ? $field['field_label'] : '';
								$pl       = ! empty( $field['placeholder'] ) ? $field['placeholder'] : '';
								$req      = ! empty( $field['required'] ) && 'yes' === $field['required'];
								$col      = ! empty( $field['column_width'] ) ? $field['column_width'] : '100';
								$def      = ! empty( $field['default_value'] ) ? $field['default_value'] : '';
								$f_id     = ! empty( $field['_id'] ) ? $field['_id'] : 'f_' . $f_idx;
								$raw_opts = ! empty( $field['field_options'] ) ? array_filter( array_map( 'trim', explode( "\n", $field['field_options'] ) ) ) : array();

								if ( 'step' === $type ) :
									// Close previous step pane if open
									if ( $in_step ) :
										?>
											</div><!-- /.wss-form-grid-wrap -->
											<div class="lre-home-val__btn-row wss-btn-nav-row">
												<?php if ( $step_index > 1 ) : ?>
													<button type="button" class="lre-home-val__btn-back wss-btn-back" data-prev="<?php echo esc_attr( $step_index - 1 ); ?>"><span class="lre-home-val__btn-arrow-back">←</span> <span><?php echo esc_html( $s['prev_btn_text'] ?? __( 'Back', 'luxury-re-widgets' ) ); ?></span></button>
												<?php else : ?>
													<div></div>
												<?php endif; ?>
												
												<button type="button" class="lre-home-val__btn lre-home-val__btn--next wss-home-eval-next-btn" data-next="<?php echo esc_attr( $step_index + 1 ); ?>">
													<span class="lre-home-val__btn-text"><?php echo esc_html( $s['next_btn_text'] ?? __( 'Continue', 'luxury-re-widgets' ) ); ?></span>
													<span class="lre-home-val__btn-arrow">→</span>
												</button>
											</div>
										</div><!-- /.wss-home-eval-step-pane -->
										<?php
									endif;

									$step_index++;
									$in_step = true;
									$is_active = ( 1 === $step_index );
									?>
									<div class="lre-home-val__step-pane wss-home-eval-step-pane <?php echo $is_active ? 'active' : ''; ?>" data-step-pane="<?php echo esc_attr( $step_index ); ?>" style="<?php echo $is_active ? '' : 'display:none;'; ?>">
										<div class="lre-home-val__grid wss-form-grid-wrap">
									<?php
									continue;
								endif;

								if ( ! $in_step ) {
									// In case no step field was added at the very beginning
									$step_index = 1;
									$in_step = true;
									?>
									<div class="lre-home-val__step-pane wss-home-eval-step-pane active" data-step-pane="1">
										<div class="lre-home-val__grid wss-form-grid-wrap">
									<?php
								}
								?>

								<div class="lre-home-val__field wss-form-col wss-col-<?php echo esc_attr( $col ); ?> elementor-repeater-item-<?php echo esc_attr( $f_id ); ?>">
									
									<?php if ( ! empty( $label ) && 'html' !== $type && 'checkbox' !== $type && 'radio' !== $type ) : ?>
										<label class="lre-home-val__label wss-field-label" for="wss_in_<?php echo esc_attr( $f_id ); ?>">
											<?php echo esc_html( $label ); ?> <?php if ( $req ) echo '<span class="lre-req wss-req">*</span>'; ?>
										</label>
									<?php endif; ?>

									<?php if ( 'text' === $type ) : ?>
										<input type="text" id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="lre-home-val__input wss-home-eval-input" placeholder="<?php echo esc_attr( $pl ); ?>" value="<?php echo esc_attr( $def ); ?>" <?php echo $req ? 'required' : ''; ?>>

									<?php elseif ( 'email' === $type ) : ?>
										<input type="email" id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="lre-home-val__input wss-home-eval-input" placeholder="<?php echo esc_attr( $pl ); ?>" value="<?php echo esc_attr( $def ); ?>" <?php echo $req ? 'required' : ''; ?>>

									<?php elseif ( 'tel' === $type ) : ?>
										<input type="tel" id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="lre-home-val__input wss-home-eval-input" placeholder="<?php echo esc_attr( $pl ); ?>" value="<?php echo esc_attr( $def ); ?>" <?php echo $req ? 'required' : ''; ?>>

									<?php elseif ( 'number' === $type ) : ?>
										<input type="number" id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="lre-home-val__input wss-home-eval-input" placeholder="<?php echo esc_attr( $pl ); ?>" value="<?php echo esc_attr( $def ); ?>" <?php echo $req ? 'required' : ''; ?>>

									<?php elseif ( 'textarea' === $type ) : ?>
										<textarea id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="lre-home-val__input wss-home-eval-input" rows="3" placeholder="<?php echo esc_attr( $pl ); ?>" <?php echo $req ? 'required' : ''; ?>><?php echo esc_textarea( $def ); ?></textarea>

									<?php elseif ( 'select' === $type ) : ?>
										<select id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="lre-home-val__input lre-home-val__select wss-home-eval-input wss-home-eval-select" <?php echo $req ? 'required' : ''; ?>>
											<?php if ( ! empty( $pl ) ) : ?>
												<option value="" disabled <?php echo empty( $def ) ? 'selected' : ''; ?>><?php echo esc_html( $pl ); ?></option>
											<?php endif; ?>
											<?php foreach ( $raw_opts as $opt ) : ?>
												<option value="<?php echo esc_attr( $opt ); ?>" <?php echo ( $opt === $def ) ? 'selected' : ''; ?>><?php echo esc_html( $opt ); ?></option>
											<?php endforeach; ?>
										</select>

									<?php elseif ( 'checkbox' === $type ) : ?>
										<?php if ( ! empty( $label ) ) : ?>
											<label class="lre-home-val__label wss-field-label">
												<?php echo esc_html( $label ); ?> <?php if ( $req ) echo '<span class="lre-req wss-req">*</span>'; ?>
											</label>
										<?php endif; ?>
										<div class="wss-amenity-grid">
											<?php foreach ( $raw_opts as $opt ) : ?>
												<label class="wss-home-eval-amenity-box">
													<input type="checkbox" name="wss_fields[<?php echo esc_attr( $label ); ?>][]" value="<?php echo esc_attr( $opt ); ?>">
													<span class="wss-custom-check">
														<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
													</span>
													<span class="wss-home-eval-amenity-label"><?php echo esc_html( $opt ); ?></span>
												</label>
											<?php endforeach; ?>
										</div>

									<?php elseif ( 'radio' === $type ) : ?>
										<?php if ( ! empty( $label ) ) : ?>
											<label class="lre-home-val__label wss-field-label">
												<?php echo esc_html( $label ); ?> <?php if ( $req ) echo '<span class="lre-req wss-req">*</span>'; ?>
											</label>
										<?php endif; ?>
										<div class="wss-amenity-grid">
											<?php foreach ( $raw_opts as $opt ) : ?>
												<label class="wss-home-eval-amenity-box">
													<input type="radio" name="wss_fields[<?php echo esc_attr( $label ); ?>]" value="<?php echo esc_attr( $opt ); ?>" <?php echo ( $opt === $def ) ? 'checked' : ''; ?>>
													<span class="wss-custom-check wss-custom-check--radio">
														<span class="wss-radio-dot"></span>
													</span>
													<span class="wss-home-eval-amenity-label"><?php echo esc_html( $opt ); ?></span>
												</label>
											<?php endforeach; ?>
										</div>

									<?php elseif ( 'html' === $type ) : ?>
										<div class="wss-custom-html-block">
											<?php echo wp_kses_post( $field['raw_html'] ?? '' ); ?>
										</div>

									<?php endif; ?>

								</div>

							<?php endforeach; ?>

							<?php if ( $in_step ) : ?>
								</div><!-- /.wss-form-grid-wrap -->

								<!-- Google reCAPTCHA v2 Checkbox UI on Final Step -->
								<?php if ( $enable_recaptcha && 'v2' === $recaptcha_v ) : ?>
									<div class="wss-form-row wss-recaptcha-wrap" style="margin: 16px 0;">
										<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $site_key ); ?>"></div>
									</div>
									<script src="https://www.google.com/recaptcha/api.js" async defer></script>
								<?php elseif ( $enable_recaptcha && 'v3' === $recaptcha_v ) : ?>
									<input type="hidden" name="g-recaptcha-response" class="wss-home-eval-recaptcha-token" value="">
									<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr( $site_key ); ?>"></script>
									<script>
										if (typeof grecaptcha !== 'undefined') {
											grecaptcha.ready(function() {
												grecaptcha.execute('<?php echo esc_js( $site_key ); ?>', {action: 'home_eval_submit'}).then(function(token) {
													var tokens = document.querySelectorAll('.wss-home-eval-recaptcha-token');
													tokens.forEach(function(el) { el.value = token; });
												});
											});
										}
									</script>
								<?php endif; ?>

								<div class="lre-home-val__btn-row wss-btn-nav-row">
									<?php if ( $step_index > 1 ) : ?>
										<button type="button" class="lre-home-val__btn-back wss-btn-back" data-prev="<?php echo esc_attr( $step_index - 1 ); ?>"><span class="lre-home-val__btn-arrow-back">←</span> <span><?php echo esc_html( $s['prev_btn_text'] ?? __( 'Back', 'luxury-re-widgets' ) ); ?></span></button>
									<?php else : ?>
										<div></div>
									<?php endif; ?>

									<button type="submit" class="lre-home-val__btn lre-home-val__btn--submit wss-home-eval-submit-btn">
										<span class="lre-home-val__btn-text"><?php echo esc_html( $s['submit_btn_text'] ?? __( 'Request Confidential Valuation', 'luxury-re-widgets' ) ); ?></span>
										<span class="lre-home-val__btn-arrow">→</span>
									</button>
								</div>

								<?php if ( ! empty( $s['privacy_note'] ) ) : ?>
									<div class="wss-home-eval-privacy-badge">
										<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
										<span><?php echo esc_html( $s['privacy_note'] ); ?></span>
									</div>
								<?php endif; ?>

								</div><!-- /.wss-home-eval-step-pane -->
							<?php endif; ?>

						</form>

						<!-- Animated Luxury Success State -->
						<div class="wss-home-eval-success-state" style="display: none;">
							<div class="wss-success-icon-badge">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
							</div>
							<h3 class="wss-success-title"><?php echo esc_html( $s['success_title'] ?? __( 'Valuation Request Received', 'luxury-re-widgets' ) ); ?></h3>
							<p class="wss-success-desc"><?php echo nl2br( esc_html( $s['success_message'] ?? __( 'Thank you. Adolfo Aguirre and our analytics team have initiated your sub-market comparative study. Your confidential property dossier is being assembled.', 'luxury-re-widgets' ) ) ); ?></p>
							<button type="button" class="wss-home-eval-reset-btn">
								<span><?php echo esc_html( $s['reset_btn_text'] ?? __( 'Submit Another Property', 'luxury-re-widgets' ) ); ?></span>
							</button>
						</div>

					</div>

				</div>
			</section>
		</div>
		<?php
	}

	protected function render_trust_pill_icon( $icon_type, $custom_icon = array() ) {
		switch ( $icon_type ) {
			case 'shield':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>';
			case 'check':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>';
			case 'clock':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
			case 'lock':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>';
			case 'star':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
			case 'award':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>';
			case 'custom':
				if ( ! empty( $custom_icon['value'] ) ) {
					ob_start();
					Icons_Manager::render_icon( $custom_icon, array( 'aria-hidden' => 'true' ) );
					return ob_get_clean();
				}
				return '';
			case 'none':
			default:
				return '';
		}
	}
}
