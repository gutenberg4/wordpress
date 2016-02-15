<?php
/**
 * Custom functions for the theme options.
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Theme options header.
 *
 * @since  1.0.0
 */
function freshlife_of_header() {
	$theme = wp_get_theme();
	$name  = $theme->get( 'TextDomain' );
?>
	<div class="header-options">
		<ul class="theme-info">
			<li><span class="dashicons dashicons-info"></span><a href="http://docs.theme-junkie.com/<?php echo esc_attr( $name ); ?>" target="_blank"><?php _e( 'Documentation', 'freshlife' ); ?></a></li>
			<li><span class="dashicons dashicons-lightbulb"></span><a href="http://www.theme-junkie.com/forum/" target="_blank"><?php _e( 'Support Forum', 'freshlife' ); ?></a></li>
			<li><span class="dashicons dashicons-twitter"></span><a href="https://twitter.com/theme_junkie" target="_blank">Follow Us</a></li>
			<li><span class="dashicons dashicons-facebook"></span><a href="https://www.facebook.com/themejunkies" target="_blank">Like Us</a></li>
		</ul>
	</div>
<?php
}
add_action( 'optionsframework_header_options', 'freshlife_of_header' );

/**
 * Favicon output.
 *
 * @since 1.0.0
 */
function freshlife_favicon_output() {
	$favicon = of_get_option( 'freshlife_favicon' );

	if ( !empty( $favicon ) ) {
		echo '<link href="' . esc_url( $favicon ) . '" rel="icon">' . "\n";
	}

}
add_action( 'wp_head', 'freshlife_favicon_output', 5 );

/**
 * Mobile Icon output.
 *
 * @since 1.0.0
 */
function freshlife_mobile_icon_output() {
	$icon = of_get_option( 'freshlife_mobile_icon' );

	if ( !empty( $icon ) ) {
		echo '<link rel="apple-touch-icon-precomposed" href="' . esc_url( $icon ) . '">' . "\n";
	}

}
add_action( 'wp_head', 'freshlife_mobile_icon_output', 6 );

/**
 * Custom RSS feed url.
 *
 * @since  1.0.0
 * @return string
 */
function freshlife_feed_url( $output, $feed ) {

	// Get the custom rss feed url.
	$url = of_get_option( 'freshlife_feedburner_url' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( !empty( $url ) ) {
		$output = esc_url( $url );
	}

	return $output;
}
add_filter( 'feed_link', 'freshlife_feed_url', 10, 2 );

/**
 * Accent Colors
 *
 * @since  1.0.0
 */
function freshlife_accent_colors() {

	$option  = of_get_option( 'freshlife_colors', 'blue' );
	$pallete = of_get_option( 'freshlife_color_pallete', '#2266bb' );
	$color   = '#2266bb';
	$color1  = '#48d';
	$color2  = '#eef5ff';

	if ( $option == 'blue' ) {
		$color1 = '#48d';
		$color2 = '#eef5ff'; 
	}

	if ( $option == 'green' ) {
		$color  = '#007F00';
                $color1 = '#7FBF7F';
		$color2 = '#e5f2e5';
	}

	if ( $option == 'red' ) {
		$color  = '#cc0000';
		$color1 = '#e57f7f';
		$color2 = '#f9e5e5';
	}

	if ( $pallete != '#2266bb' && $pallete != '' ) {
		$color   = $pallete;
		$color1  = '#48d';
		$color2  = '#eef5ff';
	}
	?>
	<style>

		#primary-nav ul li a:hover, 		 
		#primary-nav ul li.current-menu-item a,
		#secondary-nav ul li a:hover,
		#secondary-nav ul li.current-menu-item a,
                .pagination .page-numbers.current { 
			background-color: <?php echo $color ?>;
		}

		a:link,
		a:visited,		
		.widget_tabs .tab-content .entry-title a:hover,
		#site-bottom a:hover,
		.category-box ul li strong a:hover,
		.section-title a:hover,
		.widget_latest_comments a:hover .name,
		.related-posts ul li a:hover .entry-title,
		.widget_tabs .tab-content ul li .entry-title:hover,
		.widget_tabs #tab3 li a span:hover,
 		#secondary-nav ul.sf-menu li li a:hover,
		#primary-nav ul.sf-menu li li a:hover,
		#secondary-nav .sf-menu li li a:hover
		.posts .cat-posts .view-more a,
		.posts .cat-posts a:hover .entry-title,
		.header-social a .fa,
		.posts .sub-cats li:hover > a:after,
		.single .entry-meta .entry-author a:hover,
                .pagination .page-numbers {
			color: <?php echo $color ?>;
		}

		#secondary-nav .sf-mega {
			border-top: 3px solid <?php echo $color ?>;
		}

		#secondary-bar {
			border-bottom: 3px solid <?php echo $color ?>;
		}

		.widget_tabs .tabs-nav li.active a,
		.widget_tabs .tabs-nav li a.selected,
		.widget_tabs .tabs-nav li a:hover {
			background-color: <?php echo $color1 ?>;
		}

		.widget_tabs .tabs-nav li a,
                .author-bio {
			background-color: <?php echo $color2 ?>;
		}

		.widget_tabs .tabs-nav {
			border-bottom: 3px solid <?php echo $color1 ?>;
		}

	</style>
	<?php
}
add_action( 'wp_head', 'freshlife_accent_colors', 20 );

/**
 * Single post advertisement.
 * Before content.
 *
 * @since  1.0.0
 */
function freshlife_single_ad_before( $content ) {
	$ad = of_get_option( 'freshlife_ad_single_before' );

	if ( is_single() ) {
		$content = stripslashes( $ad ) . $content;
	} else {
		$content;
	}

	return $content;

}
add_filter( 'the_content', 'freshlife_single_ad_before', 20 );

/**
 * Single post advertisement.
 * After content.
 *
 * @since  1.0.0
 */
function freshlife_single_ad_after( $content ) {
	$ad = of_get_option( 'freshlife_ad_single_after' );

	if ( is_single() ) {
		$content = $content . stripslashes( $ad );
	} else {
		$content;
	}

	return $content;

}
add_filter( 'the_content', 'freshlife_single_ad_after', 20 );

/**
 * Tracking Code
 *
 * @since  1.0.0
 */
function freshlife_tracking_code() {
	$tracking_code = of_get_option( 'freshlife_tracking_code' );

	if ( !empty( $tracking_code ) ) {
		echo stripslashes( $tracking_code ) . "\n";
	}

}
add_action( 'wp_footer', 'freshlife_tracking_code', 15 );

/**
 * Header Code
 *
 * @since  1.0.0
 */
function freshlife_header_code() {
	$header_code = of_get_option( 'freshlife_script_head' );

	if ( !empty( $header_code ) ) {
		echo stripslashes( $header_code ) . "\n";
	}

}
add_action( 'wp_head', 'freshlife_header_code', 20 );

/**
 * Footer Code
 *
 * @since  1.0.0
 */
function freshlife_footer_code() {
	$footer_code = of_get_option( 'freshlife_script_footer' );

	if ( !empty( $footer_code ) ) {
		echo stripslashes( $footer_code ) . "\n";
	}

}
add_action( 'wp_footer', 'freshlife_footer_code', 20 );