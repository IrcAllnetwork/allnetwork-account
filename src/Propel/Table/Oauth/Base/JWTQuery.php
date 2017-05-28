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
use Propel\Table\Oauth\JWT as ChildJWT;
use Propel\Table\Oauth\JWTQuery as ChildJWTQuery;
use Propel\Table\Oauth\Map\JWTTableMap;

/**
 * Base class that represents a query for the 'oauth_jwt' table.
 *
 *
 *
 * @method     ChildJWTQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method     ChildJWTQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 * @method     ChildJWTQuery orderByPublicKey($order = Criteria::ASC) Order by the public_key column
 *
 * @method     ChildJWTQuery groupByClientId() Group by the client_id column
 * @method     ChildJWTQuery groupBySubject() Group by the subject column
 * @method     ChildJWTQuery groupByPublicKey() Group by the public_key column
 *
 * @method     ChildJWTQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJWTQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJWTQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJWTQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJWTQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJWTQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJWT findOne(ConnectionInterface $con = null) Return the first ChildJWT matching the query
 * @method     ChildJWT findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJWT matching the query, or a new ChildJWT object populated from the query conditions when no match is found
 *
 * @method     ChildJWT findOneByClientId(string $client_id) Return the first ChildJWT filtered by the client_id column
 * @method     ChildJWT findOneBySubject(string $subject) Return the first ChildJWT filtered by the subject column
 * @method     ChildJWT findOneByPublicKey(string $public_key) Return the first ChildJWT filtered by the public_key column *

 * @method     ChildJWT requirePk($key, ConnectionInterface $con = null) Return the ChildJWT by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJWT requireOne(ConnectionInterface $con = null) Return the first ChildJWT matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJWT requireOneByClientId(string $client_id) Return the first ChildJWT filtered by the client_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJWT requireOneBySubject(string $subject) Return the first ChildJWT filtered by the subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJWT requireOneByPublicKey(string $public_key) Return the first ChildJWT filtered by the public_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJWT[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJWT objects based on current ModelCriteria
 * @method     ChildJWT[]|ObjectCollection findByClientId(string $client_id) Return ChildJWT objects filtered by the client_id column
 * @method     ChildJWT[]|ObjectCollection findBySubject(string $subject) Return ChildJWT objects filtered by the subject column
 * @method     ChildJWT[]|ObjectCollection findByPublicKey(string $public_key) Return ChildJWT objects filtered by the public_key column
 * @method     ChildJWT[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JWTQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Oauth\Base\JWTQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Oauth\\JWT', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJWTQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJWTQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJWTQuery) {
            return $criteria;
        }
        $query = new ChildJWTQuery();
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
     * @return ChildJWT|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JWTTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JWTTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJWT A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT client_id, subject, public_key FROM oauth_jwt WHERE client_id = :p0';
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
            /** @var ChildJWT $obj */
            $obj = new ChildJWT();
            $obj->hydrate($row);
            JWTTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJWT|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJWTQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JWTTableMap::COL_CLIENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJWTQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JWTTableMap::COL_CLIENT_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJWTQuery The current query, for fluid interface
     */
    public function filterByClientId($clientId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JWTTableMap::COL_CLIENT_ID, $clientId, $comparison);
    }

    /**
     * Filter the query on the subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE subject = 'fooValue'
     * $query->filterBySubject('%fooValue%', Criteria::LIKE); // WHERE subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subject The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJWTQuery The current query, for fluid interface
     */
    public function filterBySubject($subject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JWTTableMap::COL_SUBJECT, $subject, $comparison);
    }

    /**
     * Filter the query on the public_key column
     *
     * Example usage:
     * <code>
     * $query->filterByPublicKey('fooValue');   // WHERE public_key = 'fooValue'
     * $query->filterByPublicKey('%fooValue%', Criteria::LIKE); // WHERE public_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $publicKey The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJWTQuery The current query, for fluid interface
     */
    public function filterByPublicKey($publicKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($publicKey)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JWTTableMap::COL_PUBLIC_KEY, $publicKey, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJWT $jWT Object to remove from the list of results
     *
     * @return $this|ChildJWTQuery The current query, for fluid interface
     */
    public function prune($jWT = null)
    {
        if ($jWT) {
            $this->addUsingAlias(JWTTableMap::COL_CLIENT_ID, $jWT->getClientId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the oauth_jwt table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JWTTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JWTTableMap::clearInstancePool();
            JWTTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JWTTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JWTTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JWTTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JWTTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JWTQuery
