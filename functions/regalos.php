<?php

add_action( 'woocommerce_before_cart_table', 'wpdesk_cart_free_shipping_text' );
function wpdesk_cart_free_shipping_text() {
	global $wp_siglas;
	if($siglas=='MEX'):
		//4055 Paquete 3
		global $woocommerce;
		$items = $woocommerce->cart->get_cart();
		$ids = array();
		foreach($items as $item => $values) { 
				$_product = $values['data']->post; 
				//push each id into array
				$ids[] = $_product->ID; 
		} 

		$last_product_id = end($ids);
		$giftsproductarray=array(4055);
		if(in_array($last_product_id,$giftsproductarray)):
		$giftallowed=in_array($last_product_id,array(4055))?3:1;?>
		<div class="modalregalos">
			<div class="regalos bg-white pt-3" data-gifts="<?php echo $giftallowed;?>"><?php
				$args = array(
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'posts_per_page'        => -1,
					'tax_query'             => array(
						array(
							'taxonomy'      => 'product_cat',
							'field' => 'term_id', //This is optional, as it defaults to 'term_id'
							'terms'         => 164,
							'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
						)
					)
				);
				$products = new WP_Query($args);
				if ($products->have_posts()):?>
					<h3>Lebasi te da <?php echo $giftallowed;?> regalo(s)</h3>
					<h5 class="text-center">Escoge tu regalos de estos increibles productos disponibles</h5>
					<div class="row p-3"><?php
					while($products->have_posts()):
						$products->the_post();         
						$product_id = get_the_ID();
						$product = wc_get_product($product_id);
						$price_html = $product->get_price_html();
						$image_id  = $product->get_image_id();
						$image_url = wp_get_attachment_image_url( $image_id, 'medium' );
						$add_to_cart_url = $product->add_to_cart_url();?>
						<div class="col-12 col-md-4 p-1 m-0">
							<div class="card giftleb" data-id="<?php echo $product_id;?>">
								<div class="text-center" style="line-height:1em; min-height:33px;"><?php the_title(); ?></div>
								<img src="<?php echo $image_url;?>" width="180" class="img-fluid p-1">
							</div>
						</div><?php
					endwhile;?>
					</div><?php
				endif;
				wp_reset_query();?>
				<div class="row">
					<div class="col-12 col-md-6 text-center px-4 pb-2">
						<button type="button" class="btn btn-warning w-100" id="giftnothanks"> No, gracias.</button>
					</div>
					<div id="gifsearch">
						<input type="hidden" name="action" value="giftsprocess">
					</div>
					<div class="col-12 col-md-6 text-center px-4 pb-2">
						<button type="button" class="btn btn-success w-100 giftbtn" disabled> Añadir regalos</button>
					</div>
				</div>
			</div>
		</div><?php
		endif;
	endif;
}


//Cargamos stilos y scripts
add_action( 'wp_enqueue_scripts', 'wpdocs_regalos' );
function wpdocs_regalos() {
	global $pagenow;
	global $wp_query;
	if(is_cart()){
		wp_register_script('regalos', get_stylesheet_directory_uri().'/vendor/js/regalos.js', array('jquery'), '1.1'.date('YmdHis'),true);
		wp_enqueue_script('regalos');
		wp_enqueue_style( 'regalos_style', get_stylesheet_directory_uri().'/vendor/css/regalos.css','1.1'.date('YmdHis') );
	}
}

add_action('wp_ajax_giftsprocess','giftsprocess');
add_action('wp_ajax_nopriv_giftsprocess','giftsprocess');

function giftsprocess(){
	foreach($_POST['search'] as $ss){
		WC()->cart->add_to_cart( $ss );
	}
	wc_add_notice( 'Se agregaron 3 productos a tu carrito por promoción Lebasi', 'notice' );
	wp_send_json($_POST);
}


//VALIDACIONES DEL CARRITO
add_filter( 'woocommerce_add_to_cart_validation', 'wc_limit_one_per_order', 10, 2 );
function wc_limit_one_per_order( $passed_validation, $product_id ) {
	return $passed_validation;
}


function wc_remove_all_quantity_fields( $return, $product ) {
	if($product->get_data()['category_ids'][0]==1643){
		return true;
	}else{
		return $return;
	}
}
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );