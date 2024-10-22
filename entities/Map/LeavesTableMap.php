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
use entities\Leaves;
use entities\LeavesQuery;


/**
 * This class defines the structure of the 'leaves' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LeavesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.LeavesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'leaves';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Leaves';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Leaves';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Leaves';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the leave_id field
     */
    public const COL_LEAVE_ID = 'leaves.leave_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'leaves.employee_id';

    /**
     * the column name for the leave_request_id field
     */
    public const COL_LEAVE_REQUEST_ID = 'leaves.leave_request_id';

    /**
     * the column name for the leave_date field
     */
    public const COL_LEAVE_DATE = 'leaves.leave_date';

    /**
     * the column name for the leave_type field
     */
    public const COL_LEAVE_TYPE = 'leaves.leave_type';

    /**
     * the column name for the leave_remark field
     */
    public const COL_LEAVE_REMARK = 'leaves.leave_remark';

    /**
     * the column name for the leave_points field
     */
    public const COL_LEAVE_POINTS = 'leaves.leave_points';

    /**
     * the column name for the leave_system_remarks field
     */
    public const COL_LEAVE_SYSTEM_REMARKS = 'leaves.leave_system_remarks';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'leaves.created_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'leaves.company_id';

    /**
     * the column name for the leave_tran_mode field
     */
    public const COL_LEAVE_TRAN_MODE = 'leaves.leave_tran_mode';

    /**
     * the column name for the leave_days field
     */
    public const COL_LEAVE_DAYS = 'leaves.leave_days';

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
        self::TYPE_PHPNAME       => ['LeaveId', 'EmployeeId', 'LeaveRequestId', 'LeaveDate', 'LeaveType', 'LeaveRemark', 'LeavePoints', 'LeaveSystemRemarks', 'CreatedAt', 'CompanyId', 'LeaveTranMode', 'LeaveDays', ],
        self::TYPE_CAMELNAME     => ['leaveId', 'employeeId', 'leaveRequestId', 'leaveDate', 'leaveType', 'leaveRemark', 'leavePoints', 'leaveSystemRemarks', 'createdAt', 'companyId', 'leaveTranMode', 'leaveDays', ],
        self::TYPE_COLNAME       => [LeavesTableMap::COL_LEAVE_ID, LeavesTableMap::COL_EMPLOYEE_ID, LeavesTableMap::COL_LEAVE_REQUEST_ID, LeavesTableMap::COL_LEAVE_DATE, LeavesTableMap::COL_LEAVE_TYPE, LeavesTableMap::COL_LEAVE_REMARK, LeavesTableMap::COL_LEAVE_POINTS, LeavesTableMap::COL_LEAVE_SYSTEM_REMARKS, LeavesTableMap::COL_CREATED_AT, LeavesTableMap::COL_COMPANY_ID, LeavesTableMap::COL_LEAVE_TRAN_MODE, LeavesTableMap::COL_LEAVE_DAYS, ],
        self::TYPE_FIELDNAME     => ['leave_id', 'employee_id', 'leave_request_id', 'leave_date', 'leave_type', 'leave_remark', 'leave_points', 'leave_system_remarks', 'created_at', 'company_id', 'leave_tran_mode', 'leave_days', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['LeaveId' => 0, 'EmployeeId' => 1, 'LeaveRequestId' => 2, 'LeaveDate' => 3, 'LeaveType' => 4, 'LeaveRemark' => 5, 'LeavePoints' => 6, 'LeaveSystemRemarks' => 7, 'CreatedAt' => 8, 'CompanyId' => 9, 'LeaveTranMode' => 10, 'LeaveDays' => 11, ],
        self::TYPE_CAMELNAME     => ['leaveId' => 0, 'employeeId' => 1, 'leaveRequestId' => 2, 'leaveDate' => 3, 'leaveType' => 4, 'leaveRemark' => 5, 'leavePoints' => 6, 'leaveSystemRemarks' => 7, 'createdAt' => 8, 'companyId' => 9, 'leaveTranMode' => 10, 'leaveDays' => 11, ],
        self::TYPE_COLNAME       => [LeavesTableMap::COL_LEAVE_ID => 0, LeavesTableMap::COL_EMPLOYEE_ID => 1, LeavesTableMap::COL_LEAVE_REQUEST_ID => 2, LeavesTableMap::COL_LEAVE_DATE => 3, LeavesTableMap::COL_LEAVE_TYPE => 4, LeavesTableMap::COL_LEAVE_REMARK => 5, LeavesTableMap::COL_LEAVE_POINTS => 6, LeavesTableMap::COL_LEAVE_SYSTEM_REMARKS => 7, LeavesTableMap::COL_CREATED_AT => 8, LeavesTableMap::COL_COMPANY_ID => 9, LeavesTableMap::COL_LEAVE_TRAN_MODE => 10, LeavesTableMap::COL_LEAVE_DAYS => 11, ],
        self::TYPE_FIELDNAME     => ['leave_id' => 0, 'employee_id' => 1, 'leave_request_id' => 2, 'leave_date' => 3, 'leave_type' => 4, 'leave_remark' => 5, 'leave_points' => 6, 'leave_system_remarks' => 7, 'created_at' => 8, 'company_id' => 9, 'leave_tran_mode' => 10, 'leave_days' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'LeaveId' => 'LEAVE_ID',
        'Leaves.LeaveId' => 'LEAVE_ID',
        'leaveId' => 'LEAVE_ID',
        'leaves.leaveId' => 'LEAVE_ID',
        'LeavesTableMap::COL_LEAVE_ID' => 'LEAVE_ID',
        'COL_LEAVE_ID' => 'LEAVE_ID',
        'leave_id' => 'LEAVE_ID',
        'leaves.leave_id' => 'LEAVE_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Leaves.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'leaves.employeeId' => 'EMPLOYEE_ID',
        'LeavesTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'leaves.employee_id' => 'EMPLOYEE_ID',
        'LeaveRequestId' => 'LEAVE_REQUEST_ID',
        'Leaves.LeaveRequestId' => 'LEAVE_REQUEST_ID',
        'leaveRequestId' => 'LEAVE_REQUEST_ID',
        'leaves.leaveRequestId' => 'LEAVE_REQUEST_ID',
        'LeavesTableMap::COL_LEAVE_REQUEST_ID' => 'LEAVE_REQUEST_ID',
        'COL_LEAVE_REQUEST_ID' => 'LEAVE_REQUEST_ID',
        'leave_request_id' => 'LEAVE_REQUEST_ID',
        'leaves.leave_request_id' => 'LEAVE_REQUEST_ID',
        'LeaveDate' => 'LEAVE_DATE',
        'Leaves.LeaveDate' => 'LEAVE_DATE',
        'leaveDate' => 'LEAVE_DATE',
        'leaves.leaveDate' => 'LEAVE_DATE',
        'LeavesTableMap::COL_LEAVE_DATE' => 'LEAVE_DATE',
        'COL_LEAVE_DATE' => 'LEAVE_DATE',
        'leave_date' => 'LEAVE_DATE',
        'leaves.leave_date' => 'LEAVE_DATE',
        'LeaveType' => 'LEAVE_TYPE',
        'Leaves.LeaveType' => 'LEAVE_TYPE',
        'leaveType' => 'LEAVE_TYPE',
        'leaves.leaveType' => 'LEAVE_TYPE',
        'LeavesTableMap::COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'leave_type' => 'LEAVE_TYPE',
        'leaves.leave_type' => 'LEAVE_TYPE',
        'LeaveRemark' => 'LEAVE_REMARK',
        'Leaves.LeaveRemark' => 'LEAVE_REMARK',
        'leaveRemark' => 'LEAVE_REMARK',
        'leaves.leaveRemark' => 'LEAVE_REMARK',
        'LeavesTableMap::COL_LEAVE_REMARK' => 'LEAVE_REMARK',
        'COL_LEAVE_REMARK' => 'LEAVE_REMARK',
        'leave_remark' => 'LEAVE_REMARK',
        'leaves.leave_remark' => 'LEAVE_REMARK',
        'LeavePoints' => 'LEAVE_POINTS',
        'Leaves.LeavePoints' => 'LEAVE_POINTS',
        'leavePoints' => 'LEAVE_POINTS',
        'leaves.leavePoints' => 'LEAVE_POINTS',
        'LeavesTableMap::COL_LEAVE_POINTS' => 'LEAVE_POINTS',
        'COL_LEAVE_POINTS' => 'LEAVE_POINTS',
        'leave_points' => 'LEAVE_POINTS',
        'leaves.leave_points' => 'LEAVE_POINTS',
        'LeaveSystemRemarks' => 'LEAVE_SYSTEM_REMARKS',
        'Leaves.LeaveSystemRemarks' => 'LEAVE_SYSTEM_REMARKS',
        'leaveSystemRemarks' => 'LEAVE_SYSTEM_REMARKS',
        'leaves.leaveSystemRemarks' => 'LEAVE_SYSTEM_REMARKS',
        'LeavesTableMap::COL_LEAVE_SYSTEM_REMARKS' => 'LEAVE_SYSTEM_REMARKS',
        'COL_LEAVE_SYSTEM_REMARKS' => 'LEAVE_SYSTEM_REMARKS',
        'leave_system_remarks' => 'LEAVE_SYSTEM_REMARKS',
        'leaves.leave_system_remarks' => 'LEAVE_SYSTEM_REMARKS',
        'CreatedAt' => 'CREATED_AT',
        'Leaves.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'leaves.createdAt' => 'CREATED_AT',
        'LeavesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'leaves.created_at' => 'CREATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'Leaves.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'leaves.companyId' => 'COMPANY_ID',
        'LeavesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'leaves.company_id' => 'COMPANY_ID',
        'LeaveTranMode' => 'LEAVE_TRAN_MODE',
        'Leaves.LeaveTranMode' => 'LEAVE_TRAN_MODE',
        'leaveTranMode' => 'LEAVE_TRAN_MODE',
        'leaves.leaveTranMode' => 'LEAVE_TRAN_MODE',
        'LeavesTableMap::COL_LEAVE_TRAN_MODE' => 'LEAVE_TRAN_MODE',
        'COL_LEAVE_TRAN_MODE' => 'LEAVE_TRAN_MODE',
        'leave_tran_mode' => 'LEAVE_TRAN_MODE',
        'leaves.leave_tran_mode' => 'LEAVE_TRAN_MODE',
        'LeaveDays' => 'LEAVE_DAYS',
        'Leaves.LeaveDays' => 'LEAVE_DAYS',
        'leaveDays' => 'LEAVE_DAYS',
        'leaves.leaveDays' => 'LEAVE_DAYS',
        'LeavesTableMap::COL_LEAVE_DAYS' => 'LEAVE_DAYS',
        'COL_LEAVE_DAYS' => 'LEAVE_DAYS',
        'leave_days' => 'LEAVE_DAYS',
        'leaves.leave_days' => 'LEAVE_DAYS',
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
        $this->setName('leaves');
        $this->setPhpName('Leaves');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Leaves');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('leaves_leave_id_seq');
        // columns
        $this->addPrimaryKey('leave_id', 'LeaveId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('leave_request_id', 'LeaveRequestId', 'INTEGER', false, null, null);
        $this->addColumn('leave_date', 'LeaveDate', 'DATE', false, null, null);
        $this->addColumn('leave_type', 'LeaveType', 'VARCHAR', false, null, null);
        $this->addColumn('leave_remark', 'LeaveRemark', 'VARCHAR', false, null, null);
        $this->addColumn('leave_points', 'LeavePoints', 'DECIMAL', false, null, null);
        $this->addColumn('leave_system_remarks', 'LeaveSystemRemarks', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('leave_tran_mode', 'LeaveTranMode', 'VARCHAR', false, null, null);
        $this->addColumn('leave_days', 'LeaveDays', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('LeaveId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LeavesTableMap::CLASS_DEFAULT : LeavesTableMap::OM_CLASS;
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
     * @return array (Leaves object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LeavesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LeavesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LeavesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeavesTableMap::OM_CLASS;
            /** @var Leaves $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LeavesTableMap::addInstanceToPool($obj, $key);
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
            $key = LeavesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LeavesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Leaves $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeavesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_ID);
            $criteria->addSelectColumn(LeavesTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_REQUEST_ID);
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_DATE);
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_TYPE);
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_REMARK);
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_POINTS);
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_SYSTEM_REMARKS);
            $criteria->addSelectColumn(LeavesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LeavesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_TRAN_MODE);
            $criteria->addSelectColumn(LeavesTableMap::COL_LEAVE_DAYS);
        } else {
            $criteria->addSelectColumn($alias . '.leave_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.leave_request_id');
            $criteria->addSelectColumn($alias . '.leave_date');
            $criteria->addSelectColumn($alias . '.leave_type');
            $criteria->addSelectColumn($alias . '.leave_remark');
            $criteria->addSelectColumn($alias . '.leave_points');
            $criteria->addSelectColumn($alias . '.leave_system_remarks');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.leave_tran_mode');
            $criteria->addSelectColumn($alias . '.leave_days');
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
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_ID);
            $criteria->removeSelectColumn(LeavesTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_REQUEST_ID);
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_DATE);
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_TYPE);
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_REMARK);
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_POINTS);
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_SYSTEM_REMARKS);
            $criteria->removeSelectColumn(LeavesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LeavesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_TRAN_MODE);
            $criteria->removeSelectColumn(LeavesTableMap::COL_LEAVE_DAYS);
        } else {
            $criteria->removeSelectColumn($alias . '.leave_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.leave_request_id');
            $criteria->removeSelectColumn($alias . '.leave_date');
            $criteria->removeSelectColumn($alias . '.leave_type');
            $criteria->removeSelectColumn($alias . '.leave_remark');
            $criteria->removeSelectColumn($alias . '.leave_points');
            $criteria->removeSelectColumn($alias . '.leave_system_remarks');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.leave_tran_mode');
            $criteria->removeSelectColumn($alias . '.leave_days');
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
        return Propel::getServiceContainer()->getDatabaseMap(LeavesTableMap::DATABASE_NAME)->getTable(LeavesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Leaves or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Leaves object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LeavesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Leaves) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeavesTableMap::DATABASE_NAME);
            $criteria->add(LeavesTableMap::COL_LEAVE_ID, (array) $values, Criteria::IN);
        }

        $query = LeavesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LeavesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LeavesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the leaves table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LeavesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Leaves or Criteria object.
     *
     * @param mixed $criteria Criteria or Leaves object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeavesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Leaves object
        }

        if ($criteria->containsKey(LeavesTableMap::COL_LEAVE_ID) && $criteria->keyContainsValue(LeavesTableMap::COL_LEAVE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeavesTableMap::COL_LEAVE_ID.')');
        }


        // Set the correct dbName
        $query = LeavesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
