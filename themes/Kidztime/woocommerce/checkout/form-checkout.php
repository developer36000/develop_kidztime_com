<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="woo-checkout__container">

	<?php do_action( 'woocommerce_before_checkout_form', $checkout );

	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
		echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
		return;
	}

	?>

	<form name="checkout" method="post" class="checkout woocommerce-checkout woo-kt_form "
	      action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set" id="customer_details">
				<div class="col-1 woo-checkout__column">

					<h2 class="checkout-title"><?php esc_html_e('Checkout', 'woocommerce'); ?></h2>

					<!-- Custom Checkout Tabs -->
					<?php do_action( 'wc_checkout_billing_tabs' ); ?>
					<!-- END Custom Checkout Tabs -->
					<div data-id="digital"  class="tab-content digital is_active">
						<!-- CHECKOUT BILLING ADDRESSES -->
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						<!-- END CHECKOUT BILLING ADDRESSES -->

						<!-- CUSTOM CHECKOUT PAYMENT BLOCK -->
						<?php wc_get_template( 'checkout/parts/part-checkout_payment.php' ); ?>
						<!-- END CUSTOM CHECKOUT PAYMENT BLOCK -->
					</div>
					<div data-id="live"  class="tab-content live">
						<!-- CHECKOUT BILLING ADDRESSES -->
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						<!-- END CHECKOUT BILLING ADDRESSES -->
					</div>

					<div class="woo-checkout__container--submit digital">
						<?php
						$order_button_text = 'Confirm Order';
						$order_button_text =  apply_filters( 'woocommerce_order_button_text', $order_button_text );
						echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); ?>
						<?php do_action( 'woocommerce_review_order_after_submit' ); ?>
						<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
					</div>
					<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

				</div>

				<div class="col-2 woo-checkout__column">

					<!-- ORDER SUMMARY BLOCK -->
					<?php wc_get_template( 'checkout/parts/part-order_summary.php' ); ?>
					<!-- END ORDER SUMMARY BLOCK -->

				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>




	</form>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>
