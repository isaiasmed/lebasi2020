<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?> row lebasishop<?php echo wcmo_get_current_user_roles()=='inscripcion'?'-insc':''?> p-3">
	<?php
	if(wcmo_get_current_user_roles()!='inscripcion' && wcmo_get_current_user_roles()!='distribuidor'):
		$d=get_micrositio_cookie();
		if($d):
			$dist = explode("-", $d);
			$empObj = getDatoEmpresarioLebasi($dist[1],$dist[0]);
			$tablenamex=$wpdb->prefix.'postmeta';
			
			$args = array(
				'post_type'  => 'micrositios',
				'meta_query' => array(
					array(
						'key'     => 'pais',
						'value'   => $dist[0],
					),
					array(
						'key'     => 'dist',
						'value'   => $dist[1],
					),
				),
			);
			$querys = new WP_Query( $args );
			if ($querys->have_posts()):
				while($querys->have_posts()):
					$querys->the_post();
					$post_idm=get_the_ID();
				endwhile;
			endif;
			$foto=get_field('foto',$post_idm);
			$slug=get_field('slug',$post_idm);?>
		
			
		
			<div class="micros d-block w-100 mb-5">
				<div id="micrositio" class="clearfix">
					<img src="<?php echo $foto['sizes']['thumbnail'];?>" width="70">
					<div class="datosmicro">
						<span class="d-block w-100">Distribuidor</span>
						<span class="d-block w-100"><?php echo $dist[0]; ?> | <?php echo $dist[1]; ?></span>
						<a href="<?php echo site_url('distribuidor/'.$slug);?>" onclick="gtag('event', 'clic', { 'event_category': 'micrositio', 'event_label': 'Dist-'<?php echo $dist[0]; ?> | <?php echo $dist[1]; ?>, 'value': '<?php echo get_the_ID();?>'});">Ver micrositio</a>
					</div>
				</div>
			</div><?php
		else:?>
			<div class="overlayshop">
				<h2 class="text-dark">
					Asignando un distribuidor...<br>
					<i class="fa fa-cog fa-spin fa-2x mt-4"></i>
				</h2>
			</div><?php		
		endif;?>	
	<?php else: ?>
	<div class="col-12 bg-warning p-2 text-white mb-3">Completa tu inscripción</div>
	
	<?php endif; ?>
	<div id="distres" class="col-12 card mb-2 py-2 bg-light">
	</div>