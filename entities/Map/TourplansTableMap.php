<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\Tourplans;
use entities\TourplansQuery;


/**
 * This class defines the structure of the 'tourplans' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TourplansTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TourplansTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'tourplans';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Tourplans';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Tourplans';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Tourplans';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the tp_id field
     */
    public const COL_TP_ID = 'tourplans.tp_id';

    /**
     * the column name for the tp_date field
     */
    public const COL_TP_DATE = 'tourplans.tp_date';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'tourplans.company_id';

    /**
     * the column name for the tp_remark field
     */
    public const COL_TP_REMARK = 'tourplans.tp_remark';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'tourplans.position_id';

    /**
     * the column name for the agendacontroltype field
     */
    public const COL_AGENDACONTROLTYPE = 'tourplans.agendacontroltype';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'tourplans.beat_id';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'tourplans.itownid';

    /**
     * the column name for the weekday field
     */
    public const COL_WEEKDAY = 'tourplans.weekday';

    /**
     * the column name for the weeknumber field
     */
    public const COL_WEEKNUMBER = 'tourplans.weeknumber';

    /**
     * the column name for the agenda_id field
     */
    public const COL_AGENDA_ID = 'tourplans.agenda_id';

    /**
     * the column name for the isjw field
     */
    public const COL_ISJW = 'tourplans.isjw';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'tourplans.outlet_org_data_id';

    /**
     * the column name for the mtp_id field
     */
    public const COL_MTP_ID = 'tourplans.mtp_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'tourplans.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'tourplans.updated_at';

    /**
     * the column name for the mtp_day_id field
     */
    public const COL_MTP_DAY_ID = 'tourplans.mtp_day_id';

    /**
     * the column name for the campaign_visit_plan_id field
     */
    public const COL_CAMPAIGN_VISIT_PLAN_ID = 'tourplans.campaign_visit_plan_id';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['TpId', 'TpDate', 'CompanyId', 'TpRemark', 'PositionId', 'Agendacontroltype', 'BeatId', 'Itownid', 'Weekday', 'Weeknumber', 'AgendaId', 'Isjw', 'OutletOrgDataId', 'MtpId', 'CreatedAt', 'UpdatedAt', 'MtpDayId', 'CampaignVisitPlanId', ],
        self::TYPE_CAMELNAME     => ['tpId', 'tpDate', 'companyId', 'tpRemark', 'positionId', 'agendacontroltype', 'beatId', 'itownid', 'weekday', 'weeknumber', 'agendaId', 'isjw', 'outletOrgDataId', 'mtpId', 'createdAt', 'updatedAt', 'mtpDayId', 'campaignVisitPlanId', ],
        self::TYPE_COLNAME       => [TourplansTableMap::COL_TP_ID, TourplansTableMap::COL_TP_DATE, TourplansTableMap::COL_COMPANY_ID, TourplansTableMap::COL_TP_REMARK, TourplansTableMap::COL_POSITION_ID, TourplansTableMap::COL_AGENDACONTROLTYPE, TourplansTableMap::COL_BEAT_ID, TourplansTableMap::COL_ITOWNID, TourplansTableMap::COL_WEEKDAY, TourplansTableMap::COL_WEEKNUMBER, TourplansTableMap::COL_AGENDA_ID, TourplansTableMap::COL_ISJW, TourplansTableMap::COL_OUTLET_ORG_DATA_ID, TourplansTableMap::COL_MTP_ID, TourplansTableMap::COL_CREATED_AT, TourplansTableMap::COL_UPDATED_AT, TourplansTableMap::COL_MTP_DAY_ID, TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, ],
        self::TYPE_FIELDNAME     => ['tp_id', 'tp_date', 'company_id', 'tp_remark', 'position_id', 'agendacontroltype', 'beat_id', 'itownid', 'weekday', 'weeknumber', 'agenda_id', 'isjw', 'outlet_org_data_id', 'mtp_id', 'created_at', 'updated_at', 'mtp_day_id', 'campaign_visit_plan_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['TpId' => 0, 'TpDate' => 1, 'CompanyId' => 2, 'TpRemark' => 3, 'PositionId' => 4, 'Agendacontroltype' => 5, 'BeatId' => 6, 'Itownid' => 7, 'Weekday' => 8, 'Weeknumber' => 9, 'AgendaId' => 10, 'Isjw' => 11, 'OutletOrgDataId' => 12, 'MtpId' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, 'MtpDayId' => 16, 'CampaignVisitPlanId' => 17, ],
        self::TYPE_CAMELNAME     => ['tpId' => 0, 'tpDate' => 1, 'companyId' => 2, 'tpRemark' => 3, 'positionId' => 4, 'agendacontroltype' => 5, 'beatId' => 6, 'itownid' => 7, 'weekday' => 8, 'weeknumber' => 9, 'agendaId' => 10, 'isjw' => 11, 'outletOrgDataId' => 12, 'mtpId' => 13, 'createdAt' => 14, 'updatedAt' => 15, 'mtpDayId' => 16, 'campaignVisitPlanId' => 17, ],
        self::TYPE_COLNAME       => [TourplansTableMap::COL_TP_ID => 0, TourplansTableMap::COL_TP_DATE => 1, TourplansTableMap::COL_COMPANY_ID => 2, TourplansTableMap::COL_TP_REMARK => 3, TourplansTableMap::COL_POSITION_ID => 4, TourplansTableMap::COL_AGENDACONTROLTYPE => 5, TourplansTableMap::COL_BEAT_ID => 6, TourplansTableMap::COL_ITOWNID => 7, TourplansTableMap::COL_WEEKDAY => 8, TourplansTableMap::COL_WEEKNUMBER => 9, TourplansTableMap::COL_AGENDA_ID => 10, TourplansTableMap::COL_ISJW => 11, TourplansTableMap::COL_OUTLET_ORG_DATA_ID => 12, TourplansTableMap::COL_MTP_ID => 13, TourplansTableMap::COL_CREATED_AT => 14, TourplansTableMap::COL_UPDATED_AT => 15, TourplansTableMap::COL_MTP_DAY_ID => 16, TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID => 17, ],
        self::TYPE_FIELDNAME     => ['tp_id' => 0, 'tp_date' => 1, 'company_id' => 2, 'tp_remark' => 3, 'position_id' => 4, 'agendacontroltype' => 5, 'beat_id' => 6, 'itownid' => 7, 'weekday' => 8, 'weeknumber' => 9, 'agenda_id' => 10, 'isjw' => 11, 'outlet_org_data_id' => 12, 'mtp_id' => 13, 'created_at' => 14, 'updated_at' => 15, 'mtp_day_id' => 16, 'campaign_visit_plan_id' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TpId' => 'TP_ID',
        'Tourplans.TpId' => 'TP_ID',
        'tpId' => 'TP_ID',
        'tourplans.tpId' => 'TP_ID',
        'TourplansTableMap::COL_TP_ID' => 'TP_ID',
        'COL_TP_ID' => 'TP_ID',
        'tp_id' => 'TP_ID',
        'tourplans.tp_id' => 'TP_ID',
        'TpDate' => 'TP_DATE',
        'Tourplans.TpDate' => 'TP_DATE',
        'tpDate' => 'TP_DATE',
        'tourplans.tpDate' => 'TP_DATE',
        'TourplansTableMap::COL_TP_DATE' => 'TP_DATE',
        'COL_TP_DATE' => 'TP_DATE',
        'tp_date' => 'TP_DATE',
        'tourplans.tp_date' => 'TP_DATE',
        'CompanyId' => 'COMPANY_ID',
        'Tourplans.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'tourplans.companyId' => 'COMPANY_ID',
        'TourplansTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'tourplans.company_id' => 'COMPANY_ID',
        'TpRemark' => 'TP_REMARK',
        'Tourplans.TpRemark' => 'TP_REMARK',
        'tpRemark' => 'TP_REMARK',
        'tourplans.tpRemark' => 'TP_REMARK',
        'TourplansTableMap::COL_TP_REMARK' => 'TP_REMARK',
        'COL_TP_REMARK' => 'TP_REMARK',
        'tp_remark' => 'TP_REMARK',
        'tourplans.tp_remark' => 'TP_REMARK',
        'PositionId' => 'POSITION_ID',
        'Tourplans.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'tourplans.positionId' => 'POSITION_ID',
        'TourplansTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'tourplans.position_id' => 'POSITION_ID',
        'Agendacontroltype' => 'AGENDACONTROLTYPE',
        'Tourplans.Agendacontroltype' => 'AGENDACONTROLTYPE',
        'agendacontroltype' => 'AGENDACONTROLTYPE',
        'tourplans.agendacontroltype' => 'AGENDACONTROLTYPE',
        'TourplansTableMap::COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'BeatId' => 'BEAT_ID',
        'Tourplans.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'tourplans.beatId' => 'BEAT_ID',
        'TourplansTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'tourplans.beat_id' => 'BEAT_ID',
        'Itownid' => 'ITOWNID',
        'Tourplans.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'tourplans.itownid' => 'ITOWNID',
        'TourplansTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'Weekday' => 'WEEKDAY',
        'Tourplans.Weekday' => 'WEEKDAY',
        'weekday' => 'WEEKDAY',
        'tourplans.weekday' => 'WEEKDAY',
        'TourplansTableMap::COL_WEEKDAY' => 'WEEKDAY',
        'COL_WEEKDAY' => 'WEEKDAY',
        'Weeknumber' => 'WEEKNUMBER',
        'Tourplans.Weeknumber' => 'WEEKNUMBER',
        'weeknumber' => 'WEEKNUMBER',
        'tourplans.weeknumber' => 'WEEKNUMBER',
        'TourplansTableMap::COL_WEEKNUMBER' => 'WEEKNUMBER',
        'COL_WEEKNUMBER' => 'WEEKNUMBER',
        'AgendaId' => 'AGENDA_ID',
        'Tourplans.AgendaId' => 'AGENDA_ID',
        'agendaId' => 'AGENDA_ID',
        'tourplans.agendaId' => 'AGENDA_ID',
        'TourplansTableMap::COL_AGENDA_ID' => 'AGENDA_ID',
        'COL_AGENDA_ID' => 'AGENDA_ID',
        'agenda_id' => 'AGENDA_ID',
        'tourplans.agenda_id' => 'AGENDA_ID',
        'Isjw' => 'ISJW',
        'Tourplans.Isjw' => 'ISJW',
        'isjw' => 'ISJW',
        'tourplans.isjw' => 'ISJW',
        'TourplansTableMap::COL_ISJW' => 'ISJW',
        'COL_ISJW' => 'ISJW',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'Tourplans.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'tourplans.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'TourplansTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'tourplans.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'MtpId' => 'MTP_ID',
        'Tourplans.MtpId' => 'MTP_ID',
        'mtpId' => 'MTP_ID',
        'tourplans.mtpId' => 'MTP_ID',
        'TourplansTableMap::COL_MTP_ID' => 'MTP_ID',
        'COL_MTP_ID' => 'MTP_ID',
        'mtp_id' => 'MTP_ID',
        'tourplans.mtp_id' => 'MTP_ID',
        'CreatedAt' => 'CREATED_AT',
        'Tourplans.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'tourplans.createdAt' => 'CREATED_AT',
        'TourplansTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'tourplans.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Tourplans.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'tourplans.updatedAt' => 'UPDATED_AT',
        'TourplansTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'tourplans.updated_at' => 'UPDATED_AT',
        'MtpDayId' => 'MTP_DAY_ID',
        'Tourplans.MtpDayId' => 'MTP_DAY_ID',
        'mtpDayId' => 'MTP_DAY_ID',
        'tourplans.mtpDayId' => 'MTP_DAY_ID',
        'TourplansTableMap::COL_MTP_DAY_ID' => 'MTP_DAY_ID',
        'COL_MTP_DAY_ID' => 'MTP_DAY_ID',
        'mtp_day_id' => 'MTP_DAY_ID',
        'tourplans.mtp_day_id' => 'MTP_DAY_ID',
        'CampaignVisitPlanId' => 'CAMPAIGN_VISIT_PLAN_ID',
        'Tourplans.CampaignVisitPlanId' => 'CAMPAIGN_VISIT_PLAN_ID',
        'campaignVisitPlanId' => 'CAMPAIGN_VISIT_PLAN_ID',
        'tourplans.campaignVisitPlanId' => 'CAMPAIGN_VISIT_PLAN_ID',
        'TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID' => 'CAMPAIGN_VISIT_PLAN_ID',
        'COL_CAMPAIGN_VISIT_PLAN_ID' => 'CAMPAIGN_VISIT_PLAN_ID',
        'campaign_visit_plan_id' => 'CAMPAIGN_VISIT_PLAN_ID',
        'tourplans.campaign_visit_plan_id' => 'CAMPAIGN_VISIT_PLAN_ID',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('tourplans');
        $this->setPhpName('Tourplans');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Tourplans');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('tourplans_tp_id_seq');
        // columns
        $this->addPrimaryKey('tp_id', 'TpId', 'INTEGER', true, null, null);
        $this->addColumn('tp_date', 'TpDate', 'DATE', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('tp_remark', 'TpRemark', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('agendacontroltype', 'Agendacontroltype', 'VARCHAR', false, null, null);
        $this->addForeignKey('beat_id', 'BeatId', 'INTEGER', 'beats', 'beat_id', false, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'BIGINT', 'geo_towns', 'itownid', false, null, null);
        $this->addColumn('weekday', 'Weekday', 'INTEGER', false, null, null);
        $this->addColumn('weeknumber', 'Weeknumber', 'INTEGER', false, null, null);
        $this->addForeignKey('agenda_id', 'AgendaId', 'INTEGER', 'agendatypes', 'agendaid', false, null, null);
        $this->addColumn('isjw', 'Isjw', 'BOOLEAN', true, 1, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'BIGINT', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addForeignKey('mtp_id', 'MtpId', 'INTEGER', 'mtp', 'mtp_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('mtp_day_id', 'MtpDayId', 'INTEGER', 'mtp_day', 'mtp_day_id', false, null, null);
        $this->addForeignKey('campaign_visit_plan_id', 'CampaignVisitPlanId', 'INTEGER', 'brand_campiagn_visit_plan', 'brand_campiagn_visit_plan_id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Agendatypes', '\\entities\\Agendatypes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':agenda_id',
    1 => ':agendaid',
  ),
), null, null, null, false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, null, false);
        $this->addRelation('MtpDay', '\\entities\\MtpDay', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':mtp_day_id',
    1 => ':mtp_day_id',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('Mtp', '\\entities\\Mtp', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':mtp_id',
    1 => ':mtp_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnVisitPlan', '\\entities\\BrandCampiagnVisitPlan', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':campaign_visit_plan_id',
    1 => ':brand_campiagn_visit_plan_id',
  ),
), null, null, null, false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? TourplansTableMap::CLASS_DEFAULT : TourplansTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Tourplans object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TourplansTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TourplansTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TourplansTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TourplansTableMap::OM_CLASS;
            /** @var Tourplans $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TourplansTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = TourplansTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TourplansTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Tourplans $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TourplansTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(TourplansTableMap::COL_TP_ID);
            $criteria->addSelectColumn(TourplansTableMap::COL_TP_DATE);
            $criteria->addSelectColumn(TourplansTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TourplansTableMap::COL_TP_REMARK);
            $criteria->addSelectColumn(TourplansTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(TourplansTableMap::COL_AGENDACONTROLTYPE);
            $criteria->addSelectColumn(TourplansTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(TourplansTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(TourplansTableMap::COL_WEEKDAY);
            $criteria->addSelectColumn(TourplansTableMap::COL_WEEKNUMBER);
            $criteria->addSelectColumn(TourplansTableMap::COL_AGENDA_ID);
            $criteria->addSelectColumn(TourplansTableMap::COL_ISJW);
            $criteria->addSelectColumn(TourplansTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(TourplansTableMap::COL_MTP_ID);
            $criteria->addSelectColumn(TourplansTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TourplansTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(TourplansTableMap::COL_MTP_DAY_ID);
            $criteria->addSelectColumn(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID);
        } else {
            $criteria->addSelectColumn($alias . '.tp_id');
            $criteria->addSelectColumn($alias . '.tp_date');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.tp_remark');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.agendacontroltype');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.weekday');
            $criteria->addSelectColumn($alias . '.weeknumber');
            $criteria->addSelectColumn($alias . '.agenda_id');
            $criteria->addSelectColumn($alias . '.isjw');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.mtp_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.mtp_day_id');
            $criteria->addSelectColumn($alias . '.campaign_visit_plan_id');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(TourplansTableMap::COL_TP_ID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_TP_DATE);
            $criteria->removeSelectColumn(TourplansTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_TP_REMARK);
            $criteria->removeSelectColumn(TourplansTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_AGENDACONTROLTYPE);
            $criteria->removeSelectColumn(TourplansTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_WEEKDAY);
            $criteria->removeSelectColumn(TourplansTableMap::COL_WEEKNUMBER);
            $criteria->removeSelectColumn(TourplansTableMap::COL_AGENDA_ID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_ISJW);
            $criteria->removeSelectColumn(TourplansTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_MTP_ID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TourplansTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(TourplansTableMap::COL_MTP_DAY_ID);
            $criteria->removeSelectColumn(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.tp_id');
            $criteria->removeSelectColumn($alias . '.tp_date');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.tp_remark');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.agendacontroltype');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.weekday');
            $criteria->removeSelectColumn($alias . '.weeknumber');
            $criteria->removeSelectColumn($alias . '.agenda_id');
            $criteria->removeSelectColumn($alias . '.isjw');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.mtp_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.mtp_day_id');
            $criteria->removeSelectColumn($alias . '.campaign_visit_plan_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(TourplansTableMap::DATABASE_NAME)->getTable(TourplansTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Tourplans or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Tourplans object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TourplansTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Tourplans) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TourplansTableMap::DATABASE_NAME);
            $criteria->add(TourplansTableMap::COL_TP_ID, (array) $values, Criteria::IN);
        }

        $query = TourplansQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TourplansTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TourplansTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tourplans table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TourplansQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Tourplans or Criteria object.
     *
     * @param mixed $criteria Criteria or Tourplans object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TourplansTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Tourplans object
        }

        if ($criteria->containsKey(TourplansTableMap::COL_TP_ID) && $criteria->keyContainsValue(TourplansTableMap::COL_TP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TourplansTableMap::COL_TP_ID.')');
        }


        // Set the correct dbName
        $query = TourplansQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
