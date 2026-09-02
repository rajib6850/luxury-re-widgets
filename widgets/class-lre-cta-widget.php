<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_CTA_Widget
 * Call to Action section with parallax background, dual buttons, and luxury styling.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_CTA_Widget extends Widget_Base {

	public function get_name()       { return 'lre_cta'; }
	public function get_title()      { return __( 'LRE — Call to Action', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-call-to-action'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'cta', 'call to action', 'banner', 'contact', 'buttons', 'luxury' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── MEDIA ──
		$this->start_controls_section( 'section_media', array( 'label' => __( 'Background Image', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'bg_image', array(
			'label'   => __( 'Image', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => array( 'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1920&q=80' ),
			'dynamic' => array( 'active' => true ),
		) );
		$this->end_controls_section();

		// ── CONTENT ──
		$this->start_controls_section( 'section_content', array( 'label' => __( 'Text Content', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'eyebrow',     array( 'label' => __( 'Eyebrow',     'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,     'default' => 'Let\'s Connect', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_1',   array( 'label' => __( 'Title Line 1', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,     'default' => 'Your Next Chapter', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_2',   array( 'label' => __( 'Title Line 2', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,     'default' => 'Starts Here', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_tag', array( 'label' => __( 'Heading Tag',  'luxury-re-widgets' ), 'type' => Controls_Manager::SELECT,   'default' => 'h2', 'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'div' => 'div' ) ) );
		$this->add_control( 'description', array( 'label' => __( 'Description',  'luxury-re-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Whether you're envisioning a new beginning, planning a strategic sale, or simply curious about what your home is worth—our team is ready to deliver answers and results with the discretion you expect.', 'dynamic' => array( 'active' => true ) ) );
		$this->end_controls_section();

		// ── BUTTONS ──
		$this->start_controls_section( 'section_buttons', array( 'label' => __( 'Action Buttons', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'btn1_text', array( 'label' => __( 'Button 1 Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Get A Private Valuation', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn1_url',  array( 'label' => __( 'Button 1 URL',  'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#contact' ) ) );
		$this->add_control( 'btn2_text', array( 'label' => __( 'Button 2 Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Book A Consultation', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn2_url',  array( 'label' => __( 'Button 2 URL',  'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#contact' ) ) );
		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: Section & Overlay ──
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section & Overlay', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'overlay_color', array( 'label' => __( 'Overlay Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__overlay' => 'background: {{VALUE}};' ) ) );
		$this->add_responsive_control( 'section_padding', array( 'label' => __( 'Padding', 'luxury-re-widgets' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em', 'rem' ), 'selectors' => array( '{{WRAPPER}} .cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Typography ──
		$this->start_controls_section( 'style_typo', array( 'label' => __( 'Typography & Colors', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'title_typography', 'label' => __( 'Title Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .cta__title' ) );
		$this->add_control( 'title_color', array( 'label' => __( 'Title Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__title' => 'color: {{VALUE}};' ) ) );

		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'desc_typography', 'label' => __( 'Description Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .cta__description' ) );
		$this->add_control( 'desc_color', array( 'label' => __( 'Description Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__description' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Buttons ──
		$this->start_controls_section( 'style_buttons', array( 'label' => __( 'Buttons', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_cta_btns' );
			$this->start_controls_tab( 'tab_cta_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .cta__buttons .btn' ) );
			$this->add_control( 'btn1_color', array( 'label' => __( 'Button 1 Text Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__buttons .btn--primary' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'btn1_bg',    array( 'label' => __( 'Button 1 Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__buttons .btn--primary' => 'background: {{VALUE}};' ) ) );
			$this->add_control( 'btn2_color', array( 'label' => __( 'Button 2 Text Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__buttons .btn--outline-white' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'btn2_border', array( 'label' => __( 'Button 2 Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__buttons .btn--outline-white' => 'border-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_cta_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'btn1_hover_bg',    array( 'label' => __( 'Button 1 Hover Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__buttons .btn--primary:hover' => 'background: {{VALUE}};' ) ) );
			$this->add_control( 'btn2_hover_bg',    array( 'label' => __( 'Button 2 Hover Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__buttons .btn--outline-white:hover' => 'background-color: {{VALUE}};' ) ) );
			$this->add_control( 'btn2_hover_color', array( 'label' => __( 'Button 2 Hover Text Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .cta__buttons .btn--outline-white:hover' => 'color: {{VALUE}};' ) ) );
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$tag         = esc_attr( $settings['heading_tag'] );
		$img_url     = ! empty( $settings['bg_image']['url'] ) ? $settings['bg_image']['url'] : 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1920&q=80';
		$btn1_url    = esc_url( $settings['btn1_url']['url'] ?? '#contact' );
		$btn1_target = ! empty( $settings['btn1_url']['is_external'] ) ? '_blank' : '_self';
		$btn2_url    = esc_url( $settings['btn2_url']['url'] ?? '#contact' );
		$btn2_target = ! empty( $settings['btn2_url']['is_external'] ) ? '_blank' : '_self';
		?>
		<section class="cta" id="contact" aria-label="<?php esc_attr_e( 'Call to action', 'luxury-re-widgets' ); ?>">
			<div class="cta__background">
				<?php if ( ! empty( $img_url ) ) : ?>
				<img src="<?php echo esc_url( $img_url ); ?>"
				     alt="<?php esc_attr_e( 'Luxury real estate', 'luxury-re-widgets' ); ?>"
				     loading="lazy">
				<?php endif; ?>
			</div>
			<div class="cta__overlay"></div>

			<div class="container cta__content reveal">
				<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
				<span class="section-label section-label--gold"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
				<?php endif; ?>

				<<?php echo $tag; ?> class="cta__title">
					<?php if ( ! empty( $settings['heading_1'] ) ) : ?>
					<span class="title-mask"><span><?php echo esc_html( $settings['heading_1'] ); ?></span></span><br>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading_2'] ) ) : ?>
					<span class="title-mask"><span><?php echo esc_html( $settings['heading_2'] ); ?></span></span>
					<?php endif; ?>
				</<?php echo $tag; ?>>

				<?php if ( ! empty( $settings['description'] ) ) : ?>
				<p class="cta__description delay-2"><?php echo esc_html( $settings['description'] ); ?></p>
				<?php endif; ?>

				<div class="cta__buttons delay-3">
					<?php if ( ! empty( $settings['btn1_text'] ) ) : ?>
					<a href="<?php echo $btn1_url; ?>" target="<?php echo esc_attr( $btn1_target ); ?>" class="btn btn--primary">
						<span><?php echo esc_html( $settings['btn1_text'] ); ?></span>
					</a>
					<?php endif; ?>
					<?php if ( ! empty( $settings['btn2_text'] ) ) : ?>
					<a href="<?php echo $btn2_url; ?>" target="<?php echo esc_attr( $btn2_target ); ?>" class="btn btn--outline-white">
						<span><?php echo esc_html( $settings['btn2_text'] ); ?></span>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}