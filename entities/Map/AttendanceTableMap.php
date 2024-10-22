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
use entities\Attendance;
use entities\AttendanceQuery;


/**
 * This class defines the structure of the 'attendance' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AttendanceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.AttendanceTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'attendance';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Attendance';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Attendance';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Attendance';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 24;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 24;

    /**
     * the column name for the attendance_id field
     */
    public const COL_ATTENDANCE_ID = 'attendance.attendance_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'attendance.employee_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'attendance.company_id';

    /**
     * the column name for the attendance_date field
     */
    public const COL_ATTENDANCE_DATE = 'attendance.attendance_date';

    /**
     * the column name for the start_time field
     */
    public const COL_START_TIME = 'attendance.start_time';

    /**
     * the column name for the end_time field
     */
    public const COL_END_TIME = 'attendance.end_time';

    /**
     * the column name for the start_latlng field
     */
    public const COL_START_LATLNG = 'attendance.start_latlng';

    /**
     * the column name for the start_address field
     */
    public const COL_START_ADDRESS = 'attendance.start_address';

    /**
     * the column name for the end_latlng field
     */
    public const COL_END_LATLNG = 'attendance.end_latlng';

    /**
     * the column name for the end_address field
     */
    public const COL_END_ADDRESS = 'attendance.end_address';

    /**
     * the column name for the shift_mins field
     */
    public const COL_SHIFT_MINS = 'attendance.shift_mins';

    /**
     * the column name for the joint_emp field
     */
    public const COL_JOINT_EMP = 'attendance.joint_emp';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'attendance.remark';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'attendance.status';

    /**
     * the column name for the outlet_count field
     */
    public const COL_OUTLET_COUNT = 'attendance.outlet_count';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'attendance.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'attendance.updated_at';

    /**
     * the column name for the start_itownid field
     */
    public const COL_START_ITOWNID = 'attendance.start_itownid';

    /**
     * the column name for the end_itownid field
     */
    public const COL_END_ITOWNID = 'attendance.end_itownid';

    /**
     * the column name for the visited_itownid field
     */
    public const COL_VISITED_ITOWNID = 'attendance.visited_itownid';

    /**
     * the column name for the expense_id field
     */
    public const COL_EXPENSE_ID = 'attendance.expense_id';

    /**
     * the column name for the is_updated field
     */
    public const COL_IS_UPDATED = 'attendance.is_updated';

    /**
     * the column name for the expense_generated field
     */
    public const COL_EXPENSE_GENERATED = 'attendance.expense_generated';

    /**
     * the column name for the expense_remark field
     */
    public const COL_EXPENSE_REMARK = 'attendance.expense_remark';

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
        self::TYPE_PHPNAME       => ['AttendanceId', 'EmployeeId', 'CompanyId', 'AttendanceDate', 'StartTime', 'EndTime', 'StartLatlng', 'StartAddress', 'EndLatlng', 'EndAddress', 'ShiftMins', 'JointEmp', 'Remark', 'Status', 'OutletCount', 'CreatedAt', 'UpdatedAt', 'StartItownid', 'EndItownid', 'VisitedItownid', 'ExpenseId', 'IsUpdated', 'ExpenseGenerated', 'ExpenseRemark', ],
        self::TYPE_CAMELNAME     => ['attendanceId', 'employeeId', 'companyId', 'attendanceDate', 'startTime', 'endTime', 'startLatlng', 'startAddress', 'endLatlng', 'endAddress', 'shiftMins', 'jointEmp', 'remark', 'status', 'outletCount', 'createdAt', 'updatedAt', 'startItownid', 'endItownid', 'visitedItownid', 'expenseId', 'isUpdated', 'expenseGenerated', 'expenseRemark', ],
        self::TYPE_COLNAME       => [AttendanceTableMap::COL_ATTENDANCE_ID, AttendanceTableMap::COL_EMPLOYEE_ID, AttendanceTableMap::COL_COMPANY_ID, AttendanceTableMap::COL_ATTENDANCE_DATE, AttendanceTableMap::COL_START_TIME, AttendanceTableMap::COL_END_TIME, AttendanceTableMap::COL_START_LATLNG, AttendanceTableMap::COL_START_ADDRESS, AttendanceTableMap::COL_END_LATLNG, AttendanceTableMap::COL_END_ADDRESS, AttendanceTableMap::COL_SHIFT_MINS, AttendanceTableMap::COL_JOINT_EMP, AttendanceTableMap::COL_REMARK, AttendanceTableMap::COL_STATUS, AttendanceTableMap::COL_OUTLET_COUNT, AttendanceTableMap::COL_CREATED_AT, AttendanceTableMap::COL_UPDATED_AT, AttendanceTableMap::COL_START_ITOWNID, AttendanceTableMap::COL_END_ITOWNID, AttendanceTableMap::COL_VISITED_ITOWNID, AttendanceTableMap::COL_EXPENSE_ID, AttendanceTableMap::COL_IS_UPDATED, AttendanceTableMap::COL_EXPENSE_GENERATED, AttendanceTableMap::COL_EXPENSE_REMARK, ],
        self::TYPE_FIELDNAME     => ['attendance_id', 'employee_id', 'company_id', 'attendance_date', 'start_time', 'end_time', 'start_latlng', 'start_address', 'end_latlng', 'end_address', 'shift_mins', 'joint_emp', 'remark', 'status', 'outlet_count', 'created_at', 'updated_at', 'start_itownid', 'end_itownid', 'visited_itownid', 'expense_id', 'is_updated', 'expense_generated', 'expense_remark', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, ]
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
        self::TYPE_PHPNAME       => ['AttendanceId' => 0, 'EmployeeId' => 1, 'CompanyId' => 2, 'AttendanceDate' => 3, 'StartTime' => 4, 'EndTime' => 5, 'StartLatlng' => 6, 'StartAddress' => 7, 'EndLatlng' => 8, 'EndAddress' => 9, 'ShiftMins' => 10, 'JointEmp' => 11, 'Remark' => 12, 'Status' => 13, 'OutletCount' => 14, 'CreatedAt' => 15, 'UpdatedAt' => 16, 'StartItownid' => 17, 'EndItownid' => 18, 'VisitedItownid' => 19, 'ExpenseId' => 20, 'IsUpdated' => 21, 'ExpenseGenerated' => 22, 'ExpenseRemark' => 23, ],
        self::TYPE_CAMELNAME     => ['attendanceId' => 0, 'employeeId' => 1, 'companyId' => 2, 'attendanceDate' => 3, 'startTime' => 4, 'endTime' => 5, 'startLatlng' => 6, 'startAddress' => 7, 'endLatlng' => 8, 'endAddress' => 9, 'shiftMins' => 10, 'jointEmp' => 11, 'remark' => 12, 'status' => 13, 'outletCount' => 14, 'createdAt' => 15, 'updatedAt' => 16, 'startItownid' => 17, 'endItownid' => 18, 'visitedItownid' => 19, 'expenseId' => 20, 'isUpdated' => 21, 'expenseGenerated' => 22, 'expenseRemark' => 23, ],
        self::TYPE_COLNAME       => [AttendanceTableMap::COL_ATTENDANCE_ID => 0, AttendanceTableMap::COL_EMPLOYEE_ID => 1, AttendanceTableMap::COL_COMPANY_ID => 2, AttendanceTableMap::COL_ATTENDANCE_DATE => 3, AttendanceTableMap::COL_START_TIME => 4, AttendanceTableMap::COL_END_TIME => 5, AttendanceTableMap::COL_START_LATLNG => 6, AttendanceTableMap::COL_START_ADDRESS => 7, AttendanceTableMap::COL_END_LATLNG => 8, AttendanceTableMap::COL_END_ADDRESS => 9, AttendanceTableMap::COL_SHIFT_MINS => 10, AttendanceTableMap::COL_JOINT_EMP => 11, AttendanceTableMap::COL_REMARK => 12, AttendanceTableMap::COL_STATUS => 13, AttendanceTableMap::COL_OUTLET_COUNT => 14, AttendanceTableMap::COL_CREATED_AT => 15, AttendanceTableMap::COL_UPDATED_AT => 16, AttendanceTableMap::COL_START_ITOWNID => 17, AttendanceTableMap::COL_END_ITOWNID => 18, AttendanceTableMap::COL_VISITED_ITOWNID => 19, AttendanceTableMap::COL_EXPENSE_ID => 20, AttendanceTableMap::COL_IS_UPDATED => 21, AttendanceTableMap::COL_EXPENSE_GENERATED => 22, AttendanceTableMap::COL_EXPENSE_REMARK => 23, ],
        self::TYPE_FIELDNAME     => ['attendance_id' => 0, 'employee_id' => 1, 'company_id' => 2, 'attendance_date' => 3, 'start_time' => 4, 'end_time' => 5, 'start_latlng' => 6, 'start_address' => 7, 'end_latlng' => 8, 'end_address' => 9, 'shift_mins' => 10, 'joint_emp' => 11, 'remark' => 12, 'status' => 13, 'outlet_count' => 14, 'created_at' => 15, 'updated_at' => 16, 'start_itownid' => 17, 'end_itownid' => 18, 'visited_itownid' => 19, 'expense_id' => 20, 'is_updated' => 21, 'expense_generated' => 22, 'expense_remark' => 23, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'AttendanceId' => 'ATTENDANCE_ID',
        'Attendance.AttendanceId' => 'ATTENDANCE_ID',
        'attendanceId' => 'ATTENDANCE_ID',
        'attendance.attendanceId' => 'ATTENDANCE_ID',
        'AttendanceTableMap::COL_ATTENDANCE_ID' => 'ATTENDANCE_ID',
        'COL_ATTENDANCE_ID' => 'ATTENDANCE_ID',
        'attendance_id' => 'ATTENDANCE_ID',
        'attendance.attendance_id' => 'ATTENDANCE_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Attendance.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'attendance.employeeId' => 'EMPLOYEE_ID',
        'AttendanceTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'attendance.employee_id' => 'EMPLOYEE_ID',
        'CompanyId' => 'COMPANY_ID',
        'Attendance.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'attendance.companyId' => 'COMPANY_ID',
        'AttendanceTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'attendance.company_id' => 'COMPANY_ID',
        'AttendanceDate' => 'ATTENDANCE_DATE',
        'Attendance.AttendanceDate' => 'ATTENDANCE_DATE',
        'attendanceDate' => 'ATTENDANCE_DATE',
        'attendance.attendanceDate' => 'ATTENDANCE_DATE',
        'AttendanceTableMap::COL_ATTENDANCE_DATE' => 'ATTENDANCE_DATE',
        'COL_ATTENDANCE_DATE' => 'ATTENDANCE_DATE',
        'attendance_date' => 'ATTENDANCE_DATE',
        'attendance.attendance_date' => 'ATTENDANCE_DATE',
        'StartTime' => 'START_TIME',
        'Attendance.StartTime' => 'START_TIME',
        'startTime' => 'START_TIME',
        'attendance.startTime' => 'START_TIME',
        'AttendanceTableMap::COL_START_TIME' => 'START_TIME',
        'COL_START_TIME' => 'START_TIME',
        'start_time' => 'START_TIME',
        'attendance.start_time' => 'START_TIME',
        'EndTime' => 'END_TIME',
        'Attendance.EndTime' => 'END_TIME',
        'endTime' => 'END_TIME',
        'attendance.endTime' => 'END_TIME',
        'AttendanceTableMap::COL_END_TIME' => 'END_TIME',
        'COL_END_TIME' => 'END_TIME',
        'end_time' => 'END_TIME',
        'attendance.end_time' => 'END_TIME',
        'StartLatlng' => 'START_LATLNG',
        'Attendance.StartLatlng' => 'START_LATLNG',
        'startLatlng' => 'START_LATLNG',
        'attendance.startLatlng' => 'START_LATLNG',
        'AttendanceTableMap::COL_START_LATLNG' => 'START_LATLNG',
        'COL_START_LATLNG' => 'START_LATLNG',
        'start_latlng' => 'START_LATLNG',
        'attendance.start_latlng' => 'START_LATLNG',
        'StartAddress' => 'START_ADDRESS',
        'Attendance.StartAddress' => 'START_ADDRESS',
        'startAddress' => 'START_ADDRESS',
        'attendance.startAddress' => 'START_ADDRESS',
        'AttendanceTableMap::COL_START_ADDRESS' => 'START_ADDRESS',
        'COL_START_ADDRESS' => 'START_ADDRESS',
        'start_address' => 'START_ADDRESS',
        'attendance.start_address' => 'START_ADDRESS',
        'EndLatlng' => 'END_LATLNG',
        'Attendance.EndLatlng' => 'END_LATLNG',
        'endLatlng' => 'END_LATLNG',
        'attendance.endLatlng' => 'END_LATLNG',
        'AttendanceTableMap::COL_END_LATLNG' => 'END_LATLNG',
        'COL_END_LATLNG' => 'END_LATLNG',
        'end_latlng' => 'END_LATLNG',
        'attendance.end_latlng' => 'END_LATLNG',
        'EndAddress' => 'END_ADDRESS',
        'Attendance.EndAddress' => 'END_ADDRESS',
        'endAddress' => 'END_ADDRESS',
        'attendance.endAddress' => 'END_ADDRESS',
        'AttendanceTableMap::COL_END_ADDRESS' => 'END_ADDRESS',
        'COL_END_ADDRESS' => 'END_ADDRESS',
        'end_address' => 'END_ADDRESS',
        'attendance.end_address' => 'END_ADDRESS',
        'ShiftMins' => 'SHIFT_MINS',
        'Attendance.ShiftMins' => 'SHIFT_MINS',
        'shiftMins' => 'SHIFT_MINS',
        'attendance.shiftMins' => 'SHIFT_MINS',
        'AttendanceTableMap::COL_SHIFT_MINS' => 'SHIFT_MINS',
        'COL_SHIFT_MINS' => 'SHIFT_MINS',
        'shift_mins' => 'SHIFT_MINS',
        'attendance.shift_mins' => 'SHIFT_MINS',
        'JointEmp' => 'JOINT_EMP',
        'Attendance.JointEmp' => 'JOINT_EMP',
        'jointEmp' => 'JOINT_EMP',
        'attendance.jointEmp' => 'JOINT_EMP',
        'AttendanceTableMap::COL_JOINT_EMP' => 'JOINT_EMP',
        'COL_JOINT_EMP' => 'JOINT_EMP',
        'joint_emp' => 'JOINT_EMP',
        'attendance.joint_emp' => 'JOINT_EMP',
        'Remark' => 'REMARK',
        'Attendance.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'attendance.remark' => 'REMARK',
        'AttendanceTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'Status' => 'STATUS',
        'Attendance.Status' => 'STATUS',
        'status' => 'STATUS',
        'attendance.status' => 'STATUS',
        'AttendanceTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'OutletCount' => 'OUTLET_COUNT',
        'Attendance.OutletCount' => 'OUTLET_COUNT',
        'outletCount' => 'OUTLET_COUNT',
        'attendance.outletCount' => 'OUTLET_COUNT',
        'AttendanceTableMap::COL_OUTLET_COUNT' => 'OUTLET_COUNT',
        'COL_OUTLET_COUNT' => 'OUTLET_COUNT',
        'outlet_count' => 'OUTLET_COUNT',
        'attendance.outlet_count' => 'OUTLET_COUNT',
        'CreatedAt' => 'CREATED_AT',
        'Attendance.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'attendance.createdAt' => 'CREATED_AT',
        'AttendanceTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'attendance.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Attendance.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'attendance.updatedAt' => 'UPDATED_AT',
        'AttendanceTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'attendance.updated_at' => 'UPDATED_AT',
        'StartItownid' => 'START_ITOWNID',
        'Attendance.StartItownid' => 'START_ITOWNID',
        'startItownid' => 'START_ITOWNID',
        'attendance.startItownid' => 'START_ITOWNID',
        'AttendanceTableMap::COL_START_ITOWNID' => 'START_ITOWNID',
        'COL_START_ITOWNID' => 'START_ITOWNID',
        'start_itownid' => 'START_ITOWNID',
        'attendance.start_itownid' => 'START_ITOWNID',
        'EndItownid' => 'END_ITOWNID',
        'Attendance.EndItownid' => 'END_ITOWNID',
        'endItownid' => 'END_ITOWNID',
        'attendance.endItownid' => 'END_ITOWNID',
        'AttendanceTableMap::COL_END_ITOWNID' => 'END_ITOWNID',
        'COL_END_ITOWNID' => 'END_ITOWNID',
        'end_itownid' => 'END_ITOWNID',
        'attendance.end_itownid' => 'END_ITOWNID',
        'VisitedItownid' => 'VISITED_ITOWNID',
        'Attendance.VisitedItownid' => 'VISITED_ITOWNID',
        'visitedItownid' => 'VISITED_ITOWNID',
        'attendance.visitedItownid' => 'VISITED_ITOWNID',
        'AttendanceTableMap::COL_VISITED_ITOWNID' => 'VISITED_ITOWNID',
        'COL_VISITED_ITOWNID' => 'VISITED_ITOWNID',
        'visited_itownid' => 'VISITED_ITOWNID',
        'attendance.visited_itownid' => 'VISITED_ITOWNID',
        'ExpenseId' => 'EXPENSE_ID',
        'Attendance.ExpenseId' => 'EXPENSE_ID',
        'expenseId' => 'EXPENSE_ID',
        'attendance.expenseId' => 'EXPENSE_ID',
        'AttendanceTableMap::COL_EXPENSE_ID' => 'EXPENSE_ID',
        'COL_EXPENSE_ID' => 'EXPENSE_ID',
        'expense_id' => 'EXPENSE_ID',
        'attendance.expense_id' => 'EXPENSE_ID',
        'IsUpdated' => 'IS_UPDATED',
        'Attendance.IsUpdated' => 'IS_UPDATED',
        'isUpdated' => 'IS_UPDATED',
        'attendance.isUpdated' => 'IS_UPDATED',
        'AttendanceTableMap::COL_IS_UPDATED' => 'IS_UPDATED',
        'COL_IS_UPDATED' => 'IS_UPDATED',
        'is_updated' => 'IS_UPDATED',
        'attendance.is_updated' => 'IS_UPDATED',
        'ExpenseGenerated' => 'EXPENSE_GENERATED',
        'Attendance.ExpenseGenerated' => 'EXPENSE_GENERATED',
        'expenseGenerated' => 'EXPENSE_GENERATED',
        'attendance.expenseGenerated' => 'EXPENSE_GENERATED',
        'AttendanceTableMap::COL_EXPENSE_GENERATED' => 'EXPENSE_GENERATED',
        'COL_EXPENSE_GENERATED' => 'EXPENSE_GENERATED',
        'expense_generated' => 'EXPENSE_GENERATED',
        'attendance.expense_generated' => 'EXPENSE_GENERATED',
        'ExpenseRemark' => 'EXPENSE_REMARK',
        'Attendance.ExpenseRemark' => 'EXPENSE_REMARK',
        'expenseRemark' => 'EXPENSE_REMARK',
        'attendance.expenseRemark' => 'EXPENSE_REMARK',
        'AttendanceTableMap::COL_EXPENSE_REMARK' => 'EXPENSE_REMARK',
        'COL_EXPENSE_REMARK' => 'EXPENSE_REMARK',
        'expense_remark' => 'EXPENSE_REMARK',
        'attendance.expense_remark' => 'EXPENSE_REMARK',
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
        $this->setName('attendance');
        $this->setPhpName('Attendance');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Attendance');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('attendance_attendance_id_seq');
        // columns
        $this->addPrimaryKey('attendance_id', 'AttendanceId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('attendance_date', 'AttendanceDate', 'DATE', true, null, null);
        $this->addColumn('start_time', 'StartTime', 'TIME', false, null, null);
        $this->addColumn('end_time', 'EndTime', 'TIME', false, null, null);
        $this->addColumn('start_latlng', 'StartLatlng', 'VARCHAR', false, 100, null);
        $this->addColumn('start_address', 'StartAddress', 'VARCHAR', false, 255, null);
        $this->addColumn('end_latlng', 'EndLatlng', 'VARCHAR', false, 100, null);
        $this->addColumn('end_address', 'EndAddress', 'VARCHAR', false, 255, null);
        $this->addColumn('shift_mins', 'ShiftMins', 'DECIMAL', false, 20, 0.000000);
        $this->addColumn('joint_emp', 'JointEmp', 'INTEGER', false, null, null);
        $this->addColumn('remark', 'Remark', 'VARCHAR', false, 50, null);
        $this->addColumn('status', 'Status', 'SMALLINT', true, null, 0);
        $this->addColumn('outlet_count', 'OutletCount', 'INTEGER', true, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('start_itownid', 'StartItownid', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
        $this->addForeignKey('end_itownid', 'EndItownid', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
        $this->addColumn('visited_itownid', 'VisitedItownid', 'VARCHAR', false, null, null);
        $this->addForeignKey('expense_id', 'ExpenseId', 'INTEGER', 'expenses', 'exp_id', false, null, null);
        $this->addColumn('is_updated', 'IsUpdated', 'BOOLEAN', false, 1, false);
        $this->addColumn('expense_generated', 'ExpenseGenerated', 'BOOLEAN', true, 1, false);
        $this->addColumn('expense_remark', 'ExpenseRemark', 'LONGVARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GeoTownsRelatedByEndItownid', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':end_itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':expense_id',
    1 => ':exp_id',
  ),
), null, null, null, false);
        $this->addRelation('GeoTownsRelatedByStartItownid', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':start_itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AttendanceId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AttendanceId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AttendanceId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AttendanceId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AttendanceId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AttendanceId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('AttendanceId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? AttendanceTableMap::CLASS_DEFAULT : AttendanceTableMap::OM_CLASS;
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
     * @return array (Attendance object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AttendanceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AttendanceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AttendanceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AttendanceTableMap::OM_CLASS;
            /** @var Attendance $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AttendanceTableMap::addInstanceToPool($obj, $key);
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
            $key = AttendanceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AttendanceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Attendance $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AttendanceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AttendanceTableMap::COL_ATTENDANCE_ID);
            $criteria->addSelectColumn(AttendanceTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(AttendanceTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(AttendanceTableMap::COL_ATTENDANCE_DATE);
            $criteria->addSelectColumn(AttendanceTableMap::COL_START_TIME);
            $criteria->addSelectColumn(AttendanceTableMap::COL_END_TIME);
            $criteria->addSelectColumn(AttendanceTableMap::COL_START_LATLNG);
            $criteria->addSelectColumn(AttendanceTableMap::COL_START_ADDRESS);
            $criteria->addSelectColumn(AttendanceTableMap::COL_END_LATLNG);
            $criteria->addSelectColumn(AttendanceTableMap::COL_END_ADDRESS);
            $criteria->addSelectColumn(AttendanceTableMap::COL_SHIFT_MINS);
            $criteria->addSelectColumn(AttendanceTableMap::COL_JOINT_EMP);
            $criteria->addSelectColumn(AttendanceTableMap::COL_REMARK);
            $criteria->addSelectColumn(AttendanceTableMap::COL_STATUS);
            $criteria->addSelectColumn(AttendanceTableMap::COL_OUTLET_COUNT);
            $criteria->addSelectColumn(AttendanceTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AttendanceTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(AttendanceTableMap::COL_START_ITOWNID);
            $criteria->addSelectColumn(AttendanceTableMap::COL_END_ITOWNID);
            $criteria->addSelectColumn(AttendanceTableMap::COL_VISITED_ITOWNID);
            $criteria->addSelectColumn(AttendanceTableMap::COL_EXPENSE_ID);
            $criteria->addSelectColumn(AttendanceTableMap::COL_IS_UPDATED);
            $criteria->addSelectColumn(AttendanceTableMap::COL_EXPENSE_GENERATED);
            $criteria->addSelectColumn(AttendanceTableMap::COL_EXPENSE_REMARK);
        } else {
            $criteria->addSelectColumn($alias . '.attendance_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.attendance_date');
            $criteria->addSelectColumn($alias . '.start_time');
            $criteria->addSelectColumn($alias . '.end_time');
            $criteria->addSelectColumn($alias . '.start_latlng');
            $criteria->addSelectColumn($alias . '.start_address');
            $criteria->addSelectColumn($alias . '.end_latlng');
            $criteria->addSelectColumn($alias . '.end_address');
            $criteria->addSelectColumn($alias . '.shift_mins');
            $criteria->addSelectColumn($alias . '.joint_emp');
            $criteria->addSelectColumn($alias . '.remark');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.outlet_count');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.start_itownid');
            $criteria->addSelectColumn($alias . '.end_itownid');
            $criteria->addSelectColumn($alias . '.visited_itownid');
            $criteria->addSelectColumn($alias . '.expense_id');
            $criteria->addSelectColumn($alias . '.is_updated');
            $criteria->addSelectColumn($alias . '.expense_generated');
            $criteria->addSelectColumn($alias . '.expense_remark');
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
            $criteria->removeSelectColumn(AttendanceTableMap::COL_ATTENDANCE_ID);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_ATTENDANCE_DATE);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_START_TIME);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_END_TIME);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_START_LATLNG);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_START_ADDRESS);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_END_LATLNG);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_END_ADDRESS);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_SHIFT_MINS);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_JOINT_EMP);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_REMARK);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_STATUS);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_OUTLET_COUNT);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_START_ITOWNID);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_END_ITOWNID);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_VISITED_ITOWNID);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_EXPENSE_ID);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_IS_UPDATED);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_EXPENSE_GENERATED);
            $criteria->removeSelectColumn(AttendanceTableMap::COL_EXPENSE_REMARK);
        } else {
            $criteria->removeSelectColumn($alias . '.attendance_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.attendance_date');
            $criteria->removeSelectColumn($alias . '.start_time');
            $criteria->removeSelectColumn($alias . '.end_time');
            $criteria->removeSelectColumn($alias . '.start_latlng');
            $criteria->removeSelectColumn($alias . '.start_address');
            $criteria->removeSelectColumn($alias . '.end_latlng');
            $criteria->removeSelectColumn($alias . '.end_address');
            $criteria->removeSelectColumn($alias . '.shift_mins');
            $criteria->removeSelectColumn($alias . '.joint_emp');
            $criteria->removeSelectColumn($alias . '.remark');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.outlet_count');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.start_itownid');
            $criteria->removeSelectColumn($alias . '.end_itownid');
            $criteria->removeSelectColumn($alias . '.visited_itownid');
            $criteria->removeSelectColumn($alias . '.expense_id');
            $criteria->removeSelectColumn($alias . '.is_updated');
            $criteria->removeSelectColumn($alias . '.expense_generated');
            $criteria->removeSelectColumn($alias . '.expense_remark');
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
        return Propel::getServiceContainer()->getDatabaseMap(AttendanceTableMap::DATABASE_NAME)->getTable(AttendanceTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Attendance or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Attendance object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Attendance) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AttendanceTableMap::DATABASE_NAME);
            $criteria->add(AttendanceTableMap::COL_ATTENDANCE_ID, (array) $values, Criteria::IN);
        }

        $query = AttendanceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AttendanceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AttendanceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the attendance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AttendanceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Attendance or Criteria object.
     *
     * @param mixed $criteria Criteria or Attendance object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Attendance object
        }

        if ($criteria->containsKey(AttendanceTableMap::COL_ATTENDANCE_ID) && $criteria->keyContainsValue(AttendanceTableMap::COL_ATTENDANCE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AttendanceTableMap::COL_ATTENDANCE_ID.')');
        }


        // Set the correct dbName
        $query = AttendanceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
