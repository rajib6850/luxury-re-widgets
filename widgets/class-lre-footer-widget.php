<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * LRE_Footer_Widget
 * Ultra-Luxury editorial Footer matching 100% of the original design layout.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Footer_Widget extends Widget_Base {

	public function get_name()       { return 'lre_footer'; }
	public function get_title()      { return __( 'LRE — Luxury Footer', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-footer'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'footer', 'copyright', 'contact', 'social', 'legal', 'luxury' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── BRAND ──
		$this->start_controls_section( 'section_brand', array( 'label' => __( 'Brand Header', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'brand_name',     array( 'label' => __( 'Brand Name',     'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Victoria Crestwood', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'brand_subtitle', array( 'label' => __( 'Brand Subtitle', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => '& Associates',      'dynamic' => array( 'active' => true ) ) );
		$this->end_controls_section();

		// ── 3-COLUMN CONTACT INFO ──
		$this->start_controls_section( 'section_contact', array( 'label' => __( '3-Column Info Grid', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		
		// Col 1
		$this->add_control( 'col1_label',   array( 'label' => __( 'Column 1 Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Phone & Email', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'phone_number', array( 'label' => __( 'Phone Number',   'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => '310.555.8200',   'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'email_addr',   array( 'label' => __( 'Email Address',  'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'hello@crestwoodassociates.com', 'dynamic' => array( 'active' => true ) ) );

		// Col 2
		$this->add_control( 'col2_label', array( 'label' => __( 'Column 2 Label (DRE)', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'DRE #. 01987456', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'social_facebook',  array( 'label' => __( 'Facebook URL',  'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'social_instagram', array( 'label' => __( 'Instagram URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'social_tiktok',    array( 'label' => __( 'TikTok URL',    'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'social_linkedin',  array( 'label' => __( 'LinkedIn URL',  'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );

		// Col 3
		$this->add_control( 'col3_label',  array( 'label' => __( 'Column 3 Label', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Office', 'separator' => 'before', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'office_addr', array( 'label' => __( 'Office Address', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "1420 Sunset Plaza Drive, Suite 300<br>Los Angeles, CA 90069", 'dynamic' => array( 'active' => true ) ) );
		$this->end_controls_section();

		// ── NAVIGATION LINKS ──
		$this->start_controls_section( 'section_nav', array( 'label' => __( 'Navigation Links', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		
		$repeater = new Repeater();
		$repeater->add_control( 'link_title', array( 'label' => __( 'Link Title', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Home', 'dynamic' => array( 'active' => true ) ) );
		$repeater->add_control( 'link_url',   array( 'label' => __( 'Link URL',   'luxury-re-widgets' ), 'type' => Controls_Manager::URL,  'default' => array( 'url' => '#' ) ) );

		$this->add_control( 'nav_links', array(
			'label'       => __( 'Links', 'luxury-re-widgets' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array( 'link_title' => 'Home',           'link_url' => array( 'url' => '#hero' ) ),
				array( 'link_title' => 'About',          'link_url' => array( 'url' => '#about' ) ),
				array( 'link_title' => 'Properties',     'link_url' => array( 'url' => '#listings' ) ),
				array( 'link_title' => 'Guides',         'link_url' => array( 'url' => '#' ) ),
				array( 'link_title' => 'FAQs',           'link_url' => array( 'url' => '#' ) ),
				array( 'link_title' => 'Market Reports', 'link_url' => array( 'url' => '#' ) ),
				array( 'link_title' => 'Blog',           'link_url' => array( 'url' => '#' ) ),
				array( 'link_title' => 'Contact',        'link_url' => array( 'url' => '#contact' ) ),
			),
			'title_field' => '{{{ link_title }}}',
		) );
		$this->end_controls_section();

		// ── LEGAL & COPYRIGHT ──
		$this->start_controls_section( 'section_legal', array( 'label' => __( 'Legal & Copyright', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'legal_text', array(
			'label'   => __( 'Legal Disclaimer', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'The information provided herein is deemed reliable but is not guaranteed and should be independently verified. Properties are subject to prior sale, price change, or withdrawal without notice. All imagery and content are protected by applicable copyright laws. Crestwood & Associates and its affiliated agents are licensed professionals operating under applicable California real estate regulations. Equal Housing Opportunity.',
		) );
		$this->add_control( 'copyright_brand', array( 'label' => __( 'Copyright Company Name', 'luxury-re-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Crestwood & Associates' ) );
		$this->add_control( 'privacy_url', array( 'label' => __( 'Privacy Policy URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'terms_url', array( 'label' => __( 'Terms of Service URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control( 'accessibility_url', array( 'label' => __( 'Accessibility URL', 'luxury-re-widgets' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── STYLE: Section ──
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Footer Container', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'footer_bg', array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer' => 'background-color: {{VALUE}};' ) ) );
		$this->add_control( 'border_color', array( 'label' => __( 'Divider & Border Lines Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array(
			'{{WRAPPER}} .footer' => 'border-top-color: {{VALUE}};',
			'{{WRAPPER}} .footer__nav' => 'border-top-color: {{VALUE}};',
			'{{WRAPPER}} .footer__legal' => 'border-top-color: {{VALUE}};',
			'{{WRAPPER}} .footer__bottom' => 'border-top-color: {{VALUE}};'
		) ) );
		$this->end_controls_section();

		// ── STYLE: Brand ──
		$this->start_controls_section( 'style_brand', array( 'label' => __( 'Brand Header', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'brand_typography', 'label' => __( 'Brand Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__brand' ) );
		$this->add_control( 'brand_color', array( 'label' => __( 'Brand Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__brand' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'sub_typography', 'label' => __( 'Subtitle Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__brand-sub' ) );
		$this->add_control( 'sub_color', array( 'label' => __( 'Subtitle Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__brand-sub' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'gold_divider_color', array( 'label' => __( 'Gold Center Line Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__divider' => 'background: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Info Grid ──
		$this->start_controls_section( 'style_info_grid', array( 'label' => __( 'Info Grid & Socials', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'label_typography', 'label' => __( 'Label Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__info-label' ) );
		$this->add_control( 'label_color', array( 'label' => __( 'Label Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__info-label' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'text_typography', 'label' => __( 'Text / Links Typography', 'luxury-re-widgets' ), 'selector' => '{{WRAPPER}} .footer__info-text, {{WRAPPER}} .footer__info-text a' ) );
		$this->add_control( 'text_color', array( 'label' => __( 'Text Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__info-text, {{WRAPPER}} .footer__info-text a' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'text_hover_color', array( 'label' => __( 'Links Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__info-text a:hover' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'social_color', array( 'label' => __( 'Social Icons Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__social-link' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'social_hover_color', array( 'label' => __( 'Social Icons Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__social-link:hover' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_section();

		// ── STYLE: Nav Links ──
		$this->start_controls_section( 'style_nav_links', array( 'label' => __( 'Navigation Links Row', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_nav_styling' );
			$this->start_controls_tab( 'tab_nav_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'nav_typography', 'selector' => '{{WRAPPER}} .footer__nav-link' ) );
			$this->add_control( 'nav_link_color', array( 'label' => __( 'Link Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__nav-link' => 'color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_nav_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'nav_link_hover_color', array( 'label' => __( 'Hover Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .footer__nav-link:hover' => 'color: {{VALUE}};' ) ) );
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$fb_url   = esc_url( $settings['social_facebook']['url'] ?? '#' );
		$ig_url   = esc_url( $settings['social_instagram']['url'] ?? '#' );
		$tt_url   = esc_url( $settings['social_tiktok']['url'] ?? '#' );
		$li_url   = esc_url( $settings['social_linkedin']['url'] ?? '#' );
		?>
		<footer class="footer" id="footer" aria-label="<?php esc_attr_e( 'Site footer', 'luxury-re-widgets' ); ?>">
			<div class="footer__main reveal">
				<?php if ( ! empty( $settings['brand_name'] ) ) : ?>
				<h2 class="footer__brand">
					<span class="title-mask"><span><?php echo esc_html( $settings['brand_name'] ); ?></span></span>
				</h2>
				<?php endif; ?>

				<?php if ( ! empty( $settings['brand_subtitle'] ) ) : ?>
				<p class="footer__brand-sub delay-1"><?php echo esc_html( $settings['brand_subtitle'] ); ?></p>
				<?php endif; ?>

				<div class="footer__divider delay-1"></div>

				<div class="footer__info-grid delay-2">
					<!-- Col 1: Phone & Email -->
					<div class="footer__info-col">
						<?php if ( ! empty( $settings['col1_label'] ) ) : ?>
						<p class="footer__info-label"><?php echo esc_html( $settings['col1_label'] ); ?></p>
						<?php endif; ?>
						<p class="footer__info-text">
							<?php if ( ! empty( $settings['phone_number'] ) ) : ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $settings['phone_number'] ) ); ?>">
								<?php echo esc_html( $settings['phone_number'] ); ?>
							</a><br>
							<?php endif; ?>
							<?php if ( ! empty( $settings['email_addr'] ) ) : ?>
							<a href="mailto:<?php echo esc_attr( $settings['email_addr'] ); ?>">
								<?php echo esc_html( $settings['email_addr'] ); ?>
							</a>
							<?php endif; ?>
						</p>
					</div>

					<!-- Col 2: DRE & Social -->
					<div class="footer__info-col">
						<?php if ( ! empty( $settings['col2_label'] ) ) : ?>
						<p class="footer__info-label"><?php echo esc_html( $settings['col2_label'] ); ?></p>
						<?php endif; ?>
						<div class="footer__social">
							<a href="<?php echo esc_url( $fb_url ); ?>" class="footer__social-link" aria-label="Facebook">
								<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
							</a>
							<a href="<?php echo esc_url( $ig_url ); ?>" class="footer__social-link" aria-label="Instagram">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5"/></svg>
							</a>
							<a href="<?php echo esc_url( $tt_url ); ?>" class="footer__social-link" aria-label="TikTok">
								<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-.87-.13 2.88 2.88 0 01-2-2.73 2.89 2.89 0 012.88-2.88 2.86 2.86 0 01.87.13V9.4a6.33 6.33 0 00-1-.08A6.34 6.34 0 003 15.66 6.34 6.34 0 009.37 22a6.34 6.34 0 006.34-6.34V9.36a8.16 8.16 0 004.79 1.56v-3.4a4.85 4.85 0 01-.91-.83z"/></svg>
							</a>
							<a href="<?php echo esc_url( $li_url ); ?>" class="footer__social-link" aria-label="LinkedIn">
								<svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-4 0v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z"/></svg>
							</a>
						</div>
					</div>

					<!-- Col 3: Office -->
					<div class="footer__info-col">
						<?php if ( ! empty( $settings['col3_label'] ) ) : ?>
						<p class="footer__info-label"><?php echo esc_html( $settings['col3_label'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $settings['office_addr'] ) ) : ?>
						<p class="footer__info-text">
							<?php echo wp_kses_post( $settings['office_addr'] ); ?>
						</p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- Navigation Links Row -->
			<?php if ( ! empty( $settings['nav_links'] ) ) : ?>
			<nav class="footer__nav reveal delay-3" aria-label="<?php esc_attr_e( 'Footer navigation', 'luxury-re-widgets' ); ?>">
				<?php foreach ( $settings['nav_links'] as $item ) :
					$link_url    = esc_url( $item['link_url']['url'] ?? '#' );
					$link_target = ! empty( $item['link_url']['is_external'] ) ? '_blank' : '_self';
				?>
				<a href="<?php echo $link_url; ?>" target="<?php echo esc_attr( $link_target ); ?>" class="footer__nav-link">
					<?php echo esc_html( $item['link_title'] ); ?>
				</a>
				<?php endforeach; ?>
			</nav>
			<?php endif; ?>

			<!-- Legal Disclaimer Row -->
			<?php if ( ! empty( $settings['legal_text'] ) ) : ?>
			<div class="footer__legal">
				<p class="footer__legal-text">
					<?php echo esc_html( $settings['legal_text'] ); ?>
				</p>
			</div>
			<?php endif; ?>

			<!-- Bottom Copyright Row -->
			<div class="footer__bottom">
				<span class="footer__copyright">
					&copy; <?php echo date( 'Y' ); ?> <?php echo esc_html( $settings['copyright_brand'] ); ?>. <?php esc_html_e( 'All rights reserved. |', 'luxury-re-widgets' ); ?>
					<a href="<?php echo esc_url( $settings['privacy_url']['url'] ?? '#' ); ?>" target="<?php echo ! empty( $settings['privacy_url']['is_external'] ) ? '_blank' : '_self'; ?>"><?php esc_html_e( 'Privacy Policy', 'luxury-re-widgets' ); ?></a> &bull;
					<a href="<?php echo esc_url( $settings['terms_url']['url'] ?? '#' ); ?>" target="<?php echo ! empty( $settings['terms_url']['is_external'] ) ? '_blank' : '_self'; ?>"><?php esc_html_e( 'Terms of Service', 'luxury-re-widgets' ); ?></a> &bull;
					<a href="<?php echo esc_url( $settings['accessibility_url']['url'] ?? '#' ); ?>" target="<?php echo ! empty( $settings['accessibility_url']['is_external'] ) ? '_blank' : '_self'; ?>"><?php esc_html_e( 'Accessibility', 'luxury-re-widgets' ); ?></a>
				</span>
			</div>
		</footer>
		<?php
	}
}