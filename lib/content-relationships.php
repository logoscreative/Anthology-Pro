<?php

// Bring in related content
add_action( 'genesis_after_entry', 'anthology_pro_show_related_content' );
function anthology_pro_show_related_content() {

	// Set the related content parent
	$related_content_parent = apply_filters( 'filter_anthology_related_content_parent', 'collection' );

	if ( is_singular( $related_content_parent ) ) {

		// Semantically wrap related content
		$related_content_opening = apply_filters( 'filter_anthology_related_content_wrap_class', '<section>' );

		// Get related content
		$related_content_items = anthology_pro_get_related_content();

		foreach ( $related_content_items as $related_content_item ) {

			// Apply filterable wrapper
			$opening_tag = apply_filters( 'filter_anthology_related_content_item_wrap_opening', '<article><div class="related-content-item">' );

			$related_content_item_content = '<h2><a href="' . $related_content_item->guid . '">' . $related_content_item->post_title . '</a></h2>';
			$related_content_item_content .= wpautop( $related_content_item->post_excerpt );
			$related_content_item_content .= '<p><a href="' . $related_content_item->guid . '">Read More</a></p>';

			$related_content_item_content = apply_filters( 'filter_anthology_related_content_item_content', $related_content_item_content );

			$closing_tag = apply_filters( 'filter_anthology_related_content_item_wrap_closing', '</div></article>' );

			$related_content = $opening_tag . $related_content_item_content . $closing_tag;

		}

		// Finish semantically wrapping related content
		$related_content_closing = apply_filters( 'filter_anthology_related_content_wrap_class', '</section>' );

		// Just filter the whole thing if you want
		$related_content = apply_filters( 'filter_anthology_related_content', $related_content_opening . $related_content . $related_content_closing );

		echo $related_content;

	}

}

function anthology_pro_get_related_content() {

	// Filter all the things
	$related_content_type = apply_filters( 'filter_anthology_related_content_type', 'element' );
	$related_content_num = apply_filters( 'filter_anthology_related_content_posts_per_page', -1 );
	$relationship_meta_field = apply_filters( 'filter_anthology_related_content_relationship_meta_field', 'collection_relationship' );

	$args = array(
		'posts_per_page' => $related_content_num,
		'post_type'      => $related_content_type,
		'meta_query' => array(
			array(
				'key' => $relationship_meta_field,
				'value' => get_the_ID(),
				'compare' => '=',
			)
		)
	);

	$related_content = get_posts( $args );

	return $related_content;

}