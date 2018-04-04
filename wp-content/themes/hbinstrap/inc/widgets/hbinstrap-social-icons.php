<?php
/**
 * Custom header setup.
 *
 * @package hbinstrap
 * @shortcode [hbinstrap_social_icons]
 *
 */

function hbinstrap_get_social_icons_list()
{
    $hbinstrap_get_social_icons_list = array(
        'facebook_link'     => array(
            'genericon_class'   => 'facebook-alt',
            'faicon_class' => 'fa fa-facebook',
            'label'             => esc_html__('Facebook', 'hbinstrap')
        ),
        'twitter_link'      => array(
            'genericon_class'   => 'twitter',
            'faicon_class' => 'fa fa-twitter',
            'label'             => esc_html__('Twitter', 'hbinstrap')
        ),
        'googleplus_link'   => array(
            'genericon_class'   => 'googleplus-alt',
            'faicon_class' => 'fa fa-google-plus',
            'label'             => esc_html__('Googleplus', 'hbinstrap')
        ),
        'email_link'        => array(
            'genericon_class'   => 'mail',
            'faicon_class' => 'fa fa-envelope-o',
            'label'             => esc_html__('Email', 'hbinstrap')
        ),
        'feed_link'         => array(
            'genericon_class'   => 'feed',
            'faicon_class' => 'fa fa-feed',
            'label'             => esc_html__('Feed', 'hbinstrap')
        ),
        'wordpress_link'    => array(
            'genericon_class'   => 'wordpress',
            'faicon_class' => 'fa fa-wordpress',
            'label'             => esc_html__('WordPress', 'hbinstrap')
        ),
        'linkedin_link'     => array(
            'genericon_class'   => 'linkedin',
            'faicon_class' => 'fa fa-linkedin',
            'label'             => esc_html__('LinkedIn', 'hbinstrap')
        ),
        'pinterest_link'    => array(
            'genericon_class'   => 'pinterest',
            'faicon_class' => 'fa fa-pinterest-p',
            'label'             => esc_html__('Pinterest', 'hbinstrap')
        ),
        'flickr_link'       => array(
            'genericon_class'   => 'flickr',
            'faicon_class' => 'fa fa-flickr',
            'label'             => esc_html__('Flickr', 'hbinstrap')
        ),
        'vimeo_link'        => array(
            'genericon_class'   => 'vimeo',
            'faicon_class' => 'fa fa-vimeo',
            'label'             => esc_html__('Vimeo', 'hbinstrap')
        ),
        'youtube_link'      => array(
            'genericon_class'   => 'youtube',
            'faicon_class' => 'fa fa-youtube-play',
            'label'             => esc_html__('YouTube', 'hbinstrap')
        ),
        'tumblr_link'       => array(
            'genericon_class'   => 'tumblr',
            'faicon_class' => 'fa fa-tumblr',
            'label'             => esc_html__('Tumblr', 'hbinstrap')
        ),
        'instagram_link'    => array(
            'genericon_class'   => 'instagram',
            'faicon_class' => 'fa fa-instagram',
            'label'             => esc_html__('Instagram', 'hbinstrap')
        ),
        'dribbble_link'     => array(
            'genericon_class'   => 'dribbble',
            'faicon_class' => 'fa fa-dribbble',
            'label'             => esc_html__('Dribbble', 'hbinstrap')
        ),
        'skype_link'        => array(
            'genericon_class'   => 'skype',
            'faicon_class' => 'fa fa-skype',
            'label'             => esc_html__('Skype', 'hbinstrap')
        ),
        'digg_link'         => array(
            'genericon_class'   => 'digg',
            'faicon_class' => 'fa fa-digg',
            'label'             => esc_html__('Digg', 'hbinstrap')
        ),
        'reddit_link'       => array(
            'genericon_class'   => 'reddit',
            'faicon_class' => 'fa fa-reddit-alien',
            'label'             => esc_html__('Reddit', 'hbinstrap')
        ),
        'stumbleupon_link'  => array(
            'genericon_class'   => 'stumbleupon',
            'faicon_class' => 'fa fa-stumbleupon',
            'label'             => esc_html__('Stumbleupon', 'hbinstrap')
        ),
        'twitch_link'       => array(
            'genericon_class'   => 'twitch',
            'faicon_class' => 'fa fa-twitch',
            'label'             => esc_html__('Twitch', 'hbinstrap'),
        ),
        'website_link'      => array(
            'genericon_class'   => 'website',
            'faicon_class' => 'fa fa-external-link',
            'label'             => esc_html__('Website', 'hbinstrap'),
        ),
    );

    return apply_filters('hbinstrap_get_social_icons_list_filter', $hbinstrap_get_social_icons_list);
}


if (! function_exists('hbinstrap_social_icons_widget')) :
/**
 * Generate social icons.
 *
 */

function hbinstrap_social_icons_widget()
{
    // if ((!$output = get_transient('hbinstrap_social_icons_list'))) {

    $options = hbinstrap_get_theme_options('hbinstrap_social_icons_list');
    if (empty($options)) {
        return '';
    }

    $output = '';

    //Pre defined Social Icons Link Start
    $pre_def_social_icons = hbinstrap_get_social_icons_list();

    foreach ($options as $key => $link) {
        // If empty
        if (empty($link)) {
            continue;
        }

        $genericon_class = sanitize_key($pre_def_social_icons[$key]['genericon_class']);
        $label = esc_attr($pre_def_social_icons[$key]['label']);
        $faicon = esc_attr($pre_def_social_icons[$key]['faicon_class']);

        if ('email_link' == $key) {
            $output .= '
                <a class="social-icons-item icon-'. $genericon_class .'" target="_blank" title="'. esc_attr__('Email', 'hbinstrap') . '" href="mailto:'. antispambot(sanitize_email($link)) .'">
                    <span class="screen-reader-text">'. __('Email', 'hbinstrap') . '</span>
                    <i class="'.$faicon.'"></i>
                </a>
                ';
        } elseif ('skype_link' == $key) {
            $output .= '
                <a class="social-icons-item  icon-'. $genericon_class .'" target="_blank" title="'. $label . '" href="'. esc_attr($value) .'">
                    <span class="screen-reader-text">'. $label . '</span>
                    <i class="'.$faicon.'"></i>
                </a>';
        } elseif ('phone_link' == $key || 'handset_link' == $key) {
            $output .= '
                <a class="social-icons-item icon-'. $genericon_class .'" target="_blank" title="'. $label . '" href="tel:' . preg_replace('/\s+/', '', esc_attr($link)) . '">
                    <span class="screen-reader-text">'. $label . '</span>
                    <i class="'.$faicon.'"></i>
                </a>';
        } else {
            $output .= '
                <a class="social-icons-item icon-'. $genericon_class .'" target="_blank" title="'. $label .'" href="'. esc_url($link) .'">
                    <span class="screen-reader-text">'. $label .'</span>
                    <i class="'.$faicon.'"></i>
                </a>';
        }
    }

    //     set_transient('hbinstrap_social_icons', $output, 60);
    // }

    return $output;
}

endif;

function hbinstrap_social_icons_short_code($atts, $content = null)
{
    return hbinstrap_social_icons_widget();
}

add_shortcode('hbinstrap_social_icons', 'hbinstrap_social_icons_short_code');

class hbinstrap_social_icons_class extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'hbinstrap_social_icons', // Base ID
            __('HBINSTRAP: Social Icons', 'hbinstrap'), // Name
            array( 'description' => __('Use this widget to add Social Icons as a widget. ', 'hbinstrap'))
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';

        echo $args['before_widget'];

        if (! empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo hbinstrap_social_icons_widget();

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
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

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

function register_hbinstrap_social_icons_class()
{
    register_widget('hbinstrap_social_icons_class');
}
add_action('widgets_init', 'register_hbinstrap_social_icons_class');
