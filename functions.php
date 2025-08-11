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
add_filter('nav_menu_link_attributes', function ($atts, $item = null, $args = null, $depth = null) {
    if (empty($atts['href'])) {
        return $atts;
    }

    $href       = $atts['href'];
    $site       = home_url('/');
    $is_relative = strpos($href, '/') === 0;
    $is_internal = $is_relative || strpos($href, $site) === 0;

    if ($is_internal && isset($atts['target'])) {
        unset($atts['target']);
    }

    return $atts;
}, 20, 4);

/**
 * Replace the default logo with the RippleWorks brand on static partial pages
 * like /cafe.
 */
add_filter('get_custom_logo', function ($html, $blog_id = 0) {
    if (!is_page_template('page-static-partial.php')) {
        return $html;
    }

    $home = esc_url(home_url('/'));

    $svg = '<svg class="ripple" viewBox="0 0 40 40" aria-hidden="true"><defs><radialGradient id="rg" cx="50%" cy="50%"><stop offset="0%" stop-color="#00B8A9" /><stop offset="100%" stop-color="#BFF0E5" /></radialGradient></defs><circle class="r1" cx="20" cy="20" r="2"></circle><circle class="r2" cx="20" cy="20" r="2"></circle><circle class="r3" cx="20" cy="20" r="2"></circle></svg>';

    $brand = '<span class="brand">' . $svg . 'RippleWorks</span>';

    return '<a href="' . $home . '" class="custom-logo-link" rel="home">' . $brand . '</a>';
}, 10, 2);
