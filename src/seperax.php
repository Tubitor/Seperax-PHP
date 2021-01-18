<?php

/**
 * Copyright 2021 Tubitor Developers (tubitor.com)
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *      http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * @version 1.2
 * @author Tubitor Developers
 * @link https://seperax.com/
 */

/**
 * Seperax Helpers
 * @since 1.0
 */
if (file_exists(__DIR__ . '/helpers.seperax.php'))
    require_once __DIR__ . '/helpers.seperax.php';

/**
 * Input Addon
 * @since 1.0
 */
if (file_exists(__DIR__ . '/input.seperax.php'))
    require_once __DIR__ . '/input.seperax.php';

/**
 * MySQL Addon
 * @since 1.0
 */
if (file_exists(__DIR__ . '/mysql.seperax.php'))
    if (class_exists('PDO'))
        require_once __DIR__ . '/mysql.seperax.php';

/**
 * Seperax Actions
 * @since 1.1
 */
if (file_exists(__DIR__ . '/actions.seperax.php'))
    require_once __DIR__ . '/actions.seperax.php';

/**
 * Fetch
 * @since 1.1
 */
if (file_exists(__DIR__ . '/fetch.seperax.php'))
    if (function_exists('curl_init'))
        require_once __DIR__ . '/fetch.seperax.php';

/**
 * Shortcodes
 * @since 1.1
 */
if (file_exists(__DIR__ . '/shortcodes.seperax.php'))
    require_once __DIR__ . '/shortcodes.seperax.php';

/**
 * Browser Detection
 * @since 1.2
 */
if (file_exists(__DIR__ . '/browser.seperax.php'))
    require_once __DIR__ . '/browser.seperax.php';

/**
 * Nonce Security
 * @since 1.2
 */
if (file_exists(__DIR__ . '/nonces.seperax.php'))
    require_once __DIR__ . '/nonces.seperax.php';

/**
 * Router
 * @since 1.2
 */
if (file_exists(__DIR__ . '/router.seperax.php'))
    require_once __DIR__ . '/router.seperax.php';
