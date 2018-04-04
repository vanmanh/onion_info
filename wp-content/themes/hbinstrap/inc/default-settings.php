<?php
/**
 *
 * @package hbinstrap
 */



if (!function_exists('hbinstrap_custom_breadcrumbs')) :

    function hbinstrap_get_default_theme_options($key = null)
    {
        global $hbinstrap_child_theme_default_option;
        $default_theme_options = array(
            'logo' => get_template_directory_uri() . '/images/headers/logo.png',
            'logo_alt_text' => '',
            'sidebar_position' => 'right',
            'container_type' => 'container',
            'breadcumb_is_display' => 1,
            'breadcumb_onhomepage' => 0,
            'breadcumb_seperator' => '&raquo;',
            'move_title_tagline' => 0,
            'language_list' => array(
                array(
                    'short' => 'en',
                    'iso_code' => 'en_US',
                    'text' => 'English',
                    'flag' => 'en.png', // images/flags
                    'url' => '/',
                ),
                array(
                    'short' => 'vi',
                    'iso_code' => 'vi',
                    'text' => 'Vietnamese',
                    'flag' => 'vi.png',
                    'url' => '/vi',
                )
            ),
            'hbinstrap_social_icons_list' => array(
                'facebook_link' => 'https://www.facebook.com/VietnamHospitalityNetwork',
            ),
            'post_options' => array(
                'is_display_related_post' => array(
                    'default' => true,
                    'type' => 'checkbox',
                    'label' => 'Display related post on single page',
                    'description' => '',
                ),
                'numof_related_post' => array(
                    'default' => 5,
                    'type' => 'choices',
                    'min' => 1,
                    'max' => 20,
                    'label' => 'Numof display related post',
                    'description' => '',
                ),
                'is_display_thumb_related_post' => array(
                    'default' => false,
                    'type' => 'checkbox',
                    'label' => 'Is display thumb in related post',
                    'description' => '',
                ),
                'is_display_facebook_comment' => array(
                    'default' => false,
                    'type' => 'checkbox',
                    'label' => 'Is display facebook comment in single post page',
                    'description' => '',
                ),
                'is_display_wordpress_comment' => array(
                    'default' => true,
                    'type' => 'checkbox',
                    'label' => 'Use wordpress default comment box',
                    'description' => '',
                ),
                'is_display_social_share_button' => array(
                    'default' => true,
                    'type' => 'checkbox',
                    'label' => 'Display social share button in post page',
                    'description' => '',
                ),
            ),
            'footer_text' => '
                <p style="text-align: center;">Copy right by hbinstrap<br>
                    Address: 120 Suong Nguyet Anh, District 1, Ho Chi Minh city, VietNam<br>
                    Copyright © 2014 – Developed by&nbsp;<a href="http://github.com/abinhho/hbinstrap">HBINSTRAP</a>.</p>
            '
        );

        $defaultOptions = array_merge($default_theme_options, $hbinstrap_child_theme_default_option);

        if (!empty($key)) {
            return isset($defaultOptions[$key]) ? $defaultOptions[$key] : '';
        }

        return apply_filters('hbinstrap_get_default_theme_options', $defaultOptions);
    }
endif;
