<?php
/**
 * add columns to wp-admin edit.php
 */

use JMasci\WP\Admin_Columns;

if ( ! defined( 'ABSPATH' ) ) exit;

Admin_Columns::insert( [ 'page' ], "_page_template", "Page Template", function( $post_id ) {

}, 1 );


Admin_Columns::insert( [ 'page', 'post' ], "_feat_img", "Featured Image", function( $post_id ) {

    $attachment_id = get_post_thumbnail_id( $post_id );

    if ( $attachment_id ) {

        $src = @wp_get_attachment_image_src( $attachment_id, 'thumbnail' )[0];

        ?>
        <img src="<?= esc_attr( $src ); ?>" alt="Attachment ID <?= (int) $attachment_id; ?>" style="width: 70px; height: auto;">
        <?php
    }
}, 1 );


