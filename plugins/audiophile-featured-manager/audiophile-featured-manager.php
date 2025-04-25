<?php
/**
 * Plugin Name: Audiophile Featured Manager
 * Description: Manage Homepage Featured Products for Audiophile Theme.
 * Version: 1.0
 * Author: L
 * Text Domain: audiophile-equip-featured-manager
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register Featured Products CPT
function afm_register_featured_cpt() {

    $labels = [
        'name'               => 'Featured Products',
        'singular_name'      => 'Featured Product',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Featured Product',
        'edit_item'          => 'Edit Featured Product',
        'new_item'           => 'New Featured Product',
        'view_item'          => 'View Featured Product',
        'search_items'       => 'Search Featured Products',
        'not_found'          => 'No Featured Products found',
        'not_found_in_trash' => 'No Featured Products found in Trash',
        'menu_name'          => 'Featured Manager'
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'show_in_menu'       => true,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-excerpt-view',
        'supports'           => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'has_archive'        => false,
        'rewrite'            => ['slug' => 'featured-product'],
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_in_rest'       => true,
    ];

    register_post_type('featured_product', $args);
}

add_action('init', 'afm_register_featured_cpt');
