<?php
/**
 * Hero setup.
 *
 * @package hbinstrap
 */

?>

<?php if (is_active_sidebar('hero')
    || is_active_sidebar('statichero')
    || is_active_sidebar('after-header')
    || is_active_sidebar('owl')) :
?>

    <div class="wrapper" id="wrapper-hero">

        <?php get_sidebar('hero'); ?>

        <?php get_sidebar('statichero_before_owl_slider'); ?>

        <?php get_sidebar('owl'); ?>

        <?php get_sidebar('statichero'); ?>

        <?php get_sidebar('after-header'); ?>

    </div>

<?php endif; ?>
