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
 * Set default media sizes
 * =============
 *
 * @package Admin Supports
 * @category Update Options
 * @version 1.0
 */

update_option( 'thumbnail_size_w', 250 );
update_option( 'thumbnail_size_h', 0 );
update_option( 'medium_size_w', 400 );
update_option( 'medium_size_h', 0 );
update_option( 'large_size_w', 1024 );
update_option( 'large_size_h', 0 );


/**
 * Set default posts per page
 * =============
 *
 * @package Admin Supports
 * @category Update Image Options
 * @version 1.0
 */

update_option( 'posts_per_page', 12 );


/**
 * Reorder the admin menu
 * =============
 * @package Admin Supports
 * @category Theme Supports
 * @version 1.0
 */

function pse_custom_menu_order() {
	$menu_order = array(
		'index.php',
		'edit.php?post_type=pse-homepage',
		'edit.php?post_type=page',
		'edit.php',
		'edit.php?post_type=pse-news',
		'edit.php?post_type=pse-schedule',
		'edit.php?post_type=pse-sessions',
		'edit.php?post_type=pse-speakers',
		'edit.php?post_type=pse-sponsors',
		'edit.php?post_type=pse-newsletter',
	);
	return $menu_order;
}
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'pse_custom_menu_order' );
