<?php
/**
 * Static hero sidebar setup.
 *
 * @package hbinstrap
 */

$container   = hbinstrap_get_theme_options('container_type');

?>

<?php if (is_active_sidebar('our_partner')) : ?>

    <!-- ******************* The Hero Widget Area ******************* -->

    <div class="wrapper" id="wrapper-static-our-parner">

        <div class="<?php echo esc_attr($container); ?>" id="wrapper-static-content" tabindex="-1">

            <div class="row">

                <?php dynamic_sidebar('our_partner'); ?>

            </div>

        </div>

    </div><!-- #wrapper-static-hero -->

<?php endif; ?>
