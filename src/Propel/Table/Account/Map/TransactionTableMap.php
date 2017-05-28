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
use Propel\Table\Account\Transaction;
use Propel\Table\Account\TransactionQuery;


/**
 * This class defines the structure of the 't_transaction' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class TransactionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Propel.Table.Account.Map.TransactionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 't_transaction';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Propel\\Table\\Account\\Transaction';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Propel.Table.Account.Transaction';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the transaction_id field
     */
    const COL_TRANSACTION_ID = 't_transaction.transaction_id';

    /**
     * the column name for the transaction_account field
     */
    const COL_TRANSACTION_ACCOUNT = 't_transaction.transaction_account';

    /**
     * the column name for the transaction_time field
     */
    const COL_TRANSACTION_TIME = 't_transaction.transaction_time';

    /**
     * the column name for the transaction_type field
     */
    const COL_TRANSACTION_TYPE = 't_transaction.transaction_type';

    /**
     * the column name for the transaction_totalvalue field
     */
    const COL_TRANSACTION_TOTALVALUE = 't_transaction.transaction_totalvalue';

    /**
     * the column name for the transaction_totalqty field
     */
    const COL_TRANSACTION_TOTALQTY = 't_transaction.transaction_totalqty';

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
        self::TYPE_PHPNAME       => array('Id', 'AccountId', 'Time', 'Type', 'TotalValue', 'TotalQuantity', ),
        self::TYPE_CAMELNAME     => array('id', 'accountId', 'time', 'type', 'totalValue', 'totalQuantity', ),
        self::TYPE_COLNAME       => array(TransactionTableMap::COL_TRANSACTION_ID, TransactionTableMap::COL_TRANSACTION_ACCOUNT, TransactionTableMap::COL_TRANSACTION_TIME, TransactionTableMap::COL_TRANSACTION_TYPE, TransactionTableMap::COL_TRANSACTION_TOTALVALUE, TransactionTableMap::COL_TRANSACTION_TOTALQTY, ),
        self::TYPE_FIELDNAME     => array('transaction_id', 'transaction_account', 'transaction_time', 'transaction_type', 'transaction_totalvalue', 'transaction_totalqty', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AccountId' => 1, 'Time' => 2, 'Type' => 3, 'TotalValue' => 4, 'TotalQuantity' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'accountId' => 1, 'time' => 2, 'type' => 3, 'totalValue' => 4, 'totalQuantity' => 5, ),
        self::TYPE_COLNAME       => array(TransactionTableMap::COL_TRANSACTION_ID => 0, TransactionTableMap::COL_TRANSACTION_ACCOUNT => 1, TransactionTableMap::COL_TRANSACTION_TIME => 2, TransactionTableMap::COL_TRANSACTION_TYPE => 3, TransactionTableMap::COL_TRANSACTION_TOTALVALUE => 4, TransactionTableMap::COL_TRANSACTION_TOTALQTY => 5, ),
        self::TYPE_FIELDNAME     => array('transaction_id' => 0, 'transaction_account' => 1, 'transaction_time' => 2, 'transaction_type' => 3, 'transaction_totalvalue' => 4, 'transaction_totalqty' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('t_transaction');
        $this->setPhpName('Transaction');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Propel\\Table\\Account\\Transaction');
        $this->setPackage('Propel.Table.Account');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('transaction_id', 'Id', 'CHAR', true, 32, null);
        $this->addForeignKey('transaction_account', 'AccountId', 'CHAR', 't_account', 'account_id', true, 32, null);
        $this->addColumn('transaction_time', 'Time', 'TIMESTAMP', false, null, null);
        $this->addColumn('transaction_type', 'Type', 'VARCHAR', false, 12, 'debit');
        $this->addColumn('transaction_totalvalue', 'TotalValue', 'INTEGER', false, null, 0);
        $this->addColumn('transaction_totalqty', 'TotalQuantity', 'INTEGER', false, null, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Account', '\\Propel\\Table\\Account\\Account', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':transaction_account',
    1 => ':account_id',
  ),
), null, null, null, false);
        $this->addRelation('Credit', '\\Propel\\Table\\Account\\Credit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':credit_transaction',
    1 => ':transaction_id',
  ),
), null, null, 'Credits', false);
        $this->addRelation('Debit', '\\Propel\\Table\\Account\\Debit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':debit_transaction',
    1 => ':transaction_id',
  ),
), null, null, 'Debits', false);
        $this->addRelation('TransactionDetail', '\\Propel\\Table\\Account\\TransactionDetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':transactiondetail_transaction',
    1 => ':transaction_id',
  ),
), 'CASCADE', null, 'TransactionDetails', false);
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
            'behavior_total_value' => array('name' => 'transaction_totalvalue', 'expression' => 'SUM(transactiondetail_value)', 'condition' => '', 'foreign_table' => 't_transactiondetail', 'foreign_schema' => '', ),
            'behavior_total_qty' => array('name' => 'transaction_totalqty', 'expression' => 'SUM(transactiondetail_qty)', 'condition' => '', 'foreign_table' => 't_transactiondetail', 'foreign_schema' => '', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to t_transaction     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        TransactionDetailTableMap::clearInstancePool();
    }

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
        return $withPrefix ? TransactionTableMap::CLASS_DEFAULT : TransactionTableMap::OM_CLASS;
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
     * @return array           (Transaction object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = TransactionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TransactionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TransactionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TransactionTableMap::OM_CLASS;
            /** @var Transaction $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TransactionTableMap::addInstanceToPool($obj, $key);
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
            $key = TransactionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TransactionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Transaction $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TransactionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TransactionTableMap::COL_TRANSACTION_ID);
            $criteria->addSelectColumn(TransactionTableMap::COL_TRANSACTION_ACCOUNT);
            $criteria->addSelectColumn(TransactionTableMap::COL_TRANSACTION_TIME);
            $criteria->addSelectColumn(TransactionTableMap::COL_TRANSACTION_TYPE);
            $criteria->addSelectColumn(TransactionTableMap::COL_TRANSACTION_TOTALVALUE);
            $criteria->addSelectColumn(TransactionTableMap::COL_TRANSACTION_TOTALQTY);
        } else {
            $criteria->addSelectColumn($alias . '.transaction_id');
            $criteria->addSelectColumn($alias . '.transaction_account');
            $criteria->addSelectColumn($alias . '.transaction_time');
            $criteria->addSelectColumn($alias . '.transaction_type');
            $criteria->addSelectColumn($alias . '.transaction_totalvalue');
            $criteria->addSelectColumn($alias . '.transaction_totalqty');
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
        return Propel::getServiceContainer()->getDatabaseMap(TransactionTableMap::DATABASE_NAME)->getTable(TransactionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(TransactionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(TransactionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new TransactionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Transaction or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Transaction object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Propel\Table\Account\Transaction) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TransactionTableMap::DATABASE_NAME);
            $criteria->add(TransactionTableMap::COL_TRANSACTION_ID, (array) $values, Criteria::IN);
        }

        $query = TransactionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TransactionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TransactionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the t_transaction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return TransactionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Transaction or Criteria object.
     *
     * @param mixed               $criteria Criteria or Transaction object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Transaction object
        }


        // Set the correct dbName
        $query = TransactionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // TransactionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
TransactionTableMap::buildTableMap();
