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
use entities\TerritoryTowns;
use entities\TerritoryTownsQuery;


/**
 * This class defines the structure of the 'territory_towns' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TerritoryTownsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TerritoryTownsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'territory_towns';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TerritoryTowns';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TerritoryTowns';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TerritoryTowns';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the territory_towns_id field
     */
    public const COL_TERRITORY_TOWNS_ID = 'territory_towns.territory_towns_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'territory_towns.territory_id';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'territory_towns.itownid';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'territory_towns.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'territory_towns.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'territory_towns.updated_at';

    /**
     * the column name for the nca field
     */
    public const COL_NCA = 'territory_towns.nca';

    /**
     * the column name for the assign_to_trip_type field
     */
    public const COL_ASSIGN_TO_TRIP_TYPE = 'territory_towns.assign_to_trip_type';

    /**
     * the column name for the others_trip_type field
     */
    public const COL_OTHERS_TRIP_TYPE = 'territory_towns.others_trip_type';

    /**
     * the column name for the trip_type field
     */
    public const COL_TRIP_TYPE = 'territory_towns.trip_type';

    /**
     * the column name for the only_nca field
     */
    public const COL_ONLY_NCA = 'territory_towns.only_nca';

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
        self::TYPE_PHPNAME       => ['TerritoryTownsId', 'TerritoryId', 'Itownid', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'Nca', 'AssignToTripType', 'OthersTripType', 'TripType', 'OnlyNca', ],
        self::TYPE_CAMELNAME     => ['territoryTownsId', 'territoryId', 'itownid', 'companyId', 'createdAt', 'updatedAt', 'nca', 'assignToTripType', 'othersTripType', 'tripType', 'onlyNca', ],
        self::TYPE_COLNAME       => [TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID, TerritoryTownsTableMap::COL_TERRITORY_ID, TerritoryTownsTableMap::COL_ITOWNID, TerritoryTownsTableMap::COL_COMPANY_ID, TerritoryTownsTableMap::COL_CREATED_AT, TerritoryTownsTableMap::COL_UPDATED_AT, TerritoryTownsTableMap::COL_NCA, TerritoryTownsTableMap::COL_ASSIGN_TO_TRIP_TYPE, TerritoryTownsTableMap::COL_OTHERS_TRIP_TYPE, TerritoryTownsTableMap::COL_TRIP_TYPE, TerritoryTownsTableMap::COL_ONLY_NCA, ],
        self::TYPE_FIELDNAME     => ['territory_towns_id', 'territory_id', 'itownid', 'company_id', 'created_at', 'updated_at', 'nca', 'assign_to_trip_type', 'others_trip_type', 'trip_type', 'only_nca', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['TerritoryTownsId' => 0, 'TerritoryId' => 1, 'Itownid' => 2, 'CompanyId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'Nca' => 6, 'AssignToTripType' => 7, 'OthersTripType' => 8, 'TripType' => 9, 'OnlyNca' => 10, ],
        self::TYPE_CAMELNAME     => ['territoryTownsId' => 0, 'territoryId' => 1, 'itownid' => 2, 'companyId' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'nca' => 6, 'assignToTripType' => 7, 'othersTripType' => 8, 'tripType' => 9, 'onlyNca' => 10, ],
        self::TYPE_COLNAME       => [TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID => 0, TerritoryTownsTableMap::COL_TERRITORY_ID => 1, TerritoryTownsTableMap::COL_ITOWNID => 2, TerritoryTownsTableMap::COL_COMPANY_ID => 3, TerritoryTownsTableMap::COL_CREATED_AT => 4, TerritoryTownsTableMap::COL_UPDATED_AT => 5, TerritoryTownsTableMap::COL_NCA => 6, TerritoryTownsTableMap::COL_ASSIGN_TO_TRIP_TYPE => 7, TerritoryTownsTableMap::COL_OTHERS_TRIP_TYPE => 8, TerritoryTownsTableMap::COL_TRIP_TYPE => 9, TerritoryTownsTableMap::COL_ONLY_NCA => 10, ],
        self::TYPE_FIELDNAME     => ['territory_towns_id' => 0, 'territory_id' => 1, 'itownid' => 2, 'company_id' => 3, 'created_at' => 4, 'updated_at' => 5, 'nca' => 6, 'assign_to_trip_type' => 7, 'others_trip_type' => 8, 'trip_type' => 9, 'only_nca' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TerritoryTownsId' => 'TERRITORY_TOWNS_ID',
        'TerritoryTowns.TerritoryTownsId' => 'TERRITORY_TOWNS_ID',
        'territoryTownsId' => 'TERRITORY_TOWNS_ID',
        'territoryTowns.territoryTownsId' => 'TERRITORY_TOWNS_ID',
        'TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID' => 'TERRITORY_TOWNS_ID',
        'COL_TERRITORY_TOWNS_ID' => 'TERRITORY_TOWNS_ID',
        'territory_towns_id' => 'TERRITORY_TOWNS_ID',
        'territory_towns.territory_towns_id' => 'TERRITORY_TOWNS_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'TerritoryTowns.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'territoryTowns.territoryId' => 'TERRITORY_ID',
        'TerritoryTownsTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'territory_towns.territory_id' => 'TERRITORY_ID',
        'Itownid' => 'ITOWNID',
        'TerritoryTowns.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'territoryTowns.itownid' => 'ITOWNID',
        'TerritoryTownsTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'territory_towns.itownid' => 'ITOWNID',
        'CompanyId' => 'COMPANY_ID',
        'TerritoryTowns.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'territoryTowns.companyId' => 'COMPANY_ID',
        'TerritoryTownsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'territory_towns.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'TerritoryTowns.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'territoryTowns.createdAt' => 'CREATED_AT',
        'TerritoryTownsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'territory_towns.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'TerritoryTowns.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'territoryTowns.updatedAt' => 'UPDATED_AT',
        'TerritoryTownsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'territory_towns.updated_at' => 'UPDATED_AT',
        'Nca' => 'NCA',
        'TerritoryTowns.Nca' => 'NCA',
        'nca' => 'NCA',
        'territoryTowns.nca' => 'NCA',
        'TerritoryTownsTableMap::COL_NCA' => 'NCA',
        'COL_NCA' => 'NCA',
        'territory_towns.nca' => 'NCA',
        'AssignToTripType' => 'ASSIGN_TO_TRIP_TYPE',
        'TerritoryTowns.AssignToTripType' => 'ASSIGN_TO_TRIP_TYPE',
        'assignToTripType' => 'ASSIGN_TO_TRIP_TYPE',
        'territoryTowns.assignToTripType' => 'ASSIGN_TO_TRIP_TYPE',
        'TerritoryTownsTableMap::COL_ASSIGN_TO_TRIP_TYPE' => 'ASSIGN_TO_TRIP_TYPE',
        'COL_ASSIGN_TO_TRIP_TYPE' => 'ASSIGN_TO_TRIP_TYPE',
        'assign_to_trip_type' => 'ASSIGN_TO_TRIP_TYPE',
        'territory_towns.assign_to_trip_type' => 'ASSIGN_TO_TRIP_TYPE',
        'OthersTripType' => 'OTHERS_TRIP_TYPE',
        'TerritoryTowns.OthersTripType' => 'OTHERS_TRIP_TYPE',
        'othersTripType' => 'OTHERS_TRIP_TYPE',
        'territoryTowns.othersTripType' => 'OTHERS_TRIP_TYPE',
        'TerritoryTownsTableMap::COL_OTHERS_TRIP_TYPE' => 'OTHERS_TRIP_TYPE',
        'COL_OTHERS_TRIP_TYPE' => 'OTHERS_TRIP_TYPE',
        'others_trip_type' => 'OTHERS_TRIP_TYPE',
        'territory_towns.others_trip_type' => 'OTHERS_TRIP_TYPE',
        'TripType' => 'TRIP_TYPE',
        'TerritoryTowns.TripType' => 'TRIP_TYPE',
        'tripType' => 'TRIP_TYPE',
        'territoryTowns.tripType' => 'TRIP_TYPE',
        'TerritoryTownsTableMap::COL_TRIP_TYPE' => 'TRIP_TYPE',
        'COL_TRIP_TYPE' => 'TRIP_TYPE',
        'trip_type' => 'TRIP_TYPE',
        'territory_towns.trip_type' => 'TRIP_TYPE',
        'OnlyNca' => 'ONLY_NCA',
        'TerritoryTowns.OnlyNca' => 'ONLY_NCA',
        'onlyNca' => 'ONLY_NCA',
        'territoryTowns.onlyNca' => 'ONLY_NCA',
        'TerritoryTownsTableMap::COL_ONLY_NCA' => 'ONLY_NCA',
        'COL_ONLY_NCA' => 'ONLY_NCA',
        'only_nca' => 'ONLY_NCA',
        'territory_towns.only_nca' => 'ONLY_NCA',
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
        $this->setName('territory_towns');
        $this->setPhpName('TerritoryTowns');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TerritoryTowns');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('territory_towns_territory_towns_id_seq');
        // columns
        $this->addPrimaryKey('territory_towns_id', 'TerritoryTownsId', 'INTEGER', true, null, null);
        $this->addForeignKey('territory_id', 'TerritoryId', 'INTEGER', 'territories', 'territory_id', true, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'INTEGER', 'geo_towns', 'itownid', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('nca', 'Nca', 'BOOLEAN', true, 1, false);
        $this->addColumn('assign_to_trip_type', 'AssignToTripType', 'VARCHAR', false, 250, null);
        $this->addColumn('others_trip_type', 'OthersTripType', 'VARCHAR', false, null, null);
        $this->addColumn('trip_type', 'TripType', 'VARCHAR', false, null, null);
        $this->addColumn('only_nca', 'OnlyNca', 'BOOLEAN', true, 1, false);
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
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryTownsId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryTownsId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryTownsId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryTownsId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryTownsId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TerritoryTownsId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('TerritoryTownsId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TerritoryTownsTableMap::CLASS_DEFAULT : TerritoryTownsTableMap::OM_CLASS;
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
     * @return array (TerritoryTowns object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TerritoryTownsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TerritoryTownsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TerritoryTownsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TerritoryTownsTableMap::OM_CLASS;
            /** @var TerritoryTowns $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TerritoryTownsTableMap::addInstanceToPool($obj, $key);
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
            $key = TerritoryTownsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TerritoryTownsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TerritoryTowns $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TerritoryTownsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_NCA);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_ASSIGN_TO_TRIP_TYPE);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_OTHERS_TRIP_TYPE);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_TRIP_TYPE);
            $criteria->addSelectColumn(TerritoryTownsTableMap::COL_ONLY_NCA);
        } else {
            $criteria->addSelectColumn($alias . '.territory_towns_id');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.nca');
            $criteria->addSelectColumn($alias . '.assign_to_trip_type');
            $criteria->addSelectColumn($alias . '.others_trip_type');
            $criteria->addSelectColumn($alias . '.trip_type');
            $criteria->addSelectColumn($alias . '.only_nca');
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
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_NCA);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_ASSIGN_TO_TRIP_TYPE);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_OTHERS_TRIP_TYPE);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_TRIP_TYPE);
            $criteria->removeSelectColumn(TerritoryTownsTableMap::COL_ONLY_NCA);
        } else {
            $criteria->removeSelectColumn($alias . '.territory_towns_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.nca');
            $criteria->removeSelectColumn($alias . '.assign_to_trip_type');
            $criteria->removeSelectColumn($alias . '.others_trip_type');
            $criteria->removeSelectColumn($alias . '.trip_type');
            $criteria->removeSelectColumn($alias . '.only_nca');
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
        return Propel::getServiceContainer()->getDatabaseMap(TerritoryTownsTableMap::DATABASE_NAME)->getTable(TerritoryTownsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TerritoryTowns or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TerritoryTowns object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoryTownsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TerritoryTowns) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TerritoryTownsTableMap::DATABASE_NAME);
            $criteria->add(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID, (array) $values, Criteria::IN);
        }

        $query = TerritoryTownsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TerritoryTownsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TerritoryTownsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the territory_towns table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TerritoryTownsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TerritoryTowns or Criteria object.
     *
     * @param mixed $criteria Criteria or TerritoryTowns object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoryTownsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TerritoryTowns object
        }

        if ($criteria->containsKey(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID) && $criteria->keyContainsValue(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID.')');
        }


        // Set the correct dbName
        $query = TerritoryTownsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
