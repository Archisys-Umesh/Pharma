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
use entities\HrUserDates;
use entities\HrUserDatesQuery;


/**
 * This class defines the structure of the 'hr_user_dates' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class HrUserDatesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.HrUserDatesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'hr_user_dates';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'HrUserDates';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\HrUserDates';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.HrUserDates';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the hrdt_id field
     */
    public const COL_HRDT_ID = 'hr_user_dates.hrdt_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'hr_user_dates.employee_id';

    /**
     * the column name for the birth_date field
     */
    public const COL_BIRTH_DATE = 'hr_user_dates.birth_date';

    /**
     * the column name for the join_date field
     */
    public const COL_JOIN_DATE = 'hr_user_dates.join_date';

    /**
     * the column name for the probation_date field
     */
    public const COL_PROBATION_DATE = 'hr_user_dates.probation_date';

    /**
     * the column name for the confirmation_date field
     */
    public const COL_CONFIRMATION_DATE = 'hr_user_dates.confirmation_date';

    /**
     * the column name for the training_start_date field
     */
    public const COL_TRAINING_START_DATE = 'hr_user_dates.training_start_date';

    /**
     * the column name for the training_end_date field
     */
    public const COL_TRAINING_END_DATE = 'hr_user_dates.training_end_date';

    /**
     * the column name for the resign_date field
     */
    public const COL_RESIGN_DATE = 'hr_user_dates.resign_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'hr_user_dates.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'hr_user_dates.updated_at';

    /**
     * the column name for the transfer_date field
     */
    public const COL_TRANSFER_DATE = 'hr_user_dates.transfer_date';

    /**
     * the column name for the reliving_date field
     */
    public const COL_RELIVING_DATE = 'hr_user_dates.reliving_date';

    /**
     * the column name for the nsm_approve_date field
     */
    public const COL_NSM_APPROVE_DATE = 'hr_user_dates.nsm_approve_date';

    /**
     * the column name for the resignation_rejected_date field
     */
    public const COL_RESIGNATION_REJECTED_DATE = 'hr_user_dates.resignation_rejected_date';

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
        self::TYPE_PHPNAME       => ['HrdtId', 'EmployeeId', 'BirthDate', 'JoinDate', 'ProbationDate', 'ConfirmationDate', 'TrainingStartDate', 'TrainingEndDate', 'ResignDate', 'CreatedAt', 'UpdatedAt', 'TransferDate', 'RelivingDate', 'NsmApproveDate', 'ResignationRejectedDate', ],
        self::TYPE_CAMELNAME     => ['hrdtId', 'employeeId', 'birthDate', 'joinDate', 'probationDate', 'confirmationDate', 'trainingStartDate', 'trainingEndDate', 'resignDate', 'createdAt', 'updatedAt', 'transferDate', 'relivingDate', 'nsmApproveDate', 'resignationRejectedDate', ],
        self::TYPE_COLNAME       => [HrUserDatesTableMap::COL_HRDT_ID, HrUserDatesTableMap::COL_EMPLOYEE_ID, HrUserDatesTableMap::COL_BIRTH_DATE, HrUserDatesTableMap::COL_JOIN_DATE, HrUserDatesTableMap::COL_PROBATION_DATE, HrUserDatesTableMap::COL_CONFIRMATION_DATE, HrUserDatesTableMap::COL_TRAINING_START_DATE, HrUserDatesTableMap::COL_TRAINING_END_DATE, HrUserDatesTableMap::COL_RESIGN_DATE, HrUserDatesTableMap::COL_CREATED_AT, HrUserDatesTableMap::COL_UPDATED_AT, HrUserDatesTableMap::COL_TRANSFER_DATE, HrUserDatesTableMap::COL_RELIVING_DATE, HrUserDatesTableMap::COL_NSM_APPROVE_DATE, HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE, ],
        self::TYPE_FIELDNAME     => ['hrdt_id', 'employee_id', 'birth_date', 'join_date', 'probation_date', 'confirmation_date', 'training_start_date', 'training_end_date', 'resign_date', 'created_at', 'updated_at', 'transfer_date', 'reliving_date', 'nsm_approve_date', 'resignation_rejected_date', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
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
        self::TYPE_PHPNAME       => ['HrdtId' => 0, 'EmployeeId' => 1, 'BirthDate' => 2, 'JoinDate' => 3, 'ProbationDate' => 4, 'ConfirmationDate' => 5, 'TrainingStartDate' => 6, 'TrainingEndDate' => 7, 'ResignDate' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, 'TransferDate' => 11, 'RelivingDate' => 12, 'NsmApproveDate' => 13, 'ResignationRejectedDate' => 14, ],
        self::TYPE_CAMELNAME     => ['hrdtId' => 0, 'employeeId' => 1, 'birthDate' => 2, 'joinDate' => 3, 'probationDate' => 4, 'confirmationDate' => 5, 'trainingStartDate' => 6, 'trainingEndDate' => 7, 'resignDate' => 8, 'createdAt' => 9, 'updatedAt' => 10, 'transferDate' => 11, 'relivingDate' => 12, 'nsmApproveDate' => 13, 'resignationRejectedDate' => 14, ],
        self::TYPE_COLNAME       => [HrUserDatesTableMap::COL_HRDT_ID => 0, HrUserDatesTableMap::COL_EMPLOYEE_ID => 1, HrUserDatesTableMap::COL_BIRTH_DATE => 2, HrUserDatesTableMap::COL_JOIN_DATE => 3, HrUserDatesTableMap::COL_PROBATION_DATE => 4, HrUserDatesTableMap::COL_CONFIRMATION_DATE => 5, HrUserDatesTableMap::COL_TRAINING_START_DATE => 6, HrUserDatesTableMap::COL_TRAINING_END_DATE => 7, HrUserDatesTableMap::COL_RESIGN_DATE => 8, HrUserDatesTableMap::COL_CREATED_AT => 9, HrUserDatesTableMap::COL_UPDATED_AT => 10, HrUserDatesTableMap::COL_TRANSFER_DATE => 11, HrUserDatesTableMap::COL_RELIVING_DATE => 12, HrUserDatesTableMap::COL_NSM_APPROVE_DATE => 13, HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE => 14, ],
        self::TYPE_FIELDNAME     => ['hrdt_id' => 0, 'employee_id' => 1, 'birth_date' => 2, 'join_date' => 3, 'probation_date' => 4, 'confirmation_date' => 5, 'training_start_date' => 6, 'training_end_date' => 7, 'resign_date' => 8, 'created_at' => 9, 'updated_at' => 10, 'transfer_date' => 11, 'reliving_date' => 12, 'nsm_approve_date' => 13, 'resignation_rejected_date' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'HrdtId' => 'HRDT_ID',
        'HrUserDates.HrdtId' => 'HRDT_ID',
        'hrdtId' => 'HRDT_ID',
        'hrUserDates.hrdtId' => 'HRDT_ID',
        'HrUserDatesTableMap::COL_HRDT_ID' => 'HRDT_ID',
        'COL_HRDT_ID' => 'HRDT_ID',
        'hrdt_id' => 'HRDT_ID',
        'hr_user_dates.hrdt_id' => 'HRDT_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'HrUserDates.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'hrUserDates.employeeId' => 'EMPLOYEE_ID',
        'HrUserDatesTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'hr_user_dates.employee_id' => 'EMPLOYEE_ID',
        'BirthDate' => 'BIRTH_DATE',
        'HrUserDates.BirthDate' => 'BIRTH_DATE',
        'birthDate' => 'BIRTH_DATE',
        'hrUserDates.birthDate' => 'BIRTH_DATE',
        'HrUserDatesTableMap::COL_BIRTH_DATE' => 'BIRTH_DATE',
        'COL_BIRTH_DATE' => 'BIRTH_DATE',
        'birth_date' => 'BIRTH_DATE',
        'hr_user_dates.birth_date' => 'BIRTH_DATE',
        'JoinDate' => 'JOIN_DATE',
        'HrUserDates.JoinDate' => 'JOIN_DATE',
        'joinDate' => 'JOIN_DATE',
        'hrUserDates.joinDate' => 'JOIN_DATE',
        'HrUserDatesTableMap::COL_JOIN_DATE' => 'JOIN_DATE',
        'COL_JOIN_DATE' => 'JOIN_DATE',
        'join_date' => 'JOIN_DATE',
        'hr_user_dates.join_date' => 'JOIN_DATE',
        'ProbationDate' => 'PROBATION_DATE',
        'HrUserDates.ProbationDate' => 'PROBATION_DATE',
        'probationDate' => 'PROBATION_DATE',
        'hrUserDates.probationDate' => 'PROBATION_DATE',
        'HrUserDatesTableMap::COL_PROBATION_DATE' => 'PROBATION_DATE',
        'COL_PROBATION_DATE' => 'PROBATION_DATE',
        'probation_date' => 'PROBATION_DATE',
        'hr_user_dates.probation_date' => 'PROBATION_DATE',
        'ConfirmationDate' => 'CONFIRMATION_DATE',
        'HrUserDates.ConfirmationDate' => 'CONFIRMATION_DATE',
        'confirmationDate' => 'CONFIRMATION_DATE',
        'hrUserDates.confirmationDate' => 'CONFIRMATION_DATE',
        'HrUserDatesTableMap::COL_CONFIRMATION_DATE' => 'CONFIRMATION_DATE',
        'COL_CONFIRMATION_DATE' => 'CONFIRMATION_DATE',
        'confirmation_date' => 'CONFIRMATION_DATE',
        'hr_user_dates.confirmation_date' => 'CONFIRMATION_DATE',
        'TrainingStartDate' => 'TRAINING_START_DATE',
        'HrUserDates.TrainingStartDate' => 'TRAINING_START_DATE',
        'trainingStartDate' => 'TRAINING_START_DATE',
        'hrUserDates.trainingStartDate' => 'TRAINING_START_DATE',
        'HrUserDatesTableMap::COL_TRAINING_START_DATE' => 'TRAINING_START_DATE',
        'COL_TRAINING_START_DATE' => 'TRAINING_START_DATE',
        'training_start_date' => 'TRAINING_START_DATE',
        'hr_user_dates.training_start_date' => 'TRAINING_START_DATE',
        'TrainingEndDate' => 'TRAINING_END_DATE',
        'HrUserDates.TrainingEndDate' => 'TRAINING_END_DATE',
        'trainingEndDate' => 'TRAINING_END_DATE',
        'hrUserDates.trainingEndDate' => 'TRAINING_END_DATE',
        'HrUserDatesTableMap::COL_TRAINING_END_DATE' => 'TRAINING_END_DATE',
        'COL_TRAINING_END_DATE' => 'TRAINING_END_DATE',
        'training_end_date' => 'TRAINING_END_DATE',
        'hr_user_dates.training_end_date' => 'TRAINING_END_DATE',
        'ResignDate' => 'RESIGN_DATE',
        'HrUserDates.ResignDate' => 'RESIGN_DATE',
        'resignDate' => 'RESIGN_DATE',
        'hrUserDates.resignDate' => 'RESIGN_DATE',
        'HrUserDatesTableMap::COL_RESIGN_DATE' => 'RESIGN_DATE',
        'COL_RESIGN_DATE' => 'RESIGN_DATE',
        'resign_date' => 'RESIGN_DATE',
        'hr_user_dates.resign_date' => 'RESIGN_DATE',
        'CreatedAt' => 'CREATED_AT',
        'HrUserDates.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'hrUserDates.createdAt' => 'CREATED_AT',
        'HrUserDatesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'hr_user_dates.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'HrUserDates.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'hrUserDates.updatedAt' => 'UPDATED_AT',
        'HrUserDatesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'hr_user_dates.updated_at' => 'UPDATED_AT',
        'TransferDate' => 'TRANSFER_DATE',
        'HrUserDates.TransferDate' => 'TRANSFER_DATE',
        'transferDate' => 'TRANSFER_DATE',
        'hrUserDates.transferDate' => 'TRANSFER_DATE',
        'HrUserDatesTableMap::COL_TRANSFER_DATE' => 'TRANSFER_DATE',
        'COL_TRANSFER_DATE' => 'TRANSFER_DATE',
        'transfer_date' => 'TRANSFER_DATE',
        'hr_user_dates.transfer_date' => 'TRANSFER_DATE',
        'RelivingDate' => 'RELIVING_DATE',
        'HrUserDates.RelivingDate' => 'RELIVING_DATE',
        'relivingDate' => 'RELIVING_DATE',
        'hrUserDates.relivingDate' => 'RELIVING_DATE',
        'HrUserDatesTableMap::COL_RELIVING_DATE' => 'RELIVING_DATE',
        'COL_RELIVING_DATE' => 'RELIVING_DATE',
        'reliving_date' => 'RELIVING_DATE',
        'hr_user_dates.reliving_date' => 'RELIVING_DATE',
        'NsmApproveDate' => 'NSM_APPROVE_DATE',
        'HrUserDates.NsmApproveDate' => 'NSM_APPROVE_DATE',
        'nsmApproveDate' => 'NSM_APPROVE_DATE',
        'hrUserDates.nsmApproveDate' => 'NSM_APPROVE_DATE',
        'HrUserDatesTableMap::COL_NSM_APPROVE_DATE' => 'NSM_APPROVE_DATE',
        'COL_NSM_APPROVE_DATE' => 'NSM_APPROVE_DATE',
        'nsm_approve_date' => 'NSM_APPROVE_DATE',
        'hr_user_dates.nsm_approve_date' => 'NSM_APPROVE_DATE',
        'ResignationRejectedDate' => 'RESIGNATION_REJECTED_DATE',
        'HrUserDates.ResignationRejectedDate' => 'RESIGNATION_REJECTED_DATE',
        'resignationRejectedDate' => 'RESIGNATION_REJECTED_DATE',
        'hrUserDates.resignationRejectedDate' => 'RESIGNATION_REJECTED_DATE',
        'HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE' => 'RESIGNATION_REJECTED_DATE',
        'COL_RESIGNATION_REJECTED_DATE' => 'RESIGNATION_REJECTED_DATE',
        'resignation_rejected_date' => 'RESIGNATION_REJECTED_DATE',
        'hr_user_dates.resignation_rejected_date' => 'RESIGNATION_REJECTED_DATE',
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
        $this->setName('hr_user_dates');
        $this->setPhpName('HrUserDates');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\HrUserDates');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('hr_user_dates_hrdt_id_seq');
        // columns
        $this->addPrimaryKey('hrdt_id', 'HrdtId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, 0);
        $this->addColumn('birth_date', 'BirthDate', 'DATE', false, null, null);
        $this->addColumn('join_date', 'JoinDate', 'DATE', false, null, null);
        $this->addColumn('probation_date', 'ProbationDate', 'DATE', false, null, null);
        $this->addColumn('confirmation_date', 'ConfirmationDate', 'DATE', false, null, null);
        $this->addColumn('training_start_date', 'TrainingStartDate', 'DATE', false, null, null);
        $this->addColumn('training_end_date', 'TrainingEndDate', 'DATE', false, null, null);
        $this->addColumn('resign_date', 'ResignDate', 'DATE', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('transfer_date', 'TransferDate', 'DATE', false, null, null);
        $this->addColumn('reliving_date', 'RelivingDate', 'DATE', false, null, null);
        $this->addColumn('nsm_approve_date', 'NsmApproveDate', 'DATE', false, null, null);
        $this->addColumn('resignation_rejected_date', 'ResignationRejectedDate', 'DATE', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdtId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdtId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdtId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdtId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdtId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdtId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('HrdtId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? HrUserDatesTableMap::CLASS_DEFAULT : HrUserDatesTableMap::OM_CLASS;
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
     * @return array (HrUserDates object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = HrUserDatesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HrUserDatesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HrUserDatesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HrUserDatesTableMap::OM_CLASS;
            /** @var HrUserDates $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HrUserDatesTableMap::addInstanceToPool($obj, $key);
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
            $key = HrUserDatesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HrUserDatesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var HrUserDates $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HrUserDatesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_HRDT_ID);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_BIRTH_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_JOIN_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_PROBATION_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_CONFIRMATION_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_TRAINING_START_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_TRAINING_END_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_RESIGN_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_TRANSFER_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_RELIVING_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_NSM_APPROVE_DATE);
            $criteria->addSelectColumn(HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.hrdt_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.birth_date');
            $criteria->addSelectColumn($alias . '.join_date');
            $criteria->addSelectColumn($alias . '.probation_date');
            $criteria->addSelectColumn($alias . '.confirmation_date');
            $criteria->addSelectColumn($alias . '.training_start_date');
            $criteria->addSelectColumn($alias . '.training_end_date');
            $criteria->addSelectColumn($alias . '.resign_date');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.transfer_date');
            $criteria->addSelectColumn($alias . '.reliving_date');
            $criteria->addSelectColumn($alias . '.nsm_approve_date');
            $criteria->addSelectColumn($alias . '.resignation_rejected_date');
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
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_HRDT_ID);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_BIRTH_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_JOIN_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_PROBATION_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_CONFIRMATION_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_TRAINING_START_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_TRAINING_END_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_RESIGN_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_TRANSFER_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_RELIVING_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_NSM_APPROVE_DATE);
            $criteria->removeSelectColumn(HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.hrdt_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.birth_date');
            $criteria->removeSelectColumn($alias . '.join_date');
            $criteria->removeSelectColumn($alias . '.probation_date');
            $criteria->removeSelectColumn($alias . '.confirmation_date');
            $criteria->removeSelectColumn($alias . '.training_start_date');
            $criteria->removeSelectColumn($alias . '.training_end_date');
            $criteria->removeSelectColumn($alias . '.resign_date');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.transfer_date');
            $criteria->removeSelectColumn($alias . '.reliving_date');
            $criteria->removeSelectColumn($alias . '.nsm_approve_date');
            $criteria->removeSelectColumn($alias . '.resignation_rejected_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(HrUserDatesTableMap::DATABASE_NAME)->getTable(HrUserDatesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a HrUserDates or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or HrUserDates object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDatesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\HrUserDates) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HrUserDatesTableMap::DATABASE_NAME);
            $criteria->add(HrUserDatesTableMap::COL_HRDT_ID, (array) $values, Criteria::IN);
        }

        $query = HrUserDatesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HrUserDatesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HrUserDatesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the hr_user_dates table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return HrUserDatesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a HrUserDates or Criteria object.
     *
     * @param mixed $criteria Criteria or HrUserDates object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDatesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from HrUserDates object
        }

        if ($criteria->containsKey(HrUserDatesTableMap::COL_HRDT_ID) && $criteria->keyContainsValue(HrUserDatesTableMap::COL_HRDT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HrUserDatesTableMap::COL_HRDT_ID.')');
        }


        // Set the correct dbName
        $query = HrUserDatesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
