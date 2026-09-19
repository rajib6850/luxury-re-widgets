<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * LRE_Description_Widget
 *
 * Standalone Luxury Description & Prose Widget.
 * Designed for Adolfo Aguirre (SERHANT.) to maintain 100% typography,
 * line-height, letter-spacing, and editorial elegance across all layouts.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Description_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_description';
	}

	public function get_title() {
		return __( 'LRE — Luxury Description & Prose', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'description', 'text', 'prose', 'subhead', 'luxury', 'editorial', 'paragraph' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content & Narrative', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'content',
			array(
				'label'       => __( 'Description Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( 'SAY GOODBYE TO ENDLESS SEARCHING. GET LISTINGS TAILORED TO YOUR DREAM HOME CRITERIA SENT DIRECTLY TO YOUR INBOX!', 'luxury-re-widgets' ),
				'placeholder' => __( 'Enter description text here...', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'style_preset',
			array(
				'label'   => __( 'Style Preset', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'editorial',
				'options' => array(
					'editorial' => __( 'Quiet Luxury (Editorial Sans)', 'luxury-re-widgets' ),
					'uppercase' => __( 'Architectural All-Caps (Editorial Monograph)', 'luxury-re-widgets' ),
					'lead'      => __( 'Lead-in Statement (Larger Display)', 'luxury-re-widgets' ),
					'quote'     => __( 'Discreet Quote (Italic with Accent Line)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-desc-wrap' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'max_width',
			array(
				'label'      => __( 'Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'rem', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 200, 'max' => 1400 ),
					'%'  => array( 'min' => 10,  'max' => 100 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-atomic-desc' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c3539',
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-desc' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-atomic-desc p' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .lre-atomic-desc, {{WRAPPER}} .lre-atomic-desc p',
			)
		);

		$this->add_responsive_control(
			'desc_margin',
			array(
				'label'      => __( 'Margin', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'default'    => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '1.5',
					'left'     => '0',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-atomic-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['content'] ) ) {
			return;
		}

		$style_preset = $settings['style_preset'] ?? 'editorial';
		$preset_class = 'lre-desc--' . sanitize_html_class( $style_preset );
		?>
		<div class="lre-atomic-desc-wrap">
			<div class="lre-atomic-desc <?php echo esc_attr( $preset_class ); ?>">
				<?php echo wp_kses_post( $settings['content'] ); ?>
			</div>
		</div>
		<?php
	}
}
