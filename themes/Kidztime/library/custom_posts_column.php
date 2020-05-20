<?php
/**
 * News post_type --> post
 * */


/**
 * Add a column with WooCommerce Billing Details to Users Admin Page
 * */
add_filter( 'manage_users_columns', 'ktwc_billing_address_column', 20 );
function ktwc_billing_address_column( $user_columns ) {
	return array_slice( $user_columns, 0, 3, true ) // 4 columns before
	       + array( 'billing_address' => 'Billing Address' ) // our column is 5th
	       + array_slice( $user_columns, 3, NULL, true );

}

add_filter( 'manage_users_custom_column', 'ktwc_populate_with_billing_address', 10, 3 );
function ktwc_populate_with_billing_address( $row_output, $user_column_name, $user_id ) {

	if( $user_column_name == 'billing_address' ) {
		$address = array();
		if( $billing_address_1 = get_user_meta( $user_id, 'billing_address_1', true ) )
			$address[] = $billing_address_1;

		if( $billing_address_2 = get_user_meta( $user_id, 'billing_address_2', true ) )
			$address[] = $billing_address_2;

		if( $billing_city = get_user_meta( $user_id, 'billing_city', true ) )
			$address[] = $billing_city;

		if( $billing_postcode = get_user_meta( $user_id, 'billing_postcode', true ) )
			$address[] = $billing_postcode;

		if( $billing_country = get_user_meta( $user_id, 'billing_country', true ) )
			$address[] = $billing_country;
		return join(', ', $address ); // here we replace and return our custom $row_output
	}
 return $row_output;
}

/**
 * Change style for user social login column
 * */
add_action('admin_head', 'ktwc_user_social_login_column_css');
function ktwc_user_social_login_column_css() {
	echo '<style type="text/css">
		.column-connections .user_table_social {
			display: flex;
	    width: 26px;
	    height: 26px;
	    background: #58448B;
	    border-radius: 50%;
	    align-items: center;
	    justify-content: center;
    }
	</style>';
}

