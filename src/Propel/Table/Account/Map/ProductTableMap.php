<?php

namespace Propel\Table\Account\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Propel\Table\Account\Product;
use Propel\Table\Account\ProductQuery;


/**
 * This class defines the structure of the 't_product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Propel.Table.Account.Map.ProductTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 't_product';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Propel\\Table\\Account\\Product';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Propel.Table.Account.Product';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the product_id field
     */
    const COL_PRODUCT_ID = 't_product.product_id';

    /**
     * the column name for the product_name field
     */
    const COL_PRODUCT_NAME = 't_product.product_name';

    /**
     * the column name for the product_owner field
     */
    const COL_PRODUCT_OWNER = 't_product.product_owner';

    /**
     * the column name for the product_price field
     */
    const COL_PRODUCT_PRICE = 't_product.product_price';

    /**
     * the column name for the product_discount field
     */
    const COL_PRODUCT_DISCOUNT = 't_product.product_discount';

    /**
     * the column name for the product_status field
     */
    const COL_PRODUCT_STATUS = 't_product.product_status';

    /**
     * the column name for the product_repository field
     */
    const COL_PRODUCT_REPOSITORY = 't_product.product_repository';

    /**
     * the column name for the product_license field
     */
    const COL_PRODUCT_LICENSE = 't_product.product_license';

    /**
     * the column name for the product_description field
     */
    const COL_PRODUCT_DESCRIPTION = 't_product.product_description';

    /**
     * the column name for the product_totalreview field
     */
    const COL_PRODUCT_TOTALREVIEW = 't_product.product_totalreview';

    /**
     * the column name for the product_rating field
     */
    const COL_PRODUCT_RATING = 't_product.product_rating';

    /**
     * the column name for the product_type field
     */
    const COL_PRODUCT_TYPE = 't_product.product_type';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Owner', 'Price', 'Discount', 'Status', 'Repository', 'License', 'Description', 'TotalReview', 'Rating', 'Type', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'owner', 'price', 'discount', 'status', 'repository', 'license', 'description', 'totalReview', 'rating', 'type', ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_PRODUCT_ID, ProductTableMap::COL_PRODUCT_NAME, ProductTableMap::COL_PRODUCT_OWNER, ProductTableMap::COL_PRODUCT_PRICE, ProductTableMap::COL_PRODUCT_DISCOUNT, ProductTableMap::COL_PRODUCT_STATUS, ProductTableMap::COL_PRODUCT_REPOSITORY, ProductTableMap::COL_PRODUCT_LICENSE, ProductTableMap::COL_PRODUCT_DESCRIPTION, ProductTableMap::COL_PRODUCT_TOTALREVIEW, ProductTableMap::COL_PRODUCT_RATING, ProductTableMap::COL_PRODUCT_TYPE, ),
        self::TYPE_FIELDNAME     => array('product_id', 'product_name', 'product_owner', 'product_price', 'product_discount', 'product_status', 'product_repository', 'product_license', 'product_description', 'product_totalreview', 'product_rating', 'product_type', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Owner' => 2, 'Price' => 3, 'Discount' => 4, 'Status' => 5, 'Repository' => 6, 'License' => 7, 'Description' => 8, 'TotalReview' => 9, 'Rating' => 10, 'Type' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'owner' => 2, 'price' => 3, 'discount' => 4, 'status' => 5, 'repository' => 6, 'license' => 7, 'description' => 8, 'totalReview' => 9, 'rating' => 10, 'type' => 11, ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_PRODUCT_ID => 0, ProductTableMap::COL_PRODUCT_NAME => 1, ProductTableMap::COL_PRODUCT_OWNER => 2, ProductTableMap::COL_PRODUCT_PRICE => 3, ProductTableMap::COL_PRODUCT_DISCOUNT => 4, ProductTableMap::COL_PRODUCT_STATUS => 5, ProductTableMap::COL_PRODUCT_REPOSITORY => 6, ProductTableMap::COL_PRODUCT_LICENSE => 7, ProductTableMap::COL_PRODUCT_DESCRIPTION => 8, ProductTableMap::COL_PRODUCT_TOTALREVIEW => 9, ProductTableMap::COL_PRODUCT_RATING => 10, ProductTableMap::COL_PRODUCT_TYPE => 11, ),
        self::TYPE_FIELDNAME     => array('product_id' => 0, 'product_name' => 1, 'product_owner' => 2, 'product_price' => 3, 'product_discount' => 4, 'product_status' => 5, 'product_repository' => 6, 'product_license' => 7, 'product_description' => 8, 'product_totalreview' => 9, 'product_rating' => 10, 'product_type' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('t_product');
        $this->setPhpName('Product');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Propel\\Table\\Account\\Product');
        $this->setPackage('Propel.Table.Account');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('product_id', 'Id', 'CHAR', true, 32, null);
        $this->addColumn('product_name', 'Name', 'VARCHAR', true, 128, null);
        $this->addForeignKey('product_owner', 'Owner', 'CHAR', 't_account', 'account_id', true, 32, null);
        $this->addColumn('product_price', 'Price', 'DECIMAL', false, null, 0);
        $this->addColumn('product_discount', 'Discount', 'DECIMAL', false, null, 0);
        $this->addColumn('product_status', 'Status', 'VARCHAR', false, 1, 'p');
        $this->addColumn('product_repository', 'Repository', 'CLOB', false, null, null);
        $this->addColumn('product_license', 'License', 'VARCHAR', false, 128, 'GPLv3');
        $this->addColumn('product_description', 'Description', 'CLOB', false, null, null);
        $this->addColumn('product_totalreview', 'TotalReview', 'INTEGER', false, null, 0);
        $this->addColumn('product_rating', 'Rating', 'INTEGER', false, null, 0);
        $this->addColumn('product_type', 'Type', 'VARCHAR', false, 24, 'app');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Account', '\\Propel\\Table\\Account\\Account', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_owner',
    1 => ':account_id',
  ),
), null, null, null, false);
        $this->addRelation('TransactionDetail', '\\Propel\\Table\\Account\\TransactionDetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':transactiondetail_product',
    1 => ':product_id',
  ),
), null, null, 'TransactionDetails', false);
        $this->addRelation('ProductReview', '\\Propel\\Table\\Account\\ProductReview', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':productreview_product',
    1 => ':product_id',
  ),
), null, null, 'ProductReviews', false);
        $this->addRelation('ProductImage', '\\Propel\\Table\\Account\\ProductImage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':productimage_product',
    1 => ':product_id',
  ),
), null, null, 'ProductImages', false);
        $this->addRelation('ProductTag', '\\Propel\\Table\\Account\\ProductTag', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':producttag_product',
    1 => ':product_id',
  ),
), null, null, 'ProductTags', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'query_cache' => array('backend' => 'apc', 'lifetime' => '3600', ),
            'behavior_product_totalreview' => array('name' => 'product_totalreview', 'expression' => 'COUNT(productreview_id)', 'condition' => '', 'foreign_table' => 't_productreview', 'foreign_schema' => '', ),
            'behavior_product_rating' => array('name' => 'product_rating', 'expression' => 'AVG(productreview_rate)', 'condition' => '', 'foreign_table' => 't_productreview', 'foreign_schema' => '', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ProductTableMap::CLASS_DEFAULT : ProductTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Product object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductTableMap::OM_CLASS;
            /** @var Product $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Product $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_NAME);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_OWNER);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_PRICE);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_DISCOUNT);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_STATUS);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_REPOSITORY);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_LICENSE);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_DESCRIPTION);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_TOTALREVIEW);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_RATING);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_TYPE);
        } else {
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.product_name');
            $criteria->addSelectColumn($alias . '.product_owner');
            $criteria->addSelectColumn($alias . '.product_price');
            $criteria->addSelectColumn($alias . '.product_discount');
            $criteria->addSelectColumn($alias . '.product_status');
            $criteria->addSelectColumn($alias . '.product_repository');
            $criteria->addSelectColumn($alias . '.product_license');
            $criteria->addSelectColumn($alias . '.product_description');
            $criteria->addSelectColumn($alias . '.product_totalreview');
            $criteria->addSelectColumn($alias . '.product_rating');
            $criteria->addSelectColumn($alias . '.product_type');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME)->getTable(ProductTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProductTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProductTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Product or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Product object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Propel\Table\Account\Product) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductTableMap::DATABASE_NAME);
            $criteria->add(ProductTableMap::COL_PRODUCT_ID, (array) $values, Criteria::IN);
        }

        $query = ProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the t_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Product or Criteria object.
     *
     * @param mixed               $criteria Criteria or Product object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Product object
        }


        // Set the correct dbName
        $query = ProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProductTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProductTableMap::buildTableMap();
