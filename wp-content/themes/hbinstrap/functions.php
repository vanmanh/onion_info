<?php
/**
 * hbinstrap functions and definitions
 *
 * @package hbinstrap
 */

// Global variables
$hbinstrap_facebook_js_sdk = '';
if (!isset($hbinstrap_child_theme_default_option)) {
    $hbinstrap_child_theme_default_option = [];
}

require get_template_directory() . '/inc/default-settings.php';

/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 */
require get_template_directory() . '/inc/widgets.php';
/**
 * Register shortcode area.
 */
require get_template_directory() . '/inc/hbinstrap-shortcode.php';
require get_template_directory() . '/inc/hbinstrap-breadcrumb.php';
require get_template_directory() . '/inc/hbinstrap-social-networks.php';

require get_template_directory() . '/inc/widgets/hbinstrap-social-icons.php';
require get_template_directory() . '/inc/widgets/hbinstrap-newest-slider-small.php';
require get_template_directory() . '/inc/widgets/hbinstrap-featured-post-large-home.php';
require get_template_directory() . '/inc/widgets/hbinstrap-track-post-views.php';
require get_template_directory() . '/inc/widgets/hbinstrap-html-by-page-private.php';
require get_template_directory() . '/inc/widgets/hbinstrap-api-html-by-page-private.php';
require get_template_directory() . '/inc/widgets/hbinstrap-each-page-public.php';
require get_template_directory() . '/inc/widgets/hbinstrap-smart-col-list.php';
require get_template_directory() . '/inc/widgets/hbinstrap-api-latest-posts.php';

/**
 * Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Comments file.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load Editor functions.
 */
require get_template_directory() . '/inc/editor.php';
