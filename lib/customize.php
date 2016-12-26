<?php
/**
 * Genesis Sample.
 *
 * This file adds the Customizer additions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

/**
 * Get default link color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 2.2.3
 *
 * @return string Hex color code for link color.
 */
function anthology_pro_customizer_get_default_link_color() {
	return apply_filters( 'filter_anthology_pro_customizer_get_default_link_color', '#231F20' );
}

/**
 * Get default accent color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 2.2.3
 *
 * @return string Hex color code for accent color.
 */
function anthology_pro_customizer_get_default_accent_color() {
	return apply_filters( 'filter_anthology_pro_customizer_get_default_accent_color', '#8E793E' );
}

add_action( 'customize_register', 'anthology_pro_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function anthology_pro_customizer_register() {

	global $wp_customize;

	$wp_customize->add_section( 'anthology-pro-settings', array(
		'description' => __( 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1000 pixels tall</strong>.', 'anthology-pro' ),
		'title'    => __( 'Front Page Background Image', 'anthology-pro' ),
		'priority' => 35,
	) );

	$wp_customize->add_setting( 'anthology-pro-image', array(
		'default'  => sprintf( '%s/images/bg-1.jpg', get_stylesheet_directory_uri() ),
		'sanitize_callback' => 'esc_url_raw',
		'type'     => 'option',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'anthology-pro-image', array(
		'label'    => sprintf( __( 'Front Page: Hero Image', 'anthology-pro' ) ),
		'section'  => 'anthology-pro-settings',
		'settings' => 'anthology-pro-image',
		'priority' => 1,
	) ) );

	$wp_customize->add_setting(
		'anthology_pro_link_color',
		array(
			'default'           => anthology_pro_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'anthology_pro_link_color',
			array(
				'description' => __( 'Change the default color for linked titles, menu links, post info links and more.', 'genesis-sample' ),
			    'label'       => __( 'Link Color', 'genesis-sample' ),
			    'section'     => 'colors',
			    'settings'    => 'anthology_pro_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'anthology_pro_accent_color',
		array(
			'default'           => anthology_pro_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'anthology_pro_accent_color',
			array(
				'description' => __( 'Change the default color for button hovers.', 'genesis-sample' ),
			    'label'       => __( 'Accent Color', 'genesis-sample' ),
			    'section'     => 'colors',
			    'settings'    => 'anthology_pro_accent_color',
			)
		)
	);

}
