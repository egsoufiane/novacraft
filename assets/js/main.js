jQuery(document).ready(function($) {
    'use strict';

    // Function to update content margin based on header height
    function updateContentMargin() {
        const header = $('.site-header');
        const headerHeight = header.outerHeight(true); // Include margins
        const adminBarHeight = $('body').hasClass('admin-bar') ? ($(window).width() <= 782 ? 46 : 32) : 0;
        const contentMargin = headerHeight + adminBarHeight;
        
        $('.site-content').css('margin-top', contentMargin + 'px');
    }

    // Update immediately
    updateContentMargin();

    // Update after a short delay to ensure all content is loaded
    setTimeout(updateContentMargin, 100);

    // Update on window resize with debounce
    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(updateContentMargin, 250);
    });

    // Update when customizer changes logo size
    if (typeof wp !== 'undefined' && wp.customize) {
        wp.customize('logo_width', function(value) {
            value.bind(function() {
                setTimeout(updateContentMargin, 100);
            });
        });
    }

    // Search functionality
    const searchWrapper = $('.header-search-wrapper');
    const searchToggle = $('#search-toggle');
    const searchForm = $('#search-form');
    const searchField = searchForm.find('.search-field');

    if (!searchWrapper.length || !searchToggle.length || !searchForm.length) return;

    // Toggle search form
    searchToggle.on('click', function(e) {
        e.preventDefault();
        const isActive = searchWrapper.toggleClass('active').hasClass('active');
        
        // Update aria-expanded attribute for accessibility
        searchToggle.attr('aria-expanded', isActive ? 'true' : 'false');
        searchToggle.attr('aria-label', isActive ? 'Close search' : 'Open search');

        if (isActive) {
            // Focus the search input when shown
            setTimeout(() => {
                searchField.focus();
            }, 100);
        }
    });

    // Handle search on enter key
    searchField.on('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchForm.submit();
        }
    });

    // Close search form when clicking outside
    $(document).on('click', function(event) {
        if (!searchWrapper.is(event.target) && 
            searchWrapper.has(event.target).length === 0 && 
            searchWrapper.hasClass('active')) {
            searchWrapper.removeClass('active');
            searchToggle.attr('aria-expanded', 'false');
            searchToggle.attr('aria-label', 'Open search');
        }
    });

    // Close search form on escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && searchWrapper.hasClass('active')) {
            searchWrapper.removeClass('active');
            searchToggle.attr('aria-expanded', 'false');
            searchToggle.attr('aria-label', 'Open search');
        }
    });
});
