<?php
/**
 * Social widget.
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Freshlife_Social_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-freshlife-social social-widget',
			'description' => __( 'Display your social link profile.', 'freshlife' )
		);

		// Create the widget.
		parent::__construct(
			'freshlife-social',                // $this->id_base
			__( '&raquo; Social Icons', 'freshlife' ), // $this->name
			$widget_options                  // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		// Display the social icons.
		echo '<div class="widget-social">';
			if ( $instance['youtube'] ) {
				echo '<a class="youtube" href="' . esc_url( $instance['youtube'] ) . '" title="' . esc_attr( 'Youtube' ) . '"><i class="fa fa-youtube"></i></a>';
			}
			if ( $instance['facebook'] ) {
				echo '<a class="facebook" href="' . esc_url( $instance['facebook'] ) . '" title="' . esc_attr( 'Facebook' ) . '"><i class="fa fa-facebook"></i></a>';
			} 
			if ( $instance['twitter'] ) {
				echo '<a class="twitter" href="' . esc_url( $instance['twitter'] ) . '" title="' . esc_attr( 'Twitter' ) . '"><i class="fa fa-twitter"></i></a>';
			}
			if ( $instance['gplus'] ) {
				echo '<a class="google-plus" href="' . esc_url( $instance['gplus'] ) . '" title="' . esc_attr( 'Google Plus' ) . '"><i class="fa fa-google-plus"></i></a>';
			}
			if ( $instance['rss'] ) {
				echo '<a class="rss" href="' . esc_url( $instance['rss'] ) . '" title="' . esc_attr( 'RSS' ) . '"><i class="fa fa-rss"></i></a>';
			}
			if ( $instance['newsletter'] ) {
				echo '<a class="email" href="' . esc_url( $instance['newsletter'] ) . '" title="' . esc_attr( 'Newsletter' ) . '"><i class="fa fa-envelope-o"></i></a>';
			}
		echo '</div>';

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['youtube']  = esc_url( $new_instance['youtube'] );
		$instance['facebook']   = esc_url( $new_instance['facebook'] );
		$instance['twitter']    = esc_url( $new_instance['twitter'] );
		$instance['gplus']      = esc_url( $new_instance['gplus'] );
		$instance['rss']        = esc_url( $new_instance['rss'] );
		$instance['newsletter'] = esc_url( $new_instance['newsletter'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title'      => esc_html__( 'Follow us', 'freshlife' ),
			'facebook'   => '',
			'twitter'    => '',
			'gplus'      => '',
			'youtube'  => '',
			'rss'        => '',
			'newsletter' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'freshlife' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>">
				<?php _e( 'Youtube:', 'freshlife' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_url( $instance['youtube'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">
				<?php _e( 'Facebook:', 'freshlife' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_url( $instance['facebook'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">
				<?php _e( 'Twitter:', 'freshlife' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_url( $instance['twitter'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">
				<?php _e( 'Google Plus:', 'freshlife' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php echo esc_url( $instance['gplus'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>">
				<?php _e( 'RSS Feed:', 'freshlife' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo esc_url( $instance['rss'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>">
				<?php _e( 'Newsletter URL:', 'freshlife' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'newsletter' ); ?>" name="<?php echo $this->get_field_name( 'newsletter' ); ?>" value="<?php echo esc_url( $instance['newsletter'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

	<?php

	}

}

/**
 * Register the widget.
 *
 * @since  1.0.0
 */
function freshlife_register_social_widget() {
	register_widget( 'Freshlife_Social_Widget' );
}
add_action( 'widgets_init', 'freshlife_register_social_widget' );