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
use entities\LeaveRequest;
use entities\LeaveRequestQuery;


/**
 * This class defines the structure of the 'leave_request' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LeaveRequestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.LeaveRequestTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'leave_request';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'LeaveRequest';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\LeaveRequest';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.LeaveRequest';

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
     * the column name for the leave_req_id field
     */
    public const COL_LEAVE_REQ_ID = 'leave_request.leave_req_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'leave_request.employee_id';

    /**
     * the column name for the leave_type field
     */
    public const COL_LEAVE_TYPE = 'leave_request.leave_type';

    /**
     * the column name for the leave_from field
     */
    public const COL_LEAVE_FROM = 'leave_request.leave_from';

    /**
     * the column name for the leave_to field
     */
    public const COL_LEAVE_TO = 'leave_request.leave_to';

    /**
     * the column name for the leave_status field
     */
    public const COL_LEAVE_STATUS = 'leave_request.leave_status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'leave_request.created_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'leave_request.company_id';

    /**
     * the column name for the leave_reason field
     */
    public const COL_LEAVE_REASON = 'leave_request.leave_reason';

    /**
     * the column name for the leave_reject_remark field
     */
    public const COL_LEAVE_REJECT_REMARK = 'leave_request.leave_reject_remark';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'leave_request.updated_at';

    /**
     * the column name for the leave_days field
     */
    public const COL_LEAVE_DAYS = 'leave_request.leave_days';

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
        self::TYPE_PHPNAME       => ['LeaveReqId', 'EmployeeId', 'LeaveType', 'LeaveFrom', 'LeaveTo', 'LeaveStatus', 'CreatedAt', 'CompanyId', 'LeaveReason', 'LeaveRejectRemark', 'UpdatedAt', 'LeaveDays', ],
        self::TYPE_CAMELNAME     => ['leaveReqId', 'employeeId', 'leaveType', 'leaveFrom', 'leaveTo', 'leaveStatus', 'createdAt', 'companyId', 'leaveReason', 'leaveRejectRemark', 'updatedAt', 'leaveDays', ],
        self::TYPE_COLNAME       => [LeaveRequestTableMap::COL_LEAVE_REQ_ID, LeaveRequestTableMap::COL_EMPLOYEE_ID, LeaveRequestTableMap::COL_LEAVE_TYPE, LeaveRequestTableMap::COL_LEAVE_FROM, LeaveRequestTableMap::COL_LEAVE_TO, LeaveRequestTableMap::COL_LEAVE_STATUS, LeaveRequestTableMap::COL_CREATED_AT, LeaveRequestTableMap::COL_COMPANY_ID, LeaveRequestTableMap::COL_LEAVE_REASON, LeaveRequestTableMap::COL_LEAVE_REJECT_REMARK, LeaveRequestTableMap::COL_UPDATED_AT, LeaveRequestTableMap::COL_LEAVE_DAYS, ],
        self::TYPE_FIELDNAME     => ['leave_req_id', 'employee_id', 'leave_type', 'leave_from', 'leave_to', 'leave_status', 'created_at', 'company_id', 'leave_reason', 'leave_reject_remark', 'updated_at', 'leave_days', ],
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
        self::TYPE_PHPNAME       => ['LeaveReqId' => 0, 'EmployeeId' => 1, 'LeaveType' => 2, 'LeaveFrom' => 3, 'LeaveTo' => 4, 'LeaveStatus' => 5, 'CreatedAt' => 6, 'CompanyId' => 7, 'LeaveReason' => 8, 'LeaveRejectRemark' => 9, 'UpdatedAt' => 10, 'LeaveDays' => 11, ],
        self::TYPE_CAMELNAME     => ['leaveReqId' => 0, 'employeeId' => 1, 'leaveType' => 2, 'leaveFrom' => 3, 'leaveTo' => 4, 'leaveStatus' => 5, 'createdAt' => 6, 'companyId' => 7, 'leaveReason' => 8, 'leaveRejectRemark' => 9, 'updatedAt' => 10, 'leaveDays' => 11, ],
        self::TYPE_COLNAME       => [LeaveRequestTableMap::COL_LEAVE_REQ_ID => 0, LeaveRequestTableMap::COL_EMPLOYEE_ID => 1, LeaveRequestTableMap::COL_LEAVE_TYPE => 2, LeaveRequestTableMap::COL_LEAVE_FROM => 3, LeaveRequestTableMap::COL_LEAVE_TO => 4, LeaveRequestTableMap::COL_LEAVE_STATUS => 5, LeaveRequestTableMap::COL_CREATED_AT => 6, LeaveRequestTableMap::COL_COMPANY_ID => 7, LeaveRequestTableMap::COL_LEAVE_REASON => 8, LeaveRequestTableMap::COL_LEAVE_REJECT_REMARK => 9, LeaveRequestTableMap::COL_UPDATED_AT => 10, LeaveRequestTableMap::COL_LEAVE_DAYS => 11, ],
        self::TYPE_FIELDNAME     => ['leave_req_id' => 0, 'employee_id' => 1, 'leave_type' => 2, 'leave_from' => 3, 'leave_to' => 4, 'leave_status' => 5, 'created_at' => 6, 'company_id' => 7, 'leave_reason' => 8, 'leave_reject_remark' => 9, 'updated_at' => 10, 'leave_days' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'LeaveReqId' => 'LEAVE_REQ_ID',
        'LeaveRequest.LeaveReqId' => 'LEAVE_REQ_ID',
        'leaveReqId' => 'LEAVE_REQ_ID',
        'leaveRequest.leaveReqId' => 'LEAVE_REQ_ID',
        'LeaveRequestTableMap::COL_LEAVE_REQ_ID' => 'LEAVE_REQ_ID',
        'COL_LEAVE_REQ_ID' => 'LEAVE_REQ_ID',
        'leave_req_id' => 'LEAVE_REQ_ID',
        'leave_request.leave_req_id' => 'LEAVE_REQ_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'LeaveRequest.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'leaveRequest.employeeId' => 'EMPLOYEE_ID',
        'LeaveRequestTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'leave_request.employee_id' => 'EMPLOYEE_ID',
        'LeaveType' => 'LEAVE_TYPE',
        'LeaveRequest.LeaveType' => 'LEAVE_TYPE',
        'leaveType' => 'LEAVE_TYPE',
        'leaveRequest.leaveType' => 'LEAVE_TYPE',
        'LeaveRequestTableMap::COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'leave_type' => 'LEAVE_TYPE',
        'leave_request.leave_type' => 'LEAVE_TYPE',
        'LeaveFrom' => 'LEAVE_FROM',
        'LeaveRequest.LeaveFrom' => 'LEAVE_FROM',
        'leaveFrom' => 'LEAVE_FROM',
        'leaveRequest.leaveFrom' => 'LEAVE_FROM',
        'LeaveRequestTableMap::COL_LEAVE_FROM' => 'LEAVE_FROM',
        'COL_LEAVE_FROM' => 'LEAVE_FROM',
        'leave_from' => 'LEAVE_FROM',
        'leave_request.leave_from' => 'LEAVE_FROM',
        'LeaveTo' => 'LEAVE_TO',
        'LeaveRequest.LeaveTo' => 'LEAVE_TO',
        'leaveTo' => 'LEAVE_TO',
        'leaveRequest.leaveTo' => 'LEAVE_TO',
        'LeaveRequestTableMap::COL_LEAVE_TO' => 'LEAVE_TO',
        'COL_LEAVE_TO' => 'LEAVE_TO',
        'leave_to' => 'LEAVE_TO',
        'leave_request.leave_to' => 'LEAVE_TO',
        'LeaveStatus' => 'LEAVE_STATUS',
        'LeaveRequest.LeaveStatus' => 'LEAVE_STATUS',
        'leaveStatus' => 'LEAVE_STATUS',
        'leaveRequest.leaveStatus' => 'LEAVE_STATUS',
        'LeaveRequestTableMap::COL_LEAVE_STATUS' => 'LEAVE_STATUS',
        'COL_LEAVE_STATUS' => 'LEAVE_STATUS',
        'leave_status' => 'LEAVE_STATUS',
        'leave_request.leave_status' => 'LEAVE_STATUS',
        'CreatedAt' => 'CREATED_AT',
        'LeaveRequest.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'leaveRequest.createdAt' => 'CREATED_AT',
        'LeaveRequestTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'leave_request.created_at' => 'CREATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'LeaveRequest.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'leaveRequest.companyId' => 'COMPANY_ID',
        'LeaveRequestTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'leave_request.company_id' => 'COMPANY_ID',
        'LeaveReason' => 'LEAVE_REASON',
        'LeaveRequest.LeaveReason' => 'LEAVE_REASON',
        'leaveReason' => 'LEAVE_REASON',
        'leaveRequest.leaveReason' => 'LEAVE_REASON',
        'LeaveRequestTableMap::COL_LEAVE_REASON' => 'LEAVE_REASON',
        'COL_LEAVE_REASON' => 'LEAVE_REASON',
        'leave_reason' => 'LEAVE_REASON',
        'leave_request.leave_reason' => 'LEAVE_REASON',
        'LeaveRejectRemark' => 'LEAVE_REJECT_REMARK',
        'LeaveRequest.LeaveRejectRemark' => 'LEAVE_REJECT_REMARK',
        'leaveRejectRemark' => 'LEAVE_REJECT_REMARK',
        'leaveRequest.leaveRejectRemark' => 'LEAVE_REJECT_REMARK',
        'LeaveRequestTableMap::COL_LEAVE_REJECT_REMARK' => 'LEAVE_REJECT_REMARK',
        'COL_LEAVE_REJECT_REMARK' => 'LEAVE_REJECT_REMARK',
        'leave_reject_remark' => 'LEAVE_REJECT_REMARK',
        'leave_request.leave_reject_remark' => 'LEAVE_REJECT_REMARK',
        'UpdatedAt' => 'UPDATED_AT',
        'LeaveRequest.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'leaveRequest.updatedAt' => 'UPDATED_AT',
        'LeaveRequestTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'leave_request.updated_at' => 'UPDATED_AT',
        'LeaveDays' => 'LEAVE_DAYS',
        'LeaveRequest.LeaveDays' => 'LEAVE_DAYS',
        'leaveDays' => 'LEAVE_DAYS',
        'leaveRequest.leaveDays' => 'LEAVE_DAYS',
        'LeaveRequestTableMap::COL_LEAVE_DAYS' => 'LEAVE_DAYS',
        'COL_LEAVE_DAYS' => 'LEAVE_DAYS',
        'leave_days' => 'LEAVE_DAYS',
        'leave_request.leave_days' => 'LEAVE_DAYS',
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
        $this->setName('leave_request');
        $this->setPhpName('LeaveRequest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\LeaveRequest');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('leave_request_leave_req_id_seq');
        // columns
        $this->addPrimaryKey('leave_req_id', 'LeaveReqId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addColumn('leave_type', 'LeaveType', 'VARCHAR', true, null, null);
        $this->addColumn('leave_from', 'LeaveFrom', 'DATE', true, null, null);
        $this->addColumn('leave_to', 'LeaveTo', 'DATE', true, null, null);
        $this->addColumn('leave_status', 'LeaveStatus', 'INTEGER', true, null, 1);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('leave_reason', 'LeaveReason', 'VARCHAR', false, null, null);
        $this->addColumn('leave_reject_remark', 'LeaveRejectRemark', 'LONGVARCHAR', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveReqId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveReqId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveReqId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveReqId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveReqId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveReqId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('LeaveReqId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LeaveRequestTableMap::CLASS_DEFAULT : LeaveRequestTableMap::OM_CLASS;
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
     * @return array (LeaveRequest object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LeaveRequestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LeaveRequestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LeaveRequestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeaveRequestTableMap::OM_CLASS;
            /** @var LeaveRequest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LeaveRequestTableMap::addInstanceToPool($obj, $key);
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
            $key = LeaveRequestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LeaveRequestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LeaveRequest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeaveRequestTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_LEAVE_REQ_ID);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_LEAVE_TYPE);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_LEAVE_FROM);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_LEAVE_TO);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_LEAVE_STATUS);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_LEAVE_REASON);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_LEAVE_REJECT_REMARK);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(LeaveRequestTableMap::COL_LEAVE_DAYS);
        } else {
            $criteria->addSelectColumn($alias . '.leave_req_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.leave_type');
            $criteria->addSelectColumn($alias . '.leave_from');
            $criteria->addSelectColumn($alias . '.leave_to');
            $criteria->addSelectColumn($alias . '.leave_status');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.leave_reason');
            $criteria->addSelectColumn($alias . '.leave_reject_remark');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_LEAVE_REQ_ID);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_LEAVE_TYPE);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_LEAVE_FROM);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_LEAVE_TO);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_LEAVE_STATUS);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_LEAVE_REASON);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_LEAVE_REJECT_REMARK);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(LeaveRequestTableMap::COL_LEAVE_DAYS);
        } else {
            $criteria->removeSelectColumn($alias . '.leave_req_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.leave_type');
            $criteria->removeSelectColumn($alias . '.leave_from');
            $criteria->removeSelectColumn($alias . '.leave_to');
            $criteria->removeSelectColumn($alias . '.leave_status');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.leave_reason');
            $criteria->removeSelectColumn($alias . '.leave_reject_remark');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(LeaveRequestTableMap::DATABASE_NAME)->getTable(LeaveRequestTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LeaveRequest or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or LeaveRequest object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveRequestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\LeaveRequest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeaveRequestTableMap::DATABASE_NAME);
            $criteria->add(LeaveRequestTableMap::COL_LEAVE_REQ_ID, (array) $values, Criteria::IN);
        }

        $query = LeaveRequestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LeaveRequestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LeaveRequestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the leave_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LeaveRequestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LeaveRequest or Criteria object.
     *
     * @param mixed $criteria Criteria or LeaveRequest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveRequestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LeaveRequest object
        }

        if ($criteria->containsKey(LeaveRequestTableMap::COL_LEAVE_REQ_ID) && $criteria->keyContainsValue(LeaveRequestTableMap::COL_LEAVE_REQ_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeaveRequestTableMap::COL_LEAVE_REQ_ID.')');
        }


        // Set the correct dbName
        $query = LeaveRequestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
