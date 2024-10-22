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
use entities\Positions;
use entities\PositionsQuery;


/**
 * This class defines the structure of the 'positions' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PositionsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.PositionsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'positions';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Positions';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Positions';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Positions';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'positions.position_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'positions.company_id';

    /**
     * the column name for the position_name field
     */
    public const COL_POSITION_NAME = 'positions.position_name';

    /**
     * the column name for the position_code field
     */
    public const COL_POSITION_CODE = 'positions.position_code';

    /**
     * the column name for the reporting_to field
     */
    public const COL_REPORTING_TO = 'positions.reporting_to';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'positions.org_unit_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'positions.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'positions.updated_at';

    /**
     * the column name for the cav_positions_up field
     */
    public const COL_CAV_POSITIONS_UP = 'positions.cav_positions_up';

    /**
     * the column name for the cav_positions_down field
     */
    public const COL_CAV_POSITIONS_DOWN = 'positions.cav_positions_down';

    /**
     * the column name for the cav_territories field
     */
    public const COL_CAV_TERRITORIES = 'positions.cav_territories';

    /**
     * the column name for the cav_towns field
     */
    public const COL_CAV_TOWNS = 'positions.cav_towns';

    /**
     * the column name for the cav_date field
     */
    public const COL_CAV_DATE = 'positions.cav_date';

    /**
     * the column name for the cav_flag field
     */
    public const COL_CAV_FLAG = 'positions.cav_flag';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'positions.itownid';

    /**
     * the column name for the mtp_type field
     */
    public const COL_MTP_TYPE = 'positions.mtp_type';

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
        self::TYPE_PHPNAME       => ['PositionId', 'CompanyId', 'PositionName', 'PositionCode', 'ReportingTo', 'OrgUnitId', 'CreatedAt', 'UpdatedAt', 'CavPositionsUp', 'CavPositionsDown', 'CavTerritories', 'CavTowns', 'CavDate', 'CavFlag', 'Itownid', 'MtpType', ],
        self::TYPE_CAMELNAME     => ['positionId', 'companyId', 'positionName', 'positionCode', 'reportingTo', 'orgUnitId', 'createdAt', 'updatedAt', 'cavPositionsUp', 'cavPositionsDown', 'cavTerritories', 'cavTowns', 'cavDate', 'cavFlag', 'itownid', 'mtpType', ],
        self::TYPE_COLNAME       => [PositionsTableMap::COL_POSITION_ID, PositionsTableMap::COL_COMPANY_ID, PositionsTableMap::COL_POSITION_NAME, PositionsTableMap::COL_POSITION_CODE, PositionsTableMap::COL_REPORTING_TO, PositionsTableMap::COL_ORG_UNIT_ID, PositionsTableMap::COL_CREATED_AT, PositionsTableMap::COL_UPDATED_AT, PositionsTableMap::COL_CAV_POSITIONS_UP, PositionsTableMap::COL_CAV_POSITIONS_DOWN, PositionsTableMap::COL_CAV_TERRITORIES, PositionsTableMap::COL_CAV_TOWNS, PositionsTableMap::COL_CAV_DATE, PositionsTableMap::COL_CAV_FLAG, PositionsTableMap::COL_ITOWNID, PositionsTableMap::COL_MTP_TYPE, ],
        self::TYPE_FIELDNAME     => ['position_id', 'company_id', 'position_name', 'position_code', 'reporting_to', 'org_unit_id', 'created_at', 'updated_at', 'cav_positions_up', 'cav_positions_down', 'cav_territories', 'cav_towns', 'cav_date', 'cav_flag', 'itownid', 'mtp_type', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
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
        self::TYPE_PHPNAME       => ['PositionId' => 0, 'CompanyId' => 1, 'PositionName' => 2, 'PositionCode' => 3, 'ReportingTo' => 4, 'OrgUnitId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'CavPositionsUp' => 8, 'CavPositionsDown' => 9, 'CavTerritories' => 10, 'CavTowns' => 11, 'CavDate' => 12, 'CavFlag' => 13, 'Itownid' => 14, 'MtpType' => 15, ],
        self::TYPE_CAMELNAME     => ['positionId' => 0, 'companyId' => 1, 'positionName' => 2, 'positionCode' => 3, 'reportingTo' => 4, 'orgUnitId' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'cavPositionsUp' => 8, 'cavPositionsDown' => 9, 'cavTerritories' => 10, 'cavTowns' => 11, 'cavDate' => 12, 'cavFlag' => 13, 'itownid' => 14, 'mtpType' => 15, ],
        self::TYPE_COLNAME       => [PositionsTableMap::COL_POSITION_ID => 0, PositionsTableMap::COL_COMPANY_ID => 1, PositionsTableMap::COL_POSITION_NAME => 2, PositionsTableMap::COL_POSITION_CODE => 3, PositionsTableMap::COL_REPORTING_TO => 4, PositionsTableMap::COL_ORG_UNIT_ID => 5, PositionsTableMap::COL_CREATED_AT => 6, PositionsTableMap::COL_UPDATED_AT => 7, PositionsTableMap::COL_CAV_POSITIONS_UP => 8, PositionsTableMap::COL_CAV_POSITIONS_DOWN => 9, PositionsTableMap::COL_CAV_TERRITORIES => 10, PositionsTableMap::COL_CAV_TOWNS => 11, PositionsTableMap::COL_CAV_DATE => 12, PositionsTableMap::COL_CAV_FLAG => 13, PositionsTableMap::COL_ITOWNID => 14, PositionsTableMap::COL_MTP_TYPE => 15, ],
        self::TYPE_FIELDNAME     => ['position_id' => 0, 'company_id' => 1, 'position_name' => 2, 'position_code' => 3, 'reporting_to' => 4, 'org_unit_id' => 5, 'created_at' => 6, 'updated_at' => 7, 'cav_positions_up' => 8, 'cav_positions_down' => 9, 'cav_territories' => 10, 'cav_towns' => 11, 'cav_date' => 12, 'cav_flag' => 13, 'itownid' => 14, 'mtp_type' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PositionId' => 'POSITION_ID',
        'Positions.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'positions.positionId' => 'POSITION_ID',
        'PositionsTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'positions.position_id' => 'POSITION_ID',
        'CompanyId' => 'COMPANY_ID',
        'Positions.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'positions.companyId' => 'COMPANY_ID',
        'PositionsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'positions.company_id' => 'COMPANY_ID',
        'PositionName' => 'POSITION_NAME',
        'Positions.PositionName' => 'POSITION_NAME',
        'positionName' => 'POSITION_NAME',
        'positions.positionName' => 'POSITION_NAME',
        'PositionsTableMap::COL_POSITION_NAME' => 'POSITION_NAME',
        'COL_POSITION_NAME' => 'POSITION_NAME',
        'position_name' => 'POSITION_NAME',
        'positions.position_name' => 'POSITION_NAME',
        'PositionCode' => 'POSITION_CODE',
        'Positions.PositionCode' => 'POSITION_CODE',
        'positionCode' => 'POSITION_CODE',
        'positions.positionCode' => 'POSITION_CODE',
        'PositionsTableMap::COL_POSITION_CODE' => 'POSITION_CODE',
        'COL_POSITION_CODE' => 'POSITION_CODE',
        'position_code' => 'POSITION_CODE',
        'positions.position_code' => 'POSITION_CODE',
        'ReportingTo' => 'REPORTING_TO',
        'Positions.ReportingTo' => 'REPORTING_TO',
        'reportingTo' => 'REPORTING_TO',
        'positions.reportingTo' => 'REPORTING_TO',
        'PositionsTableMap::COL_REPORTING_TO' => 'REPORTING_TO',
        'COL_REPORTING_TO' => 'REPORTING_TO',
        'reporting_to' => 'REPORTING_TO',
        'positions.reporting_to' => 'REPORTING_TO',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'Positions.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'positions.orgUnitId' => 'ORG_UNIT_ID',
        'PositionsTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'positions.org_unit_id' => 'ORG_UNIT_ID',
        'CreatedAt' => 'CREATED_AT',
        'Positions.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'positions.createdAt' => 'CREATED_AT',
        'PositionsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'positions.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Positions.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'positions.updatedAt' => 'UPDATED_AT',
        'PositionsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'positions.updated_at' => 'UPDATED_AT',
        'CavPositionsUp' => 'CAV_POSITIONS_UP',
        'Positions.CavPositionsUp' => 'CAV_POSITIONS_UP',
        'cavPositionsUp' => 'CAV_POSITIONS_UP',
        'positions.cavPositionsUp' => 'CAV_POSITIONS_UP',
        'PositionsTableMap::COL_CAV_POSITIONS_UP' => 'CAV_POSITIONS_UP',
        'COL_CAV_POSITIONS_UP' => 'CAV_POSITIONS_UP',
        'cav_positions_up' => 'CAV_POSITIONS_UP',
        'positions.cav_positions_up' => 'CAV_POSITIONS_UP',
        'CavPositionsDown' => 'CAV_POSITIONS_DOWN',
        'Positions.CavPositionsDown' => 'CAV_POSITIONS_DOWN',
        'cavPositionsDown' => 'CAV_POSITIONS_DOWN',
        'positions.cavPositionsDown' => 'CAV_POSITIONS_DOWN',
        'PositionsTableMap::COL_CAV_POSITIONS_DOWN' => 'CAV_POSITIONS_DOWN',
        'COL_CAV_POSITIONS_DOWN' => 'CAV_POSITIONS_DOWN',
        'cav_positions_down' => 'CAV_POSITIONS_DOWN',
        'positions.cav_positions_down' => 'CAV_POSITIONS_DOWN',
        'CavTerritories' => 'CAV_TERRITORIES',
        'Positions.CavTerritories' => 'CAV_TERRITORIES',
        'cavTerritories' => 'CAV_TERRITORIES',
        'positions.cavTerritories' => 'CAV_TERRITORIES',
        'PositionsTableMap::COL_CAV_TERRITORIES' => 'CAV_TERRITORIES',
        'COL_CAV_TERRITORIES' => 'CAV_TERRITORIES',
        'cav_territories' => 'CAV_TERRITORIES',
        'positions.cav_territories' => 'CAV_TERRITORIES',
        'CavTowns' => 'CAV_TOWNS',
        'Positions.CavTowns' => 'CAV_TOWNS',
        'cavTowns' => 'CAV_TOWNS',
        'positions.cavTowns' => 'CAV_TOWNS',
        'PositionsTableMap::COL_CAV_TOWNS' => 'CAV_TOWNS',
        'COL_CAV_TOWNS' => 'CAV_TOWNS',
        'cav_towns' => 'CAV_TOWNS',
        'positions.cav_towns' => 'CAV_TOWNS',
        'CavDate' => 'CAV_DATE',
        'Positions.CavDate' => 'CAV_DATE',
        'cavDate' => 'CAV_DATE',
        'positions.cavDate' => 'CAV_DATE',
        'PositionsTableMap::COL_CAV_DATE' => 'CAV_DATE',
        'COL_CAV_DATE' => 'CAV_DATE',
        'cav_date' => 'CAV_DATE',
        'positions.cav_date' => 'CAV_DATE',
        'CavFlag' => 'CAV_FLAG',
        'Positions.CavFlag' => 'CAV_FLAG',
        'cavFlag' => 'CAV_FLAG',
        'positions.cavFlag' => 'CAV_FLAG',
        'PositionsTableMap::COL_CAV_FLAG' => 'CAV_FLAG',
        'COL_CAV_FLAG' => 'CAV_FLAG',
        'cav_flag' => 'CAV_FLAG',
        'positions.cav_flag' => 'CAV_FLAG',
        'Itownid' => 'ITOWNID',
        'Positions.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'positions.itownid' => 'ITOWNID',
        'PositionsTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'MtpType' => 'MTP_TYPE',
        'Positions.MtpType' => 'MTP_TYPE',
        'mtpType' => 'MTP_TYPE',
        'positions.mtpType' => 'MTP_TYPE',
        'PositionsTableMap::COL_MTP_TYPE' => 'MTP_TYPE',
        'COL_MTP_TYPE' => 'MTP_TYPE',
        'mtp_type' => 'MTP_TYPE',
        'positions.mtp_type' => 'MTP_TYPE',
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
        $this->setName('positions');
        $this->setPhpName('Positions');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Positions');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('positions_position_id_seq');
        // columns
        $this->addPrimaryKey('position_id', 'PositionId', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('position_name', 'PositionName', 'VARCHAR', true, 255, '');
        $this->addColumn('position_code', 'PositionCode', 'VARCHAR', true, 255, '');
        $this->addColumn('reporting_to', 'ReportingTo', 'INTEGER', false, null, 0);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('cav_positions_up', 'CavPositionsUp', 'VARCHAR', false, null, null);
        $this->addColumn('cav_positions_down', 'CavPositionsDown', 'VARCHAR', false, null, null);
        $this->addColumn('cav_territories', 'CavTerritories', 'VARCHAR', false, null, null);
        $this->addColumn('cav_towns', 'CavTowns', 'VARCHAR', false, null, null);
        $this->addColumn('cav_date', 'CavDate', 'DATE', false, null, null);
        $this->addColumn('cav_flag', 'CavFlag', 'VARCHAR', false, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
        $this->addColumn('mtp_type', 'MtpType', 'VARCHAR', false, null, 'manual');
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
), 'CASCADE', null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnDoctors', '\\entities\\BrandCampiagnDoctors', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'BrandCampiagnDoctorss', false);
        $this->addRelation('BrandCampiagnVisits', '\\entities\\BrandCampiagnVisits', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'BrandCampiagnVisitss', false);
        $this->addRelation('Dailycalls', '\\entities\\Dailycalls', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'Dailycallss', false);
        $this->addRelation('EmployeeRelatedByPositionId', '\\entities\\Employee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'EmployeesRelatedByPositionId', false);
        $this->addRelation('EmployeeRelatedByReportingTo', '\\entities\\Employee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':reporting_to',
    1 => ':position_id',
  ),
), null, null, 'EmployeesRelatedByReportingTo', false);
        $this->addRelation('EmployeePositionHistory', '\\entities\\EmployeePositionHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'EmployeePositionHistories', false);
        $this->addRelation('Mtp', '\\entities\\Mtp', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'Mtps', false);
        $this->addRelation('OnBoardRequestRelatedByApprovedByPositionId', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':approved_by_position_id',
    1 => ':position_id',
  ),
), null, null, 'OnBoardRequestsRelatedByApprovedByPositionId', false);
        $this->addRelation('OnBoardRequestRelatedByCreatedByPositionId', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':created_by_position_id',
    1 => ':position_id',
  ),
), null, null, 'OnBoardRequestsRelatedByCreatedByPositionId', false);
        $this->addRelation('OnBoardRequestRelatedByFinalApprovedByPositionId', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':final_approved_by_position_id',
    1 => ':position_id',
  ),
), null, null, 'OnBoardRequestsRelatedByFinalApprovedByPositionId', false);
        $this->addRelation('OnBoardRequestRelatedByPosition', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position',
    1 => ':position_id',
  ),
), null, null, 'OnBoardRequestsRelatedByPosition', false);
        $this->addRelation('OnBoardRequestRelatedByUpdatedByPositionId', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':updated_by_position_id',
    1 => ':position_id',
  ),
), null, null, 'OnBoardRequestsRelatedByUpdatedByPositionId', false);
        $this->addRelation('OnBoardRequestLog', '\\entities\\OnBoardRequestLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_position_id',
    1 => ':position_id',
  ),
), null, null, 'OnBoardRequestLogs', false);
        $this->addRelation('PrescriberData', '\\entities\\PrescriberData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'PrescriberDatas', false);
        $this->addRelation('PrescriberTallySummary', '\\entities\\PrescriberTallySummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'PrescriberTallySummaries', false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'Territoriess', false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'Tourplanss', false);
        $this->addRelation('Stp', '\\entities\\Stp', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, 'Stps', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PositionsTableMap::CLASS_DEFAULT : PositionsTableMap::OM_CLASS;
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
     * @return array (Positions object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PositionsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PositionsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PositionsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PositionsTableMap::OM_CLASS;
            /** @var Positions $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PositionsTableMap::addInstanceToPool($obj, $key);
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
            $key = PositionsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PositionsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Positions $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PositionsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PositionsTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(PositionsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(PositionsTableMap::COL_POSITION_NAME);
            $criteria->addSelectColumn(PositionsTableMap::COL_POSITION_CODE);
            $criteria->addSelectColumn(PositionsTableMap::COL_REPORTING_TO);
            $criteria->addSelectColumn(PositionsTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(PositionsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PositionsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(PositionsTableMap::COL_CAV_POSITIONS_UP);
            $criteria->addSelectColumn(PositionsTableMap::COL_CAV_POSITIONS_DOWN);
            $criteria->addSelectColumn(PositionsTableMap::COL_CAV_TERRITORIES);
            $criteria->addSelectColumn(PositionsTableMap::COL_CAV_TOWNS);
            $criteria->addSelectColumn(PositionsTableMap::COL_CAV_DATE);
            $criteria->addSelectColumn(PositionsTableMap::COL_CAV_FLAG);
            $criteria->addSelectColumn(PositionsTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(PositionsTableMap::COL_MTP_TYPE);
        } else {
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.position_name');
            $criteria->addSelectColumn($alias . '.position_code');
            $criteria->addSelectColumn($alias . '.reporting_to');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.cav_positions_up');
            $criteria->addSelectColumn($alias . '.cav_positions_down');
            $criteria->addSelectColumn($alias . '.cav_territories');
            $criteria->addSelectColumn($alias . '.cav_towns');
            $criteria->addSelectColumn($alias . '.cav_date');
            $criteria->addSelectColumn($alias . '.cav_flag');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.mtp_type');
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
            $criteria->removeSelectColumn(PositionsTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(PositionsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(PositionsTableMap::COL_POSITION_NAME);
            $criteria->removeSelectColumn(PositionsTableMap::COL_POSITION_CODE);
            $criteria->removeSelectColumn(PositionsTableMap::COL_REPORTING_TO);
            $criteria->removeSelectColumn(PositionsTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(PositionsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PositionsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(PositionsTableMap::COL_CAV_POSITIONS_UP);
            $criteria->removeSelectColumn(PositionsTableMap::COL_CAV_POSITIONS_DOWN);
            $criteria->removeSelectColumn(PositionsTableMap::COL_CAV_TERRITORIES);
            $criteria->removeSelectColumn(PositionsTableMap::COL_CAV_TOWNS);
            $criteria->removeSelectColumn(PositionsTableMap::COL_CAV_DATE);
            $criteria->removeSelectColumn(PositionsTableMap::COL_CAV_FLAG);
            $criteria->removeSelectColumn(PositionsTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(PositionsTableMap::COL_MTP_TYPE);
        } else {
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.position_name');
            $criteria->removeSelectColumn($alias . '.position_code');
            $criteria->removeSelectColumn($alias . '.reporting_to');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.cav_positions_up');
            $criteria->removeSelectColumn($alias . '.cav_positions_down');
            $criteria->removeSelectColumn($alias . '.cav_territories');
            $criteria->removeSelectColumn($alias . '.cav_towns');
            $criteria->removeSelectColumn($alias . '.cav_date');
            $criteria->removeSelectColumn($alias . '.cav_flag');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.mtp_type');
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
        return Propel::getServiceContainer()->getDatabaseMap(PositionsTableMap::DATABASE_NAME)->getTable(PositionsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Positions or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Positions object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PositionsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Positions) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PositionsTableMap::DATABASE_NAME);
            $criteria->add(PositionsTableMap::COL_POSITION_ID, (array) $values, Criteria::IN);
        }

        $query = PositionsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PositionsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PositionsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the positions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PositionsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Positions or Criteria object.
     *
     * @param mixed $criteria Criteria or Positions object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Positions object
        }

        if ($criteria->containsKey(PositionsTableMap::COL_POSITION_ID) && $criteria->keyContainsValue(PositionsTableMap::COL_POSITION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PositionsTableMap::COL_POSITION_ID.')');
        }


        // Set the correct dbName
        $query = PositionsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
