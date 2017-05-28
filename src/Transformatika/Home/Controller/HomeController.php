<?php
namespace Transformatika\Home\Controller;

use Transformatika\MVC\Controller;
use Zend\Session\Container;

class HomeController extends Controller
{
    protected $session;

    public function __construct()
    {
        parent::__construct();
        $user = new Container('user');
        if ($user->id) {
            header('location:'.BASE_URL.'my-account');
            exit();
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
