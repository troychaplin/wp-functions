<?php
/**
 * Disable gutenberg front end styles
 * =============
 *
 * @package Global Supports
 * @category Gutenberg
 * @version 1.0
 */

// TODO: wrap in acf option

function wps_deregister_styles() {
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
