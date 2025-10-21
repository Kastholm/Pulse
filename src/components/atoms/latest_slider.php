<?php
/**
 * Latest News Slider Component
 * Shows latest posts in horizontal scrollable format
 * Only displays on front page, categories, and tags
 */

// Only show on specific page types
if (!is_front_page() && !is_home() /* && !is_category() && !is_tag() */) {
	return;
}

// Query for latest posts
$latest_posts_query = new WP_Query(array(
	'post_type' => 'post',
	'posts_per_page' => 12, // Show up to 12 posts for horizontal scroll
	'ignore_sticky_posts' => true,
	'orderby' => 'date',
	'order' => 'DESC'
));
?>

<section class="max-w-[1000px] mx-auto pt-4 md:pt-6">
	<!-- Header -->
	<div class="flex items-center gap-2 mb-3">
		<h2 class="text-sm md:text-base font-medium text-muted-foreground">Seneste nyt</h2>
		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground">
			<path d="m9 18 6-6-6-6"></path>
		</svg>
	</div>
	
	<!-- Slider Container -->
	<nav class="sliderNav">
		<div class="overflow-x-auto">
			<ul class="flex gap-4 pb-2" style="width: max-content;">
				<?php if ($latest_posts_query->have_posts()) : ?>
					<?php while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post(); ?>
						<li class="flex-shrink-0 w-[280px] group">
							<article class="relative  p-4 hover:shadow-md hover:border-gray-200 dark:hover:border-gray-600 transition-all duration-200 ease-out">
								
								<!-- Time & Category -->
								<div class="flex items-center justify-between mb-2">
									<time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-xs text-muted-foreground">
										<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' siden'; ?>
									</time>
									
									<?php
									$categories = get_the_category();
									if (!empty($categories)) :
									?>
										<a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" 
										   class="relative rounded-full bg-gray-200 px-2 py-1 font-small text-gray-600 hover:bg-gray-200">
											<?php echo esc_html($categories[0]->name); ?>
										</a>
									<?php endif; ?>
								</div>

								<!-- Title -->
								<h3 class="text-sm font-medium text-foreground leading-snug group-hover:text-accent_color_light dark:group-hover:text-accent_color_dark transition-colors duration-200 line-clamp-2">
									<a href="<?php the_permalink(); ?>" class="block">
										<?php the_title(); ?>
									</a>
								</h3>
							</article>
						</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<li class="flex-shrink-0 w-[280px]">
						<div class="bg-white dark:bg-gray-800  p-4 text-center">
							<p class="text-xs text-muted-foreground">Ingen artikler fundet.</p>
						</div>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
</section>

<style>
/* Elegant scrollbar styling */
.sliderNav div::-webkit-scrollbar {
	height: 6px;
}

.sliderNav div::-webkit-scrollbar-track {
	background: #f1f5f9;
	border-radius: 3px;
}

.sliderNav div::-webkit-scrollbar-thumb {
	background: #cbd5e1;
	border-radius: 3px;
}

.sliderNav div::-webkit-scrollbar-thumb:hover {
	background: #94a3b8;
}

/* Dark mode scrollbar */
@media (prefers-color-scheme: dark) {
	.sliderNav div::-webkit-scrollbar-track {
		background: #374151;
	}
	
	.sliderNav div::-webkit-scrollbar-thumb {
		background: #6b7280;
	}
	
	.sliderNav div::-webkit-scrollbar-thumb:hover {
		background: #9ca3af;
	}
}

/* Smooth scrolling */
.sliderNav ul {
	scroll-behavior: smooth;
}
</style>