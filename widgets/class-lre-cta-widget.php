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

		// --- MEDIA ---
		$this->start_controls_section( 'section_media', array( 'label' => __( 'Background Image', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'bg_image', array(
			'label'   => __( 'Image', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => array( 'url' => lre_asset_url( 'images/property-4.jpg' ) ),
			'dynamic' => array( 'active' => true ),
		) );
		$this->end_controls_section();

		// --- CONTENT ---
		$this->start_controls_section( 'section_content', array( 'label' => __( 'Text Content', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'eyebrow',     array( 'label' => __( 'Eyebrow',     'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,     'default' => 'Let\'s Connect', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_1',   array( 'label' => __( 'Title Line 1', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,     'default' => 'Your Next Chapter', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_2',   array( 'label' => __( 'Title Line 2', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,     'default' => 'Starts Here', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_tag', array( 'label' => __( 'Heading Tag',  'luxury-re-widgets' ), 'type' => Controls_Manager::SELECT,   'default' => 'h2', 'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'div' => 'div' ) ) );
		$this->add_control( 'description', array( 'label' => __( 'Description',  'luxury-re-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Whether you\'re envisioning a new beginning, planning a strategic sale, or simply curious about what your home is worth—our team is ready to deliver answers and results with the discretion you expect.', 'dynamic' => array( 'active' => true ) ) );
		$this->end_controls_section();

		// --- BUTTONS ---
		$this->start_controls_section( 'section_buttons', array( 'label' => __( 'Action Buttons', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'btn1_text', array( 'label' => __( 'Button 1 Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Get A Private Valuation', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn1_url',  array( 'label' => __( 'Button 1 URL',  'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#contact' ) ) );
		$this->add_control( 'btn2_text', array( 'label' => __( 'Button 2 Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Book A Consultation', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn2_url',  array( 'label' => __( 'Button 2 URL',  'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#contact' ) ) );
		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: Section & Overlay ---
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section & Overlay', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cta__overlay' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		// --- STYLE: Eyebrow ---
		$this->start_controls_section( 'style_eyebrow', array( 'label' => __( 'Eyebrow', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .cta__eyebrow, {{WRAPPER}} .cta__eyebrow-wrap .section-label, {{WRAPPER}} .cta .cta__eyebrow',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cta__eyebrow, {{WRAPPER}} .cta__eyebrow-wrap .section-label, {{WRAPPER}} .cta .cta__eyebrow, {{WRAPPER}} .section-label' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important; --cta-eyebrow-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 60, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 5, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cta__eyebrow-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: Typography ---
		$this->start_controls_section( 'style_typo', array( 'label' => __( 'Typography & Colors', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .cta__title, {{WRAPPER}} .cta__title span, {{WRAPPER}} .cta__title .title-mask span',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cta__title, {{WRAPPER}} .cta__title span, {{WRAPPER}} .cta__title .title-mask span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'title_spacing',
			array(
				'label'      => __( 'Title Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 60, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 4, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cta__title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => __( 'Description Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .cta__description',
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cta__description' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'desc_spacing',
			array(
				'label'      => __( 'Description Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 80, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 5, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cta__description' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->end_controls_section();

		// --- STYLE: Buttons ---
		$this->start_controls_section( 'style_buttons', array( 'label' => __( 'Action Buttons', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .cta__buttons .btn, {{WRAPPER}} .cta__buttons a.btn',
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '1.3',
					'right'    => '2.2',
					'bottom'   => '1.3',
					'left'     => '2.2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cta__buttons .btn, {{WRAPPER}} .cta__buttons a.btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'btn_gap',
			array(
				'label'      => __( 'Buttons Gap', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 50 ),
					'rem' => array( 'min' => 0, 'max' => 3 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 1.25 ),
				'selectors'  => array(
					'{{WRAPPER}} .cta__buttons' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'heading_cta_btn1',
			array(
				'label'     => __( 'Button 1 (Private Valuation)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_cta_btn1' );
			$this->start_controls_tab( 'tab_cta_btn1_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn1_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-1, {{WRAPPER}} .cta__buttons a.cta__btn-1, {{WRAPPER}} .cta__buttons .cta__btn-1 span, {{WRAPPER}} .cta__buttons a.cta__btn-1 span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'btn1_bg',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-1, {{WRAPPER}} .cta__buttons a.cta__btn-1' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'btn1_border',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-1, {{WRAPPER}} .cta__buttons a.cta__btn-1' => 'border-color: {{VALUE}} !important;',
					),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_cta_btn1_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn1_hover_color',
				array(
					'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-1:hover, {{WRAPPER}} .cta__buttons a.cta__btn-1:hover, {{WRAPPER}} .cta__buttons .cta__btn-1:hover span, {{WRAPPER}} .cta__buttons a.cta__btn-1:hover span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'btn1_hover_bg',
				array(
					'label'     => __( 'Hover Background', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-1, {{WRAPPER}} .cta__buttons a.cta__btn-1' => '--btn-hover-bg: {{VALUE}} !important;',
						'{{WRAPPER}} .cta__buttons .cta__btn-1::before, {{WRAPPER}} .cta__buttons a.cta__btn-1::before, {{WRAPPER}} .cta__buttons .cta__btn-1:hover::before, {{WRAPPER}} .cta__buttons a.cta__btn-1:hover::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'btn1_hover_border',
				array(
					'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-1:hover, {{WRAPPER}} .cta__buttons a.cta__btn-1:hover' => 'border-color: {{VALUE}} !important;',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'heading_cta_btn2',
			array(
				'label'     => __( 'Button 2 (Book Consultation)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_cta_btn2' );
			$this->start_controls_tab( 'tab_cta_btn2_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn2_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-2, {{WRAPPER}} .cta__buttons a.cta__btn-2, {{WRAPPER}} .cta__buttons .cta__btn-2 span, {{WRAPPER}} .cta__buttons a.cta__btn-2 span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'btn2_bg',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-2, {{WRAPPER}} .cta__buttons a.cta__btn-2' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'btn2_border',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-2, {{WRAPPER}} .cta__buttons a.cta__btn-2' => 'border-color: {{VALUE}} !important;',
					),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_cta_btn2_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn2_hover_color',
				array(
					'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-2:hover, {{WRAPPER}} .cta__buttons a.cta__btn-2:hover, {{WRAPPER}} .cta__buttons .cta__btn-2:hover span, {{WRAPPER}} .cta__buttons a.cta__btn-2:hover span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'btn2_hover_bg',
				array(
					'label'     => __( 'Hover Background', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-2, {{WRAPPER}} .cta__buttons a.cta__btn-2' => '--btn-hover-bg: {{VALUE}} !important;',
						'{{WRAPPER}} .cta__buttons .cta__btn-2::before, {{WRAPPER}} .cta__buttons a.cta__btn-2::before, {{WRAPPER}} .cta__buttons .cta__btn-2:hover::before, {{WRAPPER}} .cta__buttons a.cta__btn-2:hover::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'btn2_hover_border',
				array(
					'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cta__buttons .cta__btn-2:hover, {{WRAPPER}} .cta__buttons a.cta__btn-2:hover' => 'border-color: {{VALUE}} !important;',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$tag           = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag           = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $tag : 'h2';
		$img_url       = ! empty( $settings['bg_image']['url'] ) ? $settings['bg_image']['url'] : lre_asset_url( 'images/property-4.jpg' );
		$btn1_url      = ! empty( $settings['btn1_url']['url'] ) ? $settings['btn1_url']['url'] : '#contact';
		$btn1_target   = ! empty( $settings['btn1_url']['is_external'] ) ? '_blank' : '_self';
		$btn2_url      = ! empty( $settings['btn2_url']['url'] ) ? $settings['btn2_url']['url'] : '#contact';
		$btn2_target   = ! empty( $settings['btn2_url']['is_external'] ) ? '_blank' : '_self';

		$eyebrow       = $settings['eyebrow'] ?? "Let's Connect";
		$heading_1     = $settings['heading_1'] ?? 'Your Next Chapter';
		$heading_2     = $settings['heading_2'] ?? 'Starts Here';
		$description   = $settings['description'] ?? "Whether you're envisioning a new beginning, planning a strategic sale, or simply curious about what your home is worth—our team is ready to deliver answers and results with the discretion you expect.";
		?>
		<section class="cta" id="contact" aria-label="<?php esc_attr_e( 'Call to action', 'luxury-re-widgets' ); ?>">
			<div class="cta__background">
				<?php if ( ! empty( $img_url ) ) : ?>
				<img src="<?php echo esc_url( $img_url ); ?>"
				     alt="<?php esc_attr_e( 'Modern estate at golden hour with infinity pool', 'luxury-re-widgets' ); ?>"
				     loading="lazy" width="1920" height="1080">
				<?php endif; ?>
			</div>
			<div class="cta__overlay"></div>

			<div class="cta__content reveal">
				<?php if ( ! empty( $eyebrow ) ) : ?>
				<div class="cta__eyebrow-wrap">
					<span class="section-label section-label--gold cta__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				</div>
				<?php endif; ?>

				<<?php echo $tag; ?> class="cta__title">
					<?php if ( ! empty( $heading_1 ) ) : ?>
					<span class="title-mask"><span><?php echo esc_html( $heading_1 ); ?></span></span><br>
					<?php endif; ?>
					<?php if ( ! empty( $heading_2 ) ) : ?>
					<span class="title-mask"><span><?php echo esc_html( $heading_2 ); ?></span></span>
					<?php endif; ?>
				</<?php echo $tag; ?>>

				<?php if ( ! empty( $description ) ) : ?>
				<p class="cta__description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>

				<div class="cta__buttons">
					<?php if ( ! empty( $settings['btn1_text'] ) ) : ?>
					<a href="<?php echo esc_url( $btn1_url ); ?>" target="<?php echo esc_attr( $btn1_target ); ?>" class="btn btn--outline-white cta__btn-1">
						<span><?php echo esc_html( $settings['btn1_text'] ); ?></span>
					</a>
					<?php endif; ?>
					<?php if ( ! empty( $settings['btn2_text'] ) ) : ?>
					<a href="<?php echo esc_url( $btn2_url ); ?>" target="<?php echo esc_attr( $btn2_target ); ?>" class="btn btn--outline-white cta__btn-2">
						<span><?php echo esc_html( $settings['btn2_text'] ); ?></span>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}