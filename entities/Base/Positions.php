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
use entities\BrandCampiagnDoctors as ChildBrandCampiagnDoctors;
use entities\BrandCampiagnDoctorsQuery as ChildBrandCampiagnDoctorsQuery;
use entities\BrandCampiagnVisits as ChildBrandCampiagnVisits;
use entities\BrandCampiagnVisitsQuery as ChildBrandCampiagnVisitsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Dailycalls as ChildDailycalls;
use entities\DailycallsQuery as ChildDailycallsQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeePositionHistory as ChildEmployeePositionHistory;
use entities\EmployeePositionHistoryQuery as ChildEmployeePositionHistoryQuery;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\Mtp as ChildMtp;
use entities\MtpQuery as ChildMtpQuery;
use entities\OnBoardRequest as ChildOnBoardRequest;
use entities\OnBoardRequestLog as ChildOnBoardRequestLog;
use entities\OnBoardRequestLogQuery as ChildOnBoardRequestLogQuery;
use entities\OnBoardRequestQuery as ChildOnBoardRequestQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\PrescriberData as ChildPrescriberData;
use entities\PrescriberDataQuery as ChildPrescriberDataQuery;
use entities\PrescriberTallySummary as ChildPrescriberTallySummary;
use entities\PrescriberTallySummaryQuery as ChildPrescriberTallySummaryQuery;
use entities\Stp as ChildStp;
use entities\StpQuery as ChildStpQuery;
use entities\Territories as ChildTerritories;
use entities\TerritoriesQuery as ChildTerritoriesQuery;
use entities\Tourplans as ChildTourplans;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\BrandCampiagnDoctorsTableMap;
use entities\Map\BrandCampiagnVisitsTableMap;
use entities\Map\DailycallsTableMap;
use entities\Map\EmployeePositionHistoryTableMap;
use entities\Map\EmployeeTableMap;
use entities\Map\MtpTableMap;
use entities\Map\OnBoardRequestLogTableMap;
use entities\Map\OnBoardRequestTableMap;
use entities\Map\PositionsTableMap;
use entities\Map\PrescriberDataTableMap;
use entities\Map\PrescriberTallySummaryTableMap;
use entities\Map\StpTableMap;
use entities\Map\TerritoriesTableMap;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a row from the 'positions' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Positions implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\PositionsTableMap';


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
     * The value for the position_id field.
     *
     * @var        int
     */
    protected $position_id;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the position_name field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $position_name;

    /**
     * The value for the position_code field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $position_code;

    /**
     * The value for the reporting_to field.
     *
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $reporting_to;

    /**
     * The value for the org_unit_id field.
     *
     * @var        int
     */
    protected $org_unit_id;

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
     * The value for the cav_positions_up field.
     *
     * @var        string|null
     */
    protected $cav_positions_up;

    /**
     * The value for the cav_positions_down field.
     *
     * @var        string|null
     */
    protected $cav_positions_down;

    /**
     * The value for the cav_territories field.
     *
     * @var        string|null
     */
    protected $cav_territories;

    /**
     * The value for the cav_towns field.
     *
     * @var        string|null
     */
    protected $cav_towns;

    /**
     * The value for the cav_date field.
     *
     * @var        DateTime|null
     */
    protected $cav_date;

    /**
     * The value for the cav_flag field.
     *
     * @var        string|null
     */
    protected $cav_flag;

    /**
     * The value for the itownid field.
     *
     * @var        int|null
     */
    protected $itownid;

    /**
     * The value for the mtp_type field.
     *
     * Note: this column has a database default value of: 'manual'
     * @var        string|null
     */
    protected $mtp_type;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTowns;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnDoctors[] Collection to store aggregation of ChildBrandCampiagnDoctors objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnDoctors> Collection to store aggregation of ChildBrandCampiagnDoctors objects.
     */
    protected $collBrandCampiagnDoctorss;
    protected $collBrandCampiagnDoctorssPartial;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnVisits[] Collection to store aggregation of ChildBrandCampiagnVisits objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisits> Collection to store aggregation of ChildBrandCampiagnVisits objects.
     */
    protected $collBrandCampiagnVisitss;
    protected $collBrandCampiagnVisitssPartial;

    /**
     * @var        ObjectCollection|ChildDailycalls[] Collection to store aggregation of ChildDailycalls objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycalls> Collection to store aggregation of ChildDailycalls objects.
     */
    protected $collDailycallss;
    protected $collDailycallssPartial;

    /**
     * @var        ObjectCollection|ChildEmployee[] Collection to store aggregation of ChildEmployee objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee> Collection to store aggregation of ChildEmployee objects.
     */
    protected $collEmployeesRelatedByPositionId;
    protected $collEmployeesRelatedByPositionIdPartial;

    /**
     * @var        ObjectCollection|ChildEmployee[] Collection to store aggregation of ChildEmployee objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee> Collection to store aggregation of ChildEmployee objects.
     */
    protected $collEmployeesRelatedByReportingTo;
    protected $collEmployeesRelatedByReportingToPartial;

    /**
     * @var        ObjectCollection|ChildEmployeePositionHistory[] Collection to store aggregation of ChildEmployeePositionHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeePositionHistory> Collection to store aggregation of ChildEmployeePositionHistory objects.
     */
    protected $collEmployeePositionHistories;
    protected $collEmployeePositionHistoriesPartial;

    /**
     * @var        ObjectCollection|ChildMtp[] Collection to store aggregation of ChildMtp objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildMtp> Collection to store aggregation of ChildMtp objects.
     */
    protected $collMtps;
    protected $collMtpsPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByApprovedByPositionId;
    protected $collOnBoardRequestsRelatedByApprovedByPositionIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByCreatedByPositionId;
    protected $collOnBoardRequestsRelatedByCreatedByPositionIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByFinalApprovedByPositionId;
    protected $collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByPosition;
    protected $collOnBoardRequestsRelatedByPositionPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByUpdatedByPositionId;
    protected $collOnBoardRequestsRelatedByUpdatedByPositionIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestLog[] Collection to store aggregation of ChildOnBoardRequestLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestLog> Collection to store aggregation of ChildOnBoardRequestLog objects.
     */
    protected $collOnBoardRequestLogs;
    protected $collOnBoardRequestLogsPartial;

    /**
     * @var        ObjectCollection|ChildPrescriberData[] Collection to store aggregation of ChildPrescriberData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberData> Collection to store aggregation of ChildPrescriberData objects.
     */
    protected $collPrescriberDatas;
    protected $collPrescriberDatasPartial;

    /**
     * @var        ObjectCollection|ChildPrescriberTallySummary[] Collection to store aggregation of ChildPrescriberTallySummary objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberTallySummary> Collection to store aggregation of ChildPrescriberTallySummary objects.
     */
    protected $collPrescriberTallySummaries;
    protected $collPrescriberTallySummariesPartial;

    /**
     * @var        ObjectCollection|ChildTerritories[] Collection to store aggregation of ChildTerritories objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTerritories> Collection to store aggregation of ChildTerritories objects.
     */
    protected $collTerritoriess;
    protected $collTerritoriessPartial;

    /**
     * @var        ObjectCollection|ChildTourplans[] Collection to store aggregation of ChildTourplans objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans> Collection to store aggregation of ChildTourplans objects.
     */
    protected $collTourplanss;
    protected $collTourplanssPartial;

    /**
     * @var        ObjectCollection|ChildStp[] Collection to store aggregation of ChildStp objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStp> Collection to store aggregation of ChildStp objects.
     */
    protected $collStps;
    protected $collStpsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnDoctors[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnDoctors>
     */
    protected $brandCampiagnDoctorssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnVisits[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisits>
     */
    protected $brandCampiagnVisitssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycalls[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycalls>
     */
    protected $dailycallssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployee[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee>
     */
    protected $employeesRelatedByPositionIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployee[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee>
     */
    protected $employeesRelatedByReportingToScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeePositionHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeePositionHistory>
     */
    protected $employeePositionHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMtp[]
     * @phpstan-var ObjectCollection&\Traversable<ChildMtp>
     */
    protected $mtpsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByPositionScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestLog>
     */
    protected $onBoardRequestLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrescriberData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberData>
     */
    protected $prescriberDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrescriberTallySummary[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberTallySummary>
     */
    protected $prescriberTallySummariesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTerritories[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTerritories>
     */
    protected $territoriessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTourplans[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans>
     */
    protected $tourplanssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStp[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStp>
     */
    protected $stpsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->company_id = 0;
        $this->position_name = '';
        $this->position_code = '';
        $this->reporting_to = 0;
        $this->mtp_type = 'manual';
    }

    /**
     * Initializes internal state of entities\Base\Positions object.
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
     * Compares this with another <code>Positions</code> instance.  If
     * <code>obj</code> is an instance of <code>Positions</code>, delegates to
     * <code>equals(Positions)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [position_id] column value.
     *
     * @return int
     */
    public function getPositionId()
    {
        return $this->position_id;
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
     * Get the [position_name] column value.
     *
     * @return string
     */
    public function getPositionName()
    {
        return $this->position_name;
    }

    /**
     * Get the [position_code] column value.
     *
     * @return string
     */
    public function getPositionCode()
    {
        return $this->position_code;
    }

    /**
     * Get the [reporting_to] column value.
     *
     * @return int|null
     */
    public function getReportingTo()
    {
        return $this->reporting_to;
    }

    /**
     * Get the [org_unit_id] column value.
     *
     * @return int
     */
    public function getOrgUnitId()
    {
        return $this->org_unit_id;
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
     * Get the [cav_positions_up] column value.
     *
     * @return string|null
     */
    public function getCavPositionsUp()
    {
        return $this->cav_positions_up;
    }

    /**
     * Get the [cav_positions_down] column value.
     *
     * @return string|null
     */
    public function getCavPositionsDown()
    {
        return $this->cav_positions_down;
    }

    /**
     * Get the [cav_territories] column value.
     *
     * @return string|null
     */
    public function getCavTerritories()
    {
        return $this->cav_territories;
    }

    /**
     * Get the [cav_towns] column value.
     *
     * @return string|null
     */
    public function getCavTowns()
    {
        return $this->cav_towns;
    }

    /**
     * Get the [optionally formatted] temporal [cav_date] column value.
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
    public function getCavDate($format = null)
    {
        if ($format === null) {
            return $this->cav_date;
        } else {
            return $this->cav_date instanceof \DateTimeInterface ? $this->cav_date->format($format) : null;
        }
    }

    /**
     * Get the [cav_flag] column value.
     *
     * @return string|null
     */
    public function getCavFlag()
    {
        return $this->cav_flag;
    }

    /**
     * Get the [itownid] column value.
     *
     * @return int|null
     */
    public function getItownid()
    {
        return $this->itownid;
    }

    /**
     * Get the [mtp_type] column value.
     *
     * @return string|null
     */
    public function getMtpType()
    {
        return $this->mtp_type;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[PositionsTableMap::COL_POSITION_ID] = true;
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
            $this->modifiedColumns[PositionsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [position_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_name !== $v) {
            $this->position_name = $v;
            $this->modifiedColumns[PositionsTableMap::COL_POSITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_code] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_code !== $v) {
            $this->position_code = $v;
            $this->modifiedColumns[PositionsTableMap::COL_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reporting_to] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setReportingTo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->reporting_to !== $v) {
            $this->reporting_to = $v;
            $this->modifiedColumns[PositionsTableMap::COL_REPORTING_TO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[PositionsTableMap::COL_ORG_UNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
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
                $this->modifiedColumns[PositionsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[PositionsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [cav_positions_up] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCavPositionsUp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cav_positions_up !== $v) {
            $this->cav_positions_up = $v;
            $this->modifiedColumns[PositionsTableMap::COL_CAV_POSITIONS_UP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cav_positions_down] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCavPositionsDown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cav_positions_down !== $v) {
            $this->cav_positions_down = $v;
            $this->modifiedColumns[PositionsTableMap::COL_CAV_POSITIONS_DOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cav_territories] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCavTerritories($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cav_territories !== $v) {
            $this->cav_territories = $v;
            $this->modifiedColumns[PositionsTableMap::COL_CAV_TERRITORIES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cav_towns] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCavTowns($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cav_towns !== $v) {
            $this->cav_towns = $v;
            $this->modifiedColumns[PositionsTableMap::COL_CAV_TOWNS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [cav_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCavDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->cav_date !== null || $dt !== null) {
            if ($this->cav_date === null || $dt === null || $dt->format("Y-m-d") !== $this->cav_date->format("Y-m-d")) {
                $this->cav_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PositionsTableMap::COL_CAV_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [cav_flag] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCavFlag($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cav_flag !== $v) {
            $this->cav_flag = $v;
            $this->modifiedColumns[PositionsTableMap::COL_CAV_FLAG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [itownid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setItownid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->itownid !== $v) {
            $this->itownid = $v;
            $this->modifiedColumns[PositionsTableMap::COL_ITOWNID] = true;
        }

        if ($this->aGeoTowns !== null && $this->aGeoTowns->getItownid() !== $v) {
            $this->aGeoTowns = null;
        }

        return $this;
    }

    /**
     * Set the value of [mtp_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMtpType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mtp_type !== $v) {
            $this->mtp_type = $v;
            $this->modifiedColumns[PositionsTableMap::COL_MTP_TYPE] = true;
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
            if ($this->company_id !== 0) {
                return false;
            }

            if ($this->position_name !== '') {
                return false;
            }

            if ($this->position_code !== '') {
                return false;
            }

            if ($this->reporting_to !== 0) {
                return false;
            }

            if ($this->mtp_type !== 'manual') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PositionsTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PositionsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PositionsTableMap::translateFieldName('PositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PositionsTableMap::translateFieldName('PositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PositionsTableMap::translateFieldName('ReportingTo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reporting_to = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PositionsTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PositionsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PositionsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PositionsTableMap::translateFieldName('CavPositionsUp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cav_positions_up = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PositionsTableMap::translateFieldName('CavPositionsDown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cav_positions_down = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PositionsTableMap::translateFieldName('CavTerritories', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cav_territories = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PositionsTableMap::translateFieldName('CavTowns', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cav_towns = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PositionsTableMap::translateFieldName('CavDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cav_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : PositionsTableMap::translateFieldName('CavFlag', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cav_flag = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : PositionsTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : PositionsTableMap::translateFieldName('MtpType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mtp_type = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = PositionsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Positions'), 0, $e);
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
        if ($this->aOrgUnit !== null && $this->org_unit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aGeoTowns !== null && $this->itownid !== $this->aGeoTowns->getItownid()) {
            $this->aGeoTowns = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PositionsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPositionsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aOrgUnit = null;
            $this->aGeoTowns = null;
            $this->collBrandCampiagnDoctorss = null;

            $this->collBrandCampiagnVisitss = null;

            $this->collDailycallss = null;

            $this->collEmployeesRelatedByPositionId = null;

            $this->collEmployeesRelatedByReportingTo = null;

            $this->collEmployeePositionHistories = null;

            $this->collMtps = null;

            $this->collOnBoardRequestsRelatedByApprovedByPositionId = null;

            $this->collOnBoardRequestsRelatedByCreatedByPositionId = null;

            $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId = null;

            $this->collOnBoardRequestsRelatedByPosition = null;

            $this->collOnBoardRequestsRelatedByUpdatedByPositionId = null;

            $this->collOnBoardRequestLogs = null;

            $this->collPrescriberDatas = null;

            $this->collPrescriberTallySummaries = null;

            $this->collTerritoriess = null;

            $this->collTourplanss = null;

            $this->collStps = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Positions::setDeleted()
     * @see Positions::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPositionsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PositionsTableMap::DATABASE_NAME);
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
                PositionsTableMap::addInstanceToPool($this);
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

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aGeoTowns !== null) {
                if ($this->aGeoTowns->isModified() || $this->aGeoTowns->isNew()) {
                    $affectedRows += $this->aGeoTowns->save($con);
                }
                $this->setGeoTowns($this->aGeoTowns);
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

            if ($this->brandCampiagnDoctorssScheduledForDeletion !== null) {
                if (!$this->brandCampiagnDoctorssScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnDoctorssScheduledForDeletion as $brandCampiagnDoctors) {
                        // need to save related object because we set the relation to null
                        $brandCampiagnDoctors->save($con);
                    }
                    $this->brandCampiagnDoctorssScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagnDoctorss !== null) {
                foreach ($this->collBrandCampiagnDoctorss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->employeesRelatedByPositionIdScheduledForDeletion !== null) {
                if (!$this->employeesRelatedByPositionIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->employeesRelatedByPositionIdScheduledForDeletion as $employeeRelatedByPositionId) {
                        // need to save related object because we set the relation to null
                        $employeeRelatedByPositionId->save($con);
                    }
                    $this->employeesRelatedByPositionIdScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeesRelatedByPositionId !== null) {
                foreach ($this->collEmployeesRelatedByPositionId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeesRelatedByReportingToScheduledForDeletion !== null) {
                if (!$this->employeesRelatedByReportingToScheduledForDeletion->isEmpty()) {
                    foreach ($this->employeesRelatedByReportingToScheduledForDeletion as $employeeRelatedByReportingTo) {
                        // need to save related object because we set the relation to null
                        $employeeRelatedByReportingTo->save($con);
                    }
                    $this->employeesRelatedByReportingToScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeesRelatedByReportingTo !== null) {
                foreach ($this->collEmployeesRelatedByReportingTo as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeePositionHistoriesScheduledForDeletion !== null) {
                if (!$this->employeePositionHistoriesScheduledForDeletion->isEmpty()) {
                    \entities\EmployeePositionHistoryQuery::create()
                        ->filterByPrimaryKeys($this->employeePositionHistoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeePositionHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeePositionHistories !== null) {
                foreach ($this->collEmployeePositionHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->mtpsScheduledForDeletion !== null) {
                if (!$this->mtpsScheduledForDeletion->isEmpty()) {
                    \entities\MtpQuery::create()
                        ->filterByPrimaryKeys($this->mtpsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->mtpsScheduledForDeletion = null;
                }
            }

            if ($this->collMtps !== null) {
                foreach ($this->collMtps as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion as $onBoardRequestRelatedByApprovedByPositionId) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByApprovedByPositionId->save($con);
                    }
                    $this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByApprovedByPositionId !== null) {
                foreach ($this->collOnBoardRequestsRelatedByApprovedByPositionId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion as $onBoardRequestRelatedByCreatedByPositionId) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByCreatedByPositionId->save($con);
                    }
                    $this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByCreatedByPositionId !== null) {
                foreach ($this->collOnBoardRequestsRelatedByCreatedByPositionId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion as $onBoardRequestRelatedByFinalApprovedByPositionId) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByFinalApprovedByPositionId->save($con);
                    }
                    $this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByFinalApprovedByPositionId !== null) {
                foreach ($this->collOnBoardRequestsRelatedByFinalApprovedByPositionId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByPositionScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByPositionScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByPositionScheduledForDeletion as $onBoardRequestRelatedByPosition) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByPosition->save($con);
                    }
                    $this->onBoardRequestsRelatedByPositionScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByPosition !== null) {
                foreach ($this->collOnBoardRequestsRelatedByPosition as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion as $onBoardRequestRelatedByUpdatedByPositionId) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByUpdatedByPositionId->save($con);
                    }
                    $this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByUpdatedByPositionId !== null) {
                foreach ($this->collOnBoardRequestsRelatedByUpdatedByPositionId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestLogsScheduledForDeletion !== null) {
                if (!$this->onBoardRequestLogsScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestLogsScheduledForDeletion as $onBoardRequestLog) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestLog->save($con);
                    }
                    $this->onBoardRequestLogsScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestLogs !== null) {
                foreach ($this->collOnBoardRequestLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->prescriberDatasScheduledForDeletion !== null) {
                if (!$this->prescriberDatasScheduledForDeletion->isEmpty()) {
                    \entities\PrescriberDataQuery::create()
                        ->filterByPrimaryKeys($this->prescriberDatasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prescriberDatasScheduledForDeletion = null;
                }
            }

            if ($this->collPrescriberDatas !== null) {
                foreach ($this->collPrescriberDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->prescriberTallySummariesScheduledForDeletion !== null) {
                if (!$this->prescriberTallySummariesScheduledForDeletion->isEmpty()) {
                    \entities\PrescriberTallySummaryQuery::create()
                        ->filterByPrimaryKeys($this->prescriberTallySummariesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prescriberTallySummariesScheduledForDeletion = null;
                }
            }

            if ($this->collPrescriberTallySummaries !== null) {
                foreach ($this->collPrescriberTallySummaries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->territoriessScheduledForDeletion !== null) {
                if (!$this->territoriessScheduledForDeletion->isEmpty()) {
                    foreach ($this->territoriessScheduledForDeletion as $territories) {
                        // need to save related object because we set the relation to null
                        $territories->save($con);
                    }
                    $this->territoriessScheduledForDeletion = null;
                }
            }

            if ($this->collTerritoriess !== null) {
                foreach ($this->collTerritoriess as $referrerFK) {
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

            if ($this->stpsScheduledForDeletion !== null) {
                if (!$this->stpsScheduledForDeletion->isEmpty()) {
                    \entities\StpQuery::create()
                        ->filterByPrimaryKeys($this->stpsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stpsScheduledForDeletion = null;
                }
            }

            if ($this->collStps !== null) {
                foreach ($this->collStps as $referrerFK) {
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

        $this->modifiedColumns[PositionsTableMap::COL_POSITION_ID] = true;
        if (null !== $this->position_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PositionsTableMap::COL_POSITION_ID . ')');
        }
        if (null === $this->position_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('positions_position_id_seq')");
                $this->position_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PositionsTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_POSITION_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'position_name';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'position_code';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_REPORTING_TO)) {
            $modifiedColumns[':p' . $index++]  = 'reporting_to';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_id';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_POSITIONS_UP)) {
            $modifiedColumns[':p' . $index++]  = 'cav_positions_up';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_POSITIONS_DOWN)) {
            $modifiedColumns[':p' . $index++]  = 'cav_positions_down';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_TERRITORIES)) {
            $modifiedColumns[':p' . $index++]  = 'cav_territories';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_TOWNS)) {
            $modifiedColumns[':p' . $index++]  = 'cav_towns';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'cav_date';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_FLAG)) {
            $modifiedColumns[':p' . $index++]  = 'cav_flag';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(PositionsTableMap::COL_MTP_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'mtp_type';
        }

        $sql = sprintf(
            'INSERT INTO positions (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'position_name':
                        $stmt->bindValue($identifier, $this->position_name, PDO::PARAM_STR);

                        break;
                    case 'position_code':
                        $stmt->bindValue($identifier, $this->position_code, PDO::PARAM_STR);

                        break;
                    case 'reporting_to':
                        $stmt->bindValue($identifier, $this->reporting_to, PDO::PARAM_INT);

                        break;
                    case 'org_unit_id':
                        $stmt->bindValue($identifier, $this->org_unit_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'cav_positions_up':
                        $stmt->bindValue($identifier, $this->cav_positions_up, PDO::PARAM_STR);

                        break;
                    case 'cav_positions_down':
                        $stmt->bindValue($identifier, $this->cav_positions_down, PDO::PARAM_STR);

                        break;
                    case 'cav_territories':
                        $stmt->bindValue($identifier, $this->cav_territories, PDO::PARAM_STR);

                        break;
                    case 'cav_towns':
                        $stmt->bindValue($identifier, $this->cav_towns, PDO::PARAM_STR);

                        break;
                    case 'cav_date':
                        $stmt->bindValue($identifier, $this->cav_date ? $this->cav_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'cav_flag':
                        $stmt->bindValue($identifier, $this->cav_flag, PDO::PARAM_STR);

                        break;
                    case 'itownid':
                        $stmt->bindValue($identifier, $this->itownid, PDO::PARAM_INT);

                        break;
                    case 'mtp_type':
                        $stmt->bindValue($identifier, $this->mtp_type, PDO::PARAM_STR);

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
        $pos = PositionsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPositionId();

            case 1:
                return $this->getCompanyId();

            case 2:
                return $this->getPositionName();

            case 3:
                return $this->getPositionCode();

            case 4:
                return $this->getReportingTo();

            case 5:
                return $this->getOrgUnitId();

            case 6:
                return $this->getCreatedAt();

            case 7:
                return $this->getUpdatedAt();

            case 8:
                return $this->getCavPositionsUp();

            case 9:
                return $this->getCavPositionsDown();

            case 10:
                return $this->getCavTerritories();

            case 11:
                return $this->getCavTowns();

            case 12:
                return $this->getCavDate();

            case 13:
                return $this->getCavFlag();

            case 14:
                return $this->getItownid();

            case 15:
                return $this->getMtpType();

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
        if (isset($alreadyDumpedObjects['Positions'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Positions'][$this->hashCode()] = true;
        $keys = PositionsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getPositionId(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getPositionName(),
            $keys[3] => $this->getPositionCode(),
            $keys[4] => $this->getReportingTo(),
            $keys[5] => $this->getOrgUnitId(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedAt(),
            $keys[8] => $this->getCavPositionsUp(),
            $keys[9] => $this->getCavPositionsDown(),
            $keys[10] => $this->getCavTerritories(),
            $keys[11] => $this->getCavTowns(),
            $keys[12] => $this->getCavDate(),
            $keys[13] => $this->getCavFlag(),
            $keys[14] => $this->getItownid(),
            $keys[15] => $this->getMtpType(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d');
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
            if (null !== $this->aOrgUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orgUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'org_unit';
                        break;
                    default:
                        $key = 'OrgUnit';
                }

                $result[$key] = $this->aOrgUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeoTowns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoTowns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_towns';
                        break;
                    default:
                        $key = 'GeoTowns';
                }

                $result[$key] = $this->aGeoTowns->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBrandCampiagnDoctorss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagnDoctorss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn_doctorss';
                        break;
                    default:
                        $key = 'BrandCampiagnDoctorss';
                }

                $result[$key] = $this->collBrandCampiagnDoctorss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collEmployeesRelatedByPositionId) {

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

                $result[$key] = $this->collEmployeesRelatedByPositionId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeesRelatedByReportingTo) {

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

                $result[$key] = $this->collEmployeesRelatedByReportingTo->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeePositionHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeePositionHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee_position_histories';
                        break;
                    default:
                        $key = 'EmployeePositionHistories';
                }

                $result[$key] = $this->collEmployeePositionHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMtps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mtps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'mtps';
                        break;
                    default:
                        $key = 'Mtps';
                }

                $result[$key] = $this->collMtps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByApprovedByPositionId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByApprovedByPositionId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByCreatedByPositionId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByCreatedByPositionId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByPosition) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByPosition->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByUpdatedByPositionId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByUpdatedByPositionId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequestLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request_logs';
                        break;
                    default:
                        $key = 'OnBoardRequestLogs';
                }

                $result[$key] = $this->collOnBoardRequestLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPrescriberDatas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prescriberDatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prescriber_datas';
                        break;
                    default:
                        $key = 'PrescriberDatas';
                }

                $result[$key] = $this->collPrescriberDatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPrescriberTallySummaries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prescriberTallySummaries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prescriber_tally_summaries';
                        break;
                    default:
                        $key = 'PrescriberTallySummaries';
                }

                $result[$key] = $this->collPrescriberTallySummaries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTerritoriess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'territoriess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'territoriess';
                        break;
                    default:
                        $key = 'Territoriess';
                }

                $result[$key] = $this->collTerritoriess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collStps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stps';
                        break;
                    default:
                        $key = 'Stps';
                }

                $result[$key] = $this->collStps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PositionsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setPositionId($value);
                break;
            case 1:
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setPositionName($value);
                break;
            case 3:
                $this->setPositionCode($value);
                break;
            case 4:
                $this->setReportingTo($value);
                break;
            case 5:
                $this->setOrgUnitId($value);
                break;
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
                $this->setUpdatedAt($value);
                break;
            case 8:
                $this->setCavPositionsUp($value);
                break;
            case 9:
                $this->setCavPositionsDown($value);
                break;
            case 10:
                $this->setCavTerritories($value);
                break;
            case 11:
                $this->setCavTowns($value);
                break;
            case 12:
                $this->setCavDate($value);
                break;
            case 13:
                $this->setCavFlag($value);
                break;
            case 14:
                $this->setItownid($value);
                break;
            case 15:
                $this->setMtpType($value);
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
        $keys = PositionsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPositionId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPositionName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPositionCode($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setReportingTo($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOrgUnitId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCreatedAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUpdatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCavPositionsUp($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCavPositionsDown($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCavTerritories($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCavTowns($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCavDate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCavFlag($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setItownid($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setMtpType($arr[$keys[15]]);
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
        $criteria = new Criteria(PositionsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PositionsTableMap::COL_POSITION_ID)) {
            $criteria->add(PositionsTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_COMPANY_ID)) {
            $criteria->add(PositionsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_POSITION_NAME)) {
            $criteria->add(PositionsTableMap::COL_POSITION_NAME, $this->position_name);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_POSITION_CODE)) {
            $criteria->add(PositionsTableMap::COL_POSITION_CODE, $this->position_code);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_REPORTING_TO)) {
            $criteria->add(PositionsTableMap::COL_REPORTING_TO, $this->reporting_to);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(PositionsTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CREATED_AT)) {
            $criteria->add(PositionsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_UPDATED_AT)) {
            $criteria->add(PositionsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_POSITIONS_UP)) {
            $criteria->add(PositionsTableMap::COL_CAV_POSITIONS_UP, $this->cav_positions_up);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_POSITIONS_DOWN)) {
            $criteria->add(PositionsTableMap::COL_CAV_POSITIONS_DOWN, $this->cav_positions_down);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_TERRITORIES)) {
            $criteria->add(PositionsTableMap::COL_CAV_TERRITORIES, $this->cav_territories);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_TOWNS)) {
            $criteria->add(PositionsTableMap::COL_CAV_TOWNS, $this->cav_towns);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_DATE)) {
            $criteria->add(PositionsTableMap::COL_CAV_DATE, $this->cav_date);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_CAV_FLAG)) {
            $criteria->add(PositionsTableMap::COL_CAV_FLAG, $this->cav_flag);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_ITOWNID)) {
            $criteria->add(PositionsTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(PositionsTableMap::COL_MTP_TYPE)) {
            $criteria->add(PositionsTableMap::COL_MTP_TYPE, $this->mtp_type);
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
        $criteria = ChildPositionsQuery::create();
        $criteria->add(PositionsTableMap::COL_POSITION_ID, $this->position_id);

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
        $validPk = null !== $this->getPositionId();

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
        return $this->getPositionId();
    }

    /**
     * Generic method to set the primary key (position_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setPositionId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getPositionId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Positions (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setPositionName($this->getPositionName());
        $copyObj->setPositionCode($this->getPositionCode());
        $copyObj->setReportingTo($this->getReportingTo());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setCavPositionsUp($this->getCavPositionsUp());
        $copyObj->setCavPositionsDown($this->getCavPositionsDown());
        $copyObj->setCavTerritories($this->getCavTerritories());
        $copyObj->setCavTowns($this->getCavTowns());
        $copyObj->setCavDate($this->getCavDate());
        $copyObj->setCavFlag($this->getCavFlag());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setMtpType($this->getMtpType());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagnDoctorss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnDoctors($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandCampiagnVisitss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnVisits($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycalls($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeesRelatedByPositionId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeeRelatedByPositionId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeesRelatedByReportingTo() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeeRelatedByReportingTo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeePositionHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeePositionHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMtps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMtp($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByApprovedByPositionId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByApprovedByPositionId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByCreatedByPositionId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByCreatedByPositionId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByFinalApprovedByPositionId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByFinalApprovedByPositionId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByPosition() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByPosition($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByUpdatedByPositionId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByUpdatedByPositionId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPrescriberDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrescriberData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPrescriberTallySummaries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrescriberTallySummary($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTerritoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTerritories($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTourplanss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTourplans($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStp($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPositionId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Positions Clone of current object.
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
            $this->setCompanyId(0);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addPositions($this);
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
                $this->aCompany->addPositionss($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildOrgUnit object.
     *
     * @param ChildOrgUnit $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrgUnit(ChildOrgUnit $v = null)
    {
        if ($v === null) {
            $this->setOrgUnitId(NULL);
        } else {
            $this->setOrgUnitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addPositions($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrgUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOrgUnit The associated ChildOrgUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrgUnit(?ConnectionInterface $con = null)
    {
        if ($this->aOrgUnit === null && ($this->org_unit_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->org_unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addPositionss($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildGeoTowns object.
     *
     * @param ChildGeoTowns|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoTowns(ChildGeoTowns $v = null)
    {
        if ($v === null) {
            $this->setItownid(NULL);
        } else {
            $this->setItownid($v->getItownid());
        }

        $this->aGeoTowns = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoTowns object, it will not be re-added.
        if ($v !== null) {
            $v->addPositions($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoTowns object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoTowns|null The associated ChildGeoTowns object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoTowns(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTowns === null && ($this->itownid != 0)) {
            $this->aGeoTowns = ChildGeoTownsQuery::create()->findPk($this->itownid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTowns->addPositionss($this);
             */
        }

        return $this->aGeoTowns;
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
        if ('BrandCampiagnDoctors' === $relationName) {
            $this->initBrandCampiagnDoctorss();
            return;
        }
        if ('BrandCampiagnVisits' === $relationName) {
            $this->initBrandCampiagnVisitss();
            return;
        }
        if ('Dailycalls' === $relationName) {
            $this->initDailycallss();
            return;
        }
        if ('EmployeeRelatedByPositionId' === $relationName) {
            $this->initEmployeesRelatedByPositionId();
            return;
        }
        if ('EmployeeRelatedByReportingTo' === $relationName) {
            $this->initEmployeesRelatedByReportingTo();
            return;
        }
        if ('EmployeePositionHistory' === $relationName) {
            $this->initEmployeePositionHistories();
            return;
        }
        if ('Mtp' === $relationName) {
            $this->initMtps();
            return;
        }
        if ('OnBoardRequestRelatedByApprovedByPositionId' === $relationName) {
            $this->initOnBoardRequestsRelatedByApprovedByPositionId();
            return;
        }
        if ('OnBoardRequestRelatedByCreatedByPositionId' === $relationName) {
            $this->initOnBoardRequestsRelatedByCreatedByPositionId();
            return;
        }
        if ('OnBoardRequestRelatedByFinalApprovedByPositionId' === $relationName) {
            $this->initOnBoardRequestsRelatedByFinalApprovedByPositionId();
            return;
        }
        if ('OnBoardRequestRelatedByPosition' === $relationName) {
            $this->initOnBoardRequestsRelatedByPosition();
            return;
        }
        if ('OnBoardRequestRelatedByUpdatedByPositionId' === $relationName) {
            $this->initOnBoardRequestsRelatedByUpdatedByPositionId();
            return;
        }
        if ('OnBoardRequestLog' === $relationName) {
            $this->initOnBoardRequestLogs();
            return;
        }
        if ('PrescriberData' === $relationName) {
            $this->initPrescriberDatas();
            return;
        }
        if ('PrescriberTallySummary' === $relationName) {
            $this->initPrescriberTallySummaries();
            return;
        }
        if ('Territories' === $relationName) {
            $this->initTerritoriess();
            return;
        }
        if ('Tourplans' === $relationName) {
            $this->initTourplanss();
            return;
        }
        if ('Stp' === $relationName) {
            $this->initStps();
            return;
        }
    }

    /**
     * Clears out the collBrandCampiagnDoctorss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagnDoctorss()
     */
    public function clearBrandCampiagnDoctorss()
    {
        $this->collBrandCampiagnDoctorss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagnDoctorss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagnDoctorss($v = true): void
    {
        $this->collBrandCampiagnDoctorssPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagnDoctorss collection.
     *
     * By default this just sets the collBrandCampiagnDoctorss collection to an empty array (like clearcollBrandCampiagnDoctorss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagnDoctorss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagnDoctorss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnDoctorsTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagnDoctorss = new $collectionClassName;
        $this->collBrandCampiagnDoctorss->setModel('\entities\BrandCampiagnDoctors');
    }

    /**
     * Gets an array of ChildBrandCampiagnDoctors objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors> List of ChildBrandCampiagnDoctors objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagnDoctorss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnDoctorssPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnDoctorss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagnDoctorss) {
                    $this->initBrandCampiagnDoctorss();
                } else {
                    $collectionClassName = BrandCampiagnDoctorsTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagnDoctorss = new $collectionClassName;
                    $collBrandCampiagnDoctorss->setModel('\entities\BrandCampiagnDoctors');

                    return $collBrandCampiagnDoctorss;
                }
            } else {
                $collBrandCampiagnDoctorss = ChildBrandCampiagnDoctorsQuery::create(null, $criteria)
                    ->filterByPositions($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnDoctorssPartial && count($collBrandCampiagnDoctorss)) {
                        $this->initBrandCampiagnDoctorss(false);

                        foreach ($collBrandCampiagnDoctorss as $obj) {
                            if (false == $this->collBrandCampiagnDoctorss->contains($obj)) {
                                $this->collBrandCampiagnDoctorss->append($obj);
                            }
                        }

                        $this->collBrandCampiagnDoctorssPartial = true;
                    }

                    return $collBrandCampiagnDoctorss;
                }

                if ($partial && $this->collBrandCampiagnDoctorss) {
                    foreach ($this->collBrandCampiagnDoctorss as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagnDoctorss[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagnDoctorss = $collBrandCampiagnDoctorss;
                $this->collBrandCampiagnDoctorssPartial = false;
            }
        }

        return $this->collBrandCampiagnDoctorss;
    }

    /**
     * Sets a collection of ChildBrandCampiagnDoctors objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagnDoctorss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnDoctorss(Collection $brandCampiagnDoctorss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagnDoctors[] $brandCampiagnDoctorssToDelete */
        $brandCampiagnDoctorssToDelete = $this->getBrandCampiagnDoctorss(new Criteria(), $con)->diff($brandCampiagnDoctorss);


        $this->brandCampiagnDoctorssScheduledForDeletion = $brandCampiagnDoctorssToDelete;

        foreach ($brandCampiagnDoctorssToDelete as $brandCampiagnDoctorsRemoved) {
            $brandCampiagnDoctorsRemoved->setPositions(null);
        }

        $this->collBrandCampiagnDoctorss = null;
        foreach ($brandCampiagnDoctorss as $brandCampiagnDoctors) {
            $this->addBrandCampiagnDoctors($brandCampiagnDoctors);
        }

        $this->collBrandCampiagnDoctorss = $brandCampiagnDoctorss;
        $this->collBrandCampiagnDoctorssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagnDoctors objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagnDoctors objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagnDoctorss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnDoctorssPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnDoctorss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagnDoctorss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagnDoctorss());
            }

            $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositions($this)
                ->count($con);
        }

        return count($this->collBrandCampiagnDoctorss);
    }

    /**
     * Method called to associate a ChildBrandCampiagnDoctors object to this object
     * through the ChildBrandCampiagnDoctors foreign key attribute.
     *
     * @param ChildBrandCampiagnDoctors $l ChildBrandCampiagnDoctors
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagnDoctors(ChildBrandCampiagnDoctors $l)
    {
        if ($this->collBrandCampiagnDoctorss === null) {
            $this->initBrandCampiagnDoctorss();
            $this->collBrandCampiagnDoctorssPartial = true;
        }

        if (!$this->collBrandCampiagnDoctorss->contains($l)) {
            $this->doAddBrandCampiagnDoctors($l);

            if ($this->brandCampiagnDoctorssScheduledForDeletion and $this->brandCampiagnDoctorssScheduledForDeletion->contains($l)) {
                $this->brandCampiagnDoctorssScheduledForDeletion->remove($this->brandCampiagnDoctorssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagnDoctors $brandCampiagnDoctors The ChildBrandCampiagnDoctors object to add.
     */
    protected function doAddBrandCampiagnDoctors(ChildBrandCampiagnDoctors $brandCampiagnDoctors): void
    {
        $this->collBrandCampiagnDoctorss[]= $brandCampiagnDoctors;
        $brandCampiagnDoctors->setPositions($this);
    }

    /**
     * @param ChildBrandCampiagnDoctors $brandCampiagnDoctors The ChildBrandCampiagnDoctors object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagnDoctors(ChildBrandCampiagnDoctors $brandCampiagnDoctors)
    {
        if ($this->getBrandCampiagnDoctorss()->contains($brandCampiagnDoctors)) {
            $pos = $this->collBrandCampiagnDoctorss->search($brandCampiagnDoctors);
            $this->collBrandCampiagnDoctorss->remove($pos);
            if (null === $this->brandCampiagnDoctorssScheduledForDeletion) {
                $this->brandCampiagnDoctorssScheduledForDeletion = clone $this->collBrandCampiagnDoctorss;
                $this->brandCampiagnDoctorssScheduledForDeletion->clear();
            }
            $this->brandCampiagnDoctorssScheduledForDeletion[]= $brandCampiagnDoctors;
            $brandCampiagnDoctors->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinBrandCampiagn(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagn', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
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
     * If this ChildPositions is new, it will return
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
                    ->filterByPositions($this)
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
            $brandCampiagnVisitsRemoved->setPositions(null);
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
                ->filterByPositions($this)
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
        $brandCampiagnVisits->setPositions($this);
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
            $brandCampiagnVisits->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * If this ChildPositions is new, it will return
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
                    ->filterByPositions($this)
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
            $dailycallsRemoved->setPositions(null);
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
                ->filterByPositions($this)
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
        $dailycalls->setPositions($this);
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
            $dailycalls->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getDailycallss($query, $con);
    }

    /**
     * Clears out the collEmployeesRelatedByPositionId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployeesRelatedByPositionId()
     */
    public function clearEmployeesRelatedByPositionId()
    {
        $this->collEmployeesRelatedByPositionId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployeesRelatedByPositionId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployeesRelatedByPositionId($v = true): void
    {
        $this->collEmployeesRelatedByPositionIdPartial = $v;
    }

    /**
     * Initializes the collEmployeesRelatedByPositionId collection.
     *
     * By default this just sets the collEmployeesRelatedByPositionId collection to an empty array (like clearcollEmployeesRelatedByPositionId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeesRelatedByPositionId(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployeesRelatedByPositionId && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeesRelatedByPositionId = new $collectionClassName;
        $this->collEmployeesRelatedByPositionId->setModel('\entities\Employee');
    }

    /**
     * Gets an array of ChildEmployee objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee> List of ChildEmployee objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeesRelatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeesRelatedByPositionIdPartial && !$this->isNew();
        if (null === $this->collEmployeesRelatedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployeesRelatedByPositionId) {
                    $this->initEmployeesRelatedByPositionId();
                } else {
                    $collectionClassName = EmployeeTableMap::getTableMap()->getCollectionClassName();

                    $collEmployeesRelatedByPositionId = new $collectionClassName;
                    $collEmployeesRelatedByPositionId->setModel('\entities\Employee');

                    return $collEmployeesRelatedByPositionId;
                }
            } else {
                $collEmployeesRelatedByPositionId = ChildEmployeeQuery::create(null, $criteria)
                    ->filterByPositionsRelatedByPositionId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeesRelatedByPositionIdPartial && count($collEmployeesRelatedByPositionId)) {
                        $this->initEmployeesRelatedByPositionId(false);

                        foreach ($collEmployeesRelatedByPositionId as $obj) {
                            if (false == $this->collEmployeesRelatedByPositionId->contains($obj)) {
                                $this->collEmployeesRelatedByPositionId->append($obj);
                            }
                        }

                        $this->collEmployeesRelatedByPositionIdPartial = true;
                    }

                    return $collEmployeesRelatedByPositionId;
                }

                if ($partial && $this->collEmployeesRelatedByPositionId) {
                    foreach ($this->collEmployeesRelatedByPositionId as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeesRelatedByPositionId[] = $obj;
                        }
                    }
                }

                $this->collEmployeesRelatedByPositionId = $collEmployeesRelatedByPositionId;
                $this->collEmployeesRelatedByPositionIdPartial = false;
            }
        }

        return $this->collEmployeesRelatedByPositionId;
    }

    /**
     * Sets a collection of ChildEmployee objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employeesRelatedByPositionId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeesRelatedByPositionId(Collection $employeesRelatedByPositionId, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployee[] $employeesRelatedByPositionIdToDelete */
        $employeesRelatedByPositionIdToDelete = $this->getEmployeesRelatedByPositionId(new Criteria(), $con)->diff($employeesRelatedByPositionId);


        $this->employeesRelatedByPositionIdScheduledForDeletion = $employeesRelatedByPositionIdToDelete;

        foreach ($employeesRelatedByPositionIdToDelete as $employeeRelatedByPositionIdRemoved) {
            $employeeRelatedByPositionIdRemoved->setPositionsRelatedByPositionId(null);
        }

        $this->collEmployeesRelatedByPositionId = null;
        foreach ($employeesRelatedByPositionId as $employeeRelatedByPositionId) {
            $this->addEmployeeRelatedByPositionId($employeeRelatedByPositionId);
        }

        $this->collEmployeesRelatedByPositionId = $employeesRelatedByPositionId;
        $this->collEmployeesRelatedByPositionIdPartial = false;

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
    public function countEmployeesRelatedByPositionId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeesRelatedByPositionIdPartial && !$this->isNew();
        if (null === $this->collEmployeesRelatedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeesRelatedByPositionId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeesRelatedByPositionId());
            }

            $query = ChildEmployeeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositionsRelatedByPositionId($this)
                ->count($con);
        }

        return count($this->collEmployeesRelatedByPositionId);
    }

    /**
     * Method called to associate a ChildEmployee object to this object
     * through the ChildEmployee foreign key attribute.
     *
     * @param ChildEmployee $l ChildEmployee
     * @return $this The current object (for fluent API support)
     */
    public function addEmployeeRelatedByPositionId(ChildEmployee $l)
    {
        if ($this->collEmployeesRelatedByPositionId === null) {
            $this->initEmployeesRelatedByPositionId();
            $this->collEmployeesRelatedByPositionIdPartial = true;
        }

        if (!$this->collEmployeesRelatedByPositionId->contains($l)) {
            $this->doAddEmployeeRelatedByPositionId($l);

            if ($this->employeesRelatedByPositionIdScheduledForDeletion and $this->employeesRelatedByPositionIdScheduledForDeletion->contains($l)) {
                $this->employeesRelatedByPositionIdScheduledForDeletion->remove($this->employeesRelatedByPositionIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployee $employeeRelatedByPositionId The ChildEmployee object to add.
     */
    protected function doAddEmployeeRelatedByPositionId(ChildEmployee $employeeRelatedByPositionId): void
    {
        $this->collEmployeesRelatedByPositionId[]= $employeeRelatedByPositionId;
        $employeeRelatedByPositionId->setPositionsRelatedByPositionId($this);
    }

    /**
     * @param ChildEmployee $employeeRelatedByPositionId The ChildEmployee object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployeeRelatedByPositionId(ChildEmployee $employeeRelatedByPositionId)
    {
        if ($this->getEmployeesRelatedByPositionId()->contains($employeeRelatedByPositionId)) {
            $pos = $this->collEmployeesRelatedByPositionId->search($employeeRelatedByPositionId);
            $this->collEmployeesRelatedByPositionId->remove($pos);
            if (null === $this->employeesRelatedByPositionIdScheduledForDeletion) {
                $this->employeesRelatedByPositionIdScheduledForDeletion = clone $this->collEmployeesRelatedByPositionId;
                $this->employeesRelatedByPositionIdScheduledForDeletion->clear();
            }
            $this->employeesRelatedByPositionIdScheduledForDeletion[]= $employeeRelatedByPositionId;
            $employeeRelatedByPositionId->setPositionsRelatedByPositionId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByPositionIdJoinBranch(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Branch', $joinBehavior);

        return $this->getEmployeesRelatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByPositionIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEmployeesRelatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByPositionIdJoinDesignations(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Designations', $joinBehavior);

        return $this->getEmployeesRelatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByPositionIdJoinGradeMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('GradeMaster', $joinBehavior);

        return $this->getEmployeesRelatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByPositionIdJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getEmployeesRelatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByPositionIdJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getEmployeesRelatedByPositionId($query, $con);
    }

    /**
     * Clears out the collEmployeesRelatedByReportingTo collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployeesRelatedByReportingTo()
     */
    public function clearEmployeesRelatedByReportingTo()
    {
        $this->collEmployeesRelatedByReportingTo = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployeesRelatedByReportingTo collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployeesRelatedByReportingTo($v = true): void
    {
        $this->collEmployeesRelatedByReportingToPartial = $v;
    }

    /**
     * Initializes the collEmployeesRelatedByReportingTo collection.
     *
     * By default this just sets the collEmployeesRelatedByReportingTo collection to an empty array (like clearcollEmployeesRelatedByReportingTo());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeesRelatedByReportingTo(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployeesRelatedByReportingTo && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeesRelatedByReportingTo = new $collectionClassName;
        $this->collEmployeesRelatedByReportingTo->setModel('\entities\Employee');
    }

    /**
     * Gets an array of ChildEmployee objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee> List of ChildEmployee objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeesRelatedByReportingTo(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeesRelatedByReportingToPartial && !$this->isNew();
        if (null === $this->collEmployeesRelatedByReportingTo || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployeesRelatedByReportingTo) {
                    $this->initEmployeesRelatedByReportingTo();
                } else {
                    $collectionClassName = EmployeeTableMap::getTableMap()->getCollectionClassName();

                    $collEmployeesRelatedByReportingTo = new $collectionClassName;
                    $collEmployeesRelatedByReportingTo->setModel('\entities\Employee');

                    return $collEmployeesRelatedByReportingTo;
                }
            } else {
                $collEmployeesRelatedByReportingTo = ChildEmployeeQuery::create(null, $criteria)
                    ->filterByPositionsRelatedByReportingTo($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeesRelatedByReportingToPartial && count($collEmployeesRelatedByReportingTo)) {
                        $this->initEmployeesRelatedByReportingTo(false);

                        foreach ($collEmployeesRelatedByReportingTo as $obj) {
                            if (false == $this->collEmployeesRelatedByReportingTo->contains($obj)) {
                                $this->collEmployeesRelatedByReportingTo->append($obj);
                            }
                        }

                        $this->collEmployeesRelatedByReportingToPartial = true;
                    }

                    return $collEmployeesRelatedByReportingTo;
                }

                if ($partial && $this->collEmployeesRelatedByReportingTo) {
                    foreach ($this->collEmployeesRelatedByReportingTo as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeesRelatedByReportingTo[] = $obj;
                        }
                    }
                }

                $this->collEmployeesRelatedByReportingTo = $collEmployeesRelatedByReportingTo;
                $this->collEmployeesRelatedByReportingToPartial = false;
            }
        }

        return $this->collEmployeesRelatedByReportingTo;
    }

    /**
     * Sets a collection of ChildEmployee objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employeesRelatedByReportingTo A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeesRelatedByReportingTo(Collection $employeesRelatedByReportingTo, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployee[] $employeesRelatedByReportingToToDelete */
        $employeesRelatedByReportingToToDelete = $this->getEmployeesRelatedByReportingTo(new Criteria(), $con)->diff($employeesRelatedByReportingTo);


        $this->employeesRelatedByReportingToScheduledForDeletion = $employeesRelatedByReportingToToDelete;

        foreach ($employeesRelatedByReportingToToDelete as $employeeRelatedByReportingToRemoved) {
            $employeeRelatedByReportingToRemoved->setPositionsRelatedByReportingTo(null);
        }

        $this->collEmployeesRelatedByReportingTo = null;
        foreach ($employeesRelatedByReportingTo as $employeeRelatedByReportingTo) {
            $this->addEmployeeRelatedByReportingTo($employeeRelatedByReportingTo);
        }

        $this->collEmployeesRelatedByReportingTo = $employeesRelatedByReportingTo;
        $this->collEmployeesRelatedByReportingToPartial = false;

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
    public function countEmployeesRelatedByReportingTo(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeesRelatedByReportingToPartial && !$this->isNew();
        if (null === $this->collEmployeesRelatedByReportingTo || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeesRelatedByReportingTo) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeesRelatedByReportingTo());
            }

            $query = ChildEmployeeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositionsRelatedByReportingTo($this)
                ->count($con);
        }

        return count($this->collEmployeesRelatedByReportingTo);
    }

    /**
     * Method called to associate a ChildEmployee object to this object
     * through the ChildEmployee foreign key attribute.
     *
     * @param ChildEmployee $l ChildEmployee
     * @return $this The current object (for fluent API support)
     */
    public function addEmployeeRelatedByReportingTo(ChildEmployee $l)
    {
        if ($this->collEmployeesRelatedByReportingTo === null) {
            $this->initEmployeesRelatedByReportingTo();
            $this->collEmployeesRelatedByReportingToPartial = true;
        }

        if (!$this->collEmployeesRelatedByReportingTo->contains($l)) {
            $this->doAddEmployeeRelatedByReportingTo($l);

            if ($this->employeesRelatedByReportingToScheduledForDeletion and $this->employeesRelatedByReportingToScheduledForDeletion->contains($l)) {
                $this->employeesRelatedByReportingToScheduledForDeletion->remove($this->employeesRelatedByReportingToScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployee $employeeRelatedByReportingTo The ChildEmployee object to add.
     */
    protected function doAddEmployeeRelatedByReportingTo(ChildEmployee $employeeRelatedByReportingTo): void
    {
        $this->collEmployeesRelatedByReportingTo[]= $employeeRelatedByReportingTo;
        $employeeRelatedByReportingTo->setPositionsRelatedByReportingTo($this);
    }

    /**
     * @param ChildEmployee $employeeRelatedByReportingTo The ChildEmployee object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployeeRelatedByReportingTo(ChildEmployee $employeeRelatedByReportingTo)
    {
        if ($this->getEmployeesRelatedByReportingTo()->contains($employeeRelatedByReportingTo)) {
            $pos = $this->collEmployeesRelatedByReportingTo->search($employeeRelatedByReportingTo);
            $this->collEmployeesRelatedByReportingTo->remove($pos);
            if (null === $this->employeesRelatedByReportingToScheduledForDeletion) {
                $this->employeesRelatedByReportingToScheduledForDeletion = clone $this->collEmployeesRelatedByReportingTo;
                $this->employeesRelatedByReportingToScheduledForDeletion->clear();
            }
            $this->employeesRelatedByReportingToScheduledForDeletion[]= $employeeRelatedByReportingTo;
            $employeeRelatedByReportingTo->setPositionsRelatedByReportingTo(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByReportingTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByReportingToJoinBranch(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Branch', $joinBehavior);

        return $this->getEmployeesRelatedByReportingTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByReportingTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByReportingToJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEmployeesRelatedByReportingTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByReportingTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByReportingToJoinDesignations(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Designations', $joinBehavior);

        return $this->getEmployeesRelatedByReportingTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByReportingTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByReportingToJoinGradeMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('GradeMaster', $joinBehavior);

        return $this->getEmployeesRelatedByReportingTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByReportingTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByReportingToJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getEmployeesRelatedByReportingTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeesRelatedByReportingTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesRelatedByReportingToJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getEmployeesRelatedByReportingTo($query, $con);
    }

    /**
     * Clears out the collEmployeePositionHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployeePositionHistories()
     */
    public function clearEmployeePositionHistories()
    {
        $this->collEmployeePositionHistories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployeePositionHistories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployeePositionHistories($v = true): void
    {
        $this->collEmployeePositionHistoriesPartial = $v;
    }

    /**
     * Initializes the collEmployeePositionHistories collection.
     *
     * By default this just sets the collEmployeePositionHistories collection to an empty array (like clearcollEmployeePositionHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeePositionHistories(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployeePositionHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeePositionHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeePositionHistories = new $collectionClassName;
        $this->collEmployeePositionHistories->setModel('\entities\EmployeePositionHistory');
    }

    /**
     * Gets an array of ChildEmployeePositionHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeePositionHistory[] List of ChildEmployeePositionHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployeePositionHistory> List of ChildEmployeePositionHistory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeePositionHistories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeePositionHistoriesPartial && !$this->isNew();
        if (null === $this->collEmployeePositionHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployeePositionHistories) {
                    $this->initEmployeePositionHistories();
                } else {
                    $collectionClassName = EmployeePositionHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collEmployeePositionHistories = new $collectionClassName;
                    $collEmployeePositionHistories->setModel('\entities\EmployeePositionHistory');

                    return $collEmployeePositionHistories;
                }
            } else {
                $collEmployeePositionHistories = ChildEmployeePositionHistoryQuery::create(null, $criteria)
                    ->filterByPositions($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeePositionHistoriesPartial && count($collEmployeePositionHistories)) {
                        $this->initEmployeePositionHistories(false);

                        foreach ($collEmployeePositionHistories as $obj) {
                            if (false == $this->collEmployeePositionHistories->contains($obj)) {
                                $this->collEmployeePositionHistories->append($obj);
                            }
                        }

                        $this->collEmployeePositionHistoriesPartial = true;
                    }

                    return $collEmployeePositionHistories;
                }

                if ($partial && $this->collEmployeePositionHistories) {
                    foreach ($this->collEmployeePositionHistories as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeePositionHistories[] = $obj;
                        }
                    }
                }

                $this->collEmployeePositionHistories = $collEmployeePositionHistories;
                $this->collEmployeePositionHistoriesPartial = false;
            }
        }

        return $this->collEmployeePositionHistories;
    }

    /**
     * Sets a collection of ChildEmployeePositionHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employeePositionHistories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeePositionHistories(Collection $employeePositionHistories, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployeePositionHistory[] $employeePositionHistoriesToDelete */
        $employeePositionHistoriesToDelete = $this->getEmployeePositionHistories(new Criteria(), $con)->diff($employeePositionHistories);


        $this->employeePositionHistoriesScheduledForDeletion = $employeePositionHistoriesToDelete;

        foreach ($employeePositionHistoriesToDelete as $employeePositionHistoryRemoved) {
            $employeePositionHistoryRemoved->setPositions(null);
        }

        $this->collEmployeePositionHistories = null;
        foreach ($employeePositionHistories as $employeePositionHistory) {
            $this->addEmployeePositionHistory($employeePositionHistory);
        }

        $this->collEmployeePositionHistories = $employeePositionHistories;
        $this->collEmployeePositionHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EmployeePositionHistory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EmployeePositionHistory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEmployeePositionHistories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeePositionHistoriesPartial && !$this->isNew();
        if (null === $this->collEmployeePositionHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeePositionHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeePositionHistories());
            }

            $query = ChildEmployeePositionHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositions($this)
                ->count($con);
        }

        return count($this->collEmployeePositionHistories);
    }

    /**
     * Method called to associate a ChildEmployeePositionHistory object to this object
     * through the ChildEmployeePositionHistory foreign key attribute.
     *
     * @param ChildEmployeePositionHistory $l ChildEmployeePositionHistory
     * @return $this The current object (for fluent API support)
     */
    public function addEmployeePositionHistory(ChildEmployeePositionHistory $l)
    {
        if ($this->collEmployeePositionHistories === null) {
            $this->initEmployeePositionHistories();
            $this->collEmployeePositionHistoriesPartial = true;
        }

        if (!$this->collEmployeePositionHistories->contains($l)) {
            $this->doAddEmployeePositionHistory($l);

            if ($this->employeePositionHistoriesScheduledForDeletion and $this->employeePositionHistoriesScheduledForDeletion->contains($l)) {
                $this->employeePositionHistoriesScheduledForDeletion->remove($this->employeePositionHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeePositionHistory $employeePositionHistory The ChildEmployeePositionHistory object to add.
     */
    protected function doAddEmployeePositionHistory(ChildEmployeePositionHistory $employeePositionHistory): void
    {
        $this->collEmployeePositionHistories[]= $employeePositionHistory;
        $employeePositionHistory->setPositions($this);
    }

    /**
     * @param ChildEmployeePositionHistory $employeePositionHistory The ChildEmployeePositionHistory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployeePositionHistory(ChildEmployeePositionHistory $employeePositionHistory)
    {
        if ($this->getEmployeePositionHistories()->contains($employeePositionHistory)) {
            $pos = $this->collEmployeePositionHistories->search($employeePositionHistory);
            $this->collEmployeePositionHistories->remove($pos);
            if (null === $this->employeePositionHistoriesScheduledForDeletion) {
                $this->employeePositionHistoriesScheduledForDeletion = clone $this->collEmployeePositionHistories;
                $this->employeePositionHistoriesScheduledForDeletion->clear();
            }
            $this->employeePositionHistoriesScheduledForDeletion[]= clone $employeePositionHistory;
            $employeePositionHistory->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related EmployeePositionHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeePositionHistory[] List of ChildEmployeePositionHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployeePositionHistory}> List of ChildEmployeePositionHistory objects
     */
    public function getEmployeePositionHistoriesJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeePositionHistoryQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getEmployeePositionHistories($query, $con);
    }

    /**
     * Clears out the collMtps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMtps()
     */
    public function clearMtps()
    {
        $this->collMtps = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMtps collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMtps($v = true): void
    {
        $this->collMtpsPartial = $v;
    }

    /**
     * Initializes the collMtps collection.
     *
     * By default this just sets the collMtps collection to an empty array (like clearcollMtps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMtps(bool $overrideExisting = true): void
    {
        if (null !== $this->collMtps && !$overrideExisting) {
            return;
        }

        $collectionClassName = MtpTableMap::getTableMap()->getCollectionClassName();

        $this->collMtps = new $collectionClassName;
        $this->collMtps->setModel('\entities\Mtp');
    }

    /**
     * Gets an array of ChildMtp objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMtp[] List of ChildMtp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtp> List of ChildMtp objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMtps(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMtpsPartial && !$this->isNew();
        if (null === $this->collMtps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMtps) {
                    $this->initMtps();
                } else {
                    $collectionClassName = MtpTableMap::getTableMap()->getCollectionClassName();

                    $collMtps = new $collectionClassName;
                    $collMtps->setModel('\entities\Mtp');

                    return $collMtps;
                }
            } else {
                $collMtps = ChildMtpQuery::create(null, $criteria)
                    ->filterByPositions($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMtpsPartial && count($collMtps)) {
                        $this->initMtps(false);

                        foreach ($collMtps as $obj) {
                            if (false == $this->collMtps->contains($obj)) {
                                $this->collMtps->append($obj);
                            }
                        }

                        $this->collMtpsPartial = true;
                    }

                    return $collMtps;
                }

                if ($partial && $this->collMtps) {
                    foreach ($this->collMtps as $obj) {
                        if ($obj->isNew()) {
                            $collMtps[] = $obj;
                        }
                    }
                }

                $this->collMtps = $collMtps;
                $this->collMtpsPartial = false;
            }
        }

        return $this->collMtps;
    }

    /**
     * Sets a collection of ChildMtp objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $mtps A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMtps(Collection $mtps, ?ConnectionInterface $con = null)
    {
        /** @var ChildMtp[] $mtpsToDelete */
        $mtpsToDelete = $this->getMtps(new Criteria(), $con)->diff($mtps);


        $this->mtpsScheduledForDeletion = $mtpsToDelete;

        foreach ($mtpsToDelete as $mtpRemoved) {
            $mtpRemoved->setPositions(null);
        }

        $this->collMtps = null;
        foreach ($mtps as $mtp) {
            $this->addMtp($mtp);
        }

        $this->collMtps = $mtps;
        $this->collMtpsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Mtp objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Mtp objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMtps(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMtpsPartial && !$this->isNew();
        if (null === $this->collMtps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMtps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMtps());
            }

            $query = ChildMtpQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositions($this)
                ->count($con);
        }

        return count($this->collMtps);
    }

    /**
     * Method called to associate a ChildMtp object to this object
     * through the ChildMtp foreign key attribute.
     *
     * @param ChildMtp $l ChildMtp
     * @return $this The current object (for fluent API support)
     */
    public function addMtp(ChildMtp $l)
    {
        if ($this->collMtps === null) {
            $this->initMtps();
            $this->collMtpsPartial = true;
        }

        if (!$this->collMtps->contains($l)) {
            $this->doAddMtp($l);

            if ($this->mtpsScheduledForDeletion and $this->mtpsScheduledForDeletion->contains($l)) {
                $this->mtpsScheduledForDeletion->remove($this->mtpsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMtp $mtp The ChildMtp object to add.
     */
    protected function doAddMtp(ChildMtp $mtp): void
    {
        $this->collMtps[]= $mtp;
        $mtp->setPositions($this);
    }

    /**
     * @param ChildMtp $mtp The ChildMtp object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMtp(ChildMtp $mtp)
    {
        if ($this->getMtps()->contains($mtp)) {
            $pos = $this->collMtps->search($mtp);
            $this->collMtps->remove($pos);
            if (null === $this->mtpsScheduledForDeletion) {
                $this->mtpsScheduledForDeletion = clone $this->collMtps;
                $this->mtpsScheduledForDeletion->clear();
            }
            $this->mtpsScheduledForDeletion[]= clone $mtp;
            $mtp->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Mtps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMtp[] List of ChildMtp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtp}> List of ChildMtp objects
     */
    public function getMtpsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMtpQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getMtps($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Mtps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMtp[] List of ChildMtp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtp}> List of ChildMtp objects
     */
    public function getMtpsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMtpQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getMtps($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByApprovedByPositionId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByApprovedByPositionId()
     */
    public function clearOnBoardRequestsRelatedByApprovedByPositionId()
    {
        $this->collOnBoardRequestsRelatedByApprovedByPositionId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByApprovedByPositionId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByApprovedByPositionId($v = true): void
    {
        $this->collOnBoardRequestsRelatedByApprovedByPositionIdPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByApprovedByPositionId collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByApprovedByPositionId collection to an empty array (like clearcollOnBoardRequestsRelatedByApprovedByPositionId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByApprovedByPositionId(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByApprovedByPositionId && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByApprovedByPositionId = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByApprovedByPositionId->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByApprovedByPositionIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByApprovedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByApprovedByPositionId) {
                    $this->initOnBoardRequestsRelatedByApprovedByPositionId();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByApprovedByPositionId = new $collectionClassName;
                    $collOnBoardRequestsRelatedByApprovedByPositionId->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByApprovedByPositionId;
                }
            } else {
                $collOnBoardRequestsRelatedByApprovedByPositionId = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByPositionsRelatedByApprovedByPositionId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByApprovedByPositionIdPartial && count($collOnBoardRequestsRelatedByApprovedByPositionId)) {
                        $this->initOnBoardRequestsRelatedByApprovedByPositionId(false);

                        foreach ($collOnBoardRequestsRelatedByApprovedByPositionId as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByApprovedByPositionId->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByApprovedByPositionId->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByApprovedByPositionIdPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByApprovedByPositionId;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByApprovedByPositionId) {
                    foreach ($this->collOnBoardRequestsRelatedByApprovedByPositionId as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByApprovedByPositionId[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByApprovedByPositionId = $collOnBoardRequestsRelatedByApprovedByPositionId;
                $this->collOnBoardRequestsRelatedByApprovedByPositionIdPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByApprovedByPositionId;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByApprovedByPositionId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByApprovedByPositionId(Collection $onBoardRequestsRelatedByApprovedByPositionId, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByApprovedByPositionIdToDelete */
        $onBoardRequestsRelatedByApprovedByPositionIdToDelete = $this->getOnBoardRequestsRelatedByApprovedByPositionId(new Criteria(), $con)->diff($onBoardRequestsRelatedByApprovedByPositionId);


        $this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion = $onBoardRequestsRelatedByApprovedByPositionIdToDelete;

        foreach ($onBoardRequestsRelatedByApprovedByPositionIdToDelete as $onBoardRequestRelatedByApprovedByPositionIdRemoved) {
            $onBoardRequestRelatedByApprovedByPositionIdRemoved->setPositionsRelatedByApprovedByPositionId(null);
        }

        $this->collOnBoardRequestsRelatedByApprovedByPositionId = null;
        foreach ($onBoardRequestsRelatedByApprovedByPositionId as $onBoardRequestRelatedByApprovedByPositionId) {
            $this->addOnBoardRequestRelatedByApprovedByPositionId($onBoardRequestRelatedByApprovedByPositionId);
        }

        $this->collOnBoardRequestsRelatedByApprovedByPositionId = $onBoardRequestsRelatedByApprovedByPositionId;
        $this->collOnBoardRequestsRelatedByApprovedByPositionIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByApprovedByPositionId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByApprovedByPositionIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByApprovedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByApprovedByPositionId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByApprovedByPositionId());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositionsRelatedByApprovedByPositionId($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByApprovedByPositionId);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByApprovedByPositionId(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByApprovedByPositionId === null) {
            $this->initOnBoardRequestsRelatedByApprovedByPositionId();
            $this->collOnBoardRequestsRelatedByApprovedByPositionIdPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByApprovedByPositionId->contains($l)) {
            $this->doAddOnBoardRequestRelatedByApprovedByPositionId($l);

            if ($this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion and $this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion->remove($this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByApprovedByPositionId The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByApprovedByPositionId(ChildOnBoardRequest $onBoardRequestRelatedByApprovedByPositionId): void
    {
        $this->collOnBoardRequestsRelatedByApprovedByPositionId[]= $onBoardRequestRelatedByApprovedByPositionId;
        $onBoardRequestRelatedByApprovedByPositionId->setPositionsRelatedByApprovedByPositionId($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByApprovedByPositionId The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByApprovedByPositionId(ChildOnBoardRequest $onBoardRequestRelatedByApprovedByPositionId)
    {
        if ($this->getOnBoardRequestsRelatedByApprovedByPositionId()->contains($onBoardRequestRelatedByApprovedByPositionId)) {
            $pos = $this->collOnBoardRequestsRelatedByApprovedByPositionId->search($onBoardRequestRelatedByApprovedByPositionId);
            $this->collOnBoardRequestsRelatedByApprovedByPositionId->remove($pos);
            if (null === $this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion) {
                $this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByApprovedByPositionId;
                $this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByApprovedByPositionIdScheduledForDeletion[]= $onBoardRequestRelatedByApprovedByPositionId;
            $onBoardRequestRelatedByApprovedByPositionId->setPositionsRelatedByApprovedByPositionId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionIdJoinEmployeeRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionIdJoinEmployeeRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByCreatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionIdJoinEmployeeRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByFinalApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionIdJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionIdJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByPositionIdJoinEmployeeRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByUpdatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByPositionId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByCreatedByPositionId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByCreatedByPositionId()
     */
    public function clearOnBoardRequestsRelatedByCreatedByPositionId()
    {
        $this->collOnBoardRequestsRelatedByCreatedByPositionId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByCreatedByPositionId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByCreatedByPositionId($v = true): void
    {
        $this->collOnBoardRequestsRelatedByCreatedByPositionIdPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByCreatedByPositionId collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByCreatedByPositionId collection to an empty array (like clearcollOnBoardRequestsRelatedByCreatedByPositionId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByCreatedByPositionId(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByCreatedByPositionId && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByCreatedByPositionId = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByCreatedByPositionId->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByCreatedByPositionIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByCreatedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByCreatedByPositionId) {
                    $this->initOnBoardRequestsRelatedByCreatedByPositionId();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByCreatedByPositionId = new $collectionClassName;
                    $collOnBoardRequestsRelatedByCreatedByPositionId->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByCreatedByPositionId;
                }
            } else {
                $collOnBoardRequestsRelatedByCreatedByPositionId = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByPositionsRelatedByCreatedByPositionId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByCreatedByPositionIdPartial && count($collOnBoardRequestsRelatedByCreatedByPositionId)) {
                        $this->initOnBoardRequestsRelatedByCreatedByPositionId(false);

                        foreach ($collOnBoardRequestsRelatedByCreatedByPositionId as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByCreatedByPositionId->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByCreatedByPositionId->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByCreatedByPositionIdPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByCreatedByPositionId;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByCreatedByPositionId) {
                    foreach ($this->collOnBoardRequestsRelatedByCreatedByPositionId as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByCreatedByPositionId[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByCreatedByPositionId = $collOnBoardRequestsRelatedByCreatedByPositionId;
                $this->collOnBoardRequestsRelatedByCreatedByPositionIdPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByCreatedByPositionId;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByCreatedByPositionId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByCreatedByPositionId(Collection $onBoardRequestsRelatedByCreatedByPositionId, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByCreatedByPositionIdToDelete */
        $onBoardRequestsRelatedByCreatedByPositionIdToDelete = $this->getOnBoardRequestsRelatedByCreatedByPositionId(new Criteria(), $con)->diff($onBoardRequestsRelatedByCreatedByPositionId);


        $this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion = $onBoardRequestsRelatedByCreatedByPositionIdToDelete;

        foreach ($onBoardRequestsRelatedByCreatedByPositionIdToDelete as $onBoardRequestRelatedByCreatedByPositionIdRemoved) {
            $onBoardRequestRelatedByCreatedByPositionIdRemoved->setPositionsRelatedByCreatedByPositionId(null);
        }

        $this->collOnBoardRequestsRelatedByCreatedByPositionId = null;
        foreach ($onBoardRequestsRelatedByCreatedByPositionId as $onBoardRequestRelatedByCreatedByPositionId) {
            $this->addOnBoardRequestRelatedByCreatedByPositionId($onBoardRequestRelatedByCreatedByPositionId);
        }

        $this->collOnBoardRequestsRelatedByCreatedByPositionId = $onBoardRequestsRelatedByCreatedByPositionId;
        $this->collOnBoardRequestsRelatedByCreatedByPositionIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByCreatedByPositionId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByCreatedByPositionIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByCreatedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByCreatedByPositionId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByCreatedByPositionId());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositionsRelatedByCreatedByPositionId($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByCreatedByPositionId);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByCreatedByPositionId(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByCreatedByPositionId === null) {
            $this->initOnBoardRequestsRelatedByCreatedByPositionId();
            $this->collOnBoardRequestsRelatedByCreatedByPositionIdPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByCreatedByPositionId->contains($l)) {
            $this->doAddOnBoardRequestRelatedByCreatedByPositionId($l);

            if ($this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion and $this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion->remove($this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByCreatedByPositionId The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByCreatedByPositionId(ChildOnBoardRequest $onBoardRequestRelatedByCreatedByPositionId): void
    {
        $this->collOnBoardRequestsRelatedByCreatedByPositionId[]= $onBoardRequestRelatedByCreatedByPositionId;
        $onBoardRequestRelatedByCreatedByPositionId->setPositionsRelatedByCreatedByPositionId($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByCreatedByPositionId The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByCreatedByPositionId(ChildOnBoardRequest $onBoardRequestRelatedByCreatedByPositionId)
    {
        if ($this->getOnBoardRequestsRelatedByCreatedByPositionId()->contains($onBoardRequestRelatedByCreatedByPositionId)) {
            $pos = $this->collOnBoardRequestsRelatedByCreatedByPositionId->search($onBoardRequestRelatedByCreatedByPositionId);
            $this->collOnBoardRequestsRelatedByCreatedByPositionId->remove($pos);
            if (null === $this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion) {
                $this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByCreatedByPositionId;
                $this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByCreatedByPositionIdScheduledForDeletion[]= $onBoardRequestRelatedByCreatedByPositionId;
            $onBoardRequestRelatedByCreatedByPositionId->setPositionsRelatedByCreatedByPositionId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionIdJoinEmployeeRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionIdJoinEmployeeRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByCreatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionIdJoinEmployeeRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByFinalApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionIdJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionIdJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByPositionIdJoinEmployeeRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByUpdatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByPositionId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByFinalApprovedByPositionId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByFinalApprovedByPositionId()
     */
    public function clearOnBoardRequestsRelatedByFinalApprovedByPositionId()
    {
        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByFinalApprovedByPositionId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByFinalApprovedByPositionId($v = true): void
    {
        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByFinalApprovedByPositionId collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByFinalApprovedByPositionId collection to an empty array (like clearcollOnBoardRequestsRelatedByFinalApprovedByPositionId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByFinalApprovedByPositionId(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId) {
                    $this->initOnBoardRequestsRelatedByFinalApprovedByPositionId();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByFinalApprovedByPositionId = new $collectionClassName;
                    $collOnBoardRequestsRelatedByFinalApprovedByPositionId->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByFinalApprovedByPositionId;
                }
            } else {
                $collOnBoardRequestsRelatedByFinalApprovedByPositionId = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByPositionsRelatedByFinalApprovedByPositionId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial && count($collOnBoardRequestsRelatedByFinalApprovedByPositionId)) {
                        $this->initOnBoardRequestsRelatedByFinalApprovedByPositionId(false);

                        foreach ($collOnBoardRequestsRelatedByFinalApprovedByPositionId as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByFinalApprovedByPositionId;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId) {
                    foreach ($this->collOnBoardRequestsRelatedByFinalApprovedByPositionId as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByFinalApprovedByPositionId[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId = $collOnBoardRequestsRelatedByFinalApprovedByPositionId;
                $this->collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByFinalApprovedByPositionId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByFinalApprovedByPositionId(Collection $onBoardRequestsRelatedByFinalApprovedByPositionId, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByFinalApprovedByPositionIdToDelete */
        $onBoardRequestsRelatedByFinalApprovedByPositionIdToDelete = $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId(new Criteria(), $con)->diff($onBoardRequestsRelatedByFinalApprovedByPositionId);


        $this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion = $onBoardRequestsRelatedByFinalApprovedByPositionIdToDelete;

        foreach ($onBoardRequestsRelatedByFinalApprovedByPositionIdToDelete as $onBoardRequestRelatedByFinalApprovedByPositionIdRemoved) {
            $onBoardRequestRelatedByFinalApprovedByPositionIdRemoved->setPositionsRelatedByFinalApprovedByPositionId(null);
        }

        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId = null;
        foreach ($onBoardRequestsRelatedByFinalApprovedByPositionId as $onBoardRequestRelatedByFinalApprovedByPositionId) {
            $this->addOnBoardRequestRelatedByFinalApprovedByPositionId($onBoardRequestRelatedByFinalApprovedByPositionId);
        }

        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId = $onBoardRequestsRelatedByFinalApprovedByPositionId;
        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByFinalApprovedByPositionId());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositionsRelatedByFinalApprovedByPositionId($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByFinalApprovedByPositionId);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByFinalApprovedByPositionId(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByFinalApprovedByPositionId === null) {
            $this->initOnBoardRequestsRelatedByFinalApprovedByPositionId();
            $this->collOnBoardRequestsRelatedByFinalApprovedByPositionIdPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByFinalApprovedByPositionId->contains($l)) {
            $this->doAddOnBoardRequestRelatedByFinalApprovedByPositionId($l);

            if ($this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion and $this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion->remove($this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByFinalApprovedByPositionId The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByFinalApprovedByPositionId(ChildOnBoardRequest $onBoardRequestRelatedByFinalApprovedByPositionId): void
    {
        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId[]= $onBoardRequestRelatedByFinalApprovedByPositionId;
        $onBoardRequestRelatedByFinalApprovedByPositionId->setPositionsRelatedByFinalApprovedByPositionId($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByFinalApprovedByPositionId The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByFinalApprovedByPositionId(ChildOnBoardRequest $onBoardRequestRelatedByFinalApprovedByPositionId)
    {
        if ($this->getOnBoardRequestsRelatedByFinalApprovedByPositionId()->contains($onBoardRequestRelatedByFinalApprovedByPositionId)) {
            $pos = $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId->search($onBoardRequestRelatedByFinalApprovedByPositionId);
            $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId->remove($pos);
            if (null === $this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion) {
                $this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId;
                $this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByFinalApprovedByPositionIdScheduledForDeletion[]= $onBoardRequestRelatedByFinalApprovedByPositionId;
            $onBoardRequestRelatedByFinalApprovedByPositionId->setPositionsRelatedByFinalApprovedByPositionId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionIdJoinEmployeeRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionIdJoinEmployeeRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByCreatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionIdJoinEmployeeRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByFinalApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionIdJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionIdJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByPositionIdJoinEmployeeRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByUpdatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByPositionId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByPosition collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByPosition()
     */
    public function clearOnBoardRequestsRelatedByPosition()
    {
        $this->collOnBoardRequestsRelatedByPosition = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByPosition collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByPosition($v = true): void
    {
        $this->collOnBoardRequestsRelatedByPositionPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByPosition collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByPosition collection to an empty array (like clearcollOnBoardRequestsRelatedByPosition());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByPosition(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByPosition && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByPosition = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByPosition->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByPositionPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByPosition || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByPosition) {
                    $this->initOnBoardRequestsRelatedByPosition();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByPosition = new $collectionClassName;
                    $collOnBoardRequestsRelatedByPosition->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByPosition;
                }
            } else {
                $collOnBoardRequestsRelatedByPosition = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByPositionsRelatedByPosition($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByPositionPartial && count($collOnBoardRequestsRelatedByPosition)) {
                        $this->initOnBoardRequestsRelatedByPosition(false);

                        foreach ($collOnBoardRequestsRelatedByPosition as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByPosition->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByPosition->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByPositionPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByPosition;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByPosition) {
                    foreach ($this->collOnBoardRequestsRelatedByPosition as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByPosition[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByPosition = $collOnBoardRequestsRelatedByPosition;
                $this->collOnBoardRequestsRelatedByPositionPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByPosition;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByPosition A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByPosition(Collection $onBoardRequestsRelatedByPosition, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByPositionToDelete */
        $onBoardRequestsRelatedByPositionToDelete = $this->getOnBoardRequestsRelatedByPosition(new Criteria(), $con)->diff($onBoardRequestsRelatedByPosition);


        $this->onBoardRequestsRelatedByPositionScheduledForDeletion = $onBoardRequestsRelatedByPositionToDelete;

        foreach ($onBoardRequestsRelatedByPositionToDelete as $onBoardRequestRelatedByPositionRemoved) {
            $onBoardRequestRelatedByPositionRemoved->setPositionsRelatedByPosition(null);
        }

        $this->collOnBoardRequestsRelatedByPosition = null;
        foreach ($onBoardRequestsRelatedByPosition as $onBoardRequestRelatedByPosition) {
            $this->addOnBoardRequestRelatedByPosition($onBoardRequestRelatedByPosition);
        }

        $this->collOnBoardRequestsRelatedByPosition = $onBoardRequestsRelatedByPosition;
        $this->collOnBoardRequestsRelatedByPositionPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByPosition(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByPositionPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByPosition || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByPosition) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByPosition());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositionsRelatedByPosition($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByPosition);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByPosition(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByPosition === null) {
            $this->initOnBoardRequestsRelatedByPosition();
            $this->collOnBoardRequestsRelatedByPositionPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByPosition->contains($l)) {
            $this->doAddOnBoardRequestRelatedByPosition($l);

            if ($this->onBoardRequestsRelatedByPositionScheduledForDeletion and $this->onBoardRequestsRelatedByPositionScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByPositionScheduledForDeletion->remove($this->onBoardRequestsRelatedByPositionScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByPosition The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByPosition(ChildOnBoardRequest $onBoardRequestRelatedByPosition): void
    {
        $this->collOnBoardRequestsRelatedByPosition[]= $onBoardRequestRelatedByPosition;
        $onBoardRequestRelatedByPosition->setPositionsRelatedByPosition($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByPosition The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByPosition(ChildOnBoardRequest $onBoardRequestRelatedByPosition)
    {
        if ($this->getOnBoardRequestsRelatedByPosition()->contains($onBoardRequestRelatedByPosition)) {
            $pos = $this->collOnBoardRequestsRelatedByPosition->search($onBoardRequestRelatedByPosition);
            $this->collOnBoardRequestsRelatedByPosition->remove($pos);
            if (null === $this->onBoardRequestsRelatedByPositionScheduledForDeletion) {
                $this->onBoardRequestsRelatedByPositionScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByPosition;
                $this->onBoardRequestsRelatedByPositionScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByPositionScheduledForDeletion[]= $onBoardRequestRelatedByPosition;
            $onBoardRequestRelatedByPosition->setPositionsRelatedByPosition(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByPosition from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByPositionJoinEmployeeRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByPosition($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByPosition from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByPositionJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByPosition($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByPosition from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByPositionJoinEmployeeRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByCreatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByPosition($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByPosition from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByPositionJoinEmployeeRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByFinalApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByPosition($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByPosition from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByPositionJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByPosition($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByPosition from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByPositionJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByPosition($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByPosition from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByPositionJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByPosition($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByPosition from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByPositionJoinEmployeeRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByUpdatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByPosition($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByUpdatedByPositionId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByUpdatedByPositionId()
     */
    public function clearOnBoardRequestsRelatedByUpdatedByPositionId()
    {
        $this->collOnBoardRequestsRelatedByUpdatedByPositionId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByUpdatedByPositionId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByUpdatedByPositionId($v = true): void
    {
        $this->collOnBoardRequestsRelatedByUpdatedByPositionIdPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByUpdatedByPositionId collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByUpdatedByPositionId collection to an empty array (like clearcollOnBoardRequestsRelatedByUpdatedByPositionId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByUpdatedByPositionId(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByUpdatedByPositionId && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByUpdatedByPositionId = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByUpdatedByPositionId->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByUpdatedByPositionIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByUpdatedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByUpdatedByPositionId) {
                    $this->initOnBoardRequestsRelatedByUpdatedByPositionId();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByUpdatedByPositionId = new $collectionClassName;
                    $collOnBoardRequestsRelatedByUpdatedByPositionId->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByUpdatedByPositionId;
                }
            } else {
                $collOnBoardRequestsRelatedByUpdatedByPositionId = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByPositionsRelatedByUpdatedByPositionId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByUpdatedByPositionIdPartial && count($collOnBoardRequestsRelatedByUpdatedByPositionId)) {
                        $this->initOnBoardRequestsRelatedByUpdatedByPositionId(false);

                        foreach ($collOnBoardRequestsRelatedByUpdatedByPositionId as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByUpdatedByPositionId->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByUpdatedByPositionId->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByUpdatedByPositionIdPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByUpdatedByPositionId;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByUpdatedByPositionId) {
                    foreach ($this->collOnBoardRequestsRelatedByUpdatedByPositionId as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByUpdatedByPositionId[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByUpdatedByPositionId = $collOnBoardRequestsRelatedByUpdatedByPositionId;
                $this->collOnBoardRequestsRelatedByUpdatedByPositionIdPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByUpdatedByPositionId;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByUpdatedByPositionId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByUpdatedByPositionId(Collection $onBoardRequestsRelatedByUpdatedByPositionId, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByUpdatedByPositionIdToDelete */
        $onBoardRequestsRelatedByUpdatedByPositionIdToDelete = $this->getOnBoardRequestsRelatedByUpdatedByPositionId(new Criteria(), $con)->diff($onBoardRequestsRelatedByUpdatedByPositionId);


        $this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion = $onBoardRequestsRelatedByUpdatedByPositionIdToDelete;

        foreach ($onBoardRequestsRelatedByUpdatedByPositionIdToDelete as $onBoardRequestRelatedByUpdatedByPositionIdRemoved) {
            $onBoardRequestRelatedByUpdatedByPositionIdRemoved->setPositionsRelatedByUpdatedByPositionId(null);
        }

        $this->collOnBoardRequestsRelatedByUpdatedByPositionId = null;
        foreach ($onBoardRequestsRelatedByUpdatedByPositionId as $onBoardRequestRelatedByUpdatedByPositionId) {
            $this->addOnBoardRequestRelatedByUpdatedByPositionId($onBoardRequestRelatedByUpdatedByPositionId);
        }

        $this->collOnBoardRequestsRelatedByUpdatedByPositionId = $onBoardRequestsRelatedByUpdatedByPositionId;
        $this->collOnBoardRequestsRelatedByUpdatedByPositionIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByUpdatedByPositionId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByUpdatedByPositionIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByUpdatedByPositionId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByUpdatedByPositionId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByUpdatedByPositionId());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositionsRelatedByUpdatedByPositionId($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByUpdatedByPositionId);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByUpdatedByPositionId(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByUpdatedByPositionId === null) {
            $this->initOnBoardRequestsRelatedByUpdatedByPositionId();
            $this->collOnBoardRequestsRelatedByUpdatedByPositionIdPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByUpdatedByPositionId->contains($l)) {
            $this->doAddOnBoardRequestRelatedByUpdatedByPositionId($l);

            if ($this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion and $this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion->remove($this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByUpdatedByPositionId The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByUpdatedByPositionId(ChildOnBoardRequest $onBoardRequestRelatedByUpdatedByPositionId): void
    {
        $this->collOnBoardRequestsRelatedByUpdatedByPositionId[]= $onBoardRequestRelatedByUpdatedByPositionId;
        $onBoardRequestRelatedByUpdatedByPositionId->setPositionsRelatedByUpdatedByPositionId($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByUpdatedByPositionId The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByUpdatedByPositionId(ChildOnBoardRequest $onBoardRequestRelatedByUpdatedByPositionId)
    {
        if ($this->getOnBoardRequestsRelatedByUpdatedByPositionId()->contains($onBoardRequestRelatedByUpdatedByPositionId)) {
            $pos = $this->collOnBoardRequestsRelatedByUpdatedByPositionId->search($onBoardRequestRelatedByUpdatedByPositionId);
            $this->collOnBoardRequestsRelatedByUpdatedByPositionId->remove($pos);
            if (null === $this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion) {
                $this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByUpdatedByPositionId;
                $this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByUpdatedByPositionIdScheduledForDeletion[]= $onBoardRequestRelatedByUpdatedByPositionId;
            $onBoardRequestRelatedByUpdatedByPositionId->setPositionsRelatedByUpdatedByPositionId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionIdJoinEmployeeRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionIdJoinEmployeeRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByCreatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionIdJoinEmployeeRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByFinalApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionIdJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionIdJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByPositionId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByPositionId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByPositionIdJoinEmployeeRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByUpdatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByPositionId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestLogs()
     */
    public function clearOnBoardRequestLogs()
    {
        $this->collOnBoardRequestLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestLogs($v = true): void
    {
        $this->collOnBoardRequestLogsPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestLogs collection.
     *
     * By default this just sets the collOnBoardRequestLogs collection to an empty array (like clearcollOnBoardRequestLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestLogTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestLogs = new $collectionClassName;
        $this->collOnBoardRequestLogs->setModel('\entities\OnBoardRequestLog');
    }

    /**
     * Gets an array of ChildOnBoardRequestLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequestLog[] List of ChildOnBoardRequestLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestLog> List of ChildOnBoardRequestLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestLogsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestLogs) {
                    $this->initOnBoardRequestLogs();
                } else {
                    $collectionClassName = OnBoardRequestLogTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestLogs = new $collectionClassName;
                    $collOnBoardRequestLogs->setModel('\entities\OnBoardRequestLog');

                    return $collOnBoardRequestLogs;
                }
            } else {
                $collOnBoardRequestLogs = ChildOnBoardRequestLogQuery::create(null, $criteria)
                    ->filterByPositions($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestLogsPartial && count($collOnBoardRequestLogs)) {
                        $this->initOnBoardRequestLogs(false);

                        foreach ($collOnBoardRequestLogs as $obj) {
                            if (false == $this->collOnBoardRequestLogs->contains($obj)) {
                                $this->collOnBoardRequestLogs->append($obj);
                            }
                        }

                        $this->collOnBoardRequestLogsPartial = true;
                    }

                    return $collOnBoardRequestLogs;
                }

                if ($partial && $this->collOnBoardRequestLogs) {
                    foreach ($this->collOnBoardRequestLogs as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestLogs[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestLogs = $collOnBoardRequestLogs;
                $this->collOnBoardRequestLogsPartial = false;
            }
        }

        return $this->collOnBoardRequestLogs;
    }

    /**
     * Sets a collection of ChildOnBoardRequestLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestLogs(Collection $onBoardRequestLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequestLog[] $onBoardRequestLogsToDelete */
        $onBoardRequestLogsToDelete = $this->getOnBoardRequestLogs(new Criteria(), $con)->diff($onBoardRequestLogs);


        $this->onBoardRequestLogsScheduledForDeletion = $onBoardRequestLogsToDelete;

        foreach ($onBoardRequestLogsToDelete as $onBoardRequestLogRemoved) {
            $onBoardRequestLogRemoved->setPositions(null);
        }

        $this->collOnBoardRequestLogs = null;
        foreach ($onBoardRequestLogs as $onBoardRequestLog) {
            $this->addOnBoardRequestLog($onBoardRequestLog);
        }

        $this->collOnBoardRequestLogs = $onBoardRequestLogs;
        $this->collOnBoardRequestLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequestLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequestLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestLogsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestLogs());
            }

            $query = ChildOnBoardRequestLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositions($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestLogs);
    }

    /**
     * Method called to associate a ChildOnBoardRequestLog object to this object
     * through the ChildOnBoardRequestLog foreign key attribute.
     *
     * @param ChildOnBoardRequestLog $l ChildOnBoardRequestLog
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestLog(ChildOnBoardRequestLog $l)
    {
        if ($this->collOnBoardRequestLogs === null) {
            $this->initOnBoardRequestLogs();
            $this->collOnBoardRequestLogsPartial = true;
        }

        if (!$this->collOnBoardRequestLogs->contains($l)) {
            $this->doAddOnBoardRequestLog($l);

            if ($this->onBoardRequestLogsScheduledForDeletion and $this->onBoardRequestLogsScheduledForDeletion->contains($l)) {
                $this->onBoardRequestLogsScheduledForDeletion->remove($this->onBoardRequestLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequestLog $onBoardRequestLog The ChildOnBoardRequestLog object to add.
     */
    protected function doAddOnBoardRequestLog(ChildOnBoardRequestLog $onBoardRequestLog): void
    {
        $this->collOnBoardRequestLogs[]= $onBoardRequestLog;
        $onBoardRequestLog->setPositions($this);
    }

    /**
     * @param ChildOnBoardRequestLog $onBoardRequestLog The ChildOnBoardRequestLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestLog(ChildOnBoardRequestLog $onBoardRequestLog)
    {
        if ($this->getOnBoardRequestLogs()->contains($onBoardRequestLog)) {
            $pos = $this->collOnBoardRequestLogs->search($onBoardRequestLog);
            $this->collOnBoardRequestLogs->remove($pos);
            if (null === $this->onBoardRequestLogsScheduledForDeletion) {
                $this->onBoardRequestLogsScheduledForDeletion = clone $this->collOnBoardRequestLogs;
                $this->onBoardRequestLogsScheduledForDeletion->clear();
            }
            $this->onBoardRequestLogsScheduledForDeletion[]= $onBoardRequestLog;
            $onBoardRequestLog->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestLog[] List of ChildOnBoardRequestLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestLog}> List of ChildOnBoardRequestLog objects
     */
    public function getOnBoardRequestLogsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestLogQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getOnBoardRequestLogs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related OnBoardRequestLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestLog[] List of ChildOnBoardRequestLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestLog}> List of ChildOnBoardRequestLog objects
     */
    public function getOnBoardRequestLogsJoinOnBoardRequest(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestLogQuery::create(null, $criteria);
        $query->joinWith('OnBoardRequest', $joinBehavior);

        return $this->getOnBoardRequestLogs($query, $con);
    }

    /**
     * Clears out the collPrescriberDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPrescriberDatas()
     */
    public function clearPrescriberDatas()
    {
        $this->collPrescriberDatas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPrescriberDatas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPrescriberDatas($v = true): void
    {
        $this->collPrescriberDatasPartial = $v;
    }

    /**
     * Initializes the collPrescriberDatas collection.
     *
     * By default this just sets the collPrescriberDatas collection to an empty array (like clearcollPrescriberDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrescriberDatas(bool $overrideExisting = true): void
    {
        if (null !== $this->collPrescriberDatas && !$overrideExisting) {
            return;
        }

        $collectionClassName = PrescriberDataTableMap::getTableMap()->getCollectionClassName();

        $this->collPrescriberDatas = new $collectionClassName;
        $this->collPrescriberDatas->setModel('\entities\PrescriberData');
    }

    /**
     * Gets an array of ChildPrescriberData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData> List of ChildPrescriberData objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPrescriberDatas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPrescriberDatasPartial && !$this->isNew();
        if (null === $this->collPrescriberDatas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrescriberDatas) {
                    $this->initPrescriberDatas();
                } else {
                    $collectionClassName = PrescriberDataTableMap::getTableMap()->getCollectionClassName();

                    $collPrescriberDatas = new $collectionClassName;
                    $collPrescriberDatas->setModel('\entities\PrescriberData');

                    return $collPrescriberDatas;
                }
            } else {
                $collPrescriberDatas = ChildPrescriberDataQuery::create(null, $criteria)
                    ->filterByPositions($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrescriberDatasPartial && count($collPrescriberDatas)) {
                        $this->initPrescriberDatas(false);

                        foreach ($collPrescriberDatas as $obj) {
                            if (false == $this->collPrescriberDatas->contains($obj)) {
                                $this->collPrescriberDatas->append($obj);
                            }
                        }

                        $this->collPrescriberDatasPartial = true;
                    }

                    return $collPrescriberDatas;
                }

                if ($partial && $this->collPrescriberDatas) {
                    foreach ($this->collPrescriberDatas as $obj) {
                        if ($obj->isNew()) {
                            $collPrescriberDatas[] = $obj;
                        }
                    }
                }

                $this->collPrescriberDatas = $collPrescriberDatas;
                $this->collPrescriberDatasPartial = false;
            }
        }

        return $this->collPrescriberDatas;
    }

    /**
     * Sets a collection of ChildPrescriberData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $prescriberDatas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPrescriberDatas(Collection $prescriberDatas, ?ConnectionInterface $con = null)
    {
        /** @var ChildPrescriberData[] $prescriberDatasToDelete */
        $prescriberDatasToDelete = $this->getPrescriberDatas(new Criteria(), $con)->diff($prescriberDatas);


        $this->prescriberDatasScheduledForDeletion = $prescriberDatasToDelete;

        foreach ($prescriberDatasToDelete as $prescriberDataRemoved) {
            $prescriberDataRemoved->setPositions(null);
        }

        $this->collPrescriberDatas = null;
        foreach ($prescriberDatas as $prescriberData) {
            $this->addPrescriberData($prescriberData);
        }

        $this->collPrescriberDatas = $prescriberDatas;
        $this->collPrescriberDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PrescriberData objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related PrescriberData objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPrescriberDatas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPrescriberDatasPartial && !$this->isNew();
        if (null === $this->collPrescriberDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrescriberDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrescriberDatas());
            }

            $query = ChildPrescriberDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositions($this)
                ->count($con);
        }

        return count($this->collPrescriberDatas);
    }

    /**
     * Method called to associate a ChildPrescriberData object to this object
     * through the ChildPrescriberData foreign key attribute.
     *
     * @param ChildPrescriberData $l ChildPrescriberData
     * @return $this The current object (for fluent API support)
     */
    public function addPrescriberData(ChildPrescriberData $l)
    {
        if ($this->collPrescriberDatas === null) {
            $this->initPrescriberDatas();
            $this->collPrescriberDatasPartial = true;
        }

        if (!$this->collPrescriberDatas->contains($l)) {
            $this->doAddPrescriberData($l);

            if ($this->prescriberDatasScheduledForDeletion and $this->prescriberDatasScheduledForDeletion->contains($l)) {
                $this->prescriberDatasScheduledForDeletion->remove($this->prescriberDatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPrescriberData $prescriberData The ChildPrescriberData object to add.
     */
    protected function doAddPrescriberData(ChildPrescriberData $prescriberData): void
    {
        $this->collPrescriberDatas[]= $prescriberData;
        $prescriberData->setPositions($this);
    }

    /**
     * @param ChildPrescriberData $prescriberData The ChildPrescriberData object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePrescriberData(ChildPrescriberData $prescriberData)
    {
        if ($this->getPrescriberDatas()->contains($prescriberData)) {
            $pos = $this->collPrescriberDatas->search($prescriberData);
            $this->collPrescriberDatas->remove($pos);
            if (null === $this->prescriberDatasScheduledForDeletion) {
                $this->prescriberDatasScheduledForDeletion = clone $this->collPrescriberDatas;
                $this->prescriberDatasScheduledForDeletion->clear();
            }
            $this->prescriberDatasScheduledForDeletion[]= clone $prescriberData;
            $prescriberData->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }

    /**
     * Clears out the collPrescriberTallySummaries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPrescriberTallySummaries()
     */
    public function clearPrescriberTallySummaries()
    {
        $this->collPrescriberTallySummaries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPrescriberTallySummaries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPrescriberTallySummaries($v = true): void
    {
        $this->collPrescriberTallySummariesPartial = $v;
    }

    /**
     * Initializes the collPrescriberTallySummaries collection.
     *
     * By default this just sets the collPrescriberTallySummaries collection to an empty array (like clearcollPrescriberTallySummaries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrescriberTallySummaries(bool $overrideExisting = true): void
    {
        if (null !== $this->collPrescriberTallySummaries && !$overrideExisting) {
            return;
        }

        $collectionClassName = PrescriberTallySummaryTableMap::getTableMap()->getCollectionClassName();

        $this->collPrescriberTallySummaries = new $collectionClassName;
        $this->collPrescriberTallySummaries->setModel('\entities\PrescriberTallySummary');
    }

    /**
     * Gets an array of ChildPrescriberTallySummary objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary> List of ChildPrescriberTallySummary objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPrescriberTallySummaries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPrescriberTallySummariesPartial && !$this->isNew();
        if (null === $this->collPrescriberTallySummaries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrescriberTallySummaries) {
                    $this->initPrescriberTallySummaries();
                } else {
                    $collectionClassName = PrescriberTallySummaryTableMap::getTableMap()->getCollectionClassName();

                    $collPrescriberTallySummaries = new $collectionClassName;
                    $collPrescriberTallySummaries->setModel('\entities\PrescriberTallySummary');

                    return $collPrescriberTallySummaries;
                }
            } else {
                $collPrescriberTallySummaries = ChildPrescriberTallySummaryQuery::create(null, $criteria)
                    ->filterByPositions($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrescriberTallySummariesPartial && count($collPrescriberTallySummaries)) {
                        $this->initPrescriberTallySummaries(false);

                        foreach ($collPrescriberTallySummaries as $obj) {
                            if (false == $this->collPrescriberTallySummaries->contains($obj)) {
                                $this->collPrescriberTallySummaries->append($obj);
                            }
                        }

                        $this->collPrescriberTallySummariesPartial = true;
                    }

                    return $collPrescriberTallySummaries;
                }

                if ($partial && $this->collPrescriberTallySummaries) {
                    foreach ($this->collPrescriberTallySummaries as $obj) {
                        if ($obj->isNew()) {
                            $collPrescriberTallySummaries[] = $obj;
                        }
                    }
                }

                $this->collPrescriberTallySummaries = $collPrescriberTallySummaries;
                $this->collPrescriberTallySummariesPartial = false;
            }
        }

        return $this->collPrescriberTallySummaries;
    }

    /**
     * Sets a collection of ChildPrescriberTallySummary objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $prescriberTallySummaries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPrescriberTallySummaries(Collection $prescriberTallySummaries, ?ConnectionInterface $con = null)
    {
        /** @var ChildPrescriberTallySummary[] $prescriberTallySummariesToDelete */
        $prescriberTallySummariesToDelete = $this->getPrescriberTallySummaries(new Criteria(), $con)->diff($prescriberTallySummaries);


        $this->prescriberTallySummariesScheduledForDeletion = $prescriberTallySummariesToDelete;

        foreach ($prescriberTallySummariesToDelete as $prescriberTallySummaryRemoved) {
            $prescriberTallySummaryRemoved->setPositions(null);
        }

        $this->collPrescriberTallySummaries = null;
        foreach ($prescriberTallySummaries as $prescriberTallySummary) {
            $this->addPrescriberTallySummary($prescriberTallySummary);
        }

        $this->collPrescriberTallySummaries = $prescriberTallySummaries;
        $this->collPrescriberTallySummariesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PrescriberTallySummary objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related PrescriberTallySummary objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPrescriberTallySummaries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPrescriberTallySummariesPartial && !$this->isNew();
        if (null === $this->collPrescriberTallySummaries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrescriberTallySummaries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrescriberTallySummaries());
            }

            $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositions($this)
                ->count($con);
        }

        return count($this->collPrescriberTallySummaries);
    }

    /**
     * Method called to associate a ChildPrescriberTallySummary object to this object
     * through the ChildPrescriberTallySummary foreign key attribute.
     *
     * @param ChildPrescriberTallySummary $l ChildPrescriberTallySummary
     * @return $this The current object (for fluent API support)
     */
    public function addPrescriberTallySummary(ChildPrescriberTallySummary $l)
    {
        if ($this->collPrescriberTallySummaries === null) {
            $this->initPrescriberTallySummaries();
            $this->collPrescriberTallySummariesPartial = true;
        }

        if (!$this->collPrescriberTallySummaries->contains($l)) {
            $this->doAddPrescriberTallySummary($l);

            if ($this->prescriberTallySummariesScheduledForDeletion and $this->prescriberTallySummariesScheduledForDeletion->contains($l)) {
                $this->prescriberTallySummariesScheduledForDeletion->remove($this->prescriberTallySummariesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPrescriberTallySummary $prescriberTallySummary The ChildPrescriberTallySummary object to add.
     */
    protected function doAddPrescriberTallySummary(ChildPrescriberTallySummary $prescriberTallySummary): void
    {
        $this->collPrescriberTallySummaries[]= $prescriberTallySummary;
        $prescriberTallySummary->setPositions($this);
    }

    /**
     * @param ChildPrescriberTallySummary $prescriberTallySummary The ChildPrescriberTallySummary object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePrescriberTallySummary(ChildPrescriberTallySummary $prescriberTallySummary)
    {
        if ($this->getPrescriberTallySummaries()->contains($prescriberTallySummary)) {
            $pos = $this->collPrescriberTallySummaries->search($prescriberTallySummary);
            $this->collPrescriberTallySummaries->remove($pos);
            if (null === $this->prescriberTallySummariesScheduledForDeletion) {
                $this->prescriberTallySummariesScheduledForDeletion = clone $this->collPrescriberTallySummaries;
                $this->prescriberTallySummariesScheduledForDeletion->clear();
            }
            $this->prescriberTallySummariesScheduledForDeletion[]= clone $prescriberTallySummary;
            $prescriberTallySummary->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }

    /**
     * Clears out the collTerritoriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTerritoriess()
     */
    public function clearTerritoriess()
    {
        $this->collTerritoriess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTerritoriess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTerritoriess($v = true): void
    {
        $this->collTerritoriessPartial = $v;
    }

    /**
     * Initializes the collTerritoriess collection.
     *
     * By default this just sets the collTerritoriess collection to an empty array (like clearcollTerritoriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTerritoriess(bool $overrideExisting = true): void
    {
        if (null !== $this->collTerritoriess && !$overrideExisting) {
            return;
        }

        $collectionClassName = TerritoriesTableMap::getTableMap()->getCollectionClassName();

        $this->collTerritoriess = new $collectionClassName;
        $this->collTerritoriess->setModel('\entities\Territories');
    }

    /**
     * Gets an array of ChildTerritories objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTerritories[] List of ChildTerritories objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritories> List of ChildTerritories objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTerritoriess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTerritoriessPartial && !$this->isNew();
        if (null === $this->collTerritoriess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTerritoriess) {
                    $this->initTerritoriess();
                } else {
                    $collectionClassName = TerritoriesTableMap::getTableMap()->getCollectionClassName();

                    $collTerritoriess = new $collectionClassName;
                    $collTerritoriess->setModel('\entities\Territories');

                    return $collTerritoriess;
                }
            } else {
                $collTerritoriess = ChildTerritoriesQuery::create(null, $criteria)
                    ->filterByPositions($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTerritoriessPartial && count($collTerritoriess)) {
                        $this->initTerritoriess(false);

                        foreach ($collTerritoriess as $obj) {
                            if (false == $this->collTerritoriess->contains($obj)) {
                                $this->collTerritoriess->append($obj);
                            }
                        }

                        $this->collTerritoriessPartial = true;
                    }

                    return $collTerritoriess;
                }

                if ($partial && $this->collTerritoriess) {
                    foreach ($this->collTerritoriess as $obj) {
                        if ($obj->isNew()) {
                            $collTerritoriess[] = $obj;
                        }
                    }
                }

                $this->collTerritoriess = $collTerritoriess;
                $this->collTerritoriessPartial = false;
            }
        }

        return $this->collTerritoriess;
    }

    /**
     * Sets a collection of ChildTerritories objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $territoriess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoriess(Collection $territoriess, ?ConnectionInterface $con = null)
    {
        /** @var ChildTerritories[] $territoriessToDelete */
        $territoriessToDelete = $this->getTerritoriess(new Criteria(), $con)->diff($territoriess);


        $this->territoriessScheduledForDeletion = $territoriessToDelete;

        foreach ($territoriessToDelete as $territoriesRemoved) {
            $territoriesRemoved->setPositions(null);
        }

        $this->collTerritoriess = null;
        foreach ($territoriess as $territories) {
            $this->addTerritories($territories);
        }

        $this->collTerritoriess = $territoriess;
        $this->collTerritoriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Territories objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Territories objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTerritoriess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTerritoriessPartial && !$this->isNew();
        if (null === $this->collTerritoriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTerritoriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTerritoriess());
            }

            $query = ChildTerritoriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositions($this)
                ->count($con);
        }

        return count($this->collTerritoriess);
    }

    /**
     * Method called to associate a ChildTerritories object to this object
     * through the ChildTerritories foreign key attribute.
     *
     * @param ChildTerritories $l ChildTerritories
     * @return $this The current object (for fluent API support)
     */
    public function addTerritories(ChildTerritories $l)
    {
        if ($this->collTerritoriess === null) {
            $this->initTerritoriess();
            $this->collTerritoriessPartial = true;
        }

        if (!$this->collTerritoriess->contains($l)) {
            $this->doAddTerritories($l);

            if ($this->territoriessScheduledForDeletion and $this->territoriessScheduledForDeletion->contains($l)) {
                $this->territoriessScheduledForDeletion->remove($this->territoriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTerritories $territories The ChildTerritories object to add.
     */
    protected function doAddTerritories(ChildTerritories $territories): void
    {
        $this->collTerritoriess[]= $territories;
        $territories->setPositions($this);
    }

    /**
     * @param ChildTerritories $territories The ChildTerritories object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTerritories(ChildTerritories $territories)
    {
        if ($this->getTerritoriess()->contains($territories)) {
            $pos = $this->collTerritoriess->search($territories);
            $this->collTerritoriess->remove($pos);
            if (null === $this->territoriessScheduledForDeletion) {
                $this->territoriessScheduledForDeletion = clone $this->collTerritoriess;
                $this->territoriessScheduledForDeletion->clear();
            }
            $this->territoriessScheduledForDeletion[]= $territories;
            $territories->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Territoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTerritories[] List of ChildTerritories objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritories}> List of ChildTerritories objects
     */
    public function getTerritoriessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTerritoriesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTerritoriess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Territoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTerritories[] List of ChildTerritories objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritories}> List of ChildTerritories objects
     */
    public function getTerritoriessJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTerritoriesQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getTerritoriess($query, $con);
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
     * If this ChildPositions is new, it will return
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
                    ->filterByPositions($this)
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
            $tourplansRemoved->setPositions(null);
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
                ->filterByPositions($this)
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
        $tourplans->setPositions($this);
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
            $tourplans->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
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
     * Clears out the collStps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStps()
     */
    public function clearStps()
    {
        $this->collStps = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStps collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStps($v = true): void
    {
        $this->collStpsPartial = $v;
    }

    /**
     * Initializes the collStps collection.
     *
     * By default this just sets the collStps collection to an empty array (like clearcollStps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStps(bool $overrideExisting = true): void
    {
        if (null !== $this->collStps && !$overrideExisting) {
            return;
        }

        $collectionClassName = StpTableMap::getTableMap()->getCollectionClassName();

        $this->collStps = new $collectionClassName;
        $this->collStps->setModel('\entities\Stp');
    }

    /**
     * Gets an array of ChildStp objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPositions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStp[] List of ChildStp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStp> List of ChildStp objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStps(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStpsPartial && !$this->isNew();
        if (null === $this->collStps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStps) {
                    $this->initStps();
                } else {
                    $collectionClassName = StpTableMap::getTableMap()->getCollectionClassName();

                    $collStps = new $collectionClassName;
                    $collStps->setModel('\entities\Stp');

                    return $collStps;
                }
            } else {
                $collStps = ChildStpQuery::create(null, $criteria)
                    ->filterByPositions($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStpsPartial && count($collStps)) {
                        $this->initStps(false);

                        foreach ($collStps as $obj) {
                            if (false == $this->collStps->contains($obj)) {
                                $this->collStps->append($obj);
                            }
                        }

                        $this->collStpsPartial = true;
                    }

                    return $collStps;
                }

                if ($partial && $this->collStps) {
                    foreach ($this->collStps as $obj) {
                        if ($obj->isNew()) {
                            $collStps[] = $obj;
                        }
                    }
                }

                $this->collStps = $collStps;
                $this->collStpsPartial = false;
            }
        }

        return $this->collStps;
    }

    /**
     * Sets a collection of ChildStp objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stps A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStps(Collection $stps, ?ConnectionInterface $con = null)
    {
        /** @var ChildStp[] $stpsToDelete */
        $stpsToDelete = $this->getStps(new Criteria(), $con)->diff($stps);


        $this->stpsScheduledForDeletion = $stpsToDelete;

        foreach ($stpsToDelete as $stpRemoved) {
            $stpRemoved->setPositions(null);
        }

        $this->collStps = null;
        foreach ($stps as $stp) {
            $this->addStp($stp);
        }

        $this->collStps = $stps;
        $this->collStpsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Stp objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Stp objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStps(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStpsPartial && !$this->isNew();
        if (null === $this->collStps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStps());
            }

            $query = ChildStpQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPositions($this)
                ->count($con);
        }

        return count($this->collStps);
    }

    /**
     * Method called to associate a ChildStp object to this object
     * through the ChildStp foreign key attribute.
     *
     * @param ChildStp $l ChildStp
     * @return $this The current object (for fluent API support)
     */
    public function addStp(ChildStp $l)
    {
        if ($this->collStps === null) {
            $this->initStps();
            $this->collStpsPartial = true;
        }

        if (!$this->collStps->contains($l)) {
            $this->doAddStp($l);

            if ($this->stpsScheduledForDeletion and $this->stpsScheduledForDeletion->contains($l)) {
                $this->stpsScheduledForDeletion->remove($this->stpsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStp $stp The ChildStp object to add.
     */
    protected function doAddStp(ChildStp $stp): void
    {
        $this->collStps[]= $stp;
        $stp->setPositions($this);
    }

    /**
     * @param ChildStp $stp The ChildStp object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStp(ChildStp $stp)
    {
        if ($this->getStps()->contains($stp)) {
            $pos = $this->collStps->search($stp);
            $this->collStps->remove($pos);
            if (null === $this->stpsScheduledForDeletion) {
                $this->stpsScheduledForDeletion = clone $this->collStps;
                $this->stpsScheduledForDeletion->clear();
            }
            $this->stpsScheduledForDeletion[]= clone $stp;
            $stp->setPositions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Positions is new, it will return
     * an empty collection; or if this Positions has previously
     * been saved, it will retrieve related Stps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Positions.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStp[] List of ChildStp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStp}> List of ChildStp objects
     */
    public function getStpsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStpQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getStps($query, $con);
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
            $this->aCompany->removePositions($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removePositions($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removePositions($this);
        }
        $this->position_id = null;
        $this->company_id = null;
        $this->position_name = null;
        $this->position_code = null;
        $this->reporting_to = null;
        $this->org_unit_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->cav_positions_up = null;
        $this->cav_positions_down = null;
        $this->cav_territories = null;
        $this->cav_towns = null;
        $this->cav_date = null;
        $this->cav_flag = null;
        $this->itownid = null;
        $this->mtp_type = null;
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
            if ($this->collBrandCampiagnDoctorss) {
                foreach ($this->collBrandCampiagnDoctorss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandCampiagnVisitss) {
                foreach ($this->collBrandCampiagnVisitss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallss) {
                foreach ($this->collDailycallss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeesRelatedByPositionId) {
                foreach ($this->collEmployeesRelatedByPositionId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeesRelatedByReportingTo) {
                foreach ($this->collEmployeesRelatedByReportingTo as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeePositionHistories) {
                foreach ($this->collEmployeePositionHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMtps) {
                foreach ($this->collMtps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByApprovedByPositionId) {
                foreach ($this->collOnBoardRequestsRelatedByApprovedByPositionId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByCreatedByPositionId) {
                foreach ($this->collOnBoardRequestsRelatedByCreatedByPositionId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByFinalApprovedByPositionId) {
                foreach ($this->collOnBoardRequestsRelatedByFinalApprovedByPositionId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByPosition) {
                foreach ($this->collOnBoardRequestsRelatedByPosition as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByUpdatedByPositionId) {
                foreach ($this->collOnBoardRequestsRelatedByUpdatedByPositionId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestLogs) {
                foreach ($this->collOnBoardRequestLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPrescriberDatas) {
                foreach ($this->collPrescriberDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPrescriberTallySummaries) {
                foreach ($this->collPrescriberTallySummaries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTerritoriess) {
                foreach ($this->collTerritoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTourplanss) {
                foreach ($this->collTourplanss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStps) {
                foreach ($this->collStps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagnDoctorss = null;
        $this->collBrandCampiagnVisitss = null;
        $this->collDailycallss = null;
        $this->collEmployeesRelatedByPositionId = null;
        $this->collEmployeesRelatedByReportingTo = null;
        $this->collEmployeePositionHistories = null;
        $this->collMtps = null;
        $this->collOnBoardRequestsRelatedByApprovedByPositionId = null;
        $this->collOnBoardRequestsRelatedByCreatedByPositionId = null;
        $this->collOnBoardRequestsRelatedByFinalApprovedByPositionId = null;
        $this->collOnBoardRequestsRelatedByPosition = null;
        $this->collOnBoardRequestsRelatedByUpdatedByPositionId = null;
        $this->collOnBoardRequestLogs = null;
        $this->collPrescriberDatas = null;
        $this->collPrescriberTallySummaries = null;
        $this->collTerritoriess = null;
        $this->collTourplanss = null;
        $this->collStps = null;
        $this->aCompany = null;
        $this->aOrgUnit = null;
        $this->aGeoTowns = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PositionsTableMap::DEFAULT_STRING_FORMAT);
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
