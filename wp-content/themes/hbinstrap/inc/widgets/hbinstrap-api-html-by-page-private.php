<?php
/**
 *
 * @package hbinstrap
 */

if (! function_exists('api_html_by_page_private_widget')) {
    function api_html_by_page_private_widget($instance)
    {
        $before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
        $after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : '';
        $page_id = isset($instance['page_id']) ? (int) $instance['page_id'] : 0;
        $blog_id = isset($instance['blog_id']) ? (int) $instance['blog_id'] : 0;

        echo $before_widget;

        if (!$blog_id) {
            return '';
        }

        global $switched;
        switch_to_blog($blog_id);

        $post = get_page($page_id);

        echo apply_filters('the_content', $post->post_content);

        restore_current_blog();

        echo $after_widget;
    }
}

class hbinstrap_api_html_by_page_private_class extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'hbinstrap_api_html_by_page_private', // Base ID
            __('HBINSTRAP-API: Private page html display', 'hbinstrap'), // Name
            array( 'description' => __('Use private page html for display widget.', 'hbinstrap'))
        );
    }

    public function widget($args, $instance)
    {
        $blog_id = isset($instance['blog_id']) ? (int) $instance['blog_id'] : 0;
        $page_id = isset($instance['page_id']) ? (int) $instance['page_id'] : 0;
        $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0;

        if (($is_display_home_only && !is_home()) || empty($page_id) || !$blog_id) {
            return '';
        }

        echo $args['before_widget'];

        api_html_by_page_private_widget($instance);

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $page_id = isset($instance['page_id']) ? (int) $instance['page_id'] : 0;
        $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0;
        $before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
        $after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : '';
        $blog_id = isset($instance['blog_id']) ? (int) $instance['blog_id'] : 0; ?>

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

        <?php
        if (!empty($blog_id)) : ?>
            <p>
                <label for="<?php echo $this->get_field_name('page_id'); ?>">
                    <?php _e('Select a page', 'hbinstrap'); ?>
                </label>
            </p>
            <p>
                <?php
                    global $switched;
        switch_to_blog($blog_id);

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
                    );
        wp_dropdown_pages($args);

        restore_current_blog(); ?>
            </p>

        <?php endif; // has blog id?>

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
            'blog_id' => (!empty($new_instance['blog_id'])) ? (int) strip_tags($new_instance['blog_id']) : 0,
            'page_id' => (!empty($new_instance['page_id'])) ? (int) strip_tags($new_instance['page_id']) : 0,
            'is_display_home_only' => (!empty($new_instance['is_display_home_only'])) ? (int) strip_tags($new_instance['is_display_home_only']) : 0,
            'before_widget' => (!empty($new_instance['before_widget'])) ? ($new_instance['before_widget']) : '',
            'after_widget' => (!empty($new_instance['after_widget'])) ? ($new_instance['after_widget']) : '',
        );
    }
}

function register_hbinstrap_api_html_by_page_private_class()
{
    register_widget('hbinstrap_api_html_by_page_private_class');
}
add_action('widgets_init', 'register_hbinstrap_api_html_by_page_private_class');
