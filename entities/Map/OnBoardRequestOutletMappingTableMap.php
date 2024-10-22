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
use entities\OnBoardRequestOutletMapping;
use entities\OnBoardRequestOutletMappingQuery;


/**
 * This class defines the structure of the 'on_board_request_outlet_mapping' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OnBoardRequestOutletMappingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OnBoardRequestOutletMappingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'on_board_request_outlet_mapping';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OnBoardRequestOutletMapping';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OnBoardRequestOutletMapping';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OnBoardRequestOutletMapping';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the on_board_request_outlet_mapping_id field
     */
    public const COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID = 'on_board_request_outlet_mapping.on_board_request_outlet_mapping_id';

    /**
     * the column name for the on_board_request_id field
     */
    public const COL_ON_BOARD_REQUEST_ID = 'on_board_request_outlet_mapping.on_board_request_id';

    /**
     * the column name for the primary_outlet_id field
     */
    public const COL_PRIMARY_OUTLET_ID = 'on_board_request_outlet_mapping.primary_outlet_id';

    /**
     * the column name for the pricebook_id field
     */
    public const COL_PRICEBOOK_ID = 'on_board_request_outlet_mapping.pricebook_id';

    /**
     * the column name for the category field
     */
    public const COL_CATEGORY = 'on_board_request_outlet_mapping.category';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'on_board_request_outlet_mapping.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'on_board_request_outlet_mapping.updated_at';

    /**
     * the column name for the secondary_outlet_id field
     */
    public const COL_SECONDARY_OUTLET_ID = 'on_board_request_outlet_mapping.secondary_outlet_id';

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
        self::TYPE_PHPNAME       => ['OnBoardRequestOutletMappingId', 'OnBoardRequestId', 'PrimaryOutletId', 'PricebookId', 'Category', 'CreatedAt', 'UpdatedAt', 'SecondaryOutletId', ],
        self::TYPE_CAMELNAME     => ['onBoardRequestOutletMappingId', 'onBoardRequestId', 'primaryOutletId', 'pricebookId', 'category', 'createdAt', 'updatedAt', 'secondaryOutletId', ],
        self::TYPE_COLNAME       => [OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID, OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID, OnBoardRequestOutletMappingTableMap::COL_PRIMARY_OUTLET_ID, OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID, OnBoardRequestOutletMappingTableMap::COL_CATEGORY, OnBoardRequestOutletMappingTableMap::COL_CREATED_AT, OnBoardRequestOutletMappingTableMap::COL_UPDATED_AT, OnBoardRequestOutletMappingTableMap::COL_SECONDARY_OUTLET_ID, ],
        self::TYPE_FIELDNAME     => ['on_board_request_outlet_mapping_id', 'on_board_request_id', 'primary_outlet_id', 'pricebook_id', 'category', 'created_at', 'updated_at', 'secondary_outlet_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['OnBoardRequestOutletMappingId' => 0, 'OnBoardRequestId' => 1, 'PrimaryOutletId' => 2, 'PricebookId' => 3, 'Category' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'SecondaryOutletId' => 7, ],
        self::TYPE_CAMELNAME     => ['onBoardRequestOutletMappingId' => 0, 'onBoardRequestId' => 1, 'primaryOutletId' => 2, 'pricebookId' => 3, 'category' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'secondaryOutletId' => 7, ],
        self::TYPE_COLNAME       => [OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID => 0, OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID => 1, OnBoardRequestOutletMappingTableMap::COL_PRIMARY_OUTLET_ID => 2, OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID => 3, OnBoardRequestOutletMappingTableMap::COL_CATEGORY => 4, OnBoardRequestOutletMappingTableMap::COL_CREATED_AT => 5, OnBoardRequestOutletMappingTableMap::COL_UPDATED_AT => 6, OnBoardRequestOutletMappingTableMap::COL_SECONDARY_OUTLET_ID => 7, ],
        self::TYPE_FIELDNAME     => ['on_board_request_outlet_mapping_id' => 0, 'on_board_request_id' => 1, 'primary_outlet_id' => 2, 'pricebook_id' => 3, 'category' => 4, 'created_at' => 5, 'updated_at' => 6, 'secondary_outlet_id' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OnBoardRequestOutletMappingId' => 'ON_BOARD_REQUEST_OUTLET_MAPPING_ID',
        'OnBoardRequestOutletMapping.OnBoardRequestOutletMappingId' => 'ON_BOARD_REQUEST_OUTLET_MAPPING_ID',
        'onBoardRequestOutletMappingId' => 'ON_BOARD_REQUEST_OUTLET_MAPPING_ID',
        'onBoardRequestOutletMapping.onBoardRequestOutletMappingId' => 'ON_BOARD_REQUEST_OUTLET_MAPPING_ID',
        'OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID' => 'ON_BOARD_REQUEST_OUTLET_MAPPING_ID',
        'COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID' => 'ON_BOARD_REQUEST_OUTLET_MAPPING_ID',
        'on_board_request_outlet_mapping_id' => 'ON_BOARD_REQUEST_OUTLET_MAPPING_ID',
        'on_board_request_outlet_mapping.on_board_request_outlet_mapping_id' => 'ON_BOARD_REQUEST_OUTLET_MAPPING_ID',
        'OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequestOutletMapping.OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequestOutletMapping.onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'on_board_request_outlet_mapping.on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'PrimaryOutletId' => 'PRIMARY_OUTLET_ID',
        'OnBoardRequestOutletMapping.PrimaryOutletId' => 'PRIMARY_OUTLET_ID',
        'primaryOutletId' => 'PRIMARY_OUTLET_ID',
        'onBoardRequestOutletMapping.primaryOutletId' => 'PRIMARY_OUTLET_ID',
        'OnBoardRequestOutletMappingTableMap::COL_PRIMARY_OUTLET_ID' => 'PRIMARY_OUTLET_ID',
        'COL_PRIMARY_OUTLET_ID' => 'PRIMARY_OUTLET_ID',
        'primary_outlet_id' => 'PRIMARY_OUTLET_ID',
        'on_board_request_outlet_mapping.primary_outlet_id' => 'PRIMARY_OUTLET_ID',
        'PricebookId' => 'PRICEBOOK_ID',
        'OnBoardRequestOutletMapping.PricebookId' => 'PRICEBOOK_ID',
        'pricebookId' => 'PRICEBOOK_ID',
        'onBoardRequestOutletMapping.pricebookId' => 'PRICEBOOK_ID',
        'OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'pricebook_id' => 'PRICEBOOK_ID',
        'on_board_request_outlet_mapping.pricebook_id' => 'PRICEBOOK_ID',
        'Category' => 'CATEGORY',
        'OnBoardRequestOutletMapping.Category' => 'CATEGORY',
        'category' => 'CATEGORY',
        'onBoardRequestOutletMapping.category' => 'CATEGORY',
        'OnBoardRequestOutletMappingTableMap::COL_CATEGORY' => 'CATEGORY',
        'COL_CATEGORY' => 'CATEGORY',
        'on_board_request_outlet_mapping.category' => 'CATEGORY',
        'CreatedAt' => 'CREATED_AT',
        'OnBoardRequestOutletMapping.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'onBoardRequestOutletMapping.createdAt' => 'CREATED_AT',
        'OnBoardRequestOutletMappingTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'on_board_request_outlet_mapping.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OnBoardRequestOutletMapping.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'onBoardRequestOutletMapping.updatedAt' => 'UPDATED_AT',
        'OnBoardRequestOutletMappingTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'on_board_request_outlet_mapping.updated_at' => 'UPDATED_AT',
        'SecondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'OnBoardRequestOutletMapping.SecondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'secondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'onBoardRequestOutletMapping.secondaryOutletId' => 'SECONDARY_OUTLET_ID',
        'OnBoardRequestOutletMappingTableMap::COL_SECONDARY_OUTLET_ID' => 'SECONDARY_OUTLET_ID',
        'COL_SECONDARY_OUTLET_ID' => 'SECONDARY_OUTLET_ID',
        'secondary_outlet_id' => 'SECONDARY_OUTLET_ID',
        'on_board_request_outlet_mapping.secondary_outlet_id' => 'SECONDARY_OUTLET_ID',
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
        $this->setName('on_board_request_outlet_mapping');
        $this->setPhpName('OnBoardRequestOutletMapping');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OnBoardRequestOutletMapping');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('on_board_request_outlet_mapping_on_board_request_outlet_mapping_id_seq');
        // columns
        $this->addPrimaryKey('on_board_request_outlet_mapping_id', 'OnBoardRequestOutletMappingId', 'INTEGER', true, null, null);
        $this->addForeignKey('on_board_request_id', 'OnBoardRequestId', 'INTEGER', 'on_board_request', 'on_board_request_id', false, null, null);
        $this->addColumn('primary_outlet_id', 'PrimaryOutletId', 'INTEGER', false, null, null);
        $this->addForeignKey('pricebook_id', 'PricebookId', 'INTEGER', 'pricebooks', 'pricebook_id', false, null, null);
        $this->addColumn('category', 'Category', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('secondary_outlet_id', 'SecondaryOutletId', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OnBoardRequest', '\\entities\\OnBoardRequest', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':on_board_request_id',
    1 => ':on_board_request_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestOutletMappingId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestOutletMappingId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestOutletMappingId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestOutletMappingId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestOutletMappingId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestOutletMappingId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OnBoardRequestOutletMappingId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OnBoardRequestOutletMappingTableMap::CLASS_DEFAULT : OnBoardRequestOutletMappingTableMap::OM_CLASS;
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
     * @return array (OnBoardRequestOutletMapping object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OnBoardRequestOutletMappingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OnBoardRequestOutletMappingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OnBoardRequestOutletMappingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OnBoardRequestOutletMappingTableMap::OM_CLASS;
            /** @var OnBoardRequestOutletMapping $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OnBoardRequestOutletMappingTableMap::addInstanceToPool($obj, $key);
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
            $key = OnBoardRequestOutletMappingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OnBoardRequestOutletMappingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OnBoardRequestOutletMapping $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OnBoardRequestOutletMappingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID);
            $criteria->addSelectColumn(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->addSelectColumn(OnBoardRequestOutletMappingTableMap::COL_PRIMARY_OUTLET_ID);
            $criteria->addSelectColumn(OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID);
            $criteria->addSelectColumn(OnBoardRequestOutletMappingTableMap::COL_CATEGORY);
            $criteria->addSelectColumn(OnBoardRequestOutletMappingTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OnBoardRequestOutletMappingTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OnBoardRequestOutletMappingTableMap::COL_SECONDARY_OUTLET_ID);
        } else {
            $criteria->addSelectColumn($alias . '.on_board_request_outlet_mapping_id');
            $criteria->addSelectColumn($alias . '.on_board_request_id');
            $criteria->addSelectColumn($alias . '.primary_outlet_id');
            $criteria->addSelectColumn($alias . '.pricebook_id');
            $criteria->addSelectColumn($alias . '.category');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.secondary_outlet_id');
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
            $criteria->removeSelectColumn(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID);
            $criteria->removeSelectColumn(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->removeSelectColumn(OnBoardRequestOutletMappingTableMap::COL_PRIMARY_OUTLET_ID);
            $criteria->removeSelectColumn(OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID);
            $criteria->removeSelectColumn(OnBoardRequestOutletMappingTableMap::COL_CATEGORY);
            $criteria->removeSelectColumn(OnBoardRequestOutletMappingTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OnBoardRequestOutletMappingTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OnBoardRequestOutletMappingTableMap::COL_SECONDARY_OUTLET_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.on_board_request_outlet_mapping_id');
            $criteria->removeSelectColumn($alias . '.on_board_request_id');
            $criteria->removeSelectColumn($alias . '.primary_outlet_id');
            $criteria->removeSelectColumn($alias . '.pricebook_id');
            $criteria->removeSelectColumn($alias . '.category');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.secondary_outlet_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OnBoardRequestOutletMappingTableMap::DATABASE_NAME)->getTable(OnBoardRequestOutletMappingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OnBoardRequestOutletMapping or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OnBoardRequestOutletMapping object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestOutletMappingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OnBoardRequestOutletMapping) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OnBoardRequestOutletMappingTableMap::DATABASE_NAME);
            $criteria->add(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID, (array) $values, Criteria::IN);
        }

        $query = OnBoardRequestOutletMappingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OnBoardRequestOutletMappingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OnBoardRequestOutletMappingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the on_board_request_outlet_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OnBoardRequestOutletMappingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OnBoardRequestOutletMapping or Criteria object.
     *
     * @param mixed $criteria Criteria or OnBoardRequestOutletMapping object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestOutletMappingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OnBoardRequestOutletMapping object
        }

        if ($criteria->containsKey(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID) && $criteria->keyContainsValue(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID.')');
        }


        // Set the correct dbName
        $query = OnBoardRequestOutletMappingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
