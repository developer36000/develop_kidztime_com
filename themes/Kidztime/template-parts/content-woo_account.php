<?php
/**
 * The default template for displaying woocommerce page My Account/Login/Register
 */

?>



<div class="main-container">

	<?php if( is_user_logged_in() ) : ?>
		<?php woocommerce_get_template( 'myaccount/my-account.php' ); ?>
	<?php else : ?>
		<?php woocommerce_get_template( 'myaccount/form-login.php' ); ?>
	<?php endif; ?>

</div>


