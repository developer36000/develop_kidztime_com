<?php
/**
 * Payment methods
 *
 * Shows customer payment methods on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/payment-methods.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$saved_methods = wc_get_customer_saved_methods_list( get_current_user_id() );
$has_methods   = (bool) $saved_methods;
$types         = wc_get_account_payment_methods_types();

do_action( 'woocommerce_before_account_payment_methods', $has_methods ); ?>

<!-- PAYMENT DETAILS BLOCK -->
<div class="woo-account__payment-details">

	<?php if ( $has_methods ) : ?>

		<h2 class="account-title__sub"><?php echo __('Payment Details', kt_textdomain); ?></h2>

		<table class="woocommerce-MyAccount-paymentMethods shop_table  account-payment-methods-table">
		<!--	<thead>
				<tr>
					<?php /*foreach ( wc_get_account_payment_methods_columns() as $column_id => $column_name ) : */?>
						<th class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php /*echo esc_attr( $column_id ); */?> payment-method-<?php /*echo esc_attr( $column_id ); */?>"><span class="nobr"><?php /*echo esc_html( $column_name ); */?></span></th>
					<?php /*endforeach; */?>
				</tr>
			</thead>-->

			<?php foreach ( $saved_methods as $type => $methods ) :  ?>
				<?php foreach ( $methods as $method ) : ?>
					<tr class="payment-method<?php echo ! empty( $method['is_default'] ) ? ' default-payment-method' : ''; ?>">
						<?php foreach ( wc_get_account_payment_methods_columns() as $column_id => $column_name ) : ?>
							<td class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr( $column_id ); ?> payment-method
							payment-method-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
								<?php
								if ( has_action( 'woocommerce_account_payment_methods_column_' . $column_id ) ) {
									do_action( 'woocommerce_account_payment_methods_column_' . $column_id, $method );
								} elseif ( 'method' === $column_id ) {
									if ( ! empty( $method['method']['last4'] ) ) {
										/* translators: 1: credit card type 2: last 4 digits */
										echo sprintf(  '<span class="card-row"><span class="card-icon"></span><span class="card-name">%1$s</span>*%2$s</span>', esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) ), esc_html( $method['method']['last4'] ) );
									} else {
										echo sprintf(  '<span class="card-row"><span class="card-icon"></span><span class="card-name">%1$s</span></span>', esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) ) );
									}
								} elseif ( 'expires' === $column_id ) {
									echo '<span class="expires">'.__('Expires', kt_textdomain).': </span>'.esc_html( $method['expires'] );
								} elseif ( 'actions' === $column_id ) {
									foreach ( $method['actions'] as $key => $action ) {
										echo '<a href="' . esc_url( $action['url'] ) . '" class="button woo-btn woo-btn__' . sanitize_html_class(
											$key ) . '">' . esc_html( $action['name'] ) . '</a>';
									}
								}
								?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</table>

	<?php else : ?>
		<img src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/icons/no-orders.svg'; ?>"
		     class="simple-msg__img" alt="Address" loading="lazy" />
		<h3 class="simple-msg__title"><?php esc_html_e( 'No saved methods found.', 'woocommerce' ); ?></h3>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_account_payment_methods', $has_methods ); ?>

	<?php if ( WC()->payment_gateways->get_available_payment_gateways() ) : ?>
		<a class="button woo-btn woo-btn__add" href="<?php echo esc_url( wc_get_endpoint_url( 'add-payment-method' ) ); ?>">
			<?php esc_html_e( 'Add Payment Method', 'woocommerce' ); ?>
		</a>
	<?php endif; ?>
</div>
<!-- END PAYMENT DETAILS BLOCK -->
