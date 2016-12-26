<?php

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

// Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 484,
	'height'          => 76,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
	'flex-width'      => true,
	'uploads'       => true
) );

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

// Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );

// Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'anthology_pro_remove_comment_form_allowed_tags' );
function anthology_pro_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

// Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'anthology_pro_author_box_gravatar' );
function anthology_pro_author_box_gravatar( $size ) {

	return 90;

}

// Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'anthology_pro_comments_gravatar' );
function anthology_pro_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}