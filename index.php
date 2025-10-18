<?php get_template_part('src/components/header'); ?>
<main class="px-4 relative">
<div class="desktop" ad-id="/23209726049/OpdateretDK/Leaderboard_1"></div>
	<div>

		<div class="bg-body-background-main">
			<?php /* get_template_part('src/components/latest_slider'); */ ?>
			<?php get_template_part('src/components/breadcrumb'); ?>

			<?php
			// Dynamically load different content based on the page type
			if (is_front_page()) {
				get_template_part('pages/articles/home');
			} elseif (is_date()) {
				get_template_part('pages/articles/archive-dates');
			} elseif (is_archive()) {
				get_template_part('pages/articles/archive');
			} elseif (is_search()) {
				get_template_part('pages/articles/search');
			} elseif (is_single()) {
				get_template_part('pages/post/single');
			} elseif (is_page()) {
				get_template_part('pages/articles/page');
			}
			?>


			<?php if (is_front_page()) : ?>
				<div <?php /* echo mxn_content_class('p-base'); */ ?>>
					<?php echo the_content(); ?>
				</div>
			<?php endif; ?>

			<?php if (is_tag()) : ?>
				<div <?php /* echo mxn_content_class('p-base'); */ ?>>
					<?php echo tag_description(); ?>
				</div>
			<?php endif; ?>

			<?php if (is_category()) : ?>
				<div <?php /* echo mxn_content_class('p-base'); */ ?>>
					<?php echo category_description(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php
?>
</script>
<?php
get_template_part('src/components/footer');