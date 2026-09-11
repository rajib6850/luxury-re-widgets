<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

/**
 * LRE_Sold_Portfolio_Widget
 *
 * Super-luxury, editorial-grade showcase for Adolfo Aguirre's past sold properties.
 * Features an Architectural Editorial layout, interactive location filters,
 * career volume stats ribbon, dynamic CPT query, and an interactive case-study modal.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Sold_Portfolio_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_sold_portfolio';
	}

	public function get_title() {
		return __( 'LRE — Past Sold Portfolio', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-archive-posts';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'sold', 'properties', 'portfolio', 'listings', 'past sales', 'luxury', 'real estate', 'architectural' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- 1. SECTION HEADER ---
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
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
				'label'       => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'PROVEN TRACK RECORD • $49M+ CLOSED VOLUME', 'luxury-re-widgets' ),
				'placeholder' => __( 'Eyebrow text', 'luxury-re-widgets' ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Curated Sold Portfolio', 'luxury-re-widgets' ),
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
					'span' => 'span',
				),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A documented record of architectural stewardship, landmark estates, and strategic transactions represented by Adolfo Aguirre across Greater Los Angeles and Pasadena under SERHANT.', 'luxury-re-widgets' ),
				'condition'   => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_responsive_control(
			'header_align',
			array(
				'label'     => __( 'Alignment', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array( 'title' => __( 'Left', 'luxury-re-widgets' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'luxury-re-widgets' ), 'icon' => 'eicon-text-align-center' ),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .lre-sold-portfolio__header' => 'text-align: {{VALUE}};',
				),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- 2. STATS RIBBON ---
		$this->start_controls_section(
			'section_stats_ribbon',
			array(
				'label' => __( 'Proven Track Record Ribbon', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_stats_ribbon',
			array(
				'label'        => __( 'Show Stats Ribbon', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'stat_1_val',
			array(
				'label'     => __( 'Stat 1 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '$49M+',
				'condition' => array( 'show_stats_ribbon' => 'yes' ),
			)
		);
		$this->add_control(
			'stat_1_lbl',
			array(
				'label'     => __( 'Stat 1 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Career Closed Volume',
				'condition' => array( 'show_stats_ribbon' => 'yes' ),
			)
		);

		$this->add_control(
			'stat_2_val',
			array(
				'label'     => __( 'Stat 2 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '50+',
				'condition' => array( 'show_stats_ribbon' => 'yes' ),
			)
		);
		$this->add_control(
			'stat_2_lbl',
			array(
				'label'     => __( 'Stat 2 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Private Sales Completed',
				'condition' => array( 'show_stats_ribbon' => 'yes' ),
			)
		);

		$this->add_control(
			'stat_3_val',
			array(
				'label'     => __( 'Stat 3 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '6 Days',
				'condition' => array( 'show_stats_ribbon' => 'yes' ),
			)
		);
		$this->add_control(
			'stat_3_lbl',
			array(
				'label'     => __( 'Stat 3 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Fastest Over-Asking Sale',
				'condition' => array( 'show_stats_ribbon' => 'yes' ),
			)
		);

		$this->add_control(
			'stat_4_val',
			array(
				'label'     => __( 'Stat 4 Value', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '100%',
				'condition' => array( 'show_stats_ribbon' => 'yes' ),
			)
		);
		$this->add_control(
			'stat_4_lbl',
			array(
				'label'     => __( 'Stat 4 Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '5-Star Client Rating',
				'condition' => array( 'show_stats_ribbon' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- 3. QUERY & FILTER SETTINGS ---
		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query & Filter Controls', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_filters',
			array(
				'label'        => __( 'Show Location Filter Tabs', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'filter_all_label',
			array(
				'label'     => __( '"All" Tab Label', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'All Notable Sales',
				'condition' => array( 'show_filters' => 'yes' ),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => __( 'Number of Properties', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => -1,
				'min'     => -1,
				'max'     => 50,
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => __( 'Order By', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'price',
				'options' => array(
					'price' => __( 'Sold Price (Highest First)', 'luxury-re-widgets' ),
					'date'  => __( 'Date Published', 'luxury-re-widgets' ),
					'title' => __( 'Title (A-Z)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_control(
			'layout_style',
			array(
				'label'   => __( 'Card Layout Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'asymmetric',
				'options' => array(
					'asymmetric' => __( 'Editorial Asymmetric (Premier Triptych)', 'luxury-re-widgets' ),
					'grid'       => __( 'Balanced 3-Column Luxury Grid', 'luxury-re-widgets' ),
				),
			)
		);

		$this->end_controls_section();

		// --- 4. CARD CONTENT CONTROLS ---
		$this->start_controls_section(
			'section_cards_config',
			array(
				'label' => __( 'Card Elements & Badges', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_card_badge',
			array(
				'label'        => __( 'Show Achievement Badge', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_card_specs',
			array(
				'label'        => __( 'Show Specs Bar (Beds/Baths/SqFt)', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_card_excerpt',
			array(
				'label'        => __( 'Show Architectural Story Excerpt', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'   => __( 'Card Action Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Explore Property Record', 'luxury-re-widgets' ),
			)
		);

		$this->add_control(
			'enable_quick_view',
			array(
				'label'        => __( 'Enable Interactive Case Study Modal', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'description'  => __( 'Opens an architectural slide-over modal with full details, provenance, and consultation CTA when clicked.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// --- 5. BOTTOM ADVISORY CTA BANNER ---
		$this->start_controls_section(
			'section_bottom_cta',
			array(
				'label' => __( 'Bottom Advisory Banner', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_bottom_cta',
			array(
				'label'        => __( 'Show Advisory Banner', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'cta_eyebrow',
			array(
				'label'     => __( 'CTA Eyebrow', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'PRIVATE WEALTH & ARCHITECTURAL ADVISORY',
				'condition' => array( 'show_bottom_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'cta_title',
			array(
				'label'     => __( 'CTA Title', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Considering Selling Your Character Home or Estate?',
				'condition' => array( 'show_bottom_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'cta_desc',
			array(
				'label'     => __( 'CTA Description', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => 'Experience the difference of bespoke architectural storytelling, cinematic media, and global SERHANT. distribution tailored to maximize your property’s realized valuation.',
				'condition' => array( 'show_bottom_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'cta_btn_text',
			array(
				'label'     => __( 'CTA Button Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Request a Private Valuation',
				'condition' => array( 'show_bottom_cta' => 'yes' ),
			)
		);

		$this->add_control(
			'cta_btn_url',
			array(
				'label'       => __( 'CTA Button Link', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => '/home-valuation/',
				'default'     => array(
					'url' => '/home-valuation/',
				),
				'condition'   => array( 'show_bottom_cta' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: HEADER ---
		$this->start_controls_section(
			'style_header',
			array(
				'label' => __( 'Header Typography & Colors', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C5A059',
				'selectors' => array(
					'{{WRAPPER}} .lre-sold-portfolio__eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .lre-sold-portfolio__eyebrow',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0D0D0D',
				'selectors' => array(
					'{{WRAPPER}} .lre-sold-portfolio__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .lre-sold-portfolio__title',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'selectors' => array(
					'{{WRAPPER}} .lre-sold-portfolio__desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .lre-sold-portfolio__desc',
			)
		);

		$this->end_controls_section();

		// --- STYLE: CARDS ---
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Portfolio Cards', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .lre-sold-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'card_border',
				'selector' => '{{WRAPPER}} .lre-sold-card',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_shadow',
				'selector' => '{{WRAPPER}} .lre-sold-card',
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Sold Price Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#001A72',
				'selectors' => array(
					'{{WRAPPER}} .lre-sold-card__price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'selector' => '{{WRAPPER}} .lre-sold-card__price',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Query properties
		$args = array(
			'post_type'      => 'lre_sold_property',
			'posts_per_page' => ! empty( $settings['posts_per_page'] ) ? intval( $settings['posts_per_page'] ) : -1,
			'post_status'    => 'publish',
		);

		if ( 'price' === $settings['orderby'] ) {
			$args['meta_key'] = '_lre_price_numeric';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
		} elseif ( 'title' === $settings['orderby'] ) {
			$args['orderby']  = 'title';
			$args['order']    = 'ASC';
		} else {
			$args['orderby']  = 'date';
			$args['order']    = 'DESC';
		}

		$query = new \WP_Query( $args );

		// Get all location terms for filter tabs
		$locations = get_terms( array(
			'taxonomy'   => 'sold_location',
			'hide_empty' => true,
		) );

		$layout_class = ( 'asymmetric' === $settings['layout_style'] ) ? 'lre-sold-grid--asymmetric' : 'lre-sold-grid--balanced';
		?>
		<section class="lre-sold-portfolio" id="sold-portfolio-section">
			<div class="lre-sold-portfolio__container">

				<?php if ( 'yes' === $settings['show_header'] ) : ?>
					<div class="lre-sold-portfolio__header">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
							<span class="lre-sold-portfolio__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $settings['title'] ) ) : ?>
							<<?php echo esc_attr( $settings['title_tag'] ); ?> class="lre-sold-portfolio__title">
								<?php echo esc_html( $settings['title'] ); ?>
							</<?php echo esc_attr( $settings['title_tag'] ); ?>>
						<?php endif; ?>

						<?php if ( ! empty( $settings['description'] ) ) : ?>
							<p class="lre-sold-portfolio__desc"><?php echo esc_html( $settings['description'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_stats_ribbon'] ) : ?>
					<div class="lre-sold-ribbon">
						<div class="lre-sold-ribbon__item">
							<span class="lre-sold-ribbon__num"><?php echo esc_html( $settings['stat_1_val'] ); ?></span>
							<span class="lre-sold-ribbon__lbl"><?php echo esc_html( $settings['stat_1_lbl'] ); ?></span>
						</div>
						<div class="lre-sold-ribbon__divider"></div>
						<div class="lre-sold-ribbon__item">
							<span class="lre-sold-ribbon__num"><?php echo esc_html( $settings['stat_2_val'] ); ?></span>
							<span class="lre-sold-ribbon__lbl"><?php echo esc_html( $settings['stat_2_lbl'] ); ?></span>
						</div>
						<div class="lre-sold-ribbon__divider"></div>
						<div class="lre-sold-ribbon__item">
							<span class="lre-sold-ribbon__num"><?php echo esc_html( $settings['stat_3_val'] ); ?></span>
							<span class="lre-sold-ribbon__lbl"><?php echo esc_html( $settings['stat_3_lbl'] ); ?></span>
						</div>
						<div class="lre-sold-ribbon__divider"></div>
						<div class="lre-sold-ribbon__item">
							<span class="lre-sold-ribbon__num"><?php echo esc_html( $settings['stat_4_val'] ); ?></span>
							<span class="lre-sold-ribbon__lbl"><?php echo esc_html( $settings['stat_4_lbl'] ); ?></span>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_filters'] && ! empty( $locations ) && ! is_wp_error( $locations ) ) : ?>
					<div class="lre-sold-filters" role="tablist" aria-label="<?php esc_attr_e( 'Filter Properties by Location', 'luxury-re-widgets' ); ?>">
						<button type="button" class="lre-sold-filter-btn is-active" data-filter="all" role="tab" aria-selected="true">
							<?php echo esc_html( $settings['filter_all_label'] ); ?> <span class="lre-filter-count">(<?php echo intval( $query->found_posts ); ?>)</span>
						</button>
						<?php foreach ( $locations as $loc ) : ?>
							<button type="button" class="lre-sold-filter-btn" data-filter="<?php echo esc_attr( $loc->slug ); ?>" role="tab" aria-selected="false">
								<?php echo esc_html( $loc->name ); ?> <span class="lre-filter-count">(<?php echo intval( $loc->count ); ?>)</span>
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="lre-sold-grid <?php echo esc_attr( $layout_class ); ?>">
					<?php
					if ( $query->have_posts() ) :
						$index = 0;
						while ( $query->have_posts() ) :
							$query->the_post();
							$index++;
							$post_id     = get_the_ID();
							$price       = get_post_meta( $post_id, '_lre_sold_price', true );
							$address     = get_post_meta( $post_id, '_lre_address', true );
							$city        = get_post_meta( $post_id, '_lre_city', true );
							$beds        = get_post_meta( $post_id, '_lre_beds', true );
							$baths       = get_post_meta( $post_id, '_lre_baths', true );
							$sqft        = get_post_meta( $post_id, '_lre_sqft', true );
							$arch_style  = get_post_meta( $post_id, '_lre_arch_style', true );
							$year_built  = get_post_meta( $post_id, '_lre_year_built', true );
							$badge       = get_post_meta( $post_id, '_lre_badge', true );
							$represented = get_post_meta( $post_id, '_lre_represented', true );
							$serhant_url = get_post_meta( $post_id, '_lre_serhant_url', true );
							$featured    = get_post_meta( $post_id, '_lre_featured', true );

							// Terms
							$loc_terms = wp_get_post_terms( $post_id, 'sold_location', array( 'fields' => 'slugs' ) );
							$loc_slugs = ! empty( $loc_terms ) ? implode( ' ', $loc_terms ) : '';

							$thumb_url = has_post_thumbnail( $post_id ) ? get_the_post_thumbnail_url( $post_id, 'full' ) : lre_asset_url( 'images/property-1.jpg' );
							$is_premier = ( 'asymmetric' === $settings['layout_style'] && $index <= 2 ) ? 'lre-sold-card--premier' : '';
							?>
							<article class="lre-sold-card <?php echo esc_attr( $is_premier . ' ' . $loc_slugs ); ?>"
								data-category="<?php echo esc_attr( $loc_slugs ); ?>"
								data-title="<?php echo esc_attr( get_the_title() ); ?>"
								data-price="<?php echo esc_attr( $price ); ?>"
								data-address="<?php echo esc_attr( $address ); ?>"
								data-city="<?php echo esc_attr( $city ); ?>"
								data-beds="<?php echo esc_attr( $beds ); ?>"
								data-baths="<?php echo esc_attr( $baths ); ?>"
								data-sqft="<?php echo esc_attr( $sqft ); ?>"
								data-arch="<?php echo esc_attr( $arch_style ); ?>"
								data-year="<?php echo esc_attr( $year_built ); ?>"
								data-badge="<?php echo esc_attr( $badge ); ?>"
								data-image="<?php echo esc_url( $thumb_url ); ?>"
								data-serhant="<?php echo esc_url( $serhant_url ); ?>"
								data-desc="<?php echo esc_attr( wp_strip_all_tags( get_the_content() ) ); ?>"
							>
								<div class="lre-sold-card__media">
									<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" class="lre-sold-card__img" />
									<div class="lre-sold-card__overlay"></div>

									<?php if ( 'yes' === $settings['show_card_badge'] && ! empty( $badge ) ) : ?>
										<div class="lre-sold-card__badge-wrap">
											<span class="lre-sold-card__badge"><?php echo esc_html( $badge ); ?></span>
										</div>
									<?php endif; ?>

									<?php if ( ! empty( $represented ) ) : ?>
										<div class="lre-sold-card__rep-pill">
											<span><?php echo esc_html( $represented ); ?></span>
										</div>
									<?php endif; ?>
								</div>

								<div class="lre-sold-card__body">
									<div class="lre-sold-card__meta-top">
										<?php if ( ! empty( $price ) ) : ?>
											<div class="lre-sold-card__price"><?php echo esc_html( $price ); ?></div>
										<?php endif; ?>
										<?php if ( ! empty( $arch_style ) ) : ?>
											<span class="lre-sold-card__style-tag"><?php echo esc_html( $arch_style ); ?></span>
										<?php endif; ?>
									</div>

									<h3 class="lre-sold-card__title">
										<?php echo esc_html( $address ? $address : get_the_title() ); ?>
									</h3>
									<p class="lre-sold-card__location"><?php echo esc_html( $city ); ?></p>

									<?php if ( 'yes' === $settings['show_card_specs'] ) : ?>
										<div class="lre-sold-card__specs">
											<?php if ( ! empty( $beds ) ) : ?>
												<span class="lre-spec-item"><strong><?php echo esc_html( $beds ); ?></strong> Beds</span>
											<?php endif; ?>
											<?php if ( ! empty( $baths ) ) : ?>
												<span class="lre-spec-divider">•</span>
												<span class="lre-spec-item"><strong><?php echo esc_html( $baths ); ?></strong> Baths</span>
											<?php endif; ?>
											<?php if ( ! empty( $sqft ) ) : ?>
												<span class="lre-spec-divider">•</span>
												<span class="lre-spec-item"><strong><?php echo esc_html( $sqft ); ?></strong> Sq Ft</span>
											<?php endif; ?>
											<?php if ( ! empty( $year_built ) ) : ?>
												<span class="lre-spec-divider">•</span>
												<span class="lre-spec-item">Built <strong><?php echo esc_html( $year_built ); ?></strong></span>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php if ( 'yes' === $settings['show_card_excerpt'] ) : ?>
										<p class="lre-sold-card__excerpt">
											<?php echo esc_html( wp_trim_words( get_the_content(), 22, '...' ) ); ?>
										</p>
									<?php endif; ?>

									<div class="lre-sold-card__actions">
										<button type="button" class="lre-sold-card__btn js-open-sold-modal" aria-label="<?php esc_attr_e( 'View full architectural details for', 'luxury-re-widgets' ); ?> <?php echo esc_attr( $address ); ?>">
											<span><?php echo esc_html( $settings['btn_text'] ); ?></span>
											<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
										</button>
									</div>
								</div>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						?>
						<p class="lre-sold-empty"><?php esc_html_e( 'No sold properties found in this archive.', 'luxury-re-widgets' ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( 'yes' === $settings['show_bottom_cta'] ) : 
					$cta_link = ! empty( $settings['cta_btn_url']['url'] ) ? $settings['cta_btn_url']['url'] : '/home-valuation/';
				?>
					<div class="lre-sold-advisory-banner">
						<div class="lre-sold-advisory__content">
							<?php if ( ! empty( $settings['cta_eyebrow'] ) ) : ?>
								<span class="lre-sold-advisory__eyebrow"><?php echo esc_html( $settings['cta_eyebrow'] ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $settings['cta_title'] ) ) : ?>
								<h3 class="lre-sold-advisory__title"><?php echo esc_html( $settings['cta_title'] ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $settings['cta_desc'] ) ) : ?>
								<p class="lre-sold-advisory__desc"><?php echo esc_html( $settings['cta_desc'] ); ?></p>
							<?php endif; ?>
						</div>
						<div class="lre-sold-advisory__action">
							<a href="<?php echo esc_url( $cta_link ); ?>" class="lre-btn lre-btn--primary lre-sold-advisory__btn">
								<span><?php echo esc_html( $settings['cta_btn_text'] ); ?></span>
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
							</a>
						</div>
					</div>
				<?php endif; ?>

			</div>

			<!-- INTERACTIVE CASE STUDY DRAWER / MODAL -->
			<div class="lre-sold-modal" id="lreSoldModal" aria-hidden="true" role="dialog" aria-labelledby="lreModalTitle">
				<div class="lre-sold-modal__backdrop js-close-sold-modal"></div>
				<div class="lre-sold-modal__panel">
					<button type="button" class="lre-sold-modal__close js-close-sold-modal" aria-label="<?php esc_attr_e( 'Close dossier', 'luxury-re-widgets' ); ?>">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
					</button>

					<div class="lre-sold-modal__content">
						<div class="lre-sold-modal__hero">
							<img src="" alt="" id="lreModalImg" class="lre-sold-modal__img" />
							<div class="lre-sold-modal__badge" id="lreModalBadge"></div>
						</div>

						<div class="lre-sold-modal__details">
							<div class="lre-sold-modal__provenance">
								<span class="lre-sold-modal__eyebrow" id="lreModalArch"></span>
								<div class="lre-sold-modal__price" id="lreModalPrice"></div>
								<h2 class="lre-sold-modal__title" id="lreModalTitle"></h2>
								<p class="lre-sold-modal__city" id="lreModalCity"></p>
							</div>

							<div class="lre-sold-modal__specs-grid">
								<div class="lre-modal-spec-box">
									<span class="lre-modal-spec-box__label">Bedrooms</span>
									<span class="lre-modal-spec-box__val" id="lreModalBeds">—</span>
								</div>
								<div class="lre-modal-spec-box">
									<span class="lre-modal-spec-box__label">Bathrooms</span>
									<span class="lre-modal-spec-box__val" id="lreModalBaths">—</span>
								</div>
								<div class="lre-modal-spec-box">
									<span class="lre-modal-spec-box__label">Living Area</span>
									<span class="lre-modal-spec-box__val" id="lreModalSqft">—</span>
								</div>
								<div class="lre-modal-spec-box">
									<span class="lre-modal-spec-box__label">Year Built</span>
									<span class="lre-modal-spec-box__val" id="lreModalYear">—</span>
								</div>
							</div>

							<div class="lre-sold-modal__narrative">
								<h4><?php esc_html_e( 'Architectural Provenance & Transaction Case Study', 'luxury-re-widgets' ); ?></h4>
								<p id="lreModalDesc"></p>
							</div>

							<div class="lre-sold-modal__footer">
								<a href="/home-valuation/" class="lre-btn lre-btn--primary lre-sold-modal__cta">
									<span><?php esc_html_e( 'Request Private Valuation For Similar Home', 'luxury-re-widgets' ); ?></span>
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
								</a>
								<a href="#" id="lreModalSerhant" target="_blank" rel="noopener noreferrer" class="lre-sold-modal__serhant-link">
									<span><?php esc_html_e( 'View Official SERHANT. Record', 'luxury-re-widgets' ); ?></span>
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
