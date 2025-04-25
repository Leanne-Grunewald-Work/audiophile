<section class="site-categories py-20 mt-20 px-20 bg-white font-[Manrope]">
    <div class="container categories-container mx-auto max-w-screen-xl ">

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-10">
            <?php
            $categories_query = new WP_Query([
                'post_type'      => 'homepage_category',
                'posts_per_page' => -1, 
                'no_found_rows'  => true,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ]);

            if ($categories_query->have_posts()) :
                while ($categories_query->have_posts()) : $categories_query->the_post();
                ?>

                    <?php if (get_field('category_link')) : ?>
                        <a href="<?php the_field('category_link'); ?>" class="block group">
                    <?php endif; ?>

                            <div class="category-card bg-[#F1F1F1] rounded-lg flex flex-col items-center py-10 space-y-6 text-center relative top-[0px] mb-20 md:mb-0 transition duration-300 hover:shadow-lg cursor-pointer">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="category-image absolute top-[-4rem]">
                                        <?php the_post_thumbnail('full', ['style' => 'height: 12rem !important;', 'class' => 'object-contain']); ?>
                                    </div>
                                <?php endif; ?>

                                <h2 class="category-title text-xl font-semibold text-black tracking-wide uppercase pt-10 mt-10">
                                    <?php the_title(); ?>
                                </h2>

                                <div class="font-semibold inline-flex items-center gap-2 text-sm text-black/50 uppercase group-hover:text-[#D87D4A]">
                                    <span>Shop</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="#D87D4A">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>

                    <?php if (get_field('category_link')) : ?>
                        </a>
                    <?php endif; ?>


                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>
