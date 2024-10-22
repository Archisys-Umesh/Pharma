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
use entities\OnBoardRequiredFields;
use entities\OnBoardRequiredFieldsQuery;


/**
 * This class defines the structure of the 'on_board_required_fields' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OnBoardRequiredFieldsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OnBoardRequiredFieldsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'on_board_required_fields';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OnBoardRequiredFields';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OnBoardRequiredFields';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OnBoardRequiredFields';

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
     * the column name for the on_board_required_fields_id field
     */
    public const COL_ON_BOARD_REQUIRED_FIELDS_ID = 'on_board_required_fields.on_board_required_fields_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'on_board_required_fields.org_unit_id';

    /**
     * the column name for the outlet_type_id field
     */
    public const COL_OUTLET_TYPE_ID = 'on_board_required_fields.outlet_type_id';

    /**
     * the column name for the required_fields field
     */
    public const COL_REQUIRED_FIELDS = 'on_board_required_fields.required_fields';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'on_board_required_fields.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'on_board_required_fields.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'on_board_required_fields.updated_at';

    /**
     * the column name for the status_type_id field
     */
    public const COL_STATUS_TYPE_ID = 'on_board_required_fields.status_type_id';

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
        self::TYPE_PHPNAME       => ['OnBoardRequiredFieldsId', 'OrgUnitId', 'OutletTypeId', 'RequiredFields', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'StatusTypeId', ],
        self::TYPE_CAMELNAME     => ['onBoardRequiredFieldsId', 'orgUnitId', 'outletTypeId', 'requiredFields', 'companyId', 'createdAt', 'updatedAt', 'statusTypeId', ],
        self::TYPE_COLNAME       => [OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID, OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID, OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID, OnBoardRequiredFieldsTableMap::COL_REQUIRED_FIELDS, OnBoardRequiredFieldsTableMap::COL_COMPANY_ID, OnBoardRequiredFieldsTableMap::COL_CREATED_AT, OnBoardRequiredFieldsTableMap::COL_UPDATED_AT, OnBoardRequiredFieldsTableMap::COL_STATUS_TYPE_ID, ],
        self::TYPE_FIELDNAME     => ['on_board_required_fields_id', 'org_unit_id', 'outlet_type_id', 'required_fields', 'company_id', 'created_at', 'updated_at', 'status_type_id', ],
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
        self::TYPE_PHPNAME       => ['OnBoardRequiredFieldsId' => 0, 'OrgUnitId' => 1, 'OutletTypeId' => 2, 'RequiredFields' => 3, 'CompanyId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'StatusTypeId' => 7, ],
        self::TYPE_CAMELNAME     => ['onBoardRequiredFieldsId' => 0, 'orgUnitId' => 1, 'outletTypeId' => 2, 'requiredFields' => 3, 'companyId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'statusTypeId' => 7, ],
        self::TYPE_COLNAME       => [OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID => 0, OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID => 1, OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID => 2, OnBoardRequiredFieldsTableMap::COL_REQUIRED_FIELDS => 3, OnBoardRequiredFieldsTableMap::COL_COMPANY_ID => 4, OnBoardRequiredFieldsTableMap::COL_CREATED_AT => 5, OnBoardRequiredFieldsTableMap::COL_UPDATED_AT => 6, OnBoardRequiredFieldsTableMap::COL_STATUS_TYPE_ID => 7, ],
        self::TYPE_FIELDNAME     => ['on_board_required_fields_id' => 0, 'org_unit_id' => 1, 'outlet_type_id' => 2, 'required_fields' => 3, 'company_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'status_type_id' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OnBoardRequiredFieldsId' => 'ON_BOARD_REQUIRED_FIELDS_ID',
        'OnBoardRequiredFields.OnBoardRequiredFieldsId' => 'ON_BOARD_REQUIRED_FIELDS_ID',
        'onBoardRequiredFieldsId' => 'ON_BOARD_REQUIRED_FIELDS_ID',
        'onBoardRequiredFields.onBoardRequiredFieldsId' => 'ON_BOARD_REQUIRED_FIELDS_ID',
        'OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID' => 'ON_BOARD_REQUIRED_FIELDS_ID',
        'COL_ON_BOARD_REQUIRED_FIELDS_ID' => 'ON_BOARD_REQUIRED_FIELDS_ID',
        'on_board_required_fields_id' => 'ON_BOARD_REQUIRED_FIELDS_ID',
        'on_board_required_fields.on_board_required_fields_id' => 'ON_BOARD_REQUIRED_FIELDS_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'OnBoardRequiredFields.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'onBoardRequiredFields.orgUnitId' => 'ORG_UNIT_ID',
        'OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'on_board_required_fields.org_unit_id' => 'ORG_UNIT_ID',
        'OutletTypeId' => 'OUTLET_TYPE_ID',
        'OnBoardRequiredFields.OutletTypeId' => 'OUTLET_TYPE_ID',
        'outletTypeId' => 'OUTLET_TYPE_ID',
        'onBoardRequiredFields.outletTypeId' => 'OUTLET_TYPE_ID',
        'OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'outlet_type_id' => 'OUTLET_TYPE_ID',
        'on_board_required_fields.outlet_type_id' => 'OUTLET_TYPE_ID',
        'RequiredFields' => 'REQUIRED_FIELDS',
        'OnBoardRequiredFields.RequiredFields' => 'REQUIRED_FIELDS',
        'requiredFields' => 'REQUIRED_FIELDS',
        'onBoardRequiredFields.requiredFields' => 'REQUIRED_FIELDS',
        'OnBoardRequiredFieldsTableMap::COL_REQUIRED_FIELDS' => 'REQUIRED_FIELDS',
        'COL_REQUIRED_FIELDS' => 'REQUIRED_FIELDS',
        'required_fields' => 'REQUIRED_FIELDS',
        'on_board_required_fields.required_fields' => 'REQUIRED_FIELDS',
        'CompanyId' => 'COMPANY_ID',
        'OnBoardRequiredFields.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'onBoardRequiredFields.companyId' => 'COMPANY_ID',
        'OnBoardRequiredFieldsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'on_board_required_fields.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'OnBoardRequiredFields.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'onBoardRequiredFields.createdAt' => 'CREATED_AT',
        'OnBoardRequiredFieldsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'on_board_required_fields.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OnBoardRequiredFields.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'onBoardRequiredFields.updatedAt' => 'UPDATED_AT',
        'OnBoardRequiredFieldsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'on_board_required_fields.updated_at' => 'UPDATED_AT',
        'StatusTypeId' => 'STATUS_TYPE_ID',
        'OnBoardRequiredFields.StatusTypeId' => 'STATUS_TYPE_ID',
        'statusTypeId' => 'STATUS_TYPE_ID',
        'onBoardRequiredFields.statusTypeId' => 'STATUS_TYPE_ID',
        'OnBoardRequiredFieldsTableMap::COL_STATUS_TYPE_ID' => 'STATUS_TYPE_ID',
        'COL_STATUS_TYPE_ID' => 'STATUS_TYPE_ID',
        'status_type_id' => 'STATUS_TYPE_ID',
        'on_board_required_fields.status_type_id' => 'STATUS_TYPE_ID',
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
        $this->setName('on_board_required_fields');
        $this->setPhpName('OnBoardRequiredFields');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OnBoardRequiredFields');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('on_board_required_fields_on_board_required_fields_id_seq');
        // columns
        $this->addPrimaryKey('on_board_required_fields_id', 'OnBoardRequiredFieldsId', 'INTEGER', true, null, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addForeignKey('outlet_type_id', 'OutletTypeId', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addColumn('required_fields', 'RequiredFields', 'JSON', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('status_type_id', 'StatusTypeId', 'INTEGER', false, null, null);
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
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequiredFieldsId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequiredFieldsId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequiredFieldsId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequiredFieldsId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequiredFieldsId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequiredFieldsId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OnBoardRequiredFieldsId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OnBoardRequiredFieldsTableMap::CLASS_DEFAULT : OnBoardRequiredFieldsTableMap::OM_CLASS;
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
     * @return array (OnBoardRequiredFields object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OnBoardRequiredFieldsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OnBoardRequiredFieldsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OnBoardRequiredFieldsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OnBoardRequiredFieldsTableMap::OM_CLASS;
            /** @var OnBoardRequiredFields $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OnBoardRequiredFieldsTableMap::addInstanceToPool($obj, $key);
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
            $key = OnBoardRequiredFieldsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OnBoardRequiredFieldsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OnBoardRequiredFields $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OnBoardRequiredFieldsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID);
            $criteria->addSelectColumn(OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID);
            $criteria->addSelectColumn(OnBoardRequiredFieldsTableMap::COL_REQUIRED_FIELDS);
            $criteria->addSelectColumn(OnBoardRequiredFieldsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OnBoardRequiredFieldsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OnBoardRequiredFieldsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OnBoardRequiredFieldsTableMap::COL_STATUS_TYPE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.on_board_required_fields_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.outlet_type_id');
            $criteria->addSelectColumn($alias . '.required_fields');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.status_type_id');
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
            $criteria->removeSelectColumn(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID);
            $criteria->removeSelectColumn(OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID);
            $criteria->removeSelectColumn(OnBoardRequiredFieldsTableMap::COL_REQUIRED_FIELDS);
            $criteria->removeSelectColumn(OnBoardRequiredFieldsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OnBoardRequiredFieldsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OnBoardRequiredFieldsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OnBoardRequiredFieldsTableMap::COL_STATUS_TYPE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.on_board_required_fields_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.outlet_type_id');
            $criteria->removeSelectColumn($alias . '.required_fields');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.status_type_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OnBoardRequiredFieldsTableMap::DATABASE_NAME)->getTable(OnBoardRequiredFieldsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OnBoardRequiredFields or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OnBoardRequiredFields object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequiredFieldsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OnBoardRequiredFields) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OnBoardRequiredFieldsTableMap::DATABASE_NAME);
            $criteria->add(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID, (array) $values, Criteria::IN);
        }

        $query = OnBoardRequiredFieldsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OnBoardRequiredFieldsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OnBoardRequiredFieldsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the on_board_required_fields table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OnBoardRequiredFieldsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OnBoardRequiredFields or Criteria object.
     *
     * @param mixed $criteria Criteria or OnBoardRequiredFields object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequiredFieldsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OnBoardRequiredFields object
        }

        if ($criteria->containsKey(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID) && $criteria->keyContainsValue(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID.')');
        }


        // Set the correct dbName
        $query = OnBoardRequiredFieldsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
