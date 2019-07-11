<?php
/*
	Plugin Name: WP Functions
	Plugin URI: http://troychaplin.ca
	Description: Adds admin, global, public and plugin specific functions
	Version: 1.0
	Author: Troy Chaplin
	Author URI: http://troychaplin.ca
	License: GPL2
*/

/**
 * Include backend only functions
 * =============
 *
 * @since Theme Includes
 * @package Includes
 * @version 1.0
 */

if ( is_admin() ) {
	require_once plugin_dir_path( __FILE__ ) . '/admin/admin.php';
}

/**
 * Include frontend only functions
 * =============
 *
 * @since Theme Includes
 * @package Includes
 * @version 1.0
 */

if ( ! is_admin() ) {
	require_once plugin_dir_path( __FILE__ ) . '/public/public.php';
}

/**
 * Include common functions
 * =============
 *
 * @since Theme Includes
 * @package Includes
 * @version 1.0
 */

require_once plugin_dir_path( __FILE__ ) . '/global/global.php';
