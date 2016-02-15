<?php
/**
 * Custom taxonomies custom fields.
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( is_admin() ) {

	/* 
	 * Configure your meta box.
	 */
	$config = array(
		'id'             => 'freshlife_cat_metabox',
		'title'          => __( 'Freslife Category Metabox', 'freshlife' ),
		'pages'          => array( 'category' ),
		'context'        => 'normal',
		'fields'         => array(),
		'local_images'   => false,
		'use_with_theme' => get_template_directory_uri() . '/admin/taxonomy'
	);

	/*
	 * Initiate your meta box.
	 */
	$my_meta =  new Tax_Meta_Class( $config );

	// Pull all tags into an array.
	$tags = array();
	$tags_obj = get_tags();
	$tags[''] = __( 'All Tags', 'freshlife' );
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_html( $tag->name );
	}
		
	/**
	 * Taxonomy field.
	 */
	$my_meta->addSelect( 'freshlife_cat_layout',
		array( 
			'grid' => __( 'Grid', 'freshlife' ),
			'list'  => __( 'List', 'freshlife' ),
			'blog'   => __( 'Blog', 'freshlife' ),
		),
		array( 'name'=> __( 'Category Layout Style', 'freshlife' ), 'std' => array( 'list' ) )
	);

	$my_meta->addSelect( 'freshlife_featured_tag',
		$tags,
		array( 'name'=> __( 'Featured Posts Tag', 'freshlife' ) )
	);

	$my_meta->addSelect( 'freshlife_featured_layout',
		array( 
			'classic' => __( 'Classic', 'freshlife' ),
			'slider'  => __( 'Slider', 'freshlife' ),
		),
		array( 'name'=> __( 'Featured Posts Style', 'freshlife' ), 'std' => array( 'classic' ) )
	);

	/**
	 * Finish.
	 */
	$my_meta->Finish();

}