<?php
/**
 * Thankyou page for default Payment Method
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="woocommerce-order woo-invoice__container thankyou-other">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>
		<img src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/icons/no-orders.svg'; ?>"
		     class="thankyou-image" alt="Thankyou" loading="lazy" />

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay woo-btn
					woo-btn__pay">
					<?php esc_html_e( 'Pay', 'woocommerce' ); ?>
				</a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay woo-btn
					woo-btn__pay">
						<?php esc_html_e( 'My account', 'woocommerce' ); ?>
					</a>
				<?php endif; ?>
			</p>

		<?php else : ?>
		<img src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/icons/order.svg'; ?>"
		     class="thankyou-image" alt="Thankyou" loading="lazy" />
			<h2 class="thankyou-title">
				<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thanks you for your order!', kt_textdomain ), $order ); ?>
			</h2>

		<?php endif; ?>

	  <p class="thankyou-message">
		  <?php echo __('Your order <span>#'.$order->get_id().'</span> has been placed and being processed.<br />
You will receive an email with order details', kt_textdomain); ?>
	  </p>
		<a class="kt-btn kt-btn--default thankyou-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e('Back to Homepage', kt_textdomain); ?>
		</a>

	<?php endif; ?>

</div>
