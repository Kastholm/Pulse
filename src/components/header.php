<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; } 

$site_title = get_bloginfo('name');
$site_url = home_url();
if (defined('site_logo') && $site_logo) {
	$site_logo = $site_logo['url'];
} else {
	$site_logo = '';
}
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
<header class="sticky top-0 z-50">
	<div class="bg-header-background max-lg:pl-base lg:px-base w-full lg:py-4">
		<div class="max-w-wide mx-auto flex items-center justify-between">
			<a class="flex w-full items-center justify-start lg:justify-start" href="<?php echo $site_url; ?>" aria-label="<?php echo $site_title; ?>">
				<?php if (defined('site_logo') && $site_logo) : ?>
					<img class="aspect-[244/44] md:w-[150px] h-[44px] max-h-7 md:max-h-11" src="<?php echo $site_logo['url']; ?>" alt="<?php echo $site_title; ?>">
				<?php else : ?>
					<span class="text-header-text text-h4 font-bold"><?php echo $site_title; ?></span>
				<?php endif; ?>
			</a>
			<div class=" flex items-center lg:hidden">
				<div class="mobile-menu bg-header-background-secondary has-global-padding relative flex items-center gap-2 py-4 lg:hidden" x-data="{secondaryMenu: false}" x-cloak>

					<?php /* do_action( 'newspack_header_before_mobile_toggle' ); */ ?>

					<button id="mobile-nav-trigger" aria-label="Mobile nav trigger" class="bg-header-search-icon-background text-header-search-icon-color grid size-10 cursor-pointer place-content-center rounded-full" @click="secondaryMenu = !secondaryMenu">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
							<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
						</svg>
					</button>
					<div class="bg-header-background-secondary py-lg px-base fixed right-4 top-4 z-40 h-[calc(100vh-2rem)] w-80 max-w-full overflow-y-auto rounded-lg shadow-lg" x-show="secondaryMenu" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="transform translate-x-0" x-transition:leave-end="transform translate-x-full" @click.outside="secondaryMenu = false">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-header-text absolute right-4 top-4 size-6 cursor-pointer" @click="secondaryMenu = !secondaryMenu">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
						</svg>
						<form role="search" method="get" class="search-form my-base" action="<?php echo home_url('/'); ?>">
							<label for="search" class="sr-only block text-sm font-medium leading-6 text-gray-900"><?php _e('Søg efter artikler', 'mxnkeys'); ?></label>
							<div class="mt-2">
								<input id="search" type="search" class="focus:ring-body-accent block w-full rounded-md border-0 px-3 py-1.5 shadow-sm outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" placeholder="<?php _e('Søg', 'mxnkeys'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
							</div>
						</form>
						<ul class="flex flex-col divide-y">
							<?php
							if (has_nav_menu('primary-nav')) {
								wp_nav_menu(
									array(
										'theme_location'    => 'primary-nav',
										'menu_id'           => 'primary-nav',
										'container'         => '',
										'menu_class'        => 'relative flex flex-col items-center justify-start gap-base text-header-text',
										'walker'            => new Mxn_mobile_nav_walker()
									)
								);
							}
							?>
						</ul>
					</div>

					<?php /* do_action( 'newspack_header_after_mobile_toggle' ); */ ?>

				</div>
			</div>
		</div>
	</div>
	<nav id="site-navigation" class="bg-header-background-secondary has-global-padding border-b-header-border z-10 w-full border-b py-2 max-lg:hidden" aria-label="<?php esc_attr('Main Navigation'); ?>">
		<div class="max-w-wide relative mx-auto flex w-full items-center justify-between gap-4">
			<div class="navigation flex items-center justify-center">
				<?php
				if (has_nav_menu('primary-nav')) {
					wp_nav_menu(
						array(
							'theme_location'    => 'primary-nav',
							'menu_id'           => 'primary-nav',
							'container'         => '',
							'menu_class'        => 'hidden lg:flex relative  items-center justify-end gap-base text-header-text',
							'walker'            => new Mxn_header_nav_walker()
						)
					);
				}
				?>
			</div>
			<div class="flex justify-end gap-4">
				<?php /* get_template_part('/template-parts/partials/search-popover'); */ ?>
			</div>
		</div>
	</nav>
</header>
<main class="container content">
