<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

function create_nonce(string $identifier, string $action): string
{
    $nonce_tick = ceil(time() / (DAY_IN_SECONDS / 2));
    $nonce_hash = substr(
        custom_hash($identifier . '-' . $action . '-' . $nonce_tick, 'nonce', $action),
        -12,
        10
    );
    return $nonce_hash;
}

function verify_nonce(string $nonce, string $identifier, string $action): bool
{
    $expected_nonce = create_nonce($identifier, $action);
    return $expected_nonce === $nonce;
}

function custom_hash($data, $scheme, $salt): string
{
    $key = md5($scheme . '-' . $salt);
    return hash_hmac('md5', $data, $key);
}
