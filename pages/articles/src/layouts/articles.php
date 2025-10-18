<?php
/**
 * Universal articles layout - handles home page, categories, and tags
 */

// Determine what type of page we're on
$is_home = is_home() || is_front_page();
$is_archive = is_category() || is_tag() || is_archive();
?>

<section class="mb-lg gap-2 grid">
	<?php /* get_template_part('template-parts/partials/recent-news-slider'); */ ?>

	<!-- Archive Header (only for categories/tags) -->
	<?php if ($is_archive) : ?>
		<header class="mb-8">
			<h1 class="text-2xl lg:text-4xl font-extrabold mb-4">
				<?php the_archive_title(); ?>
			</h1>
			<?php if (get_the_archive_description()) : ?>
				<div class="text-lg text-gray-600 dark:text-gray-300">
					<?php the_archive_description(); ?>
				</div>
			<?php endif; ?>
		</header>
	<?php endif; ?>

	<div class="grid md:grid-cols-[auto_1fr] gap-4">
		<!-- Venstre side - Artikler -->
		<div class="space-y-6">
			<?php
			$post_count = 0; // Initialize a counter
			
			// Use different queries based on page type
			if ($is_home) {
				// Home page - get latest posts
				$query = new WP_Query(array(
					'post_type' => 'post',
					'post_count' => -1,
					'posts_per_page' => 9,
					'nopaging' => false,
					'paged' => get_query_var('page'),
					'ignore_sticky_posts' => true
				));
			} else {
				// Archive pages (categories/tags) - use WordPress default query
				global $wp_query;
				$query = $wp_query;
			}
			?>
			
			<?php
			if ($query->have_posts()) :
				while ($query->have_posts()) : $query->the_post();
					$post_count++;
			?>
				<?php if ($post_count == 1) : ?>
					<!-- Post 1 - first_card_two -->
					<?php get_template_part('pages/articles/src/components/post_first_card_two'); ?>

				<?php elseif ($post_count == 2) : ?>
					<!-- Post 2 - rectangle_two -->
					<?php get_template_part('pages/articles/src/components/post_grid_card_rectangle_two'); ?>

					<div class="mobile" ad-id="23209726049/OpdateretDK/Mobile_1"></div>

				<?php elseif ($post_count == 3) : ?>
					<!-- Post 3 - square_two (start vertikal container) -->
					<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
						<?php get_template_part('pages/articles/src/components/post_grid_card_square_two'); ?>

				<?php elseif ($post_count == 4) : ?>
					<!-- Post 4 - square_two (slut vertikal container) -->
					<?php get_template_part('pages/articles/src/components/post_grid_card_square_two'); ?>
					</div>

					<div class="desktop" ad-id="23209726049/OpdateretDK/Leaderboard_2"></div>
					<div class="mobile" ad-id="23209726049/OpdateretDK/Mobile_2"></div>

				<?php elseif ($post_count == 5) : ?>
					<!-- Post 5 - rectangle_two (start horizontal container) -->
					<div>
						<?php get_template_part('pages/articles/src/components/post_grid_card_rectangle'); ?>

				<?php elseif ($post_count == 6) : ?>
					<!-- Post 6 - rectangle_two (slut horizontal container) -->
					<?php get_template_part('pages/articles/src/components/post_grid_card_rectangle'); ?>
					</div>

				<?php elseif ($post_count == 7) : ?>
					<!-- Post 7 - first_card_two -->
					<?php get_template_part('pages/articles/src/components/post_first_card_two'); ?>

					<div class="desktop" ad-id="23209726049/OpdateretDK/Leaderboard_3"></div>
					<div class="mobile" ad-id="23209726049/OpdateretDK/Mobile_3"></div>

				<?php endif; ?>
			<?php
				endwhile;
				?>
			<?php else : ?>
				<div class="text-center py-12">
					<p class="text-lg text-gray-600 dark:text-gray-300">
						<?php 
						if ($is_home) {
							_e('Ingen artikler fundet.', 'pulse');
						} else {
							_e('Ingen artikler fundet i denne kategori/tag.', 'pulse');
						}
						?>
					</p>
				</div>
			<?php endif; ?>
		</div>
		
		<!-- Højre side - Bestemmes senere -->
		<div class="hidden md:block relative">
			<?php get_template_part('pages/post/src/components/top_news'); ?>
			<div class="desktop" ad-id="23209726049/OpdateretDK/Desktop_1"></div>
		</div>
	</div>
</section>

<!-- Pagination -->
<?php if ($query->have_posts()) : ?>
	<nav class="pagination-wrapper mt-12">
		<?php
		if ($is_home) {
			// Custom pagination for home page
			echo paginate_links(array(
				'total' => $query->max_num_pages,
				'current' => max(1, get_query_var('page')),
				'format' => '?page=%#%',
				'mid_size' => 2,
				'prev_text' => __('← Forrige', 'pulse'),
				'next_text' => __('Næste →', 'pulse'),
				'class' => 'pagination'
			));
		} else {
			// WordPress default pagination for archives
			the_posts_pagination(array(
				'mid_size' => 2,
				'prev_text' => __('← Forrige', 'pulse'),
				'next_text' => __('Næste →', 'pulse'),
				'class' => 'pagination'
			));
		}
		?>
	</nav>
<?php endif; ?>

<?php wp_reset_postdata(); ?>