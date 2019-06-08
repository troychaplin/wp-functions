<?php
/**
 * Register WP Nav Menu
 * =============

 * @package Admin Supports
 * @category Theme Supports
 * @version 1.0
 */

function wpbase_register_primary_menu() {
	register_nav_menus(
		array(
			'primary_nav_menu' => __( 'Primary Menu' ),
		)
	);
}
add_action( 'init', 'wpbase_register_primary_menu' );
