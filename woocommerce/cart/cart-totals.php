<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>

<div class="cart_totals mt-4 <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

	<?php do_action('woocommerce_before_cart_totals'); ?>



	<div class="col-md-12 divider_col">
		<h2><?php esc_html_e('Cart totals', 'woocommerce'); ?></h2>

		<span class="light_divider w-100 d-block mb-4"></span>
		<div class="row my-3">
			<div class="col-6"><b class="text_light_check"><?php esc_html_e('Subtotal', 'woocommerce'); ?></b></div>
			<div data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>" class="col-6"><?php wc_cart_totals_subtotal_html(); ?></div>
		</div>

		<div class="row">
			<div class="col-6">
				<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
					<div class="row cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
						<div class="col-6"><b class="text_light_check"><?php wc_cart_totals_coupon_label($coupon); ?></b></div>
						<div class="col-6" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>



		<div class="row">
			<div class="col-6">
				<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

					<?php do_action('woocommerce_cart_totals_before_shipping'); ?>

					<?php do_action('woocommerce_cart_totals_after_shipping'); ?>

				<?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

					<tr class="shipping">
						<th><?php esc_html_e('Shipping', 'woocommerce'); ?></th>
						<td data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php woocommerce_shipping_calculator(); ?></td>
					</tr>

				<?php endif; ?>

				<?php foreach (WC()->cart->get_fees() as $fee) : ?>
					<tr class="fee">
						<th><?php echo esc_html($fee->name); ?></th>
						<td data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></td>
					</tr>
				<?php endforeach; ?>
			</div>

			<div class="col-6">
				<?php
				if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
					$taxable_address = WC()->customer->get_taxable_address();
					$estimated_text  = '';

					if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
						/* translators: %s location. */
						$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
					}

					if ('itemized' === get_option('woocommerce_tax_total_display')) {
						foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				?>
							<tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
								<th><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									?></th>
								<td data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr class="tax-total">
							<th><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?></th>
							<td data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
						</tr>
				<?php
					}
				}
				?>
			</div>
			
		</div>
		<div class="row">
			<div class="col-12 col-lg-12">
			<?php wc_cart_totals_shipping_html(); ?>
			</div>
		</div>
		<?php do_action('woocommerce_cart_totals_before_order_total'); ?>
			<div class="row">
				<div class="col-6"><b class=""><?php esc_html_e('Total', 'woocommerce'); ?></b></div>
				<div class="col-6" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
					<?php wc_cart_totals_order_total_html(); ?>
				</div>
			</div>
			<?php do_action('woocommerce_cart_totals_after_order_total'); ?>
		<div class="row mt-3">
			<div class="col-sm-12">
				<div class="wc-proceed-to-checkout">
					<?php do_action('woocommerce_proceed_to_checkout'); ?>
				</div>
			</div>
		</div>
		<?php do_action('woocommerce_after_cart_totals'); ?>
	</div>






	

</div>