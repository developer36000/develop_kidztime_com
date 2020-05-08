<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<!-- .woocommerce-customer-details -->
<section class="woo-order woo-order__order-customer-details">

	<h3 class="order-title"><?php esc_html_e( 'Ship to', kt_textdomain ); ?></h3>

	<?php if ( $show_shipping ) : ?>
		<address class="shipping-address">
			<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
		</address>
	<?php else: ?>
		<address class="billing-address">
			<?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>

			<?php if ( $order->get_billing_phone() ) : ?>
				<span class="woo-order-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></span>
			<?php endif; ?>

			<?php if ( $order->get_billing_email() ) : ?>
				<span class="woo-order-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></span>
			<?php endif; ?>
		</address>
	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>
