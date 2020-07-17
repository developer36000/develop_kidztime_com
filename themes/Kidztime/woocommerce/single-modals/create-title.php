<?php
global $product;
$is_new_product = isset($_GET['new_product']) ? $_GET['new_product'] : '';

?>

<div class="cta-modal-window">
	<div id="cta_overlay"></div>
	<div id="cta_modal_create_product_title"
	     class=" cta_modal ktwoo_modal ktwoo_modal--create ktwoo_modal--small">
		<div class="cta-close"></div>
		<div class="modal_header">
			<h3 class="modal_title">
				<?php esc_html_e('Congratulations!', kt_textdomain); ?>
			</h3>
			<p class="modal modal_description">
				<?php esc_html_e('You have created your very own Out of This World Item!', kt_textdomain); ?>
			</p>
		</div>

		<div class="modal-entry">
			<form action="<?php echo $product->get_permalink(); ?>" data-action="kt_create_product_title"
			      data-product_id="<?php echo $product->get_id(); ?>"
			      method="post" class="ktwoo_single_form">
				<div class="form-row">
					<label for="create_product_title">
						<?php esc_html_e('Now it`s time to give it a name', kt_textdomain); ?>
					</label>
					<input type="text" name="create_product_title" id="create_product_title"
					       placeholder="Enter name"
					       value="" />
					<span class="error-label">This is required field.</span>
				</div>
				 <div class="form-button">
					 <button type="reset" class="woo-btn woo-btn__skip-action"
					         data-open_modal="cta_modal_close_product_go_back"
					         value="<?php esc_html_e('Skip', kt_textdomain); ?>">
						 <?php esc_html_e('Skip', kt_textdomain); ?></button>
					 <button type="submit" class="kt-btn spinner-btn kt-btn--default woo-btn__complete-action"
					         value="<?php esc_html_e('Complete', kt_textdomain); ?>">
						 <?php esc_html_e('Complete', kt_textdomain); ?>
						 <span class="load-icon"></span>
					 </button>
				 </div>
			</form>
		</div>
		<span class="modal_notification hide"></span>
	</div>
</div>
