<?php
/**
 * Custom header setup.
 *
 * @package hbinstrap
 */

if (! function_exists('hbinstrap_newest_slider_small_widget')) :
/**
 * Generate social icons.
 *
 */

function hbinstrap_newest_slider_small_widget()
{
    $args = array(
        'numberposts' => 3,
        'offset' => 0,
        'category' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'include' => '',
        'exclude' => '',
        'meta_key' => '',
        'meta_value' =>'',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );

    $recent_posts = wp_get_recent_posts($args);
    if (empty($recent_posts)) {
        return '';
    }
    $container   = hbinstrap_get_theme_options('container_type');
    $output = '
        <div id="carouselControlsNewestPosts" class="carousel slide '.esc_attr($container).'" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
    ';

    foreach ($recent_posts as $recent) {
        $output .= '<li class="carousel-item"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
    }

    $output .= '
        </div>
    </div>
    <script>
        jQuery( ".carousel-item" ).first().addClass( "active" );
    </script>
    '; // carouselControlsNewestPosts

    return $output;
}

endif;

class hbinstrap_newest_slider_small_class extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'hbinstrap_newest_slider_small', // Base ID
            __('HBINSTRAP: newest post slider animation', 'hbinstrap'), // Name
            array( 'description' => __('Use this widget to add display small newest post slider.', 'hbinstrap'))
        );
    }

    public function widget($args, $instance)
    {
        $title = isset($instance['title']) ? (int) $instance['title'] : '';

        echo $args['before_widget'];

        if (! empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo hbinstrap_newest_slider_small_widget();

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = '';
        } ?>
        <p>
        <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title (optional):', 'hbinstrap'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        return array(
            'title' => (!empty($new_instance['title'])) ? (int) strip_tags($new_instance['title']) : '',
        );
    }
}

function register_hbinstrap_newest_slider_small_class()
{
    register_widget('hbinstrap_newest_slider_small_class');
}
add_action('widgets_init', 'register_hbinstrap_newest_slider_small_class');
