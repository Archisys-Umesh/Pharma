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
use entities\Dailycalls;
use entities\DailycallsQuery;


/**
 * This class defines the structure of the 'dailycalls' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DailycallsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DailycallsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'dailycalls';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Dailycalls';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Dailycalls';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Dailycalls';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 35;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 35;

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'dailycalls.dcr_id';

    /**
     * the column name for the day_plan_id field
     */
    public const COL_DAY_PLAN_ID = 'dailycalls.day_plan_id';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'dailycalls.outlet_org_data_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'dailycalls.position_id';

    /**
     * the column name for the agendacontroltype field
     */
    public const COL_AGENDACONTROLTYPE = 'dailycalls.agendacontroltype';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'dailycalls.itownid';

    /**
     * the column name for the agenda_id field
     */
    public const COL_AGENDA_ID = 'dailycalls.agenda_id';

    /**
     * the column name for the isjw field
     */
    public const COL_ISJW = 'dailycalls.isjw';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'dailycalls.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'dailycalls.updated_at';

    /**
     * the column name for the dcr_date field
     */
    public const COL_DCR_DATE = 'dailycalls.dcr_date';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'dailycalls.company_id';

    /**
     * the column name for the managers field
     */
    public const COL_MANAGERS = 'dailycalls.managers';

    /**
     * the column name for the sgpi_out field
     */
    public const COL_SGPI_OUT = 'dailycalls.sgpi_out';

    /**
     * the column name for the outlet_feedback field
     */
    public const COL_OUTLET_FEEDBACK = 'dailycalls.outlet_feedback';

    /**
     * the column name for the employee_feedback field
     */
    public const COL_EMPLOYEE_FEEDBACK = 'dailycalls.employee_feedback';

    /**
     * the column name for the brands_detailed field
     */
    public const COL_BRANDS_DETAILED = 'dailycalls.brands_detailed';

    /**
     * the column name for the nca_comments field
     */
    public const COL_NCA_COMMENTS = 'dailycalls.nca_comments';

    /**
     * the column name for the device_time field
     */
    public const COL_DEVICE_TIME = 'dailycalls.device_time';

    /**
     * the column name for the isprocessed field
     */
    public const COL_ISPROCESSED = 'dailycalls.isprocessed';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'dailycalls.employee_id';

    /**
     * the column name for the device_make field
     */
    public const COL_DEVICE_MAKE = 'dailycalls.device_make';

    /**
     * the column name for the ed_session_id field
     */
    public const COL_ED_SESSION_ID = 'dailycalls.ed_session_id';

    /**
     * the column name for the dcr_status field
     */
    public const COL_DCR_STATUS = 'dailycalls.dcr_status';

    /**
     * the column name for the rcpa_done field
     */
    public const COL_RCPA_DONE = 'dailycalls.rcpa_done';

    /**
     * the column name for the has_sgpi field
     */
    public const COL_HAS_SGPI = 'dailycalls.has_sgpi';

    /**
     * the column name for the mr_emp field
     */
    public const COL_MR_EMP = 'dailycalls.mr_emp';

    /**
     * the column name for the mr_name field
     */
    public const COL_MR_NAME = 'dailycalls.mr_name';

    /**
     * the column name for the mr_media_id field
     */
    public const COL_MR_MEDIA_ID = 'dailycalls.mr_media_id';

    /**
     * the column name for the ed_duration field
     */
    public const COL_ED_DURATION = 'dailycalls.ed_duration';

    /**
     * the column name for the campiagn_id field
     */
    public const COL_CAMPIAGN_ID = 'dailycalls.campiagn_id';

    /**
     * the column name for the visit_plan_id field
     */
    public const COL_VISIT_PLAN_ID = 'dailycalls.visit_plan_id';

    /**
     * the column name for the nca_attendees field
     */
    public const COL_NCA_ATTENDEES = 'dailycalls.nca_attendees';

    /**
     * the column name for the dcr_lat_long field
     */
    public const COL_DCR_LAT_LONG = 'dailycalls.dcr_lat_long';

    /**
     * the column name for the dcr_address field
     */
    public const COL_DCR_ADDRESS = 'dailycalls.dcr_address';

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
        self::TYPE_PHPNAME       => ['DcrId', 'DayPlanId', 'OutletOrgDataId', 'PositionId', 'Agendacontroltype', 'Itownid', 'AgendaId', 'Isjw', 'CreatedAt', 'UpdatedAt', 'DcrDate', 'CompanyId', 'Managers', 'SgpiOut', 'OutletFeedback', 'EmployeeFeedback', 'BrandsDetailed', 'NcaComments', 'DeviceTime', 'Isprocessed', 'EmployeeId', 'DeviceMake', 'EdSessionId', 'DcrStatus', 'RcpaDone', 'HasSgpi', 'MrEmp', 'MrName', 'MrMediaId', 'EdDuration', 'CampiagnId', 'VisitPlanId', 'NcaAttendees', 'DcrLatLong', 'DcrAddress', ],
        self::TYPE_CAMELNAME     => ['dcrId', 'dayPlanId', 'outletOrgDataId', 'positionId', 'agendacontroltype', 'itownid', 'agendaId', 'isjw', 'createdAt', 'updatedAt', 'dcrDate', 'companyId', 'managers', 'sgpiOut', 'outletFeedback', 'employeeFeedback', 'brandsDetailed', 'ncaComments', 'deviceTime', 'isprocessed', 'employeeId', 'deviceMake', 'edSessionId', 'dcrStatus', 'rcpaDone', 'hasSgpi', 'mrEmp', 'mrName', 'mrMediaId', 'edDuration', 'campiagnId', 'visitPlanId', 'ncaAttendees', 'dcrLatLong', 'dcrAddress', ],
        self::TYPE_COLNAME       => [DailycallsTableMap::COL_DCR_ID, DailycallsTableMap::COL_DAY_PLAN_ID, DailycallsTableMap::COL_OUTLET_ORG_DATA_ID, DailycallsTableMap::COL_POSITION_ID, DailycallsTableMap::COL_AGENDACONTROLTYPE, DailycallsTableMap::COL_ITOWNID, DailycallsTableMap::COL_AGENDA_ID, DailycallsTableMap::COL_ISJW, DailycallsTableMap::COL_CREATED_AT, DailycallsTableMap::COL_UPDATED_AT, DailycallsTableMap::COL_DCR_DATE, DailycallsTableMap::COL_COMPANY_ID, DailycallsTableMap::COL_MANAGERS, DailycallsTableMap::COL_SGPI_OUT, DailycallsTableMap::COL_OUTLET_FEEDBACK, DailycallsTableMap::COL_EMPLOYEE_FEEDBACK, DailycallsTableMap::COL_BRANDS_DETAILED, DailycallsTableMap::COL_NCA_COMMENTS, DailycallsTableMap::COL_DEVICE_TIME, DailycallsTableMap::COL_ISPROCESSED, DailycallsTableMap::COL_EMPLOYEE_ID, DailycallsTableMap::COL_DEVICE_MAKE, DailycallsTableMap::COL_ED_SESSION_ID, DailycallsTableMap::COL_DCR_STATUS, DailycallsTableMap::COL_RCPA_DONE, DailycallsTableMap::COL_HAS_SGPI, DailycallsTableMap::COL_MR_EMP, DailycallsTableMap::COL_MR_NAME, DailycallsTableMap::COL_MR_MEDIA_ID, DailycallsTableMap::COL_ED_DURATION, DailycallsTableMap::COL_CAMPIAGN_ID, DailycallsTableMap::COL_VISIT_PLAN_ID, DailycallsTableMap::COL_NCA_ATTENDEES, DailycallsTableMap::COL_DCR_LAT_LONG, DailycallsTableMap::COL_DCR_ADDRESS, ],
        self::TYPE_FIELDNAME     => ['dcr_id', 'day_plan_id', 'outlet_org_data_id', 'position_id', 'agendacontroltype', 'itownid', 'agenda_id', 'isjw', 'created_at', 'updated_at', 'dcr_date', 'company_id', 'managers', 'sgpi_out', 'outlet_feedback', 'employee_feedback', 'brands_detailed', 'nca_comments', 'device_time', 'isprocessed', 'employee_id', 'device_make', 'ed_session_id', 'dcr_status', 'rcpa_done', 'has_sgpi', 'mr_emp', 'mr_name', 'mr_media_id', 'ed_duration', 'campiagn_id', 'visit_plan_id', 'nca_attendees', 'dcr_lat_long', 'dcr_address', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, ]
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
        self::TYPE_PHPNAME       => ['DcrId' => 0, 'DayPlanId' => 1, 'OutletOrgDataId' => 2, 'PositionId' => 3, 'Agendacontroltype' => 4, 'Itownid' => 5, 'AgendaId' => 6, 'Isjw' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'DcrDate' => 10, 'CompanyId' => 11, 'Managers' => 12, 'SgpiOut' => 13, 'OutletFeedback' => 14, 'EmployeeFeedback' => 15, 'BrandsDetailed' => 16, 'NcaComments' => 17, 'DeviceTime' => 18, 'Isprocessed' => 19, 'EmployeeId' => 20, 'DeviceMake' => 21, 'EdSessionId' => 22, 'DcrStatus' => 23, 'RcpaDone' => 24, 'HasSgpi' => 25, 'MrEmp' => 26, 'MrName' => 27, 'MrMediaId' => 28, 'EdDuration' => 29, 'CampiagnId' => 30, 'VisitPlanId' => 31, 'NcaAttendees' => 32, 'DcrLatLong' => 33, 'DcrAddress' => 34, ],
        self::TYPE_CAMELNAME     => ['dcrId' => 0, 'dayPlanId' => 1, 'outletOrgDataId' => 2, 'positionId' => 3, 'agendacontroltype' => 4, 'itownid' => 5, 'agendaId' => 6, 'isjw' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'dcrDate' => 10, 'companyId' => 11, 'managers' => 12, 'sgpiOut' => 13, 'outletFeedback' => 14, 'employeeFeedback' => 15, 'brandsDetailed' => 16, 'ncaComments' => 17, 'deviceTime' => 18, 'isprocessed' => 19, 'employeeId' => 20, 'deviceMake' => 21, 'edSessionId' => 22, 'dcrStatus' => 23, 'rcpaDone' => 24, 'hasSgpi' => 25, 'mrEmp' => 26, 'mrName' => 27, 'mrMediaId' => 28, 'edDuration' => 29, 'campiagnId' => 30, 'visitPlanId' => 31, 'ncaAttendees' => 32, 'dcrLatLong' => 33, 'dcrAddress' => 34, ],
        self::TYPE_COLNAME       => [DailycallsTableMap::COL_DCR_ID => 0, DailycallsTableMap::COL_DAY_PLAN_ID => 1, DailycallsTableMap::COL_OUTLET_ORG_DATA_ID => 2, DailycallsTableMap::COL_POSITION_ID => 3, DailycallsTableMap::COL_AGENDACONTROLTYPE => 4, DailycallsTableMap::COL_ITOWNID => 5, DailycallsTableMap::COL_AGENDA_ID => 6, DailycallsTableMap::COL_ISJW => 7, DailycallsTableMap::COL_CREATED_AT => 8, DailycallsTableMap::COL_UPDATED_AT => 9, DailycallsTableMap::COL_DCR_DATE => 10, DailycallsTableMap::COL_COMPANY_ID => 11, DailycallsTableMap::COL_MANAGERS => 12, DailycallsTableMap::COL_SGPI_OUT => 13, DailycallsTableMap::COL_OUTLET_FEEDBACK => 14, DailycallsTableMap::COL_EMPLOYEE_FEEDBACK => 15, DailycallsTableMap::COL_BRANDS_DETAILED => 16, DailycallsTableMap::COL_NCA_COMMENTS => 17, DailycallsTableMap::COL_DEVICE_TIME => 18, DailycallsTableMap::COL_ISPROCESSED => 19, DailycallsTableMap::COL_EMPLOYEE_ID => 20, DailycallsTableMap::COL_DEVICE_MAKE => 21, DailycallsTableMap::COL_ED_SESSION_ID => 22, DailycallsTableMap::COL_DCR_STATUS => 23, DailycallsTableMap::COL_RCPA_DONE => 24, DailycallsTableMap::COL_HAS_SGPI => 25, DailycallsTableMap::COL_MR_EMP => 26, DailycallsTableMap::COL_MR_NAME => 27, DailycallsTableMap::COL_MR_MEDIA_ID => 28, DailycallsTableMap::COL_ED_DURATION => 29, DailycallsTableMap::COL_CAMPIAGN_ID => 30, DailycallsTableMap::COL_VISIT_PLAN_ID => 31, DailycallsTableMap::COL_NCA_ATTENDEES => 32, DailycallsTableMap::COL_DCR_LAT_LONG => 33, DailycallsTableMap::COL_DCR_ADDRESS => 34, ],
        self::TYPE_FIELDNAME     => ['dcr_id' => 0, 'day_plan_id' => 1, 'outlet_org_data_id' => 2, 'position_id' => 3, 'agendacontroltype' => 4, 'itownid' => 5, 'agenda_id' => 6, 'isjw' => 7, 'created_at' => 8, 'updated_at' => 9, 'dcr_date' => 10, 'company_id' => 11, 'managers' => 12, 'sgpi_out' => 13, 'outlet_feedback' => 14, 'employee_feedback' => 15, 'brands_detailed' => 16, 'nca_comments' => 17, 'device_time' => 18, 'isprocessed' => 19, 'employee_id' => 20, 'device_make' => 21, 'ed_session_id' => 22, 'dcr_status' => 23, 'rcpa_done' => 24, 'has_sgpi' => 25, 'mr_emp' => 26, 'mr_name' => 27, 'mr_media_id' => 28, 'ed_duration' => 29, 'campiagn_id' => 30, 'visit_plan_id' => 31, 'nca_attendees' => 32, 'dcr_lat_long' => 33, 'dcr_address' => 34, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DcrId' => 'DCR_ID',
        'Dailycalls.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'dailycalls.dcrId' => 'DCR_ID',
        'DailycallsTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'dailycalls.dcr_id' => 'DCR_ID',
        'DayPlanId' => 'DAY_PLAN_ID',
        'Dailycalls.DayPlanId' => 'DAY_PLAN_ID',
        'dayPlanId' => 'DAY_PLAN_ID',
        'dailycalls.dayPlanId' => 'DAY_PLAN_ID',
        'DailycallsTableMap::COL_DAY_PLAN_ID' => 'DAY_PLAN_ID',
        'COL_DAY_PLAN_ID' => 'DAY_PLAN_ID',
        'day_plan_id' => 'DAY_PLAN_ID',
        'dailycalls.day_plan_id' => 'DAY_PLAN_ID',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'Dailycalls.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'dailycalls.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'DailycallsTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'dailycalls.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'PositionId' => 'POSITION_ID',
        'Dailycalls.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'dailycalls.positionId' => 'POSITION_ID',
        'DailycallsTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'dailycalls.position_id' => 'POSITION_ID',
        'Agendacontroltype' => 'AGENDACONTROLTYPE',
        'Dailycalls.Agendacontroltype' => 'AGENDACONTROLTYPE',
        'agendacontroltype' => 'AGENDACONTROLTYPE',
        'dailycalls.agendacontroltype' => 'AGENDACONTROLTYPE',
        'DailycallsTableMap::COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'Itownid' => 'ITOWNID',
        'Dailycalls.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'dailycalls.itownid' => 'ITOWNID',
        'DailycallsTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'AgendaId' => 'AGENDA_ID',
        'Dailycalls.AgendaId' => 'AGENDA_ID',
        'agendaId' => 'AGENDA_ID',
        'dailycalls.agendaId' => 'AGENDA_ID',
        'DailycallsTableMap::COL_AGENDA_ID' => 'AGENDA_ID',
        'COL_AGENDA_ID' => 'AGENDA_ID',
        'agenda_id' => 'AGENDA_ID',
        'dailycalls.agenda_id' => 'AGENDA_ID',
        'Isjw' => 'ISJW',
        'Dailycalls.Isjw' => 'ISJW',
        'isjw' => 'ISJW',
        'dailycalls.isjw' => 'ISJW',
        'DailycallsTableMap::COL_ISJW' => 'ISJW',
        'COL_ISJW' => 'ISJW',
        'CreatedAt' => 'CREATED_AT',
        'Dailycalls.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dailycalls.createdAt' => 'CREATED_AT',
        'DailycallsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'dailycalls.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Dailycalls.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'dailycalls.updatedAt' => 'UPDATED_AT',
        'DailycallsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'dailycalls.updated_at' => 'UPDATED_AT',
        'DcrDate' => 'DCR_DATE',
        'Dailycalls.DcrDate' => 'DCR_DATE',
        'dcrDate' => 'DCR_DATE',
        'dailycalls.dcrDate' => 'DCR_DATE',
        'DailycallsTableMap::COL_DCR_DATE' => 'DCR_DATE',
        'COL_DCR_DATE' => 'DCR_DATE',
        'dcr_date' => 'DCR_DATE',
        'dailycalls.dcr_date' => 'DCR_DATE',
        'CompanyId' => 'COMPANY_ID',
        'Dailycalls.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'dailycalls.companyId' => 'COMPANY_ID',
        'DailycallsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'dailycalls.company_id' => 'COMPANY_ID',
        'Managers' => 'MANAGERS',
        'Dailycalls.Managers' => 'MANAGERS',
        'managers' => 'MANAGERS',
        'dailycalls.managers' => 'MANAGERS',
        'DailycallsTableMap::COL_MANAGERS' => 'MANAGERS',
        'COL_MANAGERS' => 'MANAGERS',
        'SgpiOut' => 'SGPI_OUT',
        'Dailycalls.SgpiOut' => 'SGPI_OUT',
        'sgpiOut' => 'SGPI_OUT',
        'dailycalls.sgpiOut' => 'SGPI_OUT',
        'DailycallsTableMap::COL_SGPI_OUT' => 'SGPI_OUT',
        'COL_SGPI_OUT' => 'SGPI_OUT',
        'sgpi_out' => 'SGPI_OUT',
        'dailycalls.sgpi_out' => 'SGPI_OUT',
        'OutletFeedback' => 'OUTLET_FEEDBACK',
        'Dailycalls.OutletFeedback' => 'OUTLET_FEEDBACK',
        'outletFeedback' => 'OUTLET_FEEDBACK',
        'dailycalls.outletFeedback' => 'OUTLET_FEEDBACK',
        'DailycallsTableMap::COL_OUTLET_FEEDBACK' => 'OUTLET_FEEDBACK',
        'COL_OUTLET_FEEDBACK' => 'OUTLET_FEEDBACK',
        'outlet_feedback' => 'OUTLET_FEEDBACK',
        'dailycalls.outlet_feedback' => 'OUTLET_FEEDBACK',
        'EmployeeFeedback' => 'EMPLOYEE_FEEDBACK',
        'Dailycalls.EmployeeFeedback' => 'EMPLOYEE_FEEDBACK',
        'employeeFeedback' => 'EMPLOYEE_FEEDBACK',
        'dailycalls.employeeFeedback' => 'EMPLOYEE_FEEDBACK',
        'DailycallsTableMap::COL_EMPLOYEE_FEEDBACK' => 'EMPLOYEE_FEEDBACK',
        'COL_EMPLOYEE_FEEDBACK' => 'EMPLOYEE_FEEDBACK',
        'employee_feedback' => 'EMPLOYEE_FEEDBACK',
        'dailycalls.employee_feedback' => 'EMPLOYEE_FEEDBACK',
        'BrandsDetailed' => 'BRANDS_DETAILED',
        'Dailycalls.BrandsDetailed' => 'BRANDS_DETAILED',
        'brandsDetailed' => 'BRANDS_DETAILED',
        'dailycalls.brandsDetailed' => 'BRANDS_DETAILED',
        'DailycallsTableMap::COL_BRANDS_DETAILED' => 'BRANDS_DETAILED',
        'COL_BRANDS_DETAILED' => 'BRANDS_DETAILED',
        'brands_detailed' => 'BRANDS_DETAILED',
        'dailycalls.brands_detailed' => 'BRANDS_DETAILED',
        'NcaComments' => 'NCA_COMMENTS',
        'Dailycalls.NcaComments' => 'NCA_COMMENTS',
        'ncaComments' => 'NCA_COMMENTS',
        'dailycalls.ncaComments' => 'NCA_COMMENTS',
        'DailycallsTableMap::COL_NCA_COMMENTS' => 'NCA_COMMENTS',
        'COL_NCA_COMMENTS' => 'NCA_COMMENTS',
        'nca_comments' => 'NCA_COMMENTS',
        'dailycalls.nca_comments' => 'NCA_COMMENTS',
        'DeviceTime' => 'DEVICE_TIME',
        'Dailycalls.DeviceTime' => 'DEVICE_TIME',
        'deviceTime' => 'DEVICE_TIME',
        'dailycalls.deviceTime' => 'DEVICE_TIME',
        'DailycallsTableMap::COL_DEVICE_TIME' => 'DEVICE_TIME',
        'COL_DEVICE_TIME' => 'DEVICE_TIME',
        'device_time' => 'DEVICE_TIME',
        'dailycalls.device_time' => 'DEVICE_TIME',
        'Isprocessed' => 'ISPROCESSED',
        'Dailycalls.Isprocessed' => 'ISPROCESSED',
        'isprocessed' => 'ISPROCESSED',
        'dailycalls.isprocessed' => 'ISPROCESSED',
        'DailycallsTableMap::COL_ISPROCESSED' => 'ISPROCESSED',
        'COL_ISPROCESSED' => 'ISPROCESSED',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Dailycalls.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'dailycalls.employeeId' => 'EMPLOYEE_ID',
        'DailycallsTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'dailycalls.employee_id' => 'EMPLOYEE_ID',
        'DeviceMake' => 'DEVICE_MAKE',
        'Dailycalls.DeviceMake' => 'DEVICE_MAKE',
        'deviceMake' => 'DEVICE_MAKE',
        'dailycalls.deviceMake' => 'DEVICE_MAKE',
        'DailycallsTableMap::COL_DEVICE_MAKE' => 'DEVICE_MAKE',
        'COL_DEVICE_MAKE' => 'DEVICE_MAKE',
        'device_make' => 'DEVICE_MAKE',
        'dailycalls.device_make' => 'DEVICE_MAKE',
        'EdSessionId' => 'ED_SESSION_ID',
        'Dailycalls.EdSessionId' => 'ED_SESSION_ID',
        'edSessionId' => 'ED_SESSION_ID',
        'dailycalls.edSessionId' => 'ED_SESSION_ID',
        'DailycallsTableMap::COL_ED_SESSION_ID' => 'ED_SESSION_ID',
        'COL_ED_SESSION_ID' => 'ED_SESSION_ID',
        'ed_session_id' => 'ED_SESSION_ID',
        'dailycalls.ed_session_id' => 'ED_SESSION_ID',
        'DcrStatus' => 'DCR_STATUS',
        'Dailycalls.DcrStatus' => 'DCR_STATUS',
        'dcrStatus' => 'DCR_STATUS',
        'dailycalls.dcrStatus' => 'DCR_STATUS',
        'DailycallsTableMap::COL_DCR_STATUS' => 'DCR_STATUS',
        'COL_DCR_STATUS' => 'DCR_STATUS',
        'dcr_status' => 'DCR_STATUS',
        'dailycalls.dcr_status' => 'DCR_STATUS',
        'RcpaDone' => 'RCPA_DONE',
        'Dailycalls.RcpaDone' => 'RCPA_DONE',
        'rcpaDone' => 'RCPA_DONE',
        'dailycalls.rcpaDone' => 'RCPA_DONE',
        'DailycallsTableMap::COL_RCPA_DONE' => 'RCPA_DONE',
        'COL_RCPA_DONE' => 'RCPA_DONE',
        'rcpa_done' => 'RCPA_DONE',
        'dailycalls.rcpa_done' => 'RCPA_DONE',
        'HasSgpi' => 'HAS_SGPI',
        'Dailycalls.HasSgpi' => 'HAS_SGPI',
        'hasSgpi' => 'HAS_SGPI',
        'dailycalls.hasSgpi' => 'HAS_SGPI',
        'DailycallsTableMap::COL_HAS_SGPI' => 'HAS_SGPI',
        'COL_HAS_SGPI' => 'HAS_SGPI',
        'has_sgpi' => 'HAS_SGPI',
        'dailycalls.has_sgpi' => 'HAS_SGPI',
        'MrEmp' => 'MR_EMP',
        'Dailycalls.MrEmp' => 'MR_EMP',
        'mrEmp' => 'MR_EMP',
        'dailycalls.mrEmp' => 'MR_EMP',
        'DailycallsTableMap::COL_MR_EMP' => 'MR_EMP',
        'COL_MR_EMP' => 'MR_EMP',
        'mr_emp' => 'MR_EMP',
        'dailycalls.mr_emp' => 'MR_EMP',
        'MrName' => 'MR_NAME',
        'Dailycalls.MrName' => 'MR_NAME',
        'mrName' => 'MR_NAME',
        'dailycalls.mrName' => 'MR_NAME',
        'DailycallsTableMap::COL_MR_NAME' => 'MR_NAME',
        'COL_MR_NAME' => 'MR_NAME',
        'mr_name' => 'MR_NAME',
        'dailycalls.mr_name' => 'MR_NAME',
        'MrMediaId' => 'MR_MEDIA_ID',
        'Dailycalls.MrMediaId' => 'MR_MEDIA_ID',
        'mrMediaId' => 'MR_MEDIA_ID',
        'dailycalls.mrMediaId' => 'MR_MEDIA_ID',
        'DailycallsTableMap::COL_MR_MEDIA_ID' => 'MR_MEDIA_ID',
        'COL_MR_MEDIA_ID' => 'MR_MEDIA_ID',
        'mr_media_id' => 'MR_MEDIA_ID',
        'dailycalls.mr_media_id' => 'MR_MEDIA_ID',
        'EdDuration' => 'ED_DURATION',
        'Dailycalls.EdDuration' => 'ED_DURATION',
        'edDuration' => 'ED_DURATION',
        'dailycalls.edDuration' => 'ED_DURATION',
        'DailycallsTableMap::COL_ED_DURATION' => 'ED_DURATION',
        'COL_ED_DURATION' => 'ED_DURATION',
        'ed_duration' => 'ED_DURATION',
        'dailycalls.ed_duration' => 'ED_DURATION',
        'CampiagnId' => 'CAMPIAGN_ID',
        'Dailycalls.CampiagnId' => 'CAMPIAGN_ID',
        'campiagnId' => 'CAMPIAGN_ID',
        'dailycalls.campiagnId' => 'CAMPIAGN_ID',
        'DailycallsTableMap::COL_CAMPIAGN_ID' => 'CAMPIAGN_ID',
        'COL_CAMPIAGN_ID' => 'CAMPIAGN_ID',
        'campiagn_id' => 'CAMPIAGN_ID',
        'dailycalls.campiagn_id' => 'CAMPIAGN_ID',
        'VisitPlanId' => 'VISIT_PLAN_ID',
        'Dailycalls.VisitPlanId' => 'VISIT_PLAN_ID',
        'visitPlanId' => 'VISIT_PLAN_ID',
        'dailycalls.visitPlanId' => 'VISIT_PLAN_ID',
        'DailycallsTableMap::COL_VISIT_PLAN_ID' => 'VISIT_PLAN_ID',
        'COL_VISIT_PLAN_ID' => 'VISIT_PLAN_ID',
        'visit_plan_id' => 'VISIT_PLAN_ID',
        'dailycalls.visit_plan_id' => 'VISIT_PLAN_ID',
        'NcaAttendees' => 'NCA_ATTENDEES',
        'Dailycalls.NcaAttendees' => 'NCA_ATTENDEES',
        'ncaAttendees' => 'NCA_ATTENDEES',
        'dailycalls.ncaAttendees' => 'NCA_ATTENDEES',
        'DailycallsTableMap::COL_NCA_ATTENDEES' => 'NCA_ATTENDEES',
        'COL_NCA_ATTENDEES' => 'NCA_ATTENDEES',
        'nca_attendees' => 'NCA_ATTENDEES',
        'dailycalls.nca_attendees' => 'NCA_ATTENDEES',
        'DcrLatLong' => 'DCR_LAT_LONG',
        'Dailycalls.DcrLatLong' => 'DCR_LAT_LONG',
        'dcrLatLong' => 'DCR_LAT_LONG',
        'dailycalls.dcrLatLong' => 'DCR_LAT_LONG',
        'DailycallsTableMap::COL_DCR_LAT_LONG' => 'DCR_LAT_LONG',
        'COL_DCR_LAT_LONG' => 'DCR_LAT_LONG',
        'dcr_lat_long' => 'DCR_LAT_LONG',
        'dailycalls.dcr_lat_long' => 'DCR_LAT_LONG',
        'DcrAddress' => 'DCR_ADDRESS',
        'Dailycalls.DcrAddress' => 'DCR_ADDRESS',
        'dcrAddress' => 'DCR_ADDRESS',
        'dailycalls.dcrAddress' => 'DCR_ADDRESS',
        'DailycallsTableMap::COL_DCR_ADDRESS' => 'DCR_ADDRESS',
        'COL_DCR_ADDRESS' => 'DCR_ADDRESS',
        'dcr_address' => 'DCR_ADDRESS',
        'dailycalls.dcr_address' => 'DCR_ADDRESS',
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
        $this->setName('dailycalls');
        $this->setPhpName('Dailycalls');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Dailycalls');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('dailycalls_dcr_id_seq');
        // columns
        $this->addPrimaryKey('dcr_id', 'DcrId', 'INTEGER', true, null, null);
        $this->addColumn('day_plan_id', 'DayPlanId', 'INTEGER', false, null, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('agendacontroltype', 'Agendacontroltype', 'VARCHAR', false, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'BIGINT', 'geo_towns', 'itownid', false, null, null);
        $this->addForeignKey('agenda_id', 'AgendaId', 'INTEGER', 'agendatypes', 'agendaid', false, null, null);
        $this->addColumn('isjw', 'Isjw', 'BOOLEAN', true, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('dcr_date', 'DcrDate', 'DATE', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('managers', 'Managers', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_out', 'SgpiOut', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_feedback', 'OutletFeedback', 'VARCHAR', false, null, null);
        $this->addColumn('employee_feedback', 'EmployeeFeedback', 'VARCHAR', false, null, null);
        $this->addColumn('brands_detailed', 'BrandsDetailed', 'VARCHAR', false, null, null);
        $this->addColumn('nca_comments', 'NcaComments', 'VARCHAR', false, null, null);
        $this->addColumn('device_time', 'DeviceTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('isprocessed', 'Isprocessed', 'BOOLEAN', false, 1, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('device_make', 'DeviceMake', 'VARCHAR', false, null, null);
        $this->addColumn('ed_session_id', 'EdSessionId', 'VARCHAR', false, null, null);
        $this->addColumn('dcr_status', 'DcrStatus', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_done', 'RcpaDone', 'INTEGER', false, null, null);
        $this->addColumn('has_sgpi', 'HasSgpi', 'INTEGER', false, null, null);
        $this->addColumn('mr_emp', 'MrEmp', 'INTEGER', false, null, null);
        $this->addColumn('mr_name', 'MrName', 'VARCHAR', false, null, null);
        $this->addColumn('mr_media_id', 'MrMediaId', 'INTEGER', false, null, null);
        $this->addColumn('ed_duration', 'EdDuration', 'INTEGER', false, null, null);
        $this->addColumn('campiagn_id', 'CampiagnId', 'VARCHAR', false, null, null);
        $this->addColumn('visit_plan_id', 'VisitPlanId', 'VARCHAR', false, null, null);
        $this->addColumn('nca_attendees', 'NcaAttendees', 'JSON', false, null, null);
        $this->addColumn('dcr_lat_long', 'DcrLatLong', 'VARCHAR', false, null, null);
        $this->addColumn('dcr_address', 'DcrAddress', 'VARCHAR', false, null, null);
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
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Agendatypes', '\\entities\\Agendatypes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':agenda_id',
    1 => ':agendaid',
  ),
), null, null, null, false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnVisits', '\\entities\\BrandCampiagnVisits', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':dcr_id',
    1 => ':dcr_id',
  ),
), null, null, 'BrandCampiagnVisitss', false);
        $this->addRelation('DailycallsAttendees', '\\entities\\DailycallsAttendees', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':dcr_id',
    1 => ':dcr_id',
  ),
), null, null, 'DailycallsAttendeess', false);
        $this->addRelation('SurveySubmited', '\\entities\\SurveySubmited', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':dcr_id',
    1 => ':dcr_id',
  ),
), null, null, 'SurveySubmiteds', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DailycallsTableMap::CLASS_DEFAULT : DailycallsTableMap::OM_CLASS;
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
     * @return array (Dailycalls object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DailycallsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DailycallsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DailycallsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DailycallsTableMap::OM_CLASS;
            /** @var Dailycalls $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DailycallsTableMap::addInstanceToPool($obj, $key);
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
            $key = DailycallsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DailycallsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Dailycalls $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DailycallsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DailycallsTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_DAY_PLAN_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_AGENDACONTROLTYPE);
            $criteria->addSelectColumn(DailycallsTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_AGENDA_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_ISJW);
            $criteria->addSelectColumn(DailycallsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DailycallsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DailycallsTableMap::COL_DCR_DATE);
            $criteria->addSelectColumn(DailycallsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_MANAGERS);
            $criteria->addSelectColumn(DailycallsTableMap::COL_SGPI_OUT);
            $criteria->addSelectColumn(DailycallsTableMap::COL_OUTLET_FEEDBACK);
            $criteria->addSelectColumn(DailycallsTableMap::COL_EMPLOYEE_FEEDBACK);
            $criteria->addSelectColumn(DailycallsTableMap::COL_BRANDS_DETAILED);
            $criteria->addSelectColumn(DailycallsTableMap::COL_NCA_COMMENTS);
            $criteria->addSelectColumn(DailycallsTableMap::COL_DEVICE_TIME);
            $criteria->addSelectColumn(DailycallsTableMap::COL_ISPROCESSED);
            $criteria->addSelectColumn(DailycallsTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_DEVICE_MAKE);
            $criteria->addSelectColumn(DailycallsTableMap::COL_ED_SESSION_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_DCR_STATUS);
            $criteria->addSelectColumn(DailycallsTableMap::COL_RCPA_DONE);
            $criteria->addSelectColumn(DailycallsTableMap::COL_HAS_SGPI);
            $criteria->addSelectColumn(DailycallsTableMap::COL_MR_EMP);
            $criteria->addSelectColumn(DailycallsTableMap::COL_MR_NAME);
            $criteria->addSelectColumn(DailycallsTableMap::COL_MR_MEDIA_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_ED_DURATION);
            $criteria->addSelectColumn(DailycallsTableMap::COL_CAMPIAGN_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_VISIT_PLAN_ID);
            $criteria->addSelectColumn(DailycallsTableMap::COL_NCA_ATTENDEES);
            $criteria->addSelectColumn(DailycallsTableMap::COL_DCR_LAT_LONG);
            $criteria->addSelectColumn(DailycallsTableMap::COL_DCR_ADDRESS);
        } else {
            $criteria->addSelectColumn($alias . '.dcr_id');
            $criteria->addSelectColumn($alias . '.day_plan_id');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.agendacontroltype');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.agenda_id');
            $criteria->addSelectColumn($alias . '.isjw');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.dcr_date');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.managers');
            $criteria->addSelectColumn($alias . '.sgpi_out');
            $criteria->addSelectColumn($alias . '.outlet_feedback');
            $criteria->addSelectColumn($alias . '.employee_feedback');
            $criteria->addSelectColumn($alias . '.brands_detailed');
            $criteria->addSelectColumn($alias . '.nca_comments');
            $criteria->addSelectColumn($alias . '.device_time');
            $criteria->addSelectColumn($alias . '.isprocessed');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.device_make');
            $criteria->addSelectColumn($alias . '.ed_session_id');
            $criteria->addSelectColumn($alias . '.dcr_status');
            $criteria->addSelectColumn($alias . '.rcpa_done');
            $criteria->addSelectColumn($alias . '.has_sgpi');
            $criteria->addSelectColumn($alias . '.mr_emp');
            $criteria->addSelectColumn($alias . '.mr_name');
            $criteria->addSelectColumn($alias . '.mr_media_id');
            $criteria->addSelectColumn($alias . '.ed_duration');
            $criteria->addSelectColumn($alias . '.campiagn_id');
            $criteria->addSelectColumn($alias . '.visit_plan_id');
            $criteria->addSelectColumn($alias . '.nca_attendees');
            $criteria->addSelectColumn($alias . '.dcr_lat_long');
            $criteria->addSelectColumn($alias . '.dcr_address');
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
            $criteria->removeSelectColumn(DailycallsTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_DAY_PLAN_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_AGENDACONTROLTYPE);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_AGENDA_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_ISJW);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_DCR_DATE);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_MANAGERS);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_SGPI_OUT);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_OUTLET_FEEDBACK);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_EMPLOYEE_FEEDBACK);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_BRANDS_DETAILED);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_NCA_COMMENTS);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_DEVICE_TIME);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_ISPROCESSED);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_DEVICE_MAKE);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_ED_SESSION_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_DCR_STATUS);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_RCPA_DONE);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_HAS_SGPI);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_MR_EMP);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_MR_NAME);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_MR_MEDIA_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_ED_DURATION);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_CAMPIAGN_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_VISIT_PLAN_ID);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_NCA_ATTENDEES);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_DCR_LAT_LONG);
            $criteria->removeSelectColumn(DailycallsTableMap::COL_DCR_ADDRESS);
        } else {
            $criteria->removeSelectColumn($alias . '.dcr_id');
            $criteria->removeSelectColumn($alias . '.day_plan_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.agendacontroltype');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.agenda_id');
            $criteria->removeSelectColumn($alias . '.isjw');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.dcr_date');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.managers');
            $criteria->removeSelectColumn($alias . '.sgpi_out');
            $criteria->removeSelectColumn($alias . '.outlet_feedback');
            $criteria->removeSelectColumn($alias . '.employee_feedback');
            $criteria->removeSelectColumn($alias . '.brands_detailed');
            $criteria->removeSelectColumn($alias . '.nca_comments');
            $criteria->removeSelectColumn($alias . '.device_time');
            $criteria->removeSelectColumn($alias . '.isprocessed');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.device_make');
            $criteria->removeSelectColumn($alias . '.ed_session_id');
            $criteria->removeSelectColumn($alias . '.dcr_status');
            $criteria->removeSelectColumn($alias . '.rcpa_done');
            $criteria->removeSelectColumn($alias . '.has_sgpi');
            $criteria->removeSelectColumn($alias . '.mr_emp');
            $criteria->removeSelectColumn($alias . '.mr_name');
            $criteria->removeSelectColumn($alias . '.mr_media_id');
            $criteria->removeSelectColumn($alias . '.ed_duration');
            $criteria->removeSelectColumn($alias . '.campiagn_id');
            $criteria->removeSelectColumn($alias . '.visit_plan_id');
            $criteria->removeSelectColumn($alias . '.nca_attendees');
            $criteria->removeSelectColumn($alias . '.dcr_lat_long');
            $criteria->removeSelectColumn($alias . '.dcr_address');
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
        return Propel::getServiceContainer()->getDatabaseMap(DailycallsTableMap::DATABASE_NAME)->getTable(DailycallsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Dailycalls or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Dailycalls object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Dailycalls) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DailycallsTableMap::DATABASE_NAME);
            $criteria->add(DailycallsTableMap::COL_DCR_ID, (array) $values, Criteria::IN);
        }

        $query = DailycallsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DailycallsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DailycallsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the dailycalls table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DailycallsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Dailycalls or Criteria object.
     *
     * @param mixed $criteria Criteria or Dailycalls object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Dailycalls object
        }

        if ($criteria->containsKey(DailycallsTableMap::COL_DCR_ID) && $criteria->keyContainsValue(DailycallsTableMap::COL_DCR_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DailycallsTableMap::COL_DCR_ID.')');
        }


        // Set the correct dbName
        $query = DailycallsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
