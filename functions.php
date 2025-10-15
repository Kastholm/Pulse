<?php
/**
 * Theme setup and assets
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'after_setup_theme', function() {
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );

  register_nav_menus([
    'primary' => __( 'Primary Menu', 'pulse-starter' ),
    'footer'  => __( 'Footer Menu', 'pulse-starter' ),
  ]);
});

add_action( 'widgets_init', function() {
  register_sidebar([
    'name'          => __( 'Sidebar', 'pulse-starter' ),
    'id'            => 'sidebar-1',
    'before_widget' => '<section class="widget">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ]);
});

add_action( 'wp_enqueue_scripts', function() {
  wp_enqueue_style( 'pulse-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version') );
  wp_enqueue_script( 'pulse-main', get_template_directory_uri() . '/assets/js/main.js', [], wp_get_theme()->get('Version'), true );
});