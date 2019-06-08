<?php
/**
 * Enqueue Front End Style and Scripts
 * =============
 *
 * @package Public Supports
 * @category Scripts and Styles
 * @version 1.0
 */

function wpbase_front_end_enqueues() {

	// Remove jQuery on Front End
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
	}

	// Enqueued Resource Path
	$theme_stylesheet_path = get_template_directory_uri() . '/dist/css/styles.css';
	$theme_javascript_path = get_template_directory_uri() . '/dist/js/scripts.js';

	// Change Paths for Local Development
	if ( CURRENT_LOCAL === CURRENT_HOST || CURRENT_DEV === CURRENT_HOST ) {
		$theme_stylesheet_path = get_template_directory_uri() . '/dist/css/styles.css&id=' . wp_rand();
		$theme_javascript_path = get_template_directory_uri() . '/dist/js/scripts.js&id=' . wp_rand();
	}

	// Theme Scripts and Styles
	wp_enqueue_style( 'styles', $theme_stylesheet_path, false, THEME_VERSION, 'screen' );
	wp_enqueue_script( 'scripts', $theme_javascript_path, null, THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'wpbase_front_end_enqueues' );


/**
 * Enqueue comment reply script
 * =============
 *
 * @package Public Supports
 * @category Scripts and Styles
 * @version 1.0
 */

function wpbase_enqueue_comments_reply() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'wpbase_enqueue_comments_reply' );
