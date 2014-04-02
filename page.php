<?php get_header(); ?>
<div class="row">

    <section class="col-sm-8 blog-main">

        <?php if ( have_posts() ) { ?>
            <?php while ( have_posts() ) { ?>
                <?php the_post(); ?>
                <?php get_template_part( 'loop', get_post_format() ); ?>

                <?php get_template_part( 'pagination '); ?>

                <?php comments_template( '', true ); ?>

            <?php } // end while ?>

        <?php } // end if ?>

    </section><!-- /.blog-main -->

    <?php get_sidebar(); ?>

</div><!-- /.row -->
<?php get_footer(); ?>
