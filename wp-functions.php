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

	// ACF specific common functions
	if ( function_exists( 'get_field' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/acf/admin.php';
	}

	// Gravityfoms specific common functions
	if ( class_exists( 'GFCommon' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/gravityforms/admin.php';
	}

	// WordPress SEO specific common functions
	if ( defined( 'WPSEO_VERSION' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/wordpress-seo/admin.php';
	}
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

	// ACF specific common functions
	if ( function_exists( 'get_field' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/acf/public.php';
	}

	// Gravityfoms specific common functions
	if ( class_exists( 'GFCommon' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/gravityforms/public.php';
	}

	// WordPress SEO specific common functions
	if ( defined( 'WPSEO_VERSION' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/wordpress-seo/public.php';
	}
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

// ACF specific common functions
if ( function_exists( 'get_field' ) ) {
	require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/acf/global.php';
}

// Gravityfoms specific common functions
if ( class_exists( 'GFCommon' ) ) {
	require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/gravityforms/global.php';
}

// WordPress SEO specific common functions
if ( defined( 'WPSEO_VERSION' ) ) {
	require_once plugin_dir_path( __FILE__ ) . '/wp-plugins/wordpress-seo/global.php';
}
