<?php
/**
 * Basic WooCommerce support
 * For an alternative integration method see WC docs
 * http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-container">
	<header>
		<h1 class="entry-title"><?php echo $kt_page_title ? $kt_page_title : get_the_title(); ?></h1>
	</header>

	<?php woocommerce_content(); ?>

</div>

<?php get_footer();
