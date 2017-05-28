<?php

namespace Propel\Table\Account\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use Propel\Table\Account\Account as ChildAccount;
use Propel\Table\Account\AccountQuery as ChildAccountQuery;
use Propel\Table\Account\Credit as ChildCredit;
use Propel\Table\Account\CreditQuery as ChildCreditQuery;
use Propel\Table\Account\Debit as ChildDebit;
use Propel\Table\Account\DebitQuery as ChildDebitQuery;
use Propel\Table\Account\Product as ChildProduct;
use Propel\Table\Account\ProductQuery as ChildProductQuery;
use Propel\Table\Account\ProductReview as ChildProductReview;
use Propel\Table\Account\ProductReviewQuery as ChildProductReviewQuery;
use Propel\Table\Account\Transaction as ChildTransaction;
use Propel\Table\Account\TransactionQuery as ChildTransactionQuery;
use Propel\Table\Account\Map\AccountTableMap;
use Propel\Table\Account\Map\CreditTableMap;
use Propel\Table\Account\Map\DebitTableMap;
use Propel\Table\Account\Map\ProductReviewTableMap;
use Propel\Table\Account\Map\ProductTableMap;
use Propel\Table\Account\Map\TransactionTableMap;

/**
 * Base class that represents a row from the 't_account' table.
 *
 *
 *
 * @package    propel.generator.Propel.Table.Account.Base
 */
abstract class Account implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Propel\\Table\\Account\\Map\\AccountTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the account_id field.
     *
     * @var        string
     */
    protected $account_id;

    /**
     * The value for the account_username field.
     *
     * @var        string
     */
    protected $account_username;

    /**
     * The value for the account_firstname field.
     *
     * @var        string
     */
    protected $account_firstname;

    /**
     * The value for the account_lastname field.
     *
     * @var        string
     */
    protected $account_lastname;

    /**
     * The value for the account_password field.
     *
     * @var        string
     */
    protected $account_password;

    /**
     * The value for the account_status field.
     *
     * Note: this column has a database default value of: 'p'
     * @var        string
     */
    protected $account_status;

    /**
     * The value for the account_email field.
     *
     * @var        string
     */
    protected $account_email;

    /**
     * The value for the account_registerdate field.
     *
     * @var        DateTime
     */
    protected $account_registerdate;

    /**
     * The value for the account_expired field.
     *
     * @var        DateTime
     */
    protected $account_expired;

    /**
     * The value for the account_avatar field.
     *
     * @var        string
     */
    protected $account_avatar;

    /**
     * The value for the account_token field.
     *
     * @var        string
     */
    protected $account_token;

    /**
     * The value for the account_ipaddress field.
     *
     * @var        string
     */
    protected $account_ipaddress;

    /**
     * The value for the account_type field.
     *
     * Note: this column has a database default value of: 'free'
     * @var        string
     */
    protected $account_type;

    /**
     * The value for the account_credit field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $account_credit;

    /**
     * The value for the account_debit field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $account_debit;

    /**
     * The value for the account_key field.
     *
     * @var        string
     */
    protected $account_key;

    /**
     * The value for the account_dev field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $account_dev;

    /**
     * @var        ObjectCollection|ChildCredit[] Collection to store aggregation of ChildCredit objects.
     */
    protected $collCredits;
    protected $collCreditsPartial;

    /**
     * @var        ObjectCollection|ChildDebit[] Collection to store aggregation of ChildDebit objects.
     */
    protected $collDebits;
    protected $collDebitsPartial;

    /**
     * @var        ObjectCollection|ChildTransaction[] Collection to store aggregation of ChildTransaction objects.
     */
    protected $collTransactions;
    protected $collTransactionsPartial;

    /**
     * @var        ObjectCollection|ChildProduct[] Collection to store aggregation of ChildProduct objects.
     */
    protected $collProducts;
    protected $collProductsPartial;

    /**
     * @var        ObjectCollection|ChildProductReview[] Collection to store aggregation of ChildProductReview objects.
     */
    protected $collProductReviews;
    protected $collProductReviewsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCredit[]
     */
    protected $creditsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDebit[]
     */
    protected $debitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTransaction[]
     */
    protected $transactionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProduct[]
     */
    protected $productsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductReview[]
     */
    protected $productReviewsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->account_status = 'p';
        $this->account_type = 'free';
        $this->account_credit = '0';
        $this->account_debit = '0';
        $this->account_dev = 'n';
    }

    /**
     * Initializes internal state of Propel\Table\Account\Base\Account object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Account</code> instance.  If
     * <code>obj</code> is an instance of <code>Account</code>, delegates to
     * <code>equals(Account)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Account The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [account_id] column value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->account_id;
    }

    /**
     * Get the [account_username] column value.
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->account_username;
    }

    /**
     * Get the [account_firstname] column value.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->account_firstname;
    }

    /**
     * Get the [account_lastname] column value.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->account_lastname;
    }

    /**
     * Get the [account_password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->account_password;
    }

    /**
     * Get the [account_status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->account_status;
    }

    /**
     * Get the [account_email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->account_email;
    }

    /**
     * Get the [optionally formatted] temporal [account_registerdate] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRegisterDate($format = NULL)
    {
        if ($format === null) {
            return $this->account_registerdate;
        } else {
            return $this->account_registerdate instanceof \DateTimeInterface ? $this->account_registerdate->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [account_expired] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getExpired($format = NULL)
    {
        if ($format === null) {
            return $this->account_expired;
        } else {
            return $this->account_expired instanceof \DateTimeInterface ? $this->account_expired->format($format) : null;
        }
    }

    /**
     * Get the [account_avatar] column value.
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->account_avatar;
    }

    /**
     * Get the [account_token] column value.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->account_token;
    }

    /**
     * Get the [account_ipaddress] column value.
     *
     * @return string
     */
    public function getIPAddress()
    {
        return $this->account_ipaddress;
    }

    /**
     * Get the [account_type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->account_type;
    }

    /**
     * Get the [account_credit] column value.
     *
     * @return string
     */
    public function getTotalCredit()
    {
        return $this->account_credit;
    }

    /**
     * Get the [account_debit] column value.
     *
     * @return string
     */
    public function getTotalDebit()
    {
        return $this->account_debit;
    }

    /**
     * Get the [account_key] column value.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->account_key;
    }

    /**
     * Get the [account_dev] column value.
     *
     * @return string
     */
    public function getDeveloper()
    {
        return $this->account_dev;
    }

    /**
     * Set the value of [account_id] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_id !== $v) {
            $this->account_id = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [account_username] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setUserName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_username !== $v) {
            $this->account_username = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_USERNAME] = true;
        }

        return $this;
    } // setUserName()

    /**
     * Set the value of [account_firstname] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_firstname !== $v) {
            $this->account_firstname = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_FIRSTNAME] = true;
        }

        return $this;
    } // setFirstName()

    /**
     * Set the value of [account_lastname] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_lastname !== $v) {
            $this->account_lastname = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_LASTNAME] = true;
        }

        return $this;
    } // setLastName()

    /**
     * Set the value of [account_password] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_password !== $v) {
            $this->account_password = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [account_status] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_status !== $v) {
            $this->account_status = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [account_email] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_email !== $v) {
            $this->account_email = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Sets the value of [account_registerdate] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setRegisterDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->account_registerdate !== null || $dt !== null) {
            if ($this->account_registerdate === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->account_registerdate->format("Y-m-d H:i:s.u")) {
                $this->account_registerdate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_REGISTERDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRegisterDate()

    /**
     * Sets the value of [account_expired] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setExpired($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->account_expired !== null || $dt !== null) {
            if ($this->account_expired === null || $dt === null || $dt->format("Y-m-d") !== $this->account_expired->format("Y-m-d")) {
                $this->account_expired = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_EXPIRED] = true;
            }
        } // if either are not null

        return $this;
    } // setExpired()

    /**
     * Set the value of [account_avatar] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setAvatar($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_avatar !== $v) {
            $this->account_avatar = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_AVATAR] = true;
        }

        return $this;
    } // setAvatar()

    /**
     * Set the value of [account_token] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_token !== $v) {
            $this->account_token = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_TOKEN] = true;
        }

        return $this;
    } // setToken()

    /**
     * Set the value of [account_ipaddress] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setIPAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_ipaddress !== $v) {
            $this->account_ipaddress = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_IPADDRESS] = true;
        }

        return $this;
    } // setIPAddress()

    /**
     * Set the value of [account_type] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_type !== $v) {
            $this->account_type = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [account_credit] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setTotalCredit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_credit !== $v) {
            $this->account_credit = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_CREDIT] = true;
        }

        return $this;
    } // setTotalCredit()

    /**
     * Set the value of [account_debit] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setTotalDebit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_debit !== $v) {
            $this->account_debit = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_DEBIT] = true;
        }

        return $this;
    } // setTotalDebit()

    /**
     * Set the value of [account_key] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_key !== $v) {
            $this->account_key = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_KEY] = true;
        }

        return $this;
    } // setKey()

    /**
     * Set the value of [account_dev] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function setDeveloper($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->account_dev !== $v) {
            $this->account_dev = $v;
            $this->modifiedColumns[AccountTableMap::COL_ACCOUNT_DEV] = true;
        }

        return $this;
    } // setDeveloper()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->account_status !== 'p') {
                return false;
            }

            if ($this->account_type !== 'free') {
                return false;
            }

            if ($this->account_credit !== '0') {
                return false;
            }

            if ($this->account_debit !== '0') {
                return false;
            }

            if ($this->account_dev !== 'n') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AccountTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AccountTableMap::translateFieldName('UserName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AccountTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_firstname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AccountTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_lastname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AccountTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AccountTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AccountTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AccountTableMap::translateFieldName('RegisterDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->account_registerdate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AccountTableMap::translateFieldName('Expired', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->account_expired = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AccountTableMap::translateFieldName('Avatar', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_avatar = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : AccountTableMap::translateFieldName('Token', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_token = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : AccountTableMap::translateFieldName('IPAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_ipaddress = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : AccountTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : AccountTableMap::translateFieldName('TotalCredit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_credit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : AccountTableMap::translateFieldName('TotalDebit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_debit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : AccountTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : AccountTableMap::translateFieldName('Developer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_dev = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = AccountTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Propel\\Table\\Account\\Account'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AccountTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAccountQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCredits = null;

            $this->collDebits = null;

            $this->collTransactions = null;

            $this->collProducts = null;

            $this->collProductReviews = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Account::setDeleted()
     * @see Account::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAccountQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                AccountTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->creditsScheduledForDeletion !== null) {
                if (!$this->creditsScheduledForDeletion->isEmpty()) {
                    \Propel\Table\Account\CreditQuery::create()
                        ->filterByPrimaryKeys($this->creditsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->creditsScheduledForDeletion = null;
                }
            }

            if ($this->collCredits !== null) {
                foreach ($this->collCredits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->debitsScheduledForDeletion !== null) {
                if (!$this->debitsScheduledForDeletion->isEmpty()) {
                    \Propel\Table\Account\DebitQuery::create()
                        ->filterByPrimaryKeys($this->debitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->debitsScheduledForDeletion = null;
                }
            }

            if ($this->collDebits !== null) {
                foreach ($this->collDebits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->transactionsScheduledForDeletion !== null) {
                if (!$this->transactionsScheduledForDeletion->isEmpty()) {
                    \Propel\Table\Account\TransactionQuery::create()
                        ->filterByPrimaryKeys($this->transactionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->transactionsScheduledForDeletion = null;
                }
            }

            if ($this->collTransactions !== null) {
                foreach ($this->collTransactions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productsScheduledForDeletion !== null) {
                if (!$this->productsScheduledForDeletion->isEmpty()) {
                    \Propel\Table\Account\ProductQuery::create()
                        ->filterByPrimaryKeys($this->productsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productsScheduledForDeletion = null;
                }
            }

            if ($this->collProducts !== null) {
                foreach ($this->collProducts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productReviewsScheduledForDeletion !== null) {
                if (!$this->productReviewsScheduledForDeletion->isEmpty()) {
                    \Propel\Table\Account\ProductReviewQuery::create()
                        ->filterByPrimaryKeys($this->productReviewsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productReviewsScheduledForDeletion = null;
                }
            }

            if ($this->collProductReviews !== null) {
                foreach ($this->collProductReviews as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'account_id';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'account_username';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'account_firstname';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'account_lastname';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'account_password';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'account_status';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'account_email';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_REGISTERDATE)) {
            $modifiedColumns[':p' . $index++]  = 'account_registerdate';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_EXPIRED)) {
            $modifiedColumns[':p' . $index++]  = 'account_expired';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_AVATAR)) {
            $modifiedColumns[':p' . $index++]  = 'account_avatar';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'account_token';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_IPADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'account_ipaddress';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'account_type';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_CREDIT)) {
            $modifiedColumns[':p' . $index++]  = 'account_credit';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_DEBIT)) {
            $modifiedColumns[':p' . $index++]  = 'account_debit';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'account_key';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_DEV)) {
            $modifiedColumns[':p' . $index++]  = 'account_dev';
        }

        $sql = sprintf(
            'INSERT INTO t_account (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'account_id':
                        $stmt->bindValue($identifier, $this->account_id, PDO::PARAM_STR);
                        break;
                    case 'account_username':
                        $stmt->bindValue($identifier, $this->account_username, PDO::PARAM_STR);
                        break;
                    case 'account_firstname':
                        $stmt->bindValue($identifier, $this->account_firstname, PDO::PARAM_STR);
                        break;
                    case 'account_lastname':
                        $stmt->bindValue($identifier, $this->account_lastname, PDO::PARAM_STR);
                        break;
                    case 'account_password':
                        $stmt->bindValue($identifier, $this->account_password, PDO::PARAM_STR);
                        break;
                    case 'account_status':
                        $stmt->bindValue($identifier, $this->account_status, PDO::PARAM_STR);
                        break;
                    case 'account_email':
                        $stmt->bindValue($identifier, $this->account_email, PDO::PARAM_STR);
                        break;
                    case 'account_registerdate':
                        $stmt->bindValue($identifier, $this->account_registerdate ? $this->account_registerdate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'account_expired':
                        $stmt->bindValue($identifier, $this->account_expired ? $this->account_expired->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'account_avatar':
                        $stmt->bindValue($identifier, $this->account_avatar, PDO::PARAM_STR);
                        break;
                    case 'account_token':
                        $stmt->bindValue($identifier, $this->account_token, PDO::PARAM_STR);
                        break;
                    case 'account_ipaddress':
                        $stmt->bindValue($identifier, $this->account_ipaddress, PDO::PARAM_STR);
                        break;
                    case 'account_type':
                        $stmt->bindValue($identifier, $this->account_type, PDO::PARAM_STR);
                        break;
                    case 'account_credit':
                        $stmt->bindValue($identifier, $this->account_credit, PDO::PARAM_STR);
                        break;
                    case 'account_debit':
                        $stmt->bindValue($identifier, $this->account_debit, PDO::PARAM_STR);
                        break;
                    case 'account_key':
                        $stmt->bindValue($identifier, $this->account_key, PDO::PARAM_STR);
                        break;
                    case 'account_dev':
                        $stmt->bindValue($identifier, $this->account_dev, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getUserName();
                break;
            case 2:
                return $this->getFirstName();
                break;
            case 3:
                return $this->getLastName();
                break;
            case 4:
                return $this->getPassword();
                break;
            case 5:
                return $this->getStatus();
                break;
            case 6:
                return $this->getEmail();
                break;
            case 7:
                return $this->getRegisterDate();
                break;
            case 8:
                return $this->getExpired();
                break;
            case 9:
                return $this->getAvatar();
                break;
            case 10:
                return $this->getToken();
                break;
            case 11:
                return $this->getIPAddress();
                break;
            case 12:
                return $this->getType();
                break;
            case 13:
                return $this->getTotalCredit();
                break;
            case 14:
                return $this->getTotalDebit();
                break;
            case 15:
                return $this->getKey();
                break;
            case 16:
                return $this->getDeveloper();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Account'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Account'][$this->hashCode()] = true;
        $keys = AccountTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUserName(),
            $keys[2] => $this->getFirstName(),
            $keys[3] => $this->getLastName(),
            $keys[4] => $this->getPassword(),
            $keys[5] => $this->getStatus(),
            $keys[6] => $this->getEmail(),
            $keys[7] => $this->getRegisterDate(),
            $keys[8] => $this->getExpired(),
            $keys[9] => $this->getAvatar(),
            $keys[10] => $this->getToken(),
            $keys[11] => $this->getIPAddress(),
            $keys[12] => $this->getType(),
            $keys[13] => $this->getTotalCredit(),
            $keys[14] => $this->getTotalDebit(),
            $keys[15] => $this->getKey(),
            $keys[16] => $this->getDeveloper(),
        );
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collCredits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'credits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_credits';
                        break;
                    default:
                        $key = 'Credits';
                }

                $result[$key] = $this->collCredits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDebits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'debits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_debits';
                        break;
                    default:
                        $key = 'Debits';
                }

                $result[$key] = $this->collDebits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTransactions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'transactions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_transactions';
                        break;
                    default:
                        $key = 'Transactions';
                }

                $result[$key] = $this->collTransactions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'products';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_products';
                        break;
                    default:
                        $key = 'Products';
                }

                $result[$key] = $this->collProducts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductReviews) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productReviews';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_productreviews';
                        break;
                    default:
                        $key = 'ProductReviews';
                }

                $result[$key] = $this->collProductReviews->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Propel\Table\Account\Account
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Propel\Table\Account\Account
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUserName($value);
                break;
            case 2:
                $this->setFirstName($value);
                break;
            case 3:
                $this->setLastName($value);
                break;
            case 4:
                $this->setPassword($value);
                break;
            case 5:
                $this->setStatus($value);
                break;
            case 6:
                $this->setEmail($value);
                break;
            case 7:
                $this->setRegisterDate($value);
                break;
            case 8:
                $this->setExpired($value);
                break;
            case 9:
                $this->setAvatar($value);
                break;
            case 10:
                $this->setToken($value);
                break;
            case 11:
                $this->setIPAddress($value);
                break;
            case 12:
                $this->setType($value);
                break;
            case 13:
                $this->setTotalCredit($value);
                break;
            case 14:
                $this->setTotalDebit($value);
                break;
            case 15:
                $this->setKey($value);
                break;
            case 16:
                $this->setDeveloper($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = AccountTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUserName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFirstName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLastName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPassword($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStatus($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEmail($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setRegisterDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setExpired($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAvatar($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setToken($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIPAddress($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setType($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTotalCredit($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setTotalDebit($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setKey($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDeveloper($arr[$keys[16]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Propel\Table\Account\Account The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AccountTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_ID)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_ID, $this->account_id);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_USERNAME)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_USERNAME, $this->account_username);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_FIRSTNAME)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_FIRSTNAME, $this->account_firstname);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_LASTNAME)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_LASTNAME, $this->account_lastname);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_PASSWORD)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_PASSWORD, $this->account_password);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_STATUS)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_STATUS, $this->account_status);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_EMAIL)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_EMAIL, $this->account_email);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_REGISTERDATE)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_REGISTERDATE, $this->account_registerdate);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_EXPIRED)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_EXPIRED, $this->account_expired);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_AVATAR)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_AVATAR, $this->account_avatar);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_TOKEN)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_TOKEN, $this->account_token);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_IPADDRESS)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_IPADDRESS, $this->account_ipaddress);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_TYPE)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_TYPE, $this->account_type);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_CREDIT)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_CREDIT, $this->account_credit);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_DEBIT)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_DEBIT, $this->account_debit);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_KEY)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_KEY, $this->account_key);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ACCOUNT_DEV)) {
            $criteria->add(AccountTableMap::COL_ACCOUNT_DEV, $this->account_dev);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildAccountQuery::create();
        $criteria->add(AccountTableMap::COL_ACCOUNT_ID, $this->account_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (account_id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Propel\Table\Account\Account (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setUserName($this->getUserName());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setRegisterDate($this->getRegisterDate());
        $copyObj->setExpired($this->getExpired());
        $copyObj->setAvatar($this->getAvatar());
        $copyObj->setToken($this->getToken());
        $copyObj->setIPAddress($this->getIPAddress());
        $copyObj->setType($this->getType());
        $copyObj->setTotalCredit($this->getTotalCredit());
        $copyObj->setTotalDebit($this->getTotalDebit());
        $copyObj->setKey($this->getKey());
        $copyObj->setDeveloper($this->getDeveloper());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCredits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCredit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDebits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDebit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTransactions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransaction($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProducts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProduct($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductReviews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductReview($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Propel\Table\Account\Account Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Credit' == $relationName) {
            $this->initCredits();
            return;
        }
        if ('Debit' == $relationName) {
            $this->initDebits();
            return;
        }
        if ('Transaction' == $relationName) {
            $this->initTransactions();
            return;
        }
        if ('Product' == $relationName) {
            $this->initProducts();
            return;
        }
        if ('ProductReview' == $relationName) {
            $this->initProductReviews();
            return;
        }
    }

    /**
     * Clears out the collCredits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCredits()
     */
    public function clearCredits()
    {
        $this->collCredits = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCredits collection loaded partially.
     */
    public function resetPartialCredits($v = true)
    {
        $this->collCreditsPartial = $v;
    }

    /**
     * Initializes the collCredits collection.
     *
     * By default this just sets the collCredits collection to an empty array (like clearcollCredits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCredits($overrideExisting = true)
    {
        if (null !== $this->collCredits && !$overrideExisting) {
            return;
        }

        $collectionClassName = CreditTableMap::getTableMap()->getCollectionClassName();

        $this->collCredits = new $collectionClassName;
        $this->collCredits->setModel('\Propel\Table\Account\Credit');
    }

    /**
     * Gets an array of ChildCredit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCredit[] List of ChildCredit objects
     * @throws PropelException
     */
    public function getCredits(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCreditsPartial && !$this->isNew();
        if (null === $this->collCredits || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCredits) {
                // return empty collection
                $this->initCredits();
            } else {
                $collCredits = ChildCreditQuery::create(null, $criteria)
                    ->filterByAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCreditsPartial && count($collCredits)) {
                        $this->initCredits(false);

                        foreach ($collCredits as $obj) {
                            if (false == $this->collCredits->contains($obj)) {
                                $this->collCredits->append($obj);
                            }
                        }

                        $this->collCreditsPartial = true;
                    }

                    return $collCredits;
                }

                if ($partial && $this->collCredits) {
                    foreach ($this->collCredits as $obj) {
                        if ($obj->isNew()) {
                            $collCredits[] = $obj;
                        }
                    }
                }

                $this->collCredits = $collCredits;
                $this->collCreditsPartial = false;
            }
        }

        return $this->collCredits;
    }

    /**
     * Sets a collection of ChildCredit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $credits A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function setCredits(Collection $credits, ConnectionInterface $con = null)
    {
        /** @var ChildCredit[] $creditsToDelete */
        $creditsToDelete = $this->getCredits(new Criteria(), $con)->diff($credits);


        $this->creditsScheduledForDeletion = $creditsToDelete;

        foreach ($creditsToDelete as $creditRemoved) {
            $creditRemoved->setAccount(null);
        }

        $this->collCredits = null;
        foreach ($credits as $credit) {
            $this->addCredit($credit);
        }

        $this->collCredits = $credits;
        $this->collCreditsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Credit objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Credit objects.
     * @throws PropelException
     */
    public function countCredits(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCreditsPartial && !$this->isNew();
        if (null === $this->collCredits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCredits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCredits());
            }

            $query = ChildCreditQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccount($this)
                ->count($con);
        }

        return count($this->collCredits);
    }

    /**
     * Method called to associate a ChildCredit object to this object
     * through the ChildCredit foreign key attribute.
     *
     * @param  ChildCredit $l ChildCredit
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function addCredit(ChildCredit $l)
    {
        if ($this->collCredits === null) {
            $this->initCredits();
            $this->collCreditsPartial = true;
        }

        if (!$this->collCredits->contains($l)) {
            $this->doAddCredit($l);

            if ($this->creditsScheduledForDeletion and $this->creditsScheduledForDeletion->contains($l)) {
                $this->creditsScheduledForDeletion->remove($this->creditsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCredit $credit The ChildCredit object to add.
     */
    protected function doAddCredit(ChildCredit $credit)
    {
        $this->collCredits[]= $credit;
        $credit->setAccount($this);
    }

    /**
     * @param  ChildCredit $credit The ChildCredit object to remove.
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function removeCredit(ChildCredit $credit)
    {
        if ($this->getCredits()->contains($credit)) {
            $pos = $this->collCredits->search($credit);
            $this->collCredits->remove($pos);
            if (null === $this->creditsScheduledForDeletion) {
                $this->creditsScheduledForDeletion = clone $this->collCredits;
                $this->creditsScheduledForDeletion->clear();
            }
            $this->creditsScheduledForDeletion[]= clone $credit;
            $credit->setAccount(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Account is new, it will return
     * an empty collection; or if this Account has previously
     * been saved, it will retrieve related Credits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Account.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCredit[] List of ChildCredit objects
     */
    public function getCreditsJoinTransaction(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCreditQuery::create(null, $criteria);
        $query->joinWith('Transaction', $joinBehavior);

        return $this->getCredits($query, $con);
    }

    /**
     * Clears out the collDebits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDebits()
     */
    public function clearDebits()
    {
        $this->collDebits = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDebits collection loaded partially.
     */
    public function resetPartialDebits($v = true)
    {
        $this->collDebitsPartial = $v;
    }

    /**
     * Initializes the collDebits collection.
     *
     * By default this just sets the collDebits collection to an empty array (like clearcollDebits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDebits($overrideExisting = true)
    {
        if (null !== $this->collDebits && !$overrideExisting) {
            return;
        }

        $collectionClassName = DebitTableMap::getTableMap()->getCollectionClassName();

        $this->collDebits = new $collectionClassName;
        $this->collDebits->setModel('\Propel\Table\Account\Debit');
    }

    /**
     * Gets an array of ChildDebit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDebit[] List of ChildDebit objects
     * @throws PropelException
     */
    public function getDebits(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDebitsPartial && !$this->isNew();
        if (null === $this->collDebits || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDebits) {
                // return empty collection
                $this->initDebits();
            } else {
                $collDebits = ChildDebitQuery::create(null, $criteria)
                    ->filterByAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDebitsPartial && count($collDebits)) {
                        $this->initDebits(false);

                        foreach ($collDebits as $obj) {
                            if (false == $this->collDebits->contains($obj)) {
                                $this->collDebits->append($obj);
                            }
                        }

                        $this->collDebitsPartial = true;
                    }

                    return $collDebits;
                }

                if ($partial && $this->collDebits) {
                    foreach ($this->collDebits as $obj) {
                        if ($obj->isNew()) {
                            $collDebits[] = $obj;
                        }
                    }
                }

                $this->collDebits = $collDebits;
                $this->collDebitsPartial = false;
            }
        }

        return $this->collDebits;
    }

    /**
     * Sets a collection of ChildDebit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $debits A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function setDebits(Collection $debits, ConnectionInterface $con = null)
    {
        /** @var ChildDebit[] $debitsToDelete */
        $debitsToDelete = $this->getDebits(new Criteria(), $con)->diff($debits);


        $this->debitsScheduledForDeletion = $debitsToDelete;

        foreach ($debitsToDelete as $debitRemoved) {
            $debitRemoved->setAccount(null);
        }

        $this->collDebits = null;
        foreach ($debits as $debit) {
            $this->addDebit($debit);
        }

        $this->collDebits = $debits;
        $this->collDebitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Debit objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Debit objects.
     * @throws PropelException
     */
    public function countDebits(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDebitsPartial && !$this->isNew();
        if (null === $this->collDebits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDebits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDebits());
            }

            $query = ChildDebitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccount($this)
                ->count($con);
        }

        return count($this->collDebits);
    }

    /**
     * Method called to associate a ChildDebit object to this object
     * through the ChildDebit foreign key attribute.
     *
     * @param  ChildDebit $l ChildDebit
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function addDebit(ChildDebit $l)
    {
        if ($this->collDebits === null) {
            $this->initDebits();
            $this->collDebitsPartial = true;
        }

        if (!$this->collDebits->contains($l)) {
            $this->doAddDebit($l);

            if ($this->debitsScheduledForDeletion and $this->debitsScheduledForDeletion->contains($l)) {
                $this->debitsScheduledForDeletion->remove($this->debitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDebit $debit The ChildDebit object to add.
     */
    protected function doAddDebit(ChildDebit $debit)
    {
        $this->collDebits[]= $debit;
        $debit->setAccount($this);
    }

    /**
     * @param  ChildDebit $debit The ChildDebit object to remove.
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function removeDebit(ChildDebit $debit)
    {
        if ($this->getDebits()->contains($debit)) {
            $pos = $this->collDebits->search($debit);
            $this->collDebits->remove($pos);
            if (null === $this->debitsScheduledForDeletion) {
                $this->debitsScheduledForDeletion = clone $this->collDebits;
                $this->debitsScheduledForDeletion->clear();
            }
            $this->debitsScheduledForDeletion[]= clone $debit;
            $debit->setAccount(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Account is new, it will return
     * an empty collection; or if this Account has previously
     * been saved, it will retrieve related Debits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Account.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDebit[] List of ChildDebit objects
     */
    public function getDebitsJoinTransaction(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDebitQuery::create(null, $criteria);
        $query->joinWith('Transaction', $joinBehavior);

        return $this->getDebits($query, $con);
    }

    /**
     * Clears out the collTransactions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTransactions()
     */
    public function clearTransactions()
    {
        $this->collTransactions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTransactions collection loaded partially.
     */
    public function resetPartialTransactions($v = true)
    {
        $this->collTransactionsPartial = $v;
    }

    /**
     * Initializes the collTransactions collection.
     *
     * By default this just sets the collTransactions collection to an empty array (like clearcollTransactions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTransactions($overrideExisting = true)
    {
        if (null !== $this->collTransactions && !$overrideExisting) {
            return;
        }

        $collectionClassName = TransactionTableMap::getTableMap()->getCollectionClassName();

        $this->collTransactions = new $collectionClassName;
        $this->collTransactions->setModel('\Propel\Table\Account\Transaction');
    }

    /**
     * Gets an array of ChildTransaction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTransaction[] List of ChildTransaction objects
     * @throws PropelException
     */
    public function getTransactions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionsPartial && !$this->isNew();
        if (null === $this->collTransactions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTransactions) {
                // return empty collection
                $this->initTransactions();
            } else {
                $collTransactions = ChildTransactionQuery::create(null, $criteria)
                    ->filterByAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTransactionsPartial && count($collTransactions)) {
                        $this->initTransactions(false);

                        foreach ($collTransactions as $obj) {
                            if (false == $this->collTransactions->contains($obj)) {
                                $this->collTransactions->append($obj);
                            }
                        }

                        $this->collTransactionsPartial = true;
                    }

                    return $collTransactions;
                }

                if ($partial && $this->collTransactions) {
                    foreach ($this->collTransactions as $obj) {
                        if ($obj->isNew()) {
                            $collTransactions[] = $obj;
                        }
                    }
                }

                $this->collTransactions = $collTransactions;
                $this->collTransactionsPartial = false;
            }
        }

        return $this->collTransactions;
    }

    /**
     * Sets a collection of ChildTransaction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $transactions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function setTransactions(Collection $transactions, ConnectionInterface $con = null)
    {
        /** @var ChildTransaction[] $transactionsToDelete */
        $transactionsToDelete = $this->getTransactions(new Criteria(), $con)->diff($transactions);


        $this->transactionsScheduledForDeletion = $transactionsToDelete;

        foreach ($transactionsToDelete as $transactionRemoved) {
            $transactionRemoved->setAccount(null);
        }

        $this->collTransactions = null;
        foreach ($transactions as $transaction) {
            $this->addTransaction($transaction);
        }

        $this->collTransactions = $transactions;
        $this->collTransactionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Transaction objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Transaction objects.
     * @throws PropelException
     */
    public function countTransactions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionsPartial && !$this->isNew();
        if (null === $this->collTransactions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTransactions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTransactions());
            }

            $query = ChildTransactionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccount($this)
                ->count($con);
        }

        return count($this->collTransactions);
    }

    /**
     * Method called to associate a ChildTransaction object to this object
     * through the ChildTransaction foreign key attribute.
     *
     * @param  ChildTransaction $l ChildTransaction
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function addTransaction(ChildTransaction $l)
    {
        if ($this->collTransactions === null) {
            $this->initTransactions();
            $this->collTransactionsPartial = true;
        }

        if (!$this->collTransactions->contains($l)) {
            $this->doAddTransaction($l);

            if ($this->transactionsScheduledForDeletion and $this->transactionsScheduledForDeletion->contains($l)) {
                $this->transactionsScheduledForDeletion->remove($this->transactionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTransaction $transaction The ChildTransaction object to add.
     */
    protected function doAddTransaction(ChildTransaction $transaction)
    {
        $this->collTransactions[]= $transaction;
        $transaction->setAccount($this);
    }

    /**
     * @param  ChildTransaction $transaction The ChildTransaction object to remove.
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function removeTransaction(ChildTransaction $transaction)
    {
        if ($this->getTransactions()->contains($transaction)) {
            $pos = $this->collTransactions->search($transaction);
            $this->collTransactions->remove($pos);
            if (null === $this->transactionsScheduledForDeletion) {
                $this->transactionsScheduledForDeletion = clone $this->collTransactions;
                $this->transactionsScheduledForDeletion->clear();
            }
            $this->transactionsScheduledForDeletion[]= clone $transaction;
            $transaction->setAccount(null);
        }

        return $this;
    }

    /**
     * Clears out the collProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProducts()
     */
    public function clearProducts()
    {
        $this->collProducts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProducts collection loaded partially.
     */
    public function resetPartialProducts($v = true)
    {
        $this->collProductsPartial = $v;
    }

    /**
     * Initializes the collProducts collection.
     *
     * By default this just sets the collProducts collection to an empty array (like clearcollProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProducts($overrideExisting = true)
    {
        if (null !== $this->collProducts && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductTableMap::getTableMap()->getCollectionClassName();

        $this->collProducts = new $collectionClassName;
        $this->collProducts->setModel('\Propel\Table\Account\Product');
    }

    /**
     * Gets an array of ChildProduct objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProduct[] List of ChildProduct objects
     * @throws PropelException
     */
    public function getProducts(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductsPartial && !$this->isNew();
        if (null === $this->collProducts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProducts) {
                // return empty collection
                $this->initProducts();
            } else {
                $collProducts = ChildProductQuery::create(null, $criteria)
                    ->filterByAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductsPartial && count($collProducts)) {
                        $this->initProducts(false);

                        foreach ($collProducts as $obj) {
                            if (false == $this->collProducts->contains($obj)) {
                                $this->collProducts->append($obj);
                            }
                        }

                        $this->collProductsPartial = true;
                    }

                    return $collProducts;
                }

                if ($partial && $this->collProducts) {
                    foreach ($this->collProducts as $obj) {
                        if ($obj->isNew()) {
                            $collProducts[] = $obj;
                        }
                    }
                }

                $this->collProducts = $collProducts;
                $this->collProductsPartial = false;
            }
        }

        return $this->collProducts;
    }

    /**
     * Sets a collection of ChildProduct objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $products A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function setProducts(Collection $products, ConnectionInterface $con = null)
    {
        /** @var ChildProduct[] $productsToDelete */
        $productsToDelete = $this->getProducts(new Criteria(), $con)->diff($products);


        $this->productsScheduledForDeletion = $productsToDelete;

        foreach ($productsToDelete as $productRemoved) {
            $productRemoved->setAccount(null);
        }

        $this->collProducts = null;
        foreach ($products as $product) {
            $this->addProduct($product);
        }

        $this->collProducts = $products;
        $this->collProductsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Product objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Product objects.
     * @throws PropelException
     */
    public function countProducts(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductsPartial && !$this->isNew();
        if (null === $this->collProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProducts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProducts());
            }

            $query = ChildProductQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccount($this)
                ->count($con);
        }

        return count($this->collProducts);
    }

    /**
     * Method called to associate a ChildProduct object to this object
     * through the ChildProduct foreign key attribute.
     *
     * @param  ChildProduct $l ChildProduct
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function addProduct(ChildProduct $l)
    {
        if ($this->collProducts === null) {
            $this->initProducts();
            $this->collProductsPartial = true;
        }

        if (!$this->collProducts->contains($l)) {
            $this->doAddProduct($l);

            if ($this->productsScheduledForDeletion and $this->productsScheduledForDeletion->contains($l)) {
                $this->productsScheduledForDeletion->remove($this->productsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProduct $product The ChildProduct object to add.
     */
    protected function doAddProduct(ChildProduct $product)
    {
        $this->collProducts[]= $product;
        $product->setAccount($this);
    }

    /**
     * @param  ChildProduct $product The ChildProduct object to remove.
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function removeProduct(ChildProduct $product)
    {
        if ($this->getProducts()->contains($product)) {
            $pos = $this->collProducts->search($product);
            $this->collProducts->remove($pos);
            if (null === $this->productsScheduledForDeletion) {
                $this->productsScheduledForDeletion = clone $this->collProducts;
                $this->productsScheduledForDeletion->clear();
            }
            $this->productsScheduledForDeletion[]= clone $product;
            $product->setAccount(null);
        }

        return $this;
    }

    /**
     * Clears out the collProductReviews collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductReviews()
     */
    public function clearProductReviews()
    {
        $this->collProductReviews = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductReviews collection loaded partially.
     */
    public function resetPartialProductReviews($v = true)
    {
        $this->collProductReviewsPartial = $v;
    }

    /**
     * Initializes the collProductReviews collection.
     *
     * By default this just sets the collProductReviews collection to an empty array (like clearcollProductReviews());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductReviews($overrideExisting = true)
    {
        if (null !== $this->collProductReviews && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductReviewTableMap::getTableMap()->getCollectionClassName();

        $this->collProductReviews = new $collectionClassName;
        $this->collProductReviews->setModel('\Propel\Table\Account\ProductReview');
    }

    /**
     * Gets an array of ChildProductReview objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductReview[] List of ChildProductReview objects
     * @throws PropelException
     */
    public function getProductReviews(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductReviewsPartial && !$this->isNew();
        if (null === $this->collProductReviews || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductReviews) {
                // return empty collection
                $this->initProductReviews();
            } else {
                $collProductReviews = ChildProductReviewQuery::create(null, $criteria)
                    ->filterByAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductReviewsPartial && count($collProductReviews)) {
                        $this->initProductReviews(false);

                        foreach ($collProductReviews as $obj) {
                            if (false == $this->collProductReviews->contains($obj)) {
                                $this->collProductReviews->append($obj);
                            }
                        }

                        $this->collProductReviewsPartial = true;
                    }

                    return $collProductReviews;
                }

                if ($partial && $this->collProductReviews) {
                    foreach ($this->collProductReviews as $obj) {
                        if ($obj->isNew()) {
                            $collProductReviews[] = $obj;
                        }
                    }
                }

                $this->collProductReviews = $collProductReviews;
                $this->collProductReviewsPartial = false;
            }
        }

        return $this->collProductReviews;
    }

    /**
     * Sets a collection of ChildProductReview objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productReviews A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function setProductReviews(Collection $productReviews, ConnectionInterface $con = null)
    {
        /** @var ChildProductReview[] $productReviewsToDelete */
        $productReviewsToDelete = $this->getProductReviews(new Criteria(), $con)->diff($productReviews);


        $this->productReviewsScheduledForDeletion = $productReviewsToDelete;

        foreach ($productReviewsToDelete as $productReviewRemoved) {
            $productReviewRemoved->setAccount(null);
        }

        $this->collProductReviews = null;
        foreach ($productReviews as $productReview) {
            $this->addProductReview($productReview);
        }

        $this->collProductReviews = $productReviews;
        $this->collProductReviewsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductReview objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductReview objects.
     * @throws PropelException
     */
    public function countProductReviews(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductReviewsPartial && !$this->isNew();
        if (null === $this->collProductReviews || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductReviews) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductReviews());
            }

            $query = ChildProductReviewQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccount($this)
                ->count($con);
        }

        return count($this->collProductReviews);
    }

    /**
     * Method called to associate a ChildProductReview object to this object
     * through the ChildProductReview foreign key attribute.
     *
     * @param  ChildProductReview $l ChildProductReview
     * @return $this|\Propel\Table\Account\Account The current object (for fluent API support)
     */
    public function addProductReview(ChildProductReview $l)
    {
        if ($this->collProductReviews === null) {
            $this->initProductReviews();
            $this->collProductReviewsPartial = true;
        }

        if (!$this->collProductReviews->contains($l)) {
            $this->doAddProductReview($l);

            if ($this->productReviewsScheduledForDeletion and $this->productReviewsScheduledForDeletion->contains($l)) {
                $this->productReviewsScheduledForDeletion->remove($this->productReviewsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductReview $productReview The ChildProductReview object to add.
     */
    protected function doAddProductReview(ChildProductReview $productReview)
    {
        $this->collProductReviews[]= $productReview;
        $productReview->setAccount($this);
    }

    /**
     * @param  ChildProductReview $productReview The ChildProductReview object to remove.
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function removeProductReview(ChildProductReview $productReview)
    {
        if ($this->getProductReviews()->contains($productReview)) {
            $pos = $this->collProductReviews->search($productReview);
            $this->collProductReviews->remove($pos);
            if (null === $this->productReviewsScheduledForDeletion) {
                $this->productReviewsScheduledForDeletion = clone $this->collProductReviews;
                $this->productReviewsScheduledForDeletion->clear();
            }
            $this->productReviewsScheduledForDeletion[]= clone $productReview;
            $productReview->setAccount(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Account is new, it will return
     * an empty collection; or if this Account has previously
     * been saved, it will retrieve related ProductReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Account.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductReview[] List of ChildProductReview objects
     */
    public function getProductReviewsJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductReviewQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getProductReviews($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->account_id = null;
        $this->account_username = null;
        $this->account_firstname = null;
        $this->account_lastname = null;
        $this->account_password = null;
        $this->account_status = null;
        $this->account_email = null;
        $this->account_registerdate = null;
        $this->account_expired = null;
        $this->account_avatar = null;
        $this->account_token = null;
        $this->account_ipaddress = null;
        $this->account_type = null;
        $this->account_credit = null;
        $this->account_debit = null;
        $this->account_key = null;
        $this->account_dev = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collCredits) {
                foreach ($this->collCredits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDebits) {
                foreach ($this->collDebits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTransactions) {
                foreach ($this->collTransactions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProducts) {
                foreach ($this->collProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductReviews) {
                foreach ($this->collProductReviews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCredits = null;
        $this->collDebits = null;
        $this->collTransactions = null;
        $this->collProducts = null;
        $this->collProductReviews = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AccountTableMap::DEFAULT_STRING_FORMAT);
    }

    // behavior_account_debit behavior

    /**
     * Computes the value of the aggregate column account_debit *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeTotalDebit(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT SUM(debit_value) FROM t_debit WHERE t_debit.DEBIT_ACCOUNT = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column account_debit *
     * @param ConnectionInterface $con A connection object
     */
    public function updateTotalDebit(ConnectionInterface $con)
    {
        $this->setTotalDebit($this->computeTotalDebit($con));
        $this->save($con);
    }

    // behavior_account_credit behavior

    /**
     * Computes the value of the aggregate column account_credit *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeTotalCredit(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT SUM(credit_value) FROM t_credit WHERE t_credit.CREDIT_ACCOUNT = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column account_credit *
     * @param ConnectionInterface $con A connection object
     */
    public function updateTotalCredit(ConnectionInterface $con)
    {
        $this->setTotalCredit($this->computeTotalCredit($con));
        $this->save($con);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
