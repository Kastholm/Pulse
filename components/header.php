<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <div class="container">
    <div class="site-branding">
      <div class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>"><?php bloginfo( 'name' ); ?></a></div>
      <div class="site-description"><?php bloginfo( 'description' ); ?></div>
    </div>
    <nav class="nav" aria-label="<?php esc_attr_e('Primary Menu','pulse-starter'); ?>">
      <?php wp_nav_menu([ 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => false, 'depth' => 1 ]); ?>
    </nav>
  </div>
</header>
<main class="container content">
