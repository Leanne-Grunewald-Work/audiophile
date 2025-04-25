<?php
/**
 * Plugin Name: Audiophile Site Settings
 * Description: Manage global site settings like Logo, About Text, and Social Media Links.
 * Version: 1.0
 * Author: L
 * Text Domain: audiophile-site-settings
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register Site Settings CPT
function ass_register_site_settings_cpt() {

    $labels = [
        'name'               => 'Site Settings',
        'singular_name'      => 'Site Setting',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Site Setting',
        'edit_item'          => 'Edit Site Setting',
        'new_item'           => 'New Site Setting',
        'view_item'          => 'View Site Setting',
        'search_items'       => 'Search Site Settings',
        'not_found'          => 'No Site Settings found',
        'not_found_in_trash' => 'No Site Settings found in Trash',
        'menu_name'          => 'Site Settings'
    ];

    $args = [
        'labels'             => $labels,
        'public'             => false, // not public
        'show_ui'            => true,  // visible in Admin
        'show_in_menu'       => true,
        'menu_position'      => 9,
        'menu_icon'          => 'dashicons-admin-generic',
        'supports'           => ['title', 'thumbnail'],
        'has_archive'        => false,
        'rewrite'            => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_in_rest'       => true,
    ];

    register_post_type('site_setting', $args);
}

add_action('init', 'ass_register_site_settings_cpt');
