<?php get_header(); ?>
    <div class="row">

        <section class="col-sm-8 blog-main">

            <?php if ( is_archive() ) { ?>
                <div class="archive-page-title">
                    <h3 class="label label-default">
                        <?php _e( 'Archives For ', TRANSLATION_KEY ); ?>
                        <?php if( is_date_archive() ) { ?>
                            <?php echo get_date_archive_label(); ?>
                        <?php } elseif ( is_author() ) { ?>
                            <?php
                            $author_data = is_using_pretty_permalinks() ?
                                get_userdata( get_query_var( 'author' ) )  :
                                get_userdata( user_trailingslashit( get_query_var( 'author' ) ) );

                            echo ( null == $author_data ) ? get_query_var( 'author_name' ) : $author_data->display_name;
                            ?>
                        <?php } elseif ( '' == single_tag_title( '', false ) ) { ?>
                            <?php echo get_cat_name( get_query_var( 'cat' ) ); ?>
                        <?php } else { ?>
                            <?php echo single_tag_title() ?>
                        <?php } // end if/else ?>
                    </h3>
                </div>
            <?php } // end if ?>

            <?php if ( have_posts() ) { ?>

                <?php while ( have_posts() ) { ?>
                    <?php the_post(); ?>
                    <?php get_template_part( 'loop', get_post_format() ); ?>
                <?php } // end while ?>

                <?php // If infinite scroll is on, the we won't render pagination ?>
                <?php if( false == wp_script_is( 'the-neverending-homepage-css' ) ) { ?>
                    <?php get_template_part( 'pagination' ); ?>
                <?php } // end if ?>

            <?php } else { ?>

                <article id="post-0" class="post no-results not-found">
                    <header class="entry-header">
                        <h1 class="entry-title"><?php _e( 'Page or resource not found', TRANSLATION_KEY ); ?></h1>
                    </header><!-- .entry-header -->
                    <div class="entry-content">
                        <p><?php _e( 'No results were found.', TRANSLATION_KEY ); ?></p>
                        <?php get_search_form(); ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-0 -->

            <?php } // end if/else ?>

        </section><!-- /.blog-main -->

        <?php get_sidebar(); ?>

    </div><!-- /.row -->
<?php get_footer(); ?>
