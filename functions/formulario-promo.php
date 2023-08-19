<?php

add_action( 'wp_enqueue_scripts', 'wpdocs_promo' );
function wpdocs_promo() {
	global $pagenow;
	global $wp_query;
	$pagename=isset($wp_query->query['pagename'])?$wp_query->query['pagename']:'';
	if($pagename=="promocion"){
		wp_register_script('promo', get_stylesheet_directory_uri().'/vendor/js/promo.js', array('jquery'), '1.1'.date('YmdHis'),true);
		wp_enqueue_script('promo');
		//wp_enqueue_style( 'regalos_style', get_stylesheet_directory_uri().'/vendor/css/regalos.css','1.1'.date('YmdHis') );
	}
}

// Shortcode de formulario
function promo_func() {	
	ob_start();
	$country=getPaisIp();
	if($country->status=='success'){
		$siglas=$country->data->geo->country_code;
	}
	global $wp_query;
	?>
	
	<form id="promo">
		<div class="form-group row">
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Nombre <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="Apaternoh" placeholder="Nombre" name="nombre" required>
				<small id="AMaternoh" class="form-text text-muted">Proporciona tu nombre</small>
			</div>
		</div>
		<div class="form-group row">
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Correo <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="Apaternoh" placeholder="Email" name="email" required>
				<small id="AMaternoh" class="form-text text-muted">Proporciona un correo electrónico</small>
			</div>
		</div>
		<div class="form-group row">
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Teléfono <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="Apaternoh" placeholder="Teléfono" name="telefono" required>
				<small id="AMaternoh" class="form-text text-muted">Proporciona un teléfono</small>
			</div>
		</div>
		<div class="form-group row">
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Tema de Interes<abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<select class="form-control" name="tema">
					<option value="">Selecciona un tema</option>
					<option value="Control de peso">Control de peso</option>
					<option value="Diabetes">Diabetes</option>
					<option value="Hipertensión">Hipertensión</option>
					<option value="Belleza">Belleza</option>
					<option value="Estrés y ansiedad">Estrés y ansiedad</option>
					<option value="Desintoxicación">Desintoxicación</option>
					<option value="Deporte">Deporte</option>
					<option value="Embarazo y lactancia">Embarazo y lactancia</option>
					<option value="Otro">Otro</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Comentario <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<textarea class="form-control" name="pregunta"></textarea>
			</div>
		</div>
		<div class="form-group row" >
			<input type="hidden" name="action" value="promoform">
			<div class="col-sm-9 offset-sm-3">
				<button class="btn btn-success" type="submit">Enviar</button>
			</div>
		</div>
	</form>
	<?php
	$contenido = ob_get_contents();
	ob_end_clean();
	return $contenido;
}
add_shortcode( 'formpromo', 'promo_func' );

function get_custom_email_html_promo( $user_id, $heading = false, $mailer ) {
	$template = 'emails/promo.php';
	return wc_get_template_html( $template, array(
		'order'         => $user_id,
		'email_heading' => $heading,
		'sent_to_admin' => true,
		'plain_text'    => false,
		'email'         => $mailer
	) );
}

add_action('wp_ajax_nopriv_promoform','promoform');
add_action('wp_ajax_promoform','promoform');
function promoform(){
	$mailer = WC()->mailer();
	$recipient = strval($_POST['email']);
	$subject = "Has recibido un obsequio de Lebasi Swiss Group";
	$content = get_custom_email_html_promo( $_POST, $subject, $mailer );
	$headers[] = "Content-Type: text/html\r\n";
	$headers[] = 'From: Página Lebasi Global <sistema@lebasigroup.com>' . "\r\n";
	$attachments =array( ABSPATH.'/archivos/RecetasLebasiparafortalecerlasdefensas.pdf');
	//$attachments =array( ABSPATH.'/archivos/RecetasdeLebasiparacelulitis.pdf');
	//$attachments =array( ABSPATH.'/archivos/RecetasLebasiparaelCOVID19.pdf');
	//$mailer->send( $recipient, $subject, $content, $headers );
	
	wp_mail($recipient,'Has recibido un obsequio de Lebasi Swiss Group',$content,$headers,$attachments);
	//wp_mail('medinaramirez.isaias@gmail.com','Contactaron a nuestros especialistas | Lebasi Swiss Group',$content,$headers);
	wp_mail('sistema@lebasigroup.com','Datos de Promocion | Lebasi Swiss Group',$content.'<h3>DATOS</h3><p>Nombre:<strong>'.$_POST['nombre'].'</strong></p><p>Email:<strong>'.$_POST['email'].'</strong></p><p>Teléfono:<strong>'.$_POST['telefono'].'</strong></p><p>Tema:<strong>'.$_POST['tema'].'</strong></p><p>Pregunta:<br><strong>'.$_POST['pregunta'].'</strong></p>',$headers);
	
	wp_send_json($content);
}

add_filter( 'wp_mail_content_type', 'set_content_type_promo' );
function set_content_type_promo( $content_type ) {
	return 'text/html';
}