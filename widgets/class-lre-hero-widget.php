<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Hero_Widget
 * Ultra-Luxury Editorial Hero with Ken Burns, Background Video, Dynamic Gallery Slider, and Glassmorphic CTA.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Hero_Widget extends Widget_Base {

	public function get_name()       { return 'lre_hero'; }
	public function get_title()      { return __( 'LRE ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Â Luxury Hero Banner', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-banner'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'hero', 'banner', 'luxury', 'ken burns', 'video', 'slider', 'real estate' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ BACKGROUND MEDIA ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->start_controls_section( 'section_bg_media', array( 'label' => __( 'Background Media', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$this->add_control( 'bg_media_type', array(
			'label'   => __( 'Media Type', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'image',
			'options' => array(
				'image'  => __( 'Single Image', 'luxury-re-widgets' ),
				'slider' => __( 'Image Slider (Cross-fade)', 'luxury-re-widgets' ),
				'video'  => __( 'Background Video', 'luxury-re-widgets' ),
			),
		) );

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ Single Image ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->add_control( 'hero_bg_image', array(
			'label'     => __( 'Background Image', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=85' ),
			'dynamic'   => array( 'active' => true ),
			'condition' => array( 'bg_media_type' => 'image' ),
		) );

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ Image Slider ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->add_control( 'hero_bg_gallery', array(
			'label'     => __( 'Slider Images', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::GALLERY,
			'default'   => array(
				array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=85' ),
				array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1920&q=85' ),
				array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1920&q=85' ),
			),
			'condition' => array( 'bg_media_type' => 'slider' ),
		) );

		$this->add_control( 'slider_autoplay_interval', array(
			'label'     => __( 'Autoplay Interval (ms)', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 5000,
			'min'       => 1500,
			'max'       => 20000,
			'step'      => 500,
			'condition' => array( 'bg_media_type' => 'slider' ),
		) );

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ Ken Burns Settings ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->add_control( 'ken_burns', array(
			'label'        => __( 'Enable Ken Burns Effect', 'luxury-re-widgets' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
			'separator'    => 'before',
			'condition'    => array( 'bg_media_type' => array( 'image', 'slider' ) ),
		) );

		$this->add_control( 'ken_burns_duration', array(
			'label'      => __( 'Ken Burns Duration (Seconds)', 'luxury-re-widgets' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => array( 's' ),
			'range'      => array(
				's' => array( 'min' => 3, 'max' => 30, 'step' => 1 ),
			),
			'default'    => array( 'unit' => 's', 'size' => 8 ),
			'selectors'  => array(
				'{{WRAPPER}} .hero' => '--lre-ken-burns-duration: {{SIZE}}s;',
			),
			'condition'  => array(
				'bg_media_type' => array( 'image', 'slider' ),
				'ken_burns'     => 'yes',
			),
		) );

		$this->add_control( 'ken_burns_scale', array(
			'label'      => __( 'Ken Burns Zoom Scale', 'luxury-re-widgets' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => array( 'px' ),
			'range'      => array(
				'px' => array( 'min' => 1.05, 'max' => 1.40, 'step' => 0.01 ),
			),
			'default'    => array( 'unit' => 'px', 'size' => 1.15 ),
			'selectors'  => array(
				'{{WRAPPER}} .hero' => '--lre-ken-burns-scale: {{SIZE}};',
			),
			'condition'  => array(
				'bg_media_type' => array( 'image', 'slider' ),
				'ken_burns'     => 'yes',
			),
		) );

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ Video Background ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->add_control( 'video_source', array(
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
		) );

		$this->add_control( 'video_file', array(
			'label'     => __( 'Select / Upload MP4', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::MEDIA,
			'media_types' => array( 'video' ),
			'condition' => array( 'bg_media_type' => 'video', 'video_source' => 'self_hosted' ),
		) );

		$this->add_control( 'video_url', array(
			'label'       => __( 'Video URL or Embed ID', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => 'https://www.youtube.com/watch?v=... or MP4 URL',
			'condition'   => array( 'bg_media_type' => 'video', 'video_source!' => 'self_hosted' ),
			'dynamic'     => array( 'active' => true ),
		) );

		$this->add_control( 'video_fallback_image', array(
			'label'     => __( 'Video Fallback / Poster Image', 'luxury-re-widgets' ),
			'type'      => Controls_Manager::MEDIA,
			'condition' => array( 'bg_media_type' => 'video' ),
		) );

		$this->end_controls_section();

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ HEADLINES ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->start_controls_section( 'section_headlines', array( 'label' => __( 'Headlines & Typography', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'headline_tag', array(
			'label'   => __( 'HTML Heading Tag', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'h1',
			'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'div' => 'div' ),
		) );
		$this->add_control( 'headline_line1', array( 'label' => __( 'Headline Line 1', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Where Exceptional Living', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'headline_line2', array( 'label' => __( 'Headline Line 2', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Begins.', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'subtitle',       array( 'label' => __( 'Subtitle', 'luxury-re-widgets' ),        'type' => Controls_Manager::TEXT, 'default' => 'Southern California\'s Premier Luxury Real Estate', 'dynamic' => array( 'active' => true ) ) );
		$this->end_controls_section();

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ CALL TO ACTION BUTTONS ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->start_controls_section( 'section_cta', array( 'label' => __( 'Call To Action Buttons', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'btn_primary_text', array( 'label' => __( 'Button 1 Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Your Guide To Buying', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn_primary_url',  array( 'label' => __( 'Button 1 Link', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#listings' ) ) );
		$this->add_control( 'btn_secondary_text', array( 'label' => __( 'Button 2 Text', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Your Guide To Selling', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn_secondary_url',  array( 'label' => __( 'Button 2 Link', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#contact' ) ) );
		$this->add_control( 'show_scroll_cue',    array( 'label' => __( 'Show Scroll Indicator', 'luxury-re-widgets' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'separator' => 'before' ) );
		$this->add_control( 'scroll_cue_label',   array( 'label' => __( 'Scroll Cue Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'scroll down', 'condition' => array( 'show_scroll_cue' => 'yes' ) ) );
		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ STYLE: LAYOUT ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->start_controls_section( 'style_layout', array( 'label' => __( 'Hero Layout', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'section_min_height', array(
			'label'      => __( 'Min Height', 'luxury-re-widgets' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => array( 'px', 'vh', 'dvh' ),
			'range'      => array(
				'px'  => array( 'min' => 400, 'max' => 1200 ),
				'vh'  => array( 'min' => 50,  'max' => 100 ),
				'dvh' => array( 'min' => 50,  'max' => 100 ),
			),
			'default'    => array( 'unit' => 'vh', 'size' => 100 ),
			'selectors'  => array( '{{WRAPPER}} .hero' => 'min-height: {{SIZE}}{{UNIT}};' ),
		) );
		$this->end_controls_section();

		// ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ STYLE: OVERLAY ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
		$this->start_controls_section( 'style_overlay', array( 'label' => __( 'Background Overlay', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'show_overlay', array( 'label' => __( 'Show Overlay', 'luxury-re-widgets' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->add_control( 'overlay_bg', array( 'label' => __( 'Overlay Gradient / Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .hero__overlay' => 'background: {{VALUE}};' ), 'condition' => array( 'show_overlay' => 'yes' ) ) );
		$this->add_control( 'overlay_opacity', array(
			'label'      => __( 'Opacity', 'luxury-re-widgets' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => array( 'px' ),
			'range'      => array( 'px' => array( 'min' => 0, 'max' => 1, 'step' => 0.05 ) ),
			'default'    => array( 'unit' => 'px', 'size' => 1 ),
			'selectors'  => array( '{{WRAPPER}} .hero__overlay' => 'opacity: {{SIZE}};' ),
			'condition'  => array( 'show_overlay' => 'yes' ),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$media_type   = $settings['bg_media_type'] ?? 'image';
		$ken_burns    = ( 'yes' === ( $settings['ken_burns'] ?? 'yes' ) ) ? ' ken-burns' : '';
		$tag          = esc_attr( $settings['headline_tag'] );
		$line1        = esc_html( $settings['headline_line1'] );
		$line2        = esc_html( $settings['headline_line2'] );
		$subtitle     = esc_html( $settings['subtitle'] );
		$btn1_text    = esc_html( $settings['btn_primary_text'] );
		$btn1_url     = esc_url( $settings['btn_primary_url']['url'] ?? '#listings' );
		$btn1_target  = ! empty( $settings['btn_primary_url']['is_external'] ) ? '_blank' : '_self';
		$btn2_text    = esc_html( $settings['btn_secondary_text'] );
		$btn2_url     = esc_url( $settings['btn_secondary_url']['url'] ?? '#contact' );
		$btn2_target  = ! empty( $settings['btn_secondary_url']['is_external'] ) ? '_blank' : '_self';
		$show_cue     = 'yes' === $settings['show_scroll_cue'];
		$cue_label    = esc_html( $settings['scroll_cue_label'] );
		$show_overlay = 'yes' === ( $settings['show_overlay'] ?? 'yes' );
		?>
		<section class="hero" id="hero" aria-label="<?php esc_attr_e( 'Hero banner', 'luxury-re-widgets' ); ?>">

			<?php if ( 'slider' === $media_type ) :
				$gallery  = $settings['hero_bg_gallery'] ?? array();
				$interval = absint( $settings['slider_autoplay_interval'] ?? 5000 );
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
								$active = 0 === $slide_idx ? ' active' : '';
					?>
					<div class="hero__slide<?php echo esc_attr( $active . $ken_burns ); ?>" data-index="<?php echo esc_attr( $slide_idx ); ?>">
						<img src="<?php echo esc_url( $img_url ); ?>" alt="" aria-hidden="true" loading="<?php echo 0 === $slide_idx ? 'eager' : 'lazy'; ?>">
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
					<span class="hero-mask"><span><?php echo esc_html( $line1 ); ?></span></span>
					<span class="hero-mask"><span><?php echo esc_html( $line2 ); ?></span></span>
				</<?php echo $tag; ?>>

				<?php if ( $subtitle ) : ?>
				<p class="hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>

				<div class="hero__cta-group">
					<?php if ( $btn1_text ) : ?>
					<a href="<?php echo esc_url( $btn1_url ); ?>" target="<?php echo esc_attr( $btn1_target ); ?>" class="btn btn--outline-white">
						<span><?php echo esc_html( $btn1_text ); ?></span>
					</a>
					<?php endif; ?>

					<?php if ( $btn2_text ) : ?>
					<a href="<?php echo esc_url( $btn2_url ); ?>" target="<?php echo esc_attr( $btn2_target ); ?>" class="btn btn--outline-white">
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