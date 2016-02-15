<div id="post-<?php the_ID(); ?>" <?php post_class('clear'); ?>>
		
	<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('entry-thumb', array('class' => 'entry-thumb')); ?></a>	
	
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	
	<div class="entry-meta">
		<span class="date"><?php _e('Posted on','themejunkie'); ?> <?php the_time(get_option('date_format')); ?></span>
		<span class="meta-sep">|</span>
		<span class="meta-comments"><?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?></span>
	</div> <!--end .entry-meta-->
	
	<div class="entry-excerpt">
	<?php tj_content_limit( get_option('daily_excerpt_char_num') ); ?>
	<?php if( get_option('daily_enable_share_buttons') == 'on' ) { ?>
	<div class="loop-share">
		<div class="btn-tweet">
		    <a href="http://twitter.com/share" class="twitter-share-button"
		    data-url="<?php the_permalink(); ?>"
		    data-via="<?php echo get_option('daily_twitter_id'); ?>"
		    data-text="<?php the_title(); ?>"
		    data-related=""
		    data-count="horizontal">Tweet</a>
		</div><!-- .btn-tweet -->
		<div class="btn-like">
		<iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&amp;href=<?php the_permalink(); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font=arial&amp;colorscheme=light" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px;" allowTransparency="true"></iframe>
		</div><!-- .btn-like -->
		<div class="btn-plus">
			<g:plusone size="medium" href="<?php the_permalink();?>"></g:plusone>
		</div><!-- .btn-plus -->
	</div><!-- .loop-share -->
<?php } ?>
	</div> <!--end .entry-excerpt-->
	
</div> <!--end #post-->