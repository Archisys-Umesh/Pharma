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
use entities\AnnouncementEmployeeMap as ChildAnnouncementEmployeeMap;
use entities\AnnouncementEmployeeMapQuery as ChildAnnouncementEmployeeMapQuery;
use entities\Announcements as ChildAnnouncements;
use entities\AnnouncementsQuery as ChildAnnouncementsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Map\AnnouncementEmployeeMapTableMap;
use entities\Map\AnnouncementsTableMap;

/**
 * Base class that represents a row from the 'announcements' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Announcements implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\AnnouncementsTableMap';


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
     * The value for the announcement_id field.
     *
     * @var        int
     */
    protected $announcement_id;

    /**
     * The value for the announcement_message field.
     *
     * @var        string|null
     */
    protected $announcement_message;

    /**
     * The value for the announcement_title field.
     *
     * @var        string|null
     */
    protected $announcement_title;

    /**
     * The value for the announcement_stdate field.
     *
     * @var        DateTime|null
     */
    protected $announcement_stdate;

    /**
     * The value for the announcement_edate field.
     *
     * @var        DateTime|null
     */
    protected $announcement_edate;

    /**
     * The value for the branches field.
     *
     * @var        string|null
     */
    protected $branches;

    /**
     * The value for the designations field.
     *
     * @var        string|null
     */
    protected $designations;

    /**
     * The value for the org_units field.
     *
     * @var        string|null
     */
    protected $org_units;

    /**
     * The value for the company_id field.
     *
     * @var        int
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
     * The value for the announcement_status field.
     *
     * @var        string|null
     */
    protected $announcement_status;

    /**
     * The value for the announcements_url field.
     *
     * @var        string|null
     */
    protected $announcements_url;

    /**
     * The value for the is_employee_mapped field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $is_employee_mapped;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildAnnouncementEmployeeMap[] Collection to store aggregation of ChildAnnouncementEmployeeMap objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAnnouncementEmployeeMap> Collection to store aggregation of ChildAnnouncementEmployeeMap objects.
     */
    protected $collAnnouncementEmployeeMaps;
    protected $collAnnouncementEmployeeMapsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAnnouncementEmployeeMap[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAnnouncementEmployeeMap>
     */
    protected $announcementEmployeeMapsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_employee_mapped = true;
    }

    /**
     * Initializes internal state of entities\Base\Announcements object.
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
     * Compares this with another <code>Announcements</code> instance.  If
     * <code>obj</code> is an instance of <code>Announcements</code>, delegates to
     * <code>equals(Announcements)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [announcement_id] column value.
     *
     * @return int
     */
    public function getAnnouncementId()
    {
        return $this->announcement_id;
    }

    /**
     * Get the [announcement_message] column value.
     *
     * @return string|null
     */
    public function getAnnouncementMessage()
    {
        return $this->announcement_message;
    }

    /**
     * Get the [announcement_title] column value.
     *
     * @return string|null
     */
    public function getAnnouncementTitle()
    {
        return $this->announcement_title;
    }

    /**
     * Get the [optionally formatted] temporal [announcement_stdate] column value.
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
    public function getAnnouncementStdate($format = null)
    {
        if ($format === null) {
            return $this->announcement_stdate;
        } else {
            return $this->announcement_stdate instanceof \DateTimeInterface ? $this->announcement_stdate->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [announcement_edate] column value.
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
    public function getAnnouncementEdate($format = null)
    {
        if ($format === null) {
            return $this->announcement_edate;
        } else {
            return $this->announcement_edate instanceof \DateTimeInterface ? $this->announcement_edate->format($format) : null;
        }
    }

    /**
     * Get the [branches] column value.
     *
     * @return string|null
     */
    public function getBranches()
    {
        return $this->branches;
    }

    /**
     * Get the [designations] column value.
     *
     * @return string|null
     */
    public function getDesignations()
    {
        return $this->designations;
    }

    /**
     * Get the [org_units] column value.
     *
     * @return string|null
     */
    public function getOrgUnits()
    {
        return $this->org_units;
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
     * Get the [announcement_status] column value.
     *
     * @return string|null
     */
    public function getAnnouncementStatus()
    {
        return $this->announcement_status;
    }

    /**
     * Get the [announcements_url] column value.
     *
     * @return string|null
     */
    public function getAnnouncementsUrl()
    {
        return $this->announcements_url;
    }

    /**
     * Get the [is_employee_mapped] column value.
     *
     * @return boolean|null
     */
    public function getIsEmployeeMapped()
    {
        return $this->is_employee_mapped;
    }

    /**
     * Get the [is_employee_mapped] column value.
     *
     * @return boolean|null
     */
    public function isEmployeeMapped()
    {
        return $this->getIsEmployeeMapped();
    }

    /**
     * Set the value of [announcement_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->announcement_id !== $v) {
            $this->announcement_id = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_ANNOUNCEMENT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [announcement_message] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementMessage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->announcement_message !== $v) {
            $this->announcement_message = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [announcement_title] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->announcement_title !== $v) {
            $this->announcement_title = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [announcement_stdate] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementStdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->announcement_stdate !== null || $dt !== null) {
            if ($this->announcement_stdate === null || $dt === null || $dt->format("Y-m-d") !== $this->announcement_stdate->format("Y-m-d")) {
                $this->announcement_stdate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [announcement_edate] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementEdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->announcement_edate !== null || $dt !== null) {
            if ($this->announcement_edate === null || $dt === null || $dt->format("Y-m-d") !== $this->announcement_edate->format("Y-m-d")) {
                $this->announcement_edate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [branches] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBranches($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->branches !== $v) {
            $this->branches = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_BRANCHES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [designations] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDesignations($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->designations !== $v) {
            $this->designations = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_DESIGNATIONS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_units] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnits($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->org_units !== $v) {
            $this->org_units = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_ORG_UNITS] = true;
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
            $this->modifiedColumns[AnnouncementsTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[AnnouncementsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[AnnouncementsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [announcement_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->announcement_status !== $v) {
            $this->announcement_status = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [announcements_url] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementsUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->announcements_url !== $v) {
            $this->announcements_url = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_employee_mapped] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsEmployeeMapped($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_employee_mapped !== $v) {
            $this->is_employee_mapped = $v;
            $this->modifiedColumns[AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED] = true;
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
            if ($this->is_employee_mapped !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AnnouncementsTableMap::translateFieldName('AnnouncementId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->announcement_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AnnouncementsTableMap::translateFieldName('AnnouncementMessage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->announcement_message = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AnnouncementsTableMap::translateFieldName('AnnouncementTitle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->announcement_title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AnnouncementsTableMap::translateFieldName('AnnouncementStdate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->announcement_stdate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AnnouncementsTableMap::translateFieldName('AnnouncementEdate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->announcement_edate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AnnouncementsTableMap::translateFieldName('Branches', TableMap::TYPE_PHPNAME, $indexType)];
            $this->branches = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AnnouncementsTableMap::translateFieldName('Designations', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designations = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AnnouncementsTableMap::translateFieldName('OrgUnits', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_units = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AnnouncementsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AnnouncementsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : AnnouncementsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : AnnouncementsTableMap::translateFieldName('AnnouncementStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->announcement_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : AnnouncementsTableMap::translateFieldName('AnnouncementsUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->announcements_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : AnnouncementsTableMap::translateFieldName('IsEmployeeMapped', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_employee_mapped = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = AnnouncementsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Announcements'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(AnnouncementsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAnnouncementsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->collAnnouncementEmployeeMaps = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Announcements::setDeleted()
     * @see Announcements::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAnnouncementsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementsTableMap::DATABASE_NAME);
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
                AnnouncementsTableMap::addInstanceToPool($this);
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

            if ($this->announcementEmployeeMapsScheduledForDeletion !== null) {
                if (!$this->announcementEmployeeMapsScheduledForDeletion->isEmpty()) {
                    foreach ($this->announcementEmployeeMapsScheduledForDeletion as $announcementEmployeeMap) {
                        // need to save related object because we set the relation to null
                        $announcementEmployeeMap->save($con);
                    }
                    $this->announcementEmployeeMapsScheduledForDeletion = null;
                }
            }

            if ($this->collAnnouncementEmployeeMaps !== null) {
                foreach ($this->collAnnouncementEmployeeMaps as $referrerFK) {
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

        $this->modifiedColumns[AnnouncementsTableMap::COL_ANNOUNCEMENT_ID] = true;
        if (null !== $this->announcement_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AnnouncementsTableMap::COL_ANNOUNCEMENT_ID . ')');
        }
        if (null === $this->announcement_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('announcements_announcement_id_seq')");
                $this->announcement_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'announcement_id';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = 'announcement_message';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'announcement_title';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE)) {
            $modifiedColumns[':p' . $index++]  = 'announcement_stdate';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE)) {
            $modifiedColumns[':p' . $index++]  = 'announcement_edate';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_BRANCHES)) {
            $modifiedColumns[':p' . $index++]  = 'branches';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_DESIGNATIONS)) {
            $modifiedColumns[':p' . $index++]  = 'designations';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ORG_UNITS)) {
            $modifiedColumns[':p' . $index++]  = 'org_units';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'announcement_status';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL)) {
            $modifiedColumns[':p' . $index++]  = 'announcements_url';
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED)) {
            $modifiedColumns[':p' . $index++]  = 'is_employee_mapped';
        }

        $sql = sprintf(
            'INSERT INTO announcements (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'announcement_id':
                        $stmt->bindValue($identifier, $this->announcement_id, PDO::PARAM_INT);

                        break;
                    case 'announcement_message':
                        $stmt->bindValue($identifier, $this->announcement_message, PDO::PARAM_STR);

                        break;
                    case 'announcement_title':
                        $stmt->bindValue($identifier, $this->announcement_title, PDO::PARAM_STR);

                        break;
                    case 'announcement_stdate':
                        $stmt->bindValue($identifier, $this->announcement_stdate ? $this->announcement_stdate->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'announcement_edate':
                        $stmt->bindValue($identifier, $this->announcement_edate ? $this->announcement_edate->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'branches':
                        $stmt->bindValue($identifier, $this->branches, PDO::PARAM_STR);

                        break;
                    case 'designations':
                        $stmt->bindValue($identifier, $this->designations, PDO::PARAM_STR);

                        break;
                    case 'org_units':
                        $stmt->bindValue($identifier, $this->org_units, PDO::PARAM_STR);

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
                    case 'announcement_status':
                        $stmt->bindValue($identifier, $this->announcement_status, PDO::PARAM_STR);

                        break;
                    case 'announcements_url':
                        $stmt->bindValue($identifier, $this->announcements_url, PDO::PARAM_STR);

                        break;
                    case 'is_employee_mapped':
                        $stmt->bindValue($identifier, $this->is_employee_mapped, PDO::PARAM_BOOL);

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
        $pos = AnnouncementsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAnnouncementId();

            case 1:
                return $this->getAnnouncementMessage();

            case 2:
                return $this->getAnnouncementTitle();

            case 3:
                return $this->getAnnouncementStdate();

            case 4:
                return $this->getAnnouncementEdate();

            case 5:
                return $this->getBranches();

            case 6:
                return $this->getDesignations();

            case 7:
                return $this->getOrgUnits();

            case 8:
                return $this->getCompanyId();

            case 9:
                return $this->getCreatedAt();

            case 10:
                return $this->getUpdatedAt();

            case 11:
                return $this->getAnnouncementStatus();

            case 12:
                return $this->getAnnouncementsUrl();

            case 13:
                return $this->getIsEmployeeMapped();

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
        if (isset($alreadyDumpedObjects['Announcements'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Announcements'][$this->hashCode()] = true;
        $keys = AnnouncementsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getAnnouncementId(),
            $keys[1] => $this->getAnnouncementMessage(),
            $keys[2] => $this->getAnnouncementTitle(),
            $keys[3] => $this->getAnnouncementStdate(),
            $keys[4] => $this->getAnnouncementEdate(),
            $keys[5] => $this->getBranches(),
            $keys[6] => $this->getDesignations(),
            $keys[7] => $this->getOrgUnits(),
            $keys[8] => $this->getCompanyId(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
            $keys[11] => $this->getAnnouncementStatus(),
            $keys[12] => $this->getAnnouncementsUrl(),
            $keys[13] => $this->getIsEmployeeMapped(),
        ];
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->collAnnouncementEmployeeMaps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'announcementEmployeeMaps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'announcement_employee_maps';
                        break;
                    default:
                        $key = 'AnnouncementEmployeeMaps';
                }

                $result[$key] = $this->collAnnouncementEmployeeMaps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = AnnouncementsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setAnnouncementId($value);
                break;
            case 1:
                $this->setAnnouncementMessage($value);
                break;
            case 2:
                $this->setAnnouncementTitle($value);
                break;
            case 3:
                $this->setAnnouncementStdate($value);
                break;
            case 4:
                $this->setAnnouncementEdate($value);
                break;
            case 5:
                $this->setBranches($value);
                break;
            case 6:
                $this->setDesignations($value);
                break;
            case 7:
                $this->setOrgUnits($value);
                break;
            case 8:
                $this->setCompanyId($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
                break;
            case 11:
                $this->setAnnouncementStatus($value);
                break;
            case 12:
                $this->setAnnouncementsUrl($value);
                break;
            case 13:
                $this->setIsEmployeeMapped($value);
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
        $keys = AnnouncementsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setAnnouncementId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAnnouncementMessage($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAnnouncementTitle($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAnnouncementStdate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAnnouncementEdate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setBranches($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDesignations($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setOrgUnits($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCompanyId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCreatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUpdatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setAnnouncementStatus($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setAnnouncementsUrl($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setIsEmployeeMapped($arr[$keys[13]]);
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
        $criteria = new Criteria(AnnouncementsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID)) {
            $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $this->announcement_id);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE)) {
            $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE, $this->announcement_message);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE)) {
            $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE, $this->announcement_title);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE)) {
            $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE, $this->announcement_stdate);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE)) {
            $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE, $this->announcement_edate);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_BRANCHES)) {
            $criteria->add(AnnouncementsTableMap::COL_BRANCHES, $this->branches);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_DESIGNATIONS)) {
            $criteria->add(AnnouncementsTableMap::COL_DESIGNATIONS, $this->designations);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ORG_UNITS)) {
            $criteria->add(AnnouncementsTableMap::COL_ORG_UNITS, $this->org_units);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_COMPANY_ID)) {
            $criteria->add(AnnouncementsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_CREATED_AT)) {
            $criteria->add(AnnouncementsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_UPDATED_AT)) {
            $criteria->add(AnnouncementsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS)) {
            $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS, $this->announcement_status);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL)) {
            $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL, $this->announcements_url);
        }
        if ($this->isColumnModified(AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED)) {
            $criteria->add(AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED, $this->is_employee_mapped);
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
        $criteria = ChildAnnouncementsQuery::create();
        $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $this->announcement_id);

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
        $validPk = null !== $this->getAnnouncementId();

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
        return $this->getAnnouncementId();
    }

    /**
     * Generic method to set the primary key (announcement_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setAnnouncementId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getAnnouncementId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Announcements (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setAnnouncementMessage($this->getAnnouncementMessage());
        $copyObj->setAnnouncementTitle($this->getAnnouncementTitle());
        $copyObj->setAnnouncementStdate($this->getAnnouncementStdate());
        $copyObj->setAnnouncementEdate($this->getAnnouncementEdate());
        $copyObj->setBranches($this->getBranches());
        $copyObj->setDesignations($this->getDesignations());
        $copyObj->setOrgUnits($this->getOrgUnits());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setAnnouncementStatus($this->getAnnouncementStatus());
        $copyObj->setAnnouncementsUrl($this->getAnnouncementsUrl());
        $copyObj->setIsEmployeeMapped($this->getIsEmployeeMapped());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAnnouncementEmployeeMaps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAnnouncementEmployeeMap($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setAnnouncementId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Announcements Clone of current object.
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
            $v->addAnnouncements($this);
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
                $this->aCompany->addAnnouncementss($this);
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
        if ('AnnouncementEmployeeMap' === $relationName) {
            $this->initAnnouncementEmployeeMaps();
            return;
        }
    }

    /**
     * Clears out the collAnnouncementEmployeeMaps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAnnouncementEmployeeMaps()
     */
    public function clearAnnouncementEmployeeMaps()
    {
        $this->collAnnouncementEmployeeMaps = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAnnouncementEmployeeMaps collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAnnouncementEmployeeMaps($v = true): void
    {
        $this->collAnnouncementEmployeeMapsPartial = $v;
    }

    /**
     * Initializes the collAnnouncementEmployeeMaps collection.
     *
     * By default this just sets the collAnnouncementEmployeeMaps collection to an empty array (like clearcollAnnouncementEmployeeMaps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAnnouncementEmployeeMaps(bool $overrideExisting = true): void
    {
        if (null !== $this->collAnnouncementEmployeeMaps && !$overrideExisting) {
            return;
        }

        $collectionClassName = AnnouncementEmployeeMapTableMap::getTableMap()->getCollectionClassName();

        $this->collAnnouncementEmployeeMaps = new $collectionClassName;
        $this->collAnnouncementEmployeeMaps->setModel('\entities\AnnouncementEmployeeMap');
    }

    /**
     * Gets an array of ChildAnnouncementEmployeeMap objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAnnouncements is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAnnouncementEmployeeMap[] List of ChildAnnouncementEmployeeMap objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAnnouncementEmployeeMap> List of ChildAnnouncementEmployeeMap objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAnnouncementEmployeeMaps(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAnnouncementEmployeeMapsPartial && !$this->isNew();
        if (null === $this->collAnnouncementEmployeeMaps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAnnouncementEmployeeMaps) {
                    $this->initAnnouncementEmployeeMaps();
                } else {
                    $collectionClassName = AnnouncementEmployeeMapTableMap::getTableMap()->getCollectionClassName();

                    $collAnnouncementEmployeeMaps = new $collectionClassName;
                    $collAnnouncementEmployeeMaps->setModel('\entities\AnnouncementEmployeeMap');

                    return $collAnnouncementEmployeeMaps;
                }
            } else {
                $collAnnouncementEmployeeMaps = ChildAnnouncementEmployeeMapQuery::create(null, $criteria)
                    ->filterByAnnouncements($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAnnouncementEmployeeMapsPartial && count($collAnnouncementEmployeeMaps)) {
                        $this->initAnnouncementEmployeeMaps(false);

                        foreach ($collAnnouncementEmployeeMaps as $obj) {
                            if (false == $this->collAnnouncementEmployeeMaps->contains($obj)) {
                                $this->collAnnouncementEmployeeMaps->append($obj);
                            }
                        }

                        $this->collAnnouncementEmployeeMapsPartial = true;
                    }

                    return $collAnnouncementEmployeeMaps;
                }

                if ($partial && $this->collAnnouncementEmployeeMaps) {
                    foreach ($this->collAnnouncementEmployeeMaps as $obj) {
                        if ($obj->isNew()) {
                            $collAnnouncementEmployeeMaps[] = $obj;
                        }
                    }
                }

                $this->collAnnouncementEmployeeMaps = $collAnnouncementEmployeeMaps;
                $this->collAnnouncementEmployeeMapsPartial = false;
            }
        }

        return $this->collAnnouncementEmployeeMaps;
    }

    /**
     * Sets a collection of ChildAnnouncementEmployeeMap objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $announcementEmployeeMaps A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementEmployeeMaps(Collection $announcementEmployeeMaps, ?ConnectionInterface $con = null)
    {
        /** @var ChildAnnouncementEmployeeMap[] $announcementEmployeeMapsToDelete */
        $announcementEmployeeMapsToDelete = $this->getAnnouncementEmployeeMaps(new Criteria(), $con)->diff($announcementEmployeeMaps);


        $this->announcementEmployeeMapsScheduledForDeletion = $announcementEmployeeMapsToDelete;

        foreach ($announcementEmployeeMapsToDelete as $announcementEmployeeMapRemoved) {
            $announcementEmployeeMapRemoved->setAnnouncements(null);
        }

        $this->collAnnouncementEmployeeMaps = null;
        foreach ($announcementEmployeeMaps as $announcementEmployeeMap) {
            $this->addAnnouncementEmployeeMap($announcementEmployeeMap);
        }

        $this->collAnnouncementEmployeeMaps = $announcementEmployeeMaps;
        $this->collAnnouncementEmployeeMapsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AnnouncementEmployeeMap objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related AnnouncementEmployeeMap objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAnnouncementEmployeeMaps(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAnnouncementEmployeeMapsPartial && !$this->isNew();
        if (null === $this->collAnnouncementEmployeeMaps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAnnouncementEmployeeMaps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAnnouncementEmployeeMaps());
            }

            $query = ChildAnnouncementEmployeeMapQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAnnouncements($this)
                ->count($con);
        }

        return count($this->collAnnouncementEmployeeMaps);
    }

    /**
     * Method called to associate a ChildAnnouncementEmployeeMap object to this object
     * through the ChildAnnouncementEmployeeMap foreign key attribute.
     *
     * @param ChildAnnouncementEmployeeMap $l ChildAnnouncementEmployeeMap
     * @return $this The current object (for fluent API support)
     */
    public function addAnnouncementEmployeeMap(ChildAnnouncementEmployeeMap $l)
    {
        if ($this->collAnnouncementEmployeeMaps === null) {
            $this->initAnnouncementEmployeeMaps();
            $this->collAnnouncementEmployeeMapsPartial = true;
        }

        if (!$this->collAnnouncementEmployeeMaps->contains($l)) {
            $this->doAddAnnouncementEmployeeMap($l);

            if ($this->announcementEmployeeMapsScheduledForDeletion and $this->announcementEmployeeMapsScheduledForDeletion->contains($l)) {
                $this->announcementEmployeeMapsScheduledForDeletion->remove($this->announcementEmployeeMapsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAnnouncementEmployeeMap $announcementEmployeeMap The ChildAnnouncementEmployeeMap object to add.
     */
    protected function doAddAnnouncementEmployeeMap(ChildAnnouncementEmployeeMap $announcementEmployeeMap): void
    {
        $this->collAnnouncementEmployeeMaps[]= $announcementEmployeeMap;
        $announcementEmployeeMap->setAnnouncements($this);
    }

    /**
     * @param ChildAnnouncementEmployeeMap $announcementEmployeeMap The ChildAnnouncementEmployeeMap object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAnnouncementEmployeeMap(ChildAnnouncementEmployeeMap $announcementEmployeeMap)
    {
        if ($this->getAnnouncementEmployeeMaps()->contains($announcementEmployeeMap)) {
            $pos = $this->collAnnouncementEmployeeMaps->search($announcementEmployeeMap);
            $this->collAnnouncementEmployeeMaps->remove($pos);
            if (null === $this->announcementEmployeeMapsScheduledForDeletion) {
                $this->announcementEmployeeMapsScheduledForDeletion = clone $this->collAnnouncementEmployeeMaps;
                $this->announcementEmployeeMapsScheduledForDeletion->clear();
            }
            $this->announcementEmployeeMapsScheduledForDeletion[]= $announcementEmployeeMap;
            $announcementEmployeeMap->setAnnouncements(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Announcements is new, it will return
     * an empty collection; or if this Announcements has previously
     * been saved, it will retrieve related AnnouncementEmployeeMaps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Announcements.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAnnouncementEmployeeMap[] List of ChildAnnouncementEmployeeMap objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAnnouncementEmployeeMap}> List of ChildAnnouncementEmployeeMap objects
     */
    public function getAnnouncementEmployeeMapsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAnnouncementEmployeeMapQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getAnnouncementEmployeeMaps($query, $con);
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
            $this->aCompany->removeAnnouncements($this);
        }
        $this->announcement_id = null;
        $this->announcement_message = null;
        $this->announcement_title = null;
        $this->announcement_stdate = null;
        $this->announcement_edate = null;
        $this->branches = null;
        $this->designations = null;
        $this->org_units = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->announcement_status = null;
        $this->announcements_url = null;
        $this->is_employee_mapped = null;
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
            if ($this->collAnnouncementEmployeeMaps) {
                foreach ($this->collAnnouncementEmployeeMaps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAnnouncementEmployeeMaps = null;
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
        return (string) $this->exportTo(AnnouncementsTableMap::DEFAULT_STRING_FORMAT);
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
