<?php
defined('ABSPATH') || exit;

get_header();
?>

<!-- Banner with Category Name -->
<section class="category-header bg-[#141414] text-white py-20 text-center font-[Manrope]">
    <div class="container category-header-container mx-auto max-w-screen-xl">
        <h1 class="text-4xl uppercase font-bold">
            <?php woocommerce_page_title(); ?>
        </h1>
    </div>
</section>

<!-- Products Loop -->
<section class="products-listing py-20 px-6 bg-white space-y-20 font-[Manrope]">
    <div class="container products-listing-container mx-auto max-w-screen-xl">
        <?php if (woocommerce_product_loop()) : ?>

            <?php

            // Remove default WooCommerce wrappers
            remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
            remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
            remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
            remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

            // Remove UL and LI wrappers
            remove_action('woocommerce_product_loop_start', 'woocommerce_product_loop_start', 10);
            remove_action('woocommerce_product_loop_end', 'woocommerce_product_loop_end', 10);


            $counter = 0;
            while (have_posts()) :
                the_post();
                global $product;
                $counter++;
            ?>

            <div class="flex flex-col md:flex-row <?php echo ($counter % 2 == 0) ? 'md:flex-row-reverse' : ''; ?> items-center gap-20 mt-20 pt-20">
                
                <!-- Product Image -->
                <div class="flex-1 flex justify-center">
                    <?php echo woocommerce_get_product_thumbnail('full', ['class' => 'rounded-lg']); ?>
                </div>

                <!-- Product Info -->
                <div class="flex-1 space-y-6 text-center md:text-left">
                    <?php
                    $product_tags = wp_get_post_terms(get_the_ID(), 'product_tag', ['fields' => 'slugs']);
                    if (in_array('new', $product_tags)) :
                    ?>
                        <h4 class="inline-block product-listing-tag text-sm uppercase tracking-widest text-[#FBAF85]">New Product</h4>
                    <?php endif; ?>

                    <h2 class="product-listing-title text-4xl md:text-5xl font-semibold leading-tight uppercase"><?php the_title(); ?></h2>

                    <?php
                    $excerpt = get_the_excerpt(null, false);
                    $excerpt = apply_filters('the_content', $excerpt);
                    $excerpt = str_replace(['<p>', '</p>'], '', $excerpt); // Remove any leftover <p> or </p> tags
                    ?>

                    <p class="text-black/50 py-5"><?php echo wp_kses_post($excerpt); ?></p>
                    <a href="<?php the_permalink(); ?>" class="inline-block bg-[#D87D4A] hover:bg-[#FBAF85] text-white font-bold py-4 px-8 mt-4 text-sm uppercase">
                        See Product
                    </a>
                </div>

            </div>

            <?php endwhile; ?>

            <?php woocommerce_product_loop_end(); ?>

        <?php else : ?>

            <?php do_action('woocommerce_no_products_found'); ?>

        <?php endif; ?>
    </div>
</section>

<!-- Category Navigation (Shop by Category Section) -->
<?php get_template_part('template-parts/home/categories'); ?>

<!-- About Section -->
<?php get_template_part('template-parts/home/about'); ?>

<?php
get_footer();
?>
