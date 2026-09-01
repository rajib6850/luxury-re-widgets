<?php
/**
 * Uninstall handler for Luxury Real Estate Widgets.
 * Called automatically by WordPress when the plugin is deleted via the admin UI.
 *
 * @package Luxury_RE_Widgets
 */

// Security: only run when WordPress triggers uninstall.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove any plugin options stored in wp_options (add keys here as the plugin grows).
$options_to_delete = array(
	'lre_widgets_version',
	'lre_widgets_settings',
);

foreach ( $options_to_delete as $option ) {
	delete_option( $option );
}
