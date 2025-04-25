<?php
/* 
Template Name: Custom Checkout
*/

get_header(); ?>

<main class="checkout-wrapper container mx-auto max-w-screen-xl py-20 px-6">
    <div class="bg-white p-10 rounded-lg shadow">
        <?php echo do_shortcode('[woocommerce_checkout]'); ?>
    </div>
</main>

<?php get_footer(); ?>
