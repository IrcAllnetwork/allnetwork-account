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
use Propel\Table\Oauth\AuthorizationCode as ChildAuthorizationCode;
use Propel\Table\Oauth\AuthorizationCodeQuery as ChildAuthorizationCodeQuery;
use Propel\Table\Oauth\Map\AuthorizationCodeTableMap;

/**
 * Base class that represents a query for the 'oauth_authorization_codes' table.
 *
 *
 *
 * @method     ChildAuthorizationCodeQuery orderByAuthorizationCode($order = Criteria::ASC) Order by the authorization_code column
 * @method     ChildAuthorizationCodeQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method     ChildAuthorizationCodeQuery orderByRedirectURI($order = Criteria::ASC) Order by the redirect_uri column
 * @method     ChildAuthorizationCodeQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildAuthorizationCodeQuery orderByExpires($order = Criteria::ASC) Order by the expires column
 * @method     ChildAuthorizationCodeQuery orderByScope($order = Criteria::ASC) Order by the scope column
 *
 * @method     ChildAuthorizationCodeQuery groupByAuthorizationCode() Group by the authorization_code column
 * @method     ChildAuthorizationCodeQuery groupByClientId() Group by the client_id column
 * @method     ChildAuthorizationCodeQuery groupByRedirectURI() Group by the redirect_uri column
 * @method     ChildAuthorizationCodeQuery groupByUserId() Group by the user_id column
 * @method     ChildAuthorizationCodeQuery groupByExpires() Group by the expires column
 * @method     ChildAuthorizationCodeQuery groupByScope() Group by the scope column
 *
 * @method     ChildAuthorizationCodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAuthorizationCodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAuthorizationCodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAuthorizationCodeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAuthorizationCodeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAuthorizationCodeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAuthorizationCode findOne(ConnectionInterface $con = null) Return the first ChildAuthorizationCode matching the query
 * @method     ChildAuthorizationCode findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAuthorizationCode matching the query, or a new ChildAuthorizationCode object populated from the query conditions when no match is found
 *
 * @method     ChildAuthorizationCode findOneByAuthorizationCode(string $authorization_code) Return the first ChildAuthorizationCode filtered by the authorization_code column
 * @method     ChildAuthorizationCode findOneByClientId(string $client_id) Return the first ChildAuthorizationCode filtered by the client_id column
 * @method     ChildAuthorizationCode findOneByRedirectURI(string $redirect_uri) Return the first ChildAuthorizationCode filtered by the redirect_uri column
 * @method     ChildAuthorizationCode findOneByUserId(string $user_id) Return the first ChildAuthorizationCode filtered by the user_id column
 * @method     ChildAuthorizationCode findOneByExpires(string $expires) Return the first ChildAuthorizationCode filtered by the expires column
 * @method     ChildAuthorizationCode findOneByScope(string $scope) Return the first ChildAuthorizationCode filtered by the scope column *

 * @method     ChildAuthorizationCode requirePk($key, ConnectionInterface $con = null) Return the ChildAuthorizationCode by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorizationCode requireOne(ConnectionInterface $con = null) Return the first ChildAuthorizationCode matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuthorizationCode requireOneByAuthorizationCode(string $authorization_code) Return the first ChildAuthorizationCode filtered by the authorization_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorizationCode requireOneByClientId(string $client_id) Return the first ChildAuthorizationCode filtered by the client_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorizationCode requireOneByRedirectURI(string $redirect_uri) Return the first ChildAuthorizationCode filtered by the redirect_uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorizationCode requireOneByUserId(string $user_id) Return the first ChildAuthorizationCode filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorizationCode requireOneByExpires(string $expires) Return the first ChildAuthorizationCode filtered by the expires column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorizationCode requireOneByScope(string $scope) Return the first ChildAuthorizationCode filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuthorizationCode[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAuthorizationCode objects based on current ModelCriteria
 * @method     ChildAuthorizationCode[]|ObjectCollection findByAuthorizationCode(string $authorization_code) Return ChildAuthorizationCode objects filtered by the authorization_code column
 * @method     ChildAuthorizationCode[]|ObjectCollection findByClientId(string $client_id) Return ChildAuthorizationCode objects filtered by the client_id column
 * @method     ChildAuthorizationCode[]|ObjectCollection findByRedirectURI(string $redirect_uri) Return ChildAuthorizationCode objects filtered by the redirect_uri column
 * @method     ChildAuthorizationCode[]|ObjectCollection findByUserId(string $user_id) Return ChildAuthorizationCode objects filtered by the user_id column
 * @method     ChildAuthorizationCode[]|ObjectCollection findByExpires(string $expires) Return ChildAuthorizationCode objects filtered by the expires column
 * @method     ChildAuthorizationCode[]|ObjectCollection findByScope(string $scope) Return ChildAuthorizationCode objects filtered by the scope column
 * @method     ChildAuthorizationCode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AuthorizationCodeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Oauth\Base\AuthorizationCodeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Oauth\\AuthorizationCode', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAuthorizationCodeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAuthorizationCodeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAuthorizationCodeQuery) {
            return $criteria;
        }
        $query = new ChildAuthorizationCodeQuery();
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
     * @return ChildAuthorizationCode|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AuthorizationCodeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AuthorizationCodeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAuthorizationCode A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT authorization_code, client_id, redirect_uri, user_id, expires, scope FROM oauth_authorization_codes WHERE authorization_code = :p0';
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
            /** @var ChildAuthorizationCode $obj */
            $obj = new ChildAuthorizationCode();
            $obj->hydrate($row);
            AuthorizationCodeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAuthorizationCode|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AuthorizationCodeTableMap::COL_AUTHORIZATION_CODE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AuthorizationCodeTableMap::COL_AUTHORIZATION_CODE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the authorization_code column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthorizationCode('fooValue');   // WHERE authorization_code = 'fooValue'
     * $query->filterByAuthorizationCode('%fooValue%', Criteria::LIKE); // WHERE authorization_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $authorizationCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function filterByAuthorizationCode($authorizationCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($authorizationCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationCodeTableMap::COL_AUTHORIZATION_CODE, $authorizationCode, $comparison);
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
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function filterByClientId($clientId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationCodeTableMap::COL_CLIENT_ID, $clientId, $comparison);
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
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function filterByRedirectURI($redirectURI = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($redirectURI)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationCodeTableMap::COL_REDIRECT_URI, $redirectURI, $comparison);
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
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationCodeTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the expires column
     *
     * Example usage:
     * <code>
     * $query->filterByExpires('2011-03-14'); // WHERE expires = '2011-03-14'
     * $query->filterByExpires('now'); // WHERE expires = '2011-03-14'
     * $query->filterByExpires(array('max' => 'yesterday')); // WHERE expires > '2011-03-13'
     * </code>
     *
     * @param     mixed $expires The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function filterByExpires($expires = null, $comparison = null)
    {
        if (is_array($expires)) {
            $useMinMax = false;
            if (isset($expires['min'])) {
                $this->addUsingAlias(AuthorizationCodeTableMap::COL_EXPIRES, $expires['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expires['max'])) {
                $this->addUsingAlias(AuthorizationCodeTableMap::COL_EXPIRES, $expires['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationCodeTableMap::COL_EXPIRES, $expires, $comparison);
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
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function filterByScope($scope = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scope)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationCodeTableMap::COL_SCOPE, $scope, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAuthorizationCode $authorizationCode Object to remove from the list of results
     *
     * @return $this|ChildAuthorizationCodeQuery The current query, for fluid interface
     */
    public function prune($authorizationCode = null)
    {
        if ($authorizationCode) {
            $this->addUsingAlias(AuthorizationCodeTableMap::COL_AUTHORIZATION_CODE, $authorizationCode->getAuthorizationCode(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the oauth_authorization_codes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuthorizationCodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AuthorizationCodeTableMap::clearInstancePool();
            AuthorizationCodeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AuthorizationCodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AuthorizationCodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AuthorizationCodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AuthorizationCodeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AuthorizationCodeQuery
