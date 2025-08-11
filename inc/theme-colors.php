<?php
/**
 * NovaCraft Theme Colors Integration
 *
 * This file handles theme color synchronization and palette setup for NovaCraft.
 * It syncs theme colors with Elementor and the WordPress block editor.
 *
 * @package NovaCraft
 */

/**
 * Elementor Kit Colors - Optimized Cache Version
 */
// Update Elementor Kit with Theme Colors
add_action('elementor/init', 'update_elementor_kit_colors', 25); // Increased priority
add_action('customize_save_after', 'update_elementor_kit_colors');
add_action('update_option_theme_mods_' . get_option('stylesheet'), 'update_elementor_kit_colors');
add_action('after_switch_theme', 'update_elementor_kit_colors');

function update_elementor_kit_colors() {
    static $has_run = false;
    if ($has_run) return;
    $has_run = true;

    // Check if Elementor is properly loaded
    if (!class_exists('\Elementor\Plugin') || 
        !\Elementor\Plugin::$instance || 
        !\Elementor\Plugin::$instance->documents) {
        return;
    }
    
    $kit_id = get_option('elementor_active_kit');
    if (!$kit_id) return;
    
    // Get the kit safely
    $kit = Elementor\Plugin::$instance->documents->get($kit_id, false);
    if (!$kit || is_wp_error($kit)) return;
    
    $kit_settings = $kit->get_settings();
    
    // Define theme colors with semantic IDs
    $theme_colors = [
        'primary' => [
            'id' => 'primary',
            'title' => 'Primary Color',
            'color' => get_theme_mod('primary_color', '#2563eb')
        ],
        'secondary' => [
            'id' => 'secondary',
            'title' => 'Secondary Color',
            'color' => get_theme_mod('secondary_color', '#475569')
        ],
        'accent' => [
            'id' => 'accent',
            'title' => 'Accent Color',
            'color' => get_theme_mod('accent_color', '#f59e0b')
        ],
        'text' => [
            'id' => 'text',
            'title' => 'Text Color',
            'color' => get_theme_mod('text_color', '#1f2937')
        ],
        'bg' => [
            'id' => 'bg',
            'title' => 'Background Color',
            'color' => get_theme_mod('bg_color', '#cececec7')
        ],
        'content-bg' => [
            'id' => 'contentbg',
            'title' => 'Content Background',
            'color' => get_theme_mod('content_bg_color', '#ffffff')
        ],
        'light' => [
            'id' => 'light',
            'title' => 'Light Color',
            'color' => get_theme_mod('light_color', '#f3f4f6')
        ],
        'dark' => [
            'id' => 'dark',
            'title' => 'Dark Color',
            'color' => get_theme_mod('dark_color', '#111827')
        ],
    ];
    
    // Get current custom colors
    $current_colors = $kit_settings['custom_colors'] ?? [];
    
    // Create a new color array with only theme colors
    $new_colors = [];
    
    // Add theme colors first
    foreach ($theme_colors as $color_data) {
        $new_colors[] = [
            '_id' => $color_data['id'],
            'title' => $color_data['title'],
            'color' => $color_data['color']
        ];
    }
    
    // Preserve non-theme custom colors
    $theme_ids = array_column($theme_colors, 'id');
    foreach ($current_colors as $color) {
        if (!in_array($color['_id'], $theme_ids)) {
            $new_colors[] = $color;
        }
    }
    
    // Only update if there are changes
    $current_colors_str = json_encode($current_colors);
    $new_colors_str = json_encode($new_colors);
    if ($current_colors_str === $new_colors_str) return;
    
    $kit_settings['custom_colors'] = $new_colors;
    
    // Save settings
    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
    $page_settings_manager->save_settings($kit_settings, $kit_id);
    
    // Enhanced cache clearing
    clear_elementor_caches();
}

// Enhanced cache clearing function
function clear_elementor_caches() {
    // Clear Elementor files cache
    if (class_exists('\Elementor\Plugin') &&
        isset(\Elementor\Plugin::$instance->files_manager) &&
        method_exists(\Elementor\Plugin::$instance->files_manager, 'clear_cache')) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }
    
    // Clear Elementor breakpoints
    if (class_exists('\Elementor\Core\Breakpoints\Manager')) {
        \Elementor\Plugin::$instance->breakpoints->refresh();
    }
    
    // Flush WordPress object cache
    wp_cache_flush();
    
    // Clear browser cache via cache-control headers
    add_action('send_headers', function() {
        if (!headers_sent()) {
            header('Cache-Control: no-cache, must-revalidate, max-age=0');
            header('Pragma: no-cache');
            header('Expires: ' . gmdate('D, d M Y H:i:s', time() - 3600) . ' GMT');
        }
    });
    
    // Add version parameter to Elementor CSS files
    add_filter('elementor/frontend/builder_content_data', function($data) {
        $data['editSettings']['css_ver'] = time();
        return $data;
    });
    
    // Clear popular cache plugins
    // WP Super Cache
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }
    
    // W3 Total Cache
    if (function_exists('w3tc_flush_all')) {
        w3tc_flush_all();
    }
    
    // WP Rocket
    if (function_exists('rocket_clean_domain')) {
        rocket_clean_domain();
    }
    
    // LiteSpeed Cache
    if (class_exists('LiteSpeed_Cache_API') && method_exists('LiteSpeed_Cache_API', 'purge_all')) {
        LiteSpeed_Cache_API::purge_all();
    }
    
    // Autoptimize
    if (class_exists('autoptimizeCache')) {
        autoptimizeCache::clearall();
    }
}

// Optimized cache clearing only for Elementor
add_action('customize_save_after', function() {
    clear_elementor_caches();
}, 25);

/**
 * Add Editor Color Palette
 * This function adds a custom color palette to the block editor.
 */
add_action('after_setup_theme', function () {
    add_theme_support('editor-color-palette', [
        [
            'name'  => __('Primary', 'novacraft'),
            'slug'  => 'primary',
            'color' => get_theme_mod('primary_color', '#2563eb'),
        ],
        [
            'name'  => __('Secondary', 'novacraft'),
            'slug'  => 'secondary',
            'color' => get_theme_mod('secondary_color', '#475569'),
        ],
        [
            'name'  => __('Accent', 'novacraft'),
            'slug'  => 'accent',
            'color' => get_theme_mod('accent_color', '#f59e0b'),
        ],

        [
            'name'  => __('Content Background', 'novacraft'),
            'slug'  => 'content-bg',
            'color' => get_theme_mod('content_bg_color', '#ffffff'),
        ],
        [
            'name'  => __('Background', 'novacraft'),
            'slug'  => 'bg',
            'color' => get_theme_mod('bg_color', '#cececec7'),
        ],
        [
            'name'  => __('Text', 'novacraft'),
            'slug'  => 'text',
            'color' => get_theme_mod('text_color', '#1f2937'),
        ],
        [
            'name'  => __('Dark', 'novacraft'),
            'slug'  => 'dark',
            'color' => get_theme_mod('dark_color', '#111827'),
        ],
        [
            'name'  => __('Light', 'novacraft'),
            'slug'  => 'light',
            'color' => get_theme_mod('light_color', '#f3f4f6'),
        ],
    ]);
});

