<?php

if ( ! function_exists( 'foundationpress_gutenberg_support' ) ) :
	function foundationpress_gutenberg_support() {

    // Add foundation color palette to the editor
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'Primary Color', 'foundationpress' ),
            'slug' => 'primary',
            'color' => '#58448B',
        ),
        array(
            'name' => __( 'Secondary Color', 'foundationpress' ),
            'slug' => 'secondary',
            'color' => '#FF7071',
        ),
        array(
            'name' => __( 'Success Color', 'foundationpress' ),
            'slug' => 'success',
            'color' => '#3adb76',
        ),
        array(
            'name' => __( 'Warning color', 'foundationpress' ),
            'slug' => 'warning',
            'color' => '#ffae00',
        ),
        array(
            'name' => __( 'Alert color', 'foundationpress' ),
            'slug' => 'alert',
            'color' => '#cc4b37',
        )
    ) );

	}

	add_action( 'after_setup_theme', 'foundationpress_gutenberg_support' );
endif;


//add_action('acf/init', 'kt_acf_block_init');
function kt_acf_block_init() {
	// check function exists
	if( function_exists('acf_register_block') ) {
		// register a custom Page Title
		$kt_page_title_args = array(
			'name'            => 'testimonial',
			'title'           => __('Testimonial'),
			'description'     => __('A custom Testimonial block.'),
			'render_callback' => 'kt_acf_block_render_callback',
			'category'        => 'common',
			'icon'            => array(
				'background'  => '#58448B', // Specifying a background color to appear with the icon
				'foreground'  => '#fff', // Specifying a color for the icon
				'src'         => 'book-alt', // Specifying a dashicon for the block
			),
			'keywords'        => array( 'page_title', 'title', 'heading' ),
		);
		acf_register_block( $kt_page_title_args );

	}
}

function kt_acf_block_render_callback( $block ) {

	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/block/block-{$slug}.php") ) ) {
		include( get_theme_file_path("/template-parts/block/block-{$slug}.php") );
	}
}
