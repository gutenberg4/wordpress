<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660; /* pixels */
}

if ( ! function_exists( 'freshlife_content_width' ) ) :
/**
 * Set new content width if user uses 1 column layout.
 *
 * @since  1.0.0
 */
function freshlife_content_width() {
	global $content_width;

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$content_width = 980;
	}
}
endif;
add_action( 'template_redirect', 'freshlife_content_width' );

if ( ! function_exists( 'freshlife_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function freshlife_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'freshlife', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare image sizes.
	add_image_size( 'freshlife-widget-thumb', 64, 64, true );
	add_image_size( 'freshlife-featured', 840, 450, true );
    add_image_size( 'freshlife-featured-2', 300, 300, true );
	add_image_size( 'freshlife-loop', 980, 520, true );
	add_image_size( 'freshlife-loop-list', 300, 215, true );
	add_image_size( 'freshlife-related', 200, 113, true );
	add_image_size( 'freshlife-megamenu-posts', 230, 140, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary'   => __( 'Primary Menu', 'freshlife' ),
			'secondary' => __( 'Secondary Menu', 'freshlife' )
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'freshlife_custom_background_args', array(
		'default-color' => 'e9e9e9',
		'default-image' => '',
	) ) );

	// Enable theme-layouts extensions.
	add_theme_support( 'theme-layouts',
		array(
			'1c'              => __( '1 Column Wide (Full Width)', 'freshlife' ),
			'content-sidebar' => __( '2 Columns: Content / Sidebar', 'freshlife' ),
			'sidebar-content' => __( '2 Columns: Sidebar / Content', 'freshlife' )
		),
		array( 'customize' => false, 'default' => 'content-sidebar' )
	);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // mystery_theme_setup
add_action( 'after_setup_theme', 'freshlife_theme_setup' );

/**
 * Registers custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function freshlife_widgets_init() {

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads.php';
	register_widget( 'Freshlife_Ads_Widget' );

	// Register ad 125 widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads125.php';
	register_widget( 'Freshlife_Ads125_Widget' );

	// Register feedburner widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-feedburner.php';
	register_widget( 'Freshlife_Feedburner_Widget' );

	// Register recent posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent.php';
	register_widget( 'Freshlife_Recent_Widget' );

	// Register popular posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-popular.php';
	register_widget( 'Freshlife_Popular_Widget' );

	// Register random posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-random.php';
	register_widget( 'Freshlife_Random_Widget' );

	// Register most views posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-views.php';
	register_widget( 'Freshlife_Views_Widget' );

	// Register tabs widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-tabs.php';
	register_widget( 'Freshlife_Tabs_Widget' );

	// Register twitter widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-twitter.php';
	register_widget( 'Freshlife_Twitter_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-video.php';
	register_widget( 'Freshlife_Video_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-posts.php';
	register_widget( 'Freshlife_Posts_Widget' );

	// Register social profiles widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-social.php';
	register_widget( 'Freshlife_Social_Widget' );

}
add_action( 'widgets_init', 'freshlife_widgets_init' );

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function freshlife_sidebars_init() {

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'freshlife' ),
			'id'            => 'primary',
			'description'   => __( 'The main sidebar, usually it appears on the right.', 'freshlife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'freshlife' ),
			'id'            => 'footer-1',
			'description'   => __( 'The footer sidebar 1st column.', 'freshlife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'freshlife' ),
			'id'            => 'footer-2',
			'description'   => __( 'The footer sidebar 2nd column.', 'freshlife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'freshlife' ),
			'id'            => 'footer-3',
			'description'   => __( 'The footer sidebar 3rd column.', 'freshlife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'freshlife' ),
			'id'            => 'footer-4',
			'description'   => __( 'The footer sidebar 4th column.', 'freshlife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'freshlife_sidebars_init' );

if ( ! function_exists( 'freshlife_posts_layout' ) ) {
	/**
	 * Custom posts layout classes.
	 *
	 * @since  1.0.0
	 */
	function freshlife_posts_layout() {

		// Get the default layout.
		if ( is_category() ) {
			$category = get_category( get_query_var( 'cat' ), false );
		$layout = get_tax_meta( $category->term_id, 'freshlife_cat_layout', true );
		if ( empty( $layout ) ) {
			$layout = 'list';
		}
		} elseif ( is_tag() ) {
			$layout = of_get_option( 'freshlife_tag_layout', 'list' );
		} elseif ( is_author() ) {
			$layout = of_get_option( 'freshlife_author_layout', 'list' );
		} elseif ( is_search() ) {
			$layout = of_get_option( 'freshlife_search_layout', 'list' );
		} elseif ( is_archive() ) {
			$layout = of_get_option( 'freshlife_archive_layout', 'list' );
		} else {
			$layout = of_get_option( 'freshlife_index_layout', 'list' );
		}

		// Set up empty variable.
		$class = '';

		// Layout classes.
		if ( 'grid' === $layout ) {
			$class = 'loop-grid';
		} elseif ( 'list' === $layout ) {
			$class = 'loop-list';
		} elseif ( 'blog' === $layout ) {
			$class = 'loop-blog';
		}

		// Display the class.
		return $class;

	}
}

if ( ! function_exists( 'freshlife_disqus_embed' ) ) {
	/**
	 * Disqus comment embed.
	 *
	 * @since  1.0.0
	 */
	function freshlife_disqus_embed() {
	    global $post;
	    $enable = of_get_option( 'freshlife_disqus_comment', 'off' );
	    $disqus_shortname = of_get_option( 'freshlife_disqus_shortname' );
	    if ( $enable == 'on' && $disqus_shortname ) {
		    wp_enqueue_script('disqus_embed','http://' . $disqus_shortname . '.disqus.com/embed.js');
		    echo '<div id="disqus_thread"></div>
		    <script type="text/javascript">
		        var disqus_shortname = "' . $disqus_shortname . '";
		        var disqus_title = "' . $post->post_title . '";
		        var disqus_url = "' . get_permalink($post->ID) . '";
		        var disqus_identifier = "' . $disqus_shortname . ' - ' . $post->ID . '";
		    </script>';
		}
	}
}

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins.php';

/**
 * Load Jetpack compatibility file.
 */
require trailingslashit( get_template_directory() ) . 'inc/jetpack.php';

/**
 * Mega menus walker.
 */
require trailingslashit( get_template_directory() ) . 'inc/megamenus/init.php';
require trailingslashit( get_template_directory() ) . 'inc/megamenus/class-primary-nav-walker.php';

/**
 * Load Options Framework core.
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'admin/' );
require trailingslashit( get_template_directory() ) . 'admin/options-framework.php';
require trailingslashit( get_template_directory() ) . 'admin/options.php';
require trailingslashit( get_template_directory() ) . 'admin/options-functions.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/attr.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/loop-pagination.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/theme-layouts.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/entry-views.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/breadcrumb-trail.php';

/**
 * Load taxonomy framework.
 */
require trailingslashit( get_template_directory() ) . 'admin/taxonomy/Tax-meta-class.php';
require trailingslashit( get_template_directory() ) . 'admin/taxonomy/tax-meta.php';