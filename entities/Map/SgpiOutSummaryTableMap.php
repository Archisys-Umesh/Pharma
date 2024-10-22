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
use entities\SgpiOutSummary;
use entities\SgpiOutSummaryQuery;


/**
 * This class defines the structure of the 'sgpi_out_summary' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SgpiOutSummaryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SgpiOutSummaryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sgpi_out_summary';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SgpiOutSummary';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SgpiOutSummary';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SgpiOutSummary';

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
     * the column name for the uniqueid field
     */
    public const COL_UNIQUEID = 'sgpi_out_summary.uniqueid';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'sgpi_out_summary.moye';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'sgpi_out_summary.territory_id';

    /**
     * the column name for the outlet_orgdata_id field
     */
    public const COL_OUTLET_ORGDATA_ID = 'sgpi_out_summary.outlet_orgdata_id';

    /**
     * the column name for the sgpi_type field
     */
    public const COL_SGPI_TYPE = 'sgpi_out_summary.sgpi_type';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'sgpi_out_summary.qty';

    /**
     * the column name for the lastcreate field
     */
    public const COL_LASTCREATE = 'sgpi_out_summary.lastcreate';

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
        self::TYPE_PHPNAME       => ['Uniqueid', 'Moye', 'TerritoryId', 'OutletOrgdataId', 'SgpiType', 'Qty', 'Lastcreate', ],
        self::TYPE_CAMELNAME     => ['uniqueid', 'moye', 'territoryId', 'outletOrgdataId', 'sgpiType', 'qty', 'lastcreate', ],
        self::TYPE_COLNAME       => [SgpiOutSummaryTableMap::COL_UNIQUEID, SgpiOutSummaryTableMap::COL_MOYE, SgpiOutSummaryTableMap::COL_TERRITORY_ID, SgpiOutSummaryTableMap::COL_OUTLET_ORGDATA_ID, SgpiOutSummaryTableMap::COL_SGPI_TYPE, SgpiOutSummaryTableMap::COL_QTY, SgpiOutSummaryTableMap::COL_LASTCREATE, ],
        self::TYPE_FIELDNAME     => ['uniqueid', 'moye', 'territory_id', 'outlet_orgdata_id', 'sgpi_type', 'qty', 'lastcreate', ],
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
        self::TYPE_PHPNAME       => ['Uniqueid' => 0, 'Moye' => 1, 'TerritoryId' => 2, 'OutletOrgdataId' => 3, 'SgpiType' => 4, 'Qty' => 5, 'Lastcreate' => 6, ],
        self::TYPE_CAMELNAME     => ['uniqueid' => 0, 'moye' => 1, 'territoryId' => 2, 'outletOrgdataId' => 3, 'sgpiType' => 4, 'qty' => 5, 'lastcreate' => 6, ],
        self::TYPE_COLNAME       => [SgpiOutSummaryTableMap::COL_UNIQUEID => 0, SgpiOutSummaryTableMap::COL_MOYE => 1, SgpiOutSummaryTableMap::COL_TERRITORY_ID => 2, SgpiOutSummaryTableMap::COL_OUTLET_ORGDATA_ID => 3, SgpiOutSummaryTableMap::COL_SGPI_TYPE => 4, SgpiOutSummaryTableMap::COL_QTY => 5, SgpiOutSummaryTableMap::COL_LASTCREATE => 6, ],
        self::TYPE_FIELDNAME     => ['uniqueid' => 0, 'moye' => 1, 'territory_id' => 2, 'outlet_orgdata_id' => 3, 'sgpi_type' => 4, 'qty' => 5, 'lastcreate' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Uniqueid' => 'UNIQUEID',
        'SgpiOutSummary.Uniqueid' => 'UNIQUEID',
        'uniqueid' => 'UNIQUEID',
        'sgpiOutSummary.uniqueid' => 'UNIQUEID',
        'SgpiOutSummaryTableMap::COL_UNIQUEID' => 'UNIQUEID',
        'COL_UNIQUEID' => 'UNIQUEID',
        'sgpi_out_summary.uniqueid' => 'UNIQUEID',
        'Moye' => 'MOYE',
        'SgpiOutSummary.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'sgpiOutSummary.moye' => 'MOYE',
        'SgpiOutSummaryTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'sgpi_out_summary.moye' => 'MOYE',
        'TerritoryId' => 'TERRITORY_ID',
        'SgpiOutSummary.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'sgpiOutSummary.territoryId' => 'TERRITORY_ID',
        'SgpiOutSummaryTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'sgpi_out_summary.territory_id' => 'TERRITORY_ID',
        'OutletOrgdataId' => 'OUTLET_ORGDATA_ID',
        'SgpiOutSummary.OutletOrgdataId' => 'OUTLET_ORGDATA_ID',
        'outletOrgdataId' => 'OUTLET_ORGDATA_ID',
        'sgpiOutSummary.outletOrgdataId' => 'OUTLET_ORGDATA_ID',
        'SgpiOutSummaryTableMap::COL_OUTLET_ORGDATA_ID' => 'OUTLET_ORGDATA_ID',
        'COL_OUTLET_ORGDATA_ID' => 'OUTLET_ORGDATA_ID',
        'outlet_orgdata_id' => 'OUTLET_ORGDATA_ID',
        'sgpi_out_summary.outlet_orgdata_id' => 'OUTLET_ORGDATA_ID',
        'SgpiType' => 'SGPI_TYPE',
        'SgpiOutSummary.SgpiType' => 'SGPI_TYPE',
        'sgpiType' => 'SGPI_TYPE',
        'sgpiOutSummary.sgpiType' => 'SGPI_TYPE',
        'SgpiOutSummaryTableMap::COL_SGPI_TYPE' => 'SGPI_TYPE',
        'COL_SGPI_TYPE' => 'SGPI_TYPE',
        'sgpi_type' => 'SGPI_TYPE',
        'sgpi_out_summary.sgpi_type' => 'SGPI_TYPE',
        'Qty' => 'QTY',
        'SgpiOutSummary.Qty' => 'QTY',
        'qty' => 'QTY',
        'sgpiOutSummary.qty' => 'QTY',
        'SgpiOutSummaryTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'sgpi_out_summary.qty' => 'QTY',
        'Lastcreate' => 'LASTCREATE',
        'SgpiOutSummary.Lastcreate' => 'LASTCREATE',
        'lastcreate' => 'LASTCREATE',
        'sgpiOutSummary.lastcreate' => 'LASTCREATE',
        'SgpiOutSummaryTableMap::COL_LASTCREATE' => 'LASTCREATE',
        'COL_LASTCREATE' => 'LASTCREATE',
        'sgpi_out_summary.lastcreate' => 'LASTCREATE',
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
        $this->setName('sgpi_out_summary');
        $this->setPhpName('SgpiOutSummary');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SgpiOutSummary');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('uniqueid', 'Uniqueid', 'VARCHAR', true, 50, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', false, 50, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_orgdata_id', 'OutletOrgdataId', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_type', 'SgpiType', 'VARCHAR', false, 50, null);
        $this->addColumn('qty', 'Qty', 'INTEGER', false, null, null);
        $this->addColumn('lastcreate', 'Lastcreate', 'TIMESTAMP', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SgpiOutSummaryTableMap::CLASS_DEFAULT : SgpiOutSummaryTableMap::OM_CLASS;
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
     * @return array (SgpiOutSummary object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SgpiOutSummaryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SgpiOutSummaryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SgpiOutSummaryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SgpiOutSummaryTableMap::OM_CLASS;
            /** @var SgpiOutSummary $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SgpiOutSummaryTableMap::addInstanceToPool($obj, $key);
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
            $key = SgpiOutSummaryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SgpiOutSummaryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SgpiOutSummary $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SgpiOutSummaryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SgpiOutSummaryTableMap::COL_UNIQUEID);
            $criteria->addSelectColumn(SgpiOutSummaryTableMap::COL_MOYE);
            $criteria->addSelectColumn(SgpiOutSummaryTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(SgpiOutSummaryTableMap::COL_OUTLET_ORGDATA_ID);
            $criteria->addSelectColumn(SgpiOutSummaryTableMap::COL_SGPI_TYPE);
            $criteria->addSelectColumn(SgpiOutSummaryTableMap::COL_QTY);
            $criteria->addSelectColumn(SgpiOutSummaryTableMap::COL_LASTCREATE);
        } else {
            $criteria->addSelectColumn($alias . '.uniqueid');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.outlet_orgdata_id');
            $criteria->addSelectColumn($alias . '.sgpi_type');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.lastcreate');
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
            $criteria->removeSelectColumn(SgpiOutSummaryTableMap::COL_UNIQUEID);
            $criteria->removeSelectColumn(SgpiOutSummaryTableMap::COL_MOYE);
            $criteria->removeSelectColumn(SgpiOutSummaryTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(SgpiOutSummaryTableMap::COL_OUTLET_ORGDATA_ID);
            $criteria->removeSelectColumn(SgpiOutSummaryTableMap::COL_SGPI_TYPE);
            $criteria->removeSelectColumn(SgpiOutSummaryTableMap::COL_QTY);
            $criteria->removeSelectColumn(SgpiOutSummaryTableMap::COL_LASTCREATE);
        } else {
            $criteria->removeSelectColumn($alias . '.uniqueid');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.outlet_orgdata_id');
            $criteria->removeSelectColumn($alias . '.sgpi_type');
            $criteria->removeSelectColumn($alias . '.qty');
            $criteria->removeSelectColumn($alias . '.lastcreate');
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
        return Propel::getServiceContainer()->getDatabaseMap(SgpiOutSummaryTableMap::DATABASE_NAME)->getTable(SgpiOutSummaryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SgpiOutSummary or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SgpiOutSummary object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiOutSummaryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SgpiOutSummary) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SgpiOutSummaryTableMap::DATABASE_NAME);
            $criteria->add(SgpiOutSummaryTableMap::COL_UNIQUEID, (array) $values, Criteria::IN);
        }

        $query = SgpiOutSummaryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SgpiOutSummaryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SgpiOutSummaryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sgpi_out_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SgpiOutSummaryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SgpiOutSummary or Criteria object.
     *
     * @param mixed $criteria Criteria or SgpiOutSummary object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiOutSummaryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SgpiOutSummary object
        }


        // Set the correct dbName
        $query = SgpiOutSummaryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
