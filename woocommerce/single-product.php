<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'lebasi' ); ?>
<div class="container contenido">
	<h2 class="h1 my-5" ><?php the_title();?></h2>
	<div class="row">
		<div class="col-12 col-md-8 sidebar mt-1">
		<?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action( 'woocommerce_before_main_content' );
		?>

			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>

				<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php
			/**
			 * woocommerce_after_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
		?>
		</div>
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );?>
		<div class="col-12 col-md-4 sidebar mt-1">
			<h3 class="text-center text-primary mb-2" data-aos="flip-down" data-aos-delay="650"><?php pll_e('blog-sidebar');?></h3>
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
					<div class="card" data-aos="zoom-in-up" data-aos-delay="800">
						<a href="<?php the_permalink();?>">
							<div>
								<img class="img-fluid w-100" src="<?php echo $featured_img_url; ?>" onError="this.src=https://dummyimage.com/600x400/f0f0f0/bababa.jpg" alt="<?php the_title();?>">
							</div>
							<div class="bg-light p-3 title-card">
								<div class="cat"><?php echo $cat[0]->name;?></div>
								<div class="title text-center text-dark"><?php the_title();?></div>
							</div>
						</a>
					</div><?php
				endwhile;?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer( 'lebasi' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
