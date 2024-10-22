<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\EdStatsBackup;
use entities\EdStatsBackupQuery;


/**
 * This class defines the structure of the 'ed_stats_backup' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EdStatsBackupTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EdStatsBackupTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ed_stats_backup';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EdStatsBackup';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EdStatsBackup';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EdStatsBackup';

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
    public const COL_ED_STATS_ID = 'ed_stats_backup.ed_stats_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'ed_stats_backup.outlet_org_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'ed_stats_backup.brand_id';

    /**
     * the column name for the session_id field
     */
    public const COL_SESSION_ID = 'ed_stats_backup.session_id';

    /**
     * the column name for the ed_order field
     */
    public const COL_ED_ORDER = 'ed_stats_backup.ed_order';

    /**
     * the column name for the device_start_time field
     */
    public const COL_DEVICE_START_TIME = 'ed_stats_backup.device_start_time';

    /**
     * the column name for the device_end_time field
     */
    public const COL_DEVICE_END_TIME = 'ed_stats_backup.device_end_time';

    /**
     * the column name for the duration field
     */
    public const COL_DURATION = 'ed_stats_backup.duration';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ed_stats_backup.company_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'ed_stats_backup.orgunitid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ed_stats_backup.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ed_stats_backup.updated_at';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'ed_stats_backup.employee_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'ed_stats_backup.position_id';

    /**
     * the column name for the presentation_id field
     */
    public const COL_PRESENTATION_ID = 'ed_stats_backup.presentation_id';

    /**
     * the column name for the playlist_id field
     */
    public const COL_PLAYLIST_ID = 'ed_stats_backup.playlist_id';

    /**
     * the column name for the ed_date field
     */
    public const COL_ED_DATE = 'ed_stats_backup.ed_date';

    /**
     * the column name for the presentation_name field
     */
    public const COL_PRESENTATION_NAME = 'ed_stats_backup.presentation_name';

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
        self::TYPE_COLNAME       => [EdStatsBackupTableMap::COL_ED_STATS_ID, EdStatsBackupTableMap::COL_OUTLET_ORG_ID, EdStatsBackupTableMap::COL_BRAND_ID, EdStatsBackupTableMap::COL_SESSION_ID, EdStatsBackupTableMap::COL_ED_ORDER, EdStatsBackupTableMap::COL_DEVICE_START_TIME, EdStatsBackupTableMap::COL_DEVICE_END_TIME, EdStatsBackupTableMap::COL_DURATION, EdStatsBackupTableMap::COL_COMPANY_ID, EdStatsBackupTableMap::COL_ORGUNITID, EdStatsBackupTableMap::COL_CREATED_AT, EdStatsBackupTableMap::COL_UPDATED_AT, EdStatsBackupTableMap::COL_EMPLOYEE_ID, EdStatsBackupTableMap::COL_POSITION_ID, EdStatsBackupTableMap::COL_PRESENTATION_ID, EdStatsBackupTableMap::COL_PLAYLIST_ID, EdStatsBackupTableMap::COL_ED_DATE, EdStatsBackupTableMap::COL_PRESENTATION_NAME, ],
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
        self::TYPE_COLNAME       => [EdStatsBackupTableMap::COL_ED_STATS_ID => 0, EdStatsBackupTableMap::COL_OUTLET_ORG_ID => 1, EdStatsBackupTableMap::COL_BRAND_ID => 2, EdStatsBackupTableMap::COL_SESSION_ID => 3, EdStatsBackupTableMap::COL_ED_ORDER => 4, EdStatsBackupTableMap::COL_DEVICE_START_TIME => 5, EdStatsBackupTableMap::COL_DEVICE_END_TIME => 6, EdStatsBackupTableMap::COL_DURATION => 7, EdStatsBackupTableMap::COL_COMPANY_ID => 8, EdStatsBackupTableMap::COL_ORGUNITID => 9, EdStatsBackupTableMap::COL_CREATED_AT => 10, EdStatsBackupTableMap::COL_UPDATED_AT => 11, EdStatsBackupTableMap::COL_EMPLOYEE_ID => 12, EdStatsBackupTableMap::COL_POSITION_ID => 13, EdStatsBackupTableMap::COL_PRESENTATION_ID => 14, EdStatsBackupTableMap::COL_PLAYLIST_ID => 15, EdStatsBackupTableMap::COL_ED_DATE => 16, EdStatsBackupTableMap::COL_PRESENTATION_NAME => 17, ],
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
        'EdStatsBackup.EdStatsId' => 'ED_STATS_ID',
        'edStatsId' => 'ED_STATS_ID',
        'edStatsBackup.edStatsId' => 'ED_STATS_ID',
        'EdStatsBackupTableMap::COL_ED_STATS_ID' => 'ED_STATS_ID',
        'COL_ED_STATS_ID' => 'ED_STATS_ID',
        'ed_stats_id' => 'ED_STATS_ID',
        'ed_stats_backup.ed_stats_id' => 'ED_STATS_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'EdStatsBackup.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'edStatsBackup.outletOrgId' => 'OUTLET_ORG_ID',
        'EdStatsBackupTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'ed_stats_backup.outlet_org_id' => 'OUTLET_ORG_ID',
        'BrandId' => 'BRAND_ID',
        'EdStatsBackup.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'edStatsBackup.brandId' => 'BRAND_ID',
        'EdStatsBackupTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'ed_stats_backup.brand_id' => 'BRAND_ID',
        'SessionId' => 'SESSION_ID',
        'EdStatsBackup.SessionId' => 'SESSION_ID',
        'sessionId' => 'SESSION_ID',
        'edStatsBackup.sessionId' => 'SESSION_ID',
        'EdStatsBackupTableMap::COL_SESSION_ID' => 'SESSION_ID',
        'COL_SESSION_ID' => 'SESSION_ID',
        'session_id' => 'SESSION_ID',
        'ed_stats_backup.session_id' => 'SESSION_ID',
        'EdOrder' => 'ED_ORDER',
        'EdStatsBackup.EdOrder' => 'ED_ORDER',
        'edOrder' => 'ED_ORDER',
        'edStatsBackup.edOrder' => 'ED_ORDER',
        'EdStatsBackupTableMap::COL_ED_ORDER' => 'ED_ORDER',
        'COL_ED_ORDER' => 'ED_ORDER',
        'ed_order' => 'ED_ORDER',
        'ed_stats_backup.ed_order' => 'ED_ORDER',
        'DeviceStartTime' => 'DEVICE_START_TIME',
        'EdStatsBackup.DeviceStartTime' => 'DEVICE_START_TIME',
        'deviceStartTime' => 'DEVICE_START_TIME',
        'edStatsBackup.deviceStartTime' => 'DEVICE_START_TIME',
        'EdStatsBackupTableMap::COL_DEVICE_START_TIME' => 'DEVICE_START_TIME',
        'COL_DEVICE_START_TIME' => 'DEVICE_START_TIME',
        'device_start_time' => 'DEVICE_START_TIME',
        'ed_stats_backup.device_start_time' => 'DEVICE_START_TIME',
        'DeviceEndTime' => 'DEVICE_END_TIME',
        'EdStatsBackup.DeviceEndTime' => 'DEVICE_END_TIME',
        'deviceEndTime' => 'DEVICE_END_TIME',
        'edStatsBackup.deviceEndTime' => 'DEVICE_END_TIME',
        'EdStatsBackupTableMap::COL_DEVICE_END_TIME' => 'DEVICE_END_TIME',
        'COL_DEVICE_END_TIME' => 'DEVICE_END_TIME',
        'device_end_time' => 'DEVICE_END_TIME',
        'ed_stats_backup.device_end_time' => 'DEVICE_END_TIME',
        'Duration' => 'DURATION',
        'EdStatsBackup.Duration' => 'DURATION',
        'duration' => 'DURATION',
        'edStatsBackup.duration' => 'DURATION',
        'EdStatsBackupTableMap::COL_DURATION' => 'DURATION',
        'COL_DURATION' => 'DURATION',
        'ed_stats_backup.duration' => 'DURATION',
        'CompanyId' => 'COMPANY_ID',
        'EdStatsBackup.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'edStatsBackup.companyId' => 'COMPANY_ID',
        'EdStatsBackupTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ed_stats_backup.company_id' => 'COMPANY_ID',
        'Orgunitid' => 'ORGUNITID',
        'EdStatsBackup.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'edStatsBackup.orgunitid' => 'ORGUNITID',
        'EdStatsBackupTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'ed_stats_backup.orgunitid' => 'ORGUNITID',
        'CreatedAt' => 'CREATED_AT',
        'EdStatsBackup.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'edStatsBackup.createdAt' => 'CREATED_AT',
        'EdStatsBackupTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ed_stats_backup.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EdStatsBackup.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'edStatsBackup.updatedAt' => 'UPDATED_AT',
        'EdStatsBackupTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ed_stats_backup.updated_at' => 'UPDATED_AT',
        'EmployeeId' => 'EMPLOYEE_ID',
        'EdStatsBackup.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'edStatsBackup.employeeId' => 'EMPLOYEE_ID',
        'EdStatsBackupTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'ed_stats_backup.employee_id' => 'EMPLOYEE_ID',
        'PositionId' => 'POSITION_ID',
        'EdStatsBackup.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'edStatsBackup.positionId' => 'POSITION_ID',
        'EdStatsBackupTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'ed_stats_backup.position_id' => 'POSITION_ID',
        'PresentationId' => 'PRESENTATION_ID',
        'EdStatsBackup.PresentationId' => 'PRESENTATION_ID',
        'presentationId' => 'PRESENTATION_ID',
        'edStatsBackup.presentationId' => 'PRESENTATION_ID',
        'EdStatsBackupTableMap::COL_PRESENTATION_ID' => 'PRESENTATION_ID',
        'COL_PRESENTATION_ID' => 'PRESENTATION_ID',
        'presentation_id' => 'PRESENTATION_ID',
        'ed_stats_backup.presentation_id' => 'PRESENTATION_ID',
        'PlaylistId' => 'PLAYLIST_ID',
        'EdStatsBackup.PlaylistId' => 'PLAYLIST_ID',
        'playlistId' => 'PLAYLIST_ID',
        'edStatsBackup.playlistId' => 'PLAYLIST_ID',
        'EdStatsBackupTableMap::COL_PLAYLIST_ID' => 'PLAYLIST_ID',
        'COL_PLAYLIST_ID' => 'PLAYLIST_ID',
        'playlist_id' => 'PLAYLIST_ID',
        'ed_stats_backup.playlist_id' => 'PLAYLIST_ID',
        'EdDate' => 'ED_DATE',
        'EdStatsBackup.EdDate' => 'ED_DATE',
        'edDate' => 'ED_DATE',
        'edStatsBackup.edDate' => 'ED_DATE',
        'EdStatsBackupTableMap::COL_ED_DATE' => 'ED_DATE',
        'COL_ED_DATE' => 'ED_DATE',
        'ed_date' => 'ED_DATE',
        'ed_stats_backup.ed_date' => 'ED_DATE',
        'PresentationName' => 'PRESENTATION_NAME',
        'EdStatsBackup.PresentationName' => 'PRESENTATION_NAME',
        'presentationName' => 'PRESENTATION_NAME',
        'edStatsBackup.presentationName' => 'PRESENTATION_NAME',
        'EdStatsBackupTableMap::COL_PRESENTATION_NAME' => 'PRESENTATION_NAME',
        'COL_PRESENTATION_NAME' => 'PRESENTATION_NAME',
        'presentation_name' => 'PRESENTATION_NAME',
        'ed_stats_backup.presentation_name' => 'PRESENTATION_NAME',
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
        $this->setName('ed_stats_backup');
        $this->setPhpName('EdStatsBackup');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EdStatsBackup');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('ed_stats_id', 'EdStatsId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('session_id', 'SessionId', 'VARCHAR', false, null, null);
        $this->addColumn('ed_order', 'EdOrder', 'INTEGER', false, null, null);
        $this->addColumn('device_start_time', 'DeviceStartTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('device_end_time', 'DeviceEndTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('duration', 'Duration', 'INTEGER', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('orgunitid', 'Orgunitid', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
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
        return null;
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
        return '';
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
        return $withPrefix ? EdStatsBackupTableMap::CLASS_DEFAULT : EdStatsBackupTableMap::OM_CLASS;
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
     * @return array (EdStatsBackup object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EdStatsBackupTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EdStatsBackupTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EdStatsBackupTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EdStatsBackupTableMap::OM_CLASS;
            /** @var EdStatsBackup $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EdStatsBackupTableMap::addInstanceToPool($obj, $key);
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
            $key = EdStatsBackupTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EdStatsBackupTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EdStatsBackup $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EdStatsBackupTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_ED_STATS_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_SESSION_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_ED_ORDER);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_DEVICE_START_TIME);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_DEVICE_END_TIME);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_DURATION);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_PRESENTATION_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_PLAYLIST_ID);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_ED_DATE);
            $criteria->addSelectColumn(EdStatsBackupTableMap::COL_PRESENTATION_NAME);
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
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_ED_STATS_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_SESSION_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_ED_ORDER);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_DEVICE_START_TIME);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_DEVICE_END_TIME);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_DURATION);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_PRESENTATION_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_PLAYLIST_ID);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_ED_DATE);
            $criteria->removeSelectColumn(EdStatsBackupTableMap::COL_PRESENTATION_NAME);
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
        return Propel::getServiceContainer()->getDatabaseMap(EdStatsBackupTableMap::DATABASE_NAME)->getTable(EdStatsBackupTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EdStatsBackup or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EdStatsBackup object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EdStatsBackupTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EdStatsBackup) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The EdStatsBackup object has no primary key');
        }

        $query = EdStatsBackupQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EdStatsBackupTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EdStatsBackupTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ed_stats_backup table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EdStatsBackupQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EdStatsBackup or Criteria object.
     *
     * @param mixed $criteria Criteria or EdStatsBackup object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdStatsBackupTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EdStatsBackup object
        }


        // Set the correct dbName
        $query = EdStatsBackupQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
