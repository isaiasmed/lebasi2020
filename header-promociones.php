<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <?php
  global $wp_query;
  global $pagenow;
  global $id_face;
  $country=getPaisIp();
	global $wp_siglas;
	if($country->status=='success'){
		$wp_siglas=$country->countryCode;
	} 

	switch($wp_siglas){
		case 'MX':
			$paist='México';
			$id_face="10150098555370372";
		break;
		case 'AR':
			$paist='Argentina';
			$id_face="119828714726741";
		break;
		case 'PE':
			$paist='Perú';
			$id_face="752074788255688";
		break;
		case 'US':
			$paist='United States';
			$id_face="117375805111701";
		break;
		default :
			$paist='International';
			$id_face="10150098555370372";
		break;
	}
	
	if(isset($wp_query->query_vars['numdistribuidor'])):
	//Es un micrositio?>
	<title>Distribuidor Oficial Lebasi</title><?php
	
	else:
		if(is_single()):
			$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');?>
			<title><?php the_title();?> | Lebasi Swiss Group</title>
			<meta property="og:type" content="article">
			<meta property="fb:app_id" content="915828338590601">
			<meta property="og:url" content="<?php the_permalink();?>">
			<meta property="og:title" content="<?php the_title();?>">
			<meta property="og:description" content="<?php the_excerpt();?>">
			<meta property="og:image" content="<?php echo $featured_img_url;?>"><?php
		else:?>
			<title>Lebasi Swiss Group | Sitio Oficial</title>
			<meta property="og:type" content="website">
			<meta property="fb:app_id" content="915828338590601">
			<meta property="og:url" content="<?php echo site_url();?>">
			<meta property="og:title" content="Sitio Oficial de Lebasi Swiss Group">
			<meta property="og:description" content="Lebasi Lactoserum Suizo, Sitio Oficial, Tienda en Linea">
			<meta property="og:image" content="https://lebasi.com.mx/wp-content/uploads/2020/07/Lebasi_suiza.png">
			<?php
		endif;
	
	endif;?>
  <meta name="facebook-domain-verification" content="0z05foo1ktsbrkdjncuj9lu24f5tsp" />
  <!-- Bootstrap core CSS -->
  <link href="<?php echo get_template_directory_uri(); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/vendor/css/custom.css?v=1.<?php echo date('YmdHis')?>" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha256-4hqlsNP9KM6+2eA8VUT0kk4RsMRTeS7QGHIM+MZ5sLY=" crossorigin="anonymous" />
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/vendor/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/vendor/images/favicon.ico" type="image/x-icon">
  <!--Floating WhatsApp css-->
  <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
  <?php wp_head();?>
  
	<!-- Facebook Pixel Code 
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '403321387452051');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=403321387452051&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->

</head>

<body>
<p>hola</p>


