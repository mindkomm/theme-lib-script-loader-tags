<?php

/**
 * Updates a script tag.
 *
 * @since 1.2.0
 *
 * @param array|string $handle
 * @param array|string $add What to add. Can be a single string or an array of strings. Possible
 *                          values: 'async', 'defer', 'module', 'nomodule'.
 */
function update_script_tag( $handle = [], $add = [] ) {
	// Make sure we have arrays.
	$handle = (array) $handle;
	$add    = (array) $add;

	$additions = '';

	foreach ( $add as $type ) {
		switch ( $type ) {
			case 'async':
				$additions .= ' async';
				break;
			case 'defer':
				$additions .= ' defer';
				break;
			case 'module':
				$additions .= ' type="module"';
				break;
			case 'nomodule':
				$additions .= ' nomodule';
				break;
		}
	}

	if ( empty( $additions ) ) {
		return;
	}

	$filter = function( $tag, $current_handle ) use ( $handle, $additions ) {
		// Bailout if the handle does not apply.
		if ( ! in_array( $current_handle, $handle, true ) ) {
			return $tag;
		}

		return str_replace( ' src', sprintf( ' %s src', trim( $additions ) ), $tag );
	};

	add_filter( 'script_loader_tag', $filter, 10, 2 );
}

/**
 * Loads a script tag with the defer or async attribute.
 *
 * You don’t have to use this if your script is added in the footer.
 *
 * @param string|array $handle The handle or array of handles to apply the changes for.
 * @param string       $method The method to use. Should be `defer` or `async`. Default `defer`.
 */
function script_loader_tag_method( $handle = [], $method = 'defer' ) {
	update_script_tag( $handle, $method );
}
