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
use entities\GradePolicy;
use entities\GradePolicyQuery;


/**
 * This class defines the structure of the 'grade_policy' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GradePolicyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GradePolicyTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'grade_policy';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GradePolicy';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GradePolicy';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GradePolicy';

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
     * the column name for the gp_id field
     */
    public const COL_GP_ID = 'grade_policy.gp_id';

    /**
     * the column name for the gradeid field
     */
    public const COL_GRADEID = 'grade_policy.gradeid';

    /**
     * the column name for the policy_id field
     */
    public const COL_POLICY_ID = 'grade_policy.policy_id';

    /**
     * the column name for the end_date field
     */
    public const COL_END_DATE = 'grade_policy.end_date';

    /**
     * the column name for the start_date field
     */
    public const COL_START_DATE = 'grade_policy.start_date';

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
        self::TYPE_PHPNAME       => ['GpId', 'Gradeid', 'PolicyId', 'EndDate', 'StartDate', ],
        self::TYPE_CAMELNAME     => ['gpId', 'gradeid', 'policyId', 'endDate', 'startDate', ],
        self::TYPE_COLNAME       => [GradePolicyTableMap::COL_GP_ID, GradePolicyTableMap::COL_GRADEID, GradePolicyTableMap::COL_POLICY_ID, GradePolicyTableMap::COL_END_DATE, GradePolicyTableMap::COL_START_DATE, ],
        self::TYPE_FIELDNAME     => ['gp_id', 'gradeid', 'policy_id', 'end_date', 'start_date', ],
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
        self::TYPE_PHPNAME       => ['GpId' => 0, 'Gradeid' => 1, 'PolicyId' => 2, 'EndDate' => 3, 'StartDate' => 4, ],
        self::TYPE_CAMELNAME     => ['gpId' => 0, 'gradeid' => 1, 'policyId' => 2, 'endDate' => 3, 'startDate' => 4, ],
        self::TYPE_COLNAME       => [GradePolicyTableMap::COL_GP_ID => 0, GradePolicyTableMap::COL_GRADEID => 1, GradePolicyTableMap::COL_POLICY_ID => 2, GradePolicyTableMap::COL_END_DATE => 3, GradePolicyTableMap::COL_START_DATE => 4, ],
        self::TYPE_FIELDNAME     => ['gp_id' => 0, 'gradeid' => 1, 'policy_id' => 2, 'end_date' => 3, 'start_date' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'GpId' => 'GP_ID',
        'GradePolicy.GpId' => 'GP_ID',
        'gpId' => 'GP_ID',
        'gradePolicy.gpId' => 'GP_ID',
        'GradePolicyTableMap::COL_GP_ID' => 'GP_ID',
        'COL_GP_ID' => 'GP_ID',
        'gp_id' => 'GP_ID',
        'grade_policy.gp_id' => 'GP_ID',
        'Gradeid' => 'GRADEID',
        'GradePolicy.Gradeid' => 'GRADEID',
        'gradeid' => 'GRADEID',
        'gradePolicy.gradeid' => 'GRADEID',
        'GradePolicyTableMap::COL_GRADEID' => 'GRADEID',
        'COL_GRADEID' => 'GRADEID',
        'grade_policy.gradeid' => 'GRADEID',
        'PolicyId' => 'POLICY_ID',
        'GradePolicy.PolicyId' => 'POLICY_ID',
        'policyId' => 'POLICY_ID',
        'gradePolicy.policyId' => 'POLICY_ID',
        'GradePolicyTableMap::COL_POLICY_ID' => 'POLICY_ID',
        'COL_POLICY_ID' => 'POLICY_ID',
        'policy_id' => 'POLICY_ID',
        'grade_policy.policy_id' => 'POLICY_ID',
        'EndDate' => 'END_DATE',
        'GradePolicy.EndDate' => 'END_DATE',
        'endDate' => 'END_DATE',
        'gradePolicy.endDate' => 'END_DATE',
        'GradePolicyTableMap::COL_END_DATE' => 'END_DATE',
        'COL_END_DATE' => 'END_DATE',
        'end_date' => 'END_DATE',
        'grade_policy.end_date' => 'END_DATE',
        'StartDate' => 'START_DATE',
        'GradePolicy.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'gradePolicy.startDate' => 'START_DATE',
        'GradePolicyTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'start_date' => 'START_DATE',
        'grade_policy.start_date' => 'START_DATE',
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
        $this->setName('grade_policy');
        $this->setPhpName('GradePolicy');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GradePolicy');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('grade_policy_gp_id_seq');
        // columns
        $this->addPrimaryKey('gp_id', 'GpId', 'INTEGER', true, null, null);
        $this->addForeignKey('gradeid', 'Gradeid', 'INTEGER', 'grade_master', 'gradeid', true, null, 0);
        $this->addForeignKey('policy_id', 'PolicyId', 'INTEGER', 'policy_master', 'policy_id', true, null, 0);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GradeMaster', '\\entities\\GradeMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':gradeid',
    1 => ':gradeid',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('PolicyMaster', '\\entities\\PolicyMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':policy_id',
    1 => ':policy_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GpId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GpId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GpId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GpId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GpId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GpId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('GpId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GradePolicyTableMap::CLASS_DEFAULT : GradePolicyTableMap::OM_CLASS;
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
     * @return array (GradePolicy object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GradePolicyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GradePolicyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GradePolicyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GradePolicyTableMap::OM_CLASS;
            /** @var GradePolicy $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GradePolicyTableMap::addInstanceToPool($obj, $key);
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
            $key = GradePolicyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GradePolicyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GradePolicy $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GradePolicyTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GradePolicyTableMap::COL_GP_ID);
            $criteria->addSelectColumn(GradePolicyTableMap::COL_GRADEID);
            $criteria->addSelectColumn(GradePolicyTableMap::COL_POLICY_ID);
            $criteria->addSelectColumn(GradePolicyTableMap::COL_END_DATE);
            $criteria->addSelectColumn(GradePolicyTableMap::COL_START_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.gp_id');
            $criteria->addSelectColumn($alias . '.gradeid');
            $criteria->addSelectColumn($alias . '.policy_id');
            $criteria->addSelectColumn($alias . '.end_date');
            $criteria->addSelectColumn($alias . '.start_date');
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
            $criteria->removeSelectColumn(GradePolicyTableMap::COL_GP_ID);
            $criteria->removeSelectColumn(GradePolicyTableMap::COL_GRADEID);
            $criteria->removeSelectColumn(GradePolicyTableMap::COL_POLICY_ID);
            $criteria->removeSelectColumn(GradePolicyTableMap::COL_END_DATE);
            $criteria->removeSelectColumn(GradePolicyTableMap::COL_START_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.gp_id');
            $criteria->removeSelectColumn($alias . '.gradeid');
            $criteria->removeSelectColumn($alias . '.policy_id');
            $criteria->removeSelectColumn($alias . '.end_date');
            $criteria->removeSelectColumn($alias . '.start_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(GradePolicyTableMap::DATABASE_NAME)->getTable(GradePolicyTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GradePolicy or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GradePolicy object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GradePolicyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GradePolicy) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GradePolicyTableMap::DATABASE_NAME);
            $criteria->add(GradePolicyTableMap::COL_GP_ID, (array) $values, Criteria::IN);
        }

        $query = GradePolicyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GradePolicyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GradePolicyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the grade_policy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GradePolicyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GradePolicy or Criteria object.
     *
     * @param mixed $criteria Criteria or GradePolicy object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GradePolicyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GradePolicy object
        }

        if ($criteria->containsKey(GradePolicyTableMap::COL_GP_ID) && $criteria->keyContainsValue(GradePolicyTableMap::COL_GP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GradePolicyTableMap::COL_GP_ID.')');
        }


        // Set the correct dbName
        $query = GradePolicyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
