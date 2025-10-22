<?php
/**
 * Main Sitemap - Static Pages
 * Access via: yoursite.com/sitemap/
 */

// Set content type
header('Content-Type: application/xml; charset=utf-8', true);

// Get site info
$site_url = home_url();
$current_date = date('c');

// Static pages configuration
$static_pages = array(
    array(
        'url' => $site_url,
        'lastmod' => $current_date,
        'changefreq' => 'daily',
        'priority' => '1.0'
    ),
    array(
        'url' => $site_url . '/kategorier',
        'lastmod' => $current_date,
        'changefreq' => 'daily',
        'priority' => '0.5'
    ),
    array(
        'url' => $site_url . '/tags',
        'lastmod' => $current_date,
        'changefreq' => 'daily',
        'priority' => '0.5'
    ),
    array(
        'url' => $site_url . '/journalister',
        'lastmod' => $current_date,
        'changefreq' => 'daily',
        'priority' => '0.5'
    ),
    array(
        'url' => $site_url . '/cookies',
        'lastmod' => $current_date,
        'changefreq' => 'yearly',
        'priority' => '0.5'
    ),
    array(
        'url' => $site_url . '/om-os',
        'lastmod' => $current_date,
        'changefreq' => 'yearly',
        'priority' => '0.5'
    ),
    array(
        'url' => $site_url . '/kontakt',
        'lastmod' => $current_date,
        'changefreq' => 'yearly',
        'priority' => '0.5'
    ),
    array(
        'url' => $site_url . '/privatlivspolitik',
        'lastmod' => $current_date,
        'changefreq' => 'yearly',
        'priority' => '0.5'
    ),
    array(
        'url' => $site_url . '/find-artikel',
        'lastmod' => $current_date,
        'changefreq' => 'yearly',
        'priority' => '0.5'
    )
);

// Get WordPress pages
$pages = get_posts(array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'numberposts' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
));

// Get WordPress posts
$posts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => 100, // Limit for performance
    'orderby' => 'date',
    'order' => 'DESC'
));

// Get categories
$categories = get_categories(array(
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));

// Get tags
$tags = get_tags(array(
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <!-- Static Pages -->
    <?php foreach ($static_pages as $page) : ?>
    <url>
        <loc><?php echo esc_url($page['url']); ?></loc>
        <lastmod><?php echo $page['lastmod']; ?></lastmod>
        <changefreq><?php echo $page['changefreq']; ?></changefreq>
        <priority><?php echo $page['priority']; ?></priority>
    </url>
    <?php endforeach; ?>
    
    <!-- WordPress Pages -->
    <?php foreach ($pages as $page) : ?>
    <url>
        <loc><?php echo esc_url(get_permalink($page->ID)); ?></loc>
        <lastmod><?php echo get_the_modified_date('c', $page->ID); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    
    <!-- WordPress Posts -->
    <?php foreach ($posts as $post) : ?>
    <url>
        <loc><?php echo esc_url(get_permalink($post->ID)); ?></loc>
        <lastmod><?php echo get_the_modified_date('c', $post->ID); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <?php endforeach; ?>
    
    <!-- Categories -->
    <?php foreach ($categories as $category) : ?>
    <url>
        <loc><?php echo esc_url(get_category_link($category->term_id)); ?></loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <?php endforeach; ?>
    
    <!-- Tags -->
    <?php foreach ($tags as $tag) : ?>
    <url>
        <loc><?php echo esc_url(get_tag_link($tag->term_id)); ?></loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>
