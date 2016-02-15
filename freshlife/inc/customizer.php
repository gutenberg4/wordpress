<?php
/**
 * Mystery Theme Customizer.
 *
 * @package    Freshlife
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Load textarea control for the customizer.
 *
 * @since  1.0.0
 */
function freshlife_textarea_customize_control() {
	require trailingslashit( get_template_directory() ) . 'inc/classes/customize-control-textarea.php';
}
add_action( 'customize_register', 'freshlife_textarea_customize_control', 1 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function freshlife_customize_preview_js() {
	wp_enqueue_script( 'freshlife_customizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'freshlife_customize_preview_js' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since  1.0.0
 * @param  WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function freshlife_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport            = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport    = 'postMessage';

	// Get the theme settings value.
	$options = optionsframework_options();

	// ==== Logo Setting ==== //
	$wp_customize->add_section(
		'freshlife_logo_section',
		array(
			'title'       => esc_html__( 'Logo', 'freshlife' ),
			'description' => __( 'If you use logo, the title and tagline will be replaced with the logo you uploaded.', 'freshlife' ),
			'priority'    => 25,
		)
	);

		$wp_customize->add_setting(
			'freshlife[freshlife_logo]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'freshlife_logo_control',
				array(
					'label'    => $options['freshlife_logo']['name'],
					'section'  => 'freshlife_logo_section',
					'settings' => 'freshlife[freshlife_logo]'
				)
			) );

		$wp_customize->add_setting(
			'freshlife[freshlife_logo_retina]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'freshlife_logo_retina_control',
				array(
					'label'    => $options['freshlife_logo_retina']['name'],
					'section'  => 'freshlife_logo_section',
					'settings' => 'freshlife[freshlife_logo_retina]'
				)
			) );

	// ==== Favicon Setting ==== //
	$wp_customize->add_section(
		'freshlife_favicon_settings',
		array(
			'title'       => esc_html__( 'Favicon', 'freshlife' ),
			'description' => $options['freshlife_favicon']['desc'],
			'priority'    => 28,
		)
	);

		$wp_customize->add_setting(
			'freshlife[freshlife_favicon]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'freshlife_favicon_control',
				array(
					'label'    => $options['freshlife_favicon']['name'],
					'section'  => 'freshlife_favicon_settings',
					'settings' => 'freshlife[freshlife_favicon]'
				)
			) );

		$wp_customize->add_setting(
			'freshlife[freshlife_mobile_icon]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'freshlife_mobile_icon_control',
				array(
					'label'    => $options['freshlife_mobile_icon']['name'],
					'section'  => 'freshlife_favicon_settings',
					'settings' => 'freshlife[freshlife_mobile_icon]'
				)
			) );

	// ==== Single Post Setting ==== //
	$wp_customize->add_section(
		'freshlife_post_setting',
		array(
			'title'    => esc_html__( 'Single Post', 'freshlife' ),
			'priority' => 190,
		)
	);

		$wp_customize->add_setting(
			'freshlife[freshlife_ad_single_before]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'freshlife_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new Freshlife_Customize_Control_Textarea( $wp_customize, 'freshlife_ad_before_control',
				array(
					'label'    => $options['freshlife_ad_single_before']['name'],
					'section'  => 'freshlife_post_setting',
					'settings' => 'freshlife[freshlife_ad_single_before]'
				)
			) );

		$wp_customize->add_setting(
			'freshlife[freshlife_ad_single_after]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'freshlife_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new Freshlife_Customize_Control_Textarea( $wp_customize, 'freshlife_ad_after_control',
				array(
					'label'    => $options['freshlife_ad_single_after']['name'],
					'section'  => 'freshlife_post_setting',
					'settings' => 'freshlife[freshlife_ad_single_after]'
				)
			) );

	// ==== Advertisement Setting ==== //
	$wp_customize->add_section(
		'freshlife_ad_setting',
		array(
			'title'       => esc_html__( 'Advertisement', 'freshlife' ),
			'priority'    => 195,
		)
	);

		$wp_customize->add_setting(
			'freshlife[freshlife_header_ad]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'freshlife_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new Freshlife_Customize_Control_Textarea( $wp_customize, 'freshlife_header_ad_control',
				array(
					'label'    => $options['freshlife_header_ad']['name'],
					'section'  => 'freshlife_ad_setting',
					'settings' => 'freshlife[freshlife_header_ad]'
				)
			) );

	// ==== Footer Text Setting ==== //
	$wp_customize->add_section(
		'freshlife_footer_settings',
		array(
			'title'       => $options['freshlife_footer_text']['name'],
			'description' => $options['freshlife_footer_text']['desc'],
			'priority'    => 200,
		)
	);

		$wp_customize->add_setting(
			'freshlife[freshlife_footer_text]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'freshlife_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new Freshlife_Customize_Control_Textarea( $wp_customize, 'freshlife_footer_control',
				array(
					'label'    => $options['freshlife_footer_text']['name'],
					'section'  => 'freshlife_footer_settings',
					'settings' => 'freshlife[freshlife_footer_text]'
				)
			) );

}
add_action( 'customize_register', 'freshlife_customize_register' );

if ( ! function_exists( 'freshlife_sanitize_customizer_textarea' ) ) {
	/**
	 * Sanitize chooser.
	 *
	 * @since  1.0.1
	 */
	function freshlife_sanitize_customizer_textarea( $string ) {
		return stripslashes( $string );
	}
}

if ( ! function_exists( 'freshlife_sanitize_checkbox' ) ) {
	/**
	 * Sanitize a checkbox to only allow 0 or 1
	 *
	 * @since  1.0.0.
	 *
	 * @param  boolean    $value    The unsanitized value.
	 * @return boolean				The sanitized boolean.
	 */
	function freshlife_sanitize_checkbox( $value ) {
		if ( $value == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'freshlife_sanitize_chooser' ) ) {
	/**
	 * Sanitize chooser.
	 *
	 * @since  1.0.1
	 */
	function freshlife_sanitize_chooser( $input ) {
		global $wp_customize;
	 
		$control = $wp_customize->get_control( $setting->id );
	 
		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}