<?php get_header(); ?>

<div id="container">
	<div id="content" class="list-content">
		<?php 
			include(TEMPLATEPATH. '/includes/templates/headline.php');
			
			rewind_posts();
			if (have_posts()) {
				echo '<div class="gridrow clear">';
				while (have_posts()) : the_post();
				global $post;
					include(TEMPLATEPATH. '/includes/templates/loop.php');
					$q = $wp_query->current_post;  $maxq = tj_current_postnum(); if($q < $maxq-1 && is_int(($q+1)/2)) echo '</div><div class="gridrow clear">';
					$postcount++;
				endwhile;
				echo '</div> <!--end .gridrow-->';
			} else { 
				include(TEMPLATEPATH. '/includes/templates/not-found.php'); 
			}			
		?>
		
	<div class="clear"></div>
	<?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
		<div class="pagenavi">
	    	<div class="left"><?php previous_posts_link(__('Newer Entries', 'themejunkie')) ?></div>
	   		<div class="right"><?php next_posts_link(__('Older Entries', 'themejunkie')) ?></div>
	    	<div class="clear"></div>
		</div> <!-- end .pagination -->  
	<?php } ?> 
	
	</div><!-- #content -->
</div><!-- #container -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>