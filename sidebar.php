<?php
/**
 * The sidebar containing the main widget area
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area" data-style="<?php echo esc_attr(get_theme_mod('sidebar_style', 'boxed')); ?>">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary --> 