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
use entities\CheckInMedia;
use entities\CheckInMediaQuery;


/**
 * This class defines the structure of the 'check_in_media' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CheckInMediaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CheckInMediaTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'check_in_media';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'CheckInMedia';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\CheckInMedia';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.CheckInMedia';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'check_in_media.id';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'check_in_media.media_id';

    /**
     * the column name for the entity_pk field
     */
    public const COL_ENTITY_PK = 'check_in_media.entity_pk';

    /**
     * the column name for the entity_name field
     */
    public const COL_ENTITY_NAME = 'check_in_media.entity_name';

    /**
     * the column name for the purpose field
     */
    public const COL_PURPOSE = 'check_in_media.purpose';

    /**
     * the column name for the gps_location field
     */
    public const COL_GPS_LOCATION = 'check_in_media.gps_location';

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
        self::TYPE_PHPNAME       => ['Id', 'MediaId', 'EntityPk', 'EntityName', 'Purpose', 'GpsLocation', ],
        self::TYPE_CAMELNAME     => ['id', 'mediaId', 'entityPk', 'entityName', 'purpose', 'gpsLocation', ],
        self::TYPE_COLNAME       => [CheckInMediaTableMap::COL_ID, CheckInMediaTableMap::COL_MEDIA_ID, CheckInMediaTableMap::COL_ENTITY_PK, CheckInMediaTableMap::COL_ENTITY_NAME, CheckInMediaTableMap::COL_PURPOSE, CheckInMediaTableMap::COL_GPS_LOCATION, ],
        self::TYPE_FIELDNAME     => ['id', 'media_id', 'entity_pk', 'entity_name', 'purpose', 'gps_location', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'MediaId' => 1, 'EntityPk' => 2, 'EntityName' => 3, 'Purpose' => 4, 'GpsLocation' => 5, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'mediaId' => 1, 'entityPk' => 2, 'entityName' => 3, 'purpose' => 4, 'gpsLocation' => 5, ],
        self::TYPE_COLNAME       => [CheckInMediaTableMap::COL_ID => 0, CheckInMediaTableMap::COL_MEDIA_ID => 1, CheckInMediaTableMap::COL_ENTITY_PK => 2, CheckInMediaTableMap::COL_ENTITY_NAME => 3, CheckInMediaTableMap::COL_PURPOSE => 4, CheckInMediaTableMap::COL_GPS_LOCATION => 5, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'media_id' => 1, 'entity_pk' => 2, 'entity_name' => 3, 'purpose' => 4, 'gps_location' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'CheckInMedia.Id' => 'ID',
        'id' => 'ID',
        'checkInMedia.id' => 'ID',
        'CheckInMediaTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'check_in_media.id' => 'ID',
        'MediaId' => 'MEDIA_ID',
        'CheckInMedia.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'checkInMedia.mediaId' => 'MEDIA_ID',
        'CheckInMediaTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'check_in_media.media_id' => 'MEDIA_ID',
        'EntityPk' => 'ENTITY_PK',
        'CheckInMedia.EntityPk' => 'ENTITY_PK',
        'entityPk' => 'ENTITY_PK',
        'checkInMedia.entityPk' => 'ENTITY_PK',
        'CheckInMediaTableMap::COL_ENTITY_PK' => 'ENTITY_PK',
        'COL_ENTITY_PK' => 'ENTITY_PK',
        'entity_pk' => 'ENTITY_PK',
        'check_in_media.entity_pk' => 'ENTITY_PK',
        'EntityName' => 'ENTITY_NAME',
        'CheckInMedia.EntityName' => 'ENTITY_NAME',
        'entityName' => 'ENTITY_NAME',
        'checkInMedia.entityName' => 'ENTITY_NAME',
        'CheckInMediaTableMap::COL_ENTITY_NAME' => 'ENTITY_NAME',
        'COL_ENTITY_NAME' => 'ENTITY_NAME',
        'entity_name' => 'ENTITY_NAME',
        'check_in_media.entity_name' => 'ENTITY_NAME',
        'Purpose' => 'PURPOSE',
        'CheckInMedia.Purpose' => 'PURPOSE',
        'purpose' => 'PURPOSE',
        'checkInMedia.purpose' => 'PURPOSE',
        'CheckInMediaTableMap::COL_PURPOSE' => 'PURPOSE',
        'COL_PURPOSE' => 'PURPOSE',
        'check_in_media.purpose' => 'PURPOSE',
        'GpsLocation' => 'GPS_LOCATION',
        'CheckInMedia.GpsLocation' => 'GPS_LOCATION',
        'gpsLocation' => 'GPS_LOCATION',
        'checkInMedia.gpsLocation' => 'GPS_LOCATION',
        'CheckInMediaTableMap::COL_GPS_LOCATION' => 'GPS_LOCATION',
        'COL_GPS_LOCATION' => 'GPS_LOCATION',
        'gps_location' => 'GPS_LOCATION',
        'check_in_media.gps_location' => 'GPS_LOCATION',
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
        $this->setName('check_in_media');
        $this->setPhpName('CheckInMedia');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\CheckInMedia');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('check_in_media_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('media_id', 'MediaId', 'INTEGER', 'media_files', 'media_id', true, null, null);
        $this->addColumn('entity_pk', 'EntityPk', 'INTEGER', false, null, null);
        $this->addColumn('entity_name', 'EntityName', 'VARCHAR', false, 255, null);
        $this->addColumn('purpose', 'Purpose', 'VARCHAR', false, 255, null);
        $this->addColumn('gps_location', 'GpsLocation', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('MediaFiles', '\\entities\\MediaFiles', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':media_id',
    1 => ':media_id',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CheckInMediaTableMap::CLASS_DEFAULT : CheckInMediaTableMap::OM_CLASS;
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
     * @return array (CheckInMedia object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CheckInMediaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CheckInMediaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CheckInMediaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CheckInMediaTableMap::OM_CLASS;
            /** @var CheckInMedia $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CheckInMediaTableMap::addInstanceToPool($obj, $key);
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
            $key = CheckInMediaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CheckInMediaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CheckInMedia $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CheckInMediaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CheckInMediaTableMap::COL_ID);
            $criteria->addSelectColumn(CheckInMediaTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(CheckInMediaTableMap::COL_ENTITY_PK);
            $criteria->addSelectColumn(CheckInMediaTableMap::COL_ENTITY_NAME);
            $criteria->addSelectColumn(CheckInMediaTableMap::COL_PURPOSE);
            $criteria->addSelectColumn(CheckInMediaTableMap::COL_GPS_LOCATION);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.entity_pk');
            $criteria->addSelectColumn($alias . '.entity_name');
            $criteria->addSelectColumn($alias . '.purpose');
            $criteria->addSelectColumn($alias . '.gps_location');
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
            $criteria->removeSelectColumn(CheckInMediaTableMap::COL_ID);
            $criteria->removeSelectColumn(CheckInMediaTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(CheckInMediaTableMap::COL_ENTITY_PK);
            $criteria->removeSelectColumn(CheckInMediaTableMap::COL_ENTITY_NAME);
            $criteria->removeSelectColumn(CheckInMediaTableMap::COL_PURPOSE);
            $criteria->removeSelectColumn(CheckInMediaTableMap::COL_GPS_LOCATION);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.entity_pk');
            $criteria->removeSelectColumn($alias . '.entity_name');
            $criteria->removeSelectColumn($alias . '.purpose');
            $criteria->removeSelectColumn($alias . '.gps_location');
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
        return Propel::getServiceContainer()->getDatabaseMap(CheckInMediaTableMap::DATABASE_NAME)->getTable(CheckInMediaTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a CheckInMedia or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or CheckInMedia object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CheckInMediaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\CheckInMedia) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CheckInMediaTableMap::DATABASE_NAME);
            $criteria->add(CheckInMediaTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CheckInMediaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CheckInMediaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CheckInMediaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the check_in_media table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CheckInMediaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CheckInMedia or Criteria object.
     *
     * @param mixed $criteria Criteria or CheckInMedia object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CheckInMediaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CheckInMedia object
        }

        if ($criteria->containsKey(CheckInMediaTableMap::COL_ID) && $criteria->keyContainsValue(CheckInMediaTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CheckInMediaTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CheckInMediaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
