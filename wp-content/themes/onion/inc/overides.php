<?php

function html_by_page_private_widget($post)
{
    $post_meta = get_post_meta($post->ID);
    if (!empty($post_meta['caption'][0]) || !empty($post_meta['caption_desc'][0])) {
        echo '<div class="caption_container">';
    }
    if (!empty($post_meta['caption'][0])) {
        echo '
            <h2 class="caption">'.$post_meta['caption'][0].'</h2>
        ';
    }
    if (!empty($post_meta['caption_desc'][0])) {
        echo '
            <p class="caption_desc">'.$post_meta['caption_desc'][0].'</p>
        ';
    }

    if (!empty($post_meta['button_text'][0]) && !empty($post_meta['button_link'][0])) {
        echo '
            <a href="'.$post_meta['button_link'][0].'" class="btn btn-info">'.$post_meta['button_text'][0].'</a>
        ';
    }

    if (!empty($post_meta['caption'][0]) || !empty($post_meta['caption_desc'][0])) {
        echo '</div>';
    }

    echo apply_filters('the_content', $post->post_content);
}
