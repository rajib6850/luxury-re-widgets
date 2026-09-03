<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_About_Services_Widget
 * Ultra-luxury comprehensive multi-pillar advisory & services showcase for the About page.
 * Features numbered service cards, capabilities checklists, luxury gold accents,
 * and elegant hover transitions.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_About_Services_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_about_services';
	}

	public function get_title() {
		return __( 'LRE — Comprehensive Advisory & Services', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-apps';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'services', 'advisory', 'pillars', 'about', 'luxury', 'capabilities' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── HEADER ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Bespoke Advisory Capabilities',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Main Headline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Comprehensive Practice. Singular Focus.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'From confidential estate acquisitions to international portfolio restructuring, our advisory practice combines private banking discretion with unmatched architectural expertise.',
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Grid Columns', 'luxury-re-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'2' => '2 Columns',
					'3' => '3 Columns',
				),
				'prefix_class'   => 'lre-aserv-grid--col-',
			)
		);

		$this->end_controls_section();

		// ── SERVICES REPEATER ──
		$this->start_controls_section(
			'section_services_list',
			array(
				'label' => __( 'Service Pillars', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'service_number',
			array(
				'label'   => __( 'Number (e.g. 01)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'service_category',
			array(
				'label'   => __( 'Category / Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ACQUISITION & BUYER STEWARDSHIP',
			)
		);

		$repeater->add_control(
			'service_title',
			array(
				'label'   => __( 'Service Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Discreet Buyer Advisory',
			)
		);

		$repeater->add_control(
			'service_desc',
			array(
				'label'   => __( 'Overview Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Exclusive representation for high-net-worth individuals, providing access to off-market legacy properties and institutional-grade negotiation.',
			)
		);

		$repeater->add_control(
			'service_capabilities',
			array(
				'label'       => __( 'Capabilities List (One per line)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Confidential Off-Market Property Sourcing\nComprehensive Architectural Due Diligence\nLand Assembly & Development Feasibility\nDiscreet Offer Structuring & Closing",
				'description' => __( 'Enter key capabilities separated by newlines.', 'luxury-re-widgets' ),
			)
		);

		$repeater->add_control(
			'cta_text',
			array(
				'label'   => __( 'Link / CTA Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Inquire Privately',
			)
		);

		$repeater->add_control(
			'cta_url',
			array(
				'label'   => __( 'Link URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->add_control(
			'services',
			array(
				'label'       => __( 'Services Items', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ service_number }}} — {{{ service_title }}}',
				'default'     => array(
					array(
						'service_number'       => '01',
						'service_category'     => 'PRIVATE CLIENT ADVISORY',
						'service_title'        => 'Discreet Buyer Stewardship',
						'service_desc'         => 'Exclusive representation for collectors and family offices seeking exceptional properties with total privacy.',
						'service_capabilities' => "Confidential Off-Market Sourcing\nArchitectural Provenance Verification\nDiscreet Valuation & Closing Advisory",
						'cta_text'             => 'Inquire Privately',
					),
					array(
						'service_number'       => '02',
						'service_category'     => 'ESTATE MARKETING',
						'service_title'        => 'Global Editorial Representation',
						'service_desc'         => 'Positioning landmark estates before the worlds most affluent buyers through cinematic storytelling and international media.',
						'service_capabilities' => "Architectural Cinematography & Books\nInternational PR & Media Features\nPrivate Brokerage Previews & Salons",
						'cta_text'             => 'Request Portfolio',
					),
					array(
						'service_number'       => '03',
						'service_category'     => 'WEALTH & ASSET MANAGEMENT',
						'service_title'        => 'Real Estate Portfolio Advisory',
						'service_desc'         => 'Strategic asset allocation, 1031 exchange guidance, and generational transfer consultation for multi-property holdings.',
						'service_capabilities' => "Portfolio Valuation & Stress-Testing\nTax-Advantaged Exchange Advisory\nLegacy Asset Preservation Strategies",
						'cta_text'             => 'Consult An Advisor',
					),
					array(
						'service_number'       => '04',
						'service_category'     => 'DEVELOPMENT ADVISORY',
						'service_title'        => 'Architectural & Land Strategy',
						'service_desc'         => 'Advising visionary architects, developers, and estate owners from initial site acquisition to final brand launch.',
						'service_capabilities' => "Highest & Best Use Site Analysis\nFloorplan & Finish Consultation\nPre-Construction Marketing Strategy",
						'cta_text'             => 'View Case Studies',
					),
					array(
						'service_number'       => '05',
						'service_category'     => 'CONCIERGE RELOCATION',
						'service_title'        => 'Executive & Family Relocation',
						'service_desc'         => 'White-glove cross-border relocation management for executives, athletes, and global families establishing residency.',
						'service_capabilities' => "Discreet Community & School Pairing\nPrivate Transport & Temporary Estates\nFull Family Office Integration",
						'cta_text'             => 'Explore Concierge',
					),
					array(
						'service_number'       => '06',
						'service_category'     => 'PRIVATE TRANSACTIONS',
						'service_title'        => 'Off-Market Vault Placement',
						'service_desc'         => 'Direct matchmaking between vetted sellers and ultra-qualified principals without public MLS exposure or open marketing.',
						'service_capabilities' => "Strict NDA-Protected Exchanges\nCurated Private Buyer Network\nZero Digital Footprint Transactions",
						'cta_text'             => 'Access The Vault',
					),
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── SECTION STYLE ──
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section Background & Spacing', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0c0c10',
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv' => 'background-color: {{VALUE}};',
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
					'top'      => '7',
					'right'    => '2',
					'bottom'   => '7',
					'left'     => '2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-aserv' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── CARD STYLE ──
		$this->start_controls_section(
			'style_card',
			array(
				'label' => __( 'Service Cards Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.025)',
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_bg',
			array(
				'label'     => __( 'Card Hover Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.05)',
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv__card:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.07)',
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv__card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_border_color',
			array(
				'label'     => __( 'Card Hover Border Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(197, 160, 71, 0.25)',
				'selectors' => array(
					'{{WRAPPER}} .lre-aserv__card:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$eyebrow  = esc_html( $settings['eyebrow'] ?? 'Bespoke Advisory Capabilities' );
		$title    = esc_html( $settings['title'] ?? 'Comprehensive Practice. Singular Focus.' );
		$desc     = esc_html( $settings['description'] ?? '' );
		$services = ! empty( $settings['services'] ) ? $settings['services'] : array();
		?>

		<section class="lre-aserv" id="our-services-about" aria-label="<?php esc_attr_e( 'Comprehensive Real Estate Services', 'luxury-re-widgets' ); ?>">
			<div class="lre-aserv__container">
				<!-- Section Header -->
				<div class="lre-aserv__header reveal">
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-aserv__eyebrow-wrap">
							<span class="lre-aserv__gold-bar"></span>
							<span class="lre-aserv__eyebrow"><?php echo $eyebrow; ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $title ) ) :
						$clean_title = str_replace( array( "\r\n", "\r" ), "\n", $title );
						$raw_lines   = preg_split( '/<br\s*\/?>|\n/i', $clean_title );
						$title_lines = array_filter( array_map( 'trim', $raw_lines ) );
						if ( empty( $title_lines ) ) {
							$title_lines = array( $title );
						}
					?>
						<h2 class="lre-aserv__title">
							<?php foreach ( $title_lines as $t_idx => $t_line ) : ?>
								<span class="title-mask"><span><?php echo $t_line; ?></span></span><?php if ( $t_idx < count( $title_lines ) - 1 ) : ?><br><?php endif; ?>
							<?php endforeach; ?>
						</h2>
					<?php endif; ?>

					<?php if ( ! empty( $desc ) ) : ?>
						<p class="lre-aserv__desc delay-2"><?php echo $desc; ?></p>
					<?php endif; ?>
				</div>

				<!-- Multi-Pillar Grid -->
				<?php if ( ! empty( $services ) ) : ?>
					<div class="lre-aserv__grid">
						<?php foreach ( $services as $s ) :
							$num      = esc_html( $s['service_number'] ?? '01' );
							$cat      = esc_html( $s['service_category'] ?? '' );
							$stitle   = esc_html( $s['service_title'] ?? '' );
							$sdesc    = esc_html( $s['service_desc'] ?? '' );
							$cta_text = esc_html( $s['cta_text'] ?? 'Inquire Privately' );
							$cta_url  = ! empty( $s['cta_url']['url'] ) ? esc_url( $s['cta_url']['url'] ) : '#contact';
							$caps_raw = $s['service_capabilities'] ?? '';
							$caps     = array_filter( array_map( 'trim', explode( "\n", $caps_raw ) ) );
							?>
							<div class="lre-aserv__card reveal">
								<div class="lre-aserv__card-top">
									<span class="lre-aserv__num"><?php echo $num; ?></span>
									<?php if ( ! empty( $cat ) ) : ?>
										<span class="lre-aserv__cat"><?php echo $cat; ?></span>
									<?php endif; ?>
								</div>

								<h3 class="lre-aserv__card-title"><?php echo $stitle; ?></h3>

								<?php if ( ! empty( $sdesc ) ) : ?>
									<p class="lre-aserv__card-desc"><?php echo $sdesc; ?></p>
								<?php endif; ?>

								<?php if ( ! empty( $caps ) ) : ?>
									<ul class="lre-aserv__capabilities">
										<?php foreach ( $caps as $c ) : ?>
											<li>
												<svg class="lre-aserv__check-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
												<span><?php echo esc_html( $c ); ?></span>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>

								<div class="lre-aserv__card-footer">
									<a href="<?php echo $cta_url; ?>" class="lre-aserv__link">
										<span><?php echo $cta_text; ?></span>
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
