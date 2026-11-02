<?php
/**
 * Template: taxonomy-neighborhood_category.php
 *
 * Archive template for the 'neighborhood_category' taxonomy.
 * Displays all Neighborhood posts belonging to the current category term.
 * Formatted with exact parity to the Luxury Communities Showcase design.
 *
 * @package Luxury_RE_Widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$term      = get_queried_object();
$term_name = $term ? $term->name : __( 'Neighborhoods', 'luxury-re-widgets' );
$term_desc = $term ? $term->description : '';
$term_slug = $term ? $term->slug : '';

// Retrieve category photo if uploaded
$term_img_id = ( $term && isset( $term->term_id ) ) ? get_term_meta( $term->term_id, 'image_id', true ) : 0;
$term_img    = $term_img_id ? wp_get_attachment_image_url( $term_img_id, 'full' ) : ( ( $term && isset( $term->term_id ) ) ? get_term_meta( $term->term_id, 'image', true ) : '' );

$query = new WP_Query( array(
	'post_type'      => array( 'neighborhoods', 'neighborhood' ),
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'tax_query'      => array(
		array(
			'taxonomy' => 'neighborhood_category',
			'field'    => 'slug',
			'terms'    => $term_slug,
		),
	),
) );
?>

<section class="lre-comm-showcase lre-comm-archive-page" id="communities-archive" aria-label="<?php echo esc_attr( $term_name ); ?>" style="min-height: 80vh; padding-top: 140px; padding-bottom: 120px; background-color: #08080C;">
	<div class="lre-comm-showcase__container">

		<!-- SECTION HEADER -->
		<header class="lre-comm-showcase__header revealed" style="margin-bottom: 3.5rem;">
			<div class="lre-comm-showcase__eyebrow-wrap">
				<span class="lre-comm-showcase__gold-bar" aria-hidden="true"></span>
				<span class="section-label lre-comm-showcase__eyebrow">
					<?php esc_html_e( 'COMMUNITY COLLECTION • ARCHIVE', 'luxury-re-widgets' ); ?>
				</span>
			</div>

			<h1 class="lre-comm-showcase__title" style="font-size: clamp(2.5rem, 5vw, 4.25rem); font-weight: 300; letter-spacing: -0.02em; margin: 0 0 1.25rem; line-height: 1.1;">
				<span class="title-mask revealed"><span><?php echo esc_html( $term_name ); ?></span></span>
			</h1>

			<?php if ( ! empty( $term_desc ) ) : ?>
			<p class="lre-comm-showcase__description" style="max-width: 680px; margin-bottom: 1rem;">
				<?php echo esc_html( $term_desc ); ?>
			</p>
			<?php else : ?>
			<p class="lre-comm-showcase__description" style="max-width: 680px; margin-bottom: 1rem;">
				<?php printf( esc_html__( 'An exclusive portfolio of landmark residential territories and private enclaves in %s.', 'luxury-re-widgets' ), esc_html( $term_name ) ); ?>
			</p>
			<?php endif; ?>

			<p class="lre-comm-archive__count" style="font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: #C5A059; margin-top: 0.75rem; font-weight: 600;">
				<?php printf( _n( '%s Featured Enclave', '%s Featured Enclaves', $query->found_posts, 'luxury-re-widgets' ), number_format_i18n( $query->found_posts ) ); ?>
			</p>
		</header>

		<?php if ( ! empty( $term_img ) ) : ?>
		<div class="lre-comm-archive__hero-banner" style="position: relative; width: 100%; height: 340px; margin-bottom: 3.5rem; overflow: hidden; border-radius: 6px; border: 1px solid rgba(197, 160, 89, 0.25);">
			<img src="<?php echo esc_url( $term_img ); ?>" alt="<?php echo esc_attr( $term_name ); ?>" style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.88);" />
			<div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(8, 8, 12, 0.15) 0%, rgba(8, 8, 12, 0.75) 100%); pointer-events: none;"></div>
		</div>
		<?php endif; ?>

		<!-- MINIMALIST ARCHITECTURAL GALLERY GRID (Same exact markup & style as Showcase Widget) -->
		<?php if ( $query->have_posts() ) : ?>
		<div class="lre-comm-gallery" id="lre-comm-gallery">
			<?php
			$idx = 0;
			while ( $query->have_posts() ) :
				$query->the_post();
				$post_id   = get_the_ID();
				$idx++;
				$index_num = sprintf( '%02d', $idx );

				// Tagline
				$tagline = '';
				if ( function_exists( 'get_field' ) ) {
					try {
						$tagline = get_field( 'subtitle', $post_id );
					} catch ( \Throwable $e ) {
						$tagline = '';
					}
				}
				if ( empty( $tagline ) ) {
					$tagline = get_post_meta( $post_id, 'subtitle', true );
				}
				if ( empty( $tagline ) ) {
					$tagline = get_the_excerpt();
				}

				// Image
				$img_url = get_the_post_thumbnail_url( $post_id, 'full' );
				if ( empty( $img_url ) ) {
					$thumb_id = get_post_meta( $post_id, '_thumbnail_id', true );
					if ( $thumb_id ) {
						$img_url = wp_get_attachment_image_url( $thumb_id, 'full' );
					}
				}
				if ( empty( $img_url ) ) {
					$img_url = lre_asset_url( 'images/property-1.jpg' );
				}
			?>
			<article class="lre-comm-frame revealed" data-category="<?php echo esc_attr( $term_slug ); ?>">
				<a href="<?php the_permalink(); ?>" class="lre-comm-frame__link">
					<!-- Upper Dedicated Image Section -->
					<div class="lre-comm-frame__media">
						<img src="<?php echo esc_url( $img_url ); ?>"
						     alt="<?php echo esc_attr( get_the_title() ); ?>"
						     class="lre-comm-frame__img"
						     loading="lazy" width="800" height="1060">
						<div class="lre-comm-frame__vignette"></div>

						<!-- Top Corner Index & Category (Floats on image) -->
						<div class="lre-comm-frame__header">
							<span class="lre-comm-frame__index"><?php echo esc_html( $index_num ); ?></span>
							<span class="lre-comm-frame__category"><?php echo esc_html( $term_name ); ?></span>
						</div>
					</div>

					<!-- Lower Dedicated Content Section -->
					<div class="lre-comm-frame__footer">
						<h3 class="lre-comm-frame__name"><?php the_title(); ?></h3>

						<?php if ( ! empty( $tagline ) ) : ?>
						<p class="lre-comm-frame__tagline"><?php echo esc_html( $tagline ); ?></p>
						<?php endif; ?>

						<div class="lre-comm-frame__action">
							<span class="lre-comm-frame__action-text"><?php esc_html_e( 'Explore Enclave', 'luxury-re-widgets' ); ?></span>
							<span class="lre-comm-frame__action-line" aria-hidden="true"></span>
							<svg class="lre-comm-frame__action-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						</div>
					</div>
				</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php else : ?>
		<div style="text-align: center; padding: 5rem 1rem; border: 1px solid rgba(255, 255, 255, 0.08); background: #0c0c12; border-radius: 6px;">
			<p style="color: rgba(248, 244, 238, 0.6); font-size: 1.1rem; margin-bottom: 2rem;">
				<?php esc_html_e( 'No enclaves currently registered under this collection.', 'luxury-re-widgets' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; border: 1px solid #C5A059; color: #C5A059; text-decoration: none; font-size: 0.8rem; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; transition: all 0.3s ease;">
				<?php esc_html_e( 'Return to Portfolio', 'luxury-re-widgets' ); ?> &rarr;
			</a>
		</div>
		<?php endif; ?>

	</div>
</section>

<?php get_footer(); ?>
