<?php
/**
 * Template Name: Static Partial
 */
get_header();

$slug    = get_post_field( 'post_name', get_post() );
$partial = locate_template( 'partials/' . $slug . '.html' );
?>
<main id="primary" class="site-main">
  <?php
  if ( $partial ) {
    // Render only the partial for this page (no Gutenberg content/attachments)
    include $partial;
  } else {
    // Fallback for other pages using this template
    the_content();
  }
  ?>
</main>
<?php
// Use café footer if it exists, else default footer.
if ( 'cafe' === $slug && locate_template( 'footer-cafe.php' ) ) {
  get_footer( 'cafe' );
} else {
  get_footer();
}

