<?php // @codingStandardsIgnoreLine
/**
 * Automatically populate select list with image thumbnails
 * =============
 *
 * @since Carleton CMS 1.0
 * @package ACF Options
 * @version 1.0
 *
 * TODO: example, where could we store for possible future use?
 */
if (function_exists('get_field')) {
    function populate_thumbnail_list($field)
    {
        $field['choices']                 = array();
        $field['choices']['announcement'] = 'Announcement';
        $field['choices']['alert']        = 'Alert';
        return $field;
    }
    add_filter('acf/load_field/name=Post Thumbnail Icon', 'populate_thumbnail_list');
    add_filter('acf/load_field/name=preset_thumbnail', 'populate_thumbnail_list');
}

/*
    Plugin Name: Advanced Custom Fields: Carleton Location Rules
    Plugin URI: http://carleton.ca/webservices
    Description: Add a location rule to ACF field groups based on user capabilities
    Version: 1.0
    Author: Web Services
    Author URI: http://carleton.ca/webservices
    Text Domain: plugin-acf-location-rules
    License: GPL2

    https://www.advancedcustomfields.com/resources/custom-location-rules/
    http://www.billerickson.net/acf-custom-location-rules/
    https://gist.github.com/benjaminpick/fc8a86fb07e1d58801e4
*/
class CU_ACF_Locations
{
    public function __construct()
    {
        $this->cu_acf_location_rule_capability();
    }

    public function cu_acf_location_rule_capability()
    {
        // Add rule type for user capabilities
        add_filter('acf/location/rule_types', array( &$this, 'cu_acf_rule_type_capabilities' ));

        // Add rule operators for user capabilities
        add_filter('acf/location/rule_values/user_capabilities', array( &$this, 'cu_acf_rule_values_capabilities' ));

        // Match the rule for user capabilities
        add_filter('acf/location/rule_match/user_capabilities', array( &$this, 'cu_acf_rule_match_capabilities' ), 10, 3);
    }

    // Add rule type for user capabilities
    public function cu_acf_rule_type_capabilities($choices)
    {
        $choices['User']['user_capabilities'] = 'Capability';
        return $choices;
    }

    // Add rule operators for user capabilities
    public function cu_acf_rule_values_capabilities($choices)
    {
        global $wp_roles;
        $caps = array_keys($wp_roles->roles['administrator']['capabilities']);
        sort($caps);
        $choices = array_combine($caps, $caps);
        return $choices;
    }

    // Match the rule for user capabilities
    public function cu_acf_rule_match_capabilities($allowed, $rule, $args)
    {
        return current_user_can($rule['value']);
    }
}
new CU_ACF_Locations();
