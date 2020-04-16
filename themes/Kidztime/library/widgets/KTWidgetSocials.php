<?php
// Creating the widget
class KTWidgetSocials extends WP_Widget {
	function __construct() {
		parent::__construct(
			'KTWidgetSocials',
			__('The Socails Icon Widget', kt_textdomain),
			array(
				'description' => __( '', kt_textdomain )
				)
		);
	}

	// Widget Backend
	public function form( $instance ) {
		// Check all fields
		$facebook_link_key = 'facebook_link';
		$instagram_link_key = 'instagram_link';
		$twitter_link_key = 'twitter_link';
		$items_align_key = 'items_align';
		$items_align = isset( $instance[$items_align_key] ) ? $instance[$items_align_key] : 'flex-end';
		$facebook_link = isset( $instance[$facebook_link_key] ) ? $instance[$facebook_link_key] : '';
		$instagram_link = isset( $instance[$instagram_link_key] ) ? $instance[$instagram_link_key] : '';
		$twitter_link = isset( $instance[$twitter_link_key] ) ? $instance[$twitter_link_key] : '';
		// Widget admin form ?>
		<br>
		<label for="<?php echo $this->get_field_id( $items_align ); ?>">
			<?php _e( 'Items Align:' ); ?></label><br>
			<select class='widefat' id="<?php echo $this->get_field_id( $items_align_key ); ?>"
			        name="<?php echo $this->get_field_name( $items_align_key ); ?>" type="text">
				<option value='center'<?php echo ($items_align=='center')?'selected':''; ?>>
					<?php echo __('center', kt_textdomain); ?>
				</option>
				<option value='flex-start'<?php echo ($items_align=='flex-start')?'selected':''; ?>>
					<?php echo __('left', kt_textdomain); ?>
				</option>
				<option value='flex-end'<?php echo ($items_align=='flex-end')?'selected':''; ?>>
					<?php echo __('right', kt_textdomain); ?>
				</option>
			</select>

		<br>
		<br>
		<label for="<?php echo $this->get_field_id( $facebook_link_key ); ?>">
			<?php _e( 'Facebook Link:' ); ?></label><br>
		<input class="widefat" id="<?php echo $this->get_field_id( $facebook_link_key ); ?>"
		       name="<?php echo $this->get_field_name( $facebook_link_key ); ?>" type="text"
		       value="<?php echo esc_attr( $facebook_link ); ?>" />
		<br>
		<br>
		<label for="<?php echo $this->get_field_id( $instagram_link_key ); ?>">
			<?php _e( 'Instagram Link:' ); ?></label><br>
		<input class="widefat" id="<?php echo $this->get_field_id( $instagram_link_key ); ?>"
		       name="<?php echo $this->get_field_name( $instagram_link_key ); ?>" type="text"
		       value="<?php echo esc_attr( $instagram_link ); ?>" />
		<br>
		<br>
		<label for="<?php echo $this->get_field_id( $twitter_link_key ); ?>">
			<?php _e( 'Twitter Link:' ); ?></label><br>
		<input class="widefat" id="<?php echo $this->get_field_id( $twitter_link_key ); ?>"
		       name="<?php echo $this->get_field_name( $twitter_link_key ); ?>" type="text"
		       value="<?php echo esc_attr( $twitter_link ); ?>" />
		<br>
		<br>
		<?php
	}
	public function widget( $args, $instance ) {
		$facebook_link_key = 'facebook_link';
		$instagram_link_key = 'instagram_link';
		$twitter_link_key = 'twitter_link';
		$items_align_key = 'items_align';
		$facebook_link = $instance[$facebook_link_key];
		$instagram_link = $instance[$instagram_link_key];
		$twitter_link = $instance[$twitter_link_key];
		$items_align = isset( $instance[$items_align_key] ) ? $instance[$items_align_key] : 'flex-end';

		echo $args['before_widget']; ?>
		<style type="text/css">
			.kt-social-links {
				 justify-content: <?php echo $items_align; ?>;
			}
			.kt-copyright {
				justify-content: <?php echo $items_align; ?>;
			}
		</style>
		<div class="kt-social-links">
			 <?php if( $facebook_link ) : ?>
				 <a href="<?php echo $facebook_link; ?>" title="Facebook">
					 <img src="<?php echo kt_img_base_path.'icons/facebook.svg'; ?>" alt="Facebook" loading="lazy">
				 </a>
			 <?php endif; ?>
			<?php if( $instagram_link ) : ?>
				<a href="<?php echo $instagram_link; ?>" title="Instagram">
					<img src="<?php echo kt_img_base_path.'icons/inst.svg'; ?>" alt="Instagram" loading="lazy">
				</a>
			<?php endif; ?>
			<?php if( $twitter_link ) : ?>
				<a href="<?php echo $twitter_link; ?>" title="Twitter">
					<img src="<?php echo kt_img_base_path.'icons/twitter.svg'; ?>" alt="Facebook" loading="lazy">
				</a>
			<?php endif; ?>
		</div>
		<p class="kt-copyright">&copy; <?php echo date_i18n( _x( 'Y', 'copyright date format', kt_textdomain ) ); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">KidztimeLab</a>.
			<?php echo __('All right reserved.', kt_textdomain); ?>
		</p><!-- .footer-copyright -->
		<?php echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$facebook_link_key = 'facebook_link';
		$instagram_link_key = 'instagram_link';
		$twitter_link_key = 'twitter_link';
		$items_align_key = 'items_align';
		$instance = array();
		$instance[$items_align_key] = $new_instance[$items_align_key];
		$instance[$facebook_link_key] = $new_instance[$facebook_link_key];
		$instance[$instagram_link_key] = $new_instance[$instagram_link_key];
		$instance[$twitter_link_key] = $new_instance[$twitter_link_key];
		return $instance;
	}


}
