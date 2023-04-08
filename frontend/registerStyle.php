<?php
/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'sa_add_my_stylesheet' );

/**
 * Enqueue plugin style.css
 */
function sa_add_my_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'sa-style', plugins_url('public/style.css', dirname(__FILE__)) );
    wp_enqueue_style( 'sa-style' );
}