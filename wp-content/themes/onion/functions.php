<?php
/**
 *
 * @package hoteliers
 */

require_once get_template_directory() . '/inc/enqueue.php';
require_once get_stylesheet_directory() . '/inc/enqueue.php';
require get_stylesheet_directory() . '/inc/overides.php';
require get_stylesheet_directory() . '/inc/widgets.php';
require get_stylesheet_directory() . '/inc/widgets/hbinstrap-each-page-public.php';

// Custom Function to Include
function my_favicon_link()
{
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_stylesheet_directory_uri().'/favicon.ico" />' . "\n";
}
add_action('wp_head', 'my_favicon_link');

function my_child_theme_setup()
{
    load_child_theme_textdomain('htsgroup', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'my_child_theme_setup');

$hbinstrap_child_theme_default_option['language_list'] = array(
    array(
        'short' => 'en',
        'iso_code' => 'en_US',
        'text' => 'English',
        'flag' => 'en.png', // images/flags
        'url' => '/',
    ),
    // array(
    //     'short' => 'vi',
    //     'iso_code' => 'vi',
    //     'text' => 'Vietnamese',
    //     'flag' => 'vi.png',
    //     'url' => '/vi',
    // )
);

$hbinstrap_child_theme_default_option['google_analytics'] = 'UA-113452213-1';

$hbinstrap_child_theme_default_option['footer_text'] = '<div class="text-sm-center">
    Address: Floor 4, 86-88, Ham Nghi Blvd, Ben Nghe ward, District 1, Ho Chi Minh City - Copyright © 2014 - Developed by HTS Group.
    </div>
';
$hbinstrap_child_theme_default_option['hbinstrap_social_icons_list'] = array(
    'facebook_link' => 'https://www.facebook.com/VietnamHospitalityNetwork',
    'googleplus_link' => 'https://plus.google.com/u/0/111824644620451296999',
    'youtube_link' => 'https://www.youtube.com/channel/UC7lDGgd-wxWkBubCQYyYcyg',
    'linkedin_link' => 'https://www.linkedin.com/company/10241403/',
);
