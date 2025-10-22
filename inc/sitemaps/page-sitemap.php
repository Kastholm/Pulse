<?php
/**
 * Pages Sitemap
 * Access via: yoursite.com/sitemap-pages/
 */

// Set content type
header('Content-Type: application/xml; charset=utf-8', true);

// Get all published pages
$pages = get_posts(array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'numberposts' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
));
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <?php foreach ($pages as $page) : ?>
    <url>
        <loc><?php echo esc_url(get_permalink($page->ID)); ?></loc>
        <lastmod><?php echo get_the_modified_date('c', $page->ID); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>
