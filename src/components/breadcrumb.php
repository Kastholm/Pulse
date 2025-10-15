<?php
/**
 * WordPress Breadcrumb Component
 * Shows navigation path: Home > Category/Page > Current Item
 * Hidden on front page
 */

// Don't show breadcrumbs on front page
if (is_front_page() || is_home()) {
	return;
}

// Build breadcrumb items
$breadcrumb_items = array();

// Always start with home
$breadcrumb_items[] = array(
	'title' => 'Forside',
	'url' => home_url('/'),
	'current' => false
);

// Handle different page types
if (is_category()) {
	// Category page: Home > Category
	$category = get_queried_object();
	$breadcrumb_items[] = array(
		'title' => $category->name,
		'url' => '',
		'current' => true
	);
} elseif (is_tag()) {
	// Tag page: Home > Tag
	$tag = get_queried_object();
	$breadcrumb_items[] = array(
		'title' => $tag->name,
		'url' => '',
		'current' => true
	);
} elseif (is_single()) {
	// Single post: Home > Category > Post Title
	$categories = get_the_category();
	if (!empty($categories)) {
		$category = $categories[0];
		$breadcrumb_items[] = array(
			'title' => $category->name,
			'url' => get_category_link($category->term_id),
			'current' => false
		);
	}
	$breadcrumb_items[] = array(
		'title' => get_the_title(),
		'url' => '',
		'current' => true
	);
} elseif (is_page()) {
	// Page: Home > Page Title
	$breadcrumb_items[] = array(
		'title' => get_the_title(),
		'url' => '',
		'current' => true
	);
} elseif (is_archive()) {
	// Other archives: Home > Archive Title
	$breadcrumb_items[] = array(
		'title' => get_the_archive_title(),
		'url' => '',
		'current' => true
	);
}
?>

<nav class="flex max-w-[1000px] m-auto text-fade_color_light dark:text-fade_color_dark pb-6 rounded-lg" aria-label="Breadcrumb">
	<ol class="inline-flex items-center space-x-1 md:space-x-3">
		<?php foreach ($breadcrumb_items as $index => $item) : ?>
			<?php if ($index > 0) : ?>
				<!-- Separator -->
				<li>
					<div class="flex items-center">
						<svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
						</svg>
					</div>
				</li>
			<?php endif; ?>
			
			<li class="<?php echo $item['current'] ? 'cursor-default' : 'inline-flex items-center'; ?>" <?php echo $item['current'] ? 'aria-current="page"' : ''; ?>>
				<?php if ($item['current']) : ?>
					<!-- Current page (no link) -->
					<span class="text-accent_color_light dark:text-accent_color_dark text-sm font-medium capitalize">
						<?php echo esc_html($item['title']); ?>
					</span>
				<?php else : ?>
					<!-- Link -->
					<a class="text-sm text-fade_color_light dark:text-fade_color_dark hover:text-gray-900 dark:hover:text-gray-400 inline-flex items-center" href="<?php echo esc_url($item['url']); ?>">
						<?php if ($index === 0) : ?>
							<!-- Home icon for first item -->
							<svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
								<path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
							</svg>
						<?php endif; ?>
						<?php echo esc_html($item['title']); ?>
					</a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>