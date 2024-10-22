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
use entities\PrescriberData;
use entities\PrescriberDataQuery;


/**
 * This class defines the structure of the 'prescriber_data' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PrescriberDataTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.PrescriberDataTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'prescriber_data';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PrescriberData';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\PrescriberData';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.PrescriberData';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the prescriber_tally_data_id field
     */
    public const COL_PRESCRIBER_TALLY_DATA_ID = 'prescriber_data.prescriber_tally_data_id';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'prescriber_data.orgunit_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'prescriber_data.position_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'prescriber_data.territory_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'prescriber_data.outlet_org_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'prescriber_data.brand_id';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'prescriber_data.moye';

    /**
     * the column name for the cut_off field
     */
    public const COL_CUT_OFF = 'prescriber_data.cut_off';

    /**
     * the column name for the lm_rcpa_value field
     */
    public const COL_LM_RCPA_VALUE = 'prescriber_data.lm_rcpa_value';

    /**
     * the column name for the cm_rcpa_value field
     */
    public const COL_CM_RCPA_VALUE = 'prescriber_data.cm_rcpa_value';

    /**
     * the column name for the lm_visit field
     */
    public const COL_LM_VISIT = 'prescriber_data.lm_visit';

    /**
     * the column name for the cm_visit field
     */
    public const COL_CM_VISIT = 'prescriber_data.cm_visit';

    /**
     * the column name for the lm_rcpa field
     */
    public const COL_LM_RCPA = 'prescriber_data.lm_rcpa';

    /**
     * the column name for the cm_rcpa field
     */
    public const COL_CM_RCPA = 'prescriber_data.cm_rcpa';

    /**
     * the column name for the cm_rxber_cat field
     */
    public const COL_CM_RXBER_CAT = 'prescriber_data.cm_rxber_cat';

    /**
     * the column name for the compute_date field
     */
    public const COL_COMPUTE_DATE = 'prescriber_data.compute_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'prescriber_data.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'prescriber_data.updated_at';

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
        self::TYPE_PHPNAME       => ['PrescriberTallyDataId', 'OrgunitId', 'PositionId', 'TerritoryId', 'OutletOrgId', 'BrandId', 'Moye', 'CutOff', 'LmRcpaValue', 'CmRcpaValue', 'LmVisit', 'CmVisit', 'LmRcpa', 'CmRcpa', 'CmRxberCat', 'ComputeDate', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['prescriberTallyDataId', 'orgunitId', 'positionId', 'territoryId', 'outletOrgId', 'brandId', 'moye', 'cutOff', 'lmRcpaValue', 'cmRcpaValue', 'lmVisit', 'cmVisit', 'lmRcpa', 'cmRcpa', 'cmRxberCat', 'computeDate', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID, PrescriberDataTableMap::COL_ORGUNIT_ID, PrescriberDataTableMap::COL_POSITION_ID, PrescriberDataTableMap::COL_TERRITORY_ID, PrescriberDataTableMap::COL_OUTLET_ORG_ID, PrescriberDataTableMap::COL_BRAND_ID, PrescriberDataTableMap::COL_MOYE, PrescriberDataTableMap::COL_CUT_OFF, PrescriberDataTableMap::COL_LM_RCPA_VALUE, PrescriberDataTableMap::COL_CM_RCPA_VALUE, PrescriberDataTableMap::COL_LM_VISIT, PrescriberDataTableMap::COL_CM_VISIT, PrescriberDataTableMap::COL_LM_RCPA, PrescriberDataTableMap::COL_CM_RCPA, PrescriberDataTableMap::COL_CM_RXBER_CAT, PrescriberDataTableMap::COL_COMPUTE_DATE, PrescriberDataTableMap::COL_CREATED_AT, PrescriberDataTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['prescriber_tally_data_id', 'orgunit_id', 'position_id', 'territory_id', 'outlet_org_id', 'brand_id', 'moye', 'cut_off', 'lm_rcpa_value', 'cm_rcpa_value', 'lm_visit', 'cm_visit', 'lm_rcpa', 'cm_rcpa', 'cm_rxber_cat', 'compute_date', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
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
        self::TYPE_PHPNAME       => ['PrescriberTallyDataId' => 0, 'OrgunitId' => 1, 'PositionId' => 2, 'TerritoryId' => 3, 'OutletOrgId' => 4, 'BrandId' => 5, 'Moye' => 6, 'CutOff' => 7, 'LmRcpaValue' => 8, 'CmRcpaValue' => 9, 'LmVisit' => 10, 'CmVisit' => 11, 'LmRcpa' => 12, 'CmRcpa' => 13, 'CmRxberCat' => 14, 'ComputeDate' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ],
        self::TYPE_CAMELNAME     => ['prescriberTallyDataId' => 0, 'orgunitId' => 1, 'positionId' => 2, 'territoryId' => 3, 'outletOrgId' => 4, 'brandId' => 5, 'moye' => 6, 'cutOff' => 7, 'lmRcpaValue' => 8, 'cmRcpaValue' => 9, 'lmVisit' => 10, 'cmVisit' => 11, 'lmRcpa' => 12, 'cmRcpa' => 13, 'cmRxberCat' => 14, 'computeDate' => 15, 'createdAt' => 16, 'updatedAt' => 17, ],
        self::TYPE_COLNAME       => [PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID => 0, PrescriberDataTableMap::COL_ORGUNIT_ID => 1, PrescriberDataTableMap::COL_POSITION_ID => 2, PrescriberDataTableMap::COL_TERRITORY_ID => 3, PrescriberDataTableMap::COL_OUTLET_ORG_ID => 4, PrescriberDataTableMap::COL_BRAND_ID => 5, PrescriberDataTableMap::COL_MOYE => 6, PrescriberDataTableMap::COL_CUT_OFF => 7, PrescriberDataTableMap::COL_LM_RCPA_VALUE => 8, PrescriberDataTableMap::COL_CM_RCPA_VALUE => 9, PrescriberDataTableMap::COL_LM_VISIT => 10, PrescriberDataTableMap::COL_CM_VISIT => 11, PrescriberDataTableMap::COL_LM_RCPA => 12, PrescriberDataTableMap::COL_CM_RCPA => 13, PrescriberDataTableMap::COL_CM_RXBER_CAT => 14, PrescriberDataTableMap::COL_COMPUTE_DATE => 15, PrescriberDataTableMap::COL_CREATED_AT => 16, PrescriberDataTableMap::COL_UPDATED_AT => 17, ],
        self::TYPE_FIELDNAME     => ['prescriber_tally_data_id' => 0, 'orgunit_id' => 1, 'position_id' => 2, 'territory_id' => 3, 'outlet_org_id' => 4, 'brand_id' => 5, 'moye' => 6, 'cut_off' => 7, 'lm_rcpa_value' => 8, 'cm_rcpa_value' => 9, 'lm_visit' => 10, 'cm_visit' => 11, 'lm_rcpa' => 12, 'cm_rcpa' => 13, 'cm_rxber_cat' => 14, 'compute_date' => 15, 'created_at' => 16, 'updated_at' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PrescriberTallyDataId' => 'PRESCRIBER_TALLY_DATA_ID',
        'PrescriberData.PrescriberTallyDataId' => 'PRESCRIBER_TALLY_DATA_ID',
        'prescriberTallyDataId' => 'PRESCRIBER_TALLY_DATA_ID',
        'prescriberData.prescriberTallyDataId' => 'PRESCRIBER_TALLY_DATA_ID',
        'PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID' => 'PRESCRIBER_TALLY_DATA_ID',
        'COL_PRESCRIBER_TALLY_DATA_ID' => 'PRESCRIBER_TALLY_DATA_ID',
        'prescriber_tally_data_id' => 'PRESCRIBER_TALLY_DATA_ID',
        'prescriber_data.prescriber_tally_data_id' => 'PRESCRIBER_TALLY_DATA_ID',
        'OrgunitId' => 'ORGUNIT_ID',
        'PrescriberData.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'prescriberData.orgunitId' => 'ORGUNIT_ID',
        'PrescriberDataTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'prescriber_data.orgunit_id' => 'ORGUNIT_ID',
        'PositionId' => 'POSITION_ID',
        'PrescriberData.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'prescriberData.positionId' => 'POSITION_ID',
        'PrescriberDataTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'prescriber_data.position_id' => 'POSITION_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'PrescriberData.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'prescriberData.territoryId' => 'TERRITORY_ID',
        'PrescriberDataTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'prescriber_data.territory_id' => 'TERRITORY_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'PrescriberData.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'prescriberData.outletOrgId' => 'OUTLET_ORG_ID',
        'PrescriberDataTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'prescriber_data.outlet_org_id' => 'OUTLET_ORG_ID',
        'BrandId' => 'BRAND_ID',
        'PrescriberData.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'prescriberData.brandId' => 'BRAND_ID',
        'PrescriberDataTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'prescriber_data.brand_id' => 'BRAND_ID',
        'Moye' => 'MOYE',
        'PrescriberData.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'prescriberData.moye' => 'MOYE',
        'PrescriberDataTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'prescriber_data.moye' => 'MOYE',
        'CutOff' => 'CUT_OFF',
        'PrescriberData.CutOff' => 'CUT_OFF',
        'cutOff' => 'CUT_OFF',
        'prescriberData.cutOff' => 'CUT_OFF',
        'PrescriberDataTableMap::COL_CUT_OFF' => 'CUT_OFF',
        'COL_CUT_OFF' => 'CUT_OFF',
        'cut_off' => 'CUT_OFF',
        'prescriber_data.cut_off' => 'CUT_OFF',
        'LmRcpaValue' => 'LM_RCPA_VALUE',
        'PrescriberData.LmRcpaValue' => 'LM_RCPA_VALUE',
        'lmRcpaValue' => 'LM_RCPA_VALUE',
        'prescriberData.lmRcpaValue' => 'LM_RCPA_VALUE',
        'PrescriberDataTableMap::COL_LM_RCPA_VALUE' => 'LM_RCPA_VALUE',
        'COL_LM_RCPA_VALUE' => 'LM_RCPA_VALUE',
        'lm_rcpa_value' => 'LM_RCPA_VALUE',
        'prescriber_data.lm_rcpa_value' => 'LM_RCPA_VALUE',
        'CmRcpaValue' => 'CM_RCPA_VALUE',
        'PrescriberData.CmRcpaValue' => 'CM_RCPA_VALUE',
        'cmRcpaValue' => 'CM_RCPA_VALUE',
        'prescriberData.cmRcpaValue' => 'CM_RCPA_VALUE',
        'PrescriberDataTableMap::COL_CM_RCPA_VALUE' => 'CM_RCPA_VALUE',
        'COL_CM_RCPA_VALUE' => 'CM_RCPA_VALUE',
        'cm_rcpa_value' => 'CM_RCPA_VALUE',
        'prescriber_data.cm_rcpa_value' => 'CM_RCPA_VALUE',
        'LmVisit' => 'LM_VISIT',
        'PrescriberData.LmVisit' => 'LM_VISIT',
        'lmVisit' => 'LM_VISIT',
        'prescriberData.lmVisit' => 'LM_VISIT',
        'PrescriberDataTableMap::COL_LM_VISIT' => 'LM_VISIT',
        'COL_LM_VISIT' => 'LM_VISIT',
        'lm_visit' => 'LM_VISIT',
        'prescriber_data.lm_visit' => 'LM_VISIT',
        'CmVisit' => 'CM_VISIT',
        'PrescriberData.CmVisit' => 'CM_VISIT',
        'cmVisit' => 'CM_VISIT',
        'prescriberData.cmVisit' => 'CM_VISIT',
        'PrescriberDataTableMap::COL_CM_VISIT' => 'CM_VISIT',
        'COL_CM_VISIT' => 'CM_VISIT',
        'cm_visit' => 'CM_VISIT',
        'prescriber_data.cm_visit' => 'CM_VISIT',
        'LmRcpa' => 'LM_RCPA',
        'PrescriberData.LmRcpa' => 'LM_RCPA',
        'lmRcpa' => 'LM_RCPA',
        'prescriberData.lmRcpa' => 'LM_RCPA',
        'PrescriberDataTableMap::COL_LM_RCPA' => 'LM_RCPA',
        'COL_LM_RCPA' => 'LM_RCPA',
        'lm_rcpa' => 'LM_RCPA',
        'prescriber_data.lm_rcpa' => 'LM_RCPA',
        'CmRcpa' => 'CM_RCPA',
        'PrescriberData.CmRcpa' => 'CM_RCPA',
        'cmRcpa' => 'CM_RCPA',
        'prescriberData.cmRcpa' => 'CM_RCPA',
        'PrescriberDataTableMap::COL_CM_RCPA' => 'CM_RCPA',
        'COL_CM_RCPA' => 'CM_RCPA',
        'cm_rcpa' => 'CM_RCPA',
        'prescriber_data.cm_rcpa' => 'CM_RCPA',
        'CmRxberCat' => 'CM_RXBER_CAT',
        'PrescriberData.CmRxberCat' => 'CM_RXBER_CAT',
        'cmRxberCat' => 'CM_RXBER_CAT',
        'prescriberData.cmRxberCat' => 'CM_RXBER_CAT',
        'PrescriberDataTableMap::COL_CM_RXBER_CAT' => 'CM_RXBER_CAT',
        'COL_CM_RXBER_CAT' => 'CM_RXBER_CAT',
        'cm_rxber_cat' => 'CM_RXBER_CAT',
        'prescriber_data.cm_rxber_cat' => 'CM_RXBER_CAT',
        'ComputeDate' => 'COMPUTE_DATE',
        'PrescriberData.ComputeDate' => 'COMPUTE_DATE',
        'computeDate' => 'COMPUTE_DATE',
        'prescriberData.computeDate' => 'COMPUTE_DATE',
        'PrescriberDataTableMap::COL_COMPUTE_DATE' => 'COMPUTE_DATE',
        'COL_COMPUTE_DATE' => 'COMPUTE_DATE',
        'compute_date' => 'COMPUTE_DATE',
        'prescriber_data.compute_date' => 'COMPUTE_DATE',
        'CreatedAt' => 'CREATED_AT',
        'PrescriberData.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'prescriberData.createdAt' => 'CREATED_AT',
        'PrescriberDataTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'prescriber_data.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'PrescriberData.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'prescriberData.updatedAt' => 'UPDATED_AT',
        'PrescriberDataTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'prescriber_data.updated_at' => 'UPDATED_AT',
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
        $this->setName('prescriber_data');
        $this->setPhpName('PrescriberData');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\PrescriberData');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('prescriber_data_prescriber_tally_data_id_seq');
        // columns
        $this->addPrimaryKey('prescriber_tally_data_id', 'PrescriberTallyDataId', 'INTEGER', true, null, null);
        $this->addForeignKey('orgunit_id', 'OrgunitId', 'INTEGER', 'org_unit', 'orgunitid', true, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', true, null, null);
        $this->addForeignKey('territory_id', 'TerritoryId', 'INTEGER', 'territories', 'territory_id', true, null, null);
        $this->addForeignKey('outlet_org_id', 'OutletOrgId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', true, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', true, null, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', true, null, null);
        $this->addColumn('cut_off', 'CutOff', 'INTEGER', false, null, null);
        $this->addColumn('lm_rcpa_value', 'LmRcpaValue', 'INTEGER', false, null, null);
        $this->addColumn('cm_rcpa_value', 'CmRcpaValue', 'INTEGER', false, null, null);
        $this->addColumn('lm_visit', 'LmVisit', 'VARCHAR', false, 10, null);
        $this->addColumn('cm_visit', 'CmVisit', 'VARCHAR', false, 10, null);
        $this->addColumn('lm_rcpa', 'LmRcpa', 'VARCHAR', false, 10, null);
        $this->addColumn('cm_rcpa', 'CmRcpa', 'VARCHAR', false, 10, null);
        $this->addColumn('cm_rxber_cat', 'CmRxberCat', 'VARCHAR', false, 50, null);
        $this->addColumn('compute_date', 'ComputeDate', 'DATE', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallyDataId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallyDataId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallyDataId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallyDataId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallyDataId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallyDataId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PrescriberTallyDataId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PrescriberDataTableMap::CLASS_DEFAULT : PrescriberDataTableMap::OM_CLASS;
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
     * @return array (PrescriberData object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PrescriberDataTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PrescriberDataTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PrescriberDataTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PrescriberDataTableMap::OM_CLASS;
            /** @var PrescriberData $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PrescriberDataTableMap::addInstanceToPool($obj, $key);
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
            $key = PrescriberDataTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PrescriberDataTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PrescriberData $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PrescriberDataTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_ORGUNIT_ID);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_MOYE);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_CUT_OFF);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_LM_RCPA_VALUE);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_CM_RCPA_VALUE);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_LM_VISIT);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_CM_VISIT);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_LM_RCPA);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_CM_RCPA);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_CM_RXBER_CAT);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_COMPUTE_DATE);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PrescriberDataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.prescriber_tally_data_id');
            $criteria->addSelectColumn($alias . '.orgunit_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.cut_off');
            $criteria->addSelectColumn($alias . '.lm_rcpa_value');
            $criteria->addSelectColumn($alias . '.cm_rcpa_value');
            $criteria->addSelectColumn($alias . '.lm_visit');
            $criteria->addSelectColumn($alias . '.cm_visit');
            $criteria->addSelectColumn($alias . '.lm_rcpa');
            $criteria->addSelectColumn($alias . '.cm_rcpa');
            $criteria->addSelectColumn($alias . '.cm_rxber_cat');
            $criteria->addSelectColumn($alias . '.compute_date');
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
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_ORGUNIT_ID);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_MOYE);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_CUT_OFF);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_LM_RCPA_VALUE);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_CM_RCPA_VALUE);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_LM_VISIT);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_CM_VISIT);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_LM_RCPA);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_CM_RCPA);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_CM_RXBER_CAT);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_COMPUTE_DATE);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PrescriberDataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.prescriber_tally_data_id');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.cut_off');
            $criteria->removeSelectColumn($alias . '.lm_rcpa_value');
            $criteria->removeSelectColumn($alias . '.cm_rcpa_value');
            $criteria->removeSelectColumn($alias . '.lm_visit');
            $criteria->removeSelectColumn($alias . '.cm_visit');
            $criteria->removeSelectColumn($alias . '.lm_rcpa');
            $criteria->removeSelectColumn($alias . '.cm_rcpa');
            $criteria->removeSelectColumn($alias . '.cm_rxber_cat');
            $criteria->removeSelectColumn($alias . '.compute_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(PrescriberDataTableMap::DATABASE_NAME)->getTable(PrescriberDataTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PrescriberData or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PrescriberData object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberDataTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\PrescriberData) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PrescriberDataTableMap::DATABASE_NAME);
            $criteria->add(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID, (array) $values, Criteria::IN);
        }

        $query = PrescriberDataQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PrescriberDataTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PrescriberDataTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the prescriber_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PrescriberDataQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PrescriberData or Criteria object.
     *
     * @param mixed $criteria Criteria or PrescriberData object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberDataTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PrescriberData object
        }

        if ($criteria->containsKey(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID) && $criteria->keyContainsValue(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID.')');
        }


        // Set the correct dbName
        $query = PrescriberDataQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
