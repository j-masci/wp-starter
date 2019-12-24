<?php
/**
 * Register most ajax actions here.
 *
 * In case we need to use the globally defined object elsewhere, it is defined
 * in the config-global.php file, which runs quite early.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// contact form callback
jm_ajax_config()->register( "contact_form", "nonce-seed-237123", function(){
    include JM_AJAX_DIR . '/contact-form.php';
});

// do this part late, in case files other than this one register their own handlers.
add_action( 'jm_after_setup', function(){

    // register the global ajax callback, which all individual handlers run through.
    jm_ajax_config()->commit( function( $ajax ){
        /** @var \JM\Ajax_Config $ajax */

        // verify nonce/csrf
        if ( ! $ajax->verify_nonce( $_REQUEST ) ) {
            jm_ajax_response_and_exit( 'error', [ "Nonce error" ] );
        }

        // get the handler
        if ( ! $handler = $ajax->get( $ajax->get_request_key( $_REQUEST ) ) ) {
            jm_ajax_response_and_exit( 'error', [ "Malformed request error" ] );
        }

        // invoke the individual handler
        call_user_func_array( $handler['callback'], [] );
    });
}, 1000 );
