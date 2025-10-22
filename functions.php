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
		"footer-main" => "Footer Main Navigation",
		"footer-info" => "Footer Info Navigation",
	]);

	// Custom image size
	add_image_size('mxn-large', 1200, false); // Width: 1200px, Soft Crop
});


add_action( 'wp_enqueue_scripts', function() {
  // Enqueue the main compiled CSS file
  wp_enqueue_style( 'pulse-main-css', get_template_directory_uri() . '/src/stylesheets/tailwindcss/output.css', [], wp_get_theme()->get('Version') );
  
  // Also enqueue the theme's style.css for WordPress theme detection
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

add_theme_support('custom-logo', [
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
]);

require_once get_template_directory() . '/src/scripts/article_ads_generation.php';
require_once get_template_directory() . '/src/scripts/skyscraper_ads_generation.php';
require_once get_template_directory() . '/src/scripts/websail_ad_script.php';

/**
 * Custom RSS Feed
 */
add_action('init', function() {
    add_feed('custom', 'custom_rss_feed');
    
    // Sitemap routes - Standard structure with .xml extensions
    add_rewrite_rule('^sitemap\.xml$', 'index.php?sitemap=index', 'top');
    add_rewrite_rule('^post-sitemap(\d+)?\.xml$', 'index.php?sitemap=posts&sitemap_page=$matches[1]', 'top');
    add_rewrite_rule('^page-sitemap\.xml$', 'index.php?sitemap=pages', 'top');
    add_rewrite_rule('^category-sitemap\.xml$', 'index.php?sitemap=categories', 'top');
    add_rewrite_rule('^tags-sitemap\.xml$', 'index.php?sitemap=tags', 'top');
    add_rewrite_rule('^author-sitemap\.xml$', 'index.php?sitemap=authors', 'top');
});

if (!function_exists('custom_rss_feed')) {
    function custom_rss_feed() {
        get_template_part('inc/feeds/rss');
    }
}

// Sitemap handler
add_action('template_redirect', function() {
    if (isset($_GET['sitemap'])) {
        $sitemap_type = sanitize_text_field($_GET['sitemap']);
        $sitemap_page = isset($_GET['sitemap_page']) ? intval($_GET['sitemap_page']) : 1;
        
        switch ($sitemap_type) {
            case 'index':
                get_template_part('inc/sitemaps/sitemap-index');
                exit;
            case 'posts':
                // Pass page number to posts sitemap for pagination
                set_query_var('sitemap_page', $sitemap_page);
                get_template_part('inc/sitemaps/post-sitemap');
                exit;
            case 'pages':
                get_template_part('inc/sitemaps/page-sitemap');
                exit;
            case 'categories':
                get_template_part('inc/sitemaps/category-sitemap');
                exit;
            case 'tags':
                get_template_part('inc/sitemaps/tags-sitemap');
                exit;
            case 'authors':
                get_template_part('inc/sitemaps/author-sitemap');
                exit;
        }
    }
});

/**
 * RSS Feed Enhancements
 */
// Add featured image to RSS
add_action('rss2_item', function() {
    if (has_post_thumbnail()) {
        echo '<enclosure url="' . esc_url(get_the_post_thumbnail_url(null, 'large')) . '" type="image/jpeg" />';
    }
});

// Add custom fields to RSS
add_action('rss2_item', function() {
    $custom_fields = get_post_custom();
    if (!empty($custom_fields)) {
        foreach ($custom_fields as $key => $values) {
            if (strpos($key, '_') !== 0) { // Skip private fields
                foreach ($values as $value) {
                    echo '<' . esc_attr($key) . '><![CDATA[' . esc_html($value) . ']]></' . esc_attr($key) . '>';
                }
            }
        }
    }
});

// Customize RSS excerpt length
add_filter('excerpt_length', function($length) {
    if (is_feed()) {
        return 55; // Shorter for RSS
    }
    return $length;
});