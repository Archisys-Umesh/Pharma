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
use entities\BrandCampiagnClassification as ChildBrandCampiagnClassification;
use entities\BrandCampiagnClassificationQuery as ChildBrandCampiagnClassificationQuery;
use entities\BrandCampiagnDoctors as ChildBrandCampiagnDoctors;
use entities\BrandCampiagnDoctorsQuery as ChildBrandCampiagnDoctorsQuery;
use entities\BrandCampiagnQuery as ChildBrandCampiagnQuery;
use entities\BrandCampiagnVisitPlan as ChildBrandCampiagnVisitPlan;
use entities\BrandCampiagnVisitPlanQuery as ChildBrandCampiagnVisitPlanQuery;
use entities\BrandCampiagnVisits as ChildBrandCampiagnVisits;
use entities\BrandCampiagnVisitsQuery as ChildBrandCampiagnVisitsQuery;
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Designations as ChildDesignations;
use entities\DesignationsQuery as ChildDesignationsQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\Map\BrandCampiagnClassificationTableMap;
use entities\Map\BrandCampiagnDoctorsTableMap;
use entities\Map\BrandCampiagnTableMap;
use entities\Map\BrandCampiagnVisitPlanTableMap;
use entities\Map\BrandCampiagnVisitsTableMap;

/**
 * Base class that represents a row from the 'brand_campiagn' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class BrandCampiagn implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\BrandCampiagnTableMap';


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
     * The value for the brand_campiagn_id field.
     *
     * @var        int
     */
    protected $brand_campiagn_id;

    /**
     * The value for the campiagn_name field.
     *
     * @var        string|null
     */
    protected $campiagn_name;

    /**
     * The value for the start_date field.
     *
     * @var        DateTime|null
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     *
     * @var        DateTime|null
     */
    protected $end_date;

    /**
     * The value for the locking_date field.
     *
     * @var        DateTime|null
     */
    protected $locking_date;

    /**
     * The value for the doctor_count field.
     *
     * @var        int|null
     */
    protected $doctor_count;

    /**
     * The value for the focus_brand_id field.
     *
     * @var        int|null
     */
    protected $focus_brand_id;

    /**
     * The value for the planned field.
     *
     * @var        string|null
     */
    protected $planned;

    /**
     * The value for the done field.
     *
     * @var        string|null
     */
    protected $done;

    /**
     * The value for the distributed field.
     *
     * @var        string|null
     */
    protected $distributed;

    /**
     * The value for the distributed_done field.
     *
     * @var        string|null
     */
    protected $distributed_done;

    /**
     * The value for the classification_id field.
     *
     * @var        string|null
     */
    protected $classification_id;

    /**
     * The value for the description field.
     *
     * @var        string|null
     */
    protected $description;

    /**
     * The value for the media field.
     *
     * @var        string|null
     */
    protected $media;

    /**
     * The value for the material field.
     *
     * @var        string|null
     */
    protected $material;

    /**
     * The value for the type field.
     *
     * @var        string|null
     */
    protected $type;

    /**
     * The value for the tags field.
     *
     * @var        string|null
     */
    protected $tags;

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
     * The value for the org_unit_id field.
     *
     * @var        int|null
     */
    protected $org_unit_id;

    /**
     * The value for the brand_campiagn_code field.
     *
     * @var        string|null
     */
    protected $brand_campiagn_code;

    /**
     * The value for the outlettype_id field.
     *
     * @var        int|null
     */
    protected $outlettype_id;

    /**
     * The value for the classifications field.
     *
     * @var        string|null
     */
    protected $classifications;

    /**
     * The value for the focus_brands field.
     *
     * @var        string|null
     */
    protected $focus_brands;

    /**
     * The value for the minimum_per_territory field.
     *
     * @var        int|null
     */
    protected $minimum_per_territory;

    /**
     * The value for the maximum_per_territory field.
     *
     * @var        int|null
     */
    protected $maximum_per_territory;

    /**
     * The value for the minimum_for_campiagn field.
     *
     * Note: this column has a database default value of: 1
     * @var        int|null
     */
    protected $minimum_for_campiagn;

    /**
     * The value for the maximum_for_campiagn field.
     *
     * @var        int|null
     */
    protected $maximum_for_campiagn;

    /**
     * The value for the is_suspended field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_suspended;

    /**
     * The value for the status field.
     *
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the campiagn_type field.
     *
     * @var        string|null
     */
    protected $campiagn_type;

    /**
     * The value for the designation field.
     *
     * @var        int|null
     */
    protected $designation;

    /**
     * The value for the position field.
     *
     * @var        string|null
     */
    protected $position;

    /**
     * The value for the sgpi_brands field.
     *
     * @var        string|null
     */
    protected $sgpi_brands;

    /**
     * The value for the comment field.
     *
     * @var        string|null
     */
    protected $comment;

    /**
     * @var        ChildDesignations
     */
    protected $aDesignations;

    /**
     * @var        ChildBrands
     */
    protected $aBrands;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildOutletType
     */
    protected $aOutletType;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnClassification[] Collection to store aggregation of ChildBrandCampiagnClassification objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnClassification> Collection to store aggregation of ChildBrandCampiagnClassification objects.
     */
    protected $collBrandCampiagnClassifications;
    protected $collBrandCampiagnClassificationsPartial;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnDoctors[] Collection to store aggregation of ChildBrandCampiagnDoctors objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnDoctors> Collection to store aggregation of ChildBrandCampiagnDoctors objects.
     */
    protected $collBrandCampiagnDoctorss;
    protected $collBrandCampiagnDoctorssPartial;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnVisitPlan[] Collection to store aggregation of ChildBrandCampiagnVisitPlan objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan> Collection to store aggregation of ChildBrandCampiagnVisitPlan objects.
     */
    protected $collBrandCampiagnVisitPlans;
    protected $collBrandCampiagnVisitPlansPartial;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnVisits[] Collection to store aggregation of ChildBrandCampiagnVisits objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisits> Collection to store aggregation of ChildBrandCampiagnVisits objects.
     */
    protected $collBrandCampiagnVisitss;
    protected $collBrandCampiagnVisitssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnClassification[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnClassification>
     */
    protected $brandCampiagnClassificationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnDoctors[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnDoctors>
     */
    protected $brandCampiagnDoctorssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnVisitPlan[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan>
     */
    protected $brandCampiagnVisitPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnVisits[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisits>
     */
    protected $brandCampiagnVisitssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->minimum_for_campiagn = 1;
        $this->is_suspended = false;
    }

    /**
     * Initializes internal state of entities\Base\BrandCampiagn object.
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
     * Compares this with another <code>BrandCampiagn</code> instance.  If
     * <code>obj</code> is an instance of <code>BrandCampiagn</code>, delegates to
     * <code>equals(BrandCampiagn)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [brand_campiagn_id] column value.
     *
     * @return int
     */
    public function getBrandCampiagnId()
    {
        return $this->brand_campiagn_id;
    }

    /**
     * Get the [campiagn_name] column value.
     *
     * @return string|null
     */
    public function getCampiagnName()
    {
        return $this->campiagn_name;
    }

    /**
     * Get the [optionally formatted] temporal [start_date] column value.
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
    public function getStartDate($format = null)
    {
        if ($format === null) {
            return $this->start_date;
        } else {
            return $this->start_date instanceof \DateTimeInterface ? $this->start_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [end_date] column value.
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
    public function getEndDate($format = null)
    {
        if ($format === null) {
            return $this->end_date;
        } else {
            return $this->end_date instanceof \DateTimeInterface ? $this->end_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [locking_date] column value.
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
    public function getLockingDate($format = null)
    {
        if ($format === null) {
            return $this->locking_date;
        } else {
            return $this->locking_date instanceof \DateTimeInterface ? $this->locking_date->format($format) : null;
        }
    }

    /**
     * Get the [doctor_count] column value.
     *
     * @return int|null
     */
    public function getDoctorCount()
    {
        return $this->doctor_count;
    }

    /**
     * Get the [focus_brand_id] column value.
     *
     * @return int|null
     */
    public function getFocusBrandId()
    {
        return $this->focus_brand_id;
    }

    /**
     * Get the [planned] column value.
     *
     * @return string|null
     */
    public function getPlanned()
    {
        return $this->planned;
    }

    /**
     * Get the [done] column value.
     *
     * @return string|null
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Get the [distributed] column value.
     *
     * @return string|null
     */
    public function getDistributed()
    {
        return $this->distributed;
    }

    /**
     * Get the [distributed_done] column value.
     *
     * @return string|null
     */
    public function getDistributedDone()
    {
        return $this->distributed_done;
    }

    /**
     * Get the [classification_id] column value.
     *
     * @return string|null
     */
    public function getClassificationId()
    {
        return $this->classification_id;
    }

    /**
     * Get the [description] column value.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [media] column value.
     *
     * @return string|null
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Get the [material] column value.
     *
     * @return string|null
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Get the [type] column value.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [tags] column value.
     *
     * @return string|null
     */
    public function getTags()
    {
        return $this->tags;
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
     * Get the [org_unit_id] column value.
     *
     * @return int|null
     */
    public function getOrgUnitId()
    {
        return $this->org_unit_id;
    }

    /**
     * Get the [brand_campiagn_code] column value.
     *
     * @return string|null
     */
    public function getBrandCampiagnCode()
    {
        return $this->brand_campiagn_code;
    }

    /**
     * Get the [outlettype_id] column value.
     *
     * @return int|null
     */
    public function getOutlettypeId()
    {
        return $this->outlettype_id;
    }

    /**
     * Get the [classifications] column value.
     *
     * @return string|null
     */
    public function getClassifications()
    {
        return $this->classifications;
    }

    /**
     * Get the [focus_brands] column value.
     *
     * @return string|null
     */
    public function getFocusBrands()
    {
        return $this->focus_brands;
    }

    /**
     * Get the [minimum_per_territory] column value.
     *
     * @return int|null
     */
    public function getMinimumPerTerritory()
    {
        return $this->minimum_per_territory;
    }

    /**
     * Get the [maximum_per_territory] column value.
     *
     * @return int|null
     */
    public function getMaximumPerTerritory()
    {
        return $this->maximum_per_territory;
    }

    /**
     * Get the [minimum_for_campiagn] column value.
     *
     * @return int|null
     */
    public function getMinimumForCampiagn()
    {
        return $this->minimum_for_campiagn;
    }

    /**
     * Get the [maximum_for_campiagn] column value.
     *
     * @return int|null
     */
    public function getMaximumForCampiagn()
    {
        return $this->maximum_for_campiagn;
    }

    /**
     * Get the [is_suspended] column value.
     *
     * @return boolean|null
     */
    public function getIsSuspended()
    {
        return $this->is_suspended;
    }

    /**
     * Get the [is_suspended] column value.
     *
     * @return boolean|null
     */
    public function isSuspended()
    {
        return $this->getIsSuspended();
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
     * Get the [campiagn_type] column value.
     *
     * @return string|null
     */
    public function getCampiagnType()
    {
        return $this->campiagn_type;
    }

    /**
     * Get the [designation] column value.
     *
     * @return int|null
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Get the [position] column value.
     *
     * @return string|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get the [sgpi_brands] column value.
     *
     * @return string|null
     */
    public function getSgpiBrands()
    {
        return $this->sgpi_brands;
    }

    /**
     * Get the [comment] column value.
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of [brand_campiagn_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_campiagn_id !== $v) {
            $this->brand_campiagn_id = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [campiagn_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCampiagnName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->campiagn_name !== $v) {
            $this->campiagn_name = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_CAMPIAGN_NAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [start_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_date !== null || $dt !== null) {
            if ($this->start_date === null || $dt === null || $dt->format("Y-m-d") !== $this->start_date->format("Y-m-d")) {
                $this->start_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BrandCampiagnTableMap::COL_START_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [end_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_date !== null || $dt !== null) {
            if ($this->end_date === null || $dt === null || $dt->format("Y-m-d") !== $this->end_date->format("Y-m-d")) {
                $this->end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BrandCampiagnTableMap::COL_END_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [locking_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setLockingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->locking_date !== null || $dt !== null) {
            if ($this->locking_date === null || $dt === null || $dt->format("Y-m-d") !== $this->locking_date->format("Y-m-d")) {
                $this->locking_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BrandCampiagnTableMap::COL_LOCKING_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [doctor_count] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDoctorCount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->doctor_count !== $v) {
            $this->doctor_count = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_DOCTOR_COUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [focus_brand_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFocusBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->focus_brand_id !== $v) {
            $this->focus_brand_id = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_FOCUS_BRAND_ID] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getBrandId() !== $v) {
            $this->aBrands = null;
        }

        return $this;
    }

    /**
     * Set the value of [planned] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPlanned($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->planned !== $v) {
            $this->planned = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_PLANNED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [done] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->done !== $v) {
            $this->done = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [distributed] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDistributed($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->distributed !== $v) {
            $this->distributed = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_DISTRIBUTED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [distributed_done] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDistributedDone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->distributed_done !== $v) {
            $this->distributed_done = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_DISTRIBUTED_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [classification_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setClassificationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->classification_id !== $v) {
            $this->classification_id = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_CLASSIFICATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [media] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMedia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->media !== $v) {
            $this->media = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_MEDIA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [material] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMaterial($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->material !== $v) {
            $this->material = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_MATERIAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tags] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tags !== $v) {
            $this->tags = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_TAGS] = true;
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
            $this->modifiedColumns[BrandCampiagnTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[BrandCampiagnTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[BrandCampiagnTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_ORG_UNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [brand_campiagn_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_campiagn_code !== $v) {
            $this->brand_campiagn_code = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutlettypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlettype_id !== $v) {
            $this->outlettype_id = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_OUTLETTYPE_ID] = true;
        }

        if ($this->aOutletType !== null && $this->aOutletType->getOutlettypeId() !== $v) {
            $this->aOutletType = null;
        }

        return $this;
    }

    /**
     * Set the value of [classifications] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setClassifications($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->classifications !== $v) {
            $this->classifications = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_CLASSIFICATIONS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [focus_brands] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFocusBrands($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->focus_brands !== $v) {
            $this->focus_brands = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_FOCUS_BRANDS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [minimum_per_territory] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMinimumPerTerritory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->minimum_per_territory !== $v) {
            $this->minimum_per_territory = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [maximum_per_territory] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMaximumPerTerritory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->maximum_per_territory !== $v) {
            $this->maximum_per_territory = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [minimum_for_campiagn] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMinimumForCampiagn($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->minimum_for_campiagn !== $v) {
            $this->minimum_for_campiagn = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [maximum_for_campiagn] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMaximumForCampiagn($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->maximum_for_campiagn !== $v) {
            $this->maximum_for_campiagn = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_suspended] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsSuspended($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_suspended !== $v) {
            $this->is_suspended = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_IS_SUSPENDED] = true;
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
            $this->modifiedColumns[BrandCampiagnTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [campiagn_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCampiagnType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->campiagn_type !== $v) {
            $this->campiagn_type = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_CAMPIAGN_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [designation] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDesignation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->designation !== $v) {
            $this->designation = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_DESIGNATION] = true;
        }

        if ($this->aDesignations !== null && $this->aDesignations->getDesignationId() !== $v) {
            $this->aDesignations = null;
        }

        return $this;
    }

    /**
     * Set the value of [position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position !== $v) {
            $this->position = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_brands] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiBrands($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_brands !== $v) {
            $this->sgpi_brands = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_SGPI_BRANDS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [comment] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment !== $v) {
            $this->comment = $v;
            $this->modifiedColumns[BrandCampiagnTableMap::COL_COMMENT] = true;
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
            if ($this->minimum_for_campiagn !== 1) {
                return false;
            }

            if ($this->is_suspended !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BrandCampiagnTableMap::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_campiagn_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BrandCampiagnTableMap::translateFieldName('CampiagnName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campiagn_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BrandCampiagnTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BrandCampiagnTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BrandCampiagnTableMap::translateFieldName('LockingDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locking_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BrandCampiagnTableMap::translateFieldName('DoctorCount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->doctor_count = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BrandCampiagnTableMap::translateFieldName('FocusBrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->focus_brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BrandCampiagnTableMap::translateFieldName('Planned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->planned = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BrandCampiagnTableMap::translateFieldName('Done', TableMap::TYPE_PHPNAME, $indexType)];
            $this->done = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BrandCampiagnTableMap::translateFieldName('Distributed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->distributed = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : BrandCampiagnTableMap::translateFieldName('DistributedDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->distributed_done = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : BrandCampiagnTableMap::translateFieldName('ClassificationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->classification_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : BrandCampiagnTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : BrandCampiagnTableMap::translateFieldName('Media', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : BrandCampiagnTableMap::translateFieldName('Material', TableMap::TYPE_PHPNAME, $indexType)];
            $this->material = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : BrandCampiagnTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : BrandCampiagnTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : BrandCampiagnTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : BrandCampiagnTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : BrandCampiagnTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : BrandCampiagnTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : BrandCampiagnTableMap::translateFieldName('BrandCampiagnCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_campiagn_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : BrandCampiagnTableMap::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : BrandCampiagnTableMap::translateFieldName('Classifications', TableMap::TYPE_PHPNAME, $indexType)];
            $this->classifications = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : BrandCampiagnTableMap::translateFieldName('FocusBrands', TableMap::TYPE_PHPNAME, $indexType)];
            $this->focus_brands = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : BrandCampiagnTableMap::translateFieldName('MinimumPerTerritory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->minimum_per_territory = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : BrandCampiagnTableMap::translateFieldName('MaximumPerTerritory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->maximum_per_territory = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : BrandCampiagnTableMap::translateFieldName('MinimumForCampiagn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->minimum_for_campiagn = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : BrandCampiagnTableMap::translateFieldName('MaximumForCampiagn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->maximum_for_campiagn = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : BrandCampiagnTableMap::translateFieldName('IsSuspended', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_suspended = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : BrandCampiagnTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : BrandCampiagnTableMap::translateFieldName('CampiagnType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campiagn_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : BrandCampiagnTableMap::translateFieldName('Designation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : BrandCampiagnTableMap::translateFieldName('Position', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : BrandCampiagnTableMap::translateFieldName('SgpiBrands', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_brands = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : BrandCampiagnTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 36; // 36 = BrandCampiagnTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\BrandCampiagn'), 0, $e);
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
        if ($this->aBrands !== null && $this->focus_brand_id !== $this->aBrands->getBrandId()) {
            $this->aBrands = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aOrgUnit !== null && $this->org_unit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aOutletType !== null && $this->outlettype_id !== $this->aOutletType->getOutlettypeId()) {
            $this->aOutletType = null;
        }
        if ($this->aDesignations !== null && $this->designation !== $this->aDesignations->getDesignationId()) {
            $this->aDesignations = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(BrandCampiagnTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBrandCampiagnQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDesignations = null;
            $this->aBrands = null;
            $this->aCompany = null;
            $this->aOrgUnit = null;
            $this->aOutletType = null;
            $this->collBrandCampiagnClassifications = null;

            $this->collBrandCampiagnDoctorss = null;

            $this->collBrandCampiagnVisitPlans = null;

            $this->collBrandCampiagnVisitss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see BrandCampiagn::setDeleted()
     * @see BrandCampiagn::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBrandCampiagnQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnTableMap::DATABASE_NAME);
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
                BrandCampiagnTableMap::addInstanceToPool($this);
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

            if ($this->aDesignations !== null) {
                if ($this->aDesignations->isModified() || $this->aDesignations->isNew()) {
                    $affectedRows += $this->aDesignations->save($con);
                }
                $this->setDesignations($this->aDesignations);
            }

            if ($this->aBrands !== null) {
                if ($this->aBrands->isModified() || $this->aBrands->isNew()) {
                    $affectedRows += $this->aBrands->save($con);
                }
                $this->setBrands($this->aBrands);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aOutletType !== null) {
                if ($this->aOutletType->isModified() || $this->aOutletType->isNew()) {
                    $affectedRows += $this->aOutletType->save($con);
                }
                $this->setOutletType($this->aOutletType);
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

            if ($this->brandCampiagnClassificationsScheduledForDeletion !== null) {
                if (!$this->brandCampiagnClassificationsScheduledForDeletion->isEmpty()) {
                    \entities\BrandCampiagnClassificationQuery::create()
                        ->filterByPrimaryKeys($this->brandCampiagnClassificationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->brandCampiagnClassificationsScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagnClassifications !== null) {
                foreach ($this->collBrandCampiagnClassifications as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->brandCampiagnDoctorssScheduledForDeletion !== null) {
                if (!$this->brandCampiagnDoctorssScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnDoctorssScheduledForDeletion as $brandCampiagnDoctors) {
                        // need to save related object because we set the relation to null
                        $brandCampiagnDoctors->save($con);
                    }
                    $this->brandCampiagnDoctorssScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagnDoctorss !== null) {
                foreach ($this->collBrandCampiagnDoctorss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->brandCampiagnVisitPlansScheduledForDeletion !== null) {
                if (!$this->brandCampiagnVisitPlansScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnVisitPlansScheduledForDeletion as $brandCampiagnVisitPlan) {
                        // need to save related object because we set the relation to null
                        $brandCampiagnVisitPlan->save($con);
                    }
                    $this->brandCampiagnVisitPlansScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagnVisitPlans !== null) {
                foreach ($this->collBrandCampiagnVisitPlans as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->brandCampiagnVisitssScheduledForDeletion !== null) {
                if (!$this->brandCampiagnVisitssScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnVisitssScheduledForDeletion as $brandCampiagnVisits) {
                        // need to save related object because we set the relation to null
                        $brandCampiagnVisits->save($con);
                    }
                    $this->brandCampiagnVisitssScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagnVisitss !== null) {
                foreach ($this->collBrandCampiagnVisitss as $referrerFK) {
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

        $this->modifiedColumns[BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID] = true;
        if (null !== $this->brand_campiagn_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID . ')');
        }
        if (null === $this->brand_campiagn_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('brand_campiagn_brand_campiagn_id_seq')");
                $this->brand_campiagn_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_campiagn_id';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CAMPIAGN_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'campiagn_name';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_LOCKING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'locking_date';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DOCTOR_COUNT)) {
            $modifiedColumns[':p' . $index++]  = 'doctor_count';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'focus_brand_id';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_PLANNED)) {
            $modifiedColumns[':p' . $index++]  = 'planned';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DONE)) {
            $modifiedColumns[':p' . $index++]  = 'done';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DISTRIBUTED)) {
            $modifiedColumns[':p' . $index++]  = 'distributed';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DISTRIBUTED_DONE)) {
            $modifiedColumns[':p' . $index++]  = 'distributed_done';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CLASSIFICATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'classification_id';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MEDIA)) {
            $modifiedColumns[':p' . $index++]  = 'media';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MATERIAL)) {
            $modifiedColumns[':p' . $index++]  = 'material';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_TAGS)) {
            $modifiedColumns[':p' . $index++]  = 'tags';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_id';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'brand_campiagn_code';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_OUTLETTYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlettype_id';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CLASSIFICATIONS)) {
            $modifiedColumns[':p' . $index++]  = 'classifications';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_FOCUS_BRANDS)) {
            $modifiedColumns[':p' . $index++]  = 'focus_brands';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY)) {
            $modifiedColumns[':p' . $index++]  = 'minimum_per_territory';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY)) {
            $modifiedColumns[':p' . $index++]  = 'maximum_per_territory';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN)) {
            $modifiedColumns[':p' . $index++]  = 'minimum_for_campiagn';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN)) {
            $modifiedColumns[':p' . $index++]  = 'maximum_for_campiagn';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_IS_SUSPENDED)) {
            $modifiedColumns[':p' . $index++]  = 'is_suspended';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CAMPIAGN_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'campiagn_type';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DESIGNATION)) {
            $modifiedColumns[':p' . $index++]  = 'designation';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'position';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_SGPI_BRANDS)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_brands';
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'comment';
        }

        $sql = sprintf(
            'INSERT INTO brand_campiagn (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'brand_campiagn_id':
                        $stmt->bindValue($identifier, $this->brand_campiagn_id, PDO::PARAM_INT);

                        break;
                    case 'campiagn_name':
                        $stmt->bindValue($identifier, $this->campiagn_name, PDO::PARAM_STR);

                        break;
                    case 'start_date':
                        $stmt->bindValue($identifier, $this->start_date ? $this->start_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'end_date':
                        $stmt->bindValue($identifier, $this->end_date ? $this->end_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'locking_date':
                        $stmt->bindValue($identifier, $this->locking_date ? $this->locking_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'doctor_count':
                        $stmt->bindValue($identifier, $this->doctor_count, PDO::PARAM_INT);

                        break;
                    case 'focus_brand_id':
                        $stmt->bindValue($identifier, $this->focus_brand_id, PDO::PARAM_INT);

                        break;
                    case 'planned':
                        $stmt->bindValue($identifier, $this->planned, PDO::PARAM_STR);

                        break;
                    case 'done':
                        $stmt->bindValue($identifier, $this->done, PDO::PARAM_STR);

                        break;
                    case 'distributed':
                        $stmt->bindValue($identifier, $this->distributed, PDO::PARAM_STR);

                        break;
                    case 'distributed_done':
                        $stmt->bindValue($identifier, $this->distributed_done, PDO::PARAM_STR);

                        break;
                    case 'classification_id':
                        $stmt->bindValue($identifier, $this->classification_id, PDO::PARAM_STR);

                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case 'media':
                        $stmt->bindValue($identifier, $this->media, PDO::PARAM_STR);

                        break;
                    case 'material':
                        $stmt->bindValue($identifier, $this->material, PDO::PARAM_STR);

                        break;
                    case 'type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);

                        break;
                    case 'tags':
                        $stmt->bindValue($identifier, $this->tags, PDO::PARAM_STR);

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
                    case 'org_unit_id':
                        $stmt->bindValue($identifier, $this->org_unit_id, PDO::PARAM_INT);

                        break;
                    case 'brand_campiagn_code':
                        $stmt->bindValue($identifier, $this->brand_campiagn_code, PDO::PARAM_STR);

                        break;
                    case 'outlettype_id':
                        $stmt->bindValue($identifier, $this->outlettype_id, PDO::PARAM_INT);

                        break;
                    case 'classifications':
                        $stmt->bindValue($identifier, $this->classifications, PDO::PARAM_STR);

                        break;
                    case 'focus_brands':
                        $stmt->bindValue($identifier, $this->focus_brands, PDO::PARAM_STR);

                        break;
                    case 'minimum_per_territory':
                        $stmt->bindValue($identifier, $this->minimum_per_territory, PDO::PARAM_INT);

                        break;
                    case 'maximum_per_territory':
                        $stmt->bindValue($identifier, $this->maximum_per_territory, PDO::PARAM_INT);

                        break;
                    case 'minimum_for_campiagn':
                        $stmt->bindValue($identifier, $this->minimum_for_campiagn, PDO::PARAM_INT);

                        break;
                    case 'maximum_for_campiagn':
                        $stmt->bindValue($identifier, $this->maximum_for_campiagn, PDO::PARAM_INT);

                        break;
                    case 'is_suspended':
                        $stmt->bindValue($identifier, $this->is_suspended, PDO::PARAM_BOOL);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'campiagn_type':
                        $stmt->bindValue($identifier, $this->campiagn_type, PDO::PARAM_STR);

                        break;
                    case 'designation':
                        $stmt->bindValue($identifier, $this->designation, PDO::PARAM_INT);

                        break;
                    case 'position':
                        $stmt->bindValue($identifier, $this->position, PDO::PARAM_STR);

                        break;
                    case 'sgpi_brands':
                        $stmt->bindValue($identifier, $this->sgpi_brands, PDO::PARAM_STR);

                        break;
                    case 'comment':
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);

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
        $pos = BrandCampiagnTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBrandCampiagnId();

            case 1:
                return $this->getCampiagnName();

            case 2:
                return $this->getStartDate();

            case 3:
                return $this->getEndDate();

            case 4:
                return $this->getLockingDate();

            case 5:
                return $this->getDoctorCount();

            case 6:
                return $this->getFocusBrandId();

            case 7:
                return $this->getPlanned();

            case 8:
                return $this->getDone();

            case 9:
                return $this->getDistributed();

            case 10:
                return $this->getDistributedDone();

            case 11:
                return $this->getClassificationId();

            case 12:
                return $this->getDescription();

            case 13:
                return $this->getMedia();

            case 14:
                return $this->getMaterial();

            case 15:
                return $this->getType();

            case 16:
                return $this->getTags();

            case 17:
                return $this->getCompanyId();

            case 18:
                return $this->getCreatedAt();

            case 19:
                return $this->getUpdatedAt();

            case 20:
                return $this->getOrgUnitId();

            case 21:
                return $this->getBrandCampiagnCode();

            case 22:
                return $this->getOutlettypeId();

            case 23:
                return $this->getClassifications();

            case 24:
                return $this->getFocusBrands();

            case 25:
                return $this->getMinimumPerTerritory();

            case 26:
                return $this->getMaximumPerTerritory();

            case 27:
                return $this->getMinimumForCampiagn();

            case 28:
                return $this->getMaximumForCampiagn();

            case 29:
                return $this->getIsSuspended();

            case 30:
                return $this->getStatus();

            case 31:
                return $this->getCampiagnType();

            case 32:
                return $this->getDesignation();

            case 33:
                return $this->getPosition();

            case 34:
                return $this->getSgpiBrands();

            case 35:
                return $this->getComment();

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
        if (isset($alreadyDumpedObjects['BrandCampiagn'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['BrandCampiagn'][$this->hashCode()] = true;
        $keys = BrandCampiagnTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBrandCampiagnId(),
            $keys[1] => $this->getCampiagnName(),
            $keys[2] => $this->getStartDate(),
            $keys[3] => $this->getEndDate(),
            $keys[4] => $this->getLockingDate(),
            $keys[5] => $this->getDoctorCount(),
            $keys[6] => $this->getFocusBrandId(),
            $keys[7] => $this->getPlanned(),
            $keys[8] => $this->getDone(),
            $keys[9] => $this->getDistributed(),
            $keys[10] => $this->getDistributedDone(),
            $keys[11] => $this->getClassificationId(),
            $keys[12] => $this->getDescription(),
            $keys[13] => $this->getMedia(),
            $keys[14] => $this->getMaterial(),
            $keys[15] => $this->getType(),
            $keys[16] => $this->getTags(),
            $keys[17] => $this->getCompanyId(),
            $keys[18] => $this->getCreatedAt(),
            $keys[19] => $this->getUpdatedAt(),
            $keys[20] => $this->getOrgUnitId(),
            $keys[21] => $this->getBrandCampiagnCode(),
            $keys[22] => $this->getOutlettypeId(),
            $keys[23] => $this->getClassifications(),
            $keys[24] => $this->getFocusBrands(),
            $keys[25] => $this->getMinimumPerTerritory(),
            $keys[26] => $this->getMaximumPerTerritory(),
            $keys[27] => $this->getMinimumForCampiagn(),
            $keys[28] => $this->getMaximumForCampiagn(),
            $keys[29] => $this->getIsSuspended(),
            $keys[30] => $this->getStatus(),
            $keys[31] => $this->getCampiagnType(),
            $keys[32] => $this->getDesignation(),
            $keys[33] => $this->getPosition(),
            $keys[34] => $this->getSgpiBrands(),
            $keys[35] => $this->getComment(),
        ];
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d');
        }

        if ($result[$keys[18]] instanceof \DateTimeInterface) {
            $result[$keys[18]] = $result[$keys[18]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[19]] instanceof \DateTimeInterface) {
            $result[$keys[19]] = $result[$keys[19]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDesignations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'designations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'designations';
                        break;
                    default:
                        $key = 'Designations';
                }

                $result[$key] = $this->aDesignations->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aOutletType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_type';
                        break;
                    default:
                        $key = 'OutletType';
                }

                $result[$key] = $this->aOutletType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBrandCampiagnClassifications) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagnClassifications';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn_classifications';
                        break;
                    default:
                        $key = 'BrandCampiagnClassifications';
                }

                $result[$key] = $this->collBrandCampiagnClassifications->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBrandCampiagnDoctorss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagnDoctorss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn_doctorss';
                        break;
                    default:
                        $key = 'BrandCampiagnDoctorss';
                }

                $result[$key] = $this->collBrandCampiagnDoctorss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBrandCampiagnVisitPlans) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagnVisitPlans';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn_visit_plans';
                        break;
                    default:
                        $key = 'BrandCampiagnVisitPlans';
                }

                $result[$key] = $this->collBrandCampiagnVisitPlans->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBrandCampiagnVisitss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagnVisitss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn_visitss';
                        break;
                    default:
                        $key = 'BrandCampiagnVisitss';
                }

                $result[$key] = $this->collBrandCampiagnVisitss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BrandCampiagnTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setBrandCampiagnId($value);
                break;
            case 1:
                $this->setCampiagnName($value);
                break;
            case 2:
                $this->setStartDate($value);
                break;
            case 3:
                $this->setEndDate($value);
                break;
            case 4:
                $this->setLockingDate($value);
                break;
            case 5:
                $this->setDoctorCount($value);
                break;
            case 6:
                $this->setFocusBrandId($value);
                break;
            case 7:
                $this->setPlanned($value);
                break;
            case 8:
                $this->setDone($value);
                break;
            case 9:
                $this->setDistributed($value);
                break;
            case 10:
                $this->setDistributedDone($value);
                break;
            case 11:
                $this->setClassificationId($value);
                break;
            case 12:
                $this->setDescription($value);
                break;
            case 13:
                $this->setMedia($value);
                break;
            case 14:
                $this->setMaterial($value);
                break;
            case 15:
                $this->setType($value);
                break;
            case 16:
                $this->setTags($value);
                break;
            case 17:
                $this->setCompanyId($value);
                break;
            case 18:
                $this->setCreatedAt($value);
                break;
            case 19:
                $this->setUpdatedAt($value);
                break;
            case 20:
                $this->setOrgUnitId($value);
                break;
            case 21:
                $this->setBrandCampiagnCode($value);
                break;
            case 22:
                $this->setOutlettypeId($value);
                break;
            case 23:
                $this->setClassifications($value);
                break;
            case 24:
                $this->setFocusBrands($value);
                break;
            case 25:
                $this->setMinimumPerTerritory($value);
                break;
            case 26:
                $this->setMaximumPerTerritory($value);
                break;
            case 27:
                $this->setMinimumForCampiagn($value);
                break;
            case 28:
                $this->setMaximumForCampiagn($value);
                break;
            case 29:
                $this->setIsSuspended($value);
                break;
            case 30:
                $this->setStatus($value);
                break;
            case 31:
                $this->setCampiagnType($value);
                break;
            case 32:
                $this->setDesignation($value);
                break;
            case 33:
                $this->setPosition($value);
                break;
            case 34:
                $this->setSgpiBrands($value);
                break;
            case 35:
                $this->setComment($value);
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
        $keys = BrandCampiagnTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBrandCampiagnId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCampiagnName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStartDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEndDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLockingDate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDoctorCount($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFocusBrandId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPlanned($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDone($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDistributed($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDistributedDone($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setClassificationId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setDescription($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setMedia($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setMaterial($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setType($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setTags($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCompanyId($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCreatedAt($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setUpdatedAt($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setOrgUnitId($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setBrandCampiagnCode($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setOutlettypeId($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setClassifications($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setFocusBrands($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setMinimumPerTerritory($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setMaximumPerTerritory($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setMinimumForCampiagn($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setMaximumForCampiagn($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setIsSuspended($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setStatus($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setCampiagnType($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setDesignation($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setPosition($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setSgpiBrands($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setComment($arr[$keys[35]]);
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
        $criteria = new Criteria(BrandCampiagnTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID)) {
            $criteria->add(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $this->brand_campiagn_id);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CAMPIAGN_NAME)) {
            $criteria->add(BrandCampiagnTableMap::COL_CAMPIAGN_NAME, $this->campiagn_name);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_START_DATE)) {
            $criteria->add(BrandCampiagnTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_END_DATE)) {
            $criteria->add(BrandCampiagnTableMap::COL_END_DATE, $this->end_date);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_LOCKING_DATE)) {
            $criteria->add(BrandCampiagnTableMap::COL_LOCKING_DATE, $this->locking_date);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DOCTOR_COUNT)) {
            $criteria->add(BrandCampiagnTableMap::COL_DOCTOR_COUNT, $this->doctor_count);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID)) {
            $criteria->add(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID, $this->focus_brand_id);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_PLANNED)) {
            $criteria->add(BrandCampiagnTableMap::COL_PLANNED, $this->planned);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DONE)) {
            $criteria->add(BrandCampiagnTableMap::COL_DONE, $this->done);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DISTRIBUTED)) {
            $criteria->add(BrandCampiagnTableMap::COL_DISTRIBUTED, $this->distributed);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DISTRIBUTED_DONE)) {
            $criteria->add(BrandCampiagnTableMap::COL_DISTRIBUTED_DONE, $this->distributed_done);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CLASSIFICATION_ID)) {
            $criteria->add(BrandCampiagnTableMap::COL_CLASSIFICATION_ID, $this->classification_id);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DESCRIPTION)) {
            $criteria->add(BrandCampiagnTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MEDIA)) {
            $criteria->add(BrandCampiagnTableMap::COL_MEDIA, $this->media);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MATERIAL)) {
            $criteria->add(BrandCampiagnTableMap::COL_MATERIAL, $this->material);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_TYPE)) {
            $criteria->add(BrandCampiagnTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_TAGS)) {
            $criteria->add(BrandCampiagnTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_COMPANY_ID)) {
            $criteria->add(BrandCampiagnTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CREATED_AT)) {
            $criteria->add(BrandCampiagnTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_UPDATED_AT)) {
            $criteria->add(BrandCampiagnTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(BrandCampiagnTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE)) {
            $criteria->add(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE, $this->brand_campiagn_code);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_OUTLETTYPE_ID)) {
            $criteria->add(BrandCampiagnTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CLASSIFICATIONS)) {
            $criteria->add(BrandCampiagnTableMap::COL_CLASSIFICATIONS, $this->classifications);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_FOCUS_BRANDS)) {
            $criteria->add(BrandCampiagnTableMap::COL_FOCUS_BRANDS, $this->focus_brands);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY)) {
            $criteria->add(BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY, $this->minimum_per_territory);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY)) {
            $criteria->add(BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY, $this->maximum_per_territory);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN)) {
            $criteria->add(BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN, $this->minimum_for_campiagn);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN)) {
            $criteria->add(BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN, $this->maximum_for_campiagn);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_IS_SUSPENDED)) {
            $criteria->add(BrandCampiagnTableMap::COL_IS_SUSPENDED, $this->is_suspended);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_STATUS)) {
            $criteria->add(BrandCampiagnTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_CAMPIAGN_TYPE)) {
            $criteria->add(BrandCampiagnTableMap::COL_CAMPIAGN_TYPE, $this->campiagn_type);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_DESIGNATION)) {
            $criteria->add(BrandCampiagnTableMap::COL_DESIGNATION, $this->designation);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_POSITION)) {
            $criteria->add(BrandCampiagnTableMap::COL_POSITION, $this->position);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_SGPI_BRANDS)) {
            $criteria->add(BrandCampiagnTableMap::COL_SGPI_BRANDS, $this->sgpi_brands);
        }
        if ($this->isColumnModified(BrandCampiagnTableMap::COL_COMMENT)) {
            $criteria->add(BrandCampiagnTableMap::COL_COMMENT, $this->comment);
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
        $criteria = ChildBrandCampiagnQuery::create();
        $criteria->add(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $this->brand_campiagn_id);

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
        $validPk = null !== $this->getBrandCampiagnId();

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
        return $this->getBrandCampiagnId();
    }

    /**
     * Generic method to set the primary key (brand_campiagn_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setBrandCampiagnId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getBrandCampiagnId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\BrandCampiagn (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCampiagnName($this->getCampiagnName());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setLockingDate($this->getLockingDate());
        $copyObj->setDoctorCount($this->getDoctorCount());
        $copyObj->setFocusBrandId($this->getFocusBrandId());
        $copyObj->setPlanned($this->getPlanned());
        $copyObj->setDone($this->getDone());
        $copyObj->setDistributed($this->getDistributed());
        $copyObj->setDistributedDone($this->getDistributedDone());
        $copyObj->setClassificationId($this->getClassificationId());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setMedia($this->getMedia());
        $copyObj->setMaterial($this->getMaterial());
        $copyObj->setType($this->getType());
        $copyObj->setTags($this->getTags());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setBrandCampiagnCode($this->getBrandCampiagnCode());
        $copyObj->setOutlettypeId($this->getOutlettypeId());
        $copyObj->setClassifications($this->getClassifications());
        $copyObj->setFocusBrands($this->getFocusBrands());
        $copyObj->setMinimumPerTerritory($this->getMinimumPerTerritory());
        $copyObj->setMaximumPerTerritory($this->getMaximumPerTerritory());
        $copyObj->setMinimumForCampiagn($this->getMinimumForCampiagn());
        $copyObj->setMaximumForCampiagn($this->getMaximumForCampiagn());
        $copyObj->setIsSuspended($this->getIsSuspended());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCampiagnType($this->getCampiagnType());
        $copyObj->setDesignation($this->getDesignation());
        $copyObj->setPosition($this->getPosition());
        $copyObj->setSgpiBrands($this->getSgpiBrands());
        $copyObj->setComment($this->getComment());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagnClassifications() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnClassification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandCampiagnDoctorss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnDoctors($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandCampiagnVisitPlans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnVisitPlan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandCampiagnVisitss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnVisits($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBrandCampiagnId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\BrandCampiagn Clone of current object.
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
     * Declares an association between this object and a ChildDesignations object.
     *
     * @param ChildDesignations|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setDesignations(ChildDesignations $v = null)
    {
        if ($v === null) {
            $this->setDesignation(NULL);
        } else {
            $this->setDesignation($v->getDesignationId());
        }

        $this->aDesignations = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDesignations object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandCampiagn($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDesignations object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildDesignations|null The associated ChildDesignations object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDesignations(?ConnectionInterface $con = null)
    {
        if ($this->aDesignations === null && ($this->designation != 0)) {
            $this->aDesignations = ChildDesignationsQuery::create()->findPk($this->designation, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDesignations->addBrandCampiagns($this);
             */
        }

        return $this->aDesignations;
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
            $this->setFocusBrandId(NULL);
        } else {
            $this->setFocusBrandId($v->getBrandId());
        }

        $this->aBrands = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrands object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandCampiagn($this);
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
        if ($this->aBrands === null && ($this->focus_brand_id != 0)) {
            $this->aBrands = ChildBrandsQuery::create()->findPk($this->focus_brand_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrands->addBrandCampiagns($this);
             */
        }

        return $this->aBrands;
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
            $v->addBrandCampiagn($this);
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
                $this->aCompany->addBrandCampiagns($this);
             */
        }

        return $this->aCompany;
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
            $this->setOrgUnitId(NULL);
        } else {
            $this->setOrgUnitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandCampiagn($this);
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
        if ($this->aOrgUnit === null && ($this->org_unit_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->org_unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addBrandCampiagns($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildOutletType object.
     *
     * @param ChildOutletType|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletType(ChildOutletType $v = null)
    {
        if ($v === null) {
            $this->setOutlettypeId(NULL);
        } else {
            $this->setOutlettypeId($v->getOutlettypeId());
        }

        $this->aOutletType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletType object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandCampiagn($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletType|null The associated ChildOutletType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletType(?ConnectionInterface $con = null)
    {
        if ($this->aOutletType === null && ($this->outlettype_id != 0)) {
            $this->aOutletType = ChildOutletTypeQuery::create()->findPk($this->outlettype_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletType->addBrandCampiagns($this);
             */
        }

        return $this->aOutletType;
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
        if ('BrandCampiagnClassification' === $relationName) {
            $this->initBrandCampiagnClassifications();
            return;
        }
        if ('BrandCampiagnDoctors' === $relationName) {
            $this->initBrandCampiagnDoctorss();
            return;
        }
        if ('BrandCampiagnVisitPlan' === $relationName) {
            $this->initBrandCampiagnVisitPlans();
            return;
        }
        if ('BrandCampiagnVisits' === $relationName) {
            $this->initBrandCampiagnVisitss();
            return;
        }
    }

    /**
     * Clears out the collBrandCampiagnClassifications collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagnClassifications()
     */
    public function clearBrandCampiagnClassifications()
    {
        $this->collBrandCampiagnClassifications = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagnClassifications collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagnClassifications($v = true): void
    {
        $this->collBrandCampiagnClassificationsPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagnClassifications collection.
     *
     * By default this just sets the collBrandCampiagnClassifications collection to an empty array (like clearcollBrandCampiagnClassifications());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagnClassifications(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagnClassifications && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnClassificationTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagnClassifications = new $collectionClassName;
        $this->collBrandCampiagnClassifications->setModel('\entities\BrandCampiagnClassification');
    }

    /**
     * Gets an array of ChildBrandCampiagnClassification objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrandCampiagn is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagnClassification[] List of ChildBrandCampiagnClassification objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnClassification> List of ChildBrandCampiagnClassification objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagnClassifications(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnClassificationsPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnClassifications || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagnClassifications) {
                    $this->initBrandCampiagnClassifications();
                } else {
                    $collectionClassName = BrandCampiagnClassificationTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagnClassifications = new $collectionClassName;
                    $collBrandCampiagnClassifications->setModel('\entities\BrandCampiagnClassification');

                    return $collBrandCampiagnClassifications;
                }
            } else {
                $collBrandCampiagnClassifications = ChildBrandCampiagnClassificationQuery::create(null, $criteria)
                    ->filterByBrandCampiagn($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnClassificationsPartial && count($collBrandCampiagnClassifications)) {
                        $this->initBrandCampiagnClassifications(false);

                        foreach ($collBrandCampiagnClassifications as $obj) {
                            if (false == $this->collBrandCampiagnClassifications->contains($obj)) {
                                $this->collBrandCampiagnClassifications->append($obj);
                            }
                        }

                        $this->collBrandCampiagnClassificationsPartial = true;
                    }

                    return $collBrandCampiagnClassifications;
                }

                if ($partial && $this->collBrandCampiagnClassifications) {
                    foreach ($this->collBrandCampiagnClassifications as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagnClassifications[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagnClassifications = $collBrandCampiagnClassifications;
                $this->collBrandCampiagnClassificationsPartial = false;
            }
        }

        return $this->collBrandCampiagnClassifications;
    }

    /**
     * Sets a collection of ChildBrandCampiagnClassification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagnClassifications A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnClassifications(Collection $brandCampiagnClassifications, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagnClassification[] $brandCampiagnClassificationsToDelete */
        $brandCampiagnClassificationsToDelete = $this->getBrandCampiagnClassifications(new Criteria(), $con)->diff($brandCampiagnClassifications);


        $this->brandCampiagnClassificationsScheduledForDeletion = $brandCampiagnClassificationsToDelete;

        foreach ($brandCampiagnClassificationsToDelete as $brandCampiagnClassificationRemoved) {
            $brandCampiagnClassificationRemoved->setBrandCampiagn(null);
        }

        $this->collBrandCampiagnClassifications = null;
        foreach ($brandCampiagnClassifications as $brandCampiagnClassification) {
            $this->addBrandCampiagnClassification($brandCampiagnClassification);
        }

        $this->collBrandCampiagnClassifications = $brandCampiagnClassifications;
        $this->collBrandCampiagnClassificationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagnClassification objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagnClassification objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagnClassifications(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnClassificationsPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnClassifications || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagnClassifications) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagnClassifications());
            }

            $query = ChildBrandCampiagnClassificationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrandCampiagn($this)
                ->count($con);
        }

        return count($this->collBrandCampiagnClassifications);
    }

    /**
     * Method called to associate a ChildBrandCampiagnClassification object to this object
     * through the ChildBrandCampiagnClassification foreign key attribute.
     *
     * @param ChildBrandCampiagnClassification $l ChildBrandCampiagnClassification
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagnClassification(ChildBrandCampiagnClassification $l)
    {
        if ($this->collBrandCampiagnClassifications === null) {
            $this->initBrandCampiagnClassifications();
            $this->collBrandCampiagnClassificationsPartial = true;
        }

        if (!$this->collBrandCampiagnClassifications->contains($l)) {
            $this->doAddBrandCampiagnClassification($l);

            if ($this->brandCampiagnClassificationsScheduledForDeletion and $this->brandCampiagnClassificationsScheduledForDeletion->contains($l)) {
                $this->brandCampiagnClassificationsScheduledForDeletion->remove($this->brandCampiagnClassificationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagnClassification $brandCampiagnClassification The ChildBrandCampiagnClassification object to add.
     */
    protected function doAddBrandCampiagnClassification(ChildBrandCampiagnClassification $brandCampiagnClassification): void
    {
        $this->collBrandCampiagnClassifications[]= $brandCampiagnClassification;
        $brandCampiagnClassification->setBrandCampiagn($this);
    }

    /**
     * @param ChildBrandCampiagnClassification $brandCampiagnClassification The ChildBrandCampiagnClassification object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagnClassification(ChildBrandCampiagnClassification $brandCampiagnClassification)
    {
        if ($this->getBrandCampiagnClassifications()->contains($brandCampiagnClassification)) {
            $pos = $this->collBrandCampiagnClassifications->search($brandCampiagnClassification);
            $this->collBrandCampiagnClassifications->remove($pos);
            if (null === $this->brandCampiagnClassificationsScheduledForDeletion) {
                $this->brandCampiagnClassificationsScheduledForDeletion = clone $this->collBrandCampiagnClassifications;
                $this->brandCampiagnClassificationsScheduledForDeletion->clear();
            }
            $this->brandCampiagnClassificationsScheduledForDeletion[]= clone $brandCampiagnClassification;
            $brandCampiagnClassification->setBrandCampiagn(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnClassifications from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnClassification[] List of ChildBrandCampiagnClassification objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnClassification}> List of ChildBrandCampiagnClassification objects
     */
    public function getBrandCampiagnClassificationsJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnClassificationQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getBrandCampiagnClassifications($query, $con);
    }

    /**
     * Clears out the collBrandCampiagnDoctorss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagnDoctorss()
     */
    public function clearBrandCampiagnDoctorss()
    {
        $this->collBrandCampiagnDoctorss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagnDoctorss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagnDoctorss($v = true): void
    {
        $this->collBrandCampiagnDoctorssPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagnDoctorss collection.
     *
     * By default this just sets the collBrandCampiagnDoctorss collection to an empty array (like clearcollBrandCampiagnDoctorss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagnDoctorss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagnDoctorss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnDoctorsTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagnDoctorss = new $collectionClassName;
        $this->collBrandCampiagnDoctorss->setModel('\entities\BrandCampiagnDoctors');
    }

    /**
     * Gets an array of ChildBrandCampiagnDoctors objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrandCampiagn is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors> List of ChildBrandCampiagnDoctors objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagnDoctorss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnDoctorssPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnDoctorss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagnDoctorss) {
                    $this->initBrandCampiagnDoctorss();
                } else {
                    $collectionClassName = BrandCampiagnDoctorsTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagnDoctorss = new $collectionClassName;
                    $collBrandCampiagnDoctorss->setModel('\entities\BrandCampiagnDoctors');

                    return $collBrandCampiagnDoctorss;
                }
            } else {
                $collBrandCampiagnDoctorss = ChildBrandCampiagnDoctorsQuery::create(null, $criteria)
                    ->filterByBrandCampiagn($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnDoctorssPartial && count($collBrandCampiagnDoctorss)) {
                        $this->initBrandCampiagnDoctorss(false);

                        foreach ($collBrandCampiagnDoctorss as $obj) {
                            if (false == $this->collBrandCampiagnDoctorss->contains($obj)) {
                                $this->collBrandCampiagnDoctorss->append($obj);
                            }
                        }

                        $this->collBrandCampiagnDoctorssPartial = true;
                    }

                    return $collBrandCampiagnDoctorss;
                }

                if ($partial && $this->collBrandCampiagnDoctorss) {
                    foreach ($this->collBrandCampiagnDoctorss as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagnDoctorss[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagnDoctorss = $collBrandCampiagnDoctorss;
                $this->collBrandCampiagnDoctorssPartial = false;
            }
        }

        return $this->collBrandCampiagnDoctorss;
    }

    /**
     * Sets a collection of ChildBrandCampiagnDoctors objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagnDoctorss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnDoctorss(Collection $brandCampiagnDoctorss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagnDoctors[] $brandCampiagnDoctorssToDelete */
        $brandCampiagnDoctorssToDelete = $this->getBrandCampiagnDoctorss(new Criteria(), $con)->diff($brandCampiagnDoctorss);


        $this->brandCampiagnDoctorssScheduledForDeletion = $brandCampiagnDoctorssToDelete;

        foreach ($brandCampiagnDoctorssToDelete as $brandCampiagnDoctorsRemoved) {
            $brandCampiagnDoctorsRemoved->setBrandCampiagn(null);
        }

        $this->collBrandCampiagnDoctorss = null;
        foreach ($brandCampiagnDoctorss as $brandCampiagnDoctors) {
            $this->addBrandCampiagnDoctors($brandCampiagnDoctors);
        }

        $this->collBrandCampiagnDoctorss = $brandCampiagnDoctorss;
        $this->collBrandCampiagnDoctorssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagnDoctors objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagnDoctors objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagnDoctorss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnDoctorssPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnDoctorss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagnDoctorss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagnDoctorss());
            }

            $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrandCampiagn($this)
                ->count($con);
        }

        return count($this->collBrandCampiagnDoctorss);
    }

    /**
     * Method called to associate a ChildBrandCampiagnDoctors object to this object
     * through the ChildBrandCampiagnDoctors foreign key attribute.
     *
     * @param ChildBrandCampiagnDoctors $l ChildBrandCampiagnDoctors
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagnDoctors(ChildBrandCampiagnDoctors $l)
    {
        if ($this->collBrandCampiagnDoctorss === null) {
            $this->initBrandCampiagnDoctorss();
            $this->collBrandCampiagnDoctorssPartial = true;
        }

        if (!$this->collBrandCampiagnDoctorss->contains($l)) {
            $this->doAddBrandCampiagnDoctors($l);

            if ($this->brandCampiagnDoctorssScheduledForDeletion and $this->brandCampiagnDoctorssScheduledForDeletion->contains($l)) {
                $this->brandCampiagnDoctorssScheduledForDeletion->remove($this->brandCampiagnDoctorssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagnDoctors $brandCampiagnDoctors The ChildBrandCampiagnDoctors object to add.
     */
    protected function doAddBrandCampiagnDoctors(ChildBrandCampiagnDoctors $brandCampiagnDoctors): void
    {
        $this->collBrandCampiagnDoctorss[]= $brandCampiagnDoctors;
        $brandCampiagnDoctors->setBrandCampiagn($this);
    }

    /**
     * @param ChildBrandCampiagnDoctors $brandCampiagnDoctors The ChildBrandCampiagnDoctors object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagnDoctors(ChildBrandCampiagnDoctors $brandCampiagnDoctors)
    {
        if ($this->getBrandCampiagnDoctorss()->contains($brandCampiagnDoctors)) {
            $pos = $this->collBrandCampiagnDoctorss->search($brandCampiagnDoctors);
            $this->collBrandCampiagnDoctorss->remove($pos);
            if (null === $this->brandCampiagnDoctorssScheduledForDeletion) {
                $this->brandCampiagnDoctorssScheduledForDeletion = clone $this->collBrandCampiagnDoctorss;
                $this->brandCampiagnDoctorssScheduledForDeletion->clear();
            }
            $this->brandCampiagnDoctorssScheduledForDeletion[]= $brandCampiagnDoctors;
            $brandCampiagnDoctors->setBrandCampiagn(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }

    /**
     * Clears out the collBrandCampiagnVisitPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagnVisitPlans()
     */
    public function clearBrandCampiagnVisitPlans()
    {
        $this->collBrandCampiagnVisitPlans = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagnVisitPlans collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagnVisitPlans($v = true): void
    {
        $this->collBrandCampiagnVisitPlansPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagnVisitPlans collection.
     *
     * By default this just sets the collBrandCampiagnVisitPlans collection to an empty array (like clearcollBrandCampiagnVisitPlans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagnVisitPlans(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagnVisitPlans && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnVisitPlanTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagnVisitPlans = new $collectionClassName;
        $this->collBrandCampiagnVisitPlans->setModel('\entities\BrandCampiagnVisitPlan');
    }

    /**
     * Gets an array of ChildBrandCampiagnVisitPlan objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrandCampiagn is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan> List of ChildBrandCampiagnVisitPlan objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagnVisitPlans(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnVisitPlansPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnVisitPlans || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagnVisitPlans) {
                    $this->initBrandCampiagnVisitPlans();
                } else {
                    $collectionClassName = BrandCampiagnVisitPlanTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagnVisitPlans = new $collectionClassName;
                    $collBrandCampiagnVisitPlans->setModel('\entities\BrandCampiagnVisitPlan');

                    return $collBrandCampiagnVisitPlans;
                }
            } else {
                $collBrandCampiagnVisitPlans = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria)
                    ->filterByBrandCampiagn($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnVisitPlansPartial && count($collBrandCampiagnVisitPlans)) {
                        $this->initBrandCampiagnVisitPlans(false);

                        foreach ($collBrandCampiagnVisitPlans as $obj) {
                            if (false == $this->collBrandCampiagnVisitPlans->contains($obj)) {
                                $this->collBrandCampiagnVisitPlans->append($obj);
                            }
                        }

                        $this->collBrandCampiagnVisitPlansPartial = true;
                    }

                    return $collBrandCampiagnVisitPlans;
                }

                if ($partial && $this->collBrandCampiagnVisitPlans) {
                    foreach ($this->collBrandCampiagnVisitPlans as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagnVisitPlans[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagnVisitPlans = $collBrandCampiagnVisitPlans;
                $this->collBrandCampiagnVisitPlansPartial = false;
            }
        }

        return $this->collBrandCampiagnVisitPlans;
    }

    /**
     * Sets a collection of ChildBrandCampiagnVisitPlan objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagnVisitPlans A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnVisitPlans(Collection $brandCampiagnVisitPlans, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagnVisitPlan[] $brandCampiagnVisitPlansToDelete */
        $brandCampiagnVisitPlansToDelete = $this->getBrandCampiagnVisitPlans(new Criteria(), $con)->diff($brandCampiagnVisitPlans);


        $this->brandCampiagnVisitPlansScheduledForDeletion = $brandCampiagnVisitPlansToDelete;

        foreach ($brandCampiagnVisitPlansToDelete as $brandCampiagnVisitPlanRemoved) {
            $brandCampiagnVisitPlanRemoved->setBrandCampiagn(null);
        }

        $this->collBrandCampiagnVisitPlans = null;
        foreach ($brandCampiagnVisitPlans as $brandCampiagnVisitPlan) {
            $this->addBrandCampiagnVisitPlan($brandCampiagnVisitPlan);
        }

        $this->collBrandCampiagnVisitPlans = $brandCampiagnVisitPlans;
        $this->collBrandCampiagnVisitPlansPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagnVisitPlan objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagnVisitPlan objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagnVisitPlans(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnVisitPlansPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnVisitPlans || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagnVisitPlans) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagnVisitPlans());
            }

            $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrandCampiagn($this)
                ->count($con);
        }

        return count($this->collBrandCampiagnVisitPlans);
    }

    /**
     * Method called to associate a ChildBrandCampiagnVisitPlan object to this object
     * through the ChildBrandCampiagnVisitPlan foreign key attribute.
     *
     * @param ChildBrandCampiagnVisitPlan $l ChildBrandCampiagnVisitPlan
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagnVisitPlan(ChildBrandCampiagnVisitPlan $l)
    {
        if ($this->collBrandCampiagnVisitPlans === null) {
            $this->initBrandCampiagnVisitPlans();
            $this->collBrandCampiagnVisitPlansPartial = true;
        }

        if (!$this->collBrandCampiagnVisitPlans->contains($l)) {
            $this->doAddBrandCampiagnVisitPlan($l);

            if ($this->brandCampiagnVisitPlansScheduledForDeletion and $this->brandCampiagnVisitPlansScheduledForDeletion->contains($l)) {
                $this->brandCampiagnVisitPlansScheduledForDeletion->remove($this->brandCampiagnVisitPlansScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan The ChildBrandCampiagnVisitPlan object to add.
     */
    protected function doAddBrandCampiagnVisitPlan(ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan): void
    {
        $this->collBrandCampiagnVisitPlans[]= $brandCampiagnVisitPlan;
        $brandCampiagnVisitPlan->setBrandCampiagn($this);
    }

    /**
     * @param ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan The ChildBrandCampiagnVisitPlan object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagnVisitPlan(ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan)
    {
        if ($this->getBrandCampiagnVisitPlans()->contains($brandCampiagnVisitPlan)) {
            $pos = $this->collBrandCampiagnVisitPlans->search($brandCampiagnVisitPlan);
            $this->collBrandCampiagnVisitPlans->remove($pos);
            if (null === $this->brandCampiagnVisitPlansScheduledForDeletion) {
                $this->brandCampiagnVisitPlansScheduledForDeletion = clone $this->collBrandCampiagnVisitPlans;
                $this->brandCampiagnVisitPlansScheduledForDeletion->clear();
            }
            $this->brandCampiagnVisitPlansScheduledForDeletion[]= $brandCampiagnVisitPlan;
            $brandCampiagnVisitPlan->setBrandCampiagn(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan}> List of ChildBrandCampiagnVisitPlan objects
     */
    public function getBrandCampiagnVisitPlansJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCampiagnVisitPlans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan}> List of ChildBrandCampiagnVisitPlan objects
     */
    public function getBrandCampiagnVisitPlansJoinAgendatypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
        $query->joinWith('Agendatypes', $joinBehavior);

        return $this->getBrandCampiagnVisitPlans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan}> List of ChildBrandCampiagnVisitPlan objects
     */
    public function getBrandCampiagnVisitPlansJoinSurvey(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
        $query->joinWith('Survey', $joinBehavior);

        return $this->getBrandCampiagnVisitPlans($query, $con);
    }

    /**
     * Clears out the collBrandCampiagnVisitss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagnVisitss()
     */
    public function clearBrandCampiagnVisitss()
    {
        $this->collBrandCampiagnVisitss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagnVisitss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagnVisitss($v = true): void
    {
        $this->collBrandCampiagnVisitssPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagnVisitss collection.
     *
     * By default this just sets the collBrandCampiagnVisitss collection to an empty array (like clearcollBrandCampiagnVisitss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagnVisitss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagnVisitss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnVisitsTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagnVisitss = new $collectionClassName;
        $this->collBrandCampiagnVisitss->setModel('\entities\BrandCampiagnVisits');
    }

    /**
     * Gets an array of ChildBrandCampiagnVisits objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrandCampiagn is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits> List of ChildBrandCampiagnVisits objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagnVisitss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnVisitssPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnVisitss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagnVisitss) {
                    $this->initBrandCampiagnVisitss();
                } else {
                    $collectionClassName = BrandCampiagnVisitsTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagnVisitss = new $collectionClassName;
                    $collBrandCampiagnVisitss->setModel('\entities\BrandCampiagnVisits');

                    return $collBrandCampiagnVisitss;
                }
            } else {
                $collBrandCampiagnVisitss = ChildBrandCampiagnVisitsQuery::create(null, $criteria)
                    ->filterByBrandCampiagn($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnVisitssPartial && count($collBrandCampiagnVisitss)) {
                        $this->initBrandCampiagnVisitss(false);

                        foreach ($collBrandCampiagnVisitss as $obj) {
                            if (false == $this->collBrandCampiagnVisitss->contains($obj)) {
                                $this->collBrandCampiagnVisitss->append($obj);
                            }
                        }

                        $this->collBrandCampiagnVisitssPartial = true;
                    }

                    return $collBrandCampiagnVisitss;
                }

                if ($partial && $this->collBrandCampiagnVisitss) {
                    foreach ($this->collBrandCampiagnVisitss as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagnVisitss[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagnVisitss = $collBrandCampiagnVisitss;
                $this->collBrandCampiagnVisitssPartial = false;
            }
        }

        return $this->collBrandCampiagnVisitss;
    }

    /**
     * Sets a collection of ChildBrandCampiagnVisits objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagnVisitss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnVisitss(Collection $brandCampiagnVisitss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagnVisits[] $brandCampiagnVisitssToDelete */
        $brandCampiagnVisitssToDelete = $this->getBrandCampiagnVisitss(new Criteria(), $con)->diff($brandCampiagnVisitss);


        $this->brandCampiagnVisitssScheduledForDeletion = $brandCampiagnVisitssToDelete;

        foreach ($brandCampiagnVisitssToDelete as $brandCampiagnVisitsRemoved) {
            $brandCampiagnVisitsRemoved->setBrandCampiagn(null);
        }

        $this->collBrandCampiagnVisitss = null;
        foreach ($brandCampiagnVisitss as $brandCampiagnVisits) {
            $this->addBrandCampiagnVisits($brandCampiagnVisits);
        }

        $this->collBrandCampiagnVisitss = $brandCampiagnVisitss;
        $this->collBrandCampiagnVisitssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagnVisits objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagnVisits objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagnVisitss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnVisitssPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnVisitss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagnVisitss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagnVisitss());
            }

            $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrandCampiagn($this)
                ->count($con);
        }

        return count($this->collBrandCampiagnVisitss);
    }

    /**
     * Method called to associate a ChildBrandCampiagnVisits object to this object
     * through the ChildBrandCampiagnVisits foreign key attribute.
     *
     * @param ChildBrandCampiagnVisits $l ChildBrandCampiagnVisits
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagnVisits(ChildBrandCampiagnVisits $l)
    {
        if ($this->collBrandCampiagnVisitss === null) {
            $this->initBrandCampiagnVisitss();
            $this->collBrandCampiagnVisitssPartial = true;
        }

        if (!$this->collBrandCampiagnVisitss->contains($l)) {
            $this->doAddBrandCampiagnVisits($l);

            if ($this->brandCampiagnVisitssScheduledForDeletion and $this->brandCampiagnVisitssScheduledForDeletion->contains($l)) {
                $this->brandCampiagnVisitssScheduledForDeletion->remove($this->brandCampiagnVisitssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagnVisits $brandCampiagnVisits The ChildBrandCampiagnVisits object to add.
     */
    protected function doAddBrandCampiagnVisits(ChildBrandCampiagnVisits $brandCampiagnVisits): void
    {
        $this->collBrandCampiagnVisitss[]= $brandCampiagnVisits;
        $brandCampiagnVisits->setBrandCampiagn($this);
    }

    /**
     * @param ChildBrandCampiagnVisits $brandCampiagnVisits The ChildBrandCampiagnVisits object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagnVisits(ChildBrandCampiagnVisits $brandCampiagnVisits)
    {
        if ($this->getBrandCampiagnVisitss()->contains($brandCampiagnVisits)) {
            $pos = $this->collBrandCampiagnVisitss->search($brandCampiagnVisits);
            $this->collBrandCampiagnVisitss->remove($pos);
            if (null === $this->brandCampiagnVisitssScheduledForDeletion) {
                $this->brandCampiagnVisitssScheduledForDeletion = clone $this->collBrandCampiagnVisitss;
                $this->brandCampiagnVisitssScheduledForDeletion->clear();
            }
            $this->brandCampiagnVisitssScheduledForDeletion[]= $brandCampiagnVisits;
            $brandCampiagnVisits->setBrandCampiagn(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinDailycalls(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('Dailycalls', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagn is new, it will return
     * an empty collection; or if this BrandCampiagn has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagn.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
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
        if (null !== $this->aDesignations) {
            $this->aDesignations->removeBrandCampiagn($this);
        }
        if (null !== $this->aBrands) {
            $this->aBrands->removeBrandCampiagn($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeBrandCampiagn($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeBrandCampiagn($this);
        }
        if (null !== $this->aOutletType) {
            $this->aOutletType->removeBrandCampiagn($this);
        }
        $this->brand_campiagn_id = null;
        $this->campiagn_name = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->locking_date = null;
        $this->doctor_count = null;
        $this->focus_brand_id = null;
        $this->planned = null;
        $this->done = null;
        $this->distributed = null;
        $this->distributed_done = null;
        $this->classification_id = null;
        $this->description = null;
        $this->media = null;
        $this->material = null;
        $this->type = null;
        $this->tags = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->org_unit_id = null;
        $this->brand_campiagn_code = null;
        $this->outlettype_id = null;
        $this->classifications = null;
        $this->focus_brands = null;
        $this->minimum_per_territory = null;
        $this->maximum_per_territory = null;
        $this->minimum_for_campiagn = null;
        $this->maximum_for_campiagn = null;
        $this->is_suspended = null;
        $this->status = null;
        $this->campiagn_type = null;
        $this->designation = null;
        $this->position = null;
        $this->sgpi_brands = null;
        $this->comment = null;
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
            if ($this->collBrandCampiagnClassifications) {
                foreach ($this->collBrandCampiagnClassifications as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandCampiagnDoctorss) {
                foreach ($this->collBrandCampiagnDoctorss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandCampiagnVisitPlans) {
                foreach ($this->collBrandCampiagnVisitPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandCampiagnVisitss) {
                foreach ($this->collBrandCampiagnVisitss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagnClassifications = null;
        $this->collBrandCampiagnDoctorss = null;
        $this->collBrandCampiagnVisitPlans = null;
        $this->collBrandCampiagnVisitss = null;
        $this->aDesignations = null;
        $this->aBrands = null;
        $this->aCompany = null;
        $this->aOrgUnit = null;
        $this->aOutletType = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BrandCampiagnTableMap::DEFAULT_STRING_FORMAT);
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
