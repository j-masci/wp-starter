<?php
/**
 * Not actually using this class... just an example of a custom post type.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

Class JM_Contact_Form_Record extends \JM\Post_Type_Superclass{

    const POST_TYPE = "contact_form_submit";

    /**
     *
     */
    public static function init(){

        // we could do this here, but, really depends on the context.
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
        return self::meta( $post_id, self::$meta_keys->ip );
    }
}

// example of how to define meta keys...
// probably, you would have a few more than what's below.
Class JM_Contact_Form_Record_Meta_Keys{
    public $name = "_name";
    public $email = "_email";
    public $referer = "_referer";
    public $ip = "_ip";
}

// so long as init doesn't require special dependencies, we could do this here, although,
// bad practice to do it here in some cases.
JM_Contact_Form_Record::init();