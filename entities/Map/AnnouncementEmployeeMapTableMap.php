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
use entities\AnnouncementEmployeeMap;
use entities\AnnouncementEmployeeMapQuery;


/**
 * This class defines the structure of the 'announcement_employee_map' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AnnouncementEmployeeMapTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.AnnouncementEmployeeMapTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'announcement_employee_map';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'AnnouncementEmployeeMap';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\AnnouncementEmployeeMap';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.AnnouncementEmployeeMap';

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
     * the column name for the announcement_employee_map_id field
     */
    public const COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID = 'announcement_employee_map.announcement_employee_map_id';

    /**
     * the column name for the announcement_id field
     */
    public const COL_ANNOUNCEMENT_ID = 'announcement_employee_map.announcement_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'announcement_employee_map.employee_id';

    /**
     * the column name for the read_at field
     */
    public const COL_READ_AT = 'announcement_employee_map.read_at';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'announcement_employee_map.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'announcement_employee_map.updated_at';

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
        self::TYPE_PHPNAME       => ['AnnouncementEmployeeMapId', 'AnnouncementId', 'EmployeeId', 'ReadAt', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['announcementEmployeeMapId', 'announcementId', 'employeeId', 'readAt', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID, AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID, AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID, AnnouncementEmployeeMapTableMap::COL_READ_AT, AnnouncementEmployeeMapTableMap::COL_CREATED_AT, AnnouncementEmployeeMapTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['announcement_employee_map_id', 'announcement_id', 'employee_id', 'read_at', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['AnnouncementEmployeeMapId' => 0, 'AnnouncementId' => 1, 'EmployeeId' => 2, 'ReadAt' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['announcementEmployeeMapId' => 0, 'announcementId' => 1, 'employeeId' => 2, 'readAt' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID => 0, AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID => 1, AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID => 2, AnnouncementEmployeeMapTableMap::COL_READ_AT => 3, AnnouncementEmployeeMapTableMap::COL_CREATED_AT => 4, AnnouncementEmployeeMapTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['announcement_employee_map_id' => 0, 'announcement_id' => 1, 'employee_id' => 2, 'read_at' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'AnnouncementEmployeeMapId' => 'ANNOUNCEMENT_EMPLOYEE_MAP_ID',
        'AnnouncementEmployeeMap.AnnouncementEmployeeMapId' => 'ANNOUNCEMENT_EMPLOYEE_MAP_ID',
        'announcementEmployeeMapId' => 'ANNOUNCEMENT_EMPLOYEE_MAP_ID',
        'announcementEmployeeMap.announcementEmployeeMapId' => 'ANNOUNCEMENT_EMPLOYEE_MAP_ID',
        'AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID' => 'ANNOUNCEMENT_EMPLOYEE_MAP_ID',
        'COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID' => 'ANNOUNCEMENT_EMPLOYEE_MAP_ID',
        'announcement_employee_map_id' => 'ANNOUNCEMENT_EMPLOYEE_MAP_ID',
        'announcement_employee_map.announcement_employee_map_id' => 'ANNOUNCEMENT_EMPLOYEE_MAP_ID',
        'AnnouncementId' => 'ANNOUNCEMENT_ID',
        'AnnouncementEmployeeMap.AnnouncementId' => 'ANNOUNCEMENT_ID',
        'announcementId' => 'ANNOUNCEMENT_ID',
        'announcementEmployeeMap.announcementId' => 'ANNOUNCEMENT_ID',
        'AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID' => 'ANNOUNCEMENT_ID',
        'COL_ANNOUNCEMENT_ID' => 'ANNOUNCEMENT_ID',
        'announcement_id' => 'ANNOUNCEMENT_ID',
        'announcement_employee_map.announcement_id' => 'ANNOUNCEMENT_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'AnnouncementEmployeeMap.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'announcementEmployeeMap.employeeId' => 'EMPLOYEE_ID',
        'AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'announcement_employee_map.employee_id' => 'EMPLOYEE_ID',
        'ReadAt' => 'READ_AT',
        'AnnouncementEmployeeMap.ReadAt' => 'READ_AT',
        'readAt' => 'READ_AT',
        'announcementEmployeeMap.readAt' => 'READ_AT',
        'AnnouncementEmployeeMapTableMap::COL_READ_AT' => 'READ_AT',
        'COL_READ_AT' => 'READ_AT',
        'read_at' => 'READ_AT',
        'announcement_employee_map.read_at' => 'READ_AT',
        'CreatedAt' => 'CREATED_AT',
        'AnnouncementEmployeeMap.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'announcementEmployeeMap.createdAt' => 'CREATED_AT',
        'AnnouncementEmployeeMapTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'announcement_employee_map.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'AnnouncementEmployeeMap.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'announcementEmployeeMap.updatedAt' => 'UPDATED_AT',
        'AnnouncementEmployeeMapTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'announcement_employee_map.updated_at' => 'UPDATED_AT',
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
        $this->setName('announcement_employee_map');
        $this->setPhpName('AnnouncementEmployeeMap');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\AnnouncementEmployeeMap');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('announcement_employee_map_announcement_employee_map_id_seq');
        // columns
        $this->addPrimaryKey('announcement_employee_map_id', 'AnnouncementEmployeeMapId', 'INTEGER', true, null, null);
        $this->addForeignKey('announcement_id', 'AnnouncementId', 'INTEGER', 'announcements', 'announcement_id', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('read_at', 'ReadAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Announcements', '\\entities\\Announcements', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':announcement_id',
    1 => ':announcement_id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementEmployeeMapId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementEmployeeMapId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementEmployeeMapId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementEmployeeMapId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementEmployeeMapId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementEmployeeMapId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('AnnouncementEmployeeMapId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? AnnouncementEmployeeMapTableMap::CLASS_DEFAULT : AnnouncementEmployeeMapTableMap::OM_CLASS;
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
     * @return array (AnnouncementEmployeeMap object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AnnouncementEmployeeMapTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AnnouncementEmployeeMapTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AnnouncementEmployeeMapTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AnnouncementEmployeeMapTableMap::OM_CLASS;
            /** @var AnnouncementEmployeeMap $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AnnouncementEmployeeMapTableMap::addInstanceToPool($obj, $key);
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
            $key = AnnouncementEmployeeMapTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AnnouncementEmployeeMapTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var AnnouncementEmployeeMap $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AnnouncementEmployeeMapTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID);
            $criteria->addSelectColumn(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID);
            $criteria->addSelectColumn(AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(AnnouncementEmployeeMapTableMap::COL_READ_AT);
            $criteria->addSelectColumn(AnnouncementEmployeeMapTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AnnouncementEmployeeMapTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.announcement_employee_map_id');
            $criteria->addSelectColumn($alias . '.announcement_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.read_at');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID);
            $criteria->removeSelectColumn(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID);
            $criteria->removeSelectColumn(AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(AnnouncementEmployeeMapTableMap::COL_READ_AT);
            $criteria->removeSelectColumn(AnnouncementEmployeeMapTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(AnnouncementEmployeeMapTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.announcement_employee_map_id');
            $criteria->removeSelectColumn($alias . '.announcement_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.read_at');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(AnnouncementEmployeeMapTableMap::DATABASE_NAME)->getTable(AnnouncementEmployeeMapTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a AnnouncementEmployeeMap or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or AnnouncementEmployeeMap object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementEmployeeMapTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\AnnouncementEmployeeMap) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AnnouncementEmployeeMapTableMap::DATABASE_NAME);
            $criteria->add(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID, (array) $values, Criteria::IN);
        }

        $query = AnnouncementEmployeeMapQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AnnouncementEmployeeMapTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AnnouncementEmployeeMapTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the announcement_employee_map table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AnnouncementEmployeeMapQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a AnnouncementEmployeeMap or Criteria object.
     *
     * @param mixed $criteria Criteria or AnnouncementEmployeeMap object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementEmployeeMapTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from AnnouncementEmployeeMap object
        }

        if ($criteria->containsKey(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID) && $criteria->keyContainsValue(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID.')');
        }


        // Set the correct dbName
        $query = AnnouncementEmployeeMapQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
