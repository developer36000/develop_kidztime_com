<?php
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

## Embedding (oEmbed) in the “Text” widget
global $wp_embed;
add_filter( 'widget_text', array( & $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( & $wp_embed, 'autoembed'), 8 );

## replace the word “posts” with “posts” for the post type
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
	// cannot be replaced automatically: Record = Article, and in the text we get "View article
	$new = array(
		'name'                  => __('Articles'),
		'singular_name'         => __('Article'),
		'add_new'               => __('Nouvel article'),
		'add_new_item'          => __('Ajouter article'),
		'edit_item'             => __('Modifier article'),
		'new_item'              => __('Nouvel article'),
		'view_item'             => __('Voir article'),
		'search_items'          => __('Rechercher articles'),
		'not_found'             => __('No posts found.'),
		'not_found_in_trash'    => __('No posts found in the cart.'),
		'parent_item_colon'     => '',
		'all_items'             => __('Tous les articles'),
		'archives'              => __('Archives of Articles'),
		'insert_into_item'      => __('Paste into post'),
		'uploaded_to_this_item' => __('Uploaded for this post'),
		'featured_image'        => __('The post miniature'),
		'filter_items_list'     => __('Filter the list of posts'),
		'items_list_navigation' => __('Navigating the list of posts'),
		'items_list'            => __('List of posts'),
		'menu_name'             => __('Articles'),
		'name_admin_bar'        => __('Article'), // the item "add"

	);

	return (object) array_merge( (array) $labels, $new );
}

function wpb_excerpt_allowedtags() {
	// Add custom tags to this string
	return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>';
}
function wpb_custom_wp_trim_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text, wpb_excerpt_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */
		//Set the excerpt word count and only break after sentence is complete.
		$excerpt_word_count = 35;
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
		$tokens = array();
		$excerptOutput = '';
		$count = 0;
		// Divide the string into tokens; HTML tags, or words, followed by any whitespace
		preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $text, $tokens);
		foreach ($tokens[0] as $token) {
			if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) {
				// Limit reached, continue until , ; ? . or ! occur at the end
				$excerptOutput .= trim($token);
				break;
			}
			// Add words to complete sentence
			$count++;
			// Append what's left of the token
			$excerptOutput .= $token;
		}
		$text = trim(force_balance_tags($excerptOutput));
		$excerpt_end = '';
		$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

		$text .= $excerpt_more; /*Add read more in new paragraph */
		return $text;
	}
	return apply_filters('wpse_custom_wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wpb_custom_wp_trim_excerpt');

function get_excerpt_trim($post_id = null, $num_words = 20, $more = '...'){
	global $post;
	$post_id = $post_id ? $post_id : $post->ID;
	$excerpt = get_the_excerpt( $post_id );
	$excerpt = wp_trim_words( $excerpt, $num_words , $more );
	return $excerpt;
}

/*div.wpcf7 .ajax-loader {
	display: none;
}*/
// Custom CF7 loading image
//add_filter('wpcf7_ajax_loader', 'my_wpcf7_ajax_loader');
function my_wpcf7_ajax_loader () {
	return  get_bloginfo('stylesheet_directory') . '/images/ajax-loader.gif';
}

/**
 * Removes tags and categories from blog posts
 */
//add_action( 'init', 'ca_unregister_tags' );
function ca_unregister_tags() {
	unregister_taxonomy_for_object_type( 'post_tag', 'post' );
	unregister_taxonomy_for_object_type( 'category', 'post' );
}

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

	// Check function exists.
	if( function_exists('acf_add_options_page') ) {

		// Register options page.
		$option_page = acf_add_options_page(array(
			'page_title'    => __('Theme General Settings'),
			'menu_title'    => __('Theme Settings'),
			'menu_slug'     => 'theme-general-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));
	}
}

/**
 * Add a custom comment class, based on a given comment author's user meta field.
 */
add_filter( 'comment_class', function( $classes, $class, $comment_id, $post_id ) {
	// Fetch the comment object:
	$comment = get_comment( $comment_id );
	if( $comment->user_id > 0 && $user = get_userdata( $comment->user_id ) && user_can( $comment->user_id, "administrator" ) ) {
		$classes[] = sanitize_html_class( 'posted-by-admin' );
	}
	return $classes;
}, 10, 4 );

function get_countries_select_list() {
	ob_start();
	$args = array(
		'taxonomy'      => array( 'category' ),
		'hide_empty'    => false,
		'orderby'       => 'name',
		'order'         => 'ASC',
	);
	$terms = get_terms( $args ); ?>
	<form action="/" method="post" class="article_select_box">
		<label for="article_select"><?php echo __('Categories'); ?></label>
		<div class="select-box">
			<select name="article_select" id="article_select">
				<option selected value="0"><?php echo __('TOUS LES ARTICLES'); ?></option>
				<?php foreach ( $terms as $term ) : ?>
					<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</form>

	<?php
	$article_select = ob_get_clean();
	return $article_select;
}


/**
 * Estimate time required to read the article
 *
 * @return string
 */
function bm_estimated_reading_time() {

	$post = get_post();

	$words = str_word_count( strip_tags( $post->post_content ) );
	$minutes = floor( $words / 120 );
	$seconds = floor( $words % 120 / ( 120 / 60 ) );

	if ( 1 <= $minutes ) {
		$estimated_time = $minutes . ' minutes de lecture';
		//$estimated_time .= ', ' . $seconds . ' second' . ($seconds == 1 ? '' : 's');
	} else {
		$estimated_time = $seconds . ' second de lecture';
	}

	return $estimated_time;

}





