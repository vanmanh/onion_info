<?php
/**
 *
 * @package hbinstrap
 */

get_header();

$container   = hbinstrap_get_theme_options('container_type');
$sidebar_pos = hbinstrap_get_theme_options('sidebar_position');

?>

<?php if (is_front_page() && is_home()) : ?>
    <?php get_template_part('global-templates/hero'); ?>
<?php endif; ?>

<div class="wrapper" id="wrapper-index">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <main class="site-main" id="main">


            </main><!-- #main -->

        </div><!--row-->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
