<?php
/**
 * Thankyou page for Invoice (Cash) Payment Method
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="woocommerce-order woo-invoice__container">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="btn pay woo-btn woo-btn__pay">
					<?php esc_html_e( 'Pay', 'woocommerce' ); ?>
				</a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="btn pay woo-btn woo-btn__default">
						<?php esc_html_e( 'My account', 'woocommerce' ); ?>
					</a>
				<?php endif; ?>
			</p>


		<?php else : ?>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
				<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thanks you for your order!', kt_textdomain ), $order ); ?>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>


	<?php endif; ?>

</div>
