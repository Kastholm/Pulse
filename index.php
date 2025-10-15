<?php get_header(); ?>
<div class="main">
  <section>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article <?php post_class('post'); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
        <?php endif; ?>
        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-meta">
          <?php echo get_the_date(); ?> · <?php the_author_posts_link(); ?> · <?php echo get_comments_number(); ?> comments
        </div>
        <div class="entry"><?php the_excerpt(); ?></div>
      </article>
    <?php endwhile; else: ?>
      <p><?php _e('No posts yet.', 'pulse-starter'); ?></p>
    <?php endif; ?>

    <div class="pagination">
      <?php the_posts_pagination([ 'mid_size' => 2 ]); ?>
    </div>
  </section>
</div>
<aside class="sidebar">
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' ); } ?>
</aside>
<?php get_footer(); ?>
