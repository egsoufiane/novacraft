<?php
/**
 * The template for displaying all single posts
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();
?>
<main id="primary" class="site-main">
    <?php
    $content_width = get_theme_mod('content_width', 'normal');
    $sidebar_position = get_theme_mod('sidebar_position', 'none'); // Default is now 'none'
    if ($content_width === 'wide') {
        $container_class = 'container-wide';
    } elseif ($content_width === 'narrow') {
        $container_class = 'container-narrow';
    } else {
        $container_class = 'container-normal';
    }
    ?>
    <div class="site-content <?php echo esc_attr($container_class); ?>">
        <div class="content-sidebar-wrapper" data-style="<?php echo esc_attr(get_theme_mod('container_style', 'boxed')); ?>">
            <div class="content-sidebar-inner">
                <?php if ($sidebar_position === 'left' || $sidebar_position === 'both') : ?>
                    <div class="sidebar-container sidebar-left-container">
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>
                <div class="main-content">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) :
                            the_post();
                            get_template_part('template-parts/content/content', 'single');

                            // If comments are open or we have at least one comment, load up the comment template.
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;

                            // Previous/next post navigation.
                            the_post_navigation(
                                array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'novacraft') . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'novacraft') . '</span> <span class="nav-title">%title</span>',
                                )
                            );
                        endwhile;
                    else :
                        ?>
                        <div class="no-posts-found">
                            <h2><?php esc_html_e('No Posts Found', 'novacraft'); ?></h2>
                            <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'novacraft'); ?></p>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
                <?php if ($sidebar_position === 'right' || $sidebar_position === 'both') : ?>
                    <div class="sidebar-container sidebar-right-container">
                        <?php get_sidebar('right'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();