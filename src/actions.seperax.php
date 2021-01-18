<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

$_sx_action_storage = [];

/**
 * trigger_action
 * @since 1.0
 */
function trigger_action(string $action, ...$arguments): void
{
    global $_sx_action_storage;
    if (isset($_sx_action_storage[$action])) {
        foreach ($_sx_action_storage[$action] as $callback) {
            try {
                $callback(...$arguments);
            } catch (ArgumentCountError $error) {
                // 
            }
        }
    }
}

/**
 * add_action
 * @since 1.0
 */
function add_action(string $action, $callback): void
{
    global $_sx_action_storage;
    if (!isset($_sx_action_storage[$action])) $_sx_action_storage[$action] = [];
    $_sx_action_storage[$action][] = $callback;
}
