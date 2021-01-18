<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

$_sx_shortcodes_storage = [];

/**
 * shortcode_handler
 * @since 1.0
 */
function shortcode_handler(string $shortcode, $callback)
{
    global $_sx_shortcodes_storage;
    $_sx_shortcodes_storage[$shortcode] = $callback;
}

/**
 * parse_shortcodes
 * @since 1.0
 */
function parse_shortcodes(string $input): string
{
    global $_sx_shortcodes_storage;
    $input = str_replace(PHP_EOL, "", $input);
    $result = "";
    preg_match_all('/(\[)([a-zA-Z0-9_]+)(.*?)(\])/', $input, $tags);
    if (count($tags) > 2) {
        $originals = $tags[0];
        $tagNames = $tags[2];
        $tagOptions = $tags[3];
        for ($i = 0; $i < count($tagNames); $i++) {
            $tagName = $tagNames[$i];
            $tagOption = trim($tagOptions[$i]);
            $original = $originals[$i];
            if (isset($_sx_shortcodes_storage[$tagName])) {
                $optionArray = [];
                preg_match_all('/(([a-zA-Z0-9_]*?)(=")(.*?)("))/', $tagOption, $options);
                if (count($options) > 4) {
                    $optionNames = $options[2];
                    $optionValues = $options[4];
                    for ($i2 = 0; $i2 < count($optionNames); $i2++) {
                        $optionArray[$optionNames[$i2]] = $optionValues[$i2];
                    }
                }
                try {
                    $result .= $_sx_shortcodes_storage[$tagName]($optionArray);
                } catch (ArgumentCountError $error) {
                    //
                }
            } else {
                $result .= $original;
            }
        }
    }
    return $result;
}
