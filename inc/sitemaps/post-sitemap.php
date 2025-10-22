<?php
/**
 * Paginated Posts Sitemap
 * Access via: yoursite.com/post-sitemap1.xml, post-sitemap2.xml, etc.
 */

// Set content type
header('Content-Type: application/xml; charset=utf-8', true);

// Get pagination info
$sitemap_page = get_query_var('sitemap_page') ?: 1;
$posts_per_sitemap = 1000;
$offset = ($sitemap_page - 1) * $posts_per_sitemap;

// Get posts for this page
$posts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => $posts_per_sitemap,
    'offset' => $offset,
    'orderby' => 'date',
    'order' => 'DESC'
));
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <?php foreach ($posts as $post) : ?>
    <url>
        <loc><?php echo esc_url(get_permalink($post->ID)); ?></loc>
        <lastmod><?php echo get_the_modified_date('c', $post->ID); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>
