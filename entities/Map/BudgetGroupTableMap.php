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
use entities\BudgetGroup;
use entities\BudgetGroupQuery;


/**
 * This class defines the structure of the 'budget_group' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BudgetGroupTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BudgetGroupTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'budget_group';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BudgetGroup';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BudgetGroup';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BudgetGroup';

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
     * the column name for the bgid field
     */
    public const COL_BGID = 'budget_group.bgid';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'budget_group.company_id';

    /**
     * the column name for the group_name field
     */
    public const COL_GROUP_NAME = 'budget_group.group_name';

    /**
     * the column name for the groupcode field
     */
    public const COL_GROUPCODE = 'budget_group.groupcode';

    /**
     * the column name for the maxlimit field
     */
    public const COL_MAXLIMIT = 'budget_group.maxlimit';

    /**
     * the column name for the notes field
     */
    public const COL_NOTES = 'budget_group.notes';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'budget_group.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'budget_group.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'budget_group.updated_at';

    /**
     * the column name for the is_default field
     */
    public const COL_IS_DEFAULT = 'budget_group.is_default';

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
        self::TYPE_PHPNAME       => ['Bgid', 'CompanyId', 'GroupName', 'Groupcode', 'Maxlimit', 'Notes', 'Status', 'CreatedAt', 'UpdatedAt', 'IsDefault', ],
        self::TYPE_CAMELNAME     => ['bgid', 'companyId', 'groupName', 'groupcode', 'maxlimit', 'notes', 'status', 'createdAt', 'updatedAt', 'isDefault', ],
        self::TYPE_COLNAME       => [BudgetGroupTableMap::COL_BGID, BudgetGroupTableMap::COL_COMPANY_ID, BudgetGroupTableMap::COL_GROUP_NAME, BudgetGroupTableMap::COL_GROUPCODE, BudgetGroupTableMap::COL_MAXLIMIT, BudgetGroupTableMap::COL_NOTES, BudgetGroupTableMap::COL_STATUS, BudgetGroupTableMap::COL_CREATED_AT, BudgetGroupTableMap::COL_UPDATED_AT, BudgetGroupTableMap::COL_IS_DEFAULT, ],
        self::TYPE_FIELDNAME     => ['bgid', 'company_id', 'group_name', 'groupcode', 'maxlimit', 'notes', 'status', 'created_at', 'updated_at', 'is_default', ],
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
        self::TYPE_PHPNAME       => ['Bgid' => 0, 'CompanyId' => 1, 'GroupName' => 2, 'Groupcode' => 3, 'Maxlimit' => 4, 'Notes' => 5, 'Status' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'IsDefault' => 9, ],
        self::TYPE_CAMELNAME     => ['bgid' => 0, 'companyId' => 1, 'groupName' => 2, 'groupcode' => 3, 'maxlimit' => 4, 'notes' => 5, 'status' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'isDefault' => 9, ],
        self::TYPE_COLNAME       => [BudgetGroupTableMap::COL_BGID => 0, BudgetGroupTableMap::COL_COMPANY_ID => 1, BudgetGroupTableMap::COL_GROUP_NAME => 2, BudgetGroupTableMap::COL_GROUPCODE => 3, BudgetGroupTableMap::COL_MAXLIMIT => 4, BudgetGroupTableMap::COL_NOTES => 5, BudgetGroupTableMap::COL_STATUS => 6, BudgetGroupTableMap::COL_CREATED_AT => 7, BudgetGroupTableMap::COL_UPDATED_AT => 8, BudgetGroupTableMap::COL_IS_DEFAULT => 9, ],
        self::TYPE_FIELDNAME     => ['bgid' => 0, 'company_id' => 1, 'group_name' => 2, 'groupcode' => 3, 'maxlimit' => 4, 'notes' => 5, 'status' => 6, 'created_at' => 7, 'updated_at' => 8, 'is_default' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Bgid' => 'BGID',
        'BudgetGroup.Bgid' => 'BGID',
        'bgid' => 'BGID',
        'budgetGroup.bgid' => 'BGID',
        'BudgetGroupTableMap::COL_BGID' => 'BGID',
        'COL_BGID' => 'BGID',
        'budget_group.bgid' => 'BGID',
        'CompanyId' => 'COMPANY_ID',
        'BudgetGroup.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'budgetGroup.companyId' => 'COMPANY_ID',
        'BudgetGroupTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'budget_group.company_id' => 'COMPANY_ID',
        'GroupName' => 'GROUP_NAME',
        'BudgetGroup.GroupName' => 'GROUP_NAME',
        'groupName' => 'GROUP_NAME',
        'budgetGroup.groupName' => 'GROUP_NAME',
        'BudgetGroupTableMap::COL_GROUP_NAME' => 'GROUP_NAME',
        'COL_GROUP_NAME' => 'GROUP_NAME',
        'group_name' => 'GROUP_NAME',
        'budget_group.group_name' => 'GROUP_NAME',
        'Groupcode' => 'GROUPCODE',
        'BudgetGroup.Groupcode' => 'GROUPCODE',
        'groupcode' => 'GROUPCODE',
        'budgetGroup.groupcode' => 'GROUPCODE',
        'BudgetGroupTableMap::COL_GROUPCODE' => 'GROUPCODE',
        'COL_GROUPCODE' => 'GROUPCODE',
        'budget_group.groupcode' => 'GROUPCODE',
        'Maxlimit' => 'MAXLIMIT',
        'BudgetGroup.Maxlimit' => 'MAXLIMIT',
        'maxlimit' => 'MAXLIMIT',
        'budgetGroup.maxlimit' => 'MAXLIMIT',
        'BudgetGroupTableMap::COL_MAXLIMIT' => 'MAXLIMIT',
        'COL_MAXLIMIT' => 'MAXLIMIT',
        'budget_group.maxlimit' => 'MAXLIMIT',
        'Notes' => 'NOTES',
        'BudgetGroup.Notes' => 'NOTES',
        'notes' => 'NOTES',
        'budgetGroup.notes' => 'NOTES',
        'BudgetGroupTableMap::COL_NOTES' => 'NOTES',
        'COL_NOTES' => 'NOTES',
        'budget_group.notes' => 'NOTES',
        'Status' => 'STATUS',
        'BudgetGroup.Status' => 'STATUS',
        'status' => 'STATUS',
        'budgetGroup.status' => 'STATUS',
        'BudgetGroupTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'budget_group.status' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'BudgetGroup.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'budgetGroup.createdAt' => 'CREATED_AT',
        'BudgetGroupTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'budget_group.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BudgetGroup.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'budgetGroup.updatedAt' => 'UPDATED_AT',
        'BudgetGroupTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'budget_group.updated_at' => 'UPDATED_AT',
        'IsDefault' => 'IS_DEFAULT',
        'BudgetGroup.IsDefault' => 'IS_DEFAULT',
        'isDefault' => 'IS_DEFAULT',
        'budgetGroup.isDefault' => 'IS_DEFAULT',
        'BudgetGroupTableMap::COL_IS_DEFAULT' => 'IS_DEFAULT',
        'COL_IS_DEFAULT' => 'IS_DEFAULT',
        'is_default' => 'IS_DEFAULT',
        'budget_group.is_default' => 'IS_DEFAULT',
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
        $this->setName('budget_group');
        $this->setPhpName('BudgetGroup');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BudgetGroup');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('budget_group_bgid_seq');
        // columns
        $this->addPrimaryKey('bgid', 'Bgid', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('group_name', 'GroupName', 'VARCHAR', true, 50, null);
        $this->addColumn('groupcode', 'Groupcode', 'VARCHAR', false, 50, null);
        $this->addColumn('maxlimit', 'Maxlimit', 'DECIMAL', true, 10, null);
        $this->addColumn('notes', 'Notes', 'VARCHAR', false, 150, null);
        $this->addColumn('status', 'Status', 'SMALLINT', false, null, 1);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('is_default', 'IsDefault', 'BOOLEAN', true, 1, false);
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
), 'CASCADE', null, null, false);
        $this->addRelation('BudgetExp', '\\entities\\BudgetExp', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':bgid',
    1 => ':bgid',
  ),
), null, null, 'BudgetExps', false);
        $this->addRelation('BudgetGrades', '\\entities\\BudgetGrades', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':bgid',
    1 => ':bgid',
  ),
), null, null, 'BudgetGradess', false);
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':budget_id',
    1 => ':bgid',
  ),
), null, null, 'Expensess', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bgid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bgid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bgid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bgid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bgid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bgid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Bgid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BudgetGroupTableMap::CLASS_DEFAULT : BudgetGroupTableMap::OM_CLASS;
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
     * @return array (BudgetGroup object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BudgetGroupTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BudgetGroupTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BudgetGroupTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BudgetGroupTableMap::OM_CLASS;
            /** @var BudgetGroup $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BudgetGroupTableMap::addInstanceToPool($obj, $key);
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
            $key = BudgetGroupTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BudgetGroupTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BudgetGroup $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BudgetGroupTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_BGID);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_GROUP_NAME);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_GROUPCODE);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_MAXLIMIT);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_NOTES);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_STATUS);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BudgetGroupTableMap::COL_IS_DEFAULT);
        } else {
            $criteria->addSelectColumn($alias . '.bgid');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.group_name');
            $criteria->addSelectColumn($alias . '.groupcode');
            $criteria->addSelectColumn($alias . '.maxlimit');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.is_default');
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
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_BGID);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_GROUP_NAME);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_GROUPCODE);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_MAXLIMIT);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_NOTES);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_STATUS);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BudgetGroupTableMap::COL_IS_DEFAULT);
        } else {
            $criteria->removeSelectColumn($alias . '.bgid');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.group_name');
            $criteria->removeSelectColumn($alias . '.groupcode');
            $criteria->removeSelectColumn($alias . '.maxlimit');
            $criteria->removeSelectColumn($alias . '.notes');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.is_default');
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
        return Propel::getServiceContainer()->getDatabaseMap(BudgetGroupTableMap::DATABASE_NAME)->getTable(BudgetGroupTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BudgetGroup or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BudgetGroup object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGroupTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BudgetGroup) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BudgetGroupTableMap::DATABASE_NAME);
            $criteria->add(BudgetGroupTableMap::COL_BGID, (array) $values, Criteria::IN);
        }

        $query = BudgetGroupQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BudgetGroupTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BudgetGroupTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the budget_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BudgetGroupQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BudgetGroup or Criteria object.
     *
     * @param mixed $criteria Criteria or BudgetGroup object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGroupTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BudgetGroup object
        }

        if ($criteria->containsKey(BudgetGroupTableMap::COL_BGID) && $criteria->keyContainsValue(BudgetGroupTableMap::COL_BGID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BudgetGroupTableMap::COL_BGID.')');
        }


        // Set the correct dbName
        $query = BudgetGroupQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
