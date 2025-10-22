<?php
/**
 * Enhanced RSS Feed Template
 * Access via: yoursite.com/feed/custom
 * Matches Next.js functionality
 */

// Set content type
header('Content-Type: application/xml; charset=utf-8', true);

// Get latest posts
$posts = get_posts(array(
    'numberposts' => 20,
    'post_status' => 'publish',
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC'
));

// Get site info
$site_name = get_bloginfo('name');
$site_description = get_bloginfo('description');
$site_url = home_url();

// Get theme customizer options
$logo_url = get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : '';
$copyright_year = date('Y');

// Danish timezone
function get_danish_pub_date() {
    $date = new DateTime('now', new DateTimeZone('Europe/Copenhagen'));
    return $date->format('D, d M Y H:i:s O');
}

// Escape XML characters
function escape_xml($str) {
    return htmlspecialchars($str, ENT_XML1, 'UTF-8');
}

// Filter content blocks (similar to Next.js)
function filter_content_blocks($content) {
    // Remove shortcodes and unwanted content
    $content = strip_shortcodes($content);
    $content = preg_replace('/\[.*?\]/', '', $content);
    return $content;
}
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    xmlns:media="http://search.yahoo.com/mrss/"
    <?php do_action('rss2_ns'); ?>>
    
    <channel>
        <title><?php echo escape_xml($site_name); ?></title>
        <atom:link href="<?php echo esc_url($site_url); ?>/feed/custom" rel="self" type="application/rss+xml" />
        <link><?php echo esc_url($site_url); ?></link>
        <description><?php echo escape_xml($site_description); ?></description>
        <?php if ($logo_url) : ?>
        <image>
            <url><?php echo esc_url($logo_url); ?></url>
            <title><?php echo escape_xml($site_name); ?></title>
            <link><?php echo esc_url($site_url); ?></link>
        </image>
        <?php endif; ?>
        <managingEditor>admin@<?php echo parse_url($site_url, PHP_URL_HOST); ?> (<?php echo escape_xml($site_name); ?>)</managingEditor>
        <webMaster>admin@<?php echo parse_url($site_url, PHP_URL_HOST); ?> (<?php echo escape_xml($site_name); ?>)</webMaster>
        <copyright>Copyright <?php echo $copyright_year; ?>, <?php echo escape_xml($site_name); ?></copyright>
        <language>da</language>
        <lastBuildDate><?php echo get_danish_pub_date(); ?></lastBuildDate>
        <pubDate><?php echo get_danish_pub_date(); ?></pubDate>
        <ttl>60</ttl>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        
        <?php foreach ($posts as $post) : setup_postdata($post); 
            // Get post data
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $post_url = get_permalink();
            $post_content = filter_content_blocks(get_the_content());
            $post_excerpt = get_the_excerpt();
            $post_author = get_the_author();
            $post_date = get_the_date('c');
            $post_updated = get_the_modified_date('c');
            
            // Get featured image
            $featured_image = '';
            $image_width = '';
            $image_height = '';
            $image_size = 0;
            
            if (has_post_thumbnail()) {
                $featured_image = get_the_post_thumbnail_url(null, 'large');
                $image_meta = wp_get_attachment_metadata(get_post_thumbnail_id());
                if ($image_meta) {
                    $image_width = $image_meta['width'];
                    $image_height = $image_meta['height'];
                    $image_size = filesize(get_attached_file(get_post_thumbnail_id()));
                }
            }
            
            // Get categories
            $categories = get_the_category();
            $category_names = array();
            if ($categories) {
                foreach ($categories as $category) {
                    $category_names[] = $category->name;
                }
            }
            
            // Get tags
            $tags = get_the_tags();
            $tag_names = array();
            if ($tags) {
                foreach ($tags as $tag) {
                    $tag_names[] = $tag->name;
                }
            }
        ?>
        <item>
            <title><?php echo escape_xml($post_title); ?></title>
            <link><?php echo esc_url($post_url); ?></link>
            <guid isPermaLink="false"><?php echo $post_id; ?></guid>
            <description><![CDATA[<?php echo $post_excerpt; ?>]]></description>
            <content:encoded><![CDATA[<?php echo $post_content; ?>]]></content:encoded>
            <author><?php echo escape_xml($post_author); ?></author>
            <dc:creator><?php echo escape_xml($post_author); ?></dc:creator>
            <pubDate><?php echo get_danish_pub_date(); ?></pubDate>
            <updated><?php echo $post_updated; ?></updated>
            
            <?php if ($categories) : ?>
                <?php foreach ($categories as $category) : ?>
                <category><![CDATA[<?php echo escape_xml($category->name); ?>]]></category>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if ($featured_image) : ?>
            <enclosure url="<?php echo esc_url($featured_image); ?>" length="<?php echo $image_size; ?>" type="<?php echo pathinfo($featured_image, PATHINFO_EXTENSION) === 'webp' ? 'image/webp' : 'image/jpeg'; ?>" />
            
            <media:content url="<?php echo esc_url($featured_image); ?>" 
                          width="<?php echo $image_width; ?>" 
                          height="<?php echo $image_height; ?>" 
                          medium="image" 
                          type="<?php echo pathinfo($featured_image, PATHINFO_EXTENSION) === 'webp' ? 'image/webp' : 'image/jpeg'; ?>">
                <media:copyright><?php echo escape_xml($site_name); ?></media:copyright>
                <media:title><?php echo escape_xml($post_title); ?></media:title>
                <media:description type="html"><![CDATA[<?php echo $post_title; ?>]]></media:description>
                <media:credit><?php echo escape_xml($post_author); ?></media:credit>
            </media:content>
            
            <media:thumbnail url="<?php echo esc_url($featured_image); ?>" 
                           width="<?php echo $image_width; ?>" 
                           height="<?php echo $image_height; ?>" />
            <?php endif; ?>
            
            <?php do_action('rss2_item'); ?>
        </item>
        <?php endforeach; wp_reset_postdata(); ?>
    </channel>
</rss>