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
use entities\Agendatypes as ChildAgendatypes;
use entities\AgendatypesQuery as ChildAgendatypesQuery;
use entities\BrandCampiagn as ChildBrandCampiagn;
use entities\BrandCampiagnQuery as ChildBrandCampiagnQuery;
use entities\BrandCampiagnVisitPlan as ChildBrandCampiagnVisitPlan;
use entities\BrandCampiagnVisitPlanQuery as ChildBrandCampiagnVisitPlanQuery;
use entities\BrandCampiagnVisits as ChildBrandCampiagnVisits;
use entities\BrandCampiagnVisitsQuery as ChildBrandCampiagnVisitsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\DailycallsAttendees as ChildDailycallsAttendees;
use entities\DailycallsAttendeesQuery as ChildDailycallsAttendeesQuery;
use entities\Dayplan as ChildDayplan;
use entities\DayplanQuery as ChildDayplanQuery;
use entities\Survey as ChildSurvey;
use entities\SurveyQuery as ChildSurveyQuery;
use entities\SurveySubmited as ChildSurveySubmited;
use entities\SurveySubmitedQuery as ChildSurveySubmitedQuery;
use entities\Tourplans as ChildTourplans;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\BrandCampiagnVisitPlanTableMap;
use entities\Map\BrandCampiagnVisitsTableMap;
use entities\Map\DailycallsAttendeesTableMap;
use entities\Map\DayplanTableMap;
use entities\Map\SurveySubmitedTableMap;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a row from the 'brand_campiagn_visit_plan' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class BrandCampiagnVisitPlan implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\BrandCampiagnVisitPlanTableMap';


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
     * The value for the brand_campiagn_visit_plan_id field.
     *
     * @var        int
     */
    protected $brand_campiagn_visit_plan_id;

    /**
     * The value for the brand_campiagn_id field.
     *
     * @var        int|null
     */
    protected $brand_campiagn_id;

    /**
     * The value for the visit_plan_order field.
     *
     * @var        string|null
     */
    protected $visit_plan_order;

    /**
     * The value for the description field.
     *
     * @var        string|null
     */
    protected $description;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the sgpi_id field.
     *
     * @var        string|null
     */
    protected $sgpi_id;

    /**
     * The value for the created_at field.
     *
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
     * The value for the step_name field.
     *
     * @var        string|null
     */
    protected $step_name;

    /**
     * The value for the step_level field.
     *
     * @var        int|null
     */
    protected $step_level;

    /**
     * The value for the moye field.
     *
     * @var        string|null
     */
    protected $moye;

    /**
     * The value for the sgpi_status field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $sgpi_status;

    /**
     * The value for the qty field.
     *
     * @var        int|null
     */
    protected $qty;

    /**
     * The value for the comment field.
     *
     * @var        string|null
     */
    protected $comment;

    /**
     * The value for the agenda_type field.
     *
     * @var        string|null
     */
    protected $agenda_type;

    /**
     * The value for the agenda_sub_type_id field.
     *
     * @var        int|null
     */
    protected $agenda_sub_type_id;

    /**
     * The value for the create_survey field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $create_survey;

    /**
     * The value for the survey_id field.
     *
     * @var        int|null
     */
    protected $survey_id;

    /**
     * @var        ChildBrandCampiagn
     */
    protected $aBrandCampiagn;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildAgendatypes
     */
    protected $aAgendatypes;

    /**
     * @var        ChildSurvey
     */
    protected $aSurvey;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnVisits[] Collection to store aggregation of ChildBrandCampiagnVisits objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisits> Collection to store aggregation of ChildBrandCampiagnVisits objects.
     */
    protected $collBrandCampiagnVisitss;
    protected $collBrandCampiagnVisitssPartial;

    /**
     * @var        ObjectCollection|ChildDailycallsAttendees[] Collection to store aggregation of ChildDailycallsAttendees objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsAttendees> Collection to store aggregation of ChildDailycallsAttendees objects.
     */
    protected $collDailycallsAttendeess;
    protected $collDailycallsAttendeessPartial;

    /**
     * @var        ObjectCollection|ChildDayplan[] Collection to store aggregation of ChildDayplan objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan> Collection to store aggregation of ChildDayplan objects.
     */
    protected $collDayplans;
    protected $collDayplansPartial;

    /**
     * @var        ObjectCollection|ChildSurveySubmited[] Collection to store aggregation of ChildSurveySubmited objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmited> Collection to store aggregation of ChildSurveySubmited objects.
     */
    protected $collSurveySubmiteds;
    protected $collSurveySubmitedsPartial;

    /**
     * @var        ObjectCollection|ChildTourplans[] Collection to store aggregation of ChildTourplans objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans> Collection to store aggregation of ChildTourplans objects.
     */
    protected $collTourplanss;
    protected $collTourplanssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnVisits[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisits>
     */
    protected $brandCampiagnVisitssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycallsAttendees[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsAttendees>
     */
    protected $dailycallsAttendeessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDayplan[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan>
     */
    protected $dayplansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSurveySubmited[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmited>
     */
    protected $surveySubmitedsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTourplans[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans>
     */
    protected $tourplanssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->sgpi_status = false;
        $this->create_survey = false;
    }

    /**
     * Initializes internal state of entities\Base\BrandCampiagnVisitPlan object.
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
     * Compares this with another <code>BrandCampiagnVisitPlan</code> instance.  If
     * <code>obj</code> is an instance of <code>BrandCampiagnVisitPlan</code>, delegates to
     * <code>equals(BrandCampiagnVisitPlan)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [brand_campiagn_visit_plan_id] column value.
     *
     * @return int
     */
    public function getBrandCampiagnVisitPlanId()
    {
        return $this->brand_campiagn_visit_plan_id;
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
     * Get the [visit_plan_order] column value.
     *
     * @return string|null
     */
    public function getVisitPlanOrder()
    {
        return $this->visit_plan_order;
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
     * Get the [company_id] column value.
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [sgpi_id] column value.
     *
     * @return string|null
     */
    public function getSgpiId()
    {
        return $this->sgpi_id;
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
     * Get the [step_name] column value.
     *
     * @return string|null
     */
    public function getStepName()
    {
        return $this->step_name;
    }

    /**
     * Get the [step_level] column value.
     *
     * @return int|null
     */
    public function getStepLevel()
    {
        return $this->step_level;
    }

    /**
     * Get the [moye] column value.
     *
     * @return string|null
     */
    public function getMoye()
    {
        return $this->moye;
    }

    /**
     * Get the [sgpi_status] column value.
     *
     * @return boolean|null
     */
    public function getSgpiStatus()
    {
        return $this->sgpi_status;
    }

    /**
     * Get the [sgpi_status] column value.
     *
     * @return boolean|null
     */
    public function isSgpiStatus()
    {
        return $this->getSgpiStatus();
    }

    /**
     * Get the [qty] column value.
     *
     * @return int|null
     */
    public function getQty()
    {
        return $this->qty;
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
     * Get the [agenda_type] column value.
     *
     * @return string|null
     */
    public function getAgendaType()
    {
        return $this->agenda_type;
    }

    /**
     * Get the [agenda_sub_type_id] column value.
     *
     * @return int|null
     */
    public function getAgendaSubTypeId()
    {
        return $this->agenda_sub_type_id;
    }

    /**
     * Get the [create_survey] column value.
     *
     * @return boolean|null
     */
    public function getCreateSurvey()
    {
        return $this->create_survey;
    }

    /**
     * Get the [create_survey] column value.
     *
     * @return boolean|null
     */
    public function isCreateSurvey()
    {
        return $this->getCreateSurvey();
    }

    /**
     * Get the [survey_id] column value.
     *
     * @return int|null
     */
    public function getSurveyId()
    {
        return $this->survey_id;
    }

    /**
     * Set the value of [brand_campiagn_visit_plan_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnVisitPlanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_campiagn_visit_plan_id !== $v) {
            $this->brand_campiagn_visit_plan_id = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_campiagn_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_campiagn_id !== $v) {
            $this->brand_campiagn_id = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID] = true;
        }

        if ($this->aBrandCampiagn !== null && $this->aBrandCampiagn->getBrandCampiagnId() !== $v) {
            $this->aBrandCampiagn = null;
        }

        return $this;
    }

    /**
     * Set the value of [visit_plan_order] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVisitPlanOrder($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visit_plan_order !== $v) {
            $this->visit_plan_order = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER] = true;
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
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION] = true;
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
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_id !== $v) {
            $this->sgpi_id = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_SGPI_ID] = true;
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
                $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [step_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStepName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->step_name !== $v) {
            $this->step_name = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_STEP_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [step_level] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStepLevel($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->step_level !== $v) {
            $this->step_level = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [moye] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMoye($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->moye !== $v) {
            $this->moye = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_MOYE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [sgpi_status] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiStatus($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->sgpi_status !== $v) {
            $this->sgpi_status = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [qty] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qty !== $v) {
            $this->qty = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_QTY] = true;
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
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_COMMENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agenda_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgendaType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->agenda_type !== $v) {
            $this->agenda_type = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agenda_sub_type_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgendaSubTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->agenda_sub_type_id !== $v) {
            $this->agenda_sub_type_id = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID] = true;
        }

        if ($this->aAgendatypes !== null && $this->aAgendatypes->getAgendaid() !== $v) {
            $this->aAgendatypes = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [create_survey] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setCreateSurvey($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->create_survey !== $v) {
            $this->create_survey = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [survey_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSurveyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->survey_id !== $v) {
            $this->survey_id = $v;
            $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID] = true;
        }

        if ($this->aSurvey !== null && $this->aSurvey->getSurveyId() !== $v) {
            $this->aSurvey = null;
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
            if ($this->sgpi_status !== false) {
                return false;
            }

            if ($this->create_survey !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_campiagn_visit_plan_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_campiagn_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('VisitPlanOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_plan_order = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('StepName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->step_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('StepLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->step_level = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('Moye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('SgpiStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_status = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('Qty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('AgendaType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agenda_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('AgendaSubTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agenda_sub_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('CreateSurvey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->create_survey = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : BrandCampiagnVisitPlanTableMap::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->survey_id = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = BrandCampiagnVisitPlanTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\BrandCampiagnVisitPlan'), 0, $e);
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
        if ($this->aBrandCampiagn !== null && $this->brand_campiagn_id !== $this->aBrandCampiagn->getBrandCampiagnId()) {
            $this->aBrandCampiagn = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aAgendatypes !== null && $this->agenda_sub_type_id !== $this->aAgendatypes->getAgendaid()) {
            $this->aAgendatypes = null;
        }
        if ($this->aSurvey !== null && $this->survey_id !== $this->aSurvey->getSurveyId()) {
            $this->aSurvey = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBrandCampiagnVisitPlanQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBrandCampiagn = null;
            $this->aCompany = null;
            $this->aAgendatypes = null;
            $this->aSurvey = null;
            $this->collBrandCampiagnVisitss = null;

            $this->collDailycallsAttendeess = null;

            $this->collDayplans = null;

            $this->collSurveySubmiteds = null;

            $this->collTourplanss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see BrandCampiagnVisitPlan::setDeleted()
     * @see BrandCampiagnVisitPlan::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBrandCampiagnVisitPlanQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
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
                BrandCampiagnVisitPlanTableMap::addInstanceToPool($this);
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

            if ($this->aBrandCampiagn !== null) {
                if ($this->aBrandCampiagn->isModified() || $this->aBrandCampiagn->isNew()) {
                    $affectedRows += $this->aBrandCampiagn->save($con);
                }
                $this->setBrandCampiagn($this->aBrandCampiagn);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aAgendatypes !== null) {
                if ($this->aAgendatypes->isModified() || $this->aAgendatypes->isNew()) {
                    $affectedRows += $this->aAgendatypes->save($con);
                }
                $this->setAgendatypes($this->aAgendatypes);
            }

            if ($this->aSurvey !== null) {
                if ($this->aSurvey->isModified() || $this->aSurvey->isNew()) {
                    $affectedRows += $this->aSurvey->save($con);
                }
                $this->setSurvey($this->aSurvey);
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

            if ($this->dailycallsAttendeessScheduledForDeletion !== null) {
                if (!$this->dailycallsAttendeessScheduledForDeletion->isEmpty()) {
                    foreach ($this->dailycallsAttendeessScheduledForDeletion as $dailycallsAttendees) {
                        // need to save related object because we set the relation to null
                        $dailycallsAttendees->save($con);
                    }
                    $this->dailycallsAttendeessScheduledForDeletion = null;
                }
            }

            if ($this->collDailycallsAttendeess !== null) {
                foreach ($this->collDailycallsAttendeess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dayplansScheduledForDeletion !== null) {
                if (!$this->dayplansScheduledForDeletion->isEmpty()) {
                    foreach ($this->dayplansScheduledForDeletion as $dayplan) {
                        // need to save related object because we set the relation to null
                        $dayplan->save($con);
                    }
                    $this->dayplansScheduledForDeletion = null;
                }
            }

            if ($this->collDayplans !== null) {
                foreach ($this->collDayplans as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->surveySubmitedsScheduledForDeletion !== null) {
                if (!$this->surveySubmitedsScheduledForDeletion->isEmpty()) {
                    foreach ($this->surveySubmitedsScheduledForDeletion as $surveySubmited) {
                        // need to save related object because we set the relation to null
                        $surveySubmited->save($con);
                    }
                    $this->surveySubmitedsScheduledForDeletion = null;
                }
            }

            if ($this->collSurveySubmiteds !== null) {
                foreach ($this->collSurveySubmiteds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tourplanssScheduledForDeletion !== null) {
                if (!$this->tourplanssScheduledForDeletion->isEmpty()) {
                    foreach ($this->tourplanssScheduledForDeletion as $tourplans) {
                        // need to save related object because we set the relation to null
                        $tourplans->save($con);
                    }
                    $this->tourplanssScheduledForDeletion = null;
                }
            }

            if ($this->collTourplanss !== null) {
                foreach ($this->collTourplanss as $referrerFK) {
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

        $this->modifiedColumns[BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID] = true;
        if (null !== $this->brand_campiagn_visit_plan_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID . ')');
        }
        if (null === $this->brand_campiagn_visit_plan_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('brand_campiagn_visit_plan_brand_campiagn_visit_plan_id_seq')");
                $this->brand_campiagn_visit_plan_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_campiagn_visit_plan_id';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_campiagn_id';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'visit_plan_order';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_SGPI_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_id';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_STEP_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'step_name';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'step_level';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_MOYE)) {
            $modifiedColumns[':p' . $index++]  = 'moye';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_status';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'qty';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'comment';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'agenda_type';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'agenda_sub_type_id';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY)) {
            $modifiedColumns[':p' . $index++]  = 'create_survey';
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'survey_id';
        }

        $sql = sprintf(
            'INSERT INTO brand_campiagn_visit_plan (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'brand_campiagn_visit_plan_id':
                        $stmt->bindValue($identifier, $this->brand_campiagn_visit_plan_id, PDO::PARAM_INT);

                        break;
                    case 'brand_campiagn_id':
                        $stmt->bindValue($identifier, $this->brand_campiagn_id, PDO::PARAM_INT);

                        break;
                    case 'visit_plan_order':
                        $stmt->bindValue($identifier, $this->visit_plan_order, PDO::PARAM_STR);

                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'sgpi_id':
                        $stmt->bindValue($identifier, $this->sgpi_id, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'step_name':
                        $stmt->bindValue($identifier, $this->step_name, PDO::PARAM_STR);

                        break;
                    case 'step_level':
                        $stmt->bindValue($identifier, $this->step_level, PDO::PARAM_INT);

                        break;
                    case 'moye':
                        $stmt->bindValue($identifier, $this->moye, PDO::PARAM_STR);

                        break;
                    case 'sgpi_status':
                        $stmt->bindValue($identifier, $this->sgpi_status, PDO::PARAM_BOOL);

                        break;
                    case 'qty':
                        $stmt->bindValue($identifier, $this->qty, PDO::PARAM_INT);

                        break;
                    case 'comment':
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);

                        break;
                    case 'agenda_type':
                        $stmt->bindValue($identifier, $this->agenda_type, PDO::PARAM_STR);

                        break;
                    case 'agenda_sub_type_id':
                        $stmt->bindValue($identifier, $this->agenda_sub_type_id, PDO::PARAM_INT);

                        break;
                    case 'create_survey':
                        $stmt->bindValue($identifier, $this->create_survey, PDO::PARAM_BOOL);

                        break;
                    case 'survey_id':
                        $stmt->bindValue($identifier, $this->survey_id, PDO::PARAM_INT);

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
        $pos = BrandCampiagnVisitPlanTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBrandCampiagnVisitPlanId();

            case 1:
                return $this->getBrandCampiagnId();

            case 2:
                return $this->getVisitPlanOrder();

            case 3:
                return $this->getDescription();

            case 4:
                return $this->getCompanyId();

            case 5:
                return $this->getSgpiId();

            case 6:
                return $this->getCreatedAt();

            case 7:
                return $this->getUpdatedAt();

            case 8:
                return $this->getStepName();

            case 9:
                return $this->getStepLevel();

            case 10:
                return $this->getMoye();

            case 11:
                return $this->getSgpiStatus();

            case 12:
                return $this->getQty();

            case 13:
                return $this->getComment();

            case 14:
                return $this->getAgendaType();

            case 15:
                return $this->getAgendaSubTypeId();

            case 16:
                return $this->getCreateSurvey();

            case 17:
                return $this->getSurveyId();

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
        if (isset($alreadyDumpedObjects['BrandCampiagnVisitPlan'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['BrandCampiagnVisitPlan'][$this->hashCode()] = true;
        $keys = BrandCampiagnVisitPlanTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBrandCampiagnVisitPlanId(),
            $keys[1] => $this->getBrandCampiagnId(),
            $keys[2] => $this->getVisitPlanOrder(),
            $keys[3] => $this->getDescription(),
            $keys[4] => $this->getCompanyId(),
            $keys[5] => $this->getSgpiId(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedAt(),
            $keys[8] => $this->getStepName(),
            $keys[9] => $this->getStepLevel(),
            $keys[10] => $this->getMoye(),
            $keys[11] => $this->getSgpiStatus(),
            $keys[12] => $this->getQty(),
            $keys[13] => $this->getComment(),
            $keys[14] => $this->getAgendaType(),
            $keys[15] => $this->getAgendaSubTypeId(),
            $keys[16] => $this->getCreateSurvey(),
            $keys[17] => $this->getSurveyId(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBrandCampiagn) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagn';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn';
                        break;
                    default:
                        $key = 'BrandCampiagn';
                }

                $result[$key] = $this->aBrandCampiagn->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aAgendatypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'agendatypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'agendatypes';
                        break;
                    default:
                        $key = 'Agendatypes';
                }

                $result[$key] = $this->aAgendatypes->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSurvey) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'survey';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'survey';
                        break;
                    default:
                        $key = 'Survey';
                }

                $result[$key] = $this->aSurvey->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collDailycallsAttendeess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dailycallsAttendeess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dailycalls_attendeess';
                        break;
                    default:
                        $key = 'DailycallsAttendeess';
                }

                $result[$key] = $this->collDailycallsAttendeess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDayplans) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dayplans';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dayplans';
                        break;
                    default:
                        $key = 'Dayplans';
                }

                $result[$key] = $this->collDayplans->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSurveySubmiteds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveySubmiteds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'survey_submiteds';
                        break;
                    default:
                        $key = 'SurveySubmiteds';
                }

                $result[$key] = $this->collSurveySubmiteds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTourplanss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tourplanss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tourplanss';
                        break;
                    default:
                        $key = 'Tourplanss';
                }

                $result[$key] = $this->collTourplanss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BrandCampiagnVisitPlanTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setBrandCampiagnVisitPlanId($value);
                break;
            case 1:
                $this->setBrandCampiagnId($value);
                break;
            case 2:
                $this->setVisitPlanOrder($value);
                break;
            case 3:
                $this->setDescription($value);
                break;
            case 4:
                $this->setCompanyId($value);
                break;
            case 5:
                $this->setSgpiId($value);
                break;
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
                $this->setUpdatedAt($value);
                break;
            case 8:
                $this->setStepName($value);
                break;
            case 9:
                $this->setStepLevel($value);
                break;
            case 10:
                $this->setMoye($value);
                break;
            case 11:
                $this->setSgpiStatus($value);
                break;
            case 12:
                $this->setQty($value);
                break;
            case 13:
                $this->setComment($value);
                break;
            case 14:
                $this->setAgendaType($value);
                break;
            case 15:
                $this->setAgendaSubTypeId($value);
                break;
            case 16:
                $this->setCreateSurvey($value);
                break;
            case 17:
                $this->setSurveyId($value);
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
        $keys = BrandCampiagnVisitPlanTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBrandCampiagnVisitPlanId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBrandCampiagnId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setVisitPlanOrder($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDescription($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCompanyId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSgpiId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCreatedAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUpdatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setStepName($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setStepLevel($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setMoye($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setSgpiStatus($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setQty($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setComment($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setAgendaType($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setAgendaSubTypeId($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCreateSurvey($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setSurveyId($arr[$keys[17]]);
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
        $criteria = new Criteria(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $this->brand_campiagn_visit_plan_id);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID, $this->brand_campiagn_id);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER, $this->visit_plan_order);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_SGPI_ID)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_SGPI_ID, $this->sgpi_id);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_CREATED_AT)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_STEP_NAME)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_STEP_NAME, $this->step_name);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL, $this->step_level);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_MOYE)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_MOYE, $this->moye);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS, $this->sgpi_status);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_QTY)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_QTY, $this->qty);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_COMMENT)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_COMMENT, $this->comment);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE, $this->agenda_type);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID, $this->agenda_sub_type_id);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY, $this->create_survey);
        }
        if ($this->isColumnModified(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID)) {
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID, $this->survey_id);
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
        $criteria = ChildBrandCampiagnVisitPlanQuery::create();
        $criteria->add(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $this->brand_campiagn_visit_plan_id);

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
        $validPk = null !== $this->getBrandCampiagnVisitPlanId();

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
        return $this->getBrandCampiagnVisitPlanId();
    }

    /**
     * Generic method to set the primary key (brand_campiagn_visit_plan_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setBrandCampiagnVisitPlanId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getBrandCampiagnVisitPlanId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\BrandCampiagnVisitPlan (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setBrandCampiagnId($this->getBrandCampiagnId());
        $copyObj->setVisitPlanOrder($this->getVisitPlanOrder());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setSgpiId($this->getSgpiId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setStepName($this->getStepName());
        $copyObj->setStepLevel($this->getStepLevel());
        $copyObj->setMoye($this->getMoye());
        $copyObj->setSgpiStatus($this->getSgpiStatus());
        $copyObj->setQty($this->getQty());
        $copyObj->setComment($this->getComment());
        $copyObj->setAgendaType($this->getAgendaType());
        $copyObj->setAgendaSubTypeId($this->getAgendaSubTypeId());
        $copyObj->setCreateSurvey($this->getCreateSurvey());
        $copyObj->setSurveyId($this->getSurveyId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagnVisitss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnVisits($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallsAttendeess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycallsAttendees($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDayplans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDayplan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSurveySubmiteds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSurveySubmited($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTourplanss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTourplans($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBrandCampiagnVisitPlanId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\BrandCampiagnVisitPlan Clone of current object.
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
     * Declares an association between this object and a ChildBrandCampiagn object.
     *
     * @param ChildBrandCampiagn|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBrandCampiagn(ChildBrandCampiagn $v = null)
    {
        if ($v === null) {
            $this->setBrandCampiagnId(NULL);
        } else {
            $this->setBrandCampiagnId($v->getBrandCampiagnId());
        }

        $this->aBrandCampiagn = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrandCampiagn object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandCampiagnVisitPlan($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBrandCampiagn object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBrandCampiagn|null The associated ChildBrandCampiagn object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagn(?ConnectionInterface $con = null)
    {
        if ($this->aBrandCampiagn === null && ($this->brand_campiagn_id != 0)) {
            $this->aBrandCampiagn = ChildBrandCampiagnQuery::create()->findPk($this->brand_campiagn_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrandCampiagn->addBrandCampiagnVisitPlans($this);
             */
        }

        return $this->aBrandCampiagn;
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
            $v->addBrandCampiagnVisitPlan($this);
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
                $this->aCompany->addBrandCampiagnVisitPlans($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildAgendatypes object.
     *
     * @param ChildAgendatypes|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setAgendatypes(ChildAgendatypes $v = null)
    {
        if ($v === null) {
            $this->setAgendaSubTypeId(NULL);
        } else {
            $this->setAgendaSubTypeId($v->getAgendaid());
        }

        $this->aAgendatypes = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAgendatypes object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandCampiagnVisitPlan($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAgendatypes object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildAgendatypes|null The associated ChildAgendatypes object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAgendatypes(?ConnectionInterface $con = null)
    {
        if ($this->aAgendatypes === null && ($this->agenda_sub_type_id != 0)) {
            $this->aAgendatypes = ChildAgendatypesQuery::create()->findPk($this->agenda_sub_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAgendatypes->addBrandCampiagnVisitPlans($this);
             */
        }

        return $this->aAgendatypes;
    }

    /**
     * Declares an association between this object and a ChildSurvey object.
     *
     * @param ChildSurvey|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSurvey(ChildSurvey $v = null)
    {
        if ($v === null) {
            $this->setSurveyId(NULL);
        } else {
            $this->setSurveyId($v->getSurveyId());
        }

        $this->aSurvey = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSurvey object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandCampiagnVisitPlan($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSurvey object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSurvey|null The associated ChildSurvey object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurvey(?ConnectionInterface $con = null)
    {
        if ($this->aSurvey === null && ($this->survey_id != 0)) {
            $this->aSurvey = ChildSurveyQuery::create()->findPk($this->survey_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSurvey->addBrandCampiagnVisitPlans($this);
             */
        }

        return $this->aSurvey;
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
        if ('BrandCampiagnVisits' === $relationName) {
            $this->initBrandCampiagnVisitss();
            return;
        }
        if ('DailycallsAttendees' === $relationName) {
            $this->initDailycallsAttendeess();
            return;
        }
        if ('Dayplan' === $relationName) {
            $this->initDayplans();
            return;
        }
        if ('SurveySubmited' === $relationName) {
            $this->initSurveySubmiteds();
            return;
        }
        if ('Tourplans' === $relationName) {
            $this->initTourplanss();
            return;
        }
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
     * If this ChildBrandCampiagnVisitPlan is new, it will return
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
                    ->filterByBrandCampiagnVisitPlan($this)
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
            $brandCampiagnVisitsRemoved->setBrandCampiagnVisitPlan(null);
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
                ->filterByBrandCampiagnVisitPlan($this)
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
        $brandCampiagnVisits->setBrandCampiagnVisitPlan($this);
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
            $brandCampiagnVisits->setBrandCampiagnVisitPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinBrandCampiagn(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagn', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
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
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
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
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
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
     * Clears out the collDailycallsAttendeess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDailycallsAttendeess()
     */
    public function clearDailycallsAttendeess()
    {
        $this->collDailycallsAttendeess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDailycallsAttendeess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDailycallsAttendeess($v = true): void
    {
        $this->collDailycallsAttendeessPartial = $v;
    }

    /**
     * Initializes the collDailycallsAttendeess collection.
     *
     * By default this just sets the collDailycallsAttendeess collection to an empty array (like clearcollDailycallsAttendeess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDailycallsAttendeess(bool $overrideExisting = true): void
    {
        if (null !== $this->collDailycallsAttendeess && !$overrideExisting) {
            return;
        }

        $collectionClassName = DailycallsAttendeesTableMap::getTableMap()->getCollectionClassName();

        $this->collDailycallsAttendeess = new $collectionClassName;
        $this->collDailycallsAttendeess->setModel('\entities\DailycallsAttendees');
    }

    /**
     * Gets an array of ChildDailycallsAttendees objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrandCampiagnVisitPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDailycallsAttendees[] List of ChildDailycallsAttendees objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsAttendees> List of ChildDailycallsAttendees objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDailycallsAttendeess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDailycallsAttendeessPartial && !$this->isNew();
        if (null === $this->collDailycallsAttendeess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDailycallsAttendeess) {
                    $this->initDailycallsAttendeess();
                } else {
                    $collectionClassName = DailycallsAttendeesTableMap::getTableMap()->getCollectionClassName();

                    $collDailycallsAttendeess = new $collectionClassName;
                    $collDailycallsAttendeess->setModel('\entities\DailycallsAttendees');

                    return $collDailycallsAttendeess;
                }
            } else {
                $collDailycallsAttendeess = ChildDailycallsAttendeesQuery::create(null, $criteria)
                    ->filterByBrandCampiagnVisitPlan($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDailycallsAttendeessPartial && count($collDailycallsAttendeess)) {
                        $this->initDailycallsAttendeess(false);

                        foreach ($collDailycallsAttendeess as $obj) {
                            if (false == $this->collDailycallsAttendeess->contains($obj)) {
                                $this->collDailycallsAttendeess->append($obj);
                            }
                        }

                        $this->collDailycallsAttendeessPartial = true;
                    }

                    return $collDailycallsAttendeess;
                }

                if ($partial && $this->collDailycallsAttendeess) {
                    foreach ($this->collDailycallsAttendeess as $obj) {
                        if ($obj->isNew()) {
                            $collDailycallsAttendeess[] = $obj;
                        }
                    }
                }

                $this->collDailycallsAttendeess = $collDailycallsAttendeess;
                $this->collDailycallsAttendeessPartial = false;
            }
        }

        return $this->collDailycallsAttendeess;
    }

    /**
     * Sets a collection of ChildDailycallsAttendees objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dailycallsAttendeess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDailycallsAttendeess(Collection $dailycallsAttendeess, ?ConnectionInterface $con = null)
    {
        /** @var ChildDailycallsAttendees[] $dailycallsAttendeessToDelete */
        $dailycallsAttendeessToDelete = $this->getDailycallsAttendeess(new Criteria(), $con)->diff($dailycallsAttendeess);


        $this->dailycallsAttendeessScheduledForDeletion = $dailycallsAttendeessToDelete;

        foreach ($dailycallsAttendeessToDelete as $dailycallsAttendeesRemoved) {
            $dailycallsAttendeesRemoved->setBrandCampiagnVisitPlan(null);
        }

        $this->collDailycallsAttendeess = null;
        foreach ($dailycallsAttendeess as $dailycallsAttendees) {
            $this->addDailycallsAttendees($dailycallsAttendees);
        }

        $this->collDailycallsAttendeess = $dailycallsAttendeess;
        $this->collDailycallsAttendeessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DailycallsAttendees objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related DailycallsAttendees objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDailycallsAttendeess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDailycallsAttendeessPartial && !$this->isNew();
        if (null === $this->collDailycallsAttendeess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDailycallsAttendeess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDailycallsAttendeess());
            }

            $query = ChildDailycallsAttendeesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrandCampiagnVisitPlan($this)
                ->count($con);
        }

        return count($this->collDailycallsAttendeess);
    }

    /**
     * Method called to associate a ChildDailycallsAttendees object to this object
     * through the ChildDailycallsAttendees foreign key attribute.
     *
     * @param ChildDailycallsAttendees $l ChildDailycallsAttendees
     * @return $this The current object (for fluent API support)
     */
    public function addDailycallsAttendees(ChildDailycallsAttendees $l)
    {
        if ($this->collDailycallsAttendeess === null) {
            $this->initDailycallsAttendeess();
            $this->collDailycallsAttendeessPartial = true;
        }

        if (!$this->collDailycallsAttendeess->contains($l)) {
            $this->doAddDailycallsAttendees($l);

            if ($this->dailycallsAttendeessScheduledForDeletion and $this->dailycallsAttendeessScheduledForDeletion->contains($l)) {
                $this->dailycallsAttendeessScheduledForDeletion->remove($this->dailycallsAttendeessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDailycallsAttendees $dailycallsAttendees The ChildDailycallsAttendees object to add.
     */
    protected function doAddDailycallsAttendees(ChildDailycallsAttendees $dailycallsAttendees): void
    {
        $this->collDailycallsAttendeess[]= $dailycallsAttendees;
        $dailycallsAttendees->setBrandCampiagnVisitPlan($this);
    }

    /**
     * @param ChildDailycallsAttendees $dailycallsAttendees The ChildDailycallsAttendees object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDailycallsAttendees(ChildDailycallsAttendees $dailycallsAttendees)
    {
        if ($this->getDailycallsAttendeess()->contains($dailycallsAttendees)) {
            $pos = $this->collDailycallsAttendeess->search($dailycallsAttendees);
            $this->collDailycallsAttendeess->remove($pos);
            if (null === $this->dailycallsAttendeessScheduledForDeletion) {
                $this->dailycallsAttendeessScheduledForDeletion = clone $this->collDailycallsAttendeess;
                $this->dailycallsAttendeessScheduledForDeletion->clear();
            }
            $this->dailycallsAttendeessScheduledForDeletion[]= $dailycallsAttendees;
            $dailycallsAttendees->setBrandCampiagnVisitPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related DailycallsAttendeess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsAttendees[] List of ChildDailycallsAttendees objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsAttendees}> List of ChildDailycallsAttendees objects
     */
    public function getDailycallsAttendeessJoinDailycalls(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsAttendeesQuery::create(null, $criteria);
        $query->joinWith('Dailycalls', $joinBehavior);

        return $this->getDailycallsAttendeess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related DailycallsAttendeess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsAttendees[] List of ChildDailycallsAttendees objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsAttendees}> List of ChildDailycallsAttendees objects
     */
    public function getDailycallsAttendeessJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsAttendeesQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDailycallsAttendeess($query, $con);
    }

    /**
     * Clears out the collDayplans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDayplans()
     */
    public function clearDayplans()
    {
        $this->collDayplans = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDayplans collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDayplans($v = true): void
    {
        $this->collDayplansPartial = $v;
    }

    /**
     * Initializes the collDayplans collection.
     *
     * By default this just sets the collDayplans collection to an empty array (like clearcollDayplans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDayplans(bool $overrideExisting = true): void
    {
        if (null !== $this->collDayplans && !$overrideExisting) {
            return;
        }

        $collectionClassName = DayplanTableMap::getTableMap()->getCollectionClassName();

        $this->collDayplans = new $collectionClassName;
        $this->collDayplans->setModel('\entities\Dayplan');
    }

    /**
     * Gets an array of ChildDayplan objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrandCampiagnVisitPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan> List of ChildDayplan objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDayplans(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDayplansPartial && !$this->isNew();
        if (null === $this->collDayplans || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDayplans) {
                    $this->initDayplans();
                } else {
                    $collectionClassName = DayplanTableMap::getTableMap()->getCollectionClassName();

                    $collDayplans = new $collectionClassName;
                    $collDayplans->setModel('\entities\Dayplan');

                    return $collDayplans;
                }
            } else {
                $collDayplans = ChildDayplanQuery::create(null, $criteria)
                    ->filterByBrandCampiagnVisitPlan($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDayplansPartial && count($collDayplans)) {
                        $this->initDayplans(false);

                        foreach ($collDayplans as $obj) {
                            if (false == $this->collDayplans->contains($obj)) {
                                $this->collDayplans->append($obj);
                            }
                        }

                        $this->collDayplansPartial = true;
                    }

                    return $collDayplans;
                }

                if ($partial && $this->collDayplans) {
                    foreach ($this->collDayplans as $obj) {
                        if ($obj->isNew()) {
                            $collDayplans[] = $obj;
                        }
                    }
                }

                $this->collDayplans = $collDayplans;
                $this->collDayplansPartial = false;
            }
        }

        return $this->collDayplans;
    }

    /**
     * Sets a collection of ChildDayplan objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dayplans A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDayplans(Collection $dayplans, ?ConnectionInterface $con = null)
    {
        /** @var ChildDayplan[] $dayplansToDelete */
        $dayplansToDelete = $this->getDayplans(new Criteria(), $con)->diff($dayplans);


        $this->dayplansScheduledForDeletion = $dayplansToDelete;

        foreach ($dayplansToDelete as $dayplanRemoved) {
            $dayplanRemoved->setBrandCampiagnVisitPlan(null);
        }

        $this->collDayplans = null;
        foreach ($dayplans as $dayplan) {
            $this->addDayplan($dayplan);
        }

        $this->collDayplans = $dayplans;
        $this->collDayplansPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Dayplan objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Dayplan objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDayplans(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDayplansPartial && !$this->isNew();
        if (null === $this->collDayplans || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDayplans) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDayplans());
            }

            $query = ChildDayplanQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrandCampiagnVisitPlan($this)
                ->count($con);
        }

        return count($this->collDayplans);
    }

    /**
     * Method called to associate a ChildDayplan object to this object
     * through the ChildDayplan foreign key attribute.
     *
     * @param ChildDayplan $l ChildDayplan
     * @return $this The current object (for fluent API support)
     */
    public function addDayplan(ChildDayplan $l)
    {
        if ($this->collDayplans === null) {
            $this->initDayplans();
            $this->collDayplansPartial = true;
        }

        if (!$this->collDayplans->contains($l)) {
            $this->doAddDayplan($l);

            if ($this->dayplansScheduledForDeletion and $this->dayplansScheduledForDeletion->contains($l)) {
                $this->dayplansScheduledForDeletion->remove($this->dayplansScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDayplan $dayplan The ChildDayplan object to add.
     */
    protected function doAddDayplan(ChildDayplan $dayplan): void
    {
        $this->collDayplans[]= $dayplan;
        $dayplan->setBrandCampiagnVisitPlan($this);
    }

    /**
     * @param ChildDayplan $dayplan The ChildDayplan object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDayplan(ChildDayplan $dayplan)
    {
        if ($this->getDayplans()->contains($dayplan)) {
            $pos = $this->collDayplans->search($dayplan);
            $this->collDayplans->remove($pos);
            if (null === $this->dayplansScheduledForDeletion) {
                $this->dayplansScheduledForDeletion = clone $this->collDayplans;
                $this->dayplansScheduledForDeletion->clear();
            }
            $this->dayplansScheduledForDeletion[]= $dayplan;
            $dayplan->setBrandCampiagnVisitPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDayplans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getDayplans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinAgendatypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('Agendatypes', $joinBehavior);

        return $this->getDayplans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getDayplans($query, $con);
    }

    /**
     * Clears out the collSurveySubmiteds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSurveySubmiteds()
     */
    public function clearSurveySubmiteds()
    {
        $this->collSurveySubmiteds = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSurveySubmiteds collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSurveySubmiteds($v = true): void
    {
        $this->collSurveySubmitedsPartial = $v;
    }

    /**
     * Initializes the collSurveySubmiteds collection.
     *
     * By default this just sets the collSurveySubmiteds collection to an empty array (like clearcollSurveySubmiteds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSurveySubmiteds(bool $overrideExisting = true): void
    {
        if (null !== $this->collSurveySubmiteds && !$overrideExisting) {
            return;
        }

        $collectionClassName = SurveySubmitedTableMap::getTableMap()->getCollectionClassName();

        $this->collSurveySubmiteds = new $collectionClassName;
        $this->collSurveySubmiteds->setModel('\entities\SurveySubmited');
    }

    /**
     * Gets an array of ChildSurveySubmited objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrandCampiagnVisitPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited> List of ChildSurveySubmited objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurveySubmiteds(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSurveySubmitedsPartial && !$this->isNew();
        if (null === $this->collSurveySubmiteds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSurveySubmiteds) {
                    $this->initSurveySubmiteds();
                } else {
                    $collectionClassName = SurveySubmitedTableMap::getTableMap()->getCollectionClassName();

                    $collSurveySubmiteds = new $collectionClassName;
                    $collSurveySubmiteds->setModel('\entities\SurveySubmited');

                    return $collSurveySubmiteds;
                }
            } else {
                $collSurveySubmiteds = ChildSurveySubmitedQuery::create(null, $criteria)
                    ->filterByBrandCampiagnVisitPlan($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSurveySubmitedsPartial && count($collSurveySubmiteds)) {
                        $this->initSurveySubmiteds(false);

                        foreach ($collSurveySubmiteds as $obj) {
                            if (false == $this->collSurveySubmiteds->contains($obj)) {
                                $this->collSurveySubmiteds->append($obj);
                            }
                        }

                        $this->collSurveySubmitedsPartial = true;
                    }

                    return $collSurveySubmiteds;
                }

                if ($partial && $this->collSurveySubmiteds) {
                    foreach ($this->collSurveySubmiteds as $obj) {
                        if ($obj->isNew()) {
                            $collSurveySubmiteds[] = $obj;
                        }
                    }
                }

                $this->collSurveySubmiteds = $collSurveySubmiteds;
                $this->collSurveySubmitedsPartial = false;
            }
        }

        return $this->collSurveySubmiteds;
    }

    /**
     * Sets a collection of ChildSurveySubmited objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $surveySubmiteds A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSurveySubmiteds(Collection $surveySubmiteds, ?ConnectionInterface $con = null)
    {
        /** @var ChildSurveySubmited[] $surveySubmitedsToDelete */
        $surveySubmitedsToDelete = $this->getSurveySubmiteds(new Criteria(), $con)->diff($surveySubmiteds);


        $this->surveySubmitedsScheduledForDeletion = $surveySubmitedsToDelete;

        foreach ($surveySubmitedsToDelete as $surveySubmitedRemoved) {
            $surveySubmitedRemoved->setBrandCampiagnVisitPlan(null);
        }

        $this->collSurveySubmiteds = null;
        foreach ($surveySubmiteds as $surveySubmited) {
            $this->addSurveySubmited($surveySubmited);
        }

        $this->collSurveySubmiteds = $surveySubmiteds;
        $this->collSurveySubmitedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SurveySubmited objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SurveySubmited objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSurveySubmiteds(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSurveySubmitedsPartial && !$this->isNew();
        if (null === $this->collSurveySubmiteds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSurveySubmiteds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSurveySubmiteds());
            }

            $query = ChildSurveySubmitedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrandCampiagnVisitPlan($this)
                ->count($con);
        }

        return count($this->collSurveySubmiteds);
    }

    /**
     * Method called to associate a ChildSurveySubmited object to this object
     * through the ChildSurveySubmited foreign key attribute.
     *
     * @param ChildSurveySubmited $l ChildSurveySubmited
     * @return $this The current object (for fluent API support)
     */
    public function addSurveySubmited(ChildSurveySubmited $l)
    {
        if ($this->collSurveySubmiteds === null) {
            $this->initSurveySubmiteds();
            $this->collSurveySubmitedsPartial = true;
        }

        if (!$this->collSurveySubmiteds->contains($l)) {
            $this->doAddSurveySubmited($l);

            if ($this->surveySubmitedsScheduledForDeletion and $this->surveySubmitedsScheduledForDeletion->contains($l)) {
                $this->surveySubmitedsScheduledForDeletion->remove($this->surveySubmitedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSurveySubmited $surveySubmited The ChildSurveySubmited object to add.
     */
    protected function doAddSurveySubmited(ChildSurveySubmited $surveySubmited): void
    {
        $this->collSurveySubmiteds[]= $surveySubmited;
        $surveySubmited->setBrandCampiagnVisitPlan($this);
    }

    /**
     * @param ChildSurveySubmited $surveySubmited The ChildSurveySubmited object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSurveySubmited(ChildSurveySubmited $surveySubmited)
    {
        if ($this->getSurveySubmiteds()->contains($surveySubmited)) {
            $pos = $this->collSurveySubmiteds->search($surveySubmited);
            $this->collSurveySubmiteds->remove($pos);
            if (null === $this->surveySubmitedsScheduledForDeletion) {
                $this->surveySubmitedsScheduledForDeletion = clone $this->collSurveySubmiteds;
                $this->surveySubmitedsScheduledForDeletion->clear();
            }
            $this->surveySubmitedsScheduledForDeletion[]= $surveySubmited;
            $surveySubmited->setBrandCampiagnVisitPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinDailycalls(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Dailycalls', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }

    /**
     * Clears out the collTourplanss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTourplanss()
     */
    public function clearTourplanss()
    {
        $this->collTourplanss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTourplanss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTourplanss($v = true): void
    {
        $this->collTourplanssPartial = $v;
    }

    /**
     * Initializes the collTourplanss collection.
     *
     * By default this just sets the collTourplanss collection to an empty array (like clearcollTourplanss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTourplanss(bool $overrideExisting = true): void
    {
        if (null !== $this->collTourplanss && !$overrideExisting) {
            return;
        }

        $collectionClassName = TourplansTableMap::getTableMap()->getCollectionClassName();

        $this->collTourplanss = new $collectionClassName;
        $this->collTourplanss->setModel('\entities\Tourplans');
    }

    /**
     * Gets an array of ChildTourplans objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBrandCampiagnVisitPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans> List of ChildTourplans objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTourplanss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTourplanssPartial && !$this->isNew();
        if (null === $this->collTourplanss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTourplanss) {
                    $this->initTourplanss();
                } else {
                    $collectionClassName = TourplansTableMap::getTableMap()->getCollectionClassName();

                    $collTourplanss = new $collectionClassName;
                    $collTourplanss->setModel('\entities\Tourplans');

                    return $collTourplanss;
                }
            } else {
                $collTourplanss = ChildTourplansQuery::create(null, $criteria)
                    ->filterByBrandCampiagnVisitPlan($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTourplanssPartial && count($collTourplanss)) {
                        $this->initTourplanss(false);

                        foreach ($collTourplanss as $obj) {
                            if (false == $this->collTourplanss->contains($obj)) {
                                $this->collTourplanss->append($obj);
                            }
                        }

                        $this->collTourplanssPartial = true;
                    }

                    return $collTourplanss;
                }

                if ($partial && $this->collTourplanss) {
                    foreach ($this->collTourplanss as $obj) {
                        if ($obj->isNew()) {
                            $collTourplanss[] = $obj;
                        }
                    }
                }

                $this->collTourplanss = $collTourplanss;
                $this->collTourplanssPartial = false;
            }
        }

        return $this->collTourplanss;
    }

    /**
     * Sets a collection of ChildTourplans objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $tourplanss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTourplanss(Collection $tourplanss, ?ConnectionInterface $con = null)
    {
        /** @var ChildTourplans[] $tourplanssToDelete */
        $tourplanssToDelete = $this->getTourplanss(new Criteria(), $con)->diff($tourplanss);


        $this->tourplanssScheduledForDeletion = $tourplanssToDelete;

        foreach ($tourplanssToDelete as $tourplansRemoved) {
            $tourplansRemoved->setBrandCampiagnVisitPlan(null);
        }

        $this->collTourplanss = null;
        foreach ($tourplanss as $tourplans) {
            $this->addTourplans($tourplans);
        }

        $this->collTourplanss = $tourplanss;
        $this->collTourplanssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tourplans objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Tourplans objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTourplanss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTourplanssPartial && !$this->isNew();
        if (null === $this->collTourplanss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTourplanss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTourplanss());
            }

            $query = ChildTourplansQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBrandCampiagnVisitPlan($this)
                ->count($con);
        }

        return count($this->collTourplanss);
    }

    /**
     * Method called to associate a ChildTourplans object to this object
     * through the ChildTourplans foreign key attribute.
     *
     * @param ChildTourplans $l ChildTourplans
     * @return $this The current object (for fluent API support)
     */
    public function addTourplans(ChildTourplans $l)
    {
        if ($this->collTourplanss === null) {
            $this->initTourplanss();
            $this->collTourplanssPartial = true;
        }

        if (!$this->collTourplanss->contains($l)) {
            $this->doAddTourplans($l);

            if ($this->tourplanssScheduledForDeletion and $this->tourplanssScheduledForDeletion->contains($l)) {
                $this->tourplanssScheduledForDeletion->remove($this->tourplanssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTourplans $tourplans The ChildTourplans object to add.
     */
    protected function doAddTourplans(ChildTourplans $tourplans): void
    {
        $this->collTourplanss[]= $tourplans;
        $tourplans->setBrandCampiagnVisitPlan($this);
    }

    /**
     * @param ChildTourplans $tourplans The ChildTourplans object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTourplans(ChildTourplans $tourplans)
    {
        if ($this->getTourplanss()->contains($tourplans)) {
            $pos = $this->collTourplanss->search($tourplans);
            $this->collTourplanss->remove($pos);
            if (null === $this->tourplanssScheduledForDeletion) {
                $this->tourplanssScheduledForDeletion = clone $this->collTourplanss;
                $this->tourplanssScheduledForDeletion->clear();
            }
            $this->tourplanssScheduledForDeletion[]= $tourplans;
            $tourplans->setBrandCampiagnVisitPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinAgendatypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Agendatypes', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinMtpDay(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('MtpDay', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinMtp(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Mtp', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BrandCampiagnVisitPlan is new, it will return
     * an empty collection; or if this BrandCampiagnVisitPlan has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BrandCampiagnVisitPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getTourplanss($query, $con);
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
        if (null !== $this->aBrandCampiagn) {
            $this->aBrandCampiagn->removeBrandCampiagnVisitPlan($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeBrandCampiagnVisitPlan($this);
        }
        if (null !== $this->aAgendatypes) {
            $this->aAgendatypes->removeBrandCampiagnVisitPlan($this);
        }
        if (null !== $this->aSurvey) {
            $this->aSurvey->removeBrandCampiagnVisitPlan($this);
        }
        $this->brand_campiagn_visit_plan_id = null;
        $this->brand_campiagn_id = null;
        $this->visit_plan_order = null;
        $this->description = null;
        $this->company_id = null;
        $this->sgpi_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->step_name = null;
        $this->step_level = null;
        $this->moye = null;
        $this->sgpi_status = null;
        $this->qty = null;
        $this->comment = null;
        $this->agenda_type = null;
        $this->agenda_sub_type_id = null;
        $this->create_survey = null;
        $this->survey_id = null;
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
            if ($this->collBrandCampiagnVisitss) {
                foreach ($this->collBrandCampiagnVisitss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallsAttendeess) {
                foreach ($this->collDailycallsAttendeess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDayplans) {
                foreach ($this->collDayplans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSurveySubmiteds) {
                foreach ($this->collSurveySubmiteds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTourplanss) {
                foreach ($this->collTourplanss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagnVisitss = null;
        $this->collDailycallsAttendeess = null;
        $this->collDayplans = null;
        $this->collSurveySubmiteds = null;
        $this->collTourplanss = null;
        $this->aBrandCampiagn = null;
        $this->aCompany = null;
        $this->aAgendatypes = null;
        $this->aSurvey = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BrandCampiagnVisitPlanTableMap::DEFAULT_STRING_FORMAT);
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
