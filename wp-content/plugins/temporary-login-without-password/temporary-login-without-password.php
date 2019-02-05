<?php
/**
 * Plugin Name:       Temporary Login Without Password
 * Plugin URI:        http://www.storeapps.org/create-secure-login-without-password-for-wordpress/
 * Description:       Create a temporary login link with any role using which one can access to your sytem without username and password for limited period of time.
 * Version:           1.5.14
 * Author:            StoreApps
 * Author URI:        https://storeapps.org
 * Requires at least: 3.0.1
 * Tested up to:      5.0.3
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       temporary-login-without-password
 * Domain Path:       /languages/
 * Copyright (c)      2016-2018 StoreApps, All right reserved
 *
 * @package Temporary Login Without Password
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define constants
 */
define( 'WTLWP_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'WTLWP_PLUGIN_VERSION', '1.5.14' );
define( 'WTLWP_PLUGIN_BASE_NAME', plugin_basename( __FILE__ ) );

/**
 * Deactivate Temporary Login Without Password
 *
 * @since 1.0
 */
function wp_deactivate_temporary_login_without_password() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-temporary-login-without-password-deactivator.php';
	Wp_Temporary_Login_Without_Password_Deactivator::deactivate();
}

/**
 * Activate Temporary Login Without Password
 *
 * @since 1.0
 */
function wp_activate_temporary_login_without_password() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-temporary-login-without-password-activator.php';
	Wp_Temporary_Login_Without_Password_Activator::activate();
}

register_deactivation_hook( __FILE__, 'wp_deactivate_temporary_login_without_password' );
register_activation_hook( __FILE__, 'wp_activate_temporary_login_without_password' );


// Include main class file.
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-temporary-login-without-password.php';

/**
 * Initialize
 *
 * @since 1.0
 */
function run_wp_temporary_login_without_password() {
	$plugin = new Wp_Temporary_Login_Without_Password();
	$plugin->run();
}

run_wp_temporary_login_without_password();
