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
use Propel\Table\Account\TransactionDetail as ChildTransactionDetail;
use Propel\Table\Account\TransactionDetailQuery as ChildTransactionDetailQuery;
use Propel\Table\Account\Map\TransactionDetailTableMap;

/**
 * Base class that represents a query for the 't_transactiondetail' table.
 *
 *
 *
 * @method     ChildTransactionDetailQuery orderById($order = Criteria::ASC) Order by the transactiondetail_id column
 * @method     ChildTransactionDetailQuery orderByTransactionId($order = Criteria::ASC) Order by the transactiondetail_transaction column
 * @method     ChildTransactionDetailQuery orderByType($order = Criteria::ASC) Order by the transactiondetail_type column
 * @method     ChildTransactionDetailQuery orderByDescription($order = Criteria::ASC) Order by the transactiondetail_description column
 * @method     ChildTransactionDetailQuery orderByQuantity($order = Criteria::ASC) Order by the transactiondetail_qty column
 * @method     ChildTransactionDetailQuery orderByPrice($order = Criteria::ASC) Order by the transactiondetail_price column
 * @method     ChildTransactionDetailQuery orderByValue($order = Criteria::ASC) Order by the transactiondetail_value column
 * @method     ChildTransactionDetailQuery orderByDiscount($order = Criteria::ASC) Order by the transactiondetail_discount column
 * @method     ChildTransactionDetailQuery orderByProductId($order = Criteria::ASC) Order by the transactiondetail_product column
 * @method     ChildTransactionDetailQuery orderByProductName($order = Criteria::ASC) Order by the transactiondetail_productname column
 *
 * @method     ChildTransactionDetailQuery groupById() Group by the transactiondetail_id column
 * @method     ChildTransactionDetailQuery groupByTransactionId() Group by the transactiondetail_transaction column
 * @method     ChildTransactionDetailQuery groupByType() Group by the transactiondetail_type column
 * @method     ChildTransactionDetailQuery groupByDescription() Group by the transactiondetail_description column
 * @method     ChildTransactionDetailQuery groupByQuantity() Group by the transactiondetail_qty column
 * @method     ChildTransactionDetailQuery groupByPrice() Group by the transactiondetail_price column
 * @method     ChildTransactionDetailQuery groupByValue() Group by the transactiondetail_value column
 * @method     ChildTransactionDetailQuery groupByDiscount() Group by the transactiondetail_discount column
 * @method     ChildTransactionDetailQuery groupByProductId() Group by the transactiondetail_product column
 * @method     ChildTransactionDetailQuery groupByProductName() Group by the transactiondetail_productname column
 *
 * @method     ChildTransactionDetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTransactionDetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTransactionDetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTransactionDetailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTransactionDetailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTransactionDetailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTransactionDetailQuery leftJoinTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Transaction relation
 * @method     ChildTransactionDetailQuery rightJoinTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Transaction relation
 * @method     ChildTransactionDetailQuery innerJoinTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the Transaction relation
 *
 * @method     ChildTransactionDetailQuery joinWithTransaction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Transaction relation
 *
 * @method     ChildTransactionDetailQuery leftJoinWithTransaction() Adds a LEFT JOIN clause and with to the query using the Transaction relation
 * @method     ChildTransactionDetailQuery rightJoinWithTransaction() Adds a RIGHT JOIN clause and with to the query using the Transaction relation
 * @method     ChildTransactionDetailQuery innerJoinWithTransaction() Adds a INNER JOIN clause and with to the query using the Transaction relation
 *
 * @method     ChildTransactionDetailQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildTransactionDetailQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildTransactionDetailQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildTransactionDetailQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildTransactionDetailQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildTransactionDetailQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildTransactionDetailQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \Propel\Table\Account\TransactionQuery|\Propel\Table\Account\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTransactionDetail findOne(ConnectionInterface $con = null) Return the first ChildTransactionDetail matching the query
 * @method     ChildTransactionDetail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTransactionDetail matching the query, or a new ChildTransactionDetail object populated from the query conditions when no match is found
 *
 * @method     ChildTransactionDetail findOneById(string $transactiondetail_id) Return the first ChildTransactionDetail filtered by the transactiondetail_id column
 * @method     ChildTransactionDetail findOneByTransactionId(string $transactiondetail_transaction) Return the first ChildTransactionDetail filtered by the transactiondetail_transaction column
 * @method     ChildTransactionDetail findOneByType(string $transactiondetail_type) Return the first ChildTransactionDetail filtered by the transactiondetail_type column
 * @method     ChildTransactionDetail findOneByDescription(string $transactiondetail_description) Return the first ChildTransactionDetail filtered by the transactiondetail_description column
 * @method     ChildTransactionDetail findOneByQuantity(int $transactiondetail_qty) Return the first ChildTransactionDetail filtered by the transactiondetail_qty column
 * @method     ChildTransactionDetail findOneByPrice(string $transactiondetail_price) Return the first ChildTransactionDetail filtered by the transactiondetail_price column
 * @method     ChildTransactionDetail findOneByValue(string $transactiondetail_value) Return the first ChildTransactionDetail filtered by the transactiondetail_value column
 * @method     ChildTransactionDetail findOneByDiscount(string $transactiondetail_discount) Return the first ChildTransactionDetail filtered by the transactiondetail_discount column
 * @method     ChildTransactionDetail findOneByProductId(string $transactiondetail_product) Return the first ChildTransactionDetail filtered by the transactiondetail_product column
 * @method     ChildTransactionDetail findOneByProductName(string $transactiondetail_productname) Return the first ChildTransactionDetail filtered by the transactiondetail_productname column *

 * @method     ChildTransactionDetail requirePk($key, ConnectionInterface $con = null) Return the ChildTransactionDetail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOne(ConnectionInterface $con = null) Return the first ChildTransactionDetail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTransactionDetail requireOneById(string $transactiondetail_id) Return the first ChildTransactionDetail filtered by the transactiondetail_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByTransactionId(string $transactiondetail_transaction) Return the first ChildTransactionDetail filtered by the transactiondetail_transaction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByType(string $transactiondetail_type) Return the first ChildTransactionDetail filtered by the transactiondetail_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByDescription(string $transactiondetail_description) Return the first ChildTransactionDetail filtered by the transactiondetail_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByQuantity(int $transactiondetail_qty) Return the first ChildTransactionDetail filtered by the transactiondetail_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByPrice(string $transactiondetail_price) Return the first ChildTransactionDetail filtered by the transactiondetail_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByValue(string $transactiondetail_value) Return the first ChildTransactionDetail filtered by the transactiondetail_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByDiscount(string $transactiondetail_discount) Return the first ChildTransactionDetail filtered by the transactiondetail_discount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByProductId(string $transactiondetail_product) Return the first ChildTransactionDetail filtered by the transactiondetail_product column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransactionDetail requireOneByProductName(string $transactiondetail_productname) Return the first ChildTransactionDetail filtered by the transactiondetail_productname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTransactionDetail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTransactionDetail objects based on current ModelCriteria
 * @method     ChildTransactionDetail[]|ObjectCollection findById(string $transactiondetail_id) Return ChildTransactionDetail objects filtered by the transactiondetail_id column
 * @method     ChildTransactionDetail[]|ObjectCollection findByTransactionId(string $transactiondetail_transaction) Return ChildTransactionDetail objects filtered by the transactiondetail_transaction column
 * @method     ChildTransactionDetail[]|ObjectCollection findByType(string $transactiondetail_type) Return ChildTransactionDetail objects filtered by the transactiondetail_type column
 * @method     ChildTransactionDetail[]|ObjectCollection findByDescription(string $transactiondetail_description) Return ChildTransactionDetail objects filtered by the transactiondetail_description column
 * @method     ChildTransactionDetail[]|ObjectCollection findByQuantity(int $transactiondetail_qty) Return ChildTransactionDetail objects filtered by the transactiondetail_qty column
 * @method     ChildTransactionDetail[]|ObjectCollection findByPrice(string $transactiondetail_price) Return ChildTransactionDetail objects filtered by the transactiondetail_price column
 * @method     ChildTransactionDetail[]|ObjectCollection findByValue(string $transactiondetail_value) Return ChildTransactionDetail objects filtered by the transactiondetail_value column
 * @method     ChildTransactionDetail[]|ObjectCollection findByDiscount(string $transactiondetail_discount) Return ChildTransactionDetail objects filtered by the transactiondetail_discount column
 * @method     ChildTransactionDetail[]|ObjectCollection findByProductId(string $transactiondetail_product) Return ChildTransactionDetail objects filtered by the transactiondetail_product column
 * @method     ChildTransactionDetail[]|ObjectCollection findByProductName(string $transactiondetail_productname) Return ChildTransactionDetail objects filtered by the transactiondetail_productname column
 * @method     ChildTransactionDetail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TransactionDetailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Account\Base\TransactionDetailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Account\\TransactionDetail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTransactionDetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTransactionDetailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTransactionDetailQuery) {
            return $criteria;
        }
        $query = new ChildTransactionDetailQuery();
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
     * @return ChildTransactionDetail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TransactionDetailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TransactionDetailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTransactionDetail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT transactiondetail_id, transactiondetail_transaction, transactiondetail_type, transactiondetail_description, transactiondetail_qty, transactiondetail_price, transactiondetail_value, transactiondetail_discount, transactiondetail_product, transactiondetail_productname FROM t_transactiondetail WHERE transactiondetail_id = :p0';
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
            /** @var ChildTransactionDetail $obj */
            $obj = new ChildTransactionDetail();
            $obj->hydrate($row);
            TransactionDetailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTransactionDetail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the transactiondetail_id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE transactiondetail_id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE transactiondetail_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_transaction column
     *
     * Example usage:
     * <code>
     * $query->filterByTransactionId('fooValue');   // WHERE transactiondetail_transaction = 'fooValue'
     * $query->filterByTransactionId('%fooValue%', Criteria::LIKE); // WHERE transactiondetail_transaction LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transactionId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByTransactionId($transactionId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transactionId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_TRANSACTION, $transactionId, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE transactiondetail_type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE transactiondetail_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE transactiondetail_description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE transactiondetail_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE transactiondetail_qty = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE transactiondetail_qty IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE transactiondetail_qty > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_QTY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_QTY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_QTY, $quantity, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE transactiondetail_price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE transactiondetail_price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE transactiondetail_price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE transactiondetail_value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE transactiondetail_value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE transactiondetail_value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_discount column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscount(1234); // WHERE transactiondetail_discount = 1234
     * $query->filterByDiscount(array(12, 34)); // WHERE transactiondetail_discount IN (12, 34)
     * $query->filterByDiscount(array('min' => 12)); // WHERE transactiondetail_discount > 12
     * </code>
     *
     * @param     mixed $discount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByDiscount($discount = null, $comparison = null)
    {
        if (is_array($discount)) {
            $useMinMax = false;
            if (isset($discount['min'])) {
                $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_DISCOUNT, $discount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discount['max'])) {
                $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_DISCOUNT, $discount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_DISCOUNT, $discount, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_product column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId('fooValue');   // WHERE transactiondetail_product = 'fooValue'
     * $query->filterByProductId('%fooValue%', Criteria::LIKE); // WHERE transactiondetail_product LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_PRODUCT, $productId, $comparison);
    }

    /**
     * Filter the query on the transactiondetail_productname column
     *
     * Example usage:
     * <code>
     * $query->filterByProductName('fooValue');   // WHERE transactiondetail_productname = 'fooValue'
     * $query->filterByProductName('%fooValue%', Criteria::LIKE); // WHERE transactiondetail_productname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByProductName($productName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_PRODUCTNAME, $productName, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Transaction object
     *
     * @param \Propel\Table\Account\Transaction|ObjectCollection $transaction The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByTransaction($transaction, $comparison = null)
    {
        if ($transaction instanceof \Propel\Table\Account\Transaction) {
            return $this
                ->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_TRANSACTION, $transaction->getId(), $comparison);
        } elseif ($transaction instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_TRANSACTION, $transaction->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTransaction() only accepts arguments of type \Propel\Table\Account\Transaction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Transaction relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function joinTransaction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Transaction');

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
            $this->addJoinObject($join, 'Transaction');
        }

        return $this;
    }

    /**
     * Use the Transaction relation Transaction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\TransactionQuery A secondary query class using the current class as primary query
     */
    public function useTransactionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransaction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Transaction', '\Propel\Table\Account\TransactionQuery');
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Product object
     *
     * @param \Propel\Table\Account\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Propel\Table\Account\Product) {
            return $this
                ->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_PRODUCT, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_PRODUCT, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\Propel\Table\Account\ProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTransactionDetail $transactionDetail Object to remove from the list of results
     *
     * @return $this|ChildTransactionDetailQuery The current query, for fluid interface
     */
    public function prune($transactionDetail = null)
    {
        if ($transactionDetail) {
            $this->addUsingAlias(TransactionDetailTableMap::COL_TRANSACTIONDETAIL_ID, $transactionDetail->getId(), Criteria::NOT_EQUAL);
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
        // aggregate_column_relation_behavior_total_value behavior
        $this->findRelatedTransactionTotalValues($con);
        // aggregate_column_relation_behavior_total_qty behavior
        $this->findRelatedTransactionTotalQuantitys($con);

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
        // aggregate_column_relation_behavior_total_value behavior
        $this->updateRelatedTransactionTotalValues($con);
        // aggregate_column_relation_behavior_total_qty behavior
        $this->updateRelatedTransactionTotalQuantitys($con);

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
        // aggregate_column_relation_behavior_total_value behavior
        $this->findRelatedTransactionTotalValues($con);
        // aggregate_column_relation_behavior_total_qty behavior
        $this->findRelatedTransactionTotalQuantitys($con);

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
        // aggregate_column_relation_behavior_total_value behavior
        $this->updateRelatedTransactionTotalValues($con);
        // aggregate_column_relation_behavior_total_qty behavior
        $this->updateRelatedTransactionTotalQuantitys($con);

        return $this->postUpdate($affectedRows, $con);
    }

    /**
     * Deletes all rows from the t_transactiondetail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionDetailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TransactionDetailTableMap::clearInstancePool();
            TransactionDetailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionDetailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TransactionDetailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TransactionDetailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TransactionDetailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // aggregate_column_relation_behavior_total_value behavior

    /**
     * Finds the related Transaction objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedTransactionTotalValues($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->transactionTotalValues = \Propel\Table\Account\TransactionQuery::create()
            ->joinTransactionDetail($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedTransactionTotalValues($con)
    {
        foreach ($this->transactionTotalValues as $transactionTotalValue) {
            $transactionTotalValue->updateTotalValue($con);
        }
        $this->transactionTotalValues = array();
    }

    // aggregate_column_relation_behavior_total_qty behavior

    /**
     * Finds the related Transaction objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedTransactionTotalQuantitys($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->transactionTotalQuantitys = \Propel\Table\Account\TransactionQuery::create()
            ->joinTransactionDetail($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedTransactionTotalQuantitys($con)
    {
        foreach ($this->transactionTotalQuantitys as $transactionTotalQuantity) {
            $transactionTotalQuantity->updateTotalQuantity($con);
        }
        $this->transactionTotalQuantitys = array();
    }

} // TransactionDetailQuery
