<?php
/**
 * Enqueue scripts and styles.
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function freshlife_enqueue() {

	// Load plugins stylesheet
	wp_enqueue_style( 'freshlife-plugins-style', trailingslashit( get_template_directory_uri() ) . 'assets/css/plugins.min.css' );

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( ! is_child_theme() && WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet
		wp_enqueue_style( 'freshlife-style', get_stylesheet_uri() );

		// Load custom js plugins.
		wp_enqueue_script( 'freshlife-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.min.js', array( 'jquery' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'freshlife-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery' ), null, true );

	} else {

		// Load main stylesheet
		wp_enqueue_style( 'freshlife-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css' );

		// Load custom js plugins.
		wp_enqueue_script( 'freshlife-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/freshlife.min.js', array( 'jquery' ), null, true );

	}

	// Load responsive stylesheet
	wp_enqueue_style( 'freshlife-responsive-style', trailingslashit( get_template_directory_uri() ) . 'assets/css/responsive.css' );

	// If child theme is active, load the stylesheet.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'freshlife-child-style', get_stylesheet_uri() );
	}

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Loads HTML5 Shiv
	wp_enqueue_script( 'freshlife-html5', trailingslashit( get_template_directory_uri() ) . 'assets/js/html5shiv.min.js', array( 'jquery' ), null, false );
	wp_script_add_data( 'freshlife-html5', 'conditional', 'lte IE 9' );

}
add_action( 'wp_enqueue_scripts', 'freshlife_enqueue' );

/**
 * js / no-js script.
 *
 * @since  1.0.0
 */
function freshlife_no_js_script() {
?>
<script>document.documentElement.className = 'js';</script>
<?php
}
add_action( 'wp_footer', 'freshlife_no_js_script' );

/**
 * Mobile navigation scripts.
 *
 * @since  1.0.0
 */
function freshlife_mobile_nav_script() {
	?>
	<script type="text/javascript">

		$(document).ready(function(){
			$('#primary-menu').slicknav({
				prependTo:'#primary-bar',
				label: "PAGES"
			});
			$('#secondary-menu').slicknav({
				prependTo:'#secondary-bar',
				label: "CATEGORIES"
			});
		});

	</script>
	<?php
}
add_action( 'wp_footer', 'freshlife_mobile_nav_script', 20 );

/**
 * Facebook SDK for comment plugin
 *
 * @since  1.0.0
 */
function freshlife_facebook_sdk() {
	$enable = of_get_option( 'freshlife_fb_comment', 'off' );
	$appid = of_get_option( 'freshlife_fb_appid' );
	if ( $enable == 'on' && $appid ) {
		?>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=<?php echo $appid; ?>&version=v2.3";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		<?php
	}
}
add_action( 'wp_head', 'freshlife_facebook_sdk', 30 );

/**
 * Disqus comment count
 *
 * @since  1.0.0
 */
function freshlife_disqus_comment_count() {
	$enable = of_get_option( 'freshlife_disqus_comment', 'off' );
	$disqus_shortname = of_get_option( 'freshlife_disqus_shortname' );
	if ( $enable == 'on' && $disqus_shortname ) {
		?>
		<script type="text/javascript">
		    var disqus_shortname = '<?php echo $disqus_shortname; ?>';
		    (function () {
		        var s = document.createElement('script'); s.async = true;
		        s.type = 'text/javascript';
		        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
		        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
		    }());
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'freshlife_disqus_comment_count' );