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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\MediaFiles as ChildMediaFiles;
use entities\MediaFilesQuery as ChildMediaFilesQuery;
use entities\Offers as ChildOffers;
use entities\OffersQuery as ChildOffersQuery;
use entities\OnBoardRequest as ChildOnBoardRequest;
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\OnBoardRequestQuery as ChildOnBoardRequestQuery;
use entities\OnBoardRequiredFields as ChildOnBoardRequiredFields;
use entities\OnBoardRequiredFieldsQuery as ChildOnBoardRequiredFieldsQuery;
use entities\OutletOutcomes as ChildOutletOutcomes;
use entities\OutletOutcomesQuery as ChildOutletOutcomesQuery;
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Outlettypemodules as ChildOutlettypemodules;
use entities\OutlettypemodulesQuery as ChildOutlettypemodulesQuery;
use entities\SgpiMaster as ChildSgpiMaster;
use entities\SgpiMasterQuery as ChildSgpiMasterQuery;
use entities\Survey as ChildSurvey;
use entities\SurveyQuery as ChildSurveyQuery;
use entities\Map\BrandCampiagnTableMap;
use entities\Map\OffersTableMap;
use entities\Map\OnBoardRequestAddressTableMap;
use entities\Map\OnBoardRequestTableMap;
use entities\Map\OnBoardRequiredFieldsTableMap;
use entities\Map\OutletOutcomesTableMap;
use entities\Map\OutletTypeTableMap;
use entities\Map\OutletsTableMap;
use entities\Map\OutlettypemodulesTableMap;
use entities\Map\SgpiMasterTableMap;
use entities\Map\SurveyTableMap;

/**
 * Base class that represents a row from the 'outlet_type' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OutletType implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OutletTypeTableMap';


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
     * The value for the outlettype_id field.
     *
     * @var        int
     */
    protected $outlettype_id;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the outlettype_name field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $outlettype_name;

    /**
     * The value for the isoutletprimary field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $isoutletprimary;

    /**
     * The value for the isoutletendcustomer field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $isoutletendcustomer;

    /**
     * The value for the isenabled field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $isenabled;

    /**
     * The value for the outletparent field.
     *
     * @var        int|null
     */
    protected $outletparent;

    /**
     * The value for the image_media_id field.
     *
     * @var        int|null
     */
    protected $image_media_id;

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
     * The value for the onboard_enabled field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $onboard_enabled;

    /**
     * The value for the org_unit_id field.
     *
     * @var        string
     */
    protected $org_unit_id;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildMediaFiles
     */
    protected $aMediaFiles;

    /**
     * @var        ObjectCollection|ChildBrandCampiagn[] Collection to store aggregation of ChildBrandCampiagn objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagn> Collection to store aggregation of ChildBrandCampiagn objects.
     */
    protected $collBrandCampiagns;
    protected $collBrandCampiagnsPartial;

    /**
     * @var        ObjectCollection|ChildOffers[] Collection to store aggregation of ChildOffers objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOffers> Collection to store aggregation of ChildOffers objects.
     */
    protected $collOfferss;
    protected $collOfferssPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequests;
    protected $collOnBoardRequestsPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestAddress[] Collection to store aggregation of ChildOnBoardRequestAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress> Collection to store aggregation of ChildOnBoardRequestAddress objects.
     */
    protected $collOnBoardRequestAddresses;
    protected $collOnBoardRequestAddressesPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequiredFields[] Collection to store aggregation of ChildOnBoardRequiredFields objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequiredFields> Collection to store aggregation of ChildOnBoardRequiredFields objects.
     */
    protected $collOnBoardRequiredFieldss;
    protected $collOnBoardRequiredFieldssPartial;

    /**
     * @var        ObjectCollection|ChildOutletOutcomes[] Collection to store aggregation of ChildOutletOutcomes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOutcomes> Collection to store aggregation of ChildOutletOutcomes objects.
     */
    protected $collOutletOutcomess;
    protected $collOutletOutcomessPartial;

    /**
     * @var        ObjectCollection|ChildOutlets[] Collection to store aggregation of ChildOutlets objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutlets> Collection to store aggregation of ChildOutlets objects.
     */
    protected $collOutletss;
    protected $collOutletssPartial;

    /**
     * @var        ObjectCollection|ChildOutlettypemodules[] Collection to store aggregation of ChildOutlettypemodules objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutlettypemodules> Collection to store aggregation of ChildOutlettypemodules objects.
     */
    protected $collOutlettypemoduless;
    protected $collOutlettypemodulessPartial;

    /**
     * @var        ObjectCollection|ChildSgpiMaster[] Collection to store aggregation of ChildSgpiMaster objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSgpiMaster> Collection to store aggregation of ChildSgpiMaster objects.
     */
    protected $collSgpiMasters;
    protected $collSgpiMastersPartial;

    /**
     * @var        ObjectCollection|ChildSurvey[] Collection to store aggregation of ChildSurvey objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSurvey> Collection to store aggregation of ChildSurvey objects.
     */
    protected $collSurveys;
    protected $collSurveysPartial;

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
     * @var ObjectCollection|ChildOffers[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOffers>
     */
    protected $offerssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress>
     */
    protected $onBoardRequestAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequiredFields[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequiredFields>
     */
    protected $onBoardRequiredFieldssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletOutcomes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOutcomes>
     */
    protected $outletOutcomessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutlets[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutlets>
     */
    protected $outletssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutlettypemodules[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutlettypemodules>
     */
    protected $outlettypemodulessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSgpiMaster[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSgpiMaster>
     */
    protected $sgpiMastersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSurvey[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSurvey>
     */
    protected $surveysScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->outlettype_name = '';
        $this->isoutletprimary = 0;
        $this->isoutletendcustomer = 0;
        $this->isenabled = 0;
        $this->onboard_enabled = false;
    }

    /**
     * Initializes internal state of entities\Base\OutletType object.
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
     * Compares this with another <code>OutletType</code> instance.  If
     * <code>obj</code> is an instance of <code>OutletType</code>, delegates to
     * <code>equals(OutletType)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [outlettype_id] column value.
     *
     * @return int
     */
    public function getOutlettypeId()
    {
        return $this->outlettype_id;
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
     * Get the [outlettype_name] column value.
     *
     * @return string
     */
    public function getOutlettypeName()
    {
        return $this->outlettype_name;
    }

    /**
     * Get the [isoutletprimary] column value.
     *
     * @return int
     */
    public function getIsoutletprimary()
    {
        return $this->isoutletprimary;
    }

    /**
     * Get the [isoutletendcustomer] column value.
     *
     * @return int
     */
    public function getIsoutletendcustomer()
    {
        return $this->isoutletendcustomer;
    }

    /**
     * Get the [isenabled] column value.
     *
     * @return int
     */
    public function getIsenabled()
    {
        return $this->isenabled;
    }

    /**
     * Get the [outletparent] column value.
     *
     * @return int|null
     */
    public function getOutletparent()
    {
        return $this->outletparent;
    }

    /**
     * Get the [image_media_id] column value.
     *
     * @return int|null
     */
    public function getImageMediaId()
    {
        return $this->image_media_id;
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
     * Get the [onboard_enabled] column value.
     *
     * @return boolean|null
     */
    public function getOnboardEnabled()
    {
        return $this->onboard_enabled;
    }

    /**
     * Get the [onboard_enabled] column value.
     *
     * @return boolean|null
     */
    public function isOnboardEnabled()
    {
        return $this->getOnboardEnabled();
    }

    /**
     * Get the [org_unit_id] column value.
     *
     * @return string
     */
    public function getOrgUnitId()
    {
        return $this->org_unit_id;
    }

    /**
     * Set the value of [outlettype_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutlettypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlettype_id !== $v) {
            $this->outlettype_id = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_OUTLETTYPE_ID] = true;
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
            $this->modifiedColumns[OutletTypeTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutlettypeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlettype_name !== $v) {
            $this->outlettype_name = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_OUTLETTYPE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [isoutletprimary] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsoutletprimary($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->isoutletprimary !== $v) {
            $this->isoutletprimary = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_ISOUTLETPRIMARY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [isoutletendcustomer] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsoutletendcustomer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->isoutletendcustomer !== $v) {
            $this->isoutletendcustomer = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [isenabled] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsenabled($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->isenabled !== $v) {
            $this->isenabled = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_ISENABLED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outletparent] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletparent($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outletparent !== $v) {
            $this->outletparent = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_OUTLETPARENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [image_media_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setImageMediaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->image_media_id !== $v) {
            $this->image_media_id = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_IMAGE_MEDIA_ID] = true;
        }

        if ($this->aMediaFiles !== null && $this->aMediaFiles->getMediaId() !== $v) {
            $this->aMediaFiles = null;
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
                $this->modifiedColumns[OutletTypeTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[OutletTypeTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [onboard_enabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setOnboardEnabled($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->onboard_enabled !== $v) {
            $this->onboard_enabled = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_ONBOARD_ENABLED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[OutletTypeTableMap::COL_ORG_UNIT_ID] = true;
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
            if ($this->outlettype_name !== '') {
                return false;
            }

            if ($this->isoutletprimary !== 0) {
                return false;
            }

            if ($this->isoutletendcustomer !== 0) {
                return false;
            }

            if ($this->isenabled !== 0) {
                return false;
            }

            if ($this->onboard_enabled !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OutletTypeTableMap::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OutletTypeTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OutletTypeTableMap::translateFieldName('OutlettypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OutletTypeTableMap::translateFieldName('Isoutletprimary', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isoutletprimary = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OutletTypeTableMap::translateFieldName('Isoutletendcustomer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isoutletendcustomer = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OutletTypeTableMap::translateFieldName('Isenabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isenabled = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OutletTypeTableMap::translateFieldName('Outletparent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outletparent = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OutletTypeTableMap::translateFieldName('ImageMediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->image_media_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OutletTypeTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OutletTypeTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OutletTypeTableMap::translateFieldName('OnboardEnabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->onboard_enabled = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OutletTypeTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = OutletTypeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OutletType'), 0, $e);
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
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aMediaFiles !== null && $this->image_media_id !== $this->aMediaFiles->getMediaId()) {
            $this->aMediaFiles = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OutletTypeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOutletTypeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aMediaFiles = null;
            $this->collBrandCampiagns = null;

            $this->collOfferss = null;

            $this->collOnBoardRequests = null;

            $this->collOnBoardRequestAddresses = null;

            $this->collOnBoardRequiredFieldss = null;

            $this->collOutletOutcomess = null;

            $this->collOutletss = null;

            $this->collOutlettypemoduless = null;

            $this->collSgpiMasters = null;

            $this->collSurveys = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see OutletType::setDeleted()
     * @see OutletType::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletTypeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOutletTypeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletTypeTableMap::DATABASE_NAME);
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
                OutletTypeTableMap::addInstanceToPool($this);
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

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aMediaFiles !== null) {
                if ($this->aMediaFiles->isModified() || $this->aMediaFiles->isNew()) {
                    $affectedRows += $this->aMediaFiles->save($con);
                }
                $this->setMediaFiles($this->aMediaFiles);
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

            if ($this->offerssScheduledForDeletion !== null) {
                if (!$this->offerssScheduledForDeletion->isEmpty()) {
                    foreach ($this->offerssScheduledForDeletion as $offers) {
                        // need to save related object because we set the relation to null
                        $offers->save($con);
                    }
                    $this->offerssScheduledForDeletion = null;
                }
            }

            if ($this->collOfferss !== null) {
                foreach ($this->collOfferss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsScheduledForDeletion as $onBoardRequest) {
                        // need to save related object because we set the relation to null
                        $onBoardRequest->save($con);
                    }
                    $this->onBoardRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequests !== null) {
                foreach ($this->collOnBoardRequests as $referrerFK) {
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

            if ($this->onBoardRequiredFieldssScheduledForDeletion !== null) {
                if (!$this->onBoardRequiredFieldssScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequiredFieldssScheduledForDeletion as $onBoardRequiredFields) {
                        // need to save related object because we set the relation to null
                        $onBoardRequiredFields->save($con);
                    }
                    $this->onBoardRequiredFieldssScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequiredFieldss !== null) {
                foreach ($this->collOnBoardRequiredFieldss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletOutcomessScheduledForDeletion !== null) {
                if (!$this->outletOutcomessScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletOutcomessScheduledForDeletion as $outletOutcomes) {
                        // need to save related object because we set the relation to null
                        $outletOutcomes->save($con);
                    }
                    $this->outletOutcomessScheduledForDeletion = null;
                }
            }

            if ($this->collOutletOutcomess !== null) {
                foreach ($this->collOutletOutcomess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletssScheduledForDeletion !== null) {
                if (!$this->outletssScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletssScheduledForDeletion as $outlets) {
                        // need to save related object because we set the relation to null
                        $outlets->save($con);
                    }
                    $this->outletssScheduledForDeletion = null;
                }
            }

            if ($this->collOutletss !== null) {
                foreach ($this->collOutletss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outlettypemodulessScheduledForDeletion !== null) {
                if (!$this->outlettypemodulessScheduledForDeletion->isEmpty()) {
                    foreach ($this->outlettypemodulessScheduledForDeletion as $outlettypemodules) {
                        // need to save related object because we set the relation to null
                        $outlettypemodules->save($con);
                    }
                    $this->outlettypemodulessScheduledForDeletion = null;
                }
            }

            if ($this->collOutlettypemoduless !== null) {
                foreach ($this->collOutlettypemoduless as $referrerFK) {
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

            if ($this->surveysScheduledForDeletion !== null) {
                if (!$this->surveysScheduledForDeletion->isEmpty()) {
                    \entities\SurveyQuery::create()
                        ->filterByPrimaryKeys($this->surveysScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->surveysScheduledForDeletion = null;
                }
            }

            if ($this->collSurveys !== null) {
                foreach ($this->collSurveys as $referrerFK) {
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

        $this->modifiedColumns[OutletTypeTableMap::COL_OUTLETTYPE_ID] = true;
        if (null !== $this->outlettype_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OutletTypeTableMap::COL_OUTLETTYPE_ID . ')');
        }
        if (null === $this->outlettype_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('outlet_type_outlettype_id_seq')");
                $this->outlettype_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OutletTypeTableMap::COL_OUTLETTYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlettype_id';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_OUTLETTYPE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'outlettype_name';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ISOUTLETPRIMARY)) {
            $modifiedColumns[':p' . $index++]  = 'isoutletprimary';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER)) {
            $modifiedColumns[':p' . $index++]  = 'isoutletendcustomer';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ISENABLED)) {
            $modifiedColumns[':p' . $index++]  = 'isenabled';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_OUTLETPARENT)) {
            $modifiedColumns[':p' . $index++]  = 'outletparent';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_IMAGE_MEDIA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'image_media_id';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ONBOARD_ENABLED)) {
            $modifiedColumns[':p' . $index++]  = 'onboard_enabled';
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_id';
        }

        $sql = sprintf(
            'INSERT INTO outlet_type (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'outlettype_id':
                        $stmt->bindValue($identifier, $this->outlettype_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'outlettype_name':
                        $stmt->bindValue($identifier, $this->outlettype_name, PDO::PARAM_STR);

                        break;
                    case 'isoutletprimary':
                        $stmt->bindValue($identifier, $this->isoutletprimary, PDO::PARAM_INT);

                        break;
                    case 'isoutletendcustomer':
                        $stmt->bindValue($identifier, $this->isoutletendcustomer, PDO::PARAM_INT);

                        break;
                    case 'isenabled':
                        $stmt->bindValue($identifier, $this->isenabled, PDO::PARAM_INT);

                        break;
                    case 'outletparent':
                        $stmt->bindValue($identifier, $this->outletparent, PDO::PARAM_INT);

                        break;
                    case 'image_media_id':
                        $stmt->bindValue($identifier, $this->image_media_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'onboard_enabled':
                        $stmt->bindValue($identifier, $this->onboard_enabled, PDO::PARAM_BOOL);

                        break;
                    case 'org_unit_id':
                        $stmt->bindValue($identifier, $this->org_unit_id, PDO::PARAM_STR);

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
        $pos = OutletTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOutlettypeId();

            case 1:
                return $this->getCompanyId();

            case 2:
                return $this->getOutlettypeName();

            case 3:
                return $this->getIsoutletprimary();

            case 4:
                return $this->getIsoutletendcustomer();

            case 5:
                return $this->getIsenabled();

            case 6:
                return $this->getOutletparent();

            case 7:
                return $this->getImageMediaId();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getUpdatedAt();

            case 10:
                return $this->getOnboardEnabled();

            case 11:
                return $this->getOrgUnitId();

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
        if (isset($alreadyDumpedObjects['OutletType'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OutletType'][$this->hashCode()] = true;
        $keys = OutletTypeTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOutlettypeId(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getOutlettypeName(),
            $keys[3] => $this->getIsoutletprimary(),
            $keys[4] => $this->getIsoutletendcustomer(),
            $keys[5] => $this->getIsenabled(),
            $keys[6] => $this->getOutletparent(),
            $keys[7] => $this->getImageMediaId(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
            $keys[10] => $this->getOnboardEnabled(),
            $keys[11] => $this->getOrgUnitId(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->aMediaFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mediaFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'media_files';
                        break;
                    default:
                        $key = 'MediaFiles';
                }

                $result[$key] = $this->aMediaFiles->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collOfferss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'offerss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'offerss';
                        break;
                    default:
                        $key = 'Offerss';
                }

                $result[$key] = $this->collOfferss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOnBoardRequiredFieldss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequiredFieldss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_required_fieldss';
                        break;
                    default:
                        $key = 'OnBoardRequiredFieldss';
                }

                $result[$key] = $this->collOnBoardRequiredFieldss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletOutcomess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletOutcomess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_outcomess';
                        break;
                    default:
                        $key = 'OutletOutcomess';
                }

                $result[$key] = $this->collOutletOutcomess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outletss';
                        break;
                    default:
                        $key = 'Outletss';
                }

                $result[$key] = $this->collOutletss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutlettypemoduless) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outlettypemoduless';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlettypemoduless';
                        break;
                    default:
                        $key = 'Outlettypemoduless';
                }

                $result[$key] = $this->collOutlettypemoduless->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSurveys) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveys';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'surveys';
                        break;
                    default:
                        $key = 'Surveys';
                }

                $result[$key] = $this->collSurveys->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = OutletTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOutlettypeId($value);
                break;
            case 1:
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setOutlettypeName($value);
                break;
            case 3:
                $this->setIsoutletprimary($value);
                break;
            case 4:
                $this->setIsoutletendcustomer($value);
                break;
            case 5:
                $this->setIsenabled($value);
                break;
            case 6:
                $this->setOutletparent($value);
                break;
            case 7:
                $this->setImageMediaId($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setUpdatedAt($value);
                break;
            case 10:
                $this->setOnboardEnabled($value);
                break;
            case 11:
                $this->setOrgUnitId($value);
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
        $keys = OutletTypeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOutlettypeId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOutlettypeName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsoutletprimary($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsoutletendcustomer($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsenabled($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setOutletparent($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setImageMediaId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOnboardEnabled($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setOrgUnitId($arr[$keys[11]]);
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
        $criteria = new Criteria(OutletTypeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OutletTypeTableMap::COL_OUTLETTYPE_ID)) {
            $criteria->add(OutletTypeTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_COMPANY_ID)) {
            $criteria->add(OutletTypeTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_OUTLETTYPE_NAME)) {
            $criteria->add(OutletTypeTableMap::COL_OUTLETTYPE_NAME, $this->outlettype_name);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ISOUTLETPRIMARY)) {
            $criteria->add(OutletTypeTableMap::COL_ISOUTLETPRIMARY, $this->isoutletprimary);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER)) {
            $criteria->add(OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER, $this->isoutletendcustomer);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ISENABLED)) {
            $criteria->add(OutletTypeTableMap::COL_ISENABLED, $this->isenabled);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_OUTLETPARENT)) {
            $criteria->add(OutletTypeTableMap::COL_OUTLETPARENT, $this->outletparent);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_IMAGE_MEDIA_ID)) {
            $criteria->add(OutletTypeTableMap::COL_IMAGE_MEDIA_ID, $this->image_media_id);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_CREATED_AT)) {
            $criteria->add(OutletTypeTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_UPDATED_AT)) {
            $criteria->add(OutletTypeTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ONBOARD_ENABLED)) {
            $criteria->add(OutletTypeTableMap::COL_ONBOARD_ENABLED, $this->onboard_enabled);
        }
        if ($this->isColumnModified(OutletTypeTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(OutletTypeTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
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
        $criteria = ChildOutletTypeQuery::create();
        $criteria->add(OutletTypeTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);

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
        $validPk = null !== $this->getOutlettypeId();

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
        return $this->getOutlettypeId();
    }

    /**
     * Generic method to set the primary key (outlettype_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setOutlettypeId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOutlettypeId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OutletType (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setOutlettypeName($this->getOutlettypeName());
        $copyObj->setIsoutletprimary($this->getIsoutletprimary());
        $copyObj->setIsoutletendcustomer($this->getIsoutletendcustomer());
        $copyObj->setIsenabled($this->getIsenabled());
        $copyObj->setOutletparent($this->getOutletparent());
        $copyObj->setImageMediaId($this->getImageMediaId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOnboardEnabled($this->getOnboardEnabled());
        $copyObj->setOrgUnitId($this->getOrgUnitId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagn($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOfferss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOffers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequiredFieldss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequiredFields($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletOutcomess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletOutcomes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutlets($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutlettypemoduless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutlettypemodules($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSgpiMasters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSgpiMaster($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSurveys() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSurvey($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOutlettypeId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\OutletType Clone of current object.
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
            $v->addOutletType($this);
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
                $this->aCompany->addOutletTypes($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildMediaFiles object.
     *
     * @param ChildMediaFiles|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMediaFiles(ChildMediaFiles $v = null)
    {
        if ($v === null) {
            $this->setImageMediaId(NULL);
        } else {
            $this->setImageMediaId($v->getMediaId());
        }

        $this->aMediaFiles = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMediaFiles object, it will not be re-added.
        if ($v !== null) {
            $v->addOutletType($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMediaFiles object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildMediaFiles|null The associated ChildMediaFiles object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMediaFiles(?ConnectionInterface $con = null)
    {
        if ($this->aMediaFiles === null && ($this->image_media_id != 0)) {
            $this->aMediaFiles = ChildMediaFilesQuery::create()->findPk($this->image_media_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMediaFiles->addOutletTypes($this);
             */
        }

        return $this->aMediaFiles;
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
        if ('Offers' === $relationName) {
            $this->initOfferss();
            return;
        }
        if ('OnBoardRequest' === $relationName) {
            $this->initOnBoardRequests();
            return;
        }
        if ('OnBoardRequestAddress' === $relationName) {
            $this->initOnBoardRequestAddresses();
            return;
        }
        if ('OnBoardRequiredFields' === $relationName) {
            $this->initOnBoardRequiredFieldss();
            return;
        }
        if ('OutletOutcomes' === $relationName) {
            $this->initOutletOutcomess();
            return;
        }
        if ('Outlets' === $relationName) {
            $this->initOutletss();
            return;
        }
        if ('Outlettypemodules' === $relationName) {
            $this->initOutlettypemoduless();
            return;
        }
        if ('SgpiMaster' === $relationName) {
            $this->initSgpiMasters();
            return;
        }
        if ('Survey' === $relationName) {
            $this->initSurveys();
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
     * If this ChildOutletType is new, it will return
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
                    ->filterByOutletType($this)
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
            $brandCampiagnRemoved->setOutletType(null);
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
                ->filterByOutletType($this)
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
        $brandCampiagn->setOutletType($this);
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
            $brandCampiagn->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Clears out the collOfferss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOfferss()
     */
    public function clearOfferss()
    {
        $this->collOfferss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOfferss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOfferss($v = true): void
    {
        $this->collOfferssPartial = $v;
    }

    /**
     * Initializes the collOfferss collection.
     *
     * By default this just sets the collOfferss collection to an empty array (like clearcollOfferss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOfferss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOfferss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OffersTableMap::getTableMap()->getCollectionClassName();

        $this->collOfferss = new $collectionClassName;
        $this->collOfferss->setModel('\entities\Offers');
    }

    /**
     * Gets an array of ChildOffers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers> List of ChildOffers objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOfferss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOfferssPartial && !$this->isNew();
        if (null === $this->collOfferss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOfferss) {
                    $this->initOfferss();
                } else {
                    $collectionClassName = OffersTableMap::getTableMap()->getCollectionClassName();

                    $collOfferss = new $collectionClassName;
                    $collOfferss->setModel('\entities\Offers');

                    return $collOfferss;
                }
            } else {
                $collOfferss = ChildOffersQuery::create(null, $criteria)
                    ->filterByOutletType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOfferssPartial && count($collOfferss)) {
                        $this->initOfferss(false);

                        foreach ($collOfferss as $obj) {
                            if (false == $this->collOfferss->contains($obj)) {
                                $this->collOfferss->append($obj);
                            }
                        }

                        $this->collOfferssPartial = true;
                    }

                    return $collOfferss;
                }

                if ($partial && $this->collOfferss) {
                    foreach ($this->collOfferss as $obj) {
                        if ($obj->isNew()) {
                            $collOfferss[] = $obj;
                        }
                    }
                }

                $this->collOfferss = $collOfferss;
                $this->collOfferssPartial = false;
            }
        }

        return $this->collOfferss;
    }

    /**
     * Sets a collection of ChildOffers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $offerss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOfferss(Collection $offerss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOffers[] $offerssToDelete */
        $offerssToDelete = $this->getOfferss(new Criteria(), $con)->diff($offerss);


        $this->offerssScheduledForDeletion = $offerssToDelete;

        foreach ($offerssToDelete as $offersRemoved) {
            $offersRemoved->setOutletType(null);
        }

        $this->collOfferss = null;
        foreach ($offerss as $offers) {
            $this->addOffers($offers);
        }

        $this->collOfferss = $offerss;
        $this->collOfferssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Offers objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Offers objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOfferss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOfferssPartial && !$this->isNew();
        if (null === $this->collOfferss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOfferss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOfferss());
            }

            $query = ChildOffersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletType($this)
                ->count($con);
        }

        return count($this->collOfferss);
    }

    /**
     * Method called to associate a ChildOffers object to this object
     * through the ChildOffers foreign key attribute.
     *
     * @param ChildOffers $l ChildOffers
     * @return $this The current object (for fluent API support)
     */
    public function addOffers(ChildOffers $l)
    {
        if ($this->collOfferss === null) {
            $this->initOfferss();
            $this->collOfferssPartial = true;
        }

        if (!$this->collOfferss->contains($l)) {
            $this->doAddOffers($l);

            if ($this->offerssScheduledForDeletion and $this->offerssScheduledForDeletion->contains($l)) {
                $this->offerssScheduledForDeletion->remove($this->offerssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOffers $offers The ChildOffers object to add.
     */
    protected function doAddOffers(ChildOffers $offers): void
    {
        $this->collOfferss[]= $offers;
        $offers->setOutletType($this);
    }

    /**
     * @param ChildOffers $offers The ChildOffers object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOffers(ChildOffers $offers)
    {
        if ($this->getOfferss()->contains($offers)) {
            $pos = $this->collOfferss->search($offers);
            $this->collOfferss->remove($pos);
            if (null === $this->offerssScheduledForDeletion) {
                $this->offerssScheduledForDeletion = clone $this->collOfferss;
                $this->offerssScheduledForDeletion->clear();
            }
            $this->offerssScheduledForDeletion[]= $offers;
            $offers->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOfferss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOfferss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinMediaFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('MediaFiles', $joinBehavior);

        return $this->getOfferss($query, $con);
    }

    /**
     * Clears out the collOnBoardRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequests()
     */
    public function clearOnBoardRequests()
    {
        $this->collOnBoardRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequests($v = true): void
    {
        $this->collOnBoardRequestsPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequests collection.
     *
     * By default this just sets the collOnBoardRequests collection to an empty array (like clearcollOnBoardRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequests = new $collectionClassName;
        $this->collOnBoardRequests->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequests) {
                    $this->initOnBoardRequests();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequests = new $collectionClassName;
                    $collOnBoardRequests->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequests;
                }
            } else {
                $collOnBoardRequests = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByOutletType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsPartial && count($collOnBoardRequests)) {
                        $this->initOnBoardRequests(false);

                        foreach ($collOnBoardRequests as $obj) {
                            if (false == $this->collOnBoardRequests->contains($obj)) {
                                $this->collOnBoardRequests->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsPartial = true;
                    }

                    return $collOnBoardRequests;
                }

                if ($partial && $this->collOnBoardRequests) {
                    foreach ($this->collOnBoardRequests as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequests[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequests = $collOnBoardRequests;
                $this->collOnBoardRequestsPartial = false;
            }
        }

        return $this->collOnBoardRequests;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequests(Collection $onBoardRequests, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsToDelete */
        $onBoardRequestsToDelete = $this->getOnBoardRequests(new Criteria(), $con)->diff($onBoardRequests);


        $this->onBoardRequestsScheduledForDeletion = $onBoardRequestsToDelete;

        foreach ($onBoardRequestsToDelete as $onBoardRequestRemoved) {
            $onBoardRequestRemoved->setOutletType(null);
        }

        $this->collOnBoardRequests = null;
        foreach ($onBoardRequests as $onBoardRequest) {
            $this->addOnBoardRequest($onBoardRequest);
        }

        $this->collOnBoardRequests = $onBoardRequests;
        $this->collOnBoardRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequests());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletType($this)
                ->count($con);
        }

        return count($this->collOnBoardRequests);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequest(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequests === null) {
            $this->initOnBoardRequests();
            $this->collOnBoardRequestsPartial = true;
        }

        if (!$this->collOnBoardRequests->contains($l)) {
            $this->doAddOnBoardRequest($l);

            if ($this->onBoardRequestsScheduledForDeletion and $this->onBoardRequestsScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsScheduledForDeletion->remove($this->onBoardRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequest The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequest(ChildOnBoardRequest $onBoardRequest): void
    {
        $this->collOnBoardRequests[]= $onBoardRequest;
        $onBoardRequest->setOutletType($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequest The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequest(ChildOnBoardRequest $onBoardRequest)
    {
        if ($this->getOnBoardRequests()->contains($onBoardRequest)) {
            $pos = $this->collOnBoardRequests->search($onBoardRequest);
            $this->collOnBoardRequests->remove($pos);
            if (null === $this->onBoardRequestsScheduledForDeletion) {
                $this->onBoardRequestsScheduledForDeletion = clone $this->collOnBoardRequests;
                $this->onBoardRequestsScheduledForDeletion->clear();
            }
            $this->onBoardRequestsScheduledForDeletion[]= $onBoardRequest;
            $onBoardRequest->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByCreatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByCreatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByCreatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByFinalApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByFinalApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPosition', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByUpdatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByUpdatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByUpdatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
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
     * If this ChildOutletType is new, it will return
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
                    ->filterByOutletType($this)
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
            $onBoardRequestAddressRemoved->setOutletType(null);
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
                ->filterByOutletType($this)
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
        $onBoardRequestAddress->setOutletType($this);
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
            $onBoardRequestAddress->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Clears out the collOnBoardRequiredFieldss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequiredFieldss()
     */
    public function clearOnBoardRequiredFieldss()
    {
        $this->collOnBoardRequiredFieldss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequiredFieldss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequiredFieldss($v = true): void
    {
        $this->collOnBoardRequiredFieldssPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequiredFieldss collection.
     *
     * By default this just sets the collOnBoardRequiredFieldss collection to an empty array (like clearcollOnBoardRequiredFieldss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequiredFieldss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequiredFieldss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequiredFieldsTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequiredFieldss = new $collectionClassName;
        $this->collOnBoardRequiredFieldss->setModel('\entities\OnBoardRequiredFields');
    }

    /**
     * Gets an array of ChildOnBoardRequiredFields objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequiredFields[] List of ChildOnBoardRequiredFields objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequiredFields> List of ChildOnBoardRequiredFields objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequiredFieldss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequiredFieldssPartial && !$this->isNew();
        if (null === $this->collOnBoardRequiredFieldss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequiredFieldss) {
                    $this->initOnBoardRequiredFieldss();
                } else {
                    $collectionClassName = OnBoardRequiredFieldsTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequiredFieldss = new $collectionClassName;
                    $collOnBoardRequiredFieldss->setModel('\entities\OnBoardRequiredFields');

                    return $collOnBoardRequiredFieldss;
                }
            } else {
                $collOnBoardRequiredFieldss = ChildOnBoardRequiredFieldsQuery::create(null, $criteria)
                    ->filterByOutletType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequiredFieldssPartial && count($collOnBoardRequiredFieldss)) {
                        $this->initOnBoardRequiredFieldss(false);

                        foreach ($collOnBoardRequiredFieldss as $obj) {
                            if (false == $this->collOnBoardRequiredFieldss->contains($obj)) {
                                $this->collOnBoardRequiredFieldss->append($obj);
                            }
                        }

                        $this->collOnBoardRequiredFieldssPartial = true;
                    }

                    return $collOnBoardRequiredFieldss;
                }

                if ($partial && $this->collOnBoardRequiredFieldss) {
                    foreach ($this->collOnBoardRequiredFieldss as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequiredFieldss[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequiredFieldss = $collOnBoardRequiredFieldss;
                $this->collOnBoardRequiredFieldssPartial = false;
            }
        }

        return $this->collOnBoardRequiredFieldss;
    }

    /**
     * Sets a collection of ChildOnBoardRequiredFields objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequiredFieldss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequiredFieldss(Collection $onBoardRequiredFieldss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequiredFields[] $onBoardRequiredFieldssToDelete */
        $onBoardRequiredFieldssToDelete = $this->getOnBoardRequiredFieldss(new Criteria(), $con)->diff($onBoardRequiredFieldss);


        $this->onBoardRequiredFieldssScheduledForDeletion = $onBoardRequiredFieldssToDelete;

        foreach ($onBoardRequiredFieldssToDelete as $onBoardRequiredFieldsRemoved) {
            $onBoardRequiredFieldsRemoved->setOutletType(null);
        }

        $this->collOnBoardRequiredFieldss = null;
        foreach ($onBoardRequiredFieldss as $onBoardRequiredFields) {
            $this->addOnBoardRequiredFields($onBoardRequiredFields);
        }

        $this->collOnBoardRequiredFieldss = $onBoardRequiredFieldss;
        $this->collOnBoardRequiredFieldssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequiredFields objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequiredFields objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequiredFieldss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequiredFieldssPartial && !$this->isNew();
        if (null === $this->collOnBoardRequiredFieldss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequiredFieldss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequiredFieldss());
            }

            $query = ChildOnBoardRequiredFieldsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletType($this)
                ->count($con);
        }

        return count($this->collOnBoardRequiredFieldss);
    }

    /**
     * Method called to associate a ChildOnBoardRequiredFields object to this object
     * through the ChildOnBoardRequiredFields foreign key attribute.
     *
     * @param ChildOnBoardRequiredFields $l ChildOnBoardRequiredFields
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequiredFields(ChildOnBoardRequiredFields $l)
    {
        if ($this->collOnBoardRequiredFieldss === null) {
            $this->initOnBoardRequiredFieldss();
            $this->collOnBoardRequiredFieldssPartial = true;
        }

        if (!$this->collOnBoardRequiredFieldss->contains($l)) {
            $this->doAddOnBoardRequiredFields($l);

            if ($this->onBoardRequiredFieldssScheduledForDeletion and $this->onBoardRequiredFieldssScheduledForDeletion->contains($l)) {
                $this->onBoardRequiredFieldssScheduledForDeletion->remove($this->onBoardRequiredFieldssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequiredFields $onBoardRequiredFields The ChildOnBoardRequiredFields object to add.
     */
    protected function doAddOnBoardRequiredFields(ChildOnBoardRequiredFields $onBoardRequiredFields): void
    {
        $this->collOnBoardRequiredFieldss[]= $onBoardRequiredFields;
        $onBoardRequiredFields->setOutletType($this);
    }

    /**
     * @param ChildOnBoardRequiredFields $onBoardRequiredFields The ChildOnBoardRequiredFields object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequiredFields(ChildOnBoardRequiredFields $onBoardRequiredFields)
    {
        if ($this->getOnBoardRequiredFieldss()->contains($onBoardRequiredFields)) {
            $pos = $this->collOnBoardRequiredFieldss->search($onBoardRequiredFields);
            $this->collOnBoardRequiredFieldss->remove($pos);
            if (null === $this->onBoardRequiredFieldssScheduledForDeletion) {
                $this->onBoardRequiredFieldssScheduledForDeletion = clone $this->collOnBoardRequiredFieldss;
                $this->onBoardRequiredFieldssScheduledForDeletion->clear();
            }
            $this->onBoardRequiredFieldssScheduledForDeletion[]= $onBoardRequiredFields;
            $onBoardRequiredFields->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequiredFieldss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequiredFields[] List of ChildOnBoardRequiredFields objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequiredFields}> List of ChildOnBoardRequiredFields objects
     */
    public function getOnBoardRequiredFieldssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequiredFieldsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequiredFieldss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OnBoardRequiredFieldss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequiredFields[] List of ChildOnBoardRequiredFields objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequiredFields}> List of ChildOnBoardRequiredFields objects
     */
    public function getOnBoardRequiredFieldssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequiredFieldsQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOnBoardRequiredFieldss($query, $con);
    }

    /**
     * Clears out the collOutletOutcomess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletOutcomess()
     */
    public function clearOutletOutcomess()
    {
        $this->collOutletOutcomess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletOutcomess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletOutcomess($v = true): void
    {
        $this->collOutletOutcomessPartial = $v;
    }

    /**
     * Initializes the collOutletOutcomess collection.
     *
     * By default this just sets the collOutletOutcomess collection to an empty array (like clearcollOutletOutcomess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletOutcomess(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletOutcomess && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletOutcomesTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletOutcomess = new $collectionClassName;
        $this->collOutletOutcomess->setModel('\entities\OutletOutcomes');
    }

    /**
     * Gets an array of ChildOutletOutcomes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletOutcomes[] List of ChildOutletOutcomes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOutcomes> List of ChildOutletOutcomes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletOutcomess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletOutcomessPartial && !$this->isNew();
        if (null === $this->collOutletOutcomess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletOutcomess) {
                    $this->initOutletOutcomess();
                } else {
                    $collectionClassName = OutletOutcomesTableMap::getTableMap()->getCollectionClassName();

                    $collOutletOutcomess = new $collectionClassName;
                    $collOutletOutcomess->setModel('\entities\OutletOutcomes');

                    return $collOutletOutcomess;
                }
            } else {
                $collOutletOutcomess = ChildOutletOutcomesQuery::create(null, $criteria)
                    ->filterByOutletType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletOutcomessPartial && count($collOutletOutcomess)) {
                        $this->initOutletOutcomess(false);

                        foreach ($collOutletOutcomess as $obj) {
                            if (false == $this->collOutletOutcomess->contains($obj)) {
                                $this->collOutletOutcomess->append($obj);
                            }
                        }

                        $this->collOutletOutcomessPartial = true;
                    }

                    return $collOutletOutcomess;
                }

                if ($partial && $this->collOutletOutcomess) {
                    foreach ($this->collOutletOutcomess as $obj) {
                        if ($obj->isNew()) {
                            $collOutletOutcomess[] = $obj;
                        }
                    }
                }

                $this->collOutletOutcomess = $collOutletOutcomess;
                $this->collOutletOutcomessPartial = false;
            }
        }

        return $this->collOutletOutcomess;
    }

    /**
     * Sets a collection of ChildOutletOutcomes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletOutcomess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOutcomess(Collection $outletOutcomess, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletOutcomes[] $outletOutcomessToDelete */
        $outletOutcomessToDelete = $this->getOutletOutcomess(new Criteria(), $con)->diff($outletOutcomess);


        $this->outletOutcomessScheduledForDeletion = $outletOutcomessToDelete;

        foreach ($outletOutcomessToDelete as $outletOutcomesRemoved) {
            $outletOutcomesRemoved->setOutletType(null);
        }

        $this->collOutletOutcomess = null;
        foreach ($outletOutcomess as $outletOutcomes) {
            $this->addOutletOutcomes($outletOutcomes);
        }

        $this->collOutletOutcomess = $outletOutcomess;
        $this->collOutletOutcomessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletOutcomes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletOutcomes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletOutcomess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletOutcomessPartial && !$this->isNew();
        if (null === $this->collOutletOutcomess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletOutcomess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletOutcomess());
            }

            $query = ChildOutletOutcomesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletType($this)
                ->count($con);
        }

        return count($this->collOutletOutcomess);
    }

    /**
     * Method called to associate a ChildOutletOutcomes object to this object
     * through the ChildOutletOutcomes foreign key attribute.
     *
     * @param ChildOutletOutcomes $l ChildOutletOutcomes
     * @return $this The current object (for fluent API support)
     */
    public function addOutletOutcomes(ChildOutletOutcomes $l)
    {
        if ($this->collOutletOutcomess === null) {
            $this->initOutletOutcomess();
            $this->collOutletOutcomessPartial = true;
        }

        if (!$this->collOutletOutcomess->contains($l)) {
            $this->doAddOutletOutcomes($l);

            if ($this->outletOutcomessScheduledForDeletion and $this->outletOutcomessScheduledForDeletion->contains($l)) {
                $this->outletOutcomessScheduledForDeletion->remove($this->outletOutcomessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletOutcomes $outletOutcomes The ChildOutletOutcomes object to add.
     */
    protected function doAddOutletOutcomes(ChildOutletOutcomes $outletOutcomes): void
    {
        $this->collOutletOutcomess[]= $outletOutcomes;
        $outletOutcomes->setOutletType($this);
    }

    /**
     * @param ChildOutletOutcomes $outletOutcomes The ChildOutletOutcomes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletOutcomes(ChildOutletOutcomes $outletOutcomes)
    {
        if ($this->getOutletOutcomess()->contains($outletOutcomes)) {
            $pos = $this->collOutletOutcomess->search($outletOutcomes);
            $this->collOutletOutcomess->remove($pos);
            if (null === $this->outletOutcomessScheduledForDeletion) {
                $this->outletOutcomessScheduledForDeletion = clone $this->collOutletOutcomess;
                $this->outletOutcomessScheduledForDeletion->clear();
            }
            $this->outletOutcomessScheduledForDeletion[]= $outletOutcomes;
            $outletOutcomes->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related OutletOutcomess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOutcomes[] List of ChildOutletOutcomes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOutcomes}> List of ChildOutletOutcomes objects
     */
    public function getOutletOutcomessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOutcomesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletOutcomess($query, $con);
    }

    /**
     * Clears out the collOutletss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletss()
     */
    public function clearOutletss()
    {
        $this->collOutletss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletss($v = true): void
    {
        $this->collOutletssPartial = $v;
    }

    /**
     * Initializes the collOutletss collection.
     *
     * By default this just sets the collOutletss collection to an empty array (like clearcollOutletss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletsTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletss = new $collectionClassName;
        $this->collOutletss->setModel('\entities\Outlets');
    }

    /**
     * Gets an array of ChildOutlets objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets> List of ChildOutlets objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletssPartial && !$this->isNew();
        if (null === $this->collOutletss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletss) {
                    $this->initOutletss();
                } else {
                    $collectionClassName = OutletsTableMap::getTableMap()->getCollectionClassName();

                    $collOutletss = new $collectionClassName;
                    $collOutletss->setModel('\entities\Outlets');

                    return $collOutletss;
                }
            } else {
                $collOutletss = ChildOutletsQuery::create(null, $criteria)
                    ->filterByOutletType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletssPartial && count($collOutletss)) {
                        $this->initOutletss(false);

                        foreach ($collOutletss as $obj) {
                            if (false == $this->collOutletss->contains($obj)) {
                                $this->collOutletss->append($obj);
                            }
                        }

                        $this->collOutletssPartial = true;
                    }

                    return $collOutletss;
                }

                if ($partial && $this->collOutletss) {
                    foreach ($this->collOutletss as $obj) {
                        if ($obj->isNew()) {
                            $collOutletss[] = $obj;
                        }
                    }
                }

                $this->collOutletss = $collOutletss;
                $this->collOutletssPartial = false;
            }
        }

        return $this->collOutletss;
    }

    /**
     * Sets a collection of ChildOutlets objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletss(Collection $outletss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutlets[] $outletssToDelete */
        $outletssToDelete = $this->getOutletss(new Criteria(), $con)->diff($outletss);


        $this->outletssScheduledForDeletion = $outletssToDelete;

        foreach ($outletssToDelete as $outletsRemoved) {
            $outletsRemoved->setOutletType(null);
        }

        $this->collOutletss = null;
        foreach ($outletss as $outlets) {
            $this->addOutlets($outlets);
        }

        $this->collOutletss = $outletss;
        $this->collOutletssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Outlets objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Outlets objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletssPartial && !$this->isNew();
        if (null === $this->collOutletss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletss());
            }

            $query = ChildOutletsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletType($this)
                ->count($con);
        }

        return count($this->collOutletss);
    }

    /**
     * Method called to associate a ChildOutlets object to this object
     * through the ChildOutlets foreign key attribute.
     *
     * @param ChildOutlets $l ChildOutlets
     * @return $this The current object (for fluent API support)
     */
    public function addOutlets(ChildOutlets $l)
    {
        if ($this->collOutletss === null) {
            $this->initOutletss();
            $this->collOutletssPartial = true;
        }

        if (!$this->collOutletss->contains($l)) {
            $this->doAddOutlets($l);

            if ($this->outletssScheduledForDeletion and $this->outletssScheduledForDeletion->contains($l)) {
                $this->outletssScheduledForDeletion->remove($this->outletssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutlets $outlets The ChildOutlets object to add.
     */
    protected function doAddOutlets(ChildOutlets $outlets): void
    {
        $this->collOutletss[]= $outlets;
        $outlets->setOutletType($this);
    }

    /**
     * @param ChildOutlets $outlets The ChildOutlets object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutlets(ChildOutlets $outlets)
    {
        if ($this->getOutletss()->contains($outlets)) {
            $pos = $this->collOutletss->search($outlets);
            $this->collOutletss->remove($pos);
            if (null === $this->outletssScheduledForDeletion) {
                $this->outletssScheduledForDeletion = clone $this->collOutletss;
                $this->outletssScheduledForDeletion->clear();
            }
            $this->outletssScheduledForDeletion[]= $outlets;
            $outlets->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getOutletss($query, $con);
    }

    /**
     * Clears out the collOutlettypemoduless collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutlettypemoduless()
     */
    public function clearOutlettypemoduless()
    {
        $this->collOutlettypemoduless = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutlettypemoduless collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutlettypemoduless($v = true): void
    {
        $this->collOutlettypemodulessPartial = $v;
    }

    /**
     * Initializes the collOutlettypemoduless collection.
     *
     * By default this just sets the collOutlettypemoduless collection to an empty array (like clearcollOutlettypemoduless());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutlettypemoduless(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutlettypemoduless && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutlettypemodulesTableMap::getTableMap()->getCollectionClassName();

        $this->collOutlettypemoduless = new $collectionClassName;
        $this->collOutlettypemoduless->setModel('\entities\Outlettypemodules');
    }

    /**
     * Gets an array of ChildOutlettypemodules objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutlettypemodules[] List of ChildOutlettypemodules objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlettypemodules> List of ChildOutlettypemodules objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutlettypemoduless(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutlettypemodulessPartial && !$this->isNew();
        if (null === $this->collOutlettypemoduless || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutlettypemoduless) {
                    $this->initOutlettypemoduless();
                } else {
                    $collectionClassName = OutlettypemodulesTableMap::getTableMap()->getCollectionClassName();

                    $collOutlettypemoduless = new $collectionClassName;
                    $collOutlettypemoduless->setModel('\entities\Outlettypemodules');

                    return $collOutlettypemoduless;
                }
            } else {
                $collOutlettypemoduless = ChildOutlettypemodulesQuery::create(null, $criteria)
                    ->filterByOutletType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutlettypemodulessPartial && count($collOutlettypemoduless)) {
                        $this->initOutlettypemoduless(false);

                        foreach ($collOutlettypemoduless as $obj) {
                            if (false == $this->collOutlettypemoduless->contains($obj)) {
                                $this->collOutlettypemoduless->append($obj);
                            }
                        }

                        $this->collOutlettypemodulessPartial = true;
                    }

                    return $collOutlettypemoduless;
                }

                if ($partial && $this->collOutlettypemoduless) {
                    foreach ($this->collOutlettypemoduless as $obj) {
                        if ($obj->isNew()) {
                            $collOutlettypemoduless[] = $obj;
                        }
                    }
                }

                $this->collOutlettypemoduless = $collOutlettypemoduless;
                $this->collOutlettypemodulessPartial = false;
            }
        }

        return $this->collOutlettypemoduless;
    }

    /**
     * Sets a collection of ChildOutlettypemodules objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outlettypemoduless A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutlettypemoduless(Collection $outlettypemoduless, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutlettypemodules[] $outlettypemodulessToDelete */
        $outlettypemodulessToDelete = $this->getOutlettypemoduless(new Criteria(), $con)->diff($outlettypemoduless);


        $this->outlettypemodulessScheduledForDeletion = $outlettypemodulessToDelete;

        foreach ($outlettypemodulessToDelete as $outlettypemodulesRemoved) {
            $outlettypemodulesRemoved->setOutletType(null);
        }

        $this->collOutlettypemoduless = null;
        foreach ($outlettypemoduless as $outlettypemodules) {
            $this->addOutlettypemodules($outlettypemodules);
        }

        $this->collOutlettypemoduless = $outlettypemoduless;
        $this->collOutlettypemodulessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Outlettypemodules objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Outlettypemodules objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutlettypemoduless(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutlettypemodulessPartial && !$this->isNew();
        if (null === $this->collOutlettypemoduless || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutlettypemoduless) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutlettypemoduless());
            }

            $query = ChildOutlettypemodulesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletType($this)
                ->count($con);
        }

        return count($this->collOutlettypemoduless);
    }

    /**
     * Method called to associate a ChildOutlettypemodules object to this object
     * through the ChildOutlettypemodules foreign key attribute.
     *
     * @param ChildOutlettypemodules $l ChildOutlettypemodules
     * @return $this The current object (for fluent API support)
     */
    public function addOutlettypemodules(ChildOutlettypemodules $l)
    {
        if ($this->collOutlettypemoduless === null) {
            $this->initOutlettypemoduless();
            $this->collOutlettypemodulessPartial = true;
        }

        if (!$this->collOutlettypemoduless->contains($l)) {
            $this->doAddOutlettypemodules($l);

            if ($this->outlettypemodulessScheduledForDeletion and $this->outlettypemodulessScheduledForDeletion->contains($l)) {
                $this->outlettypemodulessScheduledForDeletion->remove($this->outlettypemodulessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutlettypemodules $outlettypemodules The ChildOutlettypemodules object to add.
     */
    protected function doAddOutlettypemodules(ChildOutlettypemodules $outlettypemodules): void
    {
        $this->collOutlettypemoduless[]= $outlettypemodules;
        $outlettypemodules->setOutletType($this);
    }

    /**
     * @param ChildOutlettypemodules $outlettypemodules The ChildOutlettypemodules object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutlettypemodules(ChildOutlettypemodules $outlettypemodules)
    {
        if ($this->getOutlettypemoduless()->contains($outlettypemodules)) {
            $pos = $this->collOutlettypemoduless->search($outlettypemodules);
            $this->collOutlettypemoduless->remove($pos);
            if (null === $this->outlettypemodulessScheduledForDeletion) {
                $this->outlettypemodulessScheduledForDeletion = clone $this->collOutlettypemoduless;
                $this->outlettypemodulessScheduledForDeletion->clear();
            }
            $this->outlettypemodulessScheduledForDeletion[]= $outlettypemodules;
            $outlettypemodules->setOutletType(null);
        }

        return $this;
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
     * If this ChildOutletType is new, it will return
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
                    ->filterByOutletType($this)
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
            $sgpiMasterRemoved->setOutletType(null);
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
                ->filterByOutletType($this)
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
        $sgpiMaster->setOutletType($this);
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
            $sgpiMaster->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster}> List of ChildSgpiMaster objects
     */
    public function getSgpiMastersJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiMasterQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getSgpiMasters($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
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
     * Clears out the collSurveys collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSurveys()
     */
    public function clearSurveys()
    {
        $this->collSurveys = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSurveys collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSurveys($v = true): void
    {
        $this->collSurveysPartial = $v;
    }

    /**
     * Initializes the collSurveys collection.
     *
     * By default this just sets the collSurveys collection to an empty array (like clearcollSurveys());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSurveys(bool $overrideExisting = true): void
    {
        if (null !== $this->collSurveys && !$overrideExisting) {
            return;
        }

        $collectionClassName = SurveyTableMap::getTableMap()->getCollectionClassName();

        $this->collSurveys = new $collectionClassName;
        $this->collSurveys->setModel('\entities\Survey');
    }

    /**
     * Gets an array of ChildSurvey objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSurvey[] List of ChildSurvey objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurvey> List of ChildSurvey objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurveys(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSurveysPartial && !$this->isNew();
        if (null === $this->collSurveys || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSurveys) {
                    $this->initSurveys();
                } else {
                    $collectionClassName = SurveyTableMap::getTableMap()->getCollectionClassName();

                    $collSurveys = new $collectionClassName;
                    $collSurveys->setModel('\entities\Survey');

                    return $collSurveys;
                }
            } else {
                $collSurveys = ChildSurveyQuery::create(null, $criteria)
                    ->filterByOutletType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSurveysPartial && count($collSurveys)) {
                        $this->initSurveys(false);

                        foreach ($collSurveys as $obj) {
                            if (false == $this->collSurveys->contains($obj)) {
                                $this->collSurveys->append($obj);
                            }
                        }

                        $this->collSurveysPartial = true;
                    }

                    return $collSurveys;
                }

                if ($partial && $this->collSurveys) {
                    foreach ($this->collSurveys as $obj) {
                        if ($obj->isNew()) {
                            $collSurveys[] = $obj;
                        }
                    }
                }

                $this->collSurveys = $collSurveys;
                $this->collSurveysPartial = false;
            }
        }

        return $this->collSurveys;
    }

    /**
     * Sets a collection of ChildSurvey objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $surveys A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSurveys(Collection $surveys, ?ConnectionInterface $con = null)
    {
        /** @var ChildSurvey[] $surveysToDelete */
        $surveysToDelete = $this->getSurveys(new Criteria(), $con)->diff($surveys);


        $this->surveysScheduledForDeletion = $surveysToDelete;

        foreach ($surveysToDelete as $surveyRemoved) {
            $surveyRemoved->setOutletType(null);
        }

        $this->collSurveys = null;
        foreach ($surveys as $survey) {
            $this->addSurvey($survey);
        }

        $this->collSurveys = $surveys;
        $this->collSurveysPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Survey objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Survey objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSurveys(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSurveysPartial && !$this->isNew();
        if (null === $this->collSurveys || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSurveys) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSurveys());
            }

            $query = ChildSurveyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletType($this)
                ->count($con);
        }

        return count($this->collSurveys);
    }

    /**
     * Method called to associate a ChildSurvey object to this object
     * through the ChildSurvey foreign key attribute.
     *
     * @param ChildSurvey $l ChildSurvey
     * @return $this The current object (for fluent API support)
     */
    public function addSurvey(ChildSurvey $l)
    {
        if ($this->collSurveys === null) {
            $this->initSurveys();
            $this->collSurveysPartial = true;
        }

        if (!$this->collSurveys->contains($l)) {
            $this->doAddSurvey($l);

            if ($this->surveysScheduledForDeletion and $this->surveysScheduledForDeletion->contains($l)) {
                $this->surveysScheduledForDeletion->remove($this->surveysScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSurvey $survey The ChildSurvey object to add.
     */
    protected function doAddSurvey(ChildSurvey $survey): void
    {
        $this->collSurveys[]= $survey;
        $survey->setOutletType($this);
    }

    /**
     * @param ChildSurvey $survey The ChildSurvey object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSurvey(ChildSurvey $survey)
    {
        if ($this->getSurveys()->contains($survey)) {
            $pos = $this->collSurveys->search($survey);
            $this->collSurveys->remove($pos);
            if (null === $this->surveysScheduledForDeletion) {
                $this->surveysScheduledForDeletion = clone $this->collSurveys;
                $this->surveysScheduledForDeletion->clear();
            }
            $this->surveysScheduledForDeletion[]= clone $survey;
            $survey->setOutletType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Surveys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurvey[] List of ChildSurvey objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurvey}> List of ChildSurvey objects
     */
    public function getSurveysJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveyQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSurveys($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletType is new, it will return
     * an empty collection; or if this OutletType has previously
     * been saved, it will retrieve related Surveys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurvey[] List of ChildSurvey objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurvey}> List of ChildSurvey objects
     */
    public function getSurveysJoinSurveyCategory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveyQuery::create(null, $criteria);
        $query->joinWith('SurveyCategory', $joinBehavior);

        return $this->getSurveys($query, $con);
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
        if (null !== $this->aCompany) {
            $this->aCompany->removeOutletType($this);
        }
        if (null !== $this->aMediaFiles) {
            $this->aMediaFiles->removeOutletType($this);
        }
        $this->outlettype_id = null;
        $this->company_id = null;
        $this->outlettype_name = null;
        $this->isoutletprimary = null;
        $this->isoutletendcustomer = null;
        $this->isenabled = null;
        $this->outletparent = null;
        $this->image_media_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->onboard_enabled = null;
        $this->org_unit_id = null;
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
            if ($this->collOfferss) {
                foreach ($this->collOfferss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequests) {
                foreach ($this->collOnBoardRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestAddresses) {
                foreach ($this->collOnBoardRequestAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequiredFieldss) {
                foreach ($this->collOnBoardRequiredFieldss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletOutcomess) {
                foreach ($this->collOutletOutcomess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletss) {
                foreach ($this->collOutletss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutlettypemoduless) {
                foreach ($this->collOutlettypemoduless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSgpiMasters) {
                foreach ($this->collSgpiMasters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSurveys) {
                foreach ($this->collSurveys as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagns = null;
        $this->collOfferss = null;
        $this->collOnBoardRequests = null;
        $this->collOnBoardRequestAddresses = null;
        $this->collOnBoardRequiredFieldss = null;
        $this->collOutletOutcomess = null;
        $this->collOutletss = null;
        $this->collOutlettypemoduless = null;
        $this->collSgpiMasters = null;
        $this->collSurveys = null;
        $this->aCompany = null;
        $this->aMediaFiles = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OutletTypeTableMap::DEFAULT_STRING_FORMAT);
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
