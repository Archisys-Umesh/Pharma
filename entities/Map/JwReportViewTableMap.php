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
use entities\JwReportView;
use entities\JwReportViewQuery;


/**
 * This class defines the structure of the 'jw_report_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class JwReportViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.JwReportViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'jw_report_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'JwReportView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\JwReportView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.JwReportView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the user_position_code field
     */
    public const COL_USER_POSITION_CODE = 'jw_report_view.user_position_code';

    /**
     * the column name for the user_hq_name field
     */
    public const COL_USER_HQ_NAME = 'jw_report_view.user_hq_name';

    /**
     * the column name for the user_name field
     */
    public const COL_USER_NAME = 'jw_report_view.user_name';

    /**
     * the column name for the user_emp_code field
     */
    public const COL_USER_EMP_CODE = 'jw_report_view.user_emp_code';

    /**
     * the column name for the user_level field
     */
    public const COL_USER_LEVEL = 'jw_report_view.user_level';

    /**
     * the column name for the jw_hq_name field
     */
    public const COL_JW_HQ_NAME = 'jw_report_view.jw_hq_name';

    /**
     * the column name for the jw_employee_name field
     */
    public const COL_JW_EMPLOYEE_NAME = 'jw_report_view.jw_employee_name';

    /**
     * the column name for the jw_emp_code field
     */
    public const COL_JW_EMP_CODE = 'jw_report_view.jw_emp_code';

    /**
     * the column name for the jw_position_code field
     */
    public const COL_JW_POSITION_CODE = 'jw_report_view.jw_position_code';

    /**
     * the column name for the jw_emp_level field
     */
    public const COL_JW_EMP_LEVEL = 'jw_report_view.jw_emp_level';

    /**
     * the column name for the no_of_jw_days_worked field
     */
    public const COL_NO_OF_JW_DAYS_WORKED = 'jw_report_view.no_of_jw_days_worked';

    /**
     * the column name for the no_of_calls_jw field
     */
    public const COL_NO_OF_CALLS_JW = 'jw_report_view.no_of_calls_jw';

    /**
     * the column name for the call_average field
     */
    public const COL_CALL_AVERAGE = 'jw_report_view.call_average';

    /**
     * the column name for the month_year field
     */
    public const COL_MONTH_YEAR = 'jw_report_view.month_year';

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
        self::TYPE_PHPNAME       => ['UserPositionCode', 'UserHqName', 'UserName', 'UserEmpCode', 'UserLevel', 'JwHqName', 'JwEmployeeName', 'JwEmpCode', 'JwPositionCode', 'JwEmpLevel', 'NoOfJwDaysWorked', 'NoOfCallsJw', 'CallAverage', 'MonthYear', ],
        self::TYPE_CAMELNAME     => ['userPositionCode', 'userHqName', 'userName', 'userEmpCode', 'userLevel', 'jwHqName', 'jwEmployeeName', 'jwEmpCode', 'jwPositionCode', 'jwEmpLevel', 'noOfJwDaysWorked', 'noOfCallsJw', 'callAverage', 'monthYear', ],
        self::TYPE_COLNAME       => [JwReportViewTableMap::COL_USER_POSITION_CODE, JwReportViewTableMap::COL_USER_HQ_NAME, JwReportViewTableMap::COL_USER_NAME, JwReportViewTableMap::COL_USER_EMP_CODE, JwReportViewTableMap::COL_USER_LEVEL, JwReportViewTableMap::COL_JW_HQ_NAME, JwReportViewTableMap::COL_JW_EMPLOYEE_NAME, JwReportViewTableMap::COL_JW_EMP_CODE, JwReportViewTableMap::COL_JW_POSITION_CODE, JwReportViewTableMap::COL_JW_EMP_LEVEL, JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED, JwReportViewTableMap::COL_NO_OF_CALLS_JW, JwReportViewTableMap::COL_CALL_AVERAGE, JwReportViewTableMap::COL_MONTH_YEAR, ],
        self::TYPE_FIELDNAME     => ['user_position_code', 'user_hq_name', 'user_name', 'user_emp_code', 'user_level', 'jw_hq_name', 'jw_employee_name', 'jw_emp_code', 'jw_position_code', 'jw_emp_level', 'no_of_jw_days_worked', 'no_of_calls_jw', 'call_average', 'month_year', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['UserPositionCode' => 0, 'UserHqName' => 1, 'UserName' => 2, 'UserEmpCode' => 3, 'UserLevel' => 4, 'JwHqName' => 5, 'JwEmployeeName' => 6, 'JwEmpCode' => 7, 'JwPositionCode' => 8, 'JwEmpLevel' => 9, 'NoOfJwDaysWorked' => 10, 'NoOfCallsJw' => 11, 'CallAverage' => 12, 'MonthYear' => 13, ],
        self::TYPE_CAMELNAME     => ['userPositionCode' => 0, 'userHqName' => 1, 'userName' => 2, 'userEmpCode' => 3, 'userLevel' => 4, 'jwHqName' => 5, 'jwEmployeeName' => 6, 'jwEmpCode' => 7, 'jwPositionCode' => 8, 'jwEmpLevel' => 9, 'noOfJwDaysWorked' => 10, 'noOfCallsJw' => 11, 'callAverage' => 12, 'monthYear' => 13, ],
        self::TYPE_COLNAME       => [JwReportViewTableMap::COL_USER_POSITION_CODE => 0, JwReportViewTableMap::COL_USER_HQ_NAME => 1, JwReportViewTableMap::COL_USER_NAME => 2, JwReportViewTableMap::COL_USER_EMP_CODE => 3, JwReportViewTableMap::COL_USER_LEVEL => 4, JwReportViewTableMap::COL_JW_HQ_NAME => 5, JwReportViewTableMap::COL_JW_EMPLOYEE_NAME => 6, JwReportViewTableMap::COL_JW_EMP_CODE => 7, JwReportViewTableMap::COL_JW_POSITION_CODE => 8, JwReportViewTableMap::COL_JW_EMP_LEVEL => 9, JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED => 10, JwReportViewTableMap::COL_NO_OF_CALLS_JW => 11, JwReportViewTableMap::COL_CALL_AVERAGE => 12, JwReportViewTableMap::COL_MONTH_YEAR => 13, ],
        self::TYPE_FIELDNAME     => ['user_position_code' => 0, 'user_hq_name' => 1, 'user_name' => 2, 'user_emp_code' => 3, 'user_level' => 4, 'jw_hq_name' => 5, 'jw_employee_name' => 6, 'jw_emp_code' => 7, 'jw_position_code' => 8, 'jw_emp_level' => 9, 'no_of_jw_days_worked' => 10, 'no_of_calls_jw' => 11, 'call_average' => 12, 'month_year' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'UserPositionCode' => 'USER_POSITION_CODE',
        'JwReportView.UserPositionCode' => 'USER_POSITION_CODE',
        'userPositionCode' => 'USER_POSITION_CODE',
        'jwReportView.userPositionCode' => 'USER_POSITION_CODE',
        'JwReportViewTableMap::COL_USER_POSITION_CODE' => 'USER_POSITION_CODE',
        'COL_USER_POSITION_CODE' => 'USER_POSITION_CODE',
        'user_position_code' => 'USER_POSITION_CODE',
        'jw_report_view.user_position_code' => 'USER_POSITION_CODE',
        'UserHqName' => 'USER_HQ_NAME',
        'JwReportView.UserHqName' => 'USER_HQ_NAME',
        'userHqName' => 'USER_HQ_NAME',
        'jwReportView.userHqName' => 'USER_HQ_NAME',
        'JwReportViewTableMap::COL_USER_HQ_NAME' => 'USER_HQ_NAME',
        'COL_USER_HQ_NAME' => 'USER_HQ_NAME',
        'user_hq_name' => 'USER_HQ_NAME',
        'jw_report_view.user_hq_name' => 'USER_HQ_NAME',
        'UserName' => 'USER_NAME',
        'JwReportView.UserName' => 'USER_NAME',
        'userName' => 'USER_NAME',
        'jwReportView.userName' => 'USER_NAME',
        'JwReportViewTableMap::COL_USER_NAME' => 'USER_NAME',
        'COL_USER_NAME' => 'USER_NAME',
        'user_name' => 'USER_NAME',
        'jw_report_view.user_name' => 'USER_NAME',
        'UserEmpCode' => 'USER_EMP_CODE',
        'JwReportView.UserEmpCode' => 'USER_EMP_CODE',
        'userEmpCode' => 'USER_EMP_CODE',
        'jwReportView.userEmpCode' => 'USER_EMP_CODE',
        'JwReportViewTableMap::COL_USER_EMP_CODE' => 'USER_EMP_CODE',
        'COL_USER_EMP_CODE' => 'USER_EMP_CODE',
        'user_emp_code' => 'USER_EMP_CODE',
        'jw_report_view.user_emp_code' => 'USER_EMP_CODE',
        'UserLevel' => 'USER_LEVEL',
        'JwReportView.UserLevel' => 'USER_LEVEL',
        'userLevel' => 'USER_LEVEL',
        'jwReportView.userLevel' => 'USER_LEVEL',
        'JwReportViewTableMap::COL_USER_LEVEL' => 'USER_LEVEL',
        'COL_USER_LEVEL' => 'USER_LEVEL',
        'user_level' => 'USER_LEVEL',
        'jw_report_view.user_level' => 'USER_LEVEL',
        'JwHqName' => 'JW_HQ_NAME',
        'JwReportView.JwHqName' => 'JW_HQ_NAME',
        'jwHqName' => 'JW_HQ_NAME',
        'jwReportView.jwHqName' => 'JW_HQ_NAME',
        'JwReportViewTableMap::COL_JW_HQ_NAME' => 'JW_HQ_NAME',
        'COL_JW_HQ_NAME' => 'JW_HQ_NAME',
        'jw_hq_name' => 'JW_HQ_NAME',
        'jw_report_view.jw_hq_name' => 'JW_HQ_NAME',
        'JwEmployeeName' => 'JW_EMPLOYEE_NAME',
        'JwReportView.JwEmployeeName' => 'JW_EMPLOYEE_NAME',
        'jwEmployeeName' => 'JW_EMPLOYEE_NAME',
        'jwReportView.jwEmployeeName' => 'JW_EMPLOYEE_NAME',
        'JwReportViewTableMap::COL_JW_EMPLOYEE_NAME' => 'JW_EMPLOYEE_NAME',
        'COL_JW_EMPLOYEE_NAME' => 'JW_EMPLOYEE_NAME',
        'jw_employee_name' => 'JW_EMPLOYEE_NAME',
        'jw_report_view.jw_employee_name' => 'JW_EMPLOYEE_NAME',
        'JwEmpCode' => 'JW_EMP_CODE',
        'JwReportView.JwEmpCode' => 'JW_EMP_CODE',
        'jwEmpCode' => 'JW_EMP_CODE',
        'jwReportView.jwEmpCode' => 'JW_EMP_CODE',
        'JwReportViewTableMap::COL_JW_EMP_CODE' => 'JW_EMP_CODE',
        'COL_JW_EMP_CODE' => 'JW_EMP_CODE',
        'jw_emp_code' => 'JW_EMP_CODE',
        'jw_report_view.jw_emp_code' => 'JW_EMP_CODE',
        'JwPositionCode' => 'JW_POSITION_CODE',
        'JwReportView.JwPositionCode' => 'JW_POSITION_CODE',
        'jwPositionCode' => 'JW_POSITION_CODE',
        'jwReportView.jwPositionCode' => 'JW_POSITION_CODE',
        'JwReportViewTableMap::COL_JW_POSITION_CODE' => 'JW_POSITION_CODE',
        'COL_JW_POSITION_CODE' => 'JW_POSITION_CODE',
        'jw_position_code' => 'JW_POSITION_CODE',
        'jw_report_view.jw_position_code' => 'JW_POSITION_CODE',
        'JwEmpLevel' => 'JW_EMP_LEVEL',
        'JwReportView.JwEmpLevel' => 'JW_EMP_LEVEL',
        'jwEmpLevel' => 'JW_EMP_LEVEL',
        'jwReportView.jwEmpLevel' => 'JW_EMP_LEVEL',
        'JwReportViewTableMap::COL_JW_EMP_LEVEL' => 'JW_EMP_LEVEL',
        'COL_JW_EMP_LEVEL' => 'JW_EMP_LEVEL',
        'jw_emp_level' => 'JW_EMP_LEVEL',
        'jw_report_view.jw_emp_level' => 'JW_EMP_LEVEL',
        'NoOfJwDaysWorked' => 'NO_OF_JW_DAYS_WORKED',
        'JwReportView.NoOfJwDaysWorked' => 'NO_OF_JW_DAYS_WORKED',
        'noOfJwDaysWorked' => 'NO_OF_JW_DAYS_WORKED',
        'jwReportView.noOfJwDaysWorked' => 'NO_OF_JW_DAYS_WORKED',
        'JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED' => 'NO_OF_JW_DAYS_WORKED',
        'COL_NO_OF_JW_DAYS_WORKED' => 'NO_OF_JW_DAYS_WORKED',
        'no_of_jw_days_worked' => 'NO_OF_JW_DAYS_WORKED',
        'jw_report_view.no_of_jw_days_worked' => 'NO_OF_JW_DAYS_WORKED',
        'NoOfCallsJw' => 'NO_OF_CALLS_JW',
        'JwReportView.NoOfCallsJw' => 'NO_OF_CALLS_JW',
        'noOfCallsJw' => 'NO_OF_CALLS_JW',
        'jwReportView.noOfCallsJw' => 'NO_OF_CALLS_JW',
        'JwReportViewTableMap::COL_NO_OF_CALLS_JW' => 'NO_OF_CALLS_JW',
        'COL_NO_OF_CALLS_JW' => 'NO_OF_CALLS_JW',
        'no_of_calls_jw' => 'NO_OF_CALLS_JW',
        'jw_report_view.no_of_calls_jw' => 'NO_OF_CALLS_JW',
        'CallAverage' => 'CALL_AVERAGE',
        'JwReportView.CallAverage' => 'CALL_AVERAGE',
        'callAverage' => 'CALL_AVERAGE',
        'jwReportView.callAverage' => 'CALL_AVERAGE',
        'JwReportViewTableMap::COL_CALL_AVERAGE' => 'CALL_AVERAGE',
        'COL_CALL_AVERAGE' => 'CALL_AVERAGE',
        'call_average' => 'CALL_AVERAGE',
        'jw_report_view.call_average' => 'CALL_AVERAGE',
        'MonthYear' => 'MONTH_YEAR',
        'JwReportView.MonthYear' => 'MONTH_YEAR',
        'monthYear' => 'MONTH_YEAR',
        'jwReportView.monthYear' => 'MONTH_YEAR',
        'JwReportViewTableMap::COL_MONTH_YEAR' => 'MONTH_YEAR',
        'COL_MONTH_YEAR' => 'MONTH_YEAR',
        'month_year' => 'MONTH_YEAR',
        'jw_report_view.month_year' => 'MONTH_YEAR',
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
        $this->setName('jw_report_view');
        $this->setPhpName('JwReportView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\JwReportView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('user_position_code', 'UserPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('user_hq_name', 'UserHqName', 'VARCHAR', false, null, null);
        $this->addColumn('user_name', 'UserName', 'VARCHAR', false, null, null);
        $this->addColumn('user_emp_code', 'UserEmpCode', 'VARCHAR', false, 50, null);
        $this->addColumn('user_level', 'UserLevel', 'VARCHAR', false, null, null);
        $this->addColumn('jw_hq_name', 'JwHqName', 'VARCHAR', false, null, null);
        $this->addColumn('jw_employee_name', 'JwEmployeeName', 'VARCHAR', false, null, null);
        $this->addColumn('jw_emp_code', 'JwEmpCode', 'VARCHAR', false, 50, null);
        $this->addColumn('jw_position_code', 'JwPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('jw_emp_level', 'JwEmpLevel', 'VARCHAR', false, null, null);
        $this->addColumn('no_of_jw_days_worked', 'NoOfJwDaysWorked', 'INTEGER', false, null, null);
        $this->addColumn('no_of_calls_jw', 'NoOfCallsJw', 'INTEGER', false, null, null);
        $this->addColumn('call_average', 'CallAverage', 'DECIMAL', false, null, null);
        $this->addColumn('month_year', 'MonthYear', 'VARCHAR', false, null, null);
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
        return $withPrefix ? JwReportViewTableMap::CLASS_DEFAULT : JwReportViewTableMap::OM_CLASS;
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
     * @return array (JwReportView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = JwReportViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JwReportViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JwReportViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JwReportViewTableMap::OM_CLASS;
            /** @var JwReportView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JwReportViewTableMap::addInstanceToPool($obj, $key);
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
            $key = JwReportViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JwReportViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JwReportView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JwReportViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JwReportViewTableMap::COL_USER_POSITION_CODE);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_USER_HQ_NAME);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_USER_NAME);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_USER_EMP_CODE);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_USER_LEVEL);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_JW_HQ_NAME);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_JW_EMPLOYEE_NAME);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_JW_EMP_CODE);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_JW_POSITION_CODE);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_JW_EMP_LEVEL);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_NO_OF_CALLS_JW);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_CALL_AVERAGE);
            $criteria->addSelectColumn(JwReportViewTableMap::COL_MONTH_YEAR);
        } else {
            $criteria->addSelectColumn($alias . '.user_position_code');
            $criteria->addSelectColumn($alias . '.user_hq_name');
            $criteria->addSelectColumn($alias . '.user_name');
            $criteria->addSelectColumn($alias . '.user_emp_code');
            $criteria->addSelectColumn($alias . '.user_level');
            $criteria->addSelectColumn($alias . '.jw_hq_name');
            $criteria->addSelectColumn($alias . '.jw_employee_name');
            $criteria->addSelectColumn($alias . '.jw_emp_code');
            $criteria->addSelectColumn($alias . '.jw_position_code');
            $criteria->addSelectColumn($alias . '.jw_emp_level');
            $criteria->addSelectColumn($alias . '.no_of_jw_days_worked');
            $criteria->addSelectColumn($alias . '.no_of_calls_jw');
            $criteria->addSelectColumn($alias . '.call_average');
            $criteria->addSelectColumn($alias . '.month_year');
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
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_USER_POSITION_CODE);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_USER_HQ_NAME);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_USER_NAME);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_USER_EMP_CODE);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_USER_LEVEL);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_JW_HQ_NAME);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_JW_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_JW_EMP_CODE);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_JW_POSITION_CODE);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_JW_EMP_LEVEL);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_NO_OF_CALLS_JW);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_CALL_AVERAGE);
            $criteria->removeSelectColumn(JwReportViewTableMap::COL_MONTH_YEAR);
        } else {
            $criteria->removeSelectColumn($alias . '.user_position_code');
            $criteria->removeSelectColumn($alias . '.user_hq_name');
            $criteria->removeSelectColumn($alias . '.user_name');
            $criteria->removeSelectColumn($alias . '.user_emp_code');
            $criteria->removeSelectColumn($alias . '.user_level');
            $criteria->removeSelectColumn($alias . '.jw_hq_name');
            $criteria->removeSelectColumn($alias . '.jw_employee_name');
            $criteria->removeSelectColumn($alias . '.jw_emp_code');
            $criteria->removeSelectColumn($alias . '.jw_position_code');
            $criteria->removeSelectColumn($alias . '.jw_emp_level');
            $criteria->removeSelectColumn($alias . '.no_of_jw_days_worked');
            $criteria->removeSelectColumn($alias . '.no_of_calls_jw');
            $criteria->removeSelectColumn($alias . '.call_average');
            $criteria->removeSelectColumn($alias . '.month_year');
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
        return Propel::getServiceContainer()->getDatabaseMap(JwReportViewTableMap::DATABASE_NAME)->getTable(JwReportViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a JwReportView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or JwReportView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JwReportViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\JwReportView) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The JwReportView object has no primary key');
        }

        $query = JwReportViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JwReportViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JwReportViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the jw_report_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return JwReportViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JwReportView or Criteria object.
     *
     * @param mixed $criteria Criteria or JwReportView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JwReportViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JwReportView object
        }


        // Set the correct dbName
        $query = JwReportViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
