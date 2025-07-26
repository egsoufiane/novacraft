<?php
/**
 * NovaCraft Theme Customizer
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include the WordPress Customizer Control class
require_once(ABSPATH . 'wp-includes/class-wp-customize-control.php');

// Include the custom boxed margin control class
require_once get_template_directory() . '/inc/custom-controls/class-novacraft-boxed-multi-control.php';
/**
 * Custom Typography Control
 */
class NovaCraft_Typography_Control extends WP_Customize_Control {
    public $type = 'typography';
    public $popup_id = '';
    public $fields = array();

    public function render_content() {
        ?>
        <div class="novacraft-typography-control">
            <button type="button" class="button novacraft-typography-button" data-popup-id="<?php echo esc_attr($this->popup_id); ?>">
                <?php echo esc_html($this->label); ?>
            </button>
            <div id="<?php echo esc_attr($this->popup_id); ?>" class="novacraft-typography-popup" style="display: none;">
                <?php foreach ($this->fields as $field) : ?>
                    <div class="novacraft-typography-field">
                        <label><?php echo esc_html($field['label']); ?></label>
                        <?php
                        switch ($field['type']) {
                            case 'select':
                                ?>
                                <select class="novacraft-typography-select" data-field="<?php echo esc_attr($field['id']); ?>">
                                    <?php foreach ($field['choices'] as $value => $label) : ?>
                                        <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php
                                break;
                            case 'number':
                                ?>
                                <input type="number" class="novacraft-typography-number" 
                                       data-field="<?php echo esc_attr($field['id']); ?>"
                                       min="<?php echo esc_attr($field['min']); ?>"
                                       max="<?php echo esc_attr($field['max']); ?>"
                                       step="<?php echo esc_attr($field['step']); ?>">
                                <?php
                                break;
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}

/**
 * Custom Range Control with Number Input
 */
class NovaCraft_Range_Number_Control extends WP_Customize_Control {
    public $type = 'range_number';
    public $input_type = 'number';
    public $min = 0;
    public $max = 100;
    public $step = 1;

    public function render_content() {
        ?>
        <div class="range-number-control">
            <label>
                <?php if (!empty($this->label)) : ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php endif; ?>
                <?php if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>
            </label>
            <div class="range-number-wrapper">
                <input type="range" 
                    id="<?php echo esc_attr($this->id); ?>"
                    name="<?php echo esc_attr($this->id); ?>"
                    value="<?php echo esc_attr($this->value()); ?>"
                    min="<?php echo esc_attr($this->min); ?>"
                    max="<?php echo esc_attr($this->max); ?>"
                    step="<?php echo esc_attr($this->step); ?>"
                    <?php $this->link(); ?>
                />
                <input type="number" 
                    id="<?php echo esc_attr($this->id); ?>_number"
                    value="<?php echo esc_attr($this->value()); ?>"
                    min="<?php echo esc_attr($this->min); ?>"
                    max="<?php echo esc_attr($this->max); ?>"
                    step="<?php echo esc_attr($this->step); ?>"
                />
            </div>
        </div>
        <?php
    }
}

/**
 * Custom Palette Control
 */
class NovaCraft_Multi_Palette_Control extends WP_Customize_Control {
    public $type = 'multi_palette';
    public $palette_settings = array();

    public function __construct($manager, $id, $args = array()) {
        if (isset($args['palette_settings'])) {
            $this->palette_settings = $args['palette_settings'];
        }
        parent::__construct($manager, $id, $args);
    }

    public function render_content() {
        ?>
        <div class="novacraft-palette-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
            <div style="display:flex;justify-content:space-between;width:100%;align-items:center;gap:8px;">
                <?php if (!empty($this->label)) : ?>
                    <span class="customize-control-title" style="font-weight:500;font-size:15px;"> <?php echo esc_html($this->label); ?> </span>
                <?php else: ?>
                    <span class="customize-control-title">Theme Colors</span>
                <?php endif; ?>
                <span id="novacraft-palette-icon-placeholder"></span>
            </div>
        </div>
        <div class="novacraft-palette-row">
            <?php foreach ($this->palette_settings as $setting_id => $info) :
                $color = $this->manager->get_setting($setting_id)->value();
                $label = isset($info['label']) ? $info['label'] : $setting_id;
            ?>
                <div class="novacraft-color-circle"
                    style="background: <?php echo esc_attr($color); ?>;"
                    data-setting="<?php echo esc_attr($setting_id); ?>"
                    data-color="<?php echo esc_attr($color); ?>"
                    data-title="<?php echo esc_attr($label); ?>">
                </div>
                <input type="hidden"
                    class="novacraft-palette-input"
                    data-customize-setting-link="<?php echo esc_attr($setting_id); ?>"
                    value="<?php echo esc_attr($color); ?>" />
            <?php endforeach; ?>
        </div>
        <!-- Pickr popup will be dynamically created and appended to body via JS -->
        <?php if (!empty($this->description)) : ?>
            <span class="description customize-control-description" style="margin-top:8px;display:block;"> <?php echo esc_html($this->description); ?> </span>
        <?php endif; ?>
        <?php
    }
}

/**
 * Custom Single Color Control
 */
class NovaCraft_Single_Color_Control extends WP_Customize_Control {
    public $type = 'single_color';

    public function render_content() {
        $color = $this->value();
        $label = !empty($this->label) ? $this->label : $this->id;
        ?>
        <div class="novacraft-single-color-row" style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
            <span class="customize-control-title"><?php echo esc_html($label); ?></span>
            <div class="novacraft-color-circle"
                style="background: <?php echo esc_attr($color); ?>;"
                data-setting="<?php echo esc_attr($this->id); ?>"
                data-color="<?php echo esc_attr($color); ?>"
                data-title="<?php echo esc_attr($label); ?>">
            </div>
            <input type="hidden"
                class="novacraft-palette-input"
                data-customize-setting-link="<?php echo esc_attr($this->id); ?>"
                value="<?php echo esc_attr($color); ?>" />
        </div>
        <!-- Pickr popup will be dynamically created and appended to body via JS -->
        <?php
        if (!empty($this->description)) {
            echo '<span class="description customize-control-description">' . esc_html($this->description) . '</span>';
        }
    }
}

/**
 * Sanitize RGBA Color
 */
function sanitize_rgba_color($color) {
    // Return fallback if empty or an array
    if (empty($color) || is_array($color)) {
        return ''; // default fallback color
    }

    $color = trim($color);

    // HEX format (#fff or #ffffff)
    if (preg_match('/^#([A-Fa-f0-9]{3}){1,2}$/', $color)) {
        $hex = sanitize_hex_color($color);
        return $hex ? $hex : '#2563eb';
    }

    // RGB or RGBA format
    if (preg_match('/^rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})(?:\s*,\s*(0|0?\.\d+|1(?:\.0+)?))?\s*\)$/', $color, $matches)) {
        $r = max(0, min(255, (int) $matches[1]));
        $g = max(0, min(255, (int) $matches[2]));
        $b = max(0, min(255, (int) $matches[3]));

        if (isset($matches[4])) {
            $a = max(0, min(1, (float) $matches[4]));
            return sprintf('rgba(%d,%d,%d,%.2f)', $r, $g, $b, $a);
        } else {
            // RGB fallback to hex
            return sprintf('#%02x%02x%02x', $r, $g, $b);
        }
    }

    // Invalid input – return default
    return '#2563eb';
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function novacraft_customize_register($wp_customize) {

    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'novacraft_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'novacraft_customize_partial_blogdescription',
            )
        );
    }

    // Logo Width Setting
    $wp_customize->add_setting(
        'logo_width',
        array(
            'default'           => '150',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'logo_width',
            array(
                'label'       => __('Logo Width (px)', 'novacraft'),
                'section'     => 'title_tagline',
                'min'         => 50,
                'max'         => 300,
                'step'        => 1,
                'description' => __('Adjust the width of your logo. The height will adjust automatically to maintain the aspect ratio.', 'novacraft'),
            )
        )
    );

    // Add selective refresh for logo
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'custom_logo',
            array(
                'selector'        => '.custom-logo-link',
                'render_callback' => 'novacraft_customize_partial_custom_logo',
            )
        );
    }

    // Add Theme Colors section
    $wp_customize->add_section(
        'novacraft_colors',
            array(
            'title'    => __('Theme Colors', 'novacraft'),
            'priority' => 30,
        )
    );

    // --- Multi Palette Control for Theme Colors ---
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#2563eb',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_setting(
        'content_bg_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_setting(
        'bg_color',
        array(
            'default'           => '#cececec7',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_setting(
        'text_color',
        array(
            'default'           => '#1f2937',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_setting(
        'secondary_color',
        array(
            'default'           => '#475569',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_setting(
        'accent_color',
        array(
            'default'           => '#f59e0b',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_setting(
        'light_color',
        array(
            'default'           => '#f3f4f6',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_setting(
        'dark_color',
        array(
            'default'           => '#111827',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Multi_Palette_Control(
            $wp_customize,
            'novacraft_theme_palette',
            array(
                'label'    => __('Theme Colors', 'novacraft'),
                'section'  => 'novacraft_colors',
                'settings' => array('primary_color'), // Required for Customizer to show the control
                'palette_settings' => array(
                    'primary_color' => array('label' => __('Primary', 'novacraft')),
                    'secondary_color' => array('label' => __('Secondary', 'novacraft')),
                    'accent_color' => array('label' => __('Accent', 'novacraft')),
                    'content_bg_color' => array('label' => __('Content BG', 'novacraft')),
                    'bg_color' => array('label' => __('Page BG', 'novacraft')),
                    'text_color' => array('label' => __('Text', 'novacraft')),
                    'light_color' => array('label' => __('Light', 'novacraft')),
                    'dark_color' => array('label' => __('Dark', 'novacraft')),
                ),
                'description' => __('Click a color to change. These are your main theme palette colors.', 'novacraft'),
            )
        )
    );

    // Typography Section
    $wp_customize->add_section(
        'novacraft_typography',
        array(
            'title'    => __('Typography', 'novacraft'),
            'priority' => 40,
        )
    );

    // Body Font
    $wp_customize->add_setting(
        'body_font',
        array(
            'default'           => 'Roboto',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'body_font',
        array(
            'label'    => __('Body Font', 'novacraft'),
            'section'  => 'novacraft_typography',
            'type'     => 'select',
            'choices'  => array(
                'Roboto' => 'Roboto',
                'Open Sans' => 'Open Sans',
                'Lato' => 'Lato',
                'Montserrat' => 'Montserrat',
                'Poppins' => 'Poppins',
            ),
        )
    );

    // Heading Font
    $wp_customize->add_setting(
        'heading_font',
        array(
            'default'           => 'Roboto',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'heading_font',
        array(
            'label'    => __('Heading Font', 'novacraft'),
            'section'  => 'novacraft_typography',
            'type'     => 'select',
            'choices'  => array(
                'Roboto' => 'Roboto',
                'Open Sans' => 'Open Sans',
                'Lato' => 'Lato',
                'Montserrat' => 'Montserrat',
                'Poppins' => 'Poppins',
            ),
        )
    );

    // Base Font Size
    $wp_customize->add_setting(
        'base_font_size',
        array(
            'default'           => '16',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'base_font_size',
            array(
                'label'       => __('Base Font Size (px)', 'novacraft'),
                'section'     => 'novacraft_typography',
                'min'         => 12,
                'max'         => 24,
                'step'        => 1,
            )
        )
    );

    // Line Height
    $wp_customize->add_setting(
        'line_height',
        array(
            'default'           => '1.6',
            'sanitize_callback' => 'novacraft_sanitize_float',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'line_height',
            array(
                'label'       => __('Line Height', 'novacraft'),
                'section'     => 'novacraft_typography',
                'min'         => 1,
                'max'         => 2,
                'step'        => 0.1,
            )
        )
    );

    // Add Sidebar section
    $wp_customize->add_section(
        'novacraft_sidebar',
        array(
            'title'    => __('Sidebar', 'novacraft'),
            'priority' => 60,
        )
    );

    // Sidebar Position
    $wp_customize->add_setting(
        'sidebar_position',
        array(
            'default'           => 'none',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'sidebar_position',
        array(
            'label'    => __('Sidebar Position', 'novacraft'),
            'section'  => 'novacraft_sidebar',
            'type'     => 'radio',
            'choices'  => array(
                'left'  => __('Left', 'novacraft'),
                'right' => __('Right', 'novacraft'),
                'both'  => __('Both Sides', 'novacraft'),
                'none'  => __('No Sidebar', 'novacraft'),
            ),
        )
    );

    // Sidebar Style
    $wp_customize->add_setting(
        'sidebar_style',
        array(
            'default'           => 'boxed',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'sidebar_style',
        array(
            'label'    => __('Sidebar Style', 'novacraft'),
            'section'  => 'novacraft_sidebar',
            'type'     => 'select',
            'choices'  => array(
                'boxed'    => __('Boxed', 'novacraft'),
                'unboxed'  => __('Unboxed', 'novacraft'),
            ),
        )
    );

    // Sidebar Box Shadow
    $wp_customize->add_setting(
        'sidebar_box_shadow',
        array(
            'default'           => 'medium',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'sidebar_box_shadow',
        array(
            'label'    => __('Sidebar Box Shadow', 'novacraft'),
            'section'  => 'novacraft_sidebar',
            'type'     => 'select',
            'choices'  => array(
                'none'   => __('None', 'novacraft'),
                'small'  => __('Small', 'novacraft'),
                'medium' => __('Medium', 'novacraft'),
                'large'  => __('Large', 'novacraft'),
            ),
        )
    );

    // Sidebar Border Radius
    $wp_customize->add_setting(
        'sidebar_border_radius',
        array(
            'default'           => '8',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'sidebar_border_radius',
            array(
                'label'       => __('Sidebar Border Radius (px)', 'novacraft'),
                'section'     => 'novacraft_sidebar',
                'min'         => 0,
                'max'         => 50,
                'step'        => 1,
                'description' => __('Controls the roundness of the sidebar corners.', 'novacraft'),
            )
        )
    );

    // Sidebar Width
    $wp_customize->add_setting(
        'sidebar_width',
        array(
            'default'           => '300',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'sidebar_width',
            array(
                'label'       => __('Sidebar Width (px)', 'novacraft'),
                'section'     => 'novacraft_sidebar',
                'min'         => 200,
                'max'         => 500,
                'step'        => 1,
            )
        )
    );

    // Sidebar Padding Controls
    $wp_customize->add_setting('sidebar_padding_linked', array(
        'default'           => 'linked',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('sidebar_padding_top', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('sidebar_padding_right', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('sidebar_padding_bottom', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('sidebar_padding_left', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(
        new NovaCraft_Boxed_Multi_Control(
            $wp_customize,
            'sidebar_padding',
            array(
                'label'          => __('Sidebar Padding', 'novacraft'),
                'section'        => 'novacraft_sidebar',
                'settings'       => array(
                    'top'    => 'sidebar_padding_top',
                    'right'  => 'sidebar_padding_right',
                    'bottom' => 'sidebar_padding_bottom',
                    'left'   => 'sidebar_padding_left',
                ),
                'linked_setting' => 'sidebar_padding_linked',
            )
        )
    );

    // Add Footer section
    $wp_customize->add_section(
        'novacraft_footer',
        array(
            'title'    => __('Footer', 'novacraft'),
            'priority' => 90,
        )
    );

    // === BUTTONS PANEL ===
    $wp_customize->add_panel(
        'novacraft_buttons_panel',
        array(
            'title'    => __('Buttons', 'novacraft'),
            'priority' => 80,
        )
    );
    // Primary Button Section
    $wp_customize->add_section(
        'novacraft_primary_button_section',
        array(
            'title'    => __('Primary Button', 'novacraft'),
            'panel'    => 'novacraft_buttons_panel',
            'priority' => 10,
        )
    );
    // Secondary Button Section
    $wp_customize->add_section(
        'novacraft_secondary_button_section',
        array(
            'title'    => __('Secondary Button', 'novacraft'),
            'panel'    => 'novacraft_buttons_panel',
            'priority' => 20,
        )
    );
    // === Primary Button Settings ===
    $wp_customize->add_setting('primary_button_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_rgba_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Single_Color_Control(
        $wp_customize,
        'primary_button_text_color',
        array(
            'label'    => __('Text Color', 'novacraft'),
            'section'  => 'novacraft_primary_button_section',
            'settings' => 'primary_button_text_color',
        )
    ));
    $wp_customize->add_setting('primary_button_bg_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_rgba_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Single_Color_Control(
        $wp_customize,
        'primary_button_bg_color',
        array(
            'label'    => __('Background Color', 'novacraft'),
            'section'  => 'novacraft_primary_button_section',
            'settings' => 'primary_button_bg_color',
        )
    ));
    $wp_customize->add_setting('primary_button_border_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_rgba_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Single_Color_Control(
        $wp_customize,
        'primary_button_border_color',
        array(
            'label'    => __('Border Color', 'novacraft'),
            'section'  => 'novacraft_primary_button_section',
            'settings' => 'primary_button_border_color',
        )
    ));
    $wp_customize->add_setting('primary_button_border_width', array(
        'default'           => '2',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Range_Number_Control(
        $wp_customize,
        'primary_button_border_width',
        array(
            'label'    => __('Border Width (px)', 'novacraft'),
            'section'  => 'novacraft_primary_button_section',
            'min'      => 0,
            'max'      => 10,
            'step'     => 1,
        )
    ));
    $wp_customize->add_setting('primary_button_border_radius', array(
        'default'           => '4',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Range_Number_Control(
        $wp_customize,
        'primary_button_border_radius',
        array(
            'label'    => __('Border Radius (px)', 'novacraft'),
            'section'  => 'novacraft_primary_button_section',
            'min'      => 0,
            'max'      => 50,
            'step'     => 1,
        )
    ));
    // === Primary Button Padding Controls ===
    $wp_customize->add_setting('primary_button_padding_linked', array(
        'default'           => 'linked',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_setting('primary_button_padding_top', array(
        'default'           => '12',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_setting('primary_button_padding_right', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_setting('primary_button_padding_bottom', array(
        'default'           => '12',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_setting('primary_button_padding_left', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(
        new NovaCraft_Boxed_Multi_Control(
            $wp_customize,
            'primary_button_padding',
            array(
                'label'          => __('Primary Button Padding', 'novacraft'),
                'section'        => 'novacraft_primary_button_section',
                'settings'       => array(
                    'top'    => 'primary_button_padding_top',
                    'right'  => 'primary_button_padding_right',
                    'bottom' => 'primary_button_padding_bottom',
                    'left'   => 'primary_button_padding_left',
                ),
                'linked_setting' => 'primary_button_padding_linked',
            )
        )
    );
    // === Secondary Button Settings ===
    $wp_customize->add_setting('secondary_button_text_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_rgba_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Single_Color_Control(
        $wp_customize,
        'secondary_button_text_color',
        array(
            'label'    => __('Text Color', 'novacraft'),
            'section'  => 'novacraft_secondary_button_section',
            'settings' => 'secondary_button_text_color',
        )
    ));
    $wp_customize->add_setting('secondary_button_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_rgba_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Single_Color_Control(
        $wp_customize,
        'secondary_button_bg_color',
        array(
            'label'    => __('Background Color', 'novacraft'),
            'section'  => 'novacraft_secondary_button_section',
            'settings' => 'secondary_button_bg_color',
        )
    ));
    $wp_customize->add_setting('secondary_button_border_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_rgba_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Single_Color_Control(
        $wp_customize,
        'secondary_button_border_color',
        array(
            'label'    => __('Border Color', 'novacraft'),
            'section'  => 'novacraft_secondary_button_section',
            'settings' => 'secondary_button_border_color',
        )
    ));
    $wp_customize->add_setting('secondary_button_border_width', array(
        'default'           => '2',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Range_Number_Control(
        $wp_customize,
        'secondary_button_border_width',
        array(
            'label'    => __('Border Width (px)', 'novacraft'),
            'section'  => 'novacraft_secondary_button_section',
            'min'      => 0,
            'max'      => 10,
            'step'     => 1,
        )
    ));
    $wp_customize->add_setting('secondary_button_border_radius', array(
        'default'           => '4',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new NovaCraft_Range_Number_Control(
        $wp_customize,
        'secondary_button_border_radius',
        array(
            'label'    => __('Border Radius (px)', 'novacraft'),
            'section'  => 'novacraft_secondary_button_section',
            'min'      => 0,
            'max'      => 50,
            'step'     => 1,
        )
    ));
    // === Secondary Button Padding Controls ===
    $wp_customize->add_setting('secondary_button_padding_linked', array(
        'default'           => 'linked',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_setting('secondary_button_padding_top', array(
        'default'           => '12',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_setting('secondary_button_padding_right', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_setting('secondary_button_padding_bottom', array(
        'default'           => '12',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_setting('secondary_button_padding_left', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(
        new NovaCraft_Boxed_Multi_Control(
            $wp_customize,
            'secondary_button_padding',
            array(
                'label'          => __('Secondary Button Padding', 'novacraft'),
                'section'        => 'novacraft_secondary_button_section',
                'settings'       => array(
                    'top'    => 'secondary_button_padding_top',
                    'right'  => 'secondary_button_padding_right',
                    'bottom' => 'secondary_button_padding_bottom',
                    'left'   => 'secondary_button_padding_left',
                ),
                'linked_setting' => 'secondary_button_padding_linked',
            )
        )
    );

    // Footer Text
    $wp_customize->add_setting(
        'footer_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'footer_text',
        array(
            'label'    => __('Footer Text', 'novacraft'),
            'section'  => 'novacraft_footer',
            'type'     => 'textarea',
        )
    );

    // Show Social Icons
    $wp_customize->add_setting(
        'show_social_icons',
        array(
            'default'           => true,
            'sanitize_callback' => 'novacraft_sanitize_checkbox',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'show_social_icons',
        array(
            'label'    => __('Show Social Icons', 'novacraft'),
            'section'  => 'novacraft_footer',
            'type'     => 'checkbox',
        )
    );

    // Facebook URL
    $wp_customize->add_setting(
        'facebook_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'facebook_url',
        array(
            'label'    => __('Facebook URL', 'novacraft'),
            'section'  => 'novacraft_footer',
            'type'     => 'url',
        )
    );

    // Twitter URL
    $wp_customize->add_setting(
        'twitter_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'twitter_url',
        array(
            'label'    => __('Twitter URL', 'novacraft'),
            'section'  => 'novacraft_footer',
            'type'     => 'url',
        )
    );

    // Instagram URL
    $wp_customize->add_setting(
        'instagram_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'instagram_url',
        array(
            'label'    => __('Instagram URL', 'novacraft'),
            'section'  => 'novacraft_footer',
            'type'     => 'url',
        )
    );

    // LinkedIn URL
    $wp_customize->add_setting(
        'linkedin_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'linkedin_url',
        array(
            'label'    => __('LinkedIn URL', 'novacraft'),
            'section'  => 'novacraft_footer',
            'type'     => 'url',
        )
    );

    // YouTube URL
    $wp_customize->add_setting(
        'youtube_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'youtube_url',
        array(
            'label'    => __('YouTube URL', 'novacraft'),
            'section'  => 'novacraft_footer',
            'type'     => 'url',
        )
    );

    // Add Container Panel
    $wp_customize->add_panel(
        'novacraft_container_panel',
        array(
            'title'    => __('Container', 'novacraft'),
            'priority' => 50,
        )
    );
    

    // Container Width Section
    $wp_customize->add_section(
        'novacraft_container_layout',
        array(
            'title'    => __('Container Layout', 'novacraft'),
            'panel'    => 'novacraft_container_panel',
            'priority' => 20,
        )
    );

    // Content Width Setting
    $wp_customize->add_setting(
        'container_width',
        array(
            'default'           => 'normal',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'container_width',
        array(
            'label'    => __('Container Width', 'novacraft'),
            'section'  => 'novacraft_container_layout',
            'type'     => 'select',
            'choices'  => array(
                'narrow'  => __('Narrow', 'novacraft'),
                'normal'  => __('Normal', 'novacraft'),
                'wide'    => __('Wide', 'novacraft'),
                'custom'  => __('Custom', 'novacraft'),
            ),
        )
    );

    // Custom Width Setting
    $wp_customize->add_setting(
        'custom_container_width',
        array(
            'default'           => '800',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'custom_container_width',
            array(
                'label'       => __('Custom Width (px)', 'novacraft'),
                'section'     => 'novacraft_container_layout',
                'min'         => 400,
                'max'         => 1600,
                'step'        => 1,
            )
        )
    );

    // Container Margin Controls
    $wp_customize->add_setting('container_margin_linked', array(
        'default'           => 'linked',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('container_margin_top', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('container_margin_right', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('container_margin_bottom', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('container_margin_left', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(
        new NovaCraft_Boxed_Multi_Control(
            $wp_customize,
            'container_margin',
            array(
                'label'          => __('Container Margin', 'novacraft'),
                'section'        => 'novacraft_container_layout',
                'settings'       => array(
                    'top'    => 'container_margin_top',
                    'right'  => 'container_margin_right',
                    'bottom' => 'container_margin_bottom',
                    'left'   => 'container_margin_left',
                ),
                'linked_setting' => 'container_margin_linked',
            )
        )
    );

    $wp_customize->add_setting('main_content_inner_padding_linked', array(
        'default'           => 'linked',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('main_content_inner_padding_top', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('main_content_inner_padding_right', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('main_content_inner_padding_bottom', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('main_content_inner_padding_left', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(
        new NovaCraft_Boxed_Multi_Control(
            $wp_customize,
            'main_content_inner_padding',
            array(
                'label'          => __('Main Content Inner Padding', 'novacraft'),
                'section'        => 'novacraft_container_layout',
                'settings'       => array(
                    'top'    => 'main_content_inner_padding_top',
                    'right'  => 'main_content_inner_padding_right',
                    'bottom' => 'main_content_inner_padding_bottom',
                    'left'   => 'main_content_inner_padding_left',
                ),
                'linked_setting' => 'main_content_inner_padding_linked',
            )
        )
    );

    // Main Content Border Radius
    $wp_customize->add_setting(
        'main_content_border_radius',
        array(
            'default'           => '8',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
            'type'             => 'theme_mod',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'main_content_border_radius',
            array(
                'label'       => __('Main Content Border Radius (px)', 'novacraft'),
                'section'     => 'novacraft_container_layout',
                'min'         => 0,
                'max'         => 50,
                'step'        => 1,
                'description' => __('Controls the roundness of the main content area corners.', 'novacraft'),
            )
        )
    );

    // Container Style Section
    $wp_customize->add_section(
        'novacraft_container_style',
        array(
            'title'    => __('Container Style', 'novacraft'),
            'panel'    => 'novacraft_container_panel',
            'priority' => 30,
        )
    );

    // Container Style
    $wp_customize->add_setting(
        'container_style',
        array(
            'default'           => 'boxed',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'container_style',
        array(
            'label'    => __('Container Style', 'novacraft'),
            'section'  => 'novacraft_container_style',
            'type'     => 'select',
            'choices'  => array(
                'boxed'    => __('Boxed', 'novacraft'),
                'unboxed'  => __('Unboxed', 'novacraft'),
            ),
        )
    );

    // Container Box Shadow
    $wp_customize->add_setting(
        'container_box_shadow',
        array(
            'default'           => 'medium',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'container_box_shadow',
        array(
            'label'    => __('Box Shadow', 'novacraft'),
            'section'  => 'novacraft_container_style',
            'type'     => 'select',
            'choices'  => array(
                'none'   => __('None', 'novacraft'),
                'small'  => __('Small', 'novacraft'),
                'medium' => __('Medium', 'novacraft'),
                'large'  => __('Large', 'novacraft'),
            ),
        )
    );

    // Add Posts Panel
    $wp_customize->add_panel(
        'novacraft_posts_panel',
        array(
            'title'    => __('Blog / Archive', 'novacraft'),
            'priority' => 70,
        )
    );

    // Post Layouts Section
    $wp_customize->add_section(
        'novacraft_post_layouts',
        array(
            'title'    => __('Posts Layout', 'novacraft'),
            'panel'    => 'novacraft_posts_panel',
            'priority' => 10,
        )
    );

    // Post Layout
    $wp_customize->add_setting(
        'post_layout',
        array(
            'default'           => 'list',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'post_layout',
        array(
            'label'    => __('Post Layout', 'novacraft'),
            'section'  => 'novacraft_post_layouts',
            'type'     => 'select',
            'choices'  => array(
                'list'   => __('List', 'novacraft'),
                'grid'   => __('Grid', 'novacraft'),
            ),
        )
    );

    // Grid Columns Setting
    $wp_customize->add_setting(
        'grid_columns',
        array(
            'default'           => '3',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'grid_columns',
            array(
                'label'       => __('Grid Columns', 'novacraft'),
                'section'     => 'novacraft_post_layouts',
                'min'         => 2,
                'max'         => 4,
                'step'        => 1,
            )
        )
    );

    // Posts Per Page Setting
    $wp_customize->add_setting(
        'posts_per_page',
        array(
            'default'           => '12',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'posts_per_page',
            array(
                'label'       => __('Posts Per Page', 'novacraft'),
                'section'     => 'novacraft_post_layouts',
                'min'         => 1,
                'max'         => 48,
                'step'        => 1,
                'description' => __('Number of posts to display per page', 'novacraft'),
            )
        )
    );

    // Post Styles Section
    $wp_customize->add_section(
        'novacraft_post_styles',
        array(
            'title'    => __('Post Styles', 'novacraft'),
            'panel'    => 'novacraft_posts_panel',
            'priority' => 20,
        )
    );

    // Post Style
    $wp_customize->add_setting(
        'post_style',
        array(
            'default'           => 'boxed',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'post_style',
        array(
            'label'    => __('Post Style', 'novacraft'),
            'section'  => 'novacraft_post_styles',
            'type'     => 'select',
            'choices'  => array(
                'boxed'    => __('Boxed', 'novacraft'),
                'unboxed'  => __('Unboxed', 'novacraft'),
                'minimal'  => __('Minimal', 'novacraft'),
            ),
        )
    );

    // Post Box Shadow
    $wp_customize->add_setting(
        'post_box_shadow',
        array(
            'default'           => 'medium',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'post_box_shadow',
        array(
            'label'    => __('Post Box Shadow', 'novacraft'),
            'section'  => 'novacraft_post_styles',
            'type'     => 'select',
            'choices'  => array(
                'none'   => __('None', 'novacraft'),
                'small'  => __('Small', 'novacraft'),
                'medium' => __('Medium', 'novacraft'),
                'large'  => __('Large', 'novacraft'),
            ),
        )
    );

    // Post Border Radius
    $wp_customize->add_setting(
        'post_border_radius',
        array(
            'default'           => '8',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Range_Number_Control(
            $wp_customize,
            'post_border_radius',
            array(
                'label'       => __('Post Border Radius (px)', 'novacraft'),
                'section'     => 'novacraft_post_styles',
                'min'         => 0,
                'max'         => 20,
                'step'        => 1,
            )
        )
    );

    // Post Padding Controls
    $wp_customize->add_setting('post_padding_linked', array(
        'default'           => 'linked',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('post_padding_top', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('post_padding_right', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('post_padding_bottom', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_setting('post_padding_left', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(
        new NovaCraft_Boxed_Multi_Control(
            $wp_customize,
            'post_padding',
            array(
                'label'          => __('Post Padding', 'novacraft'),
                'section'        => 'novacraft_post_styles',
                'settings'       => array(
                    'top'    => 'post_padding_top',
                    'right'  => 'post_padding_right',
                    'bottom' => 'post_padding_bottom',
                    'left'   => 'post_padding_left',
                ),
                'linked_setting' => 'post_padding_linked',
            )
        )
    );

    // Post Background Color
    $wp_customize->add_setting(
        'post_bg_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Single_Color_Control(
            $wp_customize,
            'post_bg_color',
            array(
                'label'    => __('Post Background Color', 'novacraft'),
                'section'  => 'novacraft_post_styles',
                'settings' => 'post_bg_color',
            )
        )
    );

    // Post Title Color
    $wp_customize->add_setting(
        'post_title_color',
        array(
            'default'           => '#1f2937',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Single_Color_Control(
            $wp_customize,
            'post_title_color',
            array(
                'label'    => __('Post Title Color', 'novacraft'),
                'section'  => 'novacraft_post_styles',
                'settings' => 'post_title_color',
            )
        )
    );

    // Post Meta Color
    $wp_customize->add_setting(
        'post_meta_color',
        array(
            'default'           => '#6b7280',
            'sanitize_callback' => 'sanitize_rgba_color',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new NovaCraft_Single_Color_Control(
            $wp_customize,
            'post_meta_color',
            array(
                'label'    => __('Post Meta Color', 'novacraft'),
                'section'  => 'novacraft_post_styles',
                'settings' => 'post_meta_color',
            )
        )
    );
}
add_action('customize_register', 'novacraft_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function novacraft_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function novacraft_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Render the custom logo for the selective refresh partial.
 *
 * @return void
 */
function novacraft_customize_partial_custom_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
}
}

/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function novacraft_sanitize_checkbox($checked) {
    return ((isset($checked) && true === $checked) ? true : false);
}

/**
 * Output customizer CSS
 */
function novacraft_customizer_css() {
    // Get typography settings
    $body_font = get_theme_mod('body_font', 'Roboto');
    $headings_font = get_theme_mod('heading_font', 'Roboto');
    // Button custom properties
    $primary_btn_text = get_theme_mod('primary_button_text_color', '#ffffff');
    $primary_btn_bg = get_theme_mod('primary_button_bg_color', '#2563eb');
    $primary_btn_border_color = get_theme_mod('primary_button_border_color', '#2563eb');
    $primary_btn_border_width = get_theme_mod('primary_button_border_width', 2);
    $primary_btn_radius = get_theme_mod('primary_button_border_radius', 4);
    $primary_btn_padding_top = get_theme_mod('primary_button_padding_top', 8); // px
    $primary_btn_padding_right = get_theme_mod('primary_button_padding_right', 16); // px
    $primary_btn_padding_bottom = get_theme_mod('primary_button_padding_bottom', 8); // px
    $primary_btn_padding_left = get_theme_mod('primary_button_padding_left', 16); // px
    $secondary_btn_text = get_theme_mod('secondary_button_text_color', '#2563eb');
    $secondary_btn_bg = get_theme_mod('secondary_button_bg_color', '#ffffff');
    $secondary_btn_border_color = get_theme_mod('secondary_button_border_color', '#2563eb');
    $secondary_btn_border_width = get_theme_mod('secondary_button_border_width', 2);
    $secondary_btn_radius = get_theme_mod('secondary_button_border_radius', 4);
    $secondary_btn_padding_top = get_theme_mod('secondary_button_padding_top', 8); // px
    $secondary_btn_padding_right = get_theme_mod('secondary_button_padding_right', 16); // px
    $secondary_btn_padding_bottom = get_theme_mod('secondary_button_padding_bottom', 8); // px
    $secondary_btn_padding_left = get_theme_mod('secondary_button_padding_left', 16); // px

    /* Get Container Box Shadow */
    $container_box_shadow_setting = get_theme_mod('container_box_shadow', 'medium');
    // Map setting to actual CSS value
    $container_box_shadow_values = array(
        'none'   => 'none',
        'small'  => '0 1px 3px rgba(0, 0, 0, 0.1)',
        'medium' => '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
        'large'  => '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
    );
    $container_box_shadow_css = isset($container_box_shadow_values[$container_box_shadow_setting]) ? $container_box_shadow_values[$container_box_shadow_setting] : 'none';

    /*Get Post Box Shadow */
    $post_box_shadow_setting = get_theme_mod('post_box_shadow', 'medium');
    // Map setting to actual CSS value
    $post_box_shadow_values = array(
        'none'   => 'none',
        'small'  => '0 1px 3px rgba(0, 0, 0, 0.1)',
        'medium' => '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
        'large'  => '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',

    );   
    $post_box_shadow_css = isset($post_box_shadow_values[$post_box_shadow_setting]) ? $post_box_shadow_values[$post_box_shadow_setting] : 'none';

    /* Get Sidebar Box Shadow */
    $sidebar_box_shadow_setting = get_theme_mod('sidebar_box_shadow', 'medium');
    // Map setting to actual CSS value
    $sidebar_box_shadow_values = array(
        'none'   => 'none',
        'small'  => '0 1px 3px rgba(0, 0, 0, 0.1)',
        'medium' => '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
        'large'  => '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',

    );
    $sidebar_box_shadow_css = isset($sidebar_box_shadow_values[$sidebar_box_shadow_setting]) ? $sidebar_box_shadow_values[$sidebar_box_shadow_setting] : 'none';

    ?>
    <style type="text/css">
        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=<?php echo str_replace(' ', '+', $body_font); ?>:wght@400;500;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=<?php echo str_replace(' ', '+', $headings_font); ?>:wght@400;500;700&display=swap');

        :root {
            /* Typography */
            --font-body: '<?php echo $body_font; ?>', sans-serif;
            --font-heading: '<?php echo $headings_font; ?>', sans-serif;
            --body-font-size: <?php echo get_theme_mod('base_font_size', '16'); ?>px;
            --body-line-height: <?php echo get_theme_mod('line_height', '1.6'); ?>;
            --body-letter-spacing: <?php echo get_theme_mod('body_letter_spacing', '0'); ?>px;
            --body-font-weight: <?php echo get_theme_mod('body_font_weight', '400'); ?>;
            --headings-font-weight: <?php echo get_theme_mod('headings_font_weight', '700'); ?>;
            --headings-text-transform: <?php echo get_theme_mod('headings_text_transform', 'none'); ?>;
            /* Individual heading sizes */
            <?php
            $headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
            $default_sizes = array(
                'h1' => '2.5',
                'h2' => '2',
                'h3' => '1.75',
                'h4' => '1.5',
                'h5' => '1.25',
                'h6' => '1',
            );
            foreach ($headings as $heading) {
                $font_size = get_theme_mod("{$heading}_font_size", $default_sizes[$heading]);
                $line_height = get_theme_mod("{$heading}_line_height", '1.2');
                $letter_spacing = get_theme_mod("{$heading}_letter_spacing", '0');
                echo "--{$heading}-font-size: {$font_size}rem;\n";
                echo "--{$heading}-line-height: {$line_height};\n";
                echo "--{$heading}-letter-spacing: {$letter_spacing}px;\n";
            }
            ?>

            /* Colors */
            --wp--preset--color--primary: <?php echo get_theme_mod('primary_color', '#2563eb'); ?>;
            --wp--preset--color--text: <?php echo get_theme_mod('text_color', '#1f2937'); ?>;
            --wp--preset--color--secondary: <?php echo get_theme_mod('secondary_color', '#475569'); ?>;
            --wp--preset--color--accent: <?php echo get_theme_mod('accent_color', '#f59e0b'); ?>;
            --wp--preset--color--light: <?php echo get_theme_mod('light_color', '#f3f4f6'); ?>;
            --wp--preset--color--dark: <?php echo get_theme_mod('dark_color', '#111827'); ?>;
            --wp--preset--color--content-bg: <?php echo get_theme_mod('content_bg_color', '#ffffff'); ?>;
            --wp--preset--color--bg: <?php echo get_theme_mod('bg_color', '#cececec7'); ?>;

            /* Logo dimensions */
            --logo-width: <?php echo get_theme_mod('logo_width', '150'); ?>px;

            /* Container Styles */
            --container-width: <?php echo get_theme_mod('container_width', '1200'); ?>px;
            --sidebar-width: <?php echo get_theme_mod('sidebar_width', 300); ?>px;
            --main-content-inner-padding: <?php echo get_theme_mod('main_content_inner_padding', 24); ?>px;

            /* Button Custom Properties */
            <?php if ($primary_btn_text !== '') : ?>
                --primary-btn-text: <?php echo esc_attr($primary_btn_text); ?>;
            <?php endif; ?>
            <?php if ($primary_btn_bg !== '') : ?>
                --primary-btn-bg: <?php echo esc_attr($primary_btn_bg); ?>;
            <?php endif; ?>
            <?php if ($primary_btn_border_color !== '') : ?>
                --primary-btn-border-color: <?php echo esc_attr($primary_btn_border_color); ?>;
            <?php endif; ?>
            --primary-btn-border-width: <?php echo esc_attr($primary_btn_border_width); ?>px;
            --primary-btn-radius: <?php echo esc_attr($primary_btn_radius); ?>px;
            --primary-btn-padding-top: <?php echo esc_attr($primary_btn_padding_top); ?>px;
            --primary-btn-padding-right: <?php echo esc_attr($primary_btn_padding_right); ?>px;
            --primary-btn-padding-bottom: <?php echo esc_attr($primary_btn_padding_bottom); ?>px;
            --primary-btn-padding-left: <?php echo esc_attr($primary_btn_padding_left); ?>px;
    
            <?php if ($secondary_btn_text !== '') : ?>
                --secondary-btn-text: <?php echo esc_attr($secondary_btn_text); ?>;
            <?php endif; ?>
            <?php if ($secondary_btn_bg !== '') : ?>
                --secondary-btn-bg: <?php echo esc_attr($secondary_btn_bg); ?>;
            <?php endif; ?>
            <?php if ($secondary_btn_border_color !== '') : ?>
                --secondary-btn-border-color: <?php echo esc_attr($secondary_btn_border_color); ?>;
            <?php endif; ?>
            --secondary-btn-border-width: <?php echo esc_attr($secondary_btn_border_width); ?>px;
            --secondary-btn-radius: <?php echo esc_attr($secondary_btn_radius); ?>px;
            --secondary-btn-padding-top: <?php echo esc_attr($secondary_btn_padding_top); ?>px;
            --secondary-btn-padding-right: <?php echo esc_attr($secondary_btn_padding_right); ?>px;
            --secondary-btn-padding-bottom: <?php echo esc_attr($secondary_btn_padding_bottom); ?>px;
            --secondary-btn-padding-left: <?php echo esc_attr($secondary_btn_padding_left); ?>px;

            /* Main Content Border Radius */
            --main-content-border-radius: <?php echo get_theme_mod('main_content_border_radius', 8); ?>px;

            /* Container Bowx Shadow */
            --container-box-shadow: <?php echo $container_box_shadow_css; ?>;

            /* Post Box Shadow */
            --post-box-shadow: <?php echo $post_box_shadow_css; ?>;

            /* Sidebar Box Shadow */
            --sidebar-box-shadow: <?php echo $sidebar_box_shadow_css; ?>;
        }

        /* Body Typography */
        body {
            font-family: var(--font-body);
            font-size: var(--body-font-size);
            line-height: var(--body-line-height);
            letter-spacing: var(--body-letter-spacing);
            font-weight: var(--body-font-weight);
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: var(--headings-font-weight);
            text-transform: var(--headings-text-transform);
        }
        h1 { font-size: var(--h1-font-size); line-height: var(--h1-line-height); letter-spacing: var(--h1-letter-spacing); }
        h2 { font-size: var(--h2-font-size); line-height: var(--h2-line-height); letter-spacing: var(--h2-letter-spacing); }
        h3 { font-size: var(--h3-font-size); line-height: var(--h3-line-height); letter-spacing: var(--h3-letter-spacing); }
        h4 { font-size: var(--h4-font-size); line-height: var(--h4-line-height); letter-spacing: var(--h4-letter-spacing); }
        h5 { font-size: var(--h5-font-size); line-height: var(--h5-line-height); letter-spacing: var(--h5-letter-spacing); }
        h6 { font-size: var(--h6-font-size); line-height: var(--h6-line-height); letter-spacing: var(--h6-letter-spacing); }

        /* Main Layout */
        .site-content {
            display: grid;
            width: 100%;
            max-width: var(--container-width);
            margin-left: auto;
            margin-right: auto;
            gap: 2rem;
        }
        body.sidebar-left .site-content {
            grid-template-columns: var(--sidebar-width) 1fr;
            justify-content: center;
        }
        body.sidebar-right .site-content {
            grid-template-columns: 1fr var(--sidebar-width);
            justify-content: center;
        }
        body.no-sidebar .site-content {
            grid-template-columns: 1fr;
            justify-content: center;
        }
        .main-content {
            padding: var(--main-content-inner-padding);
            border-radius: var(--main-content-border-radius);
            box-sizing: border-box;
            margin: 0 auto;
            width: 100%;
        }

        /* Content Wrapper */
        .content-sidebar-wrapper {
            width: 100%;
            max-width: var(--container-width);
            padding: 0;
        }


        .content-sidebar-wrapper .site-main {
            width: 100%;
        }

        .content-sidebar-wrapper .site-main .container {
            width: 100%;
            max-width: none;
            padding: 0;
        }

        .content-sidebar-wrapper .entry-content {
            max-width: var(--content-width);
            margin: 0 auto;
        }

        /* Sidebar Styles */
        .widget-area {
            width: var(--sidebar-width);
            position: sticky;
            top: 100px;
            align-self: start;
        }

        .widget-area[data-style="boxed"] {
            background-color: var(--wp--preset--color--content-bg);
            border-radius: 8px;
            box-shadow: var(--sidebar-box-shadow);
            padding: 1.5rem;
        }

        .widget-area[data-style="unboxed"] {
            background-color: transparent !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            padding: 0 !important;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .site-content {
                grid-template-columns: 1fr !important;
                padding: 1rem;
            }

            .widget-area {
                width: 100%;
                position: static;
            }

            .content-sidebar-wrapper {
                padding: 1rem;
            }

            .content-sidebar-wrapper[data-style="boxed"] {
                padding: 1.5rem;
            }
        }

        /* Customizer Preview Fixes */
        .wp-customizer .site-content {
            min-height: 100vh;
            display: grid;
        }

        .wp-customizer .site-footer {
            position: relative;
            z-index: 1;
        }

        /* Post Layout Styles */
        .content-sidebar-wrapper.posts-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .content-sidebar-wrapper.posts-grid {
            display: grid;
            gap: 2rem;
        }

        .content-sidebar-wrapper.grid-columns-2 { 
            grid-template-columns: repeat(2, 1fr); 
        }

        .content-sidebar-wrapper.grid-columns-3 { 
            grid-template-columns: repeat(3, 1fr); 
        }

        .content-sidebar-wrapper.grid-columns-4 { 
            grid-template-columns: repeat(4, 1fr); 
        }

        .content-sidebar-wrapper.posts-masonry {
            column-count: 3;
            column-gap: 2rem;
        }

        /* Article Styles */
        .blog-archive-post {
            width: 100%;
            max-width: 100%;
            margin: 0;
            background: var(--post-bg-color);
            border-radius: var(--post-border-radius);
            box-shadow: var(--post-box-shadow);
            padding: var(--post-padding);
            transition: all 0.3s ease;
        }

        article[data-style="unboxed"] {
            background: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            border-radius: 0 !important;
        }

        article[data-style="minimal"] {
            background: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            border-bottom: 1px solid var(--wp--preset--color--light);
            border-radius: 0 !important;
        }

        .entry-title {
            color: var(--post-title-color);
            margin-bottom: 0.5rem;
        }

        .entry-meta {
            color: var(--post-meta-color);
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .site-content {
                grid-template-columns: 1fr !important;
                padding: 1rem;
            }

            .content-sidebar-wrapper {
                padding: 1rem;
            }

            .content-sidebar-wrapper[data-style="boxed"] {
                padding: 1.5rem;
            }

            .content-sidebar-wrapper.posts-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            
            .content-sidebar-wrapper.posts-masonry {
                column-count: 2;
            }
        }

        @media (max-width: 768px) {
            .content-sidebar-wrapper.posts-grid {
                grid-template-columns: 1fr !important;
            }
            
            .content-sidebar-wrapper.posts-masonry {
                column-count: 1;
            }
            
            article {
                padding: 1rem;
            }
        }
    </style>
    <?php
}
add_action('wp_head', 'novacraft_customizer_css');

/**
 * Enqueue customizer scripts and styles
 */
function novacraft_customizer_scripts() {
    wp_enqueue_style(
        'novacraft-customizer',
        get_template_directory_uri() . '/assets/css/customizer.css',
        array(),
        NOVACRAFT_VERSION
    );

    wp_enqueue_script(
        'novacraft-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('jquery', 'customize-controls'),
        NOVACRAFT_VERSION,
        true
    );

        wp_enqueue_style(
        'pickr',
        get_template_directory_uri() . '/assets/css/classic.min.css',
        array(),
        '1.9.0'
    );
    wp_enqueue_script(
        'pickr',
        get_template_directory_uri() . '/assets/js/pickr.min.js',
        array(),
        '1.9.0',
        true
    );
    wp_enqueue_script(
        'novacraft-customizer-palette',
        get_template_directory_uri() . '/assets/js/customizer-palette.js',
        array('jquery', 'customize-controls', 'pickr'),
        NOVACRAFT_VERSION,
        true
    );
    wp_enqueue_style(
        'novacraft-customizer-palette',
        get_template_directory_uri() . '/assets/css/customizer-palette.css',
        array(),
        NOVACRAFT_VERSION
    );
}
add_action('customize_controls_enqueue_scripts', 'novacraft_customizer_scripts');

/**
 * Render the sidebar for the selective refresh partial.
 *
 * @return void
 */
function novacraft_customize_partial_sidebar() {
    get_template_part('template-parts/sidebar');
}