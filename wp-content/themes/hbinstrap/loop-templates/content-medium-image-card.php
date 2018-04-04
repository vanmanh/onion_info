<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package hbinstrap
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="entry-content card">

        <div class="card-img-top text-sm-center text-xs-center">
            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title(); ?>">
                <?php echo hbinstrap_get_the_post_thumbnail($post->ID, 'large'); ?>
            </a>
        </div>

        <div class="card-block mt-3">
            <header class="entry-header">

                <?php
                    the_title(
                        sprintf(
                            '<h5 class="entry-title"><a href="%s" rel="bookmark">',
                            esc_url(get_permalink())
                        ),
                        '</a></h5>'
                    );
                ?>
            </header><!-- .entry-header -->
            <?php the_excerpt(); ?>
            <?php if ('post' == get_post_type()) : ?>

                <div class="entry-meta">
                    <?php hbinstrap_posted_on(); ?>
                </div><!-- .entry-meta -->

            <?php endif; ?>

            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'hbinstrap'),
                'after'  => '</div>',
            ));
            ?>
        </div>

    </div><!-- .entry-content -->

</article><!-- #post-## -->
