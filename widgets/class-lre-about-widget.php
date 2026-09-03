<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_About_Widget
 * About Our Story section with parallax watermark, clip-mask heading,
 * and solid-shutter-wipe image reveal.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_About_Widget extends Widget_Base {

	public function get_name()       { return 'lre_about'; }
	public function get_title()      { return __( 'LRE — About Our Story', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-info-circle-o'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'about', 'story', 'image', 'text', 'watermark', 'luxury' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── TEXT CONTENT ──
		$this->start_controls_section( 'section_content', array(
			'label' => __( 'Content', 'luxury-re-widgets' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		) );
		$this->add_control( 'watermark', array( 'label' => __( 'Watermark Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'ABOUT', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Our Story', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_line1', array( 'label' => __( 'Heading Line 1', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Redefining Luxury', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_line2', array( 'label' => __( 'Heading Line 2', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Real Estate On The', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_line3', array( 'label' => __( 'Heading Accent Line 3', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'West Coast.', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_tag', array( 'label' => __( 'Heading Tag', 'luxury-re-widgets' ), 'type' => Controls_Manager::SELECT, 'default' => 'h2', 'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'div' => 'div' ) ) );
		$this->add_control( 'description', array( 'label' => __( 'Description', 'luxury-re-widgets' ), 'type' => Controls_Manager::WYSIWYG, 'default' => "Founded on the belief that finding the right home is deeply personal, Crestwood & Associates combines two decades of market expertise with a concierge-level approach. We don't just open doors—we open possibilities. Every client, every property, every detail handled with the care it deserves." ) );
		$this->add_control( 'btn_text', array( 'label' => __( 'Button Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Read More', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn_url',  array( 'label' => __( 'Button URL',  'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();

		// ── MEDIA ──
		$this->start_controls_section( 'section_media', array(
			'label' => __( 'Featured Image', 'luxury-re-widgets' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		) );
		$this->add_control( 'main_image', array(
			'label'   => __( 'Main Image', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => array( 'url' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=900&q=85' ),
			'dynamic' => array( 'active' => true ),
		) );
		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: Section ──
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'section_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .about' => 'background-color: {{VALUE}};' ) ) );
		$this->add_responsive_control( 'section_padding', array( 'label' => __( 'Padding', 'luxury-re-widgets' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em', 'rem', '%' ), 'selectors' => array( '{{WRAPPER}} .about' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Watermark ──
		$this->start_controls_section( 'style_watermark', array( 'label' => __( 'Watermark', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'watermark_typography', 'selector' => '{{WRAPPER}} .about__watermark' ) );
		$this->add_control( 'watermark_color', array( 'label' => __( 'Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .about__watermark' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Eyebrow ──
		$this->start_controls_section( 'style_eyebrow', array( 'label' => __( 'Eyebrow', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .section-label' ) );
		$this->add_control( 'eyebrow_color', array( 'label' => __( 'Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .section-label' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Heading ──
		$this->start_controls_section( 'style_heading', array( 'label' => __( 'Heading', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .about__title' ) );
		$this->add_control( 'heading_color', array( 'label' => __( 'Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .about__title' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Description ──
		$this->start_controls_section( 'style_desc', array( 'label' => __( 'Description', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .about__description' ) );
		$this->add_control( 'desc_color', array( 'label' => __( 'Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .about__description' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Button ──
				$this->start_controls_section(
			'style_btn',
			array(
				'label' => __( 'Button', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .about .btn',
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '0.95',
					'right'    => '2.2',
					'bottom'   => '0.95',
					'left'     => '2.2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .about .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_btn' );
			$this->start_controls_tab( 'tab_btn_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .about .btn' => 'color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn_bg',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .about .btn' => 'background-color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .about .btn' => 'border-color: {{VALUE}} !important;' ),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_btn_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn_color_hover',
				array(
					'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .about .btn:hover' => 'color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn_bg_hover',
				array(
					'label'     => __( 'Hover Background', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .about .btn:hover, {{WRAPPER}} .about .btn:hover::before' => 'background-color: {{VALUE}} !important; background: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn_border_hover',
				array(
					'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .about .btn:hover' => 'border-color: {{VALUE}} !important;' ),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// ── STYLE: Image Frame ──
		$this->start_controls_section( 'style_frame', array( 'label' => __( 'Image Gold Frame', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'frame_color', array( 'label' => __( 'Frame Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .about__image-frame' => 'border-color: {{VALUE}};' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$tag        = esc_attr( $settings['heading_tag'] );
		$watermark  = esc_html( $settings['watermark'] );
		$img_url    = ! empty( $settings['main_image']['url'] ) ? $settings['main_image']['url'] : 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=900&q=85';
		$btn_url    = esc_url( $settings['btn_url']['url'] ?? '#' );
		$btn_target = ! empty( $settings['btn_url']['is_external'] ) ? '_blank' : '_self';
		?>
		<section class="about" id="about" aria-label="<?php esc_attr_e( 'About our team', 'luxury-re-widgets' ); ?>">
			<?php if ( ! empty( $watermark ) ) : ?>
			<div class="about__watermark" id="about-watermark" aria-hidden="true"><?php echo $watermark; ?></div>
			<?php endif; ?>
			<div class="container about__content">
				<div class="about__text reveal">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<span class="section-label"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>

					<<?php echo $tag; ?> class="about__title">
						<?php if ( ! empty( $settings['heading_line1'] ) ) : ?>
						<span class="title-mask"><span><?php echo esc_html( $settings['heading_line1'] ); ?></span></span><br>
						<?php endif; ?>
						<?php if ( ! empty( $settings['heading_line2'] ) ) : ?>
						<span class="title-mask"><span><?php echo esc_html( $settings['heading_line2'] ); ?></span></span><br>
						<?php endif; ?>
						<?php if ( ! empty( $settings['heading_line3'] ) ) : ?>
						<span class="title-mask"><span><span class="about__title-accent"><?php echo esc_html( $settings['heading_line3'] ); ?></span></span></span>
						<?php endif; ?>
					</<?php echo $tag; ?>>

					<div class="about__description delay-2">
						<?php echo wp_kses_post( $settings['description'] ); ?>
					</div>

					<?php if ( ! empty( $settings['btn_text'] ) ) : ?>
					<a href="<?php echo $btn_url; ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn--outline delay-3">
						<span><?php echo esc_html( $settings['btn_text'] ); ?></span>
					</a>
					<?php endif; ?>
				</div>

				<div class="about__image">
					<div class="about__image-wrapper">
						<div class="about__image-frame"></div>
						<div class="about__image-inner image-reveal">
							<?php if ( ! empty( $img_url ) ) : ?>
							<img src="<?php echo esc_url( $img_url ); ?>"
							     alt="<?php esc_attr_e( 'Luxury architectural finishes', 'luxury-re-widgets' ); ?>"
							     loading="lazy" width="800" height="1000">
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}