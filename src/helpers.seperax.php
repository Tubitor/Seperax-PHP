<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

/**
 * Time helper variables
 * @since 1.2
 */
define('MINUTE_IN_SECONDS', 60);
define('HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS);
define('DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS);
define('WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS);
define('MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS);
define('YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS);

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
