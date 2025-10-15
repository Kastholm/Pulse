<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
</main>
<footer class="site-footer">
  <div class="container" style="padding:16px 0;">
    <nav class="nav" aria-label="<?php esc_attr_e('Footer Menu','pulse-starter'); ?>">
      <?php wp_nav_menu([ 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false, 'depth' => 1 ]); ?>
    </nav>
    <p style="margin-top:8px;">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
