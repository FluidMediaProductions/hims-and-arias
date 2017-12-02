<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hymns_and_Aries
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class('dark-layout'); ?>>
<div id="wrap">
    <!-- header -->
    <header>
        <div class="container">
            <!-- Logo -->
            <div class="logo"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" ></a> </div>
            <!-- Navigation -->
            <?php wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'container_class' => 'navbar',
                'container' => 'nav',
                'menu_class' => 'nav ownmenu',
                'depth' => 1
            ) ); ?>
        </div>
    </header>

    <!-- Content -->
    <div id="content">
