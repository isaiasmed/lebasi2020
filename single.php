<?php get_header('lebasi');?>
<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>
		<div class="container contenido">
			<h2 class="h1 my-5" ><?php the_title();?></h2>
			<div class="row">
				<div class="col-12 col-md-8"><?php the_content(); ?></div>
				<!--Sidebar-->
				<div class="col-12 col-md-4 sidebar">
					<h3 class="text-center text-primary mb-2" data-aos="flip-down" data-aos-delay="300">Artículos de interes</h3>
					<div class="m-0 p-4"><?php 
						$loop = new WP_Query( array(
								'post_type' => 'post',
								'posts_per_page' => 5,
								'category__not_in' => array('78') ,
							)
						);
						while ( $loop->have_posts() ) : $loop->the_post();
							$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
							$cat=get_the_category();?>
							<div class="card" data-aos="zoom-in-up" data-aos-delay="350">
								<a href="<?php the_permalink();?>">
									<div>
										<img class="img-fluid w-100" src="<?php echo $featured_img_url; ?>" onError="this.src=https://dummyimage.com/600x400/f0f0f0/bababa.jpg">
									</div>
									<div class="bg-light p-3 title-card">
										<div class="cat"><?php echo $cat[0]->name;?></div>
										<div class="title text-center text-dark"><strong><?php the_title();?></strong></div>
									</div>
								</a>
							</div><?php
						endwhile;?>
					</div>
				</div>
			</div>
		</div>
		<!--container--><?php
		} // end while
} // end if ?>
<?php get_footer('lebasi');?>