<?php
/**
 * hbinstrap enqueue scripts
 *
 * @package hbinstrap
 */

if (! function_exists('hbinstrap_scripts')) {
    /**
     * Load theme's JavaScript sources.
     */
    function hbinstrap_scripts()
    {
        $the_theme = wp_get_theme();
        wp_enqueue_style('hbinstrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $the_theme->get('Version'), false);
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', null, false, false);
        wp_enqueue_script('jquery');

        wp_enqueue_script('popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), true);
        wp_enqueue_script('hbinstrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $the_theme->get('Version'), true);
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
} // endif function_exists( 'hbinstrap_scripts' ).

add_action('wp_enqueue_scripts', 'hbinstrap_scripts');

if (is_active_sidebar('owl')) {
    add_action('wp_enqueue_scripts', 'owl_enqueue_styles');

    function owl_enqueue_styles()
    {
        wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
        wp_enqueue_style('owl-carousel-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css');
        wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), 1.1, true);
    }
}
