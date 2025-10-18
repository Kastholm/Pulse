<?php
/**
 * Theme setup and assets
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'after_setup_theme', function() {

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');

	// Add support for editor styles.
  add_theme_support('wp-block-styles');
	add_theme_support('editor-styles');


	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add support for responsive embedded content.
	add_theme_support('responsive-embeds');

	// Remove core block patterns.
	remove_theme_support("core-block-patterns");

	// Remove support for block templates.
	remove_theme_support('block-templates');


	// Register menus
	register_nav_menus([
		"primary-nav" => "Primary Menu",
		"footer-nav-1" => "Footer Menu 1",
		"footer-nav-2" => "Footer Menu 2",
		// "footer-nav-3" => "Footer Menu 3",
	]);

	// Custom image size
	add_image_size('mxn-large', 1200, false); // Width: 1200px, Soft Crop
});


add_action( 'wp_enqueue_scripts', function() {
  wp_enqueue_style( 'pulse-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version') );
});

/**
 * Remove WordPress default styles
 */
add_action( 'wp_enqueue_scripts', function() {
	// Remove WordPress block library CSS
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // WooCommerce block styles
	
	// Remove classic theme styles
	wp_dequeue_style( 'classic-theme-styles' );
	
	// Remove global styles
	wp_dequeue_style( 'global-styles' );
	
	// Remove WordPress emoji styles
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	
	// Remove WordPress embed styles
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	
	// Remove WordPress generator meta tag
	remove_action( 'wp_head', 'wp_generator' );
	
	// Remove RSD link
	remove_action( 'wp_head', 'rsd_link' );
	
	// Remove wlwmanifest link
	remove_action( 'wp_head', 'wlwmanifest_link' );
	
	// Remove shortlink
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	
	// Remove REST API link
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	
	// Remove oEmbed discovery links
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}, 20 );

//Shared media library for all sites
add_filter('network-media-library/site_id', function ($site_id) {
	return 1;
});


require_once get_template_directory() . '/src/scripts/article_ads_generation.php';
require_once get_template_directory() . '/src/scripts/skyscraper_ads_generation.php';