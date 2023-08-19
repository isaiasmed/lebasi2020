<?php
define('WP_USE_THEMES', false);
require ('../../../../wp-blog-header.php');
if ( ! function_exists( 'wp_handle_upload' ) )
require_once( '../../../../wp-admin/includes/file.php' );


if (!empty($_FILES)) {
	//echo '<pre>'.print_r($_FILES,1).'</pre>';
	$tempFile = $_FILES['file']['tmp_name'];   
    $prepFile = $_FILES['file'];       
    $upload_overrides = array( 'test_form' => false );
    $movefile = wp_handle_upload( $prepFile, $upload_overrides );
	//echo '<pre>'.print_r($movefile,1).'</pre>';
	$filename=$movefile['file'];
	$filetype = wp_check_filetype( basename( $filename ), null );
	$parent_post_id=0;
	// Get the path to the upload directory.
	$wp_upload_dir = wp_upload_dir();

	// Prepare an array of post data for the attachment.
	$attachment = array(
		'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	// Insertar el attachment
	$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

	// Asegurar que la funcion para el thumbnail este incluida
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	//Actualizar la base de datos con el attachment
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	set_post_thumbnail( $parent_post_id, $attach_id );
	$attachment['post_id']=$attach_id;
	//echo '<pre>'.print_r($attachment,1).'</pre>';
	wp_send_json($attachment);
}