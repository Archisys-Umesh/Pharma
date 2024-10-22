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
use entities\Pricebooklines;
use entities\PricebooklinesQuery;


/**
 * This class defines the structure of the 'pricebooklines' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PricebooklinesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.PricebooklinesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pricebooklines';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Pricebooklines';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Pricebooklines';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Pricebooklines';

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
     * the column name for the id field
     */
    public const COL_ID = 'pricebooklines.id';

    /**
     * the column name for the pricebook_id field
     */
    public const COL_PRICEBOOK_ID = 'pricebooklines.pricebook_id';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'pricebooklines.product_id';

    /**
     * the column name for the max_retail_price field
     */
    public const COL_MAX_RETAIL_PRICE = 'pricebooklines.max_retail_price';

    /**
     * the column name for the selling_price field
     */
    public const COL_SELLING_PRICE = 'pricebooklines.selling_price';

    /**
     * the column name for the additional_remark field
     */
    public const COL_ADDITIONAL_REMARK = 'pricebooklines.additional_remark';

    /**
     * the column name for the isenabled field
     */
    public const COL_ISENABLED = 'pricebooklines.isenabled';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'pricebooklines.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'pricebooklines.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'pricebooklines.updated_at';

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
        self::TYPE_PHPNAME       => ['Id', 'PricebookId', 'ProductId', 'MaxRetailPrice', 'SellingPrice', 'AdditionalRemark', 'Isenabled', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'pricebookId', 'productId', 'maxRetailPrice', 'sellingPrice', 'additionalRemark', 'isenabled', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [PricebooklinesTableMap::COL_ID, PricebooklinesTableMap::COL_PRICEBOOK_ID, PricebooklinesTableMap::COL_PRODUCT_ID, PricebooklinesTableMap::COL_MAX_RETAIL_PRICE, PricebooklinesTableMap::COL_SELLING_PRICE, PricebooklinesTableMap::COL_ADDITIONAL_REMARK, PricebooklinesTableMap::COL_ISENABLED, PricebooklinesTableMap::COL_COMPANY_ID, PricebooklinesTableMap::COL_CREATED_AT, PricebooklinesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'pricebook_id', 'product_id', 'max_retail_price', 'selling_price', 'additional_remark', 'isenabled', 'company_id', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'PricebookId' => 1, 'ProductId' => 2, 'MaxRetailPrice' => 3, 'SellingPrice' => 4, 'AdditionalRemark' => 5, 'Isenabled' => 6, 'CompanyId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'pricebookId' => 1, 'productId' => 2, 'maxRetailPrice' => 3, 'sellingPrice' => 4, 'additionalRemark' => 5, 'isenabled' => 6, 'companyId' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [PricebooklinesTableMap::COL_ID => 0, PricebooklinesTableMap::COL_PRICEBOOK_ID => 1, PricebooklinesTableMap::COL_PRODUCT_ID => 2, PricebooklinesTableMap::COL_MAX_RETAIL_PRICE => 3, PricebooklinesTableMap::COL_SELLING_PRICE => 4, PricebooklinesTableMap::COL_ADDITIONAL_REMARK => 5, PricebooklinesTableMap::COL_ISENABLED => 6, PricebooklinesTableMap::COL_COMPANY_ID => 7, PricebooklinesTableMap::COL_CREATED_AT => 8, PricebooklinesTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'pricebook_id' => 1, 'product_id' => 2, 'max_retail_price' => 3, 'selling_price' => 4, 'additional_remark' => 5, 'isenabled' => 6, 'company_id' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Pricebooklines.Id' => 'ID',
        'id' => 'ID',
        'pricebooklines.id' => 'ID',
        'PricebooklinesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'PricebookId' => 'PRICEBOOK_ID',
        'Pricebooklines.PricebookId' => 'PRICEBOOK_ID',
        'pricebookId' => 'PRICEBOOK_ID',
        'pricebooklines.pricebookId' => 'PRICEBOOK_ID',
        'PricebooklinesTableMap::COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'pricebook_id' => 'PRICEBOOK_ID',
        'pricebooklines.pricebook_id' => 'PRICEBOOK_ID',
        'ProductId' => 'PRODUCT_ID',
        'Pricebooklines.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'pricebooklines.productId' => 'PRODUCT_ID',
        'PricebooklinesTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'pricebooklines.product_id' => 'PRODUCT_ID',
        'MaxRetailPrice' => 'MAX_RETAIL_PRICE',
        'Pricebooklines.MaxRetailPrice' => 'MAX_RETAIL_PRICE',
        'maxRetailPrice' => 'MAX_RETAIL_PRICE',
        'pricebooklines.maxRetailPrice' => 'MAX_RETAIL_PRICE',
        'PricebooklinesTableMap::COL_MAX_RETAIL_PRICE' => 'MAX_RETAIL_PRICE',
        'COL_MAX_RETAIL_PRICE' => 'MAX_RETAIL_PRICE',
        'max_retail_price' => 'MAX_RETAIL_PRICE',
        'pricebooklines.max_retail_price' => 'MAX_RETAIL_PRICE',
        'SellingPrice' => 'SELLING_PRICE',
        'Pricebooklines.SellingPrice' => 'SELLING_PRICE',
        'sellingPrice' => 'SELLING_PRICE',
        'pricebooklines.sellingPrice' => 'SELLING_PRICE',
        'PricebooklinesTableMap::COL_SELLING_PRICE' => 'SELLING_PRICE',
        'COL_SELLING_PRICE' => 'SELLING_PRICE',
        'selling_price' => 'SELLING_PRICE',
        'pricebooklines.selling_price' => 'SELLING_PRICE',
        'AdditionalRemark' => 'ADDITIONAL_REMARK',
        'Pricebooklines.AdditionalRemark' => 'ADDITIONAL_REMARK',
        'additionalRemark' => 'ADDITIONAL_REMARK',
        'pricebooklines.additionalRemark' => 'ADDITIONAL_REMARK',
        'PricebooklinesTableMap::COL_ADDITIONAL_REMARK' => 'ADDITIONAL_REMARK',
        'COL_ADDITIONAL_REMARK' => 'ADDITIONAL_REMARK',
        'additional_remark' => 'ADDITIONAL_REMARK',
        'pricebooklines.additional_remark' => 'ADDITIONAL_REMARK',
        'Isenabled' => 'ISENABLED',
        'Pricebooklines.Isenabled' => 'ISENABLED',
        'isenabled' => 'ISENABLED',
        'pricebooklines.isenabled' => 'ISENABLED',
        'PricebooklinesTableMap::COL_ISENABLED' => 'ISENABLED',
        'COL_ISENABLED' => 'ISENABLED',
        'CompanyId' => 'COMPANY_ID',
        'Pricebooklines.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'pricebooklines.companyId' => 'COMPANY_ID',
        'PricebooklinesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'pricebooklines.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Pricebooklines.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'pricebooklines.createdAt' => 'CREATED_AT',
        'PricebooklinesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'pricebooklines.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Pricebooklines.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'pricebooklines.updatedAt' => 'UPDATED_AT',
        'PricebooklinesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'pricebooklines.updated_at' => 'UPDATED_AT',
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
        $this->setName('pricebooklines');
        $this->setPhpName('Pricebooklines');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Pricebooklines');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('pricebooklines_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('pricebook_id', 'PricebookId', 'INTEGER', 'pricebooks', 'pricebook_id', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, null);
        $this->addColumn('max_retail_price', 'MaxRetailPrice', 'DECIMAL', true, 8, null);
        $this->addColumn('selling_price', 'SellingPrice', 'DECIMAL', true, 8, null);
        $this->addColumn('additional_remark', 'AdditionalRemark', 'VARCHAR', false, 255, null);
        $this->addColumn('isenabled', 'Isenabled', 'SMALLINT', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
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
        $this->addRelation('Products', '\\entities\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Pricebooks', '\\entities\\Pricebooks', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':pricebook_id',
    1 => ':pricebook_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PricebooklinesTableMap::CLASS_DEFAULT : PricebooklinesTableMap::OM_CLASS;
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
     * @return array (Pricebooklines object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PricebooklinesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PricebooklinesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PricebooklinesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PricebooklinesTableMap::OM_CLASS;
            /** @var Pricebooklines $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PricebooklinesTableMap::addInstanceToPool($obj, $key);
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
            $key = PricebooklinesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PricebooklinesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Pricebooklines $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PricebooklinesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_ID);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_PRICEBOOK_ID);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_MAX_RETAIL_PRICE);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_SELLING_PRICE);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_ADDITIONAL_REMARK);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_ISENABLED);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PricebooklinesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.pricebook_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.max_retail_price');
            $criteria->addSelectColumn($alias . '.selling_price');
            $criteria->addSelectColumn($alias . '.additional_remark');
            $criteria->addSelectColumn($alias . '.isenabled');
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
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_ID);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_PRICEBOOK_ID);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_MAX_RETAIL_PRICE);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_SELLING_PRICE);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_ADDITIONAL_REMARK);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_ISENABLED);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PricebooklinesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.pricebook_id');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.max_retail_price');
            $criteria->removeSelectColumn($alias . '.selling_price');
            $criteria->removeSelectColumn($alias . '.additional_remark');
            $criteria->removeSelectColumn($alias . '.isenabled');
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
        return Propel::getServiceContainer()->getDatabaseMap(PricebooklinesTableMap::DATABASE_NAME)->getTable(PricebooklinesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Pricebooklines or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Pricebooklines object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooklinesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Pricebooklines) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PricebooklinesTableMap::DATABASE_NAME);
            $criteria->add(PricebooklinesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PricebooklinesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PricebooklinesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PricebooklinesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pricebooklines table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PricebooklinesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Pricebooklines or Criteria object.
     *
     * @param mixed $criteria Criteria or Pricebooklines object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooklinesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Pricebooklines object
        }

        if ($criteria->containsKey(PricebooklinesTableMap::COL_ID) && $criteria->keyContainsValue(PricebooklinesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PricebooklinesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PricebooklinesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
