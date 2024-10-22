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
use entities\OutletVisitsView;
use entities\OutletVisitsViewQuery;


/**
 * This class defines the structure of the 'outlet_visits_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletVisitsViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletVisitsViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_visits_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletVisitsView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletVisitsView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletVisitsView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 25;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 25;

    /**
     * the column name for the unique_id field
     */
    public const COL_UNIQUE_ID = 'outlet_visits_view.unique_id';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'outlet_visits_view.moye';

    /**
     * the column name for the position_name field
     */
    public const COL_POSITION_NAME = 'outlet_visits_view.position_name';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'outlet_visits_view.position_id';

    /**
     * the column name for the cav_positions_up field
     */
    public const COL_CAV_POSITIONS_UP = 'outlet_visits_view.cav_positions_up';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'outlet_visits_view.territory_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'outlet_visits_view.territory_name';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'outlet_visits_view.beat_id';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'outlet_visits_view.beat_name';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'outlet_visits_view.outlet_org_data_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_visits_view.outlet_id';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'outlet_visits_view.outlettype_id';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'outlet_visits_view.outlettype_name';

    /**
     * the column name for the outlet_salutation field
     */
    public const COL_OUTLET_SALUTATION = 'outlet_visits_view.outlet_salutation';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'outlet_visits_view.outlet_name';

    /**
     * the column name for the outlet_contact_no field
     */
    public const COL_OUTLET_CONTACT_NO = 'outlet_visits_view.outlet_contact_no';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'outlet_visits_view.visit_fq';

    /**
     * the column name for the vfcovered field
     */
    public const COL_VFCOVERED = 'outlet_visits_view.vfcovered';

    /**
     * the column name for the visits field
     */
    public const COL_VISITS = 'outlet_visits_view.visits';

    /**
     * the column name for the rcpa_done field
     */
    public const COL_RCPA_DONE = 'outlet_visits_view.rcpa_done';

    /**
     * the column name for the sgpi_done field
     */
    public const COL_SGPI_DONE = 'outlet_visits_view.sgpi_done';

    /**
     * the column name for the outlet_classification field
     */
    public const COL_OUTLET_CLASSIFICATION = 'outlet_visits_view.outlet_classification';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'outlet_visits_view.employee_id';

    /**
     * the column name for the territory_position field
     */
    public const COL_TERRITORY_POSITION = 'outlet_visits_view.territory_position';

    /**
     * the column name for the incharge field
     */
    public const COL_INCHARGE = 'outlet_visits_view.incharge';

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
        self::TYPE_PHPNAME       => ['UniqueId', 'Moye', 'PsitionName', 'PositionId', 'CavPositionsUp', 'TerritoryId', 'TerritoryName', 'BeatId', 'BeatName', 'OutletOrgDataId', 'OutletId', 'OutlettypeId', 'OutlettypeName', 'OutletSalutation', 'OutletName', 'OutletContactNo', 'VisitFq', 'Vfcovered', 'Visits', 'RcpaDone', 'SgpiDone', 'OutletClassification', 'EmployeeId', 'TerritoryPosition', 'Incharge', ],
        self::TYPE_CAMELNAME     => ['uniqueId', 'moye', 'psitionName', 'positionId', 'cavPositionsUp', 'territoryId', 'territoryName', 'beatId', 'beatName', 'outletOrgDataId', 'outletId', 'outlettypeId', 'outlettypeName', 'outletSalutation', 'outletName', 'outletContactNo', 'visitFq', 'vfcovered', 'visits', 'rcpaDone', 'sgpiDone', 'outletClassification', 'employeeId', 'territoryPosition', 'incharge', ],
        self::TYPE_COLNAME       => [OutletVisitsViewTableMap::COL_UNIQUE_ID, OutletVisitsViewTableMap::COL_MOYE, OutletVisitsViewTableMap::COL_POSITION_NAME, OutletVisitsViewTableMap::COL_POSITION_ID, OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP, OutletVisitsViewTableMap::COL_TERRITORY_ID, OutletVisitsViewTableMap::COL_TERRITORY_NAME, OutletVisitsViewTableMap::COL_BEAT_ID, OutletVisitsViewTableMap::COL_BEAT_NAME, OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID, OutletVisitsViewTableMap::COL_OUTLET_ID, OutletVisitsViewTableMap::COL_OUTLETTYPE_ID, OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME, OutletVisitsViewTableMap::COL_OUTLET_SALUTATION, OutletVisitsViewTableMap::COL_OUTLET_NAME, OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO, OutletVisitsViewTableMap::COL_VISIT_FQ, OutletVisitsViewTableMap::COL_VFCOVERED, OutletVisitsViewTableMap::COL_VISITS, OutletVisitsViewTableMap::COL_RCPA_DONE, OutletVisitsViewTableMap::COL_SGPI_DONE, OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION, OutletVisitsViewTableMap::COL_EMPLOYEE_ID, OutletVisitsViewTableMap::COL_TERRITORY_POSITION, OutletVisitsViewTableMap::COL_INCHARGE, ],
        self::TYPE_FIELDNAME     => ['unique_id', 'moye', 'position_name', 'position_id', 'cav_positions_up', 'territory_id', 'territory_name', 'beat_id', 'beat_name', 'outlet_org_data_id', 'outlet_id', 'outlettype_id', 'outlettype_name', 'outlet_salutation', 'outlet_name', 'outlet_contact_no', 'visit_fq', 'vfcovered', 'visits', 'rcpa_done', 'sgpi_done', 'outlet_classification', 'employee_id', 'territory_position', 'incharge', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, ]
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
        self::TYPE_PHPNAME       => ['UniqueId' => 0, 'Moye' => 1, 'PsitionName' => 2, 'PositionId' => 3, 'CavPositionsUp' => 4, 'TerritoryId' => 5, 'TerritoryName' => 6, 'BeatId' => 7, 'BeatName' => 8, 'OutletOrgDataId' => 9, 'OutletId' => 10, 'OutlettypeId' => 11, 'OutlettypeName' => 12, 'OutletSalutation' => 13, 'OutletName' => 14, 'OutletContactNo' => 15, 'VisitFq' => 16, 'Vfcovered' => 17, 'Visits' => 18, 'RcpaDone' => 19, 'SgpiDone' => 20, 'OutletClassification' => 21, 'EmployeeId' => 22, 'TerritoryPosition' => 23, 'Incharge' => 24, ],
        self::TYPE_CAMELNAME     => ['uniqueId' => 0, 'moye' => 1, 'psitionName' => 2, 'positionId' => 3, 'cavPositionsUp' => 4, 'territoryId' => 5, 'territoryName' => 6, 'beatId' => 7, 'beatName' => 8, 'outletOrgDataId' => 9, 'outletId' => 10, 'outlettypeId' => 11, 'outlettypeName' => 12, 'outletSalutation' => 13, 'outletName' => 14, 'outletContactNo' => 15, 'visitFq' => 16, 'vfcovered' => 17, 'visits' => 18, 'rcpaDone' => 19, 'sgpiDone' => 20, 'outletClassification' => 21, 'employeeId' => 22, 'territoryPosition' => 23, 'incharge' => 24, ],
        self::TYPE_COLNAME       => [OutletVisitsViewTableMap::COL_UNIQUE_ID => 0, OutletVisitsViewTableMap::COL_MOYE => 1, OutletVisitsViewTableMap::COL_POSITION_NAME => 2, OutletVisitsViewTableMap::COL_POSITION_ID => 3, OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP => 4, OutletVisitsViewTableMap::COL_TERRITORY_ID => 5, OutletVisitsViewTableMap::COL_TERRITORY_NAME => 6, OutletVisitsViewTableMap::COL_BEAT_ID => 7, OutletVisitsViewTableMap::COL_BEAT_NAME => 8, OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID => 9, OutletVisitsViewTableMap::COL_OUTLET_ID => 10, OutletVisitsViewTableMap::COL_OUTLETTYPE_ID => 11, OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME => 12, OutletVisitsViewTableMap::COL_OUTLET_SALUTATION => 13, OutletVisitsViewTableMap::COL_OUTLET_NAME => 14, OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO => 15, OutletVisitsViewTableMap::COL_VISIT_FQ => 16, OutletVisitsViewTableMap::COL_VFCOVERED => 17, OutletVisitsViewTableMap::COL_VISITS => 18, OutletVisitsViewTableMap::COL_RCPA_DONE => 19, OutletVisitsViewTableMap::COL_SGPI_DONE => 20, OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION => 21, OutletVisitsViewTableMap::COL_EMPLOYEE_ID => 22, OutletVisitsViewTableMap::COL_TERRITORY_POSITION => 23, OutletVisitsViewTableMap::COL_INCHARGE => 24, ],
        self::TYPE_FIELDNAME     => ['unique_id' => 0, 'moye' => 1, 'position_name' => 2, 'position_id' => 3, 'cav_positions_up' => 4, 'territory_id' => 5, 'territory_name' => 6, 'beat_id' => 7, 'beat_name' => 8, 'outlet_org_data_id' => 9, 'outlet_id' => 10, 'outlettype_id' => 11, 'outlettype_name' => 12, 'outlet_salutation' => 13, 'outlet_name' => 14, 'outlet_contact_no' => 15, 'visit_fq' => 16, 'vfcovered' => 17, 'visits' => 18, 'rcpa_done' => 19, 'sgpi_done' => 20, 'outlet_classification' => 21, 'employee_id' => 22, 'territory_position' => 23, 'incharge' => 24, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'UniqueId' => 'UNIQUE_ID',
        'OutletVisitsView.UniqueId' => 'UNIQUE_ID',
        'uniqueId' => 'UNIQUE_ID',
        'outletVisitsView.uniqueId' => 'UNIQUE_ID',
        'OutletVisitsViewTableMap::COL_UNIQUE_ID' => 'UNIQUE_ID',
        'COL_UNIQUE_ID' => 'UNIQUE_ID',
        'unique_id' => 'UNIQUE_ID',
        'outlet_visits_view.unique_id' => 'UNIQUE_ID',
        'Moye' => 'MOYE',
        'OutletVisitsView.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'outletVisitsView.moye' => 'MOYE',
        'OutletVisitsViewTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'outlet_visits_view.moye' => 'MOYE',
        'PsitionName' => 'POSITION_NAME',
        'OutletVisitsView.PsitionName' => 'POSITION_NAME',
        'psitionName' => 'POSITION_NAME',
        'outletVisitsView.psitionName' => 'POSITION_NAME',
        'OutletVisitsViewTableMap::COL_POSITION_NAME' => 'POSITION_NAME',
        'COL_POSITION_NAME' => 'POSITION_NAME',
        'position_name' => 'POSITION_NAME',
        'outlet_visits_view.position_name' => 'POSITION_NAME',
        'PositionId' => 'POSITION_ID',
        'OutletVisitsView.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'outletVisitsView.positionId' => 'POSITION_ID',
        'OutletVisitsViewTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'outlet_visits_view.position_id' => 'POSITION_ID',
        'CavPositionsUp' => 'CAV_POSITIONS_UP',
        'OutletVisitsView.CavPositionsUp' => 'CAV_POSITIONS_UP',
        'cavPositionsUp' => 'CAV_POSITIONS_UP',
        'outletVisitsView.cavPositionsUp' => 'CAV_POSITIONS_UP',
        'OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP' => 'CAV_POSITIONS_UP',
        'COL_CAV_POSITIONS_UP' => 'CAV_POSITIONS_UP',
        'cav_positions_up' => 'CAV_POSITIONS_UP',
        'outlet_visits_view.cav_positions_up' => 'CAV_POSITIONS_UP',
        'TerritoryId' => 'TERRITORY_ID',
        'OutletVisitsView.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'outletVisitsView.territoryId' => 'TERRITORY_ID',
        'OutletVisitsViewTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'outlet_visits_view.territory_id' => 'TERRITORY_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'OutletVisitsView.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'outletVisitsView.territoryName' => 'TERRITORY_NAME',
        'OutletVisitsViewTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'outlet_visits_view.territory_name' => 'TERRITORY_NAME',
        'BeatId' => 'BEAT_ID',
        'OutletVisitsView.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'outletVisitsView.beatId' => 'BEAT_ID',
        'OutletVisitsViewTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'outlet_visits_view.beat_id' => 'BEAT_ID',
        'BeatName' => 'BEAT_NAME',
        'OutletVisitsView.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'outletVisitsView.beatName' => 'BEAT_NAME',
        'OutletVisitsViewTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'outlet_visits_view.beat_name' => 'BEAT_NAME',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'OutletVisitsView.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletVisitsView.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'outlet_visits_view.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'OutletId' => 'OUTLET_ID',
        'OutletVisitsView.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletVisitsView.outletId' => 'OUTLET_ID',
        'OutletVisitsViewTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_visits_view.outlet_id' => 'OUTLET_ID',
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'OutletVisitsView.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'outletVisitsView.outlettypeId' => 'OUTLETTYPE_ID',
        'OutletVisitsViewTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'outlet_visits_view.outlettype_id' => 'OUTLETTYPE_ID',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'OutletVisitsView.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'outletVisitsView.outlettypeName' => 'OUTLETTYPE_NAME',
        'OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'outlet_visits_view.outlettype_name' => 'OUTLETTYPE_NAME',
        'OutletSalutation' => 'OUTLET_SALUTATION',
        'OutletVisitsView.OutletSalutation' => 'OUTLET_SALUTATION',
        'outletSalutation' => 'OUTLET_SALUTATION',
        'outletVisitsView.outletSalutation' => 'OUTLET_SALUTATION',
        'OutletVisitsViewTableMap::COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'outlet_salutation' => 'OUTLET_SALUTATION',
        'outlet_visits_view.outlet_salutation' => 'OUTLET_SALUTATION',
        'OutletName' => 'OUTLET_NAME',
        'OutletVisitsView.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'outletVisitsView.outletName' => 'OUTLET_NAME',
        'OutletVisitsViewTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'outlet_visits_view.outlet_name' => 'OUTLET_NAME',
        'OutletContactNo' => 'OUTLET_CONTACT_NO',
        'OutletVisitsView.OutletContactNo' => 'OUTLET_CONTACT_NO',
        'outletContactNo' => 'OUTLET_CONTACT_NO',
        'outletVisitsView.outletContactNo' => 'OUTLET_CONTACT_NO',
        'OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO' => 'OUTLET_CONTACT_NO',
        'COL_OUTLET_CONTACT_NO' => 'OUTLET_CONTACT_NO',
        'outlet_contact_no' => 'OUTLET_CONTACT_NO',
        'outlet_visits_view.outlet_contact_no' => 'OUTLET_CONTACT_NO',
        'VisitFq' => 'VISIT_FQ',
        'OutletVisitsView.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'outletVisitsView.visitFq' => 'VISIT_FQ',
        'OutletVisitsViewTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'outlet_visits_view.visit_fq' => 'VISIT_FQ',
        'Vfcovered' => 'VFCOVERED',
        'OutletVisitsView.Vfcovered' => 'VFCOVERED',
        'vfcovered' => 'VFCOVERED',
        'outletVisitsView.vfcovered' => 'VFCOVERED',
        'OutletVisitsViewTableMap::COL_VFCOVERED' => 'VFCOVERED',
        'COL_VFCOVERED' => 'VFCOVERED',
        'outlet_visits_view.vfcovered' => 'VFCOVERED',
        'Visits' => 'VISITS',
        'OutletVisitsView.Visits' => 'VISITS',
        'visits' => 'VISITS',
        'outletVisitsView.visits' => 'VISITS',
        'OutletVisitsViewTableMap::COL_VISITS' => 'VISITS',
        'COL_VISITS' => 'VISITS',
        'outlet_visits_view.visits' => 'VISITS',
        'RcpaDone' => 'RCPA_DONE',
        'OutletVisitsView.RcpaDone' => 'RCPA_DONE',
        'rcpaDone' => 'RCPA_DONE',
        'outletVisitsView.rcpaDone' => 'RCPA_DONE',
        'OutletVisitsViewTableMap::COL_RCPA_DONE' => 'RCPA_DONE',
        'COL_RCPA_DONE' => 'RCPA_DONE',
        'rcpa_done' => 'RCPA_DONE',
        'outlet_visits_view.rcpa_done' => 'RCPA_DONE',
        'SgpiDone' => 'SGPI_DONE',
        'OutletVisitsView.SgpiDone' => 'SGPI_DONE',
        'sgpiDone' => 'SGPI_DONE',
        'outletVisitsView.sgpiDone' => 'SGPI_DONE',
        'OutletVisitsViewTableMap::COL_SGPI_DONE' => 'SGPI_DONE',
        'COL_SGPI_DONE' => 'SGPI_DONE',
        'sgpi_done' => 'SGPI_DONE',
        'outlet_visits_view.sgpi_done' => 'SGPI_DONE',
        'OutletClassification' => 'OUTLET_CLASSIFICATION',
        'OutletVisitsView.OutletClassification' => 'OUTLET_CLASSIFICATION',
        'outletClassification' => 'OUTLET_CLASSIFICATION',
        'outletVisitsView.outletClassification' => 'OUTLET_CLASSIFICATION',
        'OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'outlet_classification' => 'OUTLET_CLASSIFICATION',
        'outlet_visits_view.outlet_classification' => 'OUTLET_CLASSIFICATION',
        'EmployeeId' => 'EMPLOYEE_ID',
        'OutletVisitsView.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'outletVisitsView.employeeId' => 'EMPLOYEE_ID',
        'OutletVisitsViewTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'outlet_visits_view.employee_id' => 'EMPLOYEE_ID',
        'TerritoryPosition' => 'TERRITORY_POSITION',
        'OutletVisitsView.TerritoryPosition' => 'TERRITORY_POSITION',
        'territoryPosition' => 'TERRITORY_POSITION',
        'outletVisitsView.territoryPosition' => 'TERRITORY_POSITION',
        'OutletVisitsViewTableMap::COL_TERRITORY_POSITION' => 'TERRITORY_POSITION',
        'COL_TERRITORY_POSITION' => 'TERRITORY_POSITION',
        'territory_position' => 'TERRITORY_POSITION',
        'outlet_visits_view.territory_position' => 'TERRITORY_POSITION',
        'Incharge' => 'INCHARGE',
        'OutletVisitsView.Incharge' => 'INCHARGE',
        'incharge' => 'INCHARGE',
        'outletVisitsView.incharge' => 'INCHARGE',
        'OutletVisitsViewTableMap::COL_INCHARGE' => 'INCHARGE',
        'COL_INCHARGE' => 'INCHARGE',
        'outlet_visits_view.incharge' => 'INCHARGE',
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
        $this->setName('outlet_visits_view');
        $this->setPhpName('OutletVisitsView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletVisitsView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('unique_id', 'UniqueId', 'VARCHAR', true, 50, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', false, 50, null);
        $this->addColumn('position_name', 'PsitionName', 'VARCHAR', false, 50, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('cav_positions_up', 'CavPositionsUp', 'VARCHAR', false, 50, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, 50, null);
        $this->addColumn('beat_id', 'BeatId', 'INTEGER', false, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_id', 'OutletId', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_id', 'OutlettypeId', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_salutation', 'OutletSalutation', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_contact_no', 'OutletContactNo', 'VARCHAR', false, 50, null);
        $this->addColumn('visit_fq', 'VisitFq', 'INTEGER', false, null, null);
        $this->addColumn('vfcovered', 'Vfcovered', 'INTEGER', false, null, null);
        $this->addColumn('visits', 'Visits', 'INTEGER', false, null, null);
        $this->addColumn('rcpa_done', 'RcpaDone', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_done', 'SgpiDone', 'INTEGER', false, null, null);
        $this->addColumn('outlet_classification', 'OutletClassification', 'INTEGER', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('territory_position', 'TerritoryPosition', 'INTEGER', false, null, null);
        $this->addColumn('incharge', 'Incharge', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UniqueId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UniqueId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UniqueId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UniqueId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UniqueId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UniqueId', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('UniqueId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletVisitsViewTableMap::CLASS_DEFAULT : OutletVisitsViewTableMap::OM_CLASS;
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
     * @return array (OutletVisitsView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletVisitsViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletVisitsViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletVisitsViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletVisitsViewTableMap::OM_CLASS;
            /** @var OutletVisitsView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletVisitsViewTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletVisitsViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletVisitsViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletVisitsView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletVisitsViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_UNIQUE_ID);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_MOYE);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_POSITION_NAME);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_SALUTATION);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_VFCOVERED);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_VISITS);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_RCPA_DONE);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_SGPI_DONE);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_TERRITORY_POSITION);
            $criteria->addSelectColumn(OutletVisitsViewTableMap::COL_INCHARGE);
        } else {
            $criteria->addSelectColumn($alias . '.unique_id');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.position_name');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.cav_positions_up');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.outlet_salutation');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_contact_no');
            $criteria->addSelectColumn($alias . '.visit_fq');
            $criteria->addSelectColumn($alias . '.vfcovered');
            $criteria->addSelectColumn($alias . '.visits');
            $criteria->addSelectColumn($alias . '.rcpa_done');
            $criteria->addSelectColumn($alias . '.sgpi_done');
            $criteria->addSelectColumn($alias . '.outlet_classification');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.territory_position');
            $criteria->addSelectColumn($alias . '.incharge');
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
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_UNIQUE_ID);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_MOYE);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_POSITION_NAME);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_SALUTATION);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_VFCOVERED);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_VISITS);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_RCPA_DONE);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_SGPI_DONE);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_TERRITORY_POSITION);
            $criteria->removeSelectColumn(OutletVisitsViewTableMap::COL_INCHARGE);
        } else {
            $criteria->removeSelectColumn($alias . '.unique_id');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.position_name');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.cav_positions_up');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.outlet_salutation');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_contact_no');
            $criteria->removeSelectColumn($alias . '.visit_fq');
            $criteria->removeSelectColumn($alias . '.vfcovered');
            $criteria->removeSelectColumn($alias . '.visits');
            $criteria->removeSelectColumn($alias . '.rcpa_done');
            $criteria->removeSelectColumn($alias . '.sgpi_done');
            $criteria->removeSelectColumn($alias . '.outlet_classification');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.territory_position');
            $criteria->removeSelectColumn($alias . '.incharge');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletVisitsViewTableMap::DATABASE_NAME)->getTable(OutletVisitsViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletVisitsView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletVisitsView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletVisitsViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletVisitsView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletVisitsViewTableMap::DATABASE_NAME);
            $criteria->add(OutletVisitsViewTableMap::COL_UNIQUE_ID, (array) $values, Criteria::IN);
        }

        $query = OutletVisitsViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletVisitsViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletVisitsViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_visits_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletVisitsViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletVisitsView or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletVisitsView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletVisitsViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletVisitsView object
        }


        // Set the correct dbName
        $query = OutletVisitsViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
