<?php // $current_user->display_name ?>
<div class="woo-account__logout woo-account__section">
	<h2 class="account-title"><?php echo __('Logout Account', kt_textdomain); ?></h2>
	<a class="btn woo-btn woo-btn__logout" href="<?php echo esc_url( wc_logout_url() ); ?>">
		<?php echo __('Log Out', kt_textdomain); ?>
	</a>
</div>

