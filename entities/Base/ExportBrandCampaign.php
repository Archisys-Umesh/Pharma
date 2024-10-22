<?php

namespace entities\Base;

use \DateTime;
use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\ExportBrandCampaignQuery as ChildExportBrandCampaignQuery;
use entities\Map\ExportBrandCampaignTableMap;

/**
 * Base class that represents a row from the 'export_brand_campaign' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExportBrandCampaign implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExportBrandCampaignTableMap';


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
     * The value for the brand_campiagn_visit_id field.
     *
     * @var        int
     */
    protected $brand_campiagn_visit_id;

    /**
     * The value for the brand_campiagn_id field.
     *
     * @var        int|null
     */
    protected $brand_campiagn_id;

    /**
     * The value for the brand_campiagn_visit_plan_id field.
     *
     * @var        int|null
     */
    protected $brand_campiagn_visit_plan_id;

    /**
     * The value for the outlet_org_data_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_data_id;

    /**
     * The value for the dcr_id field.
     *
     * @var        int|null
     */
    protected $dcr_id;

    /**
     * The value for the bu_name field.
     *
     * @var        string|null
     */
    protected $bu_name;

    /**
     * The value for the zm_manager_branch field.
     *
     * @var        string|null
     */
    protected $zm_manager_branch;

    /**
     * The value for the zm_manager_town field.
     *
     * @var        string|null
     */
    protected $zm_manager_town;

    /**
     * The value for the rm_manager_branch field.
     *
     * @var        string|null
     */
    protected $rm_manager_branch;

    /**
     * The value for the rm_manager_town field.
     *
     * @var        string|null
     */
    protected $rm_manager_town;

    /**
     * The value for the am_manager_branch field.
     *
     * @var        string|null
     */
    protected $am_manager_branch;

    /**
     * The value for the am_manager_town field.
     *
     * @var        string|null
     */
    protected $am_manager_town;

    /**
     * The value for the emp_position_name field.
     *
     * @var        string|null
     */
    protected $emp_position_name;

    /**
     * The value for the emp_branch field.
     *
     * @var        string|null
     */
    protected $emp_branch;

    /**
     * The value for the emp_level field.
     *
     * @var        string|null
     */
    protected $emp_level;

    /**
     * The value for the employee_code field.
     *
     * @var        string|null
     */
    protected $employee_code;

    /**
     * The value for the employee_name field.
     *
     * @var        string|null
     */
    protected $employee_name;

    /**
     * The value for the ed_duration field.
     *
     * @var        int|null
     */
    protected $ed_duration;

    /**
     * The value for the campiagn_name field.
     *
     * @var        string|null
     */
    protected $campiagn_name;

    /**
     * The value for the focus_brands field.
     *
     * @var        string|null
     */
    protected $focus_brands;

    /**
     * The value for the focus_brand_ids field.
     *
     * @var        string|null
     */
    protected $focus_brand_ids;

    /**
     * The value for the campaign_start_date field.
     *
     * @var        DateTime|null
     */
    protected $campaign_start_date;

    /**
     * The value for the campaign_end_date field.
     *
     * @var        DateTime|null
     */
    protected $campaign_end_date;

    /**
     * The value for the outlet_tags field.
     *
     * @var        string|null
     */
    protected $outlet_tags;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the outlet_code field.
     *
     * @var        string|null
     */
    protected $outlet_code;

    /**
     * The value for the outlet_org_code field.
     *
     * @var        string|null
     */
    protected $outlet_org_code;

    /**
     * The value for the outlet_classification field.
     *
     * @var        string|null
     */
    protected $outlet_classification;

    /**
     * The value for the step_number field.
     *
     * @var        int|null
     */
    protected $step_number;

    /**
     * The value for the sgpi_to_be_given field.
     *
     * @var        string|null
     */
    protected $sgpi_to_be_given;

    /**
     * The value for the visited_date field.
     *
     * @var        DateTime|null
     */
    protected $visited_date;

    /**
     * The value for the visited_month field.
     *
     * @var        string|null
     */
    protected $visited_month;

    /**
     * The value for the sgpi_given field.
     *
     * @var        string|null
     */
    protected $sgpi_given;

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
     * The value for the emp_position_code field.
     *
     * @var        string|null
     */
    protected $emp_position_code;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\ExportBrandCampaign object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>ExportBrandCampaign</code> instance.  If
     * <code>obj</code> is an instance of <code>ExportBrandCampaign</code>, delegates to
     * <code>equals(ExportBrandCampaign)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [brand_campiagn_visit_id] column value.
     *
     * @return int
     */
    public function getBrandCampiagnVisitId()
    {
        return $this->brand_campiagn_visit_id;
    }

    /**
     * Get the [brand_campiagn_id] column value.
     *
     * @return int|null
     */
    public function getBrandCampiagnId()
    {
        return $this->brand_campiagn_id;
    }

    /**
     * Get the [brand_campiagn_visit_plan_id] column value.
     *
     * @return int|null
     */
    public function getBrandCampiagnVisitPlanId()
    {
        return $this->brand_campiagn_visit_plan_id;
    }

    /**
     * Get the [outlet_org_data_id] column value.
     *
     * @return int|null
     */
    public function getOutletOrgDataId()
    {
        return $this->outlet_org_data_id;
    }

    /**
     * Get the [dcr_id] column value.
     *
     * @return int|null
     */
    public function getDcrId()
    {
        return $this->dcr_id;
    }

    /**
     * Get the [bu_name] column value.
     *
     * @return string|null
     */
    public function getBuName()
    {
        return $this->bu_name;
    }

    /**
     * Get the [zm_manager_branch] column value.
     *
     * @return string|null
     */
    public function getZmManagerBranch()
    {
        return $this->zm_manager_branch;
    }

    /**
     * Get the [zm_manager_town] column value.
     *
     * @return string|null
     */
    public function getZmManagerTown()
    {
        return $this->zm_manager_town;
    }

    /**
     * Get the [rm_manager_branch] column value.
     *
     * @return string|null
     */
    public function getRmManagerBranch()
    {
        return $this->rm_manager_branch;
    }

    /**
     * Get the [rm_manager_town] column value.
     *
     * @return string|null
     */
    public function getRmManagerTown()
    {
        return $this->rm_manager_town;
    }

    /**
     * Get the [am_manager_branch] column value.
     *
     * @return string|null
     */
    public function getAmManagerBranch()
    {
        return $this->am_manager_branch;
    }

    /**
     * Get the [am_manager_town] column value.
     *
     * @return string|null
     */
    public function getAmManagerTown()
    {
        return $this->am_manager_town;
    }

    /**
     * Get the [emp_position_name] column value.
     *
     * @return string|null
     */
    public function getEmpPositionName()
    {
        return $this->emp_position_name;
    }

    /**
     * Get the [emp_branch] column value.
     *
     * @return string|null
     */
    public function getEmpBranch()
    {
        return $this->emp_branch;
    }

    /**
     * Get the [emp_level] column value.
     *
     * @return string|null
     */
    public function getEmpLevel()
    {
        return $this->emp_level;
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
     * Get the [employee_name] column value.
     *
     * @return string|null
     */
    public function getEmployeeName()
    {
        return $this->employee_name;
    }

    /**
     * Get the [ed_duration] column value.
     *
     * @return int|null
     */
    public function getEdDuration()
    {
        return $this->ed_duration;
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
     * Get the [focus_brands] column value.
     *
     * @return string|null
     */
    public function getFocusBrands()
    {
        return $this->focus_brands;
    }

    /**
     * Get the [focus_brand_ids] column value.
     *
     * @return string|null
     */
    public function getFocusBrandIds()
    {
        return $this->focus_brand_ids;
    }

    /**
     * Get the [optionally formatted] temporal [campaign_start_date] column value.
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
    public function getCampaignStartDate($format = null)
    {
        if ($format === null) {
            return $this->campaign_start_date;
        } else {
            return $this->campaign_start_date instanceof \DateTimeInterface ? $this->campaign_start_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [campaign_end_date] column value.
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
    public function getCampaignEndDate($format = null)
    {
        if ($format === null) {
            return $this->campaign_end_date;
        } else {
            return $this->campaign_end_date instanceof \DateTimeInterface ? $this->campaign_end_date->format($format) : null;
        }
    }

    /**
     * Get the [outlet_tags] column value.
     *
     * @return string|null
     */
    public function getOutletTags()
    {
        return $this->outlet_tags;
    }

    /**
     * Get the [outlet_name] column value.
     *
     * @return string|null
     */
    public function getOutletName()
    {
        return $this->outlet_name;
    }

    /**
     * Get the [outlet_code] column value.
     *
     * @return string|null
     */
    public function getOutletCode()
    {
        return $this->outlet_code;
    }

    /**
     * Get the [outlet_org_code] column value.
     *
     * @return string|null
     */
    public function getOutletOrgCode()
    {
        return $this->outlet_org_code;
    }

    /**
     * Get the [outlet_classification] column value.
     *
     * @return string|null
     */
    public function getOutletClassification()
    {
        return $this->outlet_classification;
    }

    /**
     * Get the [step_number] column value.
     *
     * @return int|null
     */
    public function getStepNumber()
    {
        return $this->step_number;
    }

    /**
     * Get the [sgpi_to_be_given] column value.
     *
     * @return string|null
     */
    public function getSgpiToBeGiven()
    {
        return $this->sgpi_to_be_given;
    }

    /**
     * Get the [optionally formatted] temporal [visited_date] column value.
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
    public function getVisitedDate($format = null)
    {
        if ($format === null) {
            return $this->visited_date;
        } else {
            return $this->visited_date instanceof \DateTimeInterface ? $this->visited_date->format($format) : null;
        }
    }

    /**
     * Get the [visited_month] column value.
     *
     * @return string|null
     */
    public function getVisitedMonth()
    {
        return $this->visited_month;
    }

    /**
     * Get the [sgpi_given] column value.
     *
     * @return string|null
     */
    public function getSgpiGiven()
    {
        return $this->sgpi_given;
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
     * Get the [emp_position_code] column value.
     *
     * @return string|null
     */
    public function getEmpPositionCode()
    {
        return $this->emp_position_code;
    }

    /**
     * Set the value of [brand_campiagn_visit_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandCampiagnVisitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_campiagn_visit_id !== $v) {
            $this->brand_campiagn_visit_id = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_campiagn_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandCampiagnId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_campiagn_id !== $v) {
            $this->brand_campiagn_id = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_campiagn_visit_plan_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandCampiagnVisitPlanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_campiagn_visit_plan_id !== $v) {
            $this->brand_campiagn_visit_plan_id = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_data_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletOrgDataId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_org_data_id !== $v) {
            $this->outlet_org_data_id = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dcr_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDcrId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dcr_id !== $v) {
            $this->dcr_id = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_DCR_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [bu_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBuName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bu_name !== $v) {
            $this->bu_name = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_BU_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_manager_branch !== $v) {
            $this->zm_manager_branch = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_manager_town !== $v) {
            $this->zm_manager_town = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_manager_branch !== $v) {
            $this->rm_manager_branch = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_manager_town !== $v) {
            $this->rm_manager_town = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_manager_branch !== $v) {
            $this->am_manager_branch = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_manager_town !== $v) {
            $this->am_manager_town = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpPositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_position_name !== $v) {
            $this->emp_position_name = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_branch !== $v) {
            $this->emp_branch = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_EMP_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_level] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_level !== $v) {
            $this->emp_level = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_EMP_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_code !== $v) {
            $this->employee_code = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_name !== $v) {
            $this->employee_name = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ed_duration] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEdDuration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ed_duration !== $v) {
            $this->ed_duration = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_ED_DURATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [campiagn_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCampiagnName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->campiagn_name !== $v) {
            $this->campiagn_name = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [focus_brands] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFocusBrands($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->focus_brands !== $v) {
            $this->focus_brands = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_FOCUS_BRANDS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [focus_brand_ids] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFocusBrandIds($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->focus_brand_ids !== $v) {
            $this->focus_brand_ids = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [campaign_start_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setCampaignStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->campaign_start_date !== null || $dt !== null) {
            if ($this->campaign_start_date === null || $dt === null || $dt->format("Y-m-d") !== $this->campaign_start_date->format("Y-m-d")) {
                $this->campaign_start_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [campaign_end_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setCampaignEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->campaign_end_date !== null || $dt !== null) {
            if ($this->campaign_end_date === null || $dt === null || $dt->format("Y-m-d") !== $this->campaign_end_date->format("Y-m-d")) {
                $this->campaign_end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [outlet_tags] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_tags !== $v) {
            $this->outlet_tags = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_OUTLET_TAGS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_name !== $v) {
            $this->outlet_name = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_code !== $v) {
            $this->outlet_code = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_OUTLET_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletOrgCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_org_code !== $v) {
            $this->outlet_org_code = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_classification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletClassification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_classification !== $v) {
            $this->outlet_classification = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [step_number] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setStepNumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->step_number !== $v) {
            $this->step_number = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_STEP_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_to_be_given] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiToBeGiven($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_to_be_given !== $v) {
            $this->sgpi_to_be_given = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [visited_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setVisitedDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->visited_date !== null || $dt !== null) {
            if ($this->visited_date === null || $dt === null || $dt->format("Y-m-d") !== $this->visited_date->format("Y-m-d")) {
                $this->visited_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportBrandCampaignTableMap::COL_VISITED_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [visited_month] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setVisitedMonth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visited_month !== $v) {
            $this->visited_month = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_VISITED_MONTH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_given] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiGiven($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_given !== $v) {
            $this->sgpi_given = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_SGPI_GIVEN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_position_code !== $v) {
            $this->zm_position_code = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_position_code !== $v) {
            $this->rm_position_code = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_RM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_position_code !== $v) {
            $this->am_position_code = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_AM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_position_code !== $v) {
            $this->emp_position_code = $v;
            $this->modifiedColumns[ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExportBrandCampaignTableMap::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_campiagn_visit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExportBrandCampaignTableMap::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_campiagn_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExportBrandCampaignTableMap::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_campiagn_visit_plan_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExportBrandCampaignTableMap::translateFieldName('OutletOrgDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_data_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExportBrandCampaignTableMap::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExportBrandCampaignTableMap::translateFieldName('BuName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bu_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExportBrandCampaignTableMap::translateFieldName('ZmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExportBrandCampaignTableMap::translateFieldName('ZmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExportBrandCampaignTableMap::translateFieldName('RmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExportBrandCampaignTableMap::translateFieldName('RmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExportBrandCampaignTableMap::translateFieldName('AmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExportBrandCampaignTableMap::translateFieldName('AmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExportBrandCampaignTableMap::translateFieldName('EmpPositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExportBrandCampaignTableMap::translateFieldName('EmpBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExportBrandCampaignTableMap::translateFieldName('EmpLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExportBrandCampaignTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExportBrandCampaignTableMap::translateFieldName('EmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExportBrandCampaignTableMap::translateFieldName('EdDuration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ed_duration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExportBrandCampaignTableMap::translateFieldName('CampiagnName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campiagn_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExportBrandCampaignTableMap::translateFieldName('FocusBrands', TableMap::TYPE_PHPNAME, $indexType)];
            $this->focus_brands = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExportBrandCampaignTableMap::translateFieldName('FocusBrandIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->focus_brand_ids = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExportBrandCampaignTableMap::translateFieldName('CampaignStartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campaign_start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExportBrandCampaignTableMap::translateFieldName('CampaignEndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campaign_end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExportBrandCampaignTableMap::translateFieldName('OutletTags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ExportBrandCampaignTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ExportBrandCampaignTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ExportBrandCampaignTableMap::translateFieldName('OutletOrgCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ExportBrandCampaignTableMap::translateFieldName('OutletClassification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_classification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ExportBrandCampaignTableMap::translateFieldName('StepNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->step_number = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ExportBrandCampaignTableMap::translateFieldName('SgpiToBeGiven', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_to_be_given = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ExportBrandCampaignTableMap::translateFieldName('VisitedDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visited_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : ExportBrandCampaignTableMap::translateFieldName('VisitedMonth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visited_month = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : ExportBrandCampaignTableMap::translateFieldName('SgpiGiven', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_given = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : ExportBrandCampaignTableMap::translateFieldName('ZmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : ExportBrandCampaignTableMap::translateFieldName('RmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : ExportBrandCampaignTableMap::translateFieldName('AmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : ExportBrandCampaignTableMap::translateFieldName('EmpPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_code = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 37; // 37 = ExportBrandCampaignTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExportBrandCampaign'), 0, $e);
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
        $pos = ExportBrandCampaignTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBrandCampiagnVisitId();

            case 1:
                return $this->getBrandCampiagnId();

            case 2:
                return $this->getBrandCampiagnVisitPlanId();

            case 3:
                return $this->getOutletOrgDataId();

            case 4:
                return $this->getDcrId();

            case 5:
                return $this->getBuName();

            case 6:
                return $this->getZmManagerBranch();

            case 7:
                return $this->getZmManagerTown();

            case 8:
                return $this->getRmManagerBranch();

            case 9:
                return $this->getRmManagerTown();

            case 10:
                return $this->getAmManagerBranch();

            case 11:
                return $this->getAmManagerTown();

            case 12:
                return $this->getEmpPositionName();

            case 13:
                return $this->getEmpBranch();

            case 14:
                return $this->getEmpLevel();

            case 15:
                return $this->getEmployeeCode();

            case 16:
                return $this->getEmployeeName();

            case 17:
                return $this->getEdDuration();

            case 18:
                return $this->getCampiagnName();

            case 19:
                return $this->getFocusBrands();

            case 20:
                return $this->getFocusBrandIds();

            case 21:
                return $this->getCampaignStartDate();

            case 22:
                return $this->getCampaignEndDate();

            case 23:
                return $this->getOutletTags();

            case 24:
                return $this->getOutletName();

            case 25:
                return $this->getOutletCode();

            case 26:
                return $this->getOutletOrgCode();

            case 27:
                return $this->getOutletClassification();

            case 28:
                return $this->getStepNumber();

            case 29:
                return $this->getSgpiToBeGiven();

            case 30:
                return $this->getVisitedDate();

            case 31:
                return $this->getVisitedMonth();

            case 32:
                return $this->getSgpiGiven();

            case 33:
                return $this->getZmPositionCode();

            case 34:
                return $this->getRmPositionCode();

            case 35:
                return $this->getAmPositionCode();

            case 36:
                return $this->getEmpPositionCode();

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
        if (isset($alreadyDumpedObjects['ExportBrandCampaign'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExportBrandCampaign'][$this->hashCode()] = true;
        $keys = ExportBrandCampaignTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBrandCampiagnVisitId(),
            $keys[1] => $this->getBrandCampiagnId(),
            $keys[2] => $this->getBrandCampiagnVisitPlanId(),
            $keys[3] => $this->getOutletOrgDataId(),
            $keys[4] => $this->getDcrId(),
            $keys[5] => $this->getBuName(),
            $keys[6] => $this->getZmManagerBranch(),
            $keys[7] => $this->getZmManagerTown(),
            $keys[8] => $this->getRmManagerBranch(),
            $keys[9] => $this->getRmManagerTown(),
            $keys[10] => $this->getAmManagerBranch(),
            $keys[11] => $this->getAmManagerTown(),
            $keys[12] => $this->getEmpPositionName(),
            $keys[13] => $this->getEmpBranch(),
            $keys[14] => $this->getEmpLevel(),
            $keys[15] => $this->getEmployeeCode(),
            $keys[16] => $this->getEmployeeName(),
            $keys[17] => $this->getEdDuration(),
            $keys[18] => $this->getCampiagnName(),
            $keys[19] => $this->getFocusBrands(),
            $keys[20] => $this->getFocusBrandIds(),
            $keys[21] => $this->getCampaignStartDate(),
            $keys[22] => $this->getCampaignEndDate(),
            $keys[23] => $this->getOutletTags(),
            $keys[24] => $this->getOutletName(),
            $keys[25] => $this->getOutletCode(),
            $keys[26] => $this->getOutletOrgCode(),
            $keys[27] => $this->getOutletClassification(),
            $keys[28] => $this->getStepNumber(),
            $keys[29] => $this->getSgpiToBeGiven(),
            $keys[30] => $this->getVisitedDate(),
            $keys[31] => $this->getVisitedMonth(),
            $keys[32] => $this->getSgpiGiven(),
            $keys[33] => $this->getZmPositionCode(),
            $keys[34] => $this->getRmPositionCode(),
            $keys[35] => $this->getAmPositionCode(),
            $keys[36] => $this->getEmpPositionCode(),
        ];
        if ($result[$keys[21]] instanceof \DateTimeInterface) {
            $result[$keys[21]] = $result[$keys[21]]->format('Y-m-d');
        }

        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('Y-m-d');
        }

        if ($result[$keys[30]] instanceof \DateTimeInterface) {
            $result[$keys[30]] = $result[$keys[30]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(ExportBrandCampaignTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $this->brand_campiagn_visit_id);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID, $this->brand_campiagn_id);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $this->brand_campiagn_visit_plan_id);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID, $this->outlet_org_data_id);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_DCR_ID)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_DCR_ID, $this->dcr_id);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_BU_NAME)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_BU_NAME, $this->bu_name);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH, $this->zm_manager_branch);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN, $this->zm_manager_town);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH, $this->rm_manager_branch);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN, $this->rm_manager_town);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH, $this->am_manager_branch);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN, $this->am_manager_town);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME, $this->emp_position_name);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_EMP_BRANCH)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_EMP_BRANCH, $this->emp_branch);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_EMP_LEVEL)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_EMP_LEVEL, $this->emp_level);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME, $this->employee_name);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_ED_DURATION)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_ED_DURATION, $this->ed_duration);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME, $this->campiagn_name);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_FOCUS_BRANDS)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_FOCUS_BRANDS, $this->focus_brands);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS, $this->focus_brand_ids);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE, $this->campaign_start_date);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE, $this->campaign_end_date);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_OUTLET_TAGS)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_OUTLET_TAGS, $this->outlet_tags);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_OUTLET_NAME)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_OUTLET_CODE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_OUTLET_CODE, $this->outlet_code);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE, $this->outlet_org_code);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION, $this->outlet_classification);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_STEP_NUMBER)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_STEP_NUMBER, $this->step_number);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN, $this->sgpi_to_be_given);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_VISITED_DATE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_VISITED_DATE, $this->visited_date);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_VISITED_MONTH)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_VISITED_MONTH, $this->visited_month);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_SGPI_GIVEN)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_SGPI_GIVEN, $this->sgpi_given);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE, $this->zm_position_code);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_RM_POSITION_CODE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_RM_POSITION_CODE, $this->rm_position_code);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_AM_POSITION_CODE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_AM_POSITION_CODE, $this->am_position_code);
        }
        if ($this->isColumnModified(ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE)) {
            $criteria->add(ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE, $this->emp_position_code);
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
        $criteria = ChildExportBrandCampaignQuery::create();
        $criteria->add(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $this->brand_campiagn_visit_id);

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
        $validPk = null !== $this->getBrandCampiagnVisitId();

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
        return $this->getBrandCampiagnVisitId();
    }

    /**
     * Generic method to set the primary key (brand_campiagn_visit_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setBrandCampiagnVisitId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getBrandCampiagnVisitId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\ExportBrandCampaign (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setBrandCampiagnVisitId($this->getBrandCampiagnVisitId());
        $copyObj->setBrandCampiagnId($this->getBrandCampiagnId());
        $copyObj->setBrandCampiagnVisitPlanId($this->getBrandCampiagnVisitPlanId());
        $copyObj->setOutletOrgDataId($this->getOutletOrgDataId());
        $copyObj->setDcrId($this->getDcrId());
        $copyObj->setBuName($this->getBuName());
        $copyObj->setZmManagerBranch($this->getZmManagerBranch());
        $copyObj->setZmManagerTown($this->getZmManagerTown());
        $copyObj->setRmManagerBranch($this->getRmManagerBranch());
        $copyObj->setRmManagerTown($this->getRmManagerTown());
        $copyObj->setAmManagerBranch($this->getAmManagerBranch());
        $copyObj->setAmManagerTown($this->getAmManagerTown());
        $copyObj->setEmpPositionName($this->getEmpPositionName());
        $copyObj->setEmpBranch($this->getEmpBranch());
        $copyObj->setEmpLevel($this->getEmpLevel());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setEmployeeName($this->getEmployeeName());
        $copyObj->setEdDuration($this->getEdDuration());
        $copyObj->setCampiagnName($this->getCampiagnName());
        $copyObj->setFocusBrands($this->getFocusBrands());
        $copyObj->setFocusBrandIds($this->getFocusBrandIds());
        $copyObj->setCampaignStartDate($this->getCampaignStartDate());
        $copyObj->setCampaignEndDate($this->getCampaignEndDate());
        $copyObj->setOutletTags($this->getOutletTags());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setOutletCode($this->getOutletCode());
        $copyObj->setOutletOrgCode($this->getOutletOrgCode());
        $copyObj->setOutletClassification($this->getOutletClassification());
        $copyObj->setStepNumber($this->getStepNumber());
        $copyObj->setSgpiToBeGiven($this->getSgpiToBeGiven());
        $copyObj->setVisitedDate($this->getVisitedDate());
        $copyObj->setVisitedMonth($this->getVisitedMonth());
        $copyObj->setSgpiGiven($this->getSgpiGiven());
        $copyObj->setZmPositionCode($this->getZmPositionCode());
        $copyObj->setRmPositionCode($this->getRmPositionCode());
        $copyObj->setAmPositionCode($this->getAmPositionCode());
        $copyObj->setEmpPositionCode($this->getEmpPositionCode());
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
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \entities\ExportBrandCampaign Clone of current object.
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
        $this->brand_campiagn_visit_id = null;
        $this->brand_campiagn_id = null;
        $this->brand_campiagn_visit_plan_id = null;
        $this->outlet_org_data_id = null;
        $this->dcr_id = null;
        $this->bu_name = null;
        $this->zm_manager_branch = null;
        $this->zm_manager_town = null;
        $this->rm_manager_branch = null;
        $this->rm_manager_town = null;
        $this->am_manager_branch = null;
        $this->am_manager_town = null;
        $this->emp_position_name = null;
        $this->emp_branch = null;
        $this->emp_level = null;
        $this->employee_code = null;
        $this->employee_name = null;
        $this->ed_duration = null;
        $this->campiagn_name = null;
        $this->focus_brands = null;
        $this->focus_brand_ids = null;
        $this->campaign_start_date = null;
        $this->campaign_end_date = null;
        $this->outlet_tags = null;
        $this->outlet_name = null;
        $this->outlet_code = null;
        $this->outlet_org_code = null;
        $this->outlet_classification = null;
        $this->step_number = null;
        $this->sgpi_to_be_given = null;
        $this->visited_date = null;
        $this->visited_month = null;
        $this->sgpi_given = null;
        $this->zm_position_code = null;
        $this->rm_position_code = null;
        $this->am_position_code = null;
        $this->emp_position_code = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
        return (string) $this->exportTo(ExportBrandCampaignTableMap::DEFAULT_STRING_FORMAT);
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
