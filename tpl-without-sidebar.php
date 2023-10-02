<?php
/**
 * Template Name: Page without sidebar
 *
 **/
get_header('lebasi');
$featured_image_url = get_the_post_thumbnail_url(get_the_ID(),'full');
global $wp_query;
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		
		if(isset($wp_query->query_vars['numdistribuidor'])):
			$micrositio=true;?>
			<div class="container micrositio contenido">
				<div class="row">
					<div class="col-12">
						<?php the_content(); ?>
					</div>
				</div>
			</div><?php
		elseif($wp_query->query_vars['pagename']=='mi-cuenta'):?>
			<style>
				.emp-info {
					margin-top: 20px;
					text-align: center;
					background: #f00;
					color: #fff;
					padding: 10px;
					border-radius: 5px;
					line-height: 15px;
				}
				.emp-info span {
					margin-top: 15px;
					display: block;
					min-width: 125px;
					font-size: 12px;
				}
				.woocommerce-MyAccount-navigation ul{
					padding-left:10px;
				}
			</style>
			<div class="container contenido backoffice">
				<div class="row">
					<div class="col-12 col-md-12 pt-4">
						<?php the_content(); ?>
					</div>
				</div>
			</div><?php
		else:?>
		<div class="container contenido">
			<h2 class="h1 my-5 tpltitle"><?php the_title();?></h2>
			<div class="row">
				<div class="col-12 col-md-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div><?php
		endif;
	} // end while
} // end if ?>
<?php get_footer('lebasi');?>