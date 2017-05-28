<?php
namespace Transformatika\Account\Model;

use Propel\Table\Transformatika\Account;
use Propel\Table\Transformatika\AccountQuery;
use Transformatika\Message\Message;
use Transformatika\Message\MessageConstant;
use Transformatika\Utility\Str;
use Transformatika\Mailer\SMTP;

class RegisterModel
{
    public function process($email, $request)
    {
        $msg = new Message();
        $str = new Str();
        if (!$str->validateEmail($email)) {
            return [
                'error' => 'ERR_INVALID_EMAIL',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_INVALID_EMAIL
                ),
                'records' => []
            ];
        }
        $cek = AccountQuery::create()->findOneByEmail($email);
        if ($cek === null) {
            $account = new Account();
            $save = $account->setId($str->generateId())
                            ->setEmail($email)
                            ->setKey($str->generateRandomString(64, false))
                            ->setExpired(date('Y-m-d', strtotime('+1 year')))
                            ->setRegisterDate(date('Y-m-d H:i:s'))
                            ->setIPAddress($request->getServerParams()['REMOTE_ADDR'])
                            ->save();

            if ($save) {
                $mailer = new SMTP();
                $mailer->setRecipient($email);
                $mailer->setSubject('Please Activate Your Transformatika Account');
                $mailer->setBody("Please follow this link to activate your account:\n
                ".BASE_URL."activate/".$account->getKey());
                $mailer->send();
                return [
                    'error' => null,
                    'msg' => 'Welcome to Transformatika Web Platform. Please check your email to complete registration',
                    'records' => $account->toArray()
                ];
            }

            return [
                'error' => 'ERR_DB_SAVE',
                'msg' => $msg->getMessage(MessageConstant::ERR_DB_SAVE),
                'records' => []
            ];
        }

        return [
            'error' => 'ERR_EXISTS',
            'msg' => $msg->getMessage(MessageConstant::ERR_EXISTS, ['name' => $email]),
            'records' => []
        ];
    }
}
