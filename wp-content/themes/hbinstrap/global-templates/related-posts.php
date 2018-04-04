<?php
/**
 * Custom header setup.
 *
 * @package hbinstrap
 */

$is_display_related_post = hbinstrap_get_post_options('is_display_related_post');
$numof_related_post = hbinstrap_get_post_options('numof_related_post');

if (empty($is_display_related_post) || empty($numof_related_post)) {
    return '';
}

$tags = wp_get_post_tags($post->ID);
$cats = wp_get_post_categories($post->ID);
if ($tags) {
    $first_tag = $tags[0]->term_id;
    $args=array(
        'tag__in' => array($first_tag),
        'post__not_in' => array($post->ID),
        'posts_per_page' => $numof_related_post,
        'ignore_sticky_posts'=> 1
    );
    $relatedPostsQuery = new WP_Query($args);
} elseif ($cats) {
    $args=array(
        'cat__in' => $cats,
        'post__not_in' => array($post->ID),
        'posts_per_page' => $numof_related_post,
        'ignore_sticky_posts'=> 1
    );
    $relatedPostsQuery = new WP_Query($args);
}

if (isset($relatedPostsQuery) && $relatedPostsQuery->have_posts()) {
    echo '
        <div class="list_post_small_item related-post">
        <h3 class="single-wrapper__related-post-caption">
            '.__('Related Posts', 'hbinstrap').'
        </h3>
        <ul>
    ';
    while ($relatedPostsQuery->have_posts()) : $relatedPostsQuery->the_post(); ?>
        <li class="item">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </li>
    <?php
    endwhile;

    echo '</ul></div>';
}

wp_reset_query();
