<?php
/**
 * The default template for displaying page content
 */

$kt_page_title = get_field('kt_page_title');
?>

<div class="main-container">
	<header>
		<h1 class="entry-title"><?php echo $kt_page_title ? $kt_page_title : get_the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

	<?php if( have_rows( 'page_flexible_content' ) ): ?>
		<!--== Global Flexible Content -- START ==-->
		<?php while ( have_rows( 'page_flexible_content' ) ) : the_row(); ?>
			<?php get_template_part( 'template-parts/global', 'flexible_sections' ); ?>
		<?php endwhile; ?>
		<!--== Global Flexible Content -- END ==-->
	<?php endif; ?>

</div>


