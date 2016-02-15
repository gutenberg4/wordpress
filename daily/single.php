<?php get_header(); ?>

<div id="container">
	<div id="content">
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<span class="comment-bubble"><strong><?php comments_popup_link('0','1','%'); ?></strong></span>
			
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<div class="entry-meta">
				<span class="meta-author"><?php _e('Posted by','themejunkie'); ?> <?php the_author_posts_link(); ?></span>
				<span class="meta-date"><?php _e( 'on ', 'themejunkie' ); ?><?php the_time(get_option('date_format')); ?></span>
				<?php edit_post_link( __( 'Edit', 'themejunkie' ), '<span class="meta-sep">|</span> <span class="meta-edit">', '</span>' ); ?>
			</div> <!--end .entry-meta-->
			
			<!--BEGIN OF POST TOP CODE-->
		<?php if(get_option('daily_integrate_singletop_enable') == 'on') echo (get_option('daily_integration_single_top')); ?>
			<!--END OF POST TOP CODE-->

			<div class="entry entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themejunkie' ), 'after' => '</div>' ) ); ?>
			</div> <!--end .entry-->
			
			<div id="entry-bottom">
			<strong><?php _e( 'Filed in: ', 'themejunkie' ); ?></strong><?php the_category( ', ' ); ?> 
			<?php printf(the_tags(__('<span id="entry-tags"><strong>Tags:</strong>&nbsp;','themejunkie'),', ','</span>')); ?>
			</div>
			
			<!--BEGIN OF POST BOTTOM CODE-->
			<?php if(get_option('daily_integrate_singlebottom_enable') == 'on') echo (get_option('daily_integration_single_bottom')); ?>	
			<!--END OF POST BOTTOM CODE-->

                        <div class="clear"></div>

			<?php if(get_option('daily_show_author_box') == 'on') { ?>	
			<div id="entry-author" class="clear">
				<div class="entry-author-content clear">
				<div id="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'themejunkie_author_bio_avatar_size', 60 ) ); ?>
				</div> <!--end .author-avatar-->
				<div id="author-description">
					<h3><?php _e('About','themejunkie'); ?> <?php the_author(); ?></h3>
					<?php the_author_meta( 'description' ); ?>
					<div id="author-link">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( esc_attr__( 'View all posts by %s', 'themejunkie' ), get_the_author() ); ?>"><?php _e( 'View all posts by ', 'themejunkie' ); ?><?php the_author(); ?> &rarr;</a>
					</div> <!--end .author-link-->
				</div> <!--end .author-description-->
				</div>
			</div> <!--end .entry-author-->
			<?php } ?>
			
<div class="left">			
		
		  <?php if(get_option('daily_show_newsletter_form') == 'on') { ?>
			<div class="entry-social">
			    <h3 class="section-title"><?php _e('Get Updates', 'themejunkie'); ?></h3>
					<div class="newsletter">
						<p><?php _e('Subscribe to our e-mail newsletter to receive updates.', 'themejunkie'); ?></p>
						<form class="subscribe-form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_option('daily_newsletter_id'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
							<input class="email" type="text" name="email" value="E-mail" onfocus="if (this.value == 'E-mail') {this.value = '';}" onblur="if (this.value == '') {this.value = 'E-mail';}" />
							<input type="hidden" value="<?php echo get_option('daily_newsletter_id'); ?>" name="uri"/>
							<input type="hidden" value="<?php echo get_option('daily_newsletter_id'); ?>" name="title"/>
							<input type="hidden" name="loc" value="en_US"/>
							<input class="button" type="submit" name="submit" value="Submit" />
						</form>
					</div> <!-- end .newsletter -->
			</div><!--end .entry-social-->								
			<?php } ?>

<div class="clear"></div>
			
			<?php if(get_option('daily_show_share_buttons') == 'on') { ?>
			<div class="entry-social">
					<h3 class="section-title"><?php _e('Share This Post', 'themejunkie'); ?></h3>
					<div class="entry-share">
					<a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-text="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>" data-via="<?php echo get_option('daily_twitter_id'); ?>"><?php _e('Tweet','themejunkie'); ?></a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>		
					<span class="fb-button"><iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;layout=box_count&amp;show_faces=true&amp;width=50&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:65px;" allowTransparency="true"></iframe></span>
					<div class="gpone"><g:plusone size="tall" href="<?php the_permalink();?>"></g:plusone>
		<script type="text/javascript">
    (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
         </script>
					</div>
					</div> <!-- end .entry-share -->
			</div><!--end .entry-social-->
			<?php } ?>
</div>
<?php if(get_option('daily_show_entry_bottom') == 'on') { ?>
			<div class="entry-related">
				<?php echo tj_related_posts(); ?>
			</div>
			<?php } ?>

			<div class="clear"></div>
			</div><!--end .entry-bottom-->
		
		<?php if(get_option('daily_show_post_comments') == 'on') { ?>
	  		<?php comments_template(); ?>  	
	  	<?php } ?>
	</div><!--end #content -->
</div><!--end #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
