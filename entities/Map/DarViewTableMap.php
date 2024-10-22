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
use entities\DarView;
use entities\DarViewQuery;


/**
 * This class defines the structure of the 'dar_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DarViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DarViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'dar_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'DarView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\DarView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.DarView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 32;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 32;

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'dar_view.dcr_id';

    /**
     * the column name for the agendacontroltype field
     */
    public const COL_AGENDACONTROLTYPE = 'dar_view.agendacontroltype';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'dar_view.employee_code';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'dar_view.first_name';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'dar_view.outlet_name';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'dar_view.outlet_id';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'dar_view.outlet_code';

    /**
     * the column name for the agendname field
     */
    public const COL_AGENDNAME = 'dar_view.agendname';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'dar_view.position_id';

    /**
     * the column name for the position_name field
     */
    public const COL_POSITION_NAME = 'dar_view.position_name';

    /**
     * the column name for the stownname field
     */
    public const COL_STOWNNAME = 'dar_view.stownname';

    /**
     * the column name for the dcr_date field
     */
    public const COL_DCR_DATE = 'dar_view.dcr_date';

    /**
     * the column name for the dcr_status field
     */
    public const COL_DCR_STATUS = 'dar_view.dcr_status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'dar_view.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'dar_view.updated_at';

    /**
     * the column name for the planned field
     */
    public const COL_PLANNED = 'dar_view.planned';

    /**
     * the column name for the unit_name field
     */
    public const COL_UNIT_NAME = 'dar_view.unit_name';

    /**
     * the column name for the datetime field
     */
    public const COL_DATETIME = 'dar_view.datetime';

    /**
     * the column name for the managers field
     */
    public const COL_MANAGERS = 'dar_view.managers';

    /**
     * the column name for the brands_detailed field
     */
    public const COL_BRANDS_DETAILED = 'dar_view.brands_detailed';

    /**
     * the column name for the sgpi_out field
     */
    public const COL_SGPI_OUT = 'dar_view.sgpi_out';

    /**
     * the column name for the pob_total field
     */
    public const COL_POB_TOTAL = 'dar_view.pob_total';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'dar_view.employee_id';

    /**
     * the column name for the ed_duration field
     */
    public const COL_ED_DURATION = 'dar_view.ed_duration';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'dar_view.territory_id';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'dar_view.outlettype_id';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'dar_view.outlettype_name';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'dar_view.beat_id';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'dar_view.beat_name';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'dar_view.tags';

    /**
     * the column name for the isjw field
     */
    public const COL_ISJW = 'dar_view.isjw';

    /**
     * the column name for the brand_campaign_name field
     */
    public const COL_BRAND_CAMPAIGN_NAME = 'dar_view.brand_campaign_name';

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
        self::TYPE_PHPNAME       => ['DcrId', 'Agendacontroltype', 'EmployeeCode', 'FirstName', 'OutletName', 'OutletId', 'OutletCode', 'Agendname', 'PositionId', 'PositionName', 'Stownname', 'DcrDate', 'DcrStatus', 'CreatedAt', 'UpdatedAt', 'Planned', 'UnitName', 'DateTime', 'Managers', 'BrandsDetailed', 'SgpiOut', 'PobTotal', 'EmployeeId', 'EdDuration', 'TerritoryId', 'OutlettypeId', 'OutlettypeName', 'BeatId', 'BeatName', 'Tags', 'Isjw', 'BrandCampaignName', ],
        self::TYPE_CAMELNAME     => ['dcrId', 'agendacontroltype', 'employeeCode', 'firstName', 'outletName', 'outletId', 'outletCode', 'agendname', 'positionId', 'positionName', 'stownname', 'dcrDate', 'dcrStatus', 'createdAt', 'updatedAt', 'planned', 'unitName', 'dateTime', 'managers', 'brandsDetailed', 'sgpiOut', 'pobTotal', 'employeeId', 'edDuration', 'territoryId', 'outlettypeId', 'outlettypeName', 'beatId', 'beatName', 'tags', 'isjw', 'brandCampaignName', ],
        self::TYPE_COLNAME       => [DarViewTableMap::COL_DCR_ID, DarViewTableMap::COL_AGENDACONTROLTYPE, DarViewTableMap::COL_EMPLOYEE_CODE, DarViewTableMap::COL_FIRST_NAME, DarViewTableMap::COL_OUTLET_NAME, DarViewTableMap::COL_OUTLET_ID, DarViewTableMap::COL_OUTLET_CODE, DarViewTableMap::COL_AGENDNAME, DarViewTableMap::COL_POSITION_ID, DarViewTableMap::COL_POSITION_NAME, DarViewTableMap::COL_STOWNNAME, DarViewTableMap::COL_DCR_DATE, DarViewTableMap::COL_DCR_STATUS, DarViewTableMap::COL_CREATED_AT, DarViewTableMap::COL_UPDATED_AT, DarViewTableMap::COL_PLANNED, DarViewTableMap::COL_UNIT_NAME, DarViewTableMap::COL_DATETIME, DarViewTableMap::COL_MANAGERS, DarViewTableMap::COL_BRANDS_DETAILED, DarViewTableMap::COL_SGPI_OUT, DarViewTableMap::COL_POB_TOTAL, DarViewTableMap::COL_EMPLOYEE_ID, DarViewTableMap::COL_ED_DURATION, DarViewTableMap::COL_TERRITORY_ID, DarViewTableMap::COL_OUTLETTYPE_ID, DarViewTableMap::COL_OUTLETTYPE_NAME, DarViewTableMap::COL_BEAT_ID, DarViewTableMap::COL_BEAT_NAME, DarViewTableMap::COL_TAGS, DarViewTableMap::COL_ISJW, DarViewTableMap::COL_BRAND_CAMPAIGN_NAME, ],
        self::TYPE_FIELDNAME     => ['dcr_id', 'agendacontroltype', 'employee_code', 'first_name', 'outlet_name', 'outlet_id', 'outlet_code', 'agendname', 'position_id', 'position_name', 'stownname', 'dcr_date', 'dcr_status', 'created_at', 'updated_at', 'planned', 'unit_name', 'datetime', 'managers', 'brands_detailed', 'sgpi_out', 'pob_total', 'employee_id', 'ed_duration', 'territory_id', 'outlettype_id', 'outlettype_name', 'beat_id', 'beat_name', 'tags', 'isjw', 'brand_campaign_name', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, ]
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
        self::TYPE_PHPNAME       => ['DcrId' => 0, 'Agendacontroltype' => 1, 'EmployeeCode' => 2, 'FirstName' => 3, 'OutletName' => 4, 'OutletId' => 5, 'OutletCode' => 6, 'Agendname' => 7, 'PositionId' => 8, 'PositionName' => 9, 'Stownname' => 10, 'DcrDate' => 11, 'DcrStatus' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, 'Planned' => 15, 'UnitName' => 16, 'DateTime' => 17, 'Managers' => 18, 'BrandsDetailed' => 19, 'SgpiOut' => 20, 'PobTotal' => 21, 'EmployeeId' => 22, 'EdDuration' => 23, 'TerritoryId' => 24, 'OutlettypeId' => 25, 'OutlettypeName' => 26, 'BeatId' => 27, 'BeatName' => 28, 'Tags' => 29, 'Isjw' => 30, 'BrandCampaignName' => 31, ],
        self::TYPE_CAMELNAME     => ['dcrId' => 0, 'agendacontroltype' => 1, 'employeeCode' => 2, 'firstName' => 3, 'outletName' => 4, 'outletId' => 5, 'outletCode' => 6, 'agendname' => 7, 'positionId' => 8, 'positionName' => 9, 'stownname' => 10, 'dcrDate' => 11, 'dcrStatus' => 12, 'createdAt' => 13, 'updatedAt' => 14, 'planned' => 15, 'unitName' => 16, 'dateTime' => 17, 'managers' => 18, 'brandsDetailed' => 19, 'sgpiOut' => 20, 'pobTotal' => 21, 'employeeId' => 22, 'edDuration' => 23, 'territoryId' => 24, 'outlettypeId' => 25, 'outlettypeName' => 26, 'beatId' => 27, 'beatName' => 28, 'tags' => 29, 'isjw' => 30, 'brandCampaignName' => 31, ],
        self::TYPE_COLNAME       => [DarViewTableMap::COL_DCR_ID => 0, DarViewTableMap::COL_AGENDACONTROLTYPE => 1, DarViewTableMap::COL_EMPLOYEE_CODE => 2, DarViewTableMap::COL_FIRST_NAME => 3, DarViewTableMap::COL_OUTLET_NAME => 4, DarViewTableMap::COL_OUTLET_ID => 5, DarViewTableMap::COL_OUTLET_CODE => 6, DarViewTableMap::COL_AGENDNAME => 7, DarViewTableMap::COL_POSITION_ID => 8, DarViewTableMap::COL_POSITION_NAME => 9, DarViewTableMap::COL_STOWNNAME => 10, DarViewTableMap::COL_DCR_DATE => 11, DarViewTableMap::COL_DCR_STATUS => 12, DarViewTableMap::COL_CREATED_AT => 13, DarViewTableMap::COL_UPDATED_AT => 14, DarViewTableMap::COL_PLANNED => 15, DarViewTableMap::COL_UNIT_NAME => 16, DarViewTableMap::COL_DATETIME => 17, DarViewTableMap::COL_MANAGERS => 18, DarViewTableMap::COL_BRANDS_DETAILED => 19, DarViewTableMap::COL_SGPI_OUT => 20, DarViewTableMap::COL_POB_TOTAL => 21, DarViewTableMap::COL_EMPLOYEE_ID => 22, DarViewTableMap::COL_ED_DURATION => 23, DarViewTableMap::COL_TERRITORY_ID => 24, DarViewTableMap::COL_OUTLETTYPE_ID => 25, DarViewTableMap::COL_OUTLETTYPE_NAME => 26, DarViewTableMap::COL_BEAT_ID => 27, DarViewTableMap::COL_BEAT_NAME => 28, DarViewTableMap::COL_TAGS => 29, DarViewTableMap::COL_ISJW => 30, DarViewTableMap::COL_BRAND_CAMPAIGN_NAME => 31, ],
        self::TYPE_FIELDNAME     => ['dcr_id' => 0, 'agendacontroltype' => 1, 'employee_code' => 2, 'first_name' => 3, 'outlet_name' => 4, 'outlet_id' => 5, 'outlet_code' => 6, 'agendname' => 7, 'position_id' => 8, 'position_name' => 9, 'stownname' => 10, 'dcr_date' => 11, 'dcr_status' => 12, 'created_at' => 13, 'updated_at' => 14, 'planned' => 15, 'unit_name' => 16, 'datetime' => 17, 'managers' => 18, 'brands_detailed' => 19, 'sgpi_out' => 20, 'pob_total' => 21, 'employee_id' => 22, 'ed_duration' => 23, 'territory_id' => 24, 'outlettype_id' => 25, 'outlettype_name' => 26, 'beat_id' => 27, 'beat_name' => 28, 'tags' => 29, 'isjw' => 30, 'brand_campaign_name' => 31, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DcrId' => 'DCR_ID',
        'DarView.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'darView.dcrId' => 'DCR_ID',
        'DarViewTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'dar_view.dcr_id' => 'DCR_ID',
        'Agendacontroltype' => 'AGENDACONTROLTYPE',
        'DarView.Agendacontroltype' => 'AGENDACONTROLTYPE',
        'agendacontroltype' => 'AGENDACONTROLTYPE',
        'darView.agendacontroltype' => 'AGENDACONTROLTYPE',
        'DarViewTableMap::COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'dar_view.agendacontroltype' => 'AGENDACONTROLTYPE',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'DarView.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'darView.employeeCode' => 'EMPLOYEE_CODE',
        'DarViewTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'dar_view.employee_code' => 'EMPLOYEE_CODE',
        'FirstName' => 'FIRST_NAME',
        'DarView.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'darView.firstName' => 'FIRST_NAME',
        'DarViewTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'dar_view.first_name' => 'FIRST_NAME',
        'OutletName' => 'OUTLET_NAME',
        'DarView.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'darView.outletName' => 'OUTLET_NAME',
        'DarViewTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'dar_view.outlet_name' => 'OUTLET_NAME',
        'OutletId' => 'OUTLET_ID',
        'DarView.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'darView.outletId' => 'OUTLET_ID',
        'DarViewTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'dar_view.outlet_id' => 'OUTLET_ID',
        'OutletCode' => 'OUTLET_CODE',
        'DarView.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'darView.outletCode' => 'OUTLET_CODE',
        'DarViewTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'dar_view.outlet_code' => 'OUTLET_CODE',
        'Agendname' => 'AGENDNAME',
        'DarView.Agendname' => 'AGENDNAME',
        'agendname' => 'AGENDNAME',
        'darView.agendname' => 'AGENDNAME',
        'DarViewTableMap::COL_AGENDNAME' => 'AGENDNAME',
        'COL_AGENDNAME' => 'AGENDNAME',
        'dar_view.agendname' => 'AGENDNAME',
        'PositionId' => 'POSITION_ID',
        'DarView.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'darView.positionId' => 'POSITION_ID',
        'DarViewTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'dar_view.position_id' => 'POSITION_ID',
        'PositionName' => 'POSITION_NAME',
        'DarView.PositionName' => 'POSITION_NAME',
        'positionName' => 'POSITION_NAME',
        'darView.positionName' => 'POSITION_NAME',
        'DarViewTableMap::COL_POSITION_NAME' => 'POSITION_NAME',
        'COL_POSITION_NAME' => 'POSITION_NAME',
        'position_name' => 'POSITION_NAME',
        'dar_view.position_name' => 'POSITION_NAME',
        'Stownname' => 'STOWNNAME',
        'DarView.Stownname' => 'STOWNNAME',
        'stownname' => 'STOWNNAME',
        'darView.stownname' => 'STOWNNAME',
        'DarViewTableMap::COL_STOWNNAME' => 'STOWNNAME',
        'COL_STOWNNAME' => 'STOWNNAME',
        'dar_view.stownname' => 'STOWNNAME',
        'DcrDate' => 'DCR_DATE',
        'DarView.DcrDate' => 'DCR_DATE',
        'dcrDate' => 'DCR_DATE',
        'darView.dcrDate' => 'DCR_DATE',
        'DarViewTableMap::COL_DCR_DATE' => 'DCR_DATE',
        'COL_DCR_DATE' => 'DCR_DATE',
        'dcr_date' => 'DCR_DATE',
        'dar_view.dcr_date' => 'DCR_DATE',
        'DcrStatus' => 'DCR_STATUS',
        'DarView.DcrStatus' => 'DCR_STATUS',
        'dcrStatus' => 'DCR_STATUS',
        'darView.dcrStatus' => 'DCR_STATUS',
        'DarViewTableMap::COL_DCR_STATUS' => 'DCR_STATUS',
        'COL_DCR_STATUS' => 'DCR_STATUS',
        'dcr_status' => 'DCR_STATUS',
        'dar_view.dcr_status' => 'DCR_STATUS',
        'CreatedAt' => 'CREATED_AT',
        'DarView.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'darView.createdAt' => 'CREATED_AT',
        'DarViewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'dar_view.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'DarView.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'darView.updatedAt' => 'UPDATED_AT',
        'DarViewTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'dar_view.updated_at' => 'UPDATED_AT',
        'Planned' => 'PLANNED',
        'DarView.Planned' => 'PLANNED',
        'planned' => 'PLANNED',
        'darView.planned' => 'PLANNED',
        'DarViewTableMap::COL_PLANNED' => 'PLANNED',
        'COL_PLANNED' => 'PLANNED',
        'dar_view.planned' => 'PLANNED',
        'UnitName' => 'UNIT_NAME',
        'DarView.UnitName' => 'UNIT_NAME',
        'unitName' => 'UNIT_NAME',
        'darView.unitName' => 'UNIT_NAME',
        'DarViewTableMap::COL_UNIT_NAME' => 'UNIT_NAME',
        'COL_UNIT_NAME' => 'UNIT_NAME',
        'unit_name' => 'UNIT_NAME',
        'dar_view.unit_name' => 'UNIT_NAME',
        'DateTime' => 'DATETIME',
        'DarView.DateTime' => 'DATETIME',
        'dateTime' => 'DATETIME',
        'darView.dateTime' => 'DATETIME',
        'DarViewTableMap::COL_DATETIME' => 'DATETIME',
        'COL_DATETIME' => 'DATETIME',
        'datetime' => 'DATETIME',
        'dar_view.datetime' => 'DATETIME',
        'Managers' => 'MANAGERS',
        'DarView.Managers' => 'MANAGERS',
        'managers' => 'MANAGERS',
        'darView.managers' => 'MANAGERS',
        'DarViewTableMap::COL_MANAGERS' => 'MANAGERS',
        'COL_MANAGERS' => 'MANAGERS',
        'dar_view.managers' => 'MANAGERS',
        'BrandsDetailed' => 'BRANDS_DETAILED',
        'DarView.BrandsDetailed' => 'BRANDS_DETAILED',
        'brandsDetailed' => 'BRANDS_DETAILED',
        'darView.brandsDetailed' => 'BRANDS_DETAILED',
        'DarViewTableMap::COL_BRANDS_DETAILED' => 'BRANDS_DETAILED',
        'COL_BRANDS_DETAILED' => 'BRANDS_DETAILED',
        'brands_detailed' => 'BRANDS_DETAILED',
        'dar_view.brands_detailed' => 'BRANDS_DETAILED',
        'SgpiOut' => 'SGPI_OUT',
        'DarView.SgpiOut' => 'SGPI_OUT',
        'sgpiOut' => 'SGPI_OUT',
        'darView.sgpiOut' => 'SGPI_OUT',
        'DarViewTableMap::COL_SGPI_OUT' => 'SGPI_OUT',
        'COL_SGPI_OUT' => 'SGPI_OUT',
        'sgpi_out' => 'SGPI_OUT',
        'dar_view.sgpi_out' => 'SGPI_OUT',
        'PobTotal' => 'POB_TOTAL',
        'DarView.PobTotal' => 'POB_TOTAL',
        'pobTotal' => 'POB_TOTAL',
        'darView.pobTotal' => 'POB_TOTAL',
        'DarViewTableMap::COL_POB_TOTAL' => 'POB_TOTAL',
        'COL_POB_TOTAL' => 'POB_TOTAL',
        'pob_total' => 'POB_TOTAL',
        'dar_view.pob_total' => 'POB_TOTAL',
        'EmployeeId' => 'EMPLOYEE_ID',
        'DarView.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'darView.employeeId' => 'EMPLOYEE_ID',
        'DarViewTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'dar_view.employee_id' => 'EMPLOYEE_ID',
        'EdDuration' => 'ED_DURATION',
        'DarView.EdDuration' => 'ED_DURATION',
        'edDuration' => 'ED_DURATION',
        'darView.edDuration' => 'ED_DURATION',
        'DarViewTableMap::COL_ED_DURATION' => 'ED_DURATION',
        'COL_ED_DURATION' => 'ED_DURATION',
        'ed_duration' => 'ED_DURATION',
        'dar_view.ed_duration' => 'ED_DURATION',
        'TerritoryId' => 'TERRITORY_ID',
        'DarView.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'darView.territoryId' => 'TERRITORY_ID',
        'DarViewTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'dar_view.territory_id' => 'TERRITORY_ID',
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'DarView.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'darView.outlettypeId' => 'OUTLETTYPE_ID',
        'DarViewTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'dar_view.outlettype_id' => 'OUTLETTYPE_ID',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'DarView.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'darView.outlettypeName' => 'OUTLETTYPE_NAME',
        'DarViewTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'dar_view.outlettype_name' => 'OUTLETTYPE_NAME',
        'BeatId' => 'BEAT_ID',
        'DarView.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'darView.beatId' => 'BEAT_ID',
        'DarViewTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'dar_view.beat_id' => 'BEAT_ID',
        'BeatName' => 'BEAT_NAME',
        'DarView.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'darView.beatName' => 'BEAT_NAME',
        'DarViewTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'dar_view.beat_name' => 'BEAT_NAME',
        'Tags' => 'TAGS',
        'DarView.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'darView.tags' => 'TAGS',
        'DarViewTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'dar_view.tags' => 'TAGS',
        'Isjw' => 'ISJW',
        'DarView.Isjw' => 'ISJW',
        'isjw' => 'ISJW',
        'darView.isjw' => 'ISJW',
        'DarViewTableMap::COL_ISJW' => 'ISJW',
        'COL_ISJW' => 'ISJW',
        'dar_view.isjw' => 'ISJW',
        'BrandCampaignName' => 'BRAND_CAMPAIGN_NAME',
        'DarView.BrandCampaignName' => 'BRAND_CAMPAIGN_NAME',
        'brandCampaignName' => 'BRAND_CAMPAIGN_NAME',
        'darView.brandCampaignName' => 'BRAND_CAMPAIGN_NAME',
        'DarViewTableMap::COL_BRAND_CAMPAIGN_NAME' => 'BRAND_CAMPAIGN_NAME',
        'COL_BRAND_CAMPAIGN_NAME' => 'BRAND_CAMPAIGN_NAME',
        'brand_campaign_name' => 'BRAND_CAMPAIGN_NAME',
        'dar_view.brand_campaign_name' => 'BRAND_CAMPAIGN_NAME',
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
        $this->setName('dar_view');
        $this->setPhpName('DarView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\DarView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('dcr_id', 'DcrId', 'INTEGER', true, null, null);
        $this->addColumn('agendacontroltype', 'Agendacontroltype', 'VARCHAR', false, 255, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, 255, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_id', 'OutletId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, 255, null);
        $this->addColumn('agendname', 'Agendname', 'VARCHAR', false, 255, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('position_name', 'PositionName', 'VARCHAR', false, 255, null);
        $this->addColumn('stownname', 'Stownname', 'VARCHAR', false, 255, null);
        $this->addColumn('dcr_date', 'DcrDate', 'VARCHAR', false, 255, null);
        $this->addColumn('dcr_status', 'DcrStatus', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('planned', 'Planned', 'VARCHAR', false, 255, null);
        $this->addColumn('unit_name', 'UnitName', 'VARCHAR', false, 255, null);
        $this->addColumn('datetime', 'DateTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('managers', 'Managers', 'VARCHAR', false, 255, null);
        $this->addColumn('brands_detailed', 'BrandsDetailed', 'VARCHAR', false, 255, null);
        $this->addColumn('sgpi_out', 'SgpiOut', 'VARCHAR', false, 255, null);
        $this->addColumn('pob_total', 'PobTotal', 'INTEGER', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('ed_duration', 'EdDuration', 'INTEGER', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_id', 'OutlettypeId', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, 255, null);
        $this->addColumn('beat_id', 'BeatId', 'INTEGER', false, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, 255, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, null, null);
        $this->addColumn('isjw', 'Isjw', 'BOOLEAN', false, 1, false);
        $this->addColumn('brand_campaign_name', 'BrandCampaignName', 'VARCHAR', false, null, null);
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
        return $withPrefix ? DarViewTableMap::CLASS_DEFAULT : DarViewTableMap::OM_CLASS;
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
     * @return array (DarView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DarViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DarViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DarViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DarViewTableMap::OM_CLASS;
            /** @var DarView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DarViewTableMap::addInstanceToPool($obj, $key);
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
            $key = DarViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DarViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DarView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DarViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DarViewTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(DarViewTableMap::COL_AGENDACONTROLTYPE);
            $criteria->addSelectColumn(DarViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(DarViewTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(DarViewTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(DarViewTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(DarViewTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(DarViewTableMap::COL_AGENDNAME);
            $criteria->addSelectColumn(DarViewTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(DarViewTableMap::COL_POSITION_NAME);
            $criteria->addSelectColumn(DarViewTableMap::COL_STOWNNAME);
            $criteria->addSelectColumn(DarViewTableMap::COL_DCR_DATE);
            $criteria->addSelectColumn(DarViewTableMap::COL_DCR_STATUS);
            $criteria->addSelectColumn(DarViewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DarViewTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DarViewTableMap::COL_PLANNED);
            $criteria->addSelectColumn(DarViewTableMap::COL_UNIT_NAME);
            $criteria->addSelectColumn(DarViewTableMap::COL_DATETIME);
            $criteria->addSelectColumn(DarViewTableMap::COL_MANAGERS);
            $criteria->addSelectColumn(DarViewTableMap::COL_BRANDS_DETAILED);
            $criteria->addSelectColumn(DarViewTableMap::COL_SGPI_OUT);
            $criteria->addSelectColumn(DarViewTableMap::COL_POB_TOTAL);
            $criteria->addSelectColumn(DarViewTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(DarViewTableMap::COL_ED_DURATION);
            $criteria->addSelectColumn(DarViewTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(DarViewTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(DarViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(DarViewTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(DarViewTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(DarViewTableMap::COL_TAGS);
            $criteria->addSelectColumn(DarViewTableMap::COL_ISJW);
            $criteria->addSelectColumn(DarViewTableMap::COL_BRAND_CAMPAIGN_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.dcr_id');
            $criteria->addSelectColumn($alias . '.agendacontroltype');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.agendname');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.position_name');
            $criteria->addSelectColumn($alias . '.stownname');
            $criteria->addSelectColumn($alias . '.dcr_date');
            $criteria->addSelectColumn($alias . '.dcr_status');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.planned');
            $criteria->addSelectColumn($alias . '.unit_name');
            $criteria->addSelectColumn($alias . '.datetime');
            $criteria->addSelectColumn($alias . '.managers');
            $criteria->addSelectColumn($alias . '.brands_detailed');
            $criteria->addSelectColumn($alias . '.sgpi_out');
            $criteria->addSelectColumn($alias . '.pob_total');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.ed_duration');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.isjw');
            $criteria->addSelectColumn($alias . '.brand_campaign_name');
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
            $criteria->removeSelectColumn(DarViewTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(DarViewTableMap::COL_AGENDACONTROLTYPE);
            $criteria->removeSelectColumn(DarViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(DarViewTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(DarViewTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(DarViewTableMap::COL_AGENDNAME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(DarViewTableMap::COL_POSITION_NAME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_STOWNNAME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_DCR_DATE);
            $criteria->removeSelectColumn(DarViewTableMap::COL_DCR_STATUS);
            $criteria->removeSelectColumn(DarViewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DarViewTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(DarViewTableMap::COL_PLANNED);
            $criteria->removeSelectColumn(DarViewTableMap::COL_UNIT_NAME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_DATETIME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_MANAGERS);
            $criteria->removeSelectColumn(DarViewTableMap::COL_BRANDS_DETAILED);
            $criteria->removeSelectColumn(DarViewTableMap::COL_SGPI_OUT);
            $criteria->removeSelectColumn(DarViewTableMap::COL_POB_TOTAL);
            $criteria->removeSelectColumn(DarViewTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(DarViewTableMap::COL_ED_DURATION);
            $criteria->removeSelectColumn(DarViewTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(DarViewTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(DarViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(DarViewTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(DarViewTableMap::COL_TAGS);
            $criteria->removeSelectColumn(DarViewTableMap::COL_ISJW);
            $criteria->removeSelectColumn(DarViewTableMap::COL_BRAND_CAMPAIGN_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.dcr_id');
            $criteria->removeSelectColumn($alias . '.agendacontroltype');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.agendname');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.position_name');
            $criteria->removeSelectColumn($alias . '.stownname');
            $criteria->removeSelectColumn($alias . '.dcr_date');
            $criteria->removeSelectColumn($alias . '.dcr_status');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.planned');
            $criteria->removeSelectColumn($alias . '.unit_name');
            $criteria->removeSelectColumn($alias . '.datetime');
            $criteria->removeSelectColumn($alias . '.managers');
            $criteria->removeSelectColumn($alias . '.brands_detailed');
            $criteria->removeSelectColumn($alias . '.sgpi_out');
            $criteria->removeSelectColumn($alias . '.pob_total');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.ed_duration');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.isjw');
            $criteria->removeSelectColumn($alias . '.brand_campaign_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(DarViewTableMap::DATABASE_NAME)->getTable(DarViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a DarView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or DarView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DarViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\DarView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DarViewTableMap::DATABASE_NAME);
            $criteria->add(DarViewTableMap::COL_DCR_ID, (array) $values, Criteria::IN);
        }

        $query = DarViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DarViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DarViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the dar_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DarViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DarView or Criteria object.
     *
     * @param mixed $criteria Criteria or DarView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DarViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DarView object
        }


        // Set the correct dbName
        $query = DarViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
