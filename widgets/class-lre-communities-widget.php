<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Communities_Widget
 * Featured Communities infinite horizontal sliding reel with luxury cards.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Communities_Widget extends Widget_Base {

	public function get_name()       { return 'lre_communities'; }
	public function get_title()      { return __( 'LRE — Featured Communities', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-image-box'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'communities', 'neighborhoods', 'cities', 'slider', 'reel' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── HEADER ──
		$this->start_controls_section( 'section_header', array( 'label' => __( 'Header', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'eyebrow',     array( 'label' => __( 'Eyebrow',     'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,   'default' => 'Discover Local', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading',     array( 'label' => __( 'Heading',     'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,   'default' => 'Featured Communities',   'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'heading_tag', array( 'label' => __( 'Heading Tag', 'luxury-re-widgets' ), 'type' => Controls_Manager::SELECT, 'default' => 'h2', 'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'div' => 'div' ) ) );
		$this->end_controls_section();

		// ── COMMUNITIES REPEATER ──
		$this->start_controls_section( 'section_communities', array( 'label' => __( 'Communities', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );

		$repeater = new Repeater();
		$repeater->add_control( 'comm_image', array( 'label' => __( 'Community Image', 'luxury-re-widgets' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=700&q=85' ), 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'comm_name',  array( 'label' => __( 'Community Name',  'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT,  'default' => 'Pacific Palisades', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'comm_link',  array( 'label' => __( 'Community URL',   'luxury-re-widgets' ), 'type' => Controls_Manager::URL,   'default' => array( 'url' => '#' ) ) );

		$this->add_control( 'communities', array(
			'label'       => __( 'Communities List', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array( 'comm_name' => 'Pacific Palisades', 'comm_image' => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=700&q=85' ) ),
				array( 'comm_name' => 'Bel Air',           'comm_image' => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=700&q=85' ) ),
				array( 'comm_name' => 'Brentwood',         'comm_image' => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=700&q=85' ) ),
				array( 'comm_name' => 'Malibu',            'comm_image' => array( 'url' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=700&q=85' ) ),
				array( 'comm_name' => 'Holmby Hills',      'comm_image' => array( 'url' => 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=700&q=85' ) ),
				array( 'comm_name' => 'Beverly Hills',     'comm_image' => array( 'url' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=700&q=85' ) ),
			),
			'title_field' => '{{{ comm_name }}}',
		) );

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: Section ──
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'section_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .communities' => 'background-color: {{VALUE}};' ) ) );
		$this->add_responsive_control( 'section_padding', array( 'label' => __( 'Padding', 'luxury-re-widgets' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em', 'rem' ), 'selectors' => array( '{{WRAPPER}} .communities' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Card Typography & Colors ──
		$this->start_controls_section( 'style_cards', array( 'label' => __( 'Community Cards', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'card_typography', 'selector' => '{{WRAPPER}} .community-card__name' ) );
		$this->add_control( 'card_title_color', array( 'label' => __( 'Title Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .community-card__name' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Navigation Arrows ──
		$this->start_controls_section( 'style_nav_arrows', array( 'label' => __( 'Navigation Arrows', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_arrows' );
			$this->start_controls_tab( 'tab_arrows_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control( 'arrow_color', array( 'label' => __( 'Arrow Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .communities__arrow' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'arrow_border', array( 'label' => __( 'Arrow Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .communities__arrow' => 'border-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_arrows_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'arrow_color_hover', array( 'label' => __( 'Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .communities__arrow:hover' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'arrow_bg_hover', array( 'label' => __( 'Hover Background', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .communities__arrow:hover' => 'background-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag      = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ), true ) ? $tag : 'h2';
		?>
		<section class="communities" id="communities" aria-label="<?php esc_attr_e( 'Featured communities', 'luxury-re-widgets' ); ?>">
			<div class="communities__header">
				<div class="communities__header-text reveal">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
					<span class="section-label"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>

					<<?php echo $tag; ?> class="communities__title">
						<span class="title-mask"><span><?php echo esc_html( $settings['heading'] ); ?></span></span>
					</<?php echo $tag; ?>>
				</div>

				<div class="communities__arrows">
					<button class="communities__arrow" id="communities-prev" aria-label="<?php esc_attr_e( 'Previous communities', 'luxury-re-widgets' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
					</button>
					<button class="communities__arrow" id="communities-next" aria-label="<?php esc_attr_e( 'Next communities', 'luxury-re-widgets' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
					</button>
				</div>
			</div>

			<div class="communities__slider" id="communities-slider">
				<div class="communities__track" id="communities-track">
					<?php if ( ! empty( $settings['communities'] ) ) :
						foreach ( $settings['communities'] as $c ) :
							$img_url     = ! empty( $c['comm_image']['url'] ) ? $c['comm_image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=700&q=85';
							$link_url    = ! empty( $c['comm_link']['url'] ) ? esc_url( $c['comm_link']['url'] ) : '#';
							$link_target = ! empty( $c['comm_link']['is_external'] ) ? '_blank' : '_self';
					?>
					<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="community-card image-reveal">
						<img src="<?php echo esc_url( $img_url ); ?>"
						     alt="<?php echo esc_attr( $c['comm_name'] ); ?>"
						     class="community-card__image"
						     loading="lazy" width="600" height="900">
						<div class="community-card__overlay"></div>
						<h3 class="community-card__name"><?php echo esc_html( $c['comm_name'] ); ?></h3>
					</a>
					<?php endforeach; endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}