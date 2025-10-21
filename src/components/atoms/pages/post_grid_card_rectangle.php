<?php
// WordPress data
$thumbnail = get_post_thumbnail_id(get_the_ID());
$image_small = get_the_post_thumbnail_url(get_the_ID(), 'medium');
$image_medium = get_the_post_thumbnail_url(get_the_ID(), 'medium');
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

// Parse arguments
$args = wp_parse_args($args, array('style' => ''));
?>

<article class="grid bg-white place-content-start gap-4 md:gap-8 mb-6 grid-cols-[auto_auto]">
<figure class="relative max-w-[100px] md:max-w-none">
		<a aria-label="Læs mere om artiklen" href="<?php echo esc_url($url); ?>">

			<?php if (has_post_thumbnail()) : ?>
				<img alt="<?php echo esc_attr($title); ?>" loading="lazy" width="150" height="150" decoding="async" data-nimg="1" 
				class="block rounded-lg inset-0 bg-gray-300 min-h-[120px] h-full object-cover" sizes="(max-width: 768px) 100vw, 1000px" 
				style="color: transparent; max-width: 120px;" src="<?php echo esc_url($image_medium); ?>">
			<?php else : ?>
				<div class="block rounded-lg inset-0 bg-gray-300 max-h-[120px] md:max-w-[120px] object-cover items-center justify-center">
					<span class="text-gray-400 dark:text-gray-500 text-xs">Intet billede</span>
				</div>
			<?php endif; ?>
		</a>
	</figure>
	
	<div>
		<aside class="flex flex-col md:flex-row items-start md:items-center gap-y-2 md:gap-y-0 gap-x-4 text-xs pt-2">
			<time datetime="<?php echo esc_attr($post_date); ?>" class="text-gray-500 hidden md:inline-block">
				<span class="timeSpan flex gap-2 text-fade_color_light dark:text-fade_color_dark">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock my-auto text-fade_color_light dark:text-fade_color_dark">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 6 12 12 16 14"></polyline>
					</svg>
					<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' siden'; ?>
				</span>
			</time>
			
			<a class="categoryTag" href="<?php echo esc_url($category_permalink); ?>">
				<?php echo esc_html($primary_category); ?>
			</a>
		</aside>
		
		<header class="group max-w-xl min-h-[5em] overflow-clip">
			<a href="<?php echo esc_url($url); ?>">
			<h1 class="mt-2 text-md md:text-md font-bold leading-6 dark:group-hover:text-gray-300 group-hover:text-gray-600">
					<?php echo esc_html($title); ?>
				</h1>
			</a>
			
			<?php if (has_excerpt()) : ?>
				<h2 class="mt-2 text-xs md:text-sm leading-6 text-text_second_color_dark dark:text-text_second_color_light hidden md:block">
					<?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
				</h2>
			<?php endif; ?>
		</header>
	</div>
</article>


