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

<section class="max-w-[1000px] mx-auto pt-2 md:pt-1">
	<p class="text-lg relative flex font-bold mb-2">
		<span class="py-1">Seneste nyt

        <figure class="flex gap-[12px]">
			<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right font-black my-auto">
				<path d="m9 18 6-6-6-6"></path>
			</svg>
		</figure>
        </span>
		
	</p>
	
	<nav class="sliderNav">
		<ul class="grid grid-cols-[12] overflow-x-scroll overflow-y-visible mb-6 ml-0" style="grid-template-columns: repeat(12, auto);">
			<?php if ($latest_posts_query->have_posts()) : ?>
				<?php while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post(); ?>
					<li class="min-w-[310px] min-h-[110px] relative border-t-2 border-second_color_dark dark:border-second_color_light my-4 pt-4 pr-4">
						<span class="w-2 h-2 bg-second_color_dark dark:bg-main_color_light absolute rounded-full -top-[5px] left-0"></span>
						<a href="<?php the_permalink(); ?>">
							<time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-xs">
								<span class="timeSpan flex gap-2 text-fade_color_light dark:text-fade_color_dark">
									
									<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' siden'; ?>
								</span>
							</time>
							<h2 class="text-[0.85rem] md:text-[0.9rem] line-clamp-3 overflow-hidden text-ellipsis mt-2 font-semibold text-text_main_color_dark dark:text-text_main_color_light">
								<?php the_title(); ?>
							</h2>
						</a>
					</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<li class="min-w-[310px] min-h-[110px] relative border-t-2 border-second_color_dark dark:border-second_color_light my-4 pt-4 pr-4">
					<span class="text-sm text-gray-500 dark:text-gray-400">Ingen artikler fundet.</span>
				</li>
			<?php endif; ?>
		</ul>
	</nav>
</section>