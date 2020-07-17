<?php
/**
 * First Screen of Front Page
 * */
$sup_title = get_field('about_sup_title');
$title = get_field('about_title');
$about_content = get_field('about_content');
$show_second_column = get_field('show_second_column');
$about_second_content = get_field('about_second_content');


?>
<section id="about-us" class="kt-section kt-section__about-us">

	<div class="main-container">
		<div class="about-container">
			<div class="about-titles">
				<div class="titles">
					<?php echo $sup_title ? '<p class="kt-section__sup-title">'.$sup_title.'</p>' : ''; ?>
					<?php echo $title ? '<h2 class="kt-section__title">'.$title.'</h2>' : ''; ?>
				</div>
			</div>
			 <div class="about-content">
				 <?php echo $about_content ? '<div class="column column--1">'.$about_content.'</div>' : ''; ?>
				 <?php if( $show_second_column && $about_second_content ) : ?>
					 <?php echo '<div class="column column--2">'.$about_second_content.'</div>'; ?>
				 <?php endif; ?>
			 </div>

			<!-- Footer Rocket Animation -->
			<div class="about-rocket-animation">
				<?php get_template_part( 'template-parts/svg-parts/footer-rocket' ); ?>
			</div>
			<!-- END Footer Rocket Animation -->

		</div>

	</div>

</section>
