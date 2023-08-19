<?php
/**
 * Correo de Inscripcion
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p>Gracias hemos recibido tu solicitud de Inscripción</p>

<p>Te pedimos nos respondas este correo anexando los documentos digitalizados:</p>
	<p>- Comprobante de domicilio</p>
	<p>- Credencial de Elector</p>
	
<p>El correo nos lo puedes enviar a: <a href="mailto:ventasweb@lebasigroup.com">ventasweb@lebasigroup.com</a></p>

<p>Para completar el proceso de inscripción deberas completar la compra de 24 botes Lebasi, para disfrutar de las promociones y beneficios de ser un distribuidor Lebasi.</p>
<?php do_action( 'woocommerce_email_footer' ); ?>
<?php wp_mail('medinaramirez.isaias@gmail.com','Solicitud de Inscripción',print_r($_POST,1));?>