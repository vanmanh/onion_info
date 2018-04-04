<?php
/**
 * Sidebar setup for footer full.
 *
 * @package hbinstrap
 */

$container   = hbinstrap_get_theme_options('container_type');

?>

<?php if (is_active_sidebar('footerfull')) : ?>

    <!-- ******************* The Footer Full-width Widget Area ******************* -->

    <div class="wrapper d-none d-md-block" id="wrapper-footer-full">

        <div class="<?php echo esc_attr($container); ?>" id="footer-full-content" tabindex="-1">

            <div class="row">

                <?php dynamic_sidebar('footerfull'); ?>

            </div>

        </div>

    </div><!-- #wrapper-footer-full -->

<?php endif; ?>
