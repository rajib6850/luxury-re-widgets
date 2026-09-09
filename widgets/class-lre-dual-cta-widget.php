<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * LRE_Dual_CTA_Widget
 *
 * Ultra-Luxury 50/50 Interactive Dual Split Canvas for "Acquisition & Disposition".
 * Features smooth expanding panels on hover, dual photographic backgrounds,
 * editorial typographic hierarchy, and floating gold ampersand monogram.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Dual_CTA_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_dual_cta';
	}

	public function get_title() {
		return __( 'LRE — Acquisition & Disposition (Dual Split)', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-columns';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'dual', 'split', 'acquisition', 'disposition', 'buyer', 'seller', 'cta', 'luxury', 'banner' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- 1. LEFT PANEL: ACQUISITION (BUYERS) ---
		$this->start_controls_section(
			'section_left_panel',
			array(
				'label' => __( 'Left Panel — Acquisition (Buyers)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'left_image',
			array(
				'label'   => __( 'Background Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-1.jpg' ),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'left_badge',
			array(
				'label'   => __( 'Editorial Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'LOOKING TO BUY?',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'left_title',
			array(
				'label'   => __( 'Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'BUY WITH ADOLFO',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'left_subtitle',
			array(
				'label'   => __( 'Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Curated Estates & Private Off-Market Access',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'left_desc',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Gain priority access to private architectural masterworks, historic estates, and off-market opportunities across Pasadena, San Marino, and Los Angeles.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'left_btn_text',
			array(
				'label'   => __( 'Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'WORK WITH ADOLFO',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'left_btn_url',
			array(
				'label'   => __( 'Button Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->end_controls_section();

		// --- 2. RIGHT PANEL: SELLERS (DISPOSITION) ---
		$this->start_controls_section(
			'section_right_panel',
			array(
				'label' => __( 'Right Panel — Sellers (Disposition)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'right_image',
			array(
				'label'   => __( 'Background Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-4.jpg' ),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'right_badge',
			array(
				'label'   => __( 'Editorial Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'THINKING OF SELLING?',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'right_title',
			array(
				'label'   => __( 'Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SELL WITH ADOLFO',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'right_subtitle',
			array(
				'label'   => __( 'Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Bespoke Marketing & Global Distribution',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'right_desc',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Command maximum value for your residence through cinematic architectural media, SERHANT\'s global reach, and bespoke private client representation.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'right_btn_text',
			array(
				'label'   => __( 'Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'REQUEST A VALUATION',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'right_btn_url',
			array(
				'label'   => __( 'Button Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->end_controls_section();

		// --- 3. SECTION SETTINGS ---
		$this->start_controls_section(
			'section_layout_settings',
			array(
				'label' => __( 'Interactive Settings', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'enable_hover_expand',
			array(
				'label'        => __( 'Expand on Hover (Desktop)', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_center_badge',
			array(
				'label'        => __( 'Show Center "&" Emblem', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_responsive_control(
			'section_min_height',
			array(
				'label'      => __( 'Minimum Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 450, 'max' => 900, 'step' => 10 ),
					'vh' => array( 'min' => 40,  'max' => 100, 'step' => 1 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 640 ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-dual-cta' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: Overlays & Backgrounds ---
		$this->start_controls_section(
			'style_overlays',
			array(
				'label' => __( 'Overlays & Atmosphere', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'left_overlay_color',
			array(
				'label'     => __( 'Left Panel Overlay', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(8, 8, 10, 0.68)',
				'selectors' => array(
					'{{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__overlay' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'right_overlay_color',
			array(
				'label'     => __( 'Right Panel Overlay', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(2, 41, 63, 0.68)',
				'selectors' => array(
					'{{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__overlay' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: Badges ---
		$this->start_controls_section(
			'style_badges',
			array(
				'label' => __( 'Editorial Badges', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_typography',
				'selector' => '{{WRAPPER}} .lre-dual-cta__badge',
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => __( 'Badge Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-dual-cta__badge' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: Titles ---
		$this->start_controls_section(
			'style_titles',
			array(
				'label' => __( 'Titles & Subtitles', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .lre-dual-cta__title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-dual-cta__title' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .lre-dual-cta__subtitle',
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#efebe2',
				'selectors' => array(
					'{{WRAPPER}} .lre-dual-cta__subtitle' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .lre-dual-cta__desc',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(239, 235, 226, 0.85)',
				'selectors' => array(
					'{{WRAPPER}} .lre-dual-cta__desc' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: Buttons ---
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
				'selector' => '{{WRAPPER}} .lre-dual-cta__btn',
			)
		);

		// Left Button Style
		$this->add_control(
			'heading_left_btn_style',
			array(
				'label'     => __( 'Left Button (Acquisition)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_left_btn' );
			$this->start_controls_tab( 'tab_left_btn_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'left_btn_text_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn, {{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'left_btn_bg_color',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#827a4a',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn' => 'background-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'left_btn_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#827a4a',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn' => 'border-color: {{VALUE}} !important;',
					),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_left_btn_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'left_btn_hover_text_color',
				array(
					'label'     => __( 'Hover Text', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn:hover, {{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn:hover span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'left_btn_hover_bg_color',
				array(
					'label'     => __( 'Hover Background', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#02293f',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn' => '--btn-hover-bg: {{VALUE}} !important;',
						'{{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
						'{{WRAPPER}} .lre-dual-cta__panel--left .lre-dual-cta__btn:hover' => 'border-color: {{VALUE}} !important;',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		// Right Button Style
		$this->add_control(
			'heading_right_btn_style',
			array(
				'label'     => __( 'Right Button (Disposition)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_right_btn' );
			$this->start_controls_tab( 'tab_right_btn_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'right_btn_text_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#efebe2',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn, {{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'right_btn_bg_color',
				array(
					'label'     => __( 'Background Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'transparent',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn' => 'background-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'right_btn_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#efebe2',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn' => 'border-color: {{VALUE}} !important;',
					),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_right_btn_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control(
				'right_btn_hover_text_color',
				array(
					'label'     => __( 'Hover Text', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn:hover, {{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn:hover span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					),
				)
			);
			$this->add_control(
				'right_btn_hover_bg_color',
				array(
					'label'     => __( 'Hover Background', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#02293f',
					'selectors' => array(
						'{{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn' => '--btn-hover-bg: {{VALUE}} !important;',
						'{{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
						'{{WRAPPER}} .lre-dual-cta__panel--right .lre-dual-cta__btn:hover' => 'border-color: {{VALUE}} !important;',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$left_img_url   = ! empty( $settings['left_image']['url'] ) ? $settings['left_image']['url'] : lre_asset_url( 'images/property-1.jpg' );
		$right_img_url  = ! empty( $settings['right_image']['url'] ) ? $settings['right_image']['url'] : lre_asset_url( 'images/property-4.jpg' );

		$left_btn_url   = ! empty( $settings['left_btn_url']['url'] ) ? $settings['left_btn_url']['url'] : '#contact';
		$left_target    = ! empty( $settings['left_btn_url']['is_external'] ) ? '_blank' : '_self';

		$right_btn_url  = ! empty( $settings['right_btn_url']['url'] ) ? $settings['right_btn_url']['url'] : '#contact';
		$right_target   = ! empty( $settings['right_btn_url']['is_external'] ) ? '_blank' : '_self';

		$expand_class   = ( ! isset( $settings['enable_hover_expand'] ) || 'yes' === $settings['enable_hover_expand'] ) ? ' lre-dual-cta--expandable' : '';
		$show_amp       = ( ! isset( $settings['show_center_badge'] ) || 'yes' === $settings['show_center_badge'] );
		?>
		<section class="lre-dual-cta<?php echo esc_attr( $expand_class ); ?>" id="acquisition-disposition" aria-label="<?php esc_attr_e( 'Acquisition and Disposition Dual Practice', 'luxury-re-widgets' ); ?>">
			
			<!-- Left Panel: Acquisition -->
			<div class="lre-dual-cta__panel lre-dual-cta__panel--left">
				<div class="lre-dual-cta__bg">
					<?php if ( ! empty( $left_img_url ) ) : ?>
					<img src="<?php echo esc_url( $left_img_url ); ?>" alt="<?php esc_attr_e( 'Luxury estate acquisition interior', 'luxury-re-widgets' ); ?>" loading="lazy">
					<?php endif; ?>
				</div>
				<div class="lre-dual-cta__overlay"></div>

				<div class="lre-dual-cta__content">
					<?php if ( ! empty( $settings['left_badge'] ) ) : ?>
					<span class="lre-dual-cta__badge"><?php echo esc_html( $settings['left_badge'] ); ?></span>
					<?php endif; ?>

					<?php if ( ! empty( $settings['left_title'] ) ) : ?>
					<h3 class="lre-dual-cta__title"><?php echo esc_html( $settings['left_title'] ); ?></h3>
					<?php endif; ?>

					<?php if ( ! empty( $settings['left_subtitle'] ) ) : ?>
					<h4 class="lre-dual-cta__subtitle"><?php echo esc_html( $settings['left_subtitle'] ); ?></h4>
					<?php endif; ?>

					<div class="lre-dual-cta__divider"></div>

					<?php if ( ! empty( $settings['left_desc'] ) ) : ?>
					<p class="lre-dual-cta__desc"><?php echo esc_html( $settings['left_desc'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $settings['left_btn_text'] ) ) : ?>
					<div class="lre-dual-cta__action">
						<a href="<?php echo esc_url( $left_btn_url ); ?>" target="<?php echo esc_attr( $left_target ); ?>" class="btn lre-dual-cta__btn">
							<span><?php echo esc_html( $settings['left_btn_text'] ); ?></span>
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Center Floating Ampersand Emblem -->
			<?php if ( $show_amp ) : ?>
			<div class="lre-dual-cta__center-badge" aria-hidden="true">
				<span class="lre-dual-cta__center-amp">&amp;</span>
			</div>
			<?php endif; ?>

			<!-- Right Panel: Disposition -->
			<div class="lre-dual-cta__panel lre-dual-cta__panel--right">
				<div class="lre-dual-cta__bg">
					<?php if ( ! empty( $right_img_url ) ) : ?>
					<img src="<?php echo esc_url( $right_img_url ); ?>" alt="<?php esc_attr_e( 'Luxury estate disposition exterior', 'luxury-re-widgets' ); ?>" loading="lazy">
					<?php endif; ?>
				</div>
				<div class="lre-dual-cta__overlay"></div>

				<div class="lre-dual-cta__content">
					<?php if ( ! empty( $settings['right_badge'] ) ) : ?>
					<span class="lre-dual-cta__badge"><?php echo esc_html( $settings['right_badge'] ); ?></span>
					<?php endif; ?>

					<?php if ( ! empty( $settings['right_title'] ) ) : ?>
					<h3 class="lre-dual-cta__title"><?php echo esc_html( $settings['right_title'] ); ?></h3>
					<?php endif; ?>

					<?php if ( ! empty( $settings['right_subtitle'] ) ) : ?>
					<h4 class="lre-dual-cta__subtitle"><?php echo esc_html( $settings['right_subtitle'] ); ?></h4>
					<?php endif; ?>

					<div class="lre-dual-cta__divider"></div>

					<?php if ( ! empty( $settings['right_desc'] ) ) : ?>
					<p class="lre-dual-cta__desc"><?php echo esc_html( $settings['right_desc'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $settings['right_btn_text'] ) ) : ?>
					<div class="lre-dual-cta__action">
						<a href="<?php echo esc_url( $right_btn_url ); ?>" target="<?php echo esc_attr( $right_target ); ?>" class="btn lre-dual-cta__btn">
							<span><?php echo esc_html( $settings['right_btn_text'] ); ?></span>
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>

		</section>
		<?php
	}
}
