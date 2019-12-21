<?php

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'after_theme_setup', function(){
    register_nav_menu( "theme_header", "Header" );
    register_nav_menu( "theme_footer", "Footer" );
});
