<?php
/**
 * Posts widget.
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Freshlife_Posts_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-freshlife-posts widget_posts',
			'description' => __( 'Display editor choice posts based on selected category. Best for Secondary sidebar.', 'freshlife' )
		);

		// Create the widget.
		parent::__construct(
			'freshlife-posts',                          // $this->id_base
			__( '&raquo; Editor Choice', 'freshlife' ), // $this->name
			$widget_options                           // $this->widget_options
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

			// Posts query arguments.
			$args = array(
				'posts_per_page' => $instance['limit'],
				'post_type'      => 'post',
			);

			// Limit to category based on user selected tag.
			if ( ! empty( $instance['cat'] ) ) {
				$args['cat'] = (int) $instance['cat'];
			}

			// Allow dev to filter the post arguments.
			$query = apply_filters( 'freshlife_editor_choice_args', $args );

			// The post query.
			$posts = new WP_Query( $query );

			if ( $posts->have_posts() ) :

				echo '<ul>';
					while ( $posts->have_posts() ) : $posts->the_post();
						echo '<li>';
							echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_attr( get_the_title() ) . '</a></h2>';
							$view = intval( get_post_meta( get_the_ID(), 'Views', true ) );
							echo '<div class="entry-views">' .  number_format_i18n( $view ) . '</div>';
						echo '</li>';
					endwhile;
				echo '</ul>';

			endif;

			// Reset the query.
			wp_reset_postdata();

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

		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['cat']       = $new_instance['cat'];
		$instance['limit']     = (int) $new_instance['limit'];
		$instance['show_view'] = isset( $new_instance['show_view'] ) ? (bool) $new_instance['show_view'] : false;

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
			'title'     => esc_html__( 'Editor Choice', 'freshlife' ),
			'cat'       => '',
			'limit'     => 6,
			'show_view' => true,
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
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Choose Category:', 'freshlife' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" style="width:100%;">
				<?php $categories = get_terms( 'category' ); ?>
				<?php foreach( $categories as $category ) { ?>
					<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['cat'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php _e( 'Number of posts to show', 'freshlife' ); ?>
			</label>
			<input class="small-text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['limit'] ); ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_view'] ); ?> id="<?php echo $this->get_field_id( 'show_view' ); ?>" name="<?php echo $this->get_field_name( 'show_view' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_view' ); ?>">
				<?php _e( 'Display post view?', 'freshlife' ); ?>
			</label>
		</p>

	<?php

	}

}