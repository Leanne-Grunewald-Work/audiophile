<?php
$items = WC()->cart->get_cart();
?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
    <div id="aam-mini-cart-inner" class="relative">
        <!-- Loading Overlay -->
        <div id="aam-cart-loading" class="absolute inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
            <svg class="animate-spin h-6 w-6 text-white" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
        </div>

        <div class="text-sm space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Cart (<?php echo WC()->cart->get_cart_contents_count(); ?>)</h3>
                <button type="button" class="cart-update-btn clear-cart-btn text-gray-500 hover:underline text-xs" data-action="clear">
                    Remove all
                    <span class="spinner hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <svg class="animate-spin h-4 w-4 text-gray-400" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </span>
                </button>

            </div>

            <?php foreach ($items as $item): 
                $product = $item['data'];
                $product_id = $item['product_id'];
            ?>
                <div class="flex items-center justify-between gap-4">
                    <img src="<?php echo get_the_post_thumbnail_url($product_id, 'thumbnail'); ?>" class="h-12 w-12 rounded" alt="">
                    <div class="flex-1">
                        <h4 class="font-semibold"><?php echo $product->get_name(); ?></h4>
                        <p class="text-sm text-gray-500">$<?php echo number_format($product->get_price(), 2); ?></p>
                    </div>
                    <div class="flex items-center border rounded px-2">
                        <button type="button" class="cart-update-btn px-2" data-action="decrease" data-key="<?php echo esc_attr($item['key']); ?>">-
                            <span class="spinner hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg class="animate-spin h-4 w-4 text-gray-400" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                            </span>
                        </button>
                        <span class="px-2"><?php echo $item['quantity']; ?></span>
                        <button type="button" class="cart-update-btn px-2" data-action="increase" data-key="<?php echo esc_attr($item['key']); ?>">+
                            <span class="spinner hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg class="animate-spin h-4 w-4 text-gray-400" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                            </span>
                        </button>
                        <button type="button" class="cart-update-btn px-2 text-red-500" data-action="remove" data-key="<?php echo esc_attr($item['key']); ?>">&times;
                            <span class="spinner hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg class="animate-spin h-4 w-4 text-gray-400" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="flex justify-between items-center font-bold text-lg mt-4">
                <span>Total</span>
                <span>R<?php echo WC()->cart->get_total('edit'); ?></span>
            </div>

            <?php if ( ! WC()->cart->is_empty() ) : ?>
                <a href="<?php echo wc_get_checkout_url(); ?>" class="block text-center bg-[#D87D4A] hover:bg-orange-400 text-white font-bold py-3 rounded uppercase mt-4">
                    Checkout
                </a>
            <?php endif; ?>

        </div>
    </div>
<?php else : ?>
    <p class="text-center text-gray-500">Your cart is empty.</p>
<?php endif; ?>

