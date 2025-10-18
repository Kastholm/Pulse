<?php
// WordPress data
$thumbnail = get_post_thumbnail_id(get_the_ID());
$image_small = get_the_post_thumbnail_url(get_the_ID(), 'large');
$image_medium = get_the_post_thumbnail_url(get_the_ID(), 'large');
$title = get_the_title();
$url = get_the_permalink();

// Get categories
$categories = get_the_category();
if (!empty($categories)) {
	$primary_category = $categories[0]->name;
	$category_permalink = get_category_link($categories[0]->term_id);
} else {
	$primary_category = 'Nyheder';
	$category_permalink = '#';
}

// Get post date
$post_date = get_the_date('c');
$post_date_formatted = get_the_date('Y-m-d\TH:i:s.v\Z');

// Parse arguments
$args = wp_parse_args($args, array('style' => ''));
?>

<article class="shadow-md hover:shadow-lg transition-shadow bg-white rounded-lg group !m-auto sm:max-w-[350px]">
	<figure class="block rounded-t-lg overflow-clip md:h-[8em] h-[14em]">
		<a aria-label="Læs mere om artiklen" href="<?php echo esc_url($url); ?>">
			<img 
				alt="<?php echo esc_attr($title); ?>" 
				loading="lazy" 
				width="350" 
				height="250" 
				decoding="async" 
				class="group-hover:scale-[1.01] transition-transform duration-[15s] ease-linear object-cover w-full h-full" 
				sizes="(max-width: 768px) 100vw, 700px" 
				src="<?php echo esc_url($image_medium); ?>"
				style="color: transparent;"
			/>
		</a>
	</figure>
	
	<div class="px-4 pb-4">
		<header class="grid grid-rows-[auto_1fr_auto] min-h-[140px]">
			<aside class="flex gap-2">
				<a href="<?php echo esc_url($category_permalink); ?>">
					<p class="categoryTag">
						<?php echo esc_html($primary_category); ?>
					</p>
				</a>
				
				<time class="text-xs rounded-lg sm:my-auto my-1 sm:ml-auto hidden md:inline-block" datetime="<?php echo esc_attr($post_date_formatted); ?>">
					<span class="timeSpan flex gap-2 text-fade-color-light dark:text-fade-color-dark">
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
			
			<a href="<?php echo esc_url($url); ?>">
				<h1 class="text-md md:text-lg leading-5 md:leading-6 font-semibold">
					<?php echo esc_html($title); ?>
				</h1>
			</a>
		</header>
	</div>
</article>