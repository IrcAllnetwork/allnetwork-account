<?php
/**
 * AccountModel
 *
 * Proses CRUD untuk aktivitas akun
 * ex: pencarian akun berdasarkan ID maupun Email
 *     penggantian Password dan data profile akun
 *
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
namespace API\Account\Model;

use Propel\Table\Transformatika\AccountQuery;
use Transformatika\Message\Message;
use Transformatika\Message\MessageConstant;
use Transformatika\Utility\Str;
use Zend\Crypt\Password\Bcrypt;

/**
 * AccountModel Class
 *
 * CRUD Proses untuk aktivitas akun
 *
 * @category  Model
 * @package   AccountModel
 * @author    Prastowo aGung Widodo <agung@transformatika.com>
 * @copyright 2016 PT Daya Transformatika
 * @license   Transformatika License
 * @version   GIT: $Id$
 * @link      http://git.transformatika.com/web-platform/core-accounts
 */
class AccountModel
{
    /**
     * Mendapatkan akun detail berdasarkan ID
     * @param  string  $accountId   Akun ID
     * @param  boolean $showBalance Set true jika ingin menampilkan Credit / Debit
     * @return array               Akun Detail
     */
    public function getAccountById($accountId = null, $showBalance = false)
    {
        $msg = new Message();
        if (empty($accountId)) {
            return [
                'error' => 'ERR_EMPTY',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_EMPTY,
                    [
                        'name' => 'Account ID'
                    ]
                ),
                'records' => []
            ];
        }

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

        $accountDetail = [
            'id' => $account->getId(),
            'firstName' => $account->getFirstName(),
            'lastName' => $account->getLastName(),
            'email' => $account->getEmail(),
            'avatar' => $account->getAvatar()
        ];

        if (true === $showBalance) {
            $accountDetail['totalCredit'] = $account->getTotalCredit();
            $accountDetail['totalDebit'] = $account->getTotalDebit();
        }

        return [
            'error' => null,
            'msg' => '',
            'records' => $accountDetail
        ];
    }

    /**
     * Get Account Detail using Email Address
     * @param  string $email Akun Email
     * @return array        Akun Detail
     */
    public function getAccountByEmail($email)
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

        $account = AccountQuery::create()->findOneByEmail($email);
        if (empty($account)) {
            return [
                'error' => 'ERR_ACCOUNT_NOT_FOUND',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_ACCOUNT_NOT_FOUND,
                    [
                        'name' => $email
                    ]
                ),
                'records' => []
            ];
        }

        $accountDetail = [
            'id' => $account->getId(),
            'firstName' => $account->getFirstName(),
            'lastName' => $account->getLastName(),
            'email' => $account->getEmail(),
            'avatar' => $account->getAvatar()
        ];

        return [
            'error' => null,
            'msg' => '',
            'records' => $accountDetail
        ];
    }

    /**
     * Change Password
     * @param  string $accountId Akun ID
     * @param  array  $data      POST Data
     * @return array             Server Response
     */
    public function changePassword($accountId = null, $data = array())
    {
        $msg = new Message();
        if (empty($accountId)) {
            return [
                'error' => 'ERR_EMPTY',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_EMPTY,
                    [
                        'name' => 'Account ID'
                    ]
                ),
                'records' => []
            ];
        }

        $account = AccountQuery::create()->findOneById($accountId);
        if (empty($account)) {
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

        $data['currentPassword'] = !isset($data['currentPassword']) ? null : $data['currentPassword'];
        $data['newPassword'] = !isset($data['newPassword']) ? null : $data['newPassword'];

        if (!$bcrypt->verify($data['currentPassword'], $account->getPassword())) {
            return [
                'error' => 'ERR_PASSWORD',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_PASSWORD
                ),
                'records' => []
            ];
        }

        $account = $account->setPassword($bcrypt->create($data['newPassword']));
        if (!$account->save()) {
            return [
                'error' => 'ERR_DB_SAVE',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_DB_SAVE
                ),
                'records' => []
            ];
        }

        return [
            'error' => null,
            'msg' => $msg->getMessage(
                MessageConstant::ACCOUNT_PASSWORD_CHANGED
            ),
            'records' => [
                'id' => $account->getId(),
                'firstName' => $account->getFirstName(),
                'lastName' => $account->getLastName(),
                'email' => $account->getEmail(),
                'avatar' => $account->getAvatar()
            ]
        ];
    }

    /**
     * Mengganti data profile seperti, FirstName, LastName, datefmt_get_locale
     * @param  string $accountId Akun ID
     * @param  array  $data      Data profile
     * @return array             Status
     */
    public function changeProfile($accountId = null, $data = array())
    {
        if (empty($accountId)) {
            return [
                'error' => 'ERR_EMPTY',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_EMPTY,
                    [
                        'name' => 'Account ID'
                    ]
                ),
                'records' => []
            ];
        }

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

        $defaultData = array(
            'FirstName' => $account->getFirstName(),
            'LastName' => $account->getLastName(),
            'Email' => $account->getEmail()
        );

        $combinedArray = array_combine($defaultData, $data);
        $account = $account->setFirstName($combinedArray['FirstName'])
                           ->setLastName($combinedArray['LastName'])
                           ->setEmail($combinedArray['Email'])
                           ->save();

        if (!$account) {
            return [
                'error' => 'ERR_DB_SAVE',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_DB_SAVE
                ),
                'records' => []
            ];
        }

        return [
            'error' => null,
            'msg' => $msg->getMessage(
                MessageConstant::SUCCESS_DB_SAVE
            ),
            'records' => [
                'id' => $account->getId(),
                'firstName' => $account->getFirstName(),
                'lastName' => $account->getLastName(),
                'email' => $account->getEmail(),
                'avatar' => $account->getAvatar()
            ]
        ];
    }
}
