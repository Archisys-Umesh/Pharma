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
use entities\BrandRcpa as ChildBrandRcpa;
use entities\BrandRcpaQuery as ChildBrandRcpaQuery;
use entities\Classification as ChildClassification;
use entities\ClassificationQuery as ChildClassificationQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\CompetitionMapping as ChildCompetitionMapping;
use entities\CompetitionMappingQuery as ChildCompetitionMappingQuery;
use entities\DailycallsSgpiout as ChildDailycallsSgpiout;
use entities\DailycallsSgpioutQuery as ChildDailycallsSgpioutQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\OnBoardRequest as ChildOnBoardRequest;
use entities\OnBoardRequestQuery as ChildOnBoardRequestQuery;
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\OutletAccountDetails as ChildOutletAccountDetails;
use entities\OutletAccountDetailsQuery as ChildOutletAccountDetailsQuery;
use entities\OutletAddress as ChildOutletAddress;
use entities\OutletAddressQuery as ChildOutletAddressQuery;
use entities\OutletMapping as ChildOutletMapping;
use entities\OutletMappingQuery as ChildOutletMappingQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\OutletStock as ChildOutletStock;
use entities\OutletStockOtherSummary as ChildOutletStockOtherSummary;
use entities\OutletStockOtherSummaryQuery as ChildOutletStockOtherSummaryQuery;
use entities\OutletStockQuery as ChildOutletStockQuery;
use entities\OutletStockSummary as ChildOutletStockSummary;
use entities\OutletStockSummaryQuery as ChildOutletStockSummaryQuery;
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\StockTransaction as ChildStockTransaction;
use entities\StockTransactionQuery as ChildStockTransactionQuery;
use entities\SurveySubmited as ChildSurveySubmited;
use entities\SurveySubmitedQuery as ChildSurveySubmitedQuery;
use entities\Tickets as ChildTickets;
use entities\TicketsQuery as ChildTicketsQuery;
use entities\Map\BrandCampiagnDoctorsTableMap;
use entities\Map\BrandCampiagnVisitsTableMap;
use entities\Map\BrandRcpaTableMap;
use entities\Map\CompetitionMappingTableMap;
use entities\Map\DailycallsSgpioutTableMap;
use entities\Map\OnBoardRequestTableMap;
use entities\Map\OrdersTableMap;
use entities\Map\OutletAddressTableMap;
use entities\Map\OutletMappingTableMap;
use entities\Map\OutletOrgDataTableMap;
use entities\Map\OutletStockOtherSummaryTableMap;
use entities\Map\OutletStockSummaryTableMap;
use entities\Map\OutletStockTableMap;
use entities\Map\OutletsTableMap;
use entities\Map\StockTransactionTableMap;
use entities\Map\SurveySubmitedTableMap;
use entities\Map\TicketsTableMap;

/**
 * Base class that represents a row from the 'outlets' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Outlets implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OutletsTableMap';


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
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the outlet_media_id field.
     *
     * @var        string|null
     */
    protected $outlet_media_id;

    /**
     * The value for the outlet_name field.
     *
     * @var        string
     */
    protected $outlet_name;

    /**
     * The value for the outlet_code field.
     *
     * @var        string
     */
    protected $outlet_code;

    /**
     * The value for the outlet_email field.
     *
     * @var        string|null
     */
    protected $outlet_email;

    /**
     * The value for the outlet_salutation field.
     *
     * @var        string|null
     */
    protected $outlet_salutation;

    /**
     * The value for the outlet_classification field.
     *
     * @var        int|null
     */
    protected $outlet_classification;

    /**
     * The value for the outlet_opening_date field.
     *
     * @var        DateTime|null
     */
    protected $outlet_opening_date;

    /**
     * The value for the outlet_contact_name field.
     *
     * @var        string|null
     */
    protected $outlet_contact_name;

    /**
     * The value for the outlet_landlineno field.
     *
     * @var        string|null
     */
    protected $outlet_landlineno;

    /**
     * The value for the outlet_alt_landlineno field.
     *
     * @var        string|null
     */
    protected $outlet_alt_landlineno;

    /**
     * The value for the outlet_contact_bday field.
     *
     * @var        DateTime|null
     */
    protected $outlet_contact_bday;

    /**
     * The value for the outlet_contact_anniversary field.
     *
     * @var        DateTime|null
     */
    protected $outlet_contact_anniversary;

    /**
     * The value for the outlet_isd_code field.
     *
     * Note: this column has a database default value of: '+91'
     * @var        string
     */
    protected $outlet_isd_code;

    /**
     * The value for the outlet_contact_no field.
     *
     * @var        string|null
     */
    protected $outlet_contact_no;

    /**
     * The value for the outlet_alt_contact_no field.
     *
     * @var        string|null
     */
    protected $outlet_alt_contact_no;

    /**
     * The value for the outlet_status field.
     *
     * Note: this column has a database default value of: 'active'
     * @var        string
     */
    protected $outlet_status;

    /**
     * The value for the outlettype_id field.
     *
     * @var        int|null
     */
    protected $outlettype_id;

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
     * The value for the outlet_otp field.
     *
     * @var        string|null
     */
    protected $outlet_otp;

    /**
     * The value for the outlet_verified field.
     *
     * @var        int|null
     */
    protected $outlet_verified;

    /**
     * The value for the outlet_created_by field.
     *
     * @var        int|null
     */
    protected $outlet_created_by;

    /**
     * The value for the outlet_approved_by field.
     *
     * @var        int|null
     */
    protected $outlet_approved_by;

    /**
     * The value for the outlet_potential field.
     *
     * @var        string|null
     */
    protected $outlet_potential;

    /**
     * The value for the integration_id field.
     *
     * @var        string|null
     */
    protected $integration_id;

    /**
     * The value for the itownid field.
     *
     * @var        string|null
     */
    protected $itownid;

    /**
     * The value for the outlet_qualification field.
     *
     * @var        string|null
     */
    protected $outlet_qualification;

    /**
     * The value for the outlet_regno field.
     *
     * @var        string|null
     */
    protected $outlet_regno;

    /**
     * The value for the outlet_marital_status field.
     *
     * @var        string|null
     */
    protected $outlet_marital_status;

    /**
     * The value for the outlet_media field.
     *
     * @var        string|null
     */
    protected $outlet_media;

    /**
     * @var        ChildClassification
     */
    protected $aClassification;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOutletType
     */
    protected $aOutletType;

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
     * @var        ObjectCollection|ChildBrandRcpa[] Collection to store aggregation of ChildBrandRcpa objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandRcpa> Collection to store aggregation of ChildBrandRcpa objects.
     */
    protected $collBrandRcpas;
    protected $collBrandRcpasPartial;

    /**
     * @var        ObjectCollection|ChildCompetitionMapping[] Collection to store aggregation of ChildCompetitionMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCompetitionMapping> Collection to store aggregation of ChildCompetitionMapping objects.
     */
    protected $collCompetitionMappings;
    protected $collCompetitionMappingsPartial;

    /**
     * @var        ObjectCollection|ChildDailycallsSgpiout[] Collection to store aggregation of ChildDailycallsSgpiout objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsSgpiout> Collection to store aggregation of ChildDailycallsSgpiout objects.
     */
    protected $collDailycallsSgpiouts;
    protected $collDailycallsSgpioutsPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequests;
    protected $collOnBoardRequestsPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderssRelatedByOutletFrom;
    protected $collOrderssRelatedByOutletFromPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderssRelatedByOutletTo;
    protected $collOrderssRelatedByOutletToPartial;

    /**
     * @var        ChildOutletAccountDetails one-to-one related ChildOutletAccountDetails object
     */
    protected $singleOutletAccountDetails;

    /**
     * @var        ObjectCollection|ChildOutletAddress[] Collection to store aggregation of ChildOutletAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletAddress> Collection to store aggregation of ChildOutletAddress objects.
     */
    protected $collOutletAddresses;
    protected $collOutletAddressesPartial;

    /**
     * @var        ObjectCollection|ChildOutletMapping[] Collection to store aggregation of ChildOutletMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletMapping> Collection to store aggregation of ChildOutletMapping objects.
     */
    protected $collOutletMappings;
    protected $collOutletMappingsPartial;

    /**
     * @var        ObjectCollection|ChildOutletOrgData[] Collection to store aggregation of ChildOutletOrgData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgData> Collection to store aggregation of ChildOutletOrgData objects.
     */
    protected $collOutletOrgDatas;
    protected $collOutletOrgDatasPartial;

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
     * @var        ObjectCollection|ChildStockTransaction[] Collection to store aggregation of ChildStockTransaction objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStockTransaction> Collection to store aggregation of ChildStockTransaction objects.
     */
    protected $collStockTransactions;
    protected $collStockTransactionsPartial;

    /**
     * @var        ObjectCollection|ChildSurveySubmited[] Collection to store aggregation of ChildSurveySubmited objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmited> Collection to store aggregation of ChildSurveySubmited objects.
     */
    protected $collSurveySubmiteds;
    protected $collSurveySubmitedsPartial;

    /**
     * @var        ObjectCollection|ChildTickets[] Collection to store aggregation of ChildTickets objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTickets> Collection to store aggregation of ChildTickets objects.
     */
    protected $collTicketss;
    protected $collTicketssPartial;

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
     * @var ObjectCollection|ChildBrandRcpa[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandRcpa>
     */
    protected $brandRcpasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCompetitionMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCompetitionMapping>
     */
    protected $competitionMappingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycallsSgpiout[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsSgpiout>
     */
    protected $dailycallsSgpioutsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssRelatedByOutletFromScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssRelatedByOutletToScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletAddress>
     */
    protected $outletAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletMapping>
     */
    protected $outletMappingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletOrgData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgData>
     */
    protected $outletOrgDatasScheduledForDeletion = null;

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
     * @var ObjectCollection|ChildStockTransaction[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStockTransaction>
     */
    protected $stockTransactionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSurveySubmited[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmited>
     */
    protected $surveySubmitedsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTickets[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTickets>
     */
    protected $ticketssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->outlet_isd_code = '+91';
        $this->outlet_status = 'active';
    }

    /**
     * Initializes internal state of entities\Base\Outlets object.
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
     * Compares this with another <code>Outlets</code> instance.  If
     * <code>obj</code> is an instance of <code>Outlets</code>, delegates to
     * <code>equals(Outlets)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [outlet_media_id] column value.
     *
     * @return string|null
     */
    public function getOutletMediaId()
    {
        return $this->outlet_media_id;
    }

    /**
     * Get the [outlet_name] column value.
     *
     * @return string
     */
    public function getOutletName()
    {
        return $this->outlet_name;
    }

    /**
     * Get the [outlet_code] column value.
     *
     * @return string
     */
    public function getOutletCode()
    {
        return $this->outlet_code;
    }

    /**
     * Get the [outlet_email] column value.
     *
     * @return string|null
     */
    public function getOutletEmail()
    {
        return $this->outlet_email;
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
     * Get the [outlet_classification] column value.
     *
     * @return int|null
     */
    public function getOutletClassification()
    {
        return $this->outlet_classification;
    }

    /**
     * Get the [optionally formatted] temporal [outlet_opening_date] column value.
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
    public function getOutletOpeningDate($format = null)
    {
        if ($format === null) {
            return $this->outlet_opening_date;
        } else {
            return $this->outlet_opening_date instanceof \DateTimeInterface ? $this->outlet_opening_date->format($format) : null;
        }
    }

    /**
     * Get the [outlet_contact_name] column value.
     *
     * @return string|null
     */
    public function getOutletContactName()
    {
        return $this->outlet_contact_name;
    }

    /**
     * Get the [outlet_landlineno] column value.
     *
     * @return string|null
     */
    public function getOutletLandlineno()
    {
        return $this->outlet_landlineno;
    }

    /**
     * Get the [outlet_alt_landlineno] column value.
     *
     * @return string|null
     */
    public function getOutletAltLandlineno()
    {
        return $this->outlet_alt_landlineno;
    }

    /**
     * Get the [optionally formatted] temporal [outlet_contact_bday] column value.
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
    public function getOutletContactBday($format = null)
    {
        if ($format === null) {
            return $this->outlet_contact_bday;
        } else {
            return $this->outlet_contact_bday instanceof \DateTimeInterface ? $this->outlet_contact_bday->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [outlet_contact_anniversary] column value.
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
    public function getOutletContactAnniversary($format = null)
    {
        if ($format === null) {
            return $this->outlet_contact_anniversary;
        } else {
            return $this->outlet_contact_anniversary instanceof \DateTimeInterface ? $this->outlet_contact_anniversary->format($format) : null;
        }
    }

    /**
     * Get the [outlet_isd_code] column value.
     *
     * @return string
     */
    public function getOutletIsdCode()
    {
        return $this->outlet_isd_code;
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
     * Get the [outlet_alt_contact_no] column value.
     *
     * @return string|null
     */
    public function getOutletAltContactNo()
    {
        return $this->outlet_alt_contact_no;
    }

    /**
     * Get the [outlet_status] column value.
     *
     * @return string
     */
    public function getOutletStatus()
    {
        return $this->outlet_status;
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
     * Get the [outlet_otp] column value.
     *
     * @return string|null
     */
    public function getOutletOtp()
    {
        return $this->outlet_otp;
    }

    /**
     * Get the [outlet_verified] column value.
     *
     * @return int|null
     */
    public function getOutletVerified()
    {
        return $this->outlet_verified;
    }

    /**
     * Get the [outlet_created_by] column value.
     *
     * @return int|null
     */
    public function getOutletCreatedBy()
    {
        return $this->outlet_created_by;
    }

    /**
     * Get the [outlet_approved_by] column value.
     *
     * @return int|null
     */
    public function getOutletApprovedBy()
    {
        return $this->outlet_approved_by;
    }

    /**
     * Get the [outlet_potential] column value.
     *
     * @return string|null
     */
    public function getOutletPotential()
    {
        return $this->outlet_potential;
    }

    /**
     * Get the [integration_id] column value.
     *
     * @return string|null
     */
    public function getIntegrationId()
    {
        return $this->integration_id;
    }

    /**
     * Get the [itownid] column value.
     *
     * @return string|null
     */
    public function getItownid()
    {
        return $this->itownid;
    }

    /**
     * Get the [outlet_qualification] column value.
     *
     * @return string|null
     */
    public function getOutletQualification()
    {
        return $this->outlet_qualification;
    }

    /**
     * Get the [outlet_regno] column value.
     *
     * @return string|null
     */
    public function getOutletRegno()
    {
        return $this->outlet_regno;
    }

    /**
     * Get the [outlet_marital_status] column value.
     *
     * @return string|null
     */
    public function getOutletMaritalStatus()
    {
        return $this->outlet_marital_status;
    }

    /**
     * Get the [outlet_media] column value.
     *
     * @return string|null
     */
    public function getOutletMedia()
    {
        return $this->outlet_media;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[OutletsTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_media_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletMediaId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_media_id !== $v) {
            $this->outlet_media_id = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_MEDIA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_name !== $v) {
            $this->outlet_name = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_code] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_code !== $v) {
            $this->outlet_code = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_email] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_email !== $v) {
            $this->outlet_email = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_salutation] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletSalutation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_salutation !== $v) {
            $this->outlet_salutation = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_SALUTATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_classification] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletClassification($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_classification !== $v) {
            $this->outlet_classification = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_CLASSIFICATION] = true;
        }

        if ($this->aClassification !== null && $this->aClassification->getId() !== $v) {
            $this->aClassification = null;
        }

        return $this;
    }

    /**
     * Sets the value of [outlet_opening_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOpeningDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->outlet_opening_date !== null || $dt !== null) {
            if ($this->outlet_opening_date === null || $dt === null || $dt->format("Y-m-d") !== $this->outlet_opening_date->format("Y-m-d")) {
                $this->outlet_opening_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletsTableMap::COL_OUTLET_OPENING_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [outlet_contact_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletContactName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_contact_name !== $v) {
            $this->outlet_contact_name = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_CONTACT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_landlineno] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletLandlineno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_landlineno !== $v) {
            $this->outlet_landlineno = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_LANDLINENO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_alt_landlineno] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletAltLandlineno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_alt_landlineno !== $v) {
            $this->outlet_alt_landlineno = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_ALT_LANDLINENO] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [outlet_contact_bday] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setOutletContactBday($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->outlet_contact_bday !== null || $dt !== null) {
            if ($this->outlet_contact_bday === null || $dt === null || $dt->format("Y-m-d") !== $this->outlet_contact_bday->format("Y-m-d")) {
                $this->outlet_contact_bday = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletsTableMap::COL_OUTLET_CONTACT_BDAY] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [outlet_contact_anniversary] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setOutletContactAnniversary($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->outlet_contact_anniversary !== null || $dt !== null) {
            if ($this->outlet_contact_anniversary === null || $dt === null || $dt->format("Y-m-d") !== $this->outlet_contact_anniversary->format("Y-m-d")) {
                $this->outlet_contact_anniversary = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [outlet_isd_code] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletIsdCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_isd_code !== $v) {
            $this->outlet_isd_code = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_ISD_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_contact_no] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletContactNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_contact_no !== $v) {
            $this->outlet_contact_no = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_CONTACT_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_alt_contact_no] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletAltContactNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_alt_contact_no !== $v) {
            $this->outlet_alt_contact_no = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_status] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_status !== $v) {
            $this->outlet_status = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutlettypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlettype_id !== $v) {
            $this->outlettype_id = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLETTYPE_ID] = true;
        }

        if ($this->aOutletType !== null && $this->aOutletType->getOutlettypeId() !== $v) {
            $this->aOutletType = null;
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
            $this->modifiedColumns[OutletsTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[OutletsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[OutletsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [outlet_otp] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOtp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_otp !== $v) {
            $this->outlet_otp = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_OTP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_verified] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletVerified($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_verified !== $v) {
            $this->outlet_verified = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_VERIFIED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_created_by] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletCreatedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_created_by !== $v) {
            $this->outlet_created_by = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_CREATED_BY] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_approved_by] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletApprovedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_approved_by !== $v) {
            $this->outlet_approved_by = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_APPROVED_BY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_potential] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletPotential($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_potential !== $v) {
            $this->outlet_potential = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_POTENTIAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [integration_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntegrationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->integration_id !== $v) {
            $this->integration_id = $v;
            $this->modifiedColumns[OutletsTableMap::COL_INTEGRATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [itownid] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setItownid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->itownid !== $v) {
            $this->itownid = $v;
            $this->modifiedColumns[OutletsTableMap::COL_ITOWNID] = true;
        }

        if ($this->aGeoTowns !== null && $this->aGeoTowns->getItownid() !== $v) {
            $this->aGeoTowns = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_qualification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletQualification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_qualification !== $v) {
            $this->outlet_qualification = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_QUALIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_regno] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletRegno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_regno !== $v) {
            $this->outlet_regno = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_REGNO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_marital_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletMaritalStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_marital_status !== $v) {
            $this->outlet_marital_status = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_MARITAL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_media] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletMedia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_media !== $v) {
            $this->outlet_media = $v;
            $this->modifiedColumns[OutletsTableMap::COL_OUTLET_MEDIA] = true;
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
            if ($this->outlet_isd_code !== '+91') {
                return false;
            }

            if ($this->outlet_status !== 'active') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OutletsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OutletsTableMap::translateFieldName('OutletMediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_media_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OutletsTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OutletsTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OutletsTableMap::translateFieldName('OutletEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OutletsTableMap::translateFieldName('OutletSalutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_salutation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OutletsTableMap::translateFieldName('OutletClassification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_classification = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OutletsTableMap::translateFieldName('OutletOpeningDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_opening_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OutletsTableMap::translateFieldName('OutletContactName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OutletsTableMap::translateFieldName('OutletLandlineno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_landlineno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OutletsTableMap::translateFieldName('OutletAltLandlineno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_alt_landlineno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OutletsTableMap::translateFieldName('OutletContactBday', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_bday = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OutletsTableMap::translateFieldName('OutletContactAnniversary', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_anniversary = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OutletsTableMap::translateFieldName('OutletIsdCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_isd_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OutletsTableMap::translateFieldName('OutletContactNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OutletsTableMap::translateFieldName('OutletAltContactNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_alt_contact_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OutletsTableMap::translateFieldName('OutletStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OutletsTableMap::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : OutletsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : OutletsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : OutletsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : OutletsTableMap::translateFieldName('OutletOtp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_otp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : OutletsTableMap::translateFieldName('OutletVerified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_verified = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : OutletsTableMap::translateFieldName('OutletCreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_created_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : OutletsTableMap::translateFieldName('OutletApprovedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_approved_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : OutletsTableMap::translateFieldName('OutletPotential', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_potential = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : OutletsTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : OutletsTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : OutletsTableMap::translateFieldName('OutletQualification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_qualification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : OutletsTableMap::translateFieldName('OutletRegno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_regno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : OutletsTableMap::translateFieldName('OutletMaritalStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_marital_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : OutletsTableMap::translateFieldName('OutletMedia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_media = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 32; // 32 = OutletsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Outlets'), 0, $e);
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
        if ($this->aClassification !== null && $this->outlet_classification !== $this->aClassification->getId()) {
            $this->aClassification = null;
        }
        if ($this->aOutletType !== null && $this->outlettype_id !== $this->aOutletType->getOutlettypeId()) {
            $this->aOutletType = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aEmployee !== null && $this->outlet_created_by !== $this->aEmployee->getEmployeeId()) {
            $this->aEmployee = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OutletsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOutletsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aClassification = null;
            $this->aEmployee = null;
            $this->aCompany = null;
            $this->aOutletType = null;
            $this->aGeoTowns = null;
            $this->collBrandCampiagnDoctorss = null;

            $this->collBrandCampiagnVisitss = null;

            $this->collBrandRcpas = null;

            $this->collCompetitionMappings = null;

            $this->collDailycallsSgpiouts = null;

            $this->collOnBoardRequests = null;

            $this->collOrderssRelatedByOutletFrom = null;

            $this->collOrderssRelatedByOutletTo = null;

            $this->singleOutletAccountDetails = null;

            $this->collOutletAddresses = null;

            $this->collOutletMappings = null;

            $this->collOutletOrgDatas = null;

            $this->collOutletStocks = null;

            $this->collOutletStockOtherSummaries = null;

            $this->collOutletStockSummaries = null;

            $this->collStockTransactions = null;

            $this->collSurveySubmiteds = null;

            $this->collTicketss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Outlets::setDeleted()
     * @see Outlets::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOutletsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletsTableMap::DATABASE_NAME);
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
                OutletsTableMap::addInstanceToPool($this);
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

            if ($this->aClassification !== null) {
                if ($this->aClassification->isModified() || $this->aClassification->isNew()) {
                    $affectedRows += $this->aClassification->save($con);
                }
                $this->setClassification($this->aClassification);
            }

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aOutletType !== null) {
                if ($this->aOutletType->isModified() || $this->aOutletType->isNew()) {
                    $affectedRows += $this->aOutletType->save($con);
                }
                $this->setOutletType($this->aOutletType);
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

            if ($this->brandRcpasScheduledForDeletion !== null) {
                if (!$this->brandRcpasScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandRcpasScheduledForDeletion as $brandRcpa) {
                        // need to save related object because we set the relation to null
                        $brandRcpa->save($con);
                    }
                    $this->brandRcpasScheduledForDeletion = null;
                }
            }

            if ($this->collBrandRcpas !== null) {
                foreach ($this->collBrandRcpas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->competitionMappingsScheduledForDeletion !== null) {
                if (!$this->competitionMappingsScheduledForDeletion->isEmpty()) {
                    \entities\CompetitionMappingQuery::create()
                        ->filterByPrimaryKeys($this->competitionMappingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->competitionMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collCompetitionMappings !== null) {
                foreach ($this->collCompetitionMappings as $referrerFK) {
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

            if ($this->onBoardRequestsScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsScheduledForDeletion as $onBoardRequest) {
                        // need to save related object because we set the relation to null
                        $onBoardRequest->save($con);
                    }
                    $this->onBoardRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequests !== null) {
                foreach ($this->collOnBoardRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderssRelatedByOutletFromScheduledForDeletion !== null) {
                if (!$this->orderssRelatedByOutletFromScheduledForDeletion->isEmpty()) {
                    foreach ($this->orderssRelatedByOutletFromScheduledForDeletion as $ordersRelatedByOutletFrom) {
                        // need to save related object because we set the relation to null
                        $ordersRelatedByOutletFrom->save($con);
                    }
                    $this->orderssRelatedByOutletFromScheduledForDeletion = null;
                }
            }

            if ($this->collOrderssRelatedByOutletFrom !== null) {
                foreach ($this->collOrderssRelatedByOutletFrom as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderssRelatedByOutletToScheduledForDeletion !== null) {
                if (!$this->orderssRelatedByOutletToScheduledForDeletion->isEmpty()) {
                    foreach ($this->orderssRelatedByOutletToScheduledForDeletion as $ordersRelatedByOutletTo) {
                        // need to save related object because we set the relation to null
                        $ordersRelatedByOutletTo->save($con);
                    }
                    $this->orderssRelatedByOutletToScheduledForDeletion = null;
                }
            }

            if ($this->collOrderssRelatedByOutletTo !== null) {
                foreach ($this->collOrderssRelatedByOutletTo as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->singleOutletAccountDetails !== null) {
                if (!$this->singleOutletAccountDetails->isDeleted() && ($this->singleOutletAccountDetails->isNew() || $this->singleOutletAccountDetails->isModified())) {
                    $affectedRows += $this->singleOutletAccountDetails->save($con);
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

            if ($this->outletMappingsScheduledForDeletion !== null) {
                if (!$this->outletMappingsScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletMappingsScheduledForDeletion as $outletMapping) {
                        // need to save related object because we set the relation to null
                        $outletMapping->save($con);
                    }
                    $this->outletMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collOutletMappings !== null) {
                foreach ($this->collOutletMappings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletOrgDatasScheduledForDeletion !== null) {
                if (!$this->outletOrgDatasScheduledForDeletion->isEmpty()) {
                    \entities\OutletOrgDataQuery::create()
                        ->filterByPrimaryKeys($this->outletOrgDatasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->stockTransactionsScheduledForDeletion !== null) {
                if (!$this->stockTransactionsScheduledForDeletion->isEmpty()) {
                    \entities\StockTransactionQuery::create()
                        ->filterByPrimaryKeys($this->stockTransactionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockTransactionsScheduledForDeletion = null;
                }
            }

            if ($this->collStockTransactions !== null) {
                foreach ($this->collStockTransactions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->surveySubmitedsScheduledForDeletion !== null) {
                if (!$this->surveySubmitedsScheduledForDeletion->isEmpty()) {
                    foreach ($this->surveySubmitedsScheduledForDeletion as $surveySubmited) {
                        // need to save related object because we set the relation to null
                        $surveySubmited->save($con);
                    }
                    $this->surveySubmitedsScheduledForDeletion = null;
                }
            }

            if ($this->collSurveySubmiteds !== null) {
                foreach ($this->collSurveySubmiteds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ticketssScheduledForDeletion !== null) {
                if (!$this->ticketssScheduledForDeletion->isEmpty()) {
                    \entities\TicketsQuery::create()
                        ->filterByPrimaryKeys($this->ticketssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ticketssScheduledForDeletion = null;
                }
            }

            if ($this->collTicketss !== null) {
                foreach ($this->collTicketss as $referrerFK) {
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

        $this->modifiedColumns[OutletsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OutletsTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('outlets_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OutletsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_MEDIA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_media_id';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_name';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_code';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_email';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_SALUTATION)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_salutation';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CLASSIFICATION)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_classification';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_OPENING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_opening_date';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CONTACT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_contact_name';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_LANDLINENO)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_landlineno';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_ALT_LANDLINENO)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_alt_landlineno';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CONTACT_BDAY)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_contact_bday';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_contact_anniversary';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_ISD_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_isd_code';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CONTACT_NO)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_contact_no';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_alt_contact_no';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_status';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLETTYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlettype_id';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_OTP)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_otp';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_verified';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_created_by';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_APPROVED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_approved_by';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_POTENTIAL)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_potential';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_INTEGRATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'integration_id';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_QUALIFICATION)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_qualification';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_REGNO)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_regno';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_MARITAL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_marital_status';
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_MEDIA)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_media';
        }

        $sql = sprintf(
            'INSERT INTO outlets (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);

                        break;
                    case 'outlet_media_id':
                        $stmt->bindValue($identifier, $this->outlet_media_id, PDO::PARAM_STR);

                        break;
                    case 'outlet_name':
                        $stmt->bindValue($identifier, $this->outlet_name, PDO::PARAM_STR);

                        break;
                    case 'outlet_code':
                        $stmt->bindValue($identifier, $this->outlet_code, PDO::PARAM_STR);

                        break;
                    case 'outlet_email':
                        $stmt->bindValue($identifier, $this->outlet_email, PDO::PARAM_STR);

                        break;
                    case 'outlet_salutation':
                        $stmt->bindValue($identifier, $this->outlet_salutation, PDO::PARAM_STR);

                        break;
                    case 'outlet_classification':
                        $stmt->bindValue($identifier, $this->outlet_classification, PDO::PARAM_INT);

                        break;
                    case 'outlet_opening_date':
                        $stmt->bindValue($identifier, $this->outlet_opening_date ? $this->outlet_opening_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'outlet_contact_name':
                        $stmt->bindValue($identifier, $this->outlet_contact_name, PDO::PARAM_STR);

                        break;
                    case 'outlet_landlineno':
                        $stmt->bindValue($identifier, $this->outlet_landlineno, PDO::PARAM_STR);

                        break;
                    case 'outlet_alt_landlineno':
                        $stmt->bindValue($identifier, $this->outlet_alt_landlineno, PDO::PARAM_STR);

                        break;
                    case 'outlet_contact_bday':
                        $stmt->bindValue($identifier, $this->outlet_contact_bday ? $this->outlet_contact_bday->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'outlet_contact_anniversary':
                        $stmt->bindValue($identifier, $this->outlet_contact_anniversary ? $this->outlet_contact_anniversary->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'outlet_isd_code':
                        $stmt->bindValue($identifier, $this->outlet_isd_code, PDO::PARAM_STR);

                        break;
                    case 'outlet_contact_no':
                        $stmt->bindValue($identifier, $this->outlet_contact_no, PDO::PARAM_STR);

                        break;
                    case 'outlet_alt_contact_no':
                        $stmt->bindValue($identifier, $this->outlet_alt_contact_no, PDO::PARAM_STR);

                        break;
                    case 'outlet_status':
                        $stmt->bindValue($identifier, $this->outlet_status, PDO::PARAM_STR);

                        break;
                    case 'outlettype_id':
                        $stmt->bindValue($identifier, $this->outlettype_id, PDO::PARAM_INT);

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
                    case 'outlet_otp':
                        $stmt->bindValue($identifier, $this->outlet_otp, PDO::PARAM_INT);

                        break;
                    case 'outlet_verified':
                        $stmt->bindValue($identifier, $this->outlet_verified, PDO::PARAM_INT);

                        break;
                    case 'outlet_created_by':
                        $stmt->bindValue($identifier, $this->outlet_created_by, PDO::PARAM_INT);

                        break;
                    case 'outlet_approved_by':
                        $stmt->bindValue($identifier, $this->outlet_approved_by, PDO::PARAM_INT);

                        break;
                    case 'outlet_potential':
                        $stmt->bindValue($identifier, $this->outlet_potential, PDO::PARAM_STR);

                        break;
                    case 'integration_id':
                        $stmt->bindValue($identifier, $this->integration_id, PDO::PARAM_STR);

                        break;
                    case 'itownid':
                        $stmt->bindValue($identifier, $this->itownid, PDO::PARAM_INT);

                        break;
                    case 'outlet_qualification':
                        $stmt->bindValue($identifier, $this->outlet_qualification, PDO::PARAM_STR);

                        break;
                    case 'outlet_regno':
                        $stmt->bindValue($identifier, $this->outlet_regno, PDO::PARAM_STR);

                        break;
                    case 'outlet_marital_status':
                        $stmt->bindValue($identifier, $this->outlet_marital_status, PDO::PARAM_STR);

                        break;
                    case 'outlet_media':
                        $stmt->bindValue($identifier, $this->outlet_media, PDO::PARAM_STR);

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
        $pos = OutletsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getId();

            case 1:
                return $this->getOutletMediaId();

            case 2:
                return $this->getOutletName();

            case 3:
                return $this->getOutletCode();

            case 4:
                return $this->getOutletEmail();

            case 5:
                return $this->getOutletSalutation();

            case 6:
                return $this->getOutletClassification();

            case 7:
                return $this->getOutletOpeningDate();

            case 8:
                return $this->getOutletContactName();

            case 9:
                return $this->getOutletLandlineno();

            case 10:
                return $this->getOutletAltLandlineno();

            case 11:
                return $this->getOutletContactBday();

            case 12:
                return $this->getOutletContactAnniversary();

            case 13:
                return $this->getOutletIsdCode();

            case 14:
                return $this->getOutletContactNo();

            case 15:
                return $this->getOutletAltContactNo();

            case 16:
                return $this->getOutletStatus();

            case 17:
                return $this->getOutlettypeId();

            case 18:
                return $this->getCompanyId();

            case 19:
                return $this->getCreatedAt();

            case 20:
                return $this->getUpdatedAt();

            case 21:
                return $this->getOutletOtp();

            case 22:
                return $this->getOutletVerified();

            case 23:
                return $this->getOutletCreatedBy();

            case 24:
                return $this->getOutletApprovedBy();

            case 25:
                return $this->getOutletPotential();

            case 26:
                return $this->getIntegrationId();

            case 27:
                return $this->getItownid();

            case 28:
                return $this->getOutletQualification();

            case 29:
                return $this->getOutletRegno();

            case 30:
                return $this->getOutletMaritalStatus();

            case 31:
                return $this->getOutletMedia();

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
        if (isset($alreadyDumpedObjects['Outlets'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Outlets'][$this->hashCode()] = true;
        $keys = OutletsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getOutletMediaId(),
            $keys[2] => $this->getOutletName(),
            $keys[3] => $this->getOutletCode(),
            $keys[4] => $this->getOutletEmail(),
            $keys[5] => $this->getOutletSalutation(),
            $keys[6] => $this->getOutletClassification(),
            $keys[7] => $this->getOutletOpeningDate(),
            $keys[8] => $this->getOutletContactName(),
            $keys[9] => $this->getOutletLandlineno(),
            $keys[10] => $this->getOutletAltLandlineno(),
            $keys[11] => $this->getOutletContactBday(),
            $keys[12] => $this->getOutletContactAnniversary(),
            $keys[13] => $this->getOutletIsdCode(),
            $keys[14] => $this->getOutletContactNo(),
            $keys[15] => $this->getOutletAltContactNo(),
            $keys[16] => $this->getOutletStatus(),
            $keys[17] => $this->getOutlettypeId(),
            $keys[18] => $this->getCompanyId(),
            $keys[19] => $this->getCreatedAt(),
            $keys[20] => $this->getUpdatedAt(),
            $keys[21] => $this->getOutletOtp(),
            $keys[22] => $this->getOutletVerified(),
            $keys[23] => $this->getOutletCreatedBy(),
            $keys[24] => $this->getOutletApprovedBy(),
            $keys[25] => $this->getOutletPotential(),
            $keys[26] => $this->getIntegrationId(),
            $keys[27] => $this->getItownid(),
            $keys[28] => $this->getOutletQualification(),
            $keys[29] => $this->getOutletRegno(),
            $keys[30] => $this->getOutletMaritalStatus(),
            $keys[31] => $this->getOutletMedia(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d');
        }

        if ($result[$keys[19]] instanceof \DateTimeInterface) {
            $result[$keys[19]] = $result[$keys[19]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aClassification) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'classification';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'classification';
                        break;
                    default:
                        $key = 'Classification';
                }

                $result[$key] = $this->aClassification->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collBrandRcpas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandRcpas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_rcpas';
                        break;
                    default:
                        $key = 'BrandRcpas';
                }

                $result[$key] = $this->collBrandRcpas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCompetitionMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'competitionMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'competition_mappings';
                        break;
                    default:
                        $key = 'CompetitionMappings';
                }

                $result[$key] = $this->collCompetitionMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOnBoardRequests) {

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

                $result[$key] = $this->collOnBoardRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderssRelatedByOutletFrom) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderssRelatedByOutletFrom->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderssRelatedByOutletTo) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderssRelatedByOutletTo->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->singleOutletAccountDetails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletAccountDetails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_account_details';
                        break;
                    default:
                        $key = 'OutletAccountDetails';
                }

                $result[$key] = $this->singleOutletAccountDetails->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
            if (null !== $this->collOutletMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_mappings';
                        break;
                    default:
                        $key = 'OutletMappings';
                }

                $result[$key] = $this->collOutletMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collStockTransactions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stockTransactions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stock_transactions';
                        break;
                    default:
                        $key = 'StockTransactions';
                }

                $result[$key] = $this->collStockTransactions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSurveySubmiteds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveySubmiteds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'survey_submiteds';
                        break;
                    default:
                        $key = 'SurveySubmiteds';
                }

                $result[$key] = $this->collSurveySubmiteds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTicketss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ticketss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ticketss';
                        break;
                    default:
                        $key = 'Ticketss';
                }

                $result[$key] = $this->collTicketss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = OutletsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setId($value);
                break;
            case 1:
                $this->setOutletMediaId($value);
                break;
            case 2:
                $this->setOutletName($value);
                break;
            case 3:
                $this->setOutletCode($value);
                break;
            case 4:
                $this->setOutletEmail($value);
                break;
            case 5:
                $this->setOutletSalutation($value);
                break;
            case 6:
                $this->setOutletClassification($value);
                break;
            case 7:
                $this->setOutletOpeningDate($value);
                break;
            case 8:
                $this->setOutletContactName($value);
                break;
            case 9:
                $this->setOutletLandlineno($value);
                break;
            case 10:
                $this->setOutletAltLandlineno($value);
                break;
            case 11:
                $this->setOutletContactBday($value);
                break;
            case 12:
                $this->setOutletContactAnniversary($value);
                break;
            case 13:
                $this->setOutletIsdCode($value);
                break;
            case 14:
                $this->setOutletContactNo($value);
                break;
            case 15:
                $this->setOutletAltContactNo($value);
                break;
            case 16:
                $this->setOutletStatus($value);
                break;
            case 17:
                $this->setOutlettypeId($value);
                break;
            case 18:
                $this->setCompanyId($value);
                break;
            case 19:
                $this->setCreatedAt($value);
                break;
            case 20:
                $this->setUpdatedAt($value);
                break;
            case 21:
                $this->setOutletOtp($value);
                break;
            case 22:
                $this->setOutletVerified($value);
                break;
            case 23:
                $this->setOutletCreatedBy($value);
                break;
            case 24:
                $this->setOutletApprovedBy($value);
                break;
            case 25:
                $this->setOutletPotential($value);
                break;
            case 26:
                $this->setIntegrationId($value);
                break;
            case 27:
                $this->setItownid($value);
                break;
            case 28:
                $this->setOutletQualification($value);
                break;
            case 29:
                $this->setOutletRegno($value);
                break;
            case 30:
                $this->setOutletMaritalStatus($value);
                break;
            case 31:
                $this->setOutletMedia($value);
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
        $keys = OutletsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOutletMediaId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOutletName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setOutletCode($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setOutletEmail($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOutletSalutation($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setOutletClassification($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setOutletOpeningDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setOutletContactName($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setOutletLandlineno($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOutletAltLandlineno($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setOutletContactBday($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setOutletContactAnniversary($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setOutletIsdCode($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setOutletContactNo($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setOutletAltContactNo($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setOutletStatus($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setOutlettypeId($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCompanyId($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCreatedAt($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setUpdatedAt($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setOutletOtp($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setOutletVerified($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setOutletCreatedBy($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setOutletApprovedBy($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setOutletPotential($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setIntegrationId($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setItownid($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setOutletQualification($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setOutletRegno($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setOutletMaritalStatus($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setOutletMedia($arr[$keys[31]]);
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
        $criteria = new Criteria(OutletsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OutletsTableMap::COL_ID)) {
            $criteria->add(OutletsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_MEDIA_ID)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_MEDIA_ID, $this->outlet_media_id);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_NAME)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CODE)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_CODE, $this->outlet_code);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_EMAIL)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_EMAIL, $this->outlet_email);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_SALUTATION)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_SALUTATION, $this->outlet_salutation);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CLASSIFICATION)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_CLASSIFICATION, $this->outlet_classification);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_OPENING_DATE)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_OPENING_DATE, $this->outlet_opening_date);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CONTACT_NAME)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_CONTACT_NAME, $this->outlet_contact_name);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_LANDLINENO)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_LANDLINENO, $this->outlet_landlineno);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_ALT_LANDLINENO)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_ALT_LANDLINENO, $this->outlet_alt_landlineno);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CONTACT_BDAY)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_CONTACT_BDAY, $this->outlet_contact_bday);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $this->outlet_contact_anniversary);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_ISD_CODE)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_ISD_CODE, $this->outlet_isd_code);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CONTACT_NO)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_CONTACT_NO, $this->outlet_contact_no);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO, $this->outlet_alt_contact_no);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_STATUS)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_STATUS, $this->outlet_status);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLETTYPE_ID)) {
            $criteria->add(OutletsTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_COMPANY_ID)) {
            $criteria->add(OutletsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_CREATED_AT)) {
            $criteria->add(OutletsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_UPDATED_AT)) {
            $criteria->add(OutletsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_OTP)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_OTP, $this->outlet_otp);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_VERIFIED)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_VERIFIED, $this->outlet_verified);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_CREATED_BY)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_CREATED_BY, $this->outlet_created_by);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_APPROVED_BY)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_APPROVED_BY, $this->outlet_approved_by);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_POTENTIAL)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_POTENTIAL, $this->outlet_potential);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(OutletsTableMap::COL_INTEGRATION_ID, $this->integration_id);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_ITOWNID)) {
            $criteria->add(OutletsTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_QUALIFICATION)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_QUALIFICATION, $this->outlet_qualification);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_REGNO)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_REGNO, $this->outlet_regno);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_MARITAL_STATUS)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_MARITAL_STATUS, $this->outlet_marital_status);
        }
        if ($this->isColumnModified(OutletsTableMap::COL_OUTLET_MEDIA)) {
            $criteria->add(OutletsTableMap::COL_OUTLET_MEDIA, $this->outlet_media);
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
        $criteria = ChildOutletsQuery::create();
        $criteria->add(OutletsTableMap::COL_ID, $this->id);

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
        $validPk = null !== $this->getId();

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
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Outlets (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOutletMediaId($this->getOutletMediaId());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setOutletCode($this->getOutletCode());
        $copyObj->setOutletEmail($this->getOutletEmail());
        $copyObj->setOutletSalutation($this->getOutletSalutation());
        $copyObj->setOutletClassification($this->getOutletClassification());
        $copyObj->setOutletOpeningDate($this->getOutletOpeningDate());
        $copyObj->setOutletContactName($this->getOutletContactName());
        $copyObj->setOutletLandlineno($this->getOutletLandlineno());
        $copyObj->setOutletAltLandlineno($this->getOutletAltLandlineno());
        $copyObj->setOutletContactBday($this->getOutletContactBday());
        $copyObj->setOutletContactAnniversary($this->getOutletContactAnniversary());
        $copyObj->setOutletIsdCode($this->getOutletIsdCode());
        $copyObj->setOutletContactNo($this->getOutletContactNo());
        $copyObj->setOutletAltContactNo($this->getOutletAltContactNo());
        $copyObj->setOutletStatus($this->getOutletStatus());
        $copyObj->setOutlettypeId($this->getOutlettypeId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOutletOtp($this->getOutletOtp());
        $copyObj->setOutletVerified($this->getOutletVerified());
        $copyObj->setOutletCreatedBy($this->getOutletCreatedBy());
        $copyObj->setOutletApprovedBy($this->getOutletApprovedBy());
        $copyObj->setOutletPotential($this->getOutletPotential());
        $copyObj->setIntegrationId($this->getIntegrationId());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setOutletQualification($this->getOutletQualification());
        $copyObj->setOutletRegno($this->getOutletRegno());
        $copyObj->setOutletMaritalStatus($this->getOutletMaritalStatus());
        $copyObj->setOutletMedia($this->getOutletMedia());

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

            foreach ($this->getBrandRcpas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandRcpa($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompetitionMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompetitionMapping($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallsSgpiouts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycallsSgpiout($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderssRelatedByOutletFrom() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrdersRelatedByOutletFrom($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderssRelatedByOutletTo() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrdersRelatedByOutletTo($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getOutletAccountDetails();
            if ($relObj) {
                $copyObj->setOutletAccountDetails($relObj->copy($deepCopy));
            }

            foreach ($this->getOutletAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletMapping($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletOrgDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletOrgData($relObj->copy($deepCopy));
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

            foreach ($this->getStockTransactions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockTransaction($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSurveySubmiteds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSurveySubmited($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTicketss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTickets($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Outlets Clone of current object.
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
     * Declares an association between this object and a ChildClassification object.
     *
     * @param ChildClassification|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setClassification(ChildClassification $v = null)
    {
        if ($v === null) {
            $this->setOutletClassification(NULL);
        } else {
            $this->setOutletClassification($v->getId());
        }

        $this->aClassification = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildClassification object, it will not be re-added.
        if ($v !== null) {
            $v->addOutlets($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildClassification object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildClassification|null The associated ChildClassification object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getClassification(?ConnectionInterface $con = null)
    {
        if ($this->aClassification === null && ($this->outlet_classification != 0)) {
            $this->aClassification = ChildClassificationQuery::create()->findPk($this->outlet_classification, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aClassification->addOutletss($this);
             */
        }

        return $this->aClassification;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployee(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setOutletCreatedBy(NULL);
        } else {
            $this->setOutletCreatedBy($v->getEmployeeId());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addOutlets($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployee(?ConnectionInterface $con = null)
    {
        if ($this->aEmployee === null && ($this->outlet_created_by != 0)) {
            $this->aEmployee = ChildEmployeeQuery::create()->findPk($this->outlet_created_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployee->addOutletss($this);
             */
        }

        return $this->aEmployee;
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
            $v->addOutlets($this);
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
                $this->aCompany->addOutletss($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildOutletType object.
     *
     * @param ChildOutletType|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletType(ChildOutletType $v = null)
    {
        if ($v === null) {
            $this->setOutlettypeId(NULL);
        } else {
            $this->setOutlettypeId($v->getOutlettypeId());
        }

        $this->aOutletType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletType object, it will not be re-added.
        if ($v !== null) {
            $v->addOutlets($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletType|null The associated ChildOutletType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletType(?ConnectionInterface $con = null)
    {
        if ($this->aOutletType === null && ($this->outlettype_id != 0)) {
            $this->aOutletType = ChildOutletTypeQuery::create()->findPk($this->outlettype_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletType->addOutletss($this);
             */
        }

        return $this->aOutletType;
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
            $v->addOutlets($this);
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
        if ($this->aGeoTowns === null && (($this->itownid !== "" && $this->itownid !== null))) {
            $this->aGeoTowns = ChildGeoTownsQuery::create()->findPk($this->itownid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTowns->addOutletss($this);
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
        if ('BrandRcpa' === $relationName) {
            $this->initBrandRcpas();
            return;
        }
        if ('CompetitionMapping' === $relationName) {
            $this->initCompetitionMappings();
            return;
        }
        if ('DailycallsSgpiout' === $relationName) {
            $this->initDailycallsSgpiouts();
            return;
        }
        if ('OnBoardRequest' === $relationName) {
            $this->initOnBoardRequests();
            return;
        }
        if ('OrdersRelatedByOutletFrom' === $relationName) {
            $this->initOrderssRelatedByOutletFrom();
            return;
        }
        if ('OrdersRelatedByOutletTo' === $relationName) {
            $this->initOrderssRelatedByOutletTo();
            return;
        }
        if ('OutletAddress' === $relationName) {
            $this->initOutletAddresses();
            return;
        }
        if ('OutletMapping' === $relationName) {
            $this->initOutletMappings();
            return;
        }
        if ('OutletOrgData' === $relationName) {
            $this->initOutletOrgDatas();
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
        if ('StockTransaction' === $relationName) {
            $this->initStockTransactions();
            return;
        }
        if ('SurveySubmited' === $relationName) {
            $this->initSurveySubmiteds();
            return;
        }
        if ('Tickets' === $relationName) {
            $this->initTicketss();
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
     * If this ChildOutlets is new, it will return
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
                    ->filterByOutlets($this)
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
            $brandCampiagnDoctorsRemoved->setOutlets(null);
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
                ->filterByOutlets($this)
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
        $brandCampiagnDoctors->setOutlets($this);
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
            $brandCampiagnDoctors->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnDoctorss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * If this ChildOutlets is new, it will return
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
                    ->filterByOutlets($this)
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
            $brandCampiagnVisitsRemoved->setOutlets(null);
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
                ->filterByOutlets($this)
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
        $brandCampiagnVisits->setOutlets($this);
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
            $brandCampiagnVisits->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }

    /**
     * Clears out the collBrandRcpas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandRcpas()
     */
    public function clearBrandRcpas()
    {
        $this->collBrandRcpas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandRcpas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandRcpas($v = true): void
    {
        $this->collBrandRcpasPartial = $v;
    }

    /**
     * Initializes the collBrandRcpas collection.
     *
     * By default this just sets the collBrandRcpas collection to an empty array (like clearcollBrandRcpas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandRcpas(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandRcpas && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandRcpaTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandRcpas = new $collectionClassName;
        $this->collBrandRcpas->setModel('\entities\BrandRcpa');
    }

    /**
     * Gets an array of ChildBrandRcpa objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa> List of ChildBrandRcpa objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandRcpas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandRcpasPartial && !$this->isNew();
        if (null === $this->collBrandRcpas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandRcpas) {
                    $this->initBrandRcpas();
                } else {
                    $collectionClassName = BrandRcpaTableMap::getTableMap()->getCollectionClassName();

                    $collBrandRcpas = new $collectionClassName;
                    $collBrandRcpas->setModel('\entities\BrandRcpa');

                    return $collBrandRcpas;
                }
            } else {
                $collBrandRcpas = ChildBrandRcpaQuery::create(null, $criteria)
                    ->filterByOutlets($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandRcpasPartial && count($collBrandRcpas)) {
                        $this->initBrandRcpas(false);

                        foreach ($collBrandRcpas as $obj) {
                            if (false == $this->collBrandRcpas->contains($obj)) {
                                $this->collBrandRcpas->append($obj);
                            }
                        }

                        $this->collBrandRcpasPartial = true;
                    }

                    return $collBrandRcpas;
                }

                if ($partial && $this->collBrandRcpas) {
                    foreach ($this->collBrandRcpas as $obj) {
                        if ($obj->isNew()) {
                            $collBrandRcpas[] = $obj;
                        }
                    }
                }

                $this->collBrandRcpas = $collBrandRcpas;
                $this->collBrandRcpasPartial = false;
            }
        }

        return $this->collBrandRcpas;
    }

    /**
     * Sets a collection of ChildBrandRcpa objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandRcpas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandRcpas(Collection $brandRcpas, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandRcpa[] $brandRcpasToDelete */
        $brandRcpasToDelete = $this->getBrandRcpas(new Criteria(), $con)->diff($brandRcpas);


        $this->brandRcpasScheduledForDeletion = $brandRcpasToDelete;

        foreach ($brandRcpasToDelete as $brandRcpaRemoved) {
            $brandRcpaRemoved->setOutlets(null);
        }

        $this->collBrandRcpas = null;
        foreach ($brandRcpas as $brandRcpa) {
            $this->addBrandRcpa($brandRcpa);
        }

        $this->collBrandRcpas = $brandRcpas;
        $this->collBrandRcpasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandRcpa objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandRcpa objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandRcpas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandRcpasPartial && !$this->isNew();
        if (null === $this->collBrandRcpas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandRcpas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandRcpas());
            }

            $query = ChildBrandRcpaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutlets($this)
                ->count($con);
        }

        return count($this->collBrandRcpas);
    }

    /**
     * Method called to associate a ChildBrandRcpa object to this object
     * through the ChildBrandRcpa foreign key attribute.
     *
     * @param ChildBrandRcpa $l ChildBrandRcpa
     * @return $this The current object (for fluent API support)
     */
    public function addBrandRcpa(ChildBrandRcpa $l)
    {
        if ($this->collBrandRcpas === null) {
            $this->initBrandRcpas();
            $this->collBrandRcpasPartial = true;
        }

        if (!$this->collBrandRcpas->contains($l)) {
            $this->doAddBrandRcpa($l);

            if ($this->brandRcpasScheduledForDeletion and $this->brandRcpasScheduledForDeletion->contains($l)) {
                $this->brandRcpasScheduledForDeletion->remove($this->brandRcpasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandRcpa $brandRcpa The ChildBrandRcpa object to add.
     */
    protected function doAddBrandRcpa(ChildBrandRcpa $brandRcpa): void
    {
        $this->collBrandRcpas[]= $brandRcpa;
        $brandRcpa->setOutlets($this);
    }

    /**
     * @param ChildBrandRcpa $brandRcpa The ChildBrandRcpa object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandRcpa(ChildBrandRcpa $brandRcpa)
    {
        if ($this->getBrandRcpas()->contains($brandRcpa)) {
            $pos = $this->collBrandRcpas->search($brandRcpa);
            $this->collBrandRcpas->remove($pos);
            if (null === $this->brandRcpasScheduledForDeletion) {
                $this->brandRcpasScheduledForDeletion = clone $this->collBrandRcpas;
                $this->brandRcpasScheduledForDeletion->clear();
            }
            $this->brandRcpasScheduledForDeletion[]= $brandRcpa;
            $brandRcpa->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }

    /**
     * Clears out the collCompetitionMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompetitionMappings()
     */
    public function clearCompetitionMappings()
    {
        $this->collCompetitionMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompetitionMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompetitionMappings($v = true): void
    {
        $this->collCompetitionMappingsPartial = $v;
    }

    /**
     * Initializes the collCompetitionMappings collection.
     *
     * By default this just sets the collCompetitionMappings collection to an empty array (like clearcollCompetitionMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompetitionMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompetitionMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = CompetitionMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collCompetitionMappings = new $collectionClassName;
        $this->collCompetitionMappings->setModel('\entities\CompetitionMapping');
    }

    /**
     * Gets an array of ChildCompetitionMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping> List of ChildCompetitionMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompetitionMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompetitionMappingsPartial && !$this->isNew();
        if (null === $this->collCompetitionMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompetitionMappings) {
                    $this->initCompetitionMappings();
                } else {
                    $collectionClassName = CompetitionMappingTableMap::getTableMap()->getCollectionClassName();

                    $collCompetitionMappings = new $collectionClassName;
                    $collCompetitionMappings->setModel('\entities\CompetitionMapping');

                    return $collCompetitionMappings;
                }
            } else {
                $collCompetitionMappings = ChildCompetitionMappingQuery::create(null, $criteria)
                    ->filterByOutlets($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompetitionMappingsPartial && count($collCompetitionMappings)) {
                        $this->initCompetitionMappings(false);

                        foreach ($collCompetitionMappings as $obj) {
                            if (false == $this->collCompetitionMappings->contains($obj)) {
                                $this->collCompetitionMappings->append($obj);
                            }
                        }

                        $this->collCompetitionMappingsPartial = true;
                    }

                    return $collCompetitionMappings;
                }

                if ($partial && $this->collCompetitionMappings) {
                    foreach ($this->collCompetitionMappings as $obj) {
                        if ($obj->isNew()) {
                            $collCompetitionMappings[] = $obj;
                        }
                    }
                }

                $this->collCompetitionMappings = $collCompetitionMappings;
                $this->collCompetitionMappingsPartial = false;
            }
        }

        return $this->collCompetitionMappings;
    }

    /**
     * Sets a collection of ChildCompetitionMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $competitionMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompetitionMappings(Collection $competitionMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildCompetitionMapping[] $competitionMappingsToDelete */
        $competitionMappingsToDelete = $this->getCompetitionMappings(new Criteria(), $con)->diff($competitionMappings);


        $this->competitionMappingsScheduledForDeletion = $competitionMappingsToDelete;

        foreach ($competitionMappingsToDelete as $competitionMappingRemoved) {
            $competitionMappingRemoved->setOutlets(null);
        }

        $this->collCompetitionMappings = null;
        foreach ($competitionMappings as $competitionMapping) {
            $this->addCompetitionMapping($competitionMapping);
        }

        $this->collCompetitionMappings = $competitionMappings;
        $this->collCompetitionMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CompetitionMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related CompetitionMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompetitionMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompetitionMappingsPartial && !$this->isNew();
        if (null === $this->collCompetitionMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompetitionMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompetitionMappings());
            }

            $query = ChildCompetitionMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutlets($this)
                ->count($con);
        }

        return count($this->collCompetitionMappings);
    }

    /**
     * Method called to associate a ChildCompetitionMapping object to this object
     * through the ChildCompetitionMapping foreign key attribute.
     *
     * @param ChildCompetitionMapping $l ChildCompetitionMapping
     * @return $this The current object (for fluent API support)
     */
    public function addCompetitionMapping(ChildCompetitionMapping $l)
    {
        if ($this->collCompetitionMappings === null) {
            $this->initCompetitionMappings();
            $this->collCompetitionMappingsPartial = true;
        }

        if (!$this->collCompetitionMappings->contains($l)) {
            $this->doAddCompetitionMapping($l);

            if ($this->competitionMappingsScheduledForDeletion and $this->competitionMappingsScheduledForDeletion->contains($l)) {
                $this->competitionMappingsScheduledForDeletion->remove($this->competitionMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCompetitionMapping $competitionMapping The ChildCompetitionMapping object to add.
     */
    protected function doAddCompetitionMapping(ChildCompetitionMapping $competitionMapping): void
    {
        $this->collCompetitionMappings[]= $competitionMapping;
        $competitionMapping->setOutlets($this);
    }

    /**
     * @param ChildCompetitionMapping $competitionMapping The ChildCompetitionMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompetitionMapping(ChildCompetitionMapping $competitionMapping)
    {
        if ($this->getCompetitionMappings()->contains($competitionMapping)) {
            $pos = $this->collCompetitionMappings->search($competitionMapping);
            $this->collCompetitionMappings->remove($pos);
            if (null === $this->competitionMappingsScheduledForDeletion) {
                $this->competitionMappingsScheduledForDeletion = clone $this->collCompetitionMappings;
                $this->competitionMappingsScheduledForDeletion->clear();
            }
            $this->competitionMappingsScheduledForDeletion[]= clone $competitionMapping;
            $competitionMapping->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related CompetitionMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping}> List of ChildCompetitionMapping objects
     */
    public function getCompetitionMappingsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompetitionMappingQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getCompetitionMappings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related CompetitionMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping}> List of ChildCompetitionMapping objects
     */
    public function getCompetitionMappingsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompetitionMappingQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getCompetitionMappings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related CompetitionMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping}> List of ChildCompetitionMapping objects
     */
    public function getCompetitionMappingsJoinCompetitor(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompetitionMappingQuery::create(null, $criteria);
        $query->joinWith('Competitor', $joinBehavior);

        return $this->getCompetitionMappings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related CompetitionMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping}> List of ChildCompetitionMapping objects
     */
    public function getCompetitionMappingsJoinUnitmaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompetitionMappingQuery::create(null, $criteria);
        $query->joinWith('Unitmaster', $joinBehavior);

        return $this->getCompetitionMappings($query, $con);
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
     * If this ChildOutlets is new, it will return
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
                    ->filterByOutlets($this)
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
            $dailycallsSgpioutRemoved->setOutlets(null);
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
                ->filterByOutlets($this)
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
        $dailycallsSgpiout->setOutlets($this);
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
            $dailycallsSgpiout->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }

    /**
     * Clears out the collOnBoardRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequests()
     */
    public function clearOnBoardRequests()
    {
        $this->collOnBoardRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequests($v = true): void
    {
        $this->collOnBoardRequestsPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequests collection.
     *
     * By default this just sets the collOnBoardRequests collection to an empty array (like clearcollOnBoardRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequests = new $collectionClassName;
        $this->collOnBoardRequests->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequests) {
                    $this->initOnBoardRequests();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequests = new $collectionClassName;
                    $collOnBoardRequests->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequests;
                }
            } else {
                $collOnBoardRequests = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByOutlets($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsPartial && count($collOnBoardRequests)) {
                        $this->initOnBoardRequests(false);

                        foreach ($collOnBoardRequests as $obj) {
                            if (false == $this->collOnBoardRequests->contains($obj)) {
                                $this->collOnBoardRequests->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsPartial = true;
                    }

                    return $collOnBoardRequests;
                }

                if ($partial && $this->collOnBoardRequests) {
                    foreach ($this->collOnBoardRequests as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequests[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequests = $collOnBoardRequests;
                $this->collOnBoardRequestsPartial = false;
            }
        }

        return $this->collOnBoardRequests;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequests(Collection $onBoardRequests, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsToDelete */
        $onBoardRequestsToDelete = $this->getOnBoardRequests(new Criteria(), $con)->diff($onBoardRequests);


        $this->onBoardRequestsScheduledForDeletion = $onBoardRequestsToDelete;

        foreach ($onBoardRequestsToDelete as $onBoardRequestRemoved) {
            $onBoardRequestRemoved->setOutlets(null);
        }

        $this->collOnBoardRequests = null;
        foreach ($onBoardRequests as $onBoardRequest) {
            $this->addOnBoardRequest($onBoardRequest);
        }

        $this->collOnBoardRequests = $onBoardRequests;
        $this->collOnBoardRequestsPartial = false;

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
    public function countOnBoardRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequests());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutlets($this)
                ->count($con);
        }

        return count($this->collOnBoardRequests);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequest(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequests === null) {
            $this->initOnBoardRequests();
            $this->collOnBoardRequestsPartial = true;
        }

        if (!$this->collOnBoardRequests->contains($l)) {
            $this->doAddOnBoardRequest($l);

            if ($this->onBoardRequestsScheduledForDeletion and $this->onBoardRequestsScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsScheduledForDeletion->remove($this->onBoardRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequest The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequest(ChildOnBoardRequest $onBoardRequest): void
    {
        $this->collOnBoardRequests[]= $onBoardRequest;
        $onBoardRequest->setOutlets($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequest The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequest(ChildOnBoardRequest $onBoardRequest)
    {
        if ($this->getOnBoardRequests()->contains($onBoardRequest)) {
            $pos = $this->collOnBoardRequests->search($onBoardRequest);
            $this->collOnBoardRequests->remove($pos);
            if (null === $this->onBoardRequestsScheduledForDeletion) {
                $this->onBoardRequestsScheduledForDeletion = clone $this->collOnBoardRequests;
                $this->onBoardRequestsScheduledForDeletion->clear();
            }
            $this->onBoardRequestsScheduledForDeletion[]= $onBoardRequest;
            $onBoardRequest->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByCreatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByCreatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByCreatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByFinalApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByFinalApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPosition', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByUpdatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByUpdatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByUpdatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }

    /**
     * Clears out the collOrderssRelatedByOutletFrom collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderssRelatedByOutletFrom()
     */
    public function clearOrderssRelatedByOutletFrom()
    {
        $this->collOrderssRelatedByOutletFrom = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderssRelatedByOutletFrom collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderssRelatedByOutletFrom($v = true): void
    {
        $this->collOrderssRelatedByOutletFromPartial = $v;
    }

    /**
     * Initializes the collOrderssRelatedByOutletFrom collection.
     *
     * By default this just sets the collOrderssRelatedByOutletFrom collection to an empty array (like clearcollOrderssRelatedByOutletFrom());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderssRelatedByOutletFrom(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderssRelatedByOutletFrom && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderssRelatedByOutletFrom = new $collectionClassName;
        $this->collOrderssRelatedByOutletFrom->setModel('\entities\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderssRelatedByOutletFrom(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssRelatedByOutletFromPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByOutletFrom || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderssRelatedByOutletFrom) {
                    $this->initOrderssRelatedByOutletFrom();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderssRelatedByOutletFrom = new $collectionClassName;
                    $collOrderssRelatedByOutletFrom->setModel('\entities\Orders');

                    return $collOrderssRelatedByOutletFrom;
                }
            } else {
                $collOrderssRelatedByOutletFrom = ChildOrdersQuery::create(null, $criteria)
                    ->filterByOutletsRelatedByOutletFrom($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssRelatedByOutletFromPartial && count($collOrderssRelatedByOutletFrom)) {
                        $this->initOrderssRelatedByOutletFrom(false);

                        foreach ($collOrderssRelatedByOutletFrom as $obj) {
                            if (false == $this->collOrderssRelatedByOutletFrom->contains($obj)) {
                                $this->collOrderssRelatedByOutletFrom->append($obj);
                            }
                        }

                        $this->collOrderssRelatedByOutletFromPartial = true;
                    }

                    return $collOrderssRelatedByOutletFrom;
                }

                if ($partial && $this->collOrderssRelatedByOutletFrom) {
                    foreach ($this->collOrderssRelatedByOutletFrom as $obj) {
                        if ($obj->isNew()) {
                            $collOrderssRelatedByOutletFrom[] = $obj;
                        }
                    }
                }

                $this->collOrderssRelatedByOutletFrom = $collOrderssRelatedByOutletFrom;
                $this->collOrderssRelatedByOutletFromPartial = false;
            }
        }

        return $this->collOrderssRelatedByOutletFrom;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderssRelatedByOutletFrom A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderssRelatedByOutletFrom(Collection $orderssRelatedByOutletFrom, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssRelatedByOutletFromToDelete */
        $orderssRelatedByOutletFromToDelete = $this->getOrderssRelatedByOutletFrom(new Criteria(), $con)->diff($orderssRelatedByOutletFrom);


        $this->orderssRelatedByOutletFromScheduledForDeletion = $orderssRelatedByOutletFromToDelete;

        foreach ($orderssRelatedByOutletFromToDelete as $ordersRelatedByOutletFromRemoved) {
            $ordersRelatedByOutletFromRemoved->setOutletsRelatedByOutletFrom(null);
        }

        $this->collOrderssRelatedByOutletFrom = null;
        foreach ($orderssRelatedByOutletFrom as $ordersRelatedByOutletFrom) {
            $this->addOrdersRelatedByOutletFrom($ordersRelatedByOutletFrom);
        }

        $this->collOrderssRelatedByOutletFrom = $orderssRelatedByOutletFrom;
        $this->collOrderssRelatedByOutletFromPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Orders objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderssRelatedByOutletFrom(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderssRelatedByOutletFromPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByOutletFrom || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderssRelatedByOutletFrom) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderssRelatedByOutletFrom());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletsRelatedByOutletFrom($this)
                ->count($con);
        }

        return count($this->collOrderssRelatedByOutletFrom);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param ChildOrders $l ChildOrders
     * @return $this The current object (for fluent API support)
     */
    public function addOrdersRelatedByOutletFrom(ChildOrders $l)
    {
        if ($this->collOrderssRelatedByOutletFrom === null) {
            $this->initOrderssRelatedByOutletFrom();
            $this->collOrderssRelatedByOutletFromPartial = true;
        }

        if (!$this->collOrderssRelatedByOutletFrom->contains($l)) {
            $this->doAddOrdersRelatedByOutletFrom($l);

            if ($this->orderssRelatedByOutletFromScheduledForDeletion and $this->orderssRelatedByOutletFromScheduledForDeletion->contains($l)) {
                $this->orderssRelatedByOutletFromScheduledForDeletion->remove($this->orderssRelatedByOutletFromScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $ordersRelatedByOutletFrom The ChildOrders object to add.
     */
    protected function doAddOrdersRelatedByOutletFrom(ChildOrders $ordersRelatedByOutletFrom): void
    {
        $this->collOrderssRelatedByOutletFrom[]= $ordersRelatedByOutletFrom;
        $ordersRelatedByOutletFrom->setOutletsRelatedByOutletFrom($this);
    }

    /**
     * @param ChildOrders $ordersRelatedByOutletFrom The ChildOrders object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrdersRelatedByOutletFrom(ChildOrders $ordersRelatedByOutletFrom)
    {
        if ($this->getOrderssRelatedByOutletFrom()->contains($ordersRelatedByOutletFrom)) {
            $pos = $this->collOrderssRelatedByOutletFrom->search($ordersRelatedByOutletFrom);
            $this->collOrderssRelatedByOutletFrom->remove($pos);
            if (null === $this->orderssRelatedByOutletFromScheduledForDeletion) {
                $this->orderssRelatedByOutletFromScheduledForDeletion = clone $this->collOrderssRelatedByOutletFrom;
                $this->orderssRelatedByOutletFromScheduledForDeletion->clear();
            }
            $this->orderssRelatedByOutletFromScheduledForDeletion[]= $ordersRelatedByOutletFrom;
            $ordersRelatedByOutletFrom->setOutletsRelatedByOutletFrom(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletFrom from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletFromJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderssRelatedByOutletFrom($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletFrom from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletFromJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getOrderssRelatedByOutletFrom($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletFrom from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletFromJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOrderssRelatedByOutletFrom($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletFrom from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletFromJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOrderssRelatedByOutletFrom($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletFrom from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletFromJoinPricebooks(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Pricebooks', $joinBehavior);

        return $this->getOrderssRelatedByOutletFrom($query, $con);
    }

    /**
     * Clears out the collOrderssRelatedByOutletTo collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderssRelatedByOutletTo()
     */
    public function clearOrderssRelatedByOutletTo()
    {
        $this->collOrderssRelatedByOutletTo = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderssRelatedByOutletTo collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderssRelatedByOutletTo($v = true): void
    {
        $this->collOrderssRelatedByOutletToPartial = $v;
    }

    /**
     * Initializes the collOrderssRelatedByOutletTo collection.
     *
     * By default this just sets the collOrderssRelatedByOutletTo collection to an empty array (like clearcollOrderssRelatedByOutletTo());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderssRelatedByOutletTo(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderssRelatedByOutletTo && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderssRelatedByOutletTo = new $collectionClassName;
        $this->collOrderssRelatedByOutletTo->setModel('\entities\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderssRelatedByOutletTo(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssRelatedByOutletToPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByOutletTo || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderssRelatedByOutletTo) {
                    $this->initOrderssRelatedByOutletTo();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderssRelatedByOutletTo = new $collectionClassName;
                    $collOrderssRelatedByOutletTo->setModel('\entities\Orders');

                    return $collOrderssRelatedByOutletTo;
                }
            } else {
                $collOrderssRelatedByOutletTo = ChildOrdersQuery::create(null, $criteria)
                    ->filterByOutletsRelatedByOutletTo($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssRelatedByOutletToPartial && count($collOrderssRelatedByOutletTo)) {
                        $this->initOrderssRelatedByOutletTo(false);

                        foreach ($collOrderssRelatedByOutletTo as $obj) {
                            if (false == $this->collOrderssRelatedByOutletTo->contains($obj)) {
                                $this->collOrderssRelatedByOutletTo->append($obj);
                            }
                        }

                        $this->collOrderssRelatedByOutletToPartial = true;
                    }

                    return $collOrderssRelatedByOutletTo;
                }

                if ($partial && $this->collOrderssRelatedByOutletTo) {
                    foreach ($this->collOrderssRelatedByOutletTo as $obj) {
                        if ($obj->isNew()) {
                            $collOrderssRelatedByOutletTo[] = $obj;
                        }
                    }
                }

                $this->collOrderssRelatedByOutletTo = $collOrderssRelatedByOutletTo;
                $this->collOrderssRelatedByOutletToPartial = false;
            }
        }

        return $this->collOrderssRelatedByOutletTo;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderssRelatedByOutletTo A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderssRelatedByOutletTo(Collection $orderssRelatedByOutletTo, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssRelatedByOutletToToDelete */
        $orderssRelatedByOutletToToDelete = $this->getOrderssRelatedByOutletTo(new Criteria(), $con)->diff($orderssRelatedByOutletTo);


        $this->orderssRelatedByOutletToScheduledForDeletion = $orderssRelatedByOutletToToDelete;

        foreach ($orderssRelatedByOutletToToDelete as $ordersRelatedByOutletToRemoved) {
            $ordersRelatedByOutletToRemoved->setOutletsRelatedByOutletTo(null);
        }

        $this->collOrderssRelatedByOutletTo = null;
        foreach ($orderssRelatedByOutletTo as $ordersRelatedByOutletTo) {
            $this->addOrdersRelatedByOutletTo($ordersRelatedByOutletTo);
        }

        $this->collOrderssRelatedByOutletTo = $orderssRelatedByOutletTo;
        $this->collOrderssRelatedByOutletToPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Orders objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderssRelatedByOutletTo(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderssRelatedByOutletToPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByOutletTo || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderssRelatedByOutletTo) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderssRelatedByOutletTo());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutletsRelatedByOutletTo($this)
                ->count($con);
        }

        return count($this->collOrderssRelatedByOutletTo);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param ChildOrders $l ChildOrders
     * @return $this The current object (for fluent API support)
     */
    public function addOrdersRelatedByOutletTo(ChildOrders $l)
    {
        if ($this->collOrderssRelatedByOutletTo === null) {
            $this->initOrderssRelatedByOutletTo();
            $this->collOrderssRelatedByOutletToPartial = true;
        }

        if (!$this->collOrderssRelatedByOutletTo->contains($l)) {
            $this->doAddOrdersRelatedByOutletTo($l);

            if ($this->orderssRelatedByOutletToScheduledForDeletion and $this->orderssRelatedByOutletToScheduledForDeletion->contains($l)) {
                $this->orderssRelatedByOutletToScheduledForDeletion->remove($this->orderssRelatedByOutletToScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $ordersRelatedByOutletTo The ChildOrders object to add.
     */
    protected function doAddOrdersRelatedByOutletTo(ChildOrders $ordersRelatedByOutletTo): void
    {
        $this->collOrderssRelatedByOutletTo[]= $ordersRelatedByOutletTo;
        $ordersRelatedByOutletTo->setOutletsRelatedByOutletTo($this);
    }

    /**
     * @param ChildOrders $ordersRelatedByOutletTo The ChildOrders object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrdersRelatedByOutletTo(ChildOrders $ordersRelatedByOutletTo)
    {
        if ($this->getOrderssRelatedByOutletTo()->contains($ordersRelatedByOutletTo)) {
            $pos = $this->collOrderssRelatedByOutletTo->search($ordersRelatedByOutletTo);
            $this->collOrderssRelatedByOutletTo->remove($pos);
            if (null === $this->orderssRelatedByOutletToScheduledForDeletion) {
                $this->orderssRelatedByOutletToScheduledForDeletion = clone $this->collOrderssRelatedByOutletTo;
                $this->orderssRelatedByOutletToScheduledForDeletion->clear();
            }
            $this->orderssRelatedByOutletToScheduledForDeletion[]= $ordersRelatedByOutletTo;
            $ordersRelatedByOutletTo->setOutletsRelatedByOutletTo(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletToJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderssRelatedByOutletTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletToJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getOrderssRelatedByOutletTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletToJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOrderssRelatedByOutletTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletToJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOrderssRelatedByOutletTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OrderssRelatedByOutletTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByOutletToJoinPricebooks(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Pricebooks', $joinBehavior);

        return $this->getOrderssRelatedByOutletTo($query, $con);
    }

    /**
     * Gets a single ChildOutletAccountDetails object, which is related to this object by a one-to-one relationship.
     *
     * @param ConnectionInterface $con optional connection object
     * @return ChildOutletAccountDetails|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletAccountDetails(?ConnectionInterface $con = null)
    {

        if ($this->singleOutletAccountDetails === null && !$this->isNew()) {
            $this->singleOutletAccountDetails = ChildOutletAccountDetailsQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleOutletAccountDetails;
    }

    /**
     * Sets a single ChildOutletAccountDetails object as related to this object by a one-to-one relationship.
     *
     * @param ChildOutletAccountDetails $v ChildOutletAccountDetails
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletAccountDetails(ChildOutletAccountDetails $v = null)
    {
        $this->singleOutletAccountDetails = $v;

        // Make sure that that the passed-in ChildOutletAccountDetails isn't already associated with this object
        if ($v !== null && $v->getOutlets(null, false) === null) {
            $v->setOutlets($this);
        }

        return $this;
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
     * If this ChildOutlets is new, it will return
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
                    ->filterByOutlets($this)
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
            $outletAddressRemoved->setOutlets(null);
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
                ->filterByOutlets($this)
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
        $outletAddress->setOutlets($this);
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
            $outletAddress->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletAddress[] List of ChildOutletAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletAddress}> List of ChildOutletAddress objects
     */
    public function getOutletAddressesJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletAddressQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getOutletAddresses($query, $con);
    }

    /**
     * Clears out the collOutletMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletMappings()
     */
    public function clearOutletMappings()
    {
        $this->collOutletMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletMappings($v = true): void
    {
        $this->collOutletMappingsPartial = $v;
    }

    /**
     * Initializes the collOutletMappings collection.
     *
     * By default this just sets the collOutletMappings collection to an empty array (like clearcollOutletMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletMappings = new $collectionClassName;
        $this->collOutletMappings->setModel('\entities\OutletMapping');
    }

    /**
     * Gets an array of ChildOutletMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletMapping[] List of ChildOutletMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletMapping> List of ChildOutletMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletMappingsPartial && !$this->isNew();
        if (null === $this->collOutletMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletMappings) {
                    $this->initOutletMappings();
                } else {
                    $collectionClassName = OutletMappingTableMap::getTableMap()->getCollectionClassName();

                    $collOutletMappings = new $collectionClassName;
                    $collOutletMappings->setModel('\entities\OutletMapping');

                    return $collOutletMappings;
                }
            } else {
                $collOutletMappings = ChildOutletMappingQuery::create(null, $criteria)
                    ->filterByOutlets($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletMappingsPartial && count($collOutletMappings)) {
                        $this->initOutletMappings(false);

                        foreach ($collOutletMappings as $obj) {
                            if (false == $this->collOutletMappings->contains($obj)) {
                                $this->collOutletMappings->append($obj);
                            }
                        }

                        $this->collOutletMappingsPartial = true;
                    }

                    return $collOutletMappings;
                }

                if ($partial && $this->collOutletMappings) {
                    foreach ($this->collOutletMappings as $obj) {
                        if ($obj->isNew()) {
                            $collOutletMappings[] = $obj;
                        }
                    }
                }

                $this->collOutletMappings = $collOutletMappings;
                $this->collOutletMappingsPartial = false;
            }
        }

        return $this->collOutletMappings;
    }

    /**
     * Sets a collection of ChildOutletMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletMappings(Collection $outletMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletMapping[] $outletMappingsToDelete */
        $outletMappingsToDelete = $this->getOutletMappings(new Criteria(), $con)->diff($outletMappings);


        $this->outletMappingsScheduledForDeletion = $outletMappingsToDelete;

        foreach ($outletMappingsToDelete as $outletMappingRemoved) {
            $outletMappingRemoved->setOutlets(null);
        }

        $this->collOutletMappings = null;
        foreach ($outletMappings as $outletMapping) {
            $this->addOutletMapping($outletMapping);
        }

        $this->collOutletMappings = $outletMappings;
        $this->collOutletMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletMappingsPartial && !$this->isNew();
        if (null === $this->collOutletMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletMappings());
            }

            $query = ChildOutletMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutlets($this)
                ->count($con);
        }

        return count($this->collOutletMappings);
    }

    /**
     * Method called to associate a ChildOutletMapping object to this object
     * through the ChildOutletMapping foreign key attribute.
     *
     * @param ChildOutletMapping $l ChildOutletMapping
     * @return $this The current object (for fluent API support)
     */
    public function addOutletMapping(ChildOutletMapping $l)
    {
        if ($this->collOutletMappings === null) {
            $this->initOutletMappings();
            $this->collOutletMappingsPartial = true;
        }

        if (!$this->collOutletMappings->contains($l)) {
            $this->doAddOutletMapping($l);

            if ($this->outletMappingsScheduledForDeletion and $this->outletMappingsScheduledForDeletion->contains($l)) {
                $this->outletMappingsScheduledForDeletion->remove($this->outletMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletMapping $outletMapping The ChildOutletMapping object to add.
     */
    protected function doAddOutletMapping(ChildOutletMapping $outletMapping): void
    {
        $this->collOutletMappings[]= $outletMapping;
        $outletMapping->setOutlets($this);
    }

    /**
     * @param ChildOutletMapping $outletMapping The ChildOutletMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletMapping(ChildOutletMapping $outletMapping)
    {
        if ($this->getOutletMappings()->contains($outletMapping)) {
            $pos = $this->collOutletMappings->search($outletMapping);
            $this->collOutletMappings->remove($pos);
            if (null === $this->outletMappingsScheduledForDeletion) {
                $this->outletMappingsScheduledForDeletion = clone $this->collOutletMappings;
                $this->outletMappingsScheduledForDeletion->clear();
            }
            $this->outletMappingsScheduledForDeletion[]= $outletMapping;
            $outletMapping->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletMapping[] List of ChildOutletMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletMapping}> List of ChildOutletMapping objects
     */
    public function getOutletMappingsJoinPricebooks(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletMappingQuery::create(null, $criteria);
        $query->joinWith('Pricebooks', $joinBehavior);

        return $this->getOutletMappings($query, $con);
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
     * If this ChildOutlets is new, it will return
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
                    ->filterByOutlets($this)
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
            $outletOrgDataRemoved->setOutlets(null);
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
                ->filterByOutlets($this)
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
        $outletOrgData->setOutlets($this);
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
            $this->outletOrgDatasScheduledForDeletion[]= clone $outletOrgData;
            $outletOrgData->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgData[] List of ChildOutletOrgData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgData}> List of ChildOutletOrgData objects
     */
    public function getOutletOrgDatasJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgDataQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getOutletOrgDatas($query, $con);
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
     * If this ChildOutlets is new, it will return
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
                    ->filterByOutlets($this)
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
            $outletStockRemoved->setOutlets(null);
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
                ->filterByOutlets($this)
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
        $outletStock->setOutlets($this);
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
            $outletStock->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStock[] List of ChildOutletStock objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStock}> List of ChildOutletStock objects
     */
    public function getOutletStocksJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

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
     * If this ChildOutlets is new, it will return
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
                    ->filterByOutlets($this)
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
            $outletStockOtherSummaryRemoved->setOutlets(null);
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
                ->filterByOutlets($this)
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
        $outletStockOtherSummary->setOutlets($this);
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
            $outletStockOtherSummary->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockOtherSummary[] List of ChildOutletStockOtherSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockOtherSummary}> List of ChildOutletStockOtherSummary objects
     */
    public function getOutletStockOtherSummariesJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockOtherSummaryQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOutletStockOtherSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * If this ChildOutlets is new, it will return
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
                    ->filterByOutlets($this)
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
            $outletStockSummaryRemoved->setOutlets(null);
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
                ->filterByOutlets($this)
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
        $outletStockSummary->setOutlets($this);
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
            $outletStockSummary->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletStockSummary[] List of ChildOutletStockSummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletStockSummary}> List of ChildOutletStockSummary objects
     */
    public function getOutletStockSummariesJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletStockSummaryQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOutletStockSummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
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
     * Clears out the collStockTransactions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockTransactions()
     */
    public function clearStockTransactions()
    {
        $this->collStockTransactions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockTransactions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockTransactions($v = true): void
    {
        $this->collStockTransactionsPartial = $v;
    }

    /**
     * Initializes the collStockTransactions collection.
     *
     * By default this just sets the collStockTransactions collection to an empty array (like clearcollStockTransactions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockTransactions(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockTransactions && !$overrideExisting) {
            return;
        }

        $collectionClassName = StockTransactionTableMap::getTableMap()->getCollectionClassName();

        $this->collStockTransactions = new $collectionClassName;
        $this->collStockTransactions->setModel('\entities\StockTransaction');
    }

    /**
     * Gets an array of ChildStockTransaction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction> List of ChildStockTransaction objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockTransactions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockTransactionsPartial && !$this->isNew();
        if (null === $this->collStockTransactions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockTransactions) {
                    $this->initStockTransactions();
                } else {
                    $collectionClassName = StockTransactionTableMap::getTableMap()->getCollectionClassName();

                    $collStockTransactions = new $collectionClassName;
                    $collStockTransactions->setModel('\entities\StockTransaction');

                    return $collStockTransactions;
                }
            } else {
                $collStockTransactions = ChildStockTransactionQuery::create(null, $criteria)
                    ->filterByOutlets($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockTransactionsPartial && count($collStockTransactions)) {
                        $this->initStockTransactions(false);

                        foreach ($collStockTransactions as $obj) {
                            if (false == $this->collStockTransactions->contains($obj)) {
                                $this->collStockTransactions->append($obj);
                            }
                        }

                        $this->collStockTransactionsPartial = true;
                    }

                    return $collStockTransactions;
                }

                if ($partial && $this->collStockTransactions) {
                    foreach ($this->collStockTransactions as $obj) {
                        if ($obj->isNew()) {
                            $collStockTransactions[] = $obj;
                        }
                    }
                }

                $this->collStockTransactions = $collStockTransactions;
                $this->collStockTransactionsPartial = false;
            }
        }

        return $this->collStockTransactions;
    }

    /**
     * Sets a collection of ChildStockTransaction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockTransactions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockTransactions(Collection $stockTransactions, ?ConnectionInterface $con = null)
    {
        /** @var ChildStockTransaction[] $stockTransactionsToDelete */
        $stockTransactionsToDelete = $this->getStockTransactions(new Criteria(), $con)->diff($stockTransactions);


        $this->stockTransactionsScheduledForDeletion = $stockTransactionsToDelete;

        foreach ($stockTransactionsToDelete as $stockTransactionRemoved) {
            $stockTransactionRemoved->setOutlets(null);
        }

        $this->collStockTransactions = null;
        foreach ($stockTransactions as $stockTransaction) {
            $this->addStockTransaction($stockTransaction);
        }

        $this->collStockTransactions = $stockTransactions;
        $this->collStockTransactionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StockTransaction objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StockTransaction objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockTransactions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockTransactionsPartial && !$this->isNew();
        if (null === $this->collStockTransactions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockTransactions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockTransactions());
            }

            $query = ChildStockTransactionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutlets($this)
                ->count($con);
        }

        return count($this->collStockTransactions);
    }

    /**
     * Method called to associate a ChildStockTransaction object to this object
     * through the ChildStockTransaction foreign key attribute.
     *
     * @param ChildStockTransaction $l ChildStockTransaction
     * @return $this The current object (for fluent API support)
     */
    public function addStockTransaction(ChildStockTransaction $l)
    {
        if ($this->collStockTransactions === null) {
            $this->initStockTransactions();
            $this->collStockTransactionsPartial = true;
        }

        if (!$this->collStockTransactions->contains($l)) {
            $this->doAddStockTransaction($l);

            if ($this->stockTransactionsScheduledForDeletion and $this->stockTransactionsScheduledForDeletion->contains($l)) {
                $this->stockTransactionsScheduledForDeletion->remove($this->stockTransactionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStockTransaction $stockTransaction The ChildStockTransaction object to add.
     */
    protected function doAddStockTransaction(ChildStockTransaction $stockTransaction): void
    {
        $this->collStockTransactions[]= $stockTransaction;
        $stockTransaction->setOutlets($this);
    }

    /**
     * @param ChildStockTransaction $stockTransaction The ChildStockTransaction object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockTransaction(ChildStockTransaction $stockTransaction)
    {
        if ($this->getStockTransactions()->contains($stockTransaction)) {
            $pos = $this->collStockTransactions->search($stockTransaction);
            $this->collStockTransactions->remove($pos);
            if (null === $this->stockTransactionsScheduledForDeletion) {
                $this->stockTransactionsScheduledForDeletion = clone $this->collStockTransactions;
                $this->stockTransactionsScheduledForDeletion->clear();
            }
            $this->stockTransactionsScheduledForDeletion[]= clone $stockTransaction;
            $stockTransaction->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinStockVoucher(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('StockVoucher', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }

    /**
     * Clears out the collSurveySubmiteds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSurveySubmiteds()
     */
    public function clearSurveySubmiteds()
    {
        $this->collSurveySubmiteds = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSurveySubmiteds collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSurveySubmiteds($v = true): void
    {
        $this->collSurveySubmitedsPartial = $v;
    }

    /**
     * Initializes the collSurveySubmiteds collection.
     *
     * By default this just sets the collSurveySubmiteds collection to an empty array (like clearcollSurveySubmiteds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSurveySubmiteds(bool $overrideExisting = true): void
    {
        if (null !== $this->collSurveySubmiteds && !$overrideExisting) {
            return;
        }

        $collectionClassName = SurveySubmitedTableMap::getTableMap()->getCollectionClassName();

        $this->collSurveySubmiteds = new $collectionClassName;
        $this->collSurveySubmiteds->setModel('\entities\SurveySubmited');
    }

    /**
     * Gets an array of ChildSurveySubmited objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited> List of ChildSurveySubmited objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurveySubmiteds(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSurveySubmitedsPartial && !$this->isNew();
        if (null === $this->collSurveySubmiteds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSurveySubmiteds) {
                    $this->initSurveySubmiteds();
                } else {
                    $collectionClassName = SurveySubmitedTableMap::getTableMap()->getCollectionClassName();

                    $collSurveySubmiteds = new $collectionClassName;
                    $collSurveySubmiteds->setModel('\entities\SurveySubmited');

                    return $collSurveySubmiteds;
                }
            } else {
                $collSurveySubmiteds = ChildSurveySubmitedQuery::create(null, $criteria)
                    ->filterByOutlets($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSurveySubmitedsPartial && count($collSurveySubmiteds)) {
                        $this->initSurveySubmiteds(false);

                        foreach ($collSurveySubmiteds as $obj) {
                            if (false == $this->collSurveySubmiteds->contains($obj)) {
                                $this->collSurveySubmiteds->append($obj);
                            }
                        }

                        $this->collSurveySubmitedsPartial = true;
                    }

                    return $collSurveySubmiteds;
                }

                if ($partial && $this->collSurveySubmiteds) {
                    foreach ($this->collSurveySubmiteds as $obj) {
                        if ($obj->isNew()) {
                            $collSurveySubmiteds[] = $obj;
                        }
                    }
                }

                $this->collSurveySubmiteds = $collSurveySubmiteds;
                $this->collSurveySubmitedsPartial = false;
            }
        }

        return $this->collSurveySubmiteds;
    }

    /**
     * Sets a collection of ChildSurveySubmited objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $surveySubmiteds A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSurveySubmiteds(Collection $surveySubmiteds, ?ConnectionInterface $con = null)
    {
        /** @var ChildSurveySubmited[] $surveySubmitedsToDelete */
        $surveySubmitedsToDelete = $this->getSurveySubmiteds(new Criteria(), $con)->diff($surveySubmiteds);


        $this->surveySubmitedsScheduledForDeletion = $surveySubmitedsToDelete;

        foreach ($surveySubmitedsToDelete as $surveySubmitedRemoved) {
            $surveySubmitedRemoved->setOutlets(null);
        }

        $this->collSurveySubmiteds = null;
        foreach ($surveySubmiteds as $surveySubmited) {
            $this->addSurveySubmited($surveySubmited);
        }

        $this->collSurveySubmiteds = $surveySubmiteds;
        $this->collSurveySubmitedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SurveySubmited objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SurveySubmited objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSurveySubmiteds(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSurveySubmitedsPartial && !$this->isNew();
        if (null === $this->collSurveySubmiteds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSurveySubmiteds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSurveySubmiteds());
            }

            $query = ChildSurveySubmitedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutlets($this)
                ->count($con);
        }

        return count($this->collSurveySubmiteds);
    }

    /**
     * Method called to associate a ChildSurveySubmited object to this object
     * through the ChildSurveySubmited foreign key attribute.
     *
     * @param ChildSurveySubmited $l ChildSurveySubmited
     * @return $this The current object (for fluent API support)
     */
    public function addSurveySubmited(ChildSurveySubmited $l)
    {
        if ($this->collSurveySubmiteds === null) {
            $this->initSurveySubmiteds();
            $this->collSurveySubmitedsPartial = true;
        }

        if (!$this->collSurveySubmiteds->contains($l)) {
            $this->doAddSurveySubmited($l);

            if ($this->surveySubmitedsScheduledForDeletion and $this->surveySubmitedsScheduledForDeletion->contains($l)) {
                $this->surveySubmitedsScheduledForDeletion->remove($this->surveySubmitedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSurveySubmited $surveySubmited The ChildSurveySubmited object to add.
     */
    protected function doAddSurveySubmited(ChildSurveySubmited $surveySubmited): void
    {
        $this->collSurveySubmiteds[]= $surveySubmited;
        $surveySubmited->setOutlets($this);
    }

    /**
     * @param ChildSurveySubmited $surveySubmited The ChildSurveySubmited object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSurveySubmited(ChildSurveySubmited $surveySubmited)
    {
        if ($this->getSurveySubmiteds()->contains($surveySubmited)) {
            $pos = $this->collSurveySubmiteds->search($surveySubmited);
            $this->collSurveySubmiteds->remove($pos);
            if (null === $this->surveySubmitedsScheduledForDeletion) {
                $this->surveySubmitedsScheduledForDeletion = clone $this->collSurveySubmiteds;
                $this->surveySubmitedsScheduledForDeletion->clear();
            }
            $this->surveySubmitedsScheduledForDeletion[]= $surveySubmited;
            $surveySubmited->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinDailycalls(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Dailycalls', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }

    /**
     * Clears out the collTicketss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTicketss()
     */
    public function clearTicketss()
    {
        $this->collTicketss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTicketss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTicketss($v = true): void
    {
        $this->collTicketssPartial = $v;
    }

    /**
     * Initializes the collTicketss collection.
     *
     * By default this just sets the collTicketss collection to an empty array (like clearcollTicketss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTicketss(bool $overrideExisting = true): void
    {
        if (null !== $this->collTicketss && !$overrideExisting) {
            return;
        }

        $collectionClassName = TicketsTableMap::getTableMap()->getCollectionClassName();

        $this->collTicketss = new $collectionClassName;
        $this->collTicketss->setModel('\entities\Tickets');
    }

    /**
     * Gets an array of ChildTickets objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOutlets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets> List of ChildTickets objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTicketss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTicketssPartial && !$this->isNew();
        if (null === $this->collTicketss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTicketss) {
                    $this->initTicketss();
                } else {
                    $collectionClassName = TicketsTableMap::getTableMap()->getCollectionClassName();

                    $collTicketss = new $collectionClassName;
                    $collTicketss->setModel('\entities\Tickets');

                    return $collTicketss;
                }
            } else {
                $collTicketss = ChildTicketsQuery::create(null, $criteria)
                    ->filterByOutlets($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTicketssPartial && count($collTicketss)) {
                        $this->initTicketss(false);

                        foreach ($collTicketss as $obj) {
                            if (false == $this->collTicketss->contains($obj)) {
                                $this->collTicketss->append($obj);
                            }
                        }

                        $this->collTicketssPartial = true;
                    }

                    return $collTicketss;
                }

                if ($partial && $this->collTicketss) {
                    foreach ($this->collTicketss as $obj) {
                        if ($obj->isNew()) {
                            $collTicketss[] = $obj;
                        }
                    }
                }

                $this->collTicketss = $collTicketss;
                $this->collTicketssPartial = false;
            }
        }

        return $this->collTicketss;
    }

    /**
     * Sets a collection of ChildTickets objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $ticketss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTicketss(Collection $ticketss, ?ConnectionInterface $con = null)
    {
        /** @var ChildTickets[] $ticketssToDelete */
        $ticketssToDelete = $this->getTicketss(new Criteria(), $con)->diff($ticketss);


        $this->ticketssScheduledForDeletion = $ticketssToDelete;

        foreach ($ticketssToDelete as $ticketsRemoved) {
            $ticketsRemoved->setOutlets(null);
        }

        $this->collTicketss = null;
        foreach ($ticketss as $tickets) {
            $this->addTickets($tickets);
        }

        $this->collTicketss = $ticketss;
        $this->collTicketssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tickets objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Tickets objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTicketss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTicketssPartial && !$this->isNew();
        if (null === $this->collTicketss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTicketss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTicketss());
            }

            $query = ChildTicketsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOutlets($this)
                ->count($con);
        }

        return count($this->collTicketss);
    }

    /**
     * Method called to associate a ChildTickets object to this object
     * through the ChildTickets foreign key attribute.
     *
     * @param ChildTickets $l ChildTickets
     * @return $this The current object (for fluent API support)
     */
    public function addTickets(ChildTickets $l)
    {
        if ($this->collTicketss === null) {
            $this->initTicketss();
            $this->collTicketssPartial = true;
        }

        if (!$this->collTicketss->contains($l)) {
            $this->doAddTickets($l);

            if ($this->ticketssScheduledForDeletion and $this->ticketssScheduledForDeletion->contains($l)) {
                $this->ticketssScheduledForDeletion->remove($this->ticketssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTickets $tickets The ChildTickets object to add.
     */
    protected function doAddTickets(ChildTickets $tickets): void
    {
        $this->collTicketss[]= $tickets;
        $tickets->setOutlets($this);
    }

    /**
     * @param ChildTickets $tickets The ChildTickets object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTickets(ChildTickets $tickets)
    {
        if ($this->getTicketss()->contains($tickets)) {
            $pos = $this->collTicketss->search($tickets);
            $this->collTicketss->remove($pos);
            if (null === $this->ticketssScheduledForDeletion) {
                $this->ticketssScheduledForDeletion = clone $this->collTicketss;
                $this->ticketssScheduledForDeletion->clear();
            }
            $this->ticketssScheduledForDeletion[]= clone $tickets;
            $tickets->setOutlets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related Ticketss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssJoinTicketType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('TicketType', $joinBehavior);

        return $this->getTicketss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related Ticketss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssJoinEmployeeRelatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByEmployeeId', $joinBehavior);

        return $this->getTicketss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related Ticketss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTicketss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Outlets is new, it will return
     * an empty collection; or if this Outlets has previously
     * been saved, it will retrieve related Ticketss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Outlets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssJoinEmployeeRelatedByAllocatedTo(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByAllocatedTo', $joinBehavior);

        return $this->getTicketss($query, $con);
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
        if (null !== $this->aClassification) {
            $this->aClassification->removeOutlets($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeOutlets($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeOutlets($this);
        }
        if (null !== $this->aOutletType) {
            $this->aOutletType->removeOutlets($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removeOutlets($this);
        }
        $this->id = null;
        $this->outlet_media_id = null;
        $this->outlet_name = null;
        $this->outlet_code = null;
        $this->outlet_email = null;
        $this->outlet_salutation = null;
        $this->outlet_classification = null;
        $this->outlet_opening_date = null;
        $this->outlet_contact_name = null;
        $this->outlet_landlineno = null;
        $this->outlet_alt_landlineno = null;
        $this->outlet_contact_bday = null;
        $this->outlet_contact_anniversary = null;
        $this->outlet_isd_code = null;
        $this->outlet_contact_no = null;
        $this->outlet_alt_contact_no = null;
        $this->outlet_status = null;
        $this->outlettype_id = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->outlet_otp = null;
        $this->outlet_verified = null;
        $this->outlet_created_by = null;
        $this->outlet_approved_by = null;
        $this->outlet_potential = null;
        $this->integration_id = null;
        $this->itownid = null;
        $this->outlet_qualification = null;
        $this->outlet_regno = null;
        $this->outlet_marital_status = null;
        $this->outlet_media = null;
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
            if ($this->collBrandRcpas) {
                foreach ($this->collBrandRcpas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompetitionMappings) {
                foreach ($this->collCompetitionMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallsSgpiouts) {
                foreach ($this->collDailycallsSgpiouts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequests) {
                foreach ($this->collOnBoardRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderssRelatedByOutletFrom) {
                foreach ($this->collOrderssRelatedByOutletFrom as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderssRelatedByOutletTo) {
                foreach ($this->collOrderssRelatedByOutletTo as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleOutletAccountDetails) {
                $this->singleOutletAccountDetails->clearAllReferences($deep);
            }
            if ($this->collOutletAddresses) {
                foreach ($this->collOutletAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletMappings) {
                foreach ($this->collOutletMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletOrgDatas) {
                foreach ($this->collOutletOrgDatas as $o) {
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
            if ($this->collStockTransactions) {
                foreach ($this->collStockTransactions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSurveySubmiteds) {
                foreach ($this->collSurveySubmiteds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTicketss) {
                foreach ($this->collTicketss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagnDoctorss = null;
        $this->collBrandCampiagnVisitss = null;
        $this->collBrandRcpas = null;
        $this->collCompetitionMappings = null;
        $this->collDailycallsSgpiouts = null;
        $this->collOnBoardRequests = null;
        $this->collOrderssRelatedByOutletFrom = null;
        $this->collOrderssRelatedByOutletTo = null;
        $this->singleOutletAccountDetails = null;
        $this->collOutletAddresses = null;
        $this->collOutletMappings = null;
        $this->collOutletOrgDatas = null;
        $this->collOutletStocks = null;
        $this->collOutletStockOtherSummaries = null;
        $this->collOutletStockSummaries = null;
        $this->collStockTransactions = null;
        $this->collSurveySubmiteds = null;
        $this->collTicketss = null;
        $this->aClassification = null;
        $this->aEmployee = null;
        $this->aCompany = null;
        $this->aOutletType = null;
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
        return (string) $this->exportTo(OutletsTableMap::DEFAULT_STRING_FORMAT);
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
