<?php
/**
 * Plugin Name: Audiophile Hero Manager
 * Description: Manage Hero Banner for the Audiophile Homepage.
 * Version: 1.0
 * Author: L
 * Text Domain: audiophile-hero-manager
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register Hero Custom Post Type
function ahm_register_hero_cpt() {

    $labels = [
        'name'                  => 'Hero Banners',
        'singular_name'         => 'Hero Banner',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Hero Banner',
        'edit_item'             => 'Edit Hero Banner',
        'new_item'              => 'New Hero Banner',
        'view_item'             => 'View Hero Banner',
        'search_items'          => 'Search Hero Banners',
        'not_found'             => 'No Hero Banners found',
        'not_found_in_trash'    => 'No Hero Banners found in Trash',
        'parent_item_colon'     => '',
        'menu_name'             => 'Hero Manager'
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-slides',
        'supports'              => ['title', 'editor', 'thumbnail'],
        'has_archive'           => false,
        'rewrite'               => ['slug' => 'hero'],
        'publicly_queryable'    => false,
        'exclude_from_search'   => true,
        'show_in_rest'          => true, // Optional, useful for Gutenberg/REST
    ];

    register_post_type('hero', $args);
}

add_action('init', 'ahm_register_hero_cpt');
