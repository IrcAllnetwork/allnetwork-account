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
use Propel\Table\Account\Debit;
use Propel\Table\Account\DebitQuery;


/**
 * This class defines the structure of the 't_debit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DebitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Propel.Table.Account.Map.DebitTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 't_debit';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Propel\\Table\\Account\\Debit';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Propel.Table.Account.Debit';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the debit_id field
     */
    const COL_DEBIT_ID = 't_debit.debit_id';

    /**
     * the column name for the debit_account field
     */
    const COL_DEBIT_ACCOUNT = 't_debit.debit_account';

    /**
     * the column name for the debit_value field
     */
    const COL_DEBIT_VALUE = 't_debit.debit_value';

    /**
     * the column name for the debit_time field
     */
    const COL_DEBIT_TIME = 't_debit.debit_time';

    /**
     * the column name for the debit_transaction field
     */
    const COL_DEBIT_TRANSACTION = 't_debit.debit_transaction';

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
        self::TYPE_PHPNAME       => array('Id', 'AccountId', 'Value', 'Time', 'TransactionId', ),
        self::TYPE_CAMELNAME     => array('id', 'accountId', 'value', 'time', 'transactionId', ),
        self::TYPE_COLNAME       => array(DebitTableMap::COL_DEBIT_ID, DebitTableMap::COL_DEBIT_ACCOUNT, DebitTableMap::COL_DEBIT_VALUE, DebitTableMap::COL_DEBIT_TIME, DebitTableMap::COL_DEBIT_TRANSACTION, ),
        self::TYPE_FIELDNAME     => array('debit_id', 'debit_account', 'debit_value', 'debit_time', 'debit_transaction', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AccountId' => 1, 'Value' => 2, 'Time' => 3, 'TransactionId' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'accountId' => 1, 'value' => 2, 'time' => 3, 'transactionId' => 4, ),
        self::TYPE_COLNAME       => array(DebitTableMap::COL_DEBIT_ID => 0, DebitTableMap::COL_DEBIT_ACCOUNT => 1, DebitTableMap::COL_DEBIT_VALUE => 2, DebitTableMap::COL_DEBIT_TIME => 3, DebitTableMap::COL_DEBIT_TRANSACTION => 4, ),
        self::TYPE_FIELDNAME     => array('debit_id' => 0, 'debit_account' => 1, 'debit_value' => 2, 'debit_time' => 3, 'debit_transaction' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('t_debit');
        $this->setPhpName('Debit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Propel\\Table\\Account\\Debit');
        $this->setPackage('Propel.Table.Account');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('debit_id', 'Id', 'CHAR', true, 32, null);
        $this->addForeignKey('debit_account', 'AccountId', 'CHAR', 't_account', 'account_id', true, 32, null);
        $this->addColumn('debit_value', 'Value', 'DECIMAL', true, null, 0);
        $this->addColumn('debit_time', 'Time', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('debit_transaction', 'TransactionId', 'CHAR', 't_transaction', 'transaction_id', true, 32, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Account', '\\Propel\\Table\\Account\\Account', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':debit_account',
    1 => ':account_id',
  ),
), null, null, null, false);
        $this->addRelation('Transaction', '\\Propel\\Table\\Account\\Transaction', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':debit_transaction',
    1 => ':transaction_id',
  ),
), null, null, null, false);
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
            'aggregate_column_relation_behavior_account_debit' => array('foreign_table' => 't_account', 'update_method' => 'updateTotalDebit', 'aggregate_name' => 'TotalDebit', ),
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
        return $withPrefix ? DebitTableMap::CLASS_DEFAULT : DebitTableMap::OM_CLASS;
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
     * @return array           (Debit object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DebitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DebitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DebitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DebitTableMap::OM_CLASS;
            /** @var Debit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DebitTableMap::addInstanceToPool($obj, $key);
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
            $key = DebitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DebitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Debit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DebitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DebitTableMap::COL_DEBIT_ID);
            $criteria->addSelectColumn(DebitTableMap::COL_DEBIT_ACCOUNT);
            $criteria->addSelectColumn(DebitTableMap::COL_DEBIT_VALUE);
            $criteria->addSelectColumn(DebitTableMap::COL_DEBIT_TIME);
            $criteria->addSelectColumn(DebitTableMap::COL_DEBIT_TRANSACTION);
        } else {
            $criteria->addSelectColumn($alias . '.debit_id');
            $criteria->addSelectColumn($alias . '.debit_account');
            $criteria->addSelectColumn($alias . '.debit_value');
            $criteria->addSelectColumn($alias . '.debit_time');
            $criteria->addSelectColumn($alias . '.debit_transaction');
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
        return Propel::getServiceContainer()->getDatabaseMap(DebitTableMap::DATABASE_NAME)->getTable(DebitTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DebitTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DebitTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DebitTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Debit or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Debit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DebitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Propel\Table\Account\Debit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DebitTableMap::DATABASE_NAME);
            $criteria->add(DebitTableMap::COL_DEBIT_ID, (array) $values, Criteria::IN);
        }

        $query = DebitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DebitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DebitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the t_debit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DebitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Debit or Criteria object.
     *
     * @param mixed               $criteria Criteria or Debit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DebitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Debit object
        }


        // Set the correct dbName
        $query = DebitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DebitTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DebitTableMap::buildTableMap();
