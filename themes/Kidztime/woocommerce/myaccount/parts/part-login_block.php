<div class="woo-login__container">
	<header>
		<h1 class="entry-title"><?php _e( 'Login', 'woocommerce' ); ?></h1>
	</header>

	<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

	<form class="woo-kt_form woocomerce-form woocommerce-form-login login" method="post">

		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__email form-row-wide">
			<label for="username"><?php _e( 'Email address', kt_textdomain ); ?> <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
			       placeholder="<?php _e( 'Email address', kt_textdomain ); ?>" name= "username" id="username"
			       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__password form-row-wide">
			<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
			       placeholder="<?php _e( 'Password', 'woocommerce' ); ?>" name="password" id="password" />
		</p>

		<p class="woocommerce-LostPassword lost_password form-row form-row__lost_password">
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Forgot Password?', 'woocommerce' ); ?></a>
		</p>

		<p class="woocommerce-form-row form-row form-row__submit">
			<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
			<button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>">
				<?php esc_attr_e( 'Login', 'woocommerce' ); ?>
			</button>
		</p>

		<p class="form-row form-row__checkbox form-row__rememberme">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
				<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
				<span class="label-name"><?php _e( 'Remember me', 'woocommerce' ); ?></span>
			</label>
		</p>

		<div class="woo-kt_form__separate"><?php echo __('or', kt_textdomain); ?></div>
		<?php do_action( 'woocommerce_login_form' ); ?>

		<?php do_action( 'woocommerce_login_form_end' ); ?>

	</form>
</div>

