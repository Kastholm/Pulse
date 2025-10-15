<?php get_header(); ?>
<div class="main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class('post'); ?>>
      <h1 class="post-title"><?php the_title(); ?></h1>
      <div class="entry"><?php the_content(); ?></div>
    </article>
  <?php endwhile; endif; ?>
</div>
<aside class="sidebar">
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' ); } ?>
</aside>
<?php get_footer(); ?>
