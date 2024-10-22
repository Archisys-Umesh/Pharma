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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Survey as ChildSurvey;
use entities\SurveyQuery as ChildSurveyQuery;
use entities\SurveyQuestion as ChildSurveyQuestion;
use entities\SurveyQuestionQuery as ChildSurveyQuestionQuery;
use entities\SurveySubmitedAnswer as ChildSurveySubmitedAnswer;
use entities\SurveySubmitedAnswerQuery as ChildSurveySubmitedAnswerQuery;
use entities\Map\SurveyQuestionTableMap;
use entities\Map\SurveySubmitedAnswerTableMap;

/**
 * Base class that represents a row from the 'survey_question' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class SurveyQuestion implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\SurveyQuestionTableMap';


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
     * The value for the surveyquesid field.
     *
     * @var        int
     */
    protected $surveyquesid;

    /**
     * The value for the surveyquestype field.
     *
     * @var        string|null
     */
    protected $surveyquestype;

    /**
     * The value for the question field.
     *
     * @var        string|null
     */
    protected $question;

    /**
     * The value for the surveyquestionopt field.
     *
     * @var        string|null
     */
    protected $surveyquestionopt;

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
     * The value for the survey_id field.
     *
     * @var        int|null
     */
    protected $survey_id;

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
     * The value for the question_number field.
     *
     * @var        int|null
     */
    protected $question_number;

    /**
     * The value for the media_id field.
     *
     * @var        string|null
     */
    protected $media_id;

    /**
     * The value for the is_required field.
     *
     * @var        boolean|null
     */
    protected $is_required;

    /**
     * @var        ChildSurvey
     */
    protected $aSurvey;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildSurveySubmitedAnswer[] Collection to store aggregation of ChildSurveySubmitedAnswer objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmitedAnswer> Collection to store aggregation of ChildSurveySubmitedAnswer objects.
     */
    protected $collSurveySubmitedAnswers;
    protected $collSurveySubmitedAnswersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSurveySubmitedAnswer[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmitedAnswer>
     */
    protected $surveySubmitedAnswersScheduledForDeletion = null;

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
     * Initializes internal state of entities\Base\SurveyQuestion object.
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
     * Compares this with another <code>SurveyQuestion</code> instance.  If
     * <code>obj</code> is an instance of <code>SurveyQuestion</code>, delegates to
     * <code>equals(SurveyQuestion)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [surveyquesid] column value.
     *
     * @return int
     */
    public function getSurveyquesid()
    {
        return $this->surveyquesid;
    }

    /**
     * Get the [surveyquestype] column value.
     *
     * @return string|null
     */
    public function getSurveyquestype()
    {
        return $this->surveyquestype;
    }

    /**
     * Get the [question] column value.
     *
     * @return string|null
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Get the [surveyquestionopt] column value.
     *
     * @return string|null
     */
    public function getSurveyquestionopt()
    {
        return $this->surveyquestionopt;
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
     * Get the [survey_id] column value.
     *
     * @return int|null
     */
    public function getSurveyId()
    {
        return $this->survey_id;
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
     * Get the [question_number] column value.
     *
     * @return int|null
     */
    public function getQuestionNumber()
    {
        return $this->question_number;
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
     * Get the [is_required] column value.
     *
     * @return boolean|null
     */
    public function getIsRequired()
    {
        return $this->is_required;
    }

    /**
     * Get the [is_required] column value.
     *
     * @return boolean|null
     */
    public function isRequired()
    {
        return $this->getIsRequired();
    }

    /**
     * Set the value of [surveyquesid] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSurveyquesid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->surveyquesid !== $v) {
            $this->surveyquesid = $v;
            $this->modifiedColumns[SurveyQuestionTableMap::COL_SURVEYQUESID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [surveyquestype] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSurveyquestype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->surveyquestype !== $v) {
            $this->surveyquestype = $v;
            $this->modifiedColumns[SurveyQuestionTableMap::COL_SURVEYQUESTYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [question] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuestion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->question !== $v) {
            $this->question = $v;
            $this->modifiedColumns[SurveyQuestionTableMap::COL_QUESTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [surveyquestionopt] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSurveyquestionopt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->surveyquestionopt !== $v) {
            $this->surveyquestionopt = $v;
            $this->modifiedColumns[SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT] = true;
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
            $this->modifiedColumns[SurveyQuestionTableMap::COL_STATUS] = true;
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
            $this->modifiedColumns[SurveyQuestionTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
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
            $this->modifiedColumns[SurveyQuestionTableMap::COL_SURVEY_ID] = true;
        }

        if ($this->aSurvey !== null && $this->aSurvey->getSurveyId() !== $v) {
            $this->aSurvey = null;
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
                $this->modifiedColumns[SurveyQuestionTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SurveyQuestionTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [question_number] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuestionNumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->question_number !== $v) {
            $this->question_number = $v;
            $this->modifiedColumns[SurveyQuestionTableMap::COL_QUESTION_NUMBER] = true;
        }

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
            $this->modifiedColumns[SurveyQuestionTableMap::COL_MEDIA_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_required] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsRequired($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_required !== $v) {
            $this->is_required = $v;
            $this->modifiedColumns[SurveyQuestionTableMap::COL_IS_REQUIRED] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SurveyQuestionTableMap::translateFieldName('Surveyquesid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->surveyquesid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SurveyQuestionTableMap::translateFieldName('Surveyquestype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->surveyquestype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SurveyQuestionTableMap::translateFieldName('Question', TableMap::TYPE_PHPNAME, $indexType)];
            $this->question = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SurveyQuestionTableMap::translateFieldName('Surveyquestionopt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->surveyquestionopt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SurveyQuestionTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SurveyQuestionTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SurveyQuestionTableMap::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->survey_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SurveyQuestionTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SurveyQuestionTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SurveyQuestionTableMap::translateFieldName('QuestionNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->question_number = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SurveyQuestionTableMap::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SurveyQuestionTableMap::translateFieldName('IsRequired', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_required = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = SurveyQuestionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\SurveyQuestion'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SurveyQuestionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSurveyQuestionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSurvey = null;
            $this->aCompany = null;
            $this->collSurveySubmitedAnswers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SurveyQuestion::setDeleted()
     * @see SurveyQuestion::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyQuestionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSurveyQuestionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyQuestionTableMap::DATABASE_NAME);
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
                SurveyQuestionTableMap::addInstanceToPool($this);
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

            if ($this->aSurvey !== null) {
                if ($this->aSurvey->isModified() || $this->aSurvey->isNew()) {
                    $affectedRows += $this->aSurvey->save($con);
                }
                $this->setSurvey($this->aSurvey);
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

            if ($this->surveySubmitedAnswersScheduledForDeletion !== null) {
                if (!$this->surveySubmitedAnswersScheduledForDeletion->isEmpty()) {
                    foreach ($this->surveySubmitedAnswersScheduledForDeletion as $surveySubmitedAnswer) {
                        // need to save related object because we set the relation to null
                        $surveySubmitedAnswer->save($con);
                    }
                    $this->surveySubmitedAnswersScheduledForDeletion = null;
                }
            }

            if ($this->collSurveySubmitedAnswers !== null) {
                foreach ($this->collSurveySubmitedAnswers as $referrerFK) {
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

        $this->modifiedColumns[SurveyQuestionTableMap::COL_SURVEYQUESID] = true;
        if (null !== $this->surveyquesid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SurveyQuestionTableMap::COL_SURVEYQUESID . ')');
        }
        if (null === $this->surveyquesid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('survey_question_surveyquesid_seq')");
                $this->surveyquesid = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_SURVEYQUESID)) {
            $modifiedColumns[':p' . $index++]  = 'surveyquesid';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_SURVEYQUESTYPE)) {
            $modifiedColumns[':p' . $index++]  = 'surveyquestype';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_QUESTION)) {
            $modifiedColumns[':p' . $index++]  = 'question';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT)) {
            $modifiedColumns[':p' . $index++]  = 'surveyquestionopt';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_SURVEY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'survey_id';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_QUESTION_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'question_number';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_MEDIA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'media_id';
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_IS_REQUIRED)) {
            $modifiedColumns[':p' . $index++]  = 'is_required';
        }

        $sql = sprintf(
            'INSERT INTO survey_question (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'surveyquesid':
                        $stmt->bindValue($identifier, $this->surveyquesid, PDO::PARAM_INT);

                        break;
                    case 'surveyquestype':
                        $stmt->bindValue($identifier, $this->surveyquestype, PDO::PARAM_STR);

                        break;
                    case 'question':
                        $stmt->bindValue($identifier, $this->question, PDO::PARAM_STR);

                        break;
                    case 'surveyquestionopt':
                        $stmt->bindValue($identifier, $this->surveyquestionopt, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'survey_id':
                        $stmt->bindValue($identifier, $this->survey_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'question_number':
                        $stmt->bindValue($identifier, $this->question_number, PDO::PARAM_INT);

                        break;
                    case 'media_id':
                        $stmt->bindValue($identifier, $this->media_id, PDO::PARAM_STR);

                        break;
                    case 'is_required':
                        $stmt->bindValue($identifier, $this->is_required, PDO::PARAM_BOOL);

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
        $pos = SurveyQuestionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSurveyquesid();

            case 1:
                return $this->getSurveyquestype();

            case 2:
                return $this->getQuestion();

            case 3:
                return $this->getSurveyquestionopt();

            case 4:
                return $this->getStatus();

            case 5:
                return $this->getCompanyId();

            case 6:
                return $this->getSurveyId();

            case 7:
                return $this->getCreatedAt();

            case 8:
                return $this->getUpdatedAt();

            case 9:
                return $this->getQuestionNumber();

            case 10:
                return $this->getMediaId();

            case 11:
                return $this->getIsRequired();

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
        if (isset($alreadyDumpedObjects['SurveyQuestion'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SurveyQuestion'][$this->hashCode()] = true;
        $keys = SurveyQuestionTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSurveyquesid(),
            $keys[1] => $this->getSurveyquestype(),
            $keys[2] => $this->getQuestion(),
            $keys[3] => $this->getSurveyquestionopt(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getCompanyId(),
            $keys[6] => $this->getSurveyId(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
            $keys[9] => $this->getQuestionNumber(),
            $keys[10] => $this->getMediaId(),
            $keys[11] => $this->getIsRequired(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collSurveySubmitedAnswers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveySubmitedAnswers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'survey_submited_answers';
                        break;
                    default:
                        $key = 'SurveySubmitedAnswers';
                }

                $result[$key] = $this->collSurveySubmitedAnswers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SurveyQuestionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setSurveyquesid($value);
                break;
            case 1:
                $this->setSurveyquestype($value);
                break;
            case 2:
                $this->setQuestion($value);
                break;
            case 3:
                $this->setSurveyquestionopt($value);
                break;
            case 4:
                $this->setStatus($value);
                break;
            case 5:
                $this->setCompanyId($value);
                break;
            case 6:
                $this->setSurveyId($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedAt($value);
                break;
            case 9:
                $this->setQuestionNumber($value);
                break;
            case 10:
                $this->setMediaId($value);
                break;
            case 11:
                $this->setIsRequired($value);
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
        $keys = SurveyQuestionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSurveyquesid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSurveyquestype($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setQuestion($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSurveyquestionopt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCompanyId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSurveyId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setQuestionNumber($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setMediaId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIsRequired($arr[$keys[11]]);
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
        $criteria = new Criteria(SurveyQuestionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SurveyQuestionTableMap::COL_SURVEYQUESID)) {
            $criteria->add(SurveyQuestionTableMap::COL_SURVEYQUESID, $this->surveyquesid);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_SURVEYQUESTYPE)) {
            $criteria->add(SurveyQuestionTableMap::COL_SURVEYQUESTYPE, $this->surveyquestype);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_QUESTION)) {
            $criteria->add(SurveyQuestionTableMap::COL_QUESTION, $this->question);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT)) {
            $criteria->add(SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT, $this->surveyquestionopt);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_STATUS)) {
            $criteria->add(SurveyQuestionTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_COMPANY_ID)) {
            $criteria->add(SurveyQuestionTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_SURVEY_ID)) {
            $criteria->add(SurveyQuestionTableMap::COL_SURVEY_ID, $this->survey_id);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_CREATED_AT)) {
            $criteria->add(SurveyQuestionTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_UPDATED_AT)) {
            $criteria->add(SurveyQuestionTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_QUESTION_NUMBER)) {
            $criteria->add(SurveyQuestionTableMap::COL_QUESTION_NUMBER, $this->question_number);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_MEDIA_ID)) {
            $criteria->add(SurveyQuestionTableMap::COL_MEDIA_ID, $this->media_id);
        }
        if ($this->isColumnModified(SurveyQuestionTableMap::COL_IS_REQUIRED)) {
            $criteria->add(SurveyQuestionTableMap::COL_IS_REQUIRED, $this->is_required);
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
        $criteria = ChildSurveyQuestionQuery::create();
        $criteria->add(SurveyQuestionTableMap::COL_SURVEYQUESID, $this->surveyquesid);

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
        $validPk = null !== $this->getSurveyquesid();

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
        return $this->getSurveyquesid();
    }

    /**
     * Generic method to set the primary key (surveyquesid column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setSurveyquesid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getSurveyquesid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\SurveyQuestion (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSurveyquestype($this->getSurveyquestype());
        $copyObj->setQuestion($this->getQuestion());
        $copyObj->setSurveyquestionopt($this->getSurveyquestionopt());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setSurveyId($this->getSurveyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setQuestionNumber($this->getQuestionNumber());
        $copyObj->setMediaId($this->getMediaId());
        $copyObj->setIsRequired($this->getIsRequired());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSurveySubmitedAnswers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSurveySubmitedAnswer($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setSurveyquesid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\SurveyQuestion Clone of current object.
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
            $v->addSurveyQuestion($this);
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
                $this->aSurvey->addSurveyQuestions($this);
             */
        }

        return $this->aSurvey;
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
            $v->addSurveyQuestion($this);
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
                $this->aCompany->addSurveyQuestions($this);
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
        if ('SurveySubmitedAnswer' === $relationName) {
            $this->initSurveySubmitedAnswers();
            return;
        }
    }

    /**
     * Clears out the collSurveySubmitedAnswers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSurveySubmitedAnswers()
     */
    public function clearSurveySubmitedAnswers()
    {
        $this->collSurveySubmitedAnswers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSurveySubmitedAnswers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSurveySubmitedAnswers($v = true): void
    {
        $this->collSurveySubmitedAnswersPartial = $v;
    }

    /**
     * Initializes the collSurveySubmitedAnswers collection.
     *
     * By default this just sets the collSurveySubmitedAnswers collection to an empty array (like clearcollSurveySubmitedAnswers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSurveySubmitedAnswers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSurveySubmitedAnswers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SurveySubmitedAnswerTableMap::getTableMap()->getCollectionClassName();

        $this->collSurveySubmitedAnswers = new $collectionClassName;
        $this->collSurveySubmitedAnswers->setModel('\entities\SurveySubmitedAnswer');
    }

    /**
     * Gets an array of ChildSurveySubmitedAnswer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSurveyQuestion is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSurveySubmitedAnswer[] List of ChildSurveySubmitedAnswer objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmitedAnswer> List of ChildSurveySubmitedAnswer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurveySubmitedAnswers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSurveySubmitedAnswersPartial && !$this->isNew();
        if (null === $this->collSurveySubmitedAnswers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSurveySubmitedAnswers) {
                    $this->initSurveySubmitedAnswers();
                } else {
                    $collectionClassName = SurveySubmitedAnswerTableMap::getTableMap()->getCollectionClassName();

                    $collSurveySubmitedAnswers = new $collectionClassName;
                    $collSurveySubmitedAnswers->setModel('\entities\SurveySubmitedAnswer');

                    return $collSurveySubmitedAnswers;
                }
            } else {
                $collSurveySubmitedAnswers = ChildSurveySubmitedAnswerQuery::create(null, $criteria)
                    ->filterBySurveyQuestion($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSurveySubmitedAnswersPartial && count($collSurveySubmitedAnswers)) {
                        $this->initSurveySubmitedAnswers(false);

                        foreach ($collSurveySubmitedAnswers as $obj) {
                            if (false == $this->collSurveySubmitedAnswers->contains($obj)) {
                                $this->collSurveySubmitedAnswers->append($obj);
                            }
                        }

                        $this->collSurveySubmitedAnswersPartial = true;
                    }

                    return $collSurveySubmitedAnswers;
                }

                if ($partial && $this->collSurveySubmitedAnswers) {
                    foreach ($this->collSurveySubmitedAnswers as $obj) {
                        if ($obj->isNew()) {
                            $collSurveySubmitedAnswers[] = $obj;
                        }
                    }
                }

                $this->collSurveySubmitedAnswers = $collSurveySubmitedAnswers;
                $this->collSurveySubmitedAnswersPartial = false;
            }
        }

        return $this->collSurveySubmitedAnswers;
    }

    /**
     * Sets a collection of ChildSurveySubmitedAnswer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $surveySubmitedAnswers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSurveySubmitedAnswers(Collection $surveySubmitedAnswers, ?ConnectionInterface $con = null)
    {
        /** @var ChildSurveySubmitedAnswer[] $surveySubmitedAnswersToDelete */
        $surveySubmitedAnswersToDelete = $this->getSurveySubmitedAnswers(new Criteria(), $con)->diff($surveySubmitedAnswers);


        $this->surveySubmitedAnswersScheduledForDeletion = $surveySubmitedAnswersToDelete;

        foreach ($surveySubmitedAnswersToDelete as $surveySubmitedAnswerRemoved) {
            $surveySubmitedAnswerRemoved->setSurveyQuestion(null);
        }

        $this->collSurveySubmitedAnswers = null;
        foreach ($surveySubmitedAnswers as $surveySubmitedAnswer) {
            $this->addSurveySubmitedAnswer($surveySubmitedAnswer);
        }

        $this->collSurveySubmitedAnswers = $surveySubmitedAnswers;
        $this->collSurveySubmitedAnswersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SurveySubmitedAnswer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SurveySubmitedAnswer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSurveySubmitedAnswers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSurveySubmitedAnswersPartial && !$this->isNew();
        if (null === $this->collSurveySubmitedAnswers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSurveySubmitedAnswers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSurveySubmitedAnswers());
            }

            $query = ChildSurveySubmitedAnswerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySurveyQuestion($this)
                ->count($con);
        }

        return count($this->collSurveySubmitedAnswers);
    }

    /**
     * Method called to associate a ChildSurveySubmitedAnswer object to this object
     * through the ChildSurveySubmitedAnswer foreign key attribute.
     *
     * @param ChildSurveySubmitedAnswer $l ChildSurveySubmitedAnswer
     * @return $this The current object (for fluent API support)
     */
    public function addSurveySubmitedAnswer(ChildSurveySubmitedAnswer $l)
    {
        if ($this->collSurveySubmitedAnswers === null) {
            $this->initSurveySubmitedAnswers();
            $this->collSurveySubmitedAnswersPartial = true;
        }

        if (!$this->collSurveySubmitedAnswers->contains($l)) {
            $this->doAddSurveySubmitedAnswer($l);

            if ($this->surveySubmitedAnswersScheduledForDeletion and $this->surveySubmitedAnswersScheduledForDeletion->contains($l)) {
                $this->surveySubmitedAnswersScheduledForDeletion->remove($this->surveySubmitedAnswersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSurveySubmitedAnswer $surveySubmitedAnswer The ChildSurveySubmitedAnswer object to add.
     */
    protected function doAddSurveySubmitedAnswer(ChildSurveySubmitedAnswer $surveySubmitedAnswer): void
    {
        $this->collSurveySubmitedAnswers[]= $surveySubmitedAnswer;
        $surveySubmitedAnswer->setSurveyQuestion($this);
    }

    /**
     * @param ChildSurveySubmitedAnswer $surveySubmitedAnswer The ChildSurveySubmitedAnswer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSurveySubmitedAnswer(ChildSurveySubmitedAnswer $surveySubmitedAnswer)
    {
        if ($this->getSurveySubmitedAnswers()->contains($surveySubmitedAnswer)) {
            $pos = $this->collSurveySubmitedAnswers->search($surveySubmitedAnswer);
            $this->collSurveySubmitedAnswers->remove($pos);
            if (null === $this->surveySubmitedAnswersScheduledForDeletion) {
                $this->surveySubmitedAnswersScheduledForDeletion = clone $this->collSurveySubmitedAnswers;
                $this->surveySubmitedAnswersScheduledForDeletion->clear();
            }
            $this->surveySubmitedAnswersScheduledForDeletion[]= $surveySubmitedAnswer;
            $surveySubmitedAnswer->setSurveyQuestion(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SurveyQuestion is new, it will return
     * an empty collection; or if this SurveyQuestion has previously
     * been saved, it will retrieve related SurveySubmitedAnswers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SurveyQuestion.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmitedAnswer[] List of ChildSurveySubmitedAnswer objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmitedAnswer}> List of ChildSurveySubmitedAnswer objects
     */
    public function getSurveySubmitedAnswersJoinSurveySubmited(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedAnswerQuery::create(null, $criteria);
        $query->joinWith('SurveySubmited', $joinBehavior);

        return $this->getSurveySubmitedAnswers($query, $con);
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
        if (null !== $this->aSurvey) {
            $this->aSurvey->removeSurveyQuestion($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeSurveyQuestion($this);
        }
        $this->surveyquesid = null;
        $this->surveyquestype = null;
        $this->question = null;
        $this->surveyquestionopt = null;
        $this->status = null;
        $this->company_id = null;
        $this->survey_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->question_number = null;
        $this->media_id = null;
        $this->is_required = null;
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
            if ($this->collSurveySubmitedAnswers) {
                foreach ($this->collSurveySubmitedAnswers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSurveySubmitedAnswers = null;
        $this->aSurvey = null;
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
        return (string) $this->exportTo(SurveyQuestionTableMap::DEFAULT_STRING_FORMAT);
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
