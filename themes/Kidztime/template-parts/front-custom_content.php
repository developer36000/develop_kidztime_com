<?php
/**
 * Custom Content section of Front Page
 * */
$custom_title = get_field('custom_title');
$title_sup = get_field('custom_content_sup_title');
$title = get_field('custom_content_title');
$title_sub = get_field('custom_content_sub_title');
$show_brn = get_field('show_section_button_get_in_touch');
$custom_brn = get_field('custom_btn');
$custom_image_1 = get_field('custom_image_1');
$custom_image_2 = get_field('custom_image_2');
$custom_content = get_field('custom_content');


?>
<section id="custom-content" class="kt-section kt-section__custom-content">

	<!-- START Animation -->
	<?php get_template_part( 'template-parts/svg-parts/clouds' ); ?>
	<!-- END Animation -->

	<div class="main-container">
		<?php echo $custom_title ? '<p class="kt-section__custom-title">'.$custom_title.'</p>' : ''; ?>
		 <div class="custom-center-rocket-wrap">
			 <?php get_template_part( 'template-parts/svg-parts/side-rocket' ); ?>
		 </div>
		<?php if( $custom_image_1 || $custom_image_2 ) : ?>
		  <div class="custom-images">
			  <?php if( $custom_image_1 ) : ?>
				  <div class="column column--1">
					  <img src="<?php echo $custom_image_1; ?>"
					       alt="<?php echo $custom_title?:'Custom images'; ?>" loading="lazy" />
				  </div>
			  <?php endif; ?>
			  <?php if( $custom_image_2 ) : ?>
				  <div class="column column--2">
					  <img src="<?php echo $custom_image_2; ?>"
					       alt="<?php echo $custom_title?:'Custom images'; ?>" loading="lazy" />
				  </div>
			  <?php endif; ?>
		  </div>
		<?php endif; ?>

		<?php echo $title_sup ? '	<p class="kt-section__sup-title">'.$title_sup.'</p>' : ''; ?>
		<?php echo $title ? '<h2 class="kt-section__title">'.$title.'</h2>' : ''; ?>
		<?php echo $title_sub ? '<p class="kt-section__sub-title">'.$title_sub.'</p>' : ''; ?>

		<?php echo $custom_content ? '<div class="custom-content">'.$custom_content.'</div>' : ''; ?>

		<?php if( $show_brn && $custom_brn ) : ?>
			<a href="<?php echo $custom_brn['url'] ? $custom_brn['url'] : "#"; ?>"
			   class="kt-btn kt-btn--default"
			   title="<?php echo	$custom_brn['title']; ?>"
			target="<?php echo $custom_brn['target']; ?>">
				<?php echo $custom_brn['title'] ? $custom_brn['title'] : 'Get in Touch'; ?>
			</a>
		<?php endif; ?>

	</div>

	<!-- Side Rocket Animation -->
	<div class="custom-rocket-animation">
		<?php get_template_part( 'template-parts/svg-parts/side-rocket' ); ?>
	</div>
	<!-- END Side Rocket Animation -->

	<!-- START Animation -->
	<?php get_template_part( 'template-parts/svg-parts/stars', 'animation_small' ); ?>
	<!-- END Animation -->

</section>
