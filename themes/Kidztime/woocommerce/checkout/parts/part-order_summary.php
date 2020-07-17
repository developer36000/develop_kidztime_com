<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

	<div class="mobile-order-summary">
		<h4 class="mobile-order-summary--title">
			<?php esc_html_e('Show Order Summary', kt_textdomain); ?>
		</h4>
		<div class="mobile-order-summary--total">
			<?php wc_cart_totals_order_total_html(); ?>
		</div>
	</div>

	<h3 id="order_review_heading" class="checkout-title--small">
		<?php esc_html_e( 'Order Summary', kt_textdomain ); ?>
	</h3>

<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order woo-checkout__order-review">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
