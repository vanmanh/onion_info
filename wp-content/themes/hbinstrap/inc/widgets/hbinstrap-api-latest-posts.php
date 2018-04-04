<?php
/**
 * @package hbinstrap
 */

if (!function_exists('hbinstrap_api_latest_posts_other_blog_widget')) :

function hbinstrap_api_latest_posts_other_blog_widget($instance)
{
    $numof_display = isset($instance['numof_display']) ? (int) $instance['numof_display'] : 4;
    $blog_id = isset($instance['blog_id']) ? (int) $instance['blog_id'] : 0;
    if (!$blog_id) {
        return '';
    }
    global $switched;
    switch_to_blog($blog_id);

    echo '
        <div id="hbinstrapPostViews" class="hbinstrap_api_latest_posts list_post_small_item row">
    ';

    $args = array('numberposts' => $numof_display);

    $recent_posts = wp_get_recent_posts($args);
    foreach ($recent_posts as $post) {
        echo '<div class="col-lg-6 media">
            <a class="d-flex mr-3" href="' . get_permalink($post["ID"]) . '" title="' . $post["post_title"].'">
                ' . hbinstrap_get_the_post_thumbnail($post["ID"], 'small', true) . '
            </a>
            <div class="media-body">
                <h4 class="title_entry">
                    <a href="' . get_permalink($post["ID"]) . '" title="' . $post["post_title"] . '">' . $post["post_title"] . '</a>
                </h4>
                '.hbinstrap_get_posted_on().'
            </div>
        </div>';
    }

    wp_reset_query();

    echo '</div>';

    restore_current_blog();
}

endif;

class hbinstrap_api_latest_posts_other_blog_class extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'hbinstrap_api_latest_posts_other_blog', // Base ID
            __('HBINSTRAP-API: Get latest post from other blog', 'hbinstrap'), // Name
            array( 'description' => __('Use this widget to load latest post from other blog.', 'hbinstrap'))
        );
    }

    public function widget($args, $instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0;

        if ($is_display_home_only && !is_home()) {
            return '';
        }

        echo $args['before_widget'];

        if (! empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo hbinstrap_api_latest_posts_other_blog_widget($instance);

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $numof_display = isset($instance['numof_display']) ? (int) $instance['numof_display'] : 5;
        $blog_id = isset($instance['blog_id']) ? (int) $instance['blog_id'] : 0;
        $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0; ?>
        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>">
                <?php _e('Title (optional):', 'hbinstrap'); ?>
            </label>
            <input class="widefat"
                id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>"
                type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name('blog_id'); ?>">
                <?php _e('Select a Blog', 'hbinstrap'); ?>
            </label>
            <select name="<?php echo $this->get_field_name('blog_id'); ?>">
        <?php
            $blog_list = get_blog_list(0, 'all');
        foreach ($blog_list as $blog) {
            $selected = ($blog['blog_id'] == $blog_id) ? 'selected' : '';
            echo '<option value="'.$blog['blog_id'].'" '.$selected.'>Blog '.$blog['blog_id'].': '.$blog['domain'].'<option/>';
        } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_name('numof_display'); ?>">
                <?php _e('Num of display (1->xxx):', 'hbinstrap'); ?>
            </label>
            <input class="widefat"
                id="<?php echo $this->get_field_id('numof_display'); ?>"
                name="<?php echo $this->get_field_name('numof_display'); ?>"
                type="text" value="<?php echo esc_attr($numof_display); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name('is_display_home_only'); ?>">
                <?php _e('Display home only', 'hbinstrap'); ?>
            </label>
        </p>
        <p>
            <input type="checkbox"
                id="<?php echo $this->get_field_id('is_display_home_only'); ?>"
                name="<?php echo $this->get_field_name('is_display_home_only'); ?>"
                value="1"
                <?php echo ($is_display_home_only) ? ' checked ' : ''; ?>
                />
        </p>

        <?php
    }

    public function update($new_instance, $old_instance)
    {
        return array(
            'title' => (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '',
            'numof_display' => (!empty($new_instance['numof_display'])) ? (int) strip_tags($new_instance['numof_display']) : 4,
            'blog_id' => (!empty($new_instance['blog_id'])) ? (int) strip_tags($new_instance['blog_id']) : 0,
            'is_display_home_only' => (!empty($new_instance['is_display_home_only'])) ? (int) strip_tags($new_instance['is_display_home_only']) : 0,
        );
    }
}

function register_hbinstrap_api_latest_posts_other_blog_class()
{
    register_widget('hbinstrap_api_latest_posts_other_blog_class');
}
add_action('widgets_init', 'register_hbinstrap_api_latest_posts_other_blog_class');
