<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package hbinstrap
 */

?>

<article <?php post_class('media'); ?> id="post-<?php the_ID(); ?>">

    <?php
        if (has_post_thumbnail($post->ID)) :
    ?>
        <div class="media-left mr-3">
            <?php echo hbinstrap_get_the_post_thumbnail($post->ID, 'medium'); ?>
        </div>
    <?php
        endif;
    ?>
    <div class="media-body">
        <header class="entry-header">

            <?php
            the_title(
                sprintf(
                    '<h2 class="entry-title"><a href="%s" rel="bookmark">',
                    esc_url(get_permalink())
                ),
                '</a></h2>'
            );
            ?>

            <?php if ('post' == get_post_type()) : ?>

                <div class="entry-meta">
                    <?php hbinstrap_posted_on(); ?>
                </div><!-- .entry-meta -->

            <?php endif; ?>

        </header><!-- .entry-header -->

        <div class="entry-content">

            <?php
            the_excerpt();
            ?>

            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'hbinstrap'),
                'after'  => '</div>',
            ));
            ?>

        </div><!-- .entry-content -->

    </div>

</article><!-- #post-## -->
