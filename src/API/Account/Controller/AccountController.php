<?php
/**
 * AccountController
 *
 * REST API untuk akun
 *
 * LICENSE: This source file is property of Transformatika Company
 * and may not redistribute to other Application
 * The source is owned by author
 *
 * @category  Controller
 * @package   AccountController
 * @author    Prastowo aGung Widodo <agung@transformatika.com>
 * @copyright 2016 PT Daya Transformatika
 * @license   Transformatika License
 * @version   GIT: $Id$
 * @link      http://git.transformatika.com/web-platform/core-accounts
 */
namespace API\Account\Controller;

use Transformatika\MVC\Controller;
use API\Account\Model\AccountModel;

/**
 * AccountController Class
 *
 * Class untuk memproses REST API akun
 *
 * @category  Controller
 * @package   AccountController
 * @author    Prastowo aGung Widodo <agung@transformatika.com>
 * @copyright 2016 PT Daya Transformatika
 * @license   Transformatika License
 * @version   GIT: $Id$
 * @link      http://git.transformatika.com/web-platform/core-accounts
 */
class AccountController extends Controller
{
    protected $accountId;

    protected $oauthServer;

    public function __construct()
    {
        parent::__construct();
        $oauth = new \Oauth\Server();
        $this->oauthServer = $oauth->server;
        if (!$this->oauthServer->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
            $this->oauthServer->getResponse()->send();
            die;
        }
        $token = $this->oauthServer->getAccessTokenData(\OAuth2\Request::createFromGlobals());
        $this->accountId = $token['user_id'];
    }

    /**
     * GET Current account Detail
     * @return [type] [description]
     */
    public function indexAction()
    {
        $account = new AccountModel();
        return $account->getAccountById($this->accountId, true);
    }

    /**
     * Mendapatkan user account berdasarkan Id
     * @return [type] [description]
     */
    public function getDetailByIdAction()
    {
        $account = new AccountModel();
        return $account->getAccountById($this->request->getAttribute('id'));
    }

    public function getDetailByEmailAction()
    {
        $account = new AccountModel();
        return $account->getAccountByEmail($this->request->getAttribute('email'));
    }

    public function changePasswordAction()
    {
        $account = new AccountModel();
        $postData = $this->request->getParsedBody();
        return $account->changePassword($this->accountId, $postData);
    }

    public function changeProfileAction()
    {
        $account = new AccountModel();
        $postData = $this->request->getParsedBody();
        return $account->changeProfile($this->accountId, $postData);
    }
}
