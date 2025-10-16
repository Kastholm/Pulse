<?php
// WordPress data
$image_large = get_the_post_thumbnail_url(get_the_ID(), 'large');
$image_medium = get_the_post_thumbnail_url(get_the_ID(), 'large');
$title = get_the_title();
$url = get_the_permalink();
$date = get_the_date('j. F Y');

// Get categories
$categories = get_the_category();
if (!empty($categories)) {
	$primary_category = $categories[0]->name;
	$category_permalink = get_category_link($categories[0]->term_id);
} else {
	$primary_category = 'Nyheder';
	$category_permalink = '#';
}

// Get post date for time formatting
$post_date = get_the_date('c');
$post_date_formatted = get_the_date('Y-m-d\TH:i:s.v\Z');
?>

<article class="shadow-sm bg-white dark:bg-second_color_dark rounded-lg relative !h-[100%] m-auto" style="height: 100% !important;">
	<figure class="block rounded-t-lg overflow-clip md:h-[20em] h-[14em]">
		<a aria-label="Læs mere om artiklen" href="<?php echo esc_url($url); ?>">
			<img 
				alt="<?php echo esc_attr($title); ?>" 
				loading="lazy" 
				width="700" 
				height="400" 
				decoding="async" 
				class="group-hover:scale-[1.01] transition-transform duration-[15s] ease-linear object-cover w-full h-full" 
				sizes="(max-width: 768px) 100vw, 700px" 
				src="<?php echo esc_url($image_large); ?>"
			/>
		</a>
	</figure>
	
	<div class="grid grid-rows-[auto_1fr] md:grid-rows-[auto_1fr_auto] mb-4 px-4 pb-4">
		<aside class="sm:grid sm:grid-cols-2 align-middle mt-2 h-fit md:my-2">
			<a href="<?php echo esc_url($category_permalink); ?>">
				<p class="bg-indigo-700 text-red-600 min-w-max w-fit rounded-full px-3 py-1 text-xs leading-4 no-underline hover:underline">
					<?php echo esc_html($primary_category); ?>
				</p>
			</a>
			
			<time class="rounded-lg sm:my-auto my-1 sm:ml-auto text-xs hidden md:inline-block" datetime="<?php echo esc_attr($post_date_formatted); ?>">
				<span class="timeSpan flex gap-2 text-fade_color_light dark:text-fade_color_dark">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock my-auto text-fade_color_light dark:text-fade_color_dark">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 6 12 12 16 14"></polyline>
					</svg>
					<span x-data="timeFormatter()" x-init="init()">
						<span x-text="formattedDate" data-date="<?php echo esc_attr($post_date); ?>"></span>
					</span>
				</span>
			</time>
		</aside>
		
		<header class="md:min-h-[180px]">
			<a href="<?php echo esc_url($url); ?>">
				<h1 class="text-xl md:text-[1.8em] md:leading-8 font-bold rounded-lg line-clamp-3 overflow-hidden text-ellipsis h-[90%]">
					<?php echo esc_html($title); ?>
				</h1>
			</a>

			<div class="flex items-center gap-2 text-xs">
				<?php
				// Get post author
				$author_id = get_the_author_meta('ID');
				$author_name = get_the_author();
				$author_url = get_author_posts_url($author_id);
				$author_avatar = get_avatar_url($author_id, array('size' => 24));
				?>
				
				<a class="flex items-center gap-2 hover:text-accent_color_light dark:hover:text-accent_color_dark transition-colors" href="<?php echo esc_url($author_url); ?>">
					<img class="size-6 rounded-full" src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">
					<?php echo esc_html($author_name); ?>
				</a>
				
				<span>•</span>
				
				<time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-muted-foreground">
					<?php echo get_the_date('j. F Y'); ?>
				</time>
				
				<span>•</span>
				
				<span class="text-body-accent">
					<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' siden'; ?>
				</span>
			</div>



			
		</header>
	</div>
</article>