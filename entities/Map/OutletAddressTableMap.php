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
use entities\OutletAddress;
use entities\OutletAddressQuery;


/**
 * This class defines the structure of the 'outlet_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_address';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletAddress';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletAddress';

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
     * the column name for the outlet_address_id field
     */
    public const COL_OUTLET_ADDRESS_ID = 'outlet_address.outlet_address_id';

    /**
     * the column name for the outlet_address field
     */
    public const COL_OUTLET_ADDRESS = 'outlet_address.outlet_address';

    /**
     * the column name for the outlet_street_name field
     */
    public const COL_OUTLET_STREET_NAME = 'outlet_address.outlet_street_name';

    /**
     * the column name for the outlet_city field
     */
    public const COL_OUTLET_CITY = 'outlet_address.outlet_city';

    /**
     * the column name for the outlet_state field
     */
    public const COL_OUTLET_STATE = 'outlet_address.outlet_state';

    /**
     * the column name for the outlet_country field
     */
    public const COL_OUTLET_COUNTRY = 'outlet_address.outlet_country';

    /**
     * the column name for the outlet_pincode field
     */
    public const COL_OUTLET_PINCODE = 'outlet_address.outlet_pincode';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_address.outlet_id';

    /**
     * the column name for the outlet_gps field
     */
    public const COL_OUTLET_GPS = 'outlet_address.outlet_gps';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_address.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_address.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_address.updated_at';

    /**
     * the column name for the address_name field
     */
    public const COL_ADDRESS_NAME = 'outlet_address.address_name';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'outlet_address.itownid';

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
        self::TYPE_PHPNAME       => ['OutletAddressId', 'OutletAddress', 'OutletStreetName', 'OutletCity', 'OutletState', 'OutletCountry', 'OutletPincode', 'OutletId', 'OutletGps', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'AddressName', 'Itownid', ],
        self::TYPE_CAMELNAME     => ['outletAddressId', 'outletAddress', 'outletStreetName', 'outletCity', 'outletState', 'outletCountry', 'outletPincode', 'outletId', 'outletGps', 'companyId', 'createdAt', 'updatedAt', 'addressName', 'itownid', ],
        self::TYPE_COLNAME       => [OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, OutletAddressTableMap::COL_OUTLET_ADDRESS, OutletAddressTableMap::COL_OUTLET_STREET_NAME, OutletAddressTableMap::COL_OUTLET_CITY, OutletAddressTableMap::COL_OUTLET_STATE, OutletAddressTableMap::COL_OUTLET_COUNTRY, OutletAddressTableMap::COL_OUTLET_PINCODE, OutletAddressTableMap::COL_OUTLET_ID, OutletAddressTableMap::COL_OUTLET_GPS, OutletAddressTableMap::COL_COMPANY_ID, OutletAddressTableMap::COL_CREATED_AT, OutletAddressTableMap::COL_UPDATED_AT, OutletAddressTableMap::COL_ADDRESS_NAME, OutletAddressTableMap::COL_ITOWNID, ],
        self::TYPE_FIELDNAME     => ['outlet_address_id', 'outlet_address', 'outlet_street_name', 'outlet_city', 'outlet_state', 'outlet_country', 'outlet_pincode', 'outlet_id', 'outlet_gps', 'company_id', 'created_at', 'updated_at', 'address_name', 'itownid', ],
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
        self::TYPE_PHPNAME       => ['OutletAddressId' => 0, 'OutletAddress' => 1, 'OutletStreetName' => 2, 'OutletCity' => 3, 'OutletState' => 4, 'OutletCountry' => 5, 'OutletPincode' => 6, 'OutletId' => 7, 'OutletGps' => 8, 'CompanyId' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'AddressName' => 12, 'Itownid' => 13, ],
        self::TYPE_CAMELNAME     => ['outletAddressId' => 0, 'outletAddress' => 1, 'outletStreetName' => 2, 'outletCity' => 3, 'outletState' => 4, 'outletCountry' => 5, 'outletPincode' => 6, 'outletId' => 7, 'outletGps' => 8, 'companyId' => 9, 'createdAt' => 10, 'updatedAt' => 11, 'addressName' => 12, 'itownid' => 13, ],
        self::TYPE_COLNAME       => [OutletAddressTableMap::COL_OUTLET_ADDRESS_ID => 0, OutletAddressTableMap::COL_OUTLET_ADDRESS => 1, OutletAddressTableMap::COL_OUTLET_STREET_NAME => 2, OutletAddressTableMap::COL_OUTLET_CITY => 3, OutletAddressTableMap::COL_OUTLET_STATE => 4, OutletAddressTableMap::COL_OUTLET_COUNTRY => 5, OutletAddressTableMap::COL_OUTLET_PINCODE => 6, OutletAddressTableMap::COL_OUTLET_ID => 7, OutletAddressTableMap::COL_OUTLET_GPS => 8, OutletAddressTableMap::COL_COMPANY_ID => 9, OutletAddressTableMap::COL_CREATED_AT => 10, OutletAddressTableMap::COL_UPDATED_AT => 11, OutletAddressTableMap::COL_ADDRESS_NAME => 12, OutletAddressTableMap::COL_ITOWNID => 13, ],
        self::TYPE_FIELDNAME     => ['outlet_address_id' => 0, 'outlet_address' => 1, 'outlet_street_name' => 2, 'outlet_city' => 3, 'outlet_state' => 4, 'outlet_country' => 5, 'outlet_pincode' => 6, 'outlet_id' => 7, 'outlet_gps' => 8, 'company_id' => 9, 'created_at' => 10, 'updated_at' => 11, 'address_name' => 12, 'itownid' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletAddressId' => 'OUTLET_ADDRESS_ID',
        'OutletAddress.OutletAddressId' => 'OUTLET_ADDRESS_ID',
        'outletAddressId' => 'OUTLET_ADDRESS_ID',
        'outletAddress.outletAddressId' => 'OUTLET_ADDRESS_ID',
        'OutletAddressTableMap::COL_OUTLET_ADDRESS_ID' => 'OUTLET_ADDRESS_ID',
        'COL_OUTLET_ADDRESS_ID' => 'OUTLET_ADDRESS_ID',
        'outlet_address_id' => 'OUTLET_ADDRESS_ID',
        'outlet_address.outlet_address_id' => 'OUTLET_ADDRESS_ID',
        'OutletAddress' => 'OUTLET_ADDRESS',
        'OutletAddress.OutletAddress' => 'OUTLET_ADDRESS',
        'outletAddress' => 'OUTLET_ADDRESS',
        'outletAddress.outletAddress' => 'OUTLET_ADDRESS',
        'OutletAddressTableMap::COL_OUTLET_ADDRESS' => 'OUTLET_ADDRESS',
        'COL_OUTLET_ADDRESS' => 'OUTLET_ADDRESS',
        'outlet_address' => 'OUTLET_ADDRESS',
        'outlet_address.outlet_address' => 'OUTLET_ADDRESS',
        'OutletStreetName' => 'OUTLET_STREET_NAME',
        'OutletAddress.OutletStreetName' => 'OUTLET_STREET_NAME',
        'outletStreetName' => 'OUTLET_STREET_NAME',
        'outletAddress.outletStreetName' => 'OUTLET_STREET_NAME',
        'OutletAddressTableMap::COL_OUTLET_STREET_NAME' => 'OUTLET_STREET_NAME',
        'COL_OUTLET_STREET_NAME' => 'OUTLET_STREET_NAME',
        'outlet_street_name' => 'OUTLET_STREET_NAME',
        'outlet_address.outlet_street_name' => 'OUTLET_STREET_NAME',
        'OutletCity' => 'OUTLET_CITY',
        'OutletAddress.OutletCity' => 'OUTLET_CITY',
        'outletCity' => 'OUTLET_CITY',
        'outletAddress.outletCity' => 'OUTLET_CITY',
        'OutletAddressTableMap::COL_OUTLET_CITY' => 'OUTLET_CITY',
        'COL_OUTLET_CITY' => 'OUTLET_CITY',
        'outlet_city' => 'OUTLET_CITY',
        'outlet_address.outlet_city' => 'OUTLET_CITY',
        'OutletState' => 'OUTLET_STATE',
        'OutletAddress.OutletState' => 'OUTLET_STATE',
        'outletState' => 'OUTLET_STATE',
        'outletAddress.outletState' => 'OUTLET_STATE',
        'OutletAddressTableMap::COL_OUTLET_STATE' => 'OUTLET_STATE',
        'COL_OUTLET_STATE' => 'OUTLET_STATE',
        'outlet_state' => 'OUTLET_STATE',
        'outlet_address.outlet_state' => 'OUTLET_STATE',
        'OutletCountry' => 'OUTLET_COUNTRY',
        'OutletAddress.OutletCountry' => 'OUTLET_COUNTRY',
        'outletCountry' => 'OUTLET_COUNTRY',
        'outletAddress.outletCountry' => 'OUTLET_COUNTRY',
        'OutletAddressTableMap::COL_OUTLET_COUNTRY' => 'OUTLET_COUNTRY',
        'COL_OUTLET_COUNTRY' => 'OUTLET_COUNTRY',
        'outlet_country' => 'OUTLET_COUNTRY',
        'outlet_address.outlet_country' => 'OUTLET_COUNTRY',
        'OutletPincode' => 'OUTLET_PINCODE',
        'OutletAddress.OutletPincode' => 'OUTLET_PINCODE',
        'outletPincode' => 'OUTLET_PINCODE',
        'outletAddress.outletPincode' => 'OUTLET_PINCODE',
        'OutletAddressTableMap::COL_OUTLET_PINCODE' => 'OUTLET_PINCODE',
        'COL_OUTLET_PINCODE' => 'OUTLET_PINCODE',
        'outlet_pincode' => 'OUTLET_PINCODE',
        'outlet_address.outlet_pincode' => 'OUTLET_PINCODE',
        'OutletId' => 'OUTLET_ID',
        'OutletAddress.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletAddress.outletId' => 'OUTLET_ID',
        'OutletAddressTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_address.outlet_id' => 'OUTLET_ID',
        'OutletGps' => 'OUTLET_GPS',
        'OutletAddress.OutletGps' => 'OUTLET_GPS',
        'outletGps' => 'OUTLET_GPS',
        'outletAddress.outletGps' => 'OUTLET_GPS',
        'OutletAddressTableMap::COL_OUTLET_GPS' => 'OUTLET_GPS',
        'COL_OUTLET_GPS' => 'OUTLET_GPS',
        'outlet_gps' => 'OUTLET_GPS',
        'outlet_address.outlet_gps' => 'OUTLET_GPS',
        'CompanyId' => 'COMPANY_ID',
        'OutletAddress.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletAddress.companyId' => 'COMPANY_ID',
        'OutletAddressTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_address.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'OutletAddress.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletAddress.createdAt' => 'CREATED_AT',
        'OutletAddressTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_address.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletAddress.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletAddress.updatedAt' => 'UPDATED_AT',
        'OutletAddressTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_address.updated_at' => 'UPDATED_AT',
        'AddressName' => 'ADDRESS_NAME',
        'OutletAddress.AddressName' => 'ADDRESS_NAME',
        'addressName' => 'ADDRESS_NAME',
        'outletAddress.addressName' => 'ADDRESS_NAME',
        'OutletAddressTableMap::COL_ADDRESS_NAME' => 'ADDRESS_NAME',
        'COL_ADDRESS_NAME' => 'ADDRESS_NAME',
        'address_name' => 'ADDRESS_NAME',
        'outlet_address.address_name' => 'ADDRESS_NAME',
        'Itownid' => 'ITOWNID',
        'OutletAddress.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'outletAddress.itownid' => 'ITOWNID',
        'OutletAddressTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'outlet_address.itownid' => 'ITOWNID',
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
        $this->setName('outlet_address');
        $this->setPhpName('OutletAddress');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletAddress');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_address_outlet_address_id_seq');
        // columns
        $this->addPrimaryKey('outlet_address_id', 'OutletAddressId', 'BIGINT', true, null, null);
        $this->addColumn('outlet_address', 'OutletAddress', 'LONGVARCHAR', false, null, null);
        $this->addColumn('outlet_street_name', 'OutletStreetName', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_city', 'OutletCity', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_state', 'OutletState', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_country', 'OutletCountry', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_pincode', 'OutletPincode', 'VARCHAR', false, 255, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addColumn('outlet_gps', 'OutletGps', 'VARCHAR', false, 255, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('address_name', 'AddressName', 'VARCHAR', false, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
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
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':address_id',
    1 => ':outlet_address_id',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':default_address',
    1 => ':outlet_address_id',
  ),
), null, null, 'OutletOrgDatas', false);
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
        return (string) $row[
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
        return $withPrefix ? OutletAddressTableMap::CLASS_DEFAULT : OutletAddressTableMap::OM_CLASS;
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
     * @return array (OutletAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletAddressTableMap::OM_CLASS;
            /** @var OutletAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_ADDRESS);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_STREET_NAME);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_CITY);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_STATE);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_COUNTRY);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_PINCODE);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_OUTLET_GPS);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_ADDRESS_NAME);
            $criteria->addSelectColumn(OutletAddressTableMap::COL_ITOWNID);
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
            $criteria->addSelectColumn($alias . '.itownid');
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
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_ADDRESS);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_STREET_NAME);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_CITY);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_STATE);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_COUNTRY);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_PINCODE);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_OUTLET_GPS);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_ADDRESS_NAME);
            $criteria->removeSelectColumn(OutletAddressTableMap::COL_ITOWNID);
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
            $criteria->removeSelectColumn($alias . '.itownid');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletAddressTableMap::DATABASE_NAME)->getTable(OutletAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletAddressTableMap::DATABASE_NAME);
            $criteria->add(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, (array) $values, Criteria::IN);
        }

        $query = OutletAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletAddress object
        }

        if ($criteria->containsKey(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID) && $criteria->keyContainsValue(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletAddressTableMap::COL_OUTLET_ADDRESS_ID.')');
        }


        // Set the correct dbName
        $query = OutletAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
