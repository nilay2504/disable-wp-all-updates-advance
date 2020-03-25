<?php
/**
 * @link              http://nilaypatel.info
 * @since             1.0.0
 * @package           Disable_wp_all_updatess_Advance
 *
 * @wordpress-plugin
 * Plugin Name:       Disable WP All Updates Advance
 * Plugin URI:        http://nilaypatel.info
 * Description:       This plugin disable your all WordPress updates on activation that includes core, themes, plugins
 * Version:           1.0.0
 * Author:            Nilay Patel
 * Author URI:        http://nilaypatel.info
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       disable-wp-all-updates-advance
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
register_activation_hook( __FILE__, 'activate_disable_wp_all_advance' );

function activate_disable_wp_all_advance() {
		update_option('DWAUA_activated_on',@date('d-m-Y h:i:s'));
}

/* This code execute once all plugin loaded */
add_action( 'plugins_loaded', 'disable_wp_all_updates_loaded' );

function disable_wp_all_updates_loaded() {
	
	/* Only works for wordpress 3.0+ */
	/* Disable Wordpress Core Update */
	add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
	add_filter('pre_option_update_core','__return_null');
	add_filter('pre_site_transient_update_core','__return_null');
	
	/* Disable Wordpress Plugin Updates */
	remove_action('load-update-core.php','wp_update_plugins');
	add_filter('pre_site_transient_update_plugins','__return_null');

	/* Disable Wordpress Theme Updates */
	remove_action( 'load-update-core.php', 'wp_update_themes' );
	add_filter( 'pre_site_transient_update_themes', '__return_null' );


}

/**
 * The code that runs during plugin deactivation.
 */
register_deactivation_hook( __FILE__, 'deactivate_disable_wp_all_advance' );

function deactivate_disable_wp_all_advance() {
	update_option('DWAUA_deactivated_on',@date('d-m-Y h:i:s'));
}


