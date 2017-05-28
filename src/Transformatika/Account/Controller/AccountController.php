<?php

/**
 * AccountController
 *
 * Handle proses registrasi, aktivasi akun,
 * serta autentikasi akun
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
namespace Transformatika\Account\Controller;

use Transformatika\MVC\Controller;
use Transformatika\Utility\Str;
use Transformatika\Account\Model\RegisterModel;
use Transformatika\Account\Model\ActivatorModel;
use Transformatika\Account\Model\AuthenticationModel;
use Zend\Session\Container;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * AccountController Class
 *
 * Class untuk memproses registrasi dan aktivasi akun
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
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new Container('user');
        if ($this->user->id) {
            new RedirectResponse(BASE_URL.'my-account');
        }
    }
    /**
     * Handle Register proccess
     * Proses registrasi hanya membutuhkan VALID EMAIL
     * Selanjutnya pengguna akan diberikan link SET PASSWORD via email
     * Proses ini untuk memastikan kalau email yang diinputkan adalah email
     * yang valid dan masih digunakan
     * @return json containts error message
     */
    public function signupAction()
    {
        $formData = $this->request->getParsedBody();
        $signup = new RegisterModel();
        return $signup->process($formData['email'], $this->request);
    }

    /**
     * Activation Page
     * Halaman aktivasi account
     * Jika kode tivak valid maka akan ditampilkan halaman error kode
     * @return [type] [description]
     */
    public function activateAction()
    {
        $activator = new ActivatorModel();
        $code = $this->request->getAttribute('code');
        $template = ($activator->checkCode($code)) ? 'Activation.php' : 'ActivationFailed.php';
        return [
            'template' => $template,
            'headers' => ['Content-Type' => 'text/html'],
            'code' => $this->request->getAttribute('code')
        ];
    }

    /**
    * Activation process
    * Proses aktivasi
    * Proses ini akan mengaktifkan akun, membuat akun direktori/folder
    * menghapus key agar tidak bisa dilakukan aktifasi lagi
    * @TODO menginstall default apps (apps-store, apps-dashboard, apps-login, dll)
    */
    public function doActivateAction()
    {
        $activator = new ActivatorModel();
        return $activator->activate($this->request->getParsedBody());
    }

    /**
     * Proses signin / autentikasi
     * @return [type] [description]
     */
    public function signinAction()
    {
        $auth = new AuthenticationModel();
        return $auth->signIn($this->request);
    }
}
