<?php
/**
 * NovaCraft functions and definitions
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!defined('NOVACRAFT_VERSION')) {
    // Replace the version number of the theme on each release.
    define('NOVACRAFT_VERSION', '1.0.16');
}

// Define theme directory URI
define('NOVACRAFT_URI', get_template_directory_uri());

// Include required files
require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/demo-import.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function novacraft_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('novacraft', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary Menu', 'novacraft'),
            'footer'  => esc_html__('Footer Menu', 'novacraft'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Add support for custom colors.
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => esc_html__('Primary', 'novacraft'),
            'slug'  => 'primary',
            'color' => '#007bff',
        ),
        array(
            'name'  => esc_html__('Secondary', 'novacraft'),
            'slug'  => 'secondary',
            'color' => '#6c757d',
        ),
        array(
            'name'  => esc_html__('Accent', 'novacraft'),
            'slug'  => 'accent',
            'color' => '#28a745',
        ),
        array(
            'name'  => esc_html__('Light', 'novacraft'),
            'slug'  => 'light',
            'color' => '#f8f9fa',
        ),
        array(
            'name'  => esc_html__('Dark', 'novacraft'),
            'slug'  => 'dark',
            'color' => '#343a40',
        ),
    ));

    // Add support for custom font sizes.
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'novacraft'),
            'size' => 14,
            'slug' => 'small',
        ),
        array(
            'name' => esc_html__('Normal', 'novacraft'),
            'size' => 16,
            'slug' => 'normal',
        ),
        array(
            'name' => esc_html__('Large', 'novacraft'),
            'size' => 20,
            'slug' => 'large',
        ),
        array(
            'name' => esc_html__('Larger', 'novacraft'),
            'size' => 24,
            'slug' => 'larger',
        ),
    ));
}
add_action('after_setup_theme', 'novacraft_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function novacraft_content_width() {
    $GLOBALS['content_width'] = apply_filters('novacraft_content_width', 1200);
}
add_action('after_setup_theme', 'novacraft_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function novacraft_widgets_init() {
    // Debug information
    error_log('Registering sidebars in NovaCraft theme');
    
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar Left', 'novacraft'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here for the left sidebar.', 'novacraft'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar Right', 'novacraft'),
            'id'            => 'sidebar-right',
            'description'   => esc_html__('Add widgets here for the right sidebar.', 'novacraft'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer 1', 'novacraft'),
            'id'            => 'footer-1',
            'description'   => esc_html__('Add footer widgets here.', 'novacraft'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer 2', 'novacraft'),
            'id'            => 'footer-2',
            'description'   => esc_html__('Add footer widgets here.', 'novacraft'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer 3', 'novacraft'),
            'id'            => 'footer-3',
            'description'   => esc_html__('Add footer widgets here.', 'novacraft'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer 4', 'novacraft'),
            'id'            => 'footer-4',
            'description'   => esc_html__('Add footer widgets here.', 'novacraft'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'novacraft_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function novacraft_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null);
    
    // Enqueue main stylesheet
    wp_enqueue_style('novacraft-style', get_stylesheet_uri(), array(), NOVACRAFT_VERSION);
    
    // Enqueue navigation script
    wp_enqueue_script('novacraft-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NOVACRAFT_VERSION, true);
    
    // Enqueue main script
    wp_enqueue_script('novacraft-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), NOVACRAFT_VERSION, true);
    
    // Enqueue imagesLoaded script
    wp_enqueue_script('imagesloaded', 'https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js', array('jquery'), '5.0.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'novacraft_scripts');

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Sanitize float.
 *
 * @param float $number Float number to sanitize.
 * @return float Sanitized float number.
 */
function novacraft_sanitize_float($number) {
    return filter_var($number, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

/**
 * Sanitize sidebar position.
 *
 * @param string $position Sidebar position.
 * @return string Sanitized sidebar position.
 */
function novacraft_sanitize_sidebar_position($position) {
    if (!in_array($position, array('left', 'right', 'both', 'none'), true)) {
        return 'none';
    }
    return $position;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function novacraft_customize_preview_js() {
    wp_enqueue_script('novacraft-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('jquery', 'customize-preview'), NOVACRAFT_VERSION, true);
}
add_action('customize_preview_init', 'novacraft_customize_preview_js');

/**
 * Elementor Support
 */
function novacraft_elementor_setup() {
    // Enable Elementor support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    // Let Elementor handle the page layout
    add_post_type_support('page', 'elementor');
}
add_action('after_setup_theme', 'novacraft_elementor_setup');

//Apply container width changes to the container
add_action('wp_head', 'novacraft_output_container_width_css');
function novacraft_output_container_width_css() {
    $selected_width = get_theme_mod('container_width', 'normal');
    $custom_width = get_theme_mod('custom_container_width', '1200');
    $margin_top = get_theme_mod('container_margin_top', '24');
    $margin_right = get_theme_mod('container_margin_right', '24');
    $margin_bottom = get_theme_mod('container_margin_bottom', '24');
    $margin_left = get_theme_mod('container_margin_left', '24');
    $padding_top = get_theme_mod('main_content_inner_padding_top', '24');
    $padding_right = get_theme_mod('main_content_inner_padding_right', '24');
    $padding_bottom = get_theme_mod('main_content_inner_padding_bottom', '24');
    $padding_left = get_theme_mod('main_content_inner_padding_left', '24');
    // $border_radius = get_theme_mod('main_content_border_radius', '8');
    $sidebar_padding_top = get_theme_mod('sidebar_padding_top', '24');
    $sidebar_padding_right = get_theme_mod('sidebar_padding_right', '24');
    $sidebar_padding_bottom = get_theme_mod('sidebar_padding_bottom', '24');
    $sidebar_padding_left = get_theme_mod('sidebar_padding_left', '24');
    $sidebar_border_radius = get_theme_mod('sidebar_border_radius', '8');
    $post_padding_top = get_theme_mod('post_padding_top', '24');
    $post_padding_right = get_theme_mod('post_padding_right', '24');
    $post_padding_bottom = get_theme_mod('post_padding_bottom', '24');
    $post_padding_left = get_theme_mod('post_padding_left', '24');

    switch ($selected_width) {
        case 'narrow':
            $width = '640px';
            break;
        case 'wide':
            $width = '100%';
            break;
        case 'custom':
            // Only use the custom width if it's a valid positive integer
            $width = (is_numeric($custom_width) && $custom_width > 0) ? $custom_width . 'px' : '1200px';
            break;
        default:
            $width = '1100px';
    }

    echo "<style>
        :root {
            --container-width: {$width};
            --container-margin-top: {$margin_top}px;
            --container-margin-right: {$margin_right}px;
            --container-margin-bottom: {$margin_bottom}px;
            --container-margin-left: {$margin_left}px;
            --main-content-inner-padding-top: {$padding_top}px;
            --main-content-inner-padding-right: {$padding_right}px;
            --main-content-inner-padding-bottom: {$padding_bottom}px;
            --main-content-inner-padding-left: {$padding_left}px;
            
            --sidebar-padding-top: {$sidebar_padding_top}px;
            --sidebar-padding-right: {$sidebar_padding_right}px;
            --sidebar-padding-bottom: {$sidebar_padding_bottom}px;
            --sidebar-padding-left: {$sidebar_padding_left}px;
            --sidebar-border-radius: {$sidebar_border_radius}px;
            --post-padding-top: {$post_padding_top}px;
            --post-padding-right: {$post_padding_right}px;
            --post-padding-bottom: {$post_padding_bottom}px;
            --post-padding-left: {$post_padding_left}px;
        }
        .main-content {
            padding: var(--main-content-inner-padding-top) var(--main-content-inner-padding-right) var(--main-content-inner-padding-bottom) var(--main-content-inner-padding-left);
        }
        .site-main {
            margin: 0;
            padding: 0;
        }
        .site-content {
            max-width: {$width};
            margin: 0;
            width: 100%;
        }
        .content-sidebar-wrapper {
            max-width: {$width};
            width: 100%;
            margin: var(--container-margin-top) var(--container-margin-right) var(--container-margin-bottom) var(--container-margin-left) !important;
            padding: 0;
        }
        .content-sidebar-inner {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
        }
        .site-footer {
            margin-top: 0;
        }
        .widget-area {
            padding: var(--sidebar-padding-top) var(--sidebar-padding-right) var(--sidebar-padding-bottom) var(--sidebar-padding-left) !important;
        }
        .widget-area[data-style=\"boxed\"] {
            background-color: var(--wp--preset--color--content-bg);
            border-radius: var(--sidebar-border-radius);
            box-shadow: var(--sidebar-box-shadow);
            padding: var(--sidebar-padding-top) var(--sidebar-padding-right) var(--sidebar-padding-bottom) var(--sidebar-padding-left) !important;
        }
        .blog-archive-post {
            padding: var(--post-padding-top) var(--post-padding-right) var(--post-padding-bottom) var(--post-padding-left) !important;
        }
    </style>";
}

/**
 * Modify posts per page based on customizer setting
 */
function novacraft_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Check if we're in customizer preview
        if (is_customize_preview()) {
            // Get posts_per_page from URL parameter if set
            if (isset($_GET['posts_per_page'])) {
                $posts_per_page = absint($_GET['posts_per_page']);
                // Ensure we have a valid number
                if ($posts_per_page < 1) {
                    $posts_per_page = 12;
                }
            } else {
                $posts_per_page = get_theme_mod('posts_per_page', 12);
            }
        } else {
            $posts_per_page = get_theme_mod('posts_per_page', 12);
        }
        
        // Only modify the query if we're on a blog/archive page
        if (is_home() || is_archive() || is_search()) {
            $query->set('posts_per_page', $posts_per_page);
        }
    }
}
add_action('pre_get_posts', 'novacraft_posts_per_page');

function novacraft_register_button_block_styles() {
    if (function_exists('register_block_style')) {
        register_block_style('core/button', [
            'name'  => 'primary',
            'label' => __('Primary', 'novacraft'),
        ]);
        register_block_style('core/button', [
            'name'  => 'secondary',
            'label' => __('Secondary', 'novacraft'),
        ]);
    }
}
add_action('init', 'novacraft_register_button_block_styles');

// Use main style.css for block editor styles
function novacraft_block_editor_styles() {
    add_theme_support('editor-styles');
    add_editor_style('style.css');
}

add_action('after_setup_theme', 'novacraft_block_editor_styles');

// Output CSS variables for block editor (so editor gets customizer-driven button styles)
function novacraft_block_editor_button_vars() {
    // $primary_btn_text = get_theme_mod('primary_button_text_color', '#ffffff');
    // $primary_btn_bg = get_theme_mod('primary_button_bg_color', '#2563eb');
    // $primary_btn_border_color = get_theme_mod('primary_button_border_color', '#2563eb');
    // $primary_btn_border_width = get_theme_mod('primary_button_border_width', 2);
    // $primary_btn_radius = get_theme_mod('primary_button_border_radius', 4);
    // $primary_btn_padding_top = get_theme_mod('primary_button_padding_top', 12);
    // $primary_btn_padding_right = get_theme_mod('primary_button_padding_right', 24);
    // $primary_btn_padding_bottom = get_theme_mod('primary_button_padding_bottom', 12);
    // $primary_btn_padding_left = get_theme_mod('primary_button_padding_left', 24);
    // $secondary_btn_text = get_theme_mod('secondary_button_text_color', '#2563eb');
    // $secondary_btn_bg = get_theme_mod('secondary_button_bg_color', '#ffffff');
    // $secondary_btn_border_color = get_theme_mod('secondary_button_border_color', '#2563eb');
    // $secondary_btn_border_width = get_theme_mod('secondary_button_border_width', 2);
    // $secondary_btn_radius = get_theme_mod('secondary_button_border_radius', 4);
    // $secondary_btn_padding_top = get_theme_mod('secondary_button_padding_top', 12);
    // $secondary_btn_padding_right = get_theme_mod('secondary_button_padding_right', 24);
    // $secondary_btn_padding_bottom = get_theme_mod('secondary_button_padding_bottom', 12);
    // $secondary_btn_padding_left = get_theme_mod('secondary_button_padding_left', 24);

    // Also output theme color variables for fallback in block editor
    $primary = get_theme_mod('primary_color', '#2563eb');
    $text = get_theme_mod('text_color', '#1f2937');
    $secondary = get_theme_mod('secondary_color', '#475569');
    $accent = get_theme_mod('accent_color', '#f59e0b');
    $light = get_theme_mod('light_color', '#f3f4f6');
    $dark = get_theme_mod('dark_color', '#111827');
    $content_bg = get_theme_mod('content_bg_color', '#f9fafb');
    $bg = get_theme_mod('bg_color', '#f5f6fa');

    $css = ".editor-styles-wrapper {\n"
        . "--wp--preset--color--primary: {$primary};\n"
        . "--wp--preset--color--text: {$text};\n"
        . "--wp--preset--color--secondary: {$secondary};\n"
        . "--wp--preset--color--accent: {$accent};\n"
        . "--wp--preset--color--light: {$light};\n"
        . "--wp--preset--color--dark: {$dark};\n"
        . "--wp--preset--color--content-bg: {$content_bg};\n"
        . "--wp--preset--color--bg: {$bg};\n";

    // Only output button variables if set in customizer (not empty/null)
    $primary_btn_text = get_theme_mod('primary_button_text_color', '');
    if ($primary_btn_text !== '') $css .= "--primary-btn-text: {$primary_btn_text};\n";
    $primary_btn_bg = get_theme_mod('primary_button_bg_color', '');
    if ($primary_btn_bg !== '') $css .= "--primary-btn-bg: {$primary_btn_bg};\n";
    $primary_btn_border_color = get_theme_mod('primary_button_border_color', '');
    if ($primary_btn_border_color !== '') $css .= "--primary-btn-border-color: {$primary_btn_border_color};\n";
    $primary_btn_border_width = get_theme_mod('primary_button_border_width', '');
    if ($primary_btn_border_width !== '') $css .= "--primary-btn-border-width: {$primary_btn_border_width}px;\n";
    $primary_btn_radius = get_theme_mod('primary_button_border_radius', '');
    if ($primary_btn_radius !== '') $css .= "--primary-btn-radius: {$primary_btn_radius}px;\n";
    $primary_btn_padding_top = get_theme_mod('primary_button_padding_top', '');
    if ($primary_btn_padding_top !== '') $css .= "--primary-btn-padding-top: {$primary_btn_padding_top}px;\n";
    $primary_btn_padding_right = get_theme_mod('primary_button_padding_right', '');
    if ($primary_btn_padding_right !== '') $css .= "--primary-btn-padding-right: {$primary_btn_padding_right}px;\n";
    $primary_btn_padding_bottom = get_theme_mod('primary_button_padding_bottom', '');
    if ($primary_btn_padding_bottom !== '') $css .= "--primary-btn-padding-bottom: {$primary_btn_padding_bottom}px;\n";
    $primary_btn_padding_left = get_theme_mod('primary_button_padding_left', '');
    if ($primary_btn_padding_left !== '') $css .= "--primary-btn-padding-left: {$primary_btn_padding_left}px;\n";

    $secondary_btn_text = get_theme_mod('secondary_button_text_color', '');
    if ($secondary_btn_text !== '') $css .= "--secondary-btn-text: {$secondary_btn_text};\n";
    $secondary_btn_bg = get_theme_mod('secondary_button_bg_color', '');
    if ($secondary_btn_bg !== '') $css .= "--secondary-btn-bg: {$secondary_btn_bg};\n";
    $secondary_btn_border_color = get_theme_mod('secondary_button_border_color', '');
    if ($secondary_btn_border_color !== '') $css .= "--secondary-btn-border-color: {$secondary_btn_border_color};\n";
    $secondary_btn_border_width = get_theme_mod('secondary_button_border_width', '');
    if ($secondary_btn_border_width !== '') $css .= "--secondary-btn-border-width: {$secondary_btn_border_width}px;\n";
    $secondary_btn_radius = get_theme_mod('secondary_button_border_radius', '');
    if ($secondary_btn_radius !== '') $css .= "--secondary-btn-radius: {$secondary_btn_radius}px;\n";
    $secondary_btn_padding_top = get_theme_mod('secondary_button_padding_top', '');
    if ($secondary_btn_padding_top !== '') $css .= "--secondary-btn-padding-top: {$secondary_btn_padding_top}px;\n";
    $secondary_btn_padding_right = get_theme_mod('secondary_button_padding_right', '');
    if ($secondary_btn_padding_right !== '') $css .= "--secondary-btn-padding-right: {$secondary_btn_padding_right}px;\n";
    $secondary_btn_padding_bottom = get_theme_mod('secondary_button_padding_bottom', '');
    if ($secondary_btn_padding_bottom !== '') $css .= "--secondary-btn-padding-bottom: {$secondary_btn_padding_bottom}px;\n";
    $secondary_btn_padding_left = get_theme_mod('secondary_button_padding_left', '');
    if ($secondary_btn_padding_left !== '') $css .= "--secondary-btn-padding-left: {$secondary_btn_padding_left}px;\n";

    //Hover styles
    // Only output hover variables if set in customizer (not empty/null)
    $primary_btn_text_hover = get_theme_mod('primary_button_text_color_hover', '');
    if ($primary_btn_text_hover !== '') $css .= "--primary-btn-text-hover: {$primary_btn_text_hover};\n";
    $primary_btn_bg_hover = get_theme_mod('primary_button_bg_color_hover', '');
    if ($primary_btn_bg_hover !== '') $css .= "--primary-btn-bg-hover: {$primary_btn_bg_hover};\n";
    $primary_btn_border_color_hover = get_theme_mod('primary_button_border_color_hover', '');
    if ($primary_btn_border_color_hover !== '') $css .= "--primary-btn-border-color-hover: {$primary_btn_border_color_hover};\n";

    $secondary_btn_text_hover = get_theme_mod('secondary_button_text_color_hover', '');
    if ($secondary_btn_text_hover !== '') $css .= "--secondary-btn-text-hover: {$secondary_btn_text_hover};\n";
    $secondary_btn_bg_hover = get_theme_mod('secondary_button_bg_color_hover', '');
    if ($secondary_btn_bg_hover !== '') $css .= "--secondary-btn-bg-hover: {$secondary_btn_bg_hover};\n";
    $secondary_btn_border_color_hover = get_theme_mod('secondary_button_border_color_hover', '');
    if ($secondary_btn_border_color_hover !== '') $css .= "--secondary-btn-border-color-hover: {$secondary_btn_border_color_hover};\n";
    
    $css .= "}";

    echo '<style id="novacraft-block-editor-btn-vars">' . $css . '</style>';
}
add_action('enqueue_block_editor_assets', 'novacraft_block_editor_button_vars');

/**
 * Elementor Kit Colors
 */
// Update Elementor Kit with Theme Colors
add_action('elementor/init', 'update_elementor_kit_colors');
add_action('customize_save_after', 'update_elementor_kit_colors');
add_action('update_option_theme_mods_' . get_option('stylesheet'), 'update_elementor_kit_colors');
add_action('after_switch_theme', 'update_elementor_kit_colors');

function update_elementor_kit_colors() {
    static $has_run = false;
    if ($has_run) return;
    $has_run = true;

    // Check if Elementor is properly loaded
    if (!class_exists('\Elementor\Plugin') || !\Elementor\Plugin::$instance || !\Elementor\Plugin::$instance->documents) {
        return;
    }
    
    $kit_id = get_option('elementor_active_kit');
    if (!$kit_id) return;
    
    $kit = Elementor\Plugin::$instance->documents->get($kit_id);
    if (!$kit) return;
    
    $kit_settings = $kit->get_settings();
    
    // Define theme colors with semantic IDs
    $theme_colors = [
        'primary' => [
            'id' => 'primary',
            'title' => 'Primary Color',
            'color' => sanitize_hex_color(get_theme_mod('primary_color', '#2563eb'))
        ],
        'secondary' => [
            'id' => 'secondary',
            'title' => 'Secondary Color',
            'color' => sanitize_hex_color(get_theme_mod('secondary_color', '#475569'))
        ],
        'accent' => [
            'id' => 'accent',
            'title' => 'Accent Color',
            'color' => sanitize_hex_color(get_theme_mod('accent_color', '#f59e0b'))
        ],
        'text' => [
            'id' => 'text',
            'title' => 'Text Color',
            'color' => sanitize_hex_color(get_theme_mod('text_color', '#1f2937'))
        ],
        'bg' => [
            'id' => 'bg',
            'title' => 'Background Color',
            'color' => sanitize_hex_color(get_theme_mod('bg_color', '#cececec7'))
        ],
        'content-bg' => [
            'id' => 'contentbg',
            'title' => 'Content Background',
            'color' => sanitize_hex_color(get_theme_mod('content_bg_color', '#ffffff'))
        ],
        'light' => [
            'id' => 'light',
            'title' => 'Light Color',
            'color' => sanitize_hex_color(get_theme_mod('light_color', '#f3f4f6'))
        ],
        'dark' => [
            'id' => 'dark',
            'title' => 'Dark Color',
            'color' => sanitize_hex_color(get_theme_mod('dark_color', '#111827'))
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
    
    $kit_settings['custom_colors'] = $new_colors;
    
    // Save settings
    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
    $page_settings_manager->save_settings($kit_settings, $kit_id);
    
    // Clear all Elementor caches
    Elementor\Plugin::$instance->files_manager->clear_cache();
    if (class_exists('\Elementor\Core\Breakpoints\Manager')) {
        \Elementor\Plugin::$instance->breakpoints->refresh();
    }
    
    // Flush WordPress object cache
    wp_cache_flush();
}

// Enhanced cache clearing
add_action('customize_save_after', function() {
    if (class_exists('\Elementor\Plugin')) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
        if (class_exists('\Elementor\Core\Breakpoints\Manager')) {
            \Elementor\Plugin::$instance->breakpoints->refresh();
        }
        wp_cache_flush();
    }
}, 20);