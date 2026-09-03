<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Story_Widget
 * Minimal Luxury Editorial Story & About Details Section.
 * Features a switchable vertical image (Left/Right) and refined narrative content with title.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Story_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_story';
	}

	public function get_title() {
		return __( 'LRE — About Story & Details', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'about', 'story', 'details', 'minimal', 'luxury', 'vertical image', 'heritage' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION 1: LAYOUT SETTINGS ──
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => __( 'Section Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'image_position',
			array(
				'label'       => __( 'Image Position', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left'  => array(
						'title' => __( 'Left (Image Left / Content Right)', 'luxury-re-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right (Content Left / Image Right)', 'luxury-re-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'     => 'left',
				'toggle'      => false,
			)
		);

		$this->add_control(
			'vertical_alignment',
			array(
				'label'     => __( 'Vertical Alignment', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'center'     => __( 'Center Aligned', 'luxury-re-widgets' ),
					'flex-start' => __( 'Top Aligned', 'luxury-re-widgets' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-story__wrapper' => 'align-items: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: EDITORIAL CONTENT ──
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Editorial Content', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'watermark',
			array(
				'label'   => __( 'Watermark Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ABOUT',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Our Story & Philosophy',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Main Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => "Two Decades of Defining\nExceptional Living.",
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'span' => 'span',
					'div'  => 'div',
				),
			)
		);

		$this->add_control(
			'show_divider',
			array(
				'label'     => __( 'Show Accent Line', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'luxury-re-widgets' ),
				'label_off' => __( 'Hide', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'lead_text',
			array(
				'label'   => __( 'Lead / Subtitle Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Founded on the belief that finding the right home is deeply personal, Crestwood & Associates combines two decades of market expertise with a concierge-level approach.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'story_text',
			array(
				'label'   => __( 'Story Details (Multi-paragraph)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => "<p>We don't just open doors—we open possibilities. Over the past two decades, our advisory has curated an uncompromising portfolio of historic estates, architectural masterworks, and discreet waterfront sanctums across Southern California.</p><p>We operate with the rigorous confidentiality of a private family office and the strategic acuity of an investment advisory. To us, every property possesses an architectural soul, and every acquisition marks the opening of a profound life chapter.</p>",
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: VERTICAL IMAGE ──
		$this->start_controls_section(
			'section_media',
			array(
				'label' => __( 'Vertical Image', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Portrait / Vertical Photo', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000&q=85',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'image_aspect_ratio',
			array(
				'label'   => __( 'Image Aspect Ratio', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3/4',
				'options' => array(
					'3/4'  => __( 'Portrait (3:4) — Recommended', 'luxury-re-widgets' ),
					'4/5'  => __( 'Editorial (4:5)', 'luxury-re-widgets' ),
					'2/3'  => __( 'Tall Portrait (2:3)', 'luxury-re-widgets' ),
					'auto' => __( 'Natural Image Proportions', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'image_tagline',
			array(
				'label'   => __( 'Floating Tagline / Caption (Optional)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Architectural Provenance • Est. 2004',
			)
		);

		$this->end_controls_section();

		// ── SECTION 4: CALL TO ACTION (OPTIONAL) ──
		$this->start_controls_section(
			'section_cta',
			array(
				'label' => __( 'Button / Link (Optional)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_button',
			array(
				'label'     => __( 'Show Button', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'luxury-re-widgets' ),
				'label_off' => __( 'Hide', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Button Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Connect With Us',
				'condition' => array( 'show_button' => 'yes' ),
			)
		);

		$this->add_control(
			'button_url',
			array(
				'label'       => __( 'Button Link', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'default'     => array( 'url' => '#contact' ),
				'placeholder' => __( 'https://your-link.com or #contact', 'luxury-re-widgets' ),
				'condition'   => array( 'show_button' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: SECTION ──
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#faf7f2',
				'selectors' => array(
					'{{WRAPPER}} .lre-story' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '7.5',
					'right'    => '2',
					'bottom'   => '7.5',
					'left'     => '2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-story' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: TYPOGRAPHY ──
		$this->start_controls_section(
			'style_typography',
			array(
				'label' => __( 'Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__eyebrow'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .lre-story__gold-bar' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .lre-story__title',
			)
		);

		$this->add_control(
			'lead_color',
			array(
				'label'     => __( 'Lead / Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#141418',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__lead' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'story_color',
			array(
				'label'     => __( 'Story Body Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4a4a52',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__text, {{WRAPPER}} .lre-story__text p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: VERTICAL IMAGE ──
		$this->start_controls_section(
			'style_image',
			array(
				'label' => __( 'Vertical Image Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .lre-story__image-frame',
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-story__image-frame' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── STYLE: BUTTON ──
		$this->start_controls_section(
			'style_button',
			array(
				'label'     => __( 'Button Style', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_button' => 'yes' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__btn' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .lre-story__btn svg' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_bg',
			array(
				'label'     => __( 'Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__btn:hover' => 'background-color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'button_hover_text_color',
			array(
				'label'     => __( 'Hover Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-story__btn:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-story__btn:hover svg' => 'stroke: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$image_pos    = $settings['image_position'] ?? 'left';
		$layout_class = 'right' === $image_pos ? 'lre-story--image-right' : 'lre-story--image-left';

		$watermark    = esc_html( $settings['watermark'] ?? '' );
		$eyebrow      = esc_html( $settings['eyebrow'] ?? '' );
		$title        = esc_html( $settings['title'] ?? '' );
		$title_tag    = esc_attr( $settings['title_tag'] ?? 'h2' );
		$title_tag    = in_array( $title_tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $title_tag : 'h2';

		$show_divider = 'yes' === ( $settings['show_divider'] ?? 'yes' );
		$lead         = esc_html( $settings['lead_text'] ?? '' );
		$story_text   = wp_kses_post( $settings['story_text'] ?? '' );

		$img_url      = ! empty( $settings['image']['url'] ) ? esc_url( $settings['image']['url'] ) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1000&q=85';
		$aspect_ratio = esc_attr( $settings['image_aspect_ratio'] ?? '3/4' );
		$aspect_style = ( 'auto' !== $aspect_ratio ) ? 'aspect-ratio: ' . $aspect_ratio . ';' : '';
		$tagline      = esc_html( $settings['image_tagline'] ?? '' );

		$show_btn     = 'yes' === ( $settings['show_button'] ?? 'yes' );
		$btn_text     = esc_html( $settings['button_text'] ?? 'Connect With Us' );
		$btn_url      = ! empty( $settings['button_url']['url'] ) ? esc_url( $settings['button_url']['url'] ) : '#contact';
		$btn_target   = ! empty( $settings['button_url']['is_external'] ) ? ' target="_blank"' : '';
		$btn_nofollow = ! empty( $settings['button_url']['nofollow'] ) ? ' rel="nofollow"' : '';
		?>

		<section class="lre-story <?php echo esc_attr( $layout_class ); ?>" id="about-story" aria-label="<?php esc_attr_e( 'About Our Story & Details', 'luxury-re-widgets' ); ?>">
			<?php if ( ! empty( $watermark ) ) : ?>
				<div class="lre-story__watermark" aria-hidden="true"><?php echo $watermark; ?></div>
			<?php endif; ?>

			<div class="lre-story__container">
				<div class="lre-story__wrapper">

					<!-- Vertical Image Column -->
					<div class="lre-story__media-col">
						<div class="lre-story__image-frame image-reveal" style="<?php echo esc_attr( $aspect_style ); ?>">
							<img src="<?php echo $img_url; ?>" alt="<?php echo esc_attr( strip_tags( $title ) ); ?>" loading="lazy">
							<?php if ( ! empty( $tagline ) ) : ?>
								<div class="lre-story__image-tagline">
									<span><?php echo $tagline; ?></span>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<!-- Content Column with Title -->
					<div class="lre-story__content-col reveal">
						<?php if ( ! empty( $eyebrow ) ) : ?>
							<div class="lre-story__eyebrow-wrap">
								<span class="lre-story__gold-bar" aria-hidden="true"></span>
								<span class="lre-story__eyebrow"><?php echo $eyebrow; ?></span>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $title ) ) :
							$clean_title = html_entity_decode( $title, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
							$clean_title = str_replace( array( "\r\n", "\r" ), "\n", $clean_title );
							$raw_lines   = preg_split( '/<br\s*\/?>|\n/i', $clean_title );
							$title_lines = array_filter( array_map( 'trim', $raw_lines ) );
							if ( empty( $title_lines ) ) {
								$title_lines = array( $title );
							}
						?>
							<<?php echo $title_tag; ?> class="lre-story__title">
								<?php foreach ( $title_lines as $t_idx => $t_line ) : ?>
									<span class="title-mask"><span><?php echo esc_html( $t_line ); ?></span></span><?php if ( $t_idx < count( $title_lines ) - 1 ) : ?><br><?php endif; ?>
								<?php endforeach; ?>
							</<?php echo $title_tag; ?>>
						<?php endif; ?>

						<?php if ( $show_divider ) : ?>
							<div class="lre-story__divider" aria-hidden="true"></div>
						<?php endif; ?>

						<?php if ( ! empty( $lead ) ) : ?>
							<p class="lre-story__lead"><?php echo $lead; ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $story_text ) ) : ?>
							<div class="lre-story__text">
								<?php echo $story_text; ?>
							</div>
						<?php endif; ?>

						<?php if ( $show_btn && ! empty( $btn_text ) ) : ?>
							<div class="lre-story__action">
								<a href="<?php echo $btn_url; ?>" class="btn btn--outline lre-story__btn"<?php echo $btn_target . $btn_nofollow; ?>>
									<span><?php echo $btn_text; ?></span>
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
								</a>
							</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</section>
		<?php
	}
}
