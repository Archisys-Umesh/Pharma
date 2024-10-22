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
use entities\Agendatypes as ChildAgendatypes;
use entities\AgendatypesQuery as ChildAgendatypesQuery;
use entities\AuditEmpUnits as ChildAuditEmpUnits;
use entities\AuditEmpUnitsQuery as ChildAuditEmpUnitsQuery;
use entities\Beats as ChildBeats;
use entities\BeatsQuery as ChildBeatsQuery;
use entities\BrandCampiagn as ChildBrandCampiagn;
use entities\BrandCampiagnQuery as ChildBrandCampiagnQuery;
use entities\BrandCompetition as ChildBrandCompetition;
use entities\BrandCompetitionQuery as ChildBrandCompetitionQuery;
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Categories as ChildCategories;
use entities\CategoriesQuery as ChildCategoriesQuery;
use entities\Classification as ChildClassification;
use entities\ClassificationQuery as ChildClassificationQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Currencies as ChildCurrencies;
use entities\CurrenciesQuery as ChildCurrenciesQuery;
use entities\EdPlaylist as ChildEdPlaylist;
use entities\EdPlaylistQuery as ChildEdPlaylistQuery;
use entities\EdPresentations as ChildEdPresentations;
use entities\EdPresentationsQuery as ChildEdPresentationsQuery;
use entities\EdStats as ChildEdStats;
use entities\EdStatsQuery as ChildEdStatsQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Expenses as ChildExpenses;
use entities\ExpensesQuery as ChildExpensesQuery;
use entities\GeoCountry as ChildGeoCountry;
use entities\GeoCountryQuery as ChildGeoCountryQuery;
use entities\Offers as ChildOffers;
use entities\OffersQuery as ChildOffersQuery;
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\OnBoardRequiredFields as ChildOnBoardRequiredFields;
use entities\OnBoardRequiredFieldsQuery as ChildOnBoardRequiredFieldsQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\OutletOrgNotes as ChildOutletOrgNotes;
use entities\OutletOrgNotesQuery as ChildOutletOrgNotesQuery;
use entities\OutletStock as ChildOutletStock;
use entities\OutletStockOtherSummary as ChildOutletStockOtherSummary;
use entities\OutletStockOtherSummaryQuery as ChildOutletStockOtherSummaryQuery;
use entities\OutletStockQuery as ChildOutletStockQuery;
use entities\OutletStockSummary as ChildOutletStockSummary;
use entities\OutletStockSummaryQuery as ChildOutletStockSummaryQuery;
use entities\PolicyMaster as ChildPolicyMaster;
use entities\PolicyMasterQuery as ChildPolicyMasterQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\PrescriberData as ChildPrescriberData;
use entities\PrescriberDataQuery as ChildPrescriberDataQuery;
use entities\PrescriberTallySummary as ChildPrescriberTallySummary;
use entities\PrescriberTallySummaryQuery as ChildPrescriberTallySummaryQuery;
use entities\Pricebooks as ChildPricebooks;
use entities\PricebooksQuery as ChildPricebooksQuery;
use entities\SgpiMaster as ChildSgpiMaster;
use entities\SgpiMasterQuery as ChildSgpiMasterQuery;
use entities\Territories as ChildTerritories;
use entities\TerritoriesQuery as ChildTerritoriesQuery;
use entities\Map\AgendatypesTableMap;
use entities\Map\AuditEmpUnitsTableMap;
use entities\Map\BeatsTableMap;
use entities\Map\BrandCampiagnTableMap;
use entities\Map\BrandCompetitionTableMap;
use entities\Map\BrandsTableMap;
use entities\Map\CategoriesTableMap;
use entities\Map\ClassificationTableMap;
use entities\Map\EdPlaylistTableMap;
use entities\Map\EdPresentationsTableMap;
use entities\Map\EdStatsTableMap;
use entities\Map\EmployeeTableMap;
use entities\Map\ExpensesTableMap;
use entities\Map\OffersTableMap;
use entities\Map\OnBoardRequestAddressTableMap;
use entities\Map\OnBoardRequiredFieldsTableMap;
use entities\Map\OrgUnitTableMap;
use entities\Map\OutletOrgDataTableMap;
use entities\Map\OutletOrgNotesTableMap;
use entities\Map\OutletStockOtherSummaryTableMap;
use entities\Map\OutletStockSummaryTableMap;
use entities\Map\OutletStockTableMap;
use entities\Map\PolicyMasterTableMap;
use entities\Map\PositionsTableMap;
use entities\Map\PrescriberDataTableMap;
use entities\Map\PrescriberTallySummaryTableMap;
use entities\Map\PricebooksTableMap;
use entities\Map\SgpiMasterTableMap;
use entities\Map\TerritoriesTableMap;

/**
 * Base class that represents a row from the 'org_unit' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OrgUnit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OrgUnitTableMap';


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
     * The value for the orgunitid field.
     *
     * @var        int
     */
    protected $orgunitid;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the unit_name field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $unit_name;

    /**
     * The value for the org_unit_code field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string|null
     */
    protected $org_unit_code;

    /**
     * The value for the currency_id field.
     *
     * @var        int
     */
    protected $currency_id;

    /**
     * The value for the country_id field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $country_id;

    /**
     * The value for the can_do_custom_playlist field.
     *
     * @var        boolean|null
     */
    protected $can_do_custom_playlist;

    /**
     * The value for the is_exposed field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_exposed;

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
     * The value for the orgunit_admin_position field.
     *
     * @var        int|null
     */
    protected $orgunit_admin_position;

    /**
     * The value for the on_board_required_fileds field.
     *
     * @var        string|null
     */
    protected $on_board_required_fileds;

    /**
     * The value for the punchin_on_weekoff field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $punchin_on_weekoff;

    /**
     * The value for the punchin_on_holiday field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $punchin_on_holiday;

    /**
     * The value for the punchin_on_leave field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $punchin_on_leave;

    /**
     * The value for the outlet_type field.
     *
     * @var        string|null
     */
    protected $outlet_type;

    /**
     * The value for the default_outlet_type field.
     *
     * @var        string|null
     */
    protected $default_outlet_type;

    /**
     * @var        ChildGeoCountry
     */
    protected $aGeoCountry;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildCurrencies
     */
    protected $aCurrencies;

    /**
     * @var        ObjectCollection|ChildAgendatypes[] Collection to store aggregation of ChildAgendatypes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAgendatypes> Collection to store aggregation of ChildAgendatypes objects.
     */
    protected $collAgendatypess;
    protected $collAgendatypessPartial;

    /**
     * @var        ObjectCollection|ChildAuditEmpUnits[] Collection to store aggregation of ChildAuditEmpUnits objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAuditEmpUnits> Collection to store aggregation of ChildAuditEmpUnits objects.
     */
    protected $collAuditEmpUnitss;
    protected $collAuditEmpUnitssPartial;

    /**
     * @var        ObjectCollection|ChildBeats[] Collection to store aggregation of ChildBeats objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBeats> Collection to store aggregation of ChildBeats objects.
     */
    protected $collBeatss;
    protected $collBeatssPartial;

    /**
     * @var        ObjectCollection|ChildBrandCampiagn[] Collection to store aggregation of ChildBrandCampiagn objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagn> Collection to store aggregation of ChildBrandCampiagn objects.
     */
    protected $collBrandCampiagns;
    protected $collBrandCampiagnsPartial;

    /**
     * @var        ObjectCollection|ChildBrandCompetition[] Collection to store aggregation of ChildBrandCompetition objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCompetition> Collection to store aggregation of ChildBrandCompetition objects.
     */
    protected $collBrandCompetitions;
    protected $collBrandCompetitionsPartial;

    /**
     * @var        ObjectCollection|ChildBrands[] Collection to store aggregation of ChildBrands objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrands> Collection to store aggregation of ChildBrands objects.
     */
    protected $collBrandss;
    protected $collBrandssPartial;

    /**
     * @var        ObjectCollection|ChildCategories[] Collection to store aggregation of ChildCategories objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCategories> Collection to store aggregation of ChildCategories objects.
     */
    protected $collCategoriess;
    protected $collCategoriessPartial;

    /**
     * @var        ObjectCollection|ChildClassification[] Collection to store aggregation of ChildClassification objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildClassification> Collection to store aggregation of ChildClassification objects.
     */
    protected $collClassifications;
    protected $collClassificationsPartial;

    /**
     * @var        ObjectCollection|ChildEdPlaylist[] Collection to store aggregation of ChildEdPlaylist objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdPlaylist> Collection to store aggregation of ChildEdPlaylist objects.
     */
    protected $collEdPlaylists;
    protected $collEdPlaylistsPartial;

    /**
     * @var        ObjectCollection|ChildEdPresentations[] Collection to store aggregation of ChildEdPresentations objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdPresentations> Collection to store aggregation of ChildEdPresentations objects.
     */
    protected $collEdPresentationss;
    protected $collEdPresentationssPartial;

    /**
     * @var        ObjectCollection|ChildEdStats[] Collection to store aggregation of ChildEdStats objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdStats> Collection to store aggregation of ChildEdStats objects.
     */
    protected $collEdStatss;
    protected $collEdStatssPartial;

    /**
     * @var        ObjectCollection|ChildEmployee[] Collection to store aggregation of ChildEmployee objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee> Collection to store aggregation of ChildEmployee objects.
     */
    protected $collEmployees;
    protected $collEmployeesPartial;

    /**
     * @var        ObjectCollection|ChildExpenses[] Collection to store aggregation of ChildExpenses objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenses> Collection to store aggregation of ChildExpenses objects.
     */
    protected $collExpensess;
    protected $collExpensessPartial;

    /**
     * @var        ObjectCollection|ChildOffers[] Collection to store aggregation of ChildOffers objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOffers> Collection to store aggregation of ChildOffers objects.
     */
    protected $collOfferss;
    protected $collOfferssPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestAddress[] Collection to store aggregation of ChildOnBoardRequestAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress> Collection to store aggregation of ChildOnBoardRequestAddress objects.
     */
    protected $collOnBoardRequestAddresses;
    protected $collOnBoardRequestAddressesPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequiredFields[] Collection to store aggregation of ChildOnBoardRequiredFields objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequiredFields> Collection to store aggregation of ChildOnBoardRequiredFields objects.
     */
    protected $collOnBoardRequiredFieldss;
    protected $collOnBoardRequiredFieldssPartial;

    /**
     * @var        ObjectCollection|ChildOutletOrgData[] Collection to store aggregation of ChildOutletOrgData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgData> Collection to store aggregation of ChildOutletOrgData objects.
     */
    protected $collOutletOrgDatas;
    protected $collOutletOrgDatasPartial;

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
     * @var        ObjectCollection|ChildPolicyMaster[] Collection to store aggregation of ChildPolicyMaster objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPolicyMaster> Collection to store aggregation of ChildPolicyMaster objects.
     */
    protected $collPolicyMasters;
    protected $collPolicyMastersPartial;

    /**
     * @var        ObjectCollection|ChildPositions[] Collection to store aggregation of ChildPositions objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPositions> Collection to store aggregation of ChildPositions objects.
     */
    protected $collPositionss;
    protected $collPositionssPartial;

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
     * @var        ObjectCollection|ChildPricebooks[] Collection to store aggregation of ChildPricebooks objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPricebooks> Collection to store aggregation of ChildPricebooks objects.
     */
    protected $collPricebookss;
    protected $collPricebookssPartial;

    /**
     * @var        ObjectCollection|ChildSgpiMaster[] Collection to store aggregation of ChildSgpiMaster objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSgpiMaster> Collection to store aggregation of ChildSgpiMaster objects.
     */
    protected $collSgpiMasters;
    protected $collSgpiMastersPartial;

    /**
     * @var        ObjectCollection|ChildTerritories[] Collection to store aggregation of ChildTerritories objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTerritories> Collection to store aggregation of ChildTerritories objects.
     */
    protected $collTerritoriess;
    protected $collTerritoriessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAgendatypes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAgendatypes>
     */
    protected $agendatypessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAuditEmpUnits[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAuditEmpUnits>
     */
    protected $auditEmpUnitssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBeats[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBeats>
     */
    protected $beatssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagn[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagn>
     */
    protected $brandCampiagnsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCompetition[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCompetition>
     */
    protected $brandCompetitionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrands[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrands>
     */
    protected $brandssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCategories[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCategories>
     */
    protected $categoriessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildClassification[]
     * @phpstan-var ObjectCollection&\Traversable<ChildClassification>
     */
    protected $classificationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdPlaylist[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdPlaylist>
     */
    protected $edPlaylistsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdPresentations[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdPresentations>
     */
    protected $edPresentationssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdStats[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdStats>
     */
    protected $edStatssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployee[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee>
     */
    protected $employeesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenses[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenses>
     */
    protected $expensessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOffers[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOffers>
     */
    protected $offerssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress>
     */
    protected $onBoardRequestAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequiredFields[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequiredFields>
     */
    protected $onBoardRequiredFieldssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletOrgData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletOrgData>
     */
    protected $outletOrgDatasScheduledForDeletion = null;

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
     * @var ObjectCollection|ChildPolicyMaster[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPolicyMaster>
     */
    protected $policyMastersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPositions[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPositions>
     */
    protected $positionssScheduledForDeletion = null;

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
     * @var ObjectCollection|ChildPricebooks[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPricebooks>
     */
    protected $pricebookssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSgpiMaster[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSgpiMaster>
     */
    protected $sgpiMastersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTerritories[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTerritories>
     */
    protected $territoriessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->company_id = 0;
        $this->unit_name = '0';
        $this->org_unit_code = '0';
        $this->country_id = 1;
        $this->is_exposed = false;
        $this->punchin_on_weekoff = false;
        $this->punchin_on_holiday = false;
        $this->punchin_on_leave = false;
    }

    /**
     * Initializes internal state of entities\Base\OrgUnit object.
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
     * Compares this with another <code>OrgUnit</code> instance.  If
     * <code>obj</code> is an instance of <code>OrgUnit</code>, delegates to
     * <code>equals(OrgUnit)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [orgunitid] column value.
     *
     * @return int
     */
    public function getOrgunitid()
    {
        return $this->orgunitid;
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
     * Get the [unit_name] column value.
     *
     * @return string
     */
    public function getUnitName()
    {
        return $this->unit_name;
    }

    /**
     * Get the [org_unit_code] column value.
     *
     * @return string|null
     */
    public function getOrgUnitCode()
    {
        return $this->org_unit_code;
    }

    /**
     * Get the [currency_id] column value.
     *
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    /**
     * Get the [country_id] column value.
     *
     * @return int
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Get the [can_do_custom_playlist] column value.
     *
     * @return boolean|null
     */
    public function getCanDoCustomPlaylist()
    {
        return $this->can_do_custom_playlist;
    }

    /**
     * Get the [can_do_custom_playlist] column value.
     *
     * @return boolean|null
     */
    public function isCanDoCustomPlaylist()
    {
        return $this->getCanDoCustomPlaylist();
    }

    /**
     * Get the [is_exposed] column value.
     *
     * @return boolean|null
     */
    public function getIsExposed()
    {
        return $this->is_exposed;
    }

    /**
     * Get the [is_exposed] column value.
     *
     * @return boolean|null
     */
    public function isExposed()
    {
        return $this->getIsExposed();
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
     * Get the [orgunit_admin_position] column value.
     *
     * @return int|null
     */
    public function getOrgunitAdminPosition()
    {
        return $this->orgunit_admin_position;
    }

    /**
     * Get the [on_board_required_fileds] column value.
     *
     * @param bool $asArray Returns the JSON data as array instead of object

     * @return object|array|null
     */
    public function getOnBoardRequiredFileds($asArray = true)
    {
        return json_decode($this->on_board_required_fileds, $asArray);
    }

    /**
     * Get the [punchin_on_weekoff] column value.
     *
     * @return boolean|null
     */
    public function getPunchinOnWeekoff()
    {
        return $this->punchin_on_weekoff;
    }

    /**
     * Get the [punchin_on_weekoff] column value.
     *
     * @return boolean|null
     */
    public function isPunchinOnWeekoff()
    {
        return $this->getPunchinOnWeekoff();
    }

    /**
     * Get the [punchin_on_holiday] column value.
     *
     * @return boolean|null
     */
    public function getPunchinOnHoliday()
    {
        return $this->punchin_on_holiday;
    }

    /**
     * Get the [punchin_on_holiday] column value.
     *
     * @return boolean|null
     */
    public function isPunchinOnHoliday()
    {
        return $this->getPunchinOnHoliday();
    }

    /**
     * Get the [punchin_on_leave] column value.
     *
     * @return boolean|null
     */
    public function getPunchinOnLeave()
    {
        return $this->punchin_on_leave;
    }

    /**
     * Get the [punchin_on_leave] column value.
     *
     * @return boolean|null
     */
    public function isPunchinOnLeave()
    {
        return $this->getPunchinOnLeave();
    }

    /**
     * Get the [outlet_type] column value.
     *
     * @return string|null
     */
    public function getOutletType()
    {
        return $this->outlet_type;
    }

    /**
     * Get the [default_outlet_type] column value.
     *
     * @return string|null
     */
    public function getDefaultOutletType()
    {
        return $this->default_outlet_type;
    }

    /**
     * Set the value of [orgunitid] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunitid !== $v) {
            $this->orgunitid = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_ORGUNITID] = true;
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
            $this->modifiedColumns[OrgUnitTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [unit_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unit_name !== $v) {
            $this->unit_name = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_unit_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->org_unit_code !== $v) {
            $this->org_unit_code = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_ORG_UNIT_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [currency_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCurrencyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->currency_id !== $v) {
            $this->currency_id = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_CURRENCY_ID] = true;
        }

        if ($this->aCurrencies !== null && $this->aCurrencies->getCurrencyId() !== $v) {
            $this->aCurrencies = null;
        }

        return $this;
    }

    /**
     * Set the value of [country_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCountryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->country_id !== $v) {
            $this->country_id = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_COUNTRY_ID] = true;
        }

        if ($this->aGeoCountry !== null && $this->aGeoCountry->getIcountryid() !== $v) {
            $this->aGeoCountry = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [can_do_custom_playlist] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setCanDoCustomPlaylist($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->can_do_custom_playlist !== $v) {
            $this->can_do_custom_playlist = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_exposed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsExposed($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_exposed !== $v) {
            $this->is_exposed = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_IS_EXPOSED] = true;
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
                $this->modifiedColumns[OrgUnitTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[OrgUnitTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [orgunit_admin_position] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitAdminPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunit_admin_position !== $v) {
            $this->orgunit_admin_position = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [on_board_required_fileds] column.
     *
     * @param string|array|object|null $v new value
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequiredFileds($v)
    {
        if (is_string($v)) {
            // JSON as string needs to be decoded/encoded to get a reliable comparison (spaces, ...)
            $v = json_decode($v);
        }
        $encodedValue = json_encode($v);
        if ($encodedValue !== $this->on_board_required_fileds) {
            $this->on_board_required_fileds = $encodedValue;
            $this->modifiedColumns[OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [punchin_on_weekoff] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setPunchinOnWeekoff($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->punchin_on_weekoff !== $v) {
            $this->punchin_on_weekoff = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [punchin_on_holiday] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setPunchinOnHoliday($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->punchin_on_holiday !== $v) {
            $this->punchin_on_holiday = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [punchin_on_leave] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setPunchinOnLeave($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->punchin_on_leave !== $v) {
            $this->punchin_on_leave = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_type !== $v) {
            $this->outlet_type = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_OUTLET_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [default_outlet_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultOutletType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->default_outlet_type !== $v) {
            $this->default_outlet_type = $v;
            $this->modifiedColumns[OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE] = true;
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

            if ($this->unit_name !== '0') {
                return false;
            }

            if ($this->org_unit_code !== '0') {
                return false;
            }

            if ($this->country_id !== 1) {
                return false;
            }

            if ($this->is_exposed !== false) {
                return false;
            }

            if ($this->punchin_on_weekoff !== false) {
                return false;
            }

            if ($this->punchin_on_holiday !== false) {
                return false;
            }

            if ($this->punchin_on_leave !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrgUnitTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrgUnitTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrgUnitTableMap::translateFieldName('UnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrgUnitTableMap::translateFieldName('OrgUnitCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrgUnitTableMap::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->currency_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrgUnitTableMap::translateFieldName('CountryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrgUnitTableMap::translateFieldName('CanDoCustomPlaylist', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_do_custom_playlist = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OrgUnitTableMap::translateFieldName('IsExposed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_exposed = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OrgUnitTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OrgUnitTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OrgUnitTableMap::translateFieldName('OrgunitAdminPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunit_admin_position = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OrgUnitTableMap::translateFieldName('OnBoardRequiredFileds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->on_board_required_fileds = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OrgUnitTableMap::translateFieldName('PunchinOnWeekoff', TableMap::TYPE_PHPNAME, $indexType)];
            $this->punchin_on_weekoff = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OrgUnitTableMap::translateFieldName('PunchinOnHoliday', TableMap::TYPE_PHPNAME, $indexType)];
            $this->punchin_on_holiday = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OrgUnitTableMap::translateFieldName('PunchinOnLeave', TableMap::TYPE_PHPNAME, $indexType)];
            $this->punchin_on_leave = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OrgUnitTableMap::translateFieldName('OutletType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OrgUnitTableMap::translateFieldName('DefaultOutletType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_outlet_type = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = OrgUnitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OrgUnit'), 0, $e);
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
        if ($this->aCurrencies !== null && $this->currency_id !== $this->aCurrencies->getCurrencyId()) {
            $this->aCurrencies = null;
        }
        if ($this->aGeoCountry !== null && $this->country_id !== $this->aGeoCountry->getIcountryid()) {
            $this->aGeoCountry = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OrgUnitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrgUnitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGeoCountry = null;
            $this->aCompany = null;
            $this->aCurrencies = null;
            $this->collAgendatypess = null;

            $this->collAuditEmpUnitss = null;

            $this->collBeatss = null;

            $this->collBrandCampiagns = null;

            $this->collBrandCompetitions = null;

            $this->collBrandss = null;

            $this->collCategoriess = null;

            $this->collClassifications = null;

            $this->collEdPlaylists = null;

            $this->collEdPresentationss = null;

            $this->collEdStatss = null;

            $this->collEmployees = null;

            $this->collExpensess = null;

            $this->collOfferss = null;

            $this->collOnBoardRequestAddresses = null;

            $this->collOnBoardRequiredFieldss = null;

            $this->collOutletOrgDatas = null;

            $this->collOutletOrgNotess = null;

            $this->collOutletStocks = null;

            $this->collOutletStockOtherSummaries = null;

            $this->collOutletStockSummaries = null;

            $this->collPolicyMasters = null;

            $this->collPositionss = null;

            $this->collPrescriberDatas = null;

            $this->collPrescriberTallySummaries = null;

            $this->collPricebookss = null;

            $this->collSgpiMasters = null;

            $this->collTerritoriess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see OrgUnit::setDeleted()
     * @see OrgUnit::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrgUnitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrgUnitQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrgUnitTableMap::DATABASE_NAME);
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
                OrgUnitTableMap::addInstanceToPool($this);
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

            if ($this->aGeoCountry !== null) {
                if ($this->aGeoCountry->isModified() || $this->aGeoCountry->isNew()) {
                    $affectedRows += $this->aGeoCountry->save($con);
                }
                $this->setGeoCountry($this->aGeoCountry);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aCurrencies !== null) {
                if ($this->aCurrencies->isModified() || $this->aCurrencies->isNew()) {
                    $affectedRows += $this->aCurrencies->save($con);
                }
                $this->setCurrencies($this->aCurrencies);
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

            if ($this->agendatypessScheduledForDeletion !== null) {
                if (!$this->agendatypessScheduledForDeletion->isEmpty()) {
                    foreach ($this->agendatypessScheduledForDeletion as $agendatypes) {
                        // need to save related object because we set the relation to null
                        $agendatypes->save($con);
                    }
                    $this->agendatypessScheduledForDeletion = null;
                }
            }

            if ($this->collAgendatypess !== null) {
                foreach ($this->collAgendatypess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->auditEmpUnitssScheduledForDeletion !== null) {
                if (!$this->auditEmpUnitssScheduledForDeletion->isEmpty()) {
                    \entities\AuditEmpUnitsQuery::create()
                        ->filterByPrimaryKeys($this->auditEmpUnitssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->auditEmpUnitssScheduledForDeletion = null;
                }
            }

            if ($this->collAuditEmpUnitss !== null) {
                foreach ($this->collAuditEmpUnitss as $referrerFK) {
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

            if ($this->brandCampiagnsScheduledForDeletion !== null) {
                if (!$this->brandCampiagnsScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnsScheduledForDeletion as $brandCampiagn) {
                        // need to save related object because we set the relation to null
                        $brandCampiagn->save($con);
                    }
                    $this->brandCampiagnsScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagns !== null) {
                foreach ($this->collBrandCampiagns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->brandCompetitionsScheduledForDeletion !== null) {
                if (!$this->brandCompetitionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCompetitionsScheduledForDeletion as $brandCompetition) {
                        // need to save related object because we set the relation to null
                        $brandCompetition->save($con);
                    }
                    $this->brandCompetitionsScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCompetitions !== null) {
                foreach ($this->collBrandCompetitions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->brandssScheduledForDeletion !== null) {
                if (!$this->brandssScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandssScheduledForDeletion as $brands) {
                        // need to save related object because we set the relation to null
                        $brands->save($con);
                    }
                    $this->brandssScheduledForDeletion = null;
                }
            }

            if ($this->collBrandss !== null) {
                foreach ($this->collBrandss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->categoriessScheduledForDeletion !== null) {
                if (!$this->categoriessScheduledForDeletion->isEmpty()) {
                    foreach ($this->categoriessScheduledForDeletion as $categories) {
                        // need to save related object because we set the relation to null
                        $categories->save($con);
                    }
                    $this->categoriessScheduledForDeletion = null;
                }
            }

            if ($this->collCategoriess !== null) {
                foreach ($this->collCategoriess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->classificationsScheduledForDeletion !== null) {
                if (!$this->classificationsScheduledForDeletion->isEmpty()) {
                    foreach ($this->classificationsScheduledForDeletion as $classification) {
                        // need to save related object because we set the relation to null
                        $classification->save($con);
                    }
                    $this->classificationsScheduledForDeletion = null;
                }
            }

            if ($this->collClassifications !== null) {
                foreach ($this->collClassifications as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->edPlaylistsScheduledForDeletion !== null) {
                if (!$this->edPlaylistsScheduledForDeletion->isEmpty()) {
                    foreach ($this->edPlaylistsScheduledForDeletion as $edPlaylist) {
                        // need to save related object because we set the relation to null
                        $edPlaylist->save($con);
                    }
                    $this->edPlaylistsScheduledForDeletion = null;
                }
            }

            if ($this->collEdPlaylists !== null) {
                foreach ($this->collEdPlaylists as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->edPresentationssScheduledForDeletion !== null) {
                if (!$this->edPresentationssScheduledForDeletion->isEmpty()) {
                    foreach ($this->edPresentationssScheduledForDeletion as $edPresentations) {
                        // need to save related object because we set the relation to null
                        $edPresentations->save($con);
                    }
                    $this->edPresentationssScheduledForDeletion = null;
                }
            }

            if ($this->collEdPresentationss !== null) {
                foreach ($this->collEdPresentationss as $referrerFK) {
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

            if ($this->employeesScheduledForDeletion !== null) {
                if (!$this->employeesScheduledForDeletion->isEmpty()) {
                    \entities\EmployeeQuery::create()
                        ->filterByPrimaryKeys($this->employeesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->expensessScheduledForDeletion !== null) {
                if (!$this->expensessScheduledForDeletion->isEmpty()) {
                    \entities\ExpensesQuery::create()
                        ->filterByPrimaryKeys($this->expensessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expensessScheduledForDeletion = null;
                }
            }

            if ($this->collExpensess !== null) {
                foreach ($this->collExpensess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->offerssScheduledForDeletion !== null) {
                if (!$this->offerssScheduledForDeletion->isEmpty()) {
                    foreach ($this->offerssScheduledForDeletion as $offers) {
                        // need to save related object because we set the relation to null
                        $offers->save($con);
                    }
                    $this->offerssScheduledForDeletion = null;
                }
            }

            if ($this->collOfferss !== null) {
                foreach ($this->collOfferss as $referrerFK) {
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

            if ($this->onBoardRequiredFieldssScheduledForDeletion !== null) {
                if (!$this->onBoardRequiredFieldssScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequiredFieldssScheduledForDeletion as $onBoardRequiredFields) {
                        // need to save related object because we set the relation to null
                        $onBoardRequiredFields->save($con);
                    }
                    $this->onBoardRequiredFieldssScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequiredFieldss !== null) {
                foreach ($this->collOnBoardRequiredFieldss as $referrerFK) {
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
                    foreach ($this->outletStocksScheduledForDeletion as $outletStock) {
                        // need to save related object because we set the relation to null
                        $outletStock->save($con);
                    }
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
                    foreach ($this->outletStockOtherSummariesScheduledForDeletion as $outletStockOtherSummary) {
                        // need to save related object because we set the relation to null
                        $outletStockOtherSummary->save($con);
                    }
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
                    foreach ($this->outletStockSummariesScheduledForDeletion as $outletStockSummary) {
                        // need to save related object because we set the relation to null
                        $outletStockSummary->save($con);
                    }
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

            if ($this->policyMastersScheduledForDeletion !== null) {
                if (!$this->policyMastersScheduledForDeletion->isEmpty()) {
                    \entities\PolicyMasterQuery::create()
                        ->filterByPrimaryKeys($this->policyMastersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->policyMastersScheduledForDeletion = null;
                }
            }

            if ($this->collPolicyMasters !== null) {
                foreach ($this->collPolicyMasters as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->positionssScheduledForDeletion !== null) {
                if (!$this->positionssScheduledForDeletion->isEmpty()) {
                    \entities\PositionsQuery::create()
                        ->filterByPrimaryKeys($this->positionssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->pricebookssScheduledForDeletion !== null) {
                if (!$this->pricebookssScheduledForDeletion->isEmpty()) {
                    foreach ($this->pricebookssScheduledForDeletion as $pricebooks) {
                        // need to save related object because we set the relation to null
                        $pricebooks->save($con);
                    }
                    $this->pricebookssScheduledForDeletion = null;
                }
            }

            if ($this->collPricebookss !== null) {
                foreach ($this->collPricebookss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sgpiMastersScheduledForDeletion !== null) {
                if (!$this->sgpiMastersScheduledForDeletion->isEmpty()) {
                    foreach ($this->sgpiMastersScheduledForDeletion as $sgpiMaster) {
                        // need to save related object because we set the relation to null
                        $sgpiMaster->save($con);
                    }
                    $this->sgpiMastersScheduledForDeletion = null;
                }
            }

            if ($this->collSgpiMasters !== null) {
                foreach ($this->collSgpiMasters as $referrerFK) {
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

        $this->modifiedColumns[OrgUnitTableMap::COL_ORGUNITID] = true;
        if (null !== $this->orgunitid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OrgUnitTableMap::COL_ORGUNITID . ')');
        }
        if (null === $this->orgunitid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('org_unit_orgunitid_seq')");
                $this->orgunitid = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OrgUnitTableMap::COL_ORGUNITID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunitid';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_UNIT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'unit_name';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_ORG_UNIT_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_code';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_CURRENCY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'currency_id';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_COUNTRY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'country_id';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST)) {
            $modifiedColumns[':p' . $index++]  = 'can_do_custom_playlist';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_IS_EXPOSED)) {
            $modifiedColumns[':p' . $index++]  = 'is_exposed';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'orgunit_admin_position';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS)) {
            $modifiedColumns[':p' . $index++]  = 'on_board_required_fileds';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF)) {
            $modifiedColumns[':p' . $index++]  = 'punchin_on_weekoff';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY)) {
            $modifiedColumns[':p' . $index++]  = 'punchin_on_holiday';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE)) {
            $modifiedColumns[':p' . $index++]  = 'punchin_on_leave';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_OUTLET_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_type';
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'default_outlet_type';
        }

        $sql = sprintf(
            'INSERT INTO org_unit (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'orgunitid':
                        $stmt->bindValue($identifier, $this->orgunitid, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'unit_name':
                        $stmt->bindValue($identifier, $this->unit_name, PDO::PARAM_STR);

                        break;
                    case 'org_unit_code':
                        $stmt->bindValue($identifier, $this->org_unit_code, PDO::PARAM_STR);

                        break;
                    case 'currency_id':
                        $stmt->bindValue($identifier, $this->currency_id, PDO::PARAM_INT);

                        break;
                    case 'country_id':
                        $stmt->bindValue($identifier, $this->country_id, PDO::PARAM_INT);

                        break;
                    case 'can_do_custom_playlist':
                        $stmt->bindValue($identifier, $this->can_do_custom_playlist, PDO::PARAM_BOOL);

                        break;
                    case 'is_exposed':
                        $stmt->bindValue($identifier, $this->is_exposed, PDO::PARAM_BOOL);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'orgunit_admin_position':
                        $stmt->bindValue($identifier, $this->orgunit_admin_position, PDO::PARAM_INT);

                        break;
                    case 'on_board_required_fileds':
                        $stmt->bindValue($identifier, $this->on_board_required_fileds, PDO::PARAM_STR);

                        break;
                    case 'punchin_on_weekoff':
                        $stmt->bindValue($identifier, $this->punchin_on_weekoff, PDO::PARAM_BOOL);

                        break;
                    case 'punchin_on_holiday':
                        $stmt->bindValue($identifier, $this->punchin_on_holiday, PDO::PARAM_BOOL);

                        break;
                    case 'punchin_on_leave':
                        $stmt->bindValue($identifier, $this->punchin_on_leave, PDO::PARAM_BOOL);

                        break;
                    case 'outlet_type':
                        $stmt->bindValue($identifier, $this->outlet_type, PDO::PARAM_STR);

                        break;
                    case 'default_outlet_type':
                        $stmt->bindValue($identifier, $this->default_outlet_type, PDO::PARAM_STR);

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
        $pos = OrgUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOrgunitid();

            case 1:
                return $this->getCompanyId();

            case 2:
                return $this->getUnitName();

            case 3:
                return $this->getOrgUnitCode();

            case 4:
                return $this->getCurrencyId();

            case 5:
                return $this->getCountryId();

            case 6:
                return $this->getCanDoCustomPlaylist();

            case 7:
                return $this->getIsExposed();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getUpdatedAt();

            case 10:
                return $this->getOrgunitAdminPosition();

            case 11:
                return $this->getOnBoardRequiredFileds();

            case 12:
                return $this->getPunchinOnWeekoff();

            case 13:
                return $this->getPunchinOnHoliday();

            case 14:
                return $this->getPunchinOnLeave();

            case 15:
                return $this->getOutletType();

            case 16:
                return $this->getDefaultOutletType();

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
        if (isset($alreadyDumpedObjects['OrgUnit'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OrgUnit'][$this->hashCode()] = true;
        $keys = OrgUnitTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOrgunitid(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getUnitName(),
            $keys[3] => $this->getOrgUnitCode(),
            $keys[4] => $this->getCurrencyId(),
            $keys[5] => $this->getCountryId(),
            $keys[6] => $this->getCanDoCustomPlaylist(),
            $keys[7] => $this->getIsExposed(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
            $keys[10] => $this->getOrgunitAdminPosition(),
            $keys[11] => $this->getOnBoardRequiredFileds(),
            $keys[12] => $this->getPunchinOnWeekoff(),
            $keys[13] => $this->getPunchinOnHoliday(),
            $keys[14] => $this->getPunchinOnLeave(),
            $keys[15] => $this->getOutletType(),
            $keys[16] => $this->getDefaultOutletType(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGeoCountry) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoCountry';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_country';
                        break;
                    default:
                        $key = 'GeoCountry';
                }

                $result[$key] = $this->aGeoCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aCurrencies) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'currencies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'currencies';
                        break;
                    default:
                        $key = 'Currencies';
                }

                $result[$key] = $this->aCurrencies->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAgendatypess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'agendatypess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'agendatypess';
                        break;
                    default:
                        $key = 'Agendatypess';
                }

                $result[$key] = $this->collAgendatypess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuditEmpUnitss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'auditEmpUnitss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'audit_emp_unitss';
                        break;
                    default:
                        $key = 'AuditEmpUnitss';
                }

                $result[$key] = $this->collAuditEmpUnitss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collBrandCampiagns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagns';
                        break;
                    default:
                        $key = 'BrandCampiagns';
                }

                $result[$key] = $this->collBrandCampiagns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBrandCompetitions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCompetitions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_competitions';
                        break;
                    default:
                        $key = 'BrandCompetitions';
                }

                $result[$key] = $this->collBrandCompetitions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBrandss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brandss';
                        break;
                    default:
                        $key = 'Brandss';
                }

                $result[$key] = $this->collBrandss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCategoriess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categoriess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'categoriess';
                        break;
                    default:
                        $key = 'Categoriess';
                }

                $result[$key] = $this->collCategoriess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collClassifications) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'classifications';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'classifications';
                        break;
                    default:
                        $key = 'Classifications';
                }

                $result[$key] = $this->collClassifications->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEdPlaylists) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edPlaylists';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_playlists';
                        break;
                    default:
                        $key = 'EdPlaylists';
                }

                $result[$key] = $this->collEdPlaylists->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEdPresentationss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edPresentationss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_presentationss';
                        break;
                    default:
                        $key = 'EdPresentationss';
                }

                $result[$key] = $this->collEdPresentationss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collExpensess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expensess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expensess';
                        break;
                    default:
                        $key = 'Expensess';
                }

                $result[$key] = $this->collExpensess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOfferss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'offerss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'offerss';
                        break;
                    default:
                        $key = 'Offerss';
                }

                $result[$key] = $this->collOfferss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOnBoardRequiredFieldss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequiredFieldss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_required_fieldss';
                        break;
                    default:
                        $key = 'OnBoardRequiredFieldss';
                }

                $result[$key] = $this->collOnBoardRequiredFieldss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collPolicyMasters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'policyMasters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'policy_masters';
                        break;
                    default:
                        $key = 'PolicyMasters';
                }

                $result[$key] = $this->collPolicyMasters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collPricebookss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pricebookss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pricebookss';
                        break;
                    default:
                        $key = 'Pricebookss';
                }

                $result[$key] = $this->collPricebookss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSgpiMasters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sgpiMasters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sgpi_masters';
                        break;
                    default:
                        $key = 'SgpiMasters';
                }

                $result[$key] = $this->collSgpiMasters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = OrgUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOrgunitid($value);
                break;
            case 1:
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setUnitName($value);
                break;
            case 3:
                $this->setOrgUnitCode($value);
                break;
            case 4:
                $this->setCurrencyId($value);
                break;
            case 5:
                $this->setCountryId($value);
                break;
            case 6:
                $this->setCanDoCustomPlaylist($value);
                break;
            case 7:
                $this->setIsExposed($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setUpdatedAt($value);
                break;
            case 10:
                $this->setOrgunitAdminPosition($value);
                break;
            case 11:
                $this->setOnBoardRequiredFileds($value);
                break;
            case 12:
                $this->setPunchinOnWeekoff($value);
                break;
            case 13:
                $this->setPunchinOnHoliday($value);
                break;
            case 14:
                $this->setPunchinOnLeave($value);
                break;
            case 15:
                $this->setOutletType($value);
                break;
            case 16:
                $this->setDefaultOutletType($value);
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
        $keys = OrgUnitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOrgunitid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUnitName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setOrgUnitCode($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCurrencyId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCountryId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCanDoCustomPlaylist($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setIsExposed($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOrgunitAdminPosition($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setOnBoardRequiredFileds($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPunchinOnWeekoff($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setPunchinOnHoliday($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPunchinOnLeave($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setOutletType($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDefaultOutletType($arr[$keys[16]]);
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
        $criteria = new Criteria(OrgUnitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrgUnitTableMap::COL_ORGUNITID)) {
            $criteria->add(OrgUnitTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_COMPANY_ID)) {
            $criteria->add(OrgUnitTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_UNIT_NAME)) {
            $criteria->add(OrgUnitTableMap::COL_UNIT_NAME, $this->unit_name);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_ORG_UNIT_CODE)) {
            $criteria->add(OrgUnitTableMap::COL_ORG_UNIT_CODE, $this->org_unit_code);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_CURRENCY_ID)) {
            $criteria->add(OrgUnitTableMap::COL_CURRENCY_ID, $this->currency_id);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_COUNTRY_ID)) {
            $criteria->add(OrgUnitTableMap::COL_COUNTRY_ID, $this->country_id);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST)) {
            $criteria->add(OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST, $this->can_do_custom_playlist);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_IS_EXPOSED)) {
            $criteria->add(OrgUnitTableMap::COL_IS_EXPOSED, $this->is_exposed);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_CREATED_AT)) {
            $criteria->add(OrgUnitTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_UPDATED_AT)) {
            $criteria->add(OrgUnitTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION)) {
            $criteria->add(OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION, $this->orgunit_admin_position);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS)) {
            $criteria->add(OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS, $this->on_board_required_fileds);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF)) {
            $criteria->add(OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF, $this->punchin_on_weekoff);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY)) {
            $criteria->add(OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY, $this->punchin_on_holiday);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE)) {
            $criteria->add(OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE, $this->punchin_on_leave);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_OUTLET_TYPE)) {
            $criteria->add(OrgUnitTableMap::COL_OUTLET_TYPE, $this->outlet_type);
        }
        if ($this->isColumnModified(OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE)) {
            $criteria->add(OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE, $this->default_outlet_type);
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
        $criteria = ChildOrgUnitQuery::create();
        $criteria->add(OrgUnitTableMap::COL_ORGUNITID, $this->orgunitid);

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
        $validPk = null !== $this->getOrgunitid();

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
        return $this->getOrgunitid();
    }

    /**
     * Generic method to set the primary key (orgunitid column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setOrgunitid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOrgunitid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OrgUnit (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setUnitName($this->getUnitName());
        $copyObj->setOrgUnitCode($this->getOrgUnitCode());
        $copyObj->setCurrencyId($this->getCurrencyId());
        $copyObj->setCountryId($this->getCountryId());
        $copyObj->setCanDoCustomPlaylist($this->getCanDoCustomPlaylist());
        $copyObj->setIsExposed($this->getIsExposed());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOrgunitAdminPosition($this->getOrgunitAdminPosition());
        $copyObj->setOnBoardRequiredFileds($this->getOnBoardRequiredFileds());
        $copyObj->setPunchinOnWeekoff($this->getPunchinOnWeekoff());
        $copyObj->setPunchinOnHoliday($this->getPunchinOnHoliday());
        $copyObj->setPunchinOnLeave($this->getPunchinOnLeave());
        $copyObj->setOutletType($this->getOutletType());
        $copyObj->setDefaultOutletType($this->getDefaultOutletType());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAgendatypess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAgendatypes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuditEmpUnitss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuditEmpUnits($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBeatss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBeats($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandCampiagns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagn($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandCompetitions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCompetition($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrands($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCategoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategories($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getClassifications() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addClassification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdPlaylists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdPlaylist($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdPresentationss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdPresentations($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdStatss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdStats($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployees() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployee($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpensess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenses($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOfferss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOffers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequiredFieldss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequiredFields($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletOrgDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletOrgData($relObj->copy($deepCopy));
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

            foreach ($this->getPolicyMasters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPolicyMaster($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPositionss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPositions($relObj->copy($deepCopy));
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

            foreach ($this->getPricebookss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPricebooks($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSgpiMasters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSgpiMaster($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTerritoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTerritories($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOrgunitid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\OrgUnit Clone of current object.
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
     * Declares an association between this object and a ChildGeoCountry object.
     *
     * @param ChildGeoCountry $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoCountry(ChildGeoCountry $v = null)
    {
        if ($v === null) {
            $this->setCountryId(1);
        } else {
            $this->setCountryId($v->getIcountryid());
        }

        $this->aGeoCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addOrgUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoCountry object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoCountry The associated ChildGeoCountry object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoCountry(?ConnectionInterface $con = null)
    {
        if ($this->aGeoCountry === null && ($this->country_id != 0)) {
            $this->aGeoCountry = ChildGeoCountryQuery::create()->findPk($this->country_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoCountry->addOrgUnits($this);
             */
        }

        return $this->aGeoCountry;
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
            $v->addOrgUnit($this);
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
                $this->aCompany->addOrgUnits($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildCurrencies object.
     *
     * @param ChildCurrencies $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCurrencies(ChildCurrencies $v = null)
    {
        if ($v === null) {
            $this->setCurrencyId(NULL);
        } else {
            $this->setCurrencyId($v->getCurrencyId());
        }

        $this->aCurrencies = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCurrencies object, it will not be re-added.
        if ($v !== null) {
            $v->addOrgUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCurrencies object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCurrencies The associated ChildCurrencies object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCurrencies(?ConnectionInterface $con = null)
    {
        if ($this->aCurrencies === null && ($this->currency_id != 0)) {
            $this->aCurrencies = ChildCurrenciesQuery::create()->findPk($this->currency_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCurrencies->addOrgUnits($this);
             */
        }

        return $this->aCurrencies;
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
        if ('Agendatypes' === $relationName) {
            $this->initAgendatypess();
            return;
        }
        if ('AuditEmpUnits' === $relationName) {
            $this->initAuditEmpUnitss();
            return;
        }
        if ('Beats' === $relationName) {
            $this->initBeatss();
            return;
        }
        if ('BrandCampiagn' === $relationName) {
            $this->initBrandCampiagns();
            return;
        }
        if ('BrandCompetition' === $relationName) {
            $this->initBrandCompetitions();
            return;
        }
        if ('Brands' === $relationName) {
            $this->initBrandss();
            return;
        }
        if ('Categories' === $relationName) {
            $this->initCategoriess();
            return;
        }
        if ('Classification' === $relationName) {
            $this->initClassifications();
            return;
        }
        if ('EdPlaylist' === $relationName) {
            $this->initEdPlaylists();
            return;
        }
        if ('EdPresentations' === $relationName) {
            $this->initEdPresentationss();
            return;
        }
        if ('EdStats' === $relationName) {
            $this->initEdStatss();
            return;
        }
        if ('Employee' === $relationName) {
            $this->initEmployees();
            return;
        }
        if ('Expenses' === $relationName) {
            $this->initExpensess();
            return;
        }
        if ('Offers' === $relationName) {
            $this->initOfferss();
            return;
        }
        if ('OnBoardRequestAddress' === $relationName) {
            $this->initOnBoardRequestAddresses();
            return;
        }
        if ('OnBoardRequiredFields' === $relationName) {
            $this->initOnBoardRequiredFieldss();
            return;
        }
        if ('OutletOrgData' === $relationName) {
            $this->initOutletOrgDatas();
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
        if ('PolicyMaster' === $relationName) {
            $this->initPolicyMasters();
            return;
        }
        if ('Positions' === $relationName) {
            $this->initPositionss();
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
        if ('Pricebooks' === $relationName) {
            $this->initPricebookss();
            return;
        }
        if ('SgpiMaster' === $relationName) {
            $this->initSgpiMasters();
            return;
        }
        if ('Territories' === $relationName) {
            $this->initTerritoriess();
            return;
        }
    }

    /**
     * Clears out the collAgendatypess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAgendatypess()
     */
    public function clearAgendatypess()
    {
        $this->collAgendatypess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAgendatypess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAgendatypess($v = true): void
    {
        $this->collAgendatypessPartial = $v;
    }

    /**
     * Initializes the collAgendatypess collection.
     *
     * By default this just sets the collAgendatypess collection to an empty array (like clearcollAgendatypess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAgendatypess(bool $overrideExisting = true): void
    {
        if (null !== $this->collAgendatypess && !$overrideExisting) {
            return;
        }

        $collectionClassName = AgendatypesTableMap::getTableMap()->getCollectionClassName();

        $this->collAgendatypess = new $collectionClassName;
        $this->collAgendatypess->setModel('\entities\Agendatypes');
    }

    /**
     * Gets an array of ChildAgendatypes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAgendatypes[] List of ChildAgendatypes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAgendatypes> List of ChildAgendatypes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAgendatypess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAgendatypessPartial && !$this->isNew();
        if (null === $this->collAgendatypess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAgendatypess) {
                    $this->initAgendatypess();
                } else {
                    $collectionClassName = AgendatypesTableMap::getTableMap()->getCollectionClassName();

                    $collAgendatypess = new $collectionClassName;
                    $collAgendatypess->setModel('\entities\Agendatypes');

                    return $collAgendatypess;
                }
            } else {
                $collAgendatypess = ChildAgendatypesQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAgendatypessPartial && count($collAgendatypess)) {
                        $this->initAgendatypess(false);

                        foreach ($collAgendatypess as $obj) {
                            if (false == $this->collAgendatypess->contains($obj)) {
                                $this->collAgendatypess->append($obj);
                            }
                        }

                        $this->collAgendatypessPartial = true;
                    }

                    return $collAgendatypess;
                }

                if ($partial && $this->collAgendatypess) {
                    foreach ($this->collAgendatypess as $obj) {
                        if ($obj->isNew()) {
                            $collAgendatypess[] = $obj;
                        }
                    }
                }

                $this->collAgendatypess = $collAgendatypess;
                $this->collAgendatypessPartial = false;
            }
        }

        return $this->collAgendatypess;
    }

    /**
     * Sets a collection of ChildAgendatypes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $agendatypess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAgendatypess(Collection $agendatypess, ?ConnectionInterface $con = null)
    {
        /** @var ChildAgendatypes[] $agendatypessToDelete */
        $agendatypessToDelete = $this->getAgendatypess(new Criteria(), $con)->diff($agendatypess);


        $this->agendatypessScheduledForDeletion = $agendatypessToDelete;

        foreach ($agendatypessToDelete as $agendatypesRemoved) {
            $agendatypesRemoved->setOrgUnit(null);
        }

        $this->collAgendatypess = null;
        foreach ($agendatypess as $agendatypes) {
            $this->addAgendatypes($agendatypes);
        }

        $this->collAgendatypess = $agendatypess;
        $this->collAgendatypessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Agendatypes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Agendatypes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAgendatypess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAgendatypessPartial && !$this->isNew();
        if (null === $this->collAgendatypess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAgendatypess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAgendatypess());
            }

            $query = ChildAgendatypesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collAgendatypess);
    }

    /**
     * Method called to associate a ChildAgendatypes object to this object
     * through the ChildAgendatypes foreign key attribute.
     *
     * @param ChildAgendatypes $l ChildAgendatypes
     * @return $this The current object (for fluent API support)
     */
    public function addAgendatypes(ChildAgendatypes $l)
    {
        if ($this->collAgendatypess === null) {
            $this->initAgendatypess();
            $this->collAgendatypessPartial = true;
        }

        if (!$this->collAgendatypess->contains($l)) {
            $this->doAddAgendatypes($l);

            if ($this->agendatypessScheduledForDeletion and $this->agendatypessScheduledForDeletion->contains($l)) {
                $this->agendatypessScheduledForDeletion->remove($this->agendatypessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAgendatypes $agendatypes The ChildAgendatypes object to add.
     */
    protected function doAddAgendatypes(ChildAgendatypes $agendatypes): void
    {
        $this->collAgendatypess[]= $agendatypes;
        $agendatypes->setOrgUnit($this);
    }

    /**
     * @param ChildAgendatypes $agendatypes The ChildAgendatypes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAgendatypes(ChildAgendatypes $agendatypes)
    {
        if ($this->getAgendatypess()->contains($agendatypes)) {
            $pos = $this->collAgendatypess->search($agendatypes);
            $this->collAgendatypess->remove($pos);
            if (null === $this->agendatypessScheduledForDeletion) {
                $this->agendatypessScheduledForDeletion = clone $this->collAgendatypess;
                $this->agendatypessScheduledForDeletion->clear();
            }
            $this->agendatypessScheduledForDeletion[]= $agendatypes;
            $agendatypes->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Agendatypess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAgendatypes[] List of ChildAgendatypes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAgendatypes}> List of ChildAgendatypes objects
     */
    public function getAgendatypessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAgendatypesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getAgendatypess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Agendatypess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAgendatypes[] List of ChildAgendatypes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAgendatypes}> List of ChildAgendatypes objects
     */
    public function getAgendatypessJoinMediaFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAgendatypesQuery::create(null, $criteria);
        $query->joinWith('MediaFiles', $joinBehavior);

        return $this->getAgendatypess($query, $con);
    }

    /**
     * Clears out the collAuditEmpUnitss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAuditEmpUnitss()
     */
    public function clearAuditEmpUnitss()
    {
        $this->collAuditEmpUnitss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAuditEmpUnitss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAuditEmpUnitss($v = true): void
    {
        $this->collAuditEmpUnitssPartial = $v;
    }

    /**
     * Initializes the collAuditEmpUnitss collection.
     *
     * By default this just sets the collAuditEmpUnitss collection to an empty array (like clearcollAuditEmpUnitss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuditEmpUnitss(bool $overrideExisting = true): void
    {
        if (null !== $this->collAuditEmpUnitss && !$overrideExisting) {
            return;
        }

        $collectionClassName = AuditEmpUnitsTableMap::getTableMap()->getCollectionClassName();

        $this->collAuditEmpUnitss = new $collectionClassName;
        $this->collAuditEmpUnitss->setModel('\entities\AuditEmpUnits');
    }

    /**
     * Gets an array of ChildAuditEmpUnits objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAuditEmpUnits[] List of ChildAuditEmpUnits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAuditEmpUnits> List of ChildAuditEmpUnits objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAuditEmpUnitss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAuditEmpUnitssPartial && !$this->isNew();
        if (null === $this->collAuditEmpUnitss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAuditEmpUnitss) {
                    $this->initAuditEmpUnitss();
                } else {
                    $collectionClassName = AuditEmpUnitsTableMap::getTableMap()->getCollectionClassName();

                    $collAuditEmpUnitss = new $collectionClassName;
                    $collAuditEmpUnitss->setModel('\entities\AuditEmpUnits');

                    return $collAuditEmpUnitss;
                }
            } else {
                $collAuditEmpUnitss = ChildAuditEmpUnitsQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAuditEmpUnitssPartial && count($collAuditEmpUnitss)) {
                        $this->initAuditEmpUnitss(false);

                        foreach ($collAuditEmpUnitss as $obj) {
                            if (false == $this->collAuditEmpUnitss->contains($obj)) {
                                $this->collAuditEmpUnitss->append($obj);
                            }
                        }

                        $this->collAuditEmpUnitssPartial = true;
                    }

                    return $collAuditEmpUnitss;
                }

                if ($partial && $this->collAuditEmpUnitss) {
                    foreach ($this->collAuditEmpUnitss as $obj) {
                        if ($obj->isNew()) {
                            $collAuditEmpUnitss[] = $obj;
                        }
                    }
                }

                $this->collAuditEmpUnitss = $collAuditEmpUnitss;
                $this->collAuditEmpUnitssPartial = false;
            }
        }

        return $this->collAuditEmpUnitss;
    }

    /**
     * Sets a collection of ChildAuditEmpUnits objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $auditEmpUnitss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAuditEmpUnitss(Collection $auditEmpUnitss, ?ConnectionInterface $con = null)
    {
        /** @var ChildAuditEmpUnits[] $auditEmpUnitssToDelete */
        $auditEmpUnitssToDelete = $this->getAuditEmpUnitss(new Criteria(), $con)->diff($auditEmpUnitss);


        $this->auditEmpUnitssScheduledForDeletion = $auditEmpUnitssToDelete;

        foreach ($auditEmpUnitssToDelete as $auditEmpUnitsRemoved) {
            $auditEmpUnitsRemoved->setOrgUnit(null);
        }

        $this->collAuditEmpUnitss = null;
        foreach ($auditEmpUnitss as $auditEmpUnits) {
            $this->addAuditEmpUnits($auditEmpUnits);
        }

        $this->collAuditEmpUnitss = $auditEmpUnitss;
        $this->collAuditEmpUnitssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AuditEmpUnits objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related AuditEmpUnits objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAuditEmpUnitss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAuditEmpUnitssPartial && !$this->isNew();
        if (null === $this->collAuditEmpUnitss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuditEmpUnitss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuditEmpUnitss());
            }

            $query = ChildAuditEmpUnitsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collAuditEmpUnitss);
    }

    /**
     * Method called to associate a ChildAuditEmpUnits object to this object
     * through the ChildAuditEmpUnits foreign key attribute.
     *
     * @param ChildAuditEmpUnits $l ChildAuditEmpUnits
     * @return $this The current object (for fluent API support)
     */
    public function addAuditEmpUnits(ChildAuditEmpUnits $l)
    {
        if ($this->collAuditEmpUnitss === null) {
            $this->initAuditEmpUnitss();
            $this->collAuditEmpUnitssPartial = true;
        }

        if (!$this->collAuditEmpUnitss->contains($l)) {
            $this->doAddAuditEmpUnits($l);

            if ($this->auditEmpUnitssScheduledForDeletion and $this->auditEmpUnitssScheduledForDeletion->contains($l)) {
                $this->auditEmpUnitssScheduledForDeletion->remove($this->auditEmpUnitssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAuditEmpUnits $auditEmpUnits The ChildAuditEmpUnits object to add.
     */
    protected function doAddAuditEmpUnits(ChildAuditEmpUnits $auditEmpUnits): void
    {
        $this->collAuditEmpUnitss[]= $auditEmpUnits;
        $auditEmpUnits->setOrgUnit($this);
    }

    /**
     * @param ChildAuditEmpUnits $auditEmpUnits The ChildAuditEmpUnits object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAuditEmpUnits(ChildAuditEmpUnits $auditEmpUnits)
    {
        if ($this->getAuditEmpUnitss()->contains($auditEmpUnits)) {
            $pos = $this->collAuditEmpUnitss->search($auditEmpUnits);
            $this->collAuditEmpUnitss->remove($pos);
            if (null === $this->auditEmpUnitssScheduledForDeletion) {
                $this->auditEmpUnitssScheduledForDeletion = clone $this->collAuditEmpUnitss;
                $this->auditEmpUnitssScheduledForDeletion->clear();
            }
            $this->auditEmpUnitssScheduledForDeletion[]= clone $auditEmpUnits;
            $auditEmpUnits->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related AuditEmpUnitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAuditEmpUnits[] List of ChildAuditEmpUnits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAuditEmpUnits}> List of ChildAuditEmpUnits objects
     */
    public function getAuditEmpUnitssJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAuditEmpUnitsQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getAuditEmpUnitss($query, $con);
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $beatsRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $beats->setOrgUnit($this);
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
            $beats->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats}> List of ChildBeats objects
     */
    public function getBeatssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatsQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getBeatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Clears out the collBrandCampiagns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagns()
     */
    public function clearBrandCampiagns()
    {
        $this->collBrandCampiagns = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagns collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagns($v = true): void
    {
        $this->collBrandCampiagnsPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagns collection.
     *
     * By default this just sets the collBrandCampiagns collection to an empty array (like clearcollBrandCampiagns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagns(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagns && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagns = new $collectionClassName;
        $this->collBrandCampiagns->setModel('\entities\BrandCampiagn');
    }

    /**
     * Gets an array of ChildBrandCampiagn objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn> List of ChildBrandCampiagn objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagns(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnsPartial && !$this->isNew();
        if (null === $this->collBrandCampiagns || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagns) {
                    $this->initBrandCampiagns();
                } else {
                    $collectionClassName = BrandCampiagnTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagns = new $collectionClassName;
                    $collBrandCampiagns->setModel('\entities\BrandCampiagn');

                    return $collBrandCampiagns;
                }
            } else {
                $collBrandCampiagns = ChildBrandCampiagnQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnsPartial && count($collBrandCampiagns)) {
                        $this->initBrandCampiagns(false);

                        foreach ($collBrandCampiagns as $obj) {
                            if (false == $this->collBrandCampiagns->contains($obj)) {
                                $this->collBrandCampiagns->append($obj);
                            }
                        }

                        $this->collBrandCampiagnsPartial = true;
                    }

                    return $collBrandCampiagns;
                }

                if ($partial && $this->collBrandCampiagns) {
                    foreach ($this->collBrandCampiagns as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagns[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagns = $collBrandCampiagns;
                $this->collBrandCampiagnsPartial = false;
            }
        }

        return $this->collBrandCampiagns;
    }

    /**
     * Sets a collection of ChildBrandCampiagn objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagns A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagns(Collection $brandCampiagns, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagn[] $brandCampiagnsToDelete */
        $brandCampiagnsToDelete = $this->getBrandCampiagns(new Criteria(), $con)->diff($brandCampiagns);


        $this->brandCampiagnsScheduledForDeletion = $brandCampiagnsToDelete;

        foreach ($brandCampiagnsToDelete as $brandCampiagnRemoved) {
            $brandCampiagnRemoved->setOrgUnit(null);
        }

        $this->collBrandCampiagns = null;
        foreach ($brandCampiagns as $brandCampiagn) {
            $this->addBrandCampiagn($brandCampiagn);
        }

        $this->collBrandCampiagns = $brandCampiagns;
        $this->collBrandCampiagnsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagn objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagn objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagns(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnsPartial && !$this->isNew();
        if (null === $this->collBrandCampiagns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagns());
            }

            $query = ChildBrandCampiagnQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collBrandCampiagns);
    }

    /**
     * Method called to associate a ChildBrandCampiagn object to this object
     * through the ChildBrandCampiagn foreign key attribute.
     *
     * @param ChildBrandCampiagn $l ChildBrandCampiagn
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagn(ChildBrandCampiagn $l)
    {
        if ($this->collBrandCampiagns === null) {
            $this->initBrandCampiagns();
            $this->collBrandCampiagnsPartial = true;
        }

        if (!$this->collBrandCampiagns->contains($l)) {
            $this->doAddBrandCampiagn($l);

            if ($this->brandCampiagnsScheduledForDeletion and $this->brandCampiagnsScheduledForDeletion->contains($l)) {
                $this->brandCampiagnsScheduledForDeletion->remove($this->brandCampiagnsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagn $brandCampiagn The ChildBrandCampiagn object to add.
     */
    protected function doAddBrandCampiagn(ChildBrandCampiagn $brandCampiagn): void
    {
        $this->collBrandCampiagns[]= $brandCampiagn;
        $brandCampiagn->setOrgUnit($this);
    }

    /**
     * @param ChildBrandCampiagn $brandCampiagn The ChildBrandCampiagn object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagn(ChildBrandCampiagn $brandCampiagn)
    {
        if ($this->getBrandCampiagns()->contains($brandCampiagn)) {
            $pos = $this->collBrandCampiagns->search($brandCampiagn);
            $this->collBrandCampiagns->remove($pos);
            if (null === $this->brandCampiagnsScheduledForDeletion) {
                $this->brandCampiagnsScheduledForDeletion = clone $this->collBrandCampiagns;
                $this->brandCampiagnsScheduledForDeletion->clear();
            }
            $this->brandCampiagnsScheduledForDeletion[]= $brandCampiagn;
            $brandCampiagn->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinDesignations(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('Designations', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }

    /**
     * Clears out the collBrandCompetitions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCompetitions()
     */
    public function clearBrandCompetitions()
    {
        $this->collBrandCompetitions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCompetitions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCompetitions($v = true): void
    {
        $this->collBrandCompetitionsPartial = $v;
    }

    /**
     * Initializes the collBrandCompetitions collection.
     *
     * By default this just sets the collBrandCompetitions collection to an empty array (like clearcollBrandCompetitions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCompetitions(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCompetitions && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCompetitionTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCompetitions = new $collectionClassName;
        $this->collBrandCompetitions->setModel('\entities\BrandCompetition');
    }

    /**
     * Gets an array of ChildBrandCompetition objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition> List of ChildBrandCompetition objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCompetitions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCompetitionsPartial && !$this->isNew();
        if (null === $this->collBrandCompetitions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCompetitions) {
                    $this->initBrandCompetitions();
                } else {
                    $collectionClassName = BrandCompetitionTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCompetitions = new $collectionClassName;
                    $collBrandCompetitions->setModel('\entities\BrandCompetition');

                    return $collBrandCompetitions;
                }
            } else {
                $collBrandCompetitions = ChildBrandCompetitionQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCompetitionsPartial && count($collBrandCompetitions)) {
                        $this->initBrandCompetitions(false);

                        foreach ($collBrandCompetitions as $obj) {
                            if (false == $this->collBrandCompetitions->contains($obj)) {
                                $this->collBrandCompetitions->append($obj);
                            }
                        }

                        $this->collBrandCompetitionsPartial = true;
                    }

                    return $collBrandCompetitions;
                }

                if ($partial && $this->collBrandCompetitions) {
                    foreach ($this->collBrandCompetitions as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCompetitions[] = $obj;
                        }
                    }
                }

                $this->collBrandCompetitions = $collBrandCompetitions;
                $this->collBrandCompetitionsPartial = false;
            }
        }

        return $this->collBrandCompetitions;
    }

    /**
     * Sets a collection of ChildBrandCompetition objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCompetitions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCompetitions(Collection $brandCompetitions, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCompetition[] $brandCompetitionsToDelete */
        $brandCompetitionsToDelete = $this->getBrandCompetitions(new Criteria(), $con)->diff($brandCompetitions);


        $this->brandCompetitionsScheduledForDeletion = $brandCompetitionsToDelete;

        foreach ($brandCompetitionsToDelete as $brandCompetitionRemoved) {
            $brandCompetitionRemoved->setOrgUnit(null);
        }

        $this->collBrandCompetitions = null;
        foreach ($brandCompetitions as $brandCompetition) {
            $this->addBrandCompetition($brandCompetition);
        }

        $this->collBrandCompetitions = $brandCompetitions;
        $this->collBrandCompetitionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCompetition objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCompetition objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCompetitions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCompetitionsPartial && !$this->isNew();
        if (null === $this->collBrandCompetitions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCompetitions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCompetitions());
            }

            $query = ChildBrandCompetitionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collBrandCompetitions);
    }

    /**
     * Method called to associate a ChildBrandCompetition object to this object
     * through the ChildBrandCompetition foreign key attribute.
     *
     * @param ChildBrandCompetition $l ChildBrandCompetition
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCompetition(ChildBrandCompetition $l)
    {
        if ($this->collBrandCompetitions === null) {
            $this->initBrandCompetitions();
            $this->collBrandCompetitionsPartial = true;
        }

        if (!$this->collBrandCompetitions->contains($l)) {
            $this->doAddBrandCompetition($l);

            if ($this->brandCompetitionsScheduledForDeletion and $this->brandCompetitionsScheduledForDeletion->contains($l)) {
                $this->brandCompetitionsScheduledForDeletion->remove($this->brandCompetitionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCompetition $brandCompetition The ChildBrandCompetition object to add.
     */
    protected function doAddBrandCompetition(ChildBrandCompetition $brandCompetition): void
    {
        $this->collBrandCompetitions[]= $brandCompetition;
        $brandCompetition->setOrgUnit($this);
    }

    /**
     * @param ChildBrandCompetition $brandCompetition The ChildBrandCompetition object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCompetition(ChildBrandCompetition $brandCompetition)
    {
        if ($this->getBrandCompetitions()->contains($brandCompetition)) {
            $pos = $this->collBrandCompetitions->search($brandCompetition);
            $this->collBrandCompetitions->remove($pos);
            if (null === $this->brandCompetitionsScheduledForDeletion) {
                $this->brandCompetitionsScheduledForDeletion = clone $this->collBrandCompetitions;
                $this->brandCompetitionsScheduledForDeletion->clear();
            }
            $this->brandCompetitionsScheduledForDeletion[]= $brandCompetition;
            $brandCompetition->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition}> List of ChildBrandCompetition objects
     */
    public function getBrandCompetitionsJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCompetitionQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getBrandCompetitions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition}> List of ChildBrandCompetition objects
     */
    public function getBrandCompetitionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCompetitionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCompetitions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related BrandCompetitions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCompetition[] List of ChildBrandCompetition objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCompetition}> List of ChildBrandCompetition objects
     */
    public function getBrandCompetitionsJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCompetitionQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getBrandCompetitions($query, $con);
    }

    /**
     * Clears out the collBrandss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandss()
     */
    public function clearBrandss()
    {
        $this->collBrandss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandss($v = true): void
    {
        $this->collBrandssPartial = $v;
    }

    /**
     * Initializes the collBrandss collection.
     *
     * By default this just sets the collBrandss collection to an empty array (like clearcollBrandss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandsTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandss = new $collectionClassName;
        $this->collBrandss->setModel('\entities\Brands');
    }

    /**
     * Gets an array of ChildBrands objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrands[] List of ChildBrands objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrands> List of ChildBrands objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandssPartial && !$this->isNew();
        if (null === $this->collBrandss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandss) {
                    $this->initBrandss();
                } else {
                    $collectionClassName = BrandsTableMap::getTableMap()->getCollectionClassName();

                    $collBrandss = new $collectionClassName;
                    $collBrandss->setModel('\entities\Brands');

                    return $collBrandss;
                }
            } else {
                $collBrandss = ChildBrandsQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandssPartial && count($collBrandss)) {
                        $this->initBrandss(false);

                        foreach ($collBrandss as $obj) {
                            if (false == $this->collBrandss->contains($obj)) {
                                $this->collBrandss->append($obj);
                            }
                        }

                        $this->collBrandssPartial = true;
                    }

                    return $collBrandss;
                }

                if ($partial && $this->collBrandss) {
                    foreach ($this->collBrandss as $obj) {
                        if ($obj->isNew()) {
                            $collBrandss[] = $obj;
                        }
                    }
                }

                $this->collBrandss = $collBrandss;
                $this->collBrandssPartial = false;
            }
        }

        return $this->collBrandss;
    }

    /**
     * Sets a collection of ChildBrands objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandss(Collection $brandss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrands[] $brandssToDelete */
        $brandssToDelete = $this->getBrandss(new Criteria(), $con)->diff($brandss);


        $this->brandssScheduledForDeletion = $brandssToDelete;

        foreach ($brandssToDelete as $brandsRemoved) {
            $brandsRemoved->setOrgUnit(null);
        }

        $this->collBrandss = null;
        foreach ($brandss as $brands) {
            $this->addBrands($brands);
        }

        $this->collBrandss = $brandss;
        $this->collBrandssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Brands objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Brands objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandssPartial && !$this->isNew();
        if (null === $this->collBrandss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandss());
            }

            $query = ChildBrandsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collBrandss);
    }

    /**
     * Method called to associate a ChildBrands object to this object
     * through the ChildBrands foreign key attribute.
     *
     * @param ChildBrands $l ChildBrands
     * @return $this The current object (for fluent API support)
     */
    public function addBrands(ChildBrands $l)
    {
        if ($this->collBrandss === null) {
            $this->initBrandss();
            $this->collBrandssPartial = true;
        }

        if (!$this->collBrandss->contains($l)) {
            $this->doAddBrands($l);

            if ($this->brandssScheduledForDeletion and $this->brandssScheduledForDeletion->contains($l)) {
                $this->brandssScheduledForDeletion->remove($this->brandssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrands $brands The ChildBrands object to add.
     */
    protected function doAddBrands(ChildBrands $brands): void
    {
        $this->collBrandss[]= $brands;
        $brands->setOrgUnit($this);
    }

    /**
     * @param ChildBrands $brands The ChildBrands object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrands(ChildBrands $brands)
    {
        if ($this->getBrandss()->contains($brands)) {
            $pos = $this->collBrandss->search($brands);
            $this->collBrandss->remove($pos);
            if (null === $this->brandssScheduledForDeletion) {
                $this->brandssScheduledForDeletion = clone $this->collBrandss;
                $this->brandssScheduledForDeletion->clear();
            }
            $this->brandssScheduledForDeletion[]= $brands;
            $brands->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Brandss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrands[] List of ChildBrands objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrands}> List of ChildBrands objects
     */
    public function getBrandssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandss($query, $con);
    }

    /**
     * Clears out the collCategoriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCategoriess()
     */
    public function clearCategoriess()
    {
        $this->collCategoriess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCategoriess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCategoriess($v = true): void
    {
        $this->collCategoriessPartial = $v;
    }

    /**
     * Initializes the collCategoriess collection.
     *
     * By default this just sets the collCategoriess collection to an empty array (like clearcollCategoriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCategoriess(bool $overrideExisting = true): void
    {
        if (null !== $this->collCategoriess && !$overrideExisting) {
            return;
        }

        $collectionClassName = CategoriesTableMap::getTableMap()->getCollectionClassName();

        $this->collCategoriess = new $collectionClassName;
        $this->collCategoriess->setModel('\entities\Categories');
    }

    /**
     * Gets an array of ChildCategories objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCategories> List of ChildCategories objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCategoriess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriessPartial && !$this->isNew();
        if (null === $this->collCategoriess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCategoriess) {
                    $this->initCategoriess();
                } else {
                    $collectionClassName = CategoriesTableMap::getTableMap()->getCollectionClassName();

                    $collCategoriess = new $collectionClassName;
                    $collCategoriess->setModel('\entities\Categories');

                    return $collCategoriess;
                }
            } else {
                $collCategoriess = ChildCategoriesQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCategoriessPartial && count($collCategoriess)) {
                        $this->initCategoriess(false);

                        foreach ($collCategoriess as $obj) {
                            if (false == $this->collCategoriess->contains($obj)) {
                                $this->collCategoriess->append($obj);
                            }
                        }

                        $this->collCategoriessPartial = true;
                    }

                    return $collCategoriess;
                }

                if ($partial && $this->collCategoriess) {
                    foreach ($this->collCategoriess as $obj) {
                        if ($obj->isNew()) {
                            $collCategoriess[] = $obj;
                        }
                    }
                }

                $this->collCategoriess = $collCategoriess;
                $this->collCategoriessPartial = false;
            }
        }

        return $this->collCategoriess;
    }

    /**
     * Sets a collection of ChildCategories objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $categoriess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCategoriess(Collection $categoriess, ?ConnectionInterface $con = null)
    {
        /** @var ChildCategories[] $categoriessToDelete */
        $categoriessToDelete = $this->getCategoriess(new Criteria(), $con)->diff($categoriess);


        $this->categoriessScheduledForDeletion = $categoriessToDelete;

        foreach ($categoriessToDelete as $categoriesRemoved) {
            $categoriesRemoved->setOrgUnit(null);
        }

        $this->collCategoriess = null;
        foreach ($categoriess as $categories) {
            $this->addCategories($categories);
        }

        $this->collCategoriess = $categoriess;
        $this->collCategoriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Categories objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Categories objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCategoriess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCategoriessPartial && !$this->isNew();
        if (null === $this->collCategoriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCategoriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCategoriess());
            }

            $query = ChildCategoriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collCategoriess);
    }

    /**
     * Method called to associate a ChildCategories object to this object
     * through the ChildCategories foreign key attribute.
     *
     * @param ChildCategories $l ChildCategories
     * @return $this The current object (for fluent API support)
     */
    public function addCategories(ChildCategories $l)
    {
        if ($this->collCategoriess === null) {
            $this->initCategoriess();
            $this->collCategoriessPartial = true;
        }

        if (!$this->collCategoriess->contains($l)) {
            $this->doAddCategories($l);

            if ($this->categoriessScheduledForDeletion and $this->categoriessScheduledForDeletion->contains($l)) {
                $this->categoriessScheduledForDeletion->remove($this->categoriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCategories $categories The ChildCategories object to add.
     */
    protected function doAddCategories(ChildCategories $categories): void
    {
        $this->collCategoriess[]= $categories;
        $categories->setOrgUnit($this);
    }

    /**
     * @param ChildCategories $categories The ChildCategories object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCategories(ChildCategories $categories)
    {
        if ($this->getCategoriess()->contains($categories)) {
            $pos = $this->collCategoriess->search($categories);
            $this->collCategoriess->remove($pos);
            if (null === $this->categoriessScheduledForDeletion) {
                $this->categoriessScheduledForDeletion = clone $this->collCategoriess;
                $this->categoriessScheduledForDeletion->clear();
            }
            $this->categoriessScheduledForDeletion[]= $categories;
            $categories->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Categoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCategories}> List of ChildCategories objects
     */
    public function getCategoriessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoriesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getCategoriess($query, $con);
    }

    /**
     * Clears out the collClassifications collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addClassifications()
     */
    public function clearClassifications()
    {
        $this->collClassifications = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collClassifications collection loaded partially.
     *
     * @return void
     */
    public function resetPartialClassifications($v = true): void
    {
        $this->collClassificationsPartial = $v;
    }

    /**
     * Initializes the collClassifications collection.
     *
     * By default this just sets the collClassifications collection to an empty array (like clearcollClassifications());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initClassifications(bool $overrideExisting = true): void
    {
        if (null !== $this->collClassifications && !$overrideExisting) {
            return;
        }

        $collectionClassName = ClassificationTableMap::getTableMap()->getCollectionClassName();

        $this->collClassifications = new $collectionClassName;
        $this->collClassifications->setModel('\entities\Classification');
    }

    /**
     * Gets an array of ChildClassification objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildClassification[] List of ChildClassification objects
     * @phpstan-return ObjectCollection&\Traversable<ChildClassification> List of ChildClassification objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getClassifications(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collClassificationsPartial && !$this->isNew();
        if (null === $this->collClassifications || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collClassifications) {
                    $this->initClassifications();
                } else {
                    $collectionClassName = ClassificationTableMap::getTableMap()->getCollectionClassName();

                    $collClassifications = new $collectionClassName;
                    $collClassifications->setModel('\entities\Classification');

                    return $collClassifications;
                }
            } else {
                $collClassifications = ChildClassificationQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collClassificationsPartial && count($collClassifications)) {
                        $this->initClassifications(false);

                        foreach ($collClassifications as $obj) {
                            if (false == $this->collClassifications->contains($obj)) {
                                $this->collClassifications->append($obj);
                            }
                        }

                        $this->collClassificationsPartial = true;
                    }

                    return $collClassifications;
                }

                if ($partial && $this->collClassifications) {
                    foreach ($this->collClassifications as $obj) {
                        if ($obj->isNew()) {
                            $collClassifications[] = $obj;
                        }
                    }
                }

                $this->collClassifications = $collClassifications;
                $this->collClassificationsPartial = false;
            }
        }

        return $this->collClassifications;
    }

    /**
     * Sets a collection of ChildClassification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $classifications A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setClassifications(Collection $classifications, ?ConnectionInterface $con = null)
    {
        /** @var ChildClassification[] $classificationsToDelete */
        $classificationsToDelete = $this->getClassifications(new Criteria(), $con)->diff($classifications);


        $this->classificationsScheduledForDeletion = $classificationsToDelete;

        foreach ($classificationsToDelete as $classificationRemoved) {
            $classificationRemoved->setOrgUnit(null);
        }

        $this->collClassifications = null;
        foreach ($classifications as $classification) {
            $this->addClassification($classification);
        }

        $this->collClassifications = $classifications;
        $this->collClassificationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Classification objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Classification objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countClassifications(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collClassificationsPartial && !$this->isNew();
        if (null === $this->collClassifications || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collClassifications) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getClassifications());
            }

            $query = ChildClassificationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collClassifications);
    }

    /**
     * Method called to associate a ChildClassification object to this object
     * through the ChildClassification foreign key attribute.
     *
     * @param ChildClassification $l ChildClassification
     * @return $this The current object (for fluent API support)
     */
    public function addClassification(ChildClassification $l)
    {
        if ($this->collClassifications === null) {
            $this->initClassifications();
            $this->collClassificationsPartial = true;
        }

        if (!$this->collClassifications->contains($l)) {
            $this->doAddClassification($l);

            if ($this->classificationsScheduledForDeletion and $this->classificationsScheduledForDeletion->contains($l)) {
                $this->classificationsScheduledForDeletion->remove($this->classificationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildClassification $classification The ChildClassification object to add.
     */
    protected function doAddClassification(ChildClassification $classification): void
    {
        $this->collClassifications[]= $classification;
        $classification->setOrgUnit($this);
    }

    /**
     * @param ChildClassification $classification The ChildClassification object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeClassification(ChildClassification $classification)
    {
        if ($this->getClassifications()->contains($classification)) {
            $pos = $this->collClassifications->search($classification);
            $this->collClassifications->remove($pos);
            if (null === $this->classificationsScheduledForDeletion) {
                $this->classificationsScheduledForDeletion = clone $this->collClassifications;
                $this->classificationsScheduledForDeletion->clear();
            }
            $this->classificationsScheduledForDeletion[]= $classification;
            $classification->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Classifications from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildClassification[] List of ChildClassification objects
     * @phpstan-return ObjectCollection&\Traversable<ChildClassification}> List of ChildClassification objects
     */
    public function getClassificationsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildClassificationQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getClassifications($query, $con);
    }

    /**
     * Clears out the collEdPlaylists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdPlaylists()
     */
    public function clearEdPlaylists()
    {
        $this->collEdPlaylists = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdPlaylists collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdPlaylists($v = true): void
    {
        $this->collEdPlaylistsPartial = $v;
    }

    /**
     * Initializes the collEdPlaylists collection.
     *
     * By default this just sets the collEdPlaylists collection to an empty array (like clearcollEdPlaylists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdPlaylists(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdPlaylists && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdPlaylistTableMap::getTableMap()->getCollectionClassName();

        $this->collEdPlaylists = new $collectionClassName;
        $this->collEdPlaylists->setModel('\entities\EdPlaylist');
    }

    /**
     * Gets an array of ChildEdPlaylist objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdPlaylist[] List of ChildEdPlaylist objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPlaylist> List of ChildEdPlaylist objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdPlaylists(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdPlaylistsPartial && !$this->isNew();
        if (null === $this->collEdPlaylists || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdPlaylists) {
                    $this->initEdPlaylists();
                } else {
                    $collectionClassName = EdPlaylistTableMap::getTableMap()->getCollectionClassName();

                    $collEdPlaylists = new $collectionClassName;
                    $collEdPlaylists->setModel('\entities\EdPlaylist');

                    return $collEdPlaylists;
                }
            } else {
                $collEdPlaylists = ChildEdPlaylistQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdPlaylistsPartial && count($collEdPlaylists)) {
                        $this->initEdPlaylists(false);

                        foreach ($collEdPlaylists as $obj) {
                            if (false == $this->collEdPlaylists->contains($obj)) {
                                $this->collEdPlaylists->append($obj);
                            }
                        }

                        $this->collEdPlaylistsPartial = true;
                    }

                    return $collEdPlaylists;
                }

                if ($partial && $this->collEdPlaylists) {
                    foreach ($this->collEdPlaylists as $obj) {
                        if ($obj->isNew()) {
                            $collEdPlaylists[] = $obj;
                        }
                    }
                }

                $this->collEdPlaylists = $collEdPlaylists;
                $this->collEdPlaylistsPartial = false;
            }
        }

        return $this->collEdPlaylists;
    }

    /**
     * Sets a collection of ChildEdPlaylist objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edPlaylists A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdPlaylists(Collection $edPlaylists, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdPlaylist[] $edPlaylistsToDelete */
        $edPlaylistsToDelete = $this->getEdPlaylists(new Criteria(), $con)->diff($edPlaylists);


        $this->edPlaylistsScheduledForDeletion = $edPlaylistsToDelete;

        foreach ($edPlaylistsToDelete as $edPlaylistRemoved) {
            $edPlaylistRemoved->setOrgUnit(null);
        }

        $this->collEdPlaylists = null;
        foreach ($edPlaylists as $edPlaylist) {
            $this->addEdPlaylist($edPlaylist);
        }

        $this->collEdPlaylists = $edPlaylists;
        $this->collEdPlaylistsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdPlaylist objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdPlaylist objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdPlaylists(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdPlaylistsPartial && !$this->isNew();
        if (null === $this->collEdPlaylists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdPlaylists) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdPlaylists());
            }

            $query = ChildEdPlaylistQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collEdPlaylists);
    }

    /**
     * Method called to associate a ChildEdPlaylist object to this object
     * through the ChildEdPlaylist foreign key attribute.
     *
     * @param ChildEdPlaylist $l ChildEdPlaylist
     * @return $this The current object (for fluent API support)
     */
    public function addEdPlaylist(ChildEdPlaylist $l)
    {
        if ($this->collEdPlaylists === null) {
            $this->initEdPlaylists();
            $this->collEdPlaylistsPartial = true;
        }

        if (!$this->collEdPlaylists->contains($l)) {
            $this->doAddEdPlaylist($l);

            if ($this->edPlaylistsScheduledForDeletion and $this->edPlaylistsScheduledForDeletion->contains($l)) {
                $this->edPlaylistsScheduledForDeletion->remove($this->edPlaylistsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdPlaylist $edPlaylist The ChildEdPlaylist object to add.
     */
    protected function doAddEdPlaylist(ChildEdPlaylist $edPlaylist): void
    {
        $this->collEdPlaylists[]= $edPlaylist;
        $edPlaylist->setOrgUnit($this);
    }

    /**
     * @param ChildEdPlaylist $edPlaylist The ChildEdPlaylist object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdPlaylist(ChildEdPlaylist $edPlaylist)
    {
        if ($this->getEdPlaylists()->contains($edPlaylist)) {
            $pos = $this->collEdPlaylists->search($edPlaylist);
            $this->collEdPlaylists->remove($pos);
            if (null === $this->edPlaylistsScheduledForDeletion) {
                $this->edPlaylistsScheduledForDeletion = clone $this->collEdPlaylists;
                $this->edPlaylistsScheduledForDeletion->clear();
            }
            $this->edPlaylistsScheduledForDeletion[]= $edPlaylist;
            $edPlaylist->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related EdPlaylists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdPlaylist[] List of ChildEdPlaylist objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPlaylist}> List of ChildEdPlaylist objects
     */
    public function getEdPlaylistsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdPlaylistQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdPlaylists($query, $con);
    }

    /**
     * Clears out the collEdPresentationss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdPresentationss()
     */
    public function clearEdPresentationss()
    {
        $this->collEdPresentationss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdPresentationss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdPresentationss($v = true): void
    {
        $this->collEdPresentationssPartial = $v;
    }

    /**
     * Initializes the collEdPresentationss collection.
     *
     * By default this just sets the collEdPresentationss collection to an empty array (like clearcollEdPresentationss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdPresentationss(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdPresentationss && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdPresentationsTableMap::getTableMap()->getCollectionClassName();

        $this->collEdPresentationss = new $collectionClassName;
        $this->collEdPresentationss->setModel('\entities\EdPresentations');
    }

    /**
     * Gets an array of ChildEdPresentations objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdPresentations[] List of ChildEdPresentations objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPresentations> List of ChildEdPresentations objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdPresentationss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdPresentationssPartial && !$this->isNew();
        if (null === $this->collEdPresentationss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdPresentationss) {
                    $this->initEdPresentationss();
                } else {
                    $collectionClassName = EdPresentationsTableMap::getTableMap()->getCollectionClassName();

                    $collEdPresentationss = new $collectionClassName;
                    $collEdPresentationss->setModel('\entities\EdPresentations');

                    return $collEdPresentationss;
                }
            } else {
                $collEdPresentationss = ChildEdPresentationsQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdPresentationssPartial && count($collEdPresentationss)) {
                        $this->initEdPresentationss(false);

                        foreach ($collEdPresentationss as $obj) {
                            if (false == $this->collEdPresentationss->contains($obj)) {
                                $this->collEdPresentationss->append($obj);
                            }
                        }

                        $this->collEdPresentationssPartial = true;
                    }

                    return $collEdPresentationss;
                }

                if ($partial && $this->collEdPresentationss) {
                    foreach ($this->collEdPresentationss as $obj) {
                        if ($obj->isNew()) {
                            $collEdPresentationss[] = $obj;
                        }
                    }
                }

                $this->collEdPresentationss = $collEdPresentationss;
                $this->collEdPresentationssPartial = false;
            }
        }

        return $this->collEdPresentationss;
    }

    /**
     * Sets a collection of ChildEdPresentations objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edPresentationss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdPresentationss(Collection $edPresentationss, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdPresentations[] $edPresentationssToDelete */
        $edPresentationssToDelete = $this->getEdPresentationss(new Criteria(), $con)->diff($edPresentationss);


        $this->edPresentationssScheduledForDeletion = $edPresentationssToDelete;

        foreach ($edPresentationssToDelete as $edPresentationsRemoved) {
            $edPresentationsRemoved->setOrgUnit(null);
        }

        $this->collEdPresentationss = null;
        foreach ($edPresentationss as $edPresentations) {
            $this->addEdPresentations($edPresentations);
        }

        $this->collEdPresentationss = $edPresentationss;
        $this->collEdPresentationssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdPresentations objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdPresentations objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdPresentationss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdPresentationssPartial && !$this->isNew();
        if (null === $this->collEdPresentationss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdPresentationss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdPresentationss());
            }

            $query = ChildEdPresentationsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collEdPresentationss);
    }

    /**
     * Method called to associate a ChildEdPresentations object to this object
     * through the ChildEdPresentations foreign key attribute.
     *
     * @param ChildEdPresentations $l ChildEdPresentations
     * @return $this The current object (for fluent API support)
     */
    public function addEdPresentations(ChildEdPresentations $l)
    {
        if ($this->collEdPresentationss === null) {
            $this->initEdPresentationss();
            $this->collEdPresentationssPartial = true;
        }

        if (!$this->collEdPresentationss->contains($l)) {
            $this->doAddEdPresentations($l);

            if ($this->edPresentationssScheduledForDeletion and $this->edPresentationssScheduledForDeletion->contains($l)) {
                $this->edPresentationssScheduledForDeletion->remove($this->edPresentationssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdPresentations $edPresentations The ChildEdPresentations object to add.
     */
    protected function doAddEdPresentations(ChildEdPresentations $edPresentations): void
    {
        $this->collEdPresentationss[]= $edPresentations;
        $edPresentations->setOrgUnit($this);
    }

    /**
     * @param ChildEdPresentations $edPresentations The ChildEdPresentations object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdPresentations(ChildEdPresentations $edPresentations)
    {
        if ($this->getEdPresentationss()->contains($edPresentations)) {
            $pos = $this->collEdPresentationss->search($edPresentations);
            $this->collEdPresentationss->remove($pos);
            if (null === $this->edPresentationssScheduledForDeletion) {
                $this->edPresentationssScheduledForDeletion = clone $this->collEdPresentationss;
                $this->edPresentationssScheduledForDeletion->clear();
            }
            $this->edPresentationssScheduledForDeletion[]= $edPresentations;
            $edPresentations->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related EdPresentationss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdPresentations[] List of ChildEdPresentations objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPresentations}> List of ChildEdPresentations objects
     */
    public function getEdPresentationssJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdPresentationsQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getEdPresentationss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related EdPresentationss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdPresentations[] List of ChildEdPresentations objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPresentations}> List of ChildEdPresentations objects
     */
    public function getEdPresentationssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdPresentationsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdPresentationss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related EdPresentationss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdPresentations[] List of ChildEdPresentations objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdPresentations}> List of ChildEdPresentations objects
     */
    public function getEdPresentationssJoinLanguage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdPresentationsQuery::create(null, $criteria);
        $query->joinWith('Language', $joinBehavior);

        return $this->getEdPresentationss($query, $con);
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $edStatsRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $edStats->setOrgUnit($this);
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
            $edStats->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdStats[] List of ChildEdStats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdStats}> List of ChildEdStats objects
     */
    public function getEdStatssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdStatsQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getEdStatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related EdStatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $employeeRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $employee->setOrgUnit($this);
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
            $this->employeesScheduledForDeletion[]= clone $employee;
            $employee->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getEmployees($query, $con);
    }

    /**
     * Clears out the collExpensess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpensess()
     */
    public function clearExpensess()
    {
        $this->collExpensess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpensess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpensess($v = true): void
    {
        $this->collExpensessPartial = $v;
    }

    /**
     * Initializes the collExpensess collection.
     *
     * By default this just sets the collExpensess collection to an empty array (like clearcollExpensess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpensess(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpensess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpensesTableMap::getTableMap()->getCollectionClassName();

        $this->collExpensess = new $collectionClassName;
        $this->collExpensess->setModel('\entities\Expenses');
    }

    /**
     * Gets an array of ChildExpenses objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses> List of ChildExpenses objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpensess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpensess) {
                    $this->initExpensess();
                } else {
                    $collectionClassName = ExpensesTableMap::getTableMap()->getCollectionClassName();

                    $collExpensess = new $collectionClassName;
                    $collExpensess->setModel('\entities\Expenses');

                    return $collExpensess;
                }
            } else {
                $collExpensess = ChildExpensesQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpensessPartial && count($collExpensess)) {
                        $this->initExpensess(false);

                        foreach ($collExpensess as $obj) {
                            if (false == $this->collExpensess->contains($obj)) {
                                $this->collExpensess->append($obj);
                            }
                        }

                        $this->collExpensessPartial = true;
                    }

                    return $collExpensess;
                }

                if ($partial && $this->collExpensess) {
                    foreach ($this->collExpensess as $obj) {
                        if ($obj->isNew()) {
                            $collExpensess[] = $obj;
                        }
                    }
                }

                $this->collExpensess = $collExpensess;
                $this->collExpensessPartial = false;
            }
        }

        return $this->collExpensess;
    }

    /**
     * Sets a collection of ChildExpenses objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expensess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpensess(Collection $expensess, ?ConnectionInterface $con = null)
    {
        /** @var ChildExpenses[] $expensessToDelete */
        $expensessToDelete = $this->getExpensess(new Criteria(), $con)->diff($expensess);


        $this->expensessScheduledForDeletion = $expensessToDelete;

        foreach ($expensessToDelete as $expensesRemoved) {
            $expensesRemoved->setOrgUnit(null);
        }

        $this->collExpensess = null;
        foreach ($expensess as $expenses) {
            $this->addExpenses($expenses);
        }

        $this->collExpensess = $expensess;
        $this->collExpensessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Expenses objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Expenses objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpensess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpensess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpensess());
            }

            $query = ChildExpensesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collExpensess);
    }

    /**
     * Method called to associate a ChildExpenses object to this object
     * through the ChildExpenses foreign key attribute.
     *
     * @param ChildExpenses $l ChildExpenses
     * @return $this The current object (for fluent API support)
     */
    public function addExpenses(ChildExpenses $l)
    {
        if ($this->collExpensess === null) {
            $this->initExpensess();
            $this->collExpensessPartial = true;
        }

        if (!$this->collExpensess->contains($l)) {
            $this->doAddExpenses($l);

            if ($this->expensessScheduledForDeletion and $this->expensessScheduledForDeletion->contains($l)) {
                $this->expensessScheduledForDeletion->remove($this->expensessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenses $expenses The ChildExpenses object to add.
     */
    protected function doAddExpenses(ChildExpenses $expenses): void
    {
        $this->collExpensess[]= $expenses;
        $expenses->setOrgUnit($this);
    }

    /**
     * @param ChildExpenses $expenses The ChildExpenses object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpenses(ChildExpenses $expenses)
    {
        if ($this->getExpensess()->contains($expenses)) {
            $pos = $this->collExpensess->search($expenses);
            $this->collExpensess->remove($pos);
            if (null === $this->expensessScheduledForDeletion) {
                $this->expensessScheduledForDeletion = clone $this->collExpensess;
                $this->expensessScheduledForDeletion->clear();
            }
            $this->expensessScheduledForDeletion[]= clone $expenses;
            $expenses->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinBudgetGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('BudgetGroup', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinCurrencies(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Currencies', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getExpensess($query, $con);
    }

    /**
     * Clears out the collOfferss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOfferss()
     */
    public function clearOfferss()
    {
        $this->collOfferss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOfferss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOfferss($v = true): void
    {
        $this->collOfferssPartial = $v;
    }

    /**
     * Initializes the collOfferss collection.
     *
     * By default this just sets the collOfferss collection to an empty array (like clearcollOfferss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOfferss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOfferss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OffersTableMap::getTableMap()->getCollectionClassName();

        $this->collOfferss = new $collectionClassName;
        $this->collOfferss->setModel('\entities\Offers');
    }

    /**
     * Gets an array of ChildOffers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers> List of ChildOffers objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOfferss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOfferssPartial && !$this->isNew();
        if (null === $this->collOfferss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOfferss) {
                    $this->initOfferss();
                } else {
                    $collectionClassName = OffersTableMap::getTableMap()->getCollectionClassName();

                    $collOfferss = new $collectionClassName;
                    $collOfferss->setModel('\entities\Offers');

                    return $collOfferss;
                }
            } else {
                $collOfferss = ChildOffersQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOfferssPartial && count($collOfferss)) {
                        $this->initOfferss(false);

                        foreach ($collOfferss as $obj) {
                            if (false == $this->collOfferss->contains($obj)) {
                                $this->collOfferss->append($obj);
                            }
                        }

                        $this->collOfferssPartial = true;
                    }

                    return $collOfferss;
                }

                if ($partial && $this->collOfferss) {
                    foreach ($this->collOfferss as $obj) {
                        if ($obj->isNew()) {
                            $collOfferss[] = $obj;
                        }
                    }
                }

                $this->collOfferss = $collOfferss;
                $this->collOfferssPartial = false;
            }
        }

        return $this->collOfferss;
    }

    /**
     * Sets a collection of ChildOffers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $offerss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOfferss(Collection $offerss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOffers[] $offerssToDelete */
        $offerssToDelete = $this->getOfferss(new Criteria(), $con)->diff($offerss);


        $this->offerssScheduledForDeletion = $offerssToDelete;

        foreach ($offerssToDelete as $offersRemoved) {
            $offersRemoved->setOrgUnit(null);
        }

        $this->collOfferss = null;
        foreach ($offerss as $offers) {
            $this->addOffers($offers);
        }

        $this->collOfferss = $offerss;
        $this->collOfferssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Offers objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Offers objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOfferss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOfferssPartial && !$this->isNew();
        if (null === $this->collOfferss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOfferss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOfferss());
            }

            $query = ChildOffersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collOfferss);
    }

    /**
     * Method called to associate a ChildOffers object to this object
     * through the ChildOffers foreign key attribute.
     *
     * @param ChildOffers $l ChildOffers
     * @return $this The current object (for fluent API support)
     */
    public function addOffers(ChildOffers $l)
    {
        if ($this->collOfferss === null) {
            $this->initOfferss();
            $this->collOfferssPartial = true;
        }

        if (!$this->collOfferss->contains($l)) {
            $this->doAddOffers($l);

            if ($this->offerssScheduledForDeletion and $this->offerssScheduledForDeletion->contains($l)) {
                $this->offerssScheduledForDeletion->remove($this->offerssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOffers $offers The ChildOffers object to add.
     */
    protected function doAddOffers(ChildOffers $offers): void
    {
        $this->collOfferss[]= $offers;
        $offers->setOrgUnit($this);
    }

    /**
     * @param ChildOffers $offers The ChildOffers object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOffers(ChildOffers $offers)
    {
        if ($this->getOfferss()->contains($offers)) {
            $pos = $this->collOfferss->search($offers);
            $this->collOfferss->remove($pos);
            if (null === $this->offerssScheduledForDeletion) {
                $this->offerssScheduledForDeletion = clone $this->collOfferss;
                $this->offerssScheduledForDeletion->clear();
            }
            $this->offerssScheduledForDeletion[]= $offers;
            $offers->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOfferss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOfferss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinMediaFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('MediaFiles', $joinBehavior);

        return $this->getOfferss($query, $con);
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $onBoardRequestAddressRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $onBoardRequestAddress->setOrgUnit($this);
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
            $onBoardRequestAddress->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Clears out the collOnBoardRequiredFieldss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequiredFieldss()
     */
    public function clearOnBoardRequiredFieldss()
    {
        $this->collOnBoardRequiredFieldss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequiredFieldss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequiredFieldss($v = true): void
    {
        $this->collOnBoardRequiredFieldssPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequiredFieldss collection.
     *
     * By default this just sets the collOnBoardRequiredFieldss collection to an empty array (like clearcollOnBoardRequiredFieldss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequiredFieldss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequiredFieldss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequiredFieldsTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequiredFieldss = new $collectionClassName;
        $this->collOnBoardRequiredFieldss->setModel('\entities\OnBoardRequiredFields');
    }

    /**
     * Gets an array of ChildOnBoardRequiredFields objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequiredFields[] List of ChildOnBoardRequiredFields objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequiredFields> List of ChildOnBoardRequiredFields objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequiredFieldss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequiredFieldssPartial && !$this->isNew();
        if (null === $this->collOnBoardRequiredFieldss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequiredFieldss) {
                    $this->initOnBoardRequiredFieldss();
                } else {
                    $collectionClassName = OnBoardRequiredFieldsTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequiredFieldss = new $collectionClassName;
                    $collOnBoardRequiredFieldss->setModel('\entities\OnBoardRequiredFields');

                    return $collOnBoardRequiredFieldss;
                }
            } else {
                $collOnBoardRequiredFieldss = ChildOnBoardRequiredFieldsQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequiredFieldssPartial && count($collOnBoardRequiredFieldss)) {
                        $this->initOnBoardRequiredFieldss(false);

                        foreach ($collOnBoardRequiredFieldss as $obj) {
                            if (false == $this->collOnBoardRequiredFieldss->contains($obj)) {
                                $this->collOnBoardRequiredFieldss->append($obj);
                            }
                        }

                        $this->collOnBoardRequiredFieldssPartial = true;
                    }

                    return $collOnBoardRequiredFieldss;
                }

                if ($partial && $this->collOnBoardRequiredFieldss) {
                    foreach ($this->collOnBoardRequiredFieldss as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequiredFieldss[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequiredFieldss = $collOnBoardRequiredFieldss;
                $this->collOnBoardRequiredFieldssPartial = false;
            }
        }

        return $this->collOnBoardRequiredFieldss;
    }

    /**
     * Sets a collection of ChildOnBoardRequiredFields objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequiredFieldss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequiredFieldss(Collection $onBoardRequiredFieldss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequiredFields[] $onBoardRequiredFieldssToDelete */
        $onBoardRequiredFieldssToDelete = $this->getOnBoardRequiredFieldss(new Criteria(), $con)->diff($onBoardRequiredFieldss);


        $this->onBoardRequiredFieldssScheduledForDeletion = $onBoardRequiredFieldssToDelete;

        foreach ($onBoardRequiredFieldssToDelete as $onBoardRequiredFieldsRemoved) {
            $onBoardRequiredFieldsRemoved->setOrgUnit(null);
        }

        $this->collOnBoardRequiredFieldss = null;
        foreach ($onBoardRequiredFieldss as $onBoardRequiredFields) {
            $this->addOnBoardRequiredFields($onBoardRequiredFields);
        }

        $this->collOnBoardRequiredFieldss = $onBoardRequiredFieldss;
        $this->collOnBoardRequiredFieldssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequiredFields objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequiredFields objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequiredFieldss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequiredFieldssPartial && !$this->isNew();
        if (null === $this->collOnBoardRequiredFieldss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequiredFieldss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequiredFieldss());
            }

            $query = ChildOnBoardRequiredFieldsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collOnBoardRequiredFieldss);
    }

    /**
     * Method called to associate a ChildOnBoardRequiredFields object to this object
     * through the ChildOnBoardRequiredFields foreign key attribute.
     *
     * @param ChildOnBoardRequiredFields $l ChildOnBoardRequiredFields
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequiredFields(ChildOnBoardRequiredFields $l)
    {
        if ($this->collOnBoardRequiredFieldss === null) {
            $this->initOnBoardRequiredFieldss();
            $this->collOnBoardRequiredFieldssPartial = true;
        }

        if (!$this->collOnBoardRequiredFieldss->contains($l)) {
            $this->doAddOnBoardRequiredFields($l);

            if ($this->onBoardRequiredFieldssScheduledForDeletion and $this->onBoardRequiredFieldssScheduledForDeletion->contains($l)) {
                $this->onBoardRequiredFieldssScheduledForDeletion->remove($this->onBoardRequiredFieldssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequiredFields $onBoardRequiredFields The ChildOnBoardRequiredFields object to add.
     */
    protected function doAddOnBoardRequiredFields(ChildOnBoardRequiredFields $onBoardRequiredFields): void
    {
        $this->collOnBoardRequiredFieldss[]= $onBoardRequiredFields;
        $onBoardRequiredFields->setOrgUnit($this);
    }

    /**
     * @param ChildOnBoardRequiredFields $onBoardRequiredFields The ChildOnBoardRequiredFields object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequiredFields(ChildOnBoardRequiredFields $onBoardRequiredFields)
    {
        if ($this->getOnBoardRequiredFieldss()->contains($onBoardRequiredFields)) {
            $pos = $this->collOnBoardRequiredFieldss->search($onBoardRequiredFields);
            $this->collOnBoardRequiredFieldss->remove($pos);
            if (null === $this->onBoardRequiredFieldssScheduledForDeletion) {
                $this->onBoardRequiredFieldssScheduledForDeletion = clone $this->collOnBoardRequiredFieldss;
                $this->onBoardRequiredFieldssScheduledForDeletion->clear();
            }
            $this->onBoardRequiredFieldssScheduledForDeletion[]= $onBoardRequiredFields;
            $onBoardRequiredFields->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequiredFieldss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequiredFields[] List of ChildOnBoardRequiredFields objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequiredFields}> List of ChildOnBoardRequiredFields objects
     */
    public function getOnBoardRequiredFieldssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequiredFieldsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequiredFieldss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OnBoardRequiredFieldss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequiredFields[] List of ChildOnBoardRequiredFields objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequiredFields}> List of ChildOnBoardRequiredFields objects
     */
    public function getOnBoardRequiredFieldssJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequiredFieldsQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequiredFieldss($query, $con);
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $outletOrgDataRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $outletOrgData->setOrgUnit($this);
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
            $outletOrgData->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletOrgDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $outletOrgNotesRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $outletOrgNotes->setOrgUnit($this);
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
            $outletOrgNotes->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletOrgNotess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletOrgNotess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletOrgNotes[] List of ChildOutletOrgNotes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletOrgNotes}> List of ChildOutletOrgNotes objects
     */
    public function getOutletOrgNotessJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletOrgNotesQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $outletStockRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $outletStock->setOrgUnit($this);
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
            $this->outletStocksScheduledForDeletion[]= $outletStock;
            $outletStock->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $outletStockOtherSummaryRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $outletStockOtherSummary->setOrgUnit($this);
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
            $this->outletStockOtherSummariesScheduledForDeletion[]= $outletStockOtherSummary;
            $outletStockOtherSummary->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockOtherSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $outletStockSummaryRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $outletStockSummary->setOrgUnit($this);
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
            $this->outletStockSummariesScheduledForDeletion[]= $outletStockSummary;
            $outletStockSummary->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related OutletStockSummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Clears out the collPolicyMasters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPolicyMasters()
     */
    public function clearPolicyMasters()
    {
        $this->collPolicyMasters = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPolicyMasters collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPolicyMasters($v = true): void
    {
        $this->collPolicyMastersPartial = $v;
    }

    /**
     * Initializes the collPolicyMasters collection.
     *
     * By default this just sets the collPolicyMasters collection to an empty array (like clearcollPolicyMasters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPolicyMasters(bool $overrideExisting = true): void
    {
        if (null !== $this->collPolicyMasters && !$overrideExisting) {
            return;
        }

        $collectionClassName = PolicyMasterTableMap::getTableMap()->getCollectionClassName();

        $this->collPolicyMasters = new $collectionClassName;
        $this->collPolicyMasters->setModel('\entities\PolicyMaster');
    }

    /**
     * Gets an array of ChildPolicyMaster objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPolicyMaster[] List of ChildPolicyMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPolicyMaster> List of ChildPolicyMaster objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPolicyMasters(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPolicyMastersPartial && !$this->isNew();
        if (null === $this->collPolicyMasters || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPolicyMasters) {
                    $this->initPolicyMasters();
                } else {
                    $collectionClassName = PolicyMasterTableMap::getTableMap()->getCollectionClassName();

                    $collPolicyMasters = new $collectionClassName;
                    $collPolicyMasters->setModel('\entities\PolicyMaster');

                    return $collPolicyMasters;
                }
            } else {
                $collPolicyMasters = ChildPolicyMasterQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPolicyMastersPartial && count($collPolicyMasters)) {
                        $this->initPolicyMasters(false);

                        foreach ($collPolicyMasters as $obj) {
                            if (false == $this->collPolicyMasters->contains($obj)) {
                                $this->collPolicyMasters->append($obj);
                            }
                        }

                        $this->collPolicyMastersPartial = true;
                    }

                    return $collPolicyMasters;
                }

                if ($partial && $this->collPolicyMasters) {
                    foreach ($this->collPolicyMasters as $obj) {
                        if ($obj->isNew()) {
                            $collPolicyMasters[] = $obj;
                        }
                    }
                }

                $this->collPolicyMasters = $collPolicyMasters;
                $this->collPolicyMastersPartial = false;
            }
        }

        return $this->collPolicyMasters;
    }

    /**
     * Sets a collection of ChildPolicyMaster objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $policyMasters A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPolicyMasters(Collection $policyMasters, ?ConnectionInterface $con = null)
    {
        /** @var ChildPolicyMaster[] $policyMastersToDelete */
        $policyMastersToDelete = $this->getPolicyMasters(new Criteria(), $con)->diff($policyMasters);


        $this->policyMastersScheduledForDeletion = $policyMastersToDelete;

        foreach ($policyMastersToDelete as $policyMasterRemoved) {
            $policyMasterRemoved->setOrgUnit(null);
        }

        $this->collPolicyMasters = null;
        foreach ($policyMasters as $policyMaster) {
            $this->addPolicyMaster($policyMaster);
        }

        $this->collPolicyMasters = $policyMasters;
        $this->collPolicyMastersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PolicyMaster objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related PolicyMaster objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPolicyMasters(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPolicyMastersPartial && !$this->isNew();
        if (null === $this->collPolicyMasters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPolicyMasters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPolicyMasters());
            }

            $query = ChildPolicyMasterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collPolicyMasters);
    }

    /**
     * Method called to associate a ChildPolicyMaster object to this object
     * through the ChildPolicyMaster foreign key attribute.
     *
     * @param ChildPolicyMaster $l ChildPolicyMaster
     * @return $this The current object (for fluent API support)
     */
    public function addPolicyMaster(ChildPolicyMaster $l)
    {
        if ($this->collPolicyMasters === null) {
            $this->initPolicyMasters();
            $this->collPolicyMastersPartial = true;
        }

        if (!$this->collPolicyMasters->contains($l)) {
            $this->doAddPolicyMaster($l);

            if ($this->policyMastersScheduledForDeletion and $this->policyMastersScheduledForDeletion->contains($l)) {
                $this->policyMastersScheduledForDeletion->remove($this->policyMastersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPolicyMaster $policyMaster The ChildPolicyMaster object to add.
     */
    protected function doAddPolicyMaster(ChildPolicyMaster $policyMaster): void
    {
        $this->collPolicyMasters[]= $policyMaster;
        $policyMaster->setOrgUnit($this);
    }

    /**
     * @param ChildPolicyMaster $policyMaster The ChildPolicyMaster object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePolicyMaster(ChildPolicyMaster $policyMaster)
    {
        if ($this->getPolicyMasters()->contains($policyMaster)) {
            $pos = $this->collPolicyMasters->search($policyMaster);
            $this->collPolicyMasters->remove($pos);
            if (null === $this->policyMastersScheduledForDeletion) {
                $this->policyMastersScheduledForDeletion = clone $this->collPolicyMasters;
                $this->policyMastersScheduledForDeletion->clear();
            }
            $this->policyMastersScheduledForDeletion[]= clone $policyMaster;
            $policyMaster->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PolicyMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPolicyMaster[] List of ChildPolicyMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPolicyMaster}> List of ChildPolicyMaster objects
     */
    public function getPolicyMastersJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPolicyMasterQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getPolicyMasters($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PolicyMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPolicyMaster[] List of ChildPolicyMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPolicyMaster}> List of ChildPolicyMaster objects
     */
    public function getPolicyMastersJoinCurrencies(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPolicyMasterQuery::create(null, $criteria);
        $query->joinWith('Currencies', $joinBehavior);

        return $this->getPolicyMasters($query, $con);
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $positionsRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $positions->setOrgUnit($this);
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
            $this->positionssScheduledForDeletion[]= clone $positions;
            $positions->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Positionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Positionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPositions[] List of ChildPositions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPositions}> List of ChildPositions objects
     */
    public function getPositionssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPositionsQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getPositionss($query, $con);
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $prescriberDataRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $prescriberData->setOrgUnit($this);
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
            $prescriberData->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $prescriberTallySummaryRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $prescriberTallySummary->setOrgUnit($this);
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
            $prescriberTallySummary->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Clears out the collPricebookss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPricebookss()
     */
    public function clearPricebookss()
    {
        $this->collPricebookss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPricebookss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPricebookss($v = true): void
    {
        $this->collPricebookssPartial = $v;
    }

    /**
     * Initializes the collPricebookss collection.
     *
     * By default this just sets the collPricebookss collection to an empty array (like clearcollPricebookss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPricebookss(bool $overrideExisting = true): void
    {
        if (null !== $this->collPricebookss && !$overrideExisting) {
            return;
        }

        $collectionClassName = PricebooksTableMap::getTableMap()->getCollectionClassName();

        $this->collPricebookss = new $collectionClassName;
        $this->collPricebookss->setModel('\entities\Pricebooks');
    }

    /**
     * Gets an array of ChildPricebooks objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPricebooks[] List of ChildPricebooks objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPricebooks> List of ChildPricebooks objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPricebookss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPricebookssPartial && !$this->isNew();
        if (null === $this->collPricebookss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPricebookss) {
                    $this->initPricebookss();
                } else {
                    $collectionClassName = PricebooksTableMap::getTableMap()->getCollectionClassName();

                    $collPricebookss = new $collectionClassName;
                    $collPricebookss->setModel('\entities\Pricebooks');

                    return $collPricebookss;
                }
            } else {
                $collPricebookss = ChildPricebooksQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPricebookssPartial && count($collPricebookss)) {
                        $this->initPricebookss(false);

                        foreach ($collPricebookss as $obj) {
                            if (false == $this->collPricebookss->contains($obj)) {
                                $this->collPricebookss->append($obj);
                            }
                        }

                        $this->collPricebookssPartial = true;
                    }

                    return $collPricebookss;
                }

                if ($partial && $this->collPricebookss) {
                    foreach ($this->collPricebookss as $obj) {
                        if ($obj->isNew()) {
                            $collPricebookss[] = $obj;
                        }
                    }
                }

                $this->collPricebookss = $collPricebookss;
                $this->collPricebookssPartial = false;
            }
        }

        return $this->collPricebookss;
    }

    /**
     * Sets a collection of ChildPricebooks objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $pricebookss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookss(Collection $pricebookss, ?ConnectionInterface $con = null)
    {
        /** @var ChildPricebooks[] $pricebookssToDelete */
        $pricebookssToDelete = $this->getPricebookss(new Criteria(), $con)->diff($pricebookss);


        $this->pricebookssScheduledForDeletion = $pricebookssToDelete;

        foreach ($pricebookssToDelete as $pricebooksRemoved) {
            $pricebooksRemoved->setOrgUnit(null);
        }

        $this->collPricebookss = null;
        foreach ($pricebookss as $pricebooks) {
            $this->addPricebooks($pricebooks);
        }

        $this->collPricebookss = $pricebookss;
        $this->collPricebookssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pricebooks objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Pricebooks objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPricebookss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPricebookssPartial && !$this->isNew();
        if (null === $this->collPricebookss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPricebookss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPricebookss());
            }

            $query = ChildPricebooksQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collPricebookss);
    }

    /**
     * Method called to associate a ChildPricebooks object to this object
     * through the ChildPricebooks foreign key attribute.
     *
     * @param ChildPricebooks $l ChildPricebooks
     * @return $this The current object (for fluent API support)
     */
    public function addPricebooks(ChildPricebooks $l)
    {
        if ($this->collPricebookss === null) {
            $this->initPricebookss();
            $this->collPricebookssPartial = true;
        }

        if (!$this->collPricebookss->contains($l)) {
            $this->doAddPricebooks($l);

            if ($this->pricebookssScheduledForDeletion and $this->pricebookssScheduledForDeletion->contains($l)) {
                $this->pricebookssScheduledForDeletion->remove($this->pricebookssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPricebooks $pricebooks The ChildPricebooks object to add.
     */
    protected function doAddPricebooks(ChildPricebooks $pricebooks): void
    {
        $this->collPricebookss[]= $pricebooks;
        $pricebooks->setOrgUnit($this);
    }

    /**
     * @param ChildPricebooks $pricebooks The ChildPricebooks object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePricebooks(ChildPricebooks $pricebooks)
    {
        if ($this->getPricebookss()->contains($pricebooks)) {
            $pos = $this->collPricebookss->search($pricebooks);
            $this->collPricebookss->remove($pos);
            if (null === $this->pricebookssScheduledForDeletion) {
                $this->pricebookssScheduledForDeletion = clone $this->collPricebookss;
                $this->pricebookssScheduledForDeletion->clear();
            }
            $this->pricebookssScheduledForDeletion[]= $pricebooks;
            $pricebooks->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Pricebookss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPricebooks[] List of ChildPricebooks objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPricebooks}> List of ChildPricebooks objects
     */
    public function getPricebookssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPricebooksQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getPricebookss($query, $con);
    }

    /**
     * Clears out the collSgpiMasters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSgpiMasters()
     */
    public function clearSgpiMasters()
    {
        $this->collSgpiMasters = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSgpiMasters collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSgpiMasters($v = true): void
    {
        $this->collSgpiMastersPartial = $v;
    }

    /**
     * Initializes the collSgpiMasters collection.
     *
     * By default this just sets the collSgpiMasters collection to an empty array (like clearcollSgpiMasters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSgpiMasters(bool $overrideExisting = true): void
    {
        if (null !== $this->collSgpiMasters && !$overrideExisting) {
            return;
        }

        $collectionClassName = SgpiMasterTableMap::getTableMap()->getCollectionClassName();

        $this->collSgpiMasters = new $collectionClassName;
        $this->collSgpiMasters->setModel('\entities\SgpiMaster');
    }

    /**
     * Gets an array of ChildSgpiMaster objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrgUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster> List of ChildSgpiMaster objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSgpiMasters(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSgpiMastersPartial && !$this->isNew();
        if (null === $this->collSgpiMasters || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSgpiMasters) {
                    $this->initSgpiMasters();
                } else {
                    $collectionClassName = SgpiMasterTableMap::getTableMap()->getCollectionClassName();

                    $collSgpiMasters = new $collectionClassName;
                    $collSgpiMasters->setModel('\entities\SgpiMaster');

                    return $collSgpiMasters;
                }
            } else {
                $collSgpiMasters = ChildSgpiMasterQuery::create(null, $criteria)
                    ->filterByOrgUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSgpiMastersPartial && count($collSgpiMasters)) {
                        $this->initSgpiMasters(false);

                        foreach ($collSgpiMasters as $obj) {
                            if (false == $this->collSgpiMasters->contains($obj)) {
                                $this->collSgpiMasters->append($obj);
                            }
                        }

                        $this->collSgpiMastersPartial = true;
                    }

                    return $collSgpiMasters;
                }

                if ($partial && $this->collSgpiMasters) {
                    foreach ($this->collSgpiMasters as $obj) {
                        if ($obj->isNew()) {
                            $collSgpiMasters[] = $obj;
                        }
                    }
                }

                $this->collSgpiMasters = $collSgpiMasters;
                $this->collSgpiMastersPartial = false;
            }
        }

        return $this->collSgpiMasters;
    }

    /**
     * Sets a collection of ChildSgpiMaster objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $sgpiMasters A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiMasters(Collection $sgpiMasters, ?ConnectionInterface $con = null)
    {
        /** @var ChildSgpiMaster[] $sgpiMastersToDelete */
        $sgpiMastersToDelete = $this->getSgpiMasters(new Criteria(), $con)->diff($sgpiMasters);


        $this->sgpiMastersScheduledForDeletion = $sgpiMastersToDelete;

        foreach ($sgpiMastersToDelete as $sgpiMasterRemoved) {
            $sgpiMasterRemoved->setOrgUnit(null);
        }

        $this->collSgpiMasters = null;
        foreach ($sgpiMasters as $sgpiMaster) {
            $this->addSgpiMaster($sgpiMaster);
        }

        $this->collSgpiMasters = $sgpiMasters;
        $this->collSgpiMastersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SgpiMaster objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SgpiMaster objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSgpiMasters(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSgpiMastersPartial && !$this->isNew();
        if (null === $this->collSgpiMasters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSgpiMasters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSgpiMasters());
            }

            $query = ChildSgpiMasterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrgUnit($this)
                ->count($con);
        }

        return count($this->collSgpiMasters);
    }

    /**
     * Method called to associate a ChildSgpiMaster object to this object
     * through the ChildSgpiMaster foreign key attribute.
     *
     * @param ChildSgpiMaster $l ChildSgpiMaster
     * @return $this The current object (for fluent API support)
     */
    public function addSgpiMaster(ChildSgpiMaster $l)
    {
        if ($this->collSgpiMasters === null) {
            $this->initSgpiMasters();
            $this->collSgpiMastersPartial = true;
        }

        if (!$this->collSgpiMasters->contains($l)) {
            $this->doAddSgpiMaster($l);

            if ($this->sgpiMastersScheduledForDeletion and $this->sgpiMastersScheduledForDeletion->contains($l)) {
                $this->sgpiMastersScheduledForDeletion->remove($this->sgpiMastersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSgpiMaster $sgpiMaster The ChildSgpiMaster object to add.
     */
    protected function doAddSgpiMaster(ChildSgpiMaster $sgpiMaster): void
    {
        $this->collSgpiMasters[]= $sgpiMaster;
        $sgpiMaster->setOrgUnit($this);
    }

    /**
     * @param ChildSgpiMaster $sgpiMaster The ChildSgpiMaster object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSgpiMaster(ChildSgpiMaster $sgpiMaster)
    {
        if ($this->getSgpiMasters()->contains($sgpiMaster)) {
            $pos = $this->collSgpiMasters->search($sgpiMaster);
            $this->collSgpiMasters->remove($pos);
            if (null === $this->sgpiMastersScheduledForDeletion) {
                $this->sgpiMastersScheduledForDeletion = clone $this->collSgpiMasters;
                $this->sgpiMastersScheduledForDeletion->clear();
            }
            $this->sgpiMastersScheduledForDeletion[]= $sgpiMaster;
            $sgpiMaster->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster}> List of ChildSgpiMaster objects
     */
    public function getSgpiMastersJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiMasterQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSgpiMasters($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster}> List of ChildSgpiMaster objects
     */
    public function getSgpiMastersJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiMasterQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getSgpiMasters($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related SgpiMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiMaster[] List of ChildSgpiMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiMaster}> List of ChildSgpiMaster objects
     */
    public function getSgpiMastersJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiMasterQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getSgpiMasters($query, $con);
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
     * If this ChildOrgUnit is new, it will return
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
                    ->filterByOrgUnit($this)
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
            $territoriesRemoved->setOrgUnit(null);
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
                ->filterByOrgUnit($this)
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
        $territories->setOrgUnit($this);
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
            $territories->setOrgUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Territoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
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
     * Otherwise if this OrgUnit is new, it will return
     * an empty collection; or if this OrgUnit has previously
     * been saved, it will retrieve related Territoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrgUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTerritories[] List of ChildTerritories objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritories}> List of ChildTerritories objects
     */
    public function getTerritoriessJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTerritoriesQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getTerritoriess($query, $con);
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
        if (null !== $this->aGeoCountry) {
            $this->aGeoCountry->removeOrgUnit($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeOrgUnit($this);
        }
        if (null !== $this->aCurrencies) {
            $this->aCurrencies->removeOrgUnit($this);
        }
        $this->orgunitid = null;
        $this->company_id = null;
        $this->unit_name = null;
        $this->org_unit_code = null;
        $this->currency_id = null;
        $this->country_id = null;
        $this->can_do_custom_playlist = null;
        $this->is_exposed = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->orgunit_admin_position = null;
        $this->on_board_required_fileds = null;
        $this->punchin_on_weekoff = null;
        $this->punchin_on_holiday = null;
        $this->punchin_on_leave = null;
        $this->outlet_type = null;
        $this->default_outlet_type = null;
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
            if ($this->collAgendatypess) {
                foreach ($this->collAgendatypess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuditEmpUnitss) {
                foreach ($this->collAuditEmpUnitss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBeatss) {
                foreach ($this->collBeatss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandCampiagns) {
                foreach ($this->collBrandCampiagns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandCompetitions) {
                foreach ($this->collBrandCompetitions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandss) {
                foreach ($this->collBrandss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCategoriess) {
                foreach ($this->collCategoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collClassifications) {
                foreach ($this->collClassifications as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdPlaylists) {
                foreach ($this->collEdPlaylists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdPresentationss) {
                foreach ($this->collEdPresentationss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdStatss) {
                foreach ($this->collEdStatss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployees) {
                foreach ($this->collEmployees as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpensess) {
                foreach ($this->collExpensess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOfferss) {
                foreach ($this->collOfferss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestAddresses) {
                foreach ($this->collOnBoardRequestAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequiredFieldss) {
                foreach ($this->collOnBoardRequiredFieldss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletOrgDatas) {
                foreach ($this->collOutletOrgDatas as $o) {
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
            if ($this->collPolicyMasters) {
                foreach ($this->collPolicyMasters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPositionss) {
                foreach ($this->collPositionss as $o) {
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
            if ($this->collPricebookss) {
                foreach ($this->collPricebookss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSgpiMasters) {
                foreach ($this->collSgpiMasters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTerritoriess) {
                foreach ($this->collTerritoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAgendatypess = null;
        $this->collAuditEmpUnitss = null;
        $this->collBeatss = null;
        $this->collBrandCampiagns = null;
        $this->collBrandCompetitions = null;
        $this->collBrandss = null;
        $this->collCategoriess = null;
        $this->collClassifications = null;
        $this->collEdPlaylists = null;
        $this->collEdPresentationss = null;
        $this->collEdStatss = null;
        $this->collEmployees = null;
        $this->collExpensess = null;
        $this->collOfferss = null;
        $this->collOnBoardRequestAddresses = null;
        $this->collOnBoardRequiredFieldss = null;
        $this->collOutletOrgDatas = null;
        $this->collOutletOrgNotess = null;
        $this->collOutletStocks = null;
        $this->collOutletStockOtherSummaries = null;
        $this->collOutletStockSummaries = null;
        $this->collPolicyMasters = null;
        $this->collPositionss = null;
        $this->collPrescriberDatas = null;
        $this->collPrescriberTallySummaries = null;
        $this->collPricebookss = null;
        $this->collSgpiMasters = null;
        $this->collTerritoriess = null;
        $this->aGeoCountry = null;
        $this->aCompany = null;
        $this->aCurrencies = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrgUnitTableMap::DEFAULT_STRING_FORMAT);
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
