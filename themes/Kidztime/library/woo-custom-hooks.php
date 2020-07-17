<?php

/**
 * This snippet removes the default sorting dropdown in StoreFront Theme
 */

add_action( 'init', 'ktwc_delay_remove' );
function ktwc_delay_remove() {
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 10 );
}



/**
 * Disable gallery zoom and lightbox at single product pages
 * */
remove_theme_support( 'wc-product-gallery-lightbox' );
remove_theme_support( 'wc-product-gallery-zoom' );

/**
 * Remove Breadcrumb above Product Main Content
 * */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * Remove or Add Product Summary Box
 *
 * @see woocommerce_template_single_title()
 * @see woocommerce_template_single_price()
 * @see woocommerce_template_single_excerpt()
 * @see woocommerce_template_single_meta()
 * @see woocommerce_template_single_sharing()
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

function show_currency_symbol() {
	global  $woocommerce;
	return get_woocommerce_currency_symbol();
}

function get_currency_name() {
	global  $woocommerce;
	return get_woocommerce_currency();
}

/**
 * Hide shipping rates when free shipping is available.
 */
add_filter( 'woocommerce_package_rates', 'kt_shipping_when_free_is_available', 100 );
function kt_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}

/*
 * Added Custom User page and login page
 * */
function kt_add_loginout_icons() {
	if ( ! class_exists( 'woocommerce' ) || ! WC()->cart ) {
		return;
	}
	ob_start();
	$cart_number = WC()->cart->get_cart_contents_count();
	$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
	echo '<ul class="header-loginout-icons">';
		if ( is_user_logged_in() ) {
			echo '<li class="loginout-item loginout-item__myaccount">
						<a href="'. get_permalink( wc_get_page_id( 'myaccount' ) ) .'">
							<svg width="21" height="22" viewBox="0 0 21 22" fill="#58448B" xmlns="http://www.w3.org/2000/svg">
	<path fill="inherit" fill-rule="evenodd" clip-rule="evenodd" d="M6.97109 1.49268C7.99959 0.566258 9.30935 0.19043 10.4992 0.19043C11.6891 0.19043 12.9988 0.566258 14.0273 1.49268C15.0816 2.4423 15.7479 3.88854 15.7479 5.81709V8.88919C15.7479 10.9183 15.0497 12.7771 13.9151 14.0488V14.6494C13.9151 14.9332 13.9257 14.9696 14.0156 15.0648C14.1839 15.2429 14.7033 15.5949 16.1773 15.8885C17.2129 16.0907 18.1705 16.6023 18.9349 17.3617C19.4073 17.831 19.7934 18.3826 20.078 18.9886C20.3609 19.5912 20.2608 20.2366 19.9366 20.7019C19.6238 21.1507 19.1121 21.4281 18.5529 21.4281H2.43646C1.88042 21.4281 1.37063 21.1537 1.05729 20.7081C0.732522 20.2464 0.629008 19.6044 0.906192 19.0019C1.18918 18.3868 1.57757 17.8273 2.0553 17.3527C2.8231 16.5899 3.78782 16.0802 4.82968 15.8868C6.30001 15.6095 6.81424 15.2569 6.97943 15.0804C7.07186 14.9816 7.08328 14.9363 7.08328 14.6494V14.0488C5.94874 12.7771 5.25049 10.9183 5.25049 8.88919V5.81709C5.25049 3.88854 5.91685 2.4423 6.97109 1.49268ZM8.23879 3.03728C7.6588 3.55971 7.19494 4.41754 7.19494 5.81709V8.88919C7.19494 10.4552 7.74006 11.8111 8.51862 12.6744C8.81315 13.0009 9.02772 13.4585 9.02772 13.9838V14.6494C9.02772 14.6551 9.02772 14.6609 9.02773 14.6668C9.02791 15.0279 9.02831 15.8008 8.36791 16.5064C7.76948 17.1459 6.7566 17.5933 5.17309 17.8919L5.17012 17.8924C4.50285 18.016 3.88496 18.3423 3.39326 18.8308C3.22144 19.0015 3.06767 19.1893 2.93379 19.391H18.0519C17.9186 19.1929 17.7664 19.0082 17.597 18.8398C17.1044 18.3505 16.4871 18.0209 15.8197 17.8908L15.8161 17.8901C14.2368 17.5757 13.2292 17.1279 12.6339 16.498C11.9702 15.7958 11.9705 15.0287 11.9707 14.6656L11.9707 13.9838C11.9707 13.4585 12.1853 13.0009 12.4798 12.6744C13.2584 11.8111 13.8035 10.4552 13.8035 8.88919V5.81709C13.8035 4.41754 13.3396 3.55971 12.7596 3.03728C12.1539 2.49166 11.3254 2.22747 10.4992 2.22747C9.67301 2.22747 8.84452 2.49166 8.23879 3.03728Z"/>
	</svg>
							<span class="label">' .__('My Account', kt_textdomain) .'</span>
						</a></li>';
		}
		elseif ( !is_user_logged_in() ) {
			echo '<li class="loginout-item loginout-item__loggedin">
						<a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">
							<svg width="21" height="22" viewBox="0 0 21 22" fill="#58448B" xmlns="http://www.w3.org/2000/svg">
	<path fill="inherit" fill-rule="evenodd" clip-rule="evenodd" d="M17.4862 0.422852C18.2886 0.422852 19.06 0.755214 19.6261 1.35477C20.1922 1.94781 20.5156 2.7559 20.5156 3.59658V18.4095C20.5156 19.2502 20.1922 20.0583 19.6261 20.6513C19.06 21.2509 18.2886 21.5832 17.4862 21.5832H13.4489C12.8953 21.5832 12.4412 21.114 12.4412 20.5275C12.4412 19.9475 12.8891 19.4718 13.4489 19.4718H17.4862C17.7536 19.4718 18.0149 19.3545 18.2015 19.159C18.3944 18.9569 18.5001 18.6897 18.5001 18.4095V3.6031C18.5001 3.32287 18.3882 3.04916 18.2015 2.85366C18.0087 2.65163 17.7536 2.54085 17.4862 2.54085H13.4489C12.8891 2.54085 12.4412 2.05859 12.4412 1.47859C12.4412 0.898586 12.8891 0.422852 13.4489 0.422852H17.4862ZM14.4576 10.9995C14.4576 11.1429 14.4265 11.2797 14.3767 11.4035C14.327 11.5339 14.2523 11.6512 14.1652 11.7555L9.12025 17.0407C8.72213 17.4512 8.0814 17.4512 7.6895 17.0407C7.29759 16.6236 7.29759 15.9523 7.6895 15.5418L11.0113 12.0552H1.33197C0.778328 12.0552 0.324219 11.586 0.324219 10.9995C0.324219 10.4195 0.772107 9.94376 1.33197 9.94376H11.0051L7.68328 6.46374C7.29137 6.04665 7.29137 5.37541 7.68328 4.96485C8.0814 4.55428 8.72213 4.55428 9.11403 4.96485L14.159 10.2501C14.2523 10.3478 14.327 10.4651 14.3767 10.5954C14.4265 10.7193 14.4576 10.8561 14.4576 10.9995Z"/>
	</svg>
							<span class="label">'.__('Login','woocommerce').'</span>
						</a></li>';
		}

	// Cart Link
		echo '<li class="loginout-item loginout-item__cart">
							<a href="' . $cart_url . '">
							'.($cart_number?'<div class="header-cart-count">'. $cart_number .'</div>':'') .'
			<svg width="22" height="22" viewBox="0 0 22 22" fill="#58448B" xmlns="http://www.w3.org/2000/svg">
	<path fill="inherit" fill-rule="evenodd" clip-rule="evenodd" d="M17.151 1.40534L20.4951 4.7494C21.1361 5.39049 21.5 6.2395 21.5 7.14049V17.987C21.5 18.9053 21.1535 19.7544 20.5124 20.3954C19.8713 21.0365 19.005 21.3831 18.104 21.3831H3.89604C2.97772 21.3831 2.12871 21.0365 1.48762 20.3954C0.846535 19.7544 0.5 18.888 0.5 17.987V7.14049C0.5 6.2395 0.846535 5.39049 1.50495 4.7494L4.83168 1.40534C5.47277 0.746925 6.33911 0.400391 7.2401 0.400391H14.7599C15.6436 0.400391 16.5272 0.764252 17.151 1.40534ZM7.2401 2.46227C6.89356 2.46227 6.56436 2.60089 6.30446 2.84346L4.01733 5.13059H17.9827L15.6955 2.84346C15.4356 2.60089 15.1064 2.46227 14.7426 2.46227H7.2401ZM19.0396 18.9573C19.2995 18.6974 19.4381 18.3509 19.4381 18.0044H19.4035V7.19247H2.52723V18.0044C2.52723 18.3682 2.68317 18.7147 2.92574 18.9573C3.18564 19.2172 3.53218 19.3558 3.87871 19.3558H18.0866C18.4505 19.3558 18.797 19.1999 19.0396 18.9573ZM14.2399 14.1579C13.3736 15.0242 12.23 15.492 10.9998 15.492C9.7696 15.492 8.62603 15.0069 7.7597 14.1579C6.91069 13.2915 6.42554 12.148 6.42554 10.9178C6.42554 10.6406 6.5295 10.3807 6.72009 10.1901C6.91069 9.99947 7.17059 9.89551 7.44781 9.89551C7.72504 9.89551 7.98494 9.99947 8.17554 10.1901C8.36613 10.3807 8.47009 10.6406 8.47009 10.9178C8.47009 11.5935 8.72999 12.2173 9.21514 12.7024C9.70029 13.1876 10.3241 13.4475 10.9998 13.4475C11.6755 13.4475 12.3166 13.1703 12.7845 12.7024C13.2696 12.2173 13.5295 11.5935 13.5295 10.9178C13.5295 10.6406 13.6335 10.3807 13.8241 10.1901C14.2052 9.80887 14.8983 9.80887 15.2795 10.1901C15.4701 10.3807 15.5741 10.6406 15.5741 10.9178C15.5741 12.148 15.1062 13.2915 14.2399 14.1579Z" />
	</svg>
								<span class="label">'.__('Cart','woocommerce').'</span>
							</a></li>';
	echo '</ul>';
	return ob_get_clean();
}

/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
	unset( $tabs['description'] );      	// Remove the description tab
	unset( $tabs['reviews'] ); 			// Remove the reviews tab
	unset( $tabs['additional_information'] );  	// Remove the additional information tab
	return $tabs;
}

/**
 * Added count of product in the cart to the icon in the header
 * */
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
	$fragments['div.header-cart-count'] = '<div class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';
	return $fragments;
}

/**
 * Remove the short description field
 * */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('add_meta_boxes', 'ktwc_remove_short_description', 999);
function ktwc_remove_short_description() {
	//remove_meta_box( 'postexcerpt', 'product', 'normal');
}

/**
 * Add the code below to your theme's functions.php file
 * to add a confirm password field on the register form under My Accounts.
 */
add_filter('woocommerce_registration_errors', 'woocommerce_registration_errors_validation', 10, 3);
function woocommerce_registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $confirm_password ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}

/**
 * rRemove WooCommerce default payment gateways from everywhere: BACS, Check Payments, Cash on Delivery and PayPal
 * */
add_filter( 'woocommerce_payment_gateways', 'wc_remove_default_gateway', 10, 1 );
function wc_remove_default_gateway( $load_gateways ){
	unset( $load_gateways[0] ); // WC_Gateway_BACS
	//unset( $load_gateways[1] ); // WC_Gateway_Cheque
	//unset( $load_gateways[2] ); // WC_Gateway_COD (Cash on Delivery)
	//unset( $load_gateways[3] ); // WC_Gateway_Paypal
	return $load_gateways;
}

/**
 * Edit my account menu order
 */
add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );
function my_account_menu_order() {
	$menuOrder = array(
		'dashboard'         => __( 'Account Settings', 'woocommerce' ),
		'orders'            => __( 'Order History', kt_textdomain ),
		'edit-address'      => __( 'Shipping Address', kt_textdomain ),
		'payment-methods'   => __( 'Payment Details', kt_textdomain )
	);
	return $menuOrder;
}

/* *
 * Unset fields in the checkout
 * */
add_filter( 'woocommerce_checkout_fields', 'wc_unset_checkout_order_comments_fields', 9998 );
function wc_unset_checkout_order_comments_fields( $fields ) {
	unset( $fields['order']['order_comments'] );
	return $fields;
}

/* *
 * Unset default address fields
 * */
add_filter( 'woocommerce_default_address_fields', 'wc_remove_default_fields' );
function wc_remove_default_fields( $fields ) {

	unset( $fields[ 'company' ] );
	unset( $fields[ 'address_1' ] );
	unset( $fields[ 'state' ] );
	return $fields;

}

/**
 * Change input field labels/placeholder and for billing
 * */
add_filter( 'woocommerce_billing_fields', 'wc_change_billing_fields', 9999 );
function wc_change_billing_fields( $fields ) {

	## ---- 1. REORDERING BILLING FIELDS ---- ##

	// Set the order of the fields
	$billing_order = array(
		'billing_first_name',
		'billing_last_name',
		'billing_email',
		'billing_phone',
		'billing_address_2',
		'billing_city',
		'billing_country',
		'billing_postcode',
	);

	$count = 0;
	$priority = 10;

	// Updating the 'priority' argument
	foreach($billing_order as $field_name){
		$count++;
		$fields[$field_name]['priority'] = $count * $priority;
	}

	## ---- 2. CHANGING SOME CLASSES FOR BILLING FIELDS ---- ##

	// billing_first_name
	$fields['billing_first_name']['placeholder'] = 'First Name *';
	$fields['billing_first_name']['label'] = 'First Name';
	$fields['billing_first_name']['required'] = true;
	$fields['billing_first_name']['class'] = array('form-row-first', 'woo-user__first-name');

	// billing_last_name
	$fields['billing_last_name']['placeholder'] = 'Last Name *';
	$fields['billing_last_name']['label'] = 'Last Name';
	$fields['billing_last_name']['required'] = true;
	$fields['billing_last_name']['class'] = array('form-row-first', 'woo-user__last-name');

	// billing_email
	$fields['billing_email']['placeholder'] = 'Email address *';
	$fields['billing_email']['label'] = 'Email address';
	$fields['billing_email']['required'] = true;
	$fields['billing_email']['class'] = array('form-row-first', 'woo-user__email');

	// billing_phone
	$fields['billing_phone']['placeholder'] = 'Phone number';
	$fields['billing_phone']['label'] = 'Phone number';
	$fields['billing_phone']['required'] = false;
	$fields['billing_phone']['class'] = array('form-row-last', 'woo-user__phone');

	// billing_address_1
	$fields['billing_address_2']['placeholder'] = 'Address';
	$fields['billing_address_2']['label'] = 'Address';
	$fields['billing_address_2']['required'] = false;
	$fields['billing_address_2']['class'] = array('form-row-wide', 'woo-user__address');

	// billing_city
	$fields['billing_city']['placeholder'] = 'City';
	$fields['billing_city']['label'] = 'City';
	$fields['billing_city']['required'] = false;
	$fields['billing_city']['class'] = array('form-row-first', 'address-field', 'woo-user__city', 'validate-required');

	// billing_country
	$fields['billing_country']['placeholder'] = 'Country';
	$fields['billing_country']['label'] = 'Country';
	$fields['billing_country']['required'] = false;
	$fields['billing_country']['class'] = array('form-row-wide-2','form-row-wide', 'address-field', 'woo-user__country');

	// billing_postcode
	$fields['billing_postcode']['placeholder'] = 'Zip Code';
	$fields['billing_postcode']['label'] = 'Zip Code';
	$fields['billing_postcode']['required'] = false;
	$fields['billing_postcode']['class'] = array('form-row-wide-1','form-row-wide', 'address-field', 'woo-user__zipcode');

	return $fields;

}

/**
 * Change input field labels/placeholder and for shipping
 * */
add_filter( 'woocommerce_shipping_fields', 'wc_change_shipping_fields', 9999 );
function wc_change_shipping_fields( $fields ) {

	## ---- 1. REORDERING BILLING FIELDS ---- ##

	// Set the order of the fields
	$shipping_order = array(
		'shipping_first_name',
		'shipping_last_name',
		'shipping_email',
		'shipping_phone',
		'shipping_address_2',
		'shipping_city',
		'shipping_country',
		'shipping_postcode',
	);

	$count = 0;
	$priority = 10;

	// Updating the 'priority' argument
	foreach($shipping_order as $field_name){
		$count++;
		$fields[$field_name]['priority'] = $count * $priority;
	}


	## ---- 2. CHANGING SOME CLASSES FOR BILLING FIELDS ---- ##

	// shipping_first_name
	$fields['shipping_first_name']['placeholder'] = 'First Name';
	$fields['shipping_first_name']['label'] = 'First Name';
	$fields['shipping_first_name']['class'] = array('form-row-first', 'woo-user__first-name');

	// shipping_last_name
	$fields['shipping_last_name']['placeholder'] = 'Last Name';
	$fields['shipping_last_name']['label'] = 'Last Name';
	$fields['shipping_last_name']['class'] = array('form-row-first', 'woo-user__last-name');

	// shipping_email
	$fields['shipping_email']['placeholder'] = 'Email address';
	$fields['shipping_email']['required'] = true;
	$fields['shipping_email']['class'] = array('form-row-wide', 'woo-user__email');

	unset( $fields[ 'shipping_company' ] );
	unset( $fields[ 'shipping_address_1' ] );
	unset( $fields[ 'shipping_address_2' ] );
	unset( $fields[ 'shipping_phone' ] );
	unset( $fields[ 'shipping_state' ] );
	unset( $fields[ 'shipping_city' ] );
	unset( $fields[ 'shipping_country' ] );
	unset( $fields[ 'shipping_postcode' ] );

	return $fields;

}

/**
 * Woocommerce Account - reorder the columns name
 * */
add_filter( 'woocommerce_account_orders_columns', 'wc_custom_account_orders_columns' );
function wc_custom_account_orders_columns() {
	$columns = array(
		'order-number'  => __( '#Order', kt_textdomain ),
		'order-date'    => __( 'Date Created', 'woocommerce' ),
		'order-total'   => __( 'Total', 'woocommerce' ),
		'order-status'  => __( 'Status', 'woocommerce' ),
		'order-actions' => __( 'Actions', 'woocommerce' ),
	);
	return $columns;
}

/**
 * Remove Product Tags
 * */
// Hide “All Products > Tags” Link from Admin Menu
add_action( 'admin_menu', 'wc_hide_product_tags_admin_menu', 9999 );
function wc_hide_product_tags_admin_menu() {
	remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product' );
}
// Remove Product tags Metabox
add_action( 'admin_menu', 'wc_hide_product_tags_metabox' );
function wc_hide_product_tags_metabox() {
	remove_meta_box( 'tagsdiv-product_tag', 'product', 'side' );
}
// Remove Tags Column from All Products page
add_filter('manage_product_posts_columns', 'wc_hide_product_tags_column', 999 );
function wc_hide_product_tags_column( $product_columns ) {
	unset( $product_columns['product_tag'] );
	return $product_columns;
}
// Remove Product Tags Textarea from Quick Edit and Bulk Edit
add_filter( 'quick_edit_show_taxonomy', 'wc_hide_product_tags_quick_edit', 10, 2 );
function wc_hide_product_tags_quick_edit( $show, $taxonomy_name ) {
	if ( 'product_tag' == $taxonomy_name )
		$show = false;
	return $show;

}
// Remove Product Tag Cloud Widget
add_action( 'widgets_init', 'wc_remove_product_tag_cloud_widget' );
function wc_remove_product_tag_cloud_widget(){
	unregister_widget('WC_Widget_Product_Tag_Cloud');
}

/**
 * Disable reviews for All Products
 */
add_action( 'init', 'wc_disable_reviews' );
function wc_disable_reviews() {
	remove_post_type_support( 'product', 'comments' );
}

/**
 * Get Product First Category
 * */
function wc_product_category_name( $product_id = 0 ) {
	global $post;
	$post_id = $product_id ?: $post->ID;
	$terms = get_the_terms( $post_id, 'product_cat' );
	$product_cat_id = '';
	foreach ($terms as $key => $term) {
		if ( $key==0 ) {
			$product_cat_id = $term->term_id;
			break;
		}

	}
	$product_term = get_term( $product_cat_id, 'product_cat' );

	return $product_term->name;
}
function wc_product_category_obj( $product_id = 0 ) {
	global $post;
	$post_id = $product_id ?: $post->ID;
	$terms = get_the_terms( $post_id, 'product_cat' );
	$product_cat_id = '';
	foreach ($terms as $key => $term) {
		if ( $key==0 ) {
			$product_cat_id = $term->term_id;
			break;
		}

	}
	$product_term = get_term( $product_cat_id, 'product_cat' );

	return $product_term;
}
function get_product_tab_meta( $key, $post_id = 0 ) {
		global $post;
		$post_id = $post_id ?: $post->ID;
		$product = wc_get_product( $post_id );
		return $product->get_meta( $key );
}
/**
 * Get Default Pdoduct id for category
 * */
function get_default_product_obj( $category_id ) {
	$category_id = intval($category_id);

	if ( !$category_id ) return '';
	$product_obj = array();
	$product_cat_obj = get_term( $category_id, 'product_cat' );
	$product_cat_slug = $product_cat_obj->slug;
	// find another product in the same category
	$products = wc_get_products(array(
		'category' => array( $product_cat_slug ),
	));

	foreach ($products as $product) :
		$product_id = $product->get_id();
		$product_object = wc_get_product( $product_id );
	//	var_dump($product_object->get_meta_data());
	//	var_dump($product_object->meta_exists('super_product'));
	//	var_dump($product_id);
		$is_super = get_product_tab_meta('super_product', $product_id);

		if ( $is_super == 'yes' && $product_object->meta_exists('super_product') ) {
			$product_obj = $product_object;
			break;
		}
	endforeach;

	return $product_obj;
}

function get_default_product_price_html( $category_id ) {
	$category_id = intval($category_id);

	if ( !$category_id ) return '';
	$product_obj = array();
	$product_cat_obj = get_term( $category_id, 'product_cat' );
	$product_cat_slug = $product_cat_obj->slug;
	// find another product in the same category
	$products = wc_get_products(array(
		'category' => array( $product_cat_slug ),
	));

	foreach ($products as $product) :
		$product_id = $product->get_id();
		$product_object = wc_get_product( $product_id );
	//	var_dump($product_object->get_meta_data());
	//	var_dump($product_object->meta_exists('super_product'));
	//	var_dump($product_id);
		$is_super = get_product_tab_meta('super_product', $product_id);
		if ( $is_super == 'yes' && $product_object->meta_exists('super_product') ) {

			return $product_object->get_price_html();
			break;
		}
	endforeach;

}

/**
 * Get product link for customization by category id
 * */
function get_default_product_link_by_cat_id( $product_cat_id ) {
	$product_cat_id = intval($product_cat_id);
	if ( $product_cat_id ) {
		$product_cat_obj = get_term( $product_cat_id, 'product_cat' );
		$product_cat_slug = $product_cat_obj->slug;
		// find another product in the same category
		$products = wc_get_products(array(
			'category' => array( $product_cat_slug ),
		));
		 $product_link = '';
		foreach ($products as $product) :
			$product_id = $product->get_id();
			$product_object = wc_get_product( $product_id );

			$is_super = get_product_tab_meta('super_product', $product_id);

			if ( $is_super == 'yes' && $product_object->meta_exists('super_product') ) {
				$arr_params = array(
					'new_product' => true,
					'default_prod_id' => $product_id
				);
				return add_query_arg( $arr_params, get_permalink( $product_id ) );
				break;
			}
		endforeach;

	} else {
		return esc_url( wc_get_page_permalink( 'shop' ) );
	}
}

/**
 * Custom Woocommerce quantity input
 *
 * Enqueue js script inline using wc_enqueue_js to make the buttons actually work.
 * */
add_action( 'template_redirect', 'wc_quantity_enqueue_script' );
function wc_quantity_enqueue_script() {

	$event_listeners = '
		// Make the code work after page load.
		$(document).ready(function(){
			QtyChng();
		});

		// Make the code work after executing AJAX.
		$(document).ajaxComplete(function () {
			QtyChng();
		});
		';

	$event_listeners = apply_filters( 'ktq_change_event_listeners', $event_listeners);

	$quantity_change = '
		// Find quantity input field corresponding to increment button clicked.
		var qty = $( this ).siblings( ".quantity" ).find( ".qty" );
		// Read value and attributes min, max, step.
		var val = parseFloat(qty.val());
		var max = parseFloat(qty.attr( "max" ));
		var min = parseFloat(qty.attr( "min" ));
		var step = parseFloat(qty.attr( "step" ));

		// Change input field value if result is in min and max range.
		// If the result is above max then change to max and alert user about exceeding max stock.
		// If the field is empty, fill with min for "-" (0 possible) and step for "+".
		if ( $( this ).is( ".plus" ) ) {
			if ( val === max ) return false;
			if( isNaN(val) ) {
				qty.val( step );
				return false;
			}
			if ( val + step > max ) {
			  qty.val( max );
			} else {
			  qty.val( val + step );
			}
		} else {
			if ( val === min ) return false;
			if( isNaN(val) ) {
				qty.val( min );
				return false;
			}
			if ( val - step < min ) {
			  qty.val( min );
			} else {
			  qty.val( val - step );
			}
		}

		qty.trigger("change");
		$( "body" ).removeClass( "sf-input-focused" );
		';

	$quantity_change = apply_filters( 'ktq_change_quantity_change', $quantity_change);

	wc_enqueue_js( $event_listeners . '
			function QtyChng() {
				$(document).off("click", ".ktq-button").on( "click", ".ktq-button", function() {'
	               . $quantity_change .
	               '});
			}
			'
	);

}

/**
 * Remove the payment options form from default location
 * */
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

/**
 * Add the checkout payment options to the new action
 * */
add_action( 'woocommerce_checkout_kt_payment', 'woocommerce_checkout_payment', 20 );

/**
 * Get account address (billing or shipping) phone and email
 * */
function wc_get_account_mail_phone( $name ) {
	$customer_id = get_current_user_id();
	$args = array();
	$args['phone'] = get_user_meta( $customer_id, $name . '_phone', true );
	$args['email'] = get_user_meta( $customer_id, $name . '_email', true );
	return $args;
}

/**
 * Rendering Custom Checkout Tabs
 * */
add_action('wc_checkout_billing_tabs', 'wc_checkout_billing_tabs_callback');
function wc_checkout_billing_tabs_callback() {
	if ( function_exists( 'WC' )) {
		$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
		if ( $available_gateways ) : ?>
		<ul class="woo-checkout__tabs">
			<li class="woo-checkout__tabs--item wc_payment_method payment_method_digital is_active" data-link="digital">
				<span class="item-name">
					 <?php esc_html_e('Digital Checkout', kt_textdomain); ?>
				</span>
			</li>
			<?php foreach ( $available_gateways as $gateway ) :
				if ( $gateway->id == 'cod' ) :
					wc_get_template( 'checkout/parts/part-payment_invoice.php', array( 'gateway' => $gateway ) );
				endif;
			endforeach; ?>
		</ul>
		<?php endif;
	}
}

/**
 * Change "Place order" button text on WooCommerce Checkout page for a specific payment method
 */
add_filter( 'woocommerce_available_payment_gateways', 'woocommerce_available_payment_gateways' );
function woocommerce_available_payment_gateways( $available_gateways ) {
	if (! is_checkout() ) return $available_gateways;  // stop doing anything if we're not on checkout page.

	foreach ( $available_gateways as $gateway ) :
		if ( $gateway->id == 'cod' ) :
			$gateway->order_button_text = __( 'Generate receipt', kt_textdomain );
		else :
			$gateway->order_button_text = __( 'Confirm Order', kt_textdomain );
		endif;
	endforeach;
	return $available_gateways;
}

function wc_update_meta_address( $id, $meta_array ) {
	update_post_meta( $id, '_billing_first_name', $meta_array['billing_first_name'][0] );
	update_post_meta( $id, '_billing_last_name', $meta_array['billing_last_name'][0] );
	update_post_meta( $id, '_billing_company', $meta_array['billing_company'][0] );
	update_post_meta( $id, '_billing_address_1', $meta_array['billing_address_1'][0] );
	update_post_meta( $id, '_billing_address_2', $meta_array['billing_address_2'][0] );
	update_post_meta( $id, '_billing_city', $meta_array['billing_city'][0] );
	update_post_meta( $id, '_billing_state', $meta_array['billing_state'][0] );
	update_post_meta( $id, '_billing_postcode', $meta_array['billing_postcode'][0] );
	update_post_meta( $id, '_billing_country', $meta_array['billing_country'][0] );
	update_post_meta( $id, '_billing_email', $meta_array['billing_email'][0] );
	update_post_meta( $id, '_billing_phone', $meta_array['billing_phone'][0] );
	// shipping
	update_post_meta( $id, '_shipping_first_name', $meta_array['billing_first_name'][0] );
	update_post_meta( $id, '_shipping_last_name', $meta_array['billing_last_name'][0] );
	update_post_meta( $id, '_shipping_company', $meta_array['billing_company'][0] );
	update_post_meta( $id, '_shipping_address_1', $meta_array['billing_address_1'][0] );
	update_post_meta( $id, '_shipping_address_2', $meta_array['billing_address_2'][0] );
	update_post_meta( $id, '_shipping_city', $meta_array['billing_city'][0] );
	update_post_meta( $id, '_shipping_state', $meta_array['billing_state'][0] );
	update_post_meta( $id, '_shipping_postcode', $meta_array['billing_postcode'][0] );
	update_post_meta( $id, '_shipping_country', $meta_array['billing_country'][0] );
	update_post_meta( $id, '_shipping_email', $meta_array['billing_email'][0] );
	update_post_meta( $id, '_shipping_phone', $meta_array['billing_phone'][0] );
}

/**
 * Update WooCommerce Order Address Dynamically When Customer Updates Their Address
 * */
add_action( 'woocommerce_customer_save_address', 'wc_update_address_for_orders', 10, 2 );
function wc_update_address_for_orders( $user_id ) {

	$customer_meta = get_user_meta( $user_id );
	$customer_orders = get_posts( array(
		'numberposts' => -1,
		'meta_key'    => '_customer_user',
		'meta_value'  => $user_id,
		'post_type'   => wc_get_order_types(),
		'post_status' => array_keys( wc_get_order_statuses() )
	) );

	foreach( $customer_orders as $order ) {
		wc_update_meta_address( $order->ID, $customer_meta );
	}

};

/**
 * Checkbox to copy billing to shipping address
 * */
add_action( 'woocommerce_checkout_update_customer', 'wc_override_checkout_update_fields', 10, 2 );
function wc_override_checkout_update_fields( $customer, $data ) {
	if ( ! is_user_logged_in() || ! is_admin() ) return;
	$customer_id = $customer->get_id();
	$user_id = $customer_id;
	$customer_meta = get_user_meta( $user_id );
	wc_update_meta_address( $customer_id, $customer_meta );
}
// save order billing address fields to order shipping address fields
add_action( 'woocommerce_thankyou', 'wc_checkout_save_user_meta');
function wc_checkout_save_user_meta( $order_id ) {
	$order = wc_get_order( $order_id );
	$billing_address = $order->data['billing'];
	$shipping_address = $billing_address;
	$order->set_address( $billing_address, 'billing' );
	$order->set_address( $shipping_address, 'shipping' );
	if ( is_user_logged_in() || is_admin() ) {
		$customer_id = $order->data['customer_id'];
		$customer_meta = get_user_meta( $customer_id );
		wc_update_meta_address( $customer_id, $customer_meta );
	}
}

/**
 * Change "Place order" button text on WooCommerce Checkout page
 */
add_filter( 'woocommerce_order_button_text', 'wc_custom_button_text_for_product' );
function wc_custom_button_text_for_product( $button_text ) {
	$button_text = 'Confirm Order';
	return $button_text;
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'wc_checkout_field_update_order_meta' );
function wc_checkout_field_update_order_meta( $order_id ) {
	if ( ! empty( $_POST['cod_live_checkout'] ) ) {
		update_post_meta( $order_id, 'COD Live Checkout', sanitize_text_field( $_POST['cod_live_checkout'] ) );
	}
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wc_checkout_field_display_admin_order_meta', 10, 1 );
function wc_checkout_field_display_admin_order_meta($order){
	echo '<p><strong>'.__('COD Live Checkout').':</strong> ' . get_post_meta( $order->id, 'COD Live Checkout', true ) . '</p>';
}

/**
 * Remove Downloadable Checkboxes from the Product Data Metabox
 * */
add_filter( 'product_type_options', 'ktwc_product_type_options' );
function ktwc_product_type_options( $options ) {
	// remove "Downloadable" checkbox
	if( isset( $options[ 'downloadable' ] ) ) {
		unset( $options[ 'downloadable' ] );
	}
	return $options;
}

/**
 * Remove Downloadable Dropdown Options from Product Type Filter
 * */
add_filter( 'woocommerce_products_admin_list_table_filters', 'ktwc_products_admin_list_table_filters');
function ktwc_products_admin_list_table_filters( $filters ) {
	if( isset( $filters[ 'product_type' ] ) ) {
		$filters[ 'product_type' ] = 'ktwc_product_type_callback';
	}
	return $filters;
}
function ktwc_product_type_callback(){

	$current_product_type = isset( $_REQUEST['product_type'] ) ? wc_clean( wp_unslash( $_REQUEST['product_type'] ) ) : false;
	$output               = '<select name="product_type" id="dropdown_product_type"><option value="">Filter by product type</option>';

	foreach ( wc_get_product_types() as $value => $label ) {
		$output .= '<option value="' . esc_attr( $value ) . '" ';
		$output .= selected( $value, $current_product_type, false );
		$output .= '>' . esc_html( $label ) . '</option>';
	}

	$output .= '</select>';
	echo $output;
}

/**
 * Get list categories with default product
 * */
add_action( 'ktwc_list_customize_categories', 'get_list_customize_categories' );
function get_list_customize_categories() {
	$args = array(
		'taxonomy'     => 'product_cat',
		'hide_empty'   => false,
	);
	$categories = get_categories( $args ); ?>
	<div class="single-category-list-section">
		<h3 class="single-category-title"><?php echo __('Customise Another Product', kt_textdomain); ?></h3>
		<div class="products kt-product-list">
			<?php foreach ( $categories as $category ) : ?>
				<?php wc_get_template( 'content-product_cat.php', array( 'category' => $category ) ); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

add_action('ktwc_product_single_content', 'ktwc_product_single_content_callback');
function ktwc_product_single_content_callback() {
	global $product;
	$product_id = $product->get_id();
	$product_description = get_field('product_description', $product_id );
	$shipping_information = get_field('product_shipping_information', $product_id );
	$product_features = get_field('product_features', $product_id );
	?>
	<div class="single-product-description">
		<?php if( $product_description ) : ?>
			<div class="content-section">
				<h3 class="content-section-title"><?php echo __('Description', kt_textdomain); ?></h3>
				<div class="content"><?php echo $product_description; ?></div>
			</div>
		<?php endif; ?>
		<?php if( $shipping_information ) : ?>
			<div class="content-section">
				<h3 class="content-section-title"><?php echo __('Shipping Information', kt_textdomain); ?></h3>
				<div class="content"><?php echo $shipping_information; ?></div>
			</div>
		<?php endif; ?>
		<?php if( $product_features ) : ?>
			<div class="content-section">
				<h3 class="content-section-title"><?php echo __('Product Details/Features', kt_textdomain); ?></h3>
				<div class="content"><?php echo $product_features; ?></div>
			</div>
		<?php endif; ?>
	</div>
	<?php
}

/*
 * Add Cusctom content to the single product
 * */
//add_action('woocommerce_after_main_content', 'ktwc_custom_product_content');
function ktwc_custom_product_content() {
	/**
	 * categories with default product
	 */
	do_action( 'ktwc_product_single_content' );
	do_action( 'ktwc_list_customize_categories' );
}

/**
 * Custom message after add to cart product at the single page
 * */
add_filter( 'wc_add_to_cart_message_html', 'filter_wc_add_to_cart_message', 10, 2 );
function filter_wc_add_to_cart_message( $message, $product_id ) {
	$message = '';
	$product_title = get_the_title( $product_id );
	$message = sprintf('
		<div class="cta-modal-window">
			<div id="cta_overlay" class="show"></div>
			<div id="cta_modal_added_product_msg" class="cta_modal ktwoo_modal ktwoo_modal--added ktwoo_modal--big show">
				<div class="cta-close"></div>
				<h3 class="modal_title">%1$s</h3>
				<div class="modal-entry">
						<a href="%5$s" class="create-new">
                <span class="create-new-label">%4$s</span>
						</a>
	         <div class="form-button">
						 <a href="%2$s" class="btn woo-btn woo-btn__link-action">%3$s</a>
						 <a href="%6$s" class="btn kt-btn kt-btn--default" >%7$s</a>
					 </div>
				</div>

			</div>
		</div>',
		__(" \"$product_title\" added to cart! ", kt_textdomain),
		esc_url( wc_get_page_permalink( 'cart' ) ),
		esc_html__( 'View Cart', 'woocommerce' ),
		esc_html__( 'Create Another Item', kt_textdomain ),
		esc_url( wc_get_page_permalink( 'shop' ) ),
		esc_url( wc_get_page_permalink( 'checkout' ) ),
		esc_html__( 'Checkout', 'woocommerce' )
	);

	return $message;
};
/*
 * Add product information to the header summary
 * */
add_action('woocommerce_single_product_summary', 'ktwc_product_before_summary');
function ktwc_product_before_summary() {
	 global $product;
	?>
	<div class="summary-header">
		<div class="top-summary">
			<div class="top-summary-title">

				<?php the_title( '<h1 class="product_title entry-title">', '</h1>' ); ?>

				<a class="edit-product-title ktwoo-cta" href="#cta_modal_edit_product_title"
				   data-product_id="<?php echo esc_attr( $product->get_id() ); ?>">
					<svg width="22" height="23" viewBox="0 0 22 23" fill="#A5A3B8" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M10.0429 3.04342C11.3563 1.73004 13.1376 0.992188 14.995 0.992188C16.8524 0.992188 18.6337 1.73004 19.9471 3.04342C21.2605 4.3568 21.9983 6.13812 21.9983 7.99552C21.9983 9.85256 21.2608 11.6336 19.9479 12.9469L19.9471 12.9476L17.2936 15.609C17.2409 15.6777 17.1794 15.7393 17.1109 15.7923L13.2082 19.7066C13.0205 19.8948 12.7657 20.0005 12.5 20.0005H4.41418L1.70711 22.7076C1.31658 23.0981 0.683418 23.0981 0.292893 22.7076C-0.0976311 22.3171 -0.0976311 21.6839 0.292893 21.2934L3 18.5863V10.5005C3 10.2353 3.10536 9.98095 3.29289 9.79342L10.0429 3.04342ZM16.0731 14.0005L18.5318 11.5345L18.5329 11.5334C19.4712 10.5951 19.9983 9.32249 19.9983 7.99552C19.9983 6.66856 19.4712 5.39594 18.5329 4.45763C17.5946 3.51932 16.322 2.99219 14.995 2.99219C13.668 2.99219 12.3954 3.51932 11.4571 4.45763L5 10.9147V16.5863L14.2929 7.29338C14.6834 6.90286 15.3166 6.90286 15.7071 7.29338C16.0976 7.68391 16.0976 8.31707 15.7071 8.70759L10.4142 14.0005H16.0731ZM8.41421 16.0005H14.079L12.0849 18.0005H6.41418L8.41421 16.0005Z" fill="inherit"/>
					</svg>

				</a>
			</div>
			<?php wc_get_template_part('single-product/price'); ?>
		</div>

		<?php wc_get_template_part('single-product/meta'); ?>
		<div class="mobile-price">
			<?php wc_get_template_part('single-product/price'); ?>
		</div>


	</div>
<?php
}

/**
 * Single Product customize modals and Custom product content
 * */
add_action('woocommerce_after_single_product', 'ktwc_customize_modals');
function ktwc_customize_modals(  ) {
	/**
	 * categories with default product
	 */
	do_action( 'ktwc_product_single_content' );
	do_action( 'ktwc_list_customize_categories' );

	// modals
	wc_get_template_part('single-modals/edit-title');
}

add_action('ktwc_before_customize_product', 'ktwc_before_customize_modals');
function ktwc_before_customize_modals(  ) {
	// modals
	wc_get_template_part('single-modals/create-title');
	wc_get_template_part('single-modals/sure-go-back');
	wc_get_template_part('single-modals/js-texteditor');
}




//--------------------------------------------------------------------------------------

/* *
 * Page for Product Customize Settings
 * */
add_action( 'admin_menu', 'kt_woo_customize_admin_page' );
function kt_woo_customize_admin_page() {
	add_options_page(
		__('Settings for Product Customize', kt_textdomain),
		__('Product Customize Settings', kt_textdomain),
		'manage_options',
		'woo-customize-settings',
		'kt_woo_customize_settings_page'
	);
}
/**
 * This is output/render (HTML) for settings page
 */
function kt_woo_customize_settings_page() {
	if (!current_user_can('manage_options')) {
		wp_die('Unauthorized user');
	}
	echo '<div class="kt_customize-page">';
		echo '<br /><h1 class="kt_customize-title">' . get_admin_page_title() . '</h1>';
		echo '<form id="kt_customize_options_form" action="options.php" method="POST">';
		/**
		 * hidden protective fields
		 * register_setting -> $option_group
		 */
		settings_fields( 'kt_customize_main_options_group' );

		/**
		 * sections with settings (options).
		 * We only have one 'section_id'
		 * add_settings_section -> $ page (id)
		 */
		do_settings_sections( 'kt-customize-settings' );
		submit_button(); // Default WordPress Button Save
		echo '</form>';
	echo '</div>';
}

/**
 * Register options
 * Add option fields
 * Add section options
 */
add_action( 'admin_init', 'kt_woo_create_option_admin_page' );
function kt_woo_create_option_admin_page() {
	// register_setting( $option_group, $option_name, $sanitize_callback );
	// Registers a new option.
	register_setting (
		'kt_customize_main_options_group',        // $option_group
		kt_meta_option,               // $option_name
		'kt_woo_save_option'      // $sanitize_callback
	);
	// add_settings_section( $id, $title, $callback, $page );
	// Adding an options section
	add_settings_section (
		kt_meta_option.'_section',                   // $id
		__('WooCommerce REST API Access:', kt_textdomain),  // $title
		'kt_customize_settings_callback',                                           // $callback
		'kt-customize-settings'                 // $page (id)
	);
	// add_settings_field( $id, $title, $callback, $page, $section, $args );
	// Adding Option Fields
	add_settings_field (
		kt_meta_option.'_consumer_secret',             // $id
		__('Consumer Secret*:', kt_textdomain), // $title
		'consumer_secret_callback',                   // $callback
		'kt-customize-settings',                   // $page ->  add_settings_section
		kt_meta_option.'_section'                       // $section ->  add_settings_section
	);
	add_settings_field (
		kt_meta_option.'_consumer_key',     // $id
		__('Consumer Key*:', kt_textdomain),  // $title
		'consumer_key_callback',   // $callback
		'kt-customize-settings',      // $page ->  add_settings_section
		kt_meta_option.'_section'          // $section ->  add_settings_section
	);

	/**
	 * If not created settings set as default
	 */
	if( ! get_option(kt_meta_option) ){
		update_option( kt_meta_option, get_default_options() );
	}
}
function kt_customize_settings_callback() {
	$woo_rest_api_link = site_url().'/wp-admin/admin.php?page=wc-settings&tab=advanced&section=keys';
	echo '<a href="'.$woo_rest_api_link.'" target="_blank">You can get this access here</a>';
}
function consumer_secret_callback() {
	// $callback -> add_settings_field
	$val = get_option(kt_meta_option)['kt_woo_customize_option']['consumer_secret']; ?>
	<input type="text"
	       name="<?php echo kt_meta_option; ?>[kt_woo_customize_option][consumer_secret]"
	       value="<?php echo esc_attr( $val ) ?>" />
	<!--	<span><?/* echo __('Identifies your app during the OAuth handshake.', ca_textdomain); */?></span>-->
	<?
}
function consumer_key_callback() {
	// $callback -> add_settings_field
	$val = get_option(kt_meta_option)['kt_woo_customize_option']['consumer_key']; ?>
	<input type="text"
	       name="<?php echo kt_meta_option; ?>[kt_woo_customize_option][consumer_key]"
	       value="<?php echo esc_attr( $val ) ?>" />
	<!--	<span><?/* echo __('Identifies your app during the OAuth handshake.', ca_textdomain); */?></span>-->
	<?
}

/**
 * Save option
 * @param $input
 */
function kt_woo_save_option( $input ) { //  register_setting -> $sanitize_callback
	return $input;
}

/**
 * Get All Options Datas
 * */
function kt_get_option_customize() {
	$options = get_option(kt_meta_option)['kt_woo_customize_option'];
	return $options;
}

/**
 * Returns an array of default settings
 * @return array
 */
function get_default_options() {
	$defaults_option = array(
		'kt_woo_customize_option' => array(
			'consumer_secret' => '',
			'consumer_key' => '',
		)
	);
	// Filter to which you can connect and
	// change the default settings array
	return apply_filters(kt_meta_option, $defaults_option );
}

// ---------------------------------------------------------------------

function slugify($string){
	return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}
/**
 * Method to delete Woo Product
 *
 * @param int $id the product ID.
 * @param bool $force true to permanently delete product, false to move to trash.
 * @return \WP_Error|boolean
 */
function kt_delete_product($id, $force = false) {
	$product = wc_get_product($id);

	if(empty($product))
		return new WP_Error(999, sprintf(__('No %s is associated with #%d', 'woocommerce'), 'product', $id));

	// If we're forcing, then delete permanently.
	if ($force)
	{
		if ($product->is_type('variable'))
		{
			foreach ($product->get_children() as $child_id)
			{
				$child = wc_get_product($child_id);
		//		$child_thumb_id = get_post_thumbnail_id( $child_id );
			//	wp_delete_attachment( $child_thumb_id, true );
				delete_post_meta($child_id,'super_product');
				$child->delete(true);

			}
		}
		elseif ($product->is_type('grouped'))
		{
			foreach ($product->get_children() as $child_id)
			{
				delete_post_meta($child_id,'super_product');
		//		$child_thumb_id = get_post_thumbnail_id( $child_id );
			//	wp_delete_attachment( $child_thumb_id, true );
				$child = wc_get_product($child_id);
				$child->set_parent_id(0);
				$child->save();
			}
		}
	//	$thumb_id = get_post_thumbnail_id( $product->get_id() );
	//	wp_delete_attachment( $thumb_id, true );
		delete_post_meta( $product->get_id(),'super_product' );
		$product->delete(true);
		$result = $product->get_id() > 0 ? false : true;
	}
	else
	{
		$product->delete();
		$result = 'trash' === $product->get_status();
	}

	if (!$result)
	{
		return new WP_Error(999, sprintf(__('This %s cannot be deleted', 'woocommerce'), 'product'));
	}

	// Delete parent product transients.
	if ($parent_id = wp_get_post_parent_id($id))
	{
		wc_delete_product_transients($parent_id);
	}
	return true;
}

function create_product_attribute( $label_name ){
	global $wpdb;

	$slug = sanitize_title( $label_name );

	if ( strlen( $slug ) >= 28 ) {
		return new WP_Error( 'invalid_product_attribute_slug_too_long', sprintf( __( 'Name "%s" is too long (28 characters max). Shorten it, please.', 'woocommerce' ), $slug ), array( 'status' => 400 ) );
	} elseif ( wc_check_if_attribute_name_is_reserved( $slug ) ) {
		return new WP_Error( 'invalid_product_attribute_slug_reserved_name', sprintf( __( 'Name "%s" is not allowed because it is a reserved term. Change it, please.', 'woocommerce' ), $slug ), array( 'status' => 400 ) );
	} elseif ( taxonomy_exists( wc_attribute_taxonomy_name( $label_name ) ) ) {
		return new WP_Error( 'invalid_product_attribute_slug_already_exists', sprintf( __( 'Name "%s" is already in use. Change it, please.', 'woocommerce' ), $label_name ), array( 'status' => 400 ) );
	}

	$data = array(
		'attribute_label'   => $label_name,
		'attribute_name'    => $slug,
		'attribute_type'    => 'select',
		'attribute_orderby' => 'menu_order',
		'attribute_public'  => 0, // Enable archives ==> true (or 1)
	);

	$results = $wpdb->insert( "{$wpdb->prefix}woocommerce_attribute_taxonomies", $data );

	if ( is_wp_error( $results ) ) {
		return new WP_Error( 'cannot_create_attribute', $results->get_error_message(), array( 'status' => 400 ) );
	}

	$id = $wpdb->insert_id;

	do_action('woocommerce_attribute_added', $id, $data);

	wp_schedule_single_event( time(), 'woocommerce_flush_rewrite_rules' );

	delete_transient('wc_attribute_taxonomies');
}


// Setup:
require_once( 'vendor/autoload.php' );
use Automattic\WooCommerce\Client;
function kt_get_woo_api() {
	$consumer_key = kt_get_option_customize()['consumer_key'];
	$consumer_secret = kt_get_option_customize()['consumer_secret'];
	$store_url = site_url();
	$kt_woocommerce = new Client(
		$store_url, // Your store URL
		$consumer_key, // Your consumer key
		$consumer_secret, // Your consumer secret
		[
			'wp_api' => true, // Enable the WP REST API integration
			'version' => 'wc/v3' // WooCommerce WP REST API version
		]
	);
	return $kt_woocommerce;
}
function ktwc_upload_dir( $type = false ) {
	$uploads = wp_upload_dir();

	if ( 'dir' == $type ) {
		return $uploads['basedir'];
	} if ( 'url' == $type ) {
		return $uploads['baseurl'];
	}

	return $uploads;
}
function woo_in_cart($arr_product_id) {
	global $woocommerce;
	$cartarray = array();

	foreach($woocommerce->cart->get_cart() as $key => $val ) {
		$_product = $val['data'];
		array_push($cartarray,$_product->id);
	}
	$result = !empty(array_intersect( $cartarray, $arr_product_id ));
	return $result;
}


/**
 * Get product link for customization by category id for ajax
 * */
add_action( 'wp_ajax_get_product_link_by_cat_id', 'kt_get_product_link_by_cat_id_callback' );
add_action( 'wp_ajax_nopriv_get_product_link_by_cat_id', 'kt_get_product_link_by_cat_id_callback' );
function kt_get_product_link_by_cat_id_callback() {
	check_ajax_referer( 'wp_rest', 'nonce_rest' );
	$product_cat_id = isset( $_POST['product_cat_id'] ) ? intval($_POST['product_cat_id']) : 0;
	echo get_default_product_link_by_cat_id( $product_cat_id );
	exit();
}

/**
 * Change product title by wp-json
 * */
add_action( 'wp_ajax_kt_edit_product_title', 'kt_edit_product_title_callback' );
add_action( 'wp_ajax_nopriv_kt_edit_product_title', 'kt_edit_product_title_callback' );
function kt_edit_product_title_callback() {
	check_ajax_referer( 'wp_rest', 'nonce_rest' );

	$product_id = isset( $_POST['product_id'] ) ? intval($_POST['product_id']) : '';
	$product_title = isset( $_POST['product_title'] ) ? $_POST['product_title'] : '';

	$store_url = site_url();
	$endpoint_request = 'products/'.$product_id;

	$product_slug = slugify($product_title);
	$product_link = $store_url . '/product/' . $product_slug;

	$kt_woocommerce = kt_get_woo_api();

	if ( $product_title && $product_id ) {
	 $data = [
		 'name' => $product_title,
		 'slug' => $product_slug,
		 'permalink' => $product_link
	 ];
		$kt_woocommerce->put( $endpoint_request, $data );
	}
	echo $product_link;

	exit();
}

function ktwc_copy_default_to_customized_product( $customize_product_id, $default_product_id ) {

	if ( $customize_product_id && $default_product_id ) {
		$kt_woocommerce = kt_get_woo_api();
		$new_product_data = json_decode(json_encode($kt_woocommerce->get( 'products/'.$customize_product_id ) ), true);
		$defult_product_data = json_decode(json_encode($kt_woocommerce->get( 'products/'.$default_product_id )), true);
		$defult_product_data_sku = $defult_product_data['sku'];
		unset($defult_product_data['id']);
		unset($defult_product_data['name']);
		unset($defult_product_data['slug']);
		unset($defult_product_data['permalink']);
		unset($defult_product_data['sku']);
		unset($defult_product_data['date_created']);
		unset($defult_product_data['date_created_gmt']);
		unset($defult_product_data['date_modified']);
		unset($defult_product_data['date_modified_gmt']);
		$product_data = array_merge( $new_product_data, $defult_product_data );
		$product_data['sku'] = $defult_product_data_sku.'-KD-'.$customize_product_id;
		return $product_data;
	}

}

add_action( 'wp_ajax_kt_create_product_customize', 'kt_create_product_customize_callback' );
add_action( 'wp_ajax_nopriv_kt_create_product_customize', 'kt_create_product_customize_callback' );
function kt_create_product_customize_callback() {
	check_ajax_referer( 'wp_rest', 'nonce_rest' );

	$default_product_id = isset( $_POST['default_prod_id'] ) ? intval($_POST['default_prod_id']) : 0;
//	var_dump($default_product_id);
	if ( $default_product_id ) {
		$kt_woocommerce = kt_get_woo_api();
		$data = [
			'name' => 'New Product',
			'type' => 'simple',
			'status' => 'publish',
		];
		$new_product = $kt_woocommerce->post( 'products', $data);
		$new_product_id = $new_product->id;
		update_post_meta( $new_product_id, 'super_product', false );
	  $customize_data = ktwc_copy_default_to_customized_product( $new_product_id, $default_product_id );
	  if ( $customize_data ) {
	/*  	echo '<pre>';
	  	var_dump($customize_data);
	  	echo '</pre>';*/

		  $customize_product = $kt_woocommerce->put( 'products/'.$new_product_id, $customize_data );

		  if ( $customize_product ) {
			  //$is_super = get_product_tab_meta('super_product', $product_id);
			  update_post_meta( $customize_product->id, 'super_product', false );
			  //	$product_object = wc_get_product( $product_id );
			  //	 var_dump($customize_product);
			  $arr_params = array(
				  'new_product' => true
			  );
			  $customize_link = add_query_arg( $arr_params, $customize_product->permalink );

			  $json_arr = array(
				  'new_product_id' => $customize_product->id,
				  'new_product_link' => $customize_link
			  );
			  echo json_encode($json_arr);
		  }

	  }

	}
	exit();
}

function Generate_Featured_Image( $image_url, $post_id  ) {
	$upload_dir = wp_upload_dir();
	$image_data = file_get_contents($image_url);
	$filename = basename($image_url);
	if(wp_mkdir_p($upload_dir['path']))
		$file = $upload_dir['path'] . '/' . $filename;
	else
		$file = $upload_dir['basedir'] . '/' . $filename;
	file_put_contents($file, $image_data);

	$wp_filetype = wp_check_filetype($filename, null );
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => sanitize_file_name($filename),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	$res1= wp_update_attachment_metadata( $attach_id, $attach_data );
	$res2= set_post_thumbnail( $post_id, $attach_id );
}

/**
 * Create new product title by wp-json
 * */
add_action( 'wp_ajax_kt_create_product_title', 'kt_create_product_title_callback' );
add_action( 'wp_ajax_nopriv_kt_create_product_title', 'kt_create_product_title_callback' );
function kt_create_product_title_callback() {
	check_ajax_referer( 'wp_rest', 'nonce_rest' );

	 //$default_product_id = isset( $_POST['product_id'] ) ? $_POST['product_id'] : 0;
	 $custom_product_id = isset( $_POST['product_id'] ) ? intval($_POST['product_id']) : 0;
	 $form_param = isset( $_POST['form_param'] ) ? $_POST['form_param'] : '';
	 $canvas_svg_thumb = isset( $_POST['canvas_thumb'] ) ? $_POST['canvas_thumb'] : ''; // png for thumbnail

	 $product_title = $form_param['create_product_title'];
	 $canvas_svg_url = isset( $_POST['canvas_svg_url_data'] ) ? $_POST['canvas_svg_url_data'] : '';

		$store_url = site_url();
		$product_slug = slugify($product_title);
		$product_link = $store_url . '/product/' . $product_slug;
		$endpoint_request = 'products/'.$custom_product_id;

	 if ( $custom_product_id && $product_title ) {

		 if ( is_string($canvas_svg_url) ){
			// $filename = $product_slug.'_'.date('d-M-Y').'_'.rand(1, 9999999).'.png';
			 $filename = $product_slug.'_'.$custom_product_id.'.png';

			 //path where you want to upload image
			 $uploads_dir = ktwc_upload_dir('dir') . '/ktwc_product_png/';
			 $uploads_url = ktwc_upload_dir('url') . '/ktwc_product_png/';
			 $filepath = wp_normalize_path(  trailingslashit($uploads_dir) . $filename );

			 // Creating directory and htaccess file

			 if( !file_exists( $uploads_dir ) ){
				 wp_mkdir_p( $uploads_dir );
			 }
			 // Save file

			 if (  is_string($canvas_svg_thumb) ) {
				 $img_svg = str_replace('data:image/png;base64,', '', $canvas_svg_thumb);
				 $img_svg2 = str_replace(' ', '+', $img_svg);
				 $svg_data = base64_decode($img_svg2);
				 $filename_svg = $product_slug.'_'.$custom_product_id.'-thumb.png';
				 $filepath_svg = wp_normalize_path(  trailingslashit($uploads_dir) . $filename_svg );
				 if (!file_exists($filepath_svg)) {
					 file_put_contents($filepath_svg, $svg_data);
					 $fileurl_svg = trailingslashit($uploads_url) . $filename_svg;
					 Generate_Featured_Image( $fileurl_svg, $custom_product_id  );
				 } elseif (file_exists($filepath_svg)) {
					 wp_delete_file_from_directory( $filename_svg, $uploads_dir );
					 file_put_contents($filepath_svg, $svg_data);
					 $fileurl_svg = trailingslashit($uploads_url) . $filename_svg;
					 Generate_Featured_Image( $fileurl_svg, $custom_product_id  );
				 }
			 }


			 $img = str_replace('data:image/png;base64,', '', $canvas_svg_url);
			 $img2 = str_replace(' ', '+', $img);
			 $data = base64_decode($img2);
			 if (!file_exists($filepath)) {
				 file_put_contents($filepath, $data);
				 $fileurl = trailingslashit($uploads_url) . $filename;
				 update_post_meta( $custom_product_id, '_png_image_coord_real', $fileurl );
				// echo $fileurl;
			 } elseif (file_exists($filepath)) {
				 wp_delete_file_from_directory( $filename, $uploads_dir );
				 file_put_contents($filepath, $data);
				 $fileurl = trailingslashit($uploads_url) . $filename;
				 update_post_meta( $custom_product_id, '_png_image_coord_real', $fileurl );
			 } else {
				 error_log("Cannot create signature file : ".$filepath);
			 }
		 }



		 $kt_woocommerce = kt_get_woo_api();

		 $data = [
			 'name' => $product_title,
			 'slug' => $product_slug,
			 'permalink' => $product_link,
			 'status' => 'publish'
		 ];
		 $kt_woocommerce->put( $endpoint_request, $data );
		 echo $product_link;
	 }

	exit();
}

function convert_mm_to_px($v) {
	// 1 mm = 3.779528 px
	return ($v * 3.779527559055);
}

/**
 * Cancel created new product and redirect to the shop page
 * */
add_action( 'wp_ajax_kt_close_product_go_back', 'kt_close_product_go_back_callback' );
add_action( 'wp_ajax_nopriv_kt_close_product_go_back', 'kt_close_product_go_back_callback' );
function kt_close_product_go_back_callback() {
	check_ajax_referer( 'wp_rest', 'nonce_rest' );
	 $shop_link = esc_url( wc_get_page_permalink( 'shop' ) );

	 $product_id = isset( $_POST['product_id'] ) ? intval($_POST['product_id']) : '';
	 $is_edit_product = isset( $_POST['is_edit_product'] ) ? $_POST['is_edit_product'] : '';
	 $is_new_product = isset( $_POST['is_new_product'] ) ? $_POST['is_new_product'] : '';
	 if ( $product_id && $is_new_product >= 0 ) {
		 $endpoint_request = 'products/'.$product_id;
		 $kt_woocommerce = kt_get_woo_api();
		 $kt_woocommerce->delete($endpoint_request, ['force' => false]);
		 echo $shop_link;
	 } elseif ( $product_id && $is_edit_product >= 0 ) {
		 $product_link = esc_url( get_permalink( $product_id ) );
		 echo $product_link;
	 } else {
		 echo $shop_link;
	 }


	exit();
}

/**
 * Create new tax for customize attribute for each product
 * */
add_action( 'woocommerce_after_register_taxonomy', 'ktwc_register_attribute' );
function ktwc_register_attribute(){
	create_product_attribute('Background');
	create_product_attribute('Graphic');
	create_product_attribute('Peripherals');
}

function ktwc_generate_html_prod_attr_acf( $attr_tax_name, $product_attributes ) {
	if ( $attr_tax_name && $product_attributes ) :
		$tax_pa_name = $product_attributes[$attr_tax_name];
		$is_peripherals = $attr_tax_name === 'pa_peripherals' ? true : false;
		$is_peripherals_class = $is_peripherals ? 'is_peripherals' : '';
	?>
		<div class="term-attr-items">
			<?php foreach ( $tax_pa_name['options'] as $term_id ) :
				$trem_obj = get_term_by('id', $term_id, $attr_tax_name);
				$term_img_id = get_field('attribute_image', 'term_'.$term_id);
				$peripherals_img_id = get_field('peripherals_img', 'term_'.$term_id);
				$peripherals_img_url = wp_get_attachment_image_url( $peripherals_img_id, 'full' );
				$term_img_url = wp_get_attachment_image_url( $term_img_id, 'full' );
				$is_hierarchical = get_field('is_hierarchical', 'term_'.$term_id);
				$hierarchical_attributes = get_field('hierarchical_attributes', 'term_'.$term_id);
				$term_name = $trem_obj->name;
				$term_slug = $trem_obj->slug;
				?>
				<div class="term-attr-item <?php echo $is_hierarchical? 'is_hierarchical':''; echo $is_peripherals_class; ?>"
				     data-attr_term_id="<?php echo $term_id; ?>"
				     data-attr_term_slug="<?php echo $term_slug; ?>"
					<?php
					echo !$is_hierarchical ? 'data-attr_image_url="'.$term_img_url.'"':'';
					echo !$is_hierarchical ? 'data-cache_key=""':'';
					echo $is_peripherals ? 'data-peripherals_img="'.$peripherals_img_url.'"' : '';
					?>>
					<div class="term-thumb">
						<img src="<?php echo $term_img_url; ?>" alt="<?php echo $term_name; ?>" loading="lazy">
					</div>
					<span class="term-label"><?php echo $term_name; ?></span>
				</div>

				<?php if( $is_hierarchical && !$is_peripherals ) : ?>
					<div id="<?php echo $term_slug; ?>" class="term-child-attr-items-wrap">
						<a href="#" class="prev-attr-btn woo-btn">
							<svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M9.70711 1.29289C9.31658 0.902369 8.68342 0.902369 8.29289 1.29289L1.29289 8.29289C0.902369 8.68342 0.902369 9.31658 1.29289 9.70711L8.29289 16.7071C8.68342 17.0976 9.31658 17.0976 9.70711 16.7071C10.0976 16.3166 10.0976 15.6834 9.70711 15.2929L3.41421 9L9.70711 2.70711C10.0976 2.31658 10.0976 1.68342 9.70711 1.29289Z" fill="#58448B"/>
							</svg>
							<?php echo $term_name; ?>
						</a>
						<div class="term-child-attr-items">
							<?php foreach ( $hierarchical_attributes as $key => $children ) :
								$ch_image_id = $children['sub_attribute_image'];
								$ch_label = $children['sub_attribute_label'];
								$ch_img_url = wp_get_attachment_image_url( $ch_image_id, 'full' );
								?>
								<div class="term-attr-item "
								     data-cache_key=""
								     data-attr_image_id="<?php echo $ch_image_id; ?>"
								     data-attr_image_url="<?php echo $ch_img_url; ?>">
									<div class="term-thumb">
										<img src="<?php echo $ch_img_url; ?>" alt="<?php echo $ch_label; ?>" loading="lazy">
									</div>
									<span class="term-label"><?php echo $ch_label; ?></span>
								</div>

							<?php endforeach; ?>
						</div>

					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	<?php
	endif;
}

/*
 * Remove New Customize Product from Server every 10 min use WP Cron
 * */

// register the 10 minute interval for cron event
add_filter( 'cron_schedules', 'cron_add_3_hour' );
function cron_add_3_hour( $schedules ) {
	$schedules['3_hour'] = array(
		'interval' => 60 * 60 * 3,
		'display' => 'Every 3 hour'
	);
	return $schedules;
}
// remove cron task
//wp_clear_scheduled_hook( 'ktwc_remove_cutomize_product_event' );
// adds new cron task
add_action( 'init', 'ktwc_cron' );
function ktwc_cron() {
	//kt_delete_product(568, true);
	if( ! wp_next_scheduled( 'ktwc_remove_cutomize_product_event' ) ) {
		wp_schedule_event( time(), '3_hour', 'ktwc_remove_cutomize_product_event');
	}
}

// add function to specified cron hook
add_action( 'ktwc_remove_cutomize_product_event', 'ktwc_remove_customize_action' );
function ktwc_remove_customize_action(){
	$empty_title = 'New Product';
	$args = array(
		'numberposts' => -1,
		'post_status' => 'publish'
	);
	$_products = wc_get_products( $args );

   foreach ( $_products as $product ) {
	   $product_id = $product->get_id();
	   $product_name = $product->name;
	   $product_status = $product->status;
	   $is_super_product = $product->get_meta( 'super_product' );
	   if ( $product_name == $empty_title && $is_super_product !== 'yes'  )  {  /*$product_status == 'draft'*/
		   kt_delete_product($product_id); // if force, you can add ==> true after ','
	   }
   }

}
















