# Script Loader Tags

Async and defer attribute helper tags for enqueueing scripts in WordPress themes.

WordPress doesn’t provide a default way to enqueue scripts with [`async` and `defer` attributes](https://bitsofco.de/async-vs-defer/). This package adds a [`script_loader_tag`](https://developer.wordpress.org/reference/hooks/script_loader_tag/) filter to make it possible for you to set async and defer attributes through the name of the script that should be enqueued.

## Installation

You can install the package via Composer:

```bash
composer require mindkomm/theme-lib-script-loader-tags
```

## Usage

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

## Support

This is a library that we use at MIND to develop WordPress themes. You’re free to use it, but currently, we don’t provide any support. 
