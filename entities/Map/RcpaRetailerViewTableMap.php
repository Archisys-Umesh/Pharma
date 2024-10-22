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
use entities\RcpaRetailerView;
use entities\RcpaRetailerViewQuery;


/**
 * This class defines the structure of the 'rcpa_retailer_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RcpaRetailerViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.RcpaRetailerViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'rcpa_retailer_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'RcpaRetailerView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\RcpaRetailerView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.RcpaRetailerView';

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
     * the column name for the uniqueid field
     */
    public const COL_UNIQUEID = 'rcpa_retailer_view.uniqueid';

    /**
     * the column name for the doctorid field
     */
    public const COL_DOCTORID = 'rcpa_retailer_view.doctorid';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'rcpa_retailer_view.outlet_org_id';

    /**
     * the column name for the retail_outlet_id field
     */
    public const COL_RETAIL_OUTLET_ID = 'rcpa_retailer_view.retail_outlet_id';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'rcpa_retailer_view.outlet_name';

    /**
     * the column name for the rcpa_moye field
     */
    public const COL_RCPA_MOYE = 'rcpa_retailer_view.rcpa_moye';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'rcpa_retailer_view.territory_id';

    /**
     * the column name for the rcpa_value field
     */
    public const COL_RCPA_VALUE = 'rcpa_retailer_view.rcpa_value';

    /**
     * the column name for the potential field
     */
    public const COL_POTENTIAL = 'rcpa_retailer_view.potential';

    /**
     * the column name for the own field
     */
    public const COL_OWN = 'rcpa_retailer_view.own';

    /**
     * the column name for the competition field
     */
    public const COL_COMPETITION = 'rcpa_retailer_view.competition';

    /**
     * the column name for the lastcreated field
     */
    public const COL_LASTCREATED = 'rcpa_retailer_view.lastcreated';

    /**
     * the column name for the lastupdated field
     */
    public const COL_LASTUPDATED = 'rcpa_retailer_view.lastupdated';

    /**
     * the column name for the brand_name field
     */
    public const COL_BRAND_NAME = 'rcpa_retailer_view.brand_name';

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
        self::TYPE_PHPNAME       => ['Uniqueid', 'Doctorid', 'OutletOrgId', 'RetailOutletId', 'OutletName', 'RcpaMoye', 'TerritoryId', 'RcpaValue', 'Potential', 'Own', 'Competition', 'CreatedAt', 'UpdatedAt', 'BrandName', ],
        self::TYPE_CAMELNAME     => ['uniqueid', 'doctorid', 'outletOrgId', 'retailOutletId', 'outletName', 'rcpaMoye', 'territoryId', 'rcpaValue', 'potential', 'own', 'competition', 'createdAt', 'updatedAt', 'brandName', ],
        self::TYPE_COLNAME       => [RcpaRetailerViewTableMap::COL_UNIQUEID, RcpaRetailerViewTableMap::COL_DOCTORID, RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID, RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID, RcpaRetailerViewTableMap::COL_OUTLET_NAME, RcpaRetailerViewTableMap::COL_RCPA_MOYE, RcpaRetailerViewTableMap::COL_TERRITORY_ID, RcpaRetailerViewTableMap::COL_RCPA_VALUE, RcpaRetailerViewTableMap::COL_POTENTIAL, RcpaRetailerViewTableMap::COL_OWN, RcpaRetailerViewTableMap::COL_COMPETITION, RcpaRetailerViewTableMap::COL_LASTCREATED, RcpaRetailerViewTableMap::COL_LASTUPDATED, RcpaRetailerViewTableMap::COL_BRAND_NAME, ],
        self::TYPE_FIELDNAME     => ['uniqueid', 'doctorid', 'outlet_org_id', 'retail_outlet_id', 'outlet_name', 'rcpa_moye', 'territory_id', 'rcpa_value', 'potential', 'own', 'competition', 'lastcreated', 'lastupdated', 'brand_name', ],
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
        self::TYPE_PHPNAME       => ['Uniqueid' => 0, 'Doctorid' => 1, 'OutletOrgId' => 2, 'RetailOutletId' => 3, 'OutletName' => 4, 'RcpaMoye' => 5, 'TerritoryId' => 6, 'RcpaValue' => 7, 'Potential' => 8, 'Own' => 9, 'Competition' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'BrandName' => 13, ],
        self::TYPE_CAMELNAME     => ['uniqueid' => 0, 'doctorid' => 1, 'outletOrgId' => 2, 'retailOutletId' => 3, 'outletName' => 4, 'rcpaMoye' => 5, 'territoryId' => 6, 'rcpaValue' => 7, 'potential' => 8, 'own' => 9, 'competition' => 10, 'createdAt' => 11, 'updatedAt' => 12, 'brandName' => 13, ],
        self::TYPE_COLNAME       => [RcpaRetailerViewTableMap::COL_UNIQUEID => 0, RcpaRetailerViewTableMap::COL_DOCTORID => 1, RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID => 2, RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID => 3, RcpaRetailerViewTableMap::COL_OUTLET_NAME => 4, RcpaRetailerViewTableMap::COL_RCPA_MOYE => 5, RcpaRetailerViewTableMap::COL_TERRITORY_ID => 6, RcpaRetailerViewTableMap::COL_RCPA_VALUE => 7, RcpaRetailerViewTableMap::COL_POTENTIAL => 8, RcpaRetailerViewTableMap::COL_OWN => 9, RcpaRetailerViewTableMap::COL_COMPETITION => 10, RcpaRetailerViewTableMap::COL_LASTCREATED => 11, RcpaRetailerViewTableMap::COL_LASTUPDATED => 12, RcpaRetailerViewTableMap::COL_BRAND_NAME => 13, ],
        self::TYPE_FIELDNAME     => ['uniqueid' => 0, 'doctorid' => 1, 'outlet_org_id' => 2, 'retail_outlet_id' => 3, 'outlet_name' => 4, 'rcpa_moye' => 5, 'territory_id' => 6, 'rcpa_value' => 7, 'potential' => 8, 'own' => 9, 'competition' => 10, 'lastcreated' => 11, 'lastupdated' => 12, 'brand_name' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Uniqueid' => 'UNIQUEID',
        'RcpaRetailerView.Uniqueid' => 'UNIQUEID',
        'uniqueid' => 'UNIQUEID',
        'rcpaRetailerView.uniqueid' => 'UNIQUEID',
        'RcpaRetailerViewTableMap::COL_UNIQUEID' => 'UNIQUEID',
        'COL_UNIQUEID' => 'UNIQUEID',
        'rcpa_retailer_view.uniqueid' => 'UNIQUEID',
        'Doctorid' => 'DOCTORID',
        'RcpaRetailerView.Doctorid' => 'DOCTORID',
        'doctorid' => 'DOCTORID',
        'rcpaRetailerView.doctorid' => 'DOCTORID',
        'RcpaRetailerViewTableMap::COL_DOCTORID' => 'DOCTORID',
        'COL_DOCTORID' => 'DOCTORID',
        'rcpa_retailer_view.doctorid' => 'DOCTORID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'RcpaRetailerView.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'rcpaRetailerView.outletOrgId' => 'OUTLET_ORG_ID',
        'RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'rcpa_retailer_view.outlet_org_id' => 'OUTLET_ORG_ID',
        'RetailOutletId' => 'RETAIL_OUTLET_ID',
        'RcpaRetailerView.RetailOutletId' => 'RETAIL_OUTLET_ID',
        'retailOutletId' => 'RETAIL_OUTLET_ID',
        'rcpaRetailerView.retailOutletId' => 'RETAIL_OUTLET_ID',
        'RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID' => 'RETAIL_OUTLET_ID',
        'COL_RETAIL_OUTLET_ID' => 'RETAIL_OUTLET_ID',
        'retail_outlet_id' => 'RETAIL_OUTLET_ID',
        'rcpa_retailer_view.retail_outlet_id' => 'RETAIL_OUTLET_ID',
        'OutletName' => 'OUTLET_NAME',
        'RcpaRetailerView.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'rcpaRetailerView.outletName' => 'OUTLET_NAME',
        'RcpaRetailerViewTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'rcpa_retailer_view.outlet_name' => 'OUTLET_NAME',
        'RcpaMoye' => 'RCPA_MOYE',
        'RcpaRetailerView.RcpaMoye' => 'RCPA_MOYE',
        'rcpaMoye' => 'RCPA_MOYE',
        'rcpaRetailerView.rcpaMoye' => 'RCPA_MOYE',
        'RcpaRetailerViewTableMap::COL_RCPA_MOYE' => 'RCPA_MOYE',
        'COL_RCPA_MOYE' => 'RCPA_MOYE',
        'rcpa_moye' => 'RCPA_MOYE',
        'rcpa_retailer_view.rcpa_moye' => 'RCPA_MOYE',
        'TerritoryId' => 'TERRITORY_ID',
        'RcpaRetailerView.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'rcpaRetailerView.territoryId' => 'TERRITORY_ID',
        'RcpaRetailerViewTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'rcpa_retailer_view.territory_id' => 'TERRITORY_ID',
        'RcpaValue' => 'RCPA_VALUE',
        'RcpaRetailerView.RcpaValue' => 'RCPA_VALUE',
        'rcpaValue' => 'RCPA_VALUE',
        'rcpaRetailerView.rcpaValue' => 'RCPA_VALUE',
        'RcpaRetailerViewTableMap::COL_RCPA_VALUE' => 'RCPA_VALUE',
        'COL_RCPA_VALUE' => 'RCPA_VALUE',
        'rcpa_value' => 'RCPA_VALUE',
        'rcpa_retailer_view.rcpa_value' => 'RCPA_VALUE',
        'Potential' => 'POTENTIAL',
        'RcpaRetailerView.Potential' => 'POTENTIAL',
        'potential' => 'POTENTIAL',
        'rcpaRetailerView.potential' => 'POTENTIAL',
        'RcpaRetailerViewTableMap::COL_POTENTIAL' => 'POTENTIAL',
        'COL_POTENTIAL' => 'POTENTIAL',
        'rcpa_retailer_view.potential' => 'POTENTIAL',
        'Own' => 'OWN',
        'RcpaRetailerView.Own' => 'OWN',
        'own' => 'OWN',
        'rcpaRetailerView.own' => 'OWN',
        'RcpaRetailerViewTableMap::COL_OWN' => 'OWN',
        'COL_OWN' => 'OWN',
        'rcpa_retailer_view.own' => 'OWN',
        'Competition' => 'COMPETITION',
        'RcpaRetailerView.Competition' => 'COMPETITION',
        'competition' => 'COMPETITION',
        'rcpaRetailerView.competition' => 'COMPETITION',
        'RcpaRetailerViewTableMap::COL_COMPETITION' => 'COMPETITION',
        'COL_COMPETITION' => 'COMPETITION',
        'rcpa_retailer_view.competition' => 'COMPETITION',
        'CreatedAt' => 'LASTCREATED',
        'RcpaRetailerView.CreatedAt' => 'LASTCREATED',
        'createdAt' => 'LASTCREATED',
        'rcpaRetailerView.createdAt' => 'LASTCREATED',
        'RcpaRetailerViewTableMap::COL_LASTCREATED' => 'LASTCREATED',
        'COL_LASTCREATED' => 'LASTCREATED',
        'lastcreated' => 'LASTCREATED',
        'rcpa_retailer_view.lastcreated' => 'LASTCREATED',
        'UpdatedAt' => 'LASTUPDATED',
        'RcpaRetailerView.UpdatedAt' => 'LASTUPDATED',
        'updatedAt' => 'LASTUPDATED',
        'rcpaRetailerView.updatedAt' => 'LASTUPDATED',
        'RcpaRetailerViewTableMap::COL_LASTUPDATED' => 'LASTUPDATED',
        'COL_LASTUPDATED' => 'LASTUPDATED',
        'lastupdated' => 'LASTUPDATED',
        'rcpa_retailer_view.lastupdated' => 'LASTUPDATED',
        'BrandName' => 'BRAND_NAME',
        'RcpaRetailerView.BrandName' => 'BRAND_NAME',
        'brandName' => 'BRAND_NAME',
        'rcpaRetailerView.brandName' => 'BRAND_NAME',
        'RcpaRetailerViewTableMap::COL_BRAND_NAME' => 'BRAND_NAME',
        'COL_BRAND_NAME' => 'BRAND_NAME',
        'brand_name' => 'BRAND_NAME',
        'rcpa_retailer_view.brand_name' => 'BRAND_NAME',
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
        $this->setName('rcpa_retailer_view');
        $this->setPhpName('RcpaRetailerView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\RcpaRetailerView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('uniqueid', 'Uniqueid', 'VARCHAR', true, 255, null);
        $this->addColumn('doctorid', 'Doctorid', 'INTEGER', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('retail_outlet_id', 'RetailOutletId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, 255, null);
        $this->addColumn('rcpa_moye', 'RcpaMoye', 'VARCHAR', false, 255, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('rcpa_value', 'RcpaValue', 'DECIMAL', false, null, null);
        $this->addColumn('potential', 'Potential', 'DECIMAL', false, null, null);
        $this->addColumn('own', 'Own', 'DECIMAL', false, null, null);
        $this->addColumn('competition', 'Competition', 'DECIMAL', false, null, null);
        $this->addColumn('lastcreated', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('lastupdated', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('brand_name', 'BrandName', 'VARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RcpaRetailerViewTableMap::CLASS_DEFAULT : RcpaRetailerViewTableMap::OM_CLASS;
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
     * @return array (RcpaRetailerView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RcpaRetailerViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RcpaRetailerViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RcpaRetailerViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RcpaRetailerViewTableMap::OM_CLASS;
            /** @var RcpaRetailerView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RcpaRetailerViewTableMap::addInstanceToPool($obj, $key);
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
            $key = RcpaRetailerViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RcpaRetailerViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RcpaRetailerView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RcpaRetailerViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_UNIQUEID);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_DOCTORID);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_RCPA_MOYE);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_RCPA_VALUE);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_POTENTIAL);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_OWN);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_COMPETITION);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_LASTCREATED);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_LASTUPDATED);
            $criteria->addSelectColumn(RcpaRetailerViewTableMap::COL_BRAND_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.uniqueid');
            $criteria->addSelectColumn($alias . '.doctorid');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.retail_outlet_id');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.rcpa_moye');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.rcpa_value');
            $criteria->addSelectColumn($alias . '.potential');
            $criteria->addSelectColumn($alias . '.own');
            $criteria->addSelectColumn($alias . '.competition');
            $criteria->addSelectColumn($alias . '.lastcreated');
            $criteria->addSelectColumn($alias . '.lastupdated');
            $criteria->addSelectColumn($alias . '.brand_name');
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
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_UNIQUEID);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_DOCTORID);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_RCPA_MOYE);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_RCPA_VALUE);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_POTENTIAL);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_OWN);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_COMPETITION);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_LASTCREATED);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_LASTUPDATED);
            $criteria->removeSelectColumn(RcpaRetailerViewTableMap::COL_BRAND_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.uniqueid');
            $criteria->removeSelectColumn($alias . '.doctorid');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.retail_outlet_id');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.rcpa_moye');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.rcpa_value');
            $criteria->removeSelectColumn($alias . '.potential');
            $criteria->removeSelectColumn($alias . '.own');
            $criteria->removeSelectColumn($alias . '.competition');
            $criteria->removeSelectColumn($alias . '.lastcreated');
            $criteria->removeSelectColumn($alias . '.lastupdated');
            $criteria->removeSelectColumn($alias . '.brand_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(RcpaRetailerViewTableMap::DATABASE_NAME)->getTable(RcpaRetailerViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a RcpaRetailerView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or RcpaRetailerView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaRetailerViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\RcpaRetailerView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RcpaRetailerViewTableMap::DATABASE_NAME);
            $criteria->add(RcpaRetailerViewTableMap::COL_UNIQUEID, (array) $values, Criteria::IN);
        }

        $query = RcpaRetailerViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RcpaRetailerViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RcpaRetailerViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the rcpa_retailer_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RcpaRetailerViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RcpaRetailerView or Criteria object.
     *
     * @param mixed $criteria Criteria or RcpaRetailerView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaRetailerViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RcpaRetailerView object
        }


        // Set the correct dbName
        $query = RcpaRetailerViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
