<?php
/**
 * Prevent WordPress from updating htaccess
 * =============
 *
 * @package Global Supports
 * @category Clean-Up
 * @version 1.0
 */

add_filter( 'flush_rewrite_rules_hard', '__return_false' );


/**
 * Switch the Login Logo Link
 * =============
 *
 * @packages Global Supports
 * @category Clean-Up
 * @version 1.0
 */

function wpbase_update_login_logo_link() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'wpbase_update_login_logo_link' );


/**
 * Remove items from wp-admin-bar
 * =============

 * @package Global Supports
 * @category Clean-Up
 * @version 1.0
 */

function wpbase_adminbar_cleanup( $wp_admin_bar ) {
	global $wp_admin_bar;

	if ( is_home() ) {
		$current_id = get_field( 'active_homepage', 'cpt_homepage_options' );
		$wp_admin_bar->add_menu(
			array(
				'id'    => 'wpb_edit',
				'title' => __( 'Edit Homepage' ),
				'href'  => get_edit_post_link( $current_id ),
			)
		);
	}

	$customize_node = $wp_admin_bar->get_node( 'customize' );
	if ( $customize_node ) {
		$wp_admin_bar->remove_node( 'customize' );
	}

	$wplogo_node = $wp_admin_bar->get_node( 'wp-logo' );
	if ( $wplogo_node ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
	}

	$new_user_node = $wp_admin_bar->get_node( 'new-user' );
	if ( $new_user_node ) {
		$wp_admin_bar->remove_node( 'new-user' );
	}

	$gravform_node = $wp_admin_bar->get_node( 'gravityforms-new-form' );
	if ( $gravform_node ) {
		$wp_admin_bar->remove_node( 'gravityforms-new-form' );
	}

	$seo_node = $wp_admin_bar->get_node( 'wpseo-menu' );
	if ( $seo_node ) {
		$wp_admin_bar->remove_node( 'wpseo-menu' );
	}
}
add_action( 'admin_bar_menu', 'wpbase_adminbar_cleanup', 999 );
