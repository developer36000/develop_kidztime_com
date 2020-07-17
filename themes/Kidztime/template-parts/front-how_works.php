<?php
/**
 * First Screen of Front Page
 * */
$title = get_field('simple_title');
$title_sub = get_field('simple_title_sub');
$item_01_txt = get_field('front_item_01_desc');
$item_01_img = get_field('front_item_01_img');
$item_02_txt = get_field('front_item_02_desc');
$item_02_img = get_field('front_item_02_img');
$item_03_txt = get_field('front_item_03_desc');
$item_03_img = get_field('front_item_03_img');

?>
<section id="how-it-works" class="kt-section kt-section__how-works">

	<!-- START Animation -->
	<?php get_template_part( 'template-parts/svg-parts/orange-planet' ); ?>
	<!-- END Animation -->

	<div class="main-container">
		<p class="kt-section__sup-title"><?php echo __('Simple Step', kt_textdomain); ?></p>
		<?php echo $title ? '<h2 class="kt-section__title">'.$title.'</h2>' : ''; ?>
		<?php echo $title_sub ? '<p class="kt-section__sub-title">'.$title_sub.'</p>' : ''; ?>

		<div class="how-works-items">
			<div class="how-works-item how-works-item--01">
				<?php if( $item_01_img ) : ?>
					<img class="how-works-item__image" src="<?php echo $item_01_img; ?>"
					     alt="<?php echo $item_01_txt ?: get_bloginfo( 'name' ); ?>" loading="lazy">
				<?php else : ?>
					<img class="how-works-item__image"
					     src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/front/hiw_1.svg';	?>"
					     alt="<?php echo $item_01_txt ?: get_bloginfo( 'name' ); ?>" loading="lazy">
				<?php endif; ?>
				<?php echo $item_01_txt ? '<p class="how-works-item__description">'.$item_01_txt.'</p>' : ''; ?>
			</div>

			<div class="how-works-item how-works-item--02">
				<?php if( $item_02_img ) : ?>
					<img class="how-works-item__image" src="<?php echo $item_02_img; ?>"
					     alt="<?php echo $item_02_txt ?: get_bloginfo( 'name' ); ?>" loading="lazy">
				<?php else : ?>
					<img class="how-works-item__image"
					     src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/front/hiw_2.svg';	?>"
					     alt="<?php echo $item_02_txt ?: get_bloginfo( 'name' ); ?>" loading="lazy">
				<?php endif; ?>
				<?php echo $item_02_txt ? '<p class="how-works-item__description">'.$item_02_txt.'</p>' : ''; ?>
			</div>

			<div class="how-works-item how-works-item--03">
				<?php if( $item_03_img ) : ?>
					<img class="how-works-item__image" src="<?php echo $item_03_img; ?>"
					     alt="<?php echo $item_03_txt ?: get_bloginfo( 'name' ); ?>" loading="lazy">
				<?php else : ?>
					<img class="how-works-item__image"
					     src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/front/hiw_3.svg';	?>"
					     alt="<?php echo $item_03_txt ?: get_bloginfo( 'name' ); ?>" loading="lazy">
				<?php endif; ?>
				<?php echo $item_03_txt ? '<p class="how-works-item__description">'.$item_03_txt.'</p>' : ''; ?>
			</div>
		</div>

	</div>

	<!-- START Animation -->
	<?php get_template_part( 'template-parts/svg-parts/stars', 'animation_small' ); ?>
	<!-- END Animation -->

</section>
