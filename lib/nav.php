<?php

// Register header navigation menu
register_nav_menu( 'header', __( 'Header Menu', 'genesis-header-nav' ) );

// Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array(
	'primary' => __( 'After Header Menu', 'anthology-pro' ),
	'secondary' => __( 'Footer Menu', 'anthology-pro' ) ) );

// Maybe move the primary navigation to the header (if no widget in header-right)
// add_action( 'genesis_before', 'move_primary_nav_if_no_header_widget' );
// function move_primary_nav_if_no_header_widget() {
// 	if ( is_active_sidebar( 'header-right' ) ) {
// 		return;
// 	}
// 	remove_action( 'genesis_after_header', 'genesis_do_nav' );
// 	add_action( 'genesis_header', 'genesis_do_nav', 13 );
// }

// Display header navigation menu (via @GaryJ Genesis Header Nav plugin)
add_action( 'genesis_header', 'show_menu' );
apply_filters( 'genesis_header_nav_priority', 12 );
function show_menu() {
	$class = 'menu genesis-nav-menu menu-header';
	if ( genesis_superfish_enabled() ) {
		$class .= ' js-superfish';
	}

	genesis_nav_menu(
		array(
			'theme_location' => 'header',
			'menu_class'     => $class,
		)
	);
}

/**
 * Add ID/aria label to secondary navigation.
 * @param $attributes
 *
 * @return mixed
 */
add_filter( 'genesis_attr_nav-header', 'anthology_pro_add_nav_header_id' );
function anthology_pro_add_nav_header_id( $attributes ) {
	$attributes['id']         = 'menu-header-navigation';
	$attributes['aria-label'] = __( 'Header navigation', 'anthology-pro' );
	return $attributes;
}

add_filter( 'genesis_skip_links_output', 'anthology_pro_add_nav_header_skip_link' );
/**
 * Add the header navigation menu to the skip links output.
 * @param $links
 *
 * @return array
 */
function anthology_pro_add_nav_header_skip_link( $links ) {
	$new_links = $links;
	array_splice( $new_links, 1 );

	if ( has_nav_menu( 'header' ) ) {
		$new_links['menu-header-navigation'] = __( 'Skip to header navigation', 'anthology-pro' );
	}

	return array_merge( $new_links, $links );
}

// Reposition the secondary navigation menu to footer, if wanted
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );