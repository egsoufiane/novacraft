/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function($) {
    'use strict';
    
    // Wait for DOM to be fully loaded
    $(document).ready(function() {
        console.log('Navigation.js loaded');
        
        const siteNavigation = $('#site-navigation');
        const menuToggle = $('.menu-toggle');
        let isMenuOpen = false;

        // Debug: Log initial state
        console.log('Initial state:', {
            siteNavigation: siteNavigation.length ? 'Found' : 'Not found',
            menuToggle: menuToggle.length ? 'Found' : 'Not found',
            navigationHTML: siteNavigation.html(),
            toggleHTML: menuToggle.html()
        });

        // Return early if the navigation doesn't exist.
        if (!siteNavigation.length || !menuToggle.length) {
            console.log('Navigation elements not found');
            return;
        }

        const menu = siteNavigation.find('ul').first();

        // Debug: Log menu state
        console.log('Menu state:', {
            menuFound: menu.length ? 'Yes' : 'No',
            menuHTML: menu.html(),
            menuClasses: menu.attr('class')
        });

        // Hide menu toggle button if menu is empty and return early.
        if (!menu.length) {
            console.log('Menu is empty');
            menuToggle.hide();
            return;
        }

        // Ensure menu has the nav-menu class
        if (!menu.hasClass('nav-menu')) {
            menu.addClass('nav-menu');
            console.log('Added nav-menu class to menu');
        }

        // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
        menuToggle.on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Menu toggle clicked', {
                beforeToggle: {
                    navigationClasses: siteNavigation.attr('class'),
                    toggleClasses: menuToggle.attr('class'),
                    bodyClasses: $('body').attr('class'),
                    isMenuOpen: isMenuOpen
                }
            });
            
            // Toggle classes
            siteNavigation.toggleClass('toggled');
            menuToggle.toggleClass('toggled');
            $('body').toggleClass('menu-open');
            isMenuOpen = !isMenuOpen;

            // Toggle aria-expanded
            const expanded = menuToggle.attr('aria-expanded') === 'true';
            menuToggle.attr('aria-expanded', !expanded);

            // Ensure menu is visible when toggled
            if (isMenuOpen) {
                siteNavigation.css({
                    'transform': 'translateX(0)',
                    'opacity': '1',
                    'visibility': 'visible'
                });
            } else {
                siteNavigation.css({
                    'transform': 'translateX(-100%)',
                    'opacity': '0',
                    'visibility': 'hidden'
                });
            }

            console.log('After toggle:', {
                navigationClasses: siteNavigation.attr('class'),
                toggleClasses: menuToggle.attr('class'),
                bodyClasses: $('body').attr('class'),
                isMenuOpen: isMenuOpen,
                ariaExpanded: menuToggle.attr('aria-expanded')
            });
        });

        // Close menu when clicking outside
        $(document).on('click', function(event) {
            if (!isMenuOpen) return;
            
            const isClickInside = siteNavigation.has(event.target).length > 0;
            const isClickOnToggle = menuToggle.has(event.target).length > 0;

            console.log('Document click:', {
                isClickInside,
                isClickOnToggle,
                target: event.target
            });

            if (!isClickInside && !isClickOnToggle) {
                console.log('Closing menu from outside click');
                siteNavigation.removeClass('toggled');
                menuToggle.removeClass('toggled');
                menuToggle.attr('aria-expanded', 'false');
                $('body').removeClass('menu-open');
                isMenuOpen = false;
                
                // Ensure menu is hidden
                siteNavigation.css({
                    'transform': 'translateX(-100%)',
                    'opacity': '0',
                    'visibility': 'hidden'
                });
            }
        });

        // Close menu when pressing escape key
        $(document).on('keydown', function(event) {
            if (event.key === 'Escape' && isMenuOpen) {
                console.log('Closing menu from escape key');
                siteNavigation.removeClass('toggled');
                menuToggle.removeClass('toggled');
                menuToggle.attr('aria-expanded', 'false');
                $('body').removeClass('menu-open');
                isMenuOpen = false;
                
                // Ensure menu is hidden
                siteNavigation.css({
                    'transform': 'translateX(-100%)',
                    'opacity': '0',
                    'visibility': 'hidden'
                });
            }
        });

        // Get all the link elements within the menu.
        const links = menu.find('a');

        // Get all the link elements with children within the menu.
        const linksWithChildren = menu.find('.menu-item-has-children > a, .page_item_has_children > a');

        // Toggle focus each time a menu link is focused or blurred.
        links.on('focus blur', function() {
            let self = $(this);
            // Move up through the ancestors of the current link until we hit .nav-menu.
            while (!self.hasClass('nav-menu')) {
                // On li elements toggle the class .focus.
                if (self.is('li')) {
                    self.toggleClass('focus');
                }
                self = self.parent();
            }
        });

        // Toggle focus each time a menu link with children receive a touch event.
        linksWithChildren.on('touchstart', function(event) {
            const menuItem = $(this).parent();
            event.preventDefault();
            menuItem.siblings().removeClass('focus');
            menuItem.toggleClass('focus');
        });
    });
})(jQuery); 