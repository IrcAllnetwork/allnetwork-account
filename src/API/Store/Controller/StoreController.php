<?php
namespace API\Store\Controller;

use Transformatika\MVC\Controller;
use API\Store\Model\StoreModel;

class StoreController extends Controller
{
    protected $accountId;

    protected $oauthServer;

    public function __construct()
    {
        parent::__construct();
        // $oauth = new \Oauth\Server();
        // $this->oauthServer = $oauth->server;
        // if (!$this->oauthServer->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
        //     $this->oauthServer->getResponse()->send();
        //     die;
        // }
        // $token = $this->oauthServer->getAccessTokenData(\OAuth2\Request::createFromGlobals());
        // $this->accountId = $token['user_id'];
    }

    public function indexAction()
    {
        $store = new StoreModel;
        $params = $this->request->getQueryParams();
        return $store->getList($params);
    }
}
