<?php
/**
 *
 * @package hbinstrap
 */

class hbinstrap_smart_col_list_class extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'scripts'));

        parent::__construct(
            'hbinstrap_smart_col_list',
            __('HBINSTRAP: Smart columns list item', 'hbinstrap'),
            array( 'description' => __('Use to display each colum with, image, url, title, description....', 'hbinstrap'))
        );
    }

    public function scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
        wp_enqueue_script('hbinstrap.admin', get_template_directory_uri() . '/js/hbinstrap.admin.js', array('jquery'));
    }

    public function widget($args, $instance)
    {
        $image = isset($instance['image']) ? $instance['image'] : '';
        $url = isset($instance['url']) ? $instance['url'] : '';
        $title = isset($instance['title']) ? $instance['title'] : '';
        $description = isset($instance['description']) ? $instance['description'] : '';
        $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0;
        $before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
        $after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : '';

        if ($is_display_home_only && !is_home()) {
            return '';
        }

        if (empty($page_id)) {
            return '';
        }
        echo $args['before_widget'];

        echo $before_widget;

        if (!empty($title)) {
            echo '<h2 class="title">
                <a href="'.$url.'">'.$title.'</a>
            </h2>';
        }
        if (!empty($image)) {
            echo '<a href="'.$url.'"><img src="'.$image.'" class="image img-fluid" /></a>';
        }
        if (!empty($description)) {
            echo '<div class="description">'.$title.'</div>';
        }

        echo $after_widget;

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $image = isset($instance['image']) ? $instance['image'] : '';
        $url = isset($instance['url']) ? $instance['url'] : '';
        $title = isset($instance['title']) ? $instance['title'] : '';
        $description = isset($instance['description']) ? $instance['description'] : '';
        $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0;
        $before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
        $after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : ''; ?>

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
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Link to click:'); ?></label>
            <input class="widefat"
                id="<?php echo $this->get_field_id('url'); ?>"
                name="<?php echo $this->get_field_name('url'); ?>"
                type="text" value="<?php echo esc_attr($url); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:'); ?></label>
            <textarea class="widefat"
                id="<?php echo $this->get_field_id('description'); ?>"
                name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_attr($description); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat"
                id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>"
                type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image:'); ?></label>
            <?php if (!empty($image)) : ?>
                <img class="img-prev" src="<?php echo $image; ?>" style="max-width: 100%" />
            <?php endif; ?>
            <input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_url($image); ?>" />
            <button class="upload_image_button button button-primary">Upload Image</button>
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
            'image' => (!empty($new_instance['image'])) ? strip_tags($new_instance['image']) : '',
            'url' => (!empty($new_instance['url'])) ? strip_tags($new_instance['url']) : '',
            'title' => (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '',
            'description' => (!empty($new_instance['description'])) ? $new_instance['description'] : '',
            'is_display_home_only' => (!empty($new_instance['is_display_home_only'])) ? (int) strip_tags($new_instance['is_display_home_only']) : 0,
            'before_widget' => (!empty($new_instance['before_widget'])) ? ($new_instance['before_widget']) : '',
            'after_widget' => (!empty($new_instance['after_widget'])) ? ($new_instance['after_widget']) : '',
        );
    }
}

function register_hbinstrap_smart_col_list_class()
{
    register_widget('hbinstrap_smart_col_list_class');
}
add_action('widgets_init', 'register_hbinstrap_smart_col_list_class');
