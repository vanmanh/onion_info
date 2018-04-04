<?php
/**
 *
 * @package hbinstrap
 */

if (! function_exists('html_by_page_private_widget')) {
    function html_by_page_private_widget($post)
    {
        echo apply_filters('the_content', $post->post_content);
    }
}

class hbinstrap_html_by_page_private_class extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'hbinstrap_html_by_page_private', // Base ID
            __('HBINSTRAP: Private page html display', 'hbinstrap'), // Name
            array( 'description' => __('Use private page html for display widget.', 'hbinstrap'))
        );
    }

    public function widget($args, $instance)
    {
        $page_id = isset($instance['page_id']) ? (int) $instance['page_id'] : 0;
        $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0;
        $before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
        $after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : '';

        if ($is_display_home_only && !is_home()) {
            return '';
        }

        if (empty($page_id)) {
            return '';
        }
        $post = get_page($page_id);
        echo $args['before_widget'];

        $title = isset($instance['title']) ? $instance['title'] : '';

        if (! empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }


        echo $before_widget;
        html_by_page_private_widget($post);
        echo $after_widget;

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $page_id = isset($instance['page_id']) ? (int) $instance['page_id'] : 0;
        $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0;
        $before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
        $after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : '';

        $title = isset($instance['title']) ? $instance['title'] : '';

        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'private',
            'depth'                 => 0,
            'selected'              => $page_id,
            'echo'                  => 1,
            'name'                  => $this->get_field_name('page_id'),
            'id'                    => $this->get_field_id('page_id'),
            'class'                 => null,
            'show_option_none'      => '--- No display',
            'show_option_no_change' => null,
            'option_none_value'     => '',
        ); ?>
        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title (optional):', 'hbinstrap'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name('page_id'); ?>">
                <?php _e('Select a page', 'hbinstrap'); ?>
            </label>
        </p>
        <p>
            <?php
                wp_dropdown_pages($args); ?>
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

        <p>
            <label>
                <?php _e('Before widget', 'hbinstrap'); ?>
            </label>
        </p>
        <p>
            <input class="widefat"
                id="<?php echo $this->get_field_id('before_widget'); ?>"
                name="<?php echo $this->get_field_name('before_widget'); ?>"
                type="text"
                value="<?php echo esc_attr($before_widget); ?>" />
        </p>
        <p>
            <label>
                <?php _e('After widget', 'hbinstrap'); ?>
            </label>
        </p>
        <p>
            <input class="widefat"
                id="<?php echo $this->get_field_id('after_widget'); ?>"
                name="<?php echo $this->get_field_name('after_widget'); ?>"
                type="text"
                value="<?php echo esc_attr($after_widget); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        return array(
            'page_id' => (!empty($new_instance['page_id'])) ? (int) strip_tags($new_instance['page_id']) : 0,
            'is_display_home_only' => (!empty($new_instance['is_display_home_only'])) ? (int) strip_tags($new_instance['is_display_home_only']) : 0,
            'before_widget' => (!empty($new_instance['before_widget'])) ? ($new_instance['before_widget']) : '',
            'after_widget' => (!empty($new_instance['after_widget'])) ? ($new_instance['after_widget']) : '',
            'title' => (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '',
        );
    }
}

function register_hbinstrap_html_by_page_private_class()
{
    register_widget('hbinstrap_html_by_page_private_class');
}
add_action('widgets_init', 'register_hbinstrap_html_by_page_private_class');
