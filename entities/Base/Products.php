<?php

namespace entities\Base;

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
use entities\BrandCompetition as ChildBrandCompetition;
use entities\BrandCompetitionQuery as ChildBrandCompetitionQuery;
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Categories as ChildCategories;
use entities\CategoriesQuery as ChildCategoriesQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Orderlines as ChildOrderlines;
use entities\OrderlinesQuery as ChildOrderlinesQuery;
use entities\OutletStock as ChildOutletStock;
use entities\OutletStockOtherSummary as ChildOutletStockOtherSummary;
use entities\OutletStockOtherSummaryQuery as ChildOutletStockOtherSummaryQuery;
use entities\OutletStockQuery as ChildOutletStockQuery;
use entities\OutletStockSummary as ChildOutletStockSummary;
use entities\OutletStockSummaryQuery as ChildOutletStockSummaryQuery;
use entities\Pricebooklines as ChildPricebooklines;
use entities\PricebooklinesQuery as ChildPricebooklinesQuery;
use entities\Productmedia as ChildProductmedia;
use entities\ProductmediaQuery as ChildProductmediaQuery;
use entities\Products as ChildProducts;
use entities\ProductsQuery as ChildProductsQuery;
use entities\Shippinglines as ChildShippinglines;
use entities\ShippinglinesQuery as ChildShippinglinesQuery;
use entities\StockTransaction as ChildStockTransaction;
use entities\StockTransactionQuery as ChildStockTransactionQuery;
use entities\Tags as ChildTags;
use entities\TagsQuery as ChildTagsQuery;
use entities\Unitmaster as ChildUnitmaster;
use entities\UnitmasterQuery as ChildUnitmasterQuery;
use entities\Map\BrandCompetitionTableMap;
use entities\Map\OrderlinesTableMap;
use entities\Map\OutletStockOtherSummaryTableMap;
use entities\Map\OutletStockSummaryTableMap;
use entities\Map\OutletStockTableMap;
use entities\Map\PricebooklinesTableMap;
use entities\Map\ProductmediaTableMap;
use entities\Map\ProductsTableMap;
use entities\Map\ShippinglinesTableMap;
use entities\Map\StockTransactionTableMap;

/**
 * Base class that represents a row from the 'products' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Products implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ProductsTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the product_name field.
     *
     * @var        string
     */
    protected $product_name;

    /**
     * The value for the product_summary field.
     *
     * @var        string|null
     */
    protected $product_summary;

    /**
     * The value for the product_description field.
     *
     * @var        string|null
     */
    protected $product_description;

    /**
     * The value for the product_sku field.
     *
     * @var        string
     */
    protected $product_sku;

    /**
     * The value for the additional_data field.
     *
     * @var        string|null
     */
    protected $additional_data;

    /**
     * The value for the unit_d field.
     *
     * @var        int|null
     */
    protected $unit_d;

    /**
     * The value for the packing_desc field.
     *
     * @var        string|null
     */
    protected $packing_desc;

    /**
     * The value for the packing_qty field.
     *
     * @var        int|null
     */
    protected $packing_qty;

    /**
     * The value for the category_id field.
     *
     * @var        int|null
     */
    protected $category_id;

    /**
     * The value for the tag_id field.
     *
     * @var        int|null
     */
    protected $tag_id;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the product_images field.
     *
     * @var        string|null
     */
    protected $product_images;

    /**
     * The value for the integration_id field.
     *
     * @var        string|null
     */
    protected $integration_id;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * The value for the orgunit_id field.
     *
     * @var        int|null
     */
    protected $orgunit_id;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

    /**
     * The value for the base_price field.
     *
     * @var        string|null
     */
    protected $base_price;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 'active'
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the can_do_rcpa field.
     *
     * Note: this column has a database default value of: 'yes'
     * @var        string|null
     */
    protected $can_do_rcpa;

    /**
     * @var        ChildCategories
     */
    protected $aCategories;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildTags
     */
    protected $aTags;

    /**
     * @var        ChildUnitmaster
     */
    protected $aUnitmaster;

    /**
     * @var        ChildBrands
     */
    protected $aBrands;

    /**
     * @var        ObjectCollection|ChildBrandCompetition[] Collection to store aggregation of ChildBrandCompetition objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCompetition> Collection to store aggregation of ChildBrandCompetition objects.
     */
    protected $collBrandCompetitions;
    protected $collBrandCompetitionsPartial;

    /**
     * @var        ObjectCollection|ChildOrderlines[] Collection to store aggregation of ChildOrderlines objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderlines> Collection to store aggregation of ChildOrderlines objects.
     */
    protected $collOrderliness;
    protected $collOrderlinessPartial;

    /**
     * @var        ObjectCollection|ChildOutletStock[] Collection to store aggregation of ChildOutletStock objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStock> Collection to store aggregation of ChildOutletStock objects.
     */
    protected $collOutletStocks;
    protected $collOutletStocksPartial;

    /**
     * @var        ObjectCollection|ChildOutletStockOtherSummary[] Collection to store aggregation of ChildOutletStockOtherSummary objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStockOtherSummary> Collection to store aggregation of ChildOutletStockOtherSummary objects.
     */
    protected $collOutletStockOtherSummaries;
    protected $collOutletStockOtherSummariesPartial;

    /**
     * @var        ObjectCollection|ChildOutletStockSummary[] Collection to store aggregation of ChildOutletStockSummary objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStockSummary> Collection to store aggregation of ChildOutletStockSummary objects.
     */
    protected $collOutletStockSummaries;
    protected $collOutletStockSummariesPartial;

    /**
     * @var        ObjectCollection|ChildPricebooklines[] Collection to store aggregation of ChildPricebooklines objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPricebooklines> Collection to store aggregation of ChildPricebooklines objects.
     */
    protected $collPricebookliness;
    protected $collPricebooklinessPartial;

    /**
     * @var        ObjectCollection|ChildProductmedia[] Collection to store aggregation of ChildProductmedia objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProductmedia> Collection to store aggregation of ChildProductmedia objects.
     */
    protected $collProductmedias;
    protected $collProductmediasPartial;

    /**
     * @var        ObjectCollection|ChildShippinglines[] Collection to store aggregation of ChildShippinglines objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildShippinglines> Collection to store aggregation of ChildShippinglines objects.
     */
    protected $collShippingliness;
    protected $collShippinglinessPartial;

    /**
     * @var        ObjectCollection|ChildStockTransaction[] Collection to store aggregation of ChildStockTransaction objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStockTransaction> Collection to store aggregation of ChildStockTransaction objects.
     */
    protected $collStockTransactions;
    protected $collStockTransactionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCompetition[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCompetition>
     */
    protected $brandCompetitionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderlines[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderlines>
     */
    protected $orderlinessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletStock[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStock>
     */
    protected $outletStocksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletStockOtherSummary[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStockOtherSummary>
     */
    protected $outletStockOtherSummariesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletStockSummary[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStockSummary>
     */
    protected $outletStockSummariesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPricebooklines[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPricebooklines>
     */
    protected $pricebooklinessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductmedia[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProductmedia>
     */
    protected $productmediasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildShippinglines[]
     * @phpstan-var ObjectCollection&\Traversable<ChildShippinglines>
     */
    protected $shippinglinessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStockTransaction[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStockTransaction>
     */
    protected $stockTransactionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->status = 'active';
        $this->can_do_rcpa = 'yes';
    }

    /**
     * Initializes internal state of entities\Base\Products object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Products</code> instance.  If
     * <code>obj</code> is an instance of <code>Products</code>, delegates to
     * <code>equals(Products)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
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
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [product_name] column value.
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * Get the [product_summary] column value.
     *
     * @return string|null
     */
    public function getProductSummary()
    {
        return $this->product_summary;
    }

    /**
     * Get the [product_description] column value.
     *
     * @return string|null
     */
    public function getProductDescription()
    {
        return $this->product_description;
    }

    /**
     * Get the [product_sku] column value.
     *
     * @return string
     */
    public function getProductSku()
    {
        return $this->product_sku;
    }

    /**
     * Get the [additional_data] column value.
     *
     * @return string|null
     */
    public function getAdditionalData()
    {
        return $this->additional_data;
    }

    /**
     * Get the [unit_d] column value.
     *
     * @return int|null
     */
    public function getUnitD()
    {
        return $this->unit_d;
    }

    /**
     * Get the [packing_desc] column value.
     *
     * @return string|null
     */
    public function getPackingDesc()
    {
        return $this->packing_desc;
    }

    /**
     * Get the [packing_qty] column value.
     *
     * @return int|null
     */
    public function getPackingQty()
    {
        return $this->packing_qty;
    }

    /**
     * Get the [category_id] column value.
     *
     * @return int|null
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Get the [tag_id] column value.
     *
     * @return int|null
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [product_images] column value.
     *
     * @return string|null
     */
    public function getProductImages()
    {
        return $this->product_images;
    }

    /**
     * Get the [integration_id] column value.
     *
     * @return string|null
     */
    public function getIntegrationId()
    {
        return $this->integration_id;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Get the [orgunit_id] column value.
     *
     * @return int|null
     */
    public function getOrgunitId()
    {
        return $this->orgunit_id;
    }

    /**
     * Get the [brand_id] column value.
     *
     * @return int|null
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Get the [base_price] column value.
     *
     * @return string|null
     */
    public function getBasePrice()
    {
        return $this->base_price;
    }

    /**
     * Get the [status] column value.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [can_do_rcpa] column value.
     *
     * @return string|null
     */
    public function getCanDoRcpa()
    {
        return $this->can_do_rcpa;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ProductsTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_name !== $v) {
            $this->product_name = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_summary] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductSummary($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_summary !== $v) {
            $this->product_summary = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCT_SUMMARY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_description] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_description !== $v) {
            $this->product_description = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCT_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_sku] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_sku !== $v) {
            $this->product_sku = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCT_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [additional_data] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAdditionalData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->additional_data !== $v) {
            $this->additional_data = $v;
            $this->modifiedColumns[ProductsTableMap::COL_ADDITIONAL_DATA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unit_d] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUnitD($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->unit_d !== $v) {
            $this->unit_d = $v;
            $this->modifiedColumns[ProductsTableMap::COL_UNIT_D] = true;
        }

        if ($this->aUnitmaster !== null && $this->aUnitmaster->getUnitId() !== $v) {
            $this->aUnitmaster = null;
        }

        return $this;
    }

    /**
     * Set the value of [packing_desc] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPackingDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->packing_desc !== $v) {
            $this->packing_desc = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PACKING_DESC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [packing_qty] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPackingQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->packing_qty !== $v) {
            $this->packing_qty = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PACKING_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [category_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->category_id !== $v) {
            $this->category_id = $v;
            $this->modifiedColumns[ProductsTableMap::COL_CATEGORY_ID] = true;
        }

        if ($this->aCategories !== null && $this->aCategories->getId() !== $v) {
            $this->aCategories = null;
        }

        return $this;
    }

    /**
     * Set the value of [tag_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTagId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->tag_id !== $v) {
            $this->tag_id = $v;
            $this->modifiedColumns[ProductsTableMap::COL_TAG_ID] = true;
        }

        if ($this->aTags !== null && $this->aTags->getId() !== $v) {
            $this->aTags = null;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[ProductsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [product_images] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductImages($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_images !== $v) {
            $this->product_images = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCT_IMAGES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [integration_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntegrationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->integration_id !== $v) {
            $this->integration_id = $v;
            $this->modifiedColumns[ProductsTableMap::COL_INTEGRATION_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductsTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [orgunit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunit_id !== $v) {
            $this->orgunit_id = $v;
            $this->modifiedColumns[ProductsTableMap::COL_ORGUNIT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[ProductsTableMap::COL_BRAND_ID] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getBrandId() !== $v) {
            $this->aBrands = null;
        }

        return $this;
    }

    /**
     * Set the value of [base_price] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBasePrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->base_price !== $v) {
            $this->base_price = $v;
            $this->modifiedColumns[ProductsTableMap::COL_BASE_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[ProductsTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [can_do_rcpa] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCanDoRcpa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_do_rcpa !== $v) {
            $this->can_do_rcpa = $v;
            $this->modifiedColumns[ProductsTableMap::COL_CAN_DO_RCPA] = true;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->status !== 'active') {
                return false;
            }

            if ($this->can_do_rcpa !== 'yes') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductsTableMap::translateFieldName('ProductName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductsTableMap::translateFieldName('ProductSummary', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_summary = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductsTableMap::translateFieldName('ProductDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductsTableMap::translateFieldName('ProductSku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductsTableMap::translateFieldName('AdditionalData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->additional_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductsTableMap::translateFieldName('UnitD', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_d = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProductsTableMap::translateFieldName('PackingDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->packing_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProductsTableMap::translateFieldName('PackingQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->packing_qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProductsTableMap::translateFieldName('CategoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ProductsTableMap::translateFieldName('TagId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tag_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ProductsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ProductsTableMap::translateFieldName('ProductImages', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_images = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ProductsTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ProductsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ProductsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ProductsTableMap::translateFieldName('OrgunitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ProductsTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ProductsTableMap::translateFieldName('BasePrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->base_price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ProductsTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ProductsTableMap::translateFieldName('CanDoRcpa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_do_rcpa = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 21; // 21 = ProductsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Products'), 0, $e);
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
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aUnitmaster !== null && $this->unit_d !== $this->aUnitmaster->getUnitId()) {
            $this->aUnitmaster = null;
        }
        if ($this->aCategories !== null && $this->category_id !== $this->aCategories->getId()) {
            $this->aCategories = null;
        }
        if ($this->aTags !== null && $this->tag_id !== $this->aTags->getId()) {
            $this->aTags = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aBrands !== null && $this->brand_id !== $this->aBrands->getBrandId()) {
            $this->aBrands = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCategories = null;
            $this->aCompany = null;
            $this->aTags = null;
            $this->aUnitmaster = null;
            $this->aBrands = null;
            $this->collBrandCompetitions = null;

            $this->collOrderliness = null;

            $this->collOutletStocks = null;

            $this->collOutletStockOtherSummaries = null;

            $this->collOutletStockSummaries = null;

            $this->collPricebookliness = null;

            $this->collProductmedias = null;

            $this->collShippingliness = null;

            $this->collStockTransactions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Products::setDeleted()
     * @see Products::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductsQuery::create()
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
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
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
                ProductsTableMap::addInstanceToPool($this);
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
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCategories !== null) {
                if ($this->aCategories->isModified() || $this->aCategories->isNew()) {
                    $affectedRows += $this->aCategories->save($con);
                }
                $this->setCategories($this->aCategories);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aTags !== null) {
                if ($this->aTags->isModified() || $this->aTags->isNew()) {
                    $affectedRows += $this->aTags->save($con);
                }
                $this->setTags($this->aTags);
            }

            if ($this->aUnitmaster !== null) {
                if ($this->aUnitmaster->isModified() || $this->aUnitmaster->isNew()) {
                    $affectedRows += $this->aUnitmaster->save($con);
                }
                $this->setUnitmaster($this->aUnitmaster);
            }

            if ($this->aBrands !== null) {
                if ($this->aBrands->isModified() || $this->aBrands->isNew()) {
                    $affectedRows += $this->aBrands->save($con);
                }
                $this->setBrands($this->aBrands);
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

            if ($this->brandCompetitionsScheduledForDeletion !== null) {
                if (!$this->brandCompetitionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCompetitionsScheduledForDeletion as $brandCompetition) {
                        // need to save related object because we set the relation to null
                        $brandCompetition->save($con);
                    }
                    $this->brandCompetitionsScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCompetitions !== null) {
                foreach ($this->collBrandCompetitions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderlinessScheduledForDeletion !== null) {
                if (!$this->orderlinessScheduledForDeletion->isEmpty()) {
                    \entities\OrderlinesQuery::create()
                        ->filterByPrimaryKeys($this->orderlinessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderlinessScheduledForDeletion = null;
                }
            }

            if ($this->collOrderliness !== null) {
                foreach ($this->collOrderliness as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletStocksScheduledForDeletion !== null) {
                if (!$this->outletStocksScheduledForDeletion->isEmpty()) {
                    \entities\OutletStockQuery::create()
                        ->filterByPrimaryKeys($this->outletStocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->outletStocksScheduledForDeletion = null;
                }
            }

            if ($this->collOutletStocks !== null) {
                foreach ($this->collOutletStocks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletStockOtherSummariesScheduledForDeletion !== null) {
                if (!$this->outletStockOtherSummariesScheduledForDeletion->isEmpty()) {
                    \entities\OutletStockOtherSummaryQuery::create()
                        ->filterByPrimaryKeys($this->outletStockOtherSummariesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->outletStockOtherSummariesScheduledForDeletion = null;
                }
            }

            if ($this->collOutletStockOtherSummaries !== null) {
                foreach ($this->collOutletStockOtherSummaries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletStockSummariesScheduledForDeletion !== null) {
                if (!$this->outletStockSummariesScheduledForDeletion->isEmpty()) {
                    \entities\OutletStockSummaryQuery::create()
                        ->filterByPrimaryKeys($this->outletStockSummariesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->outletStockSummariesScheduledForDeletion = null;
                }
            }

            if ($this->collOutletStockSummaries !== null) {
                foreach ($this->collOutletStockSummaries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pricebooklinessScheduledForDeletion !== null) {
                if (!$this->pricebooklinessScheduledForDeletion->isEmpty()) {
                    \entities\PricebooklinesQuery::create()
                        ->filterByPrimaryKeys($this->pricebooklinessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pricebooklinessScheduledForDeletion = null;
                }
            }

            if ($this->collPricebookliness !== null) {
                foreach ($this->collPricebookliness as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productmediasScheduledForDeletion !== null) {
                if (!$this->productmediasScheduledForDeletion->isEmpty()) {
                    \entities\ProductmediaQuery::create()
                        ->filterByPrimaryKeys($this->productmediasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productmediasScheduledForDeletion = null;
                }
            }

            if ($this->collProductmedias !== null) {
                foreach ($this->collProductmedias as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shippinglinessScheduledForDeletion !== null) {
                if (!$this->shippinglinessScheduledForDeletion->isEmpty()) {
                    \entities\ShippinglinesQuery::create()
                        ->filterByPrimaryKeys($this->shippinglinessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->shippinglinessScheduledForDeletion = null;
                }
            }

            if ($this->collShippingliness !== null) {
                foreach ($this->collShippingliness as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockTransactionsScheduledForDeletion !== null) {
                if (!$this->stockTransactionsScheduledForDeletion->isEmpty()) {
                    \entities\StockTransactionQuery::create()
                        ->filterByPrimaryKeys($this->stockTransactionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockTransactionsScheduledForDeletion = null;
                }
            }

            if ($this->collStockTransactions !== null) {
                foreach ($this->collStockTransactions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[ProductsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProductsTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('products_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'product_name';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_SUMMARY)) {
            $modifiedColumns[':p' . $index++]  = 'product_summary';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'product_description';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'product_sku';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_ADDITIONAL_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'additional_data';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_UNIT_D)) {
            $modifiedColumns[':p' . $index++]  = 'unit_d';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PACKING_DESC)) {
            $modifiedColumns[':p' . $index++]  = 'packing_desc';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PACKING_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'packing_qty';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'category_id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_TAG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'tag_id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_IMAGES)) {
            $modifiedColumns[':p' . $index++]  = 'product_images';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_INTEGRATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'integration_id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_ORGUNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunit_id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BASE_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'base_price';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_CAN_DO_RCPA)) {
            $modifiedColumns[':p' . $index++]  = 'can_do_rcpa';
        }

        $sql = sprintf(
            'INSERT INTO products (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);

                        break;
                    case 'product_name':
                        $stmt->bindValue($identifier, $this->product_name, PDO::PARAM_STR);

                        break;
                    case 'product_summary':
                        $stmt->bindValue($identifier, $this->product_summary, PDO::PARAM_STR);

                        break;
                    case 'product_description':
                        $stmt->bindValue($identifier, $this->product_description, PDO::PARAM_STR);

                        break;
                    case 'product_sku':
                        $stmt->bindValue($identifier, $this->product_sku, PDO::PARAM_STR);

                        break;
                    case 'additional_data':
                        $stmt->bindValue($identifier, $this->additional_data, PDO::PARAM_STR);

                        break;
                    case 'unit_d':
                        $stmt->bindValue($identifier, $this->unit_d, PDO::PARAM_INT);

                        break;
                    case 'packing_desc':
                        $stmt->bindValue($identifier, $this->packing_desc, PDO::PARAM_STR);

                        break;
                    case 'packing_qty':
                        $stmt->bindValue($identifier, $this->packing_qty, PDO::PARAM_INT);

                        break;
                    case 'category_id':
                        $stmt->bindValue($identifier, $this->category_id, PDO::PARAM_INT);

                        break;
                    case 'tag_id':
                        $stmt->bindValue($identifier, $this->tag_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'product_images':
                        $stmt->bindValue($identifier, $this->product_images, PDO::PARAM_STR);

                        break;
                    case 'integration_id':
                        $stmt->bindValue($identifier, $this->integration_id, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'orgunit_id':
                        $stmt->bindValue($identifier, $this->orgunit_id, PDO::PARAM_INT);

                        break;
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);

                        break;
                    case 'base_price':
                        $stmt->bindValue($identifier, $this->base_price, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'can_do_rcpa':
                        $stmt->bindValue($identifier, $this->can_do_rcpa, PDO::PARAM_STR);

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
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();

            case 1:
                return $this->getProductName();

            case 2:
                return $this->getProductSummary();

            case 3:
                return $this->getProductDescription();

            case 4:
                return $this->getProductSku();

            case 5:
                return $this->getAdditionalData();

            case 6:
                return $this->getUnitD();

            case 7:
                return $this->getPackingDesc();

            case 8:
                return $this->getPackingQty();

            case 9:
                return $this->getCategoryId();

            case 10:
                return $this->getTagId();

            case 11:
                return $this->getCompanyId();

            case 12:
                return $this->getProductImages();

            case 13:
                return $this->getIntegrationId();

            case 14:
                return $this->getCreatedAt();

            case 15:
                return $this->getUpdatedAt();

            case 16:
                return $this->getOrgunitId();

            case 17:
                return $this->getBrandId();

            case 18:
                return $this->getBasePrice();

            case 19:
                return $this->getStatus();

            case 20:
                return $this->getCanDoRcpa();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['Products'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Products'][$this->hashCode()] = true;
        $keys = ProductsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getProductName(),
            $keys[2] => $this->getProductSummary(),
            $keys[3] => $this->getProductDescription(),
            $keys[4] => $this->getProductSku(),
            $keys[5] => $this->getAdditionalData(),
            $keys[6] => $this->getUnitD(),
            $keys[7] => $this->getPackingDesc(),
            $keys[8] => $this->getPackingQty(),
            $keys[9] => $this->getCategoryId(),
            $keys[10] => $this->getTagId(),
            $keys[11] => $this->getCompanyId(),
            $keys[12] => $this->getProductImages(),
            $keys[13] => $this->getIntegrationId(),
            $keys[14] => $this->getCreatedAt(),
            $keys[15] => $this->getUpdatedAt(),
            $keys[16] => $this->getOrgunitId(),
            $keys[17] => $this->getBrandId(),
            $keys[18] => $this->getBasePrice(),
            $keys[19] => $this->getStatus(),
            $keys[20] => $this->getCanDoRcpa(),
        ];
        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'categories';
                        break;
                    default:
                        $key = 'Categories';
                }

                $result[$key] = $this->aCategories->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCompany) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'company';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'company';
                        break;
                    default:
                        $key = 'Company';
                }

                $result[$key] = $this->aCompany->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTags) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tags';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tags';
                        break;
                    default:
                        $key = 'Tags';
                }

                $result[$key] = $this->aTags->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUnitmaster) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'unitmaster';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'unitmaster';
                        break;
                    default:
                        $key = 'Unitmaster';
                }

                $result[$key] = $this->aUnitmaster->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBrands) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brands';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brands';
                        break;
                    default:
                        $key = 'Brands';
                }

                $result[$key] = $this->aBrands->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBrandCompetitions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCompetitions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_competitions';
                        break;
                    default:
                        $key = 'BrandCompetitions';
                }

                $result[$key] = $this->collBrandCompetitions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderliness) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderliness';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderliness';
                        break;
                    default:
                        $key = 'Orderliness';
                }

                $result[$key] = $this->collOrderliness->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletStocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletStocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_stocks';
                        break;
                    default:
                        $key = 'OutletStocks';
                }

                $result[$key] = $this->collOutletStocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletStockOtherSummaries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletStockOtherSummaries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_stock_other_summaries';
                        break;
                    default:
                        $key = 'OutletStockOtherSummaries';
                }

                $result[$key] = $this->collOutletStockOtherSummaries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletStockSummaries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletStockSummaries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_stock_summaries';
                        break;
                    default:
                        $key = 'OutletStockSummaries';
                }

                $result[$key] = $this->collOutletStockSummaries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPricebookliness) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pricebookliness';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pricebookliness';
                        break;
                    default:
                        $key = 'Pricebookliness';
                }

                $result[$key] = $this->collPricebookliness->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductmedias) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productmedias';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'productmedias';
                        break;
                    default:
                        $key = 'Productmedias';
                }

                $result[$key] = $this->collProductmedias->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collShippingliness) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'shippingliness';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'shippingliness';
                        break;
                    default:
                        $key = 'Shippingliness';
                }

                $result[$key] = $this->collShippingliness->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockTransactions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stockTransactions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stock_transactions';
                        break;
                    default:
                        $key = 'StockTransactions';
                }

                $result[$key] = $this->collStockTransactions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setProductName($value);
                break;
            case 2:
                $this->setProductSummary($value);
                break;
            case 3:
                $this->setProductDescription($value);
                break;
            case 4:
                $this->setProductSku($value);
                break;
            case 5:
                $this->setAdditionalData($value);
                break;
            case 6:
                $this->setUnitD($value);
                break;
            case 7:
                $this->setPackingDesc($value);
                break;
            case 8:
                $this->setPackingQty($value);
                break;
            case 9:
                $this->setCategoryId($value);
                break;
            case 10:
                $this->setTagId($value);
                break;
            case 11:
                $this->setCompanyId($value);
                break;
            case 12:
                $this->setProductImages($value);
                break;
            case 13:
                $this->setIntegrationId($value);
                break;
            case 14:
                $this->setCreatedAt($value);
                break;
            case 15:
                $this->setUpdatedAt($value);
                break;
            case 16:
                $this->setOrgunitId($value);
                break;
            case 17:
                $this->setBrandId($value);
                break;
            case 18:
                $this->setBasePrice($value);
                break;
            case 19:
                $this->setStatus($value);
                break;
            case 20:
                $this->setCanDoRcpa($value);
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
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ProductsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setProductName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setProductSummary($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setProductDescription($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setProductSku($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAdditionalData($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUnitD($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPackingDesc($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPackingQty($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCategoryId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setTagId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCompanyId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setProductImages($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setIntegrationId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCreatedAt($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setUpdatedAt($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setOrgunitId($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setBrandId($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setBasePrice($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setStatus($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setCanDoRcpa($arr[$keys[20]]);
        }

        return $this;
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
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
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
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(ProductsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductsTableMap::COL_ID)) {
            $criteria->add(ProductsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_NAME)) {
            $criteria->add(ProductsTableMap::COL_PRODUCT_NAME, $this->product_name);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_SUMMARY)) {
            $criteria->add(ProductsTableMap::COL_PRODUCT_SUMMARY, $this->product_summary);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_DESCRIPTION)) {
            $criteria->add(ProductsTableMap::COL_PRODUCT_DESCRIPTION, $this->product_description);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_SKU)) {
            $criteria->add(ProductsTableMap::COL_PRODUCT_SKU, $this->product_sku);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_ADDITIONAL_DATA)) {
            $criteria->add(ProductsTableMap::COL_ADDITIONAL_DATA, $this->additional_data);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_UNIT_D)) {
            $criteria->add(ProductsTableMap::COL_UNIT_D, $this->unit_d);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PACKING_DESC)) {
            $criteria->add(ProductsTableMap::COL_PACKING_DESC, $this->packing_desc);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PACKING_QTY)) {
            $criteria->add(ProductsTableMap::COL_PACKING_QTY, $this->packing_qty);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_CATEGORY_ID)) {
            $criteria->add(ProductsTableMap::COL_CATEGORY_ID, $this->category_id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_TAG_ID)) {
            $criteria->add(ProductsTableMap::COL_TAG_ID, $this->tag_id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_COMPANY_ID)) {
            $criteria->add(ProductsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCT_IMAGES)) {
            $criteria->add(ProductsTableMap::COL_PRODUCT_IMAGES, $this->product_images);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(ProductsTableMap::COL_INTEGRATION_ID, $this->integration_id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_CREATED_AT)) {
            $criteria->add(ProductsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_UPDATED_AT)) {
            $criteria->add(ProductsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_ORGUNIT_ID)) {
            $criteria->add(ProductsTableMap::COL_ORGUNIT_ID, $this->orgunit_id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BRAND_ID)) {
            $criteria->add(ProductsTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BASE_PRICE)) {
            $criteria->add(ProductsTableMap::COL_BASE_PRICE, $this->base_price);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_STATUS)) {
            $criteria->add(ProductsTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_CAN_DO_RCPA)) {
            $criteria->add(ProductsTableMap::COL_CAN_DO_RCPA, $this->can_do_rcpa);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildProductsQuery::create();
        $criteria->add(ProductsTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
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
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Products (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setProductName($this->getProductName());
        $copyObj->setProductSummary($this->getProductSummary());
        $copyObj->setProductDescription($this->getProductDescription());
        $copyObj->setProductSku($this->getProductSku());
        $copyObj->setAdditionalData($this->getAdditionalData());
        $copyObj->setUnitD($this->getUnitD());
        $copyObj->setPackingDesc($this->getPackingDesc());
        $copyObj->setPackingQty($this->getPackingQty());
        $copyObj->setCategoryId($this->getCategoryId());
        $copyObj->setTagId($this->getTagId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setProductImages($this->getProductImages());
        $copyObj->setIntegrationId($this->getIntegrationId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOrgunitId($this->getOrgunitId());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setBasePrice($this->getBasePrice());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCanDoRcpa($this->getCanDoRcpa());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCompetitions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCompetition($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderliness() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderlines($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletStocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletStock($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletStockOtherSummaries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletStockOtherSummary($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletStockSummaries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletStockSummary($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPricebookliness() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPricebooklines($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductmedias() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductmedia($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShippingliness() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShippinglines($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockTransactions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockTransaction($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \entities\Products Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildCategories object.
     *
     * @param ChildCategories|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCategories(ChildCategories $v = null)
    {
        if ($v === null) {
            $this->setCategoryId(NULL);
        } else {
            $this->setCategoryId($v->getId());
        }

        $this->aCategories = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCategories object, it will not be re-added.
        if ($v !== null) {
            $v->addProducts($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCategories object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCategories|null The associated ChildCategories object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCategories(?ConnectionInterface $con = null)
    {
        if ($this->aCategories === null && ($this->category_id != 0)) {
            $this->aCategories = ChildCategoriesQuery::create()->findPk($this->category_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategories->addProductss($this);
             */
        }

        return $this->aCategories;
    }

    /**
     * Declares an association between this object and a ChildCompany object.
     *
     * @param ChildCompany $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompany(ChildCompany $v = null)
    {
        if ($v === null) {
            $this->setCompanyId(NULL);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addProducts($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany The associated ChildCompany object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompany(?ConnectionInterface $con = null)
    {
        if ($this->aCompany === null && ($this->company_id != 0)) {
            $this->aCompany = ChildCompanyQuery::create()->findPk($this->company_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompany->addProductss($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildTags object.
     *
     * @param ChildTags|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setTags(ChildTags $v = null)
    {
        if ($v === null) {
            $this->setTagId(NULL);
        } else {
            $this->setTagId($v->getId());
        }

        $this->aTags = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTags object, it will not be re-added.
        if ($v !== null) {
            $v->addProducts($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTags object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildTags|null The associated ChildTags object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTags(?ConnectionInterface $con = null)
    {
        if ($this->aTags === null && ($this->tag_id != 0)) {
            $this->aTags = ChildTagsQuery::create()->findPk($this->tag_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTags->addProductss($this);
             */
        }

        return $this->aTags;
    }

    /**
     * Declares an association between this object and a ChildUnitmaster object.
     *
     * @param ChildUnitmaster|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUnitmaster(ChildUnitmaster $v = null)
    {
        if ($v === null) {
            $this->setUnitD(NULL);
        } else {
            $this->setUnitD($v->getUnitId());
        }

        $this->aUnitmaster = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUnitmaster object, it will not be re-added.
        if ($v !== null) {
            $v->addProducts($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUnitmaster object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUnitmaster|null The associated ChildUnitmaster object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUnitmaster(?ConnectionInterface $con = null)
    {
        if ($this->aUnitmaster === null && ($this->unit_d != 0)) {
            $this->aUnitmaster = ChildUnitmasterQuery::create()->findPk($this->unit_d, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUnitmaster->addProductss($this);
             */
        }

        return $this->aUnitmaster;
    }

    /**
     * Declares an association between this object and a ChildBrands object.
     *
     * @param ChildBrands|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBrands(ChildBrands $v = null)
    {
        if ($v === null) {
            $this->setBrandId(NULL);
        } else {
            $this->setBrandId($v->getBrandId());
        }

        $this->aBrands = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrands object, it will not be re-added.
        if ($v !== null) {
            $v->addProducts($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBrands object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBrands|null The associated ChildBrands object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrands(?ConnectionInterface $con = null)
    {
        if ($this->aBrands === null && ($this->brand_id != 0)) {
            $this->aBrands = ChildBrandsQuery::create()->findPk($this->brand_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrands->addProductss($this);
             */
        }

        return $this->aBrands;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('BrandCompetition' === $relationName) {
            $this->initBrandCompetitions();
            return;
        }
        if ('Orderlines' === $relationName) {
            $this->initOrderliness();
            return;
        }
        if ('OutletStock' === $relationName) {
            $this->initOutletStocks();
            return;
        }
        if ('OutletStockOtherSummary' === $relationName) {
            $this->initOutletStockOtherSummaries();
            return;
        }
        if ('OutletStockSummary' === $relationName) {
            $this->initOutletStockSummaries();
            return;
        }
        if ('Pricebooklines' === $relationName) {
            $this->initPricebookliness();
            return;
        }
        if ('Productmedia' === $relationName) {
            $this->initProductmedias();
            return;
        }
        if ('Shippinglines' === $relationName) {
            $this->initShippingliness();
            return;
        }
        if ('StockTransaction' === $relationName) {
            $this->initStockTransactions();
            return;
        }
    }

    /**
     * Clears out the collBrandCompetitions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCompetitions()
     */
    public function clearBrandCompetitions()
    {
        $this->collBrandCompetitions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCompetitions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCompetitions($v = true): void
    {
        $this->collBrandCompetitionsPartial = $v;
    }

    /**
     * Initializes the collBrandCompetitions collection.
     *
     * By default this just sets the collBrandCompetitions collection to an empty array (like clearcollBrandCompetitions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCompetitions(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCompetitions && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCompetitionTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCompetitions = new $collectionClassName;
        $this->collBrandCompetitions->setModel('\entities\BrandCompetition');
    }

    /**
     * Gets an array of ChildBrandCompetition objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition> List of ChildBrandCompetition objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCompetitions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCompetitionsPartial && !$this->isNew();
        if (null === $this->collBrandCompetitions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCompetitions) {
                    $this->initBrandCompetitions();
                } else {
                    $collectionClassName = BrandCompetitionTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCompetitions = new $collectionClassName;
                    $collBrandCompetitions->setModel('\entities\BrandCompetition');

                    return $collBrandCompetitions;
                }
            } else {
                $collBrandCompetitions = ChildBrandCompetitionQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCompetitionsPartial && count($collBrandCompetitions)) {
                        $this->initBrandCompetitions(false);

                        foreach ($collBrandCompetitions as $obj) {
                            if (false == $this->collBrandCompetitions->contains($obj)) {
                                $this->collBrandCompetitions->append($obj);
                            }
                        }

                        $this->collBrandCompetitionsPartial = true;
                    }

                    return $collBrandCompetitions;
                }

                if ($partial && $this->collBrandCompetitions) {
                    foreach ($this->collBrandCompetitions as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCompetitions[] = $obj;
                        }
                    }
                }

                $this->collBrandCompetitions = $collBrandCompetitions;
                $this->collBrandCompetitionsPartial = false;
            }
        }

        return $this->collBrandCompetitions;
    }

    /**
     * Sets a collection of ChildBrandCompetition objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCompetitions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCompetitions(Collection $brandCompetitions, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCompetition[] $brandCompetitionsToDelete */
        $brandCompetitionsToDelete = $this->getBrandCompetitions(new Criteria(), $con)->diff($brandCompetitions);


        $this->brandCompetitionsScheduledForDeletion = $brandCompetitionsToDelete;

        foreach ($brandCompetitionsToDelete as $brandCompetitionRemoved) {
            $brandCompetitionRemoved->setProducts(null);
        }

        $this->collBrandCompetitions = null;
        foreach ($brandCompetitions as $brandCompetition) {
            $this->addBrandCompetition($brandCompetition);
        }

        $this->collBrandCompetitions = $brandCompetitions;
        $this->collBrandCompetitionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCompetition objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCompetition objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCompetitions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCompetitionsPartial && !$this->isNew();
        if (null === $this->collBrandCompetitions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCompetitions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCompetitions());
            }

            $query = ChildBrandCompetitionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collBrandCompetitions);
    }

    /**
     * Method called to associate a ChildBrandCompetition object to this object
     * through the ChildBrandCompetition foreign key attribute.
     *
     * @param ChildBrandCompetition $l ChildBrandCompetition
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCompetition(ChildBrandCompetition $l)
    {
        if ($this->collBrandCompetitions === null) {
            $this->initBrandCompetitions();
            $this->collBrandCompetitionsPartial = true;
        }

        if (!$this->collBrandCompetitions->contains($l)) {
            $this->doAddBrandCompetition($l);

            if ($this->brandCompetitionsScheduledForDeletion and $this->brandCompetitionsScheduledForDeletion->contains($l)) {
                $this->brandCompetitionsScheduledForDeletion->remove($this->brandCompetitionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCompetition $brandCompetition The ChildBrandCompetition object to add.
     */
    protected function doAddBrandCompetition(ChildBrandCompetition $brandCompetition): void
    {
        $this->collBrandCompetitions[]= $brandCompetition;
        $brandCompetition->setProducts($this);
    }

    /**
     * @param ChildBrandCompetition $brandCompetition The ChildBrandCompetition object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCompetition(ChildBrandCompetition $brandCompetition)
    {
        if ($this->getBrandCompetitions()->contains($brandCompetition)) {
            $pos = $this->collBrandCompetitions->search($brandCompetition);
            $this->collBrandCompetitions->remove($pos);
            if (null === $this->brandCompetitionsScheduledForDeletion) {
                $this->brandCompetitionsScheduledForDeletion = clone $this->collBrandCompetitions;
                $this->brandCompetitionsScheduledForDeletion->clear();
            }
            $this->brandCompetitionsScheduledForDeletion[]= $brandCompetition;
            $brandCompetition->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition}> List of ChildBrandCompetition objects
     */
    public function getBrandCompetitionsJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCompetitionQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getBrandCompetitions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition}> List of ChildBrandCompetition objects
     */
    public function getBrandCompetitionsJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCompetitionQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getBrandCompetitions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition}> List of ChildBrandCompetition objects
     */
    public function getBrandCompetitionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCompetitionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCompetitions($query, $con);
    }

    /**
     * Clears out the collOrderliness collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderliness()
     */
    public function clearOrderliness()
    {
        $this->collOrderliness = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderliness collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderliness($v = true): void
    {
        $this->collOrderlinessPartial = $v;
    }

    /**
     * Initializes the collOrderliness collection.
     *
     * By default this just sets the collOrderliness collection to an empty array (like clearcollOrderliness());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderliness(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderliness && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderlinesTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderliness = new $collectionClassName;
        $this->collOrderliness->setModel('\entities\Orderlines');
    }

    /**
     * Gets an array of ChildOrderlines objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderlines[] List of ChildOrderlines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderlines> List of ChildOrderlines objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderliness(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderlinessPartial && !$this->isNew();
        if (null === $this->collOrderliness || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderliness) {
                    $this->initOrderliness();
                } else {
                    $collectionClassName = OrderlinesTableMap::getTableMap()->getCollectionClassName();

                    $collOrderliness = new $collectionClassName;
                    $collOrderliness->setModel('\entities\Orderlines');

                    return $collOrderliness;
                }
            } else {
                $collOrderliness = ChildOrderlinesQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderlinessPartial && count($collOrderliness)) {
                        $this->initOrderliness(false);

                        foreach ($collOrderliness as $obj) {
                            if (false == $this->collOrderliness->contains($obj)) {
                                $this->collOrderliness->append($obj);
                            }
                        }

                        $this->collOrderlinessPartial = true;
                    }

                    return $collOrderliness;
                }

                if ($partial && $this->collOrderliness) {
                    foreach ($this->collOrderliness as $obj) {
                        if ($obj->isNew()) {
                            $collOrderliness[] = $obj;
                        }
                    }
                }

                $this->collOrderliness = $collOrderliness;
                $this->collOrderlinessPartial = false;
            }
        }

        return $this->collOrderliness;
    }

    /**
     * Sets a collection of ChildOrderlines objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderliness A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderliness(Collection $orderliness, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrderlines[] $orderlinessToDelete */
        $orderlinessToDelete = $this->getOrderliness(new Criteria(), $con)->diff($orderliness);


        $this->orderlinessScheduledForDeletion = $orderlinessToDelete;

        foreach ($orderlinessToDelete as $orderlinesRemoved) {
            $orderlinesRemoved->setProducts(null);
        }

        $this->collOrderliness = null;
        foreach ($orderliness as $orderlines) {
            $this->addOrderlines($orderlines);
        }

        $this->collOrderliness = $orderliness;
        $this->collOrderlinessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orderlines objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Orderlines objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderliness(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderlinessPartial && !$this->isNew();
        if (null === $this->collOrderliness || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderliness) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderliness());
            }

            $query = ChildOrderlinesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collOrderliness);
    }

    /**
     * Method called to associate a ChildOrderlines object to this object
     * through the ChildOrderlines foreign key attribute.
     *
     * @param ChildOrderlines $l ChildOrderlines
     * @return $this The current object (for fluent API support)
     */
    public function addOrderlines(ChildOrderlines $l)
    {
        if ($this->collOrderliness === null) {
            $this->initOrderliness();
            $this->collOrderlinessPartial = true;
        }

        if (!$this->collOrderliness->contains($l)) {
            $this->doAddOrderlines($l);

            if ($this->orderlinessScheduledForDeletion and $this->orderlinessScheduledForDeletion->contains($l)) {
                $this->orderlinessScheduledForDeletion->remove($this->orderlinessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderlines $orderlines The ChildOrderlines object to add.
     */
    protected function doAddOrderlines(ChildOrderlines $orderlines): void
    {
        $this->collOrderliness[]= $orderlines;
        $orderlines->setProducts($this);
    }

    /**
     * @param ChildOrderlines $orderlines The ChildOrderlines object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrderlines(ChildOrderlines $orderlines)
    {
        if ($this->getOrderliness()->contains($orderlines)) {
            $pos = $this->collOrderliness->search($orderlines);
            $this->collOrderliness->remove($pos);
            if (null === $this->orderlinessScheduledForDeletion) {
                $this->orderlinessScheduledForDeletion = clone $this->collOrderliness;
                $this->orderlinessScheduledForDeletion->clear();
            }
            $this->orderlinessScheduledForDeletion[]= clone $orderlines;
            $orderlines->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Orderliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderlines[] List of ChildOrderlines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderlines}> List of ChildOrderlines objects
     */
    public function getOrderlinessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderlinesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Orderliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderlines[] List of ChildOrderlines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderlines}> List of ChildOrderlines objects
     */
    public function getOrderlinessJoinOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderlinesQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getOrderliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Orderliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderlines[] List of ChildOrderlines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderlines}> List of ChildOrderlines objects
     */
    public function getOrderlinessJoinUnitmaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderlinesQuery::create(null, $criteria);
        $query->joinWith('Unitmaster', $joinBehavior);

        return $this->getOrderliness($query, $con);
    }

    /**
     * Clears out the collOutletStocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletStocks()
     */
    public function clearOutletStocks()
    {
        $this->collOutletStocks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletStocks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletStocks($v = true): void
    {
        $this->collOutletStocksPartial = $v;
    }

    /**
     * Initializes the collOutletStocks collection.
     *
     * By default this just sets the collOutletStocks collection to an empty array (like clearcollOutletStocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletStocks(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletStocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletStockTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletStocks = new $collectionClassName;
        $this->collOutletStocks->setModel('\entities\OutletStock');
    }

    /**
     * Gets an array of ChildOutletStock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock> List of ChildOutletStock objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletStocks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletStocksPartial && !$this->isNew();
        if (null === $this->collOutletStocks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletStocks) {
                    $this->initOutletStocks();
                } else {
                    $collectionClassName = OutletStockTableMap::getTableMap()->getCollectionClassName();

                    $collOutletStocks = new $collectionClassName;
                    $collOutletStocks->setModel('\entities\OutletStock');

                    return $collOutletStocks;
                }
            } else {
                $collOutletStocks = ChildOutletStockQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletStocksPartial && count($collOutletStocks)) {
                        $this->initOutletStocks(false);

                        foreach ($collOutletStocks as $obj) {
                            if (false == $this->collOutletStocks->contains($obj)) {
                                $this->collOutletStocks->append($obj);
                            }
                        }

                        $this->collOutletStocksPartial = true;
                    }

                    return $collOutletStocks;
                }

                if ($partial && $this->collOutletStocks) {
                    foreach ($this->collOutletStocks as $obj) {
                        if ($obj->isNew()) {
                            $collOutletStocks[] = $obj;
                        }
                    }
                }

                $this->collOutletStocks = $collOutletStocks;
                $this->collOutletStocksPartial = false;
            }
        }

        return $this->collOutletStocks;
    }

    /**
     * Sets a collection of ChildOutletStock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletStocks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletStocks(Collection $outletStocks, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletStock[] $outletStocksToDelete */
        $outletStocksToDelete = $this->getOutletStocks(new Criteria(), $con)->diff($outletStocks);


        $this->outletStocksScheduledForDeletion = $outletStocksToDelete;

        foreach ($outletStocksToDelete as $outletStockRemoved) {
            $outletStockRemoved->setProducts(null);
        }

        $this->collOutletStocks = null;
        foreach ($outletStocks as $outletStock) {
            $this->addOutletStock($outletStock);
        }

        $this->collOutletStocks = $outletStocks;
        $this->collOutletStocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletStock objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletStock objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletStocks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletStocksPartial && !$this->isNew();
        if (null === $this->collOutletStocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletStocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletStocks());
            }

            $query = ChildOutletStockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collOutletStocks);
    }

    /**
     * Method called to associate a ChildOutletStock object to this object
     * through the ChildOutletStock foreign key attribute.
     *
     * @param ChildOutletStock $l ChildOutletStock
     * @return $this The current object (for fluent API support)
     */
    public function addOutletStock(ChildOutletStock $l)
    {
        if ($this->collOutletStocks === null) {
            $this->initOutletStocks();
            $this->collOutletStocksPartial = true;
        }

        if (!$this->collOutletStocks->contains($l)) {
            $this->doAddOutletStock($l);

            if ($this->outletStocksScheduledForDeletion and $this->outletStocksScheduledForDeletion->contains($l)) {
                $this->outletStocksScheduledForDeletion->remove($this->outletStocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletStock $outletStock The ChildOutletStock object to add.
     */
    protected function doAddOutletStock(ChildOutletStock $outletStock): void
    {
        $this->collOutletStocks[]= $outletStock;
        $outletStock->setProducts($this);
    }

    /**
     * @param ChildOutletStock $outletStock The ChildOutletStock object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletStock(ChildOutletStock $outletStock)
    {
        if ($this->getOutletStocks()->contains($outletStock)) {
            $pos = $this->collOutletStocks->search($outletStock);
            $this->collOutletStocks->remove($pos);
            if (null === $this->outletStocksScheduledForDeletion) {
                $this->outletStocksScheduledForDeletion = clone $this->collOutletStocks;
                $this->outletStocksScheduledForDeletion->clear();
            }
            $this->outletStocksScheduledForDeletion[]= clone $outletStock;
            $outletStock->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }

    /**
     * Clears out the collOutletStockOtherSummaries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletStockOtherSummaries()
     */
    public function clearOutletStockOtherSummaries()
    {
        $this->collOutletStockOtherSummaries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletStockOtherSummaries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletStockOtherSummaries($v = true): void
    {
        $this->collOutletStockOtherSummariesPartial = $v;
    }

    /**
     * Initializes the collOutletStockOtherSummaries collection.
     *
     * By default this just sets the collOutletStockOtherSummaries collection to an empty array (like clearcollOutletStockOtherSummaries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletStockOtherSummaries(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletStockOtherSummaries && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletStockOtherSummaryTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletStockOtherSummaries = new $collectionClassName;
        $this->collOutletStockOtherSummaries->setModel('\entities\OutletStockOtherSummary');
    }

    /**
     * Gets an array of ChildOutletStockOtherSummary objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary> List of ChildOutletStockOtherSummary objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletStockOtherSummaries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletStockOtherSummariesPartial && !$this->isNew();
        if (null === $this->collOutletStockOtherSummaries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletStockOtherSummaries) {
                    $this->initOutletStockOtherSummaries();
                } else {
                    $collectionClassName = OutletStockOtherSummaryTableMap::getTableMap()->getCollectionClassName();

                    $collOutletStockOtherSummaries = new $collectionClassName;
                    $collOutletStockOtherSummaries->setModel('\entities\OutletStockOtherSummary');

                    return $collOutletStockOtherSummaries;
                }
            } else {
                $collOutletStockOtherSummaries = ChildOutletStockOtherSummaryQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletStockOtherSummariesPartial && count($collOutletStockOtherSummaries)) {
                        $this->initOutletStockOtherSummaries(false);

                        foreach ($collOutletStockOtherSummaries as $obj) {
                            if (false == $this->collOutletStockOtherSummaries->contains($obj)) {
                                $this->collOutletStockOtherSummaries->append($obj);
                            }
                        }

                        $this->collOutletStockOtherSummariesPartial = true;
                    }

                    return $collOutletStockOtherSummaries;
                }

                if ($partial && $this->collOutletStockOtherSummaries) {
                    foreach ($this->collOutletStockOtherSummaries as $obj) {
                        if ($obj->isNew()) {
                            $collOutletStockOtherSummaries[] = $obj;
                        }
                    }
                }

                $this->collOutletStockOtherSummaries = $collOutletStockOtherSummaries;
                $this->collOutletStockOtherSummariesPartial = false;
            }
        }

        return $this->collOutletStockOtherSummaries;
    }

    /**
     * Sets a collection of ChildOutletStockOtherSummary objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletStockOtherSummaries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletStockOtherSummaries(Collection $outletStockOtherSummaries, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletStockOtherSummary[] $outletStockOtherSummariesToDelete */
        $outletStockOtherSummariesToDelete = $this->getOutletStockOtherSummaries(new Criteria(), $con)->diff($outletStockOtherSummaries);


        $this->outletStockOtherSummariesScheduledForDeletion = $outletStockOtherSummariesToDelete;

        foreach ($outletStockOtherSummariesToDelete as $outletStockOtherSummaryRemoved) {
            $outletStockOtherSummaryRemoved->setProducts(null);
        }

        $this->collOutletStockOtherSummaries = null;
        foreach ($outletStockOtherSummaries as $outletStockOtherSummary) {
            $this->addOutletStockOtherSummary($outletStockOtherSummary);
        }

        $this->collOutletStockOtherSummaries = $outletStockOtherSummaries;
        $this->collOutletStockOtherSummariesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletStockOtherSummary objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletStockOtherSummary objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletStockOtherSummaries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletStockOtherSummariesPartial && !$this->isNew();
        if (null === $this->collOutletStockOtherSummaries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletStockOtherSummaries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletStockOtherSummaries());
            }

            $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collOutletStockOtherSummaries);
    }

    /**
     * Method called to associate a ChildOutletStockOtherSummary object to this object
     * through the ChildOutletStockOtherSummary foreign key attribute.
     *
     * @param ChildOutletStockOtherSummary $l ChildOutletStockOtherSummary
     * @return $this The current object (for fluent API support)
     */
    public function addOutletStockOtherSummary(ChildOutletStockOtherSummary $l)
    {
        if ($this->collOutletStockOtherSummaries === null) {
            $this->initOutletStockOtherSummaries();
            $this->collOutletStockOtherSummariesPartial = true;
        }

        if (!$this->collOutletStockOtherSummaries->contains($l)) {
            $this->doAddOutletStockOtherSummary($l);

            if ($this->outletStockOtherSummariesScheduledForDeletion and $this->outletStockOtherSummariesScheduledForDeletion->contains($l)) {
                $this->outletStockOtherSummariesScheduledForDeletion->remove($this->outletStockOtherSummariesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletStockOtherSummary $outletStockOtherSummary The ChildOutletStockOtherSummary object to add.
     */
    protected function doAddOutletStockOtherSummary(ChildOutletStockOtherSummary $outletStockOtherSummary): void
    {
        $this->collOutletStockOtherSummaries[]= $outletStockOtherSummary;
        $outletStockOtherSummary->setProducts($this);
    }

    /**
     * @param ChildOutletStockOtherSummary $outletStockOtherSummary The ChildOutletStockOtherSummary object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletStockOtherSummary(ChildOutletStockOtherSummary $outletStockOtherSummary)
    {
        if ($this->getOutletStockOtherSummaries()->contains($outletStockOtherSummary)) {
            $pos = $this->collOutletStockOtherSummaries->search($outletStockOtherSummary);
            $this->collOutletStockOtherSummaries->remove($pos);
            if (null === $this->outletStockOtherSummariesScheduledForDeletion) {
                $this->outletStockOtherSummariesScheduledForDeletion = clone $this->collOutletStockOtherSummaries;
                $this->outletStockOtherSummariesScheduledForDeletion->clear();
            }
            $this->outletStockOtherSummariesScheduledForDeletion[]= clone $outletStockOtherSummary;
            $outletStockOtherSummary->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }

    /**
     * Clears out the collOutletStockSummaries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletStockSummaries()
     */
    public function clearOutletStockSummaries()
    {
        $this->collOutletStockSummaries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletStockSummaries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletStockSummaries($v = true): void
    {
        $this->collOutletStockSummariesPartial = $v;
    }

    /**
     * Initializes the collOutletStockSummaries collection.
     *
     * By default this just sets the collOutletStockSummaries collection to an empty array (like clearcollOutletStockSummaries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletStockSummaries(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletStockSummaries && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletStockSummaryTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletStockSummaries = new $collectionClassName;
        $this->collOutletStockSummaries->setModel('\entities\OutletStockSummary');
    }

    /**
     * Gets an array of ChildOutletStockSummary objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary> List of ChildOutletStockSummary objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletStockSummaries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletStockSummariesPartial && !$this->isNew();
        if (null === $this->collOutletStockSummaries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletStockSummaries) {
                    $this->initOutletStockSummaries();
                } else {
                    $collectionClassName = OutletStockSummaryTableMap::getTableMap()->getCollectionClassName();

                    $collOutletStockSummaries = new $collectionClassName;
                    $collOutletStockSummaries->setModel('\entities\OutletStockSummary');

                    return $collOutletStockSummaries;
                }
            } else {
                $collOutletStockSummaries = ChildOutletStockSummaryQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletStockSummariesPartial && count($collOutletStockSummaries)) {
                        $this->initOutletStockSummaries(false);

                        foreach ($collOutletStockSummaries as $obj) {
                            if (false == $this->collOutletStockSummaries->contains($obj)) {
                                $this->collOutletStockSummaries->append($obj);
                            }
                        }

                        $this->collOutletStockSummariesPartial = true;
                    }

                    return $collOutletStockSummaries;
                }

                if ($partial && $this->collOutletStockSummaries) {
                    foreach ($this->collOutletStockSummaries as $obj) {
                        if ($obj->isNew()) {
                            $collOutletStockSummaries[] = $obj;
                        }
                    }
                }

                $this->collOutletStockSummaries = $collOutletStockSummaries;
                $this->collOutletStockSummariesPartial = false;
            }
        }

        return $this->collOutletStockSummaries;
    }

    /**
     * Sets a collection of ChildOutletStockSummary objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletStockSummaries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletStockSummaries(Collection $outletStockSummaries, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletStockSummary[] $outletStockSummariesToDelete */
        $outletStockSummariesToDelete = $this->getOutletStockSummaries(new Criteria(), $con)->diff($outletStockSummaries);


        $this->outletStockSummariesScheduledForDeletion = $outletStockSummariesToDelete;

        foreach ($outletStockSummariesToDelete as $outletStockSummaryRemoved) {
            $outletStockSummaryRemoved->setProducts(null);
        }

        $this->collOutletStockSummaries = null;
        foreach ($outletStockSummaries as $outletStockSummary) {
            $this->addOutletStockSummary($outletStockSummary);
        }

        $this->collOutletStockSummaries = $outletStockSummaries;
        $this->collOutletStockSummariesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletStockSummary objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletStockSummary objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletStockSummaries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletStockSummariesPartial && !$this->isNew();
        if (null === $this->collOutletStockSummaries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletStockSummaries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletStockSummaries());
            }

            $query = ChildOutletStockSummaryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collOutletStockSummaries);
    }

    /**
     * Method called to associate a ChildOutletStockSummary object to this object
     * through the ChildOutletStockSummary foreign key attribute.
     *
     * @param ChildOutletStockSummary $l ChildOutletStockSummary
     * @return $this The current object (for fluent API support)
     */
    public function addOutletStockSummary(ChildOutletStockSummary $l)
    {
        if ($this->collOutletStockSummaries === null) {
            $this->initOutletStockSummaries();
            $this->collOutletStockSummariesPartial = true;
        }

        if (!$this->collOutletStockSummaries->contains($l)) {
            $this->doAddOutletStockSummary($l);

            if ($this->outletStockSummariesScheduledForDeletion and $this->outletStockSummariesScheduledForDeletion->contains($l)) {
                $this->outletStockSummariesScheduledForDeletion->remove($this->outletStockSummariesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletStockSummary $outletStockSummary The ChildOutletStockSummary object to add.
     */
    protected function doAddOutletStockSummary(ChildOutletStockSummary $outletStockSummary): void
    {
        $this->collOutletStockSummaries[]= $outletStockSummary;
        $outletStockSummary->setProducts($this);
    }

    /**
     * @param ChildOutletStockSummary $outletStockSummary The ChildOutletStockSummary object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletStockSummary(ChildOutletStockSummary $outletStockSummary)
    {
        if ($this->getOutletStockSummaries()->contains($outletStockSummary)) {
            $pos = $this->collOutletStockSummaries->search($outletStockSummary);
            $this->collOutletStockSummaries->remove($pos);
            if (null === $this->outletStockSummariesScheduledForDeletion) {
                $this->outletStockSummariesScheduledForDeletion = clone $this->collOutletStockSummaries;
                $this->outletStockSummariesScheduledForDeletion->clear();
            }
            $this->outletStockSummariesScheduledForDeletion[]= clone $outletStockSummary;
            $outletStockSummary->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }

    /**
     * Clears out the collPricebookliness collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPricebookliness()
     */
    public function clearPricebookliness()
    {
        $this->collPricebookliness = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPricebookliness collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPricebookliness($v = true): void
    {
        $this->collPricebooklinessPartial = $v;
    }

    /**
     * Initializes the collPricebookliness collection.
     *
     * By default this just sets the collPricebookliness collection to an empty array (like clearcollPricebookliness());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPricebookliness(bool $overrideExisting = true): void
    {
        if (null !== $this->collPricebookliness && !$overrideExisting) {
            return;
        }

        $collectionClassName = PricebooklinesTableMap::getTableMap()->getCollectionClassName();

        $this->collPricebookliness = new $collectionClassName;
        $this->collPricebookliness->setModel('\entities\Pricebooklines');
    }

    /**
     * Gets an array of ChildPricebooklines objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPricebooklines[] List of ChildPricebooklines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPricebooklines> List of ChildPricebooklines objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPricebookliness(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPricebooklinessPartial && !$this->isNew();
        if (null === $this->collPricebookliness || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPricebookliness) {
                    $this->initPricebookliness();
                } else {
                    $collectionClassName = PricebooklinesTableMap::getTableMap()->getCollectionClassName();

                    $collPricebookliness = new $collectionClassName;
                    $collPricebookliness->setModel('\entities\Pricebooklines');

                    return $collPricebookliness;
                }
            } else {
                $collPricebookliness = ChildPricebooklinesQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPricebooklinessPartial && count($collPricebookliness)) {
                        $this->initPricebookliness(false);

                        foreach ($collPricebookliness as $obj) {
                            if (false == $this->collPricebookliness->contains($obj)) {
                                $this->collPricebookliness->append($obj);
                            }
                        }

                        $this->collPricebooklinessPartial = true;
                    }

                    return $collPricebookliness;
                }

                if ($partial && $this->collPricebookliness) {
                    foreach ($this->collPricebookliness as $obj) {
                        if ($obj->isNew()) {
                            $collPricebookliness[] = $obj;
                        }
                    }
                }

                $this->collPricebookliness = $collPricebookliness;
                $this->collPricebooklinessPartial = false;
            }
        }

        return $this->collPricebookliness;
    }

    /**
     * Sets a collection of ChildPricebooklines objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $pricebookliness A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookliness(Collection $pricebookliness, ?ConnectionInterface $con = null)
    {
        /** @var ChildPricebooklines[] $pricebooklinessToDelete */
        $pricebooklinessToDelete = $this->getPricebookliness(new Criteria(), $con)->diff($pricebookliness);


        $this->pricebooklinessScheduledForDeletion = $pricebooklinessToDelete;

        foreach ($pricebooklinessToDelete as $pricebooklinesRemoved) {
            $pricebooklinesRemoved->setProducts(null);
        }

        $this->collPricebookliness = null;
        foreach ($pricebookliness as $pricebooklines) {
            $this->addPricebooklines($pricebooklines);
        }

        $this->collPricebookliness = $pricebookliness;
        $this->collPricebooklinessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pricebooklines objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Pricebooklines objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPricebookliness(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPricebooklinessPartial && !$this->isNew();
        if (null === $this->collPricebookliness || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPricebookliness) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPricebookliness());
            }

            $query = ChildPricebooklinesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collPricebookliness);
    }

    /**
     * Method called to associate a ChildPricebooklines object to this object
     * through the ChildPricebooklines foreign key attribute.
     *
     * @param ChildPricebooklines $l ChildPricebooklines
     * @return $this The current object (for fluent API support)
     */
    public function addPricebooklines(ChildPricebooklines $l)
    {
        if ($this->collPricebookliness === null) {
            $this->initPricebookliness();
            $this->collPricebooklinessPartial = true;
        }

        if (!$this->collPricebookliness->contains($l)) {
            $this->doAddPricebooklines($l);

            if ($this->pricebooklinessScheduledForDeletion and $this->pricebooklinessScheduledForDeletion->contains($l)) {
                $this->pricebooklinessScheduledForDeletion->remove($this->pricebooklinessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPricebooklines $pricebooklines The ChildPricebooklines object to add.
     */
    protected function doAddPricebooklines(ChildPricebooklines $pricebooklines): void
    {
        $this->collPricebookliness[]= $pricebooklines;
        $pricebooklines->setProducts($this);
    }

    /**
     * @param ChildPricebooklines $pricebooklines The ChildPricebooklines object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePricebooklines(ChildPricebooklines $pricebooklines)
    {
        if ($this->getPricebookliness()->contains($pricebooklines)) {
            $pos = $this->collPricebookliness->search($pricebooklines);
            $this->collPricebookliness->remove($pos);
            if (null === $this->pricebooklinessScheduledForDeletion) {
                $this->pricebooklinessScheduledForDeletion = clone $this->collPricebookliness;
                $this->pricebooklinessScheduledForDeletion->clear();
            }
            $this->pricebooklinessScheduledForDeletion[]= clone $pricebooklines;
            $pricebooklines->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Pricebookliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPricebooklines[] List of ChildPricebooklines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPricebooklines}> List of ChildPricebooklines objects
     */
    public function getPricebooklinessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPricebooklinesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getPricebookliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Pricebookliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPricebooklines[] List of ChildPricebooklines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPricebooklines}> List of ChildPricebooklines objects
     */
    public function getPricebooklinessJoinPricebooks(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPricebooklinesQuery::create(null, $criteria);
        $query->joinWith('Pricebooks', $joinBehavior);

        return $this->getPricebookliness($query, $con);
    }

    /**
     * Clears out the collProductmedias collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductmedias()
     */
    public function clearProductmedias()
    {
        $this->collProductmedias = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductmedias collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductmedias($v = true): void
    {
        $this->collProductmediasPartial = $v;
    }

    /**
     * Initializes the collProductmedias collection.
     *
     * By default this just sets the collProductmedias collection to an empty array (like clearcollProductmedias());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductmedias(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductmedias && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductmediaTableMap::getTableMap()->getCollectionClassName();

        $this->collProductmedias = new $collectionClassName;
        $this->collProductmedias->setModel('\entities\Productmedia');
    }

    /**
     * Gets an array of ChildProductmedia objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductmedia[] List of ChildProductmedia objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductmedia> List of ChildProductmedia objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductmedias(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductmediasPartial && !$this->isNew();
        if (null === $this->collProductmedias || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductmedias) {
                    $this->initProductmedias();
                } else {
                    $collectionClassName = ProductmediaTableMap::getTableMap()->getCollectionClassName();

                    $collProductmedias = new $collectionClassName;
                    $collProductmedias->setModel('\entities\Productmedia');

                    return $collProductmedias;
                }
            } else {
                $collProductmedias = ChildProductmediaQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductmediasPartial && count($collProductmedias)) {
                        $this->initProductmedias(false);

                        foreach ($collProductmedias as $obj) {
                            if (false == $this->collProductmedias->contains($obj)) {
                                $this->collProductmedias->append($obj);
                            }
                        }

                        $this->collProductmediasPartial = true;
                    }

                    return $collProductmedias;
                }

                if ($partial && $this->collProductmedias) {
                    foreach ($this->collProductmedias as $obj) {
                        if ($obj->isNew()) {
                            $collProductmedias[] = $obj;
                        }
                    }
                }

                $this->collProductmedias = $collProductmedias;
                $this->collProductmediasPartial = false;
            }
        }

        return $this->collProductmedias;
    }

    /**
     * Sets a collection of ChildProductmedia objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productmedias A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductmedias(Collection $productmedias, ?ConnectionInterface $con = null)
    {
        /** @var ChildProductmedia[] $productmediasToDelete */
        $productmediasToDelete = $this->getProductmedias(new Criteria(), $con)->diff($productmedias);


        $this->productmediasScheduledForDeletion = $productmediasToDelete;

        foreach ($productmediasToDelete as $productmediaRemoved) {
            $productmediaRemoved->setProducts(null);
        }

        $this->collProductmedias = null;
        foreach ($productmedias as $productmedia) {
            $this->addProductmedia($productmedia);
        }

        $this->collProductmedias = $productmedias;
        $this->collProductmediasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Productmedia objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Productmedia objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductmedias(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductmediasPartial && !$this->isNew();
        if (null === $this->collProductmedias || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductmedias) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductmedias());
            }

            $query = ChildProductmediaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collProductmedias);
    }

    /**
     * Method called to associate a ChildProductmedia object to this object
     * through the ChildProductmedia foreign key attribute.
     *
     * @param ChildProductmedia $l ChildProductmedia
     * @return $this The current object (for fluent API support)
     */
    public function addProductmedia(ChildProductmedia $l)
    {
        if ($this->collProductmedias === null) {
            $this->initProductmedias();
            $this->collProductmediasPartial = true;
        }

        if (!$this->collProductmedias->contains($l)) {
            $this->doAddProductmedia($l);

            if ($this->productmediasScheduledForDeletion and $this->productmediasScheduledForDeletion->contains($l)) {
                $this->productmediasScheduledForDeletion->remove($this->productmediasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductmedia $productmedia The ChildProductmedia object to add.
     */
    protected function doAddProductmedia(ChildProductmedia $productmedia): void
    {
        $this->collProductmedias[]= $productmedia;
        $productmedia->setProducts($this);
    }

    /**
     * @param ChildProductmedia $productmedia The ChildProductmedia object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductmedia(ChildProductmedia $productmedia)
    {
        if ($this->getProductmedias()->contains($productmedia)) {
            $pos = $this->collProductmedias->search($productmedia);
            $this->collProductmedias->remove($pos);
            if (null === $this->productmediasScheduledForDeletion) {
                $this->productmediasScheduledForDeletion = clone $this->collProductmedias;
                $this->productmediasScheduledForDeletion->clear();
            }
            $this->productmediasScheduledForDeletion[]= clone $productmedia;
            $productmedia->setProducts(null);
        }

        return $this;
    }

    /**
     * Clears out the collShippingliness collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShippingliness()
     */
    public function clearShippingliness()
    {
        $this->collShippingliness = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShippingliness collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShippingliness($v = true): void
    {
        $this->collShippinglinessPartial = $v;
    }

    /**
     * Initializes the collShippingliness collection.
     *
     * By default this just sets the collShippingliness collection to an empty array (like clearcollShippingliness());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShippingliness(bool $overrideExisting = true): void
    {
        if (null !== $this->collShippingliness && !$overrideExisting) {
            return;
        }

        $collectionClassName = ShippinglinesTableMap::getTableMap()->getCollectionClassName();

        $this->collShippingliness = new $collectionClassName;
        $this->collShippingliness->setModel('\entities\Shippinglines');
    }

    /**
     * Gets an array of ChildShippinglines objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines> List of ChildShippinglines objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShippingliness(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShippinglinessPartial && !$this->isNew();
        if (null === $this->collShippingliness || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShippingliness) {
                    $this->initShippingliness();
                } else {
                    $collectionClassName = ShippinglinesTableMap::getTableMap()->getCollectionClassName();

                    $collShippingliness = new $collectionClassName;
                    $collShippingliness->setModel('\entities\Shippinglines');

                    return $collShippingliness;
                }
            } else {
                $collShippingliness = ChildShippinglinesQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShippinglinessPartial && count($collShippingliness)) {
                        $this->initShippingliness(false);

                        foreach ($collShippingliness as $obj) {
                            if (false == $this->collShippingliness->contains($obj)) {
                                $this->collShippingliness->append($obj);
                            }
                        }

                        $this->collShippinglinessPartial = true;
                    }

                    return $collShippingliness;
                }

                if ($partial && $this->collShippingliness) {
                    foreach ($this->collShippingliness as $obj) {
                        if ($obj->isNew()) {
                            $collShippingliness[] = $obj;
                        }
                    }
                }

                $this->collShippingliness = $collShippingliness;
                $this->collShippinglinessPartial = false;
            }
        }

        return $this->collShippingliness;
    }

    /**
     * Sets a collection of ChildShippinglines objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shippingliness A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShippingliness(Collection $shippingliness, ?ConnectionInterface $con = null)
    {
        /** @var ChildShippinglines[] $shippinglinessToDelete */
        $shippinglinessToDelete = $this->getShippingliness(new Criteria(), $con)->diff($shippingliness);


        $this->shippinglinessScheduledForDeletion = $shippinglinessToDelete;

        foreach ($shippinglinessToDelete as $shippinglinesRemoved) {
            $shippinglinesRemoved->setProducts(null);
        }

        $this->collShippingliness = null;
        foreach ($shippingliness as $shippinglines) {
            $this->addShippinglines($shippinglines);
        }

        $this->collShippingliness = $shippingliness;
        $this->collShippinglinessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Shippinglines objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Shippinglines objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShippingliness(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShippinglinessPartial && !$this->isNew();
        if (null === $this->collShippingliness || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShippingliness) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShippingliness());
            }

            $query = ChildShippinglinesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collShippingliness);
    }

    /**
     * Method called to associate a ChildShippinglines object to this object
     * through the ChildShippinglines foreign key attribute.
     *
     * @param ChildShippinglines $l ChildShippinglines
     * @return $this The current object (for fluent API support)
     */
    public function addShippinglines(ChildShippinglines $l)
    {
        if ($this->collShippingliness === null) {
            $this->initShippingliness();
            $this->collShippinglinessPartial = true;
        }

        if (!$this->collShippingliness->contains($l)) {
            $this->doAddShippinglines($l);

            if ($this->shippinglinessScheduledForDeletion and $this->shippinglinessScheduledForDeletion->contains($l)) {
                $this->shippinglinessScheduledForDeletion->remove($this->shippinglinessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildShippinglines $shippinglines The ChildShippinglines object to add.
     */
    protected function doAddShippinglines(ChildShippinglines $shippinglines): void
    {
        $this->collShippingliness[]= $shippinglines;
        $shippinglines->setProducts($this);
    }

    /**
     * @param ChildShippinglines $shippinglines The ChildShippinglines object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShippinglines(ChildShippinglines $shippinglines)
    {
        if ($this->getShippingliness()->contains($shippinglines)) {
            $pos = $this->collShippingliness->search($shippinglines);
            $this->collShippingliness->remove($pos);
            if (null === $this->shippinglinessScheduledForDeletion) {
                $this->shippinglinessScheduledForDeletion = clone $this->collShippingliness;
                $this->shippinglinessScheduledForDeletion->clear();
            }
            $this->shippinglinessScheduledForDeletion[]= clone $shippinglines;
            $shippinglines->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines}> List of ChildShippinglines objects
     */
    public function getShippinglinessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippinglinesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getShippingliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines}> List of ChildShippinglines objects
     */
    public function getShippinglinessJoinOrderlines(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippinglinesQuery::create(null, $criteria);
        $query->joinWith('Orderlines', $joinBehavior);

        return $this->getShippingliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines}> List of ChildShippinglines objects
     */
    public function getShippinglinessJoinShippingorder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippinglinesQuery::create(null, $criteria);
        $query->joinWith('Shippingorder', $joinBehavior);

        return $this->getShippingliness($query, $con);
    }

    /**
     * Clears out the collStockTransactions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockTransactions()
     */
    public function clearStockTransactions()
    {
        $this->collStockTransactions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockTransactions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockTransactions($v = true): void
    {
        $this->collStockTransactionsPartial = $v;
    }

    /**
     * Initializes the collStockTransactions collection.
     *
     * By default this just sets the collStockTransactions collection to an empty array (like clearcollStockTransactions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockTransactions(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockTransactions && !$overrideExisting) {
            return;
        }

        $collectionClassName = StockTransactionTableMap::getTableMap()->getCollectionClassName();

        $this->collStockTransactions = new $collectionClassName;
        $this->collStockTransactions->setModel('\entities\StockTransaction');
    }

    /**
     * Gets an array of ChildStockTransaction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction> List of ChildStockTransaction objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockTransactions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockTransactionsPartial && !$this->isNew();
        if (null === $this->collStockTransactions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockTransactions) {
                    $this->initStockTransactions();
                } else {
                    $collectionClassName = StockTransactionTableMap::getTableMap()->getCollectionClassName();

                    $collStockTransactions = new $collectionClassName;
                    $collStockTransactions->setModel('\entities\StockTransaction');

                    return $collStockTransactions;
                }
            } else {
                $collStockTransactions = ChildStockTransactionQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockTransactionsPartial && count($collStockTransactions)) {
                        $this->initStockTransactions(false);

                        foreach ($collStockTransactions as $obj) {
                            if (false == $this->collStockTransactions->contains($obj)) {
                                $this->collStockTransactions->append($obj);
                            }
                        }

                        $this->collStockTransactionsPartial = true;
                    }

                    return $collStockTransactions;
                }

                if ($partial && $this->collStockTransactions) {
                    foreach ($this->collStockTransactions as $obj) {
                        if ($obj->isNew()) {
                            $collStockTransactions[] = $obj;
                        }
                    }
                }

                $this->collStockTransactions = $collStockTransactions;
                $this->collStockTransactionsPartial = false;
            }
        }

        return $this->collStockTransactions;
    }

    /**
     * Sets a collection of ChildStockTransaction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockTransactions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockTransactions(Collection $stockTransactions, ?ConnectionInterface $con = null)
    {
        /** @var ChildStockTransaction[] $stockTransactionsToDelete */
        $stockTransactionsToDelete = $this->getStockTransactions(new Criteria(), $con)->diff($stockTransactions);


        $this->stockTransactionsScheduledForDeletion = $stockTransactionsToDelete;

        foreach ($stockTransactionsToDelete as $stockTransactionRemoved) {
            $stockTransactionRemoved->setProducts(null);
        }

        $this->collStockTransactions = null;
        foreach ($stockTransactions as $stockTransaction) {
            $this->addStockTransaction($stockTransaction);
        }

        $this->collStockTransactions = $stockTransactions;
        $this->collStockTransactionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StockTransaction objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StockTransaction objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockTransactions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockTransactionsPartial && !$this->isNew();
        if (null === $this->collStockTransactions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockTransactions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockTransactions());
            }

            $query = ChildStockTransactionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collStockTransactions);
    }

    /**
     * Method called to associate a ChildStockTransaction object to this object
     * through the ChildStockTransaction foreign key attribute.
     *
     * @param ChildStockTransaction $l ChildStockTransaction
     * @return $this The current object (for fluent API support)
     */
    public function addStockTransaction(ChildStockTransaction $l)
    {
        if ($this->collStockTransactions === null) {
            $this->initStockTransactions();
            $this->collStockTransactionsPartial = true;
        }

        if (!$this->collStockTransactions->contains($l)) {
            $this->doAddStockTransaction($l);

            if ($this->stockTransactionsScheduledForDeletion and $this->stockTransactionsScheduledForDeletion->contains($l)) {
                $this->stockTransactionsScheduledForDeletion->remove($this->stockTransactionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStockTransaction $stockTransaction The ChildStockTransaction object to add.
     */
    protected function doAddStockTransaction(ChildStockTransaction $stockTransaction): void
    {
        $this->collStockTransactions[]= $stockTransaction;
        $stockTransaction->setProducts($this);
    }

    /**
     * @param ChildStockTransaction $stockTransaction The ChildStockTransaction object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockTransaction(ChildStockTransaction $stockTransaction)
    {
        if ($this->getStockTransactions()->contains($stockTransaction)) {
            $pos = $this->collStockTransactions->search($stockTransaction);
            $this->collStockTransactions->remove($pos);
            if (null === $this->stockTransactionsScheduledForDeletion) {
                $this->stockTransactionsScheduledForDeletion = clone $this->collStockTransactions;
                $this->stockTransactionsScheduledForDeletion->clear();
            }
            $this->stockTransactionsScheduledForDeletion[]= clone $stockTransaction;
            $stockTransaction->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinStockVoucher(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('StockVoucher', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aCategories) {
            $this->aCategories->removeProducts($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeProducts($this);
        }
        if (null !== $this->aTags) {
            $this->aTags->removeProducts($this);
        }
        if (null !== $this->aUnitmaster) {
            $this->aUnitmaster->removeProducts($this);
        }
        if (null !== $this->aBrands) {
            $this->aBrands->removeProducts($this);
        }
        $this->id = null;
        $this->product_name = null;
        $this->product_summary = null;
        $this->product_description = null;
        $this->product_sku = null;
        $this->additional_data = null;
        $this->unit_d = null;
        $this->packing_desc = null;
        $this->packing_qty = null;
        $this->category_id = null;
        $this->tag_id = null;
        $this->company_id = null;
        $this->product_images = null;
        $this->integration_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->orgunit_id = null;
        $this->brand_id = null;
        $this->base_price = null;
        $this->status = null;
        $this->can_do_rcpa = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collBrandCompetitions) {
                foreach ($this->collBrandCompetitions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderliness) {
                foreach ($this->collOrderliness as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletStocks) {
                foreach ($this->collOutletStocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletStockOtherSummaries) {
                foreach ($this->collOutletStockOtherSummaries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletStockSummaries) {
                foreach ($this->collOutletStockSummaries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPricebookliness) {
                foreach ($this->collPricebookliness as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductmedias) {
                foreach ($this->collProductmedias as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShippingliness) {
                foreach ($this->collShippingliness as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockTransactions) {
                foreach ($this->collStockTransactions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCompetitions = null;
        $this->collOrderliness = null;
        $this->collOutletStocks = null;
        $this->collOutletStockOtherSummaries = null;
        $this->collOutletStockSummaries = null;
        $this->collPricebookliness = null;
        $this->collProductmedias = null;
        $this->collShippingliness = null;
        $this->collStockTransactions = null;
        $this->aCategories = null;
        $this->aCompany = null;
        $this->aTags = null;
        $this->aUnitmaster = null;
        $this->aBrands = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductsTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
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
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
