<?php
/**
 * Order Customer Header
 */

defined( 'ABSPATH' ) || exit;

?>
<!-- .woocommerce-customer-details -->
<section class="woo-order woo-order__order-details-information">
	<?php if( is_order_received_page() ) : ?>
		<h2 class="order-title--main top" data-tooltip data-click-open="false" tabindex="1"
		    title="<?php esc_html_e( 'Payment method', 'woocommerce' ); ?>">
			<?php echo __('Invoice', kt_textdomain); ?>
		</h2>
	<?php endif; ?>

	<ul class="woocommerce-order-overview">
		<?php if( !is_order_received_page() ) : ?>
			<li class="woocommerce-order-overview__payment-method payment-method">
				<?php esc_html_e( 'Payment Method', 'woocommerce' ); ?>:
				<span class="order-payment-method"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
			</li>
		<?php endif; ?>
		<li class="woocommerce-order-overview__order order">
			<?php esc_html_e( 'Invoice NO', kt_textdomain ); ?>:
			<span class="order-number">#<?php echo $order->get_order_number(); ?></span>
		</li>
		<li class="woocommerce-order-overview__date date">
			<?php esc_html_e( 'Order Date', kt_textdomain ); ?>:
			<span class="order-date"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
		</li>
		<?php if( !is_order_received_page() ) : ?>
			<li class="woocommerce-order-overview__status status">
				<?php esc_html_e( 'Order Status', kt_textdomain ); ?>:
				<span class="order-status"><?php echo wc_get_order_status_name( $order->get_status() ); ?></span>
			</li>
		<?php endif; ?>

	</ul>
</section>
