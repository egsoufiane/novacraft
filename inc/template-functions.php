<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function novacraft_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Add sidebar position class
    $sidebar_position = get_theme_mod('sidebar_position', 'none');
    if ($sidebar_position === 'none' || !is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    } else {
        $classes[] = 'sidebar-' . $sidebar_position;
    }

    return $classes;
}
add_filter('body_class', 'novacraft_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function novacraft_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'novacraft_pingback_header');

/**
 * Add custom classes to navigation menu items
 *
 * @param array $classes Array of the CSS classes that are applied to the menu item's <li> element.
 * @param object $item The current menu item.
 * @return array Modified CSS classes.
 */
function novacraft_nav_menu_css_class($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'novacraft_nav_menu_css_class', 10, 2);

/**
 * Add custom classes to navigation menu link attributes
 *
 * @param array $atts The HTML attributes applied to the menu item's <a> element.
 * @param object $item The current menu item.
 * @return array Modified HTML attributes.
 */
function novacraft_nav_menu_link_attributes($atts, $item) {
    if (in_array('current-menu-item', $item->classes)) {
        $atts['class'] = 'active';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'novacraft_nav_menu_link_attributes', 10, 2);

/**
 * Add custom classes to post navigation links
 *
 * @param string $output The adjacent post link.
 * @return string Modified adjacent post link.
 */
function novacraft_post_navigation_link($output) {
    $output = str_replace('rel="prev"', 'rel="prev" class="nav-previous"', $output);
    $output = str_replace('rel="next"', 'rel="next" class="nav-next"', $output);
    return $output;
}
add_filter('previous_post_link', 'novacraft_post_navigation_link');
add_filter('next_post_link', 'novacraft_post_navigation_link');

/**
 * Add custom classes to comment navigation links
 *
 * @param string $output The comment navigation link.
 * @return string Modified comment navigation link.
 */
function novacraft_comment_navigation_link($output) {
    $output = str_replace('rel="prev"', 'rel="prev" class="nav-previous"', $output);
    $output = str_replace('rel="next"', 'rel="next" class="nav-next"', $output);
    return $output;
}
add_filter('previous_comments_link', 'novacraft_comment_navigation_link');
add_filter('next_comments_link', 'novacraft_comment_navigation_link');

/**
 * Add custom classes to pagination links
 *
 * @param string $output The pagination link.
 * @return string Modified pagination link.
 */
function novacraft_pagination_link($output) {
    $output = str_replace('class="page-numbers"', 'class="page-numbers primary-button"', $output);
    $output = str_replace('class="prev page-numbers"', 'class="prev page-numbers primary-button"', $output);
    $output = str_replace('class="next page-numbers"', 'class="next page-numbers primary-button"', $output);
    return $output;
}
add_filter('paginate_links_output', 'novacraft_pagination_link');

/**
 * Add custom classes to comment form fields
 *
 * @param array $fields The comment form fields.
 * @return array Modified comment form fields.
 */
function novacraft_comment_form_fields($fields) {
    $fields['author'] = str_replace('class="comment-form-author"', 'class="comment-form-author form-group"', $fields['author']);
    $fields['email'] = str_replace('class="comment-form-email"', 'class="comment-form-email form-group"', $fields['email']);
    $fields['url'] = str_replace('class="comment-form-url"', 'class="comment-form-url form-group"', $fields['url']);
    
    // Only modify comment field if it exists
    if (isset($fields['comment'])) {
        $fields['comment'] = str_replace('class="comment-form-comment"', 'class="comment-form-comment form-group"', $fields['comment']);
    }
    
    return $fields;
}
add_filter('comment_form_default_fields', 'novacraft_comment_form_fields');

/**
 * Add custom classes to comment form comment field
 *
 * @param string $comment_field The comment field HTML.
 * @return string Modified comment field HTML.
 */
function novacraft_comment_form_comment_field($comment_field) {
    return str_replace('class="comment-form-comment"', 'class="comment-form-comment form-group"', $comment_field);
}
add_filter('comment_form_field_comment', 'novacraft_comment_form_comment_field');

/**
 * Add custom classes to comment form submit button
 *
 * @param string $submit_button The submit button HTML.
 * @return string Modified submit button HTML.
 */
function novacraft_comment_form_submit_button($submit_button) {
    return str_replace('class="submit"', 'class="submit primary-button"', $submit_button);
}
add_filter('comment_form_submit_button', 'novacraft_comment_form_submit_button');

/**
 * Add custom classes to search form
 *
 * @param string $form The search form HTML.
 * @return string Modified search form HTML.
 */
function novacraft_search_form($form) {
    $form = str_replace('class="search-form"', 'class="search-form form-inline"', $form);
    $form = str_replace('class="search-field"', 'class="search-field form-control"', $form);
    $form = str_replace('class="search-submit"', 'class="search-submit primary-button"', $form);
    return $form;
}
add_filter('get_search_form', 'novacraft_search_form');

/**
 * Add custom classes to password form
 *
 * @param string $output The password form HTML.
 * @return string Modified password form HTML.
 */
function novacraft_password_form($output) {
    $output = str_replace('class="post-password-form"', 'class="post-password-form form-inline"', $output);
    $output = str_replace('class="post-password-form"', 'class="post-password-form form-control"', $output);
    $output = str_replace('class="post-password-form"', 'class="post-password-form button"', $output);
    return $output;
}
add_filter('the_password_form', 'novacraft_password_form');

/**
 * Add custom classes to calendar widget
 *
 * @param string $calendar The calendar HTML.
 * @return string Modified calendar HTML.
 */
function novacraft_calendar_widget($calendar) {
    $calendar = str_replace('class="wp-calendar"', 'class="wp-calendar table"', $calendar);
    return $calendar;
}
add_filter('get_calendar', 'novacraft_calendar_widget');

/**
 * Add custom classes to tag cloud widget
 *
 * @param string $output The tag cloud HTML.
 * @return string Modified tag cloud HTML.
 */
function novacraft_tag_cloud_widget($output) {
    $output = str_replace('class="tag-cloud-link"', 'class="tag-cloud-link badge"', $output);
    return $output;
}
add_filter('wp_tag_cloud', 'novacraft_tag_cloud_widget');

/**
 * Add custom classes to recent posts widget
 *
 * @param string $output The recent posts widget HTML.
 * @return string Modified recent posts widget HTML.
 */
function novacraft_recent_posts_widget($output) {
    $output = str_replace('class="recentposts"', 'class="recentposts list-group"', $output);
    $output = str_replace('class="recentpost"', 'class="recentpost list-group-item"', $output);
    return $output;
}
add_filter('widget_recent_posts_output', 'novacraft_recent_posts_widget');

/**
 * Add custom classes to recent comments widget
 *
 * @param string $output The recent comments widget HTML.
 * @return string Modified recent comments widget HTML.
 */
function novacraft_recent_comments_widget($output) {
    $output = str_replace('class="recentcomments"', 'class="recentcomments list-group"', $output);
    $output = str_replace('class="recentcomment"', 'class="recentcomment list-group-item"', $output);
    return $output;
}
add_filter('widget_recent_comments_output', 'novacraft_recent_comments_widget');

/**
 * Add custom classes to archives widget
 *
 * @param string $output The archives widget HTML.
 * @return string Modified archives widget HTML.
 */
function novacraft_archives_widget($output) {
    $output = str_replace('class="archives"', 'class="archives list-group"', $output);
    $output = str_replace('class="archive"', 'class="archive list-group-item"', $output);
    return $output;
}
add_filter('widget_archives_output', 'novacraft_archives_widget');

/**
 * Add custom classes to categories widget
 *
 * @param string $output The categories widget HTML.
 * @return string Modified categories widget HTML.
 */
function novacraft_categories_widget($output) {
    $output = str_replace('class="categories"', 'class="categories list-group"', $output);
    $output = str_replace('class="category"', 'class="category list-group-item"', $output);
    return $output;
}
add_filter('widget_categories_output', 'novacraft_categories_widget');

/**
 * Add custom classes to pages widget
 *
 * @param string $output The pages widget HTML.
 * @return string Modified pages widget HTML.
 */
function novacraft_pages_widget($output) {
    $output = str_replace('class="pages"', 'class="pages list-group"', $output);
    $output = str_replace('class="page"', 'class="page list-group-item"', $output);
    return $output;
}
add_filter('widget_pages_output', 'novacraft_pages_widget');

/**
 * Add custom classes to meta widget
 *
 * @param string $output The meta widget HTML.
 * @return string Modified meta widget HTML.
 */
function novacraft_meta_widget($output) {
    $output = str_replace('class="meta"', 'class="meta list-group"', $output);
    $output = str_replace('class="meta-item"', 'class="meta-item list-group-item"', $output);
    return $output;
}
add_filter('widget_meta_output', 'novacraft_meta_widget');

/**
 * Add custom classes to RSS widget
 *
 * @param string $output The RSS widget HTML.
 * @return string Modified RSS widget HTML.
 */
function novacraft_rss_widget($output) {
    $output = str_replace('class="rss"', 'class="rss list-group"', $output);
    $output = str_replace('class="rss-item"', 'class="rss-item list-group-item"', $output);
    return $output;
}
add_filter('widget_rss_output', 'novacraft_rss_widget');

/**
 * Add custom classes to text widget
 *
 * @param string $output The text widget HTML.
 * @return string Modified text widget HTML.
 */
function novacraft_text_widget($output) {
    $output = str_replace('class="textwidget"', 'class="textwidget well"', $output);
    return $output;
}
add_filter('widget_text_output', 'novacraft_text_widget');

/**
 * Add custom classes to navigation menu
 *
 * @param string $output The navigation menu HTML.
 * @return string Modified navigation menu HTML.
 */
function novacraft_nav_menu($output) {
    $output = str_replace('class="menu"', 'class="menu nav"', $output);
    $output = str_replace('class="menu-item"', 'class="menu-item nav-item"', $output);
    $output = str_replace('class="menu-item-has-children"', 'class="menu-item-has-children dropdown"', $output);
    $output = str_replace('class="sub-menu"', 'class="sub-menu dropdown-menu"', $output);
    return $output;
}
add_filter('wp_nav_menu', 'novacraft_nav_menu');

/**
 * Add custom classes to navigation menu items
 *
 * @param string $output The navigation menu item HTML.
 * @return string Modified navigation menu item HTML.
 */
function novacraft_nav_menu_item($output) {
    $output = str_replace('class="menu-item"', 'class="menu-item nav-item"', $output);
    $output = str_replace('class="menu-item-has-children"', 'class="menu-item-has-children dropdown"', $output);
    return $output;
}
add_filter('wp_nav_menu_item', 'novacraft_nav_menu_item');

/**
 * Add custom classes to navigation menu links
 *
 * @param string $output The navigation menu link HTML.
 * @return string Modified navigation menu link HTML.
 */
function novacraft_nav_menu_link($output) {
    $output = str_replace('class="menu-item-link"', 'class="menu-item-link nav-link"', $output);
    $output = str_replace('class="menu-item-has-children-link"', 'class="menu-item-has-children-link nav-link dropdown-toggle"', $output);
    return $output;
}
add_filter('wp_nav_menu_item_link', 'novacraft_nav_menu_link');

/**
 * Add custom classes to navigation menu sub-menu
 *
 * @param string $output The navigation menu sub-menu HTML.
 * @return string Modified navigation menu sub-menu HTML.
 */
function novacraft_nav_menu_submenu($output) {
    $output = str_replace('class="sub-menu"', 'class="sub-menu dropdown-menu"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu', 'novacraft_nav_menu_submenu');

/**
 * Add custom classes to navigation menu sub-menu items
 *
 * @param string $output The navigation menu sub-menu item HTML.
 * @return string Modified navigation menu sub-menu item HTML.
 */
function novacraft_nav_menu_submenu_item($output) {
    $output = str_replace('class="menu-item"', 'class="menu-item dropdown-item"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu_item', 'novacraft_nav_menu_submenu_item');

/**
 * Add custom classes to navigation menu sub-menu links
 *
 * @param string $output The navigation menu sub-menu link HTML.
 * @return string Modified navigation menu sub-menu link HTML.
 */
function novacraft_nav_menu_submenu_link($output) {
    $output = str_replace('class="menu-item-link"', 'class="menu-item-link dropdown-item"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu_item_link', 'novacraft_nav_menu_submenu_link');

/**
 * Add custom classes to navigation menu sub-menu sub-menu
 *
 * @param string $output The navigation menu sub-menu sub-menu HTML.
 * @return string Modified navigation menu sub-menu sub-menu HTML.
 */
function novacraft_nav_menu_submenu_submenu($output) {
    $output = str_replace('class="sub-menu"', 'class="sub-menu dropdown-menu"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu_submenu', 'novacraft_nav_menu_submenu_submenu');

/**
 * Add custom classes to navigation menu sub-menu sub-menu items
 *
 * @param string $output The navigation menu sub-menu sub-menu item HTML.
 * @return string Modified navigation menu sub-menu sub-menu item HTML.
 */
function novacraft_nav_menu_submenu_submenu_item($output) {
    $output = str_replace('class="menu-item"', 'class="menu-item dropdown-item"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu_submenu_item', 'novacraft_nav_menu_submenu_submenu_item');

/**
 * Add custom classes to navigation menu sub-menu sub-menu links
 *
 * @param string $output The navigation menu sub-menu sub-menu link HTML.
 * @return string Modified navigation menu sub-menu sub-menu link HTML.
 */
function novacraft_nav_menu_submenu_submenu_link($output) {
    $output = str_replace('class="menu-item-link"', 'class="menu-item-link dropdown-item"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu_submenu_item_link', 'novacraft_nav_menu_submenu_submenu_link');

/**
 * Add custom classes to navigation menu sub-menu sub-menu sub-menu
 *
 * @param string $output The navigation menu sub-menu sub-menu sub-menu HTML.
 * @return string Modified navigation menu sub-menu sub-menu sub-menu HTML.
 */
function novacraft_nav_menu_submenu_submenu_submenu($output) {
    $output = str_replace('class="sub-menu"', 'class="sub-menu dropdown-menu"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu_submenu_submenu', 'novacraft_nav_menu_submenu_submenu_submenu');

/**
 * Add custom classes to navigation menu sub-menu sub-menu sub-menu items
 *
 * @param string $output The navigation menu sub-menu sub-menu sub-menu item HTML.
 * @return string Modified navigation menu sub-menu sub-menu sub-menu item HTML.
 */
function novacraft_nav_menu_submenu_submenu_submenu_item($output) {
    $output = str_replace('class="menu-item"', 'class="menu-item dropdown-item"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu_submenu_submenu_item', 'novacraft_nav_menu_submenu_submenu_submenu_item');

/**
 * Add custom classes to navigation menu sub-menu sub-menu sub-menu links
 *
 * @param string $output The navigation menu sub-menu sub-menu sub-menu link HTML.
 * @return string Modified navigation menu sub-menu sub-menu sub-menu link HTML.
 */
function novacraft_nav_menu_submenu_submenu_submenu_link($output) {
    $output = str_replace('class="menu-item-link"', 'class="menu-item-link dropdown-item"', $output);
    return $output;
}
add_filter('wp_nav_menu_submenu_submenu_submenu_item_link', 'novacraft_nav_menu_submenu_submenu_submenu_link'); 