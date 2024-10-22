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
use entities\Dayplan;
use entities\DayplanQuery;


/**
 * This class defines the structure of the 'dayplan' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DayplanTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DayplanTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'dayplan';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Dayplan';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Dayplan';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Dayplan';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 22;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 22;

    /**
     * the column name for the dayplan_id field
     */
    public const COL_DAYPLAN_ID = 'dayplan.dayplan_id';

    /**
     * the column name for the tp_date field
     */
    public const COL_TP_DATE = 'dayplan.tp_date';

    /**
     * the column name for the tp_id field
     */
    public const COL_TP_ID = 'dayplan.tp_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'dayplan.company_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'dayplan.position_id';

    /**
     * the column name for the agendacontroltype field
     */
    public const COL_AGENDACONTROLTYPE = 'dayplan.agendacontroltype';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'dayplan.beat_id';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'dayplan.itownid';

    /**
     * the column name for the agenda_id field
     */
    public const COL_AGENDA_ID = 'dayplan.agenda_id';

    /**
     * the column name for the isjw field
     */
    public const COL_ISJW = 'dayplan.isjw';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'dayplan.outlet_org_data_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'dayplan.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'dayplan.updated_at';

    /**
     * the column name for the mtp_day_id field
     */
    public const COL_MTP_DAY_ID = 'dayplan.mtp_day_id';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'dayplan.status';

    /**
     * the column name for the is_planned field
     */
    public const COL_IS_PLANNED = 'dayplan.is_planned';

    /**
     * the column name for the start_time field
     */
    public const COL_START_TIME = 'dayplan.start_time';

    /**
     * the column name for the end_time field
     */
    public const COL_END_TIME = 'dayplan.end_time';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'dayplan.remark';

    /**
     * the column name for the isfixed field
     */
    public const COL_ISFIXED = 'dayplan.isfixed';

    /**
     * the column name for the reason field
     */
    public const COL_REASON = 'dayplan.reason';

    /**
     * the column name for the campaign_visit_plan_id field
     */
    public const COL_CAMPAIGN_VISIT_PLAN_ID = 'dayplan.campaign_visit_plan_id';

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
        self::TYPE_PHPNAME       => ['DayplanId', 'TpDate', 'TpId', 'CompanyId', 'PositionId', 'Agendacontroltype', 'BeatId', 'Itownid', 'AgendaId', 'Isjw', 'OutletOrgDataId', 'CreatedAt', 'UpdatedAt', 'MtpDayId', 'Status', 'IsPlanned', 'StartTime', 'EndTime', 'Remark', 'Isfixed', 'Reason', 'CampaignVisitPlanId', ],
        self::TYPE_CAMELNAME     => ['dayplanId', 'tpDate', 'tpId', 'companyId', 'positionId', 'agendacontroltype', 'beatId', 'itownid', 'agendaId', 'isjw', 'outletOrgDataId', 'createdAt', 'updatedAt', 'mtpDayId', 'status', 'isPlanned', 'startTime', 'endTime', 'remark', 'isfixed', 'reason', 'campaignVisitPlanId', ],
        self::TYPE_COLNAME       => [DayplanTableMap::COL_DAYPLAN_ID, DayplanTableMap::COL_TP_DATE, DayplanTableMap::COL_TP_ID, DayplanTableMap::COL_COMPANY_ID, DayplanTableMap::COL_POSITION_ID, DayplanTableMap::COL_AGENDACONTROLTYPE, DayplanTableMap::COL_BEAT_ID, DayplanTableMap::COL_ITOWNID, DayplanTableMap::COL_AGENDA_ID, DayplanTableMap::COL_ISJW, DayplanTableMap::COL_OUTLET_ORG_DATA_ID, DayplanTableMap::COL_CREATED_AT, DayplanTableMap::COL_UPDATED_AT, DayplanTableMap::COL_MTP_DAY_ID, DayplanTableMap::COL_STATUS, DayplanTableMap::COL_IS_PLANNED, DayplanTableMap::COL_START_TIME, DayplanTableMap::COL_END_TIME, DayplanTableMap::COL_REMARK, DayplanTableMap::COL_ISFIXED, DayplanTableMap::COL_REASON, DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, ],
        self::TYPE_FIELDNAME     => ['dayplan_id', 'tp_date', 'tp_id', 'company_id', 'position_id', 'agendacontroltype', 'beat_id', 'itownid', 'agenda_id', 'isjw', 'outlet_org_data_id', 'created_at', 'updated_at', 'mtp_day_id', 'status', 'is_planned', 'start_time', 'end_time', 'remark', 'isfixed', 'reason', 'campaign_visit_plan_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, ]
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
        self::TYPE_PHPNAME       => ['DayplanId' => 0, 'TpDate' => 1, 'TpId' => 2, 'CompanyId' => 3, 'PositionId' => 4, 'Agendacontroltype' => 5, 'BeatId' => 6, 'Itownid' => 7, 'AgendaId' => 8, 'Isjw' => 9, 'OutletOrgDataId' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'MtpDayId' => 13, 'Status' => 14, 'IsPlanned' => 15, 'StartTime' => 16, 'EndTime' => 17, 'Remark' => 18, 'Isfixed' => 19, 'Reason' => 20, 'CampaignVisitPlanId' => 21, ],
        self::TYPE_CAMELNAME     => ['dayplanId' => 0, 'tpDate' => 1, 'tpId' => 2, 'companyId' => 3, 'positionId' => 4, 'agendacontroltype' => 5, 'beatId' => 6, 'itownid' => 7, 'agendaId' => 8, 'isjw' => 9, 'outletOrgDataId' => 10, 'createdAt' => 11, 'updatedAt' => 12, 'mtpDayId' => 13, 'status' => 14, 'isPlanned' => 15, 'startTime' => 16, 'endTime' => 17, 'remark' => 18, 'isfixed' => 19, 'reason' => 20, 'campaignVisitPlanId' => 21, ],
        self::TYPE_COLNAME       => [DayplanTableMap::COL_DAYPLAN_ID => 0, DayplanTableMap::COL_TP_DATE => 1, DayplanTableMap::COL_TP_ID => 2, DayplanTableMap::COL_COMPANY_ID => 3, DayplanTableMap::COL_POSITION_ID => 4, DayplanTableMap::COL_AGENDACONTROLTYPE => 5, DayplanTableMap::COL_BEAT_ID => 6, DayplanTableMap::COL_ITOWNID => 7, DayplanTableMap::COL_AGENDA_ID => 8, DayplanTableMap::COL_ISJW => 9, DayplanTableMap::COL_OUTLET_ORG_DATA_ID => 10, DayplanTableMap::COL_CREATED_AT => 11, DayplanTableMap::COL_UPDATED_AT => 12, DayplanTableMap::COL_MTP_DAY_ID => 13, DayplanTableMap::COL_STATUS => 14, DayplanTableMap::COL_IS_PLANNED => 15, DayplanTableMap::COL_START_TIME => 16, DayplanTableMap::COL_END_TIME => 17, DayplanTableMap::COL_REMARK => 18, DayplanTableMap::COL_ISFIXED => 19, DayplanTableMap::COL_REASON => 20, DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID => 21, ],
        self::TYPE_FIELDNAME     => ['dayplan_id' => 0, 'tp_date' => 1, 'tp_id' => 2, 'company_id' => 3, 'position_id' => 4, 'agendacontroltype' => 5, 'beat_id' => 6, 'itownid' => 7, 'agenda_id' => 8, 'isjw' => 9, 'outlet_org_data_id' => 10, 'created_at' => 11, 'updated_at' => 12, 'mtp_day_id' => 13, 'status' => 14, 'is_planned' => 15, 'start_time' => 16, 'end_time' => 17, 'remark' => 18, 'isfixed' => 19, 'reason' => 20, 'campaign_visit_plan_id' => 21, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DayplanId' => 'DAYPLAN_ID',
        'Dayplan.DayplanId' => 'DAYPLAN_ID',
        'dayplanId' => 'DAYPLAN_ID',
        'dayplan.dayplanId' => 'DAYPLAN_ID',
        'DayplanTableMap::COL_DAYPLAN_ID' => 'DAYPLAN_ID',
        'COL_DAYPLAN_ID' => 'DAYPLAN_ID',
        'dayplan_id' => 'DAYPLAN_ID',
        'dayplan.dayplan_id' => 'DAYPLAN_ID',
        'TpDate' => 'TP_DATE',
        'Dayplan.TpDate' => 'TP_DATE',
        'tpDate' => 'TP_DATE',
        'dayplan.tpDate' => 'TP_DATE',
        'DayplanTableMap::COL_TP_DATE' => 'TP_DATE',
        'COL_TP_DATE' => 'TP_DATE',
        'tp_date' => 'TP_DATE',
        'dayplan.tp_date' => 'TP_DATE',
        'TpId' => 'TP_ID',
        'Dayplan.TpId' => 'TP_ID',
        'tpId' => 'TP_ID',
        'dayplan.tpId' => 'TP_ID',
        'DayplanTableMap::COL_TP_ID' => 'TP_ID',
        'COL_TP_ID' => 'TP_ID',
        'tp_id' => 'TP_ID',
        'dayplan.tp_id' => 'TP_ID',
        'CompanyId' => 'COMPANY_ID',
        'Dayplan.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'dayplan.companyId' => 'COMPANY_ID',
        'DayplanTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'dayplan.company_id' => 'COMPANY_ID',
        'PositionId' => 'POSITION_ID',
        'Dayplan.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'dayplan.positionId' => 'POSITION_ID',
        'DayplanTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'dayplan.position_id' => 'POSITION_ID',
        'Agendacontroltype' => 'AGENDACONTROLTYPE',
        'Dayplan.Agendacontroltype' => 'AGENDACONTROLTYPE',
        'agendacontroltype' => 'AGENDACONTROLTYPE',
        'dayplan.agendacontroltype' => 'AGENDACONTROLTYPE',
        'DayplanTableMap::COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'BeatId' => 'BEAT_ID',
        'Dayplan.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'dayplan.beatId' => 'BEAT_ID',
        'DayplanTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'dayplan.beat_id' => 'BEAT_ID',
        'Itownid' => 'ITOWNID',
        'Dayplan.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'dayplan.itownid' => 'ITOWNID',
        'DayplanTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'AgendaId' => 'AGENDA_ID',
        'Dayplan.AgendaId' => 'AGENDA_ID',
        'agendaId' => 'AGENDA_ID',
        'dayplan.agendaId' => 'AGENDA_ID',
        'DayplanTableMap::COL_AGENDA_ID' => 'AGENDA_ID',
        'COL_AGENDA_ID' => 'AGENDA_ID',
        'agenda_id' => 'AGENDA_ID',
        'dayplan.agenda_id' => 'AGENDA_ID',
        'Isjw' => 'ISJW',
        'Dayplan.Isjw' => 'ISJW',
        'isjw' => 'ISJW',
        'dayplan.isjw' => 'ISJW',
        'DayplanTableMap::COL_ISJW' => 'ISJW',
        'COL_ISJW' => 'ISJW',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'Dayplan.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'dayplan.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'DayplanTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'dayplan.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'CreatedAt' => 'CREATED_AT',
        'Dayplan.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dayplan.createdAt' => 'CREATED_AT',
        'DayplanTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'dayplan.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Dayplan.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'dayplan.updatedAt' => 'UPDATED_AT',
        'DayplanTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'dayplan.updated_at' => 'UPDATED_AT',
        'MtpDayId' => 'MTP_DAY_ID',
        'Dayplan.MtpDayId' => 'MTP_DAY_ID',
        'mtpDayId' => 'MTP_DAY_ID',
        'dayplan.mtpDayId' => 'MTP_DAY_ID',
        'DayplanTableMap::COL_MTP_DAY_ID' => 'MTP_DAY_ID',
        'COL_MTP_DAY_ID' => 'MTP_DAY_ID',
        'mtp_day_id' => 'MTP_DAY_ID',
        'dayplan.mtp_day_id' => 'MTP_DAY_ID',
        'Status' => 'STATUS',
        'Dayplan.Status' => 'STATUS',
        'status' => 'STATUS',
        'dayplan.status' => 'STATUS',
        'DayplanTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'IsPlanned' => 'IS_PLANNED',
        'Dayplan.IsPlanned' => 'IS_PLANNED',
        'isPlanned' => 'IS_PLANNED',
        'dayplan.isPlanned' => 'IS_PLANNED',
        'DayplanTableMap::COL_IS_PLANNED' => 'IS_PLANNED',
        'COL_IS_PLANNED' => 'IS_PLANNED',
        'is_planned' => 'IS_PLANNED',
        'dayplan.is_planned' => 'IS_PLANNED',
        'StartTime' => 'START_TIME',
        'Dayplan.StartTime' => 'START_TIME',
        'startTime' => 'START_TIME',
        'dayplan.startTime' => 'START_TIME',
        'DayplanTableMap::COL_START_TIME' => 'START_TIME',
        'COL_START_TIME' => 'START_TIME',
        'start_time' => 'START_TIME',
        'dayplan.start_time' => 'START_TIME',
        'EndTime' => 'END_TIME',
        'Dayplan.EndTime' => 'END_TIME',
        'endTime' => 'END_TIME',
        'dayplan.endTime' => 'END_TIME',
        'DayplanTableMap::COL_END_TIME' => 'END_TIME',
        'COL_END_TIME' => 'END_TIME',
        'end_time' => 'END_TIME',
        'dayplan.end_time' => 'END_TIME',
        'Remark' => 'REMARK',
        'Dayplan.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'dayplan.remark' => 'REMARK',
        'DayplanTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'Isfixed' => 'ISFIXED',
        'Dayplan.Isfixed' => 'ISFIXED',
        'isfixed' => 'ISFIXED',
        'dayplan.isfixed' => 'ISFIXED',
        'DayplanTableMap::COL_ISFIXED' => 'ISFIXED',
        'COL_ISFIXED' => 'ISFIXED',
        'Reason' => 'REASON',
        'Dayplan.Reason' => 'REASON',
        'reason' => 'REASON',
        'dayplan.reason' => 'REASON',
        'DayplanTableMap::COL_REASON' => 'REASON',
        'COL_REASON' => 'REASON',
        'CampaignVisitPlanId' => 'CAMPAIGN_VISIT_PLAN_ID',
        'Dayplan.CampaignVisitPlanId' => 'CAMPAIGN_VISIT_PLAN_ID',
        'campaignVisitPlanId' => 'CAMPAIGN_VISIT_PLAN_ID',
        'dayplan.campaignVisitPlanId' => 'CAMPAIGN_VISIT_PLAN_ID',
        'DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID' => 'CAMPAIGN_VISIT_PLAN_ID',
        'COL_CAMPAIGN_VISIT_PLAN_ID' => 'CAMPAIGN_VISIT_PLAN_ID',
        'campaign_visit_plan_id' => 'CAMPAIGN_VISIT_PLAN_ID',
        'dayplan.campaign_visit_plan_id' => 'CAMPAIGN_VISIT_PLAN_ID',
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
        $this->setName('dayplan');
        $this->setPhpName('Dayplan');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Dayplan');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('dayplan_dayplan_id_seq');
        // columns
        $this->addPrimaryKey('dayplan_id', 'DayplanId', 'INTEGER', true, null, null);
        $this->addColumn('tp_date', 'TpDate', 'DATE', false, null, null);
        $this->addColumn('tp_id', 'TpId', 'INTEGER', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('agendacontroltype', 'Agendacontroltype', 'VARCHAR', false, null, null);
        $this->addForeignKey('beat_id', 'BeatId', 'INTEGER', 'beats', 'beat_id', false, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'BIGINT', 'geo_towns', 'itownid', false, null, null);
        $this->addForeignKey('agenda_id', 'AgendaId', 'INTEGER', 'agendatypes', 'agendaid', false, null, null);
        $this->addColumn('isjw', 'Isjw', 'BOOLEAN', true, 1, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('mtp_day_id', 'MtpDayId', 'INTEGER', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addColumn('is_planned', 'IsPlanned', 'BOOLEAN', false, 1, null);
        $this->addColumn('start_time', 'StartTime', 'VARCHAR', false, null, null);
        $this->addColumn('end_time', 'EndTime', 'VARCHAR', false, null, null);
        $this->addColumn('remark', 'Remark', 'VARCHAR', false, null, null);
        $this->addColumn('isfixed', 'Isfixed', 'INTEGER', false, null, null);
        $this->addColumn('reason', 'Reason', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('campaign_visit_plan_id', 'CampaignVisitPlanId', 'LONGVARCHAR', 'brand_campiagn_visit_plan', 'brand_campiagn_visit_plan_id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, null, false);
        $this->addRelation('Agendatypes', '\\entities\\Agendatypes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':agenda_id',
    1 => ':agendaid',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DayplanId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DayplanId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DayplanId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DayplanId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DayplanId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DayplanId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DayplanId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DayplanTableMap::CLASS_DEFAULT : DayplanTableMap::OM_CLASS;
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
     * @return array (Dayplan object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DayplanTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DayplanTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DayplanTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DayplanTableMap::OM_CLASS;
            /** @var Dayplan $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DayplanTableMap::addInstanceToPool($obj, $key);
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
            $key = DayplanTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DayplanTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Dayplan $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DayplanTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DayplanTableMap::COL_DAYPLAN_ID);
            $criteria->addSelectColumn(DayplanTableMap::COL_TP_DATE);
            $criteria->addSelectColumn(DayplanTableMap::COL_TP_ID);
            $criteria->addSelectColumn(DayplanTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(DayplanTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(DayplanTableMap::COL_AGENDACONTROLTYPE);
            $criteria->addSelectColumn(DayplanTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(DayplanTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(DayplanTableMap::COL_AGENDA_ID);
            $criteria->addSelectColumn(DayplanTableMap::COL_ISJW);
            $criteria->addSelectColumn(DayplanTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(DayplanTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DayplanTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DayplanTableMap::COL_MTP_DAY_ID);
            $criteria->addSelectColumn(DayplanTableMap::COL_STATUS);
            $criteria->addSelectColumn(DayplanTableMap::COL_IS_PLANNED);
            $criteria->addSelectColumn(DayplanTableMap::COL_START_TIME);
            $criteria->addSelectColumn(DayplanTableMap::COL_END_TIME);
            $criteria->addSelectColumn(DayplanTableMap::COL_REMARK);
            $criteria->addSelectColumn(DayplanTableMap::COL_ISFIXED);
            $criteria->addSelectColumn(DayplanTableMap::COL_REASON);
            $criteria->addSelectColumn(DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID);
        } else {
            $criteria->addSelectColumn($alias . '.dayplan_id');
            $criteria->addSelectColumn($alias . '.tp_date');
            $criteria->addSelectColumn($alias . '.tp_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.agendacontroltype');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.agenda_id');
            $criteria->addSelectColumn($alias . '.isjw');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.mtp_day_id');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_planned');
            $criteria->addSelectColumn($alias . '.start_time');
            $criteria->addSelectColumn($alias . '.end_time');
            $criteria->addSelectColumn($alias . '.remark');
            $criteria->addSelectColumn($alias . '.isfixed');
            $criteria->addSelectColumn($alias . '.reason');
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
            $criteria->removeSelectColumn(DayplanTableMap::COL_DAYPLAN_ID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_TP_DATE);
            $criteria->removeSelectColumn(DayplanTableMap::COL_TP_ID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_AGENDACONTROLTYPE);
            $criteria->removeSelectColumn(DayplanTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_AGENDA_ID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_ISJW);
            $criteria->removeSelectColumn(DayplanTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DayplanTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(DayplanTableMap::COL_MTP_DAY_ID);
            $criteria->removeSelectColumn(DayplanTableMap::COL_STATUS);
            $criteria->removeSelectColumn(DayplanTableMap::COL_IS_PLANNED);
            $criteria->removeSelectColumn(DayplanTableMap::COL_START_TIME);
            $criteria->removeSelectColumn(DayplanTableMap::COL_END_TIME);
            $criteria->removeSelectColumn(DayplanTableMap::COL_REMARK);
            $criteria->removeSelectColumn(DayplanTableMap::COL_ISFIXED);
            $criteria->removeSelectColumn(DayplanTableMap::COL_REASON);
            $criteria->removeSelectColumn(DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.dayplan_id');
            $criteria->removeSelectColumn($alias . '.tp_date');
            $criteria->removeSelectColumn($alias . '.tp_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.agendacontroltype');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.agenda_id');
            $criteria->removeSelectColumn($alias . '.isjw');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.mtp_day_id');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_planned');
            $criteria->removeSelectColumn($alias . '.start_time');
            $criteria->removeSelectColumn($alias . '.end_time');
            $criteria->removeSelectColumn($alias . '.remark');
            $criteria->removeSelectColumn($alias . '.isfixed');
            $criteria->removeSelectColumn($alias . '.reason');
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
        return Propel::getServiceContainer()->getDatabaseMap(DayplanTableMap::DATABASE_NAME)->getTable(DayplanTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Dayplan or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Dayplan object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DayplanTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Dayplan) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DayplanTableMap::DATABASE_NAME);
            $criteria->add(DayplanTableMap::COL_DAYPLAN_ID, (array) $values, Criteria::IN);
        }

        $query = DayplanQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DayplanTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DayplanTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the dayplan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DayplanQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Dayplan or Criteria object.
     *
     * @param mixed $criteria Criteria or Dayplan object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DayplanTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Dayplan object
        }

        if ($criteria->containsKey(DayplanTableMap::COL_DAYPLAN_ID) && $criteria->keyContainsValue(DayplanTableMap::COL_DAYPLAN_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DayplanTableMap::COL_DAYPLAN_ID.')');
        }


        // Set the correct dbName
        $query = DayplanQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
