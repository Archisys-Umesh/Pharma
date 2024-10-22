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
use entities\TaConfiguration;
use entities\TaConfigurationQuery;


/**
 * This class defines the structure of the 'ta_configuration' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TaConfigurationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TaConfigurationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ta_configuration';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TaConfiguration';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TaConfiguration';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TaConfiguration';

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
     * the column name for the ta_config_id field
     */
    public const COL_TA_CONFIG_ID = 'ta_configuration.ta_config_id';

    /**
     * the column name for the from_km field
     */
    public const COL_FROM_KM = 'ta_configuration.from_km';

    /**
     * the column name for the to_km field
     */
    public const COL_TO_KM = 'ta_configuration.to_km';

    /**
     * the column name for the policy_key field
     */
    public const COL_POLICY_KEY = 'ta_configuration.policy_key';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ta_configuration.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ta_configuration.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ta_configuration.updated_at';

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
        self::TYPE_PHPNAME       => ['TaConfigId', 'FromKm', 'ToKm', 'PolicyKey', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['taConfigId', 'fromKm', 'toKm', 'policyKey', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [TaConfigurationTableMap::COL_TA_CONFIG_ID, TaConfigurationTableMap::COL_FROM_KM, TaConfigurationTableMap::COL_TO_KM, TaConfigurationTableMap::COL_POLICY_KEY, TaConfigurationTableMap::COL_COMPANY_ID, TaConfigurationTableMap::COL_CREATED_AT, TaConfigurationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['ta_config_id', 'from_km', 'to_km', 'policy_key', 'company_id', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['TaConfigId' => 0, 'FromKm' => 1, 'ToKm' => 2, 'PolicyKey' => 3, 'CompanyId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['taConfigId' => 0, 'fromKm' => 1, 'toKm' => 2, 'policyKey' => 3, 'companyId' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [TaConfigurationTableMap::COL_TA_CONFIG_ID => 0, TaConfigurationTableMap::COL_FROM_KM => 1, TaConfigurationTableMap::COL_TO_KM => 2, TaConfigurationTableMap::COL_POLICY_KEY => 3, TaConfigurationTableMap::COL_COMPANY_ID => 4, TaConfigurationTableMap::COL_CREATED_AT => 5, TaConfigurationTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['ta_config_id' => 0, 'from_km' => 1, 'to_km' => 2, 'policy_key' => 3, 'company_id' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TaConfigId' => 'TA_CONFIG_ID',
        'TaConfiguration.TaConfigId' => 'TA_CONFIG_ID',
        'taConfigId' => 'TA_CONFIG_ID',
        'taConfiguration.taConfigId' => 'TA_CONFIG_ID',
        'TaConfigurationTableMap::COL_TA_CONFIG_ID' => 'TA_CONFIG_ID',
        'COL_TA_CONFIG_ID' => 'TA_CONFIG_ID',
        'ta_config_id' => 'TA_CONFIG_ID',
        'ta_configuration.ta_config_id' => 'TA_CONFIG_ID',
        'FromKm' => 'FROM_KM',
        'TaConfiguration.FromKm' => 'FROM_KM',
        'fromKm' => 'FROM_KM',
        'taConfiguration.fromKm' => 'FROM_KM',
        'TaConfigurationTableMap::COL_FROM_KM' => 'FROM_KM',
        'COL_FROM_KM' => 'FROM_KM',
        'from_km' => 'FROM_KM',
        'ta_configuration.from_km' => 'FROM_KM',
        'ToKm' => 'TO_KM',
        'TaConfiguration.ToKm' => 'TO_KM',
        'toKm' => 'TO_KM',
        'taConfiguration.toKm' => 'TO_KM',
        'TaConfigurationTableMap::COL_TO_KM' => 'TO_KM',
        'COL_TO_KM' => 'TO_KM',
        'to_km' => 'TO_KM',
        'ta_configuration.to_km' => 'TO_KM',
        'PolicyKey' => 'POLICY_KEY',
        'TaConfiguration.PolicyKey' => 'POLICY_KEY',
        'policyKey' => 'POLICY_KEY',
        'taConfiguration.policyKey' => 'POLICY_KEY',
        'TaConfigurationTableMap::COL_POLICY_KEY' => 'POLICY_KEY',
        'COL_POLICY_KEY' => 'POLICY_KEY',
        'policy_key' => 'POLICY_KEY',
        'ta_configuration.policy_key' => 'POLICY_KEY',
        'CompanyId' => 'COMPANY_ID',
        'TaConfiguration.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'taConfiguration.companyId' => 'COMPANY_ID',
        'TaConfigurationTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ta_configuration.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'TaConfiguration.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'taConfiguration.createdAt' => 'CREATED_AT',
        'TaConfigurationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ta_configuration.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'TaConfiguration.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'taConfiguration.updatedAt' => 'UPDATED_AT',
        'TaConfigurationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ta_configuration.updated_at' => 'UPDATED_AT',
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
        $this->setName('ta_configuration');
        $this->setPhpName('TaConfiguration');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TaConfiguration');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ta_configuration_ta_config_id_seq');
        // columns
        $this->addPrimaryKey('ta_config_id', 'TaConfigId', 'INTEGER', true, null, null);
        $this->addColumn('from_km', 'FromKm', 'INTEGER', false, null, null);
        $this->addColumn('to_km', 'ToKm', 'INTEGER', false, null, null);
        $this->addColumn('policy_key', 'PolicyKey', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
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
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaConfigId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaConfigId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaConfigId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaConfigId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaConfigId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaConfigId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('TaConfigId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TaConfigurationTableMap::CLASS_DEFAULT : TaConfigurationTableMap::OM_CLASS;
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
     * @return array (TaConfiguration object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TaConfigurationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TaConfigurationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TaConfigurationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TaConfigurationTableMap::OM_CLASS;
            /** @var TaConfiguration $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TaConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $key = TaConfigurationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TaConfigurationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TaConfiguration $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TaConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TaConfigurationTableMap::COL_TA_CONFIG_ID);
            $criteria->addSelectColumn(TaConfigurationTableMap::COL_FROM_KM);
            $criteria->addSelectColumn(TaConfigurationTableMap::COL_TO_KM);
            $criteria->addSelectColumn(TaConfigurationTableMap::COL_POLICY_KEY);
            $criteria->addSelectColumn(TaConfigurationTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TaConfigurationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TaConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ta_config_id');
            $criteria->addSelectColumn($alias . '.from_km');
            $criteria->addSelectColumn($alias . '.to_km');
            $criteria->addSelectColumn($alias . '.policy_key');
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
            $criteria->removeSelectColumn(TaConfigurationTableMap::COL_TA_CONFIG_ID);
            $criteria->removeSelectColumn(TaConfigurationTableMap::COL_FROM_KM);
            $criteria->removeSelectColumn(TaConfigurationTableMap::COL_TO_KM);
            $criteria->removeSelectColumn(TaConfigurationTableMap::COL_POLICY_KEY);
            $criteria->removeSelectColumn(TaConfigurationTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TaConfigurationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TaConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.ta_config_id');
            $criteria->removeSelectColumn($alias . '.from_km');
            $criteria->removeSelectColumn($alias . '.to_km');
            $criteria->removeSelectColumn($alias . '.policy_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(TaConfigurationTableMap::DATABASE_NAME)->getTable(TaConfigurationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TaConfiguration or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TaConfiguration object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TaConfigurationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TaConfiguration) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TaConfigurationTableMap::DATABASE_NAME);
            $criteria->add(TaConfigurationTableMap::COL_TA_CONFIG_ID, (array) $values, Criteria::IN);
        }

        $query = TaConfigurationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TaConfigurationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TaConfigurationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ta_configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TaConfigurationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TaConfiguration or Criteria object.
     *
     * @param mixed $criteria Criteria or TaConfiguration object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TaConfigurationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TaConfiguration object
        }

        if ($criteria->containsKey(TaConfigurationTableMap::COL_TA_CONFIG_ID) && $criteria->keyContainsValue(TaConfigurationTableMap::COL_TA_CONFIG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TaConfigurationTableMap::COL_TA_CONFIG_ID.')');
        }


        // Set the correct dbName
        $query = TaConfigurationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
