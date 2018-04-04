<?php
/**
 *
 * @package hbinstrap
 */

function hbinstrap_language_select_box($atts, $content = null)
{
    $options = shortcode_atts(array(
        'display_flag' => false,
        'display_text' => true,
        'parent_class' => 'language_select_box',
    ), $atts);

    $langguageList = hbinstrap_get_theme_options('language_list');

    if (empty($langguageList) || !is_array($langguageList)) {
        return '';
    }

    $content = '';
    foreach ($langguageList as $row) {
        $actived = (substr(get_locale(), 0, 2) == $row['short']) ? 'active' : '';
        $flagText = '';

        if ($options['display_flag']) {
            $flagText .= '<img class="flag-'.$row['short'].'" src="'. get_stylesheet_directory_uri() . '/images/flags/'.$row['flag'] . '" />';
        }
        if ($options['display_text']) {
            $flagText .= ' <span class="lang_text">'.$row['text'].'</span>';
        }
        $content .= '
			<a href="'.$row['url'].'" class="link-'.$row['short'].' '.$actived.'" title="'.$row['text'].'">
				'.$flagText.'
			</a>
		';
    }

    return '<div class="hbinstrap ' . $options['parent_class'] . '">
		'.$content.'
		</div>';
}

add_shortcode('hbinstrap_language_select_box', 'hbinstrap_language_select_box');

function hbinstrap_search_box($atts, $content = null)
{
    $options = shortcode_atts(array(), $atts);
    $strSearch = __('Search', 'hbinstrap');
    $submitUrl = esc_url(home_url('/'));

    return <<<HTML
        <form method="get" id="searchform" action="$submitUrl" role="search">
            <div class="input-group">
                <input class="field form-control" id="s" name="s" type="text"
                    placeholder="{$strSearch}" value="">
                <span class="input-group-btn">
                    <input class="submit btn btn-info" id="searchsubmit" name="submit" type="submit"
                    value="$strSearch">
            </span>
            </div>
        </form>
HTML;
}

add_shortcode('hbinstrap_search_box', 'hbinstrap_search_box');


