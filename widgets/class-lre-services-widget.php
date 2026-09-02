<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Services_Widget
 * Our Services section — left image with overlay + repeater-driven service list.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Services_Widget extends Widget_Base {

	public function get_name()       { return 'lre_services'; }
	public function get_title()      { return __( 'LRE — Our Services', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-apps'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'services', 'features', 'list', 'luxury', 'real estate' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── MEDIA ──
		$this->start_controls_section( 'section_media', array( 'label' => __( 'Left Image', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'section_image', array(
			'label'   => __( 'Image', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => array( 'url' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=900&q=85' ),
			'dynamic' => array( 'active' => true ),
		) );
		$this->end_controls_section();

		// ── HEADER ──
		$this->start_controls_section( 'section_header', array( 'label' => __( 'Header', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'our services', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_line1', array( 'label' => __( 'Heading Line 1', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Real Estate Services', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_line2', array( 'label' => __( 'Heading Line 2', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Designed Around You', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_tag', array( 'label' => __( 'Heading Tag', 'luxury-re-widgets' ), 'type' => Controls_Manager::SELECT, 'default' => 'h2', 'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'div' => 'div' ) ) );
		$this->end_controls_section();

		// ── SERVICE ITEMS ──
		$this->start_controls_section( 'section_items', array( 'label' => __( 'Service Items', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$repeater = new Repeater();
		$repeater->add_control( 'item_title', array( 'label' => __( 'Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Buy With Confidence', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'item_description', array( 'label' => __( 'Description', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'From first-timers to seasoned investors, we guide you every step of the way with data-backed market insight.', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'item_link', array( 'label' => __( 'Link URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#contact' ) ) );

		$this->add_control( 'service_items', array(
			'label'       => __( 'Services', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array( 'item_title' => 'Buy With Confidence',        'item_description' => 'From first-timers to seasoned investors, we guide you every step of the way with data-backed market insight.' ),
				array( 'item_title' => 'Sell Smart. Move Forward.', 'item_description' => 'Maximize your return with strategic pricing, powerful marketing, and bespoke global presentation.' ),
				array( 'item_title' => "Relocating? We've Got You.", 'item_description' => 'We make moving seamless with white-glove relocation support, virtual previews, and neighborhood advisory.' ),
			),
			'title_field' => '{{{ item_title }}}',
		) );

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: Section ──
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'section_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .services' => 'background-color: {{VALUE}};' ) ) );
		$this->add_responsive_control( 'section_padding', array( 'label' => __( 'Padding', 'luxury-re-widgets' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em', 'rem' ), 'selectors' => array( '{{WRAPPER}} .services' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Eyebrow ──
		$this->start_controls_section( 'style_eyebrow', array( 'label' => __( 'Eyebrow', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .services__eyebrow-text' ) );
		$this->add_control( 'eyebrow_color', array( 'label' => __( 'Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .services__eyebrow-text' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'eyebrow_line_color', array( 'label' => __( 'Line Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .services__eyebrow-line' => 'background: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Heading ──
		$this->start_controls_section( 'style_heading', array( 'label' => __( 'Heading', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .services__title' ) );
		$this->add_control( 'heading_color', array( 'label' => __( 'Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .services__title' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Service Items ──
		$this->start_controls_section( 'style_item', array( 'label' => __( 'Service Items', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_service_items' );

			$this->start_controls_tab( 'tab_item_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'item_title_typography', 'label' => __( 'Title Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .service-item__name' ) );
			$this->add_control( 'item_title_color', array( 'label' => __( 'Title Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .service-item__name' => 'color: {{VALUE}};' ) ) );
			$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'item_desc_typography', 'label' => __( 'Desc Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .service-item__desc' ) );
			$this->add_control( 'item_desc_color', array( 'label' => __( 'Desc Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .service-item__desc' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'item_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .service-item' => 'background-color: {{VALUE}} !important;' ) ) );
			$this->add_control( 'item_border_color', array( 'label' => __( 'Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .service-item' => 'border-color: {{VALUE}} !important;' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_item_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'item_title_color_hover', array( 'label' => __( 'Hover Title Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .service-item:hover .service-item__name' => 'color: {{VALUE}} !important;' ) ) );
			$this->add_control( 'item_bg_hover', array( 'label' => __( 'Hover Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .service-item:hover' => 'background-color: {{VALUE}} !important;' ) ) );
			$this->add_control( 'item_border_color_hover', array( 'label' => __( 'Hover Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .service-item:hover' => 'border-color: {{VALUE}} !important;' ) ) );
			$this->add_control( 'icon_color_hover', array( 'label' => __( 'Hover Icon Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .service-item:hover .service-item__icon' => 'color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = esc_attr( $settings['heading_tag'] );
		$img_url  = ! empty( $settings['section_image']['url'] ) ? $settings['section_image']['url'] : 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=900&q=85';
		?>
		<section class="services" id="services" aria-label="<?php esc_attr_e( 'Our services', 'luxury-re-widgets' ); ?>">
			<div class="container services__container">
				
				<div class="services__layout">
					<!-- Left Framed Image -->
					<div class="services__image-wrapper">
						<div class="services__image-card image-reveal">
							<?php if ( ! empty( $img_url ) ) : ?>
							<img src="<?php echo esc_url( $img_url ); ?>"
							     alt="<?php esc_attr_e( 'Luxury interior finishes', 'luxury-re-widgets' ); ?>"
							     loading="lazy" width="600" height="900">
							<?php endif; ?>
							<div class="services__image-overlay"></div>
						</div>
					</div>

					<!-- Overlapping Header -->
					<div class="services__header reveal">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<div class="services__eyebrow">
							<span class="services__eyebrow-line"></span>
							<span class="services__eyebrow-text"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						</div>
						<?php endif; ?>

						<<?php echo $tag; ?> class="services__title">
							<?php if ( ! empty( $settings['heading_line1'] ) ) : ?>
							<span class="title-mask"><span><?php echo esc_html( $settings['heading_line1'] ); ?></span></span><br>
							<?php endif; ?>
							<?php if ( ! empty( $settings['heading_line2'] ) ) : ?>
							<span class="title-mask"><span><?php echo esc_html( $settings['heading_line2'] ); ?></span></span>
							<?php endif; ?>
						</<?php echo $tag; ?>>
					</div>

					<!-- Service Items -->
					<div class="services__list reveal">
						<?php
						$delay = 1;
						if ( ! empty( $settings['service_items'] ) ) :
							foreach ( $settings['service_items'] as $item ) :
								$link_url    = esc_url( $item['item_link']['url'] ?? '#contact' );
								$link_target = ! empty( $item['item_link']['is_external'] ) ? '_blank' : '_self';
						?>
						<a href="<?php echo $link_url; ?>" target="<?php echo esc_attr( $link_target ); ?>" class="service-item delay-<?php echo esc_attr( $delay++ ); ?>">
							<div class="service-item__text">
								<h3 class="service-item__name"><?php echo esc_html( $item['item_title'] ); ?></h3>
								<p class="service-item__desc"><?php echo esc_html( $item['item_description'] ); ?></p>
							</div>
							<div class="service-item__icon-wrap">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="service-item__icon">
									<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
									<polyline points="15 3 21 3 21 9"/>
									<line x1="10" y1="14" x2="21" y2="3"/>
								</svg>
							</div>
						</a>
						<?php endforeach; endif; ?>
					</div>
				</div>

			</div>
		</section>
		<?php
	}
}