<?php /* Template Name: Example Template */ ?>
<?php get_header('lebasi');?>
<div class="container">
	<div class="row mt-5 principal">
        <div class="col-12 col-md-4 mb-3 p-1" data-aos="flip-right" data-aos-delay="10">
			<a href="<?php echo site_url('tienda');?>" class="text-center d-flex">
				<h2 class="position-absolute text-white mt-4 mr-5 pr-5 text-center w-100"><strong><?php pll_e('buy-home');?></strong></h2>
				<img class="img-fluid of" src="<?php echo get_template_directory_uri(); ?>/vendor/images/compra-lebasi.jpg">
			</a>
		</div>
		<div class="col-12 col-md-4 mb-3 p-1" data-aos="flip-down" data-aos-delay="20">
			<a href="<?php echo site_url('plan-de-ganancias');?>" class="text-center d-flex">
				<h2 class="position-absolute text-white mt-4 mr-5 pr-5 text-center w-100"><strong><?php pll_e('sign-home');?></strong></h2>
				<img class="img-fluid of" src="<?php echo get_template_directory_uri(); ?>/vendor/images/distribuidor.jpg">
			</a>
		</div>
		<div class="col-12 col-md-4 mb-3 p-1" data-aos="flip-left" data-aos-delay="30">
			<a href="<?php echo site_url('contacta-a-nuestros-especialistas');?>" class="text-center d-flex">
				<h2 class="position-absolute text-white mt-4 mr-5 pr-5 text-center w-100"><strong><strong><?php pll_e('contact-home');?></strong></h2>
				<img class="img-fluid of" src="<?php echo get_template_directory_uri(); ?>/vendor/images/doctor.jpg">
			</a>
		</div>
	</div>
	<section class="mt-5" style="overflow:hidden;">
		<?php //buscador();?>
		<h2 class="text-center text-primary mb-5"><?php pll_e('what-home');?></h2>
		<div class="row mt-3 p-0">
			<div class="col-12 col-md-5" data-aos="zoom-out" data-aos-delay="100">
				<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/vendor/images/vacasuiza.jpg">
			</div>
			<div class="col-12 col-md-7 pl-2 border-primary border-left border-lebasi border-md">
				<div class="text-center h1 mt-2 text-dark"><?php pll_e('swiss-home');?></div>
				<div class="text-center h3"><?php pll_e('natural-home');?></div>
				<div class="text-center h2 mt-2"><?php pll_e('contains-home');?></div>

				<div class="text-left h4 ml-5 mt-3"><?php pll_e('vitamins-home'); ?></div>
				<div class="text-left h4 ml-5"><?php pll_e('minerals-home'); ?></div>
				<div class="text-left h4 ml-5"><?php pll_e('amino-home'); ?></div>
			</div>
			<div class="col-12 text-right"><a data-aos="fade-left" data-aos-delay="600" class="btn btn-primary mt-3" href="<?php echo site_url('que-es-lebasi');?>"><strong><?php pll_e('more-home'); ?></strong></a></div>
		</div>
	</section>
	
	<section class="products mt-4"><?php
		/*$d=get_micrositio_cookie();
		if($d){
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
		
			
		
			<div class="micros">
				
				<div id="micrositio" class="clearfix">
					<img src="<?php echo $foto['sizes']['thumbnail'];?>" width="70">
					<div class="datosmicro">
						<span class="d-block w-100">Distribuidor</span>
						<span class="d-block w-100"><?php echo $dist[0]; ?> | <?php echo $dist[1]; ?></span>
						<a href="<?php echo site_url('distribuidor/'.$slug);?>" onclick="gtag('event', 'clic', { 'event_category': 'micrositio', 'event_label': 'Dist-'<?php echo $dist[0]; ?> | <?php echo $dist[1]; ?>, 'value': '<?php echo get_the_ID();?>'});">Ver micrositio</a>
					</div>
				</div>
			</div><?php				
		}else{?>
			<div class="micros resmicro text-center">
				Asignando Distribuidor... <i class="fa fa-spin fa-cog"></i>
			</div><?php
		}*/?>
		<div class="row m-0 p-0 op-1"><?php
			$slider_products_q = new WP_Query([
				 'posts_per_page'    => 10,
				  'post_type'         => 'product',
				  'orderby'           => 'date',
				  'order'             => 'ASC',
				  'tax_query'            => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'term_id', // Or 'name' or 'term_id'
							'terms'    => array(164,166,189,192),
							'operator' => 'NOT IN', // Excluded
						)
					)
			]);
						
			if ($slider_products_q->have_posts()):
				while($slider_products_q->have_posts()):
				    $slider_products_q->the_post();         
				    $product_id = get_the_ID();
				    $product = wc_get_product($product_id);
				    $price_html = $product->get_price_html();
				    $image_id  = $product->get_image_id();
					$image_url = wp_get_attachment_image_url( $image_id, 'medium' );
					$add_to_cart_url = $product->add_to_cart_url();?>
				
					<div class="col-12 col-md-4">
						<div class="single-new-arrival p-1">
							<div class="single-new-arrival-bg">
								<a href="<?php echo $add_to_cart_url; ?>" class="p-5 d-block"><img  class="img-fluid" src="<?php echo $image_url;?>" alt="images"></a>
								<div class="single-new-arrival-bg-overlay"></div>
								<div class="new-arrival-cart">
									<p class="text-center">
										<span class="lnr lnr-cart"></span>
										<a class="add-to-cart btn btn-primary text-white" href="<?php echo $add_to_cart_url; ?>">
											<?php pll_e('add-to-cart');?>
										</a>
									</p>
								</div>
							</div>
							<h4 class="text-center"><a href="<?php echo $add_to_cart_url; ?>"><?php  echo $product->get_title(); ?></a></h4>
							<p class="arrival-product-price h3 text-center"><strong><?php echo $product->get_price_html();?></strong></p>
							<?php $meta = get_post_meta( get_the_ID(),'_alg_wc_pvbur_invisible'); ?>
						</div>
					</div><?php
				endwhile;
			endif; 
			wp_reset_postdata();?>
		</div>
	</section>
	<section class="tomalebasi mt-5">
		<h2 class="text-center text-primary mb-5">¿Quiénes lo pueden tomar?</h2>
		<div class="row p-0 m-0">
			<div class="col-12 p-0" data-aos="zoom-in" data-aos-delay="600">
				<a href="<?php echo site_url('quienes-pueden-tomarlo/hombres-y-mujeres');?>">
				<div class="d-flex">
					<h2 class="position-absolute text-white mt-5 py-3 ml-5 text-center h1 border-bottom border-top border-lebasi">Hombres y mujeres</h2>
					<img class="img-fluid of h-75" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/hombresymujeres.jpg">
				</div>
				</a>
			</div>
			<div class="col-12 col-md-6 p-0" data-aos="zoom-in" data-aos-delay="750">
				<a href="<?php echo site_url('quienes-pueden-tomarlo/deportistas');?>">
					<div class="d-flex">
						<h2 class="position-absolute text-white mt-5 py-2 ml-5 text-center h2 border-bottom border-top border-lebasi-2">Deportistas</h2>
						<img class="img-fluid of h-75" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/deportistas.jpg">
					</div>
				</a>
			</div>
			<div class="col-12 col-md-6 p-0" data-aos="zoom-in" data-aos-delay="750">
				<a href="<?php echo site_url('quienes-pueden-tomarlo/ninos-y-adolescentes');?>">
				<div class="d-flex">
					<h2 class="position-absolute text-white mt-5 py-2 ml-5 text-center h2 border-bottom border-top border-lebasi-2">Niños y adolescentes</h2>
					<img class="img-fluid of h-75" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/niniosyadolescentes.jpg">
				</div>
				</a>
			</div>
			<div class="col-12 col-md-6 p-0" data-aos="zoom-in" data-aos-delay="800">
				<a href="<?php echo site_url('quienes-pueden-tomarlo/embarazo-y-lactancia');?>">
				<div class="d-flex">
					<h2 class="position-absolute text-white mt-5 py-2 ml-5 text-center h2 border-bottom border-top border-lebasi-2">Embarazo y lactancia</h2>
					<img class="img-fluid of h-75" src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/embarazoylactancia.jpg">
				</div>
				</a>
			</div>
			<div class="col-12 col-md-6 p-0" data-aos="zoom-in" data-aos-delay="800">
				<a href="<?php echo site_url('quienes-pueden-tomarlo/tercera-edad');?>">
				<div class="d-flex h-100">
					<h2 class="position-absolute text-white mt-5 py-2 ml-5 text-center h2 border-bottom border-top border-lebasi-2">Tercera edad</h2>
					<img class="img-fluid of " src="<?php echo get_template_directory_uri(); ?>/vendor/images/tercera-edad.jpg">
				</div>
				</a>
			</div>
		</div>
	</section>
	<section class="testimonios mt-5">
		<h2 class="text-center text-primary mb-5"><?php  pll_e('testimonials-index');?></h2>
		<div class="row p-0 m-0"><?php
			$cat='news';
			$args1 = array(
				'post_type' => 'post',
				'posts_per_page' => -1,
				'category__in' => 100
			);
			$entradas_cat1 = new WP_Query($args1); $a=1;
			$category = get_term_by('name', $cat, 'category');?>
			<?php while ( $entradas_cat1->have_posts() ) : $entradas_cat1->the_post(); ?>
				<?php  $categoria = get_the_category(); ?>
				<div class="col-12 col-sm-6 card-secundario mt-4" data-aos="zoom-in-up" data-aos-delay="600">
					<a href="<?php the_permalink();?>" class="row">
						<div class="col-12 card-secundario-img">
							<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail-testimonios');?>" class="img-fluid w-100" onerror="this.src='https://dummyimage.com/645x490/f0f0f0/cfcfcf.jpg&text=NO IMAGE'">
						</div>
						<div class="col-12">
							<div class="row w-75 mx-auto text-card-secundario p-4 bg-light">
								<div class="col-12 card-title h5 text-center text-dark">
									<?php the_title();?>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
	<section class="blog mt-5">
		<h3 class="text-center text-primary mb-4" data-aos="flip-down" data-aos-delay="650"><?php pll_e('blog-sidebar');?></h3>
		<div class="row m-0 p-0">
			<?php 
				$loop = new WP_Query( array(
						'post_type' => 'post',
						'posts_per_page' => -1,
						'category__not_in' => array('100') ,
					)
				);
				while ( $loop->have_posts() ) : $loop->the_post();
					$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
					$cat=get_the_category();?>
					<div class="col-12 col-md-4 mb-3" data-aos="zoom-in-up" data-aos-delay="800">
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
	</section>
</div>
<!--container-->
<?php get_footer('lebasi');?>