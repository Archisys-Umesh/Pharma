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
use entities\CheckinoutOutcomes;
use entities\CheckinoutOutcomesQuery;


/**
 * This class defines the structure of the 'checkinout_outcomes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CheckinoutOutcomesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CheckinoutOutcomesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'checkinout_outcomes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'CheckinoutOutcomes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\CheckinoutOutcomes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.CheckinoutOutcomes';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'checkinout_outcomes.id';

    /**
     * the column name for the outcome_name field
     */
    public const COL_OUTCOME_NAME = 'checkinout_outcomes.outcome_name';

    /**
     * the column name for the outcome_factor field
     */
    public const COL_OUTCOME_FACTOR = 'checkinout_outcomes.outcome_factor';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'checkinout_outcomes.company_id';

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
        self::TYPE_PHPNAME       => ['Id', 'OutcomeName', 'OutcomeFactor', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['id', 'outcomeName', 'outcomeFactor', 'companyId', ],
        self::TYPE_COLNAME       => [CheckinoutOutcomesTableMap::COL_ID, CheckinoutOutcomesTableMap::COL_OUTCOME_NAME, CheckinoutOutcomesTableMap::COL_OUTCOME_FACTOR, CheckinoutOutcomesTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'outcome_name', 'outcome_factor', 'company_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'OutcomeName' => 1, 'OutcomeFactor' => 2, 'CompanyId' => 3, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'outcomeName' => 1, 'outcomeFactor' => 2, 'companyId' => 3, ],
        self::TYPE_COLNAME       => [CheckinoutOutcomesTableMap::COL_ID => 0, CheckinoutOutcomesTableMap::COL_OUTCOME_NAME => 1, CheckinoutOutcomesTableMap::COL_OUTCOME_FACTOR => 2, CheckinoutOutcomesTableMap::COL_COMPANY_ID => 3, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'outcome_name' => 1, 'outcome_factor' => 2, 'company_id' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'CheckinoutOutcomes.Id' => 'ID',
        'id' => 'ID',
        'checkinoutOutcomes.id' => 'ID',
        'CheckinoutOutcomesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'checkinout_outcomes.id' => 'ID',
        'OutcomeName' => 'OUTCOME_NAME',
        'CheckinoutOutcomes.OutcomeName' => 'OUTCOME_NAME',
        'outcomeName' => 'OUTCOME_NAME',
        'checkinoutOutcomes.outcomeName' => 'OUTCOME_NAME',
        'CheckinoutOutcomesTableMap::COL_OUTCOME_NAME' => 'OUTCOME_NAME',
        'COL_OUTCOME_NAME' => 'OUTCOME_NAME',
        'outcome_name' => 'OUTCOME_NAME',
        'checkinout_outcomes.outcome_name' => 'OUTCOME_NAME',
        'OutcomeFactor' => 'OUTCOME_FACTOR',
        'CheckinoutOutcomes.OutcomeFactor' => 'OUTCOME_FACTOR',
        'outcomeFactor' => 'OUTCOME_FACTOR',
        'checkinoutOutcomes.outcomeFactor' => 'OUTCOME_FACTOR',
        'CheckinoutOutcomesTableMap::COL_OUTCOME_FACTOR' => 'OUTCOME_FACTOR',
        'COL_OUTCOME_FACTOR' => 'OUTCOME_FACTOR',
        'outcome_factor' => 'OUTCOME_FACTOR',
        'checkinout_outcomes.outcome_factor' => 'OUTCOME_FACTOR',
        'CompanyId' => 'COMPANY_ID',
        'CheckinoutOutcomes.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'checkinoutOutcomes.companyId' => 'COMPANY_ID',
        'CheckinoutOutcomesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'checkinout_outcomes.company_id' => 'COMPANY_ID',
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
        $this->setName('checkinout_outcomes');
        $this->setPhpName('CheckinoutOutcomes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\CheckinoutOutcomes');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('checkinout_outcomes_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('outcome_name', 'OutcomeName', 'VARCHAR', true, 255, null);
        $this->addColumn('outcome_factor', 'OutcomeFactor', 'SMALLINT', true, null, 0);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CheckinoutOutcomesTableMap::CLASS_DEFAULT : CheckinoutOutcomesTableMap::OM_CLASS;
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
     * @return array (CheckinoutOutcomes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CheckinoutOutcomesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CheckinoutOutcomesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CheckinoutOutcomesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CheckinoutOutcomesTableMap::OM_CLASS;
            /** @var CheckinoutOutcomes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CheckinoutOutcomesTableMap::addInstanceToPool($obj, $key);
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
            $key = CheckinoutOutcomesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CheckinoutOutcomesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CheckinoutOutcomes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CheckinoutOutcomesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CheckinoutOutcomesTableMap::COL_ID);
            $criteria->addSelectColumn(CheckinoutOutcomesTableMap::COL_OUTCOME_NAME);
            $criteria->addSelectColumn(CheckinoutOutcomesTableMap::COL_OUTCOME_FACTOR);
            $criteria->addSelectColumn(CheckinoutOutcomesTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.outcome_name');
            $criteria->addSelectColumn($alias . '.outcome_factor');
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
            $criteria->removeSelectColumn(CheckinoutOutcomesTableMap::COL_ID);
            $criteria->removeSelectColumn(CheckinoutOutcomesTableMap::COL_OUTCOME_NAME);
            $criteria->removeSelectColumn(CheckinoutOutcomesTableMap::COL_OUTCOME_FACTOR);
            $criteria->removeSelectColumn(CheckinoutOutcomesTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.outcome_name');
            $criteria->removeSelectColumn($alias . '.outcome_factor');
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
        return Propel::getServiceContainer()->getDatabaseMap(CheckinoutOutcomesTableMap::DATABASE_NAME)->getTable(CheckinoutOutcomesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a CheckinoutOutcomes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or CheckinoutOutcomes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CheckinoutOutcomesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\CheckinoutOutcomes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CheckinoutOutcomesTableMap::DATABASE_NAME);
            $criteria->add(CheckinoutOutcomesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CheckinoutOutcomesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CheckinoutOutcomesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CheckinoutOutcomesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the checkinout_outcomes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CheckinoutOutcomesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CheckinoutOutcomes or Criteria object.
     *
     * @param mixed $criteria Criteria or CheckinoutOutcomes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CheckinoutOutcomesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CheckinoutOutcomes object
        }

        if ($criteria->containsKey(CheckinoutOutcomesTableMap::COL_ID) && $criteria->keyContainsValue(CheckinoutOutcomesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CheckinoutOutcomesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CheckinoutOutcomesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
