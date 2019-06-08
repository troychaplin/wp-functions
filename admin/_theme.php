<?php
/**
 * Add Editor Stylesheet
 * =============

 * @package Admin Supports
 * @category Enqueues
 * @version 1.0
 */

add_theme_support( 'editor-styles' );
add_editor_style( 'dist/admin/editor.css' );


/**
 * Set Timezone
 * =============

 * @package Admin Supports
 * @category Update Options
 * @version 1.0
 */

$wp_timezone = get_option( 'timezone_string' );

if ( 'America/Toronto' !== $wp_timezone ) {
	update_option( 'timezone_string', 'America/Toronto' );
}


/**
 * Add Constants for License Keys
 * =============

 * @package Admin Supports
 * @category Licenses and APIs
 * @version 1.0
 */

define( 'ACF_PRO_KEY', 'AddACFProKeyHere' );
define( 'GF_LICENSE_KEY', 'AddGravityFormsKeyHere' );


/**
 * Register ACF Pro License Key
 * =============

 * @package Admin Supports
 * @category Licenses and APIs
 * @version 1.0
 */

function acf_license_key() {
	if ( function_exists( 'acf' ) && ! acf_pro_get_license_key() && defined( 'ACF_PRO_KEY' ) ) {
		acf_pro_update_license( ACF_PRO_KEY );
	}
}
add_action( 'admin_init', 'acf_license_key' );
