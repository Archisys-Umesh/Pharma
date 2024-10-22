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
use entities\Report;
use entities\ReportQuery;


/**
 * This class defines the structure of the 'report' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ReportTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ReportTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'report';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Report';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Report';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Report';

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
     * the column name for the sr field
     */
    public const COL_SR = 'report.sr';

    /**
     * the column name for the employee field
     */
    public const COL_EMPLOYEE = 'report.employee';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'report.designation';

    /**
     * the column name for the reporting field
     */
    public const COL_REPORTING = 'report.reporting';

    /**
     * the column name for the mobile field
     */
    public const COL_MOBILE = 'report.mobile';

    /**
     * the column name for the added_on field
     */
    public const COL_ADDED_ON = 'report.added_on';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'report.status';

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
        self::TYPE_PHPNAME       => ['Sr', 'Employee', 'Designation', 'Reporting', 'Mobile', 'AddedOn', 'Status', ],
        self::TYPE_CAMELNAME     => ['sr', 'employee', 'designation', 'reporting', 'mobile', 'addedOn', 'status', ],
        self::TYPE_COLNAME       => [ReportTableMap::COL_SR, ReportTableMap::COL_EMPLOYEE, ReportTableMap::COL_DESIGNATION, ReportTableMap::COL_REPORTING, ReportTableMap::COL_MOBILE, ReportTableMap::COL_ADDED_ON, ReportTableMap::COL_STATUS, ],
        self::TYPE_FIELDNAME     => ['sr', 'employee', 'designation', 'reporting', 'mobile', 'added_on', 'status', ],
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
        self::TYPE_PHPNAME       => ['Sr' => 0, 'Employee' => 1, 'Designation' => 2, 'Reporting' => 3, 'Mobile' => 4, 'AddedOn' => 5, 'Status' => 6, ],
        self::TYPE_CAMELNAME     => ['sr' => 0, 'employee' => 1, 'designation' => 2, 'reporting' => 3, 'mobile' => 4, 'addedOn' => 5, 'status' => 6, ],
        self::TYPE_COLNAME       => [ReportTableMap::COL_SR => 0, ReportTableMap::COL_EMPLOYEE => 1, ReportTableMap::COL_DESIGNATION => 2, ReportTableMap::COL_REPORTING => 3, ReportTableMap::COL_MOBILE => 4, ReportTableMap::COL_ADDED_ON => 5, ReportTableMap::COL_STATUS => 6, ],
        self::TYPE_FIELDNAME     => ['sr' => 0, 'employee' => 1, 'designation' => 2, 'reporting' => 3, 'mobile' => 4, 'added_on' => 5, 'status' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Sr' => 'SR',
        'Report.Sr' => 'SR',
        'sr' => 'SR',
        'report.sr' => 'SR',
        'ReportTableMap::COL_SR' => 'SR',
        'COL_SR' => 'SR',
        'Employee' => 'EMPLOYEE',
        'Report.Employee' => 'EMPLOYEE',
        'employee' => 'EMPLOYEE',
        'report.employee' => 'EMPLOYEE',
        'ReportTableMap::COL_EMPLOYEE' => 'EMPLOYEE',
        'COL_EMPLOYEE' => 'EMPLOYEE',
        'Designation' => 'DESIGNATION',
        'Report.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'report.designation' => 'DESIGNATION',
        'ReportTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'Reporting' => 'REPORTING',
        'Report.Reporting' => 'REPORTING',
        'reporting' => 'REPORTING',
        'report.reporting' => 'REPORTING',
        'ReportTableMap::COL_REPORTING' => 'REPORTING',
        'COL_REPORTING' => 'REPORTING',
        'Mobile' => 'MOBILE',
        'Report.Mobile' => 'MOBILE',
        'mobile' => 'MOBILE',
        'report.mobile' => 'MOBILE',
        'ReportTableMap::COL_MOBILE' => 'MOBILE',
        'COL_MOBILE' => 'MOBILE',
        'AddedOn' => 'ADDED_ON',
        'Report.AddedOn' => 'ADDED_ON',
        'addedOn' => 'ADDED_ON',
        'report.addedOn' => 'ADDED_ON',
        'ReportTableMap::COL_ADDED_ON' => 'ADDED_ON',
        'COL_ADDED_ON' => 'ADDED_ON',
        'added_on' => 'ADDED_ON',
        'report.added_on' => 'ADDED_ON',
        'Status' => 'STATUS',
        'Report.Status' => 'STATUS',
        'status' => 'STATUS',
        'report.status' => 'STATUS',
        'ReportTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
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
        $this->setName('report');
        $this->setPhpName('Report');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Report');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('report_sr_seq');
        // columns
        $this->addPrimaryKey('sr', 'Sr', 'INTEGER', true, null, null);
        $this->addColumn('employee', 'Employee', 'VARCHAR', false, 50, null);
        $this->addColumn('designation', 'Designation', 'VARCHAR', false, 50, null);
        $this->addColumn('reporting', 'Reporting', 'VARCHAR', false, 50, null);
        $this->addColumn('mobile', 'Mobile', 'INTEGER', false, null, null);
        $this->addColumn('added_on', 'AddedOn', 'DATE', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 50, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sr', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sr', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sr', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sr', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sr', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sr', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Sr', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ReportTableMap::CLASS_DEFAULT : ReportTableMap::OM_CLASS;
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
     * @return array (Report object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ReportTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ReportTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ReportTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ReportTableMap::OM_CLASS;
            /** @var Report $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ReportTableMap::addInstanceToPool($obj, $key);
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
            $key = ReportTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ReportTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Report $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ReportTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ReportTableMap::COL_SR);
            $criteria->addSelectColumn(ReportTableMap::COL_EMPLOYEE);
            $criteria->addSelectColumn(ReportTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(ReportTableMap::COL_REPORTING);
            $criteria->addSelectColumn(ReportTableMap::COL_MOBILE);
            $criteria->addSelectColumn(ReportTableMap::COL_ADDED_ON);
            $criteria->addSelectColumn(ReportTableMap::COL_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.sr');
            $criteria->addSelectColumn($alias . '.employee');
            $criteria->addSelectColumn($alias . '.designation');
            $criteria->addSelectColumn($alias . '.reporting');
            $criteria->addSelectColumn($alias . '.mobile');
            $criteria->addSelectColumn($alias . '.added_on');
            $criteria->addSelectColumn($alias . '.status');
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
            $criteria->removeSelectColumn(ReportTableMap::COL_SR);
            $criteria->removeSelectColumn(ReportTableMap::COL_EMPLOYEE);
            $criteria->removeSelectColumn(ReportTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(ReportTableMap::COL_REPORTING);
            $criteria->removeSelectColumn(ReportTableMap::COL_MOBILE);
            $criteria->removeSelectColumn(ReportTableMap::COL_ADDED_ON);
            $criteria->removeSelectColumn(ReportTableMap::COL_STATUS);
        } else {
            $criteria->removeSelectColumn($alias . '.sr');
            $criteria->removeSelectColumn($alias . '.employee');
            $criteria->removeSelectColumn($alias . '.designation');
            $criteria->removeSelectColumn($alias . '.reporting');
            $criteria->removeSelectColumn($alias . '.mobile');
            $criteria->removeSelectColumn($alias . '.added_on');
            $criteria->removeSelectColumn($alias . '.status');
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
        return Propel::getServiceContainer()->getDatabaseMap(ReportTableMap::DATABASE_NAME)->getTable(ReportTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Report or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Report object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Report) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ReportTableMap::DATABASE_NAME);
            $criteria->add(ReportTableMap::COL_SR, (array) $values, Criteria::IN);
        }

        $query = ReportQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ReportTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ReportTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the report table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ReportQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Report or Criteria object.
     *
     * @param mixed $criteria Criteria or Report object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Report object
        }

        if ($criteria->containsKey(ReportTableMap::COL_SR) && $criteria->keyContainsValue(ReportTableMap::COL_SR) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ReportTableMap::COL_SR.')');
        }


        // Set the correct dbName
        $query = ReportQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
