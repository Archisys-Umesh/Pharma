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
use entities\Holidays;
use entities\HolidaysQuery;


/**
 * This class defines the structure of the 'holidays' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class HolidaysTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.HolidaysTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'holidays';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Holidays';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Holidays';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Holidays';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the holiday_id field
     */
    public const COL_HOLIDAY_ID = 'holidays.holiday_id';

    /**
     * the column name for the holiday_name field
     */
    public const COL_HOLIDAY_NAME = 'holidays.holiday_name';

    /**
     * the column name for the holiday_date field
     */
    public const COL_HOLIDAY_DATE = 'holidays.holiday_date';

    /**
     * the column name for the istateid field
     */
    public const COL_ISTATEID = 'holidays.istateid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'holidays.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'holidays.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'holidays.company_id';

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
        self::TYPE_PHPNAME       => ['HolidayId', 'HolidayName', 'HolidayDate', 'Istateid', 'CreatedAt', 'UpdatedAt', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['holidayId', 'holidayName', 'holidayDate', 'istateid', 'createdAt', 'updatedAt', 'companyId', ],
        self::TYPE_COLNAME       => [HolidaysTableMap::COL_HOLIDAY_ID, HolidaysTableMap::COL_HOLIDAY_NAME, HolidaysTableMap::COL_HOLIDAY_DATE, HolidaysTableMap::COL_ISTATEID, HolidaysTableMap::COL_CREATED_AT, HolidaysTableMap::COL_UPDATED_AT, HolidaysTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['holiday_id', 'holiday_name', 'holiday_date', 'istateid', 'created_at', 'updated_at', 'company_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['HolidayId' => 0, 'HolidayName' => 1, 'HolidayDate' => 2, 'Istateid' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'CompanyId' => 6, ],
        self::TYPE_CAMELNAME     => ['holidayId' => 0, 'holidayName' => 1, 'holidayDate' => 2, 'istateid' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'companyId' => 6, ],
        self::TYPE_COLNAME       => [HolidaysTableMap::COL_HOLIDAY_ID => 0, HolidaysTableMap::COL_HOLIDAY_NAME => 1, HolidaysTableMap::COL_HOLIDAY_DATE => 2, HolidaysTableMap::COL_ISTATEID => 3, HolidaysTableMap::COL_CREATED_AT => 4, HolidaysTableMap::COL_UPDATED_AT => 5, HolidaysTableMap::COL_COMPANY_ID => 6, ],
        self::TYPE_FIELDNAME     => ['holiday_id' => 0, 'holiday_name' => 1, 'holiday_date' => 2, 'istateid' => 3, 'created_at' => 4, 'updated_at' => 5, 'company_id' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'HolidayId' => 'HOLIDAY_ID',
        'Holidays.HolidayId' => 'HOLIDAY_ID',
        'holidayId' => 'HOLIDAY_ID',
        'holidays.holidayId' => 'HOLIDAY_ID',
        'HolidaysTableMap::COL_HOLIDAY_ID' => 'HOLIDAY_ID',
        'COL_HOLIDAY_ID' => 'HOLIDAY_ID',
        'holiday_id' => 'HOLIDAY_ID',
        'holidays.holiday_id' => 'HOLIDAY_ID',
        'HolidayName' => 'HOLIDAY_NAME',
        'Holidays.HolidayName' => 'HOLIDAY_NAME',
        'holidayName' => 'HOLIDAY_NAME',
        'holidays.holidayName' => 'HOLIDAY_NAME',
        'HolidaysTableMap::COL_HOLIDAY_NAME' => 'HOLIDAY_NAME',
        'COL_HOLIDAY_NAME' => 'HOLIDAY_NAME',
        'holiday_name' => 'HOLIDAY_NAME',
        'holidays.holiday_name' => 'HOLIDAY_NAME',
        'HolidayDate' => 'HOLIDAY_DATE',
        'Holidays.HolidayDate' => 'HOLIDAY_DATE',
        'holidayDate' => 'HOLIDAY_DATE',
        'holidays.holidayDate' => 'HOLIDAY_DATE',
        'HolidaysTableMap::COL_HOLIDAY_DATE' => 'HOLIDAY_DATE',
        'COL_HOLIDAY_DATE' => 'HOLIDAY_DATE',
        'holiday_date' => 'HOLIDAY_DATE',
        'holidays.holiday_date' => 'HOLIDAY_DATE',
        'Istateid' => 'ISTATEID',
        'Holidays.Istateid' => 'ISTATEID',
        'istateid' => 'ISTATEID',
        'holidays.istateid' => 'ISTATEID',
        'HolidaysTableMap::COL_ISTATEID' => 'ISTATEID',
        'COL_ISTATEID' => 'ISTATEID',
        'CreatedAt' => 'CREATED_AT',
        'Holidays.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'holidays.createdAt' => 'CREATED_AT',
        'HolidaysTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'holidays.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Holidays.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'holidays.updatedAt' => 'UPDATED_AT',
        'HolidaysTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'holidays.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'Holidays.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'holidays.companyId' => 'COMPANY_ID',
        'HolidaysTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'holidays.company_id' => 'COMPANY_ID',
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
        $this->setName('holidays');
        $this->setPhpName('Holidays');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Holidays');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('holidays_holiday_id_seq');
        // columns
        $this->addPrimaryKey('holiday_id', 'HolidayId', 'INTEGER', true, null, null);
        $this->addColumn('holiday_name', 'HolidayName', 'VARCHAR', false, null, null);
        $this->addColumn('holiday_date', 'HolidayDate', 'DATE', false, null, null);
        $this->addForeignKey('istateid', 'Istateid', 'INTEGER', 'geo_state', 'istateid', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
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
        $this->addRelation('GeoState', '\\entities\\GeoState', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':istateid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HolidayId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HolidayId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HolidayId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HolidayId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HolidayId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HolidayId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('HolidayId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? HolidaysTableMap::CLASS_DEFAULT : HolidaysTableMap::OM_CLASS;
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
     * @return array (Holidays object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = HolidaysTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HolidaysTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HolidaysTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HolidaysTableMap::OM_CLASS;
            /** @var Holidays $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HolidaysTableMap::addInstanceToPool($obj, $key);
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
            $key = HolidaysTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HolidaysTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Holidays $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HolidaysTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HolidaysTableMap::COL_HOLIDAY_ID);
            $criteria->addSelectColumn(HolidaysTableMap::COL_HOLIDAY_NAME);
            $criteria->addSelectColumn(HolidaysTableMap::COL_HOLIDAY_DATE);
            $criteria->addSelectColumn(HolidaysTableMap::COL_ISTATEID);
            $criteria->addSelectColumn(HolidaysTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(HolidaysTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(HolidaysTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.holiday_id');
            $criteria->addSelectColumn($alias . '.holiday_name');
            $criteria->addSelectColumn($alias . '.holiday_date');
            $criteria->addSelectColumn($alias . '.istateid');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(HolidaysTableMap::COL_HOLIDAY_ID);
            $criteria->removeSelectColumn(HolidaysTableMap::COL_HOLIDAY_NAME);
            $criteria->removeSelectColumn(HolidaysTableMap::COL_HOLIDAY_DATE);
            $criteria->removeSelectColumn(HolidaysTableMap::COL_ISTATEID);
            $criteria->removeSelectColumn(HolidaysTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(HolidaysTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(HolidaysTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.holiday_id');
            $criteria->removeSelectColumn($alias . '.holiday_name');
            $criteria->removeSelectColumn($alias . '.holiday_date');
            $criteria->removeSelectColumn($alias . '.istateid');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(HolidaysTableMap::DATABASE_NAME)->getTable(HolidaysTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Holidays or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Holidays object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HolidaysTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Holidays) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HolidaysTableMap::DATABASE_NAME);
            $criteria->add(HolidaysTableMap::COL_HOLIDAY_ID, (array) $values, Criteria::IN);
        }

        $query = HolidaysQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HolidaysTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HolidaysTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the holidays table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return HolidaysQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Holidays or Criteria object.
     *
     * @param mixed $criteria Criteria or Holidays object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HolidaysTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Holidays object
        }

        if ($criteria->containsKey(HolidaysTableMap::COL_HOLIDAY_ID) && $criteria->keyContainsValue(HolidaysTableMap::COL_HOLIDAY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HolidaysTableMap::COL_HOLIDAY_ID.')');
        }


        // Set the correct dbName
        $query = HolidaysQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
