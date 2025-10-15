<?php

/* Enqueue parent stylesheet */
function deothemes_pulse_child_enqueue_styles() {
    wp_enqueue_style( 'deothemes-child-pulse-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'deothemes_pulse_child_enqueue_styles' );

// Add your custom functions below this line
