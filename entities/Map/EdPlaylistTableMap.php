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
use entities\EdPlaylist;
use entities\EdPlaylistQuery;


/**
 * This class defines the structure of the 'ed_playlist' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EdPlaylistTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EdPlaylistTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ed_playlist';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EdPlaylist';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EdPlaylist';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EdPlaylist';

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
     * the column name for the playlist_id field
     */
    public const COL_PLAYLIST_ID = 'ed_playlist.playlist_id';

    /**
     * the column name for the playlist_name field
     */
    public const COL_PLAYLIST_NAME = 'ed_playlist.playlist_name';

    /**
     * the column name for the presentations field
     */
    public const COL_PRESENTATIONS = 'ed_playlist.presentations';

    /**
     * the column name for the playlist_media field
     */
    public const COL_PLAYLIST_MEDIA = 'ed_playlist.playlist_media';

    /**
     * the column name for the playlist_version_id field
     */
    public const COL_PLAYLIST_VERSION_ID = 'ed_playlist.playlist_version_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ed_playlist.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ed_playlist.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ed_playlist.updated_at';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'ed_playlist.orgunit_id';

    /**
     * the column name for the outlet_tags field
     */
    public const COL_OUTLET_TAGS = 'ed_playlist.outlet_tags';

    /**
     * the column name for the iscustom field
     */
    public const COL_ISCUSTOM = 'ed_playlist.iscustom';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'ed_playlist.outlet_org_id';

    /**
     * the column name for the device_time field
     */
    public const COL_DEVICE_TIME = 'ed_playlist.device_time';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'ed_playlist.employee_id';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'ed_playlist.status';

    /**
     * the column name for the playlist_type_id field
     */
    public const COL_PLAYLIST_TYPE_ID = 'ed_playlist.playlist_type_id';

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
        self::TYPE_PHPNAME       => ['PlaylistId', 'PlaylistName', 'Presentations', 'PlaylistMedia', 'PlaylistVersionId', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'OrgunitId', 'OutletTags', 'Iscustom', 'OutletOrgId', 'DeviceTime', 'EmployeeId', 'Status', 'PlaylistTypeId', ],
        self::TYPE_CAMELNAME     => ['playlistId', 'playlistName', 'presentations', 'playlistMedia', 'playlistVersionId', 'companyId', 'createdAt', 'updatedAt', 'orgunitId', 'outletTags', 'iscustom', 'outletOrgId', 'deviceTime', 'employeeId', 'status', 'playlistTypeId', ],
        self::TYPE_COLNAME       => [EdPlaylistTableMap::COL_PLAYLIST_ID, EdPlaylistTableMap::COL_PLAYLIST_NAME, EdPlaylistTableMap::COL_PRESENTATIONS, EdPlaylistTableMap::COL_PLAYLIST_MEDIA, EdPlaylistTableMap::COL_PLAYLIST_VERSION_ID, EdPlaylistTableMap::COL_COMPANY_ID, EdPlaylistTableMap::COL_CREATED_AT, EdPlaylistTableMap::COL_UPDATED_AT, EdPlaylistTableMap::COL_ORGUNIT_ID, EdPlaylistTableMap::COL_OUTLET_TAGS, EdPlaylistTableMap::COL_ISCUSTOM, EdPlaylistTableMap::COL_OUTLET_ORG_ID, EdPlaylistTableMap::COL_DEVICE_TIME, EdPlaylistTableMap::COL_EMPLOYEE_ID, EdPlaylistTableMap::COL_STATUS, EdPlaylistTableMap::COL_PLAYLIST_TYPE_ID, ],
        self::TYPE_FIELDNAME     => ['playlist_id', 'playlist_name', 'presentations', 'playlist_media', 'playlist_version_id', 'company_id', 'created_at', 'updated_at', 'orgunit_id', 'outlet_tags', 'iscustom', 'outlet_org_id', 'device_time', 'employee_id', 'status', 'playlist_type_id', ],
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
        self::TYPE_PHPNAME       => ['PlaylistId' => 0, 'PlaylistName' => 1, 'Presentations' => 2, 'PlaylistMedia' => 3, 'PlaylistVersionId' => 4, 'CompanyId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'OrgunitId' => 8, 'OutletTags' => 9, 'Iscustom' => 10, 'OutletOrgId' => 11, 'DeviceTime' => 12, 'EmployeeId' => 13, 'Status' => 14, 'PlaylistTypeId' => 15, ],
        self::TYPE_CAMELNAME     => ['playlistId' => 0, 'playlistName' => 1, 'presentations' => 2, 'playlistMedia' => 3, 'playlistVersionId' => 4, 'companyId' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'orgunitId' => 8, 'outletTags' => 9, 'iscustom' => 10, 'outletOrgId' => 11, 'deviceTime' => 12, 'employeeId' => 13, 'status' => 14, 'playlistTypeId' => 15, ],
        self::TYPE_COLNAME       => [EdPlaylistTableMap::COL_PLAYLIST_ID => 0, EdPlaylistTableMap::COL_PLAYLIST_NAME => 1, EdPlaylistTableMap::COL_PRESENTATIONS => 2, EdPlaylistTableMap::COL_PLAYLIST_MEDIA => 3, EdPlaylistTableMap::COL_PLAYLIST_VERSION_ID => 4, EdPlaylistTableMap::COL_COMPANY_ID => 5, EdPlaylistTableMap::COL_CREATED_AT => 6, EdPlaylistTableMap::COL_UPDATED_AT => 7, EdPlaylistTableMap::COL_ORGUNIT_ID => 8, EdPlaylistTableMap::COL_OUTLET_TAGS => 9, EdPlaylistTableMap::COL_ISCUSTOM => 10, EdPlaylistTableMap::COL_OUTLET_ORG_ID => 11, EdPlaylistTableMap::COL_DEVICE_TIME => 12, EdPlaylistTableMap::COL_EMPLOYEE_ID => 13, EdPlaylistTableMap::COL_STATUS => 14, EdPlaylistTableMap::COL_PLAYLIST_TYPE_ID => 15, ],
        self::TYPE_FIELDNAME     => ['playlist_id' => 0, 'playlist_name' => 1, 'presentations' => 2, 'playlist_media' => 3, 'playlist_version_id' => 4, 'company_id' => 5, 'created_at' => 6, 'updated_at' => 7, 'orgunit_id' => 8, 'outlet_tags' => 9, 'iscustom' => 10, 'outlet_org_id' => 11, 'device_time' => 12, 'employee_id' => 13, 'status' => 14, 'playlist_type_id' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PlaylistId' => 'PLAYLIST_ID',
        'EdPlaylist.PlaylistId' => 'PLAYLIST_ID',
        'playlistId' => 'PLAYLIST_ID',
        'edPlaylist.playlistId' => 'PLAYLIST_ID',
        'EdPlaylistTableMap::COL_PLAYLIST_ID' => 'PLAYLIST_ID',
        'COL_PLAYLIST_ID' => 'PLAYLIST_ID',
        'playlist_id' => 'PLAYLIST_ID',
        'ed_playlist.playlist_id' => 'PLAYLIST_ID',
        'PlaylistName' => 'PLAYLIST_NAME',
        'EdPlaylist.PlaylistName' => 'PLAYLIST_NAME',
        'playlistName' => 'PLAYLIST_NAME',
        'edPlaylist.playlistName' => 'PLAYLIST_NAME',
        'EdPlaylistTableMap::COL_PLAYLIST_NAME' => 'PLAYLIST_NAME',
        'COL_PLAYLIST_NAME' => 'PLAYLIST_NAME',
        'playlist_name' => 'PLAYLIST_NAME',
        'ed_playlist.playlist_name' => 'PLAYLIST_NAME',
        'Presentations' => 'PRESENTATIONS',
        'EdPlaylist.Presentations' => 'PRESENTATIONS',
        'presentations' => 'PRESENTATIONS',
        'edPlaylist.presentations' => 'PRESENTATIONS',
        'EdPlaylistTableMap::COL_PRESENTATIONS' => 'PRESENTATIONS',
        'COL_PRESENTATIONS' => 'PRESENTATIONS',
        'ed_playlist.presentations' => 'PRESENTATIONS',
        'PlaylistMedia' => 'PLAYLIST_MEDIA',
        'EdPlaylist.PlaylistMedia' => 'PLAYLIST_MEDIA',
        'playlistMedia' => 'PLAYLIST_MEDIA',
        'edPlaylist.playlistMedia' => 'PLAYLIST_MEDIA',
        'EdPlaylistTableMap::COL_PLAYLIST_MEDIA' => 'PLAYLIST_MEDIA',
        'COL_PLAYLIST_MEDIA' => 'PLAYLIST_MEDIA',
        'playlist_media' => 'PLAYLIST_MEDIA',
        'ed_playlist.playlist_media' => 'PLAYLIST_MEDIA',
        'PlaylistVersionId' => 'PLAYLIST_VERSION_ID',
        'EdPlaylist.PlaylistVersionId' => 'PLAYLIST_VERSION_ID',
        'playlistVersionId' => 'PLAYLIST_VERSION_ID',
        'edPlaylist.playlistVersionId' => 'PLAYLIST_VERSION_ID',
        'EdPlaylistTableMap::COL_PLAYLIST_VERSION_ID' => 'PLAYLIST_VERSION_ID',
        'COL_PLAYLIST_VERSION_ID' => 'PLAYLIST_VERSION_ID',
        'playlist_version_id' => 'PLAYLIST_VERSION_ID',
        'ed_playlist.playlist_version_id' => 'PLAYLIST_VERSION_ID',
        'CompanyId' => 'COMPANY_ID',
        'EdPlaylist.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'edPlaylist.companyId' => 'COMPANY_ID',
        'EdPlaylistTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ed_playlist.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'EdPlaylist.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'edPlaylist.createdAt' => 'CREATED_AT',
        'EdPlaylistTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ed_playlist.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EdPlaylist.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'edPlaylist.updatedAt' => 'UPDATED_AT',
        'EdPlaylistTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ed_playlist.updated_at' => 'UPDATED_AT',
        'OrgunitId' => 'ORGUNIT_ID',
        'EdPlaylist.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'edPlaylist.orgunitId' => 'ORGUNIT_ID',
        'EdPlaylistTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'ed_playlist.orgunit_id' => 'ORGUNIT_ID',
        'OutletTags' => 'OUTLET_TAGS',
        'EdPlaylist.OutletTags' => 'OUTLET_TAGS',
        'outletTags' => 'OUTLET_TAGS',
        'edPlaylist.outletTags' => 'OUTLET_TAGS',
        'EdPlaylistTableMap::COL_OUTLET_TAGS' => 'OUTLET_TAGS',
        'COL_OUTLET_TAGS' => 'OUTLET_TAGS',
        'outlet_tags' => 'OUTLET_TAGS',
        'ed_playlist.outlet_tags' => 'OUTLET_TAGS',
        'Iscustom' => 'ISCUSTOM',
        'EdPlaylist.Iscustom' => 'ISCUSTOM',
        'iscustom' => 'ISCUSTOM',
        'edPlaylist.iscustom' => 'ISCUSTOM',
        'EdPlaylistTableMap::COL_ISCUSTOM' => 'ISCUSTOM',
        'COL_ISCUSTOM' => 'ISCUSTOM',
        'ed_playlist.iscustom' => 'ISCUSTOM',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'EdPlaylist.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'edPlaylist.outletOrgId' => 'OUTLET_ORG_ID',
        'EdPlaylistTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'ed_playlist.outlet_org_id' => 'OUTLET_ORG_ID',
        'DeviceTime' => 'DEVICE_TIME',
        'EdPlaylist.DeviceTime' => 'DEVICE_TIME',
        'deviceTime' => 'DEVICE_TIME',
        'edPlaylist.deviceTime' => 'DEVICE_TIME',
        'EdPlaylistTableMap::COL_DEVICE_TIME' => 'DEVICE_TIME',
        'COL_DEVICE_TIME' => 'DEVICE_TIME',
        'device_time' => 'DEVICE_TIME',
        'ed_playlist.device_time' => 'DEVICE_TIME',
        'EmployeeId' => 'EMPLOYEE_ID',
        'EdPlaylist.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'edPlaylist.employeeId' => 'EMPLOYEE_ID',
        'EdPlaylistTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'ed_playlist.employee_id' => 'EMPLOYEE_ID',
        'Status' => 'STATUS',
        'EdPlaylist.Status' => 'STATUS',
        'status' => 'STATUS',
        'edPlaylist.status' => 'STATUS',
        'EdPlaylistTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'ed_playlist.status' => 'STATUS',
        'PlaylistTypeId' => 'PLAYLIST_TYPE_ID',
        'EdPlaylist.PlaylistTypeId' => 'PLAYLIST_TYPE_ID',
        'playlistTypeId' => 'PLAYLIST_TYPE_ID',
        'edPlaylist.playlistTypeId' => 'PLAYLIST_TYPE_ID',
        'EdPlaylistTableMap::COL_PLAYLIST_TYPE_ID' => 'PLAYLIST_TYPE_ID',
        'COL_PLAYLIST_TYPE_ID' => 'PLAYLIST_TYPE_ID',
        'playlist_type_id' => 'PLAYLIST_TYPE_ID',
        'ed_playlist.playlist_type_id' => 'PLAYLIST_TYPE_ID',
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
        $this->setName('ed_playlist');
        $this->setPhpName('EdPlaylist');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EdPlaylist');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ed_playlist_playlist_id_seq');
        // columns
        $this->addPrimaryKey('playlist_id', 'PlaylistId', 'INTEGER', true, null, null);
        $this->addColumn('playlist_name', 'PlaylistName', 'VARCHAR', false, null, null);
        $this->addColumn('presentations', 'Presentations', 'VARCHAR', false, null, null);
        $this->addColumn('playlist_media', 'PlaylistMedia', 'INTEGER', false, null, null);
        $this->addColumn('playlist_version_id', 'PlaylistVersionId', 'DECIMAL', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('orgunit_id', 'OrgunitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('outlet_tags', 'OutletTags', 'VARCHAR', false, null, null);
        $this->addColumn('iscustom', 'Iscustom', 'BOOLEAN', false, 1, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('device_time', 'DeviceTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addColumn('playlist_type_id', 'PlaylistTypeId', 'INTEGER', false, null, null);
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
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PlaylistId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PlaylistId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PlaylistId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PlaylistId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PlaylistId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PlaylistId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PlaylistId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EdPlaylistTableMap::CLASS_DEFAULT : EdPlaylistTableMap::OM_CLASS;
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
     * @return array (EdPlaylist object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EdPlaylistTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EdPlaylistTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EdPlaylistTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EdPlaylistTableMap::OM_CLASS;
            /** @var EdPlaylist $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EdPlaylistTableMap::addInstanceToPool($obj, $key);
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
            $key = EdPlaylistTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EdPlaylistTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EdPlaylist $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EdPlaylistTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_ID);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_NAME);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_PRESENTATIONS);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_MEDIA);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_VERSION_ID);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_ORGUNIT_ID);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_OUTLET_TAGS);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_ISCUSTOM);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_DEVICE_TIME);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_STATUS);
            $criteria->addSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_TYPE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.playlist_id');
            $criteria->addSelectColumn($alias . '.playlist_name');
            $criteria->addSelectColumn($alias . '.presentations');
            $criteria->addSelectColumn($alias . '.playlist_media');
            $criteria->addSelectColumn($alias . '.playlist_version_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.orgunit_id');
            $criteria->addSelectColumn($alias . '.outlet_tags');
            $criteria->addSelectColumn($alias . '.iscustom');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.device_time');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.playlist_type_id');
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
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_ID);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_NAME);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_PRESENTATIONS);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_MEDIA);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_VERSION_ID);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_ORGUNIT_ID);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_OUTLET_TAGS);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_ISCUSTOM);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_DEVICE_TIME);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_STATUS);
            $criteria->removeSelectColumn(EdPlaylistTableMap::COL_PLAYLIST_TYPE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.playlist_id');
            $criteria->removeSelectColumn($alias . '.playlist_name');
            $criteria->removeSelectColumn($alias . '.presentations');
            $criteria->removeSelectColumn($alias . '.playlist_media');
            $criteria->removeSelectColumn($alias . '.playlist_version_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
            $criteria->removeSelectColumn($alias . '.outlet_tags');
            $criteria->removeSelectColumn($alias . '.iscustom');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.device_time');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.playlist_type_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(EdPlaylistTableMap::DATABASE_NAME)->getTable(EdPlaylistTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EdPlaylist or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EdPlaylist object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EdPlaylistTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EdPlaylist) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EdPlaylistTableMap::DATABASE_NAME);
            $criteria->add(EdPlaylistTableMap::COL_PLAYLIST_ID, (array) $values, Criteria::IN);
        }

        $query = EdPlaylistQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EdPlaylistTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EdPlaylistTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ed_playlist table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EdPlaylistQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EdPlaylist or Criteria object.
     *
     * @param mixed $criteria Criteria or EdPlaylist object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdPlaylistTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EdPlaylist object
        }

        if ($criteria->containsKey(EdPlaylistTableMap::COL_PLAYLIST_ID) && $criteria->keyContainsValue(EdPlaylistTableMap::COL_PLAYLIST_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EdPlaylistTableMap::COL_PLAYLIST_ID.')');
        }


        // Set the correct dbName
        $query = EdPlaylistQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
