<?php
/**
 * News post_type --> post
 * */

// create a new column
add_filter('manage_post_posts_columns', 'posts_column', 4);
function posts_column( $columns ){
	unset($columns['author']); // delete the column Author
	$num = 2; // after which column under the account to insert new
	$new_columns = array(
		'likes_counted' => __('Count of Likes')
	);
	return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );

}
// adjust the width of the column via css
add_action('admin_head', 'post_column_css');
function post_column_css(){
	if( get_current_screen()->base == 'edit')
		echo '<style type="text/css">.column-likes_counted{width:7%;}</style>';
}
// fill the column with data
add_filter('manage_post_posts_custom_column', 'fill_posts_column', 5, 2);
// wp-admin/includes/class-wp-posts-list-table.php
function fill_posts_column( $colname, $post_id ){
	global $post;
	$total_liked = get_total_liked( $post->ID );
	if( $colname === 'likes_counted' ){
		echo $total_liked ? $total_liked : 0;
	}

}
