<?php get_header(); ?>
<div class="main">
  <h1><?php the_archive_title(); ?></h1>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class('post'); ?>>
      <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="post-meta"><?php echo get_the_date(); ?> · <?php the_author_posts_link(); ?></div>
      <div class="entry"><?php the_excerpt(); ?></div>
    </article>
  <?php endwhile; the_posts_pagination([ 'mid_size' => 2 ]); else: ?>
    <p><?php _e('Nothing found.', 'pulse-starter'); ?></p>
  <?php endif; ?>
</div>
<aside class="sidebar">
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' ); } ?>
</aside>
<?php get_footer(); ?>
