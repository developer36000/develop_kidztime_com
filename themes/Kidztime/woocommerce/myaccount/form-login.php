<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>


<?php if( isset( $_GET['action']) && $_GET['action'] == "register"): ?>

	<!--REGISTRATION BLOCK -->
	<?php get_template_part( 'woocommerce/myaccount/parts/part', 'registration_block' ); ?>
	<!--REGISTRATION BLOCK END-->

<?php  else: ?>

	<!--LOGIN BLOCK START -->
	<?php get_template_part( 'woocommerce/myaccount/parts/part', 'login_block' ); ?>
	<!--LOGIN BLOCK END -->


<?php endif; ?>

<!-- HAS ACCOUNT BLOCK -->
<?php get_template_part( 'woocommerce/myaccount/parts/part', 'has_account' ); ?>
<!-- HAS ACCOUNT BLOCK END-->


<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
