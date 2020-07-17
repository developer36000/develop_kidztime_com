<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$category_id = $category->term_id;
$get_default_prodact_obj = get_default_product_obj( $category_id );
$product_link = get_default_product_link_by_cat_id( $category_id );
$p_price_html = get_default_product_price_html( $category_id );

?>
<div <?php wc_product_cat_class( '', $category ); ?> data-cat_id="<?php echo $category_id; ?>">
	<a class="product-category--link kt-product-to-customize" href="<?php echo esc_url( $product_link ); ?>">

		<span class="product-category--thumbnail">
			<span class="load-icon"></span>
				<?php woocommerce_subcategory_thumbnail( $category ); ?>
		</span>
		<span class="product-category--name"><?php echo $category->name; ?></span>
		<?php
		/*echo $category->description ? '<span class="product-category--description">'.
		                              $category->description.
		                              '</span>' : ''; */
		echo $p_price_html ? '<span class="product-category--description">'.$p_price_html.'</span>' : '';
		?>
	</a>
</div>
