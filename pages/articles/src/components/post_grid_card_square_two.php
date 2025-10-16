<?php
// WordPress data
$thumbnail = get_post_thumbnail_id(get_the_ID());
$image_small = get_the_post_thumbnail_url(get_the_ID(), 'large');
$image_medium = get_the_post_thumbnail_url(get_the_ID(), 'large');
$title = get_the_title();
$url = get_the_permalink();

// Get categories
$categories = get_the_category();
if (!empty($categories)) {
	$primary_category = $categories[0]->name;
	$category_permalink = get_category_link($categories[0]->term_id);
} else {
	$primary_category = 'Nyheder';
	$category_permalink = '#';
}

// Get post date
$post_date = get_the_date('c');
$post_date_formatted = get_the_date('Y-m-d\TH:i:s.v\Z');

// Get author info
$author_id = get_the_author_meta('ID');
$author_name = get_the_author();
$author_url = get_author_posts_url($author_id);
$author_avatar = get_avatar_url($author_id, array('size' => 40));

// Parse arguments
$args = wp_parse_args($args, array('style' => ''));
?>

<article class="grid place-content-start bg-white gap-2 border-b-slate-100 dark:border-b-slate-600 border-b-[1px] pb-2 grid-cols-[auto]">
	<figure class="relative max-w-none block rounded-t-sm overflow-clip md:h-[10em] h-[14em]">
		<a aria-label="Læs mere om artiklen" href="<?php echo esc_url($url); ?>">
			<?php if (has_post_thumbnail()) : ?>
				<?php the_post_thumbnail('large', array(
					'class' => 'block rounded-sm inset-0 bg-gray-300 max-h-[300px] w-full max-w-none object-cover',
					'alt' => esc_attr($title),
					'loading' => 'lazy',
					'width' => '600',
					'height' => '300',
					'decoding' => 'async',
					'style' => 'color: transparent;'
				)); ?>
			<?php else : ?>
				<div class="block rounded-sm inset-0 bg-gray-300 max-h-[300px] w-full max-w-none object-cover flex items-center justify-center">
					<span class="text-gray-400 dark:text-gray-500 text-sm">Ingen billede</span>
				</div>
			<?php endif; ?>
		</a>
	</figure>
	
	<div class="px-4">
		<aside class="flex flex-col md:flex-row items-start md:items-center gap-y-2 md:gap-y-0 gap-x-4 text-xs">
			<time datetime="<?php echo esc_attr($post_date); ?>" class="text-gray-500 hidden md:inline-block">
				<span class="timeSpan flex gap-2 text-fade_color_light dark:text-fade_color_dark">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock my-auto text-fade_color_light dark:text-fade_color_dark">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 6 12 12 16 14"></polyline>
					</svg>
					<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' siden'; ?>
				</span>
			</time>
			
			<a class="relative rounded-full bg-gray-200 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-200" href="<?php echo esc_url($category_permalink); ?>">
				<?php echo esc_html($primary_category); ?>
			</a>
		</aside>
		
		<header class="group max-w-xl min-h-[6em] overflow-clip">
			<a href="<?php echo esc_url($url); ?>">
				<h2 class="mt-2 text-lg md:text-lg font-bold leading-6 dark:group-hover:text-gray-300 group-hover:text-gray-600">
					<?php echo esc_html($title); ?>
				</h2>
			</a>
			
			<?php if (has_excerpt()) : ?>
				<h3 class="mt-2 text-sm md:text-md leading-6 text-text_second_color_dark dark:text-text_second_color_light hidden md:block">
					<?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
				</h3>
			<?php endif; ?>
		</header>
	</div>
</article>


