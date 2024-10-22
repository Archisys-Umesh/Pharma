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
use entities\Brands;
use entities\BrandsQuery;


/**
 * This class defines the structure of the 'brands' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brands';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Brands';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Brands';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Brands';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'brands.brand_id';

    /**
     * the column name for the brand_name field
     */
    public const COL_BRAND_NAME = 'brands.brand_name';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'brands.orgunitid';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'brands.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'brands.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'brands.updated_at';

    /**
     * the column name for the brand_code field
     */
    public const COL_BRAND_CODE = 'brands.brand_code';

    /**
     * the column name for the brand_rate field
     */
    public const COL_BRAND_RATE = 'brands.brand_rate';

    /**
     * the column name for the min_value field
     */
    public const COL_MIN_VALUE = 'brands.min_value';

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
        self::TYPE_PHPNAME       => ['BrandId', 'BrandName', 'Orgunitid', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'BrandCode', 'BrandRate', 'MinValue', ],
        self::TYPE_CAMELNAME     => ['brandId', 'brandName', 'orgunitid', 'companyId', 'createdAt', 'updatedAt', 'brandCode', 'brandRate', 'minValue', ],
        self::TYPE_COLNAME       => [BrandsTableMap::COL_BRAND_ID, BrandsTableMap::COL_BRAND_NAME, BrandsTableMap::COL_ORGUNITID, BrandsTableMap::COL_COMPANY_ID, BrandsTableMap::COL_CREATED_AT, BrandsTableMap::COL_UPDATED_AT, BrandsTableMap::COL_BRAND_CODE, BrandsTableMap::COL_BRAND_RATE, BrandsTableMap::COL_MIN_VALUE, ],
        self::TYPE_FIELDNAME     => ['brand_id', 'brand_name', 'orgunitid', 'company_id', 'created_at', 'updated_at', 'brand_code', 'brand_rate', 'min_value', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['BrandId' => 0, 'BrandName' => 1, 'Orgunitid' => 2, 'CompanyId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'BrandCode' => 6, 'BrandRate' => 7, 'MinValue' => 8, ],
        self::TYPE_CAMELNAME     => ['brandId' => 0, 'brandName' => 1, 'orgunitid' => 2, 'companyId' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'brandCode' => 6, 'brandRate' => 7, 'minValue' => 8, ],
        self::TYPE_COLNAME       => [BrandsTableMap::COL_BRAND_ID => 0, BrandsTableMap::COL_BRAND_NAME => 1, BrandsTableMap::COL_ORGUNITID => 2, BrandsTableMap::COL_COMPANY_ID => 3, BrandsTableMap::COL_CREATED_AT => 4, BrandsTableMap::COL_UPDATED_AT => 5, BrandsTableMap::COL_BRAND_CODE => 6, BrandsTableMap::COL_BRAND_RATE => 7, BrandsTableMap::COL_MIN_VALUE => 8, ],
        self::TYPE_FIELDNAME     => ['brand_id' => 0, 'brand_name' => 1, 'orgunitid' => 2, 'company_id' => 3, 'created_at' => 4, 'updated_at' => 5, 'brand_code' => 6, 'brand_rate' => 7, 'min_value' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BrandId' => 'BRAND_ID',
        'Brands.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'brands.brandId' => 'BRAND_ID',
        'BrandsTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'brands.brand_id' => 'BRAND_ID',
        'BrandName' => 'BRAND_NAME',
        'Brands.BrandName' => 'BRAND_NAME',
        'brandName' => 'BRAND_NAME',
        'brands.brandName' => 'BRAND_NAME',
        'BrandsTableMap::COL_BRAND_NAME' => 'BRAND_NAME',
        'COL_BRAND_NAME' => 'BRAND_NAME',
        'brand_name' => 'BRAND_NAME',
        'brands.brand_name' => 'BRAND_NAME',
        'Orgunitid' => 'ORGUNITID',
        'Brands.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'brands.orgunitid' => 'ORGUNITID',
        'BrandsTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'CompanyId' => 'COMPANY_ID',
        'Brands.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'brands.companyId' => 'COMPANY_ID',
        'BrandsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'brands.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Brands.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'brands.createdAt' => 'CREATED_AT',
        'BrandsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'brands.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Brands.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'brands.updatedAt' => 'UPDATED_AT',
        'BrandsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'brands.updated_at' => 'UPDATED_AT',
        'BrandCode' => 'BRAND_CODE',
        'Brands.BrandCode' => 'BRAND_CODE',
        'brandCode' => 'BRAND_CODE',
        'brands.brandCode' => 'BRAND_CODE',
        'BrandsTableMap::COL_BRAND_CODE' => 'BRAND_CODE',
        'COL_BRAND_CODE' => 'BRAND_CODE',
        'brand_code' => 'BRAND_CODE',
        'brands.brand_code' => 'BRAND_CODE',
        'BrandRate' => 'BRAND_RATE',
        'Brands.BrandRate' => 'BRAND_RATE',
        'brandRate' => 'BRAND_RATE',
        'brands.brandRate' => 'BRAND_RATE',
        'BrandsTableMap::COL_BRAND_RATE' => 'BRAND_RATE',
        'COL_BRAND_RATE' => 'BRAND_RATE',
        'brand_rate' => 'BRAND_RATE',
        'brands.brand_rate' => 'BRAND_RATE',
        'MinValue' => 'MIN_VALUE',
        'Brands.MinValue' => 'MIN_VALUE',
        'minValue' => 'MIN_VALUE',
        'brands.minValue' => 'MIN_VALUE',
        'BrandsTableMap::COL_MIN_VALUE' => 'MIN_VALUE',
        'COL_MIN_VALUE' => 'MIN_VALUE',
        'min_value' => 'MIN_VALUE',
        'brands.min_value' => 'MIN_VALUE',
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
        $this->setName('brands');
        $this->setPhpName('Brands');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Brands');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brands_brand_id_seq');
        // columns
        $this->addPrimaryKey('brand_id', 'BrandId', 'INTEGER', true, null, null);
        $this->addColumn('brand_name', 'BrandName', 'VARCHAR', false, null, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('brand_code', 'BrandCode', 'VARCHAR', false, null, null);
        $this->addColumn('brand_rate', 'BrandRate', 'DECIMAL', false, null, null);
        $this->addColumn('min_value', 'MinValue', 'INTEGER', false, null, null);
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
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagn', '\\entities\\BrandCampiagn', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':focus_brand_id',
    1 => ':brand_id',
  ),
), null, null, 'BrandCampiagns', false);
        $this->addRelation('BrandCompetition', '\\entities\\BrandCompetition', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':competitor_brand_id',
    1 => ':brand_id',
  ),
), null, null, 'BrandCompetitions', false);
        $this->addRelation('BrandRcpa', '\\entities\\BrandRcpa', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'BrandRcpas', false);
        $this->addRelation('EdPresentations', '\\entities\\EdPresentations', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'EdPresentationss', false);
        $this->addRelation('EdStats', '\\entities\\EdStats', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'EdStatss', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':focus_brand',
    1 => ':brand_id',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('OutletStock', '\\entities\\OutletStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'OutletStocks', false);
        $this->addRelation('OutletStockOtherSummary', '\\entities\\OutletStockOtherSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'OutletStockOtherSummaries', false);
        $this->addRelation('OutletStockSummary', '\\entities\\OutletStockSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'OutletStockSummaries', false);
        $this->addRelation('PrescriberData', '\\entities\\PrescriberData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'PrescriberDatas', false);
        $this->addRelation('PrescriberTallySummary', '\\entities\\PrescriberTallySummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'PrescriberTallySummaries', false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'Productss', false);
        $this->addRelation('SgpiMaster', '\\entities\\SgpiMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, 'SgpiMasters', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandsTableMap::CLASS_DEFAULT : BrandsTableMap::OM_CLASS;
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
     * @return array (Brands object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandsTableMap::OM_CLASS;
            /** @var Brands $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandsTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Brands $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandsTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(BrandsTableMap::COL_BRAND_NAME);
            $criteria->addSelectColumn(BrandsTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(BrandsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BrandsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BrandsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BrandsTableMap::COL_BRAND_CODE);
            $criteria->addSelectColumn(BrandsTableMap::COL_BRAND_RATE);
            $criteria->addSelectColumn(BrandsTableMap::COL_MIN_VALUE);
        } else {
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.brand_name');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.brand_code');
            $criteria->addSelectColumn($alias . '.brand_rate');
            $criteria->addSelectColumn($alias . '.min_value');
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
            $criteria->removeSelectColumn(BrandsTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(BrandsTableMap::COL_BRAND_NAME);
            $criteria->removeSelectColumn(BrandsTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(BrandsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BrandsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BrandsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BrandsTableMap::COL_BRAND_CODE);
            $criteria->removeSelectColumn(BrandsTableMap::COL_BRAND_RATE);
            $criteria->removeSelectColumn(BrandsTableMap::COL_MIN_VALUE);
        } else {
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.brand_name');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.brand_code');
            $criteria->removeSelectColumn($alias . '.brand_rate');
            $criteria->removeSelectColumn($alias . '.min_value');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandsTableMap::DATABASE_NAME)->getTable(BrandsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Brands or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Brands object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Brands) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandsTableMap::DATABASE_NAME);
            $criteria->add(BrandsTableMap::COL_BRAND_ID, (array) $values, Criteria::IN);
        }

        $query = BrandsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brands table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Brands or Criteria object.
     *
     * @param mixed $criteria Criteria or Brands object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Brands object
        }

        if ($criteria->containsKey(BrandsTableMap::COL_BRAND_ID) && $criteria->keyContainsValue(BrandsTableMap::COL_BRAND_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandsTableMap::COL_BRAND_ID.')');
        }


        // Set the correct dbName
        $query = BrandsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
