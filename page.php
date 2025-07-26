<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();

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
<main id="primary" class="site-main">
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
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content/content', 'page');
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    endwhile;
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
<?php get_footer(); ?>