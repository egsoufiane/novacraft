<?php
/**
 * The template for displaying the footer
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-4')) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar('footer-4'); ?>
                    </div>
                <?php endif; ?>
            </div><!-- .footer-widgets -->

            <div class="site-info">
                <div class="footer-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'container'      => false,
                        'menu_class'     => 'footer-nav-menu',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </div>

                <div class="copyright">
                    <?php
                    printf(
                        /* translators: %1$s: Current year, %2$s: Site name */
                        esc_html__('© %1$s %2$s. All rights reserved.', 'novacraft'),
                        date_i18n('Y'),
                        get_bloginfo('name')
                    );
                    ?>
                </div>
            </div><!-- .site-info -->
        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<button class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'novacraft'); ?>">
    <span class="screen-reader-text"><?php esc_html_e('Back to top', 'novacraft'); ?></span>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="19" x2="12" y2="5"></line>
        <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
</button>

<?php wp_footer(); ?>

</body>
</html> 