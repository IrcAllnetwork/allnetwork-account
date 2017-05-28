<?php

namespace Propel\Table\Account\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Table\Account\ProductTagList as ChildProductTagList;
use Propel\Table\Account\ProductTagListQuery as ChildProductTagListQuery;
use Propel\Table\Account\Map\ProductTagListTableMap;

/**
 * Base class that represents a query for the 't_producttaglist' table.
 *
 *
 *
 * @method     ChildProductTagListQuery orderById($order = Criteria::ASC) Order by the producttaglist_id column
 * @method     ChildProductTagListQuery orderByName($order = Criteria::ASC) Order by the producttaglist_name column
 * @method     ChildProductTagListQuery orderByTotalProduct($order = Criteria::ASC) Order by the producttaglist_totalproduct column
 *
 * @method     ChildProductTagListQuery groupById() Group by the producttaglist_id column
 * @method     ChildProductTagListQuery groupByName() Group by the producttaglist_name column
 * @method     ChildProductTagListQuery groupByTotalProduct() Group by the producttaglist_totalproduct column
 *
 * @method     ChildProductTagListQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductTagListQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductTagListQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductTagListQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductTagListQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductTagListQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductTagListQuery leftJoinProductTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductTag relation
 * @method     ChildProductTagListQuery rightJoinProductTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductTag relation
 * @method     ChildProductTagListQuery innerJoinProductTag($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductTag relation
 *
 * @method     ChildProductTagListQuery joinWithProductTag($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductTag relation
 *
 * @method     ChildProductTagListQuery leftJoinWithProductTag() Adds a LEFT JOIN clause and with to the query using the ProductTag relation
 * @method     ChildProductTagListQuery rightJoinWithProductTag() Adds a RIGHT JOIN clause and with to the query using the ProductTag relation
 * @method     ChildProductTagListQuery innerJoinWithProductTag() Adds a INNER JOIN clause and with to the query using the ProductTag relation
 *
 * @method     \Propel\Table\Account\ProductTagQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductTagList findOne(ConnectionInterface $con = null) Return the first ChildProductTagList matching the query
 * @method     ChildProductTagList findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductTagList matching the query, or a new ChildProductTagList object populated from the query conditions when no match is found
 *
 * @method     ChildProductTagList findOneById(string $producttaglist_id) Return the first ChildProductTagList filtered by the producttaglist_id column
 * @method     ChildProductTagList findOneByName(string $producttaglist_name) Return the first ChildProductTagList filtered by the producttaglist_name column
 * @method     ChildProductTagList findOneByTotalProduct(string $producttaglist_totalproduct) Return the first ChildProductTagList filtered by the producttaglist_totalproduct column *

 * @method     ChildProductTagList requirePk($key, ConnectionInterface $con = null) Return the ChildProductTagList by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductTagList requireOne(ConnectionInterface $con = null) Return the first ChildProductTagList matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductTagList requireOneById(string $producttaglist_id) Return the first ChildProductTagList filtered by the producttaglist_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductTagList requireOneByName(string $producttaglist_name) Return the first ChildProductTagList filtered by the producttaglist_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductTagList requireOneByTotalProduct(string $producttaglist_totalproduct) Return the first ChildProductTagList filtered by the producttaglist_totalproduct column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductTagList[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductTagList objects based on current ModelCriteria
 * @method     ChildProductTagList[]|ObjectCollection findById(string $producttaglist_id) Return ChildProductTagList objects filtered by the producttaglist_id column
 * @method     ChildProductTagList[]|ObjectCollection findByName(string $producttaglist_name) Return ChildProductTagList objects filtered by the producttaglist_name column
 * @method     ChildProductTagList[]|ObjectCollection findByTotalProduct(string $producttaglist_totalproduct) Return ChildProductTagList objects filtered by the producttaglist_totalproduct column
 * @method     ChildProductTagList[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductTagListQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Account\Base\ProductTagListQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Account\\ProductTagList', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductTagListQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductTagListQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductTagListQuery) {
            return $criteria;
        }
        $query = new ChildProductTagListQuery();
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
     * @return ChildProductTagList|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTagListTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductTagListTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProductTagList A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT producttaglist_id, producttaglist_name, producttaglist_totalproduct FROM t_producttaglist WHERE producttaglist_id = :p0';
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
            /** @var ChildProductTagList $obj */
            $obj = new ChildProductTagList();
            $obj->hydrate($row);
            ProductTagListTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductTagList|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductTagListQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductTagListTableMap::COL_PRODUCTTAGLIST_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductTagListQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductTagListTableMap::COL_PRODUCTTAGLIST_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the producttaglist_id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE producttaglist_id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE producttaglist_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductTagListQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTagListTableMap::COL_PRODUCTTAGLIST_ID, $id, $comparison);
    }

    /**
     * Filter the query on the producttaglist_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE producttaglist_name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE producttaglist_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductTagListQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTagListTableMap::COL_PRODUCTTAGLIST_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the producttaglist_totalproduct column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalProduct('fooValue');   // WHERE producttaglist_totalproduct = 'fooValue'
     * $query->filterByTotalProduct('%fooValue%', Criteria::LIKE); // WHERE producttaglist_totalproduct LIKE '%fooValue%'
     * </code>
     *
     * @param     string $totalProduct The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductTagListQuery The current query, for fluid interface
     */
    public function filterByTotalProduct($totalProduct = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($totalProduct)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTagListTableMap::COL_PRODUCTTAGLIST_TOTALPRODUCT, $totalProduct, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Table\Account\ProductTag object
     *
     * @param \Propel\Table\Account\ProductTag|ObjectCollection $productTag the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductTagListQuery The current query, for fluid interface
     */
    public function filterByProductTag($productTag, $comparison = null)
    {
        if ($productTag instanceof \Propel\Table\Account\ProductTag) {
            return $this
                ->addUsingAlias(ProductTagListTableMap::COL_PRODUCTTAGLIST_ID, $productTag->getProductTagListId(), $comparison);
        } elseif ($productTag instanceof ObjectCollection) {
            return $this
                ->useProductTagQuery()
                ->filterByPrimaryKeys($productTag->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductTag() only accepts arguments of type \Propel\Table\Account\ProductTag or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductTagListQuery The current query, for fluid interface
     */
    public function joinProductTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductTag');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductTag');
        }

        return $this;
    }

    /**
     * Use the ProductTag relation ProductTag object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\ProductTagQuery A secondary query class using the current class as primary query
     */
    public function useProductTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductTag', '\Propel\Table\Account\ProductTagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProductTagList $productTagList Object to remove from the list of results
     *
     * @return $this|ChildProductTagListQuery The current query, for fluid interface
     */
    public function prune($productTagList = null)
    {
        if ($productTagList) {
            $this->addUsingAlias(ProductTagListTableMap::COL_PRODUCTTAGLIST_ID, $productTagList->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the t_producttaglist table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTagListTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTagListTableMap::clearInstancePool();
            ProductTagListTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTagListTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTagListTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTagListTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTagListTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductTagListQuery
