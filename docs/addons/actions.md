# Actions

The actions-addon adds action to your PHP Project.  
You can add callback-functions for specific actions and trigger them later in your code.

## add_action

```
/**
 * add_action
 * @since 1.0
 */
function add_action(string $action, $callback): void
```

## trigger_action

```
/**
 * trigger_action
 * @since 1.0
 */
function trigger_action(string $action, ...$arguments): void
```