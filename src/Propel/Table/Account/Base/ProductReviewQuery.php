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
use Propel\Table\Account\ProductReview as ChildProductReview;
use Propel\Table\Account\ProductReviewQuery as ChildProductReviewQuery;
use Propel\Table\Account\Map\ProductReviewTableMap;

/**
 * Base class that represents a query for the 't_productreview' table.
 *
 *
 *
 * @method     ChildProductReviewQuery orderById($order = Criteria::ASC) Order by the productreview_id column
 * @method     ChildProductReviewQuery orderByAccountId($order = Criteria::ASC) Order by the productreview_account column
 * @method     ChildProductReviewQuery orderByRate($order = Criteria::ASC) Order by the productreview_rate column
 * @method     ChildProductReviewQuery orderByDetail($order = Criteria::ASC) Order by the productreview_detail column
 * @method     ChildProductReviewQuery orderByProductId($order = Criteria::ASC) Order by the productreview_product column
 *
 * @method     ChildProductReviewQuery groupById() Group by the productreview_id column
 * @method     ChildProductReviewQuery groupByAccountId() Group by the productreview_account column
 * @method     ChildProductReviewQuery groupByRate() Group by the productreview_rate column
 * @method     ChildProductReviewQuery groupByDetail() Group by the productreview_detail column
 * @method     ChildProductReviewQuery groupByProductId() Group by the productreview_product column
 *
 * @method     ChildProductReviewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductReviewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductReviewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductReviewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductReviewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductReviewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductReviewQuery leftJoinAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Account relation
 * @method     ChildProductReviewQuery rightJoinAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Account relation
 * @method     ChildProductReviewQuery innerJoinAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Account relation
 *
 * @method     ChildProductReviewQuery joinWithAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Account relation
 *
 * @method     ChildProductReviewQuery leftJoinWithAccount() Adds a LEFT JOIN clause and with to the query using the Account relation
 * @method     ChildProductReviewQuery rightJoinWithAccount() Adds a RIGHT JOIN clause and with to the query using the Account relation
 * @method     ChildProductReviewQuery innerJoinWithAccount() Adds a INNER JOIN clause and with to the query using the Account relation
 *
 * @method     ChildProductReviewQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildProductReviewQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildProductReviewQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildProductReviewQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildProductReviewQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildProductReviewQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildProductReviewQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \Propel\Table\Account\AccountQuery|\Propel\Table\Account\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductReview findOne(ConnectionInterface $con = null) Return the first ChildProductReview matching the query
 * @method     ChildProductReview findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductReview matching the query, or a new ChildProductReview object populated from the query conditions when no match is found
 *
 * @method     ChildProductReview findOneById(string $productreview_id) Return the first ChildProductReview filtered by the productreview_id column
 * @method     ChildProductReview findOneByAccountId(string $productreview_account) Return the first ChildProductReview filtered by the productreview_account column
 * @method     ChildProductReview findOneByRate(int $productreview_rate) Return the first ChildProductReview filtered by the productreview_rate column
 * @method     ChildProductReview findOneByDetail(string $productreview_detail) Return the first ChildProductReview filtered by the productreview_detail column
 * @method     ChildProductReview findOneByProductId(string $productreview_product) Return the first ChildProductReview filtered by the productreview_product column *

 * @method     ChildProductReview requirePk($key, ConnectionInterface $con = null) Return the ChildProductReview by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductReview requireOne(ConnectionInterface $con = null) Return the first ChildProductReview matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductReview requireOneById(string $productreview_id) Return the first ChildProductReview filtered by the productreview_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductReview requireOneByAccountId(string $productreview_account) Return the first ChildProductReview filtered by the productreview_account column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductReview requireOneByRate(int $productreview_rate) Return the first ChildProductReview filtered by the productreview_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductReview requireOneByDetail(string $productreview_detail) Return the first ChildProductReview filtered by the productreview_detail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductReview requireOneByProductId(string $productreview_product) Return the first ChildProductReview filtered by the productreview_product column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductReview[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductReview objects based on current ModelCriteria
 * @method     ChildProductReview[]|ObjectCollection findById(string $productreview_id) Return ChildProductReview objects filtered by the productreview_id column
 * @method     ChildProductReview[]|ObjectCollection findByAccountId(string $productreview_account) Return ChildProductReview objects filtered by the productreview_account column
 * @method     ChildProductReview[]|ObjectCollection findByRate(int $productreview_rate) Return ChildProductReview objects filtered by the productreview_rate column
 * @method     ChildProductReview[]|ObjectCollection findByDetail(string $productreview_detail) Return ChildProductReview objects filtered by the productreview_detail column
 * @method     ChildProductReview[]|ObjectCollection findByProductId(string $productreview_product) Return ChildProductReview objects filtered by the productreview_product column
 * @method     ChildProductReview[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductReviewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Account\Base\ProductReviewQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Account\\ProductReview', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductReviewQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductReviewQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductReviewQuery) {
            return $criteria;
        }
        $query = new ChildProductReviewQuery();
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
     * @return ChildProductReview|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductReviewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductReviewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProductReview A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT productreview_id, productreview_account, productreview_rate, productreview_detail, productreview_product FROM t_productreview WHERE productreview_id = :p0';
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
            /** @var ChildProductReview $obj */
            $obj = new ChildProductReview();
            $obj->hydrate($row);
            ProductReviewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductReview|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the productreview_id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE productreview_id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE productreview_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_ID, $id, $comparison);
    }

    /**
     * Filter the query on the productreview_account column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountId('fooValue');   // WHERE productreview_account = 'fooValue'
     * $query->filterByAccountId('%fooValue%', Criteria::LIKE); // WHERE productreview_account LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accountId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterByAccountId($accountId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_ACCOUNT, $accountId, $comparison);
    }

    /**
     * Filter the query on the productreview_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByRate(1234); // WHERE productreview_rate = 1234
     * $query->filterByRate(array(12, 34)); // WHERE productreview_rate IN (12, 34)
     * $query->filterByRate(array('min' => 12)); // WHERE productreview_rate > 12
     * </code>
     *
     * @param     mixed $rate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterByRate($rate = null, $comparison = null)
    {
        if (is_array($rate)) {
            $useMinMax = false;
            if (isset($rate['min'])) {
                $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_RATE, $rate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rate['max'])) {
                $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_RATE, $rate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_RATE, $rate, $comparison);
    }

    /**
     * Filter the query on the productreview_detail column
     *
     * Example usage:
     * <code>
     * $query->filterByDetail('fooValue');   // WHERE productreview_detail = 'fooValue'
     * $query->filterByDetail('%fooValue%', Criteria::LIKE); // WHERE productreview_detail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $detail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterByDetail($detail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($detail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_DETAIL, $detail, $comparison);
    }

    /**
     * Filter the query on the productreview_product column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId('fooValue');   // WHERE productreview_product = 'fooValue'
     * $query->filterByProductId('%fooValue%', Criteria::LIKE); // WHERE productreview_product LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_PRODUCT, $productId, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Account object
     *
     * @param \Propel\Table\Account\Account|ObjectCollection $account The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterByAccount($account, $comparison = null)
    {
        if ($account instanceof \Propel\Table\Account\Account) {
            return $this
                ->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_ACCOUNT, $account->getId(), $comparison);
        } elseif ($account instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_ACCOUNT, $account->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAccount() only accepts arguments of type \Propel\Table\Account\Account or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Account relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function joinAccount($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Account');

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
            $this->addJoinObject($join, 'Account');
        }

        return $this;
    }

    /**
     * Use the Account relation Account object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\AccountQuery A secondary query class using the current class as primary query
     */
    public function useAccountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Account', '\Propel\Table\Account\AccountQuery');
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Product object
     *
     * @param \Propel\Table\Account\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductReviewQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Propel\Table\Account\Product) {
            return $this
                ->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_PRODUCT, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_PRODUCT, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildProductReview $productReview Object to remove from the list of results
     *
     * @return $this|ChildProductReviewQuery The current query, for fluid interface
     */
    public function prune($productReview = null)
    {
        if ($productReview) {
            $this->addUsingAlias(ProductReviewTableMap::COL_PRODUCTREVIEW_ID, $productReview->getId(), Criteria::NOT_EQUAL);
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
        // aggregate_column_relation_behavior_product_totalreview behavior
        $this->findRelatedProductTotalReviews($con);
        // aggregate_column_relation_behavior_product_rating behavior
        $this->findRelatedProductRatings($con);

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
        // aggregate_column_relation_behavior_product_totalreview behavior
        $this->updateRelatedProductTotalReviews($con);
        // aggregate_column_relation_behavior_product_rating behavior
        $this->updateRelatedProductRatings($con);

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
        // aggregate_column_relation_behavior_product_totalreview behavior
        $this->findRelatedProductTotalReviews($con);
        // aggregate_column_relation_behavior_product_rating behavior
        $this->findRelatedProductRatings($con);

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
        // aggregate_column_relation_behavior_product_totalreview behavior
        $this->updateRelatedProductTotalReviews($con);
        // aggregate_column_relation_behavior_product_rating behavior
        $this->updateRelatedProductRatings($con);

        return $this->postUpdate($affectedRows, $con);
    }

    /**
     * Deletes all rows from the t_productreview table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductReviewTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductReviewTableMap::clearInstancePool();
            ProductReviewTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductReviewTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductReviewTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductReviewTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductReviewTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // aggregate_column_relation_behavior_product_totalreview behavior

    /**
     * Finds the related Product objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedProductTotalReviews($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->productTotalReviews = \Propel\Table\Account\ProductQuery::create()
            ->joinProductReview($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedProductTotalReviews($con)
    {
        foreach ($this->productTotalReviews as $productTotalReview) {
            $productTotalReview->updateTotalReview($con);
        }
        $this->productTotalReviews = array();
    }

    // aggregate_column_relation_behavior_product_rating behavior

    /**
     * Finds the related Product objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedProductRatings($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->productRatings = \Propel\Table\Account\ProductQuery::create()
            ->joinProductReview($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedProductRatings($con)
    {
        foreach ($this->productRatings as $productRating) {
            $productRating->updateRating($con);
        }
        $this->productRatings = array();
    }

} // ProductReviewQuery
