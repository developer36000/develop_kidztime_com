<?php
global $post;
$post_id = $post->ID;

if( get_row_layout() == 'goal_section' ): ?>

	<!-- Goal Section Section -->
	<?php get_template_part( 'template-parts/part', 'goal_section' ); ?>
	<!-- End Goal Section Section -->

<?php elseif( get_row_layout() == 'simple_title_text_section' ): ?>

	<!-- Simple Title+Text Section -->
	<?php get_template_part( 'template-parts/part', 'simple_text_section' ); ?>
	<!-- End Simple Title+Text Section -->

<?php elseif( get_row_layout() == 'why_section' ): ?>

	<!-- Why Section -->
	<?php get_template_part( 'template-parts/part', 'why_section' ); ?>
	<!-- End Why Section -->

<?php endif; ?>
