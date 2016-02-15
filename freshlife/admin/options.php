<?php
/**
 * Theme Options.
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 *
 * @since  1.0.0
 */
function optionsframework_option_name() {
	return 'freshlife'; // Theme slug
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * @since  1.0.0
 */
function optionsframework_options() {

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	$options_categories[''] = __( 'All Categories', 'freshlife' );
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	$options_tags[''] = __( 'All Tags', 'freshlife' );
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = __( 'Select a page:', 'freshlife' );
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$featured_array = array(
		'slider' => __( 'slider', 'freshlife' ),
		'classic' => __( 'classic', 'freshlife' ),
		'disable' => __( 'disable', 'freshlife' )
	);

	// Image path
	$imagepath =  get_template_directory_uri() . '/assets/img/';

	// Set empty $options.
	$options = array();

	/**
	 * Defines array of options.
	 */
	
	// ============================ //
	// ===== General Settings ===== //
	// ============================ //
	$options[] = array(
		'name' => __( 'General', 'freshlife' ),
		'type' => 'heading'
	);

		$options['freshlife_colors'] = array(
			'name' => __( 'Accent Colors', 'freshlife' ),
			'desc' => __( 'Please choose the preset color for your website.', 'freshlife' ),
			'id'   => 'freshlife_colors',
			'type' => 'radio',
			'std'  => 'blue',
			'options' => array(
				'blue'        => __( 'Blue', 'freshlife' ),
				'green'       => __( 'Green', 'freshlife' ),
				'red'  		  => __( 'Red', 'freshlife' ),
			)
		);

		$options['freshlife_color_pallete'] = array(
			'name' => '',
			'desc' => __( 'If you don\' like the preset colors, you can choose the color you like from the pallete.', 'freshlife' ),
			'id'   => 'freshlife_color_pallete',
			'std'  => '#2266bb',
			'type' => 'color'
		);

		$options['freshlife_favicon'] = array(
			'name' => __( 'Favicon', 'freshlife' ),
			'desc' => __( 'Your custom favicon. 32x32px recommended.', 'freshlife' ),
			'id'   => 'freshlife_favicon',
			'type' => 'upload'
		);

		$options['freshlife_mobile_icon'] = array(
			'name' => __( 'Mobile Icon', 'freshlife' ),
			'desc' => __( '144x144 recommended in PNG format. This icon will be used when users add your website as a shortcut on mobile devices like iPhone, iPad, Android etc.', 'freshlife' ),
			'id'   => 'freshlife_mobile_icon',
			'type' => 'upload'
		);

		$options[] = array(
			'name'  => __( 'FeedBurner URL', 'freshlife' ),
			'desc'  => __( 'Enter your full FeedBurner URL. If you wish to use FeedBurner over the standard WordPress feed.', 'freshlife' ),
			'id'    => 'freshlife_feedburner_url',
			'placeholder' => 'http://feeds.feedburner.com/ThemeJunkie',
			'type'  => 'text'
		);

		$options['freshlife_tracking_code'] = array(
			'name' => __( 'Tracking Code', 'freshlife' ),
			'desc' => __( 'Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'freshlife' ),
			'id'   => 'freshlife_tracking_code',
			'type' => 'textarea'
		);

	// ============================ //
	// ===== Header Settings ===== //
	// ============================ //
	$options[] = array(
		'name' => __( 'Header', 'freshlife' ),
		'type' => 'heading'
	);

		$options['freshlife_logo'] = array(
			'name' => __( 'Logo', 'freshlife' ),
			'desc' => __( 'Upload your custom logo, it will automatically replace the Site Title', 'freshlife' ),
			'id'   => 'freshlife_logo',
			'type' => 'upload'
		);

		$options['freshlife_logo_retina'] = array(
			'name' => __( 'Retina Logo', 'freshlife' ),
			'desc' => __( 'Upload your retina version of your logo. eg: logo@2x.png', 'freshlife' ),
			'id'   => 'freshlife_logo_retina',
			'type' => 'upload'
		);

		$options[] = array(
			'name' => __( 'Site Description', 'freshlife' ),
			'desc' => __( 'Display the site description.', 'freshlife' ),
			'id'   => 'freshlife_site_desc',
			'std'  => 'on',
			'type' => 'onoff'
		);

		$options[] = array(
			'name' => __( 'Social Settings', 'freshlife' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options[] = array(
				'name' => __( 'Enable', 'freshlife' ),
				'desc' => __( 'Enable social icons in header.', 'freshlife' ),
				'id'   => 'freshlife_enable_social_header',
				'std'  => 'on',
				'type' => 'onoff'
			);

			$options[] = array(
				'name'        => __( 'Twitter URL', 'freshlife' ),
				'desc'        => __( 'Enter your twitter profile URL.', 'freshlife' ),
				'id'          => 'freshlife_twitter_url',
				'placeholder' => 'http://twitter.com/',
				'type'        => 'text'
			);

			$options[] = array(
				'name'        => __( 'Facebook URL', 'freshlife' ),
				'desc'        => __( 'Enter your facebook profile  URL.', 'freshlife' ),
				'id'          => 'freshlife_fb_url',
				'placeholder' => 'http://www.facebook.com/',
				'type'        => 'text'
			);

			$options[] = array(
				'name'        => __( 'Google Plus URL', 'freshlife' ),
				'desc'        => __( 'Enter your google plus profile  URL.', 'freshlife' ),
				'id'          => 'freshlife_gplus_url',
				'placeholder' => 'http://plus.google.com/',
				'type'        => 'text'
			);

			$options[] = array(
				'name'  => __( 'Feed URL', 'freshlife' ),
				'desc'  => __( 'Enter your website feed URL.', 'freshlife' ),
				'id'    => 'freshlife_feed_url',
				'std'   => esc_url( get_feed_link() ),
				'type'  => 'text'
			);

	// ======================================== //
	// ===== Index and Archive Settings ======= //
	// ======================================== //
	$options[] = array(
		'name' => __( 'Index and Archive', 'freshlife' ),
		'type' => 'heading'
	);

		$options[] = array(
			'name' => __( 'Home Featured Posts Settings', 'freshlife' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options['freshlife_featured_content'] = array(
				'name' => __( 'Home featured', 'freshlife' ),
				'desc' => __( 'home featured layout', 'freshlife' ),
				'id' => 'freshlife_featured_content',
				'std' => 'slider',
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => $featured_array
			);


			$options[] = array(
				'name'    => __( 'Featured Posts Tag', 'freshlife' ),
				'desc'    => __( 'Select a tag to be used as Featured Posts.', 'freshlife' ),
				'id'      => 'freshlife_featured_tag',
				'type'    => 'select',
				'options' => $options_tags
			);

			$options[] = array(
				'name'  => __( 'Limit', 'freshlife' ),
				'desc'  => __( 'Number of posts to show.', 'freshlife' ),
				'id'    => 'freshlife_featured_num',
				'std'   => 3,
				'type'  => 'text'
			);

		$options[] = array(
			'name' => __( 'Posts Listing Settings', 'freshlife' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options[] = array(
				'name'  => __( 'All Stories', 'freshlife' ),
				'desc'  => __( 'Customize the All Stories text.', 'freshlife' ),
				'id'    => 'freshlife_wn_text',
				'std'   => __( 'All Stories', 'freshlife' ),
				'type'  => 'text'
			);

			$options['freshlife_index_layout'] = array(
				'name'   => __( 'Index Posts Layout', 'freshlife' ),
				'desc'   => __( 'Choose the index posts layout.', 'freshlife' ),
				'id'     => 'freshlife_index_layout',
				'std'    => 'list',
				'type'   => 'select',
				'options' => array(
					'grid'   => __( 'Grid', 'freshlife' ),
					'list'   => __( 'List', 'freshlife' ),
					'blog'   => __( 'Blog', 'freshlife' ),
				)
			);

			$options['freshlife_tag_layout'] = array(
				'name'   => __( 'Tag Posts Layout', 'freshlife' ),
				'desc'   => __( 'Choose the tag archive page posts layout.', 'freshlife' ),
				'id'     => 'freshlife_tag_layout',
				'std'    => 'list',
				'type'   => 'select',
				'options' => array(
					'grid'   => __( 'Grid', 'freshlife' ),
					'list'   => __( 'List', 'freshlife' ),
					'blog'   => __( 'Blog', 'freshlife' ),
				)
			);

			$options['freshlife_author_layout'] = array(
				'name'   => __( 'Author Posts Layout', 'freshlife' ),
				'desc'   => __( 'Choose the author archive page posts layout.', 'freshlife' ),
				'id'     => 'freshlife_author_layout',
				'std'    => 'list',
				'type'   => 'select',
				'options' => array(
					'grid'   => __( 'Grid', 'freshlife' ),
					'list'   => __( 'List', 'freshlife' ),
					'blog'   => __( 'Blog', 'freshlife' ),
				)
			);

			$options['freshlife_search_layout'] = array(
				'name'   => __( 'Search Posts Layout', 'freshlife' ),
				'desc'   => __( 'Choose the search page posts layout.', 'freshlife' ),
				'id'     => 'freshlife_search_layout',
				'std'    => 'list',
				'type'   => 'select',
				'options' => array(
					'grid'   => __( 'Grid', 'freshlife' ),
					'list'   => __( 'List', 'freshlife' ),
					'blog'   => __( 'Blog', 'freshlife' ),
				)
			);

			$options['freshlife_archive_layout'] = array(
				'name'   => __( 'Archive Posts Layout', 'freshlife' ),
				'desc'   => __( 'Choose the archive page(date, month, year) posts layout.', 'freshlife' ),
				'id'     => 'freshlife_archive_layout',
				'std'    => 'list',
				'type'   => 'select',
				'options' => array(
					'grid'   => __( 'Grid', 'freshlife' ),
					'list'   => __( 'List', 'freshlife' ),
					'blog'   => __( 'Blog', 'freshlife' ),
				)
			);

	// ================================ //
	// ===== Single Post Settings ===== //
	// ================================ //
	$options[] = array(
		'name' => __( 'Single Post', 'freshlife' ),
		'type' => 'heading'
	);

		$options[] = array(
			'name' => __( 'Facebook Comment Settings', 'freshlife' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options[] = array(
				'name' => __( 'Facebook Comment', 'freshlife' ),
				'desc' => __( 'Use facebook comment.', 'freshlife' ),
				'id'   => 'freshlife_fb_comment',
				'std'  => 'off',
				'type' => 'onoff'
			);

			$options[] = array(
				'name'        => __( 'App ID', 'freshlife' ),
				'desc'        => __( 'Enter your facebook App ID to enable facebook comment.', 'freshlife' ),
				'id'          => 'freshlife_fb_appid',
				'type'        => 'text'
			);

		$options[] = array(
			'name' => __( 'Disqus Comment Settings', 'freshlife' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options[] = array(
				'name' => __( 'Disqus Comment', 'freshlife' ),
				'desc' => __( 'Use disqus comment.', 'freshlife' ),
				'id'   => 'freshlife_disqus_comment',
				'std'  => 'off',
				'type' => 'onoff'
			);

			$options[] = array(
				'name' => __( 'Disqus Shortname', 'freshlife' ),
				'desc' => __( 'Enter your disqus shortname.', 'freshlife' ),
				'id'   => 'freshlife_disqus_shortname',
				'type' => 'text'
			);

		$options[] = array(
			'name' => __( 'Post Misc Settings', 'freshlife' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options['freshlife_featured_image'] = array(
				'name' => __( 'Featured Image', 'freshlife' ),
				'desc' => __( 'Display featured image.', 'freshlife' ),
				'id'   => 'freshlife_featured_image',
				'std'  => 'on',
				'type' => 'onoff'
			);

			$options['freshlife_post_author'] = array(
				'name' => __( 'Author Bio', 'freshlife' ),
				'desc' => __( 'Display author bio.', 'freshlife' ),
				'id'   => 'freshlife_post_author',
				'std'  => 'on',
				'type' => 'onoff'
			);

			$options['freshlife_share_buttons'] = array(
				'name' => __( 'Share Buttons', 'freshlife' ),
				'desc' => __( 'Display the social share buttons info.', 'freshlife' ),
				'id'   => 'freshlife_share_buttons',
				'std'  => 'on',
				'type' => 'onoff'
			);

		$options[] = array(
			'name' => __( 'Related Posts Settings', 'freshlife' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options['freshlife_related_posts'] = array(
				'name' => __( 'Related Posts', 'freshlife' ),
				'desc' => __( 'Display the related posts.', 'freshlife' ),
				'id'   => 'freshlife_related_posts',
				'std'  => 'on',
				'type' => 'onoff'
			);

		$options[] = array(
			'name' => __( 'Advertisement Settings', 'freshlife' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options['freshlife_ad_single_before'] = array(
				'name' => __( 'Before Content Advertisement', 'freshlife' ),
				'desc' => __( 'Your ad will appear on single post before content.', 'freshlife' ),
				'id'   => 'freshlife_ad_single_before',
				'type' => 'textarea'
			);

			$options['freshlife_ad_single_after'] = array(
				'name' => __( 'After Content Advertisement', 'freshlife' ),
				'desc' => __( 'Your ad will appear on single post after content.', 'freshlife' ),
				'id'   => 'freshlife_ad_single_after',
				'type' => 'textarea'
			);

	// =========================== //
	// ===== Footer Settings ===== //
	// =========================== //
	$options[] = array(
		'name' => __( 'Footer', 'freshlife' ),
		'type' => 'heading'
	);

		$options['freshlife_footer_text'] = array(
			'name' => __( 'Footer Text', 'freshlife' ),
			'desc' => __( 'You can customize the footer text here.', 'freshlife' ),
			'id'   => 'freshlife_footer_text',
			'std'  => 'Powered by <a href="http://wordpress.org">WordPress</a> · Designed by <a href="http://www.theme-junkie.com" title="Premium WordPress Themes">Theme Junkie</a>',
			'type' => 'editor'
		);

	// ================================== //
	// ===== Advertisement Settings ===== //
	// ================================== //
	$options[] = array(
		'name' => __( 'Advertisement', 'freshlife' ),
		'type' => 'heading'
	);

		$options['freshlife_header_ad'] = array(
			'name' => __( 'Header Advertisement', 'freshlife' ),
			'desc' => __( 'The ad will appear at the top of your site. Recommended size 728x90', 'freshlife' ),
			'id'   => 'freshlife_header_ad',
			'type' => 'textarea'
		);

		$options['freshlife_archive_ad'] = array(
			'name' => __( 'Archive Advertisement', 'freshlife' ),
			'desc' => __( 'The ad will appear between featured section and all stories. Recommended size 468x60', 'freshlife' ),
			'id'   => 'freshlife_archive_ad',
			'type' => 'textarea'
		);

	// ================================== //
	// ===== Custom Code Settings ======= //
	// ================================== //
	$options[] = array(
		'name' => __( 'Custom Code', 'freshlife' ),
		'type' => 'heading'
	);

		$options['freshlife_script_head'] = array(
			'name' => __( 'Header code', 'freshlife' ),
			'desc' => __( 'If you need to add custom scripts to your header (meta tag verification, google fonts url), you should enter them in the box. They will be added before &lt;/head&gt; tag', 'freshlife' ),
			'id'   => 'freshlife_script_head',
			'type' => 'textarea'
		);

		$options['freshlife_script_footer'] = array(
			'name' => __( 'Footer code', 'freshlife' ),
			'desc' => __( 'If you need to add custom scripts to your footer, you should enter them in the box. They will be added before &lt;/body&gt; tag', 'freshlife' ),
			'id'   => 'freshlife_script_footer',
			'type' => 'textarea'
		);
	
	// Allow dev to filter the theme options.
	return apply_filters( 'freshlife_theme_options', $options );
}