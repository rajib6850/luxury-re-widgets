<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_Widgets_Loader
 *
 * Registers the "Luxury Real Estate Widgets" Elementor widget category
 * and loads every section widget shipped with the plugin.
 * Add new widgets by inserting one line into $widget_files.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Widgets_Loader {

	/** Widget file => class name map. Easily scalable: just add a new entry. */
	private static $widget_files = array(
		'class-lre-header-widget.php'         => 'LRE_Header_Widget',
		'class-lre-concierge-widget.php'      => 'LRE_Concierge_Widget',
		'class-lre-hero-widget.php'           => 'LRE_Hero_Widget',
		'class-lre-about-widget.php'          => 'LRE_About_Widget',
		'class-lre-services-widget.php'       => 'LRE_Services_Widget',
		'class-lre-properties-widget.php'     => 'LRE_Properties_Widget',
		'class-lre-testimonials-widget.php'   => 'LRE_Testimonials_Widget',
		'class-lre-communities-widget.php'    => 'LRE_Communities_Widget',
		'class-lre-cta-widget.php'            => 'LRE_CTA_Widget',
		'class-lre-footer-widget.php'         => 'LRE_Footer_Widget',
		// About Page Suite
		'class-lre-story-widget.php'          => 'LRE_Story_Widget',
		'class-lre-team-widget.php'           => 'LRE_Team_Widget',
		'class-lre-about-services-widget.php' => 'LRE_About_Services_Widget',
		'class-lre-reviews-widget.php'        => 'LRE_Reviews_Widget',
		// Communities Page Suite
		'class-lre-communities-showcase-widget.php' => 'LRE_Communities_Showcase_Widget',
		// Contact Page Suite
		'class-lre-contact-widget.php'              => 'LRE_Contact_Widget',
		// Buying Guide Page Suite
		'class-lre-buying-guide-widget.php'         => 'LRE_Buying_Guide_Widget',
		// Seller's Guide Page Suite
		'class-lre-sellers-guide-widget.php'        => 'LRE_Sellers_Guide_Widget',
		// Universal
		'class-lre-page-hero-widget.php'      => 'LRE_Page_Hero_Widget',
	);

	/** Constructor — hooks into Elementor. */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );

		if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.5.0', '>=' ) ) {
			add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		} else {
			// Legacy hook support for Elementor < 3.5.
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets_legacy' ) );
		}
	}

	/**
	 * Registers the "Luxury Real Estate Widgets" panel category.
	 *
	 * @param \Elementor\Elements_Manager $manager
	 */
	public function register_category( $manager ) {
		$manager->add_category(
			'luxury-re-widgets',
			array(
				'title' => __( 'Luxury Real Estate Widgets', 'luxury-re-widgets' ),
				'icon'  => 'eicon-inner-container',
			)
		);
	}

	/**
	 * Requires each widget file and registers its class with Elementor (3.5+).
	 *
	 * @param \Elementor\Widgets_Manager $manager
	 */
	public function register_widgets( $manager ) {
		foreach ( self::$widget_files as $file => $class_name ) {
			$path = LRE_PATH . 'widgets/' . $file;

			if ( ! file_exists( $path ) ) {
				continue;
			}

			require_once $path;

			if ( class_exists( $class_name ) ) {
				$manager->register( new $class_name() );
			}
		}
	}

	/**
	 * Requires each widget file and registers its class with legacy Elementor (< 3.5).
	 *
	 * @param \Elementor\Widgets_Manager $manager
	 */
	public function register_widgets_legacy( $manager ) {
		foreach ( self::$widget_files as $file => $class_name ) {
			$path = LRE_PATH . 'widgets/' . $file;

			if ( ! file_exists( $path ) ) {
				continue;
			}

			require_once $path;

			if ( class_exists( $class_name ) ) {
				$manager->register_widget_type( new $class_name() );
			}
		}
	}
}
