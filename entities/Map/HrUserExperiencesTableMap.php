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
use entities\HrUserExperiences;
use entities\HrUserExperiencesQuery;


/**
 * This class defines the structure of the 'hr_user_experiences' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class HrUserExperiencesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.HrUserExperiencesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'hr_user_experiences';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'HrUserExperiences';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\HrUserExperiences';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.HrUserExperiences';

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
     * the column name for the hrex_id field
     */
    public const COL_HREX_ID = 'hr_user_experiences.hrex_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'hr_user_experiences.employee_id';

    /**
     * the column name for the name_of_company field
     */
    public const COL_NAME_OF_COMPANY = 'hr_user_experiences.name_of_company';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'hr_user_experiences.designation';

    /**
     * the column name for the from_date field
     */
    public const COL_FROM_DATE = 'hr_user_experiences.from_date';

    /**
     * the column name for the to_date field
     */
    public const COL_TO_DATE = 'hr_user_experiences.to_date';

    /**
     * the column name for the job field
     */
    public const COL_JOB = 'hr_user_experiences.job';

    /**
     * the column name for the start_salary field
     */
    public const COL_START_SALARY = 'hr_user_experiences.start_salary';

    /**
     * the column name for the end_salary field
     */
    public const COL_END_SALARY = 'hr_user_experiences.end_salary';

    /**
     * the column name for the reason_for_depart field
     */
    public const COL_REASON_FOR_DEPART = 'hr_user_experiences.reason_for_depart';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'hr_user_experiences.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'hr_user_experiences.updated_at';

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
        self::TYPE_PHPNAME       => ['HrexId', 'EmployeeId', 'NameOfCompany', 'Designation', 'FromDate', 'ToDate', 'Job', 'StartSalary', 'EndSalary', 'ReasonForDepart', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['hrexId', 'employeeId', 'nameOfCompany', 'designation', 'fromDate', 'toDate', 'job', 'startSalary', 'endSalary', 'reasonForDepart', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [HrUserExperiencesTableMap::COL_HREX_ID, HrUserExperiencesTableMap::COL_EMPLOYEE_ID, HrUserExperiencesTableMap::COL_NAME_OF_COMPANY, HrUserExperiencesTableMap::COL_DESIGNATION, HrUserExperiencesTableMap::COL_FROM_DATE, HrUserExperiencesTableMap::COL_TO_DATE, HrUserExperiencesTableMap::COL_JOB, HrUserExperiencesTableMap::COL_START_SALARY, HrUserExperiencesTableMap::COL_END_SALARY, HrUserExperiencesTableMap::COL_REASON_FOR_DEPART, HrUserExperiencesTableMap::COL_CREATED_AT, HrUserExperiencesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['hrex_id', 'employee_id', 'name_of_company', 'designation', 'from_date', 'to_date', 'job', 'start_salary', 'end_salary', 'reason_for_depart', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['HrexId' => 0, 'EmployeeId' => 1, 'NameOfCompany' => 2, 'Designation' => 3, 'FromDate' => 4, 'ToDate' => 5, 'Job' => 6, 'StartSalary' => 7, 'EndSalary' => 8, 'ReasonForDepart' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ],
        self::TYPE_CAMELNAME     => ['hrexId' => 0, 'employeeId' => 1, 'nameOfCompany' => 2, 'designation' => 3, 'fromDate' => 4, 'toDate' => 5, 'job' => 6, 'startSalary' => 7, 'endSalary' => 8, 'reasonForDepart' => 9, 'createdAt' => 10, 'updatedAt' => 11, ],
        self::TYPE_COLNAME       => [HrUserExperiencesTableMap::COL_HREX_ID => 0, HrUserExperiencesTableMap::COL_EMPLOYEE_ID => 1, HrUserExperiencesTableMap::COL_NAME_OF_COMPANY => 2, HrUserExperiencesTableMap::COL_DESIGNATION => 3, HrUserExperiencesTableMap::COL_FROM_DATE => 4, HrUserExperiencesTableMap::COL_TO_DATE => 5, HrUserExperiencesTableMap::COL_JOB => 6, HrUserExperiencesTableMap::COL_START_SALARY => 7, HrUserExperiencesTableMap::COL_END_SALARY => 8, HrUserExperiencesTableMap::COL_REASON_FOR_DEPART => 9, HrUserExperiencesTableMap::COL_CREATED_AT => 10, HrUserExperiencesTableMap::COL_UPDATED_AT => 11, ],
        self::TYPE_FIELDNAME     => ['hrex_id' => 0, 'employee_id' => 1, 'name_of_company' => 2, 'designation' => 3, 'from_date' => 4, 'to_date' => 5, 'job' => 6, 'start_salary' => 7, 'end_salary' => 8, 'reason_for_depart' => 9, 'created_at' => 10, 'updated_at' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'HrexId' => 'HREX_ID',
        'HrUserExperiences.HrexId' => 'HREX_ID',
        'hrexId' => 'HREX_ID',
        'hrUserExperiences.hrexId' => 'HREX_ID',
        'HrUserExperiencesTableMap::COL_HREX_ID' => 'HREX_ID',
        'COL_HREX_ID' => 'HREX_ID',
        'hrex_id' => 'HREX_ID',
        'hr_user_experiences.hrex_id' => 'HREX_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'HrUserExperiences.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'hrUserExperiences.employeeId' => 'EMPLOYEE_ID',
        'HrUserExperiencesTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'hr_user_experiences.employee_id' => 'EMPLOYEE_ID',
        'NameOfCompany' => 'NAME_OF_COMPANY',
        'HrUserExperiences.NameOfCompany' => 'NAME_OF_COMPANY',
        'nameOfCompany' => 'NAME_OF_COMPANY',
        'hrUserExperiences.nameOfCompany' => 'NAME_OF_COMPANY',
        'HrUserExperiencesTableMap::COL_NAME_OF_COMPANY' => 'NAME_OF_COMPANY',
        'COL_NAME_OF_COMPANY' => 'NAME_OF_COMPANY',
        'name_of_company' => 'NAME_OF_COMPANY',
        'hr_user_experiences.name_of_company' => 'NAME_OF_COMPANY',
        'Designation' => 'DESIGNATION',
        'HrUserExperiences.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'hrUserExperiences.designation' => 'DESIGNATION',
        'HrUserExperiencesTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'hr_user_experiences.designation' => 'DESIGNATION',
        'FromDate' => 'FROM_DATE',
        'HrUserExperiences.FromDate' => 'FROM_DATE',
        'fromDate' => 'FROM_DATE',
        'hrUserExperiences.fromDate' => 'FROM_DATE',
        'HrUserExperiencesTableMap::COL_FROM_DATE' => 'FROM_DATE',
        'COL_FROM_DATE' => 'FROM_DATE',
        'from_date' => 'FROM_DATE',
        'hr_user_experiences.from_date' => 'FROM_DATE',
        'ToDate' => 'TO_DATE',
        'HrUserExperiences.ToDate' => 'TO_DATE',
        'toDate' => 'TO_DATE',
        'hrUserExperiences.toDate' => 'TO_DATE',
        'HrUserExperiencesTableMap::COL_TO_DATE' => 'TO_DATE',
        'COL_TO_DATE' => 'TO_DATE',
        'to_date' => 'TO_DATE',
        'hr_user_experiences.to_date' => 'TO_DATE',
        'Job' => 'JOB',
        'HrUserExperiences.Job' => 'JOB',
        'job' => 'JOB',
        'hrUserExperiences.job' => 'JOB',
        'HrUserExperiencesTableMap::COL_JOB' => 'JOB',
        'COL_JOB' => 'JOB',
        'hr_user_experiences.job' => 'JOB',
        'StartSalary' => 'START_SALARY',
        'HrUserExperiences.StartSalary' => 'START_SALARY',
        'startSalary' => 'START_SALARY',
        'hrUserExperiences.startSalary' => 'START_SALARY',
        'HrUserExperiencesTableMap::COL_START_SALARY' => 'START_SALARY',
        'COL_START_SALARY' => 'START_SALARY',
        'start_salary' => 'START_SALARY',
        'hr_user_experiences.start_salary' => 'START_SALARY',
        'EndSalary' => 'END_SALARY',
        'HrUserExperiences.EndSalary' => 'END_SALARY',
        'endSalary' => 'END_SALARY',
        'hrUserExperiences.endSalary' => 'END_SALARY',
        'HrUserExperiencesTableMap::COL_END_SALARY' => 'END_SALARY',
        'COL_END_SALARY' => 'END_SALARY',
        'end_salary' => 'END_SALARY',
        'hr_user_experiences.end_salary' => 'END_SALARY',
        'ReasonForDepart' => 'REASON_FOR_DEPART',
        'HrUserExperiences.ReasonForDepart' => 'REASON_FOR_DEPART',
        'reasonForDepart' => 'REASON_FOR_DEPART',
        'hrUserExperiences.reasonForDepart' => 'REASON_FOR_DEPART',
        'HrUserExperiencesTableMap::COL_REASON_FOR_DEPART' => 'REASON_FOR_DEPART',
        'COL_REASON_FOR_DEPART' => 'REASON_FOR_DEPART',
        'reason_for_depart' => 'REASON_FOR_DEPART',
        'hr_user_experiences.reason_for_depart' => 'REASON_FOR_DEPART',
        'CreatedAt' => 'CREATED_AT',
        'HrUserExperiences.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'hrUserExperiences.createdAt' => 'CREATED_AT',
        'HrUserExperiencesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'hr_user_experiences.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'HrUserExperiences.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'hrUserExperiences.updatedAt' => 'UPDATED_AT',
        'HrUserExperiencesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'hr_user_experiences.updated_at' => 'UPDATED_AT',
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
        $this->setName('hr_user_experiences');
        $this->setPhpName('HrUserExperiences');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\HrUserExperiences');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('hr_user_experiences_hrex_id_seq');
        // columns
        $this->addPrimaryKey('hrex_id', 'HrexId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, 0);
        $this->addColumn('name_of_company', 'NameOfCompany', 'VARCHAR', true, 255, '0');
        $this->addColumn('designation', 'Designation', 'VARCHAR', true, 255, '0');
        $this->addColumn('from_date', 'FromDate', 'DATE', true, null, null);
        $this->addColumn('to_date', 'ToDate', 'DATE', true, null, null);
        $this->addColumn('job', 'Job', 'VARCHAR', true, 255, '0');
        $this->addColumn('start_salary', 'StartSalary', 'DOUBLE', true, 53, 0);
        $this->addColumn('end_salary', 'EndSalary', 'DOUBLE', true, 53, 0);
        $this->addColumn('reason_for_depart', 'ReasonForDepart', 'VARCHAR', true, 255, '0');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrexId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrexId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrexId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrexId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrexId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrexId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('HrexId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? HrUserExperiencesTableMap::CLASS_DEFAULT : HrUserExperiencesTableMap::OM_CLASS;
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
     * @return array (HrUserExperiences object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = HrUserExperiencesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HrUserExperiencesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HrUserExperiencesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HrUserExperiencesTableMap::OM_CLASS;
            /** @var HrUserExperiences $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HrUserExperiencesTableMap::addInstanceToPool($obj, $key);
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
            $key = HrUserExperiencesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HrUserExperiencesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var HrUserExperiences $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HrUserExperiencesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_HREX_ID);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_NAME_OF_COMPANY);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_FROM_DATE);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_TO_DATE);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_JOB);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_START_SALARY);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_END_SALARY);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_REASON_FOR_DEPART);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(HrUserExperiencesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.hrex_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.name_of_company');
            $criteria->addSelectColumn($alias . '.designation');
            $criteria->addSelectColumn($alias . '.from_date');
            $criteria->addSelectColumn($alias . '.to_date');
            $criteria->addSelectColumn($alias . '.job');
            $criteria->addSelectColumn($alias . '.start_salary');
            $criteria->addSelectColumn($alias . '.end_salary');
            $criteria->addSelectColumn($alias . '.reason_for_depart');
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
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_HREX_ID);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_NAME_OF_COMPANY);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_FROM_DATE);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_TO_DATE);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_JOB);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_START_SALARY);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_END_SALARY);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_REASON_FOR_DEPART);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(HrUserExperiencesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.hrex_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.name_of_company');
            $criteria->removeSelectColumn($alias . '.designation');
            $criteria->removeSelectColumn($alias . '.from_date');
            $criteria->removeSelectColumn($alias . '.to_date');
            $criteria->removeSelectColumn($alias . '.job');
            $criteria->removeSelectColumn($alias . '.start_salary');
            $criteria->removeSelectColumn($alias . '.end_salary');
            $criteria->removeSelectColumn($alias . '.reason_for_depart');
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
        return Propel::getServiceContainer()->getDatabaseMap(HrUserExperiencesTableMap::DATABASE_NAME)->getTable(HrUserExperiencesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a HrUserExperiences or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or HrUserExperiences object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserExperiencesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\HrUserExperiences) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HrUserExperiencesTableMap::DATABASE_NAME);
            $criteria->add(HrUserExperiencesTableMap::COL_HREX_ID, (array) $values, Criteria::IN);
        }

        $query = HrUserExperiencesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HrUserExperiencesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HrUserExperiencesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the hr_user_experiences table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return HrUserExperiencesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a HrUserExperiences or Criteria object.
     *
     * @param mixed $criteria Criteria or HrUserExperiences object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserExperiencesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from HrUserExperiences object
        }

        if ($criteria->containsKey(HrUserExperiencesTableMap::COL_HREX_ID) && $criteria->keyContainsValue(HrUserExperiencesTableMap::COL_HREX_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HrUserExperiencesTableMap::COL_HREX_ID.')');
        }


        // Set the correct dbName
        $query = HrUserExperiencesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
