<?php
/**
 * Disable XML-RPC multicall
 * =============

 * @package public Supports
 * @category WP Cleanup
 * @version 1.0
 */

function wpbase_remove_xmlrpc_methods( $methods ) {
	unset( $methods['pingback.ping'] );
	unset( $methods['pingback.extensions.getPingbacks'] );
	unset( $methods['wp.getUsersBlogs'] );
	unset( $methods['system.multicall'] );
	return $methods;
}
add_filter( 'xmlrpc_methods', 'wpbase_remove_xmlrpc_methods' );


/**
 * Disable WP Core API
 * =============

 * @package public Supports
 * @category WP Cleanup
 * @version 1.0
 * TODO: theme option?
 */

// function wpbase_disable_json_api() {
// 	// Filters for WP-API version 1.x
// 	add_filter( 'json_enabled', '__return_false' );
// 	add_filter( 'json_jsonp_enabled', '__return_false' );

// 	// Filters for WP-API version 2.x
// 	add_filter( 'rest_enabled', '__return_false' );
// 	add_filter( 'rest_jsonp_enabled', '__return_false' );

// 	//Removes rel link in the header related to JSON API
// 	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
// 	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
// }
// add_action( 'after_setup_theme', 'wpbase_disable_json_api' );


/**
 * Add HTML Schema
 * =============

 * @package public Supports
 * @category WP Cleanup
 * @version 1.0
 */

function wpbase_html_schema() {
	$base = '//schema.org/';

	if ( is_author() ) {
		$type = 'ProfilePage';
	} elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}

	echo 'itemscope="itemscope" itemtype="' . esc_attr( $base . $type ) . '"';
}


/**
 * Remove Emoji
 * =============

 * @package public Supports
 * @category WP Cleanup
 * @version 1.0
 */

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );


/**
 * Remove unwanted elements from the default wp_head();
 * =============

 * @package public Supports
 * @category WP Cleanup
 * @version 1.0
 */

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );


/**
 * Remove non breaking spaces from content
 * ============

 * @package public Supports
 * @category WP Cleanup
 * @version 1.0
 */

function wpbase_strip_nbsp_from_content( $content ) {
	$content = preg_replace( '/&nbsp;/i', '', $content );
	return $content;
}
add_filter( 'the_content', 'wpbase_strip_nbsp_from_content' );


/**
 * Filter to replace the [caption] shortcode text with HTML5 compliant code
 * =============

 * @package public Supports
 * @category WP Cleanup
 * @version 1.0
 */

function wpbase_modify_image_shortcode_output( $val, $attr, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'id'      => '',
				'align'   => '',
				'width'   => '',
				'caption' => '',
			),
			$attr
		)
	);

	if ( 1 > (int) $width || empty( $caption ) ) {
		return $val;
	}

	$final_image  = '<figure id="' . esc_attr( $id ) . '" aria-labelledby="figcaption_' . $id . '"  class="c-image-caption ' . esc_attr( $align ) . '">';
	$final_image .= do_shortcode( $content );
	$final_image .= '<figcaption id="figcaption_' . esc_attr( $id ) . '" class="c-image-caption__text">' . esc_html( $caption ) . '</figcaption>';
	$final_image .= '</figure>';

	return $final_image;
}
add_filter( 'img_caption_shortcode', 'wpbase_modify_image_shortcode_output', 10, 3 );


/**
 * Wrap videos in container div
 * =============

 * @package public Supports
 * @category WP Cleanup
 * @version 1.0
 */

function wpbase_responsive_video_embed( $html, $url, $attr, $post_id ) {
	return '<div class="c-video">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'wpbase_responsive_video_embed', 99, 4 );
