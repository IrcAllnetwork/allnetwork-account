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
use Propel\Table\Account\Credit as ChildCredit;
use Propel\Table\Account\CreditQuery as ChildCreditQuery;
use Propel\Table\Account\Map\CreditTableMap;

/**
 * Base class that represents a query for the 't_credit' table.
 *
 *
 *
 * @method     ChildCreditQuery orderById($order = Criteria::ASC) Order by the credit_id column
 * @method     ChildCreditQuery orderByAccountId($order = Criteria::ASC) Order by the credit_account column
 * @method     ChildCreditQuery orderByValue($order = Criteria::ASC) Order by the credit_value column
 * @method     ChildCreditQuery orderByTime($order = Criteria::ASC) Order by the credit_time column
 * @method     ChildCreditQuery orderByTransactionId($order = Criteria::ASC) Order by the credit_transaction column
 *
 * @method     ChildCreditQuery groupById() Group by the credit_id column
 * @method     ChildCreditQuery groupByAccountId() Group by the credit_account column
 * @method     ChildCreditQuery groupByValue() Group by the credit_value column
 * @method     ChildCreditQuery groupByTime() Group by the credit_time column
 * @method     ChildCreditQuery groupByTransactionId() Group by the credit_transaction column
 *
 * @method     ChildCreditQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCreditQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCreditQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCreditQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCreditQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCreditQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCreditQuery leftJoinAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Account relation
 * @method     ChildCreditQuery rightJoinAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Account relation
 * @method     ChildCreditQuery innerJoinAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Account relation
 *
 * @method     ChildCreditQuery joinWithAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Account relation
 *
 * @method     ChildCreditQuery leftJoinWithAccount() Adds a LEFT JOIN clause and with to the query using the Account relation
 * @method     ChildCreditQuery rightJoinWithAccount() Adds a RIGHT JOIN clause and with to the query using the Account relation
 * @method     ChildCreditQuery innerJoinWithAccount() Adds a INNER JOIN clause and with to the query using the Account relation
 *
 * @method     ChildCreditQuery leftJoinTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Transaction relation
 * @method     ChildCreditQuery rightJoinTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Transaction relation
 * @method     ChildCreditQuery innerJoinTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the Transaction relation
 *
 * @method     ChildCreditQuery joinWithTransaction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Transaction relation
 *
 * @method     ChildCreditQuery leftJoinWithTransaction() Adds a LEFT JOIN clause and with to the query using the Transaction relation
 * @method     ChildCreditQuery rightJoinWithTransaction() Adds a RIGHT JOIN clause and with to the query using the Transaction relation
 * @method     ChildCreditQuery innerJoinWithTransaction() Adds a INNER JOIN clause and with to the query using the Transaction relation
 *
 * @method     \Propel\Table\Account\AccountQuery|\Propel\Table\Account\TransactionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCredit findOne(ConnectionInterface $con = null) Return the first ChildCredit matching the query
 * @method     ChildCredit findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCredit matching the query, or a new ChildCredit object populated from the query conditions when no match is found
 *
 * @method     ChildCredit findOneById(string $credit_id) Return the first ChildCredit filtered by the credit_id column
 * @method     ChildCredit findOneByAccountId(string $credit_account) Return the first ChildCredit filtered by the credit_account column
 * @method     ChildCredit findOneByValue(string $credit_value) Return the first ChildCredit filtered by the credit_value column
 * @method     ChildCredit findOneByTime(string $credit_time) Return the first ChildCredit filtered by the credit_time column
 * @method     ChildCredit findOneByTransactionId(string $credit_transaction) Return the first ChildCredit filtered by the credit_transaction column *

 * @method     ChildCredit requirePk($key, ConnectionInterface $con = null) Return the ChildCredit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCredit requireOne(ConnectionInterface $con = null) Return the first ChildCredit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCredit requireOneById(string $credit_id) Return the first ChildCredit filtered by the credit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCredit requireOneByAccountId(string $credit_account) Return the first ChildCredit filtered by the credit_account column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCredit requireOneByValue(string $credit_value) Return the first ChildCredit filtered by the credit_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCredit requireOneByTime(string $credit_time) Return the first ChildCredit filtered by the credit_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCredit requireOneByTransactionId(string $credit_transaction) Return the first ChildCredit filtered by the credit_transaction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCredit[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCredit objects based on current ModelCriteria
 * @method     ChildCredit[]|ObjectCollection findById(string $credit_id) Return ChildCredit objects filtered by the credit_id column
 * @method     ChildCredit[]|ObjectCollection findByAccountId(string $credit_account) Return ChildCredit objects filtered by the credit_account column
 * @method     ChildCredit[]|ObjectCollection findByValue(string $credit_value) Return ChildCredit objects filtered by the credit_value column
 * @method     ChildCredit[]|ObjectCollection findByTime(string $credit_time) Return ChildCredit objects filtered by the credit_time column
 * @method     ChildCredit[]|ObjectCollection findByTransactionId(string $credit_transaction) Return ChildCredit objects filtered by the credit_transaction column
 * @method     ChildCredit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CreditQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Account\Base\CreditQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Account\\Credit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCreditQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCreditQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCreditQuery) {
            return $criteria;
        }
        $query = new ChildCreditQuery();
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
     * @return ChildCredit|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CreditTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CreditTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCredit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT credit_id, credit_account, credit_value, credit_time, credit_transaction FROM t_credit WHERE credit_id = :p0';
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
            /** @var ChildCredit $obj */
            $obj = new ChildCredit();
            $obj->hydrate($row);
            CreditTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCredit|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCreditQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CreditTableMap::COL_CREDIT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCreditQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CreditTableMap::COL_CREDIT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the credit_id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE credit_id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE credit_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditTableMap::COL_CREDIT_ID, $id, $comparison);
    }

    /**
     * Filter the query on the credit_account column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountId('fooValue');   // WHERE credit_account = 'fooValue'
     * $query->filterByAccountId('%fooValue%', Criteria::LIKE); // WHERE credit_account LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accountId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditQuery The current query, for fluid interface
     */
    public function filterByAccountId($accountId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditTableMap::COL_CREDIT_ACCOUNT, $accountId, $comparison);
    }

    /**
     * Filter the query on the credit_value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE credit_value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE credit_value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE credit_value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(CreditTableMap::COL_CREDIT_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(CreditTableMap::COL_CREDIT_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditTableMap::COL_CREDIT_VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the credit_time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime('2011-03-14'); // WHERE credit_time = '2011-03-14'
     * $query->filterByTime('now'); // WHERE credit_time = '2011-03-14'
     * $query->filterByTime(array('max' => 'yesterday')); // WHERE credit_time > '2011-03-13'
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
     * @return $this|ChildCreditQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (is_array($time)) {
            $useMinMax = false;
            if (isset($time['min'])) {
                $this->addUsingAlias(CreditTableMap::COL_CREDIT_TIME, $time['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($time['max'])) {
                $this->addUsingAlias(CreditTableMap::COL_CREDIT_TIME, $time['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditTableMap::COL_CREDIT_TIME, $time, $comparison);
    }

    /**
     * Filter the query on the credit_transaction column
     *
     * Example usage:
     * <code>
     * $query->filterByTransactionId('fooValue');   // WHERE credit_transaction = 'fooValue'
     * $query->filterByTransactionId('%fooValue%', Criteria::LIKE); // WHERE credit_transaction LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transactionId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCreditQuery The current query, for fluid interface
     */
    public function filterByTransactionId($transactionId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transactionId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CreditTableMap::COL_CREDIT_TRANSACTION, $transactionId, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Account object
     *
     * @param \Propel\Table\Account\Account|ObjectCollection $account The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCreditQuery The current query, for fluid interface
     */
    public function filterByAccount($account, $comparison = null)
    {
        if ($account instanceof \Propel\Table\Account\Account) {
            return $this
                ->addUsingAlias(CreditTableMap::COL_CREDIT_ACCOUNT, $account->getId(), $comparison);
        } elseif ($account instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditTableMap::COL_CREDIT_ACCOUNT, $account->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCreditQuery The current query, for fluid interface
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
     * Filter the query by a related \Propel\Table\Account\Transaction object
     *
     * @param \Propel\Table\Account\Transaction|ObjectCollection $transaction The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCreditQuery The current query, for fluid interface
     */
    public function filterByTransaction($transaction, $comparison = null)
    {
        if ($transaction instanceof \Propel\Table\Account\Transaction) {
            return $this
                ->addUsingAlias(CreditTableMap::COL_CREDIT_TRANSACTION, $transaction->getId(), $comparison);
        } elseif ($transaction instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CreditTableMap::COL_CREDIT_TRANSACTION, $transaction->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCreditQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildCredit $credit Object to remove from the list of results
     *
     * @return $this|ChildCreditQuery The current query, for fluid interface
     */
    public function prune($credit = null)
    {
        if ($credit) {
            $this->addUsingAlias(CreditTableMap::COL_CREDIT_ID, $credit->getId(), Criteria::NOT_EQUAL);
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
        // aggregate_column_relation_behavior_account_credit behavior
        $this->findRelatedAccountTotalCredits($con);

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
        // aggregate_column_relation_behavior_account_credit behavior
        $this->updateRelatedAccountTotalCredits($con);

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
        // aggregate_column_relation_behavior_account_credit behavior
        $this->findRelatedAccountTotalCredits($con);

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
        // aggregate_column_relation_behavior_account_credit behavior
        $this->updateRelatedAccountTotalCredits($con);

        return $this->postUpdate($affectedRows, $con);
    }

    /**
     * Deletes all rows from the t_credit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CreditTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CreditTableMap::clearInstancePool();
            CreditTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CreditTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CreditTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CreditTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CreditTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // aggregate_column_relation_behavior_account_credit behavior

    /**
     * Finds the related Account objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedAccountTotalCredits($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->accountTotalCredits = \Propel\Table\Account\AccountQuery::create()
            ->joinCredit($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedAccountTotalCredits($con)
    {
        foreach ($this->accountTotalCredits as $accountTotalCredit) {
            $accountTotalCredit->updateTotalCredit($con);
        }
        $this->accountTotalCredits = array();
    }

} // CreditQuery
