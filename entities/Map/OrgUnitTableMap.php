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
use entities\OrgUnit;
use entities\OrgUnitQuery;


/**
 * This class defines the structure of the 'org_unit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrgUnitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OrgUnitTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'org_unit';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OrgUnit';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OrgUnit';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OrgUnit';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'org_unit.orgunitid';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'org_unit.company_id';

    /**
     * the column name for the unit_name field
     */
    public const COL_UNIT_NAME = 'org_unit.unit_name';

    /**
     * the column name for the org_unit_code field
     */
    public const COL_ORG_UNIT_CODE = 'org_unit.org_unit_code';

    /**
     * the column name for the currency_id field
     */
    public const COL_CURRENCY_ID = 'org_unit.currency_id';

    /**
     * the column name for the country_id field
     */
    public const COL_COUNTRY_ID = 'org_unit.country_id';

    /**
     * the column name for the can_do_custom_playlist field
     */
    public const COL_CAN_DO_CUSTOM_PLAYLIST = 'org_unit.can_do_custom_playlist';

    /**
     * the column name for the is_exposed field
     */
    public const COL_IS_EXPOSED = 'org_unit.is_exposed';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'org_unit.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'org_unit.updated_at';

    /**
     * the column name for the orgunit_admin_position field
     */
    public const COL_ORGUNIT_ADMIN_POSITION = 'org_unit.orgunit_admin_position';

    /**
     * the column name for the on_board_required_fileds field
     */
    public const COL_ON_BOARD_REQUIRED_FILEDS = 'org_unit.on_board_required_fileds';

    /**
     * the column name for the punchin_on_weekoff field
     */
    public const COL_PUNCHIN_ON_WEEKOFF = 'org_unit.punchin_on_weekoff';

    /**
     * the column name for the punchin_on_holiday field
     */
    public const COL_PUNCHIN_ON_HOLIDAY = 'org_unit.punchin_on_holiday';

    /**
     * the column name for the punchin_on_leave field
     */
    public const COL_PUNCHIN_ON_LEAVE = 'org_unit.punchin_on_leave';

    /**
     * the column name for the outlet_type field
     */
    public const COL_OUTLET_TYPE = 'org_unit.outlet_type';

    /**
     * the column name for the default_outlet_type field
     */
    public const COL_DEFAULT_OUTLET_TYPE = 'org_unit.default_outlet_type';

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
        self::TYPE_PHPNAME       => ['Orgunitid', 'CompanyId', 'UnitName', 'OrgUnitCode', 'CurrencyId', 'CountryId', 'CanDoCustomPlaylist', 'IsExposed', 'CreatedAt', 'UpdatedAt', 'OrgunitAdminPosition', 'OnBoardRequiredFileds', 'PunchinOnWeekoff', 'PunchinOnHoliday', 'PunchinOnLeave', 'OutletType', 'DefaultOutletType', ],
        self::TYPE_CAMELNAME     => ['orgunitid', 'companyId', 'unitName', 'orgUnitCode', 'currencyId', 'countryId', 'canDoCustomPlaylist', 'isExposed', 'createdAt', 'updatedAt', 'orgunitAdminPosition', 'onBoardRequiredFileds', 'punchinOnWeekoff', 'punchinOnHoliday', 'punchinOnLeave', 'outletType', 'defaultOutletType', ],
        self::TYPE_COLNAME       => [OrgUnitTableMap::COL_ORGUNITID, OrgUnitTableMap::COL_COMPANY_ID, OrgUnitTableMap::COL_UNIT_NAME, OrgUnitTableMap::COL_ORG_UNIT_CODE, OrgUnitTableMap::COL_CURRENCY_ID, OrgUnitTableMap::COL_COUNTRY_ID, OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST, OrgUnitTableMap::COL_IS_EXPOSED, OrgUnitTableMap::COL_CREATED_AT, OrgUnitTableMap::COL_UPDATED_AT, OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION, OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS, OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF, OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY, OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE, OrgUnitTableMap::COL_OUTLET_TYPE, OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE, ],
        self::TYPE_FIELDNAME     => ['orgunitid', 'company_id', 'unit_name', 'org_unit_code', 'currency_id', 'country_id', 'can_do_custom_playlist', 'is_exposed', 'created_at', 'updated_at', 'orgunit_admin_position', 'on_board_required_fileds', 'punchin_on_weekoff', 'punchin_on_holiday', 'punchin_on_leave', 'outlet_type', 'default_outlet_type', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
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
        self::TYPE_PHPNAME       => ['Orgunitid' => 0, 'CompanyId' => 1, 'UnitName' => 2, 'OrgUnitCode' => 3, 'CurrencyId' => 4, 'CountryId' => 5, 'CanDoCustomPlaylist' => 6, 'IsExposed' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'OrgunitAdminPosition' => 10, 'OnBoardRequiredFileds' => 11, 'PunchinOnWeekoff' => 12, 'PunchinOnHoliday' => 13, 'PunchinOnLeave' => 14, 'OutletType' => 15, 'DefaultOutletType' => 16, ],
        self::TYPE_CAMELNAME     => ['orgunitid' => 0, 'companyId' => 1, 'unitName' => 2, 'orgUnitCode' => 3, 'currencyId' => 4, 'countryId' => 5, 'canDoCustomPlaylist' => 6, 'isExposed' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'orgunitAdminPosition' => 10, 'onBoardRequiredFileds' => 11, 'punchinOnWeekoff' => 12, 'punchinOnHoliday' => 13, 'punchinOnLeave' => 14, 'outletType' => 15, 'defaultOutletType' => 16, ],
        self::TYPE_COLNAME       => [OrgUnitTableMap::COL_ORGUNITID => 0, OrgUnitTableMap::COL_COMPANY_ID => 1, OrgUnitTableMap::COL_UNIT_NAME => 2, OrgUnitTableMap::COL_ORG_UNIT_CODE => 3, OrgUnitTableMap::COL_CURRENCY_ID => 4, OrgUnitTableMap::COL_COUNTRY_ID => 5, OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST => 6, OrgUnitTableMap::COL_IS_EXPOSED => 7, OrgUnitTableMap::COL_CREATED_AT => 8, OrgUnitTableMap::COL_UPDATED_AT => 9, OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION => 10, OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS => 11, OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF => 12, OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY => 13, OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE => 14, OrgUnitTableMap::COL_OUTLET_TYPE => 15, OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE => 16, ],
        self::TYPE_FIELDNAME     => ['orgunitid' => 0, 'company_id' => 1, 'unit_name' => 2, 'org_unit_code' => 3, 'currency_id' => 4, 'country_id' => 5, 'can_do_custom_playlist' => 6, 'is_exposed' => 7, 'created_at' => 8, 'updated_at' => 9, 'orgunit_admin_position' => 10, 'on_board_required_fileds' => 11, 'punchin_on_weekoff' => 12, 'punchin_on_holiday' => 13, 'punchin_on_leave' => 14, 'outlet_type' => 15, 'default_outlet_type' => 16, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Orgunitid' => 'ORGUNITID',
        'OrgUnit.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'orgUnit.orgunitid' => 'ORGUNITID',
        'OrgUnitTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'org_unit.orgunitid' => 'ORGUNITID',
        'CompanyId' => 'COMPANY_ID',
        'OrgUnit.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'orgUnit.companyId' => 'COMPANY_ID',
        'OrgUnitTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'org_unit.company_id' => 'COMPANY_ID',
        'UnitName' => 'UNIT_NAME',
        'OrgUnit.UnitName' => 'UNIT_NAME',
        'unitName' => 'UNIT_NAME',
        'orgUnit.unitName' => 'UNIT_NAME',
        'OrgUnitTableMap::COL_UNIT_NAME' => 'UNIT_NAME',
        'COL_UNIT_NAME' => 'UNIT_NAME',
        'unit_name' => 'UNIT_NAME',
        'org_unit.unit_name' => 'UNIT_NAME',
        'OrgUnitCode' => 'ORG_UNIT_CODE',
        'OrgUnit.OrgUnitCode' => 'ORG_UNIT_CODE',
        'orgUnitCode' => 'ORG_UNIT_CODE',
        'orgUnit.orgUnitCode' => 'ORG_UNIT_CODE',
        'OrgUnitTableMap::COL_ORG_UNIT_CODE' => 'ORG_UNIT_CODE',
        'COL_ORG_UNIT_CODE' => 'ORG_UNIT_CODE',
        'org_unit_code' => 'ORG_UNIT_CODE',
        'org_unit.org_unit_code' => 'ORG_UNIT_CODE',
        'CurrencyId' => 'CURRENCY_ID',
        'OrgUnit.CurrencyId' => 'CURRENCY_ID',
        'currencyId' => 'CURRENCY_ID',
        'orgUnit.currencyId' => 'CURRENCY_ID',
        'OrgUnitTableMap::COL_CURRENCY_ID' => 'CURRENCY_ID',
        'COL_CURRENCY_ID' => 'CURRENCY_ID',
        'currency_id' => 'CURRENCY_ID',
        'org_unit.currency_id' => 'CURRENCY_ID',
        'CountryId' => 'COUNTRY_ID',
        'OrgUnit.CountryId' => 'COUNTRY_ID',
        'countryId' => 'COUNTRY_ID',
        'orgUnit.countryId' => 'COUNTRY_ID',
        'OrgUnitTableMap::COL_COUNTRY_ID' => 'COUNTRY_ID',
        'COL_COUNTRY_ID' => 'COUNTRY_ID',
        'country_id' => 'COUNTRY_ID',
        'org_unit.country_id' => 'COUNTRY_ID',
        'CanDoCustomPlaylist' => 'CAN_DO_CUSTOM_PLAYLIST',
        'OrgUnit.CanDoCustomPlaylist' => 'CAN_DO_CUSTOM_PLAYLIST',
        'canDoCustomPlaylist' => 'CAN_DO_CUSTOM_PLAYLIST',
        'orgUnit.canDoCustomPlaylist' => 'CAN_DO_CUSTOM_PLAYLIST',
        'OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST' => 'CAN_DO_CUSTOM_PLAYLIST',
        'COL_CAN_DO_CUSTOM_PLAYLIST' => 'CAN_DO_CUSTOM_PLAYLIST',
        'can_do_custom_playlist' => 'CAN_DO_CUSTOM_PLAYLIST',
        'org_unit.can_do_custom_playlist' => 'CAN_DO_CUSTOM_PLAYLIST',
        'IsExposed' => 'IS_EXPOSED',
        'OrgUnit.IsExposed' => 'IS_EXPOSED',
        'isExposed' => 'IS_EXPOSED',
        'orgUnit.isExposed' => 'IS_EXPOSED',
        'OrgUnitTableMap::COL_IS_EXPOSED' => 'IS_EXPOSED',
        'COL_IS_EXPOSED' => 'IS_EXPOSED',
        'is_exposed' => 'IS_EXPOSED',
        'org_unit.is_exposed' => 'IS_EXPOSED',
        'CreatedAt' => 'CREATED_AT',
        'OrgUnit.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'orgUnit.createdAt' => 'CREATED_AT',
        'OrgUnitTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'org_unit.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OrgUnit.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'orgUnit.updatedAt' => 'UPDATED_AT',
        'OrgUnitTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'org_unit.updated_at' => 'UPDATED_AT',
        'OrgunitAdminPosition' => 'ORGUNIT_ADMIN_POSITION',
        'OrgUnit.OrgunitAdminPosition' => 'ORGUNIT_ADMIN_POSITION',
        'orgunitAdminPosition' => 'ORGUNIT_ADMIN_POSITION',
        'orgUnit.orgunitAdminPosition' => 'ORGUNIT_ADMIN_POSITION',
        'OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION' => 'ORGUNIT_ADMIN_POSITION',
        'COL_ORGUNIT_ADMIN_POSITION' => 'ORGUNIT_ADMIN_POSITION',
        'orgunit_admin_position' => 'ORGUNIT_ADMIN_POSITION',
        'org_unit.orgunit_admin_position' => 'ORGUNIT_ADMIN_POSITION',
        'OnBoardRequiredFileds' => 'ON_BOARD_REQUIRED_FILEDS',
        'OrgUnit.OnBoardRequiredFileds' => 'ON_BOARD_REQUIRED_FILEDS',
        'onBoardRequiredFileds' => 'ON_BOARD_REQUIRED_FILEDS',
        'orgUnit.onBoardRequiredFileds' => 'ON_BOARD_REQUIRED_FILEDS',
        'OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS' => 'ON_BOARD_REQUIRED_FILEDS',
        'COL_ON_BOARD_REQUIRED_FILEDS' => 'ON_BOARD_REQUIRED_FILEDS',
        'on_board_required_fileds' => 'ON_BOARD_REQUIRED_FILEDS',
        'org_unit.on_board_required_fileds' => 'ON_BOARD_REQUIRED_FILEDS',
        'PunchinOnWeekoff' => 'PUNCHIN_ON_WEEKOFF',
        'OrgUnit.PunchinOnWeekoff' => 'PUNCHIN_ON_WEEKOFF',
        'punchinOnWeekoff' => 'PUNCHIN_ON_WEEKOFF',
        'orgUnit.punchinOnWeekoff' => 'PUNCHIN_ON_WEEKOFF',
        'OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF' => 'PUNCHIN_ON_WEEKOFF',
        'COL_PUNCHIN_ON_WEEKOFF' => 'PUNCHIN_ON_WEEKOFF',
        'punchin_on_weekoff' => 'PUNCHIN_ON_WEEKOFF',
        'org_unit.punchin_on_weekoff' => 'PUNCHIN_ON_WEEKOFF',
        'PunchinOnHoliday' => 'PUNCHIN_ON_HOLIDAY',
        'OrgUnit.PunchinOnHoliday' => 'PUNCHIN_ON_HOLIDAY',
        'punchinOnHoliday' => 'PUNCHIN_ON_HOLIDAY',
        'orgUnit.punchinOnHoliday' => 'PUNCHIN_ON_HOLIDAY',
        'OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY' => 'PUNCHIN_ON_HOLIDAY',
        'COL_PUNCHIN_ON_HOLIDAY' => 'PUNCHIN_ON_HOLIDAY',
        'punchin_on_holiday' => 'PUNCHIN_ON_HOLIDAY',
        'org_unit.punchin_on_holiday' => 'PUNCHIN_ON_HOLIDAY',
        'PunchinOnLeave' => 'PUNCHIN_ON_LEAVE',
        'OrgUnit.PunchinOnLeave' => 'PUNCHIN_ON_LEAVE',
        'punchinOnLeave' => 'PUNCHIN_ON_LEAVE',
        'orgUnit.punchinOnLeave' => 'PUNCHIN_ON_LEAVE',
        'OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE' => 'PUNCHIN_ON_LEAVE',
        'COL_PUNCHIN_ON_LEAVE' => 'PUNCHIN_ON_LEAVE',
        'punchin_on_leave' => 'PUNCHIN_ON_LEAVE',
        'org_unit.punchin_on_leave' => 'PUNCHIN_ON_LEAVE',
        'OutletType' => 'OUTLET_TYPE',
        'OrgUnit.OutletType' => 'OUTLET_TYPE',
        'outletType' => 'OUTLET_TYPE',
        'orgUnit.outletType' => 'OUTLET_TYPE',
        'OrgUnitTableMap::COL_OUTLET_TYPE' => 'OUTLET_TYPE',
        'COL_OUTLET_TYPE' => 'OUTLET_TYPE',
        'outlet_type' => 'OUTLET_TYPE',
        'org_unit.outlet_type' => 'OUTLET_TYPE',
        'DefaultOutletType' => 'DEFAULT_OUTLET_TYPE',
        'OrgUnit.DefaultOutletType' => 'DEFAULT_OUTLET_TYPE',
        'defaultOutletType' => 'DEFAULT_OUTLET_TYPE',
        'orgUnit.defaultOutletType' => 'DEFAULT_OUTLET_TYPE',
        'OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE' => 'DEFAULT_OUTLET_TYPE',
        'COL_DEFAULT_OUTLET_TYPE' => 'DEFAULT_OUTLET_TYPE',
        'default_outlet_type' => 'DEFAULT_OUTLET_TYPE',
        'org_unit.default_outlet_type' => 'DEFAULT_OUTLET_TYPE',
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
        $this->setName('org_unit');
        $this->setPhpName('OrgUnit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OrgUnit');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('org_unit_orgunitid_seq');
        // columns
        $this->addPrimaryKey('orgunitid', 'Orgunitid', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('unit_name', 'UnitName', 'VARCHAR', true, 150, '0');
        $this->addColumn('org_unit_code', 'OrgUnitCode', 'VARCHAR', false, 255, '0');
        $this->addForeignKey('currency_id', 'CurrencyId', 'INTEGER', 'currencies', 'currency_id', true, null, null);
        $this->addForeignKey('country_id', 'CountryId', 'INTEGER', 'geo_country', 'icountryid', true, null, 1);
        $this->addColumn('can_do_custom_playlist', 'CanDoCustomPlaylist', 'BOOLEAN', false, 1, null);
        $this->addColumn('is_exposed', 'IsExposed', 'BOOLEAN', false, 1, false);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('orgunit_admin_position', 'OrgunitAdminPosition', 'INTEGER', false, null, null);
        $this->addColumn('on_board_required_fileds', 'OnBoardRequiredFileds', 'JSON', false, null, null);
        $this->addColumn('punchin_on_weekoff', 'PunchinOnWeekoff', 'BOOLEAN', false, 1, false);
        $this->addColumn('punchin_on_holiday', 'PunchinOnHoliday', 'BOOLEAN', false, 1, false);
        $this->addColumn('punchin_on_leave', 'PunchinOnLeave', 'BOOLEAN', false, 1, false);
        $this->addColumn('outlet_type', 'OutletType', 'VARCHAR', false, null, null);
        $this->addColumn('default_outlet_type', 'DefaultOutletType', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GeoCountry', '\\entities\\GeoCountry', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':country_id',
    1 => ':icountryid',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Currencies', '\\entities\\Currencies', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':currency_id',
    1 => ':currency_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Agendatypes', '\\entities\\Agendatypes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'Agendatypess', false);
        $this->addRelation('AuditEmpUnits', '\\entities\\AuditEmpUnits', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), 'CASCADE', null, 'AuditEmpUnitss', false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'Beatss', false);
        $this->addRelation('BrandCampiagn', '\\entities\\BrandCampiagn', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'BrandCampiagns', false);
        $this->addRelation('BrandCompetition', '\\entities\\BrandCompetition', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'BrandCompetitions', false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'Brandss', false);
        $this->addRelation('Categories', '\\entities\\Categories', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, 'Categoriess', false);
        $this->addRelation('Classification', '\\entities\\Classification', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'Classifications', false);
        $this->addRelation('EdPlaylist', '\\entities\\EdPlaylist', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, 'EdPlaylists', false);
        $this->addRelation('EdPresentations', '\\entities\\EdPresentations', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, 'EdPresentationss', false);
        $this->addRelation('EdStats', '\\entities\\EdStats', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'EdStatss', false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'Employees', false);
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, 'Expensess', false);
        $this->addRelation('Offers', '\\entities\\Offers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'Offerss', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('OnBoardRequiredFields', '\\entities\\OnBoardRequiredFields', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'OnBoardRequiredFieldss', false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'OutletOrgDatas', false);
        $this->addRelation('OutletOrgNotes', '\\entities\\OutletOrgNotes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'OutletOrgNotess', false);
        $this->addRelation('OutletStock', '\\entities\\OutletStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'OutletStocks', false);
        $this->addRelation('OutletStockOtherSummary', '\\entities\\OutletStockOtherSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'OutletStockOtherSummaries', false);
        $this->addRelation('OutletStockSummary', '\\entities\\OutletStockSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'OutletStockSummaries', false);
        $this->addRelation('PolicyMaster', '\\entities\\PolicyMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), 'CASCADE', null, 'PolicyMasters', false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'Positionss', false);
        $this->addRelation('PrescriberData', '\\entities\\PrescriberData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, 'PrescriberDatas', false);
        $this->addRelation('PrescriberTallySummary', '\\entities\\PrescriberTallySummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, 'PrescriberTallySummaries', false);
        $this->addRelation('Pricebooks', '\\entities\\Pricebooks', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_id',
    1 => ':orgunitid',
  ),
), null, null, 'Pricebookss', false);
        $this->addRelation('SgpiMaster', '\\entities\\SgpiMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, 'SgpiMasters', false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, 'Territoriess', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to org_unit     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        AuditEmpUnitsTableMap::clearInstancePool();
        PolicyMasterTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OrgUnitTableMap::CLASS_DEFAULT : OrgUnitTableMap::OM_CLASS;
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
     * @return array (OrgUnit object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OrgUnitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrgUnitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrgUnitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrgUnitTableMap::OM_CLASS;
            /** @var OrgUnit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrgUnitTableMap::addInstanceToPool($obj, $key);
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
            $key = OrgUnitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrgUnitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OrgUnit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrgUnitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrgUnitTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_UNIT_NAME);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_ORG_UNIT_CODE);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_CURRENCY_ID);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_COUNTRY_ID);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_IS_EXPOSED);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_OUTLET_TYPE);
            $criteria->addSelectColumn(OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE);
        } else {
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.unit_name');
            $criteria->addSelectColumn($alias . '.org_unit_code');
            $criteria->addSelectColumn($alias . '.currency_id');
            $criteria->addSelectColumn($alias . '.country_id');
            $criteria->addSelectColumn($alias . '.can_do_custom_playlist');
            $criteria->addSelectColumn($alias . '.is_exposed');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.orgunit_admin_position');
            $criteria->addSelectColumn($alias . '.on_board_required_fileds');
            $criteria->addSelectColumn($alias . '.punchin_on_weekoff');
            $criteria->addSelectColumn($alias . '.punchin_on_holiday');
            $criteria->addSelectColumn($alias . '.punchin_on_leave');
            $criteria->addSelectColumn($alias . '.outlet_type');
            $criteria->addSelectColumn($alias . '.default_outlet_type');
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
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_UNIT_NAME);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_ORG_UNIT_CODE);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_CURRENCY_ID);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_COUNTRY_ID);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_CAN_DO_CUSTOM_PLAYLIST);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_IS_EXPOSED);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_ORGUNIT_ADMIN_POSITION);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_ON_BOARD_REQUIRED_FILEDS);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_PUNCHIN_ON_WEEKOFF);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_PUNCHIN_ON_HOLIDAY);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_PUNCHIN_ON_LEAVE);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_OUTLET_TYPE);
            $criteria->removeSelectColumn(OrgUnitTableMap::COL_DEFAULT_OUTLET_TYPE);
        } else {
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.unit_name');
            $criteria->removeSelectColumn($alias . '.org_unit_code');
            $criteria->removeSelectColumn($alias . '.currency_id');
            $criteria->removeSelectColumn($alias . '.country_id');
            $criteria->removeSelectColumn($alias . '.can_do_custom_playlist');
            $criteria->removeSelectColumn($alias . '.is_exposed');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.orgunit_admin_position');
            $criteria->removeSelectColumn($alias . '.on_board_required_fileds');
            $criteria->removeSelectColumn($alias . '.punchin_on_weekoff');
            $criteria->removeSelectColumn($alias . '.punchin_on_holiday');
            $criteria->removeSelectColumn($alias . '.punchin_on_leave');
            $criteria->removeSelectColumn($alias . '.outlet_type');
            $criteria->removeSelectColumn($alias . '.default_outlet_type');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrgUnitTableMap::DATABASE_NAME)->getTable(OrgUnitTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OrgUnit or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OrgUnit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrgUnitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OrgUnit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrgUnitTableMap::DATABASE_NAME);
            $criteria->add(OrgUnitTableMap::COL_ORGUNITID, (array) $values, Criteria::IN);
        }

        $query = OrgUnitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrgUnitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrgUnitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the org_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OrgUnitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OrgUnit or Criteria object.
     *
     * @param mixed $criteria Criteria or OrgUnit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrgUnitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OrgUnit object
        }

        if ($criteria->containsKey(OrgUnitTableMap::COL_ORGUNITID) && $criteria->keyContainsValue(OrgUnitTableMap::COL_ORGUNITID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrgUnitTableMap::COL_ORGUNITID.')');
        }


        // Set the correct dbName
        $query = OrgUnitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
