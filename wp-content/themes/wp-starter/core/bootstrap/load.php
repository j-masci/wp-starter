<?php
/**
 * Bootstrap the theme.
 *
 * 3 main things to do:
 *
 * 1. include the files that do config (ie. define constants)
 * 2. include the files that load dependencies (ie. define classes, functions, or auto loaders)
 * 3. include the files that initialize WordPress (ie. post types, nav menu's, hooks/filters, etc.)
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'JM_CORE_DIR', dirname( __DIR__ ) );

// require the environment specific config file (in WP root)
if ( file_exists( $theme_env_config = ABSPATH . '/_theme-env-config.php' ) ) {
    require $theme_env_config;
} else {

    // fail on the front-end only, allowing de-activation of mis-configured theme from wp-admin.
    if ( ! is_admin() ) {
        throw new Exception( "Theme environment config file must exist even if empty." );
    }
}

// config
require __DIR__ . '/config-global.php';

// dependencies
require __DIR__ . '/includes.php';

// in the config file, we may need this if we need to modify a class that's not included yet.
do_action( 'jm_after_includes' );

// auto include all files in a directory.
// the intended purpose is to only put setup related tasks in here.
// not at all intended for function or class definitions.
// this makes it very convenient to break things into small tasks, without having to
// manually include new files each time. It should be easy to find what you are looking
// for just by reading the filenames.
// todo: if include order needs to be explicit, then how much does this even help?
// todo: can this have a better name (sounds similar to includes.php but is meant for "setup")
array_map( function( $path ){
    include $path;
}, glob(JM_CORE_DIR . '/auto-include/*.php') );

do_action( 'jm_after_includes' );

// todo: is setup a good name for this?
require __DIR__ . '/setup.php';

do_action( 'jm_after_setup' );