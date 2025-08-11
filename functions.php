<?php
// Load parent + child styles.
add_action('wp_enqueue_scripts', function () {
    // Parent theme stylesheet
    wp_enqueue_style('astra-parent', get_template_directory_uri() . '/style.css');
    // Child theme stylesheet (use this for your custom CSS)
    wp_enqueue_style(
        'astra-child',
        get_stylesheet_uri(),
        ['astra-parent'],
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
});

/**
 * Force internal menu links to open in the same tab (no target="_blank").
 * Prevents the Cafe menu item (and other internal links) from opening in a new window.
 */
add_filter('nav_menu_link_attributes', function ($atts, $item = null, $args = null, $depth = null) {
    if (empty($atts['href'])) {
        return $atts;
    }

    $href        = $atts['href'];
    $site        = home_url('/');
    $is_relative = (strpos($href, '/') === 0);
    $is_internal = $is_relative || (strpos($href, $site) === 0);

    if ($is_internal && isset($atts['target'])) {
        unset($atts['target']);
    }

    return $atts;
}, 20, 4);
