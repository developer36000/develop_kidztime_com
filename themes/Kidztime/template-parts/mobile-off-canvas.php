<?php
/**
 * Template part for off canvas menu
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<nav class="mobile-off-canvas-menu off-canvas position-right" id="<?php foundationpress_mobile_menu_id(); ?>"
     data-off-canvas data-auto-focus="false" role="navigation">
	<i class="mobile-off-canvas-menu-close"></i>
	<?php foundationpress_mobile_nav(); ?>
	<?php dynamic_sidebar( 'header-widgets' ); ?>
	<span id="offcanvas-bottom-svg">
		<?php get_template_part( 'template-parts/svg-parts/offcanvas', 'planet_svg' ); ?>
	</span>
</nav>

<div class="off-canvas-content" data-off-canvas-content>
