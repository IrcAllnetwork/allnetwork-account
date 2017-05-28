<?php

namespace Propel\Table\Account\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Table\Account\ProductTag as ChildProductTag;
use Propel\Table\Account\ProductTagQuery as ChildProductTagQuery;
use Propel\Table\Account\Map\ProductTagTableMap;

/**
 * Base class that represents a query for the 't_producttag' table.
 *
 *
 *
 * @method     ChildProductTagQuery orderByProductId($order = Criteria::ASC) Order by the producttag_product column
 * @method     ChildProductTagQuery orderByProductTagListId($order = Criteria::ASC) Order by the producttag_tag column
 *
 * @method     ChildProductTagQuery groupByProductId() Group by the producttag_product column
 * @method     ChildProductTagQuery groupByProductTagListId() Group by the producttag_tag column
 *
 * @method     ChildProductTagQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductTagQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductTagQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductTagQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductTagQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductTagQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductTagQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildProductTagQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildProductTagQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildProductTagQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildProductTagQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildProductTagQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildProductTagQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildProductTagQuery leftJoinProductTagList($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductTagList relation
 * @method     ChildProductTagQuery rightJoinProductTagList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductTagList relation
 * @method     ChildProductTagQuery innerJoinProductTagList($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductTagList relation
 *
 * @method     ChildProductTagQuery joinWithProductTagList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductTagList relation
 *
 * @method     ChildProductTagQuery leftJoinWithProductTagList() Adds a LEFT JOIN clause and with to the query using the ProductTagList relation
 * @method     ChildProductTagQuery rightJoinWithProductTagList() Adds a RIGHT JOIN clause and with to the query using the ProductTagList relation
 * @method     ChildProductTagQuery innerJoinWithProductTagList() Adds a INNER JOIN clause and with to the query using the ProductTagList relation
 *
 * @method     \Propel\Table\Account\ProductQuery|\Propel\Table\Account\ProductTagListQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductTag findOne(ConnectionInterface $con = null) Return the first ChildProductTag matching the query
 * @method     ChildProductTag findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductTag matching the query, or a new ChildProductTag object populated from the query conditions when no match is found
 *
 * @method     ChildProductTag findOneByProductId(string $producttag_product) Return the first ChildProductTag filtered by the producttag_product column
 * @method     ChildProductTag findOneByProductTagListId(string $producttag_tag) Return the first ChildProductTag filtered by the producttag_tag column *

 * @method     ChildProductTag requirePk($key, ConnectionInterface $con = null) Return the ChildProductTag by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductTag requireOne(ConnectionInterface $con = null) Return the first ChildProductTag matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductTag requireOneByProductId(string $producttag_product) Return the first ChildProductTag filtered by the producttag_product column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductTag requireOneByProductTagListId(string $producttag_tag) Return the first ChildProductTag filtered by the producttag_tag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductTag[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductTag objects based on current ModelCriteria
 * @method     ChildProductTag[]|ObjectCollection findByProductId(string $producttag_product) Return ChildProductTag objects filtered by the producttag_product column
 * @method     ChildProductTag[]|ObjectCollection findByProductTagListId(string $producttag_tag) Return ChildProductTag objects filtered by the producttag_tag column
 * @method     ChildProductTag[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductTagQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Account\Base\ProductTagQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Account\\ProductTag', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductTagQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductTagQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductTagQuery) {
            return $criteria;
        }
        $query = new ChildProductTagQuery();
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
     * @return ChildProductTag|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The ProductTag object has no primary key');
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
        throw new LogicException('The ProductTag object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildProductTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The ProductTag object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The ProductTag object has no primary key');
    }

    /**
     * Filter the query on the producttag_product column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId('fooValue');   // WHERE producttag_product = 'fooValue'
     * $query->filterByProductId('%fooValue%', Criteria::LIKE); // WHERE producttag_product LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductTagQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTagTableMap::COL_PRODUCTTAG_PRODUCT, $productId, $comparison);
    }

    /**
     * Filter the query on the producttag_tag column
     *
     * Example usage:
     * <code>
     * $query->filterByProductTagListId('fooValue');   // WHERE producttag_tag = 'fooValue'
     * $query->filterByProductTagListId('%fooValue%', Criteria::LIKE); // WHERE producttag_tag LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productTagListId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductTagQuery The current query, for fluid interface
     */
    public function filterByProductTagListId($productTagListId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productTagListId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTagTableMap::COL_PRODUCTTAG_TAG, $productTagListId, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Product object
     *
     * @param \Propel\Table\Account\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductTagQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Propel\Table\Account\Product) {
            return $this
                ->addUsingAlias(ProductTagTableMap::COL_PRODUCTTAG_PRODUCT, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTagTableMap::COL_PRODUCTTAG_PRODUCT, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \Propel\Table\Account\Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductTagQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\Propel\Table\Account\ProductQuery');
    }

    /**
     * Filter the query by a related \Propel\Table\Account\ProductTagList object
     *
     * @param \Propel\Table\Account\ProductTagList|ObjectCollection $productTagList The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductTagQuery The current query, for fluid interface
     */
    public function filterByProductTagList($productTagList, $comparison = null)
    {
        if ($productTagList instanceof \Propel\Table\Account\ProductTagList) {
            return $this
                ->addUsingAlias(ProductTagTableMap::COL_PRODUCTTAG_TAG, $productTagList->getId(), $comparison);
        } elseif ($productTagList instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTagTableMap::COL_PRODUCTTAG_TAG, $productTagList->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProductTagList() only accepts arguments of type \Propel\Table\Account\ProductTagList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductTagList relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductTagQuery The current query, for fluid interface
     */
    public function joinProductTagList($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductTagList');

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
            $this->addJoinObject($join, 'ProductTagList');
        }

        return $this;
    }

    /**
     * Use the ProductTagList relation ProductTagList object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\ProductTagListQuery A secondary query class using the current class as primary query
     */
    public function useProductTagListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductTagList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductTagList', '\Propel\Table\Account\ProductTagListQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProductTag $productTag Object to remove from the list of results
     *
     * @return $this|ChildProductTagQuery The current query, for fluid interface
     */
    public function prune($productTag = null)
    {
        if ($productTag) {
            throw new LogicException('ProductTag object has no primary key');

        }

        return $this;
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePreDelete(ConnectionInterface $con)
    {
        // aggregate_column_relation_behavior_productaglist_total behavior
        $this->findRelatedProductTagListTotalProducts($con);

        return $this->preDelete($con);
    }

    /**
     * Code to execute after every DELETE statement
     *
     * @param     int $affectedRows the number of deleted rows
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePostDelete($affectedRows, ConnectionInterface $con)
    {
        // aggregate_column_relation_behavior_productaglist_total behavior
        $this->updateRelatedProductTagListTotalProducts($con);

        return $this->postDelete($affectedRows, $con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param     array $values The associative array of columns and values for the update
     * @param     ConnectionInterface $con The connection object used by the query
     * @param     boolean $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false)
    {
        // aggregate_column_relation_behavior_productaglist_total behavior
        $this->findRelatedProductTagListTotalProducts($con);

        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Code to execute after every UPDATE statement
     *
     * @param     int $affectedRows the number of updated rows
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePostUpdate($affectedRows, ConnectionInterface $con)
    {
        // aggregate_column_relation_behavior_productaglist_total behavior
        $this->updateRelatedProductTagListTotalProducts($con);

        return $this->postUpdate($affectedRows, $con);
    }

    /**
     * Deletes all rows from the t_producttag table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTagTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTagTableMap::clearInstancePool();
            ProductTagTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTagTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTagTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTagTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTagTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // aggregate_column_relation_behavior_productaglist_total behavior

    /**
     * Finds the related ProductTagList objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedProductTagListTotalProducts($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->productTagListTotalProducts = \Propel\Table\Account\ProductTagListQuery::create()
            ->joinProductTag($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedProductTagListTotalProducts($con)
    {
        foreach ($this->productTagListTotalProducts as $productTagListTotalProduct) {
            $productTagListTotalProduct->updateTotalProduct($con);
        }
        $this->productTagListTotalProducts = array();
    }

} // ProductTagQuery
