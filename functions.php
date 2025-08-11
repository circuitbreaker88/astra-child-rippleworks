<?php
// Load parent + child styles.
add_action('wp_enqueue_scripts', function () {
    // Parent theme stylesheet
    wp_enqueue_style('astra-parent', get_template_directory_uri() . '/style.css');
    // Child theme stylesheet (use this for your custom CSS)
    wp_enqueue_style('astra-child', get_stylesheet_uri(), ['astra-parent'], wp_get_theme()->get('Version'));
});
