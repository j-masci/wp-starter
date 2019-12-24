<?php
/**
 * ajax related functions for our theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Print a JSON response and exit.
 *
 * This is either temporary or only for the very simple use case.
 *
 * @param $status
 * @param $response - an array of response messages to the user
 * @param $extra - anything else you want to include
 */
function jm_ajax_response_and_exit( $status, array $response, array $extra = [] ){

    echo json_encode( [
        'status' => $status,
        'response' => $response,
    ], $extra );

    exit;
}