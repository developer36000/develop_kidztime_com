<?php
/**
 * Register widget areas
 */
if ( ! function_exists( 'kt_sidebar_widgets' ) ) :

	add_action( 'widgets_init', 'kt_sidebar_widgets' );
	function kt_sidebar_widgets() {
		$sidebar_args = array(
			'id'            => 'sidebar-widgets',
			'name'          => __( 'Sidebar widgets', 'foundationpress' ),
			'description'   => __( 'Drag widgets to this sidebar container.', 'foundationpress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6>',
			'after_title'   => '</h6>',
		);
		register_sidebar( $sidebar_args );

		$footer_sidebar_args = array(
			'id'            => 'footer-widgets',
			'name'          => __( 'Footer widgets', 'foundationpress' ),
			'description'   => __( 'Drag widgets to this footer container', 'foundationpress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6>',
			'after_title'   => '</h6>',
		);
		register_sidebar( $footer_sidebar_args );

		$mobile_header_sidebar_args = array(
			'id'            => 'header-widgets',
			'name'          => __( 'Mobile Header widgets', 'foundationpress' ),
			'description'   => __( 'Drag widgets to this header container', 'foundationpress' ),
			'before_widget' => '<div id="%1$s" class="widget widget-header %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6>',
			'after_title'   => '</h6>',
		);

		register_sidebar( $mobile_header_sidebar_args );

	} // end kt_sidebar_widgets

endif;

/**
 * Create custom widgets
 * */
require_once( 'widgets/KTWidgetSocials.php' );

if ( ! function_exists( 'kt_widget_func' ) ) :

add_action( 'widgets_init', 'kt_widget_func' );
function kt_widget_func() {
	register_widget( 'KTWidgetSocials' );
}

endif;


