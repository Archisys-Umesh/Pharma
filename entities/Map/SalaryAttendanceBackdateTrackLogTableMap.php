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
use entities\SalaryAttendanceBackdateTrackLog;
use entities\SalaryAttendanceBackdateTrackLogQuery;


/**
 * This class defines the structure of the 'salary_attendance_backdate_track_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SalaryAttendanceBackdateTrackLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SalaryAttendanceBackdateTrackLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'salary_attendance_backdate_track_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SalaryAttendanceBackdateTrackLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SalaryAttendanceBackdateTrackLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SalaryAttendanceBackdateTrackLog';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'salary_attendance_backdate_track_log.id';

    /**
     * the column name for the previous_from_date field
     */
    public const COL_PREVIOUS_FROM_DATE = 'salary_attendance_backdate_track_log.previous_from_date';

    /**
     * the column name for the previous_to_date field
     */
    public const COL_PREVIOUS_TO_DATE = 'salary_attendance_backdate_track_log.previous_to_date';

    /**
     * the column name for the previous_to_previous_from_date field
     */
    public const COL_PREVIOUS_TO_PREVIOUS_FROM_DATE = 'salary_attendance_backdate_track_log.previous_to_previous_from_date';

    /**
     * the column name for the previous_to_previous_to_date field
     */
    public const COL_PREVIOUS_TO_PREVIOUS_TO_DATE = 'salary_attendance_backdate_track_log.previous_to_previous_to_date';

    /**
     * the column name for the backdate_previous_deduction_day field
     */
    public const COL_BACKDATE_PREVIOUS_DEDUCTION_DAY = 'salary_attendance_backdate_track_log.backdate_previous_deduction_day';

    /**
     * the column name for the backdate_previous_deduction_date field
     */
    public const COL_BACKDATE_PREVIOUS_DEDUCTION_DATE = 'salary_attendance_backdate_track_log.backdate_previous_deduction_date';

    /**
     * the column name for the backdate_previous_to_previous_day field
     */
    public const COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY = 'salary_attendance_backdate_track_log.backdate_previous_to_previous_day';

    /**
     * the column name for the backdate_previous_to_previous_date field
     */
    public const COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DATE = 'salary_attendance_backdate_track_log.backdate_previous_to_previous_date';

    /**
     * the column name for the paid_amount field
     */
    public const COL_PAID_AMOUNT = 'salary_attendance_backdate_track_log.paid_amount';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'salary_attendance_backdate_track_log.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'salary_attendance_backdate_track_log.updated_at';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'salary_attendance_backdate_track_log.employee_id';

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
        self::TYPE_PHPNAME       => ['Id', 'PreviousFromDate', 'PreviousToDate', 'PreviousToPreviousFromDate', 'PreviousToPreviousToDate', 'BackdatePreviousDeductionDay', 'BackdatePreviousDeductionDate', 'BackdatePreviousToPreviousDay', 'BackdatePreviousToPreviousDate', 'PaidAmount', 'CreatedAt', 'UpdatedAt', 'EmployeeId', ],
        self::TYPE_CAMELNAME     => ['id', 'previousFromDate', 'previousToDate', 'previousToPreviousFromDate', 'previousToPreviousToDate', 'backdatePreviousDeductionDay', 'backdatePreviousDeductionDate', 'backdatePreviousToPreviousDay', 'backdatePreviousToPreviousDate', 'paidAmount', 'createdAt', 'updatedAt', 'employeeId', ],
        self::TYPE_COLNAME       => [SalaryAttendanceBackdateTrackLogTableMap::COL_ID, SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_FROM_DATE, SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_DATE, SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_FROM_DATE, SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_TO_DATE, SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DAY, SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DATE, SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY, SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DATE, SalaryAttendanceBackdateTrackLogTableMap::COL_PAID_AMOUNT, SalaryAttendanceBackdateTrackLogTableMap::COL_CREATED_AT, SalaryAttendanceBackdateTrackLogTableMap::COL_UPDATED_AT, SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'previous_from_date', 'previous_to_date', 'previous_to_previous_from_date', 'previous_to_previous_to_date', 'backdate_previous_deduction_day', 'backdate_previous_deduction_date', 'backdate_previous_to_previous_day', 'backdate_previous_to_previous_date', 'paid_amount', 'created_at', 'updated_at', 'employee_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'PreviousFromDate' => 1, 'PreviousToDate' => 2, 'PreviousToPreviousFromDate' => 3, 'PreviousToPreviousToDate' => 4, 'BackdatePreviousDeductionDay' => 5, 'BackdatePreviousDeductionDate' => 6, 'BackdatePreviousToPreviousDay' => 7, 'BackdatePreviousToPreviousDate' => 8, 'PaidAmount' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'EmployeeId' => 12, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'previousFromDate' => 1, 'previousToDate' => 2, 'previousToPreviousFromDate' => 3, 'previousToPreviousToDate' => 4, 'backdatePreviousDeductionDay' => 5, 'backdatePreviousDeductionDate' => 6, 'backdatePreviousToPreviousDay' => 7, 'backdatePreviousToPreviousDate' => 8, 'paidAmount' => 9, 'createdAt' => 10, 'updatedAt' => 11, 'employeeId' => 12, ],
        self::TYPE_COLNAME       => [SalaryAttendanceBackdateTrackLogTableMap::COL_ID => 0, SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_FROM_DATE => 1, SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_DATE => 2, SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_FROM_DATE => 3, SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_TO_DATE => 4, SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DAY => 5, SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DATE => 6, SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY => 7, SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DATE => 8, SalaryAttendanceBackdateTrackLogTableMap::COL_PAID_AMOUNT => 9, SalaryAttendanceBackdateTrackLogTableMap::COL_CREATED_AT => 10, SalaryAttendanceBackdateTrackLogTableMap::COL_UPDATED_AT => 11, SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID => 12, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'previous_from_date' => 1, 'previous_to_date' => 2, 'previous_to_previous_from_date' => 3, 'previous_to_previous_to_date' => 4, 'backdate_previous_deduction_day' => 5, 'backdate_previous_deduction_date' => 6, 'backdate_previous_to_previous_day' => 7, 'backdate_previous_to_previous_date' => 8, 'paid_amount' => 9, 'created_at' => 10, 'updated_at' => 11, 'employee_id' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SalaryAttendanceBackdateTrackLog.Id' => 'ID',
        'id' => 'ID',
        'salaryAttendanceBackdateTrackLog.id' => 'ID',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'salary_attendance_backdate_track_log.id' => 'ID',
        'PreviousFromDate' => 'PREVIOUS_FROM_DATE',
        'SalaryAttendanceBackdateTrackLog.PreviousFromDate' => 'PREVIOUS_FROM_DATE',
        'previousFromDate' => 'PREVIOUS_FROM_DATE',
        'salaryAttendanceBackdateTrackLog.previousFromDate' => 'PREVIOUS_FROM_DATE',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_FROM_DATE' => 'PREVIOUS_FROM_DATE',
        'COL_PREVIOUS_FROM_DATE' => 'PREVIOUS_FROM_DATE',
        'previous_from_date' => 'PREVIOUS_FROM_DATE',
        'salary_attendance_backdate_track_log.previous_from_date' => 'PREVIOUS_FROM_DATE',
        'PreviousToDate' => 'PREVIOUS_TO_DATE',
        'SalaryAttendanceBackdateTrackLog.PreviousToDate' => 'PREVIOUS_TO_DATE',
        'previousToDate' => 'PREVIOUS_TO_DATE',
        'salaryAttendanceBackdateTrackLog.previousToDate' => 'PREVIOUS_TO_DATE',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_DATE' => 'PREVIOUS_TO_DATE',
        'COL_PREVIOUS_TO_DATE' => 'PREVIOUS_TO_DATE',
        'previous_to_date' => 'PREVIOUS_TO_DATE',
        'salary_attendance_backdate_track_log.previous_to_date' => 'PREVIOUS_TO_DATE',
        'PreviousToPreviousFromDate' => 'PREVIOUS_TO_PREVIOUS_FROM_DATE',
        'SalaryAttendanceBackdateTrackLog.PreviousToPreviousFromDate' => 'PREVIOUS_TO_PREVIOUS_FROM_DATE',
        'previousToPreviousFromDate' => 'PREVIOUS_TO_PREVIOUS_FROM_DATE',
        'salaryAttendanceBackdateTrackLog.previousToPreviousFromDate' => 'PREVIOUS_TO_PREVIOUS_FROM_DATE',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_FROM_DATE' => 'PREVIOUS_TO_PREVIOUS_FROM_DATE',
        'COL_PREVIOUS_TO_PREVIOUS_FROM_DATE' => 'PREVIOUS_TO_PREVIOUS_FROM_DATE',
        'previous_to_previous_from_date' => 'PREVIOUS_TO_PREVIOUS_FROM_DATE',
        'salary_attendance_backdate_track_log.previous_to_previous_from_date' => 'PREVIOUS_TO_PREVIOUS_FROM_DATE',
        'PreviousToPreviousToDate' => 'PREVIOUS_TO_PREVIOUS_TO_DATE',
        'SalaryAttendanceBackdateTrackLog.PreviousToPreviousToDate' => 'PREVIOUS_TO_PREVIOUS_TO_DATE',
        'previousToPreviousToDate' => 'PREVIOUS_TO_PREVIOUS_TO_DATE',
        'salaryAttendanceBackdateTrackLog.previousToPreviousToDate' => 'PREVIOUS_TO_PREVIOUS_TO_DATE',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_TO_DATE' => 'PREVIOUS_TO_PREVIOUS_TO_DATE',
        'COL_PREVIOUS_TO_PREVIOUS_TO_DATE' => 'PREVIOUS_TO_PREVIOUS_TO_DATE',
        'previous_to_previous_to_date' => 'PREVIOUS_TO_PREVIOUS_TO_DATE',
        'salary_attendance_backdate_track_log.previous_to_previous_to_date' => 'PREVIOUS_TO_PREVIOUS_TO_DATE',
        'BackdatePreviousDeductionDay' => 'BACKDATE_PREVIOUS_DEDUCTION_DAY',
        'SalaryAttendanceBackdateTrackLog.BackdatePreviousDeductionDay' => 'BACKDATE_PREVIOUS_DEDUCTION_DAY',
        'backdatePreviousDeductionDay' => 'BACKDATE_PREVIOUS_DEDUCTION_DAY',
        'salaryAttendanceBackdateTrackLog.backdatePreviousDeductionDay' => 'BACKDATE_PREVIOUS_DEDUCTION_DAY',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DAY' => 'BACKDATE_PREVIOUS_DEDUCTION_DAY',
        'COL_BACKDATE_PREVIOUS_DEDUCTION_DAY' => 'BACKDATE_PREVIOUS_DEDUCTION_DAY',
        'backdate_previous_deduction_day' => 'BACKDATE_PREVIOUS_DEDUCTION_DAY',
        'salary_attendance_backdate_track_log.backdate_previous_deduction_day' => 'BACKDATE_PREVIOUS_DEDUCTION_DAY',
        'BackdatePreviousDeductionDate' => 'BACKDATE_PREVIOUS_DEDUCTION_DATE',
        'SalaryAttendanceBackdateTrackLog.BackdatePreviousDeductionDate' => 'BACKDATE_PREVIOUS_DEDUCTION_DATE',
        'backdatePreviousDeductionDate' => 'BACKDATE_PREVIOUS_DEDUCTION_DATE',
        'salaryAttendanceBackdateTrackLog.backdatePreviousDeductionDate' => 'BACKDATE_PREVIOUS_DEDUCTION_DATE',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DATE' => 'BACKDATE_PREVIOUS_DEDUCTION_DATE',
        'COL_BACKDATE_PREVIOUS_DEDUCTION_DATE' => 'BACKDATE_PREVIOUS_DEDUCTION_DATE',
        'backdate_previous_deduction_date' => 'BACKDATE_PREVIOUS_DEDUCTION_DATE',
        'salary_attendance_backdate_track_log.backdate_previous_deduction_date' => 'BACKDATE_PREVIOUS_DEDUCTION_DATE',
        'BackdatePreviousToPreviousDay' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DAY',
        'SalaryAttendanceBackdateTrackLog.BackdatePreviousToPreviousDay' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DAY',
        'backdatePreviousToPreviousDay' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DAY',
        'salaryAttendanceBackdateTrackLog.backdatePreviousToPreviousDay' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DAY',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DAY',
        'COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DAY',
        'backdate_previous_to_previous_day' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DAY',
        'salary_attendance_backdate_track_log.backdate_previous_to_previous_day' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DAY',
        'BackdatePreviousToPreviousDate' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DATE',
        'SalaryAttendanceBackdateTrackLog.BackdatePreviousToPreviousDate' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DATE',
        'backdatePreviousToPreviousDate' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DATE',
        'salaryAttendanceBackdateTrackLog.backdatePreviousToPreviousDate' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DATE',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DATE' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DATE',
        'COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DATE' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DATE',
        'backdate_previous_to_previous_date' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DATE',
        'salary_attendance_backdate_track_log.backdate_previous_to_previous_date' => 'BACKDATE_PREVIOUS_TO_PREVIOUS_DATE',
        'PaidAmount' => 'PAID_AMOUNT',
        'SalaryAttendanceBackdateTrackLog.PaidAmount' => 'PAID_AMOUNT',
        'paidAmount' => 'PAID_AMOUNT',
        'salaryAttendanceBackdateTrackLog.paidAmount' => 'PAID_AMOUNT',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_PAID_AMOUNT' => 'PAID_AMOUNT',
        'COL_PAID_AMOUNT' => 'PAID_AMOUNT',
        'paid_amount' => 'PAID_AMOUNT',
        'salary_attendance_backdate_track_log.paid_amount' => 'PAID_AMOUNT',
        'CreatedAt' => 'CREATED_AT',
        'SalaryAttendanceBackdateTrackLog.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'salaryAttendanceBackdateTrackLog.createdAt' => 'CREATED_AT',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'salary_attendance_backdate_track_log.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SalaryAttendanceBackdateTrackLog.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'salaryAttendanceBackdateTrackLog.updatedAt' => 'UPDATED_AT',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'salary_attendance_backdate_track_log.updated_at' => 'UPDATED_AT',
        'EmployeeId' => 'EMPLOYEE_ID',
        'SalaryAttendanceBackdateTrackLog.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'salaryAttendanceBackdateTrackLog.employeeId' => 'EMPLOYEE_ID',
        'SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'salary_attendance_backdate_track_log.employee_id' => 'EMPLOYEE_ID',
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
        $this->setName('salary_attendance_backdate_track_log');
        $this->setPhpName('SalaryAttendanceBackdateTrackLog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SalaryAttendanceBackdateTrackLog');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('salary_attendance_backdate_track_log_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('previous_from_date', 'PreviousFromDate', 'DATE', false, null, null);
        $this->addColumn('previous_to_date', 'PreviousToDate', 'DATE', false, null, null);
        $this->addColumn('previous_to_previous_from_date', 'PreviousToPreviousFromDate', 'DATE', false, null, null);
        $this->addColumn('previous_to_previous_to_date', 'PreviousToPreviousToDate', 'DATE', false, null, null);
        $this->addColumn('backdate_previous_deduction_day', 'BackdatePreviousDeductionDay', 'INTEGER', false, null, null);
        $this->addColumn('backdate_previous_deduction_date', 'BackdatePreviousDeductionDate', 'LONGVARCHAR', false, null, null);
        $this->addColumn('backdate_previous_to_previous_day', 'BackdatePreviousToPreviousDay', 'INTEGER', false, null, null);
        $this->addColumn('backdate_previous_to_previous_date', 'BackdatePreviousToPreviousDate', 'LONGVARCHAR', false, null, null);
        $this->addColumn('paid_amount', 'PaidAmount', 'DECIMAL', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
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
        return $withPrefix ? SalaryAttendanceBackdateTrackLogTableMap::CLASS_DEFAULT : SalaryAttendanceBackdateTrackLogTableMap::OM_CLASS;
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
     * @return array (SalaryAttendanceBackdateTrackLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SalaryAttendanceBackdateTrackLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SalaryAttendanceBackdateTrackLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SalaryAttendanceBackdateTrackLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SalaryAttendanceBackdateTrackLogTableMap::OM_CLASS;
            /** @var SalaryAttendanceBackdateTrackLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SalaryAttendanceBackdateTrackLogTableMap::addInstanceToPool($obj, $key);
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
            $key = SalaryAttendanceBackdateTrackLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SalaryAttendanceBackdateTrackLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SalaryAttendanceBackdateTrackLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SalaryAttendanceBackdateTrackLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_ID);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_FROM_DATE);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_DATE);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_FROM_DATE);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_TO_DATE);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DAY);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DATE);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DATE);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PAID_AMOUNT);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.previous_from_date');
            $criteria->addSelectColumn($alias . '.previous_to_date');
            $criteria->addSelectColumn($alias . '.previous_to_previous_from_date');
            $criteria->addSelectColumn($alias . '.previous_to_previous_to_date');
            $criteria->addSelectColumn($alias . '.backdate_previous_deduction_day');
            $criteria->addSelectColumn($alias . '.backdate_previous_deduction_date');
            $criteria->addSelectColumn($alias . '.backdate_previous_to_previous_day');
            $criteria->addSelectColumn($alias . '.backdate_previous_to_previous_date');
            $criteria->addSelectColumn($alias . '.paid_amount');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_ID);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_FROM_DATE);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_DATE);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_FROM_DATE);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_TO_DATE);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DAY);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DATE);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DATE);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_PAID_AMOUNT);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.previous_from_date');
            $criteria->removeSelectColumn($alias . '.previous_to_date');
            $criteria->removeSelectColumn($alias . '.previous_to_previous_from_date');
            $criteria->removeSelectColumn($alias . '.previous_to_previous_to_date');
            $criteria->removeSelectColumn($alias . '.backdate_previous_deduction_day');
            $criteria->removeSelectColumn($alias . '.backdate_previous_deduction_date');
            $criteria->removeSelectColumn($alias . '.backdate_previous_to_previous_day');
            $criteria->removeSelectColumn($alias . '.backdate_previous_to_previous_date');
            $criteria->removeSelectColumn($alias . '.paid_amount');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SalaryAttendanceBackdateTrackLogTableMap::DATABASE_NAME)->getTable(SalaryAttendanceBackdateTrackLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SalaryAttendanceBackdateTrackLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SalaryAttendanceBackdateTrackLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SalaryAttendanceBackdateTrackLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SalaryAttendanceBackdateTrackLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SalaryAttendanceBackdateTrackLogTableMap::DATABASE_NAME);
            $criteria->add(SalaryAttendanceBackdateTrackLogTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SalaryAttendanceBackdateTrackLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SalaryAttendanceBackdateTrackLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SalaryAttendanceBackdateTrackLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the salary_attendance_backdate_track_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SalaryAttendanceBackdateTrackLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SalaryAttendanceBackdateTrackLog or Criteria object.
     *
     * @param mixed $criteria Criteria or SalaryAttendanceBackdateTrackLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SalaryAttendanceBackdateTrackLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SalaryAttendanceBackdateTrackLog object
        }

        if ($criteria->containsKey(SalaryAttendanceBackdateTrackLogTableMap::COL_ID) && $criteria->keyContainsValue(SalaryAttendanceBackdateTrackLogTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SalaryAttendanceBackdateTrackLogTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SalaryAttendanceBackdateTrackLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
