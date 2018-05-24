<?php

/**
 * Loads a script tag with the defer or async attribute.
 *
 * You don’t have to use this if your script is added in the footer.
 *
 * @param string|array $handle The handle or array of handles to apply the changes for.
 * @param string       $method The method to use. Should be `defer` or `async`. Default `defer`.
 */
function script_loader_tag_method( $handle = [], $method = 'defer' ) {
	add_filter( 'script_loader_tag',
		function( $tag, $current_handle ) use ( $handle, $method ) {
			// Bailout if the handle does not apply
			if ( ( ! is_array( $handle ) && $handle !== $current_handle )
				|| ( is_array( $handle ) && ! in_array( $current_handle, $handle, true ) )
			) {
				return $tag;
			}

			return str_replace( ' src', " {$method} src", $tag );
		},
		10, 2
	);
}
