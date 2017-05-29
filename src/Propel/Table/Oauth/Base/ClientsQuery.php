<?php

namespace Propel\Table\Oauth\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Table\Oauth\Clients as ChildClients;
use Propel\Table\Oauth\ClientsQuery as ChildClientsQuery;
use Propel\Table\Oauth\Map\ClientsTableMap;

/**
 * Base class that represents a query for the 'oauth_clients' table.
 *
 *
 *
 * @method     ChildClientsQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method     ChildClientsQuery orderByClientSecret($order = Criteria::ASC) Order by the client_secret column
 * @method     ChildClientsQuery orderByRedirectURI($order = Criteria::ASC) Order by the redirect_uri column
 * @method     ChildClientsQuery orderByGrantTypes($order = Criteria::ASC) Order by the grant_types column
 * @method     ChildClientsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildClientsQuery orderByScope($order = Criteria::ASC) Order by the scope column
 * @method     ChildClientsQuery orderByName($order = Criteria::ASC) Order by the client_name column
 * @method     ChildClientsQuery orderByIcon($order = Criteria::ASC) Order by the client_icon column
 *
 * @method     ChildClientsQuery groupByClientId() Group by the client_id column
 * @method     ChildClientsQuery groupByClientSecret() Group by the client_secret column
 * @method     ChildClientsQuery groupByRedirectURI() Group by the redirect_uri column
 * @method     ChildClientsQuery groupByGrantTypes() Group by the grant_types column
 * @method     ChildClientsQuery groupByUserId() Group by the user_id column
 * @method     ChildClientsQuery groupByScope() Group by the scope column
 * @method     ChildClientsQuery groupByName() Group by the client_name column
 * @method     ChildClientsQuery groupByIcon() Group by the client_icon column
 *
 * @method     ChildClientsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildClientsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildClientsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildClientsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildClientsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildClientsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildClients findOne(ConnectionInterface $con = null) Return the first ChildClients matching the query
 * @method     ChildClients findOneOrCreate(ConnectionInterface $con = null) Return the first ChildClients matching the query, or a new ChildClients object populated from the query conditions when no match is found
 *
 * @method     ChildClients findOneByClientId(string $client_id) Return the first ChildClients filtered by the client_id column
 * @method     ChildClients findOneByClientSecret(string $client_secret) Return the first ChildClients filtered by the client_secret column
 * @method     ChildClients findOneByRedirectURI(string $redirect_uri) Return the first ChildClients filtered by the redirect_uri column
 * @method     ChildClients findOneByGrantTypes(string $grant_types) Return the first ChildClients filtered by the grant_types column
 * @method     ChildClients findOneByUserId(string $user_id) Return the first ChildClients filtered by the user_id column
 * @method     ChildClients findOneByScope(string $scope) Return the first ChildClients filtered by the scope column
 * @method     ChildClients findOneByName(string $client_name) Return the first ChildClients filtered by the client_name column
 * @method     ChildClients findOneByIcon(string $client_icon) Return the first ChildClients filtered by the client_icon column *

 * @method     ChildClients requirePk($key, ConnectionInterface $con = null) Return the ChildClients by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClients requireOne(ConnectionInterface $con = null) Return the first ChildClients matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClients requireOneByClientId(string $client_id) Return the first ChildClients filtered by the client_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClients requireOneByClientSecret(string $client_secret) Return the first ChildClients filtered by the client_secret column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClients requireOneByRedirectURI(string $redirect_uri) Return the first ChildClients filtered by the redirect_uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClients requireOneByGrantTypes(string $grant_types) Return the first ChildClients filtered by the grant_types column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClients requireOneByUserId(string $user_id) Return the first ChildClients filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClients requireOneByScope(string $scope) Return the first ChildClients filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClients requireOneByName(string $client_name) Return the first ChildClients filtered by the client_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClients requireOneByIcon(string $client_icon) Return the first ChildClients filtered by the client_icon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClients[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildClients objects based on current ModelCriteria
 * @method     ChildClients[]|ObjectCollection findByClientId(string $client_id) Return ChildClients objects filtered by the client_id column
 * @method     ChildClients[]|ObjectCollection findByClientSecret(string $client_secret) Return ChildClients objects filtered by the client_secret column
 * @method     ChildClients[]|ObjectCollection findByRedirectURI(string $redirect_uri) Return ChildClients objects filtered by the redirect_uri column
 * @method     ChildClients[]|ObjectCollection findByGrantTypes(string $grant_types) Return ChildClients objects filtered by the grant_types column
 * @method     ChildClients[]|ObjectCollection findByUserId(string $user_id) Return ChildClients objects filtered by the user_id column
 * @method     ChildClients[]|ObjectCollection findByScope(string $scope) Return ChildClients objects filtered by the scope column
 * @method     ChildClients[]|ObjectCollection findByName(string $client_name) Return ChildClients objects filtered by the client_name column
 * @method     ChildClients[]|ObjectCollection findByIcon(string $client_icon) Return ChildClients objects filtered by the client_icon column
 * @method     ChildClients[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ClientsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Oauth\Base\ClientsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Oauth\\Clients', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildClientsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildClientsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildClientsQuery) {
            return $criteria;
        }
        $query = new ChildClientsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildClients|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClientsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ClientsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildClients A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT client_id, client_secret, redirect_uri, grant_types, user_id, scope, client_name, client_icon FROM oauth_clients WHERE client_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildClients $obj */
            $obj = new ChildClients();
            $obj->hydrate($row);
            ClientsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildClients|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ClientsTableMap::COL_CLIENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ClientsTableMap::COL_CLIENT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the client_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClientId('fooValue');   // WHERE client_id = 'fooValue'
     * $query->filterByClientId('%fooValue%', Criteria::LIKE); // WHERE client_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByClientId($clientId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientsTableMap::COL_CLIENT_ID, $clientId, $comparison);
    }

    /**
     * Filter the query on the client_secret column
     *
     * Example usage:
     * <code>
     * $query->filterByClientSecret('fooValue');   // WHERE client_secret = 'fooValue'
     * $query->filterByClientSecret('%fooValue%', Criteria::LIKE); // WHERE client_secret LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientSecret The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByClientSecret($clientSecret = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientSecret)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientsTableMap::COL_CLIENT_SECRET, $clientSecret, $comparison);
    }

    /**
     * Filter the query on the redirect_uri column
     *
     * Example usage:
     * <code>
     * $query->filterByRedirectURI('fooValue');   // WHERE redirect_uri = 'fooValue'
     * $query->filterByRedirectURI('%fooValue%', Criteria::LIKE); // WHERE redirect_uri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $redirectURI The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByRedirectURI($redirectURI = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($redirectURI)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientsTableMap::COL_REDIRECT_URI, $redirectURI, $comparison);
    }

    /**
     * Filter the query on the grant_types column
     *
     * Example usage:
     * <code>
     * $query->filterByGrantTypes('fooValue');   // WHERE grant_types = 'fooValue'
     * $query->filterByGrantTypes('%fooValue%', Criteria::LIKE); // WHERE grant_types LIKE '%fooValue%'
     * </code>
     *
     * @param     string $grantTypes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByGrantTypes($grantTypes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grantTypes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientsTableMap::COL_GRANT_TYPES, $grantTypes, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId('fooValue');   // WHERE user_id = 'fooValue'
     * $query->filterByUserId('%fooValue%', Criteria::LIKE); // WHERE user_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientsTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the scope column
     *
     * Example usage:
     * <code>
     * $query->filterByScope('fooValue');   // WHERE scope = 'fooValue'
     * $query->filterByScope('%fooValue%', Criteria::LIKE); // WHERE scope LIKE '%fooValue%'
     * </code>
     *
     * @param     string $scope The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByScope($scope = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scope)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientsTableMap::COL_SCOPE, $scope, $comparison);
    }

    /**
     * Filter the query on the client_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE client_name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE client_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientsTableMap::COL_CLIENT_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the client_icon column
     *
     * Example usage:
     * <code>
     * $query->filterByIcon('fooValue');   // WHERE client_icon = 'fooValue'
     * $query->filterByIcon('%fooValue%', Criteria::LIKE); // WHERE client_icon LIKE '%fooValue%'
     * </code>
     *
     * @param     string $icon The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function filterByIcon($icon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($icon)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientsTableMap::COL_CLIENT_ICON, $icon, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildClients $clients Object to remove from the list of results
     *
     * @return $this|ChildClientsQuery The current query, for fluid interface
     */
    public function prune($clients = null)
    {
        if ($clients) {
            $this->addUsingAlias(ClientsTableMap::COL_CLIENT_ID, $clients->getClientId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the oauth_clients table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ClientsTableMap::clearInstancePool();
            ClientsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ClientsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ClientsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ClientsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ClientsQuery
