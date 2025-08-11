<?php
// Load parent + child styles.
add_action('wp_enqueue_scripts', function () {
    // Parent theme stylesheet
    wp_enqueue_style('astra-parent', get_template_directory_uri() . '/style.css');
    // Child theme stylesheet (use this for your custom CSS)
    wp_enqueue_style('astra-child', get_stylesheet_uri(), ['astra-parent'], wp_get_theme()->get('Version'));
});

/**
 * Force internal menu links to open in the same tab (no target="_blank").
 * This prevents the Cafe menu item from opening in a new window.
 */
add_filter('nav_menu_link_attributes', function ($atts) {
    if (empty($atts['href'])) return $atts;
    $href = $atts['href'];
    $site = home_url('/');
    $is_relative = str_starts_with($href, '/');
    $is_internal = $is_relative || str_starts_with($href, $site);
    if ($is_internal && isset($atts['target'])) {
        unset($atts['target']);
    }
    return $atts;
}, 10, 1);
