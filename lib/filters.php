<?php

/**
 * Filter script tags for async or defer attributes.
 *
 * Append '--async' or/and '--defer' to your script handle to add the appropriate tags to the script tag.
 * This is inspired by: https://matthewhorne.me/defer-async-wordpress-scripts/.
 *
 * @since 1.0.0
 */
add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
	// Look for '--async'
	if ( strpos( $handle, '--async' ) > -1 ) {
		$tag = str_replace( ' src', ' async src', $tag );
	}

	// Look for '--defer'
	if ( strpos( $handle, '--defer' ) > -1 ) {
		$tag = str_replace( ' src', ' defer src', $tag );
	}

	return $tag;
}, 10, 3 );
