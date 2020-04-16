<?php
global $post;
$post_id = $post->ID;
$simple_title = get_sub_field('simple_title');
$simple_text = get_sub_field('simple_text');
?>
<div class="simple-text-section">
	<?php echo $simple_title ? '<h2 class="simple-title">'.$simple_title.'</h2>' : ''; ?>
	<?php echo $simple_text ? '<div class="simple-text">'.$simple_text.'</div>' : ''; ?>
</div>
