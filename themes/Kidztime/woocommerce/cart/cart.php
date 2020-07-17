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
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="woo-cart__container">

  <h2 class="cart-title"><?php esc_html_e('Cart', kt_textdomain); ?></h2>

	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<table class="shop_table shop_table_responsive cart woocommerce-cart-form woocommerce-cart-form__contents" cellspacing="0">
			<thead>
				<tr>
					<th class="product-thumbnail">&nbsp;</th>
					<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					$product_sku = $_product->get_sku();
					$product_cat_name = wc_product_category_name( $product_id );
					$arr_params = array(
						'edit_product' => true
					);
					$edit_product_link = add_query_arg( $arr_params, get_permalink( $product_id ) );
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="product-thumbnail">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('full'), $cart_item,
								$cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail; // PHPCS: XSS ok.
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}
							?>
							</td>

							<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							<?php

							if ( ! $product_permalink ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="product-name" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
							}

							do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

							// Meta data.
							echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

							// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
							}
							?>

								<?php echo $product_cat_name ? '<span class="product-category">'.$product_cat_name.'</span>' : ''; ?>
								<?php echo $product_sku ? '<span class="product-sku">SKU: #'.$product_sku.'</span>' : ''; ?>
								<!-- Amount -->
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal(
									$_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
								<!-- END Amount -->
								<div class="product-actions">
										<span class="product-quantity">
											<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
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

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
										</span>
									<!-- Edit button -->
									<a class="woo-btn woo-btn__edit product-edit" href="<?php echo $edit_product_link; ?>">
										<span class="edit-icon">
											<svg width="16" height="16" viewBox="0 0 16 16" fill="#58448B" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M7.33784 2.0042C8.21968 1.12236 9.4157 0.626953 10.6628 0.626953C11.9099 0.626953 13.1059 1.12236 13.9878 2.0042C14.8696 2.88604 15.365 4.08207 15.365 5.32918C15.365 6.57616 14.8697 7.77208 13.988 8.6539L12.2211 10.4261C12.1845 10.4736 12.142 10.5162 12.0946 10.5529L9.49519 13.1601C9.36385 13.2918 9.18549 13.3658 8.99948 13.3658H3.62306L1.82779 15.1611C1.55442 15.4345 1.1112 15.4345 0.837838 15.1611C0.564471 14.8878 0.564471 14.4445 0.837838 14.1712L2.63281 12.3762V6.99918C2.63281 6.81353 2.70656 6.63548 2.83784 6.5042L7.33784 2.0042ZM11.3676 9.29932L12.9978 7.6642C13.6171 7.04492 13.965 6.20498 13.965 5.32918C13.965 4.45337 13.6171 3.61344 12.9978 2.99415C12.3786 2.37487 11.5386 2.02695 10.6628 2.02695C9.78701 2.02695 8.94707 2.37487 8.32779 2.99415L4.03281 7.28913V10.9762L5.49714 9.51187C5.50205 9.50681 5.50703 9.50183 5.51208 9.49692L10.1712 4.83784C10.4445 4.56447 10.8878 4.56447 11.1611 4.83784C11.4345 5.1112 11.4345 5.55442 11.1611 5.82779L7.68959 9.29932H11.3676ZM6.28959 10.6993H9.9717L8.70892 11.9658H5.02306L6.28959 10.6993Z" fill="inherit"/>
											</svg>
										</span>
										<?php esc_html_e('Edit', kt_textdomain); ?>
									</a>
									<!-- END Edit button -->

								</div>


							</td>


							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
								<div class="action-remove">
									<?php
									echo apply_filters(
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg width="14" height="16" viewBox="0 0 14 16" fill="#A5A3B8" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.54052 1.59434C5.47795 1.59434 5.41838 1.61913 5.37478 1.6626C5.33125 1.706 5.30718 1.7644 5.30718 1.82486V2.99784H8.69351V1.82486C8.69351 1.79489 8.68759 1.76515 8.67603 1.73733C8.66448 1.70951 8.64748 1.6841 8.62591 1.6626C8.60434 1.64109 8.57862 1.62392 8.55016 1.61217C8.52169 1.60041 8.49111 1.59434 8.46018 1.59434H5.54052ZM10.0935 2.99784V1.82486C10.0935 1.61044 10.0511 1.39817 9.96889 1.2002C9.88664 1.00222 9.76614 0.822475 9.61437 0.671161C9.46261 0.519853 9.28255 0.399941 9.08454 0.318168C8.88653 0.236396 8.67438 0.194336 8.46018 0.194336H5.54052C5.10801 0.194336 4.69279 0.365613 4.38632 0.671161C4.07978 0.976781 3.90718 1.39174 3.90718 1.82486V2.99784H2.10123C2.09713 2.99781 2.09301 2.99781 2.0889 2.99784H0.778125C0.391526 2.99784 0.078125 3.31125 0.078125 3.69784C0.078125 4.08444 0.391526 4.39784 0.778125 4.39784H1.43976L2.08897 14.0733C2.10327 14.5562 2.30203 15.0153 2.64439 15.3567C2.99103 15.7023 3.45796 15.9003 3.94721 15.91L10.0397 15.9101L10.0535 15.91C10.5427 15.9003 11.0097 15.7023 11.3563 15.3567C11.6987 15.0153 11.8974 14.5562 11.9117 14.0733L12.5609 4.39784H13.2226C13.6092 4.39784 13.9226 4.08444 13.9226 3.69784C13.9226 3.31125 13.6092 2.99784 13.2226 2.99784H11.9118C11.9077 2.99781 11.9036 2.99781 11.8995 2.99784H10.0935ZM11.1578 4.39784H2.84291L3.48681 13.9941C3.48755 14.0051 3.48802 14.0161 3.48824 14.0271C3.49076 14.1538 3.54235 14.275 3.63285 14.3652C3.72214 14.4542 3.8425 14.5062 3.96943 14.5101H10.0313C10.1582 14.5062 10.2786 14.4542 10.3678 14.3652C10.4583 14.275 10.5099 14.1538 10.5125 14.0271C10.5127 14.0161 10.5131 14.0051 10.5139 13.9941L11.1578 4.39784Z" fill="inherit"/>
</svg>
</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'woocommerce' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
									?>
								</div>
								<!-- Amount -->
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal(
									$_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
								<!-- END Amount -->
							</td>
						</tr>
						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<tr>
					<td colspan="6" class="actions">

						<?php if ( wc_coupons_enabled() ) { ?>
							<div class="coupon">
								<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						<?php } ?>

						<button type="submit" class="woo-btn woo-btn__update" name="update_cart"
						        value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
							<?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
						</button>

						<?php do_action( 'woocommerce_cart_actions' ); ?>

						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>

			</tbody>
		</table>

		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>

	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

	<div class="cart-collaterals">
		<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
		?>
	</div>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
