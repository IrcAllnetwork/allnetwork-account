<?php
namespace Transformatika\Account\Model;

use Propel\Table\Account\AccountQuery;
use Transformatika\Message\Message;
use Transformatika\Message\MessageConstant;
use Zend\Session\Container;

class AccountReaderModel
{
    protected $user;

    public function __construct()
    {
        $this->user = new Container('user');
    }

    public function getDetail($accountId = null)
    {
        $accountId = empty($accountId) ? $this->user->id : $accountId;
        $account = AccountQuery::create()->findOneById($accountId);
        if (empty($account)) {
            $msg = new Message();
            return [
                'error' => 'ERR_ACCOUNT_NOT_FOUND',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_ACCOUNT_NOT_FOUND,
                    [
                        'name' => $accountId
                    ]
                ),
                'records' => []
            ];
        }

        return [
            'error' => null,
            'msg' => '',
            'records' => [
                'id' => $account->getId(),
                'userName' => $account->getUserName(),
                'firstName' => $account->getFirstName(),
                'lastName' => $account->getLastName(),
                'avatar' => $account->getAvatar(),
                'email' => $account->getEmail(),
                'type' => $account->getType(),
                'registerDate' => $account->getRegisterDate()->format('Y-m-d H:i:s'),
                //'expired' => $account->getExpired()->format('Y-m-d'),
                'totalCredit' => $account->getTotalCredit()
            ]
        ];
    }
}
