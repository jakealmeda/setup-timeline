<?php
/**
 * Plugin Name: Setup Timeline
 * Description: Auto load contents to page without page reload/refresh.
 * Version: 1.0
 * Author: Jake Almeda
 * Author URI: https://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


// include required functions that needs to be executed in the main directory
class SetupTimeVariables {

    // show/hide entry post types
    public $show_post_type = TRUE;

    // simply return this plugin's main directory
    public function setup_time_dir_path() {

        return plugin_dir_path( __FILE__ );

    }

    // list of excluded post types
    public function setup_timeline_not_from_these_posttypes() {

        return array(
            'attachment',
            'revision',
            'nav_menu_item',
            'custom_css',
            'customize_changeset',
            'oembed_cache',
            'user_request',
            'wp_block',
            'wp_template',
            'wp_template_part',
            'wp_global_styles',
            'wp_navigation',
            'acf-field-group',
            'acf-field',
            '_pods_pod',
            '_pods_group',
            '_pods_field',
        );

    }

    // list of excluded taxonomies
    public function setup_timeline_not_from_these_taxonomies() {

        return array(
            'nav_menu',
            'post_format',
            'wp_theme',
            'wp_template_part_area',
        );

    }

    // enqueue
    /*public function setup_block_enqueue_scripts() {

        // enqueue styles
        wp_enqueue_style( 'setupblocksstyle', plugin_dir_url( __FILE__ ).'css/style.css' );

    }*/

    // Construct
    /*public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'setup_block_enqueue_scripts' ), 2000 );
    }*/

}

// include files
include_once( 'lib/setup-time-blocks-generator.php' );
include_once( 'lib/setup-time-blocks-acf.php' );
//include_once( 'lib/setup-time-blocks-acf-dynamic-fields.php' );
include_once( 'lib/setup-time-blocks-functions-extension.php' );
include_once( 'lib/setup-time-blocks-functions.php' );
