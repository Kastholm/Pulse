<?php
$image_large = get_the_post_thumbnail_url(get_the_ID(), 'large');
$image_medium = get_the_post_thumbnail_url(get_the_ID(), 'large');
$title = get_the_title();
$url = get_the_permalink();
$date = get_the_date('j. F Y');
/* $live_blog = get_field('post_is_live_blog', get_the_ID()); */

$author_name = get_the_author_meta('first_name', get_the_author_meta('ID')) . ' ' . get_the_author_meta('last_name', get_the_author_meta('ID'));
$author_image = get_avatar_url(get_the_author_meta('ID'), array('size' => 24));
$author_link = get_author_posts_url(get_the_author_meta('ID'));

// Get the post ID from query var
$post_id = get_query_var('template_post_id');

// If no post ID is provided, use current post
if (!$post_id) {
    $post_id = get_the_ID();
}

$post_date = get_the_date('c');
?>
<a href="<?php echo $url ?>" class="no-underline">
	<picture>
		<source srcset="<?php echo $image_large; ?>" media="(min-width: 768px)" />
		<img class="object-cover w-full rounded post-loop__image aspect-post"
			src="<?php echo $image_medium; ?>"
			alt="<?php the_title(); ?>"
			fetchpriority="high">
	</picture>
</a>
<div class="flex flex-col gap-xs post-loop__meta mt-xs">
	<div class="flex items-center justify-between gap-4">
		<?php /* get_template_part('/template-parts/partials/post', 'category'); */ ?>
	</div>
	<div class="flex flex-col gap-sm">
		<a href="<?php echo $url ?>" class="no-underline flex items-center gap-2">
			<?php if ($live_blog) : ?>
				<?php /* get_template_part('/template-parts/partials/live-blog-ping'); */ ?>
			<?php endif; ?>
			<h2 class="text-base post-heading"><?php echo $title ?></h2>
		</a>
		<div class="flex items-center gap-2 text-xs">
            <a class="flex items-center gap-2" href="<?php echo $author_link; ?>">
                <img class="size-6 rounded-full" src="<?php echo $author_image; ?>" alt="<?php echo $author_name; ?>">
                <?php echo $author_name; ?>
            </a>
			<span>•</span>
			<?php echo $date; ?>
			<?php if (current_time('Y-m-d') === get_the_date('Y-m-d')) : ?>
				<span>•</span>
				<span class="text-body-accent">
                    <div x-data="timeFormatter()" x-init="init()">
                        <span x-text="formattedDate" data-date="<?php echo $post_date; ?>"></span>
                    </div>
				</span>
			<?php endif; ?>
		</div>
	</div>
</div>