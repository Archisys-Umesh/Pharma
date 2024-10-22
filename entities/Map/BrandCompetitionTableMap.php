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
use entities\BrandCompetition;
use entities\BrandCompetitionQuery;


/**
 * This class defines the structure of the 'brand_competition' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandCompetitionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandCompetitionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brand_competition';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BrandCompetition';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BrandCompetition';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BrandCompetition';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the competitor_id field
     */
    public const COL_COMPETITOR_ID = 'brand_competition.competitor_id';

    /**
     * the column name for the competitor_name field
     */
    public const COL_COMPETITOR_NAME = 'brand_competition.competitor_name';

    /**
     * the column name for the competitor_brand_id field
     */
    public const COL_COMPETITOR_BRAND_ID = 'brand_competition.competitor_brand_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'brand_competition.company_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'brand_competition.orgunitid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'brand_competition.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'brand_competition.updated_at';

    /**
     * the column name for the istateids field
     */
    public const COL_ISTATEIDS = 'brand_competition.istateids';

    /**
     * the column name for the drate field
     */
    public const COL_DRATE = 'brand_competition.drate';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'brand_competition.product_id';

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
        self::TYPE_PHPNAME       => ['CompetitorId', 'CompetitorName', 'CompetitorBrandId', 'CompanyId', 'Orgunitid', 'CreatedAt', 'UpdatedAt', 'Istateids', 'Drate', 'ProductId', ],
        self::TYPE_CAMELNAME     => ['competitorId', 'competitorName', 'competitorBrandId', 'companyId', 'orgunitid', 'createdAt', 'updatedAt', 'istateids', 'drate', 'productId', ],
        self::TYPE_COLNAME       => [BrandCompetitionTableMap::COL_COMPETITOR_ID, BrandCompetitionTableMap::COL_COMPETITOR_NAME, BrandCompetitionTableMap::COL_COMPETITOR_BRAND_ID, BrandCompetitionTableMap::COL_COMPANY_ID, BrandCompetitionTableMap::COL_ORGUNITID, BrandCompetitionTableMap::COL_CREATED_AT, BrandCompetitionTableMap::COL_UPDATED_AT, BrandCompetitionTableMap::COL_ISTATEIDS, BrandCompetitionTableMap::COL_DRATE, BrandCompetitionTableMap::COL_PRODUCT_ID, ],
        self::TYPE_FIELDNAME     => ['competitor_id', 'competitor_name', 'competitor_brand_id', 'company_id', 'orgunitid', 'created_at', 'updated_at', 'istateids', 'drate', 'product_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['CompetitorId' => 0, 'CompetitorName' => 1, 'CompetitorBrandId' => 2, 'CompanyId' => 3, 'Orgunitid' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'Istateids' => 7, 'Drate' => 8, 'ProductId' => 9, ],
        self::TYPE_CAMELNAME     => ['competitorId' => 0, 'competitorName' => 1, 'competitorBrandId' => 2, 'companyId' => 3, 'orgunitid' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'istateids' => 7, 'drate' => 8, 'productId' => 9, ],
        self::TYPE_COLNAME       => [BrandCompetitionTableMap::COL_COMPETITOR_ID => 0, BrandCompetitionTableMap::COL_COMPETITOR_NAME => 1, BrandCompetitionTableMap::COL_COMPETITOR_BRAND_ID => 2, BrandCompetitionTableMap::COL_COMPANY_ID => 3, BrandCompetitionTableMap::COL_ORGUNITID => 4, BrandCompetitionTableMap::COL_CREATED_AT => 5, BrandCompetitionTableMap::COL_UPDATED_AT => 6, BrandCompetitionTableMap::COL_ISTATEIDS => 7, BrandCompetitionTableMap::COL_DRATE => 8, BrandCompetitionTableMap::COL_PRODUCT_ID => 9, ],
        self::TYPE_FIELDNAME     => ['competitor_id' => 0, 'competitor_name' => 1, 'competitor_brand_id' => 2, 'company_id' => 3, 'orgunitid' => 4, 'created_at' => 5, 'updated_at' => 6, 'istateids' => 7, 'drate' => 8, 'product_id' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CompetitorId' => 'COMPETITOR_ID',
        'BrandCompetition.CompetitorId' => 'COMPETITOR_ID',
        'competitorId' => 'COMPETITOR_ID',
        'brandCompetition.competitorId' => 'COMPETITOR_ID',
        'BrandCompetitionTableMap::COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'competitor_id' => 'COMPETITOR_ID',
        'brand_competition.competitor_id' => 'COMPETITOR_ID',
        'CompetitorName' => 'COMPETITOR_NAME',
        'BrandCompetition.CompetitorName' => 'COMPETITOR_NAME',
        'competitorName' => 'COMPETITOR_NAME',
        'brandCompetition.competitorName' => 'COMPETITOR_NAME',
        'BrandCompetitionTableMap::COL_COMPETITOR_NAME' => 'COMPETITOR_NAME',
        'COL_COMPETITOR_NAME' => 'COMPETITOR_NAME',
        'competitor_name' => 'COMPETITOR_NAME',
        'brand_competition.competitor_name' => 'COMPETITOR_NAME',
        'CompetitorBrandId' => 'COMPETITOR_BRAND_ID',
        'BrandCompetition.CompetitorBrandId' => 'COMPETITOR_BRAND_ID',
        'competitorBrandId' => 'COMPETITOR_BRAND_ID',
        'brandCompetition.competitorBrandId' => 'COMPETITOR_BRAND_ID',
        'BrandCompetitionTableMap::COL_COMPETITOR_BRAND_ID' => 'COMPETITOR_BRAND_ID',
        'COL_COMPETITOR_BRAND_ID' => 'COMPETITOR_BRAND_ID',
        'competitor_brand_id' => 'COMPETITOR_BRAND_ID',
        'brand_competition.competitor_brand_id' => 'COMPETITOR_BRAND_ID',
        'CompanyId' => 'COMPANY_ID',
        'BrandCompetition.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'brandCompetition.companyId' => 'COMPANY_ID',
        'BrandCompetitionTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'brand_competition.company_id' => 'COMPANY_ID',
        'Orgunitid' => 'ORGUNITID',
        'BrandCompetition.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'brandCompetition.orgunitid' => 'ORGUNITID',
        'BrandCompetitionTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'brand_competition.orgunitid' => 'ORGUNITID',
        'CreatedAt' => 'CREATED_AT',
        'BrandCompetition.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'brandCompetition.createdAt' => 'CREATED_AT',
        'BrandCompetitionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'brand_competition.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BrandCompetition.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'brandCompetition.updatedAt' => 'UPDATED_AT',
        'BrandCompetitionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'brand_competition.updated_at' => 'UPDATED_AT',
        'Istateids' => 'ISTATEIDS',
        'BrandCompetition.Istateids' => 'ISTATEIDS',
        'istateids' => 'ISTATEIDS',
        'brandCompetition.istateids' => 'ISTATEIDS',
        'BrandCompetitionTableMap::COL_ISTATEIDS' => 'ISTATEIDS',
        'COL_ISTATEIDS' => 'ISTATEIDS',
        'brand_competition.istateids' => 'ISTATEIDS',
        'Drate' => 'DRATE',
        'BrandCompetition.Drate' => 'DRATE',
        'drate' => 'DRATE',
        'brandCompetition.drate' => 'DRATE',
        'BrandCompetitionTableMap::COL_DRATE' => 'DRATE',
        'COL_DRATE' => 'DRATE',
        'brand_competition.drate' => 'DRATE',
        'ProductId' => 'PRODUCT_ID',
        'BrandCompetition.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'brandCompetition.productId' => 'PRODUCT_ID',
        'BrandCompetitionTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'brand_competition.product_id' => 'PRODUCT_ID',
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
        $this->setName('brand_competition');
        $this->setPhpName('BrandCompetition');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BrandCompetition');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brand_competition_competitor_id_seq');
        // columns
        $this->addPrimaryKey('competitor_id', 'CompetitorId', 'INTEGER', true, null, null);
        $this->addColumn('competitor_name', 'CompetitorName', 'VARCHAR', false, null, null);
        $this->addForeignKey('competitor_brand_id', 'CompetitorBrandId', 'INTEGER', 'brands', 'brand_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('istateids', 'Istateids', 'VARCHAR', false, null, null);
        $this->addColumn('drate', 'Drate', 'DECIMAL', false, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':competitor_brand_id',
    1 => ':brand_id',
  ),
), null, null, null, false);
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
        $this->addRelation('Products', '\\entities\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandCompetitionTableMap::CLASS_DEFAULT : BrandCompetitionTableMap::OM_CLASS;
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
     * @return array (BrandCompetition object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandCompetitionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandCompetitionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandCompetitionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandCompetitionTableMap::OM_CLASS;
            /** @var BrandCompetition $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandCompetitionTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandCompetitionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandCompetitionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BrandCompetition $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandCompetitionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_COMPETITOR_ID);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_COMPETITOR_NAME);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_COMPETITOR_BRAND_ID);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_ISTATEIDS);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_DRATE);
            $criteria->addSelectColumn(BrandCompetitionTableMap::COL_PRODUCT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.competitor_id');
            $criteria->addSelectColumn($alias . '.competitor_name');
            $criteria->addSelectColumn($alias . '.competitor_brand_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.istateids');
            $criteria->addSelectColumn($alias . '.drate');
            $criteria->addSelectColumn($alias . '.product_id');
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
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_COMPETITOR_ID);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_COMPETITOR_NAME);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_COMPETITOR_BRAND_ID);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_ISTATEIDS);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_DRATE);
            $criteria->removeSelectColumn(BrandCompetitionTableMap::COL_PRODUCT_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.competitor_id');
            $criteria->removeSelectColumn($alias . '.competitor_name');
            $criteria->removeSelectColumn($alias . '.competitor_brand_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.istateids');
            $criteria->removeSelectColumn($alias . '.drate');
            $criteria->removeSelectColumn($alias . '.product_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandCompetitionTableMap::DATABASE_NAME)->getTable(BrandCompetitionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BrandCompetition or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BrandCompetition object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCompetitionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BrandCompetition) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandCompetitionTableMap::DATABASE_NAME);
            $criteria->add(BrandCompetitionTableMap::COL_COMPETITOR_ID, (array) $values, Criteria::IN);
        }

        $query = BrandCompetitionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandCompetitionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandCompetitionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brand_competition table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandCompetitionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BrandCompetition or Criteria object.
     *
     * @param mixed $criteria Criteria or BrandCompetition object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCompetitionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BrandCompetition object
        }

        if ($criteria->containsKey(BrandCompetitionTableMap::COL_COMPETITOR_ID) && $criteria->keyContainsValue(BrandCompetitionTableMap::COL_COMPETITOR_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandCompetitionTableMap::COL_COMPETITOR_ID.')');
        }


        // Set the correct dbName
        $query = BrandCompetitionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
