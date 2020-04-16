<?php
global $post;
$post_id = $post->ID;
$goal_title = get_sub_field('goal_title');
$goal_text = get_sub_field('goal_text');
?>
<div class="goal-section">
	<?php echo $goal_title ? ' <h2 class="goal-title">'.$goal_title.'</h2>' : ''; ?>
	<?php echo $goal_text ? ' <blockquote class="goal-text">'.$goal_text.'</blockquote>' : ''; ?>
</div>
