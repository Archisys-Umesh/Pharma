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
use entities\LeaveType;
use entities\LeaveTypeQuery;


/**
 * This class defines the structure of the 'leave_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LeaveTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.LeaveTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'leave_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'LeaveType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\LeaveType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.LeaveType';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the leave_type_id field
     */
    public const COL_LEAVE_TYPE_ID = 'leave_type.leave_type_id';

    /**
     * the column name for the leave_type field
     */
    public const COL_LEAVE_TYPE = 'leave_type.leave_type';

    /**
     * the column name for the short_code field
     */
    public const COL_SHORT_CODE = 'leave_type.short_code';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'leave_type.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'leave_type.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'leave_type.updated_at';

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
        self::TYPE_PHPNAME       => ['LeaveTypeId', 'LeaveType', 'ShortCode', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['leaveTypeId', 'leaveType', 'shortCode', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [LeaveTypeTableMap::COL_LEAVE_TYPE_ID, LeaveTypeTableMap::COL_LEAVE_TYPE, LeaveTypeTableMap::COL_SHORT_CODE, LeaveTypeTableMap::COL_COMPANY_ID, LeaveTypeTableMap::COL_CREATED_AT, LeaveTypeTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['leave_type_id', 'leave_type', 'short_code', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['LeaveTypeId' => 0, 'LeaveType' => 1, 'ShortCode' => 2, 'CompanyId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['leaveTypeId' => 0, 'leaveType' => 1, 'shortCode' => 2, 'companyId' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [LeaveTypeTableMap::COL_LEAVE_TYPE_ID => 0, LeaveTypeTableMap::COL_LEAVE_TYPE => 1, LeaveTypeTableMap::COL_SHORT_CODE => 2, LeaveTypeTableMap::COL_COMPANY_ID => 3, LeaveTypeTableMap::COL_CREATED_AT => 4, LeaveTypeTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['leave_type_id' => 0, 'leave_type' => 1, 'short_code' => 2, 'company_id' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'LeaveTypeId' => 'LEAVE_TYPE_ID',
        'LeaveType.LeaveTypeId' => 'LEAVE_TYPE_ID',
        'leaveTypeId' => 'LEAVE_TYPE_ID',
        'leaveType.leaveTypeId' => 'LEAVE_TYPE_ID',
        'LeaveTypeTableMap::COL_LEAVE_TYPE_ID' => 'LEAVE_TYPE_ID',
        'COL_LEAVE_TYPE_ID' => 'LEAVE_TYPE_ID',
        'leave_type_id' => 'LEAVE_TYPE_ID',
        'leave_type.leave_type_id' => 'LEAVE_TYPE_ID',
        'LeaveType' => 'LEAVE_TYPE',
        'LeaveType.LeaveType' => 'LEAVE_TYPE',
        'leaveType' => 'LEAVE_TYPE',
        'leaveType.leaveType' => 'LEAVE_TYPE',
        'LeaveTypeTableMap::COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'leave_type' => 'LEAVE_TYPE',
        'leave_type.leave_type' => 'LEAVE_TYPE',
        'ShortCode' => 'SHORT_CODE',
        'LeaveType.ShortCode' => 'SHORT_CODE',
        'shortCode' => 'SHORT_CODE',
        'leaveType.shortCode' => 'SHORT_CODE',
        'LeaveTypeTableMap::COL_SHORT_CODE' => 'SHORT_CODE',
        'COL_SHORT_CODE' => 'SHORT_CODE',
        'short_code' => 'SHORT_CODE',
        'leave_type.short_code' => 'SHORT_CODE',
        'CompanyId' => 'COMPANY_ID',
        'LeaveType.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'leaveType.companyId' => 'COMPANY_ID',
        'LeaveTypeTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'leave_type.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'LeaveType.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'leaveType.createdAt' => 'CREATED_AT',
        'LeaveTypeTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'leave_type.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'LeaveType.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'leaveType.updatedAt' => 'UPDATED_AT',
        'LeaveTypeTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'leave_type.updated_at' => 'UPDATED_AT',
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
        $this->setName('leave_type');
        $this->setPhpName('LeaveType');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\LeaveType');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('leave_type_leave_type_id_seq');
        // columns
        $this->addPrimaryKey('leave_type_id', 'LeaveTypeId', 'INTEGER', true, null, null);
        $this->addColumn('leave_type', 'LeaveType', 'VARCHAR', false, null, null);
        $this->addColumn('short_code', 'ShortCode', 'VARCHAR', false, null, null);
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
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveTypeId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveTypeId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveTypeId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveTypeId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveTypeId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeaveTypeId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('LeaveTypeId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LeaveTypeTableMap::CLASS_DEFAULT : LeaveTypeTableMap::OM_CLASS;
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
     * @return array (LeaveType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LeaveTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LeaveTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LeaveTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeaveTypeTableMap::OM_CLASS;
            /** @var LeaveType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LeaveTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = LeaveTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LeaveTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LeaveType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeaveTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LeaveTypeTableMap::COL_LEAVE_TYPE_ID);
            $criteria->addSelectColumn(LeaveTypeTableMap::COL_LEAVE_TYPE);
            $criteria->addSelectColumn(LeaveTypeTableMap::COL_SHORT_CODE);
            $criteria->addSelectColumn(LeaveTypeTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(LeaveTypeTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LeaveTypeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.leave_type_id');
            $criteria->addSelectColumn($alias . '.leave_type');
            $criteria->addSelectColumn($alias . '.short_code');
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
            $criteria->removeSelectColumn(LeaveTypeTableMap::COL_LEAVE_TYPE_ID);
            $criteria->removeSelectColumn(LeaveTypeTableMap::COL_LEAVE_TYPE);
            $criteria->removeSelectColumn(LeaveTypeTableMap::COL_SHORT_CODE);
            $criteria->removeSelectColumn(LeaveTypeTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(LeaveTypeTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LeaveTypeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.leave_type_id');
            $criteria->removeSelectColumn($alias . '.leave_type');
            $criteria->removeSelectColumn($alias . '.short_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(LeaveTypeTableMap::DATABASE_NAME)->getTable(LeaveTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LeaveType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or LeaveType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\LeaveType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeaveTypeTableMap::DATABASE_NAME);
            $criteria->add(LeaveTypeTableMap::COL_LEAVE_TYPE_ID, (array) $values, Criteria::IN);
        }

        $query = LeaveTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LeaveTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LeaveTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the leave_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LeaveTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LeaveType or Criteria object.
     *
     * @param mixed $criteria Criteria or LeaveType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LeaveType object
        }

        if ($criteria->containsKey(LeaveTypeTableMap::COL_LEAVE_TYPE_ID) && $criteria->keyContainsValue(LeaveTypeTableMap::COL_LEAVE_TYPE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeaveTypeTableMap::COL_LEAVE_TYPE_ID.')');
        }


        // Set the correct dbName
        $query = LeaveTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
