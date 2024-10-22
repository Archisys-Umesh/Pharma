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
use entities\OutletOrgData;
use entities\OutletOrgDataQuery;


/**
 * This class defines the structure of the 'outlet_org_data' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletOrgDataTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletOrgDataTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_org_data';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletOrgData';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletOrgData';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletOrgData';

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
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'outlet_org_data.outlet_org_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_org_data.outlet_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'outlet_org_data.org_unit_id';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'outlet_org_data.tags';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'outlet_org_data.visit_fq';

    /**
     * the column name for the comments field
     */
    public const COL_COMMENTS = 'outlet_org_data.comments';

    /**
     * the column name for the org_potential field
     */
    public const COL_ORG_POTENTIAL = 'outlet_org_data.org_potential';

    /**
     * the column name for the brand_focus field
     */
    public const COL_BRAND_FOCUS = 'outlet_org_data.brand_focus';

    /**
     * the column name for the customer_fq field
     */
    public const COL_CUSTOMER_FQ = 'outlet_org_data.customer_fq';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_org_data.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_org_data.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_org_data.updated_at';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'outlet_org_data.itownid';

    /**
     * the column name for the default_address field
     */
    public const COL_DEFAULT_ADDRESS = 'outlet_org_data.default_address';

    /**
     * the column name for the last_visit_date field
     */
    public const COL_LAST_VISIT_DATE = 'outlet_org_data.last_visit_date';

    /**
     * the column name for the last_visit_employee field
     */
    public const COL_LAST_VISIT_EMPLOYEE = 'outlet_org_data.last_visit_employee';

    /**
     * the column name for the outlet_org_code field
     */
    public const COL_OUTLET_ORG_CODE = 'outlet_org_data.outlet_org_code';

    /**
     * the column name for the invested_amount field
     */
    public const COL_INVESTED_AMOUNT = 'outlet_org_data.invested_amount';

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
        self::TYPE_PHPNAME       => ['OutletOrgId', 'OutletId', 'OrgUnitId', 'Tags', 'VisitFq', 'Comments', 'OrgPotential', 'BrandFocus', 'CustomerFq', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'Itownid', 'DefaultAddress', 'LastVisitDate', 'LastVisitEmployee', 'OutletOrgCode', 'InvestedAmount', ],
        self::TYPE_CAMELNAME     => ['outletOrgId', 'outletId', 'orgUnitId', 'tags', 'visitFq', 'comments', 'orgPotential', 'brandFocus', 'customerFq', 'companyId', 'createdAt', 'updatedAt', 'itownid', 'defaultAddress', 'lastVisitDate', 'lastVisitEmployee', 'outletOrgCode', 'investedAmount', ],
        self::TYPE_COLNAME       => [OutletOrgDataTableMap::COL_OUTLET_ORG_ID, OutletOrgDataTableMap::COL_OUTLET_ID, OutletOrgDataTableMap::COL_ORG_UNIT_ID, OutletOrgDataTableMap::COL_TAGS, OutletOrgDataTableMap::COL_VISIT_FQ, OutletOrgDataTableMap::COL_COMMENTS, OutletOrgDataTableMap::COL_ORG_POTENTIAL, OutletOrgDataTableMap::COL_BRAND_FOCUS, OutletOrgDataTableMap::COL_CUSTOMER_FQ, OutletOrgDataTableMap::COL_COMPANY_ID, OutletOrgDataTableMap::COL_CREATED_AT, OutletOrgDataTableMap::COL_UPDATED_AT, OutletOrgDataTableMap::COL_ITOWNID, OutletOrgDataTableMap::COL_DEFAULT_ADDRESS, OutletOrgDataTableMap::COL_LAST_VISIT_DATE, OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE, OutletOrgDataTableMap::COL_OUTLET_ORG_CODE, OutletOrgDataTableMap::COL_INVESTED_AMOUNT, ],
        self::TYPE_FIELDNAME     => ['outlet_org_id', 'outlet_id', 'org_unit_id', 'tags', 'visit_fq', 'comments', 'org_potential', 'brand_focus', 'customer_fq', 'company_id', 'created_at', 'updated_at', 'itownid', 'default_address', 'last_visit_date', 'last_visit_employee', 'outlet_org_code', 'invested_amount', ],
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
        self::TYPE_PHPNAME       => ['OutletOrgId' => 0, 'OutletId' => 1, 'OrgUnitId' => 2, 'Tags' => 3, 'VisitFq' => 4, 'Comments' => 5, 'OrgPotential' => 6, 'BrandFocus' => 7, 'CustomerFq' => 8, 'CompanyId' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'Itownid' => 12, 'DefaultAddress' => 13, 'LastVisitDate' => 14, 'LastVisitEmployee' => 15, 'OutletOrgCode' => 16, 'InvestedAmount' => 17, ],
        self::TYPE_CAMELNAME     => ['outletOrgId' => 0, 'outletId' => 1, 'orgUnitId' => 2, 'tags' => 3, 'visitFq' => 4, 'comments' => 5, 'orgPotential' => 6, 'brandFocus' => 7, 'customerFq' => 8, 'companyId' => 9, 'createdAt' => 10, 'updatedAt' => 11, 'itownid' => 12, 'defaultAddress' => 13, 'lastVisitDate' => 14, 'lastVisitEmployee' => 15, 'outletOrgCode' => 16, 'investedAmount' => 17, ],
        self::TYPE_COLNAME       => [OutletOrgDataTableMap::COL_OUTLET_ORG_ID => 0, OutletOrgDataTableMap::COL_OUTLET_ID => 1, OutletOrgDataTableMap::COL_ORG_UNIT_ID => 2, OutletOrgDataTableMap::COL_TAGS => 3, OutletOrgDataTableMap::COL_VISIT_FQ => 4, OutletOrgDataTableMap::COL_COMMENTS => 5, OutletOrgDataTableMap::COL_ORG_POTENTIAL => 6, OutletOrgDataTableMap::COL_BRAND_FOCUS => 7, OutletOrgDataTableMap::COL_CUSTOMER_FQ => 8, OutletOrgDataTableMap::COL_COMPANY_ID => 9, OutletOrgDataTableMap::COL_CREATED_AT => 10, OutletOrgDataTableMap::COL_UPDATED_AT => 11, OutletOrgDataTableMap::COL_ITOWNID => 12, OutletOrgDataTableMap::COL_DEFAULT_ADDRESS => 13, OutletOrgDataTableMap::COL_LAST_VISIT_DATE => 14, OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE => 15, OutletOrgDataTableMap::COL_OUTLET_ORG_CODE => 16, OutletOrgDataTableMap::COL_INVESTED_AMOUNT => 17, ],
        self::TYPE_FIELDNAME     => ['outlet_org_id' => 0, 'outlet_id' => 1, 'org_unit_id' => 2, 'tags' => 3, 'visit_fq' => 4, 'comments' => 5, 'org_potential' => 6, 'brand_focus' => 7, 'customer_fq' => 8, 'company_id' => 9, 'created_at' => 10, 'updated_at' => 11, 'itownid' => 12, 'default_address' => 13, 'last_visit_date' => 14, 'last_visit_employee' => 15, 'outlet_org_code' => 16, 'invested_amount' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'OutletOrgData.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgData.outletOrgId' => 'OUTLET_ORG_ID',
        'OutletOrgDataTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'outlet_org_data.outlet_org_id' => 'OUTLET_ORG_ID',
        'OutletId' => 'OUTLET_ID',
        'OutletOrgData.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletOrgData.outletId' => 'OUTLET_ID',
        'OutletOrgDataTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_org_data.outlet_id' => 'OUTLET_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'OutletOrgData.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'outletOrgData.orgUnitId' => 'ORG_UNIT_ID',
        'OutletOrgDataTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'outlet_org_data.org_unit_id' => 'ORG_UNIT_ID',
        'Tags' => 'TAGS',
        'OutletOrgData.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'outletOrgData.tags' => 'TAGS',
        'OutletOrgDataTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'outlet_org_data.tags' => 'TAGS',
        'VisitFq' => 'VISIT_FQ',
        'OutletOrgData.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'outletOrgData.visitFq' => 'VISIT_FQ',
        'OutletOrgDataTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'outlet_org_data.visit_fq' => 'VISIT_FQ',
        'Comments' => 'COMMENTS',
        'OutletOrgData.Comments' => 'COMMENTS',
        'comments' => 'COMMENTS',
        'outletOrgData.comments' => 'COMMENTS',
        'OutletOrgDataTableMap::COL_COMMENTS' => 'COMMENTS',
        'COL_COMMENTS' => 'COMMENTS',
        'outlet_org_data.comments' => 'COMMENTS',
        'OrgPotential' => 'ORG_POTENTIAL',
        'OutletOrgData.OrgPotential' => 'ORG_POTENTIAL',
        'orgPotential' => 'ORG_POTENTIAL',
        'outletOrgData.orgPotential' => 'ORG_POTENTIAL',
        'OutletOrgDataTableMap::COL_ORG_POTENTIAL' => 'ORG_POTENTIAL',
        'COL_ORG_POTENTIAL' => 'ORG_POTENTIAL',
        'org_potential' => 'ORG_POTENTIAL',
        'outlet_org_data.org_potential' => 'ORG_POTENTIAL',
        'BrandFocus' => 'BRAND_FOCUS',
        'OutletOrgData.BrandFocus' => 'BRAND_FOCUS',
        'brandFocus' => 'BRAND_FOCUS',
        'outletOrgData.brandFocus' => 'BRAND_FOCUS',
        'OutletOrgDataTableMap::COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'brand_focus' => 'BRAND_FOCUS',
        'outlet_org_data.brand_focus' => 'BRAND_FOCUS',
        'CustomerFq' => 'CUSTOMER_FQ',
        'OutletOrgData.CustomerFq' => 'CUSTOMER_FQ',
        'customerFq' => 'CUSTOMER_FQ',
        'outletOrgData.customerFq' => 'CUSTOMER_FQ',
        'OutletOrgDataTableMap::COL_CUSTOMER_FQ' => 'CUSTOMER_FQ',
        'COL_CUSTOMER_FQ' => 'CUSTOMER_FQ',
        'customer_fq' => 'CUSTOMER_FQ',
        'outlet_org_data.customer_fq' => 'CUSTOMER_FQ',
        'CompanyId' => 'COMPANY_ID',
        'OutletOrgData.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletOrgData.companyId' => 'COMPANY_ID',
        'OutletOrgDataTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_org_data.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'OutletOrgData.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletOrgData.createdAt' => 'CREATED_AT',
        'OutletOrgDataTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_org_data.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletOrgData.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletOrgData.updatedAt' => 'UPDATED_AT',
        'OutletOrgDataTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_org_data.updated_at' => 'UPDATED_AT',
        'Itownid' => 'ITOWNID',
        'OutletOrgData.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'outletOrgData.itownid' => 'ITOWNID',
        'OutletOrgDataTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'outlet_org_data.itownid' => 'ITOWNID',
        'DefaultAddress' => 'DEFAULT_ADDRESS',
        'OutletOrgData.DefaultAddress' => 'DEFAULT_ADDRESS',
        'defaultAddress' => 'DEFAULT_ADDRESS',
        'outletOrgData.defaultAddress' => 'DEFAULT_ADDRESS',
        'OutletOrgDataTableMap::COL_DEFAULT_ADDRESS' => 'DEFAULT_ADDRESS',
        'COL_DEFAULT_ADDRESS' => 'DEFAULT_ADDRESS',
        'default_address' => 'DEFAULT_ADDRESS',
        'outlet_org_data.default_address' => 'DEFAULT_ADDRESS',
        'LastVisitDate' => 'LAST_VISIT_DATE',
        'OutletOrgData.LastVisitDate' => 'LAST_VISIT_DATE',
        'lastVisitDate' => 'LAST_VISIT_DATE',
        'outletOrgData.lastVisitDate' => 'LAST_VISIT_DATE',
        'OutletOrgDataTableMap::COL_LAST_VISIT_DATE' => 'LAST_VISIT_DATE',
        'COL_LAST_VISIT_DATE' => 'LAST_VISIT_DATE',
        'last_visit_date' => 'LAST_VISIT_DATE',
        'outlet_org_data.last_visit_date' => 'LAST_VISIT_DATE',
        'LastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'OutletOrgData.LastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'lastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'outletOrgData.lastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE' => 'LAST_VISIT_EMPLOYEE',
        'COL_LAST_VISIT_EMPLOYEE' => 'LAST_VISIT_EMPLOYEE',
        'last_visit_employee' => 'LAST_VISIT_EMPLOYEE',
        'outlet_org_data.last_visit_employee' => 'LAST_VISIT_EMPLOYEE',
        'OutletOrgCode' => 'OUTLET_ORG_CODE',
        'OutletOrgData.OutletOrgCode' => 'OUTLET_ORG_CODE',
        'outletOrgCode' => 'OUTLET_ORG_CODE',
        'outletOrgData.outletOrgCode' => 'OUTLET_ORG_CODE',
        'OutletOrgDataTableMap::COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'outlet_org_code' => 'OUTLET_ORG_CODE',
        'outlet_org_data.outlet_org_code' => 'OUTLET_ORG_CODE',
        'InvestedAmount' => 'INVESTED_AMOUNT',
        'OutletOrgData.InvestedAmount' => 'INVESTED_AMOUNT',
        'investedAmount' => 'INVESTED_AMOUNT',
        'outletOrgData.investedAmount' => 'INVESTED_AMOUNT',
        'OutletOrgDataTableMap::COL_INVESTED_AMOUNT' => 'INVESTED_AMOUNT',
        'COL_INVESTED_AMOUNT' => 'INVESTED_AMOUNT',
        'invested_amount' => 'INVESTED_AMOUNT',
        'outlet_org_data.invested_amount' => 'INVESTED_AMOUNT',
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
        $this->setName('outlet_org_data');
        $this->setPhpName('OutletOrgData');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletOrgData');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_org_data_outlet_org_id_seq');
        // columns
        $this->addPrimaryKey('outlet_org_id', 'OutletOrgId', 'BIGINT', true, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', true, null, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', true, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, null, null);
        $this->addColumn('visit_fq', 'VisitFq', 'INTEGER', false, null, null);
        $this->addColumn('comments', 'Comments', 'VARCHAR', false, null, null);
        $this->addColumn('org_potential', 'OrgPotential', 'VARCHAR', false, null, null);
        $this->addColumn('brand_focus', 'BrandFocus', 'VARCHAR', false, null, null);
        $this->addColumn('customer_fq', 'CustomerFq', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
        $this->addForeignKey('default_address', 'DefaultAddress', 'INTEGER', 'outlet_address', 'outlet_address_id', false, null, null);
        $this->addColumn('last_visit_date', 'LastVisitDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('last_visit_employee', 'LastVisitEmployee', 'INTEGER', false, null, null);
        $this->addColumn('outlet_org_code', 'OutletOrgCode', 'VARCHAR', false, null, null);
        $this->addColumn('invested_amount', 'InvestedAmount', 'DECIMAL', false, null, 0.00);
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
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OutletAddress', '\\entities\\OutletAddress', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':default_address',
    1 => ':outlet_address_id',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('BeatOutlets', '\\entities\\BeatOutlets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':beat_org_outlet',
    1 => ':outlet_org_id',
  ),
), null, null, 'BeatOutletss', false);
        $this->addRelation('BrandCampiagnDoctors', '\\entities\\BrandCampiagnDoctors', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'BrandCampiagnDoctorss', false);
        $this->addRelation('Dailycalls', '\\entities\\Dailycalls', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'Dailycallss', false);
        $this->addRelation('DailycallsAttendees', '\\entities\\DailycallsAttendees', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'DailycallsAttendeess', false);
        $this->addRelation('DailycallsSgpiout', '\\entities\\DailycallsSgpiout', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_orgdata_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'DailycallsSgpiouts', false);
        $this->addRelation('Dayplan', '\\entities\\Dayplan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'Dayplans', false);
        $this->addRelation('EdFeedbacks', '\\entities\\EdFeedbacks', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'EdFeedbackss', false);
        $this->addRelation('EdSession', '\\entities\\EdSession', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'EdSessions', false);
        $this->addRelation('EdStats', '\\entities\\EdStats', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'EdStatss', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('OutletOrgNotes', '\\entities\\OutletOrgNotes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'OutletOrgNotess', false);
        $this->addRelation('OutletStock', '\\entities\\OutletStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'OutletStocks', false);
        $this->addRelation('OutletStockOtherSummary', '\\entities\\OutletStockOtherSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'OutletStockOtherSummaries', false);
        $this->addRelation('OutletStockSummary', '\\entities\\OutletStockSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'OutletStockSummaries', false);
        $this->addRelation('PrescriberData', '\\entities\\PrescriberData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'PrescriberDatas', false);
        $this->addRelation('Reminders', '\\entities\\Reminders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'Reminderss', false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, 'Tourplanss', false);
        $this->addRelation('OutletOrgDataKeys', '\\entities\\OutletOrgDataKeys', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), 'CASCADE', null, 'OutletOrgDataKeyss', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to outlet_org_data     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        OutletOrgDataKeysTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletOrgDataTableMap::CLASS_DEFAULT : OutletOrgDataTableMap::OM_CLASS;
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
     * @return array (OutletOrgData object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletOrgDataTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletOrgDataTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletOrgDataTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletOrgDataTableMap::OM_CLASS;
            /** @var OutletOrgData $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletOrgDataTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletOrgDataTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletOrgDataTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletOrgData $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletOrgDataTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_TAGS);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_ORG_POTENTIAL);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_BRAND_FOCUS);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_CUSTOMER_FQ);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_LAST_VISIT_DATE);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_OUTLET_ORG_CODE);
            $criteria->addSelectColumn(OutletOrgDataTableMap::COL_INVESTED_AMOUNT);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.visit_fq');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.org_potential');
            $criteria->addSelectColumn($alias . '.brand_focus');
            $criteria->addSelectColumn($alias . '.customer_fq');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.default_address');
            $criteria->addSelectColumn($alias . '.last_visit_date');
            $criteria->addSelectColumn($alias . '.last_visit_employee');
            $criteria->addSelectColumn($alias . '.outlet_org_code');
            $criteria->addSelectColumn($alias . '.invested_amount');
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
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_TAGS);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_COMMENTS);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_ORG_POTENTIAL);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_BRAND_FOCUS);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_CUSTOMER_FQ);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_LAST_VISIT_DATE);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_OUTLET_ORG_CODE);
            $criteria->removeSelectColumn(OutletOrgDataTableMap::COL_INVESTED_AMOUNT);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.visit_fq');
            $criteria->removeSelectColumn($alias . '.comments');
            $criteria->removeSelectColumn($alias . '.org_potential');
            $criteria->removeSelectColumn($alias . '.brand_focus');
            $criteria->removeSelectColumn($alias . '.customer_fq');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.default_address');
            $criteria->removeSelectColumn($alias . '.last_visit_date');
            $criteria->removeSelectColumn($alias . '.last_visit_employee');
            $criteria->removeSelectColumn($alias . '.outlet_org_code');
            $criteria->removeSelectColumn($alias . '.invested_amount');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletOrgDataTableMap::DATABASE_NAME)->getTable(OutletOrgDataTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletOrgData or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletOrgData object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgDataTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletOrgData) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletOrgDataTableMap::DATABASE_NAME);
            $criteria->add(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, (array) $values, Criteria::IN);
        }

        $query = OutletOrgDataQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletOrgDataTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletOrgDataTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_org_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletOrgDataQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletOrgData or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletOrgData object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgDataTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletOrgData object
        }

        if ($criteria->containsKey(OutletOrgDataTableMap::COL_OUTLET_ORG_ID) && $criteria->keyContainsValue(OutletOrgDataTableMap::COL_OUTLET_ORG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletOrgDataTableMap::COL_OUTLET_ORG_ID.')');
        }


        // Set the correct dbName
        $query = OutletOrgDataQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
