<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package hbinstrap
 */

get_header();

$container   = hbinstrap_get_theme_options('container_type');
$sidebar_pos = hbinstrap_get_theme_options('sidebar_position');
$homeCatsDisplay = hbinstrap_get_theme_options('homepage_cats_options');

$hasHomeCategorySetting = false;
if (is_array($homeCatsDisplay)) {
    foreach ($homeCatsDisplay as $cat) {
        if (!empty($cat['catid'])) {
            $hasHomeCategorySetting = true;
            break;
        }
    }
}

?>

<?php if (is_front_page() && is_home()) : ?>
    <?php get_template_part('global-templates/hero'); ?>
<?php endif; ?>

<div class="wrapper" id="wrapper-index">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">
            <!-- Do the left sidebar check and opens the primary div -->
            <?php get_template_part('global-templates/left-sidebar-check'); ?>

            <main class="site-main" id="main">
                <?php if ($hasHomeCategorySetting) : ?>
                    <?php foreach ($homeCatsDisplay as $cat): ?>
                        <?php
                            $numof_display = empty($cat['numof_display']) ? HBINSTRAP_DEFAULT_NUMOF_DISPLAY_HOME_CAT : $cat['numof_display'];
                            $catOpts = array(
                                'category' => $cat['catid'],
                                'numberposts' => $numof_display,
                            );
                            $displayStyle = $cat['display_style'];

                            $postslist = get_posts($catOpts);
                            $catName = get_the_category_by_ID($cat['catid']);
                            $catLink = get_category_link($cat['catid']);
                            if (empty($catLink) || !$cat['catid']) {
                                continue;
                            }
                        ?>
                        <div class="clearfix site-main__each-block-cat">
                            <h3 class="site-main__each-block-cat__header">
                                <a href="<?php echo esc_url($catLink); ?>"><?php echo esc_html($catName); ?></a>
                            </h3>
                            <div class="row">
                                <?php
                                if ($postslist) :
                                    // Case HBINSTRAP_HOME_CAT_DISPLAY_LARGE_ABOVE
                                    if ($displayStyle == HBINSTRAP_HOME_CAT_DISPLAY_LARGE_ABOVE):

                                        $post = $postslist[0];
                                        setup_postdata($post);

                                        echo '<div class="large-items col-12">';
                                            get_template_part('loop-templates/content', 'medium-image');
                                        echo '</div>';
                                        wp_reset_postdata();

                                        unset($postslist[0]);
                                        // From seconds posts
                                        if ($postslist):
                                            echo '<div class="small-items col-12 row mt-3">';

                                            foreach ($postslist as $i => $post) :
                                                echo '<div class="col-lg-6">';
                                                setup_postdata($post);
                                                get_template_part('loop-templates/content', 'small-image');
                                                wp_reset_postdata();
                                                echo '</div>';
                                            endforeach;

                                            echo '</div>';
                                        endif;

                                    // Case HBINSTRAP_HOME_CAT_DISPLAY_LARGE_LEFT
                                    elseif ($displayStyle == HBINSTRAP_HOME_CAT_DISPLAY_LARGE_LEFT):

                                        $post = $postslist[0];
                                        setup_postdata($post);

                                        echo '<div class="col-lg-6">';
                                            get_template_part('loop-templates/content', 'medium-image-card');
                                        echo '</div>';
                                        wp_reset_postdata();

                                        unset($postslist[0]);
                                        // From seconds posts
                                        if ($postslist):
                                            echo '<div class="col-lg-6">';
                                            foreach ($postslist as $i => $post) :
                                                setup_postdata($post);
                                                get_template_part('loop-templates/content', 'small-image');
                                                wp_reset_postdata();
                                            endforeach;
                                            echo '</div>';
                                        endif;
                                    // Case HBINSTRAP_HOME_CAT_DISPLAY_LARGE_RIGHT
                                    elseif ($displayStyle == HBINSTRAP_HOME_CAT_DISPLAY_LARGE_RIGHT):

                                        $postFirst = $postslist[0];

                                        unset($postslist[0]);
                                        // From seconds posts
                                        if ($postslist):
                                            echo '<div class="col-lg-6">';
                                            foreach ($postslist as $i => $post) :
                                                setup_postdata($post);
                                                get_template_part('loop-templates/content', 'small-image');
                                                wp_reset_postdata();
                                            endforeach;
                                            echo '</div>';
                                        endif;

                                        $post = $postFirst;
                                        setup_postdata($post);

                                        echo '<div class="col-lg-6">';
                                            get_template_part('loop-templates/content', 'medium-image-card');
                                        echo '</div>';
                                        wp_reset_postdata();

                                    // Case HBINSTRAP_HOME_CAT_DISPLAY_ALL_LARGE_2_COLS
                                    elseif ($displayStyle == HBINSTRAP_HOME_CAT_DISPLAY_ALL_LARGE_2_COLS):

                                        // From seconds posts
                                        if ($postslist):
                                            foreach ($postslist as $i => $post) :
                                                echo '<div class="col-lg-6">';
                                                setup_postdata($post);
                                                get_template_part('loop-templates/content', 'medium-image-card');
                                                wp_reset_postdata();
                                                echo '</div>';
                                            endforeach;
                                        endif;
                                    // Case HBINSTRAP_HOME_CAT_DISPLAY_2_LARGE_ABOVE_2_COLS
                                    elseif ($displayStyle == HBINSTRAP_HOME_CAT_DISPLAY_2_LARGE_ABOVE_2_COLS):
                                        echo '<div class="row col-md-12">';
                                        if (!empty($postslist[0])) {
                                            $post = $postslist[0];
                                            setup_postdata($post);

                                            echo '<div class="col-lg-6">';
                                            get_template_part('loop-templates/content', 'medium-image-card');
                                            echo '</div>';
                                            wp_reset_postdata();
                                            unset($postslist[0]);
                                        }
                                        if (!empty($postslist[1])) {
                                            $post = $postslist[1];
                                            setup_postdata($post);

                                            echo '<div class="col-lg-6">';
                                            get_template_part('loop-templates/content', 'medium-image-card');
                                            echo '</div>';
                                            wp_reset_postdata();

                                            unset($postslist[1]);
                                        }

                                        // From seconds posts
                                        if ($postslist):
                                            foreach ($postslist as $i => $post) :
                                                echo '<div class="col-lg-6">';
                                                setup_postdata($post);
                                                get_template_part('loop-templates/content', 'small-image');
                                                wp_reset_postdata();
                                                echo '</div>';
                                            endforeach;
                                        endif;
                                    // Case HBINSTRAP_HOME_CAT_DISPLAY_ALL_LARGE_1_COL
                                    elseif ($displayStyle == HBINSTRAP_HOME_CAT_DISPLAY_ALL_LARGE_1_COL):

                                        // From seconds posts
                                        if ($postslist):
                                            foreach ($postslist as $i => $post) :
                                                setup_postdata($post);
                                                get_template_part('loop-templates/content', 'medium-image');
                                                wp_reset_postdata();
                                            endforeach;
                                        endif;

                                     // Case HBINSTRAP_HOME_CAT_DISPLAY_ALL_SMALL
                                    elseif ($displayStyle == HBINSTRAP_HOME_CAT_DISPLAY_ALL_SMALL):

                                        // From seconds posts
                                        if ($postslist):
                                            foreach ($postslist as $i => $post) :
                                                setup_postdata($post);
                                                echo '<div class="col-lg-6">';
                                                get_template_part('loop-templates/content', 'small-image');
                                                echo '</div>';
                                                wp_reset_postdata();
                                            endforeach;
                                        endif;

                                    endif;


                                endif;
                                ?>
                            </div><!-- /row-->
                        </div>
                    <?php endforeach; ?>
                <?php else: // No homepage setting cats?>
                    <?php if (have_posts()) : ?>

                        <?php /* Start the Loop */ ?>

                        <?php while (have_posts()) : the_post(); ?>

                            <?php

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('loop-templates/content', get_post_format());
                            ?>

                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php get_template_part('loop-templates/content', 'none'); ?>

                    <?php endif; ?>
                <?php endif; ?>

            </main><!-- #main -->

            <!-- The pagination component -->
            <?php if (!$hasHomeCategorySetting) {
                                hbinstrap_pagination();
                            } ?>

        </div><!-- #primary -->

        <!-- Do the right sidebar check -->
        <?php if ('right' === $sidebar_pos || 'both' === $sidebar_pos) : ?>

            <?php get_sidebar('right'); ?>

        <?php endif; ?>
        </div><!--row-->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
