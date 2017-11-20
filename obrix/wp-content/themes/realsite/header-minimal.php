<!DOCTYPE html>
<html <?php language_attributes() ?> data-ng-app="realia">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="page-wrapper">
    <div id="header" class="header header-standard">
        <div class="container">
            <div class="header-inner header-variant-standard">
                <div class="header-main">
                    <div class="navbar-toggle">
                        <i class="fa fa-bars"></i>
                    </div>

                    <div class="header-title">
                        <a href="<?php echo site_url(); ?>" title="<?php echo __( 'Home', 'realia' ); ?>">
                            <?php if ( get_theme_mod( 'realsite_general_logo' ) ) : ?>
                                <img src="<?php echo get_theme_mod( 'realsite_general_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            <?php endif; ?>

                            <span><?php bloginfo( 'name' ); ?></span>
                        </a>
                    </div><!-- /.header-title -->

                    <div class="header-navigation-wrapper">
                        <div class="header-main-title">
                            <?php bloginfo( 'name' ); ?>
                        </div><!-- /.header-main-title -->

                        <div class="header-navigation">
                            <?php $menu = wp_nav_menu( array(
                                'fallback_cb'		=> '',
                                'theme_location'    => 'main',
                                'container_class'	=> 'primary-menu-container',
                                'menu_class'        => 'nav nav-pills',
                                'walker'            => new Aviators_Menu(),
                            ) ); ?>
                        </div><!-- /.header-navigation -->
                    </div><!-- /.header-navigation-wrapper -->
                </div><!-- /.header-main -->

                <?php if ( get_theme_mod( 'realsite_general_action' ) ) : ?>
                    <a class="header-action" href="<?php echo get_permalink( get_theme_mod( 'realsite_general_action' ) ); ?>">
                        <?php $text = get_theme_mod( 'realsite_general_action_text', 'fa-plus' ); ?>
                        <?php $icon = ! empty( $text ) ? $text : 'fa-plus'; ?>
                        <i class="fa <?php echo esc_attr( $icon ); ?>"></i>
                    </a><!-- /.header-action -->
                <?php endif; ?>
            </div><!-- /.header-inner -->
        </div><!-- /.container -->
    </div><!-- /.header-->

    <div class="main">
        <div class="container">
            <?php get_template_part( 'templates/messages' ); ?>