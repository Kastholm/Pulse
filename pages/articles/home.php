<section class="mb-lg gap-md flex flex-col">
    <h1>TEEEST</h1>
	<?php /* get_template_part('template-parts/partials/recent-news-slider'); */ ?>

	<div class="post-grid">
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
		if ($homepage_query->have_posts()) :
			while ($homepage_query->have_posts()) : $homepage_query->the_post();
				$post_count++;
		?>
				<article class="post-card">
					<?php if ($post_count == 1) : ?>
						<?php get_template_part('pages/articles/components/post_first_card'); ?>
					<?php else : ?>
						<?php /* get_template_part('template-parts/partials/post', 'card'); */ ?>
					<?php endif; ?>
				</article>
				<?php if ($post_count == 1) : ?>
					<?php
					/* if (has_action('mxn_mobile_in_feed')) {
						echo '<div class="lg:hidden not-is-style-prose flex items-center justify-center">';
						do_action('mxn_mobile_in_feed');
						echo '</div>';
					} */
					?>
				<?php endif; ?>
			<?php
			endwhile;
			?>
		<?php
		endif;
		wp_reset_postdata();
		?>
		<?php if (has_action('mxn_rectangle')) : ?>
			<div class="feed-rectangle flex w-full items-center justify-center max-lg:hidden">
				<?php do_action('mxn_rectangle'); ?>
			</div>
		<?php endif; ?>
	</div>
</section>