<?php
/**
 * Custom header setup.
 *
 * @package hbinstrap
 */

if (! function_exists('hbinstrap_featured_post_large_home_widget')) :
/**
 * Generate social icons.
 *
 */

function hbinstrap_featured_post_large_home_widget()
{
    $container   = hbinstrap_get_theme_options('container_type');

    $output = '<div class="featured_post_home '.esc_attr($container).'">
        <div class="row">
    ';

    $args = array(
        'posts_per_page' => 3,
        'meta_key' => 'is_featured_post',
        'meta_value' => 'yes'
    );
    $featured = new WP_Query($args);
    $mapCol = array(
        1 => 'col-lg-6',
        2 => 'col-lg-3',
        3 => 'col-lg-3',
    );
    $mapImage = array(
        1 => 'large',
        2 => 'medium',
        3 => 'medium',
    );
    $i = 1;

    if ($featured->have_posts()):

        while ($featured->have_posts()): $featured->the_post();
    $output .= '
                <div class="'. $mapCol[$i] .'">

                    <article class="' . join(' ', get_post_class()) . '" id="post-'.get_the_ID().'">
                        <div class="entry-content card">

                        <div class="card-img-top">
                            <a href="' .esc_url(get_permalink()). '">'
                            . hbinstrap_get_the_post_thumbnail(get_the_ID(), $mapImage[$i])
                        .'
                            </a>
                        </div>
                        <div class="card-block mt-3">
                            <header class="entry-header">
                                <h5>
                                    <a href="' .esc_url(get_permalink()). '">'
                                        . get_the_title()
                                    . '</a>
                                </h5>
                            </header>'
                            . get_the_excerpt()
                    . '</article>

                </div>
            ';

    ++$i;
    endwhile;

    endif;

    $output .= '
            </div>
        </div>'; // featured_post_home

    return $output;
}

endif;

class hbinstrap_featured_post_large_home_class extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'hbinstrap_featured_post_large_home', // Base ID
            __('HBINSTRAP: Featured post large', 'hbinstrap'), // Name
            array( 'description' => __('Use this widget to add display large featured post in home page. In post admin, please checked to featured post option.', 'hbinstrap'))
        );
    }

    public function widget($args, $instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';

        echo $args['before_widget'];

        if (! empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo hbinstrap_featured_post_large_home_widget();

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
        $instance = array();
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

function register_hbinstrap_featured_post_large_home_class()
{
    register_widget('hbinstrap_featured_post_large_home_class');
}
add_action('widgets_init', 'register_hbinstrap_featured_post_large_home_class');
