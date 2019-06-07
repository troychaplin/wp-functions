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

// if ( is_admin() ) {
// 	require_once get_template_directory() . '/shared/functions/admin/functions.php';
// 	require_once get_template_directory() . '/functions/admin/functions.php';

// 	// ACF specific common functions
// 	if ( function_exists( 'get_field' ) ) {
// 		require_once get_template_directory() . '/shared/functions/wp-plugins/acf/admin.php';
// 		require_once get_template_directory() . '/functions/wp-plugins/acf/admin.php';
// 	}

// 	// Gravityfoms specific common functions
// 	if ( class_exists( 'GFCommon' ) ) {
// 		require_once get_template_directory() . '/shared/functions/wp-plugins/gravityforms/admin.php';
// 	}

// 	// WordPress SEO specific common functions
// 	if ( defined( 'WPSEO_VERSION' ) ) {
// 		require_once get_template_directory() . '/shared/functions/wp-plugins/wordpress-seo/admin.php';
// 	}
// }

/**
 * Include frontend only functions
 * =============
 *
 * @since Theme Includes
 * @package Includes
 * @version 1.0
 */

// if ( ! is_admin() ) {
// 	require_once get_template_directory() . '/shared/functions/public/functions.php';
// 	require_once get_template_directory() . '/functions/public/functions.php';

// 	// ACF specific common functions
// 	if ( function_exists( 'get_field' ) ) {
// 		require_once get_template_directory() . '/shared/functions/wp-plugins/acf/public.php';
// 		require_once get_template_directory() . '/functions/wp-plugins/acf/public.php';
// 	}

// 	// Gravityfoms specific common functions
// 	if ( class_exists( 'GFCommon' ) ) {
// 		require_once get_template_directory() . '/shared/functions/wp-plugins/gravityforms/public.php';
// 	}

// 	// WordPress SEO specific common functions
// 	if ( defined( 'WPSEO_VERSION' ) ) {
// 		require_once get_template_directory() . '/shared/functions/wp-plugins/wordpress-seo/public.php';
// 	}
// }

/**
 * Include common functions
 * =============
 *
 * @since Theme Includes
 * @package Includes
 * @version 1.0
 */

require_once get_template_directory() . '/shared/functions/global/functions.php';
require_once get_template_directory() . '/functions/global/functions.php';

// // ACF specific common functions
// if ( function_exists( 'get_field' ) ) {
// 	require_once get_template_directory() . '/shared/functions/wp-plugins/acf/global.php';
// 	require_once get_template_directory() . '/functions/wp-plugins/acf/global.php';
// }

// // Gravityfoms specific common functions
// if ( class_exists( 'GFCommon' ) ) {
// 	require_once get_template_directory() . '/shared/functions/wp-plugins/gravityforms/global.php';
// }

// // WordPress SEO specific common functions
// if ( defined( 'WPSEO_VERSION' ) ) {
// 	require_once get_template_directory() . '/shared/functions/wp-plugins/wordpress-seo/global.php';
// }
