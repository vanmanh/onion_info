<?php
/**
 *
 * @package hbinstrap
 */

?>

<?php if (is_active_sidebar('owl')) : ?>

        <div id="carouselHeroControls" class="owl-carousel owl-theme container">

            <?php dynamic_sidebar('owl'); ?>

        </div><!-- .carousel -->

    <script>
        $(function() {
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin: 30,
                items : 1,
                responsiveClass: true,
                responsive : {
                    480 : { items : 1  },
                    768 : { items : 2  },
                    1024 : { items : 3
                    }
                },
            });
        });
    </script>

<?php endif; ?>
