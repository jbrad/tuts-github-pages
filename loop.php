<article class="blog-post <?php echo is_sticky() ? 'jumbotron' : ''; ?>">
    <h1 class="blog-post-title">
        <?php if( is_single() || is_page() ) { ?>
            <?php the_title(); ?>
        <?php } else { ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
        <?php } // end if ?>
    </h1>
    <?php if ( ! is_page() ) { ?>
        <p class="blog-post-meta">
            <?php if ( ! get_the_title() ) { ?>
                <a href="<?php the_permalink()?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
            <?php } else { ?>
                <?php the_time( get_option( 'date_format' ) ); ?>
            <?php } // end if ?>
            by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a>
        </p>
    <?php } // end if ?>

    <div class="blog-content">
        <?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
            <?php the_excerpt( ); ?>
            <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', TRANSLATION_KEY ); ?></a>
        <?php } else { ?>
            <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
        <?php } // end if/else ?>
        <?php
            wp_link_pages(
                array(
                    'before'            => '<ul class="pager"><li>',
                    'after'             => '</li></ul>',
                    'separator'         => '</li><li>',
                    'next_or_number'    => 'next',
                    'previouspagelink'  => __( '&laquo; Prev Page' ),
                    'nextpagelink'      => __( 'Next Page &raquo;' ),
                )
            );
        ?>
    </div><!-- /.blog-content -->

    <?php if ( is_single() ) { ?>
        <div class="blog-post-footer">
            <?php $category_list = get_the_category_list( __( '&nbsp;', TRANSLATION_KEY ) ); ?>
            <?php if( $category_list ) { ?>
                <?php printf( __( 'In %1$s&nbsp;', TRANSLATION_KEY ), $category_list ); ?>
                <?php echo '' . $category_list; ?>
            <?php } // end if ?>
            <?php $tag_list = get_the_tag_list( __( '&nbsp;', TRANSLATION_KEY ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php echo $tag_list; ?>
            <?php } // end if ?>
        </div>
    <?php } ?>

</article><!-- /.blog-post -->