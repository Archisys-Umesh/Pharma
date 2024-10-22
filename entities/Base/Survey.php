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
use entities\BrandCampiagnVisitPlan as ChildBrandCampiagnVisitPlan;
use entities\BrandCampiagnVisitPlanQuery as ChildBrandCampiagnVisitPlanQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\Survey as ChildSurvey;
use entities\SurveyCategory as ChildSurveyCategory;
use entities\SurveyCategoryQuery as ChildSurveyCategoryQuery;
use entities\SurveyQuery as ChildSurveyQuery;
use entities\SurveyQuestion as ChildSurveyQuestion;
use entities\SurveyQuestionQuery as ChildSurveyQuestionQuery;
use entities\Map\BrandCampiagnVisitPlanTableMap;
use entities\Map\SurveyQuestionTableMap;
use entities\Map\SurveyTableMap;

/**
 * Base class that represents a row from the 'survey' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Survey implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\SurveyTableMap';


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
     * The value for the survey_id field.
     *
     * @var        int
     */
    protected $survey_id;

    /**
     * The value for the survey_name field.
     *
     * @var        string|null
     */
    protected $survey_name;

    /**
     * The value for the survey_catid field.
     *
     * @var        int|null
     */
    protected $survey_catid;

    /**
     * The value for the is_multiple field.
     *
     * @var        boolean|null
     */
    protected $is_multiple;

    /**
     * The value for the status field.
     *
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the outlet_type_id field.
     *
     * @var        int
     */
    protected $outlet_type_id;

    /**
     * The value for the orgunitid field.
     *
     * @var        string|null
     */
    protected $orgunitid;

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
     * The value for the media_id field.
     *
     * @var        string|null
     */
    protected $media_id;

    /**
     * The value for the audience_type field.
     *
     * @var        string|null
     */
    protected $audience_type;

    /**
     * The value for the short_code field.
     *
     * @var        string|null
     */
    protected $short_code;

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
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildSurveyCategory
     */
    protected $aSurveyCategory;

    /**
     * @var        ChildOutletType
     */
    protected $aOutletType;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnVisitPlan[] Collection to store aggregation of ChildBrandCampiagnVisitPlan objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan> Collection to store aggregation of ChildBrandCampiagnVisitPlan objects.
     */
    protected $collBrandCampiagnVisitPlans;
    protected $collBrandCampiagnVisitPlansPartial;

    /**
     * @var        ObjectCollection|ChildSurveyQuestion[] Collection to store aggregation of ChildSurveyQuestion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveyQuestion> Collection to store aggregation of ChildSurveyQuestion objects.
     */
    protected $collSurveyQuestions;
    protected $collSurveyQuestionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnVisitPlan[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan>
     */
    protected $brandCampiagnVisitPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSurveyQuestion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveyQuestion>
     */
    protected $surveyQuestionsScheduledForDeletion = null;

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
     * Initializes internal state of entities\Base\Survey object.
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
     * Compares this with another <code>Survey</code> instance.  If
     * <code>obj</code> is an instance of <code>Survey</code>, delegates to
     * <code>equals(Survey)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [survey_id] column value.
     *
     * @return int
     */
    public function getSurveyId()
    {
        return $this->survey_id;
    }

    /**
     * Get the [survey_name] column value.
     *
     * @return string|null
     */
    public function getSurveyName()
    {
        return $this->survey_name;
    }

    /**
     * Get the [survey_catid] column value.
     *
     * @return int|null
     */
    public function getSurveyCatid()
    {
        return $this->survey_catid;
    }

    /**
     * Get the [is_multiple] column value.
     *
     * @return boolean|null
     */
    public function getIsMultiple()
    {
        return $this->is_multiple;
    }

    /**
     * Get the [is_multiple] column value.
     *
     * @return boolean|null
     */
    public function isMultiple()
    {
        return $this->getIsMultiple();
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
     * Get the [company_id] column value.
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [outlet_type_id] column value.
     *
     * @return int
     */
    public function getOutletTypeId()
    {
        return $this->outlet_type_id;
    }

    /**
     * Get the [orgunitid] column value.
     *
     * @return string|null
     */
    public function getOrgunitid()
    {
        return $this->orgunitid;
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
     * Get the [media_id] column value.
     *
     * @return string|null
     */
    public function getMediaId()
    {
        return $this->media_id;
    }

    /**
     * Get the [audience_type] column value.
     *
     * @return string|null
     */
    public function getAudienceType()
    {
        return $this->audience_type;
    }

    /**
     * Get the [short_code] column value.
     *
     * @return string|null
     */
    public function getShortCode()
    {
        return $this->short_code;
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
     * Set the value of [survey_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSurveyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->survey_id !== $v) {
            $this->survey_id = $v;
            $this->modifiedColumns[SurveyTableMap::COL_SURVEY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [survey_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSurveyName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->survey_name !== $v) {
            $this->survey_name = $v;
            $this->modifiedColumns[SurveyTableMap::COL_SURVEY_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [survey_catid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSurveyCatid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->survey_catid !== $v) {
            $this->survey_catid = $v;
            $this->modifiedColumns[SurveyTableMap::COL_SURVEY_CATID] = true;
        }

        if ($this->aSurveyCategory !== null && $this->aSurveyCategory->getSurveyCatid() !== $v) {
            $this->aSurveyCategory = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_multiple] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsMultiple($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_multiple !== $v) {
            $this->is_multiple = $v;
            $this->modifiedColumns[SurveyTableMap::COL_IS_MULTIPLE] = true;
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
            $this->modifiedColumns[SurveyTableMap::COL_STATUS] = true;
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
            $this->modifiedColumns[SurveyTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_type_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_type_id !== $v) {
            $this->outlet_type_id = $v;
            $this->modifiedColumns[SurveyTableMap::COL_OUTLET_TYPE_ID] = true;
        }

        if ($this->aOutletType !== null && $this->aOutletType->getOutlettypeId() !== $v) {
            $this->aOutletType = null;
        }

        return $this;
    }

    /**
     * Set the value of [orgunitid] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->orgunitid !== $v) {
            $this->orgunitid = $v;
            $this->modifiedColumns[SurveyTableMap::COL_ORGUNITID] = true;
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
                $this->modifiedColumns[SurveyTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SurveyTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [media_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMediaId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->media_id !== $v) {
            $this->media_id = $v;
            $this->modifiedColumns[SurveyTableMap::COL_MEDIA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [audience_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAudienceType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->audience_type !== $v) {
            $this->audience_type = $v;
            $this->modifiedColumns[SurveyTableMap::COL_AUDIENCE_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [short_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setShortCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->short_code !== $v) {
            $this->short_code = $v;
            $this->modifiedColumns[SurveyTableMap::COL_SHORT_CODE] = true;
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
                $this->modifiedColumns[SurveyTableMap::COL_START_DATE] = true;
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
                $this->modifiedColumns[SurveyTableMap::COL_END_DATE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SurveyTableMap::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->survey_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SurveyTableMap::translateFieldName('SurveyName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->survey_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SurveyTableMap::translateFieldName('SurveyCatid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->survey_catid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SurveyTableMap::translateFieldName('IsMultiple', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_multiple = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SurveyTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SurveyTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SurveyTableMap::translateFieldName('OutletTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SurveyTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SurveyTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SurveyTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SurveyTableMap::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SurveyTableMap::translateFieldName('AudienceType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->audience_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SurveyTableMap::translateFieldName('ShortCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->short_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SurveyTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SurveyTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = SurveyTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Survey'), 0, $e);
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
        if ($this->aSurveyCategory !== null && $this->survey_catid !== $this->aSurveyCategory->getSurveyCatid()) {
            $this->aSurveyCategory = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aOutletType !== null && $this->outlet_type_id !== $this->aOutletType->getOutlettypeId()) {
            $this->aOutletType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SurveyTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSurveyQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aSurveyCategory = null;
            $this->aOutletType = null;
            $this->collBrandCampiagnVisitPlans = null;

            $this->collSurveyQuestions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Survey::setDeleted()
     * @see Survey::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSurveyQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyTableMap::DATABASE_NAME);
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
                SurveyTableMap::addInstanceToPool($this);
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

            if ($this->aSurveyCategory !== null) {
                if ($this->aSurveyCategory->isModified() || $this->aSurveyCategory->isNew()) {
                    $affectedRows += $this->aSurveyCategory->save($con);
                }
                $this->setSurveyCategory($this->aSurveyCategory);
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

            if ($this->surveyQuestionsScheduledForDeletion !== null) {
                if (!$this->surveyQuestionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->surveyQuestionsScheduledForDeletion as $surveyQuestion) {
                        // need to save related object because we set the relation to null
                        $surveyQuestion->save($con);
                    }
                    $this->surveyQuestionsScheduledForDeletion = null;
                }
            }

            if ($this->collSurveyQuestions !== null) {
                foreach ($this->collSurveyQuestions as $referrerFK) {
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

        $this->modifiedColumns[SurveyTableMap::COL_SURVEY_ID] = true;
        if (null !== $this->survey_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SurveyTableMap::COL_SURVEY_ID . ')');
        }
        if (null === $this->survey_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('survey_survey_id_seq')");
                $this->survey_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SurveyTableMap::COL_SURVEY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'survey_id';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_SURVEY_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'survey_name';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_SURVEY_CATID)) {
            $modifiedColumns[':p' . $index++]  = 'survey_catid';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_IS_MULTIPLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_multiple';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_OUTLET_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_type_id';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_ORGUNITID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunitid';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_MEDIA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'media_id';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_AUDIENCE_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'audience_type';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_SHORT_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'short_code';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(SurveyTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }

        $sql = sprintf(
            'INSERT INTO survey (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'survey_id':
                        $stmt->bindValue($identifier, $this->survey_id, PDO::PARAM_INT);

                        break;
                    case 'survey_name':
                        $stmt->bindValue($identifier, $this->survey_name, PDO::PARAM_STR);

                        break;
                    case 'survey_catid':
                        $stmt->bindValue($identifier, $this->survey_catid, PDO::PARAM_INT);

                        break;
                    case 'is_multiple':
                        $stmt->bindValue($identifier, $this->is_multiple, PDO::PARAM_BOOL);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_type_id':
                        $stmt->bindValue($identifier, $this->outlet_type_id, PDO::PARAM_INT);

                        break;
                    case 'orgunitid':
                        $stmt->bindValue($identifier, $this->orgunitid, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'media_id':
                        $stmt->bindValue($identifier, $this->media_id, PDO::PARAM_STR);

                        break;
                    case 'audience_type':
                        $stmt->bindValue($identifier, $this->audience_type, PDO::PARAM_STR);

                        break;
                    case 'short_code':
                        $stmt->bindValue($identifier, $this->short_code, PDO::PARAM_STR);

                        break;
                    case 'start_date':
                        $stmt->bindValue($identifier, $this->start_date ? $this->start_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'end_date':
                        $stmt->bindValue($identifier, $this->end_date ? $this->end_date->format("Y-m-d") : null, PDO::PARAM_STR);

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
        $pos = SurveyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSurveyId();

            case 1:
                return $this->getSurveyName();

            case 2:
                return $this->getSurveyCatid();

            case 3:
                return $this->getIsMultiple();

            case 4:
                return $this->getStatus();

            case 5:
                return $this->getCompanyId();

            case 6:
                return $this->getOutletTypeId();

            case 7:
                return $this->getOrgunitid();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getUpdatedAt();

            case 10:
                return $this->getMediaId();

            case 11:
                return $this->getAudienceType();

            case 12:
                return $this->getShortCode();

            case 13:
                return $this->getStartDate();

            case 14:
                return $this->getEndDate();

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
        if (isset($alreadyDumpedObjects['Survey'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Survey'][$this->hashCode()] = true;
        $keys = SurveyTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSurveyId(),
            $keys[1] => $this->getSurveyName(),
            $keys[2] => $this->getSurveyCatid(),
            $keys[3] => $this->getIsMultiple(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getCompanyId(),
            $keys[6] => $this->getOutletTypeId(),
            $keys[7] => $this->getOrgunitid(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
            $keys[10] => $this->getMediaId(),
            $keys[11] => $this->getAudienceType(),
            $keys[12] => $this->getShortCode(),
            $keys[13] => $this->getStartDate(),
            $keys[14] => $this->getEndDate(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d');
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
            if (null !== $this->aSurveyCategory) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveyCategory';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'survey_category';
                        break;
                    default:
                        $key = 'SurveyCategory';
                }

                $result[$key] = $this->aSurveyCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collSurveyQuestions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveyQuestions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'survey_questions';
                        break;
                    default:
                        $key = 'SurveyQuestions';
                }

                $result[$key] = $this->collSurveyQuestions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SurveyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setSurveyId($value);
                break;
            case 1:
                $this->setSurveyName($value);
                break;
            case 2:
                $this->setSurveyCatid($value);
                break;
            case 3:
                $this->setIsMultiple($value);
                break;
            case 4:
                $this->setStatus($value);
                break;
            case 5:
                $this->setCompanyId($value);
                break;
            case 6:
                $this->setOutletTypeId($value);
                break;
            case 7:
                $this->setOrgunitid($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setUpdatedAt($value);
                break;
            case 10:
                $this->setMediaId($value);
                break;
            case 11:
                $this->setAudienceType($value);
                break;
            case 12:
                $this->setShortCode($value);
                break;
            case 13:
                $this->setStartDate($value);
                break;
            case 14:
                $this->setEndDate($value);
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
        $keys = SurveyTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSurveyId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSurveyName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSurveyCatid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsMultiple($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCompanyId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setOutletTypeId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setOrgunitid($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setMediaId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setAudienceType($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setShortCode($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setStartDate($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setEndDate($arr[$keys[14]]);
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
        $criteria = new Criteria(SurveyTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SurveyTableMap::COL_SURVEY_ID)) {
            $criteria->add(SurveyTableMap::COL_SURVEY_ID, $this->survey_id);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_SURVEY_NAME)) {
            $criteria->add(SurveyTableMap::COL_SURVEY_NAME, $this->survey_name);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_SURVEY_CATID)) {
            $criteria->add(SurveyTableMap::COL_SURVEY_CATID, $this->survey_catid);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_IS_MULTIPLE)) {
            $criteria->add(SurveyTableMap::COL_IS_MULTIPLE, $this->is_multiple);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_STATUS)) {
            $criteria->add(SurveyTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_COMPANY_ID)) {
            $criteria->add(SurveyTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_OUTLET_TYPE_ID)) {
            $criteria->add(SurveyTableMap::COL_OUTLET_TYPE_ID, $this->outlet_type_id);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_ORGUNITID)) {
            $criteria->add(SurveyTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_CREATED_AT)) {
            $criteria->add(SurveyTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_UPDATED_AT)) {
            $criteria->add(SurveyTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_MEDIA_ID)) {
            $criteria->add(SurveyTableMap::COL_MEDIA_ID, $this->media_id);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_AUDIENCE_TYPE)) {
            $criteria->add(SurveyTableMap::COL_AUDIENCE_TYPE, $this->audience_type);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_SHORT_CODE)) {
            $criteria->add(SurveyTableMap::COL_SHORT_CODE, $this->short_code);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_START_DATE)) {
            $criteria->add(SurveyTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(SurveyTableMap::COL_END_DATE)) {
            $criteria->add(SurveyTableMap::COL_END_DATE, $this->end_date);
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
        $criteria = ChildSurveyQuery::create();
        $criteria->add(SurveyTableMap::COL_SURVEY_ID, $this->survey_id);

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
        $validPk = null !== $this->getSurveyId();

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
        return $this->getSurveyId();
    }

    /**
     * Generic method to set the primary key (survey_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setSurveyId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getSurveyId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Survey (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSurveyName($this->getSurveyName());
        $copyObj->setSurveyCatid($this->getSurveyCatid());
        $copyObj->setIsMultiple($this->getIsMultiple());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setOutletTypeId($this->getOutletTypeId());
        $copyObj->setOrgunitid($this->getOrgunitid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setMediaId($this->getMediaId());
        $copyObj->setAudienceType($this->getAudienceType());
        $copyObj->setShortCode($this->getShortCode());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagnVisitPlans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnVisitPlan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSurveyQuestions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSurveyQuestion($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setSurveyId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Survey Clone of current object.
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
            $v->addSurvey($this);
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
                $this->aCompany->addSurveys($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildSurveyCategory object.
     *
     * @param ChildSurveyCategory|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSurveyCategory(ChildSurveyCategory $v = null)
    {
        if ($v === null) {
            $this->setSurveyCatid(NULL);
        } else {
            $this->setSurveyCatid($v->getSurveyCatid());
        }

        $this->aSurveyCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSurveyCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addSurvey($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSurveyCategory object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSurveyCategory|null The associated ChildSurveyCategory object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurveyCategory(?ConnectionInterface $con = null)
    {
        if ($this->aSurveyCategory === null && ($this->survey_catid != 0)) {
            $this->aSurveyCategory = ChildSurveyCategoryQuery::create()->findPk($this->survey_catid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSurveyCategory->addSurveys($this);
             */
        }

        return $this->aSurveyCategory;
    }

    /**
     * Declares an association between this object and a ChildOutletType object.
     *
     * @param ChildOutletType $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletType(ChildOutletType $v = null)
    {
        if ($v === null) {
            $this->setOutletTypeId(NULL);
        } else {
            $this->setOutletTypeId($v->getOutlettypeId());
        }

        $this->aOutletType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletType object, it will not be re-added.
        if ($v !== null) {
            $v->addSurvey($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletType The associated ChildOutletType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletType(?ConnectionInterface $con = null)
    {
        if ($this->aOutletType === null && ($this->outlet_type_id != 0)) {
            $this->aOutletType = ChildOutletTypeQuery::create()->findPk($this->outlet_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletType->addSurveys($this);
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
        if ('BrandCampiagnVisitPlan' === $relationName) {
            $this->initBrandCampiagnVisitPlans();
            return;
        }
        if ('SurveyQuestion' === $relationName) {
            $this->initSurveyQuestions();
            return;
        }
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
     * If this ChildSurvey is new, it will return
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
                    ->filterBySurvey($this)
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
            $brandCampiagnVisitPlanRemoved->setSurvey(null);
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
                ->filterBySurvey($this)
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
        $brandCampiagnVisitPlan->setSurvey($this);
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
            $brandCampiagnVisitPlan->setSurvey(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Survey is new, it will return
     * an empty collection; or if this Survey has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Survey.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan}> List of ChildBrandCampiagnVisitPlan objects
     */
    public function getBrandCampiagnVisitPlansJoinBrandCampiagn(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagn', $joinBehavior);

        return $this->getBrandCampiagnVisitPlans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Survey is new, it will return
     * an empty collection; or if this Survey has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Survey.
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
     * Otherwise if this Survey is new, it will return
     * an empty collection; or if this Survey has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Survey.
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
     * Clears out the collSurveyQuestions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSurveyQuestions()
     */
    public function clearSurveyQuestions()
    {
        $this->collSurveyQuestions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSurveyQuestions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSurveyQuestions($v = true): void
    {
        $this->collSurveyQuestionsPartial = $v;
    }

    /**
     * Initializes the collSurveyQuestions collection.
     *
     * By default this just sets the collSurveyQuestions collection to an empty array (like clearcollSurveyQuestions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSurveyQuestions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSurveyQuestions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SurveyQuestionTableMap::getTableMap()->getCollectionClassName();

        $this->collSurveyQuestions = new $collectionClassName;
        $this->collSurveyQuestions->setModel('\entities\SurveyQuestion');
    }

    /**
     * Gets an array of ChildSurveyQuestion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSurvey is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSurveyQuestion[] List of ChildSurveyQuestion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveyQuestion> List of ChildSurveyQuestion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurveyQuestions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSurveyQuestionsPartial && !$this->isNew();
        if (null === $this->collSurveyQuestions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSurveyQuestions) {
                    $this->initSurveyQuestions();
                } else {
                    $collectionClassName = SurveyQuestionTableMap::getTableMap()->getCollectionClassName();

                    $collSurveyQuestions = new $collectionClassName;
                    $collSurveyQuestions->setModel('\entities\SurveyQuestion');

                    return $collSurveyQuestions;
                }
            } else {
                $collSurveyQuestions = ChildSurveyQuestionQuery::create(null, $criteria)
                    ->filterBySurvey($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSurveyQuestionsPartial && count($collSurveyQuestions)) {
                        $this->initSurveyQuestions(false);

                        foreach ($collSurveyQuestions as $obj) {
                            if (false == $this->collSurveyQuestions->contains($obj)) {
                                $this->collSurveyQuestions->append($obj);
                            }
                        }

                        $this->collSurveyQuestionsPartial = true;
                    }

                    return $collSurveyQuestions;
                }

                if ($partial && $this->collSurveyQuestions) {
                    foreach ($this->collSurveyQuestions as $obj) {
                        if ($obj->isNew()) {
                            $collSurveyQuestions[] = $obj;
                        }
                    }
                }

                $this->collSurveyQuestions = $collSurveyQuestions;
                $this->collSurveyQuestionsPartial = false;
            }
        }

        return $this->collSurveyQuestions;
    }

    /**
     * Sets a collection of ChildSurveyQuestion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $surveyQuestions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSurveyQuestions(Collection $surveyQuestions, ?ConnectionInterface $con = null)
    {
        /** @var ChildSurveyQuestion[] $surveyQuestionsToDelete */
        $surveyQuestionsToDelete = $this->getSurveyQuestions(new Criteria(), $con)->diff($surveyQuestions);


        $this->surveyQuestionsScheduledForDeletion = $surveyQuestionsToDelete;

        foreach ($surveyQuestionsToDelete as $surveyQuestionRemoved) {
            $surveyQuestionRemoved->setSurvey(null);
        }

        $this->collSurveyQuestions = null;
        foreach ($surveyQuestions as $surveyQuestion) {
            $this->addSurveyQuestion($surveyQuestion);
        }

        $this->collSurveyQuestions = $surveyQuestions;
        $this->collSurveyQuestionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SurveyQuestion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SurveyQuestion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSurveyQuestions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSurveyQuestionsPartial && !$this->isNew();
        if (null === $this->collSurveyQuestions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSurveyQuestions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSurveyQuestions());
            }

            $query = ChildSurveyQuestionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySurvey($this)
                ->count($con);
        }

        return count($this->collSurveyQuestions);
    }

    /**
     * Method called to associate a ChildSurveyQuestion object to this object
     * through the ChildSurveyQuestion foreign key attribute.
     *
     * @param ChildSurveyQuestion $l ChildSurveyQuestion
     * @return $this The current object (for fluent API support)
     */
    public function addSurveyQuestion(ChildSurveyQuestion $l)
    {
        if ($this->collSurveyQuestions === null) {
            $this->initSurveyQuestions();
            $this->collSurveyQuestionsPartial = true;
        }

        if (!$this->collSurveyQuestions->contains($l)) {
            $this->doAddSurveyQuestion($l);

            if ($this->surveyQuestionsScheduledForDeletion and $this->surveyQuestionsScheduledForDeletion->contains($l)) {
                $this->surveyQuestionsScheduledForDeletion->remove($this->surveyQuestionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSurveyQuestion $surveyQuestion The ChildSurveyQuestion object to add.
     */
    protected function doAddSurveyQuestion(ChildSurveyQuestion $surveyQuestion): void
    {
        $this->collSurveyQuestions[]= $surveyQuestion;
        $surveyQuestion->setSurvey($this);
    }

    /**
     * @param ChildSurveyQuestion $surveyQuestion The ChildSurveyQuestion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSurveyQuestion(ChildSurveyQuestion $surveyQuestion)
    {
        if ($this->getSurveyQuestions()->contains($surveyQuestion)) {
            $pos = $this->collSurveyQuestions->search($surveyQuestion);
            $this->collSurveyQuestions->remove($pos);
            if (null === $this->surveyQuestionsScheduledForDeletion) {
                $this->surveyQuestionsScheduledForDeletion = clone $this->collSurveyQuestions;
                $this->surveyQuestionsScheduledForDeletion->clear();
            }
            $this->surveyQuestionsScheduledForDeletion[]= $surveyQuestion;
            $surveyQuestion->setSurvey(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Survey is new, it will return
     * an empty collection; or if this Survey has previously
     * been saved, it will retrieve related SurveyQuestions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Survey.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveyQuestion[] List of ChildSurveyQuestion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveyQuestion}> List of ChildSurveyQuestion objects
     */
    public function getSurveyQuestionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveyQuestionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSurveyQuestions($query, $con);
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
            $this->aCompany->removeSurvey($this);
        }
        if (null !== $this->aSurveyCategory) {
            $this->aSurveyCategory->removeSurvey($this);
        }
        if (null !== $this->aOutletType) {
            $this->aOutletType->removeSurvey($this);
        }
        $this->survey_id = null;
        $this->survey_name = null;
        $this->survey_catid = null;
        $this->is_multiple = null;
        $this->status = null;
        $this->company_id = null;
        $this->outlet_type_id = null;
        $this->orgunitid = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->media_id = null;
        $this->audience_type = null;
        $this->short_code = null;
        $this->start_date = null;
        $this->end_date = null;
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
            if ($this->collBrandCampiagnVisitPlans) {
                foreach ($this->collBrandCampiagnVisitPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSurveyQuestions) {
                foreach ($this->collSurveyQuestions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagnVisitPlans = null;
        $this->collSurveyQuestions = null;
        $this->aCompany = null;
        $this->aSurveyCategory = null;
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
        return (string) $this->exportTo(SurveyTableMap::DEFAULT_STRING_FORMAT);
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
