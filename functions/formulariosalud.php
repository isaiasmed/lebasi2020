<?php

add_action( 'wp_enqueue_scripts', 'wpdocs_salud' );
function wpdocs_salud() {
	global $pagenow;
	global $wp_query;
	$pagename=isset($wp_query->query['pagename'])?$wp_query->query['pagename']:'';
	if($pagename=="contacta-a-nuestros-especialistas"){
		wp_register_script('salud', get_stylesheet_directory_uri().'/vendor/js/salud.js', array('jquery'), '1.1'.date('YmdHis'),true);
		wp_enqueue_script('salud');
		//wp_enqueue_style( 'regalos_style', get_stylesheet_directory_uri().'/vendor/css/regalos.css','1.1'.date('YmdHis') );
	}
}

// Shortcode de formulario
function salud_func() {	
	ob_start();
	$country=getPaisIp();
	if($country->status=='success'){
		$siglas=$country->data->geo->country_code;
	}
	global $wp_query;
	?>
	
	<form id="salud">
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
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Tema <abbr class="required" title="obligatorio">*</abbr></label>
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
			<label for="exampleInputEmail1" class="col-sm-3 col-form-label text-right">Tu pregunta <abbr class="required" title="obligatorio">*</abbr></label>
			<div class="col-sm-9">
				<textarea class="form-control" name="pregunta"></textarea>
			</div>
		</div>
		<div class="form-group row" >
			<input type="hidden" name="action" value="saludform">
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
add_shortcode( 'contacto', 'salud_func' );

function get_custom_email_html_salud( $user_id, $heading = false, $mailer ) {
	$template = 'emails/salud.php';
	return wc_get_template_html( $template, array(
		'order'         => $user_id,
		'email_heading' => $heading,
		'sent_to_admin' => true,
		'plain_text'    => false,
		'email'         => $mailer
	) );
}

add_action('wp_ajax_nopriv_saludform','saludform');
add_action('wp_ajax_saludform','saludform');
function saludform(){
	$mailer = WC()->mailer();
	$recipient = strval($_POST['email']);
	$subject = "Pregunta de Salud";
	$content = get_custom_email_html_salud( $_POST, $subject, $mailer );
	$headers[] = "Content-Type: text/html\r\n";
	$headers[] = 'From: Página Lebasi Global <sistema@lebasigroup.com>' . "\r\n";
	//$mailer->send( $recipient, $subject, $content, $headers );
	
	wp_mail($recipient,'Contactaste a nuestros especialistas | Lebasi Swiss Group',$content,$headers);
	//wp_mail('medinaramirez.isaias@gmail.com','Contactaron a nuestros especialistas | Lebasi Swiss Group',$content,$headers);
	wp_mail('sistema@lebasigroup.com','Contactaron a nuestros especialistas | Lebasi Swiss Group',$content.'<h3>DATOS</h3><p>Nombre:<strong>'.$_POST['nombre'].'</strong></p><p>Email:<strong>'.$_POST['email'].'</strong></p><p>Teléfono:<strong>'.$_POST['telefono'].'</strong></p><p>Tema:<strong>'.$_POST['tema'].'</strong></p><p>Pregunta:<br><strong>'.$_POST['pregunta'].'</strong></p>',$headers);
	
	wp_send_json($content);
}

add_filter( 'wp_mail_content_type', 'set_content_type' );
function set_content_type( $content_type ) {
	return 'text/html';
}