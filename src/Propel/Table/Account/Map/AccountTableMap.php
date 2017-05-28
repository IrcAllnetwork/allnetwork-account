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
use Propel\Table\Account\Account;
use Propel\Table\Account\AccountQuery;


/**
 * This class defines the structure of the 't_account' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AccountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Propel.Table.Account.Map.AccountTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 't_account';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Propel\\Table\\Account\\Account';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Propel.Table.Account.Account';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the account_id field
     */
    const COL_ACCOUNT_ID = 't_account.account_id';

    /**
     * the column name for the account_username field
     */
    const COL_ACCOUNT_USERNAME = 't_account.account_username';

    /**
     * the column name for the account_firstname field
     */
    const COL_ACCOUNT_FIRSTNAME = 't_account.account_firstname';

    /**
     * the column name for the account_lastname field
     */
    const COL_ACCOUNT_LASTNAME = 't_account.account_lastname';

    /**
     * the column name for the account_password field
     */
    const COL_ACCOUNT_PASSWORD = 't_account.account_password';

    /**
     * the column name for the account_status field
     */
    const COL_ACCOUNT_STATUS = 't_account.account_status';

    /**
     * the column name for the account_email field
     */
    const COL_ACCOUNT_EMAIL = 't_account.account_email';

    /**
     * the column name for the account_registerdate field
     */
    const COL_ACCOUNT_REGISTERDATE = 't_account.account_registerdate';

    /**
     * the column name for the account_expired field
     */
    const COL_ACCOUNT_EXPIRED = 't_account.account_expired';

    /**
     * the column name for the account_avatar field
     */
    const COL_ACCOUNT_AVATAR = 't_account.account_avatar';

    /**
     * the column name for the account_token field
     */
    const COL_ACCOUNT_TOKEN = 't_account.account_token';

    /**
     * the column name for the account_ipaddress field
     */
    const COL_ACCOUNT_IPADDRESS = 't_account.account_ipaddress';

    /**
     * the column name for the account_type field
     */
    const COL_ACCOUNT_TYPE = 't_account.account_type';

    /**
     * the column name for the account_credit field
     */
    const COL_ACCOUNT_CREDIT = 't_account.account_credit';

    /**
     * the column name for the account_debit field
     */
    const COL_ACCOUNT_DEBIT = 't_account.account_debit';

    /**
     * the column name for the account_key field
     */
    const COL_ACCOUNT_KEY = 't_account.account_key';

    /**
     * the column name for the account_dev field
     */
    const COL_ACCOUNT_DEV = 't_account.account_dev';

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
        self::TYPE_PHPNAME       => array('Id', 'UserName', 'FirstName', 'LastName', 'Password', 'Status', 'Email', 'RegisterDate', 'Expired', 'Avatar', 'Token', 'IPAddress', 'Type', 'TotalCredit', 'TotalDebit', 'Key', 'Developer', ),
        self::TYPE_CAMELNAME     => array('id', 'userName', 'firstName', 'lastName', 'password', 'status', 'email', 'registerDate', 'expired', 'avatar', 'token', 'iPAddress', 'type', 'totalCredit', 'totalDebit', 'key', 'developer', ),
        self::TYPE_COLNAME       => array(AccountTableMap::COL_ACCOUNT_ID, AccountTableMap::COL_ACCOUNT_USERNAME, AccountTableMap::COL_ACCOUNT_FIRSTNAME, AccountTableMap::COL_ACCOUNT_LASTNAME, AccountTableMap::COL_ACCOUNT_PASSWORD, AccountTableMap::COL_ACCOUNT_STATUS, AccountTableMap::COL_ACCOUNT_EMAIL, AccountTableMap::COL_ACCOUNT_REGISTERDATE, AccountTableMap::COL_ACCOUNT_EXPIRED, AccountTableMap::COL_ACCOUNT_AVATAR, AccountTableMap::COL_ACCOUNT_TOKEN, AccountTableMap::COL_ACCOUNT_IPADDRESS, AccountTableMap::COL_ACCOUNT_TYPE, AccountTableMap::COL_ACCOUNT_CREDIT, AccountTableMap::COL_ACCOUNT_DEBIT, AccountTableMap::COL_ACCOUNT_KEY, AccountTableMap::COL_ACCOUNT_DEV, ),
        self::TYPE_FIELDNAME     => array('account_id', 'account_username', 'account_firstname', 'account_lastname', 'account_password', 'account_status', 'account_email', 'account_registerdate', 'account_expired', 'account_avatar', 'account_token', 'account_ipaddress', 'account_type', 'account_credit', 'account_debit', 'account_key', 'account_dev', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserName' => 1, 'FirstName' => 2, 'LastName' => 3, 'Password' => 4, 'Status' => 5, 'Email' => 6, 'RegisterDate' => 7, 'Expired' => 8, 'Avatar' => 9, 'Token' => 10, 'IPAddress' => 11, 'Type' => 12, 'TotalCredit' => 13, 'TotalDebit' => 14, 'Key' => 15, 'Developer' => 16, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userName' => 1, 'firstName' => 2, 'lastName' => 3, 'password' => 4, 'status' => 5, 'email' => 6, 'registerDate' => 7, 'expired' => 8, 'avatar' => 9, 'token' => 10, 'iPAddress' => 11, 'type' => 12, 'totalCredit' => 13, 'totalDebit' => 14, 'key' => 15, 'developer' => 16, ),
        self::TYPE_COLNAME       => array(AccountTableMap::COL_ACCOUNT_ID => 0, AccountTableMap::COL_ACCOUNT_USERNAME => 1, AccountTableMap::COL_ACCOUNT_FIRSTNAME => 2, AccountTableMap::COL_ACCOUNT_LASTNAME => 3, AccountTableMap::COL_ACCOUNT_PASSWORD => 4, AccountTableMap::COL_ACCOUNT_STATUS => 5, AccountTableMap::COL_ACCOUNT_EMAIL => 6, AccountTableMap::COL_ACCOUNT_REGISTERDATE => 7, AccountTableMap::COL_ACCOUNT_EXPIRED => 8, AccountTableMap::COL_ACCOUNT_AVATAR => 9, AccountTableMap::COL_ACCOUNT_TOKEN => 10, AccountTableMap::COL_ACCOUNT_IPADDRESS => 11, AccountTableMap::COL_ACCOUNT_TYPE => 12, AccountTableMap::COL_ACCOUNT_CREDIT => 13, AccountTableMap::COL_ACCOUNT_DEBIT => 14, AccountTableMap::COL_ACCOUNT_KEY => 15, AccountTableMap::COL_ACCOUNT_DEV => 16, ),
        self::TYPE_FIELDNAME     => array('account_id' => 0, 'account_username' => 1, 'account_firstname' => 2, 'account_lastname' => 3, 'account_password' => 4, 'account_status' => 5, 'account_email' => 6, 'account_registerdate' => 7, 'account_expired' => 8, 'account_avatar' => 9, 'account_token' => 10, 'account_ipaddress' => 11, 'account_type' => 12, 'account_credit' => 13, 'account_debit' => 14, 'account_key' => 15, 'account_dev' => 16, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
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
        $this->setName('t_account');
        $this->setPhpName('Account');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Propel\\Table\\Account\\Account');
        $this->setPackage('Propel.Table.Account');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('account_id', 'Id', 'CHAR', true, 32, null);
        $this->addColumn('account_username', 'UserName', 'VARCHAR', false, 64, null);
        $this->addColumn('account_firstname', 'FirstName', 'VARCHAR', false, 255, null);
        $this->addColumn('account_lastname', 'LastName', 'VARCHAR', false, 255, null);
        $this->addColumn('account_password', 'Password', 'VARCHAR', false, 255, null);
        $this->addColumn('account_status', 'Status', 'VARCHAR', true, 1, 'p');
        $this->addColumn('account_email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('account_registerdate', 'RegisterDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('account_expired', 'Expired', 'DATE', false, null, null);
        $this->addColumn('account_avatar', 'Avatar', 'CLOB', false, null, null);
        $this->addColumn('account_token', 'Token', 'VARCHAR', false, 255, null);
        $this->addColumn('account_ipaddress', 'IPAddress', 'VARCHAR', false, 128, null);
        $this->addColumn('account_type', 'Type', 'VARCHAR', false, 64, 'free');
        $this->addColumn('account_credit', 'TotalCredit', 'DECIMAL', false, null, 0);
        $this->addColumn('account_debit', 'TotalDebit', 'DECIMAL', false, null, 0);
        $this->addColumn('account_key', 'Key', 'VARCHAR', false, 64, null);
        $this->addColumn('account_dev', 'Developer', 'VARCHAR', false, 1, 'n');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Credit', '\\Propel\\Table\\Account\\Credit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':credit_account',
    1 => ':account_id',
  ),
), null, null, 'Credits', false);
        $this->addRelation('Debit', '\\Propel\\Table\\Account\\Debit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':debit_account',
    1 => ':account_id',
  ),
), null, null, 'Debits', false);
        $this->addRelation('Transaction', '\\Propel\\Table\\Account\\Transaction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':transaction_account',
    1 => ':account_id',
  ),
), null, null, 'Transactions', false);
        $this->addRelation('Product', '\\Propel\\Table\\Account\\Product', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_owner',
    1 => ':account_id',
  ),
), null, null, 'Products', false);
        $this->addRelation('ProductReview', '\\Propel\\Table\\Account\\ProductReview', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':productreview_account',
    1 => ':account_id',
  ),
), null, null, 'ProductReviews', false);
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
            'behavior_account_debit' => array('name' => 'account_debit', 'expression' => 'SUM(debit_value)', 'condition' => '', 'foreign_table' => 't_debit', 'foreign_schema' => '', ),
            'behavior_account_credit' => array('name' => 'account_credit', 'expression' => 'SUM(credit_value)', 'condition' => '', 'foreign_table' => 't_credit', 'foreign_schema' => '', ),
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
        return $withPrefix ? AccountTableMap::CLASS_DEFAULT : AccountTableMap::OM_CLASS;
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
     * @return array           (Account object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AccountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AccountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AccountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AccountTableMap::OM_CLASS;
            /** @var Account $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AccountTableMap::addInstanceToPool($obj, $key);
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
            $key = AccountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AccountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Account $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AccountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_ID);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_USERNAME);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_FIRSTNAME);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_LASTNAME);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_PASSWORD);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_STATUS);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_EMAIL);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_REGISTERDATE);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_EXPIRED);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_AVATAR);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_TOKEN);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_IPADDRESS);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_TYPE);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_CREDIT);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_DEBIT);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_KEY);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCOUNT_DEV);
        } else {
            $criteria->addSelectColumn($alias . '.account_id');
            $criteria->addSelectColumn($alias . '.account_username');
            $criteria->addSelectColumn($alias . '.account_firstname');
            $criteria->addSelectColumn($alias . '.account_lastname');
            $criteria->addSelectColumn($alias . '.account_password');
            $criteria->addSelectColumn($alias . '.account_status');
            $criteria->addSelectColumn($alias . '.account_email');
            $criteria->addSelectColumn($alias . '.account_registerdate');
            $criteria->addSelectColumn($alias . '.account_expired');
            $criteria->addSelectColumn($alias . '.account_avatar');
            $criteria->addSelectColumn($alias . '.account_token');
            $criteria->addSelectColumn($alias . '.account_ipaddress');
            $criteria->addSelectColumn($alias . '.account_type');
            $criteria->addSelectColumn($alias . '.account_credit');
            $criteria->addSelectColumn($alias . '.account_debit');
            $criteria->addSelectColumn($alias . '.account_key');
            $criteria->addSelectColumn($alias . '.account_dev');
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
        return Propel::getServiceContainer()->getDatabaseMap(AccountTableMap::DATABASE_NAME)->getTable(AccountTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AccountTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AccountTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AccountTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Account or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Account object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Propel\Table\Account\Account) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AccountTableMap::DATABASE_NAME);
            $criteria->add(AccountTableMap::COL_ACCOUNT_ID, (array) $values, Criteria::IN);
        }

        $query = AccountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AccountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AccountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the t_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AccountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Account or Criteria object.
     *
     * @param mixed               $criteria Criteria or Account object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Account object
        }


        // Set the correct dbName
        $query = AccountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AccountTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AccountTableMap::buildTableMap();
