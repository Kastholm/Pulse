<?php
/**
 * Categories Sitemap
 * Access via: yoursite.com/sitemap-categories/
 */

// Set content type
header('Content-Type: application/xml; charset=utf-8', true);

// Get all categories
$categories = get_categories(array(
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <?php foreach ($categories as $category) : ?>
    <url>
        <loc><?php echo esc_url(get_category_link($category->term_id)); ?></loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>
