<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function freshlife_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( ! is_home() && ! is_front_page() && ! is_archive() && ! is_search() ) {
		if ( in_array( get_theme_mod( 'theme_layout' ), array( 'content-sidebar' ) ) ) {
			$classes[] = 'content-sidebar';
		}
	}

	if ( in_array( get_theme_mod( 'theme_layout' ), array( 'sidebar-content' ) ) ) {
		$classes[] = 'sidebar-content';
	}

	return $classes;
}
add_filter( 'body_class', 'freshlife_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function freshlife_post_classes( $classes ) {

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'freshlife_post_classes' );

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 * @return string
 */
function freshlife_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'freshlife_excerpt_more' );

/**
 * Remove theme-layouts meta box on attachment and bbPress post type.
 *
 * @since 1.0.0
 */
function freshlife_remove_theme_layout_metabox() {
	remove_post_type_support( 'attachment', 'theme-layouts' );
	remove_post_type_support( 'forum', 'theme-layouts' );
	remove_post_type_support( 'topic', 'theme-layouts' );
	remove_post_type_support( 'reply', 'theme-layouts' );
}
add_action( 'init', 'freshlife_remove_theme_layout_metabox', 11 );

/**
 * Add post type 'post' support for the Simple Page Sidebars plugin.
 *
 * @since  1.0.0
 */
function freshlife_page_sidebar_plugin() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'simple-page-sidebars/simple-page-sidebars.php' ) ) {
		add_post_type_support( 'post', 'simple-page-sidebars' );
	}
}
add_action( 'init', 'freshlife_page_sidebar_plugin' );

/**
 * Custom comment form fields.
 *
 * @since  1.0.0
 * @param  array $fields
 * @return array
 */
function freshlife_comment_form_fields( $fields, $args = array() ) {

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html5     = 'html5' === $args['format'];

	$fields['author'] = '<p class="comment-form-author">' . '<label for="author"> ' . __( 'Name', 'freshlife' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input class="txt" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields['email'] = '<p class="comment-form-email"><label for="email"> ' . __( 'Email', 'freshlife' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input class="txt" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields['url'] = '<p class="comment-form-url"><label for="url"> ' . __( 'Website', 'freshlife' ) . '</label> ' . '<input class="txt" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	return $fields;

}
add_filter( 'comment_form_default_fields', 'freshlife_comment_form_fields' );

/**
 * Custom comment form submit field.
 *
 * @since  1.0.0
 */
function freshlife_comment_button() {
	echo '<input class="btn" name="submit" type="submit" id="submit" value="' . esc_attr__( 'Post Comment', 'freshlife' ) . '" />';
}
add_action( 'comment_form', 'freshlife_comment_button' );