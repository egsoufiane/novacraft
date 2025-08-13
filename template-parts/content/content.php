<?php
/**
 * Template part for displaying posts
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Get post style settings
$post_style = get_theme_mod('post_style', 'boxed');
$post_bg_color = get_theme_mod('post_bg_color', '#ffffff');
$post_border_radius = get_theme_mod('post_border_radius', '8');
$post_padding = get_theme_mod('post_padding', '24');
// Get post title color if set, else empty string
$post_title_color = get_theme_mod('post_title_color', '');
$post_meta_color = get_theme_mod('post_meta_color', '#6b7280');

// Set inline styles
$article_style = '';
if ($post_style === 'boxed') {
    $article_style = sprintf(
        'background-color: %s; border-radius: %spx; padding: %spx;',
        esc_attr($post_bg_color),
        esc_attr($post_border_radius),
        esc_attr($post_padding)
    );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-archive-post'); ?> data-style="<?php echo esc_attr($post_style); ?>" style="<?php echo esc_attr($article_style); ?>">
    <header class="entry-header">
        <?php
        // If post_title_color is set, use inline style for this post only. Otherwise, use CSS variable.
        if ($post_title_color !== '') {
            the_title('<h2 class="entry-title" style="color: ' . esc_attr($post_title_color) . ';"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        } else {
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        }
        ?>

        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta" style="color: <?php echo esc_attr($post_meta_color); ?>;">
                <?php
                novacraft_posted_on();
                novacraft_posted_by();
                ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php 
        if (is_singular()) {
            the_content();
        } else {
            the_excerpt();
            echo '<a href="' . esc_url(get_permalink()) . '" class="primary-button">' . esc_html__('Read More', 'novacraft') . '</a>';
        }
        ?>
    </div>

    <footer class="entry-footer">
        <?php novacraft_entry_footer(); ?>
    </footer>
</article> 