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
use Propel\Table\Account\Transaction as ChildTransaction;
use Propel\Table\Account\TransactionQuery as ChildTransactionQuery;
use Propel\Table\Account\Map\TransactionTableMap;

/**
 * Base class that represents a query for the 't_transaction' table.
 *
 *
 *
 * @method     ChildTransactionQuery orderById($order = Criteria::ASC) Order by the transaction_id column
 * @method     ChildTransactionQuery orderByAccountId($order = Criteria::ASC) Order by the transaction_account column
 * @method     ChildTransactionQuery orderByTime($order = Criteria::ASC) Order by the transaction_time column
 * @method     ChildTransactionQuery orderByType($order = Criteria::ASC) Order by the transaction_type column
 * @method     ChildTransactionQuery orderByTotalValue($order = Criteria::ASC) Order by the transaction_totalvalue column
 * @method     ChildTransactionQuery orderByTotalQuantity($order = Criteria::ASC) Order by the transaction_totalqty column
 *
 * @method     ChildTransactionQuery groupById() Group by the transaction_id column
 * @method     ChildTransactionQuery groupByAccountId() Group by the transaction_account column
 * @method     ChildTransactionQuery groupByTime() Group by the transaction_time column
 * @method     ChildTransactionQuery groupByType() Group by the transaction_type column
 * @method     ChildTransactionQuery groupByTotalValue() Group by the transaction_totalvalue column
 * @method     ChildTransactionQuery groupByTotalQuantity() Group by the transaction_totalqty column
 *
 * @method     ChildTransactionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTransactionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTransactionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTransactionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTransactionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTransactionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTransactionQuery leftJoinAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Account relation
 * @method     ChildTransactionQuery rightJoinAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Account relation
 * @method     ChildTransactionQuery innerJoinAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Account relation
 *
 * @method     ChildTransactionQuery joinWithAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Account relation
 *
 * @method     ChildTransactionQuery leftJoinWithAccount() Adds a LEFT JOIN clause and with to the query using the Account relation
 * @method     ChildTransactionQuery rightJoinWithAccount() Adds a RIGHT JOIN clause and with to the query using the Account relation
 * @method     ChildTransactionQuery innerJoinWithAccount() Adds a INNER JOIN clause and with to the query using the Account relation
 *
 * @method     ChildTransactionQuery leftJoinCredit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Credit relation
 * @method     ChildTransactionQuery rightJoinCredit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Credit relation
 * @method     ChildTransactionQuery innerJoinCredit($relationAlias = null) Adds a INNER JOIN clause to the query using the Credit relation
 *
 * @method     ChildTransactionQuery joinWithCredit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Credit relation
 *
 * @method     ChildTransactionQuery leftJoinWithCredit() Adds a LEFT JOIN clause and with to the query using the Credit relation
 * @method     ChildTransactionQuery rightJoinWithCredit() Adds a RIGHT JOIN clause and with to the query using the Credit relation
 * @method     ChildTransactionQuery innerJoinWithCredit() Adds a INNER JOIN clause and with to the query using the Credit relation
 *
 * @method     ChildTransactionQuery leftJoinDebit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Debit relation
 * @method     ChildTransactionQuery rightJoinDebit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Debit relation
 * @method     ChildTransactionQuery innerJoinDebit($relationAlias = null) Adds a INNER JOIN clause to the query using the Debit relation
 *
 * @method     ChildTransactionQuery joinWithDebit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Debit relation
 *
 * @method     ChildTransactionQuery leftJoinWithDebit() Adds a LEFT JOIN clause and with to the query using the Debit relation
 * @method     ChildTransactionQuery rightJoinWithDebit() Adds a RIGHT JOIN clause and with to the query using the Debit relation
 * @method     ChildTransactionQuery innerJoinWithDebit() Adds a INNER JOIN clause and with to the query using the Debit relation
 *
 * @method     ChildTransactionQuery leftJoinTransactionDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransactionDetail relation
 * @method     ChildTransactionQuery rightJoinTransactionDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransactionDetail relation
 * @method     ChildTransactionQuery innerJoinTransactionDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the TransactionDetail relation
 *
 * @method     ChildTransactionQuery joinWithTransactionDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransactionDetail relation
 *
 * @method     ChildTransactionQuery leftJoinWithTransactionDetail() Adds a LEFT JOIN clause and with to the query using the TransactionDetail relation
 * @method     ChildTransactionQuery rightJoinWithTransactionDetail() Adds a RIGHT JOIN clause and with to the query using the TransactionDetail relation
 * @method     ChildTransactionQuery innerJoinWithTransactionDetail() Adds a INNER JOIN clause and with to the query using the TransactionDetail relation
 *
 * @method     \Propel\Table\Account\AccountQuery|\Propel\Table\Account\CreditQuery|\Propel\Table\Account\DebitQuery|\Propel\Table\Account\TransactionDetailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTransaction findOne(ConnectionInterface $con = null) Return the first ChildTransaction matching the query
 * @method     ChildTransaction findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTransaction matching the query, or a new ChildTransaction object populated from the query conditions when no match is found
 *
 * @method     ChildTransaction findOneById(string $transaction_id) Return the first ChildTransaction filtered by the transaction_id column
 * @method     ChildTransaction findOneByAccountId(string $transaction_account) Return the first ChildTransaction filtered by the transaction_account column
 * @method     ChildTransaction findOneByTime(string $transaction_time) Return the first ChildTransaction filtered by the transaction_time column
 * @method     ChildTransaction findOneByType(string $transaction_type) Return the first ChildTransaction filtered by the transaction_type column
 * @method     ChildTransaction findOneByTotalValue(int $transaction_totalvalue) Return the first ChildTransaction filtered by the transaction_totalvalue column
 * @method     ChildTransaction findOneByTotalQuantity(int $transaction_totalqty) Return the first ChildTransaction filtered by the transaction_totalqty column *

 * @method     ChildTransaction requirePk($key, ConnectionInterface $con = null) Return the ChildTransaction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOne(ConnectionInterface $con = null) Return the first ChildTransaction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTransaction requireOneById(string $transaction_id) Return the first ChildTransaction filtered by the transaction_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByAccountId(string $transaction_account) Return the first ChildTransaction filtered by the transaction_account column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByTime(string $transaction_time) Return the first ChildTransaction filtered by the transaction_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByType(string $transaction_type) Return the first ChildTransaction filtered by the transaction_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByTotalValue(int $transaction_totalvalue) Return the first ChildTransaction filtered by the transaction_totalvalue column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByTotalQuantity(int $transaction_totalqty) Return the first ChildTransaction filtered by the transaction_totalqty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTransaction[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTransaction objects based on current ModelCriteria
 * @method     ChildTransaction[]|ObjectCollection findById(string $transaction_id) Return ChildTransaction objects filtered by the transaction_id column
 * @method     ChildTransaction[]|ObjectCollection findByAccountId(string $transaction_account) Return ChildTransaction objects filtered by the transaction_account column
 * @method     ChildTransaction[]|ObjectCollection findByTime(string $transaction_time) Return ChildTransaction objects filtered by the transaction_time column
 * @method     ChildTransaction[]|ObjectCollection findByType(string $transaction_type) Return ChildTransaction objects filtered by the transaction_type column
 * @method     ChildTransaction[]|ObjectCollection findByTotalValue(int $transaction_totalvalue) Return ChildTransaction objects filtered by the transaction_totalvalue column
 * @method     ChildTransaction[]|ObjectCollection findByTotalQuantity(int $transaction_totalqty) Return ChildTransaction objects filtered by the transaction_totalqty column
 * @method     ChildTransaction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TransactionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Account\Base\TransactionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Account\\Transaction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTransactionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTransactionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTransactionQuery) {
            return $criteria;
        }
        $query = new ChildTransactionQuery();
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
     * @return ChildTransaction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TransactionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TransactionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTransaction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT transaction_id, transaction_account, transaction_time, transaction_type, transaction_totalvalue, transaction_totalqty FROM t_transaction WHERE transaction_id = :p0';
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
            /** @var ChildTransaction $obj */
            $obj = new ChildTransaction();
            $obj->hydrate($row);
            TransactionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTransaction|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the transaction_id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE transaction_id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE transaction_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ID, $id, $comparison);
    }

    /**
     * Filter the query on the transaction_account column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountId('fooValue');   // WHERE transaction_account = 'fooValue'
     * $query->filterByAccountId('%fooValue%', Criteria::LIKE); // WHERE transaction_account LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accountId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByAccountId($accountId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ACCOUNT, $accountId, $comparison);
    }

    /**
     * Filter the query on the transaction_time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime('2011-03-14'); // WHERE transaction_time = '2011-03-14'
     * $query->filterByTime('now'); // WHERE transaction_time = '2011-03-14'
     * $query->filterByTime(array('max' => 'yesterday')); // WHERE transaction_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $time The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (is_array($time)) {
            $useMinMax = false;
            if (isset($time['min'])) {
                $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TIME, $time['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($time['max'])) {
                $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TIME, $time['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TIME, $time, $comparison);
    }

    /**
     * Filter the query on the transaction_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE transaction_type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE transaction_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the transaction_totalvalue column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalValue(1234); // WHERE transaction_totalvalue = 1234
     * $query->filterByTotalValue(array(12, 34)); // WHERE transaction_totalvalue IN (12, 34)
     * $query->filterByTotalValue(array('min' => 12)); // WHERE transaction_totalvalue > 12
     * </code>
     *
     * @param     mixed $totalValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByTotalValue($totalValue = null, $comparison = null)
    {
        if (is_array($totalValue)) {
            $useMinMax = false;
            if (isset($totalValue['min'])) {
                $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TOTALVALUE, $totalValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalValue['max'])) {
                $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TOTALVALUE, $totalValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TOTALVALUE, $totalValue, $comparison);
    }

    /**
     * Filter the query on the transaction_totalqty column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalQuantity(1234); // WHERE transaction_totalqty = 1234
     * $query->filterByTotalQuantity(array(12, 34)); // WHERE transaction_totalqty IN (12, 34)
     * $query->filterByTotalQuantity(array('min' => 12)); // WHERE transaction_totalqty > 12
     * </code>
     *
     * @param     mixed $totalQuantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByTotalQuantity($totalQuantity = null, $comparison = null)
    {
        if (is_array($totalQuantity)) {
            $useMinMax = false;
            if (isset($totalQuantity['min'])) {
                $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TOTALQTY, $totalQuantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalQuantity['max'])) {
                $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TOTALQTY, $totalQuantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_TOTALQTY, $totalQuantity, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Account object
     *
     * @param \Propel\Table\Account\Account|ObjectCollection $account The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByAccount($account, $comparison = null)
    {
        if ($account instanceof \Propel\Table\Account\Account) {
            return $this
                ->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ACCOUNT, $account->getId(), $comparison);
        } elseif ($account instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ACCOUNT, $account->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildTransactionQuery The current query, for fluid interface
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
     * Filter the query by a related \Propel\Table\Account\Credit object
     *
     * @param \Propel\Table\Account\Credit|ObjectCollection $credit the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByCredit($credit, $comparison = null)
    {
        if ($credit instanceof \Propel\Table\Account\Credit) {
            return $this
                ->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ID, $credit->getTransactionId(), $comparison);
        } elseif ($credit instanceof ObjectCollection) {
            return $this
                ->useCreditQuery()
                ->filterByPrimaryKeys($credit->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCredit() only accepts arguments of type \Propel\Table\Account\Credit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Credit relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function joinCredit($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Credit');

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
            $this->addJoinObject($join, 'Credit');
        }

        return $this;
    }

    /**
     * Use the Credit relation Credit object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\CreditQuery A secondary query class using the current class as primary query
     */
    public function useCreditQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCredit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Credit', '\Propel\Table\Account\CreditQuery');
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Debit object
     *
     * @param \Propel\Table\Account\Debit|ObjectCollection $debit the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByDebit($debit, $comparison = null)
    {
        if ($debit instanceof \Propel\Table\Account\Debit) {
            return $this
                ->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ID, $debit->getTransactionId(), $comparison);
        } elseif ($debit instanceof ObjectCollection) {
            return $this
                ->useDebitQuery()
                ->filterByPrimaryKeys($debit->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDebit() only accepts arguments of type \Propel\Table\Account\Debit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Debit relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function joinDebit($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Debit');

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
            $this->addJoinObject($join, 'Debit');
        }

        return $this;
    }

    /**
     * Use the Debit relation Debit object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Table\Account\DebitQuery A secondary query class using the current class as primary query
     */
    public function useDebitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDebit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Debit', '\Propel\Table\Account\DebitQuery');
    }

    /**
     * Filter the query by a related \Propel\Table\Account\TransactionDetail object
     *
     * @param \Propel\Table\Account\TransactionDetail|ObjectCollection $transactionDetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByTransactionDetail($transactionDetail, $comparison = null)
    {
        if ($transactionDetail instanceof \Propel\Table\Account\TransactionDetail) {
            return $this
                ->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ID, $transactionDetail->getTransactionId(), $comparison);
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
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function joinTransactionDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useTransactionDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransactionDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TransactionDetail', '\Propel\Table\Account\TransactionDetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTransaction $transaction Object to remove from the list of results
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function prune($transaction = null)
    {
        if ($transaction) {
            $this->addUsingAlias(TransactionTableMap::COL_TRANSACTION_ID, $transaction->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the t_transaction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TransactionTableMap::clearInstancePool();
            TransactionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TransactionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TransactionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TransactionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TransactionQuery
