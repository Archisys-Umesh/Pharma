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
use entities\OutletAddressView;
use entities\OutletAddressViewQuery;


/**
 * This class defines the structure of the 'outlet_address_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletAddressViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletAddressViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_address_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletAddressView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletAddressView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletAddressView';

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
     * the column name for the outlet_address_id field
     */
    public const COL_OUTLET_ADDRESS_ID = 'outlet_address_view.outlet_address_id';

    /**
     * the column name for the outlet_address field
     */
    public const COL_OUTLET_ADDRESS = 'outlet_address_view.outlet_address';

    /**
     * the column name for the outlet_street_name field
     */
    public const COL_OUTLET_STREET_NAME = 'outlet_address_view.outlet_street_name';

    /**
     * the column name for the outlet_city field
     */
    public const COL_OUTLET_CITY = 'outlet_address_view.outlet_city';

    /**
     * the column name for the outlet_state field
     */
    public const COL_OUTLET_STATE = 'outlet_address_view.outlet_state';

    /**
     * the column name for the outlet_country field
     */
    public const COL_OUTLET_COUNTRY = 'outlet_address_view.outlet_country';

    /**
     * the column name for the outlet_pincode field
     */
    public const COL_OUTLET_PINCODE = 'outlet_address_view.outlet_pincode';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_address_view.outlet_id';

    /**
     * the column name for the outlet_gps field
     */
    public const COL_OUTLET_GPS = 'outlet_address_view.outlet_gps';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_address_view.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_address_view.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_address_view.updated_at';

    /**
     * the column name for the address_name field
     */
    public const COL_ADDRESS_NAME = 'outlet_address_view.address_name';

    /**
     * the column name for the is_default field
     */
    public const COL_IS_DEFAULT = 'outlet_address_view.is_default';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'outlet_address_view.outlet_org_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'outlet_address_view.org_unit_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'outlet_address_view.territory_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'outlet_address_view.territory_name';

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
        self::TYPE_PHPNAME       => ['OutletAddressId', 'OutletAddress', 'OutletStreetName', 'OutletCity', 'OutletState', 'OutletCountry', 'OutletPincode', 'OutletId', 'OutletGps', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'AddressName', 'IsDefault', 'OutletOrgId', 'OrgUnitId', 'TerritoryId', 'TerritoryName', ],
        self::TYPE_CAMELNAME     => ['outletAddressId', 'outletAddress', 'outletStreetName', 'outletCity', 'outletState', 'outletCountry', 'outletPincode', 'outletId', 'outletGps', 'companyId', 'createdAt', 'updatedAt', 'addressName', 'isDefault', 'outletOrgId', 'orgUnitId', 'territoryId', 'territoryName', ],
        self::TYPE_COLNAME       => [OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, OutletAddressViewTableMap::COL_OUTLET_ADDRESS, OutletAddressViewTableMap::COL_OUTLET_STREET_NAME, OutletAddressViewTableMap::COL_OUTLET_CITY, OutletAddressViewTableMap::COL_OUTLET_STATE, OutletAddressViewTableMap::COL_OUTLET_COUNTRY, OutletAddressViewTableMap::COL_OUTLET_PINCODE, OutletAddressViewTableMap::COL_OUTLET_ID, OutletAddressViewTableMap::COL_OUTLET_GPS, OutletAddressViewTableMap::COL_COMPANY_ID, OutletAddressViewTableMap::COL_CREATED_AT, OutletAddressViewTableMap::COL_UPDATED_AT, OutletAddressViewTableMap::COL_ADDRESS_NAME, OutletAddressViewTableMap::COL_IS_DEFAULT, OutletAddressViewTableMap::COL_OUTLET_ORG_ID, OutletAddressViewTableMap::COL_ORG_UNIT_ID, OutletAddressViewTableMap::COL_TERRITORY_ID, OutletAddressViewTableMap::COL_TERRITORY_NAME, ],
        self::TYPE_FIELDNAME     => ['outlet_address_id', 'outlet_address', 'outlet_street_name', 'outlet_city', 'outlet_state', 'outlet_country', 'outlet_pincode', 'outlet_id', 'outlet_gps', 'company_id', 'created_at', 'updated_at', 'address_name', 'is_default', 'outlet_org_id', 'org_unit_id', 'territory_id', 'territory_name', ],
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
        self::TYPE_PHPNAME       => ['OutletAddressId' => 0, 'OutletAddress' => 1, 'OutletStreetName' => 2, 'OutletCity' => 3, 'OutletState' => 4, 'OutletCountry' => 5, 'OutletPincode' => 6, 'OutletId' => 7, 'OutletGps' => 8, 'CompanyId' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'AddressName' => 12, 'IsDefault' => 13, 'OutletOrgId' => 14, 'OrgUnitId' => 15, 'TerritoryId' => 16, 'TerritoryName' => 17, ],
        self::TYPE_CAMELNAME     => ['outletAddressId' => 0, 'outletAddress' => 1, 'outletStreetName' => 2, 'outletCity' => 3, 'outletState' => 4, 'outletCountry' => 5, 'outletPincode' => 6, 'outletId' => 7, 'outletGps' => 8, 'companyId' => 9, 'createdAt' => 10, 'updatedAt' => 11, 'addressName' => 12, 'isDefault' => 13, 'outletOrgId' => 14, 'orgUnitId' => 15, 'territoryId' => 16, 'territoryName' => 17, ],
        self::TYPE_COLNAME       => [OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID => 0, OutletAddressViewTableMap::COL_OUTLET_ADDRESS => 1, OutletAddressViewTableMap::COL_OUTLET_STREET_NAME => 2, OutletAddressViewTableMap::COL_OUTLET_CITY => 3, OutletAddressViewTableMap::COL_OUTLET_STATE => 4, OutletAddressViewTableMap::COL_OUTLET_COUNTRY => 5, OutletAddressViewTableMap::COL_OUTLET_PINCODE => 6, OutletAddressViewTableMap::COL_OUTLET_ID => 7, OutletAddressViewTableMap::COL_OUTLET_GPS => 8, OutletAddressViewTableMap::COL_COMPANY_ID => 9, OutletAddressViewTableMap::COL_CREATED_AT => 10, OutletAddressViewTableMap::COL_UPDATED_AT => 11, OutletAddressViewTableMap::COL_ADDRESS_NAME => 12, OutletAddressViewTableMap::COL_IS_DEFAULT => 13, OutletAddressViewTableMap::COL_OUTLET_ORG_ID => 14, OutletAddressViewTableMap::COL_ORG_UNIT_ID => 15, OutletAddressViewTableMap::COL_TERRITORY_ID => 16, OutletAddressViewTableMap::COL_TERRITORY_NAME => 17, ],
        self::TYPE_FIELDNAME     => ['outlet_address_id' => 0, 'outlet_address' => 1, 'outlet_street_name' => 2, 'outlet_city' => 3, 'outlet_state' => 4, 'outlet_country' => 5, 'outlet_pincode' => 6, 'outlet_id' => 7, 'outlet_gps' => 8, 'company_id' => 9, 'created_at' => 10, 'updated_at' => 11, 'address_name' => 12, 'is_default' => 13, 'outlet_org_id' => 14, 'org_unit_id' => 15, 'territory_id' => 16, 'territory_name' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletAddressId' => 'OUTLET_ADDRESS_ID',
        'OutletAddressView.OutletAddressId' => 'OUTLET_ADDRESS_ID',
        'outletAddressId' => 'OUTLET_ADDRESS_ID',
        'outletAddressView.outletAddressId' => 'OUTLET_ADDRESS_ID',
        'OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID' => 'OUTLET_ADDRESS_ID',
        'COL_OUTLET_ADDRESS_ID' => 'OUTLET_ADDRESS_ID',
        'outlet_address_id' => 'OUTLET_ADDRESS_ID',
        'outlet_address_view.outlet_address_id' => 'OUTLET_ADDRESS_ID',
        'OutletAddress' => 'OUTLET_ADDRESS',
        'OutletAddressView.OutletAddress' => 'OUTLET_ADDRESS',
        'outletAddress' => 'OUTLET_ADDRESS',
        'outletAddressView.outletAddress' => 'OUTLET_ADDRESS',
        'OutletAddressViewTableMap::COL_OUTLET_ADDRESS' => 'OUTLET_ADDRESS',
        'COL_OUTLET_ADDRESS' => 'OUTLET_ADDRESS',
        'outlet_address' => 'OUTLET_ADDRESS',
        'outlet_address_view.outlet_address' => 'OUTLET_ADDRESS',
        'OutletStreetName' => 'OUTLET_STREET_NAME',
        'OutletAddressView.OutletStreetName' => 'OUTLET_STREET_NAME',
        'outletStreetName' => 'OUTLET_STREET_NAME',
        'outletAddressView.outletStreetName' => 'OUTLET_STREET_NAME',
        'OutletAddressViewTableMap::COL_OUTLET_STREET_NAME' => 'OUTLET_STREET_NAME',
        'COL_OUTLET_STREET_NAME' => 'OUTLET_STREET_NAME',
        'outlet_street_name' => 'OUTLET_STREET_NAME',
        'outlet_address_view.outlet_street_name' => 'OUTLET_STREET_NAME',
        'OutletCity' => 'OUTLET_CITY',
        'OutletAddressView.OutletCity' => 'OUTLET_CITY',
        'outletCity' => 'OUTLET_CITY',
        'outletAddressView.outletCity' => 'OUTLET_CITY',
        'OutletAddressViewTableMap::COL_OUTLET_CITY' => 'OUTLET_CITY',
        'COL_OUTLET_CITY' => 'OUTLET_CITY',
        'outlet_city' => 'OUTLET_CITY',
        'outlet_address_view.outlet_city' => 'OUTLET_CITY',
        'OutletState' => 'OUTLET_STATE',
        'OutletAddressView.OutletState' => 'OUTLET_STATE',
        'outletState' => 'OUTLET_STATE',
        'outletAddressView.outletState' => 'OUTLET_STATE',
        'OutletAddressViewTableMap::COL_OUTLET_STATE' => 'OUTLET_STATE',
        'COL_OUTLET_STATE' => 'OUTLET_STATE',
        'outlet_state' => 'OUTLET_STATE',
        'outlet_address_view.outlet_state' => 'OUTLET_STATE',
        'OutletCountry' => 'OUTLET_COUNTRY',
        'OutletAddressView.OutletCountry' => 'OUTLET_COUNTRY',
        'outletCountry' => 'OUTLET_COUNTRY',
        'outletAddressView.outletCountry' => 'OUTLET_COUNTRY',
        'OutletAddressViewTableMap::COL_OUTLET_COUNTRY' => 'OUTLET_COUNTRY',
        'COL_OUTLET_COUNTRY' => 'OUTLET_COUNTRY',
        'outlet_country' => 'OUTLET_COUNTRY',
        'outlet_address_view.outlet_country' => 'OUTLET_COUNTRY',
        'OutletPincode' => 'OUTLET_PINCODE',
        'OutletAddressView.OutletPincode' => 'OUTLET_PINCODE',
        'outletPincode' => 'OUTLET_PINCODE',
        'outletAddressView.outletPincode' => 'OUTLET_PINCODE',
        'OutletAddressViewTableMap::COL_OUTLET_PINCODE' => 'OUTLET_PINCODE',
        'COL_OUTLET_PINCODE' => 'OUTLET_PINCODE',
        'outlet_pincode' => 'OUTLET_PINCODE',
        'outlet_address_view.outlet_pincode' => 'OUTLET_PINCODE',
        'OutletId' => 'OUTLET_ID',
        'OutletAddressView.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletAddressView.outletId' => 'OUTLET_ID',
        'OutletAddressViewTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_address_view.outlet_id' => 'OUTLET_ID',
        'OutletGps' => 'OUTLET_GPS',
        'OutletAddressView.OutletGps' => 'OUTLET_GPS',
        'outletGps' => 'OUTLET_GPS',
        'outletAddressView.outletGps' => 'OUTLET_GPS',
        'OutletAddressViewTableMap::COL_OUTLET_GPS' => 'OUTLET_GPS',
        'COL_OUTLET_GPS' => 'OUTLET_GPS',
        'outlet_gps' => 'OUTLET_GPS',
        'outlet_address_view.outlet_gps' => 'OUTLET_GPS',
        'CompanyId' => 'COMPANY_ID',
        'OutletAddressView.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletAddressView.companyId' => 'COMPANY_ID',
        'OutletAddressViewTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_address_view.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'OutletAddressView.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletAddressView.createdAt' => 'CREATED_AT',
        'OutletAddressViewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_address_view.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletAddressView.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletAddressView.updatedAt' => 'UPDATED_AT',
        'OutletAddressViewTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_address_view.updated_at' => 'UPDATED_AT',
        'AddressName' => 'ADDRESS_NAME',
        'OutletAddressView.AddressName' => 'ADDRESS_NAME',
        'addressName' => 'ADDRESS_NAME',
        'outletAddressView.addressName' => 'ADDRESS_NAME',
        'OutletAddressViewTableMap::COL_ADDRESS_NAME' => 'ADDRESS_NAME',
        'COL_ADDRESS_NAME' => 'ADDRESS_NAME',
        'address_name' => 'ADDRESS_NAME',
        'outlet_address_view.address_name' => 'ADDRESS_NAME',
        'IsDefault' => 'IS_DEFAULT',
        'OutletAddressView.IsDefault' => 'IS_DEFAULT',
        'isDefault' => 'IS_DEFAULT',
        'outletAddressView.isDefault' => 'IS_DEFAULT',
        'OutletAddressViewTableMap::COL_IS_DEFAULT' => 'IS_DEFAULT',
        'COL_IS_DEFAULT' => 'IS_DEFAULT',
        'is_default' => 'IS_DEFAULT',
        'outlet_address_view.is_default' => 'IS_DEFAULT',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'OutletAddressView.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'outletAddressView.outletOrgId' => 'OUTLET_ORG_ID',
        'OutletAddressViewTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'outlet_address_view.outlet_org_id' => 'OUTLET_ORG_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'OutletAddressView.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'outletAddressView.orgUnitId' => 'ORG_UNIT_ID',
        'OutletAddressViewTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'outlet_address_view.org_unit_id' => 'ORG_UNIT_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'OutletAddressView.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'outletAddressView.territoryId' => 'TERRITORY_ID',
        'OutletAddressViewTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'outlet_address_view.territory_id' => 'TERRITORY_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'OutletAddressView.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'outletAddressView.territoryName' => 'TERRITORY_NAME',
        'OutletAddressViewTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'outlet_address_view.territory_name' => 'TERRITORY_NAME',
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
        $this->setName('outlet_address_view');
        $this->setPhpName('OutletAddressView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletAddressView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('outlet_address_id', 'OutletAddressId', 'INTEGER', true, null, null);
        $this->addColumn('outlet_address', 'OutletAddress', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_street_name', 'OutletStreetName', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_city', 'OutletCity', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_state', 'OutletState', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_country', 'OutletCountry', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_pincode', 'OutletPincode', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_id', 'OutletId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_gps', 'OutletGps', 'VARCHAR', false, 50, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('address_name', 'AddressName', 'VARCHAR', false, 50, null);
        $this->addColumn('is_default', 'IsDefault', 'INTEGER', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('org_unit_id', 'OrgUnitId', 'INTEGER', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, 50, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletAddressId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletAddressId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletAddressId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletAddressId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletAddressId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletAddressId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletAddressId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletAddressViewTableMap::CLASS_DEFAULT : OutletAddressViewTableMap::OM_CLASS;
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
     * @return array (OutletAddressView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletAddressViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletAddressViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletAddressViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletAddressViewTableMap::OM_CLASS;
            /** @var OutletAddressView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletAddressViewTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletAddressViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletAddressViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletAddressView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletAddressViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_ADDRESS);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_STREET_NAME);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_CITY);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_STATE);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_COUNTRY);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_PINCODE);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_GPS);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_ADDRESS_NAME);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_IS_DEFAULT);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(OutletAddressViewTableMap::COL_TERRITORY_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_address_id');
            $criteria->addSelectColumn($alias . '.outlet_address');
            $criteria->addSelectColumn($alias . '.outlet_street_name');
            $criteria->addSelectColumn($alias . '.outlet_city');
            $criteria->addSelectColumn($alias . '.outlet_state');
            $criteria->addSelectColumn($alias . '.outlet_country');
            $criteria->addSelectColumn($alias . '.outlet_pincode');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.outlet_gps');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.address_name');
            $criteria->addSelectColumn($alias . '.is_default');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.territory_name');
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
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_ADDRESS);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_STREET_NAME);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_CITY);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_STATE);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_COUNTRY);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_PINCODE);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_GPS);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_ADDRESS_NAME);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_IS_DEFAULT);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(OutletAddressViewTableMap::COL_TERRITORY_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_address_id');
            $criteria->removeSelectColumn($alias . '.outlet_address');
            $criteria->removeSelectColumn($alias . '.outlet_street_name');
            $criteria->removeSelectColumn($alias . '.outlet_city');
            $criteria->removeSelectColumn($alias . '.outlet_state');
            $criteria->removeSelectColumn($alias . '.outlet_country');
            $criteria->removeSelectColumn($alias . '.outlet_pincode');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.outlet_gps');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.address_name');
            $criteria->removeSelectColumn($alias . '.is_default');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.territory_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletAddressViewTableMap::DATABASE_NAME)->getTable(OutletAddressViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletAddressView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletAddressView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAddressViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletAddressView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletAddressViewTableMap::DATABASE_NAME);
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, (array) $values, Criteria::IN);
        }

        $query = OutletAddressViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletAddressViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletAddressViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_address_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletAddressViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletAddressView or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletAddressView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAddressViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletAddressView object
        }


        // Set the correct dbName
        $query = OutletAddressViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
