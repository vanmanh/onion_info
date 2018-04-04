<?php
/**
 *
 * @package hbinstrap
 *
 */

$container = hbinstrap_get_theme_options('container_type');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <?php
        $codeGoogleAnalytics = hbinstrap_get_theme_options('google_analytics');
        if (!empty($codeGoogleAnalytics)):
    ?>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                ga('create', '<?php echo $codeGoogleAnalytics; ?>', 'auto');
                ga('send', 'pageview');
            </script>
    <?php
        endif;
    ?>
</head>

<body <?php body_class(); ?>>

<div class="hfeed site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">

        <a class="skip-link screen-reader-text sr-only" href="#content">
            <?php esc_html_e('Skip to content', 'hbinstrap'); ?>
        </a>

        <div class="container top-bar flex">
            <div class="ml-auto flex">
                <div class="text-link-top">
                    <a href="#form-subscribe">Subscribe</a>
                </div>
                <div class="search-form-top ml-auto">
                    <?php
                        echo do_shortcode('[hbinstrap_search_box]');
                    ?>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <?php if ('container' == $container) : ?>
            <div class="container header-container">
        <?php endif; ?>
                <?php if (!has_custom_logo()) : ?>

                    <?php if (is_front_page() && is_home()) : ?>

                        <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><?php bloginfo('name'); ?></a></h1>

                    <?php else : ?>

                        <a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><?php bloginfo('name'); ?></a>

                    <?php endif; ?>

                <?php
                else :
                    the_custom_logo();
                endif; ?><!-- end custom logo -->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- The WordPress Menu goes here -->
                <?php wp_nav_menu(
                    array(
                        'theme_location'  => 'primary',
                        'container_class' => 'collapse navbar-collapse mt-auto',
                        'container_id'    => 'navbarNavDropdown',
                        'menu_class'      => 'navbar-nav mr-auto',
                        'fallback_cb'     => '',
                        'menu_id'         => 'main-menu',
                        'walker'          => new hbinstrap_WP_Bootstrap_Navwalker(),
                    )
                ); ?>
                <script type="text/javascript">
                    /* global jQuery */
                    jQuery('li.dropdown').hover(function() {
                        jQuery(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
                    }, function() {
                        jQuery(this).find('.dropdown-menu').stop(true, true).hide();
                    });
                </script>

                <?php
                    //echo do_shortcode('[hbinstrap_language_select_box display_flag=1 display_text=0]');
                ?>
                <div class="top-social-icon social-icon-list d-none d-lg-block">
                    <?php
                        echo do_shortcode('[hbinstrap_social_icons]');
                    ?>
                </div>

        <?php if ('container' == $container) : ?>
            </div><!-- .container -->
        <?php endif; ?>

        </nav><!-- .site-navigation -->

    </div><!-- .wrapper-navbar end -->
    <?php do_action('hbinstrap_after_header'); ?>
