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
use entities\RcpaSummaryData;
use entities\RcpaSummaryDataQuery;


/**
 * This class defines the structure of the 'rcpa_summary_data' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RcpaSummaryDataTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.RcpaSummaryDataTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'rcpa_summary_data';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'RcpaSummaryData';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\RcpaSummaryData';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.RcpaSummaryData';

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
     * the column name for the rcpa_summary_data_id field
     */
    public const COL_RCPA_SUMMARY_DATA_ID = 'rcpa_summary_data.rcpa_summary_data_id';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'rcpa_summary_data.moye';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'rcpa_summary_data.territory_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'rcpa_summary_data.position_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'rcpa_summary_data.outlet_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'rcpa_summary_data.outlet_org_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'rcpa_summary_data.brand_id';

    /**
     * the column name for the contribution field
     */
    public const COL_CONTRIBUTION = 'rcpa_summary_data.contribution';

    /**
     * the column name for the own field
     */
    public const COL_OWN = 'rcpa_summary_data.own';

    /**
     * the column name for the min_value field
     */
    public const COL_MIN_VALUE = 'rcpa_summary_data.min_value';

    /**
     * the column name for the is_rxer field
     */
    public const COL_IS_RXER = 'rcpa_summary_data.is_rxer';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'rcpa_summary_data.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'rcpa_summary_data.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'rcpa_summary_data.updated_at';

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
        self::TYPE_PHPNAME       => ['RcpaSummaryDataId', 'Moye', 'TerritoryId', 'PositionId', 'OutletId', 'OutletOrgId', 'BrandId', 'Contribution', 'Own', 'MinValue', 'IsRxer', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['rcpaSummaryDataId', 'moye', 'territoryId', 'positionId', 'outletId', 'outletOrgId', 'brandId', 'contribution', 'own', 'minValue', 'isRxer', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, RcpaSummaryDataTableMap::COL_MOYE, RcpaSummaryDataTableMap::COL_TERRITORY_ID, RcpaSummaryDataTableMap::COL_POSITION_ID, RcpaSummaryDataTableMap::COL_OUTLET_ID, RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID, RcpaSummaryDataTableMap::COL_BRAND_ID, RcpaSummaryDataTableMap::COL_CONTRIBUTION, RcpaSummaryDataTableMap::COL_OWN, RcpaSummaryDataTableMap::COL_MIN_VALUE, RcpaSummaryDataTableMap::COL_IS_RXER, RcpaSummaryDataTableMap::COL_COMPANY_ID, RcpaSummaryDataTableMap::COL_CREATED_AT, RcpaSummaryDataTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['rcpa_summary_data_id', 'moye', 'territory_id', 'position_id', 'outlet_id', 'outlet_org_id', 'brand_id', 'contribution', 'own', 'min_value', 'is_rxer', 'company_id', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['RcpaSummaryDataId' => 0, 'Moye' => 1, 'TerritoryId' => 2, 'PositionId' => 3, 'OutletId' => 4, 'OutletOrgId' => 5, 'BrandId' => 6, 'Contribution' => 7, 'Own' => 8, 'MinValue' => 9, 'IsRxer' => 10, 'CompanyId' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ],
        self::TYPE_CAMELNAME     => ['rcpaSummaryDataId' => 0, 'moye' => 1, 'territoryId' => 2, 'positionId' => 3, 'outletId' => 4, 'outletOrgId' => 5, 'brandId' => 6, 'contribution' => 7, 'own' => 8, 'minValue' => 9, 'isRxer' => 10, 'companyId' => 11, 'createdAt' => 12, 'updatedAt' => 13, ],
        self::TYPE_COLNAME       => [RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID => 0, RcpaSummaryDataTableMap::COL_MOYE => 1, RcpaSummaryDataTableMap::COL_TERRITORY_ID => 2, RcpaSummaryDataTableMap::COL_POSITION_ID => 3, RcpaSummaryDataTableMap::COL_OUTLET_ID => 4, RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID => 5, RcpaSummaryDataTableMap::COL_BRAND_ID => 6, RcpaSummaryDataTableMap::COL_CONTRIBUTION => 7, RcpaSummaryDataTableMap::COL_OWN => 8, RcpaSummaryDataTableMap::COL_MIN_VALUE => 9, RcpaSummaryDataTableMap::COL_IS_RXER => 10, RcpaSummaryDataTableMap::COL_COMPANY_ID => 11, RcpaSummaryDataTableMap::COL_CREATED_AT => 12, RcpaSummaryDataTableMap::COL_UPDATED_AT => 13, ],
        self::TYPE_FIELDNAME     => ['rcpa_summary_data_id' => 0, 'moye' => 1, 'territory_id' => 2, 'position_id' => 3, 'outlet_id' => 4, 'outlet_org_id' => 5, 'brand_id' => 6, 'contribution' => 7, 'own' => 8, 'min_value' => 9, 'is_rxer' => 10, 'company_id' => 11, 'created_at' => 12, 'updated_at' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'RcpaSummaryDataId' => 'RCPA_SUMMARY_DATA_ID',
        'RcpaSummaryData.RcpaSummaryDataId' => 'RCPA_SUMMARY_DATA_ID',
        'rcpaSummaryDataId' => 'RCPA_SUMMARY_DATA_ID',
        'rcpaSummaryData.rcpaSummaryDataId' => 'RCPA_SUMMARY_DATA_ID',
        'RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID' => 'RCPA_SUMMARY_DATA_ID',
        'COL_RCPA_SUMMARY_DATA_ID' => 'RCPA_SUMMARY_DATA_ID',
        'rcpa_summary_data_id' => 'RCPA_SUMMARY_DATA_ID',
        'rcpa_summary_data.rcpa_summary_data_id' => 'RCPA_SUMMARY_DATA_ID',
        'Moye' => 'MOYE',
        'RcpaSummaryData.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'rcpaSummaryData.moye' => 'MOYE',
        'RcpaSummaryDataTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'rcpa_summary_data.moye' => 'MOYE',
        'TerritoryId' => 'TERRITORY_ID',
        'RcpaSummaryData.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'rcpaSummaryData.territoryId' => 'TERRITORY_ID',
        'RcpaSummaryDataTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'rcpa_summary_data.territory_id' => 'TERRITORY_ID',
        'PositionId' => 'POSITION_ID',
        'RcpaSummaryData.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'rcpaSummaryData.positionId' => 'POSITION_ID',
        'RcpaSummaryDataTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'rcpa_summary_data.position_id' => 'POSITION_ID',
        'OutletId' => 'OUTLET_ID',
        'RcpaSummaryData.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'rcpaSummaryData.outletId' => 'OUTLET_ID',
        'RcpaSummaryDataTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'rcpa_summary_data.outlet_id' => 'OUTLET_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'RcpaSummaryData.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'rcpaSummaryData.outletOrgId' => 'OUTLET_ORG_ID',
        'RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'rcpa_summary_data.outlet_org_id' => 'OUTLET_ORG_ID',
        'BrandId' => 'BRAND_ID',
        'RcpaSummaryData.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'rcpaSummaryData.brandId' => 'BRAND_ID',
        'RcpaSummaryDataTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'rcpa_summary_data.brand_id' => 'BRAND_ID',
        'Contribution' => 'CONTRIBUTION',
        'RcpaSummaryData.Contribution' => 'CONTRIBUTION',
        'contribution' => 'CONTRIBUTION',
        'rcpaSummaryData.contribution' => 'CONTRIBUTION',
        'RcpaSummaryDataTableMap::COL_CONTRIBUTION' => 'CONTRIBUTION',
        'COL_CONTRIBUTION' => 'CONTRIBUTION',
        'rcpa_summary_data.contribution' => 'CONTRIBUTION',
        'Own' => 'OWN',
        'RcpaSummaryData.Own' => 'OWN',
        'own' => 'OWN',
        'rcpaSummaryData.own' => 'OWN',
        'RcpaSummaryDataTableMap::COL_OWN' => 'OWN',
        'COL_OWN' => 'OWN',
        'rcpa_summary_data.own' => 'OWN',
        'MinValue' => 'MIN_VALUE',
        'RcpaSummaryData.MinValue' => 'MIN_VALUE',
        'minValue' => 'MIN_VALUE',
        'rcpaSummaryData.minValue' => 'MIN_VALUE',
        'RcpaSummaryDataTableMap::COL_MIN_VALUE' => 'MIN_VALUE',
        'COL_MIN_VALUE' => 'MIN_VALUE',
        'min_value' => 'MIN_VALUE',
        'rcpa_summary_data.min_value' => 'MIN_VALUE',
        'IsRxer' => 'IS_RXER',
        'RcpaSummaryData.IsRxer' => 'IS_RXER',
        'isRxer' => 'IS_RXER',
        'rcpaSummaryData.isRxer' => 'IS_RXER',
        'RcpaSummaryDataTableMap::COL_IS_RXER' => 'IS_RXER',
        'COL_IS_RXER' => 'IS_RXER',
        'is_rxer' => 'IS_RXER',
        'rcpa_summary_data.is_rxer' => 'IS_RXER',
        'CompanyId' => 'COMPANY_ID',
        'RcpaSummaryData.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'rcpaSummaryData.companyId' => 'COMPANY_ID',
        'RcpaSummaryDataTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'rcpa_summary_data.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'RcpaSummaryData.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'rcpaSummaryData.createdAt' => 'CREATED_AT',
        'RcpaSummaryDataTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'rcpa_summary_data.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'RcpaSummaryData.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'rcpaSummaryData.updatedAt' => 'UPDATED_AT',
        'RcpaSummaryDataTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'rcpa_summary_data.updated_at' => 'UPDATED_AT',
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
        $this->setName('rcpa_summary_data');
        $this->setPhpName('RcpaSummaryData');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\RcpaSummaryData');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('rcpa_summary_data_rcpa_summary_data_id_seq');
        // columns
        $this->addPrimaryKey('rcpa_summary_data_id', 'RcpaSummaryDataId', 'INTEGER', true, null, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_id', 'OutletId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('contribution', 'Contribution', 'DECIMAL', false, 10, null);
        $this->addColumn('own', 'Own', 'DECIMAL', false, 10, null);
        $this->addColumn('min_value', 'MinValue', 'DECIMAL', false, 10, null);
        $this->addColumn('is_rxer', 'IsRxer', 'BOOLEAN', false, 1, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RcpaSummaryDataId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RcpaSummaryDataId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RcpaSummaryDataId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RcpaSummaryDataId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RcpaSummaryDataId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RcpaSummaryDataId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('RcpaSummaryDataId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RcpaSummaryDataTableMap::CLASS_DEFAULT : RcpaSummaryDataTableMap::OM_CLASS;
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
     * @return array (RcpaSummaryData object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RcpaSummaryDataTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RcpaSummaryDataTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RcpaSummaryDataTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RcpaSummaryDataTableMap::OM_CLASS;
            /** @var RcpaSummaryData $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RcpaSummaryDataTableMap::addInstanceToPool($obj, $key);
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
            $key = RcpaSummaryDataTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RcpaSummaryDataTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RcpaSummaryData $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RcpaSummaryDataTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_MOYE);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_CONTRIBUTION);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_OWN);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_MIN_VALUE);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_IS_RXER);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(RcpaSummaryDataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.rcpa_summary_data_id');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.contribution');
            $criteria->addSelectColumn($alias . '.own');
            $criteria->addSelectColumn($alias . '.min_value');
            $criteria->addSelectColumn($alias . '.is_rxer');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_MOYE);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_CONTRIBUTION);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_OWN);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_MIN_VALUE);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_IS_RXER);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(RcpaSummaryDataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.rcpa_summary_data_id');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.contribution');
            $criteria->removeSelectColumn($alias . '.own');
            $criteria->removeSelectColumn($alias . '.min_value');
            $criteria->removeSelectColumn($alias . '.is_rxer');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(RcpaSummaryDataTableMap::DATABASE_NAME)->getTable(RcpaSummaryDataTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a RcpaSummaryData or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or RcpaSummaryData object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaSummaryDataTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\RcpaSummaryData) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RcpaSummaryDataTableMap::DATABASE_NAME);
            $criteria->add(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, (array) $values, Criteria::IN);
        }

        $query = RcpaSummaryDataQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RcpaSummaryDataTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RcpaSummaryDataTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the rcpa_summary_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RcpaSummaryDataQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RcpaSummaryData or Criteria object.
     *
     * @param mixed $criteria Criteria or RcpaSummaryData object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaSummaryDataTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RcpaSummaryData object
        }

        if ($criteria->containsKey(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID) && $criteria->keyContainsValue(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID.')');
        }


        // Set the correct dbName
        $query = RcpaSummaryDataQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
