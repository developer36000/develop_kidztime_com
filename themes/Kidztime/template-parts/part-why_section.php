<?php
global $post;
$post_id = $post->ID;
$why_title = get_sub_field('why_title');
?>
<div class="why-section">
	<?php echo $why_title ? ' <h2 class="why-title">'.$why_title.'</h2>' : ''; ?>

	<?php if( have_rows('why_items') ): ?>
		<div class="why_items">
			<?php $item_num = 0; while( have_rows('why_items') ): the_row();
				$image = get_sub_field('item_icon');
				$title = get_sub_field('item_title');
				$content = get_sub_field('item_description');
				?>

				<div class="why-item <?php echo 'why-item-'.$item_num; ?>">
					 <?php if( $image ) : ?>
						 <div class="why-item__img">
							 <img src="<?php echo $image ? $image : ''; ?>" loading="lazy"
							      alt="<?php echo $title ? $title : 'Icon'; ?>">
						 </div>
					 <?php endif; ?>
					<div class="why-item__content">
						<?php echo $title ? '	<h3 class="why-item__title">'.$title.'</h3>' : ''; ?>
						<?php echo $content ? '	<p class="why-item__text">'.$content.'</p>' : ''; ?>
					</div>
					<?php echo $content ? '	<p class="why-item__text mobile">'.$content.'</p>' : ''; ?>
				</div>
				<?php $item_num++; endwhile; ?>
		</div>
	<?php endif; ?>

</div>
