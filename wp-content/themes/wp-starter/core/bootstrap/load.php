<?php
/**
 * Bootstrap the theme.
 *
 * I will split the logic up into 3 main portions.
 *
 * 1. include the files that do "config" (ie. define constants, or configure classes)
 * 2. include the files that load dependencies ("include" other files) (ie. define classes, functions, etc.)
 * 3. include the files that "setup" (or initialize) WordPress (ie. register post types, user roles, admin columns etc.). These
 * likely depend on #1 and #2.
 *
 * In order to solve timing issues, we will hook nearly everything onto one of 3 actions: 'theme_setup_config',
 * 'theme_setup_includes', or 'theme_setup_late'.
 *
 * This way, keep config in a config file, and include the config file early. If the config file requires
 * something that's not yet loaded, hook it onto 'theme_setup_late'.
 *
 * todo: probably can do this with less than 3 hooks and in a more simple way.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// need this one very early
define( 'JM_CORE_DIR', dirname( __DIR__ ) );

/**
 * Include files which define classes and functions which the theme depends on.
 *
 * For now, we don't need a separate file for this.
 */
add_action( 'theme_setup_includes', function(){

    if( file_exists( ABSPATH . '/vendor/autoload.php' ) ) {
        require_once ABSPATH . '/vendor/autoload.php';
    }

    // other theme files...
    include JM_CORE_DIR . '/modules/ajax.php';
    include JM_CORE_DIR . '/entities/contact-form-record.php';
}, 10 );

/**
 * Include the auto-includes (automatically) on 'theme_setup_late'.
 *
 * Despite the name ("include"), these files should "setup" WordPress. Ie.
 * register post types, user roles, taxonomies, etc. Not class or function
 * definitions.
 */
add_action( 'theme_setup_late', function(){
    array_map( function( $path ){
        require_once $path;
    }, glob(JM_CORE_DIR . '/auto-include/*.php') );

}, 10 );

/**
 * Include the environment specific (git ignored) config file which can
 * optionally define some constants.
 */
if ( file_exists( $theme_env_config = ABSPATH . '/_theme-env-config.php' ) ) {
    require $theme_env_config;
} else if ( ! is_admin() ){
    throw new Exception( "Theme environment config file must exist even if empty." );
} else {
    // if we get to here, it means we're in wp-admin, where we must fail silently so
    // that we do not interfere with the theme being de-activated.
}

/**
 * Include the other files which should add actions.
 */
require __DIR__ . '/config-global.php';
require __DIR__ . '/setup.php';

/**
 * Define constants mostly.
 */
do_action( 'theme_setup_config' );

/**
 * Load class and function definitions.
 */
do_action( 'theme_setup_includes' );

/**
 * Initialize WordPress
 */
do_action( 'theme_setup_late' );

/**
 * Note that 'after_theme_setup' and 'init' hooks still run after all of the above.
 */