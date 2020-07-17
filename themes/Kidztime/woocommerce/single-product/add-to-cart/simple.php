<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}
$product_id = $product->get_id();
$arr_params = array(
	'edit_product' => true
);
$edit_product_link = add_query_arg( $arr_params, get_permalink( $product_id ) );

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>
		  <div class="single-quantity">
			  <div class="label-quantity"><?php esc_html_e('Quantity', kt_textdomain); ?></div>
				<?php woocommerce_quantity_input(
					array(
						'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
						'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
						'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
					)
				); ?>
		  </div>

		<?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
		<div class="form-button">
			<a href="<?php echo $edit_product_link; ?>" class="edit-product woo-btn woo-btn__edit-product" name="edit-product"
			        value="<?php echo esc_attr( $product->get_id() ); ?>">
				<svg width="22" height="23" viewBox="0 0 22 23" class="edit-icon" fill="#58448B" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M10.0429 3.04342C11.3563 1.73004 13.1376 0.992188 14.995 0.992188C16.8524 0.992188 18.6337 1.73004 19.9471 3.04342C21.2605 4.3568 21.9983 6.13812 21.9983 7.99552C21.9983 9.85256 21.2608 11.6336 19.9479 12.9469L19.9471 12.9476L17.2936 15.609C17.2409 15.6777 17.1794 15.7393 17.1109 15.7923L13.2082 19.7066C13.0205 19.8948 12.7657 20.0005 12.5 20.0005H4.41418L1.70711 22.7076C1.31658 23.0981 0.683418 23.0981 0.292893 22.7076C-0.0976311 22.3171 -0.0976311 21.6839 0.292893 21.2934L3 18.5863V10.5005C3 10.2353 3.10536 9.98095 3.29289 9.79342L10.0429 3.04342ZM16.0731 14.0005L18.5318 11.5345L18.5329 11.5334C19.4712 10.5951 19.9983 9.32249 19.9983 7.99552C19.9983 6.66856 19.4712 5.39594 18.5329 4.45763C17.5946 3.51932 16.322 2.99219 14.995 2.99219C13.668 2.99219 12.3954 3.51932 11.4571 4.45763L5 10.9147V16.5863L14.2929 7.29338C14.6834 6.90286 15.3166 6.90286 15.7071 7.29338C16.0976 7.68391 16.0976 8.31707 15.7071 8.70759L10.4142 14.0005H16.0731ZM8.41421 16.0005H14.079L12.0849 18.0005H6.41418L8.41421 16.0005Z" fill="inherit"/>
				</svg><?php esc_html_e('Edit', kt_textdomain); ?>
			</a>
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"
			        class="single_add_to_cart_button kt-btn">
				<svg width="22" height="22" viewBox="0 0 22 22" fill="white" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M17.151 1.70515L20.4951 5.04921C21.1361 5.69029 21.5 6.5393 21.5 7.44029V18.2868C21.5 19.2051 21.1535 20.0542 20.5124 20.6952C19.8713 21.3363 19.005 21.6829 18.104 21.6829H3.89604C2.97772 21.6829 2.12871 21.3363 1.48762 20.6952C0.846535 20.0542 0.5 19.1878 0.5 18.2868V7.44029C0.5 6.5393 0.846535 5.69029 1.50495 5.04921L4.83168 1.70515C5.47277 1.04673 6.33911 0.700195 7.2401 0.700195H14.7599C15.6436 0.700195 16.5272 1.06406 17.151 1.70515ZM7.2401 2.76208C6.89356 2.76208 6.56436 2.90069 6.30446 3.14326L4.01733 5.43039H17.9827L15.6955 3.14326C15.4356 2.90069 15.1064 2.76208 14.7426 2.76208H7.2401ZM19.0396 19.2571C19.2995 18.9972 19.4381 18.6507 19.4381 18.3042H19.4035V7.49227H2.52723V18.3042C2.52723 18.668 2.68317 19.0146 2.92574 19.2571C3.18564 19.517 3.53218 19.6556 3.87871 19.6556H18.0866C18.4505 19.6556 18.797 19.4997 19.0396 19.2571ZM14.2399 14.4577C13.3736 15.324 12.23 15.7918 10.9998 15.7918C9.7696 15.7918 8.62603 15.3067 7.7597 14.4577C6.91069 13.5914 6.42554 12.4478 6.42554 11.2176C6.42554 10.9404 6.5295 10.6805 6.72009 10.4899C6.91069 10.2993 7.17059 10.1953 7.44781 10.1953C7.72504 10.1953 7.98494 10.2993 8.17554 10.4899C8.36613 10.6805 8.47009 10.9404 8.47009 11.2176C8.47009 11.8933 8.72999 12.5171 9.21514 13.0022C9.70029 13.4874 10.3241 13.7473 10.9998 13.7473C11.6755 13.7473 12.3166 13.4701 12.7845 13.0022C13.2696 12.5171 13.5295 11.8933 13.5295 11.2176C13.5295 10.9404 13.6335 10.6805 13.8241 10.4899C14.2052 10.1087 14.8983 10.1087 15.2795 10.4899C15.4701 10.6805 15.5741 10.9404 15.5741 11.2176C15.5741 12.4478 15.1062 13.5914 14.2399 14.4577Z" fill="inherit"/>
				</svg>

				<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
			</button>
		</div>


		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
