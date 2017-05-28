<?php
namespace Transformatika\Account\Test;

use PHPUnit\Framework\TestCase;
use Transformatika\Account\Controller\AccountController;

class AccountControllerTest extends TestCase
{
    public function testActivateAction()
    {
        $request = (new \Zend\Diactoros\ServerRequest())
                    ->withUri(new \Zend\Diactoros\Uri('http://localhost'))
                    ->withMethod('GET')
                    ->withAttribute('code', uniqid());

        $account = new AccountController();
        $account->setServerRequest($request);
        $accountReturn = $account->activateAction();

        $viewPath = $account->view->getViewPath();

        // Return must have key "template"
        $this->assertArrayHasKey('template', $accountReturn);
        // Check if template file is exists
        $this->assertFileExists($viewPath . DIRECTORY_SEPARATOR . $accountReturn['template']);
    }
}
