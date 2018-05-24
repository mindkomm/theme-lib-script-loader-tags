# Script Loader Tags

Helper functionality for enqueueing scripts in WordPress themes with the `async` or `defer` attributes.

WordPress doesn’t provide a default way to enqueue scripts with [`async` and `defer` attributes](https://bitsofco.de/async-vs-defer/). This package

- Adds a [`script_loader_tag`](https://developer.wordpress.org/reference/hooks/script_loader_tag/) filter to make it possible for you to set async and defer attributes through the name of the script that should be enqueued.
- Adds a `script_loader_tag_method()` function so you can control how scripts are loaded, when you don’t have control over the name of the handle the script is using.

## Installation

You can install the package via Composer:

```bash
composer require mindkomm/theme-lib-script-loader-tags
```

## Usage

### Use name suffixes

Append `--async` and/or `--defer` to the name of your script to automatically set the attribute.

```php
add_action( 'wp_enqueue_scripts', function() {
    // Load Picturefill asynchronously
    wp_enqueue_script(
        'js-picturefill--async',
        get_theme_file_uri( 'build/js/picturefill.js' )
    );
} );
```

This will produce the following output:

```html
<script type="text/javascript" async src="build/js/picturefill.js"></script>
```

### Use a function

You can use the `script_loader_tag_method()` function to set a filter that adds the attribute.

```php
add_action( 'wp_enqueue_scripts', function() {
    // Load Picturefill asynchronously
    wp_enqueue_script(
        'js-picturefill',
        get_theme_file_uri( 'build/js/picturefill.js' )
    );

    script_loader_tag_method( 'js-picturefill', 'async' );
} );
```

This function is also useful if you want to change the method of an existing script that you didn’t enqueue yourself.

## Support

This is a library that we use at MIND to develop WordPress themes. You’re free to use it, but currently, we don’t provide any support. 
