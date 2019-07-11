<?php
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
