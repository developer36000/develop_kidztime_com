<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="woo-password-request__container">

	<header>
		<h1 class="entry-title"><?php _e( 'Password Request', kt_textdomain ); ?></h1>
	</header>

	<?php wc_print_notices(); ?>

	<form method="post" class="woo-kt_form woocommerce-ResetPassword lost_reset_password">

		<p class="woo-password-request__message">
			<?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Please enter your email address. <br /> You will receive a link to create a new password via email.', kt_textdomain ) ); ?>
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first form-row__email">
			<label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
			<input class="woocommerce-Input woocommerce-Input--text input-text"
			       placeholder="<?php esc_html_e( 'Email address', kt_textdomain ); ?>"
			       type="text" name="user_login" id="user_login" autocomplete="username" />
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_lostpassword_form' ); ?>

		<p class="woocommerce-form-row form-row form-row__submit">
			<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="woocommerce-Button button"
			        value="<?php esc_attr_e( 'Request', kt_textdomain ); ?>">
				<?php esc_html_e( 'Request', kt_textdomain ); ?>
			</button>

		</p>

		<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

	</form>

	<a class="woo-btn woo-btn__back" href="/my-account/?action=login">	<?php esc_html_e( 'Back', kt_textdomain ); ?></a>

	<?php do_action( 'woocommerce_after_lost_password_form' ); ?>

</div>
