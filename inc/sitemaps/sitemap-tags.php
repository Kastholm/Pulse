<?php
/**
 * Tags Sitemap
 * Access via: yoursite.com/sitemap-tags/
 */

// Set content type
header('Content-Type: application/xml; charset=utf-8', true);

// Get all tags
$tags = get_tags(array(
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <?php foreach ($tags as $tag) : ?>
    <url>
        <loc><?php echo esc_url(get_tag_link($tag->term_id)); ?></loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>
