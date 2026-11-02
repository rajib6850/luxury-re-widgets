<?php
/**
 * Template: taxonomy-neighborhood_category.php
 *
 * Archive template for the 'neighborhood_category' taxonomy.
 * Displays all Neighborhood posts belonging to the current category term.
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

<div class="lre-neigh-cat-archive" style="background:#08080C;min-height:100vh;padding:80px 20px 100px;">
	<div class="lre-neigh-cat-archive__container" style="max-width:1200px;margin:0 auto;">

		<!-- Header -->
		<header class="lre-neigh-cat-archive__header" style="margin-bottom:60px;border-bottom:1px solid rgba(197,160,89,0.3);padding-bottom:40px;">
			<span class="lre-neigh-cat-archive__eyebrow" style="display:block;font-size:11px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:#C5A059;margin-bottom:16px;">
				<?php esc_html_e( 'Communities', 'luxury-re-widgets' ); ?> &mdash; <?php echo esc_html( $term_name ); ?>
			</span>
			<h1 class="lre-neigh-cat-archive__title" style="font-size:clamp(2rem,5vw,3.5rem);font-weight:300;color:#F8F4EE;letter-spacing:-0.02em;margin:0 0 20px;line-height:1.1;">
				<?php echo esc_html( $term_name ); ?>
			</h1>
			<?php if ( ! empty( $term_desc ) ) : ?>
			<p class="lre-neigh-cat-archive__desc" style="font-size:16px;color:rgba(248,244,238,0.6);max-width:600px;line-height:1.7;margin:0;">
				<?php echo esc_html( $term_desc ); ?>
			</p>
			<?php endif; ?>
			<p class="lre-neigh-cat-archive__count" style="font-size:12px;color:rgba(248,244,238,0.4);margin-top:16px;letter-spacing:0.1em;text-transform:uppercase;">
				<?php printf( _n( '%s Neighborhood', '%s Neighborhoods', $query->found_posts, 'luxury-re-widgets' ), number_format_i18n( $query->found_posts ) ); ?>
			</p>
		</header>

		<!-- Neighborhoods Grid -->
		<?php if ( $query->have_posts() ) : ?>
		<div class="lre-neigh-cat-archive__grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:2px;">
			<?php
			$idx = 0;
			while ( $query->have_posts() ) :
				$query->the_post();
				$post_id = get_the_ID();
				$idx++;

				// Tagline / subtitle
				$tagline = '';
				if ( function_exists( 'get_field' ) ) {
					try { $tagline = get_field( 'subtitle', $post_id ); } catch ( \Throwable $e ) { $tagline = ''; }
				}
				if ( empty( $tagline ) ) { $tagline = get_post_meta( $post_id, 'subtitle', true ); }
				if ( empty( $tagline ) ) { $tagline = get_the_excerpt(); }

				$img_url = get_the_post_thumbnail_url( $post_id, 'large' );
			?>
			<article class="lre-neigh-card" style="position:relative;overflow:hidden;background:#0D0D12;border:1px solid rgba(197,160,89,0.12);transition:border-color 0.3s,box-shadow 0.3s;">
				<a href="<?php the_permalink(); ?>" style="display:block;text-decoration:none;color:inherit;">
					<!-- Image -->
					<div class="lre-neigh-card__media" style="position:relative;aspect-ratio:4/3;overflow:hidden;">
						<?php if ( $img_url ) : ?>
						<img src="<?php echo esc_url( $img_url ); ?>"
						     alt="<?php echo esc_attr( get_the_title() ); ?>"
						     style="width:100%;height:100%;object-fit:cover;transition:transform 1.2s ease;"
						     loading="lazy">
						<?php else : ?>
						<div style="width:100%;height:100%;background:#1a1a22;display:flex;align-items:center;justify-content:center;">
							<span style="color:rgba(197,160,89,0.3);font-size:40px;">⌂</span>
						</div>
						<?php endif; ?>
						<div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(8,8,12,0.2) 0%,rgba(8,8,12,0.65) 100%);pointer-events:none;"></div>
						<span style="position:absolute;top:16px;left:16px;font-size:11px;font-weight:700;letter-spacing:0.15em;color:rgba(197,160,89,0.8);"><?php echo sprintf( '%02d', $idx ); ?></span>
					</div>

					<!-- Content -->
					<div class="lre-neigh-card__content" style="padding:24px;">
						<h2 class="lre-neigh-card__title" style="font-size:20px;font-weight:400;color:#F8F4EE;margin:0 0 10px;letter-spacing:-0.01em;line-height:1.2;">
							<?php the_title(); ?>
						</h2>
						<?php if ( ! empty( $tagline ) ) : ?>
						<p class="lre-neigh-card__tagline" style="font-size:13px;color:rgba(248,244,238,0.5);margin:0 0 16px;line-height:1.5;">
							<?php echo esc_html( $tagline ); ?>
						</p>
						<?php endif; ?>
						<span style="display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#C5A059;">
							<?php esc_html_e( 'Explore Enclave', 'luxury-re-widgets' ); ?>
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:14px;height:14px;" aria-hidden="true">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						</span>
					</div>
				</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php else : ?>
		<div style="text-align:center;padding:80px 20px;">
			<p style="color:rgba(248,244,238,0.4);font-size:16px;"><?php esc_html_e( 'No neighborhoods found in this category.', 'luxury-re-widgets' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:inline-block;margin-top:24px;padding:12px 32px;border:1px solid rgba(197,160,89,0.5);color:#C5A059;text-decoration:none;font-size:12px;letter-spacing:0.1em;text-transform:uppercase;"><?php esc_html_e( 'Return Home', 'luxury-re-widgets' ); ?></a>
		</div>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>

