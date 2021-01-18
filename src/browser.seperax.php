<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

/**
 * detect_browser_version
 * @since 1.0
 */
function detect_browser_version(string $userAgent = ""): string
{
    if (strlen($userAgent) === 0) $userAgent = $_SERVER['HTTP_USER_AGENT'];

    return 'unknown';
}

/**
 * detect_browser_name
 * @since 1.0
 */
function detect_browser_name(string $userAgent = ""): string
{
    if (strlen($userAgent) === 0) $userAgent = $_SERVER['HTTP_USER_AGENT'];

    $browserList = [
        '/Edge/'
    ];

    return 'unknown';
}

/**
 * detect_os
 * @since 1.0
 */
function detect_os(string $userAgent = ""): string
{
    if (strlen($userAgent) === 0) $userAgent = $_SERVER['HTTP_USER_AGENT'];

    return 'unknown';
}

/**
 * detect_bot
 * @since 1.0
 */
function detect_bot(): bool
{
    return (isset($_SERVER["HTTP_USER_AGENT"]) ? preg_match('/(bot|crawl|spider|slurp|facebookexternalhit|grabber)/i', $_SERVER["HTTP_USER_AGENT"]) > 0 : false);
}

function detect_browser_data(string $userAgent = ""): array
{
    if (strlen($userAgent) === 0) $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $userAgent = trim($userAgent);

    $browser = null;
    $version = null;
    $os = null;
    $deviceType = null;

    /**
     * Detect Operating System
     */
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($userAgent))) {
        $deviceType = 'Tablet';
    }
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($userAgent))) {
        $deviceType = 'Smartphone';
    }
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $deviceType = 'Smartphone';
        }
    }
    $mobile_ua = strtolower(substr($userAgent, 0, 4));
    $mobile_agents = array(
        'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
        'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
        'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
        'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
        'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
        'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
        'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
        'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
        'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
    );
    if (in_array($mobile_ua, $mobile_agents)) {
        $deviceType = 'Smartphone';
    }
    if (strpos(strtolower($userAgent), 'opera mini') > 0) {
        $deviceType = 'Smartphone';
        //Check for tablets on opera mini alternative headers
        $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
            $deviceType = 'Tablet';
        }
    }
    if ($deviceType === null) {
        $deviceType = 'Desktop';
    }
    if (preg_match('/(AFTS Build\/)/', $userAgent, $matches)) {
        $deviceType = "TV";
    } else if (preg_match('/(AppleTV\/)/', $userAgent, $matches)) {
        $deviceType = "TV";
    }

    /**
     * Detect browsers
     */
    preg_match_all('/([a-zA-Z]*)(\/)([0-9\.]*)/', $userAgent, $matches);
    $foundBrowsers = [];
    for ($i = 0; $i < count($matches[0]); $i++) {
        $matchBrowser = $matches[1][$i];
        if (strlen($matchBrowser) === 0) $matchBrowser = 'unknown';
        $matchVersion = $matches[3][$i];
        if (strlen($matchVersion) === 0) $matchVersion = '0';
        $matchVersion = explode('.', $matchVersion);
        if ($matchBrowser !== 'Mozilla')
            if ($matchBrowser !== 'AppleWebKit')
                if ($matchBrowser !== 'Version')
                    if ($matchBrowser !== 'Mobile')
                        if ($matchBrowser !== 'Build')
                            $foundBrowsers[$matchBrowser] = implode('.', array_slice($matchVersion, 0, 2));
    }
    foreach ($foundBrowsers as $name => $ver) {
        if ($name === 'Safari' && $browser !== null) continue;
        $browser = $name;
        $version = $ver;
    }

    $browser_replaces = ['/^Edg$/' => 'Edge'];
    foreach ($browser_replaces as $orig => $rep) $browser = preg_replace($orig, $rep, $browser);

    /**
     * Operating System
     */
    $os_array = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile',
        '/cros/i'              =>  'ChromeOS',
        '/appletv/i'              =>  'tvOS',
        '/crkey/i'              =>  'Chromecast'
    );
    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $userAgent))
            $os = $value;

    return [
        'device_type' => ($deviceType === null ? 'unknown' : $deviceType),
        'browser_name' => ($browser === null ? 'unknown' : $browser),
        'browser_version' => ($version === null ? '0' : $version),
        'operating_system' => ($os === null ? 'unknown' : $os),
    ];
}
