<?php

add_action( 'genesis_meta', 'anthology_pro_front_page_genesis_meta' );

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function anthology_pro_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) ) {

		//* Add front-page body class
		add_filter( 'body_class', 'anthology_pro_body_class' );
		function anthology_pro_body_class( $classes ) {

			$classes[] = 'front-page';

			return $classes;

		}

		//* Force full width content layout
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add front page widgets
		add_action( 'genesis_loop', 'anthology_pro_front_page_widgets' );

	}

}

//* Add markup for front page widgets
function anthology_pro_front_page_widgets() {

	echo '<h2 class="screen-reader-text">' . __( 'Main Content', 'anthology_pro_' ) . '</h2>';

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div id="front-page-1" class="front-page-1"><div class="dark-cover"><div class="image-section widget-area fadeup-effect">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2"><div class="solid-section flexible-widgets widget-area fadeup-effect"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

}

//* Run the Genesis loop
genesis();