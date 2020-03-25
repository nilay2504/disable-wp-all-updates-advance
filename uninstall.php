<?php
/**
 * Fired when the plugin is uninstalled.
 * @link              http://nilaypatel.info
 * @since             1.0.0
 * @package           Disable_wp_all_updatess_Advance
 *
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option('DWAUA_activated_on');
delete_option('DWAUA_deactivated_on');
