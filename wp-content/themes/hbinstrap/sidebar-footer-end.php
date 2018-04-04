<?php
/**
 * Sidebar setup for footer full.
 *
 * @package hbinstrap
 */

$container   = hbinstrap_get_theme_options('container_type');

?>

<?php if (is_active_sidebar('footer-end')) : ?>

    <div class="wrapper footer-end" id="wrapper-footer-end">

        <div class="<?php echo esc_attr($container); ?>" id="footer-end-content" tabindex="-1">

            <?php dynamic_sidebar('footer-end'); ?>

        </div>

    </div><!-- #wrapper-footer-end -->
<?php else : ?>
    <div class="wrapper footer-end" id="wrapper-footer-end">
        <div class="<?php echo esc_attr($container); ?>" id="footer-end-content" tabindex="-1">
            <?php echo hbinstrap_get_theme_options('footer_text'); ?>
        </div>
    </div>
<?php endif; ?>
