
<div class="gap-md mt-base grid grid-cols-1 lg:grid-cols-3">
	<article class="col-span-1 lg:col-span-2">

		<?php /* get_template_part('template-parts/partials/post-sponsored'); */ ?>

		<div>
			<?php the_content(); ?>
		</div>
	</article>
	<aside class="gap-md col-span-1 flex flex-col max-lg:hidden">
		<h2 class="mb-base text-h3"><?php echo __('Nyeste artikler', 'Websail') ?></h2>
		<?php /* get_template_part('template-parts/partials/most-popular-posts'); */ ?>
	</aside>
</div>