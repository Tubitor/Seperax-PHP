<?php

function sanitize_string(string $input, bool $removeTagsCompletely = false): string
{
    $input = str_replace(PHP_EOL, ' ', $input);
    if (!$removeTagsCompletely) $input = str_replace(['<', '>'], ['&lt;', '&gt;'], $input);
    return filter_var($input, FILTER_SANITIZE_STRING);
}

function sanitize_text(string $input, bool $removeTagsCompletely = false): string
{
    if (!$removeTagsCompletely) $input = str_replace(['<', '>'], ['&lt;', '&gt;'], $input);
    return filter_var($input, FILTER_SANITIZE_STRING);
}

function sanitize_mail(string $input): string
{
    return filter_var($input, FILTER_SANITIZE_EMAIL);
}
