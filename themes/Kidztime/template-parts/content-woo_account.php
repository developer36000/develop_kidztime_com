<?php
/**
 * The default template for displaying woocommerce pages, My Account and Login/Register
 */

?>

<?php if( is_user_logged_in() ) : ?>

	<div class="main-container">
		<?php wc_get_template( 'myaccount/my-account.php' ); ?>
	</div>

<?php else : ?>

	<div class="main-container">
		<?php the_content(); ?>
		<?php //wc_get_template( 'myaccount/form-login.php' ); ?>
	</div>

	<!-- START Animation -->
	<?php get_template_part( 'template-parts/svg-parts/login-animation' ); ?>
	<!-- END Animation -->

<?php endif; ?>





