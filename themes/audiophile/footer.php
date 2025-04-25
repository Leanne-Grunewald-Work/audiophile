<footer class="site-footer bg-black text-white py-20 px-20 font-[Manrope]">
    <div class="container container-footer max-w-screen-xl mx-auto space-y-10">

        <?php
        $site_setting = new WP_Query([
            'post_type'      => 'site_setting',
            'posts_per_page' => 1,
        ]);

        if ($site_setting->have_posts()) :
            while ($site_setting->have_posts()) : $site_setting->the_post();
                $about_text = get_field('about_text');
                $facebook_link = get_field('facebook_link');
                $twitter_link = get_field('twitter_link');
                $instagram_link = get_field('instagram_link');
        ?>

        <!-- Row 1: Logo and Navigation -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block relative">
                <hr class="bg-[#D87D4A] w-[100%] absolute top-[-320%] h-[5px]"/>
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('full', ['class' => 'relative top-[2px]']);
                } else {
                    bloginfo('name');
                } ?>
            </a>

            <!-- Navigation -->
            <nav class="w-full md:w-auto font-bold">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'flex flex-col md:flex-row gap-4 md:gap-8 justify-end text-sm tracking-widest uppercase ',
                    'container'      => false,
                    'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                    'link_before'    => '<span class="hover:text-[#D87D4A] transition-colors duration-200">',
                    'link_after'     => '</span>',
                ]);
                ?>
            </nav>
        </div>

        <!-- Row 2: About and Socials -->
        <div class="flex flex-col md:flex-row justify-between gap-8">
            <!-- About Text -->
            <div class="max-w-md text-sm text-white/50 leading-relaxed">
                <?php echo esc_html($about_text); ?>
            </div>

            <!-- Social Icons -->
            <div class="footer-socials flex gap-6 justify-center md:justify-end items-end">
                <?php if ($facebook_link) : ?>
                    <a href="<?php echo esc_url($facebook_link); ?>" target="_blank" aria-label="Facebook" class="group p-2 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-white group-hover:fill-[#D87D4A] transition" viewBox="0 0 24 24">
                        <path d="M22.675 0h-21.35C.592 0 0 .592 0 1.325v21.351C0 23.408.592 24 1.325 24h11.495V14.708h-3.13v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.658-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116C23.408 24 24 23.408 24 22.675V1.325C24 .592 23.408 0 22.675 0z"/>
                        </svg>
                    </a>

                <?php endif; ?>
                <?php if ($twitter_link) : ?>
                    <a href="<?php echo esc_url($twitter_link); ?>" target="_blank" aria-label="Twitter" class="group p-2 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-white group-hover:fill-[#D87D4A] transition" viewBox="0 0 24 24">
                            <path d="M24 2.557a9.857 9.857 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724 9.867 9.867 0 0 1-3.127 1.195 4.918 4.918 0 0 0-8.38 4.482A13.944 13.944 0 0 1 1.671 1.15 4.918 4.918 0 0 0 3.195 7.72 4.902 4.902 0 0 1 .964 7.13v.062a4.918 4.918 0 0 0 3.946 4.827 4.897 4.897 0 0 1-2.212.084 4.92 4.92 0 0 0 4.6 3.417A9.868 9.868 0 0 1 0 17.538 13.94 13.94 0 0 0 7.548 20c9.057 0 14.009-7.496 14.009-13.986 0-.213-.005-.425-.014-.636A10.012 10.012 0 0 0 24 2.557z"/>
                        </svg>
                    </a>
                <?php endif; ?>
                <?php if ($instagram_link) : ?>
                    <a href="<?php echo esc_url($instagram_link); ?>" target="_blank" aria-label="Instagram" class="group p-2 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-white group-hover:fill-[#D87D4A] transition" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.056 1.97.24 2.428.403a4.92 4.92 0 0 1 1.777 1.03 4.918 4.918 0 0 1 1.03 1.777c.163.458.347 1.258.403 2.428.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.056 1.17-.24 1.97-.403 2.428a4.92 4.92 0 0 1-1.03 1.777 4.918 4.918 0 0 1-1.777 1.03c-.458.163-1.258.347-2.428.403-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.056-1.97-.24-2.428-.403a4.92 4.92 0 0 1-1.777-1.03 4.918 4.918 0 0 1-1.03-1.777c-.163-.458-.347-1.258-.403-2.428C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.056-1.17.24-1.97.403-2.428a4.92 4.92 0 0 1 1.03-1.777 4.918 4.918 0 0 1 1.777-1.03c.458-.163 1.258-.347 2.428-.403C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.736 0 8.332.014 7.052.072 5.775.13 4.802.326 4.003.63a6.884 6.884 0 0 0-2.49 1.636A6.888 6.888 0 0 0 .63 4.002C.326 4.802.13 5.775.072 7.052.014 8.332 0 8.736 0 12c0 3.264.014 3.668.072 4.948.058 1.277.254 2.25.558 3.05a6.888 6.888 0 0 0 1.636 2.49 6.884 6.884 0 0 0 2.49 1.636c.8.304 1.773.5 3.05.558C8.332 23.986 8.736 24 12 24s3.668-.014 4.948-.072c1.277-.058 2.25-.254 3.05-.558a6.888 6.888 0 0 0 2.49-1.636 6.884 6.884 0 0 0 1.636-2.49c.304-.8.5-1.773.558-3.05.058-1.28.072-1.684.072-4.948s-.014-3.668-.072-4.948c-.058-1.277-.254-2.25-.558-3.05a6.888 6.888 0 0 0-1.636-2.49A6.884 6.884 0 0 0 19.998.63c-.8-.304-1.773-.5-3.05-.558C15.668.014 15.264 0 12 0z"/>
                        <path d="M12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998z"/>
                        <circle cx="18.406" cy="5.594" r="1.44"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Row 3: Copyright -->
        <div>
            <p class="text-sm text-white/50 font-bold">
                &copy; <?php echo date('Y'); ?> Audiophile. All Rights Reserved.
            </p>
        </div>

        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
</footer>


<?php wp_footer(); ?>
</body>
</html>