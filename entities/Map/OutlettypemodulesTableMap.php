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
use entities\Outlettypemodules;
use entities\OutlettypemodulesQuery;


/**
 * This class defines the structure of the 'outlettypemodules' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutlettypemodulesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutlettypemodulesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlettypemodules';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Outlettypemodules';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Outlettypemodules';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Outlettypemodules';

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
     * the column name for the outlettypemoduleid field
     */
    public const COL_OUTLETTYPEMODULEID = 'outlettypemodules.outlettypemoduleid';

    /**
     * the column name for the outlettypeid field
     */
    public const COL_OUTLETTYPEID = 'outlettypemodules.outlettypeid';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlettypemodules.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlettypemodules.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlettypemodules.updated_at';

    /**
     * the column name for the module_name field
     */
    public const COL_MODULE_NAME = 'outlettypemodules.module_name';

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
        self::TYPE_PHPNAME       => ['Outlettypemoduleid', 'Outlettypeid', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'ModuleName', ],
        self::TYPE_CAMELNAME     => ['outlettypemoduleid', 'outlettypeid', 'companyId', 'createdAt', 'updatedAt', 'moduleName', ],
        self::TYPE_COLNAME       => [OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID, OutlettypemodulesTableMap::COL_OUTLETTYPEID, OutlettypemodulesTableMap::COL_COMPANY_ID, OutlettypemodulesTableMap::COL_CREATED_AT, OutlettypemodulesTableMap::COL_UPDATED_AT, OutlettypemodulesTableMap::COL_MODULE_NAME, ],
        self::TYPE_FIELDNAME     => ['outlettypemoduleid', 'outlettypeid', 'company_id', 'created_at', 'updated_at', 'module_name', ],
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
        self::TYPE_PHPNAME       => ['Outlettypemoduleid' => 0, 'Outlettypeid' => 1, 'CompanyId' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'ModuleName' => 5, ],
        self::TYPE_CAMELNAME     => ['outlettypemoduleid' => 0, 'outlettypeid' => 1, 'companyId' => 2, 'createdAt' => 3, 'updatedAt' => 4, 'moduleName' => 5, ],
        self::TYPE_COLNAME       => [OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID => 0, OutlettypemodulesTableMap::COL_OUTLETTYPEID => 1, OutlettypemodulesTableMap::COL_COMPANY_ID => 2, OutlettypemodulesTableMap::COL_CREATED_AT => 3, OutlettypemodulesTableMap::COL_UPDATED_AT => 4, OutlettypemodulesTableMap::COL_MODULE_NAME => 5, ],
        self::TYPE_FIELDNAME     => ['outlettypemoduleid' => 0, 'outlettypeid' => 1, 'company_id' => 2, 'created_at' => 3, 'updated_at' => 4, 'module_name' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Outlettypemoduleid' => 'OUTLETTYPEMODULEID',
        'Outlettypemodules.Outlettypemoduleid' => 'OUTLETTYPEMODULEID',
        'outlettypemoduleid' => 'OUTLETTYPEMODULEID',
        'outlettypemodules.outlettypemoduleid' => 'OUTLETTYPEMODULEID',
        'OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID' => 'OUTLETTYPEMODULEID',
        'COL_OUTLETTYPEMODULEID' => 'OUTLETTYPEMODULEID',
        'Outlettypeid' => 'OUTLETTYPEID',
        'Outlettypemodules.Outlettypeid' => 'OUTLETTYPEID',
        'outlettypeid' => 'OUTLETTYPEID',
        'outlettypemodules.outlettypeid' => 'OUTLETTYPEID',
        'OutlettypemodulesTableMap::COL_OUTLETTYPEID' => 'OUTLETTYPEID',
        'COL_OUTLETTYPEID' => 'OUTLETTYPEID',
        'CompanyId' => 'COMPANY_ID',
        'Outlettypemodules.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outlettypemodules.companyId' => 'COMPANY_ID',
        'OutlettypemodulesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlettypemodules.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Outlettypemodules.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outlettypemodules.createdAt' => 'CREATED_AT',
        'OutlettypemodulesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlettypemodules.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Outlettypemodules.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outlettypemodules.updatedAt' => 'UPDATED_AT',
        'OutlettypemodulesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlettypemodules.updated_at' => 'UPDATED_AT',
        'ModuleName' => 'MODULE_NAME',
        'Outlettypemodules.ModuleName' => 'MODULE_NAME',
        'moduleName' => 'MODULE_NAME',
        'outlettypemodules.moduleName' => 'MODULE_NAME',
        'OutlettypemodulesTableMap::COL_MODULE_NAME' => 'MODULE_NAME',
        'COL_MODULE_NAME' => 'MODULE_NAME',
        'module_name' => 'MODULE_NAME',
        'outlettypemodules.module_name' => 'MODULE_NAME',
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
        $this->setName('outlettypemodules');
        $this->setPhpName('Outlettypemodules');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Outlettypemodules');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlettypemodules_outlettypemoduleid_seq');
        // columns
        $this->addPrimaryKey('outlettypemoduleid', 'Outlettypemoduleid', 'INTEGER', true, null, null);
        $this->addForeignKey('outlettypeid', 'Outlettypeid', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('module_name', 'ModuleName', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlettypeid',
    1 => ':outlettype_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Outlettypemoduleid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Outlettypemoduleid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Outlettypemoduleid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Outlettypemoduleid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Outlettypemoduleid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Outlettypemoduleid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Outlettypemoduleid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutlettypemodulesTableMap::CLASS_DEFAULT : OutlettypemodulesTableMap::OM_CLASS;
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
     * @return array (Outlettypemodules object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutlettypemodulesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutlettypemodulesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutlettypemodulesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutlettypemodulesTableMap::OM_CLASS;
            /** @var Outlettypemodules $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutlettypemodulesTableMap::addInstanceToPool($obj, $key);
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
            $key = OutlettypemodulesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutlettypemodulesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Outlettypemodules $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutlettypemodulesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID);
            $criteria->addSelectColumn(OutlettypemodulesTableMap::COL_OUTLETTYPEID);
            $criteria->addSelectColumn(OutlettypemodulesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutlettypemodulesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutlettypemodulesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutlettypemodulesTableMap::COL_MODULE_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.outlettypemoduleid');
            $criteria->addSelectColumn($alias . '.outlettypeid');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.module_name');
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
            $criteria->removeSelectColumn(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID);
            $criteria->removeSelectColumn(OutlettypemodulesTableMap::COL_OUTLETTYPEID);
            $criteria->removeSelectColumn(OutlettypemodulesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutlettypemodulesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutlettypemodulesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutlettypemodulesTableMap::COL_MODULE_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.outlettypemoduleid');
            $criteria->removeSelectColumn($alias . '.outlettypeid');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.module_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutlettypemodulesTableMap::DATABASE_NAME)->getTable(OutlettypemodulesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Outlettypemodules or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Outlettypemodules object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutlettypemodulesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Outlettypemodules) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutlettypemodulesTableMap::DATABASE_NAME);
            $criteria->add(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID, (array) $values, Criteria::IN);
        }

        $query = OutlettypemodulesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutlettypemodulesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutlettypemodulesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlettypemodules table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutlettypemodulesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Outlettypemodules or Criteria object.
     *
     * @param mixed $criteria Criteria or Outlettypemodules object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutlettypemodulesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Outlettypemodules object
        }

        if ($criteria->containsKey(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID) && $criteria->keyContainsValue(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID.')');
        }


        // Set the correct dbName
        $query = OutlettypemodulesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
