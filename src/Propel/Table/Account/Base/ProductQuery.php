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
use Propel\Table\Account\Product as ChildProduct;
use Propel\Table\Account\ProductQuery as ChildProductQuery;
use Propel\Table\Account\Map\ProductTableMap;

/**
 * Base class that represents a query for the 't_product' table.
 *
 *
 *
 * @method     ChildProductQuery orderById($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProductQuery orderByName($order = Criteria::ASC) Order by the product_name column
 * @method     ChildProductQuery orderByOwner($order = Criteria::ASC) Order by the product_owner column
 * @method     ChildProductQuery orderByPrice($order = Criteria::ASC) Order by the product_price column
 * @method     ChildProductQuery orderByDiscount($order = Criteria::ASC) Order by the product_discount column
 * @method     ChildProductQuery orderByStatus($order = Criteria::ASC) Order by the product_status column
 * @method     ChildProductQuery orderByRepository($order = Criteria::ASC) Order by the product_repository column
 * @method     ChildProductQuery orderByLicense($order = Criteria::ASC) Order by the product_license column
 * @method     ChildProductQuery orderByDescription($order = Criteria::ASC) Order by the product_description column
 * @method     ChildProductQuery orderByTotalReview($order = Criteria::ASC) Order by the product_totalreview column
 * @method     ChildProductQuery orderByRating($order = Criteria::ASC) Order by the product_rating column
 * @method     ChildProductQuery orderByType($order = Criteria::ASC) Order by the product_type column
 *
 * @method     ChildProductQuery groupById() Group by the product_id column
 * @method     ChildProductQuery groupByName() Group by the product_name column
 * @method     ChildProductQuery groupByOwner() Group by the product_owner column
 * @method     ChildProductQuery groupByPrice() Group by the product_price column
 * @method     ChildProductQuery groupByDiscount() Group by the product_discount column
 * @method     ChildProductQuery groupByStatus() Group by the product_status column
 * @method     ChildProductQuery groupByRepository() Group by the product_repository column
 * @method     ChildProductQuery groupByLicense() Group by the product_license column
 * @method     ChildProductQuery groupByDescription() Group by the product_description column
 * @method     ChildProductQuery groupByTotalReview() Group by the product_totalreview column
 * @method     ChildProductQuery groupByRating() Group by the product_rating column
 * @method     ChildProductQuery groupByType() Group by the product_type column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductQuery leftJoinAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Account relation
 * @method     ChildProductQuery rightJoinAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Account relation
 * @method     ChildProductQuery innerJoinAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Account relation
 *
 * @method     ChildProductQuery joinWithAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Account relation
 *
 * @method     ChildProductQuery leftJoinWithAccount() Adds a LEFT JOIN clause and with to the query using the Account relation
 * @method     ChildProductQuery rightJoinWithAccount() Adds a RIGHT JOIN clause and with to the query using the Account relation
 * @method     ChildProductQuery innerJoinWithAccount() Adds a INNER JOIN clause and with to the query using the Account relation
 *
 * @method     ChildProductQuery leftJoinTransactionDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransactionDetail relation
 * @method     ChildProductQuery rightJoinTransactionDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransactionDetail relation
 * @method     ChildProductQuery innerJoinTransactionDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the TransactionDetail relation
 *
 * @method     ChildProductQuery joinWithTransactionDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransactionDetail relation
 *
 * @method     ChildProductQuery leftJoinWithTransactionDetail() Adds a LEFT JOIN clause and with to the query using the TransactionDetail relation
 * @method     ChildProductQuery rightJoinWithTransactionDetail() Adds a RIGHT JOIN clause and with to the query using the TransactionDetail relation
 * @method     ChildProductQuery innerJoinWithTransactionDetail() Adds a INNER JOIN clause and with to the query using the TransactionDetail relation
 *
 * @method     ChildProductQuery leftJoinProductReview($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductReview relation
 * @method     ChildProductQuery rightJoinProductReview($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductReview relation
 * @method     ChildProductQuery innerJoinProductReview($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductReview relation
 *
 * @method     ChildProductQuery joinWithProductReview($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductReview relation
 *
 * @method     ChildProductQuery leftJoinWithProductReview() Adds a LEFT JOIN clause and with to the query using the ProductReview relation
 * @method     ChildProductQuery rightJoinWithProductReview() Adds a RIGHT JOIN clause and with to the query using the ProductReview relation
 * @method     ChildProductQuery innerJoinWithProductReview() Adds a INNER JOIN clause and with to the query using the ProductReview relation
 *
 * @method     ChildProductQuery leftJoinProductImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductImage relation
 * @method     ChildProductQuery rightJoinProductImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductImage relation
 * @method     ChildProductQuery innerJoinProductImage($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductImage relation
 *
 * @method     ChildProductQuery joinWithProductImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductImage relation
 *
 * @method     ChildProductQuery leftJoinWithProductImage() Adds a LEFT JOIN clause and with to the query using the ProductImage relation
 * @method     ChildProductQuery rightJoinWithProductImage() Adds a RIGHT JOIN clause and with to the query using the ProductImage relation
 * @method     ChildProductQuery innerJoinWithProductImage() Adds a INNER JOIN clause and with to the query using the ProductImage relation
 *
 * @method     ChildProductQuery leftJoinProductTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductTag relation
 * @method     ChildProductQuery rightJoinProductTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductTag relation
 * @method     ChildProductQuery innerJoinProductTag($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductTag relation
 *
 * @method     ChildProductQuery joinWithProductTag($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductTag relation
 *
 * @method     ChildProductQuery leftJoinWithProductTag() Adds a LEFT JOIN clause and with to the query using the ProductTag relation
 * @method     ChildProductQuery rightJoinWithProductTag() Adds a RIGHT JOIN clause and with to the query using the ProductTag relation
 * @method     ChildProductQuery innerJoinWithProductTag() Adds a INNER JOIN clause and with to the query using the ProductTag relation
 *
 * @method     \Propel\Table\Account\AccountQuery|\Propel\Table\Account\TransactionDetailQuery|\Propel\Table\Account\ProductReviewQuery|\Propel\Table\Account\ProductImageQuery|\Propel\Table\Account\ProductTagQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct findOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when no match is found
 *
 * @method     ChildProduct findOneById(string $product_id) Return the first ChildProduct filtered by the product_id column
 * @method     ChildProduct findOneByName(string $product_name) Return the first ChildProduct filtered by the product_name column
 * @method     ChildProduct findOneByOwner(string $product_owner) Return the first ChildProduct filtered by the product_owner column
 * @method     ChildProduct findOneByPrice(string $product_price) Return the first ChildProduct filtered by the product_price column
 * @method     ChildProduct findOneByDiscount(string $product_discount) Return the first ChildProduct filtered by the product_discount column
 * @method     ChildProduct findOneByStatus(string $product_status) Return the first ChildProduct filtered by the product_status column
 * @method     ChildProduct findOneByRepository(string $product_repository) Return the first ChildProduct filtered by the product_repository column
 * @method     ChildProduct findOneByLicense(string $product_license) Return the first ChildProduct filtered by the product_license column
 * @method     ChildProduct findOneByDescription(string $product_description) Return the first ChildProduct filtered by the product_description column
 * @method     ChildProduct findOneByTotalReview(int $product_totalreview) Return the first ChildProduct filtered by the product_totalreview column
 * @method     ChildProduct findOneByRating(int $product_rating) Return the first ChildProduct filtered by the product_rating column
 * @method     ChildProduct findOneByType(string $product_type) Return the first ChildProduct filtered by the product_type column *

 * @method     ChildProduct requirePk($key, ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneById(string $product_id) Return the first ChildProduct filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByName(string $product_name) Return the first ChildProduct filtered by the product_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByOwner(string $product_owner) Return the first ChildProduct filtered by the product_owner column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByPrice(string $product_price) Return the first ChildProduct filtered by the product_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDiscount(string $product_discount) Return the first ChildProduct filtered by the product_discount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByStatus(string $product_status) Return the first ChildProduct filtered by the product_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByRepository(string $product_repository) Return the first ChildProduct filtered by the product_repository column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByLicense(string $product_license) Return the first ChildProduct filtered by the product_license column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDescription(string $product_description) Return the first ChildProduct filtered by the product_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByTotalReview(int $product_totalreview) Return the first ChildProduct filtered by the product_totalreview column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByRating(int $product_rating) Return the first ChildProduct filtered by the product_rating column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByType(string $product_type) Return the first ChildProduct filtered by the product_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @method     ChildProduct[]|ObjectCollection findById(string $product_id) Return ChildProduct objects filtered by the product_id column
 * @method     ChildProduct[]|ObjectCollection findByName(string $product_name) Return ChildProduct objects filtered by the product_name column
 * @method     ChildProduct[]|ObjectCollection findByOwner(string $product_owner) Return ChildProduct objects filtered by the product_owner column
 * @method     ChildProduct[]|ObjectCollection findByPrice(string $product_price) Return ChildProduct objects filtered by the product_price column
 * @method     ChildProduct[]|ObjectCollection findByDiscount(string $product_discount) Return ChildProduct objects filtered by the product_discount column
 * @method     ChildProduct[]|ObjectCollection findByStatus(string $product_status) Return ChildProduct objects filtered by the product_status column
 * @method     ChildProduct[]|ObjectCollection findByRepository(string $product_repository) Return ChildProduct objects filtered by the product_repository column
 * @method     ChildProduct[]|ObjectCollection findByLicense(string $product_license) Return ChildProduct objects filtered by the product_license column
 * @method     ChildProduct[]|ObjectCollection findByDescription(string $product_description) Return ChildProduct objects filtered by the product_description column
 * @method     ChildProduct[]|ObjectCollection findByTotalReview(int $product_totalreview) Return ChildProduct objects filtered by the product_totalreview column
 * @method     ChildProduct[]|ObjectCollection findByRating(int $product_rating) Return ChildProduct objects filtered by the product_rating column
 * @method     ChildProduct[]|ObjectCollection findByType(string $product_type) Return ChildProduct objects filtered by the product_type column
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductQuery extends ModelCriteria
{

    // query_cache behavior
    protected $queryKey = '';
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Account\Base\ProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Account\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT product_id, product_name, product_owner, product_price, product_discount, product_status, product_repository, product_license, product_description, product_totalreview, product_rating, product_type FROM t_product WHERE product_id = :p0';
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
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE product_id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE product_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $id, $comparison);
    }

    /**
     * Filter the query on the product_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE product_name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE product_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the product_owner column
     *
     * Example usage:
     * <code>
     * $query->filterByOwner('fooValue');   // WHERE product_owner = 'fooValue'
     * $query->filterByOwner('%fooValue%', Criteria::LIKE); // WHERE product_owner LIKE '%fooValue%'
     * </code>
     *
     * @param     string $owner The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByOwner($owner = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($owner)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_OWNER, $owner, $comparison);
    }

    /**
     * Filter the query on the product_price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE product_price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE product_price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE product_price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the product_discount column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscount(1234); // WHERE product_discount = 1234
     * $query->filterByDiscount(array(12, 34)); // WHERE product_discount IN (12, 34)
     * $query->filterByDiscount(array('min' => 12)); // WHERE product_discount > 12
     * </code>
     *
     * @param     mixed $discount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDiscount($discount = null, $comparison = null)
    {
        if (is_array($discount)) {
            $useMinMax = false;
            if (isset($discount['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_DISCOUNT, $discount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discount['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_DISCOUNT, $discount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_DISCOUNT, $discount, $comparison);
    }

    /**
     * Filter the query on the product_status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE product_status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE product_status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the product_repository column
     *
     * Example usage:
     * <code>
     * $query->filterByRepository('fooValue');   // WHERE product_repository = 'fooValue'
     * $query->filterByRepository('%fooValue%', Criteria::LIKE); // WHERE product_repository LIKE '%fooValue%'
     * </code>
     *
     * @param     string $repository The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByRepository($repository = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($repository)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_REPOSITORY, $repository, $comparison);
    }

    /**
     * Filter the query on the product_license column
     *
     * Example usage:
     * <code>
     * $query->filterByLicense('fooValue');   // WHERE product_license = 'fooValue'
     * $query->filterByLicense('%fooValue%', Criteria::LIKE); // WHERE product_license LIKE '%fooValue%'
     * </code>
     *
     * @param     string $license The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByLicense($license = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($license)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_LICENSE, $license, $comparison);
    }

    /**
     * Filter the query on the product_description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE product_description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE product_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the product_totalreview column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalReview(1234); // WHERE product_totalreview = 1234
     * $query->filterByTotalReview(array(12, 34)); // WHERE product_totalreview IN (12, 34)
     * $query->filterByTotalReview(array('min' => 12)); // WHERE product_totalreview > 12
     * </code>
     *
     * @param     mixed $totalReview The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByTotalReview($totalReview = null, $comparison = null)
    {
        if (is_array($totalReview)) {
            $useMinMax = false;
            if (isset($totalReview['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_TOTALREVIEW, $totalReview['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalReview['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_TOTALREVIEW, $totalReview['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_TOTALREVIEW, $totalReview, $comparison);
    }

    /**
     * Filter the query on the product_rating column
     *
     * Example usage:
     * <code>
     * $query->filterByRating(1234); // WHERE product_rating = 1234
     * $query->filterByRating(array(12, 34)); // WHERE product_rating IN (12, 34)
     * $query->filterByRating(array('min' => 12)); // WHERE product_rating > 12
     * </code>
     *
     * @param     mixed $rating The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByRating($rating = null, $comparison = null)
    {
        if (is_array($rating)) {
            $useMinMax = false;
            if (isset($rating['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_RATING, $rating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rating['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_RATING, $rating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_RATING, $rating, $comparison);
    }

    /**
     * Filter the query on the product_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE product_type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE product_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_TYPE, $type, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Account object
     *
     * @param \Propel\Table\Account\Account|ObjectCollection $account The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByAccount($account, $comparison = null)
    {
        if ($account instanceof \Propel\Table\Account\Account) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_OWNER, $account->getId(), $comparison);
        } elseif ($account instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_OWNER, $account->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * Filter the query by a related \Propel\Table\Account\TransactionDetail object
     *
     * @param \Propel\Table\Account\TransactionDetail|ObjectCollection $transactionDetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByTransactionDetail($transactionDetail, $comparison = null)
    {
        if ($transactionDetail instanceof \Propel\Table\Account\TransactionDetail) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $transactionDetail->getProductId(), $comparison);
        } elseif ($transactionDetail instanceof ObjectCollection) {
            return $this
                ->useTransactionDetailQuery()
                ->filterByPrimaryKeys($transactionDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTransactionDetail() only accepts arguments of type \Propel\Table\Account\TransactionDetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TransactionDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinTransactionDetail($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TransactionDetail');

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
            $this->addJoinObject($join, 'TransactionDetail');
        }

        return $this;
    }

    /**
     * Use the TransactionDetail relation TransactionDetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\TransactionDetailQuery A secondary query class using the current class as primary query
     */
    public function useTransactionDetailQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTransactionDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TransactionDetail', '\Propel\Table\Account\TransactionDetailQuery');
    }

    /**
     * Filter the query by a related \Propel\Table\Account\ProductReview object
     *
     * @param \Propel\Table\Account\ProductReview|ObjectCollection $productReview the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductReview($productReview, $comparison = null)
    {
        if ($productReview instanceof \Propel\Table\Account\ProductReview) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $productReview->getProductId(), $comparison);
        } elseif ($productReview instanceof ObjectCollection) {
            return $this
                ->useProductReviewQuery()
                ->filterByPrimaryKeys($productReview->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductReview() only accepts arguments of type \Propel\Table\Account\ProductReview or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductReview relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductReview($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductReview');

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
            $this->addJoinObject($join, 'ProductReview');
        }

        return $this;
    }

    /**
     * Use the ProductReview relation ProductReview object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\ProductReviewQuery A secondary query class using the current class as primary query
     */
    public function useProductReviewQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductReview($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductReview', '\Propel\Table\Account\ProductReviewQuery');
    }

    /**
     * Filter the query by a related \Propel\Table\Account\ProductImage object
     *
     * @param \Propel\Table\Account\ProductImage|ObjectCollection $productImage the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductImage($productImage, $comparison = null)
    {
        if ($productImage instanceof \Propel\Table\Account\ProductImage) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $productImage->getProductId(), $comparison);
        } elseif ($productImage instanceof ObjectCollection) {
            return $this
                ->useProductImageQuery()
                ->filterByPrimaryKeys($productImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductImage() only accepts arguments of type \Propel\Table\Account\ProductImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductImage');

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
            $this->addJoinObject($join, 'ProductImage');
        }

        return $this;
    }

    /**
     * Use the ProductImage relation ProductImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\ProductImageQuery A secondary query class using the current class as primary query
     */
    public function useProductImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductImage', '\Propel\Table\Account\ProductImageQuery');
    }

    /**
     * Filter the query by a related \Propel\Table\Account\ProductTag object
     *
     * @param \Propel\Table\Account\ProductTag|ObjectCollection $productTag the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductTag($productTag, $comparison = null)
    {
        if ($productTag instanceof \Propel\Table\Account\ProductTag) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $productTag->getProductId(), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * @param   ChildProduct $product Object to remove from the list of results
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $product->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the t_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // query_cache behavior

    public function setQueryKey($key)
    {
        $this->queryKey = $key;

        return $this;
    }

    public function getQueryKey()
    {
        return $this->queryKey;
    }

    public function cacheContains($key)
    {

        return apc_fetch($key);
    }

    public function cacheFetch($key)
    {

        return apc_fetch($key);
    }

    public function cacheStore($key, $value, $lifetime = 3600)
    {
        apc_store($key, $value, $lifetime);
    }

    public function doSelect(ConnectionInterface $con = null)
    {
        // check that the columns of the main class are already added (if this is the primary ModelCriteria)
        if (!$this->hasSelectClause() && !$this->getPrimaryCriteria()) {
            $this->addSelfSelectColumns();
        }
        $this->configureSelectColumns();

        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME);
        $db = Propel::getServiceContainer()->getAdapter(ProductTableMap::DATABASE_NAME);

        $key = $this->getQueryKey();
        if ($key && $this->cacheContains($key)) {
            $params = $this->getParams();
            $sql = $this->cacheFetch($key);
        } else {
            $params = array();
            $sql = $this->createSelectSql($params);
        }

        try {
            $stmt = $con->prepare($sql);
            $db->bindValues($stmt, $params, $dbMap);
            $stmt->execute();
            } catch (Exception $e) {
                Propel::log($e->getMessage(), Propel::LOG_ERR);
                throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
            }

        if ($key && !$this->cacheContains($key)) {
                $this->cacheStore($key, $sql);
        }

        return $con->getDataFetcher($stmt);
    }

    public function doCount(ConnectionInterface $con = null)
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap($this->getDbName());
        $db = Propel::getServiceContainer()->getAdapter($this->getDbName());

        $key = $this->getQueryKey();
        if ($key && $this->cacheContains($key)) {
            $params = $this->getParams();
            $sql = $this->cacheFetch($key);
        } else {
            // check that the columns of the main class are already added (if this is the primary ModelCriteria)
            if (!$this->hasSelectClause() && !$this->getPrimaryCriteria()) {
                $this->addSelfSelectColumns();
            }

            $this->configureSelectColumns();

            $needsComplexCount = $this->getGroupByColumns()
                || $this->getOffset()
                || $this->getLimit() >= 0
                || $this->getHaving()
                || in_array(Criteria::DISTINCT, $this->getSelectModifiers())
                || count($this->selectQueries) > 0
            ;

            $params = array();
            if ($needsComplexCount) {
                if ($this->needsSelectAliases()) {
                    if ($this->getHaving()) {
                        throw new PropelException('Propel cannot create a COUNT query when using HAVING and  duplicate column names in the SELECT part');
                    }
                    $db->turnSelectColumnsToAliases($this);
                }
                $selectSql = $this->createSelectSql($params);
                $sql = 'SELECT COUNT(*) FROM (' . $selectSql . ') propelmatch4cnt';
            } else {
                // Replace SELECT columns with COUNT(*)
                $this->clearSelectColumns()->addSelectColumn('COUNT(*)');
                $sql = $this->createSelectSql($params);
            }
        }

        try {
            $stmt = $con->prepare($sql);
            $db->bindValues($stmt, $params, $dbMap);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute COUNT statement [%s]', $sql), 0, $e);
        }

        if ($key && !$this->cacheContains($key)) {
                $this->cacheStore($key, $sql);
        }


        return $con->getDataFetcher($stmt);
    }

} // ProductQuery
