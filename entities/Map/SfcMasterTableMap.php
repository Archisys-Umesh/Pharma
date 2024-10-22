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
use entities\SfcMaster;
use entities\SfcMasterQuery;


/**
 * This class defines the structure of the 'sfc_master' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SfcMasterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SfcMasterTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sfc_master';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SfcMaster';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SfcMaster';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SfcMaster';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the sfc_master_id field
     */
    public const COL_SFC_MASTER_ID = 'sfc_master.sfc_master_id';

    /**
     * the column name for the from_town_id field
     */
    public const COL_FROM_TOWN_ID = 'sfc_master.from_town_id';

    /**
     * the column name for the to_town_id field
     */
    public const COL_TO_TOWN_ID = 'sfc_master.to_town_id';

    /**
     * the column name for the trip_type field
     */
    public const COL_TRIP_TYPE = 'sfc_master.trip_type';

    /**
     * the column name for the exp_mod field
     */
    public const COL_EXP_MOD = 'sfc_master.exp_mod';

    /**
     * the column name for the value field
     */
    public const COL_VALUE = 'sfc_master.value';

    /**
     * the column name for the policy_key field
     */
    public const COL_POLICY_KEY = 'sfc_master.policy_key';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'sfc_master.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'sfc_master.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'sfc_master.updated_at';

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
        self::TYPE_PHPNAME       => ['SfcMasterId', 'FromTownId', 'ToTownId', 'TripType', 'ExpMod', 'Value', 'PolicyKey', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['sfcMasterId', 'fromTownId', 'toTownId', 'tripType', 'expMod', 'value', 'policyKey', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SfcMasterTableMap::COL_SFC_MASTER_ID, SfcMasterTableMap::COL_FROM_TOWN_ID, SfcMasterTableMap::COL_TO_TOWN_ID, SfcMasterTableMap::COL_TRIP_TYPE, SfcMasterTableMap::COL_EXP_MOD, SfcMasterTableMap::COL_VALUE, SfcMasterTableMap::COL_POLICY_KEY, SfcMasterTableMap::COL_COMPANY_ID, SfcMasterTableMap::COL_CREATED_AT, SfcMasterTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['sfc_master_id', 'from_town_id', 'to_town_id', 'trip_type', 'exp_mod', 'value', 'policy_key', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['SfcMasterId' => 0, 'FromTownId' => 1, 'ToTownId' => 2, 'TripType' => 3, 'ExpMod' => 4, 'Value' => 5, 'PolicyKey' => 6, 'CompanyId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['sfcMasterId' => 0, 'fromTownId' => 1, 'toTownId' => 2, 'tripType' => 3, 'expMod' => 4, 'value' => 5, 'policyKey' => 6, 'companyId' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SfcMasterTableMap::COL_SFC_MASTER_ID => 0, SfcMasterTableMap::COL_FROM_TOWN_ID => 1, SfcMasterTableMap::COL_TO_TOWN_ID => 2, SfcMasterTableMap::COL_TRIP_TYPE => 3, SfcMasterTableMap::COL_EXP_MOD => 4, SfcMasterTableMap::COL_VALUE => 5, SfcMasterTableMap::COL_POLICY_KEY => 6, SfcMasterTableMap::COL_COMPANY_ID => 7, SfcMasterTableMap::COL_CREATED_AT => 8, SfcMasterTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['sfc_master_id' => 0, 'from_town_id' => 1, 'to_town_id' => 2, 'trip_type' => 3, 'exp_mod' => 4, 'value' => 5, 'policy_key' => 6, 'company_id' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SfcMasterId' => 'SFC_MASTER_ID',
        'SfcMaster.SfcMasterId' => 'SFC_MASTER_ID',
        'sfcMasterId' => 'SFC_MASTER_ID',
        'sfcMaster.sfcMasterId' => 'SFC_MASTER_ID',
        'SfcMasterTableMap::COL_SFC_MASTER_ID' => 'SFC_MASTER_ID',
        'COL_SFC_MASTER_ID' => 'SFC_MASTER_ID',
        'sfc_master_id' => 'SFC_MASTER_ID',
        'sfc_master.sfc_master_id' => 'SFC_MASTER_ID',
        'FromTownId' => 'FROM_TOWN_ID',
        'SfcMaster.FromTownId' => 'FROM_TOWN_ID',
        'fromTownId' => 'FROM_TOWN_ID',
        'sfcMaster.fromTownId' => 'FROM_TOWN_ID',
        'SfcMasterTableMap::COL_FROM_TOWN_ID' => 'FROM_TOWN_ID',
        'COL_FROM_TOWN_ID' => 'FROM_TOWN_ID',
        'from_town_id' => 'FROM_TOWN_ID',
        'sfc_master.from_town_id' => 'FROM_TOWN_ID',
        'ToTownId' => 'TO_TOWN_ID',
        'SfcMaster.ToTownId' => 'TO_TOWN_ID',
        'toTownId' => 'TO_TOWN_ID',
        'sfcMaster.toTownId' => 'TO_TOWN_ID',
        'SfcMasterTableMap::COL_TO_TOWN_ID' => 'TO_TOWN_ID',
        'COL_TO_TOWN_ID' => 'TO_TOWN_ID',
        'to_town_id' => 'TO_TOWN_ID',
        'sfc_master.to_town_id' => 'TO_TOWN_ID',
        'TripType' => 'TRIP_TYPE',
        'SfcMaster.TripType' => 'TRIP_TYPE',
        'tripType' => 'TRIP_TYPE',
        'sfcMaster.tripType' => 'TRIP_TYPE',
        'SfcMasterTableMap::COL_TRIP_TYPE' => 'TRIP_TYPE',
        'COL_TRIP_TYPE' => 'TRIP_TYPE',
        'trip_type' => 'TRIP_TYPE',
        'sfc_master.trip_type' => 'TRIP_TYPE',
        'ExpMod' => 'EXP_MOD',
        'SfcMaster.ExpMod' => 'EXP_MOD',
        'expMod' => 'EXP_MOD',
        'sfcMaster.expMod' => 'EXP_MOD',
        'SfcMasterTableMap::COL_EXP_MOD' => 'EXP_MOD',
        'COL_EXP_MOD' => 'EXP_MOD',
        'exp_mod' => 'EXP_MOD',
        'sfc_master.exp_mod' => 'EXP_MOD',
        'Value' => 'VALUE',
        'SfcMaster.Value' => 'VALUE',
        'value' => 'VALUE',
        'sfcMaster.value' => 'VALUE',
        'SfcMasterTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'sfc_master.value' => 'VALUE',
        'PolicyKey' => 'POLICY_KEY',
        'SfcMaster.PolicyKey' => 'POLICY_KEY',
        'policyKey' => 'POLICY_KEY',
        'sfcMaster.policyKey' => 'POLICY_KEY',
        'SfcMasterTableMap::COL_POLICY_KEY' => 'POLICY_KEY',
        'COL_POLICY_KEY' => 'POLICY_KEY',
        'policy_key' => 'POLICY_KEY',
        'sfc_master.policy_key' => 'POLICY_KEY',
        'CompanyId' => 'COMPANY_ID',
        'SfcMaster.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'sfcMaster.companyId' => 'COMPANY_ID',
        'SfcMasterTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'sfc_master.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'SfcMaster.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'sfcMaster.createdAt' => 'CREATED_AT',
        'SfcMasterTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'sfc_master.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SfcMaster.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'sfcMaster.updatedAt' => 'UPDATED_AT',
        'SfcMasterTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'sfc_master.updated_at' => 'UPDATED_AT',
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
        $this->setName('sfc_master');
        $this->setPhpName('SfcMaster');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SfcMaster');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('sfc_master_sfc_master_id_seq');
        // columns
        $this->addPrimaryKey('sfc_master_id', 'SfcMasterId', 'INTEGER', true, null, null);
        $this->addForeignKey('from_town_id', 'FromTownId', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
        $this->addForeignKey('to_town_id', 'ToTownId', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
        $this->addColumn('trip_type', 'TripType', 'VARCHAR', false, null, null);
        $this->addColumn('exp_mod', 'ExpMod', 'VARCHAR', false, null, null);
        $this->addColumn('value', 'Value', 'DECIMAL', false, null, null);
        $this->addColumn('policy_key', 'PolicyKey', 'VARCHAR', false, null, null);
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
        $this->addRelation('GeoTownsRelatedByFromTownId', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':from_town_id',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('GeoTownsRelatedByToTownId', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':to_town_id',
    1 => ':itownid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SfcMasterId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SfcMasterId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SfcMasterId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SfcMasterId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SfcMasterId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SfcMasterId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SfcMasterId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SfcMasterTableMap::CLASS_DEFAULT : SfcMasterTableMap::OM_CLASS;
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
     * @return array (SfcMaster object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SfcMasterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SfcMasterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SfcMasterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SfcMasterTableMap::OM_CLASS;
            /** @var SfcMaster $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SfcMasterTableMap::addInstanceToPool($obj, $key);
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
            $key = SfcMasterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SfcMasterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SfcMaster $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SfcMasterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SfcMasterTableMap::COL_SFC_MASTER_ID);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_FROM_TOWN_ID);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_TO_TOWN_ID);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_TRIP_TYPE);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_EXP_MOD);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_VALUE);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_POLICY_KEY);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SfcMasterTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.sfc_master_id');
            $criteria->addSelectColumn($alias . '.from_town_id');
            $criteria->addSelectColumn($alias . '.to_town_id');
            $criteria->addSelectColumn($alias . '.trip_type');
            $criteria->addSelectColumn($alias . '.exp_mod');
            $criteria->addSelectColumn($alias . '.value');
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
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_SFC_MASTER_ID);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_FROM_TOWN_ID);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_TO_TOWN_ID);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_TRIP_TYPE);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_EXP_MOD);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_VALUE);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_POLICY_KEY);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SfcMasterTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.sfc_master_id');
            $criteria->removeSelectColumn($alias . '.from_town_id');
            $criteria->removeSelectColumn($alias . '.to_town_id');
            $criteria->removeSelectColumn($alias . '.trip_type');
            $criteria->removeSelectColumn($alias . '.exp_mod');
            $criteria->removeSelectColumn($alias . '.value');
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
        return Propel::getServiceContainer()->getDatabaseMap(SfcMasterTableMap::DATABASE_NAME)->getTable(SfcMasterTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SfcMaster or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SfcMaster object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SfcMasterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SfcMaster) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SfcMasterTableMap::DATABASE_NAME);
            $criteria->add(SfcMasterTableMap::COL_SFC_MASTER_ID, (array) $values, Criteria::IN);
        }

        $query = SfcMasterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SfcMasterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SfcMasterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sfc_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SfcMasterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SfcMaster or Criteria object.
     *
     * @param mixed $criteria Criteria or SfcMaster object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SfcMasterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SfcMaster object
        }

        if ($criteria->containsKey(SfcMasterTableMap::COL_SFC_MASTER_ID) && $criteria->keyContainsValue(SfcMasterTableMap::COL_SFC_MASTER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SfcMasterTableMap::COL_SFC_MASTER_ID.')');
        }


        // Set the correct dbName
        $query = SfcMasterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
