<?php

// Custom Menus
function register_main_menus() {
	register_nav_menus(
		array(
			'primary-nav' => __( 'Primary Nav' ),
			'secondary-nav' => __( 'Secondary Nav' ),
		)
	);
}

if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

// Register and deregister Scripts files	
if(!is_admin()) {
	add_action( 'wp_print_scripts', 'my_deregister_scripts', 100 );
}
	
function my_deregister_scripts() {
		wp_deregister_script( 'jquery' );

		//wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', false, '1.7.2');
		wp_enqueue_script('jquery', get_bloginfo('template_url').'/includes/js/jquery.min.js', false, '1.7.2');		
		wp_enqueue_script('jquery-superfish', get_bloginfo('template_url').'/includes/js/superfish.js', false, '1.4.2');			
		wp_enqueue_script('jquery-custom', get_bloginfo('template_url').'/includes/js/custom.js', false, '1.4.2');		
		wp_enqueue_script('jquery-cookie', get_bloginfo('template_url').'/includes/js/jcookie.js', array('jquery'), '0.1');				
		wp_enqueue_script('loopedslider', get_bloginfo('template_url').'/includes/js/loopedslider.js', array('jquery'), '0.5.6');
		wp_enqueue_script('scrolltopcontrol', get_bloginfo('template_url').'/includes/js/scrolltopcontrol.js', array('jquery'), '1.1');	
		wp_enqueue_script('twitter-button', 'http://platform.twitter.com/widgets.js', false, '1.0');
		wp_enqueue_script('gpone-button', 'https://apis.google.com/js/plusone.js', false, '1.0');		

		if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' );
}

// Get limit excerpt
function tj_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo " ...";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo " ...";
   }
   else {
      echo "";
      echo $content;
   }
}

add_filter('post_class', 'custom_post_class');
function custom_post_class($classes) {	
	global $wp_query;
	$classes[] = ( ($wp_query->current_post+1) % 2 ) ? 'odd' : 'even alt';
	
	return $classes;
}

// Return number of posts in a Archive Page
function tj_current_postnum() {
	global $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if(empty($paged) || $paged == 0) $paged = 1;
	if (!is_404()) 
		$begin_postnum = (($paged-1)*$posts_per_page)+1; 
	else 
		$begin_postnum = '0';
	if ($paged*$posts_per_page < $numposts) 
		$end_postnum = $paged*$posts_per_page; 
	else 
		$end_postnum = $numposts;
	$current_page_postnum = $end_postnum-$begin_postnum+1;
	return $current_page_postnum;
}

/*-----------------------------------------------------------------------------------*/
/*	Twitter Stream
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'tj_twitter_script') ) {
	function tj_twitter_script($unique_id,$username,$limit) {
	?>
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	
	    function twitterCallback2(twitters) {
	    
	      var statusHTML = [];
	      for (var i=0; i<twitters.length; i++){
	        var username = twitters[i].user.screen_name;
	        var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
	          return '<a href="'+url+'">'+url+'</a>';
	        }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
	          return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
	        });
	        statusHTML.push( '<li><span class="content">'+status+'</span> <a class="twitter-timestamp" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>' );
	      }
	      document.getElementById( 'twitter_update_list_<?php echo $unique_id; ?>').innerHTML = statusHTML.join( '' );
	    }
	    
	    function relative_time(time_value) {
	      var values = time_value.split( " " );
	      time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
	      var parsed_date = Date.parse(time_value);
	      var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
	      var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
	      delta = delta + (relative_to.getTimezoneOffset() * 60);
	    
	      if (delta < 60) {
	        return 'less than a minute ago';
	      } else if(delta < 120) {
	        return 'about a minute ago';
	      } else if(delta < (60*60)) {
	        return (parseInt(delta / 60)).toString() + ' minutes ago';
	      } else if(delta < (120*60)) {
	        return 'about an hour ago';
	      } else if(delta < (24*60*60)) {
	        return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
	      } else if(delta < (48*60*60)) {
	        return '1 day ago';
	      } else {
	        return (parseInt(delta / 86400)).toString() + ' days ago';
	      }
	    }
	//-->!]]>
	</script>
	<script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $limit; ?>&amp;include_rts=t"></script>
	<?php
	}
}

function tj_save_tweet_link($id) {
	$url = sprintf('%s?p=%s', home_url().'/', $id);

	add_post_meta($id, 'tweet_trim_url_2', $url);
	
	return $url;
}

function tj_the_tweet_link() {
	if (!$url = get_post_meta(get_the_ID(), 'tweet_trim_url_2', true)) {
	  $url = tj_save_tweet_link(get_the_ID());
	}
	
	if ($old_url = get_post_meta(get_the_ID(), 'tweet_trim_url', true)) {
	  delete_post_meta(get_the_ID(), 'tweet_trim_url');
	}
	
	$output_url = sprintf(
	  'http://twitter.com/home?status=%s%s%s',
	  urlencode(get_the_title()),
	  urlencode(' - '),
	  $url
	);
	$output_url = str_replace('+','%20',$output_url);
	return $output_url;
}

// Tabber: Get Most Popular Posts
function tj_tabs_popular( $posts = 5, $size = 48 ) {
wp_reset_query();
if(empty($posts)) $posts = 5;
if(empty($size)) $size = 48;
	$popular = new WP_Query('caller_get_posts=1&orderby=comment_count&posts_per_page='.$posts);
	while ($popular->have_posts()) : $popular->the_post();
?>
<li class="clear">
 	<?php the_post_thumbnail('tabber-thumb', array('class' => 'entry-thumb')); ?>
 	<div class="info">
 	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
 	<span class="meta"><?php comments_popup_link('0 Comment', '1 Comment', '% Comments', 'comments-link', ''); ?></span>
	</div> <!--end .info-->
</li>
<?php endwhile; 
}

function tj_tabs_latest( $posts = 5, $size = 48 ) {
if(empty($posts)) $posts = 5;
if(empty($size)) $size = 48;
	$the_query = new WP_Query('caller_get_posts=1&showposts='. $posts .'&orderby=post_date&order=desc');	
	while ($the_query->have_posts()) : $the_query->the_post(); 
?>
<li class="clear">
	<?php the_post_thumbnail('tabber-thumb', array('class' => 'entry-thumb')); ?>
	<div class="info">
	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
	<span class="meta"><?php the_time('F j, Y'); ?></span>
	</div> <!--end .info-->
</li>
<?php endwhile; 
}

// Tabber: Get Recent Comments
function tj_tabs_comments( $posts = 5, $size = 48 ) {
if(empty($posts)) $posts = 5;
if(empty($size)) $size = 48;
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	comment_type,comment_author_url,
	SUBSTRING(comment_content,1,65) AS com_excerpt
	FROM $wpdb->comments
	LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	$wpdb->posts.ID)
	WHERE comment_approved = '1' AND comment_type = '' AND
	post_password = ''
	ORDER BY comment_date_gmt DESC LIMIT ".$posts;
	
	$comments = $wpdb->get_results($sql);
	
	foreach ($comments as $comment) {
	?>
	<li class="clear">
		<?php echo get_avatar( $comment, $size ); ?>
	
		<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php _e('on ', 'themejunkie'); ?> <?php echo $comment->post_title; ?>">
			<span class="comment-author"><?php echo strip_tags($comment->comment_author); ?>:</span> <span class="comment-excerpt"><?php echo strip_tags($comment->com_excerpt); ?>...</span>
		</a>
	</li>
	<?php 
	}
}

function tj_related_posts() {
	global $post, $wpdb;
	$backup = $post;  // backup the current object
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) {
	  $tagcount = count($tags);
	  for ($i = 0; $i < $tagcount; $i++) {
	    $tagIDs[$i] = $tags[$i]->term_id;
	  }
	  
	  $args=array(
	    'tag__in' => $tagIDs,
	    'post__not_in' => array($post->ID),
	    'showposts'=>5,
	    'caller_get_posts'=>1
	  );
	  $my_query = new WP_Query($args);
	  if( $my_query->have_posts() ) { $related_post_found = true; ?>
		<h3 class="section-title">Related Posts</h3>
			<ul>		
	    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<li>
					<a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
				</li>				
	    <?php endwhile; ?>
			</ul>		
	  <?php }
	}
	
	//show recent posts if no related found
	if(!$related_post_found){ ?>
		<h3 class="section-title">Recent Posts</h3>
		<ul>
		<?php
		$posts = get_posts('numberposts=5&offset=0');
		foreach($posts as $post) { ?>
			<li>
				<a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
			</li>
		<?php } ?>
		</ul>
		
		<?php 
	}
	wp_reset_query();
}

?>