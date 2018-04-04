<?php
/**
 *
 * @package hbinstrap
 */

function hbinstrap_each_page_public_widget($post)
{
    $post_meta = get_post_meta($post->ID);
    $short_desc = !empty($post_meta['short_home_description'][0]) ? $post_meta['short_home_description'][0] : get_the_excerpt(); ?>

    <div class="entry-content card">
        <?php if (has_post_thumbnail($post)) : ?>
            <div class="card-img-top text-sm-center text-xs-center">
                <i class="fa fa-sort-desc"></i>
                <a href="<?php echo esc_url(get_permalink($post)); ?>" title="<?php $post->post_title; ?>">
                    <?php echo hbinstrap_get_the_post_thumbnail($post->ID, 'large'); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="card-block mt-3">
            <h4 class="card-title">
                <a href="<?php echo get_permalink($post); ?>">
                    <?php echo $post->post_title; ?>
                </a>
            </h4>
            <p class="card-text">
                <?php echo strip_tags($short_desc); ?>
                <a href="<?php echo get_permalink($post); ?>">
                    <?php //echo  __('Read more', 'hbinstrap') ?>
                </a>
            </p>
        </div>
        <h4 class="card-bottom">
            <i class="fa fa-sort-desc"></i>
            <a href="<?php echo get_permalink($post); ?>">
                <?php echo $post->short_title; ?>
            </a>
        </h4>

    </div>

    <?php
}

class hbinstrap_each_page_public_class extends WP_Widget
{
/**
 * Register widget with WordPress.
 */
public function __construct()
{
    parent::__construct(
        'hbinstrap_each_page_public', // Base ID
        __('HBINSTRAP: Each public page', 'hbinstrap'), // Name
        array( 'description' => __('Use public page html for display widget.', 'hbinstrap'))
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
    echo $args['before_widget'];
    echo $before_widget;

    $post = get_page($page_id);

    setup_postdata($post);

    hbinstrap_each_page_public_widget($post);

    wp_reset_postdata();

    echo $after_widget;

    echo $args['after_widget'];
}

public function form($instance)
{
    $page_id = isset($instance['page_id']) ? (int) $instance['page_id'] : 0;
    $is_display_home_only = isset($instance['is_display_home_only']) ? (int) $instance['is_display_home_only'] : 0;
    $before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
    $after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : '';

    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => 'publish',
        'child_of' => 0,
        'depth'                 => 1000,
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
    );
}
}

function register_hbinstrap_each_page_public_class()
{
    register_widget('hbinstrap_each_page_public_class');
}
add_action('widgets_init', 'register_hbinstrap_each_page_public_class');
