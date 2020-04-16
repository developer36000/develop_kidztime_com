<?php
/**
 * The default template for displaying page content
 */

$kt_page_title = get_field('kt_page_title');
$form_title = get_field('form_title');
$form_shortcode = get_field('form_shortcode');
$modal_title = get_field('title_for_success_modal');
$modal_description = get_field('desc_for_success_modal');
$image_for_modal = get_field('image_for_modal');
$image_for_modal_url = $image_for_modal?: kt_img_base_path.'icons/message-sent.svg';
?>

<div class="main-container">
	<header>
		<h1 class="entry-title"><?php echo $kt_page_title ? $kt_page_title : get_the_title(); ?></h1>
	</header>

  <?php if( get_the_content() ) : ?>
	  <div class="entry-content">
		  <?php the_content(); ?>
	  </div>
  <?php endif; ?>

	<div class="contact-container">
		<?php if( have_rows('contact_information') ): ?>
			<div class="contact_information">
				<?php $item_num = 0; while( have_rows('contact_information') ): the_row();
					$title = get_sub_field('info_title');
					$content = get_sub_field('info_text'); ?>
					<div class="information-row">
						<?php echo $title ? '<h4 class="information-row__title">'.$title.'</h4>' : ''; ?>
						<?php echo $content ? '<div class="information-row__content">'.$content.'</div>' : ''; ?>
					</div>
					<?php $item_num++; endwhile; ?>
			</div>
		<?php endif; ?>
		<div class="contact-form">
		    <h3 class="contact-form__title"><?php echo $form_title ?:''; ?></h3>
				<div class="contact-form__cf7">
					<?php echo do_shortcode( $form_shortcode ); ?>
				</div>
		</div>
	</div>


</div>

<div class="cta-modal-window">
	<div id="cta_overlay"></div>
	<div id="cta_modal_successfully" class="cta_modal">
		<div class="cta-close"></div>
		<?php echo $modal_title ? '<h3 class="modal_title">'.$modal_title.'</h3>' : ''; ?>
		<?php echo $modal_description ? '<span class="modal_notification">'.$modal_description.'</span>' : ''; ?>
		<div class="modal-entry">
			<img src="<?php echo $image_for_modal_url; ?>" loading="lazy" alt="Successfully">
		</div>
	</div>
</div>



