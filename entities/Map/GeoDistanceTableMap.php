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
use entities\GeoDistance;
use entities\GeoDistanceQuery;


/**
 * This class defines the structure of the 'geo_distance' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GeoDistanceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GeoDistanceTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'geo_distance';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GeoDistance';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GeoDistance';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GeoDistance';

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
     * the column name for the geo_distance_id field
     */
    public const COL_GEO_DISTANCE_ID = 'geo_distance.geo_distance_id';

    /**
     * the column name for the from_town_id field
     */
    public const COL_FROM_TOWN_ID = 'geo_distance.from_town_id';

    /**
     * the column name for the to_town_id field
     */
    public const COL_TO_TOWN_ID = 'geo_distance.to_town_id';

    /**
     * the column name for the distance_km field
     */
    public const COL_DISTANCE_KM = 'geo_distance.distance_km';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'geo_distance.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'geo_distance.updated_at';

    /**
     * the column name for the belt_name field
     */
    public const COL_BELT_NAME = 'geo_distance.belt_name';

    /**
     * the column name for the from_state_id field
     */
    public const COL_FROM_STATE_ID = 'geo_distance.from_state_id';

    /**
     * the column name for the calculation_type field
     */
    public const COL_CALCULATION_TYPE = 'geo_distance.calculation_type';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'geo_distance.amount';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'geo_distance.remark';

    /**
     * the column name for the to_state_id field
     */
    public const COL_TO_STATE_ID = 'geo_distance.to_state_id';

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
        self::TYPE_PHPNAME       => ['GeoDistanceId', 'FromTownId', 'ToTownId', 'DistanceKm', 'CreatedAt', 'UpdatedAt', 'BeltName', 'FromStateId', 'CalculationType', 'Amount', 'Remark', 'ToStateId', ],
        self::TYPE_CAMELNAME     => ['geoDistanceId', 'fromTownId', 'toTownId', 'distanceKm', 'createdAt', 'updatedAt', 'beltName', 'fromStateId', 'calculationType', 'amount', 'remark', 'toStateId', ],
        self::TYPE_COLNAME       => [GeoDistanceTableMap::COL_GEO_DISTANCE_ID, GeoDistanceTableMap::COL_FROM_TOWN_ID, GeoDistanceTableMap::COL_TO_TOWN_ID, GeoDistanceTableMap::COL_DISTANCE_KM, GeoDistanceTableMap::COL_CREATED_AT, GeoDistanceTableMap::COL_UPDATED_AT, GeoDistanceTableMap::COL_BELT_NAME, GeoDistanceTableMap::COL_FROM_STATE_ID, GeoDistanceTableMap::COL_CALCULATION_TYPE, GeoDistanceTableMap::COL_AMOUNT, GeoDistanceTableMap::COL_REMARK, GeoDistanceTableMap::COL_TO_STATE_ID, ],
        self::TYPE_FIELDNAME     => ['geo_distance_id', 'from_town_id', 'to_town_id', 'distance_km', 'created_at', 'updated_at', 'belt_name', 'from_state_id', 'calculation_type', 'amount', 'remark', 'to_state_id', ],
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
        self::TYPE_PHPNAME       => ['GeoDistanceId' => 0, 'FromTownId' => 1, 'ToTownId' => 2, 'DistanceKm' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'BeltName' => 6, 'FromStateId' => 7, 'CalculationType' => 8, 'Amount' => 9, 'Remark' => 10, 'ToStateId' => 11, ],
        self::TYPE_CAMELNAME     => ['geoDistanceId' => 0, 'fromTownId' => 1, 'toTownId' => 2, 'distanceKm' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'beltName' => 6, 'fromStateId' => 7, 'calculationType' => 8, 'amount' => 9, 'remark' => 10, 'toStateId' => 11, ],
        self::TYPE_COLNAME       => [GeoDistanceTableMap::COL_GEO_DISTANCE_ID => 0, GeoDistanceTableMap::COL_FROM_TOWN_ID => 1, GeoDistanceTableMap::COL_TO_TOWN_ID => 2, GeoDistanceTableMap::COL_DISTANCE_KM => 3, GeoDistanceTableMap::COL_CREATED_AT => 4, GeoDistanceTableMap::COL_UPDATED_AT => 5, GeoDistanceTableMap::COL_BELT_NAME => 6, GeoDistanceTableMap::COL_FROM_STATE_ID => 7, GeoDistanceTableMap::COL_CALCULATION_TYPE => 8, GeoDistanceTableMap::COL_AMOUNT => 9, GeoDistanceTableMap::COL_REMARK => 10, GeoDistanceTableMap::COL_TO_STATE_ID => 11, ],
        self::TYPE_FIELDNAME     => ['geo_distance_id' => 0, 'from_town_id' => 1, 'to_town_id' => 2, 'distance_km' => 3, 'created_at' => 4, 'updated_at' => 5, 'belt_name' => 6, 'from_state_id' => 7, 'calculation_type' => 8, 'amount' => 9, 'remark' => 10, 'to_state_id' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'GeoDistanceId' => 'GEO_DISTANCE_ID',
        'GeoDistance.GeoDistanceId' => 'GEO_DISTANCE_ID',
        'geoDistanceId' => 'GEO_DISTANCE_ID',
        'geoDistance.geoDistanceId' => 'GEO_DISTANCE_ID',
        'GeoDistanceTableMap::COL_GEO_DISTANCE_ID' => 'GEO_DISTANCE_ID',
        'COL_GEO_DISTANCE_ID' => 'GEO_DISTANCE_ID',
        'geo_distance_id' => 'GEO_DISTANCE_ID',
        'geo_distance.geo_distance_id' => 'GEO_DISTANCE_ID',
        'FromTownId' => 'FROM_TOWN_ID',
        'GeoDistance.FromTownId' => 'FROM_TOWN_ID',
        'fromTownId' => 'FROM_TOWN_ID',
        'geoDistance.fromTownId' => 'FROM_TOWN_ID',
        'GeoDistanceTableMap::COL_FROM_TOWN_ID' => 'FROM_TOWN_ID',
        'COL_FROM_TOWN_ID' => 'FROM_TOWN_ID',
        'from_town_id' => 'FROM_TOWN_ID',
        'geo_distance.from_town_id' => 'FROM_TOWN_ID',
        'ToTownId' => 'TO_TOWN_ID',
        'GeoDistance.ToTownId' => 'TO_TOWN_ID',
        'toTownId' => 'TO_TOWN_ID',
        'geoDistance.toTownId' => 'TO_TOWN_ID',
        'GeoDistanceTableMap::COL_TO_TOWN_ID' => 'TO_TOWN_ID',
        'COL_TO_TOWN_ID' => 'TO_TOWN_ID',
        'to_town_id' => 'TO_TOWN_ID',
        'geo_distance.to_town_id' => 'TO_TOWN_ID',
        'DistanceKm' => 'DISTANCE_KM',
        'GeoDistance.DistanceKm' => 'DISTANCE_KM',
        'distanceKm' => 'DISTANCE_KM',
        'geoDistance.distanceKm' => 'DISTANCE_KM',
        'GeoDistanceTableMap::COL_DISTANCE_KM' => 'DISTANCE_KM',
        'COL_DISTANCE_KM' => 'DISTANCE_KM',
        'distance_km' => 'DISTANCE_KM',
        'geo_distance.distance_km' => 'DISTANCE_KM',
        'CreatedAt' => 'CREATED_AT',
        'GeoDistance.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'geoDistance.createdAt' => 'CREATED_AT',
        'GeoDistanceTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'geo_distance.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'GeoDistance.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'geoDistance.updatedAt' => 'UPDATED_AT',
        'GeoDistanceTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'geo_distance.updated_at' => 'UPDATED_AT',
        'BeltName' => 'BELT_NAME',
        'GeoDistance.BeltName' => 'BELT_NAME',
        'beltName' => 'BELT_NAME',
        'geoDistance.beltName' => 'BELT_NAME',
        'GeoDistanceTableMap::COL_BELT_NAME' => 'BELT_NAME',
        'COL_BELT_NAME' => 'BELT_NAME',
        'belt_name' => 'BELT_NAME',
        'geo_distance.belt_name' => 'BELT_NAME',
        'FromStateId' => 'FROM_STATE_ID',
        'GeoDistance.FromStateId' => 'FROM_STATE_ID',
        'fromStateId' => 'FROM_STATE_ID',
        'geoDistance.fromStateId' => 'FROM_STATE_ID',
        'GeoDistanceTableMap::COL_FROM_STATE_ID' => 'FROM_STATE_ID',
        'COL_FROM_STATE_ID' => 'FROM_STATE_ID',
        'from_state_id' => 'FROM_STATE_ID',
        'geo_distance.from_state_id' => 'FROM_STATE_ID',
        'CalculationType' => 'CALCULATION_TYPE',
        'GeoDistance.CalculationType' => 'CALCULATION_TYPE',
        'calculationType' => 'CALCULATION_TYPE',
        'geoDistance.calculationType' => 'CALCULATION_TYPE',
        'GeoDistanceTableMap::COL_CALCULATION_TYPE' => 'CALCULATION_TYPE',
        'COL_CALCULATION_TYPE' => 'CALCULATION_TYPE',
        'calculation_type' => 'CALCULATION_TYPE',
        'geo_distance.calculation_type' => 'CALCULATION_TYPE',
        'Amount' => 'AMOUNT',
        'GeoDistance.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'geoDistance.amount' => 'AMOUNT',
        'GeoDistanceTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'geo_distance.amount' => 'AMOUNT',
        'Remark' => 'REMARK',
        'GeoDistance.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'geoDistance.remark' => 'REMARK',
        'GeoDistanceTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'geo_distance.remark' => 'REMARK',
        'ToStateId' => 'TO_STATE_ID',
        'GeoDistance.ToStateId' => 'TO_STATE_ID',
        'toStateId' => 'TO_STATE_ID',
        'geoDistance.toStateId' => 'TO_STATE_ID',
        'GeoDistanceTableMap::COL_TO_STATE_ID' => 'TO_STATE_ID',
        'COL_TO_STATE_ID' => 'TO_STATE_ID',
        'to_state_id' => 'TO_STATE_ID',
        'geo_distance.to_state_id' => 'TO_STATE_ID',
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
        $this->setName('geo_distance');
        $this->setPhpName('GeoDistance');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GeoDistance');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('geo_distance_geo_distance_id_seq');
        // columns
        $this->addPrimaryKey('geo_distance_id', 'GeoDistanceId', 'INTEGER', true, null, null);
        $this->addForeignKey('from_town_id', 'FromTownId', 'INTEGER', 'geo_towns', 'itownid', true, null, null);
        $this->addForeignKey('to_town_id', 'ToTownId', 'INTEGER', 'geo_towns', 'itownid', true, null, null);
        $this->addColumn('distance_km', 'DistanceKm', 'DECIMAL', true, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('belt_name', 'BeltName', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('from_state_id', 'FromStateId', 'INTEGER', 'geo_state', 'istateid', false, null, null);
        $this->addColumn('calculation_type', 'CalculationType', 'VARCHAR', false, null, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', false, null, 0.00);
        $this->addColumn('remark', 'Remark', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('to_state_id', 'ToStateId', 'INTEGER', 'geo_state', 'istateid', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GeoTownsRelatedByFromTownId', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':from_town_id',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('GeoTownsRelatedByToTownId', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':to_town_id',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('GeoStateRelatedByFromStateId', '\\entities\\GeoState', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':from_state_id',
    1 => ':istateid',
  ),
), null, null, null, false);
        $this->addRelation('GeoStateRelatedByToStateId', '\\entities\\GeoState', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':to_state_id',
    1 => ':istateid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoDistanceId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoDistanceId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoDistanceId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoDistanceId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoDistanceId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoDistanceId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('GeoDistanceId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GeoDistanceTableMap::CLASS_DEFAULT : GeoDistanceTableMap::OM_CLASS;
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
     * @return array (GeoDistance object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GeoDistanceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GeoDistanceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GeoDistanceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GeoDistanceTableMap::OM_CLASS;
            /** @var GeoDistance $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GeoDistanceTableMap::addInstanceToPool($obj, $key);
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
            $key = GeoDistanceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GeoDistanceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GeoDistance $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GeoDistanceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_GEO_DISTANCE_ID);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_FROM_TOWN_ID);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_TO_TOWN_ID);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_DISTANCE_KM);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_BELT_NAME);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_FROM_STATE_ID);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_CALCULATION_TYPE);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_REMARK);
            $criteria->addSelectColumn(GeoDistanceTableMap::COL_TO_STATE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.geo_distance_id');
            $criteria->addSelectColumn($alias . '.from_town_id');
            $criteria->addSelectColumn($alias . '.to_town_id');
            $criteria->addSelectColumn($alias . '.distance_km');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.belt_name');
            $criteria->addSelectColumn($alias . '.from_state_id');
            $criteria->addSelectColumn($alias . '.calculation_type');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.remark');
            $criteria->addSelectColumn($alias . '.to_state_id');
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
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_GEO_DISTANCE_ID);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_FROM_TOWN_ID);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_TO_TOWN_ID);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_DISTANCE_KM);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_BELT_NAME);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_FROM_STATE_ID);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_CALCULATION_TYPE);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_REMARK);
            $criteria->removeSelectColumn(GeoDistanceTableMap::COL_TO_STATE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.geo_distance_id');
            $criteria->removeSelectColumn($alias . '.from_town_id');
            $criteria->removeSelectColumn($alias . '.to_town_id');
            $criteria->removeSelectColumn($alias . '.distance_km');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.belt_name');
            $criteria->removeSelectColumn($alias . '.from_state_id');
            $criteria->removeSelectColumn($alias . '.calculation_type');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.remark');
            $criteria->removeSelectColumn($alias . '.to_state_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(GeoDistanceTableMap::DATABASE_NAME)->getTable(GeoDistanceTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GeoDistance or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GeoDistance object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoDistanceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GeoDistance) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GeoDistanceTableMap::DATABASE_NAME);
            $criteria->add(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, (array) $values, Criteria::IN);
        }

        $query = GeoDistanceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GeoDistanceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GeoDistanceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the geo_distance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GeoDistanceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GeoDistance or Criteria object.
     *
     * @param mixed $criteria Criteria or GeoDistance object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoDistanceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GeoDistance object
        }

        if ($criteria->containsKey(GeoDistanceTableMap::COL_GEO_DISTANCE_ID) && $criteria->keyContainsValue(GeoDistanceTableMap::COL_GEO_DISTANCE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GeoDistanceTableMap::COL_GEO_DISTANCE_ID.')');
        }


        // Set the correct dbName
        $query = GeoDistanceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
