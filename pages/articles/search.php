<?php
/**
 * Search Results Page
 * Shows search results based on title search
 */

get_header();
?>

<main class="min-h-screen bg-background">
    <div class="max-w-[1000px] mx-auto px-6 py-8">
        
        <!-- Search Header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-foreground mb-4">
                Søgeresultater
            </h1>
            
            <?php if (get_search_query()) : ?>
                <p class="text-muted-foreground">
                    Du søgte efter: <span class="font-semibold text-foreground">"<?php echo esc_html(get_search_query()); ?>"</span>
                </p>
            <?php endif; ?>
        </div>

        <!-- Search Form -->
        <div class="mb-8">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="max-w-md">
                <div class="flex gap-2">
                    <input 
                        type="search" 
                        name="s" 
                        value="<?php echo esc_attr(get_search_query()); ?>" 
                        placeholder="Søg artikler..." 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent_color_light focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                        required
                    >
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-accent_color_dark dark:bg-accent_color_light text-white rounded-lg hover:opacity-90 transition-opacity"
                    >
                        Søg
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Results -->
        <div class="space-y-6">
            <?php if (have_posts()) : ?>
                
                <!-- Results Count -->
                <div class="text-sm text-muted-foreground mb-6">
                    <?php
                    global $wp_query;
                    $total_results = $wp_query->found_posts;
                    if ($total_results == 1) {
                        echo '1 artikel fundet';
                    } else {
                        echo $total_results . ' artikler fundet';
                    }
                    ?>
                </div>

                <!-- Results Grid -->
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow">
                            
                            <!-- Featured Image -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="aspect-video overflow-hidden">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array(
                                            'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300',
                                            'alt' => get_the_title()
                                        )); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <!-- Content -->
                            <div class="p-4">
                                
                                <!-- Categories -->
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) :
                                ?>
                                    <div class="mb-2">
                                        <?php foreach ($categories as $category) : ?>
                                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                               class="inline-block text-xs font-medium text-accent_color_light dark:text-accent_color_dark hover:underline">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Title -->
                                <h2 class="text-lg font-semibold text-foreground mb-2 line-clamp-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-accent_color_light dark:hover:text-accent_color_dark transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-sm text-muted-foreground mb-3 line-clamp-3">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </p>

                                <!-- Meta -->
                                <div class="flex items-center justify-between text-xs text-muted-foreground">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                 <!--    <span>
                                        <?php /* echo reading_time(); */ ?> min læsning
                                    </span> -->
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php if (function_exists('the_posts_pagination')) : ?>
                    <div class="mt-12">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '← Forrige',
                            'next_text' => 'Næste →',
                            'class' => 'pagination-wrapper'
                        ));
                        ?>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                
                <!-- No Results -->
                <div class="text-center py-12">
                    <div class="max-w-md mx-auto">
                        <svg class="w-16 h-16 mx-auto text-muted-foreground mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h2 class="text-xl font-semibold text-foreground mb-2">Ingen resultater fundet</h2>
                        <p class="text-muted-foreground mb-6">
                            Vi kunne ikke finde nogen artikler der matcher din søgning. Prøv at søge med andre ord.
                        </p>
                        
                        <!-- Search Suggestions -->
                        <div class="text-sm text-muted-foreground">
                            <p class="mb-2">Forslag:</p>
                            <ul class="space-y-1">
                                <li>• Kontroller stavning</li>
                                <li>• Prøv mere generelle søgeord</li>
                                <li>• Prøv færre søgeord</li>
                            </ul>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>
