<!DOCTYPE html>
<!--[if IE 8 ]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <title><?php wp_title( '' ); ?></title>
    <?php global $post; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="masthead" class="blog-masthead">
    <div class="container">
        <?php
            $defaults = array(
                'theme_location'  => 'main_menu',
                'menu_class'      => 'blog-nav',
                'container'       => false,
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'items_wrap'      => '<nav class="blog-nav">%3$s</nav>',
                'depth'           => 0
            );

            wp_nav_menu( $defaults );
        ?>
    </div>
</header> <!-- /header -->

<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                <?php bloginfo( 'name' ); ?>
            </a>
        </h1>
        <p class="lead blog-description"><?php bloginfo( 'description' ); ?></p>
    </div> <!-- /.blog-header -->