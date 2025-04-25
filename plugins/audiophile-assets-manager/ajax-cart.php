<?php
add_action('wp_ajax_aam_update_cart', 'aam_update_cart');
add_action('wp_ajax_nopriv_aam_update_cart', 'aam_update_cart');

function aam_update_cart() {
    check_ajax_referer('aam_cart_nonce', 'nonce');

    $action = sanitize_text_field($_POST['update_action']);
    $cart   = WC()->cart->get_cart();

    // Only require cart_item_key if not clearing all
    $key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : null;

    if ($action !== 'clear' && (!$key || !isset($cart[$key]))) {
        wp_send_json_error('Item not found.');
    }

    switch ($action) {
        case 'increase':
            $qty = $cart[$key]['quantity'];
            WC()->cart->set_quantity($key, $qty + 1);
            break;

        case 'decrease':
            $qty = $cart[$key]['quantity'];
            WC()->cart->set_quantity($key, max(1, $qty - 1));
            break;

        case 'remove':
            WC()->cart->remove_cart_item($key);
            break;

        case 'clear':
            WC()->cart->empty_cart();
            break;
    }

    ob_start();
    get_template_part('template-parts/cart/mini-cart');
    $html = ob_get_clean();
    wp_send_json_success($html);
}
