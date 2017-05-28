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
use Propel\Table\Account\Account as ChildAccount;
use Propel\Table\Account\AccountQuery as ChildAccountQuery;
use Propel\Table\Account\Map\AccountTableMap;

/**
 * Base class that represents a query for the 't_account' table.
 *
 *
 *
 * @method     ChildAccountQuery orderById($order = Criteria::ASC) Order by the account_id column
 * @method     ChildAccountQuery orderByUserName($order = Criteria::ASC) Order by the account_username column
 * @method     ChildAccountQuery orderByFirstName($order = Criteria::ASC) Order by the account_firstname column
 * @method     ChildAccountQuery orderByLastName($order = Criteria::ASC) Order by the account_lastname column
 * @method     ChildAccountQuery orderByPassword($order = Criteria::ASC) Order by the account_password column
 * @method     ChildAccountQuery orderByStatus($order = Criteria::ASC) Order by the account_status column
 * @method     ChildAccountQuery orderByEmail($order = Criteria::ASC) Order by the account_email column
 * @method     ChildAccountQuery orderByRegisterDate($order = Criteria::ASC) Order by the account_registerdate column
 * @method     ChildAccountQuery orderByExpired($order = Criteria::ASC) Order by the account_expired column
 * @method     ChildAccountQuery orderByAvatar($order = Criteria::ASC) Order by the account_avatar column
 * @method     ChildAccountQuery orderByToken($order = Criteria::ASC) Order by the account_token column
 * @method     ChildAccountQuery orderByIPAddress($order = Criteria::ASC) Order by the account_ipaddress column
 * @method     ChildAccountQuery orderByType($order = Criteria::ASC) Order by the account_type column
 * @method     ChildAccountQuery orderByTotalCredit($order = Criteria::ASC) Order by the account_credit column
 * @method     ChildAccountQuery orderByTotalDebit($order = Criteria::ASC) Order by the account_debit column
 * @method     ChildAccountQuery orderByKey($order = Criteria::ASC) Order by the account_key column
 * @method     ChildAccountQuery orderByDeveloper($order = Criteria::ASC) Order by the account_dev column
 *
 * @method     ChildAccountQuery groupById() Group by the account_id column
 * @method     ChildAccountQuery groupByUserName() Group by the account_username column
 * @method     ChildAccountQuery groupByFirstName() Group by the account_firstname column
 * @method     ChildAccountQuery groupByLastName() Group by the account_lastname column
 * @method     ChildAccountQuery groupByPassword() Group by the account_password column
 * @method     ChildAccountQuery groupByStatus() Group by the account_status column
 * @method     ChildAccountQuery groupByEmail() Group by the account_email column
 * @method     ChildAccountQuery groupByRegisterDate() Group by the account_registerdate column
 * @method     ChildAccountQuery groupByExpired() Group by the account_expired column
 * @method     ChildAccountQuery groupByAvatar() Group by the account_avatar column
 * @method     ChildAccountQuery groupByToken() Group by the account_token column
 * @method     ChildAccountQuery groupByIPAddress() Group by the account_ipaddress column
 * @method     ChildAccountQuery groupByType() Group by the account_type column
 * @method     ChildAccountQuery groupByTotalCredit() Group by the account_credit column
 * @method     ChildAccountQuery groupByTotalDebit() Group by the account_debit column
 * @method     ChildAccountQuery groupByKey() Group by the account_key column
 * @method     ChildAccountQuery groupByDeveloper() Group by the account_dev column
 *
 * @method     ChildAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAccountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAccountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAccountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAccountQuery leftJoinCredit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Credit relation
 * @method     ChildAccountQuery rightJoinCredit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Credit relation
 * @method     ChildAccountQuery innerJoinCredit($relationAlias = null) Adds a INNER JOIN clause to the query using the Credit relation
 *
 * @method     ChildAccountQuery joinWithCredit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Credit relation
 *
 * @method     ChildAccountQuery leftJoinWithCredit() Adds a LEFT JOIN clause and with to the query using the Credit relation
 * @method     ChildAccountQuery rightJoinWithCredit() Adds a RIGHT JOIN clause and with to the query using the Credit relation
 * @method     ChildAccountQuery innerJoinWithCredit() Adds a INNER JOIN clause and with to the query using the Credit relation
 *
 * @method     ChildAccountQuery leftJoinDebit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Debit relation
 * @method     ChildAccountQuery rightJoinDebit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Debit relation
 * @method     ChildAccountQuery innerJoinDebit($relationAlias = null) Adds a INNER JOIN clause to the query using the Debit relation
 *
 * @method     ChildAccountQuery joinWithDebit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Debit relation
 *
 * @method     ChildAccountQuery leftJoinWithDebit() Adds a LEFT JOIN clause and with to the query using the Debit relation
 * @method     ChildAccountQuery rightJoinWithDebit() Adds a RIGHT JOIN clause and with to the query using the Debit relation
 * @method     ChildAccountQuery innerJoinWithDebit() Adds a INNER JOIN clause and with to the query using the Debit relation
 *
 * @method     ChildAccountQuery leftJoinTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Transaction relation
 * @method     ChildAccountQuery rightJoinTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Transaction relation
 * @method     ChildAccountQuery innerJoinTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the Transaction relation
 *
 * @method     ChildAccountQuery joinWithTransaction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Transaction relation
 *
 * @method     ChildAccountQuery leftJoinWithTransaction() Adds a LEFT JOIN clause and with to the query using the Transaction relation
 * @method     ChildAccountQuery rightJoinWithTransaction() Adds a RIGHT JOIN clause and with to the query using the Transaction relation
 * @method     ChildAccountQuery innerJoinWithTransaction() Adds a INNER JOIN clause and with to the query using the Transaction relation
 *
 * @method     ChildAccountQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildAccountQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildAccountQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildAccountQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildAccountQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildAccountQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildAccountQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildAccountQuery leftJoinProductReview($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductReview relation
 * @method     ChildAccountQuery rightJoinProductReview($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductReview relation
 * @method     ChildAccountQuery innerJoinProductReview($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductReview relation
 *
 * @method     ChildAccountQuery joinWithProductReview($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductReview relation
 *
 * @method     ChildAccountQuery leftJoinWithProductReview() Adds a LEFT JOIN clause and with to the query using the ProductReview relation
 * @method     ChildAccountQuery rightJoinWithProductReview() Adds a RIGHT JOIN clause and with to the query using the ProductReview relation
 * @method     ChildAccountQuery innerJoinWithProductReview() Adds a INNER JOIN clause and with to the query using the ProductReview relation
 *
 * @method     \Propel\Table\Account\CreditQuery|\Propel\Table\Account\DebitQuery|\Propel\Table\Account\TransactionQuery|\Propel\Table\Account\ProductQuery|\Propel\Table\Account\ProductReviewQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAccount findOne(ConnectionInterface $con = null) Return the first ChildAccount matching the query
 * @method     ChildAccount findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAccount matching the query, or a new ChildAccount object populated from the query conditions when no match is found
 *
 * @method     ChildAccount findOneById(string $account_id) Return the first ChildAccount filtered by the account_id column
 * @method     ChildAccount findOneByUserName(string $account_username) Return the first ChildAccount filtered by the account_username column
 * @method     ChildAccount findOneByFirstName(string $account_firstname) Return the first ChildAccount filtered by the account_firstname column
 * @method     ChildAccount findOneByLastName(string $account_lastname) Return the first ChildAccount filtered by the account_lastname column
 * @method     ChildAccount findOneByPassword(string $account_password) Return the first ChildAccount filtered by the account_password column
 * @method     ChildAccount findOneByStatus(string $account_status) Return the first ChildAccount filtered by the account_status column
 * @method     ChildAccount findOneByEmail(string $account_email) Return the first ChildAccount filtered by the account_email column
 * @method     ChildAccount findOneByRegisterDate(string $account_registerdate) Return the first ChildAccount filtered by the account_registerdate column
 * @method     ChildAccount findOneByExpired(string $account_expired) Return the first ChildAccount filtered by the account_expired column
 * @method     ChildAccount findOneByAvatar(string $account_avatar) Return the first ChildAccount filtered by the account_avatar column
 * @method     ChildAccount findOneByToken(string $account_token) Return the first ChildAccount filtered by the account_token column
 * @method     ChildAccount findOneByIPAddress(string $account_ipaddress) Return the first ChildAccount filtered by the account_ipaddress column
 * @method     ChildAccount findOneByType(string $account_type) Return the first ChildAccount filtered by the account_type column
 * @method     ChildAccount findOneByTotalCredit(string $account_credit) Return the first ChildAccount filtered by the account_credit column
 * @method     ChildAccount findOneByTotalDebit(string $account_debit) Return the first ChildAccount filtered by the account_debit column
 * @method     ChildAccount findOneByKey(string $account_key) Return the first ChildAccount filtered by the account_key column
 * @method     ChildAccount findOneByDeveloper(string $account_dev) Return the first ChildAccount filtered by the account_dev column *

 * @method     ChildAccount requirePk($key, ConnectionInterface $con = null) Return the ChildAccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOne(ConnectionInterface $con = null) Return the first ChildAccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccount requireOneById(string $account_id) Return the first ChildAccount filtered by the account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByUserName(string $account_username) Return the first ChildAccount filtered by the account_username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByFirstName(string $account_firstname) Return the first ChildAccount filtered by the account_firstname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByLastName(string $account_lastname) Return the first ChildAccount filtered by the account_lastname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByPassword(string $account_password) Return the first ChildAccount filtered by the account_password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByStatus(string $account_status) Return the first ChildAccount filtered by the account_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByEmail(string $account_email) Return the first ChildAccount filtered by the account_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByRegisterDate(string $account_registerdate) Return the first ChildAccount filtered by the account_registerdate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByExpired(string $account_expired) Return the first ChildAccount filtered by the account_expired column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByAvatar(string $account_avatar) Return the first ChildAccount filtered by the account_avatar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByToken(string $account_token) Return the first ChildAccount filtered by the account_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByIPAddress(string $account_ipaddress) Return the first ChildAccount filtered by the account_ipaddress column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByType(string $account_type) Return the first ChildAccount filtered by the account_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByTotalCredit(string $account_credit) Return the first ChildAccount filtered by the account_credit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByTotalDebit(string $account_debit) Return the first ChildAccount filtered by the account_debit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByKey(string $account_key) Return the first ChildAccount filtered by the account_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByDeveloper(string $account_dev) Return the first ChildAccount filtered by the account_dev column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccount[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAccount objects based on current ModelCriteria
 * @method     ChildAccount[]|ObjectCollection findById(string $account_id) Return ChildAccount objects filtered by the account_id column
 * @method     ChildAccount[]|ObjectCollection findByUserName(string $account_username) Return ChildAccount objects filtered by the account_username column
 * @method     ChildAccount[]|ObjectCollection findByFirstName(string $account_firstname) Return ChildAccount objects filtered by the account_firstname column
 * @method     ChildAccount[]|ObjectCollection findByLastName(string $account_lastname) Return ChildAccount objects filtered by the account_lastname column
 * @method     ChildAccount[]|ObjectCollection findByPassword(string $account_password) Return ChildAccount objects filtered by the account_password column
 * @method     ChildAccount[]|ObjectCollection findByStatus(string $account_status) Return ChildAccount objects filtered by the account_status column
 * @method     ChildAccount[]|ObjectCollection findByEmail(string $account_email) Return ChildAccount objects filtered by the account_email column
 * @method     ChildAccount[]|ObjectCollection findByRegisterDate(string $account_registerdate) Return ChildAccount objects filtered by the account_registerdate column
 * @method     ChildAccount[]|ObjectCollection findByExpired(string $account_expired) Return ChildAccount objects filtered by the account_expired column
 * @method     ChildAccount[]|ObjectCollection findByAvatar(string $account_avatar) Return ChildAccount objects filtered by the account_avatar column
 * @method     ChildAccount[]|ObjectCollection findByToken(string $account_token) Return ChildAccount objects filtered by the account_token column
 * @method     ChildAccount[]|ObjectCollection findByIPAddress(string $account_ipaddress) Return ChildAccount objects filtered by the account_ipaddress column
 * @method     ChildAccount[]|ObjectCollection findByType(string $account_type) Return ChildAccount objects filtered by the account_type column
 * @method     ChildAccount[]|ObjectCollection findByTotalCredit(string $account_credit) Return ChildAccount objects filtered by the account_credit column
 * @method     ChildAccount[]|ObjectCollection findByTotalDebit(string $account_debit) Return ChildAccount objects filtered by the account_debit column
 * @method     ChildAccount[]|ObjectCollection findByKey(string $account_key) Return ChildAccount objects filtered by the account_key column
 * @method     ChildAccount[]|ObjectCollection findByDeveloper(string $account_dev) Return ChildAccount objects filtered by the account_dev column
 * @method     ChildAccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AccountQuery extends ModelCriteria
{

    // query_cache behavior
    protected $queryKey = '';
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Table\Account\Base\AccountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Table\\Account\\Account', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAccountQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAccountQuery) {
            return $criteria;
        }
        $query = new ChildAccountQuery();
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
     * @return ChildAccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AccountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AccountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT account_id, account_username, account_firstname, account_lastname, account_password, account_status, account_email, account_registerdate, account_expired, account_avatar, account_token, account_ipaddress, account_type, account_credit, account_debit, account_key, account_dev FROM t_account WHERE account_id = :p0';
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
            /** @var ChildAccount $obj */
            $obj = new ChildAccount();
            $obj->hydrate($row);
            AccountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAccount|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the account_id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE account_id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE account_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $id, $comparison);
    }

    /**
     * Filter the query on the account_username column
     *
     * Example usage:
     * <code>
     * $query->filterByUserName('fooValue');   // WHERE account_username = 'fooValue'
     * $query->filterByUserName('%fooValue%', Criteria::LIKE); // WHERE account_username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByUserName($userName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_USERNAME, $userName, $comparison);
    }

    /**
     * Filter the query on the account_firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE account_firstname = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE account_firstname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_FIRSTNAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the account_lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE account_lastname = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE account_lastname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_LASTNAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the account_password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE account_password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE account_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the account_status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE account_status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE account_status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the account_email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE account_email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE account_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the account_registerdate column
     *
     * Example usage:
     * <code>
     * $query->filterByRegisterDate('2011-03-14'); // WHERE account_registerdate = '2011-03-14'
     * $query->filterByRegisterDate('now'); // WHERE account_registerdate = '2011-03-14'
     * $query->filterByRegisterDate(array('max' => 'yesterday')); // WHERE account_registerdate > '2011-03-13'
     * </code>
     *
     * @param     mixed $registerDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByRegisterDate($registerDate = null, $comparison = null)
    {
        if (is_array($registerDate)) {
            $useMinMax = false;
            if (isset($registerDate['min'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_REGISTERDATE, $registerDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registerDate['max'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_REGISTERDATE, $registerDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_REGISTERDATE, $registerDate, $comparison);
    }

    /**
     * Filter the query on the account_expired column
     *
     * Example usage:
     * <code>
     * $query->filterByExpired('2011-03-14'); // WHERE account_expired = '2011-03-14'
     * $query->filterByExpired('now'); // WHERE account_expired = '2011-03-14'
     * $query->filterByExpired(array('max' => 'yesterday')); // WHERE account_expired > '2011-03-13'
     * </code>
     *
     * @param     mixed $expired The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByExpired($expired = null, $comparison = null)
    {
        if (is_array($expired)) {
            $useMinMax = false;
            if (isset($expired['min'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_EXPIRED, $expired['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expired['max'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_EXPIRED, $expired['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_EXPIRED, $expired, $comparison);
    }

    /**
     * Filter the query on the account_avatar column
     *
     * Example usage:
     * <code>
     * $query->filterByAvatar('fooValue');   // WHERE account_avatar = 'fooValue'
     * $query->filterByAvatar('%fooValue%', Criteria::LIKE); // WHERE account_avatar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avatar The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_AVATAR, $avatar, $comparison);
    }

    /**
     * Filter the query on the account_token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE account_token = 'fooValue'
     * $query->filterByToken('%fooValue%', Criteria::LIKE); // WHERE account_token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $token The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByToken($token = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_TOKEN, $token, $comparison);
    }

    /**
     * Filter the query on the account_ipaddress column
     *
     * Example usage:
     * <code>
     * $query->filterByIPAddress('fooValue');   // WHERE account_ipaddress = 'fooValue'
     * $query->filterByIPAddress('%fooValue%', Criteria::LIKE); // WHERE account_ipaddress LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iPAddress The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByIPAddress($iPAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iPAddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_IPADDRESS, $iPAddress, $comparison);
    }

    /**
     * Filter the query on the account_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE account_type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE account_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the account_credit column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalCredit(1234); // WHERE account_credit = 1234
     * $query->filterByTotalCredit(array(12, 34)); // WHERE account_credit IN (12, 34)
     * $query->filterByTotalCredit(array('min' => 12)); // WHERE account_credit > 12
     * </code>
     *
     * @param     mixed $totalCredit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByTotalCredit($totalCredit = null, $comparison = null)
    {
        if (is_array($totalCredit)) {
            $useMinMax = false;
            if (isset($totalCredit['min'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_CREDIT, $totalCredit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalCredit['max'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_CREDIT, $totalCredit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_CREDIT, $totalCredit, $comparison);
    }

    /**
     * Filter the query on the account_debit column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalDebit(1234); // WHERE account_debit = 1234
     * $query->filterByTotalDebit(array(12, 34)); // WHERE account_debit IN (12, 34)
     * $query->filterByTotalDebit(array('min' => 12)); // WHERE account_debit > 12
     * </code>
     *
     * @param     mixed $totalDebit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByTotalDebit($totalDebit = null, $comparison = null)
    {
        if (is_array($totalDebit)) {
            $useMinMax = false;
            if (isset($totalDebit['min'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_DEBIT, $totalDebit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalDebit['max'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_DEBIT, $totalDebit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_DEBIT, $totalDebit, $comparison);
    }

    /**
     * Filter the query on the account_key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE account_key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE account_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $key The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByKey($key = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($key)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_KEY, $key, $comparison);
    }

    /**
     * Filter the query on the account_dev column
     *
     * Example usage:
     * <code>
     * $query->filterByDeveloper('fooValue');   // WHERE account_dev = 'fooValue'
     * $query->filterByDeveloper('%fooValue%', Criteria::LIKE); // WHERE account_dev LIKE '%fooValue%'
     * </code>
     *
     * @param     string $developer The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByDeveloper($developer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($developer)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_DEV, $developer, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Table\Account\Credit object
     *
     * @param \Propel\Table\Account\Credit|ObjectCollection $credit the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAccountQuery The current query, for fluid interface
     */
    public function filterByCredit($credit, $comparison = null)
    {
        if ($credit instanceof \Propel\Table\Account\Credit) {
            return $this
                ->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $credit->getAccountId(), $comparison);
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
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
     * @return ChildAccountQuery The current query, for fluid interface
     */
    public function filterByDebit($debit, $comparison = null)
    {
        if ($debit instanceof \Propel\Table\Account\Debit) {
            return $this
                ->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $debit->getAccountId(), $comparison);
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
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
     * Filter the query by a related \Propel\Table\Account\Transaction object
     *
     * @param \Propel\Table\Account\Transaction|ObjectCollection $transaction the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAccountQuery The current query, for fluid interface
     */
    public function filterByTransaction($transaction, $comparison = null)
    {
        if ($transaction instanceof \Propel\Table\Account\Transaction) {
            return $this
                ->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $transaction->getAccountId(), $comparison);
        } elseif ($transaction instanceof ObjectCollection) {
            return $this
                ->useTransactionQuery()
                ->filterByPrimaryKeys($transaction->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
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
     * @param \Propel\Table\Account\Product|ObjectCollection $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAccountQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Propel\Table\Account\Product) {
            return $this
                ->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $product->getOwner(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            return $this
                ->useProductQuery()
                ->filterByPrimaryKeys($product->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
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
     * Filter the query by a related \Propel\Table\Account\ProductReview object
     *
     * @param \Propel\Table\Account\ProductReview|ObjectCollection $productReview the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAccountQuery The current query, for fluid interface
     */
    public function filterByProductReview($productReview, $comparison = null)
    {
        if ($productReview instanceof \Propel\Table\Account\ProductReview) {
            return $this
                ->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $productReview->getAccountId(), $comparison);
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildAccount $account Object to remove from the list of results
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function prune($account = null)
    {
        if ($account) {
            $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_ID, $account->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the t_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AccountTableMap::clearInstancePool();
            AccountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AccountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AccountTableMap::clearRelatedInstancePool();

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

        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AccountTableMap::DATABASE_NAME);
        $db = Propel::getServiceContainer()->getAdapter(AccountTableMap::DATABASE_NAME);

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

} // AccountQuery
