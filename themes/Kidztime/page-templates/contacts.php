<?php
/*
Template Name: Contacts Page
*/
get_header(); ?>

<div class="main-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/content', 'contact' ); ?>
	<?php endwhile; ?>
</div>
<?php get_footer();
