<?php
/**
 * Register most ajax actions here.
 *
 * In case we need to use the globally defined object elsewhere, it is defined
 * in the config-global.php file, which runs quite early.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// run this all quite late...
add_action( 'after_theme_setup', function(){

    /**
     * The function exists for easier access.
     *
     * Define the function here since it creates and configured the global instance.
     *
     * @return mixed
     */
    function jm_ajax_config(){
        global $_ajaxConfig;

        if ( ! $_ajaxConfig ){
            $_ajaxConfig = new \JM\Ajax_Config( "global_ajax", "_sub_action", "_nonce" );
        }

        return $_ajaxConfig;
    }

    // contact form callback
    jm_ajax_config()->register( "contact_form", "nonce-seed-237123", function(){
        include JM_AJAX_DIR . '/contact-form.php';
    });

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
});




