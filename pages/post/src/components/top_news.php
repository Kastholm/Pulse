<?php
/**
 * Top News Component - Shows 5 latest articles excluding current post
 */

// Get current post ID to exclude it
$current_post_id = get_the_ID();

// Query for 5 latest posts excluding current post
$top_news_query = new WP_Query(array(
	'post_type' => 'post',
	'posts_per_page' => 3,
	'post__not_in' => array($current_post_id),
	'ignore_sticky_posts' => true,
	'orderby' => 'date',
	'order' => 'DESC'
));
?>

<aside class="w-[280px] inline-block">
	<section id="trending" class="inline-block xl:sticky p-6 md:p-4 min-w-[300px] w-[95vw] lg:w-full bg-second_color_light dark:bg-second_color_dark rounded-2xl sticky top-[65px]">
		<div>
			<h1 class="text-sm font-bold mb-4">TOPNYHEDER</h1>
			<ul class="grid gap-2">
				<?php if ($top_news_query->have_posts()) : ?>
					<?php 
					$counter = 1;
					while ($top_news_query->have_posts()) : $top_news_query->the_post(); 
					?>
						<li >
							<article class="flex items-center border-b-2 border-b-[#e2e8f0] dark:border-b-text_second_color_dark pb-2 !bg-[#ffffff00]">
								<span class="font-bold text-text_second_color_dark dark:text-text_second_color_light text-xl min-w-6">
									<?php echo $counter; ?>
								</span>
								<a href="<?php the_permalink(); ?>">
									<header class="ml-2 text-main_color_dark dark:text-main_color_light hover:text-accent_color_light dark:hover:text-accent_color_dark transition-colors text-sm">
										<h2><?php the_title(); ?></h2>
									</header>
								</a>
							</article>
						</li>
					<?php 
						$counter++;
					endwhile; 
					wp_reset_postdata();
					?>
				<?php else : ?>
					<li class="text-sm text-gray-500 dark:text-gray-400">
						Ingen artikler fundet.
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</section>
</aside>