<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header bg-[#141414] text-white font-[Manrope]">
    <div class="container header-container mx-auto max-w-screen-xl flex items-center justify-between py-9 px-8 border-b border-b-[rgba(255,255,255,0.2)]">

        <!-- Logo -->
        <div class="site-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <?php
                $site_setting = new WP_Query([
                    'post_type'      => 'site_setting',
                    'posts_per_page' => 1,
                ]);

                if ($site_setting->have_posts()) :
                    while ($site_setting->have_posts()) : $site_setting->the_post();
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('full', ['class' => 'relative top-[2px]']);
                        } else {
                            bloginfo('name');
                        }
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="site-nav hidden md:flex space-x-8 uppercase text-sm tracking-widest list-none font-bold">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu flex space-x-8 list-none',
                'container'      => false,
                'items_wrap'     => '%3$s', // Only list items (no ul wrapper)
                'link_before'    => '<span class="hover:text-[#D87D4A] transition-colors duration-200">',
                'link_after'     => '</span>',
            ]);
            ?>
        </nav>

        <!-- Mobile Menu Button -->
        <button id="menu-toggle" class="md:hidden focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>


        <!-- Cart Icon -->
        <div class="site-cart ml-4">
            <div x-data="{ cartOpen: false }" class="relative">
                <a @click="cartOpen = !cartOpen" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M20.925 3.641h-3.73l-.571-1.659A2.69 2.69 0 0 0 14.064.5H8.935a2.69 2.69 0 0 0-2.56 1.482l-.571 1.659h-3.73A2.07 2.07 0 0 0 0 5.705v1.093a.83.83 0 0 0 .825.834h.863l2.266 10.3a1.66 1.66 0 0 0 1.61 1.286h11.912a1.66 1.66 0 0 0 1.61-1.286l2.267-10.3h.862a.83.83 0 0 0 .825-.834V5.705a2.07 2.07 0 0 0-2.07-2.064ZM8.935 2.167h5.13a1.032 1.032 0 0 1 .981.7l.428 1.241H7.526l.429-1.24a1.032 1.032 0 0 1 .98-.701Zm8.537 16.45a.496.496 0 0 1-.481.384H5.078a.496.496 0 0 1-.481-.384L2.431 7.632h18.14l-3.1 10.985Z"/>
                    </svg>
                </a>

                <div 
                    x-show="cartOpen"
                    x-transition
                    @click.outside="cartOpen = false"
                    class="absolute right-0 top-12 bg-white text-black shadow-xl w-96 rounded-lg p-6 z-50"
                >
                    <div id="aam-mini-cart-inner">
                        <?php get_template_part('template-parts/cart/mini-cart'); ?>
                    </div>
                </div>

                <!-- Backdrop overlay -->
                <div 
                    x-show="cartOpen"
                    x-transition.opacity
                    @click="cartOpen = false"
                    class="fixed inset-0 bg-black bg-opacity-50 z-40"
                ></div>

            </div>
        </div>

    </div> <!-- .header-container -->

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="hidden flex flex-col items-center py-4 space-y-4 uppercase text-sm tracking-widest md:hidden list-none">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-menu flex flex-col items-center space-y-4',
            'container'      => false,
            'items_wrap'     => '%3$s', // Only list items
            'link_before'    => '<span class="hover:text-[#D87D4A] transition-colors duration-200">',
            'link_after'     => '</span>',
        ]);
        ?>
    </div>

</header>

