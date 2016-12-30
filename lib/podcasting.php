<?php

// oEmbed URLs
add_action( 'genesis_entry_content', 'anthology_pro_embed_custom_media', 11 );
function anthology_pro_embed_custom_media() {

	if ( is_singular() ) {

		// Set the related content parent
		$custom_media_field = apply_filters( 'filter_anthology_pro_embed_custom_media_field', 'podcast_url' );

		$custom_media_url = get_post_meta( get_the_ID(), $custom_media_field, true );

		// Filterable empty array for customization
		$custom_media_args = apply_filters( 'filter_anthology_pro_embed_custom_media_args', array() );

		if ( $custom_media_url ) {

			echo wp_oembed_get( $custom_media_url, $custom_media_args );

		}

	}

}