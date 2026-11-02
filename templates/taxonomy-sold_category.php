<?php
/**
 * Template: taxonomy-sold_category.php
 *
 * Archive template for the 'sold_category' taxonomy.
 * Displays all Sold Properties belonging to the current category term.
 *
 * To activate: copy this file to your active theme folder,
 * OR the plugin registers it automatically via LRE_Templates.
 *
 * @package Luxury_RE_Widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$term        = get_queried_object();
$term_name   = $term ? $term->name : __( 'Sold Properties', 'luxury-re-widgets' );
$term_desc   = $term ? $term->description : '';
$term_slug   = $term ? $term->slug : '';

$query = new WP_Query( array(
	'post_type'      => 'lre_sold_property',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'tax_query'      => array(
		array(
			'taxonomy' => 'sold_category',
			'field'    => 'slug',
			'terms'    => $term_slug,
		),
	),
) );
?>

<div class="lre-cat-archive" style="background:#08080C;min-height:100vh;padding:80px 20px 100px;">
	<div class="lre-cat-archive__container" style="max-width:1200px;margin:0 auto;">

		<!-- Header -->
		<header class="lre-cat-archive__header" style="margin-bottom:60px;border-bottom:1px solid rgba(197,160,89,0.3);padding-bottom:40px;">
			<span class="lre-cat-archive__eyebrow" style="display:block;font-size:11px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:#C5A059;margin-bottom:16px;">
				<?php esc_html_e( 'Sold Portfolio', 'luxury-re-widgets' ); ?> &mdash; <?php echo esc_html( $term_name ); ?>
			</span>
			<h1 class="lre-cat-archive__title" style="font-size:clamp(2rem,5vw,3.5rem);font-weight:300;color:#F8F4EE;letter-spacing:-0.02em;margin:0 0 20px;line-height:1.1;">
				<?php echo esc_html( $term_name ); ?>
			</h1>
			<?php if ( ! empty( $term_desc ) ) : ?>
			<p class="lre-cat-archive__desc" style="font-size:16px;color:rgba(248,244,238,0.6);max-width:600px;line-height:1.7;margin:0;">
				<?php echo esc_html( $term_desc ); ?>
			</p>
			<?php endif; ?>
			<p class="lre-cat-archive__count" style="font-size:12px;color:rgba(248,244,238,0.4);margin-top:16px;letter-spacing:0.1em;text-transform:uppercase;">
				<?php printf( _n( '%s Property', '%s Properties', $query->found_posts, 'luxury-re-widgets' ), number_format_i18n( $query->found_posts ) ); ?>
			</p>
		</header>

		<!-- Properties Grid -->
		<?php if ( $query->have_posts() ) : ?>
		<div class="lre-cat-archive__grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2px;">
			<?php
			$idx = 0;
			while ( $query->have_posts() ) :
				$query->the_post();
				$post_id   = get_the_ID();
				$price     = get_post_meta( $post_id, '_lre_sold_price', true );
				$beds      = get_post_meta( $post_id, '_lre_beds', true );
				$baths     = get_post_meta( $post_id, '_lre_baths', true );
				$sqft      = get_post_meta( $post_id, '_lre_sqft', true );
				$badge     = get_post_meta( $post_id, '_lre_badge', true );
				$img_url   = get_the_post_thumbnail_url( $post_id, 'large' );
				$idx++;
			?>
			<article class="lre-cat-prop-card" style="position:relative;overflow:hidden;background:#0D0D12;border:1px solid rgba(197,160,89,0.12);transition:border-color 0.3s,box-shadow 0.3s;">
				<a href="<?php the_permalink(); ?>" style="display:block;text-decoration:none;color:inherit;">
					<!-- Image -->
					<div class="lre-cat-prop-card__media" style="position:relative;aspect-ratio:4/3;overflow:hidden;">
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
						<!-- Dark overlay -->
						<div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(8,8,12,0.2) 0%,rgba(8,8,12,0.7) 100%);pointer-events:none;"></div>
						<!-- Row number -->
						<span style="position:absolute;top:16px;left:16px;font-size:11px;font-weight:700;letter-spacing:0.15em;color:rgba(197,160,89,0.8);"><?php echo sprintf( '%03d', $idx ); ?></span>
						<!-- Badge -->
						<?php if ( $badge ) : ?>
						<span style="position:absolute;top:16px;right:16px;font-size:9px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#C5A059;background:rgba(8,8,12,0.8);padding:4px 10px;border:1px solid rgba(197,160,89,0.4);"><?php echo esc_html( $badge ); ?></span>
						<?php endif; ?>
					</div>

					<!-- Content -->
					<div class="lre-cat-prop-card__content" style="padding:24px;">
						<h2 class="lre-cat-prop-card__title" style="font-size:18px;font-weight:400;color:#F8F4EE;margin:0 0 8px;letter-spacing:-0.01em;line-height:1.3;">
							<?php the_title(); ?>
						</h2>

						<?php if ( $price ) : ?>
						<p class="lre-cat-prop-card__price" style="font-size:15px;font-weight:600;color:#C5A059;margin:0 0 16px;letter-spacing:0.02em;">
							<?php echo esc_html( $price ); ?>
						</p>
						<?php endif; ?>

						<?php if ( $beds || $baths || $sqft ) : ?>
						<div class="lre-cat-prop-card__specs" style="display:flex;gap:16px;flex-wrap:wrap;">
							<?php if ( $beds ) : ?>
							<span style="font-size:12px;color:rgba(248,244,238,0.5);letter-spacing:0.05em;">
								<strong style="color:rgba(248,244,238,0.85);"><?php echo esc_html( $beds ); ?></strong> BED
							</span>
							<?php endif; ?>
							<?php if ( $baths ) : ?>
							<span style="font-size:12px;color:rgba(248,244,238,0.5);letter-spacing:0.05em;">
								<strong style="color:rgba(248,244,238,0.85);"><?php echo esc_html( $baths ); ?></strong> BATH
							</span>
							<?php endif; ?>
							<?php if ( $sqft ) : ?>
							<span style="font-size:12px;color:rgba(248,244,238,0.5);letter-spacing:0.05em;">
								<strong style="color:rgba(248,244,238,0.85);"><?php echo esc_html( $sqft ); ?></strong> SF
							</span>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
				</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php else : ?>
		<div style="text-align:center;padding:80px 20px;">
			<p style="color:rgba(248,244,238,0.4);font-size:16px;"><?php esc_html_e( 'No properties found in this category.', 'luxury-re-widgets' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:inline-block;margin-top:24px;padding:12px 32px;border:1px solid rgba(197,160,89,0.5);color:#C5A059;text-decoration:none;font-size:12px;letter-spacing:0.1em;text-transform:uppercase;"><?php esc_html_e( 'Return Home', 'luxury-re-widgets' ); ?></a>
		</div>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
