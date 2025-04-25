<?php

// Setup theme
function audiophile_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');

    register_nav_menus([
        'primary' => __('Primary Menu', 'audiophile'),
    ]);
}
add_action('after_setup_theme', 'audiophile_setup');

// Enqueue scripts and styles
function audiophile_enqueue_scripts() {
    wp_enqueue_style('audiophile-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'audiophile_enqueue_scripts');

// Customize product order on product category pages
add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && (is_post_type_archive('product') || is_tax('product_cat'))) {
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
});


add_action('wp_footer', function () {
    if (is_checkout()) {
        wc_get_template_part('global/footer', 'debug');
    }
});
