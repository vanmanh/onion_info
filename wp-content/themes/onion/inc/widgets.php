<?php

if (! function_exists('hbinstrap_widgets_init_child')) {
    /**
     * Initializes themes widgets.
     */
    function hbinstrap_widgets_init_child()
    {
        register_sidebar(array(
            'name'          => __('Our partner', 'htsgroup'),
            'id'            => 'our_partner',
            'description'   => '',
            'before_widget' => '<div class="col-12">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
}
add_action('widgets_init', 'hbinstrap_widgets_init_child');
