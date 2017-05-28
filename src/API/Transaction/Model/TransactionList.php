<?php
namespace API\Transaction\Model;

use Propel\Table\Transformatika\Transaction;
use Propel\Table\Transformatika\TransactionQuery;
use Transformatika\Message\Message;
use Transforamtika\Message\MessageConstant;

class TransactionList
{
    public function getTransactionList($accountId = null)
    {
        $msg = new Message();
        if (!empty($accountId)) {
            $transaction = TransactionQuery::create()->filterByAccountId($accountId)
                                                     ->find();
            $transactionList = $transaction->toArray();
            foreach ($transaction as $k => $v) {
                $transactionList[$k]['Detail'] = $v->getTransactionDetails()->toArray();
            }

            return [
                'error' => null,
                'msg' => '',
                'records' => $transactionList
            ];
        }

        return [
            'error' => 'ERR_ACCOUNT_NOT_FOUND',
            'msg' => $msg->getMessage(
                MessageConstant::ERR_ACCOUNT_NOT_FOUND,
                [
                    'name' => ''
                ]
            )
        ];
    }
}
