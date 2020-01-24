<?php
/**
 * Not actually using this class... just an example of a custom post type.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

Class JM_Contact_Form_Record extends \JMasci\WP\Post_Type_Static_Methods {

    const POST_TYPE = "contact_form_submit";

    /**
     *
     */
    public static function init(){

        // in some cases we can register the post type here
        // register_post_type( static::POST_TYPE, []);

        self::$meta_keys = new JM_Contact_Form_Record_Meta_Keys();
    }

    /**
     * Seeing as we already defined the meta keys explicitly, I would
     * suggest that you don't have to have a getter method for
     * every single property.
     *
     * @param $post_id
     * @return mixed
     */
    public function get_ip( $post_id ){
        return self::get_meta( $post_id, self::$meta_keys->ip );
    }
}

// meta keys struct
Class JM_Contact_Form_Record_Meta_Keys{
    public $name = "_name";
    public $email = "_email";
    public $referer = "_referer";
    public $ip = "_ip";
}

// init right away since we can (no undefined deps)
JM_Contact_Form_Record::init();