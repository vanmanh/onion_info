<?php
/**
 * Check and setup theme's default settings
 *
 * @package hbinstrap
 *
 */

define('HBINSTRAP_HOME_CAT_DISPLAY_LARGE_ABOVE', 1);
define('HBINSTRAP_HOME_CAT_DISPLAY_LARGE_LEFT', 2);
define('HBINSTRAP_HOME_CAT_DISPLAY_LARGE_RIGHT', 3);
define('HBINSTRAP_HOME_CAT_DISPLAY_ALL_LARGE_2_COLS', 4);
define('HBINSTRAP_HOME_CAT_DISPLAY_ALL_LARGE_1_COL', 5);
define('HBINSTRAP_HOME_CAT_DISPLAY_ALL_SMALL', 6);
define('HBINSTRAP_HOME_CAT_DISPLAY_2_LARGE_ABOVE_2_COLS', 7);

define('HBINSTRAP_POST_OPTIONS', 'post_options');

define('HBINSTRAP_DEFAULT_NUMOF_DISPLAY_HOME_CAT', 5);

add_image_size('hbinstrap-small', 100, 100, true);

if (! function_exists('hbinstrap_get_the_post_thumbnail')) :
    function hbinstrap_get_the_post_thumbnail($post_ID, $type = 'medium', $attr = array('class' => 'img-fluid'))
    {
        $mappingType = array(
            'small' => array(100, 100),
            'medium' => 'medium',
            'large' => 'large',
        );
        if (!isset($mappingType)) {
            throw new Exception("hbinstrap_get_the_post_thumbnail: Not found this image Type" . $type, 1);
        }

        $size = isset($mappingType[$type]) ? $mappingType[$type] : $type;

        return get_the_post_thumbnail($post_ID, $size, $attr);
    }
endif;

if (! function_exists('hbinstrap_get_post_options')) :
    function hbinstrap_get_post_options($name = null)
    {
        $optsDefault = hbinstrap_get_default_theme_options(HBINSTRAP_POST_OPTIONS);
        $postOptions = hbinstrap_get_theme_options(HBINSTRAP_POST_OPTIONS);
        if (!empty($name)) {
            if (array_key_exists($name, $postOptions)) {
                return $postOptions[$name];
            } elseif (!array_key_exists($name, $optsDefault)) {
                throw new Exception("Can not get option: $name", 1);
            }

            return $optsDefault[$name]['default'];
        }

        return $postOptions;
    }
endif;

if (! function_exists('hbinstrap_get_theme_options')) :
    function hbinstrap_get_theme_options($name = null)
    {
        $defaultSettings = hbinstrap_get_default_theme_options();
        $currentSetting = get_theme_mod('hbinstrap');
        if (empty($currentSetting)) {
            $currentSetting = array();
        }
        $themeModified = array_merge($defaultSettings, $currentSetting);

        if (empty($name)) {
            return $themeModified;
        }

        if (isset($themeModified[$name])) {
            return $themeModified[$name];
        }
    }
endif;

if (! function_exists('custom_excerpt_length')) :
    function custom_excerpt_length($length)
    {
        return 20;
    }
    add_filter('excerpt_length', 'custom_excerpt_length', 999);
endif;
