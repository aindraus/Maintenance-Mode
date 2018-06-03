<?php
/*
*   Plugin Name: Maintenance Mode
*   Plugin URI: http://www.anthonyindraus.com
*   Author: Anthony Indraus
*   Author URI: http://www.anthonyindraus.com
*   Description: A plugin to put website in maintenance mode.
*   Version: 1.0.0
*/
define('__ROOT__', plugin_dir_url(__FILE__)); 
// Add Options Page Stylesheet
function ced_maintenance_style() {
    wp_enqueue_style('ced_maintenance', plugin_dir_url(__FILE__) . 'admin/assets/css/options.css', null);
}
add_action('admin_init', 'ced_maintenance_style');
// Only Allow Administrator to access website
$visitor_pass = get_option('ced_m_password');
// Starting Cookie Session
session_start();
$user_pass = $_SESSION['website_password'];
function ced_maintenance_mode() {
	global $pagenow;
	if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin()  ) {
		header( $_SERVER["SERVER_PROTOCOL"] . ' 503 Service Temporarily Unavailable', true, 503 );
		header( 'Content-Type: text/html; charset=utf-8' );
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'templates/maintenance_mode.php' ) ) {
			require_once( plugin_dir_path( __FILE__ ) . 'templates/maintenance_mode.php' );
		}
		die();
	}
}
// If Maintenance Mode Enabled
$ced_m_activated = get_option('ced_m_activated');
if($ced_m_activated) {
    if(empty($user_pass) || $user_pass !== $visitor_pass) {
        add_action( 'wp_loaded', 'ced_maintenance_mode' );
    }
}
// Include Settings Page
require_once(__ROOT__ . 'core/settings.php');