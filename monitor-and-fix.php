<?php

/**
 * PHP Version 7.1
 * 
 * Checks the problematic URLs and make hotfixes:
 *  - clear cache
 *  - re-index
 *  - rewrite URL redirects
 *  - etc.
 * 
 * Add to crontab to run every single minute.
 * 
 * @author Yaro Glodov <glodov@gmail.com>
 * @author Konstantin Melnikov <cartman.zp@gmail.com>
 * 
 * @todo Yaro, write an article about this.
 */

/**
 * Loads JSON config file.
 * 
 * @param string $file The file path.
 * @return array       The associated array of config key => values.
 */
function loadConfig(string $file) {
    return json_decode(file_get_contents($file), true);
}

/**
 * Fetches the URL and returns the status code.
 * It should fetch only HEAD if possible.
 * 
 * @param string $url The URL to fetch.
 * 
 * @return int        The Response code.
 */
function fetch(string $url) {
    // @todo write the real code
    return 200;
}

/**
 * Logs the url, response code and time of the event into log file or database.
 * 
 * @param string $url  The URL.
 * @param int    $code The response code.
 * 
 * @return bool        TRUE on success, FALSE on failure.
 */
function trace(string $message) {
    // @todo write the real code
    sprint('%20s > %s', $dateTime, $message);
    return false;
}

/**
 * Makes the fixes according to response code of the URL.
 * 
 * @param string $url  The URL.
 * @param int    $code The response code.
 * 
 * @return bool        The result of the fixes.
 */
function fix(string $url, int $code) {
    // @todo write the real code
    return false;
}

/**
 * Sends notification to admin.
 * 
 * @param string $email  The admin's email.
 * @param string $url    The URL.
 * @param int    $code   The response code.
 * @param bool   $result The fix result.
 * 
 * @return bool          The result of notifying admin.
 */
function notify(string $url, int $code, bool $result) {
    // @todo write the real code
    return false;
}

$config = loadConfig(__DIR__ . '/monitor-and-fix.config.json');

foreach ($config['url'] as $url) {
    // monitor
    $code = fetch($url);

    if (200 !== $code) {
        trace(sprintf('%-5s%s', $code, $url));

        // fix
        $fixed = fix($url);

        trace(sprintf('%-5s', $fixed ? 'FIXED' : 'FAIL!'));

        // notify the admin
        $notified = notify($config['email'], $url, $code, $fixed);

        trace(sprint('%-5s', $notified ? 'NOTIFIED' : 'UNSENT!'));
    }
}
