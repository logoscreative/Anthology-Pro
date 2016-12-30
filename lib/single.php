<?php

// Add featured image to single content piece
add_filter( 'genesis_attr_content', 'anthology_pro_add_single_background');

function anthology_pro_add_single_background($attributes) {

	if ( is_single() && has_post_thumbnail() ) {

		$content_thumbnail = wp_get_attachment_image_src(
			get_post_thumbnail_id(),
			'large',
			true
		);

		$attributes['style'] = 'background-image: url(' . $content_thumbnail[0] . ')';

	}

	return $attributes;

}

// Add featured image to single content piece
add_filter( 'genesis_attr_entry', 'anthology_pro_cover_single_background');

function anthology_pro_cover_single_background($attributes) {

	if ( is_single() && has_post_thumbnail() ) {

		$attributes['class'] = $attributes['class'] . ' dark-cover';

	}

	return $attributes;

}
