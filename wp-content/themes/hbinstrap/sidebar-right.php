<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package hbinstrap
 */

if (! is_active_sidebar('right-sidebar')) {
    return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = hbinstrap_get_theme_options('sidebar_position');
?>

<?php if ('both' === $sidebar_pos) : ?>
<div class="col-md-3 widget-area right-sidebar" id="right-sidebar" role="complementary">
    <?php else : ?>
<div class="col-md-4 widget-area right-sidebar" id="right-sidebar" role="complementary">
    <?php endif; ?>
<?php dynamic_sidebar('right-sidebar'); ?>

</div><!-- #secondary -->
