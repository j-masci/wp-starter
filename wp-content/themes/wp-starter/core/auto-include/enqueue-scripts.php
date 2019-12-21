<?php
/**
 * Enqueue scripts and styles
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'enqueue_scripts', function(){

    wp_enqueue_style( 'theme_css', JM_CSS_URL . '/master.css', [], JM_ASSETS_VERSION );

    wp_enqueue_style( 'theme_fonts', JM_CSS_URL . '/https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto:400,500' );

    wp_register_script( 'theme_js', JM_JS_URL . '/main.js', [ 'jquery' ], JM_ASSETS_VERSION );
    wp_enqueue_script( 'theme_js' );
});