<?php
// WordPress data
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

// Get post date and time
$post_time = get_the_time('H:i');
$post_date_c = get_the_date('c');
?>

<article class="!bg-indigo-200 dark:!bg-indigo-900 p-4 rounded-sm shadow-sm hover:shadow-md transition-shadow">
	<a aria-label="Læs mere om artiklen" href="<?php echo esc_url($url); ?>">
		<header class="flex items-center gap-x-2 text-xs mb-2">
			<span class="uppercase font-semibold text-accent_color_light dark:text-accent_color_dark">
				<?php echo esc_html($primary_category); ?>
			</span>
			<span class="text-fade_color_light dark:text-fade_color_dark">•</span>
			<time datetime="<?php echo esc_attr($post_date_c); ?>" class="text-fade_color_light dark:text-fade_color_dark">
				<?php echo esc_html($post_time); ?>
			</time>
		</header>
		<h2 class="text-lg md:text-2xl font-bold text-main_color_dark dark:text-main_color_light leading-tight hover:text-accent_color_light dark:hover:text-accent_color_dark transition-colors">
			<?php echo esc_html($title); ?>
		</h2>
	</a>
</article>
