<?php
namespace Transformatika\Account\Controller;

use Transformatika\MVC\Controller;
use Transformatika\Account\Model\AccountReaderModel;
use Transformatika\Utility\Str;

class MyAccountController extends Controller
{
    public function indexAction()
    {
        $account = new AccountReaderModel();
        $accountDetail = $account->getDetail();
        $accountDetail['headers'] = [
            'Content-Type' => 'text/html'
        ];
        $accountDetail['template'] = 'MyAccount.twig';
        $accountDetail['title'] = 'My Account';

        return $accountDetail;
    }

    public function signoutAction()
    {
        session_destroy();
        return [
            'redirect' => true,
            'headers' => [
                'location' => BASE_URL
            ]
        ];
    }

    public function settingsPageAction()
    {
        $account = new AccountReaderModel();
        $accountDetail = $account->getDetail();
        $accountDetail['headers'] = [
            'Content-Type' => 'text/html'
        ];
        $accountDetail['template'] = 'Settings.twig';
        $accountDetail['title'] = 'Settings';
        return $accountDetail;
    }
}
