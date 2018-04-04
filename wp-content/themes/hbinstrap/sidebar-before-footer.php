<?php
/**
 * Sidebar setup for footer full.
 *
 * @package hbinstrap
 */

$container   = hbinstrap_get_theme_options('container_type');

?>

<?php if (is_active_sidebar('before-footer')) : ?>

    <!-- ******************* The Footer Full-width Widget Area ******************* -->

    <div class="wrapper" id="wrapper-before-footer">

        <div class="<?php echo esc_attr($container); ?>" id="before-footer-content" tabindex="-1">

                <?php dynamic_sidebar('before-footer'); ?>

        </div>

    </div><!-- #wrapper-footer-full -->

<?php endif; ?>
