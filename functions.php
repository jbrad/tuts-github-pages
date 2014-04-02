<?php

/**
 * Tuts Bower 1.0.0
 * Example project for tutorial on Bower for Tuts+
 *
 * @package	tuts-bower
 * @version	1.0.0
 * @since	1.0.0
 *
 */

/**
 * Imports all theme styles and dependencies required for the theme.
 *
 * @version	1.0.0
 * @since	1.0.0
 */
function add_theme_stylesheets() {

    // theme
    wp_enqueue_style( 'theme', get_stylesheet_directory_uri() . '/style.css', false, '1.0.0' );

} // end add_theme_stylesheets
add_action( 'wp_enqueue_scripts', 'add_theme_stylesheets', 999 );

/**
 * Imports the theme's javascript file. There are multiple javascript files that are
 * concatenated and minified in Gruntfile.js
 *
 * @version	1.0.0
 * @since	1.0.0
 */
function add_theme_scripts() {

    wp_enqueue_script( 'theme', get_template_directory_uri() . '/js/theme.min.js', array( 'jquery' ), '1.0.0' );

} // end add_theme_scripts
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

if( ! function_exists('add_theme_menus') ) {
    /**
     * Adds the main menu.
     *
     * This function can be overridden by child themes.
     *
     * @since	1.0.0
     * @version	1.0.0
     */
    function add_theme_menus() {

        register_nav_menus(
            array(
                'main_menu' 	=> __( 'Main Menu', 'tuts-bower' )
            )
        );

    } // end add_theme_menu
    add_action( 'init', 'add_theme_menus' );
} // end if

if( ! function_exists('add_theme_sidebars') ) {
    /**
     * Adds a widgetized sidebar.
     *
     * This function can be overridden by child themes.
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    function add_theme_sidebars() {

        // main
        register_sidebar(
            array(
                'name' 			=> __( 'Sidebar', 'tuts-bower' ),
                'id' 			=> 'sidebar-0',
                'description'	=> __( 'The primary sidebar.', 'tuts-bower' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget-title">',
                'after_title'   => '</h4>'
            )
        );

    } // end add_theme_sidebars
    add_action( 'widgets_init', 'add_theme_sidebars' );
} // end if

if( ! function_exists('custom_comment') ) {
    /**
     * Generates the comment container for each post (and page if enabled).
     *
     * @param	array $comment    The current comment being displayed.
     * @param	array $args       Array containing arguments for displaying the comment.
     * @param	int   $depth      The depth of where this comment falls in the tree.
     * @version	1.0.0
     * @since	1.0.0
     */
    function custom_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment; ?>

        <li <?php comment_class( 'media' ); ?> id="li-comment-<?php comment_ID(); ?>">

            <?php if ( "comment" == get_comment_type() ) { ?>
                <div class="media-object thumbnail pull-left">
                    <?php echo get_avatar( get_comment_author_email(), '50' ); ?>
                </div><!-- /.avatar-holder -->
            <?php } // end if ?>

            <div class="media-body"	id="comment-<?php comment_ID(); ?>">

                <div class="media-heading">
						<span class="name">
							<?php if( '' == get_comment_author_url() ) { ?>
                                <?php comment_author(); ?>
                            <?php } else { ?>
                                <a href="<?php comment_author_url(); ?>" target="_blank"><?php comment_author(); ?></a>
                            <?php } // end if/else ?>
						</span>
                    <?php if ( get_comment_type() == "comment" ) { ?>
                        <span class="date"><a href="<?php echo get_comment_link(); ?>" title="<?php esc_attr_e( 'Permalink', 'tuts-bower'); ?>"><?php printf( __( '%1$s at %2$s', '_s' ), get_comment_date( get_option( 'date_format' ) ), get_comment_time( get_option( 'time_format' ) ) ); ?></a></span>
                        <span class="edit"><?php edit_comment_link( __( 'Edit', 'tuts-bower' ), '', '' ); ?></span>
                    <?php } // end if ?>
                </div><!-- /.comment-head -->

                <?php if ( '0' == $comment->comment_approved ) { ?>
                    <span class='unapproved label warning'>
                        <?php _e( 'Your comment will appear after being approved.', 'tuts-bower' ); ?>
                    </span>
                <?php } // end if ?>

                <?php comment_text(); ?>

                <div class="reply clearfix">
                    <?php
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'depth' 		=> $depth,
                                'max_depth' 	=> $args['max_depth'],
                                'reply_text' 	=> __( 'Reply', 'tuts-bower')
                            )
                        )
                    );
                    ?>
                </div><!-- /.reply -->

            </div><!-- /.media-body -->
        </li><!-- /.media -->

    <?php } // end custom_comment
} // end if

if( ! function_exists('theme_comment_form') ) {
    /**
     * Builds and renders the custom comment form template.
     *
     * @since	1.0.0
     * @version	1.0.0
     */
    function theme_comment_form() {

        // Grab the current commenter and the required options. This is so we can mark fields as required.
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );

        // The field elements with wrappers so we can access them via CSS and JavaScript
        $fields =  array(
            'author' 	=> '<div class="col-sm-10"><div class="form-group">' . '<label for="author">' . __( 'Name', 'tuts-bower' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" class="input-lg" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
            'email'  	=> '<div class="form-group"><label for="email">' . __( 'Email', 'tuts-bower' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" class="input-lg" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
            'url'		=> '<div class="form-group"><label for="url">' . __( 'Website', 'tuts-bower' ) . '</label>' . '<input id="url" class="input-lg" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
        );

        // Now actually render the form
        comment_form(
            array(
                'title_reply'           =>  '<h3 id="reply-title" class="page-header">Leave a Reply</h3>',
                'comment_notes_before'	=>	'<div class="row"><div id="comment-form-avatar" class="col-sm-2">' . get_avatar( '', $size = '30' )  . '</div>',
                'fields'				=>	apply_filters( 'comment_form_default_fields', $fields ),
                'comment_field'         =>  '</div><div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
                'comment_notes_after' 	=>	'<p class="form-allowed-tags">' . sprintf( __( 'Text formatting is available via select <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#allowed-tags">HTML</button>. %s', 'tuts-bower' ), ' <div id="allowed-tags" class="collapse"><pre>' . allowed_tags() . '</pre>' ) . '</p></div>',
                'logged_in_as'			=>	'<div id="comment-form-avatar" class="clearfix">' . get_avatar( get_the_author_meta( 'user_email', wp_get_current_user()->ID ), $size = '50' )  . '</p><p id="logged-in-container">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ), wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>'
            )
        );

    } // end theme_comment_form
} // end if

if( ! function_exists('search_form') ) {

    /**
     * Renders a simplified version of the search form.
     *
     * @return	string The search form.
     * @version 1.0.0
     * @since	1.0.0
     */
    function search_form() {

        // Get the default text for the search form
        $query = strlen( get_search_query() ) == 0 ? '' : get_search_query();

        // Render the form
        $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">';
        $form .= '<input placeholder="' . __( 'Search...', 'tuts-bower' ) . '" type="text" value="' . $query . '" name="s" id="s" class="form-control input-lg"/>';
        $form .= '</form>';

        return $form;

    } // end search_form
    add_filter( 'get_search_form', 'search_form' );

} // end if

/**
 * Determines whether or not the user is viewing a date archive.
 *
 * @return	True if the current page is for a date archive.
 * @since	1.0.0
 * @version	1.0.0
 */
function is_date_archive() {
    return '' != get_query_var( 'year' ) || '' != get_query_var( 'monthnum' ) || '' != get_query_var( 'day' ) || '' != get_query_var( 'm' );
} // end is_date_archive

/**
 * Generates a label for the current archive based on whether or not the user is viewing year, month, or day. Uses the
 * users date format to properly format the date.
 *
 * @return	string The label for the current archive
 * @since	1.0.0
 * @version	1.0.0
 */
function get_date_archive_label() {

    $archive_label = '';

    if( '' != get_query_var( 'day' ) ) {

        $archive_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, get_query_var( 'monthnum' ), get_query_var( 'day' ), get_query_var( 'year' ) ) );

    } elseif( '' != get_query_var( 'monthnum' ) ) {

        // This particular format is not localized. The 'date_format' uses month and year and we only need month and year.
        // The archives widget built into WordPress follows the format that we're providing see.
        // Lines 938 - 939 of general-template.php in WordPress core.
        $archive_label .= get_the_time( 'F Y' );

    } elseif ( '' != get_query_var( 'm' ) ) {

        if( strlen( get_query_var( 'm' ) ) == 6 ) {

            // See comment in Lines 1602 - 1604
            $archive_label .= get_the_time( 'F Y' );

        } else {

            $year = substr( get_query_var( 'm' ), 0, 4 );
            $month = substr( get_query_var( 'm' ), 4, 2);
            $day = substr( get_query_var( 'm' ), 6, 2 );

            $archive_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, $month, $day, $year ) );

        } // end if/else

    } elseif( '' != get_query_var( 'year' ) ) {

        $archive_label .= get_query_var( 'year' );

    } // end if

    return $archive_label;

} // end get_date_archive_label

/**
 * Determines whether or not the user is using pretty permalinks.
 *
 * @return	boolean True if pretty permalinks are enabled; false, otherwise.
 * @since	1.0.0
 * @version	1.0.0
 */
function is_using_pretty_permalinks() {

    global $wp_rewrite;
    return '/%postname%/' == $wp_rewrite->permalink_structure;

} // end is_using_pretty_premalinks