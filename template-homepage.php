<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront
 */

global $woocommerce;

get_header();
?>
<script>
  AOS.init();
</script>

<div class="col-12 col-lg-8">

	<main id="primary" class="site-main">
	
	<ul class="row grid main_products_row products row">
	<?php
		$args = array(
			'post_type' => 'product',
			);
			
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
</ul>

	</main><!-- #main -->
</div>
</div>
</div>

<?php
get_footer();
