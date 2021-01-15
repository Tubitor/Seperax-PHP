<?php

/**
 * Test space
 */
require_once './seperax.php';

echo implode(PHP_EOL, [
    sanitize_string('<hi>H>' . PHP_EOL . 'Next line'),
    sanitize_mail('H&%&/§(sdiu8/@tubitor&%".com')
]);
