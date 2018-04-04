<?php
/**
 *
 * @package hbinstrap
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="entry-content row mt-3">

        <div class="col-lg-6 text-sm-center text-xs-center">
            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title(); ?>">
                <?php echo hbinstrap_get_the_post_thumbnail($post->ID, 'large'); ?>
            </a>
        </div>

        <div class="col-lg-6">
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
                <?php the_excerpt(); ?>
            </header><!-- .entry-header -->
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
