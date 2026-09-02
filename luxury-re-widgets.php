<?php
/**
 * Plugin Name:       Luxury Real Estate Widgets
 * Plugin URI:        https://digitizegrowth.com/
 * Description:       10 handcrafted, editorial-grade Elementor section widgets for building high-end luxury real estate websites block by block. By Digitize Growth.
 * Version:           1.1.7
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Elementor tested up to: 3.25
 * Elementor Pro tested up to: 3.25
 * Author:            Digitize Growth
 * Author URI:        https://digitizegrowth.com/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       luxury-re-widgets
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct file access.
}

// -- Plugin Constants --
define( 'LRE_VERSION',     '1.1.7' );
define( 'LRE_PATH',          plugin_dir_path( __FILE__ ) );
define( 'LRE_URL',           plugin_dir_url( __FILE__ ) );
define( 'LRE_ASSETS_URL',    LRE_URL  . 'assets/' );
define( 'LRE_ASSETS_PATH',   LRE_PATH . 'assets/' );
define( 'LRE_AUTHOR_URL',    'https://digitizegrowth.com/' );
define( 'LRE_AUTHOR_NAME',   'Digitize Growth' );
define( 'LRE_MIN_ELEMENTOR', '3.0.0' );
define( 'LRE_MIN_PHP',       '7.4' );

// -- Boot via Singleton --
require_once LRE_PATH . 'includes/class-lre-plugin.php';
LRE_Plugin::instance();