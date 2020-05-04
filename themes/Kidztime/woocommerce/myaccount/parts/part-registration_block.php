<div class="woo-register__container">
	<header>
		<h1 class="entry-title"><?php _e( 'Register', 'woocommerce' ); ?></h1>
	</header>

	<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

	<form method="post" class="woo-kt_form register">

		<?php do_action( 'woocommerce_register_form_start' ); ?>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__username form-row-wide">
				<label for="reg_username"><?php _e( 'Your name', kt_textdomain ); ?> <span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username"
				       placeholder="<?php _e( 'Your name', kt_textdomain ); ?>"
				       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
			</p>

		<?php endif; ?>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__email form-row-wide">
			<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email"
			       placeholder="<?php _e( 'Email address', 'woocommerce' ); ?>"
			       value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
		</p>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__password form-row-wide">
				<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
				       placeholder="<?php _e( 'Password', 'woocommerce' ); ?>" name="password" id="reg_password" />
			</p>
			<p class="form-row form-row-wide form-row__confirm_password">
				<label for="confirm_password"><?php _e( 'Confirm password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="confirm_password"
				       placeholder="<?php _e( 'Confirm password', 'woocommerce' ); ?>" id="confirm_password"
				       value="<?php if ( ! empty( $_POST['confirm_password'] ) ) echo esc_attr( $_POST['confirm_password'] ); ?>" />
			</p>
			<?php do_action( 'woocommerce_register_form_password_confirmation' ); ?>
		<?php endif; ?>

		<!-- Spam Trap -->
		<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

		<p class="woocomerce-FormRow form-row form-row__submit">
			<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
			<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
				<?php esc_attr_e( 'Register', 'woocommerce' ); ?>
			</button>
		</p>

		<div class="woo-kt_form__separate"><?php echo __('or', kt_textdomain); ?></div>

		<?php do_action( 'woocommerce_register_form' ); ?>

		<?php do_action( 'woocommerce_register_form_end' ); ?>

	</form>
</div>


