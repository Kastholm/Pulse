<?php get_header(); ?>
<div class="main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class('post'); ?>>
      <h1 class="post-title"><?php the_title(); ?></h1>
      <div class="post-meta">
        <?php echo get_the_date(); ?> · <?php the_author_posts_link(); ?> · <?php the_category(', '); ?>
      </div>
      <?php if ( has_post_thumbnail() ) : the_post_thumbnail('large'); endif; ?>
      <div class="entry"><?php the_content(); ?></div>
      <div class="tags"><?php the_tags(); ?></div>
      <?php comments_template(); ?>
    </article>
  <?php endwhile; endif; ?>
</div>
<aside class="sidebar">
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' ); } ?>
</aside>
<?php get_footer(); ?>
