<?php

namespace entities\Base;

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
use entities\Map\JwReportViewTableMap;

/**
 * Base class that represents a row from the 'jw_report_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class JwReportView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\JwReportViewTableMap';


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
     * The value for the user_position_code field.
     *
     * @var        string|null
     */
    protected $user_position_code;

    /**
     * The value for the user_hq_name field.
     *
     * @var        string|null
     */
    protected $user_hq_name;

    /**
     * The value for the user_name field.
     *
     * @var        string|null
     */
    protected $user_name;

    /**
     * The value for the user_emp_code field.
     *
     * @var        string|null
     */
    protected $user_emp_code;

    /**
     * The value for the user_level field.
     *
     * @var        string|null
     */
    protected $user_level;

    /**
     * The value for the jw_hq_name field.
     *
     * @var        string|null
     */
    protected $jw_hq_name;

    /**
     * The value for the jw_employee_name field.
     *
     * @var        string|null
     */
    protected $jw_employee_name;

    /**
     * The value for the jw_emp_code field.
     *
     * @var        string|null
     */
    protected $jw_emp_code;

    /**
     * The value for the jw_position_code field.
     *
     * @var        string|null
     */
    protected $jw_position_code;

    /**
     * The value for the jw_emp_level field.
     *
     * @var        string|null
     */
    protected $jw_emp_level;

    /**
     * The value for the no_of_jw_days_worked field.
     *
     * @var        int|null
     */
    protected $no_of_jw_days_worked;

    /**
     * The value for the no_of_calls_jw field.
     *
     * @var        int|null
     */
    protected $no_of_calls_jw;

    /**
     * The value for the call_average field.
     *
     * @var        string|null
     */
    protected $call_average;

    /**
     * The value for the month_year field.
     *
     * @var        string|null
     */
    protected $month_year;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\JwReportView object.
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
     * Compares this with another <code>JwReportView</code> instance.  If
     * <code>obj</code> is an instance of <code>JwReportView</code>, delegates to
     * <code>equals(JwReportView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [user_position_code] column value.
     *
     * @return string|null
     */
    public function getUserPositionCode()
    {
        return $this->user_position_code;
    }

    /**
     * Get the [user_hq_name] column value.
     *
     * @return string|null
     */
    public function getUserHqName()
    {
        return $this->user_hq_name;
    }

    /**
     * Get the [user_name] column value.
     *
     * @return string|null
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * Get the [user_emp_code] column value.
     *
     * @return string|null
     */
    public function getUserEmpCode()
    {
        return $this->user_emp_code;
    }

    /**
     * Get the [user_level] column value.
     *
     * @return string|null
     */
    public function getUserLevel()
    {
        return $this->user_level;
    }

    /**
     * Get the [jw_hq_name] column value.
     *
     * @return string|null
     */
    public function getJwHqName()
    {
        return $this->jw_hq_name;
    }

    /**
     * Get the [jw_employee_name] column value.
     *
     * @return string|null
     */
    public function getJwEmployeeName()
    {
        return $this->jw_employee_name;
    }

    /**
     * Get the [jw_emp_code] column value.
     *
     * @return string|null
     */
    public function getJwEmpCode()
    {
        return $this->jw_emp_code;
    }

    /**
     * Get the [jw_position_code] column value.
     *
     * @return string|null
     */
    public function getJwPositionCode()
    {
        return $this->jw_position_code;
    }

    /**
     * Get the [jw_emp_level] column value.
     *
     * @return string|null
     */
    public function getJwEmpLevel()
    {
        return $this->jw_emp_level;
    }

    /**
     * Get the [no_of_jw_days_worked] column value.
     *
     * @return int|null
     */
    public function getNoOfJwDaysWorked()
    {
        return $this->no_of_jw_days_worked;
    }

    /**
     * Get the [no_of_calls_jw] column value.
     *
     * @return int|null
     */
    public function getNoOfCallsJw()
    {
        return $this->no_of_calls_jw;
    }

    /**
     * Get the [call_average] column value.
     *
     * @return string|null
     */
    public function getCallAverage()
    {
        return $this->call_average;
    }

    /**
     * Get the [month_year] column value.
     *
     * @return string|null
     */
    public function getMonthYear()
    {
        return $this->month_year;
    }

    /**
     * Set the value of [user_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUserPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_position_code !== $v) {
            $this->user_position_code = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_USER_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_hq_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUserHqName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_hq_name !== $v) {
            $this->user_hq_name = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_USER_HQ_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUserName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_name !== $v) {
            $this->user_name = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_USER_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_emp_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUserEmpCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_emp_code !== $v) {
            $this->user_emp_code = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_USER_EMP_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_level] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUserLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_level !== $v) {
            $this->user_level = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_USER_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [jw_hq_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setJwHqName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->jw_hq_name !== $v) {
            $this->jw_hq_name = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_JW_HQ_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [jw_employee_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setJwEmployeeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->jw_employee_name !== $v) {
            $this->jw_employee_name = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_JW_EMPLOYEE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [jw_emp_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setJwEmpCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->jw_emp_code !== $v) {
            $this->jw_emp_code = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_JW_EMP_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [jw_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setJwPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->jw_position_code !== $v) {
            $this->jw_position_code = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_JW_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [jw_emp_level] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setJwEmpLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->jw_emp_level !== $v) {
            $this->jw_emp_level = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_JW_EMP_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [no_of_jw_days_worked] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setNoOfJwDaysWorked($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->no_of_jw_days_worked !== $v) {
            $this->no_of_jw_days_worked = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [no_of_calls_jw] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setNoOfCallsJw($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->no_of_calls_jw !== $v) {
            $this->no_of_calls_jw = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_NO_OF_CALLS_JW] = true;
        }

        return $this;
    }

    /**
     * Set the value of [call_average] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCallAverage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->call_average !== $v) {
            $this->call_average = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_CALL_AVERAGE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [month_year] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setMonthYear($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->month_year !== $v) {
            $this->month_year = $v;
            $this->modifiedColumns[JwReportViewTableMap::COL_MONTH_YEAR] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JwReportViewTableMap::translateFieldName('UserPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JwReportViewTableMap::translateFieldName('UserHqName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_hq_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JwReportViewTableMap::translateFieldName('UserName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JwReportViewTableMap::translateFieldName('UserEmpCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_emp_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JwReportViewTableMap::translateFieldName('UserLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JwReportViewTableMap::translateFieldName('JwHqName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jw_hq_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JwReportViewTableMap::translateFieldName('JwEmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jw_employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JwReportViewTableMap::translateFieldName('JwEmpCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jw_emp_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JwReportViewTableMap::translateFieldName('JwPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jw_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JwReportViewTableMap::translateFieldName('JwEmpLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jw_emp_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JwReportViewTableMap::translateFieldName('NoOfJwDaysWorked', TableMap::TYPE_PHPNAME, $indexType)];
            $this->no_of_jw_days_worked = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JwReportViewTableMap::translateFieldName('NoOfCallsJw', TableMap::TYPE_PHPNAME, $indexType)];
            $this->no_of_calls_jw = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : JwReportViewTableMap::translateFieldName('CallAverage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->call_average = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : JwReportViewTableMap::translateFieldName('MonthYear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month_year = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = JwReportViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\JwReportView'), 0, $e);
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
        $pos = JwReportViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUserPositionCode();

            case 1:
                return $this->getUserHqName();

            case 2:
                return $this->getUserName();

            case 3:
                return $this->getUserEmpCode();

            case 4:
                return $this->getUserLevel();

            case 5:
                return $this->getJwHqName();

            case 6:
                return $this->getJwEmployeeName();

            case 7:
                return $this->getJwEmpCode();

            case 8:
                return $this->getJwPositionCode();

            case 9:
                return $this->getJwEmpLevel();

            case 10:
                return $this->getNoOfJwDaysWorked();

            case 11:
                return $this->getNoOfCallsJw();

            case 12:
                return $this->getCallAverage();

            case 13:
                return $this->getMonthYear();

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
        if (isset($alreadyDumpedObjects['JwReportView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['JwReportView'][$this->hashCode()] = true;
        $keys = JwReportViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getUserPositionCode(),
            $keys[1] => $this->getUserHqName(),
            $keys[2] => $this->getUserName(),
            $keys[3] => $this->getUserEmpCode(),
            $keys[4] => $this->getUserLevel(),
            $keys[5] => $this->getJwHqName(),
            $keys[6] => $this->getJwEmployeeName(),
            $keys[7] => $this->getJwEmpCode(),
            $keys[8] => $this->getJwPositionCode(),
            $keys[9] => $this->getJwEmpLevel(),
            $keys[10] => $this->getNoOfJwDaysWorked(),
            $keys[11] => $this->getNoOfCallsJw(),
            $keys[12] => $this->getCallAverage(),
            $keys[13] => $this->getMonthYear(),
        ];
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
        $criteria = new Criteria(JwReportViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JwReportViewTableMap::COL_USER_POSITION_CODE)) {
            $criteria->add(JwReportViewTableMap::COL_USER_POSITION_CODE, $this->user_position_code);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_USER_HQ_NAME)) {
            $criteria->add(JwReportViewTableMap::COL_USER_HQ_NAME, $this->user_hq_name);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_USER_NAME)) {
            $criteria->add(JwReportViewTableMap::COL_USER_NAME, $this->user_name);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_USER_EMP_CODE)) {
            $criteria->add(JwReportViewTableMap::COL_USER_EMP_CODE, $this->user_emp_code);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_USER_LEVEL)) {
            $criteria->add(JwReportViewTableMap::COL_USER_LEVEL, $this->user_level);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_JW_HQ_NAME)) {
            $criteria->add(JwReportViewTableMap::COL_JW_HQ_NAME, $this->jw_hq_name);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_JW_EMPLOYEE_NAME)) {
            $criteria->add(JwReportViewTableMap::COL_JW_EMPLOYEE_NAME, $this->jw_employee_name);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_JW_EMP_CODE)) {
            $criteria->add(JwReportViewTableMap::COL_JW_EMP_CODE, $this->jw_emp_code);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_JW_POSITION_CODE)) {
            $criteria->add(JwReportViewTableMap::COL_JW_POSITION_CODE, $this->jw_position_code);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_JW_EMP_LEVEL)) {
            $criteria->add(JwReportViewTableMap::COL_JW_EMP_LEVEL, $this->jw_emp_level);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED)) {
            $criteria->add(JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED, $this->no_of_jw_days_worked);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_NO_OF_CALLS_JW)) {
            $criteria->add(JwReportViewTableMap::COL_NO_OF_CALLS_JW, $this->no_of_calls_jw);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_CALL_AVERAGE)) {
            $criteria->add(JwReportViewTableMap::COL_CALL_AVERAGE, $this->call_average);
        }
        if ($this->isColumnModified(JwReportViewTableMap::COL_MONTH_YEAR)) {
            $criteria->add(JwReportViewTableMap::COL_MONTH_YEAR, $this->month_year);
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
        throw new LogicException('The JwReportView object has no primary key');

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
        $validPk = false;

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
     * Returns NULL since this table doesn't have a primary key.
     * This method exists only for BC and is deprecated!
     * @return null
     */
    public function getPrimaryKey()
    {
        return null;
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return false;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\JwReportView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUserPositionCode($this->getUserPositionCode());
        $copyObj->setUserHqName($this->getUserHqName());
        $copyObj->setUserName($this->getUserName());
        $copyObj->setUserEmpCode($this->getUserEmpCode());
        $copyObj->setUserLevel($this->getUserLevel());
        $copyObj->setJwHqName($this->getJwHqName());
        $copyObj->setJwEmployeeName($this->getJwEmployeeName());
        $copyObj->setJwEmpCode($this->getJwEmpCode());
        $copyObj->setJwPositionCode($this->getJwPositionCode());
        $copyObj->setJwEmpLevel($this->getJwEmpLevel());
        $copyObj->setNoOfJwDaysWorked($this->getNoOfJwDaysWorked());
        $copyObj->setNoOfCallsJw($this->getNoOfCallsJw());
        $copyObj->setCallAverage($this->getCallAverage());
        $copyObj->setMonthYear($this->getMonthYear());
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
     * @return \entities\JwReportView Clone of current object.
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
        $this->user_position_code = null;
        $this->user_hq_name = null;
        $this->user_name = null;
        $this->user_emp_code = null;
        $this->user_level = null;
        $this->jw_hq_name = null;
        $this->jw_employee_name = null;
        $this->jw_emp_code = null;
        $this->jw_position_code = null;
        $this->jw_emp_level = null;
        $this->no_of_jw_days_worked = null;
        $this->no_of_calls_jw = null;
        $this->call_average = null;
        $this->month_year = null;
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
        return (string) $this->exportTo(JwReportViewTableMap::DEFAULT_STRING_FORMAT);
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
