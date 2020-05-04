<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_reset_password_form' );
?>
<div class="woo-reset_password__container">

	<header>
		<h1 class="entry-title"><?php _e( 'Create a New Password', kt_textdomain ); ?></h1>
	</header>

	<form method="post" class="woo-kt_form woocommerce-ResetPassword lost_reset_password">

		<p class="woo-reset_password__message"><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'woocommerce' ) ); ?></p>

		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row__password form-row-first">
			<label for="password_1"><?php esc_html_e( 'New password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
			       placeholder="<?php esc_html_e( 'New password', 'woocommerce' ); ?>"
			       name="password_1" id="password_1" autocomplete="new-password" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row__confirm_password form-row-last">
			<label for="password_2"><?php esc_html_e( 'Confirm password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
			       placeholder="<?php esc_html_e( 'Confirm password', 'woocommerce' ); ?>"
			       name="password_2" id="password_2" autocomplete="new-password" />
		</p>

		<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
		<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

		<div class="clear"></div>

		<?php do_action( 'woocommerce_resetpassword_form' ); ?>

		<p class="woocommerce-form-row form-row form-row__submit">
			<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>
		</p>

		<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>

	</form>
	<?php do_action( 'woocommerce_after_reset_password_form' ); ?>

</div>

