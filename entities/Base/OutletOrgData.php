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
use entities\BeatOutlets as ChildBeatOutlets;
use entities\BeatOutletsQuery as ChildBeatOutletsQuery;
use entities\BrandCampiagnDoctors as ChildBrandCampiagnDoctors;
use entities\BrandCampiagnDoctorsQuery as ChildBrandCampiagnDoctorsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Dailycalls as ChildDailycalls;
use entities\DailycallsAttendees as ChildDailycallsAttendees;
use entities\DailycallsAttendeesQuery as ChildDailycallsAttendeesQuery;
use entities\DailycallsQuery as ChildDailycallsQuery;
use entities\DailycallsSgpiout as ChildDailycallsSgpiout;
use entities\DailycallsSgpioutQuery as ChildDailycallsSgpioutQuery;
use entities\Dayplan as ChildDayplan;
use entities\DayplanQuery as ChildDayplanQuery;
use entities\EdFeedbacks as ChildEdFeedbacks;
use entities\EdFeedbacksQuery as ChildEdFeedbacksQuery;
use entities\EdSession as ChildEdSession;
use entities\EdSessionQuery as ChildEdSessionQuery;
use entities\EdStats as ChildEdStats;
use entities\EdStatsQuery as ChildEdStatsQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OutletAddress as ChildOutletAddress;
use entities\OutletAddressQuery as ChildOutletAddressQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataKeys as ChildOutletOrgDataKeys;
use entities\OutletOrgDataKeysQuery as ChildOutletOrgDataKeysQuery;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\OutletOrgNotes as ChildOutletOrgNotes;
use entities\OutletOrgNotesQuery as ChildOutletOrgNotesQuery;
use entities\OutletStock as ChildOutletStock;
use entities\OutletStockOtherSummary as ChildOutletStockOtherSummary;
use entities\OutletStockOtherSummaryQuery as ChildOutletStockOtherSummaryQuery;
use entities\OutletStockQuery as ChildOutletStockQuery;
use entities\OutletStockSummary as ChildOutletStockSummary;
use entities\OutletStockSummaryQuery as ChildOutletStockSummaryQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\PrescriberData as ChildPrescriberData;
use entities\PrescriberDataQuery as ChildPrescriberDataQuery;
use entities\Reminders as ChildReminders;
use entities\RemindersQuery as ChildRemindersQuery;
use entities\Tourplans as ChildTourplans;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\BeatOutletsTableMap;
use entities\Map\BrandCampiagnDoctorsTableMap;
use entities\Map\DailycallsAttendeesTableMap;
use entities\Map\DailycallsSgpioutTableMap;
use entities\Map\DailycallsTableMap;
use entities\Map\DayplanTableMap;
use entities\Map\EdFeedbacksTableMap;
use entities\Map\EdSessionTableMap;
use entities\Map\EdStatsTableMap;
use entities\Map\OnBoardRequestAddressTableMap;
use entities\Map\OutletOrgDataKeysTableMap;
use entities\Map\OutletOrgDataTableMap;
use entities\Map\OutletOrgNotesTableMap;
use entities\Map\OutletStockOtherSummaryTableMap;
use entities\Map\OutletStockSummaryTableMap;
use entities\Map\OutletStockTableMap;
use entities\Map\PrescriberDataTableMap;
use entities\Map\RemindersTableMap;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a row from the 'outlet_org_data' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OutletOrgData implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OutletOrgDataTableMap';


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
     * The value for the outlet_org_id field.
     *
     * @var        string
     */
    protected $outlet_org_id;

    /**
     * The value for the outlet_id field.
     *
     * @var        int
     */
    protected $outlet_id;

    /**
     * The value for the org_unit_id field.
     *
     * @var        int
     */
    protected $org_unit_id;

    /**
     * The value for the tags field.
     *
     * @var        string|null
     */
    protected $tags;

    /**
     * The value for the visit_fq field.
     *
     * @var        int|null
     */
    protected $visit_fq;

    /**
     * The value for the comments field.
     *
     * @var        string|null
     */
    protected $comments;

    /**
     * The value for the org_potential field.
     *
     * @var        string|null
     */
    protected $org_potential;

    /**
     * The value for the brand_focus field.
     *
     * @var        string|null
     */
    protected $brand_focus;

    /**
     * The value for the customer_fq field.
     *
     * @var        string|null
     */
    protected $customer_fq;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
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
     * The value for the itownid field.
     *
     * @var        int|null
     */
    protected $itownid;

    /**
     * The value for the default_address field.
     *
     * @var        int|null
     */
    protected $default_address;

    /**
     * The value for the last_visit_date field.
     *
     * @var        DateTime|null
     */
    protected $last_visit_date;

    /**
     * The value for the last_visit_employee field.
     *
     * @var        int|null
     */
    protected $last_visit_employee;

    /**
     * The value for the outlet_org_code field.
     *
     * @var        string|null
     */
    protected $outlet_org_code;

    /**
     * The value for the invested_amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string|null
     */
    protected $invested_amount;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOutlets
     */
    protected $aOutlets;

    /**
     * @var        ChildOutletAddress
     */
    protected $aOutletAddress;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTowns;

    /**
     * @var        ObjectCollection|ChildBeatOutlets[] Collection to store aggregation of ChildBeatOutlets objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBeatOutlets> Collection to store aggregation of ChildBeatOutlets objects.
     */
    protected $collBeatOutletss;
    protected $collBeatOutletssPartial;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnDoctors[] Collection to store aggregation of ChildBrandCampiagnDoctors objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnDoctors> Collection to store aggregation of ChildBrandCampiagnDoctors objects.
     */
    protected $collBrandCampiagnDoctorss;
    protected $collBrandCampiagnDoctorssPartial;

    /**
     * @var        ObjectCollection|ChildDailycalls[] Collection to store aggregation of ChildDailycalls objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycalls> Collection to store aggregation of ChildDailycalls objects.
     */
    protected $collDailycallss;
    protected $collDailycallssPartial;

    /**
     * @var        ObjectCollection|ChildDailycallsAttendees[] Collection to store aggregation of ChildDailycallsAttendees objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsAttendees> Collection to store aggregation of ChildDailycallsAttendees objects.
     */
    protected $collDailycallsAttendeess;
    protected $collDailycallsAttendeessPartial;

    /**
     * @var        ObjectCollection|ChildDailycallsSgpiout[] Collection to store aggregation of ChildDailycallsSgpiout objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsSgpiout> Collection to store aggregation of ChildDailycallsSgpiout objects.
     */
    protected $collDailycallsSgpiouts;
    protected $collDailycallsSgpioutsPartial;

    /**
     * @var        ObjectCollection|ChildDayplan[] Collection to store aggregation of ChildDayplan objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan> Collection to store aggregation of ChildDayplan objects.
     */
    protected $collDayplans;
    protected $collDayplansPartial;

    /**
     * @var        ObjectCollection|ChildEdFeedbacks[] Collection to store aggregation of ChildEdFeedbacks objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdFeedbacks> Collection to store aggregation of ChildEdFeedbacks objects.
     */
    protected $collEdFeedbackss;
    protected $collEdFeedbackssPartial;

    /**
     * @var        ObjectCollection|ChildEdSession[] Collection to store aggregation of ChildEdSession objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdSession> Collection to store aggregation of ChildEdSession objects.
     */
    protected $collEdSessions;
    protected $collEdSessionsPartial;

    /**
     * @var        ObjectCollection|ChildEdStats[] Collection to store aggregation of ChildEdStats objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdStats> Collection to store aggregation of ChildEdStats objects.
     */
    protected $collEdStatss;
    protected $collEdStatssPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestAddress[] Collection to store aggregation of ChildOnBoardRequestAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress> Collection to store aggregation of ChildOnBoardRequestAddress objects.
     */
    protected $collOnBoardRequestAddresses;
    protected $collOnBoardRequestAddressesPartial;

    /**
     * @var        ObjectCollection|ChildOutletOrgNotes[] Collection to store aggregation of ChildOutletOrgNotes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgNotes> Collection to store aggregation of ChildOutletOrgNotes objects.
     */
    protected $collOutletOrgNotess;
    protected $collOutletOrgNotessPartial;

    /**
     * @var        ObjectCollection|ChildOutletStock[] Collection to store aggregation of ChildOutletStock objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStock> Collection to store aggregation of ChildOutletStock objects.
     */
    protected $collOutletStocks;
    protected $collOutletStocksPartial;

    /**
     * @var        ObjectCollection|ChildOutletStockOtherSummary[] Collection to store aggregation of ChildOutletStockOtherSummary objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStockOtherSummary> Collection to store aggregation of ChildOutletStockOtherSummary objects.
     */
    protected $collOutletStockOtherSummaries;
    protected $collOutletStockOtherSummariesPartial;

    /**
     * @var        ObjectCollection|ChildOutletStockSummary[] Collection to store aggregation of ChildOutletStockSummary objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStockSummary> Collection to store aggregation of ChildOutletStockSummary objects.
     */
    protected $collOutletStockSummaries;
    protected $collOutletStockSummariesPartial;

    /**
     * @var        ObjectCollection|ChildPrescriberData[] Collection to store aggregation of ChildPrescriberData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberData> Collection to store aggregation of ChildPrescriberData objects.
     */
    protected $collPrescriberDatas;
    protected $collPrescriberDatasPartial;

    /**
     * @var        ObjectCollection|ChildReminders[] Collection to store aggregation of ChildReminders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildReminders> Collection to store aggregation of ChildReminders objects.
     */
    protected $collReminderss;
    protected $collReminderssPartial;

    /**
     * @var        ObjectCollection|ChildTourplans[] Collection to store aggregation of ChildTourplans objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans> Collection to store aggregation of ChildTourplans objects.
     */
    protected $collTourplanss;
    protected $collTourplanssPartial;

    /**
     * @var        ObjectCollection|ChildOutletOrgDataKeys[] Collection to store aggregation of ChildOutletOrgDataKeys objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgDataKeys> Collection to store aggregation of ChildOutletOrgDataKeys objects.
     */
    protected $collOutletOrgDataKeyss;
    protected $collOutletOrgDataKeyssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBeatOutlets[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBeatOutlets>
     */
    protected $beatOutletssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnDoctors[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnDoctors>
     */
    protected $brandCampiagnDoctorssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycalls[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycalls>
     */
    protected $dailycallssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycallsAttendees[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsAttendees>
     */
    protected $dailycallsAttendeessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycallsSgpiout[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsSgpiout>
     */
    protected $dailycallsSgpioutsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDayplan[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan>
     */
    protected $dayplansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdFeedbacks[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdFeedbacks>
     */
    protected $edFeedbackssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdSession[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdSession>
     */
    protected $edSessionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdStats[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdStats>
     */
    protected $edStatssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress>
     */
    protected $onBoardRequestAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletOrgNotes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgNotes>
     */
    protected $outletOrgNotessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletStock[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStock>
     */
    protected $outletStocksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletStockOtherSummary[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStockOtherSummary>
     */
    protected $outletStockOtherSummariesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletStockSummary[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletStockSummary>
     */
    protected $outletStockSummariesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrescriberData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberData>
     */
    protected $prescriberDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReminders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildReminders>
     */
    protected $reminderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTourplans[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans>
     */
    protected $tourplanssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletOrgDataKeys[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgDataKeys>
     */
    protected $outletOrgDataKeyssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->invested_amount = '0.00';
    }

    /**
     * Initializes internal state of entities\Base\OutletOrgData object.
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
     * Compares this with another <code>OutletOrgData</code> instance.  If
     * <code>obj</code> is an instance of <code>OutletOrgData</code>, delegates to
     * <code>equals(OutletOrgData)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [outlet_org_id] column value.
     *
     * @return string
     */
    public function getOutletOrgId()
    {
        return $this->outlet_org_id;
    }

    /**
     * Get the [outlet_id] column value.
     *
     * @return int
     */
    public function getOutletId()
    {
        return $this->outlet_id;
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
     * Get the [tags] column value.
     *
     * @return string|null
     */
    public function getTags()
    {
        return $this->tags;
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
     * Get the [comments] column value.
     *
     * @return string|null
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Get the [org_potential] column value.
     *
     * @return string|null
     */
    public function getOrgPotential()
    {
        return $this->org_potential;
    }

    /**
     * Get the [brand_focus] column value.
     *
     * @return string|null
     */
    public function getBrandFocus()
    {
        return $this->brand_focus;
    }

    /**
     * Get the [customer_fq] column value.
     *
     * @return string|null
     */
    public function getCustomerFq()
    {
        return $this->customer_fq;
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
     * Get the [itownid] column value.
     *
     * @return int|null
     */
    public function getItownid()
    {
        return $this->itownid;
    }

    /**
     * Get the [default_address] column value.
     *
     * @return int|null
     */
    public function getDefaultAddress()
    {
        return $this->default_address;
    }

    /**
     * Get the [optionally formatted] temporal [last_visit_date] column value.
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
    public function getLastVisitDate($format = null)
    {
        if ($format === null) {
            return $this->last_visit_date;
        } else {
            return $this->last_visit_date instanceof \DateTimeInterface ? $this->last_visit_date->format($format) : null;
        }
    }

    /**
     * Get the [last_visit_employee] column value.
     *
     * @return int|null
     */
    public function getLastVisitEmployee()
    {
        return $this->last_visit_employee;
    }

    /**
     * Get the [outlet_org_code] column value.
     *
     * @return string|null
     */
    public function getOutletOrgCode()
    {
        return $this->outlet_org_code;
    }

    /**
     * Get the [invested_amount] column value.
     *
     * @return string|null
     */
    public function getInvestedAmount()
    {
        return $this->invested_amount;
    }

    /**
     * Set the value of [outlet_org_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_org_id !== $v) {
            $this->outlet_org_id = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_OUTLET_ORG_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_OUTLET_ID] = true;
        }

        if ($this->aOutlets !== null && $this->aOutlets->getId() !== $v) {
            $this->aOutlets = null;
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
            $this->modifiedColumns[OutletOrgDataTableMap::COL_ORG_UNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [tags] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tags !== $v) {
            $this->tags = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_TAGS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_fq] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVisitFq($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->visit_fq !== $v) {
            $this->visit_fq = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_VISIT_FQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [comments] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comments !== $v) {
            $this->comments = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_COMMENTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_potential] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgPotential($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->org_potential !== $v) {
            $this->org_potential = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_ORG_POTENTIAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_focus] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandFocus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_focus !== $v) {
            $this->brand_focus = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_BRAND_FOCUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [customer_fq] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerFq($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->customer_fq !== $v) {
            $this->customer_fq = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_CUSTOMER_FQ] = true;
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
            $this->modifiedColumns[OutletOrgDataTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[OutletOrgDataTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[OutletOrgDataTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

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
            $this->modifiedColumns[OutletOrgDataTableMap::COL_ITOWNID] = true;
        }

        if ($this->aGeoTowns !== null && $this->aGeoTowns->getItownid() !== $v) {
            $this->aGeoTowns = null;
        }

        return $this;
    }

    /**
     * Set the value of [default_address] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultAddress($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->default_address !== $v) {
            $this->default_address = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_DEFAULT_ADDRESS] = true;
        }

        if ($this->aOutletAddress !== null && $this->aOutletAddress->getOutletAddressId() !== $v) {
            $this->aOutletAddress = null;
        }

        return $this;
    }

    /**
     * Sets the value of [last_visit_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setLastVisitDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_visit_date !== null || $dt !== null) {
            if ($this->last_visit_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_visit_date->format("Y-m-d H:i:s.u")) {
                $this->last_visit_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletOrgDataTableMap::COL_LAST_VISIT_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [last_visit_employee] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastVisitEmployee($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_visit_employee !== $v) {
            $this->last_visit_employee = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_org_code !== $v) {
            $this->outlet_org_code = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_OUTLET_ORG_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [invested_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setInvestedAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->invested_amount !== $v) {
            $this->invested_amount = $v;
            $this->modifiedColumns[OutletOrgDataTableMap::COL_INVESTED_AMOUNT] = true;
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
            if ($this->invested_amount !== '0.00') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OutletOrgDataTableMap::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OutletOrgDataTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OutletOrgDataTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OutletOrgDataTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OutletOrgDataTableMap::translateFieldName('VisitFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_fq = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OutletOrgDataTableMap::translateFieldName('Comments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OutletOrgDataTableMap::translateFieldName('OrgPotential', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_potential = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OutletOrgDataTableMap::translateFieldName('BrandFocus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_focus = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OutletOrgDataTableMap::translateFieldName('CustomerFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_fq = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OutletOrgDataTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OutletOrgDataTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OutletOrgDataTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OutletOrgDataTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OutletOrgDataTableMap::translateFieldName('DefaultAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OutletOrgDataTableMap::translateFieldName('LastVisitDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_visit_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OutletOrgDataTableMap::translateFieldName('LastVisitEmployee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_visit_employee = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OutletOrgDataTableMap::translateFieldName('OutletOrgCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OutletOrgDataTableMap::translateFieldName('InvestedAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->invested_amount = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = OutletOrgDataTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OutletOrgData'), 0, $e);
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
        if ($this->aOutlets !== null && $this->outlet_id !== $this->aOutlets->getId()) {
            $this->aOutlets = null;
        }
        if ($this->aOrgUnit !== null && $this->org_unit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aGeoTowns !== null && $this->itownid !== $this->aGeoTowns->getItownid()) {
            $this->aGeoTowns = null;
        }
        if ($this->aOutletAddress !== null && $this->default_address !== $this->aOutletAddress->getOutletAddressId()) {
            $this->aOutletAddress = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OutletOrgDataTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOutletOrgDataQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aOutlets = null;
            $this->aOutletAddress = null;
            $this->aOrgUnit = null;
            $this->aGeoTowns = null;
            $this->collBeatOutletss = null;

            $this->collBrandCampiagnDoctorss = null;

            $this->collDailycallss = null;

            $this->collDailycallsAttendeess = null;

            $this->collDailycallsSgpiouts = null;

            $this->collDayplans = null;

            $this->collEdFeedbackss = null;

            $this->collEdSessions = null;

            $this->collEdStatss = null;

            $this->collOnBoardRequestAddresses = null;

            $this->collOutletOrgNotess = null;

            $this->collOutletStocks = null;

            $this->collOutletStockOtherSummaries = null;

            $this->collOutletStockSummaries = null;

            $this->collPrescriberDatas = null;

            $this->collReminderss = null;

            $this->collTourplanss = null;

            $this->collOutletOrgDataKeyss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see OutletOrgData::setDeleted()
     * @see OutletOrgData::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgDataTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOutletOrgDataQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgDataTableMap::DATABASE_NAME);
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
                OutletOrgDataTableMap::addInstanceToPool($this);
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

            if ($this->aOutlets !== null) {
                if ($this->aOutlets->isModified() || $this->aOutlets->isNew()) {
                    $affectedRows += $this->aOutlets->save($con);
                }
                $this->setOutlets($this->aOutlets);
            }

            if ($this->aOutletAddress !== null) {
                if ($this->aOutletAddress->isModified() || $this->aOutletAddress->isNew()) {
                    $affectedRows += $this->aOutletAddress->save($con);
                }
                $this->setOutletAddress($this->aOutletAddress);
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

            if ($this->beatOutletssScheduledForDeletion !== null) {
                if (!$this->beatOutletssScheduledForDeletion->isEmpty()) {
                    foreach ($this->beatOutletssScheduledForDeletion as $beatOutlets) {
                        // need to save related object because we set the relation to null
                        $beatOutlets->save($con);
                    }
                    $this->beatOutletssScheduledForDeletion = null;
                }
            }

            if ($this->collBeatOutletss !== null) {
                foreach ($this->collBeatOutletss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->dailycallsSgpioutsScheduledForDeletion !== null) {
                if (!$this->dailycallsSgpioutsScheduledForDeletion->isEmpty()) {
                    foreach ($this->dailycallsSgpioutsScheduledForDeletion as $dailycallsSgpiout) {
                        // need to save related object because we set the relation to null
                        $dailycallsSgpiout->save($con);
                    }
                    $this->dailycallsSgpioutsScheduledForDeletion = null;
                }
            }

            if ($this->collDailycallsSgpiouts !== null) {
                foreach ($this->collDailycallsSgpiouts as $referrerFK) {
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

            if ($this->edFeedbackssScheduledForDeletion !== null) {
                if (!$this->edFeedbackssScheduledForDeletion->isEmpty()) {
                    foreach ($this->edFeedbackssScheduledForDeletion as $edFeedbacks) {
                        // need to save related object because we set the relation to null
                        $edFeedbacks->save($con);
                    }
                    $this->edFeedbackssScheduledForDeletion = null;
                }
            }

            if ($this->collEdFeedbackss !== null) {
                foreach ($this->collEdFeedbackss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->edSessionsScheduledForDeletion !== null) {
                if (!$this->edSessionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->edSessionsScheduledForDeletion as $edSession) {
                        // need to save related object because we set the relation to null
                        $edSession->save($con);
                    }
                    $this->edSessionsScheduledForDeletion = null;
                }
            }

            if ($this->collEdSessions !== null) {
                foreach ($this->collEdSessions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->edStatssScheduledForDeletion !== null) {
                if (!$this->edStatssScheduledForDeletion->isEmpty()) {
                    foreach ($this->edStatssScheduledForDeletion as $edStats) {
                        // need to save related object because we set the relation to null
                        $edStats->save($con);
                    }
                    $this->edStatssScheduledForDeletion = null;
                }
            }

            if ($this->collEdStatss !== null) {
                foreach ($this->collEdStatss as $referrerFK) {
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

            if ($this->outletOrgNotessScheduledForDeletion !== null) {
                if (!$this->outletOrgNotessScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletOrgNotessScheduledForDeletion as $outletOrgNotes) {
                        // need to save related object because we set the relation to null
                        $outletOrgNotes->save($con);
                    }
                    $this->outletOrgNotessScheduledForDeletion = null;
                }
            }

            if ($this->collOutletOrgNotess !== null) {
                foreach ($this->collOutletOrgNotess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletStocksScheduledForDeletion !== null) {
                if (!$this->outletStocksScheduledForDeletion->isEmpty()) {
                    \entities\OutletStockQuery::create()
                        ->filterByPrimaryKeys($this->outletStocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->outletStocksScheduledForDeletion = null;
                }
            }

            if ($this->collOutletStocks !== null) {
                foreach ($this->collOutletStocks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletStockOtherSummariesScheduledForDeletion !== null) {
                if (!$this->outletStockOtherSummariesScheduledForDeletion->isEmpty()) {
                    \entities\OutletStockOtherSummaryQuery::create()
                        ->filterByPrimaryKeys($this->outletStockOtherSummariesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->outletStockOtherSummariesScheduledForDeletion = null;
                }
            }

            if ($this->collOutletStockOtherSummaries !== null) {
                foreach ($this->collOutletStockOtherSummaries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletStockSummariesScheduledForDeletion !== null) {
                if (!$this->outletStockSummariesScheduledForDeletion->isEmpty()) {
                    \entities\OutletStockSummaryQuery::create()
                        ->filterByPrimaryKeys($this->outletStockSummariesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->outletStockSummariesScheduledForDeletion = null;
                }
            }

            if ($this->collOutletStockSummaries !== null) {
                foreach ($this->collOutletStockSummaries as $referrerFK) {
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

            if ($this->reminderssScheduledForDeletion !== null) {
                if (!$this->reminderssScheduledForDeletion->isEmpty()) {
                    \entities\RemindersQuery::create()
                        ->filterByPrimaryKeys($this->reminderssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reminderssScheduledForDeletion = null;
                }
            }

            if ($this->collReminderss !== null) {
                foreach ($this->collReminderss as $referrerFK) {
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

            if ($this->outletOrgDataKeyssScheduledForDeletion !== null) {
                if (!$this->outletOrgDataKeyssScheduledForDeletion->isEmpty()) {
                    \entities\OutletOrgDataKeysQuery::create()
                        ->filterByPrimaryKeys($this->outletOrgDataKeyssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->outletOrgDataKeyssScheduledForDeletion = null;
                }
            }

            if ($this->collOutletOrgDataKeyss !== null) {
                foreach ($this->collOutletOrgDataKeyss as $referrerFK) {
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

        $this->modifiedColumns[OutletOrgDataTableMap::COL_OUTLET_ORG_ID] = true;
        if (null !== $this->outlet_org_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OutletOrgDataTableMap::COL_OUTLET_ORG_ID . ')');
        }
        if (null === $this->outlet_org_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('outlet_org_data_outlet_org_id_seq')");
                $this->outlet_org_id = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_OUTLET_ORG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_id';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_OUTLET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_id';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_id';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_TAGS)) {
            $modifiedColumns[':p' . $index++]  = 'tags';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_VISIT_FQ)) {
            $modifiedColumns[':p' . $index++]  = 'visit_fq';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'comments';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_ORG_POTENTIAL)) {
            $modifiedColumns[':p' . $index++]  = 'org_potential';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_BRAND_FOCUS)) {
            $modifiedColumns[':p' . $index++]  = 'brand_focus';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_CUSTOMER_FQ)) {
            $modifiedColumns[':p' . $index++]  = 'customer_fq';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'default_address';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_LAST_VISIT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'last_visit_date';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE)) {
            $modifiedColumns[':p' . $index++]  = 'last_visit_employee';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_OUTLET_ORG_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_code';
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_INVESTED_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'invested_amount';
        }

        $sql = sprintf(
            'INSERT INTO outlet_org_data (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'outlet_org_id':
                        $stmt->bindValue($identifier, $this->outlet_org_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_id':
                        $stmt->bindValue($identifier, $this->outlet_id, PDO::PARAM_INT);

                        break;
                    case 'org_unit_id':
                        $stmt->bindValue($identifier, $this->org_unit_id, PDO::PARAM_INT);

                        break;
                    case 'tags':
                        $stmt->bindValue($identifier, $this->tags, PDO::PARAM_STR);

                        break;
                    case 'visit_fq':
                        $stmt->bindValue($identifier, $this->visit_fq, PDO::PARAM_INT);

                        break;
                    case 'comments':
                        $stmt->bindValue($identifier, $this->comments, PDO::PARAM_STR);

                        break;
                    case 'org_potential':
                        $stmt->bindValue($identifier, $this->org_potential, PDO::PARAM_STR);

                        break;
                    case 'brand_focus':
                        $stmt->bindValue($identifier, $this->brand_focus, PDO::PARAM_STR);

                        break;
                    case 'customer_fq':
                        $stmt->bindValue($identifier, $this->customer_fq, PDO::PARAM_STR);

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
                    case 'itownid':
                        $stmt->bindValue($identifier, $this->itownid, PDO::PARAM_INT);

                        break;
                    case 'default_address':
                        $stmt->bindValue($identifier, $this->default_address, PDO::PARAM_INT);

                        break;
                    case 'last_visit_date':
                        $stmt->bindValue($identifier, $this->last_visit_date ? $this->last_visit_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'last_visit_employee':
                        $stmt->bindValue($identifier, $this->last_visit_employee, PDO::PARAM_INT);

                        break;
                    case 'outlet_org_code':
                        $stmt->bindValue($identifier, $this->outlet_org_code, PDO::PARAM_STR);

                        break;
                    case 'invested_amount':
                        $stmt->bindValue($identifier, $this->invested_amount, PDO::PARAM_STR);

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
        $pos = OutletOrgDataTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOutletOrgId();

            case 1:
                return $this->getOutletId();

            case 2:
                return $this->getOrgUnitId();

            case 3:
                return $this->getTags();

            case 4:
                return $this->getVisitFq();

            case 5:
                return $this->getComments();

            case 6:
                return $this->getOrgPotential();

            case 7:
                return $this->getBrandFocus();

            case 8:
                return $this->getCustomerFq();

            case 9:
                return $this->getCompanyId();

            case 10:
                return $this->getCreatedAt();

            case 11:
                return $this->getUpdatedAt();

            case 12:
                return $this->getItownid();

            case 13:
                return $this->getDefaultAddress();

            case 14:
                return $this->getLastVisitDate();

            case 15:
                return $this->getLastVisitEmployee();

            case 16:
                return $this->getOutletOrgCode();

            case 17:
                return $this->getInvestedAmount();

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
        if (isset($alreadyDumpedObjects['OutletOrgData'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OutletOrgData'][$this->hashCode()] = true;
        $keys = OutletOrgDataTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOutletOrgId(),
            $keys[1] => $this->getOutletId(),
            $keys[2] => $this->getOrgUnitId(),
            $keys[3] => $this->getTags(),
            $keys[4] => $this->getVisitFq(),
            $keys[5] => $this->getComments(),
            $keys[6] => $this->getOrgPotential(),
            $keys[7] => $this->getBrandFocus(),
            $keys[8] => $this->getCustomerFq(),
            $keys[9] => $this->getCompanyId(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
            $keys[12] => $this->getItownid(),
            $keys[13] => $this->getDefaultAddress(),
            $keys[14] => $this->getLastVisitDate(),
            $keys[15] => $this->getLastVisitEmployee(),
            $keys[16] => $this->getOutletOrgCode(),
            $keys[17] => $this->getInvestedAmount(),
        ];
        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->aOutlets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outlets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlets';
                        break;
                    default:
                        $key = 'Outlets';
                }

                $result[$key] = $this->aOutlets->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOutletAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_address';
                        break;
                    default:
                        $key = 'OutletAddress';
                }

                $result[$key] = $this->aOutletAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collBeatOutletss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'beatOutletss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'beat_outletss';
                        break;
                    default:
                        $key = 'BeatOutletss';
                }

                $result[$key] = $this->collBeatOutletss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collDailycallsSgpiouts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dailycallsSgpiouts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dailycalls_sgpiouts';
                        break;
                    default:
                        $key = 'DailycallsSgpiouts';
                }

                $result[$key] = $this->collDailycallsSgpiouts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collEdFeedbackss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edFeedbackss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_feedbackss';
                        break;
                    default:
                        $key = 'EdFeedbackss';
                }

                $result[$key] = $this->collEdFeedbackss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEdSessions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edSessions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_sessions';
                        break;
                    default:
                        $key = 'EdSessions';
                }

                $result[$key] = $this->collEdSessions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEdStatss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edStatss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_statss';
                        break;
                    default:
                        $key = 'EdStatss';
                }

                $result[$key] = $this->collEdStatss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOutletOrgNotess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletOrgNotess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_org_notess';
                        break;
                    default:
                        $key = 'OutletOrgNotess';
                }

                $result[$key] = $this->collOutletOrgNotess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletStocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletStocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_stocks';
                        break;
                    default:
                        $key = 'OutletStocks';
                }

                $result[$key] = $this->collOutletStocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletStockOtherSummaries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletStockOtherSummaries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_stock_other_summaries';
                        break;
                    default:
                        $key = 'OutletStockOtherSummaries';
                }

                $result[$key] = $this->collOutletStockOtherSummaries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletStockSummaries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletStockSummaries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_stock_summaries';
                        break;
                    default:
                        $key = 'OutletStockSummaries';
                }

                $result[$key] = $this->collOutletStockSummaries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collReminderss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reminderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reminderss';
                        break;
                    default:
                        $key = 'Reminderss';
                }

                $result[$key] = $this->collReminderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOutletOrgDataKeyss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletOrgDataKeyss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_org_data_keyss';
                        break;
                    default:
                        $key = 'OutletOrgDataKeyss';
                }

                $result[$key] = $this->collOutletOrgDataKeyss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = OutletOrgDataTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOutletOrgId($value);
                break;
            case 1:
                $this->setOutletId($value);
                break;
            case 2:
                $this->setOrgUnitId($value);
                break;
            case 3:
                $this->setTags($value);
                break;
            case 4:
                $this->setVisitFq($value);
                break;
            case 5:
                $this->setComments($value);
                break;
            case 6:
                $this->setOrgPotential($value);
                break;
            case 7:
                $this->setBrandFocus($value);
                break;
            case 8:
                $this->setCustomerFq($value);
                break;
            case 9:
                $this->setCompanyId($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
                $this->setUpdatedAt($value);
                break;
            case 12:
                $this->setItownid($value);
                break;
            case 13:
                $this->setDefaultAddress($value);
                break;
            case 14:
                $this->setLastVisitDate($value);
                break;
            case 15:
                $this->setLastVisitEmployee($value);
                break;
            case 16:
                $this->setOutletOrgCode($value);
                break;
            case 17:
                $this->setInvestedAmount($value);
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
        $keys = OutletOrgDataTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOutletOrgId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOutletId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOrgUnitId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTags($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setVisitFq($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setComments($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setOrgPotential($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setBrandFocus($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCustomerFq($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCompanyId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdatedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setItownid($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDefaultAddress($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setLastVisitDate($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setLastVisitEmployee($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setOutletOrgCode($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setInvestedAmount($arr[$keys[17]]);
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
        $criteria = new Criteria(OutletOrgDataTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OutletOrgDataTableMap::COL_OUTLET_ORG_ID)) {
            $criteria->add(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_OUTLET_ID)) {
            $criteria->add(OutletOrgDataTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(OutletOrgDataTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_TAGS)) {
            $criteria->add(OutletOrgDataTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_VISIT_FQ)) {
            $criteria->add(OutletOrgDataTableMap::COL_VISIT_FQ, $this->visit_fq);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_COMMENTS)) {
            $criteria->add(OutletOrgDataTableMap::COL_COMMENTS, $this->comments);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_ORG_POTENTIAL)) {
            $criteria->add(OutletOrgDataTableMap::COL_ORG_POTENTIAL, $this->org_potential);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_BRAND_FOCUS)) {
            $criteria->add(OutletOrgDataTableMap::COL_BRAND_FOCUS, $this->brand_focus);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_CUSTOMER_FQ)) {
            $criteria->add(OutletOrgDataTableMap::COL_CUSTOMER_FQ, $this->customer_fq);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_COMPANY_ID)) {
            $criteria->add(OutletOrgDataTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_CREATED_AT)) {
            $criteria->add(OutletOrgDataTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_UPDATED_AT)) {
            $criteria->add(OutletOrgDataTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_ITOWNID)) {
            $criteria->add(OutletOrgDataTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS)) {
            $criteria->add(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS, $this->default_address);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_LAST_VISIT_DATE)) {
            $criteria->add(OutletOrgDataTableMap::COL_LAST_VISIT_DATE, $this->last_visit_date);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE)) {
            $criteria->add(OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE, $this->last_visit_employee);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_OUTLET_ORG_CODE)) {
            $criteria->add(OutletOrgDataTableMap::COL_OUTLET_ORG_CODE, $this->outlet_org_code);
        }
        if ($this->isColumnModified(OutletOrgDataTableMap::COL_INVESTED_AMOUNT)) {
            $criteria->add(OutletOrgDataTableMap::COL_INVESTED_AMOUNT, $this->invested_amount);
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
        $criteria = ChildOutletOrgDataQuery::create();
        $criteria->add(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);

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
        $validPk = null !== $this->getOutletOrgId();

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
        return $this->getOutletOrgId();
    }

    /**
     * Generic method to set the primary key (outlet_org_id column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setOutletOrgId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOutletOrgId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OutletOrgData (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setTags($this->getTags());
        $copyObj->setVisitFq($this->getVisitFq());
        $copyObj->setComments($this->getComments());
        $copyObj->setOrgPotential($this->getOrgPotential());
        $copyObj->setBrandFocus($this->getBrandFocus());
        $copyObj->setCustomerFq($this->getCustomerFq());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setDefaultAddress($this->getDefaultAddress());
        $copyObj->setLastVisitDate($this->getLastVisitDate());
        $copyObj->setLastVisitEmployee($this->getLastVisitEmployee());
        $copyObj->setOutletOrgCode($this->getOutletOrgCode());
        $copyObj->setInvestedAmount($this->getInvestedAmount());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBeatOutletss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBeatOutlets($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandCampiagnDoctorss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnDoctors($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycalls($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallsAttendeess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycallsAttendees($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallsSgpiouts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycallsSgpiout($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDayplans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDayplan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdFeedbackss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdFeedbacks($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdSessions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdSession($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdStatss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdStats($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletOrgNotess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletOrgNotes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletStocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletStock($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletStockOtherSummaries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletStockOtherSummary($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletStockSummaries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletStockSummary($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPrescriberDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrescriberData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getReminderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReminders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTourplanss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTourplans($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletOrgDataKeyss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletOrgDataKeys($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOutletOrgId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\OutletOrgData Clone of current object.
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
            $v->addOutletOrgData($this);
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
                $this->aCompany->addOutletOrgDatas($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildOutlets object.
     *
     * @param ChildOutlets $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutlets(ChildOutlets $v = null)
    {
        if ($v === null) {
            $this->setOutletId(NULL);
        } else {
            $this->setOutletId($v->getId());
        }

        $this->aOutlets = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutlets object, it will not be re-added.
        if ($v !== null) {
            $v->addOutletOrgData($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutlets object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutlets The associated ChildOutlets object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutlets(?ConnectionInterface $con = null)
    {
        if ($this->aOutlets === null && ($this->outlet_id != 0)) {
            $this->aOutlets = ChildOutletsQuery::create()->findPk($this->outlet_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutlets->addOutletOrgDatas($this);
             */
        }

        return $this->aOutlets;
    }

    /**
     * Declares an association between this object and a ChildOutletAddress object.
     *
     * @param ChildOutletAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletAddress(ChildOutletAddress $v = null)
    {
        if ($v === null) {
            $this->setDefaultAddress(NULL);
        } else {
            $this->setDefaultAddress($v->getOutletAddressId());
        }

        $this->aOutletAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addOutletOrgData($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletAddress|null The associated ChildOutletAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletAddress(?ConnectionInterface $con = null)
    {
        if ($this->aOutletAddress === null && ($this->default_address != 0)) {
            $this->aOutletAddress = ChildOutletAddressQuery::create()->findPk($this->default_address, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletAddress->addOutletOrgDatas($this);
             */
        }

        return $this->aOutletAddress;
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
            $v->addOutletOrgData($this);
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
                $this->aOrgUnit->addOutletOrgDatas($this);
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
            $v->addOutletOrgData($this);
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
                $this->aGeoTowns->addOutletOrgDatas($this);
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
        if ('BeatOutlets' === $relationName) {
            $this->initBeatOutletss();
            return;
        }
        if ('BrandCampiagnDoctors' === $relationName) {
            $this->initBrandCampiagnDoctorss();
            return;
        }
        if ('Dailycalls' === $relationName) {
            $this->initDailycallss();
            return;
        }
        if ('DailycallsAttendees' === $relationName) {
            $this->initDailycallsAttendeess();
            return;
        }
        if ('DailycallsSgpiout' === $relationName) {
            $this->initDailycallsSgpiouts();
            return;
        }
        if ('Dayplan' === $relationName) {
            $this->initDayplans();
            return;
        }
        if ('EdFeedbacks' === $relationName) {
            $this->initEdFeedbackss();
            return;
        }
        if ('EdSession' === $relationName) {
            $this->initEdSessions();
            return;
        }
        if ('EdStats' === $relationName) {
            $this->initEdStatss();
            return;
        }
        if ('OnBoardRequestAddress' === $relationName) {
            $this->initOnBoardRequestAddresses();
            return;
        }
        if ('OutletOrgNotes' === $relationName) {
            $this->initOutletOrgNotess();
            return;
        }
        if ('OutletStock' === $relationName) {
            $this->initOutletStocks();
            return;
        }
        if ('OutletStockOtherSummary' === $relationName) {
            $this->initOutletStockOtherSummaries();
            return;
        }
        if ('OutletStockSummary' === $relationName) {
            $this->initOutletStockSummaries();
            return;
        }
        if ('PrescriberData' === $relationName) {
            $this->initPrescriberDatas();
            return;
        }
        if ('Reminders' === $relationName) {
            $this->initReminderss();
            return;
        }
        if ('Tourplans' === $relationName) {
            $this->initTourplanss();
            return;
        }
        if ('OutletOrgDataKeys' === $relationName) {
            $this->initOutletOrgDataKeyss();
            return;
        }
    }

    /**
     * Clears out the collBeatOutletss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBeatOutletss()
     */
    public function clearBeatOutletss()
    {
        $this->collBeatOutletss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBeatOutletss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBeatOutletss($v = true): void
    {
        $this->collBeatOutletssPartial = $v;
    }

    /**
     * Initializes the collBeatOutletss collection.
     *
     * By default this just sets the collBeatOutletss collection to an empty array (like clearcollBeatOutletss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBeatOutletss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBeatOutletss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BeatOutletsTableMap::getTableMap()->getCollectionClassName();

        $this->collBeatOutletss = new $collectionClassName;
        $this->collBeatOutletss->setModel('\entities\BeatOutlets');
    }

    /**
     * Gets an array of ChildBeatOutlets objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBeatOutlets[] List of ChildBeatOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeatOutlets> List of ChildBeatOutlets objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBeatOutletss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBeatOutletssPartial && !$this->isNew();
        if (null === $this->collBeatOutletss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBeatOutletss) {
                    $this->initBeatOutletss();
                } else {
                    $collectionClassName = BeatOutletsTableMap::getTableMap()->getCollectionClassName();

                    $collBeatOutletss = new $collectionClassName;
                    $collBeatOutletss->setModel('\entities\BeatOutlets');

                    return $collBeatOutletss;
                }
            } else {
                $collBeatOutletss = ChildBeatOutletsQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBeatOutletssPartial && count($collBeatOutletss)) {
                        $this->initBeatOutletss(false);

                        foreach ($collBeatOutletss as $obj) {
                            if (false == $this->collBeatOutletss->contains($obj)) {
                                $this->collBeatOutletss->append($obj);
                            }
                        }

                        $this->collBeatOutletssPartial = true;
                    }

                    return $collBeatOutletss;
                }

                if ($partial && $this->collBeatOutletss) {
                    foreach ($this->collBeatOutletss as $obj) {
                        if ($obj->isNew()) {
                            $collBeatOutletss[] = $obj;
                        }
                    }
                }

                $this->collBeatOutletss = $collBeatOutletss;
                $this->collBeatOutletssPartial = false;
            }
        }

        return $this->collBeatOutletss;
    }

    /**
     * Sets a collection of ChildBeatOutlets objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $beatOutletss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBeatOutletss(Collection $beatOutletss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBeatOutlets[] $beatOutletssToDelete */
        $beatOutletssToDelete = $this->getBeatOutletss(new Criteria(), $con)->diff($beatOutletss);


        $this->beatOutletssScheduledForDeletion = $beatOutletssToDelete;

        foreach ($beatOutletssToDelete as $beatOutletsRemoved) {
            $beatOutletsRemoved->setOutletOrgData(null);
        }

        $this->collBeatOutletss = null;
        foreach ($beatOutletss as $beatOutlets) {
            $this->addBeatOutlets($beatOutlets);
        }

        $this->collBeatOutletss = $beatOutletss;
        $this->collBeatOutletssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BeatOutlets objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BeatOutlets objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBeatOutletss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBeatOutletssPartial && !$this->isNew();
        if (null === $this->collBeatOutletss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBeatOutletss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBeatOutletss());
            }

            $query = ChildBeatOutletsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collBeatOutletss);
    }

    /**
     * Method called to associate a ChildBeatOutlets object to this object
     * through the ChildBeatOutlets foreign key attribute.
     *
     * @param ChildBeatOutlets $l ChildBeatOutlets
     * @return $this The current object (for fluent API support)
     */
    public function addBeatOutlets(ChildBeatOutlets $l)
    {
        if ($this->collBeatOutletss === null) {
            $this->initBeatOutletss();
            $this->collBeatOutletssPartial = true;
        }

        if (!$this->collBeatOutletss->contains($l)) {
            $this->doAddBeatOutlets($l);

            if ($this->beatOutletssScheduledForDeletion and $this->beatOutletssScheduledForDeletion->contains($l)) {
                $this->beatOutletssScheduledForDeletion->remove($this->beatOutletssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBeatOutlets $beatOutlets The ChildBeatOutlets object to add.
     */
    protected function doAddBeatOutlets(ChildBeatOutlets $beatOutlets): void
    {
        $this->collBeatOutletss[]= $beatOutlets;
        $beatOutlets->setOutletOrgData($this);
    }

    /**
     * @param ChildBeatOutlets $beatOutlets The ChildBeatOutlets object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBeatOutlets(ChildBeatOutlets $beatOutlets)
    {
        if ($this->getBeatOutletss()->contains($beatOutlets)) {
            $pos = $this->collBeatOutletss->search($beatOutlets);
            $this->collBeatOutletss->remove($pos);
            if (null === $this->beatOutletssScheduledForDeletion) {
                $this->beatOutletssScheduledForDeletion = clone $this->collBeatOutletss;
                $this->beatOutletssScheduledForDeletion->clear();
            }
            $this->beatOutletssScheduledForDeletion[]= $beatOutlets;
            $beatOutlets->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related BeatOutletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeatOutlets[] List of ChildBeatOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeatOutlets}> List of ChildBeatOutlets objects
     */
    public function getBeatOutletssJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatOutletsQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getBeatOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related BeatOutletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeatOutlets[] List of ChildBeatOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeatOutlets}> List of ChildBeatOutlets objects
     */
    public function getBeatOutletssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatOutletsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBeatOutletss($query, $con);
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
     * If this ChildOutletOrgData is new, it will return
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
                    ->filterByOutletOrgData($this)
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
            $brandCampiagnDoctorsRemoved->setOutletOrgData(null);
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
                ->filterByOutletOrgData($this)
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
        $brandCampiagnDoctors->setOutletOrgData($this);
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
            $brandCampiagnDoctors->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnDoctors[] List of ChildBrandCampiagnDoctors objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnDoctors}> List of ChildBrandCampiagnDoctors objects
     */
    public function getBrandCampiagnDoctorssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnDoctorsQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getBrandCampiagnDoctorss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * If this ChildOutletOrgData is new, it will return
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
                    ->filterByOutletOrgData($this)
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
            $dailycallsRemoved->setOutletOrgData(null);
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
                ->filterByOutletOrgData($this)
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
        $dailycalls->setOutletOrgData($this);
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
            $dailycalls->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * If this ChildOutletOrgData is new, it will return
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
                    ->filterByOutletOrgData($this)
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
            $dailycallsAttendeesRemoved->setOutletOrgData(null);
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
                ->filterByOutletOrgData($this)
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
        $dailycallsAttendees->setOutletOrgData($this);
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
            $dailycallsAttendees->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related DailycallsAttendeess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsAttendees[] List of ChildDailycallsAttendees objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsAttendees}> List of ChildDailycallsAttendees objects
     */
    public function getDailycallsAttendeessJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsAttendeesQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getDailycallsAttendeess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related DailycallsAttendeess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Clears out the collDailycallsSgpiouts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDailycallsSgpiouts()
     */
    public function clearDailycallsSgpiouts()
    {
        $this->collDailycallsSgpiouts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDailycallsSgpiouts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDailycallsSgpiouts($v = true): void
    {
        $this->collDailycallsSgpioutsPartial = $v;
    }

    /**
     * Initializes the collDailycallsSgpiouts collection.
     *
     * By default this just sets the collDailycallsSgpiouts collection to an empty array (like clearcollDailycallsSgpiouts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDailycallsSgpiouts(bool $overrideExisting = true): void
    {
        if (null !== $this->collDailycallsSgpiouts && !$overrideExisting) {
            return;
        }

        $collectionClassName = DailycallsSgpioutTableMap::getTableMap()->getCollectionClassName();

        $this->collDailycallsSgpiouts = new $collectionClassName;
        $this->collDailycallsSgpiouts->setModel('\entities\DailycallsSgpiout');
    }

    /**
     * Gets an array of ChildDailycallsSgpiout objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout> List of ChildDailycallsSgpiout objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDailycallsSgpiouts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDailycallsSgpioutsPartial && !$this->isNew();
        if (null === $this->collDailycallsSgpiouts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDailycallsSgpiouts) {
                    $this->initDailycallsSgpiouts();
                } else {
                    $collectionClassName = DailycallsSgpioutTableMap::getTableMap()->getCollectionClassName();

                    $collDailycallsSgpiouts = new $collectionClassName;
                    $collDailycallsSgpiouts->setModel('\entities\DailycallsSgpiout');

                    return $collDailycallsSgpiouts;
                }
            } else {
                $collDailycallsSgpiouts = ChildDailycallsSgpioutQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDailycallsSgpioutsPartial && count($collDailycallsSgpiouts)) {
                        $this->initDailycallsSgpiouts(false);

                        foreach ($collDailycallsSgpiouts as $obj) {
                            if (false == $this->collDailycallsSgpiouts->contains($obj)) {
                                $this->collDailycallsSgpiouts->append($obj);
                            }
                        }

                        $this->collDailycallsSgpioutsPartial = true;
                    }

                    return $collDailycallsSgpiouts;
                }

                if ($partial && $this->collDailycallsSgpiouts) {
                    foreach ($this->collDailycallsSgpiouts as $obj) {
                        if ($obj->isNew()) {
                            $collDailycallsSgpiouts[] = $obj;
                        }
                    }
                }

                $this->collDailycallsSgpiouts = $collDailycallsSgpiouts;
                $this->collDailycallsSgpioutsPartial = false;
            }
        }

        return $this->collDailycallsSgpiouts;
    }

    /**
     * Sets a collection of ChildDailycallsSgpiout objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dailycallsSgpiouts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDailycallsSgpiouts(Collection $dailycallsSgpiouts, ?ConnectionInterface $con = null)
    {
        /** @var ChildDailycallsSgpiout[] $dailycallsSgpioutsToDelete */
        $dailycallsSgpioutsToDelete = $this->getDailycallsSgpiouts(new Criteria(), $con)->diff($dailycallsSgpiouts);


        $this->dailycallsSgpioutsScheduledForDeletion = $dailycallsSgpioutsToDelete;

        foreach ($dailycallsSgpioutsToDelete as $dailycallsSgpioutRemoved) {
            $dailycallsSgpioutRemoved->setOutletOrgData(null);
        }

        $this->collDailycallsSgpiouts = null;
        foreach ($dailycallsSgpiouts as $dailycallsSgpiout) {
            $this->addDailycallsSgpiout($dailycallsSgpiout);
        }

        $this->collDailycallsSgpiouts = $dailycallsSgpiouts;
        $this->collDailycallsSgpioutsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DailycallsSgpiout objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related DailycallsSgpiout objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDailycallsSgpiouts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDailycallsSgpioutsPartial && !$this->isNew();
        if (null === $this->collDailycallsSgpiouts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDailycallsSgpiouts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDailycallsSgpiouts());
            }

            $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collDailycallsSgpiouts);
    }

    /**
     * Method called to associate a ChildDailycallsSgpiout object to this object
     * through the ChildDailycallsSgpiout foreign key attribute.
     *
     * @param ChildDailycallsSgpiout $l ChildDailycallsSgpiout
     * @return $this The current object (for fluent API support)
     */
    public function addDailycallsSgpiout(ChildDailycallsSgpiout $l)
    {
        if ($this->collDailycallsSgpiouts === null) {
            $this->initDailycallsSgpiouts();
            $this->collDailycallsSgpioutsPartial = true;
        }

        if (!$this->collDailycallsSgpiouts->contains($l)) {
            $this->doAddDailycallsSgpiout($l);

            if ($this->dailycallsSgpioutsScheduledForDeletion and $this->dailycallsSgpioutsScheduledForDeletion->contains($l)) {
                $this->dailycallsSgpioutsScheduledForDeletion->remove($this->dailycallsSgpioutsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDailycallsSgpiout $dailycallsSgpiout The ChildDailycallsSgpiout object to add.
     */
    protected function doAddDailycallsSgpiout(ChildDailycallsSgpiout $dailycallsSgpiout): void
    {
        $this->collDailycallsSgpiouts[]= $dailycallsSgpiout;
        $dailycallsSgpiout->setOutletOrgData($this);
    }

    /**
     * @param ChildDailycallsSgpiout $dailycallsSgpiout The ChildDailycallsSgpiout object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDailycallsSgpiout(ChildDailycallsSgpiout $dailycallsSgpiout)
    {
        if ($this->getDailycallsSgpiouts()->contains($dailycallsSgpiout)) {
            $pos = $this->collDailycallsSgpiouts->search($dailycallsSgpiout);
            $this->collDailycallsSgpiouts->remove($pos);
            if (null === $this->dailycallsSgpioutsScheduledForDeletion) {
                $this->dailycallsSgpioutsScheduledForDeletion = clone $this->collDailycallsSgpiouts;
                $this->dailycallsSgpioutsScheduledForDeletion->clear();
            }
            $this->dailycallsSgpioutsScheduledForDeletion[]= $dailycallsSgpiout;
            $dailycallsSgpiout->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinSgpiMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('SgpiMaster', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
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
     * If this ChildOutletOrgData is new, it will return
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
                    ->filterByOutletOrgData($this)
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
            $dayplanRemoved->setOutletOrgData(null);
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
                ->filterByOutletOrgData($this)
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
        $dayplan->setOutletOrgData($this);
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
            $dayplan->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Clears out the collEdFeedbackss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdFeedbackss()
     */
    public function clearEdFeedbackss()
    {
        $this->collEdFeedbackss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdFeedbackss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdFeedbackss($v = true): void
    {
        $this->collEdFeedbackssPartial = $v;
    }

    /**
     * Initializes the collEdFeedbackss collection.
     *
     * By default this just sets the collEdFeedbackss collection to an empty array (like clearcollEdFeedbackss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdFeedbackss(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdFeedbackss && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdFeedbacksTableMap::getTableMap()->getCollectionClassName();

        $this->collEdFeedbackss = new $collectionClassName;
        $this->collEdFeedbackss->setModel('\entities\EdFeedbacks');
    }

    /**
     * Gets an array of ChildEdFeedbacks objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdFeedbacks[] List of ChildEdFeedbacks objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdFeedbacks> List of ChildEdFeedbacks objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdFeedbackss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdFeedbackssPartial && !$this->isNew();
        if (null === $this->collEdFeedbackss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdFeedbackss) {
                    $this->initEdFeedbackss();
                } else {
                    $collectionClassName = EdFeedbacksTableMap::getTableMap()->getCollectionClassName();

                    $collEdFeedbackss = new $collectionClassName;
                    $collEdFeedbackss->setModel('\entities\EdFeedbacks');

                    return $collEdFeedbackss;
                }
            } else {
                $collEdFeedbackss = ChildEdFeedbacksQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdFeedbackssPartial && count($collEdFeedbackss)) {
                        $this->initEdFeedbackss(false);

                        foreach ($collEdFeedbackss as $obj) {
                            if (false == $this->collEdFeedbackss->contains($obj)) {
                                $this->collEdFeedbackss->append($obj);
                            }
                        }

                        $this->collEdFeedbackssPartial = true;
                    }

                    return $collEdFeedbackss;
                }

                if ($partial && $this->collEdFeedbackss) {
                    foreach ($this->collEdFeedbackss as $obj) {
                        if ($obj->isNew()) {
                            $collEdFeedbackss[] = $obj;
                        }
                    }
                }

                $this->collEdFeedbackss = $collEdFeedbackss;
                $this->collEdFeedbackssPartial = false;
            }
        }

        return $this->collEdFeedbackss;
    }

    /**
     * Sets a collection of ChildEdFeedbacks objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edFeedbackss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdFeedbackss(Collection $edFeedbackss, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdFeedbacks[] $edFeedbackssToDelete */
        $edFeedbackssToDelete = $this->getEdFeedbackss(new Criteria(), $con)->diff($edFeedbackss);


        $this->edFeedbackssScheduledForDeletion = $edFeedbackssToDelete;

        foreach ($edFeedbackssToDelete as $edFeedbacksRemoved) {
            $edFeedbacksRemoved->setOutletOrgData(null);
        }

        $this->collEdFeedbackss = null;
        foreach ($edFeedbackss as $edFeedbacks) {
            $this->addEdFeedbacks($edFeedbacks);
        }

        $this->collEdFeedbackss = $edFeedbackss;
        $this->collEdFeedbackssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdFeedbacks objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdFeedbacks objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdFeedbackss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdFeedbackssPartial && !$this->isNew();
        if (null === $this->collEdFeedbackss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdFeedbackss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdFeedbackss());
            }

            $query = ChildEdFeedbacksQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collEdFeedbackss);
    }

    /**
     * Method called to associate a ChildEdFeedbacks object to this object
     * through the ChildEdFeedbacks foreign key attribute.
     *
     * @param ChildEdFeedbacks $l ChildEdFeedbacks
     * @return $this The current object (for fluent API support)
     */
    public function addEdFeedbacks(ChildEdFeedbacks $l)
    {
        if ($this->collEdFeedbackss === null) {
            $this->initEdFeedbackss();
            $this->collEdFeedbackssPartial = true;
        }

        if (!$this->collEdFeedbackss->contains($l)) {
            $this->doAddEdFeedbacks($l);

            if ($this->edFeedbackssScheduledForDeletion and $this->edFeedbackssScheduledForDeletion->contains($l)) {
                $this->edFeedbackssScheduledForDeletion->remove($this->edFeedbackssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdFeedbacks $edFeedbacks The ChildEdFeedbacks object to add.
     */
    protected function doAddEdFeedbacks(ChildEdFeedbacks $edFeedbacks): void
    {
        $this->collEdFeedbackss[]= $edFeedbacks;
        $edFeedbacks->setOutletOrgData($this);
    }

    /**
     * @param ChildEdFeedbacks $edFeedbacks The ChildEdFeedbacks object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdFeedbacks(ChildEdFeedbacks $edFeedbacks)
    {
        if ($this->getEdFeedbackss()->contains($edFeedbacks)) {
            $pos = $this->collEdFeedbackss->search($edFeedbacks);
            $this->collEdFeedbackss->remove($pos);
            if (null === $this->edFeedbackssScheduledForDeletion) {
                $this->edFeedbackssScheduledForDeletion = clone $this->collEdFeedbackss;
                $this->edFeedbackssScheduledForDeletion->clear();
            }
            $this->edFeedbackssScheduledForDeletion[]= $edFeedbacks;
            $edFeedbacks->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related EdFeedbackss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdFeedbacks[] List of ChildEdFeedbacks objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdFeedbacks}> List of ChildEdFeedbacks objects
     */
    public function getEdFeedbackssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdFeedbacksQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdFeedbackss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related EdFeedbackss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdFeedbacks[] List of ChildEdFeedbacks objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdFeedbacks}> List of ChildEdFeedbacks objects
     */
    public function getEdFeedbackssJoinEdPresentations(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdFeedbacksQuery::create(null, $criteria);
        $query->joinWith('EdPresentations', $joinBehavior);

        return $this->getEdFeedbackss($query, $con);
    }

    /**
     * Clears out the collEdSessions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdSessions()
     */
    public function clearEdSessions()
    {
        $this->collEdSessions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdSessions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdSessions($v = true): void
    {
        $this->collEdSessionsPartial = $v;
    }

    /**
     * Initializes the collEdSessions collection.
     *
     * By default this just sets the collEdSessions collection to an empty array (like clearcollEdSessions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdSessions(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdSessions && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdSessionTableMap::getTableMap()->getCollectionClassName();

        $this->collEdSessions = new $collectionClassName;
        $this->collEdSessions->setModel('\entities\EdSession');
    }

    /**
     * Gets an array of ChildEdSession objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdSession[] List of ChildEdSession objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdSession> List of ChildEdSession objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdSessions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdSessionsPartial && !$this->isNew();
        if (null === $this->collEdSessions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdSessions) {
                    $this->initEdSessions();
                } else {
                    $collectionClassName = EdSessionTableMap::getTableMap()->getCollectionClassName();

                    $collEdSessions = new $collectionClassName;
                    $collEdSessions->setModel('\entities\EdSession');

                    return $collEdSessions;
                }
            } else {
                $collEdSessions = ChildEdSessionQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdSessionsPartial && count($collEdSessions)) {
                        $this->initEdSessions(false);

                        foreach ($collEdSessions as $obj) {
                            if (false == $this->collEdSessions->contains($obj)) {
                                $this->collEdSessions->append($obj);
                            }
                        }

                        $this->collEdSessionsPartial = true;
                    }

                    return $collEdSessions;
                }

                if ($partial && $this->collEdSessions) {
                    foreach ($this->collEdSessions as $obj) {
                        if ($obj->isNew()) {
                            $collEdSessions[] = $obj;
                        }
                    }
                }

                $this->collEdSessions = $collEdSessions;
                $this->collEdSessionsPartial = false;
            }
        }

        return $this->collEdSessions;
    }

    /**
     * Sets a collection of ChildEdSession objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edSessions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdSessions(Collection $edSessions, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdSession[] $edSessionsToDelete */
        $edSessionsToDelete = $this->getEdSessions(new Criteria(), $con)->diff($edSessions);


        $this->edSessionsScheduledForDeletion = $edSessionsToDelete;

        foreach ($edSessionsToDelete as $edSessionRemoved) {
            $edSessionRemoved->setOutletOrgData(null);
        }

        $this->collEdSessions = null;
        foreach ($edSessions as $edSession) {
            $this->addEdSession($edSession);
        }

        $this->collEdSessions = $edSessions;
        $this->collEdSessionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdSession objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdSession objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdSessions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdSessionsPartial && !$this->isNew();
        if (null === $this->collEdSessions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdSessions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdSessions());
            }

            $query = ChildEdSessionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collEdSessions);
    }

    /**
     * Method called to associate a ChildEdSession object to this object
     * through the ChildEdSession foreign key attribute.
     *
     * @param ChildEdSession $l ChildEdSession
     * @return $this The current object (for fluent API support)
     */
    public function addEdSession(ChildEdSession $l)
    {
        if ($this->collEdSessions === null) {
            $this->initEdSessions();
            $this->collEdSessionsPartial = true;
        }

        if (!$this->collEdSessions->contains($l)) {
            $this->doAddEdSession($l);

            if ($this->edSessionsScheduledForDeletion and $this->edSessionsScheduledForDeletion->contains($l)) {
                $this->edSessionsScheduledForDeletion->remove($this->edSessionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdSession $edSession The ChildEdSession object to add.
     */
    protected function doAddEdSession(ChildEdSession $edSession): void
    {
        $this->collEdSessions[]= $edSession;
        $edSession->setOutletOrgData($this);
    }

    /**
     * @param ChildEdSession $edSession The ChildEdSession object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdSession(ChildEdSession $edSession)
    {
        if ($this->getEdSessions()->contains($edSession)) {
            $pos = $this->collEdSessions->search($edSession);
            $this->collEdSessions->remove($pos);
            if (null === $this->edSessionsScheduledForDeletion) {
                $this->edSessionsScheduledForDeletion = clone $this->collEdSessions;
                $this->edSessionsScheduledForDeletion->clear();
            }
            $this->edSessionsScheduledForDeletion[]= $edSession;
            $edSession->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related EdSessions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdSession[] List of ChildEdSession objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdSession}> List of ChildEdSession objects
     */
    public function getEdSessionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdSessionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdSessions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related EdSessions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdSession[] List of ChildEdSession objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdSession}> List of ChildEdSession objects
     */
    public function getEdSessionsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdSessionQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getEdSessions($query, $con);
    }

    /**
     * Clears out the collEdStatss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdStatss()
     */
    public function clearEdStatss()
    {
        $this->collEdStatss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdStatss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdStatss($v = true): void
    {
        $this->collEdStatssPartial = $v;
    }

    /**
     * Initializes the collEdStatss collection.
     *
     * By default this just sets the collEdStatss collection to an empty array (like clearcollEdStatss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdStatss(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdStatss && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdStatsTableMap::getTableMap()->getCollectionClassName();

        $this->collEdStatss = new $collectionClassName;
        $this->collEdStatss->setModel('\entities\EdStats');
    }

    /**
     * Gets an array of ChildEdStats objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats> List of ChildEdStats objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdStatss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdStatssPartial && !$this->isNew();
        if (null === $this->collEdStatss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdStatss) {
                    $this->initEdStatss();
                } else {
                    $collectionClassName = EdStatsTableMap::getTableMap()->getCollectionClassName();

                    $collEdStatss = new $collectionClassName;
                    $collEdStatss->setModel('\entities\EdStats');

                    return $collEdStatss;
                }
            } else {
                $collEdStatss = ChildEdStatsQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdStatssPartial && count($collEdStatss)) {
                        $this->initEdStatss(false);

                        foreach ($collEdStatss as $obj) {
                            if (false == $this->collEdStatss->contains($obj)) {
                                $this->collEdStatss->append($obj);
                            }
                        }

                        $this->collEdStatssPartial = true;
                    }

                    return $collEdStatss;
                }

                if ($partial && $this->collEdStatss) {
                    foreach ($this->collEdStatss as $obj) {
                        if ($obj->isNew()) {
                            $collEdStatss[] = $obj;
                        }
                    }
                }

                $this->collEdStatss = $collEdStatss;
                $this->collEdStatssPartial = false;
            }
        }

        return $this->collEdStatss;
    }

    /**
     * Sets a collection of ChildEdStats objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edStatss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdStatss(Collection $edStatss, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdStats[] $edStatssToDelete */
        $edStatssToDelete = $this->getEdStatss(new Criteria(), $con)->diff($edStatss);


        $this->edStatssScheduledForDeletion = $edStatssToDelete;

        foreach ($edStatssToDelete as $edStatsRemoved) {
            $edStatsRemoved->setOutletOrgData(null);
        }

        $this->collEdStatss = null;
        foreach ($edStatss as $edStats) {
            $this->addEdStats($edStats);
        }

        $this->collEdStatss = $edStatss;
        $this->collEdStatssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdStats objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdStats objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdStatss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdStatssPartial && !$this->isNew();
        if (null === $this->collEdStatss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdStatss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdStatss());
            }

            $query = ChildEdStatsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collEdStatss);
    }

    /**
     * Method called to associate a ChildEdStats object to this object
     * through the ChildEdStats foreign key attribute.
     *
     * @param ChildEdStats $l ChildEdStats
     * @return $this The current object (for fluent API support)
     */
    public function addEdStats(ChildEdStats $l)
    {
        if ($this->collEdStatss === null) {
            $this->initEdStatss();
            $this->collEdStatssPartial = true;
        }

        if (!$this->collEdStatss->contains($l)) {
            $this->doAddEdStats($l);

            if ($this->edStatssScheduledForDeletion and $this->edStatssScheduledForDeletion->contains($l)) {
                $this->edStatssScheduledForDeletion->remove($this->edStatssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdStats $edStats The ChildEdStats object to add.
     */
    protected function doAddEdStats(ChildEdStats $edStats): void
    {
        $this->collEdStatss[]= $edStats;
        $edStats->setOutletOrgData($this);
    }

    /**
     * @param ChildEdStats $edStats The ChildEdStats object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdStats(ChildEdStats $edStats)
    {
        if ($this->getEdStatss()->contains($edStats)) {
            $pos = $this->collEdStatss->search($edStats);
            $this->collEdStatss->remove($pos);
            if (null === $this->edStatssScheduledForDeletion) {
                $this->edStatssScheduledForDeletion = clone $this->collEdStatss;
                $this->edStatssScheduledForDeletion->clear();
            }
            $this->edStatssScheduledForDeletion[]= $edStats;
            $edStats->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats}> List of ChildEdStats objects
     */
    public function getEdStatssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdStatsQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getEdStatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats}> List of ChildEdStats objects
     */
    public function getEdStatssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdStatsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdStatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats}> List of ChildEdStats objects
     */
    public function getEdStatssJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdStatsQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getEdStatss($query, $con);
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
     * If this ChildOutletOrgData is new, it will return
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
                    ->filterByOutletOrgData($this)
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
            $onBoardRequestAddressRemoved->setOutletOrgData(null);
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
                ->filterByOutletOrgData($this)
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
        $onBoardRequestAddress->setOutletOrgData($this);
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
            $onBoardRequestAddress->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Clears out the collOutletOrgNotess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletOrgNotess()
     */
    public function clearOutletOrgNotess()
    {
        $this->collOutletOrgNotess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletOrgNotess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletOrgNotess($v = true): void
    {
        $this->collOutletOrgNotessPartial = $v;
    }

    /**
     * Initializes the collOutletOrgNotess collection.
     *
     * By default this just sets the collOutletOrgNotess collection to an empty array (like clearcollOutletOrgNotess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletOrgNotess(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletOrgNotess && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletOrgNotesTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletOrgNotess = new $collectionClassName;
        $this->collOutletOrgNotess->setModel('\entities\OutletOrgNotes');
    }

    /**
     * Gets an array of ChildOutletOrgNotes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletOrgNotes[] List of ChildOutletOrgNotes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgNotes> List of ChildOutletOrgNotes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletOrgNotess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletOrgNotessPartial && !$this->isNew();
        if (null === $this->collOutletOrgNotess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletOrgNotess) {
                    $this->initOutletOrgNotess();
                } else {
                    $collectionClassName = OutletOrgNotesTableMap::getTableMap()->getCollectionClassName();

                    $collOutletOrgNotess = new $collectionClassName;
                    $collOutletOrgNotess->setModel('\entities\OutletOrgNotes');

                    return $collOutletOrgNotess;
                }
            } else {
                $collOutletOrgNotess = ChildOutletOrgNotesQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletOrgNotessPartial && count($collOutletOrgNotess)) {
                        $this->initOutletOrgNotess(false);

                        foreach ($collOutletOrgNotess as $obj) {
                            if (false == $this->collOutletOrgNotess->contains($obj)) {
                                $this->collOutletOrgNotess->append($obj);
                            }
                        }

                        $this->collOutletOrgNotessPartial = true;
                    }

                    return $collOutletOrgNotess;
                }

                if ($partial && $this->collOutletOrgNotess) {
                    foreach ($this->collOutletOrgNotess as $obj) {
                        if ($obj->isNew()) {
                            $collOutletOrgNotess[] = $obj;
                        }
                    }
                }

                $this->collOutletOrgNotess = $collOutletOrgNotess;
                $this->collOutletOrgNotessPartial = false;
            }
        }

        return $this->collOutletOrgNotess;
    }

    /**
     * Sets a collection of ChildOutletOrgNotes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletOrgNotess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgNotess(Collection $outletOrgNotess, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletOrgNotes[] $outletOrgNotessToDelete */
        $outletOrgNotessToDelete = $this->getOutletOrgNotess(new Criteria(), $con)->diff($outletOrgNotess);


        $this->outletOrgNotessScheduledForDeletion = $outletOrgNotessToDelete;

        foreach ($outletOrgNotessToDelete as $outletOrgNotesRemoved) {
            $outletOrgNotesRemoved->setOutletOrgData(null);
        }

        $this->collOutletOrgNotess = null;
        foreach ($outletOrgNotess as $outletOrgNotes) {
            $this->addOutletOrgNotes($outletOrgNotes);
        }

        $this->collOutletOrgNotess = $outletOrgNotess;
        $this->collOutletOrgNotessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletOrgNotes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletOrgNotes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletOrgNotess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletOrgNotessPartial && !$this->isNew();
        if (null === $this->collOutletOrgNotess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletOrgNotess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletOrgNotess());
            }

            $query = ChildOutletOrgNotesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collOutletOrgNotess);
    }

    /**
     * Method called to associate a ChildOutletOrgNotes object to this object
     * through the ChildOutletOrgNotes foreign key attribute.
     *
     * @param ChildOutletOrgNotes $l ChildOutletOrgNotes
     * @return $this The current object (for fluent API support)
     */
    public function addOutletOrgNotes(ChildOutletOrgNotes $l)
    {
        if ($this->collOutletOrgNotess === null) {
            $this->initOutletOrgNotess();
            $this->collOutletOrgNotessPartial = true;
        }

        if (!$this->collOutletOrgNotess->contains($l)) {
            $this->doAddOutletOrgNotes($l);

            if ($this->outletOrgNotessScheduledForDeletion and $this->outletOrgNotessScheduledForDeletion->contains($l)) {
                $this->outletOrgNotessScheduledForDeletion->remove($this->outletOrgNotessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletOrgNotes $outletOrgNotes The ChildOutletOrgNotes object to add.
     */
    protected function doAddOutletOrgNotes(ChildOutletOrgNotes $outletOrgNotes): void
    {
        $this->collOutletOrgNotess[]= $outletOrgNotes;
        $outletOrgNotes->setOutletOrgData($this);
    }

    /**
     * @param ChildOutletOrgNotes $outletOrgNotes The ChildOutletOrgNotes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletOrgNotes(ChildOutletOrgNotes $outletOrgNotes)
    {
        if ($this->getOutletOrgNotess()->contains($outletOrgNotes)) {
            $pos = $this->collOutletOrgNotess->search($outletOrgNotes);
            $this->collOutletOrgNotess->remove($pos);
            if (null === $this->outletOrgNotessScheduledForDeletion) {
                $this->outletOrgNotessScheduledForDeletion = clone $this->collOutletOrgNotess;
                $this->outletOrgNotessScheduledForDeletion->clear();
            }
            $this->outletOrgNotessScheduledForDeletion[]= $outletOrgNotes;
            $outletOrgNotes->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletOrgNotess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgNotes[] List of ChildOutletOrgNotes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgNotes}> List of ChildOutletOrgNotes objects
     */
    public function getOutletOrgNotessJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgNotesQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOutletOrgNotess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletOrgNotess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgNotes[] List of ChildOutletOrgNotes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgNotes}> List of ChildOutletOrgNotes objects
     */
    public function getOutletOrgNotessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgNotesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletOrgNotess($query, $con);
    }

    /**
     * Clears out the collOutletStocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletStocks()
     */
    public function clearOutletStocks()
    {
        $this->collOutletStocks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletStocks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletStocks($v = true): void
    {
        $this->collOutletStocksPartial = $v;
    }

    /**
     * Initializes the collOutletStocks collection.
     *
     * By default this just sets the collOutletStocks collection to an empty array (like clearcollOutletStocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletStocks(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletStocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletStockTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletStocks = new $collectionClassName;
        $this->collOutletStocks->setModel('\entities\OutletStock');
    }

    /**
     * Gets an array of ChildOutletStock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock> List of ChildOutletStock objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletStocks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletStocksPartial && !$this->isNew();
        if (null === $this->collOutletStocks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletStocks) {
                    $this->initOutletStocks();
                } else {
                    $collectionClassName = OutletStockTableMap::getTableMap()->getCollectionClassName();

                    $collOutletStocks = new $collectionClassName;
                    $collOutletStocks->setModel('\entities\OutletStock');

                    return $collOutletStocks;
                }
            } else {
                $collOutletStocks = ChildOutletStockQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletStocksPartial && count($collOutletStocks)) {
                        $this->initOutletStocks(false);

                        foreach ($collOutletStocks as $obj) {
                            if (false == $this->collOutletStocks->contains($obj)) {
                                $this->collOutletStocks->append($obj);
                            }
                        }

                        $this->collOutletStocksPartial = true;
                    }

                    return $collOutletStocks;
                }

                if ($partial && $this->collOutletStocks) {
                    foreach ($this->collOutletStocks as $obj) {
                        if ($obj->isNew()) {
                            $collOutletStocks[] = $obj;
                        }
                    }
                }

                $this->collOutletStocks = $collOutletStocks;
                $this->collOutletStocksPartial = false;
            }
        }

        return $this->collOutletStocks;
    }

    /**
     * Sets a collection of ChildOutletStock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletStocks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletStocks(Collection $outletStocks, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletStock[] $outletStocksToDelete */
        $outletStocksToDelete = $this->getOutletStocks(new Criteria(), $con)->diff($outletStocks);


        $this->outletStocksScheduledForDeletion = $outletStocksToDelete;

        foreach ($outletStocksToDelete as $outletStockRemoved) {
            $outletStockRemoved->setOutletOrgData(null);
        }

        $this->collOutletStocks = null;
        foreach ($outletStocks as $outletStock) {
            $this->addOutletStock($outletStock);
        }

        $this->collOutletStocks = $outletStocks;
        $this->collOutletStocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletStock objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletStock objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletStocks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletStocksPartial && !$this->isNew();
        if (null === $this->collOutletStocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletStocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletStocks());
            }

            $query = ChildOutletStockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collOutletStocks);
    }

    /**
     * Method called to associate a ChildOutletStock object to this object
     * through the ChildOutletStock foreign key attribute.
     *
     * @param ChildOutletStock $l ChildOutletStock
     * @return $this The current object (for fluent API support)
     */
    public function addOutletStock(ChildOutletStock $l)
    {
        if ($this->collOutletStocks === null) {
            $this->initOutletStocks();
            $this->collOutletStocksPartial = true;
        }

        if (!$this->collOutletStocks->contains($l)) {
            $this->doAddOutletStock($l);

            if ($this->outletStocksScheduledForDeletion and $this->outletStocksScheduledForDeletion->contains($l)) {
                $this->outletStocksScheduledForDeletion->remove($this->outletStocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletStock $outletStock The ChildOutletStock object to add.
     */
    protected function doAddOutletStock(ChildOutletStock $outletStock): void
    {
        $this->collOutletStocks[]= $outletStock;
        $outletStock->setOutletOrgData($this);
    }

    /**
     * @param ChildOutletStock $outletStock The ChildOutletStock object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletStock(ChildOutletStock $outletStock)
    {
        if ($this->getOutletStocks()->contains($outletStock)) {
            $pos = $this->collOutletStocks->search($outletStock);
            $this->collOutletStocks->remove($pos);
            if (null === $this->outletStocksScheduledForDeletion) {
                $this->outletStocksScheduledForDeletion = clone $this->collOutletStocks;
                $this->outletStocksScheduledForDeletion->clear();
            }
            $this->outletStocksScheduledForDeletion[]= clone $outletStock;
            $outletStock->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOutletStocks($query, $con);
    }

    /**
     * Clears out the collOutletStockOtherSummaries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletStockOtherSummaries()
     */
    public function clearOutletStockOtherSummaries()
    {
        $this->collOutletStockOtherSummaries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletStockOtherSummaries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletStockOtherSummaries($v = true): void
    {
        $this->collOutletStockOtherSummariesPartial = $v;
    }

    /**
     * Initializes the collOutletStockOtherSummaries collection.
     *
     * By default this just sets the collOutletStockOtherSummaries collection to an empty array (like clearcollOutletStockOtherSummaries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletStockOtherSummaries(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletStockOtherSummaries && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletStockOtherSummaryTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletStockOtherSummaries = new $collectionClassName;
        $this->collOutletStockOtherSummaries->setModel('\entities\OutletStockOtherSummary');
    }

    /**
     * Gets an array of ChildOutletStockOtherSummary objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary> List of ChildOutletStockOtherSummary objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletStockOtherSummaries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletStockOtherSummariesPartial && !$this->isNew();
        if (null === $this->collOutletStockOtherSummaries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletStockOtherSummaries) {
                    $this->initOutletStockOtherSummaries();
                } else {
                    $collectionClassName = OutletStockOtherSummaryTableMap::getTableMap()->getCollectionClassName();

                    $collOutletStockOtherSummaries = new $collectionClassName;
                    $collOutletStockOtherSummaries->setModel('\entities\OutletStockOtherSummary');

                    return $collOutletStockOtherSummaries;
                }
            } else {
                $collOutletStockOtherSummaries = ChildOutletStockOtherSummaryQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletStockOtherSummariesPartial && count($collOutletStockOtherSummaries)) {
                        $this->initOutletStockOtherSummaries(false);

                        foreach ($collOutletStockOtherSummaries as $obj) {
                            if (false == $this->collOutletStockOtherSummaries->contains($obj)) {
                                $this->collOutletStockOtherSummaries->append($obj);
                            }
                        }

                        $this->collOutletStockOtherSummariesPartial = true;
                    }

                    return $collOutletStockOtherSummaries;
                }

                if ($partial && $this->collOutletStockOtherSummaries) {
                    foreach ($this->collOutletStockOtherSummaries as $obj) {
                        if ($obj->isNew()) {
                            $collOutletStockOtherSummaries[] = $obj;
                        }
                    }
                }

                $this->collOutletStockOtherSummaries = $collOutletStockOtherSummaries;
                $this->collOutletStockOtherSummariesPartial = false;
            }
        }

        return $this->collOutletStockOtherSummaries;
    }

    /**
     * Sets a collection of ChildOutletStockOtherSummary objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletStockOtherSummaries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletStockOtherSummaries(Collection $outletStockOtherSummaries, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletStockOtherSummary[] $outletStockOtherSummariesToDelete */
        $outletStockOtherSummariesToDelete = $this->getOutletStockOtherSummaries(new Criteria(), $con)->diff($outletStockOtherSummaries);


        $this->outletStockOtherSummariesScheduledForDeletion = $outletStockOtherSummariesToDelete;

        foreach ($outletStockOtherSummariesToDelete as $outletStockOtherSummaryRemoved) {
            $outletStockOtherSummaryRemoved->setOutletOrgData(null);
        }

        $this->collOutletStockOtherSummaries = null;
        foreach ($outletStockOtherSummaries as $outletStockOtherSummary) {
            $this->addOutletStockOtherSummary($outletStockOtherSummary);
        }

        $this->collOutletStockOtherSummaries = $outletStockOtherSummaries;
        $this->collOutletStockOtherSummariesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletStockOtherSummary objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletStockOtherSummary objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletStockOtherSummaries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletStockOtherSummariesPartial && !$this->isNew();
        if (null === $this->collOutletStockOtherSummaries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletStockOtherSummaries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletStockOtherSummaries());
            }

            $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collOutletStockOtherSummaries);
    }

    /**
     * Method called to associate a ChildOutletStockOtherSummary object to this object
     * through the ChildOutletStockOtherSummary foreign key attribute.
     *
     * @param ChildOutletStockOtherSummary $l ChildOutletStockOtherSummary
     * @return $this The current object (for fluent API support)
     */
    public function addOutletStockOtherSummary(ChildOutletStockOtherSummary $l)
    {
        if ($this->collOutletStockOtherSummaries === null) {
            $this->initOutletStockOtherSummaries();
            $this->collOutletStockOtherSummariesPartial = true;
        }

        if (!$this->collOutletStockOtherSummaries->contains($l)) {
            $this->doAddOutletStockOtherSummary($l);

            if ($this->outletStockOtherSummariesScheduledForDeletion and $this->outletStockOtherSummariesScheduledForDeletion->contains($l)) {
                $this->outletStockOtherSummariesScheduledForDeletion->remove($this->outletStockOtherSummariesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletStockOtherSummary $outletStockOtherSummary The ChildOutletStockOtherSummary object to add.
     */
    protected function doAddOutletStockOtherSummary(ChildOutletStockOtherSummary $outletStockOtherSummary): void
    {
        $this->collOutletStockOtherSummaries[]= $outletStockOtherSummary;
        $outletStockOtherSummary->setOutletOrgData($this);
    }

    /**
     * @param ChildOutletStockOtherSummary $outletStockOtherSummary The ChildOutletStockOtherSummary object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletStockOtherSummary(ChildOutletStockOtherSummary $outletStockOtherSummary)
    {
        if ($this->getOutletStockOtherSummaries()->contains($outletStockOtherSummary)) {
            $pos = $this->collOutletStockOtherSummaries->search($outletStockOtherSummary);
            $this->collOutletStockOtherSummaries->remove($pos);
            if (null === $this->outletStockOtherSummariesScheduledForDeletion) {
                $this->outletStockOtherSummariesScheduledForDeletion = clone $this->collOutletStockOtherSummaries;
                $this->outletStockOtherSummariesScheduledForDeletion->clear();
            }
            $this->outletStockOtherSummariesScheduledForDeletion[]= clone $outletStockOtherSummary;
            $outletStockOtherSummary->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }

    /**
     * Clears out the collOutletStockSummaries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletStockSummaries()
     */
    public function clearOutletStockSummaries()
    {
        $this->collOutletStockSummaries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletStockSummaries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletStockSummaries($v = true): void
    {
        $this->collOutletStockSummariesPartial = $v;
    }

    /**
     * Initializes the collOutletStockSummaries collection.
     *
     * By default this just sets the collOutletStockSummaries collection to an empty array (like clearcollOutletStockSummaries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletStockSummaries(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletStockSummaries && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletStockSummaryTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletStockSummaries = new $collectionClassName;
        $this->collOutletStockSummaries->setModel('\entities\OutletStockSummary');
    }

    /**
     * Gets an array of ChildOutletStockSummary objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary> List of ChildOutletStockSummary objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletStockSummaries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletStockSummariesPartial && !$this->isNew();
        if (null === $this->collOutletStockSummaries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletStockSummaries) {
                    $this->initOutletStockSummaries();
                } else {
                    $collectionClassName = OutletStockSummaryTableMap::getTableMap()->getCollectionClassName();

                    $collOutletStockSummaries = new $collectionClassName;
                    $collOutletStockSummaries->setModel('\entities\OutletStockSummary');

                    return $collOutletStockSummaries;
                }
            } else {
                $collOutletStockSummaries = ChildOutletStockSummaryQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletStockSummariesPartial && count($collOutletStockSummaries)) {
                        $this->initOutletStockSummaries(false);

                        foreach ($collOutletStockSummaries as $obj) {
                            if (false == $this->collOutletStockSummaries->contains($obj)) {
                                $this->collOutletStockSummaries->append($obj);
                            }
                        }

                        $this->collOutletStockSummariesPartial = true;
                    }

                    return $collOutletStockSummaries;
                }

                if ($partial && $this->collOutletStockSummaries) {
                    foreach ($this->collOutletStockSummaries as $obj) {
                        if ($obj->isNew()) {
                            $collOutletStockSummaries[] = $obj;
                        }
                    }
                }

                $this->collOutletStockSummaries = $collOutletStockSummaries;
                $this->collOutletStockSummariesPartial = false;
            }
        }

        return $this->collOutletStockSummaries;
    }

    /**
     * Sets a collection of ChildOutletStockSummary objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletStockSummaries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletStockSummaries(Collection $outletStockSummaries, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletStockSummary[] $outletStockSummariesToDelete */
        $outletStockSummariesToDelete = $this->getOutletStockSummaries(new Criteria(), $con)->diff($outletStockSummaries);


        $this->outletStockSummariesScheduledForDeletion = $outletStockSummariesToDelete;

        foreach ($outletStockSummariesToDelete as $outletStockSummaryRemoved) {
            $outletStockSummaryRemoved->setOutletOrgData(null);
        }

        $this->collOutletStockSummaries = null;
        foreach ($outletStockSummaries as $outletStockSummary) {
            $this->addOutletStockSummary($outletStockSummary);
        }

        $this->collOutletStockSummaries = $outletStockSummaries;
        $this->collOutletStockSummariesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletStockSummary objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletStockSummary objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletStockSummaries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletStockSummariesPartial && !$this->isNew();
        if (null === $this->collOutletStockSummaries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletStockSummaries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletStockSummaries());
            }

            $query = ChildOutletStockSummaryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collOutletStockSummaries);
    }

    /**
     * Method called to associate a ChildOutletStockSummary object to this object
     * through the ChildOutletStockSummary foreign key attribute.
     *
     * @param ChildOutletStockSummary $l ChildOutletStockSummary
     * @return $this The current object (for fluent API support)
     */
    public function addOutletStockSummary(ChildOutletStockSummary $l)
    {
        if ($this->collOutletStockSummaries === null) {
            $this->initOutletStockSummaries();
            $this->collOutletStockSummariesPartial = true;
        }

        if (!$this->collOutletStockSummaries->contains($l)) {
            $this->doAddOutletStockSummary($l);

            if ($this->outletStockSummariesScheduledForDeletion and $this->outletStockSummariesScheduledForDeletion->contains($l)) {
                $this->outletStockSummariesScheduledForDeletion->remove($this->outletStockSummariesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletStockSummary $outletStockSummary The ChildOutletStockSummary object to add.
     */
    protected function doAddOutletStockSummary(ChildOutletStockSummary $outletStockSummary): void
    {
        $this->collOutletStockSummaries[]= $outletStockSummary;
        $outletStockSummary->setOutletOrgData($this);
    }

    /**
     * @param ChildOutletStockSummary $outletStockSummary The ChildOutletStockSummary object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletStockSummary(ChildOutletStockSummary $outletStockSummary)
    {
        if ($this->getOutletStockSummaries()->contains($outletStockSummary)) {
            $pos = $this->collOutletStockSummaries->search($outletStockSummary);
            $this->collOutletStockSummaries->remove($pos);
            if (null === $this->outletStockSummariesScheduledForDeletion) {
                $this->outletStockSummariesScheduledForDeletion = clone $this->collOutletStockSummaries;
                $this->outletStockSummariesScheduledForDeletion->clear();
            }
            $this->outletStockSummariesScheduledForDeletion[]= clone $outletStockSummary;
            $outletStockSummary->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
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
     * If this ChildOutletOrgData is new, it will return
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
                    ->filterByOutletOrgData($this)
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
            $prescriberDataRemoved->setOutletOrgData(null);
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
                ->filterByOutletOrgData($this)
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
        $prescriberData->setOutletOrgData($this);
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
            $prescriberData->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Clears out the collReminderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addReminderss()
     */
    public function clearReminderss()
    {
        $this->collReminderss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collReminderss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialReminderss($v = true): void
    {
        $this->collReminderssPartial = $v;
    }

    /**
     * Initializes the collReminderss collection.
     *
     * By default this just sets the collReminderss collection to an empty array (like clearcollReminderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReminderss(bool $overrideExisting = true): void
    {
        if (null !== $this->collReminderss && !$overrideExisting) {
            return;
        }

        $collectionClassName = RemindersTableMap::getTableMap()->getCollectionClassName();

        $this->collReminderss = new $collectionClassName;
        $this->collReminderss->setModel('\entities\Reminders');
    }

    /**
     * Gets an array of ChildReminders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReminders[] List of ChildReminders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReminders> List of ChildReminders objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getReminderss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collReminderssPartial && !$this->isNew();
        if (null === $this->collReminderss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReminderss) {
                    $this->initReminderss();
                } else {
                    $collectionClassName = RemindersTableMap::getTableMap()->getCollectionClassName();

                    $collReminderss = new $collectionClassName;
                    $collReminderss->setModel('\entities\Reminders');

                    return $collReminderss;
                }
            } else {
                $collReminderss = ChildRemindersQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReminderssPartial && count($collReminderss)) {
                        $this->initReminderss(false);

                        foreach ($collReminderss as $obj) {
                            if (false == $this->collReminderss->contains($obj)) {
                                $this->collReminderss->append($obj);
                            }
                        }

                        $this->collReminderssPartial = true;
                    }

                    return $collReminderss;
                }

                if ($partial && $this->collReminderss) {
                    foreach ($this->collReminderss as $obj) {
                        if ($obj->isNew()) {
                            $collReminderss[] = $obj;
                        }
                    }
                }

                $this->collReminderss = $collReminderss;
                $this->collReminderssPartial = false;
            }
        }

        return $this->collReminderss;
    }

    /**
     * Sets a collection of ChildReminders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $reminderss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setReminderss(Collection $reminderss, ?ConnectionInterface $con = null)
    {
        /** @var ChildReminders[] $reminderssToDelete */
        $reminderssToDelete = $this->getReminderss(new Criteria(), $con)->diff($reminderss);


        $this->reminderssScheduledForDeletion = $reminderssToDelete;

        foreach ($reminderssToDelete as $remindersRemoved) {
            $remindersRemoved->setOutletOrgData(null);
        }

        $this->collReminderss = null;
        foreach ($reminderss as $reminders) {
            $this->addReminders($reminders);
        }

        $this->collReminderss = $reminderss;
        $this->collReminderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Reminders objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Reminders objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countReminderss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collReminderssPartial && !$this->isNew();
        if (null === $this->collReminderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReminderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReminderss());
            }

            $query = ChildRemindersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collReminderss);
    }

    /**
     * Method called to associate a ChildReminders object to this object
     * through the ChildReminders foreign key attribute.
     *
     * @param ChildReminders $l ChildReminders
     * @return $this The current object (for fluent API support)
     */
    public function addReminders(ChildReminders $l)
    {
        if ($this->collReminderss === null) {
            $this->initReminderss();
            $this->collReminderssPartial = true;
        }

        if (!$this->collReminderss->contains($l)) {
            $this->doAddReminders($l);

            if ($this->reminderssScheduledForDeletion and $this->reminderssScheduledForDeletion->contains($l)) {
                $this->reminderssScheduledForDeletion->remove($this->reminderssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReminders $reminders The ChildReminders object to add.
     */
    protected function doAddReminders(ChildReminders $reminders): void
    {
        $this->collReminderss[]= $reminders;
        $reminders->setOutletOrgData($this);
    }

    /**
     * @param ChildReminders $reminders The ChildReminders object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeReminders(ChildReminders $reminders)
    {
        if ($this->getReminderss()->contains($reminders)) {
            $pos = $this->collReminderss->search($reminders);
            $this->collReminderss->remove($pos);
            if (null === $this->reminderssScheduledForDeletion) {
                $this->reminderssScheduledForDeletion = clone $this->collReminderss;
                $this->reminderssScheduledForDeletion->clear();
            }
            $this->reminderssScheduledForDeletion[]= clone $reminders;
            $reminders->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Reminderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReminders[] List of ChildReminders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReminders}> List of ChildReminders objects
     */
    public function getReminderssJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRemindersQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getReminderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Reminderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReminders[] List of ChildReminders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReminders}> List of ChildReminders objects
     */
    public function getReminderssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRemindersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getReminderss($query, $con);
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
     * If this ChildOutletOrgData is new, it will return
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
                    ->filterByOutletOrgData($this)
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
            $tourplansRemoved->setOutletOrgData(null);
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
                ->filterByOutletOrgData($this)
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
        $tourplans->setOutletOrgData($this);
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
            $tourplans->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
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
     * Clears out the collOutletOrgDataKeyss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletOrgDataKeyss()
     */
    public function clearOutletOrgDataKeyss()
    {
        $this->collOutletOrgDataKeyss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletOrgDataKeyss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletOrgDataKeyss($v = true): void
    {
        $this->collOutletOrgDataKeyssPartial = $v;
    }

    /**
     * Initializes the collOutletOrgDataKeyss collection.
     *
     * By default this just sets the collOutletOrgDataKeyss collection to an empty array (like clearcollOutletOrgDataKeyss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletOrgDataKeyss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletOrgDataKeyss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletOrgDataKeysTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletOrgDataKeyss = new $collectionClassName;
        $this->collOutletOrgDataKeyss->setModel('\entities\OutletOrgDataKeys');
    }

    /**
     * Gets an array of ChildOutletOrgDataKeys objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutletOrgData is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletOrgDataKeys[] List of ChildOutletOrgDataKeys objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgDataKeys> List of ChildOutletOrgDataKeys objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletOrgDataKeyss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletOrgDataKeyssPartial && !$this->isNew();
        if (null === $this->collOutletOrgDataKeyss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletOrgDataKeyss) {
                    $this->initOutletOrgDataKeyss();
                } else {
                    $collectionClassName = OutletOrgDataKeysTableMap::getTableMap()->getCollectionClassName();

                    $collOutletOrgDataKeyss = new $collectionClassName;
                    $collOutletOrgDataKeyss->setModel('\entities\OutletOrgDataKeys');

                    return $collOutletOrgDataKeyss;
                }
            } else {
                $collOutletOrgDataKeyss = ChildOutletOrgDataKeysQuery::create(null, $criteria)
                    ->filterByOutletOrgData($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletOrgDataKeyssPartial && count($collOutletOrgDataKeyss)) {
                        $this->initOutletOrgDataKeyss(false);

                        foreach ($collOutletOrgDataKeyss as $obj) {
                            if (false == $this->collOutletOrgDataKeyss->contains($obj)) {
                                $this->collOutletOrgDataKeyss->append($obj);
                            }
                        }

                        $this->collOutletOrgDataKeyssPartial = true;
                    }

                    return $collOutletOrgDataKeyss;
                }

                if ($partial && $this->collOutletOrgDataKeyss) {
                    foreach ($this->collOutletOrgDataKeyss as $obj) {
                        if ($obj->isNew()) {
                            $collOutletOrgDataKeyss[] = $obj;
                        }
                    }
                }

                $this->collOutletOrgDataKeyss = $collOutletOrgDataKeyss;
                $this->collOutletOrgDataKeyssPartial = false;
            }
        }

        return $this->collOutletOrgDataKeyss;
    }

    /**
     * Sets a collection of ChildOutletOrgDataKeys objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletOrgDataKeyss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgDataKeyss(Collection $outletOrgDataKeyss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletOrgDataKeys[] $outletOrgDataKeyssToDelete */
        $outletOrgDataKeyssToDelete = $this->getOutletOrgDataKeyss(new Criteria(), $con)->diff($outletOrgDataKeyss);


        $this->outletOrgDataKeyssScheduledForDeletion = $outletOrgDataKeyssToDelete;

        foreach ($outletOrgDataKeyssToDelete as $outletOrgDataKeysRemoved) {
            $outletOrgDataKeysRemoved->setOutletOrgData(null);
        }

        $this->collOutletOrgDataKeyss = null;
        foreach ($outletOrgDataKeyss as $outletOrgDataKeys) {
            $this->addOutletOrgDataKeys($outletOrgDataKeys);
        }

        $this->collOutletOrgDataKeyss = $outletOrgDataKeyss;
        $this->collOutletOrgDataKeyssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletOrgDataKeys objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletOrgDataKeys objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletOrgDataKeyss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletOrgDataKeyssPartial && !$this->isNew();
        if (null === $this->collOutletOrgDataKeyss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletOrgDataKeyss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletOrgDataKeyss());
            }

            $query = ChildOutletOrgDataKeysQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletOrgData($this)
                ->count($con);
        }

        return count($this->collOutletOrgDataKeyss);
    }

    /**
     * Method called to associate a ChildOutletOrgDataKeys object to this object
     * through the ChildOutletOrgDataKeys foreign key attribute.
     *
     * @param ChildOutletOrgDataKeys $l ChildOutletOrgDataKeys
     * @return $this The current object (for fluent API support)
     */
    public function addOutletOrgDataKeys(ChildOutletOrgDataKeys $l)
    {
        if ($this->collOutletOrgDataKeyss === null) {
            $this->initOutletOrgDataKeyss();
            $this->collOutletOrgDataKeyssPartial = true;
        }

        if (!$this->collOutletOrgDataKeyss->contains($l)) {
            $this->doAddOutletOrgDataKeys($l);

            if ($this->outletOrgDataKeyssScheduledForDeletion and $this->outletOrgDataKeyssScheduledForDeletion->contains($l)) {
                $this->outletOrgDataKeyssScheduledForDeletion->remove($this->outletOrgDataKeyssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletOrgDataKeys $outletOrgDataKeys The ChildOutletOrgDataKeys object to add.
     */
    protected function doAddOutletOrgDataKeys(ChildOutletOrgDataKeys $outletOrgDataKeys): void
    {
        $this->collOutletOrgDataKeyss[]= $outletOrgDataKeys;
        $outletOrgDataKeys->setOutletOrgData($this);
    }

    /**
     * @param ChildOutletOrgDataKeys $outletOrgDataKeys The ChildOutletOrgDataKeys object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletOrgDataKeys(ChildOutletOrgDataKeys $outletOrgDataKeys)
    {
        if ($this->getOutletOrgDataKeyss()->contains($outletOrgDataKeys)) {
            $pos = $this->collOutletOrgDataKeyss->search($outletOrgDataKeys);
            $this->collOutletOrgDataKeyss->remove($pos);
            if (null === $this->outletOrgDataKeyssScheduledForDeletion) {
                $this->outletOrgDataKeyssScheduledForDeletion = clone $this->collOutletOrgDataKeyss;
                $this->outletOrgDataKeyssScheduledForDeletion->clear();
            }
            $this->outletOrgDataKeyssScheduledForDeletion[]= clone $outletOrgDataKeys;
            $outletOrgDataKeys->setOutletOrgData(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OutletOrgData is new, it will return
     * an empty collection; or if this OutletOrgData has previously
     * been saved, it will retrieve related OutletOrgDataKeyss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OutletOrgData.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgDataKeys[] List of ChildOutletOrgDataKeys objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgDataKeys}> List of ChildOutletOrgDataKeys objects
     */
    public function getOutletOrgDataKeyssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgDataKeysQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletOrgDataKeyss($query, $con);
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
            $this->aCompany->removeOutletOrgData($this);
        }
        if (null !== $this->aOutlets) {
            $this->aOutlets->removeOutletOrgData($this);
        }
        if (null !== $this->aOutletAddress) {
            $this->aOutletAddress->removeOutletOrgData($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeOutletOrgData($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removeOutletOrgData($this);
        }
        $this->outlet_org_id = null;
        $this->outlet_id = null;
        $this->org_unit_id = null;
        $this->tags = null;
        $this->visit_fq = null;
        $this->comments = null;
        $this->org_potential = null;
        $this->brand_focus = null;
        $this->customer_fq = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->itownid = null;
        $this->default_address = null;
        $this->last_visit_date = null;
        $this->last_visit_employee = null;
        $this->outlet_org_code = null;
        $this->invested_amount = null;
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
            if ($this->collBeatOutletss) {
                foreach ($this->collBeatOutletss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandCampiagnDoctorss) {
                foreach ($this->collBrandCampiagnDoctorss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallss) {
                foreach ($this->collDailycallss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallsAttendeess) {
                foreach ($this->collDailycallsAttendeess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallsSgpiouts) {
                foreach ($this->collDailycallsSgpiouts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDayplans) {
                foreach ($this->collDayplans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdFeedbackss) {
                foreach ($this->collEdFeedbackss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdSessions) {
                foreach ($this->collEdSessions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdStatss) {
                foreach ($this->collEdStatss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestAddresses) {
                foreach ($this->collOnBoardRequestAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletOrgNotess) {
                foreach ($this->collOutletOrgNotess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletStocks) {
                foreach ($this->collOutletStocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletStockOtherSummaries) {
                foreach ($this->collOutletStockOtherSummaries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletStockSummaries) {
                foreach ($this->collOutletStockSummaries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPrescriberDatas) {
                foreach ($this->collPrescriberDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collReminderss) {
                foreach ($this->collReminderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTourplanss) {
                foreach ($this->collTourplanss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletOrgDataKeyss) {
                foreach ($this->collOutletOrgDataKeyss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBeatOutletss = null;
        $this->collBrandCampiagnDoctorss = null;
        $this->collDailycallss = null;
        $this->collDailycallsAttendeess = null;
        $this->collDailycallsSgpiouts = null;
        $this->collDayplans = null;
        $this->collEdFeedbackss = null;
        $this->collEdSessions = null;
        $this->collEdStatss = null;
        $this->collOnBoardRequestAddresses = null;
        $this->collOutletOrgNotess = null;
        $this->collOutletStocks = null;
        $this->collOutletStockOtherSummaries = null;
        $this->collOutletStockSummaries = null;
        $this->collPrescriberDatas = null;
        $this->collReminderss = null;
        $this->collTourplanss = null;
        $this->collOutletOrgDataKeyss = null;
        $this->aCompany = null;
        $this->aOutlets = null;
        $this->aOutletAddress = null;
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
        return (string) $this->exportTo(OutletOrgDataTableMap::DEFAULT_STRING_FORMAT);
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
