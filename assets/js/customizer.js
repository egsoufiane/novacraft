/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
    'use strict';
    
    // === Button Live Preview ===
    // === Primary Button Live Preview ===
    wp.customize('primary_button_text_color', function(value) {
        value.bind(function(to) {
            if (to) {
                document.documentElement.style.setProperty('--primary-btn-text', to);
                $('.primary-button').css('color', to);
            } else {
                document.documentElement.style.removeProperty('--primary-btn-text');
                $('.primary-button').css('color', '');
                removeCSSVariableFromStyleTags('primary-btn-text');
            }
        });
    });

    wp.customize('primary_button_bg_color', function(value) {
        value.bind(function(to) {
            if (to) {
                document.documentElement.style.setProperty('--primary-btn-bg', to);
                $('.primary-button').css('background-color', to);
            } else {
                document.documentElement.style.removeProperty('--primary-btn-bg');
                $('.primary-button').css('background-color', '');
                removeCSSVariableFromStyleTags('primary-btn-bg');
            }
        });
    });
    wp.customize('primary_button_border_color', function(value) {
        value.bind(function(to) {
            if (to) {
                document.documentElement.style.setProperty('--primary-btn-border-color', to);
                $('.primary-button').css('border-color', to);
            } else {
                document.documentElement.style.removeProperty('--primary-btn-border-color');
                $('.primary-button').css('border-color', '');
                removeCSSVariableFromStyleTags('primary-btn-border-color');
            }
        });
    });
    wp.customize('primary_button_border_width', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--primary-btn-border-width', to + 'px');
            $('.primary-button').css('border-width', to + 'px');
        });
    });
    wp.customize('primary_button_border_radius', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--primary-btn-radius', to + 'px');
            $('.primary-button').css('border-radius', to + 'px');
        });
    });

    // === Primary Button Padding Live Preview ===
    wp.customize('primary_button_padding_top', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            document.documentElement.style.setProperty('--primary-btn-padding-top', padding);
            $('.primary-button').css('padding-top', padding);
        });
    });
    wp.customize('primary_button_padding_right', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            document.documentElement.style.setProperty('--primary-btn-padding-right', padding);
            $('.primary-button').css('padding-right', padding);
        });
    });
    wp.customize('primary_button_padding_bottom', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            document.documentElement.style.setProperty('--primary-btn-padding-bottom', padding);
            $('.primary-button').css('padding-bottom', padding);
        });
    });
    wp.customize('primary_button_padding_left', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            document.documentElement.style.setProperty('--primary-btn-padding-left', padding);
            $('.primary-button').css('padding-left', padding);
        });
    });

    // === Secondary Button Live Preview ===
    wp.customize('secondary_button_text_color', function(value) {
        value.bind(function(to) {
            if (to) {
                document.documentElement.style.setProperty('--secondary-btn-text', to);
                $('.secondary-button').css('color', to);
            } else {
                document.documentElement.style.removeProperty('--secondary-btn-text');
                $('.secondary-button').css('color', '');
                removeCSSVariableFromStyleTags('secondary-btn-text');
            }
        });
    });
    wp.customize('secondary_button_bg_color', function(value) {
        value.bind(function(to) {
            if (to) {
                document.documentElement.style.setProperty('--secondary-btn-bg', to);
                $('.secondary-button').css('background-color', to);
            } else {
                document.documentElement.style.removeProperty('--secondary-btn-bg');
                $('.secondary-button').css('background-color', '');
                removeCSSVariableFromStyleTags('secondary-btn-bg');
            }
        });
    });
    wp.customize('secondary_button_border_color', function(value) {
        value.bind(function(to) {
            if (to) {
                document.documentElement.style.setProperty('--secondary-btn-border-color', to);
                $('.secondary-button').css('border-color', to);
            } else {
                document.documentElement.style.removeProperty('--secondary-btn-border-color');
                $('.secondary-button').css('border-color', '');
                removeCSSVariableFromStyleTags('secondary-btn-border-color');
            }
        });
    });
    wp.customize('secondary_button_border_width', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--secondary-btn-border-width', to + 'px');
            $('.secondary-button').css('border-width', to + 'px');
        });
    });
    wp.customize('secondary_button_border_radius', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--secondary-btn-radius', to + 'px');
            $('.secondary-button').css('border-radius', to + 'px');
        });
    });

    // === Secondary Button Padding Live Preview ===
    wp.customize('secondary_button_padding_top', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            document.documentElement.style.setProperty('--secondary-btn-padding-top', padding);
            $('.secondary-button').css('padding-top', padding);
        });
    });
    wp.customize('secondary_button_padding_right', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            document.documentElement.style.setProperty('--secondary-btn-padding-right', padding);
            $('.secondary-button').css('padding-right', padding);
        });
    });
    wp.customize('secondary_button_padding_bottom', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            document.documentElement.style.setProperty('--secondary-btn-padding-bottom', padding);
            $('.secondary-button').css('padding-bottom', padding);
        });
    });
    wp.customize('secondary_button_padding_left', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            document.documentElement.style.setProperty('--secondary-btn-padding-left', padding);
            $('.secondary-button').css('padding-left', padding);
        });
    });

    //Handle Linking and Unlinking for Primary Button Padding
    wp.customize.bind('ready', function() {
        var control = wp.customize.control('primary_button_padding');
        if (!control) return;
        var linkButton = control.container.find('.novacraft-multi-link');
        var paddingInputs = control.container.find('.novacraft-multi-input input[type="number"]');
        // Handle link button click
        linkButton.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var settingObj = wp.customize('primary_button_padding_linked');
            if (!settingObj) return;
            var currentState = settingObj.get();
            var newState = currentState === 'linked' ? 'unlinked' : 'linked';
            if (newState === 'linked') {
                linkButton.addClass('linked');
                // When linking, sync all values to the first input's value
                var firstValue = paddingInputs.first().val();
                paddingInputs.not(':first').each(function() {
                    var input = $(this);
                    input.val(firstValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(firstValue);
                    }
                });
            } else {
                linkButton.removeClass('linked');
            }
            settingObj.set(newState);
        });
        // Synchronize inputs when linked
        paddingInputs.on('input', function () {
            var settingObj = wp.customize('primary_button_padding_linked');
            if (!settingObj) return;
            if (settingObj.get() === 'linked') {
                var changedInput = $(this);
                var newValue = changedInput.val();
                paddingInputs.not(changedInput).each(function() {
                    var input = $(this);
                    input.val(newValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(newValue);
                    }
                });
            }
        });
        // Update linked state visually when setting changes
        var settingObj = wp.customize('primary_button_padding_linked');
        if (settingObj) {
            settingObj.bind(function (newval) {
                if (newval === 'linked') {
                    linkButton.addClass('linked');
                } else {
                    linkButton.removeClass('linked');
                }
            });
        }
        // Update individual settings when input changes
        paddingInputs.on('change', function () {
            var settingId = $(this).data('setting-id');
            var newValue = $(this).val();
            if (wp.customize(settingId)) {
                wp.customize(settingId).set(newValue);
            }
        });
    });

    // === Primary Button Padding Live Preview ===
    ['top', 'right', 'bottom', 'left'].forEach(function(dir) {
        wp.customize('primary_button_padding_' + dir, function(value) {
            value.bind(function(to) {
                var cssVar = '--primary-btn-padding-' + dir;
                var padding = to + 'px';
                document.documentElement.style.setProperty(cssVar, padding);
                $('.primary-button').css('padding-' + dir, padding);
            });
        });
    });

    //Handle Linking and Unlinking for Secondary Button Padding
    wp.customize.bind('ready', function() {
        var control = wp.customize.control('secondary_button_padding');
        if (!control) return;
        var linkButton = control.container.find('.novacraft-multi-link');
        var paddingInputs = control.container.find('.novacraft-multi-input input[type="number"]');
        // Handle link button click
        linkButton.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var settingObj = wp.customize('secondary_button_padding_linked');
            if (!settingObj) return;
            var currentState = settingObj.get();
            var newState = currentState === 'linked' ? 'unlinked' : 'linked';
            if (newState === 'linked') {
                linkButton.addClass('linked');
                // When linking, sync all values to the first input's value
                var firstValue = paddingInputs.first().val();
                paddingInputs.not(':first').each(function() {
                    var input = $(this);
                    input.val(firstValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(firstValue);
                    }
                });
            } else {
                linkButton.removeClass('linked');
            }
            settingObj.set(newState);
        });
        // Synchronize inputs when linked
        paddingInputs.on('input', function () {
            var settingObj = wp.customize('secondary_button_padding_linked');
            if (!settingObj) return;
            if (settingObj.get() === 'linked') {
                var changedInput = $(this);
                var newValue = changedInput.val();
                paddingInputs.not(changedInput).each(function() {
                    var input = $(this);
                    input.val(newValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(newValue);
                    }
                });
            }
        });
        // Update linked state visually when setting changes
        var settingObj = wp.customize('secondary_button_padding_linked');
        if (settingObj) {
            settingObj.bind(function (newval) {
                if (newval === 'linked') {
                    linkButton.addClass('linked');
                } else {
                    linkButton.removeClass('linked');
                }
            });
        }
        // Update individual settings when input changes
        paddingInputs.on('change', function () {
            var settingId = $(this).data('setting-id');
            var newValue = $(this).val();
            if (wp.customize(settingId)) {
                wp.customize(settingId).set(newValue);
            }
        });
    });

    // === Secondary Button Padding Live Preview ===
    ['top', 'right', 'bottom', 'left'].forEach(function(dir) {
        wp.customize('secondary_button_padding_' + dir, function(value) {
            value.bind(function(to) {
                var cssVar = '--secondary-btn-padding-' + dir;
                var padding = to + 'px';
                document.documentElement.style.setProperty(cssVar, padding);
                $('.secondary-button').css('padding-' + dir, padding);
            });
        });
    });

    // Helper function to update CSS custom properties
    function updateCSSProperty(property, value) {
        document.documentElement.style.setProperty(property, value);
    }

    // Helper function to update multiple CSS properties
    function updateMultipleCSSProperties(properties) {
        Object.entries(properties).forEach(([property, value]) => {
            updateCSSProperty(property, value);
        });
    }

    // Helper to remove a CSS variable from all <style> tags in the document
    function removeCSSVariableFromStyleTags(varName) {
        $('style').each(function() {
            let styleTag = $(this);
            let css = styleTag.html();
            // Remove the variable definition from :root
            let newCss = css.replace(new RegExp(`(--${varName}:\\s*[^;]+;\\s*)`, 'g'), '');
            if (newCss !== css) {
                styleTag.html(newCss);
            }
        });
    }

    // Site title and description
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Header text color
    wp.customize('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    clip: 'rect(1px, 1px, 1px, 1px)',
                    position: 'absolute',
                });
            } else {
                $('.site-title, .site-description').css({
                    clip: 'auto',
                    position: 'relative',
                });
                $('.site-title a, .site-description').css({
                    color: to,
                });
            }
        });
    });

    // Theme colors
    const colorSettings = {
        'primary_color': '--wp--preset--color--primary',
        'content_bg_color': '--wp--preset--color--content-bg',
        'bg_color': '--wp--preset--color--bg',
        'text_color': '--wp--preset--color--text',
        'secondary_color': '--wp--preset--color--secondary',
        'accent_color': '--wp--preset--color--accent',
        'light_color': '--wp--preset--color--light',
        'dark_color': '--wp--preset--color--dark'
    };

    Object.entries(colorSettings).forEach(([setting, property]) => {
        wp.customize(setting, function(value) {
            value.bind(function(to) {
                updateCSSProperty(property, to);
            });
        });
    });

    // Logo handling
    wp.customize('logo_width', function(value) {
        value.bind(function(to) {
            const logoImg = $('.custom-logo-link img');
            if (logoImg.length) {
                const originalWidth = logoImg.data('original-width') || logoImg[0].naturalWidth;
                const originalHeight = logoImg.data('original-height') || logoImg[0].naturalHeight;
                
                if (!logoImg.data('original-width')) {
                    logoImg.data('original-width', originalWidth);
                    logoImg.data('original-height', originalHeight);
                }
                
                const aspectRatio = originalHeight / originalWidth;
                const newHeight = Math.round(to * aspectRatio);
                
                logoImg.css({
                    width: to + 'px',
                    height: newHeight + 'px'
                });
            }
        });
    });

    // Logo Size
    wp.customize('logo_height', function(value) {
        value.bind(function(to) {
            $('.custom-logo-link img').css('height', to + 'px');
        });
    });

    // Typography
    const typographySettings = {
        'body_font': '--font-body',
        'heading_font': '--font-heading',
        'base_font_size': '--body-font-size',
        'line_height': '--body-line-height'
    };

    Object.entries(typographySettings).forEach(([setting, property]) => {
        wp.customize(setting, function(value) {
            value.bind(function(to) {
                if (setting === 'body_font' || setting === 'heading_font') {
                    updateCSSProperty(property, `'${to}', sans-serif`);
                } else if (setting === 'base_font_size') {
                    updateCSSProperty(property, to + 'px');
                    document.documentElement.style.fontSize = to + 'px';
                } else {
                    updateCSSProperty(property, to);
                    document.body.style.lineHeight = to;
                }
            });
        });
    });

    // Container Width
    wp.customize('container_width', function(value) {
        value.bind(function(newval) {
            let width = '';
            switch(newval) {
                case 'narrow':
                    width = '640px';
                    break;
                case 'wide':
                    width = '100%';
                    break;
                case 'custom':
                    width = wp.customize('custom_container_width').get() + 'px';
                    break;
                default:
                    width = '1100px';
            }
            updateCSSProperty('--container-width', width);
            $('.site-content, .content-sidebar-wrapper').css({
                'max-width': width,
                'width': width === '100%' ? '100%' : 'auto'
            });
        });
    });

    // Custom Container Width
    wp.customize('custom_container_width', function(value) {
        value.bind(function(newval) {
            if (wp.customize('container_width').get() === 'custom') {
                const width = newval + 'px';
                updateCSSProperty('--container-width', width);
                $('.site-content, .content-sidebar-wrapper').css({
                    'max-width': width,
                    'width': 'auto'
                });
            }
        });
    });

    // Container Style
    wp.customize('container_style', function(value) {
        value.bind(function(newval) {
            const styles = newval === 'unboxed' ? {
                'background-color': 'transparent',
                'box-shadow': 'none',
                'padding': '0'
            } : {
                'background-color': 'var(--wp--preset--color--content-bg)',
                'box-shadow': 'var(--container-box-shadow)',
            };
            
            $('.main-content').css(styles);
        });
    });

    // Container Box Shadow
    wp.customize('container_box_shadow', function(value) {
        value.bind(function(newval) {
            const shadows = {
                'none' :'none',
                'small' : '0 1px 3px rgba(0, 0, 0, 0.1)',
                'medium' : '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
                'large' : '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
            };
            
            const shadow = shadows[newval] || 'none';
            updateCSSProperty('--container-box-shadow', shadow);
            $('.main-content').css('box-shadow', shadow);
        });
    });

    // Sidebar Position
    wp.customize('sidebar_position', function(value) {
        value.bind(function(to) {
            // Remove all sidebar classes
            $('body').removeClass('sidebar-left sidebar-right sidebar-both no-sidebar');
            
            // Add appropriate class
            if (to === 'none') {
                $('body').addClass('no-sidebar');
            } else {
                $('body').addClass('sidebar-' + to);
            }

            // Update grid layout
            const layouts = {
                'left': {
                    template: 'var(--sidebar-width) minmax(0, 1fr)',
                    left: { display: 'block', gridColumn: '1' },
                    right: { display: 'none' },
                    main: { gridColumn: '2' }
                },
                'right': {
                    template: 'minmax(0, 1fr) var(--sidebar-width)',
                    left: { display: 'none' },
                    right: { display: 'block', gridColumn: '2' },
                    main: { gridColumn: '1' }
                },
                'both': {
                    template: 'var(--sidebar-width) minmax(0, 1fr) var(--sidebar-width)',
                    left: { display: 'block', gridColumn: '1', justifySelf: 'start' },
                    right: { display: 'block', gridColumn: '3', justifySelf: 'end' },
                    main: { gridColumn: '2', justifySelf: 'center' }
                },
                'none': {
                    template: '1fr',
                    left: { display: 'none' },
                    right: { display: 'none' },
                    main: { gridColumn: '1 / -1' }
                }
            };

            const layout = layouts[to] || layouts.none;
            
            $('.content-sidebar-inner').css({
                'grid-template-columns': layout.template,
                'width': '100%',
                'max-width': '100%',
                'margin': '0 auto',
                'justify-content': 'center',
                'align-items': 'start',
                'display': 'grid',
                'gap': '2rem'
            });
            
            $('.content-sidebar-wrapper').css({
                'width': '100%',
                'max-width': 'var(--container-width)',
                'margin': '0 auto',
                'display': 'flex',
                'justify-content': 'center'
            });
            
            $('.sidebar-left-container').css(layout.left);
            $('.sidebar-right-container').css(layout.right);
            $('.main-content').css(layout.main);
        });
    });

    // Footer
    wp.customize('footer_text', function(value) {
        value.bind(function(to) {
            $('.site-info').html(to);
        });
    });

    wp.customize('show_social_icons', function(value) {
        value.bind(function(to) {
            if (to) {
                $('.social-icons').show();
            } else {
                $('.social-icons').hide();
            }
        });
    });

    // Social Media URLs
    wp.customize('facebook_url', function(value) {
        value.bind(function(to) {
            $('.social-icons .facebook').attr('href', to);
        });
    });

    wp.customize('twitter_url', function(value) {
        value.bind(function(to) {
            $('.social-icons .twitter').attr('href', to);
        });
    });

    wp.customize('instagram_url', function(value) {
        value.bind(function(to) {
            $('.social-icons .instagram').attr('href', to);
        });
    });

    wp.customize('linkedin_url', function(value) {
        value.bind(function(to) {
            $('.social-icons .linkedin').attr('href', to);
        });
    });

    wp.customize('youtube_url', function(value) {
        value.bind(function(to) {
            $('.social-icons .youtube').attr('href', to);
        });
    });

    // Typography live preview
    wp.customize('body_font_family', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--font-body', `'${newval}', sans-serif`);
        });
    });
    wp.customize('body_font_size', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--body-font-size', newval + 'px');
        });
    });
    wp.customize('body_line_height', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--body-line-height', newval);
        });
    });
    wp.customize('body_letter_spacing', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--body-letter-spacing', newval + 'px');
        });
    });
    wp.customize('body_font_weight', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--body-font-weight', newval);
        });
    });
    wp.customize('headings_font_family', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--font-heading', `'${newval}', sans-serif`);
        });
    });
    wp.customize('headings_font_weight', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--headings-font-weight', newval);
        });
    });
    wp.customize('headings_text_transform', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--headings-text-transform', newval);
        });
    });
    // Individual heading sizes
    ['h1','h2','h3','h4','h5','h6'].forEach(function(tag) {
        wp.customize(tag + '_font_size', function(value) {
            value.bind(function(newval) {
                document.documentElement.style.setProperty('--' + tag + '-font-size', newval + 'rem');
            });
        });
        wp.customize(tag + '_line_height', function(value) {
            value.bind(function(newval) {
                document.documentElement.style.setProperty('--' + tag + '-line-height', newval);
            });
        });
        wp.customize(tag + '_letter_spacing', function(value) {
            value.bind(function(newval) {
                document.documentElement.style.setProperty('--' + tag + '-letter-spacing', newval + 'px');
            });
        });
    });

    // Handle typography button clicks
    $(document).on('click', '.novacraft-typography-button', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var popupId = $(this).data('popup-id');
        var $popup = $('#' + popupId);
        var $button = $(this);
        
        // Close all other popups
        $('.novacraft-typography-popup').not($popup).hide();
        
        // Toggle current popup
        $popup.toggle();
        
        if ($popup.is(':visible')) {
            // Calculate position
            var buttonOffset = $button.offset();
            var buttonHeight = $button.outerHeight();
            var popupHeight = $popup.outerHeight();
            var windowHeight = $(window).height();
            
            // Position popup vertically centered on the button
            var topPosition = buttonOffset.top + (buttonHeight / 2);
            
            // Ensure popup doesn't go off screen
            if (topPosition + (popupHeight / 2) > windowHeight) {
                topPosition = windowHeight - (popupHeight / 2) - 20;
            }
            if (topPosition - (popupHeight / 2) < 0) {
                topPosition = (popupHeight / 2) + 20;
            }
            
            $popup.css('top', topPosition + 'px');
        }
    });

    // Handle field changes
    $(document).on('change', '.novacraft-typography-select, .novacraft-typography-number', function() {
        var $field = $(this);
        var fieldId = $field.data('field');
        var value = $field.val();
        var $control = $field.closest('.novacraft-typography-control');
        var settingId = $control.find('.novacraft-typography-button').attr('id');
        
        // Update the customizer setting
        if (wp.customize(settingId)) {
            wp.customize(settingId).set(value);
        }
    });

    // Initialize popups
    function initPopups() {
        $('.novacraft-typography-popup').each(function() {
            var $popup = $(this);
            var $button = $('[data-popup-id="' + $popup.attr('id') + '"]');
            var settingId = $button.attr('id');
            
            // Set initial values
            $popup.find('.novacraft-typography-select, .novacraft-typography-number').each(function() {
                var $field = $(this);
                var fieldId = $field.data('field');
                
                if (wp.customize(settingId)) {
                    wp.customize(settingId).bind(function(value) {
                        $field.val(value);
                    });
                }
            });
        });
    }

    // Initialize when customizer is ready
    wp.customize.bind('ready', function() {
        initPopups();
    });

    // Post Layout
    wp.customize('post_layout', function(setting) {
        setting.bind(function(value) {
            const $container = $('.posts-container');
            resetPostLayoutClasses($container);

            if (value === 'list') {
                $container.addClass('posts-list');
            } else if (value === 'grid') {
                const columns = wp.customize('grid_columns').get();
                $container.addClass('posts-grid grid-columns-' + columns);
            }
        });
    });

    // Grid Columns
    wp.customize('grid_columns', function(setting) {
        setting.bind(function(value) {
            if (wp.customize('post_layout').get() === 'grid') {
                const $container = $('.posts-container');
                resetPostLayoutClasses($container);
                $container.addClass('posts-grid grid-columns-' + value);
            }
        });
    });

    // Post Style
    wp.customize('post_style', function(value) {
        value.bind(function(to) {
            const styles = {
                'unboxed': {
                    'background-color': 'transparent',
                    'box-shadow': 'none',
                    'padding': '0',
                    'border-radius': '0'
                },
                'minimal': {
                    'background-color': 'transparent',
                    'box-shadow': 'none',
                    'padding': '0',
                    'border-radius': '0',
                    'border-bottom': '1px solid var(--wp--preset--color--light)'
                },
                'boxed': {
                    'background-color': 'var(--post-bg-color)',
                    'box-shadow': 'var(--post-box-shadow)',
                    'padding': 'var(--post-padding)',
                    'border-radius': 'var(--post-border-radius)'
                }
            };

            // Apply the style
            $('.posts-container article').attr('data-style', to).css(styles[to] || styles.boxed);

            // If switching to boxed, always re-apply the current post_bg_color and border radius as inline style
            if (to === 'boxed') {
                var currentBgColor = wp.customize('post_bg_color').get();
                if (currentBgColor) {
                    $('article[data-style="boxed"]').css('background-color', currentBgColor);
                }
                var currentBorderRadius = wp.customize('post_border_radius').get();
                if (typeof currentBorderRadius !== 'undefined' && currentBorderRadius !== null) {
                    $('article[data-style="boxed"]').css('border-radius', currentBorderRadius + 'px');
                }
            }
        });
    });

    // Post Background Color
    wp.customize('post_bg_color', function(value) {
        value.bind(function(to) {
            // document.documentElement.style.setProperty('--post-bg-color', to);
            // $('article[data-style="boxed"]').css('background-color', to);
            $('.posts-container article').css('background-color', to);
            
        });
    });

    // Post Title Color
    wp.customize('post_title_color', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--post-title-color', to);
            $('.entry-title').css('color', to);
        });
    });

    // Post Meta Color
    wp.customize('post_meta_color', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--post-meta-color', to);
            $('.entry-meta').css('color', to);
        });
    });

    // Post Border Radius
    wp.customize('post_border_radius', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--post-border-radius', to + 'px');
            $('article[data-style="boxed"]').css('border-radius', to + 'px');
        });
    });

    // Post Padding
    wp.customize('post_padding_top', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--post-padding-top', padding);
            $('article').css('padding-top', padding);
        });
    });

    wp.customize('post_padding_right', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--post-padding-right', padding);
            $('article').css('padding-right', padding);
        });
    });

    wp.customize('post_padding_bottom', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--post-padding-bottom', padding);
            $('article').css('padding-bottom', padding);
        });
    });

    wp.customize('post_padding_left', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--post-padding-left', padding);
            $('article').css('padding-left', padding);
        });
    });

    // Handle linking/unlinking and input synchronization for post padding control
    wp.customize.bind('ready', function() {
        var control = wp.customize.control('post_padding');
        if (!control) return;
        var linkButton = control.container.find('.novacraft-multi-link, .novacraft-margin-link');
        var paddingInputs = control.container.find('.novacraft-multi-input input[type="number"], .novacraft-margin-input input[type="number"]');

        // Handle link button click
        linkButton.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var settingObj = wp.customize('post_padding_linked');
            if (!settingObj) return;
            var currentState = settingObj.get();
            var newState = currentState === 'linked' ? 'unlinked' : 'linked';
            if (newState === 'linked') {
                linkButton.addClass('linked');
                // When linking, sync all values to the first input's value
                var firstValue = paddingInputs.first().val();
                paddingInputs.not(':first').each(function() {
                    var input = $(this);
                    input.val(firstValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(firstValue);
                    }
                });
            } else {
                linkButton.removeClass('linked');
            }
            settingObj.set(newState);
        });

        // Synchronize inputs when linked
        paddingInputs.on('input', function () {
            var settingObj = wp.customize('post_padding_linked');
            if (!settingObj) return;
            if (settingObj.get() === 'linked') {
                var changedInput = $(this);
                var newValue = changedInput.val();
                paddingInputs.not(changedInput).each(function() {
                    var input = $(this);
                    input.val(newValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(newValue);
                    }
                });
            }
        });

        // Update linked state visually when setting changes
        var settingObj = wp.customize('post_padding_linked');
        if (settingObj) {
            settingObj.bind(function (newval) {
                if (newval === 'linked') {
                    linkButton.addClass('linked');
                } else {
                    linkButton.removeClass('linked');
                }
            });
        }

        // Update individual settings when input changes
        paddingInputs.on('change', function () {
            var settingId = $(this).data('setting-id');
            var newValue = $(this).val();
            if (wp.customize(settingId)) {
                wp.customize(settingId).set(newValue);
            }
        });
    });

    // Post Box Shadow
    wp.customize('post_box_shadow', function(value) {
        value.bind(function(to) {
            let shadow = '';
            switch(to) {
                case 'small':
                    shadow = '0 1px 3px rgba(0, 0, 0, 0.1)';
                    break;
                case 'medium':
                    shadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
                    break;
                case 'large':
                    shadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)';
                    break;
                default:
                    shadow = 'none';
            }
            // document.documentElement.style.setProperty('--post-box-shadow', shadow);
            // $('article[data-style="boxed"]').css('box-shadow', shadow);
            $('.posts-container article').css('box-shadow', shadow);
        });
    });

    // Sidebar Style
    wp.customize('sidebar_style', function(value) {
        value.bind(function(to) {
            $('.widget-area').attr('data-style', to);
            // Force style update
            if (to === 'unboxed') {
                $('.widget-area').css({
                    'background-color': 'transparent',
                    'box-shadow': 'none',
                    'border-radius': '0',
                    'padding': '0'
                });
            } else {
                $('.widget-area').css({
                    'background-color': 'var(--wp--preset--color--content-bg)',
                    'box-shadow': 'var(--sidebar-box-shadow)',
                    'border-radius': '8px',
                    'padding': 'var(--sidebar-padding-top) var(--sidebar-padding-right) var(--sidebar-padding-bottom) var(--sidebar-padding-left)'
                });
            }
            // wp.customize.previewer.refresh();
        });
    });

    // Sidebar Box Shadow
    wp.customize('sidebar_box_shadow', function(value) {
        value.bind(function(to) {
            let shadow = '';
            switch(to) {
                case 'small':
                    shadow = '0 1px 3px rgba(0, 0, 0, 0.1)';
                    break;
                case 'medium':
                    shadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
                    break;
                case 'large':
                    shadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)';
                    break;
                default:
                    shadow = 'none';
            }
            updateCSSProperty('--sidebar-box-shadow', shadow);
            $('.widget-area[data-style="boxed"]').css('box-shadow', shadow);
            // wp.customize.previewer.refresh();
        });
    });

    // Sidebar Border Radius
    wp.customize('sidebar_border_radius', function(value) {
        value.bind(function(to) {
            const radius = to + 'px';
            updateCSSProperty('--sidebar-border-radius', radius);
            $('.widget-area[data-style="boxed"]').css('border-radius', radius);
            // wp.customize.previewer.refresh();
        });
    });

    // Sidebar Background Color
    wp.customize('sidebar_bg_color', function(value) {
        value.bind(function(to) {
            $('.widget-area[data-style="boxed"]').css('background-color', to);
        });
    });

    // Container Outer Margin
    wp.customize('container_outer_margin', function(value) {
        value.bind(function(to) {
            updateCSSProperty('--container-outer-margin', to + 'px');
            $('.site-content').css('margin', to + 'px auto');
        });
    });

    // Container Outer Padding
    wp.customize('container_outer_padding', function(value) {
        value.bind(function(to) {
            updateCSSProperty('--container-outer-padding', to + 'px');
            $('.site-content').css('padding', to + 'px');
        });
    });

    // Sidebar Width
    wp.customize('sidebar_width', function(value) {
        value.bind(function(to) {
            const width = to + 'px';
            updateCSSProperty('--sidebar-width', width);
            $('.widget-area, .sidebar-container').css('width', width);
            // wp.customize.previewer.refresh();
        });
    });

    // Sidebar Padding
    wp.customize('sidebar_padding_top', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--sidebar-padding-top', padding);
            $('.widget-area').css('padding-top', padding);
            // wp.customize.previewer.refresh();
        });
    });

    wp.customize('sidebar_padding_right', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--sidebar-padding-right', padding);
            $('.widget-area').css('padding-right', padding);
            // wp.customize.previewer.refresh();
        });
    });

    wp.customize('sidebar_padding_bottom', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--sidebar-padding-bottom', padding);
            $('.widget-area').css('padding-bottom', padding);
            // wp.customize.previewer.refresh();
        });
    });

    wp.customize('sidebar_padding_left', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--sidebar-padding-left', padding);
            $('.widget-area').css('padding-left', padding);
            // wp.customize.previewer.refresh();
        });
    });

    // Handle linking/unlinking and input synchronization for sidebar padding control
    wp.customize.bind('ready', function() {
        var control = wp.customize.control('sidebar_padding');
        if (!control) return;
        var linkButton = control.container.find('.novacraft-multi-link, .novacraft-margin-link');
        var paddingInputs = control.container.find('.novacraft-multi-input input[type="number"], .novacraft-margin-input input[type="number"]');

        // Handle link button click
        linkButton.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var settingObj = wp.customize('sidebar_padding_linked');
            if (!settingObj) return;
            var currentState = settingObj.get();
            var newState = currentState === 'linked' ? 'unlinked' : 'linked';
            if (newState === 'linked') {
                linkButton.addClass('linked');
                // When linking, sync all values to the first input's value
                var firstValue = paddingInputs.first().val();
                paddingInputs.not(':first').each(function() {
                    var input = $(this);
                    input.val(firstValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(firstValue);
                    }
                });
            } else {
                linkButton.removeClass('linked');
            }
            settingObj.set(newState);
            // wp.customize.previewer.refresh();
        });

        // Synchronize inputs when linked
        paddingInputs.on('input', function () {
            var settingObj = wp.customize('sidebar_padding_linked');
            if (!settingObj) return;
            if (settingObj.get() === 'linked') {
                var changedInput = $(this);
                var newValue = changedInput.val();
                paddingInputs.not(changedInput).each(function() {
                    var input = $(this);
                    input.val(newValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(newValue);
                    }
                });
            }
        });

        // Update linked state visually when setting changes
        var settingObj = wp.customize('sidebar_padding_linked');
        if (settingObj) {
            settingObj.bind(function (newval) {
                if (newval === 'linked') {
                    linkButton.addClass('linked');
                } else {
                    linkButton.removeClass('linked');
                }
            });
        }

        // Update individual settings when input changes
        paddingInputs.on('change', function () {
            var settingId = $(this).data('setting-id');
            var newValue = $(this).val();
            if (wp.customize(settingId)) {
                wp.customize(settingId).set(newValue);
            }
            // wp.customize.previewer.refresh();
        });
    });

    // Main Content Inner Padding
    wp.customize('main_content_inner_padding_top', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--main-content-inner-padding-top', padding);
            $('.main-content').css('padding-top', padding);
            // wp.customize.previewer.refresh();
        });
    });

    wp.customize('main_content_inner_padding_right', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--main-content-inner-padding-right', padding);
            $('.main-content').css('padding-right', padding);
            // wp.customize.previewer.refresh();
        });
    });

    wp.customize('main_content_inner_padding_bottom', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--main-content-inner-padding-bottom', padding);
            $('.main-content').css('padding-bottom', padding);
            // wp.customize.previewer.refresh();
        });
    });

    wp.customize('main_content_inner_padding_left', function(value) {
        value.bind(function(to) {
            const padding = to + 'px';
            updateCSSProperty('--main-content-inner-padding-left', padding);
            $('.main-content').css('padding-left', padding);
            // wp.customize.previewer.refresh();
        });
    });

    // Handle linking/unlinking and input synchronization for main content inner padding control
    wp.customize.bind('ready', function() {
        var control = wp.customize.control('main_content_inner_padding');
        if (!control) return;
        var linkButton = control.container.find('.novacraft-multi-link, .novacraft-margin-link');
        var paddingInputs = control.container.find('.novacraft-multi-input input[type="number"], .novacraft-margin-input input[type="number"]');

        // Handle link button click
        linkButton.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var settingObj = wp.customize('main_content_inner_padding_linked');
            if (!settingObj) return;
            var currentState = settingObj.get();
            var newState = currentState === 'linked' ? 'unlinked' : 'linked';
            if (newState === 'linked') {
                linkButton.addClass('linked');
                // When linking, sync all values to the first input's value
                var firstValue = paddingInputs.first().val();
                paddingInputs.not(':first').each(function() {
                    var input = $(this);
                    input.val(firstValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(firstValue);
                    }
                });
            } else {
                linkButton.removeClass('linked');
            }
            settingObj.set(newState);
        });

        // Synchronize inputs when linked
        paddingInputs.on('input', function () {
            var settingObj = wp.customize('main_content_inner_padding_linked');
            if (!settingObj) return;
            if (settingObj.get() === 'linked') {
                var changedInput = $(this);
                var newValue = changedInput.val();
                paddingInputs.not(changedInput).each(function() {
                    var input = $(this);
                    input.val(newValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(newValue);
                    }
                });
            }
        });

        // Update linked state visually when setting changes
        var settingObj = wp.customize('main_content_inner_padding_linked');
        if (settingObj) {
            settingObj.bind(function (newval) {
                if (newval === 'linked') {
                    linkButton.addClass('linked');
                } else {
                    linkButton.removeClass('linked');
                }
            });
        }

        // Update individual settings when input changes
        paddingInputs.on('change', function () {
            var settingId = $(this).data('setting-id');
            var newValue = $(this).val();
            if (wp.customize(settingId)) {
                wp.customize(settingId).set(newValue);
            }
            // Force a refresh of the preview
            // wp.customize.previewer.refresh();
        });
    });

    // Range Number Control
    function initRangeNumberControls() {
        $('.range-number-control').each(function() {
            var $control = $(this);
            var $range = $control.find('input[type="range"]');
            var $number = $control.find('input[type="number"]');
            var isTyping = false;

            // Sync range to number
            $range.on('input', function() {
                if (!isTyping) {
                    $number.val($(this).val());
                }
            });

            // Handle number input focus
            $number.on('focus', function() {
                isTyping = true;
            });

            // Handle number input blur
            $number.on('blur', function() {
                isTyping = false;
                var val = $(this).val();
                var min = parseInt($(this).attr('min'));
                var max = parseInt($(this).attr('max'));

                // Ensure value is within bounds
                val = Math.max(min, Math.min(max, val));
                $(this).val(val);
                $range.val(val).trigger('change');
            });

            // Handle number input change
            $number.on('change', function() {
                var val = $(this).val();
                var min = parseInt($(this).attr('min'));
                var max = parseInt($(this).attr('max'));

                // Ensure value is within bounds
                val = Math.max(min, Math.min(max, val));
                $(this).val(val);
                $range.val(val).trigger('change');
            });

            // Handle number input keypress (Enter key)
            $number.on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    e.preventDefault();
                    $(this).blur();
                }
            });
        });
    }

    // Initialize when customizer is ready
    wp.customize.bind('ready', function() {
        initRangeNumberControls();
    });

    // Posts per page preview
    wp.customize('posts_per_page', function(setting) {
        setting.bind(function(value) {
            // Get the current preview URL
            var previewUrl = wp.customize.previewer.previewUrl();
            
            // Create URL object from the preview URL
            var url = new URL(previewUrl);
            
            // Add or update the posts_per_page parameter
            url.searchParams.set('posts_per_page', value);
            
            // Ensure we're on a valid page
            if (!url.pathname || url.pathname === '/') {
                url.pathname = '/';
            }
            
            // Reload the preview with the new posts per page value
            wp.customize.previewer.previewUrl(url.toString());
        });
    });

    // Utility: Remove all layout/grid classes
    function resetPostLayoutClasses($el) {
        $el.removeClass('posts-list posts-grid grid-columns-2 grid-columns-3 grid-columns-4');
    }

    // Inject customizer preview grid fix CSS
    (function() {
        if (window.parent && window.parent !== window && document.location.search.indexOf('customize_changeset_uuid') !== -1) {
            var style = document.createElement('style');
            style.innerHTML = `
                .site-content,
                .site-main,
                .main-content,
                .posts-container.posts-grid,
                .posts-container[class*="grid-columns-"] {
                    width: 100% !important;
                    max-width: 100% !important;
                    box-sizing: border-box !important;
                }
                .site-content,
                .site-main{
                    display: flex;
                    justify-content: center;
                }

                /* Customizer Preview Centering Fixes */
                .content-sidebar-wrapper {
                    width: 100% !important;
                    max-width: var(--container-width) !important;
                    margin-top: var(--container-margin-top) !important;
                    margin-bottom: var(--container-margin-bottom) !important;
                    margin-right: var(--container-margin-right) !important;
                    margin-left: var(--container-margin-left) !important;
                    display: flex !important;
                    justify-content: center !important;
                    align-items: flex-start !important;
                }

                // .content-sidebar-inner {
                //     width: 100% !important;
                //     max-width: 100% !important;
                //     margin: 0 auto !important;
                //     display: grid !important;
                //     gap: 2rem !important;
                // }

                // body.sidebar-both .content-sidebar-inner {
                //     justify-content: center !important;
                //     align-items: start !important;
                // }

                // body.sidebar-both .sidebar-left-container {
                //     justify-self: start !important;
                // }

                // body.sidebar-both .sidebar-right-container {
                //     justify-self: end !important;
                // }

                // body.sidebar-both .main-content {
                //     justify-self: center !important;
                // }
            `;
            document.head.appendChild(style);
        }
    })();

    // Container Multi-Property Controls (Margin, Padding, Border Radius, etc.)
    wp.customize('container_margin_top', function(value) {
        value.bind(function(to) {
            updateCSSProperty('--container-margin-top', to + 'px');
            $('.content-sidebar-wrapper').css('margin-top', to + 'px');
        });
    });

    wp.customize('container_margin_right', function(value) {
        value.bind(function(to) {
            updateCSSProperty('--container-margin-right', to + 'px');
            $('.content-sidebar-wrapper').css('margin-right', to + 'px');
        });
    });

    wp.customize('container_margin_bottom', function(value) {
        value.bind(function(to) {
            updateCSSProperty('--container-margin-bottom', to + 'px');
            $('.content-sidebar-wrapper').css('margin-bottom', to + 'px');
        });
    });

    wp.customize('container_margin_left', function(value) {
        value.bind(function(to) {
            updateCSSProperty('--container-margin-left', to + 'px');
            $('.content-sidebar-wrapper').css('margin-left', to + 'px');
        });
    });

    // Handle linking/unlinking and input synchronization for container margin control
    wp.customize.bind('ready', function() {
        var control = wp.customize.control('container_margin');
        if (!control) return;
        var linkButton = control.container.find('.novacraft-multi-link');
        var multiInputs = control.container.find('.novacraft-multi-input input[type="number"]');

        // Handle link button click
        linkButton.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var settingObj = wp.customize('container_margin_linked');
            if (!settingObj) return;
            var currentState = settingObj.get();
            var newState = currentState === 'linked' ? 'unlinked' : 'linked';
            if (newState === 'linked') {
                linkButton.addClass('linked');
                // When linking, sync all values to the first input's value
                var firstValue = multiInputs.first().val();
                multiInputs.not(':first').each(function() {
                    var input = $(this);
                    input.val(firstValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(firstValue);
                    }
                });
            } else {
                linkButton.removeClass('linked');
            }
            settingObj.set(newState);
            // wp.customize.previewer.refresh();
        });

        // Synchronize inputs when linked
        multiInputs.on('input', function () {
            var settingObj = wp.customize('container_margin_linked');
            if (!settingObj) return;
            if (settingObj.get() === 'linked') {
                var changedInput = $(this);
                var newValue = changedInput.val();
                multiInputs.not(changedInput).each(function() {
                    var input = $(this);
                    input.val(newValue);
                    var settingId = input.data('setting-id');
                    if (wp.customize(settingId)) {
                        wp.customize(settingId).set(newValue);
                    }
                });
            }
        });

        // Update linked state visually when setting changes
        var settingObj = wp.customize('container_margin_linked');
        if (settingObj) {
            settingObj.bind(function (newval) {
                if (newval === 'linked') {
                    linkButton.addClass('linked');
                } else {
                    linkButton.removeClass('linked');
                }
            });
        }

        // Update individual settings when input changes
        multiInputs.on('change', function () {
            var settingId = $(this).data('setting-id');
            var newValue = $(this).val();
            if (wp.customize(settingId)) {
                wp.customize(settingId).set(newValue);
            }
            // Force a refresh of the preview
            // wp.customize.previewer.refresh();
        });
    });


    // Main Content Border Radius (robust live preview for frontend and block editor)
    wp.customize('main_content_border_radius', function(value) {
        value.bind(function(to) {
            const radius = to + 'px';
            updateCSSProperty('--main-content-border-radius', radius);
            $('.main-content').css('border-radius', radius);
            // Also update in block editor iframe if present
            var editorIframe = document.querySelector('iframe[name="editor-canvas"], .block-editor-iframe, iframe.editor-iframe');
            if (editorIframe && editorIframe.contentDocument) {
                editorIframe.contentDocument.documentElement.style.setProperty('--main-content-border-radius', radius);
                var mainContent = editorIframe.contentDocument.querySelectorAll('.main-content');
                mainContent.forEach(function(el) {
                    el.style.borderRadius = radius;
                });
            }
            // wp.customize.previewer.refresh();
        });
    });

    wp.customize('primary_button_text_color', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--primary-btn-text', to);
            $('.primary-button').css('color', to);
        });
    });


    // Handle preview messages
    // wp.customize.previewer.bind('main-content-border-radius', function(radius) {
    //     document.documentElement.style.setProperty('--main-content-border-radius', radius);
    //     $('.main-content').css('border-radius', radius);
    // });

})(jQuery);

