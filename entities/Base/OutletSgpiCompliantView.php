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
use entities\Map\OutletSgpiCompliantViewTableMap;

/**
 * Base class that represents a row from the 'outlet_sgpi_compliant_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OutletSgpiCompliantView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OutletSgpiCompliantViewTableMap';


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
     * The value for the moye field.
     *
     * @var        string|null
     */
    protected $moye;

    /**
     * The value for the org_data_id field.
     *
     * @var        int|null
     */
    protected $org_data_id;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

    /**
     * The value for the sgpi_status field.
     *
     * @var        boolean|null
     */
    protected $sgpi_status;

    /**
     * The value for the sgpi_id field.
     *
     * @var        int|null
     */
    protected $sgpi_id;

    /**
     * The value for the sgpi_type field.
     *
     * @var        string|null
     */
    protected $sgpi_type;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the total_qty field.
     *
     * @var        int|null
     */
    protected $total_qty;

    /**
     * The value for the compliant field.
     *
     * @var        string|null
     */
    protected $compliant;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\OutletSgpiCompliantView object.
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
     * Compares this with another <code>OutletSgpiCompliantView</code> instance.  If
     * <code>obj</code> is an instance of <code>OutletSgpiCompliantView</code>, delegates to
     * <code>equals(OutletSgpiCompliantView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [moye] column value.
     *
     * @return string|null
     */
    public function getMoye()
    {
        return $this->moye;
    }

    /**
     * Get the [org_data_id] column value.
     *
     * @return int|null
     */
    public function getOrgDataId()
    {
        return $this->org_data_id;
    }

    /**
     * Get the [brand_id] column value.
     *
     * @return int|null
     */
    public function getBrandId()
    {
        return $this->brand_id;
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
     * Get the [sgpi_id] column value.
     *
     * @return int|null
     */
    public function getSgpiId()
    {
        return $this->sgpi_id;
    }

    /**
     * Get the [sgpi_type] column value.
     *
     * @return string|null
     */
    public function getSgpiType()
    {
        return $this->sgpi_type;
    }

    /**
     * Get the [position_id] column value.
     *
     * @return int|null
     */
    public function getPositionId()
    {
        return $this->position_id;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return int|null
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Get the [total_qty] column value.
     *
     * @return int|null
     */
    public function getTotalQty()
    {
        return $this->total_qty;
    }

    /**
     * Get the [compliant] column value.
     *
     * @return string|null
     */
    public function getCompliant()
    {
        return $this->compliant;
    }

    /**
     * Set the value of [moye] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setMoye($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->moye !== $v) {
            $this->moye = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_MOYE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_data_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgDataId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_data_id !== $v) {
            $this->org_data_id = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_BRAND_ID] = true;
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
    protected function setSgpiStatus($v)
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
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sgpi_id !== $v) {
            $this->sgpi_id = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_SGPI_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_type !== $v) {
            $this->sgpi_type = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_POSITION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_qty] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTotalQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->total_qty !== $v) {
            $this->total_qty = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [compliant] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCompliant($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->compliant !== $v) {
            $this->compliant = $v;
            $this->modifiedColumns[OutletSgpiCompliantViewTableMap::COL_COMPLIANT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('Moye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('OrgDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_data_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('SgpiStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_status = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('SgpiType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('TotalQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OutletSgpiCompliantViewTableMap::translateFieldName('Compliant', TableMap::TYPE_PHPNAME, $indexType)];
            $this->compliant = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = OutletSgpiCompliantViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OutletSgpiCompliantView'), 0, $e);
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
        $pos = OutletSgpiCompliantViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMoye();

            case 1:
                return $this->getOrgDataId();

            case 2:
                return $this->getBrandId();

            case 3:
                return $this->getSgpiStatus();

            case 4:
                return $this->getSgpiId();

            case 5:
                return $this->getSgpiType();

            case 6:
                return $this->getPositionId();

            case 7:
                return $this->getEmployeeId();

            case 8:
                return $this->getTotalQty();

            case 9:
                return $this->getCompliant();

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
        if (isset($alreadyDumpedObjects['OutletSgpiCompliantView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OutletSgpiCompliantView'][$this->hashCode()] = true;
        $keys = OutletSgpiCompliantViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getMoye(),
            $keys[1] => $this->getOrgDataId(),
            $keys[2] => $this->getBrandId(),
            $keys[3] => $this->getSgpiStatus(),
            $keys[4] => $this->getSgpiId(),
            $keys[5] => $this->getSgpiType(),
            $keys[6] => $this->getPositionId(),
            $keys[7] => $this->getEmployeeId(),
            $keys[8] => $this->getTotalQty(),
            $keys[9] => $this->getCompliant(),
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
        $criteria = new Criteria(OutletSgpiCompliantViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_MOYE)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_MOYE, $this->moye);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID, $this->org_data_id);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_BRAND_ID)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS, $this->sgpi_status);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_SGPI_ID)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_SGPI_ID, $this->sgpi_id);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE, $this->sgpi_type);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_POSITION_ID)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY, $this->total_qty);
        }
        if ($this->isColumnModified(OutletSgpiCompliantViewTableMap::COL_COMPLIANT)) {
            $criteria->add(OutletSgpiCompliantViewTableMap::COL_COMPLIANT, $this->compliant);
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
        throw new LogicException('The OutletSgpiCompliantView object has no primary key');

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
     * @param object $copyObj An object of \entities\OutletSgpiCompliantView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setMoye($this->getMoye());
        $copyObj->setOrgDataId($this->getOrgDataId());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setSgpiStatus($this->getSgpiStatus());
        $copyObj->setSgpiId($this->getSgpiId());
        $copyObj->setSgpiType($this->getSgpiType());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setTotalQty($this->getTotalQty());
        $copyObj->setCompliant($this->getCompliant());
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
     * @return \entities\OutletSgpiCompliantView Clone of current object.
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
        $this->moye = null;
        $this->org_data_id = null;
        $this->brand_id = null;
        $this->sgpi_status = null;
        $this->sgpi_id = null;
        $this->sgpi_type = null;
        $this->position_id = null;
        $this->employee_id = null;
        $this->total_qty = null;
        $this->compliant = null;
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
        return (string) $this->exportTo(OutletSgpiCompliantViewTableMap::DEFAULT_STRING_FORMAT);
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