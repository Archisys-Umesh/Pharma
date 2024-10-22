<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\TempObsmCorrection;
use entities\TempObsmCorrectionQuery;


/**
 * This class defines the structure of the 'temp_obsm_correction' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TempObsmCorrectionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TempObsmCorrectionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'temp_obsm_correction';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TempObsmCorrection';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TempObsmCorrection';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TempObsmCorrection';

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
     * the column name for the org_data_id field
     */
    public const COL_ORG_DATA_ID = 'temp_obsm_correction.org_data_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'temp_obsm_correction.brand_id';

    /**
     * the column name for the min field
     */
    public const COL_MIN = 'temp_obsm_correction.min';

    /**
     * the column name for the ids field
     */
    public const COL_IDS = 'temp_obsm_correction.ids';

    /**
     * the column name for the count field
     */
    public const COL_COUNT = 'temp_obsm_correction.count';

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
        self::TYPE_PHPNAME       => ['OrgDataId', 'BrandId', 'Min', 'Ids', 'Count', ],
        self::TYPE_CAMELNAME     => ['orgDataId', 'brandId', 'min', 'ids', 'count', ],
        self::TYPE_COLNAME       => [TempObsmCorrectionTableMap::COL_ORG_DATA_ID, TempObsmCorrectionTableMap::COL_BRAND_ID, TempObsmCorrectionTableMap::COL_MIN, TempObsmCorrectionTableMap::COL_IDS, TempObsmCorrectionTableMap::COL_COUNT, ],
        self::TYPE_FIELDNAME     => ['org_data_id', 'brand_id', 'min', 'ids', 'count', ],
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
        self::TYPE_PHPNAME       => ['OrgDataId' => 0, 'BrandId' => 1, 'Min' => 2, 'Ids' => 3, 'Count' => 4, ],
        self::TYPE_CAMELNAME     => ['orgDataId' => 0, 'brandId' => 1, 'min' => 2, 'ids' => 3, 'count' => 4, ],
        self::TYPE_COLNAME       => [TempObsmCorrectionTableMap::COL_ORG_DATA_ID => 0, TempObsmCorrectionTableMap::COL_BRAND_ID => 1, TempObsmCorrectionTableMap::COL_MIN => 2, TempObsmCorrectionTableMap::COL_IDS => 3, TempObsmCorrectionTableMap::COL_COUNT => 4, ],
        self::TYPE_FIELDNAME     => ['org_data_id' => 0, 'brand_id' => 1, 'min' => 2, 'ids' => 3, 'count' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OrgDataId' => 'ORG_DATA_ID',
        'TempObsmCorrection.OrgDataId' => 'ORG_DATA_ID',
        'orgDataId' => 'ORG_DATA_ID',
        'tempObsmCorrection.orgDataId' => 'ORG_DATA_ID',
        'TempObsmCorrectionTableMap::COL_ORG_DATA_ID' => 'ORG_DATA_ID',
        'COL_ORG_DATA_ID' => 'ORG_DATA_ID',
        'org_data_id' => 'ORG_DATA_ID',
        'temp_obsm_correction.org_data_id' => 'ORG_DATA_ID',
        'BrandId' => 'BRAND_ID',
        'TempObsmCorrection.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'tempObsmCorrection.brandId' => 'BRAND_ID',
        'TempObsmCorrectionTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'temp_obsm_correction.brand_id' => 'BRAND_ID',
        'Min' => 'MIN',
        'TempObsmCorrection.Min' => 'MIN',
        'min' => 'MIN',
        'tempObsmCorrection.min' => 'MIN',
        'TempObsmCorrectionTableMap::COL_MIN' => 'MIN',
        'COL_MIN' => 'MIN',
        'temp_obsm_correction.min' => 'MIN',
        'Ids' => 'IDS',
        'TempObsmCorrection.Ids' => 'IDS',
        'ids' => 'IDS',
        'tempObsmCorrection.ids' => 'IDS',
        'TempObsmCorrectionTableMap::COL_IDS' => 'IDS',
        'COL_IDS' => 'IDS',
        'temp_obsm_correction.ids' => 'IDS',
        'Count' => 'COUNT',
        'TempObsmCorrection.Count' => 'COUNT',
        'count' => 'COUNT',
        'tempObsmCorrection.count' => 'COUNT',
        'TempObsmCorrectionTableMap::COL_COUNT' => 'COUNT',
        'COL_COUNT' => 'COUNT',
        'temp_obsm_correction.count' => 'COUNT',
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
        $this->setName('temp_obsm_correction');
        $this->setPhpName('TempObsmCorrection');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TempObsmCorrection');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('org_data_id', 'OrgDataId', 'INTEGER', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('min', 'Min', 'BIGINT', false, null, null);
        $this->addColumn('ids', 'Ids', 'LONGVARCHAR', false, null, null);
        $this->addColumn('count', 'Count', 'BIGINT', false, null, null);
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
        return null;
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
        return '';
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
        return $withPrefix ? TempObsmCorrectionTableMap::CLASS_DEFAULT : TempObsmCorrectionTableMap::OM_CLASS;
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
     * @return array (TempObsmCorrection object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TempObsmCorrectionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TempObsmCorrectionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TempObsmCorrectionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TempObsmCorrectionTableMap::OM_CLASS;
            /** @var TempObsmCorrection $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TempObsmCorrectionTableMap::addInstanceToPool($obj, $key);
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
            $key = TempObsmCorrectionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TempObsmCorrectionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TempObsmCorrection $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TempObsmCorrectionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TempObsmCorrectionTableMap::COL_ORG_DATA_ID);
            $criteria->addSelectColumn(TempObsmCorrectionTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(TempObsmCorrectionTableMap::COL_MIN);
            $criteria->addSelectColumn(TempObsmCorrectionTableMap::COL_IDS);
            $criteria->addSelectColumn(TempObsmCorrectionTableMap::COL_COUNT);
        } else {
            $criteria->addSelectColumn($alias . '.org_data_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.min');
            $criteria->addSelectColumn($alias . '.ids');
            $criteria->addSelectColumn($alias . '.count');
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
            $criteria->removeSelectColumn(TempObsmCorrectionTableMap::COL_ORG_DATA_ID);
            $criteria->removeSelectColumn(TempObsmCorrectionTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(TempObsmCorrectionTableMap::COL_MIN);
            $criteria->removeSelectColumn(TempObsmCorrectionTableMap::COL_IDS);
            $criteria->removeSelectColumn(TempObsmCorrectionTableMap::COL_COUNT);
        } else {
            $criteria->removeSelectColumn($alias . '.org_data_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.min');
            $criteria->removeSelectColumn($alias . '.ids');
            $criteria->removeSelectColumn($alias . '.count');
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
        return Propel::getServiceContainer()->getDatabaseMap(TempObsmCorrectionTableMap::DATABASE_NAME)->getTable(TempObsmCorrectionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TempObsmCorrection or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TempObsmCorrection object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TempObsmCorrectionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TempObsmCorrection) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The TempObsmCorrection object has no primary key');
        }

        $query = TempObsmCorrectionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TempObsmCorrectionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TempObsmCorrectionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the temp_obsm_correction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TempObsmCorrectionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TempObsmCorrection or Criteria object.
     *
     * @param mixed $criteria Criteria or TempObsmCorrection object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TempObsmCorrectionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TempObsmCorrection object
        }


        // Set the correct dbName
        $query = TempObsmCorrectionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
