<?php
function action_woocommerce_order_status_processing( $order_id ) { 
	global $woocommerce;
	$order = new WC_Order( $order_id );
	$cupons=array();
	if($order->get_coupon_codes()){
		foreach( $order->get_coupon_codes() as $coupon_code )
		{
			$c = new WC_Coupon($coupon_code);
			$cupons[]=$c;
			//$cupons[]=$coupon_code;
		}
		//wp_mail('medinaramirez.isaias@gmail.com','Prueba','<pre>'.print_r($cupons->get_email_restrictions()[0],1).'</pre>');
	}
}; 
add_action( 'woocommerce_order_status_processing', 'action_woocommerce_order_status_processing', 10, 1 );


add_filter('manage_edit-shop_order_columns', 'add_micrositio_column', 11);    
function add_micrositio_column($columns) {
    $columns['micrositio'] = "Micrositio";
    return $columns;
}

function custom_book_column( $column, $post_id ) {
	if($column=='micrositio'){
      
        echo get_post_meta( $post_id , 'distribuidor' , true ); 
        

    }
}
add_action( "manage_shop_order_posts_custom_column", 'custom_book_column', 20, 2 );