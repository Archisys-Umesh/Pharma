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
use entities\GeoTowns;
use entities\GeoTownsQuery;


/**
 * This class defines the structure of the 'geo_towns' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GeoTownsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GeoTownsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'geo_towns';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GeoTowns';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GeoTowns';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GeoTowns';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'geo_towns.itownid';

    /**
     * the column name for the stownname field
     */
    public const COL_STOWNNAME = 'geo_towns.stownname';

    /**
     * the column name for the icityid field
     */
    public const COL_ICITYID = 'geo_towns.icityid';

    /**
     * the column name for the stowncode field
     */
    public const COL_STOWNCODE = 'geo_towns.stowncode';

    /**
     * the column name for the dcreateddate field
     */
    public const COL_DCREATEDDATE = 'geo_towns.dcreateddate';

    /**
     * the column name for the dmodifydate field
     */
    public const COL_DMODIFYDATE = 'geo_towns.dmodifydate';

    /**
     * the column name for the sstatus field
     */
    public const COL_SSTATUS = 'geo_towns.sstatus';

    /**
     * the column name for the pincode field
     */
    public const COL_PINCODE = 'geo_towns.pincode';

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
        self::TYPE_PHPNAME       => ['Itownid', 'Stownname', 'Icityid', 'Stowncode', 'Dcreateddate', 'Dmodifydate', 'Sstatus', 'Pincode', ],
        self::TYPE_CAMELNAME     => ['itownid', 'stownname', 'icityid', 'stowncode', 'dcreateddate', 'dmodifydate', 'sstatus', 'pincode', ],
        self::TYPE_COLNAME       => [GeoTownsTableMap::COL_ITOWNID, GeoTownsTableMap::COL_STOWNNAME, GeoTownsTableMap::COL_ICITYID, GeoTownsTableMap::COL_STOWNCODE, GeoTownsTableMap::COL_DCREATEDDATE, GeoTownsTableMap::COL_DMODIFYDATE, GeoTownsTableMap::COL_SSTATUS, GeoTownsTableMap::COL_PINCODE, ],
        self::TYPE_FIELDNAME     => ['itownid', 'stownname', 'icityid', 'stowncode', 'dcreateddate', 'dmodifydate', 'sstatus', 'pincode', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['Itownid' => 0, 'Stownname' => 1, 'Icityid' => 2, 'Stowncode' => 3, 'Dcreateddate' => 4, 'Dmodifydate' => 5, 'Sstatus' => 6, 'Pincode' => 7, ],
        self::TYPE_CAMELNAME     => ['itownid' => 0, 'stownname' => 1, 'icityid' => 2, 'stowncode' => 3, 'dcreateddate' => 4, 'dmodifydate' => 5, 'sstatus' => 6, 'pincode' => 7, ],
        self::TYPE_COLNAME       => [GeoTownsTableMap::COL_ITOWNID => 0, GeoTownsTableMap::COL_STOWNNAME => 1, GeoTownsTableMap::COL_ICITYID => 2, GeoTownsTableMap::COL_STOWNCODE => 3, GeoTownsTableMap::COL_DCREATEDDATE => 4, GeoTownsTableMap::COL_DMODIFYDATE => 5, GeoTownsTableMap::COL_SSTATUS => 6, GeoTownsTableMap::COL_PINCODE => 7, ],
        self::TYPE_FIELDNAME     => ['itownid' => 0, 'stownname' => 1, 'icityid' => 2, 'stowncode' => 3, 'dcreateddate' => 4, 'dmodifydate' => 5, 'sstatus' => 6, 'pincode' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Itownid' => 'ITOWNID',
        'GeoTowns.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'geoTowns.itownid' => 'ITOWNID',
        'GeoTownsTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'geo_towns.itownid' => 'ITOWNID',
        'Stownname' => 'STOWNNAME',
        'GeoTowns.Stownname' => 'STOWNNAME',
        'stownname' => 'STOWNNAME',
        'geoTowns.stownname' => 'STOWNNAME',
        'GeoTownsTableMap::COL_STOWNNAME' => 'STOWNNAME',
        'COL_STOWNNAME' => 'STOWNNAME',
        'geo_towns.stownname' => 'STOWNNAME',
        'Icityid' => 'ICITYID',
        'GeoTowns.Icityid' => 'ICITYID',
        'icityid' => 'ICITYID',
        'geoTowns.icityid' => 'ICITYID',
        'GeoTownsTableMap::COL_ICITYID' => 'ICITYID',
        'COL_ICITYID' => 'ICITYID',
        'geo_towns.icityid' => 'ICITYID',
        'Stowncode' => 'STOWNCODE',
        'GeoTowns.Stowncode' => 'STOWNCODE',
        'stowncode' => 'STOWNCODE',
        'geoTowns.stowncode' => 'STOWNCODE',
        'GeoTownsTableMap::COL_STOWNCODE' => 'STOWNCODE',
        'COL_STOWNCODE' => 'STOWNCODE',
        'geo_towns.stowncode' => 'STOWNCODE',
        'Dcreateddate' => 'DCREATEDDATE',
        'GeoTowns.Dcreateddate' => 'DCREATEDDATE',
        'dcreateddate' => 'DCREATEDDATE',
        'geoTowns.dcreateddate' => 'DCREATEDDATE',
        'GeoTownsTableMap::COL_DCREATEDDATE' => 'DCREATEDDATE',
        'COL_DCREATEDDATE' => 'DCREATEDDATE',
        'geo_towns.dcreateddate' => 'DCREATEDDATE',
        'Dmodifydate' => 'DMODIFYDATE',
        'GeoTowns.Dmodifydate' => 'DMODIFYDATE',
        'dmodifydate' => 'DMODIFYDATE',
        'geoTowns.dmodifydate' => 'DMODIFYDATE',
        'GeoTownsTableMap::COL_DMODIFYDATE' => 'DMODIFYDATE',
        'COL_DMODIFYDATE' => 'DMODIFYDATE',
        'geo_towns.dmodifydate' => 'DMODIFYDATE',
        'Sstatus' => 'SSTATUS',
        'GeoTowns.Sstatus' => 'SSTATUS',
        'sstatus' => 'SSTATUS',
        'geoTowns.sstatus' => 'SSTATUS',
        'GeoTownsTableMap::COL_SSTATUS' => 'SSTATUS',
        'COL_SSTATUS' => 'SSTATUS',
        'geo_towns.sstatus' => 'SSTATUS',
        'Pincode' => 'PINCODE',
        'GeoTowns.Pincode' => 'PINCODE',
        'pincode' => 'PINCODE',
        'geoTowns.pincode' => 'PINCODE',
        'GeoTownsTableMap::COL_PINCODE' => 'PINCODE',
        'COL_PINCODE' => 'PINCODE',
        'geo_towns.pincode' => 'PINCODE',
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
        $this->setName('geo_towns');
        $this->setPhpName('GeoTowns');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GeoTowns');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('geo_towns_itownid_seq');
        // columns
        $this->addPrimaryKey('itownid', 'Itownid', 'BIGINT', true, null, null);
        $this->addColumn('stownname', 'Stownname', 'VARCHAR', false, null, null);
        $this->addForeignKey('icityid', 'Icityid', 'BIGINT', 'geo_city', 'icityid', false, null, null);
        $this->addColumn('stowncode', 'Stowncode', 'VARCHAR', false, null, null);
        $this->addColumn('dcreateddate', 'Dcreateddate', 'TIMESTAMP', false, null, null);
        $this->addColumn('dmodifydate', 'Dmodifydate', 'TIMESTAMP', false, null, null);
        $this->addColumn('sstatus', 'Sstatus', 'VARCHAR', false, 50, null);
        $this->addColumn('pincode', 'Pincode', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GeoCity', '\\entities\\GeoCity', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':icityid',
    1 => ':icityid',
  ),
), null, null, null, false);
        $this->addRelation('AttendanceRelatedByEndItownid', '\\entities\\Attendance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':end_itownid',
    1 => ':itownid',
  ),
), null, null, 'AttendancesRelatedByEndItownid', false);
        $this->addRelation('AttendanceRelatedByStartItownid', '\\entities\\Attendance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':start_itownid',
    1 => ':itownid',
  ),
), null, null, 'AttendancesRelatedByStartItownid', false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'Beatss', false);
        $this->addRelation('Citycategory', '\\entities\\Citycategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'Citycategories', false);
        $this->addRelation('Dailycalls', '\\entities\\Dailycalls', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'Dailycallss', false);
        $this->addRelation('Dayplan', '\\entities\\Dayplan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'Dayplans', false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'Employees', false);
        $this->addRelation('GeoDistanceRelatedByFromTownId', '\\entities\\GeoDistance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':from_town_id',
    1 => ':itownid',
  ),
), null, null, 'GeoDistancesRelatedByFromTownId', false);
        $this->addRelation('GeoDistanceRelatedByToTownId', '\\entities\\GeoDistance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':to_town_id',
    1 => ':itownid',
  ),
), null, null, 'GeoDistancesRelatedByToTownId', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('OutletAddress', '\\entities\\OutletAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'OutletAddresses', false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'OutletOrgDatas', false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'Outletss', false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'Positionss', false);
        $this->addRelation('SfcMasterRelatedByFromTownId', '\\entities\\SfcMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':from_town_id',
    1 => ':itownid',
  ),
), null, null, 'SfcMastersRelatedByFromTownId', false);
        $this->addRelation('SfcMasterRelatedByToTownId', '\\entities\\SfcMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':to_town_id',
    1 => ':itownid',
  ),
), null, null, 'SfcMastersRelatedByToTownId', false);
        $this->addRelation('TerritoryTowns', '\\entities\\TerritoryTowns', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'TerritoryTownss', false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, 'Tourplanss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GeoTownsTableMap::CLASS_DEFAULT : GeoTownsTableMap::OM_CLASS;
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
     * @return array (GeoTowns object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GeoTownsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GeoTownsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GeoTownsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GeoTownsTableMap::OM_CLASS;
            /** @var GeoTowns $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GeoTownsTableMap::addInstanceToPool($obj, $key);
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
            $key = GeoTownsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GeoTownsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GeoTowns $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GeoTownsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GeoTownsTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(GeoTownsTableMap::COL_STOWNNAME);
            $criteria->addSelectColumn(GeoTownsTableMap::COL_ICITYID);
            $criteria->addSelectColumn(GeoTownsTableMap::COL_STOWNCODE);
            $criteria->addSelectColumn(GeoTownsTableMap::COL_DCREATEDDATE);
            $criteria->addSelectColumn(GeoTownsTableMap::COL_DMODIFYDATE);
            $criteria->addSelectColumn(GeoTownsTableMap::COL_SSTATUS);
            $criteria->addSelectColumn(GeoTownsTableMap::COL_PINCODE);
        } else {
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.stownname');
            $criteria->addSelectColumn($alias . '.icityid');
            $criteria->addSelectColumn($alias . '.stowncode');
            $criteria->addSelectColumn($alias . '.dcreateddate');
            $criteria->addSelectColumn($alias . '.dmodifydate');
            $criteria->addSelectColumn($alias . '.sstatus');
            $criteria->addSelectColumn($alias . '.pincode');
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
            $criteria->removeSelectColumn(GeoTownsTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(GeoTownsTableMap::COL_STOWNNAME);
            $criteria->removeSelectColumn(GeoTownsTableMap::COL_ICITYID);
            $criteria->removeSelectColumn(GeoTownsTableMap::COL_STOWNCODE);
            $criteria->removeSelectColumn(GeoTownsTableMap::COL_DCREATEDDATE);
            $criteria->removeSelectColumn(GeoTownsTableMap::COL_DMODIFYDATE);
            $criteria->removeSelectColumn(GeoTownsTableMap::COL_SSTATUS);
            $criteria->removeSelectColumn(GeoTownsTableMap::COL_PINCODE);
        } else {
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.stownname');
            $criteria->removeSelectColumn($alias . '.icityid');
            $criteria->removeSelectColumn($alias . '.stowncode');
            $criteria->removeSelectColumn($alias . '.dcreateddate');
            $criteria->removeSelectColumn($alias . '.dmodifydate');
            $criteria->removeSelectColumn($alias . '.sstatus');
            $criteria->removeSelectColumn($alias . '.pincode');
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
        return Propel::getServiceContainer()->getDatabaseMap(GeoTownsTableMap::DATABASE_NAME)->getTable(GeoTownsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GeoTowns or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GeoTowns object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoTownsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GeoTowns) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GeoTownsTableMap::DATABASE_NAME);
            $criteria->add(GeoTownsTableMap::COL_ITOWNID, (array) $values, Criteria::IN);
        }

        $query = GeoTownsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GeoTownsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GeoTownsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the geo_towns table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GeoTownsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GeoTowns or Criteria object.
     *
     * @param mixed $criteria Criteria or GeoTowns object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoTownsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GeoTowns object
        }

        if ($criteria->containsKey(GeoTownsTableMap::COL_ITOWNID) && $criteria->keyContainsValue(GeoTownsTableMap::COL_ITOWNID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GeoTownsTableMap::COL_ITOWNID.')');
        }


        // Set the correct dbName
        $query = GeoTownsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
