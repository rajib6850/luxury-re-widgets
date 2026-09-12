<?php
/**
 * Template Name: Luxury Real Estate — Single Post / Market Insights
 * Template Post Type: post
 *
 * Ultra-luxury editorial single post template for Crestwood & Associates.
 * Features cinematic header, reading metrics, executive author dossier,
 * interactive social sharing, auto-generated table of contents, and
 * related market intelligence dispatch cards.
 *
 * @package Luxury_RE_Widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$post_id      = get_the_ID();
	$permalink    = get_permalink();
	$post_title   = get_the_title();
	$raw_content  = get_the_content();
	$word_count   = str_word_count( wp_strip_all_tags( $raw_content ) );
	$reading_time = max( 1, (int) ceil( $word_count / 220 ) );

	// Categories & Primary Category
	$categories  = get_the_category();
	$primary_cat = ! empty( $categories ) ? $categories[0] : null;

	// Post Excerpt / Lead
	$excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( $raw_content ), 28, '...' );

	// Featured Image
	$has_thumb = has_post_thumbnail();
	$thumb_id  = get_post_thumbnail_id();
	$thumb_url = $has_thumb ? get_the_post_thumbnail_url( $post_id, 'full' ) : '';
	$thumb_alt = $has_thumb ? get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) : '';
	if ( empty( $thumb_alt ) ) {
		$thumb_alt = $post_title;
	}
	$caption = $has_thumb ? wp_get_attachment_caption( $thumb_id ) : '';

	// Author Information
	$author_id    = get_the_author_meta( 'ID' );
	$author_name  = get_the_author();
	$author_bio   = get_the_author_meta( 'description' );
	$author_email = get_the_author_meta( 'user_email' );

	if ( empty( $author_bio ) ) {
		$author_bio = __( 'Adolfo Aguirre specializes in prime luxury architectural estates, confidential family office representation, and discreet off-market transactions across Pasadena, San Marino, and Greater Los Angeles.', 'luxury-re-widgets' );
	}

	// Share URLs
	$share_title = rawurlencode( $post_title );
	$share_url   = rawurlencode( $permalink );
	$twitter_url = 'https://twitter.com/intent/tweet?text=' . $share_title . '&url=' . $share_url;
	$linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url;
	$whatsapp_url = 'https://api.whatsapp.com/send?text=' . $share_title . '%20' . $share_url;
	$email_url    = 'mailto:?subject=' . $share_title . '&body=' . rawurlencode( sprintf( __( 'Read this intelligence report from Crestwood & Associates: %s', 'luxury-re-widgets' ), $permalink ) );

	// Parse H2 headings for Table of Contents
	$toc_items = array();
	if ( preg_match_all( '/<h2[^>]*>(.*?)<\/h2>/i', $raw_content, $matches, PREG_SET_ORDER ) ) {
		foreach ( $matches as $index => $match ) {
			$heading_text = wp_strip_all_tags( $match[1] );
			$anchor_id    = 'section-' . ( $index + 1 ) . '-' . sanitize_title( $heading_text );
			$toc_items[]  = array(
				'id'    => $anchor_id,
				'title' => $heading_text,
			);
		}
	}
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'lre-single-post' ); ?>>

		<!-- ===================================================================
		     1. EDITORIAL HERO & PUBLICATION METRICS
		     =================================================================== -->
		<header class="lre-single-post__hero">
			<div class="lre-single-post__container">

				<!-- Breadcrumbs -->
				<nav class="lre-single-post__breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luxury-re-widgets' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lre-single-post__breadcrumb-link"><?php esc_html_e( 'Home', 'luxury-re-widgets' ); ?></a>
					<span class="lre-single-post__breadcrumb-sep" aria-hidden="true">&rsaquo;</span>
					<a href="<?php echo esc_url( home_url( '/#insights' ) ); ?>" class="lre-single-post__breadcrumb-link"><?php esc_html_e( 'Market Insights', 'luxury-re-widgets' ); ?></a>
					<?php if ( $primary_cat ) : ?>
						<span class="lre-single-post__breadcrumb-sep" aria-hidden="true">&rsaquo;</span>
						<a href="<?php echo esc_url( get_category_link( $primary_cat->term_id ) ); ?>" class="lre-single-post__breadcrumb-link"><?php echo esc_html( $primary_cat->name ); ?></a>
					<?php endif; ?>
				</nav>

				<!-- Eyebrow & Intelligence Badge -->
				<div class="lre-single-post__eyebrow-wrap">
					<?php if ( ! empty( $categories ) ) : ?>
						<div class="lre-single-post__categories">
							<?php foreach ( $categories as $cat ) : ?>
								<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="lre-single-post__cat-badge">
									<?php echo esc_html( strtoupper( $cat->name ) ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php else : ?>
						<span class="lre-single-post__cat-badge"><?php esc_html_e( 'MARKET INTELLIGENCE', 'luxury-re-widgets' ); ?></span>
					<?php endif; ?>
					<span class="lre-single-post__bullet" aria-hidden="true">&bull;</span>
					<span class="lre-single-post__reading-time"><?php echo esc_html( sprintf( __( '%d MIN READ', 'luxury-re-widgets' ), $reading_time ) ); ?></span>
				</div>

				<!-- Main Headline -->
				<h1 class="lre-single-post__title">
					<?php the_title(); ?>
				</h1>

				<!-- Executive Summary / Excerpt -->
				<?php if ( ! empty( $excerpt ) ) : ?>
					<p class="lre-single-post__lead">
						<?php echo esc_html( $excerpt ); ?>
					</p>
				<?php endif; ?>

				<!-- Author & Publication Meta Bar -->
				<div class="lre-single-post__meta-bar">
					<div class="lre-single-post__author-block">
						<div class="lre-single-post__author-avatar-wrap">
							<?php
							$avatar = get_avatar( $author_id, 48, '', esc_attr( $author_name ), array( 'class' => 'lre-single-post__author-img' ) );
							if ( $avatar ) {
								echo $avatar; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							} else {
								echo '<span class="lre-single-post__author-fallback">AA</span>';
							}
							?>
						</div>
						<div class="lre-single-post__author-details">
							<span class="lre-single-post__author-name"><?php echo esc_html( $author_name ); ?></span>
							<span class="lre-single-post__author-title"><?php esc_html_e( 'Founding Principal | Luxury Real Estate Advisor', 'luxury-re-widgets' ); ?></span>
						</div>
					</div>

					<div class="lre-single-post__date-share-block">
						<time class="lre-single-post__pub-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<svg class="lre-single-post__meta-icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
								<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
								<line x1="16" y1="2" x2="16" y2="6"></line>
								<line x1="8" y1="2" x2="8" y2="6"></line>
								<line x1="3" y1="10" x2="21" y2="10"></line>
							</svg>
							<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
						</time>

						<!-- Social Sharing Pill -->
						<div class="lre-single-post__share-pill" data-share-url="<?php echo esc_url( $permalink ); ?>" data-share-title="<?php echo esc_attr( $post_title ); ?>">
							<span class="lre-single-post__share-label"><?php esc_html_e( 'SHARE:', 'luxury-re-widgets' ); ?></span>
							<button type="button" class="lre-single-post__share-btn lre-single-post__share-btn--copy" title="<?php esc_attr_e( 'Copy link to clipboard', 'luxury-re-widgets' ); ?>" aria-label="<?php esc_attr_e( 'Copy Link', 'luxury-re-widgets' ); ?>">
								<svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="9" y="9" width="13" height="13" rx="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
								<span class="lre-single-post__tooltip"><?php esc_html_e( 'Copied!', 'luxury-re-widgets' ); ?></span>
							</button>
							<a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer" class="lre-single-post__share-btn" title="<?php esc_attr_e( 'Share on LinkedIn', 'luxury-re-widgets' ); ?>" aria-label="LinkedIn">
								<svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2V10.9H6.46M7.83 6.64a1.64 1.64 0 1 0 1.64 1.64 1.65 1.65 0 0 0-1.64-1.64z"/></svg>
							</a>
							<a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="noopener noreferrer" class="lre-single-post__share-btn" title="<?php esc_attr_e( 'Share on X (Twitter)', 'luxury-re-widgets' ); ?>" aria-label="X">
								<svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
							</a>
							<a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer" class="lre-single-post__share-btn" title="<?php esc_attr_e( 'Share via WhatsApp', 'luxury-re-widgets' ); ?>" aria-label="WhatsApp">
								<svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c4.54 0 8.24 3.7 8.24 8.24 0 2.2-.86 4.28-2.42 5.84a8.18 8.18 0 0 1-5.83 2.41c-1.47 0-2.93-.39-4.21-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.19 8.19 0 0 1-1.26-4.39c0-4.54 3.7-8.24 8.25-8.24m4.52 11.66c-.25-.12-1.47-.72-1.7-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.15-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1s.9 2.44 1.03 2.61c.12.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.43.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.14-1.18-.06-.11-.22-.18-.47-.3"/></svg>
							</a>
							<a href="<?php echo esc_url( $email_url ); ?>" class="lre-single-post__share-btn" title="<?php esc_attr_e( 'Share via Email', 'luxury-re-widgets' ); ?>" aria-label="Email">
								<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
							</a>
						</div>
					</div>
				</div>

				<!-- Cinematic Featured Image Frame -->
				<?php if ( $has_thumb && ! empty( $thumb_url ) ) : ?>
					<figure class="lre-single-post__featured-frame">
						<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $thumb_alt ); ?>" class="lre-single-post__featured-img" loading="eager">
						<?php if ( ! empty( $caption ) ) : ?>
							<figcaption class="lre-single-post__featured-caption">
								<svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
								<?php echo esc_html( $caption ); ?>
							</figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>

			</div>
		</header>

		<!-- ===================================================================
		     2. EDITORIAL TWO-COLUMN GRID: BODY & ADVISORY SIDEBAR
		     =================================================================== -->
		<div class="lre-single-post__body-section">
			<div class="lre-single-post__container lre-single-post__grid">

				<!-- Main Content Column (~68%) -->
				<main class="lre-single-post__main-col">
					<div class="lre-single-post__content entry-content">
						<?php
						// Inject IDs into <h2> tags for Table of Contents anchors
						$content = apply_filters( 'the_content', get_the_content() );
						if ( ! empty( $toc_items ) ) {
							$idx = 0;
							$content = preg_replace_callback( '/<h2([^>]*)>(.*?)<\/h2>/i', function ( $m ) use ( &$idx, $toc_items ) {
								$item = isset( $toc_items[ $idx ] ) ? $toc_items[ $idx ] : null;
								$idx++;
								$anchor_attr = $item ? ' id="' . esc_attr( $item['id'] ) . '"' : '';
								return '<h2' . $m[1] . $anchor_attr . '>' . $m[2] . '</h2>';
							}, $content );
						}
						echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>

					<!-- Post Tags Strip -->
					<?php
					$tags = get_the_tags();
					if ( ! empty( $tags ) ) :
						?>
						<div class="lre-single-post__tags-strip">
							<span class="lre-single-post__tags-title"><?php esc_html_e( 'FILED UNDER:', 'luxury-re-widgets' ); ?></span>
							<div class="lre-single-post__tag-list">
								<?php foreach ( $tags as $tag ) : ?>
									<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="lre-single-post__tag-pill">
										#<?php echo esc_html( $tag->name ); ?>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<!-- Article Bottom Share Bar -->
					<div class="lre-single-post__bottom-share">
						<div class="lre-single-post__bottom-share-text">
							<span class="lre-single-post__bottom-share-label"><?php esc_html_e( 'SHARE THIS INTELLIGENCE REPORT', 'luxury-re-widgets' ); ?></span>
							<p><?php esc_html_e( 'Forward confidential analysis to partners, family office fiduciaries, or counsel.', 'luxury-re-widgets' ); ?></p>
						</div>
						<div class="lre-single-post__bottom-share-actions">
							<button type="button" class="lre-single-post__action-btn lre-single-post__share-btn--copy">
								<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="9" y="9" width="13" height="13" rx="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
								<span><?php esc_html_e( 'Copy Link', 'luxury-re-widgets' ); ?></span>
							</button>
							<a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer" class="lre-single-post__action-btn">
								<span>LinkedIn</span>
							</a>
							<a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="noopener noreferrer" class="lre-single-post__action-btn">
								<span>X / Twitter</span>
							</a>
							<button type="button" class="lre-single-post__action-btn" onclick="window.print();">
								<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
								<span><?php esc_html_e( 'Print Dossier', 'luxury-re-widgets' ); ?></span>
							</button>
						</div>
					</div>

					<!-- Executive Author Card -->
					<div class="lre-single-post__author-card">
						<div class="lre-single-post__author-card-avatar">
							<?php
							if ( $avatar ) {
								echo $avatar; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							} else {
								echo '<div class="lre-single-post__author-card-initials">AA</div>';
							}
							?>
						</div>
						<div class="lre-single-post__author-card-content">
							<span class="lre-single-post__author-card-eyebrow"><?php esc_html_e( 'ADVISORY LEAD & AUTHOR', 'luxury-re-widgets' ); ?></span>
							<h3 class="lre-single-post__author-card-name"><?php echo esc_html( $author_name ); ?></h3>
							<p class="lre-single-post__author-card-role"><?php esc_html_e( 'Founding Principal & Luxury Real Estate Advisor | DRE #01902023', 'luxury-re-widgets' ); ?></p>
							<p class="lre-single-post__author-card-bio"><?php echo esc_html( $author_bio ); ?></p>
							<div class="lre-single-post__author-card-actions">
								<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="lre-single-post__card-btn">
									<?php esc_html_e( 'Request Private Consultation', 'luxury-re-widgets' ); ?> &rarr;
								</a>
								<a href="tel:6263903498" class="lre-single-post__card-phone">
									(626) 390-3498
								</a>
							</div>
						</div>
					</div>

				</main>

				<!-- Sticky Editorial Sidebar (~32%) -->
				<aside class="lre-single-post__sidebar-col">
					<div class="lre-single-post__sidebar-sticky">

						<!-- 1. Private Representation Dossier Card -->
						<div class="lre-single-post__widget-card lre-single-post__widget-card--advisory">
							<div class="lre-single-post__card-gold-icon" aria-hidden="true">
								<svg viewBox="0 0 40 48" width="28" height="34" fill="currentColor">
									<rect x="2" y="2" width="36" height="4" rx="1"></rect>
									<rect x="6" y="8" width="5" height="30" rx="1"></rect>
									<rect x="17.5" y="8" width="5" height="30" rx="1"></rect>
									<rect x="29" y="8" width="5" height="30" rx="1"></rect>
									<rect x="2" y="40" width="36" height="4" rx="1"></rect>
									<line x1="0" y1="46" x2="40" y2="46" stroke="currentColor" stroke-width="2"></line>
								</svg>
							</div>
							<span class="lre-single-post__widget-eyebrow"><?php esc_html_e( 'CRESTWOOD & ASSOCIATES', 'luxury-re-widgets' ); ?></span>
							<h4 class="lre-single-post__widget-title"><?php esc_html_e( 'Private Advisory & Discreet Representation', 'luxury-re-widgets' ); ?></h4>
							<p class="lre-single-post__widget-desc">
								<?php esc_html_e( 'Direct confidential fiduciary representation for trophy estates, off-market acquisitions, and architectural landmarks in Pasadena & Greater Los Angeles.', 'luxury-re-widgets' ); ?>
							</p>
							<div class="lre-single-post__advisor-contact">
								<a href="tel:6263903498" class="lre-single-post__advisor-tel">
									<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
									<span>(626) 390-3498</span>
								</a>
								<span class="lre-single-post__advisor-meta"><?php esc_html_e( 'Direct Principal Line | 24/7 Fiduciary Response', 'luxury-re-widgets' ); ?></span>
							</div>
							<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="lre-single-post__sidebar-btn">
								<?php esc_html_e( 'Initiate Confidential Inquiry', 'luxury-re-widgets' ); ?>
							</a>
						</div>

						<!-- 2. Table of Contents (if 2+ headings) -->
						<?php if ( ! empty( $toc_items ) ) : ?>
							<div class="lre-single-post__widget-card lre-single-post__widget-card--toc">
								<span class="lre-single-post__widget-eyebrow"><?php esc_html_e( 'REPORT NAVIGATION', 'luxury-re-widgets' ); ?></span>
								<h4 class="lre-single-post__widget-title"><?php esc_html_e( 'Key Sections', 'luxury-re-widgets' ); ?></h4>
								<ol class="lre-single-post__toc-list">
									<?php foreach ( $toc_items as $i => $item ) : ?>
										<li class="lre-single-post__toc-item">
											<a href="#<?php echo esc_attr( $item['id'] ); ?>" class="lre-single-post__toc-link">
												<span class="lre-single-post__toc-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
												<span class="lre-single-post__toc-text"><?php echo esc_html( $item['title'] ); ?></span>
											</a>
										</li>
									<?php endforeach; ?>
								</ol>
							</div>
						<?php endif; ?>

						<!-- 3. The Private Registry Newsletter Dispatch -->
						<div class="lre-single-post__widget-card lre-single-post__widget-card--newsletter">
							<span class="lre-single-post__widget-eyebrow"><?php esc_html_e( 'OFF-MARKET INTELLIGENCE', 'luxury-re-widgets' ); ?></span>
							<h4 class="lre-single-post__widget-title"><?php esc_html_e( 'The Private Registry', 'luxury-re-widgets' ); ?></h4>
							<p class="lre-single-post__widget-desc">
								<?php esc_html_e( 'Receive quarterly liquidity benchmarks, pocket listing notifications, and sovereign transaction briefs delivered privately.', 'luxury-re-widgets' ); ?>
							</p>
							<form class="lre-single-post__registry-form" onsubmit="event.preventDefault(); alert('Thank you. You have been added to The Private Registry.');">
								<div class="lre-single-post__form-group">
									<input type="email" class="lre-single-post__form-input" placeholder="<?php esc_attr_e( 'Enter your private email', 'luxury-re-widgets' ); ?>" required>
									<button type="submit" class="lre-single-post__form-btn" aria-label="<?php esc_attr_e( 'Subscribe', 'luxury-re-widgets' ); ?>">&rarr;</button>
								</div>
								<span class="lre-single-post__form-privacy"><?php esc_html_e( 'Strict non-disclosure. We never distribute contact details.', 'luxury-re-widgets' ); ?></span>
							</form>
						</div>

					</div>
				</aside>

			</div>
		</div>

		<!-- ===================================================================
		     3. PREVIOUS / NEXT INTELLIGENCE RECORD NAVIGATION
		     =================================================================== -->
		<?php
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		if ( $prev_post || $next_post ) :
			?>
			<nav class="lre-single-post__pagination" aria-label="<?php esc_attr_e( 'Article Navigation', 'luxury-re-widgets' ); ?>">
				<div class="lre-single-post__container lre-single-post__pagination-grid">
					<?php if ( $prev_post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="lre-single-post__nav-card lre-single-post__nav-card--prev">
							<div class="lre-single-post__nav-arrow" aria-hidden="true">&larr;</div>
							<div class="lre-single-post__nav-meta">
								<span class="lre-single-post__nav-label"><?php esc_html_e( 'PREVIOUS DOSSIER', 'luxury-re-widgets' ); ?></span>
								<h5 class="lre-single-post__nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></h5>
							</div>
						</a>
					<?php else : ?>
						<div class="lre-single-post__nav-card lre-single-post__nav-card--empty"></div>
					<?php endif; ?>

					<?php if ( $next_post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="lre-single-post__nav-card lre-single-post__nav-card--next">
							<div class="lre-single-post__nav-meta">
								<span class="lre-single-post__nav-label"><?php esc_html_e( 'NEXT DOSSIER', 'luxury-re-widgets' ); ?></span>
								<h5 class="lre-single-post__nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></h5>
							</div>
							<div class="lre-single-post__nav-arrow" aria-hidden="true">&rarr;</div>
						</a>
					<?php endif; ?>
				</div>
			</nav>
		<?php endif; ?>

		<!-- ===================================================================
		     4. RELATED MARKET INTELLIGENCE (MATCHING WIDGET DESIGN)
		     =================================================================== -->
		<?php
		$related_args = array(
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'post__not_in'   => array( $post_id ),
			'post_status'    => 'publish',
		);
		if ( $primary_cat ) {
			$related_args['category__in'] = array( $primary_cat->term_id );
		}
		$related_query = new WP_Query( $related_args );

		// Fallback to recent posts if less than 2 category matches
		if ( $related_query->post_count < 2 ) {
			$related_query = new WP_Query( array(
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'post__not_in'   => array( $post_id ),
				'post_status'    => 'publish',
			) );
		}

		if ( $related_query->have_posts() ) :
			?>
			<section class="lre-single-post__related-section" aria-labelledby="related-insights-title">
				<div class="lre-single-post__container">
					<div class="lre-single-post__related-header">
						<div class="lre-single-post__related-badge-wrap">
							<span class="lre-single-post__related-badge"><?php esc_html_e( 'EDITORIAL DISPATCH', 'luxury-re-widgets' ); ?></span>
						</div>
						<h3 id="related-insights-title" class="lre-single-post__related-main-title">
							<?php esc_html_e( 'Related Market Intelligence & Analysis', 'luxury-re-widgets' ); ?>
						</h3>
						<p class="lre-single-post__related-subtitle">
							<?php esc_html_e( 'Curated research and confidential insights from Adolfo Aguirre and the Crestwood advisory team.', 'luxury-re-widgets' ); ?>
						</p>
					</div>

					<div class="lre-single-post__related-grid">
						<?php
						while ( $related_query->have_posts() ) :
							$related_query->the_post();
							$r_id      = get_the_ID();
							$r_link    = get_permalink();
							$r_title   = get_the_title();
							$r_has_img = has_post_thumbnail( $r_id );
							$r_img_url = $r_has_img ? get_the_post_thumbnail_url( $r_id, 'medium_large' ) : '';
							$r_cats    = get_the_category( $r_id );
							$r_cat     = ! empty( $r_cats ) ? $r_cats[0]->name : 'Advisory';
							$r_time    = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) );
							$r_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 16, '...' );
							?>
							<article class="lre-single-post__related-card">
								<a href="<?php echo esc_url( $r_link ); ?>" class="lre-single-post__card-media">
									<?php if ( $r_has_img && ! empty( $r_img_url ) ) : ?>
										<img src="<?php echo esc_url( $r_img_url ); ?>" alt="<?php echo esc_attr( $r_title ); ?>" class="lre-single-post__card-img" loading="lazy">
									<?php else : ?>
										<div class="lre-single-post__card-img-fallback"></div>
									<?php endif; ?>
									<span class="lre-single-post__card-tag"><?php echo esc_html( strtoupper( $r_cat ) ); ?></span>
								</a>
								<div class="lre-single-post__card-body">
									<div class="lre-single-post__card-meta">
										<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
										<span aria-hidden="true">&bull;</span>
										<span><?php echo esc_html( sprintf( __( '%d min read', 'luxury-re-widgets' ), $r_time ) ); ?></span>
									</div>
									<h4 class="lre-single-post__card-title">
										<a href="<?php echo esc_url( $r_link ); ?>"><?php echo esc_html( $r_title ); ?></a>
									</h4>
									<p class="lre-single-post__card-excerpt">
										<?php echo esc_html( $r_excerpt ); ?>
									</p>
									<a href="<?php echo esc_url( $r_link ); ?>" class="lre-single-post__card-more">
										<span><?php esc_html_e( 'READ DOSSIER', 'luxury-re-widgets' ); ?></span>
										<span aria-hidden="true">&rarr;</span>
									</a>
								</div>
							</article>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

	</article>

<?php
endwhile;

get_footer();
