<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="row related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'You Might Also be Interested In', 'woocommerce' ) );

		if ( $heading ) :
			?>
			
		<?php endif; ?>
		<div class="row divider_container .divider_col py-5">
			<div class="col-md-12 divider_col d-flex flex-column justify-content-center align-items-center">
			<h2 class="text-center d-block mb-4"><?php echo esc_html( $heading ); ?></h2>
			
				<span class="dark_divider w-25 d-block mb-4">
				</span>
				<p class="body_big">
			Find similar artwork below.
			</p>
			</div>
		</div>
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'related_products' );
					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();
