<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */
global $wpdb;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<style>
	.banner {
		height: 300px;
		overflow: hidden;
		position: relative;
		display: block;
		box-shadow: 0px 4px 10px #808080;
	}
	.video-foreground, .video-background iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		pointer-events: none;
		height: 920px;
	}
	.video-foreground {
		top: -210px !important;
	}
	#vidtop-content {
		background: rgba(0,0,0,0.5);
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	.woocommerce img, .woocommerce-page img {
		max-height: 125px !important;
	}
	.logo img {
		max-width: 800px;
		margin: 90px auto;
		display: block;
	}
	.welcome {
		background: #fefefe;
		padding: 0.5rem 4rem;
		box-shadow: 2px 2px 5px #00000021;
		color: #7b7b7b;
		font-size: 1.2rem;
		line-height: 1.5rem;
		text-align: justify;
	}
	.home {
		text-align: center;
		margin-top: 50px;
		color: #001c39;
		font-size: 4rem;
		font-weight: bold;
		padding-bottom: 30px;
	}
</style>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="parallax-window banner" data-parallax="scroll" data-image-src="">
		<div class="video-background">
		  <div class="video-foreground">
			 <iframe src="https://www.youtube.com/embed/SyIQr1j4B1s?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist=SyIQr1j4B1s&mute=1" frameborder="0" allowfullscreen></iframe>
		  </div>
		</div>

		<div id="vidtop-content">
			<div class="vid-info">
				<h1>
					<div class="logo">
						<img src="https://lebasi.net/wp-content/themes/lebasinet2019/img/logo_bco.svg">
					</div>
				</h1>
			</div>
		</div>
	</div>
	<h2 class="home">Bienvenido(a) a tu oficina virtual Lebasi</h2>
	<div class="welcome">
		<p>Estimado Representante,</p>
		<p>Para  mí  es  un  placer  darte  una  cordial  bienvenida  a  Lebasi,  te  comento que has tomado la decisión correcta para mejorar tu salud y bienestar.</p>
		<p>Después de haber comprobado los beneficios de este maravilloso producto, que es conocido en Suiza como “la fuente de la juventud”, decidí que mi meta era compartirlo con el mundo, por lo que en 1998 fundé Lebasi. Actualmente México y Argentina se conforman de 250 mil representantes independientes, en Estados Unidos contamos solamente con 6 mil representantes, esto puede darte una idea del gran potencial de negocio con el que contamos en el mercado americano.</p>
		<p>Haz tomado la decisión correcta en el momento justo, ya que nuestros  planes  de  crecimiento  pretenden  convertir  este  mercado  en  el  más importante para la compañía.</p>
		<p>Esta tarea requiere del personal adecuado para llevarse a cabo, que posea la correcta visión y actitud.</p>
		<p>Nuevamente ¡Bienvenido a Lebasi! y espero que pronto ¡celebremos tus éxitos!.</p>
		<img src="<?php echo get_stylesheet_directory_uri();?>/images/firma_chenel.jpg" width="260">
	</div>
</div>