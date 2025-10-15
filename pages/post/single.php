

<div class="mx-auto articleSection grid relative lg:grid-cols-[1fr_1fr]">
	<?php while (have_posts()) : the_post(); ?>
		<article class="w-full lg:w-[700px] rounded-lg">
			<section>
				<!-- Category -->
				<div class="grid">
					<?php
					$categories = get_the_category();
					if (!empty($categories)) :
						$category = $categories[0];
					?>
						<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
							<button class="text-accent_color_light dark:text-accent_color_dark font-bold uppercase text-md lg:text-xl rounded-lg">
								<?php echo esc_html($category->name); ?>
							</button>
						</a>
					<?php endif; ?>
				</div>

				<!-- Title -->
				<header>
					<h1 class="text-xl lg:text-4xl font-extrabold my-1 lg:my-2">
						<?php the_title(); ?>
					</h1>
				</header>

				<!-- Meta information -->
				<footer class="py-1 lg:py-4">
					<div class="items-center p-2 mt-1 md:mt-2 border-t-2 border-gray-200">
						<!-- Published time -->
						<time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="hidden md:block text-xs">
							<span class="timeSpan flex gap-2 text-fade_color_light dark:text-fade_color_dark">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock my-auto text-fade_color_light dark:text-fade_color_dark">
									<circle cx="12" cy="12" r="10"></circle>
									<polyline points="12 6 12 12 16 14"></polyline>
								</svg>
								<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' siden'; ?>
							</span>
						</time>
						
						<!-- Author and date -->
						<div class="flex gap-x-2 lg:mt-2 align-middle">
							<a rel="author" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
								<p class="text-fade_color_light dark:text-fade_color_dark font-semibold text-xs lg:text-md">
									Skrevet af: <b class="text-text_second_color_dark dark:text-text_second_color_dark text-xs lg:text-md"><?php the_author(); ?></b>
								</p>
							</a>
							<time class="text-fade_color_light dark:text-fade_color_dark font-semibold text-xs">
								D. <?php echo get_the_date('j/n/Y'); ?>
							</time>
						</div>
					</div>
				</footer>

				<!-- Featured image -->
				<?php if (has_post_thumbnail()) : ?>
					<aside class="relative min-h-[10em] md:min-h-[25em]">
						<figure class="absolute top-0 left-0 right-0 h-[10em] md:h-[25em] overflow-clip">
							<?php the_post_thumbnail('large', array(
								'class' => 'w-full h-auto rounded-t-lg object-cover',
								'alt' => get_the_title(),
								'loading' => 'lazy'
							)); ?>
							<?php if (get_the_post_thumbnail_caption()) : ?>
								<figcaption class="absolute text-xs lg:text-sm bottom-0 right-0 text-gray-300 p-1 bg-gray-400 bg-opacity-50">
									<?php echo get_the_post_thumbnail_caption(); ?>
								</figcaption>
							<?php endif; ?>
						</figure>
					</aside>
				<?php endif; ?>

				<!-- Excerpt -->
				<?php if (has_excerpt()) : ?>
					<h2 class="text-md lg:text-2xl font-semibold my-2 mb-4 lg:my-4 px-3">
						<?php the_excerpt(); ?>
					</h2>
				<?php endif; ?>
			</section>

			<!-- Article content -->
			<section class="articleText leading-8 text-lg prose prose-blue prose-xl dark:prose-invert prose-li:marker:text-primary">
				<?php the_content(); ?>
			</section>

			<!-- Tags -->
			<?php
			$tags = get_the_tags();
			if ($tags) :
			?>
				<div class="my-2 px-3 mt-12">
					<span class="text-xs lg:text-sm">Artiklens Tags: </span>
					<?php foreach ($tags as $tag) : ?>
						<a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
							<button class="text-xs lg:text-sm text-fade_color_light dark:text-fade_color_dark relative rounded-full bg-gray-100 px-3 py-1.5 font-medium hover:bg-gray-100">
								<?php echo esc_html($tag->name); ?>
							</button>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</article>
	<?php endwhile; ?>
	<?php get_template_part('pages/post/components/top_news'); ?>
          </div>