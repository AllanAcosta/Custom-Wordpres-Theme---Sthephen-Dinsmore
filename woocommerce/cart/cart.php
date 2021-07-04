<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<div class="row breadcrumb-container pb-5 justify-content-center align-items-center">
	<div class="col-12 col-lg-6">
		<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
		?>
	</div>
	<div class="col-12 col-lg-6">
		<?php
		get_product_search_form();
		?>
	</div>
</div>
<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
	<h1><?php

		echo (the_title());

		?></h1>
	<?php do_action('woocommerce_before_cart_table'); ?>

	<div class="row product_cart_header mx-0 mb-4 py-3">
		<div class="col-md-3"></div>
		<div class="col-md-3 product-name"><?php esc_html_e('Product', 'woocommerce'); ?></div>
		<div class="col-md-2 product-price"><?php esc_html_e('Price', 'woocommerce'); ?></div>
		<div class="col-md-2 product-quantity"><?php esc_html_e('Quantity', 'woocommerce'); ?></div>
		<div class="col-md-2 product-subtotal"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
	</div>



	<?php do_action('woocommerce_before_cart_contents'); ?>

	<?php
	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
		$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
		$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

		if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
			$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
	?>
			<div class="row mx-0 py-4 custom_product_info_row woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

				<div class="col-md-12 col-lg-3 product-thumbnail m-0 mb-2">
					<div class="product_cart_thumbnails">
						<?php
						$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

						if (!$product_permalink) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
						}
						?>
					</div>
					<div class="product-remove my-1">

						<?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove &times;</a>',
								esc_url(wc_get_cart_remove_url($cart_item_key)),
								esc_html__('Remove this item', 'woocommerce'),
								esc_attr($product_id),
								esc_attr($_product->get_sku())
							),
							$cart_item_key
						);
						?>
					</div>
				</div>

				<div class="col-md-12 col-lg-3 product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
					<div class="row">
						<div class="col-6 col-md-6 col-lg-12  responsive_cart_text"><b><?php esc_html_e('Product', 'woocommerce'); ?></b></div>
						<div class="col-6 col-md-6 col-lg-12">
							<?php
							if (!$product_permalink) {
								echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
							} else {
								echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
							}

							do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

							// Meta data.
							echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

							// Backorder notification.
							if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
								echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
							}
							?>
						</div>

					</div>
				</div>

				<div class="col-md-12 col-lg-2 product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
					<div class="row">
						<div class="col-6 col-md-6 col-lg-12 responsive_cart_text"><b><?php esc_html_e('Price', 'woocommerce'); ?></b></div>
						<div class="col-6 col-md-6 col-lg-12">
							<?php
							echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
							?>
						</div>
					</div>

				</div>

				<div class="col-md-12 col-lg-2 product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
					<div class="row">
						<div class="col-6 col-md-6 col-lg-12  responsive_cart_text">
							<div class="col-md-2 product-quantity"><b><?php esc_html_e('Quantity', 'woocommerce'); ?></b></div>
						</div>
						<div class="col-6 col-md-6 col-lg-12">
							<?php
							if ($_product->is_sold_individually()) {
								$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" class="text-center" />', $cart_item_key);
							} else {
								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $_product->get_max_purchase_quantity(),
										'min_value'    => '0',
										'product_name' => $_product->get_name(),
									),
									$_product,
									false
								);
							}

							echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
							?>
						</div>
					</div>

				</div>
				<div class="col-md-12 col-lg-2 product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
					<div class="row">
						<div class="col-6 col-md-6 col-lg-12 responsive_cart_text">
							<div class="col-md-2 product-subtotal"><b><?php esc_html_e('Subtotal', 'woocommerce'); ?></b></div>
						</div>
						<div class="col-6 col-md-6 col-lg-12">
							<?php
							echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
							?>
						</div>
					</div>


				</div>

			</div>



	<?php
		}
	}
	?>

	<?php do_action('woocommerce_cart_contents'); ?>

	<div class="row">
		<div class="col-sm-6 empty_col d-md-none d-lg-block">

		</div>

		<div class="col-md-12 col-lg-6">
			<div class="row coupon_area mt-4">
				<div class="col-sm-6">
					<?php if (wc_coupons_enabled()) { ?>
						<div class="coupon mb-2">
							<label class="coupon_code_label" for="coupon_code"><?php esc_html_e('', 'woocommerce'); ?></label>

							<input type="text" name="coupon_code" class="input-text field_form_format" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
							<?php do_action('woocommerce_cart_coupon'); ?>
						</div>
					<?php } ?>



				</div>
				<div class="col-sm-6">
					<button type="submit" class="button custom_apply_coupon_cart" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
				</div>
				<div class="col-sm-12 custom_update_cart_col">
					<button type="submit" class="button custom_update_cart" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="cart-collaterals">
						<?php
						/**
						 * Cart collaterals hook.
						 *
						 * @hooked woocommerce_cross_sell_display
						 * @hooked woocommerce_cart_totals - 10
						 */
						do_action('woocommerce_cart_collaterals');
						?>
					</div>
				</div>
			</div>
			<?php do_action('woocommerce_cart_actions'); ?>


			<?php do_action('woocommerce_after_cart_contents'); ?>

			<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
		</div>
		<?php do_action('woocommerce_after_cart_contents'); ?>
	</div>

	<?php do_action('woocommerce_after_cart_table'); ?>
</form>

<?php do_action('woocommerce_before_cart_collaterals'); ?>



<?php do_action('woocommerce_after_cart'); ?>