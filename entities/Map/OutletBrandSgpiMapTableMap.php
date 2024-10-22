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
use entities\OutletBrandSgpiMap;
use entities\OutletBrandSgpiMapQuery;


/**
 * This class defines the structure of the 'outlet_brand_sgpi_map' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletBrandSgpiMapTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletBrandSgpiMapTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_brand_sgpi_map';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletBrandSgpiMap';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletBrandSgpiMap';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletBrandSgpiMap';

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
     * the column name for the sgpimap_id field
     */
    public const COL_SGPIMAP_ID = 'outlet_brand_sgpi_map.sgpimap_id';

    /**
     * the column name for the org_data_id field
     */
    public const COL_ORG_DATA_ID = 'outlet_brand_sgpi_map.org_data_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'outlet_brand_sgpi_map.brand_id';

    /**
     * the column name for the sgpi_status field
     */
    public const COL_SGPI_STATUS = 'outlet_brand_sgpi_map.sgpi_status';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_brand_sgpi_map.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_brand_sgpi_map.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_brand_sgpi_map.updated_at';

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
        self::TYPE_PHPNAME       => ['SgpimapId', 'OrgDataId', 'BrandId', 'SgpiStatus', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['sgpimapId', 'orgDataId', 'brandId', 'sgpiStatus', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID, OutletBrandSgpiMapTableMap::COL_ORG_DATA_ID, OutletBrandSgpiMapTableMap::COL_BRAND_ID, OutletBrandSgpiMapTableMap::COL_SGPI_STATUS, OutletBrandSgpiMapTableMap::COL_COMPANY_ID, OutletBrandSgpiMapTableMap::COL_CREATED_AT, OutletBrandSgpiMapTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['sgpimap_id', 'org_data_id', 'brand_id', 'sgpi_status', 'company_id', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['SgpimapId' => 0, 'OrgDataId' => 1, 'BrandId' => 2, 'SgpiStatus' => 3, 'CompanyId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['sgpimapId' => 0, 'orgDataId' => 1, 'brandId' => 2, 'sgpiStatus' => 3, 'companyId' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID => 0, OutletBrandSgpiMapTableMap::COL_ORG_DATA_ID => 1, OutletBrandSgpiMapTableMap::COL_BRAND_ID => 2, OutletBrandSgpiMapTableMap::COL_SGPI_STATUS => 3, OutletBrandSgpiMapTableMap::COL_COMPANY_ID => 4, OutletBrandSgpiMapTableMap::COL_CREATED_AT => 5, OutletBrandSgpiMapTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['sgpimap_id' => 0, 'org_data_id' => 1, 'brand_id' => 2, 'sgpi_status' => 3, 'company_id' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpimapId' => 'SGPIMAP_ID',
        'OutletBrandSgpiMap.SgpimapId' => 'SGPIMAP_ID',
        'sgpimapId' => 'SGPIMAP_ID',
        'outletBrandSgpiMap.sgpimapId' => 'SGPIMAP_ID',
        'OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID' => 'SGPIMAP_ID',
        'COL_SGPIMAP_ID' => 'SGPIMAP_ID',
        'sgpimap_id' => 'SGPIMAP_ID',
        'outlet_brand_sgpi_map.sgpimap_id' => 'SGPIMAP_ID',
        'OrgDataId' => 'ORG_DATA_ID',
        'OutletBrandSgpiMap.OrgDataId' => 'ORG_DATA_ID',
        'orgDataId' => 'ORG_DATA_ID',
        'outletBrandSgpiMap.orgDataId' => 'ORG_DATA_ID',
        'OutletBrandSgpiMapTableMap::COL_ORG_DATA_ID' => 'ORG_DATA_ID',
        'COL_ORG_DATA_ID' => 'ORG_DATA_ID',
        'org_data_id' => 'ORG_DATA_ID',
        'outlet_brand_sgpi_map.org_data_id' => 'ORG_DATA_ID',
        'BrandId' => 'BRAND_ID',
        'OutletBrandSgpiMap.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'outletBrandSgpiMap.brandId' => 'BRAND_ID',
        'OutletBrandSgpiMapTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'outlet_brand_sgpi_map.brand_id' => 'BRAND_ID',
        'SgpiStatus' => 'SGPI_STATUS',
        'OutletBrandSgpiMap.SgpiStatus' => 'SGPI_STATUS',
        'sgpiStatus' => 'SGPI_STATUS',
        'outletBrandSgpiMap.sgpiStatus' => 'SGPI_STATUS',
        'OutletBrandSgpiMapTableMap::COL_SGPI_STATUS' => 'SGPI_STATUS',
        'COL_SGPI_STATUS' => 'SGPI_STATUS',
        'sgpi_status' => 'SGPI_STATUS',
        'outlet_brand_sgpi_map.sgpi_status' => 'SGPI_STATUS',
        'CompanyId' => 'COMPANY_ID',
        'OutletBrandSgpiMap.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletBrandSgpiMap.companyId' => 'COMPANY_ID',
        'OutletBrandSgpiMapTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_brand_sgpi_map.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'OutletBrandSgpiMap.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletBrandSgpiMap.createdAt' => 'CREATED_AT',
        'OutletBrandSgpiMapTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_brand_sgpi_map.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletBrandSgpiMap.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletBrandSgpiMap.updatedAt' => 'UPDATED_AT',
        'OutletBrandSgpiMapTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_brand_sgpi_map.updated_at' => 'UPDATED_AT',
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
        $this->setName('outlet_brand_sgpi_map');
        $this->setPhpName('OutletBrandSgpiMap');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletBrandSgpiMap');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_brand_sgpi_map_sgpimap_id_seq');
        // columns
        $this->addPrimaryKey('sgpimap_id', 'SgpimapId', 'BIGINT', true, null, null);
        $this->addColumn('org_data_id', 'OrgDataId', 'INTEGER', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_status', 'SgpiStatus', 'BOOLEAN', false, 1, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpimapId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpimapId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpimapId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpimapId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpimapId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpimapId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SgpimapId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletBrandSgpiMapTableMap::CLASS_DEFAULT : OutletBrandSgpiMapTableMap::OM_CLASS;
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
     * @return array (OutletBrandSgpiMap object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletBrandSgpiMapTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletBrandSgpiMapTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletBrandSgpiMapTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletBrandSgpiMapTableMap::OM_CLASS;
            /** @var OutletBrandSgpiMap $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletBrandSgpiMapTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletBrandSgpiMapTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletBrandSgpiMapTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletBrandSgpiMap $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletBrandSgpiMapTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID);
            $criteria->addSelectColumn(OutletBrandSgpiMapTableMap::COL_ORG_DATA_ID);
            $criteria->addSelectColumn(OutletBrandSgpiMapTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(OutletBrandSgpiMapTableMap::COL_SGPI_STATUS);
            $criteria->addSelectColumn(OutletBrandSgpiMapTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletBrandSgpiMapTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletBrandSgpiMapTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.sgpimap_id');
            $criteria->addSelectColumn($alias . '.org_data_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.sgpi_status');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID);
            $criteria->removeSelectColumn(OutletBrandSgpiMapTableMap::COL_ORG_DATA_ID);
            $criteria->removeSelectColumn(OutletBrandSgpiMapTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(OutletBrandSgpiMapTableMap::COL_SGPI_STATUS);
            $criteria->removeSelectColumn(OutletBrandSgpiMapTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletBrandSgpiMapTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletBrandSgpiMapTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpimap_id');
            $criteria->removeSelectColumn($alias . '.org_data_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.sgpi_status');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletBrandSgpiMapTableMap::DATABASE_NAME)->getTable(OutletBrandSgpiMapTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletBrandSgpiMap or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletBrandSgpiMap object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletBrandSgpiMapTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletBrandSgpiMap) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletBrandSgpiMapTableMap::DATABASE_NAME);
            $criteria->add(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID, (array) $values, Criteria::IN);
        }

        $query = OutletBrandSgpiMapQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletBrandSgpiMapTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletBrandSgpiMapTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_brand_sgpi_map table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletBrandSgpiMapQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletBrandSgpiMap or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletBrandSgpiMap object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletBrandSgpiMapTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletBrandSgpiMap object
        }

        if ($criteria->containsKey(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID) && $criteria->keyContainsValue(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID.')');
        }


        // Set the correct dbName
        $query = OutletBrandSgpiMapQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
