<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

/**
 * sanitize_string
 * @since 1.0
 */
function sanitize_string(string $input, bool $removeTagsCompletely = false): string
{
    $input = str_replace(PHP_EOL, ' ', $input);
    if (!$removeTagsCompletely) $input = str_replace(['<', '>'], ['&lt;', '&gt;'], $input);
    return filter_var($input, FILTER_SANITIZE_STRING);
}

/**
 * sanitize_text
 * @since 1.0
 */
function sanitize_text(string $input, bool $removeTagsCompletely = false): string
{
    if (!$removeTagsCompletely) $input = str_replace(['<', '>'], ['&lt;', '&gt;'], $input);
    return filter_var($input, FILTER_SANITIZE_STRING);
}

/**
 * sanitize_mail
 * @since 1.0
 */
function sanitize_mail(string $input): string
{
    return filter_var($input, FILTER_SANITIZE_EMAIL);
}

/**
 * is_mail
 * @since 1.0
 */
function is_mail(string $input): bool
{
    return filter_var($input, FILTER_VALIDATE_EMAIL);
}
