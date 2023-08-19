<?php get_header('lebasi');
global $wp_query;
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		$featured_image_url = get_the_post_thumbnail_url(get_the_ID(),'full');

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
				<div class="col-12 col-md-8"><?php
					if(!is_checkout()):?>
					<div class="featured_img mb-3">
						<img class="img-fluid" src="<?php echo $featured_image_url?>">
					</div><?php
					endif;?>
					
					<?php the_content(); ?>
				</div>
				<!--Sidebar-->
				<div class="col-12 col-md-4 sidebar mt-1">
					<h3 class="text-center text-primary mb-2" data-aos="flip-down" data-aos-delay="300"><?php pll_e('blog-sidebar');?></h3>
					<div class="m-0 p-4"><?php 
						$loop = new WP_Query( array(
								'post_type' => 'post',
								'posts_per_page' => 4,
								'category__not_in' => array('78') ,
							)
						);
						while ( $loop->have_posts() ) : $loop->the_post();
							$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
							$cat=get_the_category();?>
							<div class="card" data-aos="zoom-in-up" data-aos-delay="350">
								<a href="<?php the_permalink();?>">
									<div class="">
										<img class="img-fluid w-100" src="<?php echo $featured_img_url; ?>" data-img="<?php echo $featured_img_url; ?>" onError="this.src=https://dummyimage.com/600x400/f0f0f0/bababa.jpg" alt="<?php the_title();?>">
									</div>
									<div class="bg-light p-3 title-card">
										<div class="cat"><?php echo $cat[0]->name;?></div>
										<div class="title text-center text-dark"><?php the_title();?></div>
									</div>
								</a>
							</div><?php
						endwhile;
						wp_reset_postdata();?>
					</div>
				</div>
			</div>
		</div><?php
		endif;
	}
}?>
<!--container-->
<?php get_footer('lebasi');?>