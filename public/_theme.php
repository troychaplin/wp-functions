<?php
/**
 * Enqueue Front End Style and Scripts
 * =============
 *
 * @package Public Supports
 * @category Scripts and Styles
 * @version 1.0
 */

function pseweb_front_end_enqueues() {

	// Load jQuery on Front End
	if ( ! is_admin() ) {
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', false, '3.4.1', true );
	}

	// Enqueue Google Fonts
	wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700', false, THEME_VERSION );

	// Add loadmore ajax_url
	wp_localize_script( 'scripts', 'loadmore', [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
}
add_action( 'wp_enqueue_scripts', 'pseweb_front_end_enqueues' );
