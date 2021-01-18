# Browser Detection

## detect_bot

```
/**
 * detect_bot
 * @since 1.0
 */
function detect_bot(string $userAgent = ""): bool
```

## detect_browser_data

```
/**
 * detect_browser_data
 * @since 1.0
 */
function detect_browser_data(string $userAgent = ""): array
```

Result:

```
[
    'device_type' => '(Desktop|Smartphone|Tablet|TV)',
    'browser_name' => '',
    'browser_version' => '',
    'operating_system' => ''
]
```