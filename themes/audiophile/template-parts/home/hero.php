<section class="site-hero bg-[#141414] text-white font-[Manrope]">
    <div class="container hero-container mx-auto max-w-screen-xl flex flex-col md:flex-row items-center py-20 px-8 gap-5">

        <?php
        $hero_query = new WP_Query([
            'post_type'      => 'hero',
            'posts_per_page' => 1,
        ]);

        if ($hero_query->have_posts()) :
            while ($hero_query->have_posts()) : $hero_query->the_post();
                ?>

                <!-- Hero Text Content -->
                <div class="hero-content flex-1 space-y-6 text-center md:text-left basis-full md:basis-[50%]">
                    <?php if (get_field('hero_pre_title')) : ?>
                        <h4 class="hero-subtitle text-sm uppercase tracking-widest text-white/50"><?php the_field('hero_pre_title'); ?></h4>
                    <?php endif; ?>

                    <h1 class="hero-title text-5xl md:text-6xl font-bold leading-tight"><?php the_title(); ?></h1>

                    <?php
                    $content = get_the_content(null, false);
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(['<p>', '</p>'], '', $content); // Remove any leftover <p> or </p> tags

                    if (!empty($content)) :
                        ?>
                        <p class="hero-description text-white/70 md:w-[60%] pb-5">
                            <?php echo wp_kses_post($content); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (get_field('hero_button_link')) : ?>
                        <a href="<?php the_field('hero_button_link'); ?>" class="btn btn-primary inline-block bg-[#D87D4A] hover:bg-[#FBAF85] text-white font-bold py-4 px-8 mt-4 text-sm uppercase">
                            <?php the_field('hero_button_text'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Hero Image -->
                <div class="hero-image flex-1 flex justify-center basis-full md:basis-[50%]">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', ['class' => 'h-auto w-full object-contain rounded-xl shadow-lg']); ?>
                    <?php endif; ?>
                </div>
            
            <?php
            endwhile;
        wp_reset_postdata();
        endif;
    ?>
    </div>
</section>
