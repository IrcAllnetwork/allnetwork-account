<?php
namespace Transformatika\Auth\Controller;

use Transformatika\MVC\Controller;
use Zend\Session\Container;

class AuthController extends Controller
{
    protected $server;

    protected $user;

    public function __construct()
    {
        parent::__construct();
        $oauth = new \Oauth\Server();
        $this->server = $oauth->server;
        $this->user = new Container('user');
    }
    public function token()
    {
        $this->server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
        exit();
    }

    public function resource()
    {
        if (!$this->server->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
            $this->server->getResponse()->send();
            die;
        }
        return array(
            'error' => null,
            'headers' => array(
                'Content-Type' => 'application/json'
            )
        );
    }

    public function authorize()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();
        if (!$this->server->validateAuthorizeRequest($request, $response)) {
            $response->send();
            die;
        }

        return [
            'title' => 'Authorize Apps',
            'template' => 'authorize.twig',
            'records' => $request->query,
            'hash' =>  (isset($_GET['hash']) ? $_GET['hash'] : ''),
            'refPath' => (isset($_GET['refPath']) ? $_GET['refPath'] : $_SERVER['HTTP_REFERER']),
            'headers' => [
                'Content-Type' => 'text/html'
            ]
        ];
    }

    public function authorizeRequest()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();
        if (!$this->server->validateAuthorizeRequest($request, $response)) {
            $response->send();
            die;
        }

        if (isset($this->request->getParsedBody()['authorize'])) {
            $this->server->handleAuthorizeRequest($request, $response, true, $this->user->id);
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
            //exit("SUCCESS! Authorization Code: $code");
            $ref = $request->query['ref'];
            $hash = $this->request->getParsedBody()['hash'];
            if (!empty($hash)) {
                $ref .= '#/'.$hash;
            }
            $ref .= '?code='.$code;
            return [
                'template' => 'redirect.twig',
                'data' => [
                    'ref' => $ref,
                    'hash' => $hash,
                    'code' => $code
                ],
                'headers' => [
                    'Content-Type' => 'text/html'
                ]
            ];
            // $response->send();
            // exit();
        }
    }
}
