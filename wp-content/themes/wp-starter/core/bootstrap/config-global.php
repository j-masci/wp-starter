<?php
/**
 * Theme config file that runs in all environments (is not git ignored).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * At this point, remember that the environment specific
 * config file may have already been included.
 */
add_action( 'theme_setup_config', function(){

    if ( ! defined( 'JM_IN_PRODUCTION' ) ) {
        define( 'JM_IN_PRODUCTION', true );
    }

    define( 'JM_ASSETS_VERSION', "1.1" );

    define( 'JM_THEME_DIR', dirname( JM_CORE_DIR ) );
    define( 'JM_THEME_URL', get_template_directory_uri() );
    define( 'JM_CSS_DIR', JM_THEME_DIR . '/css' );
    define( 'JM_CSS_URL', JM_THEME_URL . '/css' );
    define( 'JM_JS_DIR', JM_THEME_DIR . '/js' );
    define( 'JM_JS_URL', JM_THEME_URL . '/js' );
    define( 'JM_IMG_DIR', JM_THEME_DIR . '/img' );
    define( 'JM_IMG_URL', JM_THEME_URL . '/img' );
    define( 'JM_AJAX_DIR', JM_CORE_DIR . '/ajax' );

});

/**
 * Run late, after dependencies loaded.
 */
add_action( 'after_theme_setup', function(){

    Class Theme_Settings extends \JMasci\WP\Theme_Settings {
        const HIDE_ADMIN_BAR = true;
        const SUPPORT_FEATURED_IMAGES = true;
    }

    Theme_Settings::commit();
});
