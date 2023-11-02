<?php
/**
 * Customer new account email
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p>Gracias por contactar a Lebasi</p>

<p>En breve nos pondremos en contacto contigo.</p>

<p>Cualquier comentario o duda puedes escribirnos directamente a: <a href="mailto:ventasweb@lebasigroup.com">ventasweb@lebasigroup.com</a></p>

<?php do_action( 'woocommerce_email_footer' ); ?>