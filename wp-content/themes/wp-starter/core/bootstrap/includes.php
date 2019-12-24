<?php
/**
 * Load dependencies
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// include the file conditionally I suppose, to support themes
// that don't use composer.
if( file_exists( ABSPATH . '/vendor/autoload.php' ) ) {
    require_once ABSPATH . '/vendor/autoload.php';
}

// probably best to do after composer
require JM_THEME_DIR . '/wp-helpers/_autoload.php';

require JM_CORE_DIR . '/modules/ajax.php';
