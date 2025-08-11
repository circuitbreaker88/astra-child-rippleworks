<?php
/* 
Template Name: Static HTML Partial (by slug)
Description: Outputs an HTML file from /partials/{page-slug}.html inside Astra header/footer.
*/
get_header();

$slug    = get_post_field('post_name', get_post());
$partial = get_stylesheet_directory() . '/partials/' . sanitize_title($slug) . '.html';

echo '<main id="primary" class="site-main">';
if ( file_exists( $partial ) ) {
    // Print the HTML partial (no <html>/<head>/<body> tags inside it).
    echo file_get_contents( $partial );
} else {
    echo '<p style="padding:2rem">Partial not found: ' . esc_html( basename($partial) ) . '</p>';
}
echo '</main>';

get_footer();
