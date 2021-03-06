<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}

$is_visible        = $product && $product->is_visible();
$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

$qty          = $item->get_quantity();
$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

if ( $refunded_qty ) {
	$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
} else {
	$qty_display = esc_html( $qty );
}
$product_sku = $product->get_sku();
$product_id = $product->get_id();
$product_cat_name = wc_product_category_name( $product_id );



?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">

	<td class="woocommerce-table__product-name product-name"
	    data-title="<?php esc_html_e( 'Product', 'woocommerce' ); ?>">
		<div class="product-information">
			<?php if( !is_order_received_page() ) : ?>
				<?php

				echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a class="product-name" href="%s">%s</a>',
					$product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ); ?>
			<?php else: ?>
				<span class="product-name">
			 <?php echo $item->get_name(); ?>
		</span>
			<?php endif; ?>


			<?php echo $product_cat_name ? '<span class="product-category">'.$product_cat_name.'</span>' : ''; ?>
			<?php echo $product_sku ? '<span class="product-sku">SKU: #'.$product_sku.'</span>' : ''; ?>

			<?php do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

			wc_display_item_meta( $item );

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );

			?>
		</div>

	</td>

	<td class="woocommerce-table__product-total product-quantity"
	    data-title="<?php esc_html_e( 'Qty', kt_textdomain ); ?>">
		<?php echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '%s', $qty_display ) . '</strong>', $item ); ?>
	</td>

	<td class="woocommerce-table__product-total product-price"
	    data-title="<?php echo _e( 'Price', kt_textdomain ).', ' .get_currency_name(); ?>">
		<?php echo $product->get_price_html(); ?>
	</td>

	<td class="woocommerce-table__product-total product-total"
	    data-title="<?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>">
		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
	</td>

</tr>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>

</tr>

<?php endif; ?>
