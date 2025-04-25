<section class="site-about py-20 px-20 bg-white font-[Manrope]">
    <div class="container about-container two-columns mx-auto max-w-screen-xl flex flex-col md:flex-row items-center gap-10">

        <?php
        $about_query = new WP_Query([
            'post_type'      => 'about_section',
            'posts_per_page' => 1,
        ]);

        if ($about_query->have_posts()) :
            while ($about_query->have_posts()) : $about_query->the_post();

                $highlighted_word = get_field('highlighted_word');
                ?>

                <!-- About Text -->
                <div class="about-content flex-1 space-y-6 text-center md:text-left basis-full md:basis-1/2">
                    <h2 class="about-title text-4xl md:text-5xl font-semibold leading-tight uppercase md:w-[80%] ">
                        <?php
                        $title = get_the_title();
                        if ($highlighted_word) {
                            // Insert the highlighted word wrapped in <span>
                            echo str_replace(
                                $highlighted_word,
                                '<span class="text-[#D87D4A]">' . esc_html($highlighted_word) . '</span>',
                                esc_html($title)
                            );
                        } else {
                            // No highlighted word set, just show title normally
                            echo esc_html($title);
                        }
                        ?>
                    </h2>

                    <?php
                    $content = get_the_content(null, false);
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(['<p>', '</p>'], '', $content); // Remove any leftover <p> or </p> tags

                    if (!empty($content)) :
                        ?>
                        <p class="about-description text-black/50 md:w-[80%] pb-5">
                            <?php echo wp_kses_post($content); ?>
                        </p>
                    <?php endif; ?>

                </div>

                <!-- About Image -->
                <div class="about-image flex-1 flex justify-center basis-full md:basis-1/2">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', ['class' => 'h-auto w-[100%] object-contain rounded-lg shadow-md']); ?>
                    <?php endif; ?>
                </div>

                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>
