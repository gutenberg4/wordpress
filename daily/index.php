<?php get_header(); ?>

<div id="container">

	<div id="content">
	
	<?php if(get_option('daily_featured_content_enable') == 'on') { ?>
		<?php include(TEMPLATEPATH. '/includes/templates/home-featured.php'); ?>
	<?php } ?>
				
	<div class="content-loop">
		<h3 class="section-title"><?php _e('What\'s New Here?', 'themejunkie'); ?><a class="subscribe-rss" href="http://feeds.feedburner.com/<?php echo get_option('daily_rss_id'); ?>" rel="nofollow" target="_blank"><?php _e('Subscribe to RSS feed', 'themejunkie'); ?></a></h3>
		<?php if (have_posts()) : while ( have_posts() ) : the_post() ?>
			<?php include(TEMPLATEPATH. '/includes/templates/loop.php'); ?>
		<?php endwhile; ?>
		<div class="clear"></div>
		<?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
			<div class="pagenavi">
		    	<div class="left"><?php previous_posts_link(__('Newer Entries', 'themejunkie')) ?></div>
		   		<div class="right"><?php next_posts_link(__('Older Entries', 'themejunkie')) ?></div>
		    	<div class="clear"></div>
			</div> <!-- .pagination -->  
		<?php } ?> 
		<?php else : ?>
		<?php endif; ?>
	</div><!-- .content-loop -->
		
	<?php if(get_option('daily_content_bar_enable') == 'on') { ?>	
		<div class="content-bar">
			<?php 
				if(is_active_sidebar('home-content-bar'))
					dynamic_sidebar('home-content-bar'); 
				else { ?>
					<div class="widget">
						<h3 class="section-title"><?php _e('Home Content Bar', 'themejunkie'); ?></h3>
						<div class="textwidget">
							<p>Drag Widgets to this widget area from Dashboard -> Appearance -> Widgets</p>
						</div>
					</div>
			<?php } ?>
		</div><!-- .content-bar -->
	<?php } ?>
	
	</div><!-- #content -->
	
	<?php get_sidebar(); ?>
	
</div><!-- #container -->

<?php get_footer(); ?>