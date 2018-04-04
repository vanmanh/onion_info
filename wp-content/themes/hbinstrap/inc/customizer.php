<?php
/**
 * hbinstrap Theme Customizer
 *
 * @package hbinstrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (! function_exists('hbinstrap_customize_register')) {
    /**
     * Register basic customizer support.
     *
     * @param object $wp_customize Customizer reference.
     */
    function hbinstrap_customize_register($wp_customize)
    {
        $wp_customize->get_setting('blogname')->transport         = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
    }
}
add_action('customize_register', 'hbinstrap_customize_register');

if (! function_exists('hbinstrap_theme_customize_register')) {
    /**
     * Register individual settings through customizer's API.
     *
     * @param WP_Customize_Manager $wp_customize Customizer reference.
     */
    function hbinstrap_theme_customize_register($wp_customize)
    {
        //select sanitization function
        function hbinstrap_theme_slug_sanitize_select($input, $setting)
        {

            //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
            $input = sanitize_key($input);

            //get the list of possible select options
            $choices = $setting->manager->get_control($setting->id)->choices;

            //return input if valid or return default option
            return (array_key_exists($input, $choices) ? $input : $setting->default);
        }

        /*
         * -----------------------------------------------------------------
         * Theme frontpage options settings.
         * -----------------------------------------------------------------
         */

        // Make category option
        $categories = get_categories();
        $catList = array(
            0 => 'No display',
        );

        foreach ($categories as $category) {
            $catList[$category->cat_ID] = $category->name;
        }
        $wp_customize->add_section('hbinstrap_theme_homepage_options', array(
            'title'       => __('Frontpage options', 'hbinstrap'),
            'capability'  => 'edit_theme_options',
            'description' => __('Select category to display for each of position on home page', 'hbinstrap'),
            'priority'    => 180,
        ));

        for ($i = 0; $i <= count($catList); $i++) {
            $uniqueName = "hbinstrap[homepage_cats_options][$i][catid]";
            $wp_customize->add_setting($uniqueName, array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options',
            ));

            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    $uniqueName,
                    array(
                        'label'       => __('Category for postion: '.$i, 'hbinstrap'),
                        'description' => '',
                        'section'     => 'hbinstrap_theme_homepage_options',
                        'settings'    => $uniqueName,
                        'type'        => 'select',
                        'choices'     => $catList,
                        'priority'    => $i,
                    )
                )
            );

            $uniqueName = "hbinstrap[homepage_cats_options][$i][display_style]";
            $wp_customize->add_setting($uniqueName, array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options',
            ));

            $displayStyleList = array(
                HBINSTRAP_HOME_CAT_DISPLAY_LARGE_ABOVE => '1 large above and small bottom',
                HBINSTRAP_HOME_CAT_DISPLAY_LARGE_LEFT => '1 large left and small right',
                HBINSTRAP_HOME_CAT_DISPLAY_LARGE_RIGHT => '1 large right and small left',
                HBINSTRAP_HOME_CAT_DISPLAY_2_LARGE_ABOVE_2_COLS => '2 large above small botton',
                HBINSTRAP_HOME_CAT_DISPLAY_ALL_LARGE_2_COLS => 'all items large 2 columns',
                HBINSTRAP_HOME_CAT_DISPLAY_ALL_LARGE_1_COL => 'all items large 1 column',
                HBINSTRAP_HOME_CAT_DISPLAY_ALL_SMALL => 'all items small 2 column',
            );

            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    $uniqueName,
                    array(
                        'label'       => __('Display style position '. $i, 'hbinstrap'),
                        'description' => '',
                        'section'     => 'hbinstrap_theme_homepage_options',
                        'settings'    => $uniqueName,
                        'type'        => 'select',
                        'choices'     => $displayStyleList,
                        'priority'    => $i,
                    )
                )
            );

            $uniqueName = "hbinstrap[homepage_cats_options][$i][numof_display]";
            $wp_customize->add_setting($uniqueName, array(
                'default'           => HBINSTRAP_DEFAULT_NUMOF_DISPLAY_HOME_CAT,
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options',
            ));

            $displayNumofList = array();
            for ($k = 1; $k <= 20; $k++) {
                $displayNumofList[$k] = $k . ' items';
            }

            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    $uniqueName,
                    array(
                        'label'       => __('Display style position '. $i, 'hbinstrap'),
                        'description' => '',
                        'section'     => 'hbinstrap_theme_homepage_options',
                        'settings'    => $uniqueName,
                        'type'        => 'select',
                        'choices'     => $displayNumofList,
                        'priority'    => $i,
                    )
                )
            );
        }

        /*
         * -----------------------------------------------------------------
         * Theme google analytics option
         * google_analytics
         * -----------------------------------------------------------------
         */

        $wp_customize->add_section('hbinstrap_google_analytics_options', array(
            'title'       => __('Google Analytics Options', 'hbinstrap'),
            'capability'  => 'edit_theme_options',
            'description' => __('Google Analytics options setting', 'hbinstrap'),
            'priority'    => 210,
        ));


        $uniqueName = "hbinstrap[google_analytics]";

        $wp_customize->add_setting($uniqueName, array(
            'default'           => hbinstrap_get_default_theme_options('google_analytics'),
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $uniqueName,
                array(
                    'label'       => __('Code Google Analytics', 'hbinstrap'),
                    'description' => '',
                    'section'     => 'hbinstrap_google_analytics_options',
                    'settings'    => $uniqueName,
                    'type'        => 'text',
                    'priority'    => 1,
                )
            )
        );

        /*
         * -----------------------------------------------------------------
         * Theme breadcrumb option
         * breadcumb_is_display
         * breadcumb_onhomepage
         * breadcumb_seperator
         * -----------------------------------------------------------------
         */

        $wp_customize->add_section('hbinstrap_breadcrumb_options', array(
            'title'       => __('Breadcrumb Options', 'hbinstrap'),
            'capability'  => 'edit_theme_options',
            'description' => __('Breadcrumb options setting', 'hbinstrap'),
            'priority'    => 210,
        ));


        $uniqueName = "hbinstrap[breadcumb_is_display]";

        $wp_customize->add_setting($uniqueName, array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $uniqueName,
                array(
                    'label'       => __('Display breadcrumb', 'hbinstrap'),
                    'description' => '',
                    'section'     => 'hbinstrap_breadcrumb_options',
                    'settings'    => $uniqueName,
                    'type'        => 'checkbox',
                    'priority'    => 1,
                )
            )
        );

        $uniqueName = "hbinstrap[breadcumb_onhomepage]";

        $wp_customize->add_setting($uniqueName, array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $uniqueName,
                array(
                    'label'       => __('Display breadcrumb home page', 'hbinstrap'),
                    'description' => '',
                    'section'     => 'hbinstrap_breadcrumb_options',
                    'settings'    => $uniqueName,
                    'type'        => 'checkbox',
                    'priority'    => 1,
                )
            )
        );

        $uniqueName = "hbinstrap[breadcumb_seperator]";

        $wp_customize->add_setting($uniqueName, array(
            'default'           => '&raquo;',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $uniqueName,
                array(
                    'label'       => __('Display breadcrumb', 'hbinstrap'),
                    'description' => '',
                    'section'     => 'hbinstrap_breadcrumb_options',
                    'settings'    => $uniqueName,
                    'type'        => 'text',
                    'priority'    => 1,
                )
            )
        );

        /*
         * -----------------------------------------------------------------
         * Theme social icons
         * -----------------------------------------------------------------
         */

        $wp_customize->add_section('hbinstrap_social_icons_options', array(
            'title'       => __('Social Icons', 'hbinstrap'),
            'capability'  => 'edit_theme_options',
            'description' => __('Social icons setting', 'hbinstrap'),
            'priority'    => 190,
        ));

        $wphbin_social_icons    =   hbinstrap_get_social_icons_list();
        $defaultVals = hbinstrap_get_default_theme_options('hbinstrap_social_icons_list');

        foreach ($wphbin_social_icons as $key => $value) {
            $uniqueName = "hbinstrap[hbinstrap_social_icons_list][$key]";

            $wp_customize->add_setting($uniqueName, array(
                'default'           => isset($defaultVals[$key]) ? $defaultVals[$key] : '',
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options',
            ));

            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    $uniqueName,
                    array(
                        'label'       => __('', 'hbinstrap'),
                        'description' => $value['label'],
                        'section'     => 'hbinstrap_social_icons_options',
                        'settings'    => $uniqueName,
                        'type'        => 'text',
                        'priority'    => $i,
                    )
                )
            );
        }

        /*
         * -----------------------------------------------------------------
         * Post options
         * hbinstrap_post_options
         * -----------------------------------------------------------------
         */

        $wp_customize->add_section('hbinstrap_post_options', array(
            'title'       => __('Posts option', 'hbinstrap'),
            'capability'  => 'edit_theme_options',
            'description' => __('Setting posts option', 'hbinstrap'),
            'priority'    => 200,
        ));

        $postOptions = hbinstrap_get_default_theme_options(HBINSTRAP_POST_OPTIONS);

        foreach ($postOptions as $key => $value) {
            $uniqueName = "hbinstrap[".HBINSTRAP_POST_OPTIONS."][$key]";

            $wp_customize->add_setting($uniqueName, array(
                'default'           => $value['default'],
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options',
            ));

            $choicesList = array();
            if (isset($value['type']) && $value['type'] == 'select') {
                for ($k = $value['min']; $k <= $value['max']; $k++) {
                    $choicesList[$k] = $k;
                }
            }

            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    $uniqueName,
                    array(
                        'label'       => __($value['label'], 'hbinstrap'),
                        'description' => __($value['description'], 'hbinstrap'),
                        'section'     => 'hbinstrap_post_options',
                        'settings'    => $uniqueName,
                        'type'        => isset($value['type']) ? $value['type'] : 'text',
                        'choices'        => $choicesList,
                        'priority'    => $i,
                    )
                )
            );
        }

        /*
         * -----------------------------------------------------------------
         * Theme layout settings.
         * -----------------------------------------------------------------
         */

        $wp_customize->add_section('hbinstrap_theme_layout_options', array(
            'title'       => __('Theme Layout Settings', 'hbinstrap'),
            'capability'  => 'edit_theme_options',
            'description' => __('Container width and sidebar defaults', 'hbinstrap'),
            'priority'    => 160,
        ));

        $uniqueName = "hbinstrap[container_type]";
        $wp_customize->add_setting($uniqueName, array(
            'default'           => 'container',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'hbinstrap_theme_slug_sanitize_select',
            'capability'        => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $uniqueName,
                array(
                    'label'       => __('Container Width', 'hbinstrap'),
                    'description' => __("Choose between Bootstrap's container and container-fluid", 'hbinstrap'),
                    'section'     => 'hbinstrap_theme_layout_options',
                    'settings'    => $uniqueName,
                    'type'        => 'select',
                    'choices'     => array(
                        'container'       => __('Fixed width container', 'hbinstrap'),
                        'container-fluid' => __('Full width container', 'hbinstrap'),
                    ),
                    'priority'    => '10',
                )
            )
        );

        $uniqueName = "hbinstrap[sidebar_position]";
        $wp_customize->add_setting($uniqueName, array(
            'default'           => 'right',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $uniqueName,
                array(
                    'label'       => __('Sidebar Positioning', 'hbinstrap'),
                    'description' => __(
                        "Set sidebar's default position.",
                    'hbinstrap'
                    ),
                    'section'     => 'hbinstrap_theme_layout_options',
                    'settings'    => $uniqueName ,
                    'type'        => 'select',
                    'sanitize_callback' => 'hbinstrap_theme_slug_sanitize_select',
                    'choices'     => array(
                        'right' => __('Right sidebar', 'hbinstrap'),
                        'left'  => __('Left sidebar', 'hbinstrap'),
                        'both'  => __('Left & Right sidebars', 'hbinstrap'),
                        'none'  => __('No sidebar', 'hbinstrap'),
                    ),
                    'priority'    => '20',
                )
            )
        );

        $uniqueName = "hbinstrap[posts_sidebar_position]";
        $wp_customize->add_setting($uniqueName, array(
            'default'           => 'right',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $uniqueName,
                array(
                    'label'       => __('Posts Sidebar Positioning', 'hbinstrap'),
                    'description' => __(
                        "Set sidebar's default position.",
                    'hbinstrap'
                    ),
                    'section'     => 'hbinstrap_theme_layout_options',
                    'settings'    => $uniqueName ,
                    'type'        => 'select',
                    'sanitize_callback' => 'hbinstrap_theme_slug_sanitize_select',
                    'choices'     => array(
                        'right' => __('Right sidebar', 'hbinstrap'),
                        'left'  => __('Left sidebar', 'hbinstrap'),
                        'both'  => __('Left & Right sidebars', 'hbinstrap'),
                        'none'  => __('No sidebar', 'hbinstrap'),
                    ),
                    'priority'    => '20',
                )
            )
        );

    }
} // endif function_exists( 'hbinstrap_theme_customize_register' ).
add_action('customize_register', 'hbinstrap_theme_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if (! function_exists('hbinstrap_customize_preview_js')) {
    /**
     * Setup JS integration for live previewing.
     */
    function hbinstrap_customize_preview_js()
    {
        wp_enqueue_script(
            'hbinstrap_customizer',
            get_template_directory_uri() . '/js/customizer.js',
            array( 'customize-preview' ),
            '20130508',
            true
        );
    }
}
add_action('customize_preview_init', 'hbinstrap_customize_preview_js');
