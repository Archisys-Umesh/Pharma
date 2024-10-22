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
use entities\MtpDeviationView;
use entities\MtpDeviationViewQuery;


/**
 * This class defines the structure of the 'mtp_deviation_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MtpDeviationViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MtpDeviationViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'mtp_deviation_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'MtpDeviationView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\MtpDeviationView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.MtpDeviationView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 23;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 23;

    /**
     * the column name for the bu field
     */
    public const COL_BU = 'mtp_deviation_view.bu';

    /**
     * the column name for the level3 field
     */
    public const COL_LEVEL3 = 'mtp_deviation_view.level3';

    /**
     * the column name for the level2 field
     */
    public const COL_LEVEL2 = 'mtp_deviation_view.level2';

    /**
     * the column name for the level1 field
     */
    public const COL_LEVEL1 = 'mtp_deviation_view.level1';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'mtp_deviation_view.position_id';

    /**
     * the column name for the location field
     */
    public const COL_LOCATION = 'mtp_deviation_view.location';

    /**
     * the column name for the repname field
     */
    public const COL_REPNAME = 'mtp_deviation_view.repname';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'mtp_deviation_view.employee_code';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'mtp_deviation_view.designation';

    /**
     * the column name for the date field
     */
    public const COL_DATE = 'mtp_deviation_view.date';

    /**
     * the column name for the planned_activity field
     */
    public const COL_PLANNED_ACTIVITY = 'mtp_deviation_view.planned_activity';

    /**
     * the column name for the actual_activity field
     */
    public const COL_ACTUAL_ACTIVITY = 'mtp_deviation_view.actual_activity';

    /**
     * the column name for the planned_patch field
     */
    public const COL_PLANNED_PATCH = 'mtp_deviation_view.planned_patch';

    /**
     * the column name for the covered_patch field
     */
    public const COL_COVERED_PATCH = 'mtp_deviation_view.covered_patch';

    /**
     * the column name for the plannedtown field
     */
    public const COL_PLANNEDTOWN = 'mtp_deviation_view.plannedtown';

    /**
     * the column name for the coveredtown field
     */
    public const COL_COVEREDTOWN = 'mtp_deviation_view.coveredtown';

    /**
     * the column name for the totalcalls_made field
     */
    public const COL_TOTALCALLS_MADE = 'mtp_deviation_view.totalcalls_made';

    /**
     * the column name for the doctor_planned field
     */
    public const COL_DOCTOR_PLANNED = 'mtp_deviation_view.doctor_planned';

    /**
     * the column name for the doctor_covered field
     */
    public const COL_DOCTOR_COVERED = 'mtp_deviation_view.doctor_covered';

    /**
     * the column name for the retailer_planned field
     */
    public const COL_RETAILER_PLANNED = 'mtp_deviation_view.retailer_planned';

    /**
     * the column name for the retailer_covered field
     */
    public const COL_RETAILER_COVERED = 'mtp_deviation_view.retailer_covered';

    /**
     * the column name for the stokiest_planned field
     */
    public const COL_STOKIEST_PLANNED = 'mtp_deviation_view.stokiest_planned';

    /**
     * the column name for the stokiest_covered field
     */
    public const COL_STOKIEST_COVERED = 'mtp_deviation_view.stokiest_covered';

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
        self::TYPE_PHPNAME       => ['Bu', 'Level3', 'Level2', 'Level1', 'PositionId', 'Location', 'Repname', 'EmployeeCode', 'Designation', 'Date', 'PlannedActivity', 'ActualActivity', 'PlannedPatch', 'CoveredPatch', 'Plannedtown', 'Coveredtown', 'TotalcallsMade', 'DoctorPlanned', 'DoctorCovered', 'RetailerPlanned', 'RetailerCovered', 'StokiestPlanned', 'StokiestCovered', ],
        self::TYPE_CAMELNAME     => ['bu', 'level3', 'level2', 'level1', 'positionId', 'location', 'repname', 'employeeCode', 'designation', 'date', 'plannedActivity', 'actualActivity', 'plannedPatch', 'coveredPatch', 'plannedtown', 'coveredtown', 'totalcallsMade', 'doctorPlanned', 'doctorCovered', 'retailerPlanned', 'retailerCovered', 'stokiestPlanned', 'stokiestCovered', ],
        self::TYPE_COLNAME       => [MtpDeviationViewTableMap::COL_BU, MtpDeviationViewTableMap::COL_LEVEL3, MtpDeviationViewTableMap::COL_LEVEL2, MtpDeviationViewTableMap::COL_LEVEL1, MtpDeviationViewTableMap::COL_POSITION_ID, MtpDeviationViewTableMap::COL_LOCATION, MtpDeviationViewTableMap::COL_REPNAME, MtpDeviationViewTableMap::COL_EMPLOYEE_CODE, MtpDeviationViewTableMap::COL_DESIGNATION, MtpDeviationViewTableMap::COL_DATE, MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY, MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY, MtpDeviationViewTableMap::COL_PLANNED_PATCH, MtpDeviationViewTableMap::COL_COVERED_PATCH, MtpDeviationViewTableMap::COL_PLANNEDTOWN, MtpDeviationViewTableMap::COL_COVEREDTOWN, MtpDeviationViewTableMap::COL_TOTALCALLS_MADE, MtpDeviationViewTableMap::COL_DOCTOR_PLANNED, MtpDeviationViewTableMap::COL_DOCTOR_COVERED, MtpDeviationViewTableMap::COL_RETAILER_PLANNED, MtpDeviationViewTableMap::COL_RETAILER_COVERED, MtpDeviationViewTableMap::COL_STOKIEST_PLANNED, MtpDeviationViewTableMap::COL_STOKIEST_COVERED, ],
        self::TYPE_FIELDNAME     => ['bu', 'level3', 'level2', 'level1', 'position_id', 'location', 'repname', 'employee_code', 'designation', 'date', 'planned_activity', 'actual_activity', 'planned_patch', 'covered_patch', 'plannedtown', 'coveredtown', 'totalcalls_made', 'doctor_planned', 'doctor_covered', 'retailer_planned', 'retailer_covered', 'stokiest_planned', 'stokiest_covered', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, ]
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
        self::TYPE_PHPNAME       => ['Bu' => 0, 'Level3' => 1, 'Level2' => 2, 'Level1' => 3, 'PositionId' => 4, 'Location' => 5, 'Repname' => 6, 'EmployeeCode' => 7, 'Designation' => 8, 'Date' => 9, 'PlannedActivity' => 10, 'ActualActivity' => 11, 'PlannedPatch' => 12, 'CoveredPatch' => 13, 'Plannedtown' => 14, 'Coveredtown' => 15, 'TotalcallsMade' => 16, 'DoctorPlanned' => 17, 'DoctorCovered' => 18, 'RetailerPlanned' => 19, 'RetailerCovered' => 20, 'StokiestPlanned' => 21, 'StokiestCovered' => 22, ],
        self::TYPE_CAMELNAME     => ['bu' => 0, 'level3' => 1, 'level2' => 2, 'level1' => 3, 'positionId' => 4, 'location' => 5, 'repname' => 6, 'employeeCode' => 7, 'designation' => 8, 'date' => 9, 'plannedActivity' => 10, 'actualActivity' => 11, 'plannedPatch' => 12, 'coveredPatch' => 13, 'plannedtown' => 14, 'coveredtown' => 15, 'totalcallsMade' => 16, 'doctorPlanned' => 17, 'doctorCovered' => 18, 'retailerPlanned' => 19, 'retailerCovered' => 20, 'stokiestPlanned' => 21, 'stokiestCovered' => 22, ],
        self::TYPE_COLNAME       => [MtpDeviationViewTableMap::COL_BU => 0, MtpDeviationViewTableMap::COL_LEVEL3 => 1, MtpDeviationViewTableMap::COL_LEVEL2 => 2, MtpDeviationViewTableMap::COL_LEVEL1 => 3, MtpDeviationViewTableMap::COL_POSITION_ID => 4, MtpDeviationViewTableMap::COL_LOCATION => 5, MtpDeviationViewTableMap::COL_REPNAME => 6, MtpDeviationViewTableMap::COL_EMPLOYEE_CODE => 7, MtpDeviationViewTableMap::COL_DESIGNATION => 8, MtpDeviationViewTableMap::COL_DATE => 9, MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY => 10, MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY => 11, MtpDeviationViewTableMap::COL_PLANNED_PATCH => 12, MtpDeviationViewTableMap::COL_COVERED_PATCH => 13, MtpDeviationViewTableMap::COL_PLANNEDTOWN => 14, MtpDeviationViewTableMap::COL_COVEREDTOWN => 15, MtpDeviationViewTableMap::COL_TOTALCALLS_MADE => 16, MtpDeviationViewTableMap::COL_DOCTOR_PLANNED => 17, MtpDeviationViewTableMap::COL_DOCTOR_COVERED => 18, MtpDeviationViewTableMap::COL_RETAILER_PLANNED => 19, MtpDeviationViewTableMap::COL_RETAILER_COVERED => 20, MtpDeviationViewTableMap::COL_STOKIEST_PLANNED => 21, MtpDeviationViewTableMap::COL_STOKIEST_COVERED => 22, ],
        self::TYPE_FIELDNAME     => ['bu' => 0, 'level3' => 1, 'level2' => 2, 'level1' => 3, 'position_id' => 4, 'location' => 5, 'repname' => 6, 'employee_code' => 7, 'designation' => 8, 'date' => 9, 'planned_activity' => 10, 'actual_activity' => 11, 'planned_patch' => 12, 'covered_patch' => 13, 'plannedtown' => 14, 'coveredtown' => 15, 'totalcalls_made' => 16, 'doctor_planned' => 17, 'doctor_covered' => 18, 'retailer_planned' => 19, 'retailer_covered' => 20, 'stokiest_planned' => 21, 'stokiest_covered' => 22, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Bu' => 'BU',
        'MtpDeviationView.Bu' => 'BU',
        'bu' => 'BU',
        'mtpDeviationView.bu' => 'BU',
        'MtpDeviationViewTableMap::COL_BU' => 'BU',
        'COL_BU' => 'BU',
        'mtp_deviation_view.bu' => 'BU',
        'Level3' => 'LEVEL3',
        'MtpDeviationView.Level3' => 'LEVEL3',
        'level3' => 'LEVEL3',
        'mtpDeviationView.level3' => 'LEVEL3',
        'MtpDeviationViewTableMap::COL_LEVEL3' => 'LEVEL3',
        'COL_LEVEL3' => 'LEVEL3',
        'mtp_deviation_view.level3' => 'LEVEL3',
        'Level2' => 'LEVEL2',
        'MtpDeviationView.Level2' => 'LEVEL2',
        'level2' => 'LEVEL2',
        'mtpDeviationView.level2' => 'LEVEL2',
        'MtpDeviationViewTableMap::COL_LEVEL2' => 'LEVEL2',
        'COL_LEVEL2' => 'LEVEL2',
        'mtp_deviation_view.level2' => 'LEVEL2',
        'Level1' => 'LEVEL1',
        'MtpDeviationView.Level1' => 'LEVEL1',
        'level1' => 'LEVEL1',
        'mtpDeviationView.level1' => 'LEVEL1',
        'MtpDeviationViewTableMap::COL_LEVEL1' => 'LEVEL1',
        'COL_LEVEL1' => 'LEVEL1',
        'mtp_deviation_view.level1' => 'LEVEL1',
        'PositionId' => 'POSITION_ID',
        'MtpDeviationView.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'mtpDeviationView.positionId' => 'POSITION_ID',
        'MtpDeviationViewTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'mtp_deviation_view.position_id' => 'POSITION_ID',
        'Location' => 'LOCATION',
        'MtpDeviationView.Location' => 'LOCATION',
        'location' => 'LOCATION',
        'mtpDeviationView.location' => 'LOCATION',
        'MtpDeviationViewTableMap::COL_LOCATION' => 'LOCATION',
        'COL_LOCATION' => 'LOCATION',
        'mtp_deviation_view.location' => 'LOCATION',
        'Repname' => 'REPNAME',
        'MtpDeviationView.Repname' => 'REPNAME',
        'repname' => 'REPNAME',
        'mtpDeviationView.repname' => 'REPNAME',
        'MtpDeviationViewTableMap::COL_REPNAME' => 'REPNAME',
        'COL_REPNAME' => 'REPNAME',
        'mtp_deviation_view.repname' => 'REPNAME',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'MtpDeviationView.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'mtpDeviationView.employeeCode' => 'EMPLOYEE_CODE',
        'MtpDeviationViewTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'mtp_deviation_view.employee_code' => 'EMPLOYEE_CODE',
        'Designation' => 'DESIGNATION',
        'MtpDeviationView.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'mtpDeviationView.designation' => 'DESIGNATION',
        'MtpDeviationViewTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'mtp_deviation_view.designation' => 'DESIGNATION',
        'Date' => 'DATE',
        'MtpDeviationView.Date' => 'DATE',
        'date' => 'DATE',
        'mtpDeviationView.date' => 'DATE',
        'MtpDeviationViewTableMap::COL_DATE' => 'DATE',
        'COL_DATE' => 'DATE',
        'mtp_deviation_view.date' => 'DATE',
        'PlannedActivity' => 'PLANNED_ACTIVITY',
        'MtpDeviationView.PlannedActivity' => 'PLANNED_ACTIVITY',
        'plannedActivity' => 'PLANNED_ACTIVITY',
        'mtpDeviationView.plannedActivity' => 'PLANNED_ACTIVITY',
        'MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY' => 'PLANNED_ACTIVITY',
        'COL_PLANNED_ACTIVITY' => 'PLANNED_ACTIVITY',
        'planned_activity' => 'PLANNED_ACTIVITY',
        'mtp_deviation_view.planned_activity' => 'PLANNED_ACTIVITY',
        'ActualActivity' => 'ACTUAL_ACTIVITY',
        'MtpDeviationView.ActualActivity' => 'ACTUAL_ACTIVITY',
        'actualActivity' => 'ACTUAL_ACTIVITY',
        'mtpDeviationView.actualActivity' => 'ACTUAL_ACTIVITY',
        'MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY' => 'ACTUAL_ACTIVITY',
        'COL_ACTUAL_ACTIVITY' => 'ACTUAL_ACTIVITY',
        'actual_activity' => 'ACTUAL_ACTIVITY',
        'mtp_deviation_view.actual_activity' => 'ACTUAL_ACTIVITY',
        'PlannedPatch' => 'PLANNED_PATCH',
        'MtpDeviationView.PlannedPatch' => 'PLANNED_PATCH',
        'plannedPatch' => 'PLANNED_PATCH',
        'mtpDeviationView.plannedPatch' => 'PLANNED_PATCH',
        'MtpDeviationViewTableMap::COL_PLANNED_PATCH' => 'PLANNED_PATCH',
        'COL_PLANNED_PATCH' => 'PLANNED_PATCH',
        'planned_patch' => 'PLANNED_PATCH',
        'mtp_deviation_view.planned_patch' => 'PLANNED_PATCH',
        'CoveredPatch' => 'COVERED_PATCH',
        'MtpDeviationView.CoveredPatch' => 'COVERED_PATCH',
        'coveredPatch' => 'COVERED_PATCH',
        'mtpDeviationView.coveredPatch' => 'COVERED_PATCH',
        'MtpDeviationViewTableMap::COL_COVERED_PATCH' => 'COVERED_PATCH',
        'COL_COVERED_PATCH' => 'COVERED_PATCH',
        'covered_patch' => 'COVERED_PATCH',
        'mtp_deviation_view.covered_patch' => 'COVERED_PATCH',
        'Plannedtown' => 'PLANNEDTOWN',
        'MtpDeviationView.Plannedtown' => 'PLANNEDTOWN',
        'plannedtown' => 'PLANNEDTOWN',
        'mtpDeviationView.plannedtown' => 'PLANNEDTOWN',
        'MtpDeviationViewTableMap::COL_PLANNEDTOWN' => 'PLANNEDTOWN',
        'COL_PLANNEDTOWN' => 'PLANNEDTOWN',
        'mtp_deviation_view.plannedtown' => 'PLANNEDTOWN',
        'Coveredtown' => 'COVEREDTOWN',
        'MtpDeviationView.Coveredtown' => 'COVEREDTOWN',
        'coveredtown' => 'COVEREDTOWN',
        'mtpDeviationView.coveredtown' => 'COVEREDTOWN',
        'MtpDeviationViewTableMap::COL_COVEREDTOWN' => 'COVEREDTOWN',
        'COL_COVEREDTOWN' => 'COVEREDTOWN',
        'mtp_deviation_view.coveredtown' => 'COVEREDTOWN',
        'TotalcallsMade' => 'TOTALCALLS_MADE',
        'MtpDeviationView.TotalcallsMade' => 'TOTALCALLS_MADE',
        'totalcallsMade' => 'TOTALCALLS_MADE',
        'mtpDeviationView.totalcallsMade' => 'TOTALCALLS_MADE',
        'MtpDeviationViewTableMap::COL_TOTALCALLS_MADE' => 'TOTALCALLS_MADE',
        'COL_TOTALCALLS_MADE' => 'TOTALCALLS_MADE',
        'totalcalls_made' => 'TOTALCALLS_MADE',
        'mtp_deviation_view.totalcalls_made' => 'TOTALCALLS_MADE',
        'DoctorPlanned' => 'DOCTOR_PLANNED',
        'MtpDeviationView.DoctorPlanned' => 'DOCTOR_PLANNED',
        'doctorPlanned' => 'DOCTOR_PLANNED',
        'mtpDeviationView.doctorPlanned' => 'DOCTOR_PLANNED',
        'MtpDeviationViewTableMap::COL_DOCTOR_PLANNED' => 'DOCTOR_PLANNED',
        'COL_DOCTOR_PLANNED' => 'DOCTOR_PLANNED',
        'doctor_planned' => 'DOCTOR_PLANNED',
        'mtp_deviation_view.doctor_planned' => 'DOCTOR_PLANNED',
        'DoctorCovered' => 'DOCTOR_COVERED',
        'MtpDeviationView.DoctorCovered' => 'DOCTOR_COVERED',
        'doctorCovered' => 'DOCTOR_COVERED',
        'mtpDeviationView.doctorCovered' => 'DOCTOR_COVERED',
        'MtpDeviationViewTableMap::COL_DOCTOR_COVERED' => 'DOCTOR_COVERED',
        'COL_DOCTOR_COVERED' => 'DOCTOR_COVERED',
        'doctor_covered' => 'DOCTOR_COVERED',
        'mtp_deviation_view.doctor_covered' => 'DOCTOR_COVERED',
        'RetailerPlanned' => 'RETAILER_PLANNED',
        'MtpDeviationView.RetailerPlanned' => 'RETAILER_PLANNED',
        'retailerPlanned' => 'RETAILER_PLANNED',
        'mtpDeviationView.retailerPlanned' => 'RETAILER_PLANNED',
        'MtpDeviationViewTableMap::COL_RETAILER_PLANNED' => 'RETAILER_PLANNED',
        'COL_RETAILER_PLANNED' => 'RETAILER_PLANNED',
        'retailer_planned' => 'RETAILER_PLANNED',
        'mtp_deviation_view.retailer_planned' => 'RETAILER_PLANNED',
        'RetailerCovered' => 'RETAILER_COVERED',
        'MtpDeviationView.RetailerCovered' => 'RETAILER_COVERED',
        'retailerCovered' => 'RETAILER_COVERED',
        'mtpDeviationView.retailerCovered' => 'RETAILER_COVERED',
        'MtpDeviationViewTableMap::COL_RETAILER_COVERED' => 'RETAILER_COVERED',
        'COL_RETAILER_COVERED' => 'RETAILER_COVERED',
        'retailer_covered' => 'RETAILER_COVERED',
        'mtp_deviation_view.retailer_covered' => 'RETAILER_COVERED',
        'StokiestPlanned' => 'STOKIEST_PLANNED',
        'MtpDeviationView.StokiestPlanned' => 'STOKIEST_PLANNED',
        'stokiestPlanned' => 'STOKIEST_PLANNED',
        'mtpDeviationView.stokiestPlanned' => 'STOKIEST_PLANNED',
        'MtpDeviationViewTableMap::COL_STOKIEST_PLANNED' => 'STOKIEST_PLANNED',
        'COL_STOKIEST_PLANNED' => 'STOKIEST_PLANNED',
        'stokiest_planned' => 'STOKIEST_PLANNED',
        'mtp_deviation_view.stokiest_planned' => 'STOKIEST_PLANNED',
        'StokiestCovered' => 'STOKIEST_COVERED',
        'MtpDeviationView.StokiestCovered' => 'STOKIEST_COVERED',
        'stokiestCovered' => 'STOKIEST_COVERED',
        'mtpDeviationView.stokiestCovered' => 'STOKIEST_COVERED',
        'MtpDeviationViewTableMap::COL_STOKIEST_COVERED' => 'STOKIEST_COVERED',
        'COL_STOKIEST_COVERED' => 'STOKIEST_COVERED',
        'stokiest_covered' => 'STOKIEST_COVERED',
        'mtp_deviation_view.stokiest_covered' => 'STOKIEST_COVERED',
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
        $this->setName('mtp_deviation_view');
        $this->setPhpName('MtpDeviationView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\MtpDeviationView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('bu', 'Bu', 'VARCHAR', false, 150, null);
        $this->addColumn('level3', 'Level3', 'VARCHAR', false, 255, null);
        $this->addColumn('level2', 'Level2', 'VARCHAR', false, 255, null);
        $this->addColumn('level1', 'Level1', 'VARCHAR', false, 255, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('location', 'Location', 'VARCHAR', false, null, null);
        $this->addColumn('repname', 'Repname', 'VARCHAR', false, null, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, 50, null);
        $this->addColumn('designation', 'Designation', 'VARCHAR', false, 255, null);
        $this->addColumn('date', 'Date', 'DATE', false, 255, null);
        $this->addColumn('planned_activity', 'PlannedActivity', 'VARCHAR', false, null, null);
        $this->addColumn('actual_activity', 'ActualActivity', 'VARCHAR', false, null, null);
        $this->addColumn('planned_patch', 'PlannedPatch', 'VARCHAR', false, null, null);
        $this->addColumn('covered_patch', 'CoveredPatch', 'VARCHAR', false, null, null);
        $this->addColumn('plannedtown', 'Plannedtown', 'VARCHAR', false, null, null);
        $this->addColumn('coveredtown', 'Coveredtown', 'VARCHAR', false, null, null);
        $this->addColumn('totalcalls_made', 'TotalcallsMade', 'INTEGER', false, null, null);
        $this->addColumn('doctor_planned', 'DoctorPlanned', 'INTEGER', false, null, null);
        $this->addColumn('doctor_covered', 'DoctorCovered', 'INTEGER', false, null, null);
        $this->addColumn('retailer_planned', 'RetailerPlanned', 'INTEGER', false, null, null);
        $this->addColumn('retailer_covered', 'RetailerCovered', 'INTEGER', false, null, null);
        $this->addColumn('stokiest_planned', 'StokiestPlanned', 'INTEGER', false, null, null);
        $this->addColumn('stokiest_covered', 'StokiestCovered', 'INTEGER', false, null, null);
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
        return $withPrefix ? MtpDeviationViewTableMap::CLASS_DEFAULT : MtpDeviationViewTableMap::OM_CLASS;
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
     * @return array (MtpDeviationView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MtpDeviationViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MtpDeviationViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MtpDeviationViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MtpDeviationViewTableMap::OM_CLASS;
            /** @var MtpDeviationView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MtpDeviationViewTableMap::addInstanceToPool($obj, $key);
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
            $key = MtpDeviationViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MtpDeviationViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MtpDeviationView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MtpDeviationViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_BU);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_LEVEL3);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_LEVEL2);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_LEVEL1);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_LOCATION);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_REPNAME);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_DATE);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_PLANNED_PATCH);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_COVERED_PATCH);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_PLANNEDTOWN);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_COVEREDTOWN);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_TOTALCALLS_MADE);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_DOCTOR_PLANNED);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_DOCTOR_COVERED);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_RETAILER_PLANNED);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_RETAILER_COVERED);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_STOKIEST_PLANNED);
            $criteria->addSelectColumn(MtpDeviationViewTableMap::COL_STOKIEST_COVERED);
        } else {
            $criteria->addSelectColumn($alias . '.bu');
            $criteria->addSelectColumn($alias . '.level3');
            $criteria->addSelectColumn($alias . '.level2');
            $criteria->addSelectColumn($alias . '.level1');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.repname');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.designation');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.planned_activity');
            $criteria->addSelectColumn($alias . '.actual_activity');
            $criteria->addSelectColumn($alias . '.planned_patch');
            $criteria->addSelectColumn($alias . '.covered_patch');
            $criteria->addSelectColumn($alias . '.plannedtown');
            $criteria->addSelectColumn($alias . '.coveredtown');
            $criteria->addSelectColumn($alias . '.totalcalls_made');
            $criteria->addSelectColumn($alias . '.doctor_planned');
            $criteria->addSelectColumn($alias . '.doctor_covered');
            $criteria->addSelectColumn($alias . '.retailer_planned');
            $criteria->addSelectColumn($alias . '.retailer_covered');
            $criteria->addSelectColumn($alias . '.stokiest_planned');
            $criteria->addSelectColumn($alias . '.stokiest_covered');
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
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_BU);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_LEVEL3);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_LEVEL2);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_LEVEL1);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_LOCATION);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_REPNAME);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_DATE);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_PLANNED_PATCH);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_COVERED_PATCH);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_PLANNEDTOWN);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_COVEREDTOWN);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_TOTALCALLS_MADE);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_DOCTOR_PLANNED);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_DOCTOR_COVERED);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_RETAILER_PLANNED);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_RETAILER_COVERED);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_STOKIEST_PLANNED);
            $criteria->removeSelectColumn(MtpDeviationViewTableMap::COL_STOKIEST_COVERED);
        } else {
            $criteria->removeSelectColumn($alias . '.bu');
            $criteria->removeSelectColumn($alias . '.level3');
            $criteria->removeSelectColumn($alias . '.level2');
            $criteria->removeSelectColumn($alias . '.level1');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.location');
            $criteria->removeSelectColumn($alias . '.repname');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.designation');
            $criteria->removeSelectColumn($alias . '.date');
            $criteria->removeSelectColumn($alias . '.planned_activity');
            $criteria->removeSelectColumn($alias . '.actual_activity');
            $criteria->removeSelectColumn($alias . '.planned_patch');
            $criteria->removeSelectColumn($alias . '.covered_patch');
            $criteria->removeSelectColumn($alias . '.plannedtown');
            $criteria->removeSelectColumn($alias . '.coveredtown');
            $criteria->removeSelectColumn($alias . '.totalcalls_made');
            $criteria->removeSelectColumn($alias . '.doctor_planned');
            $criteria->removeSelectColumn($alias . '.doctor_covered');
            $criteria->removeSelectColumn($alias . '.retailer_planned');
            $criteria->removeSelectColumn($alias . '.retailer_covered');
            $criteria->removeSelectColumn($alias . '.stokiest_planned');
            $criteria->removeSelectColumn($alias . '.stokiest_covered');
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
        return Propel::getServiceContainer()->getDatabaseMap(MtpDeviationViewTableMap::DATABASE_NAME)->getTable(MtpDeviationViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a MtpDeviationView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or MtpDeviationView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MtpDeviationViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\MtpDeviationView) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The MtpDeviationView object has no primary key');
        }

        $query = MtpDeviationViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MtpDeviationViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MtpDeviationViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the mtp_deviation_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MtpDeviationViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MtpDeviationView or Criteria object.
     *
     * @param mixed $criteria Criteria or MtpDeviationView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtpDeviationViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MtpDeviationView object
        }


        // Set the correct dbName
        $query = MtpDeviationViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
