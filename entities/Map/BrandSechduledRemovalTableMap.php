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
use entities\BrandSechduledRemoval;
use entities\BrandSechduledRemovalQuery;


/**
 * This class defines the structure of the 'brand_sechduled_removal' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandSechduledRemovalTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandSechduledRemovalTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brand_sechduled_removal';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BrandSechduledRemoval';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BrandSechduledRemoval';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BrandSechduledRemoval';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the removal_id field
     */
    public const COL_REMOVAL_ID = 'brand_sechduled_removal.removal_id';

    /**
     * the column name for the remove_brand_id field
     */
    public const COL_REMOVE_BRAND_ID = 'brand_sechduled_removal.remove_brand_id';

    /**
     * the column name for the merge_brand_id field
     */
    public const COL_MERGE_BRAND_ID = 'brand_sechduled_removal.merge_brand_id';

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
        self::TYPE_PHPNAME       => ['RemovalId', 'RemoveBrandId', 'MergeBrandId', ],
        self::TYPE_CAMELNAME     => ['removalId', 'removeBrandId', 'mergeBrandId', ],
        self::TYPE_COLNAME       => [BrandSechduledRemovalTableMap::COL_REMOVAL_ID, BrandSechduledRemovalTableMap::COL_REMOVE_BRAND_ID, BrandSechduledRemovalTableMap::COL_MERGE_BRAND_ID, ],
        self::TYPE_FIELDNAME     => ['removal_id', 'remove_brand_id', 'merge_brand_id', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['RemovalId' => 0, 'RemoveBrandId' => 1, 'MergeBrandId' => 2, ],
        self::TYPE_CAMELNAME     => ['removalId' => 0, 'removeBrandId' => 1, 'mergeBrandId' => 2, ],
        self::TYPE_COLNAME       => [BrandSechduledRemovalTableMap::COL_REMOVAL_ID => 0, BrandSechduledRemovalTableMap::COL_REMOVE_BRAND_ID => 1, BrandSechduledRemovalTableMap::COL_MERGE_BRAND_ID => 2, ],
        self::TYPE_FIELDNAME     => ['removal_id' => 0, 'remove_brand_id' => 1, 'merge_brand_id' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'RemovalId' => 'REMOVAL_ID',
        'BrandSechduledRemoval.RemovalId' => 'REMOVAL_ID',
        'removalId' => 'REMOVAL_ID',
        'brandSechduledRemoval.removalId' => 'REMOVAL_ID',
        'BrandSechduledRemovalTableMap::COL_REMOVAL_ID' => 'REMOVAL_ID',
        'COL_REMOVAL_ID' => 'REMOVAL_ID',
        'removal_id' => 'REMOVAL_ID',
        'brand_sechduled_removal.removal_id' => 'REMOVAL_ID',
        'RemoveBrandId' => 'REMOVE_BRAND_ID',
        'BrandSechduledRemoval.RemoveBrandId' => 'REMOVE_BRAND_ID',
        'removeBrandId' => 'REMOVE_BRAND_ID',
        'brandSechduledRemoval.removeBrandId' => 'REMOVE_BRAND_ID',
        'BrandSechduledRemovalTableMap::COL_REMOVE_BRAND_ID' => 'REMOVE_BRAND_ID',
        'COL_REMOVE_BRAND_ID' => 'REMOVE_BRAND_ID',
        'remove_brand_id' => 'REMOVE_BRAND_ID',
        'brand_sechduled_removal.remove_brand_id' => 'REMOVE_BRAND_ID',
        'MergeBrandId' => 'MERGE_BRAND_ID',
        'BrandSechduledRemoval.MergeBrandId' => 'MERGE_BRAND_ID',
        'mergeBrandId' => 'MERGE_BRAND_ID',
        'brandSechduledRemoval.mergeBrandId' => 'MERGE_BRAND_ID',
        'BrandSechduledRemovalTableMap::COL_MERGE_BRAND_ID' => 'MERGE_BRAND_ID',
        'COL_MERGE_BRAND_ID' => 'MERGE_BRAND_ID',
        'merge_brand_id' => 'MERGE_BRAND_ID',
        'brand_sechduled_removal.merge_brand_id' => 'MERGE_BRAND_ID',
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
        $this->setName('brand_sechduled_removal');
        $this->setPhpName('BrandSechduledRemoval');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BrandSechduledRemoval');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brand_sechduled_removal_removal_id_seq');
        // columns
        $this->addPrimaryKey('removal_id', 'RemovalId', 'INTEGER', true, null, null);
        $this->addColumn('remove_brand_id', 'RemoveBrandId', 'INTEGER', false, null, null);
        $this->addColumn('merge_brand_id', 'MergeBrandId', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemovalId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemovalId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemovalId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemovalId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemovalId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemovalId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('RemovalId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandSechduledRemovalTableMap::CLASS_DEFAULT : BrandSechduledRemovalTableMap::OM_CLASS;
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
     * @return array (BrandSechduledRemoval object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandSechduledRemovalTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandSechduledRemovalTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandSechduledRemovalTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandSechduledRemovalTableMap::OM_CLASS;
            /** @var BrandSechduledRemoval $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandSechduledRemovalTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandSechduledRemovalTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandSechduledRemovalTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BrandSechduledRemoval $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandSechduledRemovalTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandSechduledRemovalTableMap::COL_REMOVAL_ID);
            $criteria->addSelectColumn(BrandSechduledRemovalTableMap::COL_REMOVE_BRAND_ID);
            $criteria->addSelectColumn(BrandSechduledRemovalTableMap::COL_MERGE_BRAND_ID);
        } else {
            $criteria->addSelectColumn($alias . '.removal_id');
            $criteria->addSelectColumn($alias . '.remove_brand_id');
            $criteria->addSelectColumn($alias . '.merge_brand_id');
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
            $criteria->removeSelectColumn(BrandSechduledRemovalTableMap::COL_REMOVAL_ID);
            $criteria->removeSelectColumn(BrandSechduledRemovalTableMap::COL_REMOVE_BRAND_ID);
            $criteria->removeSelectColumn(BrandSechduledRemovalTableMap::COL_MERGE_BRAND_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.removal_id');
            $criteria->removeSelectColumn($alias . '.remove_brand_id');
            $criteria->removeSelectColumn($alias . '.merge_brand_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandSechduledRemovalTableMap::DATABASE_NAME)->getTable(BrandSechduledRemovalTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BrandSechduledRemoval or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BrandSechduledRemoval object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandSechduledRemovalTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BrandSechduledRemoval) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandSechduledRemovalTableMap::DATABASE_NAME);
            $criteria->add(BrandSechduledRemovalTableMap::COL_REMOVAL_ID, (array) $values, Criteria::IN);
        }

        $query = BrandSechduledRemovalQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandSechduledRemovalTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandSechduledRemovalTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brand_sechduled_removal table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandSechduledRemovalQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BrandSechduledRemoval or Criteria object.
     *
     * @param mixed $criteria Criteria or BrandSechduledRemoval object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandSechduledRemovalTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BrandSechduledRemoval object
        }

        if ($criteria->containsKey(BrandSechduledRemovalTableMap::COL_REMOVAL_ID) && $criteria->keyContainsValue(BrandSechduledRemovalTableMap::COL_REMOVAL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandSechduledRemovalTableMap::COL_REMOVAL_ID.')');
        }


        // Set the correct dbName
        $query = BrandSechduledRemovalQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
