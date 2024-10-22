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
use entities\GradeMaster;
use entities\GradeMasterQuery;


/**
 * This class defines the structure of the 'grade_master' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GradeMasterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GradeMasterTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'grade_master';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GradeMaster';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GradeMaster';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GradeMaster';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the gradeid field
     */
    public const COL_GRADEID = 'grade_master.gradeid';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'grade_master.company_id';

    /**
     * the column name for the grade_name field
     */
    public const COL_GRADE_NAME = 'grade_master.grade_name';

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
        self::TYPE_PHPNAME       => ['Gradeid', 'CompanyId', 'GradeName', ],
        self::TYPE_CAMELNAME     => ['gradeid', 'companyId', 'gradeName', ],
        self::TYPE_COLNAME       => [GradeMasterTableMap::COL_GRADEID, GradeMasterTableMap::COL_COMPANY_ID, GradeMasterTableMap::COL_GRADE_NAME, ],
        self::TYPE_FIELDNAME     => ['gradeid', 'company_id', 'grade_name', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['Gradeid' => 0, 'CompanyId' => 1, 'GradeName' => 2, ],
        self::TYPE_CAMELNAME     => ['gradeid' => 0, 'companyId' => 1, 'gradeName' => 2, ],
        self::TYPE_COLNAME       => [GradeMasterTableMap::COL_GRADEID => 0, GradeMasterTableMap::COL_COMPANY_ID => 1, GradeMasterTableMap::COL_GRADE_NAME => 2, ],
        self::TYPE_FIELDNAME     => ['gradeid' => 0, 'company_id' => 1, 'grade_name' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Gradeid' => 'GRADEID',
        'GradeMaster.Gradeid' => 'GRADEID',
        'gradeid' => 'GRADEID',
        'gradeMaster.gradeid' => 'GRADEID',
        'GradeMasterTableMap::COL_GRADEID' => 'GRADEID',
        'COL_GRADEID' => 'GRADEID',
        'grade_master.gradeid' => 'GRADEID',
        'CompanyId' => 'COMPANY_ID',
        'GradeMaster.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'gradeMaster.companyId' => 'COMPANY_ID',
        'GradeMasterTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'grade_master.company_id' => 'COMPANY_ID',
        'GradeName' => 'GRADE_NAME',
        'GradeMaster.GradeName' => 'GRADE_NAME',
        'gradeName' => 'GRADE_NAME',
        'gradeMaster.gradeName' => 'GRADE_NAME',
        'GradeMasterTableMap::COL_GRADE_NAME' => 'GRADE_NAME',
        'COL_GRADE_NAME' => 'GRADE_NAME',
        'grade_name' => 'GRADE_NAME',
        'grade_master.grade_name' => 'GRADE_NAME',
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
        $this->setName('grade_master');
        $this->setPhpName('GradeMaster');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GradeMaster');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('grade_master_gradeid_seq');
        // columns
        $this->addPrimaryKey('gradeid', 'Gradeid', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('grade_name', 'GradeName', 'VARCHAR', true, 50, null);
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
        $this->addRelation('BudgetGrades', '\\entities\\BudgetGrades', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':grade_id',
    1 => ':gradeid',
  ),
), 'CASCADE', null, 'BudgetGradess', false);
        $this->addRelation('Citycategory', '\\entities\\Citycategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':grade_id',
    1 => ':gradeid',
  ),
), null, null, 'Citycategories', false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':grade_id',
    1 => ':gradeid',
  ),
), null, null, 'Employees', false);
        $this->addRelation('GradePolicy', '\\entities\\GradePolicy', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':gradeid',
    1 => ':gradeid',
  ),
), 'CASCADE', null, 'GradePolicies', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to grade_master     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BudgetGradesTableMap::clearInstancePool();
        GradePolicyTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gradeid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gradeid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gradeid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gradeid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gradeid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gradeid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Gradeid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GradeMasterTableMap::CLASS_DEFAULT : GradeMasterTableMap::OM_CLASS;
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
     * @return array (GradeMaster object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GradeMasterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GradeMasterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GradeMasterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GradeMasterTableMap::OM_CLASS;
            /** @var GradeMaster $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GradeMasterTableMap::addInstanceToPool($obj, $key);
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
            $key = GradeMasterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GradeMasterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GradeMaster $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GradeMasterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GradeMasterTableMap::COL_GRADEID);
            $criteria->addSelectColumn(GradeMasterTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(GradeMasterTableMap::COL_GRADE_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.gradeid');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.grade_name');
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
            $criteria->removeSelectColumn(GradeMasterTableMap::COL_GRADEID);
            $criteria->removeSelectColumn(GradeMasterTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(GradeMasterTableMap::COL_GRADE_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.gradeid');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.grade_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(GradeMasterTableMap::DATABASE_NAME)->getTable(GradeMasterTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GradeMaster or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GradeMaster object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GradeMasterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GradeMaster) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GradeMasterTableMap::DATABASE_NAME);
            $criteria->add(GradeMasterTableMap::COL_GRADEID, (array) $values, Criteria::IN);
        }

        $query = GradeMasterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GradeMasterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GradeMasterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the grade_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GradeMasterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GradeMaster or Criteria object.
     *
     * @param mixed $criteria Criteria or GradeMaster object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GradeMasterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GradeMaster object
        }

        if ($criteria->containsKey(GradeMasterTableMap::COL_GRADEID) && $criteria->keyContainsValue(GradeMasterTableMap::COL_GRADEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GradeMasterTableMap::COL_GRADEID.')');
        }


        // Set the correct dbName
        $query = GradeMasterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}