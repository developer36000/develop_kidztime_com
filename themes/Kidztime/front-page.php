<?php
/*
Template Name: Front Page
*/
get_header(); ?>


<main class="main-content main-front-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/content', 'front_page' ); ?>
	<?php endwhile; ?>
</main>
<?php
get_footer();
