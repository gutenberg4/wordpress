<div id="loopedSlider">	
			
	<div class="container">
	
		<div class="slides">

		<?php 			
				query_posts(array(				
					'showposts' => get_option('daily_featured_post_num'),
					'tag' => get_option('daily_featured_post_tags'),			
					'caller_get_posts' => 1 
				)); 			
			while(have_posts()) : the_post(); 
			global $wp_query; $maxnum = $wp_query->found_posts;
		 ?>
		 
		 <div id="featured-<?php the_ID(); ?>">

		 <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('featured-thumb', array('class' => 'featured-thumb')); ?></a>
				

			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<p class="entry-meta">
				<span class="date">Posted by <?php the_author_posts_link(); ?> on <?php the_time(get_option('date_format')); ?></span>
				<span class="meta-sep">|</span>				
				<span class="comments-link"><?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?></span>
			</p>
			<p>
			  <?php tj_content_limit(360); ?> 				
			
			<span class="meta-more"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Read more &raquo;','themejunkie'); ?></a></span>
			</p>

			</div> <!--end .slides-->
		 
		 	<?php endwhile; wp_reset_query(); ?>
		 	
		</div> <!--end #post-->

	</div> <!--end .container-->
	
	<ul class="pagination">
	    <?php $i = 1; $home_featured_num = get_option('daily_featured_post_num'); while($i <= $home_featured_num) : echo '<li><a href="#">'; echo $i; echo '</a></li>'; $i++;?>
        <?php endwhile; ?>
	</ul>	

</div> <!--end #loopslider-->

<script type="text/javascript" charset="utf-8">
	jQuery.noConflict();
	jQuery(function($){
		jQuery('#loopedSlider').loopedSlider();
	});
</script>
