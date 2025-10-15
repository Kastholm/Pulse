<?php get_template_part('src/components/header'); ?>
<main>

	<?php if (has_action('mxn_horizontal_1')) : ?>
		<div class="my-md max-w-wide mx-auto flex items-center justify-center">
			<?php do_action('mxn_horizontal_1'); ?>
		</div>
	<?php endif; ?>

	<?php if (has_action('newspack_theme_main_top')) : ?>
			<div class="my-md max-w-wide mx-auto flex items-center justify-center">
				<?php do_action('newspack_theme_main_top'); ?>
			</div>
	<?php endif; ?>

	<div>
		<?php
		do_action( 'newspack_theme_primary_top' );
		?>
		<div class="bg-body-background-main">

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
				get_template_part('pages/single');
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
	<?php
		/* if (has_action('mxn_float')) {
			do_action('mxn_float');
		}

		do_action( 'newspack_theme_main_bottom' ); */
	?>
</main>

<?php /* do_action( 'newspack_theme_primary_bottom' ); */ ?>
<?php
get_template_part('src/components/footer');
