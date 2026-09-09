<?php
/**
 * Plugin Name:       Luxury Real Estate Widgets
 * Plugin URI:        https://digitizegrowth.com/
 * Description:       16 handcrafted, editorial-grade Elementor section widgets for building high-end luxury real estate websites block by block. By Digitize Growth.
 * Version:           1.5.0
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
define( 'LRE_VERSION',     '1.5.0' );
define( 'LRE_PATH',          plugin_dir_path( __FILE__ ) );
define( 'LRE_URL',           plugin_dir_url( __FILE__ ) );
define( 'LRE_ASSETS_URL',    LRE_URL  . 'assets/' );
define( 'LRE_ASSETS_PATH',   LRE_PATH . 'assets/' );
define( 'LRE_AUTHOR_URL',    'https://digitizegrowth.com/' );
define( 'LRE_AUTHOR_NAME',   'Digitize Growth' );
define( 'LRE_MIN_ELEMENTOR', '3.0.0' );
define( 'LRE_MIN_PHP',       '7.4' );

// -- Helper Functions --
if ( ! function_exists( 'lre_asset_url' ) ) {
	/**
	 * Returns full URL to a file in the plugin's assets/ directory.
	 *
	 * @param string $path Relative path within assets/ (e.g. 'images/property-1.jpg')
	 * @return string
	 */
	function lre_asset_url( $path = '' ) {
		return LRE_ASSETS_URL . ltrim( $path, '/' );
	}
}

if ( ! function_exists( 'lre_resolve_image_url' ) ) {
	/**
	 * Resolves image URL, automatically converting remote Unsplash / external URLs
	 * to bundled local asset files, with optional fallback.
	 *
	 * @param string $url Source image URL (or setting)
	 * @param string $fallback Fallback URL or relative path if empty
	 * @return string
	 */
	function lre_resolve_image_url( $url, $fallback = '' ) {
		if ( empty( $url ) ) {
			if ( empty( $fallback ) ) {
				return '';
			}
			return false !== strpos( $fallback, '://' ) ? $fallback : lre_asset_url( $fallback );
		}

		$map = array(
			'photo-1600585154340-be6161a56a0c'     => 'images/property-1.jpg',
			'photo-1600596542815-ffad4c1539a9'     => 'images/property-2.jpg',
			'photo-1600607687939-ce8a6c25118c'     => 'images/property-3.jpg',
			'photo-1512917774080-9991f1c4c750'     => 'images/property-4.jpg',
			'photo-1600566753086-00f18fb6b3ea'     => 'images/property-5.jpg',
			'photo-1600573472592-401b489a3cdc'     => 'images/property-6.jpg',
			'photo-1600047509807-ba8f99d2cdde'     => 'images/property-7.jpg',
			'photo-1600566753190-17f0baa2a6c3'     => 'images/property-8.jpg',
			'photo-1600585154526-990dced4db0d'     => 'images/property-9.jpg',
			'photo-1560250097-0b93528c311a'        => 'images/team-1.jpg',
			'photo-1573496359142-b8d87734a5a2'     => 'images/team-2.jpg',
			'photo-1580489944761-15a19d654956'     => 'images/team-3.jpg',
			'photo-1519085360753-af0119f7cbe7'     => 'images/team-4.jpg',
			'photo-1534528741775-53994a69daeb'     => 'images/avatar-1.jpg',
			'photo-1507003211169-0a1dd7228f2d'     => 'images/avatar-2.jpg',
			'photo-1500648767791-00dcc994a43e'     => 'images/avatar-3.jpg',
			'effectiveagents.com/api/awards/badge' => 'images/effectiveagents-badge.svg',
		);

		foreach ( $map as $key => $rel_path ) {
			if ( false !== strpos( $url, $key ) ) {
				return lre_asset_url( $rel_path );
			}
		}

		return $url;
	}
}

// -- Boot via Singleton --
require_once LRE_PATH . 'includes/class-lre-plugin.php';
LRE_Plugin::instance();