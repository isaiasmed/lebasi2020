<?php
	$absolute_path = $_SERVER['DOCUMENT_ROOT'];
	require_once($absolute_path.'/wp-load.php');
	global $datos_key_factura;
	$uid=$_GET['uid'];
	$url=$datos_key_factura['url']."/v4/cfdi40/".$uid."/xml";
	$fplugin=$datos_key_factura['fplugin'];
	$key=$datos_key_factura['key'];
	$secret=$datos_key_factura['secret'];
	$serie=$datos_key_factura['serie'];
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"F-PLUGIN: ".$fplugin,
		"F-Api-Key: ".$key,
		"F-Secret-Key: ".$secret,
		"Content-Type: application/json"
	));
	

$response = curl_exec($ch);
curl_close($ch);

$filename = 'SGE_'.$uid;

header('Content-disposition: attachment; filename="' . $filename . '.xml"');
header('Content-type: "text/xml"; charset="utf8"');
echo $response;