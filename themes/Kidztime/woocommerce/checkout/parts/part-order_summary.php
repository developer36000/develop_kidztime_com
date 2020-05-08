<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

	<h3 id="order_review_heading" class="checkout-title--small">
		<?php esc_html_e( 'Order Summary', kt_textdomain ); ?>
	</h3>

<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
