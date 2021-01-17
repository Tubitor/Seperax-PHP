# Shortcodes

## shortcode_handler

Use this function to register a shortcode.

```
/**
 * shortcode_handler
 * @since 1.0
 */
function shortcode_handler(string $shortcode, $callback)
```

## parse_shortcodes

```
/**
 * parse_shortcodes
 * @since 1.0
 */
function parse_shortcodes(string $input): string
```

## Example

Let's say, this is your string with the shortcodes you want to parse:
```
$input = '[headline title="Welcome!" subline="This is awesome!"][spacer]';
```

Now, create the handlers for the shortcodes:
```
// Handler for the shortcode 'headline'
shortcode_handler('headline', function ($args) {
    // The arguments in the shortcode are passed inside the $args array
    return '<h1>' . $args['title'] . '</h1><h2>' . $args['subline'] . '</h2>';
});

// Handler for the shortcode 'spacer'
shortcode_handler('spacer', function ($args) {
    return '<div class="spacer"></div>';
});
```

After you registered all shortcodes you want, parse your input string:
```
$result = parse_shortcodes($input);
```

This is your result:
```
<h1>Welcome!</h1><h2>This is awesome!</h2><div class="spacer"></div>
```