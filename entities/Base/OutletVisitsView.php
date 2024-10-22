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
use entities\OutletVisitsViewQuery as ChildOutletVisitsViewQuery;
use entities\Map\OutletVisitsViewTableMap;

/**
 * Base class that represents a row from the 'outlet_visits_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OutletVisitsView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OutletVisitsViewTableMap';


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
     * The value for the unique_id field.
     *
     * @var        string
     */
    protected $unique_id;

    /**
     * The value for the moye field.
     *
     * @var        string|null
     */
    protected $moye;

    /**
     * The value for the position_name field.
     *
     * @var        string|null
     */
    protected $position_name;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the cav_positions_up field.
     *
     * @var        string|null
     */
    protected $cav_positions_up;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the territory_name field.
     *
     * @var        string|null
     */
    protected $territory_name;

    /**
     * The value for the beat_id field.
     *
     * @var        int|null
     */
    protected $beat_id;

    /**
     * The value for the beat_name field.
     *
     * @var        string|null
     */
    protected $beat_name;

    /**
     * The value for the outlet_org_data_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_data_id;

    /**
     * The value for the outlet_id field.
     *
     * @var        int|null
     */
    protected $outlet_id;

    /**
     * The value for the outlettype_id field.
     *
     * @var        int|null
     */
    protected $outlettype_id;

    /**
     * The value for the outlettype_name field.
     *
     * @var        string|null
     */
    protected $outlettype_name;

    /**
     * The value for the outlet_salutation field.
     *
     * @var        string|null
     */
    protected $outlet_salutation;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the outlet_contact_no field.
     *
     * @var        string|null
     */
    protected $outlet_contact_no;

    /**
     * The value for the visit_fq field.
     *
     * @var        int|null
     */
    protected $visit_fq;

    /**
     * The value for the vfcovered field.
     *
     * @var        int|null
     */
    protected $vfcovered;

    /**
     * The value for the visits field.
     *
     * @var        int|null
     */
    protected $visits;

    /**
     * The value for the rcpa_done field.
     *
     * @var        int|null
     */
    protected $rcpa_done;

    /**
     * The value for the sgpi_done field.
     *
     * @var        int|null
     */
    protected $sgpi_done;

    /**
     * The value for the outlet_classification field.
     *
     * @var        int|null
     */
    protected $outlet_classification;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the territory_position field.
     *
     * @var        int|null
     */
    protected $territory_position;

    /**
     * The value for the incharge field.
     *
     * @var        int|null
     */
    protected $incharge;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\OutletVisitsView object.
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
     * Compares this with another <code>OutletVisitsView</code> instance.  If
     * <code>obj</code> is an instance of <code>OutletVisitsView</code>, delegates to
     * <code>equals(OutletVisitsView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [unique_id] column value.
     *
     * @return string
     */
    public function getUniqueId()
    {
        return $this->unique_id;
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
     * Get the [position_name] column value.
     *
     * @return string|null
     */
    public function getPsitionName()
    {
        return $this->position_name;
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
     * Get the [cav_positions_up] column value.
     *
     * @return string|null
     */
    public function getCavPositionsUp()
    {
        return $this->cav_positions_up;
    }

    /**
     * Get the [territory_id] column value.
     *
     * @return int|null
     */
    public function getTerritoryId()
    {
        return $this->territory_id;
    }

    /**
     * Get the [territory_name] column value.
     *
     * @return string|null
     */
    public function getTerritoryName()
    {
        return $this->territory_name;
    }

    /**
     * Get the [beat_id] column value.
     *
     * @return int|null
     */
    public function getBeatId()
    {
        return $this->beat_id;
    }

    /**
     * Get the [beat_name] column value.
     *
     * @return string|null
     */
    public function getBeatName()
    {
        return $this->beat_name;
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
     * Get the [outlet_id] column value.
     *
     * @return int|null
     */
    public function getOutletId()
    {
        return $this->outlet_id;
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
     * Get the [outlettype_name] column value.
     *
     * @return string|null
     */
    public function getOutlettypeName()
    {
        return $this->outlettype_name;
    }

    /**
     * Get the [outlet_salutation] column value.
     *
     * @return string|null
     */
    public function getOutletSalutation()
    {
        return $this->outlet_salutation;
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
     * Get the [outlet_contact_no] column value.
     *
     * @return string|null
     */
    public function getOutletContactNo()
    {
        return $this->outlet_contact_no;
    }

    /**
     * Get the [visit_fq] column value.
     *
     * @return int|null
     */
    public function getVisitFq()
    {
        return $this->visit_fq;
    }

    /**
     * Get the [vfcovered] column value.
     *
     * @return int|null
     */
    public function getVfcovered()
    {
        return $this->vfcovered;
    }

    /**
     * Get the [visits] column value.
     *
     * @return int|null
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Get the [rcpa_done] column value.
     *
     * @return int|null
     */
    public function getRcpaDone()
    {
        return $this->rcpa_done;
    }

    /**
     * Get the [sgpi_done] column value.
     *
     * @return int|null
     */
    public function getSgpiDone()
    {
        return $this->sgpi_done;
    }

    /**
     * Get the [outlet_classification] column value.
     *
     * @return int|null
     */
    public function getOutletClassification()
    {
        return $this->outlet_classification;
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
     * Get the [territory_position] column value.
     *
     * @return int|null
     */
    public function getTerritoryPosition()
    {
        return $this->territory_position;
    }

    /**
     * Get the [incharge] column value.
     *
     * @return int|null
     */
    public function getIncharge()
    {
        return $this->incharge;
    }

    /**
     * Set the value of [unique_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniqueId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unique_id !== $v) {
            $this->unique_id = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_UNIQUE_ID] = true;
        }

        return $this;
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
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_MOYE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPsitionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_name !== $v) {
            $this->position_name = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_POSITION_NAME] = true;
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
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_POSITION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cav_positions_up] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCavPositionsUp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cav_positions_up !== $v) {
            $this->cav_positions_up = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_id !== $v) {
            $this->territory_id = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_TERRITORY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory_name !== $v) {
            $this->territory_name = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_TERRITORY_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBeatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->beat_id !== $v) {
            $this->beat_id = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_BEAT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBeatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_name !== $v) {
            $this->beat_name = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_BEAT_NAME] = true;
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
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_OUTLET_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlettypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlettype_id !== $v) {
            $this->outlettype_id = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_OUTLETTYPE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlettypeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlettype_name !== $v) {
            $this->outlettype_name = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_salutation] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletSalutation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_salutation !== $v) {
            $this->outlet_salutation = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_OUTLET_SALUTATION] = true;
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
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_contact_no] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletContactNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_contact_no !== $v) {
            $this->outlet_contact_no = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_fq] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setVisitFq($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->visit_fq !== $v) {
            $this->visit_fq = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_VISIT_FQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [vfcovered] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setVfcovered($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->vfcovered !== $v) {
            $this->vfcovered = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_VFCOVERED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visits] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setVisits($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->visits !== $v) {
            $this->visits = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_VISITS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_done] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRcpaDone($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rcpa_done !== $v) {
            $this->rcpa_done = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_RCPA_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_done] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiDone($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sgpi_done !== $v) {
            $this->sgpi_done = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_SGPI_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_classification] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletClassification($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_classification !== $v) {
            $this->outlet_classification = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION] = true;
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
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_position] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_position !== $v) {
            $this->territory_position = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_TERRITORY_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [incharge] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setIncharge($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->incharge !== $v) {
            $this->incharge = $v;
            $this->modifiedColumns[OutletVisitsViewTableMap::COL_INCHARGE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OutletVisitsViewTableMap::translateFieldName('UniqueId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unique_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OutletVisitsViewTableMap::translateFieldName('Moye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OutletVisitsViewTableMap::translateFieldName('PsitionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OutletVisitsViewTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OutletVisitsViewTableMap::translateFieldName('CavPositionsUp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cav_positions_up = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OutletVisitsViewTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OutletVisitsViewTableMap::translateFieldName('TerritoryName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OutletVisitsViewTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OutletVisitsViewTableMap::translateFieldName('BeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OutletVisitsViewTableMap::translateFieldName('OutletOrgDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_data_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OutletVisitsViewTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OutletVisitsViewTableMap::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OutletVisitsViewTableMap::translateFieldName('OutlettypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OutletVisitsViewTableMap::translateFieldName('OutletSalutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_salutation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OutletVisitsViewTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OutletVisitsViewTableMap::translateFieldName('OutletContactNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OutletVisitsViewTableMap::translateFieldName('VisitFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_fq = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OutletVisitsViewTableMap::translateFieldName('Vfcovered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vfcovered = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : OutletVisitsViewTableMap::translateFieldName('Visits', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visits = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : OutletVisitsViewTableMap::translateFieldName('RcpaDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_done = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : OutletVisitsViewTableMap::translateFieldName('SgpiDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_done = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : OutletVisitsViewTableMap::translateFieldName('OutletClassification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_classification = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : OutletVisitsViewTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : OutletVisitsViewTableMap::translateFieldName('TerritoryPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_position = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : OutletVisitsViewTableMap::translateFieldName('Incharge', TableMap::TYPE_PHPNAME, $indexType)];
            $this->incharge = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 25; // 25 = OutletVisitsViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OutletVisitsView'), 0, $e);
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
        $pos = OutletVisitsViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUniqueId();

            case 1:
                return $this->getMoye();

            case 2:
                return $this->getPsitionName();

            case 3:
                return $this->getPositionId();

            case 4:
                return $this->getCavPositionsUp();

            case 5:
                return $this->getTerritoryId();

            case 6:
                return $this->getTerritoryName();

            case 7:
                return $this->getBeatId();

            case 8:
                return $this->getBeatName();

            case 9:
                return $this->getOutletOrgDataId();

            case 10:
                return $this->getOutletId();

            case 11:
                return $this->getOutlettypeId();

            case 12:
                return $this->getOutlettypeName();

            case 13:
                return $this->getOutletSalutation();

            case 14:
                return $this->getOutletName();

            case 15:
                return $this->getOutletContactNo();

            case 16:
                return $this->getVisitFq();

            case 17:
                return $this->getVfcovered();

            case 18:
                return $this->getVisits();

            case 19:
                return $this->getRcpaDone();

            case 20:
                return $this->getSgpiDone();

            case 21:
                return $this->getOutletClassification();

            case 22:
                return $this->getEmployeeId();

            case 23:
                return $this->getTerritoryPosition();

            case 24:
                return $this->getIncharge();

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
        if (isset($alreadyDumpedObjects['OutletVisitsView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OutletVisitsView'][$this->hashCode()] = true;
        $keys = OutletVisitsViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getUniqueId(),
            $keys[1] => $this->getMoye(),
            $keys[2] => $this->getPsitionName(),
            $keys[3] => $this->getPositionId(),
            $keys[4] => $this->getCavPositionsUp(),
            $keys[5] => $this->getTerritoryId(),
            $keys[6] => $this->getTerritoryName(),
            $keys[7] => $this->getBeatId(),
            $keys[8] => $this->getBeatName(),
            $keys[9] => $this->getOutletOrgDataId(),
            $keys[10] => $this->getOutletId(),
            $keys[11] => $this->getOutlettypeId(),
            $keys[12] => $this->getOutlettypeName(),
            $keys[13] => $this->getOutletSalutation(),
            $keys[14] => $this->getOutletName(),
            $keys[15] => $this->getOutletContactNo(),
            $keys[16] => $this->getVisitFq(),
            $keys[17] => $this->getVfcovered(),
            $keys[18] => $this->getVisits(),
            $keys[19] => $this->getRcpaDone(),
            $keys[20] => $this->getSgpiDone(),
            $keys[21] => $this->getOutletClassification(),
            $keys[22] => $this->getEmployeeId(),
            $keys[23] => $this->getTerritoryPosition(),
            $keys[24] => $this->getIncharge(),
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
        $criteria = new Criteria(OutletVisitsViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_UNIQUE_ID)) {
            $criteria->add(OutletVisitsViewTableMap::COL_UNIQUE_ID, $this->unique_id);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_MOYE)) {
            $criteria->add(OutletVisitsViewTableMap::COL_MOYE, $this->moye);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_POSITION_NAME)) {
            $criteria->add(OutletVisitsViewTableMap::COL_POSITION_NAME, $this->position_name);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_POSITION_ID)) {
            $criteria->add(OutletVisitsViewTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP)) {
            $criteria->add(OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP, $this->cav_positions_up);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_TERRITORY_ID)) {
            $criteria->add(OutletVisitsViewTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_TERRITORY_NAME)) {
            $criteria->add(OutletVisitsViewTableMap::COL_TERRITORY_NAME, $this->territory_name);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_BEAT_ID)) {
            $criteria->add(OutletVisitsViewTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_BEAT_NAME)) {
            $criteria->add(OutletVisitsViewTableMap::COL_BEAT_NAME, $this->beat_name);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $criteria->add(OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID, $this->outlet_org_data_id);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_OUTLET_ID)) {
            $criteria->add(OutletVisitsViewTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_OUTLETTYPE_ID)) {
            $criteria->add(OutletVisitsViewTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME)) {
            $criteria->add(OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME, $this->outlettype_name);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_OUTLET_SALUTATION)) {
            $criteria->add(OutletVisitsViewTableMap::COL_OUTLET_SALUTATION, $this->outlet_salutation);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_OUTLET_NAME)) {
            $criteria->add(OutletVisitsViewTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO)) {
            $criteria->add(OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO, $this->outlet_contact_no);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_VISIT_FQ)) {
            $criteria->add(OutletVisitsViewTableMap::COL_VISIT_FQ, $this->visit_fq);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_VFCOVERED)) {
            $criteria->add(OutletVisitsViewTableMap::COL_VFCOVERED, $this->vfcovered);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_VISITS)) {
            $criteria->add(OutletVisitsViewTableMap::COL_VISITS, $this->visits);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_RCPA_DONE)) {
            $criteria->add(OutletVisitsViewTableMap::COL_RCPA_DONE, $this->rcpa_done);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_SGPI_DONE)) {
            $criteria->add(OutletVisitsViewTableMap::COL_SGPI_DONE, $this->sgpi_done);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION)) {
            $criteria->add(OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION, $this->outlet_classification);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(OutletVisitsViewTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_TERRITORY_POSITION)) {
            $criteria->add(OutletVisitsViewTableMap::COL_TERRITORY_POSITION, $this->territory_position);
        }
        if ($this->isColumnModified(OutletVisitsViewTableMap::COL_INCHARGE)) {
            $criteria->add(OutletVisitsViewTableMap::COL_INCHARGE, $this->incharge);
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
        $criteria = ChildOutletVisitsViewQuery::create();
        $criteria->add(OutletVisitsViewTableMap::COL_UNIQUE_ID, $this->unique_id);

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
        $validPk = null !== $this->getUniqueId();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getUniqueId();
    }

    /**
     * Generic method to set the primary key (unique_id column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setUniqueId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getUniqueId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OutletVisitsView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUniqueId($this->getUniqueId());
        $copyObj->setMoye($this->getMoye());
        $copyObj->setPsitionName($this->getPsitionName());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setCavPositionsUp($this->getCavPositionsUp());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setTerritoryName($this->getTerritoryName());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setBeatName($this->getBeatName());
        $copyObj->setOutletOrgDataId($this->getOutletOrgDataId());
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setOutlettypeId($this->getOutlettypeId());
        $copyObj->setOutlettypeName($this->getOutlettypeName());
        $copyObj->setOutletSalutation($this->getOutletSalutation());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setOutletContactNo($this->getOutletContactNo());
        $copyObj->setVisitFq($this->getVisitFq());
        $copyObj->setVfcovered($this->getVfcovered());
        $copyObj->setVisits($this->getVisits());
        $copyObj->setRcpaDone($this->getRcpaDone());
        $copyObj->setSgpiDone($this->getSgpiDone());
        $copyObj->setOutletClassification($this->getOutletClassification());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setTerritoryPosition($this->getTerritoryPosition());
        $copyObj->setIncharge($this->getIncharge());
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
     * @return \entities\OutletVisitsView Clone of current object.
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
        $this->unique_id = null;
        $this->moye = null;
        $this->position_name = null;
        $this->position_id = null;
        $this->cav_positions_up = null;
        $this->territory_id = null;
        $this->territory_name = null;
        $this->beat_id = null;
        $this->beat_name = null;
        $this->outlet_org_data_id = null;
        $this->outlet_id = null;
        $this->outlettype_id = null;
        $this->outlettype_name = null;
        $this->outlet_salutation = null;
        $this->outlet_name = null;
        $this->outlet_contact_no = null;
        $this->visit_fq = null;
        $this->vfcovered = null;
        $this->visits = null;
        $this->rcpa_done = null;
        $this->sgpi_done = null;
        $this->outlet_classification = null;
        $this->employee_id = null;
        $this->territory_position = null;
        $this->incharge = null;
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
        return (string) $this->exportTo(OutletVisitsViewTableMap::DEFAULT_STRING_FORMAT);
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
