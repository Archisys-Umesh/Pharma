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
use entities\EdSession;
use entities\EdSessionQuery;


/**
 * This class defines the structure of the 'ed_session' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EdSessionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EdSessionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ed_session';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EdSession';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EdSession';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EdSession';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the ed_session_id field
     */
    public const COL_ED_SESSION_ID = 'ed_session.ed_session_id';

    /**
     * the column name for the ed_session_code field
     */
    public const COL_ED_SESSION_CODE = 'ed_session.ed_session_code';

    /**
     * the column name for the ed_summary field
     */
    public const COL_ED_SUMMARY = 'ed_session.ed_summary';

    /**
     * the column name for the ed_date field
     */
    public const COL_ED_DATE = 'ed_session.ed_date';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ed_session.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ed_session.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ed_session.updated_at';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'ed_session.outlet_org_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'ed_session.employee_id';

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
        self::TYPE_PHPNAME       => ['EdSessionId', 'EdSessionCode', 'EdSummary', 'EdDate', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'OutletOrgId', 'EmployeeId', ],
        self::TYPE_CAMELNAME     => ['edSessionId', 'edSessionCode', 'edSummary', 'edDate', 'companyId', 'createdAt', 'updatedAt', 'outletOrgId', 'employeeId', ],
        self::TYPE_COLNAME       => [EdSessionTableMap::COL_ED_SESSION_ID, EdSessionTableMap::COL_ED_SESSION_CODE, EdSessionTableMap::COL_ED_SUMMARY, EdSessionTableMap::COL_ED_DATE, EdSessionTableMap::COL_COMPANY_ID, EdSessionTableMap::COL_CREATED_AT, EdSessionTableMap::COL_UPDATED_AT, EdSessionTableMap::COL_OUTLET_ORG_ID, EdSessionTableMap::COL_EMPLOYEE_ID, ],
        self::TYPE_FIELDNAME     => ['ed_session_id', 'ed_session_code', 'ed_summary', 'ed_date', 'company_id', 'created_at', 'updated_at', 'outlet_org_id', 'employee_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['EdSessionId' => 0, 'EdSessionCode' => 1, 'EdSummary' => 2, 'EdDate' => 3, 'CompanyId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'OutletOrgId' => 7, 'EmployeeId' => 8, ],
        self::TYPE_CAMELNAME     => ['edSessionId' => 0, 'edSessionCode' => 1, 'edSummary' => 2, 'edDate' => 3, 'companyId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'outletOrgId' => 7, 'employeeId' => 8, ],
        self::TYPE_COLNAME       => [EdSessionTableMap::COL_ED_SESSION_ID => 0, EdSessionTableMap::COL_ED_SESSION_CODE => 1, EdSessionTableMap::COL_ED_SUMMARY => 2, EdSessionTableMap::COL_ED_DATE => 3, EdSessionTableMap::COL_COMPANY_ID => 4, EdSessionTableMap::COL_CREATED_AT => 5, EdSessionTableMap::COL_UPDATED_AT => 6, EdSessionTableMap::COL_OUTLET_ORG_ID => 7, EdSessionTableMap::COL_EMPLOYEE_ID => 8, ],
        self::TYPE_FIELDNAME     => ['ed_session_id' => 0, 'ed_session_code' => 1, 'ed_summary' => 2, 'ed_date' => 3, 'company_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'outlet_org_id' => 7, 'employee_id' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EdSessionId' => 'ED_SESSION_ID',
        'EdSession.EdSessionId' => 'ED_SESSION_ID',
        'edSessionId' => 'ED_SESSION_ID',
        'edSession.edSessionId' => 'ED_SESSION_ID',
        'EdSessionTableMap::COL_ED_SESSION_ID' => 'ED_SESSION_ID',
        'COL_ED_SESSION_ID' => 'ED_SESSION_ID',
        'ed_session_id' => 'ED_SESSION_ID',
        'ed_session.ed_session_id' => 'ED_SESSION_ID',
        'EdSessionCode' => 'ED_SESSION_CODE',
        'EdSession.EdSessionCode' => 'ED_SESSION_CODE',
        'edSessionCode' => 'ED_SESSION_CODE',
        'edSession.edSessionCode' => 'ED_SESSION_CODE',
        'EdSessionTableMap::COL_ED_SESSION_CODE' => 'ED_SESSION_CODE',
        'COL_ED_SESSION_CODE' => 'ED_SESSION_CODE',
        'ed_session_code' => 'ED_SESSION_CODE',
        'ed_session.ed_session_code' => 'ED_SESSION_CODE',
        'EdSummary' => 'ED_SUMMARY',
        'EdSession.EdSummary' => 'ED_SUMMARY',
        'edSummary' => 'ED_SUMMARY',
        'edSession.edSummary' => 'ED_SUMMARY',
        'EdSessionTableMap::COL_ED_SUMMARY' => 'ED_SUMMARY',
        'COL_ED_SUMMARY' => 'ED_SUMMARY',
        'ed_summary' => 'ED_SUMMARY',
        'ed_session.ed_summary' => 'ED_SUMMARY',
        'EdDate' => 'ED_DATE',
        'EdSession.EdDate' => 'ED_DATE',
        'edDate' => 'ED_DATE',
        'edSession.edDate' => 'ED_DATE',
        'EdSessionTableMap::COL_ED_DATE' => 'ED_DATE',
        'COL_ED_DATE' => 'ED_DATE',
        'ed_date' => 'ED_DATE',
        'ed_session.ed_date' => 'ED_DATE',
        'CompanyId' => 'COMPANY_ID',
        'EdSession.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'edSession.companyId' => 'COMPANY_ID',
        'EdSessionTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ed_session.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'EdSession.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'edSession.createdAt' => 'CREATED_AT',
        'EdSessionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ed_session.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EdSession.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'edSession.updatedAt' => 'UPDATED_AT',
        'EdSessionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ed_session.updated_at' => 'UPDATED_AT',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'EdSession.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'edSession.outletOrgId' => 'OUTLET_ORG_ID',
        'EdSessionTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'ed_session.outlet_org_id' => 'OUTLET_ORG_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'EdSession.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'edSession.employeeId' => 'EMPLOYEE_ID',
        'EdSessionTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'ed_session.employee_id' => 'EMPLOYEE_ID',
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
        $this->setName('ed_session');
        $this->setPhpName('EdSession');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EdSession');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ed_session_ed_session_id_seq');
        // columns
        $this->addPrimaryKey('ed_session_id', 'EdSessionId', 'INTEGER', true, null, null);
        $this->addColumn('ed_session_code', 'EdSessionCode', 'VARCHAR', false, null, null);
        $this->addColumn('ed_summary', 'EdSummary', 'VARCHAR', false, null, null);
        $this->addColumn('ed_date', 'EdDate', 'DATE', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('outlet_org_id', 'OutletOrgId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
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
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdSessionId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdSessionId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdSessionId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdSessionId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdSessionId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdSessionId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EdSessionId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EdSessionTableMap::CLASS_DEFAULT : EdSessionTableMap::OM_CLASS;
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
     * @return array (EdSession object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EdSessionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EdSessionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EdSessionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EdSessionTableMap::OM_CLASS;
            /** @var EdSession $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EdSessionTableMap::addInstanceToPool($obj, $key);
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
            $key = EdSessionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EdSessionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EdSession $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EdSessionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EdSessionTableMap::COL_ED_SESSION_ID);
            $criteria->addSelectColumn(EdSessionTableMap::COL_ED_SESSION_CODE);
            $criteria->addSelectColumn(EdSessionTableMap::COL_ED_SUMMARY);
            $criteria->addSelectColumn(EdSessionTableMap::COL_ED_DATE);
            $criteria->addSelectColumn(EdSessionTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EdSessionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EdSessionTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EdSessionTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(EdSessionTableMap::COL_EMPLOYEE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.ed_session_id');
            $criteria->addSelectColumn($alias . '.ed_session_code');
            $criteria->addSelectColumn($alias . '.ed_summary');
            $criteria->addSelectColumn($alias . '.ed_date');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.employee_id');
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
            $criteria->removeSelectColumn(EdSessionTableMap::COL_ED_SESSION_ID);
            $criteria->removeSelectColumn(EdSessionTableMap::COL_ED_SESSION_CODE);
            $criteria->removeSelectColumn(EdSessionTableMap::COL_ED_SUMMARY);
            $criteria->removeSelectColumn(EdSessionTableMap::COL_ED_DATE);
            $criteria->removeSelectColumn(EdSessionTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EdSessionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EdSessionTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(EdSessionTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(EdSessionTableMap::COL_EMPLOYEE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.ed_session_id');
            $criteria->removeSelectColumn($alias . '.ed_session_code');
            $criteria->removeSelectColumn($alias . '.ed_summary');
            $criteria->removeSelectColumn($alias . '.ed_date');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(EdSessionTableMap::DATABASE_NAME)->getTable(EdSessionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EdSession or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EdSession object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EdSessionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EdSession) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EdSessionTableMap::DATABASE_NAME);
            $criteria->add(EdSessionTableMap::COL_ED_SESSION_ID, (array) $values, Criteria::IN);
        }

        $query = EdSessionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EdSessionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EdSessionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ed_session table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EdSessionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EdSession or Criteria object.
     *
     * @param mixed $criteria Criteria or EdSession object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdSessionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EdSession object
        }

        if ($criteria->containsKey(EdSessionTableMap::COL_ED_SESSION_ID) && $criteria->keyContainsValue(EdSessionTableMap::COL_ED_SESSION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EdSessionTableMap::COL_ED_SESSION_ID.')');
        }


        // Set the correct dbName
        $query = EdSessionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
