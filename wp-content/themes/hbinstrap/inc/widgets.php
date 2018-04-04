<?php
/**
 *
 * @package hbinstrap
 */

if (! function_exists('hbinstrap_slbd_count_widgets')) {
    function hbinstrap_slbd_count_widgets($sidebar_id)
    {
        // If loading from front page, consult $_wp_sidebars_widgets rather than options
        // to see if wp_convert_widget_settings() has made manipulations in memory.
        global $_wp_sidebars_widgets;
        if (empty($_wp_sidebars_widgets)) :
            $_wp_sidebars_widgets = get_option('sidebars_widgets', array());
        endif;

        $sidebars_widgets_count = $_wp_sidebars_widgets;

        if (isset($sidebars_widgets_count[ $sidebar_id ])) :
            $widget_count = count($sidebars_widgets_count[ $sidebar_id ]);
        $widget_classes = 'widget-count-' . count($sidebars_widgets_count[ $sidebar_id ]);
        if ($widget_count % 4 == 0 || $widget_count > 6) :
                // Four widgets per row if there are exactly four or more than six
                $widget_classes .= ' col-md-3'; elseif (6 == $widget_count) :
                // If two widgets are published
                $widget_classes .= ' col-md-2'; elseif ($widget_count >= 3) :
                // Three widgets per row if there's three or more widgets
                $widget_classes .= ' col-md-4'; elseif (2 == $widget_count) :
                // If two widgets are published
                $widget_classes .= ' col-md-6'; elseif (1 == $widget_count) :
                // If just on widget is active
                $widget_classes .= ' col-md-12';
        endif;
        return $widget_classes;
        endif;
    }
}

if (! function_exists('hbinstrap_widgets_init')) {
    /**
     * Initializes themes widgets.
     */
    function hbinstrap_widgets_init()
    {
        register_sidebar(array(
            'name'          => __('Right Sidebar', 'hbinstrap'),
            'id'            => 'right-sidebar',
            'description'   => 'Right sidebar widget area',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));

        register_sidebar(array(
            'name'          => __('Left Sidebar', 'hbinstrap'),
            'id'            => 'left-sidebar',
            'description'   => 'Left sidebar widget area',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));

        register_sidebar(array(
            'name'          => __('After Header', 'hbinstrap'),
            'id'            => 'after-header',
            'description'   => 'Display after header on front page',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));

        register_sidebar(array(
            'name'          => __('Before Footer', 'hbinstrap'),
            'id'            => 'before-footer',
            'description'   => 'Display before footer',
            'before_widget' => '<div class="before-footer-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));

        register_sidebar(array(
            'name'          => __('Hero Slider', 'hbinstrap'),
            'id'            => 'hero',
            'description'   => 'Hero slider area. Place two or more widgets here and they will slide!',
            'before_widget' => '<div class="carousel-item">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => '',
        ));

        register_sidebar(array(
            'name'          => __('Hero Static before Owl slider', 'hbinstrap'),
            'id'            => 'statichero_before_owl_slider',
            'description'   => 'Static widget. no slider functionallity',
            'before_widget'  => '<div id="%1$s" class="static-hero-widget %2$s '. hbinstrap_slbd_count_widgets('statichero_before_owl_slider') .'">',
            'after_widget'   => '</div><!-- .static-hero-widget -->',
            'before_title'   => '<h3 class="widget-title">',
            'after_title'    => '</h3>',
        ));

        register_sidebar(array(
            'name'          => __('Owl Slider', 'hbinstrap'),
            'id'            => 'owl',
            'description'   => 'Owl slider area. Place two or more widgets here and they will slide!',
            'before_widget' => '<div class="item">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => '',
        ));

        register_sidebar(array(
            'name'          => __('Hero Static', 'hbinstrap'),
            'id'            => 'statichero',
            'description'   => 'Static Hero widget. no slider functionallity',
            'before_widget'  => '<div id="%1$s" class="static-hero-widget %2$s '. hbinstrap_slbd_count_widgets('statichero') .'">',
            'after_widget'   => '</div><!-- .static-hero-widget -->',
            'before_title'   => '<h3 class="widget-title">',
            'after_title'    => '</h3>',
        ));

        register_sidebar(array(
            'name'          => __('Footer Full', 'hbinstrap'),
            'id'            => 'footerfull',
            'description'   => 'Widget area below main content and above footer',
            'before_widget'  => '<div id="%1$s" class="footer-widget %2$s '. hbinstrap_slbd_count_widgets('footerfull') .'">',
            'after_widget'   => '</div><!-- .footer-widget -->',
            'before_title'   => '<h3 class="widget-title">',
            'after_title'    => '</h3>',
        ));
        register_sidebar(array(
            'name'          => __('Footer End', 'hbinstrap'),
            'id'            => 'footer-end',
            'description'   => 'Widget area end of footer',
            'before_widget'  => '<div id="%1$s" class="footer-widget %2$s '. hbinstrap_slbd_count_widgets('footer-end') .'">',
            'after_widget'   => '</div><!-- .footer-widget -->',
            'before_title'   => '<h3 class="widget-title">',
            'after_title'    => '</h3>',
        ));
    }
} // endif function_exists( 'hbinstrap_widgets_init' ).
add_action('widgets_init', 'hbinstrap_widgets_init');
