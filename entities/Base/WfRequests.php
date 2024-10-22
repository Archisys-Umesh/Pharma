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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\WfDocuments as ChildWfDocuments;
use entities\WfDocumentsQuery as ChildWfDocumentsQuery;
use entities\WfMaster as ChildWfMaster;
use entities\WfMasterQuery as ChildWfMasterQuery;
use entities\WfRequestsQuery as ChildWfRequestsQuery;
use entities\WfSteps as ChildWfSteps;
use entities\WfStepsQuery as ChildWfStepsQuery;
use entities\Map\WfRequestsTableMap;

/**
 * Base class that represents a row from the 'wf_requests' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class WfRequests implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\WfRequestsTableMap';


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
     * The value for the wf_req_id field.
     *
     * @var        int
     */
    protected $wf_req_id;

    /**
     * The value for the wf_company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_company_id;

    /**
     * The value for the wf_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_id;

    /**
     * The value for the wf_doc_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_doc_id;

    /**
     * The value for the wf_doc_pk field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_doc_pk;

    /**
     * The value for the wf_doc_status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_doc_status;

    /**
     * The value for the wf_entity_name field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $wf_entity_name;

    /**
     * The value for the wf_origin_employee field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_origin_employee;

    /**
     * The value for the wf_step_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_step_id;

    /**
     * The value for the wf_step_level field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_step_level;

    /**
     * The value for the wf_req_status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_req_status;

    /**
     * The value for the wf_req_employee field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_req_employee;

    /**
     * The value for the wf_desc field.
     *
     * @var        string|null
     */
    protected $wf_desc;

    /**
     * The value for the wf_route field.
     *
     * @var        string
     */
    protected $wf_route;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the wf_escalation_date field.
     *
     * @var        DateTime|null
     */
    protected $wf_escalation_date;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildWfDocuments
     */
    protected $aWfDocuments;

    /**
     * @var        ChildWfMaster
     */
    protected $aWfMaster;

    /**
     * @var        ChildWfSteps
     */
    protected $aWfSteps;

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
        $this->wf_company_id = 0;
        $this->wf_id = 0;
        $this->wf_doc_id = 0;
        $this->wf_doc_pk = 0;
        $this->wf_doc_status = 0;
        $this->wf_entity_name = '0';
        $this->wf_origin_employee = 0;
        $this->wf_step_id = 0;
        $this->wf_step_level = 0;
        $this->wf_req_status = 0;
        $this->wf_req_employee = 0;
    }

    /**
     * Initializes internal state of entities\Base\WfRequests object.
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
     * Compares this with another <code>WfRequests</code> instance.  If
     * <code>obj</code> is an instance of <code>WfRequests</code>, delegates to
     * <code>equals(WfRequests)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [wf_req_id] column value.
     *
     * @return int
     */
    public function getWfReqId()
    {
        return $this->wf_req_id;
    }

    /**
     * Get the [wf_company_id] column value.
     *
     * @return int
     */
    public function getWfCompanyId()
    {
        return $this->wf_company_id;
    }

    /**
     * Get the [wf_id] column value.
     *
     * @return int
     */
    public function getWfId()
    {
        return $this->wf_id;
    }

    /**
     * Get the [wf_doc_id] column value.
     *
     * @return int
     */
    public function getWfDocId()
    {
        return $this->wf_doc_id;
    }

    /**
     * Get the [wf_doc_pk] column value.
     *
     * @return int
     */
    public function getWfDocPk()
    {
        return $this->wf_doc_pk;
    }

    /**
     * Get the [wf_doc_status] column value.
     *
     * @return int
     */
    public function getWfDocStatus()
    {
        return $this->wf_doc_status;
    }

    /**
     * Get the [wf_entity_name] column value.
     *
     * @return string
     */
    public function getWfEntityName()
    {
        return $this->wf_entity_name;
    }

    /**
     * Get the [wf_origin_employee] column value.
     *
     * @return int
     */
    public function getWfOriginEmployee()
    {
        return $this->wf_origin_employee;
    }

    /**
     * Get the [wf_step_id] column value.
     *
     * @return int
     */
    public function getWfStepId()
    {
        return $this->wf_step_id;
    }

    /**
     * Get the [wf_step_level] column value.
     *
     * @return int
     */
    public function getWfStepLevel()
    {
        return $this->wf_step_level;
    }

    /**
     * Get the [wf_req_status] column value.
     *
     * @return int
     */
    public function getWfReqStatus()
    {
        return $this->wf_req_status;
    }

    /**
     * Get the [wf_req_employee] column value.
     *
     * @return int
     */
    public function getWfReqEmployee()
    {
        return $this->wf_req_employee;
    }

    /**
     * Get the [wf_desc] column value.
     *
     * @return string|null
     */
    public function getWfDesc()
    {
        return $this->wf_desc;
    }

    /**
     * Get the [wf_route] column value.
     *
     * @return string
     */
    public function getWfRoute()
    {
        return $this->wf_route;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL).
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
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
     * Get the [optionally formatted] temporal [wf_escalation_date] column value.
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
    public function getWfEscalationDate($format = null)
    {
        if ($format === null) {
            return $this->wf_escalation_date;
        } else {
            return $this->wf_escalation_date instanceof \DateTimeInterface ? $this->wf_escalation_date->format($format) : null;
        }
    }

    /**
     * Set the value of [wf_req_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfReqId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_req_id !== $v) {
            $this->wf_req_id = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_REQ_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_company_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_company_id !== $v) {
            $this->wf_company_id = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [wf_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_id !== $v) {
            $this->wf_id = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_ID] = true;
        }

        if ($this->aWfMaster !== null && $this->aWfMaster->getWfId() !== $v) {
            $this->aWfMaster = null;
        }

        return $this;
    }

    /**
     * Set the value of [wf_doc_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfDocId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_doc_id !== $v) {
            $this->wf_doc_id = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_DOC_ID] = true;
        }

        if ($this->aWfDocuments !== null && $this->aWfDocuments->getWfDocId() !== $v) {
            $this->aWfDocuments = null;
        }

        return $this;
    }

    /**
     * Set the value of [wf_doc_pk] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfDocPk($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_doc_pk !== $v) {
            $this->wf_doc_pk = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_DOC_PK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_doc_status] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfDocStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_doc_status !== $v) {
            $this->wf_doc_status = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_DOC_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_entity_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfEntityName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_entity_name !== $v) {
            $this->wf_entity_name = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_ENTITY_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_origin_employee] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfOriginEmployee($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_origin_employee !== $v) {
            $this->wf_origin_employee = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_step_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfStepId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_step_id !== $v) {
            $this->wf_step_id = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_STEP_ID] = true;
        }

        if ($this->aWfSteps !== null && $this->aWfSteps->getWfStepsId() !== $v) {
            $this->aWfSteps = null;
        }

        return $this;
    }

    /**
     * Set the value of [wf_step_level] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfStepLevel($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_step_level !== $v) {
            $this->wf_step_level = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_STEP_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_req_status] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfReqStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_req_status !== $v) {
            $this->wf_req_status = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_REQ_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_req_employee] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfReqEmployee($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_req_employee !== $v) {
            $this->wf_req_employee = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_REQ_EMPLOYEE] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Set the value of [wf_desc] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_desc !== $v) {
            $this->wf_desc = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_DESC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_route] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfRoute($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_route !== $v) {
            $this->wf_route = $v;
            $this->modifiedColumns[WfRequestsTableMap::COL_WF_ROUTE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WfRequestsTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [wf_escalation_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setWfEscalationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->wf_escalation_date !== null || $dt !== null) {
            if ($this->wf_escalation_date === null || $dt === null || $dt->format("Y-m-d") !== $this->wf_escalation_date->format("Y-m-d")) {
                $this->wf_escalation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WfRequestsTableMap::COL_WF_ESCALATION_DATE] = true;
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
            if ($this->wf_company_id !== 0) {
                return false;
            }

            if ($this->wf_id !== 0) {
                return false;
            }

            if ($this->wf_doc_id !== 0) {
                return false;
            }

            if ($this->wf_doc_pk !== 0) {
                return false;
            }

            if ($this->wf_doc_status !== 0) {
                return false;
            }

            if ($this->wf_entity_name !== '0') {
                return false;
            }

            if ($this->wf_origin_employee !== 0) {
                return false;
            }

            if ($this->wf_step_id !== 0) {
                return false;
            }

            if ($this->wf_step_level !== 0) {
                return false;
            }

            if ($this->wf_req_status !== 0) {
                return false;
            }

            if ($this->wf_req_employee !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WfRequestsTableMap::translateFieldName('WfReqId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_req_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WfRequestsTableMap::translateFieldName('WfCompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WfRequestsTableMap::translateFieldName('WfId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WfRequestsTableMap::translateFieldName('WfDocId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_doc_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WfRequestsTableMap::translateFieldName('WfDocPk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_doc_pk = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WfRequestsTableMap::translateFieldName('WfDocStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_doc_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WfRequestsTableMap::translateFieldName('WfEntityName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_entity_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WfRequestsTableMap::translateFieldName('WfOriginEmployee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_origin_employee = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WfRequestsTableMap::translateFieldName('WfStepId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_step_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WfRequestsTableMap::translateFieldName('WfStepLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_step_level = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WfRequestsTableMap::translateFieldName('WfReqStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_req_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : WfRequestsTableMap::translateFieldName('WfReqEmployee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_req_employee = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : WfRequestsTableMap::translateFieldName('WfDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : WfRequestsTableMap::translateFieldName('WfRoute', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_route = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : WfRequestsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : WfRequestsTableMap::translateFieldName('WfEscalationDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_escalation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = WfRequestsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\WfRequests'), 0, $e);
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
        if ($this->aCompany !== null && $this->wf_company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aWfMaster !== null && $this->wf_id !== $this->aWfMaster->getWfId()) {
            $this->aWfMaster = null;
        }
        if ($this->aWfDocuments !== null && $this->wf_doc_id !== $this->aWfDocuments->getWfDocId()) {
            $this->aWfDocuments = null;
        }
        if ($this->aWfSteps !== null && $this->wf_step_id !== $this->aWfSteps->getWfStepsId()) {
            $this->aWfSteps = null;
        }
        if ($this->aEmployee !== null && $this->wf_req_employee !== $this->aEmployee->getEmployeeId()) {
            $this->aEmployee = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(WfRequestsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWfRequestsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aEmployee = null;
            $this->aWfDocuments = null;
            $this->aWfMaster = null;
            $this->aWfSteps = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see WfRequests::setDeleted()
     * @see WfRequests::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfRequestsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWfRequestsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WfRequestsTableMap::DATABASE_NAME);
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
                WfRequestsTableMap::addInstanceToPool($this);
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

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->aWfDocuments !== null) {
                if ($this->aWfDocuments->isModified() || $this->aWfDocuments->isNew()) {
                    $affectedRows += $this->aWfDocuments->save($con);
                }
                $this->setWfDocuments($this->aWfDocuments);
            }

            if ($this->aWfMaster !== null) {
                if ($this->aWfMaster->isModified() || $this->aWfMaster->isNew()) {
                    $affectedRows += $this->aWfMaster->save($con);
                }
                $this->setWfMaster($this->aWfMaster);
            }

            if ($this->aWfSteps !== null) {
                if ($this->aWfSteps->isModified() || $this->aWfSteps->isNew()) {
                    $affectedRows += $this->aWfSteps->save($con);
                }
                $this->setWfSteps($this->aWfSteps);
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

        $this->modifiedColumns[WfRequestsTableMap::COL_WF_REQ_ID] = true;
        if (null !== $this->wf_req_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WfRequestsTableMap::COL_WF_REQ_ID . ')');
        }
        if (null === $this->wf_req_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('wf_requests_wf_req_id_seq')");
                $this->wf_req_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_REQ_ID)) {
            $modifiedColumns[':p' . $index++]  = 'wf_req_id';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'wf_company_id';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ID)) {
            $modifiedColumns[':p' . $index++]  = 'wf_id';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_DOC_ID)) {
            $modifiedColumns[':p' . $index++]  = 'wf_doc_id';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_DOC_PK)) {
            $modifiedColumns[':p' . $index++]  = 'wf_doc_pk';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_DOC_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'wf_doc_status';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ENTITY_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'wf_entity_name';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE)) {
            $modifiedColumns[':p' . $index++]  = 'wf_origin_employee';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_STEP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'wf_step_id';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_STEP_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'wf_step_level';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_REQ_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'wf_req_status';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE)) {
            $modifiedColumns[':p' . $index++]  = 'wf_req_employee';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_DESC)) {
            $modifiedColumns[':p' . $index++]  = 'wf_desc';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ROUTE)) {
            $modifiedColumns[':p' . $index++]  = 'wf_route';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ESCALATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'wf_escalation_date';
        }

        $sql = sprintf(
            'INSERT INTO wf_requests (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'wf_req_id':
                        $stmt->bindValue($identifier, $this->wf_req_id, PDO::PARAM_INT);

                        break;
                    case 'wf_company_id':
                        $stmt->bindValue($identifier, $this->wf_company_id, PDO::PARAM_INT);

                        break;
                    case 'wf_id':
                        $stmt->bindValue($identifier, $this->wf_id, PDO::PARAM_INT);

                        break;
                    case 'wf_doc_id':
                        $stmt->bindValue($identifier, $this->wf_doc_id, PDO::PARAM_INT);

                        break;
                    case 'wf_doc_pk':
                        $stmt->bindValue($identifier, $this->wf_doc_pk, PDO::PARAM_INT);

                        break;
                    case 'wf_doc_status':
                        $stmt->bindValue($identifier, $this->wf_doc_status, PDO::PARAM_INT);

                        break;
                    case 'wf_entity_name':
                        $stmt->bindValue($identifier, $this->wf_entity_name, PDO::PARAM_STR);

                        break;
                    case 'wf_origin_employee':
                        $stmt->bindValue($identifier, $this->wf_origin_employee, PDO::PARAM_INT);

                        break;
                    case 'wf_step_id':
                        $stmt->bindValue($identifier, $this->wf_step_id, PDO::PARAM_INT);

                        break;
                    case 'wf_step_level':
                        $stmt->bindValue($identifier, $this->wf_step_level, PDO::PARAM_INT);

                        break;
                    case 'wf_req_status':
                        $stmt->bindValue($identifier, $this->wf_req_status, PDO::PARAM_INT);

                        break;
                    case 'wf_req_employee':
                        $stmt->bindValue($identifier, $this->wf_req_employee, PDO::PARAM_INT);

                        break;
                    case 'wf_desc':
                        $stmt->bindValue($identifier, $this->wf_desc, PDO::PARAM_STR);

                        break;
                    case 'wf_route':
                        $stmt->bindValue($identifier, $this->wf_route, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'wf_escalation_date':
                        $stmt->bindValue($identifier, $this->wf_escalation_date ? $this->wf_escalation_date->format("Y-m-d") : null, PDO::PARAM_STR);

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
        $pos = WfRequestsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getWfReqId();

            case 1:
                return $this->getWfCompanyId();

            case 2:
                return $this->getWfId();

            case 3:
                return $this->getWfDocId();

            case 4:
                return $this->getWfDocPk();

            case 5:
                return $this->getWfDocStatus();

            case 6:
                return $this->getWfEntityName();

            case 7:
                return $this->getWfOriginEmployee();

            case 8:
                return $this->getWfStepId();

            case 9:
                return $this->getWfStepLevel();

            case 10:
                return $this->getWfReqStatus();

            case 11:
                return $this->getWfReqEmployee();

            case 12:
                return $this->getWfDesc();

            case 13:
                return $this->getWfRoute();

            case 14:
                return $this->getCreatedAt();

            case 15:
                return $this->getWfEscalationDate();

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
        if (isset($alreadyDumpedObjects['WfRequests'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['WfRequests'][$this->hashCode()] = true;
        $keys = WfRequestsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getWfReqId(),
            $keys[1] => $this->getWfCompanyId(),
            $keys[2] => $this->getWfId(),
            $keys[3] => $this->getWfDocId(),
            $keys[4] => $this->getWfDocPk(),
            $keys[5] => $this->getWfDocStatus(),
            $keys[6] => $this->getWfEntityName(),
            $keys[7] => $this->getWfOriginEmployee(),
            $keys[8] => $this->getWfStepId(),
            $keys[9] => $this->getWfStepLevel(),
            $keys[10] => $this->getWfReqStatus(),
            $keys[11] => $this->getWfReqEmployee(),
            $keys[12] => $this->getWfDesc(),
            $keys[13] => $this->getWfRoute(),
            $keys[14] => $this->getCreatedAt(),
            $keys[15] => $this->getWfEscalationDate(),
        ];
        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('Y-m-d');
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
            if (null !== $this->aEmployee) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployee->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aWfDocuments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfDocuments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_documents';
                        break;
                    default:
                        $key = 'WfDocuments';
                }

                $result[$key] = $this->aWfDocuments->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aWfMaster) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfMaster';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_master';
                        break;
                    default:
                        $key = 'WfMaster';
                }

                $result[$key] = $this->aWfMaster->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aWfSteps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfSteps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_steps';
                        break;
                    default:
                        $key = 'WfSteps';
                }

                $result[$key] = $this->aWfSteps->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = WfRequestsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setWfReqId($value);
                break;
            case 1:
                $this->setWfCompanyId($value);
                break;
            case 2:
                $this->setWfId($value);
                break;
            case 3:
                $this->setWfDocId($value);
                break;
            case 4:
                $this->setWfDocPk($value);
                break;
            case 5:
                $this->setWfDocStatus($value);
                break;
            case 6:
                $this->setWfEntityName($value);
                break;
            case 7:
                $this->setWfOriginEmployee($value);
                break;
            case 8:
                $this->setWfStepId($value);
                break;
            case 9:
                $this->setWfStepLevel($value);
                break;
            case 10:
                $this->setWfReqStatus($value);
                break;
            case 11:
                $this->setWfReqEmployee($value);
                break;
            case 12:
                $this->setWfDesc($value);
                break;
            case 13:
                $this->setWfRoute($value);
                break;
            case 14:
                $this->setCreatedAt($value);
                break;
            case 15:
                $this->setWfEscalationDate($value);
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
        $keys = WfRequestsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setWfReqId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setWfCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setWfId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setWfDocId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setWfDocPk($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setWfDocStatus($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setWfEntityName($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setWfOriginEmployee($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setWfStepId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setWfStepLevel($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setWfReqStatus($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setWfReqEmployee($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setWfDesc($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setWfRoute($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCreatedAt($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setWfEscalationDate($arr[$keys[15]]);
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
        $criteria = new Criteria(WfRequestsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_REQ_ID)) {
            $criteria->add(WfRequestsTableMap::COL_WF_REQ_ID, $this->wf_req_id);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_COMPANY_ID)) {
            $criteria->add(WfRequestsTableMap::COL_WF_COMPANY_ID, $this->wf_company_id);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ID)) {
            $criteria->add(WfRequestsTableMap::COL_WF_ID, $this->wf_id);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_DOC_ID)) {
            $criteria->add(WfRequestsTableMap::COL_WF_DOC_ID, $this->wf_doc_id);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_DOC_PK)) {
            $criteria->add(WfRequestsTableMap::COL_WF_DOC_PK, $this->wf_doc_pk);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_DOC_STATUS)) {
            $criteria->add(WfRequestsTableMap::COL_WF_DOC_STATUS, $this->wf_doc_status);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ENTITY_NAME)) {
            $criteria->add(WfRequestsTableMap::COL_WF_ENTITY_NAME, $this->wf_entity_name);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE)) {
            $criteria->add(WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE, $this->wf_origin_employee);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_STEP_ID)) {
            $criteria->add(WfRequestsTableMap::COL_WF_STEP_ID, $this->wf_step_id);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_STEP_LEVEL)) {
            $criteria->add(WfRequestsTableMap::COL_WF_STEP_LEVEL, $this->wf_step_level);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_REQ_STATUS)) {
            $criteria->add(WfRequestsTableMap::COL_WF_REQ_STATUS, $this->wf_req_status);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE)) {
            $criteria->add(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE, $this->wf_req_employee);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_DESC)) {
            $criteria->add(WfRequestsTableMap::COL_WF_DESC, $this->wf_desc);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ROUTE)) {
            $criteria->add(WfRequestsTableMap::COL_WF_ROUTE, $this->wf_route);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_CREATED_AT)) {
            $criteria->add(WfRequestsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(WfRequestsTableMap::COL_WF_ESCALATION_DATE)) {
            $criteria->add(WfRequestsTableMap::COL_WF_ESCALATION_DATE, $this->wf_escalation_date);
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
        $criteria = ChildWfRequestsQuery::create();
        $criteria->add(WfRequestsTableMap::COL_WF_REQ_ID, $this->wf_req_id);

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
        $validPk = null !== $this->getWfReqId();

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
        return $this->getWfReqId();
    }

    /**
     * Generic method to set the primary key (wf_req_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setWfReqId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getWfReqId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\WfRequests (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setWfCompanyId($this->getWfCompanyId());
        $copyObj->setWfId($this->getWfId());
        $copyObj->setWfDocId($this->getWfDocId());
        $copyObj->setWfDocPk($this->getWfDocPk());
        $copyObj->setWfDocStatus($this->getWfDocStatus());
        $copyObj->setWfEntityName($this->getWfEntityName());
        $copyObj->setWfOriginEmployee($this->getWfOriginEmployee());
        $copyObj->setWfStepId($this->getWfStepId());
        $copyObj->setWfStepLevel($this->getWfStepLevel());
        $copyObj->setWfReqStatus($this->getWfReqStatus());
        $copyObj->setWfReqEmployee($this->getWfReqEmployee());
        $copyObj->setWfDesc($this->getWfDesc());
        $copyObj->setWfRoute($this->getWfRoute());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setWfEscalationDate($this->getWfEscalationDate());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setWfReqId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\WfRequests Clone of current object.
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
            $this->setWfCompanyId(0);
        } else {
            $this->setWfCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addWfRequests($this);
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
        if ($this->aCompany === null && ($this->wf_company_id != 0)) {
            $this->aCompany = ChildCompanyQuery::create()->findPk($this->wf_company_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompany->addWfRequestss($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployee(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setWfReqEmployee(0);
        } else {
            $this->setWfReqEmployee($v->getEmployeeId());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addWfRequests($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployee(?ConnectionInterface $con = null)
    {
        if ($this->aEmployee === null && ($this->wf_req_employee != 0)) {
            $this->aEmployee = ChildEmployeeQuery::create()->findPk($this->wf_req_employee, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployee->addWfRequestss($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildWfDocuments object.
     *
     * @param ChildWfDocuments $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setWfDocuments(ChildWfDocuments $v = null)
    {
        if ($v === null) {
            $this->setWfDocId(0);
        } else {
            $this->setWfDocId($v->getWfDocId());
        }

        $this->aWfDocuments = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildWfDocuments object, it will not be re-added.
        if ($v !== null) {
            $v->addWfRequests($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildWfDocuments object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildWfDocuments The associated ChildWfDocuments object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfDocuments(?ConnectionInterface $con = null)
    {
        if ($this->aWfDocuments === null && ($this->wf_doc_id != 0)) {
            $this->aWfDocuments = ChildWfDocumentsQuery::create()->findPk($this->wf_doc_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aWfDocuments->addWfRequestss($this);
             */
        }

        return $this->aWfDocuments;
    }

    /**
     * Declares an association between this object and a ChildWfMaster object.
     *
     * @param ChildWfMaster $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setWfMaster(ChildWfMaster $v = null)
    {
        if ($v === null) {
            $this->setWfId(0);
        } else {
            $this->setWfId($v->getWfId());
        }

        $this->aWfMaster = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildWfMaster object, it will not be re-added.
        if ($v !== null) {
            $v->addWfRequests($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildWfMaster object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildWfMaster The associated ChildWfMaster object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfMaster(?ConnectionInterface $con = null)
    {
        if ($this->aWfMaster === null && ($this->wf_id != 0)) {
            $this->aWfMaster = ChildWfMasterQuery::create()->findPk($this->wf_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aWfMaster->addWfRequestss($this);
             */
        }

        return $this->aWfMaster;
    }

    /**
     * Declares an association between this object and a ChildWfSteps object.
     *
     * @param ChildWfSteps $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setWfSteps(ChildWfSteps $v = null)
    {
        if ($v === null) {
            $this->setWfStepId(0);
        } else {
            $this->setWfStepId($v->getWfStepsId());
        }

        $this->aWfSteps = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildWfSteps object, it will not be re-added.
        if ($v !== null) {
            $v->addWfRequests($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildWfSteps object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildWfSteps The associated ChildWfSteps object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfSteps(?ConnectionInterface $con = null)
    {
        if ($this->aWfSteps === null && ($this->wf_step_id != 0)) {
            $this->aWfSteps = ChildWfStepsQuery::create()->findPk($this->wf_step_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aWfSteps->addWfRequestss($this);
             */
        }

        return $this->aWfSteps;
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
            $this->aCompany->removeWfRequests($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeWfRequests($this);
        }
        if (null !== $this->aWfDocuments) {
            $this->aWfDocuments->removeWfRequests($this);
        }
        if (null !== $this->aWfMaster) {
            $this->aWfMaster->removeWfRequests($this);
        }
        if (null !== $this->aWfSteps) {
            $this->aWfSteps->removeWfRequests($this);
        }
        $this->wf_req_id = null;
        $this->wf_company_id = null;
        $this->wf_id = null;
        $this->wf_doc_id = null;
        $this->wf_doc_pk = null;
        $this->wf_doc_status = null;
        $this->wf_entity_name = null;
        $this->wf_origin_employee = null;
        $this->wf_step_id = null;
        $this->wf_step_level = null;
        $this->wf_req_status = null;
        $this->wf_req_employee = null;
        $this->wf_desc = null;
        $this->wf_route = null;
        $this->created_at = null;
        $this->wf_escalation_date = null;
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

        $this->aCompany = null;
        $this->aEmployee = null;
        $this->aWfDocuments = null;
        $this->aWfMaster = null;
        $this->aWfSteps = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WfRequestsTableMap::DEFAULT_STRING_FORMAT);
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
