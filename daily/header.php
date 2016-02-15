<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php tj_custom_titles(); ?></title>
<?php tj_custom_description(); ?>
<?php tj_custom_keywords(); ?>
<?php tj_custom_canonical(); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/styles/<?php echo get_option('daily_theme_stylesheet');?>" />	
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/custom.css" />
<?php wp_head(); ?>
<?php if (get_option('daily_content_bar_enable') == 'false') { ?>
	<style>
		.content-loop { width: 100% !important; }
	</style>
<?php } ?>
</head>
<?php if (is_home() || is_archive() || is_search() ) add_filter('img_caption_shortcode', create_function('$a, $b, $c','return $c;'), 10, 3); ?>

<body <?php body_class(); ?>>
<div id="wrapper">

	<div id="top">			
		<?php if(get_option('daily_show_social_profiles') == 'on') { ?>
			<ul class="top-social">
				<li><a class="top-rss yellow" title="Subscribe to our RSS feed" href="http://feeds.feedburner.com/<?php echo get_option('daily_rss_id'); ?>" rel="nofollow" target="_blank"><?php _e('RSS', 'themejunkie') ?></a></li>
				<li><a class="top-email" href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_option('daily_newsletter_id'); ?>&amp;loc=en_US" rel="nofollow" target="_blank"><?php _e('Email', 'themejunkie') ?></a></li>
				<li><a class="top-twitter" href="http://twitter.com/<?php echo get_option('daily_twitter_id'); ?>" rel="nofollow" target="_blank"><?php _e('Follow us', 'themejunkie') ?></a></li>
				<li><a class="top-facebook" href="http://www.facebook.com/<?php echo get_option('daily_facebook_page_id'); ?>" rel="nofollow" target="_blank"><?php _e('Become a fan', 'themejunkie') ?></a></li>
			</ul>
		<?php } ?>
		
		<?php $menuClass = 'topnav';
		$menuID = 'page-nav';
		$primaryNav = '';
		if (function_exists('wp_nav_menu')) {
			$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-nav', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) ); 
		};
		if ($primaryNav == '') { ?>
			<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">						
				<?php show_page_menu($menuClass,false,false); ?>
			</ul>
		<?php }	else echo($primaryNav); ?>													
		
		<div class="clear"></div>    	
    </div> <!--end #top-->
    	
	<div id="header">

		<?php if (get_option('daily_text_logo_enable') == 'on') { ?>
			<div id="text-logo">
				<h1 id="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
				<p id="site-desc"><?php bloginfo('description'); ?></p>
			</div> <!-- end #text-logo -->
		<?php } else { ?>
			<a href="<?php bloginfo('url'); ?>"><?php $logo = (get_option('daily_logo') <> '') ? get_option('daily_logo') : get_bloginfo('template_directory').'/images/logo.png'; ?><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" id="logo"/></a>
		<?php }?>

 <?php /* Header Ad */
		if( get_option('daily_header_ad_enable') == 'on'){
			echo "<div class='header-ad'>";
			echo get_option('daily_header_ad_code');
			echo "</div>";
		} ?>
		<div class="clear"></div>
		
	</div><!-- #header -->

	<div id="cat-menu">
	
	<?php $menuClass = 'nav';
		$menuID = 'cat-nav';
		$secondaryNav = '';
		if (function_exists('wp_nav_menu')) {
			$secondaryNav = wp_nav_menu( array( 'theme_location' => 'secondary-nav', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) ); 
		};
		if ($secondaryNav == '') { ?>
			<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
			<?php if (get_option('daily_home_link') == 'on') { ?>
					<li class="<?php if(is_home()) echo('first');?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'themejunkie') ?></a></li>	
				<?php } ?>					
				<?php show_categories_menu($menuClass,false,false); ?>
			</ul>
		<?php }	else echo($secondaryNav); ?>	
        
        		<div id="search">
			<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
				<input type="text" class="field" name="s" id="s"  value="<?php _e('Search this site...', 'themejunkie') ?>" onfocus="if (this.value == '<?php _e('Search this site...', 'themejunkie') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search this site...', 'themejunkie') ?>';}" />
				<input id="searchsubmit" type="image" src="<?php bloginfo('template_directory'); ?>/images/ico-search.gif" value="Go" />
			</form>
		</div><!--end #search -->
		
	</div> <!--end #cat-nav-->

	<div id="breadcrumbs" class="clear">
	<?php if(is_home()) { ?>
	<?php } else { ?>		
	<?php include(TEMPLATEPATH. '/includes/templates/breadcrumbs.php'); ?>
        <span class="current-time"><?php echo mysql2date('F j, Y g:i a',current_time('timestamp')); ?></span>
	<?php } ?>
	</div>

	<div id="main" class="clear">