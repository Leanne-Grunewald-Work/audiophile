<?php
add_action('wp_footer', function () {
    if (is_product()) {
        $base = plugin_dir_url(__FILE__);
        ?>
        <script type="module">
            import { Fancybox } from "<?php echo esc_url($base . 'assets/fancybox/fancybox.esm.js'); ?>";
            Fancybox.bind("[data-fancybox='gallery']", {
                Thumbs: false,
                Toolbar: true
            });
        </script>
        <?php
    }
});
