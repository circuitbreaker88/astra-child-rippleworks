<?php
/**
 * Custom footer for Café page.
 * Omits the theme's default footer markup.
 *
 * @package Astra Child RippleWorks
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?>
        <?php astra_content_bottom(); ?>
    </div><!-- #content -->
    <?php astra_content_after(); ?>

    <?php astra_footer_before(); ?>
    <?php astra_footer_after(); ?>
</div><!-- #page -->

<?php astra_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>
