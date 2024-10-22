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
use entities\BrandCampiagn as ChildBrandCampiagn;
use entities\BrandCampiagnQuery as ChildBrandCampiagnQuery;
use entities\BrandCompetition as ChildBrandCompetition;
use entities\BrandCompetitionQuery as ChildBrandCompetitionQuery;
use entities\BrandRcpa as ChildBrandRcpa;
use entities\BrandRcpaQuery as ChildBrandRcpaQuery;
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\EdPresentations as ChildEdPresentations;
use entities\EdPresentationsQuery as ChildEdPresentationsQuery;
use entities\EdStats as ChildEdStats;
use entities\EdStatsQuery as ChildEdStatsQuery;
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OutletStock as ChildOutletStock;
use entities\OutletStockOtherSummary as ChildOutletStockOtherSummary;
use entities\OutletStockOtherSummaryQuery as ChildOutletStockOtherSummaryQuery;
use entities\OutletStockQuery as ChildOutletStockQuery;
use entities\OutletStockSummary as ChildOutletStockSummary;
use entities\OutletStockSummaryQuery as ChildOutletStockSummaryQuery;
use entities\PrescriberData as ChildPrescriberData;
use entities\PrescriberDataQuery as ChildPrescriberDataQuery;
use entities\PrescriberTallySummary as ChildPrescriberTallySummary;
use entities\PrescriberTallySummaryQuery as ChildPrescriberTallySummaryQuery;
use entities\Products as ChildProducts;
use entities\ProductsQuery as ChildProductsQuery;
use entities\SgpiMaster as ChildSgpiMaster;
use entities\SgpiMasterQuery as ChildSgpiMasterQuery;
use entities\Map\BrandCampiagnTableMap;
use entities\Map\BrandCompetitionTableMap;
use entities\Map\BrandRcpaTableMap;
use entities\Map\BrandsTableMap;
use entities\Map\EdPresentationsTableMap;
use entities\Map\EdStatsTableMap;
use entities\Map\OnBoardRequestAddressTableMap;
use entities\Map\OutletStockOtherSummaryTableMap;
use entities\Map\OutletStockSummaryTableMap;
use entities\Map\OutletStockTableMap;
use entities\Map\PrescriberDataTableMap;
use entities\Map\PrescriberTallySummaryTableMap;
use entities\Map\ProductsTableMap;
use entities\Map\SgpiMasterTableMap;

/**
 * Base class that represents a row from the 'brands' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Brands implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\BrandsTableMap';


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
     * The value for the brand_id field.
     *
     * @var        int
     */
    protected $brand_id;

    /**
     * The value for the brand_name field.
     *
     * @var        string|null
     */
    protected $brand_name;

    /**
     * The value for the orgunitid field.
     *
     * @var        int|null
     */
    protected $orgunitid;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

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
     * The value for the brand_code field.
     *
     * @var        string|null
     */
    protected $brand_code;

    /**
     * The value for the brand_rate field.
     *
     * @var        string|null
     */
    protected $brand_rate;

    /**
     * The value for the min_value field.
     *
     * @var        int|null
     */
    protected $min_value;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildBrandCampiagn[] Collection to store aggregation of ChildBrandCampiagn objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagn> Collection to store aggregation of ChildBrandCampiagn objects.
     */
    protected $collBrandCampiagns;
    protected $collBrandCampiagnsPartial;

    /**
     * @var        ObjectCollection|ChildBrandCompetition[] Collection to store aggregation of ChildBrandCompetition objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCompetition> Collection to store aggregation of ChildBrandCompetition objects.
     */
    protected $collBrandCompetitions;
    protected $collBrandCompetitionsPartial;

    /**
     * @var        ObjectCollection|ChildBrandRcpa[] Collection to store aggregation of ChildBrandRcpa objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandRcpa> Collection to store aggregation of ChildBrandRcpa objects.
     */
    protected $collBrandRcpas;
    protected $collBrandRcpasPartial;

    /**
     * @var        ObjectCollection|ChildEdPresentations[] Collection to store aggregation of ChildEdPresentations objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdPresentations> Collection to store aggregation of ChildEdPresentations objects.
     */
    protected $collEdPresentationss;
    protected $collEdPresentationssPartial;

    /**
     * @var        ObjectCollection|ChildEdStats[] Collection to store aggregation of ChildEdStats objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdStats> Collection to store aggregation of ChildEdStats objects.
     */
    protected $collEdStatss;
    protected $collEdStatssPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestAddress[] Collection to store aggregation of ChildOnBoardRequestAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress> Collection to store aggregation of ChildOnBoardRequestAddress objects.
     */
    protected $collOnBoardRequestAddresses;
    protected $collOnBoardRequestAddressesPartial;

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
     * @var        ObjectCollection|ChildPrescriberData[] Collection to store aggregation of ChildPrescriberData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberData> Collection to store aggregation of ChildPrescriberData objects.
     */
    protected $collPrescriberDatas;
    protected $collPrescriberDatasPartial;

    /**
     * @var        ObjectCollection|ChildPrescriberTallySummary[] Collection to store aggregation of ChildPrescriberTallySummary objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberTallySummary> Collection to store aggregation of ChildPrescriberTallySummary objects.
     */
    protected $collPrescriberTallySummaries;
    protected $collPrescriberTallySummariesPartial;

    /**
     * @var        ObjectCollection|ChildProducts[] Collection to store aggregation of ChildProducts objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProducts> Collection to store aggregation of ChildProducts objects.
     */
    protected $collProductss;
    protected $collProductssPartial;

    /**
     * @var        ObjectCollection|ChildSgpiMaster[] Collection to store aggregation of ChildSgpiMaster objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSgpiMaster> Collection to store aggregation of ChildSgpiMaster objects.
     */
    protected $collSgpiMasters;
    protected $collSgpiMastersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagn[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagn>
     */
    protected $brandCampiagnsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCompetition[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCompetition>
     */
    protected $brandCompetitionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandRcpa[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandRcpa>
     */
    protected $brandRcpasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdPresentations[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdPresentations>
     */
    protected $edPresentationssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdStats[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdStats>
     */
    protected $edStatssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress>
     */
    protected $onBoardRequestAddressesScheduledForDeletion = null;

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
     * @var ObjectCollection|ChildPrescriberData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberData>
     */
    protected $prescriberDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrescriberTallySummary[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberTallySummary>
     */
    protected $prescriberTallySummariesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProducts[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProducts>
     */
    protected $productssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSgpiMaster[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSgpiMaster>
     */
    protected $sgpiMastersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
    }

    /**
     * Initializes internal state of entities\Base\Brands object.
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
     * Compares this with another <code>Brands</code> instance.  If
     * <code>obj</code> is an instance of <code>Brands</code>, delegates to
     * <code>equals(Brands)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [brand_id] column value.
     *
     * @return int
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Get the [brand_name] column value.
     *
     * @return string|null
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Get the [orgunitid] column value.
     *
     * @return int|null
     */
    public function getOrgunitid()
    {
        return $this->orgunitid;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->company_id;
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
     * Get the [brand_code] column value.
     *
     * @return string|null
     */
    public function getBrandCode()
    {
        return $this->brand_code;
    }

    /**
     * Get the [brand_rate] column value.
     *
     * @return string|null
     */
    public function getBrandRate()
    {
        return $this->brand_rate;
    }

    /**
     * Get the [min_value] column value.
     *
     * @return int|null
     */
    public function getMinValue()
    {
        return $this->min_value;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[BrandsTableMap::COL_BRAND_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_name !== $v) {
            $this->brand_name = $v;
            $this->modifiedColumns[BrandsTableMap::COL_BRAND_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [orgunitid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunitid !== $v) {
            $this->orgunitid = $v;
            $this->modifiedColumns[BrandsTableMap::COL_ORGUNITID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[BrandsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
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
                $this->modifiedColumns[BrandsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[BrandsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [brand_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_code !== $v) {
            $this->brand_code = $v;
            $this->modifiedColumns[BrandsTableMap::COL_BRAND_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_rate] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_rate !== $v) {
            $this->brand_rate = $v;
            $this->modifiedColumns[BrandsTableMap::COL_BRAND_RATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [min_value] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMinValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->min_value !== $v) {
            $this->min_value = $v;
            $this->modifiedColumns[BrandsTableMap::COL_MIN_VALUE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BrandsTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BrandsTableMap::translateFieldName('BrandName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BrandsTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BrandsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BrandsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BrandsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BrandsTableMap::translateFieldName('BrandCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BrandsTableMap::translateFieldName('BrandRate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BrandsTableMap::translateFieldName('MinValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->min_value = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = BrandsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Brands'), 0, $e);
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
        if ($this->aOrgUnit !== null && $this->orgunitid !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(BrandsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBrandsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOrgUnit = null;
            $this->aCompany = null;
            $this->collBrandCampiagns = null;

            $this->collBrandCompetitions = null;

            $this->collBrandRcpas = null;

            $this->collEdPresentationss = null;

            $this->collEdStatss = null;

            $this->collOnBoardRequestAddresses = null;

            $this->collOutletStocks = null;

            $this->collOutletStockOtherSummaries = null;

            $this->collOutletStockSummaries = null;

            $this->collPrescriberDatas = null;

            $this->collPrescriberTallySummaries = null;

            $this->collProductss = null;

            $this->collSgpiMasters = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Brands::setDeleted()
     * @see Brands::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBrandsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandsTableMap::DATABASE_NAME);
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
                BrandsTableMap::addInstanceToPool($this);
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

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
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

            if ($this->brandCampiagnsScheduledForDeletion !== null) {
                if (!$this->brandCampiagnsScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnsScheduledForDeletion as $brandCampiagn) {
                        // need to save related object because we set the relation to null
                        $brandCampiagn->save($con);
                    }
                    $this->brandCampiagnsScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagns !== null) {
                foreach ($this->collBrandCampiagns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->brandRcpasScheduledForDeletion !== null) {
                if (!$this->brandRcpasScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandRcpasScheduledForDeletion as $brandRcpa) {
                        // need to save related object because we set the relation to null
                        $brandRcpa->save($con);
                    }
                    $this->brandRcpasScheduledForDeletion = null;
                }
            }

            if ($this->collBrandRcpas !== null) {
                foreach ($this->collBrandRcpas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->edPresentationssScheduledForDeletion !== null) {
                if (!$this->edPresentationssScheduledForDeletion->isEmpty()) {
                    foreach ($this->edPresentationssScheduledForDeletion as $edPresentations) {
                        // need to save related object because we set the relation to null
                        $edPresentations->save($con);
                    }
                    $this->edPresentationssScheduledForDeletion = null;
                }
            }

            if ($this->collEdPresentationss !== null) {
                foreach ($this->collEdPresentationss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->edStatssScheduledForDeletion !== null) {
                if (!$this->edStatssScheduledForDeletion->isEmpty()) {
                    foreach ($this->edStatssScheduledForDeletion as $edStats) {
                        // need to save related object because we set the relation to null
                        $edStats->save($con);
                    }
                    $this->edStatssScheduledForDeletion = null;
                }
            }

            if ($this->collEdStatss !== null) {
                foreach ($this->collEdStatss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestAddressesScheduledForDeletion !== null) {
                if (!$this->onBoardRequestAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestAddressesScheduledForDeletion as $onBoardRequestAddress) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestAddress->save($con);
                    }
                    $this->onBoardRequestAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestAddresses !== null) {
                foreach ($this->collOnBoardRequestAddresses as $referrerFK) {
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

            if ($this->prescriberDatasScheduledForDeletion !== null) {
                if (!$this->prescriberDatasScheduledForDeletion->isEmpty()) {
                    \entities\PrescriberDataQuery::create()
                        ->filterByPrimaryKeys($this->prescriberDatasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prescriberDatasScheduledForDeletion = null;
                }
            }

            if ($this->collPrescriberDatas !== null) {
                foreach ($this->collPrescriberDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->prescriberTallySummariesScheduledForDeletion !== null) {
                if (!$this->prescriberTallySummariesScheduledForDeletion->isEmpty()) {
                    \entities\PrescriberTallySummaryQuery::create()
                        ->filterByPrimaryKeys($this->prescriberTallySummariesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prescriberTallySummariesScheduledForDeletion = null;
                }
            }

            if ($this->collPrescriberTallySummaries !== null) {
                foreach ($this->collPrescriberTallySummaries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productssScheduledForDeletion !== null) {
                if (!$this->productssScheduledForDeletion->isEmpty()) {
                    foreach ($this->productssScheduledForDeletion as $products) {
                        // need to save related object because we set the relation to null
                        $products->save($con);
                    }
                    $this->productssScheduledForDeletion = null;
                }
            }

            if ($this->collProductss !== null) {
                foreach ($this->collProductss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sgpiMastersScheduledForDeletion !== null) {
                if (!$this->sgpiMastersScheduledForDeletion->isEmpty()) {
                    foreach ($this->sgpiMastersScheduledForDeletion as $sgpiMaster) {
                        // need to save related object because we set the relation to null
                        $sgpiMaster->save($con);
                    }
                    $this->sgpiMastersScheduledForDeletion = null;
                }
            }

            if ($this->collSgpiMasters !== null) {
                foreach ($this->collSgpiMasters as $referrerFK) {
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

        $this->modifiedColumns[BrandsTableMap::COL_BRAND_ID] = true;
        if (null !== $this->brand_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BrandsTableMap::COL_BRAND_ID . ')');
        }
        if (null === $this->brand_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('brands_brand_id_seq')");
                $this->brand_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BrandsTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(BrandsTableMap::COL_BRAND_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'brand_name';
        }
        if ($this->isColumnModified(BrandsTableMap::COL_ORGUNITID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunitid';
        }
        if ($this->isColumnModified(BrandsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(BrandsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(BrandsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(BrandsTableMap::COL_BRAND_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'brand_code';
        }
        if ($this->isColumnModified(BrandsTableMap::COL_BRAND_RATE)) {
            $modifiedColumns[':p' . $index++]  = 'brand_rate';
        }
        if ($this->isColumnModified(BrandsTableMap::COL_MIN_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'min_value';
        }

        $sql = sprintf(
            'INSERT INTO brands (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);

                        break;
                    case 'brand_name':
                        $stmt->bindValue($identifier, $this->brand_name, PDO::PARAM_STR);

                        break;
                    case 'orgunitid':
                        $stmt->bindValue($identifier, $this->orgunitid, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'brand_code':
                        $stmt->bindValue($identifier, $this->brand_code, PDO::PARAM_STR);

                        break;
                    case 'brand_rate':
                        $stmt->bindValue($identifier, $this->brand_rate, PDO::PARAM_STR);

                        break;
                    case 'min_value':
                        $stmt->bindValue($identifier, $this->min_value, PDO::PARAM_INT);

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
        $pos = BrandsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBrandId();

            case 1:
                return $this->getBrandName();

            case 2:
                return $this->getOrgunitid();

            case 3:
                return $this->getCompanyId();

            case 4:
                return $this->getCreatedAt();

            case 5:
                return $this->getUpdatedAt();

            case 6:
                return $this->getBrandCode();

            case 7:
                return $this->getBrandRate();

            case 8:
                return $this->getMinValue();

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
        if (isset($alreadyDumpedObjects['Brands'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Brands'][$this->hashCode()] = true;
        $keys = BrandsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBrandId(),
            $keys[1] => $this->getBrandName(),
            $keys[2] => $this->getOrgunitid(),
            $keys[3] => $this->getCompanyId(),
            $keys[4] => $this->getCreatedAt(),
            $keys[5] => $this->getUpdatedAt(),
            $keys[6] => $this->getBrandCode(),
            $keys[7] => $this->getBrandRate(),
            $keys[8] => $this->getMinValue(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aOrgUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orgUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'org_unit';
                        break;
                    default:
                        $key = 'OrgUnit';
                }

                $result[$key] = $this->aOrgUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collBrandCampiagns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagns';
                        break;
                    default:
                        $key = 'BrandCampiagns';
                }

                $result[$key] = $this->collBrandCampiagns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collBrandRcpas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandRcpas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_rcpas';
                        break;
                    default:
                        $key = 'BrandRcpas';
                }

                $result[$key] = $this->collBrandRcpas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEdPresentationss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edPresentationss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_presentationss';
                        break;
                    default:
                        $key = 'EdPresentationss';
                }

                $result[$key] = $this->collEdPresentationss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEdStatss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edStatss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_statss';
                        break;
                    default:
                        $key = 'EdStatss';
                }

                $result[$key] = $this->collEdStatss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequestAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request_addresses';
                        break;
                    default:
                        $key = 'OnBoardRequestAddresses';
                }

                $result[$key] = $this->collOnBoardRequestAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collPrescriberDatas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prescriberDatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prescriber_datas';
                        break;
                    default:
                        $key = 'PrescriberDatas';
                }

                $result[$key] = $this->collPrescriberDatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPrescriberTallySummaries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prescriberTallySummaries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prescriber_tally_summaries';
                        break;
                    default:
                        $key = 'PrescriberTallySummaries';
                }

                $result[$key] = $this->collPrescriberTallySummaries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'productss';
                        break;
                    default:
                        $key = 'Productss';
                }

                $result[$key] = $this->collProductss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSgpiMasters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sgpiMasters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sgpi_masters';
                        break;
                    default:
                        $key = 'SgpiMasters';
                }

                $result[$key] = $this->collSgpiMasters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BrandsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setBrandId($value);
                break;
            case 1:
                $this->setBrandName($value);
                break;
            case 2:
                $this->setOrgunitid($value);
                break;
            case 3:
                $this->setCompanyId($value);
                break;
            case 4:
                $this->setCreatedAt($value);
                break;
            case 5:
                $this->setUpdatedAt($value);
                break;
            case 6:
                $this->setBrandCode($value);
                break;
            case 7:
                $this->setBrandRate($value);
                break;
            case 8:
                $this->setMinValue($value);
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
        $keys = BrandsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBrandId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBrandName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOrgunitid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCompanyId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreatedAt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUpdatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBrandCode($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setBrandRate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setMinValue($arr[$keys[8]]);
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
        $criteria = new Criteria(BrandsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BrandsTableMap::COL_BRAND_ID)) {
            $criteria->add(BrandsTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(BrandsTableMap::COL_BRAND_NAME)) {
            $criteria->add(BrandsTableMap::COL_BRAND_NAME, $this->brand_name);
        }
        if ($this->isColumnModified(BrandsTableMap::COL_ORGUNITID)) {
            $criteria->add(BrandsTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(BrandsTableMap::COL_COMPANY_ID)) {
            $criteria->add(BrandsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(BrandsTableMap::COL_CREATED_AT)) {
            $criteria->add(BrandsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(BrandsTableMap::COL_UPDATED_AT)) {
            $criteria->add(BrandsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(BrandsTableMap::COL_BRAND_CODE)) {
            $criteria->add(BrandsTableMap::COL_BRAND_CODE, $this->brand_code);
        }
        if ($this->isColumnModified(BrandsTableMap::COL_BRAND_RATE)) {
            $criteria->add(BrandsTableMap::COL_BRAND_RATE, $this->brand_rate);
        }
        if ($this->isColumnModified(BrandsTableMap::COL_MIN_VALUE)) {
            $criteria->add(BrandsTableMap::COL_MIN_VALUE, $this->min_value);
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
        $criteria = ChildBrandsQuery::create();
        $criteria->add(BrandsTableMap::COL_BRAND_ID, $this->brand_id);

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
        $validPk = null !== $this->getBrandId();

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
        return $this->getBrandId();
    }

    /**
     * Generic method to set the primary key (brand_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setBrandId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getBrandId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Brands (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setBrandName($this->getBrandName());
        $copyObj->setOrgunitid($this->getOrgunitid());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setBrandCode($this->getBrandCode());
        $copyObj->setBrandRate($this->getBrandRate());
        $copyObj->setMinValue($this->getMinValue());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagn($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandCompetitions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCompetition($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandRcpas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandRcpa($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdPresentationss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdPresentations($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdStatss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdStats($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestAddress($relObj->copy($deepCopy));
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

            foreach ($this->getPrescriberDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrescriberData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPrescriberTallySummaries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrescriberTallySummary($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProducts($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSgpiMasters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSgpiMaster($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBrandId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Brands Clone of current object.
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
     * Declares an association between this object and a ChildOrgUnit object.
     *
     * @param ChildOrgUnit|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrgUnit(ChildOrgUnit $v = null)
    {
        if ($v === null) {
            $this->setOrgunitid(NULL);
        } else {
            $this->setOrgunitid($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addBrands($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrgUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOrgUnit|null The associated ChildOrgUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrgUnit(?ConnectionInterface $con = null)
    {
        if ($this->aOrgUnit === null && ($this->orgunitid != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->orgunitid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addBrandss($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildCompany object.
     *
     * @param ChildCompany|null $v
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
            $v->addBrands($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany|null The associated ChildCompany object.
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
                $this->aCompany->addBrandss($this);
             */
        }

        return $this->aCompany;
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
        if ('BrandCampiagn' === $relationName) {
            $this->initBrandCampiagns();
            return;
        }
        if ('BrandCompetition' === $relationName) {
            $this->initBrandCompetitions();
            return;
        }
        if ('BrandRcpa' === $relationName) {
            $this->initBrandRcpas();
            return;
        }
        if ('EdPresentations' === $relationName) {
            $this->initEdPresentationss();
            return;
        }
        if ('EdStats' === $relationName) {
            $this->initEdStatss();
            return;
        }
        if ('OnBoardRequestAddress' === $relationName) {
            $this->initOnBoardRequestAddresses();
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
        if ('PrescriberData' === $relationName) {
            $this->initPrescriberDatas();
            return;
        }
        if ('PrescriberTallySummary' === $relationName) {
            $this->initPrescriberTallySummaries();
            return;
        }
        if ('Products' === $relationName) {
            $this->initProductss();
            return;
        }
        if ('SgpiMaster' === $relationName) {
            $this->initSgpiMasters();
            return;
        }
    }

    /**
     * Clears out the collBrandCampiagns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagns()
     */
    public function clearBrandCampiagns()
    {
        $this->collBrandCampiagns = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagns collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagns($v = true): void
    {
        $this->collBrandCampiagnsPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagns collection.
     *
     * By default this just sets the collBrandCampiagns collection to an empty array (like clearcollBrandCampiagns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagns(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagns && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagns = new $collectionClassName;
        $this->collBrandCampiagns->setModel('\entities\BrandCampiagn');
    }

    /**
     * Gets an array of ChildBrandCampiagn objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn> List of ChildBrandCampiagn objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagns(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnsPartial && !$this->isNew();
        if (null === $this->collBrandCampiagns || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagns) {
                    $this->initBrandCampiagns();
                } else {
                    $collectionClassName = BrandCampiagnTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagns = new $collectionClassName;
                    $collBrandCampiagns->setModel('\entities\BrandCampiagn');

                    return $collBrandCampiagns;
                }
            } else {
                $collBrandCampiagns = ChildBrandCampiagnQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnsPartial && count($collBrandCampiagns)) {
                        $this->initBrandCampiagns(false);

                        foreach ($collBrandCampiagns as $obj) {
                            if (false == $this->collBrandCampiagns->contains($obj)) {
                                $this->collBrandCampiagns->append($obj);
                            }
                        }

                        $this->collBrandCampiagnsPartial = true;
                    }

                    return $collBrandCampiagns;
                }

                if ($partial && $this->collBrandCampiagns) {
                    foreach ($this->collBrandCampiagns as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagns[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagns = $collBrandCampiagns;
                $this->collBrandCampiagnsPartial = false;
            }
        }

        return $this->collBrandCampiagns;
    }

    /**
     * Sets a collection of ChildBrandCampiagn objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagns A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagns(Collection $brandCampiagns, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagn[] $brandCampiagnsToDelete */
        $brandCampiagnsToDelete = $this->getBrandCampiagns(new Criteria(), $con)->diff($brandCampiagns);


        $this->brandCampiagnsScheduledForDeletion = $brandCampiagnsToDelete;

        foreach ($brandCampiagnsToDelete as $brandCampiagnRemoved) {
            $brandCampiagnRemoved->setBrands(null);
        }

        $this->collBrandCampiagns = null;
        foreach ($brandCampiagns as $brandCampiagn) {
            $this->addBrandCampiagn($brandCampiagn);
        }

        $this->collBrandCampiagns = $brandCampiagns;
        $this->collBrandCampiagnsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagn objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagn objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagns(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnsPartial && !$this->isNew();
        if (null === $this->collBrandCampiagns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagns());
            }

            $query = ChildBrandCampiagnQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collBrandCampiagns);
    }

    /**
     * Method called to associate a ChildBrandCampiagn object to this object
     * through the ChildBrandCampiagn foreign key attribute.
     *
     * @param ChildBrandCampiagn $l ChildBrandCampiagn
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagn(ChildBrandCampiagn $l)
    {
        if ($this->collBrandCampiagns === null) {
            $this->initBrandCampiagns();
            $this->collBrandCampiagnsPartial = true;
        }

        if (!$this->collBrandCampiagns->contains($l)) {
            $this->doAddBrandCampiagn($l);

            if ($this->brandCampiagnsScheduledForDeletion and $this->brandCampiagnsScheduledForDeletion->contains($l)) {
                $this->brandCampiagnsScheduledForDeletion->remove($this->brandCampiagnsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagn $brandCampiagn The ChildBrandCampiagn object to add.
     */
    protected function doAddBrandCampiagn(ChildBrandCampiagn $brandCampiagn): void
    {
        $this->collBrandCampiagns[]= $brandCampiagn;
        $brandCampiagn->setBrands($this);
    }

    /**
     * @param ChildBrandCampiagn $brandCampiagn The ChildBrandCampiagn object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagn(ChildBrandCampiagn $brandCampiagn)
    {
        if ($this->getBrandCampiagns()->contains($brandCampiagn)) {
            $pos = $this->collBrandCampiagns->search($brandCampiagn);
            $this->collBrandCampiagns->remove($pos);
            if (null === $this->brandCampiagnsScheduledForDeletion) {
                $this->brandCampiagnsScheduledForDeletion = clone $this->collBrandCampiagns;
                $this->brandCampiagnsScheduledForDeletion->clear();
            }
            $this->brandCampiagnsScheduledForDeletion[]= $brandCampiagn;
            $brandCampiagn->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinDesignations(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('Designations', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
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
     * If this ChildBrands is new, it will return
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
                    ->filterByBrands($this)
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
            $brandCompetitionRemoved->setBrands(null);
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
                ->filterByBrands($this)
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
        $brandCompetition->setBrands($this);
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
            $brandCompetition->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition}> List of ChildBrandCompetition objects
     */
    public function getBrandCompetitionsJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCompetitionQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getBrandCompetitions($query, $con);
    }

    /**
     * Clears out the collBrandRcpas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandRcpas()
     */
    public function clearBrandRcpas()
    {
        $this->collBrandRcpas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandRcpas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandRcpas($v = true): void
    {
        $this->collBrandRcpasPartial = $v;
    }

    /**
     * Initializes the collBrandRcpas collection.
     *
     * By default this just sets the collBrandRcpas collection to an empty array (like clearcollBrandRcpas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandRcpas(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandRcpas && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandRcpaTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandRcpas = new $collectionClassName;
        $this->collBrandRcpas->setModel('\entities\BrandRcpa');
    }

    /**
     * Gets an array of ChildBrandRcpa objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa> List of ChildBrandRcpa objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandRcpas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandRcpasPartial && !$this->isNew();
        if (null === $this->collBrandRcpas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandRcpas) {
                    $this->initBrandRcpas();
                } else {
                    $collectionClassName = BrandRcpaTableMap::getTableMap()->getCollectionClassName();

                    $collBrandRcpas = new $collectionClassName;
                    $collBrandRcpas->setModel('\entities\BrandRcpa');

                    return $collBrandRcpas;
                }
            } else {
                $collBrandRcpas = ChildBrandRcpaQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandRcpasPartial && count($collBrandRcpas)) {
                        $this->initBrandRcpas(false);

                        foreach ($collBrandRcpas as $obj) {
                            if (false == $this->collBrandRcpas->contains($obj)) {
                                $this->collBrandRcpas->append($obj);
                            }
                        }

                        $this->collBrandRcpasPartial = true;
                    }

                    return $collBrandRcpas;
                }

                if ($partial && $this->collBrandRcpas) {
                    foreach ($this->collBrandRcpas as $obj) {
                        if ($obj->isNew()) {
                            $collBrandRcpas[] = $obj;
                        }
                    }
                }

                $this->collBrandRcpas = $collBrandRcpas;
                $this->collBrandRcpasPartial = false;
            }
        }

        return $this->collBrandRcpas;
    }

    /**
     * Sets a collection of ChildBrandRcpa objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandRcpas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandRcpas(Collection $brandRcpas, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandRcpa[] $brandRcpasToDelete */
        $brandRcpasToDelete = $this->getBrandRcpas(new Criteria(), $con)->diff($brandRcpas);


        $this->brandRcpasScheduledForDeletion = $brandRcpasToDelete;

        foreach ($brandRcpasToDelete as $brandRcpaRemoved) {
            $brandRcpaRemoved->setBrands(null);
        }

        $this->collBrandRcpas = null;
        foreach ($brandRcpas as $brandRcpa) {
            $this->addBrandRcpa($brandRcpa);
        }

        $this->collBrandRcpas = $brandRcpas;
        $this->collBrandRcpasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandRcpa objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandRcpa objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandRcpas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandRcpasPartial && !$this->isNew();
        if (null === $this->collBrandRcpas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandRcpas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandRcpas());
            }

            $query = ChildBrandRcpaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collBrandRcpas);
    }

    /**
     * Method called to associate a ChildBrandRcpa object to this object
     * through the ChildBrandRcpa foreign key attribute.
     *
     * @param ChildBrandRcpa $l ChildBrandRcpa
     * @return $this The current object (for fluent API support)
     */
    public function addBrandRcpa(ChildBrandRcpa $l)
    {
        if ($this->collBrandRcpas === null) {
            $this->initBrandRcpas();
            $this->collBrandRcpasPartial = true;
        }

        if (!$this->collBrandRcpas->contains($l)) {
            $this->doAddBrandRcpa($l);

            if ($this->brandRcpasScheduledForDeletion and $this->brandRcpasScheduledForDeletion->contains($l)) {
                $this->brandRcpasScheduledForDeletion->remove($this->brandRcpasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandRcpa $brandRcpa The ChildBrandRcpa object to add.
     */
    protected function doAddBrandRcpa(ChildBrandRcpa $brandRcpa): void
    {
        $this->collBrandRcpas[]= $brandRcpa;
        $brandRcpa->setBrands($this);
    }

    /**
     * @param ChildBrandRcpa $brandRcpa The ChildBrandRcpa object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandRcpa(ChildBrandRcpa $brandRcpa)
    {
        if ($this->getBrandRcpas()->contains($brandRcpa)) {
            $pos = $this->collBrandRcpas->search($brandRcpa);
            $this->collBrandRcpas->remove($pos);
            if (null === $this->brandRcpasScheduledForDeletion) {
                $this->brandRcpasScheduledForDeletion = clone $this->collBrandRcpas;
                $this->brandRcpasScheduledForDeletion->clear();
            }
            $this->brandRcpasScheduledForDeletion[]= $brandRcpa;
            $brandRcpa->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }

    /**
     * Clears out the collEdPresentationss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdPresentationss()
     */
    public function clearEdPresentationss()
    {
        $this->collEdPresentationss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdPresentationss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdPresentationss($v = true): void
    {
        $this->collEdPresentationssPartial = $v;
    }

    /**
     * Initializes the collEdPresentationss collection.
     *
     * By default this just sets the collEdPresentationss collection to an empty array (like clearcollEdPresentationss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdPresentationss(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdPresentationss && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdPresentationsTableMap::getTableMap()->getCollectionClassName();

        $this->collEdPresentationss = new $collectionClassName;
        $this->collEdPresentationss->setModel('\entities\EdPresentations');
    }

    /**
     * Gets an array of ChildEdPresentations objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdPresentations[] List of ChildEdPresentations objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPresentations> List of ChildEdPresentations objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdPresentationss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdPresentationssPartial && !$this->isNew();
        if (null === $this->collEdPresentationss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdPresentationss) {
                    $this->initEdPresentationss();
                } else {
                    $collectionClassName = EdPresentationsTableMap::getTableMap()->getCollectionClassName();

                    $collEdPresentationss = new $collectionClassName;
                    $collEdPresentationss->setModel('\entities\EdPresentations');

                    return $collEdPresentationss;
                }
            } else {
                $collEdPresentationss = ChildEdPresentationsQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdPresentationssPartial && count($collEdPresentationss)) {
                        $this->initEdPresentationss(false);

                        foreach ($collEdPresentationss as $obj) {
                            if (false == $this->collEdPresentationss->contains($obj)) {
                                $this->collEdPresentationss->append($obj);
                            }
                        }

                        $this->collEdPresentationssPartial = true;
                    }

                    return $collEdPresentationss;
                }

                if ($partial && $this->collEdPresentationss) {
                    foreach ($this->collEdPresentationss as $obj) {
                        if ($obj->isNew()) {
                            $collEdPresentationss[] = $obj;
                        }
                    }
                }

                $this->collEdPresentationss = $collEdPresentationss;
                $this->collEdPresentationssPartial = false;
            }
        }

        return $this->collEdPresentationss;
    }

    /**
     * Sets a collection of ChildEdPresentations objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edPresentationss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdPresentationss(Collection $edPresentationss, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdPresentations[] $edPresentationssToDelete */
        $edPresentationssToDelete = $this->getEdPresentationss(new Criteria(), $con)->diff($edPresentationss);


        $this->edPresentationssScheduledForDeletion = $edPresentationssToDelete;

        foreach ($edPresentationssToDelete as $edPresentationsRemoved) {
            $edPresentationsRemoved->setBrands(null);
        }

        $this->collEdPresentationss = null;
        foreach ($edPresentationss as $edPresentations) {
            $this->addEdPresentations($edPresentations);
        }

        $this->collEdPresentationss = $edPresentationss;
        $this->collEdPresentationssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdPresentations objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdPresentations objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdPresentationss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdPresentationssPartial && !$this->isNew();
        if (null === $this->collEdPresentationss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdPresentationss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdPresentationss());
            }

            $query = ChildEdPresentationsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collEdPresentationss);
    }

    /**
     * Method called to associate a ChildEdPresentations object to this object
     * through the ChildEdPresentations foreign key attribute.
     *
     * @param ChildEdPresentations $l ChildEdPresentations
     * @return $this The current object (for fluent API support)
     */
    public function addEdPresentations(ChildEdPresentations $l)
    {
        if ($this->collEdPresentationss === null) {
            $this->initEdPresentationss();
            $this->collEdPresentationssPartial = true;
        }

        if (!$this->collEdPresentationss->contains($l)) {
            $this->doAddEdPresentations($l);

            if ($this->edPresentationssScheduledForDeletion and $this->edPresentationssScheduledForDeletion->contains($l)) {
                $this->edPresentationssScheduledForDeletion->remove($this->edPresentationssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdPresentations $edPresentations The ChildEdPresentations object to add.
     */
    protected function doAddEdPresentations(ChildEdPresentations $edPresentations): void
    {
        $this->collEdPresentationss[]= $edPresentations;
        $edPresentations->setBrands($this);
    }

    /**
     * @param ChildEdPresentations $edPresentations The ChildEdPresentations object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdPresentations(ChildEdPresentations $edPresentations)
    {
        if ($this->getEdPresentationss()->contains($edPresentations)) {
            $pos = $this->collEdPresentationss->search($edPresentations);
            $this->collEdPresentationss->remove($pos);
            if (null === $this->edPresentationssScheduledForDeletion) {
                $this->edPresentationssScheduledForDeletion = clone $this->collEdPresentationss;
                $this->edPresentationssScheduledForDeletion->clear();
            }
            $this->edPresentationssScheduledForDeletion[]= $edPresentations;
            $edPresentations->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related EdPresentationss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdPresentations[] List of ChildEdPresentations objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPresentations}> List of ChildEdPresentations objects
     */
    public function getEdPresentationssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdPresentationsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdPresentationss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related EdPresentationss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdPresentations[] List of ChildEdPresentations objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPresentations}> List of ChildEdPresentations objects
     */
    public function getEdPresentationssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdPresentationsQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getEdPresentationss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related EdPresentationss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdPresentations[] List of ChildEdPresentations objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPresentations}> List of ChildEdPresentations objects
     */
    public function getEdPresentationssJoinLanguage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdPresentationsQuery::create(null, $criteria);
        $query->joinWith('Language', $joinBehavior);

        return $this->getEdPresentationss($query, $con);
    }

    /**
     * Clears out the collEdStatss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdStatss()
     */
    public function clearEdStatss()
    {
        $this->collEdStatss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdStatss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdStatss($v = true): void
    {
        $this->collEdStatssPartial = $v;
    }

    /**
     * Initializes the collEdStatss collection.
     *
     * By default this just sets the collEdStatss collection to an empty array (like clearcollEdStatss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdStatss(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdStatss && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdStatsTableMap::getTableMap()->getCollectionClassName();

        $this->collEdStatss = new $collectionClassName;
        $this->collEdStatss->setModel('\entities\EdStats');
    }

    /**
     * Gets an array of ChildEdStats objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats> List of ChildEdStats objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdStatss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdStatssPartial && !$this->isNew();
        if (null === $this->collEdStatss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdStatss) {
                    $this->initEdStatss();
                } else {
                    $collectionClassName = EdStatsTableMap::getTableMap()->getCollectionClassName();

                    $collEdStatss = new $collectionClassName;
                    $collEdStatss->setModel('\entities\EdStats');

                    return $collEdStatss;
                }
            } else {
                $collEdStatss = ChildEdStatsQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdStatssPartial && count($collEdStatss)) {
                        $this->initEdStatss(false);

                        foreach ($collEdStatss as $obj) {
                            if (false == $this->collEdStatss->contains($obj)) {
                                $this->collEdStatss->append($obj);
                            }
                        }

                        $this->collEdStatssPartial = true;
                    }

                    return $collEdStatss;
                }

                if ($partial && $this->collEdStatss) {
                    foreach ($this->collEdStatss as $obj) {
                        if ($obj->isNew()) {
                            $collEdStatss[] = $obj;
                        }
                    }
                }

                $this->collEdStatss = $collEdStatss;
                $this->collEdStatssPartial = false;
            }
        }

        return $this->collEdStatss;
    }

    /**
     * Sets a collection of ChildEdStats objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edStatss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdStatss(Collection $edStatss, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdStats[] $edStatssToDelete */
        $edStatssToDelete = $this->getEdStatss(new Criteria(), $con)->diff($edStatss);


        $this->edStatssScheduledForDeletion = $edStatssToDelete;

        foreach ($edStatssToDelete as $edStatsRemoved) {
            $edStatsRemoved->setBrands(null);
        }

        $this->collEdStatss = null;
        foreach ($edStatss as $edStats) {
            $this->addEdStats($edStats);
        }

        $this->collEdStatss = $edStatss;
        $this->collEdStatssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdStats objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdStats objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdStatss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdStatssPartial && !$this->isNew();
        if (null === $this->collEdStatss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdStatss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdStatss());
            }

            $query = ChildEdStatsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collEdStatss);
    }

    /**
     * Method called to associate a ChildEdStats object to this object
     * through the ChildEdStats foreign key attribute.
     *
     * @param ChildEdStats $l ChildEdStats
     * @return $this The current object (for fluent API support)
     */
    public function addEdStats(ChildEdStats $l)
    {
        if ($this->collEdStatss === null) {
            $this->initEdStatss();
            $this->collEdStatssPartial = true;
        }

        if (!$this->collEdStatss->contains($l)) {
            $this->doAddEdStats($l);

            if ($this->edStatssScheduledForDeletion and $this->edStatssScheduledForDeletion->contains($l)) {
                $this->edStatssScheduledForDeletion->remove($this->edStatssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdStats $edStats The ChildEdStats object to add.
     */
    protected function doAddEdStats(ChildEdStats $edStats): void
    {
        $this->collEdStatss[]= $edStats;
        $edStats->setBrands($this);
    }

    /**
     * @param ChildEdStats $edStats The ChildEdStats object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdStats(ChildEdStats $edStats)
    {
        if ($this->getEdStatss()->contains($edStats)) {
            $pos = $this->collEdStatss->search($edStats);
            $this->collEdStatss->remove($pos);
            if (null === $this->edStatssScheduledForDeletion) {
                $this->edStatssScheduledForDeletion = clone $this->collEdStatss;
                $this->edStatssScheduledForDeletion->clear();
            }
            $this->edStatssScheduledForDeletion[]= $edStats;
            $edStats->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats}> List of ChildEdStats objects
     */
    public function getEdStatssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdStatsQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getEdStatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats}> List of ChildEdStats objects
     */
    public function getEdStatssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdStatsQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getEdStatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats}> List of ChildEdStats objects
     */
    public function getEdStatssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdStatsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdStatss($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestAddresses()
     */
    public function clearOnBoardRequestAddresses()
    {
        $this->collOnBoardRequestAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestAddresses($v = true): void
    {
        $this->collOnBoardRequestAddressesPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestAddresses collection.
     *
     * By default this just sets the collOnBoardRequestAddresses collection to an empty array (like clearcollOnBoardRequestAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestAddresses = new $collectionClassName;
        $this->collOnBoardRequestAddresses->setModel('\entities\OnBoardRequestAddress');
    }

    /**
     * Gets an array of ChildOnBoardRequestAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress> List of ChildOnBoardRequestAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestAddressesPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestAddresses) {
                    $this->initOnBoardRequestAddresses();
                } else {
                    $collectionClassName = OnBoardRequestAddressTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestAddresses = new $collectionClassName;
                    $collOnBoardRequestAddresses->setModel('\entities\OnBoardRequestAddress');

                    return $collOnBoardRequestAddresses;
                }
            } else {
                $collOnBoardRequestAddresses = ChildOnBoardRequestAddressQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestAddressesPartial && count($collOnBoardRequestAddresses)) {
                        $this->initOnBoardRequestAddresses(false);

                        foreach ($collOnBoardRequestAddresses as $obj) {
                            if (false == $this->collOnBoardRequestAddresses->contains($obj)) {
                                $this->collOnBoardRequestAddresses->append($obj);
                            }
                        }

                        $this->collOnBoardRequestAddressesPartial = true;
                    }

                    return $collOnBoardRequestAddresses;
                }

                if ($partial && $this->collOnBoardRequestAddresses) {
                    foreach ($this->collOnBoardRequestAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestAddresses[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestAddresses = $collOnBoardRequestAddresses;
                $this->collOnBoardRequestAddressesPartial = false;
            }
        }

        return $this->collOnBoardRequestAddresses;
    }

    /**
     * Sets a collection of ChildOnBoardRequestAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestAddresses(Collection $onBoardRequestAddresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequestAddress[] $onBoardRequestAddressesToDelete */
        $onBoardRequestAddressesToDelete = $this->getOnBoardRequestAddresses(new Criteria(), $con)->diff($onBoardRequestAddresses);


        $this->onBoardRequestAddressesScheduledForDeletion = $onBoardRequestAddressesToDelete;

        foreach ($onBoardRequestAddressesToDelete as $onBoardRequestAddressRemoved) {
            $onBoardRequestAddressRemoved->setBrands(null);
        }

        $this->collOnBoardRequestAddresses = null;
        foreach ($onBoardRequestAddresses as $onBoardRequestAddress) {
            $this->addOnBoardRequestAddress($onBoardRequestAddress);
        }

        $this->collOnBoardRequestAddresses = $onBoardRequestAddresses;
        $this->collOnBoardRequestAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequestAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequestAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestAddressesPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestAddresses());
            }

            $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestAddresses);
    }

    /**
     * Method called to associate a ChildOnBoardRequestAddress object to this object
     * through the ChildOnBoardRequestAddress foreign key attribute.
     *
     * @param ChildOnBoardRequestAddress $l ChildOnBoardRequestAddress
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestAddress(ChildOnBoardRequestAddress $l)
    {
        if ($this->collOnBoardRequestAddresses === null) {
            $this->initOnBoardRequestAddresses();
            $this->collOnBoardRequestAddressesPartial = true;
        }

        if (!$this->collOnBoardRequestAddresses->contains($l)) {
            $this->doAddOnBoardRequestAddress($l);

            if ($this->onBoardRequestAddressesScheduledForDeletion and $this->onBoardRequestAddressesScheduledForDeletion->contains($l)) {
                $this->onBoardRequestAddressesScheduledForDeletion->remove($this->onBoardRequestAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress The ChildOnBoardRequestAddress object to add.
     */
    protected function doAddOnBoardRequestAddress(ChildOnBoardRequestAddress $onBoardRequestAddress): void
    {
        $this->collOnBoardRequestAddresses[]= $onBoardRequestAddress;
        $onBoardRequestAddress->setBrands($this);
    }

    /**
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress The ChildOnBoardRequestAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestAddress(ChildOnBoardRequestAddress $onBoardRequestAddress)
    {
        if ($this->getOnBoardRequestAddresses()->contains($onBoardRequestAddress)) {
            $pos = $this->collOnBoardRequestAddresses->search($onBoardRequestAddress);
            $this->collOnBoardRequestAddresses->remove($pos);
            if (null === $this->onBoardRequestAddressesScheduledForDeletion) {
                $this->onBoardRequestAddressesScheduledForDeletion = clone $this->collOnBoardRequestAddresses;
                $this->onBoardRequestAddressesScheduledForDeletion->clear();
            }
            $this->onBoardRequestAddressesScheduledForDeletion[]= $onBoardRequestAddress;
            $onBoardRequestAddress->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletAddress', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletTags(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletTags', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoCity(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoCity', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoState', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOnBoardRequest(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OnBoardRequest', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
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
     * If this ChildBrands is new, it will return
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
                    ->filterByBrands($this)
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
            $outletStockRemoved->setBrands(null);
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
                ->filterByBrands($this)
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
        $outletStock->setBrands($this);
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
            $outletStock->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * If this ChildBrands is new, it will return
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
                    ->filterByBrands($this)
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
            $outletStockOtherSummaryRemoved->setBrands(null);
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
                ->filterByBrands($this)
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
        $outletStockOtherSummary->setBrands($this);
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
            $outletStockOtherSummary->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

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
     * If this ChildBrands is new, it will return
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
                    ->filterByBrands($this)
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
            $outletStockSummaryRemoved->setBrands(null);
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
                ->filterByBrands($this)
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
        $outletStockSummary->setBrands($this);
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
            $outletStockSummary->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }

    /**
     * Clears out the collPrescriberDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPrescriberDatas()
     */
    public function clearPrescriberDatas()
    {
        $this->collPrescriberDatas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPrescriberDatas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPrescriberDatas($v = true): void
    {
        $this->collPrescriberDatasPartial = $v;
    }

    /**
     * Initializes the collPrescriberDatas collection.
     *
     * By default this just sets the collPrescriberDatas collection to an empty array (like clearcollPrescriberDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrescriberDatas(bool $overrideExisting = true): void
    {
        if (null !== $this->collPrescriberDatas && !$overrideExisting) {
            return;
        }

        $collectionClassName = PrescriberDataTableMap::getTableMap()->getCollectionClassName();

        $this->collPrescriberDatas = new $collectionClassName;
        $this->collPrescriberDatas->setModel('\entities\PrescriberData');
    }

    /**
     * Gets an array of ChildPrescriberData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData> List of ChildPrescriberData objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPrescriberDatas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPrescriberDatasPartial && !$this->isNew();
        if (null === $this->collPrescriberDatas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrescriberDatas) {
                    $this->initPrescriberDatas();
                } else {
                    $collectionClassName = PrescriberDataTableMap::getTableMap()->getCollectionClassName();

                    $collPrescriberDatas = new $collectionClassName;
                    $collPrescriberDatas->setModel('\entities\PrescriberData');

                    return $collPrescriberDatas;
                }
            } else {
                $collPrescriberDatas = ChildPrescriberDataQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrescriberDatasPartial && count($collPrescriberDatas)) {
                        $this->initPrescriberDatas(false);

                        foreach ($collPrescriberDatas as $obj) {
                            if (false == $this->collPrescriberDatas->contains($obj)) {
                                $this->collPrescriberDatas->append($obj);
                            }
                        }

                        $this->collPrescriberDatasPartial = true;
                    }

                    return $collPrescriberDatas;
                }

                if ($partial && $this->collPrescriberDatas) {
                    foreach ($this->collPrescriberDatas as $obj) {
                        if ($obj->isNew()) {
                            $collPrescriberDatas[] = $obj;
                        }
                    }
                }

                $this->collPrescriberDatas = $collPrescriberDatas;
                $this->collPrescriberDatasPartial = false;
            }
        }

        return $this->collPrescriberDatas;
    }

    /**
     * Sets a collection of ChildPrescriberData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $prescriberDatas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPrescriberDatas(Collection $prescriberDatas, ?ConnectionInterface $con = null)
    {
        /** @var ChildPrescriberData[] $prescriberDatasToDelete */
        $prescriberDatasToDelete = $this->getPrescriberDatas(new Criteria(), $con)->diff($prescriberDatas);


        $this->prescriberDatasScheduledForDeletion = $prescriberDatasToDelete;

        foreach ($prescriberDatasToDelete as $prescriberDataRemoved) {
            $prescriberDataRemoved->setBrands(null);
        }

        $this->collPrescriberDatas = null;
        foreach ($prescriberDatas as $prescriberData) {
            $this->addPrescriberData($prescriberData);
        }

        $this->collPrescriberDatas = $prescriberDatas;
        $this->collPrescriberDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PrescriberData objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related PrescriberData objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPrescriberDatas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPrescriberDatasPartial && !$this->isNew();
        if (null === $this->collPrescriberDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrescriberDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrescriberDatas());
            }

            $query = ChildPrescriberDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collPrescriberDatas);
    }

    /**
     * Method called to associate a ChildPrescriberData object to this object
     * through the ChildPrescriberData foreign key attribute.
     *
     * @param ChildPrescriberData $l ChildPrescriberData
     * @return $this The current object (for fluent API support)
     */
    public function addPrescriberData(ChildPrescriberData $l)
    {
        if ($this->collPrescriberDatas === null) {
            $this->initPrescriberDatas();
            $this->collPrescriberDatasPartial = true;
        }

        if (!$this->collPrescriberDatas->contains($l)) {
            $this->doAddPrescriberData($l);

            if ($this->prescriberDatasScheduledForDeletion and $this->prescriberDatasScheduledForDeletion->contains($l)) {
                $this->prescriberDatasScheduledForDeletion->remove($this->prescriberDatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPrescriberData $prescriberData The ChildPrescriberData object to add.
     */
    protected function doAddPrescriberData(ChildPrescriberData $prescriberData): void
    {
        $this->collPrescriberDatas[]= $prescriberData;
        $prescriberData->setBrands($this);
    }

    /**
     * @param ChildPrescriberData $prescriberData The ChildPrescriberData object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePrescriberData(ChildPrescriberData $prescriberData)
    {
        if ($this->getPrescriberDatas()->contains($prescriberData)) {
            $pos = $this->collPrescriberDatas->search($prescriberData);
            $this->collPrescriberDatas->remove($pos);
            if (null === $this->prescriberDatasScheduledForDeletion) {
                $this->prescriberDatasScheduledForDeletion = clone $this->collPrescriberDatas;
                $this->prescriberDatasScheduledForDeletion->clear();
            }
            $this->prescriberDatasScheduledForDeletion[]= clone $prescriberData;
            $prescriberData->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }

    /**
     * Clears out the collPrescriberTallySummaries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPrescriberTallySummaries()
     */
    public function clearPrescriberTallySummaries()
    {
        $this->collPrescriberTallySummaries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPrescriberTallySummaries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPrescriberTallySummaries($v = true): void
    {
        $this->collPrescriberTallySummariesPartial = $v;
    }

    /**
     * Initializes the collPrescriberTallySummaries collection.
     *
     * By default this just sets the collPrescriberTallySummaries collection to an empty array (like clearcollPrescriberTallySummaries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrescriberTallySummaries(bool $overrideExisting = true): void
    {
        if (null !== $this->collPrescriberTallySummaries && !$overrideExisting) {
            return;
        }

        $collectionClassName = PrescriberTallySummaryTableMap::getTableMap()->getCollectionClassName();

        $this->collPrescriberTallySummaries = new $collectionClassName;
        $this->collPrescriberTallySummaries->setModel('\entities\PrescriberTallySummary');
    }

    /**
     * Gets an array of ChildPrescriberTallySummary objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary> List of ChildPrescriberTallySummary objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPrescriberTallySummaries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPrescriberTallySummariesPartial && !$this->isNew();
        if (null === $this->collPrescriberTallySummaries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrescriberTallySummaries) {
                    $this->initPrescriberTallySummaries();
                } else {
                    $collectionClassName = PrescriberTallySummaryTableMap::getTableMap()->getCollectionClassName();

                    $collPrescriberTallySummaries = new $collectionClassName;
                    $collPrescriberTallySummaries->setModel('\entities\PrescriberTallySummary');

                    return $collPrescriberTallySummaries;
                }
            } else {
                $collPrescriberTallySummaries = ChildPrescriberTallySummaryQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrescriberTallySummariesPartial && count($collPrescriberTallySummaries)) {
                        $this->initPrescriberTallySummaries(false);

                        foreach ($collPrescriberTallySummaries as $obj) {
                            if (false == $this->collPrescriberTallySummaries->contains($obj)) {
                                $this->collPrescriberTallySummaries->append($obj);
                            }
                        }

                        $this->collPrescriberTallySummariesPartial = true;
                    }

                    return $collPrescriberTallySummaries;
                }

                if ($partial && $this->collPrescriberTallySummaries) {
                    foreach ($this->collPrescriberTallySummaries as $obj) {
                        if ($obj->isNew()) {
                            $collPrescriberTallySummaries[] = $obj;
                        }
                    }
                }

                $this->collPrescriberTallySummaries = $collPrescriberTallySummaries;
                $this->collPrescriberTallySummariesPartial = false;
            }
        }

        return $this->collPrescriberTallySummaries;
    }

    /**
     * Sets a collection of ChildPrescriberTallySummary objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $prescriberTallySummaries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPrescriberTallySummaries(Collection $prescriberTallySummaries, ?ConnectionInterface $con = null)
    {
        /** @var ChildPrescriberTallySummary[] $prescriberTallySummariesToDelete */
        $prescriberTallySummariesToDelete = $this->getPrescriberTallySummaries(new Criteria(), $con)->diff($prescriberTallySummaries);


        $this->prescriberTallySummariesScheduledForDeletion = $prescriberTallySummariesToDelete;

        foreach ($prescriberTallySummariesToDelete as $prescriberTallySummaryRemoved) {
            $prescriberTallySummaryRemoved->setBrands(null);
        }

        $this->collPrescriberTallySummaries = null;
        foreach ($prescriberTallySummaries as $prescriberTallySummary) {
            $this->addPrescriberTallySummary($prescriberTallySummary);
        }

        $this->collPrescriberTallySummaries = $prescriberTallySummaries;
        $this->collPrescriberTallySummariesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PrescriberTallySummary objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related PrescriberTallySummary objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPrescriberTallySummaries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPrescriberTallySummariesPartial && !$this->isNew();
        if (null === $this->collPrescriberTallySummaries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrescriberTallySummaries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrescriberTallySummaries());
            }

            $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collPrescriberTallySummaries);
    }

    /**
     * Method called to associate a ChildPrescriberTallySummary object to this object
     * through the ChildPrescriberTallySummary foreign key attribute.
     *
     * @param ChildPrescriberTallySummary $l ChildPrescriberTallySummary
     * @return $this The current object (for fluent API support)
     */
    public function addPrescriberTallySummary(ChildPrescriberTallySummary $l)
    {
        if ($this->collPrescriberTallySummaries === null) {
            $this->initPrescriberTallySummaries();
            $this->collPrescriberTallySummariesPartial = true;
        }

        if (!$this->collPrescriberTallySummaries->contains($l)) {
            $this->doAddPrescriberTallySummary($l);

            if ($this->prescriberTallySummariesScheduledForDeletion and $this->prescriberTallySummariesScheduledForDeletion->contains($l)) {
                $this->prescriberTallySummariesScheduledForDeletion->remove($this->prescriberTallySummariesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPrescriberTallySummary $prescriberTallySummary The ChildPrescriberTallySummary object to add.
     */
    protected function doAddPrescriberTallySummary(ChildPrescriberTallySummary $prescriberTallySummary): void
    {
        $this->collPrescriberTallySummaries[]= $prescriberTallySummary;
        $prescriberTallySummary->setBrands($this);
    }

    /**
     * @param ChildPrescriberTallySummary $prescriberTallySummary The ChildPrescriberTallySummary object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePrescriberTallySummary(ChildPrescriberTallySummary $prescriberTallySummary)
    {
        if ($this->getPrescriberTallySummaries()->contains($prescriberTallySummary)) {
            $pos = $this->collPrescriberTallySummaries->search($prescriberTallySummary);
            $this->collPrescriberTallySummaries->remove($pos);
            if (null === $this->prescriberTallySummariesScheduledForDeletion) {
                $this->prescriberTallySummariesScheduledForDeletion = clone $this->collPrescriberTallySummaries;
                $this->prescriberTallySummariesScheduledForDeletion->clear();
            }
            $this->prescriberTallySummariesScheduledForDeletion[]= clone $prescriberTallySummary;
            $prescriberTallySummary->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }

    /**
     * Clears out the collProductss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductss()
     */
    public function clearProductss()
    {
        $this->collProductss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductss($v = true): void
    {
        $this->collProductssPartial = $v;
    }

    /**
     * Initializes the collProductss collection.
     *
     * By default this just sets the collProductss collection to an empty array (like clearcollProductss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductss(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductsTableMap::getTableMap()->getCollectionClassName();

        $this->collProductss = new $collectionClassName;
        $this->collProductss->setModel('\entities\Products');
    }

    /**
     * Gets an array of ChildProducts objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts> List of ChildProducts objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductssPartial && !$this->isNew();
        if (null === $this->collProductss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductss) {
                    $this->initProductss();
                } else {
                    $collectionClassName = ProductsTableMap::getTableMap()->getCollectionClassName();

                    $collProductss = new $collectionClassName;
                    $collProductss->setModel('\entities\Products');

                    return $collProductss;
                }
            } else {
                $collProductss = ChildProductsQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductssPartial && count($collProductss)) {
                        $this->initProductss(false);

                        foreach ($collProductss as $obj) {
                            if (false == $this->collProductss->contains($obj)) {
                                $this->collProductss->append($obj);
                            }
                        }

                        $this->collProductssPartial = true;
                    }

                    return $collProductss;
                }

                if ($partial && $this->collProductss) {
                    foreach ($this->collProductss as $obj) {
                        if ($obj->isNew()) {
                            $collProductss[] = $obj;
                        }
                    }
                }

                $this->collProductss = $collProductss;
                $this->collProductssPartial = false;
            }
        }

        return $this->collProductss;
    }

    /**
     * Sets a collection of ChildProducts objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductss(Collection $productss, ?ConnectionInterface $con = null)
    {
        /** @var ChildProducts[] $productssToDelete */
        $productssToDelete = $this->getProductss(new Criteria(), $con)->diff($productss);


        $this->productssScheduledForDeletion = $productssToDelete;

        foreach ($productssToDelete as $productsRemoved) {
            $productsRemoved->setBrands(null);
        }

        $this->collProductss = null;
        foreach ($productss as $products) {
            $this->addProducts($products);
        }

        $this->collProductss = $productss;
        $this->collProductssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Products objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Products objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductssPartial && !$this->isNew();
        if (null === $this->collProductss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductss());
            }

            $query = ChildProductsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collProductss);
    }

    /**
     * Method called to associate a ChildProducts object to this object
     * through the ChildProducts foreign key attribute.
     *
     * @param ChildProducts $l ChildProducts
     * @return $this The current object (for fluent API support)
     */
    public function addProducts(ChildProducts $l)
    {
        if ($this->collProductss === null) {
            $this->initProductss();
            $this->collProductssPartial = true;
        }

        if (!$this->collProductss->contains($l)) {
            $this->doAddProducts($l);

            if ($this->productssScheduledForDeletion and $this->productssScheduledForDeletion->contains($l)) {
                $this->productssScheduledForDeletion->remove($this->productssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProducts $products The ChildProducts object to add.
     */
    protected function doAddProducts(ChildProducts $products): void
    {
        $this->collProductss[]= $products;
        $products->setBrands($this);
    }

    /**
     * @param ChildProducts $products The ChildProducts object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProducts(ChildProducts $products)
    {
        if ($this->getProductss()->contains($products)) {
            $pos = $this->collProductss->search($products);
            $this->collProductss->remove($pos);
            if (null === $this->productssScheduledForDeletion) {
                $this->productssScheduledForDeletion = clone $this->collProductss;
                $this->productssScheduledForDeletion->clear();
            }
            $this->productssScheduledForDeletion[]= $products;
            $products->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related Productss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts}> List of ChildProducts objects
     */
    public function getProductssJoinCategories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductsQuery::create(null, $criteria);
        $query->joinWith('Categories', $joinBehavior);

        return $this->getProductss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related Productss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts}> List of ChildProducts objects
     */
    public function getProductssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getProductss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related Productss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts}> List of ChildProducts objects
     */
    public function getProductssJoinTags(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductsQuery::create(null, $criteria);
        $query->joinWith('Tags', $joinBehavior);

        return $this->getProductss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related Productss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts}> List of ChildProducts objects
     */
    public function getProductssJoinUnitmaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductsQuery::create(null, $criteria);
        $query->joinWith('Unitmaster', $joinBehavior);

        return $this->getProductss($query, $con);
    }

    /**
     * Clears out the collSgpiMasters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSgpiMasters()
     */
    public function clearSgpiMasters()
    {
        $this->collSgpiMasters = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSgpiMasters collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSgpiMasters($v = true): void
    {
        $this->collSgpiMastersPartial = $v;
    }

    /**
     * Initializes the collSgpiMasters collection.
     *
     * By default this just sets the collSgpiMasters collection to an empty array (like clearcollSgpiMasters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSgpiMasters(bool $overrideExisting = true): void
    {
        if (null !== $this->collSgpiMasters && !$overrideExisting) {
            return;
        }

        $collectionClassName = SgpiMasterTableMap::getTableMap()->getCollectionClassName();

        $this->collSgpiMasters = new $collectionClassName;
        $this->collSgpiMasters->setModel('\entities\SgpiMaster');
    }

    /**
     * Gets an array of ChildSgpiMaster objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrands is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster> List of ChildSgpiMaster objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSgpiMasters(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSgpiMastersPartial && !$this->isNew();
        if (null === $this->collSgpiMasters || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSgpiMasters) {
                    $this->initSgpiMasters();
                } else {
                    $collectionClassName = SgpiMasterTableMap::getTableMap()->getCollectionClassName();

                    $collSgpiMasters = new $collectionClassName;
                    $collSgpiMasters->setModel('\entities\SgpiMaster');

                    return $collSgpiMasters;
                }
            } else {
                $collSgpiMasters = ChildSgpiMasterQuery::create(null, $criteria)
                    ->filterByBrands($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSgpiMastersPartial && count($collSgpiMasters)) {
                        $this->initSgpiMasters(false);

                        foreach ($collSgpiMasters as $obj) {
                            if (false == $this->collSgpiMasters->contains($obj)) {
                                $this->collSgpiMasters->append($obj);
                            }
                        }

                        $this->collSgpiMastersPartial = true;
                    }

                    return $collSgpiMasters;
                }

                if ($partial && $this->collSgpiMasters) {
                    foreach ($this->collSgpiMasters as $obj) {
                        if ($obj->isNew()) {
                            $collSgpiMasters[] = $obj;
                        }
                    }
                }

                $this->collSgpiMasters = $collSgpiMasters;
                $this->collSgpiMastersPartial = false;
            }
        }

        return $this->collSgpiMasters;
    }

    /**
     * Sets a collection of ChildSgpiMaster objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $sgpiMasters A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiMasters(Collection $sgpiMasters, ?ConnectionInterface $con = null)
    {
        /** @var ChildSgpiMaster[] $sgpiMastersToDelete */
        $sgpiMastersToDelete = $this->getSgpiMasters(new Criteria(), $con)->diff($sgpiMasters);


        $this->sgpiMastersScheduledForDeletion = $sgpiMastersToDelete;

        foreach ($sgpiMastersToDelete as $sgpiMasterRemoved) {
            $sgpiMasterRemoved->setBrands(null);
        }

        $this->collSgpiMasters = null;
        foreach ($sgpiMasters as $sgpiMaster) {
            $this->addSgpiMaster($sgpiMaster);
        }

        $this->collSgpiMasters = $sgpiMasters;
        $this->collSgpiMastersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SgpiMaster objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SgpiMaster objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSgpiMasters(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSgpiMastersPartial && !$this->isNew();
        if (null === $this->collSgpiMasters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSgpiMasters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSgpiMasters());
            }

            $query = ChildSgpiMasterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrands($this)
                ->count($con);
        }

        return count($this->collSgpiMasters);
    }

    /**
     * Method called to associate a ChildSgpiMaster object to this object
     * through the ChildSgpiMaster foreign key attribute.
     *
     * @param ChildSgpiMaster $l ChildSgpiMaster
     * @return $this The current object (for fluent API support)
     */
    public function addSgpiMaster(ChildSgpiMaster $l)
    {
        if ($this->collSgpiMasters === null) {
            $this->initSgpiMasters();
            $this->collSgpiMastersPartial = true;
        }

        if (!$this->collSgpiMasters->contains($l)) {
            $this->doAddSgpiMaster($l);

            if ($this->sgpiMastersScheduledForDeletion and $this->sgpiMastersScheduledForDeletion->contains($l)) {
                $this->sgpiMastersScheduledForDeletion->remove($this->sgpiMastersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSgpiMaster $sgpiMaster The ChildSgpiMaster object to add.
     */
    protected function doAddSgpiMaster(ChildSgpiMaster $sgpiMaster): void
    {
        $this->collSgpiMasters[]= $sgpiMaster;
        $sgpiMaster->setBrands($this);
    }

    /**
     * @param ChildSgpiMaster $sgpiMaster The ChildSgpiMaster object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSgpiMaster(ChildSgpiMaster $sgpiMaster)
    {
        if ($this->getSgpiMasters()->contains($sgpiMaster)) {
            $pos = $this->collSgpiMasters->search($sgpiMaster);
            $this->collSgpiMasters->remove($pos);
            if (null === $this->sgpiMastersScheduledForDeletion) {
                $this->sgpiMastersScheduledForDeletion = clone $this->collSgpiMasters;
                $this->sgpiMastersScheduledForDeletion->clear();
            }
            $this->sgpiMastersScheduledForDeletion[]= $sgpiMaster;
            $sgpiMaster->setBrands(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster}> List of ChildSgpiMaster objects
     */
    public function getSgpiMastersJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiMasterQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSgpiMasters($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster}> List of ChildSgpiMaster objects
     */
    public function getSgpiMastersJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiMasterQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getSgpiMasters($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Brands is new, it will return
     * an empty collection; or if this Brands has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Brands.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster}> List of ChildSgpiMaster objects
     */
    public function getSgpiMastersJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiMasterQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getSgpiMasters($query, $con);
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
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeBrands($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeBrands($this);
        }
        $this->brand_id = null;
        $this->brand_name = null;
        $this->orgunitid = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->brand_code = null;
        $this->brand_rate = null;
        $this->min_value = null;
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
            if ($this->collBrandCampiagns) {
                foreach ($this->collBrandCampiagns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandCompetitions) {
                foreach ($this->collBrandCompetitions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandRcpas) {
                foreach ($this->collBrandRcpas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdPresentationss) {
                foreach ($this->collEdPresentationss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdStatss) {
                foreach ($this->collEdStatss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestAddresses) {
                foreach ($this->collOnBoardRequestAddresses as $o) {
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
            if ($this->collPrescriberDatas) {
                foreach ($this->collPrescriberDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPrescriberTallySummaries) {
                foreach ($this->collPrescriberTallySummaries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductss) {
                foreach ($this->collProductss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSgpiMasters) {
                foreach ($this->collSgpiMasters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagns = null;
        $this->collBrandCompetitions = null;
        $this->collBrandRcpas = null;
        $this->collEdPresentationss = null;
        $this->collEdStatss = null;
        $this->collOnBoardRequestAddresses = null;
        $this->collOutletStocks = null;
        $this->collOutletStockOtherSummaries = null;
        $this->collOutletStockSummaries = null;
        $this->collPrescriberDatas = null;
        $this->collPrescriberTallySummaries = null;
        $this->collProductss = null;
        $this->collSgpiMasters = null;
        $this->aOrgUnit = null;
        $this->aCompany = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BrandsTableMap::DEFAULT_STRING_FORMAT);
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
