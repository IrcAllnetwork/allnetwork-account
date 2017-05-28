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
use Propel\Table\Account\Transaction as ChildTransaction;
use Propel\Table\Account\TransactionDetail as ChildTransactionDetail;
use Propel\Table\Account\TransactionDetailQuery as ChildTransactionDetailQuery;
use Propel\Table\Account\TransactionQuery as ChildTransactionQuery;
use Propel\Table\Account\Map\CreditTableMap;
use Propel\Table\Account\Map\DebitTableMap;
use Propel\Table\Account\Map\TransactionDetailTableMap;
use Propel\Table\Account\Map\TransactionTableMap;

/**
 * Base class that represents a row from the 't_transaction' table.
 *
 *
 *
 * @package    propel.generator.Propel.Table.Account.Base
 */
abstract class Transaction implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Propel\\Table\\Account\\Map\\TransactionTableMap';


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
     * The value for the transaction_id field.
     *
     * @var        string
     */
    protected $transaction_id;

    /**
     * The value for the transaction_account field.
     *
     * @var        string
     */
    protected $transaction_account;

    /**
     * The value for the transaction_time field.
     *
     * @var        DateTime
     */
    protected $transaction_time;

    /**
     * The value for the transaction_type field.
     *
     * Note: this column has a database default value of: 'debit'
     * @var        string
     */
    protected $transaction_type;

    /**
     * The value for the transaction_totalvalue field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $transaction_totalvalue;

    /**
     * The value for the transaction_totalqty field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $transaction_totalqty;

    /**
     * @var        ChildAccount
     */
    protected $aAccount;

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
     * @var        ObjectCollection|ChildTransactionDetail[] Collection to store aggregation of ChildTransactionDetail objects.
     */
    protected $collTransactionDetails;
    protected $collTransactionDetailsPartial;

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
     * @var ObjectCollection|ChildTransactionDetail[]
     */
    protected $transactionDetailsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->transaction_type = 'debit';
        $this->transaction_totalvalue = 0;
        $this->transaction_totalqty = 0;
    }

    /**
     * Initializes internal state of Propel\Table\Account\Base\Transaction object.
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
     * Compares this with another <code>Transaction</code> instance.  If
     * <code>obj</code> is an instance of <code>Transaction</code>, delegates to
     * <code>equals(Transaction)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Transaction The current object, for fluid interface
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
     * Get the [transaction_id] column value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->transaction_id;
    }

    /**
     * Get the [transaction_account] column value.
     *
     * @return string
     */
    public function getAccountId()
    {
        return $this->transaction_account;
    }

    /**
     * Get the [optionally formatted] temporal [transaction_time] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getTime($format = NULL)
    {
        if ($format === null) {
            return $this->transaction_time;
        } else {
            return $this->transaction_time instanceof \DateTimeInterface ? $this->transaction_time->format($format) : null;
        }
    }

    /**
     * Get the [transaction_type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->transaction_type;
    }

    /**
     * Get the [transaction_totalvalue] column value.
     *
     * @return int
     */
    public function getTotalValue()
    {
        return $this->transaction_totalvalue;
    }

    /**
     * Get the [transaction_totalqty] column value.
     *
     * @return int
     */
    public function getTotalQuantity()
    {
        return $this->transaction_totalqty;
    }

    /**
     * Set the value of [transaction_id] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transaction_id !== $v) {
            $this->transaction_id = $v;
            $this->modifiedColumns[TransactionTableMap::COL_TRANSACTION_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [transaction_account] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
     */
    public function setAccountId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transaction_account !== $v) {
            $this->transaction_account = $v;
            $this->modifiedColumns[TransactionTableMap::COL_TRANSACTION_ACCOUNT] = true;
        }

        if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
            $this->aAccount = null;
        }

        return $this;
    } // setAccountId()

    /**
     * Sets the value of [transaction_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
     */
    public function setTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->transaction_time !== null || $dt !== null) {
            if ($this->transaction_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->transaction_time->format("Y-m-d H:i:s.u")) {
                $this->transaction_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[TransactionTableMap::COL_TRANSACTION_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setTime()

    /**
     * Set the value of [transaction_type] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transaction_type !== $v) {
            $this->transaction_type = $v;
            $this->modifiedColumns[TransactionTableMap::COL_TRANSACTION_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [transaction_totalvalue] column.
     *
     * @param int $v new value
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
     */
    public function setTotalValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->transaction_totalvalue !== $v) {
            $this->transaction_totalvalue = $v;
            $this->modifiedColumns[TransactionTableMap::COL_TRANSACTION_TOTALVALUE] = true;
        }

        return $this;
    } // setTotalValue()

    /**
     * Set the value of [transaction_totalqty] column.
     *
     * @param int $v new value
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
     */
    public function setTotalQuantity($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->transaction_totalqty !== $v) {
            $this->transaction_totalqty = $v;
            $this->modifiedColumns[TransactionTableMap::COL_TRANSACTION_TOTALQTY] = true;
        }

        return $this;
    } // setTotalQuantity()

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
            if ($this->transaction_type !== 'debit') {
                return false;
            }

            if ($this->transaction_totalvalue !== 0) {
                return false;
            }

            if ($this->transaction_totalqty !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TransactionTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transaction_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TransactionTableMap::translateFieldName('AccountId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transaction_account = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TransactionTableMap::translateFieldName('Time', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->transaction_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TransactionTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transaction_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : TransactionTableMap::translateFieldName('TotalValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transaction_totalvalue = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : TransactionTableMap::translateFieldName('TotalQuantity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transaction_totalqty = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = TransactionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Propel\\Table\\Account\\Transaction'), 0, $e);
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
        if ($this->aAccount !== null && $this->transaction_account !== $this->aAccount->getId()) {
            $this->aAccount = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(TransactionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTransactionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAccount = null;
            $this->collCredits = null;

            $this->collDebits = null;

            $this->collTransactionDetails = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Transaction::setDeleted()
     * @see Transaction::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTransactionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionTableMap::DATABASE_NAME);
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
                TransactionTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAccount !== null) {
                if ($this->aAccount->isModified() || $this->aAccount->isNew()) {
                    $affectedRows += $this->aAccount->save($con);
                }
                $this->setAccount($this->aAccount);
            }

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

            if ($this->transactionDetailsScheduledForDeletion !== null) {
                if (!$this->transactionDetailsScheduledForDeletion->isEmpty()) {
                    \Propel\Table\Account\TransactionDetailQuery::create()
                        ->filterByPrimaryKeys($this->transactionDetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->transactionDetailsScheduledForDeletion = null;
                }
            }

            if ($this->collTransactionDetails !== null) {
                foreach ($this->collTransactionDetails as $referrerFK) {
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
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'transaction_id';
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_ACCOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'transaction_account';
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'transaction_time';
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'transaction_type';
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_TOTALVALUE)) {
            $modifiedColumns[':p' . $index++]  = 'transaction_totalvalue';
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_TOTALQTY)) {
            $modifiedColumns[':p' . $index++]  = 'transaction_totalqty';
        }

        $sql = sprintf(
            'INSERT INTO t_transaction (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'transaction_id':
                        $stmt->bindValue($identifier, $this->transaction_id, PDO::PARAM_STR);
                        break;
                    case 'transaction_account':
                        $stmt->bindValue($identifier, $this->transaction_account, PDO::PARAM_STR);
                        break;
                    case 'transaction_time':
                        $stmt->bindValue($identifier, $this->transaction_time ? $this->transaction_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'transaction_type':
                        $stmt->bindValue($identifier, $this->transaction_type, PDO::PARAM_STR);
                        break;
                    case 'transaction_totalvalue':
                        $stmt->bindValue($identifier, $this->transaction_totalvalue, PDO::PARAM_INT);
                        break;
                    case 'transaction_totalqty':
                        $stmt->bindValue($identifier, $this->transaction_totalqty, PDO::PARAM_INT);
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
        $pos = TransactionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAccountId();
                break;
            case 2:
                return $this->getTime();
                break;
            case 3:
                return $this->getType();
                break;
            case 4:
                return $this->getTotalValue();
                break;
            case 5:
                return $this->getTotalQuantity();
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

        if (isset($alreadyDumpedObjects['Transaction'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Transaction'][$this->hashCode()] = true;
        $keys = TransactionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAccountId(),
            $keys[2] => $this->getTime(),
            $keys[3] => $this->getType(),
            $keys[4] => $this->getTotalValue(),
            $keys[5] => $this->getTotalQuantity(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAccount) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'account';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_account';
                        break;
                    default:
                        $key = 'Account';
                }

                $result[$key] = $this->aAccount->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->collTransactionDetails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'transactionDetails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_transactiondetails';
                        break;
                    default:
                        $key = 'TransactionDetails';
                }

                $result[$key] = $this->collTransactionDetails->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Propel\Table\Account\Transaction
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = TransactionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Propel\Table\Account\Transaction
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setAccountId($value);
                break;
            case 2:
                $this->setTime($value);
                break;
            case 3:
                $this->setType($value);
                break;
            case 4:
                $this->setTotalValue($value);
                break;
            case 5:
                $this->setTotalQuantity($value);
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
        $keys = TransactionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAccountId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTime($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTotalValue($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTotalQuantity($arr[$keys[5]]);
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
     * @return $this|\Propel\Table\Account\Transaction The current object, for fluid interface
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
        $criteria = new Criteria(TransactionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_ID)) {
            $criteria->add(TransactionTableMap::COL_TRANSACTION_ID, $this->transaction_id);
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_ACCOUNT)) {
            $criteria->add(TransactionTableMap::COL_TRANSACTION_ACCOUNT, $this->transaction_account);
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_TIME)) {
            $criteria->add(TransactionTableMap::COL_TRANSACTION_TIME, $this->transaction_time);
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_TYPE)) {
            $criteria->add(TransactionTableMap::COL_TRANSACTION_TYPE, $this->transaction_type);
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_TOTALVALUE)) {
            $criteria->add(TransactionTableMap::COL_TRANSACTION_TOTALVALUE, $this->transaction_totalvalue);
        }
        if ($this->isColumnModified(TransactionTableMap::COL_TRANSACTION_TOTALQTY)) {
            $criteria->add(TransactionTableMap::COL_TRANSACTION_TOTALQTY, $this->transaction_totalqty);
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
        $criteria = ChildTransactionQuery::create();
        $criteria->add(TransactionTableMap::COL_TRANSACTION_ID, $this->transaction_id);

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
     * Generic method to set the primary key (transaction_id column).
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
     * @param      object $copyObj An object of \Propel\Table\Account\Transaction (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setAccountId($this->getAccountId());
        $copyObj->setTime($this->getTime());
        $copyObj->setType($this->getType());
        $copyObj->setTotalValue($this->getTotalValue());
        $copyObj->setTotalQuantity($this->getTotalQuantity());

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

            foreach ($this->getTransactionDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransactionDetail($relObj->copy($deepCopy));
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
     * @return \Propel\Table\Account\Transaction Clone of current object.
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
     * Declares an association between this object and a ChildAccount object.
     *
     * @param  ChildAccount $v
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAccount(ChildAccount $v = null)
    {
        if ($v === null) {
            $this->setAccountId(NULL);
        } else {
            $this->setAccountId($v->getId());
        }

        $this->aAccount = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAccount object, it will not be re-added.
        if ($v !== null) {
            $v->addTransaction($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAccount object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildAccount The associated ChildAccount object.
     * @throws PropelException
     */
    public function getAccount(ConnectionInterface $con = null)
    {
        if ($this->aAccount === null && (($this->transaction_account !== "" && $this->transaction_account !== null))) {
            $this->aAccount = ChildAccountQuery::create()->findPk($this->transaction_account, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAccount->addTransactions($this);
             */
        }

        return $this->aAccount;
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
        if ('TransactionDetail' == $relationName) {
            $this->initTransactionDetails();
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
     * If this ChildTransaction is new, it will return
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
                    ->filterByTransaction($this)
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
     * @return $this|ChildTransaction The current object (for fluent API support)
     */
    public function setCredits(Collection $credits, ConnectionInterface $con = null)
    {
        /** @var ChildCredit[] $creditsToDelete */
        $creditsToDelete = $this->getCredits(new Criteria(), $con)->diff($credits);


        $this->creditsScheduledForDeletion = $creditsToDelete;

        foreach ($creditsToDelete as $creditRemoved) {
            $creditRemoved->setTransaction(null);
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
                ->filterByTransaction($this)
                ->count($con);
        }

        return count($this->collCredits);
    }

    /**
     * Method called to associate a ChildCredit object to this object
     * through the ChildCredit foreign key attribute.
     *
     * @param  ChildCredit $l ChildCredit
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
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
        $credit->setTransaction($this);
    }

    /**
     * @param  ChildCredit $credit The ChildCredit object to remove.
     * @return $this|ChildTransaction The current object (for fluent API support)
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
            $credit->setTransaction(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Transaction is new, it will return
     * an empty collection; or if this Transaction has previously
     * been saved, it will retrieve related Credits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Transaction.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCredit[] List of ChildCredit objects
     */
    public function getCreditsJoinAccount(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCreditQuery::create(null, $criteria);
        $query->joinWith('Account', $joinBehavior);

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
     * If this ChildTransaction is new, it will return
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
                    ->filterByTransaction($this)
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
     * @return $this|ChildTransaction The current object (for fluent API support)
     */
    public function setDebits(Collection $debits, ConnectionInterface $con = null)
    {
        /** @var ChildDebit[] $debitsToDelete */
        $debitsToDelete = $this->getDebits(new Criteria(), $con)->diff($debits);


        $this->debitsScheduledForDeletion = $debitsToDelete;

        foreach ($debitsToDelete as $debitRemoved) {
            $debitRemoved->setTransaction(null);
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
                ->filterByTransaction($this)
                ->count($con);
        }

        return count($this->collDebits);
    }

    /**
     * Method called to associate a ChildDebit object to this object
     * through the ChildDebit foreign key attribute.
     *
     * @param  ChildDebit $l ChildDebit
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
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
        $debit->setTransaction($this);
    }

    /**
     * @param  ChildDebit $debit The ChildDebit object to remove.
     * @return $this|ChildTransaction The current object (for fluent API support)
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
            $debit->setTransaction(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Transaction is new, it will return
     * an empty collection; or if this Transaction has previously
     * been saved, it will retrieve related Debits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Transaction.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDebit[] List of ChildDebit objects
     */
    public function getDebitsJoinAccount(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDebitQuery::create(null, $criteria);
        $query->joinWith('Account', $joinBehavior);

        return $this->getDebits($query, $con);
    }

    /**
     * Clears out the collTransactionDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTransactionDetails()
     */
    public function clearTransactionDetails()
    {
        $this->collTransactionDetails = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTransactionDetails collection loaded partially.
     */
    public function resetPartialTransactionDetails($v = true)
    {
        $this->collTransactionDetailsPartial = $v;
    }

    /**
     * Initializes the collTransactionDetails collection.
     *
     * By default this just sets the collTransactionDetails collection to an empty array (like clearcollTransactionDetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTransactionDetails($overrideExisting = true)
    {
        if (null !== $this->collTransactionDetails && !$overrideExisting) {
            return;
        }

        $collectionClassName = TransactionDetailTableMap::getTableMap()->getCollectionClassName();

        $this->collTransactionDetails = new $collectionClassName;
        $this->collTransactionDetails->setModel('\Propel\Table\Account\TransactionDetail');
    }

    /**
     * Gets an array of ChildTransactionDetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTransaction is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTransactionDetail[] List of ChildTransactionDetail objects
     * @throws PropelException
     */
    public function getTransactionDetails(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionDetailsPartial && !$this->isNew();
        if (null === $this->collTransactionDetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTransactionDetails) {
                // return empty collection
                $this->initTransactionDetails();
            } else {
                $collTransactionDetails = ChildTransactionDetailQuery::create(null, $criteria)
                    ->filterByTransaction($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTransactionDetailsPartial && count($collTransactionDetails)) {
                        $this->initTransactionDetails(false);

                        foreach ($collTransactionDetails as $obj) {
                            if (false == $this->collTransactionDetails->contains($obj)) {
                                $this->collTransactionDetails->append($obj);
                            }
                        }

                        $this->collTransactionDetailsPartial = true;
                    }

                    return $collTransactionDetails;
                }

                if ($partial && $this->collTransactionDetails) {
                    foreach ($this->collTransactionDetails as $obj) {
                        if ($obj->isNew()) {
                            $collTransactionDetails[] = $obj;
                        }
                    }
                }

                $this->collTransactionDetails = $collTransactionDetails;
                $this->collTransactionDetailsPartial = false;
            }
        }

        return $this->collTransactionDetails;
    }

    /**
     * Sets a collection of ChildTransactionDetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $transactionDetails A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildTransaction The current object (for fluent API support)
     */
    public function setTransactionDetails(Collection $transactionDetails, ConnectionInterface $con = null)
    {
        /** @var ChildTransactionDetail[] $transactionDetailsToDelete */
        $transactionDetailsToDelete = $this->getTransactionDetails(new Criteria(), $con)->diff($transactionDetails);


        $this->transactionDetailsScheduledForDeletion = $transactionDetailsToDelete;

        foreach ($transactionDetailsToDelete as $transactionDetailRemoved) {
            $transactionDetailRemoved->setTransaction(null);
        }

        $this->collTransactionDetails = null;
        foreach ($transactionDetails as $transactionDetail) {
            $this->addTransactionDetail($transactionDetail);
        }

        $this->collTransactionDetails = $transactionDetails;
        $this->collTransactionDetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TransactionDetail objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related TransactionDetail objects.
     * @throws PropelException
     */
    public function countTransactionDetails(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionDetailsPartial && !$this->isNew();
        if (null === $this->collTransactionDetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTransactionDetails) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTransactionDetails());
            }

            $query = ChildTransactionDetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTransaction($this)
                ->count($con);
        }

        return count($this->collTransactionDetails);
    }

    /**
     * Method called to associate a ChildTransactionDetail object to this object
     * through the ChildTransactionDetail foreign key attribute.
     *
     * @param  ChildTransactionDetail $l ChildTransactionDetail
     * @return $this|\Propel\Table\Account\Transaction The current object (for fluent API support)
     */
    public function addTransactionDetail(ChildTransactionDetail $l)
    {
        if ($this->collTransactionDetails === null) {
            $this->initTransactionDetails();
            $this->collTransactionDetailsPartial = true;
        }

        if (!$this->collTransactionDetails->contains($l)) {
            $this->doAddTransactionDetail($l);

            if ($this->transactionDetailsScheduledForDeletion and $this->transactionDetailsScheduledForDeletion->contains($l)) {
                $this->transactionDetailsScheduledForDeletion->remove($this->transactionDetailsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTransactionDetail $transactionDetail The ChildTransactionDetail object to add.
     */
    protected function doAddTransactionDetail(ChildTransactionDetail $transactionDetail)
    {
        $this->collTransactionDetails[]= $transactionDetail;
        $transactionDetail->setTransaction($this);
    }

    /**
     * @param  ChildTransactionDetail $transactionDetail The ChildTransactionDetail object to remove.
     * @return $this|ChildTransaction The current object (for fluent API support)
     */
    public function removeTransactionDetail(ChildTransactionDetail $transactionDetail)
    {
        if ($this->getTransactionDetails()->contains($transactionDetail)) {
            $pos = $this->collTransactionDetails->search($transactionDetail);
            $this->collTransactionDetails->remove($pos);
            if (null === $this->transactionDetailsScheduledForDeletion) {
                $this->transactionDetailsScheduledForDeletion = clone $this->collTransactionDetails;
                $this->transactionDetailsScheduledForDeletion->clear();
            }
            $this->transactionDetailsScheduledForDeletion[]= clone $transactionDetail;
            $transactionDetail->setTransaction(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Transaction is new, it will return
     * an empty collection; or if this Transaction has previously
     * been saved, it will retrieve related TransactionDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Transaction.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTransactionDetail[] List of ChildTransactionDetail objects
     */
    public function getTransactionDetailsJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTransactionDetailQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getTransactionDetails($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aAccount) {
            $this->aAccount->removeTransaction($this);
        }
        $this->transaction_id = null;
        $this->transaction_account = null;
        $this->transaction_time = null;
        $this->transaction_type = null;
        $this->transaction_totalvalue = null;
        $this->transaction_totalqty = null;
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
            if ($this->collTransactionDetails) {
                foreach ($this->collTransactionDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCredits = null;
        $this->collDebits = null;
        $this->collTransactionDetails = null;
        $this->aAccount = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TransactionTableMap::DEFAULT_STRING_FORMAT);
    }

    // behavior_total_value behavior

    /**
     * Computes the value of the aggregate column transaction_totalvalue *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeTotalValue(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT SUM(transactiondetail_value) FROM t_transactiondetail WHERE t_transactiondetail.TRANSACTIONDETAIL_TRANSACTION = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column transaction_totalvalue *
     * @param ConnectionInterface $con A connection object
     */
    public function updateTotalValue(ConnectionInterface $con)
    {
        $this->setTotalValue($this->computeTotalValue($con));
        $this->save($con);
    }

    // behavior_total_qty behavior

    /**
     * Computes the value of the aggregate column transaction_totalqty *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeTotalQuantity(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT SUM(transactiondetail_qty) FROM t_transactiondetail WHERE t_transactiondetail.TRANSACTIONDETAIL_TRANSACTION = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column transaction_totalqty *
     * @param ConnectionInterface $con A connection object
     */
    public function updateTotalQuantity(ConnectionInterface $con)
    {
        $this->setTotalQuantity($this->computeTotalQuantity($con));
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
