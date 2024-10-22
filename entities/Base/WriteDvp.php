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
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\WriteDvpQuery as ChildWriteDvpQuery;
use entities\Map\WriteDvpTableMap;

/**
 * Base class that represents a row from the 'write_dvp' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class WriteDvp implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\WriteDvpTableMap';


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
     * The value for the org_unit field.
     *
     * @var        string|null
     */
    protected $org_unit;

    /**
     * The value for the employee_code field.
     *
     * @var        string|null
     */
    protected $employee_code;

    /**
     * The value for the joining_date field.
     *
     * @var        string|null
     */
    protected $joining_date;

    /**
     * The value for the am_position field.
     *
     * @var        string|null
     */
    protected $am_position;

    /**
     * The value for the rm_position field.
     *
     * @var        string|null
     */
    protected $rm_position;

    /**
     * The value for the zm_position field.
     *
     * @var        string|null
     */
    protected $zm_position;

    /**
     * The value for the location field.
     *
     * @var        string|null
     */
    protected $location;

    /**
     * The value for the status field.
     *
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the employee_name field.
     *
     * @var        string|null
     */
    protected $employee_name;

    /**
     * The value for the doctor_name field.
     *
     * @var        string|null
     */
    protected $doctor_name;

    /**
     * The value for the doctor_code field.
     *
     * @var        string|null
     */
    protected $doctor_code;

    /**
     * The value for the town field.
     *
     * @var        string|null
     */
    protected $town;

    /**
     * The value for the patch field.
     *
     * @var        string|null
     */
    protected $patch;

    /**
     * The value for the speciality field.
     *
     * @var        string|null
     */
    protected $speciality;

    /**
     * The value for the tags field.
     *
     * @var        string|null
     */
    protected $tags;

    /**
     * The value for the visit_fq field.
     *
     * @var        string|null
     */
    protected $visit_fq;

    /**
     * The value for the prescriber_classification field.
     *
     * @var        string|null
     */
    protected $prescriber_classification;

    /**
     * The value for the top_brand field.
     *
     * @var        string|null
     */
    protected $top_brand;

    /**
     * The value for the visit_dr field.
     *
     * @var        string|null
     */
    protected $visit_dr;

    /**
     * The value for the am_visit_dr field.
     *
     * @var        string|null
     */
    protected $am_visit_dr;

    /**
     * The value for the rm_visit_dr field.
     *
     * @var        string|null
     */
    protected $rm_visit_dr;

    /**
     * The value for the zm_visit_dr field.
     *
     * @var        string|null
     */
    protected $zm_visit_dr;

    /**
     * The value for the rcpa_done field.
     *
     * @var        string|null
     */
    protected $rcpa_done;

    /**
     * The value for the rcpa_lm_own field.
     *
     * @var        string|null
     */
    protected $rcpa_lm_own;

    /**
     * The value for the rcpa_lm_comp field.
     *
     * @var        string|null
     */
    protected $rcpa_lm_comp;

    /**
     * The value for the rcpa_cm_own field.
     *
     * @var        string|null
     */
    protected $rcpa_cm_own;

    /**
     * The value for the rcpa_cm_comp field.
     *
     * @var        string|null
     */
    protected $rcpa_cm_comp;

    /**
     * The value for the samples_sgpi field.
     *
     * @var        string|null
     */
    protected $samples_sgpi;

    /**
     * The value for the gifts_sgpi field.
     *
     * @var        string|null
     */
    protected $gifts_sgpi;

    /**
     * The value for the promo_sgpi field.
     *
     * @var        string|null
     */
    protected $promo_sgpi;

    /**
     * The value for the zm_position_code field.
     *
     * @var        string|null
     */
    protected $zm_position_code;

    /**
     * The value for the rm_position_code field.
     *
     * @var        string|null
     */
    protected $rm_position_code;

    /**
     * The value for the am_position_code field.
     *
     * @var        string|null
     */
    protected $am_position_code;

    /**
     * The value for the employee_position_code field.
     *
     * @var        string|null
     */
    protected $employee_position_code;

    /**
     * The value for the employee_position field.
     *
     * @var        string|null
     */
    protected $employee_position;

    /**
     * The value for the employee_level field.
     *
     * @var        string|null
     */
    protected $employee_level;

    /**
     * The value for the month field.
     *
     * @var        string|null
     */
    protected $month;

    /**
     * The value for the dvp_report_id field.
     *
     * @var        int
     */
    protected $dvp_report_id;

    /**
     * The value for the mr_detailing field.
     *
     * @var        string|null
     */
    protected $mr_detailing;

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
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

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
     * Initializes internal state of entities\Base\WriteDvp object.
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
     * Compares this with another <code>WriteDvp</code> instance.  If
     * <code>obj</code> is an instance of <code>WriteDvp</code>, delegates to
     * <code>equals(WriteDvp)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [org_unit] column value.
     *
     * @return string|null
     */
    public function getOrgUnit()
    {
        return $this->org_unit;
    }

    /**
     * Get the [employee_code] column value.
     *
     * @return string|null
     */
    public function getEmployeeCode()
    {
        return $this->employee_code;
    }

    /**
     * Get the [joining_date] column value.
     *
     * @return string|null
     */
    public function getJoiningDate()
    {
        return $this->joining_date;
    }

    /**
     * Get the [am_position] column value.
     *
     * @return string|null
     */
    public function getAmPosition()
    {
        return $this->am_position;
    }

    /**
     * Get the [rm_position] column value.
     *
     * @return string|null
     */
    public function getRmPosition()
    {
        return $this->rm_position;
    }

    /**
     * Get the [zm_position] column value.
     *
     * @return string|null
     */
    public function getZmPosition()
    {
        return $this->zm_position;
    }

    /**
     * Get the [location] column value.
     *
     * @return string|null
     */
    public function getLocation()
    {
        return $this->location;
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
     * Get the [employee_name] column value.
     *
     * @return string|null
     */
    public function getEmployeeName()
    {
        return $this->employee_name;
    }

    /**
     * Get the [doctor_name] column value.
     *
     * @return string|null
     */
    public function getDoctorName()
    {
        return $this->doctor_name;
    }

    /**
     * Get the [doctor_code] column value.
     *
     * @return string|null
     */
    public function getDoctorCode()
    {
        return $this->doctor_code;
    }

    /**
     * Get the [town] column value.
     *
     * @return string|null
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Get the [patch] column value.
     *
     * @return string|null
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * Get the [speciality] column value.
     *
     * @return string|null
     */
    public function getSpeciality()
    {
        return $this->speciality;
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
     * Get the [visit_fq] column value.
     *
     * @return string|null
     */
    public function getVisitFq()
    {
        return $this->visit_fq;
    }

    /**
     * Get the [prescriber_classification] column value.
     *
     * @return string|null
     */
    public function getPrescriberClassification()
    {
        return $this->prescriber_classification;
    }

    /**
     * Get the [top_brand] column value.
     *
     * @return string|null
     */
    public function getTopBrand()
    {
        return $this->top_brand;
    }

    /**
     * Get the [visit_dr] column value.
     *
     * @return string|null
     */
    public function getVisitDr()
    {
        return $this->visit_dr;
    }

    /**
     * Get the [am_visit_dr] column value.
     *
     * @return string|null
     */
    public function getAmVisitDr()
    {
        return $this->am_visit_dr;
    }

    /**
     * Get the [rm_visit_dr] column value.
     *
     * @return string|null
     */
    public function getRmVisitDr()
    {
        return $this->rm_visit_dr;
    }

    /**
     * Get the [zm_visit_dr] column value.
     *
     * @return string|null
     */
    public function getZmVisitDr()
    {
        return $this->zm_visit_dr;
    }

    /**
     * Get the [rcpa_done] column value.
     *
     * @return string|null
     */
    public function getRcpaDone()
    {
        return $this->rcpa_done;
    }

    /**
     * Get the [rcpa_lm_own] column value.
     *
     * @return string|null
     */
    public function getRcpaLmOwn()
    {
        return $this->rcpa_lm_own;
    }

    /**
     * Get the [rcpa_lm_comp] column value.
     *
     * @return string|null
     */
    public function getRcpaLmComp()
    {
        return $this->rcpa_lm_comp;
    }

    /**
     * Get the [rcpa_cm_own] column value.
     *
     * @return string|null
     */
    public function getRcpaCmOwn()
    {
        return $this->rcpa_cm_own;
    }

    /**
     * Get the [rcpa_cm_comp] column value.
     *
     * @return string|null
     */
    public function getRcpaCmComp()
    {
        return $this->rcpa_cm_comp;
    }

    /**
     * Get the [samples_sgpi] column value.
     *
     * @return string|null
     */
    public function getSamplesSgpi()
    {
        return $this->samples_sgpi;
    }

    /**
     * Get the [gifts_sgpi] column value.
     *
     * @return string|null
     */
    public function getGiftsSgpi()
    {
        return $this->gifts_sgpi;
    }

    /**
     * Get the [promo_sgpi] column value.
     *
     * @return string|null
     */
    public function getPromoSgpi()
    {
        return $this->promo_sgpi;
    }

    /**
     * Get the [zm_position_code] column value.
     *
     * @return string|null
     */
    public function getZmPositionCode()
    {
        return $this->zm_position_code;
    }

    /**
     * Get the [rm_position_code] column value.
     *
     * @return string|null
     */
    public function getRmPositionCode()
    {
        return $this->rm_position_code;
    }

    /**
     * Get the [am_position_code] column value.
     *
     * @return string|null
     */
    public function getAmPositionCode()
    {
        return $this->am_position_code;
    }

    /**
     * Get the [employee_position_code] column value.
     *
     * @return string|null
     */
    public function getEmployeePositionCode()
    {
        return $this->employee_position_code;
    }

    /**
     * Get the [employee_position] column value.
     *
     * @return string|null
     */
    public function getEmployeePosition()
    {
        return $this->employee_position;
    }

    /**
     * Get the [employee_level] column value.
     *
     * @return string|null
     */
    public function getEmployeeLevel()
    {
        return $this->employee_level;
    }

    /**
     * Get the [month] column value.
     *
     * @return string|null
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Get the [dvp_report_id] column value.
     *
     * @return int
     */
    public function getDvpReportId()
    {
        return $this->dvp_report_id;
    }

    /**
     * Get the [mr_detailing] column value.
     *
     * @return string|null
     */
    public function getMrDetailing()
    {
        return $this->mr_detailing;
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
     * Set the value of [org_unit] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->org_unit !== $v) {
            $this->org_unit = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_ORG_UNIT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_code !== $v) {
            $this->employee_code = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [joining_date] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setJoiningDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->joining_date !== $v) {
            $this->joining_date = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_JOINING_DATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_position !== $v) {
            $this->am_position = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_AM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_position !== $v) {
            $this->rm_position = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_RM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_position !== $v) {
            $this->zm_position = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_ZM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [location] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_LOCATION] = true;
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
            $this->modifiedColumns[WriteDvpTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_name !== $v) {
            $this->employee_name = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_EMPLOYEE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [doctor_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDoctorName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->doctor_name !== $v) {
            $this->doctor_name = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_DOCTOR_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [doctor_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDoctorCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->doctor_code !== $v) {
            $this->doctor_code = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_DOCTOR_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->town !== $v) {
            $this->town = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [patch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPatch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->patch !== $v) {
            $this->patch = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_PATCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [speciality] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSpeciality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->speciality !== $v) {
            $this->speciality = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_SPECIALITY] = true;
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
            $this->modifiedColumns[WriteDvpTableMap::COL_TAGS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_fq] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVisitFq($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visit_fq !== $v) {
            $this->visit_fq = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_VISIT_FQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [prescriber_classification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrescriberClassification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prescriber_classification !== $v) {
            $this->prescriber_classification = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [top_brand] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTopBrand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->top_brand !== $v) {
            $this->top_brand = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_TOP_BRAND] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_dr] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVisitDr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visit_dr !== $v) {
            $this->visit_dr = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_VISIT_DR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_visit_dr] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmVisitDr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_visit_dr !== $v) {
            $this->am_visit_dr = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_AM_VISIT_DR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_visit_dr] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRmVisitDr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_visit_dr !== $v) {
            $this->rm_visit_dr = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_RM_VISIT_DR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_visit_dr] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZmVisitDr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_visit_dr !== $v) {
            $this->zm_visit_dr = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_ZM_VISIT_DR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_done] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaDone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_done !== $v) {
            $this->rcpa_done = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_RCPA_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_lm_own] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaLmOwn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_lm_own !== $v) {
            $this->rcpa_lm_own = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_RCPA_LM_OWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_lm_comp] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaLmComp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_lm_comp !== $v) {
            $this->rcpa_lm_comp = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_RCPA_LM_COMP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_cm_own] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaCmOwn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_cm_own !== $v) {
            $this->rcpa_cm_own = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_RCPA_CM_OWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_cm_comp] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaCmComp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_cm_comp !== $v) {
            $this->rcpa_cm_comp = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_RCPA_CM_COMP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [samples_sgpi] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSamplesSgpi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->samples_sgpi !== $v) {
            $this->samples_sgpi = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_SAMPLES_SGPI] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gifts_sgpi] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGiftsSgpi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gifts_sgpi !== $v) {
            $this->gifts_sgpi = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_GIFTS_SGPI] = true;
        }

        return $this;
    }

    /**
     * Set the value of [promo_sgpi] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPromoSgpi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->promo_sgpi !== $v) {
            $this->promo_sgpi = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_PROMO_SGPI] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_position_code !== $v) {
            $this->zm_position_code = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_ZM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_position_code !== $v) {
            $this->rm_position_code = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_RM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_position_code !== $v) {
            $this->am_position_code = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_AM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeePositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_position_code !== $v) {
            $this->employee_position_code = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeePosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_position !== $v) {
            $this->employee_position = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_EMPLOYEE_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_level] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_level !== $v) {
            $this->employee_level = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_EMPLOYEE_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [month] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMonth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->month !== $v) {
            $this->month = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_MONTH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dvp_report_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDvpReportId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dvp_report_id !== $v) {
            $this->dvp_report_id = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_DVP_REPORT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mr_detailing] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMrDetailing($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mr_detailing !== $v) {
            $this->mr_detailing = $v;
            $this->modifiedColumns[WriteDvpTableMap::COL_MR_DETAILING] = true;
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
                $this->modifiedColumns[WriteDvpTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[WriteDvpTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WriteDvpTableMap::translateFieldName('OrgUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WriteDvpTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WriteDvpTableMap::translateFieldName('JoiningDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->joining_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WriteDvpTableMap::translateFieldName('AmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WriteDvpTableMap::translateFieldName('RmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WriteDvpTableMap::translateFieldName('ZmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WriteDvpTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WriteDvpTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WriteDvpTableMap::translateFieldName('EmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WriteDvpTableMap::translateFieldName('DoctorName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->doctor_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WriteDvpTableMap::translateFieldName('DoctorCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->doctor_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : WriteDvpTableMap::translateFieldName('Town', TableMap::TYPE_PHPNAME, $indexType)];
            $this->town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : WriteDvpTableMap::translateFieldName('Patch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->patch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : WriteDvpTableMap::translateFieldName('Speciality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->speciality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : WriteDvpTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : WriteDvpTableMap::translateFieldName('VisitFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_fq = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : WriteDvpTableMap::translateFieldName('PrescriberClassification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prescriber_classification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : WriteDvpTableMap::translateFieldName('TopBrand', TableMap::TYPE_PHPNAME, $indexType)];
            $this->top_brand = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : WriteDvpTableMap::translateFieldName('VisitDr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_dr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : WriteDvpTableMap::translateFieldName('AmVisitDr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_visit_dr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : WriteDvpTableMap::translateFieldName('RmVisitDr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_visit_dr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : WriteDvpTableMap::translateFieldName('ZmVisitDr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_visit_dr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : WriteDvpTableMap::translateFieldName('RcpaDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_done = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : WriteDvpTableMap::translateFieldName('RcpaLmOwn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_lm_own = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : WriteDvpTableMap::translateFieldName('RcpaLmComp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_lm_comp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : WriteDvpTableMap::translateFieldName('RcpaCmOwn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_cm_own = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : WriteDvpTableMap::translateFieldName('RcpaCmComp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_cm_comp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : WriteDvpTableMap::translateFieldName('SamplesSgpi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->samples_sgpi = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : WriteDvpTableMap::translateFieldName('GiftsSgpi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gifts_sgpi = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : WriteDvpTableMap::translateFieldName('PromoSgpi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->promo_sgpi = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : WriteDvpTableMap::translateFieldName('ZmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : WriteDvpTableMap::translateFieldName('RmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : WriteDvpTableMap::translateFieldName('AmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : WriteDvpTableMap::translateFieldName('EmployeePositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : WriteDvpTableMap::translateFieldName('EmployeePosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : WriteDvpTableMap::translateFieldName('EmployeeLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : WriteDvpTableMap::translateFieldName('Month', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : WriteDvpTableMap::translateFieldName('DvpReportId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dvp_report_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : WriteDvpTableMap::translateFieldName('MrDetailing', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mr_detailing = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : WriteDvpTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : WriteDvpTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 41; // 41 = WriteDvpTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\WriteDvp'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(WriteDvpTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWriteDvpQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see WriteDvp::setDeleted()
     * @see WriteDvp::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteDvpTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWriteDvpQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WriteDvpTableMap::DATABASE_NAME);
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
                WriteDvpTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[WriteDvpTableMap::COL_DVP_REPORT_ID] = true;
        if (null !== $this->dvp_report_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WriteDvpTableMap::COL_DVP_REPORT_ID . ')');
        }
        if (null === $this->dvp_report_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('write_dvp_dvp_report_id_seq')");
                $this->dvp_report_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WriteDvpTableMap::COL_ORG_UNIT)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'employee_code';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_JOINING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'joining_date';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_AM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'am_position';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'rm_position';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_ZM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'zm_position';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'location';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'employee_name';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_DOCTOR_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'doctor_name';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_DOCTOR_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'doctor_code';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_TOWN)) {
            $modifiedColumns[':p' . $index++]  = 'town';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_PATCH)) {
            $modifiedColumns[':p' . $index++]  = 'patch';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_SPECIALITY)) {
            $modifiedColumns[':p' . $index++]  = 'speciality';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_TAGS)) {
            $modifiedColumns[':p' . $index++]  = 'tags';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_VISIT_FQ)) {
            $modifiedColumns[':p' . $index++]  = 'visit_fq';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION)) {
            $modifiedColumns[':p' . $index++]  = 'prescriber_classification';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_TOP_BRAND)) {
            $modifiedColumns[':p' . $index++]  = 'top_brand';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_VISIT_DR)) {
            $modifiedColumns[':p' . $index++]  = 'visit_dr';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_AM_VISIT_DR)) {
            $modifiedColumns[':p' . $index++]  = 'am_visit_dr';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RM_VISIT_DR)) {
            $modifiedColumns[':p' . $index++]  = 'rm_visit_dr';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_ZM_VISIT_DR)) {
            $modifiedColumns[':p' . $index++]  = 'zm_visit_dr';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_DONE)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_done';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_LM_OWN)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_lm_own';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_LM_COMP)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_lm_comp';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_CM_OWN)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_cm_own';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_CM_COMP)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_cm_comp';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_SAMPLES_SGPI)) {
            $modifiedColumns[':p' . $index++]  = 'samples_sgpi';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_GIFTS_SGPI)) {
            $modifiedColumns[':p' . $index++]  = 'gifts_sgpi';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_PROMO_SGPI)) {
            $modifiedColumns[':p' . $index++]  = 'promo_sgpi';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_ZM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'zm_position_code';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'rm_position_code';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_AM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'am_position_code';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'employee_position_code';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'employee_position';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'employee_level';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_MONTH)) {
            $modifiedColumns[':p' . $index++]  = 'month';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_DVP_REPORT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'dvp_report_id';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_MR_DETAILING)) {
            $modifiedColumns[':p' . $index++]  = 'mr_detailing';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO write_dvp (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'org_unit':
                        $stmt->bindValue($identifier, $this->org_unit, PDO::PARAM_STR);

                        break;
                    case 'employee_code':
                        $stmt->bindValue($identifier, $this->employee_code, PDO::PARAM_STR);

                        break;
                    case 'joining_date':
                        $stmt->bindValue($identifier, $this->joining_date, PDO::PARAM_STR);

                        break;
                    case 'am_position':
                        $stmt->bindValue($identifier, $this->am_position, PDO::PARAM_STR);

                        break;
                    case 'rm_position':
                        $stmt->bindValue($identifier, $this->rm_position, PDO::PARAM_STR);

                        break;
                    case 'zm_position':
                        $stmt->bindValue($identifier, $this->zm_position, PDO::PARAM_STR);

                        break;
                    case 'location':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'employee_name':
                        $stmt->bindValue($identifier, $this->employee_name, PDO::PARAM_STR);

                        break;
                    case 'doctor_name':
                        $stmt->bindValue($identifier, $this->doctor_name, PDO::PARAM_STR);

                        break;
                    case 'doctor_code':
                        $stmt->bindValue($identifier, $this->doctor_code, PDO::PARAM_STR);

                        break;
                    case 'town':
                        $stmt->bindValue($identifier, $this->town, PDO::PARAM_STR);

                        break;
                    case 'patch':
                        $stmt->bindValue($identifier, $this->patch, PDO::PARAM_STR);

                        break;
                    case 'speciality':
                        $stmt->bindValue($identifier, $this->speciality, PDO::PARAM_STR);

                        break;
                    case 'tags':
                        $stmt->bindValue($identifier, $this->tags, PDO::PARAM_STR);

                        break;
                    case 'visit_fq':
                        $stmt->bindValue($identifier, $this->visit_fq, PDO::PARAM_STR);

                        break;
                    case 'prescriber_classification':
                        $stmt->bindValue($identifier, $this->prescriber_classification, PDO::PARAM_STR);

                        break;
                    case 'top_brand':
                        $stmt->bindValue($identifier, $this->top_brand, PDO::PARAM_STR);

                        break;
                    case 'visit_dr':
                        $stmt->bindValue($identifier, $this->visit_dr, PDO::PARAM_STR);

                        break;
                    case 'am_visit_dr':
                        $stmt->bindValue($identifier, $this->am_visit_dr, PDO::PARAM_STR);

                        break;
                    case 'rm_visit_dr':
                        $stmt->bindValue($identifier, $this->rm_visit_dr, PDO::PARAM_STR);

                        break;
                    case 'zm_visit_dr':
                        $stmt->bindValue($identifier, $this->zm_visit_dr, PDO::PARAM_STR);

                        break;
                    case 'rcpa_done':
                        $stmt->bindValue($identifier, $this->rcpa_done, PDO::PARAM_STR);

                        break;
                    case 'rcpa_lm_own':
                        $stmt->bindValue($identifier, $this->rcpa_lm_own, PDO::PARAM_STR);

                        break;
                    case 'rcpa_lm_comp':
                        $stmt->bindValue($identifier, $this->rcpa_lm_comp, PDO::PARAM_STR);

                        break;
                    case 'rcpa_cm_own':
                        $stmt->bindValue($identifier, $this->rcpa_cm_own, PDO::PARAM_STR);

                        break;
                    case 'rcpa_cm_comp':
                        $stmt->bindValue($identifier, $this->rcpa_cm_comp, PDO::PARAM_STR);

                        break;
                    case 'samples_sgpi':
                        $stmt->bindValue($identifier, $this->samples_sgpi, PDO::PARAM_STR);

                        break;
                    case 'gifts_sgpi':
                        $stmt->bindValue($identifier, $this->gifts_sgpi, PDO::PARAM_STR);

                        break;
                    case 'promo_sgpi':
                        $stmt->bindValue($identifier, $this->promo_sgpi, PDO::PARAM_STR);

                        break;
                    case 'zm_position_code':
                        $stmt->bindValue($identifier, $this->zm_position_code, PDO::PARAM_STR);

                        break;
                    case 'rm_position_code':
                        $stmt->bindValue($identifier, $this->rm_position_code, PDO::PARAM_STR);

                        break;
                    case 'am_position_code':
                        $stmt->bindValue($identifier, $this->am_position_code, PDO::PARAM_STR);

                        break;
                    case 'employee_position_code':
                        $stmt->bindValue($identifier, $this->employee_position_code, PDO::PARAM_STR);

                        break;
                    case 'employee_position':
                        $stmt->bindValue($identifier, $this->employee_position, PDO::PARAM_STR);

                        break;
                    case 'employee_level':
                        $stmt->bindValue($identifier, $this->employee_level, PDO::PARAM_STR);

                        break;
                    case 'month':
                        $stmt->bindValue($identifier, $this->month, PDO::PARAM_STR);

                        break;
                    case 'dvp_report_id':
                        $stmt->bindValue($identifier, $this->dvp_report_id, PDO::PARAM_INT);

                        break;
                    case 'mr_detailing':
                        $stmt->bindValue($identifier, $this->mr_detailing, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
        $pos = WriteDvpTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOrgUnit();

            case 1:
                return $this->getEmployeeCode();

            case 2:
                return $this->getJoiningDate();

            case 3:
                return $this->getAmPosition();

            case 4:
                return $this->getRmPosition();

            case 5:
                return $this->getZmPosition();

            case 6:
                return $this->getLocation();

            case 7:
                return $this->getStatus();

            case 8:
                return $this->getEmployeeName();

            case 9:
                return $this->getDoctorName();

            case 10:
                return $this->getDoctorCode();

            case 11:
                return $this->getTown();

            case 12:
                return $this->getPatch();

            case 13:
                return $this->getSpeciality();

            case 14:
                return $this->getTags();

            case 15:
                return $this->getVisitFq();

            case 16:
                return $this->getPrescriberClassification();

            case 17:
                return $this->getTopBrand();

            case 18:
                return $this->getVisitDr();

            case 19:
                return $this->getAmVisitDr();

            case 20:
                return $this->getRmVisitDr();

            case 21:
                return $this->getZmVisitDr();

            case 22:
                return $this->getRcpaDone();

            case 23:
                return $this->getRcpaLmOwn();

            case 24:
                return $this->getRcpaLmComp();

            case 25:
                return $this->getRcpaCmOwn();

            case 26:
                return $this->getRcpaCmComp();

            case 27:
                return $this->getSamplesSgpi();

            case 28:
                return $this->getGiftsSgpi();

            case 29:
                return $this->getPromoSgpi();

            case 30:
                return $this->getZmPositionCode();

            case 31:
                return $this->getRmPositionCode();

            case 32:
                return $this->getAmPositionCode();

            case 33:
                return $this->getEmployeePositionCode();

            case 34:
                return $this->getEmployeePosition();

            case 35:
                return $this->getEmployeeLevel();

            case 36:
                return $this->getMonth();

            case 37:
                return $this->getDvpReportId();

            case 38:
                return $this->getMrDetailing();

            case 39:
                return $this->getCreatedAt();

            case 40:
                return $this->getUpdatedAt();

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
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = []): array
    {
        if (isset($alreadyDumpedObjects['WriteDvp'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['WriteDvp'][$this->hashCode()] = true;
        $keys = WriteDvpTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOrgUnit(),
            $keys[1] => $this->getEmployeeCode(),
            $keys[2] => $this->getJoiningDate(),
            $keys[3] => $this->getAmPosition(),
            $keys[4] => $this->getRmPosition(),
            $keys[5] => $this->getZmPosition(),
            $keys[6] => $this->getLocation(),
            $keys[7] => $this->getStatus(),
            $keys[8] => $this->getEmployeeName(),
            $keys[9] => $this->getDoctorName(),
            $keys[10] => $this->getDoctorCode(),
            $keys[11] => $this->getTown(),
            $keys[12] => $this->getPatch(),
            $keys[13] => $this->getSpeciality(),
            $keys[14] => $this->getTags(),
            $keys[15] => $this->getVisitFq(),
            $keys[16] => $this->getPrescriberClassification(),
            $keys[17] => $this->getTopBrand(),
            $keys[18] => $this->getVisitDr(),
            $keys[19] => $this->getAmVisitDr(),
            $keys[20] => $this->getRmVisitDr(),
            $keys[21] => $this->getZmVisitDr(),
            $keys[22] => $this->getRcpaDone(),
            $keys[23] => $this->getRcpaLmOwn(),
            $keys[24] => $this->getRcpaLmComp(),
            $keys[25] => $this->getRcpaCmOwn(),
            $keys[26] => $this->getRcpaCmComp(),
            $keys[27] => $this->getSamplesSgpi(),
            $keys[28] => $this->getGiftsSgpi(),
            $keys[29] => $this->getPromoSgpi(),
            $keys[30] => $this->getZmPositionCode(),
            $keys[31] => $this->getRmPositionCode(),
            $keys[32] => $this->getAmPositionCode(),
            $keys[33] => $this->getEmployeePositionCode(),
            $keys[34] => $this->getEmployeePosition(),
            $keys[35] => $this->getEmployeeLevel(),
            $keys[36] => $this->getMonth(),
            $keys[37] => $this->getDvpReportId(),
            $keys[38] => $this->getMrDetailing(),
            $keys[39] => $this->getCreatedAt(),
            $keys[40] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[39]] instanceof \DateTimeInterface) {
            $result[$keys[39]] = $result[$keys[39]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[40]] instanceof \DateTimeInterface) {
            $result[$keys[40]] = $result[$keys[40]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
        $pos = WriteDvpTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOrgUnit($value);
                break;
            case 1:
                $this->setEmployeeCode($value);
                break;
            case 2:
                $this->setJoiningDate($value);
                break;
            case 3:
                $this->setAmPosition($value);
                break;
            case 4:
                $this->setRmPosition($value);
                break;
            case 5:
                $this->setZmPosition($value);
                break;
            case 6:
                $this->setLocation($value);
                break;
            case 7:
                $this->setStatus($value);
                break;
            case 8:
                $this->setEmployeeName($value);
                break;
            case 9:
                $this->setDoctorName($value);
                break;
            case 10:
                $this->setDoctorCode($value);
                break;
            case 11:
                $this->setTown($value);
                break;
            case 12:
                $this->setPatch($value);
                break;
            case 13:
                $this->setSpeciality($value);
                break;
            case 14:
                $this->setTags($value);
                break;
            case 15:
                $this->setVisitFq($value);
                break;
            case 16:
                $this->setPrescriberClassification($value);
                break;
            case 17:
                $this->setTopBrand($value);
                break;
            case 18:
                $this->setVisitDr($value);
                break;
            case 19:
                $this->setAmVisitDr($value);
                break;
            case 20:
                $this->setRmVisitDr($value);
                break;
            case 21:
                $this->setZmVisitDr($value);
                break;
            case 22:
                $this->setRcpaDone($value);
                break;
            case 23:
                $this->setRcpaLmOwn($value);
                break;
            case 24:
                $this->setRcpaLmComp($value);
                break;
            case 25:
                $this->setRcpaCmOwn($value);
                break;
            case 26:
                $this->setRcpaCmComp($value);
                break;
            case 27:
                $this->setSamplesSgpi($value);
                break;
            case 28:
                $this->setGiftsSgpi($value);
                break;
            case 29:
                $this->setPromoSgpi($value);
                break;
            case 30:
                $this->setZmPositionCode($value);
                break;
            case 31:
                $this->setRmPositionCode($value);
                break;
            case 32:
                $this->setAmPositionCode($value);
                break;
            case 33:
                $this->setEmployeePositionCode($value);
                break;
            case 34:
                $this->setEmployeePosition($value);
                break;
            case 35:
                $this->setEmployeeLevel($value);
                break;
            case 36:
                $this->setMonth($value);
                break;
            case 37:
                $this->setDvpReportId($value);
                break;
            case 38:
                $this->setMrDetailing($value);
                break;
            case 39:
                $this->setCreatedAt($value);
                break;
            case 40:
                $this->setUpdatedAt($value);
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
        $keys = WriteDvpTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOrgUnit($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmployeeCode($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setJoiningDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAmPosition($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRmPosition($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setZmPosition($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLocation($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setStatus($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEmployeeName($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDoctorName($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDoctorCode($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTown($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPatch($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setSpeciality($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setTags($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setVisitFq($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPrescriberClassification($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setTopBrand($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setVisitDr($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setAmVisitDr($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setRmVisitDr($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setZmVisitDr($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setRcpaDone($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setRcpaLmOwn($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setRcpaLmComp($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setRcpaCmOwn($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setRcpaCmComp($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setSamplesSgpi($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setGiftsSgpi($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setPromoSgpi($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setZmPositionCode($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setRmPositionCode($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setAmPositionCode($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setEmployeePositionCode($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setEmployeePosition($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setEmployeeLevel($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setMonth($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setDvpReportId($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setMrDetailing($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setCreatedAt($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setUpdatedAt($arr[$keys[40]]);
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
        $criteria = new Criteria(WriteDvpTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WriteDvpTableMap::COL_ORG_UNIT)) {
            $criteria->add(WriteDvpTableMap::COL_ORG_UNIT, $this->org_unit);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(WriteDvpTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_JOINING_DATE)) {
            $criteria->add(WriteDvpTableMap::COL_JOINING_DATE, $this->joining_date);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_AM_POSITION)) {
            $criteria->add(WriteDvpTableMap::COL_AM_POSITION, $this->am_position);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RM_POSITION)) {
            $criteria->add(WriteDvpTableMap::COL_RM_POSITION, $this->rm_position);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_ZM_POSITION)) {
            $criteria->add(WriteDvpTableMap::COL_ZM_POSITION, $this->zm_position);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_LOCATION)) {
            $criteria->add(WriteDvpTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_STATUS)) {
            $criteria->add(WriteDvpTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_NAME)) {
            $criteria->add(WriteDvpTableMap::COL_EMPLOYEE_NAME, $this->employee_name);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_DOCTOR_NAME)) {
            $criteria->add(WriteDvpTableMap::COL_DOCTOR_NAME, $this->doctor_name);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_DOCTOR_CODE)) {
            $criteria->add(WriteDvpTableMap::COL_DOCTOR_CODE, $this->doctor_code);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_TOWN)) {
            $criteria->add(WriteDvpTableMap::COL_TOWN, $this->town);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_PATCH)) {
            $criteria->add(WriteDvpTableMap::COL_PATCH, $this->patch);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_SPECIALITY)) {
            $criteria->add(WriteDvpTableMap::COL_SPECIALITY, $this->speciality);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_TAGS)) {
            $criteria->add(WriteDvpTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_VISIT_FQ)) {
            $criteria->add(WriteDvpTableMap::COL_VISIT_FQ, $this->visit_fq);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION)) {
            $criteria->add(WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION, $this->prescriber_classification);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_TOP_BRAND)) {
            $criteria->add(WriteDvpTableMap::COL_TOP_BRAND, $this->top_brand);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_VISIT_DR)) {
            $criteria->add(WriteDvpTableMap::COL_VISIT_DR, $this->visit_dr);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_AM_VISIT_DR)) {
            $criteria->add(WriteDvpTableMap::COL_AM_VISIT_DR, $this->am_visit_dr);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RM_VISIT_DR)) {
            $criteria->add(WriteDvpTableMap::COL_RM_VISIT_DR, $this->rm_visit_dr);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_ZM_VISIT_DR)) {
            $criteria->add(WriteDvpTableMap::COL_ZM_VISIT_DR, $this->zm_visit_dr);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_DONE)) {
            $criteria->add(WriteDvpTableMap::COL_RCPA_DONE, $this->rcpa_done);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_LM_OWN)) {
            $criteria->add(WriteDvpTableMap::COL_RCPA_LM_OWN, $this->rcpa_lm_own);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_LM_COMP)) {
            $criteria->add(WriteDvpTableMap::COL_RCPA_LM_COMP, $this->rcpa_lm_comp);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_CM_OWN)) {
            $criteria->add(WriteDvpTableMap::COL_RCPA_CM_OWN, $this->rcpa_cm_own);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RCPA_CM_COMP)) {
            $criteria->add(WriteDvpTableMap::COL_RCPA_CM_COMP, $this->rcpa_cm_comp);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_SAMPLES_SGPI)) {
            $criteria->add(WriteDvpTableMap::COL_SAMPLES_SGPI, $this->samples_sgpi);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_GIFTS_SGPI)) {
            $criteria->add(WriteDvpTableMap::COL_GIFTS_SGPI, $this->gifts_sgpi);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_PROMO_SGPI)) {
            $criteria->add(WriteDvpTableMap::COL_PROMO_SGPI, $this->promo_sgpi);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_ZM_POSITION_CODE)) {
            $criteria->add(WriteDvpTableMap::COL_ZM_POSITION_CODE, $this->zm_position_code);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_RM_POSITION_CODE)) {
            $criteria->add(WriteDvpTableMap::COL_RM_POSITION_CODE, $this->rm_position_code);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_AM_POSITION_CODE)) {
            $criteria->add(WriteDvpTableMap::COL_AM_POSITION_CODE, $this->am_position_code);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE)) {
            $criteria->add(WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE, $this->employee_position_code);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_POSITION)) {
            $criteria->add(WriteDvpTableMap::COL_EMPLOYEE_POSITION, $this->employee_position);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_EMPLOYEE_LEVEL)) {
            $criteria->add(WriteDvpTableMap::COL_EMPLOYEE_LEVEL, $this->employee_level);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_MONTH)) {
            $criteria->add(WriteDvpTableMap::COL_MONTH, $this->month);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_DVP_REPORT_ID)) {
            $criteria->add(WriteDvpTableMap::COL_DVP_REPORT_ID, $this->dvp_report_id);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_MR_DETAILING)) {
            $criteria->add(WriteDvpTableMap::COL_MR_DETAILING, $this->mr_detailing);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_CREATED_AT)) {
            $criteria->add(WriteDvpTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(WriteDvpTableMap::COL_UPDATED_AT)) {
            $criteria->add(WriteDvpTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildWriteDvpQuery::create();
        $criteria->add(WriteDvpTableMap::COL_DVP_REPORT_ID, $this->dvp_report_id);

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
        $validPk = null !== $this->getDvpReportId();

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
        return $this->getDvpReportId();
    }

    /**
     * Generic method to set the primary key (dvp_report_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setDvpReportId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getDvpReportId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\WriteDvp (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOrgUnit($this->getOrgUnit());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setJoiningDate($this->getJoiningDate());
        $copyObj->setAmPosition($this->getAmPosition());
        $copyObj->setRmPosition($this->getRmPosition());
        $copyObj->setZmPosition($this->getZmPosition());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setEmployeeName($this->getEmployeeName());
        $copyObj->setDoctorName($this->getDoctorName());
        $copyObj->setDoctorCode($this->getDoctorCode());
        $copyObj->setTown($this->getTown());
        $copyObj->setPatch($this->getPatch());
        $copyObj->setSpeciality($this->getSpeciality());
        $copyObj->setTags($this->getTags());
        $copyObj->setVisitFq($this->getVisitFq());
        $copyObj->setPrescriberClassification($this->getPrescriberClassification());
        $copyObj->setTopBrand($this->getTopBrand());
        $copyObj->setVisitDr($this->getVisitDr());
        $copyObj->setAmVisitDr($this->getAmVisitDr());
        $copyObj->setRmVisitDr($this->getRmVisitDr());
        $copyObj->setZmVisitDr($this->getZmVisitDr());
        $copyObj->setRcpaDone($this->getRcpaDone());
        $copyObj->setRcpaLmOwn($this->getRcpaLmOwn());
        $copyObj->setRcpaLmComp($this->getRcpaLmComp());
        $copyObj->setRcpaCmOwn($this->getRcpaCmOwn());
        $copyObj->setRcpaCmComp($this->getRcpaCmComp());
        $copyObj->setSamplesSgpi($this->getSamplesSgpi());
        $copyObj->setGiftsSgpi($this->getGiftsSgpi());
        $copyObj->setPromoSgpi($this->getPromoSgpi());
        $copyObj->setZmPositionCode($this->getZmPositionCode());
        $copyObj->setRmPositionCode($this->getRmPositionCode());
        $copyObj->setAmPositionCode($this->getAmPositionCode());
        $copyObj->setEmployeePositionCode($this->getEmployeePositionCode());
        $copyObj->setEmployeePosition($this->getEmployeePosition());
        $copyObj->setEmployeeLevel($this->getEmployeeLevel());
        $copyObj->setMonth($this->getMonth());
        $copyObj->setMrDetailing($this->getMrDetailing());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setDvpReportId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\WriteDvp Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->org_unit = null;
        $this->employee_code = null;
        $this->joining_date = null;
        $this->am_position = null;
        $this->rm_position = null;
        $this->zm_position = null;
        $this->location = null;
        $this->status = null;
        $this->employee_name = null;
        $this->doctor_name = null;
        $this->doctor_code = null;
        $this->town = null;
        $this->patch = null;
        $this->speciality = null;
        $this->tags = null;
        $this->visit_fq = null;
        $this->prescriber_classification = null;
        $this->top_brand = null;
        $this->visit_dr = null;
        $this->am_visit_dr = null;
        $this->rm_visit_dr = null;
        $this->zm_visit_dr = null;
        $this->rcpa_done = null;
        $this->rcpa_lm_own = null;
        $this->rcpa_lm_comp = null;
        $this->rcpa_cm_own = null;
        $this->rcpa_cm_comp = null;
        $this->samples_sgpi = null;
        $this->gifts_sgpi = null;
        $this->promo_sgpi = null;
        $this->zm_position_code = null;
        $this->rm_position_code = null;
        $this->am_position_code = null;
        $this->employee_position_code = null;
        $this->employee_position = null;
        $this->employee_level = null;
        $this->month = null;
        $this->dvp_report_id = null;
        $this->mr_detailing = null;
        $this->created_at = null;
        $this->updated_at = null;
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
        } // if ($deep)

        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WriteDvpTableMap::DEFAULT_STRING_FORMAT);
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
