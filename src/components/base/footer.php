<?php
/**
 * WordPress Footer Component
 * Shows footer with WordPress navigation menus and newsletter signup
 */

// Get current year for copyright
$current_year = date('Y');
?>

<footer class="bg-second_color_light dark:bg-second_color_dark relative z-50 shadow" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div style="max-width: 1000px;" class="mx-auto px-6 pb-8 pt-20 sm:pt-24 lg:px-8 lg:pt-32">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                
                <!-- Primary Menu -->
                <div class="md:grid md:gap-8">
                    <div>
                        <h1 class="text-sm font-semibold leading-6">Navigation</h1>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary-nav',
                            'menu_class' => 'mt-4 space-y-4 grid text-fade_color_light dark:text-fade_color_dark',
                            'container' => false,
                            'fallback_cb' => false
                        ));
                        ?>
                    </div>
                </div>

                <!-- Footer Menu 1 -->
                <div class="md:grid md:gap-8">
                    <div>
                        <h1 class="text-sm font-semibold leading-6">Info</h1>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-nav-1',
                            'menu_class' => 'mt-4 space-y-4 grid text-fade_color_light dark:text-fade_color_dark',
                            'container' => false,
                            'fallback_cb' => false
                        ));
                        ?>
                    </div>
                </div>
            </div>

            <!-- Newsletter Signup -->
            <aside class="mt-10 xl:mt-0">
                <h2 class="text-sm font-semibold leading-6">Nyhedsbrev</h2>
                <p class="mt-2 text-sm leading-6 text-fade_color_light dark:text-fade_color_dark">
                    Kommer snart! Hold øje med vores nyhedsbrev funktion.
                </p>
                <div class="mt-6 p-4 bg-gray-100 dark:bg-gray-800 rounded-md border border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            Kommer snart
                        </span>
                       
                    </p>
                </div>
            </aside>
        </div>

        <!-- Copyright -->
        <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-24">
            <div class="flex space-x-6 md:order-2"></div>
            <p class="mt-8 text-xs leading-5 text-gray-500 md:order-1 md:mt-0">
                Copyright <?php echo $current_year; ?> <?php echo esc_html(get_bloginfo('name')); ?>.
            </p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>