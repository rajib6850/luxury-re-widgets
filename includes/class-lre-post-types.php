<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_Post_Types
 *
 * Registers the 'lre_sold_property' Custom Post Type, custom taxonomies,
 * and admin enhancements for Adolfo Aguirre's luxury past sold portfolio.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Post_Types {

	/** @var LRE_Post_Types|null Singleton instance */
	private static $instance = null;

	/**
	 * Returns singleton instance.
	 *
	 * @return LRE_Post_Types
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Constructor. */
	private function __construct() {
		add_action( 'init', array( $this, 'register_post_types' ), 0 );
		add_action( 'init', array( $this, 'register_taxonomies' ), 0 );
		add_action( 'init', array( $this, 'register_meta_fields' ) );

		// Admin customizations & meta boxes
		if ( is_admin() ) {
			add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
			add_action( 'save_post_lre_sold_property', array( $this, 'save_meta_box' ) );

			// Admin column customizations
			add_filter( 'manage_lre_sold_property_posts_columns', array( $this, 'register_admin_columns' ) );
			add_action( 'manage_lre_sold_property_posts_custom_column', array( $this, 'render_admin_columns' ), 10, 2 );
			add_filter( 'manage_edit-lre_sold_property_sortable_columns', array( $this, 'sortable_admin_columns' ) );

			// Quick Edit support
			add_action( 'quick_edit_custom_box', array( $this, 'render_quick_edit_fields' ), 10, 2 );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		}
	}

	/**
	 * Registers the Sold Property Custom Post Type.
	 */
	public function register_post_types() {
		$labels = array(
			'name'                  => _x( 'Sold Properties', 'Post type general name', 'luxury-re-widgets' ),
			'singular_name'         => _x( 'Sold Property', 'Post type singular name', 'luxury-re-widgets' ),
			'menu_name'             => _x( 'Sold Portfolio', 'Admin Menu text', 'luxury-re-widgets' ),
			'name_admin_bar'        => _x( 'Sold Property', 'Add New on Toolbar', 'luxury-re-widgets' ),
			'add_new'               => __( 'Add New Sale', 'luxury-re-widgets' ),
			'add_new_item'          => __( 'Add New Sold Property', 'luxury-re-widgets' ),
			'new_item'              => __( 'New Sold Property', 'luxury-re-widgets' ),
			'edit_item'             => __( 'Edit Sold Property', 'luxury-re-widgets' ),
			'view_item'             => __( 'View Sold Property', 'luxury-re-widgets' ),
			'all_items'             => __( 'All Sold Properties', 'luxury-re-widgets' ),
			'search_items'          => __( 'Search Sold Properties', 'luxury-re-widgets' ),
			'parent_item_colon'     => __( 'Parent Sold Properties:', 'luxury-re-widgets' ),
			'not_found'             => __( 'No sold properties found.', 'luxury-re-widgets' ),
			'not_found_in_trash'    => __( 'No sold properties found in Trash.', 'luxury-re-widgets' ),
			'featured_image'        => _x( 'Property Hero Photography', 'Overrides the “Set featured image” phrase', 'luxury-re-widgets' ),
			'set_featured_image'    => _x( 'Set property photography', 'Overrides the “Set featured image” phrase', 'luxury-re-widgets' ),
			'remove_featured_image' => _x( 'Remove photography', 'Overrides the “Remove featured image” phrase', 'luxury-re-widgets' ),
			'use_featured_image'    => _x( 'Use as property photography', 'Overrides the “Use as featured image” phrase', 'luxury-re-widgets' ),
			'archives'              => _x( 'Sold Property Archives', 'The post type archive label used in nav menus', 'luxury-re-widgets' ),
			'insert_into_item'      => _x( 'Insert into sold property', 'Overrides the “Insert into post” phrase', 'luxury-re-widgets' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this sold property', 'Overrides the “Uploaded to this post” phrase', 'luxury-re-widgets' ),
			'filter_items_list'     => _x( 'Filter sold properties list', 'Screen reader text for the filter links', 'luxury-re-widgets' ),
			'items_list_navigation' => _x( 'Sold properties list navigation', 'Screen reader text for the pagination', 'luxury-re-widgets' ),
			'items_list'            => _x( 'Sold properties list', 'Screen reader text for the items list', 'luxury-re-widgets' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'sold-properties', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-building',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'show_in_rest'       => true,
		);

		register_post_type( 'lre_sold_property', $args );
	}

	/**
	 * Registers custom taxonomies for Sold Properties.
	 */
	public function register_taxonomies() {
		// Location Taxonomy (e.g. Pasadena, Greater Los Angeles, Gateway Cities)
		$labels_loc = array(
			'name'              => _x( 'Locations', 'taxonomy general name', 'luxury-re-widgets' ),
			'singular_name'     => _x( 'Location', 'taxonomy singular name', 'luxury-re-widgets' ),
			'search_items'      => __( 'Search Locations', 'luxury-re-widgets' ),
			'all_items'         => __( 'All Locations', 'luxury-re-widgets' ),
			'parent_item'       => __( 'Parent Location', 'luxury-re-widgets' ),
			'parent_item_colon' => __( 'Parent Location:', 'luxury-re-widgets' ),
			'edit_item'         => __( 'Edit Location', 'luxury-re-widgets' ),
			'update_item'       => __( 'Update Location', 'luxury-re-widgets' ),
			'add_new_item'      => __( 'Add New Location', 'luxury-re-widgets' ),
			'new_item_name'     => __( 'New Location Name', 'luxury-re-widgets' ),
			'menu_name'         => __( 'Locations', 'luxury-re-widgets' ),
		);

		register_taxonomy(
			'sold_location',
			array( 'lre_sold_property' ),
			array(
				'hierarchical'      => true,
				'labels'            => $labels_loc,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'sold-location' ),
				'show_in_rest'      => true,
			)
		);
	}

	/**
	 * Custom columns for WP Admin list view.
	 */
	public function register_admin_columns( $columns ) {
		$new_columns = array();
		$new_columns['cb']          = $columns['cb'];
		$new_columns['prop_thumb']  = __( 'Photo', 'luxury-re-widgets' );
		$new_columns['title']       = __( 'Property Name', 'luxury-re-widgets' );
		$new_columns['prop_price']  = __( 'Sold Price', 'luxury-re-widgets' );
		$new_columns['prop_specs']  = __( 'Beds / Baths / SqFt', 'luxury-re-widgets' );
		$new_columns['prop_badge']  = __( 'Achievement Badge', 'luxury-re-widgets' );
		$new_columns['taxonomy-sold_location'] = __( 'Location', 'luxury-re-widgets' );
		$new_columns['date']        = $columns['date'];
		return $new_columns;
	}

	/**
	 * Output content for custom admin columns.
	 */
	public function render_admin_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'prop_thumb':
				if ( has_post_thumbnail( $post_id ) ) {
					echo get_the_post_thumbnail( $post_id, array( 60, 45 ), array( 'style' => 'width:60px;height:45px;object-fit:cover;border-radius:3px;border:1px solid #ddd;' ) );
				} else {
					echo '<span style="color:#aaa;font-size:12px;">No photo</span>';
				}
				break;

			case 'prop_price':
				$price = get_post_meta( $post_id, '_lre_sold_price', true );
				echo $price ? '<strong style="color:#001A72;font-size:14px;">' . esc_html( $price ) . '</strong>' : '—';
				echo '<span class="prop_price_val" style="display:none;">' . esc_html( $price ) . '</span>';
				break;

			case 'prop_specs':
				$beds  = get_post_meta( $post_id, '_lre_beds', true );
				$baths = get_post_meta( $post_id, '_lre_baths', true );
				$sqft  = get_post_meta( $post_id, '_lre_sqft', true );
				$parts = array();
				if ( $beds )  $parts[] = $beds . ' Beds';
				if ( $baths ) $parts[] = $baths . ' Baths';
				if ( $sqft )  $parts[] = number_format_i18n( intval( str_replace( ',', '', $sqft ) ) ) . ' Sq Ft';
				echo ! empty( $parts ) ? esc_html( implode( ' • ', $parts ) ) : '—';
				echo '<span class="prop_beds_val" style="display:none;">' . esc_html( $beds ) . '</span>';
				echo '<span class="prop_baths_val" style="display:none;">' . esc_html( $baths ) . '</span>';
				echo '<span class="prop_sqft_val" style="display:none;">' . esc_html( $sqft ) . '</span>';
				break;

			case 'prop_badge':
				$badge = get_post_meta( $post_id, '_lre_badge', true );
				if ( $badge ) {
					echo '<span style="background:#f4f4f4;padding:3px 8px;border-radius:3px;font-size:11px;font-weight:600;color:#333;border-left:3px solid #C5A059;">' . esc_html( $badge ) . '</span>';
				} else {
					echo '—';
				}
				echo '<span class="prop_badge_val" style="display:none;">' . esc_html( $badge ) . '</span>';
				$city = get_post_meta( $post_id, '_lre_city', true );
				echo '<span class="prop_city_val" style="display:none;">' . esc_html( $city ) . '</span>';
				break;
		}
	}

	/**
	 * Make columns sortable.
	 */
	public function sortable_admin_columns( $columns ) {
		$columns['prop_price'] = 'prop_price';
		return $columns;
	}

	/**
	 * Registers custom post meta fields for REST API and Gutenberg.
	 */
	public function register_meta_fields() {
		$fields = array(
			'_lre_sold_price' => 'string',
			'_lre_beds'       => 'string',
			'_lre_baths'      => 'string',
			'_lre_sqft'       => 'string',
			'_lre_badge'      => 'string',
			'_lre_city'       => 'string',
		);

		foreach ( $fields as $key => $type ) {
			register_post_meta(
				'lre_sold_property',
				$key,
				array(
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => $type,
					'auth_callback' => function() {
						return current_user_can( 'edit_posts' );
					},
				)
			);
		}
	}

	/**
	 * Register meta boxes for Sold Properties.
	 */
	public function register_meta_boxes() {
		add_meta_box(
			'lre_sold_property_details',
			__( 'Sold Property Dossier Details', 'luxury-re-widgets' ),
			array( $this, 'render_meta_box' ),
			'lre_sold_property',
			'normal',
			'high'
		);
	}

	/**
	 * Render the Meta Box UI in post editor.
	 *
	 * @param \WP_Post $post Current post object.
	 */
	public function render_meta_box( $post ) {
		wp_nonce_field( 'lre_save_sold_property_meta', 'lre_sold_property_nonce' );

		$price = get_post_meta( $post->ID, '_lre_sold_price', true );
		$beds  = get_post_meta( $post->ID, '_lre_beds', true );
		$baths = get_post_meta( $post->ID, '_lre_baths', true );
		$sqft  = get_post_meta( $post->ID, '_lre_sqft', true );
		$badge = get_post_meta( $post->ID, '_lre_badge', true );
		$city  = get_post_meta( $post->ID, '_lre_city', true );
		?>
		<style>
			.lre-meta-grid {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
				gap: 18px 24px;
				padding: 14px 4px 10px;
			}
			.lre-meta-field {
				display: flex;
				flex-direction: column;
				gap: 6px;
			}
			.lre-meta-field label {
				font-weight: 600;
				font-size: 13px;
				color: #1d2327;
				display: flex;
				align-items: center;
				gap: 4px;
			}
			.lre-meta-field label span.req {
				color: #C5A059;
			}
			.lre-meta-field input[type="text"] {
				width: 100%;
				padding: 8px 12px;
				font-size: 14px;
				line-height: 1.4;
				border-radius: 4px;
				border: 1px solid #8c8f94;
				background: #fff;
				box-sizing: border-box;
				transition: border-color 0.2s, box-shadow 0.2s;
			}
			.lre-meta-field input[type="text"]:focus {
				border-color: #001A72;
				box-shadow: 0 0 0 1px #001A72;
				outline: 2px solid transparent;
			}
			.lre-meta-field .desc {
				font-size: 11.5px;
				color: #646970;
				margin: 2px 0 0;
				line-height: 1.4;
			}
		</style>
		<div class="lre-meta-grid">
			<div class="lre-meta-field">
				<label for="lre_sold_price"><?php esc_html_e( 'Sold Price', 'luxury-re-widgets' ); ?> <span class="req">*</span></label>
				<input type="text" id="lre_sold_price" name="lre_sold_price" value="<?php echo esc_attr( $price ); ?>" placeholder="<?php esc_attr_e( '$3,800,000 or Confidential', 'luxury-re-widgets' ); ?>" />
				<p class="desc"><?php esc_html_e( 'Closed transaction price or "Confidential" / "Price Upon Request".', 'luxury-re-widgets' ); ?></p>
			</div>

			<div class="lre-meta-field">
				<label for="lre_badge"><?php esc_html_e( 'Achievement / Milestone Badge', 'luxury-re-widgets' ); ?></label>
				<input type="text" id="lre_badge" name="lre_badge" value="<?php echo esc_attr( $badge ); ?>" placeholder="<?php esc_attr_e( 'SOLD • OVER ASKING or SOLD • ALL-CASH', 'luxury-re-widgets' ); ?>" />
				<p class="desc"><?php esc_html_e( 'Headline tag displayed on cards, e.g. SOLD • ARCHITECTURAL RESTORATION.', 'luxury-re-widgets' ); ?></p>
			</div>

			<div class="lre-meta-field">
				<label for="lre_beds"><?php esc_html_e( 'Bedrooms (Beds)', 'luxury-re-widgets' ); ?></label>
				<input type="text" id="lre_beds" name="lre_beds" value="<?php echo esc_attr( $beds ); ?>" placeholder="4" />
				<p class="desc"><?php esc_html_e( 'Total number of bedrooms (e.g. 3, 4, 5).', 'luxury-re-widgets' ); ?></p>
			</div>

			<div class="lre-meta-field">
				<label for="lre_baths"><?php esc_html_e( 'Bathrooms (Baths)', 'luxury-re-widgets' ); ?></label>
				<input type="text" id="lre_baths" name="lre_baths" value="<?php echo esc_attr( $baths ); ?>" placeholder="3.5" />
				<p class="desc"><?php esc_html_e( 'Total number of bathrooms (supports half baths e.g. 2.5, 3.5).', 'luxury-re-widgets' ); ?></p>
			</div>

			<div class="lre-meta-field">
				<label for="lre_sqft"><?php esc_html_e( 'Living Area (Sq Ft)', 'luxury-re-widgets' ); ?></label>
				<input type="text" id="lre_sqft" name="lre_sqft" value="<?php echo esc_attr( $sqft ); ?>" placeholder="4,497" />
				<p class="desc"><?php esc_html_e( 'Interior square footage (e.g. 4,497 or 1,997).', 'luxury-re-widgets' ); ?></p>
			</div>

			<div class="lre-meta-field">
				<label for="lre_city"><?php esc_html_e( 'City / Locality', 'luxury-re-widgets' ); ?></label>
				<input type="text" id="lre_city" name="lre_city" value="<?php echo esc_attr( $city ); ?>" placeholder="<?php esc_attr_e( 'Pasadena, CA or Los Angeles', 'luxury-re-widgets' ); ?>" />
				<p class="desc"><?php esc_html_e( 'City or locality name used in property subtitles and dossiers.', 'luxury-re-widgets' ); ?></p>
			</div>
		</div>
		<?php
	}

	/**
	 * Save Meta Box data.
	 *
	 * @param int $post_id Post ID.
	 */
	public function save_meta_box( $post_id ) {
		if ( ! isset( $_POST['lre_sold_property_nonce'] ) || ! wp_verify_nonce( $_POST['lre_sold_property_nonce'], 'lre_save_sold_property_meta' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$fields = array(
			'_lre_sold_price' => 'sanitize_text_field',
			'_lre_beds'       => 'sanitize_text_field',
			'_lre_baths'      => 'sanitize_text_field',
			'_lre_sqft'       => 'sanitize_text_field',
			'_lre_badge'      => 'sanitize_text_field',
			'_lre_city'       => 'sanitize_text_field',
		);

		foreach ( $fields as $meta_key => $sanitizer ) {
			$form_key = ltrim( $meta_key, '_' );
			if ( isset( $_POST[ $form_key ] ) ) {
				$val = call_user_func( $sanitizer, wp_unslash( $_POST[ $form_key ] ) );
				update_post_meta( $post_id, $meta_key, $val );
			}
		}
	}

	/**
	 * Render Quick Edit custom fields in admin list.
	 *
	 * @param string $column_name Column name.
	 * @param string $post_type   Post type.
	 */
	public function render_quick_edit_fields( $column_name, $post_type ) {
		if ( 'lre_sold_property' !== $post_type ) {
			return;
		}

		if ( 'prop_price' === $column_name ) {
			wp_nonce_field( 'lre_save_sold_property_meta', 'lre_sold_property_nonce' );
			?>
			<fieldset class="inline-edit-col-right inline-edit-lre" style="margin-top:8px;">
				<div class="inline-edit-col">
					<h4 style="margin:6px 0 10px;font-weight:600;color:#001A72;text-transform:uppercase;font-size:12px;letter-spacing:0.05em;"><?php esc_html_e( 'Sold Property Details', 'luxury-re-widgets' ); ?></h4>
					
					<label style="margin-bottom:8px;display:flex;align-items:center;">
						<span class="title" style="min-width:90px;font-weight:600;"><?php esc_html_e( 'Sold Price', 'luxury-re-widgets' ); ?></span>
						<span class="input-text-wrap" style="flex:1;"><input type="text" name="lre_sold_price" class="lre-qe-price" value="" placeholder="$1,450,000 or Confidential" /></span>
					</label>
					
					<label style="margin-bottom:8px;display:flex;align-items:center;">
						<span class="title" style="min-width:90px;font-weight:600;"><?php esc_html_e( 'Badge', 'luxury-re-widgets' ); ?></span>
						<span class="input-text-wrap" style="flex:1;"><input type="text" name="lre_badge" class="lre-qe-badge" value="" placeholder="SOLD • OVER ASKING" /></span>
					</label>

					<div style="display:flex;gap:12px;margin-bottom:8px;">
						<label style="display:flex;align-items:center;">
							<span class="title" style="min-width:50px;font-weight:600;"><?php esc_html_e( 'Beds', 'luxury-re-widgets' ); ?></span>
							<span class="input-text-wrap"><input type="text" name="lre_beds" class="lre-qe-beds" value="" placeholder="3" style="width:60px;" /></span>
						</label>

						<label style="display:flex;align-items:center;">
							<span class="title" style="min-width:50px;font-weight:600;"><?php esc_html_e( 'Baths', 'luxury-re-widgets' ); ?></span>
							<span class="input-text-wrap"><input type="text" name="lre_baths" class="lre-qe-baths" value="" placeholder="2" style="width:60px;" /></span>
						</label>

						<label style="display:flex;align-items:center;">
							<span class="title" style="min-width:50px;font-weight:600;"><?php esc_html_e( 'Sq Ft', 'luxury-re-widgets' ); ?></span>
							<span class="input-text-wrap"><input type="text" name="lre_sqft" class="lre-qe-sqft" value="" placeholder="1,997" style="width:90px;" /></span>
						</label>
					</div>

					<label style="margin-bottom:8px;display:flex;align-items:center;">
						<span class="title" style="min-width:90px;font-weight:600;"><?php esc_html_e( 'City', 'luxury-re-widgets' ); ?></span>
						<span class="input-text-wrap" style="flex:1;"><input type="text" name="lre_city" class="lre-qe-city" value="" placeholder="Pasadena" /></span>
					</label>
				</div>
			</fieldset>
			<?php
		}
	}

	/**
	 * Enqueue admin scripts for Quick Edit on lre_sold_property post type list screen.
	 *
	 * @param string $hook Admin page hook.
	 */
	public function enqueue_admin_scripts( $hook ) {
		global $post_type;
		if ( 'edit.php' === $hook && 'lre_sold_property' === $post_type ) {
			add_action(
				'admin_footer',
				function() {
					?>
					<script>
					jQuery(function($) {
						if (typeof inlineEditPost !== 'undefined') {
							var $wp_inline_edit = inlineEditPost.edit;
							inlineEditPost.edit = function(id) {
								$wp_inline_edit.apply(this, arguments);
								var postId = 0;
								if (typeof(id) == 'object') {
									postId = parseInt(this.getId(id));
								}
								if (postId > 0) {
									var $row = $('#post-' + postId);
									var $editRow = $('#edit-' + postId);
									var price = $row.find('.prop_price_val').text().trim();
									var badge = $row.find('.prop_badge_val').text().trim();
									var beds  = $row.find('.prop_beds_val').text().trim();
									var baths = $row.find('.prop_baths_val').text().trim();
									var sqft  = $row.find('.prop_sqft_val').text().trim();
									var city  = $row.find('.prop_city_val').text().trim();

									$editRow.find('.lre-qe-price').val(price);
									$editRow.find('.lre-qe-badge').val(badge);
									$editRow.find('.lre-qe-beds').val(beds);
									$editRow.find('.lre-qe-baths').val(baths);
									$editRow.find('.lre-qe-sqft').val(sqft);
									$editRow.find('.lre-qe-city').val(city);
								}
							};
						}
					});
					</script>
					<?php
				}
			);
		}
	}
}
