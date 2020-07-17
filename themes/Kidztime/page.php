<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 */

get_header();
$body_class = get_tmpl_body_class();

?>

<main class="main-content <?php echo 'body-'.$body_class; ?>">
<?php while ( have_posts() ) : the_post(); ?>

	 <?php if( is_account_page() ) : ?>
			<?php get_template_part( 'template-parts/content', 'woo_account' ); ?>
	 	<?php elseif ( is_shop() ) : ?>
			<?php get_template_part( 'woocommerce/archive-product.php' ); ?>
	 	<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
	 <?php endif; ?>

<?php endwhile; ?>
</main>

<?php
get_footer();
