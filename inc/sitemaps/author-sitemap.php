<?php
/**
 * Author Sitemap
 * Access via: yoursite.com/author-sitemap.xml
 */

// Set content type
header('Content-Type: application/xml; charset=utf-8', true);

// Get all users with published posts
$authors = get_users(array(
    'who' => 'authors',
    'has_published_posts' => true,
    'orderby' => 'display_name',
    'order' => 'ASC'
));
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <?php foreach ($authors as $author) : ?>
    <url>
        <loc><?php echo esc_url(get_author_posts_url($author->ID)); ?></loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>
