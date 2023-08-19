<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email );
$order = wc_get_order( $_POST ['ID']); 
$user_id   = $order->get_user_id();
$cu2020 = get_user_meta( $user_id,'cupones2020',true );
$da='';
if(!$cu2020){
	$da.='<h3>Comparte este codigo con cada persona a la que desees recomendar Lebasi</h3> <br>';
	//generamos los cupones2020
	update_user_meta($user_id,'cupones2020',1);
	$cu2020 = get_user_meta( $user_id,'cupones2020',true );
	for($i=1;$i<=5;$i++){
		$coupon= create_coupon_lebasi($user_id);
		$da.='<p style="font-weight:bold;">'.$i.'- '.$coupon.'</p><br>';
	}
}
 ?>

Hola gracias por tu compra, te proporcionamos 5 cupones para que los puedas compartir y que cada uno de ellos reciban el 10% de descuento en la compra de Lebasi.
<br>
<?php echo $da;?>
Por cada cupon que tu referido use se te otorgara un 10% acumulable en tu siguiente compra, para reclamar tu descuento accede a tu cuenta en <a href="https://lebasi.com.mx/mi-cuenta" title="Mi cuenta">Mi cuenta</a> y da seguimiento a tus cupones utilizados, puedes reclamar tu descuento en el momento que lo desees.
<?php
/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
