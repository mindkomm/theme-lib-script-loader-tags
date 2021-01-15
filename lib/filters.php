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
	$pipes = [
		'|async'    => 'async',
		'|defer'    => 'defer',
		'|module'   => 'type="module"',
		'|nomodule' => 'nomodule',
		// Deprecated.
		'--async'    => 'async',
		'--defer'    => 'async',
	];

	foreach ( $pipes as $pipe => $value ) {
		if ( strpos( $handle, $pipe ) > -1 ) {
			$tag = str_replace( $pipe, '', $tag );
			$tag = str_replace( ' src', " {$value} src", $tag );
		}
	}

	return $tag;
}, 10, 3 );
