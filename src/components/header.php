<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; } 

$site_title = get_bloginfo('name');
$site_url = home_url();
$site_logo = get_theme_mod('custom_logo');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">  
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/css/output.css">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="fixed md:relative z-40 w-screen min-h-[65px]">
	<header class="flex fixed top-0 items-center justify-center gap-4 border-b bg-[#fbfbfb] dark:bg-second_color_dark px-4 md:px-6">
		<nav class="h-16 content-center bg-[#fbfbfb] dark:bg-second_color_dark w-screen items-center justify-center">
			<ul class="md:w-[1000px] bg-[#fbfbfb] dark:bg-second_color_dark !m-auto flex-col gap-6 text-lg font-medium md:flex md:flex-row md:items-center md:gap-5 md:text-sm lg:gap-6 px-2 lg:pl-4">
				
				<!-- Logo -->
				<li class="flex-shrink-0">
					<?php if ($site_logo) : ?>
						<a href="<?php echo esc_url($site_url); ?>">
							<?php echo wp_get_attachment_image($site_logo, 'full', false, array(
								'alt' => get_bloginfo('name'),
								'loading' => 'lazy',
								'class' => 'object-contain w-[80px] h-auto sm:w-[90px] sm:h-[62px] md:w-[120px] md:h-auto'
							)); ?>
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url($site_url); ?>" class="text-lg font-semibold">
							<?php echo esc_html($site_title); ?>
						</a>
					<?php endif; ?>
				</li>

				<!-- Navigation Menu -->
				<?php
				wp_nav_menu(array(
					'theme_location' => 'primary-nav',
					'container' => false,
					'items_wrap' => '%3$s',
					'fallback_cb' => false,
					'walker' => new class extends Walker_Nav_Menu {
						function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
							$classes = empty($item->classes) ? array() : (array) $item->classes;
							$classes[] = 'menu-item-' . $item->ID;
							
							$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
							$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
							
							$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
							$id = $id ? ' id="' . esc_attr($id) . '"' : '';
							
							$output .= '<li' . $id . $class_names .'>';
							
							$attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
							$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
							$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
							$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
							
							// Check if current page matches menu item
							$current_class = '';
							if (is_category() && strpos($item->url, '/kategori/') !== false) {
								$category_slug = get_queried_object()->slug;
								if (strpos($item->url, $category_slug) !== false) {
									$current_class = 'text-foreground';
								} else {
									$current_class = 'text-muted-foreground';
								}
							} elseif (is_home() && $item->url === home_url('/')) {
								$current_class = 'text-foreground';
							} else {
								$current_class = 'text-muted-foreground';
							}
							
							$item_output = isset($args->before) ? $args->before : '';
							$item_output .= '<a class="transition-colors hover:text-foreground hidden md:inline-block ' . $current_class . '"' . $attributes .'>';
							$item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
							$item_output .= '</a>';
							$item_output .= isset($args->after) ? $args->after : '';
							
							$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
						}
						
						function end_el(&$output, $item, $depth = 0, $args = null) {
							$output .= "</li>\n";
						}
					}
				));
				?>

				<!-- Desktop Controls -->
				<span class="hidden md:grid grid-cols-2 items-center ml-auto">
					
					<!-- Search Button -->
                <button
						onclick="toggleSearchBar()" 
						aria-label="Søg artikler" 
						class="hidden lg:flex items-center bg-accent_color_dark dark:bg-accent_color_light bg-opacity-80 justify-center w-12 h-12 rounded-lg hover:opacity-90 transition-opacity"
					>
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</button>
                    </span>
			</ul>
       </nav>
       

		<!-- Mobile Menu Button -->
		<button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 w-9 shrink-0 md:hidden ml-auto" data-state="closed" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="mobile-menu" onclick="toggleMobileMenu()">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu h-5 w-5">
				<line x1="4" x2="20" y1="12" y2="12"></line>
				<line x1="4" x2="20" y1="6" y2="6"></line>
				<line x1="4" x2="20" y1="18" y2="18"></line>
			</svg>
			<span class="sr-only">Toggle navigation menu</span>
		</button>
	</header>
</header>

<!-- Desktop Search Bar (Hidden by default) -->
<div id="desktop-search-bar" class="fixed top-16 left-0 right-0 z-50 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-lg hidden">
	<div class="max-w-[1000px] mx-auto px-6 py-4">
		<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-4">
			<div class="flex-1 relative">
				<input 
					type="search" 
					name="s" 
					placeholder="Søg artikler..." 
					class="w-full px-4 py-3 pr-12 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent_color_light focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
					value="<?php echo esc_attr(get_search_query()); ?>"
					autofocus
				>
				<button 
					type="submit" 
					aria-label="Søg artikler" 
					class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
				>
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
					</svg>
				</button>
			</div>
			<button 
				type="button" 
				onclick="toggleSearchBar()" 
				class="px-4 py-3 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors"
			>
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</button>
		</form>
	</div>
</div>

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed inset-0 z-50 bg-black/50 hidden">
	<div class="fixed right-0 top-0 h-full w-64 bg-white dark:bg-gray-800 p-6">
		<div class="flex items-center justify-between mb-6">
			<?php if ($site_logo) : ?>
				<a href="<?php echo esc_url($site_url); ?>" class="flex items-center gap-2">
					<?php echo wp_get_attachment_image($site_logo, 'full', false, array('class' => 'h-6 w-auto')); ?>
					<span class="sr-only"><?php echo esc_html($site_title); ?></span>
				</a>
			<?php else : ?>
				<a href="<?php echo esc_url($site_url); ?>" class="text-lg font-semibold">
					<?php echo esc_html($site_title); ?>
				</a>
			<?php endif; ?>
			<button onclick="toggleMobileMenu()" class="text-gray-500">
				<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</button>
		</div>
		
		<!-- Mobile Search Form -->
		<div class="mb-6">
			<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
				<div class="flex gap-2">
					<input 
						type="search" 
						name="s" 
						placeholder="Søg artikler..." 
						class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent_color_light focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
						value="<?php echo esc_attr(get_search_query()); ?>"
					>
					<button 
						type="submit" 
						class="px-4 py-2 bg-accent_color_dark dark:bg-accent_color_light text-white rounded-lg hover:opacity-90 transition-opacity"
					>
						Søg
					</button>
				</div>
			</form>
		</div>

		<nav class="grid gap-6 text-lg font-medium">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'primary-nav',
				'container' => false,
				'menu_class' => 'space-y-2',
				'fallback_cb' => false,
				'walker' => new class extends Walker_Nav_Menu {
					function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
						$classes = empty($item->classes) ? array() : (array) $item->classes;
						$classes[] = 'menu-item-' . $item->ID;
						
						$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
						$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
						
						$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
						$id = $id ? ' id="' . esc_attr($id) . '"' : '';
						
						$output .= '<li' . $id . $class_names .'>';
						
						$attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
						$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
						$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
						$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
						
						$item_output = isset($args->before) ? $args->before : '';
						$item_output .= '<a class="block text-gray-600 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors"' . $attributes .'>';
						$item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
						$item_output .= '</a>';
						$item_output .= isset($args->after) ? $args->after : '';
						
						$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
					}
					
					function end_el(&$output, $item, $depth = 0, $args = null) {
						$output .= "</li>\n";
					}
				}
			));
			?>
		</nav>
	</div>
     </div>

<script>
function toggleMobileMenu() {
	const menu = document.getElementById('mobile-menu');
	menu.classList.toggle('hidden');
}

function toggleSearchBar() {
	const searchBar = document.getElementById('desktop-search-bar');
	searchBar.classList.toggle('hidden');
	
	// Focus on input when search bar opens
	if (!searchBar.classList.contains('hidden')) {
		const input = searchBar.querySelector('input[type="search"]');
		setTimeout(() => input.focus(), 100);
	}
}

// Close search bar when clicking outside
document.addEventListener('click', function(event) {
	const searchBar = document.getElementById('desktop-search-bar');
	const searchButton = event.target.closest('button[onclick="toggleSearchBar()"]');
	
	if (!searchBar.contains(event.target) && !searchButton && !searchBar.classList.contains('hidden')) {
		searchBar.classList.add('hidden');
	}
});

// Close search bar with Escape key
document.addEventListener('keydown', function(event) {
	if (event.key === 'Escape') {
		const searchBar = document.getElementById('desktop-search-bar');
		if (!searchBar.classList.contains('hidden')) {
			searchBar.classList.add('hidden');
		}
	}
});
</script>