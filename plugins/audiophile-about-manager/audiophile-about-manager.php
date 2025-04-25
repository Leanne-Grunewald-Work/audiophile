<?php
/**
 * Plugin Name: Audiophile About Manager
 * Description: Manage Homepage About Section for Audiophile Theme.
 * Version: 1.0
 * Author: L
 * Text Domain: audiophile-about-manager
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register About CPT
function aam_register_about_cpt() {

    $labels = [
        'name'               => 'About Sections',
        'singular_name'      => 'About Section',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New About Section',
        'edit_item'          => 'Edit About Section',
        'new_item'           => 'New About Section',
        'view_item'          => 'View About Section',
        'search_items'       => 'Search About Sections',
        'not_found'          => 'No About Sections found',
        'not_found_in_trash' => 'No About Sections found in Trash',
        'menu_name'          => 'About Manager'
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'show_in_menu'       => true,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-info',
        'supports'           => ['title', 'editor', 'thumbnail'],
        'has_archive'        => false,
        'rewrite'            => ['slug' => 'about-section'],
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_in_rest'       => true,
    ];

    register_post_type('about_section', $args);
}

add_action('init', 'aam_register_about_cpt');
