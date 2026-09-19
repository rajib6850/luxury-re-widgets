<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Image_Widget
 *
 * Standalone Luxury Architectural Image Widget.
 * Engineered for Adolfo Aguirre (SERHANT.) with editorial aspect ratios,
 * museum-grade image scaling, quiet luxury frames, and smooth hover dynamics.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Image_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_image';
	}

	public function get_title() {
		return __( 'LRE — Luxury Architectural Image', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-image-bold';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'image', 'photo', 'picture', 'architectural', 'luxury', 'frame', 'estate' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		$this->start_controls_section(
			'section_image',
			array(
				'label' => __( 'Image & Presentation', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-3.jpg' ),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'aspect_ratio',
			array(
				'label'   => __( 'Aspect Ratio Preset', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'portrait_4_5',
				'options' => array(
					'portrait_4_5'   => __( 'Editorial Portrait (4:5)', 'luxury-re-widgets' ),
					'portrait_3_4'   => __( 'Classic Portrait (3:4)', 'luxury-re-widgets' ),
					'square_1_1'     => __( 'Square (1:1)', 'luxury-re-widgets' ),
					'landscape_16_9' => __( 'Cinematic Landscape (16:9)', 'luxury-re-widgets' ),
					'landscape_3_2'  => __( 'Fine-Art Landscape (3:2)', 'luxury-re-widgets' ),
					'natural'        => __( 'Natural / Unconstrained', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'hover_effect',
			array(
				'label'   => __( 'Hover Animation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'zoom',
				'options' => array(
					'zoom'       => __( 'Subtle Architectural Zoom (scale 1.04)', 'luxury-re-widgets' ),
					'brightness' => __( 'Gentle Brightness Shift', 'luxury-re-widgets' ),
					'both'       => __( 'Zoom + Brightness', 'luxury-re-widgets' ),
					'none'       => __( 'None (Static)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'frame_style',
			array(
				'label'   => __( 'Luxury Frame & Border', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'            => __( 'Clean (No Frame)', 'luxury-re-widgets' ),
					'hairline_gold'   => __( '1px Gold Hairline Border', 'luxury-re-widgets' ),
					'hairline_dark'   => __( '1px Subtle Dark Border', 'luxury-re-widgets' ),
					'floating_shadow' => __( 'Floating Estate Shadow', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'caption',
			array(
				'label'       => __( 'Monospaced Caption / Provenance', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'e.g. SOUTH GRAND ESTATE • PASADENA', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Dimensions & Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'      => __( 'Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'%'  => array( 'min' => 10,  'max' => 100 ),
					'px' => array( 'min' => 100, 'max' => 1400 ),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-atomic-img-box' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'      => __( 'Custom Height (overrides aspect ratio)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 150, 'max' => 1000 ),
					'vh' => array( 'min' => 20,  'max' => 100 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-atomic-img-media' => 'height: {{SIZE}}{{UNIT}} !important; aspect-ratio: unset !important;',
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
					'{{WRAPPER}} .lre-atomic-img-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .lre-atomic-img-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$img_url = ! empty( $settings['image']['url'] ) ? lre_resolve_image_url( $settings['image']['url'] ) : lre_asset_url( 'images/property-3.jpg' );
		if ( empty( $img_url ) ) {
			return;
		}

		$aspect_ratio = $settings['aspect_ratio'] ?? 'portrait_4_5';
		$hover_effect = $settings['hover_effect'] ?? 'zoom';
		$frame_style  = $settings['frame_style'] ?? 'none';

		$box_classes  = 'lre-atomic-img-box';
		$box_classes .= ' lre-ratio--' . sanitize_html_class( $aspect_ratio );
		$box_classes .= ' lre-hover--' . sanitize_html_class( $hover_effect );
		$box_classes .= ' lre-frame--' . sanitize_html_class( $frame_style );

		$link_data    = $settings['link'] ?? array();
		$has_link     = ! empty( $link_data['url'] );
		$url          = $has_link ? esc_url( $link_data['url'] ) : '';
		$target       = ! empty( $link_data['is_external'] ) ? ' target="_blank"' : '';
		$nofollow     = ! empty( $link_data['nofollow'] ) ? ' rel="nofollow"' : '';
		?>
		<div class="<?php echo esc_attr( $box_classes ); ?>">
			<?php if ( $has_link ) : ?>
				<a href="<?php echo $url; ?>" class="lre-atomic-img-link"<?php echo $target . $nofollow; ?>>
			<?php endif; ?>

				<div class="lre-atomic-img-media">
					<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( ! empty( $settings['caption'] ) ? $settings['caption'] : 'Architectural Property Photography' ); ?>" class="lre-atomic-img-tag" loading="lazy" />
				</div>

			<?php if ( $has_link ) : ?>
				</a>
			<?php endif; ?>

			<?php if ( ! empty( $settings['caption'] ) ) : ?>
				<div class="lre-atomic-img-caption">
					<span class="lre-atomic-img-dot"></span>
					<?php echo esc_html( $settings['caption'] ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}
