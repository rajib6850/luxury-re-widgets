<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

/**
 * LRE_Page_Hero_Widget
 * Universal interior page hero banner (About, Contact, Services, etc.).
 * Features Group_Control_Background for image/gradient support, Group_Control_Background
 * overlay, semantic H1 with full typography hierarchy, and btn class buttons
 * that match the site-wide `.btn .btn--outline-white` animation system.
 *
 * Typography Priority (Elementor standard):
 *   1. Widget-level typography set in this widget's Style tab
 *   2. Elementor Global/Site Typography (H1 global token)
 *   3. CSS hard-coded fallback (Libre Baskerville, clamp sizes)
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Page_Hero_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_page_hero';
	}

	public function get_title() {
		return __( 'LRE — Page Hero Banner', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'hero', 'page', 'banner', 'header', 'interior', 'about', 'contact', 'luxury' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── BACKGROUND ──
		$this->start_controls_section(
			'section_background',
			array(
				'label' => __( 'Background', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'hero_bg',
				'label'    => __( 'Background', 'luxury-re-widgets' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .lre-phero',
				'fields_options' => array(
					'background' => array(
						'default' => 'classic',
					),
					'color' => array(
						'default' => '#0a0a0a',
					),
					'position' => array(
						'default' => 'center center',
					),
					'size' => array(
						'default' => 'cover',
					),
					'repeat' => array(
						'default' => 'no-repeat',
					),
					'attachment' => array(
						'default' => 'fixed',
					),
				),
			)
		);

		$this->add_responsive_control(
			'hero_min_height',
			array(
				'label'      => __( 'Minimum Height', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'vh', 'px', 'dvh' ),
				'range'      => array(
					'vh'  => array( 'min' => 20, 'max' => 100, 'step' => 1 ),
					'px'  => array( 'min' => 200, 'max' => 1200, 'step' => 10 ),
					'dvh' => array( 'min' => 20, 'max' => 100, 'step' => 1 ),
				),
				'default'    => array( 'size' => 52, 'unit' => 'vh' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-phero' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── OVERLAY ──
		$this->start_controls_section(
			'section_overlay',
			array(
				'label' => __( 'Overlay', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_overlay',
			array(
				'label'        => __( 'Enable Overlay', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'           => 'hero_overlay',
				'label'          => __( 'Overlay Background', 'luxury-re-widgets' ),
				'types'          => array( 'classic', 'gradient' ),
				'selector'       => '{{WRAPPER}} .lre-phero__overlay',
				'condition'      => array( 'show_overlay' => 'yes' ),
				'fields_options' => array(
					'background' => array(
						'default' => 'gradient',
					),
					'gradient_type' => array(
						'default' => 'linear',
					),
					'gradient_angle' => array(
						'default' => array( 'unit' => 'deg', 'size' => 180 ),
					),
					'color' => array(
						'default' => 'rgba(0,0,0,0.55)',
					),
					'color_b' => array(
						'default' => 'rgba(0,0,0,0.70)',
					),
				),
			)
		);

		$this->add_control(
			'overlay_opacity',
			array(
				'label'          => __( 'Overlay Opacity', 'luxury-re-widgets' ),
				'type'           => Controls_Manager::SLIDER,
				'range'          => array(
					'px' => array( 'min' => 0, 'max' => 1, 'step' => 0.05 ),
				),
				'default'        => array( 'size' => 1 ),
				'selectors'      => array(
					'{{WRAPPER}} .lre-phero__overlay' => 'opacity: {{SIZE}};',
				),
				'condition'      => array( 'show_overlay' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// ── TEXT CONTENT ──
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Text Content', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Label', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'e.g. About Us', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Page Title (H1)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'About Us',
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'   => __( 'Subtitle / Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => 'We understand that buying or selling a home is more than just a transaction; it\'s a life-changing experience. That\'s why our team of highly-seasoned real estate professionals is dedicated to providing exceptional, personalized service.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'text_align',
			array(
				'label'   => __( 'Text Alignment', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'   => array( 'title' => __( 'Left', 'luxury-re-widgets' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'luxury-re-widgets' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'luxury-re-widgets' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__content'      => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .lre-phero__eyebrow-wrap' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .lre-phero__actions'      => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── CTA BUTTON ──
		$this->start_controls_section(
			'section_cta',
			array(
				'label' => __( 'CTA Button', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_cta',
			array(
				'label'        => __( 'Show Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'cta_text',
			array(
				'label'     => __( 'Button Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Meet the Team',
				'dynamic'   => array( 'active' => true ),
				'condition' => array( 'show_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'cta_url',
			array(
				'label'       => __( 'Button URL', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://...',
				'default'     => array( 'url' => '#' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'cta_variant',
			array(
				'label'     => __( 'Button Style', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'btn--outline-white',
				'options'   => array(
					'btn--outline-white' => __( 'Outline White (recommended on dark images)', 'luxury-re-widgets' ),
					'btn--gold'          => __( 'Gold Filled', 'luxury-re-widgets' ),
					'btn--primary'       => __( 'Dark Filled', 'luxury-re-widgets' ),
					'btn--outline'       => __( 'Outline Dark', 'luxury-re-widgets' ),
				),
				'condition' => array( 'show_cta' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// ── BREADCRUMB ──
		$this->start_controls_section(
			'section_breadcrumb',
			array(
				'label' => __( 'Breadcrumb', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_breadcrumb',
			array(
				'label'        => __( 'Show Breadcrumb', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'breadcrumb_home_label',
			array(
				'label'     => __( 'Home Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Home',
				'condition' => array( 'show_breadcrumb' => 'yes' ),
			)
		);

		$this->add_control(
			'breadcrumb_home_url',
			array(
				'label'     => __( 'Home URL', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::URL,
				'default'   => array( 'url' => '/' ),
				'condition' => array( 'show_breadcrumb' => 'yes' ),
			)
		);

		$this->add_control(
			'breadcrumb_current',
			array(
				'label'     => __( 'Current Page Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'About Us',
				'dynamic'   => array( 'active' => true ),
				'condition' => array( 'show_breadcrumb' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── TITLE STYLE ──
		// Priority: 1) Widget-level Group_Control_Typography (editor directly changes here)
		//           2) Elementor Global/Site Typography h1 token (via `global` key)
		//           3) Hard-coded CSS fallback below
		$this->start_controls_section(
			'style_title',
			array(
				'label' => __( 'Title (H1)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__title' => 'color: {{VALUE}} !important;',
				),
			)
		);

		// Group_Control_Typography is the FIRST priority for Elementor typography.
		// Setting 'global' => ['default' => 'globals/typography?id=primary'] will allow
		// it to inherit the site's H1 global token when the user has not overridden it here.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-phero__title, {{WRAPPER}} .lre-phero__title .phero-mask > span',
				// 'global' allows falling back to Elementor's site-level H1 typography token
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .lre-phero__title',
			)
		);

		$this->add_responsive_control(
			'content_max_width',
			array(
				'label'      => __( 'Content Max-Width', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array( 'min' => 400, 'max' => 1400, 'step' => 10 ),
					'%'  => array( 'min' => 30, 'max' => 100, 'step' => 1 ),
				),
				'default'    => array( 'size' => 760, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-phero__content' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── SUBTITLE STYLE ──
		$this->start_controls_section(
			'style_subtitle',
			array(
				'label' => __( 'Subtitle', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.78)',
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__subtitle' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => __( 'Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-phero__subtitle',
			)
		);

		$this->end_controls_section();

		// ── BUTTON STYLE ──
		$this->start_controls_section(
			'style_button',
			array(
				'label'     => __( 'CTA Button', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_cta' => 'yes' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .lre-phero__actions .btn, {{WRAPPER}} .lre-phero__actions .btn span',
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'rem', 'em' ),
				'default'    => array(
					'top'      => '0.95',
					'right'    => '2.2',
					'bottom'   => '0.95',
					'left'     => '2.2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-phero__actions .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		// Normal / Hover tabs — matching exact hero widget pattern
		$this->start_controls_tabs( 'tabs_btn_style' );

			$this->start_controls_tab( 'tab_btn_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );

			$this->add_control(
				'btn_text_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .lre-phero__actions .btn,
						 {{WRAPPER}} .lre-phero__actions .btn span' => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'btn_bg_color',
				array(
					'label'     => __( 'Background', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'transparent',
					'selectors' => array(
						'{{WRAPPER}} .lre-phero__actions .btn' => 'background: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'btn_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'rgba(255,255,255,0.5)',
					'selectors' => array(
						'{{WRAPPER}} .lre-phero__actions .btn' => 'border-color: {{VALUE}} !important;',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_btn_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );

			$this->add_control(
				'btn_hover_text_color',
				array(
					'label'     => __( 'Text Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#0c0c10',
					'selectors' => array(
						'{{WRAPPER}} .lre-phero__actions .btn:hover,
						 {{WRAPPER}} .lre-phero__actions .btn:hover span' => 'color: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'btn_hover_bg_color',
				array(
					'label'     => __( 'Fill Color (slide-up fill)', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .lre-phero__actions .btn'           => '--btn-hover-bg: {{VALUE}} !important;',
						'{{WRAPPER}} .lre-phero__actions .btn::before'   => 'background: {{VALUE}} !important;',
						'{{WRAPPER}} .lre-phero__actions .btn:hover'     => 'background: {{VALUE}} !important;',
					),
				)
			);

			$this->add_control(
				'btn_hover_border_color',
				array(
					'label'     => __( 'Border Color', 'luxury-re-widgets' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .lre-phero__actions .btn:hover' => 'border-color: {{VALUE}} !important;',
					),
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// ── LAYOUT ──
		$this->start_controls_section(
			'style_layout',
			array(
				'label' => __( 'Layout', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'content_v_position',
			array(
				'label'   => __( 'Vertical Position', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => array(
					'flex-start' => 'Top',
					'center'     => 'Middle',
					'flex-end'   => 'Bottom',
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__inner' => 'align-items: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'inner_padding',
			array(
				'label'      => __( 'Inner Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'rem', '%' ),
				'default'    => array(
					'top'      => '6',
					'right'    => '2',
					'bottom'   => '5',
					'left'     => '2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-phero__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$eyebrow     = esc_html( $settings['eyebrow'] ?? '' );
		$title       = esc_html( $settings['title'] ?? 'About Us' );
		$subtitle    = esc_html( $settings['subtitle'] ?? '' );
		$show_cta    = $settings['show_cta'] ?? 'yes';
		$cta_text    = esc_html( $settings['cta_text'] ?? 'Meet the Team' );
		$cta_url     = ! empty( $settings['cta_url']['url'] ) ? esc_url( $settings['cta_url']['url'] ) : '#';
		$cta_target  = ! empty( $settings['cta_url']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
		$cta_variant = esc_attr( $settings['cta_variant'] ?? 'btn--outline-white' );
		$show_bc     = $settings['show_breadcrumb'] ?? 'no';
		$bc_home     = esc_html( $settings['breadcrumb_home_label'] ?? 'Home' );
		$bc_home_url = ! empty( $settings['breadcrumb_home_url']['url'] ) ? esc_url( $settings['breadcrumb_home_url']['url'] ) : '/';
		$bc_current  = esc_html( $settings['breadcrumb_current'] ?? $title );
		$show_overlay = ( 'yes' === ( $settings['show_overlay'] ?? 'yes' ) );
		?>

		<section class="lre-phero" id="page-hero" aria-label="<?php echo esc_attr( $title ); ?>">

			<?php if ( $show_overlay ) : ?>
				<div class="lre-phero__overlay" aria-hidden="true"></div>
			<?php endif; ?>

			<!-- Gold side accent lines -->
			<div class="lre-phero__lines" aria-hidden="true">
				<span></span>
				<span></span>
			</div>

			<!-- Inner Content -->
			<div class="lre-phero__inner">
				<div class="lre-phero__content">

					<!-- Eyebrow -->
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-phero__eyebrow-wrap">
							<span class="lre-phero__gold-bar"></span>
							<span class="lre-phero__eyebrow"><?php echo $eyebrow; ?></span>
							<span class="lre-phero__gold-bar"></span>
						</div>
					<?php endif; ?>

					<!-- H1 Title — semantic, always H1 for interior pages -->
					<!-- CSS mask-reveal animation: same heroMaskUp pattern as main hero -->
					<h1 class="lre-phero__title">
						<span class="phero-mask"><span><?php echo $title; ?></span></span>
					</h1>

					<!-- Gold divider line -->
					<div class="lre-phero__divider" aria-hidden="true"></div>

					<!-- Subtitle -->
					<?php if ( ! empty( $subtitle ) ) : ?>
						<p class="lre-phero__subtitle"><?php echo $subtitle; ?></p>
					<?php endif; ?>

					<!-- CTA Button — uses the site-wide .btn system (matching hero/cta widgets) -->
					<?php if ( 'yes' === $show_cta && ! empty( $cta_text ) ) : ?>
						<div class="lre-phero__actions">
							<a href="<?php echo $cta_url; ?>"
							   class="btn <?php echo $cta_variant; ?> lre-phero__btn"<?php echo $cta_target; ?>>
								<span><?php echo $cta_text; ?></span>
							</a>
						</div>
					<?php endif; ?>

				</div><!-- /.lre-phero__content -->
			</div><!-- /.lre-phero__inner -->

			<!-- Breadcrumb -->
			<?php if ( 'yes' === $show_bc ) : ?>
				<nav class="lre-phero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb navigation', 'luxury-re-widgets' ); ?>">
					<ol class="lre-phero__breadcrumb-list">
						<li><a href="<?php echo $bc_home_url; ?>"><?php echo $bc_home; ?></a></li>
						<li aria-hidden="true" class="lre-phero__bc-sep">
							<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
						</li>
						<li aria-current="page"><?php echo $bc_current; ?></li>
					</ol>
				</nav>
			<?php endif; ?>

			<!-- Scroll hint -->
			<div class="lre-phero__scroll-hint" aria-hidden="true">
				<div class="lre-phero__scroll-line"></div>
			</div>

		</section>
		<?php
	}
}
