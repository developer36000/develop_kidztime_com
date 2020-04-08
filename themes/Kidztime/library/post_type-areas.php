<?php
//add_action( 'init', 'create_post_type_and_taxonomy' );
function create_post_type_and_taxonomy() {

	register_post_type( 'oferta' , array(
		'label'  => null,
		'labels' => array(
			'name'               => __( 'Oferta' ),
			'singular_name'      => __( 'Oferta' ),
			'add_new'            => __( 'Add new item' ),
			'add_new_item'       => __( 'Add item' ),
			'edit_item'          => __( 'Edit item' ),
			'new_item'           => __( 'New item' ),
			'view_item'          => __( 'View item' ),
			'search_items'       => __( 'Search item' ),
			'not_found'          => __( 'Not found' ),
			'not_found_in_trash' => __( 'Not item in cart' ),
			'parent_item_colon'  => __( '' ),
			'menu_name'          => __( 'Oferta' ),
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => null,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => null,
		'show_in_rest'        => null,
		'rest_base'           => null,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-format-gallery',
		'capability_type'   => 'post',
		//'capabilities'      => 'post',
		//'map_meta_cap'      => null,
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'supports'            => array('title','editor','thumbnail','revisions','page-attributes', 'excerpt'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => array( 'oferta_type' ),
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	) );

	register_taxonomy( 'oferta_type', array( 'oferta' ), [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => __( 'Types' ),
			'singular_name'     => __( 'Type' ),
			'search_items'      => __( 'Search Type' ),
			'all_items'         => __( 'All Types' ),
			'view_item '        => __( 'View Type' ),
			'parent_item'       => __( 'Parent Type' ),
			'parent_item_colon' => __( 'Parent Type:' ),
			'edit_item'         => __( 'Edit Type' ),
			'update_item'       => __( 'Update Type' ),
			'add_new_item'      => __( 'Add New Type' ),
			'new_item_name'     => __( 'New Type' ),
			'menu_name'         => __( 'Types' ),
		],
		'description'           => '',
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_quick_edit'    => true,
		'hierarchical'          => true,
		'meta_box_cb'           => false,
		'rewrite'               => true,
		'capabilities'          => array(),
		'show_admin_column'     => true, // auto-create tax column in the table of the associated record type.
		// (from version 3.5)
		'show_in_rest'          => null, // add to REST API
		'rest_base'             => null, // $taxonomy
	] );

}
