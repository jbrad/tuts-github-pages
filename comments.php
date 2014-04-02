<?php if ( post_password_required() ) { ?>
    <div class="comments">
        <h3 class="page-header"><?php _e( 'This post is password protected. Enter the password to view comments.', TRANSLATION_KEY ); ?></h3>
    </div><!-- #comments -->
    <?php return; ?>
<?php } // end if	?>

<?php if ( have_comments() ) { ?>

    <?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
        <div class="comments">
            <h3 class="page-header"><?php _e('Comments:', TRANSLATION_KEY ); ?></h3>
            <ol class="media-list">
                <?php wp_list_comments( 'avatar_size=50&callback=custom_comment&type=comment' ); ?>
            </ol>
            <ul class="pager">
                <li>
                    <?php previous_comments_link( '<span class="fa fa-chevron-left"></span>' . __( 'Previous Comments', TRANSLATION_KEY ) ); ?>
                </li>
                <li>
                    <?php next_comments_link( __( 'Next Comments', TRANSLATION_KEY ) . '<span class="fa fa-chevron-right"></span>'); ?>
                </li>
            </ul>
        </div><!-- /#comments -->
    <?php } // end if ?>

    <?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>
        <div class="comments">
            <h3 class="page-header"><?php _e('Trackbacks and Pingbacks:', TRANSLATION_KEY ); ?></h3>
            <ol class="list-unstyled">
                <?php wp_list_comments( 'type=pings&callback=list_pings&per_page=-1' ); ?>
            </ol>
        </div><!-- /#pings -->
    <?php } // end if ?>

<?php } else { ?>

    <?php if( comments_open() ) { ?>
        <div class="comments">
            <h3 class="page-header"><?php _e( 'No Comments', TRANSLATION_KEY ); ?></h3>
            <p><?php _e( 'Everyone has an opinion. What\'s yours?', TRANSLATION_KEY ); ?></p>
        </div><!-- /#no-comments -->
    <?php } // end if ?>

<?php } // end if ?>

<?php theme_comment_form(); ?>