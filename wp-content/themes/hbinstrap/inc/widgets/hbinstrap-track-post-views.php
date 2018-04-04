<?php
/**
 *
 * @package hbinstrap
 */

define('HBINSTRAP_POST_VIEW_COUNT', 'hbinstrap_post_views_count');

function hbinstrap_set_post_views($postID)
{
    $count = get_post_meta($postID, HBINSTRAP_POST_VIEW_COUNT, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, HBINSTRAP_POST_VIEW_COUNT);
        add_post_meta($postID, HBINSTRAP_POST_VIEW_COUNT, '0');
    } else {
        $count++;
        update_post_meta($postID, HBINSTRAP_POST_VIEW_COUNT, $count);
    }
}
    //To keep the count accurate, lets get rid of prefetching
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

    function hbinstrap_track_post_views($post_id)
    {
        if (!is_single()) {
            return;
        }
        if (empty($post_id)) {
            global $post;
            $post_id = $post->ID;
        }
        hbinstrap_set_post_views($post_id);
    }

    add_action('wp_head', 'hbinstrap_track_post_views');

    function hbinstrap_get_post_views($postID, $afterFixSingle = ' view', $afterFixMulti = ' views')
    {
        $count = get_post_meta($postID, HBINSTRAP_POST_VIEW_COUNT, true);
        if (empty($count)) {
            delete_post_meta($postID, HBINSTRAP_POST_VIEW_COUNT);
            add_post_meta($postID, HBINSTRAP_POST_VIEW_COUNT, '0');

            return "0" . $afterFixSingle;
        }

        return $count.$afterFixMulti;
    }

if (!function_exists('hbinstrap_post_views_widget')) :
/**
 * Generate social icons.
 *
 */

function hbinstrap_post_views_widget($instance)
{
    $postsList = new WP_Query(
        array(
            'posts_per_page' => isset($instance['numof_display']) ? (int) $instance['numof_display'] : 5,
            'meta_key' => HBINSTRAP_POST_VIEW_COUNT,
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        )
    );
    echo '
        <div id="hbinstrapPostViews" class="hbinstrap_post_views list_post_small_item">
    ';
    while ($postsList->have_posts()) :
        $postsList->the_post();
    get_template_part('loop-templates/content', 'small-image');

    endwhile;

    echo '</div>';
}

endif;

class hbinstrap_post_views_class extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'hbinstrap_post_views', // Base ID
            __('HBINSTRAP: Popular posts', 'hbinstrap'), // Name
            array( 'description' => __('Use this widget to add display popular posts.', 'hbinstrap'))
        );
    }

    public function widget($args, $instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';

        echo $args['before_widget'];

        if (! empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo hbinstrap_post_views_widget($instance);

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $numof_display = isset($instance['numof_display']) ? (int) $instance['numof_display'] : 5; ?>
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
			<label for="<?php echo $this->get_field_name('numof_display'); ?>">
				<?php _e('Num of display (1->xxx):', 'hbinstrap'); ?>
			</label>
			<input class="widefat"
				id="<?php echo $this->get_field_id('numof_display'); ?>"
				name="<?php echo $this->get_field_name('numof_display'); ?>"
				type="text" value="<?php echo esc_attr($numof_display); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        return array(
            'title' => (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '',
            'numof_display' => (!empty($new_instance['numof_display'])) ? (int) strip_tags($new_instance['numof_display']) : 5,
        );
    }
}

function register_hbinstrap_post_views_class()
{
    register_widget('hbinstrap_post_views_class');
}
add_action('widgets_init', 'register_hbinstrap_post_views_class');
