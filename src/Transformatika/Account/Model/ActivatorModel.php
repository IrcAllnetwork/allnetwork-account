<?php
namespace Transformatika\Account\Model;

use Propel\Table\Transformatika\AccountQuery;
use Zend\Crypt\Password\Bcrypt;
use Transformatika\Message\Message;
use Transformatika\Message\MessageConstant;
use Transformatika\Utility\File;
use Zend\Session\Container;

class ActivatorModel
{
    protected $user;

    protected $bannedUserName = array(
        'admin',
        'administrator',
        'root',
        'tuhan',
        'rosul',
        'nabi',
        'fuck',
        'bangsat',
        'bajingan',
        'asu',
        'kontol',
        'brengsek',
        'yesus',
        'jesus',
        'allah',
        'account',
        'apps',
        'billing',
        'store',
        'market',
        'accounts',
        'setting',
        'settings',
        'mail'
    );

    public function __construct()
    {
        $this->user = new Container('user');
    }

    public function userNameExists($username)
    {
        $username = strtolower($username);

        if (preg_match('/[^a-z_0-9]/i', $username)) {
            return true;
        }
        if (in_array($username, $this->bannedUserName)) {
            return true;
        }

        $account = AccountQuery::create()->findOneByUserName($username);
        return ($account === null) ? false : true;
    }

    public function activate($formData)
    {
        $msg = new Message();
        $account = AccountQuery::create()->filterByKey($formData['code'])
                                         ->findOne();

        if ($account !== null) {
            if ($this->userNameExists($formData['userName'])) {
                return [
                    'error' => 'ERR_EXISTS',
                    'msg' => $msg->getMessage(
                        MessageConstant::ERR_EXISTS,
                        ['name' => 'username '.$formData['userName']]
                    ),
                    'records' => []
                ];
            }

            $bcrypt = new Bcrypt;
            $account = $account->setFirstName($formData['firstName']);
            $account = $account->setLastName($formData['lastName']);
            $account = $account->setPassword($bcrypt->create($formData['password']));
            $account = $account->setUserName(strtolower($formData['userName']));
            $account = $account->setStatus('y');
            $account = $account->setKey(null);
            if ($account->save()) {
                $userData = $account->toArray();
                $this->user->id = $userData['Id'];
                $this->user->email = $userData['Email'];
                $this->user->type = $userData['Type'];
                $this->user->firstName = $userData['FirstName'];
                $this->user->lastName = $userData['LastName'];
                $file = new File(BASE_PATH.DS.'storage'.DS.'users');
                $file->createDirectory('/'.$userData['UserName']);
                $file->createDirectory('/'.$userData['UserName'].'/www');
                $file->createDirectory('/'.$userData['UserName'].'/.config');
                $file->createDirectory('/'.$userData['UserName'].'/.cache');
                $file->createDirectory('/'.$userData['UserName'].'/files');
                $file->createDirectory('/'.$userData['UserName'].'/trustedApps');
                $file->createDirectory('/'.$userData['UserName'].'/.local/share/applications');

                return [
                    'error' => null,
                    'msg' => $msg->getMessage(
                        MessageConstant::ACCOUNT_ACTIVATED,
                        ['name' => $userData['Email']]
                    ),
                    'records' => [
                        'id' => $userData['Id'],
                        'email' => $userData['Email'],
                        'firstName' => $userData['FirstName'],
                        'lastName' => $userData['LastName'],
                        'type' => $userData['Type'],
                        'avatar' => $userData['Avatar']
                    ]
                ];
            }

            return [
                'error' => 'ERR_DB_SAVE',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_DB_SAVE,
                    ['name' => 'Code']
                ),
                'records' => []
            ];
        }

        return [
            'error' => 'ERR_VALIDATE_CODE',
            'msg' => $msg->getMessage(
                MessageConstant::ERR_VALIDATE_COMMON,
                ['name' => 'Code']
            ),
            'records' => []
        ];
    }

    public function checkCode($code)
    {
        $account = AccountQuery::create()->filterByKey($code)
                                         ->findOne();
        return ($account === null) ? false : true;
    }
}
