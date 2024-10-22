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
use entities\OutletOutcomes;
use entities\OutletOutcomesQuery;


/**
 * This class defines the structure of the 'outlet_outcomes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletOutcomesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletOutcomesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_outcomes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletOutcomes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletOutcomes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletOutcomes';

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
     * the column name for the outlet_outcome_id field
     */
    public const COL_OUTLET_OUTCOME_ID = 'outlet_outcomes.outlet_outcome_id';

    /**
     * the column name for the reason field
     */
    public const COL_REASON = 'outlet_outcomes.reason';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'outlet_outcomes.type';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_outcomes.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_outcomes.updated_at';

    /**
     * the column name for the outlet_type_id field
     */
    public const COL_OUTLET_TYPE_ID = 'outlet_outcomes.outlet_type_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_outcomes.company_id';

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
        self::TYPE_PHPNAME       => ['OutletOutcomeId', 'Reason', 'Type', 'CreatedAt', 'UpdatedAt', 'OutletTypeId', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['outletOutcomeId', 'reason', 'type', 'createdAt', 'updatedAt', 'outletTypeId', 'companyId', ],
        self::TYPE_COLNAME       => [OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID, OutletOutcomesTableMap::COL_REASON, OutletOutcomesTableMap::COL_TYPE, OutletOutcomesTableMap::COL_CREATED_AT, OutletOutcomesTableMap::COL_UPDATED_AT, OutletOutcomesTableMap::COL_OUTLET_TYPE_ID, OutletOutcomesTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['outlet_outcome_id', 'reason', 'type', 'created_at', 'updated_at', 'outlet_type_id', 'company_id', ],
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
        self::TYPE_PHPNAME       => ['OutletOutcomeId' => 0, 'Reason' => 1, 'Type' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'OutletTypeId' => 5, 'CompanyId' => 6, ],
        self::TYPE_CAMELNAME     => ['outletOutcomeId' => 0, 'reason' => 1, 'type' => 2, 'createdAt' => 3, 'updatedAt' => 4, 'outletTypeId' => 5, 'companyId' => 6, ],
        self::TYPE_COLNAME       => [OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID => 0, OutletOutcomesTableMap::COL_REASON => 1, OutletOutcomesTableMap::COL_TYPE => 2, OutletOutcomesTableMap::COL_CREATED_AT => 3, OutletOutcomesTableMap::COL_UPDATED_AT => 4, OutletOutcomesTableMap::COL_OUTLET_TYPE_ID => 5, OutletOutcomesTableMap::COL_COMPANY_ID => 6, ],
        self::TYPE_FIELDNAME     => ['outlet_outcome_id' => 0, 'reason' => 1, 'type' => 2, 'created_at' => 3, 'updated_at' => 4, 'outlet_type_id' => 5, 'company_id' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletOutcomeId' => 'OUTLET_OUTCOME_ID',
        'OutletOutcomes.OutletOutcomeId' => 'OUTLET_OUTCOME_ID',
        'outletOutcomeId' => 'OUTLET_OUTCOME_ID',
        'outletOutcomes.outletOutcomeId' => 'OUTLET_OUTCOME_ID',
        'OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID' => 'OUTLET_OUTCOME_ID',
        'COL_OUTLET_OUTCOME_ID' => 'OUTLET_OUTCOME_ID',
        'outlet_outcome_id' => 'OUTLET_OUTCOME_ID',
        'outlet_outcomes.outlet_outcome_id' => 'OUTLET_OUTCOME_ID',
        'Reason' => 'REASON',
        'OutletOutcomes.Reason' => 'REASON',
        'reason' => 'REASON',
        'outletOutcomes.reason' => 'REASON',
        'OutletOutcomesTableMap::COL_REASON' => 'REASON',
        'COL_REASON' => 'REASON',
        'outlet_outcomes.reason' => 'REASON',
        'Type' => 'TYPE',
        'OutletOutcomes.Type' => 'TYPE',
        'type' => 'TYPE',
        'outletOutcomes.type' => 'TYPE',
        'OutletOutcomesTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'outlet_outcomes.type' => 'TYPE',
        'CreatedAt' => 'CREATED_AT',
        'OutletOutcomes.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletOutcomes.createdAt' => 'CREATED_AT',
        'OutletOutcomesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_outcomes.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletOutcomes.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletOutcomes.updatedAt' => 'UPDATED_AT',
        'OutletOutcomesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_outcomes.updated_at' => 'UPDATED_AT',
        'OutletTypeId' => 'OUTLET_TYPE_ID',
        'OutletOutcomes.OutletTypeId' => 'OUTLET_TYPE_ID',
        'outletTypeId' => 'OUTLET_TYPE_ID',
        'outletOutcomes.outletTypeId' => 'OUTLET_TYPE_ID',
        'OutletOutcomesTableMap::COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'outlet_type_id' => 'OUTLET_TYPE_ID',
        'outlet_outcomes.outlet_type_id' => 'OUTLET_TYPE_ID',
        'CompanyId' => 'COMPANY_ID',
        'OutletOutcomes.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletOutcomes.companyId' => 'COMPANY_ID',
        'OutletOutcomesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_outcomes.company_id' => 'COMPANY_ID',
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
        $this->setName('outlet_outcomes');
        $this->setPhpName('OutletOutcomes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletOutcomes');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_outcomes_outlet_outcome_id_seq');
        // columns
        $this->addPrimaryKey('outlet_outcome_id', 'OutletOutcomeId', 'INTEGER', true, null, null);
        $this->addColumn('reason', 'Reason', 'VARCHAR', false, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('outlet_type_id', 'OutletTypeId', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
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
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_type_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOutcomeId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOutcomeId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOutcomeId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOutcomeId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOutcomeId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOutcomeId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletOutcomeId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletOutcomesTableMap::CLASS_DEFAULT : OutletOutcomesTableMap::OM_CLASS;
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
     * @return array (OutletOutcomes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletOutcomesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletOutcomesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletOutcomesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletOutcomesTableMap::OM_CLASS;
            /** @var OutletOutcomes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletOutcomesTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletOutcomesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletOutcomesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletOutcomes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletOutcomesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID);
            $criteria->addSelectColumn(OutletOutcomesTableMap::COL_REASON);
            $criteria->addSelectColumn(OutletOutcomesTableMap::COL_TYPE);
            $criteria->addSelectColumn(OutletOutcomesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletOutcomesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletOutcomesTableMap::COL_OUTLET_TYPE_ID);
            $criteria->addSelectColumn(OutletOutcomesTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_outcome_id');
            $criteria->addSelectColumn($alias . '.reason');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.outlet_type_id');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID);
            $criteria->removeSelectColumn(OutletOutcomesTableMap::COL_REASON);
            $criteria->removeSelectColumn(OutletOutcomesTableMap::COL_TYPE);
            $criteria->removeSelectColumn(OutletOutcomesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletOutcomesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletOutcomesTableMap::COL_OUTLET_TYPE_ID);
            $criteria->removeSelectColumn(OutletOutcomesTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_outcome_id');
            $criteria->removeSelectColumn($alias . '.reason');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.outlet_type_id');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletOutcomesTableMap::DATABASE_NAME)->getTable(OutletOutcomesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletOutcomes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletOutcomes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOutcomesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletOutcomes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletOutcomesTableMap::DATABASE_NAME);
            $criteria->add(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID, (array) $values, Criteria::IN);
        }

        $query = OutletOutcomesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletOutcomesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletOutcomesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_outcomes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletOutcomesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletOutcomes or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletOutcomes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOutcomesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletOutcomes object
        }

        if ($criteria->containsKey(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID) && $criteria->keyContainsValue(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID.')');
        }


        // Set the correct dbName
        $query = OutletOutcomesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
