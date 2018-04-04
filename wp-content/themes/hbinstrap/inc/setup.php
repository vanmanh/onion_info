<?php
/**
 * Theme basic setup.
 *
 * @package hbinstrap
 */


// Set the content width based on the theme's design and stylesheet.
if (! isset($content_width)) {
    $content_width = 640; /* pixels */
}

if (! function_exists('hbinstrap_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function hbinstrap_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on hbinstrap, use a find and replace
         * to change 'hbinstrap' to the name of your theme in all the template files
         */
        load_theme_textdomain('hbinstrap', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'hbinstrap'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Adding Thumbnail basic support
         */
        add_theme_support('post-thumbnails');

        /*
         * Adding support for Widget edit icons in customizer
         */
        add_theme_support('customize-selective-refresh-widgets');

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('hbinstrap_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Set up the WordPress Theme logo feature.
        add_theme_support('custom-logo');
    }
endif; // hbinstrap_setup.
add_action('after_setup_theme', 'hbinstrap_setup');

if (! function_exists('hbinstrap_custom_excerpt_more')) {
    /**
     * Removes the ... from the excerpt read more link
     *
     * @param string $more The excerpt.
     *
     * @return string
     */
    function hbinstrap_custom_excerpt_more($more)
    {
        return '';
    }
}
add_filter('excerpt_more', 'hbinstrap_custom_excerpt_more');

if (! function_exists('hbinstrap_all_excerpts_get_more_link')) {
    /**
     * Adds a custom read more link to all excerpts, manually or automatically generated
     *
     * @param string $post_excerpt Posts's excerpt.
     *
     * @return string
     */
    function hbinstrap_all_excerpts_get_more_link($post_excerpt)
    {
        return '<p class="post_excerpt">'.$post_excerpt . ' [...]</p>';
    }
}
add_filter('wp_trim_excerpt', 'hbinstrap_all_excerpts_get_more_link');

/*
 * -----------------------------------------------------------------
 * Add new option Featured Posts on post page
 * -----------------------------------------------------------------
 */
function hbinstrap_custom_meta()
{
    add_meta_box('sm_meta', __('Featured Posts', 'hbinstrap'), 'hbinstrap_custom_meta_callback', 'post');
}
function hbinstrap_custom_meta_callback($post)
{
    $featured = get_post_meta($post->ID); ?>

    <p>
        <div class="sm-row-content">
            <label for="is_featured_post">
                <input type="checkbox"
                name="is_featured_post"
                id="is_featured_post"
                value="yes"
                <?php if (isset($featured['is_featured_post'])) {
        checked($featured['is_featured_post'][0], 'yes');
    } ?> />
                <?php _e('Featured this post', 'hbinstrap')?>
            </label>

        </div>
    </p>

    <?php
}
add_action('add_meta_boxes', 'hbinstrap_custom_meta');

/**
 * Saves the custom meta input
 */
function hbinstrap_custom_meta_save($post_id)
{
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['sm_nonce']) && wp_verify_nonce($_POST[ 'sm_nonce' ], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    // Checks for input and saves
    if (isset($_POST['is_featured_post'])) {
        update_post_meta($post_id, 'is_featured_post', 'yes');
    } else {
        update_post_meta($post_id, 'is_featured_post', '');
    }
}
add_action('save_post', 'hbinstrap_custom_meta_save');

/**
 * Search and setup thumbnail for post
 */

function hbinstrap_setup_thumbnail_post()
{
    $lastposts = get_posts(array(
        'posts_per_page' => 200
    ));

    if ($lastposts) {
        foreach ($lastposts as $post) :
        preg_match('/2017\/12\/[a-z0-9\_\-\+]+./', $post->post_content, $matchs);
        $image = str_replace('2017/12/', '', str_replace('.', '', $matchs[0]));
        //print_r($image);
        $imageObject = get_page_by_title($image, OBJECT, 'attachment');
        if (isset($imageObject->ID)) {
            $imageId = $imageObject->ID;
            print_r($imageId);
            print_r($post->ID);
            set_post_thumbnail($post->ID, $imageObject->ID);
        }

        endforeach;
    }
}
