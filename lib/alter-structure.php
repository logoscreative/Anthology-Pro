<?php

// Remove site-container class instead of overriding CSS
add_filter( 'genesis_attr_site-container', 'anthology_pro_remove_site_container_class', 10, 2 );

function anthology_pro_remove_site_container_class( $attributes, $context ) {

	$attributes['class'] = '';
	return $attributes;

}