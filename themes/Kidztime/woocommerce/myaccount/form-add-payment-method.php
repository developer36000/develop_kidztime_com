<?php
/**
 * Add payment method form form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-add-payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$available_gateways = WC()->payment_gateways->get_available_payment_gateways();

if ( $available_gateways ) : ?>
<!-- ADD PAYMENT DETAILS BLOCK -->
<div class="woo-account__add-payment-details">

	<h2 class="account-title__sub"><?php echo __('Payment Details', kt_textdomain); ?></h2>

	<form id="add_payment_method" method="post">
		<div id="payment" class="woocommerce-Payment">
			<ul class="woocommerce-PaymentMethods payment_methods methods">
				<?php
				// Chosen Method.
				if ( count( $available_gateways ) ) {
					current( $available_gateways )->set_current();
				}

				foreach ( $available_gateways as $gateway ) :
					?>
					<li class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr( $gateway->id ); ?>
					payment_methods_item payment_method_<?php echo esc_attr( $gateway->id ); ?>">

						<span class="payment_methods_description">
							 <input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio"
							        name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>"
											<?php checked( $gateway->chosen, true ); ?> />
			        <label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
								<span class="payment_methods_description--label"><?php echo wp_kses_post( $gateway->get_title() ); ?></span>
								<span class="payment_methods_description--icons"><?php echo wp_kses_post( $gateway->get_icon() ); ?></span>
							</label>
						</span>

						<?php if ( $gateway->has_fields() || $gateway->get_description() ) :
							echo '<div class="woocommerce-PaymentBox woocommerce-PaymentBox--' . esc_attr( $gateway->id ) . ' payment_box payment_method_' . esc_attr( $gateway->id ) . '" style="display: none;">';
							$gateway->payment_fields();
							echo '</div>';
						endif; ?>

					</li>
				<?php endforeach; ?>
			</ul>

			<div class="form-row form-row__submit">
				<?php wp_nonce_field( 'woocommerce-add-payment-method', 'woocommerce-add-payment-method-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-Button--alt button alt kt-btn--customize
				kt-btn--add" id="place_order"
				        value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>">
					<?php esc_html_e( 'Save', 'woocommerce' ); ?>
				</button>
				<input type="hidden" name="woocommerce_add_payment_method" id="woocommerce_add_payment_method" value="1" />
			</div>
		</div>
	</form>
</div>
<!-- END ADD PAYMENT DETAILS BLOCK -->
<?php else : ?>
<!-- ADD PAYMENT DETAILS BLOCK -->
<div class="woo-account__add-payment-details">
	<img src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/icons/no-orders.svg'; ?>"
	     class="simple-msg__img" alt="Payment" loading="lazy" />
	<h3 class="simple-msg__title"><?php esc_html_e( 'New payment methods can only be added during checkout.', 'woocommerce' ); ?></h3>
	<p class="simple-msg"><?php esc_html_e( 'Please contact us if you require assistance.', 'woocommerce' ); ?></p>
</div>
<!-- END ADD PAYMENT DETAILS BLOCK -->
<?php endif; ?>
