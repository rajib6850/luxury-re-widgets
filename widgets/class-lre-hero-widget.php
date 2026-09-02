<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;

class LRE_Hero_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_hero';
	}

	public function get_title() {
		return __( 'LRE - Luxury Hero Banner', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'hero', 'banner', 'slider', 'video', 'luxury', 'real estate', 'heading' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- Background Settings ---
		$this->start_controls_section(
			'section_background',
			array(
				'label' => __( 'Hero Background & Media', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'bg_media_type',
			array(
				'label'   => __( 'Media Type', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => array(
					'image'  => __( 'Single Background Image', 'luxury-re-widgets' ),
					'slider' => __( 'Ken Burns Slideshow / Carousel', 'luxury-re-widgets' ),
					'video'  => __( 'Background Video (Self-hosted / YouTube / Vimeo)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'hero_bg_image',
			array(
				'label'     => __( 'Background Image', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=85',
				),
				'condition' => array( 'bg_media_type' => 'image' ),
			)
		);

		$this->add_control(
			'slider_images',
			array(
				'label'     => __( 'Slideshow Gallery Images', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::GALLERY,
				'default'   => array(
					array( 'id' => 0, 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=85' ),
					array( 'id' => 0, 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1920&q=85' ),
					array( 'id' => 0, 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1920&q=85' ),
				),
				'condition' => array( 'bg_media_type' => 'slider' ),
			)
		);

		$this->add_control(
			'slider_autoplay_interval',
			array(
				'label'     => __( 'Slide Interval (ms)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'min'       => 2000,
				'max'       => 20000,
				'step'      => 500,
				'condition' => array( 'bg_media_type' => 'slider' ),
			)
		);

		// --- Ken Burns Settings ---
		$this->add_control(
			'ken_burns',
			array(
				'label'        => __( 'Enable Ken Burns Motion Effect', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'separator'    => 'before',
				'condition'    => array( 'bg_media_type' => array( 'image', 'slider' ) ),
			)
		);

		$this->add_control(
			'ken_burns_duration',
			array(
				'label'      => __( 'Ken Burns Duration (Seconds)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 's' ),
				'range'      => array(
					's' => array( 'min' => 3, 'max' => 35, 'step' => 1 ),
				),
				'default'    => array( 'unit' => 's', 'size' => 25 ),
				'selectors'  => array(
					'{{WRAPPER}} .hero' => '--lre-ken-burns-duration: {{SIZE}}s;',
				),
				'condition'  => array(
					'bg_media_type' => array( 'image', 'slider' ),
					'ken_burns'     => 'yes',
				),
			)
		);

		// --- Video Background Settings ---
		$this->add_control(
			'video_source',
			array(
				'label'     => __( 'Video Source', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'self_hosted',
				'options'   => array(
					'self_hosted' => __( 'Self Hosted (MP4 Media Upload)', 'luxury-re-widgets' ),
					'youtube'     => __( 'YouTube URL or ID', 'luxury-re-widgets' ),
					'vimeo'       => __( 'Vimeo URL or ID', 'luxury-re-widgets' ),
					'external'    => __( 'Direct MP4 File URL', 'luxury-re-widgets' ),
				),
				'condition' => array( 'bg_media_type' => 'video' ),
			)
		);

		$this->add_control(
			'video_file',
			array(
				'label'       => __( 'Select / Upload MP4', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::MEDIA,
				'media_types' => array( 'video' ),
				'condition'   => array( 'bg_media_type' => 'video', 'video_source' => 'self_hosted' ),
			)
		);

		$this->add_control(
			'video_url',
			array(
				'label'       => __( 'Video URL or Embed ID', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'https://www.youtube.com/watch?v=... or MP4 URL',
				'condition'   => array( 'bg_media_type' => 'video', 'video_source!' => 'self_hosted' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'video_fallback_image',
			array(
				'label'     => __( 'Video Fallback / Poster Image', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array( 'bg_media_type' => 'video' ),
			)
		);

		$this->end_controls_section();

		// --- Headlines & Content ---
		$this->start_controls_section(
			'section_headlines',
			array(
				'label' => __( 'Headlines & Typography', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'headline_tag',
			array(
				'label'   => __( 'HTML Heading Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'div' => 'div' ),
			)
		);

		$this->add_control(
			'headline_line1',
			array(
				'label'       => __( 'Headline Line 1', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Where Exceptional Living', 'luxury-re-widgets' ),
				'placeholder' => __( 'Where Exceptional Living', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'headline_line2',
			array(
				'label'       => __( 'Headline Line 2', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Begins.', 'luxury-re-widgets' ),
				'placeholder' => __( 'Begins.', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => __( 'Subtitle', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( "Southern California's Premier Luxury Real Estate", 'luxury-re-widgets' ),
				'placeholder' => __( "Southern California's Premier Luxury Real Estate", 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// --- Call To Action Buttons ---
		$this->start_controls_section(
			'section_cta',
			array(
				'label' => __( 'Call To Action Buttons', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'btn_primary_text',
			array(
				'label'       => __( 'Button 1 Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Your Guide To Buying', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn_primary_url',
			array(
				'label'   => __( 'Button 1 Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#listings' ),
			)
		);

		$this->add_control(
			'btn_secondary_text',
			array(
				'label'       => __( 'Button 2 Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Your Guide To Selling', 'luxury-re-widgets' ),
				'separator'   => 'before',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn_secondary_url',
			array(
				'label'   => __( 'Button 2 Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->add_control(
			'show_scroll_cue',
			array(
				'label'     => __( 'Show Scroll Down Indicator', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'scroll_cue_label',
			array(
				'label'     => __( 'Scroll Indicator Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'scroll down', 'luxury-re-widgets' ),
				'condition' => array( 'show_scroll_cue' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- Layout Style ---
		$this->start_controls_section(
			'style_layout',
			array(
				'label' => __( 'Hero Layout & Dimensions', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'section_min_height',
			array(
				'label'      => __( 'Min Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh', 'dvh' ),
				'range'      => array(
					'px'  => array( 'min' => 400, 'max' => 1400 ),
					'vh'  => array( 'min' => 50,  'max' => 100 ),
					'dvh' => array( 'min' => 50,  'max' => 100 ),
				),
				'default'    => array( 'unit' => 'vh', 'size' => 100 ),
				'selectors'  => array(
					'{{WRAPPER}} .hero' => 'min-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- Overlay Style ---
		$this->start_controls_section(
			'style_overlay',
			array(
				'label' => __( 'Cinematic Gradient Overlay', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'show_overlay',
			array(
				'label'   => __( 'Enable Overlay Gradient', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Custom Overlay Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hero__overlay' => 'background: {{VALUE}} !important;',
				),
				'condition' => array( 'show_overlay' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- Title Style ---
		$this->start_controls_section(
			'style_title',
			array(
				'label' => __( 'Hero Title Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .hero__title' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .hero__title, {{WRAPPER}} .hero__title .hero-mask, {{WRAPPER}} .hero__title .hero-mask > span',
			)
		);

		$this->add_responsive_control(
			'title_max_width',
			array(
				'label'      => __( 'Max Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array( 'min' => 400, 'max' => 1400 ),
					'%'  => array( 'min' => 50,  'max' => 100 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 920 ),
				'selectors'  => array(
					'{{WRAPPER}} .hero__title' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);



		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .hero__title',
			)
		);

		$this->end_controls_section();

		// --- Subtitle Style ---
		$this->start_controls_section(
			'style_subtitle',
			array(
				'label' => __( 'Subtitle Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .hero__subtitle' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .hero__subtitle',
			)
		);

		$this->end_controls_section();

		// --- Buttons Style ---
		$this->start_controls_section(
			'style_buttons',
			array(
				'label' => __( 'Action Buttons', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .hero__cta-group .btn',
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
					'{{WRAPPER}} .hero__cta-group .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					'rem' => array( 'min' => 0, 'max' => 4 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 1.2 ),
				'selectors'  => array(
					'{{WRAPPER}} .hero__cta-group' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'btn_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hero__cta-group .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		// Button 1 (Primary / Buying)
		$this->add_control(
			'heading_hero_btn1',
			array(
				'label'     => __( 'Button 1 (Guide To Buying)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_hero_btn1_style' );
			$this->start_controls_tab( 'tab_hero_btn1_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn1_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-1' => 'color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn1_bg',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-1' => 'background-color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn1_border',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-1' => 'border-color: {{VALUE}} !important;' ),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_hero_btn1_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn1_hover_color',
				array(
					'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-1:hover' => 'color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn1_hover_bg',
				array(
					'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-1:hover, {{WRAPPER}} .hero__cta-group .hero__btn-1:hover::before' => 'background-color: {{VALUE}} !important; background: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn1_hover_border',
				array(
					'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-1:hover' => 'border-color: {{VALUE}} !important;' ),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		// Button 2 (Secondary / Selling)
		$this->add_control(
			'heading_hero_btn2',
			array(
				'label'     => __( 'Button 2 (Guide To Selling)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_hero_btn2_style' );
			$this->start_controls_tab( 'tab_hero_btn2_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn2_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-2' => 'color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn2_bg',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-2' => 'background-color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn2_border',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-2' => 'border-color: {{VALUE}} !important;' ),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_hero_btn2_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'btn2_hover_color',
				array(
					'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-2:hover' => 'color: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn2_hover_bg',
				array(
					'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-2:hover, {{WRAPPER}} .hero__cta-group .hero__btn-2:hover::before' => 'background-color: {{VALUE}} !important; background: {{VALUE}} !important;' ),
				)
			);
			$this->add_control(
				'btn2_hover_border',
				array(
					'label'     => __( 'Hover Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array( '{{WRAPPER}} .hero__cta-group .hero__btn-2:hover' => 'border-color: {{VALUE}} !important;' ),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$media_type   = ! empty( $settings['bg_media_type'] ) ? $settings['bg_media_type'] : 'image';
		$ken_burns    = ( 'yes' === ( $settings['ken_burns'] ?? 'yes' ) ) ? ' ken-burns' : '';
		$show_overlay = ( 'yes' === ( $settings['show_overlay'] ?? 'yes' ) );
		$tag          = ! empty( $settings['headline_tag'] ) ? $settings['headline_tag'] : 'h1';
		$tag          = in_array( $tag, array( 'h1', 'h2', 'div' ), true ) ? $tag : 'h1';

		$line1        = $settings['headline_line1'] ?? 'Where Exceptional Living';
		$line2        = $settings['headline_line2'] ?? 'Begins.';
		$subtitle     = $settings['subtitle'] ?? "Southern California's Premier Luxury Real Estate";

		$btn1_text    = $settings['btn_primary_text'] ?? 'Your Guide To Buying';
		$btn1_url     = ! empty( $settings['btn_primary_url']['url'] ) ? $settings['btn_primary_url']['url'] : '#listings';
		$btn1_target  = ! empty( $settings['btn_primary_url']['is_external'] ) ? '_blank' : '_self';

		$btn2_text    = $settings['btn_secondary_text'] ?? 'Your Guide To Selling';
		$btn2_url     = ! empty( $settings['btn_secondary_url']['url'] ) ? $settings['btn_secondary_url']['url'] : '#contact';
		$btn2_target  = ! empty( $settings['btn_secondary_url']['is_external'] ) ? '_blank' : '_self';

		$show_cue     = ( 'yes' === ( $settings['show_scroll_cue'] ?? 'yes' ) );
		$cue_label    = $settings['scroll_cue_label'] ?? 'scroll down';
		?>
		<section class="hero" id="hero" aria-label="<?php esc_attr_e( 'Hero banner', 'luxury-re-widgets' ); ?>">

			<?php if ( 'slider' === $media_type ) :
				$gallery  = ! empty( $settings['slider_images'] ) ? $settings['slider_images'] : array();
				$interval = ! empty( $settings['slider_autoplay_interval'] ) ? intval( $settings['slider_autoplay_interval'] ) : 5000;
			?>
				<!-- Background Slider -->
				<div class="hero__slider" data-autoplay-interval="<?php echo esc_attr( $interval ); ?>">
					<?php if ( ! empty( $gallery ) ) :
						$slide_idx = 0;
						foreach ( $gallery as $img ) :
							$img_url = '';
							if ( ! empty( $img['url'] ) ) {
								$img_url = $img['url'];
							} elseif ( ! empty( $img['id'] ) ) {
								$img_url = wp_get_attachment_image_url( $img['id'], 'full' );
							}
							if ( ! empty( $img_url ) ) :
								$active = ( 0 === $slide_idx ) ? ' active' : '';
					?>
					<div class="hero__slide<?php echo esc_attr( $active . $ken_burns ); ?>" data-index="<?php echo esc_attr( $slide_idx ); ?>">
						<img src="<?php echo esc_url( $img_url ); ?>" alt="" aria-hidden="true" loading="<?php echo ( 0 === $slide_idx ) ? 'eager' : 'lazy'; ?>">
					</div>
					<?php $slide_idx++; endif; endforeach; endif; ?>
				</div>

			<?php elseif ( 'video' === $media_type ) :
				$video_source = $settings['video_source'] ?? 'self_hosted';
				$poster_url   = ! empty( $settings['video_fallback_image']['url'] ) ? $settings['video_fallback_image']['url'] : '';
			?>
				<!-- Background Video -->
				<div class="hero__video-wrap">
					<?php if ( 'self_hosted' === $video_source && ! empty( $settings['video_file']['url'] ) ) : ?>
						<video class="hero__video" autoplay muted loop playsinline poster="<?php echo esc_url( $poster_url ); ?>">
							<source src="<?php echo esc_url( $settings['video_file']['url'] ); ?>" type="video/mp4">
						</video>
					<?php elseif ( 'external' === $video_source && ! empty( $settings['video_url'] ) ) : ?>
						<video class="hero__video" autoplay muted loop playsinline poster="<?php echo esc_url( $poster_url ); ?>">
							<source src="<?php echo esc_url( $settings['video_url'] ); ?>" type="video/mp4">
						</video>
					<?php elseif ( 'youtube' === $video_source && ! empty( $settings['video_url'] ) ) :
						$yt_id = $this->get_youtube_id( $settings['video_url'] );
					?>
						<iframe class="hero__video-iframe"
						        src="https://www.youtube.com/embed/<?php echo esc_attr( $yt_id ); ?>?autoplay=1&mute=1&controls=0&loop=1&playlist=<?php echo esc_attr( $yt_id ); ?>&showinfo=0&rel=0&enablejsapi=1&iv_load_policy=3"
						        allow="autoplay; encrypted-media" frameborder="0" aria-hidden="true"></iframe>
					<?php elseif ( 'vimeo' === $video_source && ! empty( $settings['video_url'] ) ) :
						$vimeo_id = $this->get_vimeo_id( $settings['video_url'] );
					?>
						<iframe class="hero__video-iframe"
						        src="https://player.vimeo.com/video/<?php echo esc_attr( $vimeo_id ); ?>?autoplay=1&muted=1&loop=1&autopause=0&background=1"
						        allow="autoplay; fullscreen" frameborder="0" aria-hidden="true"></iframe>
					<?php elseif ( $poster_url ) : ?>
						<div class="hero__background<?php echo esc_attr( $ken_burns ); ?>">
							<img src="<?php echo esc_url( $poster_url ); ?>" alt="" fetchpriority="high">
						</div>
					<?php endif; ?>
				</div>

			<?php else :
				$bg_url = ! empty( $settings['hero_bg_image']['url'] ) ? $settings['hero_bg_image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=85';
			?>
				<!-- Single Background Image -->
				<div class="hero__background<?php echo esc_attr( $ken_burns ); ?>">
					<?php if ( ! empty( $bg_url ) ) : ?>
					<img src="<?php echo esc_url( $bg_url ); ?>"
					     alt="<?php esc_attr_e( 'Grand luxury stone manor estate illuminated at twilight', 'luxury-re-widgets' ); ?>"
					     fetchpriority="high">
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $show_overlay ) : ?>
			<div class="hero__overlay"></div>
			<?php endif; ?>

			<!-- Content -->
			<div class="hero__content">
				<<?php echo $tag; ?> class="hero__title">
					<?php if ( ! empty( $line1 ) ) : ?>
					<span class="hero-mask"><span><?php echo esc_html( $line1 ); ?></span></span>
					<?php endif; ?>
					<?php if ( ! empty( $line2 ) ) : ?>
					<span class="hero-mask"><span><?php echo esc_html( $line2 ); ?></span></span>
					<?php endif; ?>
				</<?php echo $tag; ?>>

				<?php if ( ! empty( $subtitle ) ) : ?>
				<p class="hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>

				<div class="hero__cta-group">
					<?php if ( ! empty( $btn1_text ) ) : ?>
					<a href="<?php echo esc_url( $btn1_url ); ?>" target="<?php echo esc_attr( $btn1_target ); ?>" class="btn btn--outline-white hero__btn-1">
						<span><?php echo esc_html( $btn1_text ); ?></span>
					</a>
					<?php endif; ?>

					<?php if ( ! empty( $btn2_text ) ) : ?>
					<a href="<?php echo esc_url( $btn2_url ); ?>" target="<?php echo esc_attr( $btn2_target ); ?>" class="btn btn--outline-white hero__btn-2">
						<span><?php echo esc_html( $btn2_text ); ?></span>
					</a>
					<?php endif; ?>
				</div>
			</div>

			<!-- Scroll Indicator -->
			<?php if ( $show_cue ) : ?>
			<div class="hero__scroll-indicator" aria-hidden="true">
				<div class="hero__scroll-line"></div>
				<span><?php echo esc_html( $cue_label ?: 'scroll down' ); ?></span>
			</div>
			<?php endif; ?>
		</section>
		<?php
	}

	private function get_youtube_id( $url ) {
		if ( preg_match( '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $url, $match ) ) {
			return $match[1];
		}
		return trim( $url );
	}

	private function get_vimeo_id( $url ) {
		if ( preg_match( '/(?:vimeo\.com\/)(\d+)/i', $url, $match ) ) {
			return $match[1];
		}
		return trim( $url );
	}
}