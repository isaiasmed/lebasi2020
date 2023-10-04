<?php
/*************************************************************************
-----------------------FUNCIONES DEL TEMA----------------------

Quitamos cosas inecesarias de wordpress y agregamos los estilos y
scripts generales

##########################################################################*/
function add_cors_http_header(){
	header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');
 
add_filter('kses_allowed_protocols', function($protocols) {
	$protocols[] = 'capacitor';
	return $protocols;
});
 
add_filter('kses_allowed_protocols', function($protocols) {
	$protocols[] = 'ionic';
	return $protocols;
});
/*#########################################################################*/
@ini_set( 'upload_max_size' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'max_execution_time', '300' );

// Remove links to the extra feeds (e.g. category feeds)
remove_action( 'wp_head', 'feed_links_extra', 3 );
// Remove links to the general feeds (e.g. posts and comments)
remove_action( 'wp_head', 'feed_links', 2 );
// Remove link to the RSD service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link' );
// Remove link to the Windows Live Writer manifest file
remove_action( 'wp_head', 'wlwmanifest_link' );
// Remove index link
remove_action( 'wp_head', 'index_rel_link' );
// Remove prev link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// Remove start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// Display relational links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
// Remove XHTML generator showing WP version
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

show_admin_bar( false );
add_theme_support( 'title-tag' );

add_action('init', 'register_my_menus');
function register_my_menus(){
register_nav_menus(
    array(
    'home-menu' => __( 'Home Menu' ),
    )
);
}


function wp_maintenance_mode() {
if (!current_user_can('edit_themes') || !is_user_logged_in()) {
//wp_die('<h1>En mantenimiento</h1><br />Sitio web bajo mantenimiento planificado. Por favor, vuelva más tarde.');
}
}
//add_action('get_header', 'wp_maintenance_mode');

function add_async_attribute($tag, $handle) {
   // add script handles to the array below
   $scripts_to_async = array('my-js-handle', 'another-handle');
   
   foreach($scripts_to_async as $async_script) {
      if ($async_script === $handle) {
         return str_replace(' src', ' async="async" src', $tag);
      }
   }
   return $tag;
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

remove_filter( 'the_excerpt', 'wpautop' );


function mi_menu(){
	$menu_name = 'home-menu';
	//echo '<pre>'.print_r(get_nav_menu_locations(),1).'</pre>';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menux=array();
		foreach($menu_items as $menu){
			if($menu->menu_item_parent==0){
				$menux[$menu->ID]=$menu;
				$menux[$menu->ID]->childs=array();
			}else{
				$menux[$menu->menu_item_parent]->childs[]=$menu;
			}
		}
	}
	return $menux;
}


//Cargamos stilos y scripts
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scriptss' );
function wpdocs_theme_name_scriptss() {
	global $pagenow;
	global $wp_query;
	
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//code.jquery.com/jquery-1.12.4.min.js', false, '1.12.4',true);
	wp_register_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '1.9.0',true);
	wp_enqueue_script('jquery');
	wp_enqueue_script('slick');
	
	wp_enqueue_script( 'convForm', get_template_directory_uri().'/js/convForm.js', array('jquery','autosize'),'1.1'.date('YmdHis'),false );
	wp_enqueue_script( 'autosize', get_template_directory_uri().'/js/autosize.js', array('jquery'),'1.1'.date('YmdHis'),false );
	wp_enqueue_style( 'convForm_style',get_template_directory_uri().'/css/convForm.css',"","1.".uniqid());
	
	if(is_page('promociones')){
		wp_enqueue_script( 'dropzone_js', 'https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js', array('jquery'),false, true );
		wp_enqueue_style( 'dropzone_style','https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css');
		

		wp_enqueue_script( 'promosjs', get_template_directory_uri().'/js/promociones.js', array('jquery'),'1.1'.date('YmdHis'),false );
		
		wp_enqueue_script( 'sweetealert', '//cdn.jsdelivr.net/npm/sweetalert2@11', array('jquery'),'11.0.0',true );
		
		wp_enqueue_script( 'daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery','moment'),false,true );
		//wp_enqueue_style( 'promosstyle',get_template_directory_uri().'/css/promos.css');
		wp_enqueue_style( 'promocionstyle',get_template_directory_uri().'/css/promocion.css',"","1.".uniqid());
		wp_enqueue_script('masonry','https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js',array('jquery'),false,true);
	}

}
//Agregamos el defer para el script de fontawesome
add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );
function add_defer_attribute( $tag, $handle ) {
    if ( 'font-awesome' === $handle ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }
	if ( 'facebook-sdk' === $handle ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}

//Funcion para agregar el siteurl para las llamadas ajax de js
	function hook_siteurl() { ?>
		<script type="text/javascript">
			var siteurl="<?php echo site_url();?>";
			var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
		</script><?php
	}
	add_action('wp_head', 'hook_siteurl');


	
//Agregamos funcionalidad al woocommerce
function lebasi_theme_setup() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'lebasi_theme_setup' );


add_action('template_redirect','remove_wpseo');
function remove_wpseo(){
	global $wp_query;
	//global $wpseo_front;
	if (isset($wp_query->query['foto']) || isset($wp_query->query['distribuidor']) || (isset($wp_query->query['pagename']) && $wp_query->query['pagename']=='inscribete') || (isset($wp_query->query['pagename']) && $wp_query->query['pagename']=='index')) { /* pagenmae could be your slug of page, just replace it */
		
		//echo '<pre>'.print_r($wpseo_front,1).'</pre>YOAST';
		if(defined($wpseo_front)){
			remove_action('wp_head',array($wpseo_front,'head'),1);
		}
		else {
			remove_action('wp_head',array($wpseo_front,'head'),1);
			//$wp_thing = WPSEO_Frontend::get_instance();
			//remove_action('wp_head',array($wp_thing,'head'),1);
		}
	}
}

function meses(){
	$meses=array('','ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');
	return $meses;
}
function datosRed_contenido() {
	$mesComision=meses()[date('n')].'/'.date('Y');
	$user = wp_get_current_user();
	$emp=get_user_meta($user->ID, 'numEmpresario',true);
	$datosEmp=getDatoEmpresario($emp);
	$red=getRedEmpresario($emp);?>
	<!--<pre><?php //echo print_r($red,1);?></pre>-->
	<h3><?php echo $emp; ?> | <?php echo $datosEmp->data->Empresario;?></h3>
	<p>Patrocinados en 1er. Nivel: <?php echo count($red->data->network);?></p>
	<div class="tabla">
		<table class="table">
			<tr>
				<th>Pais</th>
				<th>Empresario</th>
				<th>Fecha Ingreso</th>
				<th>Última Compra</th>
				<th>Inscritos 1er nivel</th>
			</tr><?php
			foreach($red->data->network as $emp){?>
			<tr>
				<td><?php echo $emp->ClavePais;?> <?php echo $emp->NumEmpresario?></td>
				<td><?php echo $emp->Empresario;?></td>
				<td><?php echo $emp->FechaIngreso;?></td>
				<td><?php echo $emp->UltimaCompra; ?></td>
				<td><?php echo $emp->Patrocinados; ?></td>
			</tr><?php
			}?>
		</table>
	</div>
	<!--<pre><?php echo print_r($red,1)?></pre>--><?php
}
/*
add_action('wp_ajax_checarEmpresario','checarEmpresario');
add_action('wp_ajax_nopriv_checarEmpresario','checarEmpresario');
function checarEmpresario(){
	$aj=getEmpresarioNombre($_POST['NumEmpresario']);
	wp_send_json($aj);
}

function getEmpresarioNombre($numempresario){
	$vars=array('numEmpresario'=>$numempresario,'consulta'=>'NombreEmpresario');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://201.151.142.195/pruebaDatos.php');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($vars));  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers[] = 'apiKey:MjgjFiif80RmCr1021';

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$server_output = curl_exec ($ch);

	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
		//$return['info']= curl_getinfo($ch);
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	
	return json_decode($return);
}

function getRemisiones($numempresario){
	$vars=array('distributor'=>$numempresario,'type'=>'invoices','country'=>'MX');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://201.151.142.195/apiLebasi');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($vars));  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers[] = 'apiKey:MjgjFiif80RmCr1021';
	$headers[] = 'Content-Type: application/json';

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$server_output = curl_exec ($ch);

	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
		//$return['info']= curl_getinfo($ch);
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	return json_decode($return);
}

function getEmpresario($numempresario){
	$vars=array('distributor'=>$numempresario,'type'=>'distributor','country'=>'MX');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://201.151.142.195/apiLebasi');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($vars));  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers[] = 'apiKey:MjgjFiif80RmCr1021';

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$server_output = curl_exec ($ch);

	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
		//$return['info']= curl_getinfo($ch);
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	
	return json_decode($return);
}

function getRedEmpresario($numempresario){
	$vars=array('distributor'=>$numempresario,'type'=>'network','country'=>'MX');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://201.151.142.195/apiLebasi');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($vars));  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers[] = 'apiKey:MjgjFiif80RmCr1021';
	$headers[] = 'Content-Type: application/json';

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$server_output = curl_exec ($ch);

	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
		//$return['info']= curl_getinfo($ch);
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	return json_decode($return);
}
function getEmpresarioBusqueda($numempresario){
	$vars=array('consulta'=>'listadosEmpresarios','numero'=>$numEmpresario);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://201.151.142.195/pruebaDatos.php');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($vars));  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers[] = 'apiKey:MjgjFiif80RmCr1021';

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$server_output = curl_exec ($ch);

	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
		//$return['info']= curl_getinfo($ch);
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	
	return json_decode($return);
}*/


/*function getDatoEmpresarioRfc($numempresario){
	$vars=array('numEmpresario'=>$numempresario,'consulta'=>'NombreEmpresario');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://201.151.142.195/pruebaDatos.php');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($vars));  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers[] = 'apiKey:MjgjFiif80RmCr1021';

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$server_output = curl_exec ($ch);

	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
		//$return['info']= curl_getinfo($ch);
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	
	return json_decode($return);
}*/

/*function getDatoEmpresario($numempresario){
	
	$vars=array('distributor'=>$numempresario,'type'=>'distributor','country'=>'MX');
	//echo print_r($vars,1);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://201.151.142.195/apiLebasi');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($vars));  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers[] = 'apiKey:MjgjFiif80RmCr1021';
	$headers[] = 'Content-Type: application/json';

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$server_output = curl_exec ($ch);
	
	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
		//$return['info']= curl_getinfo($ch);
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	
	return json_decode($return);
}*/

function getDatoEmpresarioLebasi($numempresario,$pais){
	
	$vars=array('numempresario'=>$numempresario,'type'=>'ObtenerDatosEmpresario','pais'=>$pais);
	//echo print_r($vars,1);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'https://app.lebasigroup.com/api.php');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($vars));  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers[] = 'apiKey:MjgjFiif80RmCr1021';
	$headers[] = 'Content-Type: application/json';

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$server_output = curl_exec ($ch);
	
	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
		//$return['info']= curl_getinfo($ch);
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	
	return json_decode($return);
}



function wpblog_save_register_fields( $customer_id ) {
	if ( isset( $_POST['numEmpresario'] ) && $_POST['numEmpresario']!="" ) {
		update_user_meta( $customer_id, 'numEmpresario', sanitize_text_field( $_POST['numEmpresario'] ) );
		$u = new WP_User( $customer_id);
		$u->remove_role( 'clientes' );
		$u->add_role( 'distribuidor' );
	}
}
add_action( 'woocommerce_created_customer', 'wpblog_save_register_fields' );
function getDay(){
	date_default_timezone_set('America/Mexico_City');
	$day=date('j');
	$variable = get_field('dia_tienda', 'option');
	if($variable && $variable!=''){
		$day=$variable;
	}
	return $day;
}

function my_new_customer_data($new_customer_data){
 $new_customer_data['role'] = 'customer';
 return $new_customer_data;
}
add_filter( 'woocommerce_new_customer_data', 'my_new_customer_data');


add_action('wp_ajax_nopriv_getDatosEmpresario','getDatosEmpresario');
function getDatosEmpresario(){
	$datos=getDatoEmpresarioRfc($_POST['numEmpresario']);
	//echo '<pre>'.print_r($datos,1).'</pre>';
	$array=array('error'=>true,'msg'=>'Nos has proporcionado los datos solicitados');
	if($_POST['numEmpresario']!="" && $_POST['rfcEmpresario']!=""){
		$array=array('error'=>true,'msg'=>'Error no coinciden los datos, envianos un correo a: <a href="mailto:sistema@lebasi.com.mx">sistema@lebasi.com.mx</a>');
		if($_POST['rfcEmpresario']==$datos->RFC){
			//Validar que no exista en la bd
			$array=array('error'=>false,'msg'=>'Validado, continua con el registro');
			
		}
	}
	wp_send_json($array);
}



function botes_regalo(){
	date_default_timezone_set('America/Mexico_City');
	$dd=date('j');
	$dd=getDay();
	$botes=0;
	if($dd<21){
		$botes=1;
	}
	if($dd<11){
		$botes=2;
	}
	return $botes;
}

function sv_wc_prevent_checkout_for_category() {
	$claves=array();
	$msg="";
	$datoKey="";
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_woo_product = wc_get_product( $cart_item['product_id'] );
		$claves[]=$_woo_product->get_sku();
		if($_woo_product->get_sku()=='LEB001P'){
			$datoKey=$cart_item_key;
		}
	}
	$msg='<pre>'.print_r($claves,1).'</pre>';
	
	if(in_array('LEB001P',$claves) && !in_array('LEB024',$claves)){
		WC()->cart->remove_cart_item($datoKey);
		wc_add_notice('Se han quitado los botes de promoción ya que no has agregado caja de 24 Botes', 'success' );
	}
}
add_action( 'woocommerce_check_cart_items', 'sv_wc_prevent_checkout_for_category' );


add_action( 'woocommerce_update_cart_action_cart_updated', 'on_action_cart_updated', 20, 1 );
function on_action_cart_updated( $cart_updated ){
	$cantidad24=0;
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_woo_product = wc_get_product( $cart_item['product_id'] );
		$idprod=$cart_item['product_id'];
		if($idprod=='4151'){
			$cantidad24=$cart_item['quantity'];
		}	
		
		if($_woo_product->get_sku()=='LEB001P'){
			//WC()->cart->set_quantity( $cart_item_key, botes_regalo()*$cantidad24, true );
			//$msg='<pre>'.print_r($cart_item,1).'</pre>=';
			//$cart_item['quantity']=5;
		}
	}
	//wc_add_notice($msg.'-'.$cantidad24, 'success' );
}


add_action('woocommerce_add_to_cart', 'custome_add_to_cart');
function custome_add_to_cart() {
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_woo_product = wc_get_product( $cart_item['product_id'] );
		$idprod=$cart_item['product_id'];
		if($idprod=='4151'){
			$cantidad24=$cart_item['quantity'];
			//Promo buen fin
			//WC()->cart->add_to_cart( 4918,1 );
			//wp_safe_redirect( wc_get_cart_url() );
			//exit();
		}	
	}
	//wc_add_notice('Proximamente promobuen fin', 'success' );
}

add_action('wp_ajax_nopriv_inscripcion','inscripcion');
add_action('wp_ajax_inscripcion','inscripcion');
function inscripcion(){
	$user_name=sanitize_user( $_POST['user']['mail']);
	$user_email=sanitize_user( $_POST['user']['mail']);
	$user_id = username_exists( $user_name );
	if ( !$user_id and email_exists($user_email) == false ) {
		$random_password = $_POST['user']['password'];
		$user_id = wp_create_user( $user_name, $random_password, $user_email );
		$u = new WP_User( $user_id);
		$u->remove_role( 'clientes' );
		$u->add_role( 'inscripcion' );
		wp_set_auth_cookie( $user_id, false, is_ssl() );
		$mailer = WC()->mailer();
		$recipient = $user_email;
		$subject = "Proceso de Inscripción";
		$content = get_custom_email_html_inscripcion( $user_id, $subject, $mailer );
		$headers = "Content-Type: text/html\r\n";
		$mailer->send( $recipient, $subject, $content, $headers );
	} else {
		$random_password = 'Este usuario ya existe';	
		$user_id=array('error'=>true,'msg'=>'Este usuario ya existe');
	}
	wp_send_json($user_id);
}

function get_custom_email_html_inscripcion( $user_id, $heading = false, $mailer ) {
	$template = 'emails/inscripcion.php';
	return wc_get_template_html( $template, array(
		'order'         => $user_id,
		'email_heading' => $heading,
		'sent_to_admin' => true,
		'plain_text'    => false,
		'email'         => $mailer
	) );
}

function get_custom_email_html_conekta( $orderid, $heading = false, $mailer ) {
	$template = 'emails/customer-completed-order.php';
	return wc_get_template_html( $template, array(
		'order'         => $orderid,
		'email_heading' => $heading,
		'sent_to_admin' => true,
		'plain_text'    => false,
		'email'         => $mailer
	) );
}

add_action('wp_ajax_nopriv_formContacto','formContacto');
add_action('wp_ajax_formContacto','formContacto');
function formContacto(){
	unset($_POST['action']);
	$mailer = WC()->mailer();
	$recipient = $_POST['email'];
	$subject = __("Contacto | Lebasi México", 'theme_name');
	$content = get_custom_email_html_contacto( $user_id, $subject, $mailer );
	$headers = "Content-Type: text/html\r\n";
	$mailer->send( $recipient, $subject, $content, $headers );
	wp_send_json($mailer);
}


function get_custom_email_html_contacto( $mail, $heading = false, $mailer ) {
	$template = 'emails/contacto.php';
	return wc_get_template_html( $template, array(
		'contacto'         => $mail,
		'email_heading' => $heading,
		'sent_to_admin' => false,
		'plain_text'    => false,
		'email'         => $mailer
	) );
}

add_action( 'wp_ajax_handle_dropped_media', 'handle_dropped_media' );

// if you want to allow your visitors of your website to upload files, be cautious.
add_action( 'wp_ajax_nopriv_handle_dropped_media', 'handle_dropped_media' );



function handle_dropped_media() {
    status_header(200);

    $upload_dir = wp_upload_dir();
    $upload_path = $upload_dir['path'] . DIRECTORY_SEPARATOR;
    $num_files = count($_FILES['file']['tmp_name']);

    $newupload = 0;

    if ( !empty($_FILES) ) {
        $files = $_FILES;
        foreach($files as $file) {
            $newfile = array (
                    'name' => $file['name'],
                    'type' => $file['type'],
                    'tmp_name' => $file['tmp_name'],
                    'error' => $file['error'],
                    'size' => $file['size']
            );

            $_FILES = array('upload'=>$newfile);
            foreach($_FILES as $file => $array) {
                $newupload = media_handle_upload( $file, 0 );
            }
        }
    }

    echo $newupload;    
    die();
}

//Checamos si es tienda
function is_tienda(){
	global $wp_query;
	echo $wp_query->query->tienda;
	if($wp_query->query['distribuidor'] || $wp_query->query['tienda']){
		$vars=true;
	}else{
		$vars=false;
	}
	return $vars;
}

//Detecta la ip de la persona que utiliza el sistema
function getIP() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
	
//Revisamos la ip el pais
function getPaisIp(){
	$ip=getIP();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'http://ip-api.com/json/'.$ip);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	// Comprobar si ocurrió un error
	if (!curl_errno($ch)) {
		$return=$server_output;
	}else{
		$return=array('error'=>'Falla en sistema Lebasi');
	}
	curl_close ($ch);
	//echo '<pre>'.print_r($return,1).'</pre>';
	return json_decode($return);
}

function revisamosIP($pais){
	$ipobj=getPaisIp();
	if($ipobj->status=='success'){
		if($ipobj->countryCode==$pais){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function getCountryIP(){
	$ipobj=getPaisIp();
	if($ipobj->status=='success'){
		return $ipobj->countryCode;
	}else{
		return false;
	}
}


/**
 *Excluimos productos de distribuidores en tienda de micrositio
 */
function custom_pre_get_posts_query( $q ) {
	//echo '<pre>'.print_r($q->query_vars['distribuidor'],1).'</pre>';
	if(!$q->query_vars['distribuidor']){
		$tax_query = (array) $q->get( 'tax_query' );

		$tax_query[] = array(
			   'taxonomy' => 'product_cat',
			   'field' => 'slug',
			   'terms' => array( 'distribuidor' ),
			   'operator' => 'NOT IN'
		);


		$q->set( 'tax_query', $tax_query );
	}

}


function custom_short_excerpt($excerpt){
	$limit = 200;

	if (strlen($excerpt) > $limit) {
		return substr($excerpt, 0, strpos($excerpt, ' ', $limit));
	}

	return $excerpt;
}

add_filter('the_excerpt', 'custom_short_excerpt');



function ba_rewrite() {
	add_rewrite_rule('^promociones/foto/([^/]*)/?' , 'index.php?pagename=promociones&foto=$matches[1]','top');
	add_rewrite_rule('^promociones/galeria/?' , 'index.php?pagename=promociones&galeria=1','top');
	add_rewrite_rule('^promociones/descargas/dieta?' , 'index.php?pagename=promociones&descargas=dieta','top');
    add_rewrite_rule('^en/sign-up/([^/]*)/?' , 'index.php?pagename=sign-up&lang=en&numempresario=$matches[1]','top'); 
	add_rewrite_rule('^inscripcion/([^/]*)/?' , 'index.php?pagename=inscripcion&numempresario=$matches[1]','top'); 
	add_rewrite_rule('^fr/sinscrire/([^/]*)/?' , 'index.php?pagename=sinscrire&lang=fr&numempresario=$matches[1]','top'); 
   
	add_rewrite_rule('^en/distributor/([^/]*)/?' , 'index.php?pagename=distributor&lang=en&numdistribuidor=$matches[1]','top'); 
	add_rewrite_rule('^distribuidor/([^/]*)/?' , 'index.php?pagename=distribuidor&numdistribuidor=$matches[1]','top');
	add_rewrite_rule('^fr/le-distributeur/([^/]*)/?' , 'index.php?pagename=le-distributeur&lang=fr&numdistribuidor=$matches[1]','top'); 
      
	add_rewrite_rule('^en/microsite/([^/]*)/?' , 'index.php?pagename=micrositio&lang=en&numsocio=$matches[1]','top'); 
	add_rewrite_rule('^micrositio/([^/]*)/?' , 'index.php?pagename=micrositio&numsocio=$matches[1]','top'); 
	add_rewrite_rule('^fr/microsite/([^/]*)/?' , 'index.php?pagename=le-micrositio&lang=fr&numsocio=$matches[1]','top');
	add_rewrite_rule('^api/([^/]*)/?' , 'api.php','top');
	
	add_rewrite_rule('^facturas/pdf/([^/]*)/?','wp-content/themes/lebasi2020/functions/pdf.php?uid=$1','top');
	add_rewrite_rule('^facturas/xml/([^/]*)/?','wp-content/themes/lebasi2020/functions/xml.php?uid=$1','top');
}
add_action( 'init', 'ba_rewrite' );

add_action('woocommerce_init','customer_country_base'); 
function customer_country_base() {
	/*if(function_exists('wcpbc_set_woocommerce_country')){
		$paisc='';
		if(isset($_POST['paisc'])){
			$paisc=$_POST['paisc'];
		}
	}*/
	$country=getPaisIp();
	
	if($country->status=='success'){
		$siglas=$country->countryCode;
		if($siglas=='AU'){
			$siglas='PE';
		}
	}else{
		$siglas='MX';
	}
	//echo $siglas;
	wcpbc_set_woocommerce_country($siglas);
}

add_action( 'wp', 'ts_redirect_product_pages', 99 );
 
function ts_redirect_product_pages() {
    if ( is_product() ) {
		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
        wp_safe_redirect( $shop_page_url );
        exit;
    }
}
 

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

add_filter('query_vars', function( $vars ){
    $vars[] = 'pagename'; 
    $vars[] = 'numempresario'; 
    $vars[] = 'numdistribuidor'; 
	$vars[] = 'numsocio'; 
	$vars[] = 'foto'; 
	$vars[] = 'galeria';
	$vars[] = 'descargas';
    return $vars;
});

add_filter('pll_translation_url', 'check_archive_translation', 10, 2);
function check_archive_translation($url, $lang) {
    global $wp_query;
    if(isset($wp_query->query_vars['numempresario']) && $url){
		return $url.$wp_query->query_vars['numempresario'];
	}else if(isset($wp_query->query_vars['numdistribuidor']) && $url){
		return $url.$wp_query->query_vars['numdistribuidor'];
	}else{
		return $url;
	}
}


//Agregar iconos por tipo de pago
add_filter( 'woocommerce_gateway_icon', 'authorize_gateway_icon', 10, 2 );
function authorize_gateway_icon( $icon, $id ) {
	//echo print_r($id,1);
    if ( $id === 'ppec_paypal' ) {
        return '<img src="https://lebasi.com.mx/wp-content/uploads/2018/02/PayPal_negro.png" alt="Paypal Negro" />'; 
    } else if($id==='openpay_cards') {
		return '<img src="https://lebasi.com.mx/wp-content/uploads/2018/02/tarjetas.png" alt="Tarjetas bancarias" />';
	} else if($id==='openpay_stores') {
		return '<img src="https://lebasi.com.mx/wp-content/uploads/2018/02/conveniencia.png" alt="Tiendas Conveniencia" />';
	} else if($id==='bacs') {
		return '<img src="'.get_bloginfo('template_directory').'/images/HSBC_icon.png'.'" alt="Depósito Bancario HSBC" />';
	}else{
        return $icon;
    }
}



//Solo el pais de la moneda para el envio
function woo_override_checkout_fields_shipping( $fields ) { 
	switch(wcpbc_get_woocommerce_country()){
		case 'MX':
		$ar=array('MX' => 'México');
		break;
		case 'US':
		$ar=array('US' => 'United States Of America');
		break;
		case 'PE':
		$ar=array('PE' => 'Perú');
		break;
		case 'AR':
		$ar=array('AR' => 'Argentina');
		break;
	}

    $fields['shipping']['shipping_country'] = array(
        'type'      => 'select',
        'label'     => pll__('envio-wc'),
        'options'   => $ar
    );
    return $fields; 
} 
add_filter( 'woocommerce_checkout_fields' , 'woo_override_checkout_fields_shipping' );

/*Archive products*/
// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
//Remove sort by from woocommerce
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


/*  Cart   */
// Product thumbnail in checkout
add_filter( 'woocommerce_cart_item_name', 'product_thumbnail_in_checkout', 20, 3 );
function product_thumbnail_in_checkout( $product_name, $cart_item, $cart_item_key ){
    if ( is_checkout() ) {
        $thumbnail   = $cart_item['data']->get_image(array( 70, 70));
        $image_html  = '<div class="product-item-thumbnail">'.$thumbnail.'</div> ';
        $product_name = $image_html . $product_name;
    }
    return $product_name;
}

add_action('wp_ajax_nopriv_getAsignacion','getAsignacion');
add_action('wp_ajax_getAsignacion','getAsignacion');
function getAsignacion(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	
	$slider_products_q = new WP_Query([
		'posts_per_page'    => -1,
		'post_type'         => 'micrositios',
		'meta_key'		=> 'pais',
		'meta_value'	=> wcpbc_get_woocommerce_country()
	]);
	
	if ($slider_products_q->have_posts()):
		while($slider_products_q->have_posts()):
			$slider_products_q->the_post();
			$dist=get_field('dist');
			$pais=get_field('pais');
			$empObj = getDatoEmpresarioLebasi($dist,$pais);
			$image = get_field('foto');
			$image_url = $image['sizes']['thumbnail'];
			$array[]=array('numEmpresario'=>$dist,'PaisEmpresario'=>$pais,'Empresario'=>$empObj->data->Empresario,'Foto'=>$image_url,'link'=>site_url('distribuidor/'.get_field( 'slug')));
		endwhile;
	endif;
	
	
	switch(wcpbc_get_woocommerce_country()){
		case 'MX':
			$array[]=array('numEmpresario'=>'00000','PaisEmpresario'=>'MX','Empresario'=>'Lebasi México SA de CV','Foto'=>'https://lebasi.com.mx/global/wp-content/themes/lebasi2020/vendor/images/logolebasi_opt.png');
			$array[]=array('numEmpresario'=>'00000','PaisEmpresario'=>'MX','Empresario'=>'Lebasi México SA de CV','Foto'=>'https://lebasi.com.mx/global/wp-content/themes/lebasi2020/vendor/images/logolebasi_opt.png');
		break;
		case 'PE':
			$array[]=array('numEmpresario'=>'00000','PaisEmpresario'=>'PE','Empresario'=>'Lebasi Perú SAC','Foto'=>'https://lebasi.com.mx/global/wp-content/themes/lebasi2020/vendor/images/logolebasi_opt.png');
		break;
		case 'AR':
			$array[]=array('numEmpresario'=>'00000','PaisEmpresario'=>'AR','Empresario'=>'Grupo EGC SA','Foto'=>'https://lebasi.com.mx/global/wp-content/themes/lebasi2020/vendor/images/logolebasi_opt.png');
		break;
		case 'US':
			$array[]=array('numEmpresario'=>'5050','PaisEmpresario'=>'US','Empresario'=>'Lebasi Group Inc.','Foto'=>'https://lebasi.com.mx/global/wp-content/themes/lebasi2020/vendor/images/logolebasi_opt.png');
		break;
	}
	wp_reset_postdata();
	$return=$array[array_rand($array,1)];
	set_micrositio_cookie($return['PaisEmpresario'].'-'.$return['numEmpresario']);
	wp_send_json($return);
}



add_action('wp_ajax_getShopDist','getShopDist');
add_action('wp_ajax_nopriv_getShopDist','getShopDist');
function getShopDist(){
	$sec=get_option( 'asignacion_secuencia' );
	$leb=get_option( 'asignacion_leb' );
	$items=array(
		array(
			'Nombre'=>'Juan Manuel Lopez Perez',
			'Pais'=>'MX',
			'CP'=>'20288',
			'ID'=>1
		),
		array(
			'Nombre'=>'Rodolfo Gonzalez Mera',
			'Pais'=>'MX',
			'CP'=>'01259',
			'ID'=>2
		),
		array(
			'Nombre'=>'Gerardo Quesada Reyes',
			'Pais'=>'MX',
			'CP'=>'44870',
			'ID'=>3
		),
		array(
			'Nombre'=>'Lebasi México A',
			'Pais'=>'MX',
			'CP'=>'',
			'ID'=>0
		),
	);
	$nleb=$leb;
	$ret=$items[array_rand($items)];
	if($ret['ID']!=0 && $sec>5 && $leb<6){
		$ret=array(
			'Nombre'=>'Lebasi México',
			'Pais'=>'MX',
			'CP'=>'',
			'ID'=>0
		);
		
	}
	if($ret['ID']==0){
		$nleb=$nleb+1;
	}
	
	
	$num=$sec+1;
	if($num>10){
		$num=1;
		$nleb=1;
	}
	update_option( 'asignacion_secuencia', $num, false );
	update_option( 'asignacion_leb', $nleb, false );
	wp_send_json($ret);	
}

add_filter( 'formatted_woocommerce_price', 'ts_woo_decimal_price', 10, 5 );
function ts_woo_decimal_price( $formatted_price, $price, $decimal_places, $decimal_separator, $thousand_separator ) {
	$decimal_separator=".";
	$thousand_separator=",";
	$unit = number_format( intval( $price ), 0, $decimal_separator, $thousand_separator );
	$decimal = sprintf( '%02d', ( $price - intval( $price ) ) * 100 );
	return $unit . '<sup>' . $decimal . '</sup> ';
}


add_action( 'woocommerce_product_query', 'prefix_custom_pre_get_posts_query' );
function prefix_custom_pre_get_posts_query( $q ) {
	
	if( is_shop() || is_page('shop') ) { // set conditions here
	    //echo '<pre>'.print_r($q->get('query'),1).'</pre>';
		$tax_query = (array) $q->get( 'tax_query' );
	
	    $tax_query[] = array(
	           'taxonomy' => 'product_cat',
	           'field'    => 'slug',
	           'terms'    => array( 'regalos','gifts' ), // set product categories here
	           'operator' => 'NOT IN',
			  
	    );
		
	
	    $q->set( 'tax_query', $tax_query );
		if(wcpbc_get_woocommerce_country()!='MX'){
			$q->set( 'post__not_in', array(4358) );
		}
	}
}



function custom_woocommerce_form_field( $key, $args, $value = null ) {
	$defaults = array(
		'type'              => 'text',
		'label'             => '',
		'description'       => '',
		'placeholder'       => '',
		'maxlength'         => false,
		'required'          => false,
		'autocomplete'      => false,
		'id'                => $key,
		'class'             => array(),
		'label_class'       => array(),
		'input_class'       => array(),
		'return'            => false,
		'options'           => array(),
		'custom_attributes' => array(),
		'validate'          => array(),
		'default'           => '',
		'autofocus'         => '',
		'priority'          => '',
	);
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'custom_woocommerce_form_field_args', $args, $key, $value );
	if ( $args['required'] ) {
		$args['class'][] = 'validate-required';
		$required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
	} else {
		$required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
	}
	if ( is_string( $args['label_class'] ) ) {
		$args['label_class'] = array( $args['label_class'] );
	}
	if ( is_null( $value ) ) {
		$value = $args['default'];
	}
	// Custom attribute handling.
	$custom_attributes         = array();
	$args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );
	if ( $args['maxlength'] ) {
		$args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
	}
	if ( ! empty( $args['autocomplete'] ) ) {
		$args['custom_attributes']['autocomplete'] = $args['autocomplete'];
	}
	if ( true === $args['autofocus'] ) {
		$args['custom_attributes']['autofocus'] = 'autofocus';
	}
	if ( $args['description'] ) {
		$args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
	}
	if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
		foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
		}
	}
	if ( ! empty( $args['validate'] ) ) {
		foreach ( $args['validate'] as $validate ) {
			$args['class'][] = 'validate-' . $validate;
		}
	}
	$field           = '';
	$label_id        = $args['id'];
	$sort            = $args['priority'] ? $args['priority'] : '';
	
	$field_container = '%3$s';
	switch ( $args['type'] ) {
		case 'country':
			$countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();
			if ( 1 === count( $countries ) ) {
				$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';
				$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" readonly="readonly" />';
			} else {
				$field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . '><option value="">' . esc_html__( 'Select a country&hellip;', 'woocommerce' ) . '</option>';
				foreach ( $countries as $ckey => $cvalue ) {
					$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
				}
				$field .= '</select>';
				$field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '">' . esc_html__( 'Update country', 'woocommerce' ) . '</button></noscript>';
			}
			break;
		case 'state':
			/* Get country this state field is representing */
			$for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
			$states      = WC()->countries->get_states( $for_country );
			if ( is_array( $states ) && empty( $states ) ) {
				$field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';
				$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" />';
			} elseif ( ! is_null( $for_country ) && is_array( $states ) ) {
				$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
						<option value="">' . esc_html__( 'Select a state&hellip;', 'woocommerce' ) . '</option>';
				foreach ( $states as $ckey => $cvalue ) {
					$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
				}
				$field .= '</select>';
			} else {
				$field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
			}
			break;
		case 'textarea':
			$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';
			break;
		case 'checkbox':
			$field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> ' . $args['label'] . $required . '</label>';
			break;
		case 'text':
		case 'password':
		case 'datetime':
		case 'datetime-local':
		case 'date':
		case 'month':
		case 'time':
		case 'week':
		case 'number':
		case 'email':
		case 'url':
		case 'tel':
			$field .= '<input type="' . esc_attr( $args['type'] ) . '" class="isaia input-text form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
			break;
		case 'select':
			$field   = '';
			$options = '';
			if ( ! empty( $args['options'] ) ) {
				foreach ( $args['options'] as $option_key => $option_text ) {
					if ( '' === $option_key ) {
						// If we have a blank option, select2 needs a placeholder.
						if ( empty( $args['placeholder'] ) ) {
							$args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
						}
						$custom_attributes[] = 'data-allow_clear="true"';
					}
					$options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
				}
				$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
			}
			break;
		case 'radio':
			$label_id = current( array_keys( $args['options'] ) );
			if ( ! empty( $args['options'] ) ) {
				foreach ( $args['options'] as $option_key => $option_text ) {
					$field .= '<input type="radio" class="input-radio form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
					$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';
				}
			}
			break;
	}
	if ( ! empty( $field ) ) {
		$field_html = '';
		if ( $args['label'] && 'checkbox' !== $args['type'] ) {
			$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="col-12 col-sm-4 col-form-label text-right ' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
		}
		$field_html .= '<div class="col-12 col-sm-8">'.$field.'</div>';
		if ( $args['description'] ) {
			$field_html .= '<span class="description" id="' . esc_attr( $args['id'] ) . '-description" aria-hidden="true">' . wp_kses_post( $args['description'] ) . '</span>';
		}
		//$field_html .= '</span>';
		$container_class = esc_attr( implode( ' ', $args['class'] ) );
		$container_id    = esc_attr( $args['id'] ) . '_field';
		$field           = sprintf( $field_container, $container_class, $container_id, $field_html );
	}
	/**
		 * Filter by type.
		 */
	$field = apply_filters( 'custom_woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );
	/**
		 * General filter on form fields.
		 *
		 * @since 3.4.0
		 */
	$field = apply_filters( 'custom_woocommerce_form_field', $field, $key, $args, $value );
	if ( $args['return'] ) {
		return $field;
	} else {
		echo $field; // WPCS: XSS ok.
	}
}

//add_filter("wpjb_locale", "my_wpjb_locale");
function my_wpjb_locale($locale) {
  return 616;
}


if(function_exists('pll_register_string')){
	pll_register_string('lebasi', 'buy-home', 'Lebasi');
	pll_register_string('lebasi', 'sign-home', 'Lebasi');
	pll_register_string('lebasi', 'contact-home', 'Lebasi',true);
	
	pll_register_string('lebasi', 'what-home', 'Lebasi');
	pll_register_string('lebasi', 'swiss-home', 'Lebasi');
	pll_register_string('lebasi', 'contains-home', 'Lebasi');
	pll_register_string('lebasi', 'natural-home', 'Lebasi');
	pll_register_string('lebasi', 'vitamins-home', 'Lebasi');
	pll_register_string('lebasi', 'minerals-home', 'Lebasi');
	pll_register_string('lebasi', 'amino-home', 'Lebasi');
	pll_register_string('lebasi', 'more-home', 'Lebasi');
	pll_register_string('lebasi', 'blog-sidebar', 'Lebasi');
	
	pll_register_string('lebasi', 'tomar-index', 'Lebasi');
	pll_register_string('lebasi', 'man-index', 'Lebasi');
	pll_register_string('lebasi', 'sportman-index', 'Lebasi');
	pll_register_string('lebasi', 'kids-index', 'Lebasi');
	pll_register_string('lebasi', 'pregnant-index', 'Lebasi');
	pll_register_string('lebasi', 'senior-index', 'Lebasi');
	
	pll_register_string('lebasi', 'testimonials-index', 'Lebasi');
	
	pll_register_string('lebasi', 'quieres-micrositio', 'Lebasi');
	pll_register_string('lebasi', 'insc-micrositio', 'Lebasi');
	
	pll_register_string('lebasi', 'sign-page-welcome', 'Lebasi',true);
	pll_register_string('lebasi', 'wfg-choose', 'Lebasi',true);
	pll_register_string('lebasi', 'add-to-cart', 'Lebasi',true);
		
	//checkout
	pll_register_string('checkout', 'Nombre', 'Lebasi-checkout',true);
	pll_register_string('checkout', 'Apellidos', 'Lebasi-checkout',true);
	pll_register_string('checkout', 'Pais', 'Lebasi-checkout',true);
	pll_register_string('checkout', 'Calle', 'Lebasi-checkout',true);
	pll_register_string('checkout', 'Colonia', 'Lebasi-checkout',true);
	pll_register_string('checkout', 'Ciudad', 'Lebasi-checkout',true);
	pll_register_string('checkout', 'CodPost', 'Lebasi-checkout',true);
	pll_register_string('checkout', 'Estado', 'Lebasi-checkout',true);
	
}

//Campos de checkout
add_filter( 'woocommerce_checkout_fields' , 'misha_print_all_fields',999 );
function misha_print_all_fields( $fields ){
	
	switch(wcpbc_get_woocommerce_country()){
		case 'AR':
			
		break;
		default:
			$fields['billing']['billing_first_name']['label']= pll__('Nombre');
			$fields['billing']['billing_last_name']['label']= pll__('Apellidos');
			$fields['billing']['billing_country']['label']= pll__('Pais');
			$fields['billing']['billing_address_1']['label']= pll__('Calle');
			$fields['billing']['billing_address_2']['label']= pll__('Colonia');
			$fields['billing']['billing_city']['label']= pll__('Ciudad');
			$fields['billing']['billing_postcode']['label']= pll__('CodPost');
			$fields['billing']['billing_state']['label']= pll__('Estado');
			
			$fields['shipping']['shipping_first_name']['label']= pll__('Nombre');
			$fields['shipping']['shipping_last_name']['label']= pll__('Apellidos');
			$fields['shipping']['shipping_country']['label']= pll__('Pais');
			$fields['shipping']['shipping_address_1']['label']= pll__('Calle');
			$fields['shipping']['shipping_address_2']['label']= pll__('Colonia');
			$fields['shipping']['shipping_city']['label']= pll__('Ciudad');
			$fields['shipping']['shipping_postcode']['label']= pll__('CodPost');
			$fields['shipping']['shipping_state']['label']= pll__('Estado');
		break;
	}
	//echo '<pre>'.print_r( $fields,1 ).'</pre>'; // wrap results in pre html tag to make it clearer
	return $fields;
}


//Agregamos campos por pais
add_action( 'woocommerce_before_checkout_billing_form', 'misha_select_field',998 );
// select
function misha_select_field( $checkout ){
	switch(wcpbc_get_woocommerce_country()){
		case 'PE':	
			// you can also add some custom HTML here
			woocommerce_form_field( 'facturalebasiPE', array(
				'type'          => 'select', // text, textarea, select, radio, checkbox, password, about custom validation a little later
				'required'	=> true, // actually this parameter just adds "*" to the field
				'class'         => array('form-group row'), // array only, read more about classes and styling in the previous step
				'label'         => '¿Factura o Boleta?',
				'label_class'   => 'boleta-lebasi col-12 col-md-4 text-right', // sometimes you need to customize labels, both string and arrays are supported
				'input_class'   => array('form-control'),
				'options'	=> array( // options for <select> or <input type="radio" />
					'Boleta'	=> 'Boleta',
					'Factura'	=> 'Factura' // 'value'=>'Name'
					)
			),$checkout->get_value( 'facturalebasiPE' ) );
			
			woocommerce_form_field( 'DNIlebasiPE', array(
				'type'          => 'text', // text, textarea, select, radio, checkbox, password, about custom validation a little later
				'required'	=> true, // actually this parameter just adds "*" to the field
				'class'         => array('form-group row'), // array only, read more about classes and styling in the previous step
				'label'         => 'DNI',
				'label_class'   => 'dni-lebasi col-12 col-md-4 text-right', // sometimes you need to customize labels, both string and arrays are supported
				'input_class'   => array('form-control'),
			),$checkout->get_value( 'DNIlebasiPE' ) );
		break;
	}
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
	$factura=get_post_meta( $order->get_id(), 'facturalebasiPE', true );
	$tipo=$factura=='Factura'?'RUC':'DNI';
    echo '<p><strong>Comprobante Perú:</strong> <br/>' . $factura . '</p>';
	echo '<p><strong>'.$tipo.':</strong> <br/>' . get_post_meta( $order->get_id(), 'DNIlebasiPE', true ) . '</p>';
}

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['DNIlebasiPE'] ) ) {
        update_post_meta( $order_id, 'DNIlebasiPE', sanitize_text_field( $_POST['DNIlebasiPE'] ) );
    }
	if ( ! empty( $_POST['facturalebasiPE'] ) ) {
        update_post_meta( $order_id, 'facturalebasiPE', sanitize_text_field( $_POST['facturalebasiPE'] ) );
    }
}


add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );
function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
	$tipo=get_post_meta( $order->id, 'facturalebasiPE', true );
	if($tipo!=''){
		$ide=$tipo=='Factura'?'RUC':'DNI';
		$fields['facturalebasiPE'] = array(
			'label' => 'Tipo de Comprobante',
			'value' => $tipo,
		);
		$fields['DNIlebasiPE'] = array(
			'label' => $ide,
			'value' => get_post_meta( $order->id, 'DNIlebasiPE', true ),
		);
	}
    return $fields;
}



function wpse_77783_woo_bacs_ibn($translation, $text, $domain) {
    if ($domain == 'woocommerce') {
        switch ($text) {
            case 'IBAN':
                $translation = 'CLABE';
                break;
        }
    }
    return $translation;
}
add_filter('gettext', 'wpse_77783_woo_bacs_ibn', 10, 3);


add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
	$fragments['a#cart-counter'] = '<a id="cart-counter" class="nav-link" href="'.site_url('carrito').'">
						<i class="fa fa-shopping-cart fa-badge" data-count="'.WC()->cart->get_cart_contents_count().'"></i>
					</a>';
	return $fragments;
}




function wcmo_get_current_user_roles() {
 if( is_user_logged_in() ) {
	$user = wp_get_current_user();
	$roles = ( array ) $user->roles;
	return $roles;
 } else {
	return array();
 }
}

add_filter( 'woocommerce_get_item_data', 'display_custom_item_data', 10, 2 );
function display_custom_item_data( $cart_item_data, $cart_item ) {
    if ( $cart_item['data']->get_weight() > 0 ){
        $cart_item_data[] = array(
            'name' => __( 'Weight subtotal', 'woocommerce' ),
            'value' =>  ( $cart_item['quantity'] * $cart_item['data']->get_weight() )  . ' ' . get_option('woocommerce_weight_unit')
        );
    }
    return $cart_item_data;
}


//Integracion de pagos
add_filter('woocommerce_available_payment_gateways', 'woocs_filter_gateways', 1);
function woocs_filter_gateways($gateway_list)
{
	
	switch(wcpbc_get_woocommerce_country()){
		case 'MX':
		unset($gateway_list['woo-mercado-pago-basic']);
		unset($gateway_list['ppec_paypal']);
		break;
		case 'US':
		unset($gateway_list['conektacard']);
		unset($gateway_list['conektaoxxopay']);
		unset($gateway_list['conektaspei']);
		unset($gateway_list['bacs']);
		unset($gateway_list['woo-mercado-pago-basic']);
		unset($gateway_list['openpay_cards']);
		break;
		case 'PE':
		unset($gateway_list['ppec_paypal']);
		unset($gateway_list['conektacard']);
		unset($gateway_list['conektaspei']);
		unset($gateway_list['conektaoxxopay']);
		unset($gateway_list['bacs']);
		unset($gateway_list['openpay_cards']);
		break;
		case 'AR':
		unset($gateway_list['conektacard']);
		unset($gateway_list['conektaspei']);
		unset($gateway_list['ppec_paypal']);
		unset($gateway_list['conektaoxxopay']);
		unset($gateway_list['bacs']);
		unset($gateway_list['openpay_cards']);
		unset($gateway_list['woo-mercado-pago-basic']);
		break;
	}
	//echo wcpbc_get_woocommerce_country();
	//echo '<pre>'.print_r($gateway_list,1).'</pre>';
	return $gateway_list;
}

// Convertimos a libras
add_action( 'woocommerce_before_calculate_totals', 'set_custom_cart_item_weight', 25, 1 );
function set_custom_cart_item_weight( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    foreach( $cart->get_cart() as $cart_item ){
		$newweight=$cart_item['data']->get_weight();
		if($siglas=='US'){
			$cart_item['data']->set_weight($newweight*2.20462);
		}
    }
}
//Añadimos costo de UPS
function lebasi_ship2( $rates, $package ){
	//echo '<pre>'.print_r($package,1).'</pre>';
	$productos=array();
	foreach($package['contents'] as $pro){
		$productos[]=$pro['product_id'];
	}
	
	//echo '<pre>'.print_r($productos,1).'</pre>'; 
	//echo '<pre>'.print_r($rates,1).'</pre>'; 
	if(in_array(4055,$productos)){
		unset ($rates['flat_rate:51']);
	}
	
	
	$addCost=array();
	foreach($rates as $id=>$rate){
		if($rate->method_id=='flexible_shipping_ups'){
			$zones=get_option( 'wc_price_based_country_regions',true);
			//echo '<pre>'.print_r($zones['usa']['exchange_rate'],1).'</pre>';
			($rate->cost=($rate->cost+1)/$zones['usa']['exchange_rate']);
		}
		
		$addCost[$id]=$rate;
	}
	
	return $addCost;
}
add_filter( 'woocommerce_package_rates', 'lebasi_ship2', 10, 2 );


add_action('wp_ajax_nopriv_buscarnota','buscarnota');
add_action('wp_ajax_buscarnota','buscarnota');

function buscarnota(){
	$query = new WP_Query( array(
		'post_type' => 'post',
		's' => $_POST['search']
	));?>
	<div class="bg-light p-3 text-center">
		<a href="#" class="bot">
			<i class="fa fa-times"></i>
		</a>
		<h3 class="mb-4">Resultados</h3>
	<?php
	
	if ( $query->have_posts() ) : 
		while ( $query->have_posts() ) : $query->the_post();
		$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>
		<div class="row mt-1 border-top p-2">
			<div class="col-12 col-md-3">
				<a href="<?php the_permalink();?>">
					<img src="<?php echo $featured_img_url;?>" class="img-fluid">
				</a>
			</div>
			<div class="col-12 col-md-9">
				<a href="<?php the_permalink();?>" class="text-sm-center">
				<?php the_title();?>
				</a>
			</div>			
		</div><?php
		endwhile;
	else:?>
		<h4>No se encontraron resultados</h4><?php
	endif;?>
	</div><?php
	wp_die();
}


function buscador(){?>
<div class="row buscando">
	<div class="col-12">
		<form class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2">
		  <input class="form-control mr-3 w-75 buscador" type="text" placeholder="Buscar Nota"
			aria-label="Search">
		  <i class="fa fa-search"></i>
		</form>
		<div class="resultados-busca"></div>
	</div>
</div><?php	
}


function create_coupon_lebasi($userid){

	/**
	* Create a coupon programatically
	*/
	
	$coupon_code = base64url_encode($userid.'_'.rand(0,9).date('dHis')); // Code
	
	
	$amount = '10'; // Amount
	$discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product

	$coupon = array(
	'post_title' => $coupon_code,
	'post_content' => '',
	'post_excerpt' => 'Promoción Buen fin 2020',
	'post_status' => 'publish',
	'post_author' => 1,
	'post_type' => 'shop_coupon');

	$new_coupon_id = wp_insert_post( $coupon );

	// Add meta
	update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
	update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
	update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
	update_post_meta( $new_coupon_id, 'product_ids', '44, 20, 4054, 4053, 4055' );
	update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
	update_post_meta( $new_coupon_id, 'usage_limit', '1' );
	update_post_meta( $new_coupon_id, 'expiry_date', '2020-12-31' );
	update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
	update_post_meta( $new_coupon_id, 'free_shipping', 'yes' );
	update_post_meta( $new_coupon_id, 'userid', $userid );
	return $coupon_code;
}

function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

//add_action( 'woocommerce_order_status_processing', 'mysite_processing');
function mysite_processing($order_id) {
	$order = wc_get_order( $order_id );
	
	$order_data = $order->get_data();
	$user_email = $order_data['billing']['email'];
	//wp_mail('medinaramirez.isaias@gmail.com','Pruebas','<pre>'.print_r($user_email,1).'</pre>');
	$mailer = WC()->mailer();
	$recipient = $user_email;
	//$recipient ='medinaramirez.isaias@gmail.com';
	$subject = "Cupones promocionales";
	$content = get_custom_email_html_promobuen( $order_id, $subject, $mailer );
	$headers = "Content-Type: text/html\r\n";
	$mailer->send( $recipient, $subject, $content, $headers );
}

function get_custom_email_html_promobuen( $user_id, $heading = false, $mailer ) {
	$template = 'emails/promobuen.php';
	return wc_get_template_html( $template, array(
		'order'         => $user_id,
		'email_heading' => $heading,
		'sent_to_admin' => true,
		'plain_text'    => false,
		'email'         => $mailer
	) );
}


function lebasi_get_sales_by_coupon($coupon_id) {
 
    $args = [
        'post_type' => 'shop_order',
        'posts_per_page' => '-1',
        'post_status' => ['wc-processing', 'wc-completed', 'wc-on-hold']
    ];
    $my_query = new WP_Query($args);
    $orders = $my_query->posts;
 
    $total = 0;
 
    foreach ($orders as $key => $value) {
    
   $order_id = $value->ID;
   $order = wc_get_order($order_id);
   $items = $order->get_items('coupon'); 
 
   foreach ( $items as $item ) {
	//echo '<pre>'.print_r($item['code'],1).'</pre></br>';
	if( $item['code'] == sanitize_title($coupon_id )) {
			
            $total += $order->get_total();
	}
 
   }
    
    }
    return $total;
}


 


function galeriapromocionfoto(){?>
<style>
 #titulogaleria{
            font-size: 40px;
            color: white;
         
        }


</style>

<div id="galeriainicio">
	
	<script async src="https://static.addtoany.com/menu/page.js" asyn defer></script>
	
	
	<h1 class="text-center mt-4" id="titulogaleria" >GALERÍA DE FOTOS</h1>
	<!-- Gallery -->
	<div class="row mx-2">
		<?php
		global $wpdb;
		$galeria=$wpdb->get_results("select * from pagina_promociones order by rand()");?>
		
		<?php
		foreach($galeria as $foto){
			$image = wp_get_attachment_image( $foto->fotoid,'galeriapromo',true, array('loading'=>'lazy','class'=>'w-100 h-auto mx-auto d-block') );
			$link=site_url().'/promociones/foto/'.urlencode(base64_encode('lebasi_foto_'.$foto->id.'#'.uniqid()));?>
				<div class="col-12 col-md-4 mx-0">
					<div class="card mb-2 a_<?php echo $a; ?>" >
						<a class="linkfoto" href="<?php echo $link;?>">
							<?php echo $image; ?>
							<div class="d-flex">
								<h3 class="text-center text-dark col-9 mt-3"><?php echo $foto->titulo_foto;?></h3>
								<p class="likegallery mr-2 text-right col-3"><span class="mr-1"><?php echo getvotosfoto($foto->id);?></span><i class="fa fa-heart text-danger" aria-hidden="true"></i></p>
							</div>
						</a>						
						<!-- AddToAny BEGIN -->
						<div class="p-2">
							<p class="mt-3">Comparte:</p>
								<div class="a2a_kit a2a_kit_size_32 a2a_default_style mt-1 mb-4" data-a2a-url="<?php echo $link;?>">
									<a class="a2a_button_facebook" ></a>
									<a class="a2a_button_facebook_messenger"></a>
									<a class="a2a_button_twitter"></a>
									<a class="a2a_button_whatsapp"></a>
									<button style="float:right;" class="sharebtn" onclick="CopyMe('<?php echo $link;?>')"><i class="fa fa-share-alt"></i></button>
								</div>
							<script>
							var a2a_config = a2a_config || {};
							a2a_config.locale = "es";
							</script>
						</div>
					</div>
				</div>
			<?php
			
		}?>		
	</div>
</div><?php	
}

add_action('wp_ajax_guardaregistropromo','guardaregistropromo');
add_action('wp_ajax_nopriv_guardaregistropromo','guardaregistropromo');
function guardaregistropromo(){
	global $wpdb;
	$valida=validalotecaja($_POST['num_lote'],$_POST['num_caja']);
	$lotecaja=$_POST['num_lote']." ".$_POST['num_caja']." ".$_POST['num_bote'];
	$_POST['validacajas']=false;
	$query="select id from pagina_promociones where lote='".$lotecaja."'";
	$validaloc=$wpdb->get_var($query);
	
	if($valida->validacion && !$validaloc){
		unset($_POST['action']);	
		$_POST['lote']=$lotecaja;
		unset($_POST['cecky']);
		unset($_POST['num_bote']);
		unset($_POST['num_caja']);
		unset($_POST['num_lote']);
		unset($_POST['validacajas']);
		$_POST['fecha']=date('Y-m-d H:m:s');
		$wpdb->show_errors();
		$wpdb->insert('pagina_promociones',$_POST);
		$idreg=$wpdb->insert_id;
		$_POST['registro']=$idreg;
		$_POST['validez']=$valida;
		$_POST['validacajas']=true;
		$link=site_url().'/promociones/foto/'.urlencode(base64_encode('lebasi_foto_'.$idreg.'#'.uniqid()));
		//wp_mail('santiagobama98@gmail.com','CON LEBASI TODOS GANAN - Gracias por participar',mensajepromo($link,$idreg),array('Bcc:medinaramirez.isaias@gmail.com','Content-Type: text/html; charset=UTF-8'));
		wp_mail($_POST['correo'],'CON LEBASI TODOS GANAN - Gracias por participar',mensajepromo($link,$idreg),array('Bcc:sistema@lebasigroup.com','Content-Type: text/html; charset=UTF-8'));
	}
	$_POST['validaloc']=$validaloc;
	$_POST['link']=$link;
	$_POST['validadata']=$valida;
	$_POST['query']=$query;
	wp_send_json($_POST);
}

add_action('wp_ajax_guardarconsulta','guardarconsulta');
add_action('wp_ajax_nopriv_guardarconsulta','guardarconsulta');

function guardarconsulta(){
	global $wpdb;
	unset($_POST['action']);	
	unset($_POST['cecky']);
	$wpdb->insert('registro_Citas',$_POST);
	enviacita($_POST);
	$_POST['query']=$query;
	//ToDo enviar cita al sistema de citas
	wp_mail('medinaramirez.isaias@gmail.com',"Se agenda una Cita",'<pre>'.print_r($_POST,1).'</pre>');
	//ToDo cambiar texto de correo de citas
	wp_mail($_POST['correo'],'CON LEBASI TODOS GANAN - Cita Agendada',mensajepromo2(),array('Bcc:sistema@lebasigroup.com','Content-Type: text/html; charset=UTF-8'));
	wp_send_json($_POST);
	
}

/*function enviacita($datox){
	$datos=array(
		"type"=>"altacita",
		"more"=>$datox
	);
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://201.151.142.195/apiLebasi',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS =>json_encode($datos),
  CURLOPT_HTTPHEADER => array(
    'apiKey: MjgjFiif80RmCr1021',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;
}

add_action('wp_ajax_galeriafotos','galeriafotos');
add_action('wp_ajax_nopriv_galeriafotos','galeriafotos');
function galeriafotos(){
	galeriapromocionfoto();	
	wp_die();
}

/*
function validalotecaja($lote=false,$caja=false){
	if($lote && $caja){
		$datos=array(
			"type"=>"getlotecaja",
			"more"=>array(
				"pais"=>"MEX",
				"lote"=>$lote,
				"caja"=>$caja,
			)
		);
		$datosa=json_encode($datos);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://201.151.142.195/apiLebasi',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_POSTFIELDS =>$datosa,
		  CURLOPT_HTTPHEADER => array(
			'apiKey: MjgjFiif80RmCr1021',
			'Content-Type: application/json'
		  ),
		));
		$response= json_decode(curl_exec($curl));
		curl_close($curl);
		$response->valida=false;
		if($response->data->botesvendidos>0){
			$response->validacion=true;
		}
	}	
	return $response;
}*/

/*add_action('wp_ajax_consultarfechacita','consultarfechacita');
add_action('wp_ajax_nopriv_consultarfechacita','consultarfechacita');
function consultarfechacita(){
	if(date("w",strtotime($_POST['fecha']))==0 || date("w",strtotime($_POST['fecha']))==6 ){
		$_POST['weekend']=true;
	}else{
	$curl = curl_init();
	$datos=array(
		"type"=>"consultahoracita",
		"more"=>array(
			"pais"=>"MEX",
			"fecha"=>$_POST['fecha'],
		)
	);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://201.151.142.195/apiLebasi',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_POSTFIELDS =>json_encode($datos),
	  CURLOPT_HTTPHEADER => array(
		'apiKey: MjgjFiif80RmCr1021',
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	
	$citax=json_decode($response,true);
	$citas=$citax['data']['citas'];
	//echo '<pre>'.print_r($citas,1).'</pre>';
	foreach(citas() as $hora){
		if(array_key_exists($hora,$citas)){
			$citasreg[$hora]=count($citas[$hora]);
		}
	}
	$_POST['citas']=$citas;
	$_POST['citasreg']=$citasreg;
	}
		
	wp_send_json($_POST);
}
*/
function citas(){
	$array=array('10:00','10:40','11:20','12:00','12:40','13:20','15:00','15:40','16:20','17:00','17:40');
	return $array;
}

add_action('wp_ajax_emitevoto','emitevoto');
add_action('wp_ajax_nopriv_emitevoto','emitevoto');
function emitevoto(){
	global $wpdb;
	unset($_POST['action']);
	$_POST['fecha']=date('Y-m-d H:i:s');	
	$fotoget=$_POST['foto'];
	$var=explode('_',urldecode(base64_decode($fotoget)));
	$var2=explode('#',$var[2]);
	$postid=$var2[0];
	$query="select id from promocion_votos where email='{$_POST['email']}' and foto={$postid}";
	$res=$wpdb->get_var($query);
	if($res){
		$_POST['voto']=false;
		$_POST['mensaje']='Ya has votado por esta fotografia, lo sentimos solo puedes emitir un voto por concursante';
	}else{
		$_POST['foto']=$postid;
		$wpdb->insert('promocion_votos',$_POST);
		$_POST['voto']=true;
	}
	wp_send_json($_POST);
}

function getvotosfoto($foto){
	global $wpdb;
	$query="select count(id) from promocion_votos where foto={$foto} group by foto";
	$res=$wpdb->get_var($query);
	return $res;
}

add_action('wp_ajax_registrarPM20222','registrarPM20222');
add_action('wp_ajax_nopriv_registrarPM20222','registrarPM20222');
function registrarPM20222(){
	// Build POST request to get the reCAPTCHA v3 score from Google
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_secret = '6LcHWi0fAAAAADM2f_rM9y94j6wxFywqg4lSjmW4'; // Insert your secret key here
	$recaptcha_response = $_POST['recaptcha_response'];
	 
	// Make the POST request
	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
	$rec=json_decode($recaptcha);
	
	//if($rec['Success']
	global $wpdb;
	
	$datos=array(
			'nombre'=>$_POST['nombre'],
			'correo'=>$_POST['correo'],
			'telefono'=>$_POST['telefono'],
			'codigo'=>$_POST['codigo'],
			//'sexo'=>$_POST['sexo'],
			'codigoGenerado'=>$_POST['codigoGene']
		);

	$correo=$_POST['correo'];
	//echo '<pre>'.print_r(,1).'</pre>';
	if($_POST['codigo']==''){
		
		$query="select correo from promocion_Marzo2022";
		$codigos=$wpdb->get_results($query);
		//echo '<pre>'.print_r($codigos,1).'</pre>';
		$correoExiste=0;
		foreach($codigos as $codigo){
			if($codigo->correo == $_POST['correo'] ){
				$correoExiste++;
			}
			//echo '<pre>'.print_r($correoExiste,1).'</pre>';
		}
		if($correoExiste==0){
			$res = $wpdb->insert('promocion_Marzo2022',$datos);?>
		<br><h4><strong>¡YA ESTÁS MÁS CERCA DE GANAR!</strong></h4>
		<p>En este momento, ya te encuentras participando para ganarte una <strong> Alexa 4ta generación + un Roku</strong></p>
		<br><p>Este es tu código para compartir</p>	
		<br><h4><strong><?php echo $_POST['codigoGene']?></strong></h4><?php
		date_default_timezone_set('America/Mexico_City');
		ob_start();?>
		<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
		<tr>
		<td style="padding-left:20px;padding-right:20px;">
		<div style="font-family: Arial, sans-serif">
		<div style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
		<p style="margin: 0; font-size: 38px; text-align: center;"><span style="font-size:38px;color:#333333;"><strong>Gracias por participar, tu registro fue exitoso</strong></span></p>
		</div>
		</div>
		</td>
		</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td style="padding-left:20px;padding-right:20px;padding-top:80px;">
			<div style="font-family: Arial, sans-serif">
			<div style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
			<p style="margin: 0; font-size: 38px; text-align: center;"><span style="font-size:26px;color:#333333;">Comparte tu código </span></p>
			</div>
			</div>
			</td>
			</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
			<div style="font-family: sans-serif">
			<div style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #434040; line-height: 1.2; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif;">
			<p style="margin: 0; font-size: 14px; text-align: center;"><span style="font-size:42px;color:#ffffff;background-color:#000000;"><strong><?php echo $_POST['codigoGene']?> </strong></span></p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td style="padding-left:20px;padding-right:20px;">
			<div style="font-family: Arial, sans-serif">
			<div style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
			<p style="margin: 0; text-align: center;"><span style="font-size:26px;">para que tengas más oportunidades de ganar.</span></p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td style="padding-left:20px;padding-right:20px;padding-top:45px;">
			<div style="font-family: Arial, sans-serif">
			<div style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
			<p style="margin: 0; text-align: center;"><span style="font-size:42px;color:#3e3e3e;"><strong>Recuerda entre más votos por registro obtengas, más posibilidades tienes de ganar.</strong></span></p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
			<tr>
			<td style="text-align:center;padding-top:95px;padding-right:10px;padding-bottom:120px;padding-left:10px;">
			<div align="center">
			<!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://lebasi.com.mx/promociones" style="height:46px;width:222px;v-text-anchor:middle;" arcsize="9%" stroke="false" fillcolor="#ff0000"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:20px"><![endif]--><a href="https://lebasi.com.mx/promociones" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ff0000;border-radius:4px;width:auto;border-top:1px solid #ff0000;border-right:1px solid #ff0000;border-bottom:1px solid #ff0000;border-left:1px solid #ff0000;padding-top:5px;padding-bottom:5px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:20px;padding-right:20px;font-size:20px;display:inline-block;letter-spacing:normal;"><strong><span data-mce-style="font-size: 20px; line-height: 36px;" style="font-size: 20px; line-height: 36px;">Revisa las bases</span></strong></span></a>
			<!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
			</div>
			</td>
			</tr>
		</table><?php		
		$tit3='Registro de Promocion Lebasi Marzo 2022 | '.date('d-m-Y H:i:s');
		$msg3 = ob_get_contents();
		ob_end_clean();
		correos_lebasi_web( $correo,'Promocion Participa y Gana', $msg3);
		wp_die();
		}else{
			$response=array('correo'=>$correoExiste);
			/*echo '<pre>'.print_r($response,1).'</pre>';
			return $response;*/
			wp_send_json($response);
		}
	}else{
		$query="select codigoGenerado,correo from promocion_Marzo2022";
		$codigos=$wpdb->get_results($query);
		//echo '<pre>'.print_r($codigos,1).'</pre>';
		$codigoExiste=0;
		$correoExiste=0;
		foreach($codigos as $codigo){
			if($codigo->codigoGenerado==$_POST['codigo']){
			$codigoExiste=1;
			}
			
			if($codigo->correo == $_POST['correo'] ){
				$correoExiste++;
			}
			//echo '<pre>'.print_r($codigo->codigoGenerado,1).'</pre>';
		}
		if($codigoExiste==1 && $correoExiste==0){
			$res = $wpdb->insert('promocion_Marzo2022',$datos);?>
			<br><h4><strong>¡Registro Exitoso!</strong></h4>
		<p>Gracias por registrarte. El participante con código "<strong><?php echo $_POST['codigo']?></strong>" ya se encuentra más cerca de ganar.</p>
		<br><p>Recuerda que tú también puedes participar para ganar. Este es tu código para compartir:</p>	
		<br><h4><strong><?php echo $_POST['codigoGene']?></strong></h4><?php
		date_default_timezone_set('America/Mexico_City');
		ob_start();?>
		<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
		<tr>
		<td style="padding-left:20px;padding-right:20px;">
		<div style="font-family: Arial, sans-serif">
		<div style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
		<p style="margin: 0; font-size: 38px; text-align: center;"><span style="font-size:38px;color:#333333;"><strong>Gracias por participar, tu registro fue exitoso</strong></span></p>
		</div>
		</div>
		</td>
		</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td style="padding-left:20px;padding-right:20px;padding-top:80px;">
			<div style="font-family: Arial, sans-serif">
			<div style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
			<p style="margin: 0; font-size: 38px; text-align: center;"><span style="font-size:26px;color:#333333;">Comparte tu código </span></p>
			</div>
			</div>
			</td>
			</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
			<div style="font-family: sans-serif">
			<div style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #434040; line-height: 1.2; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif;">
			<p style="margin: 0; font-size: 14px; text-align: center;"><span style="font-size:42px;color:#ffffff;background-color:#000000;"><strong><?php echo $_POST['codigoGene']?> </strong></span></p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td style="padding-left:20px;padding-right:20px;">
			<div style="font-family: Arial, sans-serif">
			<div style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
			<p style="margin: 0; text-align: center;"><span style="font-size:26px;">para que tengas más oportunidades de ganar.</span></p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td style="padding-left:20px;padding-right:20px;padding-top:45px;">
			<div style="font-family: Arial, sans-serif">
			<div style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
			<p style="margin: 0; text-align: center;"><span style="font-size:42px;color:#3e3e3e;"><strong>Recuerda entre más votos por registro obtengas, más posibilidades tienes de ganar.</strong></span></p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
			<tr>
			<td style="text-align:center;padding-top:95px;padding-right:10px;padding-bottom:120px;padding-left:10px;">
			<div align="center">
			<!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://lebasi.com.mx/promociones" style="height:46px;width:222px;v-text-anchor:middle;" arcsize="9%" stroke="false" fillcolor="#ff0000"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:20px"><![endif]--><a href="https://lebasi.com.mx/promociones" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ff0000;border-radius:4px;width:auto;border-top:1px solid #ff0000;border-right:1px solid #ff0000;border-bottom:1px solid #ff0000;border-left:1px solid #ff0000;padding-top:5px;padding-bottom:5px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:20px;padding-right:20px;font-size:20px;display:inline-block;letter-spacing:normal;"><strong><span data-mce-style="font-size: 20px; line-height: 36px;" style="font-size: 20px; line-height: 36px;">Revisa las bases</span></strong></span></a>
			<!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
			</div>
			</td>
			</tr>
		</table><?php		
			$tit3='Registro de Promocion Lebasi Marzo 2022 | '.date('d-m-Y H:i:s');
			$msg3 = ob_get_contents();
			ob_end_clean();
			correos_lebasi_web( $correo,'Promocion Participa y Gana', $msg3);
			wp_die();
		}else{
			//echo '<pre>'.print_r($codigoExiste,1).'</pre>';
			$response=array('codigo'=>$codigoExiste, 'correo'=>$correoExiste,'captcha'=>$recaptcha);
			/*echo '<pre>'.print_r($response,1).'</pre>';
			return $response;*/
			wp_send_json($response);
		}
		?>
	<?php	
	}
}

if (!function_exists('getallheaders')) {
    function getallheaders() {
    $headers = [];
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
    }
}

add_image_size('galeriapromo', false );



// add custom endpoint for My Account menu
add_filter ( 'woocommerce_account_menu_items', 'wptips_customize_account_menu_items' );
function wptips_customize_account_menu_items( $menu_items ){
    $rolex=wcmo_get_current_user_roles();
	$roles=array();
	
	if(!is_array($rolex)){
		$roles[]=$rolex;
	}else{
		$roles=$rolex;
	}
	
	
	if(count(array_intersect($roles,array('administrator','distribuidor'))) > 0){ 
		
		///$new_menu_item = array('datoslebasi'=>'Mis datos Lebasi');  // Define a new array with cutom URL slug and menu label text
		//$new_menu_item = array('backoffice'=>'Backoffice');  // Define a new array with cutom URL slug and menu label text
		//$new_menu_item_position=2; // Define Position at which the New URL has to be inserted
		
		//array_splice( $menu_items, ($new_menu_item_position-1), 0, $new_menu_item );
	}
	//echo '<pre>'.print_r($menu_items,1).'</pre>';
    return $menu_items;
}
// point the endpoint to a custom URL
add_filter( 'woocommerce_get_endpoint_url', 'wptips_custom_woo_endpoint', 10, 2 );
function wptips_custom_woo_endpoint( $url, $endpoint ){
     if( $endpoint == 'datoslebasi' ) {
        $url = site_url('datoslebasi'); 
    }
    return $url;
	
}




function correoweb($texto,$titulo){
	ob_start();?>
	<!DOCTYPE html>

<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
<!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet" type="text/css"/>
<!--<![endif]-->
<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
		}

		p {
			line-height: inherit
		}

		@media (max-width:660px) {
			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}

			.row-content {
				width: 100% !important;
			}

			.column .border {
				display: none;
			}

			.stack .column {
				width: 100%;
				display: block;
			}
		}
	</style>
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
<table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/BdayCakePromoWIDE4_1.jpg'); background-position: center top; background-repeat: no-repeat;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">
<tbody>
<tr>
<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
<table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td style="width:100%;padding-right:0px;padding-left:0px;">
<div align="center" style="line-height:10px"><img alt="I'm an image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logolebasi.png" style="display: block; height: auto; border: 0; width: 288px; max-width: 100%;" title="I'm an image" width="288"/></div>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td style="padding-bottom:25px;padding-left:10px;padding-right:10px;padding-top:25px;">
<div align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="65%">
<tr>
<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px dotted #FFFFFF;"><span> </span></td>
</tr>
</table>
</div>
</td>
</tr>
</table>
<!--Aqui Insertamos el contenido del correo -->
<?php echo $texto?>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">
<tbody>
<tr>
<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
<table border="0" cellpadding="0" cellspacing="0" class="social_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td style="padding-left:10px;padding-right:10px;padding-top:25px;text-align:center;">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="156px">
<tr>
<td style="padding:0 10px 0 10px;"><a href="https://www.facebook.com/LACTOSERUM.ALIMENTO.NATURAL" target="_blank"><img alt="Facebook" height="32" src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook2x.png" style="display: block; height: auto; border: 0;" title="Facebook" width="32"/></a></td>
<td style="padding:0 10px 0 10px;"><a href="https://www.instagram.com/lebasi_swiss_group/" target="_blank"><img alt="Instagram" height="32" src="<?php echo get_stylesheet_directory_uri(); ?>/images/instagram2x.png" style="display: block; height: auto; border: 0;" title="Instagram" width="32"/></a></td>
<td style="padding:0 10px 0 10px;"><a href="https://www.youtube.com/user/LEBASIWORLD" target="_blank"><img alt="YouTube" height="32" src="<?php echo get_stylesheet_directory_uri(); ?>/images/youtube2x.png" style="display: block; height: auto; border: 0;" title="YouTube" width="32"/></a></td>
</tr>
</table>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
<tr>
<td style="padding-bottom:25px;padding-left:10px;padding-right:10px;padding-top:25px;">
<div style="font-family: sans-serif">
<div style="font-size: 12px; mso-line-height-alt: 21.6px; color: #a1a1a1; line-height: 1.8; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif;">
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 28.8px; letter-spacing: normal;"><span style="font-size:16px;color:#808080;">Lebasi Swiss Group<br/></span></p>
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 28.8px; letter-spacing: normal;"><span style="font-size:16px;color:#808080;">LEBASI MÉXICO<br/></span></p>
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 28.8px; letter-spacing: normal;"><span style="font-size:16px;color:#808080;"><u>contacto@lebasigroup.com</u></span></p>
</div>
</div>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">
<tbody>
<tr>
<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">

</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table><!-- End -->
</body>
</html>
	<?php
	$html = ob_get_contents();
	ob_end_clean();	
	return $html;	
}

function correos_lebasi_web( $para, $titulo, $texto, $headers = '', $attachments = array()){
	add_filter( 'wp_mail_content_type', function( $content_type ) {
		return 'text/html';
	});
	wp_mail($para,$titulo,correoweb($texto,$titulo),$headers,$attachments);
}


add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'USD': $currency_symbol = 'USD $'; break;
		  case 'ARS': $currency_symbol = 'ARS $'; break;
		  case 'MXN': $currency_symbol = 'MXN $'; break;
     }
     return $currency_symbol;
}

add_action('woocommerce_before_calculate_totals', 'change_cart_item_quantities', 20, 1 );
function change_cart_item_quantities ( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;
	$maxcount=0;
	$countitem=0;
    foreach( $cart->get_cart() as $cart_item_key => $cart_item ) {
		//echo '<pre>'.print_r($cart_item,1).'</pre>';
		$maxcount=$maxcount+$cart_item['quantity'];
		if($maxcount>=2){
			$new_qty=2;
			wc_get_cart_url();
			wp_redirect( wc_get_cart_url() );
			//wp_die();
			wc_add_notice( 'Compra máxima por cliente de 2 paquetes. Si te interesa realizar una compra mayor y recibir un mejor precio contáctanos.','error');
		}else{
			$new_qty=$cart_item['quantity'];
		}
		//echo $new_qty;
        $cart->set_quantity( $cart_item_key, $new_qty );
    }
	return $cart;
}


/*function NewApiLebasi($array){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://201.151.142.195/app/api/v3',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>json_encode($array),
	  CURLOPT_HTTPHEADER => array(
		'apiKey: MjgjFiif80RmCr1021',
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return json_decode($response);
}*/


function getPaisLebasi(){
	$siglas=getCountryIP();
	$pa=array(
		"MX"=>"MEX",
		"US"=>"USA",
		"PE"=>"PER",
		"AR"=>"ARG"
	);
	return $pa[$siglas];
}




/*add_action('wp_ajax_getEmpresarioExiste','getEmpresarioExiste');
function getEmpresarioExiste(){
	//$empresario=getApiLebasi('getEmpresarioIntranet','','MX',array('emp'=>$_POST['emp'],'pais'=>'MEX'));
	$options=array(
		'type'=>'getEmpresario',
		'NumEmpresario'=>$_POST['emp'],
		'PaisEmpresario'=>getCountryIP()
	);
	$res=NewApiLebasi($options);
	wp_send_json($res);
}*/


add_action('wp_ajax_preorden','preorden');
function preorden(){
	ob_start();?>
	<table>
		<tr>
			<td>Empresario</td>
		</tr>
		<tr>
			<td><?php echo $_POST['numempresario']?></td>
		</tr>
	</table><?php	
	$html = ob_get_contents();
	$_POST['orden']=$html;
	ob_end_clean();
	wp_send_json($_POST);
}


//Formulario Inscripción
include_once( get_template_directory() . '/functions/formularioinscripcion.php' );
//Formulario Salud
include_once( get_template_directory() . '/functions/formulariosalud.php' );
//Formulario Promo
include_once( get_template_directory() . '/functions/formulario-promo.php' ); 
//Regalos
include_once( get_template_directory() . '/functions/regalos.php' );
//Woocommerce
include_once( get_template_directory() . '/functions/woocommerce.php' );
//Correo Promociones
include_once( get_template_directory() . '/functions/correopromo.php' );
//Nuevo Backoffice
include_once( get_template_directory() . '/functions/backoffice.php' );
//Nuevo Facturacion
include_once( get_template_directory() . '/functions/facturacion.php' );


add_filter( 'woocommerce_add_to_cart_redirect', 'wp_kama_woocommerce_add_to_cart_redirect_filter', 10, 2 );
function wp_kama_woocommerce_add_to_cart_redirect_filter( $wc_get_cart_url, $null ){
	//echo $wc_get_cart_url;
	//wp_die();
	return $wc_get_cart_url;
}

add_action('wp_ajax_consultapremios','consultapremios');
add_action('wp_ajax_nopriv_consultapremios','consultapremios');
function consultapremios(){
	global $wpdb;
	
	$query="select * from {$wpdb->prefix}premiospromo_p where level != 0 order by level desc";
	if($_POST['tipo']=='empresario'){
		$query="select * from {$wpdb->prefix}premiospromo where level != 0 order by level desc";
	}
	$res=$wpdb->get_results($query);
	wp_send_json($res);
}

add_action('wp_ajax_revisarem','revisarem');
add_action('wp_ajax_nopriv_revisarem','revisarem');
function revisarem(){
	///*
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	//*/
	global $wpdb;
	$texto_buscar = $_POST['nombre'];
	$querys="SELECT * FROM app_empresario WHERE (SOUNDEX(CONCAT(TRIM(Nombre), ' ', TRIM(APaterno), ' ', TRIM(AMaterno))) = SOUNDEX('".$texto_buscar."'))
		OR (SOUNDEX(CONCAT(TRIM(Nombre), ' ', TRIM(AMaterno), ' ', TRIM(APaterno))) = SOUNDEX('".$texto_buscar."'))
		OR (SOUNDEX(CONCAT(TRIM(APaterno), ' ', TRIM(Nombre), ' ', TRIM(AMaterno))) = SOUNDEX('".$texto_buscar."'))
		OR (SOUNDEX(CONCAT(TRIM(APaterno), ' ', TRIM(AMaterno), ' ', TRIM(Nombre))) = SOUNDEX('".$texto_buscar."'))
		OR (SOUNDEX(CONCAT(TRIM(AMaterno), ' ', TRIM(Nombre), ' ', TRIM(APaterno))) = SOUNDEX('".$texto_buscar."'))
		OR (SOUNDEX(CONCAT(TRIM(AMaterno), ' ', TRIM(APaterno), ' ', TRIM(Nombre))) = SOUNDEX('".$texto_buscar."'));";
	$query[]=$querys;
	$res=db($querys);
	$data=array();
	
	foreach($res as $er){
		//echo '<pre>'.print_r($er,1).'</pre>';
		$data[]=$er['NumEmpresario'];
	}
	$remision=explode('-',$_POST['remision']);
	$suc=$remision[0];
	$NumRemision=$remision[1];
	$rem="select * from mex_remision where ClaveSucursal='".$suc."' and NumRemision='".$NumRemision."'";
	$query[]=$rem;
	$resrem=db($rem);
	$msgf="";
	$rmereg="SELECT * FROM `lebasimx_promojul23` where remision='".$_POST['remision']."';";
	$resreg=$wpdb->get_row($rmereg);
	if($res){
		if($resrem){
			//if($resrem[0]['NumEmpresario']!=$res[0]['NumEmpresario']){
			if(!in_array($resrem[0]['NumEmpresario'],$data)){
				$msgf="No se pudo validar la remisión, el nombre no coincide con los datos registrados";
			}
			if($resrem[0]['MesComision']!="SEP/2023"){
				$msgf="La remision no puede participar en la promoción";
			}
			if($resrem[0]['Monto']<1300){
				$msgf="La remision no puede participar en la promoción, ya que no cumple el monto adecuado";
			}
			if($resreg){
				$msgf="La remisión ya ha sido registrada, cada remision solo puede participar una sola vez";
			}
		}else{
			$msgf="La remision no puede ser validada";
		}
	}else{
		$msgf="No se ha validado el nombre de empresario";
	}
	$ret=array('resultados'=>$res,'query'=>$query,'remision'=>$resrem,'mensajes'=>$msgf,'data'=>$data);	
	//echo '<pre>'.print_r($ret,1).'</pre>';
	wp_send_json($ret);
}


add_action('wp_ajax_revisarem2','revisarem2');
add_action('wp_ajax_nopriv_revisarem2','revisarem2');
function revisarem2(){
	/*
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	//*/
	global $wpdb;
	
	$remision=explode('-',$_POST['remision']);
	$suc=$remision[0];
	$NumRemision=$remision[1];
	$rem="select * from mex_det_rem_botes where Lote='".$_POST['lote']."' and Caja='".$_POST['caja']."' and Lote in (1002,1003,1004)";
	$query[]=$rem;
	$resrem=db($rem);
	$msgf="";
	$rmereg="SELECT * FROM `lebasimx_promojul23` where remision='".$_POST['lote']."-".$_POST['caja'].$_POST['bote']."';";
	$resreg=$wpdb->get_row($rmereg);
	if($resrem){
		if($resreg){
			if(count($resreg)>24){
				$msgf="Esta caja ya participo complemante en la promoción";
			}
		}else{

		}
	}else{
		$msgf="No se ha validado el Lote y Caja, el bote aun no se ha remisionado";
	}
	$ret=array('resultados'=>$resrem,'query'=>$query,'remision'=>$_POST,'mensajes'=>$msgf,'data'=>$data);	
	//echo '<pre>'.print_r($ret,1).'</pre>';
	wp_send_json($ret);
}


add_action('wp_ajax_premioindi','premioindi');
add_action('wp_ajax_nopriv_premioindi','premioindi');
function premioindi(){
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/
	global $wpdb;
	$table=$wpdb->prefix."premiospromo_p";
	$slices=14;
	$levels=" and level in (6,7,8,9)";
	if($_POST['tipo']=='empresario'){
		$table=$wpdb->prefix."premiospromo";
		$slices=15;
		$levels=" and level in (2,3,4,5,6,7) ";
	}
	
	$query="select * from {$table} where level != 0 and stock > 0 ".$levels." ORDER BY RAND() LIMIT 1;";
	$res=$wpdb->get_row($query,ARRAY_A);
	$last[]=$wpdb->last_error;
	$uni=uniqid();
	$wpdb->update($table,array("stock"=>$res['stock']-1),array('id'=>$res['id']));
	$last[]=$wpdb->last_error;
	$wpdb->insert($wpdb->prefix.'promojul23',array(
		"uniqid"=>$uni,
		"premio"=>$res['premio'],
		"nombre"=>$_POST['nombre'],
		"correo"=>$_POST['correo'],
		"celular"=>$_POST['telefono'],
		"remision"=>$_POST['remision'],
	));
	$last[]=$wpdb->last_error;
	wp_send_json(array(
		"query"=>$query,
		"res"=>$res,
		"level"=>(int)$res['level'],
		"grados"=>((($res['level']*1)-1)*(360/$slices)+3),
		"slices"=>$slices,
		//"grados"=>(((1*1)-1)*(360/14))+7,
		"uniqid"=>$uni,
		"last"=>$last
	));
}



add_action('wp_ajax_premioindica2','premioindica2');
add_action('wp_ajax_nopriv_premioindi','premioindica2');
function premioindica2(){
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/
	global $wpdb;
	$table=$wpdb->prefix."premiospromo_p";
	$slices=14;
	if($_POST['tipo']=='empresario'){
		$table=$wpdb->prefix."premiospromo";
		$slices=15;
	}
	
	$query="select * from {$table} where level != 0 and stock > 0 ORDER BY RAND() LIMIT 1;";
	$res=$wpdb->get_row($query,ARRAY_A);
	$last[]=$wpdb->last_error;
	$uni=uniqid();
	$wpdb->update($table,array("stock"=>$res['stock']-1),array('id'=>$res['id']));
	$last[]=$wpdb->last_error;
	$wpdb->insert($wpdb->prefix.'promojul23',array(
		"uniqid"=>$uni,
		"premio"=>$res['premio'],
		"nombre"=>$_POST['nombre'],
		"correo"=>$_POST['correo'],
		"celular"=>$_POST['telefono'],
		"remision"=>$_POST['lote']."-".$_POST['caja']."-".$_POST['bote'],
	));
	$last[]=$wpdb->last_error;
	wp_send_json(array(
		"query"=>$query,
		"res"=>$res,
		"level"=>(int)$res['level'],
		"grados"=>((($res['level']*1)-1)*(360/$slices))+6,
		//"grados"=>(((1*1)-1)*(360/14))+7,
		"uniqid"=>$uni,
		"last"=>$last
	));
}
function db($sql){
	//echo $sql;
	$domain=$_SERVER['SERVER_NAME'];
	
	$host='localhost';
	$user='lebasi_app';
	$db='lebasi_app';
	$pass='Lactoserum22###';	
	
	if($domain=='lebasi.local'){
		$host='localhost:10016';
		$user='root';
		$db='lebasi_app';
		$pass='root';
	}
	$mysqli = new mysqli($host, $user, $pass, $db);
	
	mysqli_set_charset($mysqli, 'utf8');
	if(!$mysqli) {
		echo "Error: No se ha podido conectar a la base de datos\n";
	}else{
		//echo "Se conecto a la bd";
	}
	$rows=array();
	$procesa = $mysqli->query($sql);
	if($procesa){
		$rowsn=0;
		if(isset($procesa->num_rows)){
			$rowsn=$procesa->num_rows;
		}
		if($rowsn>0){
			$rows = $procesa->fetch_all(MYSQLI_ASSOC);
		}
	}else{
		$rows=$mysqli->error;
	}
	$mysqli->close();
	return $rows;	
}


add_filter('woocommerce_is_purchasable', 'disable_product_purchase', 10, 2);
function disable_product_purchase($purchasable, $product) {
	$pais=wcpbc_get_woocommerce_country();
	if($pais!='MX' && $pais!='PE'){
		$purchasable = false;
	}
	return $purchasable;
}