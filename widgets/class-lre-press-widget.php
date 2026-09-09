<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * LRE_Press_Widget
 *
 * Ultra-luxury "As Featured In & Accreditations" section.
 * Featuring the Asymmetric Editorial Layout (Left Headline / Right Floating Brand Portals)
 * and Centered Vitrine layout option with zero text clutter.
 * Showcases Voyage LA interview, EffectiveAgents award badge embed, and SERHANT brokerage.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Press_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_press';
	}

	public function get_title() {
		return __( 'LRE — Press & Recognition (Accolades)', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-award';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'press', 'voyagela', 'effectiveagents', 'awards', 'recognition', 'media', 'serhant', 'interview', 'accolades' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- SECTION 1: LAYOUT & HEADER ---
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Layout & Header Settings', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_header',
			array(
				'label'        => __( 'Show Header', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Tag', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'DISTINCTIONS & MEDIA',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Section Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Featured in & Industry Recognition', 'luxury-re-widgets' ),
				'placeholder' => __( 'Featured in & Industry Recognition', 'luxury-re-widgets' ),
				'description' => __( 'Supports multiple lines with Enter or <br> tags (with staggered luxury mask reveal animation).', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'     => __( 'Title HTML Tag', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'options'   => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Background Watermark', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'     => __( 'Watermark Word', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'ACCOLADES',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- SECTION 2: EXHIBITS ---
		$this->start_controls_section(
			'section_exhibits',
			array(
				'label' => __( 'Press & Recognition Entities', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$default_voyage  = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/voyagela-logo-white.png' : plugins_url( 'assets/images/voyagela-logo-white.png', dirname( dirname( __FILE__ ) ) );
		$default_serhant = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/serhant-logo-white.png' : plugins_url( 'assets/images/serhant-logo-white.png', dirname( dirname( __FILE__ ) ) );

		// Entity 1: Voyage LA
		$this->add_control(
			'heading_voyage',
			array(
				'label' => __( '1. Voyage LA Interview', 'luxury-re-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'voyage_logo',
			array(
				'label'   => __( 'Voyage LA Logo (White)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => $default_voyage,
				),
			)
		);

		$this->add_control(
			'voyage_tag',
			array(
				'label'   => __( 'Category Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'FEATURED INTERVIEW',
			)
		);

		$this->add_control(
			'voyage_btn_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read Feature',
			)
		);

		$this->add_control(
			'voyage_link',
			array(
				'label'   => __( 'Interview Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url'         => 'https://voyagela.com/interview/exploring-life-business-with-adolfo-aguirre-of-adolfo-aguirre',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);

		// Entity 2: EffectiveAgents
		$this->add_control(
			'heading_award',
			array(
				'label'     => __( '2. EffectiveAgents™ Award', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'award_badge_svg',
			array(
				'label'   => __( 'Official SVG Badge URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'https://www.effectiveagents.com/api/awards/badge/adolfo-aguirre/4.svg?variant=green',
			)
		);

		$this->add_control(
			'award_tag',
			array(
				'label'   => __( 'Category Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'TOP AGENT AWARD',
			)
		);

		$this->add_control(
			'award_btn_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Verify Award',
			)
		);

		$this->add_control(
			'award_link',
			array(
				'label'   => __( 'Award Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url'         => 'https://www.effectiveagents.com/ca/downey',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);

		// Entity 3: SERHANT
		$this->add_control(
			'heading_serhant',
			array(
				'label'     => __( '3. SERHANT. Brokerage', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'serhant_logo',
			array(
				'label'   => __( 'SERHANT. Logo (White)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => $default_serhant,
				),
			)
		);

		$this->add_control(
			'serhant_tag',
			array(
				'label'   => __( 'Category Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'GLOBAL BROKERAGE',
			)
		);

		$this->add_control(
			'serhant_btn_text',
			array(
				'label'   => __( 'Link Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'View Profile',
			)
		);

		$this->add_control(
			'serhant_link',
			array(
				'label'   => __( 'Profile Link', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url'         => 'https://serhant.com/agents/adolfo-aguirre',
					'is_external' => true,
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		$this->start_controls_section(
			'style_appearance',
			array(
				'label' => __( 'Atmosphere & Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bg_color',
			array(
				'label'       => __( 'Background Color', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::COLOR,
				'default'     => '',
				'description' => __( 'Defaults to rich dark navy (#080c14). Select your theme Primary Color to match your palette.', 'luxury-re-widgets' ),
				'selectors'   => array(
					'{{WRAPPER}} .lre-press-strip' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'accent_gold',
			array(
				'label'     => __( 'Gold Accent Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-press-strip' => '--lre-press-gold: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'show_borders',
			array(
				'label'        => __( 'Show Subtle Hairlines', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_responsive_control(
			'strip_padding',
			array(
				'label'      => __( 'Section Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '6.5',
					'bottom'   => '6.75',
					'left'     => '1.5',
					'right'    => '1.5',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-strip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- HEADER (TITLE & EYEBROW) STYLE ---
		$this->start_controls_section(
			'style_header',
			array(
				'label'     => __( 'Header & Title Typography', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-editorial__title, {{WRAPPER}} .lre-press-editorial__title span, {{WRAPPER}} .lre-press-editorial__title .title-mask > span' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-editorial__title, {{WRAPPER}} .lre-press-editorial__title span, {{WRAPPER}} .lre-press-editorial__title .title-mask > span',
			)
		);

		$this->add_responsive_control(
			'title_spacing',
			array(
				'label'      => __( 'Title Bottom Spacing', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array( 'min' => 0, 'max' => 80, 'step' => 1 ),
					'rem' => array( 'min' => 0, 'max' => 5, 'step' => 0.1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-editorial__title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .section-label, {{WRAPPER}} .lre-press-editorial__eyebrow',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .section-label, {{WRAPPER}} .lre-press-editorial__eyebrow' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-press-editorial__gold-bar' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		// --- WATERMARK STYLE ---
		$this->start_controls_section(
			'style_watermark',
			array(
				'label'     => __( 'Watermark Typography', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Watermark Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lre-press-strip__watermark' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'watermark_typography',
				'label'    => __( 'Watermark Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .lre-press-strip__watermark',
			)
		);

		$this->add_responsive_control(
			'watermark_top',
			array(
				'label'      => __( 'Vertical Offset (Top)', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem', 'vh' ),
				'range'      => array(
					'px'  => array( 'min' => -50, 'max' => 200 ),
					'rem' => array( 'min' => -2,  'max' => 15 ),
				),
				'default'    => array( 'unit' => 'rem', 'size' => 2.5 ),
				'selectors'  => array(
					'{{WRAPPER}} .lre-press-strip__watermark' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- BRAND PORTALS (ACTION LINKS) STYLE ---
		$this->start_controls_section(
			'style_portals',
			array(
				'label' => __( 'Action Links (Buttons)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'portal_action_color',
			array(
				'label'     => __( 'Button Color (Normal)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal__action' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'portal_action_hover_color',
			array(
				'label'     => __( 'Button Color (Hover)', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-press-portal:hover .lre-press-portal__action, {{WRAPPER}} .lre-press-portal__action:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-press-portal:hover .lre-press-portal__action-text::after, {{WRAPPER}} .lre-press-portal__action:hover .lre-press-portal__action-text::after' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$border_class = 'yes' === ( $settings['show_borders'] ?? 'yes' ) ? 'has-hairline' : '';
		$has_header   = ( 'yes' === ( $settings['show_header'] ?? 'yes' ) && ( ! empty( $settings['title'] ) || ! empty( $settings['eyebrow'] ) ) );

		$default_voyage  = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/voyagela-logo-white.png' : plugins_url( 'assets/images/voyagela-logo-white.png', dirname( dirname( __FILE__ ) ) );
		$default_serhant = defined( 'LRE_ASSETS_URL' ) ? LRE_ASSETS_URL . 'images/serhant-logo-white.png' : plugins_url( 'assets/images/serhant-logo-white.png', dirname( dirname( __FILE__ ) ) );

		$voyage_logo_url = ! empty( $settings['voyage_logo']['url'] ) 
			? esc_url( $settings['voyage_logo']['url'] ) 
			: $default_voyage;

		$serhant_logo_url = ! empty( $settings['serhant_logo']['url'] ) 
			? esc_url( $settings['serhant_logo']['url'] ) 
			: $default_serhant;

		$voyage_url  = ! empty( $settings['voyage_link']['url'] ) ? esc_url( $settings['voyage_link']['url'] ) : '#';
		$award_url   = ! empty( $settings['award_link']['url'] ) ? esc_url( $settings['award_link']['url'] ) : '#';
		$serhant_url = ! empty( $settings['serhant_link']['url'] ) ? esc_url( $settings['serhant_link']['url'] ) : '#';
		?>
		<div class="lre-press-strip <?php echo esc_attr( $border_class ); ?>" id="press-recognition" aria-label="<?php esc_attr_e( 'Press and Recognition', 'luxury-re-widgets' ); ?>">
			
			<?php if ( 'yes' === ( $settings['show_watermark'] ?? 'yes' ) && ! empty( $settings['watermark_text'] ) ) : ?>
				<div class="lre-press-strip__watermark" aria-hidden="true"><?php echo esc_html( $settings['watermark_text'] ); ?></div>
			<?php endif; ?>

			<div class="lre-press-strip__container">

				<!-- Asymmetric Editorial Composition (Left Masthead / Right 3 Brand Portals) -->
				<div class="lre-press-editorial <?php echo $has_header ? 'has-masthead' : 'no-masthead'; ?> reveal">

					<!-- Left Masthead Anchor -->
					<?php if ( $has_header ) : ?>
						<div class="lre-press-editorial__masthead">
							<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
								<div class="lre-press-editorial__eyebrow-wrap">
									<span class="lre-press-editorial__gold-bar" aria-hidden="true"></span>
									<span class="section-label lre-press-editorial__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $settings['title'] ) ) : 
								$is_edit_mode  = \Elementor\Plugin::$instance->editor->is_edit_mode();
								$p_tag         = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
								$p_tag         = in_array( $p_tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p' ), true ) ? $p_tag : 'h2';
								$heading_raw   = $settings['title'];
								$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
								$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
								$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
								if ( empty( $heading_lines ) ) {
									$heading_lines = array( $heading_raw );
								}
							?>
								<<?php echo $p_tag; ?> class="lre-press-editorial__title">
									<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
										<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
									<?php endforeach; ?>
								</<?php echo $p_tag; ?>>
							<?php endif; ?>
						</div>

						<!-- Center Vertical Dividing Spire -->
						<div class="lre-press-editorial__spire" aria-hidden="true">
							<span class="lre-press-editorial__spire-line"></span>
							<span class="lre-press-editorial__spire-diamond"></span>
							<span class="lre-press-editorial__spire-line"></span>
						</div>
					<?php endif; ?>

					<!-- Right Floating Brand Exhibits Flow -->
					<div class="lre-press-editorial__flow">

						<!-- Exhibit 1: Voyage LA Interview -->
						<a href="<?php echo $voyage_url; ?>" target="_blank" rel="noopener noreferrer nofollow" class="lre-press-portal" title="<?php esc_attr_e( 'Read Voyage LA Feature', 'luxury-re-widgets' ); ?>">
							<div class="lre-press-portal__glow" aria-hidden="true"></div>
							<?php if ( ! empty( $settings['voyage_tag'] ) ) : ?>
								<span class="lre-press-portal__tag"><?php echo esc_html( $settings['voyage_tag'] ); ?></span>
							<?php endif; ?>
							<div class="lre-press-portal__logo-box">
								<img src="<?php echo $voyage_logo_url; ?>" alt="<?php esc_attr_e( 'Voyage LA Interview', 'luxury-re-widgets' ); ?>" width="180" height="38" loading="lazy" class="lre-press-portal__img lre-press-portal__img--voyage">
							</div>
							<?php if ( ! empty( $settings['voyage_btn_text'] ) ) : ?>
								<span class="lre-press-portal__action">
									<span class="lre-press-portal__action-text"><?php echo esc_html( $settings['voyage_btn_text'] ); ?></span>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="lre-press-portal__arrow" aria-hidden="true">
										<line x1="7" y1="17" x2="17" y2="7"></line>
										<polyline points="7 7 17 7 17 17"></polyline>
									</svg>
								</span>
							<?php endif; ?>
						</a>

						<!-- Exhibit 2: EffectiveAgents Award -->
						<a href="<?php echo $award_url; ?>" target="_blank" rel="noopener noreferrer nofollow" class="lre-press-portal" title="<?php esc_attr_e( 'Verify EffectiveAgents Award', 'luxury-re-widgets' ); ?>">
							<div class="lre-press-portal__glow" aria-hidden="true"></div>
							<?php if ( ! empty( $settings['award_tag'] ) ) : ?>
								<span class="lre-press-portal__tag"><?php echo esc_html( $settings['award_tag'] ); ?></span>
							<?php endif; ?>
							<div class="lre-press-portal__logo-box">
								<?php if ( ! empty( $settings['award_badge_svg'] ) ) : ?>
									<img src="<?php echo esc_url( $settings['award_badge_svg'] ); ?>" alt="<?php esc_attr_e( 'Top Real Estate Agent Award', 'luxury-re-widgets' ); ?>" width="165" height="52" loading="lazy" class="lre-press-portal__img lre-press-portal__img--award">
								<?php endif; ?>
							</div>
							<?php if ( ! empty( $settings['award_btn_text'] ) ) : ?>
								<span class="lre-press-portal__action">
									<span class="lre-press-portal__action-text"><?php echo esc_html( $settings['award_btn_text'] ); ?></span>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="lre-press-portal__arrow" aria-hidden="true">
										<line x1="7" y1="17" x2="17" y2="7"></line>
										<polyline points="7 7 17 7 17 17"></polyline>
									</svg>
								</span>
							<?php endif; ?>
						</a>

						<!-- Exhibit 3: SERHANT. Brokerage -->
						<a href="<?php echo $serhant_url; ?>" target="_blank" rel="noopener noreferrer" class="lre-press-portal" title="<?php esc_attr_e( 'View SERHANT. Profile', 'luxury-re-widgets' ); ?>">
							<div class="lre-press-portal__glow" aria-hidden="true"></div>
							<?php if ( ! empty( $settings['serhant_tag'] ) ) : ?>
								<span class="lre-press-portal__tag"><?php echo esc_html( $settings['serhant_tag'] ); ?></span>
							<?php endif; ?>
							<div class="lre-press-portal__logo-box">
								<img src="<?php echo $serhant_logo_url; ?>" alt="<?php esc_attr_e( 'SERHANT. Brokerage', 'luxury-re-widgets' ); ?>" width="160" height="32" loading="lazy" class="lre-press-portal__img lre-press-portal__img--serhant">
							</div>
							<?php if ( ! empty( $settings['serhant_btn_text'] ) ) : ?>
								<span class="lre-press-portal__action">
									<span class="lre-press-portal__action-text"><?php echo esc_html( $settings['serhant_btn_text'] ); ?></span>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="lre-press-portal__arrow" aria-hidden="true">
										<line x1="7" y1="17" x2="17" y2="7"></line>
										<polyline points="7 7 17 7 17 17"></polyline>
									</svg>
								</span>
							<?php endif; ?>
						</a>

					</div>

				</div>

			</div>
		</div>
		<?php
	}
}
