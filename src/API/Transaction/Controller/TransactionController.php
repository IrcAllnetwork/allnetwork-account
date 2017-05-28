<?php
namespace API\Transaction\Controller;

use Transformatika\MVC\Controller;
use API\Transaction\Model\TransactionList;

class TransactionController extends Controller
{
    protected $accountId;

    protected $oauthServer;

    /**
     * Oauth2 Authentication
     */
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
     * Mengambil list transactions
     * @return [type] [description]
     */
    public function listAction()
    {
        $transactionModel = new TransactionList();
        return $transactionModel->getTransactionList($this->accountId);
    }

    public function addAction()
    {
        $formData = $this->request->getParsedBody();

    }
}
