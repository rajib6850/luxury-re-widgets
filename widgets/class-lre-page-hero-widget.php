<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

/**
 * LRE_Page_Hero_Widget
 * A full-width interior page hero banner for any page (About, Contact, Services, etc.).
 * Features a full-bleed background image with a configurable dark overlay, gold eyebrow
 * label, a semantic H1 title, subtitle paragraph, and an optional CTA button.
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

		// ── BACKGROUND IMAGE ──
		$this->start_controls_section(
			'section_bg',
			array(
				'label' => __( 'Background Image', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'bg_image',
			array(
				'label'   => __( 'Background Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => '',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'bg_position',
			array(
				'label'   => __( 'Image Focus / Position', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => array(
					'center center' => 'Center Center',
					'center top'    => 'Center Top',
					'center bottom' => 'Center Bottom',
					'left center'   => 'Left Center',
					'right center'  => 'Right Center',
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__bg-img' => 'object-position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'overlay_opacity',
			array(
				'label'   => __( 'Overlay Darkness (0 = transparent, 1 = fully dark)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.05,
					),
				),
				'default' => array(
					'size' => 0.5,
				),
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__overlay' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'hero_min_height',
			array(
				'label'      => __( 'Minimum Height (vh)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'vh' => array(
						'min'  => 20,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'vh', 'px' ),
				'default'    => array(
					'size' => 52,
					'unit' => 'vh',
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-phero' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── CONTENT ──
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
				'label'   => __( 'Eyebrow Label (small text above title)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Page Title (H1)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'About Us',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'   => __( 'Subtitle / Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
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
					'left'   => array(
						'title' => __( 'Left', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .lre-phero__eyebrow-wrap' => 'justify-content: {{VALUE}};',
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
			'cta_text',
			array(
				'label'   => __( 'Button Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Meet the Team',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cta_url',
			array(
				'label'         => __( 'Button URL', 'luxury-re-widgets' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => 'https://...',
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'dynamic'       => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cta_style',
			array(
				'label'   => __( 'Button Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'outline',
				'options' => array(
					'outline' => 'Outline (White Border)',
					'gold'    => 'Filled Gold',
					'ghost'   => 'Ghost (Subtle)',
				),
			)
		);

		$this->add_control(
			'show_cta',
			array(
				'label'        => __( 'Show Button', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
				'label_on'     => __( 'Yes', 'luxury-re-widgets' ),
				'label_off'    => __( 'No', 'luxury-re-widgets' ),
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
		$this->start_controls_section(
			'style_title',
			array(
				'label' => __( 'Title Style', 'luxury-re-widgets' ),
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
					'{{WRAPPER}} .lre-phero__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_font_size',
			array(
				'label'      => __( 'Title Font Size (clamp max)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'rem', 'px', 'vw' ),
				'range'      => array(
					'rem' => array( 'min' => 2, 'max' => 10, 'step' => 0.1 ),
					'px'  => array( 'min' => 24, 'max' => 160, 'step' => 1 ),
					'vw'  => array( 'min' => 1, 'max' => 15, 'step' => 0.1 ),
				),
				'default'    => array( 'size' => 5.5, 'unit' => 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-phero__title' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── SUBTITLE & BUTTON STYLE ──
		$this->start_controls_section(
			'style_sub',
			array(
				'label' => __( 'Subtitle & Button Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.78)',
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__subtitle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => __( 'Button Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__cta' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_border_color',
			array(
				'label'     => __( 'Button Border/BG Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.6)',
				'selectors' => array(
					'{{WRAPPER}} .lre-phero__cta' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .lre-phero__cta--gold' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// ── CONTENT WIDTH ──
		$this->start_controls_section(
			'style_layout',
			array(
				'label' => __( 'Layout & Width', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$eyebrow        = esc_html( $settings['eyebrow'] ?? '' );
		$title          = esc_html( $settings['title'] ?? 'About Us' );
		$subtitle       = esc_html( $settings['subtitle'] ?? '' );
		$cta_text       = esc_html( $settings['cta_text'] ?? 'Meet the Team' );
		$cta_url        = ! empty( $settings['cta_url']['url'] ) ? esc_url( $settings['cta_url']['url'] ) : '#';
		$cta_target     = ! empty( $settings['cta_url']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
		$show_cta       = $settings['show_cta'] ?? 'yes';
		$cta_style      = $settings['cta_style'] ?? 'outline';
		$bg_image_url   = ! empty( $settings['bg_image']['url'] ) ? esc_url( $settings['bg_image']['url'] ) : '';
		$show_bc        = $settings['show_breadcrumb'] ?? 'no';
		$bc_home_label  = esc_html( $settings['breadcrumb_home_label'] ?? 'Home' );
		$bc_home_url    = ! empty( $settings['breadcrumb_home_url']['url'] ) ? esc_url( $settings['breadcrumb_home_url']['url'] ) : '/';
		$bc_current     = esc_html( $settings['breadcrumb_current'] ?? $title );

		$cta_class = 'lre-phero__cta';
		if ( 'gold' === $cta_style ) {
			$cta_class .= ' lre-phero__cta--gold';
		} elseif ( 'ghost' === $cta_style ) {
			$cta_class .= ' lre-phero__cta--ghost';
		}
		?>

		<section class="lre-phero" id="page-hero" aria-label="<?php echo esc_attr( $title ); ?>">

			<!-- Background Image -->
			<?php if ( $bg_image_url ) : ?>
				<img
					class="lre-phero__bg-img"
					src="<?php echo $bg_image_url; ?>"
					alt=""
					aria-hidden="true"
					loading="eager"
					fetchpriority="high"
				/>
			<?php endif; ?>

			<!-- Dark Overlay -->
			<div class="lre-phero__overlay" aria-hidden="true"></div>

			<!-- Gold horizontal rule decorative lines -->
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

					<!-- H1 Title — always H1 for SEO on interior pages -->
					<h1 class="lre-phero__title"><?php echo $title; ?></h1>

					<!-- Divider -->
					<div class="lre-phero__divider" aria-hidden="true"></div>

					<!-- Subtitle -->
					<?php if ( ! empty( $subtitle ) ) : ?>
						<p class="lre-phero__subtitle"><?php echo $subtitle; ?></p>
					<?php endif; ?>

					<!-- CTA Button -->
					<?php if ( 'yes' === $show_cta && ! empty( $cta_text ) ) : ?>
						<div class="lre-phero__actions">
							<a href="<?php echo $cta_url; ?>" class="<?php echo esc_attr( $cta_class ); ?>"<?php echo $cta_target; ?>>
								<span><?php echo $cta_text; ?></span>
								<svg class="lre-phero__cta-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
							</a>
						</div>
					<?php endif; ?>

				</div><!-- /.lre-phero__content -->
			</div><!-- /.lre-phero__inner -->

			<!-- Breadcrumb — bottom left -->
			<?php if ( 'yes' === $show_bc ) : ?>
				<nav class="lre-phero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb navigation', 'luxury-re-widgets' ); ?>">
					<ol class="lre-phero__breadcrumb-list">
						<li><a href="<?php echo $bc_home_url; ?>"><?php echo $bc_home_label; ?></a></li>
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
