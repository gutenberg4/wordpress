<?php
/**
 * Theme Junkie Tabs Widget
 */
 
class TJ_Widget_Tabs extends WP_Widget {

	function TJ_Widget_Tabs() {
		$widget_ops = array('classname' => 'widget_tab', 'description' => __('Display an Ajax tabber with Popular Posts, Latest Posts and Recent Comments.'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('tab', __('ThemeJunkie - Tabs'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$pp_num = $instance['pp_num'];
		$rp_num = $instance['rp_num'];
		$rc_num = $instance['rc_num'];
		$asize = $instance['asize'];
		?>
		
<div id="tab-sidebar">

	<div class="widget tab-widget" id="popular-posts">
		<h3 class="widget-title"><?php _e('Popular', 'themejunkie'); ?></h3>
		<ul>
			<?php rewind_posts(); ?>
			<?php tj_tabs_popular($pp_num, $asize); ?>                    
		</ul>			
	 </div> <!--end #popular-posts-->
		       
	<div class="widget tab-widget" id="recent-posts"> 
		<h3 class="widget-title"><?php _e('Latest', 'themejunkie'); ?></h3>
		<ul>
			<?php tj_tabs_latest($rp_num, $asize); ?>                    
		</ul>	
	</div> <!--end #recent-posts-->
		    
	<div class="widget tab-widget" id="recent-comments">
		<h3 class="widget-title"><?php _e('Comments', 'themejunkie'); ?></h3>
		<ul>
			<?php tj_tabs_comments($rc_num, $asize); ?>                    
		</ul>
	</div> <!--end #recent-comments-->

</div><!--end #tab-sidebar-->
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['pp_num'] = $new_instance['pp_num'];
		$instance['rp_num'] =  $new_instance['rp_num'];
		$instance['rc_num'] =  $new_instance['rc_num'];
		$instance['asize'] =  $new_instance['asize'];
		return $instance;
	}

	function form( $instance ) { 
		$instance = wp_parse_args( (array) $instance, array( 'pp_num' => '5', 'rp_num' => '5', 'rc_num' => '5', 'asize' => '48' ) );
		$pp_num = $instance['pp_num'];
		$rp_num = format_to_edit($instance['rp_num']);
		$rc_num = format_to_edit($instance['rc_num']);
		$asize = format_to_edit($instance['asize']);
	?>
		<p><label for="<?php echo $this->get_field_id('pp_num'); ?>"><?php _e('Number of popular posts to show::'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('pp_num'); ?>" name="<?php echo $this->get_field_name('pp_num'); ?>" type="text" value="<?php echo $pp_num; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('rp_num'); ?>"><?php _e('Number of latest posts to show:'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('rp_num'); ?>" name="<?php echo $this->get_field_name('rp_num'); ?>" value="<?php echo $rp_num; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('rc_num'); ?>"><?php _e('Number of recent comments to show:'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('rc_num'); ?>" value="<?php echo $rc_num; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('asize'); ?>"><?php _e('Avatar & Thumbnail size(width=height), e.g. 48'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('asize'); ?>" name="<?php echo $this->get_field_name('asize'); ?>" value="<?php echo $asize; ?>" /></p>
	<?php }
}

register_widget('TJ_Widget_Tabs');

