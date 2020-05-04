<?php
/**
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;

?>


<div class="woo-confirmation__container">

	<header>
		<h1 class="entry-title"><?php _e( 'Password Request', kt_textdomain ); ?></h1>
	</header>

	<?php do_action( 'woocommerce_before_lost_password_confirmation_message' ); ?>

	<div class="woo-confirmation__message">
		<p><?php echo esc_html( apply_filters( 'woocommerce_lost_password_confirmation_message', esc_html__( 'An email with password reset instruction has been sent to the email address you provided, it will arrive in less than a few minutes. Please remember to check your junk/spam folders.', kt_textdomain ) ) ); ?> </p>
	</div>

	<?php
	//wc_print_notice( esc_html__( 'Password reset email has been sent.', 'woocommerce' ) );
	do_action( 'woocommerce_after_lost_password_confirmation_message' );
	?>

	<!-- Confirmation Rocket Animation -->
	<div class="woo-confirmation-animation">
		<?php get_template_part( 'template-parts/svg-parts/confirmation-rocket' ); ?>
	</div>
	<!-- END Confirmation Rocket Animation -->

</div>



