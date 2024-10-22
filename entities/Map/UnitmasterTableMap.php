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
use entities\Unitmaster;
use entities\UnitmasterQuery;


/**
 * This class defines the structure of the 'unitmaster' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UnitmasterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.UnitmasterTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'unitmaster';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Unitmaster';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Unitmaster';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Unitmaster';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the unit_id field
     */
    public const COL_UNIT_ID = 'unitmaster.unit_id';

    /**
     * the column name for the unit_code field
     */
    public const COL_UNIT_CODE = 'unitmaster.unit_code';

    /**
     * the column name for the unit_description field
     */
    public const COL_UNIT_DESCRIPTION = 'unitmaster.unit_description';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'unitmaster.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'unitmaster.updated_at';

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
        self::TYPE_PHPNAME       => ['UnitId', 'UnitCode', 'UnitDescription', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['unitId', 'unitCode', 'unitDescription', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [UnitmasterTableMap::COL_UNIT_ID, UnitmasterTableMap::COL_UNIT_CODE, UnitmasterTableMap::COL_UNIT_DESCRIPTION, UnitmasterTableMap::COL_CREATED_AT, UnitmasterTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['unit_id', 'unit_code', 'unit_description', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['UnitId' => 0, 'UnitCode' => 1, 'UnitDescription' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['unitId' => 0, 'unitCode' => 1, 'unitDescription' => 2, 'createdAt' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [UnitmasterTableMap::COL_UNIT_ID => 0, UnitmasterTableMap::COL_UNIT_CODE => 1, UnitmasterTableMap::COL_UNIT_DESCRIPTION => 2, UnitmasterTableMap::COL_CREATED_AT => 3, UnitmasterTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['unit_id' => 0, 'unit_code' => 1, 'unit_description' => 2, 'created_at' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'UnitId' => 'UNIT_ID',
        'Unitmaster.UnitId' => 'UNIT_ID',
        'unitId' => 'UNIT_ID',
        'unitmaster.unitId' => 'UNIT_ID',
        'UnitmasterTableMap::COL_UNIT_ID' => 'UNIT_ID',
        'COL_UNIT_ID' => 'UNIT_ID',
        'unit_id' => 'UNIT_ID',
        'unitmaster.unit_id' => 'UNIT_ID',
        'UnitCode' => 'UNIT_CODE',
        'Unitmaster.UnitCode' => 'UNIT_CODE',
        'unitCode' => 'UNIT_CODE',
        'unitmaster.unitCode' => 'UNIT_CODE',
        'UnitmasterTableMap::COL_UNIT_CODE' => 'UNIT_CODE',
        'COL_UNIT_CODE' => 'UNIT_CODE',
        'unit_code' => 'UNIT_CODE',
        'unitmaster.unit_code' => 'UNIT_CODE',
        'UnitDescription' => 'UNIT_DESCRIPTION',
        'Unitmaster.UnitDescription' => 'UNIT_DESCRIPTION',
        'unitDescription' => 'UNIT_DESCRIPTION',
        'unitmaster.unitDescription' => 'UNIT_DESCRIPTION',
        'UnitmasterTableMap::COL_UNIT_DESCRIPTION' => 'UNIT_DESCRIPTION',
        'COL_UNIT_DESCRIPTION' => 'UNIT_DESCRIPTION',
        'unit_description' => 'UNIT_DESCRIPTION',
        'unitmaster.unit_description' => 'UNIT_DESCRIPTION',
        'CreatedAt' => 'CREATED_AT',
        'Unitmaster.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'unitmaster.createdAt' => 'CREATED_AT',
        'UnitmasterTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'unitmaster.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Unitmaster.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'unitmaster.updatedAt' => 'UPDATED_AT',
        'UnitmasterTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'unitmaster.updated_at' => 'UPDATED_AT',
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
        $this->setName('unitmaster');
        $this->setPhpName('Unitmaster');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Unitmaster');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('unitmaster_unit_id_seq');
        // columns
        $this->addPrimaryKey('unit_id', 'UnitId', 'INTEGER', true, null, null);
        $this->addColumn('unit_code', 'UnitCode', 'VARCHAR', true, 50, '0');
        $this->addColumn('unit_description', 'UnitDescription', 'VARCHAR', true, 250, '0');
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('CompetitionMapping', '\\entities\\CompetitionMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':unit_id',
    1 => ':unit_id',
  ),
), null, null, 'CompetitionMappings', false);
        $this->addRelation('Orderlines', '\\entities\\Orderlines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':unit_id',
    1 => ':unit_id',
  ),
), null, null, 'Orderliness', false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':unit_d',
    1 => ':unit_id',
  ),
), null, null, 'Productss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UnitmasterTableMap::CLASS_DEFAULT : UnitmasterTableMap::OM_CLASS;
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
     * @return array (Unitmaster object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UnitmasterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UnitmasterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UnitmasterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UnitmasterTableMap::OM_CLASS;
            /** @var Unitmaster $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UnitmasterTableMap::addInstanceToPool($obj, $key);
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
            $key = UnitmasterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UnitmasterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Unitmaster $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UnitmasterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UnitmasterTableMap::COL_UNIT_ID);
            $criteria->addSelectColumn(UnitmasterTableMap::COL_UNIT_CODE);
            $criteria->addSelectColumn(UnitmasterTableMap::COL_UNIT_DESCRIPTION);
            $criteria->addSelectColumn(UnitmasterTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UnitmasterTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.unit_id');
            $criteria->addSelectColumn($alias . '.unit_code');
            $criteria->addSelectColumn($alias . '.unit_description');
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
            $criteria->removeSelectColumn(UnitmasterTableMap::COL_UNIT_ID);
            $criteria->removeSelectColumn(UnitmasterTableMap::COL_UNIT_CODE);
            $criteria->removeSelectColumn(UnitmasterTableMap::COL_UNIT_DESCRIPTION);
            $criteria->removeSelectColumn(UnitmasterTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(UnitmasterTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.unit_id');
            $criteria->removeSelectColumn($alias . '.unit_code');
            $criteria->removeSelectColumn($alias . '.unit_description');
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
        return Propel::getServiceContainer()->getDatabaseMap(UnitmasterTableMap::DATABASE_NAME)->getTable(UnitmasterTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Unitmaster or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Unitmaster object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UnitmasterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Unitmaster) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UnitmasterTableMap::DATABASE_NAME);
            $criteria->add(UnitmasterTableMap::COL_UNIT_ID, (array) $values, Criteria::IN);
        }

        $query = UnitmasterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UnitmasterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UnitmasterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the unitmaster table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UnitmasterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Unitmaster or Criteria object.
     *
     * @param mixed $criteria Criteria or Unitmaster object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UnitmasterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Unitmaster object
        }

        if ($criteria->containsKey(UnitmasterTableMap::COL_UNIT_ID) && $criteria->keyContainsValue(UnitmasterTableMap::COL_UNIT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UnitmasterTableMap::COL_UNIT_ID.')');
        }


        // Set the correct dbName
        $query = UnitmasterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
