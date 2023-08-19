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
		else:?>
		<div class="container contenido">
			<h2 class="h1 my-5" ><?php the_title();?></h2>
			<div class="row">
				<div class="col-12 col-md-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div><?php
		endif;
	} // end while
} // end if ?>
<!--container-->
<?php get_footer('lebasi');?>