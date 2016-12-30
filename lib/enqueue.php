<?php

add_action( 'wp_enqueue_scripts', 'anthology_pro_scripts_styles' );
function anthology_pro_scripts_styles() {

	//wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'anthology-pro-fonts', '//fonts.googleapis.com/css?family=Nunito:300,300i,800,800i', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'anthology-pro-responsive-menu', get_stylesheet_directory_uri() . '/js/min/responsive-menu.min.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' 		=> __( 'Menu', 'anthology-pro' ),
		'subMenu'  		=> __( 'Menu', 'anthology-pro' ),
		'headerMenu'  => __( 'Menu', 'anthology-pro' ),
	);
	wp_localize_script( 'anthology-pro-responsive-menu', 'mobileFirstSassL10n', $output );

	// Because who wants Superfish?
	// wp_deregister_script( 'superfish' );
	// wp_deregister_script( 'superfish-args' );

	$version = defined( 'CHILD_THEME_VERSION' ) && CHILD_THEME_VERSION ? CHILD_THEME_VERSION : PARENT_THEME_VERSION;
	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	wp_enqueue_style( $handle, get_stylesheet_directory_uri() . '/style.min.css', false, $version);

}

// De-register uncompressed stylesheet - minified loaded above
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

// Deregister WP 4.2 Emoji support
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );