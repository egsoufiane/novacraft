<?php
/**
 * Template part for displaying single posts
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <div class="entry-meta">
            <?php
            novacraft_posted_on();
            novacraft_posted_by();
            ?>
        </div>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <footer class="entry-footer">
        <?php novacraft_entry_footer(); ?>
    </footer>
</article> 