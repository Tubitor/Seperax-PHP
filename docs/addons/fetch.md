# Fetch

To make simple HTTP Requests with curl, we created the `fetch` function.

## fetch

```
/**
 * fetch
 * @since 1.0
 */
function fetch(string $url, array $options = [], bool $statuscode = false)
```

### Return

```
$result = fetch('your_url_here', ['optional_options' => 'here']);
// -> The result is simply the result as string

$result = fetch('your_url_here', ['optional_options' => 'here'], true);
/*
[
    'http_code' => 200, // Statuscode
    'body'      => 'result_as_string' // result
]
*/
```

### POST

To create a Post-request, add a few options:
```
fetch('your_url_here', [
    'method' => 'POST',
    'body' => [
        'your' => 'post data',
        'goes' => 'here'
    ]
]);
```

### Bearer-Token authentication

```
fetch('your_url_here', [
    'bearer' => 'your_token'
]);
```