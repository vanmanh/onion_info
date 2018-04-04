<?php

/**
 * hbinstrap enqueue scripts
 *
 * @package hbinstrap
 */

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function my_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_stylesheet_directory_uri() . '/css/style.css');
}
