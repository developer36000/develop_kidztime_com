<?php
/**
* First Screen of Front Page
* */
$front_logo = get_field('front_logo');
$slogan = get_field('front_slogan');
$front_slogan_desc = get_field('front_slogan_desc');

?>
<section class="kt-section kt-section__first">
	<div class="main-container">
		<?php if( $front_logo ) : ?>
			<img class="slogan-image" src="<?php echo $front_logo; ?>"
			     alt="<?php echo $slogan ?: get_bloginfo( 'name' ); ?>" loading="lazy">
		<?php else : ?>
			<img class="slogan-image"
			     src="<?php echo get_stylesheet_directory_uri() . '/dist/assets/images/front/logo-vertical.svg'; ?>"
			     alt="<?php echo $slogan ?: get_bloginfo( 'name' ); ?>" loading="lazy">
		<?php endif; ?>

		<?php echo $slogan ? '<h1 class="main-slogan">'.$slogan.'</h1>' : ''; ?>
		<?php echo $front_slogan_desc ? '<div class="main-slogan-desc">'.$front_slogan_desc.'</div>' : ''; ?>

		<a href="#how-it-works" class="kt_scroll_down">
			<span class="scroll_down_label"><?php esc_html_e('Scroll Down To Begin', kt_textdomain); ?></span>
			<span class="scroll_down_icon">
					<svg width="21" height="34" viewBox="0 0 21 34" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g opacity="0.2">
					<g clip-path="url(#clip0)">
						<path class="arrow01" fill-rule="evenodd" clip-rule="evenodd" d="M18.4142 22.5858C19.1953 23.3668 19.1953 24.6332 18.4142 25.4142L11.4142 32.4142C10.6332 33.1953 9.36683 33.1953 8.58579 32.4142L1.58579 25.4142C0.804737 24.6332 0.804737 23.3668 1.58579 22.5858C2.36683 21.8047 3.63317 21.8047 4.41421 22.5858L10 28.1716L15.5858 22.5858C16.3668 21.8047 17.6332 21.8047 18.4142 22.5858Z" fill="white"/>
					</g>
				</g>
				<g opacity="0.2">
					<g clip-path="url(#clip1)">
						<path class="arrow02" fill-rule="evenodd" clip-rule="evenodd" d="M19.4142 1.58579C20.1953 2.36684 20.1953 3.63317 19.4142 4.41421L12.4142 11.4142C11.6332 12.1953 10.3668 12.1953 9.58579 11.4142L2.58579 4.41421C1.80474 3.63316 1.80474 2.36683 2.58579 1.58579C3.36683 0.804737 4.63317 0.804737 5.41421 1.58579L11 7.17157L16.5858 1.58579C17.3668 0.804738 18.6332 0.804738 19.4142 1.58579Z" fill="white"/>
					</g>
				</g>
				<defs>
					<clipPath id="clip0">
						<path d="M20 21L20 34L-5.68248e-07 34L0 21L20 21Z" fill="white"/>
					</clipPath>
					<clipPath id="clip1">
						<path d="M21 0L21 13L0.999999 13L1 -8.74228e-07L21 0Z" fill="white"/>
					</clipPath>
				</defs>
			</svg>
			</span>

		</a>



	</div>

	<!-- START Animation -->
	<span id="kt-fornt-bottom-svg">
		<?php get_template_part( 'template-parts/svg-parts/offcanvas', 'planet_svg' ); ?>
	</span>
	<?php get_template_part( 'template-parts/svg-parts/comet-animation' ); ?>
	<?php //get_template_part( 'template-parts/svg-parts/stars', 'animation_small' ); ?>
	<!-- END Animation -->
</section>
