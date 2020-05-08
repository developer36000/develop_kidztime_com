<?php
/**
 * Output a Invoice (Cash) payment method
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<li class="woo-checkout__tabs--item wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?> top"
    data-tooltip data-click-open="false" tabindex="1" data-link="live"
		title="	<?php echo $gateway->get_title(); ?>">
	<span class="item-name">
		  	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio"
			         name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>"
			         data-order_button_text="<?php echo esc_attr($gateway->order_button_text ); ?>"
		<?php checked( $gateway->chosen ); ?> />
		<input type="hidden" name='cod_live_checkout'>
		<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
			<?php esc_html_e('Live Checkout'); ?>
		</label>
	</span>

</li>
