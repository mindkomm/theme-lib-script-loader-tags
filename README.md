# Script Loader Tags

Helper functionality for enqueueing scripts in WordPress themes with the following `<script>` tag attributes, because WordPress doesn’t support that for `wp_register_script()` or `wp_enqueue_script()`:

- `async`
- `defer`
- `nomodule`
- `type="module"`

WordPress doesn’t provide a default way to enqueue scripts with the above attributes. This package

- Adds a [`script_loader_tag`](https://developer.wordpress.org/reference/hooks/script_loader_tag/) filter to make it possible for you to set async and defer attributes through the name of the script that should be enqueued.
- Adds a `update_script_tag()` function so you can control how scripts are loaded, when you don’t have control over the name of the handle the script is using.

## Installation

You can install the package with Composer:

```bash
composer require mindkomm/theme-lib-script-loader-tags
```

## Usage

### Use name suffixes

Append any of the following suffixes to the name of your script to automatically set the attribute:

- `|async` for an `async` attribute
- `|defer` for a `defer` attribute
- `|nomodule` for a `nomodule` attribute
- `|module` for `type="module"` attribute

```php
add_action( 'wp_enqueue_scripts', function() {
    // Load Picturefill asynchronously.
    wp_enqueue_script(
        'js-picturefill|async',
        get_theme_file_uri( 'build/js/picturefill.js' )
    );
} );
```

This will produce the following output:

```html
<script type="text/javascript" async src="build/js/picturefill.js"></script>
```

It’s also possible to chain more than one suffix.

```php
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_script(
        'js-app|module|async',
        get_theme_file_uri( 'build/js/app.js' )
    );
} );
```

### Use a function

You can use the `update_script_tag()` function to set a filter that adds the attributes.

```php
add_action( 'wp_enqueue_scripts', function() {
    // Load Picturefill asynchronously.
    wp_enqueue_script(
        'js-picturefill',
        get_theme_file_uri( 'build/js/picturefill.js' )
    );

    update_script_tag( 'js-picturefill', 'async' );
} );
```

It‘s also possible to add more than one handle and/or attribute if you pass an array:

```php
// Multiple attributes.
update_script_tag( 'js-app', [ 'async', 'module' ] );

// Multiple handles.
update_script_tag( [ 'js-frontpage', 'js-app' ], 'async' );
```

This function is useful

- if you want to change the method of an existing script that you didn’t enqueue yourself.
- if you use `wp_register_script()`, where you shouldn’t add suffixes to the script handle.



## Support

This is a library that we use at MIND to develop WordPress themes. You’re free to use it, but currently, we don’t provide any support. 
