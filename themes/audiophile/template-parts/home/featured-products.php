<section class="site-featured-products py-20 px-20 bg-white font-[Manrope]">
    <div class="container featured-products-container mx-auto max-w-screen-xl space-y-16">

        <?php
        $featured_query = new WP_Query([
            'post_type'      => 'featured_product',
            'posts_per_page' => -1,
            'no_found_rows'  => true,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);

        if ($featured_query->have_posts()) :
            while ($featured_query->have_posts()) : $featured_query->the_post();

                $section_type = get_field('section_type'); // 1, 2, or 3
                $button_text = get_field('button_text');
                $button_link = get_field('button_link');

                ?>

                <?php if ($section_type == 1) : ?>
                    <!-- Large Featured Section (ZX9) -->
                    <div class="bg-[#D87D4A] text-white rounded-lg overflow-hidden flex flex-col md:flex-row items-center px-20 pt-10 gap-20">

                        <!-- Image -->
                        <div class="flex-1 flex justify-center basis-full md:basis-[50%] relative">
                            <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pattern-circles.svg" alt="Pattern Circles" class="relative top-0 left-0 w-full h-auto pointer-events-none" />

                            <?php the_post_thumbnail('full', ['class' => 'h-auto w-[70%] object-contain absolute bottom-[-3%] min-w-[200px]']); ?>
                            <?php endif; ?>
                        </div>

                        <!-- Text -->
                        <div class="flex-1 space-y-6 text-center md:text-left basis-full md:basis-[40%]">
                            <h2 class="text-5xl md:text-6xl font-bold leading-tight md:w-[80%]"><?php the_title(); ?></h2>

                            <?php
                            $content = get_the_content(null, false);
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(['<p>', '</p>'], '', $content); // Remove any leftover <p> or </p> tags

                            if (!empty($content)) :
                                ?>
                                <p class="text-lg text-white/70 md:w-[80%] pb-10">
                                    <?php echo wp_kses_post($content); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($button_link) : ?>
                            <a href="<?php echo esc_url($button_link); ?>" class="btn inline-block bg-black hover:bg-[#4C4C4C] text-white font-bold py-4 px-8 mt-4 text-sm uppercase">
                                <?php echo esc_html($button_text); ?>
                            </a>
                            <?php endif; ?>
                        </div>

                    </div>

                <?php elseif ($section_type == 2) : ?>
                    <!-- Small Card (Image Right) -->
                    <div class="bg-cover bg-center bg-gray-100 rounded-lg flex flex-col md:flex-row items-center overflow-hidden p-20 gap-10 min-h-[420px]" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">

                        <div class="flex-1 space-y-6">
                            <h2 class="text-2xl md:text-3xl font-bold leading-tight"><?php the_title(); ?></h2>
                            <?php if ($button_link) : ?>
                            <a href="<?php echo esc_url($button_link); ?>" class="btn inline-block bg-none hover:bg-black text-black hover:text-white font-bold py-4 px-8 mt-4 text-sm uppercase border border-black">
                                <?php echo esc_html($button_text); ?>
                            </a>
                            <?php endif; ?>
                        </div>

                        <div class="flex-1 flex justify-center">
                            
                        </div>

                    </div>

                <?php elseif ($section_type == 3) : ?>
                    <!-- Small Card (Image Left) -->
                    <div class="flex flex-col md:flex-row-reverse items-stretch overflow-hidden gap-6 md:gap-8 rounded-lg min-h-[420px]">

                        <!-- Text Column -->
                        <div class="flex flex-col justify-center items-start text-left space-y-6 bg-[#F1F1F1] p-20 basis-full md:basis-1/2">
                            <h2 class="text-2xl md:text-3xl font-bold leading-tight"><?php the_title(); ?></h2>
                            <?php if ($button_link) : ?>
                            <a href="<?php echo esc_url($button_link); ?>" class="btn inline-block bg-none hover:bg-black text-black hover:text-white font-bold py-4 px-8 mt-4 text-sm uppercase border border-black">
                                <?php echo esc_html($button_text); ?>
                            </a>
                            <?php endif; ?>
                        </div>

                        <!-- Image Column -->
                        <div class="basis-full md:basis-1/2 min-h-[320px] bg-cover bg-center rounded-lg" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                            <!-- No need for <img> tag here -->
                        </div>

                    </div>

                <?php endif; ?>

                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

    </div>
</section>
