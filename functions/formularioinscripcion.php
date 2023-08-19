<?php
add_action( 'wp_enqueue_scripts', 'wpdocs_inscripcion' );
function wpdocs_inscripcion() {
	global $pagenow;
	global $wp_query;
	$pagename=isset($wp_query->query['pagename'])?$wp_query->query['pagename']:'';
	if($pagename=="inscripcion"){
		wp_register_script('inscripcion', get_stylesheet_directory_uri().'/vendor/js/inscripcion.js', array('jquery'), '1.1'.date('YmdHis'),true);
		wp_enqueue_script('inscripcion');
		//wp_enqueue_style( 'regalos_style', get_stylesheet_directory_uri().'/vendor/css/regalos.css','1.1'.date('YmdHis') );
	}
}

add_action('wp_ajax_nopriv_inscripcion20','inscripcion20');
add_action('wp_ajax_inscripcion20','inscripcion20');
function inscripcion20(){
	$user_name=sanitize_user( $_POST['Email']);
	$user_email=sanitize_user( $_POST['Email']);
	$user_id = username_exists( $user_name );
	if ( !$user_id and email_exists($user_email) == false ) {
		$random_password = $_POST['password'];
		$user_id = wp_create_user( $user_name, $random_password, $user_email );
		$u = new WP_User( $user_id);
		$u->remove_role( 'customer' );
		$u->add_role( 'inscripcion' );
		wp_set_auth_cookie( $user_id, false, is_ssl() );
		$mailer = WC()->mailer();
		$recipient = $user_email;
		$subject = "Proceso de Inscripción";
		$content = get_custom_email_html_inscripcion20( $user_id, $subject, $mailer );
		$headers = "Content-Type: text/html\r\n";
		$mailer->send( $recipient, $subject, $content, $headers );
		$user_id=array('id'=>$user_id,'url'=>site_url('tienda'));
	} else {
		$random_password = 'Este usuario ya existe';	
		$user_id=array('error'=>true,'msg'=>'Este usuario ya existe');
	}
	wp_send_json($user_id);
}

function get_custom_email_html_inscripcion20( $user_id, $heading = false, $mailer ) {
	$template = 'emails/inscripcion.php';
	return wc_get_template_html( $template, array(
		'order'         => $user_id,
		'email_heading' => $heading,
		'sent_to_admin' => true,
		'plain_text'    => false,
		'email'         => $mailer
	) );
}


// Shortcode de formulario
function insc_func() {	
	ob_start();
	$country=getPaisIp();
	if($country->status=='success'){
		//echo '<pre>'.print_r($country,1).'</pre>';
		$siglas=$country->countryCode;
	}
	global $wp_query;
	?>
	<div class="card mb-3 inscribete bg-light text-dark">
		<p class="mb-3"><?php pll_e('sign-page-welcome');?></p>
		<small>Nos visitas de <?php echo $siglas; ?> <img class="ml-2" src="https://www.countryflags.io/<?php echo $siglas;?>/flat/24.png" onerror="this.onerror=null;this.src='https://flagcdn.com/<?php echo mb_strtolower($siglas);?>.svg';" width="32"></small>
	</div>
	
	<form class="inscribete">
		<div class="form-group row">
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Patrocinador <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9"><?php
				$end=substr($wp_query->query_vars['numempresario'],2,99);
				$pp=substr($wp_query->query_vars['numempresario'],0,2);
				
				if(is_numeric($end)){
					//echo $end;
					$empObj = getDatoEmpresarioLebasi($end,$pp);
					$siglasemp=$pp;
					set_micrositio_cookie($pp.'-'.$end);
					//echo '<pre>'.print_r($empObj,1).'</pre>';
				}else{
					$d=get_micrositio_cookie();
					if($d){
						$dist = explode("-", $d);
						$siglasemp=$dist[0];
						$end=$dist[1];
						$empObj = getDatoEmpresarioLebasi($dist[1],$dist[0]);
					}
				}
				
				if($empObj->status=='ok'){?>
					<div class="row">
						<div class="col-1">
							<img class="mr-1" src="https://www.countryflags.io/<?php echo $siglasemp;?>/flat/24.png" onerror="this.onerror=null;this.src='https://flagcdn.com/<?php echo mb_strtolower($siglasemp);?>.svg';" width="32">
						</div>
						<input class="patrocina form-control col-11" type="text"  value="<?php echo $end.' | '.$empObj->data->Empresario;?>" disabled>
						<input id="hiddenPatrocina" type="hidden" name="datos[patrocinador]" value="<?php echo rtrim($empObj->data->NumEmpresario);?>">
						<small id="AMaternoh" class="form-text text-muted">Tu registro quedará bajo este patrocinador</small>
					</div><?php
				}?>
			</div>
		</div>
		<div class="form-group row">
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Apellido Paterno <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="Apaternoh" placeholder="Apellido Paterno" name="APaterno" required>
				<small id="AMaternoh" class="form-text text-muted">Proporciona tu Apellido Paterno</small>
			</div>
		</div>
		<div class="form-group row" >
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Apellido Materno <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" aria-describedby="AMaternoh" placeholder="Apellido Materno" name="AMaterno" required>
				<small id="AMaternoh" class="form-text text-muted">Proporciona tu Apellido Materno</small>
			</div>
		</div>
		<div class="form-group row" >
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Nombre(s) <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" aria-describedby="AMaternoh" placeholder="Nombre" name="Nombre" required>
				<small id="AMaternoh" class="form-text text-muted">Proporciona tu Nombre</small>
			</div>
		</div>
		<div class="form-group row" >
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Teléfono <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" aria-describedby="AMaternoh" placeholder="Teléfono" name="Telefono" required>
				<small id="AMaternoh" class="form-text text-muted">Proporciona un teléfono de contacto</small>
			</div>
		</div>
		<div class="form-group row" >
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Email <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" aria-describedby="AMaternoh" placeholder="Correo Electrónico" name="Email" required>
				<small id="AMaternoh" class="form-text text-muted">Proporciona un correo electrónico</small>
			</div>
		</div>
		<div class="form-group row" >
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Password <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input class="form-control woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</div>
		</div>
		<div class="form-group row" >
			<input type="hidden" name="action" value="inscripcion20">
			<div class="col-sm-9 offset-sm-3">
				<button class="btn btn-success" type="submit">Registrarse</button>
			</div>
		</div>
		
	</form>
	<?php
	$contenido = ob_get_contents();
	ob_end_clean();
	return $contenido;
}
add_shortcode( 'form_inscripcion', 'insc_func' );


// Shortcode de formulario
function micrositio_func() {	
	ob_start();
	$country=getPaisIp();
	if($country->status=='success'){
		$siglas=$country->countryCode;
		//echo '<pre>'.print_r($country,1).'</pre>';
	}
	global $wp_query;
	
	global$wpdb;
	
	$distribuidor=$wp_query->query_vars['numdistribuidor'];
	$tablename=$wpdb->prefix.'postmeta';
	$idpost=$wpdb->get_var("select post_id from {$tablename} where meta_key='slug' and meta_value='{$distribuidor}'");
	$foto=get_field('foto',$idpost);
	
	$end=get_field('dist',$idpost);
	$pp=get_field('pais',$idpost);
	set_micrositio_cookie($pp.'-'.$end);
	if(is_numeric($end)){
		//echo $end;
		$empObj = getDatoEmpresarioLebasi($end,$pp);
		$siglasemp=$pp;
		//echo '<pre>'.print_r($empObj->data,1).'</pre>';	
	}?>

		<h2 class="h1 m-0" >Distribuidor Oficial Lebasi</h2>
		<div class="row mt-4">
			<div class="col-12">
				<div class="mb-3 bg-light text-dark p-3"><?php
					if($empObj->status=='ok'){?>
					<div class="row">
						<div class="col-3">
							<img class="img-fluid" src="<?php echo $foto['sizes']['thumbnail'];?>" width="128">
						</div>
						<div class="col-9">
							<h3 class="text-left"><?php echo $empObj->data->Empresario;?></h3>
							<p class="text-left"><img class="mr-1" src="https://www.countryflags.io/<?php echo $siglasemp;?>/shiny/32.png" onerror="this.onerror=null;this.src='https://flagcdn.com/<?php echo mb_strtolower($siglasemp);?>.svg';" width="32">Distribuidor Oficial Lebasi </p>
							<p><a href="mailto:<?php echo $empObj->data->Email;?>"><strong><?php echo $empObj->data->Email;?></strong></a></p>
						</div>
					</div><?php
					} ?>
				
					<small>Nos visitas de <?php echo $siglas; ?> <img class="ml-2" src="https://www.countryflags.io/<?php echo $siglas;?>/flat/24.png" onerror="this.onerror=null;this.src='https://flagcdn.com/<?php echo mb_strtolower($siglas);?>.svg';" width="32"></small>
				</div>
				<h3 class="text-center mt-2"><?php pll_e('buy-home');?></h3>
				<div class="row m-0 p-0"><?php
					$slider_products_q = new WP_Query([
						 'posts_per_page'    => 3,
						  'post_type'         => 'product',
						  'orderby'           => 'date',
						  'order'             => 'ASC',
						  'tax_query'            => array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'term_id', // Or 'name' or 'term_id'
									'terms'    => array(164,166),
									'operator' => 'NOT IN', // Excluded
								)
							)
					]);
					
					
					if ($slider_products_q->have_posts()):
						while($slider_products_q->have_posts()):
							$slider_products_q->the_post();         
							$product_id = get_the_ID();
							$product = wc_get_product($product_id);
							$price_html = $product->get_price_html();
							$image_id  = $product->get_image_id();
							$image_url = wp_get_attachment_image_url( $image_id, 'medium' );
							$add_to_cart_url = $product->add_to_cart_url();?>
						
							<div class="col-12 col-md-4 col-sm-4">
								<div class="single-new-arrival">
									<div class="single-new-arrival-bg">
										<a href="<?php echo $add_to_cart_url; ?>" class="p-1 d-block"><img  class="img-fluid" src="<?php echo $image_url;?>" alt="images"></a>
										<div class="single-new-arrival-bg-overlay"></div>
										<div class="new-arrival-cart">
											<p class="text-center">
												<span class="lnr lnr-cart"></span>
												<a class="add-to-cart btn btn-primary text-white" href="<?php echo $add_to_cart_url; ?>">
													Agregar a carrito
												</a>
											</p>
										</div>
									</div>
									<h5 class="text-center"><a href="<?php echo $add_to_cart_url; ?>"><?php  echo $product->get_title(); ?></a></h5>
									<p class="arrival-product-price h3 text-center"><strong><?php echo $product->get_price_html();?></strong></p>
								</div>
							</div><?php
						endwhile;
					endif; ?>
				</div>
				<h4 class="text-center text-dark"><?php pll_e('quieres-micrositio');?><br>
					<a href="<?php echo site_url('inscripcion')."/".$pp.$end;?>" class="btn-primary btn btn-lg mt-4"><?php pll_e('insc-micrositio')?></a>
				</h4>
				<div class="row">
					<div class="resena p-3 col-12 col-md-8">
						<div class="embed-container p-2">
							<?php the_field('video',$idpost); ?>
						</div>
						<div class="content p-2 mt-4">
						<?php $lang=pll_current_language();
						if($lang=='es'){
							the_field('resena_espanol',$idpost);
						}else if($lang=='en'){
							the_field('resena_english',$idpost);
						}else if($lang=='fr'){
							the_field('resena_francais',$idpost);
						}?>
						</div>
					</div>
					<!--Sidebar-->
					<div class="col-12 col-md-4 sidebar">
						<h3 class="text-center text-primary mb-2"  >Artículos de interes</h3>
						<div class="m-0 p-4"><?php 
							$loop = new WP_Query( array(
									'post_type' => 'post',
									'posts_per_page' => 5,
									'category__not_in' => array('78') ,
								)
							);
							while ( $loop->have_posts() ) : $loop->the_post();
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
								$cat=get_the_category();?>
								<div class="card">
									<a href="<?php the_permalink();?>">
										<div>
											<img class="img-fluid w-100" src="<?php echo $featured_img_url; ?>" onError="this.src=https://dummyimage.com/600x400/f0f0f0/bababa.jpg">
										</div>
										<div class="bg-light p-3 title-card">
											<div class="cat"><?php echo $cat[0]->name;?></div>
											<div class="title text-center text-dark"><?php the_title();?></div>
										</div>
									</a>
								</div><?php
							endwhile;?>
						</div>
					</div>
				</div>
			</div>
		</div><?php
	$contenido = ob_get_contents();
	ob_end_clean();
	return $contenido;
}
add_shortcode( 'micrositio', 'micrositio_func' );


// Shortcode de negociojoven
function negocio_func() {	
	ob_start();
	$country=getPaisIp();
	if($country->status=='success'){
		$siglas=$country->data->geo->country_code;
	}
	global $wp_query;
	
	global$wpdb;
	
	$distribuidor=$wp_query->query_vars['numsocio'];
	$tablename=$wpdb->prefix.'postmeta';
	$idpost=$wpdb->get_var("select post_id from {$tablename} where meta_key='slug' and meta_value='{$distribuidor}'");
	$foto=get_field('foto',$idpost);
	
	$end=get_field('dist',$idpost);
	$pp=get_field('pais',$idpost);
	set_micrositio_cookie('MICROSITIO-'.$distribuidor);
	
	if(is_numeric($end)){
		//echo $end;
		$empObj = getDatoEmpresarioLebasi($end,$pp);
		$siglasemp=$pp;
		//echo '<pre>'.print_r($empObj,1).'</pre>';	
	}?>

		<h2 class="h1 m-0" >Compra Lebasi</h2>
		<div class="row mt-4">
			<div class="col-12">
				<div class="mb-3 bg-light text-dark p-3"><?php
					if($empObj->status=='ok'){?>
					<div class="row">
						<div class="col-3">
							<img class="img-fluid" src="<?php echo $foto['sizes']['thumbnail'];?>" width="128">
						</div>
						<div class="col-9">
							<h3 class="text-left"><?php echo $empObj->data->Empresario;?></h3>
							<p class="text-left"><img class="mr-1" src="https://www.countryflags.io/<?php echo $siglasemp;?>/shiny/32.png" onerror="this.onerror=null;this.src='https://flagcdn.com/<?php echo mb_strtolower($siglasemp);?>.svg';" width="32">Distribuidor Oficial Lebasi </p>
							<p><a href="mailto:<?php echo $empObj->data->Email;?>"><strong><?php echo $empObj->data->Email;?></strong></a></p>
						</div>
					</div><?php
					} ?>
					<p>Hola soy el distribuidor <?php echo $distribuidor;?></p>
				
					<small>Nos visitas de <?php echo $siglas; ?> <img class="ml-2" src="https://www.countryflags.io/<?php echo $siglas;?>/flat/24.png" onerror="this.onerror=null;this.src='https://flagcdn.com/<?php echo mb_strtolower($siglas);?>.svg';" width="32"></small>
				</div>
				<h3 class="text-center mt-2"><?php pll_e('buy-home');?></h3>
				<div class="row m-0 p-0"><?php
					$slider_products_q = new WP_Query([
						 'posts_per_page'    => 3,
						  'post_type'         => 'product',
						  'orderby'           => 'date',
						  'order'             => 'ASC',
						  'tax_query'            => array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'term_id', // Or 'name' or 'term_id'
									'terms'    => array(164,166),
									'operator' => 'NOT IN', // Excluded
								)
							)
					]);
					
					
					if ($slider_products_q->have_posts()):
						while($slider_products_q->have_posts()):
							$slider_products_q->the_post();         
							$product_id = get_the_ID();
							$product = wc_get_product($product_id);
							$price_html = $product->get_price_html();
							$image_id  = $product->get_image_id();
							$image_url = wp_get_attachment_image_url( $image_id, 'medium' );
							$add_to_cart_url = $product->add_to_cart_url();?>
						
							<div class="col-12 col-md-4 col-sm-4">
								<div class="single-new-arrival">
									<div class="single-new-arrival-bg">
										<a href="<?php echo $add_to_cart_url; ?>" class="p-1 d-block"><img  class="img-fluid" src="<?php echo $image_url;?>" alt="images"></a>
										<div class="single-new-arrival-bg-overlay"></div>
										<div class="new-arrival-cart">
											<p class="text-center">
												<span class="lnr lnr-cart"></span>
												<a class="add-to-cart btn btn-primary text-white" href="<?php echo $add_to_cart_url; ?>">
													Agregar a carrito
												</a>
											</p>
										</div>
									</div>
									<h5 class="text-center"><a href="<?php echo $add_to_cart_url; ?>"><?php  echo $product->get_title(); ?></a></h5>
									<p class="arrival-product-price h3 text-center"><strong><?php echo $product->get_price_html();?></strong></p>
								</div>
							</div><?php
						endwhile;
					endif; ?>
				</div>
				<h4 class="text-center text-dark"><?php pll_e('quieres-micrositio');?><br>
					<a href="<?php echo site_url('inscripcion')."/".$pp.$end;?>" class="btn-primary btn btn-lg mt-4"><?php pll_e('insc-micrositio')?></a>
				</h4>
				<div class="row">
					<div class="resena p-3 col-12 col-md-8">
						<div class="embed-container p-2">
							<?php the_field('video',$idpost); ?>
						</div>
						<div class="content p-2 mt-4">
						<?php $lang=pll_current_language();
						if($lang=='es'){
							the_field('resena_espanol',$idpost);
						}else if($lang=='en'){
							the_field('resena_english',$idpost);
						}else if($lang=='fr'){
							the_field('resena_francais',$idpost);
						}?>
						</div>
					</div>
					<!--Sidebar-->
					<div class="col-12 col-md-4 sidebar">
						<h3 class="text-center text-primary mb-2" data-aos="flip-down" data-aos-delay="650">Artículos de interes</h3>
						<div class="m-0 p-4"><?php 
							$loop = new WP_Query( array(
									'post_type' => 'post',
									'posts_per_page' => 5,
									'category__not_in' => array('78') ,
								)
							);
							while ( $loop->have_posts() ) : $loop->the_post();
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
								$cat=get_the_category();?>
								<div class="card" data-aos="zoom-in-up" data-aos-delay="1000">
									<a href="<?php the_permalink();?>">
										<div>
											<img class="img-fluid w-100" src="<?php echo $featured_img_url; ?>" onError="this.src=https://dummyimage.com/600x400/f0f0f0/bababa.jpg">
										</div>
										<div class="bg-light p-3 title-card">
											<div class="cat"><?php echo $cat[0]->name;?></div>
											<div class="title text-center text-dark"><?php the_title();?></div>
										</div>
									</a>
								</div><?php
							endwhile;?>
						</div>
					</div>
				</div>
			</div>
		</div><?php
	$contenido = ob_get_contents();
	ob_end_clean();
	return $contenido;
}
add_shortcode( 'negociojoven', 'negocio_func' );


//Hacemos una cookie para guardar al distribuidor
function set_micrositio_cookie($dist) { 
	setcookie('lebasi_micrositio_dist', $dist, time()+86400,COOKIEPATH, COOKIE_DOMAIN );
}

function get_micrositio_cookie() {
	$lastvisit=false;
	if(isset($_COOKIE['lebasi_micrositio_dist'])) { 
		$lastvisit = $_COOKIE['lebasi_micrositio_dist'];
	}
	return $lastvisit;
}   

//Añadimos el distribuidor en la orden
add_action('woocommerce_checkout_create_order', 'before_checkout_create_order', 20, 2);
function before_checkout_create_order( $order, $data ) {
	if(get_micrositio_cookie()){
		$order->update_meta_data( 'distribuidor', get_micrositio_cookie() );
	}
}

// display the extra data in the order admin panel
function lebasi_order_data_in_admin( $order ){  ?>
    <div class="form-field form-field-wide">
        <h3><?php _e( 'Distribuidor' ); ?></h3>
        <?php
			$is_dist = get_post_meta( $order->get_order_number(), 'distribuidor', true );
			$dist = explode("-", $is_dist);
			$empObj = getDatoEmpresarioLebasi($dist[1],$dist[0]);
            echo '<p><strong class="h6 text-primary">' . $is_dist .' <br>'.$empObj->data->Empresario. '</strong></p>';
			?>
    </div>
<?php }
add_action( 'woocommerce_admin_order_data_after_order_details', 'lebasi_order_data_in_admin' );

add_action( 'woocommerce_email_before_order_table', 'misha_add_email_order_meta', 10, 4 );
function misha_add_email_order_meta( $order, $sent_to_admin, $plain_text){
	// this order meta checks if order is marked as a gift
	$is_dist = get_post_meta( $order->get_order_number(), 'distribuidor', true );
	if( empty( $is_dist ) )
		return;
	
	$dist = explode("-", $is_dist);
	$empObj = getDatoEmpresarioLebasi($dist[1],$dist[0]);
	echo '<div style="line-height:12px;"> desde el micrositio:';
	echo '<h4 style="margin-top:3px;">'.$is_dist.' '.$empObj->data->Empresario.' '.'<img class="mr-1" src="https://flagcdn.com/<?php echo mb_strtolower($dist[0]);?>.svg" width="32"></h4></div>';
}	