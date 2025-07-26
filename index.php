    <?php
    /**
     * The main template file
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package NovaCraft
     */

    if (!defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }

    get_header();

    // Get post layout settings
$post_layout = get_theme_mod('post_layout', 'list');
$grid_columns = get_theme_mod('grid_columns', '3');
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
            <div class="content-sidebar-wrapper" data-style="<?php echo esc_attr(get_theme_mod('container_style', 'boxed')); ?>" data-layout="<?php echo esc_attr($post_layout); ?>">
                <div class="content-sidebar-inner">
                    <?php if ($sidebar_position === 'left' || $sidebar_position === 'both') : ?>
                        <div class="sidebar-container sidebar-left-container">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="main-content">
                        <?php if (have_posts()) : ?>
                            <div class="posts-container posts-<?php echo esc_attr($post_layout); ?> <?php echo $post_layout === 'grid' ? 'grid-columns-' . esc_attr($grid_columns) : ''; ?>">
                                <?php
                                while (have_posts()) :
                                    the_post();
                                    get_template_part('template-parts/content/content', get_post_type());
                                endwhile;
                                ?>
                            </div>
                            <?php
                            the_posts_pagination(array(
                                'mid_size' => 2,
                                'prev_text' => __('Previous', 'novacraft'),
                                'next_text' => __('Next', 'novacraft'),
                            ));
                            ?>
                        <?php else : ?>
                            <?php get_template_part('template-parts/content/content', 'none'); ?>
                        <?php endif; ?>
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