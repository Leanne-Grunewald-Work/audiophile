<?php
/**
 * Plugin Name: Audiophile Categories Manager
 * Description: Manage Homepage Categories Cards for Audiophile Theme.
 * Version: 1.0
 * Author: L
 * Text Domain: audiophile-categories-manager
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register Categories CPT
function acm_register_categories_cpt() {

    $labels = [
        'name'                  => 'Homepage Categories',
        'singular_name'         => 'Homepage Category',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Homepage Category',
        'edit_item'             => 'Edit Homepage Category',
        'new_item'              => 'New Homepage Category',
        'view_item'             => 'View Homepage Category',
        'search_items'          => 'Search Homepage Categories',
        'not_found'             => 'No Homepage Categories found',
        'not_found_in_trash'    => 'No Homepage Categories found in Trash',
        'menu_name'             => 'Category Manager'
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-grid-view',
        'supports'              => ['title', 'thumbnail', 'page-attributes'],
        'has_archive'           => false,
        'rewrite'               => ['slug' => 'homepage-category'],
        'publicly_queryable'    => false,
        'exclude_from_search'   => true,
        'show_in_rest'          => true,
    ];

    register_post_type('homepage_category', $args);
}

add_action('init', 'acm_register_categories_cpt');


// Set Default Order to Menu Order in Admin for Homepage Categories
function acm_set_admin_order($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $post_type = $query->get('post_type');

    if ('homepage_category' === $post_type) {
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'acm_set_admin_order');
