<?php get_header(); ?>
    <div class="row">

        <section class="col-sm-8 blog-main">

            <?php if ( have_posts() ) { ?>
                <?php while ( have_posts() ) { ?>
                    <?php the_post(); ?>
                    <?php get_template_part( 'loop', get_post_format() ); ?>
                    <?php comments_template( '', true ); ?>

                    <ul class="pager">
                        <li>
                            <?php previous_post_link( '%link', '&larr; Prev Post' ); ?>
                        </li>
                        <li>
                            <?php next_post_link( '%link', 'Next Post &rarr;' ); ?>
                        </li>
                    </ul>

                <?php } // end while ?>

            <?php } // end if ?>

        </section><!-- /.blog-main -->

        <?php get_sidebar(); ?>

    </div><!-- /.row -->
<?php get_footer(); ?>
