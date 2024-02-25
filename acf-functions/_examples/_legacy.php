<?php // @codingStandardsIgnoreLine
/**
 * Removes the Custom Fields Meta Box dropdown query that is not useful as we use ACF.
 * =============
 *
 * @since Carleton Functions
 * @package Admin Customization
 * @version 1.0
 *
 * TODO: verify exactly what this is doing
 */
add_filter('acf/settings/remove_wp_meta_box', '__return_true');

/**
 * ACF Remove Auto P Tags
 * =============
 *
 * @since Carleton CMS 1.0
 * @package ACF Options
 * @version 1.0
 *
 * TODO: pretty sure this is no longer needed, keeping for now just in case
 */
function the_sub_field_without_wpautop($field_name)
{
    remove_filter('acf_the_content', 'wpautop');
    the_sub_field($field_name);
    add_filter('acf_the_content', 'wpautop');
}

function the_field_without_wpautop($field_name)
{
    remove_filter('acf_the_content', 'wpautop');
    the_field($field_name, 'option');
    add_filter('acf_the_content', 'wpautop');
}

function get_the_field_without_wpautop($field_name)
{
    remove_filter('acf_the_content', 'wpautop');
    $field = get_field($field_name, 'option');
    add_filter('acf_the_content', 'wpautop');

    return $field;
}
