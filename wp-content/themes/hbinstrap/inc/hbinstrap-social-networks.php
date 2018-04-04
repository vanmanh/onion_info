<?php
/**
 *
 * @package hbinstrap
 */

if (!function_exists('hbinstrap_facebook_sdk_source')) :
    function hbinstrap_facebook_sdk_source()
    {
        global $hbinstrap_facebook_js_sdk;
        if (!empty($hbinstrap_facebook_js_sdk)) {
            return '';
        }
        return $hbinstrap_facebook_js_sdk = '
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, "script", "facebook-jssdk"));</script>
        ';
    }
endif;

if (!function_exists('hbinstrap_facebook_comment_box')) :

function hbinstrap_facebook_comment_box($url = '', $width = '100%', $numposts = 5)
{
    $output = hbinstrap_facebook_sdk_source();
    $output .= '<div class="fb-comments" data-numposts="'.$numposts.'" data-href="'.$url.'" data-width="'.$width.'"></div>';

    return $output;
}

endif;

if (!function_exists('hbinstrap_facebook_like_button')) :

function hbinstrap_facebook_like_button($url = '', $options = array())
{
    $defaultOption = array(
        'layout' => 'button_count',
        'action' => 'like',
        'size' => 'large',
        'show-faces' => 'true',
        'share' => 'true',
        'class' => 'fb-like',
    );
    $options = array_merge($defaultOption, $options);

    $output = hbinstrap_facebook_sdk_source();
    $output .= '<div class="'.$options[''].'" data-href="'.$url.'" data-layout="'.$options['layout'].'"
data-action="'.$options['action'].'" data-size="'.$options['size'].'" data-show-faces="'.$options['show-faces'].'" data-share="'.$options['share'].'"></div>';

    return $output;
}

endif;


if (!function_exists('hbinstrap_social_share_buttons')) :

function hbinstrap_social_share_buttons($url = '', $title = '')
{
    $output = '<div class="social_share_buttons social-icons-item">';
    $output .= '
        <a href="http://www.facebook.com/sharer.php?u='.$url.'" target="_blank" title="Facebook" class="facebook">
            <i class="fa fa-facebook"></i>
        </a>
    ';
    $output .= '
        <a href="https://plus.google.com/share?url='.$url.'" target="_blank" title="Google plus" class="google-plus">
            <i class="fa fa-google-plus"></i>
        </a>
    ';
    $output .= '
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$url.'" target="_blank" title="Linkedin" class="linkedin">
            <i class="fa fa-linkedin"></i>
        </a>
    ';
    $output .= '
        <a href="javascript:void((function()%7Bvar%20e=document.createElement(\'script\');e.setAttribute(\'type\',\'text/javascript\');e.setAttribute(\'charset\',\'UTF-8\');e.setAttribute(\'src\',\'http://assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="pinterest">
            <i class="fa fa-pinterest-p"></i>
        </a>
    ';
    $output .= '
        <a href="javascript:;" onclick="window.print()" title="Print" class="print">
            <i class="fa fa-print"></i>
        </a>
    ';
    $output .= '
        <a href="http://reddit.com/submit?url='.$url.'" target="_blank" title="Reddit" class="reddit">
            <i class="fa fa-reddit-alien"></i>
        </a>
    ';

    $output .= '</div>';

    return $output;
}

endif;
