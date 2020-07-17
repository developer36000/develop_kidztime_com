<?php
if (!defined('kt_textdomain')) {
	define('kt_textdomain', 'kt_theme');
}
if (!defined('kt_meta_option')) {
	define('kt_meta_option', kt_textdomain . '_meta_option');
}
if (!defined('kt_img_base_path')) {
	define('kt_img_base_path', get_stylesheet_directory_uri() . '/dist/assets/images/');
}

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Custom posts types */
require_once( 'library/post_type-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Gutenberg editor support */
require_once( 'library/gutenberg.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );


/**
 * Custom Column for Post Types
 * */
include_once 'library/custom_posts_column.php';

/**
 * Adds thumbnails to the entry in the admin table array('post','page', 'team', 'portfolio', 'oferta')
 * */
include_once 'library/thumb_in_admin_column.php';

/**
 * Adds Thumbnails for taxonomy elements in the admin table
 * */
//include_once 'library/thumb_in_admin_taxonomy.php';

/**
 * Simple SEO class to create page metatags: title, description, robots, keywords, Open Graph.
 * */
include_once 'library/opengraph_doctype.php';

/**
 * Custom Hooks for Theme
 * */
include_once 'library/custom-hooks.php';

/*
 * Woocommerce Custom Hooks
 * */
include_once 'library/woo-custom-hooks.php';


