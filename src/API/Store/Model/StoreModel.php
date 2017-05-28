<?php
namespace API\Store\Model;

use Propel\Table\Transformatika\ProductQuery;
use Propel\Runtime\Map\TableMap;

class StoreModel
{
    protected $limit = 15;

    public function getList($page = 1, $filter = array(), $order = array())
    {
        $product = ProductQuery::create();
        $product = $product->filterByStatus('y');
        if (isset($filter['name'])) {
            $product = $product->filterByName($filter['name']);
        }
        if (isset($order['price'])) {
            $product = $product->orderByPrice($order['price']);
        }

        $records = $product->paginate($page, $this->limit);
        $res = array();
        if (!empty($records)) {
            $res = [];
            foreach ($records as $k => $v) {
                $account = $v->getAccount();
                $res[$k] = [
                    'id' => $v->getId(),
                    'name' => $v->getName(),
                    'description' => $v->getDescription(),
                    'price' => $v->getPrice(),
                    'discount' => $v->getDiscount(),
                    'status' => $v->getStatus(),
                    'repository' => $v->getRepository(),
                    'totalReview' => $v->getTotalReview(),
                    'rating' => $v->getRating(),
                    'type' => $v->getType(),
                    'images' => $v->getProductImages()->toArray(null, false, TableMap::TYPE_CAMELNAME),
                    'owner' => [
                        'id' => $account->getId(),
                        'userName' => $account->getUserName(),
                        'firstName' => $account->getFirstName(),
                        'lastName' => $account->getLastName(),
                        'email' => $account->getEmail()
                    ]
                ];
            }
            return [
                'totalPages' => $records->getLastPage(),
                'page' => $records->getPage(),
                'totalData' => $records->getNbResults(),
                'limit' => $records->getMaxPerPage(),
                'records' => $res
            ];
        }

        return [
            'totalPages' => 1,
            'page' => 1,
            'totalData' => 0,
            'limit' => $this->limit,
            'records' => $res
        ];
    }
}
