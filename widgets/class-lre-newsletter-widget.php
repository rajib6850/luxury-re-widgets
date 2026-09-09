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
				'label'   => __( 'Headline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Stay Ahead of the Southern California Market.',
				'dynamic' => array( 'active' => true ),
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

		$this->add_control(
			'button_text',
			array(
				'label'   => __( 'Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SUBSCRIBE',
				'dynamic' => array( 'active' => true ),
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
				'selector' => '{{WRAPPER}} .lre-newsletter-white__title',
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Headline Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#02293f',
				'selectors' => array(
					'{{WRAPPER}} .lre-newsletter-white__title' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
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

					<h3 class="lre-newsletter-white__title"><?php echo esc_html( $settings['title'] ); ?></h3>

					<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
						<p class="lre-newsletter-white__subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></p>
					<?php endif; ?>
				</div>

				<!-- Luxury Form -->
				<div class="lre-newsletter-white__form-wrap">
					<form class="lre-newsletter__form lre-newsletter-white__form" method="post" action="#">
						<input type="hidden" name="action" value="lre_newsletter_submit">
						<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'lre_nonce' ) ); ?>">

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

						<div class="lre-newsletter__message" aria-live="polite"></div>
					</form>
				</div>

			</div>
		</div>
		<?php
	}
}
