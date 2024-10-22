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
use entities\EdStats;
use entities\EdStatsQuery;


/**
 * This class defines the structure of the 'ed_stats' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EdStatsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EdStatsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ed_stats';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EdStats';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EdStats';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EdStats';

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
     * the column name for the ed_stats_id field
     */
    public const COL_ED_STATS_ID = 'ed_stats.ed_stats_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'ed_stats.outlet_org_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'ed_stats.brand_id';

    /**
     * the column name for the session_id field
     */
    public const COL_SESSION_ID = 'ed_stats.session_id';

    /**
     * the column name for the ed_order field
     */
    public const COL_ED_ORDER = 'ed_stats.ed_order';

    /**
     * the column name for the device_start_time field
     */
    public const COL_DEVICE_START_TIME = 'ed_stats.device_start_time';

    /**
     * the column name for the device_end_time field
     */
    public const COL_DEVICE_END_TIME = 'ed_stats.device_end_time';

    /**
     * the column name for the duration field
     */
    public const COL_DURATION = 'ed_stats.duration';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ed_stats.company_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'ed_stats.orgunitid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ed_stats.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ed_stats.updated_at';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'ed_stats.employee_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'ed_stats.position_id';

    /**
     * the column name for the presentation_id field
     */
    public const COL_PRESENTATION_ID = 'ed_stats.presentation_id';

    /**
     * the column name for the playlist_id field
     */
    public const COL_PLAYLIST_ID = 'ed_stats.playlist_id';

    /**
     * the column name for the ed_date field
     */
    public const COL_ED_DATE = 'ed_stats.ed_date';

    /**
     * the column name for the presentation_name field
     */
    public const COL_PRESENTATION_NAME = 'ed_stats.presentation_name';

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
        self::TYPE_PHPNAME       => ['EdStatsId', 'OutletOrgId', 'BrandId', 'SessionId', 'EdOrder', 'DeviceStartTime', 'DeviceEndTime', 'Duration', 'CompanyId', 'Orgunitid', 'CreatedAt', 'UpdatedAt', 'EmployeeId', 'PositionId', 'PresentationId', 'PlaylistId', 'EdDate', 'PresentationName', ],
        self::TYPE_CAMELNAME     => ['edStatsId', 'outletOrgId', 'brandId', 'sessionId', 'edOrder', 'deviceStartTime', 'deviceEndTime', 'duration', 'companyId', 'orgunitid', 'createdAt', 'updatedAt', 'employeeId', 'positionId', 'presentationId', 'playlistId', 'edDate', 'presentationName', ],
        self::TYPE_COLNAME       => [EdStatsTableMap::COL_ED_STATS_ID, EdStatsTableMap::COL_OUTLET_ORG_ID, EdStatsTableMap::COL_BRAND_ID, EdStatsTableMap::COL_SESSION_ID, EdStatsTableMap::COL_ED_ORDER, EdStatsTableMap::COL_DEVICE_START_TIME, EdStatsTableMap::COL_DEVICE_END_TIME, EdStatsTableMap::COL_DURATION, EdStatsTableMap::COL_COMPANY_ID, EdStatsTableMap::COL_ORGUNITID, EdStatsTableMap::COL_CREATED_AT, EdStatsTableMap::COL_UPDATED_AT, EdStatsTableMap::COL_EMPLOYEE_ID, EdStatsTableMap::COL_POSITION_ID, EdStatsTableMap::COL_PRESENTATION_ID, EdStatsTableMap::COL_PLAYLIST_ID, EdStatsTableMap::COL_ED_DATE, EdStatsTableMap::COL_PRESENTATION_NAME, ],
        self::TYPE_FIELDNAME     => ['ed_stats_id', 'outlet_org_id', 'brand_id', 'session_id', 'ed_order', 'device_start_time', 'device_end_time', 'duration', 'company_id', 'orgunitid', 'created_at', 'updated_at', 'employee_id', 'position_id', 'presentation_id', 'playlist_id', 'ed_date', 'presentation_name', ],
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
        self::TYPE_PHPNAME       => ['EdStatsId' => 0, 'OutletOrgId' => 1, 'BrandId' => 2, 'SessionId' => 3, 'EdOrder' => 4, 'DeviceStartTime' => 5, 'DeviceEndTime' => 6, 'Duration' => 7, 'CompanyId' => 8, 'Orgunitid' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'EmployeeId' => 12, 'PositionId' => 13, 'PresentationId' => 14, 'PlaylistId' => 15, 'EdDate' => 16, 'PresentationName' => 17, ],
        self::TYPE_CAMELNAME     => ['edStatsId' => 0, 'outletOrgId' => 1, 'brandId' => 2, 'sessionId' => 3, 'edOrder' => 4, 'deviceStartTime' => 5, 'deviceEndTime' => 6, 'duration' => 7, 'companyId' => 8, 'orgunitid' => 9, 'createdAt' => 10, 'updatedAt' => 11, 'employeeId' => 12, 'positionId' => 13, 'presentationId' => 14, 'playlistId' => 15, 'edDate' => 16, 'presentationName' => 17, ],
        self::TYPE_COLNAME       => [EdStatsTableMap::COL_ED_STATS_ID => 0, EdStatsTableMap::COL_OUTLET_ORG_ID => 1, EdStatsTableMap::COL_BRAND_ID => 2, EdStatsTableMap::COL_SESSION_ID => 3, EdStatsTableMap::COL_ED_ORDER => 4, EdStatsTableMap::COL_DEVICE_START_TIME => 5, EdStatsTableMap::COL_DEVICE_END_TIME => 6, EdStatsTableMap::COL_DURATION => 7, EdStatsTableMap::COL_COMPANY_ID => 8, EdStatsTableMap::COL_ORGUNITID => 9, EdStatsTableMap::COL_CREATED_AT => 10, EdStatsTableMap::COL_UPDATED_AT => 11, EdStatsTableMap::COL_EMPLOYEE_ID => 12, EdStatsTableMap::COL_POSITION_ID => 13, EdStatsTableMap::COL_PRESENTATION_ID => 14, EdStatsTableMap::COL_PLAYLIST_ID => 15, EdStatsTableMap::COL_ED_DATE => 16, EdStatsTableMap::COL_PRESENTATION_NAME => 17, ],
        self::TYPE_FIELDNAME     => ['ed_stats_id' => 0, 'outlet_org_id' => 1, 'brand_id' => 2, 'session_id' => 3, 'ed_order' => 4, 'device_start_time' => 5, 'device_end_time' => 6, 'duration' => 7, 'company_id' => 8, 'orgunitid' => 9, 'created_at' => 10, 'updated_at' => 11, 'employee_id' => 12, 'position_id' => 13, 'presentation_id' => 14, 'playlist_id' => 15, 'ed_date' => 16, 'presentation_name' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EdStatsId' => 'ED_STATS_ID',
        'EdStats.EdStatsId' => 'ED_STATS_ID',
        'edStatsId' => 'ED_STATS_ID',
        'edStats.edStatsId' => 'ED_STATS_ID',
        'EdStatsTableMap::COL_ED_STATS_ID' => 'ED_STATS_ID',
        'COL_ED_STATS_ID' => 'ED_STATS_ID',
        'ed_stats_id' => 'ED_STATS_ID',
        'ed_stats.ed_stats_id' => 'ED_STATS_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'EdStats.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'edStats.outletOrgId' => 'OUTLET_ORG_ID',
        'EdStatsTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'ed_stats.outlet_org_id' => 'OUTLET_ORG_ID',
        'BrandId' => 'BRAND_ID',
        'EdStats.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'edStats.brandId' => 'BRAND_ID',
        'EdStatsTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'ed_stats.brand_id' => 'BRAND_ID',
        'SessionId' => 'SESSION_ID',
        'EdStats.SessionId' => 'SESSION_ID',
        'sessionId' => 'SESSION_ID',
        'edStats.sessionId' => 'SESSION_ID',
        'EdStatsTableMap::COL_SESSION_ID' => 'SESSION_ID',
        'COL_SESSION_ID' => 'SESSION_ID',
        'session_id' => 'SESSION_ID',
        'ed_stats.session_id' => 'SESSION_ID',
        'EdOrder' => 'ED_ORDER',
        'EdStats.EdOrder' => 'ED_ORDER',
        'edOrder' => 'ED_ORDER',
        'edStats.edOrder' => 'ED_ORDER',
        'EdStatsTableMap::COL_ED_ORDER' => 'ED_ORDER',
        'COL_ED_ORDER' => 'ED_ORDER',
        'ed_order' => 'ED_ORDER',
        'ed_stats.ed_order' => 'ED_ORDER',
        'DeviceStartTime' => 'DEVICE_START_TIME',
        'EdStats.DeviceStartTime' => 'DEVICE_START_TIME',
        'deviceStartTime' => 'DEVICE_START_TIME',
        'edStats.deviceStartTime' => 'DEVICE_START_TIME',
        'EdStatsTableMap::COL_DEVICE_START_TIME' => 'DEVICE_START_TIME',
        'COL_DEVICE_START_TIME' => 'DEVICE_START_TIME',
        'device_start_time' => 'DEVICE_START_TIME',
        'ed_stats.device_start_time' => 'DEVICE_START_TIME',
        'DeviceEndTime' => 'DEVICE_END_TIME',
        'EdStats.DeviceEndTime' => 'DEVICE_END_TIME',
        'deviceEndTime' => 'DEVICE_END_TIME',
        'edStats.deviceEndTime' => 'DEVICE_END_TIME',
        'EdStatsTableMap::COL_DEVICE_END_TIME' => 'DEVICE_END_TIME',
        'COL_DEVICE_END_TIME' => 'DEVICE_END_TIME',
        'device_end_time' => 'DEVICE_END_TIME',
        'ed_stats.device_end_time' => 'DEVICE_END_TIME',
        'Duration' => 'DURATION',
        'EdStats.Duration' => 'DURATION',
        'duration' => 'DURATION',
        'edStats.duration' => 'DURATION',
        'EdStatsTableMap::COL_DURATION' => 'DURATION',
        'COL_DURATION' => 'DURATION',
        'ed_stats.duration' => 'DURATION',
        'CompanyId' => 'COMPANY_ID',
        'EdStats.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'edStats.companyId' => 'COMPANY_ID',
        'EdStatsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ed_stats.company_id' => 'COMPANY_ID',
        'Orgunitid' => 'ORGUNITID',
        'EdStats.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'edStats.orgunitid' => 'ORGUNITID',
        'EdStatsTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'ed_stats.orgunitid' => 'ORGUNITID',
        'CreatedAt' => 'CREATED_AT',
        'EdStats.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'edStats.createdAt' => 'CREATED_AT',
        'EdStatsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ed_stats.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EdStats.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'edStats.updatedAt' => 'UPDATED_AT',
        'EdStatsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ed_stats.updated_at' => 'UPDATED_AT',
        'EmployeeId' => 'EMPLOYEE_ID',
        'EdStats.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'edStats.employeeId' => 'EMPLOYEE_ID',
        'EdStatsTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'ed_stats.employee_id' => 'EMPLOYEE_ID',
        'PositionId' => 'POSITION_ID',
        'EdStats.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'edStats.positionId' => 'POSITION_ID',
        'EdStatsTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'ed_stats.position_id' => 'POSITION_ID',
        'PresentationId' => 'PRESENTATION_ID',
        'EdStats.PresentationId' => 'PRESENTATION_ID',
        'presentationId' => 'PRESENTATION_ID',
        'edStats.presentationId' => 'PRESENTATION_ID',
        'EdStatsTableMap::COL_PRESENTATION_ID' => 'PRESENTATION_ID',
        'COL_PRESENTATION_ID' => 'PRESENTATION_ID',
        'presentation_id' => 'PRESENTATION_ID',
        'ed_stats.presentation_id' => 'PRESENTATION_ID',
        'PlaylistId' => 'PLAYLIST_ID',
        'EdStats.PlaylistId' => 'PLAYLIST_ID',
        'playlistId' => 'PLAYLIST_ID',
        'edStats.playlistId' => 'PLAYLIST_ID',
        'EdStatsTableMap::COL_PLAYLIST_ID' => 'PLAYLIST_ID',
        'COL_PLAYLIST_ID' => 'PLAYLIST_ID',
        'playlist_id' => 'PLAYLIST_ID',
        'ed_stats.playlist_id' => 'PLAYLIST_ID',
        'EdDate' => 'ED_DATE',
        'EdStats.EdDate' => 'ED_DATE',
        'edDate' => 'ED_DATE',
        'edStats.edDate' => 'ED_DATE',
        'EdStatsTableMap::COL_ED_DATE' => 'ED_DATE',
        'COL_ED_DATE' => 'ED_DATE',
        'ed_date' => 'ED_DATE',
        'ed_stats.ed_date' => 'ED_DATE',
        'PresentationName' => 'PRESENTATION_NAME',
        'EdStats.PresentationName' => 'PRESENTATION_NAME',
        'presentationName' => 'PRESENTATION_NAME',
        'edStats.presentationName' => 'PRESENTATION_NAME',
        'EdStatsTableMap::COL_PRESENTATION_NAME' => 'PRESENTATION_NAME',
        'COL_PRESENTATION_NAME' => 'PRESENTATION_NAME',
        'presentation_name' => 'PRESENTATION_NAME',
        'ed_stats.presentation_name' => 'PRESENTATION_NAME',
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
        $this->setName('ed_stats');
        $this->setPhpName('EdStats');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EdStats');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ed_stats_ed_stats_id_seq');
        // columns
        $this->addPrimaryKey('ed_stats_id', 'EdStatsId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_org_id', 'OutletOrgId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', false, null, null);
        $this->addColumn('session_id', 'SessionId', 'VARCHAR', false, null, null);
        $this->addColumn('ed_order', 'EdOrder', 'INTEGER', false, null, null);
        $this->addColumn('device_start_time', 'DeviceStartTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('device_end_time', 'DeviceEndTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('duration', 'Duration', 'INTEGER', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('presentation_id', 'PresentationId', 'INTEGER', false, null, null);
        $this->addColumn('playlist_id', 'PlaylistId', 'INTEGER', false, null, null);
        $this->addColumn('ed_date', 'EdDate', 'DATE', false, null, null);
        $this->addColumn('presentation_name', 'PresentationName', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdStatsId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdStatsId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdStatsId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdStatsId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdStatsId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdStatsId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EdStatsId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EdStatsTableMap::CLASS_DEFAULT : EdStatsTableMap::OM_CLASS;
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
     * @return array (EdStats object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EdStatsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EdStatsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EdStatsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EdStatsTableMap::OM_CLASS;
            /** @var EdStats $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EdStatsTableMap::addInstanceToPool($obj, $key);
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
            $key = EdStatsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EdStatsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EdStats $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EdStatsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EdStatsTableMap::COL_ED_STATS_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_SESSION_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_ED_ORDER);
            $criteria->addSelectColumn(EdStatsTableMap::COL_DEVICE_START_TIME);
            $criteria->addSelectColumn(EdStatsTableMap::COL_DEVICE_END_TIME);
            $criteria->addSelectColumn(EdStatsTableMap::COL_DURATION);
            $criteria->addSelectColumn(EdStatsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EdStatsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EdStatsTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_PRESENTATION_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_PLAYLIST_ID);
            $criteria->addSelectColumn(EdStatsTableMap::COL_ED_DATE);
            $criteria->addSelectColumn(EdStatsTableMap::COL_PRESENTATION_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.ed_stats_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.session_id');
            $criteria->addSelectColumn($alias . '.ed_order');
            $criteria->addSelectColumn($alias . '.device_start_time');
            $criteria->addSelectColumn($alias . '.device_end_time');
            $criteria->addSelectColumn($alias . '.duration');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.presentation_id');
            $criteria->addSelectColumn($alias . '.playlist_id');
            $criteria->addSelectColumn($alias . '.ed_date');
            $criteria->addSelectColumn($alias . '.presentation_name');
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
            $criteria->removeSelectColumn(EdStatsTableMap::COL_ED_STATS_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_SESSION_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_ED_ORDER);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_DEVICE_START_TIME);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_DEVICE_END_TIME);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_DURATION);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_PRESENTATION_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_PLAYLIST_ID);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_ED_DATE);
            $criteria->removeSelectColumn(EdStatsTableMap::COL_PRESENTATION_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.ed_stats_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.session_id');
            $criteria->removeSelectColumn($alias . '.ed_order');
            $criteria->removeSelectColumn($alias . '.device_start_time');
            $criteria->removeSelectColumn($alias . '.device_end_time');
            $criteria->removeSelectColumn($alias . '.duration');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.presentation_id');
            $criteria->removeSelectColumn($alias . '.playlist_id');
            $criteria->removeSelectColumn($alias . '.ed_date');
            $criteria->removeSelectColumn($alias . '.presentation_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(EdStatsTableMap::DATABASE_NAME)->getTable(EdStatsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EdStats or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EdStats object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EdStatsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EdStats) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EdStatsTableMap::DATABASE_NAME);
            $criteria->add(EdStatsTableMap::COL_ED_STATS_ID, (array) $values, Criteria::IN);
        }

        $query = EdStatsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EdStatsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EdStatsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ed_stats table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EdStatsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EdStats or Criteria object.
     *
     * @param mixed $criteria Criteria or EdStats object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdStatsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EdStats object
        }

        if ($criteria->containsKey(EdStatsTableMap::COL_ED_STATS_ID) && $criteria->keyContainsValue(EdStatsTableMap::COL_ED_STATS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EdStatsTableMap::COL_ED_STATS_ID.')');
        }


        // Set the correct dbName
        $query = EdStatsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
