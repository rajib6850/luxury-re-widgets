<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class LRE_Properties_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_properties';
	}

	public function get_title() {
		return __( 'LRE - Luxury Featured Properties', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'properties', 'listings', 'real estate', 'homes', 'carousel', 'luxury' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- Section Header ---
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
				'label'       => __( 'Eyebrow / Section Label', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Curated Residences', 'luxury-re-widgets' ),
				'placeholder' => __( 'Curated Residences', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Section Heading', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'New To The Market', 'luxury-re-widgets' ),
				'placeholder' => __( 'New To The Market', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'Heading Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array( 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'div' => 'div' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( "Each of these properties has been carefully selected for its architectural distinction, exceptional location, and unparalleled lifestyle. Explore our newest additions before they're gone.", 'luxury-re-widgets' ),
				'placeholder' => __( "Each of these properties has been carefully selected for its architectural distinction, exceptional location, and unparalleled lifestyle. Explore our newest additions before they're gone.", 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// --- Property Listings (Repeater) ---
		$this->start_controls_section(
			'section_listings',
			array(
				'label' => __( 'Property Listings', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'prop_image',
			array(
				'label'   => __( 'Property Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=700&q=85',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_badge',
			array(
				'label'   => __( 'Badge Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'New',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_is_gold',
			array(
				'label'   => __( 'Gold Badge Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$repeater->add_control(
			'prop_price',
			array(
				'label'   => __( 'Price', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$4,750,000',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_address',
			array(
				'label'   => __( 'Address', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '1247 Stoneridge Terrace, Pacific Palisades, CA',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_beds',
			array(
				'label'   => __( 'Bedrooms', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
			)
		);

		$repeater->add_control(
			'prop_baths',
			array(
				'label'   => __( 'Bathrooms', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			)
		);

		$repeater->add_control(
			'prop_sqft',
			array(
				'label'   => __( 'Square Feet', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '5,400',
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'prop_url',
			array(
				'label'   => __( 'Property URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'listings',
			array(
				'label'       => __( 'Listings', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=700&q=85' ),
						'prop_price'   => '$4,750,000',
						'prop_address' => '1247 Stoneridge Terrace, Pacific Palisades, CA',
						'prop_beds'    => 5,
						'prop_baths'   => 6,
						'prop_sqft'    => '5,400',
						'prop_badge'   => 'New',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=700&q=85' ),
						'prop_price'   => '$7,280,000',
						'prop_address' => '802 Emerald Bay Road, Malibu, CA 90265',
						'prop_beds'    => 6,
						'prop_baths'   => 7,
						'prop_sqft'    => '7,800',
						'prop_badge'   => 'Exclusive',
						'prop_is_gold' => 'yes',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=700&q=85' ),
						'prop_price'   => '$11,950,000',
						'prop_address' => '456 Bellagio Road, Bel Air, CA 90077',
						'prop_beds'    => 8,
						'prop_baths'   => 10,
						'prop_sqft'    => '12,300',
						'prop_badge'   => 'New',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=700&q=85' ),
						'prop_price'   => '$15,400,000',
						'prop_address' => '2190 Coldwater Canyon Dr, Beverly Hills, CA',
						'prop_beds'    => 7,
						'prop_baths'   => 9,
						'prop_sqft'    => '14,600',
						'prop_badge'   => 'Featured',
						'prop_is_gold' => 'yes',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=700&q=85' ),
						'prop_price'   => '$8,900,000',
						'prop_address' => '1054 Ocean Avenue, Santa Monica, CA 90403',
						'prop_beds'    => 5,
						'prop_baths'   => 6,
						'prop_sqft'    => '6,900',
						'prop_badge'   => 'Price Improved',
					),
					array(
						'prop_image'   => array( 'url' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=700&q=85' ),
						'prop_price'   => '$18,250,000',
						'prop_address' => '312 Meadow Lane, Montecito, CA 93108',
						'prop_beds'    => 6,
						'prop_baths'   => 8,
						'prop_sqft'    => '11,200',
						'prop_badge'   => 'Exclusive',
						'prop_is_gold' => 'yes',
					),
				),
				'title_field' => '{{{ prop_address }}}',
			)
		);

		$this->end_controls_section();

		// --- Bottom CTAs ---
		$this->start_controls_section(
			'section_ctas',
			array(
				'label' => __( 'Bottom CTA Buttons', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'cta1_text',
			array(
				'label'   => __( 'Button 1 Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Schedule A Viewing', 'luxury-re-widgets' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cta1_url',
			array(
				'label'   => __( 'Button 1 URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->add_control(
			'cta2_text',
			array(
				'label'     => __( 'Button 2 Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'View All Properties', 'luxury-re-widgets' ),
				'separator' => 'before',
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cta2_url',
			array(
				'label'   => __( 'Button 2 URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- Style: Section ---
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listings' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .listings' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- Style: Card Typography & Colors ---
		$this->start_controls_section(
			'style_card',
			array(
				'label' => __( 'Card Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'label'    => __( 'Price Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listing-card__price',
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Price Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listing-card__price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'address_typography',
				'label'    => __( 'Address Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listing-card__address',
			)
		);

		$this->add_control(
			'address_color',
			array(
				'label'     => __( 'Address Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listing-card__address' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typography',
				'label'    => __( 'Meta Info Typography', 'luxury-re-widgets' ),
				'selector' => '{{WRAPPER}} .listing-card__meta-item',
			)
		);

		$this->add_control(
			'meta_color',
			array(
				'label'     => __( 'Meta Info Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listing-card__meta-item' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2';
		$tag      = in_array( $tag, array( 'h1', 'h2', 'h3', 'div' ), true ) ? $tag : 'h2';
		?>
		<section class="listings" id="listings" aria-label="<?php esc_attr_e( 'Featured property listings', 'luxury-re-widgets' ); ?>">
			<div class="listings__header reveal">
				<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
				<span class="section-label"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
				<?php endif; ?>

				<<?php echo $tag; ?> class="listings__title">
					<span class="title-mask"><span><?php echo esc_html( $settings['heading'] ?? 'New To The Market' ); ?></span></span>
				</<?php echo $tag; ?>>

				<?php if ( ! empty( $settings['description'] ) ) : ?>
				<p class="listings__description"><?php echo esc_html( $settings['description'] ); ?></p>
				<?php endif; ?>
			</div>

			<div class="listings__carousel-wrapper">
				<div class="listings__carousel" id="listings-carousel" data-stagger>
					<?php if ( ! empty( $settings['listings'] ) ) :
						foreach ( $settings['listings'] as $prop ) :
							$img_url     = ! empty( $prop['prop_image']['url'] ) ? $prop['prop_image']['url'] : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=700&q=85';
							$is_gold     = ! empty( $prop['prop_is_gold'] ) && 'yes' === $prop['prop_is_gold'];
							$badge_class = $is_gold ? 'listing-card__badge listing-card__badge--gold' : 'listing-card__badge';
					?>
					<article class="listing-card">
						<div class="listing-card__image image-reveal">
							<img src="<?php echo esc_url( $img_url ); ?>"
							     alt="<?php echo esc_attr( $prop['prop_address'] ); ?>"
							     loading="lazy" width="600" height="450">
							<?php if ( ! empty( $prop['prop_badge'] ) ) : ?>
							<span class="<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $prop['prop_badge'] ); ?></span>
							<?php endif; ?>
							<button class="listing-card__like-btn" aria-label="<?php esc_attr_e( 'Save to favorites', 'luxury-re-widgets' ); ?>" title="<?php esc_attr_e( 'Save to favorites', 'luxury-re-widgets' ); ?>">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
									<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
								</svg>
							</button>
						</div>
						<div class="listing-card__price"><?php echo esc_html( $prop['prop_price'] ); ?></div>
						<div class="listing-card__address"><?php echo esc_html( $prop['prop_address'] ); ?></div>
						<div class="listing-card__meta">
							<span class="listing-card__meta-item" title="<?php printf( esc_attr__( '%d Bedrooms', 'luxury-re-widgets' ), absint( $prop['prop_beds'] ) ); ?>">
								<svg class="listing-card__meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
									<path d="M3 7v11M3 13h18v5M21 7v11M7 10h10M7 7a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v3H7V7z"/>
								</svg>
								<span><?php printf( esc_html__( '%d Beds', 'luxury-re-widgets' ), absint( $prop['prop_beds'] ) ); ?></span>
							</span>
							<span class="listing-card__meta-item" title="<?php printf( esc_attr__( '%d Bathrooms', 'luxury-re-widgets' ), absint( $prop['prop_baths'] ) ); ?>">
								<svg class="listing-card__meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
									<path d="M4 12h16a1 1 0 0 1 1 1v2a6 6 0 0 1-6 6H9a6 6 0 0 1-6-6v-2a1 1 0 0 1 1-1zM6 12V5a2 2 0 0 1 2-2h1"/>
									<path d="M4 19l-1 2M20 19l1 2"/>
								</svg>
								<span><?php printf( esc_html__( '%d Baths', 'luxury-re-widgets' ), absint( $prop['prop_baths'] ) ); ?></span>
							</span>
							<span class="listing-card__meta-item" title="<?php printf( esc_attr__( '%s Square Feet', 'luxury-re-widgets' ), esc_attr( $prop['prop_sqft'] ) ); ?>">
								<svg class="listing-card__meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
									<rect x="3" y="3" width="18" height="18" rx="2"/>
									<path d="M3 9h18M9 21V9"/>
								</svg>
								<span><?php echo esc_html( $prop['prop_sqft'] ); ?> <?php esc_html_e( 'Sq Ft', 'luxury-re-widgets' ); ?></span>
							</span>
						</div>
					</article>
					<?php endforeach; endif; ?>
				</div>
			</div>

			<div class="listings__controls">
				<div class="listings__nav">
					<div class="listings__dots">
						<button class="listings__nav-dot active" aria-label="<?php esc_attr_e( 'Page 1', 'luxury-re-widgets' ); ?>" data-page="0"></button>
						<button class="listings__nav-dot" aria-label="<?php esc_attr_e( 'Page 2', 'luxury-re-widgets' ); ?>" data-page="1"></button>
						<button class="listings__nav-dot" aria-label="<?php esc_attr_e( 'Page 3', 'luxury-re-widgets' ); ?>" data-page="2"></button>
					</div>
					<div class="listings__arrows">
						<button class="listings__arrow" id="listings-prev" aria-label="<?php esc_attr_e( 'Previous listings', 'luxury-re-widgets' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
						</button>
						<button class="listings__arrow" id="listings-next" aria-label="<?php esc_attr_e( 'Next listings', 'luxury-re-widgets' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18l6-6-6-6"/></svg>
						</button>
					</div>
				</div>
				<div class="listings__cta-group">
					<?php if ( ! empty( $settings['cta1_text'] ) ) : ?>
					<a href="<?php echo esc_url( $settings['cta1_url']['url'] ?? '#contact' ); ?>" class="btn btn--primary">
						<span><?php echo esc_html( $settings['cta1_text'] ); ?></span>
					</a>
					<?php endif; ?>
					<?php if ( ! empty( $settings['cta2_text'] ) ) : ?>
					<a href="<?php echo esc_url( $settings['cta2_url']['url'] ?? '#contact' ); ?>" class="btn btn--outline">
						<span><?php echo esc_html( $settings['cta2_text'] ); ?></span>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}