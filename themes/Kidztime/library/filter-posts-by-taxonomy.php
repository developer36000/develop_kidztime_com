<?php
add_action( 'wp_ajax_articles_cat_datas', 'articles_cat_datas_callback' );
add_action( 'wp_ajax_nopriv_articles_cat_datas', 'articles_cat_datas_callback' );
function articles_cat_datas_callback() {
	ob_start();
	check_ajax_referer( 'CAAjax-special-string', 'security' );
	$category_id = intval( $_POST['category_id'] );
	$page = $_POST['page'];
	$args = array(
		'posts_per_page' => 9,
		'paged'           => $page,
		'order'           => 'DESC',
		'orderby'         => 'date',
		'post_status'     => 'publish',
		'category__in'     => $category_id === 0 ? '' : $category_id,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
			get_template_part( 'template-parts/content', 'list' );
		endwhile;

		/* Display navigation to next/previous pages when applicable */
		vb_ajax_pager( $query, $page );
	endif;

	wp_reset_postdata();

	$articles_list = ob_get_clean();
	echo $articles_list;

	die(); // this is required to return a proper result
}


/**
 * Pagination
 */
function vb_ajax_pager( $query = null, $paged = 1 ) {
	if (!$query)
		return;

	$paginate = paginate_links([
		'base'      => '%_%',
		'type'      => 'array',
		'total'     => $query->max_num_pages,
		'format'    => '#page=%#%',
		'current'   => max( 1, $paged ),
		'prev_text' => '',
		'next_text' => '',
		'mid_size'  => 2,
		'end_size'  => 1,
	]);
	if ($query->max_num_pages > 1) : ?>
		<ul class="pagination article-custom-pagination">
			<?php foreach ( $paginate as $page ) :?>
				<li><?php echo $page; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif;
}
