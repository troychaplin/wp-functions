<?php // @codingStandardsIgnoreLine
/*
    Plugin Name: WP Functions: Advanced Custom Fields Pro
    Plugin URI: http://troychaplin.ca
    Description: This plugin adds functions to extend and support Advanced Custom Fields Pro
    Version: 1.0
    Author: Troy Chaplin
    Author URI: http://troychaplin.ca
    License: GPL2
*/
namespace ACFProFunctions;

class ACFProFunctions
{

    public function __construct()
    {
        // Remove ACF admin menu item outside of a dev environment
        if ('DEV' !== getenv('ENV_SERVER_ENV')) {
            add_filter('acf/settings/show_admin', '__return_false');
        }

        // Include acf options page
        if (is_admin() && function_exists('acf_add_options_page')) {
            $this->siteOptions();
        }

        // Custom toolbar options for ACF WYSIWYG Editors
        if (is_admin()) {
            add_filter('acf/fields/wysiwyg/toolbars', array( &$this, 'customACFToolbars' ));
        }
    }

    // Include acf options page
    private function siteOptions()
    {
        acf_add_options_page(
            array(
                'page_title' => 'Site Options',
                'menu_title' => 'Site Options',
                'menu_slug'  => 'site-options',
                'capability' => 'edit_posts',
                'redirect'   => false,
            )
        );

        acf_add_options_sub_page(
            array(
                'page_title'  => 'Admin Options',
                'menu_title'  => 'Admin Options',
                'parent_slug' => 'site-options',
                'capability'  => 'manage_options',
            )
        );
    }
    
    public function customACFToolbars($toolbars)
    {
        // Basic Toolbar
        $toolbars['Basic']    = array();
        $toolbars['Basic'][1] = array( 'formatselect', 'bold', 'italic', 'bullist', 'numlist', 'link', 'unlink', 'anchor', 'pastetext', 'columns' );

        // Bold and Italic Toolbar
        $toolbars['Bold and Italic']    = array();
        $toolbars['Bold and Italic'][1] = array( 'bold', 'italic', 'pastetext' );

        // Bold, Italic and Links Toolbar
        $toolbars['Bold, Italic and Links']    = array();
        $toolbars['Bold, Italic and Links'][1] = array( 'bold', 'italic', 'link', 'unlink', 'pastetext' );

        // Links Toolbar
        $toolbars['Links Only']    = array();
        $toolbars['Links Only'][1] = array( 'link', 'unlink', 'anchor', 'pastetext' );

        return $toolbars;
    }
}

$acf_pro_functions = new ACFProFunctions();
