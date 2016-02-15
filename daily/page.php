<?php get_header(); ?>

<div id="container">
		
	<div id="content">
		
		<?php the_post(); ?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themejunkie' ), 'after' => '</div>' ) ); ?>
			</div> <!--end .entry-->
					
		</div> <!--end #post-->
		
	<?php if(get_option('daily_show_page_comments') == 'on') { ?>
	  		<?php comments_template(); ?>
	  	<?php } ?> 
			
	</div><!--end #content-->
	
</div> <!--end #container-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
