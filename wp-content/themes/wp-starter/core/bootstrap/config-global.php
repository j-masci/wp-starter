<?php
/**
 * Theme config file that runs in all environments (is not git ignored).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// env config can set this to false.
if ( ! defined( 'JM_IN_PRODUCTION' ) ) {
    define( 'JM_IN_PRODUCTION', true );
}

// todo: perhaps append the WordPress version to this.
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

add_action( 'jm_after_setup', function(){

    Class Theme_Settings extends \JM\Theme_Settings {
        const HIDE_ADMIN_BAR = true;
        const SUPPORT_FEATURED_IMAGES = true;
    }

    \JM\Theme_Settings::commit( new Theme_Settings() );
});

/**
 * Returns the singleton-ish ajax config instance.
 *
 * Best to define this early. Will likely use the instance (ie. set it up) in another file.
 *
 * @return \JM\Ajax_Config
 */
function jm_ajax_config(){
    static $a;
    $a = $a ? $a : new \JM\Ajax_Config( "global_ajax", "_sub_action", "_nonce" );
    return $a;
}