<footer class="mt-3 pt-3">
	<div class="bg-light">
		<div class="container py-4">
			<div class="row logos p-2 border-bottom">
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/lebasi2017/wp-content/themes/lebasi2018/images/opt/amvd.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/lebasi2017/wp-content/themes/lebasi2018/images/opt/fundacion.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/lebasi2017/wp-content/themes/lebasi2018/images/opt/logoAEMS_bco.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/lebasi2017/wp-content/themes/lebasi2018/images/opt/fibrosis.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/lebasi2017/wp-content/themes/lebasi2018/images/opt/anmat.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/lebasi2017/wp-content/themes/lebasi2018/images/opt/amanc.png">
				</div>
			</div>
			<div class="row py-3 my-2">
				<div class="col-6 col-md-3 p-3">
					<div  class="row">
						<div class="col-12">
							<a href="<?php  echo site_url('historia');?>">Historia</a>
						</div>
						<div class="col-12">
							<a href="<?php  echo site_url('filosofia');?>">Filosofia</a>
						</div>
						<div class="col-12">
							<a href="<?php  echo site_url('valores');?>">Valores</a>
						</div>
						<div class="col-12">
							<a href="<?php  echo site_url('fundador');?>">Fundador</a>
						</div>
						<!--<div class="col-12">
							<a href="<?php  echo site_url();?>">Sucursales</a>
						</div>-->
					</div>
				</div>
				<div class="col-6 col-md-3 p-3">
					<div  class="row">
						<div class="col-12">
							<a href="<?php  echo site_url();?>">¿Qué es Lebasi?</a>
						</div>
						<div class="col-12">
							<a href="<?php  echo site_url('que-contiene');?>">¿Qué contiene?</a>
						</div>
						<div class="col-12">
							<a href="<?php  echo site_url('como-se-obtiene');?>">¿Comó se obtiene?</a>
						</div>
						<div class="col-12">
							<a href="<?php  echo site_url('por-que-lebasi');?>">¿Por qué Lebasi?</a>
						</div>
						<div class="col-12">
							<a href="<?php  echo site_url('plan-de-ganancias');?>">Plan de ganancias</a>
						</div>
						<div class="col-12">
							<a href="<?php  echo site_url('tienda');?>">Tienda en línea</a>
						</div>
						<!--<div class="col-12">
							<a href="<?php  echo site_url();?>">Sucursales</a>
						</div>-->
					</div>
				</div>
				<div class="col-12 col-md-6 p-4">
					<?php echo do_shortcode('[mc4wp_form id="4047"]');?>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-primary text-white">
		<div class="container py-5">
			<div class="row">
				<div class="col-12 col-md-3 p-5">
					<a href="https://lebasi.net" target="_blank">
						<img src="https://lebasi.net/wp-content/themes/lebasinet2019/images/logo_bco.svg" class="img-fluid">
					</a>
				</div>
				<div class="col-12 col-md-5 text-center px-4">
					<div class="social row px-4 text-white">
						<div class="col-3 text-center">
							<a href="https://www.facebook.com/LACTOSERUM.ALIMENTO.NATURAL" class="text-white h2"><i class="fa fa-facebook-square"></i></a>
						</div>
						<div class="col-3 text-center">
							<a href="https://www.youtube.com/user/LEBASIWORLD" class="text-white h2"><i class="fa fa-youtube"></i></a>
						</div>
						<div class="col-3 text-center">
							<a href="https://www.instagram.com/lebasi_original/?hl=es-la" class="text-white h2"><i class="fa fa-instagram"></i></a>
						</div>
						<div class="col-3 text-center">
							<a href="https://twitter.com/Lebasi_Mexico" class="text-white h2"><i class="fa fa-twitter"></i></a>
						</div>
					</div>
					</br>
					<?php
					$micrositio=false;
					if (isset($wp_query->query['pagename']) && $wp_query->query['pagename']=='distribuidor'){
						$wp_query->query['numdistribuidor'];
						$distribuidor=$wp_query->query_vars['numdistribuidor'];
						$tablename=$wpdb->prefix.'postmeta';
						$idpost=$wpdb->get_var("select post_id from {$tablename} where meta_key='slug' and meta_value='{$distribuidor}'");
						$foto=get_field('foto',$idpost);
						
						$end=get_field('dist',$idpost);
						$pp=get_field('pais',$idpost);
						if(is_numeric($end)){
							//echo $end;
							$empObj = getDatoEmpresarioLebasi($end,$pp);
							$siglasemp=$pp;
							//echo '<pre>'.print_r($empObj,1).'</pre>';	
							$micrositio=true;
							switch($siglasemp){
								case 'MX':
									$clave=52;
								break;
								case 'AR':
									$clave=54;
								break;
								case 'PE':
									$clave=51;
								break;
							}
						}
					}
					
					$country=getPaisIp();
					$siglas=$country->data->geo->country_code;
					if($siglas=='AU'){
						$siglas='PE';
					}
					switch($siglas){
						case 'MX':
							$paist='México';
							$datos='Tel. 449 922 2222
								</br>ventasweb@lebasigroup.com';
								/*<!--</br>Corporativo: Av. Las Américas 1604
								</br>Jardines de Santa Elena,
								</br>20236 Aguascalientes, Ags.-->
								</br>México';*/
							$phone="5214491555144";
							
						break;
						case 'AR':
							$paist='Argentina';
							$datos='Tel. 1143825191
								</br>ventasweb4@lebasigroup.com
								</br>Argentina';
							$phone="5214494691235";
						break;
						case 'PE':
							$paist='Perú';
							$datos='Tel. 939 290 523
								</br>ventasweb3@lebasigroup.com
								</br>Sucursal Lima: Las Orquídeas #2624
								</br>Cercado de Lima,
								</br>CP 15046 Lima,
								</br>Perú';
							$phone="5214494691235";
						break;
						case 'US':
							$paist='United States';
							$datos='
								</br>websales@lebasigroup.com
								</br>Phone number: 866-530-6690
								</br>Whatsapp: +12136402431';
							$phone="12136402431";
						break;
						default :
							$paist='International';
							$datos='contacto@lebasigroup.com';
							$phone="524492256275";
						break;
					}
					global $id_face;
					$msg="HOLA LEBASI | Sitio Oficial";
					if($micrositio){ $phone= $clave.$empObj->data->Celular; $msg="Hola estoy viendo tu micrositio Lebasi.";}?>
					
					Lebasi © 2021 | <?php echo $paist;?><br>
					Todos los derechos reservados
				</div>
				<div class="col-12 col-md-4 text-right p-4">
					<?php echo $datos;?>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Boton de WhatsApp -->
	<div id="WAButton" data-msg="<?php echo $msg;?>" data-phone="<?php echo $phone;?>" data-pais="<?php echo $clave;?>"></div>
</footer>
<?php wp_footer();?>
	<!-- Bootstrap core JavaScript -->
	<script src="<?php echo get_template_directory_uri(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/vendor/js/scripts.js?v=1.<?php echo date('dmYHis')?>"></script>
</body>
</html>