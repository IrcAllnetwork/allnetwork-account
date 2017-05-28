<?php
namespace API\Transaction\Model;

use Propel\Table\Transformatika\Transaction;
use Propel\Table\Transformatika\TransactionDetail;
use Propel\Table\Transformatika\ProductQuery;
use Zend\Diactoros\ServerRequest;
use Transformatika\Message\Message;
use Transforamtika\Message\MessageConstant;
use Transformatika\Utility\Str;
use Propel\Runtime\Propel;

class TransactionModel
{
    protected $accountId;

    protected $data;

    public function __construct(ServerRequest $request)
    {
        $this->accountId = $request->getAttribute('accountId');
        $str = new Str();
        $this->data = [
            'Id' => $str->generateId(),
            'AccountId' => $this->accountId,
            'TransactionDetail' => []
        ];
    }

    public function addItem($productId, $qty = 1, $discount = 0)
    {
        $product = ProductQuery::create()->findOneById($productId);
        $str = new Str();
        $item = [
            'Id' => $str->generateId(),
            'TransactionId' => $this->data['Id'],
            'Type' => 'purchase',
            'Description' => $product->getDescription(),
            'Qty' => $qty,
            'Price' => $product->getPrice(),
            'Value' => ($product->getPrice() * $qty),
            'ProductId' => $product->getId(),
            'Discount' => $product->getDiscount()
        ];
        array_push($this->data['TransactionDetail'], $item);
        return $this;
    }

    public function save()
    {
        $transaction = new Transaction();
        $transaction->setId($this->transaction['Id']);
        $transaction->setAccountId($this->transaction['AccountId']);
        $transaction->setType('debit');
        $transaction->setTime(date('Y-m-d H:i:s'));
        if ($transaction->save()) {
            foreach ($this->data['TransactionDetail'] as $k => $item) {
                $transactionDetail = new TransactionDetail();
                $transactionDetail->setId($item['Id']);
                $transactionDetail->setTransactionId($item['TransactionId']);
                $transactionDetail->setType($item['Type']);
                $transactionDetail->setDescription($item['Description']);
                $transactionDetail->setQty($item['Qty']);
                $transactionDetail->setPrice($item['Price']);
                $transactionDetail->setValue($item['Value']);
                $transactionDetail->setProductId($item['ProductId']);
                $transactionDetail->setDiscount($item['Discount']);
                $transactionDetail->save();
            }
        }
    }
}
