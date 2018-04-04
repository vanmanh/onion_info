<?php
/**
 * Sidebar after-header
 *
 * @package hbinstrap
 */

$container   = hbinstrap_get_theme_options('container_type');

?>

<?php if (is_active_sidebar('after-header')) : ?>

    <!-- ******************* The Hero Widget Area ******************* -->

    <div class="wrapper" id="wrapper-after-header">

        <div class="<?php echo esc_attr($container); ?>" id="wrapper-static-content" tabindex="-1">

            <div class="row">

                <?php dynamic_sidebar('after-header'); ?>

            </div>

        </div>

    </div><!-- #wrapper-static-hero -->

<?php endif; ?>
