<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

defined( 'ABSPATH' ) || exit;
global $woocommerce;
$user = $woocommerce->customer;
 ?>
<div class="woo-account__edit-account">

	<?php do_action( 'woocommerce_before_edit_account_form' ); ?>

	<!-- LOGOUT BLOCK -->
	<?php get_template_part( 'woocommerce/myaccount/parts/part', 'logout' ); ?>

	<!-- LOGOUT BLOCK END-->

	<!-- EDIT ACCOUNT BLOCK -->
	<form class="woocommerce-EditAccountForm edit-account woo-kt_form " action=""
	      method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

		<div class="woo-account__section ">

			<h2 class="account-title"><?php echo __('Account Information', kt_textdomain); ?></h2>

			<div class="form-row__half">
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__name form-row-wide">
					<label for="account_first_name">
						<?php esc_html_e( 'First name', 'woocommerce' ); ?><span class="required">*</span>
					</label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
					       name="account_first_name" id="account_first_name" autocomplete="given-name"
					       placeholder="<?php esc_html_e( 'First Name *', 'woocommerce' ); ?>"
					       value="<?php echo esc_attr( $user->first_name ); ?>" />
				</p>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__last form-row-wide">
					<label for="account_last_name">
						<?php esc_html_e( 'Last name', 'woocommerce' ); ?><span class="required">*</span>
					</label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
					       name="account_last_name" id="account_last_name" autocomplete="family-name"
					       placeholder="<?php esc_html_e( 'Last Name *', 'woocommerce' ); ?>"
					       value="<?php echo esc_attr( $user->last_name ); ?>" />
				</p>
			</div>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__display-name form-row-wide top"
			   data-tooltip data-click-open="false" tabindex="1"
			   title="<?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews.', 'woocommerce' ); ?>">
				<label for="account_display_name">
					<?php esc_html_e( 'Display name', 'woocommerce' ); ?><span class="required">*</span>
				</label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
				       name="account_display_name" id="account_display_name"
				       placeholder="<?php esc_html_e( 'Display Name *', 'woocommerce' ); ?>"
				       value="<?php echo esc_attr( $user->display_name ); ?>" />

			</p>


			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__email form-row-wide">
				<label for="account_email">
					<?php esc_html_e( 'Email address', 'woocommerce' ); ?><span class="required">*</span>
				</label>
				<input type="email" class="woocommerce-Input woocommerce-Input--email input-text"
				       name="account_email" id="account_email" autocomplete="email"
				       placeholder="<?php esc_html_e( 'Email address *', 'woocommerce' ); ?>"
				       value="<?php echo esc_attr( $user->email ); ?>" />
			</p>
		</div>

		<div class="woo-account__section">

			<h2 class="account-title"><?php esc_html_e( 'Password Change', 'woocommerce' ); ?></h2>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__password form-row-wide top"
			   data-tooltip data-click-open="false" tabindex="2"
			   title="<?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?>">
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
				       placeholder="<?php _e( 'Current Password', kt_textdomain ); ?>"
				       name="password_current" id="password_current" autocomplete="off" />
			</p>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__password form-row-wide">
				<label for="password_1">
					<?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?>
				</label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
				       placeholder="<?php _e( 'New Password', kt_textdomain ); ?>"
				       name="password_1" id="password_1" autocomplete="off" />
			</p>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row__confirm_password form-row-wide">
				<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
				       placeholder="<?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>"
				       name="password_2" id="password_2" autocomplete="off" />
			</p>

		</div>


		<?php do_action( 'woocommerce_edit_account_form' ); ?>

		<p class="woocommerce-form-row form-row form-row__submit">
			<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
			<button type="submit" class="woocommerce-Button button"
			        name="save_account_details" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>">
				<?php esc_html_e( 'Save', 'woocommerce' ); ?>
			</button>
			<input type="hidden" name="action" value="save_account_details" />
		</p>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</form>
	<!-- EDIT ACCOUNT BLOCK END-->

	<?php do_action( 'woocommerce_after_edit_account_form' ); ?>

</div>

