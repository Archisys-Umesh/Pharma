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
use entities\OutletMapping;
use entities\OutletMappingQuery;


/**
 * This class defines the structure of the 'outlet_mapping' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletMappingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletMappingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_mapping';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletMapping';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletMapping';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletMapping';

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
     * the column name for the mapping_id field
     */
    public const COL_MAPPING_ID = 'outlet_mapping.mapping_id';

    /**
     * the column name for the primary_outlet_id field
     */
    public const COL_PRIMARY_OUTLET_ID = 'outlet_mapping.primary_outlet_id';

    /**
     * the column name for the secondary_outlet_id field
     */
    public const COL_SECONDARY_OUTLET_ID = 'outlet_mapping.secondary_outlet_id';

    /**
     * the column name for the pricebook_id field
     */
    public const COL_PRICEBOOK_ID = 'outlet_mapping.pricebook_id';

    /**
     * the column name for the isdefault field
     */
    public const COL_ISDEFAULT = 'outlet_mapping.isdefault';

    /**
     * the column name for the category_type field
     */
    public const COL_CATEGORY_TYPE = 'outlet_mapping.category_type';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_mapping.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_mapping.updated_at';

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
        self::TYPE_PHPNAME       => ['MappingId', 'PrimaryOutletId', 'SecondaryOutletId', 'PricebookId', 'Isdefault', 'CategoryType', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['mappingId', 'primaryOutletId', 'secondaryOutletId', 'pricebookId', 'isdefault', 'categoryType', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [OutletMappingTableMap::COL_MAPPING_ID, OutletMappingTableMap::COL_PRIMARY_OUTLET_ID, OutletMappingTableMap::COL_SECONDARY_OUTLET_ID, OutletMappingTableMap::COL_PRICEBOOK_ID, OutletMappingTableMap::COL_ISDEFAULT, OutletMappingTableMap::COL_CATEGORY_TYPE, OutletMappingTableMap::COL_CREATED_AT, OutletMappingTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['mapping_id', 'primary_outlet_id', 'secondary_outlet_id', 'pricebook_id', 'isdefault', 'category_type', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['MappingId' => 0, 'PrimaryOutletId' => 1, 'SecondaryOutletId' => 2, 'PricebookId' => 3, 'Isdefault' => 4, 'CategoryType' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['mappingId' => 0, 'primaryOutletId' => 1, 'secondaryOutletId' => 2, 'pricebookId' => 3, 'isdefault' => 4, 'categoryType' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [OutletMappingTableMap::COL_MAPPING_ID => 0, OutletMappingTableMap::COL_PRIMARY_OUTLET_ID => 1, OutletMappingTableMap::COL_SECONDARY_OUTLET_ID => 2, OutletMappingTableMap::COL_PRICEBOOK_ID => 3, OutletMappingTableMap::COL_ISDEFAULT => 4, OutletMappingTableMap::COL_CATEGORY_TYPE => 5, OutletMappingTableMap::COL_CREATED_AT => 6, OutletMappingTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['mapping_id' => 0, 'primary_outlet_id' => 1, 'secondary_outlet_id' => 2, 'pricebook_id' => 3, 'isdefault' => 4, 'category_type' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'MappingId' => 'MAPPING_ID',
        'OutletMapping.MappingId' => 'MAPPING_ID',
        'mappingId' => 'MAPPING_ID',
        'outletMapping.mappingId' => 'MAPPING_ID',
        'OutletMappingTableMap::COL_MAPPING_ID' => 'MAPPING_ID',
        'COL_MAPPING_ID' => 'MAPPING_ID',
        'mapping_id' => 'MAPPING_ID',
        'outlet_mapping.mapping_id' => 'MAPPING_ID',
        'PrimaryOutletId' => 'PRIMARY_OUTLET_ID',
        'OutletMapping.PrimaryOutletId' => 'PRIMARY_OUTLET_ID',
        'primaryOutletId' => 'PRIMARY_OUTLET_ID',
        'outletMapping.primaryOutletId' => 'PRIMARY_OUTLET_ID',
        'OutletMappingTableMap::COL_PRIMARY_OUTLET_ID' => 'PRIMARY_OUTLET_ID',
        'COL_PRIMARY_OUTLET_ID' => 'PRIMARY_OUTLET_ID',
        'primary_outlet_id' => 'PRIMARY_OUTLET_ID',
        'outlet_mapping.primary_outlet_id' => 'PRIMARY_OUTLET_ID',
        'SecondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'OutletMapping.SecondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'secondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'outletMapping.secondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'OutletMappingTableMap::COL_SECONDARY_OUTLET_ID' => 'SECONDARY_OUTLET_ID',
        'COL_SECONDARY_OUTLET_ID' => 'SECONDARY_OUTLET_ID',
        'secondary_outlet_id' => 'SECONDARY_OUTLET_ID',
        'outlet_mapping.secondary_outlet_id' => 'SECONDARY_OUTLET_ID',
        'PricebookId' => 'PRICEBOOK_ID',
        'OutletMapping.PricebookId' => 'PRICEBOOK_ID',
        'pricebookId' => 'PRICEBOOK_ID',
        'outletMapping.pricebookId' => 'PRICEBOOK_ID',
        'OutletMappingTableMap::COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'pricebook_id' => 'PRICEBOOK_ID',
        'outlet_mapping.pricebook_id' => 'PRICEBOOK_ID',
        'Isdefault' => 'ISDEFAULT',
        'OutletMapping.Isdefault' => 'ISDEFAULT',
        'isdefault' => 'ISDEFAULT',
        'outletMapping.isdefault' => 'ISDEFAULT',
        'OutletMappingTableMap::COL_ISDEFAULT' => 'ISDEFAULT',
        'COL_ISDEFAULT' => 'ISDEFAULT',
        'outlet_mapping.isdefault' => 'ISDEFAULT',
        'CategoryType' => 'CATEGORY_TYPE',
        'OutletMapping.CategoryType' => 'CATEGORY_TYPE',
        'categoryType' => 'CATEGORY_TYPE',
        'outletMapping.categoryType' => 'CATEGORY_TYPE',
        'OutletMappingTableMap::COL_CATEGORY_TYPE' => 'CATEGORY_TYPE',
        'COL_CATEGORY_TYPE' => 'CATEGORY_TYPE',
        'category_type' => 'CATEGORY_TYPE',
        'outlet_mapping.category_type' => 'CATEGORY_TYPE',
        'CreatedAt' => 'CREATED_AT',
        'OutletMapping.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletMapping.createdAt' => 'CREATED_AT',
        'OutletMappingTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_mapping.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletMapping.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletMapping.updatedAt' => 'UPDATED_AT',
        'OutletMappingTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_mapping.updated_at' => 'UPDATED_AT',
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
        $this->setName('outlet_mapping');
        $this->setPhpName('OutletMapping');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletMapping');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_mapping_mapping_id_seq');
        // columns
        $this->addPrimaryKey('mapping_id', 'MappingId', 'INTEGER', true, null, null);
        $this->addForeignKey('primary_outlet_id', 'PrimaryOutletId', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addColumn('secondary_outlet_id', 'SecondaryOutletId', 'INTEGER', false, null, null);
        $this->addForeignKey('pricebook_id', 'PricebookId', 'INTEGER', 'pricebooks', 'pricebook_id', false, null, null);
        $this->addColumn('isdefault', 'Isdefault', 'INTEGER', true, null, 0);
        $this->addColumn('category_type', 'CategoryType', 'VARCHAR', true, 50, '0');
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
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':primary_outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Pricebooks', '\\entities\\Pricebooks', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':pricebook_id',
    1 => ':pricebook_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletMappingTableMap::CLASS_DEFAULT : OutletMappingTableMap::OM_CLASS;
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
     * @return array (OutletMapping object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletMappingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletMappingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletMappingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletMappingTableMap::OM_CLASS;
            /** @var OutletMapping $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletMappingTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletMappingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletMappingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletMapping $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletMappingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletMappingTableMap::COL_MAPPING_ID);
            $criteria->addSelectColumn(OutletMappingTableMap::COL_PRIMARY_OUTLET_ID);
            $criteria->addSelectColumn(OutletMappingTableMap::COL_SECONDARY_OUTLET_ID);
            $criteria->addSelectColumn(OutletMappingTableMap::COL_PRICEBOOK_ID);
            $criteria->addSelectColumn(OutletMappingTableMap::COL_ISDEFAULT);
            $criteria->addSelectColumn(OutletMappingTableMap::COL_CATEGORY_TYPE);
            $criteria->addSelectColumn(OutletMappingTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletMappingTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.mapping_id');
            $criteria->addSelectColumn($alias . '.primary_outlet_id');
            $criteria->addSelectColumn($alias . '.secondary_outlet_id');
            $criteria->addSelectColumn($alias . '.pricebook_id');
            $criteria->addSelectColumn($alias . '.isdefault');
            $criteria->addSelectColumn($alias . '.category_type');
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
            $criteria->removeSelectColumn(OutletMappingTableMap::COL_MAPPING_ID);
            $criteria->removeSelectColumn(OutletMappingTableMap::COL_PRIMARY_OUTLET_ID);
            $criteria->removeSelectColumn(OutletMappingTableMap::COL_SECONDARY_OUTLET_ID);
            $criteria->removeSelectColumn(OutletMappingTableMap::COL_PRICEBOOK_ID);
            $criteria->removeSelectColumn(OutletMappingTableMap::COL_ISDEFAULT);
            $criteria->removeSelectColumn(OutletMappingTableMap::COL_CATEGORY_TYPE);
            $criteria->removeSelectColumn(OutletMappingTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletMappingTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.mapping_id');
            $criteria->removeSelectColumn($alias . '.primary_outlet_id');
            $criteria->removeSelectColumn($alias . '.secondary_outlet_id');
            $criteria->removeSelectColumn($alias . '.pricebook_id');
            $criteria->removeSelectColumn($alias . '.isdefault');
            $criteria->removeSelectColumn($alias . '.category_type');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletMappingTableMap::DATABASE_NAME)->getTable(OutletMappingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletMapping or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletMapping object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletMappingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletMapping) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletMappingTableMap::DATABASE_NAME);
            $criteria->add(OutletMappingTableMap::COL_MAPPING_ID, (array) $values, Criteria::IN);
        }

        $query = OutletMappingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletMappingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletMappingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletMappingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletMapping or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletMapping object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletMappingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletMapping object
        }

        if ($criteria->containsKey(OutletMappingTableMap::COL_MAPPING_ID) && $criteria->keyContainsValue(OutletMappingTableMap::COL_MAPPING_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletMappingTableMap::COL_MAPPING_ID.')');
        }


        // Set the correct dbName
        $query = OutletMappingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
