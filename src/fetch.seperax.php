<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

/**
 * fetch
 * @since 1.0
 */
function fetch(string $url, array $options = [], bool $statuscode = false)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    if (isset($options['method']) && $options['method'] == 'POST') {
        curl_setopt($curl, CURLOPT_POST, 1);
        if (isset($options['body']) && gettype($options['body']) === 'array') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $options);
        }
    } else {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    if (isset($options['bearer'])) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $options['bearer']));
    }
    $result = curl_exec($curl);
    if (curl_errno($curl)) {
        return [
            'error' => curl_error($curl)
        ];
    }
    $statuscode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($statuscode) {
        return [
            'http_code' => $statuscode,
            'body' => $result
        ];
    } else {
        return $result;
    }
}
