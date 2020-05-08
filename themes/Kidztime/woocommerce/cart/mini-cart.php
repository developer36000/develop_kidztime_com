<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
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

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
					<?php
					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><svg width="14" height="16" viewBox="0 0 14 16" fill="#A5A3B8" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.54052 1.59434C5.47795 1.59434 5.41838 1.61913 5.37478 1.6626C5.33125 1.706 5.30718 1.7644 5.30718 1.82486V2.99784H8.69351V1.82486C8.69351 1.79489 8.68759 1.76515 8.67603 1.73733C8.66448 1.70951 8.64748 1.6841 8.62591 1.6626C8.60434 1.64109 8.57862 1.62392 8.55016 1.61217C8.52169 1.60041 8.49111 1.59434 8.46018 1.59434H5.54052ZM10.0935 2.99784V1.82486C10.0935 1.61044 10.0511 1.39817 9.96889 1.2002C9.88664 1.00222 9.76614 0.822475 9.61437 0.671161C9.46261 0.519853 9.28255 0.399941 9.08454 0.318168C8.88653 0.236396 8.67438 0.194336 8.46018 0.194336H5.54052C5.10801 0.194336 4.69279 0.365613 4.38632 0.671161C4.07978 0.976781 3.90718 1.39174 3.90718 1.82486V2.99784H2.10123C2.09713 2.99781 2.09301 2.99781 2.0889 2.99784H0.778125C0.391526 2.99784 0.078125 3.31125 0.078125 3.69784C0.078125 4.08444 0.391526 4.39784 0.778125 4.39784H1.43976L2.08897 14.0733C2.10327 14.5562 2.30203 15.0153 2.64439 15.3567C2.99103 15.7023 3.45796 15.9003 3.94721 15.91L10.0397 15.9101L10.0535 15.91C10.5427 15.9003 11.0097 15.7023 11.3563 15.3567C11.6987 15.0153 11.8974 14.5562 11.9117 14.0733L12.5609 4.39784H13.2226C13.6092 4.39784 13.9226 4.08444 13.9226 3.69784C13.9226 3.31125 13.6092 2.99784 13.2226 2.99784H11.9118C11.9077 2.99781 11.9036 2.99781 11.8995 2.99784H10.0935ZM11.1578 4.39784H2.84291L3.48681 13.9941C3.48755 14.0051 3.48802 14.0161 3.48824 14.0271C3.49076 14.1538 3.54235 14.275 3.63285 14.3652C3.72214 14.4542 3.8425 14.5062 3.96943 14.5101H10.0313C10.1582 14.5062 10.2786 14.4542 10.3678 14.3652C10.4583 14.275 10.5099 14.1538 10.5125 14.0271C10.5127 14.0161 10.5131 14.0051 10.5139 13.9941L11.1578 4.39784Z" fill="inherit"/>
</svg></a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							esc_attr__( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						),
						$cart_item_key
					);
					?>
					<?php if ( empty( $product_permalink ) ) : ?>
						<?php echo $thumbnail . $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php else : ?>
						<a href="<?php echo esc_url( $product_permalink ); ?>">
							<?php echo $thumbnail . $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
					<?php endif; ?>
					<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<p class="woocommerce-mini-cart__total total">
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		do_action( 'woocommerce_widget_shopping_cart_total' );
		?>
	</p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
