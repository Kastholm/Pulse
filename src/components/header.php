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
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/css/output.css">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="fixed md:relative z-40 w-screen min-h-[65px]">
	<header class="flex fixed top-0 items-center justify-center gap-4 border-b bg-second_color_light dark:bg-second_color_dark px-4 md:px-6">
		<nav class="h-16 content-center bg-second_color_light dark:bg-second_color_dark w-screen items-center justify-center">
			<ul class="md:w-[1000px] bg-second_color_light dark:bg-second_color_dark !m-auto flex-col gap-6 text-lg font-medium md:flex md:flex-row md:items-center md:gap-5 md:text-sm lg:gap-6 px-2 lg:pl-4">
				
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
					<!-- Dark Mode Toggle -->
					<!-- <label for="darkModeToggle" class="ml-auto mr-4 cursor-pointer">
						<input class="toggle-checkbox" aria-label="darkmodetoggle" id="darkModeToggle" type="checkbox">
						<div class="toggle-slot">
							<div class="sun-icon-wrapper">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffbb52" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun iconify sun-icon">
									<circle cx="12" cy="12" r="4"></circle>
									<path d="M12 2v2"></path>
									<path d="M12 20v2"></path>
									<path d="m4.93 4.93 1.41 1.41"></path>
									<path d="m17.66 17.66 1.41 1.41"></path>
									<path d="M2 12h2"></path>
									<path d="M20 12h2"></path>
									<path d="m6.34 17.66-1.41 1.41"></path>
									<path d="m19.07 4.93-1.41 1.41"></path>
								</svg>
							</div>
							<div class="toggle-button"></div>
							<div class="moon-icon-wrapper">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon iconify moon-icon">
									<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
								</svg>
							</div>
						</div>
					</label> -->
					
					<!-- Search Button -->
					<a class="hidden lg:block" href="<?php echo esc_url(home_url('/search')); ?>">
						<div>
							<button type="submit" aria-label="Søg artikler" class="flex flex-end items-center bg-accent_color_dark dark:bg-bg-accent_color_light bg-opacity-80 justify-center w-12 h-12 rounded-lg">
								<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
								</svg>
                </button>
                    </div>
					</a>
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
</script>