<?php
global $product;
?>

<div class="cta-modal-window">
	<div id="cta_overlay"></div>
	<div id="cta_modal_close_product_go_back" class="cta_modal ktwoo_modal ktwoo_modal--go_back ktwoo_modal--small">
		<div class="cta-close"></div>
		<h3 class="modal_title">
			<?php esc_html_e('Are you sure you want to go back?', kt_textdomain); ?>
		</h3>
		<p class="notification">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M7.00178 1.49296C7.3063 1.32151 7.64987 1.23145 7.99933 1.23145C8.3488 1.23145 8.69236 1.32151 8.99688 1.49296C9.3014 1.66441 9.55659 1.91144 9.73783 2.21024L9.73985 2.21356L15.3923 11.6499C15.5698 11.9573 15.6637 12.306 15.6647 12.661C15.6657 13.016 15.5737 13.3651 15.3979 13.6736C15.222 13.9821 14.9685 14.2391 14.6625 14.4191C14.3565 14.5992 14.0087 14.696 13.6537 14.6999L13.646 14.7L2.34497 14.6999C1.98995 14.696 1.64214 14.5992 1.33614 14.4191C1.03014 14.2391 0.776622 13.9821 0.600804 13.6736C0.424986 13.3651 0.332998 13.016 0.333992 12.661C0.334986 12.306 0.428928 11.9574 0.60647 11.6499L0.612079 11.6402L6.25882 2.21356L6.85934 2.57328L6.26083 2.21024C6.44207 1.91144 6.69726 1.66441 7.00178 1.49296ZM7.45865 2.93497L7.45783 2.93631L1.81658 12.354C1.76275 12.4487 1.73429 12.5559 1.73399 12.6649C1.73368 12.7755 1.76233 12.8842 1.81709 12.9803C1.87186 13.0764 1.95082 13.1565 2.04613 13.2125C2.14053 13.2681 2.2477 13.2982 2.35718 13.2999H13.6415C13.751 13.2982 13.8581 13.2681 13.9525 13.2125C14.0478 13.1565 14.1268 13.0764 14.1816 12.9803C14.2363 12.8842 14.265 12.7755 14.2647 12.6649C14.2644 12.5559 14.2359 12.4488 14.1821 12.354L8.54083 2.93631L8.53999 2.93493C8.48359 2.84248 8.40442 2.76604 8.31004 2.7129C8.21519 2.6595 8.10818 2.63145 7.99933 2.63145C7.89048 2.63145 7.78347 2.6595 7.68862 2.7129C7.59423 2.76605 7.51505 2.84251 7.45865 2.93497ZM7.99932 5.30005C8.38592 5.30005 8.69932 5.61345 8.69932 6.00005V8.66672C8.69932 9.05332 8.38592 9.36672 7.99932 9.36672C7.61272 9.36672 7.29932 9.05332 7.29932 8.66672V6.00005C7.29932 5.61345 7.61272 5.30005 7.99932 5.30005ZM7.99932 10.6333C7.61272 10.6333 7.29932 10.9467 7.29932 11.3333C7.29932 11.7199 7.61272 12.0333 7.99932 12.0333H8.00765C8.39425 12.0333 8.70765 11.7199 8.70765 11.3333C8.70765 10.9467 8.39425 10.6333 8.00765 10.6333H7.99932Z" fill="#FF7071"/>
			</svg>

			<?php esc_html_e('Changes you made may not be saved', kt_textdomain); ?>
		</p>
		<div class="modal-entry">
			<form action="<?php echo $product->get_permalink(); ?>" data-action="kt_close_product_go_back"
			      data-product_id="<?php echo $product->get_id(); ?>"
			      method="post" class="ktwoo_single_form">
				 <div class="form-button">
					 <button type="reset" class="kt-btn kt-btn--default woo-btn__stay-action"
					         value="<?php esc_html_e('No, stay here', kt_textdomain); ?>">
						 <?php esc_html_e('No, stay here', kt_textdomain); ?></button>
					 <button type="submit" class="woo-btn spinner-btn woo-btn__go-back-action"
					         value="<?php esc_html_e('Yes, go back', kt_textdomain); ?>">
						 <?php esc_html_e('Yes, go back', kt_textdomain); ?>
						 <span class="load-icon"></span>
					 </button>

				 </div>
			</form>
		</div>
		<span class="modal_notification hide"></span>
	</div>
</div>
