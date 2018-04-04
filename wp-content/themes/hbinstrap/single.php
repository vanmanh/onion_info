<?php
/**
 * The template for displaying all single posts.
 *
 * @package hbinstrap
 */

get_header();
$container   = hbinstrap_get_theme_options('container_type');
$sidebar_pos = hbinstrap_get_theme_options('posts_sidebar_position');
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php get_template_part('global-templates/posts-left-sidebar-check'); ?>

            <main class="site-main" id="main">

                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('loop-templates/content', 'single'); ?>

                        <?php hbinstrap_post_nav(); ?>

                    <?php
                    $post_option = hbinstrap_get_post_options();
                    if (!empty($post_option['is_display_social_share_button'])) {
                        echo hbinstrap_social_share_buttons(get_permalink());
                    }
                    if (comments_open() || get_comments_number()) :
                        if (!empty($post_option['is_display_wordpress_comment'])) {
                            comments_template();
                        }
                        if (!empty($post_option['is_display_facebook_comment'])) {
                            echo hbinstrap_facebook_comment_box(get_permalink());
                        }
                    endif;
                    ?>

                <?php endwhile; // end of the loop.?>

                <?php get_template_part('global-templates/related-posts'); ?>

            </main><!-- #main -->

        </div><!-- #primary -->

        <!-- Do the right sidebar check -->
        <?php if ('right' === $sidebar_pos || 'both' === $sidebar_pos) : ?>

            <?php get_sidebar('right'); ?>

        <?php endif; ?>

    </div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
