<?php
/**
 * uSpace Accounts
 *
 * Main index file
 *
 * LICENSE: This source file is property of Transformatika Company
 * and may not redistribute to other Application
 * The source is owned by author
 *
 * @category  General
 * @package   core-accounts
 * @author    Prastowo aGung Widodo <agung@transformatika.com>
 * @copyright 2016 PT Daya Transformatika
 * @license   Transformatika License
 * @version   GIT: $Id$
 * @link      http://git.transformatika.com/web-platform/core-accounts
 */

date_default_timezone_set('Asia/Jakarta');

/**
 *  Issue #2 http://git.transformatika.com/web-platform/core-accounts/issues/2
 *  Fix HTTPS Header tidak valid
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
    $protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'].'://';
    /**
     * Issue #4 http://git.transformatika.com/web-platform/core-accounts/issues/4
     * Fix CORS Headers
     */
    if ( $parts = parse_url($_SERVER['HTTP_REFERER']) ) {
        header("Access-Control-Allow-Origin: ".$parts["scheme"]."://".$parts["host"]);
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 1");
        header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
    }
} else {
    $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
}
$serverName = $_SERVER['SERVER_NAME'];
$path = '';

if (@$_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

define('BASE_URL', $protocol.$serverName.$path.'/');
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', realpath(dirname(__FILE__).DS.'..'));

require_once '../vendor/autoload.php';
require_once '../src/bootstrap.php';
