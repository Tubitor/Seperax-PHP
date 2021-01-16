<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

/**
 * starts_with
 * @since 1.0
 */
function starts_with(string $input, string $needed): bool
{
    return (substr($input, 0, strlen($needed)));
}

/**
 * ends_with
 * @since 1.0
 */
function ends_with(string $input, string $needed): bool
{
    return (substr($input, -strlen($needed)));
}

/**
 * contains
 * @since 1.0
 */
function contains($input, $needed): bool
{
    if (gettype($input) === 'string') {
        return str_contains($input, $needed);
    } else if (gettype($input) === 'array') {
        return in_array($needed, $input);
    }
    return false;
}
