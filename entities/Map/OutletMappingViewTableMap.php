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
use entities\OutletMappingView;
use entities\OutletMappingViewQuery;


/**
 * This class defines the structure of the 'outlet_mapping_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletMappingViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletMappingViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_mapping_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletMappingView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletMappingView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletMappingView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the mapping_id field
     */
    public const COL_MAPPING_ID = 'outlet_mapping_view.mapping_id';

    /**
     * the column name for the primary_outlet_id field
     */
    public const COL_PRIMARY_OUTLET_ID = 'outlet_mapping_view.primary_outlet_id';

    /**
     * the column name for the secondary_outlet_id field
     */
    public const COL_SECONDARY_OUTLET_ID = 'outlet_mapping_view.secondary_outlet_id';

    /**
     * the column name for the pricebook_id field
     */
    public const COL_PRICEBOOK_ID = 'outlet_mapping_view.pricebook_id';

    /**
     * the column name for the isdefault field
     */
    public const COL_ISDEFAULT = 'outlet_mapping_view.isdefault';

    /**
     * the column name for the category_type field
     */
    public const COL_CATEGORY_TYPE = 'outlet_mapping_view.category_type';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_mapping_view.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_mapping_view.updated_at';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'outlet_mapping_view.outlet_org_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'outlet_mapping_view.org_unit_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'outlet_mapping_view.territory_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'outlet_mapping_view.territory_name';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'outlet_mapping_view.outlettype_name';

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
        self::TYPE_PHPNAME       => ['MappingId', 'PrimaryOutletId', 'SecondaryOutletId', 'PricebookId', 'IsDefault', 'CategoryType', 'CreatedAt', 'UpdatedAt', 'OutletOrgId', 'OrgUnitId', 'TerritoryId', 'TerritoryName', 'OutlettypeName', ],
        self::TYPE_CAMELNAME     => ['mappingId', 'primaryOutletId', 'secondaryOutletId', 'pricebookId', 'isDefault', 'categoryType', 'createdAt', 'updatedAt', 'outletOrgId', 'orgUnitId', 'territoryId', 'territoryName', 'outlettypeName', ],
        self::TYPE_COLNAME       => [OutletMappingViewTableMap::COL_MAPPING_ID, OutletMappingViewTableMap::COL_PRIMARY_OUTLET_ID, OutletMappingViewTableMap::COL_SECONDARY_OUTLET_ID, OutletMappingViewTableMap::COL_PRICEBOOK_ID, OutletMappingViewTableMap::COL_ISDEFAULT, OutletMappingViewTableMap::COL_CATEGORY_TYPE, OutletMappingViewTableMap::COL_CREATED_AT, OutletMappingViewTableMap::COL_UPDATED_AT, OutletMappingViewTableMap::COL_OUTLET_ORG_ID, OutletMappingViewTableMap::COL_ORG_UNIT_ID, OutletMappingViewTableMap::COL_TERRITORY_ID, OutletMappingViewTableMap::COL_TERRITORY_NAME, OutletMappingViewTableMap::COL_OUTLETTYPE_NAME, ],
        self::TYPE_FIELDNAME     => ['mapping_id', 'primary_outlet_id', 'secondary_outlet_id', 'pricebook_id', 'isdefault', 'category_type', 'created_at', 'updated_at', 'outlet_org_id', 'org_unit_id', 'territory_id', 'territory_name', 'outlettype_name', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['MappingId' => 0, 'PrimaryOutletId' => 1, 'SecondaryOutletId' => 2, 'PricebookId' => 3, 'IsDefault' => 4, 'CategoryType' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'OutletOrgId' => 8, 'OrgUnitId' => 9, 'TerritoryId' => 10, 'TerritoryName' => 11, 'OutlettypeName' => 12, ],
        self::TYPE_CAMELNAME     => ['mappingId' => 0, 'primaryOutletId' => 1, 'secondaryOutletId' => 2, 'pricebookId' => 3, 'isDefault' => 4, 'categoryType' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'outletOrgId' => 8, 'orgUnitId' => 9, 'territoryId' => 10, 'territoryName' => 11, 'outlettypeName' => 12, ],
        self::TYPE_COLNAME       => [OutletMappingViewTableMap::COL_MAPPING_ID => 0, OutletMappingViewTableMap::COL_PRIMARY_OUTLET_ID => 1, OutletMappingViewTableMap::COL_SECONDARY_OUTLET_ID => 2, OutletMappingViewTableMap::COL_PRICEBOOK_ID => 3, OutletMappingViewTableMap::COL_ISDEFAULT => 4, OutletMappingViewTableMap::COL_CATEGORY_TYPE => 5, OutletMappingViewTableMap::COL_CREATED_AT => 6, OutletMappingViewTableMap::COL_UPDATED_AT => 7, OutletMappingViewTableMap::COL_OUTLET_ORG_ID => 8, OutletMappingViewTableMap::COL_ORG_UNIT_ID => 9, OutletMappingViewTableMap::COL_TERRITORY_ID => 10, OutletMappingViewTableMap::COL_TERRITORY_NAME => 11, OutletMappingViewTableMap::COL_OUTLETTYPE_NAME => 12, ],
        self::TYPE_FIELDNAME     => ['mapping_id' => 0, 'primary_outlet_id' => 1, 'secondary_outlet_id' => 2, 'pricebook_id' => 3, 'isdefault' => 4, 'category_type' => 5, 'created_at' => 6, 'updated_at' => 7, 'outlet_org_id' => 8, 'org_unit_id' => 9, 'territory_id' => 10, 'territory_name' => 11, 'outlettype_name' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'MappingId' => 'MAPPING_ID',
        'OutletMappingView.MappingId' => 'MAPPING_ID',
        'mappingId' => 'MAPPING_ID',
        'outletMappingView.mappingId' => 'MAPPING_ID',
        'OutletMappingViewTableMap::COL_MAPPING_ID' => 'MAPPING_ID',
        'COL_MAPPING_ID' => 'MAPPING_ID',
        'mapping_id' => 'MAPPING_ID',
        'outlet_mapping_view.mapping_id' => 'MAPPING_ID',
        'PrimaryOutletId' => 'PRIMARY_OUTLET_ID',
        'OutletMappingView.PrimaryOutletId' => 'PRIMARY_OUTLET_ID',
        'primaryOutletId' => 'PRIMARY_OUTLET_ID',
        'outletMappingView.primaryOutletId' => 'PRIMARY_OUTLET_ID',
        'OutletMappingViewTableMap::COL_PRIMARY_OUTLET_ID' => 'PRIMARY_OUTLET_ID',
        'COL_PRIMARY_OUTLET_ID' => 'PRIMARY_OUTLET_ID',
        'primary_outlet_id' => 'PRIMARY_OUTLET_ID',
        'outlet_mapping_view.primary_outlet_id' => 'PRIMARY_OUTLET_ID',
        'SecondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'OutletMappingView.SecondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'secondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'outletMappingView.secondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'OutletMappingViewTableMap::COL_SECONDARY_OUTLET_ID' => 'SECONDARY_OUTLET_ID',
        'COL_SECONDARY_OUTLET_ID' => 'SECONDARY_OUTLET_ID',
        'secondary_outlet_id' => 'SECONDARY_OUTLET_ID',
        'outlet_mapping_view.secondary_outlet_id' => 'SECONDARY_OUTLET_ID',
        'PricebookId' => 'PRICEBOOK_ID',
        'OutletMappingView.PricebookId' => 'PRICEBOOK_ID',
        'pricebookId' => 'PRICEBOOK_ID',
        'outletMappingView.pricebookId' => 'PRICEBOOK_ID',
        'OutletMappingViewTableMap::COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'pricebook_id' => 'PRICEBOOK_ID',
        'outlet_mapping_view.pricebook_id' => 'PRICEBOOK_ID',
        'IsDefault' => 'ISDEFAULT',
        'OutletMappingView.IsDefault' => 'ISDEFAULT',
        'isDefault' => 'ISDEFAULT',
        'outletMappingView.isDefault' => 'ISDEFAULT',
        'OutletMappingViewTableMap::COL_ISDEFAULT' => 'ISDEFAULT',
        'COL_ISDEFAULT' => 'ISDEFAULT',
        'isdefault' => 'ISDEFAULT',
        'outlet_mapping_view.isdefault' => 'ISDEFAULT',
        'CategoryType' => 'CATEGORY_TYPE',
        'OutletMappingView.CategoryType' => 'CATEGORY_TYPE',
        'categoryType' => 'CATEGORY_TYPE',
        'outletMappingView.categoryType' => 'CATEGORY_TYPE',
        'OutletMappingViewTableMap::COL_CATEGORY_TYPE' => 'CATEGORY_TYPE',
        'COL_CATEGORY_TYPE' => 'CATEGORY_TYPE',
        'category_type' => 'CATEGORY_TYPE',
        'outlet_mapping_view.category_type' => 'CATEGORY_TYPE',
        'CreatedAt' => 'CREATED_AT',
        'OutletMappingView.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletMappingView.createdAt' => 'CREATED_AT',
        'OutletMappingViewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_mapping_view.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletMappingView.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletMappingView.updatedAt' => 'UPDATED_AT',
        'OutletMappingViewTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_mapping_view.updated_at' => 'UPDATED_AT',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'OutletMappingView.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'outletMappingView.outletOrgId' => 'OUTLET_ORG_ID',
        'OutletMappingViewTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'outlet_mapping_view.outlet_org_id' => 'OUTLET_ORG_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'OutletMappingView.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'outletMappingView.orgUnitId' => 'ORG_UNIT_ID',
        'OutletMappingViewTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'outlet_mapping_view.org_unit_id' => 'ORG_UNIT_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'OutletMappingView.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'outletMappingView.territoryId' => 'TERRITORY_ID',
        'OutletMappingViewTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'outlet_mapping_view.territory_id' => 'TERRITORY_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'OutletMappingView.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'outletMappingView.territoryName' => 'TERRITORY_NAME',
        'OutletMappingViewTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'outlet_mapping_view.territory_name' => 'TERRITORY_NAME',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'OutletMappingView.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'outletMappingView.outlettypeName' => 'OUTLETTYPE_NAME',
        'OutletMappingViewTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'outlet_mapping_view.outlettype_name' => 'OUTLETTYPE_NAME',
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
        $this->setName('outlet_mapping_view');
        $this->setPhpName('OutletMappingView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletMappingView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('mapping_id', 'MappingId', 'INTEGER', true, null, null);
        $this->addColumn('primary_outlet_id', 'PrimaryOutletId', 'INTEGER', false, null, null);
        $this->addColumn('secondary_outlet_id', 'SecondaryOutletId', 'INTEGER', false, null, null);
        $this->addColumn('pricebook_id', 'PricebookId', 'INTEGER', false, null, null);
        $this->addColumn('isdefault', 'IsDefault', 'INTEGER', false, null, null);
        $this->addColumn('category_type', 'CategoryType', 'VARCHAR', false, 50, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('org_unit_id', 'OrgUnitId', 'INTEGER', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, 50, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, 50, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('MappingId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletMappingViewTableMap::CLASS_DEFAULT : OutletMappingViewTableMap::OM_CLASS;
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
     * @return array (OutletMappingView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletMappingViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletMappingViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletMappingViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletMappingViewTableMap::OM_CLASS;
            /** @var OutletMappingView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletMappingViewTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletMappingViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletMappingViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletMappingView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletMappingViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_MAPPING_ID);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_PRIMARY_OUTLET_ID);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_SECONDARY_OUTLET_ID);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_PRICEBOOK_ID);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_ISDEFAULT);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_CATEGORY_TYPE);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(OutletMappingViewTableMap::COL_OUTLETTYPE_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.mapping_id');
            $criteria->addSelectColumn($alias . '.primary_outlet_id');
            $criteria->addSelectColumn($alias . '.secondary_outlet_id');
            $criteria->addSelectColumn($alias . '.pricebook_id');
            $criteria->addSelectColumn($alias . '.isdefault');
            $criteria->addSelectColumn($alias . '.category_type');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.outlettype_name');
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
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_MAPPING_ID);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_PRIMARY_OUTLET_ID);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_SECONDARY_OUTLET_ID);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_PRICEBOOK_ID);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_ISDEFAULT);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_CATEGORY_TYPE);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(OutletMappingViewTableMap::COL_OUTLETTYPE_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.mapping_id');
            $criteria->removeSelectColumn($alias . '.primary_outlet_id');
            $criteria->removeSelectColumn($alias . '.secondary_outlet_id');
            $criteria->removeSelectColumn($alias . '.pricebook_id');
            $criteria->removeSelectColumn($alias . '.isdefault');
            $criteria->removeSelectColumn($alias . '.category_type');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletMappingViewTableMap::DATABASE_NAME)->getTable(OutletMappingViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletMappingView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletMappingView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletMappingViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletMappingView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletMappingViewTableMap::DATABASE_NAME);
            $criteria->add(OutletMappingViewTableMap::COL_MAPPING_ID, (array) $values, Criteria::IN);
        }

        $query = OutletMappingViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletMappingViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletMappingViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_mapping_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletMappingViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletMappingView or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletMappingView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletMappingViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletMappingView object
        }


        // Set the correct dbName
        $query = OutletMappingViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
