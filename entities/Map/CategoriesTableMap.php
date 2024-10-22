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
use entities\Categories;
use entities\CategoriesQuery;


/**
 * This class defines the structure of the 'categories' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CategoriesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CategoriesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'categories';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Categories';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Categories';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Categories';

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
     * the column name for the id field
     */
    public const COL_ID = 'categories.id';

    /**
     * the column name for the category_name field
     */
    public const COL_CATEGORY_NAME = 'categories.category_name';

    /**
     * the column name for the category_type field
     */
    public const COL_CATEGORY_TYPE = 'categories.category_type';

    /**
     * the column name for the category_description field
     */
    public const COL_CATEGORY_DESCRIPTION = 'categories.category_description';

    /**
     * the column name for the category_media field
     */
    public const COL_CATEGORY_MEDIA = 'categories.category_media';

    /**
     * the column name for the category_display_order field
     */
    public const COL_CATEGORY_DISPLAY_ORDER = 'categories.category_display_order';

    /**
     * the column name for the category_parent_id field
     */
    public const COL_CATEGORY_PARENT_ID = 'categories.category_parent_id';

    /**
     * the column name for the category_code field
     */
    public const COL_CATEGORY_CODE = 'categories.category_code';

    /**
     * the column name for the additional_data field
     */
    public const COL_ADDITIONAL_DATA = 'categories.additional_data';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'categories.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'categories.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'categories.updated_at';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'categories.orgunit_id';

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
        self::TYPE_PHPNAME       => ['Id', 'CategoryName', 'CategoryType', 'CategoryDescription', 'CategoryMedia', 'CategoryDisplayOrder', 'CategoryParentId', 'CategoryCode', 'AdditionalData', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'OrgunitId', ],
        self::TYPE_CAMELNAME     => ['id', 'categoryName', 'categoryType', 'categoryDescription', 'categoryMedia', 'categoryDisplayOrder', 'categoryParentId', 'categoryCode', 'additionalData', 'companyId', 'createdAt', 'updatedAt', 'orgunitId', ],
        self::TYPE_COLNAME       => [CategoriesTableMap::COL_ID, CategoriesTableMap::COL_CATEGORY_NAME, CategoriesTableMap::COL_CATEGORY_TYPE, CategoriesTableMap::COL_CATEGORY_DESCRIPTION, CategoriesTableMap::COL_CATEGORY_MEDIA, CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER, CategoriesTableMap::COL_CATEGORY_PARENT_ID, CategoriesTableMap::COL_CATEGORY_CODE, CategoriesTableMap::COL_ADDITIONAL_DATA, CategoriesTableMap::COL_COMPANY_ID, CategoriesTableMap::COL_CREATED_AT, CategoriesTableMap::COL_UPDATED_AT, CategoriesTableMap::COL_ORGUNIT_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'category_name', 'category_type', 'category_description', 'category_media', 'category_display_order', 'category_parent_id', 'category_code', 'additional_data', 'company_id', 'created_at', 'updated_at', 'orgunit_id', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'CategoryName' => 1, 'CategoryType' => 2, 'CategoryDescription' => 3, 'CategoryMedia' => 4, 'CategoryDisplayOrder' => 5, 'CategoryParentId' => 6, 'CategoryCode' => 7, 'AdditionalData' => 8, 'CompanyId' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'OrgunitId' => 12, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'categoryName' => 1, 'categoryType' => 2, 'categoryDescription' => 3, 'categoryMedia' => 4, 'categoryDisplayOrder' => 5, 'categoryParentId' => 6, 'categoryCode' => 7, 'additionalData' => 8, 'companyId' => 9, 'createdAt' => 10, 'updatedAt' => 11, 'orgunitId' => 12, ],
        self::TYPE_COLNAME       => [CategoriesTableMap::COL_ID => 0, CategoriesTableMap::COL_CATEGORY_NAME => 1, CategoriesTableMap::COL_CATEGORY_TYPE => 2, CategoriesTableMap::COL_CATEGORY_DESCRIPTION => 3, CategoriesTableMap::COL_CATEGORY_MEDIA => 4, CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER => 5, CategoriesTableMap::COL_CATEGORY_PARENT_ID => 6, CategoriesTableMap::COL_CATEGORY_CODE => 7, CategoriesTableMap::COL_ADDITIONAL_DATA => 8, CategoriesTableMap::COL_COMPANY_ID => 9, CategoriesTableMap::COL_CREATED_AT => 10, CategoriesTableMap::COL_UPDATED_AT => 11, CategoriesTableMap::COL_ORGUNIT_ID => 12, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'category_name' => 1, 'category_type' => 2, 'category_description' => 3, 'category_media' => 4, 'category_display_order' => 5, 'category_parent_id' => 6, 'category_code' => 7, 'additional_data' => 8, 'company_id' => 9, 'created_at' => 10, 'updated_at' => 11, 'orgunit_id' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Categories.Id' => 'ID',
        'id' => 'ID',
        'categories.id' => 'ID',
        'CategoriesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'CategoryName' => 'CATEGORY_NAME',
        'Categories.CategoryName' => 'CATEGORY_NAME',
        'categoryName' => 'CATEGORY_NAME',
        'categories.categoryName' => 'CATEGORY_NAME',
        'CategoriesTableMap::COL_CATEGORY_NAME' => 'CATEGORY_NAME',
        'COL_CATEGORY_NAME' => 'CATEGORY_NAME',
        'category_name' => 'CATEGORY_NAME',
        'categories.category_name' => 'CATEGORY_NAME',
        'CategoryType' => 'CATEGORY_TYPE',
        'Categories.CategoryType' => 'CATEGORY_TYPE',
        'categoryType' => 'CATEGORY_TYPE',
        'categories.categoryType' => 'CATEGORY_TYPE',
        'CategoriesTableMap::COL_CATEGORY_TYPE' => 'CATEGORY_TYPE',
        'COL_CATEGORY_TYPE' => 'CATEGORY_TYPE',
        'category_type' => 'CATEGORY_TYPE',
        'categories.category_type' => 'CATEGORY_TYPE',
        'CategoryDescription' => 'CATEGORY_DESCRIPTION',
        'Categories.CategoryDescription' => 'CATEGORY_DESCRIPTION',
        'categoryDescription' => 'CATEGORY_DESCRIPTION',
        'categories.categoryDescription' => 'CATEGORY_DESCRIPTION',
        'CategoriesTableMap::COL_CATEGORY_DESCRIPTION' => 'CATEGORY_DESCRIPTION',
        'COL_CATEGORY_DESCRIPTION' => 'CATEGORY_DESCRIPTION',
        'category_description' => 'CATEGORY_DESCRIPTION',
        'categories.category_description' => 'CATEGORY_DESCRIPTION',
        'CategoryMedia' => 'CATEGORY_MEDIA',
        'Categories.CategoryMedia' => 'CATEGORY_MEDIA',
        'categoryMedia' => 'CATEGORY_MEDIA',
        'categories.categoryMedia' => 'CATEGORY_MEDIA',
        'CategoriesTableMap::COL_CATEGORY_MEDIA' => 'CATEGORY_MEDIA',
        'COL_CATEGORY_MEDIA' => 'CATEGORY_MEDIA',
        'category_media' => 'CATEGORY_MEDIA',
        'categories.category_media' => 'CATEGORY_MEDIA',
        'CategoryDisplayOrder' => 'CATEGORY_DISPLAY_ORDER',
        'Categories.CategoryDisplayOrder' => 'CATEGORY_DISPLAY_ORDER',
        'categoryDisplayOrder' => 'CATEGORY_DISPLAY_ORDER',
        'categories.categoryDisplayOrder' => 'CATEGORY_DISPLAY_ORDER',
        'CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER' => 'CATEGORY_DISPLAY_ORDER',
        'COL_CATEGORY_DISPLAY_ORDER' => 'CATEGORY_DISPLAY_ORDER',
        'category_display_order' => 'CATEGORY_DISPLAY_ORDER',
        'categories.category_display_order' => 'CATEGORY_DISPLAY_ORDER',
        'CategoryParentId' => 'CATEGORY_PARENT_ID',
        'Categories.CategoryParentId' => 'CATEGORY_PARENT_ID',
        'categoryParentId' => 'CATEGORY_PARENT_ID',
        'categories.categoryParentId' => 'CATEGORY_PARENT_ID',
        'CategoriesTableMap::COL_CATEGORY_PARENT_ID' => 'CATEGORY_PARENT_ID',
        'COL_CATEGORY_PARENT_ID' => 'CATEGORY_PARENT_ID',
        'category_parent_id' => 'CATEGORY_PARENT_ID',
        'categories.category_parent_id' => 'CATEGORY_PARENT_ID',
        'CategoryCode' => 'CATEGORY_CODE',
        'Categories.CategoryCode' => 'CATEGORY_CODE',
        'categoryCode' => 'CATEGORY_CODE',
        'categories.categoryCode' => 'CATEGORY_CODE',
        'CategoriesTableMap::COL_CATEGORY_CODE' => 'CATEGORY_CODE',
        'COL_CATEGORY_CODE' => 'CATEGORY_CODE',
        'category_code' => 'CATEGORY_CODE',
        'categories.category_code' => 'CATEGORY_CODE',
        'AdditionalData' => 'ADDITIONAL_DATA',
        'Categories.AdditionalData' => 'ADDITIONAL_DATA',
        'additionalData' => 'ADDITIONAL_DATA',
        'categories.additionalData' => 'ADDITIONAL_DATA',
        'CategoriesTableMap::COL_ADDITIONAL_DATA' => 'ADDITIONAL_DATA',
        'COL_ADDITIONAL_DATA' => 'ADDITIONAL_DATA',
        'additional_data' => 'ADDITIONAL_DATA',
        'categories.additional_data' => 'ADDITIONAL_DATA',
        'CompanyId' => 'COMPANY_ID',
        'Categories.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'categories.companyId' => 'COMPANY_ID',
        'CategoriesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'categories.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Categories.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'categories.createdAt' => 'CREATED_AT',
        'CategoriesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'categories.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Categories.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'categories.updatedAt' => 'UPDATED_AT',
        'CategoriesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'categories.updated_at' => 'UPDATED_AT',
        'OrgunitId' => 'ORGUNIT_ID',
        'Categories.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'categories.orgunitId' => 'ORGUNIT_ID',
        'CategoriesTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'categories.orgunit_id' => 'ORGUNIT_ID',
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
        $this->setName('categories');
        $this->setPhpName('Categories');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Categories');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('categories_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('category_name', 'CategoryName', 'VARCHAR', true, 255, null);
        $this->addColumn('category_type', 'CategoryType', 'VARCHAR', true, 255, null);
        $this->addColumn('category_description', 'CategoryDescription', 'VARCHAR', false, 255, null);
        $this->addColumn('category_media', 'CategoryMedia', 'VARCHAR', false, 255, null);
        $this->addColumn('category_display_order', 'CategoryDisplayOrder', 'INTEGER', true, null, 0);
        $this->addColumn('category_parent_id', 'CategoryParentId', 'INTEGER', false, null, null);
        $this->addColumn('category_code', 'CategoryCode', 'VARCHAR', false, 255, null);
        $this->addColumn('additional_data', 'AdditionalData', 'VARCHAR', false, 100, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('orgunit_id', 'OrgunitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
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
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':category_id',
    1 => ':id',
  ),
), null, null, 'Productss', false);
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
        return $withPrefix ? CategoriesTableMap::CLASS_DEFAULT : CategoriesTableMap::OM_CLASS;
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
     * @return array (Categories object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CategoriesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CategoriesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CategoriesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CategoriesTableMap::OM_CLASS;
            /** @var Categories $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CategoriesTableMap::addInstanceToPool($obj, $key);
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
            $key = CategoriesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CategoriesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Categories $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CategoriesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CategoriesTableMap::COL_ID);
            $criteria->addSelectColumn(CategoriesTableMap::COL_CATEGORY_NAME);
            $criteria->addSelectColumn(CategoriesTableMap::COL_CATEGORY_TYPE);
            $criteria->addSelectColumn(CategoriesTableMap::COL_CATEGORY_DESCRIPTION);
            $criteria->addSelectColumn(CategoriesTableMap::COL_CATEGORY_MEDIA);
            $criteria->addSelectColumn(CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER);
            $criteria->addSelectColumn(CategoriesTableMap::COL_CATEGORY_PARENT_ID);
            $criteria->addSelectColumn(CategoriesTableMap::COL_CATEGORY_CODE);
            $criteria->addSelectColumn(CategoriesTableMap::COL_ADDITIONAL_DATA);
            $criteria->addSelectColumn(CategoriesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(CategoriesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(CategoriesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(CategoriesTableMap::COL_ORGUNIT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.category_name');
            $criteria->addSelectColumn($alias . '.category_type');
            $criteria->addSelectColumn($alias . '.category_description');
            $criteria->addSelectColumn($alias . '.category_media');
            $criteria->addSelectColumn($alias . '.category_display_order');
            $criteria->addSelectColumn($alias . '.category_parent_id');
            $criteria->addSelectColumn($alias . '.category_code');
            $criteria->addSelectColumn($alias . '.additional_data');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.orgunit_id');
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
            $criteria->removeSelectColumn(CategoriesTableMap::COL_ID);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_CATEGORY_NAME);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_CATEGORY_TYPE);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_CATEGORY_DESCRIPTION);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_CATEGORY_MEDIA);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_CATEGORY_PARENT_ID);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_CATEGORY_CODE);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_ADDITIONAL_DATA);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(CategoriesTableMap::COL_ORGUNIT_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.category_name');
            $criteria->removeSelectColumn($alias . '.category_type');
            $criteria->removeSelectColumn($alias . '.category_description');
            $criteria->removeSelectColumn($alias . '.category_media');
            $criteria->removeSelectColumn($alias . '.category_display_order');
            $criteria->removeSelectColumn($alias . '.category_parent_id');
            $criteria->removeSelectColumn($alias . '.category_code');
            $criteria->removeSelectColumn($alias . '.additional_data');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(CategoriesTableMap::DATABASE_NAME)->getTable(CategoriesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Categories or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Categories object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Categories) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CategoriesTableMap::DATABASE_NAME);
            $criteria->add(CategoriesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CategoriesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CategoriesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CategoriesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CategoriesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Categories or Criteria object.
     *
     * @param mixed $criteria Criteria or Categories object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Categories object
        }

        if ($criteria->containsKey(CategoriesTableMap::COL_ID) && $criteria->keyContainsValue(CategoriesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CategoriesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CategoriesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
