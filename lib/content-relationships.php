<?php

// Set related content types conditionally
add_action( 'wp', 'anthology_pro_set_related_content_types' );
function anthology_pro_set_related_content_types() {

	// Set child elements
	add_filter( 'filter_anthology_related_content_type', 'anthology_pro_filter_related_content_type' );
	add_filter( 'filter_anthology_related_content_relationship_meta_field', 'anthology_pro_filter_collection_relationship' );

}

function anthology_pro_filter_related_content_type() {

	// Set a smart default
	$content_type = 'post';

	// Set the related content parent
	$related_content_parent = apply_filters( 'filter_anthology_related_content_parent', 'collection' );

	if ( is_front_page() ) {

		// Swap for parent elements
		$content_type = 'collection';

	} elseif ( is_singular( $related_content_parent ) ) {

		// Swap for child elements
		$content_type = 'element';

	}

	return $content_type;

}

function anthology_pro_filter_collection_relationship() {

	// Set a smart default
	$content_type = '';

	// Set the related content parent
	$related_content_parent = apply_filters( 'filter_anthology_related_content_parent', 'collection' );

	if ( is_singular( $related_content_parent ) ) {

		// Swap for child elements
		$content_type = 'collection_relationship';

	}

	return $content_type;

}

// Bring in related content
add_action( 'genesis_after_content', 'anthology_pro_get_related_content_markup' );
function anthology_pro_get_related_content_markup() {

	// Set the related content parent
	$related_content_parent = apply_filters( 'filter_anthology_related_content_parent', 'collection' );

	if ( is_singular( $related_content_parent ) || is_front_page() ) {

		// Semantically wrap related content
		$related_content_opening_classes = apply_filters( 'filter_anthology_related_content_wrap_classes', 'related-content-wrap wrap' );
		$related_content_opening = '<section><div class="' . $related_content_opening_classes . '">';

		// Get related content
		$related_content_items = anthology_pro_get_related_content();

		if ( $related_content_items ) {

			$related_content = '';

			foreach ( $related_content_items as $related_content_item ) {

				// Get content data
				$related_content_item_id = $related_content_item->ID;
				$related_content_item_permalink = get_permalink($related_content_item_id);
				$related_content_item_title = get_the_title($related_content_item_id);
				$related_content_item_excerpt = wp_trim_words( $related_content_item->post_content, 30 );

				// Semantically wrap related content item
				$opening_tag_classes = apply_filters( 'filter_anthology_related_content_item_wrap_opening_class', 'related-content-item' );

				$opening_tag = '<article><div class="' . $opening_tag_classes . '">';

				// Add featured image
				if ( has_post_thumbnail($related_content_item_id) ) {

					$related_content_thumbnail_array = wp_get_attachment_image_src(
						get_post_thumbnail_id($related_content_item_id),
						'medium',
						true
					);
					$opening_tag .= $opening_tag_featured_image = '<div class="related-content-item-bg" style="background-image:url(' . $related_content_thumbnail_array[0] . ')">';

				}

				$related_content_item_content = '<div class="related-content-item-wrap">';
				$related_content_item_content .= '<h2 class="related-content-item-title"><a href="' . $related_content_item_permalink . '">' . $related_content_item_title . '</a></h2>';
				$related_content_item_content .= wpautop( $related_content_item_excerpt );
				$related_content_item_content .= '<p><a href="' . $related_content_item_permalink . '">Read More</a></p>';

				$related_content_item_content = apply_filters( 'filter_anthology_related_content_item_content', $related_content_item_content );
				$related_content_item_content .= '</div>';

				$closing_tag = '';
				if ( has_post_thumbnail($related_content_item_id) ) {
					$closing_tag .= '</div>';

				}

				$closing_tag .= apply_filters( 'filter_anthology_related_content_item_wrap_closing', '</div></article>' );

				$related_content .= $opening_tag . $related_content_item_content . $closing_tag;

			}

			// Finish semantically wrapping related content
			$related_content_closing = apply_filters( 'filter_anthology_related_content_wrap_class', '</div></section>' );

			// Just filter the whole thing if you want
			$related_content = apply_filters( 'filter_anthology_related_content', $related_content_opening . $related_content . $related_content_closing );

			echo $related_content;

		}

	}

}

function anthology_pro_get_related_content() {

	// Filter all the things
	$related_content_type = apply_filters( 'filter_anthology_related_content_type', 'post' );
	$related_content_num = apply_filters( 'filter_anthology_related_content_posts_per_page', -1 );
	$relationship_meta_field = apply_filters( 'filter_anthology_related_content_relationship_meta_field', '' );

	$args = array(
		'posts_per_page' => $related_content_num,
		'post_type'      => $related_content_type
	);

	if ( $relationship_meta_field ) {

		$args['meta_query'] = array(
			array(
				'key' => $relationship_meta_field,
				'value' => get_the_ID(),
				'compare' => '=',
			)
		);

	}

	$related_content = get_posts( $args );

	return $related_content;

}