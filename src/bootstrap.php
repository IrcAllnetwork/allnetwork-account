<?php
/**
 * Framework Bootstraper
 *
 * Initializing Framework
 *
 * LICENSE: This source file is property of Transformatika Company
 * and may not redistribute to other Application
 * The source is owned by author
 *
 * @category  Framework
 * @package   core-framework
 * @author    Prastowo aGung Widodo <agung@transformatika.com>
 * @copyright 2016 PT Daya Transformatika
 * @license   Transformatika License
 * @version   GIT: $Id$
 * @link      http://git.transformatika.com/web-platform/core-accounts
 */

use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;
use Transformatika\Config\Config;
use Transformatika\MVC\RouteDispatcher;

/**
 * Issue #5 http://git.transformatika.com/web-platform/core-accounts/issues/5
 * Fix cache path not found
 * Define cachePath on Config::init()
 */
Config::init([
    'configExt' => 'yaml',
    'cachePath' => '/storage/cache/'
]);

if (Config::getConfig('env') === 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
} else {
    error_reporting(0);
    ini_set('display_errors', 'Off');
}

$sessionConfig = new StandardConfig();
$sessionConfig->setOptions([
    'remember_me_seconds' => 1800,
    'name'                => 'allnetwork',
]);

$sessionManager = new SessionManager($sessionConfig);
$sessionManager->getValidatorChain()
    ->attach('session.validate', [new HttpUserAgent(), 'isValid']);

/**
 * Issue #1 http://git.transformatika.com/web-platform/core-accounts/issues/1
 * Fix Automatic logout
 * Disable Remote Address Validation
 */
// $sessionManager->getValidatorChain()
//     ->attach('session.validate', [new RemoteAddr(), 'isValid']);

Container::setDefaultManager($sessionManager);

/**
* Initializing Propel ORM
*/
if (Config::getConfig('usePropel') == 'true' || Config::getConfig('usePropel') === true) {
    require_once 'propel.php';
}

$router = new RouteDispatcher();
$router->setMiddleWare('\Transformatika\Session\SessionMiddleware');
$router->dispatch();
