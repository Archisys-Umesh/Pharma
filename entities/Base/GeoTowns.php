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
use entities\Attendance as ChildAttendance;
use entities\AttendanceQuery as ChildAttendanceQuery;
use entities\Beats as ChildBeats;
use entities\BeatsQuery as ChildBeatsQuery;
use entities\Citycategory as ChildCitycategory;
use entities\CitycategoryQuery as ChildCitycategoryQuery;
use entities\Dailycalls as ChildDailycalls;
use entities\DailycallsQuery as ChildDailycallsQuery;
use entities\Dayplan as ChildDayplan;
use entities\DayplanQuery as ChildDayplanQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\GeoCity as ChildGeoCity;
use entities\GeoCityQuery as ChildGeoCityQuery;
use entities\GeoDistance as ChildGeoDistance;
use entities\GeoDistanceQuery as ChildGeoDistanceQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\OutletAddress as ChildOutletAddress;
use entities\OutletAddressQuery as ChildOutletAddressQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\SfcMaster as ChildSfcMaster;
use entities\SfcMasterQuery as ChildSfcMasterQuery;
use entities\TerritoryTowns as ChildTerritoryTowns;
use entities\TerritoryTownsQuery as ChildTerritoryTownsQuery;
use entities\Tourplans as ChildTourplans;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\AttendanceTableMap;
use entities\Map\BeatsTableMap;
use entities\Map\CitycategoryTableMap;
use entities\Map\DailycallsTableMap;
use entities\Map\DayplanTableMap;
use entities\Map\EmployeeTableMap;
use entities\Map\GeoDistanceTableMap;
use entities\Map\GeoTownsTableMap;
use entities\Map\OnBoardRequestAddressTableMap;
use entities\Map\OutletAddressTableMap;
use entities\Map\OutletOrgDataTableMap;
use entities\Map\OutletsTableMap;
use entities\Map\PositionsTableMap;
use entities\Map\SfcMasterTableMap;
use entities\Map\TerritoryTownsTableMap;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a row from the 'geo_towns' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class GeoTowns implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\GeoTownsTableMap';


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
     * The value for the itownid field.
     *
     * @var        string
     */
    protected $itownid;

    /**
     * The value for the stownname field.
     *
     * @var        string|null
     */
    protected $stownname;

    /**
     * The value for the icityid field.
     *
     * @var        string|null
     */
    protected $icityid;

    /**
     * The value for the stowncode field.
     *
     * @var        string|null
     */
    protected $stowncode;

    /**
     * The value for the dcreateddate field.
     *
     * @var        DateTime|null
     */
    protected $dcreateddate;

    /**
     * The value for the dmodifydate field.
     *
     * @var        DateTime|null
     */
    protected $dmodifydate;

    /**
     * The value for the sstatus field.
     *
     * @var        string|null
     */
    protected $sstatus;

    /**
     * The value for the pincode field.
     *
     * @var        string|null
     */
    protected $pincode;

    /**
     * @var        ChildGeoCity
     */
    protected $aGeoCity;

    /**
     * @var        ObjectCollection|ChildAttendance[] Collection to store aggregation of ChildAttendance objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAttendance> Collection to store aggregation of ChildAttendance objects.
     */
    protected $collAttendancesRelatedByEndItownid;
    protected $collAttendancesRelatedByEndItownidPartial;

    /**
     * @var        ObjectCollection|ChildAttendance[] Collection to store aggregation of ChildAttendance objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAttendance> Collection to store aggregation of ChildAttendance objects.
     */
    protected $collAttendancesRelatedByStartItownid;
    protected $collAttendancesRelatedByStartItownidPartial;

    /**
     * @var        ObjectCollection|ChildBeats[] Collection to store aggregation of ChildBeats objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBeats> Collection to store aggregation of ChildBeats objects.
     */
    protected $collBeatss;
    protected $collBeatssPartial;

    /**
     * @var        ObjectCollection|ChildCitycategory[] Collection to store aggregation of ChildCitycategory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCitycategory> Collection to store aggregation of ChildCitycategory objects.
     */
    protected $collCitycategories;
    protected $collCitycategoriesPartial;

    /**
     * @var        ObjectCollection|ChildDailycalls[] Collection to store aggregation of ChildDailycalls objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycalls> Collection to store aggregation of ChildDailycalls objects.
     */
    protected $collDailycallss;
    protected $collDailycallssPartial;

    /**
     * @var        ObjectCollection|ChildDayplan[] Collection to store aggregation of ChildDayplan objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan> Collection to store aggregation of ChildDayplan objects.
     */
    protected $collDayplans;
    protected $collDayplansPartial;

    /**
     * @var        ObjectCollection|ChildEmployee[] Collection to store aggregation of ChildEmployee objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee> Collection to store aggregation of ChildEmployee objects.
     */
    protected $collEmployees;
    protected $collEmployeesPartial;

    /**
     * @var        ObjectCollection|ChildGeoDistance[] Collection to store aggregation of ChildGeoDistance objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoDistance> Collection to store aggregation of ChildGeoDistance objects.
     */
    protected $collGeoDistancesRelatedByFromTownId;
    protected $collGeoDistancesRelatedByFromTownIdPartial;

    /**
     * @var        ObjectCollection|ChildGeoDistance[] Collection to store aggregation of ChildGeoDistance objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoDistance> Collection to store aggregation of ChildGeoDistance objects.
     */
    protected $collGeoDistancesRelatedByToTownId;
    protected $collGeoDistancesRelatedByToTownIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestAddress[] Collection to store aggregation of ChildOnBoardRequestAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress> Collection to store aggregation of ChildOnBoardRequestAddress objects.
     */
    protected $collOnBoardRequestAddresses;
    protected $collOnBoardRequestAddressesPartial;

    /**
     * @var        ObjectCollection|ChildOutletAddress[] Collection to store aggregation of ChildOutletAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletAddress> Collection to store aggregation of ChildOutletAddress objects.
     */
    protected $collOutletAddresses;
    protected $collOutletAddressesPartial;

    /**
     * @var        ObjectCollection|ChildOutletOrgData[] Collection to store aggregation of ChildOutletOrgData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgData> Collection to store aggregation of ChildOutletOrgData objects.
     */
    protected $collOutletOrgDatas;
    protected $collOutletOrgDatasPartial;

    /**
     * @var        ObjectCollection|ChildOutlets[] Collection to store aggregation of ChildOutlets objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutlets> Collection to store aggregation of ChildOutlets objects.
     */
    protected $collOutletss;
    protected $collOutletssPartial;

    /**
     * @var        ObjectCollection|ChildPositions[] Collection to store aggregation of ChildPositions objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPositions> Collection to store aggregation of ChildPositions objects.
     */
    protected $collPositionss;
    protected $collPositionssPartial;

    /**
     * @var        ObjectCollection|ChildSfcMaster[] Collection to store aggregation of ChildSfcMaster objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSfcMaster> Collection to store aggregation of ChildSfcMaster objects.
     */
    protected $collSfcMastersRelatedByFromTownId;
    protected $collSfcMastersRelatedByFromTownIdPartial;

    /**
     * @var        ObjectCollection|ChildSfcMaster[] Collection to store aggregation of ChildSfcMaster objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSfcMaster> Collection to store aggregation of ChildSfcMaster objects.
     */
    protected $collSfcMastersRelatedByToTownId;
    protected $collSfcMastersRelatedByToTownIdPartial;

    /**
     * @var        ObjectCollection|ChildTerritoryTowns[] Collection to store aggregation of ChildTerritoryTowns objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTerritoryTowns> Collection to store aggregation of ChildTerritoryTowns objects.
     */
    protected $collTerritoryTownss;
    protected $collTerritoryTownssPartial;

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
     * @var ObjectCollection|ChildAttendance[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAttendance>
     */
    protected $attendancesRelatedByEndItownidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAttendance[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAttendance>
     */
    protected $attendancesRelatedByStartItownidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBeats[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBeats>
     */
    protected $beatssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCitycategory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCitycategory>
     */
    protected $citycategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycalls[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycalls>
     */
    protected $dailycallssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDayplan[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan>
     */
    protected $dayplansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployee[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee>
     */
    protected $employeesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeoDistance[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoDistance>
     */
    protected $geoDistancesRelatedByFromTownIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeoDistance[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoDistance>
     */
    protected $geoDistancesRelatedByToTownIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress>
     */
    protected $onBoardRequestAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletAddress>
     */
    protected $outletAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletOrgData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgData>
     */
    protected $outletOrgDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutlets[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutlets>
     */
    protected $outletssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPositions[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPositions>
     */
    protected $positionssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSfcMaster[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSfcMaster>
     */
    protected $sfcMastersRelatedByFromTownIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSfcMaster[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSfcMaster>
     */
    protected $sfcMastersRelatedByToTownIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTerritoryTowns[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTerritoryTowns>
     */
    protected $territoryTownssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTourplans[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans>
     */
    protected $tourplanssScheduledForDeletion = null;

    /**
     * Initializes internal state of entities\Base\GeoTowns object.
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
     * Compares this with another <code>GeoTowns</code> instance.  If
     * <code>obj</code> is an instance of <code>GeoTowns</code>, delegates to
     * <code>equals(GeoTowns)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [itownid] column value.
     *
     * @return string
     */
    public function getItownid()
    {
        return $this->itownid;
    }

    /**
     * Get the [stownname] column value.
     *
     * @return string|null
     */
    public function getStownname()
    {
        return $this->stownname;
    }

    /**
     * Get the [icityid] column value.
     *
     * @return string|null
     */
    public function getIcityid()
    {
        return $this->icityid;
    }

    /**
     * Get the [stowncode] column value.
     *
     * @return string|null
     */
    public function getStowncode()
    {
        return $this->stowncode;
    }

    /**
     * Get the [optionally formatted] temporal [dcreateddate] column value.
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
    public function getDcreateddate($format = null)
    {
        if ($format === null) {
            return $this->dcreateddate;
        } else {
            return $this->dcreateddate instanceof \DateTimeInterface ? $this->dcreateddate->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [dmodifydate] column value.
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
    public function getDmodifydate($format = null)
    {
        if ($format === null) {
            return $this->dmodifydate;
        } else {
            return $this->dmodifydate instanceof \DateTimeInterface ? $this->dmodifydate->format($format) : null;
        }
    }

    /**
     * Get the [sstatus] column value.
     *
     * @return string|null
     */
    public function getSstatus()
    {
        return $this->sstatus;
    }

    /**
     * Get the [pincode] column value.
     *
     * @return string|null
     */
    public function getPincode()
    {
        return $this->pincode;
    }

    /**
     * Set the value of [itownid] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setItownid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->itownid !== $v) {
            $this->itownid = $v;
            $this->modifiedColumns[GeoTownsTableMap::COL_ITOWNID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [stownname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStownname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->stownname !== $v) {
            $this->stownname = $v;
            $this->modifiedColumns[GeoTownsTableMap::COL_STOWNNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [icityid] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIcityid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->icityid !== $v) {
            $this->icityid = $v;
            $this->modifiedColumns[GeoTownsTableMap::COL_ICITYID] = true;
        }

        if ($this->aGeoCity !== null && $this->aGeoCity->getIcityid() !== $v) {
            $this->aGeoCity = null;
        }

        return $this;
    }

    /**
     * Set the value of [stowncode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStowncode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->stowncode !== $v) {
            $this->stowncode = $v;
            $this->modifiedColumns[GeoTownsTableMap::COL_STOWNCODE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [dcreateddate] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDcreateddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dcreateddate !== null || $dt !== null) {
            if ($this->dcreateddate === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->dcreateddate->format("Y-m-d H:i:s.u")) {
                $this->dcreateddate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[GeoTownsTableMap::COL_DCREATEDDATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [dmodifydate] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDmodifydate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dmodifydate !== null || $dt !== null) {
            if ($this->dmodifydate === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->dmodifydate->format("Y-m-d H:i:s.u")) {
                $this->dmodifydate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[GeoTownsTableMap::COL_DMODIFYDATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [sstatus] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSstatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sstatus !== $v) {
            $this->sstatus = $v;
            $this->modifiedColumns[GeoTownsTableMap::COL_SSTATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pincode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPincode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pincode !== $v) {
            $this->pincode = $v;
            $this->modifiedColumns[GeoTownsTableMap::COL_PINCODE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : GeoTownsTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : GeoTownsTableMap::translateFieldName('Stownname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stownname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : GeoTownsTableMap::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->icityid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : GeoTownsTableMap::translateFieldName('Stowncode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stowncode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : GeoTownsTableMap::translateFieldName('Dcreateddate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcreateddate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : GeoTownsTableMap::translateFieldName('Dmodifydate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dmodifydate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : GeoTownsTableMap::translateFieldName('Sstatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sstatus = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : GeoTownsTableMap::translateFieldName('Pincode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pincode = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = GeoTownsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\GeoTowns'), 0, $e);
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
        if ($this->aGeoCity !== null && $this->icityid !== $this->aGeoCity->getIcityid()) {
            $this->aGeoCity = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(GeoTownsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildGeoTownsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGeoCity = null;
            $this->collAttendancesRelatedByEndItownid = null;

            $this->collAttendancesRelatedByStartItownid = null;

            $this->collBeatss = null;

            $this->collCitycategories = null;

            $this->collDailycallss = null;

            $this->collDayplans = null;

            $this->collEmployees = null;

            $this->collGeoDistancesRelatedByFromTownId = null;

            $this->collGeoDistancesRelatedByToTownId = null;

            $this->collOnBoardRequestAddresses = null;

            $this->collOutletAddresses = null;

            $this->collOutletOrgDatas = null;

            $this->collOutletss = null;

            $this->collPositionss = null;

            $this->collSfcMastersRelatedByFromTownId = null;

            $this->collSfcMastersRelatedByToTownId = null;

            $this->collTerritoryTownss = null;

            $this->collTourplanss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see GeoTowns::setDeleted()
     * @see GeoTowns::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoTownsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildGeoTownsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoTownsTableMap::DATABASE_NAME);
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
                GeoTownsTableMap::addInstanceToPool($this);
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

            if ($this->aGeoCity !== null) {
                if ($this->aGeoCity->isModified() || $this->aGeoCity->isNew()) {
                    $affectedRows += $this->aGeoCity->save($con);
                }
                $this->setGeoCity($this->aGeoCity);
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

            if ($this->attendancesRelatedByEndItownidScheduledForDeletion !== null) {
                if (!$this->attendancesRelatedByEndItownidScheduledForDeletion->isEmpty()) {
                    foreach ($this->attendancesRelatedByEndItownidScheduledForDeletion as $attendanceRelatedByEndItownid) {
                        // need to save related object because we set the relation to null
                        $attendanceRelatedByEndItownid->save($con);
                    }
                    $this->attendancesRelatedByEndItownidScheduledForDeletion = null;
                }
            }

            if ($this->collAttendancesRelatedByEndItownid !== null) {
                foreach ($this->collAttendancesRelatedByEndItownid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->attendancesRelatedByStartItownidScheduledForDeletion !== null) {
                if (!$this->attendancesRelatedByStartItownidScheduledForDeletion->isEmpty()) {
                    foreach ($this->attendancesRelatedByStartItownidScheduledForDeletion as $attendanceRelatedByStartItownid) {
                        // need to save related object because we set the relation to null
                        $attendanceRelatedByStartItownid->save($con);
                    }
                    $this->attendancesRelatedByStartItownidScheduledForDeletion = null;
                }
            }

            if ($this->collAttendancesRelatedByStartItownid !== null) {
                foreach ($this->collAttendancesRelatedByStartItownid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->beatssScheduledForDeletion !== null) {
                if (!$this->beatssScheduledForDeletion->isEmpty()) {
                    foreach ($this->beatssScheduledForDeletion as $beats) {
                        // need to save related object because we set the relation to null
                        $beats->save($con);
                    }
                    $this->beatssScheduledForDeletion = null;
                }
            }

            if ($this->collBeatss !== null) {
                foreach ($this->collBeatss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->citycategoriesScheduledForDeletion !== null) {
                if (!$this->citycategoriesScheduledForDeletion->isEmpty()) {
                    \entities\CitycategoryQuery::create()
                        ->filterByPrimaryKeys($this->citycategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->citycategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collCitycategories !== null) {
                foreach ($this->collCitycategories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dailycallssScheduledForDeletion !== null) {
                if (!$this->dailycallssScheduledForDeletion->isEmpty()) {
                    foreach ($this->dailycallssScheduledForDeletion as $dailycalls) {
                        // need to save related object because we set the relation to null
                        $dailycalls->save($con);
                    }
                    $this->dailycallssScheduledForDeletion = null;
                }
            }

            if ($this->collDailycallss !== null) {
                foreach ($this->collDailycallss as $referrerFK) {
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

            if ($this->employeesScheduledForDeletion !== null) {
                if (!$this->employeesScheduledForDeletion->isEmpty()) {
                    foreach ($this->employeesScheduledForDeletion as $employee) {
                        // need to save related object because we set the relation to null
                        $employee->save($con);
                    }
                    $this->employeesScheduledForDeletion = null;
                }
            }

            if ($this->collEmployees !== null) {
                foreach ($this->collEmployees as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->geoDistancesRelatedByFromTownIdScheduledForDeletion !== null) {
                if (!$this->geoDistancesRelatedByFromTownIdScheduledForDeletion->isEmpty()) {
                    \entities\GeoDistanceQuery::create()
                        ->filterByPrimaryKeys($this->geoDistancesRelatedByFromTownIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->geoDistancesRelatedByFromTownIdScheduledForDeletion = null;
                }
            }

            if ($this->collGeoDistancesRelatedByFromTownId !== null) {
                foreach ($this->collGeoDistancesRelatedByFromTownId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->geoDistancesRelatedByToTownIdScheduledForDeletion !== null) {
                if (!$this->geoDistancesRelatedByToTownIdScheduledForDeletion->isEmpty()) {
                    \entities\GeoDistanceQuery::create()
                        ->filterByPrimaryKeys($this->geoDistancesRelatedByToTownIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->geoDistancesRelatedByToTownIdScheduledForDeletion = null;
                }
            }

            if ($this->collGeoDistancesRelatedByToTownId !== null) {
                foreach ($this->collGeoDistancesRelatedByToTownId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestAddressesScheduledForDeletion !== null) {
                if (!$this->onBoardRequestAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestAddressesScheduledForDeletion as $onBoardRequestAddress) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestAddress->save($con);
                    }
                    $this->onBoardRequestAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestAddresses !== null) {
                foreach ($this->collOnBoardRequestAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletAddressesScheduledForDeletion !== null) {
                if (!$this->outletAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletAddressesScheduledForDeletion as $outletAddress) {
                        // need to save related object because we set the relation to null
                        $outletAddress->save($con);
                    }
                    $this->outletAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collOutletAddresses !== null) {
                foreach ($this->collOutletAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletOrgDatasScheduledForDeletion !== null) {
                if (!$this->outletOrgDatasScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletOrgDatasScheduledForDeletion as $outletOrgData) {
                        // need to save related object because we set the relation to null
                        $outletOrgData->save($con);
                    }
                    $this->outletOrgDatasScheduledForDeletion = null;
                }
            }

            if ($this->collOutletOrgDatas !== null) {
                foreach ($this->collOutletOrgDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletssScheduledForDeletion !== null) {
                if (!$this->outletssScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletssScheduledForDeletion as $outlets) {
                        // need to save related object because we set the relation to null
                        $outlets->save($con);
                    }
                    $this->outletssScheduledForDeletion = null;
                }
            }

            if ($this->collOutletss !== null) {
                foreach ($this->collOutletss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->positionssScheduledForDeletion !== null) {
                if (!$this->positionssScheduledForDeletion->isEmpty()) {
                    foreach ($this->positionssScheduledForDeletion as $positions) {
                        // need to save related object because we set the relation to null
                        $positions->save($con);
                    }
                    $this->positionssScheduledForDeletion = null;
                }
            }

            if ($this->collPositionss !== null) {
                foreach ($this->collPositionss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sfcMastersRelatedByFromTownIdScheduledForDeletion !== null) {
                if (!$this->sfcMastersRelatedByFromTownIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->sfcMastersRelatedByFromTownIdScheduledForDeletion as $sfcMasterRelatedByFromTownId) {
                        // need to save related object because we set the relation to null
                        $sfcMasterRelatedByFromTownId->save($con);
                    }
                    $this->sfcMastersRelatedByFromTownIdScheduledForDeletion = null;
                }
            }

            if ($this->collSfcMastersRelatedByFromTownId !== null) {
                foreach ($this->collSfcMastersRelatedByFromTownId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sfcMastersRelatedByToTownIdScheduledForDeletion !== null) {
                if (!$this->sfcMastersRelatedByToTownIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->sfcMastersRelatedByToTownIdScheduledForDeletion as $sfcMasterRelatedByToTownId) {
                        // need to save related object because we set the relation to null
                        $sfcMasterRelatedByToTownId->save($con);
                    }
                    $this->sfcMastersRelatedByToTownIdScheduledForDeletion = null;
                }
            }

            if ($this->collSfcMastersRelatedByToTownId !== null) {
                foreach ($this->collSfcMastersRelatedByToTownId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->territoryTownssScheduledForDeletion !== null) {
                if (!$this->territoryTownssScheduledForDeletion->isEmpty()) {
                    \entities\TerritoryTownsQuery::create()
                        ->filterByPrimaryKeys($this->territoryTownssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->territoryTownssScheduledForDeletion = null;
                }
            }

            if ($this->collTerritoryTownss !== null) {
                foreach ($this->collTerritoryTownss as $referrerFK) {
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

        $this->modifiedColumns[GeoTownsTableMap::COL_ITOWNID] = true;
        if (null !== $this->itownid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GeoTownsTableMap::COL_ITOWNID . ')');
        }
        if (null === $this->itownid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('geo_towns_itownid_seq')");
                $this->itownid = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GeoTownsTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_STOWNNAME)) {
            $modifiedColumns[':p' . $index++]  = 'stownname';
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_ICITYID)) {
            $modifiedColumns[':p' . $index++]  = 'icityid';
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_STOWNCODE)) {
            $modifiedColumns[':p' . $index++]  = 'stowncode';
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_DCREATEDDATE)) {
            $modifiedColumns[':p' . $index++]  = 'dcreateddate';
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_DMODIFYDATE)) {
            $modifiedColumns[':p' . $index++]  = 'dmodifydate';
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_SSTATUS)) {
            $modifiedColumns[':p' . $index++]  = 'sstatus';
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_PINCODE)) {
            $modifiedColumns[':p' . $index++]  = 'pincode';
        }

        $sql = sprintf(
            'INSERT INTO geo_towns (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'itownid':
                        $stmt->bindValue($identifier, $this->itownid, PDO::PARAM_INT);

                        break;
                    case 'stownname':
                        $stmt->bindValue($identifier, $this->stownname, PDO::PARAM_STR);

                        break;
                    case 'icityid':
                        $stmt->bindValue($identifier, $this->icityid, PDO::PARAM_INT);

                        break;
                    case 'stowncode':
                        $stmt->bindValue($identifier, $this->stowncode, PDO::PARAM_STR);

                        break;
                    case 'dcreateddate':
                        $stmt->bindValue($identifier, $this->dcreateddate ? $this->dcreateddate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'dmodifydate':
                        $stmt->bindValue($identifier, $this->dmodifydate ? $this->dmodifydate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'sstatus':
                        $stmt->bindValue($identifier, $this->sstatus, PDO::PARAM_STR);

                        break;
                    case 'pincode':
                        $stmt->bindValue($identifier, $this->pincode, PDO::PARAM_STR);

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
        $pos = GeoTownsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getItownid();

            case 1:
                return $this->getStownname();

            case 2:
                return $this->getIcityid();

            case 3:
                return $this->getStowncode();

            case 4:
                return $this->getDcreateddate();

            case 5:
                return $this->getDmodifydate();

            case 6:
                return $this->getSstatus();

            case 7:
                return $this->getPincode();

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
        if (isset($alreadyDumpedObjects['GeoTowns'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['GeoTowns'][$this->hashCode()] = true;
        $keys = GeoTownsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getItownid(),
            $keys[1] => $this->getStownname(),
            $keys[2] => $this->getIcityid(),
            $keys[3] => $this->getStowncode(),
            $keys[4] => $this->getDcreateddate(),
            $keys[5] => $this->getDmodifydate(),
            $keys[6] => $this->getSstatus(),
            $keys[7] => $this->getPincode(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGeoCity) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoCity';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_city';
                        break;
                    default:
                        $key = 'GeoCity';
                }

                $result[$key] = $this->aGeoCity->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAttendancesRelatedByEndItownid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'attendances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'attendances';
                        break;
                    default:
                        $key = 'Attendances';
                }

                $result[$key] = $this->collAttendancesRelatedByEndItownid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAttendancesRelatedByStartItownid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'attendances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'attendances';
                        break;
                    default:
                        $key = 'Attendances';
                }

                $result[$key] = $this->collAttendancesRelatedByStartItownid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBeatss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'beatss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'beatss';
                        break;
                    default:
                        $key = 'Beatss';
                }

                $result[$key] = $this->collBeatss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCitycategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'citycategories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'citycategories';
                        break;
                    default:
                        $key = 'Citycategories';
                }

                $result[$key] = $this->collCitycategories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDailycallss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dailycallss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dailycallss';
                        break;
                    default:
                        $key = 'Dailycallss';
                }

                $result[$key] = $this->collDailycallss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collEmployees) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employees';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employees';
                        break;
                    default:
                        $key = 'Employees';
                }

                $result[$key] = $this->collEmployees->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGeoDistancesRelatedByFromTownId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoDistances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_distances';
                        break;
                    default:
                        $key = 'GeoDistances';
                }

                $result[$key] = $this->collGeoDistancesRelatedByFromTownId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGeoDistancesRelatedByToTownId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoDistances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_distances';
                        break;
                    default:
                        $key = 'GeoDistances';
                }

                $result[$key] = $this->collGeoDistancesRelatedByToTownId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequestAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request_addresses';
                        break;
                    default:
                        $key = 'OnBoardRequestAddresses';
                }

                $result[$key] = $this->collOnBoardRequestAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_addresses';
                        break;
                    default:
                        $key = 'OutletAddresses';
                }

                $result[$key] = $this->collOutletAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletOrgDatas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletOrgDatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_org_datas';
                        break;
                    default:
                        $key = 'OutletOrgDatas';
                }

                $result[$key] = $this->collOutletOrgDatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outletss';
                        break;
                    default:
                        $key = 'Outletss';
                }

                $result[$key] = $this->collOutletss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPositionss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'positionss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'positionss';
                        break;
                    default:
                        $key = 'Positionss';
                }

                $result[$key] = $this->collPositionss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSfcMastersRelatedByFromTownId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sfcMasters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sfc_masters';
                        break;
                    default:
                        $key = 'SfcMasters';
                }

                $result[$key] = $this->collSfcMastersRelatedByFromTownId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSfcMastersRelatedByToTownId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sfcMasters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sfc_masters';
                        break;
                    default:
                        $key = 'SfcMasters';
                }

                $result[$key] = $this->collSfcMastersRelatedByToTownId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTerritoryTownss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'territoryTownss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'territory_townss';
                        break;
                    default:
                        $key = 'TerritoryTownss';
                }

                $result[$key] = $this->collTerritoryTownss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = GeoTownsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setItownid($value);
                break;
            case 1:
                $this->setStownname($value);
                break;
            case 2:
                $this->setIcityid($value);
                break;
            case 3:
                $this->setStowncode($value);
                break;
            case 4:
                $this->setDcreateddate($value);
                break;
            case 5:
                $this->setDmodifydate($value);
                break;
            case 6:
                $this->setSstatus($value);
                break;
            case 7:
                $this->setPincode($value);
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
        $keys = GeoTownsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setItownid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setStownname($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIcityid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStowncode($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDcreateddate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDmodifydate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSstatus($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPincode($arr[$keys[7]]);
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
        $criteria = new Criteria(GeoTownsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(GeoTownsTableMap::COL_ITOWNID)) {
            $criteria->add(GeoTownsTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_STOWNNAME)) {
            $criteria->add(GeoTownsTableMap::COL_STOWNNAME, $this->stownname);
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_ICITYID)) {
            $criteria->add(GeoTownsTableMap::COL_ICITYID, $this->icityid);
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_STOWNCODE)) {
            $criteria->add(GeoTownsTableMap::COL_STOWNCODE, $this->stowncode);
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_DCREATEDDATE)) {
            $criteria->add(GeoTownsTableMap::COL_DCREATEDDATE, $this->dcreateddate);
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_DMODIFYDATE)) {
            $criteria->add(GeoTownsTableMap::COL_DMODIFYDATE, $this->dmodifydate);
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_SSTATUS)) {
            $criteria->add(GeoTownsTableMap::COL_SSTATUS, $this->sstatus);
        }
        if ($this->isColumnModified(GeoTownsTableMap::COL_PINCODE)) {
            $criteria->add(GeoTownsTableMap::COL_PINCODE, $this->pincode);
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
        $criteria = ChildGeoTownsQuery::create();
        $criteria->add(GeoTownsTableMap::COL_ITOWNID, $this->itownid);

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
        $validPk = null !== $this->getItownid();

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
        return $this->getItownid();
    }

    /**
     * Generic method to set the primary key (itownid column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setItownid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getItownid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\GeoTowns (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setStownname($this->getStownname());
        $copyObj->setIcityid($this->getIcityid());
        $copyObj->setStowncode($this->getStowncode());
        $copyObj->setDcreateddate($this->getDcreateddate());
        $copyObj->setDmodifydate($this->getDmodifydate());
        $copyObj->setSstatus($this->getSstatus());
        $copyObj->setPincode($this->getPincode());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAttendancesRelatedByEndItownid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAttendanceRelatedByEndItownid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAttendancesRelatedByStartItownid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAttendanceRelatedByStartItownid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBeatss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBeats($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCitycategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCitycategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycalls($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDayplans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDayplan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployees() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployee($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGeoDistancesRelatedByFromTownId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeoDistanceRelatedByFromTownId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGeoDistancesRelatedByToTownId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeoDistanceRelatedByToTownId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletOrgDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletOrgData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutlets($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPositionss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPositions($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSfcMastersRelatedByFromTownId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSfcMasterRelatedByFromTownId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSfcMastersRelatedByToTownId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSfcMasterRelatedByToTownId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTerritoryTownss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTerritoryTowns($relObj->copy($deepCopy));
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
            $copyObj->setItownid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\GeoTowns Clone of current object.
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
     * Declares an association between this object and a ChildGeoCity object.
     *
     * @param ChildGeoCity|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoCity(ChildGeoCity $v = null)
    {
        if ($v === null) {
            $this->setIcityid(NULL);
        } else {
            $this->setIcityid($v->getIcityid());
        }

        $this->aGeoCity = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoCity object, it will not be re-added.
        if ($v !== null) {
            $v->addGeoTowns($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoCity object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoCity|null The associated ChildGeoCity object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoCity(?ConnectionInterface $con = null)
    {
        if ($this->aGeoCity === null && (($this->icityid !== "" && $this->icityid !== null))) {
            $this->aGeoCity = ChildGeoCityQuery::create()->findPk($this->icityid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoCity->addGeoTownss($this);
             */
        }

        return $this->aGeoCity;
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
        if ('AttendanceRelatedByEndItownid' === $relationName) {
            $this->initAttendancesRelatedByEndItownid();
            return;
        }
        if ('AttendanceRelatedByStartItownid' === $relationName) {
            $this->initAttendancesRelatedByStartItownid();
            return;
        }
        if ('Beats' === $relationName) {
            $this->initBeatss();
            return;
        }
        if ('Citycategory' === $relationName) {
            $this->initCitycategories();
            return;
        }
        if ('Dailycalls' === $relationName) {
            $this->initDailycallss();
            return;
        }
        if ('Dayplan' === $relationName) {
            $this->initDayplans();
            return;
        }
        if ('Employee' === $relationName) {
            $this->initEmployees();
            return;
        }
        if ('GeoDistanceRelatedByFromTownId' === $relationName) {
            $this->initGeoDistancesRelatedByFromTownId();
            return;
        }
        if ('GeoDistanceRelatedByToTownId' === $relationName) {
            $this->initGeoDistancesRelatedByToTownId();
            return;
        }
        if ('OnBoardRequestAddress' === $relationName) {
            $this->initOnBoardRequestAddresses();
            return;
        }
        if ('OutletAddress' === $relationName) {
            $this->initOutletAddresses();
            return;
        }
        if ('OutletOrgData' === $relationName) {
            $this->initOutletOrgDatas();
            return;
        }
        if ('Outlets' === $relationName) {
            $this->initOutletss();
            return;
        }
        if ('Positions' === $relationName) {
            $this->initPositionss();
            return;
        }
        if ('SfcMasterRelatedByFromTownId' === $relationName) {
            $this->initSfcMastersRelatedByFromTownId();
            return;
        }
        if ('SfcMasterRelatedByToTownId' === $relationName) {
            $this->initSfcMastersRelatedByToTownId();
            return;
        }
        if ('TerritoryTowns' === $relationName) {
            $this->initTerritoryTownss();
            return;
        }
        if ('Tourplans' === $relationName) {
            $this->initTourplanss();
            return;
        }
    }

    /**
     * Clears out the collAttendancesRelatedByEndItownid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAttendancesRelatedByEndItownid()
     */
    public function clearAttendancesRelatedByEndItownid()
    {
        $this->collAttendancesRelatedByEndItownid = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAttendancesRelatedByEndItownid collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAttendancesRelatedByEndItownid($v = true): void
    {
        $this->collAttendancesRelatedByEndItownidPartial = $v;
    }

    /**
     * Initializes the collAttendancesRelatedByEndItownid collection.
     *
     * By default this just sets the collAttendancesRelatedByEndItownid collection to an empty array (like clearcollAttendancesRelatedByEndItownid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAttendancesRelatedByEndItownid(bool $overrideExisting = true): void
    {
        if (null !== $this->collAttendancesRelatedByEndItownid && !$overrideExisting) {
            return;
        }

        $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

        $this->collAttendancesRelatedByEndItownid = new $collectionClassName;
        $this->collAttendancesRelatedByEndItownid->setModel('\entities\Attendance');
    }

    /**
     * Gets an array of ChildAttendance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance> List of ChildAttendance objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAttendancesRelatedByEndItownid(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAttendancesRelatedByEndItownidPartial && !$this->isNew();
        if (null === $this->collAttendancesRelatedByEndItownid || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAttendancesRelatedByEndItownid) {
                    $this->initAttendancesRelatedByEndItownid();
                } else {
                    $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

                    $collAttendancesRelatedByEndItownid = new $collectionClassName;
                    $collAttendancesRelatedByEndItownid->setModel('\entities\Attendance');

                    return $collAttendancesRelatedByEndItownid;
                }
            } else {
                $collAttendancesRelatedByEndItownid = ChildAttendanceQuery::create(null, $criteria)
                    ->filterByGeoTownsRelatedByEndItownid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAttendancesRelatedByEndItownidPartial && count($collAttendancesRelatedByEndItownid)) {
                        $this->initAttendancesRelatedByEndItownid(false);

                        foreach ($collAttendancesRelatedByEndItownid as $obj) {
                            if (false == $this->collAttendancesRelatedByEndItownid->contains($obj)) {
                                $this->collAttendancesRelatedByEndItownid->append($obj);
                            }
                        }

                        $this->collAttendancesRelatedByEndItownidPartial = true;
                    }

                    return $collAttendancesRelatedByEndItownid;
                }

                if ($partial && $this->collAttendancesRelatedByEndItownid) {
                    foreach ($this->collAttendancesRelatedByEndItownid as $obj) {
                        if ($obj->isNew()) {
                            $collAttendancesRelatedByEndItownid[] = $obj;
                        }
                    }
                }

                $this->collAttendancesRelatedByEndItownid = $collAttendancesRelatedByEndItownid;
                $this->collAttendancesRelatedByEndItownidPartial = false;
            }
        }

        return $this->collAttendancesRelatedByEndItownid;
    }

    /**
     * Sets a collection of ChildAttendance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $attendancesRelatedByEndItownid A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAttendancesRelatedByEndItownid(Collection $attendancesRelatedByEndItownid, ?ConnectionInterface $con = null)
    {
        /** @var ChildAttendance[] $attendancesRelatedByEndItownidToDelete */
        $attendancesRelatedByEndItownidToDelete = $this->getAttendancesRelatedByEndItownid(new Criteria(), $con)->diff($attendancesRelatedByEndItownid);


        $this->attendancesRelatedByEndItownidScheduledForDeletion = $attendancesRelatedByEndItownidToDelete;

        foreach ($attendancesRelatedByEndItownidToDelete as $attendanceRelatedByEndItownidRemoved) {
            $attendanceRelatedByEndItownidRemoved->setGeoTownsRelatedByEndItownid(null);
        }

        $this->collAttendancesRelatedByEndItownid = null;
        foreach ($attendancesRelatedByEndItownid as $attendanceRelatedByEndItownid) {
            $this->addAttendanceRelatedByEndItownid($attendanceRelatedByEndItownid);
        }

        $this->collAttendancesRelatedByEndItownid = $attendancesRelatedByEndItownid;
        $this->collAttendancesRelatedByEndItownidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Attendance objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Attendance objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAttendancesRelatedByEndItownid(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAttendancesRelatedByEndItownidPartial && !$this->isNew();
        if (null === $this->collAttendancesRelatedByEndItownid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAttendancesRelatedByEndItownid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAttendancesRelatedByEndItownid());
            }

            $query = ChildAttendanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTownsRelatedByEndItownid($this)
                ->count($con);
        }

        return count($this->collAttendancesRelatedByEndItownid);
    }

    /**
     * Method called to associate a ChildAttendance object to this object
     * through the ChildAttendance foreign key attribute.
     *
     * @param ChildAttendance $l ChildAttendance
     * @return $this The current object (for fluent API support)
     */
    public function addAttendanceRelatedByEndItownid(ChildAttendance $l)
    {
        if ($this->collAttendancesRelatedByEndItownid === null) {
            $this->initAttendancesRelatedByEndItownid();
            $this->collAttendancesRelatedByEndItownidPartial = true;
        }

        if (!$this->collAttendancesRelatedByEndItownid->contains($l)) {
            $this->doAddAttendanceRelatedByEndItownid($l);

            if ($this->attendancesRelatedByEndItownidScheduledForDeletion and $this->attendancesRelatedByEndItownidScheduledForDeletion->contains($l)) {
                $this->attendancesRelatedByEndItownidScheduledForDeletion->remove($this->attendancesRelatedByEndItownidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAttendance $attendanceRelatedByEndItownid The ChildAttendance object to add.
     */
    protected function doAddAttendanceRelatedByEndItownid(ChildAttendance $attendanceRelatedByEndItownid): void
    {
        $this->collAttendancesRelatedByEndItownid[]= $attendanceRelatedByEndItownid;
        $attendanceRelatedByEndItownid->setGeoTownsRelatedByEndItownid($this);
    }

    /**
     * @param ChildAttendance $attendanceRelatedByEndItownid The ChildAttendance object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAttendanceRelatedByEndItownid(ChildAttendance $attendanceRelatedByEndItownid)
    {
        if ($this->getAttendancesRelatedByEndItownid()->contains($attendanceRelatedByEndItownid)) {
            $pos = $this->collAttendancesRelatedByEndItownid->search($attendanceRelatedByEndItownid);
            $this->collAttendancesRelatedByEndItownid->remove($pos);
            if (null === $this->attendancesRelatedByEndItownidScheduledForDeletion) {
                $this->attendancesRelatedByEndItownidScheduledForDeletion = clone $this->collAttendancesRelatedByEndItownid;
                $this->attendancesRelatedByEndItownidScheduledForDeletion->clear();
            }
            $this->attendancesRelatedByEndItownidScheduledForDeletion[]= $attendanceRelatedByEndItownid;
            $attendanceRelatedByEndItownid->setGeoTownsRelatedByEndItownid(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related AttendancesRelatedByEndItownid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesRelatedByEndItownidJoinExpenses(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Expenses', $joinBehavior);

        return $this->getAttendancesRelatedByEndItownid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related AttendancesRelatedByEndItownid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesRelatedByEndItownidJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getAttendancesRelatedByEndItownid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related AttendancesRelatedByEndItownid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesRelatedByEndItownidJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getAttendancesRelatedByEndItownid($query, $con);
    }

    /**
     * Clears out the collAttendancesRelatedByStartItownid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAttendancesRelatedByStartItownid()
     */
    public function clearAttendancesRelatedByStartItownid()
    {
        $this->collAttendancesRelatedByStartItownid = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAttendancesRelatedByStartItownid collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAttendancesRelatedByStartItownid($v = true): void
    {
        $this->collAttendancesRelatedByStartItownidPartial = $v;
    }

    /**
     * Initializes the collAttendancesRelatedByStartItownid collection.
     *
     * By default this just sets the collAttendancesRelatedByStartItownid collection to an empty array (like clearcollAttendancesRelatedByStartItownid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAttendancesRelatedByStartItownid(bool $overrideExisting = true): void
    {
        if (null !== $this->collAttendancesRelatedByStartItownid && !$overrideExisting) {
            return;
        }

        $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

        $this->collAttendancesRelatedByStartItownid = new $collectionClassName;
        $this->collAttendancesRelatedByStartItownid->setModel('\entities\Attendance');
    }

    /**
     * Gets an array of ChildAttendance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance> List of ChildAttendance objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAttendancesRelatedByStartItownid(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAttendancesRelatedByStartItownidPartial && !$this->isNew();
        if (null === $this->collAttendancesRelatedByStartItownid || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAttendancesRelatedByStartItownid) {
                    $this->initAttendancesRelatedByStartItownid();
                } else {
                    $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

                    $collAttendancesRelatedByStartItownid = new $collectionClassName;
                    $collAttendancesRelatedByStartItownid->setModel('\entities\Attendance');

                    return $collAttendancesRelatedByStartItownid;
                }
            } else {
                $collAttendancesRelatedByStartItownid = ChildAttendanceQuery::create(null, $criteria)
                    ->filterByGeoTownsRelatedByStartItownid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAttendancesRelatedByStartItownidPartial && count($collAttendancesRelatedByStartItownid)) {
                        $this->initAttendancesRelatedByStartItownid(false);

                        foreach ($collAttendancesRelatedByStartItownid as $obj) {
                            if (false == $this->collAttendancesRelatedByStartItownid->contains($obj)) {
                                $this->collAttendancesRelatedByStartItownid->append($obj);
                            }
                        }

                        $this->collAttendancesRelatedByStartItownidPartial = true;
                    }

                    return $collAttendancesRelatedByStartItownid;
                }

                if ($partial && $this->collAttendancesRelatedByStartItownid) {
                    foreach ($this->collAttendancesRelatedByStartItownid as $obj) {
                        if ($obj->isNew()) {
                            $collAttendancesRelatedByStartItownid[] = $obj;
                        }
                    }
                }

                $this->collAttendancesRelatedByStartItownid = $collAttendancesRelatedByStartItownid;
                $this->collAttendancesRelatedByStartItownidPartial = false;
            }
        }

        return $this->collAttendancesRelatedByStartItownid;
    }

    /**
     * Sets a collection of ChildAttendance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $attendancesRelatedByStartItownid A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAttendancesRelatedByStartItownid(Collection $attendancesRelatedByStartItownid, ?ConnectionInterface $con = null)
    {
        /** @var ChildAttendance[] $attendancesRelatedByStartItownidToDelete */
        $attendancesRelatedByStartItownidToDelete = $this->getAttendancesRelatedByStartItownid(new Criteria(), $con)->diff($attendancesRelatedByStartItownid);


        $this->attendancesRelatedByStartItownidScheduledForDeletion = $attendancesRelatedByStartItownidToDelete;

        foreach ($attendancesRelatedByStartItownidToDelete as $attendanceRelatedByStartItownidRemoved) {
            $attendanceRelatedByStartItownidRemoved->setGeoTownsRelatedByStartItownid(null);
        }

        $this->collAttendancesRelatedByStartItownid = null;
        foreach ($attendancesRelatedByStartItownid as $attendanceRelatedByStartItownid) {
            $this->addAttendanceRelatedByStartItownid($attendanceRelatedByStartItownid);
        }

        $this->collAttendancesRelatedByStartItownid = $attendancesRelatedByStartItownid;
        $this->collAttendancesRelatedByStartItownidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Attendance objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Attendance objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAttendancesRelatedByStartItownid(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAttendancesRelatedByStartItownidPartial && !$this->isNew();
        if (null === $this->collAttendancesRelatedByStartItownid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAttendancesRelatedByStartItownid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAttendancesRelatedByStartItownid());
            }

            $query = ChildAttendanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTownsRelatedByStartItownid($this)
                ->count($con);
        }

        return count($this->collAttendancesRelatedByStartItownid);
    }

    /**
     * Method called to associate a ChildAttendance object to this object
     * through the ChildAttendance foreign key attribute.
     *
     * @param ChildAttendance $l ChildAttendance
     * @return $this The current object (for fluent API support)
     */
    public function addAttendanceRelatedByStartItownid(ChildAttendance $l)
    {
        if ($this->collAttendancesRelatedByStartItownid === null) {
            $this->initAttendancesRelatedByStartItownid();
            $this->collAttendancesRelatedByStartItownidPartial = true;
        }

        if (!$this->collAttendancesRelatedByStartItownid->contains($l)) {
            $this->doAddAttendanceRelatedByStartItownid($l);

            if ($this->attendancesRelatedByStartItownidScheduledForDeletion and $this->attendancesRelatedByStartItownidScheduledForDeletion->contains($l)) {
                $this->attendancesRelatedByStartItownidScheduledForDeletion->remove($this->attendancesRelatedByStartItownidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAttendance $attendanceRelatedByStartItownid The ChildAttendance object to add.
     */
    protected function doAddAttendanceRelatedByStartItownid(ChildAttendance $attendanceRelatedByStartItownid): void
    {
        $this->collAttendancesRelatedByStartItownid[]= $attendanceRelatedByStartItownid;
        $attendanceRelatedByStartItownid->setGeoTownsRelatedByStartItownid($this);
    }

    /**
     * @param ChildAttendance $attendanceRelatedByStartItownid The ChildAttendance object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAttendanceRelatedByStartItownid(ChildAttendance $attendanceRelatedByStartItownid)
    {
        if ($this->getAttendancesRelatedByStartItownid()->contains($attendanceRelatedByStartItownid)) {
            $pos = $this->collAttendancesRelatedByStartItownid->search($attendanceRelatedByStartItownid);
            $this->collAttendancesRelatedByStartItownid->remove($pos);
            if (null === $this->attendancesRelatedByStartItownidScheduledForDeletion) {
                $this->attendancesRelatedByStartItownidScheduledForDeletion = clone $this->collAttendancesRelatedByStartItownid;
                $this->attendancesRelatedByStartItownidScheduledForDeletion->clear();
            }
            $this->attendancesRelatedByStartItownidScheduledForDeletion[]= $attendanceRelatedByStartItownid;
            $attendanceRelatedByStartItownid->setGeoTownsRelatedByStartItownid(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related AttendancesRelatedByStartItownid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesRelatedByStartItownidJoinExpenses(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Expenses', $joinBehavior);

        return $this->getAttendancesRelatedByStartItownid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related AttendancesRelatedByStartItownid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesRelatedByStartItownidJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getAttendancesRelatedByStartItownid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related AttendancesRelatedByStartItownid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesRelatedByStartItownidJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getAttendancesRelatedByStartItownid($query, $con);
    }

    /**
     * Clears out the collBeatss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBeatss()
     */
    public function clearBeatss()
    {
        $this->collBeatss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBeatss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBeatss($v = true): void
    {
        $this->collBeatssPartial = $v;
    }

    /**
     * Initializes the collBeatss collection.
     *
     * By default this just sets the collBeatss collection to an empty array (like clearcollBeatss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBeatss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBeatss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BeatsTableMap::getTableMap()->getCollectionClassName();

        $this->collBeatss = new $collectionClassName;
        $this->collBeatss->setModel('\entities\Beats');
    }

    /**
     * Gets an array of ChildBeats objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats> List of ChildBeats objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBeatss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBeatssPartial && !$this->isNew();
        if (null === $this->collBeatss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBeatss) {
                    $this->initBeatss();
                } else {
                    $collectionClassName = BeatsTableMap::getTableMap()->getCollectionClassName();

                    $collBeatss = new $collectionClassName;
                    $collBeatss->setModel('\entities\Beats');

                    return $collBeatss;
                }
            } else {
                $collBeatss = ChildBeatsQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBeatssPartial && count($collBeatss)) {
                        $this->initBeatss(false);

                        foreach ($collBeatss as $obj) {
                            if (false == $this->collBeatss->contains($obj)) {
                                $this->collBeatss->append($obj);
                            }
                        }

                        $this->collBeatssPartial = true;
                    }

                    return $collBeatss;
                }

                if ($partial && $this->collBeatss) {
                    foreach ($this->collBeatss as $obj) {
                        if ($obj->isNew()) {
                            $collBeatss[] = $obj;
                        }
                    }
                }

                $this->collBeatss = $collBeatss;
                $this->collBeatssPartial = false;
            }
        }

        return $this->collBeatss;
    }

    /**
     * Sets a collection of ChildBeats objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $beatss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBeatss(Collection $beatss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBeats[] $beatssToDelete */
        $beatssToDelete = $this->getBeatss(new Criteria(), $con)->diff($beatss);


        $this->beatssScheduledForDeletion = $beatssToDelete;

        foreach ($beatssToDelete as $beatsRemoved) {
            $beatsRemoved->setGeoTowns(null);
        }

        $this->collBeatss = null;
        foreach ($beatss as $beats) {
            $this->addBeats($beats);
        }

        $this->collBeatss = $beatss;
        $this->collBeatssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Beats objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Beats objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBeatss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBeatssPartial && !$this->isNew();
        if (null === $this->collBeatss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBeatss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBeatss());
            }

            $query = ChildBeatsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collBeatss);
    }

    /**
     * Method called to associate a ChildBeats object to this object
     * through the ChildBeats foreign key attribute.
     *
     * @param ChildBeats $l ChildBeats
     * @return $this The current object (for fluent API support)
     */
    public function addBeats(ChildBeats $l)
    {
        if ($this->collBeatss === null) {
            $this->initBeatss();
            $this->collBeatssPartial = true;
        }

        if (!$this->collBeatss->contains($l)) {
            $this->doAddBeats($l);

            if ($this->beatssScheduledForDeletion and $this->beatssScheduledForDeletion->contains($l)) {
                $this->beatssScheduledForDeletion->remove($this->beatssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBeats $beats The ChildBeats object to add.
     */
    protected function doAddBeats(ChildBeats $beats): void
    {
        $this->collBeatss[]= $beats;
        $beats->setGeoTowns($this);
    }

    /**
     * @param ChildBeats $beats The ChildBeats object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBeats(ChildBeats $beats)
    {
        if ($this->getBeatss()->contains($beats)) {
            $pos = $this->collBeatss->search($beats);
            $this->collBeatss->remove($pos);
            if (null === $this->beatssScheduledForDeletion) {
                $this->beatssScheduledForDeletion = clone $this->collBeatss;
                $this->beatssScheduledForDeletion->clear();
            }
            $this->beatssScheduledForDeletion[]= $beats;
            $beats->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats}> List of ChildBeats objects
     */
    public function getBeatssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatsQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getBeatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats}> List of ChildBeats objects
     */
    public function getBeatssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBeatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats}> List of ChildBeats objects
     */
    public function getBeatssJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatsQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getBeatss($query, $con);
    }

    /**
     * Clears out the collCitycategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCitycategories()
     */
    public function clearCitycategories()
    {
        $this->collCitycategories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCitycategories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCitycategories($v = true): void
    {
        $this->collCitycategoriesPartial = $v;
    }

    /**
     * Initializes the collCitycategories collection.
     *
     * By default this just sets the collCitycategories collection to an empty array (like clearcollCitycategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCitycategories(bool $overrideExisting = true): void
    {
        if (null !== $this->collCitycategories && !$overrideExisting) {
            return;
        }

        $collectionClassName = CitycategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collCitycategories = new $collectionClassName;
        $this->collCitycategories->setModel('\entities\Citycategory');
    }

    /**
     * Gets an array of ChildCitycategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCitycategory[] List of ChildCitycategory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCitycategory> List of ChildCitycategory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCitycategories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCitycategoriesPartial && !$this->isNew();
        if (null === $this->collCitycategories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCitycategories) {
                    $this->initCitycategories();
                } else {
                    $collectionClassName = CitycategoryTableMap::getTableMap()->getCollectionClassName();

                    $collCitycategories = new $collectionClassName;
                    $collCitycategories->setModel('\entities\Citycategory');

                    return $collCitycategories;
                }
            } else {
                $collCitycategories = ChildCitycategoryQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCitycategoriesPartial && count($collCitycategories)) {
                        $this->initCitycategories(false);

                        foreach ($collCitycategories as $obj) {
                            if (false == $this->collCitycategories->contains($obj)) {
                                $this->collCitycategories->append($obj);
                            }
                        }

                        $this->collCitycategoriesPartial = true;
                    }

                    return $collCitycategories;
                }

                if ($partial && $this->collCitycategories) {
                    foreach ($this->collCitycategories as $obj) {
                        if ($obj->isNew()) {
                            $collCitycategories[] = $obj;
                        }
                    }
                }

                $this->collCitycategories = $collCitycategories;
                $this->collCitycategoriesPartial = false;
            }
        }

        return $this->collCitycategories;
    }

    /**
     * Sets a collection of ChildCitycategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $citycategories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCitycategories(Collection $citycategories, ?ConnectionInterface $con = null)
    {
        /** @var ChildCitycategory[] $citycategoriesToDelete */
        $citycategoriesToDelete = $this->getCitycategories(new Criteria(), $con)->diff($citycategories);


        $this->citycategoriesScheduledForDeletion = $citycategoriesToDelete;

        foreach ($citycategoriesToDelete as $citycategoryRemoved) {
            $citycategoryRemoved->setGeoTowns(null);
        }

        $this->collCitycategories = null;
        foreach ($citycategories as $citycategory) {
            $this->addCitycategory($citycategory);
        }

        $this->collCitycategories = $citycategories;
        $this->collCitycategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Citycategory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Citycategory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCitycategories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCitycategoriesPartial && !$this->isNew();
        if (null === $this->collCitycategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCitycategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCitycategories());
            }

            $query = ChildCitycategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collCitycategories);
    }

    /**
     * Method called to associate a ChildCitycategory object to this object
     * through the ChildCitycategory foreign key attribute.
     *
     * @param ChildCitycategory $l ChildCitycategory
     * @return $this The current object (for fluent API support)
     */
    public function addCitycategory(ChildCitycategory $l)
    {
        if ($this->collCitycategories === null) {
            $this->initCitycategories();
            $this->collCitycategoriesPartial = true;
        }

        if (!$this->collCitycategories->contains($l)) {
            $this->doAddCitycategory($l);

            if ($this->citycategoriesScheduledForDeletion and $this->citycategoriesScheduledForDeletion->contains($l)) {
                $this->citycategoriesScheduledForDeletion->remove($this->citycategoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCitycategory $citycategory The ChildCitycategory object to add.
     */
    protected function doAddCitycategory(ChildCitycategory $citycategory): void
    {
        $this->collCitycategories[]= $citycategory;
        $citycategory->setGeoTowns($this);
    }

    /**
     * @param ChildCitycategory $citycategory The ChildCitycategory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCitycategory(ChildCitycategory $citycategory)
    {
        if ($this->getCitycategories()->contains($citycategory)) {
            $pos = $this->collCitycategories->search($citycategory);
            $this->collCitycategories->remove($pos);
            if (null === $this->citycategoriesScheduledForDeletion) {
                $this->citycategoriesScheduledForDeletion = clone $this->collCitycategories;
                $this->citycategoriesScheduledForDeletion->clear();
            }
            $this->citycategoriesScheduledForDeletion[]= clone $citycategory;
            $citycategory->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Citycategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCitycategory[] List of ChildCitycategory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCitycategory}> List of ChildCitycategory objects
     */
    public function getCitycategoriesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCitycategoryQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getCitycategories($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Citycategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCitycategory[] List of ChildCitycategory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCitycategory}> List of ChildCitycategory objects
     */
    public function getCitycategoriesJoinGradeMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCitycategoryQuery::create(null, $criteria);
        $query->joinWith('GradeMaster', $joinBehavior);

        return $this->getCitycategories($query, $con);
    }

    /**
     * Clears out the collDailycallss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDailycallss()
     */
    public function clearDailycallss()
    {
        $this->collDailycallss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDailycallss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDailycallss($v = true): void
    {
        $this->collDailycallssPartial = $v;
    }

    /**
     * Initializes the collDailycallss collection.
     *
     * By default this just sets the collDailycallss collection to an empty array (like clearcollDailycallss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDailycallss(bool $overrideExisting = true): void
    {
        if (null !== $this->collDailycallss && !$overrideExisting) {
            return;
        }

        $collectionClassName = DailycallsTableMap::getTableMap()->getCollectionClassName();

        $this->collDailycallss = new $collectionClassName;
        $this->collDailycallss->setModel('\entities\Dailycalls');
    }

    /**
     * Gets an array of ChildDailycalls objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls> List of ChildDailycalls objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDailycallss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDailycallssPartial && !$this->isNew();
        if (null === $this->collDailycallss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDailycallss) {
                    $this->initDailycallss();
                } else {
                    $collectionClassName = DailycallsTableMap::getTableMap()->getCollectionClassName();

                    $collDailycallss = new $collectionClassName;
                    $collDailycallss->setModel('\entities\Dailycalls');

                    return $collDailycallss;
                }
            } else {
                $collDailycallss = ChildDailycallsQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDailycallssPartial && count($collDailycallss)) {
                        $this->initDailycallss(false);

                        foreach ($collDailycallss as $obj) {
                            if (false == $this->collDailycallss->contains($obj)) {
                                $this->collDailycallss->append($obj);
                            }
                        }

                        $this->collDailycallssPartial = true;
                    }

                    return $collDailycallss;
                }

                if ($partial && $this->collDailycallss) {
                    foreach ($this->collDailycallss as $obj) {
                        if ($obj->isNew()) {
                            $collDailycallss[] = $obj;
                        }
                    }
                }

                $this->collDailycallss = $collDailycallss;
                $this->collDailycallssPartial = false;
            }
        }

        return $this->collDailycallss;
    }

    /**
     * Sets a collection of ChildDailycalls objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dailycallss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDailycallss(Collection $dailycallss, ?ConnectionInterface $con = null)
    {
        /** @var ChildDailycalls[] $dailycallssToDelete */
        $dailycallssToDelete = $this->getDailycallss(new Criteria(), $con)->diff($dailycallss);


        $this->dailycallssScheduledForDeletion = $dailycallssToDelete;

        foreach ($dailycallssToDelete as $dailycallsRemoved) {
            $dailycallsRemoved->setGeoTowns(null);
        }

        $this->collDailycallss = null;
        foreach ($dailycallss as $dailycalls) {
            $this->addDailycalls($dailycalls);
        }

        $this->collDailycallss = $dailycallss;
        $this->collDailycallssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Dailycalls objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Dailycalls objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDailycallss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDailycallssPartial && !$this->isNew();
        if (null === $this->collDailycallss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDailycallss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDailycallss());
            }

            $query = ChildDailycallsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collDailycallss);
    }

    /**
     * Method called to associate a ChildDailycalls object to this object
     * through the ChildDailycalls foreign key attribute.
     *
     * @param ChildDailycalls $l ChildDailycalls
     * @return $this The current object (for fluent API support)
     */
    public function addDailycalls(ChildDailycalls $l)
    {
        if ($this->collDailycallss === null) {
            $this->initDailycallss();
            $this->collDailycallssPartial = true;
        }

        if (!$this->collDailycallss->contains($l)) {
            $this->doAddDailycalls($l);

            if ($this->dailycallssScheduledForDeletion and $this->dailycallssScheduledForDeletion->contains($l)) {
                $this->dailycallssScheduledForDeletion->remove($this->dailycallssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDailycalls $dailycalls The ChildDailycalls object to add.
     */
    protected function doAddDailycalls(ChildDailycalls $dailycalls): void
    {
        $this->collDailycallss[]= $dailycalls;
        $dailycalls->setGeoTowns($this);
    }

    /**
     * @param ChildDailycalls $dailycalls The ChildDailycalls object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDailycalls(ChildDailycalls $dailycalls)
    {
        if ($this->getDailycallss()->contains($dailycalls)) {
            $pos = $this->collDailycallss->search($dailycalls);
            $this->collDailycallss->remove($pos);
            if (null === $this->dailycallssScheduledForDeletion) {
                $this->dailycallssScheduledForDeletion = clone $this->collDailycallss;
                $this->dailycallssScheduledForDeletion->clear();
            }
            $this->dailycallssScheduledForDeletion[]= $dailycalls;
            $dailycalls->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getDailycallss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDailycallss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinAgendatypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('Agendatypes', $joinBehavior);

        return $this->getDailycallss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getDailycallss($query, $con);
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
     * If this ChildGeoTowns is new, it will return
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
                    ->filterByGeoTowns($this)
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
            $dayplanRemoved->setGeoTowns(null);
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
                ->filterByGeoTowns($this)
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
        $dayplan->setGeoTowns($this);
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
            $dayplan->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getDayplans($query, $con);
    }

    /**
     * Clears out the collEmployees collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployees()
     */
    public function clearEmployees()
    {
        $this->collEmployees = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployees collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployees($v = true): void
    {
        $this->collEmployeesPartial = $v;
    }

    /**
     * Initializes the collEmployees collection.
     *
     * By default this just sets the collEmployees collection to an empty array (like clearcollEmployees());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployees(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployees && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployees = new $collectionClassName;
        $this->collEmployees->setModel('\entities\Employee');
    }

    /**
     * Gets an array of ChildEmployee objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee> List of ChildEmployee objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployees(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeesPartial && !$this->isNew();
        if (null === $this->collEmployees || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployees) {
                    $this->initEmployees();
                } else {
                    $collectionClassName = EmployeeTableMap::getTableMap()->getCollectionClassName();

                    $collEmployees = new $collectionClassName;
                    $collEmployees->setModel('\entities\Employee');

                    return $collEmployees;
                }
            } else {
                $collEmployees = ChildEmployeeQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeesPartial && count($collEmployees)) {
                        $this->initEmployees(false);

                        foreach ($collEmployees as $obj) {
                            if (false == $this->collEmployees->contains($obj)) {
                                $this->collEmployees->append($obj);
                            }
                        }

                        $this->collEmployeesPartial = true;
                    }

                    return $collEmployees;
                }

                if ($partial && $this->collEmployees) {
                    foreach ($this->collEmployees as $obj) {
                        if ($obj->isNew()) {
                            $collEmployees[] = $obj;
                        }
                    }
                }

                $this->collEmployees = $collEmployees;
                $this->collEmployeesPartial = false;
            }
        }

        return $this->collEmployees;
    }

    /**
     * Sets a collection of ChildEmployee objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employees A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployees(Collection $employees, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployee[] $employeesToDelete */
        $employeesToDelete = $this->getEmployees(new Criteria(), $con)->diff($employees);


        $this->employeesScheduledForDeletion = $employeesToDelete;

        foreach ($employeesToDelete as $employeeRemoved) {
            $employeeRemoved->setGeoTowns(null);
        }

        $this->collEmployees = null;
        foreach ($employees as $employee) {
            $this->addEmployee($employee);
        }

        $this->collEmployees = $employees;
        $this->collEmployeesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employee objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Employee objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEmployees(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeesPartial && !$this->isNew();
        if (null === $this->collEmployees || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployees) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployees());
            }

            $query = ChildEmployeeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collEmployees);
    }

    /**
     * Method called to associate a ChildEmployee object to this object
     * through the ChildEmployee foreign key attribute.
     *
     * @param ChildEmployee $l ChildEmployee
     * @return $this The current object (for fluent API support)
     */
    public function addEmployee(ChildEmployee $l)
    {
        if ($this->collEmployees === null) {
            $this->initEmployees();
            $this->collEmployeesPartial = true;
        }

        if (!$this->collEmployees->contains($l)) {
            $this->doAddEmployee($l);

            if ($this->employeesScheduledForDeletion and $this->employeesScheduledForDeletion->contains($l)) {
                $this->employeesScheduledForDeletion->remove($this->employeesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployee $employee The ChildEmployee object to add.
     */
    protected function doAddEmployee(ChildEmployee $employee): void
    {
        $this->collEmployees[]= $employee;
        $employee->setGeoTowns($this);
    }

    /**
     * @param ChildEmployee $employee The ChildEmployee object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployee(ChildEmployee $employee)
    {
        if ($this->getEmployees()->contains($employee)) {
            $pos = $this->collEmployees->search($employee);
            $this->collEmployees->remove($pos);
            if (null === $this->employeesScheduledForDeletion) {
                $this->employeesScheduledForDeletion = clone $this->collEmployees;
                $this->employeesScheduledForDeletion->clear();
            }
            $this->employeesScheduledForDeletion[]= $employee;
            $employee->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinBranch(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Branch', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinDesignations(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Designations', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinGradeMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('GradeMaster', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinPositionsRelatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPositionId', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinPositionsRelatedByReportingTo(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByReportingTo', $joinBehavior);

        return $this->getEmployees($query, $con);
    }

    /**
     * Clears out the collGeoDistancesRelatedByFromTownId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGeoDistancesRelatedByFromTownId()
     */
    public function clearGeoDistancesRelatedByFromTownId()
    {
        $this->collGeoDistancesRelatedByFromTownId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGeoDistancesRelatedByFromTownId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGeoDistancesRelatedByFromTownId($v = true): void
    {
        $this->collGeoDistancesRelatedByFromTownIdPartial = $v;
    }

    /**
     * Initializes the collGeoDistancesRelatedByFromTownId collection.
     *
     * By default this just sets the collGeoDistancesRelatedByFromTownId collection to an empty array (like clearcollGeoDistancesRelatedByFromTownId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeoDistancesRelatedByFromTownId(bool $overrideExisting = true): void
    {
        if (null !== $this->collGeoDistancesRelatedByFromTownId && !$overrideExisting) {
            return;
        }

        $collectionClassName = GeoDistanceTableMap::getTableMap()->getCollectionClassName();

        $this->collGeoDistancesRelatedByFromTownId = new $collectionClassName;
        $this->collGeoDistancesRelatedByFromTownId->setModel('\entities\GeoDistance');
    }

    /**
     * Gets an array of ChildGeoDistance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance> List of ChildGeoDistance objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoDistancesRelatedByFromTownId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGeoDistancesRelatedByFromTownIdPartial && !$this->isNew();
        if (null === $this->collGeoDistancesRelatedByFromTownId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGeoDistancesRelatedByFromTownId) {
                    $this->initGeoDistancesRelatedByFromTownId();
                } else {
                    $collectionClassName = GeoDistanceTableMap::getTableMap()->getCollectionClassName();

                    $collGeoDistancesRelatedByFromTownId = new $collectionClassName;
                    $collGeoDistancesRelatedByFromTownId->setModel('\entities\GeoDistance');

                    return $collGeoDistancesRelatedByFromTownId;
                }
            } else {
                $collGeoDistancesRelatedByFromTownId = ChildGeoDistanceQuery::create(null, $criteria)
                    ->filterByGeoTownsRelatedByFromTownId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeoDistancesRelatedByFromTownIdPartial && count($collGeoDistancesRelatedByFromTownId)) {
                        $this->initGeoDistancesRelatedByFromTownId(false);

                        foreach ($collGeoDistancesRelatedByFromTownId as $obj) {
                            if (false == $this->collGeoDistancesRelatedByFromTownId->contains($obj)) {
                                $this->collGeoDistancesRelatedByFromTownId->append($obj);
                            }
                        }

                        $this->collGeoDistancesRelatedByFromTownIdPartial = true;
                    }

                    return $collGeoDistancesRelatedByFromTownId;
                }

                if ($partial && $this->collGeoDistancesRelatedByFromTownId) {
                    foreach ($this->collGeoDistancesRelatedByFromTownId as $obj) {
                        if ($obj->isNew()) {
                            $collGeoDistancesRelatedByFromTownId[] = $obj;
                        }
                    }
                }

                $this->collGeoDistancesRelatedByFromTownId = $collGeoDistancesRelatedByFromTownId;
                $this->collGeoDistancesRelatedByFromTownIdPartial = false;
            }
        }

        return $this->collGeoDistancesRelatedByFromTownId;
    }

    /**
     * Sets a collection of ChildGeoDistance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $geoDistancesRelatedByFromTownId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGeoDistancesRelatedByFromTownId(Collection $geoDistancesRelatedByFromTownId, ?ConnectionInterface $con = null)
    {
        /** @var ChildGeoDistance[] $geoDistancesRelatedByFromTownIdToDelete */
        $geoDistancesRelatedByFromTownIdToDelete = $this->getGeoDistancesRelatedByFromTownId(new Criteria(), $con)->diff($geoDistancesRelatedByFromTownId);


        $this->geoDistancesRelatedByFromTownIdScheduledForDeletion = $geoDistancesRelatedByFromTownIdToDelete;

        foreach ($geoDistancesRelatedByFromTownIdToDelete as $geoDistanceRelatedByFromTownIdRemoved) {
            $geoDistanceRelatedByFromTownIdRemoved->setGeoTownsRelatedByFromTownId(null);
        }

        $this->collGeoDistancesRelatedByFromTownId = null;
        foreach ($geoDistancesRelatedByFromTownId as $geoDistanceRelatedByFromTownId) {
            $this->addGeoDistanceRelatedByFromTownId($geoDistanceRelatedByFromTownId);
        }

        $this->collGeoDistancesRelatedByFromTownId = $geoDistancesRelatedByFromTownId;
        $this->collGeoDistancesRelatedByFromTownIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GeoDistance objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related GeoDistance objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGeoDistancesRelatedByFromTownId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGeoDistancesRelatedByFromTownIdPartial && !$this->isNew();
        if (null === $this->collGeoDistancesRelatedByFromTownId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeoDistancesRelatedByFromTownId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeoDistancesRelatedByFromTownId());
            }

            $query = ChildGeoDistanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTownsRelatedByFromTownId($this)
                ->count($con);
        }

        return count($this->collGeoDistancesRelatedByFromTownId);
    }

    /**
     * Method called to associate a ChildGeoDistance object to this object
     * through the ChildGeoDistance foreign key attribute.
     *
     * @param ChildGeoDistance $l ChildGeoDistance
     * @return $this The current object (for fluent API support)
     */
    public function addGeoDistanceRelatedByFromTownId(ChildGeoDistance $l)
    {
        if ($this->collGeoDistancesRelatedByFromTownId === null) {
            $this->initGeoDistancesRelatedByFromTownId();
            $this->collGeoDistancesRelatedByFromTownIdPartial = true;
        }

        if (!$this->collGeoDistancesRelatedByFromTownId->contains($l)) {
            $this->doAddGeoDistanceRelatedByFromTownId($l);

            if ($this->geoDistancesRelatedByFromTownIdScheduledForDeletion and $this->geoDistancesRelatedByFromTownIdScheduledForDeletion->contains($l)) {
                $this->geoDistancesRelatedByFromTownIdScheduledForDeletion->remove($this->geoDistancesRelatedByFromTownIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeoDistance $geoDistanceRelatedByFromTownId The ChildGeoDistance object to add.
     */
    protected function doAddGeoDistanceRelatedByFromTownId(ChildGeoDistance $geoDistanceRelatedByFromTownId): void
    {
        $this->collGeoDistancesRelatedByFromTownId[]= $geoDistanceRelatedByFromTownId;
        $geoDistanceRelatedByFromTownId->setGeoTownsRelatedByFromTownId($this);
    }

    /**
     * @param ChildGeoDistance $geoDistanceRelatedByFromTownId The ChildGeoDistance object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGeoDistanceRelatedByFromTownId(ChildGeoDistance $geoDistanceRelatedByFromTownId)
    {
        if ($this->getGeoDistancesRelatedByFromTownId()->contains($geoDistanceRelatedByFromTownId)) {
            $pos = $this->collGeoDistancesRelatedByFromTownId->search($geoDistanceRelatedByFromTownId);
            $this->collGeoDistancesRelatedByFromTownId->remove($pos);
            if (null === $this->geoDistancesRelatedByFromTownIdScheduledForDeletion) {
                $this->geoDistancesRelatedByFromTownIdScheduledForDeletion = clone $this->collGeoDistancesRelatedByFromTownId;
                $this->geoDistancesRelatedByFromTownIdScheduledForDeletion->clear();
            }
            $this->geoDistancesRelatedByFromTownIdScheduledForDeletion[]= clone $geoDistanceRelatedByFromTownId;
            $geoDistanceRelatedByFromTownId->setGeoTownsRelatedByFromTownId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related GeoDistancesRelatedByFromTownId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance}> List of ChildGeoDistance objects
     */
    public function getGeoDistancesRelatedByFromTownIdJoinGeoStateRelatedByFromStateId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoDistanceQuery::create(null, $criteria);
        $query->joinWith('GeoStateRelatedByFromStateId', $joinBehavior);

        return $this->getGeoDistancesRelatedByFromTownId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related GeoDistancesRelatedByFromTownId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance}> List of ChildGeoDistance objects
     */
    public function getGeoDistancesRelatedByFromTownIdJoinGeoStateRelatedByToStateId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoDistanceQuery::create(null, $criteria);
        $query->joinWith('GeoStateRelatedByToStateId', $joinBehavior);

        return $this->getGeoDistancesRelatedByFromTownId($query, $con);
    }

    /**
     * Clears out the collGeoDistancesRelatedByToTownId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGeoDistancesRelatedByToTownId()
     */
    public function clearGeoDistancesRelatedByToTownId()
    {
        $this->collGeoDistancesRelatedByToTownId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGeoDistancesRelatedByToTownId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGeoDistancesRelatedByToTownId($v = true): void
    {
        $this->collGeoDistancesRelatedByToTownIdPartial = $v;
    }

    /**
     * Initializes the collGeoDistancesRelatedByToTownId collection.
     *
     * By default this just sets the collGeoDistancesRelatedByToTownId collection to an empty array (like clearcollGeoDistancesRelatedByToTownId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeoDistancesRelatedByToTownId(bool $overrideExisting = true): void
    {
        if (null !== $this->collGeoDistancesRelatedByToTownId && !$overrideExisting) {
            return;
        }

        $collectionClassName = GeoDistanceTableMap::getTableMap()->getCollectionClassName();

        $this->collGeoDistancesRelatedByToTownId = new $collectionClassName;
        $this->collGeoDistancesRelatedByToTownId->setModel('\entities\GeoDistance');
    }

    /**
     * Gets an array of ChildGeoDistance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance> List of ChildGeoDistance objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoDistancesRelatedByToTownId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGeoDistancesRelatedByToTownIdPartial && !$this->isNew();
        if (null === $this->collGeoDistancesRelatedByToTownId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGeoDistancesRelatedByToTownId) {
                    $this->initGeoDistancesRelatedByToTownId();
                } else {
                    $collectionClassName = GeoDistanceTableMap::getTableMap()->getCollectionClassName();

                    $collGeoDistancesRelatedByToTownId = new $collectionClassName;
                    $collGeoDistancesRelatedByToTownId->setModel('\entities\GeoDistance');

                    return $collGeoDistancesRelatedByToTownId;
                }
            } else {
                $collGeoDistancesRelatedByToTownId = ChildGeoDistanceQuery::create(null, $criteria)
                    ->filterByGeoTownsRelatedByToTownId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeoDistancesRelatedByToTownIdPartial && count($collGeoDistancesRelatedByToTownId)) {
                        $this->initGeoDistancesRelatedByToTownId(false);

                        foreach ($collGeoDistancesRelatedByToTownId as $obj) {
                            if (false == $this->collGeoDistancesRelatedByToTownId->contains($obj)) {
                                $this->collGeoDistancesRelatedByToTownId->append($obj);
                            }
                        }

                        $this->collGeoDistancesRelatedByToTownIdPartial = true;
                    }

                    return $collGeoDistancesRelatedByToTownId;
                }

                if ($partial && $this->collGeoDistancesRelatedByToTownId) {
                    foreach ($this->collGeoDistancesRelatedByToTownId as $obj) {
                        if ($obj->isNew()) {
                            $collGeoDistancesRelatedByToTownId[] = $obj;
                        }
                    }
                }

                $this->collGeoDistancesRelatedByToTownId = $collGeoDistancesRelatedByToTownId;
                $this->collGeoDistancesRelatedByToTownIdPartial = false;
            }
        }

        return $this->collGeoDistancesRelatedByToTownId;
    }

    /**
     * Sets a collection of ChildGeoDistance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $geoDistancesRelatedByToTownId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGeoDistancesRelatedByToTownId(Collection $geoDistancesRelatedByToTownId, ?ConnectionInterface $con = null)
    {
        /** @var ChildGeoDistance[] $geoDistancesRelatedByToTownIdToDelete */
        $geoDistancesRelatedByToTownIdToDelete = $this->getGeoDistancesRelatedByToTownId(new Criteria(), $con)->diff($geoDistancesRelatedByToTownId);


        $this->geoDistancesRelatedByToTownIdScheduledForDeletion = $geoDistancesRelatedByToTownIdToDelete;

        foreach ($geoDistancesRelatedByToTownIdToDelete as $geoDistanceRelatedByToTownIdRemoved) {
            $geoDistanceRelatedByToTownIdRemoved->setGeoTownsRelatedByToTownId(null);
        }

        $this->collGeoDistancesRelatedByToTownId = null;
        foreach ($geoDistancesRelatedByToTownId as $geoDistanceRelatedByToTownId) {
            $this->addGeoDistanceRelatedByToTownId($geoDistanceRelatedByToTownId);
        }

        $this->collGeoDistancesRelatedByToTownId = $geoDistancesRelatedByToTownId;
        $this->collGeoDistancesRelatedByToTownIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GeoDistance objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related GeoDistance objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGeoDistancesRelatedByToTownId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGeoDistancesRelatedByToTownIdPartial && !$this->isNew();
        if (null === $this->collGeoDistancesRelatedByToTownId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeoDistancesRelatedByToTownId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeoDistancesRelatedByToTownId());
            }

            $query = ChildGeoDistanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTownsRelatedByToTownId($this)
                ->count($con);
        }

        return count($this->collGeoDistancesRelatedByToTownId);
    }

    /**
     * Method called to associate a ChildGeoDistance object to this object
     * through the ChildGeoDistance foreign key attribute.
     *
     * @param ChildGeoDistance $l ChildGeoDistance
     * @return $this The current object (for fluent API support)
     */
    public function addGeoDistanceRelatedByToTownId(ChildGeoDistance $l)
    {
        if ($this->collGeoDistancesRelatedByToTownId === null) {
            $this->initGeoDistancesRelatedByToTownId();
            $this->collGeoDistancesRelatedByToTownIdPartial = true;
        }

        if (!$this->collGeoDistancesRelatedByToTownId->contains($l)) {
            $this->doAddGeoDistanceRelatedByToTownId($l);

            if ($this->geoDistancesRelatedByToTownIdScheduledForDeletion and $this->geoDistancesRelatedByToTownIdScheduledForDeletion->contains($l)) {
                $this->geoDistancesRelatedByToTownIdScheduledForDeletion->remove($this->geoDistancesRelatedByToTownIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeoDistance $geoDistanceRelatedByToTownId The ChildGeoDistance object to add.
     */
    protected function doAddGeoDistanceRelatedByToTownId(ChildGeoDistance $geoDistanceRelatedByToTownId): void
    {
        $this->collGeoDistancesRelatedByToTownId[]= $geoDistanceRelatedByToTownId;
        $geoDistanceRelatedByToTownId->setGeoTownsRelatedByToTownId($this);
    }

    /**
     * @param ChildGeoDistance $geoDistanceRelatedByToTownId The ChildGeoDistance object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGeoDistanceRelatedByToTownId(ChildGeoDistance $geoDistanceRelatedByToTownId)
    {
        if ($this->getGeoDistancesRelatedByToTownId()->contains($geoDistanceRelatedByToTownId)) {
            $pos = $this->collGeoDistancesRelatedByToTownId->search($geoDistanceRelatedByToTownId);
            $this->collGeoDistancesRelatedByToTownId->remove($pos);
            if (null === $this->geoDistancesRelatedByToTownIdScheduledForDeletion) {
                $this->geoDistancesRelatedByToTownIdScheduledForDeletion = clone $this->collGeoDistancesRelatedByToTownId;
                $this->geoDistancesRelatedByToTownIdScheduledForDeletion->clear();
            }
            $this->geoDistancesRelatedByToTownIdScheduledForDeletion[]= clone $geoDistanceRelatedByToTownId;
            $geoDistanceRelatedByToTownId->setGeoTownsRelatedByToTownId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related GeoDistancesRelatedByToTownId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance}> List of ChildGeoDistance objects
     */
    public function getGeoDistancesRelatedByToTownIdJoinGeoStateRelatedByFromStateId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoDistanceQuery::create(null, $criteria);
        $query->joinWith('GeoStateRelatedByFromStateId', $joinBehavior);

        return $this->getGeoDistancesRelatedByToTownId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related GeoDistancesRelatedByToTownId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance}> List of ChildGeoDistance objects
     */
    public function getGeoDistancesRelatedByToTownIdJoinGeoStateRelatedByToStateId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoDistanceQuery::create(null, $criteria);
        $query->joinWith('GeoStateRelatedByToStateId', $joinBehavior);

        return $this->getGeoDistancesRelatedByToTownId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestAddresses()
     */
    public function clearOnBoardRequestAddresses()
    {
        $this->collOnBoardRequestAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestAddresses($v = true): void
    {
        $this->collOnBoardRequestAddressesPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestAddresses collection.
     *
     * By default this just sets the collOnBoardRequestAddresses collection to an empty array (like clearcollOnBoardRequestAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestAddresses = new $collectionClassName;
        $this->collOnBoardRequestAddresses->setModel('\entities\OnBoardRequestAddress');
    }

    /**
     * Gets an array of ChildOnBoardRequestAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress> List of ChildOnBoardRequestAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestAddressesPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestAddresses) {
                    $this->initOnBoardRequestAddresses();
                } else {
                    $collectionClassName = OnBoardRequestAddressTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestAddresses = new $collectionClassName;
                    $collOnBoardRequestAddresses->setModel('\entities\OnBoardRequestAddress');

                    return $collOnBoardRequestAddresses;
                }
            } else {
                $collOnBoardRequestAddresses = ChildOnBoardRequestAddressQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestAddressesPartial && count($collOnBoardRequestAddresses)) {
                        $this->initOnBoardRequestAddresses(false);

                        foreach ($collOnBoardRequestAddresses as $obj) {
                            if (false == $this->collOnBoardRequestAddresses->contains($obj)) {
                                $this->collOnBoardRequestAddresses->append($obj);
                            }
                        }

                        $this->collOnBoardRequestAddressesPartial = true;
                    }

                    return $collOnBoardRequestAddresses;
                }

                if ($partial && $this->collOnBoardRequestAddresses) {
                    foreach ($this->collOnBoardRequestAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestAddresses[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestAddresses = $collOnBoardRequestAddresses;
                $this->collOnBoardRequestAddressesPartial = false;
            }
        }

        return $this->collOnBoardRequestAddresses;
    }

    /**
     * Sets a collection of ChildOnBoardRequestAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestAddresses(Collection $onBoardRequestAddresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequestAddress[] $onBoardRequestAddressesToDelete */
        $onBoardRequestAddressesToDelete = $this->getOnBoardRequestAddresses(new Criteria(), $con)->diff($onBoardRequestAddresses);


        $this->onBoardRequestAddressesScheduledForDeletion = $onBoardRequestAddressesToDelete;

        foreach ($onBoardRequestAddressesToDelete as $onBoardRequestAddressRemoved) {
            $onBoardRequestAddressRemoved->setGeoTowns(null);
        }

        $this->collOnBoardRequestAddresses = null;
        foreach ($onBoardRequestAddresses as $onBoardRequestAddress) {
            $this->addOnBoardRequestAddress($onBoardRequestAddress);
        }

        $this->collOnBoardRequestAddresses = $onBoardRequestAddresses;
        $this->collOnBoardRequestAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequestAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequestAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestAddressesPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestAddresses());
            }

            $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestAddresses);
    }

    /**
     * Method called to associate a ChildOnBoardRequestAddress object to this object
     * through the ChildOnBoardRequestAddress foreign key attribute.
     *
     * @param ChildOnBoardRequestAddress $l ChildOnBoardRequestAddress
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestAddress(ChildOnBoardRequestAddress $l)
    {
        if ($this->collOnBoardRequestAddresses === null) {
            $this->initOnBoardRequestAddresses();
            $this->collOnBoardRequestAddressesPartial = true;
        }

        if (!$this->collOnBoardRequestAddresses->contains($l)) {
            $this->doAddOnBoardRequestAddress($l);

            if ($this->onBoardRequestAddressesScheduledForDeletion and $this->onBoardRequestAddressesScheduledForDeletion->contains($l)) {
                $this->onBoardRequestAddressesScheduledForDeletion->remove($this->onBoardRequestAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress The ChildOnBoardRequestAddress object to add.
     */
    protected function doAddOnBoardRequestAddress(ChildOnBoardRequestAddress $onBoardRequestAddress): void
    {
        $this->collOnBoardRequestAddresses[]= $onBoardRequestAddress;
        $onBoardRequestAddress->setGeoTowns($this);
    }

    /**
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress The ChildOnBoardRequestAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestAddress(ChildOnBoardRequestAddress $onBoardRequestAddress)
    {
        if ($this->getOnBoardRequestAddresses()->contains($onBoardRequestAddress)) {
            $pos = $this->collOnBoardRequestAddresses->search($onBoardRequestAddress);
            $this->collOnBoardRequestAddresses->remove($pos);
            if (null === $this->onBoardRequestAddressesScheduledForDeletion) {
                $this->onBoardRequestAddressesScheduledForDeletion = clone $this->collOnBoardRequestAddresses;
                $this->onBoardRequestAddressesScheduledForDeletion->clear();
            }
            $this->onBoardRequestAddressesScheduledForDeletion[]= $onBoardRequestAddress;
            $onBoardRequestAddress->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletAddress', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletTags(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletTags', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoCity(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoCity', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoState', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOnBoardRequest(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OnBoardRequest', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }

    /**
     * Clears out the collOutletAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletAddresses()
     */
    public function clearOutletAddresses()
    {
        $this->collOutletAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletAddresses($v = true): void
    {
        $this->collOutletAddressesPartial = $v;
    }

    /**
     * Initializes the collOutletAddresses collection.
     *
     * By default this just sets the collOutletAddresses collection to an empty array (like clearcollOutletAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletAddresses = new $collectionClassName;
        $this->collOutletAddresses->setModel('\entities\OutletAddress');
    }

    /**
     * Gets an array of ChildOutletAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletAddress[] List of ChildOutletAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletAddress> List of ChildOutletAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletAddressesPartial && !$this->isNew();
        if (null === $this->collOutletAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletAddresses) {
                    $this->initOutletAddresses();
                } else {
                    $collectionClassName = OutletAddressTableMap::getTableMap()->getCollectionClassName();

                    $collOutletAddresses = new $collectionClassName;
                    $collOutletAddresses->setModel('\entities\OutletAddress');

                    return $collOutletAddresses;
                }
            } else {
                $collOutletAddresses = ChildOutletAddressQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletAddressesPartial && count($collOutletAddresses)) {
                        $this->initOutletAddresses(false);

                        foreach ($collOutletAddresses as $obj) {
                            if (false == $this->collOutletAddresses->contains($obj)) {
                                $this->collOutletAddresses->append($obj);
                            }
                        }

                        $this->collOutletAddressesPartial = true;
                    }

                    return $collOutletAddresses;
                }

                if ($partial && $this->collOutletAddresses) {
                    foreach ($this->collOutletAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collOutletAddresses[] = $obj;
                        }
                    }
                }

                $this->collOutletAddresses = $collOutletAddresses;
                $this->collOutletAddressesPartial = false;
            }
        }

        return $this->collOutletAddresses;
    }

    /**
     * Sets a collection of ChildOutletAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletAddresses(Collection $outletAddresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletAddress[] $outletAddressesToDelete */
        $outletAddressesToDelete = $this->getOutletAddresses(new Criteria(), $con)->diff($outletAddresses);


        $this->outletAddressesScheduledForDeletion = $outletAddressesToDelete;

        foreach ($outletAddressesToDelete as $outletAddressRemoved) {
            $outletAddressRemoved->setGeoTowns(null);
        }

        $this->collOutletAddresses = null;
        foreach ($outletAddresses as $outletAddress) {
            $this->addOutletAddress($outletAddress);
        }

        $this->collOutletAddresses = $outletAddresses;
        $this->collOutletAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletAddressesPartial && !$this->isNew();
        if (null === $this->collOutletAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletAddresses());
            }

            $query = ChildOutletAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collOutletAddresses);
    }

    /**
     * Method called to associate a ChildOutletAddress object to this object
     * through the ChildOutletAddress foreign key attribute.
     *
     * @param ChildOutletAddress $l ChildOutletAddress
     * @return $this The current object (for fluent API support)
     */
    public function addOutletAddress(ChildOutletAddress $l)
    {
        if ($this->collOutletAddresses === null) {
            $this->initOutletAddresses();
            $this->collOutletAddressesPartial = true;
        }

        if (!$this->collOutletAddresses->contains($l)) {
            $this->doAddOutletAddress($l);

            if ($this->outletAddressesScheduledForDeletion and $this->outletAddressesScheduledForDeletion->contains($l)) {
                $this->outletAddressesScheduledForDeletion->remove($this->outletAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletAddress $outletAddress The ChildOutletAddress object to add.
     */
    protected function doAddOutletAddress(ChildOutletAddress $outletAddress): void
    {
        $this->collOutletAddresses[]= $outletAddress;
        $outletAddress->setGeoTowns($this);
    }

    /**
     * @param ChildOutletAddress $outletAddress The ChildOutletAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletAddress(ChildOutletAddress $outletAddress)
    {
        if ($this->getOutletAddresses()->contains($outletAddress)) {
            $pos = $this->collOutletAddresses->search($outletAddress);
            $this->collOutletAddresses->remove($pos);
            if (null === $this->outletAddressesScheduledForDeletion) {
                $this->outletAddressesScheduledForDeletion = clone $this->collOutletAddresses;
                $this->outletAddressesScheduledForDeletion->clear();
            }
            $this->outletAddressesScheduledForDeletion[]= $outletAddress;
            $outletAddress->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OutletAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletAddress[] List of ChildOutletAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletAddress}> List of ChildOutletAddress objects
     */
    public function getOutletAddressesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletAddressQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OutletAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletAddress[] List of ChildOutletAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletAddress}> List of ChildOutletAddress objects
     */
    public function getOutletAddressesJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletAddressQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletAddresses($query, $con);
    }

    /**
     * Clears out the collOutletOrgDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletOrgDatas()
     */
    public function clearOutletOrgDatas()
    {
        $this->collOutletOrgDatas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletOrgDatas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletOrgDatas($v = true): void
    {
        $this->collOutletOrgDatasPartial = $v;
    }

    /**
     * Initializes the collOutletOrgDatas collection.
     *
     * By default this just sets the collOutletOrgDatas collection to an empty array (like clearcollOutletOrgDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletOrgDatas(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletOrgDatas && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletOrgDataTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletOrgDatas = new $collectionClassName;
        $this->collOutletOrgDatas->setModel('\entities\OutletOrgData');
    }

    /**
     * Gets an array of ChildOutletOrgData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletOrgData[] List of ChildOutletOrgData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgData> List of ChildOutletOrgData objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletOrgDatas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletOrgDatasPartial && !$this->isNew();
        if (null === $this->collOutletOrgDatas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletOrgDatas) {
                    $this->initOutletOrgDatas();
                } else {
                    $collectionClassName = OutletOrgDataTableMap::getTableMap()->getCollectionClassName();

                    $collOutletOrgDatas = new $collectionClassName;
                    $collOutletOrgDatas->setModel('\entities\OutletOrgData');

                    return $collOutletOrgDatas;
                }
            } else {
                $collOutletOrgDatas = ChildOutletOrgDataQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletOrgDatasPartial && count($collOutletOrgDatas)) {
                        $this->initOutletOrgDatas(false);

                        foreach ($collOutletOrgDatas as $obj) {
                            if (false == $this->collOutletOrgDatas->contains($obj)) {
                                $this->collOutletOrgDatas->append($obj);
                            }
                        }

                        $this->collOutletOrgDatasPartial = true;
                    }

                    return $collOutletOrgDatas;
                }

                if ($partial && $this->collOutletOrgDatas) {
                    foreach ($this->collOutletOrgDatas as $obj) {
                        if ($obj->isNew()) {
                            $collOutletOrgDatas[] = $obj;
                        }
                    }
                }

                $this->collOutletOrgDatas = $collOutletOrgDatas;
                $this->collOutletOrgDatasPartial = false;
            }
        }

        return $this->collOutletOrgDatas;
    }

    /**
     * Sets a collection of ChildOutletOrgData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletOrgDatas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgDatas(Collection $outletOrgDatas, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletOrgData[] $outletOrgDatasToDelete */
        $outletOrgDatasToDelete = $this->getOutletOrgDatas(new Criteria(), $con)->diff($outletOrgDatas);


        $this->outletOrgDatasScheduledForDeletion = $outletOrgDatasToDelete;

        foreach ($outletOrgDatasToDelete as $outletOrgDataRemoved) {
            $outletOrgDataRemoved->setGeoTowns(null);
        }

        $this->collOutletOrgDatas = null;
        foreach ($outletOrgDatas as $outletOrgData) {
            $this->addOutletOrgData($outletOrgData);
        }

        $this->collOutletOrgDatas = $outletOrgDatas;
        $this->collOutletOrgDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletOrgData objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletOrgData objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletOrgDatas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletOrgDatasPartial && !$this->isNew();
        if (null === $this->collOutletOrgDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletOrgDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletOrgDatas());
            }

            $query = ChildOutletOrgDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collOutletOrgDatas);
    }

    /**
     * Method called to associate a ChildOutletOrgData object to this object
     * through the ChildOutletOrgData foreign key attribute.
     *
     * @param ChildOutletOrgData $l ChildOutletOrgData
     * @return $this The current object (for fluent API support)
     */
    public function addOutletOrgData(ChildOutletOrgData $l)
    {
        if ($this->collOutletOrgDatas === null) {
            $this->initOutletOrgDatas();
            $this->collOutletOrgDatasPartial = true;
        }

        if (!$this->collOutletOrgDatas->contains($l)) {
            $this->doAddOutletOrgData($l);

            if ($this->outletOrgDatasScheduledForDeletion and $this->outletOrgDatasScheduledForDeletion->contains($l)) {
                $this->outletOrgDatasScheduledForDeletion->remove($this->outletOrgDatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletOrgData $outletOrgData The ChildOutletOrgData object to add.
     */
    protected function doAddOutletOrgData(ChildOutletOrgData $outletOrgData): void
    {
        $this->collOutletOrgDatas[]= $outletOrgData;
        $outletOrgData->setGeoTowns($this);
    }

    /**
     * @param ChildOutletOrgData $outletOrgData The ChildOutletOrgData object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletOrgData(ChildOutletOrgData $outletOrgData)
    {
        if ($this->getOutletOrgDatas()->contains($outletOrgData)) {
            $pos = $this->collOutletOrgDatas->search($outletOrgData);
            $this->collOutletOrgDatas->remove($pos);
            if (null === $this->outletOrgDatasScheduledForDeletion) {
                $this->outletOrgDatasScheduledForDeletion = clone $this->collOutletOrgDatas;
                $this->outletOrgDatasScheduledForDeletion->clear();
            }
            $this->outletOrgDatasScheduledForDeletion[]= $outletOrgData;
            $outletOrgData->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgData[] List of ChildOutletOrgData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgData}> List of ChildOutletOrgData objects
     */
    public function getOutletOrgDatasJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgDataQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletOrgDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgData[] List of ChildOutletOrgData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgData}> List of ChildOutletOrgData objects
     */
    public function getOutletOrgDatasJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgDataQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletOrgDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgData[] List of ChildOutletOrgData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgData}> List of ChildOutletOrgData objects
     */
    public function getOutletOrgDatasJoinOutletAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgDataQuery::create(null, $criteria);
        $query->joinWith('OutletAddress', $joinBehavior);

        return $this->getOutletOrgDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgData[] List of ChildOutletOrgData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgData}> List of ChildOutletOrgData objects
     */
    public function getOutletOrgDatasJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgDataQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOutletOrgDatas($query, $con);
    }

    /**
     * Clears out the collOutletss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletss()
     */
    public function clearOutletss()
    {
        $this->collOutletss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletss($v = true): void
    {
        $this->collOutletssPartial = $v;
    }

    /**
     * Initializes the collOutletss collection.
     *
     * By default this just sets the collOutletss collection to an empty array (like clearcollOutletss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletsTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletss = new $collectionClassName;
        $this->collOutletss->setModel('\entities\Outlets');
    }

    /**
     * Gets an array of ChildOutlets objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets> List of ChildOutlets objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletssPartial && !$this->isNew();
        if (null === $this->collOutletss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletss) {
                    $this->initOutletss();
                } else {
                    $collectionClassName = OutletsTableMap::getTableMap()->getCollectionClassName();

                    $collOutletss = new $collectionClassName;
                    $collOutletss->setModel('\entities\Outlets');

                    return $collOutletss;
                }
            } else {
                $collOutletss = ChildOutletsQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletssPartial && count($collOutletss)) {
                        $this->initOutletss(false);

                        foreach ($collOutletss as $obj) {
                            if (false == $this->collOutletss->contains($obj)) {
                                $this->collOutletss->append($obj);
                            }
                        }

                        $this->collOutletssPartial = true;
                    }

                    return $collOutletss;
                }

                if ($partial && $this->collOutletss) {
                    foreach ($this->collOutletss as $obj) {
                        if ($obj->isNew()) {
                            $collOutletss[] = $obj;
                        }
                    }
                }

                $this->collOutletss = $collOutletss;
                $this->collOutletssPartial = false;
            }
        }

        return $this->collOutletss;
    }

    /**
     * Sets a collection of ChildOutlets objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletss(Collection $outletss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutlets[] $outletssToDelete */
        $outletssToDelete = $this->getOutletss(new Criteria(), $con)->diff($outletss);


        $this->outletssScheduledForDeletion = $outletssToDelete;

        foreach ($outletssToDelete as $outletsRemoved) {
            $outletsRemoved->setGeoTowns(null);
        }

        $this->collOutletss = null;
        foreach ($outletss as $outlets) {
            $this->addOutlets($outlets);
        }

        $this->collOutletss = $outletss;
        $this->collOutletssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Outlets objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Outlets objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletssPartial && !$this->isNew();
        if (null === $this->collOutletss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletss());
            }

            $query = ChildOutletsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collOutletss);
    }

    /**
     * Method called to associate a ChildOutlets object to this object
     * through the ChildOutlets foreign key attribute.
     *
     * @param ChildOutlets $l ChildOutlets
     * @return $this The current object (for fluent API support)
     */
    public function addOutlets(ChildOutlets $l)
    {
        if ($this->collOutletss === null) {
            $this->initOutletss();
            $this->collOutletssPartial = true;
        }

        if (!$this->collOutletss->contains($l)) {
            $this->doAddOutlets($l);

            if ($this->outletssScheduledForDeletion and $this->outletssScheduledForDeletion->contains($l)) {
                $this->outletssScheduledForDeletion->remove($this->outletssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutlets $outlets The ChildOutlets object to add.
     */
    protected function doAddOutlets(ChildOutlets $outlets): void
    {
        $this->collOutletss[]= $outlets;
        $outlets->setGeoTowns($this);
    }

    /**
     * @param ChildOutlets $outlets The ChildOutlets object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutlets(ChildOutlets $outlets)
    {
        if ($this->getOutletss()->contains($outlets)) {
            $pos = $this->collOutletss->search($outlets);
            $this->collOutletss->remove($pos);
            if (null === $this->outletssScheduledForDeletion) {
                $this->outletssScheduledForDeletion = clone $this->collOutletss;
                $this->outletssScheduledForDeletion->clear();
            }
            $this->outletssScheduledForDeletion[]= $outlets;
            $outlets->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOutletss($query, $con);
    }

    /**
     * Clears out the collPositionss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPositionss()
     */
    public function clearPositionss()
    {
        $this->collPositionss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPositionss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPositionss($v = true): void
    {
        $this->collPositionssPartial = $v;
    }

    /**
     * Initializes the collPositionss collection.
     *
     * By default this just sets the collPositionss collection to an empty array (like clearcollPositionss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPositionss(bool $overrideExisting = true): void
    {
        if (null !== $this->collPositionss && !$overrideExisting) {
            return;
        }

        $collectionClassName = PositionsTableMap::getTableMap()->getCollectionClassName();

        $this->collPositionss = new $collectionClassName;
        $this->collPositionss->setModel('\entities\Positions');
    }

    /**
     * Gets an array of ChildPositions objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPositions[] List of ChildPositions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPositions> List of ChildPositions objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPositionss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPositionssPartial && !$this->isNew();
        if (null === $this->collPositionss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPositionss) {
                    $this->initPositionss();
                } else {
                    $collectionClassName = PositionsTableMap::getTableMap()->getCollectionClassName();

                    $collPositionss = new $collectionClassName;
                    $collPositionss->setModel('\entities\Positions');

                    return $collPositionss;
                }
            } else {
                $collPositionss = ChildPositionsQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPositionssPartial && count($collPositionss)) {
                        $this->initPositionss(false);

                        foreach ($collPositionss as $obj) {
                            if (false == $this->collPositionss->contains($obj)) {
                                $this->collPositionss->append($obj);
                            }
                        }

                        $this->collPositionssPartial = true;
                    }

                    return $collPositionss;
                }

                if ($partial && $this->collPositionss) {
                    foreach ($this->collPositionss as $obj) {
                        if ($obj->isNew()) {
                            $collPositionss[] = $obj;
                        }
                    }
                }

                $this->collPositionss = $collPositionss;
                $this->collPositionssPartial = false;
            }
        }

        return $this->collPositionss;
    }

    /**
     * Sets a collection of ChildPositions objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $positionss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPositionss(Collection $positionss, ?ConnectionInterface $con = null)
    {
        /** @var ChildPositions[] $positionssToDelete */
        $positionssToDelete = $this->getPositionss(new Criteria(), $con)->diff($positionss);


        $this->positionssScheduledForDeletion = $positionssToDelete;

        foreach ($positionssToDelete as $positionsRemoved) {
            $positionsRemoved->setGeoTowns(null);
        }

        $this->collPositionss = null;
        foreach ($positionss as $positions) {
            $this->addPositions($positions);
        }

        $this->collPositionss = $positionss;
        $this->collPositionssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Positions objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Positions objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPositionss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPositionssPartial && !$this->isNew();
        if (null === $this->collPositionss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPositionss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPositionss());
            }

            $query = ChildPositionsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collPositionss);
    }

    /**
     * Method called to associate a ChildPositions object to this object
     * through the ChildPositions foreign key attribute.
     *
     * @param ChildPositions $l ChildPositions
     * @return $this The current object (for fluent API support)
     */
    public function addPositions(ChildPositions $l)
    {
        if ($this->collPositionss === null) {
            $this->initPositionss();
            $this->collPositionssPartial = true;
        }

        if (!$this->collPositionss->contains($l)) {
            $this->doAddPositions($l);

            if ($this->positionssScheduledForDeletion and $this->positionssScheduledForDeletion->contains($l)) {
                $this->positionssScheduledForDeletion->remove($this->positionssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPositions $positions The ChildPositions object to add.
     */
    protected function doAddPositions(ChildPositions $positions): void
    {
        $this->collPositionss[]= $positions;
        $positions->setGeoTowns($this);
    }

    /**
     * @param ChildPositions $positions The ChildPositions object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePositions(ChildPositions $positions)
    {
        if ($this->getPositionss()->contains($positions)) {
            $pos = $this->collPositionss->search($positions);
            $this->collPositionss->remove($pos);
            if (null === $this->positionssScheduledForDeletion) {
                $this->positionssScheduledForDeletion = clone $this->collPositionss;
                $this->positionssScheduledForDeletion->clear();
            }
            $this->positionssScheduledForDeletion[]= $positions;
            $positions->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Positionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPositions[] List of ChildPositions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPositions}> List of ChildPositions objects
     */
    public function getPositionssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPositionsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getPositionss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Positionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPositions[] List of ChildPositions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPositions}> List of ChildPositions objects
     */
    public function getPositionssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPositionsQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getPositionss($query, $con);
    }

    /**
     * Clears out the collSfcMastersRelatedByFromTownId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSfcMastersRelatedByFromTownId()
     */
    public function clearSfcMastersRelatedByFromTownId()
    {
        $this->collSfcMastersRelatedByFromTownId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSfcMastersRelatedByFromTownId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSfcMastersRelatedByFromTownId($v = true): void
    {
        $this->collSfcMastersRelatedByFromTownIdPartial = $v;
    }

    /**
     * Initializes the collSfcMastersRelatedByFromTownId collection.
     *
     * By default this just sets the collSfcMastersRelatedByFromTownId collection to an empty array (like clearcollSfcMastersRelatedByFromTownId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSfcMastersRelatedByFromTownId(bool $overrideExisting = true): void
    {
        if (null !== $this->collSfcMastersRelatedByFromTownId && !$overrideExisting) {
            return;
        }

        $collectionClassName = SfcMasterTableMap::getTableMap()->getCollectionClassName();

        $this->collSfcMastersRelatedByFromTownId = new $collectionClassName;
        $this->collSfcMastersRelatedByFromTownId->setModel('\entities\SfcMaster');
    }

    /**
     * Gets an array of ChildSfcMaster objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSfcMaster[] List of ChildSfcMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSfcMaster> List of ChildSfcMaster objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSfcMastersRelatedByFromTownId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSfcMastersRelatedByFromTownIdPartial && !$this->isNew();
        if (null === $this->collSfcMastersRelatedByFromTownId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSfcMastersRelatedByFromTownId) {
                    $this->initSfcMastersRelatedByFromTownId();
                } else {
                    $collectionClassName = SfcMasterTableMap::getTableMap()->getCollectionClassName();

                    $collSfcMastersRelatedByFromTownId = new $collectionClassName;
                    $collSfcMastersRelatedByFromTownId->setModel('\entities\SfcMaster');

                    return $collSfcMastersRelatedByFromTownId;
                }
            } else {
                $collSfcMastersRelatedByFromTownId = ChildSfcMasterQuery::create(null, $criteria)
                    ->filterByGeoTownsRelatedByFromTownId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSfcMastersRelatedByFromTownIdPartial && count($collSfcMastersRelatedByFromTownId)) {
                        $this->initSfcMastersRelatedByFromTownId(false);

                        foreach ($collSfcMastersRelatedByFromTownId as $obj) {
                            if (false == $this->collSfcMastersRelatedByFromTownId->contains($obj)) {
                                $this->collSfcMastersRelatedByFromTownId->append($obj);
                            }
                        }

                        $this->collSfcMastersRelatedByFromTownIdPartial = true;
                    }

                    return $collSfcMastersRelatedByFromTownId;
                }

                if ($partial && $this->collSfcMastersRelatedByFromTownId) {
                    foreach ($this->collSfcMastersRelatedByFromTownId as $obj) {
                        if ($obj->isNew()) {
                            $collSfcMastersRelatedByFromTownId[] = $obj;
                        }
                    }
                }

                $this->collSfcMastersRelatedByFromTownId = $collSfcMastersRelatedByFromTownId;
                $this->collSfcMastersRelatedByFromTownIdPartial = false;
            }
        }

        return $this->collSfcMastersRelatedByFromTownId;
    }

    /**
     * Sets a collection of ChildSfcMaster objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $sfcMastersRelatedByFromTownId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSfcMastersRelatedByFromTownId(Collection $sfcMastersRelatedByFromTownId, ?ConnectionInterface $con = null)
    {
        /** @var ChildSfcMaster[] $sfcMastersRelatedByFromTownIdToDelete */
        $sfcMastersRelatedByFromTownIdToDelete = $this->getSfcMastersRelatedByFromTownId(new Criteria(), $con)->diff($sfcMastersRelatedByFromTownId);


        $this->sfcMastersRelatedByFromTownIdScheduledForDeletion = $sfcMastersRelatedByFromTownIdToDelete;

        foreach ($sfcMastersRelatedByFromTownIdToDelete as $sfcMasterRelatedByFromTownIdRemoved) {
            $sfcMasterRelatedByFromTownIdRemoved->setGeoTownsRelatedByFromTownId(null);
        }

        $this->collSfcMastersRelatedByFromTownId = null;
        foreach ($sfcMastersRelatedByFromTownId as $sfcMasterRelatedByFromTownId) {
            $this->addSfcMasterRelatedByFromTownId($sfcMasterRelatedByFromTownId);
        }

        $this->collSfcMastersRelatedByFromTownId = $sfcMastersRelatedByFromTownId;
        $this->collSfcMastersRelatedByFromTownIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SfcMaster objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SfcMaster objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSfcMastersRelatedByFromTownId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSfcMastersRelatedByFromTownIdPartial && !$this->isNew();
        if (null === $this->collSfcMastersRelatedByFromTownId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSfcMastersRelatedByFromTownId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSfcMastersRelatedByFromTownId());
            }

            $query = ChildSfcMasterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTownsRelatedByFromTownId($this)
                ->count($con);
        }

        return count($this->collSfcMastersRelatedByFromTownId);
    }

    /**
     * Method called to associate a ChildSfcMaster object to this object
     * through the ChildSfcMaster foreign key attribute.
     *
     * @param ChildSfcMaster $l ChildSfcMaster
     * @return $this The current object (for fluent API support)
     */
    public function addSfcMasterRelatedByFromTownId(ChildSfcMaster $l)
    {
        if ($this->collSfcMastersRelatedByFromTownId === null) {
            $this->initSfcMastersRelatedByFromTownId();
            $this->collSfcMastersRelatedByFromTownIdPartial = true;
        }

        if (!$this->collSfcMastersRelatedByFromTownId->contains($l)) {
            $this->doAddSfcMasterRelatedByFromTownId($l);

            if ($this->sfcMastersRelatedByFromTownIdScheduledForDeletion and $this->sfcMastersRelatedByFromTownIdScheduledForDeletion->contains($l)) {
                $this->sfcMastersRelatedByFromTownIdScheduledForDeletion->remove($this->sfcMastersRelatedByFromTownIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSfcMaster $sfcMasterRelatedByFromTownId The ChildSfcMaster object to add.
     */
    protected function doAddSfcMasterRelatedByFromTownId(ChildSfcMaster $sfcMasterRelatedByFromTownId): void
    {
        $this->collSfcMastersRelatedByFromTownId[]= $sfcMasterRelatedByFromTownId;
        $sfcMasterRelatedByFromTownId->setGeoTownsRelatedByFromTownId($this);
    }

    /**
     * @param ChildSfcMaster $sfcMasterRelatedByFromTownId The ChildSfcMaster object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSfcMasterRelatedByFromTownId(ChildSfcMaster $sfcMasterRelatedByFromTownId)
    {
        if ($this->getSfcMastersRelatedByFromTownId()->contains($sfcMasterRelatedByFromTownId)) {
            $pos = $this->collSfcMastersRelatedByFromTownId->search($sfcMasterRelatedByFromTownId);
            $this->collSfcMastersRelatedByFromTownId->remove($pos);
            if (null === $this->sfcMastersRelatedByFromTownIdScheduledForDeletion) {
                $this->sfcMastersRelatedByFromTownIdScheduledForDeletion = clone $this->collSfcMastersRelatedByFromTownId;
                $this->sfcMastersRelatedByFromTownIdScheduledForDeletion->clear();
            }
            $this->sfcMastersRelatedByFromTownIdScheduledForDeletion[]= $sfcMasterRelatedByFromTownId;
            $sfcMasterRelatedByFromTownId->setGeoTownsRelatedByFromTownId(null);
        }

        return $this;
    }

    /**
     * Clears out the collSfcMastersRelatedByToTownId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSfcMastersRelatedByToTownId()
     */
    public function clearSfcMastersRelatedByToTownId()
    {
        $this->collSfcMastersRelatedByToTownId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSfcMastersRelatedByToTownId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSfcMastersRelatedByToTownId($v = true): void
    {
        $this->collSfcMastersRelatedByToTownIdPartial = $v;
    }

    /**
     * Initializes the collSfcMastersRelatedByToTownId collection.
     *
     * By default this just sets the collSfcMastersRelatedByToTownId collection to an empty array (like clearcollSfcMastersRelatedByToTownId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSfcMastersRelatedByToTownId(bool $overrideExisting = true): void
    {
        if (null !== $this->collSfcMastersRelatedByToTownId && !$overrideExisting) {
            return;
        }

        $collectionClassName = SfcMasterTableMap::getTableMap()->getCollectionClassName();

        $this->collSfcMastersRelatedByToTownId = new $collectionClassName;
        $this->collSfcMastersRelatedByToTownId->setModel('\entities\SfcMaster');
    }

    /**
     * Gets an array of ChildSfcMaster objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSfcMaster[] List of ChildSfcMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSfcMaster> List of ChildSfcMaster objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSfcMastersRelatedByToTownId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSfcMastersRelatedByToTownIdPartial && !$this->isNew();
        if (null === $this->collSfcMastersRelatedByToTownId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSfcMastersRelatedByToTownId) {
                    $this->initSfcMastersRelatedByToTownId();
                } else {
                    $collectionClassName = SfcMasterTableMap::getTableMap()->getCollectionClassName();

                    $collSfcMastersRelatedByToTownId = new $collectionClassName;
                    $collSfcMastersRelatedByToTownId->setModel('\entities\SfcMaster');

                    return $collSfcMastersRelatedByToTownId;
                }
            } else {
                $collSfcMastersRelatedByToTownId = ChildSfcMasterQuery::create(null, $criteria)
                    ->filterByGeoTownsRelatedByToTownId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSfcMastersRelatedByToTownIdPartial && count($collSfcMastersRelatedByToTownId)) {
                        $this->initSfcMastersRelatedByToTownId(false);

                        foreach ($collSfcMastersRelatedByToTownId as $obj) {
                            if (false == $this->collSfcMastersRelatedByToTownId->contains($obj)) {
                                $this->collSfcMastersRelatedByToTownId->append($obj);
                            }
                        }

                        $this->collSfcMastersRelatedByToTownIdPartial = true;
                    }

                    return $collSfcMastersRelatedByToTownId;
                }

                if ($partial && $this->collSfcMastersRelatedByToTownId) {
                    foreach ($this->collSfcMastersRelatedByToTownId as $obj) {
                        if ($obj->isNew()) {
                            $collSfcMastersRelatedByToTownId[] = $obj;
                        }
                    }
                }

                $this->collSfcMastersRelatedByToTownId = $collSfcMastersRelatedByToTownId;
                $this->collSfcMastersRelatedByToTownIdPartial = false;
            }
        }

        return $this->collSfcMastersRelatedByToTownId;
    }

    /**
     * Sets a collection of ChildSfcMaster objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $sfcMastersRelatedByToTownId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSfcMastersRelatedByToTownId(Collection $sfcMastersRelatedByToTownId, ?ConnectionInterface $con = null)
    {
        /** @var ChildSfcMaster[] $sfcMastersRelatedByToTownIdToDelete */
        $sfcMastersRelatedByToTownIdToDelete = $this->getSfcMastersRelatedByToTownId(new Criteria(), $con)->diff($sfcMastersRelatedByToTownId);


        $this->sfcMastersRelatedByToTownIdScheduledForDeletion = $sfcMastersRelatedByToTownIdToDelete;

        foreach ($sfcMastersRelatedByToTownIdToDelete as $sfcMasterRelatedByToTownIdRemoved) {
            $sfcMasterRelatedByToTownIdRemoved->setGeoTownsRelatedByToTownId(null);
        }

        $this->collSfcMastersRelatedByToTownId = null;
        foreach ($sfcMastersRelatedByToTownId as $sfcMasterRelatedByToTownId) {
            $this->addSfcMasterRelatedByToTownId($sfcMasterRelatedByToTownId);
        }

        $this->collSfcMastersRelatedByToTownId = $sfcMastersRelatedByToTownId;
        $this->collSfcMastersRelatedByToTownIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SfcMaster objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SfcMaster objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSfcMastersRelatedByToTownId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSfcMastersRelatedByToTownIdPartial && !$this->isNew();
        if (null === $this->collSfcMastersRelatedByToTownId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSfcMastersRelatedByToTownId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSfcMastersRelatedByToTownId());
            }

            $query = ChildSfcMasterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTownsRelatedByToTownId($this)
                ->count($con);
        }

        return count($this->collSfcMastersRelatedByToTownId);
    }

    /**
     * Method called to associate a ChildSfcMaster object to this object
     * through the ChildSfcMaster foreign key attribute.
     *
     * @param ChildSfcMaster $l ChildSfcMaster
     * @return $this The current object (for fluent API support)
     */
    public function addSfcMasterRelatedByToTownId(ChildSfcMaster $l)
    {
        if ($this->collSfcMastersRelatedByToTownId === null) {
            $this->initSfcMastersRelatedByToTownId();
            $this->collSfcMastersRelatedByToTownIdPartial = true;
        }

        if (!$this->collSfcMastersRelatedByToTownId->contains($l)) {
            $this->doAddSfcMasterRelatedByToTownId($l);

            if ($this->sfcMastersRelatedByToTownIdScheduledForDeletion and $this->sfcMastersRelatedByToTownIdScheduledForDeletion->contains($l)) {
                $this->sfcMastersRelatedByToTownIdScheduledForDeletion->remove($this->sfcMastersRelatedByToTownIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSfcMaster $sfcMasterRelatedByToTownId The ChildSfcMaster object to add.
     */
    protected function doAddSfcMasterRelatedByToTownId(ChildSfcMaster $sfcMasterRelatedByToTownId): void
    {
        $this->collSfcMastersRelatedByToTownId[]= $sfcMasterRelatedByToTownId;
        $sfcMasterRelatedByToTownId->setGeoTownsRelatedByToTownId($this);
    }

    /**
     * @param ChildSfcMaster $sfcMasterRelatedByToTownId The ChildSfcMaster object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSfcMasterRelatedByToTownId(ChildSfcMaster $sfcMasterRelatedByToTownId)
    {
        if ($this->getSfcMastersRelatedByToTownId()->contains($sfcMasterRelatedByToTownId)) {
            $pos = $this->collSfcMastersRelatedByToTownId->search($sfcMasterRelatedByToTownId);
            $this->collSfcMastersRelatedByToTownId->remove($pos);
            if (null === $this->sfcMastersRelatedByToTownIdScheduledForDeletion) {
                $this->sfcMastersRelatedByToTownIdScheduledForDeletion = clone $this->collSfcMastersRelatedByToTownId;
                $this->sfcMastersRelatedByToTownIdScheduledForDeletion->clear();
            }
            $this->sfcMastersRelatedByToTownIdScheduledForDeletion[]= $sfcMasterRelatedByToTownId;
            $sfcMasterRelatedByToTownId->setGeoTownsRelatedByToTownId(null);
        }

        return $this;
    }

    /**
     * Clears out the collTerritoryTownss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTerritoryTownss()
     */
    public function clearTerritoryTownss()
    {
        $this->collTerritoryTownss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTerritoryTownss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTerritoryTownss($v = true): void
    {
        $this->collTerritoryTownssPartial = $v;
    }

    /**
     * Initializes the collTerritoryTownss collection.
     *
     * By default this just sets the collTerritoryTownss collection to an empty array (like clearcollTerritoryTownss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTerritoryTownss(bool $overrideExisting = true): void
    {
        if (null !== $this->collTerritoryTownss && !$overrideExisting) {
            return;
        }

        $collectionClassName = TerritoryTownsTableMap::getTableMap()->getCollectionClassName();

        $this->collTerritoryTownss = new $collectionClassName;
        $this->collTerritoryTownss->setModel('\entities\TerritoryTowns');
    }

    /**
     * Gets an array of ChildTerritoryTowns objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoTowns is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTerritoryTowns[] List of ChildTerritoryTowns objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritoryTowns> List of ChildTerritoryTowns objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTerritoryTownss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTerritoryTownssPartial && !$this->isNew();
        if (null === $this->collTerritoryTownss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTerritoryTownss) {
                    $this->initTerritoryTownss();
                } else {
                    $collectionClassName = TerritoryTownsTableMap::getTableMap()->getCollectionClassName();

                    $collTerritoryTownss = new $collectionClassName;
                    $collTerritoryTownss->setModel('\entities\TerritoryTowns');

                    return $collTerritoryTownss;
                }
            } else {
                $collTerritoryTownss = ChildTerritoryTownsQuery::create(null, $criteria)
                    ->filterByGeoTowns($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTerritoryTownssPartial && count($collTerritoryTownss)) {
                        $this->initTerritoryTownss(false);

                        foreach ($collTerritoryTownss as $obj) {
                            if (false == $this->collTerritoryTownss->contains($obj)) {
                                $this->collTerritoryTownss->append($obj);
                            }
                        }

                        $this->collTerritoryTownssPartial = true;
                    }

                    return $collTerritoryTownss;
                }

                if ($partial && $this->collTerritoryTownss) {
                    foreach ($this->collTerritoryTownss as $obj) {
                        if ($obj->isNew()) {
                            $collTerritoryTownss[] = $obj;
                        }
                    }
                }

                $this->collTerritoryTownss = $collTerritoryTownss;
                $this->collTerritoryTownssPartial = false;
            }
        }

        return $this->collTerritoryTownss;
    }

    /**
     * Sets a collection of ChildTerritoryTowns objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $territoryTownss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoryTownss(Collection $territoryTownss, ?ConnectionInterface $con = null)
    {
        /** @var ChildTerritoryTowns[] $territoryTownssToDelete */
        $territoryTownssToDelete = $this->getTerritoryTownss(new Criteria(), $con)->diff($territoryTownss);


        $this->territoryTownssScheduledForDeletion = $territoryTownssToDelete;

        foreach ($territoryTownssToDelete as $territoryTownsRemoved) {
            $territoryTownsRemoved->setGeoTowns(null);
        }

        $this->collTerritoryTownss = null;
        foreach ($territoryTownss as $territoryTowns) {
            $this->addTerritoryTowns($territoryTowns);
        }

        $this->collTerritoryTownss = $territoryTownss;
        $this->collTerritoryTownssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TerritoryTowns objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related TerritoryTowns objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTerritoryTownss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTerritoryTownssPartial && !$this->isNew();
        if (null === $this->collTerritoryTownss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTerritoryTownss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTerritoryTownss());
            }

            $query = ChildTerritoryTownsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoTowns($this)
                ->count($con);
        }

        return count($this->collTerritoryTownss);
    }

    /**
     * Method called to associate a ChildTerritoryTowns object to this object
     * through the ChildTerritoryTowns foreign key attribute.
     *
     * @param ChildTerritoryTowns $l ChildTerritoryTowns
     * @return $this The current object (for fluent API support)
     */
    public function addTerritoryTowns(ChildTerritoryTowns $l)
    {
        if ($this->collTerritoryTownss === null) {
            $this->initTerritoryTownss();
            $this->collTerritoryTownssPartial = true;
        }

        if (!$this->collTerritoryTownss->contains($l)) {
            $this->doAddTerritoryTowns($l);

            if ($this->territoryTownssScheduledForDeletion and $this->territoryTownssScheduledForDeletion->contains($l)) {
                $this->territoryTownssScheduledForDeletion->remove($this->territoryTownssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTerritoryTowns $territoryTowns The ChildTerritoryTowns object to add.
     */
    protected function doAddTerritoryTowns(ChildTerritoryTowns $territoryTowns): void
    {
        $this->collTerritoryTownss[]= $territoryTowns;
        $territoryTowns->setGeoTowns($this);
    }

    /**
     * @param ChildTerritoryTowns $territoryTowns The ChildTerritoryTowns object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTerritoryTowns(ChildTerritoryTowns $territoryTowns)
    {
        if ($this->getTerritoryTownss()->contains($territoryTowns)) {
            $pos = $this->collTerritoryTownss->search($territoryTowns);
            $this->collTerritoryTownss->remove($pos);
            if (null === $this->territoryTownssScheduledForDeletion) {
                $this->territoryTownssScheduledForDeletion = clone $this->collTerritoryTownss;
                $this->territoryTownssScheduledForDeletion->clear();
            }
            $this->territoryTownssScheduledForDeletion[]= clone $territoryTowns;
            $territoryTowns->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related TerritoryTownss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTerritoryTowns[] List of ChildTerritoryTowns objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritoryTowns}> List of ChildTerritoryTowns objects
     */
    public function getTerritoryTownssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTerritoryTownsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTerritoryTownss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related TerritoryTownss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTerritoryTowns[] List of ChildTerritoryTowns objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritoryTowns}> List of ChildTerritoryTowns objects
     */
    public function getTerritoryTownssJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTerritoryTownsQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getTerritoryTownss($query, $con);
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
     * If this ChildGeoTowns is new, it will return
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
                    ->filterByGeoTowns($this)
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
            $tourplansRemoved->setGeoTowns(null);
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
                ->filterByGeoTowns($this)
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
        $tourplans->setGeoTowns($this);
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
            $tourplans->setGeoTowns(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoTowns is new, it will return
     * an empty collection; or if this GeoTowns has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoTowns.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

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
        if (null !== $this->aGeoCity) {
            $this->aGeoCity->removeGeoTowns($this);
        }
        $this->itownid = null;
        $this->stownname = null;
        $this->icityid = null;
        $this->stowncode = null;
        $this->dcreateddate = null;
        $this->dmodifydate = null;
        $this->sstatus = null;
        $this->pincode = null;
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
            if ($this->collAttendancesRelatedByEndItownid) {
                foreach ($this->collAttendancesRelatedByEndItownid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAttendancesRelatedByStartItownid) {
                foreach ($this->collAttendancesRelatedByStartItownid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBeatss) {
                foreach ($this->collBeatss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCitycategories) {
                foreach ($this->collCitycategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallss) {
                foreach ($this->collDailycallss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDayplans) {
                foreach ($this->collDayplans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployees) {
                foreach ($this->collEmployees as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGeoDistancesRelatedByFromTownId) {
                foreach ($this->collGeoDistancesRelatedByFromTownId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGeoDistancesRelatedByToTownId) {
                foreach ($this->collGeoDistancesRelatedByToTownId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestAddresses) {
                foreach ($this->collOnBoardRequestAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletAddresses) {
                foreach ($this->collOutletAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletOrgDatas) {
                foreach ($this->collOutletOrgDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletss) {
                foreach ($this->collOutletss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPositionss) {
                foreach ($this->collPositionss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSfcMastersRelatedByFromTownId) {
                foreach ($this->collSfcMastersRelatedByFromTownId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSfcMastersRelatedByToTownId) {
                foreach ($this->collSfcMastersRelatedByToTownId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTerritoryTownss) {
                foreach ($this->collTerritoryTownss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTourplanss) {
                foreach ($this->collTourplanss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAttendancesRelatedByEndItownid = null;
        $this->collAttendancesRelatedByStartItownid = null;
        $this->collBeatss = null;
        $this->collCitycategories = null;
        $this->collDailycallss = null;
        $this->collDayplans = null;
        $this->collEmployees = null;
        $this->collGeoDistancesRelatedByFromTownId = null;
        $this->collGeoDistancesRelatedByToTownId = null;
        $this->collOnBoardRequestAddresses = null;
        $this->collOutletAddresses = null;
        $this->collOutletOrgDatas = null;
        $this->collOutletss = null;
        $this->collPositionss = null;
        $this->collSfcMastersRelatedByFromTownId = null;
        $this->collSfcMastersRelatedByToTownId = null;
        $this->collTerritoryTownss = null;
        $this->collTourplanss = null;
        $this->aGeoCity = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GeoTownsTableMap::DEFAULT_STRING_FORMAT);
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
