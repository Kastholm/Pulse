<?php
/**
 * Universal articles layout - handles home page, categories, and tags
 */

// Determine what type of page we're on
$is_home = is_home() || is_front_page();
$is_archive = is_category() || is_tag() || is_archive();
?>

<section class="mb-lg gap-md md:flex md:flex-col">
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

	<div>
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
		
		<div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
			<?php
			if ($query->have_posts()) :
				while ($query->have_posts()) : $query->the_post();
					$post_count++;
			?>
				<?php if ($post_count == 1) : ?>
					<!-- Første artikel - tager 2/3 af bredden på md+ -->
					<div class="md:col-span-2 m-auto">
						<?php get_template_part('pages/articles/src/components/post_first_card'); ?>
					</div>

				<?php elseif ($post_count <= 3) : ?>
					<!-- Artikler 2-3 - fylder den sidste 1/3 med lodret layout på md+ -->
					<?php if ($post_count == 2) : ?>
						<div class="lg:col-span-1 md:flex md:flex-col gap-4 md:gap-6">
					<?php endif; ?>
					<div class="md:flex-1 m-auto">
						<?php get_template_part('pages/articles/src/components/post_grid_card'); ?>
					</div>
					<?php if ($post_count == 3) : ?>
						</div>
					<?php endif; ?>
					
				<?php else : ?>
					<!-- Artikler 4+ - normale 3-kolonne grid på md+ -->
					<?php if ($post_count == 4) : ?>
						<!-- Start ny række med 3 kolonner på md+ -->
						<div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mt-4">
					<?php endif; ?>
					<div>
						<?php get_template_part('pages/articles/src/components/post_grid_card'); ?>
					</div>
				<?php endif; ?>
			<?php
				endwhile;
				// Luk den sidste grid container hvis vi har flere end 4 artikler
				if ($post_count > 4) : ?>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<div class="col-span-full text-center py-12">
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