<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\MtdTargetAchivementTable;
use entities\MtdTargetAchivementTableQuery;


/**
 * This class defines the structure of the 'mtd_target_achivement_table' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MtdTargetAchivementTableTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MtdTargetAchivementTableTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'mtd_target_achivement_table';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'MtdTargetAchivementTable';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\MtdTargetAchivementTable';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.MtdTargetAchivementTable';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'mtd_target_achivement_table.id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'mtd_target_achivement_table.company_id';

    /**
     * the column name for the target_id field
     */
    public const COL_TARGET_ID = 'mtd_target_achivement_table.target_id';

    /**
     * the column name for the target_name field
     */
    public const COL_TARGET_NAME = 'mtd_target_achivement_table.target_name';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'mtd_target_achivement_table.employee_id';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'mtd_target_achivement_table.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'mtd_target_achivement_table.last_name';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'mtd_target_achivement_table.employee_code';

    /**
     * the column name for the month field
     */
    public const COL_MONTH = 'mtd_target_achivement_table.month';

    /**
     * the column name for the target_value field
     */
    public const COL_TARGET_VALUE = 'mtd_target_achivement_table.target_value';

    /**
     * the column name for the sales field
     */
    public const COL_SALES = 'mtd_target_achivement_table.sales';

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
        self::TYPE_PHPNAME       => ['Id', 'CompanyId', 'TargetId', 'TargetName', 'EmployeeId', 'FirstName', 'LastName', 'EmployeeCode', 'Month', 'TargetValue', 'Sales', ],
        self::TYPE_CAMELNAME     => ['id', 'companyId', 'targetId', 'targetName', 'employeeId', 'firstName', 'lastName', 'employeeCode', 'month', 'targetValue', 'sales', ],
        self::TYPE_COLNAME       => [MtdTargetAchivementTableTableMap::COL_ID, MtdTargetAchivementTableTableMap::COL_COMPANY_ID, MtdTargetAchivementTableTableMap::COL_TARGET_ID, MtdTargetAchivementTableTableMap::COL_TARGET_NAME, MtdTargetAchivementTableTableMap::COL_EMPLOYEE_ID, MtdTargetAchivementTableTableMap::COL_FIRST_NAME, MtdTargetAchivementTableTableMap::COL_LAST_NAME, MtdTargetAchivementTableTableMap::COL_EMPLOYEE_CODE, MtdTargetAchivementTableTableMap::COL_MONTH, MtdTargetAchivementTableTableMap::COL_TARGET_VALUE, MtdTargetAchivementTableTableMap::COL_SALES, ],
        self::TYPE_FIELDNAME     => ['id', 'company_id', 'target_id', 'target_name', 'employee_id', 'first_name', 'last_name', 'employee_code', 'month', 'target_value', 'sales', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'CompanyId' => 1, 'TargetId' => 2, 'TargetName' => 3, 'EmployeeId' => 4, 'FirstName' => 5, 'LastName' => 6, 'EmployeeCode' => 7, 'Month' => 8, 'TargetValue' => 9, 'Sales' => 10, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'companyId' => 1, 'targetId' => 2, 'targetName' => 3, 'employeeId' => 4, 'firstName' => 5, 'lastName' => 6, 'employeeCode' => 7, 'month' => 8, 'targetValue' => 9, 'sales' => 10, ],
        self::TYPE_COLNAME       => [MtdTargetAchivementTableTableMap::COL_ID => 0, MtdTargetAchivementTableTableMap::COL_COMPANY_ID => 1, MtdTargetAchivementTableTableMap::COL_TARGET_ID => 2, MtdTargetAchivementTableTableMap::COL_TARGET_NAME => 3, MtdTargetAchivementTableTableMap::COL_EMPLOYEE_ID => 4, MtdTargetAchivementTableTableMap::COL_FIRST_NAME => 5, MtdTargetAchivementTableTableMap::COL_LAST_NAME => 6, MtdTargetAchivementTableTableMap::COL_EMPLOYEE_CODE => 7, MtdTargetAchivementTableTableMap::COL_MONTH => 8, MtdTargetAchivementTableTableMap::COL_TARGET_VALUE => 9, MtdTargetAchivementTableTableMap::COL_SALES => 10, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'company_id' => 1, 'target_id' => 2, 'target_name' => 3, 'employee_id' => 4, 'first_name' => 5, 'last_name' => 6, 'employee_code' => 7, 'month' => 8, 'target_value' => 9, 'sales' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'MtdTargetAchivementTable.Id' => 'ID',
        'id' => 'ID',
        'mtdTargetAchivementTable.id' => 'ID',
        'MtdTargetAchivementTableTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'mtd_target_achivement_table.id' => 'ID',
        'CompanyId' => 'COMPANY_ID',
        'MtdTargetAchivementTable.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'mtdTargetAchivementTable.companyId' => 'COMPANY_ID',
        'MtdTargetAchivementTableTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'mtd_target_achivement_table.company_id' => 'COMPANY_ID',
        'TargetId' => 'TARGET_ID',
        'MtdTargetAchivementTable.TargetId' => 'TARGET_ID',
        'targetId' => 'TARGET_ID',
        'mtdTargetAchivementTable.targetId' => 'TARGET_ID',
        'MtdTargetAchivementTableTableMap::COL_TARGET_ID' => 'TARGET_ID',
        'COL_TARGET_ID' => 'TARGET_ID',
        'target_id' => 'TARGET_ID',
        'mtd_target_achivement_table.target_id' => 'TARGET_ID',
        'TargetName' => 'TARGET_NAME',
        'MtdTargetAchivementTable.TargetName' => 'TARGET_NAME',
        'targetName' => 'TARGET_NAME',
        'mtdTargetAchivementTable.targetName' => 'TARGET_NAME',
        'MtdTargetAchivementTableTableMap::COL_TARGET_NAME' => 'TARGET_NAME',
        'COL_TARGET_NAME' => 'TARGET_NAME',
        'target_name' => 'TARGET_NAME',
        'mtd_target_achivement_table.target_name' => 'TARGET_NAME',
        'EmployeeId' => 'EMPLOYEE_ID',
        'MtdTargetAchivementTable.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'mtdTargetAchivementTable.employeeId' => 'EMPLOYEE_ID',
        'MtdTargetAchivementTableTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'mtd_target_achivement_table.employee_id' => 'EMPLOYEE_ID',
        'FirstName' => 'FIRST_NAME',
        'MtdTargetAchivementTable.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'mtdTargetAchivementTable.firstName' => 'FIRST_NAME',
        'MtdTargetAchivementTableTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'mtd_target_achivement_table.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'MtdTargetAchivementTable.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'mtdTargetAchivementTable.lastName' => 'LAST_NAME',
        'MtdTargetAchivementTableTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'mtd_target_achivement_table.last_name' => 'LAST_NAME',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'MtdTargetAchivementTable.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'mtdTargetAchivementTable.employeeCode' => 'EMPLOYEE_CODE',
        'MtdTargetAchivementTableTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'mtd_target_achivement_table.employee_code' => 'EMPLOYEE_CODE',
        'Month' => 'MONTH',
        'MtdTargetAchivementTable.Month' => 'MONTH',
        'month' => 'MONTH',
        'mtdTargetAchivementTable.month' => 'MONTH',
        'MtdTargetAchivementTableTableMap::COL_MONTH' => 'MONTH',
        'COL_MONTH' => 'MONTH',
        'mtd_target_achivement_table.month' => 'MONTH',
        'TargetValue' => 'TARGET_VALUE',
        'MtdTargetAchivementTable.TargetValue' => 'TARGET_VALUE',
        'targetValue' => 'TARGET_VALUE',
        'mtdTargetAchivementTable.targetValue' => 'TARGET_VALUE',
        'MtdTargetAchivementTableTableMap::COL_TARGET_VALUE' => 'TARGET_VALUE',
        'COL_TARGET_VALUE' => 'TARGET_VALUE',
        'target_value' => 'TARGET_VALUE',
        'mtd_target_achivement_table.target_value' => 'TARGET_VALUE',
        'Sales' => 'SALES',
        'MtdTargetAchivementTable.Sales' => 'SALES',
        'sales' => 'SALES',
        'mtdTargetAchivementTable.sales' => 'SALES',
        'MtdTargetAchivementTableTableMap::COL_SALES' => 'SALES',
        'COL_SALES' => 'SALES',
        'mtd_target_achivement_table.sales' => 'SALES',
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
        $this->setName('mtd_target_achivement_table');
        $this->setPhpName('MtdTargetAchivementTable');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\MtdTargetAchivementTable');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('id', 'Id', 'VARCHAR', false, 58, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', true, null, null);
        $this->addColumn('target_id', 'TargetId', 'INTEGER', true, null, null);
        $this->addColumn('target_name', 'TargetName', 'VARCHAR', false, 100, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', true, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, 50, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, 50, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, 50, null);
        $this->addColumn('month', 'Month', 'VARCHAR', false, 7, null);
        $this->addColumn('target_value', 'TargetValue', 'DECIMAL', false, 20, null);
        $this->addColumn('sales', 'Sales', 'DECIMAL', false, 42, null);
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
        return null;
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
        return '';
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
        return $withPrefix ? MtdTargetAchivementTableTableMap::CLASS_DEFAULT : MtdTargetAchivementTableTableMap::OM_CLASS;
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
     * @return array (MtdTargetAchivementTable object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MtdTargetAchivementTableTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MtdTargetAchivementTableTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MtdTargetAchivementTableTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MtdTargetAchivementTableTableMap::OM_CLASS;
            /** @var MtdTargetAchivementTable $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MtdTargetAchivementTableTableMap::addInstanceToPool($obj, $key);
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
            $key = MtdTargetAchivementTableTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MtdTargetAchivementTableTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MtdTargetAchivementTable $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MtdTargetAchivementTableTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_ID);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_TARGET_ID);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_TARGET_NAME);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_MONTH);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_TARGET_VALUE);
            $criteria->addSelectColumn(MtdTargetAchivementTableTableMap::COL_SALES);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.target_id');
            $criteria->addSelectColumn($alias . '.target_name');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.month');
            $criteria->addSelectColumn($alias . '.target_value');
            $criteria->addSelectColumn($alias . '.sales');
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
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_ID);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_TARGET_ID);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_TARGET_NAME);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_MONTH);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_TARGET_VALUE);
            $criteria->removeSelectColumn(MtdTargetAchivementTableTableMap::COL_SALES);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.target_id');
            $criteria->removeSelectColumn($alias . '.target_name');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.month');
            $criteria->removeSelectColumn($alias . '.target_value');
            $criteria->removeSelectColumn($alias . '.sales');
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
        return Propel::getServiceContainer()->getDatabaseMap(MtdTargetAchivementTableTableMap::DATABASE_NAME)->getTable(MtdTargetAchivementTableTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a MtdTargetAchivementTable or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or MtdTargetAchivementTable object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MtdTargetAchivementTableTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\MtdTargetAchivementTable) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The MtdTargetAchivementTable object has no primary key');
        }

        $query = MtdTargetAchivementTableQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MtdTargetAchivementTableTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MtdTargetAchivementTableTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the mtd_target_achivement_table table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MtdTargetAchivementTableQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MtdTargetAchivementTable or Criteria object.
     *
     * @param mixed $criteria Criteria or MtdTargetAchivementTable object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtdTargetAchivementTableTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MtdTargetAchivementTable object
        }


        // Set the correct dbName
        $query = MtdTargetAchivementTableQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
