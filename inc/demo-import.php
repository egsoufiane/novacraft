<?php
/**
 * NovaCraft Theme Demo Import
 *
 * This file contains the demo import configuration for the NovaCraft theme.
 * It uses the One Click Demo Import plugin to set up demo content.
 *
 * @package NovaCraft
 */

//Manual Import
// function my_theme_import_files() {
//     $base_url = 'https://cdn.jsdelivr.net/gh/egsoufiane/ocdi@main';

//     return [
//         [
//             'import_file_name'           => 'Demo 1',
//             'import_file_url'            => $base_url . '/demo_1/content_1.xml',
//             'import_widget_file_url'     => $base_url . '/demo_1/widgets_1.wie',
//             'import_customizer_file_url' => $base_url . '/demo_1/customizer_1.dat',
//             'preview_url'                => 'https://your-site.com/demo1',
//             'categories'                 => ['General'],
//         ],
//         [
//             'import_file_name'           => 'Demo 7 (Elementor Kit Only)',
//             'import_notice'              => 'Elementor Kit will also be imported.',
//             'preview_url'                => 'https://your-site.com/demo7',
//             'categories'                 => ['Elementor Kit'],
//             'import_preview_image_url'   => $base_url . '/demo_7/preview.jpg',
//             'elementor_kit_zip'          => $base_url . '/demo_7/kit.zip', // custom key for kit
//             'import_id'                  => 'demo_7', // optional
//         ],
//         [
//             'import_file_name'           => 'Demo 8 (Elementor Kit Only)',
//             'import_notice'              => 'Elementor Kit will also be imported.',
//             'preview_url'                => 'https://your-site.com/demo7',
//             'categories'                 => ['Elementor Kit'],
//             'import_preview_image_url'   => $base_url . '/demo_8/preview.jpg',
//             'elementor_kit_zip'          => $base_url . '/demo_8/kit.zip', // custom key for kit
//             'import_id'                  => 'demo_8', // optional
//         ],
//     ];
// }
// add_filter('pt-ocdi/import_files', 'my_theme_import_files');

//Automatic Import
function my_theme_import_files() {
    // $base_url = 'https://cdn.jsdelivr.net/gh/egsoufiane/ocdi@main';
    $base_url = 'https://egsoufiane.github.io/ocdi';
    $json_url = $base_url . '/demos.json';

    $response = wp_remote_get($json_url);
    if (is_wp_error($response)) {
        return []; // gracefully return if error
    }

    $body = wp_remote_retrieve_body($response);
    $demos = json_decode($body, true);
    if (!is_array($demos)) {
        return [];
    }

    $import_files = [];

    foreach ($demos as $demo) {
        $folder = 'demos/' . $demo['folder'];
        $name = $demo['name'] ?? ucfirst(str_replace('_', ' ', $folder));
        $preview_url = $demo['preview'] ?? '';
        $has_kit = $demo['kit'] ?? false;

        $item = [
            'import_file_name' => $name,
            'preview_url' => $preview_url,
            'categories' => [$has_kit ? 'Elementor Kit' : 'General'],
        ];

        // Optional files
        if (!empty($demo['content'])) {
            $item['import_file_url'] = "$base_url/$folder/{$demo['content']}";
        }
        if (!empty($demo['widgets'])) {
            $item['import_widget_file_url'] = "$base_url/$folder/{$demo['widgets']}";
        }
        if (!empty($demo['customizer'])) {
            $item['import_customizer_file_url'] = "$base_url/$folder/{$demo['customizer']}";
        }
        if (!empty($demo['preview_image'])) {
            $item['import_preview_image_url'] = "$base_url/$folder/{$demo['preview_image']}";
        }
        if ($has_kit && !empty($demo['kit_file'])) {
            $item['elementor_kit_zip'] = "$base_url/$folder/{$demo['kit_file']}";
            $item['import_notice'] = 'Elementor Kit will also be imported.';
            $item['import_id'] = $folder;
        }

        $import_files[] = $item;
    }

    return $import_files;
}
add_filter('pt-ocdi/import_files', 'my_theme_import_files');

add_action('pt-ocdi/after_import', function ($selected_import) {
    if (empty($selected_import['elementor_kit_zip'])) {
        return;
    }

    if (!class_exists('\Elementor\Plugin')) {
        echo '<div class="notice notice-error"><p><strong>Error:</strong> Elementor plugin is not active. Skipping kit import.</p></div>';
        return;
    }

    $kit_url = esc_url_raw($selected_import['elementor_kit_zip']);
    $tmp_zip = download_url($kit_url);

    if (is_wp_error($tmp_zip)) {
        error_log('[Elementor Kit Import] Download failed: ' . $tmp_zip->get_error_message());
        return;
    }

    $result = elementor_import_kit($tmp_zip);

    if (is_wp_error($result)) {
        error_log('[Elementor Kit Import] Import failed: ' . $result->get_error_message());
    } else {
        error_log('[Elementor Kit Import] Kit imported successfully.');
    }

    @unlink($tmp_zip); // Clean up
});

function elementor_import_kit($file_path) {
    if (!file_exists($file_path)) {
        return new \WP_Error('file_not_found', 'File not found.');
    }

    $import_settings = [
        'referrer' => defined('\Elementor\App\Modules\ImportExport\Module::REFERRER_LOCAL')
            ? \Elementor\App\Modules\ImportExport\Module::REFERRER_LOCAL
            : 'local',
    ];

    $import_export_module = \Elementor\Plugin::$instance->app->get_component('import-export');

    if (!$import_export_module) {
        return new \WP_Error('module_not_found', 'Elementor Import Export module not available.');
    }

    try {
        $import_export_module->import_kit($file_path, $import_settings);
        return 'Kit imported successfully';
    } catch (\Exception $e) {
        \Elementor\Plugin::$instance->logger->get_logger()->error($e->getMessage(), [
            'meta' => [
                'trace' => $e->getTraceAsString(),
            ],
        ]);
        return new \WP_Error('import_failed', $e->getMessage());
    }
}
