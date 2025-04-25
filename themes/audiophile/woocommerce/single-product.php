<?php
defined('ABSPATH') || exit;

get_header();
?>

    
<!-- Go Back Button -->
<section class="single-back-button text-black/50 pt-20 text-left font-[Manrope]">
    <div class="container single-back-button-container mx-auto max-w-screen-xl px-8">
        <a href="<?php echo esc_url( wp_get_referer() ?: get_permalink( wc_get_page_id('shop') ) ); ?>" class="text-sm text-black/50 hover:text-[#D87D4A] mb-10 inline-block">
            Go Back
        </a>
    </div>
</section>

<?php while ( have_posts() ) : the_post(); global $product; ?>

    <!-- Product Header -->
    <section class="single-product-header py-5 font-[Manrope]">
        <div class="container single-product-header-container mx-auto max-w-screen-xl flex flex-col md:flex-row gap-10 md:gap-20 items-center mb-20 px-8">

    
        
            <!-- Featured Image -->
            <div class="flex-1 flex justify-center">
                <?php the_post_thumbnail('full', ['class' => 'rounded-lg w-full h-auto object-contain']); ?>
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
                $excerpt = apply_filters('woocommerce_short_description', $excerpt);
                $excerpt = str_replace(['<p>', '</p>'], '', $excerpt); // Remove any leftover <p> or </p> tags
                ?>

                <p class="text-black/50 py-4"><?php echo wp_kses_post($excerpt); ?></p>

                <p class="text-black text-xl py-3 font-bold"><?php echo $product->get_price_html(); ?></p>

                <!-- Add to Cart -->
                <div class="flex items-center gap-4 mt-6">
                    <?php
                    // Quantity input
                    /**woocommerce_quantity_input([
                        'min_value' => 1,
                        'max_value' => 10,
                        'input_value' => 1,
                    ]);**/

                    // Add to cart button
                    woocommerce_template_single_add_to_cart();
                    ?>
                </div>


            </div>

        </div>
    </section>

    <!-- Features + In the Box -->
    <section class="single-product-features py-20 font-[Manrope]">
        <div class="container single-product-features-container mx-auto max-w-screen-xl grid md:grid-cols-3 gap-20 mb-20 px-8">

            <!-- Features -->
            <div class="col-span-2">
                <h2 class="text-4xl font-bold uppercase mb-10 font-bold">Features</h2>
                <div class="text-black/50 space-y-4 leading-relaxed">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- In The Box -->
            <div class="col-span-1">
            <h2 class="text-4xl font-bold uppercase mb-10 font-bold">In the Box</h2>

                <?php
                // Repeater only available with Pro upgrade
                $quantity_1 = get_field('quantity_1');
                $item_name_1 = get_field('item_name_1');

                $quantity_2 = get_field('quantity_2');
                $item_name_2 = get_field('item_name_2');

                $quantity_3 = get_field('quantity_3');
                $item_name_3 = get_field('item_name_3');

                $quantity_4 = get_field('quantity_4');
                $item_name_4 = get_field('item_name_4');

                $quantity_5 = get_field('quantity_5');
                $item_name_5 = get_field('item_name_5');
                ?>

                <ul class="space-y-2">
                    <?php 
                    if ($item_name_1 != '') :
                        ?>
                        <li class="text-black/50"><span class="text-[#D87D4A] font-bold mr-4"><?php echo $quantity_1 ?>x</span> <?php echo $item_name_1; ?></li>
                        <?php 
                    endif; 
                    ?>
                    <?php 
                    if ($item_name_2 != '') :
                        ?>
                        <li class="text-black/50"><span class="text-[#D87D4A] font-bold mr-4"><?php echo $quantity_2 ?>x</span> <?php echo $item_name_2; ?></li>
                        <?php 
                    endif; 
                    ?>
                    <?php 
                    if ($item_name_3 != '') :
                        ?>
                        <li class="text-black/50"><span class="text-[#D87D4A] font-bold mr-4"><?php echo $quantity_3 ?>x</span> <?php echo $item_name_3; ?></li>
                        <?php 
                    endif; 
                    ?>
                    <?php 
                    if ($item_name_4 != '') :
                        ?>
                        <li class="text-black/50"><span class="text-[#D87D4A] font-bold mr-4"><?php echo $quantity_4 ?>x</span> <?php echo $item_name_4; ?></li>
                        <?php 
                    endif; 
                    ?>
                    <?php 
                    if ($item_name_5 != '') :
                        ?>
                        <li class="text-black/50"><span class="text-[#D87D4A] font-bold mr-4"><?php echo $quantity_5 ?>x</span> <?php echo $item_name_5; ?></li>
                        <?php 
                    endif; 
                    ?>
                </ul>
            </div>
        </div>
    </section>

    <section class="single-product-gallery pb-20 font-[Manrope]">
        <!-- Image Gallery -->
        <?php
        $attachment_ids = $product->get_gallery_image_ids();
        ?>

        <?php if ($attachment_ids && count($attachment_ids) >= 3): ?>
            <div class="container single-product-gallery-container mx-auto max-w-screen-xl grid grid-cols-3 gap-6 items-stretch px-8">
                <!-- Left: 2 stacked images -->
                <div class="flex flex-col gap-6">
                    <?php for ($i = 0; $i < 2; $i++): ?>
                        <?php
                        $img_url = wp_get_attachment_image_url($attachment_ids[$i], 'full');
                        echo '<a href="' . esc_url($img_url) . '" data-fancybox="gallery" class="block h-full">';
                        echo wp_get_attachment_image($attachment_ids[$i], 'large', false, [
                            'class' => 'rounded-lg object-cover h-[100%] w-auto',
                            'style' =>  'height:100%!important'
                        ]);
                        echo '</a>';
                        ?>
                    <?php endfor; ?>
                </div>

                <!-- Right: 1 large image -->
                <div class="col-span-2">
                    <?php
                    $img_url = wp_get_attachment_image_url($attachment_ids[2], 'full');
                    echo '<a href="' . esc_url($img_url) . '" data-fancybox="gallery" class="block h-full">';
                    echo wp_get_attachment_image($attachment_ids[2], 'large', false, [
                        'class' => 'rounded-lg object-cover h-full w-full',
                    ]);
                    echo '</a>';
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </section>



    <!-- Related Products -->
    <?php
    $related_1 = get_field('related_product_1');
    $related_2 = get_field('related_product_2');
    $related_3 = get_field('related_product_3');
    
    // Relationship fields always return arrays — get the first selected product
    $related_1 = is_array($related_1) ? $related_1[0] ?? null : $related_1;
    $related_2 = is_array($related_2) ? $related_2[0] ?? null : $related_2;
    $related_3 = is_array($related_3) ? $related_3[0] ?? null : $related_3;

    // Guard against empty fields and non-product items
    $related_products = array_filter([$related_1, $related_2, $related_3], function ($item) {
        return $item && get_post_type($item) === 'product';
    });
    ?>

    <?php if (!empty($related_products)) : ?>
    

    <section class="related-products py-20 px-20 text-center font-[Manrope]">
        <div class="container related-products-container mx-auto max-w-screen-xl">
            <h2 class="text-2xl md:text-3xl uppercase font-bold mb-10">You may also like</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <?php foreach ($related_products as $related_product) :
                    $product_id = is_object($related_product) ? $related_product->ID : $related_product;
                ?>
                    <div class="flex flex-col items-center space-y-6">
                        <!-- Image -->
                        <div class="w-full aspect-square flex justify-center items-center bg-[#F1F1F1] rounded-lg overflow-hidden">
                            <?php echo get_the_post_thumbnail($product_id, 'medium', ['class' => 'object-contain h-40']); ?>
                        </div>

                        <!-- Title -->
                        <h3 class="text-2xl font-semibold uppercase tracking-widest">
                            <?php echo esc_html(get_the_title($product_id)); ?>
                        </h3>

                        <!-- Button -->
                        <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="inline-block bg-[#D87D4A] hover:bg-[#FBAF85] text-white font-bold py-4 px-8 mt-4 text-sm uppercase">
                            See Product
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>




    <!-- Categories -->
    <section class="mt-20">
        <?php get_template_part('template-parts/home/categories'); ?>
    </section>

    <!-- About Section -->
    <section class="mt-20">
        <?php get_template_part('template-parts/home/about'); ?>
    </section>

    <?php endwhile; ?>



<?php
get_footer('shop');
