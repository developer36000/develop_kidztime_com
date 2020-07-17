<?php
/*
Template Name: Front Page
*/
get_header(); ?>


<main class="main-content main-front-content">
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/front', 'first_screen' ); ?>
		<?php get_template_part( 'template-parts/front', 'how_works' ); ?>
		<?php get_template_part( 'template-parts/front', 'choose_product' ); ?>
		<?php get_template_part( 'template-parts/front', 'custom_content' ); ?>
		<?php get_template_part( 'template-parts/front', 'about' ); ?>

	<?php endwhile; ?>
</main>
<?php
get_footer();
