<?php
/**
 * Custom Boxed Multi-Property Control for the WordPress Customizer.
 *
 * @package NovaCraft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('NovaCraft_Boxed_Multi_Control')) {
    class NovaCraft_Boxed_Multi_Control extends WP_Customize_Control
    {
        public $type = 'novacraft_boxed_multi';
        public $linked_setting = ''; // Setting to control if values are linked

        public function render_content()
        {
            $top = $this->manager->get_setting($this->settings['top']->id)->value();
            $right = $this->manager->get_setting($this->settings['right']->id)->value();
            $bottom = $this->manager->get_setting($this->settings['bottom']->id)->value();
            $left = $this->manager->get_setting($this->settings['left']->id)->value();

            $linked_status = $this->manager->get_setting($this->linked_setting)->value();
            $is_linked = ('linked' === $linked_status);

            ?>
            <label class="novacraft-boxed-multi-label">
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>

                <div class="novacraft-boxed-multi-wrapper">
                    <div class="novacraft-multi-input-group">
                        <div class="novacraft-multi-input">
                            <input type="number" data-setting-id="<?php echo esc_attr($this->settings['top']->id); ?>" value="<?php echo esc_attr($top); ?>" min="0" max="100" step="1" />
                            <span class="novacraft-multi-label"><?php esc_html_e('TOP', 'novacraft'); ?></span>
                        </div>
                        <div class="novacraft-multi-input">
                            <input type="number" data-setting-id="<?php echo esc_attr($this->settings['right']->id); ?>" value="<?php echo esc_attr($right); ?>" min="0" max="100" step="1" />
                            <span class="novacraft-multi-label"><?php esc_html_e('RIGHT', 'novacraft'); ?></span>
                        </div>
                        <div class="novacraft-multi-input">
                            <input type="number" data-setting-id="<?php echo esc_attr($this->settings['bottom']->id); ?>" value="<?php echo esc_attr($bottom); ?>" min="0" max="100" step="1" />
                            <span class="novacraft-multi-label"><?php esc_html_e('BOTTOM', 'novacraft'); ?></span>
                        </div>
                        <div class="novacraft-multi-input">
                            <input type="number" data-setting-id="<?php echo esc_attr($this->settings['left']->id); ?>" value="<?php echo esc_attr($left); ?>" min="0" max="100" step="1" />
                            <span class="novacraft-multi-label"><?php esc_html_e('LEFT', 'novacraft'); ?></span>
                        </div>
                    </div>
                    <div class="novacraft-multi-units">
                        <button type="button" class="button novacraft-multi-link <?php echo $is_linked ? 'linked' : ''; ?>" data-setting-id="<?php echo esc_attr($this->linked_setting); ?>" data-linked="<?php echo esc_attr($is_linked ? 'true' : 'false'); ?>">
                            <span class="dashicons dashicons-admin-links"></span>
                        </button>
                        <span class="novacraft-unit-label">px</span>
                    </div>
                </div>
            </label>
            <?php
        }
    }
}
