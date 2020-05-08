<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id );

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

?>
<!-- VIEW DETAILS HEADER -->
<div class="woo-order woo-order__order-details-header">
	<?php
	wc_get_template( 'order/order-details-header.php', array( 'order' => $order ) );
	if ( $show_customer_details && !is_order_received_page() ) :
		wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
	endif; ?>
</div>
<!-- END ORDER DETAILS HEADER -->

<!-- VIEW ORDER DETAILS BLOCK -->
<!-- .woocommerce-customer-details -->
<section class="woo-order woo-order__order-details">
	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

	<table class="woocommerce-table woocommerce-table--order-details shop_table order_details shop_table_responsive">

		<thead>
			<tr>
				<th class="woocommerce-table__product-name product-name">
					<?php esc_html_e( 'Product', 'woocommerce' ); ?>
				</th>
				<th class="woocommerce-table__product-table product-quantity">
					<?php esc_html_e( 'Qty', kt_textdomain ); ?></th>
				<th class="woocommerce-table__product-table product-price">
					<?php echo _e( 'Price', kt_textdomain ).', ' .get_currency_name(); ?>
				</th>
				<th class="woocommerce-table__product-table product-total">
					<?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>
				</th>
			</tr>
		</thead>

		<tbody>
			<?php
			do_action( 'woocommerce_order_details_before_order_table_items', $order );

			foreach ( $order_items as $item_id => $item ) :
				$product = $item->get_product();

				wc_get_template(
					'order/order-details-item.php',
					array(
						'order'              => $order,
						'item_id'            => $item_id,
						'item'               => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'      => $product ? $product->get_purchase_note() : '',
						'product'            => $product,
					)
				);
			endforeach;

			do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>
		</tbody>
	</table>

	<div class="woocommerce-table--order-details__sub-table">
		<?php foreach ( $order->get_order_item_totals() as $key => $total ) : ?>
		<?php if( $key == 'order_total' ) : ?>
			<div class="details-row order_total">
				<div class="details-label"><?php echo esc_html( $total['label'] ); ?></div>
				<div class="details-value"><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] );  ?></div>
			</div>

		<?php endif; ?>

		<?php endforeach; ?>
	</div>
	<?php if( is_order_received_page() ) : ?>
		<a class="woo-btn woo-btn__print" href="#">
			<span class="icon-print">
				<svg width="13" height="15" viewBox="0 0 13 15" fill="#58448B" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M3.50002 -0.0332031C2.83728 -0.0332031 2.30002 0.504056 2.30002 1.1668V3.00013C2.30002 3.66287 2.83728 4.20013 3.50002 4.20013H9.50002C10.1628 4.20013 10.7 3.66287 10.7 3.00013V1.1668C10.7 0.504056 10.1628 -0.0332031 9.50002 -0.0332031H3.50002ZM0.5 6C0.403429 6 0.286516 6.0417 0.182634 6.15712C0.0756239 6.27602 0 6.45784 0 6.66667V10.8333C0 11.0422 0.0756239 11.224 0.182634 11.3429C0.286516 11.4583 0.403429 11.5 0.5 11.5H0.700012V11.1667C0.700012 9.6203 1.95362 8.3667 3.50001 8.3667H9.50001C11.0464 8.3667 12.3 9.6203 12.3 11.1667V11.5H12.5C12.5966 11.5 12.7135 11.4583 12.8174 11.3429C12.9244 11.224 13 11.0422 13 10.8333V6.66667C13 6.45784 12.9244 6.27602 12.8174 6.15712C12.7135 6.0417 12.5966 6 12.5 6H0.5ZM10.7 11.1667C10.7 11.1253 10.6979 11.0843 10.6938 11.044C10.6324 10.4389 10.1213 9.9667 9.50001 9.9667H3.50001C2.83727 9.9667 2.30001 10.504 2.30001 11.1667V11.5458L2.30002 13.8335C2.30002 14.4962 2.83728 15.0335 3.50002 15.0335H9.50002C10.1628 15.0335 10.7 14.4962 10.7 13.8335V11.1668L10.7 11.1667Z" fill="inherit"/>
</svg>

			</span>
			<?php esc_html_e('Print', kt_textdomain); ?></a>
	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</section>
<!-- END VIEW ORDER DETAILS BLOCK -->


