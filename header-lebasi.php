<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Sistemas Lebasi 2021"><?php
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
	//echo '<pre>'.print_r($wp_query,1).'</pre>';
	

	if(is_page('promociones')):
		if(isset($wp_query->query_vars['foto'])):
			global $wpdb;
			$fotoget=$wp_query->query_vars['foto'];
			$var=explode('_',urldecode(base64_decode($fotoget)));
			$var2=explode('#',$var[2]);
			$postid=$var2[0];
			$fotores=$wpdb->get_row("select * from pagina_promociones where id = {$postid}");
			$foto=$fotores->fotoid;
			$imagen=wp_get_attachment_image_url($foto,'galeriapromo');?>
			<title>Vota por esta foto | Con Lebasi Todos Ganan</title>
			<meta name="description" content="Con tu voto apoyas al concursante a ganar esta fantástica promoción">
			<link rel="canonical" href="<?php the_permalink().'foto/'.$wp_query->query_vars['foto'];?>/" />
			<meta property="og:type" content="og.likes">
			<meta property="fb:app_id" content="915828338590601">
			<meta property="og:url" content="<?php echo site_url('promociones/foto/').$wp_query->query_vars['foto'];?>/">
			<meta property="og:title" content="Vota por esta foto | Con Lebasi Todos Ganan">
			<meta property="og:description" content="Con tu voto apoyas al concursante a ganar esta fantástica promoción">
			<meta property="og:image" content="<?php echo $imagen;?>"><?php
		endif;
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
		else:
			if(isset($wp_query->query_vars['numdistribuidor'])):
				//Es un micrositio
				global $wp_query;
				global$wpdb;
				
				$distribuidor=$wp_query->query_vars['numdistribuidor'];
				$tablename=$wpdb->prefix.'postmeta';
				$idpost=$wpdb->get_var("select post_id from {$tablename} where meta_key='slug' and meta_value='{$distribuidor}'");
				$foto=get_field('foto',$idpost);
				
				$end=get_field('dist',$idpost);
				$pp=get_field('pais',$idpost);
				set_micrositio_cookie($pp.'-'.$end);
				if(is_numeric($end)){
					//echo $end;
					//$empObj = getDatoEmpresarioLebasi($end,$pp);
					$empObj ="";
					$siglasemp=$pp;
					
				}
				//echo '<pre>'.print_r($empObj,1).'</pre>';	
				
				?>
				<title>Distribuidor Oficial Lebasi |</title>
				<meta property="og:type" content="website">
				<meta property="fb:app_id" content="915828338590601">
				<meta property="og:url" content="<?php echo site_url('distribuidor/'.$distribuidor);?>.">
				<meta property="og:title" content="Sitio Oficial del Distribuidor - <?php echo $empObj->data->Empresario;?>">
				<meta property="og:description" content=" - Lebasi Lactoserum Suizo, Sitio Oficial, Tienda en Linea">
				<meta property="og:image" content="<?php echo $foto['url']?>"><?php
			else:?>
				<title>Lebasi Swiss Group | Sitio Oficial</title>
				<meta property="og:type" content="website">
				<meta property="fb:app_id" content="915828338590601">
				<meta property="og:url" content="<?php echo site_url();?>.">
				<meta property="og:title" content="Sitio Oficial de Lebasi Swiss Group">
				<meta property="og:description" content="Lebasi Lactoserum Suizo, Sitio Oficial, Tienda en Linea">
				<meta property="og:image" content="https://lebasi.com.mx/wp-content/uploads/2020/07/Lebasi_suiza.png">
				<?php
			endif;
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
  
  <!-- Global site tag (gtag.js) - Google Ads: 870520378 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-870520378"></script> 
  <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-870520378'); </script>
  
  
  <?php wp_head();?>
 	<!--<script>
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
	--
	
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=403321387452051&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
</head>
<body><?php 
$post = $wp_query->get_queried_object();
$pagename=isset($wp_query->query['pagename'])?$wp_query->query['pagename']:'';
$lastpopup=false;
	if(isset($_COOKIE['lebasi_popup'])) { 
		$lastpopup = $_COOKIE['lebasi_popup'];
	}
if(is_page('inicio') && $wp_siglas=='MX' && !$lastpopup){
	/*setcookie('lebasi_popup', 'ok', time()+7200,COOKIEPATH, COOKIE_DOMAIN );?>
	<script>
		$(function() {
			$('.popuppromo div:not(.element3),.popuppromo').on('click',function(){
			  $('.popuppromo').fadeOut('fast');
			  return false;
			})
		});
	</script>
	<div class="popuppromo" style="position: fixed;height: 100vh;width: 100%;background: #000000d9;z-index: 999999999; padding:20%;">
		<div class = "element3 d-flex justify-content-center align-items-center h-100">
			<div class="position-absolute" style="top:0; right:45px;">
				<a style="font-size: 35px;" href="#" class="text-white cerrarimgini position-absolute"><i class="fa fa-times-circle" aria-hidden="true" onclick="$('.popuppromo').fadeOut('slow'); return false;"></i></a>
			</div>
			<center class="d-md-flex">
				<a class="button d-block"  href="<?php echo site_url('promociones/#consulta');?>" id="show"> <img style="width:550px; height:auto;" class="img-fluid" src="<?php echo bloginfo('template_directory');?>/images/landing1.jpg" /></a>
				<a class="prueba1" href="<?php echo site_url('promociones/#registro');?>" id="2show"> <img style="width:550px; height:auto;" class="img-fluid" src="<?php echo bloginfo('template_directory');?>/images/landing2.jpg" /></a>
			</center>
		</div>
	</div><?php*/
} ?>
	
<?php /*if(!is_page('promociones')){ ?>
  <div class="header">
    <div class="slick d-none d-sm-block" data-language="<?php echo pll_current_language(); ?>"><?php
		if(pll_current_language()=='en'){?>
			<div class="item" style="100%"><a href="<?php echo site_url('store'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/Banner 1 Web.jpg" onclick="gtag('event', 'clic', { 'event_category': 'banner-header-1', 'event_label': '<?php the_title();?>', 'value': '<?php echo get_the_ID();?>'});"></a></div>
			<div class="item" style="100%"><a href="<?php echo site_url('store'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/Banner 2 Web.jpg" onclick="gtag('event', 'clic', { 'event_category': 'banner-header-2', 'event_label': '<?php the_title();?>', 'value': '<?php echo get_the_ID();?>'});"></a></div>
			<div class="item" style="100%"><a href="<?php echo site_url('store'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/Banner 3 Web.jpg" onclick="gtag('event', 'clic', { 'event_category': 'banner-header-3', 'event_label': '<?php the_title();?>', 'value': '<?php echo get_the_ID();?>'});"></a></div><?php			
		}else{
			$rows = get_field('banner_espanol_web','options');
			$a=1;
			if( $rows ) {
				foreach( $rows as $row ) {
					$image = $row['imagen'];
					$url = $row['url'];?>
					<div class="item" style="100%"><a href="<?php echo $url ?>"><img src="<?php echo $image['url'] ?>" onclick="gtag('event', 'clic', { 'event_category': 'banner-header-<?php echo $a;?>, 'event_label': '<?php the_title();?>', 'value': '<?php echo get_the_ID();?>'});"></a></div><?php
					$a++;
				}
			}
		} ?>
	</div>
	<!--
	<div class="slick2 d-block d-sm-none"><?php
	/*
		if(pll_current_language()=='en'){?>
			<div class="item" style="100%"><a href="<?php echo site_url('store'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/ubanner1_cel.jpg" onclick="gtag('event', 'clic', { 'event_category': 'banner-header-1', 'event_label': '<?php the_title();?>', 'value': '<?php echo get_the_ID();?>'});"></a></div>
			<div class="item" style="100%"><a href="<?php echo site_url('store'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/ubanner2_cel.jpg" onclick="gtag('event', 'clic', { 'event_category': 'banner-header-2', 'event_label': '<?php the_title();?>', 'value': '<?php echo get_the_ID();?>'});"></a></div>
			<div class="item" style="100%"><a href="<?php echo site_url('store'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/ubanner3_cel.jpg" onclick="gtag('event', 'clic', { 'event_category': 'banner-header-3', 'event_label': '<?php the_title();?>', 'value': '<?php echo get_the_ID();?>'});"></a></div><?php			
		}else{
			$rows = get_field('banner_espanol_movil','options');
			$a=1;
			if( $rows ) {
				foreach( $rows as $row ) {
					$image = $row['imagen'];
					$url = $row['url'];?>
					<div class="item" style="100%"><a href="<?php echo $url ?>"><img src="<?php echo $image['url'] ?>" onclick="gtag('event', 'clic', { 'event_category': 'banner-header-movil-<?php echo $a;?>', 'event_label': '<?php the_title();?>', 'value': '<?php echo get_the_ID();?>'});"></a></div><?php
					$a++;
				}
			}
		} 
	?>
	</div>
    <!--container-->
</div>
<?php } */?>

<nav class="navbar navbar-expand-sm sticky-top navbar-light bg-white py-2 border-bottom border-primary shadow">
    <div class="container">
        <a class="navbar-brand" href="<?php echo site_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/logolebasi_opt.png" width="120"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav ml-1"><?php
				foreach(mi_menu() as $item){?>
					<li class="nav-item"><?php
						if(count($item->childs)==0){?>
							<a class="nav-link" href="<?php echo $item->url;?>"><?php echo $item->title=='Tienda'||$item->title=='Boutique'||$item->title=='Shop'?'<i class="fa fa-shopping-cart" aria-hidden="true"></i> ':'';?> <?php echo $item->title;?></a><?php
						}else{?>
							<div class="dropdown">
							  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink<?php echo $item->ID;?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo $item->post_title;?>
							  </a>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink<?php echo $item->ID;?>"><?php
								  foreach ($item->childs as $submenus){?>
									<a class="dropdown-item" href="<?php echo $submenus->url;?>"><?php echo $submenus->title;?></a><?php
								  } ?>
							  </div>
							</div><?php
						}?>
					</li><?php
				} ?>
				<li class="nav-item bus">
					<a class="nav-link text-dark buscando" href="<?php echo site_url('wp-admin');?>"><i class="fa fa-search"></i></a>
					<div class="buscadorfloat"><input class="form-control mr-3 w-75 buscador" type="text" placeholder="Buscar Nota" aria-label="Search"></div>
					
					<div class="resultados-buscafloat container"></div>
				</li>
            </ul>
            <ul class="navbar-nav ml-auto">
				<?php pll_the_languages( array( 'dropdown' => 0, 'display_names_as' => 'slug','show_names' => 1,'show_flags' => 0,'hide_current' => 1,) ); ?>
                <li class="nav-setting cart">
                    <a id="cart-counter" class="nav-link" href="<?php echo site_url('carrito');?>">
						<i class="fa fa-shopping-cart fa-badge" data-count="<?php echo WC()->cart->get_cart_contents_count(); ?>"></i>
					</a>
                </li>
				<li class="nav-setting cart">
                    <a class="nav-link pb-1" href="<?php echo site_url('mi-cuenta');?>">
						<i class="fa fa-user"></i> <span style="font-size:10px;">Account</span>
					</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--<div class="alert alert-warning alert-dismissible fade show" role="alert">
	  <strong>!Lebasi te da la bienvenida¡</strong> Estamos migrando nuestro sitio, ¿Tienes dudas?, puedes mandarnos un Whatsapp <a target="_blank" href="https://wa.me/524492256275">¿Comunícate?</a>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>-->
<!--<form method="POST">
	<select name="paisc" id="paisc">
		<option value="">Otros</option>
		<option value="MX">México</option>
		<option value="PE">Perú</option>
		<option value="AR">Argentina</option>
		<option value="US">Estados Unidos</option>
		
	</select>
</form>-->