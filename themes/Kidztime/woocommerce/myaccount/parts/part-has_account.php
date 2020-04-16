<?php if( isset( $_GET['action']) && $_GET['action'] == "register"): ?>
	<div class="has-account">
		<p class="has-account__message"><?php echo __('Already have an account?', kt_textdomain); ?></p>
		<a class="has-account__link link-register" href="?action=login">Log In</a>
	</div>
<?php  else: ?>
	<div class="has-account">
		<p class="has-account__message"><?php echo __('Don’t have an account?', kt_textdomain); ?></p>
		<a class="has-account__link link-register" href="?action=register">Register</a>
	</div>
<?php endif; ?>
