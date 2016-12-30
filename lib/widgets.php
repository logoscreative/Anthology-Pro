<?php

// Add support for 1-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page: Hero', 'anthology-pro' ),
	'description' => __( 'Top, main area of the homepage with background image', 'anthology-pro' ),
) );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page: Content', 'anthology-pro' ),
	'description' => __( 'Second area of the homepage', 'anthology-pro' ),
) );