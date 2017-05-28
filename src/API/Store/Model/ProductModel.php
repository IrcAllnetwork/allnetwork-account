<?php

/**
 * Product Model
 *
 * Manage User Product
 * API untuk menambahkan, merubah, atau menghapus product dari user
 * User harus mengaktifkan developer options terlebih dahulu agar
 * dapat mengunggah produk nya ke Store
 *
 *
 * LICENSE: This source file is property of Transformatika Company
 * and may not redistribute to other Application
 * The source is owned by author
 *
 * @category  Model
 * @package   ProductModel
 * @author    Prastowo aGung Widodo <agung@transformatika.com>
 * @copyright 2016 PT Daya Transformatika
 * @license   Transformatika License
 * @version   GIT: $Id$
 * @link      http://git.transformatika.com/web-platform/core-accounts
 */

namespace API\Store\Model;

use Propel\Table\Transformatika\Product;
use Propel\Table\Transformatika\ProductQuery;
use Propel\Table\Transformatika\AccountQuery;
use Propel\Table\Transformatika\ProductImage;
use Zend\Diactoros\ServerRequest;
use Transformatika\Message\Message;
use Transformatika\Message\MessageConstant;
use Transformatika\Utility\Str;
use Transformatika\Utility\File;
use Transformatika\Config\Config;

/**
 * Product Model Class
 *
 * Class untuk management product dari Transformatika Web Platform
 *
 * @category  Model
 * @package   ProductModel
 * @author    Prastowo aGung Widodo <agung@transformatika.com>
 * @copyright 2016 PT Daya Transformatika
 * @license   Transformatika License
 * @version   GIT: $Id$
 * @link      http://git.transformatika.com/web-platform/core-accounts
 */
class ProductModel
{
    protected $defaultData = array(
        'Id' => null,
        'Owner' => null,
        'Discount' => 0,
        'Price' => 0,
        'Repository' => null,
        'Name' => null,
        'License' => 'GPLv3'
    );

    /**
     * addProduct method
     * System harus memastikan bahwa account sudah mengaktifkan developer
     * Options pada profilnya
     * @param array $data [Data yang diperlukan untuk produk]
     */
    public function addProduct($data = array())
    {
        $msg = new Message();
        $combinedData = array_merge($this->defaultData, $data);
        if (empty($data['Owner'])) {
            return [
                'error' => 'ERR_VALIDATE_COMMON',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_VALIDATE_COMMON,
                    [
                        'name' => 'Data'
                    ]
                ),
                'records' => []
            ];
        }

        $account = AccountQuery::create()->findOneById($data['Owner']);
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

        /**
         * Pastikan developer options sudah diaktifkan
         */
        if ($account->getDeveloper() === 'n') {
            return [
                'error' => 'ERR_ACCOUNT_DEV',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_ACCOUNT_DEV
                ),
                'records' => []
            ];
        }

        $product = new Product();
        $product = $product->setId(Str::generateId())
                           ->setOwner($data['Owner'])
                           ->setLicense($data['License'])
                           ->setRepository($data['Repository'])
                           ->setName($data['Name'])
                           ->setDescription($data['Description'])
                           ->setPrice($data['Price'])
                           ->setDiscount($data['Discount'])
                           ->setType($data['Type'])
                           ->setStatus('p');

        if (!$product->save()) {
            if (isset($data['productImage']) && count($data['productImage']) > 0) {
                $imgFolder = Config::getRootDir().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'img';
                $file = File::init($imgFolder);
                $folder = 'apps/'.$product->getId();
                if ($file->createDirectory($folder)) {
                    foreach ($data['productImage'] as $k => $v) {
                        $imgId = Str::generateId();
                        $pathToUpload = str_replace('/', DIRECTORY_SEPARATOR, $folder);
                        if (move_uploaded_file($v['tmp_name'], $imgFolder.DIRECTORY_SEPARATOR.$pathToUpload)) {
                            $productImage = new ProductImage();
                            $productImage->setId($imgId)
                                         ->setTitle($v['name'])
                                         ->setImage('img/'.$folder.'/'.$imgId.'.png')
                                         ->setProductId($product->getId())
                                         ->save();
                        }
                    }
                }
            }
            return [
                'error' => 'ERR_DB_SAVE',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_DB_SAVE
                ),
                'records' => []
            ];
        }


    }

    public function addApp()
    {

    }
}
