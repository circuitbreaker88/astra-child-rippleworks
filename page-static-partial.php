<?php
/*
Template Name: Static HTML Partial (by slug)
Description: Outputs an HTML file from /partials/{page-slug}.html inside Astra header/footer.
*/
get_header();

$slug = sanitize_file_name( get_post_field( 'post_name', get_post() ) );

$partials_dir = realpath( get_stylesheet_directory() . '/partials' );
$partial_path = realpath( $partials_dir . '/' . $slug . '.html' );

echo '<main id="primary" class="site-main">';
if ( $partial_path && strpos( $partial_path, $partials_dir ) === 0 && file_exists( $partial_path ) ) {
    $content = file_get_contents( $partial_path );
    $allowed_html = wp_kses_allowed_html( 'post' );
    foreach ( $allowed_html as $tag => $attrs ) {
        $allowed_html[ $tag ]['style'] = true;
    }
    $allowed_html['style'] = array();
    $allowed_html['form'] = array(
        'class' => true,
        'onsubmit' => true,
        'style' => true,
    );
    $allowed_html['input'] = array(
        'type' => true,
        'class' => true,
        'placeholder' => true,
        'required' => true,
        'style' => true,
    );
    $allowed_html['textarea'] = array(
        'class' => true,
        'placeholder' => true,
        'style' => true,
    );
    $allowed_html['button'] = array(
        'type' => true,
        'class' => true,
        'style' => true,
    );
    $allowed_html['iframe'] = array(
        'title' => true,
        'loading' => true,
        'allowfullscreen' => true,
        'referrerpolicy' => true,
        'src' => true,
        'style' => true,
    );
    echo wp_kses( $content, $allowed_html );
} else {
    echo '<p style="padding:2rem">Partial not found: ' . esc_html( basename( $slug . '.html' ) ) . '</p>';
}
echo '</main>';

get_footer();
