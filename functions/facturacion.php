<?php
//Funciones de factura
function inicio_facturacion_lebasi() {
    // Define y establece la variable en true el ambiente es de pruebas, en false el entorno es de produccion conectado y con validez al SAT
    global $datos_key_factura;
	$modo_sandbox=true;
	if($modo_sandbox){
		$datos_key_factura['url']='https://sandbox.factura.com/api';
		$datos_key_factura['fplugin']= '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed';
		$datos_key_factura['key']='JDJ5JDEwJGRSUDJXZkNwVmVKWS9kS1AwVkFhdS50eWhlTmIuRVlvZVAuNGtlNFovUTRzOXp6ZWVudGJH';
		$datos_key_factura['secret']='JDJ5JDEwJC91dGFoQWV6N3l1Wk40VVVXVHNKeWVpUGZLUy5JZXNjN3E3dVI4THJZeTl1eDE3ZEZ6M1Iu';
		$datos_key_factura['serie']=10334;
		$datos_key_factura['env']="_dev".uniqid();
	}else{
		$datos_key_factura['url']='https://api.factura.com';
		$datos_key_factura['fplugin']= '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed';
		$datos_key_factura['key']='JDJ5JDEwJGNXNDMvcFJ4c0doOTZ5QnR1andrSGUzN0tJUGE3N2hYL2RZQzJ4WU5oVi4wQWJGLzVYNXd1';
		$datos_key_factura['secret']='JDJ5JDEwJHVwdXFkNHRSODRIOXMuekdJSG45Uy5vbmJ6UkQ5elQyaVlUNXFFTVphMTB4b2lwRWRLMmdL';
		$datos_key_factura['serie']=429872;
		$datos_key_factura['env']="_4.0";
	}
}
add_action('after_setup_theme', 'inicio_facturacion_lebasi');

function get_regimen_fiscal(){
	global $datos_key_factura;
	$url=$datos_key_factura['url'];
	$fplugin=$datos_key_factura['fplugin'];
	$key=$datos_key_factura['key'];
	$secret=$datos_key_factura['secret'];
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url."/v3/catalogo/RegimenFiscal",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
		"F-PLUGIN: ".$fplugin,
		"F-Api-Key: ".$key,
		"F-Secret-Key: ".$secret,
		"Content-Type: application/x-www-form-urlencoded"
	  ),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return json_decode($response,1)['data'];
}

function get_tipo_gasto(){
	global $datos_key_factura;
	$url=$datos_key_factura['url'];
	$fplugin=$datos_key_factura['fplugin'];
	$key=$datos_key_factura['key'];
	$secret=$datos_key_factura['secret'];
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url."/v4/catalogo/UsoCfdi",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
		"F-PLUGIN: ".$fplugin,
		"F-Api-Key: ".$key,
		"F-Secret-Key: ".$secret,
		"Content-Type: application/x-www-form-urlencoded"
	  ),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	return json_decode($response,1);
}
function get_unidad($clave){
	$query="select * from mex_unidadsat where clave='".$clave."'";
	$name=db($query);
	return $name[0]['nombre'];
}

add_action('wp_ajax_nopriv_getremisionf','getremisionf');
add_action('wp_ajax_getremisionf','getremisionf');
function getremisionf(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	
	
	$query="select r.Factura,r.ClaveSucursal,r.NumRemision,concat(e.Nombre,' ',e.APaterno,' ',e.AMaterno) as Razon,RFC,CodPostal,Estado,Municipio,Email,p.ClaveProducto,p.DescrProd,dr.Cantidad,dr.Precio,dr.Descuento,p.ClaveSat,p.ClaveUnidad,p.IVA from mex_remision r
		left join app_empresario e 
		on r.NumEmpresario = e.NumEmpresario and r.Paisempresario = e.ClavePais
		left join mex_det_remision dr
		on dr.NumRemision = r.NumRemision and dr.ClaveSucursal = r.ClaveSucursal
		left join mex_producto p 
        on p.ClaveProducto = dr.ClaveProducto
		where r.ClaveSucursal='".$_POST['sucursal']."' and r.NumRemision=".$_POST['NumRemision'];
	$_POST['query']=$query;
	$rem=db($query);
	
	$_POST['error']=true;
	$_POST['datas']=false;
	if($rem){
		if($rem[0]['Factura']!=""){
			$_POST['facturada']=$rem[0]['Factura'];
			$_POST['error']=false;
		}else{
			$remp=array(
				"Razon"=>$rem[0]['Razon'],
				"RFC"=>$rem[0]['RFC'],
				"CodPostal"=>$rem[0]['CodPostal'],
				"ClaveSucursal"=>$rem[0]['ClaveSucursal'],
				"NumRemision"=>$rem[0]['NumRemision'],
				"Municipio"=>$rem[0]['Municipio'],
				"Estado"=>$rem[0]['Estado'],
				"Email"=>$rem[0]['Email'],
			);
			$_POST['datas']=$remp;
			foreach($rem as $c){
				unset($c['Razon']);
				unset($c['RFC']);
				unset($c['CodPostal']);
				$_POST['items'][]=$c;
			}
			$_POST['error']=false;
		}
	}
	wp_send_json($_POST);
}


function create_cliente($datos){
	$data_array = array(
		"email" => $datos['email'],
		"razons" => $datos['razon'],
		"rfc" => $datos['rfc'],
		"regimen" => $datos['regimen'],
		"codpos" => $datos['cp'],
		"estado" => $datos['estado'],
		"ciudad" => $datos['ciudad'],
	);

	$json_data = json_encode($data_array);
	global $datos_key_factura;
	$url=$datos_key_factura['url'];
	$fplugin=$datos_key_factura['fplugin'];
	$key=$datos_key_factura['key'];
	$secret=$datos_key_factura['secret'];
	$curl = curl_init();
	curl_setopt_array($curl, array(

		CURLOPT_URL => $url."/v1/clients/create",
		
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS =>$json_data,
		
		CURLOPT_HTTPHEADER => array(
			"F-PLUGIN: ".$fplugin,
			"F-Api-Key: ".$key,
			"F-Secret-Key: ".$secret,
			"Content-Type: application/json"
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$user_id= get_current_user_id();
	$factur=get_user_meta($user_id,'factura_client',true);
	$data=json_decode($response);	
	update_user_meta( $user_id, 'data_factura', maybe_serialize((array)$data) );
	if($data->status=='error'){
		update_user_meta( $user_id, 'factura_client',FALSE);
	}else{
		update_user_meta( $user_id, 'factura_client',$data->Data->UID);
	}
	return $response;
}

add_action('wp_ajax_reenviofactura','reenviofactura');
add_action('wp_ajax_nopriv_reenviofactura','reenviofactura');
function reenviofactura(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	$dir = dirname( __FILE__ );
	$uid=$_POST['uid'];
	$url3=site_url().'/facturas/pdf/'.$uid;
	$url4=site_url().'/facturas/xml/'.$uid;
	$storeLocation = $dir.'/pdf/swissgroupegc_'.$uid.'.pdf';
	$pdfcont = file_get_contents($url3);
	file_put_contents($storeLocation, $pdfcont);
	
	$storeLocation2 = $dir.'/pdf/swissgroupegc_'.$uid.'.xml';
	$xmlcont = file_get_contents($url4);
	file_put_contents($storeLocation2, $xmlcont);
	
	$mailer = WC()->mailer();
	$email=$_POST['email']; 
	$subject="Reenvío Factura en Swiss Group EGC";
	$heading="Factura Swiss Group EGC";
	$message="<h3>¡Te hemos reenviado tu factura!</h3><h5>Adjunto en este e-mail se encuentra el CFDI que has solicitado en formato PDF y XML.</h5><h5>Gracias por confiar en Lebasi</h5>";
	
	$wrapped_message = $mailer->wrap_message($heading, $message);
	$wc_email = new WC_Email;
	$html_message = $wc_email->style_inline($wrapped_message);
	$mailer->send( $email, $subject, $html_message, HTML_EMAIL_HEADERS, array($storeLocation,$storeLocation2) );
	unlink($storeLocation);
	unlink($storeLocation2);
	echo '<pre>'.print_r($_POST,1).'</pre>';
	wp_die();
}

function create_factura($datos){	
	global $datos_key_factura;
	$url=$datos_key_factura['url'];
	$fplugin=$datos_key_factura['fplugin'];
	$key=$datos_key_factura['key'];
	$secret=$datos_key_factura['secret'];
	$serie=$datos_key_factura['serie'];
	$envdata=$datos_key_factura['env'];
	$conceptos=$datos['conceptos'];
	$ch = curl_init();
	$fields = [
		"Receptor" => ["UID" => $datos['UID']],
		"TipoDocumento" => "factura",
		"UsoCFDI" => $datos['tipogasto'],
		"Redondeo" => 2,
		"Conceptos" => $conceptos,
		"FormaPago" => $datos['formadepago'],
		"MetodoPago" => 'PUE',
		"Moneda" => "MXN",
		"CondicionesDePago" => "Pago en una sola exhibición",
		"Serie" => $serie,
		"EnviarCorreo" => false,
		"Comentarios" => "- Facturado desde ".site_url()." | Swiss Group EGC | v4.0 -",
		"NumOrder" => $datos['order'].$envdata
	];

	$jsonfield = json_encode($fields);
	curl_setopt($ch, CURLOPT_URL, $url."/v4/cfdi40/create");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonfield);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"F-PLUGIN: ".$fplugin,
		"F-Api-Key: ".$key,
		"F-Secret-Key: ".$secret,
		"Content-Type: application/json"
	));
	$response = curl_exec($ch);
	if (curl_errno($ch)) {
		$response['error'] = curl_error($ch);
		$response['errordata'] = $jsonfield;
	}
	curl_close($ch);	
	return json_decode($response,1);
}

function create_conceptos($order){	
	global $wpdb;
	$orden=explode("-",$order);
	$NumRemision=$orden[1];
	$ClaveSucursal=$orden[0];
	$query="select *,dr.Descuento as Descuenta,dr.Precio as Precio from mex_det_remision dr inner join mex_producto p on dr.ClaveProducto = p.ClaveProducto where dr.ClaveSucursal='".$ClaveSucursal."' and dr.NumRemision=".$NumRemision;
	$res=db($query);
	if($res){
		foreach($res as $rr){
			$iva=$rr['IVA']?0.160000:0.000000;
			$monto=($rr['Precio']*$rr['Cantidad'])-$rr['Descuenta'];
			$impuestos=array();
			if($monto>0){
				$impuestos['Traslados']=
					array(
						array(
							'Base' => ($rr['Precio']*$rr['Cantidad']), 
							'Impuesto' => '002', 
							'TipoFactor' => 'Tasa', 
							'TasaOCuota' => $iva, 
							'Importe' => (($rr['Precio']*$rr['Cantidad'])-$rr['Descuenta'])*$iva,
						)
					);
			}
			$conceptos[] = array(
				'ClaveProdServ' => $rr['ClaveSat'],
				'NoIdentificacion' => $rr['ClaveProducto'],
				'Cantidad' => $rr['Cantidad'],
				'ClaveUnidad' => $rr['ClaveUnidad'],
				'Unidad' => get_unidad($rr['ClaveUnidad']),
				'ValorUnitario' => $rr['Precio']*1,
				'Descripcion' => $rr['DescrProd'],
				'Descuento' => $rr['Descuenta'],
				'Impuestos' => $impuestos,
			);
		}
	}

	return $conceptos;
}

add_action('wp_ajax_ajaxgetfactura','ajaxgetfactura');
add_action('wp_ajax_nopriv_ajaxgetfactura','ajaxgetfactura');
function ajaxgetfactura(){
	$cliente=create_cliente($_POST);
	$cliente=json_decode($cliente,1);
	$_POST['respuesta_cliente']=$cliente;
	//$conceptos=create_conceptos($_POST['order']);
	
	if($cliente['status']=='success'){
		$_POST['UID']=$cliente['Data']['UID'];
		$conceptos=create_conceptos($_POST['order']);
		$_POST['conceptos']=$conceptos;
		$factura=create_factura($_POST);
		$_POST['respuesta_factura']=$factura;
		if($factura['response']=="success"){
			$uid=$factura['uid'];
			$order=$_POST['order'];
			$orden=explode("-",$order);
			$NumRemision=$orden[1];
			$ClaveSucursal=$orden[0];
			$query="update mex_remision set Factura='".$uid."' where NumRemision='".$NumRemision."' and ClaveSucursal='".$ClaveSucursal."'";
			$resupd=db($query);
			$_POST['update']=$resupd;
			define("HTML_EMAIL_HEADERS", array('Content-Type: text/html; charset=UTF-8'));
			$dir = dirname( __FILE__ );
			$url=dirname( __FILE__ ).'/pdf.php?uid='.$uid;
			$url2=dirname( __FILE__ ).'/xml.php?uid='.$uid;
			$url3=site_url().'/facturas/pdf/'.$uid;
			$url4=site_url().'/facturas/xml/'.$uid;
			//$url=site_url()."/wp-content/plugins/benefis_factura2022/pdf.php?order=".$order_id."&uid=".$uid;
			//$url2=site_url()."/wp-content/plugins/benefis_factura2022/xml.php?order=".$order_id."&uid=".$uid;
			$storeLocation = $dir.'/pdf/swissgroupegc_'.$uid.'.pdf';
			$pdfcont = file_get_contents($url3);
			file_put_contents($storeLocation, $pdfcont);
			
			$storeLocation2 = $dir.'/pdf/swissgroupegc_'.$uid.'.xml';
			$xmlcont = file_get_contents($url4);
			file_put_contents($storeLocation2, $xmlcont);
			
			$mailer = WC()->mailer();
			$email=$_POST['email']; 
			$subject="Se generó Factura en Swiss Group EGC";
			$heading="Factura Swiss Group EGC";
			$message="<h3>¡Has recibido una Factura, !</h3><h4>Adjunto en este e-mail se encuentra el CFDI que has solicitado en formato PDF y XML.</h4><p><strong>Certificado SAT</strong>:<br>".$factura['SAT']['NoCertificadoSAT']."</p><p><strong>FechaTimbrado</strong>:<br>".$factura['SAT']['FechaTimbrado']."</p><p><strong>Serie y Folio</strong>:<br>".$factura['INV']['Serie']."-".$factura['INV']['Folio']."</p>			<p><strong>Sello SAT</strong>:<br>".$factura['SAT']['SelloSAT']."</p><p><strong>Sello CFD</strong>:<br>".$factura['SAT']['SelloCFD']."</p>";
			
			$wrapped_message = $mailer->wrap_message($heading, $message);
			$wc_email = new WC_Email;
			$html_message = $wc_email->style_inline($wrapped_message);
			$mailer->send( $email, $subject, $html_message, HTML_EMAIL_HEADERS, array($storeLocation,$storeLocation2) );
			unlink($storeLocation);
			unlink($storeLocation2);
			ob_start();?>
			
			<p><strong>Certificado SAT</strong>:<br><?php echo $factura['SAT']['NoCertificadoSAT']?></p>
			<p><strong>FechaTimbrado</strong>:<br><?php echo $factura['SAT']['FechaTimbrado']?></p>
			<p><strong>Serie y Folio</strong>:<br><?php echo $factura['INV']['Serie']?> - <?php echo $factura['INV']['Folio'];?> </p>
			<p style="word-break: break-word;"><strong>Sello SAT</strong>:<br><?php echo $factura['SAT']['SelloSAT'];?></p>
			<p style="word-break: break-word;"><strong>Sello CFD</strong>:<br><?php echo $factura['SAT']['SelloCFD'];?></p>
			<br>
			<p><a class="button" href="<?php echo $url4;?>">BAJAR XML</a></p>
			
			<object style="width:100%; height:800px;" data="<?php echo $url3;?>" type="application/pdf">
				<embed src="<?php echo $url3;?>" type="application/pdf" />
				<iframe src="<?php echo $url3;?>" width="100%" height="800px"></iframe>
			</object><?php
			$html=ob_get_contents();
			ob_end_clean();
			$_POST['html']=$html;
		}
	}
	wp_send_json($_POST);
}