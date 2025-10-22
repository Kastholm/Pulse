<?php
/**
 * Sitemap Index - Main sitemap index
 * Access via: yoursite.com/sitemap.xml
 */

// Set content type
header('Content-Type: application/xml; charset=utf-8', true);

// Get site info
$site_url = home_url();
$current_date = date('c');

// Calculate how many post sitemaps we need (1000 posts per sitemap)
$total_posts = wp_count_posts('post')->publish;
$posts_per_sitemap = 1000;
$total_post_sitemaps = ceil($total_posts / $posts_per_sitemap);
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <!-- Post Sitemaps (Paginated) -->
    <?php for ($i = 1; $i <= $total_post_sitemaps; $i++) : ?>
    <sitemap>
        <loc><?php echo esc_url($site_url); ?>/post-sitemap<?php echo $i; ?>.xml</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
    </sitemap>
    <?php endfor; ?>
    
    <!-- Page Sitemap -->
    <sitemap>
        <loc><?php echo esc_url($site_url); ?>/page-sitemap.xml</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
    </sitemap>
    
    <!-- Category Sitemap -->
    <sitemap>
        <loc><?php echo esc_url($site_url); ?>/category-sitemap.xml</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
    </sitemap>
    
    <!-- Tags Sitemap -->
    <sitemap>
        <loc><?php echo esc_url($site_url); ?>/tags-sitemap.xml</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
    </sitemap>
    
    <!-- Author Sitemap -->
    <sitemap>
        <loc><?php echo esc_url($site_url); ?>/author-sitemap.xml</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
    </sitemap>
    
</sitemapindex>
