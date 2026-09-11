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

		// Admin column customizations
		if ( is_admin() ) {
			add_filter( 'manage_lre_sold_property_posts_columns', array( $this, 'register_admin_columns' ) );
			add_action( 'manage_lre_sold_property_posts_custom_column', array( $this, 'render_admin_columns' ), 10, 2 );
			add_filter( 'manage_edit-lre_sold_property_sortable_columns', array( $this, 'sortable_admin_columns' ) );
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
				break;

			case 'prop_badge':
				$badge = get_post_meta( $post_id, '_lre_badge', true );
				if ( $badge ) {
					echo '<span style="background:#f4f4f4;padding:3px 8px;border-radius:3px;font-size:11px;font-weight:600;color:#333;border-left:3px solid #C5A059;">' . esc_html( $badge ) . '</span>';
				} else {
					echo '—';
				}
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
}
