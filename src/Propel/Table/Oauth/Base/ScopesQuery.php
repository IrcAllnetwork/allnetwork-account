<?php

namespace Propel\Table\Oauth\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Table\Oauth\Scopes as ChildScopes;
use Propel\Table\Oauth\ScopesQuery as ChildScopesQuery;
use Propel\Table\Oauth\Map\ScopesTableMap;

/**
 * Base class that represents a query for the 'oauth_scopes' table.
 *
 *
 *
 * @method     ChildScopesQuery orderByScope($order = Criteria::ASC) Order by the scope column
 * @method     ChildScopesQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 *
 * @method     ChildScopesQuery groupByScope() Group by the scope column
 * @method     ChildScopesQuery groupByIsDefault() Group by the is_default column
 *
 * @method     ChildScopesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildScopesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildScopesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildScopesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildScopesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildScopesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildScopes findOne(ConnectionInterface $con = null) Return the first ChildScopes matching the query
 * @method     ChildScopes findOneOrCreate(ConnectionInterface $con = null) Return the first ChildScopes matching the query, or a new ChildScopes object populated from the query conditions when no match is found
 *
 * @method     ChildScopes findOneByScope(string $scope) Return the first ChildScopes filtered by the scope column
 * @method     ChildScopes findOneByIsDefault(boolean $is_default) Return the first ChildScopes filtered by the is_default column *

 * @method     ChildScopes requirePk($key, ConnectionInterface $con = null) Return the ChildScopes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScopes requireOne(ConnectionInterface $con = null) Return the first ChildScopes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildScopes requireOneByScope(string $scope) Return the first ChildScopes filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScopes requireOneByIsDefault(boolean $is_default) Return the first ChildScopes filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildScopes[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildScopes objects based on current ModelCriteria
 * @method     ChildScopes[]|ObjectCollection findByScope(string $scope) Return ChildScopes objects filtered by the scope column
 * @method     ChildScopes[]|ObjectCollection findByIsDefault(boolean $is_default) Return ChildScopes objects filtered by the is_default column
 * @method     ChildScopes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ScopesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Oauth\Base\ScopesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Oauth\\Scopes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildScopesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildScopesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildScopesQuery) {
            return $criteria;
        }
        $query = new ChildScopesQuery();
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
     * @return ChildScopes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The Scopes object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        throw new LogicException('The Scopes object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildScopesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The Scopes object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildScopesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The Scopes object has no primary key');
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
     * @return $this|ChildScopesQuery The current query, for fluid interface
     */
    public function filterByScope($scope = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scope)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScopesTableMap::COL_SCOPE, $scope, $comparison);
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     boolean|string $isDefault The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScopesQuery The current query, for fluid interface
     */
    public function filterByIsDefault($isDefault = null, $comparison = null)
    {
        if (is_string($isDefault)) {
            $isDefault = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ScopesTableMap::COL_IS_DEFAULT, $isDefault, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildScopes $scopes Object to remove from the list of results
     *
     * @return $this|ChildScopesQuery The current query, for fluid interface
     */
    public function prune($scopes = null)
    {
        if ($scopes) {
            throw new LogicException('Scopes object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the oauth_scopes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScopesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ScopesTableMap::clearInstancePool();
            ScopesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ScopesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ScopesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ScopesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ScopesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ScopesQuery
