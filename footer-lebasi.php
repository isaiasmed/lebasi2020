<footer class="mt-3 pt-3">
	<div class="bg-light">
		<div class="container py-4">
			<div class="row logos p-2 border-bottom">
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/amvd.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/fundacion.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/logoAEMS_bco.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/fibrosis.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/anmat.png">
				</div>
				<div class="col-6 col-md-4 p-3">
					<img alt="Lebasi Lactoserum | AMVD" class="img-fluid" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/amanc.png">
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
					<div  class="row">
						<div class="col-12">
							<a style="font-size: 21px;color: #bd0e0e;text-decoration:underline;" href="<?php  echo site_url('politicas-de-privacidad-de-la-informacion');?>">Política de Privacidad</a>
						</div>
						<div class="col-12">
							<a style="font-size: 21px;color: #bd0e0e;text-decoration:underline;" href="<?php  echo site_url('politicas-comerciales');?>">Política Comercial</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-primary text-white">
		<div class="container py-5">
			<div class="row">
				<div class="col-12 col-md-3 p-5">
					<a href="https://lebasi.net" target="_blank">
						<img src="https://lebasi.net/wp-content/themes/lebasinet2019/img/logo_bco.svg" class="img-fluid">
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
							<a href="https://www.instagram.com/lebasi_swiss_group/" class="text-white h2"><i class="fa fa-instagram"></i></a>
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
					
					if($country->status=='success'){
						$siglas=$country->countryCode;
						if($siglas=='AU'){
							$siglas='PE';
						}
					}else{
						$siglas='MX';
					}
					switch($siglas){
						case 'MX':
							$paist='México';
							$datos='Tel. 449 922 2222
								</br>ventasweb@lebasigroup.com'
								/*</br>Av Aguascalientes
								</br>20238 Aguascalientes, Ags.
								</br>México'*/;
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
					if($micrositio){
						$phone= $clave.$empObj->data->Celular; 
						$msg="Hola estoy viendo tu micrositio Lebasi.";
					}
					if(isset($wp_query->query['foto']) || isset($wp_query->query['descargas']) || is_page('promociones')){
						$phone= '+524499222233'; 
						$msg="Hola Lebasi | Promocion: Todos ganan 2021";
					}?>
					
					Lebasi © 2020 | <?php echo $paist;?><br>
					Todos los derechos reservados
				</div>
				<div class="col-12 col-md-4 text-right p-4">
					<?php echo $datos;?>
				</div>
			</div>
		</div>
	</div>
	
	<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
	
	
	
    <?php } ?>

	
	<!-- Boton de WhatsApp -->	
	<div id="WAButton" data-msg="<?php echo $msg;?>" data-phone="<?php echo $phone;?>" data-pais="<?php echo $clave;?>"></div><?php 
	if(!$micrositio && !isset($wp_query->query['foto']) && !isset($wp_query->query['descargas']) && !is_page('promociones')): ?>
		<!-- Your Chat Plugin code -->
		<div class="fb-customerchat"
			attribution=setup_tool
			page_id="<?php echo $id_face;?>"
			theme_color="#cd0000"
			logged_in_greeting="¿Hola como podemos ayudarte?"
			logged_out_greeting="¿Hola como podemos ayudarte?" ref="<?php the_permalink();?>">
		</div><?php
	endif;?>
</footer>

<?php wp_footer();?>
	<!-- Bootstrap core JavaScript -->
	<script src="<?php echo get_template_directory_uri(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  
	<script src="<?php echo get_template_directory_uri(); ?>/vendor/js/scripts.js?v=1.<?php echo date('dmYHis')?>"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-16884225-3"></script>
	<!--Floating WhatsApp javascript-->
	<script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-16884225-3');
	</script>
</body>
</html>