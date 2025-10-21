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

<article class="!bg-[var(--accent-color-light)] dark:!bg-[var(--accent-color-dark)] p-4 rounded-sm shadow-sm hover:shadow-md transition-shadow">
	<a aria-label="Læs mere om artiklen" href="<?php echo esc_url($url); ?>">
		<header class="flex items-center gap-x-2 text-xs mb-2">
			<span class="uppercase font-semibold text-[var(--second-color-light)] dark:text-[var(--second-color-dark)]">
				<?php echo esc_html($primary_category); ?>
			</span>
			<span class="text-[var(--third-color-light)] dark:text-[var(--third-color-dark)]">•</span>
			<time datetime="<?php echo esc_attr($post_date_c); ?>" class="text-[var(--third-color-light)] dark:text-[var(--third-color-dark)]">
				<?php echo esc_html($post_time); ?>
			</time>
		</header>
		<h2 class="text-lg md:text-2xl font-bold text-[var(--main-color-dark)] dark:text-[var(--main-color-light)] leading-tight hover:text-[var(--accent-color-light)] dark:hover:text-[var(--accent-color-dark)] transition-colors">
			<?php echo esc_html($title); ?>
		</h2>
	</a>
</article>
