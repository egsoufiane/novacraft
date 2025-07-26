jQuery(document).ready(function($) {
    // === Palette Presets ===
    const colorPresets = [
        {
            name: 'Classic Blue',
            colors: {
                'primary_color': '#2563eb',
                'accent_color': '#ff6b6b',
                'bg_color': '#ffffff',
                'text_color': '#333333',
                'secondary_color': '#475569',
                'content_bg_color': '#ffffff',
                'light_color': '#f3f4f6',
                'dark_color': '#111827'
            }
        },
        {
            name: 'Dark Mode',
            colors: {
                'primary_color': '#2563eb', // strong blue for actions/links/buttons
                'accent_color': '#f59e0b', // bright accent
                'bg_color': '#111827', // very dark background
                'text_color': '#f3f4f6', // very light for readability
                'secondary_color': '#475569', // muted for borders/subtle text
                'content_bg_color': '#1e293b', // slightly lighter than bg
                'light_color': '#334155', // mid-dark for post containers, good contrast with text
                'dark_color': '#0f172a' // pure dark for contrast
            }
        },
        {
            name: 'Pastel Dream',
            colors: {
                'primary_color': '#a5b4fc',
                'accent_color': '#fcd34d',
                'bg_color': '#fef3c7',
                'text_color': '#374151',
                'secondary_color': '#fca5a5',
                'content_bg_color': '#fff7ed',
                'light_color': '#f3f4f6',
                'dark_color': '#64748b'
            }
        },
        {
            name: 'Forest Green',
            colors: {
                'primary_color': '#166534',
                'accent_color': '#65a30d',
                'bg_color': '#f0fdf4',
                'text_color': '#1b1f23',
                'secondary_color': '#4ade80',
                'content_bg_color': '#ecfdf5',
                'light_color': '#d1fae5',
                'dark_color': '#052e16'
            }
        },
        {
            name: 'Modern Minimal',
            colors: {
                'primary_color': '#1f2937',
                'accent_color': '#3b82f6',
                'bg_color': '#f9fafb',
                'text_color': '#111827',
                'secondary_color': '#9ca3af',
                'content_bg_color': '#ffffff',
                'light_color': '#e5e7eb',
                'dark_color': '#1e293b'
            }
        },
        {
            name: 'Sunset Vibes',
            colors: {
                'primary_color': '#f97316',
                'accent_color': '#f43f5e',
                'bg_color': '#fff7ed',
                'text_color': '#374151',
                'secondary_color': '#fdba74',
                'content_bg_color': '#fffaf0',
                'light_color': '#ffedd5',
                'dark_color': '#78350f'
            }
        },
        {
            name: 'Ocean Breeze',
            colors: {
                'primary_color': '#0ea5e9',
                'accent_color': '#22d3ee',
                'bg_color': '#ecfeff',
                'text_color': '#0f172a',
                'secondary_color': '#38bdf8',
                'content_bg_color': '#e0f2fe',
                'light_color': '#bae6fd',
                'dark_color': '#0c4a6e'
            }
        },
        {
            name: 'Lavender Fields',
            colors: {
                'primary_color': '#8b5cf6',
                'accent_color': '#ec4899',
                'bg_color': '#faf5ff',
                'text_color': '#312e81',
                'secondary_color': '#c084fc',
                'content_bg_color': '#f3e8ff',
                'light_color': '#ede9fe',
                'dark_color': '#581c87'
            }
        }
    ];

    // Add edge classes to tooltips based on position
    // function adjustTooltipEdgeClasses() {
    //     const threshold = 50; // distance from edge before adjustment
    //     const containerWidth = $('#customize-theme-controls').width();

    //     $('.novacraft-color-circle, .theme-swatch').each(function () {
    //         const $el = $(this);
    //         const rect = this.getBoundingClientRect();

    //         // Remove previous edge classes
    //         $el.removeClass('left-edge right-edge');

    //         if (rect.left < threshold) {
    //             $el.addClass('left-edge');
    //         } else if (containerWidth - rect.right < threshold) {
    //             $el.addClass('right-edge');
    //         }
    //     });
    // }

    // function adjustTooltipEdgeClasses() {
    //     const threshold = 50; // pixels from edge
    //     const $container = $('#customize-theme-controls');
    //     const containerOffset = $container.offset().left;
    //     const containerWidth = $container.outerWidth();
    //     const containerRight = containerOffset + containerWidth;

    //     $('.novacraft-color-circle, .theme-swatch').each(function () {
    //         const $el = $(this);
    //         const rect = this.getBoundingClientRect();
    //         const elLeft = rect.left;
    //         const elRight = rect.right;

    //         $el.removeClass('left-edge right-edge');

    //         if (elLeft - containerOffset < threshold) {
    //             $el.addClass('left-edge');
    //         } else if (containerRight - elRight < threshold) {
    //             $el.addClass('right-edge');
    //         }
    //     });
    // }

    // function adjustTooltipEdgeClasses() {
    //     const threshold = 50; // pixels from edge
    //     const containerRect = $('#customize-theme-controls')[0].getBoundingClientRect();
    //     const containerLeft = containerRect.left;
    //     const containerRight = containerRect.right;

    //     $('.novacraft-color-circle, .theme-swatch').each(function () {
    //         const $el = $(this);
    //         const rect = this.getBoundingClientRect();
    //         const elLeft = rect.left;
    //         const elRight = rect.right;

    //         $el.removeClass('left-edge right-edge');

    //         if (elLeft - containerLeft < threshold) {
    //             $el.addClass('left-edge');
    //         } else if (containerRight - elRight < threshold) {
    //             $el.addClass('right-edge');
    //         }
    //     });
    // }

    // function adjustTooltipEdgeClasses() {
    //     const threshold = 50; // pixels from edge

    //     $('.novacraft-palette-row').each(function () {
    //         const rowRect = this.getBoundingClientRect();
    //         const rowLeft = rowRect.left;
    //         const rowRight = rowRect.right;

    //         $(this).find('.novacraft-color-circle, .theme-swatch').each(function () {
    //             const $el = $(this);
    //             const rect = this.getBoundingClientRect();
    //             const elLeft = rect.left;
    //             const elRight = rect.right;

    //             $el.removeClass('left-edge right-edge');

    //             if (elLeft - rowLeft < threshold) {
    //                 $el.addClass('left-edge');
    //             } else if (rowRight - elRight < threshold) {
    //                 $el.addClass('right-edge');
    //             }
    //         });
    //     });
    // }

    function adjustTooltipEdgeClasses() {
        const threshold = 50; // pixels from edge

        // Handle multi-color rows
        $('.novacraft-palette-row').each(function () {
            const rowRect = this.getBoundingClientRect();
            const rowLeft = rowRect.left;
            const rowRight = rowRect.right;

            $(this).find('.novacraft-color-circle, .theme-swatch').each(function () {
                const $el = $(this);
                const rect = this.getBoundingClientRect();
                const elLeft = rect.left;
                const elRight = rect.right;

                $el.removeClass('left-edge right-edge');

                if (elLeft - rowLeft < threshold) {
                    $el.addClass('left-edge');
                } else if (rowRight - elRight < threshold) {
                    $el.addClass('right-edge');
                }
            });
        });

        // Handle single color circles or swatches NOT in a row
        $('.novacraft-color-circle, .theme-swatch').each(function () {
            // Skip if already handled in a row
            if ($(this).closest('.novacraft-palette-row').length) return;

            const $el = $(this);
            const rect = this.getBoundingClientRect();
            // Use the sidebar as the container for singles
            const container = document.getElementById('customize-theme-controls');
            if (!container) return;
            const containerRect = container.getBoundingClientRect();
            const containerLeft = containerRect.left;
            const containerRight = containerRect.right;

            $el.removeClass('left-edge right-edge');

            if (rect.left - containerLeft < threshold) {
                $el.addClass('left-edge');
            } else if (containerRight - rect.right < threshold) {
                $el.addClass('right-edge');
            }
        });
    }

  
    // Add palette icon to top right
    const $paletteIcon = $('<span id="novacraft-palette-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M512.5 74.3L291.1 222C262 241.4 243.5 272.9 240.5 307.3C302.8 320.1 351.9 369.2 364.8 431.6C399.3 428.6 430.7 410.1 450.1 381L597.7 159.5C604.4 149.4 608 137.6 608 125.4C608 91.5 580.5 64 546.6 64C534.5 64 522.6 67.6 512.5 74.3zM320 464C320 402.1 269.9 352 208 352C146.1 352 96 402.1 96 464C96 467.9 96.2 471.8 96.6 475.6C98.4 493.1 86.4 512 68.8 512L64 512C46.3 512 32 526.3 32 544C32 561.7 46.3 576 64 576L208 576C269.9 576 320 525.9 320 464z"/></svg></span>');
    const $palettePopup = $('<div id="novacraft-palette-popup"></div>');
    
    // Render presets inside popup
    colorPresets.forEach(preset => {
        const presetEl = $('<div class="color-preset"></div>');
        const previewRow = $('<div class="preset-preview"></div>');
        for (const key in preset.colors) {
            previewRow.append(`<span class="color-box" data-color="${preset.colors[key]}" style="background:${preset.colors[key]}"></span>`);
        }
        presetEl.append(previewRow);
        presetEl.append(`<span class="preset-name">${preset.name}</span>`);
        presetEl.on('click', function() {
            for (const key in preset.colors) {
                const color = preset.colors[key];
                $(`input[data-customize-setting-link="${key}"]`).val(color).trigger('change');
                $(`.novacraft-color-circle[data-setting="${key}"]`).css('background', color)
                  .attr('data-title', key.replace(/_/g, ' ').replace('color', 'Color').replace('bg', 'Background').replace('accent', 'Accent').replace('primary', 'Primary').replace('secondary', 'Secondary').replace('text', 'Text').replace('light', 'Light').replace('dark', 'Dark').replace('content', 'Content').replace('Color', 'Color').replace(/\b\w/g, l => l.toUpperCase()));
            }
            $palettePopup.removeClass('active');
            $paletteIcon.removeClass('active');
        });
        $palettePopup.append(presetEl);
    });
    
    // Insert icon next to label, popup into main controls container
    $(function() {
        const $iconPlaceholder = $('#novacraft-palette-icon-placeholder');
        if ($iconPlaceholder.length) {
            $iconPlaceholder.append($paletteIcon);
        }
        // Always append popup to #customize-theme-controls for consistent alignment
        $('#customize-theme-controls').append($palettePopup);

        // Set data-title for all color circles on initial render
        $('.novacraft-color-circle').each(function() {
            var $circle = $(this);
            var setting = $circle.data('setting');
            if (setting) {
                // Short label logic
                var label = setting.replace(/_color$/, '').replace('primary', 'Primary').replace('accent', 'Accent').replace('bg', 'Background').replace('secondary', 'Secondary').replace('text', 'Text').replace('light', 'Light').replace('dark', 'Dark').replace('content_bg', 'Content').replace(/_/g, ' ');
                label = label.charAt(0).toUpperCase() + label.slice(1);
                $circle.attr('data-title', label);
            }
        });

         adjustTooltipEdgeClasses();
    });
    
    // Show/hide popup on icon click
    $(document).on('click', '#novacraft-palette-icon', function(e) {
        e.stopPropagation();
        // If popup is open, close it and remove .active from icon
        if ($palettePopup.hasClass('active')) {
            $palettePopup.removeClass('active');
            $paletteIcon.removeClass('active');
            return;
        }
        // Close color picker popup if open
        if (window.pickr && typeof window.pickr.hide === 'function') {
            window.pickr.hide();
        } else {
            // fallback: remove pickr popup if exists
            $('#novacraft-pickr-popup').remove();
        }
        // Position popup below icon, relative to palette header
        const $header = $paletteIcon.closest('.novacraft-palette-header');
        const iconPos = $paletteIcon.position();
        $palettePopup.css({
            position: 'absolute',
            top: iconPos.top + $paletteIcon.outerHeight() + 4,
            // left: iconPos.left,
            // width: '100%',
            zIndex: 10001
        });
        $palettePopup.addClass('active');
        $paletteIcon.addClass('active');
    });
    
    // Hide popup on outside click
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#novacraft-palette-popup, #novacraft-palette-icon').length) {
            $palettePopup.removeClass('active');
            $paletteIcon.removeClass('active');
        }
    });

    let pickr = null;
    let $popup = $('#novacraft-pickr-popup');
    let currentInput = null;

    function showPickr($circle, color, setting) {
        // Close palette popup if open
        $palettePopup.removeClass('active');
        // Remove any existing Pickr popup
        $('#novacraft-pickr-popup').remove();

        // Add a new Pickr popup to <body> with a dummy mount span
        $('#customize-theme-controls').append('<div id="novacraft-pickr-popup"><span id="pickr-mount"></span></div>');
        $popup = $('#novacraft-pickr-popup');
        $popup.show();

        // Position the popup centered below the palette row (multi) or below the color circle (single)
        let $row = $circle.closest('.novacraft-palette-row').length ? $circle.closest('.novacraft-palette-row') : $circle;
        let rowOffset = $row.offset();
        let rowWidth = $row.outerWidth();
        let popupWidth = Math.min(340, rowWidth - 16);

        // Center the popup below the reference row/circle
        let left = rowOffset.left + (rowWidth / 2) - (popupWidth / 2);
        let top = rowOffset.top + $row.outerHeight() - 45;

        $popup.css({
            top: top,
            position: 'absolute',
            width: popupWidth + 'px',
            'z-index': 99999,
            overflow: 'visible'
        });

        // Only inject swatches for UI element pickers, not theme palette controls
        let $paletteRow = $circle.closest('.novacraft-palette-row');
        let isThemePalette = $paletteRow.length && $paletteRow.hasClass('novacraft-theme-palette-row');
        let isThemeColor = $circle.data('setting') && (
            $circle.data('setting').toString().match(/^(primary|accent|bg|text|secondary|content_bg|light|dark)_color$/)
        );
        if (!isThemePalette && !isThemeColor) {
            // Get all theme color values from hidden inputs in the Customizer
            let themeColors = [];
            $('.novacraft-palette-input').each(function() {
                const color = $(this).val();
                const setting = $(this).data('customize-setting-link');
                let label = '';
                if (setting) {
                    label = setting.replace(/_color$/, '')
                        .replace('primary', 'Primary')
                        .replace('accent', 'Accent')
                        .replace('bg', 'Background')
                        .replace('secondary', 'Secondary')
                        .replace('text', 'Text')
                        .replace('light', 'Light')
                        .replace('dark', 'Dark')
                        .replace('content_bg', 'Content')
                        .replace(/_/g, ' ');
                    label = label.charAt(0).toUpperCase() + label.slice(1);
                }
                if (color) {
                    themeColors.push({ color, label });
                }
            });
            // Remove duplicates (in case of multiple controls)
            themeColors = themeColors.filter((v,i,a)=>a.findIndex(t=>(t.color===v.color))===i);

            // Create swatch row visually inside Pickr panel
            const $swatchRow = $('<div class="novacraft-theme-swatches"></div>');
            themeColors.forEach(tc => {
                // Checkerboard for transparent colors
                let checker = '';
                if (/rgba\(.+,\s*0(\.\d+)?\)/.test(tc.color) || tc.color === 'transparent') {
                    checker = 'background-image: repeating-linear-gradient(45deg,#eee 0 8px,transparent 8px 16px), repeating-linear-gradient(-45deg,#eee 0 8px,transparent 8px 16px);background-size:16px 16px;';
                }
                // Set data-title and use only class for styling; background handled by CSS
                const $swatch = $(`<span class="theme-swatch" data-title="${tc.label}"></span>`);
                $swatch.css('background', tc.color);
               $swatch.removeAttr('title');
                if (checker) {
                    $swatch.css('background-image', 'repeating-linear-gradient(45deg,#eee 0 8px,transparent 8px 16px), repeating-linear-gradient(-45deg,#eee 0 8px,transparent 8px 16px)');
                    $swatch.css('background-size', '16px 16px');
                }
                $swatch.on('click', function() {
                    pickr.setColor(tc.color);
                    currentInput.val(tc.color).trigger('change');
                    $circle.css('background', tc.color);
                });
                $swatchRow.append($swatch);
            });
            // Insert swatch row before Pickr mount (top of Pickr panel)
            $popup.find('#pickr-mount').before($swatchRow);
            
            adjustTooltipEdgeClasses();
        }

        // Destroy previous Pickr instance if exists
        if (pickr) {
            pickr.destroyAndRemove();
        }

        // Create Pickr on the dummy mount span, with inline panel
        pickr = Pickr.create({
            el: '#pickr-mount',
            theme: 'classic',
            default: color,
            showAlways: true,
            inline: true,
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: {
                    hex: true,
                    rgba: true,
                    input: true,
                    clear: true,
                    save: false // Remove save button
                }
            }
        });

        // Set current input for updates
        currentInput = $(`input[data-customize-setting-link="${setting}"]`);

        pickr.on('change', (colorObj) => {
            const rgba = colorObj.toRGBA();
            const alpha = rgba[3];
            let selectedColor;
            if (alpha < 1) {
                // Use rgba string for semi-transparent colors
                selectedColor = `rgba(${Math.round(rgba[0])},${Math.round(rgba[1])},${Math.round(rgba[2])},${alpha.toFixed(2)})`;
            } else {
                // Use hex for fully opaque
                selectedColor = colorObj.toHEXA().toString();
            }
            currentInput.val(selectedColor).trigger('change');
            $circle.css('background', selectedColor);
        });

        // Handle Pickr clear event for any color setting
        pickr.on('clear', () => {
            currentInput.val('').trigger('change');
            // Remove inline background for true reset
            $circle.css('background', '');
            pickr.setColor(null); // fallback to empty if no palette color
        });

        pickr.on('hide', () => {
            $popup.hide();
        });
    }

    // Show/Hide Pickr on circle click (toggle)
    $(document).on('click', '.novacraft-color-circle', function(e) {
        e.stopPropagation();
        let $circle = $(this);

        // If this circle is already active, close the picker and remove active state
        if ($circle.hasClass('active')) {
            if (pickr) pickr.hide();
            $circle.removeClass('active');
            return;
        }

        $('.novacraft-color-circle').removeClass('active');
        $circle.addClass('active');
        let color = $(`input[data-customize-setting-link="${$circle.data('setting')}"]`).val();
        let setting = $circle.data('setting');
        // --- Use the same label logic as initial render ---
        let label = setting.replace(/_color$/, '')
            .replace('primary', 'Primary')
            .replace('accent', 'Accent')
            .replace('bg', 'Background')
            .replace('secondary', 'Secondary')
            .replace('text', 'Text')
            .replace('light', 'Light')
            .replace('dark', 'Dark')
            .replace('content_bg', 'Content')
            .replace(/_/g, ' ');
        label = label.charAt(0).toUpperCase() + label.slice(1);
        $circle.attr('data-title', label);
        $circle.removeAttr('title');
        showPickr($circle, color, setting);
    });

    // Hide Pickr on outside click
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#novacraft-pickr-popup, .novacraft-color-circle').length) {
            if (pickr) pickr.hide();
            $('.novacraft-color-circle').removeClass('active');
        }
    });

    // --- Prevent browser default tooltip for theme color circles ---
    // This ensures the title attribute is always removed, even if set by other scripts or HTML.
    $(document).on('mouseenter', '.novacraft-color-circle', function() {
        $(this).removeAttr('title');
    });
    // --- End prevent browser tooltip ---
});