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

add_action('wp_ajax_nopriv_getremisionf','getremisionf');
add_action('wp_ajax_getremisionf','getremisionf');
function getremisionf(){
	$query="select r.ClaveSucursal,r.NumRemision,concat(e.Nombre,' ',e.APaterno,' ',e.AMaterno) as Razon,RFC,CodPostal,Estado,Municipio,Email,p.ClaveProducto,p.DescrProd,dr.Cantidad,dr.Precio,dr.Descuento,p.ClaveSat,p.ClaveUnidad,p.IVA from mex_remision r
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
	wp_send_json($_POST);
}

add_action('wp_ajax_ajaxgetfactura','ajaxgetfactura');
add_action('wp_ajax_nopriv_ajaxgetfactura','ajaxgetfactura');

function ajaxgetfactura(){
	wp_send_json($_POST);
}