<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

/**
 * LRE_Button_Widget
 *
 * Standalone Universal Luxury Button Widget.
 * Engineered for Adolfo Aguirre (SERHANT.) with identical sliding-fill shimmer
 * animations, hover transitions, and typography matching all section buttons.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Button_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_button';
	}

	public function get_title() {
		return __( 'LRE — Luxury Action Button', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'button', 'cta', 'link', 'action', 'luxury', 'sliding', 'shimmer' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button Configuration', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'text',
			array(
				'label'       => __( 'Button Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'SUBMIT', 'luxury-re-widgets' ),
				'placeholder' => __( 'e.g. SUBMIT, REQUEST ACCESS', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'default'     => array( 'url' => '#contact' ),
				'dynamic'     => array( 'active' => true ),
				'placeholder' => 'https://adolfoaguirrere.com/contact/',
			)
		);

		$this->add_control(
			'style_preset',
			array(
				'label'   => __( 'Luxury Style Preset', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'outline_dark',
				'options' => array(
					'outline_dark'  => __( 'Minimal Dark Outline (Exact Popup Style)', 'luxury-re-widgets' ),
					'solid_gold'    => __( 'Solid Gold (Signature Sliding Shimmer)', 'luxury-re-widgets' ),
					'solid_navy'    => __( 'Solid Navy (Deep Luxury)', 'luxury-re-widgets' ),
					'outline_gold'  => __( 'Outline Gold', 'luxury-re-widgets' ),
					'outline_white' => __( 'Outline White (For Dark Backgrounds)', 'luxury-re-widgets' ),
					'underline'     => __( 'Architectural Underline Link', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'show_icon',
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
			'full_width',
			array(
				'label'        => __( 'Full Width Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'prefix_class' => 'lre-btn-fullwidth-',
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
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-btn-wrap' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'custom_attr',
			array(
				'label'       => __( 'Custom Attributes / Modal Trigger', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'data-lre-modal="contact"',
				'description' => __( 'Add custom attributes like data-lre-fub-trigger="popup" if needed.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Button Styling & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .lre-atomic-btn',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		// NORMAL
		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-btn' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-atomic-btn svg' => 'stroke: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'background_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-btn' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-btn' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		// HOVER
		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'hover_text_color',
			array(
				'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-btn:hover' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-atomic-btn:hover svg' => 'stroke: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'hover_background_color',
			array(
				'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-btn:hover' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-atomic-btn::before' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-btn:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .lre-atomic-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-atomic-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['text'] ) ) {
			return;
		}

		$url_data = $settings['link'] ?? array();
		$url      = ! empty( $url_data['url'] ) ? esc_url( $url_data['url'] ) : '#';
		$target   = ! empty( $url_data['is_external'] ) ? ' target="_blank"' : '';
		$nofollow = ! empty( $url_data['nofollow'] ) ? ' rel="nofollow"' : '';

		$style_preset = $settings['style_preset'] ?? 'outline_dark';
		$btn_class    = 'lre-atomic-btn btn lre-btn--' . sanitize_html_class( $style_preset );
		if ( 'yes' === ( $settings['full_width'] ?? 'no' ) ) {
			$btn_class .= ' lre-atomic-btn--fullwidth';
		}

		$custom_attr = ! empty( $settings['custom_attr'] ) ? ' ' . esc_attr( $settings['custom_attr'] ) : '';
		?>
		<div class="lre-atomic-btn-wrap">
			<a href="<?php echo $url; ?>" class="<?php echo esc_attr( $btn_class ); ?>"<?php echo $target . $nofollow . $custom_attr; ?>>
				<span class="lre-atomic-btn__text"><?php echo esc_html( $settings['text'] ); ?></span>
				<?php if ( 'yes' === ( $settings['show_icon'] ?? 'no' ) ) : ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="lre-atomic-btn__icon" aria-hidden="true">
						<line x1="5" y1="12" x2="19" y2="12"></line>
						<polyline points="12 5 19 12 12 19"></polyline>
					</svg>
				<?php endif; ?>
			</a>
		</div>
		<?php
	}
}
