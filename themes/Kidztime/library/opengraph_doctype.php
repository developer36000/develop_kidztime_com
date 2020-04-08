<?php
/**
 * Simple SEO class to create page metatags: title, description, robots, keywords, Open Graph.
 *
 * @author Kama
 * @version 1
 */
class CA_SEO_Tags {

	function __construct(){}

	static function init(){

		// remove basic title call
		remove_action( 'wp_head', '_wp_render_title_tag', 1 );
		add_action( 'wp_head', [ __CLASS__, 'render_seo_tags' ], 1 );
	}

	static function render_seo_tags(){
		//remove_theme_support( 'title-tag' ); // not necessary

		echo '<title>'. self::meta_title(' — ') .'</title>'."\n\n";

		echo self::meta_description();
		echo self::meta_keywords();
		echo self::meta_robots('cpage');

		echo self::og_meta(); // Open Graph, twitter datas
	}

	/**
	 * Open Graph, twitter data in `<head>`.
	 *
	 * See docs: http://ogp.me/
	 *
	 * @version 8
	 */
	static function og_meta(){

		$obj = get_queried_object();

		if( isset($obj->post_type) )   $post = $obj;
		elseif( isset($obj->term_id) ) $term = $obj;

		$is_post = isset( $post );
		$is_term = isset( $term );

		$title = self::meta_title( '–' );
		$desc  = preg_replace( '/^.+content="([^"]*)".*$/s', '$1', self::meta_description() );

		// Open Graph
		$els = [];
		$els['og:locale']      = '<meta property="og:locale" content="'     . get_locale()                           .'" />';
		$els['og:site_name']   = '<meta property="og:site_name" content="'  . esc_attr( get_bloginfo('name') )       .'" />';
		$els['og:title']       = '<meta property="og:title" content="'      . esc_attr( $title )                     .'" />';
		$els['og:description'] = '<meta property="og:description" content="'. esc_attr( $desc )                      .'" />';
		$els['og:type']        = '<meta property="og:type" content="'       .( is_singular() ? 'article' : 'object' ).'" />';

		if( $is_post ) $pageurl = get_permalink( $post );
		if( $is_term ) $pageurl = get_term_link( $term );
		if( isset($pageurl) )
			$els['og:url'] = '<meta property="og:url" content="'. esc_attr( $pageurl ) .'" />';

		/**
		 * Allow to disable `article:section` property.
		 *
		 * @param bool $is_on
		 */
		if( apply_filters( 'kama_og_meta_show_article_section', true ) ){

			if( is_singular() && $post_taxname =  get_object_taxonomies($post->post_type) ){

				$post_terms = get_the_terms( $post, reset($post_taxname) );
				if( $post_terms && $post_term = array_shift($post_terms) )
					$els['article:section'] = '<meta property="article:section" content="'. esc_attr( $post_term->name ) .'" />';
			}
		}

		// image
		if( 'image' ){

			$fn__get_thumb_id_from_text = function( $text ){
				if(
					preg_match( '/<img +src *= *[\'"]([^\'"]+)[\'"]/', $text, $mm ) &&
					( $mm[1]{0} === '/' || strpos($mm[1], $_SERVER['HTTP_HOST']) )
				){
					$name = basename( $mm[1] );
					$name = preg_replace('~-[0-9]+x[0-9]+(?=\..{2,6})~', '', $name ); // delete the size (-80x80)
					$name = preg_replace('~\.[^.]+$~', '', $name );                   // delete the extension
					$name = sanitize_title( sanitize_file_name( $name ) );            // bring to standard form

					global $wpdb;
					$thumb_id = $wpdb->get_var(
						$wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = 'attachment'", $name )
					);
				}

				return empty($thumb_id) ? 0 : $thumb_id;
			};

			$thumb_id = 0;
			if( $is_post ){

				if( ! $thumb_id = get_post_thumbnail_id( $post ) ){

					/**
					 * Allows to turn off the image search in post content.
					 *
					 * @param bool $is_on
					 */
					if( apply_filters( 'kama_og_meta_thumb_id_find_in_content', true ) ){

						if( ! $thumb_id = $fn__get_thumb_id_from_text( $post->post_content ) ) {
							// первое вложение поста
							$attach = get_children(
								[ 'numberposts'=>'1', 'post_mime_type'=>'image', 'post_type'=>'attachment', 'post_parent'=>$post->ID ]
							);
							if( $attach && $attach = array_shift( $attach ) )
								$thumb_id = $attach->ID;
						}
					}
				}
			}
			elseif( $is_term ){
				if( ! $thumb_id = get_term_meta( $term->term_id, '_thumbnail_id', 1 ) ){
					$thumb_id = $fn__get_thumb_id_from_text( $term->description );
				}
			}

			/**
			 * Allow to set custom `og:image` data (URL).
			 *
			 * @param int|string|array  $thumb_id  Attachment ID. Image URL. Array of [ image_url, width, height ].
			 */
			$thumb_id = apply_filters( 'kama_og_meta_thumb_id', $thumb_id );

			if( $thumb_id ){

				if( is_numeric($thumb_id) )
					list( $image_url, $img_width, $img_height ) = image_downsize( $thumb_id, 'full' );
				elseif( is_array($thumb_id) )
					list( $image_url, $img_width, $img_height ) = $thumb_id;
				else
					$image_url = $thumb_id;

				// Open Graph image
				$els['og:image'] = '<meta property="og:image" content="'. esc_url($image_url) .'" />';
				if( isset($img_width) )
					$els['og:image:width']  = '<meta property="og:image:width" content="'. (int) $img_width .'" />';
				if( isset($img_height) )
					$els['og:image:height'] = '<meta property="og:image:height" content="'. (int) $img_height .'" />';
			}

		}

		// twitter
		$els['twitter:card']        = '<meta name="twitter:card" content="summary" />';
		$els['twitter:description'] = '<meta name="twitter:description" content="'. esc_attr( $desc ) .'" />';
		$els['twitter:title']       = '<meta name="twitter:title" content="'. esc_attr( $title ) .'" />';
		if( isset($image_url) )
			$els['twitter:image'] = '<meta name="twitter:image" content="'. esc_url($image_url) .'" />';

		/**
		 * Filter resulting properties. Allows to add or remove any og/twitter properties.
		 *
		 * @param array  $els
		 */
		$els = apply_filters( 'kama_og_meta_elements', $els );

		return "\n\n". implode("\n", $els ) ."\n\n";
	}

	/**
	 * Print page title <title>
	 *
	 * For tags and categories it is indicated in the settings, in the description: [title = Title].
	 * For posts, if you want the page title to be different from the title of the post,
	 * create an arbitrary title field and enter an arbitrary title there.
	 *
	 * @version 4.9
	 *
	 * @param string $ sep delimiter
	 * @param true | false $ add_blog_name whether to add the name of the blog to the end of the header for archives.
	 */
	static function meta_title( $sep = '»', $add_blog_name = true ){
		static $cache; if( $cache ) return $cache;

		global $post;

		$l10n = apply_filters( 'kama_meta_title_l10n', array(
			'404'     => __('Error 404: such page does not exist'),
			'search'  => __('Результаты поиска по запросу:')." %s",
			'compage' => __('Comments')." %s",
			'author'  => __('Articles of the author:')." %s",
			'archive' => __('Archive for'),
			'paged'   => __('(page')." %d)",
		) );

		$parts = array(
			'prev'  => '',
			'title' => '',
			'after' => '',
			'paged' => '',
		);
		$title = & $parts['title']; // simplify
		$after = & $parts['after']; // simplify

		if(0){}
		// 404
		elseif ( is_404() ){
			$title = $l10n['404'];
		}
		// search
		elseif ( is_search() ){
			$title = sprintf( $l10n['search'], get_query_var('s') );
		}
		// home
		elseif( is_front_page() ){
			if( is_page() && $title = get_post_meta( $post->ID, 'title', 1 ) ){
				//  $title defined
			} else {
				$title = get_bloginfo('name');
				$after = get_bloginfo('description');
			}
		}
		// separate page
		elseif( is_singular() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) ){
			$title = get_post_meta( $post->ID, 'title', 1 ); // specified title for priority entry

			if( ! $title ) $title = apply_filters( 'kama_meta_title_singular', '', $post );
			if( ! $title ) $title = single_post_title( '', 0 );

			if( $cpage = get_query_var('cpage') )
				$parts['prev'] = sprintf( $l10n['compage'], $cpage );
		}
		// post type archive
		elseif ( is_post_type_archive() ){
			$title = post_type_archive_title('', 0 );
			$after = 'blog_name';
		}
		// taxonomy
		elseif( is_category() || is_tag() || is_tax() ){
			$term = get_queried_object();

			$title = get_term_meta( $term->term_id, 'title', 1 );

			if( ! $title ){
				$title = single_term_title('', 0 );

				if( is_tax() )
					$parts['prev'] = get_taxonomy($term->taxonomy)->labels->name;
			}

			$after = 'blog_name';
		}
		// author archive
		elseif ( is_author() ){
			$title = sprintf( $l10n['author'], get_queried_object()->display_name );
			$after = 'blog_name';
		}
		// date archive
		elseif ( ( get_locale() === 'ru_RU' ) && ( is_day() || is_month() || is_year() ) ){
			$rus_month  = array('', 'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');
			$rus_month2 = array('', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
			$year       = get_query_var('year');
			$monthnum   = get_query_var('monthnum');
			$day        = get_query_var('day');

			if( is_year() )      $dat = "$year год";
			elseif( is_month() ) $dat = "$rus_month[$monthnum] $year года";
			elseif( is_day() )   $dat = "$day $rus_month2[$monthnum] $year года";

			$title = sprintf( $l10n['archive'], $dat );
			$after = 'blog_name';
		}
		// other archives
		else {
			$title = get_the_archive_title();
			$after = 'blog_name';
		}

		// page numbers for pagination and division
		$pagenum = get_query_var('paged') ?: get_query_var('page');
		if( $pagenum )
			$parts['paged'] = sprintf( $l10n['paged'], $pagenum );

		// allows you to filter the title as you like. The title itself
		// $ parts contains an array with elements: prev - text before, title - title, after - text after
		$parts = apply_filters_ref_array( 'kama_meta_title_parts', array($parts, $l10n) );

		if( $after == 'blog_name' )
			$after = $add_blog_name ? get_bloginfo('name') : '';

		// add pagination to title
		if( $parts['paged'] ){
			$parts['title'] .=  " {$parts['paged']}";
			unset( $parts['paged'] );
		}

		$title = implode( ' '. trim($sep) .' ', array_filter($parts) );

		$title = apply_filters( 'kama_meta_title', $title );

		$title = wptexturize( $title );
		$title = esc_html( $title );

		return $cache = $title;
	}

	/**
	 * Displays the description meta tag.
	 *
	 * For elements of taxonomies: meta description field or description such a shortcode [description = description text]
	 * For posts, it is first checked whether the meta description field, or quote, or the initial part of the content.
	 * Quote or content is truncated to the specified in $ maxchar characters.
	 *
	 * @param string $ home_description The description for the main page of the site is indicated.
	 * @param int $ maxchar Maximum description length (in characters).
	 *
	 * @version 2.2.2
	 */
	static function meta_description( $home_description = '', $maxchar = 260 ){
		static $cache; if( $cache ) return $cache;

		global $post;

		$cut   = true;
		$desc  = '';

		// front
		if( is_front_page() ){
			// When the main page is set
			if( is_page() && $desc = get_post_meta($post->ID, 'description', true )  ){
				$cut = false;
			}

			if( ! $desc )
				$desc = $home_description ?: get_bloginfo( 'description', 'display' );
		}
		// singular
		elseif( is_singular() ){
			if( $desc = get_post_meta($post->ID, 'description', true ) )
				$cut = false;

			if( ! $desc ) $desc = $post->post_excerpt ?: $post->post_content;

			$desc = trim( strip_tags( $desc ) );
		}
		// term
		elseif( is_category() || is_tag() || is_tax() ){
			$term = get_queried_object();

			$desc = get_term_meta( $term->term_id, 'meta_description', true );
			if( ! $desc )
				$desc = get_term_meta( $term->term_id, 'description', true );

			$cut = false;
			if( ! $desc && $term->description ){
				$desc = strip_tags( $term->description );
				$cut = true;
			}
		}

		$origin_desc = $desc;

		if( $desc = apply_filters( 'kama_meta_description_pre', $desc ) ){

			$desc = str_replace( array("\n", "\r"), ' ', $desc );
			$desc = preg_replace( '~\[[^\]]+\](?!\()~', '', $desc ); // delete shortcodes. Leave the markdown [foo] (URL)

			if( $cut ){
				$char = mb_strlen( $desc );
				if( $char > $maxchar ){
					$desc     = mb_substr( $desc, 0, $maxchar );
					$words    = explode(' ', $desc );
					$maxwords = count($words) - 1; // remove the last word, it is 90% incomplete
					$desc     = join(' ', array_slice($words, 0, $maxwords)).' ...';
				}
			}

			$desc = preg_replace( '/\s+/s', ' ', $desc );
		}

		if( $desc = apply_filters( 'kama_meta_description', $desc, $origin_desc, $cut, $maxchar ) )
			return $cache = '<meta name="description" content="'. esc_attr( trim($desc) ) .'" />'."\n";

		return $cache = '';
	}

	/**
	 * Meta tag robots
	 *
	 * To set your meta tag attributes for robots entries, create an arbitrary field with the robots key
	 * and necessary value, for example: noindex, nofollow
	 *
	 * Specify the $ allow_types parameter to allow indexing of page types.
	 *
	 * @ $ allow_types What types of pages to index (comma separated):
	 * cpage, is_category, is_tag, is_tax, is_author, is_year, is_month,
	 * is_attachment, is_day, is_search, is_feed, is_post_type_archive, is_paged
	 * (you can use any conditional tags as a string)
	 * cpage - comment pages
	 * @ $ robots How to close indexing: noindex, nofollow
	 *
	 * version 0.8
	 */
	static function meta_robots( $allow_types = null, $robots = 'noindex,nofollow' ){
		global $post;

		if( null === $allow_types )
			$allow_types = 'cpage, is_attachment, is_category, is_tag, is_tax, is_paged, is_post_type_archive';

		if( ( is_home() || is_front_page() ) && ! is_paged() )
			return '';

		if( is_singular() ){
			// if it is not an attachment or an attachment but it is allowed
			if( ! is_attachment() || false !== strpos($allow_types,'is_attachment') )
				$robots = get_post_meta( $post->ID, 'robots', true );
		}
		else {
			$types = preg_split('~[, ]+~', $allow_types );
			$types = array_filter( $types );

			foreach( $types as $type ){
				if( $type == 'cpage' && strpos($_SERVER['REQUEST_URI'], '/comment-page') ) $robots = false;
				elseif( function_exists($type) && $type() )                                $robots = false;
			}
		}

		$robots = apply_filters( 'kama_meta_robots_close', $robots );

		return $robots ? "<meta name=\"robots\" content=\"$robots\" />\n" : '';
	}

	/**
	 * Generates a keywords meta tag for the head part of the page.
	 *
	 * To set your keywords for the entry, create an arbitrary keywords field and enter the necessary keywords in the values.
	 * For posts, keywords are generated from tags and category names, unless an arbitrary keywords field is specified.
	 *
	 * For tags,
	categories and arbitrary taxonomies, keywords are indicated in the description, in the shortcode: [keywords = word1, word2, word3]
	 *
	 * @ $ home_keywords: For the main one, keywords are specified in the first parameter: meta_keywords ('word1, word2, word3');
	 * @ $ def_keywords: pass-through keywords -
	specify and they will be added to the rest on all pages
	 *
	 * version 0.8
	 */
	static function meta_keywords( $home_keywords = '', $def_keywords = '' ){
		global $post;

		$out = '';

		if ( is_front_page() ){
			$out = $home_keywords;
		}
		elseif( is_singular() ){
			$out = get_post_meta( $post->ID, 'keywords', true );

			// for posts, we indicate with the keys labels and categories, if no keys are specified in an arbitrary field
			if( ! $out && $post->post_type == 'post' ){
				$res = wp_get_object_terms( $post->ID, [ 'post_tag', 'category' ], [ 'orderby' => 'none' ] ); // we get categories and tags

				if( $res && ! is_wp_error($res) )
					foreach( $res as $tag )
						$out .= ", $tag->name";

				$out = ltrim( $out, ', ' );
			}
		}
		elseif ( is_category() || is_tag() || is_tax() ){
			$term = get_queried_object();

			// wp 4.4
			if( function_exists('get_term_meta') ){
				$out = get_term_meta( $term->term_id, "keywords", true );
			}
			else{
				preg_match( '!\[keywords=([^\]]+)\]!iU', $term->description, $match );
				$out = isset($match[1]) ? $match[1] : '';
			}
		}

		if( $out && $def_keywords )
			$out = $out .', '. $def_keywords;

		return $out ? "<meta name=\"keywords\" content=\"$out\" />\n" : '';
	}

}
CA_SEO_Tags::init();
