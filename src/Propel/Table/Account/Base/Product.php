<?php

namespace Propel\Table\Account\Base;

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
use Propel\Table\Account\Account as ChildAccount;
use Propel\Table\Account\AccountQuery as ChildAccountQuery;
use Propel\Table\Account\Product as ChildProduct;
use Propel\Table\Account\ProductImage as ChildProductImage;
use Propel\Table\Account\ProductImageQuery as ChildProductImageQuery;
use Propel\Table\Account\ProductQuery as ChildProductQuery;
use Propel\Table\Account\ProductReview as ChildProductReview;
use Propel\Table\Account\ProductReviewQuery as ChildProductReviewQuery;
use Propel\Table\Account\ProductTag as ChildProductTag;
use Propel\Table\Account\ProductTagQuery as ChildProductTagQuery;
use Propel\Table\Account\TransactionDetail as ChildTransactionDetail;
use Propel\Table\Account\TransactionDetailQuery as ChildTransactionDetailQuery;
use Propel\Table\Account\Map\ProductImageTableMap;
use Propel\Table\Account\Map\ProductReviewTableMap;
use Propel\Table\Account\Map\ProductTableMap;
use Propel\Table\Account\Map\ProductTagTableMap;
use Propel\Table\Account\Map\TransactionDetailTableMap;

/**
 * Base class that represents a row from the 't_product' table.
 *
 *
 *
 * @package    propel.generator.Propel.Table.Account.Base
 */
abstract class Product implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Propel\\Table\\Account\\Map\\ProductTableMap';


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
     * The value for the product_id field.
     *
     * @var        string
     */
    protected $product_id;

    /**
     * The value for the product_name field.
     *
     * @var        string
     */
    protected $product_name;

    /**
     * The value for the product_owner field.
     *
     * @var        string
     */
    protected $product_owner;

    /**
     * The value for the product_price field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $product_price;

    /**
     * The value for the product_discount field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $product_discount;

    /**
     * The value for the product_status field.
     *
     * Note: this column has a database default value of: 'p'
     * @var        string
     */
    protected $product_status;

    /**
     * The value for the product_repository field.
     *
     * @var        string
     */
    protected $product_repository;

    /**
     * The value for the product_license field.
     *
     * Note: this column has a database default value of: 'GPLv3'
     * @var        string
     */
    protected $product_license;

    /**
     * The value for the product_description field.
     *
     * @var        string
     */
    protected $product_description;

    /**
     * The value for the product_totalreview field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $product_totalreview;

    /**
     * The value for the product_rating field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $product_rating;

    /**
     * The value for the product_type field.
     *
     * Note: this column has a database default value of: 'app'
     * @var        string
     */
    protected $product_type;

    /**
     * @var        ChildAccount
     */
    protected $aAccount;

    /**
     * @var        ObjectCollection|ChildTransactionDetail[] Collection to store aggregation of ChildTransactionDetail objects.
     */
    protected $collTransactionDetails;
    protected $collTransactionDetailsPartial;

    /**
     * @var        ObjectCollection|ChildProductReview[] Collection to store aggregation of ChildProductReview objects.
     */
    protected $collProductReviews;
    protected $collProductReviewsPartial;

    /**
     * @var        ObjectCollection|ChildProductImage[] Collection to store aggregation of ChildProductImage objects.
     */
    protected $collProductImages;
    protected $collProductImagesPartial;

    /**
     * @var        ObjectCollection|ChildProductTag[] Collection to store aggregation of ChildProductTag objects.
     */
    protected $collProductTags;
    protected $collProductTagsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTransactionDetail[]
     */
    protected $transactionDetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductReview[]
     */
    protected $productReviewsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductImage[]
     */
    protected $productImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductTag[]
     */
    protected $productTagsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->product_price = '0';
        $this->product_discount = '0';
        $this->product_status = 'p';
        $this->product_license = 'GPLv3';
        $this->product_totalreview = 0;
        $this->product_rating = 0;
        $this->product_type = 'app';
    }

    /**
     * Initializes internal state of Propel\Table\Account\Base\Product object.
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
     * Compares this with another <code>Product</code> instance.  If
     * <code>obj</code> is an instance of <code>Product</code>, delegates to
     * <code>equals(Product)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Product The current object, for fluid interface
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
     * Get the [product_id] column value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->product_id;
    }

    /**
     * Get the [product_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->product_name;
    }

    /**
     * Get the [product_owner] column value.
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->product_owner;
    }

    /**
     * Get the [product_price] column value.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->product_price;
    }

    /**
     * Get the [product_discount] column value.
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->product_discount;
    }

    /**
     * Get the [product_status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->product_status;
    }

    /**
     * Get the [product_repository] column value.
     *
     * @return string
     */
    public function getRepository()
    {
        return $this->product_repository;
    }

    /**
     * Get the [product_license] column value.
     *
     * @return string
     */
    public function getLicense()
    {
        return $this->product_license;
    }

    /**
     * Get the [product_description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->product_description;
    }

    /**
     * Get the [product_totalreview] column value.
     *
     * @return int
     */
    public function getTotalReview()
    {
        return $this->product_totalreview;
    }

    /**
     * Get the [product_rating] column value.
     *
     * @return int
     */
    public function getRating()
    {
        return $this->product_rating;
    }

    /**
     * Get the [product_type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->product_type;
    }

    /**
     * Set the value of [product_id] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_id !== $v) {
            $this->product_id = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [product_name] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_name !== $v) {
            $this->product_name = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [product_owner] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setOwner($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_owner !== $v) {
            $this->product_owner = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_OWNER] = true;
        }

        if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
            $this->aAccount = null;
        }

        return $this;
    } // setOwner()

    /**
     * Set the value of [product_price] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_price !== $v) {
            $this->product_price = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_PRICE] = true;
        }

        return $this;
    } // setPrice()

    /**
     * Set the value of [product_discount] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setDiscount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_discount !== $v) {
            $this->product_discount = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_DISCOUNT] = true;
        }

        return $this;
    } // setDiscount()

    /**
     * Set the value of [product_status] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_status !== $v) {
            $this->product_status = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [product_repository] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setRepository($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_repository !== $v) {
            $this->product_repository = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_REPOSITORY] = true;
        }

        return $this;
    } // setRepository()

    /**
     * Set the value of [product_license] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setLicense($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_license !== $v) {
            $this->product_license = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_LICENSE] = true;
        }

        return $this;
    } // setLicense()

    /**
     * Set the value of [product_description] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_description !== $v) {
            $this->product_description = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [product_totalreview] column.
     *
     * @param int $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setTotalReview($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_totalreview !== $v) {
            $this->product_totalreview = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_TOTALREVIEW] = true;
        }

        return $this;
    } // setTotalReview()

    /**
     * Set the value of [product_rating] column.
     *
     * @param int $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setRating($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_rating !== $v) {
            $this->product_rating = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_RATING] = true;
        }

        return $this;
    } // setRating()

    /**
     * Set the value of [product_type] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_type !== $v) {
            $this->product_type = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_TYPE] = true;
        }

        return $this;
    } // setType()

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
            if ($this->product_price !== '0') {
                return false;
            }

            if ($this->product_discount !== '0') {
                return false;
            }

            if ($this->product_status !== 'p') {
                return false;
            }

            if ($this->product_license !== 'GPLv3') {
                return false;
            }

            if ($this->product_totalreview !== 0) {
                return false;
            }

            if ($this->product_rating !== 0) {
                return false;
            }

            if ($this->product_type !== 'app') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductTableMap::translateFieldName('Owner', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_owner = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductTableMap::translateFieldName('Discount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_discount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductTableMap::translateFieldName('Repository', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_repository = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProductTableMap::translateFieldName('License', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_license = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProductTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProductTableMap::translateFieldName('TotalReview', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_totalreview = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ProductTableMap::translateFieldName('Rating', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_rating = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ProductTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_type = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = ProductTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Propel\\Table\\Account\\Product'), 0, $e);
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
        if ($this->aAccount !== null && $this->product_owner !== $this->aAccount->getId()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAccount = null;
            $this->collTransactionDetails = null;

            $this->collProductReviews = null;

            $this->collProductImages = null;

            $this->collProductTags = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Product::setDeleted()
     * @see Product::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
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
                ProductTableMap::addInstanceToPool($this);
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

            if ($this->transactionDetailsScheduledForDeletion !== null) {
                if (!$this->transactionDetailsScheduledForDeletion->isEmpty()) {
                    foreach ($this->transactionDetailsScheduledForDeletion as $transactionDetail) {
                        // need to save related object because we set the relation to null
                        $transactionDetail->save($con);
                    }
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

            if ($this->productImagesScheduledForDeletion !== null) {
                if (!$this->productImagesScheduledForDeletion->isEmpty()) {
                    \Propel\Table\Account\ProductImageQuery::create()
                        ->filterByPrimaryKeys($this->productImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productImagesScheduledForDeletion = null;
                }
            }

            if ($this->collProductImages !== null) {
                foreach ($this->collProductImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productTagsScheduledForDeletion !== null) {
                if (!$this->productTagsScheduledForDeletion->isEmpty()) {
                    \Propel\Table\Account\ProductTagQuery::create()
                        ->filterByPrimaryKeys($this->productTagsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productTagsScheduledForDeletion = null;
                }
            }

            if ($this->collProductTags !== null) {
                foreach ($this->collProductTags as $referrerFK) {
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
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'product_id';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'product_name';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_OWNER)) {
            $modifiedColumns[':p' . $index++]  = 'product_owner';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'product_price';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_DISCOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'product_discount';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'product_status';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_REPOSITORY)) {
            $modifiedColumns[':p' . $index++]  = 'product_repository';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_LICENSE)) {
            $modifiedColumns[':p' . $index++]  = 'product_license';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'product_description';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_TOTALREVIEW)) {
            $modifiedColumns[':p' . $index++]  = 'product_totalreview';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_RATING)) {
            $modifiedColumns[':p' . $index++]  = 'product_rating';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'product_type';
        }

        $sql = sprintf(
            'INSERT INTO t_product (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'product_id':
                        $stmt->bindValue($identifier, $this->product_id, PDO::PARAM_STR);
                        break;
                    case 'product_name':
                        $stmt->bindValue($identifier, $this->product_name, PDO::PARAM_STR);
                        break;
                    case 'product_owner':
                        $stmt->bindValue($identifier, $this->product_owner, PDO::PARAM_STR);
                        break;
                    case 'product_price':
                        $stmt->bindValue($identifier, $this->product_price, PDO::PARAM_STR);
                        break;
                    case 'product_discount':
                        $stmt->bindValue($identifier, $this->product_discount, PDO::PARAM_STR);
                        break;
                    case 'product_status':
                        $stmt->bindValue($identifier, $this->product_status, PDO::PARAM_STR);
                        break;
                    case 'product_repository':
                        $stmt->bindValue($identifier, $this->product_repository, PDO::PARAM_STR);
                        break;
                    case 'product_license':
                        $stmt->bindValue($identifier, $this->product_license, PDO::PARAM_STR);
                        break;
                    case 'product_description':
                        $stmt->bindValue($identifier, $this->product_description, PDO::PARAM_STR);
                        break;
                    case 'product_totalreview':
                        $stmt->bindValue($identifier, $this->product_totalreview, PDO::PARAM_INT);
                        break;
                    case 'product_rating':
                        $stmt->bindValue($identifier, $this->product_rating, PDO::PARAM_INT);
                        break;
                    case 'product_type':
                        $stmt->bindValue($identifier, $this->product_type, PDO::PARAM_STR);
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
        $pos = ProductTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getOwner();
                break;
            case 3:
                return $this->getPrice();
                break;
            case 4:
                return $this->getDiscount();
                break;
            case 5:
                return $this->getStatus();
                break;
            case 6:
                return $this->getRepository();
                break;
            case 7:
                return $this->getLicense();
                break;
            case 8:
                return $this->getDescription();
                break;
            case 9:
                return $this->getTotalReview();
                break;
            case 10:
                return $this->getRating();
                break;
            case 11:
                return $this->getType();
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

        if (isset($alreadyDumpedObjects['Product'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Product'][$this->hashCode()] = true;
        $keys = ProductTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getOwner(),
            $keys[3] => $this->getPrice(),
            $keys[4] => $this->getDiscount(),
            $keys[5] => $this->getStatus(),
            $keys[6] => $this->getRepository(),
            $keys[7] => $this->getLicense(),
            $keys[8] => $this->getDescription(),
            $keys[9] => $this->getTotalReview(),
            $keys[10] => $this->getRating(),
            $keys[11] => $this->getType(),
        );
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
            if (null !== $this->collProductImages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productImages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_productimages';
                        break;
                    default:
                        $key = 'ProductImages';
                }

                $result[$key] = $this->collProductImages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductTags) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productTags';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 't_producttags';
                        break;
                    default:
                        $key = 'ProductTags';
                }

                $result[$key] = $this->collProductTags->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Propel\Table\Account\Product
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Propel\Table\Account\Product
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setOwner($value);
                break;
            case 3:
                $this->setPrice($value);
                break;
            case 4:
                $this->setDiscount($value);
                break;
            case 5:
                $this->setStatus($value);
                break;
            case 6:
                $this->setRepository($value);
                break;
            case 7:
                $this->setLicense($value);
                break;
            case 8:
                $this->setDescription($value);
                break;
            case 9:
                $this->setTotalReview($value);
                break;
            case 10:
                $this->setRating($value);
                break;
            case 11:
                $this->setType($value);
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
        $keys = ProductTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOwner($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPrice($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDiscount($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStatus($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setRepository($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLicense($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDescription($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setTotalReview($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRating($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setType($arr[$keys[11]]);
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
     * @return $this|\Propel\Table\Account\Product The current object, for fluid interface
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
        $criteria = new Criteria(ProductTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_ID)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_ID, $this->product_id);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_NAME)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_NAME, $this->product_name);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_OWNER)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_OWNER, $this->product_owner);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_PRICE)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_PRICE, $this->product_price);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_DISCOUNT)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_DISCOUNT, $this->product_discount);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_STATUS)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_STATUS, $this->product_status);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_REPOSITORY)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_REPOSITORY, $this->product_repository);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_LICENSE)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_LICENSE, $this->product_license);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_DESCRIPTION)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_DESCRIPTION, $this->product_description);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_TOTALREVIEW)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_TOTALREVIEW, $this->product_totalreview);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_RATING)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_RATING, $this->product_rating);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_TYPE)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_TYPE, $this->product_type);
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
        $criteria = ChildProductQuery::create();
        $criteria->add(ProductTableMap::COL_PRODUCT_ID, $this->product_id);

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
     * Generic method to set the primary key (product_id column).
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
     * @param      object $copyObj An object of \Propel\Table\Account\Product (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setName($this->getName());
        $copyObj->setOwner($this->getOwner());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setDiscount($this->getDiscount());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setRepository($this->getRepository());
        $copyObj->setLicense($this->getLicense());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setTotalReview($this->getTotalReview());
        $copyObj->setRating($this->getRating());
        $copyObj->setType($this->getType());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getTransactionDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransactionDetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductReviews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductReview($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductTags() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductTag($relObj->copy($deepCopy));
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
     * @return \Propel\Table\Account\Product Clone of current object.
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
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAccount(ChildAccount $v = null)
    {
        if ($v === null) {
            $this->setOwner(NULL);
        } else {
            $this->setOwner($v->getId());
        }

        $this->aAccount = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAccount object, it will not be re-added.
        if ($v !== null) {
            $v->addProduct($this);
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
        if ($this->aAccount === null && (($this->product_owner !== "" && $this->product_owner !== null))) {
            $this->aAccount = ChildAccountQuery::create()->findPk($this->product_owner, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAccount->addProducts($this);
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
        if ('TransactionDetail' == $relationName) {
            $this->initTransactionDetails();
            return;
        }
        if ('ProductReview' == $relationName) {
            $this->initProductReviews();
            return;
        }
        if ('ProductImage' == $relationName) {
            $this->initProductImages();
            return;
        }
        if ('ProductTag' == $relationName) {
            $this->initProductTags();
            return;
        }
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
     * If this ChildProduct is new, it will return
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
                    ->filterByProduct($this)
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
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setTransactionDetails(Collection $transactionDetails, ConnectionInterface $con = null)
    {
        /** @var ChildTransactionDetail[] $transactionDetailsToDelete */
        $transactionDetailsToDelete = $this->getTransactionDetails(new Criteria(), $con)->diff($transactionDetails);


        $this->transactionDetailsScheduledForDeletion = $transactionDetailsToDelete;

        foreach ($transactionDetailsToDelete as $transactionDetailRemoved) {
            $transactionDetailRemoved->setProduct(null);
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
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collTransactionDetails);
    }

    /**
     * Method called to associate a ChildTransactionDetail object to this object
     * through the ChildTransactionDetail foreign key attribute.
     *
     * @param  ChildTransactionDetail $l ChildTransactionDetail
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
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
        $transactionDetail->setProduct($this);
    }

    /**
     * @param  ChildTransactionDetail $transactionDetail The ChildTransactionDetail object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
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
            $this->transactionDetailsScheduledForDeletion[]= $transactionDetail;
            $transactionDetail->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related TransactionDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTransactionDetail[] List of ChildTransactionDetail objects
     */
    public function getTransactionDetailsJoinTransaction(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTransactionDetailQuery::create(null, $criteria);
        $query->joinWith('Transaction', $joinBehavior);

        return $this->getTransactionDetails($query, $con);
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
     * If this ChildProduct is new, it will return
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
                    ->filterByProduct($this)
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
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductReviews(Collection $productReviews, ConnectionInterface $con = null)
    {
        /** @var ChildProductReview[] $productReviewsToDelete */
        $productReviewsToDelete = $this->getProductReviews(new Criteria(), $con)->diff($productReviews);


        $this->productReviewsScheduledForDeletion = $productReviewsToDelete;

        foreach ($productReviewsToDelete as $productReviewRemoved) {
            $productReviewRemoved->setProduct(null);
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
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductReviews);
    }

    /**
     * Method called to associate a ChildProductReview object to this object
     * through the ChildProductReview foreign key attribute.
     *
     * @param  ChildProductReview $l ChildProductReview
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
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
        $productReview->setProduct($this);
    }

    /**
     * @param  ChildProductReview $productReview The ChildProductReview object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
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
            $productReview->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related ProductReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductReview[] List of ChildProductReview objects
     */
    public function getProductReviewsJoinAccount(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductReviewQuery::create(null, $criteria);
        $query->joinWith('Account', $joinBehavior);

        return $this->getProductReviews($query, $con);
    }

    /**
     * Clears out the collProductImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductImages()
     */
    public function clearProductImages()
    {
        $this->collProductImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductImages collection loaded partially.
     */
    public function resetPartialProductImages($v = true)
    {
        $this->collProductImagesPartial = $v;
    }

    /**
     * Initializes the collProductImages collection.
     *
     * By default this just sets the collProductImages collection to an empty array (like clearcollProductImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductImages($overrideExisting = true)
    {
        if (null !== $this->collProductImages && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductImageTableMap::getTableMap()->getCollectionClassName();

        $this->collProductImages = new $collectionClassName;
        $this->collProductImages->setModel('\Propel\Table\Account\ProductImage');
    }

    /**
     * Gets an array of ChildProductImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductImage[] List of ChildProductImage objects
     * @throws PropelException
     */
    public function getProductImages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductImagesPartial && !$this->isNew();
        if (null === $this->collProductImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductImages) {
                // return empty collection
                $this->initProductImages();
            } else {
                $collProductImages = ChildProductImageQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductImagesPartial && count($collProductImages)) {
                        $this->initProductImages(false);

                        foreach ($collProductImages as $obj) {
                            if (false == $this->collProductImages->contains($obj)) {
                                $this->collProductImages->append($obj);
                            }
                        }

                        $this->collProductImagesPartial = true;
                    }

                    return $collProductImages;
                }

                if ($partial && $this->collProductImages) {
                    foreach ($this->collProductImages as $obj) {
                        if ($obj->isNew()) {
                            $collProductImages[] = $obj;
                        }
                    }
                }

                $this->collProductImages = $collProductImages;
                $this->collProductImagesPartial = false;
            }
        }

        return $this->collProductImages;
    }

    /**
     * Sets a collection of ChildProductImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductImages(Collection $productImages, ConnectionInterface $con = null)
    {
        /** @var ChildProductImage[] $productImagesToDelete */
        $productImagesToDelete = $this->getProductImages(new Criteria(), $con)->diff($productImages);


        $this->productImagesScheduledForDeletion = $productImagesToDelete;

        foreach ($productImagesToDelete as $productImageRemoved) {
            $productImageRemoved->setProduct(null);
        }

        $this->collProductImages = null;
        foreach ($productImages as $productImage) {
            $this->addProductImage($productImage);
        }

        $this->collProductImages = $productImages;
        $this->collProductImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductImage objects.
     * @throws PropelException
     */
    public function countProductImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductImagesPartial && !$this->isNew();
        if (null === $this->collProductImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductImages());
            }

            $query = ChildProductImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductImages);
    }

    /**
     * Method called to associate a ChildProductImage object to this object
     * through the ChildProductImage foreign key attribute.
     *
     * @param  ChildProductImage $l ChildProductImage
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function addProductImage(ChildProductImage $l)
    {
        if ($this->collProductImages === null) {
            $this->initProductImages();
            $this->collProductImagesPartial = true;
        }

        if (!$this->collProductImages->contains($l)) {
            $this->doAddProductImage($l);

            if ($this->productImagesScheduledForDeletion and $this->productImagesScheduledForDeletion->contains($l)) {
                $this->productImagesScheduledForDeletion->remove($this->productImagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductImage $productImage The ChildProductImage object to add.
     */
    protected function doAddProductImage(ChildProductImage $productImage)
    {
        $this->collProductImages[]= $productImage;
        $productImage->setProduct($this);
    }

    /**
     * @param  ChildProductImage $productImage The ChildProductImage object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeProductImage(ChildProductImage $productImage)
    {
        if ($this->getProductImages()->contains($productImage)) {
            $pos = $this->collProductImages->search($productImage);
            $this->collProductImages->remove($pos);
            if (null === $this->productImagesScheduledForDeletion) {
                $this->productImagesScheduledForDeletion = clone $this->collProductImages;
                $this->productImagesScheduledForDeletion->clear();
            }
            $this->productImagesScheduledForDeletion[]= clone $productImage;
            $productImage->setProduct(null);
        }

        return $this;
    }

    /**
     * Clears out the collProductTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductTags()
     */
    public function clearProductTags()
    {
        $this->collProductTags = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductTags collection loaded partially.
     */
    public function resetPartialProductTags($v = true)
    {
        $this->collProductTagsPartial = $v;
    }

    /**
     * Initializes the collProductTags collection.
     *
     * By default this just sets the collProductTags collection to an empty array (like clearcollProductTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductTags($overrideExisting = true)
    {
        if (null !== $this->collProductTags && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductTagTableMap::getTableMap()->getCollectionClassName();

        $this->collProductTags = new $collectionClassName;
        $this->collProductTags->setModel('\Propel\Table\Account\ProductTag');
    }

    /**
     * Gets an array of ChildProductTag objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductTag[] List of ChildProductTag objects
     * @throws PropelException
     */
    public function getProductTags(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductTagsPartial && !$this->isNew();
        if (null === $this->collProductTags || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductTags) {
                // return empty collection
                $this->initProductTags();
            } else {
                $collProductTags = ChildProductTagQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductTagsPartial && count($collProductTags)) {
                        $this->initProductTags(false);

                        foreach ($collProductTags as $obj) {
                            if (false == $this->collProductTags->contains($obj)) {
                                $this->collProductTags->append($obj);
                            }
                        }

                        $this->collProductTagsPartial = true;
                    }

                    return $collProductTags;
                }

                if ($partial && $this->collProductTags) {
                    foreach ($this->collProductTags as $obj) {
                        if ($obj->isNew()) {
                            $collProductTags[] = $obj;
                        }
                    }
                }

                $this->collProductTags = $collProductTags;
                $this->collProductTagsPartial = false;
            }
        }

        return $this->collProductTags;
    }

    /**
     * Sets a collection of ChildProductTag objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productTags A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductTags(Collection $productTags, ConnectionInterface $con = null)
    {
        /** @var ChildProductTag[] $productTagsToDelete */
        $productTagsToDelete = $this->getProductTags(new Criteria(), $con)->diff($productTags);


        $this->productTagsScheduledForDeletion = $productTagsToDelete;

        foreach ($productTagsToDelete as $productTagRemoved) {
            $productTagRemoved->setProduct(null);
        }

        $this->collProductTags = null;
        foreach ($productTags as $productTag) {
            $this->addProductTag($productTag);
        }

        $this->collProductTags = $productTags;
        $this->collProductTagsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductTag objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductTag objects.
     * @throws PropelException
     */
    public function countProductTags(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductTagsPartial && !$this->isNew();
        if (null === $this->collProductTags || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductTags) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductTags());
            }

            $query = ChildProductTagQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductTags);
    }

    /**
     * Method called to associate a ChildProductTag object to this object
     * through the ChildProductTag foreign key attribute.
     *
     * @param  ChildProductTag $l ChildProductTag
     * @return $this|\Propel\Table\Account\Product The current object (for fluent API support)
     */
    public function addProductTag(ChildProductTag $l)
    {
        if ($this->collProductTags === null) {
            $this->initProductTags();
            $this->collProductTagsPartial = true;
        }

        if (!$this->collProductTags->contains($l)) {
            $this->doAddProductTag($l);

            if ($this->productTagsScheduledForDeletion and $this->productTagsScheduledForDeletion->contains($l)) {
                $this->productTagsScheduledForDeletion->remove($this->productTagsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductTag $productTag The ChildProductTag object to add.
     */
    protected function doAddProductTag(ChildProductTag $productTag)
    {
        $this->collProductTags[]= $productTag;
        $productTag->setProduct($this);
    }

    /**
     * @param  ChildProductTag $productTag The ChildProductTag object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeProductTag(ChildProductTag $productTag)
    {
        if ($this->getProductTags()->contains($productTag)) {
            $pos = $this->collProductTags->search($productTag);
            $this->collProductTags->remove($pos);
            if (null === $this->productTagsScheduledForDeletion) {
                $this->productTagsScheduledForDeletion = clone $this->collProductTags;
                $this->productTagsScheduledForDeletion->clear();
            }
            $this->productTagsScheduledForDeletion[]= clone $productTag;
            $productTag->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related ProductTags from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductTag[] List of ChildProductTag objects
     */
    public function getProductTagsJoinProductTagList(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductTagQuery::create(null, $criteria);
        $query->joinWith('ProductTagList', $joinBehavior);

        return $this->getProductTags($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aAccount) {
            $this->aAccount->removeProduct($this);
        }
        $this->product_id = null;
        $this->product_name = null;
        $this->product_owner = null;
        $this->product_price = null;
        $this->product_discount = null;
        $this->product_status = null;
        $this->product_repository = null;
        $this->product_license = null;
        $this->product_description = null;
        $this->product_totalreview = null;
        $this->product_rating = null;
        $this->product_type = null;
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
            if ($this->collTransactionDetails) {
                foreach ($this->collTransactionDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductReviews) {
                foreach ($this->collProductReviews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductImages) {
                foreach ($this->collProductImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductTags) {
                foreach ($this->collProductTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collTransactionDetails = null;
        $this->collProductReviews = null;
        $this->collProductImages = null;
        $this->collProductTags = null;
        $this->aAccount = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductTableMap::DEFAULT_STRING_FORMAT);
    }

    // behavior_product_totalreview behavior

    /**
     * Computes the value of the aggregate column product_totalreview *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeTotalReview(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT COUNT(productreview_id) FROM t_productreview WHERE t_productreview.PRODUCTREVIEW_PRODUCT = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column product_totalreview *
     * @param ConnectionInterface $con A connection object
     */
    public function updateTotalReview(ConnectionInterface $con)
    {
        $this->setTotalReview($this->computeTotalReview($con));
        $this->save($con);
    }

    // behavior_product_rating behavior

    /**
     * Computes the value of the aggregate column product_rating *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeRating(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT AVG(productreview_rate) FROM t_productreview WHERE t_productreview.PRODUCTREVIEW_PRODUCT = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column product_rating *
     * @param ConnectionInterface $con A connection object
     */
    public function updateRating(ConnectionInterface $con)
    {
        $this->setRating($this->computeRating($con));
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
