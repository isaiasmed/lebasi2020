<?php
function backoffice_custom_endpoint() {
  add_rewrite_endpoint( 'lebasi', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'comisiones', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'envios', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'compras', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'pedidos', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'ordencompra', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'tienda', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'comparte', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'red', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'reportes', EP_ROOT | EP_PAGES );
  flush_rewrite_rules();
}
add_action( 'init', 'backoffice_custom_endpoint' );

add_filter( 'woocommerce_account_menu_items', 'wk_new_menu_items' );

function my_get_current_user_roles(){ 
	if(is_user_logged_in()){
		$user = wp_get_current_user();
		$roles = ( array ) $user->roles;
		return $roles;
	}else{
		return array();
	}
}

add_action( 'woocommerce_before_account_navigation', 'agregar_emp_account' );
function agregar_emp_account() {
	$roles=my_get_current_user_roles();
	$user = wp_get_current_user();
	$userid=$user->ID;

	if(in_array('administrator',$roles) || in_array('distribuidor',$roles)){
		$emp=get_field('numempresario','user_'.$userid);
		$pais=get_field('pais','user_'.$userid);
		$data=getApiLebasi('ObtenerDatosEmpresario',$emp,$pais);
		//echo '<pre>'.print_r($data,1).'</pre>';
		echo ('<div class="emp-info">'.$pais.' '.$emp.' <span>'.$data->data->Empresario.'</span></div>');
	}
}

function wk_new_menu_items( $items ) {
	
	$roles=my_get_current_user_roles();
	$user = wp_get_current_user();
	$userid=$user->ID;
	$emp=get_field('numempresario','user_'.$userid);
	$pais=get_field('pais','user_'.$userid);
	if(in_array('administrator',$roles) || in_array('distribuidor',$roles)){
		$items=array();
		$items[ 'lebasi' ] = 'Mi cuenta Lebasi';
		$items[ 'comisiones' ] = 'Reporte Comisiones';
		$items[ 'red' ] = 'Reporte Red';
		$items[ 'comparte' ] = 'Comparte';
		$items[ 'compras' ] = 'Mis Compras';
		$items[ 'pedidos' ] = 'MIs Pedidos';	
		$items[ 'envios' ] = 'Direcciones de Envío';	
		$items[ 'ordencompra' ] = 'Nueva Orden de Compra';
		$items[ 'tienda' ] = 'Tienda Distribuidor';
		$items[ 'reportes' ] = 'Reportes';
	}
    return $items;
}
$endpoint = 'lebasi';
$endpoint2 = 'envios';
$endpoint3 = 'compras';
$endpoint4 = 'envios';
$endpoint5 = 'comisiones';
$endpoint6 = 'tienda';
$endpoint7 = 'comparte';
$endpoint8 = 'red';
$endpoint9 = 'reportes';



add_action('woocommerce_account_'.$endpoint.'_endpoint', $endpoint.'_endpoint_content');
function lebasi_endpoint_content() {
	//como cambio el titulo desde aqui?
	echo 'LEBASI';
	wc_page_endpoint_title('HOLA');
}

add_action( 'woocommerce_account_' . $endpoint3 .  '_endpoint', $endpoint3.'_endpoint_content' );
function compras_endpoint_content() {
	$roles=my_get_current_user_roles();
	$user = wp_get_current_user();
	$userid=$user->ID;
	$emp=get_field('numempresario','user_'.$userid);
	$pais=get_field('pais','user_'.$userid);
	$data=getApiLebasi('Compras',$emp,$pais);
	$data=$data->data;
	$remisiones=$data->invoices;?>
	<h2>Compras en Lebasi</h2>
	<table id="tableremisiones" class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th>Remision</th>
				<th>Fecha</th>
				<th>Mes Comisión</th>
			</tr>
		</thead>
		<tbody><?php
			foreach($remisiones as $vv){?>
				<tr>
					<td><?php echo $vv->ClaveSucursal.' ',$vv->NumRemision;?></td>
					<td><?php echo $vv->Fecha;?></td>
					<td><?php echo $vv->MesComision;?></td>
				</tr><?php
			}?>
		</tbody>
	</table><?php
}
add_action( 'woocommerce_account_' . $endpoint8 .  '_endpoint',  $endpoint8.'_endpoint_content' );
function  red_endpoint_content(){
	$roles=my_get_current_user_roles();
	$user = wp_get_current_user();
	$userid=$user->ID;
	$emp=get_field('numempresario','user_'.$userid);
	$pais=get_field('pais','user_'.$userid);

	$data=getApiLebasi('RedEmpresario',$emp,$pais);
	$emp = json_decode(json_encode ( $data ) , true);
	$red=$emp['data']['red'];
	$empres=$emp['data']['empresarios'];?>
	<style>
		.parent a{
			font-size: 25px;
			color: #000;
			font-family: "Source Sans Pro", sans-serif;
			font-weight:bold;
		}
		.child a{
			font-size: 22px;
			color: #000;
			font-weight:normal;
		}
		.subchild a{
			font-size: 20px;
			color: #888888;
			font-weight:normal;
		}
		.s2child a, li {
			font-size: 18px;
			color: #ccc;
		}
		.s3child a{
			 font-size: 16px;
			 color: #9f9f9f;
		}
		.s4child a{
			 font-size: 15px;
			 color: #b9b9b9;
		}
		.tree, .tree ul {
			 list-style-type: none;
			 margin-left: 0 0 0 10px;
			 padding: 0;
			 position: relative;
			 overflow: hidden;
		}
		.tree li {
			 margin: 0 0 0 15px;
			 padding: 0 12px 0 20px;
			 position: relative;
		}
		.tree li::before, .tree li::after {
			 content: '';
			 position: absolute;
			 left: 0;
		}
		.tree li::before {
			border-top: 2px dotted #ff3f3f;
			top: 14px;
			width: 15px;
			height: 0;
		}
		 .tree li:after {
			border-left: 1px solid #ff3f3f;
			height: 100%;
			width: 0px;
			top: -5px;
		}
		/* lower line on list items from the first level because they don't have parents */
		 .tree > li::after {
			 top: 15px;
		}
		/* hide line from the last of the first level list items */
		 .tree > li:last-child::after {
			 display: none;
		}
		/* hide line from before the Home or starting page or first element */
		 .tree > li:first-child::before {
			 display: none;
		}
		 .tree ul:last-child li:last-child:after {
			 height: 20px;
		}
		 .tree a:hover {
			 color: red;
			 font-weight: 500;
			 text-shadow: 1px 2px 2px #F3F3F3;
		}
	</style>
	<ul class="tree">
		<li class="parent"><a href="#">MX 10712 MARIA DEL CARMEN ESCOBAR PEREZ</a>
		  <ul><?php
			foreach($red as $numemp=>$vv){?>
				<li class="child"><a href="#"><?php echo $numemp.' '.$empres[$numemp]['NombreEmpresario']; ?></a><?php
				if(is_array($vv)){?>
					<ul><?php
					foreach($vv as $numemp2=>$vv2){?>
						<li class="subchild"><a href="#"><?php echo $numemp2.' '.substr($empres[$numemp2]['NombreEmpresario'],0,7).' ... '.substr($empres[$numemp2]['NombreEmpresario'],-7); ?></a><?php
						if(is_array($vv2)){?>
							<ul><?php
							foreach($vv2 as $numemp3=>$vv3){?>
								<li class="s2child"><a href="#"><?php echo $numemp3.' '.substr($empres[$numemp3]['NombreEmpresario'],0,7).' ... '.substr($empres[$numemp3]['NombreEmpresario'],-7); ?></a><?php
								if(is_array($vv3)){?>
									<ul><?php
									foreach($vv3 as $numemp4=>$vv4){?>
										<li class="s3child"><a href="#"><?php echo $numemp4.' '.substr($empres[$numemp4]['NombreEmpresario'],0,7).' ... '.substr($empres[$numemp4]['NombreEmpresario'],-7); ?></a><?php
										if(is_array($vv4)){?>
											<ul><?php
											foreach($vv4 as $numemp5=>$vv5){?>
												<li class="s4child last"><a href="#"><?php echo $numemp5.' '.substr($empres[$numemp5]['NombreEmpresario'],0,7).' ... '.substr($empres[$numemp5]['NombreEmpresario'],-7); ?></a></li><?php
											}?>
											</ul><?php
										}?>
										</li><?php
									}?>
									</ul><?php
								}?>
								</li><?php
							}?>
							</ul><?php
						}?>
						</li><?php
					}?>
					</ul><?php
				}?>
				</li><?php
			}?>
			</ul>
		</li>
	</ul><?php
}
add_action( 'woocommerce_account_' . $endpoint6 .  '_endpoint',  $endpoint6.'_endpoint_content' );
function  tienda_endpoint_content(){
	$pais=wcpbc_get_woocommerce_country();
	$prodpais=array(164,166,189,181);
	
	$slider_products_q = new WP_Query([
		 'posts_per_page'    => 10,
		  'post_type'         => 'product',
		  'orderby'           => 'date',
		  'order'             => 'ASC',
		  'tax_query'            => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id', // Or 'name' or 'term_id'
					'terms'    => $prodpais,
					'operator' => 'NOT IN', // Excluded
				)
			)
	]);
	
	
	
				
	if ($slider_products_q->have_posts()):?>
		<div class="row"><?php
		while($slider_products_q->have_posts()):
			$slider_products_q->the_post();         
			$product_id = get_the_ID();
			$product = wc_get_product($product_id);
			$price_html = $product->get_price_html();
			$image_id  = $product->get_image_id();
			$image_url = wp_get_attachment_image_url( $image_id, 'medium' );
			$add_to_cart_url = $product->add_to_cart_url();
			$show=true;
			if($pais=="AR"){
				if(get_the_ID()==4235 || get_the_ID==4226){
					$show=false;
				}
			}
			if($show):?>
			<div class="col-12 col-md-4 col-sm-6 m-3 card product type-product">
				<img class="wp-post-image" style="width:100%; max-height: fit-content;" src="<?php echo $image_url;?>" alt="images">
				<h2 class="woocommerce-loop-product__title"><?php  echo $product->get_title(); ?></h2>
				<span class="price w-100 d-block text-center h4 text-dark"><?php echo $product->get_price_html();?></span>
				<a href="<?php echo $add_to_cart_url;?>" data-hola="2" data-quantity="1" class="btn btn-primary" data-product_id="6559" data-product_sku="" rel="nofollow">Añadir al carrito</a>
			</div><?php
			endif;
		endwhile;?>
		</div><?php
	endif; 
	wp_reset_postdata();
}

add_action( 'woocommerce_account_' . $endpoint7 .  '_endpoint',  $endpoint7.'_endpoint_content' );
function  comparte_endpoint_content(){?>
	<div class="welcome"><?php
		$user = wp_get_current_user();
		$userid=$user->ID;
		$emp=get_field('numempresario','user_'.$userid);
		$pais=get_field('pais','user_'.$userid);
		?>
		
		<img src="https://lebasi.com.mx/wp-content/uploads/2019/11/Inscribete.jpg" style="width: 100%;height: auto !important;max-height: fit-content;">
		
		<hr>
		
		<p>En la LEBASI sabedores de las nuevas tendencias tecnólogicas estamos desarrollando nuevas herramientas para ti es por eso que ponemos a tu disposición,<strong>TU LINK PERSONALIZADO DE INSCRIPCIÓN.</strong></p>
		
		<p>Copia y pega el link en tu red social: Facebook, Twitter ,Skype o WhatsApp y comparte tu formulario de inscripción personalizado</p>
		<p></p>
		
		<input type="text" class="form-control" type="text" value="<?php echo site_url('inscripcion').'/'.$pais.$emp;?>" onFocus="javascript:this.select();">
		
		<a style="font-size:1.2rem;" class="btn btn-link" href="<?php echo site_url('inscripcion').'/'.$pais.$emp?>" target="_blank"> Ver el formulario </a>
		
		<p>De esta manera podras compartir tu link, y las personas que llenen el formulario y completen el proceso de inscripción estarán bajo tu patrocinio.</p>
		
		<p>Al inscribirse alguien por medio de la plataforma, tu recibiras una notificación por correo electrónico y podras ver en tu backoffice reflejada esta inscripción.</p>
		
	</div><?php
}
add_action( 'woocommerce_account_' . $endpoint5 .  '_endpoint',  $endpoint5.'_endpoint_content' );
function  comisiones_endpoint_content(){
    $more=array('cans'=>true,'feeMonth'=>'JUL/2023');
	$data=getApiLebasi('ReporteRed',10712,'MX',$more);
	$arr = json_decode(json_encode ( $data ) , true);
	$compras=$arr['data']['compras'];?>
		<table id="red" class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th>N1</th>
					<th>N2</th>
					<th>N3</th>
					<th>N4</th>
					<th>N5</th>
					<th>NumEmpresario</th>
					<th>Empresario</th>
					<th>PTS Nivel 1</th>
					<th>PTS Nivel 2</th>
					<th>PTS Nivel 3</th>
					<th>PTS Nivel 4</th>
					<th>PTS Nivel 5</th>
				</tr>
			</thead>
			<tbody><?php
				$f=0;
				foreach($arr['data']['red'] as $emp1=>$vv1){
					if(array_key_exists($emp1,$compras)){
						$f=$compras[$emp1]['PuntosTotales']>99?$f+1:$f;?>
						<tr>
							<td>1</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?php echo $emp1;?></td>
							<td><?php echo $compras[$emp1]['Empresario'];?></td>
							<td><?php echo $compras[$emp1]['PuntosTotales'];?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr><?php
						foreach($vv1 as $emp2=>$vv2){
							if(array_key_exists($emp2,$compras)){?>
								<tr>
									<td></td>
									<td>2</td>
									<td></td>
									<td></td>
									<td></td>
									<td><?php echo $emp2;?></td>
									<td style="font-size:11px;"><?php echo substr($compras[$emp2]['Empresario'],0,7).' ..... ',substr($compras[$emp2]['Empresario'],-7);?></td>
									<td></td>
									<td><?php echo $compras[$emp2]['PuntosTotales'];?></td>
									<td></td>
									<td></td>
									<td></td>
								</tr><?php
								if(is_array($vv2)){
									foreach($vv2 as $emp3=>$vv3){
										if(array_key_exists($emp3,$compras)){?>
											<tr>
												<td></td>
												<td></td>
												<td>3</td>
												<td></td>
												<td></td>
												<td><?php echo $emp3;?></td>
												<td style="font-size:11px;"><?php echo substr($compras[$emp3]['Empresario'],0,7).' ..... ',substr($compras[$emp3]['Empresario'],-7);?></td>
												<td></td>
												<td></td>
												<td><?php echo $compras[$emp3]['PuntosTotales'];?></td>
												<td></td>
												<td></td>
											</tr><?php
											if(is_array($vv3)){
												foreach($vv3 as $emp4=>$vv4){
													if(array_key_exists($emp4,$compras)){?>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td>4</td>
															<td></td>
															<td><?php echo $emp4;?></td>
															<td style="font-size:11px;"><?php echo substr($compras[$emp4]['Empresario'],0,7).' ..... ',substr($compras[$emp4]['Empresario'],-7);?></td>
															<td></td>
															<td></td>
															<td></td>
															<td><?php echo $compras[$emp4]['PuntosTotales'];?></td>
															<td></td>
														</tr><?php
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="5">Frontales Activos: <?php echo $f;?></th>
				</tr>
			</tfoot>
		</table><?php
	//echo '<pre>'.print_r($arr,1).'</pre>';
}