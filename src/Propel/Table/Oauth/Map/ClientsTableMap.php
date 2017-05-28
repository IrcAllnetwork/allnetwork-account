<?php

namespace Propel\Table\Oauth\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Propel\Table\Oauth\Clients;
use Propel\Table\Oauth\ClientsQuery;


/**
 * This class defines the structure of the 'oauth_clients' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ClientsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Propel.Table.Oauth.Map.ClientsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'oauth_clients';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Propel\\Table\\Oauth\\Clients';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Propel.Table.Oauth.Clients';

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
     * the column name for the client_id field
     */
    const COL_CLIENT_ID = 'oauth_clients.client_id';

    /**
     * the column name for the client_secret field
     */
    const COL_CLIENT_SECRET = 'oauth_clients.client_secret';

    /**
     * the column name for the redirect_uri field
     */
    const COL_REDIRECT_URI = 'oauth_clients.redirect_uri';

    /**
     * the column name for the grant_types field
     */
    const COL_GRANT_TYPES = 'oauth_clients.grant_types';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'oauth_clients.user_id';

    /**
     * the column name for the scope field
     */
    const COL_SCOPE = 'oauth_clients.scope';

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
        self::TYPE_PHPNAME       => array('ClientId', 'ClientSecret', 'RedirectURI', 'GrantTypes', 'UserId', 'Scope', ),
        self::TYPE_CAMELNAME     => array('clientId', 'clientSecret', 'redirectURI', 'grantTypes', 'userId', 'scope', ),
        self::TYPE_COLNAME       => array(ClientsTableMap::COL_CLIENT_ID, ClientsTableMap::COL_CLIENT_SECRET, ClientsTableMap::COL_REDIRECT_URI, ClientsTableMap::COL_GRANT_TYPES, ClientsTableMap::COL_USER_ID, ClientsTableMap::COL_SCOPE, ),
        self::TYPE_FIELDNAME     => array('client_id', 'client_secret', 'redirect_uri', 'grant_types', 'user_id', 'scope', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ClientId' => 0, 'ClientSecret' => 1, 'RedirectURI' => 2, 'GrantTypes' => 3, 'UserId' => 4, 'Scope' => 5, ),
        self::TYPE_CAMELNAME     => array('clientId' => 0, 'clientSecret' => 1, 'redirectURI' => 2, 'grantTypes' => 3, 'userId' => 4, 'scope' => 5, ),
        self::TYPE_COLNAME       => array(ClientsTableMap::COL_CLIENT_ID => 0, ClientsTableMap::COL_CLIENT_SECRET => 1, ClientsTableMap::COL_REDIRECT_URI => 2, ClientsTableMap::COL_GRANT_TYPES => 3, ClientsTableMap::COL_USER_ID => 4, ClientsTableMap::COL_SCOPE => 5, ),
        self::TYPE_FIELDNAME     => array('client_id' => 0, 'client_secret' => 1, 'redirect_uri' => 2, 'grant_types' => 3, 'user_id' => 4, 'scope' => 5, ),
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
        $this->setName('oauth_clients');
        $this->setPhpName('Clients');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Propel\\Table\\Oauth\\Clients');
        $this->setPackage('Propel.Table.Oauth');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('client_id', 'ClientId', 'CHAR', true, 32, null);
        $this->addColumn('client_secret', 'ClientSecret', 'VARCHAR', false, 80, null);
        $this->addColumn('redirect_uri', 'RedirectURI', 'VARCHAR', false, 2000, null);
        $this->addColumn('grant_types', 'GrantTypes', 'VARCHAR', false, 80, null);
        $this->addColumn('user_id', 'UserId', 'CHAR', false, 32, null);
        $this->addColumn('scope', 'Scope', 'VARCHAR', false, 2000, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ClientId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ClientsTableMap::CLASS_DEFAULT : ClientsTableMap::OM_CLASS;
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
     * @return array           (Clients object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ClientsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ClientsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ClientsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ClientsTableMap::OM_CLASS;
            /** @var Clients $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ClientsTableMap::addInstanceToPool($obj, $key);
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
            $key = ClientsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ClientsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Clients $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ClientsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ClientsTableMap::COL_CLIENT_ID);
            $criteria->addSelectColumn(ClientsTableMap::COL_CLIENT_SECRET);
            $criteria->addSelectColumn(ClientsTableMap::COL_REDIRECT_URI);
            $criteria->addSelectColumn(ClientsTableMap::COL_GRANT_TYPES);
            $criteria->addSelectColumn(ClientsTableMap::COL_USER_ID);
            $criteria->addSelectColumn(ClientsTableMap::COL_SCOPE);
        } else {
            $criteria->addSelectColumn($alias . '.client_id');
            $criteria->addSelectColumn($alias . '.client_secret');
            $criteria->addSelectColumn($alias . '.redirect_uri');
            $criteria->addSelectColumn($alias . '.grant_types');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.scope');
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
        return Propel::getServiceContainer()->getDatabaseMap(ClientsTableMap::DATABASE_NAME)->getTable(ClientsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ClientsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ClientsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ClientsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Clients or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Clients object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ClientsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Propel\Table\Oauth\Clients) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ClientsTableMap::DATABASE_NAME);
            $criteria->add(ClientsTableMap::COL_CLIENT_ID, (array) $values, Criteria::IN);
        }

        $query = ClientsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ClientsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ClientsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the oauth_clients table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ClientsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Clients or Criteria object.
     *
     * @param mixed               $criteria Criteria or Clients object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Clients object
        }


        // Set the correct dbName
        $query = ClientsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ClientsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ClientsTableMap::buildTableMap();
