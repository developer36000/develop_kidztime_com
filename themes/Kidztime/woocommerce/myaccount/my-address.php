<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Shipping Address', 'woocommerce' ), // Billing address
			'shipping' => __( 'Shipping Address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Shipping Address', 'woocommerce' ), // Billing address
		),
		$customer_id
	);
}

?>
<!-- EDIT SHIPPING BLOCK -->
<div class="woo-account__edit-address">

	<?php

	foreach ( $get_addresses as $name => $address_title ) :
		$address = wc_get_account_formatted_address( $name );
	  $phone_email = wc_get_account_mail_phone( $name );
		$phone = $phone_email['phone'];
	  $email = $phone_email['email'];
		?>

		<div class="woocommerce-Address woo-account__address">
			<h3 class="account-title__sub"><?php echo esc_html( $address_title ); ?></h3>

			<?php if( $address ) : ?>
				<address class="top" data-tooltip data-click-open="false" tabindex="1"
				         title="<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) );  ?>">
					<?php echo wp_kses_post( $address ); ?>

					<?php if ( $phone ) : ?>
						<p class="woo-account__address--phone">
							<?php echo $phone; ?></p>
					<?php endif; ?>

					<?php if ( $email ) : ?>
						<p class="woo-account__address--email">
							<?php echo $email; ?></p>
					<?php endif; ?>

				</address>
			<?php else : ?>
				<img src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/icons/no-orders.svg'; ?>"
				     class="simple-msg__img" alt="Address" loading="lazy" />
				<p class="simple-msg"><?php echo esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' ); ?></p>
			<?php endif; ?>


			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>"
			   class="edit woo-btn woo-btn__<?php echo $address?'address-edit':'add'; ?>">
				<?php echo $address ? esc_html__( 'Edit Address', 'woocommerce' ) : esc_html__( 'Add Address', 'woocommerce' )
				; ?>
			</a>
		</div>

	<?php endforeach; ?>


</div>
<!-- END EDIT SHIPPING BLOCK -->
