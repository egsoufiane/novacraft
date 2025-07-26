<?php
/**
 * The sidebar containing the right widget area
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Debug information
$is_active = is_active_sidebar('sidebar-right');
$widgets = wp_get_sidebars_widgets();
$right_widgets = isset($widgets['sidebar-right']) ? $widgets['sidebar-right'] : array();

if (!$is_active) {
    return;
}
?>

<aside id="secondary-right" class="widget-area" data-style="<?php echo esc_attr(get_theme_mod('sidebar_style', 'boxed')); ?>">
    <?php dynamic_sidebar('sidebar-right'); ?>
</aside><!-- #secondary-right --> 