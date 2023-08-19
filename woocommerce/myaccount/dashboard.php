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
<h4>
	HOLA BIENVENIDO A LEBASI
</h4>

<div class="bg-info text-white text-center p-3 mb-2">Hemos Cambiado nuestra página, para que sea mas funcional, aqui podras ver tus pedidos, direcciones, etc.</div>

<?php if(wcmo_get_current_user_roles()=='inscripcion'):?>
<div class="bg-warning text-white text-center p-5 mb-3">Te encuentras en proceso de inscripción te pedimos completar, realizando la compra de tu kit de inscripción.</div>
<?php endif; ?>


<?php if(wcmo_get_current_user_roles()=='customer'):
//Revisar si ya tiene lo cupones
$cu2020 = get_user_meta( get_current_user_id(),'cupones2020',true );
if($cu2020){
	echo '<h3>Estos son tus cupones generados:</h3>';?>
	<table class="table table-bordered">
		<tr>
			<th>Cupon</th>
			<th>Utilizado</th>
			<th>Descuento generado</th>
		</tr>
	<?php
	$query="SELECT * FROM `lebasimx_postmeta` where meta_value = ".get_current_user_id()." and meta_key = 'userid' ";
	$q=$wpdb->get_results($query);
	$pr=0;
	if($q){
		foreach($q as $qq){
			$cupont=get_the_title($qq->post_id);
			$coupon = new WC_Coupon($coupon_code);
			$tot=lebasi_get_sales_by_coupon($cupont);
			$prt=$tot*0.20;
			$pr=$pr+$prt;?>
			<tr>
				<td><?php echo $cupont;?></td>
				<td><?php echo $tot>0?'Sí':'No';?></td>
				<td><?php echo wc_price($prt);?></td>
			</tr><?php
			//echo '<pre>'.print_r($coupon,1).'</pre>';
		}
	}?>
	<tfoot>
		<tr>
			<th colspan="2">Total de descuento para próxima compra</th>
			<th><?php echo wc_price($pr);?> <?php echo $pr>0?'<button class="btn btn-primary reclamo">Reclamar</button>':''?></th>
		</tr>
	</tfoot>
	</table><?php
} ?>
<?php endif; ?>



<a href="<?php echo site_url('tienda');?>" class="btn btn-danger">Ir a la tienda</a>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
