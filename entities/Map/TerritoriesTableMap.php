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
use entities\Territories;
use entities\TerritoriesQuery;


/**
 * This class defines the structure of the 'territories' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TerritoriesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TerritoriesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'territories';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Territories';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Territories';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Territories';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'territories.territory_id';

    /**
     * the column name for the territory_code field
     */
    public const COL_TERRITORY_CODE = 'territories.territory_code';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'territories.company_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'territories.territory_name';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'territories.orgunitid';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'territories.position_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'territories.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'territories.updated_at';

    /**
     * the column name for the on_boarding_status field
     */
    public const COL_ON_BOARDING_STATUS = 'territories.on_boarding_status';

    /**
     * the column name for the start_date field
     */
    public const COL_START_DATE = 'territories.start_date';

    /**
     * the column name for the end_date field
     */
    public const COL_END_DATE = 'territories.end_date';

    /**
     * the column name for the istateid field
     */
    public const COL_ISTATEID = 'territories.istateid';

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
        self::TYPE_PHPNAME       => ['TerritoryId', 'TerritoryCode', 'CompanyId', 'TerritoryName', 'Orgunitid', 'PositionId', 'CreatedAt', 'UpdatedAt', 'OnBoardingStatus', 'StartDate', 'EndDate', 'Istateid', ],
        self::TYPE_CAMELNAME     => ['territoryId', 'territoryCode', 'companyId', 'territoryName', 'orgunitid', 'positionId', 'createdAt', 'updatedAt', 'onBoardingStatus', 'startDate', 'endDate', 'istateid', ],
        self::TYPE_COLNAME       => [TerritoriesTableMap::COL_TERRITORY_ID, TerritoriesTableMap::COL_TERRITORY_CODE, TerritoriesTableMap::COL_COMPANY_ID, TerritoriesTableMap::COL_TERRITORY_NAME, TerritoriesTableMap::COL_ORGUNITID, TerritoriesTableMap::COL_POSITION_ID, TerritoriesTableMap::COL_CREATED_AT, TerritoriesTableMap::COL_UPDATED_AT, TerritoriesTableMap::COL_ON_BOARDING_STATUS, TerritoriesTableMap::COL_START_DATE, TerritoriesTableMap::COL_END_DATE, TerritoriesTableMap::COL_ISTATEID, ],
        self::TYPE_FIELDNAME     => ['territory_id', 'territory_code', 'company_id', 'territory_name', 'orgunitid', 'position_id', 'created_at', 'updated_at', 'on_boarding_status', 'start_date', 'end_date', 'istateid', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['TerritoryId' => 0, 'TerritoryCode' => 1, 'CompanyId' => 2, 'TerritoryName' => 3, 'Orgunitid' => 4, 'PositionId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'OnBoardingStatus' => 8, 'StartDate' => 9, 'EndDate' => 10, 'Istateid' => 11, ],
        self::TYPE_CAMELNAME     => ['territoryId' => 0, 'territoryCode' => 1, 'companyId' => 2, 'territoryName' => 3, 'orgunitid' => 4, 'positionId' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'onBoardingStatus' => 8, 'startDate' => 9, 'endDate' => 10, 'istateid' => 11, ],
        self::TYPE_COLNAME       => [TerritoriesTableMap::COL_TERRITORY_ID => 0, TerritoriesTableMap::COL_TERRITORY_CODE => 1, TerritoriesTableMap::COL_COMPANY_ID => 2, TerritoriesTableMap::COL_TERRITORY_NAME => 3, TerritoriesTableMap::COL_ORGUNITID => 4, TerritoriesTableMap::COL_POSITION_ID => 5, TerritoriesTableMap::COL_CREATED_AT => 6, TerritoriesTableMap::COL_UPDATED_AT => 7, TerritoriesTableMap::COL_ON_BOARDING_STATUS => 8, TerritoriesTableMap::COL_START_DATE => 9, TerritoriesTableMap::COL_END_DATE => 10, TerritoriesTableMap::COL_ISTATEID => 11, ],
        self::TYPE_FIELDNAME     => ['territory_id' => 0, 'territory_code' => 1, 'company_id' => 2, 'territory_name' => 3, 'orgunitid' => 4, 'position_id' => 5, 'created_at' => 6, 'updated_at' => 7, 'on_boarding_status' => 8, 'start_date' => 9, 'end_date' => 10, 'istateid' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TerritoryId' => 'TERRITORY_ID',
        'Territories.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'territories.territoryId' => 'TERRITORY_ID',
        'TerritoriesTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'territories.territory_id' => 'TERRITORY_ID',
        'TerritoryCode' => 'TERRITORY_CODE',
        'Territories.TerritoryCode' => 'TERRITORY_CODE',
        'territoryCode' => 'TERRITORY_CODE',
        'territories.territoryCode' => 'TERRITORY_CODE',
        'TerritoriesTableMap::COL_TERRITORY_CODE' => 'TERRITORY_CODE',
        'COL_TERRITORY_CODE' => 'TERRITORY_CODE',
        'territory_code' => 'TERRITORY_CODE',
        'territories.territory_code' => 'TERRITORY_CODE',
        'CompanyId' => 'COMPANY_ID',
        'Territories.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'territories.companyId' => 'COMPANY_ID',
        'TerritoriesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'territories.company_id' => 'COMPANY_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'Territories.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'territories.territoryName' => 'TERRITORY_NAME',
        'TerritoriesTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'territories.territory_name' => 'TERRITORY_NAME',
        'Orgunitid' => 'ORGUNITID',
        'Territories.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'territories.orgunitid' => 'ORGUNITID',
        'TerritoriesTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'PositionId' => 'POSITION_ID',
        'Territories.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'territories.positionId' => 'POSITION_ID',
        'TerritoriesTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'territories.position_id' => 'POSITION_ID',
        'CreatedAt' => 'CREATED_AT',
        'Territories.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'territories.createdAt' => 'CREATED_AT',
        'TerritoriesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'territories.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Territories.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'territories.updatedAt' => 'UPDATED_AT',
        'TerritoriesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'territories.updated_at' => 'UPDATED_AT',
        'OnBoardingStatus' => 'ON_BOARDING_STATUS',
        'Territories.OnBoardingStatus' => 'ON_BOARDING_STATUS',
        'onBoardingStatus' => 'ON_BOARDING_STATUS',
        'territories.onBoardingStatus' => 'ON_BOARDING_STATUS',
        'TerritoriesTableMap::COL_ON_BOARDING_STATUS' => 'ON_BOARDING_STATUS',
        'COL_ON_BOARDING_STATUS' => 'ON_BOARDING_STATUS',
        'on_boarding_status' => 'ON_BOARDING_STATUS',
        'territories.on_boarding_status' => 'ON_BOARDING_STATUS',
        'StartDate' => 'START_DATE',
        'Territories.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'territories.startDate' => 'START_DATE',
        'TerritoriesTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'start_date' => 'START_DATE',
        'territories.start_date' => 'START_DATE',
        'EndDate' => 'END_DATE',
        'Territories.EndDate' => 'END_DATE',
        'endDate' => 'END_DATE',
        'territories.endDate' => 'END_DATE',
        'TerritoriesTableMap::COL_END_DATE' => 'END_DATE',
        'COL_END_DATE' => 'END_DATE',
        'end_date' => 'END_DATE',
        'territories.end_date' => 'END_DATE',
        'Istateid' => 'ISTATEID',
        'Territories.Istateid' => 'ISTATEID',
        'istateid' => 'ISTATEID',
        'territories.istateid' => 'ISTATEID',
        'TerritoriesTableMap::COL_ISTATEID' => 'ISTATEID',
        'COL_ISTATEID' => 'ISTATEID',
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
        $this->setName('territories');
        $this->setPhpName('Territories');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Territories');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('territories_territory_id_seq');
        // columns
        $this->addPrimaryKey('territory_id', 'TerritoryId', 'INTEGER', true, null, null);
        $this->addColumn('territory_code', 'TerritoryCode', 'VARCHAR', false, 255, '0');
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', true, 50, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('on_boarding_status', 'OnBoardingStatus', 'INTEGER', true, null, 0);
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
        $this->addColumn('istateid', 'Istateid', 'INTEGER', false, null, null);
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
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), 'CASCADE', null, 'Beatss', false);
        $this->addRelation('OnBoardRequest', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':territory',
    1 => ':territory_id',
  ),
), null, null, 'OnBoardRequests', false);
        $this->addRelation('Orders', '\\entities\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, 'Orderss', false);
        $this->addRelation('PrescriberData', '\\entities\\PrescriberData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, 'PrescriberDatas', false);
        $this->addRelation('PrescriberTallySummary', '\\entities\\PrescriberTallySummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, 'PrescriberTallySummaries', false);
        $this->addRelation('TerritoryTowns', '\\entities\\TerritoryTowns', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, 'TerritoryTownss', false);
        $this->addRelation('StpWeek', '\\entities\\StpWeek', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, 'StpWeeks', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to territories     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BeatsTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TerritoriesTableMap::CLASS_DEFAULT : TerritoriesTableMap::OM_CLASS;
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
     * @return array (Territories object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TerritoriesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TerritoriesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TerritoriesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TerritoriesTableMap::OM_CLASS;
            /** @var Territories $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TerritoriesTableMap::addInstanceToPool($obj, $key);
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
            $key = TerritoriesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TerritoriesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Territories $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TerritoriesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TerritoriesTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_TERRITORY_CODE);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_ON_BOARDING_STATUS);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_START_DATE);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_END_DATE);
            $criteria->addSelectColumn(TerritoriesTableMap::COL_ISTATEID);
        } else {
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.territory_code');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.on_boarding_status');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
            $criteria->addSelectColumn($alias . '.istateid');
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
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_TERRITORY_CODE);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_ON_BOARDING_STATUS);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_START_DATE);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_END_DATE);
            $criteria->removeSelectColumn(TerritoriesTableMap::COL_ISTATEID);
        } else {
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.territory_code');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.on_boarding_status');
            $criteria->removeSelectColumn($alias . '.start_date');
            $criteria->removeSelectColumn($alias . '.end_date');
            $criteria->removeSelectColumn($alias . '.istateid');
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
        return Propel::getServiceContainer()->getDatabaseMap(TerritoriesTableMap::DATABASE_NAME)->getTable(TerritoriesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Territories or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Territories object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Territories) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TerritoriesTableMap::DATABASE_NAME);
            $criteria->add(TerritoriesTableMap::COL_TERRITORY_ID, (array) $values, Criteria::IN);
        }

        $query = TerritoriesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TerritoriesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TerritoriesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the territories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TerritoriesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Territories or Criteria object.
     *
     * @param mixed $criteria Criteria or Territories object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Territories object
        }

        if ($criteria->containsKey(TerritoriesTableMap::COL_TERRITORY_ID) && $criteria->keyContainsValue(TerritoriesTableMap::COL_TERRITORY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TerritoriesTableMap::COL_TERRITORY_ID.')');
        }


        // Set the correct dbName
        $query = TerritoriesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
