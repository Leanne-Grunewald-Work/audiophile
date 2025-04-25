<?php
function aam_enqueue_assets() {
    wp_enqueue_script('tailwindcss', 'https://cdn.tailwindcss.com', [], null, false);
    wp_enqueue_script('aam-menu-toggle', plugin_dir_url(__FILE__) . 'assets/js/menu-toggle.js', ['tailwindcss'], '1.0', true);
    wp_enqueue_script('alpine-js', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', [], null, true);
    wp_enqueue_script('aam-cart-ajax', plugin_dir_url(__FILE__) . 'assets/js/cart-ajax.js', ['jquery'], '1.0', true);

    wp_localize_script('aam-cart-ajax', 'aam_ajax_obj', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('aam_cart_nonce'),
    ]);

    wp_enqueue_style('manrope-font', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap', [], null);

    if (is_product()) {
        wp_enqueue_style('fancybox-css', plugin_dir_url(__FILE__) . 'assets/fancybox/fancybox.css');
    }
}
add_action('wp_enqueue_scripts', 'aam_enqueue_assets');
