<?php
/**
 * First Screen of Front Page
 * */
$title = get_field('step_01_title');
$title_sub = get_field('step_01_title_sub');
$front_slogan_desc = get_field('front_slogan_desc');

$args = array(
	'taxonomy'     => 'product_cat',
	'hide_empty'   => false,
);
$categories = get_categories( $args );

?>
<section class="kt-section kt-section__choose-product">

	<div class="main-container">
		<div class="titles-wrapper">
			<p class="kt-section__sup-title"><?php echo __('Step 1', kt_textdomain); ?></p>
			<?php echo $title ? '<h2 class="kt-section__title">'.$title.'</h2>' : ''; ?>
			<?php echo $title_sub ? '<p class="kt-section__sub-title">'.$title_sub.'</p>' : ''; ?>
		</div>

		<?php if( $categories ) : ?>

			<div class="kt-front-cat-gallery">
				<div class="cat-gallery-wrapper">
					<div class="cat-gallery-slider">
						<?php
						$total = count($categories);
						$key_array = (array) array_keys($categories);
						$last_key = end($key_array);
						// Sorts an array by keys in reverse order
						krsort($categories);
						foreach ( $categories as $key => $category ) :
							$cat_id = $category->term_id;
							$cat_slug = $category->slug;
							$cat_name = $category->name;
							$cat_additional_img = get_field('product_cat_addit_image', 'term_'.$cat_id);
							?>
							<div class="gallery-item <?php
								echo 'category-'.$cat_id;
								echo $key == 0 ? ' last-slide' : '';
								?>"
							     data-slide_counter="<?php echo $key+1; ?>"
							    data-cat_id="<?php echo $cat_id; ?>"
							    data-slug="<?php echo $cat_slug; ?>">
								<img src="<?php echo $cat_additional_img; ?>"
								     alt="<?php echo $cat_name; ?>"
								     loading="lazy">
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="cat-gallery-controls">

					<div class="controls-item current-slides-number">
						<span class="current">1</span>
						<span class="total"><?php echo $total; ?></span>
					</div>

				</div>
			</div>

			<ul class="kt-front-cat-list">
				<?php foreach ( $categories as $category ) :
					$cat_id = $category->term_id;
					$cat_slug = $category->slug;
					$cat_name = $category->name;
					?>
					<li class="list-item <?php echo 'category-'.$cat_id; ?>"
					    data-cat_id="<?php echo $cat_id; ?>"
					    data-slug="<?php echo $cat_slug; ?>">
						<?php echo $cat_name; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"
		   class="kt-btn kt-btn--default kt-product-to-customize">
			<?php echo __('Start', kt_textdomain); ?>
			<span class="load-icon"></span>
		</a>
	</div>

	<!-- START Animation -->
	<?php get_template_part( 'template-parts/svg-parts/stars', 'animation_small' ); ?>
	<!-- END Animation -->

</section>
