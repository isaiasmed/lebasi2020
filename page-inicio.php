<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Lebasi Swiss Group - México</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo get_template_directory_uri(); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/vendor/css/custom.css?v=1.11" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha256-4hqlsNP9KM6+2eA8VUT0kk4RsMRTeS7QGHIM+MZ5sLY=" crossorigin="anonymous" />
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/vendor/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/vendor/images/favicon.ico" type="image/x-icon">
  <?php wp_head();?>
</head>

<body>

  <div class="header py-2">
    <div class="slick">
		<div class="item" style="100%"><a href="<?php echo site_url('tienda'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/banner1.jpg"></a></div>
		<div class="item" style="100%"><a href="<?php echo site_url('tienda'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/banner2.jpg"></a></div>
		<div class="item" style="100%"><a href="<?php echo site_url('tienda'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/banner3.jpg"></a></div>
	</div>
    <!--container-->
</div>

<nav class="navbar navbar-expand-sm sticky-top navbar-light bg-white py-2 border-bottom border-primary shadow">
    <div class="container">
        <a class="navbar-brand" href="<?php echo site_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/logolebasi_opt.png" width="120"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav ml-5">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url();?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
					  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Nosotros
					  </a>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="<?php echo site_url('historia');?>">Historia</a>
						<a class="dropdown-item" href="<?php echo site_url('filosofia');?>">Filosofia</a>
						<a class="dropdown-item" href="<?php echo site_url('valores');?>">Valores</a>
						<a class="dropdown-item" href="<?php echo site_url('fundador');?>">Fundador</a>
					  </div>
					</div>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('que-es-lebasi');?>">¿Qué es Lebasi?</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('plan-de-ganancias');?>">Quiero ser distribuidor</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo site_url('backoffice');?>"><i class="fa fa-briefcase" aria-hidden="true"></i> Backoffice</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link text-primary" href="<?php echo site_url('tienda');?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Tienda</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
				<li class="nav-setting pt-2 pr-2">
					<a href="<?php echo site_url('tienda');?>"><img src="<?php echo get_template_directory_uri(); ?>/vendor/images/icon_mex.png" width="25"></a>
				</li>
                <li class="nav-setting cart">
                    <a class="nav-link" href="<?php echo site_url('tienda');?>">
						<i class="fa fa-shopping-cart fa-badge" ><!--data-count="5"--></i>
					</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
	<div class="row mt-5 principal">
        <div class="col-12 col-md-6 mb-3" data-aos="flip-right" data-aos-delay="200">
			<a href="<?php echo site_url('tienda');?>" class="text-center d-flex">
				<h2 class="position-absolute text-white mt-4 mr-5 pr-5 text-center w-100"><strong>¡Compra Lebasi ahora!</strong></h2>
				<img class="img-fluid of" src="<?php echo get_template_directory_uri(); ?>/vendor/images/compra-lebasi.jpg">
			</a>
		</div>
		<div class="col-12 col-md-6 mb-3" data-aos="flip-left" data-aos-delay="400">
			<a href="<?php echo site_url('plan-de-ganancias');?>" class="text-center d-flex">
				<h2 class="position-absolute text-white mt-4 mr-5 pr-5 text-center w-100"><strong>Inscríbete y gana dinero como distribuidor</strong></h2>
				<img class="img-fluid of" src="<?php echo get_template_directory_uri(); ?>/vendor/images/distribuidor.jpg">
			</a>
		</div>
		<!--<div class="col-12 col-md-4 mb-3" data-aos="flip-left" data-aos-delay="700">
			<a href="#" class="text-center d-flex">
				<h2 class="w-100 position-absolute text-white mt-4 mr-5 pr-5 text-center"><strong>Promociones del Mes</strong></h2>
				<img class="img-fluid of" src="<?php echo get_template_directory_uri(); ?>/vendor/images/hazteDistribuidor.png">
			</a>
		</div>-->
	</div>
	<section class="mt-5" style="overflow:hidden;">
		<h2 class="text-center text-primary mb-5">¿Qué es Lebasi?</h2>
		<div class="row mt-3 p-0">
			<div class="col-12 col-md-5" data-aos="zoom-out" data-aos-delay="500">
				<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/vendor/images/vacasuiza.jpg">
			</div>
			<div class="col-12 col-md-7 pl-2 border-primary border-left border-lebasi border-md">
				<div class="text-center h1 mt-2 text-dark">Alimento Suizo</div>
				<div class="text-center h3">100% Natural</div>
				<div class="text-center h2 mt-2">Contiene más de 41 nutrientes:</div>

				<div class="text-left h4 ml-5 mt-3">11 Vitaminas</div>
				<div class="text-left h4 ml-5">11 Minerales</div>
				<div class="text-left h4 ml-5">19 Aminoácidos</div>
			</div>
			<div class="col-12 text-right"><a data-aos="fade-left" data-aos-delay="600" class="btn btn-primary mt-3" href="<?php echo site_url('que-es-lebasi');?>"><strong> Conoce mas...</strong></a></div>
		</div>
	</section>
	<section class="products fff">
		<div class="row m-0 p-0"><?php
			$slider_products_q = new WP_Query([
				 'posts_per_page'    => 3,
				  'post_type'         => 'product',
				  'orderby'           => 'date',
				  'order'             => 'DESC'
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
				
					<div class="col-md-4 col-sm-4">
						<div class="single-new-arrival p-1">
							<div class="single-new-arrival-bg">
								<a href="<?php echo $add_to_cart_url; ?>" class="p-5 d-block"><img  class="img-fluid" src="<?php echo $image_url;?>" alt="images"></a>
								<div class="single-new-arrival-bg-overlay"></div>
								<div class="new-arrival-cart">
									<p class="text-center">
										<span class="lnr lnr-cart"></span>
										<a class="add-to-cart btn btn-primary text-white" href="<?php echo $add_to_cart_url; ?>">
											Agregar a carrito
										</a>
									</p>
								</div>
							</div>
							<h4 class="text-center"><a href="<?php echo $add_to_cart_url; ?>"><?php  echo $product->get_title(); ?></a></h4>
							<p class="arrival-product-price h3 text-center"><strong><?php echo $product->get_price_html();?></strong></p>
						</div>
					</div><?php
				endwhile;
			endif; ?>
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
		<h2 class="text-center text-primary mb-5">Testimonios</h2>
		<div class="row p-0 m-0"><?php
			$cat='news';
			$args1 = array(
				'post_type' => 'post',
				'posts_per_page' => -1,
				'category__in' => 78
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
		<h3 class="text-center text-primary mb-4" data-aos="flip-down" data-aos-delay="650">Artículos de interes</h3>
		<div class="row m-0 p-0">
			<?php 
				$loop = new WP_Query( array(
						'post_type' => 'post',
						'posts_per_page' => -1,
						'category__not_in' => array('78') ,
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