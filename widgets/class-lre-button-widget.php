<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * LRE_Button_Widget
 *
 * Standalone Universal Luxury Button Widget.
 * Uses the exact master `.btn` class hierarchy (`.btn--outline`, `.btn--outline-white`,
 * `.btn--gold`, `.btn--primary`) with vertical sliding fill (`::before`) and
 * luxury diagonal light reflection shimmer (`::after`) matching all sections.
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
				'placeholder' => __( 'e.g. SUBMIT, SCHEDULE A CONVERSATION', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'html_tag',
			array(
				'label'   => __( 'Button Element Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'a',
				'options' => array(
					'a'      => '<a> ' . __( 'Link / URL Navigation', 'luxury-re-widgets' ),
					'button' => '<button> ' . __( 'Button / Form Submit / Modal Trigger', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'button_type',
			array(
				'label'     => __( 'Button Type', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'button',
				'options'   => array(
					'button' => __( 'Button (Modal / Trigger)', 'luxury-re-widgets' ),
					'submit' => __( 'Submit (Form Submission)', 'luxury-re-widgets' ),
					'reset'  => __( 'Reset', 'luxury-re-widgets' ),
				),
				'condition' => array( 'html_tag' => 'button' ),
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
				'condition'   => array( 'html_tag' => 'a' ),
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

		$this->add_control(
			'icon_type',
			array(
				'label'     => __( 'Arrow Icon Type', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'diagonal',
				'options'   => array(
					'diagonal'    => '↗ ' . __( 'Diagonal Arrow (Portfolio / Ledger Style)', 'luxury-re-widgets' ),
					'arrow_right' => '→ ' . __( 'Right Arrow SVG (Newsletter Style)', 'luxury-re-widgets' ),
				),
				'condition' => array( 'show_icon' => 'yes' ),
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
				'description' => __( 'Optional HTML attributes (e.g. data-lre-fub-trigger="popup").', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Custom Overrides (Optional)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .btn',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		// NORMAL
		$this->start_controls_tab(
			'tab_button_normal',
			array( 'label' => __( 'Normal', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'custom_text_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .btn' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'custom_bg_color',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .btn' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'custom_border_color',
			array(
				'label'     => __( 'Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .btn' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		// HOVER
		$this->start_controls_tab(
			'tab_button_hover',
			array( 'label' => __( 'Hover', 'luxury-re-widgets' ) )
		);

		$this->add_control(
			'custom_hover_text_color',
			array(
				'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .btn:hover' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'custom_hover_bg_color',
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
			'custom_hover_border_color',
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
			'padding',
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

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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

		// Core master button classes
		$classes   = array( 'btn' );
		$classes[] = ! empty( $settings['button_variant'] ) ? $settings['button_variant'] : 'btn--outline';

		if ( ! empty( $settings['button_size'] ) && 'btn--sm' === $settings['button_size'] ) {
			$classes[] = 'btn--sm';
		}

		if ( 'yes' === ( $settings['full_width'] ?? 'no' ) ) {
			$classes[] = 'btn--fullwidth';
		}

		$custom_attr = ! empty( $settings['custom_attr'] ) ? ' ' . esc_attr( $settings['custom_attr'] ) : '';
		$tag         = ( isset( $settings['html_tag'] ) && 'button' === $settings['html_tag'] ) ? 'button' : 'a';
		$btn_type    = ! empty( $settings['button_type'] ) ? esc_attr( $settings['button_type'] ) : 'button';
		$icon_type   = $settings['icon_type'] ?? 'diagonal';
		?>
		<div class="lre-atomic-btn-wrap">
			<?php if ( 'button' === $tag ) : ?>
				<button type="<?php echo $btn_type; ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"<?php echo $custom_attr; ?>>
					<span class="btn__text"><?php echo esc_html( $settings['text'] ); ?></span>
					<?php if ( 'yes' === ( $settings['show_icon'] ?? 'no' ) ) : ?>
						<?php if ( 'arrow_right' === $icon_type ) : ?>
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="lre-newsletter__btn-icon btn__icon" aria-hidden="true">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						<?php else : ?>
							<span class="btn__icon" aria-hidden="true">↗</span>
						<?php endif; ?>
					<?php endif; ?>
				</button>
			<?php else : ?>
				<a href="<?php echo $url; ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"<?php echo $target . $nofollow . $custom_attr; ?>>
					<span class="btn__text"><?php echo esc_html( $settings['text'] ); ?></span>
					<?php if ( 'yes' === ( $settings['show_icon'] ?? 'no' ) ) : ?>
						<?php if ( 'arrow_right' === $icon_type ) : ?>
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="lre-newsletter__btn-icon btn__icon" aria-hidden="true">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						<?php else : ?>
							<span class="btn__icon" aria-hidden="true">↗</span>
						<?php endif; ?>
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</div>
		<?php
	}
}
