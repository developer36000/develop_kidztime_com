<?php
global $product;
?>

<div class="cta-modal-window">
	<div id="cta_overlay"></div>
	<div id="cta_modal_edit_product_title" class="cta_modal ktwoo_modal ktwoo_modal--edit ktwoo_modal--small">
		<div class="cta-close"></div>
		<h3 class="modal_title">
			<?php esc_html_e('You can change the name of your product', kt_textdomain); ?>
		</h3>
		<div class="modal-entry">
			<form action="<?php echo $product->get_permalink(); ?>" data-action="kt_edit_product_title"
			      data-product_id="<?php echo $product->get_id(); ?>"
			      method="post" class="ktwoo_single_form">
				<div class="form-row">
					<input type="text" name="edit_product_title" id="edit_product_title" value="<?php the_title(); ?>" />
				</div>
				 <div class="form-button">
					 <button type="reset" class="woo-btn woo-btn__cancel-action"
					         value="<?php esc_html_e('Cancel', kt_textdomain); ?>">
						 <?php esc_html_e('Cancel', kt_textdomain); ?></button>
					 <button type="submit" class="kt-btn spinner-btn kt-btn--default"
					         value="<?php esc_html_e('Apply', kt_textdomain); ?>">
						 <?php esc_html_e('Apply', kt_textdomain); ?>
						 <span class="load-icon"></span>
					 </button>
				 </div>
			</form>
		</div>
		<span class="modal_notification hide"></span>
	</div>
</div>
