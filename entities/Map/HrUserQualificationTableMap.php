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
use entities\HrUserQualification;
use entities\HrUserQualificationQuery;


/**
 * This class defines the structure of the 'hr_user_qualification' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class HrUserQualificationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.HrUserQualificationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'hr_user_qualification';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'HrUserQualification';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\HrUserQualification';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.HrUserQualification';

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
     * the column name for the hrqu_id field
     */
    public const COL_HRQU_ID = 'hr_user_qualification.hrqu_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'hr_user_qualification.employee_id';

    /**
     * the column name for the degree field
     */
    public const COL_DEGREE = 'hr_user_qualification.degree';

    /**
     * the column name for the year field
     */
    public const COL_YEAR = 'hr_user_qualification.year';

    /**
     * the column name for the result_class field
     */
    public const COL_RESULT_CLASS = 'hr_user_qualification.result_class';

    /**
     * the column name for the institute field
     */
    public const COL_INSTITUTE = 'hr_user_qualification.institute';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'hr_user_qualification.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'hr_user_qualification.updated_at';

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
        self::TYPE_PHPNAME       => ['HrquId', 'EmployeeId', 'Degree', 'Year', 'ResultClass', 'Institute', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['hrquId', 'employeeId', 'degree', 'year', 'resultClass', 'institute', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [HrUserQualificationTableMap::COL_HRQU_ID, HrUserQualificationTableMap::COL_EMPLOYEE_ID, HrUserQualificationTableMap::COL_DEGREE, HrUserQualificationTableMap::COL_YEAR, HrUserQualificationTableMap::COL_RESULT_CLASS, HrUserQualificationTableMap::COL_INSTITUTE, HrUserQualificationTableMap::COL_CREATED_AT, HrUserQualificationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['hrqu_id', 'employee_id', 'degree', 'year', 'result_class', 'institute', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['HrquId' => 0, 'EmployeeId' => 1, 'Degree' => 2, 'Year' => 3, 'ResultClass' => 4, 'Institute' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['hrquId' => 0, 'employeeId' => 1, 'degree' => 2, 'year' => 3, 'resultClass' => 4, 'institute' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [HrUserQualificationTableMap::COL_HRQU_ID => 0, HrUserQualificationTableMap::COL_EMPLOYEE_ID => 1, HrUserQualificationTableMap::COL_DEGREE => 2, HrUserQualificationTableMap::COL_YEAR => 3, HrUserQualificationTableMap::COL_RESULT_CLASS => 4, HrUserQualificationTableMap::COL_INSTITUTE => 5, HrUserQualificationTableMap::COL_CREATED_AT => 6, HrUserQualificationTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['hrqu_id' => 0, 'employee_id' => 1, 'degree' => 2, 'year' => 3, 'result_class' => 4, 'institute' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'HrquId' => 'HRQU_ID',
        'HrUserQualification.HrquId' => 'HRQU_ID',
        'hrquId' => 'HRQU_ID',
        'hrUserQualification.hrquId' => 'HRQU_ID',
        'HrUserQualificationTableMap::COL_HRQU_ID' => 'HRQU_ID',
        'COL_HRQU_ID' => 'HRQU_ID',
        'hrqu_id' => 'HRQU_ID',
        'hr_user_qualification.hrqu_id' => 'HRQU_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'HrUserQualification.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'hrUserQualification.employeeId' => 'EMPLOYEE_ID',
        'HrUserQualificationTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'hr_user_qualification.employee_id' => 'EMPLOYEE_ID',
        'Degree' => 'DEGREE',
        'HrUserQualification.Degree' => 'DEGREE',
        'degree' => 'DEGREE',
        'hrUserQualification.degree' => 'DEGREE',
        'HrUserQualificationTableMap::COL_DEGREE' => 'DEGREE',
        'COL_DEGREE' => 'DEGREE',
        'hr_user_qualification.degree' => 'DEGREE',
        'Year' => 'YEAR',
        'HrUserQualification.Year' => 'YEAR',
        'year' => 'YEAR',
        'hrUserQualification.year' => 'YEAR',
        'HrUserQualificationTableMap::COL_YEAR' => 'YEAR',
        'COL_YEAR' => 'YEAR',
        'hr_user_qualification.year' => 'YEAR',
        'ResultClass' => 'RESULT_CLASS',
        'HrUserQualification.ResultClass' => 'RESULT_CLASS',
        'resultClass' => 'RESULT_CLASS',
        'hrUserQualification.resultClass' => 'RESULT_CLASS',
        'HrUserQualificationTableMap::COL_RESULT_CLASS' => 'RESULT_CLASS',
        'COL_RESULT_CLASS' => 'RESULT_CLASS',
        'result_class' => 'RESULT_CLASS',
        'hr_user_qualification.result_class' => 'RESULT_CLASS',
        'Institute' => 'INSTITUTE',
        'HrUserQualification.Institute' => 'INSTITUTE',
        'institute' => 'INSTITUTE',
        'hrUserQualification.institute' => 'INSTITUTE',
        'HrUserQualificationTableMap::COL_INSTITUTE' => 'INSTITUTE',
        'COL_INSTITUTE' => 'INSTITUTE',
        'hr_user_qualification.institute' => 'INSTITUTE',
        'CreatedAt' => 'CREATED_AT',
        'HrUserQualification.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'hrUserQualification.createdAt' => 'CREATED_AT',
        'HrUserQualificationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'hr_user_qualification.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'HrUserQualification.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'hrUserQualification.updatedAt' => 'UPDATED_AT',
        'HrUserQualificationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'hr_user_qualification.updated_at' => 'UPDATED_AT',
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
        $this->setName('hr_user_qualification');
        $this->setPhpName('HrUserQualification');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\HrUserQualification');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('hr_user_qualification_hrqu_id_seq');
        // columns
        $this->addPrimaryKey('hrqu_id', 'HrquId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, 0);
        $this->addColumn('degree', 'Degree', 'VARCHAR', true, 255, '0');
        $this->addColumn('year', 'Year', 'INTEGER', true, null, 0);
        $this->addColumn('result_class', 'ResultClass', 'VARCHAR', true, 50, '0');
        $this->addColumn('institute', 'Institute', 'VARCHAR', true, 255, '0');
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrquId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrquId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrquId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrquId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrquId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrquId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('HrquId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? HrUserQualificationTableMap::CLASS_DEFAULT : HrUserQualificationTableMap::OM_CLASS;
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
     * @return array (HrUserQualification object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = HrUserQualificationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HrUserQualificationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HrUserQualificationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HrUserQualificationTableMap::OM_CLASS;
            /** @var HrUserQualification $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HrUserQualificationTableMap::addInstanceToPool($obj, $key);
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
            $key = HrUserQualificationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HrUserQualificationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var HrUserQualification $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HrUserQualificationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HrUserQualificationTableMap::COL_HRQU_ID);
            $criteria->addSelectColumn(HrUserQualificationTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(HrUserQualificationTableMap::COL_DEGREE);
            $criteria->addSelectColumn(HrUserQualificationTableMap::COL_YEAR);
            $criteria->addSelectColumn(HrUserQualificationTableMap::COL_RESULT_CLASS);
            $criteria->addSelectColumn(HrUserQualificationTableMap::COL_INSTITUTE);
            $criteria->addSelectColumn(HrUserQualificationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(HrUserQualificationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.hrqu_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.degree');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.result_class');
            $criteria->addSelectColumn($alias . '.institute');
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
            $criteria->removeSelectColumn(HrUserQualificationTableMap::COL_HRQU_ID);
            $criteria->removeSelectColumn(HrUserQualificationTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(HrUserQualificationTableMap::COL_DEGREE);
            $criteria->removeSelectColumn(HrUserQualificationTableMap::COL_YEAR);
            $criteria->removeSelectColumn(HrUserQualificationTableMap::COL_RESULT_CLASS);
            $criteria->removeSelectColumn(HrUserQualificationTableMap::COL_INSTITUTE);
            $criteria->removeSelectColumn(HrUserQualificationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(HrUserQualificationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.hrqu_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.degree');
            $criteria->removeSelectColumn($alias . '.year');
            $criteria->removeSelectColumn($alias . '.result_class');
            $criteria->removeSelectColumn($alias . '.institute');
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
        return Propel::getServiceContainer()->getDatabaseMap(HrUserQualificationTableMap::DATABASE_NAME)->getTable(HrUserQualificationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a HrUserQualification or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or HrUserQualification object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserQualificationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\HrUserQualification) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HrUserQualificationTableMap::DATABASE_NAME);
            $criteria->add(HrUserQualificationTableMap::COL_HRQU_ID, (array) $values, Criteria::IN);
        }

        $query = HrUserQualificationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HrUserQualificationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HrUserQualificationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the hr_user_qualification table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return HrUserQualificationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a HrUserQualification or Criteria object.
     *
     * @param mixed $criteria Criteria or HrUserQualification object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserQualificationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from HrUserQualification object
        }

        if ($criteria->containsKey(HrUserQualificationTableMap::COL_HRQU_ID) && $criteria->keyContainsValue(HrUserQualificationTableMap::COL_HRQU_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HrUserQualificationTableMap::COL_HRQU_ID.')');
        }


        // Set the correct dbName
        $query = HrUserQualificationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
