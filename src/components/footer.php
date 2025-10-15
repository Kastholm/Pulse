<?php
/**
 * WordPress Footer Component
 * Shows footer with categories, popular content, info links, and newsletter signup
 */

// Get categories for footer
$investment_categories = get_categories(array(
    'include' => array(), // Add category IDs here if you want specific categories
    'orderby' => 'name',
    'order' => 'ASC',
    'number' => 3
));

// Get popular tags
$popular_tags = get_tags(array(
    'orderby' => 'count',
    'order' => 'DESC',
    'number' => 3
));

// Get current year for copyright
$current_year = date('Y');
?>

<footer class="bg-second_color_light dark:bg-second_color_dark relative z-50 shadow" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="mx-auto max-w-7xl px-6 pb-8 pt-20 sm:pt-24 lg:px-8 lg:pt-32">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="grid grid-cols-4 gap-8 xl:col-span-2">
                
                <!-- Investering Section -->
                <div class="md:grid md:gap-8">
                    <div>
                        <h1 class="text-sm font-semibold leading-6">Investering</h1>
                        <ul class="mt-4 space-y-4 grid text-fade_color_light dark:text-fade_color_dark">
                            <?php if (!empty($investment_categories)) : ?>
                                <?php foreach ($investment_categories as $category) : ?>
                                    <li>
                                        <a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li><a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/kategori/aktier')); ?>">Aktier</a></li>
                                <li><a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/kategori/investering')); ?>">Investering</a></li>
                                <li><a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/tag/kryptovaluta')); ?>">Kryptovaluta</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Mest besøgte Section -->
                <div class="md:grid md:gap-8">
                    <div>
                        <h1 class="text-sm font-semibold leading-6">Mest besøgte</h1>
                        <ul class="mt-4 space-y-4 grid text-fade_color_light dark:text-fade_color_dark">
                            <?php if (!empty($popular_tags)) : ?>
                                <?php foreach ($popular_tags as $tag) : ?>
                                    <li>
                                        <a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
                                            <?php echo esc_html($tag->name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li><a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/tag/nyheder')); ?>">Nyheder</a></li>
                                <li><a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/kategori/lon')); ?>">Løn</a></li>
                                <li><a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/tag/aktier')); ?>">Aktier</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="md:grid md:gap-8">
                    <div>
                        <h1 class="text-sm font-semibold leading-6">Info</h1>
                        <ul class="mt-4 space-y-4 grid text-fade_color_light dark:text-fade_color_dark">
                            <li>
                                <a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/om-os')); ?>">
                                    Om Pengehjørnet
                                </a>
                            </li>
                            <li>
                                <a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/kontakt')); ?>">
                                    Kontakt Pengehjørnet
                                </a>
                            </li>
                            <li>
                                <a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/cookies')); ?>">
                                    Cookiedeklaration
                                </a>
                            </li>
                            <li>
                                <a class="text-sm leading-6 text-fade_color_light hover:text-slate-400 dark:text-fade_color_dark" href="<?php echo esc_url(home_url('/privatlivspolitik')); ?>">
                                    Privatlivspolitik
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Newsletter Signup -->
            <aside class="mt-10 xl:mt-0">
                <div class="Toastify"></div>
                <h2 class="text-sm font-semibold leading-6">Tilmeld dig vores nyhedsbrev</h2>
                <p class="mt-2 text-sm leading-6 text-fade_color_light dark:text-fade_color_dark">
                    De seneste nyheder, artikler og ressourcer, sendt til din indbakke ugentligt.
                </p>
                <form class="mt-6 sm:flex sm:max-w-md" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post">
                    <input type="hidden" name="action" value="newsletter_signup">
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('newsletter_nonce'); ?>">
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" autocomplete="email" required class="w-full min-w-0 appearance-none rounded-md border-0 bg-white px-3 py-1.5 text-base text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:w-64 sm:text-sm sm:leading-6 xl:w-full" placeholder="Skriv din email" type="email" name="email-address">
                    <div class="mt-4 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
                        <button type="submit" class="flex w-full items-center justify-center rounded-md bg-accent_color_dark dark:bg-accent_color_light px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Tilmeld
                        </button>
                    </div>
                </form>
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