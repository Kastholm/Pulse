<section class="mb-lg gap-md md:flex md:flex-col">
	<?php /* get_template_part('template-parts/partials/recent-news-slider'); */ ?>

	<div>
		<?php
		$post_count = 0; // Initialize a counter
		$homepage_query = new WP_Query(array(
			'post_type' => 'post',
			'post_count' => -1,
			'posts_per_page' => 9,
			'nopaging' => false,
			'paged' => get_query_var('page'),
			'ignore_sticky_posts' => true
		));
		?>
		<div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
			<?php
			if ($homepage_query->have_posts()) :
				while ($homepage_query->have_posts()) : $homepage_query->the_post();
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
			<?php endif; ?>
		</div>
	</div>
</section>