<?php
/**
 * Stop attachments from automatically linking to themselves
 * =============

 * @package Admin Supports
 * @category Update Options
 * @version 1.0
 */

function wpbase_remove_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );

	if ( 'none' !== $image_set ) {
		update_option( 'image_default_link_type', 'none' );
	}
}
add_action( 'admin_init', 'wpbase_remove_imagelink_setup', 10 );


/**
 * Allow editor access to wp_nav_menu
 * =============

 * @package Admin Supports
 * @category Roles & Capabilities
 * @version 1.0
 */

$role_object = get_role( 'editor' );

if ( ! $role_object->has_cap( 'edit_theme_options' ) ) {
	$role_object->add_cap( 'edit_theme_options' );
}

function wpbase_editor_nav_menu() {
	global $submenu;

	if ( ! current_user_can( 'manage_options' ) ) {
		unset( $submenu['themes.php'][5] ); // Customize
	}

	unset( $submenu['themes.php'][6] ); // Customize
}
add_action( 'admin_head', 'wpbase_editor_nav_menu' );


/**
 * Remove default WordPress update notices
 * =============

 * @package Admin Supports
 * @category Clean-Up
 * @version 1.0
 * @author troychaplin
 */

function wpbase_remove_update_transients() {
	global $wp_version;
	return (object) array(
		'last_checked'    => time(),
		'version_checked' => $wp_version,
	);
}

if ( ! current_user_can( 'manage_options' ) ) {
	add_filter( 'pre_site_transient_update_core', 'wpbase_remove_update_transients' );
	add_filter( 'pre_site_transient_update_plugins', 'wpbase_remove_update_transients' );
	add_filter( 'pre_site_transient_update_themes', 'wpbase_remove_update_transients' );
}

function wpbase_remove_update_nags() {
	remove_action( 'admin_notices', 'update_nag', 3 );
	remove_action( 'network_admin_notices', 'update_nag', 3 ); //update notice at the top of the screen
	remove_filter( 'update_footer', 'core_update_footer' ); //update notice in the footer
}

if ( ! current_user_can( 'manage_options' ) ) {
	add_action( 'admin_menu', 'wpbase_remove_update_nags' );
}


/**
 * Remove pointers from the admin panel
 * =============

 * @package Admin Supports
 * @category Clean-Up
 * @version 1.0
 */

function wpbase_remove_pointer_script( $wp_scripts ) {
	$wp_scripts->remove( 'wp-pointer' );
}
add_action( 'wp_default_scripts', 'wpbase_remove_pointer_script' );

function wpbase_remove_pointer_style( $wp_styles ) {
	$wp_styles->remove( 'wp-pointer' );
}
add_action( 'wp_default_styles', 'wpbase_remove_pointer_style' );


/**
 * Remove help tab
 * =============

 * @package Admin Supports
 * @category Clean-Up
 * @version 1.0
 */

function wpbase_remove_dashboard_help_tab( $old_help, $screen_id, $screen ) {
	$screen->remove_help_tabs();
	return $old_help;
}
add_filter( 'contextual_help', 'wpbase_remove_dashboard_help_tab', 999, 3 );


/**
 * Remove screen options from dashboard
 * =============

 * @package Admin Supports
 * @category Clean-Up
 * @version 1.0
 */

function wpbase_remove_dashboard_options_tab( $visible ) {
	global $current_screen;

	if ( 'dashboard' === $current_screen->base ) {
		return false;
	}

	return $visible;
}
add_filter( 'screen_options_show_screen', 'wpbase_remove_dashboard_options_tab' );


/**
 * Remove trackbacks from pages and posts
 * =============

 * @package Admin Supports
 * @category Clean-Up
 * @version 1.0
 */

function wpbase_remove_meta_boxes() {
	remove_meta_box( 'trackbacksdiv', 'post', 'normal' ); // remove trackbacks module
	remove_meta_box( 'trackbacksdiv', 'page', 'normal' ); // remove trackbacks module
}
add_action( 'admin_init', 'wpbase_remove_meta_boxes' );


/**
 * Remove unwanted menu items from the admin panel
 * =============

 * @package Admin Supports
 * @category Clean-Up
 * @version 1.0
 */

function wpbase_remove_menu_items() {
	if ( ! current_user_can( 'administrator' ) ) {
		remove_menu_page( 'tools.php' );
	}

	remove_submenu_page( 'themes.php', 'customize.php?return=%2Fapp%2Fwp-admin%2Fthemes.php' );
}
add_action( 'admin_menu', 'wpbase_remove_menu_items', 9999 );


/**
 * Prevent iframe stripping within TinyMCE
 * =============

 * @package Admin Supports
 * @category TinyMCE Config
 * @version 1.0
 */
function wpbase_tinymce_stop_stripping_iframe( $a ) {
	$a['extended_valid_elements'] = 'iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]';

	return $a;
}
add_filter( 'tiny_mce_before_init', 'wpbase_tinymce_stop_stripping_iframe' );


/**
 * Default TinyMCE settings
 * =============

 * @package Shared Libraries
 * @category TinyMCE Config
 * @version 1.0
 */
function wpbase_tinymce_customize_wysiwyg( $in ) {
	$style_formats = array(
		array(
			'title' => 'Text',
			'items' => array(
				array(
					'title'  => 'Paragraph',
					'format' => 'p',
				),
				array(
					'title'  => 'Header 2',
					'format' => 'h2',
				),
				array(
					'title'  => 'Header 3',
					'format' => 'h3',
				),
				array(
					'title'  => 'Header 4',
					'format' => 'h4',
				),
				array(
					'title'  => 'Header 5',
					'format' => 'h5',
				),
				array(
					'title'  => 'Header 6',
					'format' => 'h6',
				),
			),
		),
	);

	$in['wordpress_adv_hidden'] = false;
	$in['menubar']              = false;
	$in['style_formats']        = wp_json_encode( $style_formats );
	$in['style_formats_merge']  = false;
	$in['block_formats']        = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4';
	$in['toolbar1']             = 'formatselect,|,styleselect,|,bold,italic,underline,|,bullist,numlist,outdent,indent,alignleft,aligncenter,alignright';
	$in['toolbar2']             = 'pastetext,blockquote,charmap,|,link,unlink,anchor,|,table,|,undo,redo';
	return $in;

}
add_filter( 'tiny_mce_before_init', 'wpbase_tinymce_customize_wysiwyg' );
