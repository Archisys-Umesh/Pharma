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
use entities\OutletOrgDataKeys;
use entities\OutletOrgDataKeysQuery;


/**
 * This class defines the structure of the 'outlet_org_data_keys' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletOrgDataKeysTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletOrgDataKeysTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_org_data_keys';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletOrgDataKeys';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletOrgDataKeys';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletOrgDataKeys';

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
     * the column name for the outlet_org_data_keys_id field
     */
    public const COL_OUTLET_ORG_DATA_KEYS_ID = 'outlet_org_data_keys.outlet_org_data_keys_id';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'outlet_org_data_keys.outlet_org_data_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_org_data_keys.company_id';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'outlet_org_data_keys.key';

    /**
     * the column name for the value field
     */
    public const COL_VALUE = 'outlet_org_data_keys.value';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_org_data_keys.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_org_data_keys.updated_at';

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
        self::TYPE_PHPNAME       => ['OutletOrgDataKeysId', 'OutletOrgDataId', 'CompanyId', 'Key', 'Value', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['outletOrgDataKeysId', 'outletOrgDataId', 'companyId', 'key', 'value', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID, OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_ID, OutletOrgDataKeysTableMap::COL_COMPANY_ID, OutletOrgDataKeysTableMap::COL_KEY, OutletOrgDataKeysTableMap::COL_VALUE, OutletOrgDataKeysTableMap::COL_CREATED_AT, OutletOrgDataKeysTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['outlet_org_data_keys_id', 'outlet_org_data_id', 'company_id', 'key', 'value', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['OutletOrgDataKeysId' => 0, 'OutletOrgDataId' => 1, 'CompanyId' => 2, 'Key' => 3, 'Value' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['outletOrgDataKeysId' => 0, 'outletOrgDataId' => 1, 'companyId' => 2, 'key' => 3, 'value' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID => 0, OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_ID => 1, OutletOrgDataKeysTableMap::COL_COMPANY_ID => 2, OutletOrgDataKeysTableMap::COL_KEY => 3, OutletOrgDataKeysTableMap::COL_VALUE => 4, OutletOrgDataKeysTableMap::COL_CREATED_AT => 5, OutletOrgDataKeysTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['outlet_org_data_keys_id' => 0, 'outlet_org_data_id' => 1, 'company_id' => 2, 'key' => 3, 'value' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletOrgDataKeysId' => 'OUTLET_ORG_DATA_KEYS_ID',
        'OutletOrgDataKeys.OutletOrgDataKeysId' => 'OUTLET_ORG_DATA_KEYS_ID',
        'outletOrgDataKeysId' => 'OUTLET_ORG_DATA_KEYS_ID',
        'outletOrgDataKeys.outletOrgDataKeysId' => 'OUTLET_ORG_DATA_KEYS_ID',
        'OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID' => 'OUTLET_ORG_DATA_KEYS_ID',
        'COL_OUTLET_ORG_DATA_KEYS_ID' => 'OUTLET_ORG_DATA_KEYS_ID',
        'outlet_org_data_keys_id' => 'OUTLET_ORG_DATA_KEYS_ID',
        'outlet_org_data_keys.outlet_org_data_keys_id' => 'OUTLET_ORG_DATA_KEYS_ID',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'OutletOrgDataKeys.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataKeys.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_keys.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'CompanyId' => 'COMPANY_ID',
        'OutletOrgDataKeys.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletOrgDataKeys.companyId' => 'COMPANY_ID',
        'OutletOrgDataKeysTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_org_data_keys.company_id' => 'COMPANY_ID',
        'Key' => 'KEY',
        'OutletOrgDataKeys.Key' => 'KEY',
        'key' => 'KEY',
        'outletOrgDataKeys.key' => 'KEY',
        'OutletOrgDataKeysTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'outlet_org_data_keys.key' => 'KEY',
        'Value' => 'VALUE',
        'OutletOrgDataKeys.Value' => 'VALUE',
        'value' => 'VALUE',
        'outletOrgDataKeys.value' => 'VALUE',
        'OutletOrgDataKeysTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'outlet_org_data_keys.value' => 'VALUE',
        'CreatedAt' => 'CREATED_AT',
        'OutletOrgDataKeys.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletOrgDataKeys.createdAt' => 'CREATED_AT',
        'OutletOrgDataKeysTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_org_data_keys.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletOrgDataKeys.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletOrgDataKeys.updatedAt' => 'UPDATED_AT',
        'OutletOrgDataKeysTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_org_data_keys.updated_at' => 'UPDATED_AT',
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
        $this->setName('outlet_org_data_keys');
        $this->setPhpName('OutletOrgDataKeys');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletOrgDataKeys');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_org_data_keys_outlet_org_data_keys_id_seq');
        // columns
        $this->addPrimaryKey('outlet_org_data_keys_id', 'OutletOrgDataKeysId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, null, null);
        $this->addColumn('value', 'Value', 'VARCHAR', false, null, null);
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
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgDataKeysId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgDataKeysId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgDataKeysId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgDataKeysId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgDataKeysId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgDataKeysId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletOrgDataKeysId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletOrgDataKeysTableMap::CLASS_DEFAULT : OutletOrgDataKeysTableMap::OM_CLASS;
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
     * @return array (OutletOrgDataKeys object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletOrgDataKeysTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletOrgDataKeysTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletOrgDataKeysTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletOrgDataKeysTableMap::OM_CLASS;
            /** @var OutletOrgDataKeys $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletOrgDataKeysTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletOrgDataKeysTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletOrgDataKeysTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletOrgDataKeys $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletOrgDataKeysTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID);
            $criteria->addSelectColumn(OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(OutletOrgDataKeysTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletOrgDataKeysTableMap::COL_KEY);
            $criteria->addSelectColumn(OutletOrgDataKeysTableMap::COL_VALUE);
            $criteria->addSelectColumn(OutletOrgDataKeysTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletOrgDataKeysTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_org_data_keys_id');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.value');
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
            $criteria->removeSelectColumn(OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID);
            $criteria->removeSelectColumn(OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(OutletOrgDataKeysTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletOrgDataKeysTableMap::COL_KEY);
            $criteria->removeSelectColumn(OutletOrgDataKeysTableMap::COL_VALUE);
            $criteria->removeSelectColumn(OutletOrgDataKeysTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletOrgDataKeysTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_org_data_keys_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.value');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletOrgDataKeysTableMap::DATABASE_NAME)->getTable(OutletOrgDataKeysTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletOrgDataKeys or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletOrgDataKeys object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgDataKeysTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletOrgDataKeys) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletOrgDataKeysTableMap::DATABASE_NAME);
            $criteria->add(OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID, (array) $values, Criteria::IN);
        }

        $query = OutletOrgDataKeysQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletOrgDataKeysTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletOrgDataKeysTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_org_data_keys table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletOrgDataKeysQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletOrgDataKeys or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletOrgDataKeys object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgDataKeysTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletOrgDataKeys object
        }

        if ($criteria->containsKey(OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID) && $criteria->keyContainsValue(OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletOrgDataKeysTableMap::COL_OUTLET_ORG_DATA_KEYS_ID.')');
        }


        // Set the correct dbName
        $query = OutletOrgDataKeysQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
