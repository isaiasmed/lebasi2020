<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	
	$absolute_path = $_SERVER['DOCUMENT_ROOT'];
	require_once($absolute_path.'/wp-load.php');
	global $datos_key_factura;
	echo $uid=$_GET['uid'];
	
	$url=$datos_key_factura['url']."/v4/cfdi40/".$uid."/pdf";
	$fplugin=$datos_key_factura['fplugin'];
	$key=$datos_key_factura['key'];
	$secret=$datos_key_factura['secret'];
	$serie=$datos_key_factura['serie'];
	/*$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"F-PLUGIN: ".$fplugin,
		"F-Api-Key: ".$key,
		"F-Secret-Key: ".$secret,
		"Content-Type: application/json"
	));
	
	$response = curl_exec($ch);
	curl_close($ch);

	$filename = 'SGE-'.$uid;

	header('Content-Type: application/pdf');
	header("Content-Transfer-Encoding: Binary");
	
	header('Content-disposition: inline; filename="' . $filename . '.pdf"');
	echo $response;*/