<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Testimonials_Widget
 * Testimonials slider with client portrait image, harmonious height controls, and navigation.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Testimonials_Widget extends Widget_Base {

	public function get_name()       { return 'lre_testimonials'; }
	public function get_title()      { return __( 'LRE — Client Testimonials', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-testimonial-carousel'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'testimonials', 'reviews', 'clients', 'slider', 'quotes', 'height' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── MEDIA & HEADER ──
		$this->start_controls_section( 'section_header', array( 'label' => __( 'Header & Media', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'portrait_image', array(
			'label'   => __( 'Left Portrait Image', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => array( 'url' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=900&q=85' ),
			'dynamic' => array( 'active' => true ),
		) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Client Testimonials', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_main', array( 'label' => __( 'Heading Main', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Why people choose', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_brand', array( 'label' => __( 'Heading Brand', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Victoria Crestwood Group', 'dynamic' => array( 'active' => true ) ) );
		$this->end_controls_section();

		// ── TESTIMONIALS REPEATER ──
		$this->start_controls_section( 'section_testimonials', array( 'label' => __( 'Testimonials', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$repeater = new Repeater();
		$repeater->add_control( 'quote',         array( 'label' => __( 'Quote', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => '"They helped us get 8 offers on our home within 3 days and all of them were above the asking price. If you don\'t want any hassles, definitely choose Victoria Crestwood Group"', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'client_name',   array( 'label' => __( 'Client Name', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'The Blalock Family', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'client_result', array( 'label' => __( 'Result / Subtitle', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Sold in 7 days for 111.2% of their asking price', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'client_avatar', array( 'label' => __( 'Client Avatar', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&q=80' ) ) );

		$this->add_control( 'testimonials', array(
			'label'       => __( 'Testimonials', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array(
					'quote'         => '"They helped us get 8 offers on our home within 3 days and all of them were above the asking price. If you don\'t want any hassles, if you want to get top value for your money and if you just want a simple streamline process...definitely choose Victoria Crestwood Group"',
					'client_name'   => 'The Blalock Family',
					'client_result' => 'Sold in 7 days for 111.2% of their asking price',
					'client_avatar' => array( 'url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&q=80' ),
				),
				array(
					'quote'         => '"From our initial private consultation to closing on our Malibu oceanfront villa, Victoria and her team handled every detail flawlessly. We secured our dream residence $320,000 under original asking price in a multiple-offer scenario."',
					'client_name'   => 'Marcus & Elena Rivera',
					'client_result' => 'Purchased in Malibu — Closed in 14 days',
					'client_avatar' => array( 'url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&q=80' ),
				),
				array(
					'quote'         => '"An unprecedented standard of discretion and market intelligence. They identified an off-market Bel Air architectural estate before it ever hit public exchanges, saving our family months of searching."',
					'client_name'   => 'Dr. Aris Thorne & Family',
					'client_result' => 'Acquired off-market for 96.5% of appraisal value',
					'client_avatar' => array( 'url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=120&q=80' ),
				),
			),
			'title_field' => '{{{ client_name }}}',
		) );

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: Section Layout & Height ──
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section Layout & Height', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'section_min_height', array(
			'label'      => __( 'Section Min Height (px)', 'luxury-re-widgets' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => array( 'px', 'vh' ),
			'range'      => array(
				'px' => array( 'min' => 350, 'max' => 900, 'step' => 10 ),
				'vh' => array( 'min' => 30,  'max' => 100 ),
			),
			'default'    => array( 'unit' => 'px', 'size' => 540 ),
			'selectors'  => array(
				'{{WRAPPER}} .testimonial' => 'min-height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .testimonial__image-col' => 'min-height: {{SIZE}}{{UNIT}};',
			),
		) );
		$this->add_responsive_control( 'content_padding', array(
			'label'      => __( 'Content Column Padding', 'luxury-re-widgets' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', 'em', 'rem', '%' ),
			'default'    => array(
				'top'      => '4.5',
				'right'    => '4.5',
				'bottom'   => '4.5',
				'left'     => '4.5',
				'unit'     => 'rem',
				'isLinked' => true,
			),
			'selectors'  => array( '{{WRAPPER}} .testimonial__content-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
		) );
		$this->add_control( 'section_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial' => 'background-color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Typography ──
		$this->start_controls_section( 'style_typo', array( 'label' => __( 'Typography & Colors', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'quote_typography', 'label' => __( 'Quote Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .testimonial__quote' ) );
		$this->add_control( 'quote_color', array( 'label' => __( 'Quote Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__quote' => 'color: {{VALUE}};' ) ) );

		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'name_typography', 'label' => __( 'Client Name Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .testimonial__author-name' ) );
		$this->add_control( 'name_color', array( 'label' => __( 'Client Name Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__author-name' => 'color: {{VALUE}};' ) ) );

		$this->add_control( 'result_color', array( 'label' => __( 'Result Subtitle Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__author-result' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Navigation ──
		$this->start_controls_section( 'style_nav', array( 'label' => __( 'Slider Arrows & Dots', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_slider_nav' );
			$this->start_controls_tab( 'tab_nav_btn_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control( 'arrow_color', array( 'label' => __( 'Arrow Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__arrow' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'arrow_border', array( 'label' => __( 'Arrow Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__arrow' => 'border-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_nav_btn_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'arrow_color_hover', array( 'label' => __( 'Hover Arrow Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__arrow:hover' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'arrow_bg_hover', array( 'label' => __( 'Hover Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .testimonial__arrow:hover' => 'background-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$portrait_url = ! empty( $settings['portrait_image']['url'] ) ? $settings['portrait_image']['url'] : 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=900&q=85';
		?>
		<section class="testimonial" id="testimonial" aria-label="<?php esc_attr_e( 'Client testimonial', 'luxury-re-widgets' ); ?>">
			<div class="testimonial__image-col image-reveal">
				<?php if ( ! empty( $portrait_url ) ) : ?>
				<img src="<?php echo esc_url( $portrait_url ); ?>"
				     alt="<?php esc_attr_e( 'Luxury homeowners', 'luxury-re-widgets' ); ?>"
				     loading="lazy">
				<?php endif; ?>
				<div class="testimonial__image-overlay"></div>
			</div>

			<div class="testimonial__content-col">
				<div class="testimonial__inner reveal">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<span class="section-label section-label--light"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>

					<h2 class="testimonial__heading">
						<?php if ( ! empty( $settings['heading_main'] ) ) : ?>
						<span class="testimonial__heading-main"><span class="title-mask"><span><?php echo esc_html( $settings['heading_main'] ); ?></span></span></span>
						<?php endif; ?>
						<?php if ( ! empty( $settings['heading_brand'] ) ) : ?>
						<span class="testimonial__heading-brand"><span class="title-mask"><span><?php echo esc_html( $settings['heading_brand'] ); ?></span></span></span>
						<?php endif; ?>
					</h2>

					<div class="testimonial__card-frame">
						<div class="testimonial__slider" id="testimonial-slider">
							<div class="testimonial__track" id="testimonial-track">
								<?php if ( ! empty( $settings['testimonials'] ) ) :
									foreach ( $settings['testimonials'] as $index => $item ) :
										$avatar_url = ! empty( $item['client_avatar']['url'] ) ? $item['client_avatar']['url'] : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&q=80';
										$active     = 0 === $index ? ' active' : '';
								?>
								<div class="testimonial__slide<?php echo esc_attr( $active ); ?>" data-slide="<?php echo esc_attr( $index ); ?>">
									<blockquote class="testimonial__quote">
										<?php echo esc_html( $item['quote'] ); ?>
									</blockquote>

									<div class="testimonial__author">
										<div class="testimonial__author-avatar">
											<img src="<?php echo esc_url( $avatar_url ); ?>"
											     alt="<?php echo esc_attr( $item['client_name'] ); ?>"
											     loading="lazy" width="88" height="88">
										</div>
										<div class="testimonial__author-info">
											<span class="testimonial__author-name"><?php echo esc_html( $item['client_name'] ); ?></span>
											<?php if ( ! empty( $item['client_result'] ) ) : ?>
											<span class="testimonial__author-result"><?php echo esc_html( $item['client_result'] ); ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<?php endforeach; endif; ?>
							</div>
						</div>
					</div>

					<div class="testimonial__controls">
						<div class="testimonial__nav">
							<div class="testimonial__dots">
								<?php if ( ! empty( $settings['testimonials'] ) ) :
									foreach ( $settings['testimonials'] as $idx => $t ) :
										$dot_active = 0 === $idx ? ' active' : '';
								?>
								<button class="testimonial__nav-dot<?php echo esc_attr( $dot_active ); ?>" aria-label="<?php printf( esc_attr__( 'Story %d', 'luxury-re-widgets' ), $idx + 1 ); ?>" data-slide-index="<?php echo esc_attr( $idx ); ?>"></button>
								<?php endforeach; endif; ?>
							</div>
							<div class="testimonial__arrows">
								<button class="testimonial__arrow" id="testimonial-prev" aria-label="<?php esc_attr_e( 'Previous testimonial', 'luxury-re-widgets' ); ?>">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
								</button>
								<button class="testimonial__arrow" id="testimonial-next" aria-label="<?php esc_attr_e( 'Next testimonial', 'luxury-re-widgets' ); ?>">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18l6-6-6-6"/></svg>
								</button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>
		<?php
	}
}