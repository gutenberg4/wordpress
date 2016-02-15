</div><!--end #main-->
  
		<?php if ( is_active_sidebar( 'footer-widget-area-1' ) || is_active_sidebar( 'footer-widget-area-2' ) || is_active_sidebar( 'footer-widget-area-3' ) || is_active_sidebar( 'footer-widget-area-4' )) { ?>

	<div id="footer">
	
		<div class="widget" id="fwidget-1">
			<?php if ( is_active_sidebar( 'footer-widget-area-1' ) ) :  dynamic_sidebar( 'footer-widget-area-1'); endif; ?>
		</div>

		<div class="widget" id="fwidget-2">
			<?php if ( is_active_sidebar( 'footer-widget-area-2' ) ) :  dynamic_sidebar( 'footer-widget-area-2'); endif; ?>
		</div>
		
		<div class="widget" id="fwidget-3">
			<?php if ( is_active_sidebar( 'footer-widget-area-3' ) ) :  dynamic_sidebar( 'footer-widget-area-3'); endif; ?>
		</div>
	
		<div class="widget" id="fwidget-4">				
			<?php if ( is_active_sidebar( 'footer-widget-area-4' ) ) :  dynamic_sidebar( 'footer-widget-area-4'); endif; ?>
		</div>

		<div class="clear"></div>
	  	
	</div> <!--end #footer-->
		
<?php } ?>
	
		<div id="bottom">
			
			<div class="left">
			
				&copy; <?php echo mysql2date('Y',current_time('timestamp')); ?> <a href="<?php bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>. <?php _e('All rights reserved','themejunkie'); ?>.
			</div> <!--end .left--> 
			
			<div class="right">
				<a href="http://www.theme-junkie.com"><?php _e('WordPress theme','themejunkie'); ?></a> <?php _e('designed by','themejunkie'); ?> <a href="http://www.theme-junkie.com"><?php _e('Theme Junkie','themejunkie'); ?></a>.
			</div> <!--end .right-->
				
			<div class="clear"></div>
		
		</div> <!--end #bottom -->
  
</div> <!--end #wrapper -->

<?php wp_footer(); ?>

</body>
</html>