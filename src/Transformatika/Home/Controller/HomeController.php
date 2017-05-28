<?php
namespace Transformatika\Home\Controller;

use Transformatika\MVC\Controller;
use Zend\Session\Container;
use Zend\Diactoros\Response\RedirectResponse;

class HomeController extends Controller
{
    protected $session;

    public function __construct()
    {
        parent::__construct();
        $user = new Container('user');
        if ($user->id) {
            new RedirectResponse(BASE_URL.'my-account');
        }
    }

    public function indexAction()
    {
        return array(
            'template' => 'Home.twig',
            'request' => $this->request,
            'headers' => ['Content-Type' => 'text/html'],
            'title' => 'AllNetwork Accounts'
        );
    }
}
